<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum extends CI_Controller {

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

      $data2['posts'] = $this->users_model->loadposts();

            
			print_r($data2);
    $this->template->show('forum',$data2);
  }

  public function addpost()
  {

    $this->load->library('session');
			$data2['test'] = $this->session->userdata('access');

          

            
			print_r($data2['test'][0]["memberID"]);
    $this->template->show('addpost',$data2);
  }

  public function submitpost()
  {

    $this->load->library('session');
			$data2['test'] = $this->session->userdata('access');

          
            $topic = $_POST['topic'];
    		$discussion = $_POST['discussion'];
           
            
     $memberdata = $this->session->userdata('memberIDE');
     print_r($memberdata);
    		$this->users_model->doNewPost($topic, $discussion,$memberdata);
            
			
    //$this->template->show('addpost',$data2);
    $this->index();
  }
  public function foruminfo($topicID)
  {

    $this->load->library('session');
			$data2['test'] = $this->session->userdata('access');

      
     
            
     $data2['foruminfo'] = $this->users_model->forumdetail($topicID);

     $this->session->set_userdata('forum',$topicID);

     $test = $this->session->userdata('forum');
     print_r($data2);
    $this->template->show('foruminfo',$data2);
  }

  public function addmessage()
  {

    $this->load->library('session');
			$data2['test'] = $this->session->userdata('access');
      $message = $_POST['message'];

      $forumID = $this->session->userdata('forum');
      $memberdata = $this->session->userdata('memberIDE');
      $this->users_model->forumdetailadd($memberdata,$forumID,$message);
      $data2['foruminfo'] = $this->users_model->forumdetail($forumID);
      
    $this->template->show('foruminfo',$data2);
  }
  public function search()
  {

    $this->load->library('session');
			$data2['test'] = $this->session->userdata('access');
      $search = $_POST['search'];

      
      $data2['posts'] = $this->users_model->dosearch($search);
     print_r($data2['posts']);
    
    $this->template->show('forum',$data2);
  }
}