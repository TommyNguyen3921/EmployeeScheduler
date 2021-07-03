<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empreport extends CI_Controller {

  var $TPL;

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->model('Reports_model');
  }

  public function index()
  {
/**sdfdsffghgfd */
    $this->load->library('session');
			$data2['level'] = $this->session->userdata('access');
    $this->template->show('empreport',$data2);
  }

  public function report(){
        $user = $_POST['user'];
    		$topic = $_POST['topic'];
        $description = $_POST['description'];
     
    		$data = $this->reports_model->Sendreport($user, $topic,$description);

        $data2['level'] = $this->session->userdata('access');
        $this->template->show('empreport',$data2);
  }
}