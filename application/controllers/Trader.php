<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
@project 				: Alshamil
@project Module 		: TRADER 
@developrt				: Arun Vasanth Samraj 
@lastmodification date	: 14-05-2018
@controller 			: TRADER
*/
class Trader extends Public_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->Model('Trader_Model' ,'trd'); 
        is_logged_in();
    }
    //-------------------------------------- CHECk POST STATUS ------------//
    public function trader_check_addpost() {
    	
    if ($this->input->is_ajax_request() and is_allowed() ) {
         $add_post_check = $this->trd->check_trader_addpost();
         echo $add_post_check; exit;
        }
         else {
             exit('No direct script access allowed');
   		} 
    }
	//-------------------------------------- END CHECk POST STATUS ------------//
	//-------------------------------------- ADD POST ------------//
    public function add_post() {
     	
     	is_allowed();
        $page_data['title'] = 'Alshamil - Post Advertisement ';
        $page_data['page']  = 'trader_addpost'; 
		$this->load->view('client/index',$page_data);
		    
    }
	//-------------------------------------- END ADD POST ------------//
	//-------------------------------------- TRADER PROFILE ------------//
    public function profile() {
       	
            is_allowed();
            $this->load->Model('Utils_Model' ,'util'); 
             
            $session_data = $this->session->userdata('logged_in');
            $trader_id = $session_data['trader_id'];
            
            
            
            $config["per_page"] = 18;
			$cnt_appr = $this->trd->count_fetch_appr_posts();
			$total_row = count($cnt_appr);
			
			
			$url = base_url() . "trader/profile";
			$str_links = $this->util->paginate($url,$total_row);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            
          
            $data["links"] = explode('&nbsp;', $str_links);
            $data['app_qry'] = $this->trd->fetch_appr_posts($config["per_page"], $page);
            
            
            
            $data['pend_qry'] = $this->trd->fetch_pend_posts();
            $post_days_left = $this->trd->calc_rem_postdays();
            $totamt = $this->trd->calc_tot_amt();
            $trader_final_amt = $totamt;
            $data['trader_tot_amt'] = $trader_final_amt;
            
            if (count($post_days_left) > 0) {
            	
                $post_date = date_create($post_days_left[0]->planValidity);
                $curr_date = date_create(date('Y-m-d'));

 
                $diff = date_diff($curr_date, $post_date);

                $days_left = $diff->format("%R%a");
                $mod_days_left = $diff->format("%a");
                if ($days_left > 0) {
                    $data['msg'] = 'You have <b>' . $mod_days_left . '</b> days left';
                } else {
                    $data['msg'] = "<a href=".base_url()."plans>Select a Plan</a>";
                }
            } else {
                $data['msg'] = "<a href=".base_url()."plans>Select a Plan</a>";
            }



            $data['rej_qry'] = $this->trd->fetch_rej_posts();

           // $cnt_rej = $this->Trader_mdl->fetch_rej_posts();

            //echo '<pre>';print_r($data);exit();
            // echo count($data['pend_qry']);exit();
            //$cnt_appr =$total_row;
           // $cnt_pend = $this->Trader_mdl->fetch_pend_posts();
            $data['appr_post_cnt'] = $total_row;//$total_row
            $data['rej_post_cnt'] = count($data['rej_qry']);
            $data['pend_post_cnt'] = count($data['pend_qry']);
            //$data['notification'] = $this->Trader_mdl->notification_cnt();
            $notification = $this->trd->notification_cnt();

            $count = $notification['flagcnt'][0]->total_entries + $notification['notcnt'][0]->total_entries;
            $data['count'] = $count;
            $data['notification'] = $this->trd->notification_cnt();
            //$data['cat_qry'] = $this->trd->get_categories();
            //$data['recentqry'] = $this->trd->recently_viewed();


            $data['query'] = $this->trd->get_name($trader_id);
            //echo '<pre>';print_r($data);exit();
           
            $tr_sold_cnt = $this->trd->cnt_fetch_tr_solditems($trader_id);

            $total_sold_cnt = count($tr_sold_cnt);
            $tr_booked_cnt = $this->trd->cnt_fetch_tr_bookeditems($trader_id);

            $total_book_cnt = count($tr_booked_cnt);
            $tr_total_post = $this->trd->cnt_fetch_tr_totalpost($trader_id);

            $cnt = $tr_total_post[0]->totlal_post_cnt;
            $data['total_sold_cnt'] = $total_sold_cnt;
            $data['total_book_cnt'] = $total_book_cnt;
            $data['total_post'] = $cnt;
            
            
            
            
            
       
           
            
             $data['title'] = 'Alshamil - Trader Profile ';
       		 $data['page']  = 'trader_profile'; 
			 $this->load->view('client/index',$data);  
        
    }
	//-------------------------------------- END TRADER PROFILE ------------//
	//-------------------------------------- EDIT TRADER PROFILE ------------//
    public function edit_profile($trader_id) {
        is_allowed();

             
             $data['qry'] = $this->trd->fetch_trader_editdata($trader_id);
             $data['title'] = 'Alshamil - Update Trader Profile ';
       		 $data['page']  = 'trader_edit_prof_vw'; 
			 $this->load->view('client/index',$data);  
	
    }
	//-------------------------------------- END EDIT TRADER PROFILE ------------//
	//--------------------------------------  EDIT TRADER PROFILE SAVE ------------//
    public function update_trader_register(){
 	
		is_admin_logged_in();
     	
		if($this->input->post()):
     	
        

		$txtpassword =$this->input->post('txtpassword');    
 
		/*if($txtpassword!=='')
		$data['password']   = md5($txtpassword);  */

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

		$status=$this->trd->update_trader($data ,$_FILES);
		if($status){
			$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Profile updated successfully</div>');
		}
		else{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Please try again ...</div>');
    

		}       	redirect(base_url().'trader/edit_profile/'.$data['traderId'], 'location',301);
     	
		else:
		redirect(base_url(),'location',301);
		endif;
     	
	}
    //--------------------------------------  END EDIT TRADER PROFILE SAVE ------------//
    //--------------------------------------   TRADER BOOKED ITEMS ------------//
    public function trader_booked() {
           is_allowed();
       
           
            $session_data = $this->session->userdata('logged_in');
            $trader_id = $session_data['trader_id'];
            $data['query'] = $this->trd->get_name($trader_id);
            $data['booked_qry'] = $this->trd->cnt_fetch_tr_bookeditems($trader_id);
            $tr_sold_cnt = $this->trd->cnt_fetch_tr_solditems($trader_id);

            $total_sold_cnt = count($tr_sold_cnt);
            $tr_booked_cnt = $this->trd->cnt_fetch_tr_bookeditems($trader_id);

            $total_book_cnt = count($tr_booked_cnt);
            $tr_total_post = $this->trd->cnt_fetch_tr_totalpost($trader_id);

            $cnt = $tr_total_post[0]->totlal_post_cnt;
            $data['total_sold_cnt'] = $total_sold_cnt;
            $data['total_book_cnt'] = $total_book_cnt;
            $data['total_post'] = $cnt;
            
            $post_days_left = $this->trd->calc_rem_postdays();
            $totamt = $this->trd->calc_tot_amt();

            $trader_final_amt = $totamt;
            $data['trader_tot_amt'] = $trader_final_amt;
            $post_date = date_create($post_days_left[0]->planValidity);

            $curr_date = date_create(date('Y-m-d'));


            $diff = date_diff($curr_date, $post_date);

            $days_left = $diff->format("%R%a");
            $mod_days_left = $diff->format("%a");
            if ($days_left > 0) {
                $data['msg'] = 'You have <b>' . $mod_days_left . '</b> days left';
            } else {
                $data['msg'] = "<a href=".base_url()."plans>Select a Plan</a>";
            }
            
            
             $data['title'] = 'Alshamil - Trader Booked ';
       		 $data['page']  = 'trader_booked'; 
			 $this->load->view('client/index',$data);  
            
          
        
    }
    //--------------------------------------   END TRADER BOOKED ITEMS ------------//
    //--------------------------------------    TRADER SOLD ITEMS ------------//
    public function trader_sold(){
		
		    is_allowed();
		    $session_data = $this->session->userdata('logged_in');
            $trader_id = $session_data['trader_id'];
            $data['query'] = $this->trd->get_name($trader_id);
            $data['sold_qry'] = $this->trd->cnt_fetch_tr_solditems($trader_id);
            $tr_sold_cnt = $this->trd->cnt_fetch_tr_solditems($trader_id);

            $total_sold_cnt = count($tr_sold_cnt);
            $tr_booked_cnt = $this->trd->cnt_fetch_tr_bookeditems($trader_id);

            $total_book_cnt = count($tr_booked_cnt);
            $tr_total_post = $this->trd->cnt_fetch_tr_totalpost($trader_id);

            $cnt = $tr_total_post[0]->totlal_post_cnt;
            $data['total_sold_cnt'] = $total_sold_cnt;
            $data['total_book_cnt'] = $total_book_cnt;
            $data['total_post'] = $cnt;
            
            $post_days_left = $this->trd->calc_rem_postdays();
            $totamt = $this->trd->calc_tot_amt();

            $trader_final_amt = $totamt;
            $data['trader_tot_amt'] = $trader_final_amt;
            $post_date = date_create($post_days_left[0]->planValidity);

            $curr_date = date_create(date('Y-m-d'));


            $diff = date_diff($curr_date, $post_date);

            $days_left = $diff->format("%R%a");
            $mod_days_left = $diff->format("%a");
            if ($days_left > 0) {
                $data['msg'] = 'You have <b>' . $mod_days_left . '</b> days left';
            } else {
                $data['msg'] = "<a href=".base_url()."plans >Select a Plan</a>";
            }
            
            
             $data['title'] = 'Alshamil - Trader Sold ';
       		 $data['page']  = 'trader_sold'; 
			 $this->load->view('client/index',$data);  
 
		
	}
	//--------------------------------------   EDND TRADER SOLD ITEMS ------------//
	//--------------------------------------  TRADER ITEMS STATUS CHANGE ------------//
	public function change_status_book() {
		
		if ($this->input->is_ajax_request() and is_allowed() ) {
			
			 $pid = $this->input->post('pid');
             $cid = $this->input->post('cid');
             
             $data['status'] = 2;
            $status= $this->trd->change_product_status($data,$pid);
            if($status){
				echo 'success'; exit;
			}else{
				echo "failed"; exit;
			}
			
         
        }
         else {
             exit('No direct script access allowed');
   		} 
       
        
    }
    public function change_status_sold(){
    	
    	if ($this->input->is_ajax_request() and is_allowed() ) {
         
             $pid = $this->input->post('pid');
             $cid = $this->input->post('cid');
         
             $data['status'] = 1;
             $status= $this->trd->change_product_status($data,$pid);
            if($status){
				echo 'success'; exit;
			}else{
				echo "failed"; exit;
			}
         
        }
         else {
             exit('No direct script access allowed');
   		} 
		
		
	}
	public function change_status_avail(){
		
		if ($this->input->is_ajax_request() and is_allowed() ) {
			
			 $pid = $this->input->post('pid');
             $cid = $this->input->post('cid');
             
            $data['status'] = 0;
            $status= $this->trd->change_product_status($data,$pid);
            if($status){
				echo 'success'; exit;
			}else{
				echo "failed"; exit;
			}
                
        
        
        }
         else {
             exit('No direct script access allowed');
   		} 
		
	}
	//--------------------------------------  END TRADER ITEMS STATUS CHANGE ------------//
	//--------------------------------------   TRADER REMOVE SOLD ITEMS ------------//
	public function remove_solditems(){
		
		if ($this->input->is_ajax_request() and is_allowed() ) {
			
			$pid = $this->input->post('pid');
            $cid = $this->input->post('cid');
			$data['status'] = 3;
            $status= $this->trd->change_product_status($data,$pid);
            if($status){
				echo 'success'; exit;
			}else{
				echo "failed"; exit;
			}
			
			
		}	else {
             exit('No direct script access allowed');
   		} 
		
		
	}
    //--------------------------------------  END  TRADER REMOVE SOLD ITEMS ------------//
    //--------------------------------------   TRADER FLAG POST ------------//
    public function save_flagpost() {
    	
    	if ($this->input->is_ajax_request() and is_allowed() ) {
        
        
            $cat_id = $this->input->post('category_id');
            $prdt_id = $this->input->post('product_id');
            $trader_id = $this->input->post('trader_id');
            $flag_cmt = $this->input->post('flag_desc');
            $session_data = $this->session->userdata('logged_in');
            $flaguserid = $session_data['trader_id'];
            $flag_date = date('Y-m-d h:i:sa');
            $data['flagStatus'] = 1;
            $data['productId'] = $prdt_id;
            $data['productCategoryId'] = $cat_id;
            $data['traderId'] = $trader_id;
            $data['userId'] = $flaguserid;
            $data['date'] = $flag_date;
            $data['description'] = $flag_cmt;
            
            $status = $this->trd->desc_flag_insert($data);
            
            if($status){
				echo "success";exit;
			}
            
            else{
				echo "fail"; exit;
			}
            
        
        
        }
         else {
             exit('No direct script access allowed');
   		} 
       }
	//--------------------------------------   END TRADER FLAG POST ------------//
	//--------------------------------------    TRADER GET NOTIFICATIONS ------------//
	public function GetNotificationsBy() {
		if ($this->input->is_ajax_request() and is_allowed() ) {
    if($this->input->get('userId'))$where['traderId'] = $this->input->get('userId');
    $page=NULL;
    $per_page_cnt=NULL;
    $offset=NULL;
    if($this->input->get('page')&&$this->input->get('perPageCount')){
        $page = $this->input->get('page');
        $per_page_cnt = $this->input->get('perPageCount');
        $offset = $page * $per_page_cnt;
    }
    
    $result = $this->trd->get_all_notification($where,$per_page_cnt,$offset);

   
    $data['result'] = '200';
    $data['message'] = 'Notification list details retrieved';
//             $data["links"] = explode('&nbsp;', $str_links);
    $data['data'] = [
        'totalcount'=> $result['total'],
        'page' => $page,
        'perPageCount' => $per_page_cnt,
        'Post' => $result['result']
    ];
    if ($data) {
       echo json_encode($data); exit;
    } else {
       echo json_encode([]); exit;
    }
      }
         else {
             exit('No direct script access allowed');
   		} 
}
    //--------------------------------------  END  TRADER  NOTIFICATIONS ------------//
    public function logout() {
        $sess_array = array();
        $this->session->unset_userdata('logged_in', $sess_array);
        redirect(base_url(),'location',301);
    }	
    	
    
    	
   
   
   
}
