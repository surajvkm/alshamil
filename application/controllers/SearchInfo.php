<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
@project 				: Alshamil
@project Module 		: Trader Information  
@developrt				: Arun Vasanth Samraj 
@lastmodification date	: 15-05-2018
@controller 			: Traderinfo 
*/
class SearchInfo extends Public_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->Model('Utils_Model' ,'util'); 
        
}


function search(){
	
	
	$category = $this->input->get('category');
	$keyword  =   $this->input->get('keyword');
	$page_data['search'] = $this->View_Model->get_search($category,$keyword);
	
	    $page_data['title'] = 'Alshamil - Search Results '.ucwords($keyword);
        $page_data['page']  = 'search'; 
		$this->load->view('client/index',$page_data);
	
	
}

}