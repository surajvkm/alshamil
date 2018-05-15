<?php

class Admin_Model extends CI_Model
{
   
  function __construct(){
    parent::__construct();
    $this->load->database();
    
  }
  function get_admin($txtemail, $txtpassword, $txtusertype, $deviceId=NULL) {
       $md_password = md5($txtpassword);
       $this->db->select('*');
       $this->db->from('trader');
       $where=array('email'=>$txtemail,'password'=>$md_password,'userType'=>$txtusertype);
       $this->db->where($where);
      
        $this->db->limit(1);
        //echo $this->db->get_compiled_select();
       $query = $this->db->get();
       if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
  
    function savepcategory($data){
			$this->db->insert('category',$data);
			return $this->db->insert_id();
	}
	
	 function savescategory($data){
  		$this->db->where('parentCategory',$data['parentCategory']);
  		$exist = $this->db->get('category');
  		
  		if($exist->num_rows()<3){
			$this->db->insert('category',$data);
			return $this->db->insert_id();
		}
		else{
			return false;
		}
	    
		
	}
	
	
  function updatepcategory($data){
		
		$this->db->where('CategoryId',$data['CategoryId']);
		if($this->db->update('category',$data)){
			
			return true;
			
		}else{
			
			return false;
		}
		
	}
  function get_parent_category(){
		
		
		$this->db->select('Name,CategoryId');
		$this->db->where('parentCategory','');
		$this->db->order_by('CategoryId','asc');
		$cat_qry = $this->db->get('category');
		
		return $cat_qry;
		
	}
  function deletepcategory($data){
		
		
		$this->db->where('CategoryId',$data['CategoryId']);
		if($this->db->delete('category')){

			return true;
			
		}else{
			
			return false;
		}
	}
  function get_sub_category($data){
		$this->db->select('Name,CategoryId,NameAr');
		$this->db->order_by('CategoryId','asc');
		$this->db->where('parentCategory',$data);
		$cat_qry = $this->db->get('category');
		return $cat_qry;	
	}
  function save_plan($data){
		
		
		$this->db->insert('subscriptionplan',$data);
		
		return $this->db->insert_id();
		
	}
  function get_subscription_plan(){
			
		$this->db->select('name,PlanId');
		$cat_qry = $this->db->get('subscriptionplan');
		return $cat_qry;
		
	}
  function delete_plans($data){
		
		$this->db->where('planId',$data['planId']);
		if($this->db->delete('subscriptionplan')){
			return true;
			
		}else{
			
			return false;
		}
		
	}
  function get_plan_by_id($data){
		$this->db->select('*');
		$this->db->where('planId',$data);
		$cat_qry = $this->db->get('subscriptionplan');
		return $cat_qry->row();
		
	}
  function update_plans($data){

		$this->db->where('planId',$data['planId']);
		$status =$this->db->update('subscriptionplan',$data);
		
		return $status;
	}
  
  function all_regs($plan_id){
      //  $this->db->select('*,count(*) as total');
        //$where = array('planStatus' => 0,'tradersubscription.paymentTypeChosen >'=>0);
       // $this->db->where($where);
        $this->db->where('tradersubscription.planId',$plan_id);
        $this->db->join('trader',"trader.traderId=tradersubscription.traderId");
        $this->db->where('trader.userType',1);
        $yearly_qry = $this->db->get('tradersubscription');
       
        return $yearly_qry;
  }
  
  function fetch_planusers($planid)
  {    

    $this->db->
     where('tradersubscription.planId',$planid)
      //->join('product','product.traderId = tradersubscription.traderId')
      ->join('trader','trader.traderId = tradersubscription.traderId')
        ->where('trader.userType','1')
      ->from('tradersubscription');
      $query =$this->db->get();
      return $query->result();
     
  
  
  }
  
  
    function get_plan_name($data){
		$this->db->select('name');
		$this->db->where('planId',$data);
		$cat_qry = $this->db->get('subscriptionplan');
		return $cat_qry->row();
		
	}
  
     function get_trader_row($trader_id)
    {
       
      $this->db->where('trader.traderId',$trader_id);
      $this->db->join('tradersubscription','tradersubscription.traderId=trader.traderId');
      $tr_qry=$this->db->get('trader');
      return $tr_qry->row();
     
    }
    
    function get_single_trader($trader_id)
    {
       $this->db->where('traderId',$trader_id);
       $trader_qry = $this->db->get('trader');
       return $trader_qry;
    }
    
    
    function approve_trader($trader_id,$plan_id)
    {
      
      $this->db->select('validity,postCount,planId');
      $plan = $this->db->get_where('subscriptionplan',array('planId'=>$plan_id))->row();
      $postcount = $plan->postCount;
      $validity = $plan->validity;
      
      if($validity=='-1')
      $data["planValidity"]=-1;
      else
      $data["planValidity"]=date('Y-m-d', strtotime("+$validity days"));
      
      
      if($postcount!=='-1')
      $this->db->set('planPostCount', "planPostCount+$postcount", FALSE);
      else
      $data["planPostCount"]=$postcount;
      $data['planStatus'] = 1;
      $this->db->where('traderId',$trader_id);
      
      $tatus = $this->db->update('tradersubscription',$data)?1:0;
      
      if($tatus){
	  	
	  	$datac['isActive'] =1;
	  	$datac['planId'] =$plan->planId;
	  	$this->db->where('traderId',$trader_id);
        return $this->db->update('trader',$datac)?1:0;
      
      }
      else{
	  	
	  	return false;
	  	
	  }
        
    }
    
    function reject_trader($trader_id)
    {
        $data['planStatus'] = -1;
        $this->db->where('traderId',$trader_id);
        $status = $this->db->update('tradersubscription',$data);
        
        
        $datac['isActive'] =0;
	  	$datac['planId']   =0;
	  	$this->db->where('traderId',$trader_id);
        return $this->db->update('trader',$datac)?1:0;
        
    }
 
  function fectch_plans(){
  	
  	    $this->db->select('planId,name');
  	    
  	    $sub_plans = $this->db->get('subscriptionplan');
        return $sub_plans;
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
	
function fetch_new_post(){
        
        $this->db->from('product');
        $this->db->join('trader','product.traderId=trader.traderId');
        $this->db->join('category','category.CategoryId=product.productCategoryId');
        $this->db->where('product.status=','0');
        $this->db->where('product.type=','0');
        $this->db->where('product.postStatusDetail=','0');
        $this->db->where('trader.userType !=','3');
        $this->db->order_by("productId", "desc");
        $qry=$this->db->get();
        return $qry->result();
  }
	
  function all_traders($limit=NULL, $offset=NULL) {
  	
        $this->db->select('trader.image,trader.traderId,trader.planId,trader.fullName,trader.location,tradersubscription.planStatus');
        $this->db->from('trader');
        
        if($this->session->userdata('admin_logged_in'))
        $this->db->where('trader.traderId!=', $this->session->userdata('admin_logged_in')['trader_id']);
        $this->db->where('trader.userType>', '0');
        $this->db->join('tradersubscription','tradersubscription.traderId = trader.traderId');
        $this->db->order_by('fullName', 'asc');
        if(isset($limit)&&isset($offset))$this->db->limit($limit, $offset);
        
        $qry = $this->db->get();
        $records = $qry->result();
       
        return array(
            'records' => $records,
            'count' => count($records),
        );
    }
	function get_data_for_drop_down($brand,$div) {
		
      $this->db->select('CategoryId,NameAr,Name');
      $this->db->from('category');
      $this->db->where('link', $brand);
      //$this->db->where('brand_id', $brand);
      $query = $this->db->get();
      $cities = array();
      $datam= array();  $datamc= array();
      $lab='';
      


      if ($query->result()) {
          foreach ($query->result() as $row) {
          	$cities[]=  array('id'=>$row->CategoryId,'name'=>$row->Name);
            
          }
          
          $datamc = array('labelName'=>strtolower($div),'record'=>$cities);
        
          
          return $datamc;
      } else {
          return FALSE;
      }
  }
  
  function get_data_drop_down($brand,$div) {
		
      $this->db->select('CategoryId,NameAr,Name');
      $this->db->from('category');
      $this->db->where('parentCategory', $brand);
      //$this->db->where('brand_id', $brand);
      $query = $this->db->get();
      $cities = array();
      $datam= array();  $datamc= array();
      $lab='';
      


      if ($query->result()) {
          foreach ($query->result() as $row) {
          	$cities[]=  array('id'=>$row->CategoryId,'name'=>$row->Name);
            
          }
          
          $datamc = array('labelName'=>strtolower($div),'record'=>$cities);
        
          
          return $datamc;
      } else {
          return FALSE;
      }
  }
  
  function get_rcv_categories($category_id = ''){
  	
 /* 	$query = $this->db->query('SELECT Name as name,parentCategory as type ,CategoryId as id ,labelName as lab FROM category WHERE parentCategory = '.$category_id.'
UNION SELECT Name as name,parentCategory as type , CategoryId as id ,labelName as lab FROM category WHERE parentCategory IN ( SELECT CategoryId FROM category WHERE parentCategory = '.$category_id.')',false);
*/

$query = $this->db->query("SELECT Distinct LOWER(labelName)  as lab , parentCategory as type  from (select * from category order by parentCategory) products_sorted, (select @pv := $category_id) initialisation where find_in_set(parentCategory, @pv) and length(@pv := concat(@pv, ',', CategoryId)) ORDER BY `products_sorted`.`parentCategory` ASC",false);


return $query->result();
 


  }
  function get_category_type($param1){
  	
  	$qry = $this->db->select('type')->where('CategoryId',$param1)->get('category');
  	
  	
  	return $qry->row();
  	
  }
  function  rcv_categories($category_id = ''){
  	
/*'SELECT distinct  Name as lab FROM category WHERE parentCategory = '.$category_id.'
UNION SELECT distinct  Name as lab FROM category WHERE parentCategory IN ( SELECT CategoryId FROM category WHERE parentCategory = '.$category_id.')'*/
  	 	$query = $this->db->query('SELECT distinct  Name as lab FROM category WHERE parentCategory = '.$category_id.' ORDER BY CategoryId asc ',false);

return $query->result();

  }
  
 

  
  function get_category_properties($category_id = ''){
  	
  	$this->db->select('categoryDetailId,name');
  	$query = $this->db->get_where('categorydetail',array('productCategoryId'=>$category_id));
  	return $query;
  }
  
  
   function get_templatesByType($type=0) {
        $template_qry = $this->db->query('select * from noplate_template where type='.$type);
        return $template_qry->result();
    }
    
     function get_templatesById($id=0) {
        $template_qry = $this->db->query('select * from noplate_template where noplateTempID='.$id);
        return $template_qry->row();
    }
    function get_templatesCode($type=0) {
    	
    	$template_qry = $this->db->query('select * from noplate_template where type='.$type);
        return $template_qry->result();
    }
    function get_template_code($emirates) {

        $this->db->select('code');
        $this->db->from('noplate_template');
        if (!ctype_digit($emirates)) $this->db->where('emirates', $emirates);
        else $this->db->where('noplateTempID', $emirates);
        $this->db->limit(1);
        $query = $this->db->get();
        $result = $query->row();
        $res = $result->code;
       
        $code_arr = explode(',', $res);
        foreach ($code_arr as $k) {
            $cities[$k] = $k;
        }
        return $cities;
    }
    function get_template_imgs($emirates,$type) {

        $this->db->select('templates,long_template');
        $this->db->from('noplate_template');
        $this->db->where('noplateTempID', $emirates);
        $this->db->where('type', $type);
        $temp_img_qry = $this->db->get();
        
        return $temp_img_qry->result();
    }
  
  
  function insert_post($data,$FILES,$poster='',$cat_type){
  	
  	$this->load->Model('Utils_Model','utils');
  	$dataxx=[];
  	
  	if($cat_type==3){
	
  	if (isset($_FILES['txtimage']['name']) and $_FILES['txtimage']['name']!=='') {
  		
  		
			
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = '*';
            $config['file_name'] = $_FILES['txtimage']['name'];
            
           
            
            $data['mainImage'] = base_url() . 'uploads/product_images/' .$this->utils->imageUpload($config,'txtimage');
            
        
           
           
     }
    if (isset($_FILES['productVideo']['name']) and $_FILES['productVideo']['name']!=='') {
     	
     	
     	
			
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'mp4|mp3';
            $config['file_name'] = $_FILES['productVideo']['name'];
            $dataxx['productVideo'] = base_url() . 'uploads/product_images/' .$this->utils->imageUpload($config,'productVideo');
            $img = str_replace('data:image/png;base64,', '', $poster);
			$img = str_replace(' ', '+', $img);
			$datax = base64_decode($img);
			$unique =  uniqid();
			$file = 'uploads/product_images/tumbnail/' . $unique . '.png';
			$success = file_put_contents($file, $datax);
			
			
            $dataxx['thumbVideo'] =   base_url().'uploads/product_images/tumbnail/'. $unique . '.png';
            
           
          
     }

    }

    if($cat_type==2){
    	
    	
    	
    	$short_tempImg =$this->input->post('short_tempImg');
    	$long_tempImg =$this->input->post('long_tempImg');
    	$nplates = str_replace("img/noplate/temp/", "uploads/product_images/nplates/", $short_tempImg);
    	$nplates_long = str_replace("img/noplate/temp/", "uploads/product_images/nplates/", $long_tempImg);
        $link_array1 = explode('/',$nplates);
        $link_array2 = explode('/',$nplates_long);
            
            
    	if(copy($short_tempImg,  FCPATH . "/uploads/product_images/nplates/".end($link_array1) )){
    		  $data['mainImage'] = $nplates;
			  unlink($short_tempImg);
			
		}
        if(copy($long_tempImg,  FCPATH . "/uploads/product_images/nplates/".end($link_array2))){
        	 unlink($long_tempImg);
        	 
        	  $dataxx['productImage'] =$long_tempImg;
        	
        }
           
            
    	    
    
	}
	
	if($cat_type==1){
		$temp =$this->input->post('temp');
		$mobileno = str_replace("img/mobno/mobile", "uploads/product_images/mobileno", $temp);
		$link_array1 = explode('/',$mobileno);
		if(copy($temp,  FCPATH . "/uploads/product_images/mobileno/".end($link_array1) )){
    		  $data['mainImage'] = $mobileno;
			  unlink($temp);
			
		}
		
	}

  	 $this->db->insert('product',$data);
  	 $last_post_id = $this->db->insert_id();
  	 
  	 if($last_post_id){
	 	
	 	    $datamedia=array();
	 	    $qry = $this->category_count($data['productCategoryId']);
            $traderqry = $this->trader_post_count($data['traderId']);
            if ($traderqry->postCount == 0) {
                $update_tr_post_cnt = 1;
                $cat_cnt = $qry->ProductCount;
                $update_cat_cnt = $cat_cnt + 1;
            } else {
                $tr_post_cnt = $traderqry->postCount;
                $cat_cnt = $qry->ProductCount;
                $update_cat_cnt = $cat_cnt + 1;
                $update_tr_post_cnt = $tr_post_cnt + 1;
            }
            
            $cdata['ProductCount'] = $update_cat_cnt;
            $this->db->where('CategoryId', $data['productCategoryId']);
            $this->db->update('category', $cdata);

            $tdata['postCount'] = $update_tr_post_cnt;
            $this->db->where('traderId', $data['traderId']);
            $this->db->update('trader', $tdata);
            
            if(count($dataxx)){
            $dataxx['productId']=$last_post_id;
            $dataxx['traderId']=$data['traderId'];
            $this->db->insert('productmedia' ,$dataxx);
            }
            
            if($cat_type==3){
            $file_count = count($_FILES['txtfiles']['name']);
            if ($file_count>0) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->db->insert_batch('productmedia',$this->utils->upload_files($_FILES,$config,$last_post_id,$data['traderId'])); 
            }
           
           }
            
            
            
            
            
	 	
	 	
	 	return  $last_post_id;
	 }
  	
  	
  	
  }
  function update_post($data,$FILES,$poster='',$cat_type,$productid){
  	
  	$this->load->Model('Utils_Model','utils');
  	$dataxx=[];
  	
  	if($cat_type==3){
	
  	if (isset($_FILES['txtimage']['name']) and $_FILES['txtimage']['name']!=='') {
  		
  		
			
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = '*';
            $config['file_name'] = $_FILES['txtimage']['name'];
            
           
            
            $data['mainImage'] = base_url() . 'uploads/product_images/' .$this->utils->imageUpload($config,'txtimage');
            
        
           
           
     }
    if (isset($_FILES['productVideo']['name']) and $_FILES['productVideo']['name']!=='') {
     	
     	
     	
			
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'mp4|mp3';
            $config['file_name'] = $_FILES['productVideo']['name'];
            $dataxx['productVideo'] = base_url() . 'uploads/product_images/' .$this->utils->imageUpload($config,'productVideo');
            $img = str_replace('data:image/png;base64,', '', $poster);
			$img = str_replace(' ', '+', $img);
			$datax = base64_decode($img);
			$unique =  uniqid();
			$file = 'uploads/product_images/tumbnail/' . $unique . '.png';
			$success = file_put_contents($file, $datax);
			
			
            $dataxx['thumbVideo'] =   base_url().'uploads/product_images/tumbnail/'. $unique . '.png';
            
           
          
     }

    }

    if($cat_type==2){
    	
    	
    	
    	$short_tempImg =$this->input->post('short_tempImg');
    	$long_tempImg =$this->input->post('long_tempImg');
    	$nplates = str_replace("img/noplate/temp/", "uploads/product_images/nplates/", $short_tempImg);
    	$nplates_long = str_replace("img/noplate/temp/", "uploads/product_images/nplates/", $long_tempImg);
        $link_array1 = explode('/',$nplates);
        $link_array2 = explode('/',$nplates_long);
            
            
    	if(copy($short_tempImg,  FCPATH . "/uploads/product_images/nplates/".end($link_array1) )){
    		  $data['mainImage'] = $nplates;
			  unlink($short_tempImg);
			
		}
        if(copy($long_tempImg,  FCPATH . "/uploads/product_images/nplates/".end($link_array2))){
        	 unlink($long_tempImg);
        	 
        	  $dataxx['productImage'] =$long_tempImg;
        	
        }
           
            
    	
    
	}
	
	if($cat_type==1){
		$temp =$this->input->post('temp');
		$mobileno = str_replace("img/mobno/mobile", "uploads/product_images/mobileno", $temp);
		$link_array1 = explode('/',$mobileno);
		if(copy($temp,  FCPATH . "/uploads/product_images/mobileno/".end($link_array1) )){
    		  $data['mainImage'] = $mobileno;
			  unlink($temp);
			
		}
		
	}
     $this->db->where('productId',$productid); 
  	 $last_post_id =$this->db->update('product',$data);
  	 
  	 
  	 if($last_post_id){
	 	
	 	    $datamedia=array();
	 	    
	 	    
	 	    
	 	    
	 	    
            if(count($dataxx)){
            $this->db->where('productId',$productid);
	 	    $this->db->delete('productmedia');	
            $dataxx['productId']=$productid;
            $dataxx['traderId']=$data['traderId'];
            $this->db->insert('productmedia' ,$dataxx);
            }
            
            if($cat_type==3){
            	
            $file_count = count($_FILES['txtfiles']['name']);
            
            if ($file_count>0) {
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->db->insert_batch('productmedia',$this->utils->upload_files($_FILES,$config,$productid,$data['traderId'])); 
            }
           
           }
            
            
            
            
            
	 	
	 	
	 	return  $productid;
	 }
  	
  	
  	
  }
  function category_count($cat) {
        $qry = $this->db->query('select ProductCount from category where CategoryId=' . $cat);
        return $qry->row();
   }
    
    function trader_post_count($trader_id) {
        $traderqry = $this->db->query('select postCount from trader where traderId=' . $trader_id);
        return $traderqry->row();
    }
    
function fetch_watchlist(){
     
      $this->db->distinct();
       $this->db->select('count(watchlistCount) as wcnt,watchlistId,product.traderId as traderID,`product`.`productId` as productId,product.mainImage as productImage,product.price as productPrice,product.viewCount,product.productTitle,product.productTitleAr');
        $this->db->from('watchlist');
        $this->db->group_by('watchlist.productId'); 
        $this->db->order_by('watchlist.productId', 'desc'); 
        $this->db->join('product','watchlist.productId=product.productId');
        $qry=$this->db->get();

        $myqry = $qry->result();
          return array(
            'qry' => $myqry,
             );
}
  
function  watchlist_trader($postID){
      $this->db->select('watchlist.userId,trader.image,trader.fullName,trader.location,product.submittedOn as productSubmitDate,product.productTitle,product.productTitleAr');
        $this->db->from('watchlist');
        $this->db->join('trader','trader.traderId=watchlist.userId');
        $this->db->join('product','product.productId=watchlist.productId');
        $this->db->where('watchlist.productId',$postID);
        $tr_qry=$this->db->get();
        return $tr_qry->result();
  }  
function fetch_trader_det($trader_id,$postID)
  {
      $this->db->select('(SELECT count("watchlist.watchlistId") from watchlist where watchlist.productId = '.$postID.'  ) as wcnt,product.price as productPrice,product.mainImage as productImage,trader.fullName,trader.location,trader.image,product.productTitle,product.productTitleAr');
        $this->db->from('trader');
        $this->db->join('product','trader.traderId=product.traderId');
        $this->db->where('product.productid',$postID);
      
        $qry=$this->db->get();
   
        return $qry->result();
  }
  
  function fetch_flagedlist()
  {
    $this->db->select('trader.fullName as flaggedname,trader.image as falgUserImage,flaggeditem.productId,flaggeditem.userId,flaggeditem.date,flaggeditem.description,flaggedId,product.mainImage as productImage,product.callForPrice,product.price,product.submittedOn,trader.fullName as traderName,trader.image as traderImage ,trader.location as traderLocation,product.productTitle,product.productTitleAr ');
    $this->db->from('flaggeditem');
    $this->db->join('product','flaggeditem.productId=product.productId');
    $this->db->join('trader as trd','flaggeditem.traderId = trd.traderId ');
    $this->db->join('trader','flaggeditem.userId=trader.traderId ');
    $this->db->group_by("flaggeditem.flaggedId");
    $qry=$this->db->get();
   
        return $qry->result();
  }
  
  function discardFlagged($flagId){
      $this->db->delete('flaggeditem', array('flaggedId' => $flagId));
      return "success";
    }
    
    function approve_post($post_id)
  {
      $data = array();
      $data['postStatusDetail'] = 1;
      $where = array('productId' => $post_id);
      $this->db->where($where);
      $this->db->update('product',$data);
      
  }
  function reject_post($post_id,$message='')
  {
      $data = array();
      $data['postStatusDetail'] = -1;
      $data['rejectMessage'] = $message;
      $this->db->where('productId',$post_id);
      $this->db->update('product',$data);
  }
  
  function get_post_info($postid=''){
  	
  	$this->db->select('product.status,product.productId,product.traderId,product.productCategoryId,product.subCategory1Id,product.subCategory2Id,,product.subCategory3Id,product.description,,product.descriptionAr,product.callForPrice,product.submittedOn,product.mainImage,trader.fullName,trader.location,category.Name,product.price,trader.image,product.viewCount,trader.userType,product.productTitle,product.productTitleAr,product.postStatusDetail,trader.userType as type,product.productCategoryId,product.brand,product.model');
    $this->db->from('product');
     $this->db->join('category','category.CategoryId=product.productCategoryId');
    $this->db->join('trader','trader.traderId=product.traderId');
    $this->db->where('product.productid',$postid);
    $qry=$this->db->get();
    return $qry->row();
  }
  
  function get_post_category($postid=''){
  	
  	$this->db->select('category.type');
    $this->db->from('product');
    $this->db->join('category','category.CategoryId=product.productCategoryId');
    $this->db->where('product.productid',$postid);
    $qry=$this->db->get();
    return $qry->row();
  }
  
     function post_cnt() {
     	
        $this->db->select('sum(postCount) as traderPostCount');
        $post_qry = $this->db->get('trader');
        
        
        return $post_qry->row()->traderPostCount;
    }

    function sold_item_cnt() {
        $this->db->select('sum(soldCount) as traderSoldCount');
        $sold_qry = $this->db->get('trader');
        return $sold_qry->row()->traderSoldCount;
    }

    function wish_item_cnt() {
        $this->db->select('sum(watchlistCount) as traderWishCount');
        $wish_qry = $this->db->get('watchlist');
        return $wish_qry->row()->traderWishCount;
    }

    function cart_cnt() {
        $this->db->select('sum(cartlistCount) as cartlistCount');
        $cart_qry = $this->db->get('cartlist');
        return $cart_qry->row()->cartlistCount;
    }
    
    function total_sold_prodcut(){
        $this->db
    	->where('product.type',1)
    	->select('product.status,product.productId,product.traderId,product.productCategoryId,product.subCategory1Id,product.subCategory2Id,,product.subCategory3Id,product.description,product.callForPrice,product.submittedOn,product.mainImage,trader.fullName,trader.location,category.Name,product.price,trader.image,product.viewCount,trader.userType,product.productTitle,product.productTitleAr')
    	->where('trader.traderId',$this->session->userdata('admin_logged_in')['trader_id'])
    	->join('category','category.CategoryId=product.productCategoryId')
    	->join('trader','trader.traderId=product.traderId')
    	->where('trader.userType',3)
    	->where('product.status',1)
    	->order_by('submittedOn','desc')
    	->where('trader.traderId',$this->session->userdata('admin_logged_in')['trader_id'])
    	->from('product');
        $sold_count = $this->db->get();
        return $sold_count->result();
    }
    function total_booked_prodcut(){
    	$this->db
    	->where('product.type',1)
    	->select('product.status,product.productId,product.traderId,product.productCategoryId,product.subCategory1Id,product.subCategory2Id,,product.subCategory3Id,product.description,product.callForPrice,product.submittedOn,product.mainImage,trader.fullName,trader.location,category.Name,product.price,trader.image,product.viewCount,trader.userType,product.productTitle,product.productTitleAr')
    	->where('trader.traderId',$this->session->userdata('admin_logged_in')['trader_id'])
    	->join('category','category.CategoryId=product.productCategoryId')
    	->join('trader','trader.traderId=product.traderId')
    	->where('trader.userType',3)
    	->where('product.status',2)
    	->order_by('submittedOn','desc')
    	->where('trader.traderId',$this->session->userdata('admin_logged_in')['trader_id'])
    	->from('product');
        $booked_count = $this->db->get();
        return $booked_count->result();
    }
    function all_admin_products(){
		
		if($this->session->userdata('admin_logged_in'))
		$this->db
    	->order_by('product.viewCount','desc')
    	->join('trader','trader.traderId=product.traderId')
    	->select('product.status,product.productId,product.traderId,product.productCategoryId,product.subCategory1Id,product.subCategory2Id,,product.subCategory3Id,product.description,product.callForPrice,product.submittedOn,product.mainImage,trader.fullName,trader.location,category.Name,product.price,trader.image,product.viewCount,trader.userType,product.productTitle,product.productTitleAr')
    	->join('category','category.CategoryId=product.productCategoryId')
    	->where('product.type',1)
    	->where('trader.traderId',$this->session->userdata('admin_logged_in')['trader_id'])
    	->where('trader.userType',3)
    	->from('product');
		
		$qry = $this->db->get();
		return $qry->result();
		
	}
	
	 function get_listing_by_id($category_id,$keyword,$limit=NULL, $offset=NULL){
	 	
	 	
	 	if (is_numeric($category_id)) {
          $this->db->where('category.CategoryId',$category_id);
      	} elseif($category_id!='all') {
        $this->db->where('category.category_name',$category_id);
      	}
		
		if(isset($limit)&&isset($offset))
    	$this->db->limit($limit, $offset);
    	if (!empty($keyword)){
    	
          $this->db->group_start();
          $this->db->like('category.CategoryId', $keyword, 'both'); 
          $this->db->or_like('product.productTitle', $keyword, 'both')->group_end();
        } 
        else{
			$this->db->where('product.productCategoryId',$category_id);
		}
		$this->db
    	->order_by('product.submittedOn','desc')
    	->join('trader','trader.traderId=product.traderId')
    	->select('product.status,product.productId,product.traderId,product.productCategoryId,product.subCategory1Id,product.subCategory2Id,,product.subCategory3Id,product.description,product.callForPrice,product.submittedOn,product.mainImage,trader.fullName,trader.location,category.Name,product.price,trader.image,product.viewCount,trader.userType,product.productTitle,product.productTitleAr')
    	->join('category','category.CategoryId=product.productCategoryId')
    	->where('product.status !=', 3)
    	->from('product');
		
		$qry = $this->db->get();
		
		return $qry->result_array();
	}
	
	
	  function save_notifications($user_id=NULL,$message,$planid=NULL) {
        $devids=[];
     
      if(isset($planid)){
   
        //get all user on that plan
        $this->db->select("traderId,deviceId");
        $this->db->where('planId',$planid);
         $users=$this->db->get('trader')->result_array();
     
      }else{
    
        $this->db->select("traderId,deviceId");
        $this->db->where('traderId',$user_id['traderId']);
         $users=$this->db->get('trader')->result_array();
      }
  
      foreach( $users as $user){
        
             $data[] = array('traderId'=>$user['traderId'],'message' => $message, 'readStatus' => 0, 'notifiedFrom' => $_SESSION['admin_logged_in']['trader_id'],'date'=>date('Y-m-d h:i:sa'));
             if ($user['deviceId']!='')$devids[] = $user['deviceId'];
            }
      
            return $this->db->insert_batch('tradernotification', $data)?$devids:0;
    }

    public function sendpush($registrationIds=array(),$msg ){
   
        $deviceIds = implode (",", $registrationIds);
      
        #API access key from Google API's Console
        define( 'API_ACCESS_KEY', 'AAAAt1-_IHo:APA91bEN-Moq4Y-SFNRGW3CTgjXl8c8ZbDCbkd5XWpPhwh3TmbIWqTyV583wIXEc-m9ZB-tY3ow28QZfMZ8Oc-fRTjftcL9_zXJzA_oTNlG7KhYzDDNzpkNrgTaYtCIaPSwcs34jTTh9' );
        //$registrationIds = $_GET['id'];
        $registrationIds = 'fKOLhxS9coQ:APA91bE13tHl61mVUwoMxT4Obt6L5N4bMCw2VvfPIOWE7JzZH1JAQ0TAWIO9R-lonBm17AVlA7X8GhyxaWyS3qhEkDeUczZE-fP_h2x8TKLvB4c0T5xyNdqpSlIiDaR86DpOn4YWq00V';
    
        $msg = array
            (
            'body' 	=> $msg,
            'title'	=> 'Alshamil Online',
                    'icon'	=> 'myicon',/*Default Icon*/
                    'sound' => 'mySound'/*Default sound*/
            );
        $fields = array
                (
                    'to'		=> $deviceIds,
                    'notification'	=> $msg
                );
        
        
        $headers = array
                (
                    'Authorization: key=' . API_ACCESS_KEY,
                    'Content-Type: application/json'
                );
    #Send Reponse To FireBase Server	
            $ch = curl_init();
            curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
            curl_setopt( $ch,CURLOPT_POST, true );
            curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
            curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
            curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
            $result = curl_exec($ch );
            curl_close( $ch );
    #Echo Result Of FireBase Server
    //echo $result;
}

 function mdl_freeze_trader($trader_id){
 	
 	$status = '';
 	$this->db->select('isActive');
 	$this->db->where('traderId',$trader_id);
 	$status = $this->db->get('trader');
 	$data['isActive']= 0;
 	if($status->row()->isActive=="-1"){
 		
		 $data['isActive'] = 1;
		 $status = 'Defreezed';
	}else{
		
		$data['isActive'] = -1;
		 $status = 'Freezed';
	}
 	 $this->db->where('traderId',$trader_id);
        $this->db->update('trader',$data);
        
        return $status;
        
        
    }
  function totalSoldAmount($trader_id){
        $query = $this->db->query("select SUM(price) as total_sold_amount from product  where traderId=$trader_id and status=1");
 
        return $query->result()[0]->total_sold_amount;
    }
    
     function totalSold($trader_id){
        $query = $this->db->query("select COUNT(*) as total_sold from product  where traderId=$trader_id and status=1");
   /// print_r($query->result()[0]->total_sold_amount);
        return $query->result()[0]->total_sold;
    }
    function totalCart($trader_id){
        $query = $this->db->query("select COUNT(*) as total_cart from cartlist  where userId=$trader_id AND productAvailability=0 ");
   /// print_r($query->result()[0]->total_sold_amount);
        return $query->result()[0]->total_cart;
    }
    function totalWatchlist($trader_id){
        $query = $this->db->query("select COUNT(*) as total_cart from watchlist  where traderId=$trader_id ");
   /// print_r($query->result()[0]->total_sold_amount);
        return $query->result()[0]->total_cart;
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
    
      function getPostByStatus($plan,$status,$trader,$type){
      $where = array('trader.planId' => $plan, 'product.postStatusDetail' => $status,'product.traderId'=>$trader);
      $this->db->select('*');
      $this->db->from('product');
      $this->db->join('trader', 'product.traderId = trader.traderId');
      $this->db->where($where);
      $query =  $this->db->get();
        if($type=='all'){
          return ($query->num_rows() > 0)?$query->result_array():FALSE;
        }else{
          return ($query->num_rows() > 0)?$query->num_rows():0;
        }
        

        //return $yearly_qry->result();
  }
	
    
}