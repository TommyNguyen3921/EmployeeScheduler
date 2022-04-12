<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setupschedule extends CI_Controller
{

  var $TPL;

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->model('users_model');
  }

  /**
   * load maanger set up scheduler page
   */
  public function index()
  {

    $this->load->library('session');

    //get name value
    $data2['test'] = $this->session->userdata('access');

    //check if there is a week in the scheduler
    $data2['checkscheduleweek'] = $this->users_model->checkscheduleweek();

    //load weeks
    $data2['loadweeks'] = $this->users_model->loadweeks();

    //display set up schedule page
    $this->template->show('setupschedule', $data2);
  }

  /**
   * got to new page to add all the shift for the week
   */
  public function addnewweek()
  {

    $this->load->library('session');

    //get name value
    $data2['test'] = $this->session->userdata('access');

    //get start data and end date
    $data2['startdatepicker'] = $_POST['startdatepicker'];
    $data2['Enddatepicker'] = $_POST['Enddatepicker'];


    // go to page to add new week of employee shifts
    $this->template->show('addnewweek', $data2);
  }

  /**
   * add all shift for the week
   */
  public function submitshift()
  {
    //get all shifts from sunda to saturday
    $item = $this->input->post();

    //method to add week shift to database
    $this->users_model->addweek($item);
  }

  /**
   * uses exact same shift and employee from previous week into new week
   */
  public function uselastweek()
  {
    $this->load->library('session');

    //get name value
    $data2['test'] = $this->session->userdata('access');

    // get start date and end date
    $start = $_POST['startdatepicker1'];
    $end = $_POST['Enddatepicker1'];


    //check if there is a week in the scheduler
    $data2['checkscheduleweek'] = $this->users_model->checkscheduleweek();

    //method to use shift and employeee from repvious week
    $this->users_model->douselastweek($start, $end);

    //load week schedule
    $data2['loadweeks'] = $this->users_model->loadweeks();

    //redirect to manager set up schedule page
    $this->template->show('setupschedule', $data2);
  }

  /**
   * display information of week schedule
   */
  public function moreinfo($weekID)
  {

    $this->load->library('session');
    //get name value
    $data2['test'] = $this->session->userdata('access');

    //get weekID
    $data2['weekID'] = $weekID;

    //get weekinfo
    $data2['weekinfo'] = $this->users_model->weekinfo($weekID);

    //get member info
    $data2['member'] = $this->users_model->getmembers();

    //get schedule info
    $data2['tableinfo'] = $this->users_model->tableinfo($weekID);
    
    //display week info for manager
    $this->template->show('weekinfo', $data2);
  }

  /**
   * add employee to shift
   */
  public function addshift()
  {
    $data = $this->input->post();
    $result = $this->users_model->doaddshift($data);

    echo json_encode($result);
  }

  public function filtername()
  {
    // POST data
    $memberID = $this->input->post();

    // get data
    $data = $this->users_model->dofiltername($memberID);

    echo json_encode($data);
  }

  public function filterdate()
  {
    // POST data
    $filtervalue = $this->input->post();

    // get data
    $data = $this->users_model->dofilterdate($filtervalue);

    echo json_encode($data);
  }

  /**
   * show specfic week day info
   */
  public function dayinfo($weekID, $day)
  {

    $this->load->library('session');

    //get name value
    $data2['test'] = $this->session->userdata('access');

    // get week ID
    $data2['weekID'] = $weekID;

    //get day value
    $data2['day'] = $day;

    //get weekdate
    $data2['weekdate'] = $this->users_model->weekdate($weekID);

    //get the day info
    $data2['dayinfoload'] = $this->users_model->loaddayinfo($weekID, $day);

    //get employees

    $data2['load'] = $this->users_model->loademployeeinfo($weekID, $day);

    //get employee that are schedule
    $data2['loadscheduleemployee'] = $this->users_model->loadscheduleemployee($weekID, $day);

   
    //load shiftslots
    $data2['loadshiftslot'] = $this->users_model->doshiftslot($weekID, $day);

    //load the table of employee in shifts
    $data2['shiftstables'] = $this->users_model->doshiftstable($weekID, $day);
    
 
    //get shifts to fill employees
    $data2['weekinfo'] = $this->users_model->weekinfoshift($weekID, $day);


    
    //direct to day info of employee shifts
    $this->template->show('dayinfo', $data2);
  }

  /**
   * remove employee from current shift
   */
  public function deleteshift($shiftID, $weekID, $day)
  {


    $this->users_model->dodeleteshift($shiftID);


    $this->load->library('session');
    $data2['test'] = $this->session->userdata('access');

    // get week ID
    $data2['weekID'] = $weekID;

    //get day value
    $data2['day'] = $day;

    //get weekdate
    $data2['weekdate'] = $this->users_model->weekdate($weekID);

    //get the day info
    $data2['dayinfoload'] = $this->users_model->loaddayinfo($weekID, $day);

    //get employees
    $data2['load'] = $this->users_model->loademployeeinfo($weekID, $day);

    //get employee that are schedule
    $data2['loadscheduleemployee'] = $this->users_model->loadscheduleemployee($weekID, $day);

    //load shiftslots
    $data2['loadshiftslot'] = $this->users_model->doshiftslot($weekID, $day);
    
    //load the table of employee in shifts
    $data2['shiftstables'] = $this->users_model->doshiftstable($weekID, $day);

   
    //get shifts to fill employees
    $data2['weekinfo'] = $this->users_model->weekinfoshift($weekID, $day);

    //direct to day info of employee shifts
    $this->template->show('dayinfo', $data2);
  }
}
