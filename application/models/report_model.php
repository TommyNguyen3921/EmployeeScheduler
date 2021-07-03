<?php
    	class Report_model extends CI_Model {
    		function __construct(){
    			parent::__construct();
    			$this->load->database();
    		}
     
    		public function Sendreport($user, $topic,$description){
               
                    $query = $this->db->query("INSERT INTO bugreport (memberID,topic,message) VALUES ('$user', '$topic', '$description');");
               
    		}

		
     
    	}
    ?>