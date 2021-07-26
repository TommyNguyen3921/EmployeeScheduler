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

	$this->db->select('memberID')
		->from('member')
		->where('name', $name); ;
	  
		
	$query = $this->db->get();
	$memberID = $query->result_array();

$member =$memberID[0]["memberID"];

	$query = $this->db->query("INSERT INTO scheduler (memberID,timeofday,startdatetime,enddatetime) VALUES ('$member', 'Sunday', '0', '0');");
	$query = $this->db->query("INSERT INTO scheduler (memberID,timeofday,startdatetime,enddatetime) VALUES ('$member', 'Monday', '0', '0');");
	$query = $this->db->query("INSERT INTO scheduler (memberID,timeofday,startdatetime,enddatetime) VALUES ('$member', 'Tuesday', '0', '0');");
	$query = $this->db->query("INSERT INTO scheduler (memberID,timeofday,startdatetime,enddatetime) VALUES ('$member', 'Wednesday 	', '0', '0');");
	$query = $this->db->query("INSERT INTO scheduler (memberID,timeofday,startdatetime,enddatetime) VALUES ('$member', 'Thursday', '0', '0');");
	$query = $this->db->query("INSERT INTO scheduler (memberID,timeofday,startdatetime,enddatetime) VALUES ('$member', 'Friday', '0', '0');");
	$query = $this->db->query("INSERT INTO scheduler (memberID,timeofday,startdatetime,enddatetime) VALUES ('$member', 'Saturday', '0', '0');");
	
	
}


function dodelete($memberID){
	$this->db->query("DELETE FROM member where memberID = '$memberID';");
	$this->db->query("DELETE FROM login where loginID = '$memberID';");
	$this->db->query("DELETE FROM scheduler where memberID = '$memberID';");
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
	//---------------------------------------schedule set up page	
	public function getmemberssetup(){
               
		$this->db->select('memberID')
				->select('name')
			->from('member');
			
		  
			
		$query = $this->db->get();
	
		return $query->result_array();
	
	}

	public function loadschedule(){
               

		//$query = $this->db->query("SELECT member.name,(GROUP_CONCAT(scheduler.timeofday ) as days) FROM member JOIN scheduler ON member.memberID=scheduler.memberID;");
		//$this->db->select('member.name')
		//->select('GROUP_CONCAT(scheduler.timeofday ) as days')
		//->select('scheduler.timeofday')
		//->from('member')
		//->join('scheduler', 'scheduler.memberID = member.memberID') ;
		//$this->db->group_by('member.name'); 
			
		//$query = $this->db->get();
	
		//return $query->result_array();
		return $this->db->query('SELECT member.name,GROUP_CONCAT(IF(scheduler.timeofday = "Sunday", scheduler.startdatetime, NULL)) as days
		,GROUP_CONCAT(IF(scheduler.timeofday = "Sunday", scheduler.enddatetime, NULL)) as edays
		,GROUP_CONCAT(IF(scheduler.timeofday = "Monday", scheduler.startdatetime, NULL)) as days1
		,GROUP_CONCAT(IF(scheduler.timeofday = "Monday", scheduler.enddatetime, NULL)) as edays1
		,GROUP_CONCAT(IF(scheduler.timeofday = "Tuesday", scheduler.startdatetime, NULL)) as days2
		,GROUP_CONCAT(IF(scheduler.timeofday = "Tuesday", scheduler.enddatetime, NULL)) as edays2
		,GROUP_CONCAT(IF(scheduler.timeofday = "Wednesday", scheduler.startdatetime, NULL)) as days3
		,GROUP_CONCAT(IF(scheduler.timeofday = "Wednesday", scheduler.enddatetime, NULL)) as edays3
		,GROUP_CONCAT(IF(scheduler.timeofday = "Thursday", scheduler.startdatetime, NULL)) as days4
		,GROUP_CONCAT(IF(scheduler.timeofday = "Thursday", scheduler.enddatetime, NULL)) as edays4
		,GROUP_CONCAT(IF(scheduler.timeofday = "Friday", scheduler.startdatetime, NULL)) as days5
		,GROUP_CONCAT(IF(scheduler.timeofday = "Friday", scheduler.enddatetime, NULL)) as edays5
		,GROUP_CONCAT(IF(scheduler.timeofday = "Saturday", scheduler.startdatetime, NULL)) as days6
		,GROUP_CONCAT(IF(scheduler.timeofday = "Saturday", scheduler.enddatetime, NULL)) as edays6 FROM member JOIN scheduler ON member.memberID=scheduler.memberID GROUP BY member.name;')->result_array();
	
	}
	public function doaddschedule($member,$date,$start,$end){
               
		$data1 = array(
			
			'startdatetime' => $start,
			'enddatetime' => $end
	);
	
	
$this->db->where('memberID', $member);
$this->db->where('timeofday', $date);
$this->db->update('scheduler', $data1);
	
	}

	public function doreset(){
               
		$this->db->set('startdatetime', '0', FALSE);
		$this->db->set('enddatetime', '0', FALSE);
		$this->db->update('scheduler');
	
	}
    	}
    ?>