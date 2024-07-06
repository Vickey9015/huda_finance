<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
class AjaxReport extends CI_Controller {

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
		
		$this->load->model('orginal_model');
		$this->load->model('lowercourt_model');
		$this->load->model('highcourt_model');
		$this->load->model('supremecourt_model');
		$this->load->model('ddreport_model');
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

	
	
	function OriginalReportByAjax(){
		try {
			//echo '<pre>==';print_r($_POST);exit;
		   
           // $list = $this->customers->get_datatables();
        $result             = $this->orginal_model->get_datatables();
                // echo'<pre>=='; print_r($result);exit;
		$data = array();
		$no = $_POST['start'];
		foreach ($result as $item) {
			$grossAmount = 0;
			$tdsAmount = 0;
			$netAmount =0;
			$totalCount=0;
			$annexure_file      	    =    unserialize(ANNEXURE_TYPE);
			//echo'<pre>=='; print_r($item);exit;
			$no++;
			$row = array();
			//$file_name=
			$ref_no                  = $item["reference_number"];
            $annexure_status         = unserialize(ANNEXURE_STATUS);
            //echo'<pre>=='; print_r($annexure_status);exit;
			$zones                   = $item['zone_name'];
            $path                    = base_url(). '/upload/'.$annexure_file[$item["annexure_type"]].'/'.$item["file_name"];
            $annexure_type           = unserialize(ANNEXURE_NAME);
            $grossAmount            +=$item["gross_amount_to_paid"];
			$tdsAmount              +=$item["TDS_deducted"];
			$netAmount              +=$item["net_amount"];
            $totalCount             +=$item["reference_number"];

			$row[] = $item["file_name"];
			$row[] = $item['zone_name'];
			$row[] = $item["customer_reference_number"];
			$row[] = $item['serial_no'];
			$row[] = $item["sector_no"];
			$row[] = $item['villlage_name'];
			$row[] = $item["section_notfn_date"];
			$row[] = $item['is_petition_filed'];
			$row[] = $item['award_no'];
			$row[] = $item["award_date"];
			$row[] = $item['LAO_bank_account_no'];
			$row[] = $item["beneficiary_name"];
			$row[] = $item["khewat_no"];
			$row[] = $item["share_in_ownership"];
			$row[] = $item["acre"];
			$row[] = $item["kanal"];
			$row[] = $item["marla"];
			$row[] = $item['beneficiary_PAN'];
			$row[] = $item["gross_amount_to_paid"];
			$row[] = $item['TDS_deducted'];
			$row[] = $item["net_amount"];
			$row[] = $item['ifsc_code'];
			$row[] = $item["account_number"];
			$row[] = $item['is_EDC'];
			$row[] = $item["mobile_number"];
			$row[] = $item['authorised_on'];
			$row[] = $item["released_on"];
			$row[] = $item['returned_on'];
			$row[] = $item["rejected_on"];
			if ($item['annexure_status']== 6) {
				$row[]= $item["is_return"] == 1 ? "Returned" : "Returned (Failed)";
		
			}else{
				$row[]= $annexure_status[$item["annexure_status"]];
			}
			if(($item["annexure_status"] != 6 or $item["annexure_status"] != 11) && $item["is_resubmitted"] == 1){
						$row[] = 'Yes';
			}else{
						$row[]= 'No';
		    }
			$row[] = $item["reason"];
			
			$data[] = $row;
		}
		//echo'<pre>=='; print_r($data);exit;
 
		$output = array(
						"draw" => $_POST['draw'],
						//"totalcount" => $this->orginal_model->TotalCount(),
						"recordsTotal" => $this->orginal_model->count_all(),
						"recordsFiltered" => $this->orginal_model->count_filtered(),
						"data" => $data,
				);
		
		echo json_encode($output); exit;


		  
			} catch (Exception $e) {
				echo $e->getMessage();
				$error = array('status' => 0, "msg" => "Internal Server Error - Please try Later.","StatusCode"=> "NP001");
				$this->response($this->json($error), 200);	
		
		}
	}



