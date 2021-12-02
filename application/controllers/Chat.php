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
//loaduser chat
            $memberdata = $this->session->userdata('memberIDE');
            $data2['chatuser'] = $this->users_model->loadchatuser($memberdata);

//

			
    $this->template->show('chat',$data2);
  }

  public function sendmessage(){
 
    $message = $_POST['message'];
 $memberdata = $this->session->userdata('memberIDE');
 
    $data = $this->users_model->Sendmessage($memberdata, $message);

    $this->index();
}

public function messagehistory(){
  // POST data
  $senduser = $this->input->post();
  $memberdata = $this->session->userdata('memberIDE');

  // get data
  $data = $this->users_model->getmessagehistory($memberdata,$senduser);

 echo json_encode($data);
}

public function messagesend(){
  // POST data
  $senduser = $this->input->post();
  $memberdata = $this->session->userdata('memberIDE');

  
  // get data
  $data = $this->users_model->domessagesend($memberdata,$senduser);

 echo json_encode($data);
}
}