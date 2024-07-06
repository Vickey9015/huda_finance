<?php
class Zone extends CI_Controller {
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
		$this->role_id = $session_data['role_id'];
		$this->user_id = $session_data['id'];
		
        $this->load->model('zone_model');
        $this->load->helper('common_helper');
    }
    
    
	function addZone(){ 
		$data =array();
		if($this->role_id == 7){
    		$session_data = $this->session->all_userdata();
            $data['session_data'] = $session_data;
    		$this->load->view('layout/header', $data);
            $this->load->view('layout/topbar', $data);
       		$this->load->view('layout/leftbar', $data);
    		$this->load->view('addZone',$data);
    		$this->load->view('layout/footer');
		}else{
		    redirect('../user/login');
		}
	}
	
	function addZoneDetails(){
		//echo "<pre>=111="; print_r($_REQUEST); exit;
		if($this->role_id == 7){
		        if($this->form_validation->run('addZone')==FALSE){
		            $this->load->view('layout/header', $data);
                    $this->load->view('layout/topbar', $data);
               		$this->load->view('layout/leftbar', $data);
            		$this->load->view('addZone',$data);
            		$this->load->view('layout/footer');
		        }else{
				 $zoneArray =array(
					'name'                           =>strip_tags($_REQUEST['name']),
					'created_on'                     =>date('Y-m-d H:i:s')
					);
    			    //echo "<pre>=111=uuu"; print_r($UserArray); exit;
    				$id = $this->db->insert('zone_master', $zoneArray);
    				$insert_id = $this->db->insert_id();
    				//echo "<pre>=$insert_id"; print_r($zoneArray); exit;
    				$zoneAccountArray =array(
    					'zone_id'                   =>$insert_id,
    					'account_number'            =>strip_tags($_REQUEST['account_number'])
    					);
    				$id = $this->db->insert('account_master', $zoneAccountArray);
    				$messge = array('message' => ZONE_ADDED_MESSAGE ,'class' => 'alert alert-success fade in');
                    $this->session->set_flashdata('item',$messge);
                    redirect('../zone/zoneView');
		        }
		}else{
		    redirect(base_url());
		}
				
			
	}
	function zoneView(){
		try {
				$data =array();
				if($this->role_id == 7 or $this->role_id == 8){
				$session_data = $this->session->all_userdata();
				$id=  $session_data['id'];
				if(!empty($_POST)){
					//echo "<pre>====="; print_r($_POST); exit;
					if($this->form_validation->run('date')==FALSE){
					    
					}else{
    					$startDate          = $_POST['fromDate'];
    					$toDate             = $_POST['toDate'];
    					$result             = $this->zone_model->getZoneDetails($startDate,$toDate,$status);
					}
				}else{
					$result             = $this->zone_model->getZoneDetails();
				}
                               
				$data =array('result'=>$result,'session_data'=>$session_data);
			//	echo "<pre>====="; print_r($data); exit;
			    $this->load->view('layout/header', $data);
                $this->load->view('layout/topbar', $data);
   		        $this->load->view('layout/leftbar', $data);
				$this->load->view('zoneView', $data);
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
	
	function updateZone($id){
		$data = array();
		if($this->role_id == 7){
		$result             = $this->zone_model->getZoneList($id);
        $result             =$result[0];
		$session_data = $this->session->all_userdata();
		$data =array('result'=>$result,'session_data'=>$session_data);
		//echo "<pre>====="; print_r($data); exit;
		$this->load->view('layout/header', $data);
        $this->load->view('layout/topbar', $data);
   		$this->load->view('layout/leftbar', $data);
		$this->load->view('updateZone',$data);
		$this->load->view('layout/footer');
		}else{
		    if($this->role_id == 8){
		         redirect('../member/bankCheckerView');
		    }else{
		    redirect(base_url());
		    }
		}
	}
	function updateZoneDetails(){
	//	echo "<pre>===="; print_r($_REQUEST);exit;
	        if($this->role_id == 7){
	            if($this->form_validation->run('updateZoneDetails')==FALSE){
					    $data = '';
					    $this->load->view('layout/header', $data);
                        $this->load->view('layout/topbar', $data);
                   		$this->load->view('layout/leftbar', $data);
                		$this->load->view('updateZone',$data);
                		$this->load->view('layout/footer');
					}else{
		         $zoneid= $_REQUEST['zone_id'];
				 $id= $_REQUEST['accountMasterId'];
				 $ZoneUpdateArray =array(
					'zone_id'             =>$zoneid,
					'account_number'      =>strip_tags($_REQUEST['account_number'])
					);
				  $ZoneNameArray =array(
					'name'                =>strip_tags($_REQUEST['name']),
					'updated_on'          => date('Y-m-d H:i:s')
					);
			    $nameChange = $this->zone_model->checkName($zoneid);
			    if(!empty($nameChange) && $nameChange['name'] != $_REQUEST['name']){
    				$changeAuditArray = array(
    				        "maker_id"     => $this->user_id,
    				        "old_data"     => $nameChange['name'],
    				        "update_data_name" => "Zone Name",
    				        "update_data_column" => "name",
    				        "new_data"     => strip_tags($_REQUEST['name']),
    				        "reference_column"  => "id",
    				        "reference_id" => $zoneid,
    				        "type"         => 'zone_master'
    				    );	
    				$this->zone_model->addChangeAudit($changeAuditArray);
			    }
			    $accountChange = $this->zone_model->checkZoneAccountNumber($id);
			    if(!empty($accountChange) && $accountChange['account_number'] != $_REQUEST['account_number']){
    				$changeAuditArray1 = array(
    				        "maker_id"          => $this->user_id,
    				        "update_data_name" => "Account Number",
    				        "update_data_column" => "account_number",
    				        "old_data"          => $accountChange['account_number'],
    				        "new_data"          => strip_tags($_REQUEST['account_number']),
    				        "reference_id"      => strip_tags($_REQUEST['accountMasterId']),
    				        "reference_column"  => "id",
    				        "type"              => 'account_master'
    				    );	
    				$this->zone_model->addChangeAudit($changeAuditArray1);
			    }
				//$this->zone_model->UpdateZone($id,$zoneid,$ZoneUpdateArray,$ZoneNameArray);
			//	echo "<pre>=====$id"; print_r($ZoneUpdateArray); exit;
			//  $this->zone_model->UpdateZone($id,$zoneid,$ZoneUpdateArray,$ZoneNameArray);
				$messge = array('message' => ZONE_UPDATED_MESSAGE ,'class' => 'alert alert-success fade in');
                $this->session->set_flashdata('item',$messge);
				redirect('../zone/zoneView');
			    }
	        }else{
		         if($this->role_id == 8){
		         redirect('../member/bankCheckerView');
		    }else{
		    redirect(base_url());
		    }
		    }
	}
	
	function assignAccount(){ 
		$data =array();
		if($this->role_id == 7){
    		$session_data = $this->session->all_userdata();
            $data['session_data'] = $session_data;
    		$this->load->view('layout/header', $data);
            $this->load->view('layout/topbar', $data);
       		$this->load->view('layout/leftbar', $data);
    		$this->load->view('assignAccount',$data);
    		$this->load->view('layout/footer');
		}else{
		    redirect('../user/login');
		}
	}
	
	function assignAccountDetails(){
		//echo "<pre>=111="; print_r($_REQUEST); exit;
		if($this->role_id == 7){
		    $this->form_validation->set_rules('account_number', 'Account Number', 'trim|required|min_length[12]|max_length[12]|numeric');
		          $this->form_validation->set_rules('zone_id', 'Zone', 'trim|required|xss_clean|min_length[1]|max_length[2]|numeric');
		        if($this->form_validation->run()==FALSE){
		            $this->load->view('layout/header', $data);
                    $this->load->view('layout/topbar', $data);
               		$this->load->view('layout/leftbar', $data);
            		$this->load->view('assignAccount',$data);
            		$this->load->view('layout/footer');
		        }else{
    				$zoneAccountArray =array(
    					'zone_id'                   =>strip_tags($_REQUEST['zone_id']),
    					'account_number'            =>strip_tags($_REQUEST['account_number'])
    					);
    					//print_r($zoneAccountArray);die;
    				$id = $this->db->insert('account_master', $zoneAccountArray);
    				$messge = array('message' => ZONE_ADDED_MESSAGE ,'class' => 'alert alert-success fade in');
                    $this->session->set_flashdata('item',$messge);
                    redirect('../zone/zoneView');
		        }
		}else{
		    redirect(base_url());
		}
				
			
	}
	
	
}
