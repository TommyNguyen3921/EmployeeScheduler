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
			$data1['test'] = $this->session->userdata('access');
    		//restrict users to go back to login if session has been set
    		//if($this->session->userdata('user')){
    			//redirect('login');
    		//}
    		//else{
    			$this->template->show('home',$data1);
    		//}
    	}
     
    	public function login(){
    		//load session library
    		$this->load->library('session');
     

			

    		$email = $_POST['email'];
    		$password = $_POST['password'];
     
    		$data = $this->users_model->login($email);
			

			$checkcred = password_verify($password, $data['password']);

			
    		if($checkcred){
				$data1['test'] = $this->users_model->checklogin($email);
				$testdata  = $data1['test'];
				//print_r($testdata[0]['memberID']);
				
				$this->session->set_userdata('memberIDE',$testdata[0]['memberID']);
				$accesslevel = $data1['test'];
				$this->session->set_userdata('access',$accesslevel);
    			$this->session->set_userdata('home', $data1);
				if($accesslevel[0]['level'] == 2){
				
				$data2['test'] = $this->session->userdata('access');

            $data2['loadweeks'] = $this->users_model->loadweekpend();

    			$this->template->show('admpendshiftweek',$data2);
				}else{

					$data2['test'] = $this->session->userdata('access');

					$data2['loadweeks'] = $this->users_model->loadweeks();
		
		
			$this->template->show('empshiftweek',$data2);
			
				}
    		}
    		else{
				$data1['error'] = true;
    			$this->load->view('login',$data1);
				
    			
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