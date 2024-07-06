<?php

class User_model extends CI_Model {
    public $error       = array();
    public $error_count = 0;
    public $user_type    = 0;
    
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function check_role()
    {
        $user_id = $this->session->userdata('cibb_user_id');
        // get roles
        if ($user_id) {
            $row = $this->db->get_where(TBL_USERS, array('id' => $user_id))->row();
            $roles = $this->db->get_where(TBL_ROLES, array('id' => $row->role_id))->row_array();
            foreach ($roles as $key => $value) {
                $this->session->set_userdata($key, $value);
            }
        }
    }
    
    public function check_login()
    {
       // echo"<pre>ddddd"; print_r($_REQUEST);
        $row = $this->input->post('row');
        $key = $this->config->item('encryption_key');
        
        $data = array('email' => $row['username']);

        
        $query = $this->db->get_where(TBL_USERS, $data);
     //  echo $this->db->last_query(); exit();
       
        $plain_password = '';

        if ( ($query->num_rows() == 1) ) {
            $user = $query->row();
             
            $plain_password = $this->encrypt->decode($user->password, $key);
        }
        
        // if user found
           // echo "<pre>==dsfddddd".$row['password'];
            
        if ( ($query->num_rows() == 1) && ($plain_password == $row['password'])) {
       //    echo"<pre>sdfsdfsf=====".$plain_password; print_r($user); exit();

            
            $row = $query->row();
            $this->session->set_userdata('logged_in', 1);
            $this->session->set_userdata('user_id'  , $row->id);
            $this->session->set_userdata('email' , $row->username);
			$this->session->set_userdata('user_roleid' , $row->role_id);
            $this->session->set_userdata('user_type' , $row->user_type);
             $this->session->set_userdata('name' , $row->name);
            $this->session->set_userdata('phone' , $row->phone);
           
            // get roles
            $roles = $this->db->get_where(TBL_ROLES, array('id' => $row->role_id))->row_array();
            foreach ($roles as $key => $value) {
                $this->session->set_userdata($key, $value);
            }
            
            
            $this->user_type= $row->user_type;
           // echo"<pre>sdfsdfsf=====".$plain_password; print_r($user); exit();
        } else {
            $this->error['login'] = 'User not found';
            $this->error_count = 1;
        }
    }
    
    public function register()
    {
        $row = $this->input->post('row');
        
        // check username 
        $is_exist_username = $this->db->get_where(TBL_USERS, 
                array('username' => $row['username']))->num_rows();
        if ($is_exist_username > 0) {
            $this->error['username'] = 'Username already in use';
        }
        if (strlen($row['username']) < 5) {
            $this->error['username'] = 'Username minimum 5 character';
        }
        
        // check password
        if ($row['password'] != $this->input->post('password2')) {
            $this->error['password'] = 'Password not match';
        } else if (strlen($row['password']) < 5) {
            $this->error['password'] = 'Password minimum 5 character';
        }
        
        if (count($this->error) == 0) {
            $key = $this->config->item('encryption_key');
            $row['password'] = $this->encrypt->encode($row['password'], $key);
            $this->db->insert(TBL_USERS, $row);
        } else {
            $this->error_count = count($this->error);
        }
    }

    function login($data,$type){
 
   $email_id = $data['employee_email_id'];
   $password = $data['employee_password'];
   $usertype = $data['usertype'];
   $select="*";
	    $this->db->select($select);
        $this->db->from($usertype);
		$where = "(email = '$email_id')";
        $this->db->where($where);
        $query = $this->db->get();
		//echo $this->db->last_query(); die;
       return $results = $query->result_array();
//   $sql = $this->db->query("SELECT  * FROM $usertype WHERE email = '$email_id'");
//   return $results = $sql->result_array();
   //echo "<pre>===="; print_r($results); exit;
   }

    
	
	public function validateUser()
    {
     //   echo"<pre>ddddd"; print_r($_REQUEST); exit;
        $row = $this->input->post('row');
        $key = $this->config->item('encryption_key');
        
        $data = array('email' => $row['username']);

        
        $query = $this->db->get_where(TBL_USERS, $data);
     //  echo $this->db->last_query(); exit();
       
        $plain_password = '';

        if ( ($query->num_rows() == 1) ) {
            $user = $query->row();
            $plain_password = $this->encrypt->decode($user->password, $key);
			//echo "<pre>==<$plain_password>=="; print_r($user); exit;
        }
        
        // if user found
        //    echo "<pre>==dsfddddd".$row['password']; exit();
            
        if ( ($query->num_rows() == 1) && ($plain_password == $row['password'])) {
			    $row = $query->row();
				$this->session->set_userdata('logged_in', 1);
				$this->session->set_userdata('user_id'  , $row->id);
				$this->session->set_userdata('email' , $row->username);
				$this->session->set_userdata('user_roleid' , $row->role_id);
				$this->session->set_userdata('user_type' , $row->user_type);
				 $this->session->set_userdata('name' , $row->name);
				$this->session->set_userdata('phone' , $row->phone);
			   
				// get roles
				$roles = $this->db->get_where(TBL_ROLES, array('id' => $row->role_id))->row_array();
				foreach ($roles as $key => $value) {
					$this->session->set_userdata($key, $value);
				}
				
				$this->user_type= $row->user_type;
                return $row->user_type;
        } else {
            return 0;
            
        }
    }
    
    public function setSession($user_id,$session_id){
        $u_data = '';
        $query = $this->db->select("session_id")
                             ->where(array('id'=>$user_id))
                             ->get('user');
        $oldSessionId = $query->row_array(); 
        if(!empty($oldSessionId)){
        $query1 = $this->db->get_where('ci_sessions',array('session_id' => $oldSessionId['session_id']));
        $u_data = $query1->row_array();
            if(!empty($u_data)){
            $re = $this->db->delete('ci_sessions',$u_data);
            
            $this->db->where('id',$user_id);
            $this->db->update('user',array('session_id'=>$session_id));
            return true;
            }else{
                $this->db->where('id',$user_id);
            $this->db->update('user',array('session_id'=>$session_id));
                return true;
            }
        }else{
            $this->db->where('id',$user_id);
            $this->db->update('user',['session_id'=>$session_id]);
            return true;
        }
        
    }
}