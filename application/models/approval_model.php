<?php

class Approval_model extends CI_Model {
    public $error       = array();
    public $error_count = 0;
    public $user_type    = 0;
    
    public function __construct() 
    {
        parent::__construct();
    }
    
   function getapprovalList($startDate='',$toDate='',$status=''){
	
                $condtion = ' ';
		if($startDate !='' ){
			$sdate = date('Y-m-d', strtotime($startDate));
			$condtion .= " AND DATE(a.created_on) >= '$sdate'";
		}
		if($toDate !='' ){
			$tdate = date('Y-m-d', strtotime($toDate));
			$condtion .= " AND  DATE(a.created_on) <= '$tdate'";
		}
	    /*$query ="SELECT a.maker_name,a.file_name,a.annexure_type,COUNT(a.reference_number) AS totalRecord,a.reference_number,a.created_on
        FROM ".TBL_ANNEXURE_TEMP."  a  WHERE 1
".$condtion."  GROUP BY a.reference_number ORDER BY a.created_on DESC" ;*/
$select="a.maker_name,a.file_name,a.annexure_type,COUNT(a.reference_number) AS totalRecord,COUNT(CASE WHEN a.annexure_status = 2 then 1 ELSE NULL END) AS with_checker,COUNT(CASE WHEN a.annexure_status = 3 then 1 ELSE NULL END) AS with_releaser,COUNT(CASE WHEN a.annexure_status = 4 then 1 ELSE NULL END) AS rejected,COUNT(CASE WHEN a.annexure_status = 5 then 1 ELSE NULL END) AS pulled,COUNT(CASE WHEN a.annexure_status = 6 then 1 ELSE NULL END) AS returned,a.reference_number,a.created_on";
	    $this->db->select($select);
        $this->db->from(TBL_ANNEXURE_TEMP ." a");
		$where = "(1 ".$condtion.")";
        $this->db->where($where);
		$this->db->group_by('a.reference_number');
		$this->db->order_by("a.id", "DESC");
        $query = $this->db->get();
	//	echo $this->db->last_query(); die;
       return $results = $query->result_array();
// 	$query ="SELECT a.maker_name,a.file_name,a.annexure_type,COUNT(a.reference_number) AS totalRecord,COUNT(CASE WHEN a.annexure_status = 2 then 1 ELSE NULL END) AS with_checker,COUNT(CASE WHEN a.annexure_status = 3 then 1 ELSE NULL END) AS with_releaser,COUNT(CASE WHEN a.annexure_status = 4 then 1 ELSE NULL END) AS rejected,COUNT(CASE WHEN a.annexure_status = 5 then 1 ELSE NULL END) AS pulled,COUNT(CASE WHEN a.annexure_status = 6 then 1 ELSE NULL END) AS returned,a.reference_number,a.created_on
//         FROM ".TBL_ANNEXURE_TEMP."  a WHERE 1
// ".$condtion." GROUP BY a.reference_number ORDER BY a.created_on DESC";

// 		$sql = $this->db->query($query);
// 		//echo $this->db->last_query(); die;
		
// 		return $results = $sql->result_array();
		
		//echo "<pre>===="; print_r($results); exit;
   }
   
   function getInnerList($ref_no){
	    $select="a.*";
	    $this->db->select($select);
        $this->db->from(TBL_ANNEXURE_TEMP ." a");
		$where = "(a.reference_number ='$ref_no')";
        $this->db->where($where);
		$this->db->order_by("a.id", "DESC");
        $query = $this->db->get();
		//echo $this->db->last_query(); die;
       return $results = $query->result_array();
// 	    $query ="SELECT  * FROM ".TBL_ANNEXURE_TEMP."  a WHERE a.reference_number='$ref_no'  ORDER BY id DESC" ;
// 		$sql = $this->db->query($query);
// 	//	echo $this->db->last_query(); die;
		
// 		return $results = $sql->result_array();
		
		//echo "<pre>===="; print_r($results); exit;
   }
   
