<?php
class DDAnnexure extends CI_Controller {

    function __construct() {
        $data =array();
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $data  =array('is_logged_in'=>$this->session->userdata('logged_in'));
       
        $this->load->model('user_model');
		$this->load->model('ddannexure_model');
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
	
	function DDAnnexurefile(){
		
		echo date('Y-m-d H:i:s');
        /** Include PHPExcel */
		$this->load->library('Classes/PHPExcel');
		
		for($i=5; $i<9; $i++){
			$getAnxVal                  = $i; 
			$rootPath = 'SFTP_HUDA/OUT';
			//$rootEncOutPath = 'Encrypt/in'; for encryption 
			$rootEncOutPath = 'Encrypt/out';
			//include './Encrypt/run.php';
			$annexure_path_array        =    array('1' => 'Original_Award', '2' => 'Lower_Court','3'=>'Higher_Court','4'=>'Supreme_Court','5'=>'DD_Upload','6' => 'Original_Award_DD', '7' => 'Lower_Court_DD','8'=>'Higher_Court_DD');
			$annexure_abbr_array        =    array('1' => 'OA', '2' => 'LC','3'=>'HC','4'=>'SC','5'=>'DD','6'=>'ODD','7'=>'LDD','8'=>'HDD');
			$annexure_type      	    =    unserialize(ANNEXURE_TYPE);
			$annexure            		=    unserialize(ANNEXURE);
			
			    //echo "if";
			$defined_annexure_col_array =    $annexure['DD_OUTPUT'];
	
			// for upload date 26 aug 
			$upload_date               =array('UploadDate'=>'Value Date');
			$defined_annexure_col_array= $defined_annexure_col_array+$upload_date;
			
			// Here is the sample array of data
			$filename                   = $annexure_abbr_array[$getAnxVal].'_'.date('YmdHis').'.csv';
			$result                     = $this->ddannexure_model->getSuccesstxn($getAnxVal);
			//echo "<pre>=====";print_r($result);  print_r($defined_annexure_col_array);  exit;
			array_walk_recursive($result, array($this, 'edit_phone'));
			//echo "<pre>===$i==";print_r($result); echo "<hr/>";
			//$file_status = $this->ddannexure_model->viewFile();
		//	echo "<pre>===$getAnxVal==";print_r($result);  echo "<hr>";
			if($getAnxVal ==6){
			    
			    $reponseArray = $this->getOriginalDDoutputArray($result);
			}else{
			    $reponseArray = $this->getOtherDDoutputArray($result);
			}
        //	echo "<pre>===sssss==";print_r($reponseArray); print_r($defined_annexure_col_array);  exit;		
        			
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
								//print_r($data);
								$result1 = array_unshift($reponseArray , $defined_annexure_col_array);
								//echo "<pre>=====";print_r($reponseArray); print_r($defined_annexure_col_array);  exit;
							
								$file_path = $rootPath.'/'.$annexure_type[$getAnxVal];
								
								echo "<pre>=====";print_r($file_path); print_r($result1); 
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
								echo $this->ddannexure_model->insertReleaseFile($data);
								//$this->testEmail($data);
								//Send email to bank
								
								//echo "===================================="; 
								//header("Location: http://ipay.indusind.com/Encrypt/run.php?file_name=".$filename."&anx_type=".$getAnxVal);
        	        }
			
			
		}
		
	}
	
