<?php

class Trader_Model extends CI_Model {
	
	function get_trader($txtemail, $txtpassword, $txtusertype) {
        $md_password = md5($txtpassword);
        $this->db->select('*');
        $this->db->from('trader');
        if($txtusertype==0)
        $this->db->where('email', $txtemail);
        else $this->db->where('userName', $txtemail);
        
       
        $this->db->where('password', $md_password);
        $this->db->where('userType', $txtusertype);
      //  $this->db->where('isActive', 1);
        $this->db->limit(1);
        $query = $this->db->get();
        
       
        if ($query->num_rows() == 1) {
            return $query;
        } else {
            return false;
        }
    }
    
    
    function save_customer($data){
		
		 if ($this->db->insert('trader', $data)){
		 	return $this->db->insert_id();
		 }else{
		 	return false;
		 }
		
		
		
	}
	
	
	function save_trader($data , $FILES){
		
		$this->load->Model('Utils_Model','utils');
		
		if (isset($_FILES['profimg']['name'])) {
			
            $config['upload_path'] = 'uploads/trader_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['profimg']['name'];
            
            $data['image'] = base_url() . 'uploads/trader_images/' .$this->utils->imageUpload($config,'profimg');
           
        }

        if (isset($_FILES['traderIDProof']['name'])) {
            $config['upload_path'] = 'uploads/trader_emirates_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['traderIDProof']['name'];
            $data['idProof'] = base_url() . 'uploads/trader_emirates_images/' .$this->utils->imageUpload($config,'traderIDProof');
        }
        if (isset($_FILES['traderIDsecond']['name'])) {
            $config['upload_path'] = 'uploads/trader_emirates_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['traderIDsecond']['name'];
            $data['idProof2'] = base_url() . 'uploads/trader_emirates_images/' .$this->utils->imageUpload($config,'traderIDsecond');
        }
		
		
		
		if ($this->db->insert('trader', $data)) {
			return $this->db->insert_id();
		}else {
            return false;
        }
			
		
		
	}
	public function fetch_plans(){
        $this->db->select('*');
        $this->db->from('subscriptionplan');
        $this->db->order_by('planId');
        $qry = $this->db->get();
        return $qry;
    }
    
    function update_payment_option($data , $plan_postcnt){
	$this->db->set('planPostCount', "planPostCount + ".$plan_postcnt, FALSE);
    $this->db->where('traderId', $data['traderID']);
    if($this->db->update('tradersubscription', $data)){
		
		return true;
	}else{
		return false;
	}
		
	}
	function save_payment_option($data){
		
		 if ($this->db->insert('tradersubscription', $data)){
		 	return $this->db->insert_id();
		 }else{
		 	return false;
		 }
		
	}
	
	
	    function check_trader_addpost() {
        $session_data = $this->session->userdata('logged_in');
        if($session_data['txtusertype']==1){
            $user_id = $session_data['trader_id'];
            $query = $this->trader_paymentdetails($user_id);
            if (!empty($query)) {
                $plan_id = $query[0]->planId;
                $payment_chosen = (int) $query[0]->paymentTypeChosen;
                $payment_status = $query[0]->planStatus;
                if($query[0]->isActive==1){
                	
                    if ($payment_chosen > 0) {
                    
                        if ($payment_status == 0) {
                            $status = 3;
                        } elseif ($payment_status == 1) {
                        	
                        	
                            
                            if($query[0]->planId==4){
                                //echo $query[0]->traderPostCount;
                                // echo count($posts);
                            $query[0]->totalposted=$query[0]->traderPostCount;
                            $datediff=$query[0]->planPostCount-$query[0]->totalposted;
                            $status = ($datediff>0) ? 0: 6;
                            }else if($query[0]->planId==3){
                                $query[0]->totalposted=$query[0]->traderPostCount;
                                $postdiff=$query[0]->planPostCount-$query[0]->totalposted;
                                $now = time(); // or your date as well
                            $till_date = strtotime($query[0]->planValidity);
                            $datediff = floor(($till_date -$now)/(60 * 60 * 24));
                            $status = ($datediff<0||$postdiff<0) ?6 : 0;
                            }else{
                            $now = time(); // or your date as well
                            $till_date = strtotime($query[0]->planValidity);
                            $datediff = floor(($till_date -$now)/(60 * 60 * 24));
                            $status = ($datediff>0) ?0 : 6;
                            }
                            
                        } else {
                            $status = 4;
                        }
                    } else {
                        $status = 2;
                    }
                }
                else{
                    $status = 3;
                } 
    
           



            } else {
    
                $status = 1;
            }
        }else{
            $status = 5;
        }
      
        return $status;
    }
    
