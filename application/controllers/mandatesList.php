<?php
error_reporting(0);
class MandatesList extends CI_Controller {

    function __construct() {
        $data =array();
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
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

 function MandatesList(){ 
	if(in_array($this->role_id, ['3','4','5','6','9'], TRUE)){	
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
					//echo "<pre>====="; print_r($_POST); exit;
					$this->form_validation->set_rules('fromDate', 'From Date', 'trim|required|min_length[10]|max_length[10]|valid_date');
		          $this->form_validation->set_rules('toDate', 'To Date', 'trim|required|min_length[10]|max_length[10]|valid_date');
		          $this->form_validation->set_rules('annexure_type', 'Annexure type', 'trim|min_length[1]|max_length[2]');
		              $this->form_validation->set_message('valid_date', 'The Date field must be dd-mm-yyyy');
		          $this->form_validation->set_error_delimiters('<div style="color:red">', '</div>');
		          $re = $this->form_validation->run(); 
		          //echo "<pre>====";print_r($_POST);print_r($re);die;
					//echo "<pre>====="; print_r($_POST); exit;
					if($re == FALSE){
					}else{
					$startDate          = $_POST['fromDate'];
					$toDate             = $_POST['toDate'];
                                        $annexure_type      = $_POST['annexure_type'];
					$result             = $this->mandates_model->getMandateList($zone_id,$startDate,$toDate,$annexure_type);
					}
					//echo "<pre>===="; print_r($result);exit;
				}else{
					$startDate          = date('d-m-Y');
					$toDate             = date('d-m-Y');
				    $result             = $this->mandates_model->getMandateList($zone_id,$startDate,$toDate);
				   // echo "<pre>===="; print_r($result);exit;
                }
                $result['fromDate']=$startDate;
                $result['toDate']=$toDate;
		
        
		$data =array('result'=>$result,'session_data'=>$session_data);
		//echo "<pre>===="; print_r($data);exit;
		$this->load->view('layout/header', $data);
        $this->load->view('layout/topbar', $data);
		$this->load->view('layout/leftbar', $data);
		$this->load->view('mandatesList',$data);
		//$this->load->view('layout/footer');
	}else{
	    redirect(base_url());
	}
	}

 function InProcessToReleaser(){ 
	if(in_array($this->role_id, ['3','4','5','9'], TRUE)){		
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
		
        
		$data =array('result'=>$result,'session_data'=>$session_data);
		//echo "<pre>===="; print_r($data);exit;
		$this->load->view('layout/header', $data);
        $this->load->view('layout/topbar', $data);
		$this->load->view('layout/leftbar', $data);
		$this->load->view('inProcessToReleaser',$data);
		//$this->load->view('layout/footer');
	}else{
	    redirect(base_url());
	}
	}
	
 function InProcessToDisbursement(){ 
	if(in_array($this->role_id, ['3','4','5','6','9'], TRUE)){		
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
		
        
		$data =array('result'=>$result,'session_data'=>$session_data);
		//echo "<pre>===="; print_r($data);exit;
		$this->load->view('layout/header', $data);
        $this->load->view('layout/topbar', $data);
		$this->load->view('layout/leftbar', $data);
		$this->load->view('inProcessToDisbursement',$data);
		//$this->load->view('layout/footer');
	}else{
	    redirect(base_url());
	}
	}	
	
 function reInitiated(){ 
	if(in_array($this->role_id, ['3','4','5','6','9'], TRUE)){		
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
					$result             = $this->mandates_model->getReInitiatedList($zone_id,$startDate,$toDate,$annexure_type);
					}
				}else{
					$startDate          = date('d-m-Y');
					$toDate             = date('d-m-Y');
				    $result             = $this->mandates_model->getReInitiatedList($zone_id,$startDate,$toDate);
                }
                $result['fromDate']=$startDate;
                $result['toDate']=$toDate;
		
        
		$data =array('result'=>$result,'session_data'=>$session_data);
		//echo "<pre>===="; print_r($data);exit;
		$this->load->view('layout/header', $data);
        $this->load->view('layout/topbar', $data);
		$this->load->view('layout/leftbar', $data);
		$this->load->view('reInitiated',$data);
		//$this->load->view('layout/footer');
	}else{
	    redirect(base_url());
	}
	}	

}

?>
