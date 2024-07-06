<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// error_reporting(0);
class Returnrecords extends CI_Controller {

    function __construct() {
        $data =array();
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $data  =array('is_logged_in'=>$this->session->userdata('logged_in'));
        $session_data = $this->session->all_userdata();
		$this->approver_id=  $session_data['id'];
		$this->role_id = $session_data['role_id'];
        if(!$this->session->userdata('logged_in')){
			redirect(base_url().'user/index');

		}
		$this->load->model('returnrecords_model');
		$this->load->model('approve_model');

        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('common_helper');
		date_default_timezone_set('Asia/Kolkata');
    }

	function ReturnedRecordList(){
		// $annexure_status = $this->uri->segment(3);
		if(in_array($this->role_id, ['3','4','5','9'], TRUE)){
			$session_data        = $this->session->all_userdata();
			$data =array('session_data'=>$session_data);
			//$data =array('session_data'=>$session_data);
			//echo"<pre>==";print_r($data);exit;
			$this->load->view('layout/header', $data);
			$this->load->view('layout/topbar', $data);
			$this->load->view('layout/unleftbar', $data);
			$this->load->view('returnrecords_view',$data);
		}else{
			redirect(base_url());
		}

	}

	function fetchData(){
		//$ref_no = $_POST['data'];
        //  echo $this->role_id; die();
        //$session_data = $this->session->all_userdata();
        $userData = $this->returnrecords_model->get_datatables();
		// echo '<pre>1==='; print_r($userData);die;
		
		$annexureStatus = unserialize(UNCLAIMEDANNEXURESTATUS);
		$errorStatus = unserialize(UNCLAIMEDERRORSTATUS);
		$modeType= array("1"=>"RTGS", "2"=>"NEFT", "3"=>"Cheque", "4"=>"DD");

        //echo '<pre>==='; print_r($userData);die;
        $data = array();
       
        //$sn = 1;
        foreach ($userData as $user) {
            // echo '<pre>'; print_r($user);die;
            //$url = base_url('/UserKycLoader/userKycPDF/') . $user->id;
           // $sn++;
            $row   = array();
            //$row[] = $sn;
             	//row[] = $annexureStatus[$user->annexure_status];
       // echo '<pre>==='; print_r($user->annexure_status);die;
			$row[] = $user->s_no;
			$row[] = $user->file_id;
			$row[] = $user->zone_name;
			$row[] = $user->sector_no;
			$row[] = $user->name_of_village;
			$row[] = $user->date_of_four_section;
			$row[] = $user->date_of_six_sectiom;
			$row[] = $user->award_no;
			$row[] = $user->award_date;
			$row[] = $user->khewat_no;
			$row[] = $user->acquired_area;
			$row[] = $user->acre;
			$row[] = $user->kanal;
			$row[] = $user->marla;
			$row[] = $user->bank_ac_lao;
			$row[] = "<span id='getName_".$user->id."'>".$user->name_of_bene."</span>";
			$row[] = $user->account_number;
			$row[] = $modeType[$user->bene_mode];
			$row[] = $user->ifsc_code;
			$row[] = "<span id='getsonof_".$user->id."'>".$user->care_of."</span>";
			$row[] = $user->is_edc;
			$row[] = "<span id='getRefNo_".$user->id."'>".$user->customer_ref_numer."</span>";
			$row[] = $user->file_ref_number;
			$row[] = $user->file_name;
			$row[] = "<span id='getAmount_".$user->id."'>".$user->net_amount."</span>";
			$row[] = "<span id='getmobile_".$user->id."'>".$user->mobile_number."</span>";
			$row[] = $user->initiation_by;
			$row[] = $user->initiated_on;
			$row[] = $user->authorised_by;
			$row[] = $user->authorised_on;
			// $row[] = $user->bene_updated_by;
			// $row[] = ($user->bene_updated_on) ? date('d-m-Y', strtotime($user->bene_updated_on)) : '';
			// $row[] = ($user->force_duplicate == 2) ? "<span class='text-danger'>Forced</span>":"<span class='text-success'> </span>";
			$row[] = $user->StatusCode;
			$row[] = $user->StatusDesc;
			if ($user->annexure_status<2 ) {
				$row[] = $errorStatus[$user->is_error];

			}else{
				$row[] = $annexureStatus[$user->annexure_status];
			}
			
			//$row[] = $user->is_error;
			$row[] = date('d-m-Y', strtotime($user->created_on));
			if($this->role_id == 3 &&  $user->is_error==5){
				$row[] = ($user->annexure_status == 6) ? '<button type="button" onclick="getBeneDetails(\'' . $user->id . '\')" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addMyModal"><i class="fa fa-pencil" aria-hidden="true"></i> Initiate</button>' :
			'<button type="button" class="btn btn-dark btn-sm" disabled>Initiated</button>';
			}


            $data[] = $row;
        }
        $output = array(
            "recordsTotal" => $this->returnrecords_model->count_all(),
            "recordsFiltered" => $this->returnrecords_model->count_filtered(),
            "data" => $data
        );
        echo json_encode($output);


	}
	
