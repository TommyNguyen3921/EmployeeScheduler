<?php
    	class Users_model extends CI_Model {
    		function __construct(){
    			parent::__construct();
    			$this->load->database();
    		}
     
    		public function login($email, $password){
    			$query = $this->db->get_where('importantusers', array('USERNAME'=>$email, 'PASSWORD'=>$password));
    			return $query->row_array();
    		}

			public function navlevel($email, $password){
    			$query = $this->db->get_where('importantusers', array('USERNAME'=>$email, 'PASSWORD'=>$password));

				$user = $query->row();
    			return $user->level;

				
    		}
     
    	}
    ?>