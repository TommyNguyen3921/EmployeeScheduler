<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Chat extends CI_Controller
{

  var $TPL;

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->model('users_model');
  }

  /**
   * display chat
   */
  public function index()
  {

    $this->load->library('session');
    //get name valye
    $data2['test'] = $this->session->userdata('access');


    //get memberID
    $memberdata = $this->session->userdata('memberIDE');

    //load all member to chat
    $data2['chatuser'] = $this->users_model->loadchatuser($memberdata);



    //display chat
    $this->template->show('chat', $data2);
  }


  /**
   * display message history for user and chatter
   */
  public function messagehistory()
  {
    //get user chat value
    $senduser = $this->input->post();

    //get memberid
    $memberdata = $this->session->userdata('memberIDE');

    // get message history of chat between users
    $data = $this->users_model->getmessagehistory($memberdata, $senduser);

    echo json_encode($data);
  }

  /**
   * send new message data
   */
  public function messagesend()
  {
    //get new message
    $senduser = $this->input->post();

    //get memberID
    $memberdata = $this->session->userdata('memberIDE');


    //add message to table
    $data = $this->users_model->domessagesend($memberdata, $senduser);

    echo json_encode($data);
  }
}
