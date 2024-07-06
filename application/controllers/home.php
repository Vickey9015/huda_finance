<?php

class Home extends CI_Controller
{

    function __construct()
    {
        $data = array();
        parent::__construct();

        $this->load->library('session');
        echo '-----2';
        print_r($this->session->all_userdata());
        die;

        $this->load->helper('url');

        $data  = array('is_logged_in' => $this->session->userdata('logged_in'));

        if (!$this->session->userdata('logged_in')) {
            redirect(base_url() . 'user/index');
        }
        $this->load->model('user_model');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('stats_model');
        $this->load->model('uncstates_model');
        $this->load->helper('common_helper');
        //$this->load->library('curl');
        $zone_id = array();
        $session_data = $this->session->all_userdata();
        $this->approver_id =  $session_data['id'];
        $this->role_id = $session_data['role_id'];
        $zones = $session_data['zones'];
        $i = 0;
        foreach ($zones as $zone) {
            $zone_id[$i] = $zone['id'];
            $i += 1;
        }
        $this->zone_id = implode(",", $zone_id);
    }

    function dashboard()
    {

        print_r('11');
        die;
        if ($this->session->userdata('logged_in')) {
            if ($this->role_id == 7) {
                $session_data = $this->session->all_userdata();
                $this->db->set('last_login', date('Y-m-d H:i:s')); //value that used to update column  
                $this->db->where('id', $session_data['id']); //which row want to upgrade  
                $this->db->update('user');
                redirect(base_url() . 'member/memberView');
            } else if ($this->role_id == 8) {
                $session_data = $this->session->all_userdata();
                $this->db->set('last_login', date('Y-m-d H:i:s')); //value that used to update column  
                $this->db->where('id', $session_data['id']); //which row want to upgrade  
                $this->db->update('user');
                redirect(base_url() . 'member/bankCheckerView');
            } else if ($this->role_id == 3 or $this->role_id == 4 or $this->role_id == 6 or $this->role_id == 5 or $this->role_id == 9) {
                $data = array();
                $session_data = $this->session->all_userdata();
                $this->db->set('last_login', date('Y-m-d H:i:s')); //value that used to update column  
                $this->db->where('id', $session_data['id']); //which row want to upgrade  
                $this->db->update('user');
                //echo "====<pre>==="; print_r($session_data); exit;
                $file = $this->stats_model->getDashboardFileStats($this->zone_id);
                $stats = $this->stats_model->getDashboardStats($this->zone_id);
                $data['month_stats'] = $this->stats_model->getDashboardStatsbyMonth($this->zone_id);

                $data['stats'] = $stats;
                $data['file_stats'] = $file;
                $data['session_data'] = $session_data;
                $this->load->view('layout/header', $data);
                $this->load->view('layout/topbar', $data);
                $this->load->view('layout/leftbar', $data);
                $this->load->view('dashboard', $data);
                $this->load->view('layout/footer');
            } else {
                $data = array();
                redirect(base_url());
            }
        }
    }
    function uncDashboard()
    {
        //print_r($this->zone_id); die;
        if ($this->session->userdata('logged_in')) {
            if ($this->role_id == 3 or $this->role_id == 4 or $this->role_id == 6) {
                $data = array();
                $session_data = $this->session->all_userdata();
                $this->db->set('last_login', date('Y-m-d H:i:s')); //value that used to update column  
                $this->db->where('id', $session_data['id']); //which row want to upgrade  
                $this->db->update('user');
                //echo "====<pre>==="; print_r($this->zone_id); exit;
                if ($this->role_id == 6) {
                    $zone = 'ALL';
                    //echo "====<pre>==="; print_r($this->role_id); exit;
                    $file = $this->uncstates_model->getDashboardFileStats($zone);
                    $stats = $this->uncstates_model->getDashboardStats($zone);
                    $data['month_stats'] = $this->uncstates_model->getDashboardStatsbyMonth($zone);
                    $successData = $this->uncstates_model->getSuccessTrans($zone);
                    $pendingAtLAOData = $this->uncstates_model->pendingAtLAOData($zone);
                    $returnData = $this->uncstates_model->returnData($zone);
                } else {
                    $file = $this->uncstates_model->getDashboardFileStats($this->zone_id);
                    $stats = $this->uncstates_model->getDashboardStats($this->zone_id);
                    $data['month_stats'] = $this->uncstates_model->getDashboardStatsbyMonth($this->zone_id);
                    $successData = $this->uncstates_model->getSuccessTrans($this->zone_id);
                    $pendingAtLAOData = $this->uncstates_model->pendingAtLAOData($this->zone_id);
                    $returnData = $this->uncstates_model->returnData($this->zone_id);
                }
                $data['stats'] = $stats;
                $data['file_stats'] = $file;
                $data['successData'] = $successData;
                $data['session_data'] = $session_data;
                $data['pendingAtLAOData'] = $pendingAtLAOData;
                $data['returnData'] = $returnData;

                //    echo '<pre>'; print_r($data); die;
                $this->load->view('layout/header', $data);
                $this->load->view('layout/topbar', $data);
                $this->load->view('layout/unleftbar', $data);
                $this->load->view('uncDashboard', $data);
                $this->load->view('layout/footer');
            } else {
                $data = array();
                redirect(base_url());
            }
        }
    }
}
