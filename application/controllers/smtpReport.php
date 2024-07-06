<?php

class SmtpReport extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_model');
		$this->load->model('annexure_model');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('common_helper');
        //$this->load->library('curl');
    }


function SMTPOriginalReport(){
		try {
				$data =array();
                                if(!empty($_POST)){
					
					$startDate          = $_POST['fromDate'];
					$toDate             = $_POST['toDate'];
                                        $annexure_status    = $_POST['annexure_status'];
                                        $Date               = $_POST['Date'];
                                        $zone               = $_POST['zone_id'];
           $result             = $this->annexure_model->getOrignallist($startDate,$toDate,$annexure_status,$Date,$zone);
				}else{
				    $result             = $this->annexure_model->getOrignallist();
                }
                               $session_data = $this->session->all_userdata();
                                $totalcount  =$this->TotalCount();
				$data =array('result'=>$result,'totalcount'=>$totalcount,'session_data'=>$session_data,'post_data'=>$_POST);
				//echo "<pre>====="; print_r($data); exit;
		            $this->load->view('layout/header', $data);
			    $this->load->view('layout/topbar', $data);
			    $this->load->view('layout/leftbar', $data);
			    $this->load->view('SmtporiginalReport', $data);
			   // $this->load->view('layout/footer', $data);
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
  COUNT(CASE WHEN a.annexure_type = 5 THEN 1 ELSE NULL END) AS dd";
        $this->db->select($select);
        $this->db->from('annexure_temp a');
        $query = $this->db->get();
		//echo $this->db->last_query(); die;
        return $query->result_array();
		
	}

	function SMTPHighCourtReport(){
		try {
				$data =array();
                                if(!empty($_POST)){
					//echo "<pre>====="; print_r($_POST); exit;
					$startDate          = $_POST['fromDate'];
					$toDate             = $_POST['toDate'];
                                        $annexure_status      = $_POST['annexure_status'];
                                        $Date               = $_POST['Date'];
                                        $zone               = $_POST['zone_id'];
           $result             = $this->annexure_model->getHighCourtlist($startDate,$toDate,$annexure_status,$Date,$zone);
				}else{
				    $result             = $this->annexure_model->getHighCourtlist();
                }
			$totalcount  =$this->TotalCount();	
                $session_data = $this->session->all_userdata();
				$data =array('result'=>$result,'totalcount'=>$totalcount,'session_data'=>$session_data);
				//echo "<pre>====="; print_r($data); exit;
				$this->load->view('layout/header', $data);
			    $this->load->view('layout/topbar', $data);
			    $this->load->view('layout/leftbar', $data);
			    $this->load->view('SmtphighCourtReport', $data);
			   // $this->load->view('layout/footer', $data);
			} catch (Exception $e) {
				echo $e->getMessage();
				$error = array('status' => 0, "msg" => "Internal Server Error - Please try Later.","StatusCode"=> "NP001");
				$this->response($this->json($error), 200);	
		
		}
	}
	
	function SMTPLowCourtReport(){
		try {
				$data =array();
                           if(!empty($_POST)){
					//echo "<pre>====="; print_r($_POST); exit;
					$startDate          = $_POST['fromDate'];
					$toDate             = $_POST['toDate'];
                                        $annexure_status      = $_POST['annexure_status'];
                                        $Date               = $_POST['Date'];
                                        $zone               = $_POST['zone_id'];
           $result             = $this->annexure_model->getLowercourtlist($startDate,$toDate,$annexure_status,$Date,$zone);
				}else{
				    $result             = $this->annexure_model->getLowercourtlist();
                }
                $session_data = $this->session->all_userdata();
                             $totalcount  =$this->TotalCount();	
				$data =array('result'=>$result,'totalcount'=>$totalcount,'session_data'=>$session_data);
				//echo "<pre>====="; print_r($data); exit;
				$this->load->view('layout/header', $data);
			    $this->load->view('layout/topbar', $data);
			    $this->load->view('layout/leftbar', $data);
			    $this->load->view('SmtplowCourtReport', $data);
			   // $this->load->view('layout/footer', $data);
			} catch (Exception $e) {
				echo $e->getMessage();
				$error = array('status' => 0, "msg" => "Internal Server Error - Please try Later.","StatusCode"=> "NP001");
				$this->response($this->json($error), 200);	
		
		}
	}
	
	function SMTPSupremeCourtReport(){
		try {
//echo "<pre>====="; print_r($_REQUEST); exit;				
$data =array();
                       if(!empty($_POST)){
					//echo "<pre>====="; print_r($_POST); exit;
					$startDate          = $_POST['fromDate'];
					$toDate             = $_POST['toDate'];
                                        $annexure_status      = $_POST['annexure_status'];
                                        $Date               = $_POST['Date'];
                                        $zone               = $_POST['zone_id'];
           $result             = $this->annexure_model->getSupremecourtlist($startDate,$toDate,$annexure_status,$Date,$zone);
				}else{
				    $result             = $this->annexure_model->getSupremecourtlist();
                }
			$totalcount  =$this->TotalCount();	
                $session_data = $this->session->all_userdata();
				$data =array('result'=>$result,'totalcount'=>$totalcount,'session_data'=>$session_data);
				//echo "<pre>====="; print_r($data); exit;
				$this->load->view('layout/header', $data);
			    $this->load->view('layout/topbar', $data);
			    $this->load->view('layout/leftbar', $data);
			    $this->load->view('SmtpsupremeCourtReport', $data);
			   // $this->load->view('layout/footer', $data);
			} catch (Exception $e) {
				echo $e->getMessage();
				$error = array('status' => 0, "msg" => "Internal Server Error - Please try Later.","StatusCode"=> "NP001");
				$this->response($this->json($error), 200);	
		
		}
	}
	
	function SMTPDDReport(){
		try {
				$data =array();
                       if(!empty($_POST)){
					//echo "<pre>====="; print_r($_POST); exit;
					$startDate          = $_POST['fromDate'];
					$toDate             = $_POST['toDate'];
                                        $annexure_status      = $_POST['annexure_status'];
                                        $Date               = $_POST['Date'];
                                        $zone               = $_POST['zone_id'];
           $result             = $this->annexure_model->DDReport($startDate,$toDate,$annexure_status,$Date,$zone);
				}else{
				    $result             = $this->annexure_model->DDReport();
                }
$totalcount  =$this->TotalCount();	
                $session_data = $this->session->all_userdata();
				$data =array('result'=>$result,'totalcount'=>$totalcount,'session_data'=>$session_data);
				//echo "<pre>====="; print_r($data); exit;
				$this->load->view('layout/header', $data);
			    $this->load->view('layout/topbar', $data);
			    $this->load->view('layout/leftbar', $data);
			    $this->load->view('SmtpDDReport', $data);
			   // $this->load->view('layout/footer', $data);
			} catch (Exception $e) {
				echo $e->getMessage();
				$error = array('status' => 0, "msg" => "Internal Server Error - Please try Later.","StatusCode"=> "NP001");
				$this->response($this->json($error), 200);	
		
		}
	}
}

?>
