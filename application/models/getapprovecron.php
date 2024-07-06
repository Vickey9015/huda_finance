<?php
ini_set('memory_limit','2048M');
error_reporting(1);
class Getapprovecron extends CI_Controller {

    function __construct() {
        $data =array();
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('user_model');
        $this->load->model('getapprovecron_model');
        $this->load->model('authentication_model');        
        $this->load->helper('url');
        $this->load->helper('common_helper');
        $this->load->library('session');
        $this->load->library('Classes/PHPExcel');
        $data  = array('is_logged_in'=>$this->session->userdata('logged_in'));

    }

    function c_array(){
       // print_r('hi'); exit;
        echo date('Y-m-d H:i:s');
    
        // $getAnxVal                  = 1; 
        $rootPath = 'SFTP_HUDA/OUT';
        // $rootEncOutPath = 'Encrypt/in'; for encryption 
        $rootEncOutPath = 'Encrypt/out';
        
        $annexure_path_array        =    array('1' => 'Original_Award', '2' => 'Lower_Court','3'=>'Higher_Court','4'=>'Supreme_Court','5'=>'DD_Upload');
        $annexure_abbr_array        =    array('1' => 'OA', '2' => 'LC','3'=>'HC','4'=>'SC','5'=>'DD','6'=>'DD_OUTPUT');
        $annexure_type              =    unserialize(ANNEXURE_TYPE);
        $annexure                   =    unserialize(ANNEXURE);

        // echo "<pre>==="; print_r($annexure_type); 
        // echo "<pre>==="; print_r($annexure); 

        $defined_annexure_col_array =    $annexure[$annexure_type[1]];

        $defined_annexure_col_array = Array(
            'serial_no' => 'Sr. No.',
            'sector_no' => 'Sector No.',
            'villlage_name' => 'Name of Village',
            'section_notfn_date' => 'Date of Section 6 Notification (DD-MM-YY)',
            'is_petition_filed' => 'Whether petition filed by the land owner for release of land',
            'award_no' => 'Award No.',
            'award_date' => 'Date of Award (DD-MM-YY)',
            'LAO_bank_account_no' => 'Bank A/c No. of LAO from which payment is to be made',
            'beneficiary_name' => 'Name of Beneficiary',
            'beneficiary_PAN' => 'PAN NO.',
            'gross_amount_to_paid' => 'Gross Amount to be Paid',
            'TDS_deducted' => 'TDS to be deducted',
            'net_amount' => 'Net Amount to be paid to Beneficiary',
            'ifsc_code' => 'IFSC code of Beneficiary',
            'account_number' => 'Bank A/c of the Beneficiary',
            'is_EDC' => 'EDC OR Non EDC [E= EDC N = Non EDC]',
            'mobile_number' => '10- Digit Mobile Number',
            'customer_reference_number' => 'Customer Reference Number'
        );

        $upload_date               = array('UploadDate'=>'Upload Date');
        $defined_annexure_col_array= array_merge($upload_date, $defined_annexure_col_array);
        // echo "<pre>====="; print_r($defined_annexure_col_array);  exit;

        // Here is the sample array of data
        $filename = 'UN_'.date('YmdHis').'.csv';
        $result = $this->getapprovecron_model->getSuccesstxn();

        // $result[$j]['mobile'] = '9999999999';
        array_walk_recursive($result, array($this, 'edit_phone'));

        //echo "<pre>=====";print_r($result); exit;
        // $file_status = $this->getapprovecron_model->viewFile();
        if(!empty($result)){
            
            $totalAmount = array_sum(array_map(function($item) { 
                //echo "<pre>===";print_r($item); die;

                return $item['net_amount']; 
            }, $result));
            $data = array(
                'file_name'  =>$filename,
                'annexure_type'=>9,
                'total_txn'  =>count($result),
                'total_value'=>$totalAmount
            );
            //echo "<pre>==="; print_r($data);
            $result1 = array_unshift($result , $defined_annexure_col_array);
            // echo "<pre>==="; print_r($result); die;
            
            $file_path = $rootPath.'/Original';

            //$file_path = $rootPath.'/'.$annexure_type[1];
            
            // echo "<pre>=====";
            // print_r($result);
            // print_r($annexure_type);
            // print_r($defined_annexure_col_array);  

            $objPHPExcel = new PHPExcel();

            $objPHPExcel->getActiveSheet()->fromArray($result, null, 'A1');
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV')->setEnclosure('')->setLineEnding("\r\n");
            $objWriter->save($file_path.'/'.$filename);
            $objWriter->save($rootEncOutPath.'/'.$filename);
            $this->getapprovecron_model->insertReleaseFile($data);
            
        }
        else{
            echo "<br>WARNING ! No new record to release.";
        }
    }

     
   public function updateAnnexures() {
    $this->load->library('Classes/PHPExcel');
    
    // echo "<pre>=$account_number====";print_r($session_data); print_r($_REQUEST);  exit;
    $file_list                  = $this->getapprovecron_model->getReverseAnnexureFile();
    //  echo "<pre>=====";print_r($file_list); // exit;
    if(empty($file_list)){
        echo 'File not exist in database'; 
    }
    foreach($file_list as $value){
        //echo "<pre>=1====";print_r($value['file_name']); // exit;
            $filename =$value['file_name'];
            $file_status = $value['file_status'];
            //$filename  = preg_replace('/(\.csv)/', 'R$1', $filename);
            $anx_type =$value['annexure_type'];
            $id =$value['id'];
            // $getAnxVal                  = 1;
            // $annexure_type              = unserialize(ANNEXURE_TYPE);
            // $annexure                   = unserialize(ANNEXURE);
            
            // $folder_path                = $annexure_type[$anx_type];
            $import_xls_file            = "SFTP_HUDA/IN/Original/$filename";
            //$import_xls_file            = "SFTP_HUDA/IN/Original/$folder_path/DD_20190107161602R.csv";
            // echo "hlw"; print_r(file_exists($import_xls_file)); 
            // echo "<pre>=$import_xls_file===="; print_r($value); exit;
            if (file_exists($import_xls_file) && $file_status == 0 && $anx_type == 9){
                $inputFileName = $import_xls_file;
                //echo "<pre>=$import_xls_file===="; print_r($value); 
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
                foreach($allDataInSheet as $value){
                    $is_released=0;
                    if($c>1){
                        
                        $logArray =array(
                            'log'      =>json_encode($value),
                            'request_type'=>'updateAnnexures'.$c
                        );  
                        $this->getapprovecron_model->createLog($logArray);
                        //$filterArray               =array_filter($value);
                        // echo $anx_type;
                        if($anx_type < 4){
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
                                    $is_released='1';
                                    $annexure_status ='7';
                                }elseif(in_array($StatusCode, $status_failed)){
                                    $is_released='2';
                                    $annexure_status ='7';
                                }
                                else{
                                    $is_released='3';
                                    $annexure_status ='7';
                                }
                                //$annexure_status           = $StatusCode == 'P' ? '11':'7';
                            }else{
                                if (in_array($StatusCode, $status_success)){
                                        $annexure_status ='11';
                                }elseif(in_array($StatusCode, $status_released)){
                                    $is_released='1';
                                    $annexure_status ='6';
                                }elseif(in_array($StatusCode, $status_failed)){
                                    $is_released='2';
                                    $annexure_status ='6';
                                }
                                else{
                                    $is_released='3';
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
                                $is_released='1';
                                $annexure_status ='7';
                            }elseif(in_array($StatusCode, $status_failed)){
                                $is_released='2';
                                $annexure_status ='6';
                            }else{
                                $is_released='3';
                                $annexure_status ='7';
                            }
                        }   
                        $data = array(
                            'annexure_status'  => $annexure_status,
                            'UTR'              => $UTR,
                            'StatusCode'       => $StatusCode,
                            'StatusDesc'       => $StatusDesc,
                            'is_released'      => $is_released
                            
                        );
                        // echo $annexure_status;
                        if($annexure_status == 6){
                            $data['returned_on'] = date('Y-m-d H:i:s');
                            $data['is_released'] = 0;
                            $data['is_return'] = 1;
                        }
                        if($annexure_status == 11){
                            $data['updated_on'] = date('Y-m-d H:i:s');
                        }
                        //echo "updaing status";
                        echo $customer_reference_number.'</br>';
                        // echo "<pre>=$import_xls_file===="; print_r($data); echo "<hr/>"; 
                        $this->getapprovecron_model->updateReverseAnnexuresStatus($customer_reference_number,$data);
                        //$this->getapprovecron_model->updateReverseAnnexuresStatus($customer_reference_number,$value['B'],$value['R'],$data);
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
                    rename($inputFileName,"SFTP_HUDA/IN/Original/$newFilename");
                }
                $this->getapprovecron_model->updateReverseAnnexuresFiles($id,$status);
            }else{
               echo $filename.'  not exist'; 
               
            }
        }   
    }

