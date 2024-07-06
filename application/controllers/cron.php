<?php
ini_set("display_errors", "1");
ini_set('memory_limit','2048M');
error_reporting(E_ALL);
class cron extends CI_Controller {

    function __construct() {
        $data =array();
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $data  =array('is_logged_in'=>$this->session->userdata('logged_in'));
       
        $this->load->model('user_model');
        $this->load->model('cron_model');
        $this->load->model('authentication_model');        
        $this->load->helper('url');
        $this->load->helper('common_helper');
        $this->load->library('session');
        //$this->load->library('curl');
        //require 'spreadsheet/vendor/autoload.php';
        //require 'spreadsheet/src/PhpSpreadsheet/Writer/Xlsx.php';
        //include the classes needed to create and write .xlsx file
        //use PhpOffice\PhpSpreadsheet\Spreadsheet;
        //use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    }

    function update(){
        $result = $this->authentication_model->updateInProcessStatus();
        $this->load->view('layout/footer');
    }
    
    function c_array_old2(){
        
        echo date('Y-m-d H:i:s');
        /** Include PHPExcel */
        $this->load->library('Classes/PHPExcel');
        
        for($i=1; $i<6; $i++){
            $getAnxVal                  = $i; 
            $rootPath = 'SFTP_HUDA/OUT';
            //$rootEncOutPath = 'Encrypt/in'; for encryption 
            $rootEncOutPath = 'Encrypt/out';
            //include './Encrypt/run.php';
            $annexure_path_array        =    array('1' => 'Original_Award', '2' => 'Lower_Court','3'=>'Higher_Court','4'=>'Supreme_Court','5'=>'DD_Upload');
            $annexure_abbr_array        =    array('1' => 'OA', '2' => 'LC','3'=>'HC','4'=>'SC','5'=>'DD','6'=>'DD_OUTPUT');
            $annexure_type              =    unserialize(ANNEXURE_TYPE);
            $annexure                   =    unserialize(ANNEXURE);
            if($i ==5){
                
                //echo "if";
                    $defined_annexure_col_array =    $annexure['DD_OUTPUT'];
            
                    // for upload date 26 aug 
                    $upload_date               =array('UploadDate'=>'Value Date');
                    $defined_annexure_col_array= $defined_annexure_col_array+$upload_date;
                    
                    // Here is the sample array of data
                    $filename                   = $annexure_abbr_array[$getAnxVal].'_'.date('YmdHis').'.csv';
                    $result                     = $this->cron_model->getSuccesstxn($getAnxVal);
                    //echo "<pre>=====";print_r($result);  print_r($defined_annexure_col_array);  exit;
                    array_walk_recursive($result, array($this, 'edit_phone'));
                    //echo "<pre>===$i==";print_r($result); echo "<hr/>";
                    //$file_status = $this->cron_model->viewFile();
                    //echo "<pre>=====";print_r($result);  print_r($defined_annexure_col_array);  exit;
                    $reponseArray =array();
                    $n= 0; 
                    foreach($result as $key=>$value){
                        
                        // Add Parent Record 
                        $reponseArray[$n]['record_identifier'] ='P';
                        $reponseArray[$n]['transaction_type'] ='D';
                        $reponseArray[$n]['customer_id']      =CUSTOMER_ID;
                        $reponseArray[$n]['transaction_amount'] =$value['net_amount'];
                        $reponseArray[$n]['beneficiary_name'] =$value['drawee_name'];
                        $reponseArray[$n]['drawee_location'] =$value['drawee_location'];
                        $reponseArray[$n]['print_location'] =$value['print_location'];
                        
                        $reponseArray[$n]['beneficiary_add_line1'] ='';
                        $reponseArray[$n]['beneficiary_add_line2'] ='';
                        $reponseArray[$n]['beneficiary_add_line3'] ='';
                        $reponseArray[$n]['beneficiary_add_line4'] ='';
                        
                        $reponseArray[$n]['zipcode'] ='';
                        $reponseArray[$n]['instrument_ref_no'] ='';
                        $reponseArray[$n]['customer_reference_number'] =$value['customer_reference_number'];
                        
                        $reponseArray[$n]['advising_detail1']  ='';
                        $reponseArray[$n]['advising_detail2']  ='';
                        $reponseArray[$n]['advising_detail3']  ='';
                        $reponseArray[$n]['advising_detail4']  ='';
                        $reponseArray[$n]['advising_detail5']  ='';
                        $reponseArray[$n]['advising_detail6']  ='';
                        
                        $reponseArray[$n]['cheque_no'] ='';
                        $reponseArray[$n]['instrument_date'] ='';
                        $reponseArray[$n]['MICR_no'] ='';
                        $reponseArray[$n]['bene_email_id'] ='';
                        
                        $reponseArray[$n]['LAO_bank_account_no'] =$value['LAO_bank_account_no'];
                        $reponseArray[$n]['UploadDate'] =$value['UploadDate'];
                        $n=$n+1;
                        //add child record 
                        $reponseArray[$n]['record_identifier'] ='C';
                        $reponseArray[$n]['transaction_type'] ="D";
                        $reponseArray[$n]['customer_id']      =$value['sector_no'];
                        $reponseArray[$n]['transaction_amount'] =$value['villlage_name'];
                        $reponseArray[$n]['beneficiary_name'] =$value['award_no'];
                        $reponseArray[$n]['drawee_location'] =$value['award_date'];
                        $reponseArray[$n]['print_location'] =$value['ADJ_court_order_no'];
                        
                        $reponseArray[$n]['beneficiary_add_line1'] =$value['ADJ_court_decision_date'];
                        $reponseArray[$n]['beneficiary_add_line2'] =$value['high_court_order_no'];
                        $reponseArray[$n]['beneficiary_add_line3'] =$value['high_court_decision_date'];
                        $reponseArray[$n]['beneficiary_add_line4'] =$value['supreme_court_order_no'];
                        
                        $reponseArray[$n]['zipcode'] =$value['supreme_court_decision_date'];
                        $reponseArray[$n]['instrument_ref_no'] ='';
                        $reponseArray[$n]['customer_reference_number'] =$value['customer_reference_number'];
                        
                        $reponseArray[$n]['advising_detail1']  =$value['beneficiary_name'];
                        $reponseArray[$n]['advising_detail2']  =$value['beneficiary_PAN'];
                        $reponseArray[$n]['advising_detail3']  =$value['gross_amount_to_paid'];
                        $reponseArray[$n]['advising_detail4']  =$value['TDS_deducted'];
                        $reponseArray[$n]['advising_detail5']  =$value['net_amount'];
                        $reponseArray[$n]['advising_detail6']  =$value['is_EDC'];
                        
                        $reponseArray[$n]['cheque_no'] ='';
                        $reponseArray[$n]['instrument_date'] ='';
                        $reponseArray[$n]['MICR_no'] ='';
                        $reponseArray[$n]['bene_email_id'] ='';
                        
                        $reponseArray[$n]['LAO_bank_account_no'] ='';
                        $reponseArray[$n]['UploadDate'] =$value['UploadDate'];
                        $n++;
                    }
                    
                    
                    if(!empty($result)){
                        
                        $totalAmount = array_sum(array_map(function($item) { 
                            return $item['net_amount']; 
                        }, $result));
                        $data = array(
                            'file_name'  =>$filename,
                            'annexure_type'=>$getAnxVal,
                            'total_txn'  =>count($result),
                            'total_value'=>$totalAmount
                        );
                        print_r($data);
                        $result1 = array_unshift($reponseArray , $defined_annexure_col_array);
                        //echo "<pre>=====";print_r($reponseArray); print_r($defined_annexure_col_array);  exit;
                    
                        $file_path = $rootPath.'/'.$annexure_type[$getAnxVal];
                        
                        //echo "<pre>=====";print_r($file_path); print_r($defined_annexure_col_array);  exit;
                        // Create new PHPExcel object
                        $objPHPExcel = new PHPExcel();
                        
                        // Fill worksheet from values in array
                    
                        $objPHPExcel->getActiveSheet()->fromArray($reponseArray, null, 'A1');
                        //$form = $objPHPExcel->getDefaultStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);      
                        // Rename worksheet
                        //$objPHPExcel->getActiveSheet()->setTitle('Annexures');
                        
                        // Set AutoSize for name and email fields
                        
                        //$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
                        //$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true); 
                        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV')->setEnclosure('')->setLineEnding("\r\n");;
                        $objWriter->save($file_path.'/'.$filename);
                        $objWriter->save($rootEncOutPath.'/'.$filename);
                        $this->cron_model->insertReleaseFile($data);
                        $this->testEmail($data);
                        //Send email to bank
                        
                        //echo "===================================="; 
                        //header("Location: http://ipay.indusind.com/Encrypt/run.php?file_name=".$filename."&anx_type=".$getAnxVal);
                    }
            }else{
                //echo "else";
                    $defined_annexure_col_array =    $annexure[$annexure_type[$getAnxVal]];
                    // for upload date 26 aug 
                    $upload_date               =array('UploadDate'=>'Upload Date');
                    $defined_annexure_col_array= $upload_date+$defined_annexure_col_array;
                    
                    // Here is the sample array of data
                    $filename                   = $annexure_abbr_array[$getAnxVal].'_'.date('YmdHis').'.csv';
                    $result = $this->cron_model->getSuccesstxn($getAnxVal);
                    
                    array_walk_recursive($result, array($this, 'edit_phone'));
                    //echo "<pre>===$i==";print_r($result); echo "<hr/>";
                    //$file_status = $this->cron_model->viewFile();
                    if(!empty($result)){
                        
                        $totalAmount = array_sum(array_map(function($item) { 
                            return $item['net_amount']; 
                        }, $result));
                        $data = array(
                            'file_name'  =>$filename,
                            'annexure_type'=>$getAnxVal,
                            'total_txn'  =>count($result),
                            'total_value'=>$totalAmount
                        );
                        print_r($data);
                        $result1 = array_unshift($result , $defined_annexure_col_array);
                    
                        
                        $file_path = $rootPath.'/'.$annexure_type[$getAnxVal];
                        
                        //echo "<pre>=====";print_r($result);print_r($annexure_type);print_r($annexure);  print_r($defined_annexure_col_array);  exit;
                        // Create new PHPExcel object
                        $objPHPExcel = new PHPExcel();
                        
                        // Fill worksheet from values in array
                    
                        $objPHPExcel->getActiveSheet()->fromArray($result, null, 'A1');
                        //$form = $objPHPExcel->getDefaultStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);      
                        // Rename worksheet
                        //$objPHPExcel->getActiveSheet()->setTitle('Annexures');
                        
                        // Set AutoSize for name and email fields
                        
                        //$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
                        //$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true); 
                        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV')->setEnclosure('')->setLineEnding("\r\n");;
                        $objWriter->save($file_path.'/'.$filename);
                        $objWriter->save($rootEncOutPath.'/'.$filename);
                        $this->cron_model->insertReleaseFile($data);
                        $this->testEmail($data);
                        //Send email to bank
                        
                        //echo "===================================="; 
                        //header("Location: http://ipay.indusind.com/Encrypt/run.php?file_name=".$filename."&anx_type=".$getAnxVal);
            }
            }
            
        }
        
    }
    
    function c_array(){
       // print_r('hi');exit;
        echo date('Y-m-d H:i:s');
        /** Include PHPExcel */
        $this->load->library('Classes/PHPExcel');
        
        for($i=1; $i<5; $i++){
            $getAnxVal                  = $i; 
            $rootPath = 'SFTP_HUDA/OUT';
            //$rootEncOutPath = 'Encrypt/in'; for encryption 
            $rootEncOutPath = 'Encrypt/out';
            //include './Encrypt/run.php';
            $annexure_path_array        =    array('1' => 'Original_Award', '2' => 'Lower_Court','3'=>'Higher_Court','4'=>'Supreme_Court','5'=>'DD_Upload');
            $annexure_abbr_array        =    array('1' => 'OA', '2' => 'LC','3'=>'HC','4'=>'SC','5'=>'DD','6'=>'DD_OUTPUT');
            $annexure_type              =    unserialize(ANNEXURE_TYPE);
            $annexure                   =    unserialize(ANNEXURE);
            if($i ==5){
                
                //echo "if";
                    $defined_annexure_col_array =    $annexure['DD_OUTPUT'];
            
                    // for upload date 26 aug 
                    $upload_date               =array('UploadDate'=>'Value Date');
                    $defined_annexure_col_array= $defined_annexure_col_array+$upload_date;
                    
                    // Here is the sample array of data
                    $filename                   = $annexure_abbr_array[$getAnxVal].'_'.date('YmdHis').'.csv';
                    $result                     = $this->cron_model->getSuccesstxn($getAnxVal);
                   // echo "<pre>=====";print_r($result);  print_r($defined_annexure_col_array);  exit;
                    array_walk_recursive($result, array($this, 'edit_phone'));
                    //echo "<pre>===$i==";print_r($result); echo "<hr/>";
                    //$file_status = $this->cron_model->viewFile();
                    //echo "<pre>=====";print_r($result);  print_r($defined_annexure_col_array);exit;
                    $reponseArray =array();
                    $n= 0; 
                    foreach($result as $key=>$value){
                        
                        // Add Parent Record 
                        $reponseArray[$n]['record_identifier'] ='P';
                        $reponseArray[$n]['transaction_type'] ='D';
                        $reponseArray[$n]['customer_id']      =CUSTOMER_ID;
                        $reponseArray[$n]['transaction_amount'] =$value['net_amount'];
                        $reponseArray[$n]['beneficiary_name'] =$value['beneficiary_name'];
                        $reponseArray[$n]['drawee_location'] =$value['drawee_location'];
                        $reponseArray[$n]['print_location'] =$value['print_location'];
                        
                        $reponseArray[$n]['beneficiary_add_line1'] ='';
                        $reponseArray[$n]['beneficiary_add_line2'] ='';
                        $reponseArray[$n]['beneficiary_add_line3'] ='';
                        $reponseArray[$n]['beneficiary_add_line4'] ='';
                        
                        $reponseArray[$n]['zipcode'] ='';
                        $reponseArray[$n]['instrument_ref_no'] ='';
                        $reponseArray[$n]['customer_reference_number'] =$value['customer_reference_number'];
                        
                        $reponseArray[$n]['advising_detail1']  ='';
                        $reponseArray[$n]['advising_detail2']  ='';
                        $reponseArray[$n]['advising_detail3']  ='';
                        $reponseArray[$n]['advising_detail4']  ='';
                        $reponseArray[$n]['advising_detail5']  ='';
                        $reponseArray[$n]['advising_detail6']  ='';
                        
                        $reponseArray[$n]['cheque_no'] ='';
                        $reponseArray[$n]['instrument_date'] ='';
                        $reponseArray[$n]['MICR_no'] ='';
                        $reponseArray[$n]['bene_email_id'] ='';
                        
                        $reponseArray[$n]['LAO_bank_account_no'] =$value['LAO_bank_account_no'];
                        $reponseArray[$n]['UploadDate'] =$value['UploadDate'];
                        $n=$n+1;
                        //add child record 
                        $reponseArray[$n]['record_identifier'] ='C';
                        $reponseArray[$n]['transaction_type'] ="D";
                        $reponseArray[$n]['customer_id']      =$value['sector_no'];
                        $reponseArray[$n]['transaction_amount'] =$value['villlage_name'];
                        $reponseArray[$n]['beneficiary_name'] =$value['award_no'];
                        $reponseArray[$n]['drawee_location'] =$value['award_date'];
                        $reponseArray[$n]['print_location'] =$value['ADJ_court_order_no'];
                        
                        $reponseArray[$n]['beneficiary_add_line1'] =$value['ADJ_court_decision_date'];
                        $reponseArray[$n]['beneficiary_add_line2'] =$value['high_court_order_no'];
                        $reponseArray[$n]['beneficiary_add_line3'] =$value['high_court_decision_date'];
                        $reponseArray[$n]['beneficiary_add_line4'] =$value['supreme_court_order_no'];
                        
                        $reponseArray[$n]['zipcode'] =$value['supreme_court_decision_date'];
                        $reponseArray[$n]['instrument_ref_no'] ='';
                        $reponseArray[$n]['customer_reference_number'] =$value['customer_reference_number'];
                        
                        $reponseArray[$n]['advising_detail1']  =$value['beneficiary_name'];
                        $reponseArray[$n]['advising_detail2']  =$value['beneficiary_PAN'];
                        $reponseArray[$n]['advising_detail3']  =$value['gross_amount_to_paid'];
                        $reponseArray[$n]['advising_detail4']  =$value['TDS_deducted'];
                        $reponseArray[$n]['advising_detail5']  =$value['net_amount'];
                        $reponseArray[$n]['advising_detail6']  =$value['is_EDC'];
                        
                        $reponseArray[$n]['cheque_no'] ='';
                        $reponseArray[$n]['instrument_date'] ='';
                        $reponseArray[$n]['MICR_no'] ='';
                        $reponseArray[$n]['bene_email_id'] ='';
                        
                        $reponseArray[$n]['LAO_bank_account_no'] ='';
                        $reponseArray[$n]['UploadDate'] =$value['UploadDate'];
                        $n++;
                    }
                    
                    
                    if(!empty($result)){
                        
                        $totalAmount = array_sum(array_map(function($item) { 
                            return $item['net_amount']; 
                        }, $result));
                        $data = array(
                            'file_name'  =>$filename,
                            'annexure_type'=>$getAnxVal,
                            'total_txn'  =>count($result),
                            'total_value'=>$totalAmount
                        );
                        print_r($data);
                        $result1 = array_unshift($reponseArray , $defined_annexure_col_array);
                        //echo "<pre>=====";print_r($reponseArray); print_r($defined_annexure_col_array);  exit;
                        $rootPath = 'SFTP_HUDA/OUT'; 
                        $rootEncOutPath = 'Encrypt/out';
                        $file_path = $rootPath.'/'.$annexure_type[$getAnxVal];
                        // Create new PHPExcel object
                        $objPHPExcel = new PHPExcel();
                        $objPHPExcel->getActiveSheet()->fromArray($reponseArray, null, 'A1');
                         
                        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV')->setEnclosure('')->setLineEnding("\r\n");
                        
                        $objWriter->save($file_path.'/'.$filename);
                        $objWriter->save($rootEncOutPath.'/'.$filename);
                        $this->cron_model->insertReleaseFile($data);
                        $this->testEmail($data);
                        //Send email to bank
                        
                        //echo "===================================="; 
                        //header("Location: http://ipay.indusind.com/Encrypt/run.php?file_name=".$filename."&anx_type=".$getAnxVal);
                    }
            }else{
                if(strtotime($value['released_on']) < strtotime(date('Y-m-d 13:35:00'))){
                //echo "else";
                    $defined_annexure_col_array =    $annexure[$annexure_type[$getAnxVal]];
                    unset($defined_annexure_col_array['khewat_no']);
                    unset($defined_annexure_col_array['share_in_ownership']);
                    unset($defined_annexure_col_array['acre']);
                    unset($defined_annexure_col_array['kanal']);
                    unset($defined_annexure_col_array['marla']);
                    // for upload date 26 aug 
                    $upload_date               =array('UploadDate'=>'Upload Date');
                    $defined_annexure_col_array= $upload_date+$defined_annexure_col_array;
                    
                    // Here is the sample array of data
                    $filename                   = $annexure_abbr_array[$getAnxVal].'_'.date('YmdHis').'.csv';
                    $result = $this->cron_model->getSuccesstxn($getAnxVal);
                    
                    array_walk_recursive($result, array($this, 'edit_phone'));
                    //echo "<pre>===$i==";print_r($result); echo "<hr/>"; exit;
                    //$file_status = $this->cron_model->viewFile();
                    if(!empty($result)){
                        
                        $totalAmount = array_sum(array_map(function($item) { 
                            return $item['net_amount']; 
                        }, $result));
                        $data = array(
                            'file_name'  =>$filename,
                            'annexure_type'=>$getAnxVal,
                            'total_txn'  =>count($result),
                            'total_value'=>$totalAmount
                        );
                        print_r($data);
                        $result1 = array_unshift($result , $defined_annexure_col_array);
                    
                        
                        $file_path = $rootPath.'/'.$annexure_type[$getAnxVal];
                        
                        //echo "<pre>=====";print_r($result);print_r($annexure_type);print_r($annexure);  print_r($defined_annexure_col_array);  exit;
                        // Create new PHPExcel object
                        $objPHPExcel = new PHPExcel();
                        
                        // Fill worksheet from values in array
                    
                        $objPHPExcel->getActiveSheet()->fromArray($result, null, 'A1');
                        //$form = $objPHPExcel->getDefaultStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);      
                        // Rename worksheet
                        //$objPHPExcel->getActiveSheet()->setTitle('Annexures');
                        
                        // Set AutoSize for name and email fields
                        
                        //$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
                        //$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true); 
                        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV')->setEnclosure('')->setLineEnding("\r\n");;
                        $objWriter->save($file_path.'/'.$filename);
                        $objWriter->save($rootEncOutPath.'/'.$filename);
                        $this->cron_model->insertReleaseFile($data);
                        //$this->testEmail($data);
                        //Send email to bank
                        
                        //echo "===================================="; 
                        //header("Location: http://ipay.indusind.com/Encrypt/run.php?file_name=".$filename."&anx_type=".$getAnxVal);
                    }
                }
            }
            
        }
        
    }
    function download_FileReport(){
         echo "<pre>===";print_r('hi');exit;
        echo date('Y-m-d H:i:s');
        /** Include PHPExcel */
        $this->load->library('Classes/PHPExcel');
        
        for($i=1; $i<2; $i++){
            $getAnxVal                  = $i; 
            echo "<pre>===$i==";print_r($getAnxVal); echo "<hr/>";
            $rootPath = 'SFTP_HUDA/OUT';
            //$rootEncOutPath = 'Encrypt/in'; for encryption 
            $rootEncOutPath = 'Encrypt/out';
            //include './Encrypt/run.php';
            $annexure_path_array        =    array('1' => 'Original_Award', '2' => 'Lower_Court','3'=>'Higher_Court','4'=>'Supreme_Court','5'=>'DD_Upload');
            $annexure_abbr_array        =    array('1' => 'OA', '2' => 'LC','3'=>'HC','4'=>'SC','5'=>'DD','6'=>'DD_OUTPUT');
            $annexure_type              =    unserialize(ANNEXURE_TYPE);
            $annexure                   =    unserialize(ANNEXURE);
           
                if(strtotime($value['released_on']) < strtotime(date('Y-m-d 13:35:00'))){
                //echo "else";
                    $defined_annexure_col_array =    $annexure[$annexure_type[$getAnxVal]];
                    unset($defined_annexure_col_array['khewat_no']);
                    unset($defined_annexure_col_array['share_in_ownership']);
                    unset($defined_annexure_col_array['acre']);
                    unset($defined_annexure_col_array['kanal']);
                    unset($defined_annexure_col_array['marla']);
                    // for upload date 26 aug 
                    $upload_date               =array('UploadDate'=>'Upload Date');
                    $defined_annexure_col_array= $upload_date+$defined_annexure_col_array;
                    
                    // Here is the sample array of data
                    $filename                   = $annexure_abbr_array[$getAnxVal].'_'.date('YmdHis').'.csv';
                    $result = $this->cron_model->getSuccesstxn($getAnxVal);
                    
                    array_walk_recursive($result, array($this, 'edit_phone'));
                    //echo "<pre>===$i==";print_r($result); echo "<hr/>";
                    //$file_status = $this->cron_model->viewFile();
                    if(!empty($result)){
                        
                        $totalAmount = array_sum(array_map(function($item) { 
                            return $item['net_amount']; 
                        }, $result));
                        $data = array(
                            'file_name'  =>$filename,
                            'annexure_type'=>$getAnxVal,
                            'total_txn'  =>count($result),
                            'total_value'=>$totalAmount
                        );
                        print_r($data);
                        $result1 = array_unshift($result , $defined_annexure_col_array);
                    
                        
                        $file_path = $rootPath.'/'.$annexure_type[$getAnxVal];
                        
                        //echo "<pre>=====";print_r($result);print_r($annexure_type);print_r($annexure);  print_r($defined_annexure_col_array);  exit;
                        // Create new PHPExcel object
                        $objPHPExcel = new PHPExcel();
                        
                        // Fill worksheet from values in array
                    
                        $objPHPExcel->getActiveSheet()->fromArray($result, null, 'A1');
                        //$form = $objPHPExcel->getDefaultStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);      
                        // Rename worksheet
                        //$objPHPExcel->getActiveSheet()->setTitle('Annexures');
                        
                        // Set AutoSize for name and email fields
                        
                        //$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
                        //$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true); 
                        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV')->setEnclosure('')->setLineEnding("\r\n");;
                        $objWriter->save($file_path.'/'.$filename);
                        $objWriter->save($rootEncOutPath.'/'.$filename);
                        $this->cron_model->insertReleaseFile($data);
                        //$this->testEmail($data);
                        //Send email to bank
                        
                        //echo "===================================="; 
                        //header("Location: http://ipay.indusind.com/Encrypt/run.php?file_name=".$filename."&anx_type=".$getAnxVal);
                    }
                }
            
            
        }
        
    }
    
    function c_arrayDD(){
        
        echo date('Y-m-d H:i:s');
        /** Include PHPExcel */
        $this->load->library('Classes/PHPExcel');
        
        for($i=5; $i<6; $i++){
            $getAnxVal                  = $i; 
            $rootPath = 'SFTP_HUDA/OUT';
            //$rootEncOutPath = 'Encrypt/in'; for encryption 
            $rootEncOutPath = 'Encrypt/out';
            //include './Encrypt/run.php';
            $annexure_path_array        =    array('1' => 'Original_Award', '2' => 'Lower_Court','3'=>'Higher_Court','4'=>'Supreme_Court','5'=>'DD_Upload');
            $annexure_abbr_array        =    array('1' => 'OA', '2' => 'LC','3'=>'HC','4'=>'SC','5'=>'DD','6'=>'DD_OUTPUT');
            $annexure_type              =    unserialize(ANNEXURE_TYPE);
            $annexure                   =    unserialize(ANNEXURE);
            if($i ==5){
                
                //echo "if";
                    $defined_annexure_col_array =    $annexure['DD_OUTPUT'];
            
                    // for upload date 26 aug 
                    $upload_date               =array('UploadDate'=>'Value Date');
                    $defined_annexure_col_array= $defined_annexure_col_array+$upload_date;
                    
                    // Here is the sample array of data
                    $filename                   = $annexure_abbr_array[$getAnxVal].'_'.date('YmdHis').'.csv';
                    $result                     = $this->cron_model->getSuccesstxn($getAnxVal);
                    //echo "<pre>=====";print_r($result);  print_r($defined_annexure_col_array);  exit;
                    array_walk_recursive($result, array($this, 'edit_phone'));
                    //echo "<pre>===$i==";print_r($result); echo "<hr/>";
                    //$file_status = $this->cron_model->viewFile();
                    //echo "<pre>=====";print_r($result);  print_r($defined_annexure_col_array);  exit;
                    $reponseArray =array();
                    $n= 0; 
                    foreach($result as $key=>$value){
                        //$date = date('Y-m-d',strtotime($createdON));
                        //$time = date('H:i:s',strtotime($createdON));
                        if(strtotime($value['released_on']) < strtotime(date('Y-m-d 13:30:00'))){
                            // Add Parent Record 
                            $reponseArray[$n]['record_identifier'] ='P';
                            $reponseArray[$n]['transaction_type'] ='D';
                            $reponseArray[$n]['customer_id']      =CUSTOMER_ID;
                            $reponseArray[$n]['transaction_amount'] =$value['net_amount'];
                            $reponseArray[$n]['beneficiary_name'] =$value['drawee_name'];
                            $reponseArray[$n]['drawee_location'] =$value['drawee_location'];
                            $reponseArray[$n]['print_location'] =$value['print_location'];
                            
                            $reponseArray[$n]['beneficiary_add_line1'] ='';
                            $reponseArray[$n]['beneficiary_add_line2'] ='';
                            $reponseArray[$n]['beneficiary_add_line3'] ='';
                            $reponseArray[$n]['beneficiary_add_line4'] ='';
                            
                            $reponseArray[$n]['zipcode'] ='';
                            $reponseArray[$n]['instrument_ref_no'] ='';
                            $reponseArray[$n]['customer_reference_number'] =$value['customer_reference_number'];
                            
                            $reponseArray[$n]['advising_detail1']  ='';
                            $reponseArray[$n]['advising_detail2']  ='';
                            $reponseArray[$n]['advising_detail3']  ='';
                            $reponseArray[$n]['advising_detail4']  ='';
                            $reponseArray[$n]['advising_detail5']  ='';
                            $reponseArray[$n]['advising_detail6']  ='';
                            
                            $reponseArray[$n]['cheque_no'] ='';
                            $reponseArray[$n]['instrument_date'] ='';
                            $reponseArray[$n]['MICR_no'] ='';
                            $reponseArray[$n]['bene_email_id'] ='';
                            
                            $reponseArray[$n]['LAO_bank_account_no'] =$value['LAO_bank_account_no'];
                            $reponseArray[$n]['UploadDate'] =$value['UploadDate'];
                            $n=$n+1;
                            //add child record 
                            $reponseArray[$n]['record_identifier'] ='C';
                            $reponseArray[$n]['transaction_type'] ="D";
                            $reponseArray[$n]['customer_id']      =$value['sector_no'];
                            $reponseArray[$n]['transaction_amount'] =$value['villlage_name'];
                            $reponseArray[$n]['beneficiary_name'] =$value['award_no'];
                            $reponseArray[$n]['drawee_location'] =$value['award_date'];
                            $reponseArray[$n]['print_location'] =$value['ADJ_court_order_no'];
                            
                            $reponseArray[$n]['beneficiary_add_line1'] =$value['ADJ_court_decision_date'];
                            $reponseArray[$n]['beneficiary_add_line2'] =$value['high_court_order_no'];
                            $reponseArray[$n]['beneficiary_add_line3'] =$value['high_court_decision_date'];
                            $reponseArray[$n]['beneficiary_add_line4'] =$value['supreme_court_order_no'];
                            
                            $reponseArray[$n]['zipcode'] =$value['supreme_court_decision_date'];
                            $reponseArray[$n]['instrument_ref_no'] ='';
                            $reponseArray[$n]['customer_reference_number'] =$value['customer_reference_number'];
                            
                            $reponseArray[$n]['advising_detail1']  =$value['beneficiary_name'];
                            $reponseArray[$n]['advising_detail2']  =$value['beneficiary_PAN'];
                            $reponseArray[$n]['advising_detail3']  =$value['gross_amount_to_paid'];
                            $reponseArray[$n]['advising_detail4']  =$value['TDS_deducted'];
                            $reponseArray[$n]['advising_detail5']  =$value['net_amount'];
                            $reponseArray[$n]['advising_detail6']  =$value['is_EDC'];
                            
                            $reponseArray[$n]['cheque_no'] ='';
                            $reponseArray[$n]['instrument_date'] ='';
                            $reponseArray[$n]['MICR_no'] ='';
                            $reponseArray[$n]['bene_email_id'] ='';
                            
                            $reponseArray[$n]['LAO_bank_account_no'] ='';
                            $reponseArray[$n]['UploadDate'] =$value['UploadDate'];
                            $n++;   
                        }
                    }
                    
                    
                    if(!empty($result)){
                        
                        $totalAmount = array_sum(array_map(function($item) { 
                            return $item['net_amount']; 
                        }, $result));
                        $data = array(
                            'file_name'  =>$filename,
                            'annexure_type'=>$getAnxVal,
                            'total_txn'  =>count($result),
                            'total_value'=>$totalAmount
                        );
                        print_r($data);
                        $result1 = array_unshift($reponseArray , $defined_annexure_col_array);
                        //echo "<pre>=====";print_r($reponseArray); print_r($defined_annexure_col_array);  exit;
                    
                        $file_path = $rootPath.'/'.$annexure_type[$getAnxVal];
                        
                        //echo "<pre>=====";print_r($file_path); print_r($defined_annexure_col_array);  exit;
                        // Create new PHPExcel object
                        $objPHPExcel = new PHPExcel();
                        
                        // Fill worksheet from values in array
                    
                        $objPHPExcel->getActiveSheet()->fromArray($reponseArray, null, 'A1');
                        //$form = $objPHPExcel->getDefaultStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);      
                        // Rename worksheet
                        //$objPHPExcel->getActiveSheet()->setTitle('Annexures');
                        
                        // Set AutoSize for name and email fields
                        
                        //$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
                        //$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true); 
                        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV')->setEnclosure('')->setLineEnding("\r\n");;
                        $objWriter->save($file_path.'/'.$filename);
                        $objWriter->save($rootEncOutPath.'/'.$filename);
                        $this->cron_model->insertReleaseFile($data);
                        $this->testEmail($data);
                        //Send email to bank
                        
                        //echo "===================================="; 
                        //header("Location: http://ipay.indusind.com/Encrypt/run.php?file_name=".$filename."&anx_type=".$getAnxVal);
                    }
            }else{
                echo "No new record to release.";
            }
            
        }
        
    }
    
    function encUploadFile(){
        $file_list  = $this->cron_model->getAnnexureFile();

         //echo "<pre>=====";print_r($file_list);exit;
        if(!empty($file_list)){
            
            foreach($file_list as $key=>$value){
                $filename =$value['file_name'];
                $anx_type =$value['annexure_type'];
                if ($anx_type==9) {
                    $anx_type=1;
                }
                $annexure_type              =    unserialize(ANNEXURE_TYPE);
                $id =$value['id'];
                //$annexure_path_array        = array('1' => 'Original_Award', '2' => 'Lower_Court','3'=>'Higher_Court','4'=>'Supreme_Court','5'=>'DD_Upload');
                $annexure_path_array        = array('1' => 'Original_Award', '2' => 'Lower_Court','3'=>'Higher_Court','4'=>'Supreme_Court','5'=>'DD_SupremeCourt','6'=>'DD_OriginalAward','7'=>'DD_LowerCourt','8'=>'DD_HigherCourt');
                $sftp_fd_path               = $annexure_path_array[$anx_type];
                $localPath                  = $annexure_type[$anx_type];
                $result = $this->cron_model->uploadFile($sftp_fd_path, $localPath,$filename);
                $this->cron_model->updateEncAnnexures($id);
            } 
            
        }
        echo "<pre>====";print_r($file_list);exit;
        
        //echo "<pre>==$sftp_fd_path=========$anx_type==";print_r($result);  exit;
    }
    
    
    
    /*function edit_phone(&$item, $key) {
        if ($key == 'account_number') {
            $item = $item;
        }
        if ($key == 'mobile_number' && $item !='' ) {
            $item = $item;
        }
        if ($key == 'UploadDate' && $item !='' ) {
            $item = $item;
        }
        if ($key == 'LAO_bank_account_no' && $item !='' ) {
            $item = $item;
        }
        if ($key == 'customer_reference_number'  ) {
             $this->cron_model->updateAnnexures($item);
        }
    }
    function edit_phone(&$item, $key) {
        if ($key == 'account_number') {
            $item = $item;
        }
        if ($key == 'mobile_number' && $item !='' ) {
            $item = $item;
        }
        if ($key == 'UploadDate' && $item !='' ) {
            $item = $item;
        }
        if ($key == 'LAO_bank_account_no' && $item !='' ) {
            $item = $item;
        }
        
        if ($key == 'sector_no' && $item !='' ) {
            $item = str_replace(",", "-",$item);
        }
        
        if ($key == 'villlage_name' && $item !='' ) {
            $item = str_replace(",", "-",$item);
        }
        
            if ($key == 'beneficiary_name' && $item !='') {
            $item = str_replace(",", "-",$item);
        }
        
        if ($key == 'customer_reference_number'  ) {
             $this->cron_model->updateAnnexures($item);
        }
    }*/
    
    function edit_phone(&$item, $key) {
        if ($key == 'account_number') {
                $item = str_replace(",", "",$item);
        }
        if ($key == 'mobile_number' && $item !='' ) {
            $item = $item;
        }
        if ($key == 'UploadDate' && $item !='' ) {
            $item = $item;
        }
        if ($key == 'LAO_bank_account_no' && $item !='' ) {
            $item = $item;
        }
        
        if ($key == 'sector_no' && $item !='' ) {
            $item = str_replace(",", " ",$item);
        }
        
        if ($key == 'villlage_name' && $item !='' ) {
            $item = str_replace(",", " ",$item);
        }
        
        if ($key == 'beneficiary_name' && $item !='') {
            $item = str_replace(",", " ",$item);
        }
        
        if ($key == 'award_no' && $item !='' ) {
            $item = str_replace(",", " ",$item);
        }
        
        if ($key == 'award_date' && $item !='' ) {
            $item = str_replace(",", " ",$item);
        }
        
        if ($key == 'ADJ_court_order_no' && $item !='' ) {
            $item = str_replace(",", " ",$item);
        }
        if ($key == 'ADJ_court_decision_date' && $item !='' ) {
            $item = str_replace(",", " ",$item);
        }
        if ($key == 'high_court_order_no' && $item !='' ) {
            $item = str_replace(",", " ",$item);
        }
        if ($key == 'high_court_decision_date' && $item !='' ) {
            $item = str_replace(",", " ",$item);
        }
        if ($key == 'supreme_court_order_no' && $item !='' ) {
            $item = str_replace(",", " ",$item);
        }
        if ($key == 'supreme_court_decision_date' && $item !='' ) {
            $item = str_replace(",", " ",$item);
        }
        if ($key == 'is_petition_filed' && $item !='') {
            $item = str_replace(",", " ",$item);
        }
        if ($key == 'customer_reference_number'  ) {
             $this->cron_model->updateAnnexures($item);
        }
    }
    
    function viewFile(){
        $annexure_path_array        = array('1' => 'Original_Award',
        '2' => 'Lower_Court','3'=>'Higher_Court','4'=>'Supreme_Court',
        '5'=>'DD_SupremeCourt','6'=>'DD_OriginalAward','7'=>'DD_LowerCourt','8'=>'DD_HigherCourt');
        foreach($annexure_path_array as $key=>$value){
              $result = $this->cron_model->viewFile($value);
              $result1 = $this->cron_model->viewReturnFile();
              
              echo "<pre>====";print_r($result);print_r($result1);
        }
        
        //echo "<pre>====";print_r($result);  exit;
    }
    
    function downloadFile(){
        $file_list  = $this->cron_model->getReverseAnnexureFile();
        if(!empty($file_list)){
            
            foreach($file_list as $key=>$value){
                $filename =$value['file_name'];
                $anx_type =$value['annexure_type'];
                if ($anx_type==9) {
                    $anx_type=1;
                }
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
    
    function downloadReturnFile(){
        
        
            
            $result = $this->cron_model->downloadReturnFile();
            
             echo "<pre>====";print_r($result);  exit;
        
        //echo "<pre>==$sftp_fd_path=========$anx_type==";print_r($result);  exit;
    }
    /*function downloadReturnFile(){
        $file_list  = $this->cron_model->getAnnexureFile(1);
        if(!empty($file_list)){
            
            foreach($file_list as $key=>$value){
                //$filename =$value['file_name'];
                //$anx_type =$value['annexure_type'];
                //$id =$value['id'];
                //$annexure_path_array        = array('1' => 'Original_Award', '2' => 'Lower_Court','3'=>'Higher_Court','4'=>'Supreme_Court','5'=>'DD_Upload');
                //$sftp_fd_path               = $annexure_path_array[$anx_type];
                $result = $this->cron_model->downloadFile($sftp_fd_path, $type= 'Returned',$filename);
                echo "<pre>====";print_r($result); 
                
            } 
            
        }
        echo "<pre>====";print_r($file_list);  exit;
    }*/
    
   public function updateAnnexures() {
        $this->load->library('Classes/PHPExcel');
        
        // echo "<pre>=$account_number====";print_r($session_data); print_r($_REQUEST);  exit;
        $file_list                  = $this->cron_model->getReverseAnnexureFile();
         //echo "<pre>=====";print_r($file_list); // exit;
        foreach($file_list as $key=>$value){
                  
                $filename =$value['file_name'];
                $file_status = $value['file_status'];
                //$filename  = preg_replace('/(\.csv)/', 'R$1', $filename);
                $anx_type =$value['annexure_type'];
                $id =$value['id'];
                $getAnxVal                  = 1;
                $annexure_type              = unserialize(ANNEXURE_TYPE);
                $annexure                   = unserialize(ANNEXURE);
                
                $folder_path                = $annexure_type[$anx_type];
                $import_xls_file            = "SFTP_HUDA/IN/$folder_path/$filename";
                //$import_xls_file            = "SFTP_HUDA/IN/$folder_path/DD_20190107161602R.csv";
                //echo "<pre>=$import_xls_file===="; print_r($value); exit;
                if (file_exists($import_xls_file) && (($value['file_status'] == 0 or ($value['file_status'] == 1 && $anx_type > 4)))){
                    $inputFileName = $import_xls_file;
                    echo "<pre>=$import_xls_file===="; print_r($value); 
                    //echo $inputFileName;die;
                    //if (! is_readable($inputFileName)) die('cant read file, check permissions');
                    try {
                        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                        $objPHPExcel = $objReader->load($inputFileName);
                        
                        $worksheetData = $objReader->listWorksheetInfo($inputFileName);
                        $totalRows     = $worksheetData[0]['totalRows'];
                        //$totalColumns  = $worksheetData[0]['totalColumns'];
                        
                        $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
                        $highestRow = $objWorksheet->getHighestRow();
                        $highestColumn = $objWorksheet->getHighestColumn();
                        
                        $headingsArray = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);
                        //echo "<pre>=$highestRow====$highestColumn="; print_r($objPHPExcel);echo "<pre><hr/>";
                        
                    } catch (Exception $e) {
                        die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                                . '": ' . $e->getMessage());
                    }
                    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true); 
                    //echo "<pre>=uuuuu====";  print_r($allDataInSheet); die;
                    $arrayCount     = count($allDataInSheet);
                    $c = 1;
                    $annexure_status=7;
                    $status_failed = array("R","J");
                    $status_released = array("AP","FA", "N","PR", "PV","UP");
                    $status_success = array("CL", "CP", "E","P", "S", "SP","SUCCESS");
                    foreach($allDataInSheet as $key=>$value){
                        $is_released_status=0;
                        if($c>1){
                            
                            $logArray            =array(
                                         'log'      =>json_encode($value),
                                         'request_type'=>'updateAnnexures'.$c
                            );  
                            $this->createLog($logArray);
                            //$filterArray               =array_filter($value);
                            echo $anx_type;
                        if($anx_type > 4){
                            $customer_reference_number = $value['N'];
                            $subArray                  =array_slice($value, -4, 4, true);
                            $subArray = array_values($subArray);
                            $UTR                       =$subArray[1];
                            $StatusCode                =$subArray[2];
                            $StatusDesc                =$subArray[3];
                            if($file_status == 1){
                                if (in_array($StatusCode, $status_success)){
                                        $annexure_status ='11';
                                }elseif(in_array($StatusCode, $status_released)){
                                    $is_released_status='1';
                                    $annexure_status ='7';
                                }elseif(in_array($StatusCode, $status_failed)){
                                    $is_released_status='2';
                                    $annexure_status ='7';
                                }
                                else{
                                    $is_released_status='3';
                                    $annexure_status ='7';
                                }
                                //$annexure_status           = $StatusCode == 'P' ? '11':'7';
                            }else{
                                if (in_array($StatusCode, $status_success)){
                                        $annexure_status ='11';
                                }elseif(in_array($StatusCode, $status_released)){
                                    $is_released_status='1';
                                    $annexure_status ='7';
                                }elseif(in_array($StatusCode, $status_failed)){
                                    $is_released_status='2';
                                    $annexure_status ='7';
                                }
                                else{
                                    $is_released_status='3';
                                    $annexure_status ='7';
                                }
                               //$annexure_status            = $StatusCode  =='SUCCESS' ? '11':'6'; 
                            }
                        }else{  
                            $subArray = array_slice($value, -4, 4, true);
                            $subArray = array_values($subArray);
                            $customer_reference_number =$subArray[0];
                            $UTR                       =$subArray[1];
                            $StatusCode                =$subArray[2];
                            $StatusDesc                =$subArray[3];
                            //$annexure_status          =$StatusCode =='SUCCESS' ? '11':'6'; 
                            if (in_array($StatusCode, $status_success)){
                                        $annexure_status ='11';
                                }elseif(in_array($StatusCode, $status_released)){
                                    $is_released_status='1';
                                    $annexure_status ='7';
                                }elseif(in_array($StatusCode, $status_failed)){
                                    $is_released_status='2';
                                    $annexure_status ='6';
                                }
                                else{
                                    $is_released_status='3';
                                    $annexure_status ='7';
                                }
                        }   
                            $data = array(
                                'annexure_status' => $annexure_status,
                                'UTR'              => $UTR,
                                'StatusCode'       => $StatusCode,
                                'StatusDesc'       => $StatusDesc,
                                'is_released_status'=>$is_released_status
                                
                            );
                            echo $annexure_status;
                            if($annexure_status == 6){
                                $data['returned_on'] = date('Y-m-d H:i:s');
                                $data['is_released'] = 0;
                            }
                            if($annexure_status == 11){
                                $data['update_on']       = date('Y-m-d H:i:s');
                            }
                            //echo "updaing status";
                            echo $customer_reference_number;
                            echo "<pre>=$import_xls_file===="; print_r($data); echo "<hr/>"; 
                            $this->cron_model->updateReverseAnnexuresStatus($customer_reference_number,$data);
                            //$this->cron_model->updateReverseAnnexuresStatus($customer_reference_number,$value['B'],$value['R'],$data);
                        }
                        $c++;
                    }
                    $status = 1;
                    if($anx_type > 4 && $file_status == 1){
                        $status = 2;
                    }
                    if($anx_type > 4 && $file_status == 0){
                        $extension_pos = strrpos($filename, '.'); // find position of the last dot, so where the extension starts
                        $newFilename = substr($filename, 0, $extension_pos) . 'I' . substr($filename, $extension_pos);
                        rename($inputFileName,"SFTP_HUDA/IN/$folder_path/$newFilename");
                    }
                    $this->cron_model->updateReverseAnnexuresFiles($id,$status);
                }else{
                   echo $filename.'  Not exist<hr/>'; 
                }
        }   
    }
public function updateReturnAnnexures() {
        $this->load->library('Classes/PHPExcel');
        
        
                echo $import_xls_file            = "SFTP_HUDA/Returned/HUDA_ReturnsOps.csv";
                
                $inputFileName = $import_xls_file;
                if (file_exists($import_xls_file)){ 
                    //if (! is_readable($inputFileName)) die('cant read file, check permissions');
                    try {
                        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                        $objPHPExcel = $objReader->load($inputFileName);
                        
                        $worksheetData = $objReader->listWorksheetInfo($inputFileName);
                        $totalRows     = $worksheetData[0]['totalRows'];
                        //$totalColumns  = $worksheetData[0]['totalColumns'];
                        
                        $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
                        $highestRow = $objWorksheet->getHighestRow();
                        $highestColumn = $objWorksheet->getHighestColumn();
                        
                        $headingsArray = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);
                        //echo "<pre>=$highestRow====$highestColumn="; print_r($objPHPExcel);echo "<pre><hr/>"; exit;
                        
                    
                        $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true); 
                        //echo "<pre>=uuuuu====";  print_r($allDataInSheet); exit;
                        $arrayCount     = count($allDataInSheet);
                        //Create log 
                        $logArray            =array(
                                         'log'      =>json_encode($allDataInSheet),
                                         'request_type'=>'updateReturnAnnexures'
                        );  
                        $this->createLog($logArray);
                        
                        $c = 1;
                        foreach($allDataInSheet as $key=>$value){
                            if($c>1){
                            
                                $customer_reference_number =$value['A'];
                                $data = array(
                                            'reason'  =>$value['F'],
                                            'StatusDesc'  =>$value['F'],
                                            //'returned_on'=>date('Y-m-d'),
                                            'annexure_status' => 6,
                                            'is_released' => 0,
                                            'is_return' => 1,
                                            'returned_on' => date('Y-m-d H:i:s')
                                            
                                );
                                echo $this->cron_model->updateReturnedAnnexuresStatus($customer_reference_number,$data);
                                //echo "<pre>=uuuuu====";  print_r($data); exit;
                               $logArray            =array(
                                         'log'      =>json_encode($data),
                                         'request_type'=>'updateReturnAnnexures'
                                );  
                                $this->createLog($logArray);
                                
                            }
                            $c++;
                        }
                        $path = "SFTP_HUDA/Returned/Archive/".Date('YmdHis').'_HUDA_ReturnsOps.csv';
                        $check = copy("SFTP_HUDA/Returned/HUDA_ReturnsOps.csv", $path);
                        unlink($import_xls_file);
                    } catch (Exception $e) {
                        die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                                . '": ' . $e->getMessage());
                    }   
                }else{
                    $logArray = array(
                                     'log'      =>'File not exist.',
                                     'request_type'=>'updateReturnAnnexures'
                    );  
                    $this->createLog($logArray);
                }
        
    }
    
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

    function download_OriginalReport(){
         //echo "<pre>===";print_r('hello');exit;
        echo date('Y-m-d H:i:s');
        /** Include PHPExcel */
        $this->load->library('Classes/PHPExcel');
        
        $zone_list  = $this->cron_model->getZoneList();
            $getAnxVal                  = 1; 
          //echo "<pre>=";print_r($zone_list); echo "<hr/>";exit;
            $rootPath = 'report';
            $annexure_path_array        =    array('1' => 'Original_Award', '2' => 'Lower_Court','3'=>'Higher_Court','4'=>'Supreme_Court','5'=>'DD_Upload');
            $annexure_abbr_array        =    array('1' => 'OA', '2' => 'LC','3'=>'HC','4'=>'SC','5'=>'SCDD','6'=>'ODD','7'=>'LCDD','8'=>'HCDD');
            $annexure_type              =    unserialize(ANNEXURE_TYPE);
            $annexure                   =    unserialize(ANNEXURE);
            $zones                      =    unserialize(ZONES);
           // print_r($zones);exit;
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
                      
                      foreach($zone_list as $key=>$value){ 

                       $zone_id =$value['id']; 
                       //echo "<pre>=";print_r($zone_id); echo "<hr/>";exit;                  
                    $filename                   = $annexure_abbr_array[$getAnxVal].'_'.date('Y-m-d').'_'.$zone_id.'.xlsx';
                    //echo "<pre>=";print_r($filename); echo "<hr/>";exit; 
                   
                   $result = $this->cron_model->getOriginaltxn($getAnxVal,$zone_id);
                   //echo "<pre>=";print_r($result); echo "<hr/>";exit;
                   if(!empty($result)){
                        $result1 = array_unshift($result , $defined_annexure_col_array);
                        $file_path = $rootPath.'/'.$annexure_type[$getAnxVal];
                      
                        $objPHPExcel = new PHPExcel();
                       
                        $objPHPExcel->getActiveSheet()->fromArray($result, null, 'A1');
                        
                         $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
                         $objWriter->save($file_path.'/'.$filename);
                         echo $filename;echo "<hr/>";
                    }
                }

    }

    function download_LowerCourtReport(){
        //echo "<pre>===";print_r('hell');exit;
        echo date('Y-m-d H:i:s');
       
        $this->load->library('Classes/PHPExcel');
        $getAnxVal             = 2; 
         $zone_list  = $this->cron_model->getZoneList();
          // echo "<pre>=";print_r($zone_list); echo "<hr/>";exit;
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
                       
                    foreach($zone_list as $key=>$value){ 

                       $zone_id =$value['id']; 
                       //echo "<pre>=";print_r($zone_id); echo "<hr/>";exit;                  
                    $filename                   = $annexure_abbr_array[$getAnxVal].'_'.date('Y-m-d').'_'.$zone_id.'.xlsx';
                    $result = $this->cron_model->getLowertxn($getAnxVal,$zone_id);
                   
                    if(!empty($result)){
                        
                      
                        $result1 = array_unshift($result , $defined_annexure_col_array);
                    
                        $file_path = $rootPath.'/'.$annexure_type[$getAnxVal];
                        
                        $objPHPExcel = new PHPExcel();
                        $objPHPExcel->getActiveSheet()->fromArray($result, null, 'A1');
                        
                         $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
                         $objWriter->save($file_path.'/'.$filename);
                         echo $filename;echo "<hr/>";
                       
                    }
                }
                
    }
    
   
 function download_HighCourtReport(){
        // echo "<pre>===";print_r('hi');exit;
        echo date('Y-m-d H:i:s');
        /** Include PHPExcel */
        $this->load->library('Classes/PHPExcel');
        
        
            $getAnxVal                  = 3; 
             $zone_list  = $this->cron_model->getZoneList();
          // echo "<pre>=";print_r($zone_list); echo "<hr/>";exit;
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
                   foreach($zone_list as $key=>$value){ 

                       $zone_id =$value['id']; 
                       //echo "<pre>=";print_r($zone_id); echo "<hr/>";exit;                  
                    $filename                   = $annexure_abbr_array[$getAnxVal].'_'.date('Y-m-d').'_'.$zone_id.'.xlsx';
                   
                    $result = $this->cron_model->getHighCourttxn($getAnxVal,$zone_id);
                   
                    if(!empty($result)){
                        
                       
                        $result1 = array_unshift($result , $defined_annexure_col_array);
                    
                        $file_path = $rootPath.'/'.$annexure_type[$getAnxVal];
                        
                        $objPHPExcel = new PHPExcel();
                        $objPHPExcel->getActiveSheet()->fromArray($result, null, 'A1');
                        
                         $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
                         $objWriter->save($file_path.'/'.$filename);
                         echo $filename;echo "<hr/>";
                    }
                }
    }

    function download_SupremeCourtReport(){
        // echo "<pre>===";print_r('hi');exit;
        echo date('Y-m-d H:i:s');
        /** Include PHPExcel */
        $this->load->library('Classes/PHPExcel');
         $zone_list  = $this->cron_model->getZoneList();
          // echo "<pre>=";print_r($zone_list); echo "<hr/>";exit;
        
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
                         
                   foreach($zone_list as $key=>$value){ 

                       $zone_id =$value['id'];                   
                    $filename                   = $annexure_abbr_array[$getAnxVal].'_'.date('Y-m-d').'_'.$zone_id.'.xlsx';
                    //echo "<pre>==";print_r($filename);exit;
                    $result = $this->cron_model->getSupremeCourttxn($getAnxVal,$zone_id);
                   // echo "<pre>==";print_r($result);exit;
                    if(!empty($result)){
                       $result1 = array_unshift($result , $defined_annexure_col_array);
                    
                        $file_path = $rootPath.'/'.$annexure_type[$getAnxVal];
                        
                        $objPHPExcel = new PHPExcel();
                        $objPHPExcel->getActiveSheet()->fromArray($result, null, 'A1');
                        
                         $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
                         $objWriter->save($file_path.'/'.$filename);
                         echo $filename;echo "<hr/>";
                    }
          }      
    }   
   
    function download_SupremeCourtDDReport(){
        // echo "<pre>===";print_r('hi');exit;
        echo date('Y-m-d H:i:s');
        /** Include PHPExcel */
        $this->load->library('Classes/PHPExcel');
        
         $zone_list  = $this->cron_model->getZoneList();
          // echo "<pre>=";print_r($zone_list); echo "<hr/>";exit;
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
                              'drawee_name'    => 'DD to be issued in Favour of',
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
                   
                     foreach($zone_list as $key=>$value){ 

                       $zone_id =$value['id'];                   
                    $filename                   = $annexure_abbr_array[$getAnxVal].'_'.date('Y-m-d').'_'.$zone_id.'.xlsx';
                    //echo "<pre>==";print_r($filename);exit;
                   $result = $this->cron_model->getSupremeCourtDDtxn($getAnxVal,$zone_id);
                    
                   
                    if(!empty($result)){
                       $result1 = array_unshift($result , $defined_annexure_col_array);
                    
                        $file_path = $rootPath.'/'.$annexure_type[$getAnxVal];
                        
                        $objPHPExcel = new PHPExcel();
                        $objPHPExcel->getActiveSheet()->fromArray($result, null, 'A1');
                        
                         $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
                         $objWriter->save($file_path.'/'.$filename);
                         echo $filename;echo "<hr/>";
                    }
                }
                
    }   
   function download_OriginalDDReport(){
        // echo "<pre>===";print_r('hi');exit;
        echo date('Y-m-d H:i:s');
        /** Include PHPExcel */
        $this->load->library('Classes/PHPExcel');
         $zone_list  = $this->cron_model->getZoneList();
          // echo "<pre>=";print_r($zone_list); echo "<hr/>";exit;
        
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
                   
                    foreach($zone_list as $key=>$value){ 

                       $zone_id =$value['id'];                   
                    $filename                   = $annexure_abbr_array[$getAnxVal].'_'.date('Y-m-d').'_'.$zone_id.'.xlsx';
                    //echo "<pre>==";print_r($filename);exit;
                    $result = $this->cron_model->getOriginalCourtDDtxn($getAnxVal,$zone_id);
                   
                    if(!empty($result)){
                        
                        $result1 = array_unshift($result , $defined_annexure_col_array);
                    
                        $file_path = $rootPath.'/'.$annexure_type[$getAnxVal];
                        
                        $objPHPExcel = new PHPExcel();
                        $objPHPExcel->getActiveSheet()->fromArray($result, null, 'A1');
                        
                         $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
                         $objWriter->save($file_path.'/'.$filename);
                         echo $filename;echo "<hr/>";
                    }
                }
                
    }     
    function download_LowerCourtDDReport(){
        // echo "<pre>===";print_r('hi');exit;
        echo date('Y-m-d H:i:s');
        /** Include PHPExcel */
        $this->load->library('Classes/PHPExcel');
         $zone_list  = $this->cron_model->getZoneList();
          // echo "<pre>=";print_r($zone_list); echo "<hr/>";exit;
        
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
                   
                    foreach($zone_list as $key=>$value){ 

                       $zone_id =$value['id'];                   
                    $filename                   = $annexure_abbr_array[$getAnxVal].'_'.date('Y-m-d').'_'.$zone_id.'.xlsx';
                    //echo "<pre>==";print_r($filename);exit;
                    $result = $this->cron_model->getLowerCourtDDtxn($getAnxVal,$zone_id);
                   
                    if(!empty($result)){
                        
                        $result1 = array_unshift($result , $defined_annexure_col_array);
                    
                        $file_path = $rootPath.'/'.$annexure_type[$getAnxVal];
                        
                        $objPHPExcel = new PHPExcel();
                        $objPHPExcel->getActiveSheet()->fromArray($result, null, 'A1');
                        
                         $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
                         $objWriter->save($file_path.'/'.$filename);
                         echo $filename;echo "<hr/>";
                    }
                }
                
    }
    function download_HighCourtDDReport(){
        // echo "<pre>===";print_r('hi');exit;
        echo date('Y-m-d H:i:s');
        /** Include PHPExcel */
        $this->load->library('Classes/PHPExcel');
         $zone_list  = $this->cron_model->getZoneList();
          // echo "<pre>=";print_r($zone_list); echo "<hr/>";exit;
        
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
                   
                   foreach($zone_list as $key=>$value){ 

                       $zone_id =$value['id'];                   
                    $filename                   = $annexure_abbr_array[$getAnxVal].'_'.date('Y-m-d').'_'.$zone_id.'.xlsx';
                    //echo "<pre>==";print_r($filename);exit;
                    $result = $this->cron_model->getHighCourtDDtxn($getAnxVal,$zone_id);
                   
                    if(!empty($result)){
                        
                       $result1 = array_unshift($result , $defined_annexure_col_array);
                    
                        $file_path = $rootPath.'/'.$annexure_type[$getAnxVal];
                        
                        $objPHPExcel = new PHPExcel();
                        $objPHPExcel->getActiveSheet()->fromArray($result, null, 'A1');
                        
                         $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
                         $objWriter->save($file_path.'/'.$filename);
                         echo $filename;echo "<hr/>";
                       
                    }
                }
            } 

}

?>
