<?php defined('BASEPATH') OR exit('No direct script access allowed');
 require APPPATH . 'libraries/REST_Controller.php';
class Dashboard extends Admin_Controller { 
    function __construct() {
        parent::__construct();
        $this->load->helper(array(
            'form',
            'url',
            'security'
        ));
        $this->load->library(array(
            'session',
            'form_validation',
            'email'
        ));
        $this->load->database();
        $this->lang->load('db', 'english');
        $this->lang->load('form_validation', 'english');
        
        $this->load->Model('Admin_mdl');
        $this->load->Model('Trader_mdl');
        $this->load->Model('Data_mdl');
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
            if (!$this->session->userdata('logged_in')) {
             
               //$this->login_page();
              // redirect('admin/login','refresh');
            }

      
    }
 
    public function index() {
        $data['trader']         = $this->Trader_mdl->get_traders_list($type=1);
        //x$this->Trader_mdl->gethome_traders_list();
        //print_r( $data['trader']);
        $data['post_qry']       = $this->Admin_mdl->post_cnt();
        $data['sold_qry']       = $this->Admin_mdl->sold_item_cnt();
        $data['wish_qry']       = $this->Admin_mdl->wish_item_cnt();
        $data['cart_qry']       = $this->Admin_mdl->cart_cnt();
        $yearly_plan            = $this->Admin_mdl->yearly_plan_year();
        $monthly_plan           = $this->Admin_mdl->monthly_plan_year();
        $yearlyLimit_plan       = $this->Admin_mdl->yearly_limit_year();
        $individualLimit_plan   = $this->Admin_mdl->inidiv_limit_year();
        $allplan                = $this->Admin_mdl->all_plan();
        $yearly_plans = [];
        foreach ($yearly_plan as $key => $value) {
            $yearly_plans[] = array('x' => $value->date ,'y'=>(Int)$value->plan );
        }
        $data['yearly_plan_year'] = $yearly_plans;

        $monthly_plans = [];
         foreach ($monthly_plan as $key => $value) {
            $monthly_plans[] = array('x' => $value->date ,'y'=>(Int)$value->plan );
        }
        
        $data['monthly_plan'] = $monthly_plans;

        $yearly_limit = [];
         foreach ($yearlyLimit_plan as $key => $value) {
            $yearly_limit[] = array('x' => $value->date ,'y'=>(Int)$value->plan );
        }
        
        $data['yearlyLimit_plan'] = $yearly_limit;

        $indiv_limit = [];
         foreach ($individualLimit_plan as $key => $value) {
            $indiv_limit[] = array('x' => $value->date ,'y'=>!empty((Int)$value->plan)?(Int)$value->plan:0);
        }
        $data['individualLimit_plan'] = $indiv_limit;

        $all_plan = [];
        $total_plan_amount = 0;
        $total_plan_count = 0;
         foreach ($allplan as $key => $value) {
            $all_plan[] = array('x' => $value->date ,'y'=>!empty((Int)$value->plan)?(Int)$value->plan:0);
            $total_plan_amount += $value->plan;
            $total_plan_count  += $value->count;
        }
        $data['all_plan'] = $all_plan;
        $data['total_plan_amount'] = $total_plan_amount;
        if($total_plan_amount!=0)$data['avg_plan_amount'] = $total_plan_amount/$total_plan_count;

        $soldCount =  $this->Admin_mdl->totalSoldCount($type='all');
       
         $sold_count = [];
         $orderAmount = 0;
         $index =0;
         foreach ($soldCount as $key => $value) {
            $sold_count[] = array('x' => $value->date ,'y'=>!empty((Int)$value->soldCount)?(Int)$value->soldCount:0);
            $orderAmount += $value->orderAmount;
            $index ++;
        }
        $data['sold'] = $sold_count;
        $data['order_amount'] = $orderAmount;
        if($index!=0)$data['average'] = $orderAmount/$index;
        else $data['average']=0;

        $alshamilSoldCount =  $this->Admin_mdl->totalSoldCount($type='alshamil');
         $alshamil_sold_count = [];
         foreach ($alshamilSoldCount as $key => $value) {
            $alshamil_sold_count[] = array('x' => $value->date ,'y'=>!empty((Int)$value->soldCount)?(Int)$value->soldCount:0);
        }
        $data['alshamil_sold'] = $alshamil_sold_count;
         $traderSoldCount =  $this->Admin_mdl->totalSoldCount($type='trader');
         $trader_sold_count = [];
         foreach ($traderSoldCount as $key => $value) {
            $trader_sold_count[] = array('x' => $value->date ,'y'=>!empty((Int)$value->soldCount)?(Int)$value->soldCount:0);
        }
        $data['trader_sold'] = $trader_sold_count;

        $counts = $this->sideBarCounts();
        
        $data['post'] = $counts['new_post'];
        $data['total_post'] = $counts['total_post'][0]->totalPostCount;
        // $data['reg'] = $counts['new_reg'];
        // $data['yearly_plan_count'] = $counts['yearly_plan_count'];
        // $data['monthly_plan_count'] = $counts['monthly_plan_count'];
        // $data['yearly_limit_count'] = $counts['yearly_limit_count'];
        // $data['iniv_limit_count'] = $counts['iniv_limit_count'];
        $data['watchlist_count'] = $counts['watchlist'];
        $data['flaged_count'] = $counts['flaged'];
        $data['sold_count'] = $counts['sold'];
        $data['booked'] = $counts['booked'];
        $data['cart'] = $counts['cart'];
        $data['sidebar_count'] = $counts;
        if($this->session->userdata('logged_in')){
            $this->load->view('admin/dashboard_view',$data);
        }else{
            $this->login_page();
        }
        
    }

    function post_cnt() {
        $this->db->select('sum(traderPostCount) as traderPostCount');
        $post_qry = $this->db->get('trader');
        return $post_qry->result();
    }

    function sold_item_cnt() {
        $this->db->select('sum(traderSoldCount) as traderSoldCount');
        $sold_qry = $this->db->get('trader');
        return $sold_qry->result();
    }

    function wish_item_cnt() {
        $this->db->select('sum(traderWishCount) as traderWishCount');
        $wish_qry = $this->db->get('trader');
        return $wish_qry->result();
    }

    function cart_cnt() {
        $this->db->select('sum(cartlistCount) as cartlistCount');
        $cart_qry = $this->db->get('cartlist');
        return $cart_qry->result();
    }

    public function update_status($traderID) {
        $this->db->set('traderStatus', '2');
        $this->db->where('traderID', $traderID);
        if ($this->db->update('trader')) {
            return true;
        } 
        else {
            return false;
        }
    }

