<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admpendshift extends CI_Controller {

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
            print_r($data2['loadweeks']);
    $this->template->show('admpendshiftweek',$data2);
  }

  public function moreinfo($weekID)
  {

    $this->load->library('session');
    $data2['test'] = $this->session->userdata('access');

    $data2['weekID'] = $weekID;

    $data2['weekinfo'] = $this->users_model->weekinfo($weekID);

    
    //print_r($data2['weekinfo']);

    $data2['shiftpending'] = $this->users_model->weekpendingshifts($weekID);

    print_r($data2['shiftpending']);

    $stack = array();
    if($data2['shiftpending'] == NULL){
        
        $emptyarray = array("sun"=>"0", "mon"=>"0", "tue"=>"0","wed"=>"0","thu"=>"0","fri"=>"0","sat"=>"0");
        array_push($stack,$emptyarray);
        $data2['shiftpending'] = $stack;
    }

    
    
    $this->template->show('admpendshiftweekinfo', $data2);
  }

  public function dayinfo($day, $weekID)
  {


    


    $this->load->library('session');
    $data2['test'] = $this->session->userdata('access');

    $data2['weekID'] = $weekID;
    $data2['day'] = $day;

    $data2['weekinfo'] = $this->users_model->weekinfo($weekID);

    $data2['shiftstables'] = $this->users_model->doshiftstable($weekID, $day);
    $data2['pending'] = $this->users_model->admpendingschedule($weekID, $day);
    $data2['loadshiftslot'] = $this->users_model->doshiftslot($weekID, $day);

    $data2['open'] =$this->users_model->loadavailshift($weekID, $day);
    print_r($data2['open']);
    $this->template->show('admpendshiftdayinfo', $data2);
  }


  public function penddecline(){
   
    $pendID = $this->input->post();

    // get data
    
   $this->users_model->dopenddeclineshift($pendID);

    
  }

  public function pendaccept($pendID,$day, $weekID)
{
  
  $this->users_model->dopendacceptshift($pendID);

  
  $this->load->library('session');
  $data2['test'] = $this->session->userdata('access');

  $data2['weekID'] = $weekID;
  $data2['day'] = $day;

  $data2['weekinfo'] = $this->users_model->weekinfo($weekID);

  $data2['shiftstables'] = $this->users_model->doshiftstable($weekID, $day);
  $data2['pending'] = $this->users_model->admpendingschedule($weekID, $day);
  $data2['loadshiftslot'] = $this->users_model->doshiftslot($weekID, $day);
 
  $data2['open'] =$this->users_model->loadavailshift($weekID, $day);
  $this->template->show('admpendshiftdayinfo', $data2);
}

public function deleteopenshift(){
   
  $openshiftID = $this->input->post();

  // get data
 $data1 = $this->users_model->dodeleteopenshift($openshiftID);

  
}
}