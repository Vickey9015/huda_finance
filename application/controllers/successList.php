<?php

class SuccessList extends CI_Controller {

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

 function InnerSuccessList(){ 
    if(in_array($this->role_id, ['3','4','5','9'], TRUE)){			
		$data =array();
		$session_data = $this->session->all_userdata();
        //echopre($session_data); exit;
        $data['session_data'] = $session_data;
		$this->load->view('layout/header', $data);
        $this->load->view('layout/topbar', $data);
		$this->load->view('layout/leftbar', $data);
		$this->load->view('innerSuccessList',$data);
		$this->load->view('layout/footer');
    }else{
		    redirect(base_url());
		}
	}
	
	function viewSuccess(){ 
	    if(in_array($this->role_id, ['3','4','5','6','9'], TRUE)){	
		$data =array();
		if(!empty($_POST)){
		        $this->form_validation->set_rules('fromDate', 'From Date', 'trim|required|min_length[10]|max_length[10]|valid_date');
		          $this->form_validation->set_rules('toDate', 'To Date', 'trim|required|min_length[10]|max_length[10]|valid_date');
		          $this->form_validation->set_rules('annexure_type', 'Annexure type', 'trim|min_length[1]|max_length[2]|numeric');
		              $this->form_validation->set_message('valid_date', 'The Date field must be dd-mm-yyyy');
		          $this->form_validation->set_error_delimiters('<div style="color:red">', '</div>');
		          $re = $this->form_validation->run(); 
		          //echo "<pre>====";print_r($_POST);print_r($re);die;
					//echo "<pre>====="; print_r($_POST); exit;
					if($re == FALSE){
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
					//echo "<pre>====="; print_r($_POST); exit;
					$startDate          = $_POST['fromDate'];
					$toDate             = $_POST['toDate'];
                    $annexure_type      = $_POST['annexure_type'];
                    
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
				        $result             = $this->mandates_model->getMandateList($zone_id,'');
				        //echo "<pre>"; print_r($result);die;
				        //$result2             = $this->mandates_model->getMandateListById('','',6);
                }
                //$result = array_merge((array)$result1,(array)$result2);
                //print_r($result);die;
		$session_data = $this->session->all_userdata();
       // echopre($session_data); exit;
        $data =array('result'=>$result,'session_data'=>$session_data);
        $data['session_data'] = $session_data;
		$this->load->view('layout/header', $data);
                $this->load->view('layout/topbar', $data);
		$this->load->view('layout/leftbar', $data);
		$this->load->view('successList',$data);
		//$this->load->view('layout/footer');
	}else{
		    redirect(base_url());
		}
	}

}

?>