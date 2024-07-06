<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

/*
 * Changes:
 * 1. This project contains .htaccess file for windows machine.
 *    Please update as per your requirements.
 *    Samples (Win/Linux): http://stackoverflow.com/questions/28525870/removing-index-php-from-url-in-codeigniter-on-mandriva
 *
 * 2. Change 'encryption_key' in application\config\config.php
 *    Link for encryption_key: http://jeffreybarke.net/tools/codeigniter-encryption-key-generator/
 * 
 * 3. Change 'jwt_key' in application\config\jwt.php
 *
 */

class Auth extends REST_Controller
{
    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: GET
     */
	
	function __construct() {
        $data =array();
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $data  =array('is_logged_in'=>$this->session->userdata('logged_in'));
       
        $this->load->model('user_model');
		
        //$this->load->library('curl');
        //require 'spreadsheet/vendor/autoload.php';
		//require 'spreadsheet/src/PhpSpreadsheet/Writer/Xlsx.php';
		//include the classes needed to create and write .xlsx file
		//use PhpOffice\PhpSpreadsheet\Spreadsheet;
		//use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    }
	
    public function token_get()
    {
		//echo "<pre>===="; print_r($_SERVER); exit;
        $tokenData = array();
        $tokenData['id'] = 'pankaj'; //TODO: Replace with data for token
        $output['token'] = AUTHORIZATION::generateToken($tokenData);
		
        $this->set_response($output, REST_Controller::HTTP_OK);
		//echo "<pre>====".REST_Controller::HTTP_OK; print_r($output); exit;
    }

    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: POST
     * Header Key: Authorization
     * Value: Auth token generated in GET call
     */
    public function token_post()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                $this->set_response($decodedToken, REST_Controller::HTTP_OK);
                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }
	
	public function login_post()
    {
		
        $dataPost = $this->input->post();
		
        $user = $this->user_model->login($dataPost['username'], $dataPost['password']);
		//echo "<pre>===="; print_r($user); exit;
        if ($user != null) {
			$user=$user[0];
            $tokenData = array();
            $tokenData['id'] = $user['id'];
            $response['token'] = Authorization::generateToken($tokenData);
            $this->set_response($response, REST_Controller::HTTP_OK);
            return;
        }
        $response = [
            'status' => REST_Controller::HTTP_UNAUTHORIZED,
            'message' => 'Unauthorized',
        ];
        $this->set_response($response, REST_Controller::HTTP_UNAUTHORIZED);
    }
	
	
}