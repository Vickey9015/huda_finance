<?php
//error_reporting(E_ALL);
class Member extends CI_Controller {
    public $data = array();
    
    public function __construct() {
        $data =array();
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $session_data = $this->session->all_userdata();
        $data  =array('is_logged_in'=>$this->session->userdata('logged_in'));
        if(!$this->session->userdata('logged_in')){
			redirect(base_url().'user/index');
			
		}
		
		$this->approver_id=  $session_data['id'];
		$this->role_id = $session_data['role_id'];
		$this->user_id = $session_data['id'];
		
        $this->load->model('member_model');
        $this->load->model('authentication_model');
        $this->load->model('action_model');
        $this->load->helper('common_helper');
    }
    
    
	function addMember(){ 
		$data =array();
		if($this->role_id == 7){
    		$session_data = $this->session->all_userdata();
            $data['session_data'] = $session_data;
    		$this->load->view('layout/header', $data);
            $this->load->view('layout/topbar', $data);
       		$this->load->view('layout/leftbar', $data);
    		$this->load->view('addMember',$data);
    		$this->load->view('layout/footer');
		}else{
		    redirect(base_url());
		}
	}
	
	function addMemberDetails(){
		//echo "<pre>=111="; print_r($_REQUEST); exit;
		if($this->role_id == 7){
		        if($this->form_validation->run('addMember')==FALSE){
		                $data = '';
					    $this->load->view('layout/header', $data);
                        $this->load->view('layout/topbar', $data);
                   		$this->load->view('layout/leftbar', $data);
                		$this->load->view('addMember',$data);
                		$this->load->view('layout/footer');
					}else{
					   // print_r($_REQUEST);die;
		         $session_data = $this->session->all_userdata();
		         $id = $session_data['id'];
		         $subject = "User Account Details";
		         $messages = '';
		         $memRoleId = strip_tags($_REQUEST['role_id']);
		         $role_id = strip_tags($_REQUEST['role_id']);
		         $memRoleName = '';
		         if($memRoleId==3){
		             $memRoleName = "Maker";
		         }elseif($memRoleId==4){
		             $memRoleName = "Checker";
		         }elseif($memRoleId==5){
		             $memRoleName = "Releaser";
		         }elseif($memRoleId==9){
		             $memRoleName = "Zonal Administrator";
		         }elseif($memRoleId==6){
		             $memRoleName = "Viewaccess";
		         }
		         
		         $memberName = strip_tags($_REQUEST['name']);
		         $phone = strip_tags($_REQUEST['phone']);
		         $email =strip_tags($_REQUEST['email']);
		        // $pass =strip_tags($_REQUEST['password']);
		        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
                $pass_str = substr(str_shuffle($chars),0,4);
                $_REQUEST['password']=H.$pass_str.'@'.rand(1111,9999);
		         $loginUrl = base_url();
		         $mailData = array(
		             'name'                           =>strip_tags($_REQUEST['name']),
					'email'                          =>strip_tags($_REQUEST['email']),
					'phone'                          =>strip_tags($_REQUEST['phone']),
					'password'                       =>strip_tags($_REQUEST['password']),
					'login_url'                      => $loginUrl,
					'role_name'                        =>$memRoleName
		             );
		      
$memberMessage ="Dear  $memberName,
We have created your login account as a '$memRoleName' in Huda System for annexure activity 
Please login here   :  $loginUrl
Your Email       : $email
Your Password       : $pass


Thanks & Regards 
IndusInd team ";
		         $sql ="SELECT * FROM user a WHERE (a.email='$email' OR a.phone='$phone') and is_active != 4"; 
				 $resultquery   = $this->db->query($sql);  
				 
				 $result        = $resultquery->result_array();
				 //echo "<pre>=111=uuu"; print_r($result); exit;
		         if(!empty($result)){
		             
		            $messge = array('message' => 'Member Already exist on same Email or Phone.' ,'class' => 'alert alert-danger');
                    $this->session->set_flashdata('item',$messge); 
                    redirect('../member/addMember');
		         }
		        $key = $this->config->item('encryption_key');
              //  $password = $this->encrypt->encode($_REQUEST['password'], $key);
                $password = hash_hmac(ENCTYPE, $_REQUEST['password'], SHA512ENCKEY);
                $zone_value  = explode(',',$_REQUEST['zone_id']);
                // echo "<pre>=111=uuu"; print_r($zone_value); exit;
                if($memRoleId == 6){
		            $role_id = 6;
		         }
                $UserArray = array(
					'name'                           =>strip_tags($_REQUEST['name']),
					'email'                          =>strip_tags($_REQUEST['email']),
					'phone'                          =>strip_tags($_REQUEST['phone']),
					'password'                       =>strip_tags($password),
					'role_id'                        =>strip_tags($role_id),
					'zone_id'                        =>$zone_value[0],
					'maker_id'                       =>$this->approver_id
				);
				if($memRoleId == 6){
		            $UserArray['is_view'] = 1;
		         } 	
				 	
				//echo "<pre>=111=uuu"; print_r($UserArray); exit;
				$res = $this->db->insert('user', $UserArray);
				$insert_id = $this->db->insert_id();
				$pwd_hash_array = array("user_id" => $insert_id,"password_hash"=>$password);
				//$res = $this->db->insert('user', $UserArray);
				$res11 = $this->db->insert('password_history', $pwd_hash_array);
                
                
               // if(count($zone_value)>1){
                    foreach($zone_value as $values){
                        $add_Zone = array("user_id" => $insert_id,"zone_id"=>$values);
        				//$res = $this->db->insert('user', $UserArray);
        				$res11 = $this->db->insert('user_zone_mapping', $add_Zone);
                        
                    }
                    
                    
               // }
				
				
			    sendMail($email, $messages, $subject ,$from_email=NULL,$memberName,$mailData);
				//sendMessageByFirstValue('91'.$phone,$memberMessage); 
				$messge = array('message' => MEMBER_ADDED_MESSAGE ,'class' => 'alert alert-success');
                $this->session->set_flashdata('item',$messge);
				redirect('../member/memberView');
			}
		}else{
		    redirect(base_url());
		}
			
	}
		function memberView(){
		try {
				$data =array();
				if($this->role_id == 7){
				$session_data = $this->session->all_userdata();
				$id=  $session_data['id'];
				$role_id = $session_data['role_id'];
				if(!empty($_POST)){
				    if($this->form_validation->run('date')==FALSE){
					    
					}else{
    					//echo "<pre>====="; print_r($_POST); exit;
    					$startDate          = $_POST['fromDate'];
    					$toDate             = $_POST['toDate'];
    					
    					$result             = $this->member_model->getMemberDetails($startDate,$toDate,$role_id);
					}
				}else{
					$result             = $this->member_model->getMemberDetails();
				}
                               
				$data =array('result'=>$result,'session_data'=>$session_data);
			//	echo "<pre>====="; print_r($data); exit;
			    $this->load->view('layout/header', $data);
                $this->load->view('layout/topbar', $data);
   		        $this->load->view('layout/leftbar', $data);
				$this->load->view('memberView', $data);
				}else{
				    redirect(base_url());
				}
			  //  $this->load->view('layout/footer_merchant', $data);
			} catch (Exception $e) {
				echo $e->getMessage();
				$error = array('status' => 0, "msg" => "Internal Server Error - Please try Later.","StatusCode"=> "NP001");
				$this->response($this->json($error), 200);	
		
		}
	}
	