	function LowerCourtReportByAjax(){
		try {
			// echo '<pre>==';print_r($_POST);exit;
		   
           // $list = $this->customers->get_datatables();
        $result             = $this->lowercourt_model->get_datatables();
                //echo'<pre>=='; print_r($result);exit;
		$data = array();
		$no = $_POST['start'];
		foreach ($result as $item) {
			$grossAmount = 0;
			$tdsAmount = 0;
			$netAmount =0;
			$totalCount=0;
			$annexure_file      	    =    unserialize(ANNEXURE_TYPE);
			//echo'<pre>=='; print_r($item);exit;
			$no++;
			$row = array();
			//$file_name=
			$ref_no                  = $item["reference_number"];
            $annexure_status         = unserialize(ANNEXURE_STATUS);
            //echo'<pre>=='; print_r($annexure_status);exit;
			$zones                   = $item['zone_name'];
            $path                    = base_url(). '/upload/'.$annexure_file[$item["annexure_type"]].'/'.$item["file_name"];
            $annexure_type           = unserialize(ANNEXURE_NAME);
            $grossAmount            +=$item["gross_amount_to_paid"];
			$tdsAmount              +=$item["TDS_deducted"];
			$netAmount              +=$item["net_amount"];
            $totalCount             +=$item["reference_number"];
			$row[] = $item["file_name"];
			$row[] = $item['zone_name'];
			$row[] = $item["customer_reference_number"];
			$row[] = $item["sector_no"];
			$row[] = $item['villlage_name'];
			$row[] = $item['award_no'];
			$row[] = $item["award_date"];
			$row[] = $item['LAO_bank_account_no'];
			$row[] = $item["beneficiary_name"];
			$row[] = $item["khewat_no"];
			$row[] = $item["share_in_ownership"];
			$row[] = $item["acre"];
			$row[] = $item["kanal"];
			$row[] = $item["marla"];
			$row[] = $item['beneficiary_PAN'];
			$row[] = $item["gross_amount_to_paid"];
			$row[] = $item['TDS_deducted'];
			$row[] = $item["net_amount"];
			$row[] = $item['ifsc_code'];
			$row[] = $item["account_number"];
			$row[] = $item['is_EDC'];
			$row[] = $item["mobile_number"];
			$row[] = $item['authorised_on'];
			$row[] = $item["released_on"];
			$row[] = $item['returned_on'];
			$row[] = $item["rejected_on"];
			if ($item['annexure_status']== 6) {
				$row[]= $item["is_return"] == 1 ? "Returned" : "Returned (Failed)";
		
			}else{
				$row[]= $annexure_status[$item["annexure_status"]];
			}
			 if(($item["annexure_status"] != 6 or $item["annexure_status"] != 11) && $item["is_resubmitted"] == 1){
						$row[] = 'Yes';
						 }else{
						 $row[]= 'No';
						 }
			$row[] = $item["reason"];
			
			$data[] = $row;
		}
		//echo'<pre>=='; print_r($data);exit;
 
		$output = array(
						"draw" => $_POST['draw'],
						//"totalcount" => $this->LowerCourt_model->TotalCount(),
						"recordsTotal" => $this->lowercourt_model->count_all(),
						"recordsFiltered" => $this->lowercourt_model->count_filtered(),
						"data" => $data,
				);
		
		echo json_encode($output); exit;


		  
			} catch (Exception $e) {
				echo $e->getMessage();
				$error = array('status' => 0, "msg" => "Internal Server Error - Please try Later.","StatusCode"=> "NP001");
				$this->response($this->json($error), 200);	
		
		}
	}

function HighCourtReportByAjax(){
		try {
			// echo '<pre>==';print_r($_POST);exit;
		   
            //$list = $this->customers->get_datatables();
        $result             = $this->highcourt_model->get_datatables();
                //echo'<pre>=='; print_r($result);exit;
		$data = array();
		$no = $_POST['start'];
		foreach ($result as $item) {
			$grossAmount = 0;
			$tdsAmount = 0;
			$netAmount =0;
			$totalCount=0;
			$annexure_file      	    =    unserialize(ANNEXURE_TYPE);
			//echo'<pre>=='; print_r($item);exit;
			$no++;
			$row = array();
			//$file_name=
			$ref_no                  = $item["reference_number"];
            $annexure_status         = unserialize(ANNEXURE_STATUS);
            //echo'<pre>=='; print_r($annexure_status);exit;
			$zones                   = $item['zone_name'];
            $path                    = base_url(). '/upload/'.$annexure_file[$item["annexure_type"]].'/'.$item["file_name"];
            $annexure_type           = unserialize(ANNEXURE_NAME);
            $grossAmount            +=$item["gross_amount_to_paid"];
			$tdsAmount              +=$item["TDS_deducted"];
			$netAmount              +=$item["net_amount"];
            $totalCount             +=$item["reference_number"];
			$row[] = $item["file_name"];
			$row[] = $item['zone_name'];
			$row[] = $item["customer_reference_number"];
			$row[] = $item['serial_no'];
			$row[] = $item["sector_no"];
			$row[] = $item['villlage_name'];
			$row[] = $item['LAO_bank_account_no'];
			$row[] = $item['award_no'];
			$row[] = $item["award_date"];
			$row[] = $item['ADJ_court_order_no'];
			$row[] = $item["ADJ_court_decision_date"];
			$row[] = $item['high_court_order_no'];
			$row[] = $item["high_court_decision_date"];
			$row[] = $item["beneficiary_name"];
			$row[] = $item["khewat_no"];
			$row[] = $item["share_in_ownership"];
			$row[] = $item["acre"];
			$row[] = $item["kanal"];
			$row[] = $item["marla"];
			$row[] = $item['beneficiary_PAN'];
			$row[] = $item["gross_amount_to_paid"];
			$row[] = $item['TDS_deducted'];
			$row[] = $item["net_amount"];
			$row[] = $item['ifsc_code'];
			$row[] = $item["account_number"];
			$row[] = $item['is_EDC'];
			$row[] = $item["mobile_number"];
			$row[] = $item['authorised_on'];
			$row[] = $item["released_on"];
			$row[] = $item['returned_on'];
			$row[] = $item["rejected_on"];
			if ($item['annexure_status']== 6) {
				$row[]= $item["is_return"] == 1 ? "Returned" : "Returned (Failed)";
		
			}else{
				$row[]= $annexure_status[$item["annexure_status"]];
			}
			 if(($item["annexure_status"] != 6 or $item["annexure_status"] != 11) && $item["is_resubmitted"] == 1){
						$row[] = 'Yes';
			 }else{
			 $row[]= 'No';
			 }
			$row[] = $item["reason"];
			$data[] = $row;
		}
		//echo'<pre>=='; print_r($data);exit;
 
		$output = array(
						"draw" => $_POST['draw'],
						//"totalcount" => $this->HighCourt_model->TotalCount(),
						"recordsTotal" => $this->highcourt_model->count_all(),
						"recordsFiltered" => $this->highcourt_model->count_filtered(),
						"data" => $data,
				);
		
		echo json_encode($output); exit;


		  
			} catch (Exception $e) {
				echo $e->getMessage();
				$error = array('status' => 0, "msg" => "Internal Server Error - Please try Later.","StatusCode"=> "NP001");
				$this->response($this->json($error), 200);	
		
		}
	}