    function trader_paymentdetails($trader_id) {
        $this->db->select('tradersubscription.planId,planStatus,paymentTypeChosen,subscriptionplan.name,subscriptionplan.amount,tradersubscription.planPostCount,tradersubscription.planValidity,subscriptionplan.PostCount as TotalPost,isActive , trader.postCount as traderPostCount');
        $this->db->from('tradersubscription');
        $this->db->where('tradersubscription.traderId', $trader_id);
        $this->db->join('subscriptionplan', 'subscriptionplan.planId = tradersubscription.planId');
        $this->db->join('trader', 'trader.traderId = tradersubscription.traderId');
        $query = $this->db->get();
         //echo $this->db->last_query();
        return $query->result();
    }
    
    
    
    
    function desc_flag_insert($data){
		
		
		$status=false;
		$this->db->insert('flaggeditem', $data);
		$id= $this->db->insert_id();
		if($id){
			
			$status = $this->descr_view_cnt($data['productId'], $data['productCategoryId']);
			
		}
		
		
		
		return $status;
            
		
	}
    
    
    function descr_view_cnt($product_id, $cat_id) {
    	
        $qry = $this->db->query('select viewCount from product where productId=' . $product_id . ' and productCategoryId=' . $cat_id);
        $myres = $qry->result();

        $prev_cnt = $myres[0]->viewCount;
        $updated_cnt = $prev_cnt - 1;
        $data['viewCount'] = $updated_cnt;
        $this->db->where('productId', $product_id);
        $this->db->where('productCategoryId', $cat_id);
        if($this->db->update('product', $data)){
			return true;
		}
		else{
			return false;
		}
    }
    
     function prd_exit_watch($post_id) {
        $session_data = $this->session->userdata('logged_in');
        $add_user_id = $session_data['trader_id'];
        $this->db->where('productId', $post_id);
        $this->db->where('userId', $add_user_id);
        $qry = $this->db->get('watchlist');
        return $qry->num_rows();
    }
    
    
    function prod_addto_watchlist($product_id, $category_id, $userid) {
        $qry = $this->db->query('select count(*) as watch_cnt from watchlist');
        return $qry;
		
    }
    
    function watchlist_add_prdt($product_id, $category_id, $traderid) {
        
        $watch_cnt = 1;
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];

