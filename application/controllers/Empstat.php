<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Empstat extends CI_Controller
{

  var $TPL;

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->model('users_model');
  }

  /**
   * load week for stats
   */
  public function index()
  {

    $this->load->library('session');
    //get name value
    $data2['test'] = $this->session->userdata('access');

    //load schedule week
    $data2['loadweeks'] = $this->users_model->loadweekpend();

    //display employee stat weeks
    $this->template->show('empstat', $data2);
  }

  /**
   * display week information when a week is selected
   */
  public function moreinfo($weekID)
  {

    $this->load->library('session');

    //get name value
    $data2['test'] = $this->session->userdata('access');

    //get memberID
    $memberdata = $this->session->userdata('memberIDE');

    //get selected week weekID
    $data2['weekID'] = $weekID;

    //get data for the week
    $data2['weekinfo'] = $this->users_model->weekinfo($weekID);

    //get employee stat for that week
    $data2['statinfo'] = $this->users_model->getEmployeeestat($memberdata, $weekID);

    //load selected week data for employee
    $this->template->show('empstatweekinfo', $data2);
  }
}
