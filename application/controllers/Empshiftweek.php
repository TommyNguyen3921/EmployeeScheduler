<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empshiftweek extends CI_Controller {

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

            $data2['loadweeks'] = $this->users_model->loadweeks();


    $this->template->show('empshiftweek',$data2);
  }

  public function empweekinfo($weekID)
  {

    $this->load->library('session');
    $data2['test'] = $this->session->userdata('access');

    $data2['weekID'] = $weekID;
    $memberdata = $this->session->userdata('memberIDE');

    $data2['avail'] =$this->users_model->loadavailshiftemp($weekID);

    print_r($data2['avail']);
    $data2['tableinfo'] = $this->users_model->tableinfoemp($weekID,$memberdata);

    
//testing
    
    //$data2['schedule1'] =$this->users_model->doloadscheduleemployee($memberdata);

    $data2['open'] =$this->users_model->loadopenschedule();
//testing
$data2['empshift'] =$this->users_model->doloadmeployeeshift($memberdata,$weekID);

    $this->template->show('empweekinfo', $data2);
  }

  public function pendingusershift(){
   
    $shiftID = $this->input->post();

    // get data
    $data = $this->users_model->dopendingUserShift($shiftID);

    echo ($data);
  }

  public function acceptopenshift($openshiftID,$weekID)
{
  $memberdata = $this->session->userdata('memberIDE');
  
  $this->users_model->doacceptopenshift($openshiftID,$memberdata,$weekID);

  $this->load->library('session');
    $data2['test'] = $this->session->userdata('access');

    $data2['weekID'] = $weekID;
    

    $data2['avail'] =$this->users_model->loadavailshiftemp($weekID);

   
    $data2['tableinfo'] = $this->users_model->tableinfoemp($weekID,$memberdata);

    
//testing
    
    //$data2['schedule1'] =$this->users_model->doloadscheduleemployee($memberdata);

    $data2['open'] =$this->users_model->loadopenschedule();
//testing
$data2['empshift'] =$this->users_model->doloadmeployeeshift($memberdata,$weekID);

    $this->template->show('empweekinfo', $data2);
}

}