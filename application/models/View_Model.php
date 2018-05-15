<?php

class View_Model extends CI_Model {
	
	
    function check_order_exist($chk_uid) {
        $qry = $this->db->query('select * from orderitem where orderUserId=' . $chk_uid . ' and status=0');
        return $qry->result();
    }

    function cartCount() {
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $this->db->where('userId', $trader_id);
        $this->db->where('productId !=', 0);
        $this->db->select('count(*) as cartlistCount');
        $cart_qry = $this->db->get('cartlist');
        $result = $cart_qry->row();
        return $result->cartlistCount;
    }
    function watchCount() {
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $this->db->where('userId', $trader_id);
        $this->db->where('productId !=', 0);
        $this->db->select('count(*) as watchlistCount');
        $watch_qry = $this->db->get('watchlist');
        $result = $watch_qry->row();
        return $result->watchlistCount;
    }

    function getAvr($id) {
        $this->db->select('image');
        $this->db->from('trader');
        $this->db->where('traderID', $id);
        $query = $this->db->get();
        $result = $query->row();
        return $result->image;
    }	
	
	function getUser($user_id) {
        $this->db->select('*');
        $this->db->from('trader');
        $this->db->where('TraderID', $user_id);
        $this->db->limit(1);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }
    
    function get_traders_list($userType='') {
        $this->db->order_by('product.submittedOn', 'DESC');
        $this->db->select('fullName ,image,trader.location,postCount,product.traderId as traderID,product.status,product.submittedOn,
        planId as planID');
        $this->db->from('trader');
        $this->db->join('product','trader.traderId=product.traderId');
        $this->db->group_by("trader.traderId");
        $this->db->limit('5');
        if(!empty($userType)){
            $this->db->where('usertype >='.$userType.' AND product.status>0');
        }
        $query = $this->db->get();
        return $query->result();
    }
	
	function get_parent_category($limit=NULL,$offset=NULL){
		
		if(isset($limit)&&isset($offset))
		$this->db->limit($limit, $offset);
		
		$this->db->select('Name,CategoryId,NameAr');
		$this->db->where('parentCategory','');
		$this->db->order_by('CategoryId','asc');
		$cat_qry = $this->db->get('category');
		
		return $cat_qry;
		
	}
	
	function get_single_category_by_id($data){
		
		
		$this->db->where('CategoryId',$data);
		$cat_qry = $this->db->get('category');
		return $cat_qry->row();
	}
	
	
	function get_all_trader_types() {
       
        $this->db->select('*');
        $this->db->from('trader');
        $this->db->where('userType', '3');
        $query = $this->db->get();
        $adqry = $query->result();
        
        $this->db->select('*,product.submittedOn');
        $this->db->from('trader');
        $this->db->order_by('product.submittedOn', 'DESC');
        $this->db->join('product','trader.traderId=product.traderId');
        $this->db->where(array('userType'=>'1','isActive'=>1));
        $this->db->limit('4');
        $this->db->group_by("trader.traderId");
        $query = $this->db->get();
        $trqry = $query->result();
         return array(
            'adqry' => $adqry,
            'trqry' => $trqry,
        );
        
         /*
        $this->db->order_by('traderRegistrationDate', 'DESC');
        $this->db->select('*');
        $this->db->from('trader');
        $this->db->where('usertype', '3');
        $this->db->or_where('usertype', '1');
        $this->db->limit('5');
        $query = $this->db->get();
        return $query->result();*/
    }
    
    function latest_post() {
    	
    	$this->db->join('trader','trader.traderId=product.traderId')
    	->select('product.status,product.productId,product.traderId,product.productCategoryId,product.subCategory1Id,product.subCategory2Id,,product.subCategory3Id,product.description,product.callForPrice,product.submittedOn,product.mainImage,trader.fullName,trader.location,category.Name,product.price,trader.image,trader.userType,product.productTitle,product.productTitleAr')
    	->join('category','category.CategoryId=product.productCategoryId')
    	->where('product.status','0')
    	->where('product.postStatusDetail =', 1)
    	->order_by('product.productId','desc')->limit(8)
    	->from('product');
    	$query =$this->db->get();
    	
    	return $query;
    }
	function product_media(){
				
		$this->db->join('productmedia','productmedia.productId=product.productId')
    	->order_by('product.productId','desc')->limit(8)
    	->where('productmedia.productVideo !=','')
    	->where('product.status','0')
    	->group_by('product.productId')
    	->order_by('productmedia.productSubmitDate','desc')
    	->where('product.postStatusDetail =', 1)
    	->limit(6)
    	->from('product');
    	$query =$this->db->get();
    	
    	return $query;
		
		
	}
	
	 public function count_all_traders() {
        return $this->db->count_all("trader");
    }
    
    function all_traders_by_limit($limit=NULL, $offset=NULL) {
        $this->db->select('*');
        $this->db->from('trader');
        
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        
        if($trader_id!=NULL or $trader_id!="" )
         $this->db->where('traderId!=', $trader_id);
        
        
        $this->db->where('userType>', '0');
        $this->db->order_by('fullName', 'asc');
        if(isset($limit)&&isset($offset))$this->db->limit($limit, $offset);
        
        $qry = $this->db->get();
        
       
        return array(
            'records' => $qry->result(),
            'count' => $qry->num_rows(),
        );
    }
    
    function get_trader_info($trader_id) {
    	
        $this->db->select('traderId,fullName,image,contactNumber,traderInfo,location,socialWeb,socialFb,socialInsta,socialSnap,socialTwitter,isActive,email');
        $this->db->from('trader');
        $this->db->where('traderId', $trader_id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
    }
    
    function count_all_trader_products($trader_id){
		 $this->db->where('traderId', $trader_id);
		 return $this->db->count_all("product");
	}
	
	function all_trader_products_by_limit($trader_id,$limit=NULL, $offset=NULL){
		
		
		if(isset($limit)&&isset($offset))
    	$this->db->limit($limit, $offset);
		$this->db
		->where('product.traderId',$trader_id)
    	->order_by('product.submittedOn','desc')
    	->join('trader','trader.traderId=product.traderId')
    	->select('product.status,product.productId,product.traderId,product.productCategoryId,product.subCategory1Id,product.subCategory2Id,,product.subCategory3Id,product.description,product.callForPrice,product.submittedOn,product.mainImage,trader.fullName,trader.location,category.Name,product.price,trader.image,product.viewCount,trader.userType')
    	->join('category','category.CategoryId=product.productCategoryId')
    	->order_by('product.productId','desc')->limit(8)
    	->from('product');
		
		$qry = $this->db->get();
        
       
        return array(
            'records' => $qry->result(),
            'count' => $qry->num_rows(),
        );
		
		
		
	}
	function get_TraderName($trader) {
        $this->db->select('fullName');
        $this->db->from('trader');
        $this->db->where('traderId', $trader);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $result = $query->result();
            foreach ($result as $row) {
                return $row->fullName;
            }
        } else {
            return false;
        }
    }
    
    function get_email($trader) {
        $this->db->select('email');
        $this->db->from('trader');
        $this->db->where('traderId', $trader);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $result = $query->result();
            foreach ($result as $row) {
                return $row->email;
            }
        } else {
            return false;
        }
    }
    
