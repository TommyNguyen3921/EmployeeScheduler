<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empreport extends CI_Controller {

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
    $this->template->show('empreport',$data2);
  }

  public function report(){
        $user = $_POST['user'];
    		$topic = $_POST['topic'];
        $description = $_POST['description'];
     $memberdata = $this->session->userdata('memberIDE');
    		$data = $this->users_model->Sendreport($memberdata, $topic,$description);

        $data2['test'] = $this->session->userdata('access');
        $this->template->show('empreport',$data2);
  }
}