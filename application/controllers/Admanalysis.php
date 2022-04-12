<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admanalysis extends CI_Controller
{

  var $TPL;

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->model('users_model');
  }

  /**
   * load the manager stat page for the weeks
   * 
   */
  public function index()
  {

    $this->load->library('session');
    //load name in header
    $data2['test'] = $this->session->userdata('access');

    //get each week of scheduler
    $data2['loadweeks'] = $this->users_model->loadweekpend();

    //load week of stat page
    $this->template->show('admanalysis', $data2);
  }

  /***
   * 
   * Show detail of the week data after page one of the week is clicked
   * 
   */
  public function moreinfo($weekID)
  {

    $this->load->library('session');
    //load name in header
    $data2['test'] = $this->session->userdata('access');

    //get the weekID to laod data for that week
    $data2['weekID'] = $weekID;

    //get info for that week
    $data2['weekinfo'] = $this->users_model->weekinfo($weekID);

    //get all members
    $data2['member'] = $this->users_model->getmembers();

    //load stat for that week of employee
    $this->template->show('admanalysisweekinfo', $data2);
  }

  /**
   * 
   * ajax value to get selected employee values
   */
  public function EmployeeDetails()
  {
    //get employee information and the week
    $statvalue = $this->input->post();


    // get employee stat for the week
    $data = $this->users_model->getEmployeeestat($statvalue["memberID"], $statvalue["weekID"]);


    echo json_encode($data);
  }

  /**
   * 
   * uopdate stat of user from ajax
   */
  public function UpdateEmployeeDetails()
  {
    // get data from user
    $statvalue = $this->input->post();


    // update employee stat
    $data = $this->users_model->UpdateEmployeeestat($statvalue["memberID"], $statvalue["weekID"], $statvalue["Late"], $statvalue["Pay"], $statvalue["Hours"], $statvalue["ScheduleinfoID"]);


    echo json_encode($data);
  }
}
