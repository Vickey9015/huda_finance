<?php

class Annexure_model extends CI_Model {
    public $error       = array();
    public $error_count = 0;
    public $user_type    = 0;
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->library('session');
        $session_data = $this->session->all_userdata();
        //print_r($session_data);die;
        $this->zones = $session_data['zones'];
        foreach($this->zones as $zo){
	        $zone_id.= $zo['id'].',';
	        $i++;
	    }    
	    $this->zone_id = rtrim($zone_id,',');
    }
    
  
function getAllReport($startDate='',$toDate='',$annexure_type='',$annexure_status='',$Fromamount='',$toamount='',$beneficiary_name='',$customer_reference_number='',$Date=''){
	//echo "<pre>===="; print_r($_REQUEST); exit;
           $dateCond = $_REQUEST['Date'];
                $condtion = ' ';
		

                if($startDate !='' ){
			$sdate = date('Y-m-d', strtotime($startDate));
			$condtion .= " AND DATE(a.".$dateCond.") >= '$sdate'";
		}
		if($toDate !='' ){
			$tdate = date('Y-m-d', strtotime($toDate));
			$condtion .= " AND  DATE(a.".$dateCond.") <= '$tdate'";
		}
if($Fromamount !='' ){
			$condtion .= " AND  a.net_amount >= '$Fromamount'";
		}
if($toamount !='' ){
			$condtion .= " AND  a.net_amount <= '$toamount'";
		}
if($beneficiary_name !='' ){
			$condtion .= " AND  a.beneficiary_name = '$beneficiary_name'";
		}
if($customer_reference_number !='' ){
			$condtion .= " AND  a.customer_reference_number = '$customer_reference_number'";
		}
if($annexure_type !='' && $annexure_type >0 ){
           if($annexure_type ==1){
				$annexure_type ='1';
            $condtion .= " AND a.annexure_type='$annexure_type'";
			}
         else if($annexure_type ==2){
				$annexure_type ='2';
            $condtion .= " AND a.annexure_type='$annexure_type'";
            
			}
			else if($annexure_type ==3){
				$annexure_type ='3';
            $condtion .= " AND a.annexure_type='$annexure_type'";
            
			}
			else if($annexure_type ==4){
				$annexure_type ='4';
            $condtion .= " AND a.annexure_type='$annexure_type'";
            
			}
			else if($annexure_type ==5){
				$annexure_type ='5';
            $condtion .= " AND a.annexure_type='$annexure_type'";
            
			}
			
		}  
        if($annexure_status !='' && $annexure_status >0 ){
                $condtion .= " AND a.annexure_status='$annexure_status'";
		}   
		$select="a.*";
	$this->db->select($select);
    $this->db->from(TBL_ANNEXURE_TEMP ." a");
		$where = "(1 ".$condtion.")";
        $this->db->where($where);
		$this->db->order_by("a.id", "DESC");
        $query = $this->db->get();
		//echo $this->db->last_query(); die;
        return $results = $query->result_array();
//echo "<pre>===="; print_r($condtion); exit;	   	
//  $query ="SELECT  * FROM ".TBL_ANNEXURE_TEMP." a WHERE 1 ".$condtion." ORDER BY a.id DESC " ;
// 		$sql = $this->db->query($query);
// 		echo $this->db->last_query(); die;
		
// 		return $results = $sql->result_array();
		
		//echo "<pre>===="; print_r($results); exit;
   }

   function getOrignallist($startDate='',$toDate='',$annexure_status='',$Date='',$zone=''){
	//echo "<pre>===="; print_r($_REQUEST); exit;
	if($zone == 'All' or $zone == null or $zone = ''){
        $zone = $this->zone_id;
    }
           $dateCond = $_REQUEST['Date'];
                $condtion = ' ';
		

        if($startDate !='' ){
			$sdate = date('Y-m-d', strtotime($startDate));
			$condtion .= " AND DATE(a.".$dateCond.") >= '$sdate 00:00:00'";
		}
		if($toDate !='' ){
			$tdate = date('Y-m-d', strtotime($toDate));
			$condtion .= " AND  DATE(a.".$dateCond.") <= '$tdate 24:00:00'";
		}
	    if($annexure_status !='' && $annexure_status >0 ){
                $condtion .= " AND a.annexure_status='$annexure_status'";
		}       

/*if($zone !='' && $zone >0 & strlen($zone) == 1){
          if($zone ==1){
				$zone ='1';
            $condtion .= " AND a.zone_id='$zone'";
			}
         else if($zone ==2){
				$zone ='2';
            $condtion .= " AND a.zone_id='$zone'";
            
			}
			else if($zone ==3){
				$zone ='3';
            $condtion .= " AND a.zone_id='$zone'";
            
			}
			else if($zone ==4){
				$zone ='4';
            $condtion .= " AND a.zone_id='$zone'";
            
			}
			else if($zone ==5){
				$zone ='5';
            $condtion .= " AND a.zone_id='$zone'";
            
			}
		} */
		if($zone !=''){
		    $condtion .= " AND a.zone_id in ($zone)";  
		}
		
		$select="a.*,z.name as zone_name";
	    $this->db->select($select);
        $this->db->from(TBL_ANNEXURE_TEMP ." a");
        $this->db->join('zone_master as z', 'z.id = a.zone_id', 'left');
		$where = "(a.annexure_type =1 ".$condtion.")";
        $this->db->where($where);
		$this->db->order_by("a.id", "DESC");
        $query = $this->db->get();
		//echo $this->db->last_query(); 
       return $results = $query->result_array();
// 	   	 $query ="SELECT  * FROM ".TBL_ANNEXURE_TEMP."  a WHERE  a.annexure_type=1 ".$condtion." order by a.id DESC" ;
// 		$sql = $this->db->query($query);
// 		//echo $this->db->last_query(); die;
		
// 		return $results = $sql->result_array();
		
		//echo "<pre>===="; print_r($results); exit;
   }
      
