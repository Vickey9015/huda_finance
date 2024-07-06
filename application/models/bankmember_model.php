<?php

class Bankmember_model extends CI_Model {
    public $error       = array();
    public $error_count = 0;
    public $user_type    = 0;
    
    public function __construct() 
    {
        parent::__construct();
    }
    
  
function getMemberDetails($startDate='',$toDate=''){
	    
		$condtion = ' ';
		if($startDate !='' ){
			$sdate = date('Y-m-d', strtotime($startDate));
			$condtion .= " AND DATE(u.created_on) >= '$sdate'";
		}
		if($toDate !='' ){
			$tdate = date('Y-m-d', strtotime($toDate));
			$condtion .= " AND  DATE(u.created_on) <= '$tdate'";
		}		
	    $select = "SELECT r.name AS role_name ,z.name AS zone_name,u.* FROM user u LEFT JOIN zone_master z ON z.id=u.zone_id INNER JOIN role r ON r.role_id=u.role_id  WHERE u.role_id IN (7,8) and u.is_active !=2 ";
        $query = $this->db->query($select);
		//echo $this->db->last_query(); die;
       return $results = $query->result_array();
// 	    $query ="SELECT u.id,u.* FROM user u
// 		 WHERE  1 ".$condtion." ORDER BY u.id DESC" ;
// 		$sql = $this->db->query($query);
		//echo $this->db->last_query(); die;
		
	//	return $results = $sql->result_array();
		
		//echo "<pre>===="; print_r($results); exit;
   }
   
   function getMemberList($id){
       $select="u.*";
	    $this->db->select($select);
        $this->db->from(TBL_USER ." u");
		$where = "(u.id= '$id')";
        $this->db->where($where);
        $query = $this->db->get();
		//echo $this->db->last_query(); die;
       return $results = $query->result_array();
// 	    $query ="SELECT * FROM user u
// 		 WHERE  u.id= $id" ;
// 		$sql = $this->db->query($query);
		//echo $this->db->last_query(); die;
		
	//	return $results = $sql->result_array();
		
		//echo "<pre>===="; print_r($results); exit;
   }
   			
			function UpdateMember($id,$UserUpdateArray){
	      
		//	echo "<pre>...$id"; print_r($UserUpdateArray); exit();
			$this->db->where('id',$id);   
			$res = $this->db->update('user', $UserUpdateArray);
   }
   
    function getByZone(){
	    $this->db->select("id, name");
	    $this->db->from("zone_master");
	    $query = $this->db->get();
	    return $query->result();
	}
   
}