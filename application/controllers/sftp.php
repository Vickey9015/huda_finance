<?php

class Sftp extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_model');
$data  =array('is_logged_in'=>$this->session->userdata('logged_in'));
//        if(!$this->session->userdata('logged_in')){
//			redirect(base_url().'user/index');
//			
//		}
        $this->load->helper('url');
        $this->load->library('session');
		$this->load->library('upload');
		$this->load->model('import_model');
		$this->load->helper('common_helper');
		
        //$this->load->library('curl');
    }

 
    // import excel data
    public function readXls() {
$this->load->library('Classes/PHPExcel');
		$session_data = $this->session->all_userdata();
      file_get_contents('ssh2.sftp://user:huda@nupayonline.com:22/upload/Huda.xlsx');
	  print_r(file_get_contents); exit;
	  $connection = ssh2_connect('huda.nupayonline.com', 22);
ssh2_auth_password($connection, 'huda@nupayonline.com', 'password');
$sftp = ssh2_sftp($connection);
$stream = fopen("ssh2.sftp://$sftp/upload/Huda.xlsx", 'r');

}

public function testEmail(){
	sendMail('nitin.sinha@nupay.co.in');
}
}

