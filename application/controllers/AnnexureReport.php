<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AnnexureReport extends CI_Controller {

	  function __construct() {
        parent::__construct();
        $this->load->model('user_model');
$data  =array('is_logged_in'=>$this->session->userdata('logged_in'));
        if(!$this->session->userdata('logged_in')){
			redirect(base_url().'user/index');
			
		}
		$session_data = $this->session->all_userdata();
		$this->approver_id=  $session_data['id'];
		$this->role_id = $session_data['role_id'];
		
		// $this->load->model('Orginal_model');
		// $this->load->model('LowerCourt_model');
		
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('common_helper');
        //$this->load->library('curl');
        $this->zones = $session_data['zones'];
        foreach($this->zones as $zo){
	        $zone_id.= $zo['id'].',';
	        $i++;
	    }    
	    $this->zone_id = rtrim($zone_id,',');
    }

	
	function OriginalReport(){
		try {
		    if(in_array($this->role_id, ['5','6','9'], TRUE)){
				//print_r('expression');exit;
				$session_data = $this->session->all_userdata();
				$totalcount  =$this->TotalCount();
				$data =array('result'=>$result,'totalcount'=>$totalcount,'session_data'=>$session_data);
		         $this->load->view('layout/header');
			     $this->load->view('layout/topbar');
			     $this->load->view('layout/leftbar');
			     $this->load->view('ajax_original',$data);
			   // $this->load->view('layout/footer', $data);
		    }else{
		        redirect(base_url());
		    }
			} catch (Exception $e) {
				echo $e->getMessage();
				$error = array('status' => 0, "msg" => "Internal Server Error - Please try Later.","StatusCode"=> "NP001");
				$this->response($this->json($error), 200);	
		
		}
	}

	function TotalCount(){
			$select ="COUNT(a.id) AS total_record,
			  COUNT(CASE WHEN a.annexure_type = 1 THEN 1 ELSE NULL END) AS original,
			  COUNT(CASE WHEN a.annexure_type = 2 THEN 1 ELSE NULL END) AS lower_court,
			  COUNT(CASE WHEN a.annexure_type = 3 THEN 1 ELSE NULL END) AS high_court,
			  COUNT(CASE WHEN a.annexure_type = 4 THEN 1 ELSE NULL END) AS suprem_court,
			  COUNT(CASE WHEN a.annexure_type = 5 THEN 1 ELSE NULL END) AS dd,
			  COUNT(CASE WHEN a.annexure_type = 6 THEN 1 ELSE NULL END) AS original_dd,
			  COUNT(CASE WHEN a.annexure_type = 7 THEN 1 ELSE NULL END) AS lowercourt_dd,
			  COUNT(CASE WHEN a.annexure_type = 8 THEN 1 ELSE NULL END) AS highcourt_dd";
	        $this->db->select($select);
	        $this->db->from('annexure_temp a');
	        $this->db->where("a.zone_id in ($this->zone_id)");
	        $query = $this->db->get();
			// echo $this->db->last_query(); die;
	        return $query->result_array();
	}

	function LowerCourtReport(){
		try {
		    if(in_array($this->role_id, ['5','6','9'], TRUE)){
				//print_r('expression');exit;
				$session_data = $this->session->all_userdata();
				$totalcount  =$this->TotalCount();
				$data =array('result'=>$result,'totalcount'=>$totalcount,'session_data'=>$session_data);
		         $this->load->view('layout/header');
			     $this->load->view('layout/topbar');
			     $this->load->view('layout/leftbar');
			     $this->load->view('ajax_LowerCourt',$data);
			   // $this->load->view('layout/footer', $data);
		    }else{
		        redirect(base_url());
		    }
			} catch (Exception $e) {
				echo $e->getMessage();
				$error = array('status' => 0, "msg" => "Internal Server Error - Please try Later.","StatusCode"=> "NP001");
				$this->response($this->json($error), 200);	
		
		}
	}


	function HighCourtReport(){
		try {
		    if(in_array($this->role_id, ['5','6','9'], TRUE)){
				//print_r('expression');exit;
				$session_data = $this->session->all_userdata();
				$totalcount  =$this->TotalCount();
				$data =array('result'=>$result,'totalcount'=>$totalcount,'session_data'=>$session_data);
		         $this->load->view('layout/header');
			     $this->load->view('layout/topbar');
			     $this->load->view('layout/leftbar');
			     $this->load->view('ajax_HighCourt',$data);
			   // $this->load->view('layout/footer', $data);
		    }else{
		        redirect(base_url());
		    }
			} catch (Exception $e) {
				echo $e->getMessage();
				$error = array('status' => 0, "msg" => "Internal Server Error - Please try Later.","StatusCode"=> "NP001");
				$this->response($this->json($error), 200);	
		
		}
	}

	function SupremeCourtReport(){
		try {
		    if(in_array($this->role_id, ['5','6','9'], TRUE)){
				//print_r('expression');exit;
				$session_data = $this->session->all_userdata();
				$totalcount  =$this->TotalCount();
				$data =array('result'=>$result,'totalcount'=>$totalcount,'session_data'=>$session_data);
		         $this->load->view('layout/header');
			     $this->load->view('layout/topbar');
			     $this->load->view('layout/leftbar');
			     $this->load->view('ajax_SupremeCourt',$data);
			   // $this->load->view('layout/footer', $data);
		    }else{
		        redirect(base_url());
		    }
			} catch (Exception $e) {
				echo $e->getMessage();
				$error = array('status' => 0, "msg" => "Internal Server Error - Please try Later.","StatusCode"=> "NP001");
				$this->response($this->json($error), 200);	
		
		}
	}

	function DDReport(){
		try {
		    if(in_array($this->role_id, ['3','4','5','6','9'], TRUE)){
				//print_r('expression');exit;
				$session_data = $this->session->all_userdata();
				$totalcount  =$this->TotalCount();
				$data =array('result'=>$result,'totalcount'=>$totalcount,'session_data'=>$session_data);
		         $this->load->view('layout/header');
			     $this->load->view('layout/topbar');
			     $this->load->view('layout/leftbar');
			     $this->load->view('ajax_DDReport',$data);
			   // $this->load->view('layout/footer', $data);
		    }else{
		        redirect(base_url());
		    }
			} catch (Exception $e) {
				echo $e->getMessage();
				$error = array('status' => 0, "msg" => "Internal Server Error - Please try Later.","StatusCode"=> "NP001");
				$this->response($this->json($error), 200);	
		
		}
	}


	
function OriginalDDReport(){
		try {
		    if(in_array($this->role_id, ['3','4','5','6','9'], TRUE)){
				//print_r('expression');exit;
				$session_data = $this->session->all_userdata();
				$totalcount  =$this->TotalCount();
				$data =array('result'=>$result,'totalcount'=>$totalcount,'session_data'=>$session_data);
		         $this->load->view('layout/header');
			     $this->load->view('layout/topbar');
			     $this->load->view('layout/leftbar');
			     $this->load->view('ajax_OriginalDDReport',$data);
			   // $this->load->view('layout/footer', $data);
		    }else{
		        redirect(base_url());
		    }
			} catch (Exception $e) {
				echo $e->getMessage();
				$error = array('status' => 0, "msg" => "Internal Server Error - Please try Later.","StatusCode"=> "NP001");
				$this->response($this->json($error), 200);	
		
		}
	}
	

	function LCDDReport(){
		try {
		    if(in_array($this->role_id, ['3','4','5','6','9'], TRUE)){
				//print_r('expression');exit;
				$session_data = $this->session->all_userdata();
				$totalcount  =$this->TotalCount();
				$data =array('result'=>$result,'totalcount'=>$totalcount,'session_data'=>$session_data);
		         $this->load->view('layout/header');
			     $this->load->view('layout/topbar');
			     $this->load->view('layout/leftbar');
			     $this->load->view('ajax_LCDDReport',$data);
			   // $this->load->view('layout/footer', $data);
		    }else{
		        redirect(base_url());
		    }
			} catch (Exception $e) {
				echo $e->getMessage();
				$error = array('status' => 0, "msg" => "Internal Server Error - Please try Later.","StatusCode"=> "NP001");
				$this->response($this->json($error), 200);	
		
		}
	}
	function HCDDReport(){
		try {
		    if(in_array($this->role_id, ['3','4','5','6','9'], TRUE)){
				//print_r('expression');exit;
				$session_data = $this->session->all_userdata();
				$totalcount  =$this->TotalCount();
				$data =array('result'=>$result,'totalcount'=>$totalcount,'session_data'=>$session_data);
		         $this->load->view('layout/header');
			     $this->load->view('layout/topbar');
			     $this->load->view('layout/leftbar');
			     $this->load->view('ajax_HCDDReport',$data);
			   // $this->load->view('layout/footer', $data);
		    }else{
		        redirect(base_url());
		    }
			} catch (Exception $e) {
				echo $e->getMessage();
				$error = array('status' => 0, "msg" => "Internal Server Error - Please try Later.","StatusCode"=> "NP001");
				$this->response($this->json($error), 200);	
		
		}
	}

}
