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
			->select('member.memberID')
            ->from('member')
            ->join('login', 'login.loginID = member.memberID') 
            ->where('username', $email)
            ->where('password', $password);
			
        $query = $this->db->get();
	
		return $query->result_array();
	   
	}

	public function loadreport(){
               
		$this->db->select('member.name')
			->select('bugreport.topic')
			->select('bugreport.reportID')
            ->from('bugreport')
            ->join('member', 'member.memberID = bugreport.memberID') ;
          
			
        $query = $this->db->get();
	
		return $query->result_array();
   
}
function dosolve($reportid){
	$query = $this->db->query("DELETE FROM bugreport where reportID = '$reportid';");
}

function showmoreinfo($reportid){
	$this->db->select('member.name')
			->select('bugreport.topic')
			->select('bugreport.reportID')
			->select('bugreport.message')
            ->from('bugreport')
            ->join('member', 'member.memberID = bugreport.memberID') 
			->where('reportID', $reportid);
			
        $query = $this->db->get();
	
		return $query->result_array();
}


public function loadchat(){
               
	$this->db->select('member.name')
		->select('chatmessage.messagedata')
		->from('chatmessage')
		->join('member', 'member.memberID = chatmessage.memberID') ;
	  
		
	$query = $this->db->get();

	return $query->result_array();

}

public function sendmessage($memberID,$message){
               
	$query = $this->db->query("INSERT INTO chatmessage (memberID,messagedata) VALUES ('$memberID', '$message');");

}

//---------------------------------------create account page
public function loadaccounts(){
               
	$this->db->select('member.name')
		->select('member.level')
		->select('member.memberID')
		->select('login.username')
		->select('login.password')
		->from('login')
		->join('member', 'member.memberID = login.loginID') ;
	  
		
	$query = $this->db->get();

	return $query->result_array();

}

public function addaccount($name,$user,$password,$level){
               
	$query = $this->db->query("INSERT INTO login (username,password) VALUES ('$user', '$password');");
	$query = $this->db->query("INSERT INTO member (name,level) VALUES ('$name', '$level');");
}


function dodelete($memberID){
	$this->db->query("DELETE FROM member where memberID = '$memberID';");
	$this->db->query("DELETE FROM login where loginID = '$memberID';");
}
		
    	}
    ?>