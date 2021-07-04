<?php
    	class Users_model extends CI_Model {
    		function __construct(){
    			parent::__construct();
    			$this->load->database();
    		}
     
    		public function login($email, $password){
    			$query = $this->db->get_where('login', array('username'=>$email, 'password'=>$password));
    			return $query->row_array();
    		}

		
			public function Sendreport($user, $topic,$description){
               
				$query = $this->db->query("INSERT INTO bugreport (memberID,topic,message) VALUES ('$user', '$topic', '$description');");
		   
		}

		public function checklogin($email, $password){
               
			$this->db->select('member.name')
			->select('member.level')
            ->from('member')
            ->join('login', 'login.loginID = member.memberID') 
            ->where('username', $email)
            ->where('password', $password);
			
        $query = $this->db->get();
	
		return $query->result_array();
	   
	}
		
    	}
    ?>