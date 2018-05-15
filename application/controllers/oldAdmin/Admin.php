<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends Admin_Controller{
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->Model('Admin_Model' ,'adm'); 
		$this->load->Model('View_Model' ,'view'); 
        
		$this->npEmritesCar  = array('1' => 'Dubai' ,
			'2' => 'Umm Al Quwain',
			'3' => 'Ajman',
			'4' => 'Ras al Khaima',
			'5' => 'Fujairah',
			'6' => 'Abu Dhabi',
			'7' => 'Sharjah');
		$this->npEmritesBike  = array('8' => 'Dubai' ,
			'9' => 'Umm Al Quwain',
			'10' => 'Ajman',
			'11' => 'Ras al Khaima',
			'12' => 'Fujairah',
			'13' => 'Abu Dhabi',
			'14' => 'Sharjah');    
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
	
	
	
	function index($data=array()){
    	
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
			$label=$this->input->post('sub_category_label');
			
			$data['Name'] = $name;
			$data['labelName'] = $label;
			$data['parentCategory'] = $category;
			$data['NameAr'] = $this->input->post('sub_category_ar');
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
		
		$data['result']=$this->adm->get_trader_row($param1);
		
		$data['tid'] = $param1;
		 
		$data['pid'] = $param2;
		
		$this->load->view('admin/plan_profile_vw',$data);
	}
	
	
	function add_post(){
		
		is_admin_logged_in();
		
		$page_data['cat_qry'] = $this->adm->get_parent_category();
		$this->load->view('admin/admin_add_post_vw',$page_data);
		
	}
    
    public function addpostview($param1=''){
		
		
		is_admin_logged_in();
    	 
		if($this->input->is_ajax_request()){  
    	 
		   $data['category_id'] = $param1; 
		   $data['query'] = $this->adm->get_rcv_categories($data['category_id']);
		   $data['query_properties'] = $this->adm->get_category_properties($data['category_id']);
		   $this->load->view('admin/addpost/ad_post_vw',$data);
       
        
		}else{
			exit('No direct script access allowed');
		}
		
		
	}
    function fetch_data() {
        $brand = $this->input->post('brand');
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->adm->get_data_for_drop_down($brand))); exit;
    }

    function savepost($param1 =''){
    	
    	is_admin_logged_in();
    	
    	if($this->input->post()):
    	
    	    $session_data = $this->session->userdata('admin_logged_in');
    	    
    	    
    	   
    	   
            $trader_id = $session_data['trader_id'];
            $cat = $this->input->post('txtcat');
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
            $query = $this->adm->get_rcv_categories($cat);
            $datam=array();
            foreach($query as $row){
				
				$data=  array('type'=>$row->type ,'lab'=>$row->lab);
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
            
            
            $insert_data[$label] = $this->input->post($value['lab']);
                       
                
            $count++;
            }
            
            $datamc=array();
            $queryproperties = $this->adm->get_category_properties($cat);
            
           
            $insert_data['productCategoryId'] = $cat;
            $insert_data['price'] = $txtprice;
            $insert_data['callForPrice'] = $call_for_price;
            $insert_data['traderId'] = $trader_id;
            $insert_data['submittedOn'] = $post_date;
            $insert_data['description'] = $this->input->post('txtdetails');
            $insert_data['postValidTill'] = '';
            $insert_data['status'] = '0';
            $id = $this->adm->insert_post($insert_data,$_FILES);
            
           
            
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
    function admin_flaged_list(){
		is_admin_logged_in();
        $data['records'] = $this->adm->fetch_flagedlist();
        $this->load->view('admin/admin_flaged_vw',$data);
   
	}
	
	function discardFlagged($flagId=''){
		  is_admin_logged_in();
		  $this->adm->discardFlagged($flagId);
		  
		  redirect(base_url().'admin/admin_flaged_list','location',301);
		
	}
	
	 public function post_details($postid) {
        is_admin_logged_in();
        $data =[];
        $records = $this->adm->get_post_info($postid);
        $data['r'] = $records;
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
    function listAll(){
		
		is_admin_logged_in();
		
		
		$this->load->library('Ajax_pagination');
		$category_id =$this->input->get('category');
		$keyword =$this->input->get('keyword');
		$config['target']      = '#admin_home_div';
        $config['base_url']    = base_url().'admin/listAll?category='.$category_id;
        $totalRec = count($this->adm->get_listing_by_id($category_id));
        
        $config['total_rows']  = $totalRec;
        $config['per_page']    = 16;

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;


        $this->ajax_pagination->initialize($config);
		$data['keyword'] = $keyword;
		$data['records'] =$this->adm->get_listing_by_id($category_id,$config['per_page'] ) ;
		
		$this->load->view('admin/productlist_vw',$data);
		
	}
}
