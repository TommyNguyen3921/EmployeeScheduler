<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Createacc extends CI_Controller
{

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

  /**
   * display create account page
   */
  public function index()
  {

    $this->load->library('session');
    //get value for name
    $data2['test'] = $this->session->userdata('access');

    //load all accounts
    $data2['accounts'] = $this->users_model->loadaccounts();

    //display error message false
    $data2['error'] = false;

    //display success message false
    $data2['success'] = false;

    //display delete message false
    $data2['deletecheck'] = false;
    
    //show create account apge
    $this->template->show('createacc', $data2);
  }


  /**
   * create new account
   */
  public function create()
  {
    $check = true;

    //get username from user
    $user = $_POST['user'];

    //check if user is already used
    $check  = $this->users_model->checkduplicate($user);

    // perform form validation, if it fails, report failure


    if ($this->form_validation->run() == FALSE) {
      //show index create account page
      $this->index();
      //if username already exist
    } else if ($check == false) {
      // set a template variable to report validation failure

      $this->load->library('session');
      //get value for name
      $data2['test'] = $this->session->userdata('access');

      //get accounts
      $data2['accounts'] = $this->users_model->loadaccounts();

      //dont display success or deletecheck
      $data2['success'] = false;
      $data2['deletecheck'] = false;

      //show error
      $data2['error'] = true;
      //show index create account page
      $this->template->show('createacc', $data2);

      //add account to database
    } else {
      $name = $_POST['name'];
      $user = $_POST['user'];
      $password = $_POST['password'];
      $level = $_POST['level'];

      //hash password
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      //add new account into data
      $this->users_model->addaccount($name, $user, $hashed_password, $level);

      

      $this->load->library('session');

      //get value for name
      $data2['test'] = $this->session->userdata('access');

      //load all the accounts
      $data2['accounts'] = $this->users_model->loadaccounts();
      
      //dont display error
      $data2['error'] = false;

      //display successfully added
      $data2['success'] = true;

      //dont display deletecheck
      $data2['deletecheck'] = false;
      
      //display create account page
      $this->template->show('createacc', $data2);
    }
  }

  /**
   * delete user from table
   */
  public function delete($memberID)
  {

    //method to delete user
    $delete = $this->users_model->dodelete($memberID);

    $this->load->library('session');
    //get value for name
    $data2['test'] = $this->session->userdata('access');

    //loadaccounts
    $data2['accounts'] = $this->users_model->loadaccounts();

    //dont show error or success
    $data2['error'] = false;
    $data2['success'] = false;

    //check if table value is deleted
    if ($delete == true) {
      //display if 1 manager and didnt delete
      $data2['deletecheck'] = true;
    } else {
      $data2['deletecheck'] = false;
    }
    
    //display create account page 
    $this->template->show('createacc', $data2);
  }

  /**
   * reseting the password for user account
   */
  public function resetpass()
  {

    //get password value
    $resetvalue = $this->input->post();

    //add reset password to data
    $data = $this->users_model->doresetpass($resetvalue);

    echo json_encode($data);
  }
}
