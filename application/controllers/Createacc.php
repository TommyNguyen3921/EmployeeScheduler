<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Createacc extends CI_Controller {

  var $TPL;

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->model('users_model');
    $this->form_validation->set_rules('user', 'Username', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_rules('name', 'Name', 'required');
   
  }

  public function index()
  {

    $this->load->library('session');
			$data2['test'] = $this->session->userdata('access');

            $data2['accounts'] = $this->users_model->loadaccounts();

            $data2['error'] = false;
            $data2['success'] = false;
            $data2['deletecheck'] = false;
			//print_r($data2);
    $this->template->show('createacc',$data2);
  }

  

public function create(){
  $check =true;
  $user = $_POST['user'];
  
  $check  = $this->users_model->checkduplicate($user);

  // perform form validation, if it fails, report failure


   if ($this->form_validation->run() == FALSE){
        
    $this->index();
   
  }else if ($check == false)
  {
  // set a template variable to report validation failure
   
    $this->load->library('session');
			$data2['test'] = $this->session->userdata('access');

            $data2['accounts'] = $this->users_model->loadaccounts();
            $data2['success'] = false;
            $data2['deletecheck'] = false;
            $data2['error'] = true;
			//print_r($data2);
    $this->template->show('createacc',$data2);
  }else{
    $name = $_POST['name'];
        $user = $_POST['user'];
    $password = $_POST['password'];
    $level = $_POST['level'];
 
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $this->users_model->addaccount($name,$user,$hashed_password,$level);
        
	//print_r($level);
    
  $this->load->library('session');
  $data2['test'] = $this->session->userdata('access');

        $data2['accounts'] = $this->users_model->loadaccounts();

        $data2['error'] = false;
        $data2['success'] = true;
        $data2['deletecheck'] = false;
  //print_r($data2);
$this->template->show('createacc',$data2);
}

}

public function delete($memberID)
{
  
  $delete = $this->users_model->dodelete($memberID);

  $this->load->library('session');
  $data2['test'] = $this->session->userdata('access');

        $data2['accounts'] = $this->users_model->loadaccounts();

        $data2['error'] = false;
        $data2['success'] = false;
        if ($delete == true){
        $data2['deletecheck'] = true;
      }else{
        $data2['deletecheck'] = false;
      }
  //print_r($data2);
$this->template->show('createacc',$data2);
}

public function resetpass(){
   
  $resetvalue = $this->input->post();

  // get data
  $data = $this->users_model->doresetpass($resetvalue);
 
  echo json_encode($data);
}
}