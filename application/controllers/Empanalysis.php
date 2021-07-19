<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empanalysis extends CI_Controller {

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
      $member= $this->session->userdata('memberIDE');
      $data2['analysis'] = $this->users_model->loadanalysis($member);
    $this->template->show('empanalysis',$data2);
  }

  
}