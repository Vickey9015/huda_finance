<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// error_reporting(0);
class Waitingforapproval extends CI_Controller {

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
		$this->load->model('Waitingforapproval_model');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('common_helper');
		date_default_timezone_set('Asia/Kolkata');
    }

	function UpdatedRecordList(){
		// $annexure_status = $this->uri->segment(3);
		if(in_array($this->role_id, ['3','4','5','9'], TRUE)){
			$session_data        = $this->session->all_userdata();
			$data =array('session_data'=>$session_data);
			//$data =array('session_data'=>$session_data);
			//echo"<pre>==";print_r($data);exit;
			$this->load->view('layout/header', $data);
			$this->load->view('layout/topbar', $data);
			$this->load->view('layout/unleftbar', $data);
			$this->load->view('waitingforapproval_view',$data);
		}else{
			redirect(base_url());
		}

	}

	function GetUpdatedRecordList(){
		// echo "<pre>==="; print_r(ANNEXURE);
		//$ref_no = $_POST['data'];
        //  echo 'hlw'; die();
        //$session_data = $this->session->all_userdata();
        $userData = $this->Waitingforapproval_model->get_datatables();
        // echo '<pre>==='; print_r($userData);die;
		$data = array();
		$annexureStatus = unserialize(UNCLAIMEDANNEXURESTATUS);
		$modeType= array("1"=>"RTGS", "2"=>"NEFT", "3"=>"Cheque", "4"=>"DD");
        
        //$sn = 1;
        foreach ($userData as $user) {
            // echo '<pre>'; print_r($user);die;
            //$url = base_url('/UserKycLoader/userKycPDF/') . $user->id;
           // $sn++;
            $row   = array();
            //$row[] = $sn;

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
			$row[] = "<span id='getAcc_".$user->id."'>".$user->account_number."</span>";
			$row[] = $modeType[$user->bene_mode];
			$row[] = $user->ifsc_code;
			$row[] = $user->care_of;
			$row[] = $user->is_edc;
			$row[] = $user->customer_ref_numer;
			$row[] = $user->file_ref_number;
			$row[] = $user->file_name;
			$row[] = "<span id='getAmount_".$user->id."'>".$user->net_amount."</span>";
			$row[] = $user->initiation_by;
			$row[] = $user->initiated_on;
			$row[] = $user->authorised_by;
			$row[] = $user->authorised_on;
			// $row[] = $user->bene_updated_by;
			// $row[] = ($user->bene_updated_on) ? date('d-m-Y', strtotime($user->bene_updated_on)) : '';
			$row[] = ($user->force_duplicate == 2) ? "<span class='text-danger'>Forced</span>":"<span class='text-success'> </span>";
			$row[] = $user->UTR;
			$row[] = $user->StatusCode;
			$row[] = $user->StatusDesc;
			$row[] = $annexureStatus[$user->annexure_status];
			//$row[] = $user->is_scheduled;
			$row[] = date('d-m-Y', strtotime($user->created_on));
			if($this->role_id == 4){
				if($user->annexure_status == 2){
					$row[] = '<span><button type="button" onclick="getBeneDetails(\'' . $user->id . '\')" class="btn btn-success btn-sm"><i class="fa fa-check" aria-hidden="true"></i> Approve</button><br>
					<button type="button" style="margin-top:5px" onclick="rejectBeneDetails(\'' . $user->id . '\')" class="btn btn-danger btn-sm"><i class="fa fa-times" aria-hidden="true"></i> Reject</button></span>';
				}else if($user->annexure_status == 3){
					$row[] = '<button type="button" class="btn btn-dark btn-sm" disabled>Approved</button>';
				}else if($user->annexure_status == 4){
					$row[] = '<button type="button" class="btn btn-dark btn-sm" disabled>Rejected</button>';
				}else{

				}
			}

            $data[] = $row;
        }
        $output = array(
            "recordsTotal" => $this->Waitingforapproval_model->count_all(),
            "recordsFiltered" => $this->Waitingforapproval_model->count_filtered(),
            "data" => $data
        );
        echo json_encode($output);
	}

}
