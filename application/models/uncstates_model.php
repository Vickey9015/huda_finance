<?php

class Uncstates_model extends CI_Model
{
    public $error       = array();
    public $error_count = 0;
    public $user_type    = 0;

    public function __construct()
    {
        parent::__construct();
    }

    function getDashboardFileStats($zone_id = '')
    {
        $status = null;
        if ($this->uri->segment(5)) {
            $status = $this->uri->segment(5);
        }
        if ($zone_id == 'ALL') {
            $select = "COUNT(DISTINCT file_ref_number) AS total";
            $this->db->select($select);
            $this->db->from('unclaimed_temp');
            $where = "(is_submit_to_lao = 3)";
            //$where = "(zone_id in ($zone_id))";
            //$this->db->where($where);
            $query = $this->db->get();
            $files = $query->result_array();
            //echo "<pre>"; print_r($this->db->last_query());exit; 
            $select = "COUNT(DISTINCT file_ref_number) AS with_checker";
            $this->db->select($select);
            $this->db->from('unclaimed_temp');
            $where = "(is_error = 2)";
            $this->db->where($where);
            $query = $this->db->get();
            $files1 = $query->result_array();

            $select = "COUNT(DISTINCT file_ref_number) AS with_releaser";
            $this->db->select($select);
            $this->db->from('unclaimed_temp');
            $where = "(is_error = 5)";
            $this->db->where($where);
            $query = $this->db->get();
            $files2 = $query->result_array();

            $select = "COUNT(DISTINCT file_ref_number) AS rejected_by_LAO";
            $this->db->select($select);
            $this->db->from('unclaimed_temp');
            $where = "(is_error = 5)";
            $this->db->where($where);
            $query = $this->db->get();
            $files3 = $query->result_array();

            $select = "COUNT(DISTINCT file_ref_number) AS rejected_by_releaser";
            $this->db->select($select);
            $this->db->from('unclaimed_temp');
            $where = "(is_error = 5)";
            $this->db->where($where);
            $query = $this->db->get();
            //echo $this->db->last_query();exit;
            $files4 = $query->result_array();

            $select = "COUNT(DISTINCT file_ref_number) AS returned";
            $this->db->select($select);
            $this->db->from('unclaimed_temp');
            $where = "(is_error = 5)";
            $this->db->where($where);
            $query = $this->db->get();
            $files51 = $query->result_array();

            $select = "COUNT(DISTINCT file_ref_number) AS failed";
            $this->db->select($select);
            $this->db->from('unclaimed_temp');
            $where = "(is_error = 5)";
            $this->db->where($where);
            $query = $this->db->get();
            $files50 = $query->result_array();

            $select = "COUNT(DISTINCT file_ref_number) AS released";
            $this->db->select($select);
            $this->db->from('unclaimed_temp');
            $where = "(is_error = 7)";
            $this->db->where($where);
            $query = $this->db->get();
            $files_released = $query->result_array();

            $select = "COUNT(DISTINCT file_ref_number) AS success";
            $this->db->select($select);
            $this->db->from('unclaimed_temp');
            $where = "(is_error = 11)";
            $this->db->where($where);
            $query = $this->db->get();
            $files6 = $query->result_array();

            $select = "COUNT(DISTINCT file_ref_number) AS reinitiated";
            $this->db->select($select);
            $this->db->from('unclaimed_temp');
            $where = "(is_error = 10)";
        } else {
            $select = "COUNT(DISTINCT file_ref_number) AS total";
            $this->db->select($select);
            $this->db->from('unclaimed_temp');
            $where = "(zone_id in ($zone_id)) and (is_submit_to_lao=3)";
            //$this->db->where($where);
            $query = $this->db->get();
            //echo "<pre>"; print_r($this->db->last_query());exit; 
            $files = $query->result_array();
            $select = "COUNT(DISTINCT file_ref_number) AS with_checker";
            $this->db->select($select);
            $this->db->from('unclaimed_temp');
            $where = "(is_error = 2 and zone_id in ($zone_id))";
            $this->db->where($where);
            $query = $this->db->get();
            $files1 = $query->result_array();

            $select = "COUNT(DISTINCT file_ref_number) AS with_releaser";
            $this->db->select($select);
            $this->db->from('unclaimed_temp');
            $where = "(is_error = 5 and zone_id in ($zone_id))";
            $this->db->where($where);
            $query = $this->db->get();
            $files2 = $query->result_array();

            $select = "COUNT(DISTINCT file_ref_number) AS rejected_by_LAO";
            $this->db->select($select);
            $this->db->from('unclaimed_temp');
            $where = "(is_error = 5 and zone_id in ($zone_id))";
            $this->db->where($where);
            $query = $this->db->get();
            $files3 = $query->result_array();

            $select = "COUNT(DISTINCT file_ref_number) AS rejected_by_releaser";
            $this->db->select($select);
            $this->db->from('unclaimed_temp');
            $where = "(is_error = 5 and zone_id in ($zone_id))";
            $this->db->where($where);
            $query = $this->db->get();
            //echo $this->db->last_query();exit;
            $files4 = $query->result_array();

            $select = "COUNT(DISTINCT file_ref_number) AS returned";
            $this->db->select($select);
            $this->db->from('unclaimed_temp');
            $where = "(is_error = 5 and zone_id in ($zone_id))";
            $this->db->where($where);
            $query = $this->db->get();
            $files51 = $query->result_array();

            $select = "COUNT(DISTINCT file_ref_number) AS failed";
            $this->db->select($select);
            $this->db->from('unclaimed_temp');
            $where = "(is_error = 5 and zone_id in ($zone_id))";
            $this->db->where($where);
            $query = $this->db->get();
            $files50 = $query->result_array();

            $select = "COUNT(DISTINCT file_ref_number) AS released";
            $this->db->select($select);
            $this->db->from('unclaimed_temp');
            $where = "(is_error = 7 and zone_id in ($zone_id))";
            $this->db->where($where);
            $query = $this->db->get();
            $files_released = $query->result_array();

            $select = "COUNT(DISTINCT file_ref_number) AS success";
            $this->db->select($select);
            $this->db->from('unclaimed_temp');
            $where = "(is_error = 11 and zone_id in ($zone_id))";
            $this->db->where($where);
            $query = $this->db->get();
            $files6 = $query->result_array();

            $select = "COUNT(DISTINCT file_ref_number) AS reinitiated";
            $this->db->select($select);
            $this->db->from('unclaimed_temp');
            $where = "(is_error = 10 and zone_id in ($zone_id))";
        }

        $this->db->where($where);
        $query = $this->db->get();
        $files7 = $query->result_array();
        $statss = array(['total' =>  $files[0]['total'], 'with_checker' =>  $files1[0]['with_checker'], 'with_releaser' =>  $files2[0]['with_releaser'], 'rejected_by_LAO' =>  $files3[0]['rejected_by_LAO'], 'rejected_by_releaser' =>  $files4[0]['rejected_by_releaser'], 'returned' =>  $files51[0]['returned'], 'failed' =>  $files50[0]['failed'], 'released' =>  $files_released[0]['released'], 'success' =>  $files6[0]['success'], 'reinitiated' =>  $files7[0]['reinitiated']]);
        return $statss[0];
    }

