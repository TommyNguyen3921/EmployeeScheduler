<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Empreport extends CI_Controller
{

  var $TPL;

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->model('users_model');

    $this->form_validation->set_rules('topic', 'Topic', 'required');
    $this->form_validation->set_rules('description', 'Description', 'required');
  }

  /**
   * display employeee report page
   */
  public function index()
  {

    $this->load->library('session');
    //get name value
    $data2['test'] = $this->session->userdata('access');

    //display success message false
    $data2["success"] = false;
    //load employee report page
    $this->template->show('empreport', $data2);
  }

  /**
   * get user report
   */
  public function report()
  {
    //get value from user
    $user = $_POST['user'];
    $topic = $_POST['topic'];
    $description = $_POST['description'];

    //check form validation if they miss an input
    if ($this->form_validation->run() == FALSE) {
      //reload page if they did
      $this->index();
    } else {

      //get memberID
      $memberdata = $this->session->userdata('memberIDE');
      //insert report data to database
      $data = $this->users_model->Sendreport($memberdata, $topic, $description);

      //get name value
      $data2['test'] = $this->session->userdata('access');

      //display success when report is added
      $data2["success"] = true;

      //load employee report page
      $this->template->show('empreport', $data2);
    }
  }
}