        public function formataed($input,$CallPrice=NULL) {
        $val = "";
        if ($input > 0) {
            //CUSTOM FUNCTION TO GENERATE ##,##,###.##
            $dec = "";
            $pos = strpos($input, ".");
            if ($pos === false) {
                //no decimals   
            } else {
                //decimals
                $dec = substr(round(substr($input, $pos), 2), 1);
                $input = substr($input, 0, $pos);
            }
            $num = substr($input, -3); //get the last 3 digits
            $input = substr($input, 0, -3); //omit the last 3 digits already stored in $num
            while (strlen($input) > 0) { //loop the process - further get digits 2 by 2
                $num = substr($input, -2) . "," . $num;
                $input = substr($input, 0, -2);
            }
            $val = 'AED ' . $num . $dec;
        } elseif($CallPrice==1) {
            $val = 'Call for Price';
        }else{
            $val = 'AED ' . $input;
        }
        echo ($val);
    }
    
     function product_details($product_id) {
     	
     	$this->db->select('product.callForPrice,product.submittedOn,product.mainImage,category.Name,product.price,product.productTitle,product.productTitleAr');
        $this->db->where('productId', $product_id);
        $this->db->join('category','category.CategoryId=product.productCategoryId');
        $qry = $this->db->get('product');
        return $qry->row();
    }
    
    function update_view_cnt($product_id, $cat_id) {
    	
    	
    	$this->db->where('productId',$product_id);
    	//->where('productCategoryId',$cat_id);
        $qry = $this->db->get('product');
        $myres = $qry->row();
        
       
        $up_date = date('Y-m-d h:i:sa');
        $prev_cnt = $myres->viewCount;
        $updated_cnt = $prev_cnt + 1;
        $data['viewCount'] = $updated_cnt;
        $data['lastViewed'] = $up_date;
        $this->db->where('productId', $product_id);
        //$this->db->where('productCategoryId', $cat_id);
        $this->db->update('product', $data);
    }
    
    function getImage($product_id, $cat_id) {

        
        $this->db->select('mainImage as image');
        $this->db->from('product');
        //$this->db->where('productCategoryId', $cat_id);
        $this->db->where('productId', $product_id);
        $this->db->limit(1);
        $query = $this->db->get();
       
		if(count($query->row())){
            return $query->row()->image ;
		 }
    }
    
    function getproduct($product_id, $cat_id='') {
        
        $this->db->where('productId', $product_id)->select('product.status,product.productId,product.traderId,product.productCategoryId,product.subCategory1Id,product.subCategory2Id,,product.subCategory3Id,product.description,product.callForPrice,product.submittedOn,product.mainImage,trader.fullName,trader.location,category.Name,product.price,trader.image,product.viewCount,trader.userType,product.productTitle,product.productTitleAr,trader.contactNumber');
         $this->db->join('trader','product.traderId=trader.traderId');
        $this->db->join('category','category.CategoryId=product.productCategoryId');
        $qry = $this->db->get('product');
        return $qry->row();
    	
    }
    