	function updateData(){
		 // echo '<pre>==='; print_r($_POST); die;
		$allowData = $this->input->post('allowData');
		$recordId = $this->input->post('recordId');
		$reAccNo = $this->input->post('reAccNo');
		$beneName = $this->input->post('beneName');
		$accNo = $this->input->post('accNo');
		$ifscCode = $this->input->post('ifscCode');
		$sonof = $this->input->post('sonof');
		$beneMode = $this->input->post('beneMode');
		$userId = $this->input->post('userId');
		$userName = $this->input->post('userName');


		if($recordId==NULL){
			$message = "Invalid request";
			$response = array('message' => $message,'statusCode' => 'NP001');
			echo json_encode($response,200); die();
		}
		if($reAccNo!=$accNo || $reAccNo == NULL || $accNo == NULL){
			$message = "Account confirmation mismatched";
			$response = array('message' => $message,'statusCode' => 'NP001');
			echo json_encode($response,200); die();
		}
		$data = array(
			'name_of_bene' => $beneName,
			'account_number' => $accNo,
			'care_of' => $sonof,
			'ifsc_code' => $ifscCode,
			'bene_mode' => $beneMode,
			'annexure_status' => '10',
			'is_resubmitted' => '1',
			'initiation_id' => $userId ,
			'initiation_by' => $userName,
			'initiated_on' => date("Y-m-d H:m:s"),
			// 'annexure_status' => '12',
			'updated_on' => date("Y-m-d H:m:s"),
		);
		if($allowData == 'on'){
			$data['force_duplicate'] = 2;
		}
		// echo '<pre>==='; print_r($data); die;
		$result = $this->approve_model->scheduleBene($data, $recordId);
		if($result>=1){
			$message = "Scheduled successfully";
			$response = array('message' => $message,'statusCode' => 'NP000');
			echo json_encode($response,200); die();
		}else{
			$message = "FAILED ! Unable to map record";
			$response = array('message' => $message,'statusCode' => 'NP001');
			echo json_encode($response,200); die();
		}
	}