	function getOriginalDDoutputArray($result){
	        $reponseArray =array();
			$n= 0; 
			foreach($result as $key=>$value){
				
				// Add Parent Record 
				$reponseArray[$n]['record_identifier'] ='P';
				$reponseArray[$n]['transaction_type'] ='D';
				$reponseArray[$n]['customer_id']      =CUSTOMER_ID;
				$reponseArray[$n]['transaction_amount'] =$value['net_amount'];
				$reponseArray[$n]['beneficiary_name'] =$value['drawee_name'];
				$reponseArray[$n]['drawee_location'] =trim($value['DD_PAYABLE_AT']);
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
				$reponseArray[$n]['beneficiary_name'] =$value['section_notfn_date'];
				$reponseArray[$n]['drawee_location'] =$value['is_petition_filed'];
				$reponseArray[$n]['print_location'] =$value['award_no'];
				
				$reponseArray[$n]['beneficiary_add_line1'] =$value['award_date'];
				$reponseArray[$n]['beneficiary_add_line2'] ='';
				$reponseArray[$n]['beneficiary_add_line3'] ='';
				$reponseArray[$n]['beneficiary_add_line4'] ='';
				
				$reponseArray[$n]['zipcode'] ='';
				$reponseArray[$n]['instrument_ref_no'] ='';
				$reponseArray[$n]['customer_reference_number'] =$value['customer_reference_number'];
				
				$reponseArray[$n]['advising_detail1']  =$value['beneficiary_name'];
				$reponseArray[$n]['advising_detail2']  =$value['beneficiary_PAN'];
				$reponseArray[$n]['advising_detail3']  =$value['gross_amount_to_paid'];
				$reponseArray[$n]['advising_detail4']  ='';
				$reponseArray[$n]['advising_detail5']  ='';
				$reponseArray[$n]['advising_detail6']  =$value['is_EDC'];
				
				$reponseArray[$n]['cheque_no'] ='';
				$reponseArray[$n]['instrument_date'] ='';
				$reponseArray[$n]['MICR_no'] ='';
				$reponseArray[$n]['bene_email_id'] ='';
				
				$reponseArray[$n]['LAO_bank_account_no'] ='';
				$reponseArray[$n]['UploadDate'] ='';
				$n++;
			}
			return $reponseArray;
	    
	}
	
	function getOtherDDoutputArray($result){
	        $reponseArray =array();
			$n= 0; 
			foreach($result as $key=>$value){
				
				// Add Parent Record 
				$reponseArray[$n]['record_identifier'] ='P';
				$reponseArray[$n]['transaction_type'] ='D';
				$reponseArray[$n]['customer_id']      =CUSTOMER_ID;
				$reponseArray[$n]['transaction_amount'] =$value['net_amount'];
				$reponseArray[$n]['beneficiary_name'] =$value['drawee_name'];
				$reponseArray[$n]['drawee_location'] =trim($value['DD_PAYABLE_AT']);
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
				$reponseArray[$n]['UploadDate'] ='';
				$n++;
			}
			
			return $reponseArray;
	    
	}
	
	function encUploadFile(){
	    $file_list  = $this->ddannexure_model->getAnnexureFile();
		if(!empty($file_list)){
		    
			foreach($file_list as $key=>$value){
			    $filename =$value['file_name'];
				$anx_type =$value['annexure_type'];
				$annexure_type      	    =    unserialize(ANNEXURE_TYPE);
				$id =$value['id'];
				$annexure_path_array        = array('1' => 'Original_Award', '2' => 'Lower_Court','3'=>'Higher_Court','4'=>'Supreme_Court','5'=>'DD_Upload');
				$sftp_fd_path               = $annexure_path_array[$anx_type];
				$localPath                  = $annexure_type[$anx_type];
				$result = $this->ddannexure_model->uploadFile($sftp_fd_path, $localPath,$filename);
		        $this->ddannexure_model->updateEncAnnexures($id);
			} 
			
		}
		echo "<pre>====";print_r($file_list);  exit;
		
		//echo "<pre>==$sftp_fd_path=========$anx_type==";print_r($result);  exit;
	}
	
	
	
