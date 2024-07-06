<?php
class Action extends CI_Controller {
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
        $this->load->model('action_model');
        $this->load->helper('common_helper');
    }
    
    function pendingVerification(){
		try {
				$data =array();
    			if($this->role_id == 8){
				    $this->user_id;
    				$result = $this->action_model->getPendingActions();
    				$data   = array('result'=>$result,'session_data'=>$session_data);
    			//	echo "<pre>====="; print_r($data); exit;
    			    $this->load->view('layout/header', $data);
                    $this->load->view('layout/topbar', $data);
       		        $this->load->view('layout/leftbar', $data);
    				$this->load->view('pendingVerification', $data);
    			}else{
    			    redirect(base_url());
    			}
			} catch (Exception $e) {
				echo $e->getMessage();
				$error = array('status' => 0, "msg" => "Internal Server Error - Please try Later.","StatusCode"=> "NP001");
				$this->response($this->json($error), 200);	
		
		}
	}
	
	function approveChange($id){
		try {
				$data =array();
    			if($this->role_id == 8){
				    $this->user_id;
				    $status = 1;
				    $approveArray = array(
				            "checker_id" => $this->user_id,
				            "status"     => 1,
				            "updated_on" => date('Y-m-d H:i:s')
				        );
				        $isSuccess = 1;
    				//$isSuccess = $this->action_model->updatePendingActions($id,$approveArray);
    				if($isSuccess){
    				    $editData = $this->action_model->getPendingActionsById($id);
    				    $dataUpdateArray = array(
    				            $editData['update_data_column'] => $editData['new_data'],
    				            "updated_on"    => date('Y-m-d H:i:s')
    				        );
    				    $table  = $editData['type'];   
    				    $column = $editData['reference_column'];
    				    $where  = $editData['reference_id'];
    				    $changeResult = $this->action_model->checkChange($table,$editData['update_data_column'],$editData['new_data']); 
    				    //print_r($editData);die;
    				    if(empty($changeResult) && $editData['type'] != "user_zone_mapping"){
    				        $isSuccess = $this->action_model->updatePendingActions($id,$approveArray);
    				        $updateResult = $this->action_model->updateChange($table,$column,$where,$dataUpdateArray); 
    				        $msg = 'Change Request Approved';
    				    }
						else if($editData['type'] == "account_master"){
    				        $isSuccess = $this->action_model->updatePendingActions($id,$approveArray);
    				        $updateResult = $this->action_model->updateChange($table,$column,$where,$dataUpdateArray); 
    				        $msg = 'Change Request Approved';
    				    }
						else if($editData['type'] == "user_zone_mapping"){
    				        $this->db->where('user_id', $where);
                            $this->db->delete('user_zone_mapping');
							
                            if(strlen($editData['new_data']) > 1){
								$zone_value = explode(",",$editData['new_data']);
								foreach($zone_value as $values){
										$add_Zone = array("user_id" => $where,"zone_id"=>$values);
										$res11 = $this->db->insert('user_zone_mapping', $add_Zone);
										print_r($res11);
								}
							}else{
								$add_Zone = array("user_id" => $where,"zone_id"=>$editData['new_data']);
								$res11 = $this->db->insert('user_zone_mapping', $add_Zone);
							}
    				        $isSuccess = $this->action_model->updatePendingActions($id,$approveArray);
    				        $msg = 'Change Request Approved';
    				    }else{
    				        $msg = 'Data already exists';
    				    }
    				}
    				$data   = array('result'=>$result,'session_data'=>$session_data);
        			$messge = array('message' => $msg ,'class' => 'alert alert-success fade in');
                    $this->session->set_flashdata('item',$messge);
    				redirect('../action/pendingVerification');
    			}else{
    			    redirect(base_url());
    			}
			} catch (Exception $e) {
				echo $e->getMessage();
				$error = array('status' => 0, "msg" => "Internal Server Error - Please try Later.","StatusCode"=> "NP001");
				$this->response($this->json($error), 200);	
		
		}
	}
	
	function rejectChange($id){
		try {
				$data =array();
    			if($this->role_id == 8){
				    $this->user_id;
				    $status = 2;
				    $approveArray = array(
				            "checker_id" => $this->user_id,
				            "status"     => 2,
				            "updated_on" => date('Y-m-d H:i:s')
				        );
    				$isSuccess = $this->action_model->updatePendingActions($id,$approveArray);
    				/*if($isSuccess){
    				    $editData = $this->action_model->getPendingActionsById($id);
    				    $dataUpdateArray = array(
    				            $editData['update_data_column'] => $editData['new_data']
    				        );
    				    $table  =  $editData['type'];   
    				    $column = $editData['reference_column'];
    				    $where  = $editData['reference_id'];
    				    
    				    $updateResult = $this->action_model->updateChange($table,$column,$where,$dataUpdateArray); 
    				}*/
    				$data   = array('result'=>$isSuccess,'session_data'=>$session_data);
    			//	echo "<pre>====="; print_r($data); exit;
    			    $messge = array('message' => 'Change Request Rejected' ,'class' => 'alert alert-success fade in');
                    $this->session->set_flashdata('item',$messge);
    				redirect('../action/pendingVerification');
    			}else{
    			    redirect(base_url());
    			}
			} catch (Exception $e) {
				echo $e->getMessage();
				$error = array('status' => 0, "msg" => "Internal Server Error - Please try Later.","StatusCode"=> "NP001");
				$this->response($this->json($error), 200);	
		
		}
	}
}