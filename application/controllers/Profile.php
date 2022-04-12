<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{

  var $TPL;

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->model('users_model');
  }

  /**
   * display forum page
   */
  public function index()
  {

    $this->load->library('session');

    //get value for name
    $data2['test'] = $this->session->userdata('access');

    //get memberID
    $memberdata = $this->session->userdata('memberIDE');

    //get profile value
    $data2['memberinfo'] = $this->users_model->loadprofile($memberdata);

    //display success message is false
    $data2["success"] = false;

    //display profile page
    $this->template->show('profile', $data2);
  }


  /**
   * update the logged in user username
   */
  public function updateprofile()
  {
    $this->form_validation->set_rules('username', 'Username', 'required');

    $this->form_validation->set_rules('name', 'Name', 'required');

    //check if all validation reuirement is met if not return redirect to profile page
    if ($this->form_validation->run() == FALSE) {

      $this->index();
      //update profile page if validation is met
    } else {


      $this->load->library('session');

      //get name value
      $data2['test'] = $this->session->userdata('access');

      //get memberID
      $memberdata = $this->session->userdata('memberIDE');


      //get user new username
      $user = $_POST['username'];



      //method to update profile
      $this->users_model->doupdateprofile($memberdata, $user);

      //load logged in user profile
      $data2['memberinfo'] = $this->users_model->loadprofile($memberdata);

      //display succes for update
      $data2["success"] = true;

      //redirect to profile page
      $this->template->show('profile', $data2);
    }
  }


/**
 * update the user password
 */
  public function updatepassword()
  {

    $this->form_validation->set_rules('password', 'password', 'required|min_length[6]|max_length[12]');
    //check if all validation requirement is met redirect to page if it does not with error message
    if ($this->form_validation->run() == FALSE) {

      $this->index();
      //if requirement is met upate apssword
    } else {


      $this->load->library('session');

      //get name value
      $data2['test'] = $this->session->userdata('access');

      //get memberID
      $memberdata = $this->session->userdata('memberIDE');

      //get new password value
      $pass = $_POST['password'];

      //hash password
      $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

      //method to update password
      $this->users_model->doupdatepassword($memberdata, $hashed_password);


      //get user profile
      $data2['memberinfo'] = $this->users_model->loadprofile($memberdata);

      //display sucess message
      $data2["success"] = true;

      //redirect to profile page
      $this->template->show('profile', $data2);
    }
  }
}
