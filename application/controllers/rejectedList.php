<?php
error_reporting(0);
class RejectedList extends CI_Controller {

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

 function RejectedList(){ 
    if(in_array($this->role_id, ['3','4','5','6','9'], TRUE)){ 
		//print_r($this->zone_id);die;
		$data =array();
		$session_data = $this->session->all_userdata();
        //echopre($session_data); exit;
        if(!empty($_POST)){
                if($this->form_validation->run('date')==FALSE){
					    
					}else{
					//echo "<pre>====="; print_r($_POST); exit;
					$startDate          = $_POST['fromDate'];
					$toDate             = $_POST['toDate'];
                                        $annexure_type      = $_POST['annexure_type'];
					$result             = $this->mandates_model->getMandateList($this->zone_id,$startDate,$toDate,$annexure_type);
				}
				}else{
				    $startDate          = date('d-m-Y');
					$toDate             = date('d-m-Y');
					$result             = $this->mandates_model->getMandateList($this->zone_id,$startDate,$toDate);
                }
                $result['fromDate']=$startDate;
                $result['toDate']=$toDate;
		$session_data = $this->session->all_userdata();
        //echopre($session_data); exit;
        $data =array('result'=>$result,'session_data'=>$session_data);
        $data['session_data'] = $session_data;
		$this->load->view('layout/header', $data);
        $this->load->view('layout/topbar', $data);
		$this->load->view('layout/leftbar', $data);
		$this->load->view('rejectedList',$data);
		//$this->load->view('layout/footer');
    }else{
		    redirect(base_url());
		}	
	}
	function getRejectedListByStatus($anne_status){ 
    if(in_array($this->role_id, ['3','4','5','6','9'], TRUE)){ 
		//print_r($this->zone_id);die;
		$data =array();
		$session_data = $this->session->all_userdata();
        //echopre($session_data); exit;
        if(!empty($_POST)){
                if($this->form_validation->run('date')==FALSE){
					    
					}else{
					//echo "<pre>====="; print_r($_POST); exit;
					$startDate          = $_POST['fromDate'];
					$toDate             = $_POST['toDate'];
                    $annexure_type      = $_POST['annexure_type'];
                    $annexure_status      = $anne_status;
					$result             = $this->mandates_model->getMandateListByStatus($this->zone_id,$annexure_status,$startDate,$toDate,$annexure_type);
				}
				}else{
					 $annexure_status      = $anne_status;
					 $startDate          = date('d-m-Y');
					 $toDate             = date('d-m-Y');
				     $result             = $this->mandates_model->getMandateListByStatus($this->zone_id,$annexure_status,$startDate,$toDate);
                }
		$session_data = $this->session->all_userdata();
        //echopre($session_data); exit;
        $data =array('result'=>$result,'session_data'=>$session_data);
        $data['session_data'] = $session_data;
		$this->load->view('layout/header', $data);
        $this->load->view('layout/topbar', $data);
		$this->load->view('layout/leftbar', $data);
		$this->load->view('rejectedList',$data);
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
