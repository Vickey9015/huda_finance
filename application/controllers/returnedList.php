<?php
error_reporting(0);
class ReturnedList extends CI_Controller {

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
		$this->zones = $session_data['zones'];
        $this->load->model('user_model');
        $this->load->model('mandates_model');
        $this->load->helper('url');
        $this->load->helper('common_helper');
        $this->load->library('session');
        //$this->load->library('curl');
    }

 function InnerReturnedList(){ 
	if(in_array($this->role_id, ['3','4','5','9'], TRUE)){		
		$data =array();
		$session_data = $this->session->all_userdata();
        //echopre($session_data); exit;
        $data['session_data'] = $session_data;
		$this->load->view('layout/header', $data);
        $this->load->view('layout/topbar', $data);
		$this->load->view('layout/leftbar', $data);
		$this->load->view('innerReturnedList',$data);
		$this->load->view('layout/footer');
	}else{
		    redirect(base_url());
		}
	}
	
	function ReturnedList(){ 
		if(in_array($this->role_id, ['3','4','5','6','9'], TRUE)){	
		$data =array();
		if(!empty($_POST)){
		    
		          $this->form_validation->set_rules('fromDate', 'From Date', 'trim|required|min_length[10]|max_length[10]|valid_date');
		          $this->form_validation->set_rules('toDate', 'To Date', 'trim|required|min_length[10]|max_length[10]|valid_date');
		          $this->form_validation->set_rules('annexure_type', 'Annexure type', 'trim|min_length[1]|max_length[2]|numeric');
		          $this->form_validation->set_error_delimiters('<div style="color:red">', '</div>');
		          $re = $this->form_validation->run(); 
		          //echo "<pre>====";print_r($_POST);print_r($re);die;
					//echo "<pre>====="; print_r($this->zones); exit;
					if($re == FALSE){
					}else{
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
                        $zone_id = rtrim($zone_id,',');
				    }
				    $result             = $this->mandates_model->getMandateList($zone_id,$startDate,$toDate,$annexure_type);
					}
				//echo "<pre>"; print_r($result);die;
					//$result2             = $this->mandates_model->getMandateListById($startDate,$toDate,$annexure_type,6);
					
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
				   $startDate          = date('d-m-Y');
				   $toDate             = date('d-m-Y');
					//$toDate             = $_POST['toDate'];
				    //print_r($zone_id);die;
				       $result             = $this->mandates_model->getMandateList($zone_id,$startDate,$toDate);
				        //echo "<pre>"; print_r($result);die;
				        //$result2             = $this->mandates_model->getMandateListById('','',6);
                }
                //$result = array_merge((array)$result1,(array)$result2);
                //print_r($result);die;
                $result['fromDate']=$startDate;
                $result['toDate']=$toDate;
		$session_data = $this->session->all_userdata();
       // echopre($session_data); exit;
        $data =array('result'=>$result,'session_data'=>$session_data);
        $data['session_data'] = $session_data;
		$this->load->view('layout/header', $data);
                $this->load->view('layout/topbar', $data);
		$this->load->view('layout/leftbar', $data);
		$this->load->view('ReturnedList',$data);
		//$this->load->view('layout/footer');
		}else{
		    redirect(base_url());
		}
	}
	
	function FailedList(){ 
		if(in_array($this->role_id, ['3','4','5','9'], TRUE)){	
		$data =array();
		if(!empty($_POST)){
		    
		          $this->form_validation->set_rules('fromDate', 'From Date', 'trim|required|min_length[10]|max_length[10]|valid_date');
		          $this->form_validation->set_rules('toDate', 'To Date', 'trim|required|min_length[10]|max_length[10]|valid_date');
		          $this->form_validation->set_rules('annexure_type', 'Annexure type', 'trim|min_length[1]|max_length[2]|numeric');
		          $this->form_validation->set_error_delimiters('<div style="color:red">', '</div>');
		          $re = $this->form_validation->run(); 
		          //echo "<pre>====";print_r($_POST);print_r($re);die;
					//echo "<pre>====="; print_r($this->zones); exit;
					if($re == FALSE){
					}else{
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
                        $zone_id = rtrim($zone_id,',');
				    }
				    //$result             = $this->mandates_model->getMandateList($zone_id,$startDate,$toDate,$annexure_type);
				    $result             = $this->mandates_model->getFailedMandateList($zone_id,$startDate,$toDate,$annexure_type);
					}
				//echo "<pre>"; print_r($result);die;
					//$result2             = $this->mandates_model->getMandateListById($startDate,$toDate,$annexure_type,6);
					
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
				    //print_r($zone_id);die;
				       // $result             = $this->mandates_model->getMandateList($zone_id,'');
				        $result             = $this->mandates_model->getFailedMandateList($zone_id,$startDate,$toDate,$annexure_type);
				        //echo "<pre>"; print_r($result);die;
				        //$result2             = $this->mandates_model->getMandateListById('','',6);
                }
                //$result = array_merge((array)$result1,(array)$result2);
                //print_r($result);die;
		$session_data = $this->session->all_userdata();
        //echo pre($session_data); exit;
        $data =array('result'=>$result,'session_data'=>$session_data);
        $data['session_data'] = $session_data;
		$this->load->view('layout/header', $data);
                $this->load->view('layout/topbar', $data);
		$this->load->view('layout/leftbar', $data);
		$this->load->view('FailedList',$data);
		//$this->load->view('layout/footer');
		}else{
		    redirect(base_url());
		}
	}

}

?>
