<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setup extends CI_Controller {

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

      $data2['member'] =$this->users_model->getmemberssetup();

      $data2['schedule'] =$this->users_model->loadschedule();

        $test =   $data2['schedule'];
        
        print_r($test);
		
    $this->template->show('setup',$data2);
  }
  public function Addschedule(){
    $member = $_POST['member'];
        $date = $_POST['date'];
    $start = $_POST['start'];
    $end = $_POST['end'];
 

    $this->users_model->doaddschedule($member,$date,$start,$end);
        
	print_r($member);
    
    $this->index();
}

public function reset(){


  $this->users_model->doreset();
      

  
  $this->index();
}
}