        $data = array('traderId' => $traderid, 'productCategoryId' => $category_id, 'productId' => $product_id, 'watchlistCount' => $watch_cnt, 'productAvailability' => 0, 'userId' => $trader_id);
        $this->db->insert('watchlist', $data);
        
        
    }
    
    function watch_cnt() {
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $this->db->where('userId', $trader_id);
        $this->db->where('productId !=', 0);
        $this->db->select('sum(watchlistCount) as watchlistCount');
        $watch_qry = $this->db->get('watchlist');
        return $watch_qry->result();
    }
    function watch_details() {
        $session_data = $this->session->userdata('logged_in');

        $trader_id = $session_data['trader_id'];
        $this->db
		->where('watchlist.userId',$trader_id)
    	->order_by('product.submittedOn','desc')
    	->select('product.status,product.productId,product.traderId,product.productCategoryId,product.subCategory1Id,product.subCategory2Id,,product.subCategory3Id,product.description,product.callForPrice,product.submittedOn,product.mainImage,trader.fullName,trader.location,category.Name,product.price,trader.image,product.viewCount,trader.userType,watchlist.watchlistId,,product.productTitle,product.productTitleAr')
    	->join('product','product.productId=watchlist.productId')
    	->join('trader','trader.traderId=product.traderId')
    	->join('category','category.CategoryId=product.productCategoryId')
    	->order_by('watchlist.productId','desc')
    	->from('watchlist');
		
		$qry = $this->db->get();
        
        
        return $qry->result();
     }
     
     function remove_watchlist($watchlistID) {
     	$this->db->where('watchlistId',$watchlistID);
     	
      
        return $this->db->delete('watchlist');
    }
     
     
    
    function prd_exit_cart($post_id) {
        $session_data = $this->session->userdata('logged_in');
        $add_user_id = $session_data['trader_id'];
        $this->db->where('productId', $post_id);
        $this->db->where('userId', $add_user_id);
        $qry = $this->db->get('cartlist');
        return $qry->result();
    }
    function prod_addto_cart($product_id , $category_id ) {
        $cartcnt = 1;
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $prod_avail = 0;

        $data = array('userId' => $trader_id, 'productId' => $product_id, 'cartlistCount' => $cartcnt, 'productAvailability' => $prod_avail);
        $this->db->insert('cartlist', $data);
    }
    
    function del_prd_cart($prod_id, $cat_id, $userid) {
        $qry = $this->db->query('select orderId  from cartlist where userId=' . $userid);
        $res = $qry->num_rows();
        if ($res >0) {
            $this->db->where('orderId', $qry->row()->orderId);
            $this->db->where('orderUserId', $userid);
            $qry = $this->db->delete('orderitem');
        }
        
        $this->db->where('userId', $userid);
        $this->db->where('productId', $prod_id);
        $qry = $this->db->delete('cartlist');
    }
    
    function cart_details() {
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        
        
        $this->db
		->where('cartlist.userId',$trader_id)
    	->order_by('product.submittedOn','desc')
    	->select('product.status,product.productId,product.traderId,product.productCategoryId,product.subCategory1Id,product.subCategory2Id,,product.subCategory3Id,product.description,product.callForPrice,product.submittedOn,product.mainImage,trader.fullName,trader.location,category.Name,product.price,trader.image,product.viewCount,trader.userType,cartlist.cartListId,product.productTitle,product.productTitleAr')
    	//->where('product.status',0)
    	->join('product','product.productId=cartlist.productId')
    	->join('trader','trader.traderId=product.traderId')
    	->join('category','category.CategoryId=product.productCategoryId')
    	->order_by('cartlist.productId','desc')
    	->from('cartlist');
		
		$qry = $this->db->get();
        
        
        return $qry->result();
        
        
        
        
        
       }
       
       function check_product_availablity($chk_uid){
	   	
	   	$status = true;
	   	$this->db->select('status')->where('userId',$chk_uid)->join('product','product.productId=cartlist.productId')
	   	->from('cartlist');
	   	$qury = $this->db->get();
	   	$datam =array();
	   	
	   	if($qury->num_rows()>0){
			foreach ($qury->result_array() as $row){
				
				$datam[]=$row['status'];

			}
			
		}
		if (in_array("2",$datam)) {
				
				
   				 $status =false;
		}
	   	
	   	return $status;
	   }
       
       function  fetch_prod_traddet($product_id) {
        $this->db->select('trader.fullName,trader.email,trader.contactNumber');
        $this->db->from('trader');
        $this->db->join('product', 'product.traderId=trader.traderId');
        $this->db->where('product.productId', $product_id);
        $qry = $this->db->get();
        return $qry->result();
      }
      
      function check_order_exist($chk_uid) {
        $qry = $this->db->query('select * from orderitem where orderUserId=' . $chk_uid . ' and status=0');
        return $qry->result();
      }
      
      function checkout_status($order_id) {
      	
        $this->db->where('orderId', $order_id);
        $cartinfo = $this->db->get('cartlist')->row();
        $data['productId'] = $cartinfo->productId;
        $data['status'] = 1;
        $this->db->where('orderId', $order_id);
        $this->db->update('orderitem', $data);
        
        $datac['status'] = 0;
        $this->db->where('productId',$data['productId']);
        $this->db->update('product', $datac);
        $this->db->where('orderId', $order_id);
        $this->db->delete('cartlist');
    }
    
    function check_available_for_buy($productid=''){
		
		$this->db->select('type');
		$status = $this->db->get_where('product',array('productId'=>$productid))->row();
		if($status->type=='1'){
			return TRUE;
		}else{
			
			return false;
		}
		
	}
	function update_trader($data , $FILES){
		
		$this->load->Model('Utils_Model','utils');
		
		
		
		
		if (isset($_FILES['profimg']['name']) && $_FILES['profimg']['name']!='') {
			
            $config['upload_path'] = 'uploads/trader_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['profimg']['name'];
            
            $data['image'] = base_url() . 'uploads/trader_images/' .$this->utils->imageUpload($config,'profimg');
           
        }

        if (isset($_FILES['traderIDProof']['name']) && $_FILES['traderIDProof']['name']!='' ) {
            $config['upload_path'] = 'uploads/trader_emirates_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['traderIDProof']['name'];
            $data['idProof'] = base_url() . 'uploads/trader_emirates_images/' .$this->utils->imageUpload($config,'traderIDProof');
        }
        if (isset($_FILES['traderIDsecond']['name']) && $_FILES['traderIDsecond']['name']!='' ) {
            $config['upload_path'] = 'uploads/trader_emirates_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['traderIDsecond']['name'];
            $data['idProof2'] = base_url() . 'uploads/trader_emirates_images/' .$this->utils->imageUpload($config,'traderIDsecond');
        }
		
		
		
		if ($this->db->where('traderId',$data['traderId'])->update('trader', $data)) {
			return true;
		}else {
            return false;
        }
			
		
		
	}
	function count_fetch_appr_posts(){
		
		$session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $this->db->select('product.status,product.productId,product.traderId,product.productCategoryId,product.subCategory1Id,product.subCategory2Id,,product.subCategory3Id,product.description,product.callForPrice,product.submittedOn,product.mainImage,trader.fullName,trader.location,product.price,trader.image,product.viewCount,trader.userType');
        $this->db->where('product.traderId', $trader_id);
        $this->db->where('product.postStatusDetail=', 1);
        $this->db->join('trader', 'trader.traderId = product.traderId');
        $this->db->from('product');
        
        $query = $this->db->get();
       
       
        return $query->result();
        
        
        
        
	}
	
	function fetch_appr_posts($limit=NULL, $offset=NULL) {
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        
        
        if(isset($limit)&&isset($offset))
    	$this->db->limit($limit, $offset);
        $this->db->select('product.status,product.productId,product.traderId,product.productCategoryId,product.subCategory1Id,product.subCategory2Id,,product.subCategory3Id,product.description,product.callForPrice,product.submittedOn,product.mainImage,trader.fullName,trader.location,product.price,trader.image,product.viewCount,trader.userType,product.productTitle,product.productTitleAr,category.Name');
        $this->db->join('category','category.CategoryId=product.productCategoryId');
        $this->db->where('product.traderId', $trader_id);
        $this->db->where('product.postStatusDetail=', 1);
        $this->db->order_by('submittedOn','desc');
        $this->db->join('trader', 'trader.traderId = product.traderId');
        $this->db->from('product'); 

        $query = $this->db->get();
       
        return $query->result();
        
    }
    
    function  fetch_pend_posts() {
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $this->db->select('product.status,product.productId,product.traderId,product.productCategoryId,product.subCategory1Id,product.subCategory2Id,,product.subCategory3Id,product.description,product.callForPrice,product.submittedOn,product.mainImage,trader.fullName,trader.location,product.price,trader.image,product.viewCount,trader.userType,product.productTitle,product.productTitleAr,category.Name');
        $this->db->join('category','category.CategoryId=product.productCategoryId');
        $this->db->where('product.traderId', $trader_id);
        $this->db->where('product.postStatusDetail=', 0);
        $this->db->order_by('submittedOn','desc');
        $this->db->join('trader', 'trader.traderId = product.traderId');
        $this->db->from('product'); 
        
        $query = $this->db->get();
         //echo $this->db->last_query();
        return $query->result();
     }
     
     function calc_rem_postdays() {
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $qry = $this->db->query('select planValidity from tradersubscription where traderId=' . $trader_id);
        return $qry->result();
    }
    
    function calc_tot_amt() {
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
 
    $qry = $this->db->query("SELECT price from product where status=1 and TraderId={$trader_id}");
	$total=0;
	foreach($qry->result() as $row){
    $total=$total+$row->price;
	}
        return $total;
    }
    
     function fetch_rej_posts() {
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $this->db->select('product.status,product.productId,product.traderId,product.productCategoryId,product.subCategory1Id,product.subCategory2Id,,product.subCategory3Id,product.description,product.callForPrice,product.submittedOn,product.mainImage,trader.fullName,trader.location,product.price,trader.image,product.viewCount,trader.userType,product.rejectMessage,product.productTitle,product.productTitleAr,category.Name');
        $this->db->join('category','category.CategoryId=product.productCategoryId');
        $this->db->where('product.traderId', $trader_id);
        $this->db->where('product.postStatusDetail=', -1);
        $this->db->order_by('submittedOn','desc');
        $this->db->join('trader', 'trader.traderId = product.traderId');
        $this->db->from('product'); 
        $query = $this->db->get();
        

        return $query->result();
     }
     
     function notification_cnt() {
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $this->db->where('traderId', $trader_id);
        $this->db->where('readStatus', '0');
        $this->db->select('count(*) as total_entries');
        $notification1 = $this->db->get('flaggeditem');
        $notif1 = $notification1->result();

        $this->db->where('traderId', $trader_id);
        $this->db->where('readStatus', '0');
        $this->db->select('count(*) as total_entries');
        $notification2 = $this->db->get('tradernotification');
        $notif2 = $notification2->result();
        return array(
            'flagcnt' => $notif1,
            'notcnt' => $notif2,
        );
    }
    
    function wish_item_cnt() {
    	$session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $this->db->select('sum(watchlistCount) as traderWishCount');
        $this->db->where('userId', $trader_id);
        $wish_qry = $this->db->get('watchlist');
        return $wish_qry->row()->traderWishCount;
    }

    function cart_cnt() {
    	
    	$session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $this->db->select('sum(cartlistCount) as cartlistCount');
        $this->db->where('userId', $trader_id);
        $cart_qry = $this->db->get('cartlist');
        return $cart_qry->row()->cartlistCount;
    }
    
    function cnt_fetch_tr_solditems($trader_id) {
    	
    	
    	$this->db->select('product.status,product.productId,product.traderId,product.productCategoryId,product.subCategory1Id,product.subCategory2Id,,product.subCategory3Id,product.description,product.callForPrice,product.submittedOn,product.mainImage,trader.fullName,trader.location,product.price,trader.image,product.viewCount,trader.userType,product.productTitle,product.productTitleAr,category.Name');
        $this->db->where('product.traderId', $trader_id);
        $this->db->where('product.status=', 1);
        $this->db->join('category','category.CategoryId=product.productCategoryId');
        $this->db->order_by('submittedOn','desc');
        $this->db->join('trader', 'trader.traderId = product.traderId');
        $this->db->from('product'); 
        
        $query = $this->db->get();
        

        return $query->result();
    	
    }
    
    function cnt_fetch_tr_bookeditems($trader_id) {
    	
    	$this->db->select('product.status,product.productId,product.traderId,product.productCategoryId,product.subCategory1Id,product.subCategory2Id,,product.subCategory3Id,product.description,product.callForPrice,product.submittedOn,product.mainImage,trader.fullName,trader.location,product.price,trader.image,product.viewCount,trader.userType,product.productTitle,product.productTitleAr,category.Name');
        $this->db->where('product.traderId', $trader_id);
        $this->db->where('product.status=', 2);
        $this->db->join('category','category.CategoryId=product.productCategoryId');
        $this->db->order_by('submittedOn','desc');
        $this->db->join('trader', 'trader.traderId = product.traderId');
        $this->db->from('product'); 
        
        $query = $this->db->get();
        

        return $query->result();
    }
    
    function cnt_fetch_tr_totalpost($trader_id) {
    $qry = $this->db->query('SELECT count(*) as totlal_post_cnt FROM product where  traderId=' . $trader_id);
    return $qry->result();
   }
   
   function get_name($trader_id) {
        $this->db->select('traderId,fullName,image,location,socialWeb,socialTwitter,socialFb,socialInsta,socialSnap');
        $this->db->from('trader');
        $this->db->where('traderId', $trader_id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
    }
    
    function fetch_trader_editdata($trader_id) {
        $this->db->where('traderId', $trader_id);
        $qry = $this->db->get('trader');
        return $qry->result();
    }
    
    function change_product_status($status,$product_id){
		
		$this->db->where('productId',$product_id);
		return $this->db->update('product',$status);
		
		
		
	}
	
	function get_all_notification($where,$per_page_cnt,$offset){
        // $where_=array('vwNotificationsByUserNw.traderID' =>$where['traderID']);
        // $qry=$this->db->query("select count(*) as total from vwNotificationsByUserNw where {$where['traderID']}");
        // $this->db->select('vwNotificationsByUserNw.*,trader.traderImage,trader.traderLocation,trader.traderFullName,trader.traderValidTill');
        // $this->db->join('trader', 'trader.TraderID = vwNotificationsByUserNw.traderID');
        // $result=$this->db->get_where("vwNotificationsByUserNw",$where_,$offset,$per_page_cnt);
        // if(isset($qry->row()->total))$data['total']=$qry->row()->total;
        // $data['result']=$result->result();
        // return $data;
        $where_=array('tradernotification.traderId' =>$where['traderId']);
        $qry=$this->db->query("select count(*) as total from tradernotification where {$where['traderId']}");
        $this->db->select('tradernotification.*,trader.image,trader.location,trader.fullName,trader.expiresOn');
        $this->db->join('trader', 'trader.TraderId = tradernotification.traderId');
        $result=$this->db->get_where("tradernotification",$where_,$offset,$per_page_cnt);
        if(isset($qry->row()->total))$data['total']=$qry->row()->total;
        $data['result']=$result->result();
        return $data;

    }


      


}	