function getHighCourtlist($startDate='',$toDate='',$annexure_status='',$Date='',$zone=''){
	//echo "<pre>===="; print_r($_REQUEST); exit;
           $dateCond = $_REQUEST['Date'];
                $condtion = ' ';
		

                if($startDate !='' ){
			$sdate = date('Y-m-d', strtotime($startDate));
			$condtion .= " AND DATE(a.".$dateCond.") >= '$sdate'";
		}
		if($toDate !='' ){
			$tdate = date('Y-m-d', strtotime($toDate));
			$condtion .= " AND  DATE(a.".$dateCond.") <= '$tdate'";
		}
	    if($annexure_status !='' && $annexure_status >0 ){
                $condtion .= " AND a.annexure_status='$annexure_status'";
		} 
	      		     
        if($zone !=''){
		    $condtion .= " AND a.zone_id in ($zone)";  
		}
        $select="a.*,z.name as zone_name";
	    $this->db->select($select);
        $this->db->from(TBL_ANNEXURE_TEMP ." a");
        $this->db->join('zone_master as z', 'z.id = a.zone_id', 'left');
		$where = "(a.annexure_type =3 ".$condtion.")";
        $this->db->where($where);
		$this->db->order_by("a.id", "DESC");
        $query = $this->db->get();
		//echo $this->db->last_query(); die;
       return $results = $query->result_array();

// 	   	 $query ="SELECT  * FROM ".TBL_ANNEXURE_TEMP."  a WHERE  a.annexure_type=3 ".$condtion." order by a.id DESC" ;
// 		$sql = $this->db->query($query);
// 		//echo $this->db->last_query(); die;
		
// 		return $results = $sql->result_array();
		
		//echo "<pre>===="; print_r($results); exit;
   }
function getLowercourtlist($startDate='',$toDate='',$annexure_status='',$Date='',$zone=''){
	//echo "<pre>===="; print_r($_REQUEST); exit;
           $dateCond = $_REQUEST['Date'];
                $condtion = ' ';
		

                if($startDate !='' ){
			$sdate = date('Y-m-d', strtotime($startDate));
			$condtion .= " AND DATE(a.".$dateCond.") >= '$sdate'";
		}
		if($toDate !='' ){
			$tdate = date('Y-m-d', strtotime($toDate));
			$condtion .= " AND  DATE(a.".$dateCond.") <= '$tdate'";
		}
	    if($annexure_status !='' && $annexure_status >0 ){
                $condtion .= " AND a.annexure_status='$annexure_status'";
		}  
	      		    
        if($zone !=''){
		    $condtion .= " AND a.zone_id in ($zone)";  
		}  
        $select="a.*,z.name as zone_name";
	    $this->db->select($select);
        $this->db->from(TBL_ANNEXURE_TEMP ." a");
        $this->db->join('zone_master as z', 'z.id = a.zone_id', 'left');
		$where = "(a.annexure_type =2 ".$condtion.")";
        $this->db->where($where);
		$this->db->order_by("a.id", "DESC");
        $query = $this->db->get();
		//echo $this->db->last_query(); die;
       return $results = $query->result_array();
 
// 	   	 $query ="SELECT  * FROM ".TBL_ANNEXURE_TEMP."  a WHERE  a.annexure_type=2 ".$condtion." order by a.id DESC" ;
// 		$sql = $this->db->query($query);
// 		//echo $this->db->last_query(); die;
		
// 		return $results = $sql->result_array();
		
		//echo "<pre>===="; print_r($results); exit;
   }
