<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
@project 				: Alshamil
@project Module 		: ADMIN 
@developrt				: Arun Vasanth Samraj 
@lastmodification date	: 15-05-2018
@controller 			: ADMIN
*/

class Admin extends Admin_Controller{
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->Model('Admin_Model' ,'adm'); 
		$this->load->Model('View_Model' ,'view'); 
        
		  
	}
	function dashboard(){
		is_admin_logged_in();
		
		$data['total_post']       = $this->adm->post_cnt();
        $data['sold_count']       = $this->adm->sold_item_cnt();
        $data['watchlist_count']       = $this->adm->wish_item_cnt();
        $data['booked']       = $this->adm->cart_cnt();
		$data['trader']         = $this->view->get_traders_list($type=1);
		$this->load->view('admin/dashboard_view',$data); 
	}
	public function admin_home() {
       
        $home_data['all_product'] = $this->adm->all_admin_products('all','');
        $home_data['bkd_product'] = $this->adm->total_booked_prodcut();
        $home_data['sld_product'] = $this->adm->total_sold_prodcut();
        $this->load->view('admin/admin_home_vw',$home_data);
    }
	public function index($data=array()){
    	
		if($this->session->userdata('admin_logged_in')){
			redirect(base_url().'admin/dashboard','location',301);
		}else{	
			$this->load->view('admin/start_page',$data);
		  
		} 
	}
	public function login(){
		
		if(!empty($this->input->post('txtemail')) && (!empty($this->input->post('txtpassword')))){
			$txtemail = $this->input->post('txtemail');
			$txtpassword = $this->input->post('txtpassword');
			$txtusertype = 3;
			$result = $this->adm->get_admin($txtemail, $txtpassword, $txtusertype);
			if($result){
				$sess_array = array();
				foreach($result as $row){
					$sess_array = array(
						'trader_id' => $row->traderId,
						'txtemail' => $row->email,
						'txtusertype' => $row->userType
					);

					$this->session->set_userdata('admin_logged_in', $sess_array);
				}
				redirect(base_url().'admin/dashboard','location',301);
			}
			else{
				$data['result'] = '100';
				$data['message'] = ' Login Failed ! Please check the username/password';
				$this->session->set_flashdata('errors', $data['message']);
				redirect(base_url().'admin','location',301);
			}
          
		} else{
			$data['result'] = '100';
			$data['message'] = 'please enter your details';
			if($this->session->userdata('admin_logged_in')){
				redirect(base_url().'admin/dashboard','location',301);
			}else{

				redirect(base_url().'admin','location',301);
			}
            
		}
	}
	public function category(){
    	
		is_admin_logged_in();
        	
		$data['pcat']=$this->adm->get_parent_category();
		$this->load->view('admin/category/category_view',$data); 
		
		
	}
	public function saveparent_category(){
		 
		is_admin_logged_in();
		
		if($this->input->is_ajax_request()){
			
			$response=[];
			$category=$this->input->post('category');
			$data['Name'] = $category;
			$data['NameAr'] = $this->input->post('category_ar');
			$status=$this->adm->savepcategory($data);
			
			if($status){
				
				$response =array('id'=>$status,'success'=>true);
			}
			else{
				
				$response =array('id'=>'','success'=>false);
			}
			
			echo json_encode($response); exit;
		}
		
		else{
			exit('No direct script access allowed');
		}
		
		
	}  
	public function updateparent_category(){
		 
		is_admin_logged_in();
		
		if($this->input->is_ajax_request()){
			
			$response=[];
			$category=$this->input->post('category');
			$categoryid=$this->input->post('categoryid');
			$data['Name'] = $category;
			
			$data['CategoryId'] = $categoryid;
			$status=$this->adm->updatepcategory($data);
			
			if($status){
				
				$response =array('id'=>$data['CategoryId'],'success'=>true);
			}
			else{
				
				$response =array('id'=>'','success'=>false);
			}
			
			echo json_encode($response); exit;
		}
		
		else{
			exit('No direct script access allowed');
		}
		
		
	}  
	public function delete_pcategory(){
		 
		is_admin_logged_in();
		
		if($this->input->is_ajax_request()){
			
			$response=[];
			$categoryid=$this->input->post('categoryid');
			$data['CategoryId'] = $categoryid;
			$status=$this->adm->deletepcategory($data);
			
			if($status){
				
				$response =array('id'=>$data['CategoryId'],'success'=>true);
			}
			else{
				
				$response =array('id'=>'','success'=>false);
			}
			
			echo json_encode($response); exit;
		}
		
		else{
			exit('No direct script access allowed');
		}
		
		
	}  
	public function subcategory($param1='',$param2=''){
    	
		is_admin_logged_in();
    	 
		$data['cat']= $param1;	 $data['id']= $param2;	
         
		if($param1!=''&&$param2=='')
		$data['pcat']=$this->adm->get_sub_category($param1);
    	 
		if($param1!=''&&$param2!='')
		$data['pcat']=$this->adm->get_sub_category($param2);
    	 
		$this->load->view('admin/category/subcategory_view',$data); 
		
		
	}
	public function save_sub_category(){
		 
		is_admin_logged_in();
		
		if($this->input->is_ajax_request()){
			
			$response=[];
			$category=$this->input->post('category_id');
			$name=$this->input->post('sub_category');
			$level=$this->input->post('level');
			$data['Name'] = $name;
			$data['level'] = $level;
			$data['parentCategory'] = $category;
			$data['NameAr'] = $this->input->post('sub_category_ar');
			$status=$this->adm->savescategory($data);
			
			if($status){
				
				$response =array('id'=>$status,'success'=>true,'limit'=>'');
			}
			else{
				
				$response =array('id'=>'','success'=>false,'limit'=>true);
			}
			
			echo json_encode($response); exit;
		}
		
		else{
			exit('No direct script access allowed');
		}
		
		
	}  
	
	public function save_sub_values(){
		 
		is_admin_logged_in();
		
		if($this->input->is_ajax_request()){
			
			$response=[];
			$category=$this->input->post('category_id');
			$link=$this->input->post('link');
			$name=$this->input->post('sub_category');
			$data['Name'] = $name;
			$data['parentCategory'] = $category;
			$data['NameAr'] = $this->input->post('sub_category_ar');
			$status=$this->adm->savepcategory($data);
			if(isset($link)){
				
				if($link!='' & $link!=null){
					
				$data['link'] = $link;	
				$this->db->where('CategoryId',$status);
				$this->db->update('category',$data);
			
					
				}
				
				
				
				
			}
			if($status){
				
				$response =array('id'=>$status,'success'=>true);
			}
			else{
				
				$response =array('id'=>'','success'=>false);
			}
			
			echo json_encode($response); exit;
		}
		
		else{
			exit('No direct script access allowed');
		}
		
		
	}  
	
		public function get_sub_values(){
		 
		is_admin_logged_in();
		
		if($this->input->is_ajax_request()){
			
			$brand = $this->input->post('category_id');
            header('Content-Type: application/x-json; charset=utf-8');
            echo(json_encode($this->adm->get_data_drop_down($brand,''))); exit;
			
		}
		
		
	 }
	
	
	public function subcriptionplans(){
    	
		is_admin_logged_in();
        	
		$data['plan']=$this->adm->get_subscription_plan();
		$this->load->view('admin/plans/plan_view',$data); 
		
		
	}
	public function save_plan(){
		 
		is_admin_logged_in();
		
		if($this->input->is_ajax_request()){
			
			$response=[];
			$plan_name=$this->input->post('plan_name');
			$data['name'] = $plan_name;
			$status=$this->adm->save_plan($data);
			
			if($status){
				
				$response =array('id'=>$status,'success'=>true);
			}
			else{
				
				$response =array('id'=>'','success'=>false);
			}
			
			echo json_encode($response); exit;
		}
		
		else{
			exit('No direct script access allowed');
		}
		
		
	}  
	public function delete_plan(){
		
		is_admin_logged_in();
		
		if($this->input->is_ajax_request()){
			
			$response=[];
			$planid=$this->input->post('planid');
			$data['planId'] = $planid;
			$status=$this->adm->delete_plans($data);
			
			if($status){
				
				$response =array('id'=>$data['planId'],'success'=>true);
			}
			else{
				
				$response =array('id'=>'','success'=>false);
			}
			
			echo json_encode($response); exit;
		}
		
		else{
			exit('No direct script access allowed');
		}
		
	}
	public function edit_subcriptionplans($param1=''){
		
		
		is_admin_logged_in();
		
		
		if($param1!==''){
			
			$data['plan_data'] = $this->adm->get_plan_by_id($param1);
			
			
			
		}
		$this->load->view('admin/plans/plan_edit_view',$data); 
		
	}
	public function update_plan(){
		
		is_admin_logged_in();
		
		if($this->input->is_ajax_request()){
			
			$response=[];
			$planid=$this->input->post('planid');
			$data['planId'] = $planid;
			$data['validity'] = $this->input->post('duration');
			if($this->input->post('unlimited')=="1")
			$data['postCount'] = '-1';
			else
			$data['postCount'] =$this->input->post('limit');
			$data['amount'] = $this->input->post('amount');
			$data['description'] = $this->input->post('information');
			
			$status=$this->adm->update_plans($data);
			
			if($status){
				
				$response =array('id'=>$data['planId'],'success'=>true);
			}
			else{
				
				$response =array('id'=>'','success'=>false);
			}
			
			echo json_encode($response); exit;
		}
		
		else{
			exit('No direct script access allowed');
		}
		
		
		
		
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url().'admin','location',301);
	}  
	public function newRegisters(){
		is_admin_logged_in();
		$new_regs_data['plans'] = $this->adm->fectch_plans();
		$this->load->view('admin/admin_new_rgs_vw',$new_regs_data);
		
	}
	public function fetch_trader_details(){
		
		is_admin_logged_in();
		
		if($this->input->is_ajax_request()){
		
			if($this->input->post()){
			
				$trader_id = $this->input->post('trader_id');
			 
				$row=$this->adm->get_trader_row($trader_id);
			   
				$data['trader_id'] = $trader_id;
			   
				$data['row'] = $row;
			 
				$this->load->view('admin/ad_fetch_traders_vw',$data);
			 
			}else{
			
				exit;
			
			}
		
		}else{
			exit('No direct script access allowed');
		}
		
	}
	public function admin_approve_trader(){
		is_admin_logged_in();
		 
		if($this->input->is_ajax_request()){ 
		 
			$trader_id = $this->input->post('trader_id'); 
			$plan_id = $this->input->post('plan_id'); 
			$status = $this->adm->approve_trader($trader_id,$plan_id);
			if($status){
				echo "success"; exit;
			}
        
			else{
				echo "fail"; exit;
			}
        
        
		}else{
			exit('No direct script access allowed');
		}
	}
	public function admin_reject_trader(){
		is_admin_logged_in();
    	 
		if($this->input->is_ajax_request()){  
    	 
			$trader_id = $this->input->post('trader_id'); 
			$status = $this->adm->reject_trader($trader_id);
        
			if($status){
				echo "success"; exit;
			}
        
			else{
				echo "fail"; exit;
			}
       
        
		}else{
			exit('No direct script access allowed');
		}
        
	}
	public function edit_trader($traderId=''){

		$data['result']=$this->adm->get_single_trader($traderId);
		$this->load->view('admin/admin_edit_trader_vw',$data);
	}  
	public function update_trader_register(){
 	
		is_admin_logged_in();
     	
		if($this->input->post()):
     	
        

		$txtpassword =$this->input->post('txtpassword');    
 
		if($txtpassword!=='')
		$data['password']   = md5($txtpassword);  

		$data['fullName']  = trim($this->input->post('txtname'));
		$data['location']  = $this->input->post('txtplace');
		$data['contactNumber']  =  $this->input->post('txtmob');
		$data['email']      = $this->input->post('txtemail');
		$data['traderId']   = $this->input->post('txthid_trid'); 
		$data['socialWeb']  = $this->input->post('txtweblink');
		$data['socialFb']   = $this->input->post('txtfblink');
		$data['socialInsta']= $this->input->post('txtinstlink');
		$data['socialSnap'] = $this->input->post('txtsnapclink');
		$data['socialTwitter']  = $this->input->post('txttwitter');
		$data['traderInfo'] = $this->input->post('txtabout');	

		$status=$this->adm->update_trader($data ,$_FILES);
		if($status){
			$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Profile updated successfully</div>');
		}
		else{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Please try again ...</div>');
    

		}       	redirect(base_url().'admin/edit_trader/'.$data['traderId'], 'location',301);
     	
		else:
		redirect(base_url(),'location',301);
		endif;
     	
	}
	public function view_plan($planid=''){
		is_admin_logged_in();
        
		$data['qry'] = $this->adm->fetch_planusers($planid);
		$data['plan_name'] =$this->adm->get_plan_name($planid)->name;
		$data['plan_id'] =$planid;
		$this->load->view('admin/ad_view_plan_vw',$data);
	}
	public function newPost(){
		is_admin_logged_in();
		$data['result'] = $this->adm->fetch_new_post();
		$this->load->view('admin/admin_new_post_vw',$data); 
	}
	public function all_traders(){
		is_admin_logged_in();
    	
		$query = $this->adm->all_traders();
    	    
		$trader_data['records'] = $query['records'];
		$trader_data['count'] = $query['count'];
		$this->load->view('admin/all_traders', $trader_data);
		
		
	}
	public function plan_profile($param1 = '' ,$param2 = ''){
		is_admin_logged_in();
		
		$data['tid'] = $param1;
		$data['pid'] = $param2;
		$data['soldamount'] = $this->adm->totalSoldAmount($data['tid']);
		$data['total_sold']=$this->adm->totalSold($data['tid']);
        $data['total_cart']=$this->adm->totalCart($data['tid']);
        $data['totalWatchlist']=$this->adm->totalWatchlist($data['tid']);
        $data['notifications']=$this->adm->get_all_notification(array('traderId'=>$data['tid']),NULL,NULL);
        $data['pending'] =  $this->adm->getPostByStatus($data['pid'] ,0,$data['tid'],'count');
        $data['apprvd'] =  $this->adm->getPostByStatus($data['pid'] ,1,$data['tid'],'count');
        $data['reject'] =  $this->adm->getPostByStatus($data['pid'] ,'-1',$data['tid'],'count');
		$data['result']=$this->adm->get_trader_row($data['tid']);
		$this->load->view('admin/plan_profile_vw',$data);
	}
    public function getPostByStatus($plan,$status,$trader){
   	
       $result =  $this->adm->getPostByStatus($plan,$status,$trader,'all');
       $data=[];
       $index=1;
       $product_status=NULL;
       if(count($result)>0 && !empty($result) && isset($result)){
           foreach ($result as $key => $value) {
        if($status==1){
            switch($value['status']){
                case '1':
                $product_status="Sold";
                break;
            case '2':
                $product_status="Booked";
                break;
            // case '3':
            //     $product_status="Sold out";
            //     break;
            // case '4':
            //     $status=" Booked";
            //     break;
            default:
                $product_status="Available";
            }
        }else{
            $product_status='- -';
        }
           
           $data []  = array();
           //'wished_list'=>$value['watchlistCount'],'view'=>'<a href="'.base_url().'admin/Dashboard/post_details/'.$value['TraderID'].'">view post</a>');
       
           $index++;
        }
       }
    
       echo json_encode(array('data'=>$data)); exit;
    }
	public function add_post(){
		
		is_admin_logged_in();
		
		$page_data['cat_qry'] = $this->adm->get_parent_category();
		$this->load->view('admin/admin_add_post_vw',$page_data);
		
	}
    public function addpostview($param1=''){
		
		
		is_admin_logged_in();
    	 
		if($this->input->is_ajax_request()){  
    	 
		   $data['category_id'] = $param1; 
		  // $data['query'] = $this->adm->get_rcv_categories($data['category_id']);
		   $data['query_properties'] = $this->adm->get_category_properties($data['category_id']);
		   $data['cat_type'] = $this->adm->get_category_type($data['category_id']);
		   $data['qry'] = $this->adm->rcv_categories($data['category_id']);
		   
		   $this->load->view('admin/addpost/ad_post_vw',$data);
       
        
		}else{
			exit('No direct script access allowed');
		}
		
		
	}
    public function fetch_data() {
        $brand = $this->input->post('brand');
        $div = $this->input->post('div');
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->adm->get_data_for_drop_down($brand,$div))); exit;
    }
    public function savepost($param1 =''){
    	
    	is_admin_logged_in();
    	
    	if($this->input->post()):
    	
    	 
    	    $session_data = $this->session->userdata('admin_logged_in');
            $trader_id = $session_data['trader_id'];
            $cat = $this->input->post('txtcat');
            $cat_type = $this->input->post('cat_type');
           
            $img = $_FILES['txtimage']['name'];
            $main_video_img = 'drop_zone1';
            $main_audio_img = 'car_img';
            
            $post_date = date('Y-m-d h:i:sa');
            if ($this->input->post('call_for_price')) {
                $call_for_price = 1;
                $txtprice = '';
            } else {
                $call_for_price = 0;
                $txtprice = $this->input->post('txtprice');
            }
            
            $data=[]; 
            $insert_data=[];
            if($cat_type==3){
           	
           	            $query = $this->adm->rcv_categories($cat);
            $datam=array();
            foreach($query as $row){
				
				$data=  array('lab'=>$row->lab);
				$datam[] =$data;
	
			}
            
            $count =1;
            
            
            foreach($datam as $key=>$value) { 
           
            
            if($count==1) $label = 'subCategory1Id';
            if($count==2) $label = 'subCategory2Id';
            if($count==3) {
            	if($value['lab']=='year')
            	$label = 'releaseYear';
            	else
            	$label = 'subCategory3Id';
            	
            }
            if($count==4) {
            	if($value['lab']=='year')
            	$label = 'releaseYear';
            	
            	
            }

            $insert_data[$label] = $this->input->post(strtolower($value['lab']));
                       
                
            $count++;
            }
		   	
		   }

            if($cat_type==2){
            	
            	
            	
            	$datacx = array('templateId'=> $this->input->post('txtemirates'),'txtcode'=>
            	$this->input->post('txtcode'),'txtno_digs'=>$this->input->post('txtno_digs'),'txtnumber'=>$this->input->post('txtnumber'));
            	
            	
            	$insert_data['brand'] = json_encode($datacx);
            	
            	
				
				
				
			}


            if($cat_type==1) {
            	
				$datacx = array('operator'=> $this->input->post('operator'),'txtmainprefix'=>
            	$this->input->post('txtmainprefix'),'txtmob'=>$this->input->post('txtmob'));
            	
            	
            	$insert_data['model'] = json_encode($datacx);
				
			}



            $datamc=array();
            $queryproperties = $this->adm->get_category_properties($cat);
            
            $insert_data['productCategoryId'] = $cat;
            $insert_data['price'] = $txtprice;
            $insert_data['callForPrice']  = $call_for_price;
            $insert_data['traderId']      = $trader_id;
            $insert_data['submittedOn']   = $post_date;
            $insert_data['description']   = $this->input->post('txtdetails');
            $insert_data['postValidTill'] = '';
            $insert_data['type']   = '1';
            $insert_data['postStatusDetail']   = '1';
            $insert_data['status'] = '0';
            $insert_data['productTitle'] =  $this->input->post('txt_prtitle');
            $insert_data['productTitleAr'] =  $this->input->post('txt_prtitle_ar');
            $insert_data['descriptionAr'] =  $this->input->post('txtdetails_ar');
            
            if($cat_type==3){
				$poster =  $this->input->post('poster');
                $id = $this->adm->insert_post($insert_data,$_FILES,$poster,$cat_type);
			}
            
            if($cat_type==2){
				$poster = '';
				$id = $this->adm->insert_post($insert_data,$_FILES,$poster,$cat_type);
			}
            
             if($cat_type==1){
				$poster = '';
				$id = $this->adm->insert_post($insert_data,$_FILES,$poster,$cat_type);
			}
           
            
           if($id){
		   	
		   
		   	if($queryproperties->num_rows()>0){
		   		
             foreach($queryproperties->result() as $row){
                $datax['productId'] = $id;
                $datax['categoryDetaiId'] = $id;
                $datax['value'] = $this->input->post('txtp_'.$row->name);
                $datamc[]=$datax;
		   	    }
		   	  $this->db->insert_batch('productdetail',$datamc);
		     }
		     
		   
		   
		   }
    	  
    	
    	
    	 $this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-success text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Your Product is Added Successfully</div></div></div>');
    	
		
		redirect(base_url().'admin/add_post','location',301);
		
		else:
		
		redirect(base_url(),'location',301);
		
		endif;
	}
	public function updatepost($param1 =''){
    	
    	is_admin_logged_in();
    	
    	if($this->input->post()):
    	
    	 
    	    $session_data = $this->session->userdata('admin_logged_in');
            $trader_id = $session_data['trader_id'];
            $cat = $this->input->post('txtcat');
            $cat_type = $this->input->post('cat_type');
           
            $img = $_FILES['txtimage']['name'];
            $main_video_img = 'drop_zone1';
            $main_audio_img = 'car_img';
            
            $post_date = date('Y-m-d h:i:sa');
            if ($this->input->post('call_for_price')) {
                $call_for_price = 1;
                $txtprice = '';
            } else {
                $call_for_price = 0;
                $txtprice = $this->input->post('txtprice');
            }
            
            $data=[]; 
            $insert_data=[];
            if($cat_type==3){
           	
           	            $query = $this->adm->rcv_categories($cat);
            $datam=array();
            foreach($query as $row){
				
				$data=  array('lab'=>$row->lab);
				$datam[] =$data;
	
			}
            
            $count =1;
            
            
            foreach($datam as $key=>$value) { 
           
            
            if($count==1) $label = 'subCategory1Id';
            if($count==2) $label = 'subCategory2Id';
            if($count==3) {
            	if($value['lab']=='year')
            	$label = 'releaseYear';
            	else
            	$label = 'subCategory3Id';
            	
            }
            if($count==4) {
            	if($value['lab']=='year')
            	$label = 'releaseYear';
            	
            	
            }

            $insert_data[$label] = $this->input->post(strtolower($value['lab']));
                       
                
            $count++;
            }
		   	
		   }

            if($cat_type==2){
            	
            	
            	
            	$datacx = array('templateId'=> $this->input->post('txtemirates'),'txtcode'=>
            	$this->input->post('txtcode'),'txtno_digs'=>$this->input->post('txtno_digs'),'txtnumber'=>$this->input->post('txtnumber'));
            	
            	
            	$insert_data['brand'] = json_encode($datacx);
            	
            	
				
				
				
			}


            if($cat_type==1) {
            	
				$datacx = array('operator'=> $this->input->post('operator'),'txtmainprefix'=>
            	$this->input->post('txtmainprefix'),'txtmob'=>$this->input->post('txtmob'));
            	
            	
            	$insert_data['model'] = json_encode($datacx);
				
			}



            $datamc=array();
            $queryproperties = $this->adm->get_category_properties($cat);
            $insert_data['productCategoryId'] = $cat;
            $insert_data['price'] = $txtprice;
            $insert_data['callForPrice']  = $call_for_price;
            $insert_data['submittedOn']   = $post_date;
            $insert_data['description']   = $this->input->post('txtdetails');
            $insert_data['postValidTill'] = '';
            $insert_data['type']   = '1';
            $insert_data['traderId']   = $trader_id;
            $insert_data['postStatusDetail']   = '1';
            $insert_data['status'] = '0';
            $insert_data['productTitle'] =  $this->input->post('txt_prtitle');
            $insert_data['productTitleAr'] =  $this->input->post('txt_prtitle_ar');
            $insert_data['descriptionAr'] =  $this->input->post('txtdetails_ar');
            
            if($cat_type==3){
				$poster =  $this->input->post('poster');
                $id = $this->adm->update_post($insert_data,$_FILES,$poster,$cat_type,$param1);
			}
            
            if($cat_type==2){
				$poster = '';
				$id = $this->adm->update_post($insert_data,$_FILES,$poster,$cat_type,$param1);
			}
            
             if($cat_type==1){
				$poster = '';
				$id = $this->adm->update_post($insert_data,$_FILES,$poster,$cat_type,$param1);
			}
           
            
           if($id){
		   	
		   
		   	if($queryproperties->num_rows()>0){
		   		
		   		$this->db->where('productId',$param1);
		   		$this->db->delete('productdetail');
		   		
               foreach($queryproperties->result() as $row){
                $datax['productId'] = $id;
                $datax['categoryDetaiId'] = $id;
                $datax['value'] = $this->input->post('txtp_'.$row->name);
                $datamc[]=$datax;
		   	   }
		   	   $this->db->insert_batch('productdetail',$datamc);
		     }
		     
		   
		   
		   }
    	  
    	
    	
    	 $this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-success text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Your Product Updated Successfully</div></div></div>');
    	
		
		redirect(base_url().'admin/post_details/'.$param1,'location',301);
		
		else:
		
		redirect(base_url(),'location',301);
		
		endif;
	}
    public function fetch_temp_img() {
		is_admin_logged_in();
        $emirates = $this->input->post('emirates');
        $type = $this->input->post('type');
        $temp_img_qry = $this->adm->get_template_imgs($emirates,$type);
        $img_src = $temp_img_qry;
        echo(json_encode($img_src[0])); exit;
    }
    public function fetch_temp_code() {
    	is_admin_logged_in();
        $emirates = $this->input->post('emirates');
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->adm->get_template_code($emirates))); exit;
    }
    public function generate_nopl_temp() {
        //header('Content-Type: image/png');
        $base_url = base_url();
        $temp = $this->input->post('short_tempImg');
        $emrId = $this->input->post('emrId');
        $text = $this->input->post('res');
        $img_src = $this->input->post('srcimg');
        $img_src_long   = $this->input->post('srcimg_long');
        $splitText = explode(" ", $text);
        $code = $splitText[0];
        $number = $splitText[1];

  
         $font =  FCPATH.'/fonts/Lato-Bold.ttf';
         
       

         $source = $base_url . "img/noplate/base_images/" . $img_src;
         
        
       // $source =  "http://alshamil.bluecast.ae/img/noplate/base_images/" . $img_src;
        
        $image = imagecreatefrompng($source);

        $source_long   = $base_url . "img/noplate/base_images/all/Numberplate-Long/" . $img_src_long;
      
      // $source_long   = "http://alshamil.bluecast.ae/img/noplate/base_images/all/Numberplate-Long/" . $img_src_long;
        $image_long    = imagecreatefrompng($source_long);


          if($emrId == 1){
           $color = imagecolorallocate($image, 1, 1, 1);
           $fontSize = 75;
           $x = 5;
           $y = 130;

             $fontSizeLong = 45;
             $fontSizeLongCode =40;
           $xCodeLong = 13;
           $xLttrLong = 248;
           $yCodeLong=  $yLttrLong = 73;
           imagettftext($image, $fontSize, 0, $x, $y, $color, $font, $text);

        }
        if($emrId == 2){
           $color = imagecolorallocate($image, 1, 1, 1); 
           $fontSize = 83;
           $x = 5;
           $y = 130;
            $fontSizeLongCode = $fontSizeLong = 50;
           $xCodeLong = 20;
           $xLttrLong = 245;
           $yCodeLong=  $yLttrLong = 75;
           imagettftext($image, $fontSize, 0, $x, $y, $color, $font, $text);

        }
         if($emrId == 3){
           $color = imagecolorallocate($image, 1, 1, 1); 
           $fontSize = 83;
           $x = 5;
           $y = 130;

            $fontSizeLongCode = $fontSizeLong = 50;
           $xCodeLong = 20;
           $xLttrLong = 100;
           $yCodeLong=  $yLttrLong = 75;
           imagettftext($image, $fontSize, 0, $x, $y, $color, $font, $text);

        }
        if($emrId == 4){
           $color = imagecolorallocate($image, 1, 1, 1); 
           $fontSize = 83;
           $x = 5;
           $y = 240;

            $fontSizeLongCode = $fontSizeLong = 50;
           $xCodeLong = 20;
           $xLttrLong = 245;
           $yCodeLong=  $yLttrLong = 75;

            imagettftext($image, $fontSize, 0, $x, $y, $color, $font, $text);

        }
        if($emrId == 5){
           $color = imagecolorallocate($image, 1, 1, 1); 
           $fontSize = 83;
           $x = 50;
           $y = 140;

            $fontSizeLongCode = $fontSizeLong = 60;
           $xCodeLong = 20;
           $xLttrLong = 220;
           $yCodeLong=  $yLttrLong = 75;
           imagettftext($image, $fontSize, 0, 190, 240, $color, $font, $code);
           imagettftext($image, $fontSize, 0, $x, $y, $color, $font, $number);
        }
        if($emrId == 6){
           $color = imagecolorallocate($image, 1, 1, 1); 
           $fontSize = 83;
           $x = 35;
           $y = 240;

           $fontSizeLong = 70;
           $xCodeLong = 20;
           $xLttrLong = 180;
           $yCodeLong = 55;
           $yLttrLong = 80;
           $fontSizeLongCode = 40;

           imagettftext($image, 60, 0, 35, 95, $color, $font, $code);
           imagettftext($image, $fontSize, 0, $x, $y, $color, $font, $number);
        }
        if($emrId == 7){
           $color = imagecolorallocate($image, 1, 1, 1); 
           $fontSize = 83;
           $x = 10;
           $y = 180;

           $fontSizeLongCode = $fontSizeLong = 60;
           $xCodeLong = 10;
           $xLttrLong = 220;
           $yLttrLong = 75;
           $yCodeLong = 75;
           imagettftext($image, $fontSize, 0, $x, $y, $color, $font, $text);

        }
    
        imagettftext($image_long, $fontSizeLongCode, 0, $xCodeLong, $yCodeLong, $color, $font, $code);
        imagettftext($image_long, $fontSizeLong, 0, $xLttrLong, $yLttrLong, $color, $font, $number);
       

		$name = microtime();
		$newname = str_replace(' ','',$name);
		$newname = str_replace('.','',$newname);
		$newname = $newname.'.png';

        $name_long =microtime().'_long.png';
        $newname_long = str_replace(' ','',$name_long);
        $newname_long = str_replace('.','',$newname_long);
        $newname_long = $newname_long.'.png';

		
        $loc = FCPATH . '/img/noplate/temp/'. $newname;
        $loc_long = FCPATH . '/img/noplate/temp/'. $newname_long;

        imagepng($image, $loc);
        imagepng($image_long, $loc_long);
        imagedestroy($image);
        imagedestroy($image_long);
        
        
       
        
        if (file_exists($temp)) {
            unlink($temp);
        }
        $loc = $base_url.'img/noplate/temp/'. $newname;
        $loc_long = $base_url.'img/noplate/temp/'. $newname_long;
        echo(json_encode(array('short'=>$loc,'long'=>$loc_long)));exit;

    }
    public function generate_nopl_temp_bike() {
        //header('Content-Type: image/png');
        // $font = 'C:\xampp\htdocs\alshamil\application\controllers\Lato-Bold.ttf';
        $font =  FCPATH.'/fonts/Lato-Bold.ttf';
        $base_url       = base_url();
        $temp           = $this->input->post('temp');
        $emrId          = $this->input->post('emrId');
        $text           = $this->input->post('res');
        $img_src        = $this->input->post('srcimg');
        $img_src_long   = $this->input->post('srcimg_long');

        $splitText = explode(" ", $text);
        $code = $splitText[0];
        $number = $splitText[1];
        if (file_exists($temp)){
                unlink($temp);
            }
         $source         = $base_url . "img/noplate/base_images/all/bike/" . $img_src;
       // $source         = "http://alshamil.bluecast.ae/img/noplate/base_images/all/bike/" . $img_src;
        $image          = imagecreatefrompng($source);

        if($emrId == 8){
           $color = imagecolorallocate($image, 1, 1, 1);
           $fontSize = 75;
           $x = 170;
           $y = 230;

            $fontSizeLongCode = $fontSizeLong = 60;
           $xCodeLong = 30;
           $xLttrLong = 245;
           $yCodeLong=  $yLttrLong = 80;

           imagettftext($image, $fontSize, 0, 50, 130, $color, $font, $code);
           
        }else{
              $color = imagecolorallocate($image, 1, 1, 1); 
           $fontSize = 86;
           $x = 45;
           $y = 240;
        }
        
        imagettftext($image, $fontSize, 0, $x, $y, $color, $font, $number);

        $name_short =time().'_short.png';
        $name_long =time().'_long.png';
        $loc_short = FCPATH . '/img/noplate/temp/'. $name_short;
        imagepng($image, $loc_short);
        $loc_short = $base_url.'img/noplate/temp/'. $name_short;
        echo(json_encode(array('short'=>$loc_short,'long'=>''))); exit;
        
    }
    public function edit_generate_noplate_temp() {
        header('Content-Type: image/png');
        $base_url = base_url();
        $temp = $this->input->post('temp');
        $emrId = $this->input->post('emrId');
        $text = $this->input->post('res');
        $img_src = $this->input->post('srcimg');

     

        $source = $base_url . "img/noplate/base_images/all/" . $img_src;
        $image = imagecreatefrompng($source);

        if ($emrId == 1) {
            $color = imagecolorallocate($image, 1, 1, 1);
            $fontSize = 95;
            $x = 50;
            $y = 130;
        }
        if ($emrId == 2) {
            $color = imagecolorallocate($image, 1, 1, 1);
            $fontSize = 95;
            $x = 45;
            $y = 130;
        }
        if ($emrId == 3) {
            $color = imagecolorallocate($image, 1, 1, 1);
            $fontSize = 95;
            $x = 45;
            $y = 130;
        }
        if ($emrId == 4) {
            $color = imagecolorallocate($image, 1, 1, 1);
            $fontSize = 95;
            $x = 45;
            $y = 240;
        }
        if ($emrId == 5) {
            $color = imagecolorallocate($image, 1, 1, 1);
            $fontSize = 95;
            $x = 45;
            $y = 240;
        }
        if ($emrId == 6) {
            $color = imagecolorallocate($image, 1, 1, 1);
            $fontSize = 95;
            $x = 45;
            $y = 40;
        }
        if ($emrId == 7) {
            $color = imagecolorallocate($image, 1, 1, 1);
            $fontSize = 95;
            $x = 45;
            $y = 40;
        }
        //$color = imagecolorallocate($image, 255, 0, 0);

        $font =  FCPATH.'/fonts/Lato-Bold.ttf';
       
		$name = microtime();
		$newname = str_replace(' ','',$name);
		$newname = str_replace('.','',$newname);
		$newname = $newname.'.png';
        imagettftext($image, $fontSize, 0, $x, $y, $color, $font, $text);

         $loc = FCPATH . '/img/noplate/nplates/'. $newname;
        imagepng($image, $loc);
        imagedestroy($image);
           if (file_exists($temp)) {
            unlink($temp);
        }
        $loc = $base_url.'img/noplate/nplates/'. $newname;
        echo $loc;exit;
    }
    public function generate_mob_temp() {
         $operator = $_POST['operator'];
        $source = $_POST['srcimg'];
        $text = $_POST['res'];
         $base_url = base_url();

        if ($operator == 'Etisalat') {
            $image = imagecreatefrompng($source);
            imagecolortransparent($image, imagecolorallocatealpha($image, 0, 0, 0, 127));
            imagealphablending($image, false);
            imagesavealpha($image, true);
            $color = imagecolorallocate($image, 255, 255, 255);
            $fontSize = 35;
            $x = 50;
            $y = 220;
            
            // $font = $_SERVER['DOCUMENT_ROOT'] .'/application/controllers/Lato-Bold.ttf';
            $font =  FCPATH.'/fonts/Lato-Bold.ttf';
            imagettftext($image, $fontSize, 0, $x, $y, -$color, $font, $text);
            $name = microtime();
			$newname = str_replace(' ','',$name);
			$newname = str_replace('.','',$newname);
			$newname = $newname.'.png';
            $loc = FCPATH . '/img/mobno/mobile/'.  $newname;
            imagepng($image, $loc);
            imagedestroy($image);
            $loc = $base_url.'img/mobno/mobile/'. $newname;
        } else if ($operator == 'DU') {
            $image = imagecreatefrompng($source);
            imagecolortransparent($image, imagecolorallocatealpha($image, 0, 0, 0, 127));
            imagealphablending($image, false);
            imagesavealpha($image, true);
            $ducolor = imagecolorallocate($image, 255, 255, 255);
            $dufontSize = 35;
            $x = 50;
            $y = 220;
            // $dufont = $_SERVER['DOCUMENT_ROOT'] .'/application/controllers/Lato-Bold.ttf';
            $font =  FCPATH.'/fonts/Lato-Bold.ttf';
            imagettftext($image, $dufontSize, 0, $x, $y, -$ducolor, $font, $text);
            $name = microtime();
			$newname = str_replace(' ','',$name);
			$newname = str_replace('.','',$newname);
			$newname = $newname.'.png';
                       
            $loc = FCPATH . '/img/mobno/mobile/'.  $newname;
            
            imagepng($image, $loc);
            imagedestroy($image);
            $loc = $base_url.'img/mobno/mobile/'. $newname;
             
        } else {
            $image = imagecreatefrompng($source);
            $color = imagecolorallocate($image,255, 255, 255);
            imagecolortransparent($image, imagecolorallocatealpha($image, 0, 0, 0, 127));
            imagealphablending($image, false);
            imagesavealpha($image, true);
            $fontSize = 35;
            $x = 50;
            $y = 220;
            // $font = $_SERVER['DOCUMENT_ROOT'] .'/application/controllers/Lato-Bold.ttf';
            $font =  FCPATH.'/fonts/Lato-Bold.ttf';
            imagettftext($image, $fontSize, 0, $x, $y, -$color, $font, $text);
            $name = microtime();
			$newname = str_replace(' ','',$name);
			$newname = str_replace('.','',$newname);
			$newname = $newname.'.png';
            $loc = FCPATH . '/img/mobno/mobile/'.  $newname;
            imagepng($image, $loc);
            imagedestroy($image);
            $loc = $base_url.'img/mobno/mobile/'. $newname;
        }
        echo $loc; exit;
    }
    public function admin_watch_list() {
    	is_admin_logged_in();
    	
        $query = $this->adm->fetch_watchlist();
        $data['records'] = $query['qry'];
        $this->load->view('admin/admin_watchlist_vw',$data);
    }
    public function watchlist_detail($trader_id,$product_id) {
     	is_admin_logged_in();
     	
        $data['qry'] = $this->adm->fetch_trader_det($trader_id,$product_id);
        $data['tr_qry'] = $this->adm->watchlist_trader($product_id);
        $this->load->view('admin/watchlist_details_vw',$data);
    }
    public function admin_flaged_list(){
		is_admin_logged_in();
        $data['records'] = $this->adm->fetch_flagedlist();
        $this->load->view('admin/admin_flaged_vw',$data);
   
	}
	public function discardFlagged($flagId=''){
		  is_admin_logged_in();
		  $this->adm->discardFlagged($flagId);
		  redirect(base_url().'admin/admin_flaged_list','location',301);
		
	}
	public function post_details($postid) {
        is_admin_logged_in();
        $data =[];
        $records = $this->adm->get_post_info($postid);
        $data['cat_type'] =  $this->adm->get_post_category($postid);
        $data['cat_qry'] = $this->adm->get_parent_category();
        $data['product_id'] = $postid;

        $data['rc'] = $records;
        $data['query_properties'] = $this->adm->get_category_properties($records->productCategoryId);
        $this->load->view('admin/new_post_details_vw',$data);  
    }
    public function admin_approve_post() {
    	is_admin_logged_in();
        $post_id = $this->input->post('post_id'); 
        $this->adm->approve_post($post_id);
        echo "success";
    }
    public function admin_reject_post() {
    	is_admin_logged_in();
        $post_id = $this->input->post('post_id'); 
        $message = $this->input->post('message');
        $trader_id = $this->input->post('trader_id');
        $this->adm->reject_post($post_id,$message);
        echo "success";
    }
    public function listAll(){
		
		is_admin_logged_in();
		
		
		$this->load->library('Ajax_pagination');
		$category_id =$this->input->get('category');
		$keyword =$this->input->get('keyword');
		$config['target']      = '#admin_home_div';
        $config['base_url']    = base_url().'admin/getpagination?category='.$category_id.'&keyword='.$keyword ;
        $totalRec = count($this->adm->get_listing_by_id($category_id,$keyword));
        $config['total_rows']  = $totalRec;
        $config['per_page']    = 4;
        $config['reuse_query_string'] = FALSE;
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;


        $this->ajax_pagination->initialize($config);
		$data['keyword'] = $keyword;
		$data['records'] =$this->adm->get_listing_by_id($category_id,$keyword,$config['per_page'] ) ;
		
		$this->load->view('admin/productlist_vw',$data);
		
	}
	public function getpagination(){
		
		$this->load->library('Ajax_pagination');
		$category_id =$this->input->get('category');
		$keyword =$this->input->get('keyword');
		$page =$this->input->get('page');

        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
         $config['reuse_query_string'] = FALSE;
        $config['per_page']    = 4;
		$config['target']      = '#admin_home_div';
        $config['base_url']    = base_url().'admin/getpagination?category='.$category_id.'&keyword='.$keyword ;
        $totalRec = count($this->adm->get_listing_by_id($category_id,$offset,$config['per_page']));
        
        $config['total_rows']  = $totalRec;
        
        
        $this->ajax_pagination->initialize($config);
        $data['records'] =$this->adm->get_listing_by_id($category_id,$config['per_page'] ,$offset,$config['per_page']  ) ;
        $this->load->view('admin/ajax_pagination_product', $data, false);
		
	}
	public function send_notifications() {
		
		$user_id['traderId'] = $this->input->post('user_id')?$this->input->post('user_id'):NULL;
        $message = $this->input->post('message');
        $plan = $this->input->post('plan')?$this->input->post('plan'):NULL;
        $deviIds=$this->adm->save_notifications($user_id,$message,$plan);
        if($deviIds){
            echo "Success"; exit;
            $this->adm->sendpush($deviIds,$message );
        }else{
            echo "Unsuccessfull";  exit;
        }
        
    }
    public function admin_freeze_trader() {
        $trader_id = $this->input->post('trader_id'); 
        $status = $this->adm->mdl_freeze_trader($trader_id);
        $data=array('what'=>$status,'status'=>"success")   ;     
        echo json_encode($data); exit;
    }
}
