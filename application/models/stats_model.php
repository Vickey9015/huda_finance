<?php

class Stats_model extends CI_Model {
    public $error       = array();
    public $error_count = 0;
    public $user_type    = 0;
    
    public function __construct() 
    {
        parent::__construct();
    }

   function getDashboardFileStats($zone_id=''){
              $status = null;
              if($this->uri->segment(5)){
	      	$status = $this->uri->segment(5);
	      }
	    $select="COUNT(DISTINCT reference_number) AS total";
	    $this->db->select($select);
        $this->db->from(TBL_ANNEXURE_TEMP);
		$where = "(zone_id in ($zone_id))";
        $this->db->where($where);
        $query = $this->db->get();
        $files = $query->result_array();
       //echo "<pre>"; print_r($this->db->last_query());exit; 
		$select="COUNT(DISTINCT reference_number) AS with_checker";
	    $this->db->select($select);
        $this->db->from(TBL_ANNEXURE_TEMP);
		$where = "(annexure_status = 2 and zone_id in ($zone_id))";
        $this->db->where($where);
        $query = $this->db->get();
        $files1 = $query->result_array();
	
	     $select="COUNT(DISTINCT reference_number) AS with_releaser";
	    $this->db->select($select);
        $this->db->from(TBL_ANNEXURE_TEMP);
		$where = "(annexure_status = 3 and zone_id in ($zone_id))";
        $this->db->where($where);
        $query = $this->db->get();
        $files2 = $query->result_array();
		 
		$select="COUNT(DISTINCT reference_number) AS rejected_by_LAO";
	    $this->db->select($select);
        $this->db->from(TBL_ANNEXURE_TEMP);
		$where = "(annexure_status = 4 and zone_id in ($zone_id))";
        $this->db->where($where);
        $query = $this->db->get();
        $files3 = $query->result_array();
	    
	    $select="COUNT(DISTINCT reference_number) AS rejected_by_releaser";
	    $this->db->select($select);
        $this->db->from(TBL_ANNEXURE_TEMP);
		$where = "(annexure_status = 5 and zone_id in ($zone_id))";
        $this->db->where($where);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        $files4 = $query->result_array();
		  
	    $select="COUNT(DISTINCT reference_number) AS returned";
	    $this->db->select($select);
        $this->db->from(TBL_ANNEXURE_TEMP);
		$where = "(annexure_status = 6 and zone_id in ($zone_id))";
        $this->db->where($where);
        $query = $this->db->get();
        $files51 = $query->result_array();
        
        $select="COUNT(DISTINCT reference_number) AS failed";
	    $this->db->select($select);
        $this->db->from(TBL_ANNEXURE_TEMP);
		$where = "(annexure_status = 6 and is_return = 0 and zone_id in ($zone_id))";
        $this->db->where($where);
        $query = $this->db->get();
        $files50 = $query->result_array();
	
	      $select="COUNT(DISTINCT reference_number) AS released";
	    $this->db->select($select);
        $this->db->from(TBL_ANNEXURE_TEMP);
		$where = "(annexure_status = 7 and zone_id in ($zone_id))";
        $this->db->where($where);
        $query = $this->db->get();
        $files_released = $query->result_array();
	     
	    $select="COUNT(DISTINCT reference_number) AS success";
	    $this->db->select($select);
        $this->db->from(TBL_ANNEXURE_TEMP);
		$where = "(annexure_status = 11 and zone_id in ($zone_id))";
        $this->db->where($where);
        $query = $this->db->get();
        $files6 = $query->result_array();
        
		$select="COUNT(DISTINCT reference_number) AS reinitiated";
	    $this->db->select($select);
        $this->db->from(TBL_ANNEXURE_TEMP);
		$where = "(annexure_status = 10 and zone_id in ($zone_id))";
        $this->db->where($where);
        $query = $this->db->get();
        $files7 = $query->result_array();
	     $statss = array(['total' =>  $files[0]['total'],'with_checker' =>  $files1[0]['with_checker'],'with_releaser' =>  $files2[0]['with_releaser'],'rejected_by_LAO' =>  $files3[0]['rejected_by_LAO'],'rejected_by_releaser' =>  $files4[0]['rejected_by_releaser'],'returned' =>  $files51[0]['returned'],'failed' =>  $files50[0]['failed'],'released' =>  $files_released[0]['released'],'success' =>  $files6[0]['success'],'reinitiated' =>  $files7[0]['reinitiated']]);
	return $statss[0];	
   }
      
