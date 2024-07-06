<?php

/**
 * Description of Import Model
 *
 * @author TechArise Team
 *
 * @email  info@techarise.com
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fileupload_model extends CI_Model {

    private $_batchImport;

 
  
    public function addFileDetails($data) {
        //echo "<pre>=data=====";print_r($data);
        $this->db->insert('unclaimed_file_status', $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    
   
   public function importData($data) {
        //$data = $this->_batchImport;
        $this->db->insert_batch('unclaimed_temp', $data);
    }

}

?>