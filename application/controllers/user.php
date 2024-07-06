<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
class User extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        $data = array();
        parent::__construct();
        $this->output->_display_cache($data, $data);
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->load->library('session');
        $this->load->helper('url');
        $data  = array('is_logged_in' => $this->session->userdata('logged_in'));
        $session_data = $this->session->all_userdata();

        if (!empty($session_data)) {
            $this->approver_id =  $session_data['id'];
            $this->role_id = $session_data['role_id'];
        }
        $this->load->model('user_model');
        $this->load->model('stats_model');
        $this->load->library('form_validation');
        $this->load->model('authentication_model');
        $this->user_model->check_role();
        $this->load->helper('common_helper');
        $this->ip = getenv('HTTP_CLIENT_IP') ?:
            getenv('HTTP_X_FORWARDED_FOR') ?:
            getenv('HTTP_X_FORWARDED') ?:
            getenv('HTTP_FORWARDED_FOR') ?:
            getenv('HTTP_FORWARDED') ?:
            getenv('REMOTE_ADDR');
    }

    function index()
    {

        if ($this->session->userdata('logged_in')) {
            if ($this->role_id == 6) {
                redirect(base_url() . 'admin/bankmemberView');
            } else if ($this->role_id == 7) {
                redirect(base_url() . 'member/memberView');
            } else if ($this->role_id == 8) {
                redirect(base_url() . 'member/bankCheckerView');
            } else if ($this->role_id == 3 or $this->role_id == 4 or $this->role_id == 5 or $this->role_id == 9) {
                echo "rahul";
                exit;
                redirect(base_url() . 'home/dashboard');
            } else {
                $data = array();
                $this->load->view('login', $data);
            }
        }
        //  echo "rahul"; exit;
        $session_data = $this->session->all_userdata();

        //echo "<pre>====="; print_r($session_data); exit;
        $data = array();
        $this->load->view('login', $data);
        // $this->load->view('layout/footer', $data);
        //  $this->load->view('popup', $data);
    }

    function logout()
    {
        $user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) {
            if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                $this->session->unset_userdata($key);
            }
        }

        $this->session->sess_destroy();
        redirect(base_url());
    }

    public function login()
    {
        try {
            if ($this->input->server('REQUEST_METHOD') != 'POST') {
                redirect(base_url());
            }
            if ($this->session->userdata('logged_in')) {
                if ($this->role_id) {
                    redirect(base_url());
                }
            }
            $this->form_validation->set_rules('username', 'Username', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('CaptchaInput', 'Captch Input', '');
            $re = $this->form_validation->run();

            if ($re == FALSE) {
                $data = array();
                // echo "correct captcha"; die();
                $this->load->view('login', $data);
            } else {
                //echo "<pre>====="; print_r($_REQUEST); die();
                $email    = strip_tags($_REQUEST['username']);
                $password = strip_tags($_REQUEST['password']);
                $captchaInput = strip_tags($_REQUEST['CaptchaInput']);
                $sessionCaptcha  = $this->session->userdata('custom_cap');
                $password = hash_hmac(ENCTYPE, $password, SHA512ENCKEY);
                // Input validations
                // echo "<pre>=====";
                // print_r($email);
                // echo "<pre>=====";
                // print_r($password);
                // echo "<pre>=====";
                // print_r($sessionCaptcha);
                // echo "<pre>=====";
                // print_r($captchaInput);
                // die();
                if (!empty($email) and !empty($password)) {
                    if (1) {
                        // echo "correct captcha";
                        // die();
                        //  $password = md5($password);
                        //  $key = $this->config->item('encryption_key');
                        //                 $password = $this->encrypt->decode($password);
                        // echo "<pre>====="; print_r($password); die();
                        $select  = "id,incorrect_attempts,role_id,maker_id,checker_id,is_active";
                        $this->db->select($select);
                        $this->db->from('user');
                        $where   = "(email='$email')";
                        $this->db->where($where);
                        $query = $this->db->get();
                        //echo $this->db->last_query(); die;
                        $result_user = $query->result_object();
                        // echo "<pre>=====";
                        // print_r($result_user);
                        // die();
                        if ($result_user) {
                            $res_roles = [3, 4, 5, 9];
                            if ($result_user[0]->is_active == 0) {
                                $messge = array('message' => 'User locked. Please contact Bank for activation');
                                $this->session->set_flashdata('item', $messge);
                                redirect(base_url());
                            }
                            if (in_array($result_user[0]->role_id, $res_roles) && $result_user[0]->checker_id == 0) {
                                $messge = array('message' => 'Pending Verification from Bank');
                                $this->session->set_flashdata('item', $messge);
                                redirect(base_url());
                            }


                            //echo "<pre>.."; print_r($password);
                            // print_r($_POST);
                            $id = $result_user[0]->id;
                            //                $select="id,password_hash";
                            //                $this->db->select($select);
                            //                $this->db->from('password_history');
                            //                $where = "(user_id='$id' and password_hash='$password'and is_active = 1)";
                            //                $this->db->where($where);
                            //                $query = $this->db->get();
                            //          //echo $this->db->last_query(); die;
                            //                $result_pass= $query->result_array();
                            // $result_pass = $this->authentication_model->check_login($email, $password);
                            // //  echo "<pre>====="; print_r($result_pass); die();
                            // $plain_password = $result_pass;
                            // $dbId =  $id;
                            // //echo "<pre>====="; print_r('===xdsd=='.$plain_password .'==cdcsd== '.$password.'==ss=='.$dbId); die();
                            // $plain_password = '';
                            // if ($result_pass) {
                            //     $key = $this->config->item('encryption_key');
                            //     $plain_password = $result_pass;
                            //     // $plain_password = $this->encrypt->decode($result_pass, $key);
                            //     //echo "<pre>====="; print_r($plain_password); die();
                            // }
                            // if ($plain_password  == $password) {
                            //     $checkValidity = $this->authentication_model->validityPass($dbId, $password);
                            //     //echo "<pre>====="; print_r($checkValidity); die();
                            //     if ($checkValidity) {
                            //         $dbDate = strtotime($checkValidity[0]['created_on']);
                            //         //echo date('Y-m-d', strtotime($checkValidity[0]['created_on']. ' + 45 days'));
                            //         $dateExp = date('Y-m-d');
                            //         $expireDate =  date_create($dateExp);
                            //         //echo "<pre>====="; print_r($dbDate); die();exit();
                            //         $expireDate =  strtotime($dateExp);

                            //         //$diff = date_diff($dbDate,$expireDate);
                            //         $expireDays = floor(($expireDate - $dbDate) / 60 / 60 / 24);
                            //         //count days
                            //         //$expireDays = $diff->format("%a");
                            //         if ($expireDays >= 45) {
                            //             $messge = array('message' => 'Password has been expired ! Please Reset Password !');
                            //             $this->session->set_flashdata('item', $messge);
                            //             redirect(base_url());
                            //             //echo "Password hasbeen expired";
                            //         }
                            //     }
                            // }
                        } else {
                            $messge = array('message' => 'Incorrect username and password');
                            $this->session->set_flashdata('item', $messge);
                            redirect(base_url());
                        }
                        // print_r($password);
                        // die;
                        if ($result_user && ($password)) {
                            $sql = "SELECT
                            u.id,
                            u.name,
                            email,
                            u.role_id,
                            u.is_new_user,
                            u.zone_id,
                            u.last_login,
                            u.is_view,
                            r.name    AS role,
                            zm.account_number AS account_number
                            FROM user AS u
                            LEFT JOIN role AS r  ON u.role_id = r.role_id
                            LEFT JOIN (SELECT z.id, GROUP_CONCAT(a.account_number) AS account_number FROM zone_master z 
                            LEFT JOIN account_master a ON a.zone_id=z.id GROUP BY a.zone_id)
                            zm ON zm.id=u.zone_id WHERE email='$email'";
                            $resultquery   = $this->db->query($sql);
                            //echo $this->db->last_query(); die;
                            $result        = $resultquery->result_object();
                        } else {
                            if ($result_user && $result_user[0]->incorrect_attempts < 4) {
                                $attempt_no = $result_user[0]->incorrect_attempts + 1;
                                //$sql_user ="UPDATE user set incorrect_attempts = $attempt_no where id= '$id'";
                                //       $q1 = $this->db->query($sql_user);
                                $this->db->set('incorrect_attempts', $attempt_no); //value that used to update column  
                                $this->db->where('id', $id); //which row want to upgrade  
                                $this->db->update('user');
                                $messge = array('message' => 'Incorrect Password ! You have used ' . ($attempt_no) . ' out of 5 login attempts. After all 5 have been used, you will be unable to login.');
                            } else {
                                //$sql_user ="UPDATE user set is_active = 0 where id= '$id'";
                                //       $q1 = $this->db->query($sql_user);
                                $this->db->set('is_active', 0); //value that used to update column  
                                $this->db->where('id', $id); //which row want to upgrade  
                                $this->db->update('user');
                                $messge = array('message' => 'Your account has been suspended ! contact admin');
                            }
                        }
                        //print_r($result);die;
                        // echo "<pre>=====";
                        // print_r($result);
                        // die;
                        if (!empty($result)) {
                            $data = $result[0];
                            $role_permission = array();
                            $zones = array();
                            $select = "zm.name as zone,zm.id";
                            $this->db->select($select);
                            $this->db->from('user_zone_mapping as uzm');
                            $this->db->join('zone_master as zm', 'uzm.zone_id = zm.id', 'Left');
                            $where = "(uzm.user_id ='$data->id')";
                            $this->db->where($where);
                            $query = $this->db->get();
                            //echo $this->db->last_query(); die;
                            $zoneresult = $query->result_object();
                            //   $zonesql = "SELECT zm.name as zone,zm.id from user_zone_mapping as uzm left join zone_master as zm on uzm.zone_id = zm.id WHERE uzm.user_id = '$data->id'";
                            //   $zonequery   = $this->db->query($zonesql);
                            //   $zoneresult        = $zonequery->result_object();
                            if (!empty($zoneresult)) {
                                foreach ($zoneresult as $key => $value) {
                                    $zones[$key]['name'] = $value->zone;
                                    $zones[$key]['id'] = $value->id;
                                }
                            }
                            //       $sql1 ="SELECT p.name as permissions FROM role_perm rp left Join permission p on rp.perm_id = p.perm_id WHERE rp.role_id='$data->role_id'";
                            //         $sql1query   = $this->db->query($sql1);
                            //      $sql1result        = $sql1query->result_object();
                            $select = "p.name as permissions";
                            $this->db->select($select);
                            $this->db->from('role_perm rp');
                            $this->db->join('permission p', 'rp.perm_id = p.perm_id', 'Left');
                            $where = "(rp.role_id='$data->role_id')";
                            $this->db->where($where);
                            $query = $this->db->get();
                            //  echo $this->db->last_query(); die;
                            $sql1result = $query->result_object();
                            foreach ($sql1result as $key => $value) {
                                $role_permission[$key] = $value->permissions;
                            }
                            // $sql2 ="UPDATE user set incorrect_attempts = 0 where id= '$id'";
                            //   $qr = $this->db->query($sql2);
                            $this->db->set('incorrect_attempts', 0); //value that used to update column  
                            $this->db->where('id', $id); //which row want to upgrade  
                            $this->db->update('user');
                            $role_id = $data->role_id;
                            $newUser = $data->is_new_user;
                            $lastlogin = $data->last_login;
                            $isview = $data->is_view;
                            $newdata = array("id" => $data->id, "is_view" => $data->is_view, "name" => $data->name, "email" => $data->email, "account_number" => $data->account_number, 'role_id' => $data->role_id, 'role' => $data->role, 'permissions' => $role_permission, 'zones' => $zones, 'zones_option' => $zones, 'last_login' => $lastlogin, 'logged_in' => true);
                            // echo "<pre>=====$role_id====";
                            // print_r($data);
                            // print_r($newdata);
                            // exit;
                            //$this->session->sess_destroy();
                            $data = $this->session->set_userdata($newdata);
                            // echo "<pre>=====$role_id====";
                            // print_r($data);
                            // exit;
                            // To Prevent multiple Login    
                            // $session_id = $this->session->userdata('session_id');
                            // $this->user_model->setSession($data->id, $session_id);
                            $session_data  = $this->session->all_userdata();
                            // echo "<pre>..";
                            // print_r($session_data);
                            // // header('location:' . base_url() . "home/dashboard");
                            // die;

                            redirect(base_url() . "home/dashboard");
                            exit();

                            // echo "<pre>..";
                            // print_r($session_data);
                            // exit;


                            //echo 'location:' . base_url() . "user/studentdata" . $this->index(); exit;
                            /*if($usertype==1 or $usertype==2){
                            //echo "<pre>====="; print_r($_REQUEST); exit;
                            header('location:' . base_url() . "home/dashboard" . $this->index());
                            }else{
                            header('location:' . base_url() . "user/index?msg=error" . $this->index());
                            //header('location:' . base_url() . "home/dashboard" . $this->index());
                            }*/
                            if ($role_id == 1 or $role_id == 2 or $role_id == 5 or ($role_id == 6 and $isview == 1) or $role_id == 9 or ($role_id == 3 and !empty($zoneresult)) or ($role_id == 4 and !empty($zoneresult))) {
                                //echo "<pre>====="; print_r($newUser); die;
                                // echo "<pre>=====$role_id";
                                // print_r($_REQUEST);
                                // exit;
                                if ($newUser == 1) {
                                    $session_data = $this->session->all_userdata();
                                    $this->db->set('last_login', date('Y-m-d H:i:s')); //value that used to update column  
                                    $this->db->where('id', $session_data['id']); //which row want to upgrade  
                                    $this->db->update('user');
                                    header('location:' . base_url() . "member/changenewpassword");
                                } else {



                                    // echo "<pre>-------------";
                                    // print_r(base_url() . "home/dashboard" . $this->index());
                                    // exit;
                                    header('location:' . base_url() . "home/dashboard" . $this->index());
                                }
                            } elseif ($role_id == 6 && $isview == 0) {
                                $session_data = $this->session->all_userdata();
                                $this->db->set('last_login', date('Y-m-d H:i:s')); //value that used to update column  
                                $this->db->where('id', $session_data['id']); //which row want to upgrade  
                                $this->db->update('user');
                                $ip =  explode('.', $this->ip);
                                header('location:' . base_url() . "admin/bankmemberView");
                                /*if($ip[0] == '10' && $ip[1] == '24'){
                                    //  echo "<pre>=====$role_id=====1111"; print_r($_REQUEST); exit;
                                    header('location:' . base_url() . "admin/bankmemberView");
                                }else{
                                    $this->session->sess_destroy();
                                    redirect(base_url());
                                }*/
                            } elseif ($role_id == 7) {
                                $session_data = $this->session->all_userdata();
                                $this->db->set('last_login', date('Y-m-d H:i:s')); //value that used to update column  
                                $this->db->where('id', $session_data['id']); //which row want to upgrade  
                                $this->db->update('user');
                                //  echo "<pre>=====$role_id=====1111"; print_r($_REQUEST); exit;
                                header('location:' . base_url() . "member/memberView");
                            } elseif ($role_id == 8) {
                                $session_data = $this->session->all_userdata();
                                $this->db->set('last_login', date('Y-m-d H:i:s')); //value that used to update column  
                                $this->db->where('id', $session_data['id']); //which row want to upgrade  
                                $this->db->update('user');
                                //  echo "<pre>=====$role_id=====1111"; print_r($_REQUEST); exit;
                                header('location:' . base_url() . "member/bankCheckerView");
                            } else {
                                $messge = "Zone Not Assigned";
                                echo "<pre>-------------";
                                print_r($messge);
                                exit;
                                //    header('location:' . base_url() . "user/index?msg=error" . $this->index());
                                //header('location:' . base_url() . "home/dashboard" . $this->index());
                            }
                        } else {
                            $messge = array('message' => 'Please Enter Valid Details');
                            $this->session->set_flashdata('item', $messge);
                            echo "<pre>--------------";
                            print_r($messge);
                            exit;

                            redirect(base_url());
                        }
                    } else {
                        //echo "Invalid captcha"; die();
                        $messge = array('message' => 'Please Enter Valid Captcha');
                        $this->session->set_flashdata('item', $messge);
                        echo "<pre>-------------";
                        print_r($messge);
                        exit;
                        redirect(base_url());
                    }
                } else {
                    //echo "Invalid captcha"; die();
                    $messge = array('message' => 'Please Enter Valid Captcha');
                    // $this->session->set_flashdata('item', $messge);
                    echo "<pre>-------------";
                    print_r($messge);
                    exit;
                    redirect(base_url());
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            $this->response($this->json($e), 400);
        }
    }

    public function forgotpassword()
    {
        $data = array();
        $this->load->view('forgotPassword', $data);
    }

    public function forgotPasswordOtp()
    {
        try {
            $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|xss_clean|min_length[10]|max_length[10]|numeric');
            $this->form_validation->set_rules('CaptchaInput', 'Captcha Input', 'trim|required|xss_clean|min_length[6]|max_length[6]');
            //$this->form_validation->set_rules('otp', 'otp', 'trim|required|xss_clean|min_length[6]|max_length[6]|numeric');
            $re = $this->form_validation->run();
            if ($re == FALSE) {
                redirect(base_url());
            } else {
                $phone      = $this->input->post('mobile');
                $resp  = $this->authentication_model->validateMobile($phone);
                $getmobile = $resp[0]['phone'];
                $captchaInput = $_REQUEST['CaptchaInput'];
                $sessionCaptcha  = $this->session->userdata('custom_cap');
                if (!empty($getmobile) and !empty($phone) and !empty($captchaInput) and !empty($sessionCaptcha)) {
                    if ($captchaInput == $sessionCaptcha) {
                        if ($getmobile == $phone) {
                            $otp = mt_rand(100000, 999999);
                            $otpArray = array(
                                'otp'       => $otp
                            );
                            $this->db->where('phone', $phone);
                            $result = $this->db->update('user', $otpArray);
                            if ($result) {
                                $res =   "$otp  is your OTP for change password. Please do not share with anyone. - IndusInd Bank";
                                //echo "<pre>======"; print_r($res); exit;
                                $sendOtp = sendMessageByFirstValue($phone, str_replace("*", $otp, $res), 1);

                                $message = array("status" => 1, "msg" => "Password reset OTP sent on your registered mobile.");
                                $this->session->set_flashdata('item', $messge);
                                //echo "<pre>======"; print_r($message); exit;
                                $this->session->set_userdata('otp', 1);
                                header('location:' . base_url() . "user/changepassword");
                            } else {
                                $message = array("status" => 0, "msg" => "User Does not exists.");
                                $this->session->set_flashdata('item', $messge);
                            }
                        } else {
                            $messge = array('message' => 'Invalid User or Mobile !');
                            $this->session->set_flashdata('item', $messge);
                            header('location:' . base_url() . "user/forgotpassword");
                        }
                    } else {
                        $messge = array('message' => 'Invalid Captcha !');
                        $this->session->set_flashdata('item', $messge);
                        header('location:' . base_url() . "user/forgotpassword");
                    }
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            $error = array('status' => 0, "msg" => "Internal Server Error - Please try Later.", "StatusCode" => "NP001");
            $this->response($error, 200);
        }
    }

    public function validatePhone()
    {
        // echo "<pre>======"; print_r("sdsdsdsdsds"); exit;
        try {
            $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|xss_clean|min_length[10]|max_length[10]|numeric');
            $re = $this->form_validation->run();
            if ($re == FALSE) {
                redirect(base_url());
            } else {
                $phone = $this->input->post('mobile');
                $resp  = $this->authentication_model->validateMobile($phone);
                //echo "<pre>======"; print_r($resp[0]['phone']); exit;
                $getmobile = $resp[0]['phone'];
                if ($getmobile == $phone) {
                    echo "true";
                } else {
                    echo "false";
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            $error = array('status' => 0, "msg" => "Internal Server Error - Please try Later.", "StatusCode" => "NP001");
            $this->response($error, 200);
        }
    }

    public function changepassword()
    {
        //echo "<pre>======"; print_r($this->session->userdata('otp')); exit;
        if ($this->session->userdata('otp') != 1) {
            redirect(base_url() . 'user/forgotpassword');
        }
        $data = array();
        $this->load->view('changePassword', $data);
    }

    public function changeforgetpassword()
    {
        try {

            $this->form_validation->set_rules('otp', 'otp', 'trim|required|xss_clean|min_length[6]|max_length[6]|numeric');
            $this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean|min_length[8]|max_length[16]|regex_match[/^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$/]');
            $this->form_validation->set_rules('confpassword', 'confirm password', 'required');
            $re = $this->form_validation->run();
            if ($re == FALSE) {
                redirect(base_url());
            } else {
                $otp           = strip_tags($this->input->post('otp'));
                $password      = strip_tags($this->input->post('password'));
                $confPassword  = strip_tags($this->input->post('confpassword'));
                //$newPass = md5($password);
                $key = $this->config->item('encryption_key');
                //$newPass = $this->encrypt->encode($confPassword, $key);
                $newPass = hash_hmac(ENCTYPE, $password, SHA512ENCKEY);
                //  echo "<pre>======"; print_r($otp); exit;
                if (!empty($confPassword) and !empty($otp) and !empty($password)) {
                    $sql = "SELECT  a.id,a.name,a.email,a.phone FROM user a WHERE a.otp='$otp'";
                    $resultquery   = $this->db->query($sql);
                    $result        = $resultquery->result_array();
                    //echo "<pre>======"; print_r($result); exit;
                    //check valid otp from user table
                    if (!empty($result)) {
                        $id  = $result[0]['id'];
                        $email = $result[0]['email'];
                        $resultPass = $this->authentication_model->validatePass($id, $password);
                        //echo "<pre>======"; print_r($resultPass); exit;
                        //check last five password from password_history table
                        if ($resultPass == 0) {
                            $messge = array('message' => 'Password already used!');
                            $this->session->set_flashdata('item', $messge);
                            header('location:' . base_url() . "user/changepassword");
                        } else {
                            //update password from user table
                            $statusArray = array('password' => $newPass);
                            $this->db->where('id', $id);
                            $updated_id = $this->db->update('user', $statusArray);

                            //update status 0 from password_history table
                            $statusActiveArray = array('is_active' => 0);
                            $this->db->where('user_id', $id);
                            $updated_status = $this->db->update('password_history', $statusActiveArray);

                            //insert password in password_history table
                            $pwd_hash_array = array("user_id" => $id, "password_hash" => $newPass);
                            $res11 = $this->db->insert('password_history', $pwd_hash_array);

                            $messge = array('message' => 'Password Change Successfully !');
                            $this->session->unset_userdata('otp');
                            $this->session->set_flashdata('item', $messge);
                            header('location:' . base_url() . "user/index");
                        }
                    } else {
                        $messge = array('message' => 'Invalid OTP !');
                        $this->session->set_flashdata('item', $messge);
                        header('location:' . base_url() . "user/changepassword");
                    }
                } else {
                    $error = array('status' => 0, "msg" => 'invalid Credentials.');
                    $this->response($message, 200);
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            $error = array('status' => 0, "msg" => "Internal Server Error - Please try Later.", "StatusCode" => "NP001");
            $this->response($error, 200);
        }
    }

    public function sendOtp()
    {
        try {
            if ($this->input->server('REQUEST_METHOD') != 'POST') {
                $error = array('status' => "Failed", "msg" => "Invalid credential.");
                $this->response($this->json($error), 406);
            }
            //echo $tPassword;die;
            $session_data = $this->session->all_userdata();
            $user_id        = $session_data['id'];
            $status = 1;
            if (!empty($status)) {
                $resp  = $this->authentication_model->authenticateUser($user_id, 'self');
                //print_r($resp);die;
                if (!empty($resp)) {
                    $phone = $resp[0]['phone'];
                    $otp = createOTP();
                    updateUserOTP($user_id, $otp);
                    $message = "$otp  is your OTP for login. Please do not share with anyone. - IndusInd Bank";
                    sendMessageByFirstValue($phone, $message, 1);
                    $message = array("status" => 1, "data" => $resp, "StatusCode" => "NP000");
                } else {
                    $message = array("status" => 0, "data" => $resp[0], "StatusCode" => "NF003");
                }
                $this->response($this->json($message), 200);
            }
        } catch (Exception $e) {
        }
    }

    public function verifyOTP()
    {
        try {
            if ($this->input->server('REQUEST_METHOD') != 'POST') {
                $error = array('status' => "Failed", "msg" => "Invalid credential.");
                $this->response($this->json($error), 406);
            }
            if (isset($_POST['otp'])) {
                $this->form_validation->set_rules('otp', 'otp', 'trim|required|xss_clean|min_length[6]|max_length[6]|numeric');
                $re = $this->form_validation->run();
                if ($re == FALSE) {
                    $message = array("status" => 0, "data" => 'Incorrect OTP.', "StatusCode" => "NF003");
                    $this->response($this->json($message), 200);
                } else {
                    $otp = strip_tags($_POST['otp']);
                }
            }
            $session_data = $this->session->all_userdata();
            $user_id        = $session_data['id'];
            $status = 1;
            if (!empty($status)) {
                $resp  = $this->authentication_model->verifyTransactionOTP($user_id, $otp);
                if (!empty($resp)) {
                    $message = array("status" => 1, "data" => $resp, "StatusCode" => "NP000");
                } else {
                    $message = array("status" => 0, "data" => $resp[0], "StatusCode" => "NF003");
                }
                $this->response($this->json($message), 200);
            }
        } catch (Exception $e) {
        }
    }

    public function getAuditData()
    {
        try {
            if ($this->input->server('REQUEST_METHOD') != 'POST') {
                $error = array('status' => "Failed", "msg" => "Invalid credential.");
                $this->response($this->json($error), 406);
            }
            if (isset($_POST['record_id'])) {
                $id = strip_tags($_POST['record_id']);
            }
            $session_data = $this->session->all_userdata();
            // $user_id        = $session_data['id'];
            $status = 1;
            if (!empty($status)) {
                $resp  = $this->stats_model->getAudit($id);
                if (!empty($resp)) {
                    $message = array("status" => 1, "data" => $resp, "StatusCode" => "NP000");
                } else {
                    $message = array("status" => 0, "data" => $resp[0], "StatusCode" => "NF003");
                }
                $this->response($this->json($message), 200);
            }
        } catch (Exception $e) {
        }
    }

    public function zoneUpdate()
    {
        try {
            if ($this->input->server('REQUEST_METHOD') != 'POST') {
                $error = array('status' => "Failed", "msg" => "Invalid credential.");
                $this->response($this->json($error), 406);
            }
            if (isset($_POST['zone_id'])) {
                $this->form_validation->set_rules('zone_id', 'Zone id', 'trim|required|xss_clean|min_length[1]|max_length[3]|alpha_numeric');
                //$this->form_validation->set_rules('zone_name', 'Zone name', 'trim|required|min_length[4]|max_length[2]|numeric');
                $re = $this->form_validation->run();
                if ($re == FALSE) {
                    redirect(base_url());
                } else {
                    $zone_id = strip_tags($_POST['zone_id']);
                    $zone_name = strip_tags($_POST['zone_name']);
                }
            }
            $session_data = $this->session->all_userdata();

            $this->session->unset_userdata('zones');
            //$this->session->sess_destroy();
            //print_r($session_data);die;
            //$session_data['zones'][0]['id'] = $zone;
            //$zones = array(['zones'=> $zone]);
            if ($zone_id == 'All') {
                //print_r($session_data['zones_option']);die;
                $this->session->set_userdata(array('zones' => $session_data['zones_option']));
            } else {
                $zone_query = "SELECT  name FROM zone_master WHERE id='$zone_id'";
                $resultquery   = $this->db->query($zone_query);
                $result        = $resultquery->row_array();
                $zone_name = $result['name'];
                /*switch ($zone_id){
                            case 1: $zone_name = "Gurgaon";
                            break;
                            case 2: $zone_name = "Panchkula";
                            break;
                            case 3: $zone_name = "Faridabad";
                            break;
                            case 4: $zone_name = "Rohtak";
                            break;
                            case 5: $zone_name = "Hisar";
                            break;
                            default: $zone_name = "All";
                        }*/
                $this->session->set_userdata(array('zones' => array(array('name' => $zone_name, 'id' => $zone_id))));
            }
            //print_r($this->session->all_userdata());die;
            $status = 1;
            if (!empty($status)) {
                if (!empty($status)) {
                    $message = array("status" => 1, "data" => $resp, "StatusCode" => "NP000");
                } else {
                    $message = array("status" => 0, "data" => $resp[0], "StatusCode" => "NF003");
                }
                $this->response($this->json($message), 200);
            }
        } catch (Exception $e) {
        }
    }

    function created_captcha()
    {
        $captcha_num = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz';
        $captcha_num = substr(str_shuffle($captcha_num), 0, 6);
        $cap = array();
        $cap['custom_cap'] = $captcha_num;
        $this->session->set_userdata($cap);
        echo json_encode($cap);
    }

    public function verifyUser()
    {
        try {
            if ($this->input->server('REQUEST_METHOD') != 'POST') {
                $error = array('status' => "Failed", "msg" => "Invalid credential.");
                $this->response($this->json($error), 406);
            }
            $loan_no = null;
            if (isset($_POST['tPassword'])) {
                $this->form_validation->set_rules('tPassword', 'Password', 'trim|required|xss_clean|min_length[8]|max_length[16]');
                $re = $this->form_validation->run();
                if ($re == FALSE) {
                    $message = array("status" => 0, "data" => '', "StatusCode" => "NF0031");
                    $this->response($this->json($message), 200);
                } else {
                    $tPassword                 = strip_tags($_POST['tPassword']);
                }
            }
            //echo $tPassword;die;
            $session_data = $this->session->all_userdata();
            $user_id        = $session_data['id'];
            $status = 1;
            if (!empty($status)) {
                $sql = "SELECT  a.id,a.name,a.email,a.phone FROM user a WHERE a.id='$user_id'";
                $resultquery   = $this->db->query($sql);
                $result        = $resultquery->result_array();

                $result_pass = $this->authentication_model->check_login($result[0]['email'], $tPassword);
                //echo "<pre>====="; print_r($result_pass); die();
                $plain_password = $result_pass;
                //$dbId =  $id;
                //echo "<pre>====="; print_r('===xdsd=='.$dbPass .'==cdcsd== '.$password.'==ss=='.$dbId); die();
                // $plain_password = '';
                if ($result_pass) {
                    $key = $this->config->item('encryption_key');
                    // $plain_password = $this->encrypt->decode($result_pass, $key);
                }
                $tPassword = hash_hmac(ENCTYPE, $tPassword, SHA512ENCKEY);
                //$resp  = $this->authentication_model->authenticateUser($user_id,$tPassword);
                //print_r($resp);die;
                if ($plain_password == $tPassword) {
                    $phone = $result[0]['phone'];
                    $otp = createOTP();
                    updateUserOTP($user_id, $otp);
                    $message = "$otp  is your OTP. Please do not share with anyone. - IndusInd Bank";
                    sendMessageByFirstValue($phone, $message, 1);
                    $message = array("status" => 1, "data" => $resp, "StatusCode" => "NP000");
                } else {
                    $message = array("status" => 0, "data" => $resp[0], "StatusCode" => "NF003");
                }
                $this->response($this->json($message), 200);
            }
        } catch (Exception $e) {
        }
    }
}
