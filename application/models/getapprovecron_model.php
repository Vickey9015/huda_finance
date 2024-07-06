<?php
include './phpseclib/Net/SFTP.php';
class Getapprovecron_model extends CI_Model {
    public $error       = array();
    public $error_count = 0;
    public $user_type    = 0;
    
    public function __construct() 
    {
        parent::__construct();
		
    }
   
	function getSuccesstxn(){
		$select = 's_no,sector_no,name_of_village,date_of_six_sectiom,is_petition_filed,award_no,award_date,bank_ac_lao,name_of_bene,beneficiary_PAN,gross_amount_to_paid,TDS_deducted,net_amount,ifsc_code,account_number,is_edc,mobile_number,customer_ref_numer';
		$select = "uploaded_to_sftp_on AS UploadDate,".$select;
		
		$upload_date = date('Y-m-d H:i:s');
		$query1 ="UPDATE unclaimed_temp a SET a.uploaded_to_sftp_on = '$upload_date' WHERE a.is_error='5' AND a.annexure_status='3' AND a.is_released='0'" ;
		$sql1 = $this->db->query($query1);
		
		$query ="SELECT $select FROM unclaimed_temp a WHERE a.is_error='5' AND a.annexure_status='3' AND a.is_released='0'" ;
		$sql = $this->db->query($query);
		//echo '<pre>'.$this->db->last_query(); die;
		return $results = $sql->result_array();
	
		//echo "<pre>===="; print_r($sql->result_array()); exit;
	}

	function insertReleaseFile($data){
		$this->db->insert('released_files',$data);
	}

	function updateAnnexures($customer_reference_number){
	    $data = array(
			'is_released ' => 1,
			'annexure_status'=> 7,
		);
		$this->db->where('customer_ref_numer', $customer_reference_number);
		$this->db->where('annexure_status',3);
		$this->db->where('is_error',5);
		$this->db->update('unclaimed_temp', $data);
		//echo '<pre>'.$this->db->last_query(); die;
	}

	function getReverseAnnexureFile(){
	    $this->db->select('*');
        $this->db->from('released_files');
		$where = "is_read = '1' AND file_status = '0' AND annexure_type = '9'";
        $this->db->where($where);
        $query = $this->db->get();
		//echo $this->db->last_query(); die;
        return $results = $query->result_array();
	}

	function updateReverseAnnexuresStatus($customer_reference_number,$data){
	    
		$this->db->where('customer_ref_numer', $customer_reference_number);
		$this->db->where('annexure_status',7);
		$this->db->where('is_error',5);
		$this->db->update('unclaimed_temp', $data);
		//echo $this->db->last_query(); die;
	
	}

	function updateReverseAnnexuresFiles($id,$status){
	    $data = array(
			'file_status ' => $status,
			'updated_on'    => date('Y-m-d H:i:s')
		);
		$this->db->where('id', $id);
		$this->db->update('released_files', $data);

	}

	function createLog($postArray){
       
        //echo "<pre>===="; print_r($postArray); exit;
        $this->db->insert('unclaimed_request_log', $postArray);
        $id = $this->db->insert_id();
        return $id;
        //echo "<pre>===="; print_r($postArray); exit;
     }
	
}