	function SupremeCourtReportByAjax(){
		try {
			// echo '<pre>==';print_r($_POST);exit;
		   
           // $list = $this->customers->get_datatables();
        $result             = $this->supremecourt_model->get_datatables();
                //echo'<pre>=='; print_r($result);exit;
		$data = array();
		$no = $_POST['start'];
		foreach ($result as $item) {
			$grossAmount = 0;
			$tdsAmount = 0;
			$netAmount =0;
			$totalCount=0;
			$annexure_file      	    =    unserialize(ANNEXURE_TYPE);
			//echo'<pre>=='; print_r($item);exit;
			$no++;
			$row = array();
			//$file_name=
			$ref_no                  = $item["reference_number"];
            $annexure_status         = unserialize(ANNEXURE_STATUS);
            //echo'<pre>=='; print_r($annexure_status);exit;
			$zones                   = $item['zone_name'];
            $path                    = base_url(). '/upload/'.$annexure_file[$item["annexure_type"]].'/'.$item["file_name"];
            $annexure_type           = unserialize(ANNEXURE_NAME);
            $grossAmount            +=$item["gross_amount_to_paid"];
			$tdsAmount              +=$item["TDS_deducted"];
			$netAmount              +=$item["net_amount"];
            $totalCount             +=$item["reference_number"];
			$row[] = $item["file_name"];
			$row[] = $item['zone_name'];
			$row[] = $item["customer_reference_number"];
			$row[] = $item["sector_no"];
			$row[] = $item['villlage_name'];
			$row[] = $item['award_no'];
			$row[] = $item["award_date"];
			$row[] = $item['LAO_bank_account_no'];
			$row[] = $item["beneficiary_name"];
			$row[] = $item["khewat_no"];
			$row[] = $item["share_in_ownership"];
			$row[] = $item["acre"];
			$row[] = $item["kanal"];
			$row[] = $item["marla"];
			$row[] = $item['ADJ_court_order_no'];
			$row[] = $item["ADJ_court_decision_date"];
			$row[] = $item['high_court_order_no'];
			$row[] = $item["high_court_decision_date"];
			$row[] = $item['supreme_court_order_no'];
			$row[] = $item["supreme_court_decision_date"];
			
			$row[] = $item['beneficiary_PAN'];
			$row[] = $item["gross_amount_to_paid"];
			$row[] = $item['TDS_deducted'];
			$row[] = $item["net_amount"];
			$row[] = $item['ifsc_code'];
			$row[] = $item["account_number"];
			$row[] = $item['is_EDC'];
			$row[] = $item["mobile_number"];
			$row[] = $item['authorised_on'];
			$row[] = $item["released_on"];
			$row[] = $item['returned_on'];
			$row[] = $item["rejected_on"];
			if ($item['annexure_status']== 6) {
				$row[]= $item["is_return"] == 1 ? "Returned" : "Returned (Failed)";
		
			}else{
				$row[]= $annexure_status[$item["annexure_status"]];
			}
			if(($item["annexure_status"] != 6 or $item["annexure_status"] != 11) && $item["is_resubmitted"] == 1){
						$row[] = 'Yes';
		    }else{
			    $row[]= 'No';
		    }		
			$row[] = $item["reason"];
			$data[] = $row;
		}
		//echo'<pre>=='; print_r($data);exit;
 
		$output = array(
						"draw" => $_POST['draw'],
						//"totalcount" => $this->supremecourt_model->TotalCount(),
						"recordsTotal" => $this->supremecourt_model->count_all(),
						"recordsFiltered" => $this->supremecourt_model->count_filtered(),
						"data" => $data,
				);
		
		echo json_encode($output); exit;


		  
			} catch (Exception $e) {
				echo $e->getMessage();
				$error = array('status' => 0, "msg" => "Internal Server Error - Please try Later.","StatusCode"=> "NP001");
				$this->response($this->json($error), 200);	
		
		}
	}

