<?php
include './phpseclib/Net/SFTP.php';
class Unclaimedcron_model extends CI_Model {
    public $error       = array();
    public $error_count = 0;
    public $user_type    = 0;
    
    public function __construct() 
    {
        parent::__construct();
		
    }

    function getFileToCheckDuplicate(){
      
		$query ="SELECT * FROM unclaimed_file_status where is_read=3 limit 1";
		$sql = $this->db->query($query);
		//echo $this->db->last_query();exit;
		return $results = $sql->result_array();
	
		
		//echo "<pre>===="; print_r($results); exit;
   }



    function updateEmpty($id){

    	

    	 $query ="UPDATE unclaimed_temp
					SET is_error = 2 , is_empty=2 ,status_desc='Field is empty'
					WHERE (s_no = '' OR zone_name = ' ' OR sector_no = ' ' OR name_of_village = ' ' OR date_of_four_section = ' ' OR date_of_six_sectiom = ' ' OR award_no = ' ' OR award_date = ' ' OR khewat_no = ' ' OR acquired_area = ' ' OR acre = ' ' OR kanal = ' ' OR marla = ' ' OR bank_ac_lao = ' ' OR name_of_bene = ' ' OR care_of = ' ' OR net_amount = ' ' OR is_edc = ' ' OR customer_ref_numer = ' ' OR s_no IS NULL OR zone_name IS NULL OR sector_no IS NULL OR name_of_village IS NULL OR date_of_four_section IS NULL OR date_of_six_sectiom IS NULL OR award_no IS NULL OR award_date IS NULL OR khewat_no IS NULL OR acquired_area IS NULL OR acre IS NULL OR kanal IS NULL OR marla IS NULL OR bank_ac_lao IS NULL OR name_of_bene IS NULL OR care_of IS NULL OR net_amount IS NULL OR is_edc IS NULL OR customer_ref_numer IS NULL)";
        
			        $sql = $this->db->query($query);
					
			        //echo $this->db->last_query();
					$ressuccess=$this->updatefilstatus($id);
						if (!empty($ressuccess)) {
	
							 $isfilestatus=2;
						}else{
							 $isfilestatus=3;
							
						}
						$data = [
							
							'is_error' => $isfilestatus,
							'is_submit_to_lao' => $isfilestatus
						];
						$this->db->where_not_in('is_error', [2]);
						$this->db->where('file_ref_number', $id);
						$this->db->update('unclaimed_temp', $data);
						$data = [
							'is_read' => 3,
							'is_error' => $isfilestatus,
						];
						//$this->db->where_not_in('is_error', [2]);
						$this->db->where('is_read', 2);
						$this->db->where('reference_number', $id);
						$this->db->update('unclaimed_file_status', $data);
						//echo $this->db->last_query();exit;
			      
                    return true;
                   //echo "<pre>-=";print_r($results);
    }

	function updateDuplicate($file_ref,$id){

    	$data = [
            'is_read' => 4,
        ];
        $this->db->where('is_read', 3);
        $this->db->where('reference_number', $file_ref);
        $this->db->where('id', $id);
        $this->db->update('unclaimed_file_status', $data);

    

    	 $query ="SELECT GROUP_CONCAT(tmp.crn_id SEPARATOR ',') AS ids FROM (
			SELECT  customer_ref_numer,MAX(id) AS crn_id FROM unclaimed_temp WHERE customer_ref_numer !='' GROUP BY customer_ref_numer  HAVING COUNT(id)>1
			) AS tmp" ;
        
			        $sql = $this->db->query($query);
					$resultIds = $sql->result_array();
             //echo "<pre>==="; print_r($resultIds[0]['ids']); die();
					if($resultIds[0]['ids']){
						$resultIds=$resultIds[0]['ids'];
						$data =array ('is_duplicate' => 2,'is_error'=>2);
						$where ="id IN($resultIds)";
						$this->db->where($where);
						$this->db->update('unclaimed_temp', $data);
						echo $this->db->last_query();
						//$ressuccess=$this->updatefilstatus($file_ref);
						if (!empty($ressuccess)) {
	
							 $isfilestatus=2;
						}else{
							 $isfilestatus=3;
							
						}
						$data = [
							
							'is_error' => $isfilestatus,
							'is_submit_to_lao' => $isfilestatus
						];
						$this->db->where_not_in('is_error', [2]);
						$this->db->where('file_ref_number', $file_ref);
						$this->db->update('unclaimed_temp', $data);
	
						
					}
             
			  
			       
			      
			        

        
    }

    function updatefilstatus($file_ref){

    	$query ="SELECT ut.id, ut.file_ref_number FROM unclaimed_temp ut  where ut.is_error=2 and ut.file_ref_number='$file_ref'";
		$sql = $this->db->query($query);
		//echo $this->db->last_query();
		return $results = $sql->result_array();

    }
    
    
     function updateFileStatus(){

    	
    	 $query =" UPDATE 
					unclaimed_file_status w1 
					JOIN ( 
					  SELECT DISTINCT file_ref_number
					FROM  unclaimed_temp t
					WHERE t.is_error=2 
					)w2 
					ON w1.reference_number=w2.file_ref_number
					SET w1.is_error = '2'" ;
        
        $sql = $this->db->query($query);
        //echo $this->db->last_query();
        return true;
        //echo "<pre>-=";print_r($results);
    }
   




     function getFileList(){
      
		$query ="SELECT ut.*,us.id,us.reference_number as file_id FROM unclaimed_temp ut INNER JOIN unclaimed_file_status us ON us.reference_number=ut.file_ref_number where us.is_read=2 limit 1";
		$sql = $this->db->query($query);
		//echo $this->db->last_query();
		return $results = $sql->result_array();
	
		
		//echo "<pre>===="; print_r($results); exit;
   }
   function checkLAOACnumber($zoneid,$accounnumber){
      
		$query ="SELECT a.* FROM account_master a where a.zone_id= '$zoneid' and a.account_number='$accounnumber'";
		$sql = $this->db->query($query);
		//echo $this->db->last_query();exit;
		return $results = $sql->result_array();
	
		
		//echo "<pre>===="; print_r($results); exit;
   }

    
   
   
