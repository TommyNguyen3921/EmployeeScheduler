<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admanalysis extends CI_Controller {

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
            
    $this->template->show('admanalysis',$data2);
  }

  public function moreinfo($weekID)
  {

    $this->load->library('session');
    $data2['test'] = $this->session->userdata('access');

    $data2['weekID'] = $weekID;

    $data2['weekinfo'] = $this->users_model->weekinfo($weekID);

    $data2['member'] =$this->users_model->getmembers();
    
    
    $this->template->show('admanalysisweekinfo', $data2);
  }

  public function EmployeeDetails(){
    // POST data
    $statvalue = $this->input->post();

    
    // get data
   $data = $this->users_model->getEmployeeestat($statvalue["memberID"],$statvalue["weekID"]);
    
  
    echo json_encode($data);
  }

  public function UpdateEmployeeDetails(){
    // POST data
    $statvalue = $this->input->post();

    
    // get data
   $data = $this->users_model->UpdateEmployeeestat($statvalue["memberID"],$statvalue["weekID"],$statvalue["Late"],$statvalue["Pay"],$statvalue["Hours"],$statvalue["ScheduleinfoID"]);
    
  
    echo json_encode($data);
  }



}