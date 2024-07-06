<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DDReport_model extends CI_Model {

	var $table = 'annexure_temp';
	var $column_order =array('file_name','zone_name','serial_no','customer_reference_number','sector_no','villlage_name','section_notfn_date','is_petition_filed','award_no','award_date','LAO_bank_account_no','beneficiary_name','khewat_no','share_in_ownership','acre','kanal','marla','beneficiary_PAN','reason'); //set column field database for datatable orderable
	var $column_search = array('file_name','z.name','customer_reference_number','LAO_bank_account_no','beneficiary_name','net_amount','ifsc_code','account_number','released_on','returned_on'); //set column field database for datatable searchable 
	var $order = array('id' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$session_data = $this->session->all_userdata();
        //print_r($session_data);die;
       /* $this->zones = $session_data['zones'];
        foreach($this->zones as $zo){
	        $zone_id.= $zo['id'].',';
	        $i++;
	    }    
	    $this->zone_id = rtrim($zone_id,',');*/
	}

	private function _get_datatables_query()
	{
		
		//add custom filter here

		if($this->input->post('annexure_status'))
		{
			$this->db->where('annexure_status', $this->input->post('annexure_status'));
		}
		if($this->input->post('fromDate') != '' && $this->input->post('toDate') != '')
		{
			$conditionDate = $this->input->post('date_type');
			//$this->db->where($conditionDate, $this->input->post('fromDate'));
			$this->db->where('DATE(a.'.$conditionDate.') BETWEEN "'. date('Y-m-d', strtotime($this->input->post('fromDate'))). '" and "'. date('Y-m-d', strtotime($this->input->post('toDate'))).'"');
		}
		if($this->input->post('zone_id') !='All')
		{
			$this->db->where('a.zone_id', $this->input->post('zone_id'));
		}else{
			$this->db->where("a.zone_id in ($this->zone_id)");
		}
		

		//$this->db->from($this->table);
		$select="a.*,z.name as zone_name";
	    $this->db->select($select);
        $this->db->from(TBL_ANNEXURE_TEMP ." a");
        $this->db->join('zone_master as z', 'z.id = a.zone_id', 'left');
        $this->db->where('annexure_type', $this->input->post('annexure_type'));
		//$where = "(a.annexure_type =5)";
        //$this->db->where($where);
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

	// echo '<pre>==';$this->db->last_query();exit;
		$query = $this->db->get();
      // echo '<pre>===='; print_r($_POST); 
		//print_r($this->db->last_query());exit;
		return $query->result_array();
	}

	public function count_filtered()
	{
		$this->_get_datatables_query();
		$this->db->where('annexure_type', $this->input->post('annexure_type'));
		if($this->input->post('zone_id') !='All')
		{
			$this->db->where('zone_id', $this->input->post('zone_id'));
		}else{
			$this->db->where("zone_id in ($this->zone_id)");
		}
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		$this->db->where('annexure_type', $this->input->post('annexure_type'));
		if($this->input->post('zone_id') !='All')
		{
			$this->db->where('zone_id', $this->input->post('zone_id'));
		}else{
			$this->db->where("zone_id in ($this->zone_id)");
		}
		return $this->db->count_all_results();
	}

	public function get_list_countries()
	{
		$this->db->select('country');
		$this->db->from($this->table);
		$this->db->order_by('country','asc');
		$query = $this->db->get();
		$result = $query->result();

		$countries = array();
		foreach ($result as $row) 
		{
			$countries[] = $row->country;
		}
		return $countries;
	}
	function TotalCount(){
$select ="COUNT(a.id) AS total_record,
  COUNT(CASE WHEN a.annexure_type = 1 THEN 1 ELSE NULL END) AS original,
  COUNT(CASE WHEN a.annexure_type = 2 THEN 1 ELSE NULL END) AS lower_court,
  COUNT(CASE WHEN a.annexure_type = 3 THEN 1 ELSE NULL END) AS high_court,
  COUNT(CASE WHEN a.annexure_type = 4 THEN 1 ELSE NULL END) AS suprem_court,
  COUNT(CASE WHEN a.annexure_type = 5 THEN 1 ELSE NULL END) AS dd,
  COUNT(CASE WHEN a.annexure_type = 6 THEN 1 ELSE NULL END) AS original_dd,
  COUNT(CASE WHEN a.annexure_type = 7 THEN 1 ELSE NULL END) AS lowercourt_dd,
  COUNT(CASE WHEN a.annexure_type = 8 THEN 1 ELSE NULL END) AS highcourt_dd";
        $this->db->select($select);
        $this->db->from('annexure_temp a');
        $query = $this->db->get();
		//echo $this->db->last_query(); die;
        return $query->result_array();
	}

}
