<?php

class Authentication_model extends CI_Model {
    public $error       = array();
    public $error_count = 0;
    public $user_type    = 0;
    
    public function __construct() 
    {
        parent::__construct();
    }
    
   function authenticateUser($user_id,$tPassword){
   	    $password = md5($tPassword);
   	    if($tPassword == 'self'){
   	        $select="u.id,u.phone";
	    $this->db->select($select);
        $this->db->from(TBL_USER ." u");
		$where = "(u.id ='$user_id')";
        $this->db->where($where);
   	        //  $query ="SELECT u.id,u.phone from ".TBL_USER." u where u.id='$user_id'" ;
   	    }else{
   	        $select="u.id,u.phone";
	    $this->db->select($select);
        $this->db->from(TBL_USER ." u");
		$where = "(u.id ='$user_id' and u.password= '$password')";
        $this->db->where($where);
	       //  $query ="SELECT u.id,u.phone from ".TBL_USER." u where u.id='$user_id' and u.password= '$password'" ;
	    }
	    $query = $this->db->get();
		//echo $this->db->last_query();
       return $results = $query->result_array();
	    //print_r($query);die;
	//	$sql = $this->db->query($query);
		//echo $this->db->last_query(); die;	
	//	return $results = $sql->result_array();
		
		//echo "<pre>===="; print_r($results); exit;
   }
   
   function verifyTransactionOTP($user_id,$tOTP){
       $select="u.id,u.phone";
	    $this->db->select($select);
        $this->db->from(TBL_USER ." u");
		$where = "(u.id ='$user_id' and u.otp= '$tOTP')";
        $this->db->where($where);
        $query = $this->db->get();
		//echo $this->db->last_query(); die;
       return $results = $query->result_array();
	   // $query ="SELECT u.id,u.phone from ".TBL_USER." u where u.id='$user_id' and u.otp= '$tOTP'" ;
	    //print_r($query);die;
	//	$sql = $this->db->query($query);
		//echo $this->db->last_query(); die;	
	//	return $results = $sql->result_array();
		
		//echo "<pre>===="; print_r($results); exit;
   }

function updateStatus($ref_no,$annexureArray){
	  //  echo "<pre>===="; print_r($annexureArray);exit;
	  
	    $this->db->where('customer_reference_number', $ref_no);
		$res = $this->db->update(TBL_ANNEXURE_TEMP, $annexureArray);
		//echo "<pre>===="; print_r($results); exit;
   }
function updateInProcessStatus(){
	  //  echo "<pre>===="; print_r($annexureArray);exit;
	    $authProcessArray = (["annexure_status" => 3]);
	    $this->db->where('annexure_status', 8);
		$res = $this->db->update(TBL_ANNEXURE_TEMP, $authProcessArray);
		//echo "<pre>===="; print_r($results); exit;
		
	    $releaseProcessArray = (["annexure_status" => 7]);
	    $this->db->where('annexure_status', 9);
		$res = $this->db->update(TBL_ANNEXURE_TEMP, $releaseProcessArray);
		//echo "<pre>===="; print_r($results); exit;	
		return true;
   }   
  public function validateMobile($phone){
      //echo "<pre>===="; print_r($phone); exit;
     $select="u.phone,u.otp";
	    $this->db->select($select);
        $this->db->from(TBL_USER ." u");
		$where = "(u.phone ='$phone')";
        $this->db->where($where);
        $query = $this->db->get();
      // echo  "<pre>===="; print_r($this->db->last_query()); die;
        return $results = $query->result_array();
  }
  
    public function validatePass($id,$password)
  {
      if($id && $password){
  	    $sqlPass = "SELECT  t.* FROM  (SELECT * FROM password_history WHERE user_id = $id ORDER BY id DESC LIMIT 5) AS t WHERE t.user_id = $id";
		$resultqueryPass   = $this->db->query($sqlPass); 
		//echo  "<pre>===="; print_r($this->db->last_query()); die;    
		$resultPass        = $resultqueryPass->result_array();
		//echo  "<pre>===="; print_r($resultPass); die;
		$flagPass = 1;
		foreach($resultPass AS $passHistory){
		    $plain_password = '';
            if ($passHistory['password_hash']) {
               $key = $this->config->item('encryption_key');
               // $plain_password = $this->encrypt->decode($passHistory['password_hash'], $key);
                $password = hash_hmac(ENCTYPE,$password, SHA512ENCKEY);
                $plain_password = $passHistory['password_hash'];
                if($plain_password == $password){
                     $flagPass = 0;
                     
                }
            }
    	}
		return $flagPass;
      }
  }
  
