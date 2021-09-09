<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scheduleadm extends CI_Controller {

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

      $data2['pending'] =$this->users_model->loadpendingschedule();

      $data2['open'] =$this->users_model->loadopenschedule();
      //print_r($data2['pending']);
    $this->template->show('scheduleadm',$data2);
  }

  public function penddecline(){
   
    $pendID = $this->input->post();

    // get data
   $data1 = $this->users_model->dopenddecline($pendID);

    
  }

  public function pendaccept(){
   
    $pendID = $this->input->post();
    //testing to get name value
    //$data2 = $this->users_model->dopendname($pendID);
  
    //get data
   $data1 = $this->users_model->dopendaccept($pendID);

   echo json_encode($data1);
  }
  
  public function openshiftdelete(){
   
    $openshiftID = $this->input->post();

    // get data
   $data1 = $this->users_model->doopenshiftdelete($openshiftID);

    
  }
}