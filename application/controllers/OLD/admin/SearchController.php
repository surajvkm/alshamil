<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
class SearchController extends Admin_Controller
{ 
  function __construct()
  {
    parent::__construct();
    $this->load->Model('Admin_mdl');
    $this->load->Model('Trader_mdl');
    $this->load->Model('Data_mdl');
    $this->load->library('Ajax_pagination');
    $this->perPage = 16;

  }

  function listAll(){
  	//total rows count
  		$category = $_REQUEST['category'];
      $keyword  = isset($_REQUEST['keyword'])?$_REQUEST['keyword']:'';
      $totalRec = count($this->Admin_mdl->getRowsProducts($category,$keyword));
        
        //pagination configuration
        $config['target']      = '#admin_home_div';
        $config['base_url']    = base_url().'admin/SearchController/ajaxPaginationData?category='.$category;
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;


        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $data['all_products'] = $this->Admin_mdl->getRowsProducts($category,$keyword,array('limit'=>$this->perPage));
     

  	    //$data['all_products']       = $this->Admin_mdl->listAllProducts($category,$keword);
        $data['category'] = $category;
        $counts = $this->sideBarCounts();
        $data['sidebar_count'] = $counts;
  	   $this->load->view('admin/productlist_vw',$data);
  	
  }
  
  function ajaxPaginationData(){
  	$category = $_GET['category'];
  	$page = $_GET['page'];
  	$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //total rows count
        $totalRec = count($this->Admin_mdl->getRowsProducts($category,$keyword=''));
        
        //pagination configuration
        $config['target']      = '#admin_home_div';
        $config['base_url']    = base_url().'admin/SearchController/ajaxPaginationData?category='.$category;
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;


        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $data['all_products'] = $this->Admin_mdl->getRowsProducts($category,$keyword='',array('start'=>$offset,'limit'=>$this->perPage));
        $this->load->view('admin/ajax_pagination_product', $data, false);
    }
        public function sideBarCounts() {
        $count['new_post'] = $this->Admin_mdl->new_posts();
        $count['new_reg'] = $this->Trader_mdl->new_registers();
        $count['yearly_plan_count'] = count($this->Admin_mdl->fetch_yearlywise());
        $count['monthly_plan_count'] = count($this->Admin_mdl->fetch_monthlywise());
        $count['yearly_limit_count'] = count($this->Admin_mdl->fetch_yrlylim());
        $count['iniv_limit_count'] = count($this->Admin_mdl->fetch_indivi());
        $count['watchlist'] = $this->Trader_mdl->total_watchlist();
        $count['flaged'] = $this->Trader_mdl->new_registers();
        $count['sold'] = $this->Trader_mdl->total_sold_count();
        $count['booked'] = $this->Trader_mdl->total_booked_count();
        $count['cart'] = $this->Trader_mdl->total_cart_count();
        return $count;
    }


}