	function bankCheckerView(){
		try {
				$data =array();
				if($this->role_id == 8){
				$session_data = $this->session->all_userdata();
				$id=  $session_data['id'];
				if(!empty($_POST)){
				    if($this->form_validation->run('date')==FALSE){
					    
					}else{
    					$startDate          = $_POST['fromDate'];
    					$toDate             = $_POST['toDate'];
    					$result             = $this->member_model->getMemberDetails($startDate,$toDate,$status);
					}
				}else{
					$result             = $this->member_model->getMemberDetailsByBankChecker();
				}
                               
				$data =array('result'=>$result,'session_data'=>$session_data);
			//	echo "<pre>====="; print_r($data); exit;
			    $this->load->view('layout/header', $data);
                $this->load->view('layout/topbar', $data);
   		        $this->load->view('layout/leftbar', $data);
				$this->load->view('bankCheckerView', $data);
				}else{
				    if($this->role_id == 7){
				        redirect('../member/memberView');
				    }else{
				        redirect(base_url());
				    }
				}
			  //  $this->load->view('layout/footer_merchant', $data);
			} catch (Exception $e) {
				echo $e->getMessage();
				$error = array('status' => 0, "msg" => "Internal Server Error - Please try Later.","StatusCode"=> "NP001");
				$this->response($this->json($error), 200);	
		
		}
	}
	