	function edit_phone(&$item, $key) {
		if ($key == 'account_number') {
				$item = str_replace(",", "-",$item);
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
		
		if ($key == 'beneficiary_name' && $item !='' ) {
			$item = str_replace(",", "-",$item);
		}
		
		if ($key == 'award_no' && $item !='' ) {
			$item = str_replace(",", "-",$item);
		}
		
		if ($key == 'award_date' && $item !='' ) {
			$item = str_replace(",", "-",$item);
		}
		
		if ($key == 'gross_amount_to_paid' && $item !='' ) {
			$item = str_replace(",", "-",$item);
		}
		
		if ($key == 'TDS_deducted' && $item !='' ) {
			$item = str_replace(",", "-",$item);
		}
		
		if ($key == 'net_amount' && $item !='' ) {
			$item = str_replace(",", "-",$item);
		}
		
		if ($key == 'is_EDC' && $item !='' ) {
			$item = str_replace(",", "-",$item);
		}
		
		if ($key == 'ADJ_court_order_no' && $item !='' ) {
			$item = str_replace(",", "-",$item);
		}
		
		if ($key == 'high_court_order_no' && $item !='' ) {
			$item = str_replace(",", "-",$item);
		}
		
		if ($key == 'supreme_court_order_no' && $item !='' ) {
			$item = str_replace(",", "-",$item);
		}
		if ($key == 'supreme_court_decision_date' && $item !='' ) {
			$item = str_replace(",", "-",$item);
		}
		
		
		
		
		if ($key == 'customer_reference_number'  ) {
			 $this->ddannexure_model->updateAnnexures($item);
		}
    }
	
	function viewFile(){
	    $annexure_path_array        = array('1' => 'Original_Award',
		'2' => 'Lower_Court','3'=>'Higher_Court','4'=>'Supreme_Court',
		'5'=>'DD_Upload');
		foreach($annexure_path_array as $key=>$value){
		      $result = $this->ddannexure_model->viewFile($value);
			  $result1 = $this->ddannexure_model->viewReturnFile();
			  
			  echo "<pre>====";print_r($result);print_r($result1);
		}
	    
		//echo "<pre>====";print_r($result);  exit;
	}
	
	function downloadFile(){
	    $file_list  = $this->ddannexure_model->getAnnexureFile(1);
		if(!empty($file_list)){
		    
			foreach($file_list as $key=>$value){
			    $filename =$value['file_name'];
				$anx_type =$value['annexure_type'];
				$id =$value['id'];
				$annexure_type      	    =    unserialize(ANNEXURE_TYPE);
				$annexure_path_array        = array('1' => 'Original_Award', '2' => 'Lower_Court','3'=>'Higher_Court','4'=>'Supreme_Court','5'=>'DD_Upload');
				$sftp_fd_path               = $annexure_path_array[$anx_type];
				$localPath                  = $annexure_type[$anx_type];
				$result = $this->ddannexure_model->downloadFile($sftp_fd_path, $localPath,$filename);
				echo "<pre>====";print_r($result); 
		        
			} 
			
		}
		echo "<pre>====";print_r($file_list);  exit;
		
		//echo "<pre>==$sftp_fd_path=========$anx_type==";print_r($result);  exit;
	}
	// Download Returned File
	
	function downloadReturnFile(){
	    
		
		    
			$result = $this->ddannexure_model->downloadReturnFile();
			
		     echo "<pre>====";print_r($result);  exit;
		
		//echo "<pre>==$sftp_fd_path=========$anx_type==";print_r($result);  exit;
	}
	/*function downloadReturnFile(){
	    $file_list  = $this->ddannexure_model->getAnnexureFile(1);
		if(!empty($file_list)){
		    
			foreach($file_list as $key=>$value){
			    //$filename =$value['file_name'];
				//$anx_type =$value['annexure_type'];
				//$id =$value['id'];
				//$annexure_path_array        = array('1' => 'Original_Award', '2' => 'Lower_Court','3'=>'Higher_Court','4'=>'Supreme_Court','5'=>'DD_Upload');
				//$sftp_fd_path               = $annexure_path_array[$anx_type];
				$result = $this->ddannexure_model->downloadFile($sftp_fd_path, $type= 'Returned',$filename);
				echo "<pre>====";print_r($result); 
		        
			} 
			
		}
		echo "<pre>====";print_r($file_list);  exit;
	}*/
	
	public function updateAnnexures() {
        $this->load->library('Classes/PHPExcel');
		
        // echo "<pre>=$account_number====";print_r($session_data); print_r($_REQUEST);  exit;
		$file_list                  = $this->ddannexure_model->getReverseAnnexureFile();
		 //echo "<pre>=====";print_r($file_list); // exit;
		foreach($file_list as $key=>$value){
				  
				$filename =$value['file_name'];
				$file_status = $value['file_status'];
				//$filename  = preg_replace('/(\.csv)/', 'R$1', $filename);
				$anx_type =$value['annexure_type'];
				$id =$value['id'];
				$getAnxVal                  = 1;
				$annexure_type      	    = unserialize(ANNEXURE_TYPE);
				$annexure            		= unserialize(ANNEXURE);
				
				$folder_path                = $annexure_type[$anx_type];
				$import_xls_file            = "SFTP_HUDA/IN/$folder_path/$filename";
				//$import_xls_file            = "SFTP_HUDA/IN/$folder_path/DD_20190107161602R.csv";
				//echo "<pre>=$import_xls_file===="; print_r($value); exit;
				if (file_exists($import_xls_file) && (($value['file_status'] == 0 or ($value['file_status'] == 1 && $anx_type == 5)))){
					$inputFileName = $import_xls_file;
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
					foreach($allDataInSheet as $key=>$value){
						if($c>1){
							
							$logArray            =array(
										 'log'      =>json_encode($value),
										 'request_type'=>'updateAnnexures'.$c
							);	
							$this->createLog($logArray);
							//$filterArray               =array_filter($value);
							echo $anx_type;
						if($anx_type == 5){
						    //echo "<pre>===";print_r($value);die;
						    $customer_reference_number = $value['N'];
						    $subArray                  =array_slice($value, -4, 4, true);
						    $subArray = array_values($subArray);
						    $UTR                       =$subArray[1];
							$StatusCode                =$subArray[2];
							$StatusDesc                =$subArray[3];
							if($file_status == 1){
							    $annexure_status           = $StatusCode == 'NA' ? '11':'6';
							}else{
							   $annexure_status            = $StatusCode  =='SUCCESS' ? '11':'6'; 
							}
						}else{	
							$subArray = array_slice($value, -4, 4, true);
							$subArray = array_values($subArray);
							$customer_reference_number =$subArray[0];
							$UTR                       =$subArray[1];
							$StatusCode                =$subArray[2];
							$StatusDesc                =$subArray[3];
							$annexure_status          =$StatusCode =='SUCCESS' ? '11':'6'; 
						}	
							$data = array(
								'annexure_status' => $annexure_status,
								'UTR'              => $UTR,
								'StatusCode'       => $StatusCode,
								'StatusDesc'       => $StatusDesc
								
							);
							if($annexure_status == 6){
							    $data['returned_on'] = date('Y-m-d H:i:s');
							    $data['is_released'] = 0;
							}
							if($annexure_status == 11){
							    $data['update_on']       = date('Y-m-d H:i:s');
							}
							$this->ddannexure_model->updateReverseAnnexuresStatus($customer_reference_number,$data);
						}
						$c++;
					}
					$status = 1;
				    if($anx_type == 5 && $file_status == '1'){
				        $status = 2;
				    }
					$this->ddannexure_model->updateReverseAnnexuresFiles($id,$status);
				}else{
				   echo $filename.'  Not exist<hr/>'; 
				}
			
		}	
       
    }

public function updateReturnAnnexures() {
        $this->load->library('Classes/PHPExcel');
		
        
				echo $import_xls_file            = "SFTP_HUDA/Returned/HUDA_ReturnsOps.csv";
				//die;
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
											//'returned_on'=>date('Y-m-d'),
											'annexure_status' => 6,
											'is_released' => 0,
											'returned_on' => date('Y-m-d H:i:s')
											
								);
								//echo $this->ddannexure_model->updateReturnedAnnexuresStatus($customer_reference_number,$data);
								//echo "<pre>=uuuuu====";  print_r($data); exit;
							   $logArray            =array(
										 'log'      =>json_encode($data),
										 'request_type'=>'updateReturnAnnexures'
								);	
								$this->createLog($logArray);
								
							}
							$c++;
						}
						unlink($import_xls_file);
					} catch (Exception $e) {
						die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
								. '": ' . $e->getMessage());
					}	
				}else{
					$logArray            =array(
									 'log'      =>'File not exist.',
									 'request_type'=>'updateReturnAnnexures'
					);	
					$this->createLog($logArray);
				}
		
    }
	
	function testEmail($option){
	   
	   $to_email ='eb@indusind.com';
	   $subject ='Release email for Huda';
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