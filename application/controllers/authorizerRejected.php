<?php

class AuthorizerRejected extends CI_Controller {

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
        $this->load->helper('url');
        $this->load->library('session');
                $this->load->helper('common_helper');
        //$this->load->library('curl');
    }

 function authRejectedList(){ 
		if(in_array($this->role_id, ['3','4','5','9'], TRUE)){
		$data =array();
		if(!empty($_POST)){
		        if($this->form_validation->run('date')==FALSE){
					    
					}else{
					//echo "<pre>====="; print_r($_POST); 
					$startDate          = $_POST['fromDate'];
					$toDate             = $_POST['toDate'];
					//echo "<pre>====";print_r($startDate); exit;
                    $annexure_type      = $_POST['annexure_type'];
                   // $annexure_staus     = $ann_status;
                    if(count($this->zones) == 1){
				        $zone_id = $this->zones[0]['id'];
				    }else{
				        foreach($this->zones as $zo){
                	        $zone_id.= $zo['id'].',';
                	        $i++;
                	    } 
						$zone_id = rtrim($zone_id,',');
				    }
					$result             = $this->mandates_model->getMandateList($zone_id,$startDate,$toDate,$annexure_type);
					}
				}else{
				    if(count($this->zones) == 1){
				        $zone_id = $this->zones[0]['id'];
				    }else{
				        foreach($this->zones as $zo){
                	        $zone_id.= $zo['id'].',';
                	        $i++;
                	    } 
						$zone_id = rtrim($zone_id,',');
				    }
				    $startDate          = date('Y-m-d');
					$toDate             = date('Y-m-d');
					$annexure_type      = $_POST['annexure_type'];
				    $result             = $this->mandates_model->getMandateList($zone_id,$startDate,$toDate,$annexure_type);
                }
                 $result['fromDate']=$startDate;
                 $result['toDate']=$toDate;
		$session_data = $this->session->all_userdata();
       // echopre($session_data); exit;
        $data =array('result'=>$result,'session_data'=>$session_data);
        $data['session_data'] = $session_data;
		$this->load->view('layout/header', $data);
        $this->load->view('layout/topbar', $data);
		$this->load->view('layout/leftbar', $data);
		$this->load->view('authRejected',$data);
		//$this->load->view('layout/footer');
		}else{
		    redirect(base_url());
		}
	}
	
	function innerRejectedList(){ 
		if(in_array($this->role_id, ['3','4','5','9'], TRUE)){
		$data =array();
		$session_data = $this->session->all_userdata();
        //echopre($session_data); exit;
        $data['session_data'] = $session_data;
		$this->load->view('layout/header', $data);
        $this->load->view('layout/topbar', $data);
		$this->load->view('layout/leftbar', $data);
		$this->load->view('innerRejectedList',$data);
		$this->load->view('layout/footer');
	}else{
		    redirect(base_url());
		}
	}

}

?>
