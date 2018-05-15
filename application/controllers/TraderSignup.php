<?php
/*
@project 				: Alshamil
@project Module 		: Signup 
@developrt				: Arun Vasanth Samraj 
@lastmodification date	: 15-05-2018
@controller 			: Trader Signup

*/
defined('BASEPATH') OR exit('No direct script access allowed');

class TraderSignup extends CI_Controller {
	
	public function __construct(){
                parent::__construct();    
                $this->load->database();   
     }

	public function index()
	{
        $page_data['title'] = 'Alshamil - Create an Trader Account';
        $page_data['page']  = 'trader_signup'; 
		$this->load->view('client/index',$page_data);
	}
	
	
	
	
}
