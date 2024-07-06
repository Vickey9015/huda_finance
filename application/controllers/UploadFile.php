<?php
//error_reporting(E_ALL);

ini_set('memory_limit','1024M');
ini_set('max_execution_time', '0');
class UploadFile extends CI_Controller {

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
		$this->load->model('fileupload_model');
		$this->load->helper('common_helper');
		$this->load->library('Classes/PHPExcel');
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
public function fileUpload(){
        try{

             //echo'<pre>'; print_r($_FILES); exit();
          if(empty($_FILES["userfile"]["tmp_name"])){
                $errorArray = "Please select a file";
                $messge = array('message' => $errorArray,'statusCode' => 'NP001');
                echo json_encode($messge,200); exit();
            }

            $errordata=array();
 
        $session_data = $this->session->all_userdata();
        $loa_account_number = explode(',',$session_data['account_number']);
       //echo'<pre>'; print_r($loa_account_number); exit();
        $zone_id      =$session_data['zones'][0]['id'];
        $user_id      =$session_data['id'];
        $folder = "XlSXFiles";
        $c_folder = 'upload/'.$folder;
        $ref_num = 'NP'.rand(100000000,999999999);
 
 
        $config['upload_path'] = 'upload/'. $folder.'/';
        // echo'<pre>'; print_r($config['upload_path']); exit();
 
        $config['allowed_types']    = 'xlsx';
        $config['remove_spaces']    = TRUE;
        // $x= $this->upload->initialize($config);
        // echo'<pre>'; print_r($x); exit();
        $this->load->library('upload', $config);
        $file  = $_FILES["userfile"]["name"];
        $ExcelFileType = strtolower(pathinfo($file,PATHINFO_EXTENSION));
        if($ExcelFileType !='xlsx'){
            
             $errorArray = "Please Upload xlsx file only";
             $messge = array('message' => $errorArray,'statusCode' => 'NP001');
                echo json_encode($messge,200); exit();
            }
            $target_file = $config['upload_path'].''.$file;
            $target_file =trim($target_file,'.');
            // echo $target_file; die();
            $file = $_FILES["userfile"]["tmp_name"];
            $objPHPExcel = new PHPExcel();
            $objPHPExcel = PHPExcel_IOFactory::load($file);
            // foreach($objPHPExcel->getWorksheetIterator() as $iterator){
            //     $totalRows = $iterator->getHighestRow();
            // }
            $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
            $maxCell = $objWorksheet->getHighestRowAndColumn();
            $allDataInSheet = $objWorksheet->rangeToArray('A1:' . $maxCell['column'] . $maxCell['row']);
            $data = array_map('array_filter', $allDataInSheet);
            $data = array_filter($data);

            $totalRows   = count($data);
           // echo "<hr/>======<pre>";print_r($allDataInSheet);exit;
           //echo "<pre>="; print_r($totalRows);
            //echo "<pre>="; print_r($data);die();

        if (file_exists($target_file)){
                $msg ="exist";
            }else{
                $msg= "file_not_found";
            }
            if($msg =='exist'){
               // $error = array("error" => "File already exists.");
                $errorArray = "File already exists with same name.";
                $messge = array('message' => $errorArray,'statusCode' => 'NP001');
                echo json_encode($messge,200); exit();
            }
            if(isset($_FILES['userfile'])){
                    if ($_FILES["userfile"]["error"] == 0){
                            $file = $_FILES["userfile"]["name"];
                            $path = $config['upload_path']."".$file;
                            move_uploaded_file($_FILES["userfile"]["tmp_name"], $path);
                            $ann_file = $file;
                            $error = array('error' => $_FILES["userfile"]["error"]);
                    }
            }
            $import_xls_file = $ann_file;
            $file = $config['upload_path'] . $import_xls_file;
          
 
            $fileArray      = $allDataInSheet[0];
            $fileArray      =array_filter($fileArray);
            //echo "<pre>="; print_r($fileArray);die();
            $annexure                   =    unserialize(UNCLAIMEDANNEXURE);
            // Check for column inter-change 
            
            $file_array_values    = array_values($fileArray);
            $file_trimmed_array   = array_map('trim',$file_array_values);
            $defined_array_values = array_values($annexure);
            $result_intersect     = array_diff_assoc($file_trimmed_array, $defined_array_values);
            //echo "<pre>======";print_r($annexure);exit;
            //unlink($target_file);
        //echo "<pre>======";print_r($file_array_values);echo "<hr/>"; print_r($defined_array_values);echo "<hr/>"; print_r($result_intersect);echo "<pre><hr/>"; exit;
            //echo "<hr/>";
            //die;
            if(!empty($result_intersect)){
                unlink($target_file); 
                $errorArray = 'File header is not matched.';
                 $messge = array('message' => $errorArray,'statusCode' => 'NP001');
                echo json_encode($messge,200); exit();
            }
            $checkdup=array();
            $checkdup1=array();
            
            foreach ($fileArray as $key => $value) {
                
                if (array_search(trim($value), $defined_array_values,true)) {
                    //echo $value.'<hr/>';
                    $valKey =array_search(trim($value), $defined_array_values,true);
                    //$value = preg_replace('/\s+/', '', $value);
                    $SheetDataKey[trim($valKey,'.')] = $key;
                    //echo "<hr/>";print_r($SheetDataKey);
                } else {
                    //echo 'not found=='.$value;
                }
            }
            //echo "<hr/>======<pre>";print_r($SheetDataKey); 
            $totalColumns=(count($fileArray));
            $c = 0;
            $amount=0;
            //echo "<hr/>====<pre>";print_r(array_keys($defined_array_values));exit;
            foreach($data as $key=>$value){
            //echo "<hr/>======<pre>";print_r($value);exit;
                
                // if($c>0){
                //  $value       = array_slice($value, 0, $totalColumns);
                //     //echo "<pre>===";print_r($value); die();

                //  $resultArray = array_combine(array_keys($SheetDataKey), array_values($value));
                //  //$is_EDC      = trim($resultArray['is_EDC']) =='E' ? 'E':'N';
                // }
                if($c>0){
                $annexure = array(
                    
                    's_no'                    => trim($value[0]),
                    'zone_name'                    => trim($value[1]),
                    'sector_no'                => trim($value[2]),
                    'name_of_village'           => trim($value[3]),
                    'date_of_four_section'            => trim($value[4]),
                    'date_of_six_sectiom'                     => trim($value[5]),
                    'award_no'                   => trim($value[6]),
                    'award_date'          => trim($value[7]),
                    'khewat_no'             => trim($value[8]) !=0 ? trim($value[8]) :'0',
                    'acquired_area'                =>trim($value[9]) !=0 ? trim($value[9]) :'0',
                    'acre'                         =>trim($value[10]) !=0 ? trim($value[10]) :'0',
                    'kanal'                        =>trim($value[11]) !=0 ? trim($value[11]) :'0',
                    'marla'                        =>trim($value[12]) !=0 ? trim($value[12]) :'0',
                    'bank_ac_lao'              => trim($value[13]),
                    'name_of_bene'         => trim($value[14]),
                    'care_of'                 => trim($value[15]),
                    'net_amount'                   => trim($value[16]),
                    'is_edc'                    => trim($value[17]),
                    'customer_ref_numer'               => trim($value[18]),
                    'file_ref_number'               => $ref_num,
                    'file_name'         =>$import_xls_file,
                    'zone_id'         =>$zone_id
              
                    );

                     $amount= $amount+$value[16];
                     $annexure['status_desc'] ='';
                     $annexure['is_duplicate'] =1;
                     $annexure['is_error'] =1;
                    if(in_array(trim($value[18]) ,$checkdup1)){
                        $annexure['is_duplicate'] =2;
                        $annexure['is_error'] =2;
                        $annexure['status_desc'] ='Duplicate Customer Ref Number';
                       // $checkdup[]=trim($value[18]);
                        
                       
                    }else{
                        
                        $checkdup1[]=trim($value[18]);
                    }
                    if((strpos($value[0], "\n") !== FALSE) || (strpos($value[1], "\n") !== FALSE) || (strpos($value[2], "\n") !== FALSE)|| (strpos($value[3], "\n") !== FALSE)|| (strpos($value[4], "\n") !== FALSE)|| (strpos($value[5], "\n") !== FALSE)|| (strpos($value[6], "\n") !== FALSE)|| (strpos($value[7], "\n") !== FALSE)|| (strpos($value[8], "\n") !== FALSE)|| (strpos($value[9], "\n") !== FALSE)|| (strpos($value[10], "\n") !== FALSE)|| (strpos($value[11], "\n") !== FALSE)|| (strpos($value[12], "\n") !== FALSE)|| (strpos($value[13], "\n") !== FALSE)|| (strpos($value[14], "\n") !== FALSE)|| (strpos($value[15], "\n") !== FALSE) || (strpos($value[16], "\n") !== FALSE) || (strpos($value[17], "\n") !== FALSE) || (strpos($value[18], "\n") !== FALSE)) {
                        $annexure['status_desc'] ='Found New Line in the field';
                       //$annexure['is_duplicate'] =1;
                        $annexure['is_error'] =2;
                    }if(!in_array(trim($value[13]) ,$loa_account_number)){
                        $annexure['status_desc'] ='LAO account number does not match';
                      // $annexure['is_duplicate'] =1;
                        $annexure['is_error'] =2;
                       
                       
                    }
                    
                   

                    //  $errordata=$this->validateLAOAC($value,$loa_account_number);
                    //  //echo "<hr/>===<pre>";print_r($errordata['status_desc']); exit;
                    //  if(!empty($errordata)){
                    //           $annexure['status_desc'] =$errordata['status_desc'];
                    //           $annexure['is_error'] =2;
                    //   }else{
                    //           $annexure['status_desc'] ='';
                    //           $annexure['is_error'] =1;
                    //   }
                   
                    $resultArray[] = $annexure;
                }
                $c++;
            }
            
           //echo "<hr/>===<pre>";print_r($resultArray); exit;
            $totalrow=$totalRows-1;
            $c=$c-1;

            if ($c == $totalrow) {
                
                 $fileDetailArray   = array(
                    'zone_id'           =>$zone_id,
                    'user_id'           =>$user_id,
                    'file_name'         =>$import_xls_file,
                    'total_record'      =>$totalRows-1,
                    'total_amount'      =>$amount,
                    //'updated_record'    =>$c-count($errorArray),
                    'reference_number'  =>$ref_num,
                    'is_read'           =>2,
                    //'is_error'          =>empty($errorArray) ? 1 :0,
                    );
                    $insertid=$this->fileupload_model->addFileDetails($fileDetailArray);


                    $this->fileupload_model->importData($resultArray);
                    
                    $this->updateduplicate($ref_num);

                    $errorArray = "File is Uploaded Successfully";
                    $messge = array('message' => $errorArray,'statusCode' => 'NP000');
            }else{
                unlink($target_file);
               // echo "<hr/>=$c==<pre>";print_r($totalrow); exit;
                $errorArray = "File is not Uploaded";
                $messge = array('message' => $errorArray,'statusCode' => 'NP001');

            }
           
                echo json_encode($messge,200); exit();
 
                }catch(Exception $e){
                echo $e->getMessage();
                 unlink($target_file); 
                //$error = array('status' => 0, "msg" => "Internal Server Error - Please try Later.","StatusCode"=> "NP041");
           $errorArray = "Internal Server Error - Please try Later";
           $messge = array('message' => $errorArray,'statusCode' => 'NP001');
                echo json_encode($messge,200); exit();
        }
     }