function getSuccesstxn_old($m_type){
	    $getAnxVal                  =    4; 
		$annexure_type      	    =    unserialize(ANNEXURE_TYPE);
		$annexure            		=    unserialize(ANNEXURE);
		$defined_annexure_col_array =    implode(',',array_keys($annexure[$annexure_type[$m_type]]));
		//echo "<pre>===="; print_r($defined_annexure_col_array); exit;
		$select="$defined_annexure_col_array";
	    $this->db->select($select);
        $this->db->from(TBL_ANNEXURE_TEMP ." a");
		$where = "(a.annexure_type='$m_type' AND a.annexure_status=7 AND is_released='0')";
        $this->db->where($where);
        $query = $this->db->get();
		echo $this->db->last_query(); 
        return $results = $query->result_array();
	 //  	$query ="SELECT  $defined_annexure_col_array FROM ".TBL_ANNEXURE_TEMP."  a WHERE  a.annexure_type='$m_type' AND a.annexure_status=2" ;
	//	$sql = $this->db->query($query);
		//echo $this->db->last_query(); die;
		
	//	return $results = $sql->result_array();
		
		//echo "<pre>===="; print_r($results); exit;
   }
   
   
   function getSuccesstxn_old1($m_type){
	    $getAnxVal                  =    4; 
		$annexure_type      	    =    unserialize(ANNEXURE_TYPE);
		$annexure            		=    unserialize(ANNEXURE);
		$defined_annexure_col_array =    implode(',',array_keys($annexure[$annexure_type[$m_type]]));
		$defined_annexure_col_array =    "uploaded_to_sftp_on AS UploadDate,".$defined_annexure_col_array;
		//$defined_annexure_col_array =    "DATE_FORMAT(released_on, '%d-%m-%Y') AS UploadDate,".$defined_annexure_col_array;
		//echo "<pre>===="; print_r($defined_annexure_col_array); exit;
		
		
		$query ="SELECT  $defined_annexure_col_array FROM ".TBL_ANNEXURE_TEMP."  a WHERE  a.annexure_type='$m_type' AND a.annexure_status=7 AND is_released='0'" ;
		$sql = $this->db->query($query);
		$this->db->last_query();
		return $results = $sql->result_array();
   }
   
   function getSuccesstxn($m_type){
       echo $m_type;
	    $getAnxVal                  =    4; 
		$annexure_type      	    =    unserialize(ANNEXURE_TYPE);
		$annexure            		=    unserialize(ANNEXURE);
		$defined_annexure_col_array = $annexure[$annexure_type[$m_type]];
		 unset($defined_annexure_col_array['khewat_no']);
         unset($defined_annexure_col_array['share_in_ownership']);
         unset($defined_annexure_col_array['acre']);
         unset($defined_annexure_col_array['kanal']);
         unset($defined_annexure_col_array['marla']);
		$defined_annexure_col_array =    implode(',',array_keys($defined_annexure_col_array));
		 
		
		if($m_type == 5){
		    $defined_annexure_col_array =    $defined_annexure_col_array.",uploaded_to_sftp_on AS UploadDate";
		}else{
		    $defined_annexure_col_array =    "uploaded_to_sftp_on AS UploadDate,".$defined_annexure_col_array;
		}
		
		//$defined_annexure_col_array =    "DATE_FORMAT(released_on, '%d-%m-%Y') AS UploadDate,".$defined_annexure_col_array;
		//echo "<pre>===="; print_r($defined_annexure_col_array);
		//echo $this->db->last_query();
		$upload_date = date('d-m-y');
		$query1 ="update ".TBL_ANNEXURE_TEMP." a set a.uploaded_to_sftp_on = '$upload_date' WHERE  a.annexure_type='$m_type' AND a.annexure_status=7 AND is_released='0'" ;
		$sql1 = $this->db->query($query1);
		
		$query ="SELECT  $defined_annexure_col_array FROM ".TBL_ANNEXURE_TEMP."  a WHERE  a.annexure_type='$m_type' AND a.annexure_status=7 AND is_released='0'" ;
		$sql = $this->db->query($query);
		//echo $this->db->last_query();exit;
		return $results = $sql->result_array();
	
		
		//echo "<pre>===="; print_r($results); exit;
   }

   
    function uploadFile($folder, $type,$file_name=null){
	        
			//Remove slashes from file 
			$path ='./Encrypt/out';
		
			if ($handle = opendir($path)) {
				while (false !== ($fileName = readdir($handle))) {
					 if ($fileName != "." && $fileName != ".."){
						$newName =  stripslashes($fileName);
						$getfilename    = preg_replace('/\\\\/', '', $fileName);
						echo "<pre>==$newName=========$getfilename==";print_r($fileName); 
						rename($path.'/'.$fileName, $path.'/'.$getfilename);
					}
				}
				closedir($handle);
			}
			///////////////////////////
	        //$file_name = $type.'_'.date("Ymd").'.xlsx';
			//$file_name = "DD_20180822.xlsx";
	        //echo "Processing upload file" . $file_name; die;
	        $sftp = new Net_SFTP('10.24.119.210');
            if (!$sftp->login('colftpuser1', 'June@2016')) {
                exit('Login Failed');
            }
            $sftp->pwd() . "\r\n";
           // $filename = '/home/colftpuser1/HUDA/DD_Upload/OUT/DD_updated_n111R.xlsx';
            $filename = '/home/colftpuser1/HUDA/'.$folder.'/IN/'.$file_name;
			
            $local_file_path='Encrypt/out/'.$file_name;
            $res =  $sftp->put($filename, $local_file_path,1);
            echo "<pre>======";print_r($res);
	}
	function viewFile($value){
		
		//use phpseclib\Net\SFTP;
		$sftp = new Net_SFTP('10.24.119.210');
		if (!$sftp->login('colftpuser1', 'June@2016')) {
			exit('Login Failed');
		}
		 
		$sftp->pwd() . "\r\n";
		$filename = '/home/colftpuser1/HUDA/'.$value.'/OUT/';
		return $list = $sftp->nlist($filename);
		//$res =  $sftp->get($filename.'/'.$list[1], $list[1]);
		//echo "<pre>======";print_r($list);die;
		
	}
	
	function viewReturnFile(){
		
		//use phpseclib\Net\SFTP;
		$sftp = new Net_SFTP('10.24.119.210');
		if (!$sftp->login('colftpuser1', 'June@2016')) {
			exit('Login Failed');
		}
		 
		$sftp->pwd() . "\r\n";
		$filename = '/home/colftpuser1/HUDA/Returned/';
		return $list = $sftp->nlist($filename);
		//$res =  $sftp->get($filename.'/'.$list[1], $list[1]);
		//echo "<pre>======";print_r($list);die;
		
	}
	
	function insertReleaseFile($data){
       $this->db->insert('released_files',$data);
	}
	function getAnnexureFile($type=0){
	    $this->db->select('*');
        $this->db->from('released_files');
		$where = "(is_read = '$type')";
        $this->db->where($where);
        $query = $this->db->get();
		//echo $this->db->last_query(); die;
        return $results = $query->result_array();
	}
	
	function updateAnnexures($customer_reference_number){
	    $data = array(
			'is_released ' => 1
		);
		$this->db->where('customer_reference_number', $customer_reference_number);
		$this->db->where_not_in('annexure_status',[4,5]);
		$this->db->update(TBL_ANNEXURE_TEMP, $data);
	
	}
	function updateEncAnnexures($id){
	    $data = array(
			'is_read ' => 1
		);
		$this->db->where('id', $id);
		$this->db->update('released_files', $data);
	
	}
	function downloadFile($sftp_fd_path, $type,$file_name=''){
	        
			//$file_name1  = preg_replace('/(\.csv)/', 'R$1', $file_name);
			$file_name1 = $file_name;
	        $sftp = new Net_SFTP('10.24.119.210');
			if (!$sftp->login('colftpuser1', 'June@2016')) {
				exit('Login Failed');
			}
            $sftp->pwd() . "\r\n";
            $filename = '/home/colftpuser1/HUDA/'.$sftp_fd_path.'/OUT/'.$file_name1;
            //$filename = $folder.'/'.$file_name1;
            $local_file_path='SFTP_HUDA/IN/'.$type.'/'.$file_name1;
			echo $local_file_path;
            $res =  $sftp->get($filename, $local_file_path);
			//if($res){
				$sftp->delete($filename,false);
			//}
			return $res;
            //echo "<pre>======";print_r($res);die;
	}

	/*function downloadReturnFile($file_name=''){
	        
			//echo $file_name1  = preg_replace('/(\.xls)/', '_01R$1', $file_name);
	        $sftp = new Net_SFTP('10.24.119.210');
			if (!$sftp->login('colftpuser1', 'June@2016')) {
				exit('Login Failed');
			}
            $sftp->pwd() . "\r\n";
            $filename = '/home/colftpuser1/HUDA/Returned/'.$file_name;
            $local_file_path='SFTP_HUDA/Returned/'.$file_name;
            return $res =  $sftp->get($filename, $local_file_path);
            //echo "<pre>======";print_r($res);die;
	}*/
	
	function downloadReturnFile(){
	        
			
	        $sftp = new Net_SFTP('10.24.119.210');
			if (!$sftp->login('colftpuser1', 'June@2016')) {
				exit('Login Failed');
			}
            $sftp->pwd() . "\r\n";
            $filename = '/home/colftpuser1/HUDA/Returned/HUDA_ReturnsOps.csv';
            //$newfilename = '/home/colftpuser1/HUDA/Returned/HUDA_ReturnsOps'.date('YmdHis').'.xls';
            $local_file_path='SFTP_HUDA/Returned/HUDA_ReturnsOps.csv';
            $res =  $sftp->get($filename, $local_file_path);
			//$sftp->rename($filename,$newfilename);
			$sftp->delete($filename,false);
			return $res;
            //echo "<pre>======";print_r($res);die;
	}
	
	function updateReverseAnnexuresStatus($customer_reference_number,$data){
	    
		$this->db->where('customer_reference_number', $customer_reference_number);
		$this->db->where_not_in('annexure_status',[4,5]);
		$this->db->update(TBL_ANNEXURE_TEMP, $data);
		echo $this->db->last_query();
	
	}
	
	function updateReverseAnnexuresStatus_new($customer_reference_number,$serial_num,$amount,$data){
		//echo "<pre>======"; print_r($data);
		$this->db->where('net_amount', $amount);
		$this->db->where('serial_no', $serial_num);
		$this->db->where('customer_reference_number', $customer_reference_number);
		$this->db->where_not_in('annexure_status',[4,5]);
		$this->db->update(TBL_ANNEXURE_TEMP, $data);
		print_r($this->db->last_query());
	
	}
	
	function updateReturnedAnnexuresStatus($customer_reference_number,$data){
	    
		$this->db->where('customer_reference_number', $customer_reference_number);
		$this->db->where_not_in('annexure_status',[4,5]);
		$this->db->update(TBL_ANNEXURE_TEMP, $data);
	
	}
	
	function getReverseAnnexureFile(){
	    $this->db->select('*');
        $this->db->from('released_files');
		$where = "is_read = '1' AND ((file_status=0) or (file_status = 1 and annexure_type > 4))";
        $this->db->where($where);
        $query = $this->db->get();
		//echo $this->db->last_query(); die;
        return $results = $query->result_array();
	}
	
	function updateReverseAnnexuresFiles_old($id){
	    $data = array(
			'file_status ' => 1
		);
		$this->db->where('id', $id);
		$this->db->update('released_files', $data);
	}
	
		function updateReverseAnnexuresFiles($id,$status){
	    $data = array(
			'file_status ' => $status,
			'updated_on'    => date('Y-m-d H:i:s')
		);
		$this->db->where('id', $id);
		$this->db->update('released_files', $data);
	}

	function getOriginaltxn($m_type,$zone_id){
       //echo $m_type;
	    $getAnxVal                  =    4; 
		$annexure_type      	    =    unserialize(ANNEXURE_TYPE);
		$annexure            		=    unserialize(ANNEXURE);
		$annexure_status            = json_decode((ANNEXURE_STATUS),true);
		$defined_annexure_col_array =    implode(',',array_keys($annexure[$annexure_type[$m_type]]));
		
		
		$query ="SELECT a.file_name,z.name as zone_name,a.customer_reference_number,a.serial_no,a.sector_no,a.villlage_name,a.section_notfn_date,a.is_petition_filed,a.award_no,a.award_date,a.LAO_bank_account_no,a.beneficiary_name,a.khewat_no,a.share_in_ownership,a.acre,a.kanal,a.marla,a.beneficiary_PAN,a.gross_amount_to_paid,a.TDS_deducted,a.net_amount,a.ifsc_code,a.account_number,a.is_EDC,a.mobile_number,a.authorised_on,a.released_on,a.returned_on,a.rejected_on,
		   (CASE WHEN a.annexure_status != 6 THEN  CASE 
				WHEN a.annexure_status = '1' THEN 'New'
				WHEN a.annexure_status = '2' THEN 'Pending at LAO'
				WHEN a.annexure_status = '3' THEN 'Pending at Releaser' 
				WHEN a.annexure_status = '4' THEN 'Rejected By LAO' 
				WHEN a.annexure_status = '5' THEN 'Rejected By releaser'
				WHEN a.annexure_status = '6' THEN 'Returned'
				WHEN a.annexure_status = '7' THEN 'Success'
				WHEN a.annexure_status = '8' THEN 'In process to Releaser' 
				WHEN a.annexure_status = '9' THEN 'In process for Disbursal' 
				WHEN a.annexure_status = '10' THEN 'Reinitiated'
				WHEN a.annexure_status = '11' THEN 'Disbursement Successful' 
				WHEN a.annexure_status = '12' THEN 'Disbursement Failed'
				ELSE NULL END  
				ELSE CASE WHEN (a.annexure_status = 6 AND a.is_return =1) THEN 'Returned' ELSE 'Returned(Failed)' END END) as annexure_status,
		     (CASE WHEN (a.annexure_status != 6 or a.annexure_status !=11) AND a.is_resubmitted =1  THEN 'Yes' ELSE 'No' END) as is_resubmitted
		    
		    FROM (`annexure_temp` a) LEFT JOIN `zone_master` as z ON `z`.`id` = `a`.`zone_id` WHERE (a.annexure_type = $m_type and a.zone_id=$zone_id)" ;
		
		$sql = $this->db->query($query);
		//echo $this->db->last_query();
		return $results = $sql->result_array();
	
		
		//echo "<pre>===="; print_r($results); exit;
   }
   function getLowertxn($m_type,$zone_id){
       //echo $m_type;
	    $getAnxVal                  =    4; 
		$annexure_type      	    =    unserialize(ANNEXURE_TYPE);
		$annexure            		=    unserialize(ANNEXURE);
		//$annexure_status            = json_decode((ANNEXURE_STATUS),true);
		$defined_annexure_col_array =    implode(',',array_keys($annexure[$annexure_type[$m_type]]));
		
		
		$query ="SELECT a.file_name,z.name as zone_name,a.customer_reference_number,a.sector_no,a.villlage_name,a.award_no,a.award_date,a.LAO_bank_account_no,a.beneficiary_name,a.khewat_no,a.share_in_ownership,a.acre,a.kanal,a.marla,a.beneficiary_PAN,a.gross_amount_to_paid,a.TDS_deducted,a.net_amount,a.ifsc_code,a.account_number,a.is_EDC,a.mobile_number,a.is_EDC,a.mobile_number,a.authorised_on,a.released_on,a.returned_on,a.rejected_on,
		   (CASE WHEN a.annexure_status != 6 THEN  CASE 
				WHEN a.annexure_status = '1' THEN 'New'
				WHEN a.annexure_status = '2' THEN 'Pending at LAO'
				WHEN a.annexure_status = '3' THEN 'Pending at Releaser' 
				WHEN a.annexure_status = '4' THEN 'Rejected By LAO' 
				WHEN a.annexure_status = '5' THEN 'Rejected By releaser'
				WHEN a.annexure_status = '6' THEN 'Returned'
				WHEN a.annexure_status = '7' THEN 'Success'
				WHEN a.annexure_status = '8' THEN 'In process to Releaser' 
				WHEN a.annexure_status = '9' THEN 'In process for Disbursal' 
				WHEN a.annexure_status = '10' THEN 'Reinitiated'
				WHEN a.annexure_status = '11' THEN 'Disbursement Successful' 
				WHEN a.annexure_status = '12' THEN 'Disbursement Failed'
				ELSE NULL END  
				ELSE CASE WHEN (a.annexure_status = 6 AND a.is_return =1) THEN 'Returned' ELSE 'Returned(Failed)' END END) as annexure_status,
		     (CASE WHEN (a.annexure_status != 6 or a.annexure_status !=11) AND a.is_resubmitted =1  THEN 'Yes' ELSE 'No' END) as is_resubmitted
		    
		    FROM (`annexure_temp` a) LEFT JOIN `zone_master` as z ON `z`.`id` = `a`.`zone_id` WHERE (a.annexure_type = $m_type and a.zone_id=$zone_id)" ;
		
			$sql = $this->db->query($query);
			//echo $this->db->last_query();exit;
			return $results = $sql->result_array();
	
		
		//echo "<pre>===="; print_r($results); exit;
   }

	function getHighCourttxn($m_type,$zone_id){
       //echo $m_type;
	    $getAnxVal                  =    4; 
		$annexure_type      	    =    unserialize(ANNEXURE_TYPE);
		$annexure            		=    unserialize(ANNEXURE);
		//$annexure_status            = json_decode((ANNEXURE_STATUS),true);
		$defined_annexure_col_array =    implode(',',array_keys($annexure[$annexure_type[$m_type]]));
		
		
		$query ="SELECT a.file_name,z.name as zone_name,a.customer_reference_number,a.serial_no,a.sector_no,a.villlage_name,a.LAO_bank_account_no,a.award_no,a.award_date,a.ADJ_court_order_no,a.ADJ_court_decision_date,a.high_court_order_no,a.high_court_decision_date,a.beneficiary_name,a.khewat_no,a.share_in_ownership,a.acre,a.kanal,a.marla,a.beneficiary_PAN,a.gross_amount_to_paid,a.TDS_deducted,a.net_amount,a.ifsc_code,a.account_number,a.is_EDC,a.mobile_number,a.authorised_on,a.released_on,a.returned_on,a.rejected_on,
		   (CASE WHEN a.annexure_status != 6 THEN  CASE 
				WHEN a.annexure_status = '1' THEN 'New'
				WHEN a.annexure_status = '2' THEN 'Pending at LAO'
				WHEN a.annexure_status = '3' THEN 'Pending at Releaser' 
				WHEN a.annexure_status = '4' THEN 'Rejected By LAO' 
				WHEN a.annexure_status = '5' THEN 'Rejected By releaser'
				WHEN a.annexure_status = '6' THEN 'Returned'
				WHEN a.annexure_status = '7' THEN 'Success'
				WHEN a.annexure_status = '8' THEN 'In process to Releaser' 
				WHEN a.annexure_status = '9' THEN 'In process for Disbursal' 
				WHEN a.annexure_status = '10' THEN 'Reinitiated'
				WHEN a.annexure_status = '11' THEN 'Disbursement Successful' 
				WHEN a.annexure_status = '12' THEN 'Disbursement Failed'
				ELSE NULL END  
				ELSE CASE WHEN (a.annexure_status = 6 AND a.is_return =1) THEN 'Returned' ELSE 'Returned(Failed)' END END) as annexure_status,
		     (CASE WHEN (a.annexure_status != 6 or a.annexure_status !=11) AND a.is_resubmitted =1  THEN 'Yes' ELSE 'No' END) as is_resubmitted
		    
		    FROM (`annexure_temp` a) LEFT JOIN `zone_master` as z ON `z`.`id` = `a`.`zone_id` WHERE (a.annexure_type = $m_type and a.zone_id=$zone_id)" ;
		
			$sql = $this->db->query($query);
			//echo $this->db->last_query();exit;
			return $results = $sql->result_array();
	
		
		//echo "<pre>===="; print_r($results); exit;
   }	

    function getSupremeCourttxn($m_type,$zone_id){
       //echo $m_type;
	    $getAnxVal                  =    4; 
		$annexure_type      	    =    unserialize(ANNEXURE_TYPE);
		$annexure            		=    unserialize(ANNEXURE);
		//$annexure_status            = json_decode((ANNEXURE_STATUS),true);
		$defined_annexure_col_array =    implode(',',array_keys($annexure[$annexure_type[$m_type]]));
		
		
		$query ="SELECT a.file_name,z.name as zone_name,a.customer_reference_number,a.sector_no,a.villlage_name,a.award_no,a.award_date,a.LAO_bank_account_no,a.beneficiary_name,a.khewat_no,a.share_in_ownership,a.acre,a.kanal,a.marla,a.ADJ_court_order_no,a.ADJ_court_decision_date,a.high_court_order_no,a.high_court_decision_date,a.supreme_court_order_no,a.supreme_court_decision_date,a.beneficiary_PAN,a.gross_amount_to_paid,a.TDS_deducted,a.net_amount,a.ifsc_code,a.account_number,a.is_EDC,a.mobile_number,a.authorised_on,a.released_on,a.returned_on,a.rejected_on,
		   (CASE WHEN a.annexure_status != 6 THEN  CASE 
				WHEN a.annexure_status = '1' THEN 'New'
				WHEN a.annexure_status = '2' THEN 'Pending at LAO'
				WHEN a.annexure_status = '3' THEN 'Pending at Releaser' 
				WHEN a.annexure_status = '4' THEN 'Rejected By LAO' 
				WHEN a.annexure_status = '5' THEN 'Rejected By releaser'
				WHEN a.annexure_status = '6' THEN 'Returned'
				WHEN a.annexure_status = '7' THEN 'Success'
				WHEN a.annexure_status = '8' THEN 'In process to Releaser' 
				WHEN a.annexure_status = '9' THEN 'In process for Disbursal' 
				WHEN a.annexure_status = '10' THEN 'Reinitiated'
				WHEN a.annexure_status = '11' THEN 'Disbursement Successful' 
				WHEN a.annexure_status = '12' THEN 'Disbursement Failed'
				ELSE NULL END  
				ELSE CASE WHEN (a.annexure_status = 6 AND a.is_return =1) THEN 'Returned' ELSE 'Returned(Failed)' END END) as annexure_status,
		     (CASE WHEN (a.annexure_status != 6 or a.annexure_status !=11) AND a.is_resubmitted =1  THEN 'Yes' ELSE 'No' END) as is_resubmitted
		    
		    FROM (`annexure_temp` a) LEFT JOIN `zone_master` as z ON `z`.`id` = `a`.`zone_id` WHERE (a.annexure_type = $m_type and a.zone_id=$zone_id)" ;
		
			$sql = $this->db->query($query);
			//echo $this->db->last_query();exit;
			return $results = $sql->result_array();
	
		
		//echo "<pre>===="; print_r($results); exit;
   }
   function getSupremeCourtDDtxn($m_type,$zone_id){
       //echo $m_type;
	    $getAnxVal                  =    4; 
		$annexure_type      	    =    unserialize(ANNEXURE_TYPE);
		$annexure            		=    unserialize(ANNEXURE);
		//$annexure_status            = json_decode((ANNEXURE_STATUS),true);
		$defined_annexure_col_array =    implode(',',array_keys($annexure[$annexure_type[$m_type]]));
		
		
		$query ="SELECT a.file_name,z.name as zone_name,a.serial_no,a.customer_reference_number,a.sector_no,a.villlage_name,a.LAO_bank_account_no,a.award_no,a.award_date,a.ADJ_court_order_no,a.ADJ_court_decision_date,a.high_court_order_no,a.high_court_decision_date,a.supreme_court_order_no,a.supreme_court_decision_date,a.beneficiary_name,a.khewat_no,a.share_in_ownership,a.acre,a.kanal,a.marla,a.beneficiary_PAN,a.gross_amount_to_paid,a.TDS_deducted,a.net_amount,a.drawee_name,a.print_location,a.DD_PAYABLE_AT,a.is_EDC,a.mobile_number,a.authorised_on,a.released_on,a.returned_on,a.rejected_on,
		   (CASE WHEN a.annexure_status != 6 THEN  CASE 
				WHEN a.annexure_status = '1' THEN 'New'
				WHEN a.annexure_status = '2' THEN 'Pending at LAO'
				WHEN a.annexure_status = '3' THEN 'Pending at Releaser' 
				WHEN a.annexure_status = '4' THEN 'Rejected By LAO' 
				WHEN a.annexure_status = '5' THEN 'Rejected By releaser'
				WHEN a.annexure_status = '6' THEN 'Returned'
				WHEN a.annexure_status = '7' THEN 'Success'
				WHEN a.annexure_status = '8' THEN 'In process to Releaser' 
				WHEN a.annexure_status = '9' THEN 'In process for Disbursal' 
				WHEN a.annexure_status = '10' THEN 'Reinitiated'
				WHEN a.annexure_status = '11' THEN 'Disbursement Successful' 
				WHEN a.annexure_status = '12' THEN 'Disbursement Failed'
				ELSE NULL END  
				ELSE CASE WHEN (a.annexure_status = 6 AND a.is_return =1) THEN 'Returned' ELSE 'Returned(Failed)' END END) as annexure_status,
		     (CASE WHEN (a.annexure_status != 6 or a.annexure_status !=11) AND a.is_resubmitted =1  THEN 'Yes' ELSE 'No' END) as is_resubmitted
		    
		    FROM (`annexure_temp` a) LEFT JOIN `zone_master` as z ON `z`.`id` = `a`.`zone_id` WHERE (a.annexure_type = $m_type and a.zone_id=$zone_id)" ;
		
			$sql = $this->db->query($query);
			//echo $this->db->last_query();exit;
			return $results = $sql->result_array();
	
		
		//echo "<pre>===="; print_r($results); exit;
   }
   function getOriginalCourtDDtxn($m_type,$zone_id){
      // echo $m_type;
	    $getAnxVal                  =    4; 
		$annexure_type      	    =    unserialize(ANNEXURE_TYPE);
		$annexure            		=    unserialize(ANNEXURE);
		//$annexure_status            = json_decode((ANNEXURE_STATUS),true);
		$defined_annexure_col_array =    implode(',',array_keys($annexure[$annexure_type[$m_type]]));
		
		
		$query ="SELECT a.file_name,z.name as zone_name,a.serial_no,a.customer_reference_number,a.sector_no,a.villlage_name,a.section_notfn_date,a.is_petition_filed,a.award_no,a.award_date,a.LAO_bank_account_no,a.beneficiary_name,a.khewat_no,a.share_in_ownership,a.acre,a.kanal,a.marla,a.beneficiary_PAN,a.gross_amount_to_paid,a.drawee_name,a.print_location,a.DD_PAYABLE_AT,a.is_EDC,a.mobile_number,a.UTR,a.StatusDesc,a.authorised_on,a.released_on,a.returned_on,a.rejected_on,
		   (CASE WHEN a.annexure_status != 6 THEN  CASE 
				WHEN a.annexure_status = '1' THEN 'New'
				WHEN a.annexure_status = '2' THEN 'Pending at LAO'
				WHEN a.annexure_status = '3' THEN 'Pending at Releaser' 
				WHEN a.annexure_status = '4' THEN 'Rejected By LAO' 
				WHEN a.annexure_status = '5' THEN 'Rejected By releaser'
				WHEN a.annexure_status = '6' THEN 'Returned'
				WHEN a.annexure_status = '7' THEN 'Success'
				WHEN a.annexure_status = '8' THEN 'In process to Releaser' 
				WHEN a.annexure_status = '9' THEN 'In process for Disbursal' 
				WHEN a.annexure_status = '10' THEN 'Reinitiated'
				WHEN a.annexure_status = '11' THEN 'Disbursement Successful' 
				WHEN a.annexure_status = '12' THEN 'Disbursement Failed'
				ELSE NULL END  
				ELSE CASE WHEN (a.annexure_status = 6 AND a.is_return =1) THEN 'Returned' ELSE 'Returned(Failed)' END END) as annexure_status,
		     (CASE WHEN (a.annexure_status != 6 or a.annexure_status !=11) AND a.is_resubmitted =1  THEN 'Yes' ELSE 'No' END) as is_resubmitted
		    
		    FROM (`annexure_temp` a) LEFT JOIN `zone_master` as z ON `z`.`id` = `a`.`zone_id` WHERE (a.annexure_type = $m_type and a.zone_id=$zone_id)" ;
		
			$sql = $this->db->query($query);
			//echo $this->db->last_query();exit;
			return $results = $sql->result_array();
	
		
		//echo "<pre>===="; print_r($results); exit;
   }

    function getLowerCourtDDtxn($m_type,$zone_id){
       //echo $m_type;
	    $getAnxVal                  =    4; 
		$annexure_type      	    =    unserialize(ANNEXURE_TYPE);
		$annexure            		=    unserialize(ANNEXURE);
		//$annexure_status            = json_decode((ANNEXURE_STATUS),true);
		$defined_annexure_col_array =    implode(',',array_keys($annexure[$annexure_type[$m_type]]));
		
		
		$query ="SELECT a.file_name,z.name as zone_name,a.serial_no,a.customer_reference_number,a.sector_no,a.villlage_name,a.LAO_bank_account_no,a.award_no,a.award_date,a.ADJ_court_order_no,a.ADJ_court_decision_date,a.beneficiary_name,a.khewat_no,a.share_in_ownership,a.acre,a.kanal,a.marla,a.beneficiary_PAN,a.gross_amount_to_paid,a.TDS_deducted,a.net_amount,a.drawee_name,a.print_location,a.DD_PAYABLE_AT,a.is_EDC,a.mobile_number,a.UTR,a.StatusDesc,a.authorised_on,a.released_on,a.returned_on,a.rejected_on,
		   (CASE WHEN a.annexure_status != 6 THEN  CASE 
				WHEN a.annexure_status = '1' THEN 'New'
				WHEN a.annexure_status = '2' THEN 'Pending at LAO'
				WHEN a.annexure_status = '3' THEN 'Pending at Releaser' 
				WHEN a.annexure_status = '4' THEN 'Rejected By LAO' 
				WHEN a.annexure_status = '5' THEN 'Rejected By releaser'
				WHEN a.annexure_status = '6' THEN 'Returned'
				WHEN a.annexure_status = '7' THEN 'Success'
				WHEN a.annexure_status = '8' THEN 'In process to Releaser' 
				WHEN a.annexure_status = '9' THEN 'In process for Disbursal' 
				WHEN a.annexure_status = '10' THEN 'Reinitiated'
				WHEN a.annexure_status = '11' THEN 'Disbursement Successful' 
				WHEN a.annexure_status = '12' THEN 'Disbursement Failed'
				ELSE NULL END  
				ELSE CASE WHEN (a.annexure_status = 6 AND a.is_return =1) THEN 'Returned' ELSE 'Returned(Failed)' END END) as annexure_status,
		     (CASE WHEN (a.annexure_status != 6 or a.annexure_status !=11) AND a.is_resubmitted =1  THEN 'Yes' ELSE 'No' END) as is_resubmitted
		    
		    FROM (`annexure_temp` a) LEFT JOIN `zone_master` as z ON `z`.`id` = `a`.`zone_id` WHERE (a.annexure_type = $m_type and a.zone_id=$zone_id)" ;
		
			$sql = $this->db->query($query);
			//echo $this->db->last_query();exit;
			return $results = $sql->result_array();
	
		
		//echo "<pre>===="; print_r($results); exit;
   }
    function getHighCourtDDtxn($m_type,$zone_id){
      // echo $m_type;
	    $getAnxVal                  =    4; 
		$annexure_type      	    =    unserialize(ANNEXURE_TYPE);
		$annexure            		=    unserialize(ANNEXURE);
		//$annexure_status            = json_decode((ANNEXURE_STATUS),true);
		$defined_annexure_col_array =    implode(',',array_keys($annexure[$annexure_type[$m_type]]));
		
		
		$query ="SELECT a.file_name,z.name as zone_name,a.serial_no,a.customer_reference_number,a.sector_no,a.villlage_name,a.LAO_bank_account_no,a.award_no,a.award_date,a.ADJ_court_order_no,a.ADJ_court_decision_date,a.high_court_order_no,a.high_court_decision_date,a.beneficiary_name,a.khewat_no,a.share_in_ownership,a.acre,a.kanal,a.marla,a.beneficiary_PAN,a.gross_amount_to_paid,a.TDS_deducted,a.net_amount,a.drawee_name,a.print_location,a.DD_PAYABLE_AT,a.is_EDC,a.mobile_number,a.UTR,a.StatusDesc,a.authorised_on,a.released_on,a.returned_on,a.rejected_on,
		   (CASE WHEN a.annexure_status != 6 THEN  CASE 
				WHEN a.annexure_status = '1' THEN 'New'
				WHEN a.annexure_status = '2' THEN 'Pending at LAO'
				WHEN a.annexure_status = '3' THEN 'Pending at Releaser' 
				WHEN a.annexure_status = '4' THEN 'Rejected By LAO' 
				WHEN a.annexure_status = '5' THEN 'Rejected By releaser'
				WHEN a.annexure_status = '6' THEN 'Returned'
				WHEN a.annexure_status = '7' THEN 'Success'
				WHEN a.annexure_status = '8' THEN 'In process to Releaser' 
				WHEN a.annexure_status = '9' THEN 'In process for Disbursal' 
				WHEN a.annexure_status = '10' THEN 'Reinitiated'
				WHEN a.annexure_status = '11' THEN 'Disbursement Successful' 
				WHEN a.annexure_status = '12' THEN 'Disbursement Failed'
				ELSE NULL END  
				ELSE CASE WHEN (a.annexure_status = 6 AND a.is_return =1) THEN 'Returned' ELSE 'Returned(Failed)' END END) as annexure_status,
		     (CASE WHEN (a.annexure_status != 6 or a.annexure_status !=11) AND a.is_resubmitted =1  THEN 'Yes' ELSE 'No' END) as is_resubmitted
		    
		    FROM (`annexure_temp` a) LEFT JOIN `zone_master` as z ON `z`.`id` = `a`.`zone_id` WHERE (a.annexure_type = $m_type and a.zone_id=$zone_id)" ;
		
			$sql = $this->db->query($query);
			//echo $this->db->last_query();exit;
			return $results = $sql->result_array();
	
		
		//echo "<pre>===="; print_r($results); exit;
   }

   function getZoneList(){
      
		$query ="SELECT id FROM ".TBL_ZONE_MASTER;
		$sql = $this->db->query($query);
		//echo $this->db->last_query();exit;
		return $results = $sql->result_array();
	
		
		//echo "<pre>===="; print_r($results); exit;
   }

	
}