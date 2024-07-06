<?php

class MasterView extends CI_Controller {

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
        $this->load->library('session');
                $this->load->helper('common_helper');
        //$this->load->library('curl');
    }

 function MasterView(){ 
    if($this->role_id == 5 or $this->role_id == 6 or $this->role_id == 9){ 
		$recordArray =array();
		$data =array();
		$zone_id = array();
		$session_data = $this->session->all_userdata();
		$zones = $session_data['zones'];
		$i = 0;
		foreach($zones as $zone){
			$zone_id[$i] = $zone['id'];
			$i += 1;
		}
		$zone_id = implode(",",$zone_id);
		if(!empty($_POST)){
		    if($this->form_validation->run('date')==FALSE){
					    
					}else{
			//echo "<pre>====="; print_r($_POST); exit;
			$startDate          = $_POST['fromDate'];
			$toDate             = $_POST['toDate'];
								$annexure_type      = $_POST['annexure_type'];
			$result             = $this->mandates_model->getMandateList($zone_id,$startDate,$toDate,$annexure_type);
		}
		}else{
			$result             = $this->mandates_model->getMandateList($zone_id);
		}
		
		$sql ="SELECT  id,name from zone_master order by id ASC";
		$resultquery         = $this->db->query($sql);
		$zonesValues         = $resultquery->result_array();
		foreach($zonesValues as $key=>$value){
		    $zone_array[$value['id']]  =$value['name'];
		}
		
		$waitingForLAO          =$this->mandates_model->getWaitingForLAO();
		$waitingForReleaser     =$this->mandates_model->getWaitingForReleaser();
		$rejectedByLAO          =$this->mandates_model->getRejectedByLAO();
		$rejectedByReleaser     =$this->mandates_model->getRejectedByReleaser();
		$releasedTxn            =$this->mandates_model->getReleasedTxn();
		$rturnedTxn             =$this->mandates_model->getReturnedTxn();
		$successTxn             =$this->mandates_model->getSuccessTxn();
		$reinitiated             =$this->mandates_model->getReinitiatedTxn();
		
		$recordArray['waitingForLAO']             = $waitingForLAO;
		$recordArray['waitingForReleaser']             = $waitingForReleaser;
		$recordArray['rejectedByLAO']             = $rejectedByLAO;
		$recordArray['rejectedByReleaser']             = $rejectedByReleaser;
		$recordArray['releasedTxn']             = $releasedTxn;
		$recordArray['rturnedTxn']             = $rturnedTxn;
		$recordArray['successTxn']             = $successTxn;
		$recordArray['reinitiated']             = $reinitiated;
        //echo "<pre>===="; print_r($result);exit;
		$data =array('result'=>$result,'session_data'=>$session_data,'recordArray'=>$recordArray,'zones'=>$zone_array);
		//echo "<pre>===="; print_r($data);exit;
		$this->load->view('layout/header', $data);
                $this->load->view('layout/topbar', $data);
		$this->load->view('layout/leftbar', $data);
		$this->load->view('master_view',$data);
		//$this->load->view('layout/footer');
    }else{
		    redirect(base_url());
		}
	}

}

?>