     public function validateLAOAC($value,$loa_account_number){
             $errorArray =array();
    
             if($value !=''){
                    //echo "<pre>===hello====";print_r($value);exit;
                    
                    if((strpos($value[0], "\n") !== FALSE) || (strpos($value[1], "\n") !== FALSE) || (strpos($value[2], "\n") !== FALSE)|| (strpos($value[3], "\n") !== FALSE)|| (strpos($value[4], "\n") !== FALSE)|| (strpos($value[5], "\n") !== FALSE)|| (strpos($value[6], "\n") !== FALSE)|| (strpos($value[7], "\n") !== FALSE)|| (strpos($value[8], "\n") !== FALSE)|| (strpos($value[9], "\n") !== FALSE)|| (strpos($value[10], "\n") !== FALSE)|| (strpos($value[11], "\n") !== FALSE)|| (strpos($value[12], "\n") !== FALSE)|| (strpos($value[13], "\n") !== FALSE)|| (strpos($value[14], "\n") !== FALSE)|| (strpos($value[15], "\n") !== FALSE) || (strpos($value[16], "\n") !== FALSE) || (strpos($value[17], "\n") !== FALSE) || (strpos($value[18], "\n") !== FALSE)) {
                        $errorArray['status_desc'] ='Found New Line in the field';
                    }
                    if(!in_array($value[13] ,$loa_account_number)){
                        $errorArray['status_desc'] ='LAO account number does not match with  at serial no ';
                       
                    }
                    
                }
           
            return $errorArray;
    
    }

	
	
