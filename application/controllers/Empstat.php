<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empstat extends CI_Controller {

  var $TPL;

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->model('users_model');
  }

  public function index()
  {

    $this->load->library('session');
			$data2['test'] = $this->session->userdata('access');

            $data2['loadweeks'] = $this->users_model->loadweekpend();
            
    $this->template->show('empstat',$data2);
  }

  public function moreinfo($weekID)
  {

    $this->load->library('session');
    $data2['test'] = $this->session->userdata('access');

    $memberdata = $this->session->userdata('memberIDE');

    $data2['weekID'] = $weekID;

    $data2['weekinfo'] = $this->users_model->weekinfo($weekID);

    $data2['statinfo'] = $this->users_model->getEmployeeestat($memberdata,$weekID);
    
    
    $this->template->show('empstatweekinfo', $data2);
  }





}