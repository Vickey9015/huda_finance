<?php

class ReleaserMandate extends CI_Controller {

    function __construct() {
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
		
        $this->load->model('user_model');
		$this->load->model('approval_model');
		$this->load->model('releaser_model');
		$this->load->model('mandates_model');
        $this->load->helper('url');
        $this->load->helper('common_helper');
        $this->load->library('session');
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
    }

 function MandateList(){ 
	if(in_array($this->role_id, ['3','4','5','9'], TRUE)){		
		$data =array();
                if(!empty($_POST)){
                    if($this->form_validation->run('date')==FALSE){
					    
					}else{
					//echo "<pre>====="; print_r($_POST); exit;
					$startDate          = $_POST['fromDate'];
					$toDate             = $_POST['toDate'];
					$result             = $this->mandates_model->getMandateList($this->zone_id,$startDate,$toDate);
					}
				}else{
				    $result              = $this->mandates_model->getMandateList($this->zone_id);
                }
		$session_data        = $this->session->all_userdata();
		$data =array('result'=>$result,'session_data'=>$session_data);
        //echopre($session_data); exit;
	//	$Name    = $session_data['name'];
		//echo "<pre>===="; print_r($data);exit;
      //  $data['session_data'] = $session_data;
		$this->load->view('layout/header', $data);
        $this->load->view('layout/topbar', $data);
		$this->load->view('layout/leftbar', $data);
		$this->load->view('releaserMandate',$data);
		//$this->load->view('layout/footer');
    }else{
		    redirect(base_url());
		}
	}

	function changeStatus(){ 
	    if(in_array($this->role_id, ['3','4','5','9'], TRUE)){	
	//echo "<pre>===="; print_r($_REQUEST);exit;
		$data =array();
		$result              = $this->releaser_model->getreleaserlList();
        $session_data        = $this->session->all_userdata();
		//echo "<pre>===="; print_r($session_data);exit;
		$resultArray =array();
		if($session_data['role_id'] ==4){
			$resultArray['releaser_id']            = $session_data['id'];
			//$resultArray['annexure_status']        = 7;
                        $resultArray['released_on']            =date('Y-m-d H:i:s');
		}
		$data =array('result'=>$result,'session_data'=>$session_data);
		if(!empty($_REQUEST['reference_number'])){
			foreach($_REQUEST['reference_number'] as $key=>$value){
				$resultArray['annexure_status'] =7;
                                $resultArray['releaser_id']            = $session_data['id'];
			        $resultArray['released_on']            = date('Y-m-d H:i:s');
				
				  $result              = $this->releaser_model->updateStatus($value,$resultArray);
                                  $messge = array('message' => APPROVED_SUBMITED_MESSAGE ,'class' => 'alert alert-success fade in');
        $this->session->set_flashdata('item',$messge);
                                  redirect('../releaserMandate/MandateList');
			}
			
		}
        //echopre($session_data); exit;
	//	$Name    = $session_data['name'];
		//echo "<pre>===="; print_r($data);exit;
      //  $data['session_data'] = $session_data;
		$this->load->view('layout/header', $data);
                $this->load->view('layout/topbar', $data);
		$this->load->view('layout/leftbar', $data);
		$this->load->view('releaserMandate',$data);
		$this->load->view('layout/footer');
	    }else{
		    redirect(base_url());
		}
	}

	
}

?>