    public function admin_home() {
       // $home_data['qry'] = $this->Admin_mdl->all_posts();
        $counts = $this->sideBarCounts();
 
        $home_data['all_product'] = $this->Admin_mdl->getRowsProducts('all','');
    
        $home_data['bkd_product'] = $this->Admin_mdl->total_booked_prodcut();
        $home_data['sld_product'] = $this->Admin_mdl->total_sold_prodcut();

        $home_data['total_post'] =count($home_data['all_product']);
        $home_data['sold_count'] = count($home_data['sld_product']);
        $home_data['booked'] = count($home_data['bkd_product']);
        // echo "<pre>";
        // print_r($home_data['all_product']);
        // echo "</pre>";
        $home_data['sidebar_count'] = $counts;
        $this->load->view('admin/admin_home_vw',$home_data);
    }

    public function admin_add_post() {
        
       // $this->load->view('admin/admin_header2');
        $country_data['cat_qry'] = $this->Trader_mdl->get_categories();
        $counts = $this->sideBarCounts();
        $country_data['sidebar_count'] = $counts;
        $this->load->view('admin/admin_add_post_vw',$country_data);
        // $this->load->view('admin/admin_footer');
    }

    public function admin_new_post() {
        $data['result'] = $this->Admin_mdl->fetch_new_post();
        $counts = $this->sideBarCounts();
        $data['sidebar_count'] = $counts;
        $this->load->view('admin/admin_new_post_vw',$data);
    }
    
    public function post_details($postid) {
       // $data['cat_qry'] = $this->Trader_mdl->get_categories();
       $data['r'] = $this->Trader_mdl->get_post_details($postid);

       $data['brandmodels']=$this->Trader_mdl->GetBrandModels()[$data['r']->CategoryID];
       //var_dump($data['brandmodels']);
       $where=array('postID'=>$postid);
       $data['nxtimages'] = $this->Data_mdl->get_by("productiv", $where);
        $set_video=NULL;
        $video_key=NULL;
       foreach( $data['nxtimages'] as $key=>$img){
        if($this->extensionchecking($img->productImage)){
            $type=1;
        }elseif($this->extensionchecking($img->productVideo)){
            $type=2;
            $set_video=1;
            $data['Video']=$img;
            $video_key=$key;
        }else{
            $type=0;
        }
        
       $data['nxtimages'][$key]->type=$type;

       unset($data['nxtimages'][$video_key]);
       // $img->type=$type
    
       }
       $data['set_video']=$set_video;
      
        $counts = $this->sideBarCounts();
        $data['sidebar_count'] = $counts;
        $this->load->view('admin/new_post_details_vw',$data);  
    }

    public function new_registers() {
        $new_regs_data['yearly_qry'] = $this->Admin_mdl->yearlywise_regs();
        $new_regs_data['monthly_qry'] = $this->Admin_mdl->monthlywise_regs();
        $new_regs_data['yearly_limqry'] = $this->Admin_mdl->yearlylim_regs();
        $new_regs_data['indiv_qry'] = $this->Admin_mdl->indiv_regs();
        $counts = $this->sideBarCounts();
       
        $new_regs_data['sidebar_count'] = $counts;
        $this->load->view('admin/admin_new_rgs_vw',$new_regs_data);
    }

