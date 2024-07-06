<?php

class Report extends CI_Controller {

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
		
		$this->load->model('annexure_model');
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

function AllReport(){
		try {
		    if(in_array($this->role_id, ['5','9'], TRUE)){
//echo "<pre>====="; print_r($_REQUEST); exit;				
$data =array();
if(!empty($_POST)){
                if($this->form_validation->run('report')==FALSE){
					    
					}else{
					//echo "<pre>====="; print_r($_POST); exit;
					$startDate          = $_POST['fromDate'];
					$toDate             = $_POST['toDate'];
                                        $annexure_type      = $_POST['annexure_type'];
                                        $annexure_status    = $_POST['annexure_status'];
                                        $Fromamount         = $_POST['Fromamount'];
                                        $toamount           = $_POST['toamount'];
                                        $beneficiary_name   = $_POST['beneficiary_name'];
                                        $Date               = $_POST['Date'];
                                        $customer_reference_number   = $_POST['customer_reference_number'];
                              $result = $this->annexure_model->getAllReport($startDate,$toDate,$annexure_type,$annexure_status,$Fromamount,$toamount,$beneficiary_name,$customer_reference_number,$Date);
            }
				}else{
				    $result             = $this->annexure_model->getAllReport();
                }
                               $session_data = $this->session->all_userdata();
				$data =array('result'=>$result,'session_data'=>$session_data);
				//echo "<pre>====="; print_r($data); exit;
		            $this->load->view('layout/header', $data);
			    $this->load->view('layout/topbar', $data);
			    $this->load->view('layout/leftbar', $data);
			    $this->load->view('report', $data);
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

function OriginalReport(){
		try {
		    if(in_array($this->role_id, ['5','9'], TRUE)){
				$data =array();
                                if(!empty($_POST)){
					                if($this->form_validation->run('originalReport')==FALSE){
					    
					                    }else{
					                    $startDate          = $_POST['fromDate'];
					                    $toDate             = $_POST['toDate'];
                                        $annexure_status    = $_POST['annexure_status'];
                                        $Date               = $_POST['Date'];
                                        $zone               = $_POST['zone_id'];
                                        if($zone == 'All'){
                                            $zone = $this->zone_id;;
                                        }
                                        $result             = $this->annexure_model->getOrignallist($startDate,$toDate,$annexure_status,$Date,$zone);
					                    }
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
			    $this->load->view('orignalReport', $data);
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
        $query = $this->db->get();
		//echo $this->db->last_query(); die;
        return $query->result_array();
	}

	function HighCourtReport(){
		try {
		    if(in_array($this->role_id, ['3','4','5','9'], TRUE)){	
				$data =array();
                                if(!empty($_POST)){
                                    if($this->form_validation->run('originalReport')==FALSE){
					    
					}else{
                    					$startDate          = $_POST['fromDate'];
                    					$toDate             = $_POST['toDate'];
                                        $annexure_status      = $_POST['annexure_status'];
                                        $Date               = $_POST['Date'];
                                        $zone               = $_POST['zone_id'];
                                        if($zone == 'All'){
                                            $zone = $this->zone_id;;
                                        }
                                         $result             = $this->annexure_model->getHighCourtlist($startDate,$toDate,$annexure_status,$Date,$zone);
					}
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
			    $this->load->view('highCourtReport', $data);
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
	
	function LowCourtReport(){
		try {
		        if(in_array($this->role_id, ['3','4','5','9'], TRUE)){
				$data =array();
                           if(!empty($_POST)){
                                    if($this->form_validation->run('originalReport')==FALSE){
					    
                					}else{
                    					//echo "<pre>====="; print_r($_POST); exit;
                    					$startDate          = $_POST['fromDate'];
                    					$toDate             = $_POST['toDate'];
                                        $annexure_status      = $_POST['annexure_status'];
                                        $Date               = $_POST['Date'];
                                        $zone               = $_POST['zone_id'];
                                        if($zone == 'All'){
                                            $zone = $this->zone_id;;
                                        }
                                        $result             = $this->annexure_model->getLowercourtlist($startDate,$toDate,$annexure_status,$Date,$zone);
                					}
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
			    $this->load->view('lowCourtReport', $data);
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
                if(in_array($this->role_id, ['3','4','5','9'], TRUE)){				
                $data =array();
                       if(!empty($_POST)){
                           if($this->form_validation->run('originalReport')==FALSE){
					    
                					}else{
                    					//echo "<pre>====="; print_r($_POST); exit;
                    					$startDate          = $_POST['fromDate'];
                    					$toDate             = $_POST['toDate'];
                                        $annexure_status      = $_POST['annexure_status'];
                                        $Date               = $_POST['Date'];
                                        $zone               = $_POST['zone_id'];
                                        if($zone == 'All'){
                                            $zone = $this->zone_id;;
                                        }
                                        $result             = $this->annexure_model->getSupremecourtlist($startDate,$toDate,$annexure_status,$Date,$zone);
                					}
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
			    $this->load->view('supremeCourtReport', $data);
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
		        if(in_array($this->role_id, ['3','4','5','9'], TRUE)){
				$data =array();
                       if(!empty($_POST)){
                           if($this->form_validation->run('originalReport')==FALSE){
					    
                					}else{
                    					//echo "<pre>====="; print_r($_POST); exit;
                    					$startDate          = $_POST['fromDate'];
                    					$toDate             = $_POST['toDate'];
                                        $annexure_status      = $_POST['annexure_status'];
                                        $Date               = $_POST['Date'];
                                        $zone               = $_POST['zone_id'];
                                        if($zone == 'All'){
                                            $zone = $this->zone_id;
                                        }
                                        $result             = $this->annexure_model->DDReport($startDate,$toDate,$annexure_status,$Date,$zone);
                					}
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
			    $this->load->view('DDReport', $data);
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
		        if(in_array($this->role_id, ['3','4','5','9'], TRUE)){
				$data =array();
                       if(!empty($_POST)){
                           if($this->form_validation->run('originalReport')==FALSE){
                					}else{
                    					//echo "<pre>====="; print_r($_POST); exit;
                    					$startDate          = $_POST['fromDate'];
                    					$toDate             = $_POST['toDate'];
                                        $annexure_status      = $_POST['annexure_status'];
                                        $Date               = $_POST['Date'];
                                        $zone               = $_POST['zone_id'];
                                        if($zone == 'All'){
                                            $zone = $this->zone_id;
                                        }
                                        $result             = $this->annexure_model->AllTypeReport(6,$startDate,$toDate,$annexure_status,$Date,$zone);
                					}
				}else{
				    $result             = $this->annexure_model->AllTypeReport(6);
                }
                $totalcount  =$this->TotalCount();	
                $session_data = $this->session->all_userdata();
				$data =array('result'=>$result,'totalcount'=>$totalcount,'session_data'=>$session_data);
				//echo "<pre>====="; print_r($data); exit;
				$this->load->view('layout/header', $data);
			    $this->load->view('layout/topbar', $data);
			    $this->load->view('layout/leftbar', $data);
			    $this->load->view('OriginalDDReport', $data);
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
		        if(in_array($this->role_id, ['3','4','5','9'], TRUE)){
				$data =array();
                       if(!empty($_POST)){
                           if($this->form_validation->run('originalReport')==FALSE){
                					}else{
                    					//echo "<pre>====="; print_r($_POST); exit;
                    					$startDate          = $_POST['fromDate'];
                    					$toDate             = $_POST['toDate'];
                                        $annexure_status      = $_POST['annexure_status'];
                                        $Date               = $_POST['Date'];
                                        $zone               = $_POST['zone_id'];
                                        if($zone == 'All'){
                                            $zone = $this->zone_id;
                                        }
                                        $result             = $this->annexure_model->AllTypeReport(7,$startDate,$toDate,$annexure_status,$Date,$zone);
                					}
				}else{
				    $result             = $this->annexure_model->AllTypeReport(7);
                }
                $totalcount  =$this->TotalCount();	
                $session_data = $this->session->all_userdata();
				$data =array('result'=>$result,'totalcount'=>$totalcount,'session_data'=>$session_data);
				//echo "<pre>====="; print_r($data); exit;
				$this->load->view('layout/header', $data);
			    $this->load->view('layout/topbar', $data);
			    $this->load->view('layout/leftbar', $data);
			    $this->load->view('LCDDReport', $data);
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
		        if(in_array($this->role_id, ['3','4','5','9'], TRUE)){
				$data =array();
                       if(!empty($_POST)){
                           if($this->form_validation->run('originalReport')==FALSE){
                					}else{
                    					//echo "<pre>====="; print_r($_POST); exit;
                    					$startDate          = $_POST['fromDate'];
                    					$toDate             = $_POST['toDate'];
                                        $annexure_status      = $_POST['annexure_status'];
                                        $Date               = $_POST['Date'];
                                        $zone               = $_POST['zone_id'];
                                        if($zone == 'All'){
                                            $zone = $this->zone_id;
                                        }
                                        $result             = $this->annexure_model->AllTypeReport(8,$startDate,$toDate,$annexure_status,$Date,$zone);
                					}
				}else{
				    $result             = $this->annexure_model->AllTypeReport(8);
                }
                $totalcount  =$this->TotalCount();	
                $session_data = $this->session->all_userdata();
				$data =array('result'=>$result,'totalcount'=>$totalcount,'session_data'=>$session_data);
				//echo "<pre>====="; print_r($data); exit;
				$this->load->view('layout/header', $data);
			    $this->load->view('layout/topbar', $data);
			    $this->load->view('layout/leftbar', $data);
			    $this->load->view('HCDDReport', $data);
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

?>
