<?php
/*
@project 				: Alshamil
@project Module 		: Utils 
@developrt				: Arun Vasanth Samraj 
@lastmodification date	: 15-05-2018
@controller 			: Action Utils

*/
defined('BASEPATH') OR exit('No direct script access allowed');

class ActionUtils extends CI_Controller {
	
	public function __construct(){
                parent::__construct();   
           $this->load->database();  
           $this->load->Model('Utils_Model' ,'utils'); 
    }
	
	
	function emailcheck() {
        $email = $this->input->post('txtemail');
        $data = $this->utils->emailchecking($email);
        if (($data > 0) && ($email != "")) {
            echo 'Email already exist';
        } else {
            echo '';
        }
    }
    
     public function fetch_product_sharing() {
 	
        if($this->input->is_ajax_request()){  
    	 
			$product_id = $this->input->post('product_id'); 
			$cat_id =  $this->input->post('cat_id'); 
			
            $qry = $this->View_Model->product_details($product_id, $cat_id);
            $data['product_id'] = $product_id ;
            $data['cat_id'] = $cat_id ;
            $data['qry'] = $qry ;
            
            $this->load->view('client/sharer',$data);
       
        
		}else{
			exit('No direct script access allowed');
}	
 	
 	
 	
       
    }
	
	
}
