<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Createacc extends CI_Controller {

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

            $data2['accounts'] = $this->users_model->loadaccounts();

            
			//print_r($data2);
    $this->template->show('createacc',$data2);
  }

  

public function create(){
    $name = $_POST['name'];
        $user = $_POST['user'];
    $password = $_POST['password'];
    $level = $_POST['level'];
 

    $this->users_model->addaccount($name,$user,$password,$level);
        
	//print_r($level);
    
    $this->index();
}

public function delete($memberID)
{
  
  $this->users_model->dodelete($memberID);

  $this->index();
}
}