    public function fetch_trader_details() {
        if(!empty($_POST['trader_id'])) {
            $trader_id = $_POST['trader_id'];
            $row=$this->Admin_mdl->mdl_trader_details($trader_id);
     
              ?>
           
         <div class="col-lg-12">

<div class="row">

    <!-- ------ Profile details ------ -->
    <div class="col-4 pl-2 pl-sm-3 pl-md-3">
        <div class="row">

            <!-- Profile image -->
            <div class="col-12 text-center pt-lg-5 pl-0 pl-md-3 pl-sm-3">
                <img class="profileImage" src="<?php echo $row->traderImage?>" alt="">
            </div>

            <div class="col-12 text-center pt-3 px-md-3 px-sm-3 px-0">
                <!-- Name -->
                <p class="mb-2 text-orange text-s15 text-semibold text-resize"><?php if(isset($row->traderFullName))echo $row->traderFullName?></p>
            </div>

            <!-- Social Icons -->
            <div class="col-12 pt-4 mt-lg-2">
                <div class="row">

                <a href="<?php echo $row->socialWeb!=''? $row->socialWeb:'#'; ?>" target='_blank' >
                           
                            <div class="col-2 text-center ml-md-2 ml-sm-2 p-0">
                        <img class="social-icon" src="<?php if(isset($row->traderFullName))echo base_url();?>img/social-web.png" alt="">
                    </div>
                        </a>
                        
                        <a href="<?php echo $row->socialtwitter!=''? $row->socialtwitter:'#'; ?>"  >
                        <div class="col-2 text-center ml-1 p-0">
                        <img class="social-icon" src="<?php if(isset($row->traderFullName))echo base_url();?>img/social-twitter.png"  alt="">
                    </div>
                           
                        </a>
                        <a href="<?php echo $row->socialFb!=''? $row->socialFb:'#'; ?>"  >
                       
                            <div class="col-2 text-center ml-1 p-0">
                        <img class="social-icon"  src="<?php if(isset($row->traderFullName))echo base_url();?>img/social-facebook.png" alt="">
                    </div>
                        </a>
                        <a href="<?php echo $row->socialInsta!=''? $row->socialInsta:'#'; ?>"  >
                        <div class="col-2 text-center ml-1 p-0">
                        <img class="social-icon" src="<?php if(isset($row->traderFullName))echo base_url();?>img/social-instagram.png" alt="">
                    </div>
                  
                        </a>
                        <a href="<?php echo $row->socialSnap!=''? $row->socialSnap:'#'; ?>"  >
                        <div class="col-2 text-center ml-1 p-0">
                        <img class="social-icon" src="<?php if(isset($row->traderFullName))echo base_url();?>img/social-snapchat.png"  alt="">
                    </div>
               
                        </a>
                        
                      


                   

                   
                 
                  
               
                </div>
            </div>
        </div>
    </div>

    <!-- ------ Forms ------ -->
    <div class="col-8">
        <div class="row">
            <div class="col-12 bg-profileForm mt-lg-1 pt-lg-2 pb-lg-2">
                <div class="row">
                    <div class="col-6">
                        <div class="row">

                            <!-- Place -->
                            <div class="col-12 px-md-3 px-sm-3 px-2">
                                <p class="mb-0 text-s13" style="color: #696969;">Place</p>
                                <p class="mb-0 text-s13 text-semibold text-resize" style="color: #282828;"><?php if(isset($row->traderFullName))echo $row->traderLocation?></p>
                                <hr class="mt-2 mb-1">
                            </div>

                            <!-- Email -->
                            <div class="col-12 pt-2 px-md-3 px-sm-3 px-2">
                                <p class="mb-0 text-s13" style="color: #696969;">Email</p>
                                <p class="mb-0 text-s13 text-semibold text-adjust" style="color: #282828;"><?php if(isset($row->traderFullName))echo $row->traderEmailID?></p>
                                <hr class="mt-2 mb-1">
                            </div>

                            <!-- Mobile -->
                            <div class="col-12 pt-lg-2">
                                <p class="mb-0 text-s13" style="color: #696969;">Mobile</p>
                                <p class="mb-0 text-s13 text-semibold text-resize" style="color: #282828;"><?php if(isset($row->traderFullName))echo $row->traderContactNum?></p>
                                <hr class="mt-2 mb-1">
                            </div>

                            <!-- About -->
                            <div class="col-12 pt-lg-2 pb-lg-2 px-md-3 px-sm-3 px-2">
                                <p class="mb-0 text-s13" style="color: #696969;">About</p>
                                <p class="mb-0 text-s13 text-semibold text-truncate-4 text-resize" style="color: #282828;"><?php if(isset($row->traderInfo))echo $row->traderInfo?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Attachments -->
                    <div class="col-6 vbl mt-lg-3 mb-lg-2 pl-lg-4 pr-lg-4">
                        <div class="row">
                            <div class="col-12 pl-lg-4 pr-lg-4 pb-1">
                                <p class="mb-1 text-s13" style="color: #696969;">Attachments</p>
                            </div>
               
                            <!-- First -->
                            <div class="col-12 pl-lg-4 pr-lg-4 pb-3">
                            <a download="attachment1.jpg" href="<?php if(isset($row->traderIDProof))echo $row->traderIDProof?>" title="ImageName">
                            <img class="profile-attachments" src="<?php if(isset($row->traderIDProof))echo $row->traderIDProof?>" alt="">
                        </a>
                              
                            </div>

                            <!-- Second -->
                            <div class="col-12 pl-lg-4 pr-lg-4">
                            <a download="attachment1.jpg" href="<?php if(isset($row->traderIDProof))echo $row->traderIDProof?>" title="ImageName">
                            <img class="profile-attachments" src="<?php if(isset($row->traderIDProofsecond))echo $row->traderIDProofsecond?>" alt="">
                        </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Buttons -->
<div class="row pt-4 pb-lg-2">
    <div class="col-12">
        <div class="row">
            <div class="col-sm-6 col-12 mx-auto">
                <div class="row">
                 <!-- Edit -->
           
                   <div class="col-4 pl-1 pr-1">
                 <a href='<?php echo base_url('admin/Dashboard/admin_edit_trader/').$row->traderID; ?>' >
                        <button class="btn btn-orange w-100 pt-1 pb-1 text-s14" >
                            Edit
                        </button>
        </a>
                    </div> 

                    <!-- Approve -->
                    <div class="col-4 pl-1 pr-1">
                        <button class="btn btn-green w-100 pt-1 pb-1 text-s14 approveButton" <?php if($row->planStatus!=0)echo "disabled"; ?> value="<?php echo $row->traderID?>" data-plan="<?php echo $row->tplanID?>">
                            Approve
                        </button>
                    </div>

                    <!-- Reject -->
                    <div class="col-4 pl-1 pr-1">
                        <button class="btn btn-red w-100 pt-1 pb-1 text-s14 rejectButton" <?php if($row->planStatus!=0)echo "disabled"; ?> value="<?php echo $row->traderID?>">
                            Reject
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.Buttons -->

</div>


        <?php

        
        }
        else {
        // echo "No Id passed";
        }
        //echo '<pre>';print_r($data);
    }
    function fetch_bikemodel() {
        $brand = $_POST['brand'];
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->Admin_mdl->get_model_bike($brand)));
    }
    public function admin_edit_trader($traderId) {
        $counts = $this->sideBarCounts();
        $data['sidebar_count'] = $counts;
        $data['result']=$this->Admin_mdl->mdl_trader_alldetails($traderId);
        $this->load->view('admin/admin_edit_trader_vw',$data);
    }
    public function update_trader_register() {

        $traderid = $_POST['txthid_trid'];
        $trader_profimg = $_FILES['profimg']['name'];
        $em_idproof1 = $_FILES['traderIDProof']['name'];
        $em_idproof2 = $_FILES['traderIDsecond']['name'];


        $txtname = $_POST['txtname'];
        $txtplace = $_POST['txtplace'];
        $country_code = $_POST['countrycode'];
        $txtmob = $_POST['txtmob'];
        $txtemail = $_POST['txtemail'];
       // $txtuname = $_POST['txtuname'];
        $txtpassword = $_POST['txtpassword'];
        $txtweblink = $_POST['txtweblink'];
        $txtfblink = $_POST['txtfblink'];
        $txtinstlink = $_POST['txtinstlink'];
        $txtsnapclink = $_POST['txtsnapclink'];
        $txttwitterclink = $_POST['txttwitter'];
        $txt_trdetail = $_POST['txtabout'];
        if ($trader_profimg != '') {

            $config['upload_path'] = 'uploads/trader_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $trader_profimg;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('profimg')) {
                $uploadData = $this->upload->data();

                //$prof_img = $uploadData['file_name'];
                $prof_img = base_url() . 'uploads/trader_images/' . $trader_profimg;
            }
        } else {

            $prof_img = $_POST['txthid_tr_primg'];
        }
        if ($em_idproof1 != '') {
            $config['upload_path'] = 'uploads/trader_emirates_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $em_idproof1=time().'_id1.'.pathinfo($em_idproof1, PATHINFO_EXTENSION);
            $config['file_name'] = $em_idproof1;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('traderIDProof')) {
                $uploadData = $this->upload->data();

                $emprof_img1 = base_url() . 'uploads/trader_emirates_images/' . $em_idproof1;
            } else {
                $emprof_img1 = '';
            }
        } else {
            $emprof_img1 = $_POST['txthid_tr_emimg1'];
        }

        if ($em_idproof2 != '') {
            $config['upload_path'] = 'uploads/trader_emirates_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $em_idproof2=time().'_id2.'.pathinfo($em_idproof2, PATHINFO_EXTENSION);
            $config['file_name'] = $em_idproof2;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('traderIDsecond')) {
                $uploadData = $this->upload->data();

                $emprof_img2 = base_url() . 'uploads/trader_emirates_images/' . $em_idproof2;
            } else {
                $emprof_img2 = '';
            }
        } else {
            $emprof_img2 = $_POST['txthid_tr_emimg2'];
        }
        $data = array(
            'traderFullName' => $txtname,
          //  'traderUserName' => $txtuname,
            'traderPasswd' => $txtpassword,
            'traderContactNum' => $country_code . " " . $txtmob,
            'traderEmailID' => $txtemail,
            'traderImage' => $prof_img,
            'traderIDProof' => $emprof_img1,
            'traderIDProofsecond' => $emprof_img2,
            'socialWeb' => $txtweblink,
            'socialFb' => $txtfblink,
            'socialInsta' => $txtinstlink,
            'socialSnap' => $txtsnapclink,
            'socialtwitter' => $txttwitterclink,
            'traderLocation' => $txtplace,
            'usertype' => 1,
            'traderInfo' => $txt_trdetail
        );
        $this->db->where('traderID', $traderid);
        if ($this->db->update('trader', $data)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Profile updated successfully</div>');
       
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Please try again ...</div>');
    
        }
       redirect('admin/Dashboard/admin_edit_trader/'.$traderid, 'refresh');
        
    }
    public function admin_freeze_trader() {
        $trader_id = $_POST['trader_id']; 
        $this->Admin_mdl->mdl_freeze_trader($trader_id);
        echo "success";
    }

    public function admin_approve_trader() {
        $trader_id = $_POST['trader_id']; 
        $plan_id = $_POST['plan_id']; 
        $this->Admin_mdl->mdl_approve_trader($trader_id,$plan_id);
        echo "success";
    }

    public function admin_reject_trader() {
        $trader_id = $_POST['trader_id']; 
        $this->Admin_mdl->mdl_reject_trader($trader_id);
        echo "success";
    }

    public function admin_approve_post() {
        $post_id = $_POST['post_id']; 
        $this->Admin_mdl->mdl_approve_post($post_id);
        echo "success";
    }

    public function admin_reject_post() {
        $post_id = $_POST['post_id']; 
        $message = $_POST['message'];
        $trader_id = $_POST['trader_id'];
        $this->Admin_mdl->mdl_reject_post($post_id,$message);
      //  $this->Admin_mdl->checkPostCount($post_id,$trader_id ); // Need clarification
        echo "success";
    }

    public function car_add_post() {
        $counts = $this->sideBarCounts();
        $data['sidebar_count'] = $counts;
        $this->load->view('admin/ad_car_post_vw',$data);
    }

    public function mobile_add_post() {
        $counts = $this->sideBarCounts();
        $data['sidebar_count'] = $counts;
        $this->load->view('admin/ad_mobile_post_vw',$data);
    }

    public function verwatch_add_post() {
        $counts = $this->sideBarCounts();
        $data['sidebar_count'] = $counts;
        $this->load->view('admin/ad_verwatch_post_vw',$data);
    }

    public function number_add_post() {
        $counts = $this->sideBarCounts();
        $data['sidebar_count'] = $counts;
        $this->load->view('admin/ad_numberplate_post_vw',$data);
    }

    public function prop_add_post() {
        $counts = $this->sideBarCounts();
        $data['sidebar_count'] = $counts;
        $this->load->view('admin/ad_prop_post_vw',$data);
    }

    public function approve_post() {
        $post_id = $_POST['post_id'];
        $this->Admin_mdl->mdl_approve_post($post_id);
        echo "success";
    }

    public function reject_post() {
        $post_id = $_POST['post_id'];
        $msg= $_POST['msg'];
        $this->Admin_mdl->mdl_reject_post($post_id);
        echo "success";
    }

    public function admin_flaged_list() {
        $data['records'] = $this->Admin_mdl->fetch_flagedlist();
      
        $counts = $this->sideBarCounts();
        $data['sidebar_count'] = $counts;
        $this->load->view('admin/admin_flaged_vw',$data);
    }

    public function admin_watch_list() {
        $query = $this->Admin_mdl->fetch_watchlist();
      
        $data['records'] = $query['qry'];
        $counts = $this->sideBarCounts();
        $data['sidebar_count'] = $counts;
        // $data['count'] = $query['count'];
        // echo '<pre>';print_r($data);exit();
        //$data['qry'] = $this->Admin_mdl->fetch_watchlist();
        $this->load->view('admin/admin_watchlist_vw',$data);
    }

    public function watchlist_detail($trader_id,$product_id) {
        $data['qry'] = $this->Admin_mdl->fetch_trader_det($trader_id,$product_id);
        $data['tr_qry'] = $this->Admin_mdl->watchlist_trader($product_id);
        $counts = $this->sideBarCounts();
        $data['sidebar_count'] = $counts;
        $this->load->view('admin/watchlist_details_vw',$data);
    }
    
    public function view_plan($planid) {
        switch ($planid) {
            case 1:
                $data['plan_name'] = "YEARLY PLAN";
                $data['planid'] = $planid;
                break;
            case 2:
                $data['plan_name'] = "MONTHLY PLAN";
                $data['planid'] = $planid;
                break;
            case 3:
                $data['plan_name'] = "YEARLY LIMITED PLAN";
                $data['planid'] = $planid;
                break;
            default:
                $data['plan_name'] = "INDIVIDUAL PLAN";
                $data['planid'] = $planid;
        }
        $counts = $this->sideBarCounts();
        $data['sidebar_count'] = $counts;
        $data['qry'] = $this->Admin_mdl->fetch_planusers($planid);
        $this->load->view('admin/ad_yearly_plan_vw',$data);
    }

