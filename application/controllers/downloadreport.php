f<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('memory_limit', '-1');

class downloadreport extends CI_Controller {

    function __construct() {
        $data =array();
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $data  =array('is_logged_in'=>$this->session->userdata('logged_in'));
       
        $this->load->model('user_model');
       // $this->load->model('cron_model');
        $this->load->model('downloadreport_model');        
        $this->load->helper('url');
        $this->load->helper('common_helper');
        $this->load->library('session');
        
    }

   
    function download_OriginalReport(){
        // echo "<pre>===";print_r('hi');exit;
        echo date('Y-m-d H:i:s');
        /** Include PHPExcel */
        $this->load->library('Classes/PHPExcel');
        
        
            $getAnxVal                  = 1; 
           // echo "<pre>=";print_r($getAnxVal); echo "<hr/>";
            $rootPath = 'report';
            $annexure_path_array        =    array('1' => 'Original_Award', '2' => 'Lower_Court','3'=>'Higher_Court','4'=>'Supreme_Court','5'=>'DD_Upload');
            $annexure_abbr_array        =    array('1' => 'OA', '2' => 'LC','3'=>'HC','4'=>'SC','5'=>'SCDD','6'=>'ODD','7'=>'LCDD','8'=>'HCDD');
            $annexure_type              =    unserialize(ANNEXURE_TYPE);
            $annexure                   =    unserialize(ANNEXURE);
                $defined_annexure_col_array = array(
                              'file_name'                    => 'file name',
                              'zone_name'                    => 'Zone',
                              'customer_reference_number'                => 'Ref. No.',
                              'serial_no'           => 'Sr. No.',
                              'sector_no'            => 'Sector no.',
                              'villlage_name'                     => 'Name of Village',
                              'section_notfn_date'                   => 'Date of Section 6 Notification (DD-MM-YY)',
                              'is_petition_filed'          => 'Whether petition filed by the land owner for release of land',
                              'award_no'             => 'Award No.',
                              'award_date'              => 'Date of Award (DD-MM-YY)',
                              'LAO_bank_account_no'         => 'Bank A/c No. of LAO from which payment is to be made',
                              'beneficiary_name'                 => 'Name of Beneficiary',
                              'khewat_no'                    => 'Khewat No.',
                              'share_in_ownership'           => 'Share in the ownership',
                              'acre'                         => 'Acre',
                              'kanal'                        => 'Kanal',
                              'marla'                        => 'Marla',
                              'beneficiary_PAN'                   => 'PAN NO.',
                              'gross_amount_to_paid'                    => 'Gross Amount to be Paid',
                              'TDS_deducted'               => 'TDS to be deducted',
                              'net_amount'                       => 'Net Amount to be paid to Beneficiary',
                              'ifsc_code'                => 'IFSC code of Beneficiary',
                              'account_number'    => 'Bank A/c of the Beneficiary',
                              
                              'is_EDC'               => 'EDC OR Non EDC [E= EDC, N = Non EDC]',
                              'mobile_number'                       => '10- Digit Mobile Number',
                              'authorised_on'                => 'Authorized On',
                              'released_on'    => 'Released On',
                              'returned_on'               => 'Returned On',
                              'rejected_on'                       => 'Rejected On',
                              'is_return'                => 'Status',
                              'is_resubmitted'                => 'Resubmitted',
                             
                              );
                                          
                    $filename                   = $annexure_abbr_array[$getAnxVal].'_'.date('Y-m-d').'.xlsx';
                   
                   $result = $this->downloadreport_model->getOriginaltxn($getAnxVal);
                   if(!empty($result)){
                        $result1 = array_unshift($result , $defined_annexure_col_array);
                        $file_path = $rootPath.'/'.$annexure_type[$getAnxVal];
                      
                        $objPHPExcel = new PHPExcel();
                       
                        $objPHPExcel->getActiveSheet()->fromArray($result, null, 'A1');
                        
                         $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
                         $objWriter->save($file_path.'/'.$filename);
                         echo $filename; exit;
                    }

    }

