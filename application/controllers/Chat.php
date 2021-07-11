<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {

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

            $data2['chat'] = $this->users_model->loadchat();

            
			print_r($data2);
    $this->template->show('chat',$data2);
  }

  public function sendmessage(){
 
    $message = $_POST['message'];
 $memberdata = $this->session->userdata('memberIDE');
 print_r($memberdata);
    $data = $this->users_model->Sendmessage($memberdata, $message);

    $this->index();
}
}