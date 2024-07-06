<?php

class Action_model extends CI_Model {
    public $error       = array();
    public $error_count = 0;
    public $user_type    = 0;
    
    public function __construct() 
    {
        parent::__construct();
    }
        function getPendingActions(){
            $query =$this->db->select('cat.*,u.name as maker_name,u1.name as user')
                    ->from('change_audit_trail as cat')
                    ->join('user as u','cat.maker_id = u.id','left')
                    ->join('user as u1','cat.reference_id = u1.id and (cat.type="user" or cat.type="user_zone_mapping")','left')
                    ->where('cat.checker_id',0);
            $result =  $query->get()->result_array();
            $i = 0;
            foreach($result as $re){
                if($re['type'] == 'user_zone_mapping'){
                    $zone_ids = explode(",",$re['old_data']);
                    $query =$this->db->select('GROUP_CONCAT(zm.name) as zones')
                    ->from('zone_master as zm')
                    ->where_in('id',$zone_ids);
                    $result1 =  $query->get()->row_array();
                    $result[$i]['old_data'] = $result1['zones'];
                    
                    $new_zone_ids = explode(",",$re['new_data']);
                    $query =$this->db->select('GROUP_CONCAT(zm.name) as zones')
                    ->from('zone_master as zm')
                    ->where_in('id',$new_zone_ids);
                    $result2 =  $query->get()->row_array();
                    $result[$i]['new_data'] = $result2['zones'];
                }
                $i ++;
            }
            //echo "<pre>"; print_r($result);die;
            return $result;
        }
        
        function updatePendingActions($id,$data) {
            return $this->db->where('id',$id)->update('change_audit_trail',$data);
        }
        
        function getPendingActionsById($id){
            $query =$this->db->select('cat.*')
                    ->from('change_audit_trail as cat')
                    ->where('id',$id);
            $result =  $query->get()->row_array();
            return $result;
        }
        
        function updateChange($table,$column,$where,$data){
            return $this->db->where($column,$where)->update($table,$data);
        }
        
        function checkUserDetailsById($id){
            $query =$this->db->select('u.id,u.name,u.phone,u.email')
                    ->from('user as u')
                    ->where('id',$id);
            $result =  $query->get()->row_array();
            return $result;
        }
        
        function addChangeAudit($data){
            $this->db->insert('change_audit_trail', $data);
        }
        
        function checkChange($table,$column,$where){
            $query =$this->db->select('id')
                    ->from($table)
                    ->where($column,$where);
            $result =  $query->get()->row_array();
            return $result;
        }
        
        function checkUserZonesById($user_id){
            $query =$this->db->select('id,zone_id')
                    ->from('user_zone_mapping')
                    ->where('user_id',$user_id)
                    ->where('is_active',1);
            $result =  $query->get()->result_array();
            return $result;
        }
   
}