<?php
//ini_set("display_errors", "1");
ini_set('memory_limit','2048M');
error_reporting(0);
class cronDownload extends CI_Controller {

    function __construct() {
        $data =array();
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $data  =array('is_logged_in'=>$this->session->userdata('logged_in'));
        $this->load->model('download_model');        
        $this->load->helper('url');
        $this->load->helper('common_helper');
        $this->load->library('session');
        $session_data = $this->session->all_userdata();
        $this->role_id = $session_data['role_id'];
		// $zones = $session_data['zones'];
		// $i = 0;
		// foreach($zones as $zone){
		// 	$zone_id[$i] = $zone['id'];
		// 	$i += 1;
		// }
		// $this->zone_id = implode(",",$zone_id);
        // if($this->role_id == 6){
        //     $this->zone_id='ALL';
        // }

        $this->load->library('Classes/PHPExcel'); 
        $this->defined_annexure_col_array = array(
             'serial_no'           => 'Sr. No.',
             'sector_no'            => 'Sector no.',
             'zone_name'               => 'Zone',
             'villlage_name'           => 'Name of Village',
             'section_four_date'       => 'Date of Section 4 Notification (DD-MM-YY)',
             'section_six_date'        => 'Date of Section 6 Notification (DD-MM-YY)',
             'is_petition_filed'       => 'Whether petition filed by the land owner for release of land',
             'award_no'             => 'Award No.',
             'award_date'              => 'Date of Award (DD-MM-YY)',
             'khewat_no'                    => 'Khewat No.',
             'acquired_area'           => 'Acquired Area',
             'share_in_ownership'           => 'Share in the ownership',
             'acre'                         => 'Acre',
             'kanal'                        => 'Kanal',
             'marla'                        => 'Marla',
             'LAO_bank_account_no'         => 'Bank A/c No. of LAO from which payment is to be made',
             'beneficiary_name'                 => 'Name of Beneficiary',
             'ifsc_code'                 => 'IFSC Code of Beneficiary',
             'account_number'                 => 'A/c No. of Beneficiary',
             'care_of'                   => 'Care of',
             'net_amount'                       => 'Net Amount to be paid to Beneficiary',
             'is_EDC'               => 'EDC OR Non EDC [E= EDC, N = Non EDC]',
             'customer_reference_number'                => 'Ref. No.',
             'file_name'                    => 'File name',
             'file_ref_number'                    => 'File Ref. No.',
             'UTR'                => 'UTR',
             'annexure_status'    => 'Annexure_Status',
             'initiation_by'              =>'initiation_by',
             'initiated_on'           =>'Initiated on',
             'authorised_by'          =>'Authorised by',
             'authorised_on'          =>'Authorised on',
             'created_on'            => 'Uploaded on'
        );
    }

    function unclaimedReport(){
        // echo "<pre>===";print_r('hi');exit;
        // echo date('Y-m-d H:i:s');

        // print_r($this->zone_id); die;
        $defined_annexure_col_array = $this->defined_annexure_col_array;
        $file_path = 'report/Unclaimed/Total';

        $filename        = 'UnclaimedPayment_' . date('Y-m-d') . '.xlsx';
        $prev_filename   = 'UnclaimedPayment_' . date('Y-m-d', strtotime(' -1 day')) . '.xlsx';
        if(file_exists($file_path . '/' . $prev_filename)){
            unlink($file_path . '/' . $prev_filename);
        }
        if(file_exists($file_path . '/' . $filename)){
            unlink($file_path . '/' . $filename);
        }

        //echo "<pre>="; print_r(file_exists($file_path . '/' . $prev_filename)); die;
        //echo "<pre>="; print_r(unlink($file_path . '/' . $prev_filename)); die;

        $result = $this->download_model->unclaimed_txn();

        if (!empty($result)) {
            array_unshift($result, $defined_annexure_col_array);
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->getActiveSheet()->fromArray($result, null, 'A1');
            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            $objWriter->save($file_path . '/' . $filename);
            echo $filename; exit;
        }
    }


    function unclaimedReportByZone(){
        $result = $this->download_model->getZones();
        //echo "<pre>===";print_r($result);

        foreach ($result as $row)
        {
            //echo $row->id;
            $file_path = 'report/Unclaimed/Total';

            $filename = 'UnclaimedPayment_'.date('Y-m-d').'_'.$row->id.'.xlsx';
            $prev_filename = 'UnclaimedPayment_'.date('Y-m-d', strtotime(' -1 day')).'_'.$row->id.'.xlsx';
            if(file_exists($file_path . '/' . $prev_filename)){
                unlink($file_path . '/' . $prev_filename);
            }
            if(file_exists($file_path . '/' . $filename)){
                unlink($file_path . '/' . $filename);
            }

            $result = $this->download_model->unclaimedReportByZone($row->id);
    
            if (!empty($result)) {
                array_unshift($result, $this->defined_annexure_col_array);
                $objPHPExcel = new PHPExcel();
                $objPHPExcel->getActiveSheet()->fromArray($result, null, 'A1');
                $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
                $objWriter->save($file_path . '/' . $filename);
                echo $filename.'<br>';
            }
        }
        // echo date('Y-m-d H:i:s');
    }

    function unclaimedSuccessReportByZone(){
        $result = $this->download_model->getZones();
        //echo "<pre>===";print_r($result);

        foreach ($result as $row)
        {
            //echo $row->id;
            $file_path = 'report/Unclaimed/Success';

            $filename = 'UnclaimedPayment_'.date('Y-m-d').'_'.$row->id.'.xlsx';
            $prev_filename = 'UnclaimedPayment_'.date('Y-m-d', strtotime(' -1 day')).'_'.$row->id.'.xlsx';
            if(file_exists($file_path . '/' . $prev_filename)){
                unlink($file_path . '/' . $prev_filename);
            }
            if(file_exists($file_path . '/' . $filename)){
                unlink($file_path . '/' . $filename);
            }

            $result = $this->download_model->unclaimedSuccessReportByZone($row->id);
    
            if (!empty($result)) {
                array_unshift($result, $this->defined_annexure_col_array);
                $objPHPExcel = new PHPExcel();
                $objPHPExcel->getActiveSheet()->fromArray($result, null, 'A1');
                $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
                $objWriter->save($file_path . '/' . $filename);
                echo $filename.'<br>';
            }
        }
        // echo date('Y-m-d H:i:s');
    }

    function unclaimedRemainReportByZone(){
        $result = $this->download_model->getZones();
        //echo "<pre>===";print_r($result);

        foreach ($result as $row)
        {
            //echo $row->id;
            $file_path = 'report/Unclaimed/YetToPaid';

            $filename = 'UnclaimedPayment_'.date('Y-m-d').'_'.$row->id.'.xlsx';
            $prev_filename = 'UnclaimedPayment_'.date('Y-m-d', strtotime(' -1 day')).'_'.$row->id.'.xlsx';
            if(file_exists($file_path . '/' . $prev_filename)){
                unlink($file_path . '/' . $prev_filename);
            }
            if(file_exists($file_path . '/' . $filename)){
                unlink($file_path . '/' . $filename);
            }

            $result = $this->download_model->unclaimedRemainReportByZone($row->id);

            if (!empty($result)) {
                array_unshift($result, $this->defined_annexure_col_array);
                $objPHPExcel = new PHPExcel();
                $objPHPExcel->getActiveSheet()->fromArray($result, null, 'A1');
                $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
                $objWriter->save($file_path . '/' . $filename);
                echo $filename.'<br>';
            }
        }
        // echo date('Y-m-d H:i:s');
    }
 
}