/****todo */

/*
    public function view_yrlyplan() {
        $counts = $this->sideBarCounts();
        $data['sidebar_count'] = $counts;
        $data['qry'] = $this->Admin_mdl->fetch_yearlywise();
        $this->load->view('admin/ad_yearly_plan_vw',$data);
    }

    public function view_monthlyplan() {
        $counts = $this->sideBarCounts();
        $data['sidebar_count'] = $counts;
        $data['qry'] = $this->Admin_mdl->fetch_monthlywise();
        $this->load->view('admin/ad_yearly_plan_vw',$data);
    }

    public function view_yrly_lim() {
        $counts = $this->sideBarCounts();
        $data['sidebar_count'] = $counts;
        $data['qry'] = $this->Admin_mdl->fetch_yrlylim();
        $this->load->view('admin/ad_yearly_plan_vw',$data);
    }

    public function view_indivi() {
        $counts = $this->sideBarCounts();
        $data['sidebar_count'] = $counts;
        $data['qry'] = $this->Admin_mdl->fetch_indivi();
        $this->load->view('admin/ad_yearly_plan_vw',$data);
    }
*/
    public function yearly_profile($pid) {
        $counts = $this->sideBarCounts();
        $data['sidebar_count'] = $counts;
        $data['result'] = $this->Admin_mdl->fetch_indivi();
        $this->load->view('admin/yrly_plan_profile_vw',$data);
    }
    
    public function plan_profile($tid,$plan='') {
        $counts = $this->sideBarCounts();
        $data['sidebar_count'] = $counts;
        $data['result']=$this->Admin_mdl->mdl_trader_alldetails($tid);
        
        $data['total_sell_amount']=$this->Trader_mdl->totalSoldAmount($tid);
        $data['total_sold']=$this->Trader_mdl->totalSold($tid);
        $data['total_cart']=$this->Trader_mdl->totalCart($tid);

        $data['totalWatchlist']=$this->Trader_mdl->totalWatchlist($tid);
        
        // echo "<pre>";
        // print_r($data);
        // echo "<pre>";
       // $data['posts'] = $this->Admin_mdl->trader_all_posts($tid);
 
        $this->load->Model('Api_mdl');
        $data['notifications'] = $this->Api_mdl->get_all_notification(array('traderID'=>$tid),NULL,NULL);
        $data['traderId'] = $tid; 
        $data['planId'] = $plan;
        $data['pending'] =  $this->Admin_mdl->getPostByStatus($plan,0,$tid,'count');
        $data['apprvd'] =  $this->Admin_mdl->getPostByStatus($plan,1,$tid,'count');
        $data['reject'] =  $this->Admin_mdl->getPostByStatus($plan,'-1',$tid,'count');
        $this->load->view('admin/yrly_plan_profile_vw',$data);
    }

    public function edit_userplan() {
        
        if(!empty($_POST['trader_id'])) {
            $trader_id = $_POST['trader_id'];
            $traderdetails=$this->Admin_mdl->get_trader_details($trader_id);
            echo ' <form > <div class="row">
                        <div class="col-sm-12 123">
                            <div class="form-group">
                                <label for="txtemail">Valid Till</label> 
                                <input type="text" data-type="date_validity" data-date-format="yyyy-mm-dd" name="date_validity" id="date_validity" value="'.set_value("date_validity",$traderdetails->planValidity).'" class="form-control reginputs date_validity" data-provide="datepicker">
                            </div>
                            <div class="form-group">
                                <label for="txtemail">Posts Extended</label>
                                <input type="number" data-type="post_validity" name="post_validity" id="post_validity" value="'.set_value("post_validity".$traderdetails->planPostCount).'" class="form-control reginputs post_validity">
                            </div>
                            <span class="errmsg"><?php echo form_error("txtemail")?></span>
                            <button style="background-color: orange;color:#fff;border-radius: 9px;" id="plan_save" class="btn btn-large btn-block" value="'.$trader_id.'">Save</button>
                        </div>
                    </div></form><script>
                  
                    </script>';
        }
    }

    public function save_userplan() {
        if($_POST['post_validity']!='')$data["planPostCount"]=$_POST['post_validity'];
        if($_POST['date_validity']!='')$data["planValidity"]=$_POST['date_validity'];
         $where=array(
            "traderID"=>$_POST['trader_id']
        );
       if($this->Data_mdl->update($data,$where,"tradersubscriptionplan"))echo "success";
      
    }

    public function sideBarCounts() {
        $count['new_post'] = $this->Admin_mdl->new_posts();
        $count['new_reg'] = $this->Trader_mdl->new_registers();
        $count['yearly_plan_count'] = count($this->Admin_mdl->fetch_planusers(1)); 
        $count['monthly_plan_count'] =  count($this->Admin_mdl->fetch_planusers(2));
        $count['yearly_limit_count'] = count( $this->Admin_mdl->fetch_planusers(3));
        $count['iniv_limit_count'] = count($this->Admin_mdl->fetch_planusers(4)); 
        $count['watchlist'] = count($this->Admin_mdl->fetch_watchlist()['qry']);

        $count['flaged'] = $this->Admin_mdl->flaggedCount();
        $count['sold'] = $this->Trader_mdl->total_sold_count();
        $count['booked'] = $this->Trader_mdl->total_booked_count();
        $count['cart'] = $this->Trader_mdl->total_cart_count();
        $count['total_post'] = $this->Admin_mdl->post_cnt();
        return $count;
    }

    public function extensionchecking($url) {
        if (preg_match('/\.(jpeg|jpg|png|gif)$/i', $url)) {
            return 1;
        }
        elseif(preg_match('/\.(mp4|flv|mpeg|mkv)$/i', $url)) {
            return 2;
        }
        else {
            return 0;
        }
    }

    
    public function login_page($data=array()){
        
            $this->load->view('admin/start_page',$data);
     
        
    }
    public function login_post() {
        if (!empty($_REQUEST['txtemail']) && (!empty($_REQUEST['txtpassword']))) {
            $txtemail = $_REQUEST['txtemail'];
            $txtpassword = $_REQUEST['txtpassword'];
            $txtusertype = 3;
            //if(isset($_REQUEST['deviceId']))$deviceId = $_REQUEST['deviceId'];

            $result = $this->Admin_mdl->get_traderlist($txtemail, $txtpassword, $txtusertype);
            if($result)
            {
                $sess_array = array();
                foreach ($result as $row) {
                    $sess_array = array(
                        'trader_id' => $row->traderID,
                        'txtemail' => $row->traderEmailID,
                        'txtusertype' => $row->usertype
                    );

                    $this->session->set_userdata('logged_in', $sess_array);
                }
              $this->index();
            }
             else
             {

                $data['result'] = '100';
                $data['message'] = ' Login Failed ! Please check the username/password';
                $this->login_page($data);

                
                //$this->response($data, REST_Controller::HTTP_BAD_REQUEST);
             }
          
        } else {
            $data['result'] = '100';
            $data['message'] = 'please enter your details';
            if($this->session->userdata('logged_in')){
                $this->load->view('admin/dashboard_view',$data);
            }else{

                $this->login_page();
            }
            //$this->response($data, REST_Controller::HTTP_BAD_REQUEST);
        }
        
        //$this->index();
    }
    public function logout(){
         $this->session->sess_destroy();
         $this->login_page($data=array());
    }
    //    public function admin_add_post() {
    //     if (isset($_SESSION['admin_sess'])) {
    //         $this->load->view('admin/admin_header');
    //         $country_data['cat_qry'] = $this->Trader_mdl->get_categories();
    //         $this->load->view('admin/admin_add_post_vw', $country_data);
    //         $this->load->view('admin/admin_footer');
    //     } else {
    //         $this->index();
    //     }
    // }
        function car_addpostview($category_id) {
        $country_data['cat_qry'] = $this->Trader_mdl->get_categories();
        $country_data['category_id'] = $category_id;
        $country_data['query'] = $this->Admin_mdl->get_brand_car($category_id);
        
        $this->load->view('admin/addpost/ad_car_post_vw',$country_data);
    }
    function bike_addpostview($category_id)
    {
         $country_data['cat_qry'] = $this->Trader_mdl->get_categories();
        $country_data['category_id'] = $category_id;
        $country_data['query'] = $this->Admin_mdl->get_brand_car($category_id);
        
        $this->load->view('admin/addpost/ad_bike_post_vw',$country_data);
    }
    function noplate_addpostview($category_id)
    {
        
        $country_data['category_id'] = $category_id;
        
        $country_data['cat_qry'] = $this->Trader_mdl->get_categories();
        $country_data['template_qry'] = $this->Admin_mdl->get_templatesByType($type=0);
         $this->load->view('admin/addpost/ad_noplate_post_vw',$country_data);
    }
    function vertu_addpostview($category_id)
    {
         $country_data['cat_qry'] = $this->Trader_mdl->get_categories();
        $country_data['category_id'] = $category_id;
        $country_data['query'] = $this->Admin_mdl->get_brand_car($category_id);
        
        $this->load->view('admin/addpost/ad_vertu_post_vw',$country_data);
    }
    function watch_addpostview($category_id)
    {
         $country_data['cat_qry'] = $this->Trader_mdl->get_categories();
        $country_data['category_id'] = $category_id;
        $country_data['query'] = $this->Admin_mdl->get_brand_car($category_id);
        //echo '<pre>';print_r($country_data);exit();
        $this->load->view('admin/addpost/ad_watch_post_vw',$country_data);
    }
    function mobile_addpostview($category_id)
    {
         $country_data['cat_qry'] = $this->Trader_mdl->get_categories();
        $country_data['category_id'] = $category_id;
        $country_data['query'] = $this->Trader_mdl->get_brand_boat($category_id);

        
        $this->load->view('admin/addpost/ad_mobile_post_vw',$country_data);
    }
    function fetch_mob_pref()
    {
        $mob_oper = $_POST['mob_oper'];
        header('Content-Type: application/x-json; charset=utf-8');
       echo(json_encode($this->Trader_mdl->get_mobprefix($mob_oper)));
        
    }
    function fetch_temp_code()
    {
       $emirates = $_POST['emirates'];
          header('Content-Type: application/x-json; charset=utf-8');
          echo(json_encode($this->Trader_mdl->get_template_code($emirates)));
        
    } 
    function boat_addpostview($category_id)
    {
         $country_data['cat_qry'] = $this->Trader_mdl->get_categories();
        $country_data['category_id'] = $category_id;
        $country_data['query'] = $this->Admin_mdl->get_brand_car($category_id);
        
        $this->load->view('admin/addpost/ad_boat_post_vw',$country_data);
    }
    function phone_addpostview($category_id)
    {
         $country_data['cat_qry'] = $this->Trader_mdl->get_categories();
        $country_data['category_id'] = $category_id;
        $country_data['query'] = $this->Admin_mdl->get_brand_car($category_id);
        
        $this->load->view('admin/addpost/ad_phone_post_vw',$country_data);
    }
    function property_addpostview($category_id)
    {
        $country_data['cat_qry'] = $this->Trader_mdl->get_categories();
        $country_data['category_id'] = $category_id;
        $country_data['prop_qry'] = $this->Admin_mdl->get_subproperties($category_id);
       
        
        $this->load->view('admin/addpost/ad_property_post_vw',$country_data);
    }
    function forgotpassword(){
        //$this->load->library('email');
    $config['protocol'] = 'sendmail';
    $config['mailpath'] = '/usr/sbin/sendmail';
    $config['charset'] = 'iso-8859-1';
    $config['wordwrap'] = TRUE;
    $config['protocol'] = 'smtp';
    $config['smtp_host'] = 'gsmtp.gmail.comm';
    $config['smtp_user'] = 'xxxxxx@gmail.com';
    $config['smtp_pass'] = 'xxxxxx';
    $config['smtp_port'] = 587;


    $this->email->initialize($config);
    $this->email->from('signrtestinst@gmail.com', 'ANJU');
    $this->email->to('pcgtestproject@gmail.com');

    $this->email->subject('Email Test');
    $this->email->message('Testing the email class.');

    $this->email->send();
    }
    function discardFlagged($flagId){
        $this->Admin_mdl->discardFlagged($flagId);
        $this->admin_flaged_list();
    }
     function send_notifications() {
        $user_id['traderID'] = isset($_POST['user_id'])?$_POST['user_id']:NULL;
        $message = $_POST['message'];
        $plan = isset($_POST['plan'])?$_POST['plan']:NULL;
     
        $deviIds=$this->Admin_mdl->save_notifications($user_id,$message,$plan);
     
        if($deviIds){
            echo "Success";
            $this->Admin_mdl->sendpush($deviIds,$message );
        }else{
            echo "Unsuccessfull";
        }
        
    }
    function getPostByStatus($plan,$status,$trader){
       $result =  $this->Admin_mdl->getPostByStatus($plan,$status,$trader,'all');
       $data=[];
       $index=1;
       $product_status=NULL;
       if(count($result)>0 && !empty($result) && isset($result)){
           foreach ($result as $key => $value) {
        if($status==1){
            switch($value['AvailablitiyStatus']){
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
           
           $data []  = array('sl_no' =>$index ,'product' => $value['Brand'] .'-'. $value['Model'],'price'=>$value['Price'],'date_of_post'=>$value['SubmitDate'],'status'=>$product_status,'view'=>'<a class="btn btn-success" href="'.base_url().'admin/Dashboard/post_details/'.$value['postID'].'">view post</a>','wished_list'=>$value['traderWatchCount']);
           //'wished_list'=>$value['watchlistCount'],'view'=>'<a href="'.base_url().'admin/Dashboard/post_details/'.$value['TraderID'].'">view post</a>');
       
           $index++;
        }
       }
    
       echo json_encode(array('data'=>$data));
    }
    function removeSoldFromHome(){

        $postId = $_REQUEST['post_id'];
        $result =  $this->Admin_mdl->removeSoldItem($postId);
        if($result){
            echo "Success"; 
        }else{
            echo "Failed"; 
        }
    }
    public function view_all_traders() {
            $counts = $this->sideBarCounts();
            $trader_data['sidebar_count'] = $counts;
            $query = $this->Trader_mdl->mdl_all_traders();
        
            $trader_data['records'] = $query['records'];
            $trader_data['count'] = $query['count'];
            $trader_data['recentqry'] = $this->Trader_mdl->recent_view();
            $this->load->view('admin/all_traders', $trader_data);
        
    }
    public function check_p() {
        phpinfo();
    }
    public function sendpush() {
            #API access key from Google API's Console
            define( 'API_ACCESS_KEY', 'AAAAt1-_IHo:APA91bEN-Moq4Y-SFNRGW3CTgjXl8c8ZbDCbkd5XWpPhwh3TmbIWqTyV583wIXEc-m9ZB-tY3ow28QZfMZ8Oc-fRTjftcL9_zXJzA_oTNlG7KhYzDDNzpkNrgTaYtCIaPSwcs34jTTh9' );
            //$registrationIds = $_GET['id'];
            $registrationIds = 'fKOLhxS9coQ:APA91bE13tHl61mVUwoMxT4Obt6L5N4bMCw2VvfPIOWE7JzZH1JAQ0TAWIO9R-lonBm17AVlA7X8GhyxaWyS3qhEkDeUczZE-fP_h2x8TKLvB4c0T5xyNdqpSlIiDaR86DpOn4YWq00V';
        #prep the bundle
            $msg = array
                (
                'body'  => 'Body of Alshamil Notification',
                'title' => 'Title Of Alshamil Notification',
                        'icon'  => 'myicon',/*Default Icon*/
                        'sound' => 'mySound'/*Default sound*/
                );
            $fields = array
                    (
                        'to'        => $registrationIds,
                        'notification'  => $msg
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
        echo $result;
    }
    public function privacy_policy(){
      
        $this->load->view('trader/privacy-policy');
       
        
    }
    public function terms_conditions(){
       
        $this->load->view('trader/terms-conditions');
      
        
    }
    function fetch_temp_img() {
        $emirates = $_POST['emirates'];
        $type = $_POST['type'];
        $temp_img_qry = $this->Admin_mdl->get_template_imgs($emirates,$type);
        $img_src = $temp_img_qry;          
        header('Content-Type: application/x-json; charset=utf-8');

         echo(json_encode($img_src[0]));
    }

        function generate_nopl_temp() {
        //header('Content-Type: image/png');
        // $font = 'C:\xampp\htdocs\alshamil\application\controllers\Lato-Bold.ttf';
        $font = dirname(__FILE__) . '/../../../assets/fonts/Lato-Bold.ttf';
        $base_url       = base_url();
        $temp           = $_POST['short_tempImg'];
        $emrId          = $_POST['emrId'];
        $text           = $_POST['res'];
        $img_src        = $_POST['srcimg'];
        $img_src_long   = $_POST['srcimg_long'];

        $splitText = explode(" ", $text);
        $code = trim($splitText[0]);
        $number = trim($splitText[1]);
        if (file_exists($temp)){
                unlink($temp);
            }
        
        $source         = $base_url . "img/noplate/base_images/" . $img_src;
        $image          = imagecreatefrompng($source);

        $source_long        = $base_url . "img/noplate/base_images/all/Numberplate-Long/" . $img_src_long;
        $image_long          = imagecreatefrompng($source_long);

        //$font = '/var/www/html/alshamil/fonts/Lato-Bold.ttf';
        
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

        $name_short =time().'_short.png';
        $name_long =time().'_long.png';
        $loc_short = $_SERVER['DOCUMENT_ROOT'] . '/img/noplate/temp/'. $name_short;
        $loc_long = $_SERVER['DOCUMENT_ROOT'] . '/img/noplate/temp/'. $name_long;
        imagepng($image, $loc_short);
        imagepng($image_long, $loc_long);
        imagedestroy($image);
        $loc_short = $base_url.'img/noplate/temp/'. $name_short;
        $loc_long = $base_url.'img/noplate/temp/'. $name_long;
        echo(json_encode(array('short'=>$loc_short,'long'=>$loc_long)));
        
    }

    function generate_nopl_temp_bike() {
        //header('Content-Type: image/png');
        // $font = 'C:\xampp\htdocs\alshamil\application\controllers\Lato-Bold.ttf';
        $font = dirname(__FILE__) . '/../../../assets/fonts/Lato-Bold.ttf';
        $base_url       = base_url();
        $temp           = $_POST['short_tempImg'];
        $emrId          = $_POST['emrId'];
        $text           = $_POST['res'];
        $img_src        = $_POST['srcimg'];
        $img_src_long   = $_POST['srcimg_long'];

        $splitText = explode(" ", $text);
        $code = $splitText[0];
        $number = $splitText[1];
        if (file_exists($temp)){
                unlink($temp);
            }
        
        $source         = $base_url . "img/noplate/base_images/all/bike/" . $img_src;
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
           $fontSize = 90;
           $x = 45;
           $y = 240;
        }
        
        imagettftext($image, $fontSize, 0, $x, $y, $color, $font, $number);

        $name_short =time().'_short.png';
        $name_long =time().'_long.png';
        $loc_short = $_SERVER['DOCUMENT_ROOT'] . '/img/noplate/temp/'. $name_short;
        imagepng($image, $loc_short);
        $loc_short = $base_url.'img/noplate/temp/'. $name_short;
        echo(json_encode(array('short'=>$loc_short,'long'=>'')));
        
    }
    public function save_noplatepost() {
       
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        
        $post_date = date('Y-m-d H:i:sa');
        $temp = $_POST['short_tempImg'];
        $temp_long = $_POST['long_tempImg'];
        $nplates = str_replace("temp", "nplates", $temp);

        //rename($temp, $nplates);

        $cat = $_POST['txtcat'];
        if($_POST['vehicle_type']==1)
            $emirates = $this->npEmritesBike[$_POST['txtemirates']];
        else
            $emirates = $this->npEmritesCar[$_POST['txtemirates']];
        $txtemirates = $_POST['txtemirates'];
        $txtcode = $_POST['txtcode'];
        $txtno_digs = $_POST['txtno_digs'];
        $txtno = $_POST['txtnumber'];
        $txtprice = $_POST['txtprice'];
        $txtdetails = $_POST['txtdetails'];
        //$session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        if (isset($_POST['price'])) {
            $call_for_price = 1;
            $txtprice = '';
        } else {
            $call_for_price = 0;
            $txtprice = $_POST['txtprice'];
        }

        $tr_user_type = $_SESSION['logged_in']['txtusertype'];
        if ($tr_user_type == 3 || $tr_user_type == 2) {
            $prdt_ctype = 1;
        } else {
            $prdt_ctype = 0;
        }

        $data = array();

        $data['cartNPType'] = $prdt_ctype;
        $data['traderID'] = $trader_id;
        $data['productLocation'] = '';
        $data['productCategoryID'] = '3';
        $data['productCategoryName'] = 'number plate';
        $data['productNPEmrites'] = $emirates;
        $data['productNPTemplate'] = '1';
        $data['productNPCode'] = $txtcode;
        $data['productNPDigits'] = $txtno_digs;
        $data['NPpost_main_img'] = $temp;

        $data['productNPNmbr'] = $txtno;
        $data['productNPPrice'] = $txtprice;
        $data['productNPCallPrice'] = $call_for_price;
        $data['productNPDesc'] = $txtdetails;
        $data['productNPSubmitDate'] = $post_date;
        $this->db->insert('productnp', $data);
        $last_prd_id = $this->db->insert_id();

        $postdata['productCategoryID'] = '3';
        $postdata['productID'] = $last_prd_id;
        $postdata['traderID'] = $trader_id;
        $postdata['postDesc'] = $txtdetails;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '1';
        $this->db->insert('post', $postdata);
        $last_post_id = $this->db->insert_id();

        $saveSecImage = $this->Admin_mdl->saveSecondImage($last_prd_id,$temp_long,$last_post_id,$cat);

        $qry = $this->Trader_mdl->category_count($cat);
        $traderqry = $this->Trader_mdl->trader_post_count($trader_id);
        if(count($traderqry) == 0)
        {
            $update_tr_post_cnt = 1;
            $cat_cnt = $qry[0]->categoryProductCount;
            $update_cat_cnt = $cat_cnt + 1;
        }
        else
        {
           $tr_post_cnt = $traderqry[0]->traderPostCount;
            $cat_cnt = $qry[0]->categoryProductCount;
            $update_cat_cnt = $cat_cnt + 1;
            $update_tr_post_cnt = $tr_post_cnt + 1;
        }
        
        $cdata['categoryProductCount'] = $update_cat_cnt;
        $this->db->where('productCategoryID', '3');
        $this->db->update('category', $cdata);

        $tdata['traderPostCount'] = $update_tr_post_cnt;
        $this->db->where('traderID', $trader_id);
        if($this->db->update('trader', $tdata)){
         //   $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Your Product is added successfully</div>');
         $this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-success text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Your Product is Added Successfully</div></div></div>');
         redirect($_SERVER['HTTP_REFERER']);
        }else{
           // echo 'error';
           redirect($_SERVER['HTTP_REFERER']);
        }
     
        
    }
    function generate_mob_temp() {
        $operator = $_POST['operator'];
        $source = $_POST['srcimg'];
        $text = $_POST['res'];
        $base_url = base_url();

            $image = imagecreatefrompng($source);
            imagecolortransparent($image, imagecolorallocatealpha($image, 0, 0, 0, 127));

$white = imagecolorallocate($image, 255, 255, 255);
            imagealphablending($image, false);
            imagesavealpha($image, true);
            $color = imagecolorallocate($image, 1, 1, 1);
            $fontSize = 35;
            $x = 50;
            $y = 220;
            $angle=45;
            $font = dirname(__FILE__) . '/../../../assets/fonts/Lato-Bold.ttf';

            // Get image Width and Height
$image_width = imagesx($image);  
$image_height = imagesy($image);

// Get Bounding Box Size
$text_box = imagettfbbox($fontSize,$angle,$font,$text);

// Get your Text Width and Height
$text_width = $text_box[2]-$text_box[0];
$text_height = $text_box[7]-$text_box[1];

// Calculate coordinates of the text
$x = ($image_width/2.4) - ($text_width/2);
//$y = ($image_height/2) - ($text_height/2);

            imagettftext($image, $fontSize, 0, $x, $y, -$white, $font, $text);
            $name = microtime();
            $newname = str_replace(' ','',$name);
            $newname = str_replace('.','',$newname);
            $newname = $newname.'.png';
            $loc = $_SERVER['DOCUMENT_ROOT'] . '/img/mobno/mobile/'.  $newname;
            imagepng($image, $loc);
            imagedestroy($image);
            $loc = $base_url.'img/mobno/mobile/'. $newname;

        echo $loc;
    }
      function save_mnaddpost() {
       
        if (isset($_SESSION['logged_in'])) {
            $session_data = $this->session->userdata('logged_in');
            $trader_id = $session_data['trader_id'];
            if($session_data['txtusertype']!=3){
                
                $plan_cnt = $this->Trader_mdl->trader_plancnt($trader_id);
                $trader_plancnt = $plan_cnt[0]->planPostCount;
                if ($trader_plancnt > 0) {
                    $this->update_plancnt($trader_id, $trader_plancnt);
                }
            }
            

            $base_url = base_url();
            $cat = $_POST['txtcat'];
            $temp = $_POST['temp'];
            

        
            $mobno = $_POST['txtmob'];
            $operator = $_POST['operator'];
            $prefix = $_POST['txtmainprefix'];
  

            $post_date = date('Y-m-d H:i:sa');
           
            $txtdetails = $_POST['txtdetails'];

            if (isset($_POST['call_for_price'])) {
                $call_for_price = 1;
                $txtprice = '';
            } else {
                $call_for_price = 0;
                $txtprice = $_POST['txtprice'];
            }

            $tr_user_type = $_SESSION['logged_in']['trader_id'];
            if ($tr_user_type == 3 || $tr_user_type == 2) {
                $prdt_ctype = 1;
            } else {
                $prdt_ctype = 0;
            }

            $data = array();



            $data['cartMNType'] = $prdt_ctype;
            $data['traderID'] = $trader_id;
            $data['productLocation'] = '';
            $data['productCategoryID'] = '6';
            $data['productCategoryName'] = 'Mobile Number';
            $data['productOperator'] = $operator;
            $data['productMNPrefix'] = $prefix;
            $data['productMNNmbr'] = $mobno;
            $data['productMNPrice'] = $txtprice;
            $data['productMNCallPrice'] = $call_for_price;
            $data['productMNDesc'] = $txtdetails;
            $data['productMNStatus'] = '';
            $data['MNpost_main_img'] =  $temp;
          
            $this->db->insert('productmn', $data);

            $last_prd_id = $this->db->insert_id();

            $postdata['productCategoryID'] = '6';
            $postdata['productID'] = $last_prd_id;
            $postdata['traderID'] = $trader_id;
            $postdata['postDesc'] = $txtdetails;
            $postdata['postSubmissionOn'] = $post_date;
            $postdata['postValidTill'] = '';
            $postdata['postStatus'] = '1';
            $this->db->insert('post', $postdata);
            $last_post_id = $this->db->insert_id();

            $qry = $this->Trader_mdl->category_count($cat);
            $traderqry = $this->Trader_mdl->trader_post_count($trader_id);
            if (count($traderqry) == 0) {
                $update_tr_post_cnt = 1;
                $cat_cnt = $qry[0]->categoryProductCount;
                $update_cat_cnt = $cat_cnt + 1;
            } else {
                $tr_post_cnt = $traderqry[0]->traderPostCount;
                $cat_cnt = $qry[0]->categoryProductCount;
                $update_cat_cnt = $cat_cnt + 1;
                $update_tr_post_cnt = $tr_post_cnt + 1;
            }

            $cdata['categoryProductCount'] = $update_cat_cnt;
            $this->db->where('productCategoryID', '6');
            $this->db->update('category', $cdata);

            $tdata['traderPostCount'] = $update_tr_post_cnt;
            $this->db->where('traderID', $trader_id);
            if($this->db->update('trader', $tdata)){
              //  $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Your Product is added successfully</div>');
              $this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-success text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Your Product is Added Successfully</div></div></div>');
              redirect($_SERVER['HTTP_REFERER']);
            }else{
               // $this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-success text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Your Product is Added Successfully</div></div></div>');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            redirect('admin/');
        }
    }
    
}