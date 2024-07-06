<?php
error_reporting(0);
class Approvallist extends CI_Controller {

    function __construct() {
        $data =array();
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $data  =array('is_logged_in'=>$this->session->userdata('logged_in'));
        $session_data = $this->session->all_userdata();
		$this->approver_id=  $session_data['id'];
		$this->role_id = $session_data['role_id'];
        if(!$this->session->userdata('logged_in')){
			redirect(base_url().'user/index');
			
		}
        $this->load->model('user_model');
		$this->load->model('approval_model');
		$this->load->model('mandates_model');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('common_helper');
        
        //$this->load->library('curl');
        $zone_id = array();
		$session_data = $this->session->all_userdata();
		$zones = $session_data['zones'];
		$i = 0;
		foreach($zones as $zone){
			$zone_id[$i] = $zone['id'];
			$i += 1;
		}
		$this->zone_id = implode(",",$zone_id);
		date_default_timezone_set('Asia/Kolkata');
    }

 function approvalWaiting(){ 
		if(in_array($this->role_id, ['3','4','5','6','9'], TRUE)){
		$data =array();
            if(!empty($_POST)){
				  $this->form_validation->set_rules('fromDate', 'From Date', 'trim|required|min_length[10]|max_length[10]');
		          $this->form_validation->set_rules('toDate', 'To Date', 'trim|required|min_length[10]|max_length[10]');
		          $this->form_validation->set_rules('annexure_type', 'To Date', 'trim|max_length[1]');
		          $this->form_validation->set_error_delimiters('<div style="color:red">', '</div>');
		          $re = $this->form_validation->run(); 
					if($re == FALSE){
					}else{
					$startDate          = $_POST['fromDate'];
					$toDate             = $_POST['toDate'];
                                        $annexure_type      = $_POST['annexure_type'];
					$result             = $this->mandates_model->getMandateListWithoutResubmitted($this->zone_id,'',$startDate,$toDate,$annexure_type);
					}
				}else{
				    $startDate          = date('d-m-Y');
					$toDate             = date('d-m-Y');
				    $result             = $this->mandates_model->getMandateListWithoutResubmitted($this->zone_id,'',$startDate,$toDate);
                }
                 $result['fromDate']=$startDate;
                 $result['toDate']=$toDate;
        $session_data        = $this->session->all_userdata();
		$data =array('result'=>$result,'session_data'=>$session_data);
		$this->load->view('layout/header', $data);
        $this->load->view('layout/topbar', $data);
		$this->load->view('layout/leftbar', $data);
		$this->load->view('approvalwaiting',$data);
		}else{
		    redirect(base_url());
		}
	}

	function changeStatus(){
		try{
			if(in_array($this->role_id, ['3','4','5','9'], TRUE)){
				$data =array();
				$session_data = $this->session->all_userdata();
				$resultArray  = array();
				$data = array('session_data'=>$session_data);
				if(!empty($_REQUEST['reference_number'])){
					$resultArray['reason']                   = $_REQUEST['reason'];
					if($_REQUEST['action'] =='reject'){
						$resultArray['annexure_status'] = 4;
						$resultArray['rejected_on']     = date('Y-m-d H:i:s');
					} 
					else if($_REQUEST['action'] =='immediate'){
						$resultArray['annexure_status'] = 3;
						$resultArray['authorised_on']   = date('Y-m-d H:i:s');
					}
					else{
						$resultArray['annexure_status'] = 8;
						$resultArray['authorised_on']   = date('Y-m-d H:i:s');
					}
					$current_annexure_status = $_REQUEST['current_status'];
					foreach($_REQUEST['reference_number'] as $key=>$value){
						if($_REQUEST['action'] =='reject'){
							$resultArray['annexure_status'] = 4;
							$resultArray['rejected_on']     = date('Y-m-d H:i:s');
						}
						else if($_REQUEST['action'] =='immediate'){
							$resultArray['annexure_status'] = 3;
						}else{
							$resultArray['annexure_status'] = 8;
						}
						
						$resultArray['LAO_id']              = $session_data['id'];
						$resultArray['LOA_name']            = $session_data['name'];
						$result              = $this->approval_model->updateAnnexureStatusApprovalList($value,$resultArray,$current_annexure_status);
					}
				if($_REQUEST['action'] =='reject'){
					$messge = array('message' => REJECTED_MESSAGE ,'class' => 'alert alert-success fade in');
					$this->session->set_flashdata('item',$messge);
					redirect('../approvallist/approvalWaiting');
				}
				else if($_REQUEST['action'] =='immediate'){
					$messge = array('message' => "Records sent to releaser" ,'class' => 'alert alert-success fade in');
					$this->session->set_flashdata('item',$messge);
					redirect('../releaserApproval/waitingApproval');
				}else{
					$messge = array('message' => RELEASER_SUBMITED_MESSAGE ,'class' => 'alert alert-success fade in');
					$this->session->set_flashdata('item',$messge);
					redirect('../approvallist/approvalWaiting');
				}	
			}else{
				throw new Exception('Unable to process your request.');
			}
			}else{
				throw new Exception('Cannot update records.');
				redirect(base_url());
			}
		}catch (Exception $e) {
		  var_dump($e->getMessage());
		}
	}



	function changeReleaserStatus(){ 
		try{
			if(in_array($this->role_id, ['3','4','5','9'], TRUE)){
				$data =	array();
				$session_data = $this->session->all_userdata();
				$resultArray  = array();
				$data =array('session_data'=>$session_data);
				if($_REQUEST['action'] =='reject'){
					$resultArray['annexure_status'] =5;
					$resultArray['uploaded_to_sftp_on']      = date('d-m-y');
					$messge = array('message' => REJECTED_MESSAGE ,'class' => 'alert alert-success fade in');
					$this->session->set_flashdata('item',$messge);
					$redirectUrl =base_url().'rejectedList/RejectedList';
				}else{
					$resultArray['annexure_status'] =9;
					$resultArray['uploaded_to_sftp_on']      = date('d-m-y');
					$messge = array('message' => APPROVED_MESSAGE ,'class' => 'alert alert-success fade in');
					$this->session->set_flashdata('item',$messge);
					$redirectUrl =base_url().'releaserApproval/approved';
				}
				$current_annexure_status = $_REQUEST['current_status'];
				if(!empty($_REQUEST['reference_number'])){
					foreach($_REQUEST['reference_number'] as $key=>$value){
						$resultArray['releaser_id']              = $session_data['id'];
						$resultArray['releaser_name']            = $session_data['name'];
						if($resultArray['annexure_status'] == 9){
							$resultArray['released_on'] = date('Y-m-d H:i:s');
							$resultArray['uploaded_to_sftp_on']  = date('d-m-y');
						}else{
							$resultArray['rejected_on'] = date('Y-m-d H:i:s');
						}
						$resultArray['reason']                   = $_REQUEST['reason'];
						$result                                  = $this->approval_model->updateAnnexureStatusApprovalList($value,$resultArray,$current_annexure_status);	
					}
					redirect($redirectUrl);
				}
				if($_REQUEST['action'] =='reject'){
					$messge = array('message' => REJECTED_MESSAGE ,'class' => 'alert alert-success fade in');
					$this->session->set_flashdata('item',$messge);
					redirect('../mandatesList/InProcessToDisbursement');
				}
			}else{
				throw new Exception('Unable to process your request.');
				redirect(base_url());
			}
		}catch (Exception $e) {
			var_dump($e->getMessage());
		}       
	}
}



?>