	function DDReportByAjax(){
		try {
			// echo '<pre>==';print_r($_POST);exit;
		   
           // $list = $this->customers->get_datatables();
        $result             = $this->ddreport_model->get_datatables();
                //echo'<pre>=='; print_r($result);exit;
		$data = array();
		$no = $_POST['start'];
		foreach ($result as $item) {
			$grossAmount = 0;
			$tdsAmount = 0;
			$netAmount =0;
			$totalCount=0;
			$annexure_file      	    =    unserialize(ANNEXURE_TYPE);
			//echo'<pre>=='; print_r($item);exit;
			$no++;
			$row = array();
			//$file_name=
			$ref_no                  = $item["reference_number"];
            //$annexure_status         = json_decode((ANNEXURE_STATUS),true);
            $annexure_status         = unserialize(ANNEXURE_STATUS);
            //echo'<pre>=='; print_r($annexure_status);exit;
			$zones                   = $item['zone_name'];
            $path                    = base_url(). '/upload/'.$annexure_file[$item["annexure_type"]].'/'.$item["file_name"];
            $annexure_type           = unserialize(ANNEXURE_NAME);
            $grossAmount            +=$item["gross_amount_to_paid"];
			$tdsAmount              +=$item["TDS_deducted"];
			$netAmount              +=$item["net_amount"];
            $totalCount             +=$item["reference_number"];
			$row[] = $item["file_name"];
			$row[] = $item['zone_name'];
			$row[] = $item["serial_no"];
			$row[] = $item["customer_reference_number"];
			$row[] = $item["sector_no"];
			$row[] = $item['villlage_name'];
			$row[] = $item['LAO_bank_account_no'];
			$row[] = $item['award_no'];
			$row[] = $item["award_date"];
			
			
			$row[] = $item['ADJ_court_order_no'];
			$row[] = $item["ADJ_court_decision_date"];
			$row[] = $item['high_court_order_no'];
			$row[] = $item["high_court_decision_date"];
			$row[] = $item['supreme_court_order_no'];
			$row[] = $item["supreme_court_decision_date"];
			$row[] = $item["beneficiary_name"];
			$row[] = $item["khewat_no"];
			$row[] = $item["share_in_ownership"];
			$row[] = $item["acre"];
			$row[] = $item["kanal"];
			$row[] = $item["marla"];
			$row[] = $item['beneficiary_PAN'];
			$row[] = $item["gross_amount_to_paid"];
			$row[] = $item['TDS_deducted'];
			$row[] = $item["net_amount"];
			$row[] = $item['drawee_name'];
			$row[] = $item["print_location"];
			$row[] = $item['DD_PAYABLE_AT'];
			$row[] = $item['is_EDC'];
			$row[] = $item["mobile_number"];
			$row[] = $item['authorised_on'];
			$row[] = $item["released_on"];
			$row[] = $item['returned_on'];
			$row[] = $item["rejected_on"];
			if ($item['annexure_status']== 6) {
				$row[]= $item["is_return"] == 1 ? "Returned" : "Returned (Failed)";
		
			}else{
				$row[]= $annexure_status[$item["annexure_status"]];
			}
			if(($item["annexure_status"] != 6 or $item["annexure_status"] != 11) && $item["is_resubmitted"] == 1){
						$row[] = 'Yes';
		    }else{
			    $row[]= 'No';
		    }		
			$row[] = $item["reason"];
			$data[] = $row;
		}
		//echo'<pre>=='; print_r($data);exit;
 
		$output = array(
						"draw" => $_POST['draw'],
						//"totalcount" => $this->DDReport_model->TotalCount(),
						"recordsTotal" => $this->ddreport_model->count_all(),
						"recordsFiltered" => $this->ddreport_model->count_filtered(),
						"data" => $data,
				);
		
		echo json_encode($output); exit;


		  
			} catch (Exception $e) {
				echo $e->getMessage();
				$error = array('status' => 0, "msg" => "Internal Server Error - Please try Later.","StatusCode"=> "NP001");
				$this->response($this->json($error), 200);	
		
		}
	}


