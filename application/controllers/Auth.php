<?php
/*
@project 				: Alshamil
@project Module 		: Signup 
@developrt				: Arun Vasanth Samraj 
@lastmodification date	: 15-05-2018
@controller 			: Auth

*/


defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->Model('Trader_Model' ,'trd'); 
}


public function login_attempt(){ 
if($this->input->post()):
	    $this->form_validation->set_rules('txtemail', 'UserName', 'required');
        $this->form_validation->set_rules('txtpassword', 'Password', 'required|callback_check_database');
             if ($this->form_validation->run() == FALSE) {
             	     $this->session->set_flashdata('errors', validation_errors());
             	     redirect(base_url().'signin','location',301);
            	
            	} 
             else{
                 redirect(base_url().'trader/profile','location',301);
             }
else:
	redirect(base_url(),'location',301);
endif;	
}
	
function check_database($txtpassword) {
	    	
        $txtusertype = $this->input->post('txtusertype');
        $txtemail = $this->input->post('txtemail');
        $result = $this->trd->get_trader($txtemail, $txtpassword, $txtusertype);
        if ($result) {
            $sess_array = array(); 
            foreach ($result->result() as $row) { 
                $Uname=($row->userType==1)?
                $row->userName:$row->email;
                $sess_array = array(
                    'traderUserName' => $Uname,
                    'traderName' => $row->fullName,
                    'traderImage' => $row->image,
                    'trader_id' => $row->traderId,
                    'txtemail' => $row->email,
                    'txtusertype' => $row->userType,
                    'isActive' => $row->isActive,
                    'plan' => $row->planId,
                    'plantype'=>($row->tplanID==3||$row->tplanID==4)?1:0 //1-limited , 0 -unlimited
                );

                $this->session->set_userdata('logged_in', $sess_array);
            }
            return TRUE;
        } else {
            $this->form_validation->set_message('check_database', '<div class="alert alert-danger text-center">Invalid Username and Password!</div>');
            return false;
        }
    }
    
    
    
    
    
    
    
function customer_reg() {
	
	
if($this->input->post()):

$txtusertype = $this->input->post('txtusertype');
$Name = $this->input->post('Name');
$txtemail = $this->input->post('txtemail');
$txtpassword = $this->input->post('txtpassword');






$data = array(
                'fullName' => $Name,
                'userName' => $txtemail,
                'email' => $txtemail,
                'password' => md5($txtpassword),
                'userType' => $txtusertype,
);
$status = $this->trd->save_customer($data);
 if ($status) {
     $sess_array = array(
                        'trader_id' => $status,
                        'txtemail' => $txtemail,
                        'txtusertype' => 0,
    );

   $this->session->set_userdata('logged_in', $sess_array);
   redirect(base_url(),'location',301);
   
}
else{
	  $this->session->set_flashdata('errors', '<div class="alert alert-danger text-center">Please try again ...</div>');
	 
	  redirect(base_url().'customer_signup','location',301); 
}

else:
	redirect(base_url(),'location',301);
endif;


}   
    
    
function trader_reg(){
	
if($this->input->post()):


$country_code = $this->input->post('txt_countrycode');
$txtmob =$this->input->post('txtmob');
$txtuname = trim($this->input->post('txtuname'));
$txtpassword = trim($this->input->post('txtpassword'));
$data['fullName']  = trim($this->input->post('txtuname'));
$data['userName']  = $this->input->post('txtname');
$data['location']  = $this->input->post('txtplace');
$data['contactNumber']  =  $txtmob;
$data['email']      = $this->input->post('txtemail');
$data['password']   = md5($txtpassword);
$data['socialWeb']  = $this->input->post('txtweblink');
$data['socialFb']   = $this->input->post('txtfblink');
$data['socialInsta']= $this->input->post('txtinstlink');
$data['socialSnap'] = $this->input->post('txtsnapclink');
$data['socialTwitter']  = $this->input->post('txttwitter');
$data['traderInfo'] = $this->input->post('txtabout');	
$data['usertype'] = 1;


$status = $this->trd->save_trader($data ,$_FILES);

if($status){
	
	$result = $this->trd->get_trader($data['userName'], $txtpassword, 1);
	if ($result->num_rows()>0) {
                $sess_array = array();
                foreach ($result->result() as $row) {

                    $sess_array = array(
                        'trader_id' => $row->traderId,
                        'txtemail' => $row->email,
                        'txtusername' => $row->	userName,
                        'txtusertype' => $row->userType,
                    );

                    $this->session->set_userdata('logged_in', $sess_array);
                }
                 
                 

            }
	
			$this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-success text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Please select the payment method.</div></div></div>');
           redirect(base_url().'plans','location',301);
}
else{
	
	 $this->session->set_flashdata('errors', '<div class="alert alert-danger text-center">Please try again ...</div>');
	 
	redirect(base_url().'trader_signup','location',301);
	
}
	
else:
	redirect(base_url(),'location',301);
endif;
	
}
    
    

	
}
