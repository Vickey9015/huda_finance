<?php

class Mandates_model extends CI_Model {
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
    
   function getMandateList($zone_id='',$startDate='',$toDate='',$annexure_type=''){
       //echo $zone_id; die;
        $i=0;
        //echo "<pre>";print_r($zone_id);
        $condtion = '';
        $annexure_status ='';
        if($zone_id =='All'){
            foreach($this->zones as $zo){
    	        $zone_id.= $zo['id'].',';
    	        $i++;
    	    } 
            $zone_id = rtrim($zone_id,',');
        }else{
            
		    $condtion .= " AND  zone_id in ($zone_id)";
                   
		}
		if($annexure_status ='' ){
			 $condtion .= " AND  annexure_status in (4,5)";
		}
		if($startDate !='' ){
			$sdate = date('Y-m-d', strtotime($startDate));
			$condtion .= " AND DATE(a.created_on) >= '$sdate'";
		}
		if($toDate !='' ){
			$tdate = date('Y-m-d', strtotime($toDate));
			$condtion .= " AND  DATE(a.created_on) <= '$tdate'";
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
            
			}else if($annexure_type ==6){
				$annexure_type ='6';
            $condtion .= " AND a.annexure_type='$annexure_type'";
            
			}else if($annexure_type ==7){
				$annexure_type ='7';
            $condtion .= " AND a.annexure_type='$annexure_type'";
            
			}else if($annexure_type ==8){
				$annexure_type ='8';
            $condtion .= " AND a.annexure_type='$annexure_type'";
            
			}
			
		}
		$select="(CASE WHEN a.annexure_status = 6 then a.returned_on ELSE NULL END) as returned_on,MAX(a.rejected_on) AS rejected_on,a.id,a.file_name,a.maker_name,a.annexure_type,COUNT(a.reference_number) AS totalRecord,SUM(a.net_amount) AS totalRecord_sum,COUNT(CASE WHEN a.annexure_status = 2 then 1 ELSE NULL END) AS with_checker,SUM(CASE WHEN a.annexure_status = 2 then net_amount ELSE NULL END) AS with_checker_sum,COUNT(CASE WHEN a.annexure_status = 3 then 1 ELSE NULL END) AS with_releaser,SUM(CASE WHEN a.annexure_status = 3 then net_amount ELSE NULL END) AS with_releaser_sum,COUNT(CASE WHEN a.annexure_status = 4 then 1 ELSE NULL END) AS rejected_by_LAO,SUM(CASE WHEN a.annexure_status = 4 then net_amount ELSE NULL END) AS rejected_by_LAO_sum,COUNT(CASE WHEN a.annexure_status = 5 then 1 ELSE NULL END) AS rejected_by_releaser,SUM(CASE WHEN a.annexure_status = 5 then net_amount ELSE NULL END) AS rejected_by_releaser_sum,COUNT(CASE WHEN a.annexure_status = 6 then 1 ELSE NULL END) AS returned,SUM(CASE WHEN a.annexure_status = 6 then net_amount ELSE NULL END) AS returned_sum,COUNT(CASE WHEN a.annexure_status = 6 and a.is_return = 0 then 1 ELSE NULL END) AS failed,SUM(CASE WHEN a.annexure_status = 6 and a.is_return = 0 then net_amount ELSE NULL END) AS failed_sum,COUNT(CASE WHEN a.annexure_status = 7 then 1 ELSE NULL END) AS released,SUM(CASE WHEN a.annexure_status = 7 then net_amount ELSE NULL END) AS released_sum,COUNT(CASE WHEN a.annexure_status = 8 then 1 ELSE NULL END) AS in_process_to_releaser,SUM(CASE WHEN a.annexure_status = 8 then net_amount ELSE NULL END) AS in_process_to_releaser_sum,COUNT(CASE WHEN a.annexure_status = 9 then 1 ELSE NULL END) AS in_process_to_disbursement,SUM(CASE WHEN a.annexure_status = 9 then net_amount ELSE NULL END) AS in_process_to_disbursement_sum,COUNT(CASE WHEN a.is_resubmitted = 1 then 1 ELSE NULL END) AS reinitiated,SUM(CASE WHEN a.is_resubmitted = 1 then net_amount ELSE NULL END) AS reinitiated_sum,COUNT(CASE WHEN a.annexure_status = 11 then 1 ELSE NULL END) AS success,SUM(CASE WHEN a.annexure_status = 11 then net_amount ELSE NULL END) AS success_sum,a.reference_number,a.created_on,a.reason";
	    $this->db->select($select);
        $this->db->from(TBL_ANNEXURE_TEMP ." a");
		$where = "(1 ".$condtion.")";
        $this->db->where($where);
		$this->db->group_by("a.reference_number");
		$this->db->order_by("a.id", "DESC");
        $query = $this->db->get();
	  //echo $this->db->last_query(); die;
	   
