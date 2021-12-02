<?php
class Users_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function login($email)
	{
		$query = $this->db->get_where('login', array('username' => $email));
		return $query->row_array();
	}


	public function Sendreport($user, $topic, $description)
	{

		$query = $this->db->query("INSERT INTO bugreport (memberID,topic,message) VALUES ('$user', '$topic', '$description');");
	}

	public function checklogin($email)
	{

		$this->db->select('member.name')
			->select('member.level')
			->select('member.memberID')
			->from('member')
			->join('login', 'login.loginID = member.memberID')
			->where('username', $email);

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

	//chat




	public function loadchatuser($memberID)
	{

		$this->db->select('name')
			->select('memberID')
			->from('member')
			->where('memberID !=', $memberID);

		$query = $this->db->get();

		return $query->result_array();
	}

	public function getmessagehistory($memberID, $senduser)
	{

		$usersend = $senduser["senduser"];
		$this->db->select('a.name as user')
			->select('b.name as sent ')
			->select('messagedata')
			->select('timesent')

			->from('chatboxmessages c')
			->join('member a', 'c.from_memberID = a.memberID')
			->join('member b', 'c.to_memberID  = b.memberID')
			->where("from_memberID='$memberID' AND to_memberID='$usersend' OR from_memberID='$usersend' AND to_memberID='$memberID' ")
			->order_by('timesent', 'ASC');

	



		$query = $this->db->get();

		return $query->result_array();
	}
	public function domessagesend($memberID, $senduser)
	{
		$data = array(
			'from_memberID' => $memberID,
			'to_memberID' => $senduser["senduser"],
			'messagedata' => $senduser["message"]
		);

		$this->db->insert('chatboxmessages', $data);

		$usersend = $senduser["senduser"];
		$this->db->select('a.name as user')
			->select('b.name as sent ')
			->select('messagedata')
			->select('timesent')

			->from('chatboxmessages c')
			->join('member a', 'c.from_memberID = a.memberID')
			->join('member b', 'c.to_memberID  = b.memberID')
			->where("from_memberID='$memberID' AND to_memberID='$usersend' OR from_memberID='$usersend' AND to_memberID='$memberID' ")
			->order_by('timesent', 'DESC')
			->limit(1);


		$query = $this->db->get();

		return $query->result_array();
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
		//print_r($user1);
		if ($user1 != '') {
			return false;
		} else {
			return true;
		}
	}

	public function addaccount($name, $user, $password, $level)
	{

		$query = $this->db->query("INSERT INTO login (username,password) VALUES ('$user', '$password');");
		$query = $this->db->query("INSERT INTO member (name,level) VALUES ('$name', '$level');");
	
	}


	function dodelete($memberID)
	{

		$this->db->select('level')
			->from('member')
			->where('memberID', $memberID);

		$query = $this->db->get();

		$result = $query->row_array();


		$this->db->where('level =', $result['level']);

		$query2 = $this->db->get('member');

		$result2 = $query2->num_rows();

	

		if ( $result['level'] == 2 and $result2 == 1) {

			return true;
		} else {
			$sql = "DELETE pendingshift FROM pendingshift JOIN scheduler 
			ON scheduler.scheduleID=pendingshift.scheduleID WHERE scheduler.memberID = ? ";
			$this->db->query($sql, array($memberID));

			$this->db->query("DELETE FROM forummessage where memberID = '$memberID';");
			$this->db->query("DELETE FROM bugreport where memberID = '$memberID';");
			$this->db->query("DELETE FROM member where memberID = '$memberID';");
			$this->db->query("DELETE FROM login where loginID = '$memberID';");
			$this->db->query("DELETE FROM schedulerinfo where memberID = '$memberID';");
			$this->db->query("DELETE FROM chatboxmessages where from_memberID = '$memberID' or to_memberID = '$memberID';");

		}
	}

	public function doresetpass($resetvalue)
	{

		$hashed_password = password_hash($resetvalue['temppass'], PASSWORD_DEFAULT);

		$data1 = array(
			'password' => $hashed_password
		);

		$this->db->where('loginID', $resetvalue["memberID"]);
		$this->db->update('login', $data1);

		$this->db->select('username')
			->from('login')
			->where('loginID', $resetvalue["memberID"]);


		$query = $this->db->get();

		return $query->result_array();
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



	

	public function loadanalysis($member)
	{

		$this->db->select('*')
			->from('stat')
			->where('memberID', $member);



		$query = $this->db->get();

		return $query->result_array();
	}
	//---------------------------------------schedule set up page	
	

	
	

	

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

		return $query->result_array();
	}

	

	//---------------------------------------schedule admin/mananger menu page	

	
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
	

	

	public function dopendname($pendID)
	{

		$this->db->select('scheduler.memberID')
			->from('scheduler')
			->join('pendingshift', 'pendingshift.scheduleID = scheduler.scheduleID')
			->where('pendingshift.scheduleID', $pendID["pendID"]);


		$query = $this->db->get();

		return $query->result_array();
	}

	

	

	//admscheduler setup
	public function addweek($item)
	{

		$data = array(
			'startdate' => $item['startdate'],
			'enddate' => $item['enddate']

		);

		$this->db->insert('newweek', $data);


		$this->db->select('weekID')
			->from('newweek')
			->order_by('weekID', 'DESC')
			->limit(1);

		$query = $this->db->get();

		$result = $query->result_array();
		$weekid = $result[0]["weekID"];



		foreach ($item["allitem"] as $row) {
			$data2 = array(
				'start' => $row['start'],
				'startampm' => $row['startampm'],
				'end' => $row['end'],
				'endampm' => $row['endampm'],
				'weekID' => $weekid,
				'timeofday' => $row['date'],
				'amtpeople' => $row['people'],
			);

			$this->db->insert('builtshift', $data2);
		}
	}

	public function checkscheduleweek()
	{

		$this->db->select('weekID')
			->from('newweek')
			->order_by('weekID', 'DESC')
			->limit(1);

		$query = $this->db->get();

		$result = $query->result_array();


		if (empty($result)) {
			return false;
		} else {
			return true;
		}
	}

	public function douselastweek($start, $end)
	{
		//get last week weekID
		$this->db->select('weekID')
			->from('newweek')
			->order_by('weekID', 'DESC')
			->limit(1);

		$query = $this->db->get();

		$result = $query->result_array();


		//insert new week startdate and enddate
		$data2 = array(
			'startdate' => $start,
			'enddate' => $end

		);

		$this->db->insert('newweek', $data2);

		//select all shift from the previous week
		$this->db->select('*')
			->from('builtshift')
			->where('weekID', $result[0]["weekID"]);

		$query1 = $this->db->get();

		$result1 = $query1->result_array();

		//get first value from builtshift

		$this->db->select('*')
			->from('builtshift')
			->where('weekID', $result[0]["weekID"])
			->order_by('builtshiftID', 'ASC')
			->limit(1);

		$query1 = $this->db->get();

		$builtshiftID1 = $query1->result_array();

		//select all shift from the previous week
		$this->db->select('*')
			->from('schedulerinfo')
			->where('weekID', $result[0]["weekID"])
			->order_by('builtshiftID', 'ASC');

		$query3 = $this->db->get();

		$result3 = $query3->result_array();

		//get new insert week weekID
		$this->db->select('weekID')
			->from('newweek')
			->order_by('weekID', 'DESC')
			->limit(1);

		$query2 = $this->db->get();

		$result2 = $query2->result_array();


		
		
		foreach ($result1 as $row) {
			$data2 = array(
				'start' => $row['start'],
				'startampm' => $row['startampm'],
				'end' => $row['end'],
				'endampm' => $row['endampm'],
				'weekID' => $result2[0]["weekID"],
				'timeofday' => $row['timeofday'],
				'amtpeople' => $row['amtpeople'],

			);

			$this->db->insert('builtshift', $data2);
			
		}

		//get second value from builtshift

		$this->db->select('*')
			->from('builtshift')
			->where('weekID', $result2[0]["weekID"])
			->order_by('builtshiftID', 'ASC')
			->limit(1);

		$query8 = $this->db->get();

		$builtshiftID2 = $query8->result_array();

		$count = $builtshiftID2[0]["builtshiftID"] - $builtshiftID1[0]["builtshiftID"];
		foreach ($result3 as $row) {
			$data3 = array(
				'memberID' => $row['memberID'],
				'weekID' => $result2[0]["weekID"],
				'timeofday' => $row['timeofday'],
				'shifttime' => $row['shifttime'],
				'modtime' => $row["modtime"],
				'builtshiftID' => ($row["builtshiftID"] + $count)

			);

			$this->db->insert('schedulerinfo', $data3);
		}
	}

	public function loadweeks()
	{

		$this->db->select('*')
			->from('newweek');

		$query = $this->db->get();

		return $query->result_array();
	}

	public function weekinfo($weekID)
	{

		$this->db->select('*')
			->from('newweek')
			->join('builtshift', 'builtshift.weekID = newweek.weekID')
			->where('newweek.weekID', $weekID);

		$query = $this->db->get();
		//print_r($query->result_array());
		return $query->result_array();
	}

	public function tableinfo($weekID)
	{
		$sql = ('SELECT member.name,GROUP_CONCAT(IF(schedulerinfo.timeofday = "1", schedulerinfo.shifttime, NULL)) as days
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "1", schedulerinfo.modtime, NULL)) as mdays
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "2", schedulerinfo.shifttime, NULL)) as days1
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "2", schedulerinfo.modtime, NULL)) as mdays1
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "3", schedulerinfo.shifttime, NULL)) as days2
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "3", schedulerinfo.modtime, NULL)) as mdays2
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "4", schedulerinfo.shifttime, NULL)) as days3
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "4", schedulerinfo.modtime, NULL)) as mdays3
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "5", schedulerinfo.shifttime, NULL)) as days4
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "5", schedulerinfo.modtime, NULL)) as mdays4
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "6", schedulerinfo.shifttime, NULL)) as days5
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "6", schedulerinfo.modtime, NULL)) as mdays5
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "7", schedulerinfo.shifttime, NULL)) as days6
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "7", schedulerinfo.modtime, NULL)) as mdays6
		FROM member LEFT JOIN schedulerinfo ON member.memberID=schedulerinfo.memberID AND schedulerinfo.weekID =? WHERE member.level=0  GROUP BY member.name;');
		return $this->db->query($sql, $weekID)->result_array();
	}
	public function doaddshift($data)
	{
		//add employee to scheduelrinfo
		$data1 = array(
			'memberID' => $data['member'],
			'timeofday' => $data['day'],
			'shifttime' => $data['time'],
			'weekID' => $data['weekID'],
			'modtime' => $data['modtime'],
			'builtshiftID' => $data['shiftID'],
		);

		$this->db->insert('schedulerinfo', $data1);

		//select statement to get hour for shift and insert stat for shift for employee
		$this->db->select('*')
			->from('builtshift')
			->join('schedulerinfo', 'schedulerinfo.builtshiftID = builtshift.builtshiftID')
			->order_by('schedulerinfo.scheduleinfoID', 'DESC')
			->limit(1);


		$query1 = $this->db->get();

		$result = $query1->result_array();

		$startime = 0;
		$endtime = 0;

		if($result[0]["startampm"] == "am" && $result[0]["start"] == 12){
			$starttime = 0;
		}else if ($result[0]["startampm"] == "am"){
			$startime = $result[0]["start"];
		}else if ($result[0]["startampm"] == "pm" && $result[0]["start"] == 12){
			$startime = $result[0]["start"];
		}else if($result[0]["startampm"] == "pm"){
			$startime = $result[0]["start"] + 12;
		}

		if($result[0]["endampm"] == "am" && $result[0]["end"] == 12){
			$endtime = 0;
		}else if ($result[0]["endampm"] == "am"){
			$endtime = $result[0]["end"];
		}else if ($result[0]["endampm"] == "pm" && $result[0]["end"] == 12){
			$endtime = $result[0]["end"];
		}else if($result[0]["endampm"] == "pm"){
			$endtime = $result[0]["end"] + 12;
		}

		$value1 = abs($startime - $endtime);
		
		$totalearn = 14.25 * $value1;
		$value = $result[0]["scheduleinfoID"];
		

		$data1 = array(
			'scheduleinfoID' => $value,
			'pay' => $totalearn,
			'hours' => $value1
			
		);

		$this->db->insert('employeestat', $data1);

		//get value to display shift of new added employee
		$sql = ('SELECT member.name,schedulerinfo.shifttime,member.memberID,schedulerinfo.modtime,schedulerinfo.scheduleinfoID
		FROM member LEFT JOIN schedulerinfo ON member.memberID=schedulerinfo.memberID AND schedulerinfo.weekID =? AND schedulerinfo.timeofday=? WHERE member.level=0 AND schedulerinfo.shifttime IS NOT NULL AND member.memberID=? GROUP BY member.name;');
		return $this->db->query($sql, array($data['weekID'], $data['day'], $data['member']))->result_array();


		$query = $this->db->get();

		return $query->result_array();
	}
	public function dofiltername($memberID)
	{
		$sql = ('SELECT member.name,GROUP_CONCAT(IF(schedulerinfo.timeofday = "1", schedulerinfo.shifttime, NULL)) as days
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "1", schedulerinfo.modtime, NULL)) as mdays
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "2", schedulerinfo.shifttime, NULL)) as days1
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "2", schedulerinfo.modtime, NULL)) as mdays1
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "3", schedulerinfo.shifttime, NULL)) as days2
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "3", schedulerinfo.modtime, NULL)) as mdays2
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "4", schedulerinfo.shifttime, NULL)) as days3
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "4", schedulerinfo.modtime, NULL)) as mdays3
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "5", schedulerinfo.shifttime, NULL)) as days4
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "5", schedulerinfo.modtime, NULL)) as mdays4
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "6", schedulerinfo.shifttime, NULL)) as days5
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "6", schedulerinfo.modtime, NULL)) as mdays5
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "7", schedulerinfo.shifttime, NULL)) as days6
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "7", schedulerinfo.modtime, NULL)) as mdays6
		FROM member LEFT JOIN schedulerinfo ON member.memberID=schedulerinfo.memberID AND schedulerinfo.weekID =? WHERE member.memberID=?  GROUP BY member.name;');
		return $this->db->query($sql, array($memberID["weekID"], $memberID["memberID"]))->result_array();
	}

	public function dofilterdate($filtervalue)
	{


		$sql = ('SELECT member.name,GROUP_CONCAT(IF(schedulerinfo.timeofday = "1", schedulerinfo.shifttime, NULL)) as days
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "1", schedulerinfo.modtime, NULL)) as mdays
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "2", schedulerinfo.shifttime, NULL)) as days1
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "2", schedulerinfo.modtime, NULL)) as mdays1
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "3", schedulerinfo.shifttime, NULL)) as days2
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "3", schedulerinfo.modtime, NULL)) as mdays2
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "4", schedulerinfo.shifttime, NULL)) as days3
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "4", schedulerinfo.modtime, NULL)) as mdays3
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "5", schedulerinfo.shifttime, NULL)) as days4
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "5", schedulerinfo.modtime, NULL)) as mdays4
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "6", schedulerinfo.shifttime, NULL)) as days5
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "6", schedulerinfo.modtime, NULL)) as mdays5
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "7", schedulerinfo.shifttime, NULL)) as days6
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "7", schedulerinfo.modtime, NULL)) as mdays6
		FROM member LEFT JOIN schedulerinfo ON member.memberID=schedulerinfo.memberID AND schedulerinfo.weekID =? WHERE member.memberID=?  GROUP BY member.name;');
		return $this->db->query($sql, array($filtervalue["weekID"], $filtervalue["date"]))->result_array();
	}

	//dayweekinfo
	public function loaddayinfo($weekID, $day)
	{


		$this->db->select('schedulerinfo.timeofday')
			->select('schedulerinfo.shifttime')
			->select('member.name')
			->from('member')
			->join('schedulerinfo', 'schedulerinfo.memberID = member.memberID')

			->where('schedulerinfo.weekID', $weekID)
			->where('schedulerinfo.timeofday', $day);


		$query = $this->db->get();

		return $query->result_array();
	}

	public function loademployeeinfo($weekID, $day)
	{

		$sql = ('SELECT member.name,schedulerinfo.shifttime,member.memberID
		FROM member LEFT JOIN schedulerinfo ON member.memberID=schedulerinfo.memberID AND schedulerinfo.weekID =? AND schedulerinfo.timeofday=? WHERE member.level=0 AND schedulerinfo.shifttime IS NULL GROUP BY member.name;');
		return $this->db->query($sql, array($weekID, $day))->result_array();
	}

	public function weekinfoshift($weekID, $day)
	{

		$this->db->select('*')
			->from('builtshift')
			->join('newweek', 'newweek.weekID = builtshift.weekID')
			->where('builtshift.weekID', $weekID)
			->where('builtshift.timeofday', $day);

		$query = $this->db->get();

		return $query->result_array();
	}

	public function loadscheduleemployee($weekID, $day)
	{

		$sql = ('SELECT member.name,schedulerinfo.shifttime,member.memberID,schedulerinfo.modtime,schedulerinfo.scheduleinfoID
		FROM member LEFT JOIN schedulerinfo ON member.memberID=schedulerinfo.memberID AND schedulerinfo.weekID =? AND schedulerinfo.timeofday=? WHERE member.level=0 AND schedulerinfo.shifttime IS NOT NULL GROUP BY member.name ORDER BY schedulerinfo.scheduleinfoID ASC;');
		return $this->db->query($sql, array($weekID, $day))->result_array();
	}

	public function weekdate($weekID)
	{

		$this->db->select('*')
			->from('newweek')
			->where('weekID', $weekID);

		$query = $this->db->get();
		//print_r($query->result_array());
		return $query->result_array();
	}

	public function dodeleteshift($shiftID)
	{


		$this->db->where('scheduleinfoID', $shiftID);
		$this->db->delete('schedulerinfo');

		$this->db->where('scheduleinfoID', $shiftID);
		$this->db->delete('employeestat');

		$this->db->where('scheduleinfoID', $shiftID);
		$this->db->delete('pendingusershifts');
	}



	

	public function doshiftslot($weekID, $day)
	{

		$sql = ('SELECT *,count(schedulerinfo.shifttime) as count
		FROM builtshift LEFT JOIN schedulerinfo ON builtshift.builtshiftID=schedulerinfo.builtshiftID WHERE builtshift.weekID =? AND builtshift.timeofday=? GROUP BY builtshift.builtshiftID ;');
		return $this->db->query($sql, array($weekID, $day))->result_array();
	}

	public function doshiftstable($weekID, $day)
	{

		$sql = ('SELECT *,GROUP_CONCAT(member.name) as name,GROUP_CONCAT(schedulerinfo.scheduleinfoID) as gscheduleinfoID,GROUP_CONCAT(schedulerinfo.modtime) as gmodtime
		FROM builtshift 
		LEFT JOIN schedulerinfo ON builtshift.builtshiftID=schedulerinfo.builtshiftID 
		LEFT JOIN member ON member.memberID=schedulerinfo.memberID WHERE builtshift.weekID =? AND builtshift.timeofday=? GROUP BY builtshift.builtshiftID;');
		return $this->db->query($sql, array($weekID, $day))->result_array();
	}
	//employee shift
	public function doloadmeployeeshift($memberdata,$weekID)
	{
		

		$this->db->select('*')
			->from('schedulerinfo')
			->where('memberID', $memberdata)
			->where('weekID ', $weekID);


		$query = $this->db->get();

		return $query->result_array();
	}

	public function tableinfoemp($weekID,$memberID)
	{
		$sql = ('SELECT member.name,GROUP_CONCAT(IF(schedulerinfo.timeofday = "1", schedulerinfo.shifttime, NULL)) as days
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "1", schedulerinfo.modtime, NULL)) as mdays
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "2", schedulerinfo.shifttime, NULL)) as days1
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "2", schedulerinfo.modtime, NULL)) as mdays1
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "3", schedulerinfo.shifttime, NULL)) as days2
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "3", schedulerinfo.modtime, NULL)) as mdays2
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "4", schedulerinfo.shifttime, NULL)) as days3
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "4", schedulerinfo.modtime, NULL)) as mdays3
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "5", schedulerinfo.shifttime, NULL)) as days4
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "5", schedulerinfo.modtime, NULL)) as mdays4
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "6", schedulerinfo.shifttime, NULL)) as days5
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "6", schedulerinfo.modtime, NULL)) as mdays5
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "7", schedulerinfo.shifttime, NULL)) as days6
		,GROUP_CONCAT(IF(schedulerinfo.timeofday = "7", schedulerinfo.modtime, NULL)) as mdays6
		FROM member LEFT JOIN schedulerinfo ON member.memberID=schedulerinfo.memberID AND schedulerinfo.weekID =? WHERE member.level=0  GROUP BY member.name ORDER BY FIELD(schedulerinfo.memberID,?) DESC, schedulerinfo.memberID asc;');
		return $this->db->query($sql, array($weekID, $memberID))->result_array();
	}

	public function dopendingUserShift($shiftID)
	{

		$this->db->select('scheduleinfoID')
			->from('pendingusershifts')
			->where('scheduleinfoID', $shiftID["shiftID"]);


		$query = $this->db->get();

		$result = $query->row_array();

		if (!empty($result)) {

			return false;
		} else {

			$data = array(
				'scheduleinfoID' => $shiftID["shiftID"],
				'weekID' => $shiftID["weekID"]
			);

			$this->db->insert('pendingusershifts', $data);
			return true;
		}
	}

	public function loadavailshiftemp($weekID)
	{


		$this->db->select('*')
			
			->from('builtshift')
			->join('openusershifts', 'openusershifts.builtshiftID = builtshift.builtshiftID')
			->where('builtshift.weekID ', $weekID);


		$query = $this->db->get();

		return $query->result_array();
	}

	public function doacceptopenshift($openshiftID,$memberdata,$weekID)
	{
		
		

		
		//get time to add to user shift
		$this->db->select('*')
			
			->from('builtshift')
			->join('openusershifts', 'openusershifts.builtshiftID = builtshift.builtshiftID')
			->where('openusershifts.openshiftID ', $openshiftID);

		
		$query = $this->db->get();

		$result = $query->result_array();
		$time = $result[0]["start"].$result[0]["startampm"]."-".$result[0]["end"].$result[0]["endampm"];
		
		
		//check if shift is full
		$sql = ('SELECT *,count(schedulerinfo.shifttime) as count
		FROM builtshift LEFT JOIN schedulerinfo ON builtshift.builtshiftID=schedulerinfo.builtshiftID WHERE builtshift.weekID =? AND builtshift.timeofday=? AND builtshift.builtshiftID=? GROUP BY builtshift.builtshiftID ;');
		$fullcheck = $this->db->query($sql, array($weekID, $result[0]["timeofday"],$result[0]["builtshiftID"]))->result_array();

		$slotfull = $fullcheck[0]["amtpeople"] - $fullcheck[0]["count"];
		//print_r($slotfull);
		if($slotfull == 0 ){
		$this->db->where('openshiftID', $openshiftID);
		$this->db->delete('openusershifts');

			return 1;
		}
		
		//check if user is already schedule for that day
		$this->db->select('*')
			
		->from('schedulerinfo')
		->where('memberID', $memberdata)
		->where('timeofday', $result[0]["timeofday"])
		->where('weekID', $weekID);

	
		$query = $this->db->get();

		$result1 = $query->result_array();

		//add shift if not already schedule for that day
		if(empty($result1)){

				$data = array(
			'memberID' => $memberdata,
			'weekID' => $weekID,
			'timeofday' => $result[0]["timeofday"],
			'shifttime' => $time,
			'builtshiftID' => $result[0]["builtshiftID"],
			
		);

		$this->db->insert('schedulerinfo', $data);

		$this->db->where('openshiftID', $openshiftID);
		$this->db->delete('openusershifts');

			return 2;
		}else{
			//return 3 if already schedule for that day
			return 3;
		}
		
		
		
	

	}


		//adm pending shift shift
	public function loadweekpend()
	{

		$sql = ('SELECT *,newweek.weekID,count(pendingusershifts.pendingID) as Shiftcount
		FROM newweek 
		LEFT JOIN schedulerinfo ON newweek.weekID=schedulerinfo.weekID 
		LEFT JOIN pendingusershifts ON pendingusershifts.scheduleinfoID=schedulerinfo.scheduleinfoID GROUP BY schedulerinfo.weekID;');
		return $this->db->query($sql)->result_array();
	}

	public function weekpendingshifts($weekID)
	{
		$sql = ('SELECT count(case schedulerinfo.timeofday when "1" then 1 else null end) as sun,count(case schedulerinfo.timeofday when "2" then 1 else null end) as mon,count(case schedulerinfo.timeofday when "3" then 1 else null end) as tue,count(case schedulerinfo.timeofday when "4" then 1 else null end) as wed,count(case schedulerinfo.timeofday when "5" then 1 else null end) as thu,count(case schedulerinfo.timeofday when "6" then 1 else null end) as fri,count(case schedulerinfo.timeofday when "7" then 1 else null end) as sat
		FROM newweek 
		JOIN schedulerinfo ON newweek.weekID=schedulerinfo.weekID 
		JOIN pendingusershifts ON pendingusershifts.scheduleinfoID=schedulerinfo.scheduleinfoID WHERE schedulerinfo.weekID =? GROUP BY schedulerinfo.weekID;');
		return $this->db->query($sql, array($weekID))->result_array();
	}

	function admpendingschedule($weekID,$day)
	{
		$this->db->select('*')
			
			->from('schedulerinfo')
			->join('pendingusershifts', 'pendingusershifts.scheduleinfoID = schedulerinfo.scheduleinfoID')
			->join('member', 'member.memberID = schedulerinfo.memberID')
			->where('schedulerinfo.weekID ', $weekID)
			->where('schedulerinfo.timeofday ', $day);


		$query = $this->db->get();

		return $query->result_array();
	}

	public function doshiftspend($weekID, $day)
	{

		$sql = ('SELECT *,GROUP_CONCAT(member.name) as name,GROUP_CONCAT(schedulerinfo.scheduleinfoID) as gscheduleinfoID,GROUP_CONCAT(schedulerinfo.modtime) as gmodtime
		FROM builtshift 
		LEFT JOIN schedulerinfo ON builtshift.builtshiftID=schedulerinfo.builtshiftID 
		JOIN pendingusershifts ON schedulerinfo.scheduleinfoID=pendingusershifts.scheduleinfoID 
		LEFT JOIN member ON member.memberID=schedulerinfo.memberID WHERE builtshift.weekID =? AND builtshift.timeofday=? GROUP BY builtshift.builtshiftID;');
		return $this->db->query($sql, array($weekID, $day))->result_array();
	}

	public function dopenddeclineshift($pendID)
	{


		$this->db->where('pendingID', $pendID["pendID"]);
		$this->db->delete('pendingusershifts');
	}

	public function dopendacceptshift($pendID)
	{


		$this->db->select('*')
			
			->from('schedulerinfo')
			->join('pendingusershifts', 'pendingusershifts.scheduleinfoID = schedulerinfo.scheduleinfoID')
			->where('pendingusershifts.pendingID ', $pendID);


		$query = $this->db->get();

		$result = $query->result_array();


		

		$data = array(
			'builtshiftID' => $result[0]["builtshiftID"]
			
		);

		$this->db->insert('openusershifts', $data);
		
		$this->db->where('pendingID', $result[0]["pendingID"]);
		$this->db->delete('pendingusershifts');

		$this->db->where('scheduleinfoID', $result[0]["scheduleinfoID"]);
		$this->db->delete('schedulerinfo');
	}

	public function loadavailshift($weekID, $day)
	{


		$this->db->select('*')
			
			->from('builtshift')
			->join('openusershifts', 'openusershifts.builtshiftID = builtshift.builtshiftID')
			->where('builtshift.weekID ', $weekID)
			->where('builtshift.timeofday ', $day);


		$query = $this->db->get();

		return $query->result_array();
	}

	public function dodeleteopenshift($openshiftID)
	{


		

		$this->db->where('openshiftID', $openshiftID["openshiftID"]);
		$this->db->delete('openusershifts');
	}

	//adm accessing employeee stats

	public function getEmployeeestat($memberID, $weekID)
	{
		$this->db->select('*')
			
			->from('schedulerinfo')
			->join('employeestat', 'employeestat.scheduleinfoID = schedulerinfo.scheduleinfoID')
			->where('schedulerinfo.weekID ', $weekID)
			->where('schedulerinfo.memberID ', $memberID)
			->order_by('timeofday', 'ASC');


		$query = $this->db->get();

		return $query->result_array();


		

	}

	public function UpdateEmployeeestat($memberID, $weekID, $late, $pay, $Hours,$scheduleinfoID)
	{


		$data = array(
			'latetoshift' => $late,
			'pay' => $pay,
			'hours' => $Hours
	);
	
	$this->db->where('scheduleinfoID', $scheduleinfoID);
	$this->db->update('employeestat', $data);

		$this->db->select('*')
			
			->from('schedulerinfo')
			->join('employeestat', 'employeestat.scheduleinfoID = schedulerinfo.scheduleinfoID')
			->where('schedulerinfo.weekID ', $weekID)
			->where('schedulerinfo.memberID ', $memberID)
			->order_by('timeofday', 'ASC');


		$query = $this->db->get();

		return $query->result_array();


		

	}
	//profile page
	public function loadprofile($memberID)
	{

		$this->db->select('*')
			
			->from('login')
			->join('member', 'member.memberID = login.loginID')
			->where('login.loginID ', $memberID);


		$query = $this->db->get();

		return $query->result_array();


		

	}

	public function doupdateprofile($memberID,$user)
	{

		$data1 = array(
			'username' => $user,
			
			
		);

		$this->db->where('loginID', $memberID);
		$this->db->update('login', $data1);


		

	}

	public function doupdatepassword($memberID,$password)
	{

		$data1 = array(
			'password' => $password
			
			
		);

		$this->db->where('loginID', $memberID);
		$this->db->update('login', $data1);


		

	}

	
}