	function updateMember($id){
		$data = array();
		if($this->role_id == 7){
		    $select= "SELECT zm.id,zm.name FROM user_zone_mapping uzm INNER JOIN  zone_master  zm ON uzm.zone_id=zm.id WHERE uzm.user_id=$id";
		    $query = $this->db->query($select);
		    //echo $this->db->last_query(); die;
            $userZonemapping = $query->result_array();
            
            $selected= "SELECT  GROUP_CONCAT('',zm.id) AS zone_ids  FROM user_zone_mapping uzm INNER JOIN  zone_master  zm ON uzm.zone_id=zm.id WHERE uzm.user_id=$id";
		    $query = $this->db->query($selected);
		    //echo $this->db->last_query(); die;
            $userSelectedZone = $query->result_array();
            
            // echo "<pre>===="; print_r($userSelectedZone);exit;
    		$result             = $this->member_model->getMemberList($id);
            $result             =$result[0];
    		$data =array('result'=>$result,'user_zone_mapping'=>$userZonemapping,'selected_zone'=>$userSelectedZone,'session_data'=>$session_data);
                  //  echo "<pre>===="; print_r($data);exit;
            $zoneList = $this->member_model->getByZone();
    		$data['zone_list'] =  $zoneList;
    		$session_data = $this->session->all_userdata();
    		$this->load->view('layout/header', $data);
            $this->load->view('layout/topbar', $data);
       		$this->load->view('layout/leftbar', $data);
    		$this->load->view('updateMember',$data);
    		$this->load->view('layout/footer');
		}else{
		    redirect(base_url());
		}
	}
			
