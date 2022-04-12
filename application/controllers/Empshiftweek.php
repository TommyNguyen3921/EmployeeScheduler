<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Empshiftweek extends CI_Controller
{

  var $TPL;

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->model('users_model');
  }

  /**
   * display employee week
   */
  public function index()
  {

    $this->load->library('session');
    //get name value
    $data2['test'] = $this->session->userdata('access');

    //loadweeks for employee
    $data2['loadweeks'] = $this->users_model->loadweeks();


    $this->template->show('empshiftweek', $data2);
  }

  /**
   * display employee info after week is selected
   */
  public function empweekinfo($weekID)
  {

    $this->load->library('session');

    //set message to false to not display
    $data2['fail'] = false;
    $data2['success'] = false;
    $data2['full'] = false;

    //get name value
    $data2['test'] = $this->session->userdata('access');

    //get weekID
    $data2['weekID'] = $weekID;

    //get account member ID
    $memberdata = $this->session->userdata('memberIDE');

    //load open available shift
    $data2['avail'] = $this->users_model->loadavailshiftemp($weekID);

    //get table info of employee working
    $data2['tableinfo'] = $this->users_model->tableinfoemp($weekID, $memberdata);




    //shift for currently logged in employee
    $data2['empshift'] = $this->users_model->doloadmeployeeshift($memberdata, $weekID);

    //load selected week info
    $this->template->show('empweekinfo', $data2);
  }

  /**
   * request shift off to maanger
   */
  public function pendingusershift()
  {

    //get the shiftID
    $shiftID = $this->input->post();

    //add data to pending shift
    $data = $this->users_model->dopendingUserShift($shiftID);

    echo ($data);
  }

  /**
   * accept an open shift
   */
  public function acceptopenshift($openshiftID, $weekID)
  {

    //get memberID
    $memberdata = $this->session->userdata('memberIDE');




    $this->load->library('session');

    //add user to open shift
    $checkshift = $this->users_model->doacceptopenshift($openshiftID, $memberdata, $weekID);

    //if 1 show message that shift is full
    if ($checkshift == 1) {
      $data2['fail'] = false;
      $data2['success'] = false;
      $data2['full'] = true;
    //if 2 show the open shift is now schedule for user
    } else if ($checkshift == 2) {
      $data2['fail'] = false;
      $data2['success'] = true;
      $data2['full'] = false;
    //if 3 show user is already working same day as open shift
    } else if ($checkshift == 3) {
      $data2['fail'] = true;
      $data2['success'] = false;
      $data2['full'] = false;
    }

    //get name value
    $data2['test'] = $this->session->userdata('access');

    //get weekID
    $data2['weekID'] = $weekID;

    //get available shift
    $data2['avail'] = $this->users_model->loadavailshiftemp($weekID);

    //get table info of employee working
    $data2['tableinfo'] = $this->users_model->tableinfoemp($weekID, $memberdata);




  
    //shift for currently logged in employee
    $data2['empshift'] = $this->users_model->doloadmeployeeshift($memberdata, $weekID);

    //load selected week info
    $this->template->show('empweekinfo', $data2);
  }
}
