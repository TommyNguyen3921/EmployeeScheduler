<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

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
    $memberdata = $this->session->userdata('memberIDE');
    $data2['memberinfo'] = $this->users_model->loadprofile($memberdata);
    
    
    $data2["success"] = false;
    $this->template->show('profile',$data2);
  }

  public function updateprofile()
  {
    $this->form_validation->set_rules('username', 'Username', 'required');
  
    $this->form_validation->set_rules('name', 'Name', 'required');

    if ($this->form_validation->run() == FALSE){
        
      $this->index();
     
    }else{


    $this->load->library('session');
	$data2['test'] = $this->session->userdata('access');
    $memberdata = $this->session->userdata('memberIDE');

    
    $user = $_POST['username'];
   
    
    
    
   $this->users_model->doupdateprofile($memberdata,$user);

    $data2['memberinfo'] = $this->users_model->loadprofile($memberdata);
   
    $data2["success"] = true;
    $this->template->show('profile',$data2);
    }
  }
  


  public function updatepassword()
  {
    
    $this->form_validation->set_rules('password', 'password', 'required|min_length[6]|max_length[12]');
    if ($this->form_validation->run() == FALSE){
        
      $this->index();
     
    }else{


    $this->load->library('session');
	$data2['test'] = $this->session->userdata('access');
    $memberdata = $this->session->userdata('memberIDE');

    
    $pass = $_POST['password'];
   
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
    
    $this->users_model->doupdatepassword($memberdata,$hashed_password);

   

    $data2['memberinfo'] = $this->users_model->loadprofile($memberdata);
   
    $data2["success"] = true;
    $this->template->show('profile',$data2);
    }
  }


}