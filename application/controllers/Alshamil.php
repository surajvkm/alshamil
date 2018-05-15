<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
@project 				: Alshamil
@project Module 		: Home  
@developrt				: Arun Vasanth Samraj 
@lastmodification date	: 15-05-2018
@controller 			: Alshamil 
*/

class Alshamil extends Public_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
}    
function index(){
$query_trader_types = $this->View_Model->get_all_trader_types();
$page_data['admin'] = $query_trader_types['adqry'];
$page_data['trader'] = $query_trader_types['trqry'];
$page_data['media'] = $this->View_Model->product_media();
$page_data['latest'] = $this->View_Model->latest_post();
$page_data['title'] = 'Alshamil';
$page_data['page']  = 'home_page'; 
$this->load->view('client/index',$page_data);

}

function viewinfo($param1='', $param2 = ''){
	
        $cat_id = $this->uri->segment(3);
        $product = $this->uri->segment(2);
        $parts = explode('_', $product);
        $id='';
        if($parts[1]!==''){
			
		 $idc = $parts[1];
			
		 $product_id =	alphaID($idc,true,5);
			
		}
		$page_data['query'] = $this->View_Model->getproduct($product_id, $cat_id);
		if(count($page_data['query'])){

        $this->View_Model->update_view_cnt($product_id, $cat_id);
        $page_data['image'] = $this->View_Model->getImage($product_id, $cat_id);
      
        $page_data['product_id'] = $product_id;
        $page_data['cat_id'] = $cat_id;
        
        $page_data['img_qry'] = $this->View_Model->fetch_prop_imgs($product_id, $cat_id);
        $page_data['page']  = 'details_page'; 
        
        }else{
			
			$page_data['page']  = 'error_404'; 
		}
		
		
        $page_data['title'] = 'Alshamil';
		$this->load->view('client/index',$page_data);
}

function  viewlisting($offset = NULL){
	    
	    $this->load->Model('Utils_Model' ,'util'); 
	    $param1 = $this->uri->segment(1);
	    
	   
	    $param2 = $this->util->get_id_forname($param1);
	    $config["per_page"] = 5;
	    $config['uri_segment']=2;
	    
	    $count = $this->View_Model->record_count($param2);
	    $url = base_url() . $param1 ;
	    $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $str_links = $this->util->paginate($url,$count,$config["per_page"],$config['uri_segment']);
        $page_data["links"] = explode('&nbsp;', $str_links);
	    $page_data['title_header']  = $param1;
	    $page_data['qry']   = $this->View_Model->get_product_listings($param2,$config["per_page"],$page);
	    $page_data['count']  = $count;
	    $page_data['cat_id'] = $param2;
	    $page_data['title']  = 'Alshamil';
		$page_data['page']   = 'view_listings'; 
		$this->load->view('client/index',$page_data);
	
	
}




    
 
}