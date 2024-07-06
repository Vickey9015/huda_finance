<?php
error_reporting(0);
class ReleaserReturned extends CI_Controller {

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
		$this->zones = $session_data['zones'];
        $this->load->model('user_model');
		$this->load->model('mandates_model');
		$this->load->model('releaser_model');
        $this->load->helper('url');
        $this->load->helper('common_helper');
        $this->load->library('session');
        //$this->load->library('curl');
    }

 function ReturnedList(){ 
	if(in_array($this->role_id, ['3','4','5','6','9'], TRUE)){	
		$data =array();
	//	$result              = $this->releaser_model->getreleaserlList();
        $session_data        = $this->session->all_userdata();
		if(!empty($_POST)){
		        if($this->form_validation->run('date')==FALSE){
					    
					}else{
    					
    					//echo "<pre>====="; print_r($zones); exit;die;
    					$startDate          = $_POST['fromDate'];
    					$toDate             = $_POST['toDate'];
                        $annexure_type      = $_POST['annexure_type'];
                        if(count($this->zones) == 1){
    				        $zone_id = $this->zones[0]['id'];
    				    }else{
    				        foreach($this->zones as $zo){
                    	        $zone_id.= $zo['id'].',';
                    	        $i++;
                    	    } 
    					$result             = $this->mandates_model->getMandateList($zone_id,$startDate,$toDate,$annexure_type);
    				    }
					}
				}else{
					$startDate          = date('d-m-Y');
					$toDate             = date('d-m-Y');
				    if(count($this->zones) == 1){
				        $zone_id = $this->zones[0]['id'];
				    }else{
				        foreach($this->zones as $zo){
                	        $zone_id.= $zo['id'].',';
                	        $i++;
                	    } 
                        $zone_id = rtrim($zone_id,',');
				    }
				   $result             = $this->mandates_model->getMandateList($zone_id,$startDate,$toDate);
                }
                 $result['fromDate']=$startDate;
                $result['toDate']=$toDate;
		
        $session_data = $this->session->all_userdata();
		$data =array('result'=>$result,'session_data'=>$session_data);
		$this->load->view('layout/header', $data);
        $this->load->view('layout/topbar', $data);
		$this->load->view('layout/leftbar', $data);
		//$this->load->view('releaserReturned',$data);
		$this->load->view('ReturnedList',$data);
		//$this->load->view('layout/footer');
	}else{
		    redirect(base_url());
		}
	}

	
	
}

?>
