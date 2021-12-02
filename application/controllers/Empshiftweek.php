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

    $data2['fail'] = false;
    $data2['success'] = false;
    $data2['full'] = false;

    $data2['test'] = $this->session->userdata('access');

    $data2['weekID'] = $weekID;
    $memberdata = $this->session->userdata('memberIDE');

    $data2['avail'] =$this->users_model->loadavailshiftemp($weekID);

    
    $data2['tableinfo'] = $this->users_model->tableinfoemp($weekID,$memberdata);

    


    $data2['open'] =$this->users_model->loadopenschedule();

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
  
  


  $this->load->library('session');

  $checkshift = $this->users_model->doacceptopenshift($openshiftID,$memberdata,$weekID);
  
  if ( $checkshift == 1){
    $data2['fail'] = false;
    $data2['success'] = false;
    $data2['full'] = true;
  }else if ($checkshift == 2){
    $data2['fail'] = false;
    $data2['success'] = true;
    $data2['full'] = false;
  }else if ($checkshift == 3){
    $data2['fail'] = true;
    $data2['success'] = false;
    $data2['full'] = false;
  }

    $data2['test'] = $this->session->userdata('access');

    $data2['weekID'] = $weekID;
    

    $data2['avail'] =$this->users_model->loadavailshiftemp($weekID);

   
    $data2['tableinfo'] = $this->users_model->tableinfoemp($weekID,$memberdata);

    


    $data2['open'] =$this->users_model->loadopenschedule();

$data2['empshift'] =$this->users_model->doloadmeployeeshift($memberdata,$weekID);

    $this->template->show('empweekinfo', $data2);
}

}