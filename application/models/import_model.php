<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Import Model
 *
 * @author TechArise Team
 *
 * @email  info@techarise.com
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Import_model extends CI_Model {

    private $_batchImport;

    public function setBatchImport($batchImport) {
        $this->_batchImport = $batchImport;
    }

    // save data
    public function importData($data) {
        //$data = $this->_batchImport;
       $res = $this->db->insert_batch('annexure_temp', $data);
    }
    public function importAnnexure($data) {
        //echo "<pre>=data=====";print_r($data);
        $this->db->insert('annexure_temp', $data);
    }
    public function addFileDetails($data) {
        //echo "<pre>=data=====";print_r($data);
        $this->db->insert('annexure_file_status', $data);
    }
    // get employee list
    public function employeeList() {
        $this->db->select(array('e.id', 'e.first_name', 'e.last_name', 'e.email', 'e.dob', 'e.contact_no'));
        $this->db->from('import_model as e');
        $query = $this->db->get();
        return $query->result_array();
    }

}

?>