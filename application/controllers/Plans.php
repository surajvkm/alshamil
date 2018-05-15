<?php
/*
@project 				: Alshamil
@project Module 		: Signup 
@developrt				: Arun Vasanth Samraj 
@lastmodification date	: 4-05-2018
@controller 			: Trader Signup

*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Plans extends CI_Controller {
	
	public function __construct(){
    parent::__construct();   
    is_logged_in();
    $this->load->database();
    $this->load->Model('Trader_Model' ,'trd');     
    }

	public function index()
	{
	    is_allowed();
	  
	    $page_data['plans'] = $this->trd->fetch_plans();
        $page_data['title'] = 'Alshamil - Choose A Plan ';
        $page_data['page']  = 'plan'; 
		$this->load->view('client/index',$page_data);
	}
	public function  plan_options () {
		
        if ($this->input->is_ajax_request() and is_allowed()) {

			$this->load->Model('Utils_Model' ,'utils');    
            $session_data = $this->session->userdata('logged_in');
            $trader_id = $session_data['trader_id'];
            $plan_id = $this->input->post('plan_id');
            $chkqry = $this->utils->check_subplan_exist($trader_id);
            $response = 'failed';
            
            if ($chkqry>0) {
                $qry = $this->utils->fetch_plan($plan_id);
                
                $plan_name = $qry->name;
                $plan_amt = $qry->amount;
                $plan_postcnt = $qry->postCount;
                $plan_valid = $qry->validity;


                $data['planId'] = $plan_id;
                $data['subscribedOn'] = date('yyyy-mm-dd');
                $data['planValidity'] = $plan_valid;
                $data['planStatus'] = 0;
                $data['paymentProof'] = '';
                $data['traderID'] = $trader_id;
                $data['paymentTypeChosen'] = 0;
                
                $status = $this->trd->update_payment_option($data,$plan_postcnt);
                if($status){
					$response ='success'; 
				}
                
                
                
               
               
            } else {
                $qry = $this->utils->fetch_plan($plan_id);
                $plan_name = $qry->name;
                $plan_amt = $qry->amount;
                $plan_postcnt = $qry->postCount;
                $plan_valid = $qry->validity;
                
                
                $data['planId'] = $plan_id;
                $data['subscribedOn'] = date('yyyy-mm-dd');
                $data['planValidity'] = $plan_valid;
                $data['planStatus'] = 0;
                $data['paymentProof'] = '';
                $data['traderID'] = $trader_id;
                $data['paymentTypeChosen'] = 0;
                $data['planPostCount'] = $plan_postcnt;
                $status = $this->trd->save_payment_option($data);
                if($status){
					$response ='success';
				}

              
            }

            echo $response;exit;
        } else {
             exit('No direct script access allowed');
        }
    }
    
	function payment_options() {
		is_allowed();
		
        $page_data['title'] = 'Alshamil - Payment Options ';
        $page_data['page']  = 'payment_options'; 
		$this->load->view('client/index',$page_data);
    }
    
     function office_loc() {
     	
     	 if ($this->input->is_ajax_request() and is_allowed() ) {
     	
        $this->load->Model('Utils_Model' ,'utils');    
        $qry = $this->utils->get_office_loc();
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $this->utils->up_paystatus($trader_id ,1);
        if($qry->num_rows()>0) {
			 echo "<p>You can pay at Alshamil Office<br>$qry->row()->address <br> $qry->row()->name <br>$qry->row()->contactNo </p><p><a href='#' target='_blank'>Get Directions on Google Maps</a></p> "; exit;
		}else{
			
			echo '';
			exit;
		}
       
          
            
    }
    else {
             exit('No direct script access allowed');
   }
   
   }
   
   
   function getplanAmount() {
     	
   if ($this->input->is_ajax_request() and is_allowed() ) {
     	
       $this->load->Model('Utils_Model' ,'utils');    
       $session_data = $this->session->userdata('logged_in');
       $trader_id = $session_data['trader_id'];
       $this->utils->up_paystatus($trader_id ,3);
       $qry = $this->utils->trader_plan_amts($trader_id);
       echo $qry->row()->samount . "-" . $trader_id ; exit;
          
            
    }
    else {
             exit('No direct script access allowed');
   }
   
   }
   
   
    function updatebankPay() {
           
        if ($this->input->is_ajax_request() and is_allowed() ) {
        	$this->load->Model('Utils_Model' ,'utils');  
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $this->utils->up_paystatus($trader_id ,2);
        }
         else {
             exit('No direct script access allowed');
   }
    }
    
    
	
	
}