    function getDashboardStats($zone_id)
    {
        $status = null;
        if ($this->uri->segment(5)) {
            $status = $this->uri->segment(5);
        }
        if ($zone_id == 'ALL') {
            $where = "is_submit_to_lao=3";
        } else {
            $where = "is_submit_to_lao=3 and (zone_id in ($zone_id))";
        }
        $select = "COUNT(id) AS total_record,SUM(net_amount) AS totalRecord_sum,COUNT(CASE WHEN is_error = 2 then 1 ELSE NULL END) AS pending";
        $this->db->select($select);
        $this->db->from('unclaimed_temp');

        //$this->db->where($where);
        $this->db->group_by("file_ref_number");
        $query = $this->db->get();
        $records = $query->row_array();
        return $records[0];
    }

    function getDashboardStatsbyMonth($zone_id)
    {
        $status = null;
        if ($this->uri->segment(5)) {
            $status = $this->uri->segment(5);
        }
        if ($zone_id == 'ALL') {
            $con = "(a.is_error=5)";
        } else {
            $con = "(a.zone_id in ($zone_id)) and a.is_error=5";
        }


        $date = date('Y-m');
        $today = date('Y-m-d');
        $start_date = $date . '-01 00:00:00';
        $end_date = $today . ' 24:00:00';
        $select = "COUNT(a.id) AS total_record,SUM(a.net_amount) AS totalRecord_sum";
        $this->db->select($select);
        $this->db->from('unclaimed_temp a');
        $where = $con;
        $this->db->where($where);
        $this->db->order_by("a.id", "DESC");
        $query = $this->db->get();
        $records = $query->result_array();
        //echo "<pre>"; print_r($this->db->last_query());exit;
        return $records[0];
    }

