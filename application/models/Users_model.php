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

//---------------------------------------Forum Page page

function doNewPost($topic, $discussion,$memberdata){
	$this->db->query("INSERT INTO forumtopic (topic) VALUES ( '$topic');");

	$this->db->select('topicID')
		->from('forumtopic')
		->order_by('topicID', 'DESC')
		->limit(1);
		
	$query = $this->db->get();

	$result = $query->result_array();
	$topicid =$result[0]["topicID"];
	$this->db->query("INSERT INTO forummessage (topicID,memberID,messageforum) VALUES ('$topicid','$memberdata','$discussion');");
}

public function loadposts(){
               
	$this->db->select('topic')
		->select('topicID')
		
		->from('forumtopic');
	
	  
		
	$query = $this->db->get();

	return $query->result_array();

}

function forumdetail($topicID){
	$this->db->select('forumtopic.topic')
			->select('forummessage.messageforum')
			->select('member.name')
            ->from('forumtopic')
            ->join('forummessage', 'forummessage.topicID = forumtopic.topicID') 
			->join('member', 'member.memberID = forummessage.memberID')
			->where('forumtopic.topicID', $topicID);
			
        $query = $this->db->get();
	
		return $query->result_array();
}
function forumdetailadd($memberdata,$forumID,$message){
	$this->db->query("INSERT INTO forummessage (topicID,memberID,messageforum) VALUES ('$forumID','$memberdata','$message');");
}

public function dosearch($search){
               
	$this->db->select('topic')
		->select('topicID')
		
		->from('forumtopic')
		->like('topic', $search);
	  
		
	$query = $this->db->get();

	return $query->result_array();

}
//---------------------------------------Analysis page		

public function getmembers(){
               
	$this->db->select('memberID')
			->select('name')
		->from('member');
		
	  
		
	$query = $this->db->get();

	return $query->result_array();

}

public function getmembersinfo($memberID){
               
	
	$this->db->select('*')
		->from('stat')
		->where('memberID', $memberID["memberID"]);
	  
		
	$query = $this->db->get();
	
	return $query->result_array();

}
public function doadddetails($data){
               
	
	


	$data1 = array(
        'memberID' => $data['user'],
        'Date' => $data['date'],
		'shiftchanges' => $data['change'],
		'latetoshift' => $data['lates'],
		'pay' => $data['pay'],
        'hours' => $data["hours"]
);

$this->db->insert('stat', $data1);

$this->db->select('*')
		->from('stat')
		->where('memberID', $data1["memberID"]);
	  
		
	$query = $this->db->get();
	
	return $query->result_array();

}
public function dodeletestat($statID){
               
	
	$this->db->where('statID', $statID["statID"]);
$this->db->delete('stat');


$this->db->select('*')
		->from('stat')
		->where('memberID', $statID["user"]);
	  
		
	$query = $this->db->get();
	
	return $query->result_array();



}

public function doupdate($statID){
               
	



$this->db->select('*')
		->from('stat')
		->where('statID', $statID["statID"]);
	  
		
	$query = $this->db->get();
	
	return $query->result_array();



}

public function doupdatevalue($data){
               
	

	$data1 = array(
        'memberID' => $data['user'],
        'Date' => $data['date'],
		'shiftchanges' => $data['change'],
		'latetoshift' => $data['lates'],
		'pay' => $data['pay'],
        'hours' => $data["hours"]
);

$this->db->where('statID', $data["statid"]);
$this->db->update('stat', $data1);
	
$this->db->select('*')
		->from('stat')
		->where('memberID', $data["user"]);
	  
		
	$query = $this->db->get();
	
	return $query->result_array();
	
	
	}

	public function loadanalysis($member){
               
		$this->db->select('*')
		->from('stat')
		->where('memberID', $member);

		  
			
		$query = $this->db->get();
		
		return $query->result_array();
		
		
		}
	

    	}
    ?>