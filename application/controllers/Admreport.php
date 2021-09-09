<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admreport extends CI_Controller {

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

            $data2['reports'] = $this->users_model->loadreport();

            
			//print_r($data2);
    $this->template->show('admreport',$data2);
  }

  public function bugsolve($reportid)
  {
    
    $this->users_model->dosolve($reportid);

    $this->index();
  }

  public function moreinfo($reportid)
  {

    $this->load->library('session');
			$data2['test'] = $this->session->userdata('access');

      $data2['reportsinfo'] = $this->users_model->showmoreinfo($reportid);

            
		
    $this->template->show('admreportinfo',$data2);
  }
}