    function edit_phone(&$item, $key) {
        if ($key == 'account_number') {
            $item = str_replace(",", "",$item);
        }
        if ($key == 'mobile_number' && $item !='' ) {
            $item = $item;
        }
        if ($key == 'UploadDate' && $item !='' ) {
            $item = str_replace(",", "",$item);
            $item = date('d-m-Y', strtotime($item));
        }
        if ($key == 's_no' && $item !='' ) {
            $item = str_replace(",", "",$item);
        }
        if ($key == 'name_of_bene' && $item !='' ) {
            $item = str_replace(",", "",$item);
        }
        if ($key == 'sector_no' && $item !='' ) {
            $item = str_replace(",", " ",$item);
        }
        if ($key == 'name_of_village' && $item !='' ) {
            $item = str_replace(",", " ",$item);
        }
        if ($key == 'date_of_six_sectiom' && $item !='') {
            $item = str_replace(",", " ",$item);
        }
        if ($key == 'award_no' && $item !='' ) {
            $item = str_replace(",", " ",$item);
        }
        if ($key == 'award_date' && $item !='' ) {
            $item = str_replace(",", " ",$item);
            $item = date('d-m-Y', strtotime($item));
        }
        if ($key == 'beneficiary_PAN' && $item !='' ) {
            $item = str_replace(",", " ",$item);
        }
        if ($key == 'gross_amount_to_paid' && $item !='' ) {
            $item = str_replace(",", " ",$item);
        }        
        if ($key == 'TDS_deducted' && $item !='' ) {
            $item = str_replace(",", " ",$item);
        }        
        if ($key == 'ifsc_code' && $item !='' ) {
            $item = str_replace(",", " ",$item);
        }
        if ($key == 'is_edc' && $item !='' ) {
            $item = str_replace(",", " ",$item);
        }
        if ($key == 'is_petition_filed' && $item !='' ) {
            $item = str_replace(",", " ",$item);
        }
        if ($key == 'net_amount' && $item !='' ) {
            $item = str_replace(",", " ",$item);
        }
        if ($key == 'bank_ac_lao' && $item !='' ) {
            $item = str_replace(",", " ",$item);
        }
        if ($key == 'customer_ref_numer') {
            //print_r('hlw'); die;
            $this->getapprovecron_model->updateAnnexures($item);
        }
    }
    

    

}