   function updateAnnexureStatus($ref_no,$annexureArray){
	 //echo "<pre>=$ref_no==="; print_r($annexureArray);exit;
	  
	    $this->db->where('customer_reference_number', $ref_no);
		$this->db->where_not_in('annexure_status',[4,5]);
		$res = $this->db->update(TBL_ANNEXURE_TEMP, $annexureArray);
		//echo "<pre>===="; print_r($results); exit;
   }
   
   function updateAnnexureStatusApprovalList($ref_no,$annexureArray,$current_annexure_status){
	 //echo "<pre>=$ref_no==="; print_r($annexureArray);exit;
	  
	    $this->db->where('reference_number', $ref_no);
	    $this->db->where('annexure_status', $current_annexure_status);
		$res = $this->db->update(TBL_ANNEXURE_TEMP, $annexureArray);
		//echo "<pre>===="; print_r($results); exit;
   }

function getApproved($startDate='',$toDate=''){
	
                $condtion = ' ';
		if($startDate !='' ){
			$sdate = date('Y-m-d', strtotime($startDate));
			$condtion .= " AND DATE(a.created_on) >= '$sdate'";
		}
		if($toDate !='' ){
			$tdate = date('Y-m-d', strtotime($toDate));
			$condtion .= " AND  DATE(a.created_on) <= '$tdate'";
		}
		$select="a.file_name,a.annexure_type,COUNT(a.reference_number) AS totalRecord,COUNT(CASE WHEN a.annexure_status = 2 then 1 ELSE NULL END) AS with_checker,COUNT(CASE WHEN a.annexure_status = 3 then 1 ELSE NULL END) AS with_releaser,COUNT(CASE WHEN a.annexure_status = 4 then 1 ELSE NULL END) AS rejected,COUNT(CASE WHEN a.annexure_status = 5 then 1 ELSE NULL END) AS pulled,COUNT(CASE WHEN a.annexure_status = 6 then 1 ELSE NULL END) AS returned,a.reference_number,a.created_on";
	    $this->db->select($select);
        $this->db->from(TBL_ANNEXURE_TEMP ." a");
		$where = "(a.annexure_status=7 ".$condtion.")";
        $this->db->where($where);
		$this->db->group_by('a.reference_number');
		$this->db->order_by("a.created_on", "DESC");
        $query = $this->db->get();
		//echo $this->db->last_query(); die;
       return $results = $query->result_array();
// 	    $query ="SELECT a.file_name,a.annexure_type,COUNT(a.reference_number) AS totalRecord,COUNT(CASE WHEN a.annexure_status = 2 then 1 ELSE NULL END) AS with_checker,COUNT(CASE WHEN a.annexure_status = 3 then 1 ELSE NULL END) AS with_releaser,COUNT(CASE WHEN a.annexure_status = 4 then 1 ELSE NULL END) AS rejected,COUNT(CASE WHEN a.annexure_status = 5 then 1 ELSE NULL END) AS pulled,COUNT(CASE WHEN a.annexure_status = 6 then 1 ELSE NULL END) AS returned,a.reference_number,a.created_on
//         FROM ".TBL_ANNEXURE_TEMP."  a WHERE a.annexure_status='7'
// ".$condtion."  GROUP BY a.reference_number ORDER BY a.created_on DESC" ;
// 		$sql = $this->db->query($query);
// 		//echo $this->db->last_query(); die;
		
// 		return $results = $sql->result_array();
		
		//echo "<pre>===="; print_r($results); exit;
   }
   
    function updateAllAnnexure($ref_no,$annexureArray){
	 //echo "<pre>=$ref_no==="; print_r($annexureArray);exit;
	  
	    $this->db->where('reference_number', $ref_no);
		$this->db->where('annexure_status', 3);
		$res = $this->db->update(TBL_ANNEXURE_TEMP, $annexureArray);
		//echo $this->db->last_query(); die;
		//echo "<pre>===="; print_r($results); exit;
   }
   
   
}