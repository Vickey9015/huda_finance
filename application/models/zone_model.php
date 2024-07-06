<?php

class Zone_model extends CI_Model {
    public $error       = array();
    public $error_count = 0;
    public $user_type    = 0;
    
    public function __construct() 
    {
        parent::__construct();
    }
    
  
function getZoneDetails($startDate='',$toDate=''){
	    
		$condtion = ' ';
		if($startDate !='' ){
			$sdate = date('Y-m-d', strtotime($startDate));
			$condtion .= " AND DATE(z.created_on) >= '$sdate'";
		}
		if($toDate !='' ){
			$tdate = date('Y-m-d', strtotime($toDate));
			$condtion .= " AND  DATE(z.created_on) <= '$tdate'";
		}		
		$select="z.name,z.created_on,z.updated_on,z.id,a.account_number,a.zone_id,a.id as accountMasterId";
	    $this->db->select($select);
        $this->db->from('zone_master z');
        $this->db->join('account_master a','a.zone_id=z.id','inner');
		$where = "(1 ".$condtion.")";
        $this->db->where($where);
		$this->db->order_by("z.id", "DESC");
        $query = $this->db->get();
		//echo $this->db->last_query(); die;
       return $results = $query->result_array();
// 	    $query ="SELECT z.name,z.created_on,z.updated_on,z.id,a.account_number,a.zone_id,a.id as accountMasterId FROM zone_master z
// 		inner join account_master a on a.zone_id=z.id
// 		 WHERE  1 ".$condtion." ORDER BY z.id DESC" ;
// 		$sql = $this->db->query($query);
		//echo $this->db->last_query(); die;
		
	//	return $results = $sql->result_array();
		
		//echo "<pre>===="; print_r($results); exit;
   }
   
   function getZoneList($id){
       $select="z.name,z.created_on,z.updated_on,z.id,a.account_number,a.zone_id,a.id as accountMasterId";
	    $this->db->select($select);
        $this->db->from('zone_master z');
        $this->db->join('account_master a','a.zone_id=z.id','inner');
		$where = "(a.id= '$id')";
        $this->db->where($where);
		$this->db->order_by("a.id", "DESC");
        $query = $this->db->get();
		//echo $this->db->last_query(); die;
       return $results = $query->result_array();
// 	    $query ="SELECT z.name,z.created_on,z.updated_on,z.id,a.account_number,a.zone_id,a.id as accountMasterId FROM zone_master z
// 		inner join account_master a on a.zone_id=z.id
// 		 WHERE z.id= $id AND a.account_number=$account_number" ;
// 		$sql = $this->db->query($query);
		//echo $this->db->last_query(); die;
		
	//	return $results = $sql->result_array();
		
		//echo "<pre>===="; print_r($results); exit;
   }
   			
			function UpdateZone($id,$zoneid,$ZoneUpdateArray,$ZoneNameArray){
		//	echo "<pre>...$id"; print_r($ZoneUpdateArray); print_r($ZoneNameArray);exit();
			$this->db->where('id',$id);   
			$res = $this->db->update('account_master', $ZoneUpdateArray);
			$this->db->where('id',$zoneid);   
			$res = $this->db->update('zone_master', $ZoneNameArray);
   }
   
}