	function validateData(){
		// echo "<pre>==="; print_r($_POST); die;
	   $recordId = $this->input->post('recordId');
	   $beneName = $this->input->post('beneName');
	   $accNo = $this->input->post('accNo');
	   $reAccNo = $this->input->post('reAccNo');
	   $amount = $this->input->post('amount');
	   $ifscCode = $this->input->post('ifscCode');
	   $refNo = $this->input->post('refNo');
		$data = $refNo."RI1";
		//echo "<pre>==="; print_r($data); die;

	   $result = $this->approve_model->updateCustRef($recordId, $data);
		if($result<1){
			$response = array('message' => "Customer Reference Number not updated", 'statusCode' => 'NP002');
			echo json_encode($response,200); die();
		}
	   // if($reAccNo!=$accNo || $reAccNo == NULL || $accNo == NULL){
	   // 	$message = "Account confirmation mismatched";
	   // 	$response = array('message' => $message,'statusCode' => 'NP001');
	   // 	echo json_encode($response,200); die();
	   // }
	   // $data = array(
	   // 	// 'beneficiary_name' => $beneName,
	   // 	// 'account_number' => $accNo,
	   // 	// 'ifsc_code' => $ifscCode,
	   // 	'net_amount' => $amount
	   // );
	   $result = $this->approve_model->validateAmount($recordId, $accNo, $amount);
	   $data = array();

	   $annexureStatus = unserialize(UNCLAIMEDANNEXURESTATUS);
	   $annexureStatusOld = unserialize(ANNEXURE_STATUS);
	   $errorStatus = unserialize(UNCLAIMEDERRORSTATUS);

	   foreach ($result as $user) {
		   $row   = array();

		   $row[] = $user->beneficiary_name;
		   $row[] = $user->account_number;
		   $row[] = $user->net_amount;
		   $row[] = $user->customer_reference_number;
		   $row[] = $annexureStatusOld[$user->annexure_status];

		   // [created_on] => 2018-09-18 16:36:13
		   // [update_on] => 
		   // [uploaded_to_sftp_on] => 29-10-18
		   // [returned_on] => 2019-01-04 18:34:01
		   // [authorised_on] => 2018-09-25 10:22:21
		   // [rejected_on] => 
		   // [released_on] => 2018-09-26 17:08:41

		   if($user->released_on == 2){
			   if($user->annexure_status == 1){
				   $row[] = $user->created_on;
			   }else if($user->annexure_status == 2){
				   $row[] = $user->rejected_on;
			   }else if($user->annexure_status == 3){
				   $row[] = $user->authorised_on;
			   }else if($user->annexure_status == 4){
				   $row[] = $user->authorised_on;
			   }else if($user->annexure_status == 6){
				   $row[] = $user->returned_on;
			   }else if($user->annexure_status == 7){
				   $row[] = $user->uploaded_to_sftp_on;
			   }else if($user->annexure_status == 10){
				   $row[] = $user->authorised_on;
			   }else if($user->annexure_status == 11){
				   $row[] = $user->update_on;
			   }else if($user->annexure_status == 12){
				   $row[] = $user->uploaded_to_sftp_on;
			   }	

		   }else{
			   if($user->annexure_status == 1){
				   $row[] = $user->created_on;
			   }else if($user->annexure_status == 2){
				   $row[] = $user->created_on;
			   }else if($user->annexure_status == 3){
				   $row[] = $user->authorised_on;
			   }else if($user->annexure_status == 4){
				   $row[] = $user->rejected_on;
			   }else if($user->annexure_status == 5){
				   $row[] = $user->rejected_on;
			   }else if($user->annexure_status == 6){
				   $row[] = $user->returned_on;
			   }else if($user->annexure_status == 7){
				   $row[] = $user->released_on;
			   }else if($user->annexure_status == 8){
				   $row[] = $user->released_on;
			   }else if($user->annexure_status == 9){
				   $row[] = $user->released_on;
			   }else if($user->annexure_status == 10){
				   $row[] = $user->returned_on;
			   }else if($user->annexure_status == 11){
				   $row[] = $user->update_on;
			   }else if($user->annexure_status == 12){
				   $row[] = $user->uploaded_to_sftp_on;
			   }
		   }


		   $data[] = $row;
	   }
		   // echo "<pre>==="; print_r($data); die;

	   if(!empty($result)){
		   $response = array('message' => $data, 'statusCode' => 'NP000');
		   echo json_encode($response,200); die();
	   }else{
		   $response = array('message' => "No duplicate data found", 'statusCode' => 'NP001');
		   echo json_encode($response,200); die();
	   }
   }

}