function getSupremecourtlist($startDate='',$toDate='',$annexure_status='',$Date='',$zone=''){
    //echo $annexure_status;die;
	//echo "<pre>===="; print_r($_REQUEST); exit;
           $dateCond = $_REQUEST['Date'];
                $condtion = ' ';
		

                if($startDate !='' ){
			$sdate = date('Y-m-d', strtotime($startDate));
			$condtion .= " AND DATE(a.".$dateCond.") >= '$sdate'";
		}
		if($toDate !='' ){
			$tdate = date('Y-m-d', strtotime($toDate));
			$condtion .= " AND  DATE(a.".$dateCond.") <= '$tdate'";
		}
	    if($annexure_status !='' && $annexure_status >0 ){
            $condtion .= " AND a.annexure_status='$annexure_status'";
		} 
	      		   
        if($zone !=''){
		    $condtion .= " AND a.zone_id in ($zone)";  
		} 
        $select="a.*,z.name as zone_name";
	    $this->db->select($select);
        $this->db->from(TBL_ANNEXURE_TEMP ." a");
        $this->db->join('zone_master as z', 'z.id = a.zone_id', 'left');
		$where = "(a.annexure_type =4 ".$condtion.")";
        $this->db->where($where);
		$this->db->order_by("a.id", "DESC");
        $query = $this->db->get();
		//echo $this->db->last_query(); die;
       return $results = $query->result_array();
  
// 	   	 $query ="SELECT  * FROM ".TBL_ANNEXURE_TEMP."  a WHERE  a.annexure_type=4 ".$condtion." order by a.id DESC" ;
// 		$sql = $this->db->query($query);
// 		//echo $this->db->last_query(); die;
		
// 		return $results = $sql->result_array();
		
		//echo "<pre>===="; print_r($results); exit;
   }
function DDReport($startDate='',$toDate='',$annexure_status='',$Date='',$zone=''){
	//echo "<pre>===="; print_r($_REQUEST); exit;
           $dateCond = $_REQUEST['Date'];
                $condtion = ' ';
		

                if($startDate !='' ){
			$sdate = date('Y-m-d', strtotime($startDate));
			$condtion .= " AND DATE(a.".$dateCond.") >= '$sdate'";
		}
		if($toDate !='' ){
			$tdate = date('Y-m-d', strtotime($toDate));
			$condtion .= " AND  DATE(a.".$dateCond.") <= '$tdate'";
		}
	    if($annexure_status !='' && $annexure_status >0 ){
                $condtion .= " AND a.annexure_status='$annexure_status'";
		} 
	      		     

        if($zone !=''){
		    $condtion .= " AND a.zone_id in ($zone)";  
		}
        $select="a.*,z.name as zone_name";
	    $this->db->select($select);
        $this->db->from(TBL_ANNEXURE_TEMP ." a");
        $this->db->join('zone_master as z', 'z.id = a.zone_id', 'left');
		$where = "(a.annexure_type =5 ".$condtion.")";
        $this->db->where($where);
		$this->db->order_by("a.id", "DESC");
        $query = $this->db->get();
		//echo $this->db->last_query(); die;
       return $results = $query->result_array();
   }
   
   function AllTypeReport($annexure_type= 5,$startDate='',$toDate='',$annexure_status='',$Date='',$zone=''){
	//echo "<pre>===="; print_r($_REQUEST); exit;
           $dateCond = $_REQUEST['Date'];
                $condtion = ' ';
		

                if($startDate !='' ){
			$sdate = date('Y-m-d', strtotime($startDate));
			$condtion .= " AND DATE(a.".$dateCond.") >= '$sdate'";
		}
		if($toDate !='' ){
			$tdate = date('Y-m-d', strtotime($toDate));
			$condtion .= " AND  DATE(a.".$dateCond.") <= '$tdate'";
		}
	    if($annexure_status !='' && $annexure_status >0 ){
                $condtion .= " AND a.annexure_status='$annexure_status'";
		} 
	      		     

        if($zone !=''){
		    $condtion .= " AND a.zone_id in ($zone)";  
		}
        $select="a.*,z.name as zone_name";
	    $this->db->select($select);
        $this->db->from(TBL_ANNEXURE_TEMP ." a");
        $this->db->join('zone_master as z', 'z.id = a.zone_id', 'left');
		$where = "(a.annexure_type = ".$annexure_type.$condtion.")";
        $this->db->where($where);
		$this->db->order_by("a.id", "DESC");
        $query = $this->db->get();
		//echo $this->db->last_query(); die;
       return $results = $query->result_array();
   }

}