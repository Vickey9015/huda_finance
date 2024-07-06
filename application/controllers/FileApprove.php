<?php

error_reporting(0);
class FileApprove extends CI_Controller {

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
		$zones = $session_data['zones'];
		$i = 0;
		foreach($zones as $zone){
			$zone_id[$i] = $zone['id'];
			$i += 1;
		}
		$this->zone_id = implode(",",$zone_id);
        if(!$this->session->userdata('logged_in')){
			redirect(base_url().'user/index');

		}
		$this->load->model('approve_model');
		$this->load->model('approvefiledata_model');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('common_helper');
		date_default_timezone_set('Asia/Kolkata');
    }


	function getRecords(){
		$ref_no = $this->uri->segment(3);
		if(in_array($this->role_id, ['3','4','5','9'], TRUE)){
			$session_data        = $this->session->all_userdata();
			$status = $this->approve_model->getStatus($ref_no);
			$data =array('session_data'=>$session_data,'ref_no'=>$ref_no,'status'=>$status);
			//echo"<pre>==";print_r($data);exit;
			$this->load->view('layout/header', $data);
			$this->load->view('layout/topbar', $data);
			$this->load->view('layout/unleftbar', $data);
			$this->load->view('approveFilesData',$data);
		}else{
			redirect(base_url());
		}

	}

 function approveFiles(){
		if(in_array($this->role_id, ['3','4','5','9'], TRUE)){
		$data =array();
            if(!empty($_POST)){
				  $this->form_validation->set_rules('fromDate', 'From Date', 'trim|required|min_length[10]|max_length[10]');
		          $this->form_validation->set_rules('toDate', 'To Date', 'trim|required|min_length[10]|max_length[10]');
		          $this->form_validation->set_error_delimiters('<div style="color:red">', '</div>');
		          $validate = $this->form_validation->run();
					if($validate == FALSE){
					}else{
					$startDate          = $_POST['fromDate'];
					$toDate             = $_POST['toDate'];
					$result             = $this->approve_model->getFileWithStatus($startDate,$toDate,$this->zone_id);
					}
				}else{
				    $startDate          = date('d-m-Y');
					$toDate             = date('d-m-Y');
				    $result             = $this->approve_model->getFileWithStatus($startDate,$toDate,$this->zone_id);
                }
        $session_data        = $this->session->all_userdata();
		$data =array('result'=>$result,'session_data'=>$session_data);
		//echo"<pre>==";print_r($data);exit;
		$this->load->view('layout/header', $data);
        $this->load->view('layout/topbar', $data);
		$this->load->view('layout/unleftbar', $data);
		$this->load->view('approveFiles',$data);
		}else{
		    redirect(base_url());
		}
	}


	function approveData(){

		if(in_array($this->role_id, ['3','4'], TRUE)){
			$data =array();
				if(!empty($_POST)){
					$id = array_values($_POST['values'][0]);
					$ref_no = array_values($_POST['values'][1]);
					//$usertype = array_values($_POST['values'][2]);
					//echo "<pre>=hlw="; print_r($_POST['values'][2]); die;
					if($_POST['values'][2]=='Approve'){
						//echo "<pre>=hlw="; print_r($_POST); die;
					$result = $this->approve_model->updateApproveStatus($id);
					$result = $this->approve_model->updateApproveStatusInData($ref_no);

					}else if ($_POST['values'][2]=='ApproveLAO') {
						//echo "<pre>=hl"; print_r($_POST); die;
					$result = $this->approve_model->updateReleaseStatus($id);
					$result = $this->approve_model->updateRelaseStatusInData($ref_no);
					}

					//echo "<pre>ioklw="; print_r($_POST); die;


					//echo "<pre>=hlw="; print_r($result);
					$message = "Files approved successfully";
					$response = array('message' => $message,'statusCode' => 'NP000');
					echo json_encode($response,200); exit();

			}else{
				redirect(base_url());
			}
		}

	}

	function getRecords_old(){
		$ref_no = $this->uri->segment(3);
		if(in_array($this->role_id, ['3','4','5','9'], TRUE)){
			$data =array();
				if(!empty($_POST)){
					  $this->form_validation->set_rules('fromDate', 'From Date', 'trim|required|min_length[10]|max_length[10]');
					  $this->form_validation->set_rules('toDate', 'To Date', 'trim|required|min_length[10]|max_length[10]');
					  $this->form_validation->set_error_delimiters('<div style="color:red">', '</div>');
					  $validate = $this->form_validation->run();
						if($validate == FALSE){
						}else{
						$startDate          = $_POST['fromDate'];
						$toDate             = $_POST['toDate'];
						$result             = $this->approve_model->getFileDataWithStatus($startDate,$toDate,$ref_no);
						}
					}else{
						$startDate          = date('d-m-Y');
						$toDate             = date('d-m-Y');
						$result             = $this->approve_model->getFileDataWithStatus($startDate,$toDate,$ref_no);
					}
			$session_data        = $this->session->all_userdata();
			$data =array('result'=>$result,'session_data'=>$session_data);
			//echo"<pre>==";print_r($data);exit;
			$this->load->view('layout/header', $data);
			$this->load->view('layout/topbar', $data);
			$this->load->view('layout/unleftbar', $data);
			$this->load->view('approveFilesData',$data);
			}else{
				redirect(base_url());
			}

	}
	function getRecordList(){
		$status = $this->uri->segment(3);
		if(in_array($this->role_id, ['3','4','5','6'], TRUE)){
			$data =array();
				if(!empty($_POST)){
					  $this->form_validation->set_rules('fromDate', 'From Date', 'trim|required|min_length[10]|max_length[10]');
					  $this->form_validation->set_rules('toDate', 'To Date', 'trim|required|min_length[10]|max_length[10]');
					  $this->form_validation->set_error_delimiters('<div style="color:red">', '</div>');
					  $validate = $this->form_validation->run();
					if($validate == FALSE){
					}else{
						$startDate          = $_POST['fromDate'];
						$toDate             = $_POST['toDate'];
						$result             = $this->approve_model->getDashbaordDataWithStatus($startDate,$toDate,$status,$this->zone_id);
						}
					}else{
						$startDate          = date('d-m-Y');
						$toDate             = date('d-m-Y');
						$result             = $this->approve_model->getDashbaordDataWithStatus($startDate,$toDate,$status,$this->zone_id);
					}
					//echo"<pre>==";print_r($result);exit;
			$session_data        = $this->session->all_userdata();
			$data =array('result'=>$result,'session_data'=>$session_data);
			//echo"<pre>==";print_r($data);exit;
			$this->load->view('layout/header', $data);
			$this->load->view('layout/topbar', $data);
			$this->load->view('layout/unleftbar', $data);
			$this->load->view('approveFilesDataList',$data);
			}else{
				redirect(base_url());
			}

	}
	function getPaidRecords(){
		$status = $this->uri->segment(3);
		if(in_array($this->role_id, ['3','4','5','6'], TRUE)){
			$data =array();
				if(!empty($_POST)){
					  $this->form_validation->set_rules('fromDate', 'From Date', 'trim|required|min_length[10]|max_length[10]');
					  $this->form_validation->set_rules('toDate', 'To Date', 'trim|required|min_length[10]|max_length[10]');
					  $this->form_validation->set_error_delimiters('<div style="color:red">', '</div>');
					  $validate = $this->form_validation->run();
					if($validate == FALSE){
					}else{
						$startDate          = $_POST['fromDate'];
						$toDate             = $_POST['toDate'];
						$result             = $this->approve_model->getDashbaordPAidDataWithStatus($startDate,$toDate,$status,$this->zone_id);
						}
					}else{
						$startDate          = date('d-m-Y');
						$toDate             = date('d-m-Y');
						$result             = $this->approve_model->getDashbaordPAidDataWithStatus($startDate,$toDate,$status,$this->zone_id);
					}
					//echo"<pre>==";print_r($result);exit;
			$session_data        = $this->session->all_userdata();
			$data =array('result'=>$result,'session_data'=>$session_data);
			//echo"<pre>==";print_r($data);exit;
			$this->load->view('layout/header', $data);
			$this->load->view('layout/topbar', $data);
			$this->load->view('layout/unleftbar', $data);
			$this->load->view('approveFilesDataList',$data);
			}else{
				redirect(base_url());
			}

	}

	function verifyOTP(){
		try{
			if($this->input->server('REQUEST_METHOD') != 'POST'){
				$message = "Invalid request method";
				$response = array('message' => $message,'statusCode' => 'NP001');
				echo json_encode($response,200); exit();
			}
			$this->form_validation->set_rules('otp', 'otp', 'trim|required|xss_clean|min_length[6]|max_length[6]');
			$runValidation = $this->form_validation->run();
			if($runValidation == FALSE){
				$message = "Invalid OTP";
				$response = array('message' => $message,'statusCode' => 'NP001');
				echo json_encode($response,200); exit();
			}
			$otp = strip_tags($_POST['otp']);
			$session_data = $this->session->all_userdata();
			$id = $session_data['id'];
			$result = $this->approve_model->getUserData($id);
			$result_otp = $result[0]['otp'];
			// print_r($result); die;
			if($otp==$result_otp){
				$message = "OTP verified";
				$response = array('message' => $message,'statusCode' => 'NP000');
				echo json_encode($response,200); exit();
			}else{
				$message = "Incorrect OTP";
				$response = array('message' => $message,'statusCode' => 'NP002');
				echo json_encode($response,200); exit();
			}
		} catch (\Exception $e) {
			echo $e->getMessage();
			$error = array('status' => 0, "msg" => "Internal Server Error - Please try Later.","statusCode"=> "NP999");
			echo json_encode($error, 200); die();
		}

	}

	public function verifyPassword(){
		try {
			if($this->input->server('REQUEST_METHOD') != 'POST'){
				$message = "Invalid request method";
				$response = array('message' => $message,'statusCode' => 'NP001');
				echo json_encode($response,200); exit();
			}
			//echo '<pre>user==='; print_r($_POST); die;
			$this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean|min_length[8]|max_length[16]');
			$runValidation = $this->form_validation->run();
			if($runValidation == FALSE){
				$message = "Invalid Password";
				$response = array('message' => $message,'statusCode' => 'NP001');
				echo json_encode($response,200); exit();
			}
			$password = strip_tags($_POST['password']);

			// echo '<pre>user==='.$password; die;
			$session_data = $this->session->all_userdata();
			$user_id = $session_data['id'];
			//echo '<pre>user==='; print_r($session_data); die;

			$result = $this->approve_model->getUserData($user_id);
			$result_pass = $result[0]['password'];
			// echo '<pre>user==='; print_r($result); die;
			 $plain_password = $result_pass;
			if ($result_pass) {
				$key = $this->config->item('encryption_key');
				//echo '<pre>user==='; print_r($key); die;
				//$plain_password = $this->encrypt->decode($result_pass, $key);
			}
			 $password = hash_hmac(ENCTYPE, $password, SHA512ENCKEY);
				//print_r($plain_password); die;
			if($password==$plain_password){
				$result = $this->approve_model->getUserData($user_id);
				// print_r($result);die;
				if(!empty($result)){
					$phone = $result[0]['phone'];
					$otp = createOTP();
					updateUserOTP($user_id,$otp);
					$message = "$otp is your OTP for login. Please do not share with anyone. - IndusInd Bank";
					sendMessageByFirstValue($phone,$message,1);
					$message = "OTP sent to registered mobile number";
					$response = array('message' => $message,'statusCode' => 'NP000');
				}else{
					$message = "User mobile number not found";
					$response = array('message' => $message,'statusCode' => 'NP002');
				}
				echo json_encode($response,200); exit();
			}else{
				$message = "Incorrect Password";
				$response = array('message' => $message,'statusCode' => 'NP003');
				echo json_encode($response,200); exit();
			}


		}  catch (\Exception $e) {
			echo $e->getMessage();
			$error = array('status' => 0, "msg" => "Internal Server Error - Please try Later.","statusCode"=> "NP999");
			echo json_encode($error, 200); die();
		}
	}

	function fetchData(){
		//$ref_no = $_POST['data'];
        // echo 'hlw'; die();
        //$session_data = $this->session->all_userdata();
        $userData = $this->approvefiledata_model->get_datatables();
		// echo '<pre>1==='; print_r($userData);die;
		
		$annexureStatus = unserialize(UNCLAIMEDANNEXURESTATUS);
		$errorStatus = unserialize(UNCLAIMEDERRORSTATUS);
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
			$row[] = $user->ifsc_code;
			$row[] = "<span id='getsonof_".$user->id."'>".$user->care_of."</span>";
			//$row[] = $user->care_of;
			$row[] = $user->is_edc;
			$row[] = $user->customer_ref_numer;
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
				$row[] = ($user->annexure_status == 1) ? '<button type="button" onclick="getBeneDetails(\'' . $user->id . '\')" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addMyModal"><i class="fa fa-pencil" aria-hidden="true"></i> Schedule</button>' :
			'<button type="button" class="btn btn-dark btn-sm" disabled>Scheduled</button>';
			}



            $data[] = $row;
        }
        $output = array(
            "recordsTotal" => $this->approvefiledata_model->count_all(),
            "recordsFiltered" => $this->approvefiledata_model->count_filtered(),
            "data" => $data
        );
        echo json_encode($output);


	}

	function updateData(){
		//  echo '<pre>==='; print_r($_POST); die;
		$allowData = $this->input->post('allowData');
		$recordId = $this->input->post('recordId');
		$reAccNo = $this->input->post('reAccNo');
		$beneName = $this->input->post('beneName');
		$sonof = $this->input->post('sonof');
		$accNo = $this->input->post('accNo');
		$ifscCode = $this->input->post('ifscCode');
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
			'care_of' => $sonof,
			'account_number' => $accNo,
			'ifsc_code' => $ifscCode,
			'bene_mode' => $beneMode,
			'annexure_status' => '2',
			'initiation_id' => $userId ,
			'initiation_by' => $userName,
			'initiated_on' => date("Y-m-d H:m:s"),
			// 'annexure_status' => '12',
			'updated_on' => date("Y-m-d H:m:s"),
		);
		if($allowData == 'on'){
			$data['force_duplicate'] = 2;
		}
		//echo '<pre>==='; print_r($data); die;
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


	function rejectData(){
		//  echo "<pre>==="; print_r($_POST); die;
		$recordId = $this->input->post('recordId');
		$userId = $this->input->post('userId');
		$userName = $this->input->post('userName');
		$reason = $this->input->post('reason');

		$data = array(
			'annexure_status' => '4',
			'authoriser_id' => $userId,
			'authorised_by' => $userName,
			'reject_reason' => $reason,
			'authorised_on' => date("Y-m-d H:m:s"),
			'updated_on' => date("Y-m-d H:m:s"),
		);
		$result = $this->approve_model->scheduleBene($data, $recordId);
		if($result>=1){
			$message = "Rejected successfully";
			$response = array('message' => $message,'statusCode' => 'NP000');
			echo json_encode($response,200); die();
		}else{
			$message = "FAILED ! Unable to map record";
			$response = array('message' => $message,'statusCode' => 'NP001');
			echo json_encode($response,200); die();
		}
	}

	function updateDataFinal(){
		// echo "<pre>==="; print_r($_POST); die;
		$recordId = $this->input->post('recordId');
		$userId = $this->input->post('userId');
		$userName = $this->input->post('userName');

		$data = array(
			'annexure_status' => '3',
			'authoriser_id' => $userId,
			'authorised_by' => $userName,
			'authorised_on' => date("Y-m-d H:m:s"),
			'updated_on' => date("Y-m-d H:m:s"),
		);

		$result = $this->approve_model->scheduleBene($data, $recordId);
		if($result>=1){
			$message = "Approved successfully";
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
		$sonof = $this->input->post('sonof');

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
		//  echo "<pre>==="; print_r($result); die;

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
