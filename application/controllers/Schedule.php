<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_Controller {

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

      $data2['schedule'] =$this->users_model->loadschedule();

      $memberdata = $this->session->userdata('memberIDE');
      $data2['schedule1'] =$this->users_model->doloadscheduleemployee($memberdata);

      $data2['open'] =$this->users_model->loadopenschedule();
			print_r($memberdata);
    $this->template->show('schedule',$data2);
  }

  public function pending(){
   
    $shiftID = $this->input->post();

    // get data
    $data = $this->users_model->dopending($shiftID);

    echo ($data);
  }

  public function openshiftaccept(){
   
    $openshiftID = $this->input->post();
    $memberdata = $this->session->userdata('memberIDE');
    // get data
    $data = $this->users_model->doopenshiftaccept($openshiftID,$memberdata);

    
    echo json_encode($data);
  }

}