     public function record_count($param1) {
     	$this->db->where('productCategoryId',$param1);
        return $this->db->get('product')->num_rows();
    }

    function get_product_listings($category_id,$limit=NULL, $offset=NULL){
		
		if(isset($limit)&&isset($offset))
    	$this->db->limit($limit, $offset);
		$this->db
		->where('product.productCategoryId',$category_id)
    	->order_by('product.submittedOn','desc')
    	->join('trader','trader.traderId=product.traderId')
    	->select('product.status,product.productId,product.traderId,product.productCategoryId,product.subCategory1Id,product.subCategory2Id,,product.subCategory3Id,product.description,product.callForPrice,product.submittedOn,product.mainImage,trader.fullName,trader.location,category.Name,product.price,trader.image,product.viewCount,trader.userType,product.productTitle,product.productTitleAr')
    	->join('category','category.CategoryId=product.productCategoryId')
    	->where('product.postStatusDetail =', 1)
    	->where('product.status !=', 3)
    	->from('product');
		$qry = $this->db->get();
		if($qry)
		return $qry->result();
		
		else return false;
		
	}
	
	function most_view(){
		
		
		$this->db
		->limit(8)
    	->order_by('product.viewCount','desc')
    	->join('trader','trader.traderId=product.traderId')
    	->select('product.status,product.productId,product.traderId,product.productCategoryId,product.subCategory1Id,product.subCategory2Id,,product.subCategory3Id,product.description,product.callForPrice,product.submittedOn,product.mainImage,trader.fullName,trader.location,category.Name,product.price,trader.image,product.viewCount,trader.userType,product.productTitle,product.productTitleAr')
    	->join('category','category.CategoryId=product.productCategoryId')
    	->where('product.status !=', 3)
    	->where('product.postStatusDetail =', 1)
    	->from('product');
		
		$qry = $this->db->get(); 
		
		if($qry)
		return $qry->result();
		
		else return false;
	}
	
	function recent_view(){
		
		
		$this->db
		->limit(8)
    	->order_by('product.lastViewed','desc')
    	->join('trader','trader.traderId=product.traderId')
    	->select('product.status,product.productId,product.traderId,product.productCategoryId,product.subCategory1Id,product.subCategory2Id,,product.subCategory3Id,product.description,product.callForPrice,product.submittedOn,product.mainImage,trader.fullName,trader.location,category.Name,product.price,trader.image,product.viewCount,trader.userType,product.productTitle,product.productTitleAr')
    	->join('category','category.CategoryId=product.productCategoryId')
    	->where('product.status !=', 3)
    	->from('product');
		
		$qry = $this->db->get();
		if($qry)
		return $qry->result();
		
		else return false;
	}
	
	function fetch_prop_imgs($productid='',$cat_id=''){
		
		
		$this->db->where('productmedia.productId',$productid)
		->select('productId,productImage,productVideo,videoViewCount')
		->from('productmedia');
		
		$qry = $this->db->get();
		return $qry->result();
		
	}
	
	
	function getTitle($product_id){
		
		
        $this->db->where('productId', $product_id)->select('productTitle,productTitleAr')
        ->from('product');
        $qry = $this->db->get();
		return $qry->row();
	}
	
	function get_user_details($traderID) {
      
        $this->db->select('*');
        $this->db->from('trader');
        $this->db->where('traderId', $traderID);
    
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    
    
    function get_search($category='',$keyword='',$params=array()){
    	
	  if (is_numeric($category)) {
          $this->db->where('category.CategoryId',$category);
      } elseif($category!='all') {
        $this->db->where('category.category_name',$category);
      }
      $start = 0;
      
     
        
        $this->db->select('*');
        $this->db->from('product')->select('product.status,product.productId,product.traderId,product.productCategoryId,product.subCategory1Id,product.subCategory2Id,,product.subCategory3Id,product.description,product.callForPrice,product.submittedOn,product.mainImage,trader.fullName,trader.location,category.Name,product.price,trader.image,product.viewCount,trader.userType,product.productTitle,product.productTitleAr');
        $this->db->join('trader', 'product.traderId = trader.traderId');
        $this->db->join('category', 'product.productCategoryId = category.CategoryId');
     //   $this->db->where('AvailablitiyStatus>',-1); // Un comment to hide removed posts
         if (!empty($keyword)){
          $this->db->group_start();
          $this->db->like('category.CategoryId', $keyword, 'both'); 
          $this->db->or_like('product.productTitle', $keyword, 'both')->group_end();
        } 
        
         if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
              $this->db->limit($params['limit'],$params['start']);
          }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
              $this->db->limit($params['limit']);
          }
          $this->db->order_by('submittedOn', 'DESC');
         
          //echo $this->db->get_compiled_select();
              $query =  $this->db->get();
             
          
          return ($query->num_rows() > 0)?$query->result_array():FALSE;
		
		
		
	}
    
	
}		