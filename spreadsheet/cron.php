<?php

class cron extends CI_Controller {

    function __construct() {
        $data =array();
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $data  =array('is_logged_in'=>$this->session->userdata('logged_in'));
       
        $this->load->model('user_model');
        $this->load->model('authentication_model');        
        $this->load->helper('url');
        $this->load->helper('common_helper');
        $this->load->library('session');
        //$this->load->library('curl');
        require 'spreadsheet/vendor/autoload.php';
		require 'spreadsheet/src/PhpSpreadsheet/Writer/Xlsx.php';
		//include the classes needed to create and write .xlsx file
		//use PhpOffice\PhpSpreadsheet\Spreadsheet;
		//use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    }

 function update(){
		$result = $this->authentication_model->updateInProcessStatus();
		$this->load->view('layout/footer');
	}
	
   function createExcel(){
   		require_once 'PHPExcel.php';
require_once 'PHPExcel/IOFactory.php';

		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		
		// Create a first sheet, representing sales data
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Something');
		
		// Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle('Name of Sheet 1');
		
		// Create a new worksheet, after the default sheet
		$objPHPExcel->createSheet();
		
		// Add some data to the second sheet, resembling some different data types
		$objPHPExcel->setActiveSheetIndex(1);
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'More data');
		
		// Rename 2nd sheet
		$objPHPExcel->getActiveSheet()->setTitle('Second sheet');
		
		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="name_of_file.xls"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
	}	

}

?>