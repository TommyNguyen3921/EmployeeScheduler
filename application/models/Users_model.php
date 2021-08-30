<?php
class Users_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function login($email, $password)
	{
		$query = $this->db->get_where('login', array('username' => $email, 'password' => $password));
		return $query->row_array();
	}


	public function Sendreport($user, $topic, $description)
	{

		$query = $this->db->query("INSERT INTO bugreport (memberID,topic,message) VALUES ('$user', '$topic', '$description');");
	}

	public function checklogin($email, $password)
	{

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

	public function loadreport()
	{

		$this->db->select('member.name')
			->select('bugreport.topic')
			->select('bugreport.reportID')
			->from('bugreport')
			->join('member', 'member.memberID = bugreport.memberID');


		$query = $this->db->get();

		return $query->result_array();
	}
	function dosolve($reportid)
	{
		$query = $this->db->query("DELETE FROM bugreport where reportID = '$reportid';");
	}

	function showmoreinfo($reportid)
	{
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


	public function loadchat()
	{

		$this->db->select('member.name')
			->select('chatmessage.messagedata')
			->from('chatmessage')
			->join('member', 'member.memberID = chatmessage.memberID');


		$query = $this->db->get();

		return $query->result_array();
	}

	public function sendmessage($memberID, $message)
	{

		$query = $this->db->query("INSERT INTO chatmessage (memberID,messagedata) VALUES ('$memberID', '$message');");
	}

	//---------------------------------------create account page
	public function loadaccounts()
	{

		$this->db->select('member.name')
			->select('member.level')
			->select('member.memberID')
			->select('login.username')
			->select('login.password')
			->from('login')
			->join('member', 'member.memberID = login.loginID');


		$query = $this->db->get();

		return $query->result_array();
	}

	public function checkduplicate($user)
	{

		 $this->db->select('username')
			->from('login')
			->where('username', $user);
			$query = $this->db->get();
        $user1 = $query->row_array();
        print_r($user1);
        if($user1 != ''){
            return false;

        }else{
             return true;
        }
	}

	public function addaccount($name, $user, $password, $level)
	{

		$query = $this->db->query("INSERT INTO login (username,password) VALUES ('$user', '$password');");
		$query = $this->db->query("INSERT INTO member (name,level) VALUES ('$name', '$level');");
		if($level == 0){
            

        
		$this->db->select('memberID')
			->from('member')
			->where('name', $name);;


		$query = $this->db->get();
		$memberID = $query->result_array();

		$member = $memberID[0]["memberID"];

		$query = $this->db->query("INSERT INTO scheduler (memberID,timeofday,startdatetime,enddatetime) VALUES ('$member', 'Sunday', '0', '0');");
		$query = $this->db->query("INSERT INTO scheduler (memberID,timeofday,startdatetime,enddatetime) VALUES ('$member', 'Monday', '0', '0');");
		$query = $this->db->query("INSERT INTO scheduler (memberID,timeofday,startdatetime,enddatetime) VALUES ('$member', 'Tuesday', '0', '0');");
		$query = $this->db->query("INSERT INTO scheduler (memberID,timeofday,startdatetime,enddatetime) VALUES ('$member', 'Wednesday 	', '0', '0');");
		$query = $this->db->query("INSERT INTO scheduler (memberID,timeofday,startdatetime,enddatetime) VALUES ('$member', 'Thursday', '0', '0');");
		$query = $this->db->query("INSERT INTO scheduler (memberID,timeofday,startdatetime,enddatetime) VALUES ('$member', 'Friday', '0', '0');");
		$query = $this->db->query("INSERT INTO scheduler (memberID,timeofday,startdatetime,enddatetime) VALUES ('$member', 'Saturday', '0', '0');");
	}
	}


	function dodelete($memberID)
	{

		$this->db->select('level')
		->from('member')
		->where('memberID', $memberID);

		$query = $this->db->get();

		$result = $query->row_array();
		//print_r($result['level']);

		$this->db->where('level =',$result['level']);
         
		$query2 = $this->db->get('member');
         
		$result2 = $query2->num_rows();

		

		if(($result['level'] == 1 or $result['level'] == 2) and $result2 == 1){
            
			return true;
        }else{
			
             $this->db->query("DELETE FROM member where memberID = '$memberID';");
		$this->db->query("DELETE FROM login where loginID = '$memberID';");
		$this->db->query("DELETE FROM scheduler where memberID = '$memberID';");
        }

		
	}

	//---------------------------------------Forum Page page

	function doNewPost($topic, $discussion, $memberdata)
	{
		$this->db->query("INSERT INTO forumtopic (topic) VALUES ( '$topic');");

		$this->db->select('topicID')
			->from('forumtopic')
			->order_by('topicID', 'DESC')
			->limit(1);

		$query = $this->db->get();

		$result = $query->result_array();
		$topicid = $result[0]["topicID"];
		$this->db->query("INSERT INTO forummessage (topicID,memberID,messageforum) VALUES ('$topicid','$memberdata','$discussion');");
	}

	public function loadposts()
	{

		$this->db->select('topic')
			->select('topicID')

			->from('forumtopic');



		$query = $this->db->get();

		return $query->result_array();
	}

	function forumdetail($topicID)
	{
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
	function forumdetailadd($memberdata, $forumID, $message)
	{
		$this->db->query("INSERT INTO forummessage (topicID,memberID,messageforum) VALUES ('$forumID','$memberdata','$message');");
	}

	public function dosearch($search)
	{

		$this->db->select('topic')
			->select('topicID')

			->from('forumtopic')
			->like('topic', $search);


		$query = $this->db->get();

		return $query->result_array();
	}
	//---------------------------------------Analysis page		

	public function getmembers()
	{

		$this->db->select('memberID')
			->select('name')
			->from('member')
			->where('level', 0);


		$query = $this->db->get();

		return $query->result_array();
	}

	public function getmembersinfo($memberID)
	{


		$this->db->select('*')
			->from('stat')
			->where('memberID', $memberID["memberID"]);


		$query = $this->db->get();

		return $query->result_array();
	}
	public function doadddetails($data)
	{





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
	public function dodeletestat($statID)
	{


		$this->db->where('statID', $statID["statID"]);
		$this->db->delete('stat');


		$this->db->select('*')
			->from('stat')
			->where('memberID', $statID["user"]);


		$query = $this->db->get();

		return $query->result_array();
	}

	public function doupdate($statID)
	{





		$this->db->select('*')
			->from('stat')
			->where('statID', $statID["statID"]);


		$query = $this->db->get();

		return $query->result_array();
	}

	public function doupdatevalue($data)
	{



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

	public function loadanalysis($member)
	{

		$this->db->select('*')
			->from('stat')
			->where('memberID', $member);



		$query = $this->db->get();

		return $query->result_array();
	}
	//---------------------------------------schedule set up page	
	public function getmemberssetup()
	{

		$this->db->select('memberID')
			->select('name')
			->from('member')
			->where('level', 0);



		$query = $this->db->get();

		return $query->result_array();
	}

	public function loadschedule()
	{


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
	public function doaddschedule($member, $date, $start, $end)
	{

		$data1 = array(

			'startdatetime' => $start,
			'enddatetime' => $end
		);


		$this->db->where('memberID', $member);
		$this->db->where('timeofday', $date);
		$this->db->update('scheduler', $data1);
	}

	public function doreset()
	{

		$this->db->set('startdatetime', '0', FALSE);
		$this->db->set('enddatetime', '0', FALSE);
		$this->db->update('scheduler');
	}

	//---------------------------------------schedule menu page	

	public function doloadscheduleemployee($memberdata)
	{
		$this->db->select('timeofday')
			->select('startdatetime')
			->select('enddatetime')
			->select('scheduleID')
			->from('scheduler')
			->where('memberID', $memberdata)
			->where('startdatetime !=', 0);


		$query = $this->db->get();
print_r($query->result_array());
		return $query->result_array();
	}

	public function dopending($shiftID)
	{
		$data = array(
			'scheduleID' => $shiftID["shiftID"]
	);
	
	$this->db->insert('pendingshift', $data);

	}

	//---------------------------------------schedule admin/mananger menu page	

	function loadpendingschedule()
	{
		$this->db->select('scheduler.timeofday')
			->select('scheduler.startdatetime')
			->select('scheduler.enddatetime')
			->select('member.name')
			->select('pendingshift.pendingID')
			->from('scheduler')
			->join('pendingshift', 'pendingshift.scheduleID = scheduler.scheduleID')
			->join('member', 'member.memberID = scheduler.memberID');
			

		$query = $this->db->get();

		return $query->result_array();
	}
	function loadopenschedule()
	{
		$this->db->select('scheduler.timeofday')
			->select('scheduler.startdatetime')
			->select('scheduler.enddatetime')
			->select('openshift.openshiftID')
			->from('scheduler')
			->join('openshift', 'openshift.scheduleID = scheduler.scheduleID');
			
			

		$query = $this->db->get();

		return $query->result_array();
	}
	public function dopenddecline($pendID)
	{


		$this->db->where('pendingID', $pendID["pendID"]);
		$this->db->delete('pendingshift');


		
	}

	public function dopendaccept($pendID)
	{


		$this->db->select('scheduleID')
			->from('pendingshift')
			->where('pendingID', $pendID["pendID"]);
			

		$getvalue = $this->db->get();

		$scheduleID = $getvalue->result_array();

		$data1 = array(
			'scheduleID' => $scheduleID[0]['scheduleID']
			
		);

		$this->db->insert('openshift', $data1);


		$this->db->select('*')
		->from('scheduler')
		->where('scheduleID', $scheduleID[0]['scheduleID']);

		
		$query1 = $this->db->get();

		$schedulevalue = $query1->result_array();



		$data2 = array(
			'memberID' => $schedulevalue[0]['memberID'],
			'timeofday' => $schedulevalue[0]['timeofday'],
			'startdatetime' => 0,
			'enddatetime' => 0,
			
		);

		$this->db->insert('scheduler', $data2);





		$data = array(
			'memberID' => 0
			
	);
	
	$this->db->where('scheduleID', $scheduleID[0]['scheduleID']);
	$this->db->update('scheduler', $data);


		$this->db->select('scheduleID')
			->from('openshift')
			->order_by('openshiftID', 'DESC')
			->limit(1);

		$query2 = $this->db->get();

		$result = $query2->result_array();


		
		$this->db->where('pendingID', $pendID["pendID"]);
$this->db->delete('pendingshift');


		$this->db->select('scheduler.timeofday')
		->select('scheduler.startdatetime')
		->select('scheduler.enddatetime')
		->select('openshift.openshiftID')
		->select('scheduler.scheduleID')
		->from('scheduler')
		->join('openshift', 'openshift.scheduleID = scheduler.scheduleID')
		->where('scheduler.scheduleID', $result[0]["scheduleID"]);

		
		$query3 = $this->db->get();

		return $query3->result_array();
	}

	public function dopendname($pendID)
	{

		$this->db->select('scheduler.memberID')
		->from('scheduler')
		->join('pendingshift', 'pendingshift.scheduleID = scheduler.scheduleID')
		->where('pendingshift.scheduleID', $pendID["pendID"]);

		
		$query = $this->db->get();

		return $query->result_array();
		

		
		
	}

	public function doopenshiftdelete($openshiftID)
	{


		$this->db->select('scheduleID')
		
		->from('openshift')
		
		->where('openshiftID', $openshiftID["openshiftID"]);

		
		$query = $this->db->get();

		$result = $query->result_array();

		$this->db->where('scheduleID', $result[0]["scheduleID"]);
		$this->db->delete('scheduler');

		$this->db->where('openshiftID', $openshiftID["openshiftID"]);
		$this->db->delete('openshift');

		
		
	}

	public function doopenshiftaccept($openshiftID,$memberdata)
	{

		$this->db->select('scheduler.enddatetime')
		->select('scheduler.startdatetime')
		->select('scheduler.timeofday')
		->select('scheduler.scheduleID')
		->from('scheduler')
		->join('openshift', 'openshift.scheduleID = scheduler.scheduleID')
		->where('openshift.openshiftID', $openshiftID["openshiftID"]);

		
		$query = $this->db->get();

		$shiftvalue = $query->result_array();

		$this->db->select('scheduleID')
		->from('scheduler')
		->where('memberID', $memberdata)
		->where('timeofday', $shiftvalue[0]["timeofday"]);

		
		$query1 = $this->db->get();

		$updateidvalue = $query1->result_array();

		$data1 = array(

			'startdatetime' => $shiftvalue[0]["startdatetime"],
			'enddatetime' => $shiftvalue[0]["enddatetime"]
		);


		
		$this->db->where('timeofday', $shiftvalue[0]["timeofday"]);
		$this->db->where('memberID', $memberdata);
		$this->db->update('scheduler', $data1);


		$this->db->where('openshiftID', $openshiftID["openshiftID"]);
		$this->db->delete('openshift');

		$this->db->where('scheduleID', $shiftvalue[0]["scheduleID"]);
		$this->db->delete('scheduler');


		$this->db->select('scheduler.timeofday')
			->select('scheduler.startdatetime')
			->select('scheduler.enddatetime')
			->select('scheduler.scheduleID')
			->select('member.name')
			->from('scheduler')
			->join('member', 'member.memberID = scheduler.memberID')
		->where('scheduler.scheduleID', $updateidvalue[0]["scheduleID"]);

		
		$query2 = $this->db->get();

		return $query2->result_array();
		
	}
}