    function getAudit($id)
    {
        $status = null;
        if ($this->uri->segment(5)) {
            $status = $this->uri->segment(5);
        }
        $date = date('Y-m');
        $today = date('Y-m-d');
        $start_date = $date . '-01 00:00:00';
        $end_date = $today . ' 24:00:00';
        $select = "a.maker_name,a.LOA_name as LAO_name,a.releaser_name,a.authorised_on,a.released_on,a.returned_on,a.rejected_on,a.created_on,a.customer_reference_number as ref_number";
        $this->db->select($select);
        $this->db->from(TBL_ANNEXURE_TEMP . " a");
        $where = "(a.id = '$id')";
        $this->db->where($where);
        $query = $this->db->get();
        $records = $query->result_array();
        return $records[0];
    }

    function getSuccessTrans($zone_id)
    {
        if ($zone_id == 'ALL') {
            $con = "(a.annexure_status=11)";
        } else {
            $con = "(a.zone_id in ($zone_id)) and a.annexure_status=11";
        }
        $select = "COUNT(a.id) AS total_bene,SUM(a.net_amount) AS total_amount";
        $this->db->select($select);
        $this->db->from('unclaimed_temp a');
        $this->db->where($con);
        $this->db->where('a.is_error', 5);
        $this->db->order_by("a.id", "DESC");
        $query = $this->db->get();
        $records = $query->result_array();
        // echo "<pre>"; print_r($this->db->last_query());exit;
        return $records[0];
    }

    function returnData($zone_id)
    {
        if ($zone_id == 'ALL') {
            $con = "(a.annexure_status=6)";
        } else {
            $con = "(a.zone_id in ($zone_id)) and a.annexure_status=6";
        }
        $select = "COUNT(a.id) AS total_bene,SUM(a.net_amount) AS total_amount";
        $this->db->select($select);
        $this->db->from('unclaimed_temp a');
        $this->db->where($con);
        $this->db->where('a.is_error', 5);
        $this->db->order_by("a.id", "DESC");
        $query = $this->db->get();
        $records = $query->result_array();
        // echo "<pre>"; print_r($this->db->last_query());exit;
        return $records[0];
    }

    function pendingAtLAOData($zone_id)
    {
        if ($zone_id == 'ALL') {
            $con = "(a.annexure_status=2)";
        } else {
            $con = "(a.zone_id in ($zone_id)) and a.annexure_status=2";
        }
        $select = "COUNT(a.id) AS total_bene,SUM(a.net_amount) AS total_amount";
        $this->db->select($select);
        $this->db->from('unclaimed_temp a');
        $this->db->where($con);
        $this->db->where('a.is_error', 5);
        $this->db->order_by("a.id", "DESC");
        $query = $this->db->get();
        $records = $query->result_array();
        // echo "<pre>"; print_r($this->db->last_query());exit;
        return $records[0];
    }


}
