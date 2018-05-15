<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
@project 				: Alshamil
@project Module 		: Trader Information  
@developrt				: Arun Vasanth Samraj 
@lastmodification date	: 13-05-2018
@controller 			: Traderinfo 
*/
class Traderinfo extends Public_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->Model('Utils_Model' ,'util'); 
}

function viewInfo($trader_id = ''){
	
	
	
	    
        $config = array();

        if($trader_id!='') {
		
        $page_data['trader_id'] = $trader_id;
        $products= $this->View_Model->count_all_trader_products($page_data['trader_id']);
        $total_products = $products?$products:0;
        $url = base_url() . "traderinfo/".$trader_id;;
        $str_links = $this->util->paginate($url,$total_products);
        $page_data["links"] = explode('&nbsp;', $str_links);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $query = $this->View_Model->all_trader_products_by_limit($trader_id,18, $page);
        
        $page_data['qry'] = $this->View_Model->get_trader_info($trader_id);
        $page_data['records'] = $query['records'];
        $page_data['count'] = $query['count'];
        
        	
		}
        
        
		$page_data['title'] = 'Alshamil';
        $page_data['page']  = 'trader_info'; 
		$this->load->view('client/index',$page_data);
}



    
 
}