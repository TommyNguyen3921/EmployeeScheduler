<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setupschedule extends CI_Controller
{

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

    $data2['checkscheduleweek'] = $this->users_model->checkscheduleweek();

    $data2['loadweeks'] = $this->users_model->loadweeks();


    $this->template->show('setupschedule', $data2);
  }
  public function addnewweek()
  {

    $this->load->library('session');
    $data2['test'] = $this->session->userdata('access');

    $data2['startdatepicker'] = $_POST['startdatepicker'];
    $data2['Enddatepicker'] = $_POST['Enddatepicker'];





    //print_r($data2['test'][0]["memberID"]);
    $this->template->show('addnewweek', $data2);
  }

  public function submitshift()
  {
    $item = $this->input->post();


    $this->users_model->addweek($item);
  }

  public function uselastweek()
  {
    $this->load->library('session');
    $data2['test'] = $this->session->userdata('access');


    $start = $_POST['startdatepicker1'];
    $end = $_POST['Enddatepicker1'];



    $data2['checkscheduleweek'] = $this->users_model->checkscheduleweek();

    $this->users_model->douselastweek($start, $end);

    $data2['loadweeks'] = $this->users_model->loadweeks();
    $this->template->show('setupschedule', $data2);
  }

  public function moreinfo($weekID)
  {

    $this->load->library('session');
    $data2['test'] = $this->session->userdata('access');

    $data2['weekID'] = $weekID;

    $data2['weekinfo'] = $this->users_model->weekinfo($weekID);


    $data2['member'] = $this->users_model->getmembers();
    $data2['tableinfo'] = $this->users_model->tableinfo($weekID);
    //print_r($data2['tableinfo']);   

    $this->template->show('weekinfo', $data2);
  }
  public function addshift()
  {
    $data = $this->input->post();
    $result = $this->users_model->doaddshift($data);

    echo json_encode($result);
  }

  public function filtername()
  {
    // POST data
    $memberID = $this->input->post();

    // get data
    $data = $this->users_model->dofiltername($memberID);

    echo json_encode($data);
  }

  public function filterdate()
  {
    // POST data
    $filtervalue = $this->input->post();

    // get data
    $data = $this->users_model->dofilterdate($filtervalue);

    echo json_encode($data);
  }

  //day info page
  public function dayinfo($weekID, $day)
  {

    $this->load->library('session');
    $data2['test'] = $this->session->userdata('access');

    $data2['weekID'] = $weekID;
    $data2['day'] = $day;

    $data2['weekdate'] = $this->users_model->weekdate($weekID);


    $data2['dayinfoload'] = $this->users_model->loaddayinfo($weekID, $day);

    $data2['load'] = $this->users_model->loademployeeinfo($weekID, $day);


    $data2['loadscheduleemployee'] = $this->users_model->loadscheduleemployee($weekID, $day);

   

    $data2['loadshiftslot'] = $this->users_model->doshiftslot($weekID, $day);

    $data2['shiftstables'] = $this->users_model->doshiftstable($weekID, $day);
    
 

    $data2['weekinfo'] = $this->users_model->weekinfoshift($weekID, $day);


    //print_r($data2['load']);

    $this->template->show('dayinfo', $data2);
  }

  public function deleteshift($shiftID, $weekID, $day)
  {


    $this->users_model->dodeleteshift($shiftID);


    $this->load->library('session');
    $data2['test'] = $this->session->userdata('access');

    $data2['weekID'] = $weekID;
    $data2['day'] = $day;

    $data2['weekdate'] = $this->users_model->weekdate($weekID);


    $data2['dayinfoload'] = $this->users_model->loaddayinfo($weekID, $day);

    $data2['load'] = $this->users_model->loademployeeinfo($weekID, $day);
    $data2['loadscheduleemployee'] = $this->users_model->loadscheduleemployee($weekID, $day);

    $data2['loadshiftslot'] = $this->users_model->doshiftslot($weekID, $day);
    //print_r($data2['loadshiftslot']);

    $data2['shiftstables'] = $this->users_model->doshiftstable($weekID, $day);

   

    $data2['weekinfo'] = $this->users_model->weekinfoshift($weekID, $day);

    $this->template->show('dayinfo', $data2);
  }
}
