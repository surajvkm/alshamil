<?php
/*
@project 				: Alshamil
@project Module 		: Signup 
@developrt				: Arun Vasanth Samraj 
@lastmodification date	: 12-05-2018
@controller 			: SignIn

*/


defined('BASEPATH') OR exit('No direct script access allowed');

class Signin extends CI_Controller {



	public function __construct(){
                parent::__construct();
                 $this->load->database();
               
     }


	public function index()
	{
		
		
		$page_data['title'] = 'Alshamil - SignIn';
        $page_data['page']  = 'signin'; 
		$this->load->view('client/index',$page_data);
		
	}
	
	
	
}
