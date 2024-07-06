<?php

class Approve_model extends CI_Model {
    public $error       = array();
    public $error_count = 0;
    public $user_type    = 0;
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->library('session');
        $session_data = $this->session->all_userdata();
        $this->role_id = $session_data['role_id'];
        $this->zones = $session_data['zones'];
        
    }
    
   function getFileWithStatus($startDate='',$toDate='',$zoneid=''){
        $i=0;
       
        $condition = '';
        
		if($startDate !='' ){

			$sdate = date('Y-m-d',strtotime($startDate));
			//echo "<pre>";print_r($sdate);exit;
			$condition .= "DATE(a.created_on) >= '$sdate'";
		}else{
			$sdate = date('Y-m-d',strtotime('-30 days'));

       // echo "<pre>";print_r($sdate);exit;
			$condition .= "DATE(a.created_on) >= '$sdate'";
		}
		if($toDate !='' ){
			$tdate = date('Y-m-d',strtotime($toDate));
			$condition .= " AND  DATE(a.created_on) <= '$tdate'";
		}else{
			$tdate = date('Y-m-d');
			$condition .= " AND  DATE(a.created_on) <= '$tdate'";
		}
		
		$condition .= " AND  (a.zone_id in ($zoneid))";
		$query ="SELECT `id`,`file_name`,`total_record`,`is_error`,`created_on`,`reference_number`,`total_amount`
				FROM unclaimed_file_status a
				WHERE $condition 
				ORDER BY (a.id) DESC" ;
		$sql = $this->db->query($query);
		//echo $this->db->last_query(); die;
		//echo '<pre>==='; print_r($sql->result_array()); die;
		return $results = $sql->result_array();
   }

   function updateApproveStatus($id){
		foreach ($id as $key => $value) {
			$session_data = $this->session->all_userdata();
			$dbdata = array(
				"is_error" => 4,
				"initiation_id" => $session_data['id'],
				"initiation_by" => $session_data['name'],
				"initiation_on" => date('Y-m-d H:i:s')
		   ); 
		   $this->db->where('is_error', 3);
			$this->db->where('id', $value);
			$this->db->update('unclaimed_file_status',$dbdata);
		}
		return $this->db->affected_rows();
		//echo $this->db->last_query(); die;
   }

   function updateApproveStatusInData($ref_no){
		foreach ($ref_no as $key => $value) {
			$session_data = $this->session->all_userdata();
			$dbdata = array(
				"is_error" => 4,
				"initiation_id" => $session_data['id'],
				"initiation_by" => $session_data['name'],
				"initiated_on" => date('Y-m-d H:i:s')
		   ); 
			
			$this->db->where('is_error', 3);
			$this->db->where('file_ref_number', $value);
			$this->db->update('unclaimed_temp',$dbdata);
		}
		return $this->db->affected_rows();
		//echo $this->db->last_query(); die;
	}
	function updateReleaseStatus($id){
		foreach ($id as $key => $value) {
			$session_data = $this->session->all_userdata();
			$dbdata = array(
				"is_error" => 5,
				"authoriser_id" => $session_data['id'],
				"authorised_by" => $session_data['name'],
				"authorised_on" => date('Y-m-d H:i:s')
		   ); 
			
			$this->db->where('is_error', 4);
			$this->db->where('id', $value);
			$this->db->update('unclaimed_file_status',$dbdata);
		}
		return $this->db->affected_rows();
		//echo $this->db->last_query(); die;
   }

   function updateRelaseStatusInData($ref_no){
		foreach ($ref_no as $key => $value) {
			$session_data = $this->session->all_userdata();
			$dbdata = array(
				"is_error" => 5,
				"authoriser_id" => $session_data['id'],
				"authorised_by" => $session_data['name'],
				"authorised_on" => date('Y-m-d H:i:s')
		   ); 
			
			$this->db->where('is_error', 4);
			$this->db->where('file_ref_number', $value);
			$this->db->update('unclaimed_temp',$dbdata);
		}
		return $this->db->affected_rows();
		//echo $this->db->last_query(); die;
	}

   function getUserPass($id){
		$this->db->select('password');
		$this->db->where('id',$id);
		$query = $this->db->get('user');
		return $query->result_array();
		//echo $this->db->last_query(); die;

	}

   function getDashbaordDataWithStatus($startDate='',$toDate='', $status='',$zoneid=''){
		$i=0;
		//echo "<pre>";print_r($this->role_id);exit;
		
		$condition = '';
		if($this->role_id==6){
			
			$condition = 'a.is_error = '.$status;

		}else{
			//echo "<pre>";print_r($zoneid);exit;
			
			$condition = "a.is_error = $status and a.zone_id in ($zoneid)";
			
			
		}
		//echo "<pre>";print_r($condition);exit;
		
		
		$query ="SELECT *
				FROM unclaimed_temp a
				WHERE $condition
				ORDER BY a.id" ;
		$sql = $this->db->query($query);
		//echo $this->db->last_query(); die;
		//echo '<pre>==='; print_r($sql->result_array()); die;
		return $results = $sql->result_array();
	}
	function getDashbaordPaidDataWithStatus($startDate='',$toDate='', $status='',$zoneid=''){
		$i=0;
		//echo "<pre>";print_r($this->role_id);exit;
		$annestatus='IS NULL';
		
		$condition = '';
		if($this->role_id==6){
			
			$condition =  "a.is_error = $status and a.annexure_status  $annestatus ";

		}else{
			//echo "<pre>";print_r($zoneid);exit;
			
			$condition = "a.is_error = $status and a.annexure_status  $annestatus  and a.zone_id in ($zoneid)";
			
			
		}
		//echo "<pre>";print_r($condition);exit;
		
		
		$query ="SELECT *
				FROM unclaimed_temp a
				WHERE $condition
				ORDER BY a.id" ;
		$sql = $this->db->query($query);
		//echo $this->db->last_query(); die;
		//echo '<pre>==='; print_r($sql->result_array()); die;
		return $results = $sql->result_array();
	}
	function getUserData($id){
		$this->db->select('*');
		$this->db->where('id',$id);
		$query = $this->db->get('user');
		return $query->result_array();
		//echo $this->db->last_query(); die;

	}

	
	function getFileDataWithStatus($startDate='',$toDate='', $ref_no){
        $i=0;
        //echo "<pre>";print_r($startDate);exit;
        $condition = '';
        
		if($startDate !='' ){

			$sdate = date('Y-m-d',strtotime($startDate));
			//echo "<pre>";print_r($sdate);exit;
			$condition .= "DATE(a.created_on) >= '$sdate'";
		}else{
			$sdate = date('Y-m-d',strtotime('-30 days'));

        //echo "<pre>";print_r($sdate);exit;
			$condition .= "DATE(a.created_on) >= '$sdate'";
		}
		if($toDate !='' ){
			$tdate = date('Y-m-d',strtotime($toDate));
			$condition .= " AND  DATE(a.created_on) <= '$tdate'";
		}else{
			$tdate = date('Y-m-d');
			$condition .= " AND  DATE(a.created_on) <= '$tdate'";
		}
		
		$query ="SELECT *
				FROM unclaimed_temp a
				WHERE a.file_ref_number = '$ref_no' AND $condition
				ORDER BY a.id" ;
		$sql = $this->db->query($query);
		//echo $this->db->last_query(); die;
		//echo '<pre>==='; print_r($sql->result_array()); die;
		return $results = $sql->result_array();
   	}

	function scheduleBene($data, $recordId){
		//echo '<pre>==='; print_r($data); die;
		$sql = $this->db->where('id', $recordId)
        		->update('unclaimed_temp', $data);

		// echo '<pre>==='; echo $this->db->last_query(); die;
		return $this->db->affected_rows();
	}

	function validateAmount($id, $accNo, $amount){
		$query = $this->db->query(" 
		SELECT beneficiary_name, account_number, customer_reference_number, net_amount, annexure_status, created_on, update_on, uploaded_to_sftp_on, returned_on, authorised_on, rejected_on, released_on
		FROM annexure_temp
		WHERE account_number = $accNo AND net_amount = $amount
		UNION ALL
		SELECT name_of_bene, account_number, customer_ref_numer, net_amount, annexure_status, created_on, updated_on, uploaded_to_sftp_on, returned_on, authorised_on, initiated_on, table_check
 		FROM unclaimed_temp
		WHERE id != $id AND ( account_number = $accNo AND net_amount = $amount )");
		//echo '<pre>==='; echo $this->db->last_query(); die;
		return $query->result();

	}

	function validateAmount_Old($accNo, $amount){

		$query1 = $this->db->select('account_number, net_amount, annexure_status, update_on')
		->from('annexure_temp')
		->where('account_number', $accNo)
		->where('net_amount', $amount)
		->get()->result();

		// echo '<pre>==='; echo $this->db->last_query(); die;

		$query2 = $this->db->select('account_number, net_amount, annexure_status, updated_on')
		->from('unclaimed_temp')
		->where('account_number', $accNo)
		->where('net_amount', $amount)
		->get()->result();
		
		//echo '<pre>==='; echo $this->db->last_query(); die;

		$query = array_merge($query1, $query2);

		// echo '<pre>==='; echo $this->db->last_query(); die;
		// echo '<pre>==='; print_r($query); die;

		return $query;
	}
	
		
	function getStatus($id){
		$this->db->select('is_error');
		$this->db->where('reference_number',$id);
		$query = $this->db->get('unclaimed_file_status');
		return $query->result_array();
		//echo $this->db->last_query(); die;

	}

	function updateCustRef($recordId, $refNo){
		$this->db->set('customer_ref_numer', $refNo);
		$this->db->where('id', $recordId);
		$this->db->update('unclaimed_temp'); 
		//echo '<pre>==='; echo $this->db->last_query(); die;
		return $this->db->affected_rows();
	}

 
}