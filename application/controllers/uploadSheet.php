<?php

class UploadSheet extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_model');
$data  =array('is_logged_in'=>$this->session->userdata('logged_in'));
        if(!$this->session->userdata('logged_in')){
			redirect(base_url().'user/index');
			
		}
        $this->load->helper('url');
        $this->load->library('session');
		$this->load->library('upload');
		$this->load->model('import_model');
		$this->load->helper('common_helper');
        //$this->load->library('curl');
    }

 function UploadSheet(){ 
		
		$data =array();
		$session_data = $this->session->all_userdata();
        //echopre($session_data); exit;
        $data['session_data'] = $session_data;
		$this->load->view('layout/header', $data);
        $this->load->view('layout/topbar', $data);
		$this->load->view('layout/leftbar', $data);
$this->load->view('uploadSheet',$data);
		$this->load->view('layout/footer');
	}
	function UploadXls(){
		echo "<pre>====="; print_r($_REQUEST); 
		exit();
	}
	
	public function index() {
        $data['page'] = 'import';
        $data['title'] = 'Import XLSX | TechArise';
        $this->load->view('import/index', $data);
    }
    // import excel data
    public function save() {
        $this->load->library('Classes/PHPExcel');
		$session_data = $this->session->all_userdata();
        //echopre($session_data); exit;
		$resultArray =array();
		$errorArray  =array();
        $loa_account_number = explode(',',$session_data['account_number']);
        // echo "<pre>=$account_number====";print_r($session_data); print_r($_REQUEST);  exit;
        if ($this->input->post('importfile')) {
			$getAnxVal                  =    $this->input->post('annexure_type'); 
            $annexure_type      	    =    unserialize(ANNEXURE_TYPE);
			$annexure            		=    unserialize(ANNEXURE);
			$defined_annexure_col_array =    $annexure[$annexure_type[$getAnxVal]];
			//echo "<pre>=defined_annexure_col_array====";print_r($defined_annexure_col_array);  
            $config['upload_path']      = 'upload/'.$annexure_type[$getAnxVal].'/'; 
 
		$config['allowed_types']    = 'xlsx|xls|jpg|png';
            $config['remove_spaces']    = TRUE;
            $x= $this->upload->initialize($config);
            $this->load->library('upload', $config);
			$filename    =$_FILES['userfile']['name'];
			$imageFileType = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
			
			//$imageFileType = strtolower(pathinfo($mandate_image["name"],PATHINFO_EXTENSION));
			//$filename = $file_name.'.'.$imageFileType;
			$target_file = $config['upload_path'].''.$filename; 
			$target_file =trim($target_file,'.');
			//die;
			//echo "<pre>==$target_file==="; print_r($_FILES);print_r($_REQUEST); die;
			//$file_remove =unlink($target_file); 
			if (file_exists($target_file)){
				//$file_remove =unlink($target_file); 
				$msg ="exist";
				//$messge = array('message' => FILE_EXIST_MESSAGE,'class' => 'alert alert-success fade in');
				//$this->session->set_flashdata('anrError', $messge); 
		        //redirect(base_url().'uploadSheet/UploadSheet');
				
			}else{
				$msg= "file_not_found";	
			}
			$session_data = $this->session->all_userdata();
			$zone_id      =$session_data['zones'][0]['id'];
            //echo "<pre>====="; print_r($session_data); exit;
			if($msg =='exist'){
				//$messge = array('message' => FILE_EXIST_MESSAGE,'class' => 'alert alert-success fade in');
				//$this->session->set_flashdata('item', $messge); 
				//redirect(base_url().'uploadSheet/UploadSheet');
			    $errorArray[0][0]   =FILE_EXIST_MESSAGE;
				$messge = array('message' => $errorArray,'class' => 'showError alert-success fade in');
		        $this->session->set_flashdata('anrError', $messge); 
		        redirect(base_url().'uploadSheet/UploadSheet');
			
			}
			
            if(isset($_FILES['userfile'])){
					if ($_FILES["userfile"]["error"] == 0){
							$filename = $_FILES["userfile"]["name"];
							$path = $config['upload_path']."".$filename;
							move_uploaded_file($_FILES["userfile"]["tmp_name"], $path);
							$ann_file = $filename;
							$error = array('error' => $_FILES["userfile"]["error"]);
					}
			}
			$import_xls_file = $ann_file;
           
			
            $inputFileName = $config['upload_path'] . $import_xls_file;
			//echo "<pre>=dd==$inputFileName=="; print_r($objPHPExcel); exit();
			if (! is_readable($inputFileName)) die('cant read file, check permissions');
            try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
				
				$worksheetData = $objReader->listWorksheetInfo($inputFileName);
				$totalRows     = $worksheetData[0]['totalRows'];
				//$totalColumns  = $worksheetData[0]['totalColumns'];
				
				if($totalRows ==1){
					unlink($target_file); 
					$messge = array('message' => EMPTY_ANNEXURE_FILE_MESSAGE,'class' => 'alert alert-success fade in');
					$this->session->set_flashdata('item', $messge); 
					redirect(base_url().'uploadSheet/UploadSheet');
				}
				
				$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
				$highestRow = $objWorksheet->getHighestRow();
				$highestColumn = $objWorksheet->getHighestColumn();
				$maxCell = $objWorksheet->getHighestRowAndColumn();
                $allDataInSheet = $objWorksheet->rangeToArray('A1:' . $maxCell['column'] . $maxCell['row']);
				$headingsArray = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);
				//echo "<pre>=uuuuu====";  print_r($data);  print_r($headingsArray); exit();
				//echo "<pre>=$highestRow====$highestColumn="; print_r($objPHPExcel);echo "<pre><hr/>";
				
            } catch (Exception $e) {
                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                        . '": ' . $e->getMessage());
            }
            //$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true); 
            //echo "<pre>=uuuuu====";  print_r($allDataInSheet); die;
            $arrayCount     = count($allDataInSheet);
            $flag           = 0;
			$createArray    = array_values($defined_annexure_col_array);
            $makeArray      = $defined_annexure_col_array;
            $SheetDataKey   = array();
			$fileArray      = $allDataInSheet[0];
			$fileArray      =array_filter($fileArray);
			
			
			// Check for column inter-change 
			$file_array_values    = array_values($fileArray);
			$file_trimmed_array   = array_map('trim',$file_array_values);
			$defined_array_values = array_values($defined_annexure_col_array);
			$result_intersect     = array_diff_assoc($file_trimmed_array, $defined_array_values);
			//unlink($target_file);
		//echo "<pre>======";print_r($file_array_values);echo "<hr/>"; print_r($defined_array_values);echo "<hr/>"; print_r($result_intersect);echo "<pre><hr/>"; exit;
			//echo "<hr/>";
			//die;
			if(!empty($result_intersect)){
				unlink($target_file); 
				$messge = array('message' => 'Annexure Column not matched.','class' => 'alert alert-success fade in');
				$this->session->set_flashdata('item', $messge); 
				redirect(base_url().'uploadSheet/UploadSheet');
			}
			
			//unlink($target_file);
			//echo "<pre>======";print_r($allDataInSheet);print_r($fileArray);echo "<hr/>"; print_r($defined_array_values);echo "<hr/>"; print_r($result_intersect);echo "<pre><hr/>"; exit;
			// Check Blank File
			if($fileArray['0']!='Sr. No.'){
				    unlink($target_file); 
					$messge = array('message' => NON_ANNEXURE_FILE_MESSAGE,'class' => 'alert alert-success fade in');
					$this->session->set_flashdata('item', $messge); 
					redirect(base_url().'uploadSheet/UploadSheet');
			}
			
			//echo "<pre>=allDataInSheetdddd=====";print_r($defined_annexure_col_array);print_r(array_filter($fileArray)); echo "<hr/>"; 
			$totalColumns  = count($fileArray);
			//echo "<pre>=$totalColumns=====";print_r($fileArray); echo "<pre><hr/>"; exit;
			if($getAnxVal ==1 && ($totalColumns != 23 )){
				unlink($target_file); 
				$messge = array('message' => ORITINAL_XLS_COLUMN_MISMATCH_MESSAGE,'class' => 'alert alert-success fade in');
				$this->session->set_flashdata('item', $messge); 
				redirect(base_url().'uploadSheet/UploadSheet');
		   }elseif($getAnxVal ==2 && ($totalColumns != 23 )){
			    unlink($target_file); 
				$messge = array('message' => LOWER_XLS_COLUMN_MISMATCH_MESSAGE,'class' => 'alert alert-success fade in');
				$this->session->set_flashdata('item', $messge); 
				redirect(base_url().'uploadSheet/UploadSheet');
		   }elseif($getAnxVal ==3 && ($totalColumns != 25 )){
			    unlink($target_file); 
				$messge = array('message' => HIGH_XLS_COLUMN_MISMATCH_MESSAGE,'class' => 'alert alert-success fade in');
				$this->session->set_flashdata('item', $messge); 
				redirect(base_url().'uploadSheet/UploadSheet');
		   }
		   elseif($getAnxVal ==4 && ($totalColumns != 27 )){
			    unlink($target_file); 
				$messge = array('message' => SUPREME_XLS_COLUMN_MISMATCH_MESSAGE,'class' => 'alert alert-success fade in');
				$this->session->set_flashdata('item', $messge); 
				redirect(base_url().'uploadSheet/UploadSheet');
		   }elseif($getAnxVal ==5 && ($totalColumns != 27 )){
			    unlink($target_file); 
				$messge = array('message' => DD_XLS_COLUMN_MISMATCH_MESSAGE,'class' => 'alert alert-success fade in');
				$this->session->set_flashdata('item', $messge); 
				redirect(base_url().'uploadSheet/UploadSheet');
		   }elseif($getAnxVal ==6 && ($totalColumns != 21 )){
			    unlink($target_file); 
				$messge = array('message' => HIGH_XLS_COLUMN_MISMATCH_MESSAGE,'class' => 'alert alert-success fade in');
				$this->session->set_flashdata('item', $messge); 
				redirect(base_url().'uploadSheet/UploadSheet');
		   }
		   elseif($getAnxVal ==7 && ($totalColumns != 23 )){
			    unlink($target_file); 
				$messge = array('message' => SUPREME_XLS_COLUMN_MISMATCH_MESSAGE,'class' => 'alert alert-success fade in');
				$this->session->set_flashdata('item', $messge); 
				redirect(base_url().'uploadSheet/UploadSheet');
		   }elseif($getAnxVal ==8 && ($totalColumns != 25 )){
			    unlink($target_file); 
				$messge = array('message' => DD_XLS_COLUMN_MISMATCH_MESSAGE,'class' => 'alert alert-success fade in');
				$this->session->set_flashdata('item', $messge); 
				redirect(base_url().'uploadSheet/UploadSheet');
		   }
            //foreach ($colArray as $dataInSheet) {
			
			foreach ($fileArray as $key => $value) {
				
				if (array_search(trim($value), $defined_annexure_col_array,true)) {
					//echo $value.'<hr/>';
					$valKey =array_search(trim($value), $defined_annexure_col_array,true);
					//$value = preg_replace('/\s+/', '', $value);
					$SheetDataKey[trim($valKey,'.')] = $key;
					//echo "<hr/>";print_r($SheetDataKey);
				} else {
					//echo 'not found=='.$value;
				}
			}
			//echo "<hr/>====SheetDataKey==<pre>";print_r($allDataInSheet); exit;
			
			$c = 0;
			
			$ref_num = 'NUPAY'.rand(100000000,999999999);
			$created_on = gmdatechange();
			$annexrAbbr = array('1'=>'O','2'=>'L','3'=>'H','4'=>'S','5'=>'D','6'=>'P','7'=>'Q','8'=>'R');
			$crn        = $annexrAbbr[$getAnxVal];
			$importArray =array();
			$hashKeyArray = array();
			$checkSumErrorArray=array();
			foreach($allDataInSheet as $key=>$value){
				
				if($c>0){
				    
				     if($value['0'] =='' && $value['1'] =='' && $value['1'] ==''){
        				    unlink($target_file); 
        					$messge = array('message' => 'Annexures file contains blank row.','class' => 'alert alert-success fade in');
        					$this->session->set_flashdata('item', $messge); 
        					redirect(base_url().'uploadSheet/UploadSheet');
        			}
					$value       = array_slice($value, 0, $totalColumns);
					
					
					$resultArray = array_combine(array_keys($SheetDataKey), array_values($value));
					$is_EDC      = trim($resultArray['is_EDC']) =='E' ? 'E':'N';
					if($getAnxVal == 1){
    					$hashArray   = array(
    						                 'is_EDC'=>$is_EDC,
    						                 'award_no'=>$resultArray['award_no'],
    										 'annexure_type'=>$crn,
    										 'account_number'=>$resultArray['account_number'],
    										 'sector_no'    => $resultArray['sector_no'],
    										 'award_date'   => $resultArray['award_date'],
    										 );
					}else if($getAnxVal == 2){
    					$hashArray   = array(
    						                 'is_EDC'             =>$is_EDC,
    						                 'award_no'           =>$resultArray['award_no'],
    										 'annexure_type'      =>$crn,
    										 'account_number'     =>$resultArray['account_number'],
    										 'sector_no'          => $resultArray['sector_no'],
    										 'award_date'         => $resultArray['award_date'],
    										 'ADJ_court_order_no' => $resultArray['ADJ_court_order_no']
    										 );
					}else if($getAnxVal == 3){
    					$hashArray   = array(
    						                 'is_EDC'             =>$is_EDC,
    						                 'award_no'           =>$resultArray['award_no'],
    										 'annexure_type'      =>$crn,
    										 'account_number'     =>$resultArray['account_number'],
    										 'sector_no'          => $resultArray['sector_no'],
    										 'award_date'         => $resultArray['award_date'],
    										 'ADJ_court_order_no' => $resultArray['ADJ_court_order_no'],
    										 'high_court_order_no'=> $resultArray['high_court_order_no']
    										 );
					}else if($getAnxVal == 4){
    					$hashArray   = array(
    						                 'is_EDC'             =>$is_EDC,
    						                 'award_no'           =>$resultArray['award_no'],
    										 'annexure_type'      =>$crn,
    										 'account_number'     =>$resultArray['account_number'],
    										 'sector_no'          => $resultArray['sector_no'],
    										 'award_date'         => $resultArray['award_date'],
    										 'ADJ_court_order_no' => $resultArray['ADJ_court_order_no'],
    										 'high_court_order_no'=> $resultArray['high_court_order_no'],
    										 'supreme_court_order_no'=> $resultArray['supreme_court_order_no']
    										 );
					}else if($getAnxVal == 5){
    					$hashArray   = array(
    						                 'is_EDC'             =>$is_EDC,
    						                 'award_no'           =>$resultArray['award_no'],
    						                 'gross_amount_to_paid'     =>$resultArray['gross_amount_to_paid'],
    						                 'beneficiary_name' => $resultArray['beneficiary_name'],
    										 'annexure_type'      =>$crn,
    										 'account_number'     =>$resultArray['account_number'],
    										 'award_date'         => $resultArray['award_date'],
    										 'TDS_deducted'         => $resultArray['TDS_deducted'],
    										 'ADJ_court_order_no' => $resultArray['ADJ_court_order_no'],
    										 'ADJ_court_decision_date'=> $resultArray['ADJ_court_decision_date'],
    										 'high_court_order_no'=> $resultArray['high_court_order_no'],
    										 'high_court_decision_date'=> $resultArray['high_court_decision_date'],
    										 'supreme_court_order_no'=> $resultArray['supreme_court_order_no'],
    										 'supreme_court_decision_date'=> $resultArray['supreme_court_decision_date']
    										 );
					}else if($getAnxVal == 6){
    					$hashArray   = array(
    						                 'is_EDC'             =>$is_EDC,
    						                 'award_no'           =>$resultArray['award_no'],
    										 'annexure_type'      =>$crn,
    										 'gross_amount_to_paid'     =>$resultArray['gross_amount_to_paid'],
    										 'award_date'         => $resultArray['award_date'],
    										 'beneficiary_name' => $resultArray['beneficiary_name']
    										 );
    					$resultArray['net_amount']	 = 	$resultArray['gross_amount_to_paid'];			 
					}else if($getAnxVal == 7){
    					$hashArray   = array(
    						                 'is_EDC'             =>$is_EDC,
    						                 'award_no'           =>$resultArray['award_no'],
    										 'annexure_type'      =>$crn,
    										 'gross_amount_to_paid'     =>$resultArray['gross_amount_to_paid'],
    										 'award_date'              => $resultArray['award_date'],
    										 'beneficiary_name'      => $resultArray['beneficiary_name'],
    										 'TDS_deducted'         => $resultArray['TDS_deducted'],
    										 'ADJ_court_order_no' => $resultArray['ADJ_court_order_no'],
    										 'ADJ_court_decision_date'=> $resultArray['ADJ_court_decision_date']
    										 
    										 );
					}else if($getAnxVal == 8){
    					$hashArray   = array(
    						                 'is_EDC'             =>$is_EDC,
    						                 'award_no'           =>$resultArray['award_no'],
    						                 'gross_amount_to_paid'     =>$resultArray['gross_amount_to_paid'],
    										 'annexure_type'      =>$crn,
    										 'account_number'     =>$resultArray['account_number'],
    										 'sector_no'          => $resultArray['sector_no'],
    										 'award_date'         => $resultArray['award_date'],
    										 'beneficiary_name'      => $resultArray['beneficiary_name'],
    										 'TDS_deducted'         => $resultArray['TDS_deducted'],
    										 'ADJ_court_order_no' => $resultArray['ADJ_court_order_no'],
    										 'ADJ_court_decision_date'=> $resultArray['ADJ_court_decision_date'],
    										 'high_court_order_no'=> $resultArray['high_court_order_no'],
    										 'high_court_decision_date'=> $resultArray['high_court_decision_date']
    										 );
					}
					//echo "<pre>==$getAnxVal==<hr>";  print_r($hashArray);
					 $hashKey     = createHash($hashArray);
					
					$customer_ref_number = $crn.strtoupper(substr($hashKey,0,11));
					//$crn         = $crn.$is_EDC;
					$resultArray['annexure_type']                = $getAnxVal;
					$resultArray['reference_number']             = $ref_num;
					$resultArray['file_name']                    = $import_xls_file;
					$resultArray['customer_reference_number']    = $customer_ref_number;
					$resultArray['reference_number']             = $ref_num;
					$resultArray['created_on']                   = $created_on;
					$resultArray['check_sum']                    = $hashKey;
					$resultArray['zone_id']                      = $zone_id;
					$resultArray['is_EDC']                       = $is_EDC;
					
					//echo "<pre>====<hr>";  print_r($resultArray);
					
					if($session_data['role_id'] ==3){
						$resultArray['maker_id']                 = $session_data['id'];
						$resultArray['maker_name']               = $session_data['name'];
					}else{
						$resultArray['LAO_id']                   = $session_data['id'];
						$resultArray['LOA_name']                 = $session_data['name'];
					}
					
					if($resultArray['sector_no']){
					    //unlink($target_file);
						$resultErrorArray = $this->validateOriginalAnnexure($resultArray,$defined_annexure_col_array,$loa_account_number,$hashKey,$c,$hashKeyArray);
						//echo "<pre>$hashKey";print_r($hashKeyArray); 
						if(!in_array($hashKey,$hashKeyArray)){
						    $hashKeyArray[]=$hashKey;
    					}else{
    						    $resultErrorArray[$c] = 'Duplicate record found at serial no. '.$c;
    					}
						$hashKeyArray[]=$hashKey;
						
						if(!empty($resultErrorArray)){
							$errorArray[$c] =$resultErrorArray;
						}
						if(empty($errorArray)){
							$resultArray['is_success'] = 1;
						}
						$importArray[]     = $resultArray;
						
						
						//$this->import_model->importAnnexure($resultArray);
					}
					
				}
				sleep(.5);
				$c++;
			}
			//unlink($target_file); 
			//echo "<pre>====<hr>";  print_r($errorArray); echo "<hr/>";print_r($importArray); exit;
			
			//echo "<pre>error";print_r($errorArray); echo "<hr/>";print_r($resultArray); exit;
			if(!empty($errorArray)){
				unlink($target_file); 
				$messge = array('message' => $errorArray,'class' => 'showError alert-success fade in');
		        $this->session->set_flashdata('anrError', $messge); 
		        redirect(base_url().'uploadSheet/UploadSheet');
			}else{
				//exit;
				$fileDetailArray   = array(
					                         'zone_id'           =>$zone_id,
											 'file_name'         =>$import_xls_file,
											 'total_record'      =>count($allDataInSheet),
											 'updated_record'    =>$c-count($errorArray),
											 'reference_number'  =>$ref_num,
											 'is_error'          =>empty($errorArray) ? 1 :0,
											 );
				$this->import_model->addFileDetails($fileDetailArray);
				$this->import_model->importData($importArray);
				//exit;
			   //echo "<pre>=allDataInSheet====allDataInSheet=";print_r($errorArray); echo "<pre><hr/>"; 
			   /// }
			   $messge = array('message' => ANNEXURE_UPLOADED_MESSAGE,'class' => 'alert alert-success fade in');
			   $this->session->set_flashdata('item', $messge); 
			   redirect(base_url().'mandatesList/MandatesList');
			}
			
			
           
        }
        //$this->load->view('import/display', $data);
        
    }
	
	public function validateOriginalAnnexure($resultarray,$fileArray,$loa_account_number,$hashKey,$c,$hashKeyArray){
		$errorMessage =array();
		
	//	echo "<pre>===validateOriginalAnnexure====";print_r($resultarray); print_r($fileArray); ; echo "<hr/>"; exit;
		//$resultarray['mobile_number'];
		unset($resultarray['beneficiary_PAN']);
		// for DD 
		unset($resultarray['beneficiary_add_line2']);
		unset($resultarray['beneficiary_add_line3']);
		unset($resultarray['beneficiary_add_line4']);
		unset($resultarray['advising_detail1']);
		unset($resultarray['advising_detail2']);
		unset($resultarray['advising_detail3']);
		unset($resultarray['advising_detail4']);
		unset($resultarray['advising_detail5']);
		unset($resultarray['advising_detail6']);
		unset($resultarray['bene_email_id']);
		unset($resultarray['value_date']);
		unset($resultarray['MICR_no']);
		unset($resultarray['instrument_ref_no']);
		unset($resultarray['cheque_no']);
		$missing[$resultarray['serial_no']] = array();
		$errorArray =array();
		$line_no = $resultarray['serial_no']+1;
		$line_no = " row no. ".$line_no;
		//Check dublicate record with hash key
		$checkDublicate =$this->findDublicateRecord($hashKey);
		if(!empty($checkDublicate)){
			   $errorArray[] = 'Duplicate record found at serial no. '.$line_no;
		}
		// Validate amount  ################################
		if(isset($resultarray['net_amount'])){
		    if (!is_numeric($resultarray['net_amount']) OR $resultarray['net_amount']< 0)  {
			 $errorArray[] =$fileArray['net_amount'].' must be in numeric '.$line_no;
		}
		}
		
		if (!is_numeric($resultarray['gross_amount_to_paid']) OR $resultarray['gross_amount_to_paid']< 0)  {
			 $errorArray[] =$fileArray['gross_amount_to_paid'].' must be in numeric '.$line_no;
		}

           $searchForValue = ',';
           	
		// Validate Acre  ################################
		if(isset($resultarray['acre'])){
			//print_r($resultarray['acre']);
            //print_r(strlen($resultarray['acre']));exit;
		    if (!is_numeric($resultarray['acre']))  {
			 $errorArray[] =$fileArray['acre'].' must be in numeric '.$line_no;
			}
			if (strlen($resultarray['acre']) >7)  {
			    $errorArray[] =$fileArray['acre'].' max length should be 7 digits '.$line_no;
		    }
		    if( strpos($resultarray['acre'], $searchForValue) !== false ) {
			     $errorArray[] =$fileArray['acre'].' should not contain comma '.$line_no;
		    }
		    
		
		}
		// Validate Kanal  ################################
		if(isset($resultarray['kanal'])){
		    if (!is_numeric($resultarray['kanal']))  {
			 $errorArray[] =$fileArray['kanal'].' must be in numeric '.$line_no;
			}

		    if (strlen($resultarray['kanal']) >7)  {
			    $errorArray[] =$fileArray['kanal'].' max length should be 7 digits '.$line_no;
		    }
		    if( strpos($resultarray['kanal'], $searchForValue) !== false ) {
			     $errorArray[] =$fileArray['kanal'].' should not contain comma '.$line_no;
		    }
		
		}
		// Validate Marla  ################################
		if(isset($resultarray['marla'])){
		    if (!is_numeric($resultarray['marla']))  {
			 $errorArray[] =$fileArray['marla'].' must be in numeric '.$line_no;
			}
		    if (strlen($resultarray['marla']) >7)  {
			    $errorArray[] =$fileArray['marla'].' max length should be 7 digits '.$line_no;
		    }
		    if( strpos($resultarray['marla'], $searchForValue) !== false ) {
			     $errorArray[] =$fileArray['marla'].' should not contain comma '.$line_no;
			}   
		
		}
		// Validate Khewat No  ################################
		if(isset($resultarray['khewat_no'])){
			//print_r(strlen($resultarray['khewat_no']));exit;
		   if (strlen($resultarray['khewat_no']) > 20)  {
			    $errorArray[] =$fileArray['khewat_no'].' max length should be 20 digits '.$line_no;
		     }
		   if( strpos($resultarray['khewat_no'], $searchForValue) !== false ) {
			     $errorArray[] =$fileArray['khewat_no'].' should not contain comma '.$line_no;
		  }  
		}
		// Validate Share in the Ownership  ################################
		if(isset($resultarray['share_in_ownership'])){
		    if (strlen($resultarray['share_in_ownership']) > 20)  {
		   	   //print_r(strlen($resultarray['share_in_ownership']));exit;
			    $errorArray[] =$fileArray['share_in_ownership'].' max length should be 20 digits '.$line_no;
			  
		    }
		    if (!preg_match('/^[a-zA-Z\d\/]+$/', $resultarray['share_in_ownership']))  {
		   	   //print_r(strlen($resultarray['share_in_ownership']));exit;
			    $errorArray[] =$fileArray['share_in_ownership'].' accepts only alphanumeric characters or / '.$line_no;
		     }
		    if( strpos($resultarray['share_in_ownership'], $searchForValue) !== false ) {
			     $errorArray[] =$fileArray['share_in_ownership'].' should not contain comma '.$line_no;
		    }  
		}
		// Validate Aadhar No  ################################
	/*	if(isset($resultarray['aadhar_no']) || !empty($resultarray['aadhar_no'])){
			//print_r(strlen($resultarray['aadhar_no']));exit;
		    if (!is_numeric($resultarray['aadhar_no']))  {
			 $errorArray[] =$fileArray['aadhar_no'].' must be in numeric '.$line_no;
			 if (strlen($resultarray['aadhar_no']) < 13)  {
			    $errorArray[] =$fileArray['aadhar_no'].' max length should be 12 digits '.$line_no;
		     }
		}
		
		}*/
		//#########################################################################
		
		//Validate mobile number 
		
		if  ($resultarray['mobile_number']  !=NULL )  {
			 if (strlen($resultarray['mobile_number']) !=10)  {
			    $errorArray[] =$fileArray['mobile_number'].' must be of 10 digit '.$line_no;
		     }
		}
		
		
		
		// Validate IFSC code
		/*if (!preg_match('/^[A-Za-z]{4}\d{7}$/', $resultarray['ifsc_code'])) {
			$errorArray[] =$fileArray['ifsc_code'].' is not valid.';
		}*/
		if(($resultarray['ifsc_code'] != '' or $resultarray['ifsc_code'] != NULL) && strlen($resultarray['ifsc_code']) !=  11){
		    $errorArray[] =$fileArray['ifsc_code'].' is not valid '.$line_no;
		}
		
		
		if(isset($resultarray['supreme_court_order_no']) && preg_match("/[a-z]/i", $resultarray['supreme_court_order_no'])==1){
			$errorArray[] =$fileArray['supreme_court_order_no']." contains alphabet at ".$line_no;   
		}
		//$fileArray['LAO_bank_account_no'].' from which payment is to be made does not match with LAO account number at serial no '.$line_no;
		if($resultarray['LAO_bank_account_no'] !=''){
			//echo "<pre>===hello====";
					if(!in_array($resultarray['LAO_bank_account_no'] ,$loa_account_number)){
						$errorArray[] =$fileArray['LAO_bank_account_no'].' from which payment is to be made does not match with LAO account number at serial no '.$line_no;
					}
		}
		if(isset($resultarray['net_amount'])){
    		if($resultarray['net_amount'] !='' && $resultarray['gross_amount_to_paid'] !='' && $resultarray['TDS_deducted'] !='' ){
    		   
    		    $netAmount =  $resultarray['gross_amount_to_paid'] - $resultarray['TDS_deducted'];
    		    //echo round($resultarray['net_amount'],2)."=====".round($netAmount,2); echo "<pre>===if====";print_r($resultarray); 
    			if(round($resultarray['net_amount'],2)  !=round($netAmount,2)){
    			    // echo "Not Matched";
    			    $errorArray[] =$fileArray['net_amount'].' is incorrect';
    			}else{
    			   // echo "Matched";
    			}
    			
    		}
		}
		//echo "<hr/>";
		unset($resultarray['mobile_number']);
		foreach ($resultarray as $key => $value) {
			if ($value == "") {
				
				$errorArray[] =$fileArray[$key].' is blank'; 
				array_push($missing, $key);
			  
			}
		}
		//echo "<pre>missing";print_r($errorArray);  echo "<hr/>";
		return $errorArray;
		//echo "<pre>missing";print_r($errorArray); print_r($missing); echo "<hr/>";
		
	}
	
	public function validateSupremeAnnexure($array,$fileArray,$loa_account_number){
		$errorMessage =array();
		//echo "<pre>error";print_r($array); echo "<hr/>";
		$line_no =$array['serial_no'];
		switch(true)
		{
			case ($array['serial_no'] == ''):
			  $errorMessage['serial_no'] = $fileArray['serial_no']." can not be blank"; 
			case ($array['sector_no'] == ''):
			  $errorMessage['sector_no'] = $fileArray['sector_no'].' is blank'; 
			case ($array['villlage_name'] == ''):
			  $errorMessage['villlage_name'] = $fileArray['sector_no']." is blank"; 
			case ($array['LAO_bank_account_no'] == ''):
			  $errorMessage['LAO_bank_account_no'] = $fileArray['LAO_bank_account_no']. " is blank"; 
			  
			case ($array['LAO_bank_account_no'] != $loa_account_number):
			  $errorMessage['LAO_bank_account_no'] = $fileArray['LAO_bank_account_no']. " not matched with LOA account number at line no. ".$line_no; 
			  
			case ($array['award_no'] == ''):
			  $errorMessage['award_no'] = $fileArray['award_no']." is blank at line no. ".$line_no; 
			case ($array['award_date'] == ''):
			  $errorMessage['award_date'] = $fileArray['award_date']." is blank at line no. ".$line_no; 
			case ($array['ADJ_court_order_no'] == ''):
			  $errorMessage['ADJ_court_order_no'] = $fileArray['ADJ_court_order_no']." is blank at line no. ".$line_no; 
			case ($array['ADJ_court_decision_date'] == ''):
			  $errorMessage['ADJ_court_decision_date'] = $fileArray['ADJ_court_decision_date']." is blank at line no. ".$line_no; 
			case ($array['high_court_order_no'] == ''):
			  $errorMessage['high_court_order_no'] = $fileArray['high_court_order_no']." is blank at line no. ".$line_no; 
			case (preg_match("/[a-z]/i", $array['high_court_order_no'])==1):
			  $errorMessage['high_court_order_no'] = $fileArray['high_court_order_no']." contains alphabet at . ".$line_no;   
			
			case ($array['high_court_decision_date'] == ''):
			  $errorMessage['high_court_decision_date'] = $fileArray['high_court_decision_date']." is blank at line no. ".$line_no; 
			case ($array['supreme_court_order_no'] == ''):
			  $errorMessage['supreme_court_order_no'] = $fileArray['supreme_court_order_no']." is blank at line no. ".$line_no; 
			  
			case (preg_match("/[a-z]/i", $array['supreme_court_order_no'])==1):
			  $errorMessage['supreme_court_order_no'] = $fileArray['supreme_court_order_no']." contains alphabet at . ".$line_no;   
            case ($array['supreme_court_decision_date'] == ''):
			  $errorMessage['supreme_court_decision_date'] = $fileArray['supreme_court_decision_date']." is blank at line no. ".$line_no; 

   			case ($array['beneficiary_name'] == ''):
			  $errorMessage['beneficiary_name'] = $fileArray['beneficiary_name']." is blank at line no. ".$line_no; 
			case ($array['gross_amount_to_paid'] == ''):
			  $errorMessage['gross_amount_to_paid'] = $fileArray['gross_amount_to_paid'].' is blank at line no. '.$line_no; 
			case ($array['TDS_deducted'] == ''):
			  $errorMessage['TDS_deducted'] = $fileArray['TDS_deducted']." is blank at line no. ".$line_no; 
			case ($array['net_amount'] == ''):
			  $errorMessage['net_amount'] = $fileArray['net_amount']." is blank at line no. ".$line_no; 
			case ($array['ifsc_code'] == ''):
			  $errorMessage['ifsc_code'] = $fileArray['ifsc_code']." is blank at line no. ".$line_no; 
			case ($array['ifsc_code'] != '' && strlen($array['ifsc_code']) !=  11):
			  $errorMessage['ifsc_code'] = $fileArray['ifsc_code']." is not valid. ".$line_no;   
			case ($array['account_number'] == ''):
			  $errorMessage['account_number'] = $fileArray['account_number'].' is blank at line no. '.$line_no; 
			case ($array['is_EDC'] == ''):
			  $errorMessage['is_EDC'] = $fileArray['is_EDC']." is blank at line no. ".$line_no; 
			case ($array['customer_reference_number'] == ''):
			  $errorMessage['customer_reference_number'] = $fileArray['customer_reference_number']." is blank at line no. ".$line_no; 
			case ($array['net_amount'] != ($array['gross_amount_to_paid'] - $array['TDS_deducted'])):
			  $errorMessage['net_amount'] = $fileArray['net_amount']." is incorrect. ";    
			
		}
		return $errorMessage;
		
	}
	
	public function findDublicateRecord($checkSum){
	
	        $sql ="SELECT a.serial_no FROM annexure_temp a WHERE a.check_sum='$checkSum' and a.annexure_status not in (4,5)";
                $sqlquery   = $this->db->query($sql);
    		return $result        = $sqlquery->result_array();
	
	}

}

?>
