<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forum extends CI_Controller
{

  var $TPL;

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->model('users_model');

    $this->form_validation->set_rules('topic', 'Topic', 'required');
    $this->form_validation->set_rules('discussion', 'Discussion', 'required');
  }

  /**
   * display forum page
   */
  public function index()
  {

    $this->load->library('session');
    //get value name
    $data2['test'] = $this->session->userdata('access');


    //get all posts
    $data2['posts'] = $this->users_model->loadposts();


    //display forum page
    $this->template->show('forum', $data2);
  }

  /**
   * direct to add forum
   */
  public function addpost()
  {

    $this->load->library('session');

    //get name value
    $data2['test'] = $this->session->userdata('access');




    //go to page to add another post
    $this->template->show('addpost', $data2);
  }

  /**
   * get new post and add to data
   */
  public function submitpost()
  {
    //check if form is filled if not redirect to same page with error message
    if ($this->form_validation->run() == FALSE) {

      $this->load->library('session');
      $data2['test'] = $this->session->userdata('access');




      //dispay same page again
      $this->template->show('addpost', $data2);
      //add new forum topic to data if filled proeprly
    } else {
      $this->load->library('session');

      //get user name
      $data2['test'] = $this->session->userdata('access');

      //get post value
      $topic = $_POST['topic'];
      $discussion = $_POST['discussion'];

      //get memberID
      $memberdata = $this->session->userdata('memberIDE');
      
      //method to add value to database
      $this->users_model->doNewPost($topic, $discussion, $memberdata);


      //go index beginning of forum apge
      $this->index();
    }
  }

  /**
   * see discussion for clicked forum topic
   */
  public function foruminfo($topicID)
  {

    $this->load->library('session');
    //get name value
    $data2['test'] = $this->session->userdata('access');



    //get forum details
    $data2['foruminfo'] = $this->users_model->forumdetail($topicID);

    //store topic id in session
    $this->session->set_userdata('forum', $topicID);

    $test = $this->session->userdata('forum');
    
    //go to forum info
    $this->template->show('foruminfo', $data2);
  }

  /**
   * add new message for forum discussion into database
   */
  public function addmessage()
  {

    $this->load->library('session');

    //get name value
    $data2['test'] = $this->session->userdata('access');

    //get user message
    $message = $_POST['message'];

    //get current forumid
    $forumID = $this->session->userdata('forum');

    //get memberID
    $memberdata = $this->session->userdata('memberIDE');

    //add new forum message into discussion
    $this->users_model->forumdetailadd($memberdata, $forumID, $message);

    //get all forumdetail from discussion
    $data2['foruminfo'] = $this->users_model->forumdetail($forumID);

    //redirect to the forum info page
    $this->template->show('foruminfo', $data2);
  }

  /**
   * search for topic user entered
   */
  public function search()
  {

    $this->load->library('session');

    //get name value
    $data2['test'] = $this->session->userdata('access');

    //get search value
    $search = $_POST['search'];


    $data2['posts'] = $this->users_model->dosearch($search);
    
    //redirect to forum page
    $this->template->show('forum', $data2);
  }
}
