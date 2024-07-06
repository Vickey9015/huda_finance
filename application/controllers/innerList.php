<?php

class InnerList extends CI_Controller {

    function __construct() {
        $data =array();
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $data  =array('is_logged_in'=>$this->session->userdata('logged_in'));
        if(!$this->session->userdata('logged_in')){
			redirect(base_url().'user/index');
			
		}
        $this->load->model('user_model');
		$this->load->model('mandates_model');
        $this->load->model('approval_model');
        $this->load->model('releaser_model');
        $this->load->helper('url');
        $this->load->helper('common_helper');
        $this->load->library('session');
        //$this->load->library('curl');
        $zone_id = array();
		$session_data = $this->session->all_userdata();
		$this->approver_id=  $session_data['id'];
		$this->role_id = $session_data['role_id'];
		$zones = $session_data['zones'];
		$i = 0;
		foreach($zones as $zone){
			$zone_id[$i] = $zone['id'];
			$i += 1;
		}
		$this->zone_id = implode(",",$zone_id);
		
    }

 function InnerMandateList($ref_no){ 
    if(in_array($this->role_id, ['3','4','5','6','9'], TRUE)){ 
        $ref_no = trim($ref_no);
		$result              = $this->mandates_model->getInnerList($this->zone_id,$ref_no);
        $session_data        = $this->session->all_userdata();
		$data =array('result'=>$result,'session_data'=>$session_data);
		//echo "<pre>===="; print_r($data);exit;
		$this->load->view('layout/header', $data);
        $this->load->view('layout/topbar', $data);
		$this->load->view('layout/leftbar', $data);
		$this->load->view('innerMandateList',$data);
		//$this->load->view('layout/footer');
    }else{
        redirect(base_url());
    }
	}
function InnerReturnedList(){ 
    if(in_array($this->role_id, ['3','4','5','9'], TRUE)){ 		
		$result              = $this->mandates_model->getReturnAnnexure();
        $session_data        = $this->session->all_userdata();
		$data =array('result'=>$result,'session_data'=>$session_data);
		//echo "<pre>===="; print_r($data);exit;
		$this->load->view('layout/header', $data);
        $this->load->view('layout/topbar', $data);
		$this->load->view('layout/leftbar', $data);
		$this->load->view('innerReturnedList',$data);
		//$this->load->view('layout/footer');
    }else{
        redirect(base_url());
    }
	}

function editReturnList($id){
    if(in_array($this->role_id, ['3','4','5','9'], TRUE)){ 
		$data = array();
		
		$result             = $this->mandates_model->getInnerReturnedList($id);
                $result             =$result[0];
		$data =array('result'=>$result,'session_data'=>$session_data);
                //echo "<pre>===="; print_r($result);exit;
		$session_data = $this->session->all_userdata();
		$this->load->view('layout/header', $data);
                $this->load->view('layout/topbar', $data);
		$this->load->view('layout/leftbar', $data);
		$this->load->view('editReturnedList',$data);
    }else{
        redirect(base_url());
    }
	}
function updateReturned(){
    if(in_array($this->role_id, ['3','4','5','9'], TRUE)){ 
            if($this->form_validation->run('updateReturned')==FALSE){
                $data = '';
                $this->load->view('layout/header', $data);
                $this->load->view('layout/topbar', $data);
        		$this->load->view('layout/leftbar', $data);
        		$this->load->view('editReturnedList',$data);
            }else{
                 $id=$_REQUEST['id'];
				 $refString =$_REQUEST['customer_reference_number'];
                 if(strlen($refString)>12){
                     $newstring = substr($refString, -3,2);
                    $newstring1 = substr($refString, -1,1);
                    $concatString = $newstring.''.($newstring1+1);
                    $returnString=substr_replace($refString,$concatString,-3);
                 }else{
                     $returnString= $refString.'RI1';
                 }
				 $ReturnedArray =array(
					'beneficiary_name'                    =>$_REQUEST['beneficiary_name'],
					'ifsc_code'                           =>$_REQUEST['ifsc_code'],
					'account_number'                      =>$_REQUEST['account_number'],
					'mobile_number'                       =>$_REQUEST['mobile_number'],
					'customer_reference_number'           =>$returnString,
					'reference_number'                    =>$_REQUEST['reference_number'].'1',
					'file_name'                           =>$_REQUEST['file_name'].'1',
					'annexure_status'                     => 10,
					'is_resubmitted'                      => 1,
					'is_released'						  => 0
					);
			//	echo "<pre>=111=uuu"; print_r($_REQUEST); exit;
				$this->mandates_model->UpdateReturnedDetails($id,$ReturnedArray);
				$messge = array('message' => UPDATE_RETURNED_MESSAGE ,'class' => 'alert alert-success fade in');
                $this->session->set_flashdata('item',$messge);
				redirect('../returnedList/ReturnedList');
        }
    }else{
        redirect(base_url());
    }	
	}

function changeStatusAuth(){ 
	if(in_array($this->role_id, ['4'], TRUE)){ 
		$data =array();
		//$result              = $this->approval_model->getapprovalList();
        $session_data        = $this->session->all_userdata();
		//echo "<pre>===="; print_r($_REQUEST);
		$resultArray =array();
		if($_REQUEST['action'] =='reject'){
			$resultArray['annexure_status'] =4;
			$resultArray['rejected_on']            =date('Y-m-d H:i:s');
			$resultArray['reason']            =$_REQUEST['reason'];
		}else if($_REQUEST['action'] =='immediate'){
			$resultArray['annexure_status'] =3;
			$resultArray['authorised_on']            = date('Y-m-d H:i:s');
		}else{
			$resultArray['annexure_status'] =8; //in process to releaser
			$resultArray['authorised_on']            =date('Y-m-d H:i:s');
		}
		$data =array('session_data'=>$session_data);
		if(!empty($_REQUEST['reference_number'])){
			foreach($_REQUEST['reference_number'] as $key=>$value){
				
				
                                $resultArray['LAO_id']                   = $session_data['id'];
			        $resultArray['LOA_name']                 = $session_data['name'];
                    
				//echo "<pre>===="; print_r($resultArray);exit;
				     $result              = $this->approval_model->updateAnnexureStatus($value,$resultArray);
                                 
				
			}
			if($_REQUEST['action'] =='reject'){
		$messge = array('message' => REJECTED_MESSAGE ,'class' => 'alert alert-success fade in');
        $this->session->set_flashdata('item',$messge);
			redirect('../approvallist/approvalWaiting');
			}else if($_REQUEST['action'] =='immediate'){
		$messge = array('message' => "Records sent to releaser" ,'class' => 'alert alert-success fade in');
        $this->session->set_flashdata('item',$messge);
			redirect('../releaserApproval/waitingApproval');
			}else{
		$messge = array('message' => RELEASER_SUBMITED_MESSAGE ,'class' => 'alert alert-success fade in');
        $this->session->set_flashdata('item',$messge);
			redirect('../approvallist/approvalWaiting');
			}
			
		}
	    
	}else{
        redirect(base_url());
    }
      
	}

function changeStatusReleas(){ 
    if(in_array($this->role_id, ['5','9'], TRUE)){ 
	    //echo "<pre>===="; print_r($_REQUEST);
		$data =array();
		//$result              = $this->approval_model->getapprovalList();
        $session_data        = $this->session->all_userdata();
		//echo "<pre>===="; print_r($session_data);exit;
		$resultArray =array();
		$resultArray['reason']                 = $_REQUEST['reason'];
		$data =array('session_data'=>$session_data);
		if(!empty($_REQUEST['reference_number'])){
		        if($_REQUEST['action'] =='reject'){
					$resultArray['annexure_status'] =5;
					$resultArray['rejected_on']            = date('Y-m-d H:i:s');
			}else{
				$resultArray['annexure_status'] =9; //in process to disbursement
				$resultArray['released_on']            = date('Y-m-d H:i:s');
				$resultArray['uploaded_to_sftp_on']      = date('d-m-y');
			}
			foreach($_REQUEST['reference_number'] as $key=>$value){
				
				$resultArray['releaser_name']          = $session_data['name'];
                                $resultArray['releaser_id']            = $session_data['id'];
			        
				
				//echo "<pre>===="; print_r($resultArray);exit;
				 $result              = $this->releaser_model->updateStatus($value,$resultArray);

      }
if($_REQUEST['action'] =='reject'){
		$messge = array('message' => REJECTED_MESSAGE ,'class' => 'alert alert-success fade in');
        $this->session->set_flashdata('item',$messge);
       redirect('../releaserMandate/MandateList');	
			}	
			else{
		$messge = array('message' => DISBURSEMENT_SUBMITED_MESSAGE ,'class' => 'alert alert-success fade in');
        $this->session->set_flashdata('item',$messge);
	redirect('../releaserMandate/MandateList');			
			}	
			
		}
        
    }else{
        redirect(base_url());
    }
       
	}

}

?>
