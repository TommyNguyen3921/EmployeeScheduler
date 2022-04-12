<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admpendshift extends CI_Controller
{

  var $TPL;

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->model('users_model');
  }

  /**
   * load week for pending week for manager
   */
  public function index()
  {

    $this->load->library('session');
    $data2['test'] = $this->session->userdata('access');

    //load each week for schedule shifts
    $data2['loadweeks'] = $this->users_model->loadweekpend();

    //load manager weeks for pending shifts
    $this->template->show('admpendshiftweek', $data2);
  }

  /**
   * show more detail after a week has been selected
   */
  public function moreinfo($weekID)
  {

    $this->load->library('session');

    //get value for header name
    $data2['test'] = $this->session->userdata('access');

    //get the week id
    $data2['weekID'] = $weekID;

    //get data for that week
    $data2['weekinfo'] = $this->users_model->weekinfo($weekID);



    //get data for pendingshifts
    $data2['shiftpending'] = $this->users_model->weekpendingshifts($weekID);


    //if shift pending is empty for the week add array of empty week values
    $stack = array();
    if ($data2['shiftpending'] == NULL) {

      $emptyarray = array("sun" => "0", "mon" => "0", "tue" => "0", "wed" => "0", "thu" => "0", "fri" => "0", "sat" => "0");
      array_push($stack, $emptyarray);
      $data2['shiftpending'] = $stack;
    }


    //display admpendshiftweekinfo
    $this->template->show('admpendshiftweekinfo', $data2);
  }

  /**
   * load correct pending day
   */
  public function dayinfo($day, $weekID)
  {


    $this->load->library('session');
    //display header name
    $data2['test'] = $this->session->userdata('access');

    //weekid
    $data2['weekID'] = $weekID;
    //get day
    $data2['day'] = $day;

    //get the weekinfo
    $data2['weekinfo'] = $this->users_model->weekinfo($weekID);

    //table for each shift
    $data2['shiftstables'] = $this->users_model->doshiftstable($weekID, $day);

    //get pending shift
    $data2['pending'] = $this->users_model->admpendingschedule($weekID, $day);

    //get shiftslot
    $data2['loadshiftslot'] = $this->users_model->doshiftslot($weekID, $day);

    //get open shifts
    $data2['open'] = $this->users_model->loadavailshift($weekID, $day);

    //go to day for that manager pending shift for that day
    $this->template->show('admpendshiftdayinfo', $data2);
  }


  /**
   * decline pending shift from user
   */
  public function penddecline()
  {

    //get pendID
    $pendID = $this->input->post();

    //remove pending shift
    $this->users_model->dopenddeclineshift($pendID);
  }

  /**
   * accept user pending shift
   */
  public function pendaccept($pendID, $day, $weekID)
  {

    //method to remove pending shift and make it an open shift
    $this->users_model->dopendacceptshift($pendID);


    $this->load->library('session');
    //get name to add to header
    $data2['test'] = $this->session->userdata('access');

    //schedule weekID
    $data2['weekID'] = $weekID;

    //get day of schedule
    $data2['day'] = $day;

    //get the weekinfo
    $data2['weekinfo'] = $this->users_model->weekinfo($weekID);
    //table for each shift
    
    $data2['shiftstables'] = $this->users_model->doshiftstable($weekID, $day);
    //get pending shift
    $data2['pending'] = $this->users_model->admpendingschedule($weekID, $day);

    //get shiftslot
    $data2['loadshiftslot'] = $this->users_model->doshiftslot($weekID, $day);

    //get open shifts
    $data2['open'] = $this->users_model->loadavailshift($weekID, $day);

    //go to day for that manager pending shift for that day
    $this->template->show('admpendshiftdayinfo', $data2);
  }

  /**
   * delete open shift
   */
  public function deleteopenshift()
  {

    // get openshiftID
    $openshiftID = $this->input->post();

    //call method to delete the open shift
    $data1 = $this->users_model->dodeleteopenshift($openshiftID);
  }
}
