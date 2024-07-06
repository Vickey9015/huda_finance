<?php
class Admin extends CI_Controller {
    public $data = array();
    
    public function __construct() {
        $data =array();
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $data  =array('is_logged_in'=>$this->session->userdata('logged_in'));
        if(!$this->session->userdata('logged_in')){
			redirect(base_url().'user/index');
			
		}
		$session_data = $this->session->all_userdata();
		$this->approver_id=  $session_data['id'];
		$this->role_id = $session_data['role_id'];
        $this->load->model('Bankmember_model');
        $this->load->model('authentication_model');
        $this->load->helper('common_helper');
    }
    
    
	function addBankMember(){ 
	    if($this->role_id == 6){
    		$data =array();
    		$session_data = $this->session->all_userdata();
            $data['session_data'] = $session_data;
    		$this->load->view('layout/header', $data);
            $this->load->view('layout/topbar', $data);
       		$this->load->view('layout/admin_leftbar', $data);
    		$this->load->view('addBankMember',$data);
    		$this->load->view('layout/footer');
	    }else{
		        redirect(base_url());
		    }
	}
	
	function addMemberDetails(){
		    if($this->role_id == 6){
		        if($this->form_validation->run('addMember')==FALSE){
		                $data = '';
					    $this->load->view('layout/header', $data);
                        $this->load->view('layout/topbar', $data);
                   		$this->load->view('layout/admin_leftbar', $data);
                		$this->load->view('addBankMember',$data);
                		$this->load->view('layout/footer');
					}else{
		         $session_data = $this->session->all_userdata();
		         $phone = $_REQUEST['phone'];
		         $email =$_REQUEST['email'];
		         $_REQUEST['zone_id'] =1;
		         $sql ="SELECT * FROM user a WHERE a.email='$email' OR a.phone='$phone'"; 
				 $resultquery   = $this->db->query($sql);  
				 
				 $result        = $resultquery->result_array();
				 //echo "<pre>=111=uuu"; print_r($result); exit;
		         if(!empty($result)){
		             
		            $messge = array('message' => 'Member Already exist on same Email or Phone.' ,'class' => 'alert alert-danger');
                    $this->session->set_flashdata('item',$messge); 
                    redirect('../admin/addBankMember');
		         }
		          $key = $this->config->item('encryption_key');
                //$password = $this->encrypt->encode($_REQUEST['password'], $key);
		        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
                $pass_str = substr(str_shuffle($chars),0,4);
                $_REQUEST['password']=H.$pass_str.'@'.rand(1111,9999);
                 $password = hash_hmac(ENCTYPE,$_REQUEST['password'], SHA512ENCKEY);
				 $UserArray =array(
					'name'                           =>strip_tags($_REQUEST['name']),
					'email'                          =>strip_tags($_REQUEST['email']),
					'phone'                          =>strip_tags($_REQUEST['phone']),
					'password'                       =>strip_tags($password),
					'role_id'                        =>strip_tags($_REQUEST['role_id']),
					'zone_id'                        =>strip_tags($_REQUEST['zone_id'])
					);
			//	echo "<pre>=111=uuu"; print_r($result); exit;
				$res = $this->db->insert('user', $UserArray);
				$insert_id = $this->db->insert_id();
				$pwd_hash_array = array("user_id" => $insert_id,"password_hash"=>$password);
				//$res = $this->db->insert('user', $UserArray);
				$res11 = $this->db->insert('password_history', $pwd_hash_array);
				$add_Zone = array("user_id" => $insert_id,"zone_id"=>$_REQUEST['zone_id']);
				//$res = $this->db->insert('user', $UserArray);
				$res11 = $this->db->insert('user_zone_mapping', $add_Zone);
				$messge = array('message' => MEMBER_ADDED_MESSAGE ,'class' => 'alert alert-success');
                $this->session->set_flashdata('item',$messge);
				redirect('../admin/bankmemberView');
		}
		    }else{
		        redirect(base_url());
		    }
			
	}
		function bankmemberView(){
		try {
		    if($this->role_id == 6){
				$data =array();
				$session_data = $this->session->all_userdata();
				$id=  $session_data['id'];
				/*if(!empty($_POST)){
					//echo "<pre>====="; print_r($_POST); exit;
					$startDate          = $_POST['fromDate'];
					$toDate             = $_POST['toDate'];
					
					$result             = $this->Bankmember_model->getMemberDetails($startDate,$toDate,$status);
				}else{*/
					$result             = $this->Bankmember_model->getMemberDetails();
				//}
                               
				$data =array('result'=>$result,'session_data'=>$session_data);
			//	echo "<pre>====="; print_r($data); exit;
			    $this->load->view('layout/header', $data);
                $this->load->view('layout/topbar', $data);
   		        $this->load->view('layout/admin_leftbar', $data);
				$this->load->view('bankmemberView', $data);
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
	
	function updateMember($id){
	    if($this->role_id == 6){
    		$data = array();
    		
    		$result             = $this->Bankmember_model->getMemberList($id);
            $result             =$result[0];
    		$data =array('result'=>$result,'session_data'=>$session_data);
                  //  echo "<pre>===="; print_r($data);exit;
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

	function updateBankMember($id){
	    if($this->role_id == 6){
		$data = array();
		
		$result             = $this->Bankmember_model->getMemberList($id);
        $result             =$result[0];
		$data =array('result'=>$result,'session_data'=>$session_data);
              //  echo "<pre>===="; print_r($data);exit;
		$session_data = $this->session->all_userdata();
		$this->load->view('layout/header', $data);
        $this->load->view('layout/topbar', $data);
   		$this->load->view('layout/admin_leftbar', $data);
		$this->load->view('updateBankMember',$data);
		$this->load->view('layout/footer');
	    }else{
		        redirect(base_url());
		    }
	}
			
	function updateMemberDetails(){
	    if($this->role_id == 6){
		         $id= $_REQUEST['id'];
				 $UserUpdateArray =array(
					'name'                           =>strip_tags($_REQUEST['name']),
				//	'email'                          =>$_REQUEST['email'],
				//	'phone'                          =>$_REQUEST['phone'],
				// 	'password'                       =>md5($_REQUEST['password']),
					'role_id'                        =>strip_tags($_REQUEST['role_id']),
				//	'zone_id'                        =>$_REQUEST['zone_id']
					);
				//echo "<pre>=111====$id"; print_r($UserUpdateArray); exit;
				$this->Bankmember_model->UpdateMember($id,$UserUpdateArray);
				// $pwd_hash_array = array("password_hash"=>md5($_REQUEST['password']));
				// $this->db->where('user_id',$id);   
			 //   $res11 = $this->db->update('password_history', $pwd_hash_array);
			    $add_Zone = array("zone_id"=>$_REQUEST['zone_id']);
				//$res = $this->db->insert('user', $UserArray);
				$this->db->where('user_id',$id);   
			    $res11 = $this->db->update('user_zone_mapping', $add_Zone);
				$messge = array('message' => MEMBER_UPDATED_MESSAGE ,'class' => 'alert alert-success fade in');
                $this->session->set_flashdata('item',$messge);
				redirect('../admin/bankmemberView');
	    }else{
		        redirect(base_url());
		    }
			}
	
	function updateStatus($id,$status){
		//echo "<pre>==$id"; print_r($status); exit;
				 if($status==1){
					$status=0;
				 }elseif($status==0){
					$status=1;
				 }
				 $UserUpdateArray =array(
					'is_active'       =>$status
					);
				// echo "<pre>==$id"; print_r($UserUpdateArray); exit;
				$this->Bankmember_model->UpdateMember($id,$UserUpdateArray);
				$messge = array('message' => MEMBER_STATUS_MESSAGE ,'class' => 'alert alert-success fade in');
                $this->session->set_flashdata('item',$messge);
				redirect('../admin/bankmemberView');
			}
	
	function deleteMember($id){
		//echo "<pre>==$id"; print_r($status); exit;
			if($this->role_id == 6){	
				 $UserUpdateArray =array(
					'is_active'       =>2
					);
				// echo "<pre>==$id"; print_r($UserUpdateArray); exit;
				$this->Bankmember_model->UpdateMember($id,$UserUpdateArray);
				$messge = array('message' => 'Member deleted successfully.' ,'class' => 'alert alert-success fade in');
                $this->session->set_flashdata('item',$messge);
				redirect('../admin/bankmemberView');
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
	    	$id            = strip_tags($this->uri->segment(3));
			$password      = strip_tags($this->input->post('password'));
			$confPassword  = strip_tags($this->input->post('confirm_password'));
			$newPass = md5($password);
			//  echo "<pre>======"; print_r($otp); exit;
			if(!empty($confPassword) and !empty($password)){
				$sql ="SELECT  a.id,a.name,a.email,a.phone FROM user a WHERE a.id='$id'"; 
				$resultquery   = $this->db->query($sql);     
				$result        = $resultquery->result_array();
			    //echo "<pre>======"; print_r($result); exit;
		        //check valid otp from user table
		        if(!empty($result)){     
		 			$id  = $result[0]['id'];
		 			$resultPass = $this->authentication_model->validatePass($id,$newPass);
		 			//echo "<pre>======"; print_r($resultPass); exit;
					//check last five password from password_history table
					if (!empty($resultPass)) {
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
			 			$pwd_hash_array = array("user_id" => $id,"password_hash"=>md5($password));
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
					$this->response($message, 200);
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
		  	$id            = strip_tags($this->uri->segment(3));
		  	$currentPassword      = strip_tags($this->input->post('current_password'));
			$password      = strip_tags($this->input->post('password'));
			$confPassword  = strip_tags($this->input->post('confirm_password'));
			$newPass = md5($currentPassword);
			$changePass = md5($password);
			//  echo "<pre>======"; print_r($otp); exit;
			if(!empty($confPassword) and !empty($id) and !empty($password) and !empty($currentPassword)){
				$sql ="SELECT  a.id,a.name,a.email,a.phone FROM user a WHERE a.id='$id'"; 
				$resultquery   = $this->db->query($sql);     
				$result        = $resultquery->result_array();
			    //echo "<pre>======"; print_r($result); exit;
		        //check valid user from user table
		        if(!empty($result)){
		 			$id  = $result[0]['id'];
		 			$resultPass = $this->authentication_model->validatePass($id,$newPass);
		 			//echo "<pre>======"; print_r($resultPass); exit;
					//check last five password from password_history table
					if (!empty($resultPass)) {
					    
					    $resultPassValid = $this->authentication_model->validatePass($id,$changePass);
						if (!empty($resultPassValid)) {
						$messge = array('message' => 'Password already used!');
						$this->session->set_flashdata('item_error', $messge);
						header('location:' . base_url() . "member/changeuserPassword");
						}else{
						//update password from user table
						$statusArray =array('password' => $changePass);
						$this->db->where('id',$id);
			 			$updated_id = $this->db->update('user',$statusArray);

			 			//update status 0 from password_history table
			 			$statusActiveArray = array('is_active' => 0);
			 			$this->db->where('user_id',$id);
			 			$updated_status = $this->db->update('password_history',$statusActiveArray);

			 			//insert password in password_history table
			 			$pwd_hash_array = array("user_id" => $id,"password_hash"=>md5($password));
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
					$this->response($message, 200);
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
	
}