	function OriginalDDReportByAjax(){
		try {
			//echo '<pre>==';print_r($_POST);exit;
		   
           // $list = $this->customers->get_datatables();
        $result             = $this->ddreport_model->get_datatables();
                //echo'<pre>=='; print_r($result);exit;
		$data = array();
		//$_POST['annexure_type']=6;
		$no = $_POST['start'];
		foreach ($result as $item) {
			$grossAmount = 0;
			$tdsAmount = 0;
			$netAmount =0;
			$totalCount=0;
			$annexure_file      	    =    unserialize(ANNEXURE_TYPE);
			//echo'<pre>=='; print_r($item);exit;
			$no++;
			$row = array();
			//$file_name=
			$ref_no                  = $item["reference_number"];
            $annexure_status         = unserialize(ANNEXURE_STATUS);
            //echo'<pre>=='; print_r($annexure_status);exit;
			$zones                   = $item['zone_name'];
            $path                    = base_url(). '/upload/'.$annexure_file[$item["annexure_type"]].'/'.$item["file_name"];
            $annexure_type           = unserialize(ANNEXURE_NAME);
            $grossAmount            +=$item["gross_amount_to_paid"];
			$tdsAmount              +=$item["TDS_deducted"];
			$netAmount              +=$item["net_amount"];
            $totalCount             +=$item["reference_number"];
			$row[] = $item["file_name"];
			$row[] = $item['zone_name'];
			$row[] = $item["serial_no"];
			$row[] = $item["customer_reference_number"];
			$row[] = $item["sector_no"];
			$row[] = $item['villlage_name'];
			$row[] = $item['section_notfn_date'];
			$row[] = $item['is_petition_filed'];
			$row[] = $item['award_no'];
			$row[] = $item["award_date"];
			$row[] = $item["LAO_bank_account_no"];
			$row[] = $item["beneficiary_name"];
			$row[] = $item["khewat_no"];
			$row[] = $item["share_in_ownership"];
			$row[] = $item["acre"];
			$row[] = $item["kanal"];
			$row[] = $item["marla"];
			$row[] = $item['beneficiary_PAN'];
			$row[] = $item["gross_amount_to_paid"];
			$row[] = $item['drawee_name'];
			$row[] = $item["print_location"];
			$row[] = $item['DD_PAYABLE_AT'];
			$row[] = $item["is_EDC"];
			$row[] = $item['mobile_number'];
			$row[] = $item['UTR'];
			$row[] = $item["StatusDesc"];
			$row[] = $item['authorised_on'];
			$row[] = $item["released_on"];
			$row[] = $item['returned_on'];
			$row[] = $item["rejected_on"];
			if ($item['annexure_status']== 6) {
				$row[]= $item["is_return"] == 1 ? "Returned" : "Returned (Failed)";
		
			}else{
				$row[]= $annexure_status[$item["annexure_status"]];
			}
			if(($item["annexure_status"] != 6 or $item["annexure_status"] != 11) && $item["is_resubmitted"] == 1){
						$row[] = 'Yes';
		    }else{
			    $row[]= 'No';
		    }		
			$row[] = $item["reason"];
			$data[] = $row;
		}
		//echo'<pre>=='; print_r($data);exit;
 
		$output = array(
						"draw" => $_POST['draw'],
						//"totalcount" => $this->DDReport_model->TotalCount(),
						"recordsTotal" => $this->ddreport_model->count_all(),
						"recordsFiltered" => $this->ddreport_model->count_filtered(),
						"data" => $data,
				);
		
		echo json_encode($output); exit;


		  
			} catch (Exception $e) {
				echo $e->getMessage();
				$error = array('status' => 0, "msg" => "Internal Server Error - Please try Later.","StatusCode"=> "NP001");
				$this->response($this->json($error), 200);	
		
		}
	}
	function LCDDReportByAjax(){
		try {
			//echo '<pre>==';print_r($_POST);exit;
		   
           // $list = $this->customers->get_datatables();
        $result             = $this->ddreport_model->get_datatables();
                //echo'<pre>=='; print_r($result);exit;
		$data = array();
		//$_POST['annexure_type']=6;
		$no = $_POST['start'];
		foreach ($result as $item) {
			$grossAmount = 0;
			$tdsAmount = 0;
			$netAmount =0;
			$totalCount=0;
			$annexure_file      	    =    unserialize(ANNEXURE_TYPE);
			//echo'<pre>=='; print_r($item);exit;
			$no++;
			$row = array();
			//$file_name=
			$ref_no                  = $item["reference_number"];
            $annexure_status         = unserialize(ANNEXURE_STATUS);
            //echo'<pre>=='; print_r($annexure_status);exit;
			$zones                   = $item['zone_name'];
            $path                    = base_url(). '/upload/'.$annexure_file[$item["annexure_type"]].'/'.$item["file_name"];
            $annexure_type           = unserialize(ANNEXURE_NAME);
            $grossAmount            +=$item["gross_amount_to_paid"];
			$tdsAmount              +=$item["TDS_deducted"];
			$netAmount              +=$item["net_amount"];
            $totalCount             +=$item["reference_number"];
			$row[] = $item["file_name"];
			$row[] = $item['zone_name'];
			$row[] = $item["serial_no"];
			$row[] = $item["customer_reference_number"];
			$row[] = $item["sector_no"];
			$row[] = $item['villlage_name'];
		    $row[] = $item["LAO_bank_account_no"];
			
			$row[] = $item['award_no'];
			$row[] = $item["award_date"];
			$row[] = $item['ADJ_court_order_no'];
			$row[] = $item['ADJ_court_decision_date'];
			$row[] = $item["beneficiary_name"];
			$row[] = $item["khewat_no"];
			$row[] = $item["share_in_ownership"];
			$row[] = $item["acre"];
			$row[] = $item["kanal"];
			$row[] = $item["marla"];
			$row[] = $item['beneficiary_PAN'];
			$row[] = $item["gross_amount_to_paid"];
			$row[] = $item['TDS_deducted'];
			$row[] = $item["net_amount"];
			$row[] = $item['drawee_name'];
			$row[] = $item["print_location"];
			$row[] = $item['DD_PAYABLE_AT'];
			$row[] = $item["is_EDC"];
			$row[] = $item['mobile_number'];
			$row[] = $item['UTR'];
			$row[] = $item["StatusDesc"];
			$row[] = $item['authorised_on'];
			$row[] = $item["released_on"];
			$row[] = $item['returned_on'];
			$row[] = $item["rejected_on"];
			if ($item['annexure_status']== 6) {
				$row[]= $item["is_return"] == 1 ? "Returned" : "Returned (Failed)";
		
			}else{
				$row[]= $annexure_status[$item["annexure_status"]];
			}
			if(($item["annexure_status"] != 6 or $item["annexure_status"] != 11) && $item["is_resubmitted"] == 1){
						$row[] = 'Yes';
		    }else{
			    $row[]= 'No';
		    }		
			$row[] = $item["reason"];
			$data[] = $row;
		}
		//echo'<pre>=='; print_r($data);exit;
 
		$output = array(
						"draw" => $_POST['draw'],
						//"totalcount" => $this->DDReport_model->TotalCount(),
						"recordsTotal" => $this->ddreport_model->count_all(),
						"recordsFiltered" => $this->ddreport_model->count_filtered(),
						"data" => $data,
				);
		
		echo json_encode($output); exit;


		  
			} catch (Exception $e) {
				echo $e->getMessage();
				$error = array('status' => 0, "msg" => "Internal Server Error - Please try Later.","StatusCode"=> "NP001");
				$this->response($this->json($error), 200);	
		
		}
	}
	function HCDDReportByAjax(){
		try {
			//echo '<pre>==';print_r($_POST);exit;
		   
           // $list = $this->customers->get_datatables();
        $result             = $this->ddreport_model->get_datatables();
                //echo'<pre>=='; print_r($result);exit;
		$data = array();
		//$_POST['annexure_type']=6;
		$no = $_POST['start'];
		foreach ($result as $item) {
			$grossAmount = 0;
			$tdsAmount = 0;
			$netAmount =0;
			$totalCount=0;
			$annexure_file      	    =    unserialize(ANNEXURE_TYPE);
			//echo'<pre>=='; print_r($item);exit;
			$no++;
			$row = array();
			//$file_name=
			$ref_no                  = $item["reference_number"];
           $annexure_status         = unserialize(ANNEXURE_STATUS);
            //echo'<pre>=='; print_r($annexure_status);exit;
			$zones                   = $item['zone_name'];
            $path                    = base_url(). '/upload/'.$annexure_file[$item["annexure_type"]].'/'.$item["file_name"];
            $annexure_type           = unserialize(ANNEXURE_NAME);
            $grossAmount            +=$item["gross_amount_to_paid"];
			$tdsAmount              +=$item["TDS_deducted"];
			$netAmount              +=$item["net_amount"];
            $totalCount             +=$item["reference_number"];
			$row[] = $item["file_name"];
			$row[] = $item['zone_name'];
			$row[] = $item["serial_no"];
			$row[] = $item["customer_reference_number"];
			$row[] = $item["sector_no"];
			$row[] = $item['villlage_name'];
		    $row[] = $item["LAO_bank_account_no"];
			$row[] = $item['award_no'];
			$row[] = $item["award_date"];
			$row[] = $item['ADJ_court_order_no'];
			$row[] = $item['ADJ_court_decision_date'];
			$row[] = $item['high_court_order_no'];
			$row[] = $item['high_court_decision_date'];
			$row[] = $item["beneficiary_name"];
			$row[] = $item["khewat_no"];
			$row[] = $item["share_in_ownership"];
			$row[] = $item["acre"];
			$row[] = $item["kanal"];
			$row[] = $item["marla"];
			$row[] = $item['beneficiary_PAN'];
			$row[] = $item["gross_amount_to_paid"];
			$row[] = $item['TDS_deducted'];
			$row[] = $item["net_amount"];
			$row[] = $item['drawee_name'];
			$row[] = $item["print_location"];
			$row[] = $item['DD_PAYABLE_AT'];
			$row[] = $item["is_EDC"];
			$row[] = $item['mobile_number'];
			//$row[] = $item['authorised_on'];
			$row[] = $item['UTR'];
			$row[] = $item["StatusDesc"];
			$row[] = $item['authorised_on'];
			$row[] = $item["released_on"];
			$row[] = $item['returned_on'];
			$row[] = $item["rejected_on"];
			if ($item['annexure_status']== 6) {
				$row[]= $item["is_return"] == 1 ? "Returned" : "Returned (Failed)";
		
			}else{
				$row[]= $annexure_status[$item["annexure_status"]];
			}
			if(($item["annexure_status"] != 6 or $item["annexure_status"] != 11) && $item["is_resubmitted"] == 1){
						$row[] = 'Yes';
		    }else{
			    $row[]= 'No';
		    }		
			$row[] = $item["reason"];
			$data[] = $row;
		}
		//echo'<pre>=='; print_r($data);exit;
 
		$output = array(
						"draw" => $_POST['draw'],
						//"totalcount" => $this->DDReport_model->TotalCount(),
						"recordsTotal" => $this->ddreport_model->count_all(),
						"recordsFiltered" => $this->ddreport_model->count_filtered(),
						"data" => $data,
				);
		
		echo json_encode($output); exit;


		  
			} catch (Exception $e) {
				echo $e->getMessage();
				$error = array('status' => 0, "msg" => "Internal Server Error - Please try Later.","StatusCode"=> "NP001");
				$this->response($this->json($error), 200);	
		
		}
	}

}
