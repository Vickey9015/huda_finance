<?php
ini_set("display_errors", "1");
ini_set('memory_limit','2048M');
error_reporting(E_ALL);
class UnclaimedCron extends CI_Controller {

    function __construct() {
        $data =array();
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $data  =array('is_logged_in'=>$this->session->userdata('logged_in'));
       
        $this->load->model('unclaimedcron_model');
              
        $this->load->helper('url');
        $this->load->helper('common_helper');
        $this->load->library('session');
        //$this->load->library('curl');
        //require 'spreadsheet/vendor/autoload.php';
        //require 'spreadsheet/src/PhpSpreadsheet/Writer/Xlsx.php';
        //include the classes needed to create and write .xlsx file
        //use PhpOffice\PhpSpreadsheet\Spreadsheet;
        //use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    }

    function checkEmptyFields(){
       
       $res=$this->unclaimedcron_model->getFileList();
      // echo "<pre>=";print_r($res[0]);exit(); 
       
       if (!empty($res)) {
        $id=$res[0]['file_id'];
       // $filerefnum=$res[0]['file_ref_number'];
    
        $res=$this->unclaimedcron_model->updateEmpty($id);


       echo "Success";exit();
                                                                                                                                                                                   
      }else{

        echo "Data Not Found";exit();  

      }  
        
    }

  function checkDuplicateRefNumber(){
      $res=$this->unclaimedcron_model->getFileToCheckDuplicate();
       if (!empty($res)) {
       // echo '<pre>';print_r($res);exit();
        $file_ref=$res[0]['reference_number'];
        $id=$res[0]['id'];
          $res=$this->unclaimedcron_model->updateDuplicate($file_ref,$id);


          echo "Success";exit();
       }else{
         echo "File Not found";exit();
       }
       

        
    }
    

    function fileStatus(){
       
       $res=$this->unclaimedcron_model->updateFileStatus();

    

       echo "Success";exit();                                                                                                                                                                               

        
    }
    
   
    
}

?>
