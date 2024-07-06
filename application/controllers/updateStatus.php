<?php

class updateStatus extends CI_Controller {

    function __construct() {
        $data =array();
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $data  =array('is_logged_in'=>$this->session->userdata('logged_in'));
       
        $this->load->model('user_model');
        $this->load->model('authentication_model');        
        $this->load->helper('url');
        $this->load->helper('common_helper');
        $this->load->library('session');
        //$this->load->library('curl');
    }

 function update(){
	 $logArray =array(
                         'log'      => "cahange Status by Cron",
                         'request_type'=> "change by cron"
        );
        $this->db->insert('huda_request_log', $logArray);
		$id = $this->db->insert_id();
		$result = $this->authentication_model->updateInProcessStatus();
		$this->load->view('layout/footer');
	}
	
	function updateAuthorized(){
	 $logArray =array(
                         'log'      => "cahange Status by Cron",
                         'request_type'=> "change by cron"
        );
        //$this->db->insert('huda_request_log', $logArray);
		$id = $this->db->insert_id();
		$result = $this->authentication_model->updateAuthorizedStatus();
		$this->load->view('layout/footer');
	}
	
	function updateReleasedDD(){
	    //$tod = date('Y-m-d 17:45:00');
	    //print_r();
	 $logArray =array(
                         'log'      => "cahange Status by Cron",
                         'request_type'=> "change by cron"
        );
        //$this->db->insert('huda_request_log', $logArray);
		$id = $this->db->insert_id();
		$result = $this->authentication_model->updateInProcessToDisbursementStatus('DD');
		$this->load->view('layout/footer');
	}
	
	function updateReleasedNDD(){
	 $logArray =array(
                         'log'      => "cahange Status by Cron",
                         'request_type'=> "change by cron"
        );
        //$this->db->insert('huda_request_log', $logArray);
		$id = $this->db->insert_id();
		$result = $this->authentication_model->updateInProcessToDisbursementStatus('NDD');
		$this->load->view('layout/footer');
	}

}

?>