	function updateMemberDetails(){
	        if($this->role_id == 7){
	            if($this->form_validation->run('updateMember')==FALSE){
	                $data = '';
	                $this->load->view('layout/header', $data);
                    $this->load->view('layout/topbar', $data);
               		$this->load->view('layout/leftbar', $data);
            		$this->load->view('updateMember',$data);
            		$this->load->view('layout/footer');
	            }else{
		         $id= $_REQUEST['id'];
		          $zone_value  = explode(',',$_REQUEST['zone_id']);
                 // echo "<pre>=111=uuu";print_r($_REQUEST); print_r($zone_value); exit;
				 $UserUpdateArray =array(
					'name'                           =>strip_tags($_REQUEST['name']),
				//	'email'                          =>$_REQUEST['email'], 
				//	'phone'                          =>$_REQUEST['phone'],
				// 	'password'                       =>md5($_REQUEST['password']),
				  //'role_id'                        =>$_REQUEST['role_id'],
					'zone_id'                        =>$zone_value[0],
					'updated_on'                     => date('Y-m-d H:i:s')
					);
				//echo "<pre>=111====$id"; print_r($_REQUEST); print_r($UserUpdateArray); exit;
				$userZoneChange = $this->action_model->checkUserZonesById($id);
				$existsZone = array();
				if(!empty($userZoneChange)){
				    foreach($userZoneChange as $uz){
				       $existsZone[] = $uz['zone_id']; 
				    }
				}
				/*
				echo "<pre>="; print_r($zone_value);
				print_r($existsZone); 
				$result= $zone_value == $existsZone;
				echo implode($zone_value,",");
				print_r($result);
				die;
				*/
				if(!empty($zone_value) && $zone_value != $existsZone){
    				$changeAuditArray = array(
    				        "maker_id"     => $this->user_id,
    				        "old_data"     => implode($existsZone,","),
    				        "update_data_name" => "Zone",
    				        "update_data_column" => "zone_id",
    				        "new_data"     => implode($zone_value,","),
    				        "reference_column"  => "id",
    				        "reference_id" => $id,
    				        "type"         => 'user_zone_mapping'
    				    );	
    				$this->action_model->addChangeAudit($changeAuditArray);
			    }
				
				$userDetailChange = $this->action_model->checkUserDetailsById($id);
			    if(!empty($userDetailChange) && $userDetailChange['name'] != $_REQUEST['name']){
    				$changeAuditArray = array(
    				        "maker_id"     => $this->user_id,
    				        "old_data"     => $userDetailChange['name'],
    				        "update_data_name" => "User Name",
    				        "update_data_column" => "name",
    				        "new_data"     => strip_tags($_REQUEST['name']),
    				        "reference_column"  => "id",
    				        "reference_id" => $id,
    				        "type"         => 'user'
    				    );	
    				$this->action_model->addChangeAudit($changeAuditArray);
			    }
			    if(!empty($userDetailChange) && $userDetailChange['phone'] != $_REQUEST['phone']){
    				$changeAuditArray = array(
    				        "maker_id"     => $this->user_id,
    				        "old_data"     => $userDetailChange['phone'],
    				        "update_data_name" => "User Mobile",
    				        "update_data_column" => "phone",
    				        "new_data"     => strip_tags($_REQUEST['phone']),
    				        "reference_column"  => "id",
    				        "reference_id" => $id,
    				        "type"         => 'user'
    				    );	
    				$this->action_model->addChangeAudit($changeAuditArray);
			    }
			    if(!empty($userDetailChange) && $userDetailChange['email'] != $_REQUEST['email']){
    				$changeAuditArray = array(
    				        "maker_id"     => $this->user_id,
    				        "old_data"     => $userDetailChange['email'],
    				        "update_data_name" => "User Email",
    				        "update_data_column" => "email",
    				        "new_data"     => strip_tags($_REQUEST['email']),
    				        "reference_column"  => "id",
    				        "reference_id" => $id,
    				        "type"         => 'user'
    				    );	
    				$this->action_model->addChangeAudit($changeAuditArray);
			    }
				
				$this->member_model->UpdateMember($id,$UserUpdateArray);
			    $this->member_model->updateZoneidMember($id,$zone_value);
				//$this->member_model->updateZoneidMember($id,$zone_value);
				// $pwd_hash_array = array("password_hash"=>md5($_REQUEST['password']));
				// $this->db->where('user_id',$id);   
			 //   $res11 = $this->db->update('password_history', $pwd_hash_array);
			 //   $add_Zone = array("zone_id"=>$_REQUEST['zone_id']);
			  /*
			  $this->db->where('user_id', $id);
                $this->db->delete('user_zone_mapping');
			    foreach($zone_value as $values){
                        $add_Zone = array("user_id" => $id,"zone_id"=>$values);
        				//$res = $this->db->insert('user', $UserArray);
        				$res11 = $this->db->insert('user_zone_mapping', $add_Zone);
                        
                    }
                */    
				//exit;
			    
			    
				$messge = array('message' => MEMBER_UPDATED_MESSAGE ,'class' => 'alert alert-success fade in');
                $this->session->set_flashdata('item',$messge);
				redirect('../member/memberView');
	            }
	        }else{
    		    redirect(base_url());
    		}
		}
	
	function updateStatus($id,$status){
		//echo "<pre>==$id"; print_r($status); exit;
		if($this->role_id == 7 or $this->role_id == 8){
				 if($status==1){
					$status=0;
				 }elseif($status==0){
					$status=1;
				 }
				 $UserUpdateArray =array(
					'is_active'       =>$status
					);
				// echo "<pre>==$id"; print_r($UserUpdateArray); exit;
				$this->member_model->UpdateMember($id,$UserUpdateArray);
				$messge = array('message' => MEMBER_STATUS_MESSAGE ,'class' => 'alert alert-success fade in');
                $this->session->set_flashdata('item',$messge);
				redirect('../member/memberView');
		}else{
		    redirect(base_url());
		}
	}
			
