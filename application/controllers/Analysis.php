<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Analysis extends CI_Controller {

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

            $data2['member'] =$this->users_model->getmembers();
    $this->template->show('analysis',$data2);
  }

  public function userDetails(){
    // POST data
    $memberID = $this->input->post();

    // get data
    $data = $this->users_model->getmembersinfo($memberID);

    echo json_encode($data);
  }

  public function addDetails(){
    // POST data
    $data = array(

      'date' => $this->input->post('date'),

      'change' => $this->input->post('change'),
      'lates' => $this->input->post('lates'),

      'pay' => $this->input->post('pay'),
      'hours' => $this->input->post('hours'),

      'user' => $this->input->post('user')

  );

  $data1 = $this->users_model->doadddetails($data);
 

    echo json_encode($data1);
  }

  public function delete(){
   
    $statID = $this->input->post();

    // get data
    $data1 = $this->users_model->dodeletestat($statID);

    echo json_encode($data1);
  }

  public function update(){
   
    $statID = $this->input->post();

    // get data
    $data1 = $this->users_model->doupdate($statID);
    $this->session->set_userdata('statvalue',$statID["statID"]);
    
    echo json_encode($data1);
  }

  public function updatevalue(){
    $data2 = $this->session->userdata('statvalue');
    $data = array(

      'date' => $this->input->post('date'),

      'change' => $this->input->post('change'),
      'lates' => $this->input->post('lates'),

      'pay' => $this->input->post('pay'),
      'hours' => $this->input->post('hours'),

      'user' => $this->input->post('user'),
      'statid' => $data2

  );
 

  
    // get data
    $data1 = $this->users_model->doupdatevalue($data);
    
   echo json_encode($data1);
  }
}