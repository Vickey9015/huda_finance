<?php

class Pulledback extends CI_Controller {

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
        $this->load->model('mandates_model');        
        $this->load->helper('url');
        $this->load->helper('common_helper');
        $this->load->library('session');
        //$this->load->library('curl');
    }

 function pulledlist(){ 
	if(in_array($this->role_id, ['3','4','5','9'], TRUE)){	
		$data =array();
		if(!empty($_POST)){
		    if($this->form_validation->run('date')==FALSE){
					    
					}else{
					//echo "<pre>====="; print_r($_POST); exit;
					$startDate          = $_POST['fromDate'];
					$toDate             = $_POST['toDate'];
					$result             = $this->mandates_model->getMandateListById($startDate,$toDate,5);
				}
				}else{
				        $result             = $this->mandates_model->getMandateListById('','',5);
                }
		$session_data = $this->session->all_userdata();
        //echopre($session_data); exit;
        $data =array('result'=>$result,'session_data'=>$session_data);
        //echopre($session_data); exit;
        $data['session_data'] = $session_data;
		$this->load->view('layout/header', $data);
        $this->load->view('layout/topbar', $data);
		$this->load->view('layout/leftbar', $data);
		$this->load->view('PulledList',$data);
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