			function verifyMember($id,$status){
		        //echo "<pre>==$id"; print_r($status); exit;
		        $id = htmlspecialchars($id);
		        $status = htmlspecialchars($status);
		        if((strlen($id) >= 1 && strlen($status) >= 1) && (strlen($id) <= 3 && strlen($status) <= 2) && $this->role_id == 8){
		        $sql ="SELECT * FROM user u WHERE u.id='$id'"; 
				 $resultquery   = $this->db->query($sql);  
				 $result        = $resultquery->result_array();
				
			 //echo "<pre>==$this->approver_id"; print_r($result); exit;
				 if($status==3){
					$status=3;
				 }
				 $UserUpdateArray =array(
					//'is_active'       =>$status
					'checker_id' => $this->approver_id
					);
				// echo "<pre>==$id"; print_r($UserUpdateArray); exit;
				$this->member_model->UpdateMember($id,$UserUpdateArray);
				if(!empty($result)){
				     $memRoleId = $result[0]['role_id'];
		         $memRoleName = '';
		         if($memRoleId==3){
		             $memRoleName = "Maker";
		         }elseif($memRoleId==4){
		             $memRoleName = "Checker";
		         }elseif($memRoleId==5){
		             $memRoleName = "Releaser";
		         }elseif($memRoleId==9){
		             $memRoleName = "Zonal Administrator";
		         }
		         
		         $memberName = $result['name'];
		         $phone = $result[0]['phone'];
		         $email =$result[0]['email'];
		         $pass = $result[0]['pass_code'];
		         $loginUrl = base_url();
		         $mailData = array(
		             'name'                           =>$result[0]['name'],
					'email'                          =>$result[0]['email'],
				    'password'                       =>$result[0]['pass_code'],
					'phone'                          =>$result[0]['phone'],
					'login_url'                      => $loginUrl,
					'role_name'                        =>$memRoleName
		             );
                    $memberMessage ="Dear  $memberName,
                    We have created your login account as a '$memRoleName' in Huda System for annexure activity 
                    Please login here   :  $loginUrl
                    Your Email       : $email
                    Your Password       : $pass
                    
                    
                    Thanks & Regards 
                    IndusInd team ";
                    //echo "<pre>==$id"; print_r($email); exit;
				//sendMail($email, $messages, $subject ,$from_email=NULL,$memberName,$mailData);
				//sendMessageByFirstValue('91'.$phone,$memberMessage);
				}
			
				$messge = array('message' => "Member verified successfully !" ,'class' => 'alert alert-success fade in');
                $this->session->set_flashdata('item',$messge);
				redirect('../member/bankCheckerView');
		        }else{
		            redirect(base_url());
		        }
			}
			
	function deleteMember($id,$status){
		//echo "<pre>==$id"; print_r($status); exit;
		    if((strlen($id) >= 1 && strlen($status) >= 1) && (strlen($id) <= 3 && strlen($status) <= 2) && $this->role_id == 7){
				 if($status==4){
					$status=4;
				 }
				 $UserUpdateArray =array(
					'is_active'       =>$status
					);
				// echo "<pre>==$id"; print_r($UserUpdateArray); exit;
				$this->member_model->UpdateMember($id,$UserUpdateArray);
				$messge = array('message' => "Member Deleted Successfully !" ,'class' => 'alert alert-success fade in');
                $this->session->set_flashdata('item',$messge);
				redirect('../member/memberView');
		    }else{
		            redirect(base_url());
		        }
		}	
			
	public function changeuserPassword()
	{
		$data =array();
		$session_data = $this->session->all_userdata();
        $data['session_data'] = $session_data;
		$this->load->view('layout/header', $data);
        $this->load->view('layout/topbar', $data);
   		$this->load->view('layout/leftbar', $data);
		$this->load->view('changeuserpassword',$data);
		$this->load->view('layout/footer');
	}

	public function changenewpassword()
	{
		$data =array();
		$session_data = $this->session->all_userdata();
        $data['session_data'] = $session_data;
		$this->load->view('layout/header', $data);
		$this->load->view('change_newuser_password',$data);
		
	}

