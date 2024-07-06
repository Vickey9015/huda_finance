<?php
//include './phpseclib/Net/SFTP.php';
class Download_model extends CI_Model {
    public $error       = array();
    public $error_count = 0;
    public $user_type    = 0;
    
    public function __construct() 
    {
        parent::__construct();
		$this->select = "s_no,sector_no,zone_name,name_of_village,date_of_four_section,date_of_six_sectiom,is_petition_filed,award_no,award_date,khewat_no,acquired_area,share_in_ownership,acre,kanal,marla,bank_ac_lao,name_of_bene,ifsc_code,account_number,care_of,net_amount,is_edc,customer_ref_numer,file_name,file_ref_number,UTR,CASE WHEN annexure_status = '1' THEN 'New'
		WHEN annexure_status = '2' THEN 'Pending at LAO'
		WHEN annexure_status = '3' THEN 'Pending at Releaser' 
		WHEN annexure_status = '4' THEN 'Rejected By LAO' 
		WHEN annexure_status = '5' THEN 'Rejected By releaser'
		WHEN annexure_status = '6' THEN 'Returned'
		WHEN annexure_status = '7' THEN 'Success'
		WHEN annexure_status = '8' THEN 'In process to Releaser' 
		WHEN annexure_status = '9' THEN 'In process for Disbursal' 
		WHEN annexure_status = '10' THEN 'Reinitiated'
		WHEN annexure_status = '11' THEN 'Disbursement Successful' 
		WHEN annexure_status = '12' THEN 'Disbursement Failed'
		ELSE NULL END AS annexure_status,initiation_by,initiated_on,authorised_by,authorised_on,created_on";
		
		
    }

   function unclaimed_txn(){
	   //print($zone);  die;
	   	$select = $this->select;
		$query ="SELECT $select FROM (`unclaimed_temp`) WHERE is_error=5";
		
		$sql = $this->db->query($query);
		// echo $this->db->last_query();exit;
		return $results = $sql->result_array();
		//echo "<pre>===="; print_r($results); exit;
   }

   function unclaimedReportByZone($zone){
		//print($zone);  die;
		$select = $this->select;
		$query ="SELECT $select FROM (`unclaimed_temp`) WHERE is_error=5 AND zone_id=$zone";
		
		$sql = $this->db->query($query);
		// echo $this->db->last_query();exit;
		return $results = $sql->result_array();
		//echo "<pre>===="; print_r($results); exit;
	}

	function unclaimedSuccessReportByZone($zone){
		$select = $this->select;
		$query ="SELECT $select FROM (`unclaimed_temp`) WHERE is_error=5 AND annexure_status=11 AND zone_id=$zone";
		
		$sql = $this->db->query($query);
		// echo $this->db->last_query();exit;
		return $results = $sql->result_array();
		//echo "<pre>===="; print_r($results); exit;
	}

	function unclaimedRemainReportByZone($zone){
		$select = $this->select;
		$query ="SELECT $select FROM (`unclaimed_temp`) WHERE zone_id=$zone AND is_error=5 AND (annexure_status != 11 OR annexure_status IS NULL)";

		$sql = $this->db->query($query);
		// echo $this->db->last_query();exit;
		return $results = $sql->result_array();
		//echo "<pre>===="; print_r($results); exit;
	}

	function getZones(){
		$this->db->select('id');
		$query = $this->db->get('zone_master');
		return $query->result();
	}

	
}