    function download_LowerCourtReport(){
        
        echo date('Y-m-d H:i:s');
       
        $this->load->library('Classes/PHPExcel');
        $getAnxVal             = 2; 
          
            $rootPath = 'report';
            $annexure_path_array        =    array('1' => 'Original_Award', '2' => 'Lower_Court','3'=>'Higher_Court','4'=>'Supreme_Court','5'=>'DD_Upload');
           $annexure_abbr_array        =    array('1' => 'OA', '2' => 'LC','3'=>'HC','4'=>'SC','5'=>'SCDD','6'=>'ODD','7'=>'LCDD','8'=>'HCDD');
            $annexure_type              =    unserialize(ANNEXURE_TYPE);
            $annexure                   =    unserialize(ANNEXURE);
           
                    $defined_annexure_col_array = array(
                              'file_name'                    => 'file name',
                              'zone_name'                    => 'Zone',
                              'customer_reference_number'                => 'Ref. No.',
                              'sector_no'            => 'Sector no.',
                              'villlage_name'                     => 'Name of Village',
                              'award_no'                   => 'Award No.',
                              'award_date'          => 'Date of Award',
                              'LAO_bank_account_no'             => 'Bank A/c of LAO',
                              'beneficiary_name'              => 'Beneficiary name',
                              'khewat_no'                    => 'Khewat No.',
                              'share_in_ownership'           => 'Share in the ownership',
                              'acre'                         => 'Acre',
                              'kanal'                        => 'Kanal',
                              'marla'                        => 'Marla',
                              'beneficiary_PAN'         => 'Pan No.',
                              'gross_amount_to_paid'                 => 'Gross Amount',
                              'TDS_deducted'                   => 'TDS to be deducted',
                              'net_amount'                    => 'Net Amt.',
                              'ifsc_code'               => 'IFSC Code',
                              'account_number'             => 'Bank A/c of the Beneficiary',
                              'is_EDC'                => 'EDC OR Non EDC',
                              'mobile_number'    => 'Mobile Number',
                              
                              'authorised_on'               => 'Authorized On',
                              'released_on'                       => 'Released On',
                              'returned_on'                => 'Returned On',
                              'rejected_on'    => 'Rejected On',
                              'is_return'                => 'Annexure Status',
                              'is_resubmitted'                => 'Resubmitted',
                             
                              );
                       
                   
                    $filename                   = $annexure_abbr_array[$getAnxVal].'_'.date('Y-m-d').'.xlsx';
                    $result = $this->downloadreport_model->getLowertxn($getAnxVal);
                   
                    if(!empty($result)){
                        
                      
                        $result1 = array_unshift($result , $defined_annexure_col_array);
                    
                        $file_path = $rootPath.'/'.$annexure_type[$getAnxVal];
                        
                        $objPHPExcel = new PHPExcel();
                        $objPHPExcel->getActiveSheet()->fromArray($result, null, 'A1');
                        
                         $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
                         $objWriter->save($file_path.'/'.$filename);
                         echo $filename; exit;
                       
                    }
                
    }
    
   
 function download_HighCourtReport(){
        // echo "<pre>===";print_r('hi');exit;
        echo date('Y-m-d H:i:s');
        /** Include PHPExcel */
        $this->load->library('Classes/PHPExcel');
        
        
            $getAnxVal                  = 3; 
          $rootPath = 'report';
            $annexure_path_array        =    array('1' => 'Original_Award', '2' => 'Lower_Court','3'=>'Higher_Court','4'=>'Supreme_Court','5'=>'DD_Upload');
           $annexure_abbr_array        =    array('1' => 'OA', '2' => 'LC','3'=>'HC','4'=>'SC','5'=>'SCDD','6'=>'ODD','7'=>'LCDD','8'=>'HCDD');
            $annexure_type              =    unserialize(ANNEXURE_TYPE);
            $annexure                   =    unserialize(ANNEXURE);

                    $defined_annexure_col_array = array(
                              'file_name'                    => 'file name',
                              'zone_name'                    => 'Zone',
                              'customer_reference_number'                => 'Ref. No.',
                              'serial_no'                    => 'Sr. No.',
                              
                              'sector_no'            => 'Sector no.',
                              'villlage_name'                     => 'Name of Village',
                              'LAO_bank_account_no'        => 'Bank A/c No. of LAO from which payment is to be made',
                              'award_no'          => 'Award No.',
                              'award_date'             => 'Date of Award (DD-MM-YY)',
                              'ADJ_court_order_no'              => 'ADJ Court Order No.',
                              'ADJ_court_decision_date'         => 'Date of Decision by ADJ Court (DD-MM-YY)',
                              'high_court_order_no'                 => 'High Court Order No.',
                              'high_court_decision_date'                   => 'Date of Decision by High Court (DD-MM-YY)',
                              'beneficiary_name'                    => 'Beneficiary name',
                              'khewat_no'                    => 'Khewat No.',
                              'share_in_ownership'           => 'Share in the ownership',
                              'acre'                         => 'Acre',
                              'kanal'                        => 'Kanal',
                              'marla'                        => 'Marla',
                              'beneficiary_PAN'               => 'Pan No',
                              'gross_amount_to_paid'       => 'Gross Amount',
                              'TDS_deducted'                => 'TDS to be deducted',
                              'net_amount'    => 'Net Amount to be paid to Beneficiary',
                              
                              'ifsc_code'               => 'IFSC code of Beneficiary',
                              'account_number'                       => 'Bank A/c of the Beneficiary',
                              'is_EDC'                => 'EDC OR Non EDC [E= EDC, N = Non EDC]',
                              'mobile_number'    => '10 Digit Mobile number',
                              'authorised_on'                => 'Authorized On',
                              'released_on'                => 'Released On',
                               'returned_on'                => 'Returned On',
                              'rejected_on'    => 'Rejected On',
                              'is_return'                => 'Status',
                              'is_resubmitted'                => 'Resubmitted',
                             
                              );
                        
                    $filename                   = $annexure_abbr_array[$getAnxVal].'_'.date('Y-m-d').'.xlsx';
                   
                    $result = $this->downloadreport_model->getHighCourttxn($getAnxVal);
                   
                    if(!empty($result)){
                        
                       
                        $result1 = array_unshift($result , $defined_annexure_col_array);
                    
                        $file_path = $rootPath.'/'.$annexure_type[$getAnxVal];
                        
                        $objPHPExcel = new PHPExcel();
                        $objPHPExcel->getActiveSheet()->fromArray($result, null, 'A1');
                        
                         $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
                         $objWriter->save($file_path.'/'.$filename);
                         echo $filename; exit;
                    }
                
    }

