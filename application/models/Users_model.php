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
		
    	}
    ?>