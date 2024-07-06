<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Returnrecords_model extends CI_Model {

  var $table = 'unclaimed_temp';
  var $column_order = array(
    's_no', 'file_id', 'zone_name', 'sector_no', 'name_of_village', 'date_of_four_section', 'date_of_six_sectiom', 'award_no', 'award_date', 'khewat_no',
    'acquired_area', 'acre', 'kanal', 'marla', 'bank_ac_lao', 'name_of_bene', 'account_number', 'ifsc_code', 'care_of', 'is_edc', 'customer_ref_numer', 'file_ref_number', 'file_name', 'net_amount',
    'initiation_by', 'initiated_on', 'authorised_by', 'authorised_on', 'UTR', 'StatusCode', 'annexure_status', 'created_on'
  );
  var $column_search = array('s_no', 'file_id', 'zone_name', 'sector_no', 'name_of_village', 'award_no', 'khewat_no', 'bank_ac_lao', 'name_of_bene', 'care_of', 'customer_ref_numer', 'file_ref_number', 'file_name', 'net_amount', 'UTR');
  var $order = array('id' => 'asc'); // default order

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $session_data = $this->session->all_userdata();
    $zones = $session_data['zones'];
    $this->roleid = $session_data['role_id'];
    // echo "<pre>Modal"; print_r($this->roleid); exit();

    $i = 0;
    foreach ($zones as $zone) {
      $zone_id[$i] = $zone['id'];
      $i += 1;
    }
    $this->zone_id = implode(",", $zone_id);
  }

  private function _get_datatables_query()
  {
    // echo "<pre>Modal"; print_r($_POST); exit();
    //$session_data = $this->session->all_userdata();
    //$org_id = $session_data['org_id'];
    if(isset($_POST['fromDate']) && !empty($_POST['toDate'])){
      $from = date('Y-m-d', strtotime($_POST['fromDate']));
      $to = date('Y-m-d', strtotime($_POST['toDate']));
      $where = "DATE(created_on) BETWEEN '$from' AND '$to'";
      $this->db->where($where);
    }
    $this->db->from($this->table);
    if ($this->roleid != 6) {
      //$this->db->where_in('zone_id', $this->zone_id);
      $where = "zone_id IN ($this->zone_id)";
      $this->db->where($where);
    }
    $this->db->where_in('annexure_status', array(6));
    // $this->db->where('file_reference_number',$reference_number);
    //     if($status != 'all'){
    //   $this->db->where('status',$status);
    //     }
    // $this->db->order_by('id','asc');
    //$this->db->limit(10);
    $i = 0;
	    $where1='(';
		foreach ($this->column_search as $item) // loop column 
		{
			//print_r($this->column_search);exit;
			//print_r($_POST['search']['value']);exit;
			if($_POST['search']['value']) // if datatable send POST for search
			{

				$sVal=$_POST['search']['value'];
				/*if($i===0) // first loop
				{*/

					//$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					//$this->db->like($item, $_POST['search']['value']);
					$where1 .= "$item LIKE '%$sVal%' OR ";
					//$where1 .= "beneficiary_name LIKE '%$sVal%' OR";
					//$where1 .= "account_number LIKE '%$sVal%')";
					
				/*}
				else
				{
					$where = "(customer_reference_number LIKE '%$sVal%' OR ";
					$where .= "beneficiary_name LIKE '%$sVal%' OR";
					$where .= "account_number LIKE '%$sVal%')";
					$this->db->where($where);
				}

				if(count($this->column_search) - 1 == $i);*/ //last loop
					//$this->db->group_end(); //close bracket
			}
			$i++;
		}
		if($_POST['search']['value']){
			$where1 =rtrim($where1,'OR ');
			$where1 .=' )';
			$this->db->where($where1);
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

  public function get_datatables()
  {
    $this->_get_datatables_query();
    if($_POST['length'] != -1)
    $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    //print_r($this->db->last_query()); exit;
    return $query->result();
  }


  public function count_filtered()
  {
    $this->_get_datatables_query();
    $this->db->where_in('annexure_status', array(6));
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function count_all()
  {
    $this->db->from($this->table);
    $this->db->where_in('annexure_status', array(6));
    return $this->db->count_all_results();
  }


}
