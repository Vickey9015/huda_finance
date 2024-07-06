<?php

class encodecProcess extends CI_Controller {

	function encodeFile(){
	    exec('java -jar Encrypt/ibl-col-encrypt.jar', $output);
        print_r($output);
	}
}
?>