 public function changenewUserpassword(){
	    try{
	        if($this->form_validation->run('changePassword')==FALSE){
	            $data =array();
        		$session_data = $this->session->all_userdata();
                $data['session_data'] = $session_data;
        		$this->load->view('layout/header', $data);
        		$this->load->view('change_newuser_password',$data);
	        }else{
	    	$id            = $this->uri->segment(3);
			$password      = strip_tags($this->input->post('password'));
			$confPassword  = strip_tags($this->input->post('confirm_password'));
			//$newPass = md5($password);
			$key = $this->config->item('encryption_key');
            //$newPass = $this->encrypt->encode($password, $key);
            $newPass = hash_hmac(ENCTYPE, $password, SHA512ENCKEY);
			//  echo "<pre>======"; print_r($otp); exit;
			if(!empty($confPassword) and !empty($password) and strlen($id) >= 1 and strlen($id) <= 3 and ($this->approver_id == $id)){
				$sql ="SELECT  a.id,a.name,a.email,a.phone FROM user a WHERE a.id='$id'"; 
				$resultquery   = $this->db->query($sql);     
				$result        = $resultquery->result_array();
			    //echo "<pre>======"; print_r($result); exit;
		        //check valid otp from user table
		        if(!empty($result)){     
		 			$id  = $result[0]['id'];
		 			$email = $result[0]['email'];
	    		    $resultPass = $this->authentication_model->validatePass($id,$password);
                   //echo "<pre>======"; print_r($resultPass);die;
					//check last five password from password_history table
					if ($resultPass == 0) {
						$messge = array('message' => 'Password already used!');
						$this->session->set_flashdata('item_error', $messge);
						header('location:' . base_url() . "member/changenewpassword");
					}else{
						//update password from user table
						$statusArray =array('password' => $newPass,'is_new_user' => 0);
						$this->db->where('id',$id);
			 			$updated_id = $this->db->update('user',$statusArray);

			 			//update status 0 from password_history table
			 			$statusActiveArray = array('is_active' => 0);
			 			$this->db->where('user_id',$id);
			 			$updated_status = $this->db->update('password_history',$statusActiveArray);

			 			//insert password in password_history table
			 			$pwd_hash_array = array("user_id" => $id,"password_hash"=>$newPass);
			 			$res11 = $this->db->insert('password_history', $pwd_hash_array);

			 			$messge = array('message' => 'Password Change Successfully !');
			            $this->session->set_flashdata('item_success', $messge); 
			 			header('location:' . base_url() . "home/dashboard");
			 		}	
				}else{
					$messge = array('message' => 'Invalid User !');
			        $this->session->set_flashdata('item_error', $messge); 
	                header('location:' . base_url() . "member/changenewpassword");
		    	}
			}else{
					$error = array('status' => 0, "msg" =>'invalid Credentials.');
					//$this->response($this->json($message), 200);
					redirect('../home/dashboard');
			}
	    }
    	}catch (Exception $e) {
			echo $e->getMessage();
			$error = array('status' => 0, "msg" => "Internal Server Error - Please try Later.","StatusCode"=> "NP001");
			$this->response($error, 200);	
		}
    }