  public function validityPass($id,$password)
  {
      if($id && $password){
  	    //$sqlPass = "SELECT created_on FROM user WHERE id = $id"; old changed on 24 june 2019
		$sqlPass = "SELECT created_on from password_history user WHERE user_id = $id and is_active = 1";
		$resultqueryPass   = $this->db->query($sqlPass); 
		//echo  "<pre>===="; print_r($this->db->last_query()); die;    
		$resultPass        = $resultqueryPass->result_array();
		//echo  "<pre>===="; print_r($resultPass); die;
		return $resultPass;
      }
  }
  
    public function check_login($email,$password)
    {
      if($email && $password){
            $data = array('email' => $email,'is_active'=>1);
            $query = $this->db->get_where(TBL_USER, $data);
            if ( ($query->num_rows() == 1) ) {
                $user = $query->row();
                $id = $user->id;
                $userPass =$user->password;
                $select="id,password_hash";
				$this->db->select($select);
				$this->db->from('password_history');
				$where = "(user_id='$id' and password_hash='$userPass'and is_active = 1)";
				$this->db->where($where);
				$query = $this->db->get();
				 //echo $this->db->last_query(); die;
				$result_pass= $query->result_array();
				 //echo "<pre>====="; print_r($result_pass); die();
				$dbPass =  $result_pass[0]['password_hash'];
				 //echo  "<pre>===="; print_r($dbPass); die;
                return $dbPass;
            }
        }
    }
    
     public function check_verification($email)
    {
      if($email){
        	$select  ="id,incorrect_attempts,role_id,maker_id,checker_id";
			$this->db->select($select);
			$this->db->from('user');
			$where   = "(email='$email' and is_active = 1)";
			$this->db->where($where);
			$query = $this->db->get();
			//echo $this->db->last_query(); die;
			$result_user= $query->result_object();
			return $result_user;
             //echo  "<pre>===="; print_r($result_user); die; 
        }
    }
     public function check_zone($email)
    {
      if($email){
     	$sql ="SELECT
				u.id,
				u.name,
				email,
				u.role_id,
				u.is_new_user,
				u.zone_id,
				r.name    AS role,
				zm.account_number AS account_number
				FROM user AS u
				LEFT JOIN role AS r  ON u.role_id = r.role_id
				LEFT JOIN (SELECT z.id, GROUP_CONCAT(a.account_number) AS account_number FROM zone_master z 
				LEFT JOIN account_master a ON a.zone_id=z.id GROUP BY a.zone_id)
				zm ON zm.id=u.zone_id WHERE email='$email'";
		$resultquery   = $this->db->query($sql);
		//echo $this->db->last_query(); die;
		$result  = $resultquery->result_object();
      }
    }
	
	function updateInProcessToDisbursementStatus($type){
        $cdatetime =  date('Y-m-d H:i:s',strtotime("-15 minutes"));
	  //  echo "<pre>===="; print_r($annexureArray);exit;
	    $authProcessArray = (["annexure_status" => 7]);
	  if($type == 'DD'){  
	    $this->db->where('annexure_status', 9);
	    $this->db->where('annexure_type >=', 5);
	    $this->db->where('released_on <', $cdatetime);
	  }
	  if($type == 'NDD'){  
	    $this->db->where('annexure_status', 9);
	    $this->db->where('annexure_type <', 5);
	    $this->db->where('released_on <', $cdatetime);
	  }
		$res = $this->db->update(TBL_ANNEXURE_TEMP, $authProcessArray);
		//echo "<pre>===="; print_r($this->db->last_query()); exit;
		return true;
   }
   
   function updateAuthorizedStatus(){
	  //  echo "<pre>===="; print_r($annexureArray);exit;
	    $authProcessArray = (["annexure_status" => 3]);
	    $this->db->where('annexure_status', 8);
		$res = $this->db->update(TBL_ANNEXURE_TEMP, $authProcessArray);
		//echo "<pre>===="; print_r($results); exit;	
		return true;
   } 
   
}