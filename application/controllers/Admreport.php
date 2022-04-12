<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admreport extends CI_Controller
{

  var $TPL;

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->model('users_model');
  }

  /**
   * report page for manager
   */
  public function index()
  {

    $this->load->library('session');

    //load name for header
    $data2['test'] = $this->session->userdata('access');

    //get reports
    $data2['reports'] = $this->users_model->loadreport();


    //load manager report page
    $this->template->show('admreport', $data2);
  }

  /**
   * delete bug report
   */
  public function bugsolve($reportid)
  {

    //method to delete bug report
    $this->users_model->dosolve($reportid);

    //go back to bugreport page
    $this->index();
  }

  /**
   * display more information about bug report
   */
  public function moreinfo($reportid)
  {

    $this->load->library('session');

    //get name value
    $data2['test'] = $this->session->userdata('access');

    //display more information of bug report
    $data2['reportsinfo'] = $this->users_model->showmoreinfo($reportid);



    $this->template->show('admreportinfo', $data2);
  }
}
