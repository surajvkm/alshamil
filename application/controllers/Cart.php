<?php
/*
@project 				: Alshamil
@project Module 		: CART 
@developrt				: Arun Vasanth Samraj 
@lastmodification date	: 15-05-2018
@controller 			: CART

*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Cart extends Public_Controller {
    function __construct() {
    	
        parent::__construct();
        $this->load->database();
        $this->load->Model('Trader_Model' ,'trd'); 
        is_logged_in();
    }
    public function watch_list() {
 
        
        $page_data['watch_qry'] = $this->trd->watch_cnt();
        $page_data['qry'] = $this->trd->watch_details();
        $page_data['title'] = 'Alshamil - Watch List ';
        $page_data['page']  = 'cart_watch_list'; 
		$this->load->view('client/index',$page_data);
		
		
    }
    public function view_cart() {
      
        
        $page_data['qry'] = $this->trd->cart_details();
        $page_data['cart_qry'] = count( $page_data['qry'] );
        $page_data['title'] = 'Alshamil - Cart ';
        $page_data['page']  = 'cart_view'; 
		$this->load->view('client/index',$page_data);
		
    }
    public function check_prd_watchexist() {
        $post_id = $this->input->post('post_id');
        $qry = $this->trd->prd_exit_watch($post_id);
        if ($qry) {
            echo "exist"; exit;
        } else {
            echo "does not exist"; exit;
        }
    }
    public function add_watch_list($product_id, $category_id, $traderid) {
    	
    	
    	//$data['qry'] = $this->trd->prod_addto_watchlist($product_id, $category_id, $traderid);
       // $qry_cnt = $data['qry'][0]->watch_cnt;
        $this->trd->watchlist_add_prdt($product_id, $category_id, $traderid);
        $this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-success text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Product has been added to Watch List Successfully</div></div></div>');
        
         redirect(base_url().'cart/watch_list','location',301);

       
    }
    public function remove_watch_list($watchlistID) {

        if($this->trd->remove_watchlist($watchlistID)){echo "success"; exit; }
        else { echo "error"; exit; }
      
    }
    public function check_prd_cartexist() {
        $post_id = $this->input->post('post_id');
        $status = $this->trd->check_available_for_buy($post_id);
        
        if($status){
			
		$qry = $this->trd->prd_exit_cart($post_id);
        
        if ($qry) {
            echo "exist"; exit;
        } else {
            echo "continue"; exit;
        }
        
        
        }else{
			
			$this->fetch_contact_trader_info($post_id);
			
			
		}
    }
    public function add_cart($category_id ,$product_id, $userid,$price) {
    	
    	//$status = $this->trd->check_available_for_buy();
    	
        $this->trd->prod_addto_cart($product_id, $category_id, $userid);
          $this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-success text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Product has been added to Cart Successfully</div></div></div>');
          
       redirect(base_url().'cart/view_cart','location',301);
       
    }
    public function del_cart() {
        $product_id =$this->input->post('product_id');
        $cat_id =$this->input->post('cat_id');
        $session_data = $this->session->userdata('logged_in');
        $userid = $session_data['trader_id'];
        $this->trd->del_prd_cart($product_id, $cat_id, $userid);
        echo "success"; exit;
        //$this->view_cart();
    }
    public function fetch_contact_trader() {
    	
        $cat_id = $this->input->post('category_id');
        $product_id = $this->input->post('product_id');
        $qry = $this->trd->fetch_prod_traddet($product_id);
        $page_data['qry'] =$qry;
        $this->load->view('client/contact_trader',$page_data);
        
        
    }
    public function fetch_contact_trader_info($product_id) {
    	
        
        $qry = $this->trd->fetch_prod_traddet($product_id);
        $page_data['qry'] =$qry;
        $this->load->view('client/contact_trader',$page_data);
        
        
    }
    public function view_checkout() {

        $qry = $this->trd->cart_details();
        $page_data['qry'] = $qry;
        $cnt = count($qry);
        $page_data['total_cnt'] = $cnt;
        $session_data = $this->session->userdata('logged_in');
        $chk_uid = $session_data['trader_id'];
		$page_data['avail'] = $this->trd->check_product_availablity($chk_uid); 
        $page_data['title'] = 'Alshamil - Check Out ';
        $page_data['page']  = 'checkout'; 
		$this->load->view('client/index',$page_data);
    }
    public function fetch_alshmail_loc() {
    	
    	$this->load->Model('Utils_Model' ,'utils');    
        $qry = $this->utils->get_office_loc();
        
         if($qry->num_rows()>0) {
			 echo "<p>You can pay at Alshamil Office<br>$qry->row()->address <br> $qry->row()->name <br>$qry->row()->contactNo </p><p><a href='#' target='_blank'>Get Directions on Google Maps</a></p> "; exit;
		}else{
			
			echo '';
			exit;
		}
        
    }
    public function add_order_items() {
      
            $date = date('Y-m-d h:i:sa');
            $fin_tot = $this->input->post('fin_tot');
            $vat = $this->input->post('final_vat');
            $tax = $this->input->post('final_tax');
            $session_data = $this->session->userdata('logged_in');
            $chk_uid = $session_data['trader_id'];
            $qry = $this->trd->check_order_exist($chk_uid);
            if (count($qry) == 0) {

                $data['ecoTax'] = $vat;
                $data['vatTax'] = $tax;
                $data['orderAmount'] = $fin_tot;
                $data['orderUserId'] = $chk_uid;
                $data['orderDate'] = $date;
                $data['paymentType'] = 0;
                $data['paymentProof'] = 0;
                $data['status'] = 0;
                $this->db->insert('orderitem', $data);
                $last_order_id = $this->db->insert_id();
                $updata['orderId'] = $last_order_id;
                $this->db->where('userId', $chk_uid);
                $this->db->update('cartlist', $updata);
                echo $last_order_id . "/" . $fin_tot . "/" . $chk_uid; exit;
            } else {
                $qry = $this->db->query('select orderId from orderitem where orderUserId=' . $chk_uid);
                $res = $qry->result();
                $order_id = $res[0]->orderId;
                $cart_updata['ecoTax'] = $tax;
                $cart_updata['vatTax'] = $vat;
                $cart_updata['orderAmount'] = $fin_tot;
                $this->db->where('orderUserId', $chk_uid);
                $this->db->update('orderitem', $cart_updata);

                $orderid_updata['orderId'] = $order_id;
                $this->db->where('userId', $chk_uid);
                $this->db->update('cartlist', $orderid_updata);
                echo $order_id . "/" . $fin_tot . "/" . $chk_uid; exit;
            }
        
    }
    public function change_payment_status() {
        $order_id = $this->input->post('order_id');
        $this->trd->checkout_status($order_id);
        echo "success";exit;
    }
    public function check_availablity(){
		$session_data = $this->session->userdata('logged_in');
        $chk_uid = $session_data['trader_id'];
		$qry = $this->trd->check_product_availablity($chk_uid);
		if($qry) {echo 'success'; exit;}
		else {echo 'fails'; exit;}
		
	}
   
   
   
   
}
