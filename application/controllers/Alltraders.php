<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
@project 				: Alshamil
@project Module 		: All Trader   
@developrt				: Arun Vasanth Samraj 
@lastmodification date	: 15-05-2018
@controller 			: Alltraders 
*/
class Alltraders extends Public_Controller {
    function __construct() {
        parent::__construct();
        $this->load->Model('Utils_Model' ,'util'); 
        $this->load->database();
        
}
function index(){
        $trader = $this->View_Model->count_all_traders();
        $total_traders = $trader?$trader:0;
        $url = base_url() . "alltraders";
        $str_links = $this->util->paginate($url,$total_traders);
        $page_data["links"] = explode('&nbsp;', $str_links);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $query = $this->View_Model->all_traders_by_limit(18, $page);
        $page_data['records'] = $query['records'];
        $page_data['count'] = $query['count'];
		$page_data['title'] = 'Alshamil';
        $page_data['page']  = 'all_traders'; 
		$this->load->view('client/index',$page_data);
}


    
 
}