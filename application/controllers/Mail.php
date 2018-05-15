<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
@project 				: Alshamil
@project Module 		: Mail  
@developrt				: Arun Vasanth Samraj 
@lastmodification date	: 4-05-2018
@controller 			: Mail 
*/

class Mail extends Public_Controller {
    function __construct() {
        parent::__construct();
        $this->load->Model('Utils_Model' ,'util'); 
        $this->load->database();     
}

function mail_trader() {
	
$trader_id = $this->uri->segment(2);
$session_data = $this->session->userdata('logged_in');
$trader = $session_data['trader_id'];
$data['frommail'] = $this->View_Model->get_email($trader);
$data['fromname'] = $this->View_Model->get_TraderName($trader);
$data['tomail'] =   $this->View_Model->get_email($trader_id);
$data['subject'] =  $this->input->post('subject');
$data['message'] =  $this->input->post('message');
$status = $this->util->sendmail($data);
$response = [];
if ($status) { 
$response =array('msg'=>'Your Mail has been Sent Successfully!','success'=>true);
   
} else 
{

$response =array('msg'=>'','success'=>false);

}

echo json_encode($response); exit;

}

    

    
 
}