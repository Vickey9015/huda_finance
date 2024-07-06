<?php
error_reporting(0);
class UncUploadSheet extends CI_Controller {

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

 function UncUploadSheet(){ 
		
		$data =array();
		$session_data = $this->session->all_userdata();
        //print_r($session_data); exit;
        $data['session_data'] = $session_data;
		$this->load->view('layout/header', $data);
        $this->load->view('layout/topbar', $data);
		$this->load->view('layout/unleftbar', $data);
        $this->load->view('uncUploadSheet',$data);
		$this->load->view('layout/footer');
	}
	


	
	public function findDublicateRecord($checkSum){
	
	        $sql ="SELECT a.serial_no FROM annexure_temp a WHERE a.check_sum='$checkSum' and a.annexure_status not in (4,5)";
                $sqlquery   = $this->db->query($sql);
    		return $result        = $sqlquery->result_array();
	
	}

}

?>
