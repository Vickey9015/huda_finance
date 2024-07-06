<?php

class SftpProcess extends CI_Controller {

	function sendFile(){
	include './phpseclib/Net/SFTP.php';
	//$sftp = new Net_SFTP('14.141.166.251');
	$sftp = new Net_SFTP('10.24.119.210');
    if (!$sftp->login('colftpuser1', 'June@2016')) {
        exit('Login Failed');
    }
      $sftp->pwd() . "\r\n";
      //print_r(SOURCE_LOCAL_FILE);die;
    // echo "<pre>=====";print_r($sftp->nlist());die;
    //$path = "/home/colftpuser1/HUDA/DD_Upload/IN/";
    $path = "/home/colftpuser1/HUDA/Higher_Court/IN/";
    //$path = "/home/colftpuser1/HUDA/Original_Award/IN/";
   // $path = "/home/colftpuser1/HUDA/Supreme_Court/IN/";
    
//$list = $sftp->nlist($path);
//echo "<pre>======";print_r($list);die;
//$res = $this->uploadfiles('/home/colftpuser1/HUDA/DD_Upload/IN/test.txt');
//$filename = '/home/colftpuser1/HUDA/DD_Upload/IN/DD_updated_n111.xlsx';
$filename = '/home/colftpuser1/HUDA/Higher_Court/IN/HC_01_20180615110209.xlsx';
//$filename = '/home/colftpuser1/HUDA/Original_Award/IN/OA_01_20180615110108.xlsx';
//$filename = '/home/colftpuser1/HUDA/Supreme_Court/IN/SC_01_20180615105705.xlsx';

//$filename = '/home/colftpuser1/HUDA/DD_Upload/IN/';
//$list = $sftp->nlist($filename);
//echo "<pre>======";print_r($list);die;
//$data = file_get_contents("logo.png");
$local_file_path='HC_01_20180615110209.xlsx';
//$local_file_path='DD1.xlsx';
      $res =  $sftp->put($filename, $local_file_path,1);
      //$res =  $sftp->get($filename, $local_file_path);
      //$res = fopen("home/colftpuser1/HUDA/DD_Upload/OUT/DD_test.xlsx", 'r');
echo "<pre>======";print_r($res);die;
	}

	function viewFile(){
	include './phpseclib/Net/SFTP.php';
	//use phpseclib\Net\SFTP;
	$sftp = new Net_SFTP('10.24.119.210');
if (!$sftp->login('colftpuser1', 'June@2016')) {
    exit('Login Failed');
}
     
      $sftp->pwd() . "\r\n";
$filename = '/home/colftpuser1/HUDA/DD_Upload/IN/';
$list = $sftp->nlist($filename);
//$res =  $sftp->get($filename.'/'.$list[1], $list[1]);
echo "<pre>======";print_r($list);die;
//$data = file_get_contents("logo.png");
$local_file_path='DD_updated_n111.xlsx';
//$local_file_path='DD1.xlsx';
      $res =  $sftp->put($filename, $local_file_path,1);
echo "<pre>======";print_r($res);die;
	}
		function uploadFile($folder = DD_Upload, $type= 'DD',$file_name=null){
	        include './phpseclib/Net/SFTP.php';
			
	        //$file_name = $type.'_'.date("Ymd").'.xlsx';
			//$file_name = "DD_20180822.xlsx";
	        echo "Processing upload file" . $file_name; die;
	        $sftp = new Net_SFTP('10.24.119.210');
            if (!$sftp->login('colftpuser1', 'June@2016')) {
                exit('Login Failed');
            }
            $sftp->pwd() . "\r\n";
           // $filename = '/home/colftpuser1/HUDA/DD_Upload/OUT/DD_updated_n111R.xlsx';
            $filename = '/home/colftpuser1/HUDA/'.$folder.'/IN/'.$file_name;
			echo $filename;
            $local_file_path='SFTP_HUDA/OUT/'.$type.'/'.$file_name;
            $res =  $sftp->put($filename, $local_file_path,1);
            echo "<pre>======";print_r($res);die;
	    }
	    
		function downloadFile($folder = DD_UPLOAD_OUT, $type= 'DD'){
	        include './phpseclib/Net/SFTP.php';
	        $file_name = $type.'_'.date("Ymd").'R.xlsx';
	        $sftp = new Net_SFTP('14.141.166.251');
            if (!$sftp->login('colftpuser1', 'June@2016')) {
                exit('Login Failed');
            }
            $sftp->pwd() . "\r\n";
           // $filename = '/home/colftpuser1/HUDA/DD_Upload/OUT/DD_updated_n111R.xlsx';
            $filename = $folder.'/'.$file_name;
            $local_file_path='SFTP_HUDA/IN/'.$type.'/'.$file_name;
            $res =  $sftp->get($filename, $local_file_path);
            echo "<pre>======";print_r($res);die;
	    }
}
?>