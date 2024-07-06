<?php

class Member_model extends CI_Model {
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
	    $select = "SELECT r.name AS role_name ,z.name AS zone_name,u.* FROM user u INNER JOIN zone_master z ON z.id=u.zone_id INNER JOIN role r ON r.role_id=u.role_id where u.role_id in (3,4,5,6,9)";
        $query = $this->db->query($select);
		//echo $this->db->last_query(); die;
        $results = $query->result_array();
        $i = 0;
        foreach($results as $user){
            $user_id = $user['id'];
            $select1 = "SELECT zm.zone_id,z.name from user_zone_mapping as zm left join zone_master as z on zm.zone_id = z.id where zm.user_id = $user_id and zm.is_active = 1";
            $query1 = $this->db->query($select1);
            $results1 = $query1->result_array();
            $zones = array();
            $j= 0 ;
            foreach($results1 as $zone){
                $zones[$j] = $zone['name'];
                $j += 1;
            }
            
            $results[$i]['zone_name'] = implode($zones,',');
            //echo "<pre>===="; print_r($results1); 
            $i += 1;
        }
// 	    $query ="SELECT u.id,u.* FROM user u
// 		 WHERE  1 ".$condtion." ORDER BY u.id DESC" ;
// 		$sql = $this->db->query($query);
		//echo $this->db->last_query(); die;
		
	//	return $results = $sql->result_array();
		return $results;
		//echo "<pre>===="; print_r($results); exit;
   }
   function getMemberDetailsByBankChecker($startDate='',$toDate=''){
	    
		$condtion = ' ';
		if($startDate !='' ){
			$sdate = date('Y-m-d', strtotime($startDate));
			$condtion .= " AND DATE(u.created_on) >= '$sdate'";
		}
		if($toDate !='' ){
			$tdate = date('Y-m-d', strtotime($toDate));
			$condtion .= " AND  DATE(u.created_on) <= '$tdate'";
		}		
	    $select = "SELECT r.name AS role_name ,z.name AS zone_name,u.* FROM user u INNER JOIN zone_master z ON z.id=u.zone_id INNER JOIN role r ON r.role_id=u.role_id  WHERE u.role_id IN (3,4,5,6,9) and u.is_active !=0 and u.is_active != 4";
        $query = $this->db->query($select);
		//echo $this->db->last_query(); die;
       $results = $query->result_array();
	   $i = 0;
        foreach($results as $user){
            $user_id = $user['id'];
            $select1 = "SELECT zm.zone_id,z.name from user_zone_mapping as zm left join zone_master as z on zm.zone_id = z.id where zm.user_id = $user_id and zm.is_active = 1";
            $query1 = $this->db->query($select1);
            $results1 = $query1->result_array();
            $zones = array();
            $j= 0 ;
            foreach($results1 as $zone){
                $zones[$j] = $zone['name'];
                $j += 1;
            }
            
            $results[$i]['zone_name'] = implode($zones,',');
            //echo "<pre>===="; print_r($results1); 
            $i += 1;
        }
		return $results;
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
	      
			//echo "<pre>...$id"; print_r($UserUpdateArray);
			$this->db->where('id',$id);   
			$res = $this->db->update('user', $UserUpdateArray);
		//	echo $this->db->last_query(); die;
   }
 function checkUserZonesId($user_id){
            $query =$this->db->select('id,zone_id')
                    ->from('user_zone_mapping')
                    ->where('user_id',$user_id)
                    ->where('is_active',1);
            $result =  $query->get()->result_array();
            return $result;
        }
   function updateZoneidMember($id,$zone_value){
       
                $this-> db->where('user_id', $id);
                $this-> db->where('is_active', 1);
                $query= $this->db->delete('user_zone_mapping');
            
       	foreach($zone_value as $key=>$uz){
             // echo"<pre>";print_r($uz);exit;
		 $UserinsertArray =array(
					'user_id'      =>$id,
					'zone_id'      =>$uz,
					'updated_on'   => date('Y-m-d H:i:s')
					);
        
        $res = $this->db->insert('user_zone_mapping', $UserinsertArray);
		}
          
}
   
   
    function getByZone(){
	    $this->db->select("id, name");
	    $this->db->from("zone_master");
	    $query = $this->db->get();
	    return $query->result_array();
	}
   
}