    function download_SupremeCourtReport(){
        // echo "<pre>===";print_r('hi');exit;
        echo date('Y-m-d H:i:s');
        /** Include PHPExcel */
        $this->load->library('Classes/PHPExcel');
        
        
            $getAnxVal                  = 4; 
           $rootPath = 'report';
            $annexure_path_array        =    array('1' => 'Original_Award', '2' => 'Lower_Court','3'=>'Higher_Court','4'=>'Supreme_Court','5'=>'DD_Upload');
            $annexure_abbr_array        =    array('1' => 'OA', '2' => 'LC','3'=>'HC','4'=>'SC','5'=>'SCDD','6'=>'ODD','7'=>'LCDD','8'=>'HCDD');
            $annexure_type              =    unserialize(ANNEXURE_TYPE);
            $annexure                   =    unserialize(ANNEXURE);
                    $defined_annexure_col_array = array(
                              'file_name'                    => 'file name',
                              'zone_name'                    => 'Zone',
                              'customer_reference_number'                => 'Ref. No.',
                              
                              'sector_no'            => 'Sector no.',
                              'villlage_name'                     => 'Name of Village',
                              'award_no'        => 'Award No.',
                              'award_date'          => 'Date of Award',
                              'LAO_bank_account_no'             => 'Bank A/c of LAO',
                              'beneficiary_name'              => 'Beneficiary name',
                              'khewat_no'                    => 'Khewat No.',
                              'share_in_ownership'           => 'Share in the ownership',
                              'acre'                         => 'Acre',
                              'kanal'                        => 'Kanal',
                              'marla'                        => 'Marla',
                              'ADJ_court_order_no'         => 'ADJ Court Order No.',
                              'ADJ_court_decision_date'                 => 'Date of Decision by ADJ Court',
                              'high_court_order_no'                   => 'High Court Order No.',
                              'high_court_decision_date'                    => 'Date of Decision by High Court',
                              'supreme_court_order_no'               => 'Supreme Court Order No.',
                              'supreme_court_decision_date'       => 'Date of Decision by Supreme Court',
                              'beneficiary_PAN'                => 'Pan No.',
                              'gross_amount_to_paid'    => 'Gross Amount',
                              
                              'TDS_deducted'               => 'TDS to be deducted',
                              'net_amount'                       => 'Net Amt.',
                              'ifsc_code'                => 'IFSC Code',
                              'account_number'    => 'Bank A/c of the Beneficiary',
                              'is_EDC'                => 'EDC OR Non EDC',
                              'mobile_number'                => 'Mobile Number',
                               'authorised_on'                => 'Authorized On',
                              'released_on'    => 'Released On',
                              'returned_on'                => 'Returned On',
                              'rejected_on'                => 'Rejected On',
                              'is_return'                => 'Status',
                              'is_resubmitted'                => 'Resubmitted',
                             
                              );
                         
                   $filename                   = $annexure_abbr_array[$getAnxVal].'_'.date('Y-m-d').'.xlsx';
                    //echo "<pre>==";print_r($filename);exit;
                    $result = $this->downloadreport_model->getSupremeCourttxn($getAnxVal);
                   // echo "<pre>==";print_r($result);exit;
                    if(!empty($result)){
                       $result1 = array_unshift($result , $defined_annexure_col_array);
                    
                        $file_path = $rootPath.'/'.$annexure_type[$getAnxVal];
                        
                        $objPHPExcel = new PHPExcel();
                        $objPHPExcel->getActiveSheet()->fromArray($result, null, 'A1');
                        
                         $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
                         $objWriter->save($file_path.'/'.$filename);
                         echo $filename; exit;
                    }
                
    }   
   