	public function findDublicateRecord($checkSum){
	
	        $sql ="SELECT a.serial_no FROM annexure_temp a WHERE a.check_sum='$checkSum' and a.annexure_status not in (4,5)";
                $sqlquery   = $this->db->query($sql);
    		return $result        = $sqlquery->result_array();
	
	}
    
	public function updateduplicate($file_ref){
	
        $query ="SELECT GROUP_CONCAT(tmp.crn_id SEPARATOR ',') AS ids FROM (
            SELECT  customer_ref_numer,MAX(id) AS crn_id FROM unclaimed_temp WHERE customer_ref_numer !='' GROUP BY customer_ref_numer  HAVING COUNT(id)>1
            ) AS tmp" ;
        
                    $sql = $this->db->query($query);
                    $resultIds = $sql->result_array();
                   // echo "<pre>==="; print_r($resultIds[0]['ids']);
                    if($resultIds[0]['ids']){
                        $resultIds=$resultIds[0]['ids'];
                        $data =array ('is_duplicate' => 2,'is_error'=>2,'status_desc'=>'Duplicate Customer Ref Number');
                        $where ="id IN($resultIds)";
                        $this->db->where($where);
                        $this->db->update('unclaimed_temp', $data);
                        $afftectedRows = $this->db->affected_rows();
                        //echo "<pre>==="; print_r($afftectedRows);exit;

                       // echo $this->db->last_query();
                    //    $data = [
							
                    //     'is_error' => 2
                    //     ];
                    //     $this->db->where('reference_number', $file_ref);
                    //     $this->db->update('unclaimed_file_status', $data);
                       // return true;
                    }

                   
			      
                    return true;
	
	}

}

?>
