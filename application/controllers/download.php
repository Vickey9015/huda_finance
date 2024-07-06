<?php

class Download extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_model');
$data  =array('is_logged_in'=>$this->session->userdata('logged_in'));
        if(!$this->session->userdata('logged_in')){
			redirect(base_url().'user/index');
			
		}
        $this->load->helper('url');
        $this->load->library('session');
		$this->load->library('upload');
		$this->load->model('import_model');
		$this->load->helper('common_helper');
        //$this->load->library('curl');
    }

 function Annexuredownload(){ 
		
		$data =array();
		$session_data = $this->session->all_userdata();
        //echopre($session_data); exit;
        $data['session_data'] = $session_data;
		$this->load->view('layout/header', $data);
        $this->load->view('layout/topbar', $data);
		$this->load->view('layout/leftbar', $data);
		$this->load->view('download',$data);
		$this->load->view('layout/footer');
	}

}

?>