	public function changePassword()
	{
		  try{
		      if($this->form_validation->run('changePassword')==FALSE){
		          redirect('../home/dashboard');
		      }else{
		  	$id            = $this->uri->segment(3);
		  	$currentPassword  = strip_tags($this->input->post('current_password'));
			$password      = strip_tags($this->input->post('password'));
			$confPassword  = strip_tags($this->input->post('confirm_password'));
		//	$newPass = md5($currentPassword);
			//$changePass = md5($password);
			$key = $this->config->item('encryption_key');
            //$newPass = $this->encrypt->encode($password, $key);
            $newPass = hash_hmac(ENCTYPE, $confPassword, SHA512ENCKEY);
            $currentPassword = hash_hmac(ENCTYPE, $currentPassword, SHA512ENCKEY);
            // $changePass = $this->encrypt->encode($currentPassword, $key);
			 //echo "<pre>======"; print_r($currentPassword);
			// echo "<pre>==="; print_r($password); exit;
			if(!empty($confPassword) and !empty($id) and !empty($password) and !empty($currentPassword)  and strlen($id) >= 1 and strlen($id) <= 3 ){
				$sql ="SELECT  a.id,a.name,a.email,a.phone FROM user a WHERE a.id='$id'"; 
				$resultquery   = $this->db->query($sql);     
				$result        = $resultquery->result_array();
			    //echo "<pre>======"; print_r($result); exit;
		        //check valid user from user table
		        if(!empty($result)){
		 			$id  = $result[0]['id'];
		 			$email = $result[0]['email'];
		 	// 		$resultPass = $this->authentication_model->validatePass($id,$changePass);
		 			//echo "<pre>======"; print_r($result); exit;
					//check last five password from password_history table
					$res_pass = $this->authentication_model->check_login($email,$password);
    		 			$plain_password = '';
                        if ($res_pass) {
                           $key = $this->config->item('encryption_key');
                           //$plain_password = $this->encrypt->decode($res_pass, $key);
                            $plain_password = hash_hmac(ENCTYPE, $password, SHA512ENCKEY);
                        }
					if ($res_pass==$currentPassword) {
        				$resultPassValid = $this->authentication_model->validatePass($id,$password);
        				//echo "<pre>======"; print_r($resultPassValid); exit;
						if ($resultPassValid==0) {
						$messge = array('message' => 'Password already used!');
						$this->session->set_flashdata('item_error', $messge);
						header('location:' . base_url() . "member/changeuserPassword");
						}else{
						//update password from user table
						$statusArray =array('password' => $newPass);
						$this->db->where('id',$id);
			 			$updated_id = $this->db->update('user',$statusArray);

			 			//update status 0 from password_history table
			 			$statusActiveArray = array('is_active' => 0);
			 			$this->db->where('user_id',$id);
			 			$updated_status = $this->db->update('password_history',$statusActiveArray);

			 			//insert password in password_history table
			 			$pwd_hash_array = array("user_id" => $id,"password_hash"=>$newPass);
			 			$res11 = $this->db->insert('password_history', $pwd_hash_array);

			 			$messge = array('message' => 'Password Change Successfully !');
			            $this->session->set_flashdata('item_success', $messge); 
			 			header('location:' . base_url() . "member/changeuserPassword");
						}
						
					}else{
						$messge = array('message' => 'Current Password do not match!');
						$this->session->set_flashdata('item_error', $messge);
						header('location:' . base_url() . "member/changeuserPassword");
			 		}	
				}else{
					$messge = array('message' => 'Invalid User Account !');
			        $this->session->set_flashdata('item_error', $messge); 
	                header('location:' . base_url() . "member/changeuserPassword");
		    	}
			}else{
					$error = array('status' => 0, "msg" =>'invalid Credentials.');
					redirect('../home/dashboard');
			}
		 }
    	}catch (Exception $e) {
			echo $e->getMessage();
			$error = array('status' => 0, "msg" => "Internal Server Error - Please try Later.","StatusCode"=> "NP001");
			$this->response($error, 200);	
		}
	}

	public function validatePassword()
    {
    	 
    	$id= $this->uri->segment(3);
		$resultPass = $this->authentication_model->validatePass($id,$newPass);
			if (in_array($checkPass, $pass_array)) {
    			echo "true";
			}else{
				echo "false";
			}	
			//echo "<pre>======"; print_r($resPassword['password_hash']);
	}
			
    	function getByZone(){
            $modelList = $this->member_model->getByZone();
            echo json_encode($modelList);
        }	
        
     public function htmlmailtest(){
       
    	 $data = array(
             'userName'=> 'Saurabh Gupta'
                 );
       // $body = $this->load->view('emails/testmail',$data,TRUE);
      //echo "<pre>====";  print_r($body); die();
      //$name          = $_REQUEST['name'];
                $phone = "8668582469";
				$to_email      = 'saurabh.gupta@nupay.co.in';
				//$feedback      = $_REQUEST['feedback'];
				$merchantName  = 'Saurabh Gupta';
				//$merchant_id   = $session_data['id'];
				//$customer_phone= $session_data['phone'];
				$message       ='User Added Successfully';
                $subject       ="$merchantName contact nupay for his query";
				//$subject1      ="$merchantName thanks for writing to us.";
    	sendMail($to_email, $message, $subject ,$from_email=NULL,$merchantName, $data);
    	sendMessageByFirstValue('91'.$phone,$message);
    }
	
}