    function download_SupremeCourtDDReport(){
        // echo "<pre>===";print_r('hi');exit;
        echo date('Y-m-d H:i:s');
        /** Include PHPExcel */
        $this->load->library('Classes/PHPExcel');
        
        
            $getAnxVal                  = 5; 
            $rootPath = 'report';
            $annexure_path_array        =    array('1' => 'Original_Award', '2' => 'Lower_Court','3'=>'Higher_Court','4'=>'Supreme_Court','5'=>'DD_Upload');
           $annexure_abbr_array        =    array('1' => 'OA', '2' => 'LC','3'=>'HC','4'=>'SC','5'=>'SCDD','6'=>'ODD','7'=>'LCDD','8'=>'HCDD');
            $annexure_type              =    unserialize(ANNEXURE_TYPE);
            $annexure                   =    unserialize(ANNEXURE);
           
                    $defined_annexure_col_array = array(
                              'file_name'                    => 'file name',
                              'zone_name'                    => 'Zone',
                              'serial_no'                => 'Sr. No.',
                              
                              'customer_reference_number'            => 'Ref. No.',
                              'sector_no'                     => 'Sector No.',
                              'villlage_name'        => 'Name of Village',
                              'LAO_bank_account_no'          => 'Bank A/c No. of LAO from which payment is to be made',
                              'award_no'             => 'Award No.',
                              'award_date'              => 'Date of Award (DD-MM-YY)',
                              'ADJ_court_order_no'         => 'ADJ Court Order No.',
                              'ADJ_court_decision_date'                 => 'Date of Decision by ADJ Court (DD-MM-YY)',
                              'high_court_order_no'          => 'High Court Order No.',
                              'high_court_decision_date'                    => 'Date of Decision by High Court (DD-MM-YY)',
                              'supreme_court_order_no'               => 'Supreme Court order Order No.',
                              'supreme_court_decision_date'       => 'Date of Decision by Supreme Court (DD-MM-YY)',
                              'beneficiary_name'                => 'Name of Beneficiary',
                              'khewat_no'                    => 'Khewat No.',
                              'share_in_ownership'           => 'Share in the ownership',
                              'acre'                         => 'Acre',
                              'kanal'                        => 'Kanal',
                              'marla'                        => 'Marla',
                              'beneficiary_PAN'    => 'PAN NO',
                              
                              'gross_amount_to_paid'               => 'Gross Amount to be Paid',
                              'TDS_deducted'                       => 'TDS to be deducted',
                              'net_amount'                => 'Net Amount to be paid to Beneficiary',
                              'DD_to_be_issued_in_Favour_of'    => 'DD to be issued in Favour of',
                              'print_location'                => 'Print Location',
                              'DD_PAYABLE_AT'                => 'DD PAYABLE AT',
                               'is_EDC'                => 'EDC OR Non EDC [E= EDC N = Non EDC]',
                              'mobile_number'    => '10 Digit Mobile number',
                              'authorised_on'                => 'Authorized On',
                              'released_on'                => 'Released On',
                              'returned_on'                => 'Returned On',
                              'rejected_on'                => 'Rejected On',
                              'is_return'                => 'Status',
                              'is_resubmitted'                => 'Resubmitted',
                             
                              );
                         //echo "<pre>==";print_r($defined_annexure_col_array);exit;
                   
                     $filename                   = $annexure_abbr_array[$getAnxVal].'_'.date('Y-m-d').'.xlsx';
                   $result = $this->downloadreport_model->getSupremeCourtDDtxn($getAnxVal);
                    
                   
                    if(!empty($result)){
                       $result1 = array_unshift($result , $defined_annexure_col_array);
                    
                        $file_path = $rootPath.'/'.$annexure_type[$getAnxVal];
                        
                        $objPHPExcel = new PHPExcel();
                        $objPHPExcel->getActiveSheet()->fromArray($result, null, 'A1');
                        
                         $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
                         $objWriter->save($file_path.'/'.$filename);
                         echo $filename; exit;
                    }
                
    }   
   function download_OriginalDDReport(){
        // echo "<pre>===";print_r('hi');exit;
        echo date('Y-m-d H:i:s');
        /** Include PHPExcel */
        $this->load->library('Classes/PHPExcel');
        
        
            $getAnxVal                  = 6; 
            $rootPath = 'report';
            $annexure_path_array        =    array('1' => 'Original_Award', '2' => 'Lower_Court','3'=>'Higher_Court','4'=>'Supreme_Court','5'=>'DD_Upload');
            $annexure_abbr_array        =    array('1' => 'OA', '2' => 'LC','3'=>'HC','4'=>'SC','5'=>'SCDD','6'=>'ODD','7'=>'LCDD','8'=>'HCDD');
            $annexure_type              =    unserialize(ANNEXURE_TYPE);
            $annexure                   =    unserialize(ANNEXURE);
           
               
                //echo "else";
                    $defined_annexure_col_array = array(
                              'file_name'                    => 'file name',
                              'zone_name'                    => 'Zone',
                              'serial_no'                => 'Sr. No.',
                              
                              'customer_reference_number'            => 'Ref. No.',
                              'sector_no'                     => 'Sector No.',
                              'villlage_name'        => 'Name of Village',
                              'section_notfn_date'          => 'Date of Section 6 Notification (DD-MM-YY)',
                              'is_petition_filed'             => 'Whether petition filed by the land owner for release of land',
                              'award_no'              => 'Award No.',
                              'award_date'         => 'Date of Award (DD-MM-YY)',
                              'LAO_bank_account_no'                 => 'Bank A/c No. of LAO from which payment is to be made',
                              'beneficiary_name'          => 'Name of Beneficiary',
                              'khewat_no'                    => 'Khewat No.',
                              'share_in_ownership'           => 'Share in the ownership',
                              'acre'                         => 'Acre',
                              'kanal'                        => 'Kanal',
                              'marla'                        => 'Marla',
                              'beneficiary_PAN'                    => 'PAN NO.',
                              'gross_amount_to_paid'               => 'Gross Amount to be Paid',
                              'drawee_name'       => 'DD to be issued in Favour of',
                              'print_location'                => 'Print Location',
                              'DD_PAYABLE_AT'    => 'DD PAYABLE AT',
                              
                              'is_EDC'               => 'EDC OR Non EDC [E= EDC N = Non EDC]',
                              'mobile_number'                       => '10- Digit Mobile Number',
                              'UTR'                => 'DD Number',
                              'StatusDesc'    => 'Status Description',
                              'authorised_on'                => 'Authorized On',
                              'released_on'                => 'Released On',
                              'returned_on'                => 'Returned On',
                              'rejected_on'                => 'Rejected On',
                              'is_return'                => 'Status',
                              'is_resubmitted'                => 'Resubmitted',
                             
                              );
                         //echo "<pre>==";print_r($defined_annexure_col_array);exit;
                   
                    $filename                   = $annexure_abbr_array[$getAnxVal].'_'.date('Y-m-d').'.xlsx';
                    $result = $this->downloadreport_model->getOriginalCourtDDtxn($getAnxVal);
                   
                    if(!empty($result)){
                        
                        $result1 = array_unshift($result , $defined_annexure_col_array);
                    
                        $file_path = $rootPath.'/'.$annexure_type[$getAnxVal];
                        
                        $objPHPExcel = new PHPExcel();
                        $objPHPExcel->getActiveSheet()->fromArray($result, null, 'A1');
                        
                         $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
                         $objWriter->save($file_path.'/'.$filename);
                         echo $filename; exit;
                    }
                
    }     
    function download_LowerCourtDDReport(){
        // echo "<pre>===";print_r('hi');exit;
        echo date('Y-m-d H:i:s');
        /** Include PHPExcel */
        $this->load->library('Classes/PHPExcel');
        
        
            $getAnxVal                  = 7; 
           $rootPath = 'report';
            $annexure_path_array        =    array('1' => 'Original_Award', '2' => 'Lower_Court','3'=>'Higher_Court','4'=>'Supreme_Court','5'=>'DD_Upload');
            $annexure_abbr_array        =    array('1' => 'OA', '2' => 'LC','3'=>'HC','4'=>'SC','5'=>'SCDD','6'=>'ODD','7'=>'LCDD','8'=>'HCDD');
            $annexure_type              =    unserialize(ANNEXURE_TYPE);
            $annexure                   =    unserialize(ANNEXURE);
           
               
                //echo "else";
                    $defined_annexure_col_array = array(
                              'file_name'                    => 'file name',
                              'zone_name'                    => 'Zone',
                              'serial_no'                => 'Sr. No.',
                              
                              'customer_reference_number'            => 'Ref. No.',
                              'sector_no'                     => 'Sector No.',
                              'villlage_name'        => 'Name of Village',
                              'LAO_bank_account_no'          => 'Bank A/c No. of LAO from which payment is to be made',
                              'award_no'             => 'Award No.',
                              'award_date'              => 'Date of Award (DD-MM-YY)',
                              'ADJ_court_order_no'         => 'ADJ Court Order No.',
                              'ADJ_court_decision_date'                 => 'Date of Decision by ADJ Court (DD-MM-YY)',
                              'beneficiary_name'          => 'Name of Beneficiary',
                              'khewat_no'                    => 'Khewat No.',
                              'share_in_ownership'           => 'Share in the ownership',
                              'acre'                         => 'Acre',
                              'kanal'                        => 'Kanal',
                              'marla'                        => 'Marla',
                              'beneficiary_PAN'                    => 'PAN NO',
                              'gross_amount_to_paid'               => 'Gross Amount to be Paid',
                              'TDS_deducted'       => 'TDS to be deducted',
                              'net_amount'                => 'Net Amount to be paid to Beneficiary',
                              'drawee_name'    => 'DD to be issued in Favour of',
                              
                              'print_location'               => 'Print Location',
                              'DD_PAYABLE_AT'                       => 'DD PAYABLE AT',
                              'is_EDC'                => 'EDC OR Non EDC [E= EDC N = Non EDC]',
                              'mobile_number'    => '10 Digit Mobile number',
                              'UTR'    => 'DD Number',
                              'StatusDesc'                => 'Status Description',
                              'authorised_on'                => 'Authorized On',
                              'released_on'                => 'Released On',
                              'returned_on'                => 'Returned On',
                              'rejected_on'                => 'Rejected On',
                              'is_return'                => 'Status',
                              'is_resubmitted'                => 'Resubmitted',
                             
                              );
                         //echo "<pre>==";print_r($defined_annexure_col_array);exit;
                   
                    $filename                   = $annexure_abbr_array[$getAnxVal].'_'.date('Y-m-d').'.xlsx';
                    $result = $this->downloadreport_model->getLowerCourtDDtxn($getAnxVal);
                   
                    if(!empty($result)){
                        
                        $result1 = array_unshift($result , $defined_annexure_col_array);
                    
                        $file_path = $rootPath.'/'.$annexure_type[$getAnxVal];
                        
                        $objPHPExcel = new PHPExcel();
                        $objPHPExcel->getActiveSheet()->fromArray($result, null, 'A1');
                        
                         $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
                         $objWriter->save($file_path.'/'.$filename);
                         echo $filename; exit;
                    }
                
    }
    function download_HighCourtDDReport(){
        // echo "<pre>===";print_r('hi');exit;
        echo date('Y-m-d H:i:s');
        /** Include PHPExcel */
        $this->load->library('Classes/PHPExcel');
        
        
            $getAnxVal                  = 8; 
           $rootPath = 'report';
            $annexure_path_array        =    array('1' => 'Original_Award', '2' => 'Lower_Court','3'=>'Higher_Court','4'=>'Supreme_Court','5'=>'DD_Upload');
            $annexure_abbr_array        =    array('1' => 'OA', '2' => 'LC','3'=>'HC','4'=>'SC','5'=>'SCDD','6'=>'ODD','7'=>'LCDD','8'=>'HCDD');
            $annexure_type              =    unserialize(ANNEXURE_TYPE);
            $annexure                   =    unserialize(ANNEXURE);
           
                    $defined_annexure_col_array = array(
                              'file_name'                    => 'file name',
                              'zone_name'                    => 'Zone',
                              'serial_no'                => 'Sr. No.',
                              
                              'customer_reference_number'            => 'Ref. No.',
                              'sector_no'                     => 'Sector No.',
                              'villlage_name'        => 'Name of Village',
                              'LAO_bank_account_no'          => 'Bank A/c No. of LAO from which payment is to be made',
                              'award_no'             => 'Award No.',
                              'award_date'              => 'Date of Award (DD-MM-YY)',
                              'ADJ_court_order_no'         => 'ADJ Court Order No.',
                              'ADJ_court_decision_date'                 => 'Date of Decision by ADJ Court (DD-MM-YY)',
                              'high_court_order_no'          => 'High Court Order No.',
                              'high_court_decision_date'                    => 'Date of Decision by High Court (DD-MM-YY)',
                              'beneficiary_name'               => 'Name of Beneficiary',
                              'khewat_no'                    => 'Khewat No.',
                              'share_in_ownership'           => 'Share in the ownership',
                              'acre'                         => 'Acre',
                              'kanal'                        => 'Kanal',
                              'marla'                        => 'Marla',
                              'beneficiary_PAN'       => 'PAN NO',
                              'gross_amount_to_paid'                => 'Gross Amount to be Paid',
                              'TDS_deducted'    => 'TDS to be deducted',
                              
                              'net_amount'               => 'Net Amount to be paid to Beneficiary',
                              'drawee_name'                       => 'DD to be issued in Favour of',
                              'print_location'                => 'Print Location',
                              'DD_PAYABLE_AT'    => 'DD PAYABLE AT',
                              'is_EDC'    => 'EDC OR Non EDC [E= EDC N = Non EDC]',
                              'mobile_number'                => '10 Digit Mobile number',
                              'UTR'                => 'DD Number',
                              'StatusDesc'                => 'Status Description',
                              'authorised_on'                => 'Authorized On',
                              'released_on'                => 'Released On',
                              'returned_on'                => 'Returned On',
                              'rejected_on'                => 'Rejected On',
                              'is_return'                => 'Status',
                              'is_resubmitted'                => 'Resubmitted',
                             
                              );
                         //echo "<pre>==";print_r($defined_annexure_col_array);exit;
                   
                   $filename                   = $annexure_abbr_array[$getAnxVal].'_'.date('Y-m-d').'.xlsx';
                    $result = $this->downloadreport_model->getHighCourtDDtxn($getAnxVal);
                   
                    if(!empty($result)){
                        
                       $result1 = array_unshift($result , $defined_annexure_col_array);
                    
                        $file_path = $rootPath.'/'.$annexure_type[$getAnxVal];
                        
                        $objPHPExcel = new PHPExcel();
                        $objPHPExcel->getActiveSheet()->fromArray($result, null, 'A1');
                        
                         $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
                         $objWriter->save($file_path.'/'.$filename);
                         echo $filename; exit;
                       
                    }
                
    }   
    function downloadFile(){
        $file_list  = $this->cron_model->getReverseAnnexureFile();
        if(!empty($file_list)){
            
            foreach($file_list as $key=>$value){
                $filename =$value['file_name'];
                $anx_type =$value['annexure_type'];
                $id =$value['id'];
                $annexure_type              =    unserialize(ANNEXURE_TYPE);
                //$annexure_path_array        = array('1' => 'Original_Award', '2' => 'Lower_Court','3'=>'Higher_Court','4'=>'Supreme_Court','5'=>'DD_Upload');
                $annexure_path_array        = array('1' => 'Original_Award', '2' => 'Lower_Court','3'=>'Higher_Court','4'=>'Supreme_Court','5'=>'DD_SupremeCourt','6'=>'DD_OriginalAward','7'=>'DD_LowerCourt','8'=>'DD_HigherCourt');
                $sftp_fd_path               = $annexure_path_array[$anx_type];
                $localPath                  = $annexure_type[$anx_type];
                $result = $this->cron_model->downloadFile($sftp_fd_path, $localPath,$filename);
                echo "<pre>====";print_r($result); 
                
            } 
            
        }
        echo "<pre>====";print_r($file_list);  exit;
        
        //echo "<pre>==$sftp_fd_path=========$anx_type==";print_r($result);  exit;
    }
    // Download Returned File
    
   
   
    
    function testEmail($option){
       
       $to_email ='eb@indusind.com';
       $subject ='Release email for Huda from UAT';
       $message ='';
       sendReleaseMail($to_email, $message, $subject,'','',$option);
    }
    
    function createLog($postArray){
       
      
      //echo "<pre>===="; print_r($postArray); exit;
      $this->db->insert('huda_request_log', $postArray);
      $id = $this->db->insert_id();
      return $id;
      //echo "<pre>===="; print_r($postArray); exit;
   }

}

?>