   function getDashboardStats($zone_id){
              $status = null;
              if($this->uri->segment(5)){
	      	$status = $this->uri->segment(5);
	      }
	      $select="COUNT(a.id) AS total_record,SUM(a.net_amount) AS totalRecord_sum,COUNT(CASE WHEN a.annexure_status = 2 then 1 ELSE NULL END) AS pending,COUNT(CASE WHEN a.annexure_status = 7 then 1 ELSE NULL END) AS released,SUM(CASE WHEN a.annexure_status = 2 then net_amount ELSE NULL END) AS with_checker_sum,COUNT(CASE WHEN a.annexure_status = 3 then 1 ELSE NULL END) AS approved,COUNT(CASE WHEN a.annexure_status = 6 then 1 ELSE NULL END) AS returned,COUNT(CASE WHEN a.annexure_status = 6 and a.is_return = 0 then 1 ELSE NULL END) AS failed,SUM(CASE WHEN a.annexure_status = 6 then 1 ELSE NULL END) AS returned_sum,COUNT(CASE WHEN a.annexure_status = 4 then 1 ELSE NULL END) AS rejected,COUNT(CASE WHEN a.annexure_status = 5 then 1 ELSE NULL END) AS pulled";
	    $this->db->select($select);
        $this->db->from(TBL_ANNEXURE_TEMP ." a");
		$where = "(a.zone_id in ($zone_id))";
        $this->db->where($where);
		$this->db->group_by("a.reference_number");
        $query = $this->db->get();
        $records = $query->row_array();
		return $records[0];
   }
   
      function getDashboardStatsbyMonth($zone_id){
              $status = null;
         if($this->uri->segment(5)){
	      	$status = $this->uri->segment(5);
	      }
	      $date = date('Y-m');
	      $today = date('Y-m-d');
	      $start_date = $date.'-01 00:00:00';
	      $end_date = $today.' 24:00:00';
	      $select="COUNT(a.id) AS total_record,SUM(a.net_amount) AS totalRecord_sum,COUNT(CASE WHEN a.annexure_status = 2 then 1 ELSE NULL END) AS pending,SUM(CASE WHEN a.annexure_status = 2 then net_amount ELSE NULL END) AS with_checker_sum,COUNT(CASE WHEN a.annexure_status = 3 then 1 ELSE NULL END) AS approved,SUM(CASE WHEN a.annexure_status = 3 then net_amount ELSE NULL END) AS with_releaser_sum,COUNT(CASE WHEN a.annexure_status = 6 then 1 ELSE NULL END) AS returned,SUM(CASE WHEN a.annexure_status = 6 then net_amount ELSE NULL END) AS returned_sum,COUNT(CASE WHEN a.annexure_status = 6 and a.is_return = 0 then 1 ELSE NULL END) AS failed,SUM(CASE WHEN a.annexure_status = 6 and a.is_return = 0 then net_amount ELSE NULL END) AS failed_sum,COUNT(CASE WHEN a.annexure_status = 4 then 1 ELSE NULL END) AS rejected_by_LAO,SUM(CASE WHEN a.annexure_status = 4 then net_amount ELSE NULL END) AS rejected_by_LAO_sum,COUNT(CASE WHEN a.annexure_status = 5 then 1 ELSE NULL END) AS rejected_by_releaser,SUM(CASE WHEN a.annexure_status = 5 then net_amount ELSE NULL END) AS rejected_by_releaser_sum,COUNT(CASE WHEN a.annexure_status = 7 then 1 ELSE NULL END) AS released,SUM(CASE WHEN a.annexure_status = 7 then net_amount ELSE NULL END) AS released_sum,COUNT(CASE WHEN a.annexure_status = 11 then 1 ELSE NULL END) AS success,SUM(CASE WHEN a.annexure_status = 11 then net_amount ELSE NULL END) AS success_sum,COUNT(CASE WHEN a.annexure_status = 10 then 1 ELSE NULL END) AS reinitiated,SUM(CASE WHEN a.annexure_status = 10 then net_amount ELSE NULL END) AS reinitiated_sum";
	    $this->db->select($select);
        $this->db->from(TBL_ANNEXURE_TEMP ." a");
        $where = "(a.zone_id in ($zone_id))";
        $this->db->where($where);
		$this->db->order_by("a.id", "DESC");
        $query = $this->db->get();
        $records = $query->result_array();
        //echo "<pre>"; print_r($this->db->last_query());exit;
		return $records[0];
   }
   
         function getAudit($id){
              $status = null;
              if($this->uri->segment(5)){
	      	$status = $this->uri->segment(5);
	      }
	      $date = date('Y-m');
	      $today = date('Y-m-d');
	      $start_date = $date.'-01 00:00:00';
	      $end_date = $today.' 24:00:00';
	      $select="a.maker_name,a.LOA_name as LAO_name,a.releaser_name,a.authorised_on,a.released_on,a.returned_on,a.rejected_on,a.created_on,a.customer_reference_number as ref_number";
	    $this->db->select($select);
        $this->db->from(TBL_ANNEXURE_TEMP ." a");
		$where = "(a.id = '$id')";
        $this->db->where($where);
        $query = $this->db->get();
        $records = $query->result_array();
		return $records[0];
   }
}