       return $results = $query->result_array();
   }
   function getMandateListByStatus($zone_id='',$annexure_status='',$startDate='',$toDate='',$annexure_type=''){
       //echo $zone_id; die;
        $i=0;
        //echo "<pre>";print_r($annexure_status);exit;
        $condtion = '';
        if($zone_id =='All'){
            foreach($this->zones as $zo){
    	        $zone_id.= $zo['id'].',';
    	        $i++;
    	    } 
            $zone_id = rtrim($zone_id,',');
        }else{
            
		    $condtion .= " AND  zone_id in ($zone_id)";
                   
		}
		if($annexure_status !='' ){
           if($annexure_status ==4){
				$annexure_status =4;
            $condtion .= " AND a.annexure_status=$annexure_status";
			}
			elseif($annexure_status ==5){
				$annexure_status =5;
            $condtion .= " AND a.annexure_status=$annexure_status";
			}
		}
		if($startDate !='' ){
			$sdate = date('Y-m-d', strtotime($startDate));
			$condtion .= " AND DATE(a.created_on) >= '$sdate'";
		}
		if($toDate !='' ){
			$tdate = date('Y-m-d', strtotime($toDate));
			$condtion .= " AND  DATE(a.created_on) <= '$tdate'";
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
		
		$select="(CASE WHEN a.annexure_status = 6 then a.returned_on ELSE NULL END) as returned_on,MAX(a.rejected_on) AS rejected_on,a.id,a.file_name,a.maker_name,a.annexure_type,COUNT(a.reference_number) AS totalRecord,SUM(a.net_amount) AS totalRecord_sum,COUNT(CASE WHEN a.annexure_status = 2 then 1 ELSE NULL END) AS with_checker,SUM(CASE WHEN a.annexure_status = 2 then net_amount ELSE NULL END) AS with_checker_sum,COUNT(CASE WHEN a.annexure_status = 3 then 1 ELSE NULL END) AS with_releaser,SUM(CASE WHEN a.annexure_status = 3 then net_amount ELSE NULL END) AS with_releaser_sum,COUNT(CASE WHEN a.annexure_status = 4 then 1 ELSE NULL END) AS rejected_by_LAO,SUM(CASE WHEN a.annexure_status = 4 then net_amount ELSE NULL END) AS rejected_by_LAO_sum,COUNT(CASE WHEN a.annexure_status = 5 then 1 ELSE NULL END) AS rejected_by_releaser,SUM(CASE WHEN a.annexure_status = 5 then net_amount ELSE NULL END) AS rejected_by_releaser_sum,COUNT(CASE WHEN a.annexure_status = 6 then 1 ELSE NULL END) AS returned,SUM(CASE WHEN a.annexure_status = 6 then net_amount ELSE NULL END) AS returned_sum,COUNT(CASE WHEN a.annexure_status = 6 and a.is_return = 0 then 1 ELSE NULL END) AS failed,SUM(CASE WHEN a.annexure_status = 6 and a.is_return = 0 then net_amount ELSE NULL END) AS failed_sum,COUNT(CASE WHEN a.annexure_status = 7 then 1 ELSE NULL END) AS released,SUM(CASE WHEN a.annexure_status = 7 then net_amount ELSE NULL END) AS released_sum,COUNT(CASE WHEN a.annexure_status = 8 then 1 ELSE NULL END) AS in_process_to_releaser,SUM(CASE WHEN a.annexure_status = 8 then net_amount ELSE NULL END) AS in_process_to_releaser_sum,COUNT(CASE WHEN a.annexure_status = 9 then 1 ELSE NULL END) AS in_process_to_disbursement,SUM(CASE WHEN a.annexure_status = 9 then net_amount ELSE NULL END) AS in_process_to_disbursement_sum,COUNT(CASE WHEN a.is_resubmitted = 1 then 1 ELSE NULL END) AS reinitiated,SUM(CASE WHEN a.is_resubmitted = 1 then net_amount ELSE NULL END) AS reinitiated_sum,COUNT(CASE WHEN a.annexure_status = 11 then 1 ELSE NULL END) AS success,SUM(CASE WHEN a.annexure_status = 11 then net_amount ELSE NULL END) AS success_sum,a.reference_number,a.created_on,a.reason";
	    $this->db->select($select);
        $this->db->from(TBL_ANNEXURE_TEMP ." a");
		$where = "(1 ".$condtion.")";
        $this->db->where($where);
		$this->db->group_by("a.reference_number");
		$this->db->order_by("a.id", "DESC");
        $query = $this->db->get();
	   //echo $this->db->last_query(); die;
	   
       return $results = $query->result_array();
   }
   
   function getReturnedMandateList($zone_id='',$startDate='',$toDate='',$annexure_type=''){
       //echo $zone_id; die;
        $i=0;
        //echo "<pre>";print_r($zone_id);
        $condtion = '';
        if($zone_id =='All'){
            foreach($this->zones as $zo){
    	        $zone_id.= $zo['id'].',';
    	        $i++;
    	    } 
            $zone_id = rtrim($zone_id,',');
        }else{
            
		    $condtion .= " AND  zone_id in ($zone_id)";
                   
		}
		if($startDate !='' ){
			$sdate = date('Y-m-d', strtotime($startDate));
			$condtion .= " AND DATE(a.created_on) >= '$sdate'";
		}
		if($toDate !='' ){
			$tdate = date('Y-m-d', strtotime($toDate));
			$condtion .= " AND  DATE(a.created_on) <= '$tdate'";
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
	$where = "(1 ".$condtion.")";	
		$query ="SELECT
  `a`.`returned_on`,
  `a`.`id`,
  `a`.`file_name`,
  `a`.`maker_name`,
  `a`.`annexure_type`,
  COUNT(a.reference_number) AS totalRecord,
  SUM(a.net_amount)      AS totalRecord_sum,
  anx_return.returned    AS returned,
  anx_return.returned_sum    AS returned_sum,
 `a`.`reference_number`,
  `a`.`created_on`,
  `a`.`reason`
FROM (`annexure_temp` a)
  LEFT JOIN (SELECT
               b.reference_number,
               COUNT(CASE WHEN b.annexure_status = 6 THEN 1 ELSE NULL END) AS returned,
               SUM(CASE WHEN b.annexure_status = 6 THEN net_amount ELSE NULL END) AS returned_sum
             FROM annexure_temp b
             WHERE b.annexure_status = 6
             GROUP BY b.reference_number) AS anx_return
    ON anx_return.reference_number = a.reference_number
WHERE $where 
GROUP BY `a`.`reference_number`
ORDER BY `a`.`id` DESC";
	
	    $sql = $this->db->query($query);
  	   // $this->db->last_query(); die;
		
		return $results = $sql->result_array();
     
   }
   
   function getInnerList($zone_id,$ref_no){
              $status = null;
          if($this->uri->segment(5)){
	      	$status = $this->uri->segment(5);
	      	$length = strlen($status);
	      }
	      
	      if($status && $length >= 1 && $length <= 2){
	   $select="a.*,z.name as zone_name";
	    $this->db->select($select);
        $this->db->from(TBL_ANNEXURE_TEMP ." a");
        $this->db->join('zone_master as z', 'z.id = a.zone_id', 'left');
        if($status == 10){
            if($this->role_id == 4){
                $where = "(a.reference_number ='$ref_no' and a.is_resubmitted= 1 and a.annexure_status=$status  and a.zone_id in ($zone_id))";
            }
            else if($this->role_id == 5 or $this->role_id == 9){
                $where = "(a.reference_number ='$ref_no' and a.is_resubmitted= 1 and a.annexure_status= 3  and a.zone_id in ($zone_id))";
            }else{
				$where = "(a.reference_number ='$ref_no' and a.is_resubmitted= 1 and a.annexure_status= 10 and a.zone_id in ($zone_id))";
			}
        }else{
		    $where = "(a.reference_number ='$ref_no' and a.annexure_status=$status and a.zone_id in ($zone_id))";
        }
        if($status == 6 and $this->uri->segment(6) != ''){
	         $return_type =  $this->uri->segment(6);  
	         $where .= " and a.is_return = ".$return_type;
	      }
        $this->db->where($where);
		
	   	 //$query ="SELECT  * FROM ".TBL_ANNEXURE_TEMP."  a WHERE a.reference_number='$ref_no' and a.annexure_status=$status and a.zone_id in ($zone_id)" ;
	    }else{
	    	 //$query ="SELECT  * FROM ".TBL_ANNEXURE_TEMP."  a WHERE a.reference_number='$ref_no' and a.zone_id in ($zone_id)" ;
			 $select="a.*,z.name as zone_name";
	    $this->db->select($select);
        $this->db->from(TBL_ANNEXURE_TEMP ." a");
        $this->db->join('zone_master as z', 'z.id = a.zone_id', 'left');
		$where = "(a.reference_number ='$ref_no' and a.zone_id in ($zone_id))";
        $this->db->where($where);
	    }
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
        return $results = $query->result_array();
		//echo "<pre>===="; print_r($results); exit;
   }
   
function getInnerReturnedList($id){
             $select="a.*";
	    $this->db->select($select);
        $this->db->from(TBL_ANNEXURE_TEMP ." a");
		$where = "(a.id ='$id' and a.annexure_status = 6)";
        $this->db->where($where);
        $query = $this->db->get();
		//echo $this->db->last_query(); die;
       return $results = $query->result_array();  
	      		     
// 	   	 $query ="SELECT  * FROM ".TBL_ANNEXURE_TEMP."  a WHERE  a.id='$id'" ;
// 		$sql = $this->db->query($query);
		//echo $this->db->last_query(); die;
		
	//	return $results = $sql->result_array();
		
		//echo "<pre>===="; print_r($results); exit;
   }

function getReturnAnnexure(){
              $ref_no = $this->uri->segment(3);
	     $select="a.*";
	    $this->db->select($select);
        $this->db->from(TBL_ANNEXURE_TEMP ." a");
		$where = "(a.annexure_status = '6' and reference_number = '$ref_no')";
        $this->db->where($where);
        $query = $this->db->get();
		//echo $this->db->last_query(); die;
       return $results = $query->result_array();  		     
// 	   	 $query ="SELECT  * FROM ".TBL_ANNEXURE_TEMP."  a WHERE  a.annexure_status='6'" ;
// 		$sql = $this->db->query($query);
		//echo $this->db->last_query(); die;
		
	//	return $results = $sql->result_array();
		
		//echo "<pre>===="; print_r($results); exit;
   }


function UpdateReturnedDetails($id,$ReturnedArray){
	      
		//	echo "<pre>..."; print_r($teacherArray); exit();
			$this->db->where('id',$id);   
			$res = $this->db->update(TBL_ANNEXURE_TEMP, $ReturnedArray);
   }

   function getMandateListById($startDate='',$toDate='',$status=''){
	
                $condtion = ' ';
		if($startDate !='' ){
			$sdate = date('Y-m-d', strtotime($startDate));
			$condtion .= " AND DATE(a.created_on) >= '$sdate'";
		}
		if($toDate !='' ){
			$tdate = date('Y-m-d', strtotime($toDate));
			$condtion .= " AND  DATE(a.created_on) <= '$tdate'";
		}
		$select="a.file_name,a.annexure_type,COUNT(a.reference_number) AS totalRecord,SUM(a.net_amount) AS totalRecord_sum,COUNT(CASE WHEN a.annexure_status = 2 then 1 ELSE NULL END) AS with_checker,SUM(CASE WHEN a.annexure_status = 2 then net_amount ELSE NULL END) AS with_checker_sum,COUNT(CASE WHEN a.annexure_status = 3 then 1 ELSE NULL END) AS with_releaser,SUM(CASE WHEN a.annexure_status = 3 then net_amount ELSE NULL END) AS with_releaser_sum,COUNT(CASE WHEN a.annexure_status = 4 then 1 ELSE NULL END) AS rejected_by_LAO,SUM(CASE WHEN a.annexure_status = 4 then net_amount ELSE NULL END) AS rejected_by_LAO_sum,COUNT(CASE WHEN a.annexure_status = 5 then 1 ELSE NULL END) AS rejected_by_releaser,SUM(CASE WHEN a.annexure_status = 5 then net_amount ELSE NULL END) AS rejected_by_releaser_sum,COUNT(CASE WHEN a.annexure_status = 6 then 1 ELSE NULL END) AS returned,SUM(CASE WHEN a.annexure_status = 6 then net_amount ELSE NULL END) AS returned_sum,COUNT(CASE WHEN a.annexure_status = 6 and is_return = 0 then 1 ELSE NULL END) AS failed,SUM(CASE WHEN a.annexure_status = 6 and is_return = 0 then net_amount ELSE NULL END) AS failed_sum,COUNT(CASE WHEN a.annexure_status = 11 then 1 ELSE NULL END) AS success,SUM(CASE WHEN a.annexure_status = 11 then net_amount ELSE NULL END) AS success_sum,a.reference_number,a.created_on,a.reason";
	    $this->db->select($select);
        $this->db->from(TBL_ANNEXURE_TEMP ." a");
		$where = "(1 ".$condtion." AND a.annexure_status = ".$status.")";
        $this->db->where($where);
		$this->db->group_by("a.reference_number");
		$this->db->order_by("a.created_on", "DESC");
        $query = $this->db->get();
		//echo $this->db->last_query(); die;
       return $results = $query->result_array(); 
       /* $query ="SELECT a.file_name,a.annexure_type,COUNT(a.reference_number) AS totalRecord,SUM(a.reference_number) AS totalRecord_sum,COUNT(CASE WHEN a.annexure_status = 2 then 1 ELSE NULL END) AS with_checker,COUNT(CASE WHEN a.annexure_status = 3 then 1 ELSE NULL END) AS with_releaser,COUNT(CASE WHEN a.annexure_status = 4 then 1 ELSE NULL END) AS rejected,COUNT(CASE WHEN a.annexure_status = 5 then 1 ELSE NULL END) AS pulled,COUNT(CASE WHEN a.annexure_status = 6 then 1 ELSE NULL END) AS returned,a.reference_number,a.created_on
        FROM annexure_temp  a WHERE 1
".$condtion." AND a.annexure_status = ".$status."  GROUP BY a.reference_number ORDER BY a.created_on DESC" ;*/

// $query ="SELECT a.file_name,a.annexure_type,COUNT(a.reference_number) AS totalRecord,SUM(a.net_amount) AS totalRecord_sum,COUNT(CASE WHEN a.annexure_status = 2 then 1 ELSE NULL END) AS with_checker,SUM(CASE WHEN a.annexure_status = 2 then net_amount ELSE NULL END) AS with_checker_sum,COUNT(CASE WHEN a.annexure_status = 3 then 1 ELSE NULL END) AS with_releaser,SUM(CASE WHEN a.annexure_status = 3 then net_amount ELSE NULL END) AS with_releaser_sum,COUNT(CASE WHEN a.annexure_status = 4 then 1 ELSE NULL END) AS rejected_by_LAO,SUM(CASE WHEN a.annexure_status = 4 then net_amount ELSE NULL END) AS rejected_by_LAO_sum,COUNT(CASE WHEN a.annexure_status = 5 then 1 ELSE NULL END) AS rejected_by_releaser,SUM(CASE WHEN a.annexure_status = 5 then net_amount ELSE NULL END) AS rejected_by_releaser_sum,COUNT(CASE WHEN a.annexure_status = 6 then 1 ELSE NULL END) AS returned,SUM(CASE WHEN a.annexure_status = 6 then net_amount ELSE NULL END) AS returned_sum,a.reference_number,a.created_on,a.reason
//         FROM ".TBL_ANNEXURE_TEMP."  a WHERE 1
// ".$condtion." AND a.annexure_status = ".$status."  GROUP BY a.reference_number ORDER BY a.created_on DESC" ;
// 		$sql = $this->db->query($query);
		//echo $this->db->last_query(); die;
		
	//	return $results = $sql->result_array();
		
		//echo "<pre>===="; print_r($results); exit;
   }
   
   function getWaitingForLAO(){
              
	      		     
	   	 $query ="SELECT
					t.zone_id,
					COUNT(CASE WHEN t.with_checker != 0 THEN 1 ELSE NULL END) AS  totalFile,
					SUM(t.totalRecord) AS totalRecord,
					SUM(t.with_checker) AS twith_checker,
					SUM(t.totalAmount) AS totalAmount
				  FROM (SELECT
						  a.zone_id,
						  a.reference_number,
						  a.file_name,
						  COUNT(a.reference_number) AS totalRecord,
						  COUNT(CASE WHEN a.annexure_status = 2 THEN 1 ELSE NULL END) AS with_checker,
						  SUM(CASE WHEN a.annexure_status = 2 THEN a.net_amount ELSE NULL END) AS totalAmount
						FROM ".TBL_ANNEXURE_TEMP." a
						GROUP BY a.reference_number
						ORDER BY a.zone_id) AS t
				  GROUP BY t.zone_id" ;
		$sql = $this->db->query($query);
		//echo $this->db->last_query(); die;
		
		return $results = $sql->result_array();
		
		//echo "<pre>===="; print_r($results); exit;
   }
   
   function getWaitingForReleaser(){
              
	      		     
				$query ="SELECT  t.zone_id,
				COUNT(CASE WHEN t.with_releaser != 0 THEN 1 ELSE NULL END) AS  totalFile,
				SUM(t.totalRecord) AS totalRecord,SUM(t.with_releaser) AS twith_releaser
	   ,SUM(t.totalAmount) AS totalAmount FROM 
		 (  SELECT
		 a.zone_id,
		 a.reference_number,
		 a.file_name,
		 COUNT(a.reference_number) AS totalRecord,
		 COUNT(CASE WHEN a.annexure_status = 3 THEN 1 ELSE NULL END) AS with_releaser,
		 SUM(CASE WHEN a.annexure_status = 3 THEN a.net_amount ELSE NULL END) AS totalAmount
	   FROM ".TBL_ANNEXURE_TEMP." a GROUP BY a.reference_number ORDER BY a.zone_id 
	   ) AS t GROUP BY t.zone_id" ;
		$sql = $this->db->query($query);
		//echo $this->db->last_query(); die;
		
		return $results = $sql->result_array();
		
		//echo "<pre>===="; print_r($results); exit;
   }
   function getRejectedByLAO(){
              
	      		     
	   	 $query ="SELECT  t.zone_id,
	   	 COUNT(CASE WHEN t.rejectedby_LAO != 0 THEN 1 ELSE NULL END) AS  totalFile,
	   	 SUM(t.totalRecord) AS totalRecord,SUM(t.rejectedby_LAO) AS trejectedby_LAO,SUM(t.totalAmount) AS totalAmount FROM 
					(  SELECT
					a.zone_id,
					a.reference_number,
					a.file_name,
					COUNT(a.reference_number) AS totalRecord,
					COUNT(CASE WHEN a.annexure_status = 4 THEN 1 ELSE NULL END) AS rejectedby_LAO,
		            SUM(CASE WHEN a.annexure_status = 4 THEN a.net_amount ELSE NULL END) AS totalAmount
				  FROM ".TBL_ANNEXURE_TEMP." a GROUP BY a.reference_number ORDER BY a.zone_id 
				  ) AS t GROUP BY t.zone_id" ;
		$sql = $this->db->query($query);
		//echo $this->db->last_query(); die;
		
		return $results = $sql->result_array();
		
		//echo "<pre>===="; print_r($results); exit;
   }
   
   function getRejectedByReleaser(){
              
	      		     
	   	 $query ="SELECT  t.zone_id,
	   	 COUNT(CASE WHEN t.rejectedby_Releaser != 0 THEN 1 ELSE NULL END) AS  totalFile,
	   	 SUM(t.totalRecord) AS totalRecord,
	   	 SUM(t.rejectedby_Releaser) AS trejectedby_Releaser,SUM(t.totalAmount) AS totalAmount FROM 
					(  SELECT
					a.zone_id,
					a.reference_number,
					a.file_name,
					COUNT(a.reference_number) AS totalRecord,
					COUNT(CASE WHEN a.annexure_status = 5 THEN 1 ELSE NULL END) AS rejectedby_Releaser,
		            SUM(CASE WHEN a.annexure_status = 5 THEN a.net_amount ELSE NULL END) AS totalAmount
				  FROM ".TBL_ANNEXURE_TEMP." a GROUP BY a.reference_number ORDER BY a.zone_id 
				  ) AS t GROUP BY t.zone_id" ;
		$sql = $this->db->query($query);
		//echo $this->db->last_query(); die;
		
		return $results = $sql->result_array();
		
		//echo "<pre>===="; print_r($results); exit;
   }
   function getReleasedTxn(){
              
	      		     
	   	 $query ="SELECT  t.zone_id,
	   	 COUNT(CASE WHEN t.released != 0 THEN 1 ELSE NULL END) AS  totalFile,
	   	 SUM(t.totalRecord) AS totalRecord,SUM(t.released) AS treleased,SUM(t.totalAmount) AS totalAmount FROM 
					(  SELECT
					a.zone_id,
					a.reference_number,
					a.file_name,
					COUNT(a.reference_number) AS totalRecord,
					COUNT(CASE WHEN a.annexure_status = 7 THEN 1 ELSE NULL END) AS released ,
		            SUM(CASE WHEN a.annexure_status = 7 THEN a.net_amount ELSE NULL END) AS totalAmount
				  FROM ".TBL_ANNEXURE_TEMP." a GROUP BY a.reference_number ORDER BY a.zone_id 
				  ) AS t GROUP BY t.zone_id" ;
		$sql = $this->db->query($query);
		//echo $this->db->last_query(); die;
		
		return $results = $sql->result_array();
		
		//echo "<pre>===="; print_r($results); exit;
   }
   function getReturnedTxn(){
              
	      		     
	   	 $query ="SELECT  t.zone_id,
	   	 COUNT(CASE WHEN t.returned != 0 THEN 1 ELSE NULL END) AS  totalFile,
	   	 SUM(t.totalRecord) AS totalRecord,
	   	 SUM(t.returned) AS treturned,SUM(t.totalAmount) AS totalAmount FROM 
					(  SELECT
					a.zone_id,
					a.reference_number,
					a.file_name,
					COUNT(a.reference_number) AS totalRecord,
					COUNT(CASE WHEN a.annexure_status = 6 THEN 1 ELSE NULL END) AS returned ,
		            SUM(CASE WHEN a.annexure_status = 6 THEN a.net_amount ELSE NULL END) AS totalAmount
				  FROM ".TBL_ANNEXURE_TEMP." a GROUP BY a.reference_number ORDER BY a.zone_id 
				  ) AS t GROUP BY t.zone_id" ;
		$sql = $this->db->query($query);
		//echo $this->db->last_query(); die;
		
		return $results = $sql->result_array();
		
		//echo "<pre>===="; print_r($results); exit;
   }
   
   function getSuccessTxn(){
              
	      		     
	   	 $query ="SELECT  t.zone_id,
	   	 COUNT(CASE WHEN t.success != 0 THEN 1 ELSE NULL END) AS  totalFile,
	   	 SUM(t.totalRecord) AS totalRecord,SUM(t.success) AS tsuccess,SUM(t.totalAmount) AS totalAmount FROM 
					(  SELECT
					a.zone_id,
					a.reference_number,
					a.file_name,
					COUNT(a.reference_number) AS totalRecord,
					COUNT(CASE WHEN a.annexure_status = 11 THEN 1 ELSE NULL END) AS success ,
		            SUM(CASE WHEN a.annexure_status = 11 THEN a.net_amount ELSE NULL END) AS totalAmount
				  FROM ".TBL_ANNEXURE_TEMP." a GROUP BY a.reference_number ORDER BY a.zone_id 
				  ) AS t GROUP BY t.zone_id" ;
		$sql = $this->db->query($query);
		//echo $this->db->last_query(); die;
		
		return $results = $sql->result_array();
		
		//echo "<pre>===="; print_r($results); exit;
   }
   
   function getReinitiatedTxn(){
              
	      		     
	   	 $query ="SELECT  t.zone_id,
	   	 COUNT(CASE WHEN t.success != 0 THEN 1 ELSE NULL END) AS  totalFile,
	   	 SUM(t.totalRecord) AS totalRecord,SUM(t.success) AS treintiated,SUM(t.totalAmount) AS totalAmount FROM 
					(  SELECT
					a.zone_id,
					a.reference_number,
					a.file_name,
					COUNT(a.reference_number) AS totalRecord,
					COUNT(CASE WHEN a.annexure_status = 10 THEN 1 ELSE NULL END) AS success ,
		            SUM(CASE WHEN a.annexure_status = 10 THEN a.net_amount ELSE NULL END) AS totalAmount
				  FROM ".TBL_ANNEXURE_TEMP." a GROUP BY a.reference_number ORDER BY a.zone_id 
				  ) AS t GROUP BY t.zone_id" ;
		$sql = $this->db->query($query);
		//echo $this->db->last_query(); die;
		
		return $results = $sql->result_array();
		
		//echo "<pre>===="; print_r($results); exit;
   }
   
   function getReInitiatedList($zone_id='',$startDate='',$toDate='',$annexure_type=''){
	            $session_data = $this->session->all_userdata();
                $condtion = ' ';
         if($this->role_id !='' ){
             
	            $condtion .= " AND  annexure_status = 10";
        }
                if($zone_id !='' ){
			$condtion .= " AND  zone_id in ($zone_id)";
		}
		if($startDate !='' ){
			$sdate = date('Y-m-d', strtotime($startDate));
			$condtion .= " AND DATE(a.created_on) >= '$sdate'";
		}
		if($toDate !='' ){
			$tdate = date('Y-m-d', strtotime($toDate));
			$condtion .= " AND  DATE(a.created_on) <= '$tdate'";
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
		$select="a.id,a.file_name,a.maker_name,a.annexure_type,COUNT(a.reference_number) AS totalRecord,SUM(a.net_amount) AS totalRecord_sum,COUNT(CASE WHEN a.annexure_status = 2 then 1 ELSE NULL END) AS with_checker,SUM(CASE WHEN a.annexure_status = 2 then net_amount ELSE NULL END) AS with_checker_sum,COUNT(CASE WHEN a.annexure_status = 3 then 1 ELSE NULL END) AS with_releaser,SUM(CASE WHEN a.annexure_status = 3 then net_amount ELSE NULL END) AS with_releaser_sum,COUNT(CASE WHEN a.annexure_status = 4 then 1 ELSE NULL END) AS rejected_by_LAO,SUM(CASE WHEN a.annexure_status = 4 then net_amount ELSE NULL END) AS rejected_by_LAO_sum,COUNT(CASE WHEN a.annexure_status = 5 then 1 ELSE NULL END) AS rejected_by_releaser,SUM(CASE WHEN a.annexure_status = 5 then net_amount ELSE NULL END) AS rejected_by_releaser_sum,COUNT(CASE WHEN a.annexure_status = 6 then 1 ELSE NULL END) AS returned,SUM(CASE WHEN a.annexure_status = 6 then net_amount ELSE NULL END) AS returned_sum,COUNT(CASE WHEN a.annexure_status = 7 then 1 ELSE NULL END) AS released,SUM(CASE WHEN a.annexure_status = 7 then net_amount ELSE NULL END) AS released_sum,COUNT(CASE WHEN a.annexure_status = 8 then 1 ELSE NULL END) AS in_process_to_releaser,SUM(CASE WHEN a.annexure_status = 8 then net_amount ELSE NULL END) AS in_process_to_releaser_sum,COUNT(CASE WHEN a.annexure_status = 9 then 1 ELSE NULL END) AS in_process_to_disbursement,SUM(CASE WHEN a.annexure_status = 9 then net_amount ELSE NULL END) AS in_process_to_disbursement_sum,COUNT(CASE WHEN a.is_resubmitted = 1 then 1 ELSE NULL END) AS reinitiated,SUM(CASE WHEN a.is_resubmitted = 1 then net_amount ELSE NULL END) AS reinitiated_sum,a.reference_number,a.created_on,a.reason";
	    $this->db->select($select);
        $this->db->from(TBL_ANNEXURE_TEMP ." a");
		$where = "(1 ".$condtion.")";
        $this->db->where($where);
		$this->db->group_by("a.reference_number");
		$this->db->order_by("a.id", "DESC");
        $query = $this->db->get();
	//echo $this->db->last_query(); die;
       return $results = $query->result_array();
   }
   
   function getMandateListWithoutResubmitted($zone_id='',$annexure_status,$startDate='',$toDate='',$annexure_type=''){
                $condtion = ' ';
            /*if($this->role_id !='' ){
             if($this->role_id == 4){
	            $condtion .= " AND is_resubmitted != 1";
             }else if($this->role_id == 5){
	            $condtion .= " AND is_resubmitted != 1";
             }else{
	            $condtion .= " AND is_resubmitted != 1";
             }
        } */   
        if($annexure_status !='' ){
             if($annexure_status == 3){
	            $condtion .= " AND annexure_status =3";
             }
        } 
                if($zone_id !='' ){
			$condtion .= " AND  zone_id in ($zone_id)";
		}
		if($startDate !='' ){
			$sdate = date('Y-m-d', strtotime($startDate));
			$condtion .= " AND DATE(a.created_on) >= '$sdate'";
		}
		if($toDate !='' ){
			$tdate = date('Y-m-d', strtotime($toDate));
			$condtion .= " AND  DATE(a.created_on) <= '$tdate'";
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
            
			}else if($annexure_type ==6){
				$annexure_type ='6';
            $condtion .= " AND a.annexure_type='$annexure_type'";
            
			}else if($annexure_type ==7){
				$annexure_type ='7';
            $condtion .= " AND a.annexure_type='$annexure_type'";
            
			}else if($annexure_type ==8){
				$annexure_type ='8';
            $condtion .= " AND a.annexure_type='$annexure_type'";
            
			}
			
		}
		$select="a.id,a.file_name,a.maker_name,a.annexure_type,COUNT(a.reference_number) AS totalRecord,SUM(a.net_amount) AS totalRecord_sum,COUNT(CASE WHEN a.annexure_status = 2 then 1 ELSE NULL END) AS with_checker,SUM(CASE WHEN a.annexure_status = 2 then net_amount ELSE NULL END) AS with_checker_sum,COUNT(CASE WHEN a.annexure_status = 3 then 1 ELSE NULL END) AS with_releaser,SUM(CASE WHEN a.annexure_status = 3 then net_amount ELSE NULL END) AS with_releaser_sum,COUNT(CASE WHEN a.annexure_status = 4 then 1 ELSE NULL END) AS rejected_by_LAO,SUM(CASE WHEN a.annexure_status = 4 then net_amount ELSE NULL END) AS rejected_by_LAO_sum,COUNT(CASE WHEN a.annexure_status = 5 then 1 ELSE NULL END) AS rejected_by_releaser,SUM(CASE WHEN a.annexure_status = 5 then net_amount ELSE NULL END) AS rejected_by_releaser_sum,COUNT(CASE WHEN a.annexure_status = 6 then 1 ELSE NULL END) AS returned,SUM(CASE WHEN a.annexure_status = 6 then net_amount ELSE NULL END) AS returned_sum,COUNT(CASE WHEN a.annexure_status = 7 then 1 ELSE NULL END) AS released,SUM(CASE WHEN a.annexure_status = 7 then net_amount ELSE NULL END) AS released_sum,COUNT(CASE WHEN a.annexure_status = 8 then 1 ELSE NULL END) AS in_process_to_releaser,SUM(CASE WHEN a.annexure_status = 8 then net_amount ELSE NULL END) AS in_process_to_releaser_sum,COUNT(CASE WHEN a.annexure_status = 9 then 1 ELSE NULL END) AS in_process_to_disbursement,SUM(CASE WHEN a.annexure_status = 9 then net_amount ELSE NULL END) AS in_process_to_disbursement_sum,COUNT(CASE WHEN a.is_resubmitted = 1 then 1 ELSE NULL END) AS reinitiated,SUM(CASE WHEN a.is_resubmitted = 1 then net_amount ELSE NULL END) AS reinitiated_sum,a.reference_number,a.created_on,a.reason";
	    $this->db->select($select);
        $this->db->from(TBL_ANNEXURE_TEMP ." a");
		$where = "(1 ".$condtion.")";
        $this->db->where($where);
		$this->db->group_by("a.reference_number");
		$this->db->order_by("a.id", "DESC");
        $query = $this->db->get();
	//echo $this->db->last_query(); die;
       return $results = $query->result_array();
   }
   
   function getFailedMandateList($zone_id='',$startDate='',$toDate='',$annexure_type=''){
       //echo $zone_id; die;
        $i=0;
        //echo "<pre>";print_r($zone_id);
        $condtion = '';
        if($zone_id =='All'){
            foreach($this->zones as $zo){
    	        $zone_id.= $zo['id'].',';
    	        $i++;
    	    } 
            $zone_id = rtrim($zone_id,',');
        }else{
            
		    $condtion .= " AND  zone_id in ($zone_id)";
                   
		}
		if($startDate !='' ){
			$sdate = date('Y-m-d', strtotime($startDate));
			$condtion .= " AND DATE(a.created_on) >= '$sdate'";
		}
		if($toDate !='' ){
			$tdate = date('Y-m-d', strtotime($toDate));
			$condtion .= " AND  DATE(a.created_on) <= '$tdate'";
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
	$where = "(1 ".$condtion.")";	
		$query ="SELECT
  `a`.`returned_on`,
  `a`.`id`,
  `a`.`file_name`,
  `a`.`maker_name`,
  `a`.`annexure_type`,
  COUNT(a.reference_number) AS totalRecord,
  SUM(a.net_amount)      AS totalRecord_sum,
  anx_return.failed    AS failed,
  anx_return.failed_sum    AS failed_sum,
 `a`.`reference_number`,
  `a`.`created_on`,
  `a`.`reason`
FROM (`annexure_temp` a)
  LEFT JOIN (SELECT
               b.reference_number,
               COUNT(CASE WHEN b.annexure_status = 6 and b.is_return = 0 THEN 1 ELSE NULL END) AS failed,
               SUM(CASE WHEN b.annexure_status = 6 and b.is_return = 0 THEN net_amount ELSE NULL END) AS failed_sum
             FROM annexure_temp b
             WHERE b.annexure_status = 6 and  b.is_return = 0
             GROUP BY b.reference_number) AS anx_return
    ON anx_return.reference_number = a.reference_number
WHERE $where 
GROUP BY `a`.`reference_number`
ORDER BY `a`.`id` DESC";
	
	    $sql = $this->db->query($query);
  	   //echo $this->db->last_query(); die;
		
		return $results = $sql->result_array();
     
   }
   
   function getfailedAnnexure(){
              $ref_no = $this->uri->segment(3);
	     $select="a.*";
	    $this->db->select($select);
        $this->db->from(TBL_ANNEXURE_TEMP ." a");
		$where = "(a.annexure_status = '6' and is_return = 0 and reference_number = '$ref_no')";
        $this->db->where($where);
        $query = $this->db->get();
       return $results = $query->result_array();
   }
   
}