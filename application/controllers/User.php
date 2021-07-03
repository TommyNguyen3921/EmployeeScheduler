<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
     
    class User extends CI_Controller {
     
    	function __construct(){
    		parent::__construct();
    		$this->load->helper('url');
    		$this->load->model('users_model');
    	}
     
    	public function index(){
    		//load session library
    		$this->load->library('session');
			$data2['level'] = $this->session->userdata('access');
    		//restrict users to go back to login if session has been set
    		//if($this->session->userdata('user')){
    			//redirect('login');
    		//}
    		//else{
    			$this->template->show('home',$data2);
    		//}
    	}
     
    	public function login(){
    		//load session library
    		$this->load->library('session');
     
    		$email = $_POST['email'];
    		$password = $_POST['password'];
     
    		$data = $this->users_model->login($email, $password);
			$data2['level'] = $this->users_model->navlevel($email, $password);
			$accesslevel = $data2['level'];
			$this->session->set_userdata('access',$accesslevel);

			
    		if($data){
    			$this->session->set_userdata('home', $data);
    			$this->template->show('home',$data2);
    		}
    		else{
    			header('location:'.base_url().$this->index());
    			$this->session->set_flashdata('error','Invalid login. User not found');
    		} 
    	}
     
    	public function home(){
    		//load session library
    		$this->load->library('session');
     
    		//restrict users to go to home if not logged in
    		if($this->session->userdata('user')){
    			$this->load->view('login');
    		}
    		else{
    			redirect('/');
    		}
     
    	}
     
    	public function logout(){
    		//load session library
    		$this->load->library('session');
    		$this->session->unset_userdata('user');
    		redirect('/');
    	}
     
    }