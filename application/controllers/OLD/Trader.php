<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/NetworkonlieBitmapPaymentIntegration_Controller.php';
class Trader extends Public_Controller {
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
        $this->load->library('pagination');
        $this->load->library('upload');
        
        $this->mId      = '201611201000001';
        $this->mKey     = 'L0Iml+JieUcBy8B6SQrT0zJlGp1l1E4vqYSWM1BhO9w=';
        $this->iv       = '0123456789abcdef';
        $this->amount   =  0;
        $this->user_id  = '';
//        $this->load->Model('trader/Trader_mdl');
        $this->load->Model('Trader_mdl');

    }

    public function index() {

        $query = $this->Trader_mdl->get_traders_list2();
        $data['admin'] = $query['adqry'];
        $data['trader'] = $query['trqry'];
       //echo '<pre>';print_r($data);exit();
       
   
           //$data['trader'] = $this->Trader_mdl->get_traders_list();
   
           $data['product'] = $this->Trader_mdl->get_product_list();
   
   
           $data['qry'] = $this->Trader_mdl->latest_post();
           $data['recentqry'] = $this->Trader_mdl->most_view();
   
           $this->load->view('trader/trader_header');
           $this->load->view('trader/trader_home_vw', $data);
           $this->load->view('trader/trader_footer');
       }
      
    function remove_solditems() {
        $pid = $_POST['pid'];
        $cid = $_POST['cid'];
        if ($cid == 1) {
            $data['productCStatus'] = 3;
            $this->db->where('productID', $pid);

            $this->db->update('productcar', $data);
        } else if ($cid == 2) {
            $data['productBStatus'] = 3;
            $this->db->where('productID', $pid);

            $this->db->update('productbike', $data);
        } else if ($cid == 3) {
            $data['productNPStatus'] = 3;
            $this->db->where('productID', $pid);

            $this->db->update('productnp', $data);
        } else if ($cid == 4) {
            $data['productVStatus'] = 3;
            $this->db->where('productID', $pid);

            $this->db->update('productvertu', $data);
        } else if ($cid == 5) {
            $data['productWStatus'] = 3;
            $this->db->where('productID', $pid);

            $this->db->update('productwatch', $data);
        } else if ($cid == 6) {
            $data['productMNStatus'] = 3;
            $this->db->where('productID', $pid);

            $this->db->update('productmn', $data);
        } else if ($cid == 7) {
            $data['productBTStatus'] = 3;
            $this->db->where('productID', $pid);

            $this->db->update('productboat', $data);
        } else if ($cid == 8) {
            $data['productPHStatus'] = 3;
            $this->db->where('productID', $pid);

            $this->db->update('productphone', $data);
        } else if ($cid == 9) {
            $data['productPRStatus'] = 3;
            $this->db->where('productID', $pid);

            $this->db->update('productproperty', $data);
        } else {
            echo "failed";
        }
        echo "success";
    }

    public function edit_prof($trader_id) {
        if (isset($_SESSION['logged_in'])) {
            //$this->load->view('trader/trader_header');
            $cntdata['cart_qry'] = $this->Trader_mdl->cart_cnt();
            $cntdata['watch_qry'] = $this->Trader_mdl->watch_cnt();
            $this->load->view('trader/trader_header');
            $data['codeqry'] = $this->Trader_mdl->get_countries_code();
            $data['qry'] = $this->Trader_mdl->fetch_trader_editdata($trader_id);
            $this->load->view('trader/trader_edit_prof_vw', $data);
            $this->load->view('trader/trader_footer');
        } else {
            redirect('Trader/login_view');
        }
    }

    function about_the_company() {
        $this->load->view('trader/trader_header');
        $this->load->view('trader/about_the_company_vw');
        $this->load->view('trader/trader_footer');
    }

    function terms_conditions() {
        $this->load->view('trader/trader_header');
        $this->load->view('trader/terms_conditions');
        $this->load->view('trader/trader_footer');
    }

    function privacy_policy() {
        $this->load->view('trader/trader_header');
        $this->load->view('trader/privacy_policy_vw');
        $this->load->view('trader/trader_footer');
    }

    function help_contact() {

        $this->load->view('trader/trader_header');



        $this->load->view('trader/help_contact_vw');
        $this->load->view('trader/trader_footer');
    }

    public function contact_help() {
        $this->form_validation->set_rules('helpname', 'Name', 'required');
        $this->form_validation->set_rules('helpemail', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('helpmsg', 'Message', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('trader/trader_header');



            $this->load->view('trader/help_contact_vw');
            $this->load->view('trader/trader_footer');
        } else {

            $this->session->set_flashdata('msg', 'Your message has been submitted successfully!');

            $this->load->view('trader/trader_header');



            $this->load->view('trader/help_contact_vw');
            $this->load->view('trader/trader_footer');
        }
    }

    public function fetch_proddet() {
        $product_id = $_POST['product_id'];
        $cat_id = $_POST['cat_id'];
        $c = 'category_details';
        /* if ($cat_id == 1) {
          $c = 'car_category_details';
          }
          if ($cat_id == 2) {
          $c = 'bike_category_details';
          }
          if ($cat_id == 3) {
          $c = 'show_noplate_details';
          }
          if ($cat_id == 4) {
          $c = 'show_vertu_details';
          }
          if ($cat_id == 5) {
          $c = 'show_watch_details';
          }
          if ($cat_id == 6) {
          $c = 'show_mobileno_details';
          }
          if ($cat_id == 7) {
          $c = 'boat_category_details';
          }
          if ($cat_id == 8) {
          $c = 'show_iphone_details';
          }
          if ($cat_id == 9) {
          $c = 'property_category_details';
          } */


        $qry = $this->Trader_mdl->mdl_prod_det($product_id, $cat_id);

        foreach ($qry as $row) {
            if ($row->Cpost_main_img != '' && (@getimagesize($row->Cpost_main_img))) {
                $img = $row->Cpost_main_img;
            } else if ($row->Bpost_main_img != '' && (@getimagesize($row->Bpost_main_img))) {
                $img = $row->Bpost_main_img;
            } else if ($row->BTpost_main_img != '' && (@getimagesize($row->BTpost_main_img))) {
                $img = $row->BTpost_main_img;
            } else if ($row->Wpost_main_img != '' && (@getimagesize($row->Wpost_main_img))) {
                $img = $row->Wpost_main_img;
            } else if ($row->Vpost_main_img != '' && (@getimagesize($row->Vpost_main_img))) {
                $img = $row->Vpost_main_img;
            } else if ($row->PRpost_main_img != '' && (@getimagesize($row->PRpost_main_img))) {
                $img = $row->PRpost_main_img;
            } else if ($row->PHpost_main_img != '' && (@getimagesize($row->PHpost_main_img))) {
                $img = $row->PHpost_main_img;
            } else if ($row->NPpost_main_img != '' && (@getimagesize($row->NPpost_main_img))) {
                $img = $row->NPpost_main_img;
            } else if ($row->MNpost_main_img != '' && (@getimagesize($row->MNpost_main_img))) {
                $img = $row->MNpost_main_img;
            } else {

                $img = base_url() . 'img/no_preview.png';
            }
            if ($row->product_name1 != '') {
                $product_name = $row->product_name1;
            } else if ($row->product_name2 != '') {
                $product_name = $row->product_name2;
            } else if ($row->product_name3 != '') {
                $product_name = $row->product_name3;
            } else if ($row->product_name4 != '') {
                $product_name = $row->product_name4;
            } else if ($row->product_name5 != '') {
                $product_name = $row->product_name5;
            } else if ($row->product_name6 != '') {
                $product_name = $row->product_name6;
            } else if ($row->product_name6 != '') {
                $product_name = $row->product_name7;
            } else if ($row->product_name8 != '') {
                $product_name = $row->product_name8;
            } else if ($row->product_name9 != '') {
                $product_name = $row->product_name9;
            } else {

                $product_name = '';
            }
            if ($row->productCPrice != '') {
                $product_price = $row->productCPrice;
            } else if ($row->productBPrice != '') {
                $product_price = $row->productBPrice;
            } else if ($row->productBTPrice != '') {
                $product_price = $row->productBTPrice;
            } else if ($row->productWPrice != '') {
                $product_price = $row->productWPrice;
            } else if ($row->productVPrice != '') {
                $product_price = $row->productVPrice;
            } else if ($row->productPRPrice != '') {
                $product_price = $row->productPRPrice;
            } else if ($row->productPHPrice != '') {
                $product_price = $row->productPHPrice;
            } else if ($row->productNPPrice != '') {
                $product_price = $row->productNPPrice;
            } else if ($row->productMNPrice != '') {
                $product_price = $row->productMNPrice;
            } else {

                $product_price = '';
            }
            $split = explode("/", $img);

            $s = $split[count($split) - 1];
            ?>
            <div style="padding-left: 63px;">
                <img src="<?php echo $img ?>" style="width: 172px;height: 118px;">
                <div class="mdl_proddet"><span>Product</span>&nbsp;&nbsp;<b><span><?php echo $product_name ?></span></b></div>
                <div class="mdl_pricedet"><span>Price</span>&nbsp;&nbsp;<b><span><?php $this->Trader_mdl->formataed($product_price); ?></span></b></div>
                <a target="blank" href="http://twitter.com/share?text=&url=<?php echo base_url()?>/Trader/<?php echo $c ?>/<?php echo $product_id ?>/<?php echo $cat_id ?>"><img src="<?php echo base_url(); ?>img/social-twitter.png" id="mdl_tw" onclick=""></a>
                <a target="blank" href="http://www.facebook.com/sharer.php?u=<?php echo base_url()?>/Trader/preview/<?php echo $product_id; ?>/<?php echo $cat_id; ?>/<?php echo $s; ?>"><img src="<?php echo base_url(); ?>img/social-facebook.png" id="mdl_fb" ></a>
                <img id="mdl_snap" src="<?php echo base_url(); ?>img/social-snapchat.png" onclick="snapchat_share()">
                 <!--img id="mdl_inst" src="<?php echo base_url(); ?>img/social-instagram.png"-->

            </div>

            <?php
        }

        //echo '<pre>';print_r($data);exit();
    }

    public function register() {

        $code_data['qry'] = $this->Trader_mdl->get_countries_code();
        $this->load->view('trader/trader_header');
        $this->load->view('trader/trader_reg_vw', $code_data);
        $this->load->view('trader/trader_footer');
    }

    //Trader registration
    function save_trader_register() {

        $trader_profimg = $_FILES['profimg']['name'];
        $em_idproof1 = $_FILES['traderIDProof']['name'];
        $em_idproof2 = $_FILES['traderIDsecond']['name'];

        $txtuname = trim($_POST['txtuname']);
        $txtname = $_POST['txtname'];
        $txtplace = $_POST['txtplace'];
        $txtmob = $_POST['txtmob'];
        $txtemail = $_POST['txtemail'];

        $txtpassword =  trim($_POST['txtpassword']);
        $txtweblink = $_POST['txtweblink'];
        $txtfblink = $_POST['txtfblink'];
        $txtinstlink = $_POST['txtinstlink'];
        $txtsnapclink = $_POST['txtsnapclink'];
        $txttwitterclink = $_POST['txttwitter'];
        $txt_trdetail = $_POST['txtabout'];
        if (isset($_FILES['profimg']['name'])) {
            $config['upload_path'] = 'uploads/trader_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $trader_profimg;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('profimg')) {
                $uploadData = $this->upload->data();
                $prof_img = $uploadData['file_name'];
            } else {
                $prof_img = 'noimage.png';
            }
        }

        if (isset($_FILES['traderIDProof']['name'])) {
            $config['upload_path'] = 'uploads/trader_emirates_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $em_idproof1;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('traderIDProof')) {
                $uploadData = $this->upload->data();

                $idproof_front = $uploadData['file_name'];
            } else {
                $idproof_front = 'noimage.png';
            }
        }
        if (isset($_FILES['traderIDsecond']['name'])) {
            $config['upload_path'] = 'uploads/trader_emirates_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $em_idproof2;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('traderIDsecond')) {
                $uploadData = $this->upload->data();

                $idproof_back = $uploadData['file_name'];
            } else {
                $idproof_back = 'noimage.png';
            }
        }
        $country_code = $_POST['txt_countrycode'];

        $data = array(
            'traderFullName' => $txtname,
            'traderUserName' => $txtuname,
            'traderPasswd' => md5($txtpassword),
            'traderContactNum' => $country_code . "-" . $txtmob,
            'traderEmailID' => $txtemail,
            'traderImage' => base_url() . 'uploads/trader_images/' . $prof_img,
            'traderIDProof' => base_url() . 'uploads/trader_emirates_images/' . $idproof_front,
            'traderIDProofsecond' => base_url() . 'uploads/trader_emirates_images/' . $idproof_back,
            'socialWeb' => $txtweblink,
            'socialFb' => $txtfblink,
            'socialInsta' => $txtinstlink,
            'socialSnap' => $txtsnapclink,
            'socialtwitter' => $txttwitterclink,
            'traderLocation' => $txtplace,
            'usertype' => 1,
            'traderInfo' => $txt_trdetail
        );

        if ($this->db->insert('trader', $data)) {

            //$txtemail=($txtusertype ==1)?$txtuname:$txtemail;

            $result = $this->Trader_mdl->get_trader($txtuname, $txtpassword, 1);

            if ($result) {
                $sess_array = array();
                foreach ($result as $row) {

                    $sess_array = array(
                        'trader_id' => $row->traderID,
                        'txtemail' => $row->traderEmailID,
                        'txtusername' => $row->traderUserName,
                        'txtusertype' => $row->usertype,
                    );

                    $this->session->set_userdata('logged_in', $sess_array);
                }
                 $this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-success text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Please select the payment method.</div></div></div>');

            }
        } else {
            $this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-danger text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Please try again ...</div></div></div>');
            $this->load->view('trader/trader_header');
            $this->load->view('trader/trader_reg_vw');
            $this->load->view('trader/trader_footer');
        }
    }

    function plans() {
      
        if (isset($_SESSION['logged_in'])) {
            $data['qry'] = $this->Trader_mdl->fetch_plan_amts();
            $this->load->view('trader/trader_header');
            $this->load->view('trader/trader_select_plan_vw',$data);
            $this->load->view('trader/trader_footer');
        } else {
            $this->login_view();
        }
    }

    function update_trader_register() {

        $traderid = $_POST['txthid_trid'];
        $trader_profimg = $_FILES['profimg']['name'];
        $em_idproof1 = $_FILES['traderIDProof']['name'];
        $em_idproof2 = $_FILES['traderIDProofSecond']['name'];


        $txtname = $_POST['txtname'];
        $txtplace = $_POST['txtplace'];
        $country_code = $_POST['txt_countrycode'];
        $txtmob = $_POST['txtmob'];

        $txtemail = $_POST['txtemail'];
        $txtuname = $_POST['txtuname'];

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
            } else {
                $prof_img = '';
            }
        } else {

            $prof_img = $_POST['txthid_tr_primg'];
        }
        if ($em_idproof1 != '') {
            $config['upload_path'] = 'uploads/trader_emirates_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
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
            $config['file_name'] = $em_idproof2;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('traderIDProofSecond')) {
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
            'traderUserName' => $txtuname,
            'traderContactNum' => $country_code . "-" . $txtmob,
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
            $this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-success text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Your Profile has been Updated Successfully</div></div></div>');
            redirect('Trader/edit_prof/' . $traderid);
        } else {
            $this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-danger text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Please try again ...</div></div></div>');
            $this->load->view('trader/trader_header');
            $this->load->view('trader/trader_edit_prof_vw');
            $this->load->view('trader/trader_footer');
        }
    }

    function chk_password_expression($str) {

        if (1 !== preg_match("/^.*(?=.{8})(?=.*[0-9])(?=.*[a-z])(?=.*[!@#$%^&*()\-_=+{};:,<.>§~]).*$/", $str)) {
            $this->form_validation->set_message('chk_password_expression', '%s must be at least 8 characters and must contain alphanumeric characters and one special character ');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function valid_url($str) {

        $pattern = "/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i";
        if (!preg_match($pattern, $str)) {
            return FALSE;
        }
        return TRUE;
    }

    public function login_view() {

        if (isset($_SESSION['logged_in'])) {
            redirect('Trader');
            //header("Location: {$_SERVER['HTTP_REFERER']}");
        } else {
            $this->form_validation->set_rules('txtemail', 'UserName', 'required');
            $this->form_validation->set_rules('txtpassword', 'Password', 'required|callback_check_database');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('trader/trader_header');
                //$data['recentqry'] = $this->Trader_mdl->recent_view();
                $this->load->view('trader/trader_login_vw');
                $this->load->view('trader/trader_footer');
            } else {

                $data = array();
                $this->load->Model('trader/Trader_mdl');
                $data['qry'] = $this->Trader_mdl->latest_post();
                $cntdata['cart_qry'] = $this->Trader_mdl->cart_cnt();
                $cntdata['watch_qry'] = $this->Trader_mdl->watch_cnt();
                $data['trader'] = $this->Trader_mdl->get_traders_list();
                $data['product'] = $this->Trader_mdl->get_product_list();
                $data['recentqry'] = $this->Trader_mdl->most_view();

                redirect('Trader');
            }
        }
    }

    function check_database($txtpassword) {
        $txtusertype = $this->input->post('txtusertype');
        $txtemail = $this->input->post('txtemail');
        $result = $this->Trader_mdl->get_trader($txtemail, $txtpassword, $txtusertype);
  
        //echo '<pre>';        print_r($result);exit();
        if ($result) {
            $sess_array = array();
            foreach ($result as $row) {
                $Uname=($row->usertype==1)?$row->traderUserName:$row->traderEmailID;
                $sess_array = array(
                    'traderUserName' => $Uname,
                    'traderName' => $row->traderFullName,
                    'traderImage' => $row->traderImage,
                    'trader_id' => $row->traderID,
                    'txtemail' => $row->traderEmailID,
                    'txtusertype' => $row->usertype,
                    'isActive' => $row->isActive,
                    'plan' => $row->tplanID,
                    'plantype'=>($row->tplanID==3||$row->tplanID==4)?1:0 //1-limited , 0 -unlimited
                );

                $this->session->set_userdata('logged_in', $sess_array);
            }
            return TRUE;
        } else {
            $this->form_validation->set_message('check_database', '<div class="alert alert-danger text-center">Invalid Username and Password!</div>');
            return false;
        }
    }

    public function home_page() {

        $this->load->view('trader/trader_home_vw');
    }

    public function save_trader() {
        $data['yearlyplan'] = $this->Trader_mdl->yearlyplan();
        $this->load->view('trader/trader_header');
        $this->load->view('trader/trader_select_plan_vw', $data);
        $this->load->view('trader/trader_footer');
    }

    public function payment_options() {
        if (isset($_SESSION['logged_in'])) {

            $session_data = $this->session->userdata('logged_in');
            $trader_id = $session_data['trader_id'];
            $plan_id = $_POST['plan_id'];
            $chkqry = $this->Trader_mdl->check_subplan_exist($trader_id);
            if (count($chkqry) > 0) {
                $qry = $this->Trader_mdl->fetch_plan($plan_id);
                $plan_name = $qry[0]->planName;
                $plan_amt = $qry[0]->planAmount;
                $plan_postcnt = $qry[0]->planPostCount;
                $plan_valid = $qry[0]->planValidity;


                $data['planID'] = $plan_id;
                $data['planName'] = $plan_name;
                $data['planAmount'] = $plan_amt;
                $this->db->set('planPostCount', "planPostCount + ".$plan_postcnt, FALSE);
                
                $data['planValidity'] = $plan_valid;
                $data['planStatus'] = 0;
                $data['paymentProof'] = '';

                $data['traderID'] = $trader_id;
                $data['paymentTypeChosen'] = 0;
                $this->db->where('traderID', $trader_id);
                $this->db->update('tradersubscriptionplan', $data);
               
            } else {
                $qry = $this->Trader_mdl->fetch_plan($plan_id);
                $plan_name = $qry[0]->planName;
                $plan_amt = $qry[0]->planAmount;
                $plan_postcnt = $qry[0]->planPostCount;
                $plan_valid = $qry[0]->planValidity;


                $data['planID'] = $plan_id;
                $data['planName'] = $plan_name;
                $data['planAmount'] = $plan_amt;
                $this->db->set('planPostCount', "planPostCount + ".$plan_postcnt, FALSE);
                $data['planValidity'] = $plan_valid;
                $data['planStatus'] = 0;
                $data['paymentProof'] = '';

                $data['traderID'] = $trader_id;
                $data['paymentTypeChosen'] = 0;

                $this->db->insert('tradersubscriptionplan', $data);
            }

            echo "success";
        } else {
            redirect('Trader/login_view');
        }
    }

    function fetch_payment_options() {

        if (isset($_SESSION['logged_in'])) {

            $this->load->view('trader/trader_payment_options_vw');
        } else {
            $this->login_view();
        }
    }

    public function make_reg_pay() {
        $plan_type = $_POST['plan_type'];
        if ($plan_type == 'Yearly Plan[AED 6000/Month]') {
            $pay_amt = '72000';
        } else if ($plan_type == 'Monthly Plan[AED 1000/Month]') {
            $pay_amt = '12000';
        } else if ($plan_type == 'Yearly Limited Plan[30 Post]') {
            $pay_amt = '1000';
        } else {
            $pay_amt = '2000';
        }

        $data['plantype'] = $plan_type;
        $data['pay_amt'] = $pay_amt;
        $this->load->view('trader/trader_login_vw');
        //$this->load->view('trader/trader_regpay_vw',$data); 
    }

    public function add_watch_list($product_id, $category_id, $post_id, $userid) {

        $data['qry'] = $this->Trader_mdl->prod_addto_watchlist($product_id, $category_id, $post_id, $userid);
        $qry_cnt = $data['qry'][0]->watch_cnt;
        $this->Trader_mdl->watchlist_add_prdt($product_id, $category_id, $post_id, $qry_cnt, $userid);
        $this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-success text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Product has been added to Watch List Successfully</div></div></div>');
        redirect('Trader/view_watch_list');
    }
    public function remove_watch_list($watchlistID) {

        if($this->Trader_mdl->remove_watchlist($watchlistID))echo "success";
        else echo "error";
      
    }
    public function view_watch_list() {
 
        $prdt_watch_details['watch_qry'] = $this->Trader_mdl->watch_cnt();
        $prdt_watch_details['recentqry'] = $this->Trader_mdl->recently_viewed();
        $this->load->view('trader/trader_header');
        $prdt_watch_details['qry'] = $this->Trader_mdl->watch_details();
        $prdt_watch_details['cat_qry'] = $this->Trader_mdl->get_categories();
        $this->load->view('trader/watch_list_vw', $prdt_watch_details);
        $this->load->view('trader/trader_footer');
    }

    public function view_cart() {
        $prdt_cart_details['watch_qry'] = $this->Trader_mdl->watch_cnt();
       
        $prdt_cart_details['recentqry'] = $this->Trader_mdl->recently_viewed();
        $prdt_cart_details['qry'] = $this->Trader_mdl->cart_details();
        $prdt_cart_details['cart_qry'] = count( $prdt_cart_details['qry'] );
       
        $this->load->view('trader/trader_header');
        $this->load->view('trader/trader_cart_vw', $prdt_cart_details);
        $this->load->view('trader/trader_footer');
    }

    public function add_cart($product_id, $post_id, $category_id, $userid) {

        $this->Trader_mdl->prod_addto_cart($product_id, $post_id, $category_id, $userid);
          $this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-success text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Product has been added to Cart Successfully</div></div></div>');
        redirect('Trader/view_cart');
    }

    public function check_prd_cartexist() {
        $post_id = $_POST['post_id'];
        $qry = $this->Trader_mdl->prd_exit_cart($post_id);
        if ($qry) {
            echo "exist";
        } else {
            echo "does not exist";
        }
    }

    public function check_prd_watchexist() {
        $post_id = $_POST['post_id'];
        $qry = $this->Trader_mdl->prd_exit_watch($post_id);
        if ($qry) {
            echo "exist";
        } else {
            echo "does not exist";
        }
    }

    public function del_cart() {
        $product_id = $_POST['product_id'];
        $cat_id = $_POST['cat_id'];
        $session_data = $this->session->userdata('logged_in');
        $userid = $session_data['trader_id'];
        $this->Trader_mdl->del_prd_cart($product_id, $cat_id, $userid);
        echo "success";
        //$this->view_cart();
    }

    function fetch_prod_traddet() {
        $cat_id = $_POST['category_id'];

        $product_id = $_POST['product_id'];

        $post_id = $_POST['post_id'];

        $qry = $this->Trader_mdl->mdl_fetch_prod_traddet($post_id);
        foreach ($qry as $r) {
            ?>
            <div>
                <center>
                    <p>Kindly contact the trader for purchasing this item</p>
                    <table>
                        <tr>
                            <td>Name</td>
                            <td width='15px'>:</td>
                            <td><?php echo $r->traderFullName ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><?php echo $r->traderEmailID ?></td>
                        </tr>
                        <tr>
                            <td>Contact Number</td>
                            <td>:</td>
                            <td><?php echo $r->traderContactNum ?></td>
                        </tr>
                    </table>
                </center>
            </div>
            <?php
        }
    }

    public function save_flagpost() {
        if (isset($_SESSION['logged_in'])) {
            $cat_id = $_POST['category_id'];
            $prdt_id = $_POST['product_id'];
            $post_id = $_POST['post_id'];
            $trader_id = $_POST['trader_id'];
            $flag_cmt = $_POST['flag_desc'];
            $session_data = $this->session->userdata('logged_in');
            $flaguserid = $session_data['trader_id'];
            $flag_date = date('Y-m-d h:i:sa');
            $data['flagStatus'] = 1;
            $data['postID'] = $post_id;
            $data['productID'] = $prdt_id;
            $data['ProductcategoryID'] = $cat_id;
            $data['traderID'] = $trader_id;
            $data['flagUserID'] = $flaguserid;
            $data['flagDate'] = $flag_date;
            $data['flagDesc'] = $flag_cmt;
            $this->db->insert('flaggeditems', $data);
            $this->Trader_mdl->descr_view_cnt($prdt_id, $cat_id);
            echo "success";
        } else {
            redirect('Trader/login_view');
        }
    }

    public function view_category() {
        $config = array();
        $config["base_url"] = base_url() . "index.php/Trader/login_check";
        $this->load->Model('trader/Trader_mdl');
        $total_row = $this->Trader_mdl->record_count();
        $config["total_rows"] = $total_row;
        $config["per_page"] = 1;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = $total_row;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';

        $this->pagination->initialize($config);
        if ($this->uri->segment(3)) {
            $page = ($this->uri->segment(3));
        } else {
            $page = 1;
        }
        $this->load->Model('trader/Trader_mdl');
        $data["results"] = $this->Trader_mdl->fetch_post_data($config["per_page"], $page);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links);
        $this->load->view('trader/category_page_vw', $data);
    }

    /* public function view_category_details() {

      $this->load->view('trader/category_detail_page_vw');
      } */

    public function view_checkout() {


        $this->load->view('trader/trader_header');
        $prdt_cart_details['recentqry'] = $this->Trader_mdl->recently_viewed();
        $qry = $this->Trader_mdl->cart_details();
        $cnt = count($qry);
        $prdt_cart_details['qry'] = $qry;
        $prdt_cart_details['total_cnt'] = $cnt;
        $this->load->view('trader/checkout_vw', $prdt_cart_details);
        $this->load->view('trader/trader_footer');
    }

    public function add_order_items() {
        if (isset($_SESSION['logged_in'])) {
            $date = date('Y-m-d h:i:sa');
            $fin_tot = $_POST['fin_tot'];
            $vat = $_POST['final_vat'];
            $tax = $_POST['final_tax'];
            $session_data = $this->session->userdata('logged_in');
            $chk_uid = $session_data['trader_id'];
            $qry = $this->Trader_mdl->check_order_exist($chk_uid);
            if (count($qry) == 0) {

                $data['ecoTax'] = $vat;
                $data['vatTax'] = $tax;
                $data['orderAmount'] = $fin_tot;
                $data['orderUserID'] = $chk_uid;
                $data['orderDate'] = $date;
                $data['paymentType'] = 0;
                $data['paymentProof'] = 0;
                $data['status'] = 0;
                $this->db->insert('order_items', $data);
                $last_order_id = $this->db->insert_id();
                $updata['orderID'] = $last_order_id;
                $this->db->where('userID', $chk_uid);
                $this->db->update('cartlist', $updata);
                echo $last_order_id . "/" . $fin_tot . "/" . $chk_uid;
            } else {
                $qry = $this->db->query('select orderID from order_items where orderUserID=' . $chk_uid);
                $res = $qry->result();
                $order_id = $res[0]->orderID;
                $cart_updata['ecoTax'] = $tax;
                $cart_updata['vatTax'] = $vat;
                $cart_updata['orderAmount'] = $fin_tot;
                $this->db->where('orderUserID', $chk_uid);
                $this->db->update('order_items', $cart_updata);

                $orderid_updata['orderID'] = $order_id;
                $this->db->where('userID', $chk_uid);
                $this->db->update('cartlist', $orderid_updata);
                echo $order_id . "/" . $fin_tot . "/" . $chk_uid;
            }
        } else {
            redirect('Trader/login_view');
        }
    }

    public function change_paystatus() {
        $order_id = $_POST['order_id'];
        $this->Trader_mdl->checkout_status($order_id);
        echo "success";
    }

    public function view_post_reject() {
        $this->load->view('trader/post_reject_vw');
    }

    /*
     * loading view page for payment
     */

    public function regpay() {
        $this->load->view('trader/trader_regpay_vw');
    }

    public function check_log_watchlist($product_id, $cat_id, $post_id, $userid) {
        if (isset($_SESSION['logged_in'])) {
            $this->add_watch_list($product_id, $cat_id, $post_id, $userid);
            $this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-success text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Product has been added to Watch List Successfully</div></div></div>');
            $this->view_watch_list();
        } else {
            $this->login_view();
        }
    }

    public function check_log_cartlist($product_id, $cat_id, $post_id, $userid) {
        if (isset($_SESSION['logged_in'])) {
            $this->add_cart($product_id, $cat_id, $post_id, $userid);
            //echo "success";exit();
            $this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-success text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Product has been added to Cart Successfully</div></div></div>');
            $this->view_cart();
        } else {
            $this->login_view();
        }
    }

    public function save_regpay() {
        $this->load->view('trader/trader_login_vw');
    }

    public function trader_profile() {
        if (isset($_SESSION['logged_in'])) {
			
            
            $session_data = $this->session->userdata('logged_in');
            $trader_id = $session_data['trader_id'];


            $config['base_url'] = base_url() . "Trader/trader_profile";
            $cnt_appr = $this->Trader_mdl->count_fetch_appr_posts();
            $total_row = count($cnt_appr);
            $config["total_rows"] = $total_row;
            $config["per_page"] = 18;
            $config["uri_segment"] = 3;

            $config["num_links"] = 3;
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = false;
            $config['last_link'] = false;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous Page';
            $config['prev_tag_open'] = '<li class="prev">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next Page';
            $config['next_tag_open'] = '<li class="next">';
            $config['next_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            //$query = $this->Trader_mdl->mdl_all_traders($config["per_page"], $page);
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;', $str_links);
            $data['app_qry'] = $this->Trader_mdl->fetch_appr_posts($config["per_page"], $page);
            //echo '<pre>';print_r($data);exit();
            $data['pend_qry'] = $this->Trader_mdl->fetch_pend_posts();
            $post_days_left = $this->Trader_mdl->calc_rem_postdays();
            $totamt = $this->Trader_mdl->calc_tot_amt();

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
                    $data['msg'] = "<a href='plans'>Select a Plan</a>";
                }
            } else {
                $data['msg'] = "<a href='plans'>Select a Plan</a>";
            }



            $data['rej_qry'] = $this->Trader_mdl->fetch_rej_posts();

           // $cnt_rej = $this->Trader_mdl->fetch_rej_posts();

            //echo '<pre>';print_r($data);exit();
            // echo count($data['pend_qry']);exit();
            //$cnt_appr =$total_row;
           // $cnt_pend = $this->Trader_mdl->fetch_pend_posts();
            $data['appr_post_cnt'] = count($data['app_qry']);//$total_row
            $data['rej_post_cnt'] = count($data['rej_qry']);
            $data['pend_post_cnt'] = count($data['pend_qry']);
            //$data['notification'] = $this->Trader_mdl->notification_cnt();
            $notification = $this->Trader_mdl->notification_cnt();

            $count = $notification['flagcnt'][0]->total_entries + $notification['notcnt'][0]->total_entries;
            $data['count'] = $count;
            $data['notification'] = $this->Trader_mdl->notification_cnt();
            $data['cat_qry'] = $this->Trader_mdl->get_categories();
            $data['recentqry'] = $this->Trader_mdl->recently_viewed();


            $data['query'] = $this->Trader_mdl->get_name($trader_id);
            //echo '<pre>';print_r($data);exit();
            $data['cart_qry'] = $this->Trader_mdl->cart_cnt();
            $data['watch_qry'] = $this->Trader_mdl->watch_cnt();
            $tr_sold_cnt = $this->Trader_mdl->cnt_fetch_tr_solditems($trader_id);

            $total_sold_cnt = $tr_sold_cnt[0]->sold_cnt;
            $tr_booked_cnt = $this->Trader_mdl->cnt_fetch_tr_bookeditems($trader_id);

            $total_book_cnt = $tr_booked_cnt[0]->book_cnt;
            $tr_total_post = $this->Trader_mdl->cnt_fetch_tr_totalpost($trader_id);

            $cnt = $tr_total_post[0]->totlal_post_cnt;
            $data['total_sold_cnt'] = $total_sold_cnt;
            $data['total_book_cnt'] = $total_book_cnt;
            $data['total_post'] = $cnt;
             //echo '<pre>';print_r($data);exit();
            $this->load->view('trader/trader_header');
            $this->load->view('trader/trader_profile_vw', $data);
            $this->load->view('trader/trader_footer');
        } else {
            redirect('Trader/login_view');
        }
    }

    public function fetch_plan_amt() {
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];

        $qry = $this->Trader_mdl->trader_plan_amts($trader_id);
        echo $qry[0]->planAmount . "-" . $trader_id;
    }

    public function trader_sold() {
        if (isset($_SESSION['logged_in'])) {
            $data['cat_qry'] = $this->Trader_mdl->get_categories();
            $data['recentqry'] = $this->Trader_mdl->recently_viewed();
            $session_data = $this->session->userdata('logged_in');
            $trader_id = $session_data['trader_id'];
            $data['query'] = $this->Trader_mdl->get_name($trader_id);
            $data['sold_qry'] = $this->Trader_mdl->fetch_solditems($trader_id);
            $tr_sold_cnt = $this->Trader_mdl->cnt_fetch_tr_solditems($trader_id);

            $total_sold_cnt = $tr_sold_cnt[0]->sold_cnt;
            $tr_booked_cnt = $this->Trader_mdl->cnt_fetch_tr_bookeditems($trader_id);

            $total_book_cnt = $tr_booked_cnt[0]->book_cnt;
            $tr_total_post = $this->Trader_mdl->cnt_fetch_tr_totalpost($trader_id);

            $cnt = $tr_total_post[0]->totlal_post_cnt;
            $data['total_sold_cnt'] = $total_sold_cnt;
            $data['total_book_cnt'] = $total_book_cnt;
            $data['total_post'] = $cnt;
            $data['cart_qry'] = $this->Trader_mdl->cart_cnt();
            $data['watch_qry'] = $this->Trader_mdl->watch_cnt();
            $post_days_left = $this->Trader_mdl->calc_rem_postdays();
            $totamt = $this->Trader_mdl->calc_tot_amt();

            $trader_final_amt = $totamt[0]->result;
            $data['trader_tot_amt'] = $trader_final_amt;
            $post_date = date_create($post_days_left[0]->planValidity);

            $curr_date = date_create(date('Y-m-d'));


            $diff = date_diff($curr_date, $post_date);

            $days_left = $diff->format("%R%a");
            $mod_days_left = $diff->format("%a");
            if ($days_left > 0) {
                $data['msg'] = 'You have <b>' . $mod_days_left . '</b> days left';
            } else {
                $data['msg'] = "<a href='plans'>Select a Plan</a>";
            }
            $this->load->view('trader/trader_header');

            $this->load->view('trader/trader_sold_vw', $data);
            $this->load->view('trader/trader_footer');
        } else {
            redirect('Trader/login_view');
        }
    }

    public function trader_booked() {

        if (isset($_SESSION['logged_in'])) {
            $data['cat_qry'] = $this->Trader_mdl->get_categories();
            $data['recentqry'] = $this->Trader_mdl->recently_viewed();
            $session_data = $this->session->userdata('logged_in');
            $trader_id = $session_data['trader_id'];
            $data['query'] = $this->Trader_mdl->get_name($trader_id);
            $data['booked_qry'] = $this->Trader_mdl->fetch_bookeditems($trader_id);
            $tr_sold_cnt = $this->Trader_mdl->cnt_fetch_tr_solditems($trader_id);

            $total_sold_cnt = $tr_sold_cnt[0]->sold_cnt;
            $tr_booked_cnt = $this->Trader_mdl->cnt_fetch_tr_bookeditems($trader_id);

            $total_book_cnt = $tr_booked_cnt[0]->book_cnt;
            $tr_total_post = $this->Trader_mdl->cnt_fetch_tr_totalpost($trader_id);

            $cnt = $tr_total_post[0]->totlal_post_cnt;
            $data['total_sold_cnt'] = $total_sold_cnt;
            $data['total_book_cnt'] = $total_book_cnt;
            $data['total_post'] = $cnt;
            $data['cart_qry'] = $this->Trader_mdl->cart_cnt();
            $data['watch_qry'] = $this->Trader_mdl->watch_cnt();
            $post_days_left = $this->Trader_mdl->calc_rem_postdays();
            $totamt = $this->Trader_mdl->calc_tot_amt();

            $trader_final_amt = $totamt[0]->result;
            $data['trader_tot_amt'] = $trader_final_amt;
            $post_date = date_create($post_days_left[0]->planValidity);

            $curr_date = date_create(date('Y-m-d'));


            $diff = date_diff($curr_date, $post_date);

            $days_left = $diff->format("%R%a");
            $mod_days_left = $diff->format("%a");
            if ($days_left > 0) {
                $data['msg'] = 'You have <b>' . $mod_days_left . '</b> days left';
            } else {
                $data['msg'] = "<a href='plans'>Select a Plan</a>";
            }
            $this->load->view('trader/trader_header');
            $this->load->view('trader/trader_booked_vw', $data);
            $this->load->view('trader/trader_footer');
        } else {
            redirect('Trader/login_view');
        }
    }

    public function trader_notifications() {
        if (isset($_SESSION['logged_in'])) {
            $session_data = $this->session->userdata('logged_in');
            $trader_id = $session_data['trader_id'];
            $this->Trader_mdl->read_status($trader_id);
            $data['cat_qry'] = $this->Trader_mdl->get_categories();
            $data['recentqry'] = $this->Trader_mdl->recently_viewed();

            $data['query'] = $this->Trader_mdl->get_name($trader_id);
            //echo '<pre>';print_r($data);exit();
            $data['cart_qry'] = $this->Trader_mdl->cart_cnt();
            $data['watch_qry'] = $this->Trader_mdl->watch_cnt();



            $data['notifications'] = $this->Trader_mdl->getnotifications($trader_id);
            $flaguser = $this->Trader_mdl->flaguser($trader_id);
            $data['flagdetails'] = $this->Trader_mdl->flaggeduser($flaguser);
            $tr_sold_cnt = $this->Trader_mdl->cnt_fetch_tr_solditems($trader_id);

            $total_sold_cnt = $tr_sold_cnt[0]->sold_cnt;
            $tr_booked_cnt = $this->Trader_mdl->cnt_fetch_tr_bookeditems($trader_id);

            $total_book_cnt = $tr_booked_cnt[0]->book_cnt;
            $tr_total_post = $this->Trader_mdl->cnt_fetch_tr_totalpost($trader_id);

            $cnt = $tr_total_post[0]->totlal_post_cnt;
            $data['total_sold_cnt'] = $total_sold_cnt;
            $data['total_book_cnt'] = $total_book_cnt;
            $data['total_post'] = $cnt;
            $notification = $this->Trader_mdl->notification_cnt();

            $count = $notification['flagcnt'][0]->total_entries + $notification['notcnt'][0]->total_entries;
            $data['count'] = $count;
            $data['notification'] = $this->Trader_mdl->notification_cnt();
            $post_days_left = $this->Trader_mdl->calc_rem_postdays();
            $totamt = $this->Trader_mdl->calc_tot_amt();

            $trader_final_amt = $totamt[0]->result;
            $data['trader_tot_amt'] = $trader_final_amt;
            $post_date = date_create($post_days_left[0]->planValidity);

            $curr_date = date_create(date('Y-m-d'));


            $diff = date_diff($curr_date, $post_date);

            $days_left = $diff->format("%R%a");
            $mod_days_left = $diff->format("%a");
            if ($days_left > 0) {
                $data['msg'] = 'You have <b>' . $mod_days_left . '</b> days left';
            } else {
                $data['msg'] = "<a href='plans'>Select a Plan</a>";
            }
            $this->load->view('trader/trader_header');
            $this->load->view('trader/trader_notifications_vw', $data);
            $this->load->view('trader/trader_footer');
        } else {
            redirect('Trader/login_view');
        }
    }

    public function fetch_all_notifs() {
        $trader_id = $_GET['trader_id'];
        $offset = $_GET['offset'];
        $limit = $_GET['limit'];
        $url = 'https://alshamil.bluecast.ae/TraderController/GetNotificationsBy?userId=' . $trader_id . '&page=0&perPageCount=10';
        //$url = "https://alshamil.bluecast.ae?format=json/TraderController/GetNotificationsBy/" . $trader_id . '/' . $offset . '/' . $limit;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 4);
        $json = curl_exec($ch);
        if (!$json) {
            echo curl_error($ch);
        }
        curl_close($ch);

        // echo '<pre>';print_r(json_decode($json));exit();
        //echo '<pre>';print_r($json);
        echo print_r($json);
    }

    public function update_mnpost() {
        
        $temp = $_POST['temp'];
       $operator = $_POST['operator'];
       $txtprefix = $_POST['txtprefix'];
       $post_date = date('Y-m-d h:i:sa');
        $txtdetails = $_POST['txtdetails'];
        $txtmob = $_POST['txtmob'];
        $product_id = $_POST['txthid_pid'];
        $cat_id = $_POST['txthid_cid'];
        $post_id = $_POST['txthid_postid'];
        if (isset($_POST['call_for_price'])) {
            $call_for_price = 1;
            $txtprice = '';
        } else {
            $call_for_price = 0;
            $txtprice = $_POST['txtprice'];
        }

        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $tr_user_type = $_SESSION['logged_in']['trader_id'];
        if ($tr_user_type == 1) {
            $prdt_ctype = 1;
        } else {
            $prdt_ctype = 0;
        }
        $data = array();

        $data['productCategoryID'] = '6';
        $data['traderID'] = $trader_id;
        $data['productLocation'] = '';

        $data['productCategoryName'] = 'Mobile number';
        $data['productOperator'] = $operator;
        $data['productMNPrefix'] = $txtprefix;

        $data['productMNPrice'] = $txtprice;
        $data['productMNCallPrice'] = $call_for_price;

        $data['productMNDesc'] = $txtdetails;
        $data['productMNSubmitDate'] = $post_date;
        $data['productMNNmbr'] = $txtmob;
        $data['cartMNType'] = $prdt_ctype;



        $data['MNpost_main_img'] = $temp;

	

        $this->db->where('productID', $product_id);
        $this->db->where('productCategoryID', $cat_id);

        $this->db->update('productmn', $data);


        $postdata['traderID'] = $trader_id;
        $postdata['productID'] = $product_id;
        $postdata['productCategoryID'] = $cat_id;
        $postdata['postDesc'] = $txtdetails;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '0';
        $this->db->where('productID', $product_id);
        $this->db->where('productCategoryID', $cat_id);
        $this->db->update('post', $postdata);
       

        $this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-success text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Your Product is Updated Successfully</div></div></div>');

        redirect('Trader/tr_edit_post/' . $product_id . '/' . $cat_id);
    }

    public function edit_car_post() {

        $this->load->Model('trader/Trader_mdl');

        $country_data['cat_qry'] = $this->Trader_mdl->get_categories();
        $country_data['qry'] = $this->Trader_mdl->get_countries_code();
        $cntdata['cart_qry'] = $this->Trader_mdl->cart_cnt();
        $cntdata['watch_qry'] = $this->Trader_mdl->watch_cnt();

        $this->load->view('trader/tr_prof_header_vw', $cntdata);
        $this->load->view('trader/edit_car_post_vw', $country_data);
        $this->load->view('trader/trader_footer');
    }

    public function edit_bike_post() {

        $this->load->Model('trader/Trader_mdl');

        $country_data['cat_qry'] = $this->Trader_mdl->get_categories();
        $country_data['qry'] = $this->Trader_mdl->get_countries_code();
        $cntdata['cart_qry'] = $this->Trader_mdl->cart_cnt();
        $cntdata['watch_qry'] = $this->Trader_mdl->watch_cnt();

        $this->load->view('trader/tr_prof_header_vw', $cntdata);
        $this->load->view('trader/edit_bike_post_vw', $country_data);
        $this->load->view('trader/trader_footer');
    }

    public function edit_noplate_post() {

        $this->load->Model('trader/Trader_mdl');

        $country_data['cat_qry'] = $this->Trader_mdl->get_categories();
        $country_data['qry'] = $this->Trader_mdl->get_countries_code();
        $cntdata['cart_qry'] = $this->Trader_mdl->cart_cnt();
        $cntdata['watch_qry'] = $this->Trader_mdl->watch_cnt();

        $this->load->view('trader/tr_prof_header_vw', $cntdata);
        $this->load->view('trader/edit_noplate_post_vw', $country_data);
        $this->load->view('trader/trader_footer');
    }

    public function edit_vertu_post() {

        $this->load->Model('trader/Trader_mdl');

        $country_data['cat_qry'] = $this->Trader_mdl->get_categories();
        $country_data['qry'] = $this->Trader_mdl->get_countries_code();
        $cntdata['cart_qry'] = $this->Trader_mdl->cart_cnt();
        $cntdata['watch_qry'] = $this->Trader_mdl->watch_cnt();

        $this->load->view('trader/tr_prof_header_vw', $cntdata);
        $this->load->view('trader/edit_vertu_addpost_vw', $country_data);
        $this->load->view('trader/trader_footer');
    }

    public function edit_watch_post() {

        $this->load->Model('trader/Trader_mdl');

        $country_data['cat_qry'] = $this->Trader_mdl->get_categories();
        $country_data['qry'] = $this->Trader_mdl->get_countries_code();
        $cntdata['cart_qry'] = $this->Trader_mdl->cart_cnt();
        $cntdata['watch_qry'] = $this->Trader_mdl->watch_cnt();

        $this->load->view('trader/tr_prof_header_vw', $cntdata);
        $this->load->view('trader/edit_watch_addpost_vw', $country_data);
        $this->load->view('trader/trader_footer');
    }

    public function edit_mobile_post() {

        $this->load->Model('trader/Trader_mdl');

        $country_data['cat_qry'] = $this->Trader_mdl->get_categories();
        $country_data['qry'] = $this->Trader_mdl->get_countries_code();
        $cntdata['cart_qry'] = $this->Trader_mdl->cart_cnt();
        $cntdata['watch_qry'] = $this->Trader_mdl->watch_cnt();

        $this->load->view('trader/tr_prof_header_vw', $cntdata);
        $this->load->view('trader/edit_mobile_addpost_vw', $country_data);
        $this->load->view('trader/trader_footer');
    }

    public function edit_boat_post() {

        $this->load->Model('trader/Trader_mdl');

        $country_data['cat_qry'] = $this->Trader_mdl->get_categories();
        $country_data['qry'] = $this->Trader_mdl->get_countries_code();
        $cntdata['cart_qry'] = $this->Trader_mdl->cart_cnt();
        $cntdata['watch_qry'] = $this->Trader_mdl->watch_cnt();

        $this->load->view('trader/tr_prof_header_vw', $cntdata);
        $this->load->view('trader/edit_boat_addpost_vw', $country_data);
        $this->load->view('trader/trader_footer');
    }

    public function edit_phone_post() {

        $this->load->Model('trader/Trader_mdl');

        $country_data['cat_qry'] = $this->Trader_mdl->get_categories();
        $country_data['qry'] = $this->Trader_mdl->get_countries_code();
        $cntdata['cart_qry'] = $this->Trader_mdl->cart_cnt();
        $cntdata['watch_qry'] = $this->Trader_mdl->watch_cnt();

        $this->load->view('trader/tr_prof_header_vw', $cntdata);
        $this->load->view('trader/edit_phone_addpost_vw', $country_data);
        $this->load->view('trader/trader_footer');
    }

    public function edit_property_post() {

        $this->load->Model('trader/Trader_mdl');

        $country_data['cat_qry'] = $this->Trader_mdl->get_categories();
        $country_data['qry'] = $this->Trader_mdl->get_countries_code();
        $cntdata['cart_qry'] = $this->Trader_mdl->cart_cnt();
        $cntdata['watch_qry'] = $this->Trader_mdl->watch_cnt();

        $this->load->view('trader/tr_prof_header_vw', $cntdata);
        $this->load->view('trader/edit_property_addpost_vw', $country_data);
        $this->load->view('trader/trader_footer');
    }

    public function logout() {
        $sess_array = array();
        $this->session->unset_userdata('logged_in', $sess_array);
        $this->index();
    }

    function view_other_traders($trader_id) {
        $config = array();

        $data['qry'] = $this->Trader_mdl->get_name($trader_id);
        $data['trader_id'] = $trader_id;
        $qry = $this->Trader_mdl->cnt_getproducttrader($trader_id);
        $tr_prdt_row = count($qry);
        $total_row = $tr_prdt_row;
        $config['base_url'] = base_url() . "Trader/view_other_traders/" . $trader_id;
        $config["total_rows"] = $total_row;
        $config["per_page"] = 18;
        $config["uri_segment"] = 3;

        $config["num_links"] = 3;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Previous Page';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next Page';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['product_qry'] = $this->Trader_mdl->getproducttrader($trader_id, $config["per_page"], $page);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links);


        $data['cat_qry'] = $this->Trader_mdl->get_categories();
        $data['recentqry'] = $this->Trader_mdl->recently_viewed();
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links);

        $this->load->view('trader/trader_header');
        $this->load->view('trader/other_traderprofile_vw', $data);
        $this->load->view('trader/trader_footer');
    }

    function mail_trader() {
        $trader_id = $this->uri->segment(3);
        $session_data = $this->session->userdata('logged_in');
        $trader = $session_data['trader_id'];
        $data['frommail'] = $this->Trader_mdl->getMail($trader);
        $data['fromname'] = $this->Trader_mdl->get_Namee($trader);
        $data['tomail'] = $this->Trader_mdl->get_mail($trader_id);

        $subject = $this->input->post('subject');
        $message = $this->input->post('message');
        $from_email = $data['frommail'];
        $to_email = $data['tomail'];
        $name = $data['fromname'];

        //configure email settings

        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com';
        $config['smtp_port'] = '465';
        $config['smtp_user'] = 'snehavijayan.sot@gmail.com';
        $config['smtp_pass'] = 'sneha@123';

        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n"; //use double quotes
//        $this->load->library('email', $config);


$headers = 'From:'.$from_email . "\r\n" .
    'Reply-To:'.$from_email . "\r\n" .
    'X-Mailer: PHP/' . phpversion();




        // $this->email->initialize($config);


        // $this->email->from($from_email, $name);
        // $this->email->to($to_email);
        // $this->email->subject($subject);
        // $this->email->message($message);
        $path = base_url() . 'Trader/view_other_traders/' . $trader_id;
        // if ($this->email->send()) {
            if (mail($to_email, $subject, $message, $headers)) { 
    $this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-success text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Your Mail has been Sent Successfully!</div></div></div>');
            redirect($path);
        } else {


//                    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">There is error in sending mail! Please try again later</div>');
    //        show_error($this->email->print_debugger());
        }
    }

    public function login_check() {
        $config = array();
        $config["base_url"] = base_url() . "index.php/Trader/login_check";
        $this->load->model('Trader_mdl');
        $total_row = $this->Trader_mdl->record_count();
        $config["total_rows"] = $total_row;
        $config["per_page"] = 1;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = $total_row;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';

        $this->pagination->initialize($config);
        if ($this->uri->segment(3)) {
            $page = ($this->uri->segment(3));
        } else {
            $page = 1;
        }
        $this->load->Model('Trader_mdl');
        $data["results"] = $this->Trader_mdl->fetch_post_data($config["per_page"], $page);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links);

        // View data according to array.

        //$this->load->view('trader/trader_profile_vw', $data);
    }

    public function trader_check_addpost() {
        $add_post_check = $this->Trader_mdl->check_trader_addpost();

        echo $add_post_check;
    }

    public function add_post() {
        if (isset($_SESSION['logged_in'])) {
            $country_data['cat_qry'] = $this->Trader_mdl->get_categories();
            $country_data['qry'] = $this->Trader_mdl->get_countries_code();
            $cntdata['watch_qry'] = $this->Trader_mdl->watch_cnt();

            $this->load->view('trader/trader_header');

            $this->load->view('trader/trader_addpost_vw', $country_data);
            $this->load->view('trader/trader_footer');
        } else
            redirect('Trader/login_view');
            
    }

    /* public function add_post() {

      $add_post_check=$this->Trader_mdl->check_trader_addpost();

      if($add_post_check == 0)
      {
      $country_data['cat_qry']    = $this->Trader_mdl->get_categories();
      $country_data['qry']        = $this->Trader_mdl->get_countries_code();
      $cntdata['watch_qry']       = $this->Trader_mdl->watch_cnt();

      $this->load->view('trader/trader_header');

      $this->load->view('trader/trader_addpost_vw', $country_data);
      $this->load->view('trader/trader_footer');
      }
      else if($add_post_check == 1)
      {
      redirect('Trader/plans');
      }
      else if($add_post_check == 2)
      {
      redirect('Trader/fetch_payment_options');
      }
      else
      {

      //echo "<script>swal('Please Contact Admin Team');</script>";
      redirect('Trader');
      }

      } */

    public function car_addpostview($category_id) {
        $this->load->Model('trader/Trader_mdl');

        $country_data['cat_qry'] = $this->Trader_mdl->get_categories();
        $country_data['category_id'] = $category_id;
        $country_data['query'] = $this->Trader_mdl->get_brand_car($category_id);

        $this->load->view('trader/car_addpost_vw', $country_data);
    }

    public function bike_addpostview($category_id) {
        $this->load->Model('trader/Trader_mdl');

        $country_data['cat_qry'] = $this->Trader_mdl->get_categories();
        $country_data['category_id'] = $category_id;

        $country_data['query'] = $this->Trader_mdl->get_brand_bike($category_id);

        $this->load->view('trader/bike_addpost_vw', $country_data);
    }

    public function noplate_addpostview($category_id) {
        $this->load->Model('trader/Trader_mdl');

        $country_data['cat_qry'] = $this->Trader_mdl->get_categories();
        $country_data['template_qry'] = $this->Trader_mdl->get_templates();

        $country_data['category_id'] = $category_id;

        $this->load->view('trader/numberplate_addpost_vw', $country_data);
    }

    function fetch_temp_img() {
        $emirates = $_POST['emirates'];
        $type = $_POST['type'];
        $temp_img_qry = $this->Trader_mdl->get_template_imgs($emirates,$type);
        $img_src = $temp_img_qry;
        echo(json_encode($img_src[0]));
    }

    function fetch_temp_code() {
        $emirates = $_POST['emirates'];
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->Trader_mdl->get_template_code($emirates)));
    }

    function generate_nopl_temp() {
        //header('Content-Type: image/png');
        $base_url = base_url();
        $temp = $_POST['temp'];
       $emrId = $_POST['emrId'];
        $text = $_POST['res'];
        $img_src = $_POST['srcimg'];
        $img_src_long   = $_POST['srcimg_long'];
         $splitText = explode(" ", $text);
        $code = $splitText[0];
        $number = $splitText[1];

  
         $font = $_SERVER['DOCUMENT_ROOT'] .'/application/controllers/Lato-Bold.ttf';

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

		
        $loc = $_SERVER['DOCUMENT_ROOT'] . '/img/noplate/temp/'. $newname;
        $loc_long = $_SERVER['DOCUMENT_ROOT'] . '/img/noplate/temp/'. $newname_long;

        imagepng($image, $loc);
        imagepng($image_long, $loc_long);
        imagedestroy($image);
        imagedestroy($image_long);
        if (file_exists($temp)) {
            unlink($temp);
        }
        $loc = $base_url.'img/noplate/temp/'. $newname;
        $loc_long = $base_url.'img/noplate/temp/'. $newname_long;
        echo(json_encode(array('short'=>$loc,'long'=>$loc_long)));

    }
     function generate_nopl_temp_bike() {
        //header('Content-Type: image/png');
        // $font = 'C:\xampp\htdocs\alshamil\application\controllers\Lato-Bold.ttf';
        $font = $_SERVER['DOCUMENT_ROOT'] .'/application/controllers/Lato-Bold.ttf';
        $base_url       = base_url();
        $temp           = $_POST['temp'];
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
        $loc_short = $_SERVER['DOCUMENT_ROOT'] . '/img/noplate/temp/'. $name_short;
        imagepng($image, $loc_short);
        $loc_short = $base_url.'img/noplate/temp/'. $name_short;
        echo(json_encode(array('short'=>$loc_short,'long'=>'')));
        
    }

    function edit_generate_noplate_temp() {
        header('Content-Type: image/png');
        $base_url = base_url();
        $temp = $_POST['temp'];
        $emrId = $_POST['emrId'];
        $text = $_POST['res'];
        $img_src = $_POST['srcimg'];

     

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

        $font = $_SERVER['DOCUMENT_ROOT'] .'/application/controllers/Lato-Bold.ttf';
       
		$name = microtime();
		$newname = str_replace(' ','',$name);
		$newname = str_replace('.','',$newname);
		$newname = $newname.'.png';
        imagettftext($image, $fontSize, 0, $x, $y, $color, $font, $text);

         $loc = $_SERVER['DOCUMENT_ROOT'] . '/img/noplate/nplates/'. $newname;
        imagepng($image, $loc);
        imagedestroy($image);
           if (file_exists($temp)) {
            unlink($temp);
        }
        $loc = $base_url.'img/noplate/nplates/'. $newname;
        echo $loc;
    }

    public function vertu_addpostview($category_id) {

        $this->load->Model('trader/Trader_mdl');

        $country_data['cat_qry'] = $this->Trader_mdl->get_categories();
        $country_data['category_id'] = $category_id;
        $country_data['query'] = $this->Trader_mdl->get_brand_vertu($category_id);

        $this->load->view('trader/vertu_addpost_vw', $country_data);
    }

    public function watch_addpostview($category_id) {

        $this->load->Model('trader/Trader_mdl');
        $country_data['cat_qry'] = $this->Trader_mdl->get_categories();
        $country_data['category_id'] = $category_id;
        $country_data['query'] = $this->Trader_mdl->get_brand_watch($category_id);

        $this->load->view('trader/watch_addpost_vw', $country_data);
    }

    public function mobile_addpostview($category_id) {
        $this->load->Model('trader/Trader_mdl');
        $country_data['cat_qry'] = $this->Trader_mdl->get_categories();
        $country_data['category_id'] = $category_id;
        $country_data['query'] = $this->Trader_mdl->get_brand_boat($category_id);

        $this->load->view('trader/mobileno_addpost_vw', $country_data);
    }

    function fetch_mob_pref() {
        $mob_oper = $_POST['mob_oper'];
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->Trader_mdl->get_mobprefix($mob_oper)));
    }
    

    public function boat_addpostview($category_id) {
        $this->load->Model('trader/Trader_mdl');
        $country_data['cat_qry'] = $this->Trader_mdl->get_categories();
        $country_data['category_id'] = $category_id;
        $country_data['query'] = $this->Trader_mdl->get_brand_boat($category_id);

        $this->load->view('trader/boat_addpost_vw', $country_data);
    }

    public function phone_addpostview($category_id) {
        $this->load->Model('trader/Trader_mdl');
        $country_data['cat_qry'] = $this->Trader_mdl->get_categories();
        $country_data['category_id'] = $category_id;
        $country_data['query'] = $this->Trader_mdl->get_brand_phone($category_id);

        $this->load->view('trader/phone_addpost_vw', $country_data);
    }

    public function property_addpostview($category_id) {
        $this->load->Model('trader/Trader_mdl');
        $country_data['cat_qry'] = $this->Trader_mdl->get_categories();
        $country_data['prop_qry'] = $this->Trader_mdl->get_subproperties($category_id);

        $country_data['category_id'] = $category_id;
        // $country_data['query'] = $this->Trader_mdl->get_brand_phone($category_id);

        $this->load->view('trader/property_addpost_vw', $country_data);
    }

    public function save_carpost() {
        if (isset($_SESSION['logged_in'])) {
            $session_data = $this->session->userdata('logged_in');
            $trader_id = $session_data['trader_id'];
            $plan_cnt = $this->Trader_mdl->trader_plancnt($trader_id);
            $trader_plancnt = $plan_cnt[0]->planPostCount;
            if ($trader_plancnt > 0) {
                $this->update_plancnt($trader_id, $trader_plancnt);
            }
            $cat = $_POST['txtcat'];
            $img = $_FILES['txtimage']['name'];

            $main_video_img = 'drop_zone1';
            $main_audio_img = 'car_img';

            $post_date = date('Y-m-d h:i:sa');

            $txtmodel = $_POST['txtmodel'];
            $txtbrand = $_POST['txtbrand'];
            $brqry = $this->Trader_mdl->get_brandname($cat, $txtbrand);
            $mdqry = $this->Trader_mdl->get_modelname($cat, $txtbrand, $txtmodel);
            $txtbrandname = $brqry[0]->brandName;
            $txtmodelname = $mdqry[0]->modelName;
            $txtyear = $_POST['txtyear'];
            $txtdetails = $_POST['txtdetails'];

            if (isset($_POST['call_for_price'])) {
                $call_for_price = 1;
                $txtprice = '';
            } else {
                $call_for_price = 0;
                $txtprice = $_POST['txtprice'];
            }



            $tr_user_type = $_SESSION['logged_in']['trader_id'];
            if ($tr_user_type == 1) {
                $prdt_ctype = 1;
            } else {
                $prdt_ctype = 0;
            }
            $data = array();

            $data['productCategoryID'] = '1';
            $data['traderID'] = $trader_id;
            $data['productLocation'] = '';

            $data['productCategoryName'] = 'car';
            $data['productCBrand'] = $txtbrandname;
            $data['productCModel'] = $txtmodelname;
            $data['productCReleaseYear'] = $txtyear;
            $data['productCPrice'] = $txtprice;
            $data['productCCallPrice'] = $call_for_price;

            $data['productCDesc'] = $txtdetails;
            $data['productCSubmitDate'] = $post_date;
            $data['productCStatus'] = 0;
            $data['cartCType'] = $prdt_ctype;
            $data['productCLive'] = 0;
            $data['post_date'] = '';
            $rand_val = rand(10, 10000);
            $data['Cpost_main_img'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $img;

            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|png';
            $config['file_name'] = $rand_val . '_' . $img;
            //$config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('txtimage')) {

                $uploadData = $this->upload->data();

                $productImg = $uploadData['file_name'];
            } else {
                $msg = $this->upload->display_errors('', '');

                $productImg = '';
            }

            $this->db->insert('productcar', $data);
            $last_prd_id = $this->db->insert_id();

            $postdata['traderID'] = $trader_id;
            $postdata['productID'] = $last_prd_id;
            $postdata['productCategoryID'] = '1';
            $postdata['postDesc'] = $txtdetails;
            $postdata['postSubmissionOn'] = $post_date;
            $postdata['postValidTill'] = '';
            $postdata['postStatus'] = '0';
            $this->db->insert('post', $postdata);
            $last_post_id = $this->db->insert_id();





            $images_array = array();
            $config = array();
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'gif|jpg|png';

            $config['overwrite'] = FALSE;
            if (isset($_FILES['productVideo']['name'])) {
                $txtvideo = $_FILES['productVideo']['name'];
                $folder = "uploads/videos/";
                if (move_uploaded_file($_FILES["productVideo"]["tmp_name"], "$folder" . $rand_val . '_' . $_FILES["productVideo"]["name"])) {
					  $video= $folder.'' . $rand_val . '_' . $_FILES["productVideo"]["name"];
                    echo 'video uploaded';
                }
            } else {
                $txtvideo = '';
            }
            $this->load->library('upload');
            if (isset($_FILES['txtfiles']['name'])) {

                foreach ($_FILES['txtfiles']['name'] as $key => $val) {

                    echo $uploadfile = $_FILES["txtfiles"]["tmp_name"][$key];
                    $folder = "uploads/product_images/";
                    $target_file = $folder . $_FILES['txtfiles']['name'][$key];
                    $rand_val = rand(10, 10000);
                    $folder . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
                    if (move_uploaded_file($_FILES["txtfiles"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key])) {
                        $images_array[] = $target_file;

                        $updimg_data['productID'] = $last_prd_id;
                        $updimg_data['postID'] = $last_post_id;
                        $updimg_data['productCategoryID'] = '1';
                        $updimg_data['traderID'] = $trader_id;

                        $updimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
                    
                        $updimg_data['cartType'] = $prdt_ctype;
                        $updimg_data['productLive'] = '0';
                        $updimg_data['productSubmitDate'] = $post_date;
                        $this->db->insert('productiv', $updimg_data);
                    } else {
                        echo "error in uploading";
                    }
                }
            } elseif($txtvideo!='') {
                $updimg_data['productID'] = $last_prd_id;
                $updimg_data['postID'] = $last_post_id;
                $updimg_data['productCategoryID'] = '1';
                $updimg_data['traderID'] = $trader_id;

                $updimg_data['productImage'] = '';
                $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
               
                $updimg_data['cartType'] = $prdt_ctype;
                $updimg_data['productLive'] = '0';
                $updimg_data['productSubmitDate'] = $post_date;
                $this->db->insert('productiv', $updimg_data);
            }

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
            $this->db->where('productCategoryID', '1');
            $this->db->update('category', $cdata);

            $tdata['traderPostCount'] = $update_tr_post_cnt;
            $this->db->where('traderID', $trader_id);
            $this->db->update('trader', $tdata);

             
            $this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-success text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Your Product is Added Successfully</div></div></div>');
//         $path = base_url() . 'Trader/add_post';
//         redirect($path);
        } else {
            redirect('Trader/login_view');
        }
    }

    function update_plancnt($trader_id, $trader_plancnt) {
        $new_plancnt = $trader_plancnt - 1;
        $data['planPostCount'] = $new_plancnt;
        $this->db->where('traderID', $trader_id);
        $this->db->update('tradersubscriptionplan', $data);
    }

    public function save_bikepost() {
        if (isset($_SESSION['logged_in'])) {
            $session_data = $this->session->userdata('logged_in');
            $trader_id = $session_data['trader_id'];
            $plan_cnt = $this->Trader_mdl->trader_plancnt($trader_id);
            $trader_plancnt = $plan_cnt[0]->planPostCount;
            if ($trader_plancnt > 0) {
                $this->update_plancnt($trader_id, $trader_plancnt);
            }
            $cat = $_POST['txtcat'];
            $img = $_FILES['txtimage']['name'];

            $main_video_img = 'drop_zone1';
            $main_audio_img = 'car_img';

            $post_date = date('Y-m-d h:i:sa');

            $txtmodel = $_POST['txtmodel'];
            $txtbrand = $_POST['txtbrand'];
            $brqry = $this->Trader_mdl->get_brandname($cat, $txtbrand);
            $mdqry = $this->Trader_mdl->get_modelname($cat, $txtbrand, $txtmodel);
            $txtbrandname = $brqry[0]->brandName;
            $txtmodelname = $mdqry[0]->modelName;
            $txtyear = $_POST['txtyear'];
            $txtdetails = $_POST['txtdetails'];

            if (isset($_POST['call_for_price'])) {
                $call_for_price = 1;
                $txtprice = '';
            } else {
                $call_for_price = 0;
                $txtprice = $_POST['txtprice'];
            }



            $tr_user_type = $_SESSION['logged_in']['trader_id'];
            if ($tr_user_type == 1) {
                $prdt_ctype = 1;
            } else {
                $prdt_ctype = 0;
            }
            $data = array();

            $data['productCategoryID'] = '2';
            $data['traderID'] = $trader_id;
            $data['productLocation'] = '';

            $data['productCategoryName'] = 'bike';
            $data['productBBrand'] = $txtbrandname;
            $data['productBModel'] = $txtmodelname;
            $data['productBReleaseYear'] = $txtyear;
            $data['productBPrice'] = $txtprice;
            $data['productBCallPrice'] = $call_for_price;

            $data['productBDesc'] = $txtdetails;
            $data['productBSubmitDate'] = $post_date;
            $data['productBStatus'] = 0;
            $data['cartBType'] = $prdt_ctype;
            $data['productBLive'] = 0;
            $data['post_date'] = '';
            $rand_val = rand(10, 10000);
            $data['Bpost_main_img'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $img;

            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|png';
            $config['file_name'] = $rand_val . '_' . $img;
            //$config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('txtimage')) {

                $uploadData = $this->upload->data();

                $productImg = $uploadData['file_name'];
            } else {
                $msg = $this->upload->display_errors('', '');

                $productImg = '';
            }

            $this->db->insert('productbike', $data);
            $last_prd_id = $this->db->insert_id();

            $postdata['traderID'] = $trader_id;
            $postdata['productID'] = $last_prd_id;
            $postdata['productCategoryID'] = '2';
            $postdata['postDesc'] = $txtdetails;
            $postdata['postSubmissionOn'] = $post_date;
            $postdata['postValidTill'] = '';
            $postdata['postStatus'] = '0';
            $this->db->insert('post', $postdata);
            $last_post_id = $this->db->insert_id();





            $images_array = array();
            $config = array();
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'gif|jpg|png';

            $config['overwrite'] = FALSE;
            if (isset($_FILES['productVideo']['name'])) {
                $txtvideo = $_FILES['productVideo']['name'];
                $folder = "uploads/videos/";
                if (move_uploaded_file($_FILES["productVideo"]["tmp_name"], "$folder" . $rand_val . '_' . $_FILES["productVideo"]["name"])) {
					  $video= $folder.'' . $rand_val . '_' . $_FILES["productVideo"]["name"];
                    echo 'video uploaded';
                }
            } else {
                $txtvideo = '';
            }
            $this->load->library('upload');
            if (isset($_FILES['txtfiles']['name'])) {

                foreach ($_FILES['txtfiles']['name'] as $key => $val) {

                    echo $uploadfile = $_FILES["txtfiles"]["tmp_name"][$key];
                    $folder = "uploads/product_images/";
                    $target_file = $folder . $_FILES['txtfiles']['name'][$key];
                    $rand_val = rand(10, 10000);
                    $folder . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
                    if (move_uploaded_file($_FILES["txtfiles"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key])) {
                        $images_array[] = $target_file;

                        $updimg_data['productID'] = $last_prd_id;
                        $updimg_data['postID'] = $last_post_id;
                        $updimg_data['productCategoryID'] = '2';
                        $updimg_data['traderID'] = $trader_id;

                        $updimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
                        $updimg_data['cartType'] = $prdt_ctype;
                        $updimg_data['productLive'] = '0';
                        $updimg_data['productSubmitDate'] = $post_date;
                        $this->db->insert('productiv', $updimg_data);
                    } else {
                        echo "error in uploading";
                    }
                }
            } elseif($txtvideo!='') {
                $updimg_data['productID'] = $last_prd_id;
                $updimg_data['postID'] = $last_post_id;
                $updimg_data['productCategoryID'] = '2';
                $updimg_data['traderID'] = $trader_id;

                $updimg_data['productImage'] = '';
                $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
                $updimg_data['cartType'] = $prdt_ctype;
                $updimg_data['productLive'] = '0';
                $updimg_data['productSubmitDate'] = $post_date;
                $this->db->insert('productiv', $updimg_data);
            }

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
            $this->db->where('productCategoryID', '2');
            $this->db->update('category', $cdata);

            $tdata['traderPostCount'] = $update_tr_post_cnt;
            $this->db->where('traderID', $trader_id);
            $this->db->update('trader', $tdata);

            $this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-success text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Your Product is Added Successfully</div></div></div>');

//         $path = base_url() . 'Trader/add_post';
//         re
        } else {
            redirect('Trader/login_view');
        }
    }

    public function save_vertupost() {
        if (isset($_SESSION['logged_in'])) {
            $session_data = $this->session->userdata('logged_in');
            $trader_id = $session_data['trader_id'];
            $plan_cnt = $this->Trader_mdl->trader_plancnt($trader_id);
            $trader_plancnt = $plan_cnt[0]->planPostCount;
            if ($trader_plancnt > 0) {
                $this->update_plancnt($trader_id, $trader_plancnt);
            }


            $cat = $_POST['txtcat'];
            $img = $_FILES['txtimage']['name'];

            $main_video_img = 'drop_zone1';
            $main_audio_img = 'car_img';

            $post_date = date('Y-m-d h:i:sa');

            $txtmodel = $_POST['txtmodel'];
            $txtbrand = $_POST['txtbrand'];
            $brqry = $this->Trader_mdl->get_brandname($cat, $txtbrand);
            $mdqry = $this->Trader_mdl->get_modelname($cat, $txtbrand, $txtmodel);
            $txtbrandname = $brqry[0]->brandName;
            $txtmodelname = $mdqry[0]->modelName;

            $txtdetails = $_POST['txtdetails'];

            if (isset($_POST['call_for_price'])) {
                $call_for_price = 1;
                $txtprice = '';
            } else {
                $call_for_price = 0;
                $txtprice = $_POST['txtprice'];
            }



            $tr_user_type = $_SESSION['logged_in']['trader_id'];
            if ($tr_user_type == 1) {
                $prdt_ctype = 1;
            } else {
                $prdt_ctype = 0;
            }
            $data = array();

            $data['productCategoryID'] = '4';
            $data['traderID'] = $trader_id;
            $data['productLocation'] = '';

            $data['productCategoryName'] = 'vertu';
            $data['productVBrand'] = $txtbrandname;
            $data['productVModel'] = $txtmodelname;

            $data['productVPrice'] = $txtprice;
            $data['productVCallPrice'] = $call_for_price;

            $data['productVDesc'] = $txtdetails;
            $data['productVSubmitDate'] = $post_date;
            $data['productVStatus'] = 0;
            $data['cartVType'] = $prdt_ctype;
            $data['productVLive'] = 0;
            $data['post_date'] = '';
            $rand_val = rand(10, 10000);
            $data['Vpost_main_img'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $img;

            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|png';
            $config['file_name'] = $rand_val . '_' . $img;
            //$config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('txtimage')) {

                $uploadData = $this->upload->data();

                $productImg = $uploadData['file_name'];
            } else {
                $msg = $this->upload->display_errors('', '');

                $productImg = '';
            }

            $this->db->insert('productvertu', $data);
            $last_prd_id = $this->db->insert_id();

            $postdata['traderID'] = $trader_id;
            $postdata['productID'] = $last_prd_id;
            $postdata['productCategoryID'] = '4';
            $postdata['postDesc'] = $txtdetails;
            $postdata['postSubmissionOn'] = $post_date;
            $postdata['postValidTill'] = '';
            $postdata['postStatus'] = '0';
            $this->db->insert('post', $postdata);
            $last_post_id = $this->db->insert_id();





            $images_array = array();
            $config = array();
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'gif|jpg|png';

            $config['overwrite'] = FALSE;
            if (isset($_FILES['productVideo']['name'])) {
                $txtvideo = $_FILES['productVideo']['name'];
                $folder = "uploads/videos/";
                if (move_uploaded_file($_FILES["productVideo"]["tmp_name"], "$folder" . $rand_val . '_' . $_FILES["productVideo"]["name"])) {
					  $video= $folder.'' . $rand_val . '_' . $_FILES["productVideo"]["name"];
                    echo 'video uploaded';
                }
            } else {
                $txtvideo = '';
            }
            $this->load->library('upload');
            if (isset($_FILES['txtfiles']['name'])) {

                foreach ($_FILES['txtfiles']['name'] as $key => $val) {

                    echo $uploadfile = $_FILES["txtfiles"]["tmp_name"][$key];
                    $folder = "uploads/product_images/";
                    $target_file = $folder . $_FILES['txtfiles']['name'][$key];
                    $rand_val = rand(10, 10000);
                    $folder . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
                    if (move_uploaded_file($_FILES["txtfiles"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key])) {
                        $images_array[] = $target_file;

                        $updimg_data['productID'] = $last_prd_id;
                        $updimg_data['postID'] = $last_post_id;
                        $updimg_data['productCategoryID'] = '4';
                        $updimg_data['traderID'] = $trader_id;

                        $updimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
                   
                        $updimg_data['cartType'] = $prdt_ctype;
                        $updimg_data['productLive'] = '0';
                        $updimg_data['productSubmitDate'] = $post_date;
                        $this->db->insert('productiv', $updimg_data);
                    } else {
                        echo "error in uploading";
                    }
                }
            } elseif($txtvideo!='') {
                $updimg_data['productID'] = $last_prd_id;
                $updimg_data['postID'] = $last_post_id;
                $updimg_data['productCategoryID'] = '4';
                $updimg_data['traderID'] = $trader_id;

                $updimg_data['productImage'] = '';
                $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
                $updimg_data['cartType'] = $prdt_ctype;
                $updimg_data['productLive'] = '0';
                $updimg_data['productSubmitDate'] = $post_date;
                $this->db->insert('productiv', $updimg_data);
            }

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
            $this->db->where('productCategoryID', '2');
            $this->db->update('category', $cdata);

            $tdata['traderPostCount'] = $update_tr_post_cnt;
            $this->db->where('traderID', $trader_id);
            $this->db->update('trader', $tdata);


            $this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-success text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Your Product is Added Successfully</div></div></div>');
//         $path = base_url() . 'Trader/add_post';
//         re
        } else {
            redirect('Trader/login_view');
        }
    }

    public function save_watchpost() {
        if (isset($_SESSION['logged_in'])) {
            $session_data = $this->session->userdata('logged_in');
            $trader_id = $session_data['trader_id'];
            $plan_cnt = $this->Trader_mdl->trader_plancnt($trader_id);
            $trader_plancnt = $plan_cnt[0]->planPostCount;
            if ($trader_plancnt > 0) {
                $this->update_plancnt($trader_id, $trader_plancnt);
            }
            $cat = $_POST['txtcat'];
            $img = $_FILES['txtimage']['name'];

            $main_video_img = 'drop_zone1';
            $main_audio_img = 'car_img';

            $post_date = date('Y-m-d h:i:sa');

            $txtmodel = $_POST['txtmodel'];
            $txtbrand = $_POST['txtbrand'];
            $brqry = $this->Trader_mdl->get_brandname($cat, $txtbrand);
            $mdqry = $this->Trader_mdl->get_modelname($cat, $txtbrand, $txtmodel);
            $txtbrandname = $brqry[0]->brandName;
            $txtmodelname = $mdqry[0]->modelName;

            $txtdetails = $_POST['txtdetails'];

            if (isset($_POST['call_for_price'])) {
                $call_for_price = 1;
                $txtprice = '';
            } else {
                $call_for_price = 0;
                $txtprice = $_POST['txtprice'];
            }



            $tr_user_type = $_SESSION['logged_in']['trader_id'];
            if ($tr_user_type == 1) {
                $prdt_ctype = 1;
            } else {
                $prdt_ctype = 0;
            }
            $data = array();

            $data['productCategoryID'] = '5';
            $data['traderID'] = $trader_id;
            $data['productLocation'] = '';

            $data['productCategoryName'] = 'Watch';
            $data['productWBrand'] = $txtbrandname;
            $data['productWModel'] = $txtmodelname;

            $data['productWPrice'] = $txtprice;
            $data['productWCallPrice'] = $call_for_price;

            $data['productWDesc'] = $txtdetails;
            $data['productWSubmitDate'] = $post_date;
            $data['productWStatus'] = 0;
            $data['cartWType'] = $prdt_ctype;
            $data['productWLive'] = 0;
            $data['post_date'] = '';
            $rand_val = rand(10, 10000);
            $data['Wpost_main_img'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $img;

            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|png';
            $config['file_name'] = $rand_val . '_' . $img;
            //$config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('txtimage')) {

                $uploadData = $this->upload->data();

                $productImg = $uploadData['file_name'];
            } else {
                $msg = $this->upload->display_errors('', '');

                $productImg = '';
            }

            $this->db->insert('productwatch', $data);
            $last_prd_id = $this->db->insert_id();

            $postdata['traderID'] = $trader_id;
            $postdata['productID'] = $last_prd_id;
            $postdata['productCategoryID'] = '5';
            $postdata['postDesc'] = $txtdetails;
            $postdata['postSubmissionOn'] = $post_date;
            $postdata['postValidTill'] = '';
            $postdata['postStatus'] = '0';
            $this->db->insert('post', $postdata);
            $last_post_id = $this->db->insert_id();





            $images_array = array();
            $config = array();
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'gif|jpg|png';

            $config['overwrite'] = FALSE;
            if (isset($_FILES['productVideo']['name'])) {
                $txtvideo = $_FILES['productVideo']['name'];
                $folder = "uploads/videos/";
                if (move_uploaded_file($_FILES["productVideo"]["tmp_name"], "$folder" . $rand_val . '_' . $_FILES["productVideo"]["name"])) {
					  $video= $folder.'' . $rand_val . '_' . $_FILES["productVideo"]["name"];
                    echo 'video uploaded';
                }
            } else {
                $txtvideo = '';
            }
            $this->load->library('upload');
            if (isset($_FILES['txtfiles']['name'])) {

                foreach ($_FILES['txtfiles']['name'] as $key => $val) {

                    echo $uploadfile = $_FILES["txtfiles"]["tmp_name"][$key];
                    $folder = "uploads/product_images/";
                    $target_file = $folder . $_FILES['txtfiles']['name'][$key];
                    $rand_val = rand(10, 10000);
                    $folder . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
                    if (move_uploaded_file($_FILES["txtfiles"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key])) {
                        $images_array[] = $target_file;

                        $updimg_data['productID'] = $last_prd_id;
                        $updimg_data['postID'] = $last_post_id;
                        $updimg_data['productCategoryID'] = '5';
                        $updimg_data['traderID'] = $trader_id;

                        $updimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
                      
                        $updimg_data['cartType'] = $prdt_ctype;
                        $updimg_data['productLive'] = '0';
                        $updimg_data['productSubmitDate'] = $post_date;
                        $this->db->insert('productiv', $updimg_data);
                    } else {
                        echo "error in uploading";
                    }
                }
            } elseif($txtvideo!='') {
                $updimg_data['productID'] = $last_prd_id;
                $updimg_data['postID'] = $last_post_id;
                $updimg_data['productCategoryID'] = '5';
                $updimg_data['traderID'] = $trader_id;

                $updimg_data['productImage'] = '';
                $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
                $updimg_data['cartType'] = $prdt_ctype;
                $updimg_data['productLive'] = '0';
                $updimg_data['productSubmitDate'] = $post_date;
                $this->db->insert('productiv', $updimg_data);
            }

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
            $this->db->where('productCategoryID', '5');
            $this->db->update('category', $cdata);

            $tdata['traderPostCount'] = $update_tr_post_cnt;
            $this->db->where('traderID', $trader_id);
            $this->db->update('trader', $tdata);


            $this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-success text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Your Product is Added Successfully</div></div></div>');
//         $path = base_url() . 'Trader/add_post';
//         re
        } else {
            redirect('trader/login_view');
        }
    }

    public function save_noplatepost() {
      
        if (isset($_SESSION['logged_in'])) {
            $session_data = $this->session->userdata('logged_in');
            $trader_id = $session_data['trader_id'];
            $plan_cnt = $this->Trader_mdl->trader_plancnt($trader_id);
            $trader_plancnt = $plan_cnt[0]->planPostCount;
            if ($trader_plancnt > 0) {
                $this->update_plancnt($trader_id, $trader_plancnt);
            }
            $post_date = date('Y-m-d h:i:sa');
            $temp = $_POST['temp'];
            $nplates = str_replace("img/noplate/temp/", "uploads/product_images/nplates/", $temp);
            $temp_long = $_POST['long_tempImg'];
            $nplates_long = str_replace("img/noplate/temp/", "uploads/product_images/nplates/", $temp_long);
            $link_array1 = explode('/',$nplates);
            $link_array2 = explode('/',$nplates_long);
           // echo $page = end($link_array);
            copy($temp,  $_SERVER['DOCUMENT_ROOT'] . "/uploads/product_images/nplates/".end($link_array1));
            copy($temp_long,  $_SERVER['DOCUMENT_ROOT'] . "/uploads/product_images/nplates/".end($link_array2));
             unlink($temp);
             unlink($temp_long);
           // rename($temp, $nplates);
           // rename($temp_long, $nplates_long);
            $cat = $_POST['txtcat'];
            $txtemirates = $_POST['txtemirates'];
            $txtcode = $_POST['txtcode'];
            $txtno_digs = $_POST['txtno_digs'];
            $txtno = $_POST['txtnumber'];
            
            $txtdetails = $_POST['txtdetails'];
            $session_data = $this->session->userdata('logged_in');
            $trader_id = $session_data['trader_id'];
            if (isset($_POST['price'])) {
                $call_for_price = 1;
                $txtprice = 0;
            } else {
                $call_for_price = 0;
                $txtprice = $_POST['txtprice'];
            }
            //echo $_POST['txtType'];exit();
           
                $txtType = isset($_POST['txtprice'])?$_POST['txtprice']:0;
           
            $tr_user_type = $_SESSION['logged_in']['trader_id'];
            if ($tr_user_type == 1) {
                $prdt_ctype = 1;
            } else {
                $prdt_ctype = 0;
            }

            $data = array();


            $data['traderID'] = $trader_id;
            $data['productLocation'] = '';
            $data['productCategoryID'] = '3';
            $data['productCategoryName'] = 'number plate';
            $data['productNPEmrites'] = $_POST['emirates_name'];
            $data['productNPTemplate'] = '1';
            $data['productNPCode'] = $txtcode;
            $data['productNPDigits'] = $txtno_digs;
            $data['NPpost_main_img'] = $nplates;

            $data['productNPNmbr'] = $txtno;
            $data['productNPPrice'] = $txtprice;
            $data['productNPCallPrice'] = $call_for_price;
            $data['productNPDesc'] = $txtdetails;
            $data['productNPSubmitDate'] = $post_date;
            $data['type'] = $txtType;
            $this->db->insert('productnp', $data);
            $last_prd_id = $this->db->insert_id();

            $postdata['productCategoryID'] = '3';
            $postdata['productID'] = $last_prd_id;
            $postdata['traderID'] = $trader_id;
            $postdata['postDesc'] = $txtdetails;
            $postdata['postSubmissionOn'] = $post_date;
            $postdata['postValidTill'] = '';
            $postdata['postStatus'] = '0';
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

            
            // $updimg_data['productID'] = $last_prd_id;
            // $updimg_data['postID'] = $last_post_id;
            // $updimg_data['productCategoryID'] = '7';
            // $updimg_data['traderID'] = $trader_id;

            // $updimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
            // $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $video;
            // $updimg_data['cartType'] = $prdt_ctype;
            // $updimg_data['productLive'] = '0';
            // $updimg_data['productSubmitDate'] = $post_date;
            // $this->db->insert('productiv', $updimg_data);

            $saveSecImage = $this->Trader_mdl->saveSecondImage($last_prd_id,$nplates_long,$last_post_id,$cat);

            $cdata['categoryProductCount'] = $update_cat_cnt;
            $this->db->where('productCategoryID', '3');
            $this->db->update('category', $cdata);

            $tdata['traderPostCount'] = $update_tr_post_cnt;
            $this->db->where('traderID', $trader_id);
            $this->db->update('trader', $tdata);
            $this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-success text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Your Product is Added Successfully</div></div></div>');
        } else {
            redirect('Trader/login_view');
        }
    }

    public function save_boatpost() {
        if (isset($_SESSION['logged_in'])) {
            $session_data = $this->session->userdata('logged_in');
            $trader_id = $session_data['trader_id'];
            $plan_cnt = $this->Trader_mdl->trader_plancnt($trader_id);
            $trader_plancnt = $plan_cnt[0]->planPostCount;
            if ($trader_plancnt > 0) {
                $this->update_plancnt($trader_id, $trader_plancnt);
            }

            $cat = $_POST['txtcat'];
            $img = $_FILES['txtimage']['name'];

            $main_video_img = 'drop_zone1';
            $main_audio_img = 'car_img';

            $post_date = date('Y-m-d h:i:sa');

            $txtmodel = $_POST['txtmodel'];
            $txtbrand = $_POST['txtbrand'];
            $brqry = $this->Trader_mdl->get_brandname($cat, $txtbrand);
            $mdqry = $this->Trader_mdl->get_modelname($cat, $txtbrand, $txtmodel);
            $txtbrandname = $brqry[0]->brandName;
            $txtmodelname = $mdqry[0]->modelName;

            $txtdetails = $_POST['txtdetails'];

            if (isset($_POST['call_for_price'])) {
                $call_for_price = 1;
                $txtprice = '';
            } else {
                $call_for_price = 0;
                $txtprice = $_POST['txtprice'];
            }



            $tr_user_type = $_SESSION['logged_in']['trader_id'];
            if ($tr_user_type == 1) {
                $prdt_ctype = 1;
            } else {
                $prdt_ctype = 0;
            }
            $data = array();

            $data['productCategoryID'] = '7';
            $data['traderID'] = $trader_id;
            $data['productLocation'] = '';

            $data['productCategoryName'] = 'Boat';
            $data['productBtBrand'] = $txtbrandname;
            $data['productBtModel'] = $txtmodelname;

            $data['productBTPrice'] = $txtprice;
            $data['productBtCallPrice'] = $call_for_price;

            $data['productBDesc'] = $txtdetails;
            $data['productBTSubmitDate'] = $post_date;
            $data['productBTStatus'] = 0;
            $data['cartBTType'] = $prdt_ctype;
            $data['productBtLive'] = 0;
            $data['post_date'] = '';
            $rand_val = rand(10, 10000);
            $data['BTpost_main_img'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $img;

            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|png';
            $config['file_name'] = $rand_val . '_' . $img;
            //$config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('txtimage')) {

                $uploadData = $this->upload->data();

                $productImg = $uploadData['file_name'];
            } else {
                $msg = $this->upload->display_errors('', '');

                $productImg = '';
            }

            $this->db->insert('productboat', $data);
            $last_prd_id = $this->db->insert_id();

            $postdata['traderID'] = $trader_id;
            $postdata['productID'] = $last_prd_id;
            $postdata['productCategoryID'] = '7';
            $postdata['postDesc'] = $txtdetails;
            $postdata['postSubmissionOn'] = $post_date;
            $postdata['postValidTill'] = '';
            $postdata['postStatus'] = '0';
            $this->db->insert('post', $postdata);
            $last_post_id = $this->db->insert_id();





            $images_array = array();
            $config = array();
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'gif|jpg|png';

            $config['overwrite'] = FALSE;
            if (isset($_FILES['productVideo']['name'])) {
                $txtvideo = $_FILES['productVideo']['name'];
                $folder = "uploads/videos/";
                if (move_uploaded_file($_FILES["productVideo"]["tmp_name"], "$folder" . $rand_val . '_' . $_FILES["productVideo"]["name"])) {
					  $video= $folder.'' . $rand_val . '_' . $_FILES["productVideo"]["name"];
                    echo 'video uploaded';
                }
            } else {
                $txtvideo = '';
            }
            $this->load->library('upload');
            if (isset($_FILES['txtfiles']['name'])) {

                foreach ($_FILES['txtfiles']['name'] as $key => $val) {

                    echo $uploadfile = $_FILES["txtfiles"]["tmp_name"][$key];
                    $folder = "uploads/product_images/";
                    $target_file = $folder . $_FILES['txtfiles']['name'][$key];
                    $rand_val = rand(10, 10000);
                    $folder . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
                    if (move_uploaded_file($_FILES["txtfiles"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key])) {
                        $images_array[] = $target_file;

                        $updimg_data['productID'] = $last_prd_id;
                        $updimg_data['postID'] = $last_post_id;
                        $updimg_data['productCategoryID'] = '7';
                        $updimg_data['traderID'] = $trader_id;

                        $updimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
                      
                        $updimg_data['cartType'] = $prdt_ctype;
                        $updimg_data['productLive'] = '0';
                        $updimg_data['productSubmitDate'] = $post_date;
                        $this->db->insert('productiv', $updimg_data);
                    } else {
                        echo "error in uploading";
                    }
                }
            }   $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $video;{
                $updimg_data['productID'] = $last_prd_id;
                $updimg_data['postID'] = $last_post_id;
                $updimg_data['productCategoryID'] = '7';
                $updimg_data['traderID'] = $trader_id;

                $updimg_data['productImage'] = '';
                $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
                $updimg_data['cartType'] = $prdt_ctype;
                $updimg_data['productLive'] = '0';
                $updimg_data['productSubmitDate'] = $post_date;
                $this->db->insert('productiv', $updimg_data);
            }

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
            $this->db->where('productCategoryID', '7');
            $this->db->update('category', $cdata);

            $tdata['traderPostCount'] = $update_tr_post_cnt;
            $this->db->where('traderID', $trader_id);
            $this->db->update('trader', $tdata);


            $this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-success text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Your Product is Added Successfully</div></div></div>');
        } else {
            redirect('Trader/login_view');
        }
    }

    public function save_phonepost() {
        if (isset($_SESSION['logged_in'])) {
            $session_data = $this->session->userdata('logged_in');
            $trader_id = $session_data['trader_id'];
            $plan_cnt = $this->Trader_mdl->trader_plancnt($trader_id);
            $trader_plancnt = $plan_cnt[0]->planPostCount;
            if ($trader_plancnt > 0) {
                $this->update_plancnt($trader_id, $trader_plancnt);
            }

            $cat = $_POST['txtcat'];
            $img = $_FILES['txtimage']['name'];

            $main_video_img = 'drop_zone1';
            $main_audio_img = 'car_img';

            $post_date = date('Y-m-d h:i:sa');

            $txtmodel = $_POST['txtmodel'];
            $txtbrand = $_POST['txtbrand'];
            $brqry = $this->Trader_mdl->get_brandname($cat, $txtbrand);
            $mdqry = $this->Trader_mdl->get_modelname($cat, $txtbrand, $txtmodel);
            $txtbrandname = $brqry[0]->brandName;
            $txtmodelname = $mdqry[0]->modelName;

            $txtdetails = $_POST['txtdetails'];

            if (isset($_POST['call_for_price'])) {
                $call_for_price = 1;
                $txtprice = '';
            } else {
                $call_for_price = 0;
                $txtprice = $_POST['txtprice'];
            }



            $tr_user_type = $_SESSION['logged_in']['trader_id'];
            if ($tr_user_type == 1) {
                $prdt_ctype = 1;
            } else {
                $prdt_ctype = 0;
            }
            $data = array();

            $data['productCategoryID'] = '8';
            $data['traderID'] = $trader_id;
            $data['productLocation'] = '';

            $data['productCategoryName'] = 'Phone';
            $data['productPBrand'] = $txtbrandname;
            $data['productPModel'] = $txtmodelname;

            $data['productPHPrice'] = $txtprice;
            $data['productPhCallPrice'] = $call_for_price;

            $data['productPDesc'] = $txtdetails;
            $data['productPSubmitDate'] = $post_date;
            $data['productPHStatus'] = 0;
            $data['cartPHType'] = $prdt_ctype;
            $data['productPhLive'] = 0;
            $data['post_date'] = '';
            $rand_val = rand(10, 10000);
            $data['PHpost_main_img'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $img;

            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|png';
            $config['file_name'] = $rand_val . '_' . $img;
            //$config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('txtimage')) {

                $uploadData = $this->upload->data();

                $productImg = $uploadData['file_name'];
            } else {
                $msg = $this->upload->display_errors('', '');

                $productImg = '';
            }

            $this->db->insert('productphone', $data);
            $last_prd_id = $this->db->insert_id();

            $postdata['traderID'] = $trader_id;
            $postdata['productID'] = $last_prd_id;
            $postdata['productCategoryID'] = '8';
            $postdata['postDesc'] = $txtdetails;
            $postdata['postSubmissionOn'] = $post_date;
            $postdata['postValidTill'] = '';
            $postdata['postStatus'] = '0';
            $this->db->insert('post', $postdata);
            $last_post_id = $this->db->insert_id();





            $images_array = array();
            $config = array();
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'gif|jpg|png';

            $config['overwrite'] = FALSE;
            if (isset($_FILES['productVideo']['name'])) {
                $txtvideo = $_FILES['productVideo']['name'];
                $folder = "uploads/videos/";
                if (move_uploaded_file($_FILES["productVideo"]["tmp_name"], "$folder" . $rand_val . '_' . $_FILES["productVideo"]["name"])) {
					  $video= $folder.'' . $rand_val . '_' . $_FILES["productVideo"]["name"];
                    echo 'video uploaded';
                }
            } else {
                $txtvideo = '';
            }
            $this->load->library('upload');
            if (isset($_FILES['txtfiles']['name'])) {

                foreach ($_FILES['txtfiles']['name'] as $key => $val) {

                    echo $uploadfile = $_FILES["txtfiles"]["tmp_name"][$key];
                    $folder = "uploads/product_images/";
                    $target_file = $folder . $_FILES['txtfiles']['name'][$key];
                    $rand_val = rand(10, 10000);
                    $folder . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
                    if (move_uploaded_file($_FILES["txtfiles"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key])) {
                        $images_array[] = $target_file;

                        $updimg_data['productID'] = $last_prd_id;
                        $updimg_data['postID'] = $last_post_id;
                        $updimg_data['productCategoryID'] = '8';
                        $updimg_data['traderID'] = $trader_id;

                        $updimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
                      
                        $updimg_data['cartType'] = $prdt_ctype;
                        $updimg_data['productLive'] = '0';
                        $updimg_data['productSubmitDate'] = $post_date;
                        $this->db->insert('productiv', $updimg_data);
                    } else {
                        echo "error in uploading";
                    }
                }
            } elseif($txtvideo!='') {
                $updimg_data['productID'] = $last_prd_id;
                $updimg_data['postID'] = $last_post_id;
                $updimg_data['productCategoryID'] = '8';
                $updimg_data['traderID'] = $trader_id;

                $updimg_data['productImage'] = '';
                $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
                $updimg_data['cartType'] = $prdt_ctype;
                $updimg_data['productLive'] = '0';
                $updimg_data['productSubmitDate'] = $post_date;
                $this->db->insert('productiv', $updimg_data);
            }

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
            $this->db->where('productCategoryID', '8');
            $this->db->update('category', $cdata);

            $tdata['traderPostCount'] = $update_tr_post_cnt;
            $this->db->where('traderID', $trader_id);
            $this->db->update('trader', $tdata);


            $this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-success text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Your Product is Added Successfully</div></div></div>');
//         $path = base_url() . 'Trader/add_post';
//         re
        } else {
            redirect('Trader/login_view');
        }
    }

    function save_propertypost() {
        if (isset($_SESSION['logged_in'])) {
            $session_data = $this->session->userdata('logged_in');
            $trader_id = $session_data['trader_id'];
            $plan_cnt = $this->Trader_mdl->trader_plancnt($trader_id);
            $trader_plancnt = $plan_cnt[0]->planPostCount;
            if ($trader_plancnt > 0) {
                $this->update_plancnt($trader_id, $trader_plancnt);
            }

            $cat = $_POST['txtcat'];
            $img = $_FILES['txtimage']['name'];

            $main_video_img = 'drop_zone1';
            $main_audio_img = 'car_img';

            $post_date = date('Y-m-d h:i:sa');

            $txtsubcat = $_POST['txtsubcat'];
            $txtprop = $_POST['txtprop'];
            $brqry = $this->Trader_mdl->get_brandname($cat, $txtsubcat);
            $mdqry = $this->Trader_mdl->get_modelname($cat, $txtsubcat, $txtprop);
            $txtbrandname = $brqry[0]->brandName;
            $txtmodelname = $mdqry[0]->modelName;

            $txtdetails = $_POST['txtdetails'];

            if (isset($_POST['call_for_price'])) {
                $call_for_price = 1;
                $txtprice = '';
            } else {
                $call_for_price = 0;
                $txtprice = $_POST['txtprice'];
            }




            $tr_user_type = $_SESSION['logged_in']['trader_id'];
            if ($tr_user_type == 1) {
                $prdt_ctype = 1;
            } else {
                $prdt_ctype = 0;
            }
            $data = array();

            $data['productCategoryID'] = '9';
            $data['traderID'] = $trader_id;
            $data['productLocation'] = '';

            $data['productCategoryName'] = 'property';
            $data['productPropSC'] = $txtbrandname;
            $data['productPropType'] = $txtmodelname;
            $data['productPRSubmitDate'] = $post_date;

            $data['productPRPrice'] = $txtprice;
            $data['productPropCallPrice'] = $call_for_price;

            $data['productDesc'] = $txtdetails;

            $data['productPRStatus'] = 0;
            $data['cartPRType'] = $prdt_ctype;
            $data['productPrLive'] = 0;
            $data['post_date'] = '';
            $rand_val = rand(10, 10000);
            $data['PRpost_main_img'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $img;

            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'jpg|png';
            $config['file_name'] = $rand_val . '_' . $img;
            //$config['max_size'] = '1000000000000000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('txtimage')) {

                $uploadData = $this->upload->data();

                $productImg = $uploadData['file_name'];
            } else {
                $msg = $this->upload->display_errors('', '');

                $productImg = '';
            }

            $this->db->insert('productproperty', $data);
            $last_prd_id = $this->db->insert_id();

            $postdata['traderID'] = $trader_id;
            $postdata['productID'] = $last_prd_id;
            $postdata['productCategoryID'] = '9';
            $postdata['postDesc'] = $txtdetails;
            $postdata['postSubmissionOn'] = $post_date;
            $postdata['postValidTill'] = '';
            $postdata['postStatus'] = '0';
            $this->db->insert('post', $postdata);
            $last_post_id = $this->db->insert_id();





            $images_array = array();
            $config = array();
            $config['upload_path'] = 'uploads/product_images/';
            $config['allowed_types'] = 'gif|jpg|png';

            $config['overwrite'] = FALSE;
            if (isset($_FILES['productVideo']['name'])) {
                $txtvideo = $_FILES['productVideo']['name'];
                $folder = "uploads/videos/";
                if (move_uploaded_file($_FILES["productVideo"]["tmp_name"], "$folder" . $rand_val . '_' . $_FILES["productVideo"]["name"])) {
					  $video= $folder.'' . $rand_val . '_' . $_FILES["productVideo"]["name"];
                    echo 'video uploaded';
                }
            } else {
                $txtvideo = '';
            }
            $this->load->library('upload');
            if (isset($_FILES['txtfiles']['name'])) {

                foreach ($_FILES['txtfiles']['name'] as $key => $val) {

                    echo $uploadfile = $_FILES["txtfiles"]["tmp_name"][$key];
                    $folder = "uploads/product_images/";
                    $target_file = $folder . $_FILES['txtfiles']['name'][$key];
                    $rand_val = rand(10, 10000);
                    $folder . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
                    if (move_uploaded_file($_FILES["txtfiles"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key])) {
                        $images_array[] = $target_file;

                        $updimg_data['productID'] = $last_prd_id;
                        $updimg_data['postID'] = $last_post_id;
                        $updimg_data['productCategoryID'] = '1';
                        $updimg_data['traderID'] = $trader_id;

                        $updimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
                       
                        $updimg_data['cartType'] = $prdt_ctype;
                        $updimg_data['productLive'] = '0';
                        $updimg_data['productSubmitDate'] = $post_date;
                        $this->db->insert('productiv', $updimg_data);
                    } else {
                        echo "error in uploading";
                    }
                }
            } elseif($txtvideo!='') {
                $updimg_data['productID'] = $last_prd_id;
                $updimg_data['postID'] = $last_post_id;
                $updimg_data['productCategoryID'] = '9';
                $updimg_data['traderID'] = $trader_id;

                $updimg_data['productImage'] = '';
                $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
                $updimg_data['cartType'] = $prdt_ctype;
                $updimg_data['productLive'] = '0';
                $updimg_data['productSubmitDate'] = $post_date;
                $this->db->insert('productiv', $updimg_data);
            }

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
            $this->db->where('productCategoryID', '9');
            $this->db->update('category', $cdata);

            $tdata['traderPostCount'] = $update_tr_post_cnt;
            $this->db->where('traderID', $trader_id);
            $this->db->update('trader', $tdata);


            $this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-success text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Your Product is Added Successfully</div></div></div>');
        } else {
            redirect('Trader/login_view');
        }
    }

    function fetch_category() {
        $x = $_POST['category'];

        if ($x == '1') {
            $country_data['qry'] = $this->Trader_mdl->get_countries_code();
            $country_data['cat_qry'] = $this->Trader_mdl->get_categories();
            $country_data['query'] = $this->Trader_mdl->get_brand_car($x);

            $this->load->view('trader/car_addpost_vw', $country_data);
        } else if ($x == '2') {
            $country_data['query'] = $this->Trader_mdl->get_brand_bike($x);

            $country_data['cat_qry'] = $this->Trader_mdl->get_categories();
            $this->load->view('trader/bike_addpost_vw', $country_data);
        } else if ($x == '3') {
            $country_data['qry'] = $this->Trader_mdl->get_countries_code();
            $this->load->view('trader/numberplate_addpost_vw', $country_data);
        } else if ($x == '4') {
            $country_data['query'] = $this->Trader_mdl->get_brand_vertu($x);
            //echo '<pre>';print_r($country_data);exit();
            $this->load->view('trader/vertu_addpost_vw', $country_data);
        } else if ($x == '5') {
            $country_data['query'] = $this->Trader_mdl->get_brand_watch($x);

            $this->load->view('trader/watch_addpost_vw', $country_data);
        } else if ($x == '6') {
            $this->load->view('trader/mobileno_addpost_vw');
        } else if ($x == '7') {
            $country_data['query'] = $this->Trader_mdl->get_brand_boat($x);
            //echo '<pre>';print_r($country_data);exit();
            $this->load->view('trader/boat_addpost_vw', $country_data);
        } else if ($x == '8') {
            $country_data['query'] = $this->Trader_mdl->get_brand_phone($x);
            $this->load->view('trader/phone_addpost_vw', $country_data);
        } else if ($x == '9') {
            $this->load->view('trader/property_addpost_vw');
        }
    }

    function fetch_brand() {
        $cate = $_POST['category'];
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->Trader_mdl->srch_brand_car($cate)));
    }

    //returns available brabds of given category
    function getBrands() {
        $cat = $_POST['cat'];
        echo(json_encode($this->Trader_mdl->getBrands($cat)));
    }

    function getEmirates() {
        $cat = $_POST['cat'];
        echo(json_encode($this->Trader_mdl->getEmirates($cat)));
    }

    function getEmirateCode() {
        $emirate = $_POST['brand'];
        echo(json_encode($this->Trader_mdl->get_template_code($emirate)));
    }

    function fetch_carmodel() {
        $brand = $_POST['brand'];
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->Trader_mdl->get_model_car($brand)));
    }

    function fetch_bikemodel() {
        $brand = $_POST['brand'];
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->Trader_mdl->get_model_bike($brand)));
    }

    function fetch_watchmodel() {
        $brand = $_POST['brand'];
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->Trader_mdl->get_model_watch($brand)));
    }

    function fetch_phonemodel() {
        $brand = $_POST['brand'];
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->Trader_mdl->get_model_phone($brand)));
    }

    function fetch_vertumodel() {
        $brand = $_POST['brand'];
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->Trader_mdl->get_model_vertu($brand)));
    }

    function fetch_boatmodel() {
        $brand = $_POST['brand'];
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->Trader_mdl->get_model_vertu($brand)));
    }

    public function car_add_post() {

        $this->load->Model('trader/Trader_mdl');
        $country_data['qry'] = $this->Trader_mdl->get_countries_code();
        $country_data['query'] = $this->Trader_mdl->get_brand_car();
        //echo '<pre>';print_r($country_data);exit();
        $this->load->view('trader/car_addpost_vw', $country_data);
    }

    public function mobile_add_post() {

        $this->load->Model('trader/Trader_mdl');
        $country_data['qry'] = $this->Trader_mdl->get_countries_code();
        $this->load->view('trader/mobileno_addpost_vw', $country_data);
    }

    public function verwatch_add_post() {

        $this->load->Model('trader/Trader_mdl');
        $country_data['qry'] = $this->Trader_mdl->get_countries_code();
        $this->load->view('trader/vertu_watch_addpost_vw', $country_data);
    }

    public function property_add_post() {
        $this->load->Model('trader/Trader_mdl');
        $country_data['qry'] = $this->Trader_mdl->get_countries_code();
        $this->load->view('trader/property_addpost_vw', $country_data);
    }

    public function numberplate_add_post() {
        $this->load->Model('trader/Trader_mdl');
        $country_data['qry'] = $this->Trader_mdl->get_countries_code();
        $this->load->view('trader/numberplate_addpost_vw', $country_data);
    }

    public function view_other_profile($trader_id) {
        $config = array();
        $config["base_url"] = base_url() . "index.php/Trader/login_check";
        $this->load->Model('trader/Trader_mdl');
        $total_row = $this->Trader_mdl->record_count();
        $config["total_rows"] = $total_row;
        $config["per_page"] = 1;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = $total_row;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';

        $this->pagination->initialize($config);
        if ($this->uri->segment(3)) {
            $page = ($this->uri->segment(3));
        } else {
            $page = 1;
        }
        $this->load->Model('trader/Trader_mdl');
        $data["results"] = $this->Trader_mdl->fetch_post_data($config["per_page"], $page);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links);
        $this->load->view('trader/trader_header');
        $data['qry'] = $this->Trader_mdl->others_trader_data($trader_id);
        $data['recentqry'] = $this->Trader_mdl->recently_viewed();
        //echo '<pre>';print_r($data);exit();
        $this->load->view('trader/other_trader_profile_vw', $data);
        $this->load->view('trader/trader_footer');
    }

    public function view_all_traders() {
        $this->load->view('trader/trader_header');
        $car_cnt_qry = $this->Trader_mdl->record_count();
        $trader_cnt = isset($car_cnt_qry[0])?$car_cnt_qry[0]->cnt:0;
        $data['cart_qry'] = $this->Trader_mdl->cart_cnt();
        $data['watch_qry'] = $this->Trader_mdl->watch_cnt();
        $config['base_url'] = base_url() . "Trader/view_all_traders";
        $config["total_rows"] = $trader_cnt;
        $config["per_page"] = 18;
        $config["uri_segment"] = 3;


        // if (isset($_SESSION['logged_in'])) {
           

         

        //     //$count_car = $car_cnt_qry[0]->cnt;

          
         
        //     if ($trader_cnt <= 18) {
        //         $choice = 0;
        //     }
        //     if (($trader_cnt > 18) && ($trader_cnt < 36)) {
        //         $choice = 1;
        //     }
        //     if (($trader_cnt >= 36) && ($trader_cnt < 54)) {
        //         $choice = 2;
        //     }
        //     if ($trader_cnt >= 54) {
        //         $choice = 3;
        //     }
        //     $config["use_page_numbers"] = TRUE;
        //     $config["num_links"] = $choice;
        //     $config['full_tag_open'] = '<ul class="pagination">';
        //     $config['full_tag_close'] = '</ul>';
        //     $config['first_link'] = false;
        //     $config['last_link'] = false;
        //     $config['first_tag_open'] = '<li>';
        //     $config['first_tag_close'] = '</li>';
        //     $config['prev_link'] = 'Previous Page';
        //     $config['prev_tag_open'] = '<li class="prev">';
        //     $config['prev_tag_close'] = '</li>';
        //     $config['next_link'] = 'Next Page';
        //     $config['next_tag_open'] = '<li class="next">';
        //     $config['next_tag_close'] = '</li>';
        //     $config['last_tag_open'] = '<li>';
        //     $config['last_tag_close'] = '</li>';
        //     $config['cur_tag_open'] = '<li class="active"><a href="#">';
        //     $config['cur_tag_close'] = '</a></li>';
        //     $config['num_tag_open'] = '<li>';
        //     $config['num_tag_close'] = '</li>';
        //     $this->pagination->initialize($config);
        //     $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        //     $query = $this->Trader_mdl->mdl_all_traders($config["per_page"], $page);
        //     $str_links = $this->pagination->create_links();
        //     $trader_data["links"] = explode('&nbsp;', $str_links);
        //     // echo '<pre>';print_r($trader_data);exit(); 

        //     $trader_data['records'] = $query['records'];
        //     $trader_data['count'] = $query['count'];
        //     $trader_data['recentqry'] = $this->Trader_mdl->recently_viewed();
        //     $this->load->view('trader/all_traders_vw', $trader_data);
        //     $this->load->view('trader/trader_footer');
        // } else {


           
    

            $config["num_links"] = 3;
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = false;
            $config['last_link'] = false;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous Page';
            $config['prev_tag_open'] = '<li class="prev">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next Page';
            $config['next_tag_open'] = '<li class="next">';
            $config['next_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $query = $this->Trader_mdl->mdl_all_traders($config["per_page"], $page);
            $str_links = $this->pagination->create_links();
            $trader_data["links"] = explode('&nbsp;', $str_links);

            $trader_data['records'] = $query['records'];
            $trader_data['count'] = $query['count'];
            $trader_data['recentqry'] = $this->Trader_mdl->recently_viewed();
            $this->load->view('trader/all_traders_vw', $trader_data);
            $this->load->view('trader/trader_footer');
       // }
    }

    /*public function view_car_category($offset = NULL) {
        $car_cnt_qry = $this->Trader_mdl->record_count_car();

        $count_car = $car_cnt_qry[0]->cnt;

        $config = array();
        $config['base_url'] = base_url() . "Trader/view_car_category";
        $config["total_rows"] = $count_car;
        $config["per_page"] = 9;
        $config["uri_segment"] = 3;
        //$config["use_page_numbers"] =   TRUE;
        for ($i = 1; $i <= 500; $i++) {
            if ($count_car <= ($i * 9)) {
                $choice = 0;
                break;
            }
            if (($count_car > ($i * 9)) && ($count_car < (($i + 1) * 9))) {
                $choice = $i;
                break;
            }
        }
        if ($choice > 3) {
            $choice = 3;
        }

        $config["num_links"] = $choice;

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Previous';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#" style="color:white";>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        //echo $page;exit();
        $query = $this->Trader_mdl->get_car($config["per_page"], $page);
        //echo '<pre>';print_r($query);exit();
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links);

        $data['recentqry'] = $this->Trader_mdl->recently_viewed();
        $data['qry'] = $query['qry'];
        $data['count'] = $query['count'];
        $data['cat_qry'] = $this->Trader_mdl->get_categories();
        $this->load->view('trader/trader_header');

        $this->load->view('trader/copy_car_category_vw', $data);
        $this->load->view('trader/trader_footer');
    }*/
    /*loading view page for main category page*/
    public function main_category($cat_id, $offset = NULL) {
        if ($cat_id == 1) {
            $car_cnt_qry = $this->Trader_mdl->record_count_car();
            $countItem = $car_cnt_qry[0]->cnt;
        }else  if ($cat_id == 2) {
            $car_cnt_qry = $this->Trader_mdl->record_count_bike();
            $countItem = $car_cnt_qry[0]->cnt;
        }else  if ($cat_id == 3) {
            $car_cnt_qry = $this->Trader_mdl->record_count_noplate();
            $countItem = $car_cnt_qry[0]->cnt;
        }else  if ($cat_id == 4) {
            $car_cnt_qry = $this->Trader_mdl->record_count_vertu();
            $countItem = $car_cnt_qry[0]->cnt;
        }else  if ($cat_id == 5) {
            $car_cnt_qry = $this->Trader_mdl->record_count_watch();
            $countItem = $car_cnt_qry[0]->cnt;
        }else  if ($cat_id == 6) {
            $car_cnt_qry = $this->Trader_mdl->record_count_mobileno();
            $countItem = $car_cnt_qry[0]->cnt;
        }else  if ($cat_id == 7) {
            $car_cnt_qry = $this->Trader_mdl->record_count_boat();
            $countItem = $car_cnt_qry[0]->cnt;
        }else  if ($cat_id == 8) {
            $car_cnt_qry = $this->Trader_mdl->record_count_phone();
            $countItem = $car_cnt_qry[0]->cnt;
        }else  if ($cat_id == 9) {
            $car_cnt_qry = $this->Trader_mdl->record_count_property();
            $countItem = $car_cnt_qry[0]->cnt;
        }
        

        $config = array();
        $config['base_url'] = base_url() . "Trader/main_category/".$cat_id;
  
        $config["total_rows"] = $countItem ;
        $config["per_page"] = 10;
     $config["uri_segment"] = 4;
           
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = false;
            $config['last_link'] = false;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous Page';
            $config['prev_tag_open'] = '<li class="prev">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next Page';
            $config['next_tag_open'] = '<li class="next">';
            $config['next_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a class="active" href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    
        if ($cat_id == 1) {
            $query = $this->Trader_mdl->get_car($config["per_page"], $page);
        }else if ($cat_id == 2) {
            $query = $this->Trader_mdl->get_bike($config["per_page"], $page);
        }else if ($cat_id == 3) {
            $query = $this->Trader_mdl->noplate_cat($config["per_page"], $page);
        }else if ($cat_id == 4) {
            $query = $this->Trader_mdl->vertu_cat($config["per_page"], $page);
        }else if ($cat_id == 5) {
            $query = $this->Trader_mdl->watch_cat($config["per_page"], $page);
        }else if ($cat_id == 6) {
            $query = $this->Trader_mdl->mobileno_cat($config["per_page"], $page);
			
        }else if ($cat_id == 7) {
            $query = $this->Trader_mdl->get_boat($config["per_page"], $page);
        }else if ($cat_id == 8) {
            $query = $this->Trader_mdl->iphone_cat($config["per_page"], $page);
        }else if ($cat_id == 9) {
            $query = $this->Trader_mdl->get_property($config["per_page"], $page);
        }
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links);

        $data['recentqry'] = $this->Trader_mdl->recently_viewed();
        $data['qry'] = $query['qry'];
        $data['count'] = $countItem;;
        // $data['count2']=$countItem;
        // var_dump($data);exit;
        $data['cat_id'] = $cat_id;
        $this->load->view('trader/trader_header');

        $this->load->view('trader/product_category_vw', $data);
        $this->load->view('trader/trader_footer');
    }

    /*loading view page for category detail page
    */
    public function category_details() {
        $cat_id = $this->uri->segment(4);
        $product_id = $this->uri->segment(3);

        $this->Trader_mdl->update_view_cnt($product_id, $cat_id);
        $data['image'] = $this->Trader_mdl->getImage($product_id, $cat_id);
      
        $data['product_id'] = $product_id;
        $data['cat_id'] = $cat_id;
        if ($cat_id == 1) {
            $data['query'] = $this->Trader_mdl->getproductcar($product_id, $cat_id);
            $data['car_img_qry'] = $this->Trader_mdl->fetch_car_imgs($product_id, $cat_id);
        } else if ($cat_id == 2) {
            $data['query'] = $this->Trader_mdl->getproductbike($product_id);
            $data['car_img_qry'] = $this->Trader_mdl->fetch_bike_imgs($product_id, $cat_id);
        } else if ($cat_id == 3) {
            $data['query'] = $this->Trader_mdl->mdl_noplate_details($product_id, $cat_id);
        } else if ($cat_id == 4) {
            $data['query'] = $this->Trader_mdl->mdl_vertu_details($product_id, $cat_id);
            $data['car_img_qry'] = $this->Trader_mdl->fetch_vertu_imgs($product_id, $cat_id);
        } else if ($cat_id == 5) {
            $data['query'] = $this->Trader_mdl->mdl_watch_details($product_id, $cat_id);
            $data['car_img_qry'] = $this->Trader_mdl->fetch_watch_imgs($product_id, $cat_id);
        } else if ($cat_id == 6) {
            $data['query'] = $this->Trader_mdl->mdl_mobileno_details($product_id, $cat_id);
        } else if ($cat_id == 7) {
            $data['query'] = $this->Trader_mdl->getproductboat($product_id, $cat_id);
            $data['car_img_qry'] = $this->Trader_mdl->fetch_boat_imgs($product_id, $cat_id);
        } else if ($cat_id == 8) {
            $data['query'] = $this->Trader_mdl->mdl_iphone_details($product_id, $cat_id);
            $data['car_img_qry'] = $this->Trader_mdl->fetch_iphone_imgs($product_id, $cat_id);
        } else if ($cat_id == 9) {
            $data['query'] = $this->Trader_mdl->getproductproperty($product_id, $cat_id);
            $data['car_img_qry'] = $this->Trader_mdl->fetch_prop_imgs($product_id, $cat_id);
        } else {
            
        }
        $data['recentqry'] = $this->Trader_mdl->recently_viewed();
        /* $data['cat_qry'] = $this->Trader_mdl->get_categories(); */

        $this->load->view('trader/trader_header');
        $this->load->view('trader/details_page_vw', $data);
        $this->load->view('trader/trader_footer');
    }

    /* public function car_category_details() {
      $cat_id = $this->uri->segment(4);
      $product_id = $this->uri->segment(3);
      $this->Trader_mdl->update_view_cnt($product_id, $cat_id);
      $data['image'] = $this->Trader_mdl->getImage($product_id, $cat_id);
      $data['product_id'] = $product_id;
      $data['cat_id'] = $cat_id;
      $data['query'] = $this->Trader_mdl->getproductcar($product_id, $cat_id);
      $data['car_img_qry'] = $this->Trader_mdl->fetch_car_imgs($product_id, $cat_id);
      $data['recentqry'] = $this->Trader_mdl->recently_viewed();
      $data['cat_qry'] = $this->Trader_mdl->get_categories();

      $this->load->view('trader/trader_header');
      $this->load->view('trader/details_page_vw',$data);
      $this->load->view('trader/trader_footer');
      } */

    function change_status_book() {
        $pid = $_POST['pid'];
        $cid = $_POST['cid'];
        if ($cid == 1) {
            $data['productCStatus'] = 2;
            $this->db->where('productID', $pid);

            $this->db->update('productcar', $data);
        } else if ($cid == 2) {
            $data['productBStatus'] = 2;
            $this->db->where('productID', $pid);

            $this->db->update('productbike', $data);
        } else if ($cid == 3) {
            $data['productNPStatus'] = 2;
            $this->db->where('productID', $pid);

            $this->db->update('productnp', $data);
        } else if ($cid == 4) {
            $data['productVStatus'] = 2;
            $this->db->where('productID', $pid);

            $this->db->update('productvertu', $data);
        } else if ($cid == 5) {
            $data['productWStatus'] = 2;
            $this->db->where('productID', $pid);

            $this->db->update('productwatch', $data);
        } else if ($cid == 6) {
            $data['productMNStatus'] = 2;
            $this->db->where('productID', $pid);

            $this->db->update('productmn', $data);
        } else if ($cid == 7) {
            $data['productBTStatus'] = 2;
            $this->db->where('productID', $pid);

            $this->db->update('productboat', $data);
        } else if ($cid == 8) {
            $data['productPHStatus'] = 2;
            $this->db->where('productID', $pid);

            $this->db->update('productphone', $data);
        } else if ($cid == 9) {
            $data['productPRStatus'] = 2;
            $this->db->where('productID', $pid);

            $this->db->update('productproperty', $data);
        } else {
            echo "failed";
        }
        echo "success";
    }

    function change_status_avail() {
        $pid = $_POST['pid'];
        $cid = $_POST['cid'];
        if ($cid == 1) {
            $data['productCStatus'] = 0;
            $this->db->where('productID', $pid);

            $this->db->update('productcar', $data);
        } else if ($cid == 2) {
            $data['productBStatus'] = 0;
            $this->db->where('productID', $pid);

            $this->db->update('productbike', $data);
        } else if ($cid == 3) {
            $data['productNPStatus'] = 0;
            $this->db->where('productID', $pid);

            $this->db->update('productnp', $data);
        } else if ($cid == 4) {
            $data['productVStatus'] = 0;
            $this->db->where('productID', $pid);

            $this->db->update('productvertu', $data);
        } else if ($cid == 5) {
            $data['productWStatus'] = 0;
            $this->db->where('productID', $pid);

            $this->db->update('productwatch', $data);
        } else if ($cid == 6) {
            $data['productMNStatus'] = 0;
            $this->db->where('productID', $pid);

            $this->db->update('productmn', $data);
        } else if ($cid == 7) {
            $data['productBTStatus'] = 0;
            $this->db->where('productID', $pid);

            $this->db->update('productboat', $data);
        } else if ($cid == 8) {
            $data['productPHStatus'] = 0;
            $this->db->where('productID', $pid);

            $this->db->update('productphone', $data);
        } else if ($cid == 9) {
            $data['productPRStatus'] = 0;
            $this->db->where('productID', $pid);

            $this->db->update('productproperty', $data);
        } else {
            echo "failed";
        }
        echo "success";
    }

    function change_status_sold() {
        $pid = $_POST['pid'];
        $cid = $_POST['cid'];
        if ($cid == 1) {
            $data['productCStatus'] = 1;
            $this->db->where('productID', $pid);

            $this->db->update('productcar', $data);
        } else if ($cid == 2) {
            $data['productBStatus'] = 1;
            $this->db->where('productID', $pid);

            $this->db->update('productbike', $data);
        } else if ($cid == 3) {
            $data['productNPStatus'] = 1;
            $this->db->where('productID', $pid);

            $this->db->update('productnp', $data);
        } else if ($cid == 4) {
            $data['productVStatus'] = 1;
            $this->db->where('productID', $pid);

            $this->db->update('productvertu', $data);
        } else if ($cid == 5) {
            $data['productWStatus'] = 1;
            $this->db->where('productID', $pid);

            $this->db->update('productwatch', $data);
        } else if ($cid == 6) {
            $data['productMNStatus'] = 1;
            $this->db->where('productID', $pid);

            $this->db->update('productmn', $data);
        } else if ($cid == 7) {
            $data['productBTStatus'] = 1;
            $this->db->where('productID', $pid);

            $this->db->update('productboat', $data);
        } else if ($cid == 8) {
            $data['productPHStatus'] = 1;
            $this->db->where('productID', $pid);

            $this->db->update('productphone', $data);
        } else if ($cid == 9) {
            $data['productPRStatus'] = 1;
            $this->db->where('productID', $pid);

            $this->db->update('productproperty', $data);
        } else {
            echo "failed";
        }
        echo "success";
    }

    function sendMailCategory() {
        if (isset($_SESSION['logged_in'])) {
            $product_id = $this->uri->segment(3);
            $cat_id = $this->uri->segment(4);
            $session_data = $this->session->userdata('logged_in');
            $trader_id = $session_data['trader_id'];
            $data['email'] = $this->Trader_mdl->get_email($trader_id);
            $data['name'] = $this->Trader_mdl->getname($trader_id);
            $data['mail'] = $this->Trader_mdl->sendemail_car($product_id);

            // $subject = $this->input->post('subject');
            // $message = $this->input->post('message');
            // $from_email = $data['email'];
            // $to_email = $data['mail'];
            // $name = $data['name'];

            // //configure email settings
            // $config['protocol'] = 'smtp';
            // $config['smtp_host'] = 'ssl://smtp.gmail.com';
            // $config['smtp_port'] = '465';
            // $config['smtp_user'] = 'snehavijayan.sot@gmail.com';
            // $config['smtp_pass'] = 'sneha@123';
            // $config['mailtype'] = 'html';
            // $config['charset'] = 'iso-8859-1';
            // $config['wordwrap'] = TRUE;
            // $config['newline'] = "\r\n"; //use double quotes
            // $this->load->library('email', $config);
            // $this->email->initialize($config);

            // //send mail
            // $this->email->from($from_email, $name);
            // $this->email->to($to_email);
            // $this->email->subject($subject);
            // $this->email->message($message);
            // $path = base_url() . 'Trader/category_details/' . $product_id . '/' . $cat_id;
            // if ($this->email->send()) {
            //      $this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-success text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Your Mail has been Sent Successfully!</div></div></div>');
            //     redirect($path);
            // } else {
            //     $this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-danger text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>There is error in sending mail! Please try again later</div></div></div>');
            //     redirect($path);
            //     //show_error($this->email->print_debugger());
            // }






            $data['frommail'] = $data['email'];
            $data['fromname'] = $data['name'];
            $data['tomail'] = $data['mail'];
    
            $subject = $this->input->post('subject');
            $message = $this->input->post('message');
            $from_email = $data['frommail'];
            $to_email = $data['tomail'];
            $name = $data['fromname'];
    
        
    
    $headers = 'From:'.$from_email . "\r\n" .
        'Reply-To:'.$from_email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    
    
    
    
            // $this->email->initialize($config);
    
    
            // $this->email->from($from_email, $name);
            // $this->email->to($to_email);
            // $this->email->subject($subject);
            // $this->email->message($message);
            $path = base_url() . 'Trader/view_other_traders/' . $trader_id;
            // if ($this->email->send()) {
                if (mail($to_email, $subject, $message, $headers)) { 
        $this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-success text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Your Mail has been Sent Successfully!</div></div></div>');
                redirect($path);
            } else {
    
    
    //                    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">There is error in sending mail! Please try again later</div>');
        //        show_error($this->email->print_debugger());
            }
        } else {
            redirect('Trader/login_view');
        }
    }

    /*public function view_bike_category($offset = NULL) {
        $config = array();
        $config['base_url'] = base_url() . "Trader/view_bike_category";
        $car_cnt_qry = $this->Trader_mdl->record_count_bike();
        $count_car = $car_cnt_qry[0]->cnt;
        $config["total_rows"] = $count_car;
        //$count_car = $config["total_rows"];
        for ($i = 1; $i <= 500; $i++) {
            if ($count_car <= ($i * 9)) {
                $choice = 0;
                break;
            }
            if (($count_car > ($i * 9)) && ($count_car < (($i + 1) * 9))) {
                $choice = $i;
                break;
            }
        }

        if ($choice > 3) {
            $choice = 3;
        }
        $config["per_page"] = 9;
        $config["uri_segment"] = 3;
        //$config["use_page_numbers"] =   TRUE;

        $config["num_links"] = $choice;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Previous Page';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next Page';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $query = $this->Trader_mdl->get_bike($config["per_page"], $page);

        $str_links = $this->pagination->create_links();

        $data["links"] = explode('&nbsp;', $str_links);
        $data['recentqry'] = $this->Trader_mdl->recently_viewed();
        $data['cat_qry'] = $this->Trader_mdl->get_categories();
        $data['qry'] = $query['qry'];
        $data['count'] = $count_car;
        $this->load->view('trader/trader_header');
        $this->load->view('trader/bike_category_vw', $data);
        $this->load->view('trader/trader_footer');
    }*/

    /* public function bike_category_details() {
      $cat_id = $this->uri->segment(4);
      $product_id = $this->uri->segment(3);
      $data['image'] = $this->Trader_mdl->getImage($product_id, $cat_id);
      $data['bike_img_qry'] = $this->Trader_mdl->fetch_bike_imgs($product_id, $cat_id);
      //echo '<pre>';print_r($data);exit();
      $this->Trader_mdl->update_view_cnt($product_id, $cat_id);
      $data['product_id'] = $product_id;
      $data['query'] = $this->Trader_mdl->getproductbike($product_id);
      $data['recentqry'] = $this->Trader_mdl->recently_viewed();
      $data['cat_qry'] = $this->Trader_mdl->get_categories();
      $data['bike_img_qry'] = $this->Trader_mdl->fetch_bike_imgs($product_id, $cat_id);
      $this->load->view('trader/trader_header');
      $this->load->view('trader/bike_category_details_vw', $data);
      $this->load->view('trader/trader_footer');
      } */

    /*public function noplate_category($offset = NULL) {

        $config = array();


        $config['base_url'] = base_url() . "Trader/noplate_category";
        $car_cnt_qry = $this->Trader_mdl->record_count_noplate();
        $count_car = $car_cnt_qry[0]->cnt;
        $config["total_rows"] = $count_car;

        $config["per_page"] = 9;
        $config["uri_segment"] = 3;

        for ($i = 1; $i <= 500; $i++) {
            if ($count_car <= ($i * 9)) {
                $choice = 0;
                break;
            }
            if (($count_car > ($i * 9)) && ($count_car < (($i + 1) * 9))) {
                $choice = $i;
                break;
            }
        }

        if ($choice > 3) {
            $choice = 3;
        }
        $config["num_links"] = $choice;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Previous Page';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next Page';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $query = $this->Trader_mdl->noplate_cat($config["per_page"], $page);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links);
        $data['qry'] = $query['qry'];
        $data['count'] = $count_car;
        $data['recentqry'] = $this->Trader_mdl->recently_viewed();
        $data['cat_qry'] = $this->Trader_mdl->get_categories();

        $this->load->view('trader/trader_header');
        $this->load->view('trader/noplate_cat_vw', $data);
        $this->load->view('trader/trader_footer');
    }*/

    /*function show_noplate_details($product_id, $cat_id) {
        $this->Trader_mdl->update_view_cnt($product_id, $cat_id);
        $this->load->view('trader/trader_header');
        $data['qry'] = $this->Trader_mdl->mdl_noplate_details($product_id, $cat_id);
        //echo '<pre>';print_r($data);exit();
        //$data['noplate_img_qry'] = $this->Trader_mdl->fetch_car_imgs($product_id,$cat_id);
        $data['recentqry'] = $this->Trader_mdl->recently_viewed();
        $data['cat_qry'] = $this->Trader_mdl->get_categories();
        //$this->Trader_mdl->prd_viewcnt($product_id);

        $this->load->view('trader/noplate_cat_details_vw', $data);
        $this->load->view('trader/trader_footer');
    }*/

    /*public function watch_category($offset = NULL) {

        $config = array();

        $car_cnt_qry = $this->Trader_mdl->record_count_watch();

        $count_car = $car_cnt_qry[0]->cnt;

        for ($i = 1; $i <= 500; $i++) {
            if ($count_car <= ($i * 9)) {
                $choice = 0;
                break;
            }
            if (($count_car > ($i * 9)) && ($count_car < (($i + 1) * 9))) {
                $choice = $i;
                break;
            }
        }
        if ($choice > 3) {
            $choice = 3;
        }
        //$config["use_page_numbers"] =   TRUE;
        $config['base_url'] = base_url() . "Trader/watch_category";
        $config["total_rows"] = $count_car;
        $config["per_page"] = 9;
        $config["uri_segment"] = 3;

        $config["num_links"] = $choice;

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Prevoius Page';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next Page';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $query = $this->Trader_mdl->watch_cat($config["per_page"], $page);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links);
        $data['qry'] = $query['qry'];
        $data['count'] = $count_car;
        $data['recentqry'] = $this->Trader_mdl->recently_viewed();
        $data['cat_qry'] = $this->Trader_mdl->get_categories();
        $this->load->view('trader/trader_header');
        $this->load->view('trader/watch_cat_vw', $data);
        $this->load->view('trader/trader_footer');
    }*/

    /*public function show_watch_details($product_id, $cat_id) {
        $this->Trader_mdl->update_view_cnt($product_id, $cat_id);
        $data['image'] = $this->Trader_mdl->getImage($product_id, $cat_id);
        $this->load->view('trader/trader_header');
        $data['qry'] = $this->Trader_mdl->mdl_watch_details($product_id, $cat_id);
        //echo '<pre>';print_r($data);exit();
        $data['recentqry'] = $this->Trader_mdl->recently_viewed();
        $data['cat_qry'] = $this->Trader_mdl->get_categories();
        $data['watch_img_qry'] = $this->Trader_mdl->fetch_watch_imgs($product_id, $cat_id);
        $this->load->view('trader/watch_cat_details_vw', $data);
        $this->load->view('trader/trader_footer');
    }*/

    /*public function mobileno_category($offset = NULL) {

        $config = array();
        $car_cnt_qry = $this->Trader_mdl->record_count_mobileno();
        $count_car = $car_cnt_qry[0]->cnt;
        // $count_car = count( $car_cnt_qry);

        $config['base_url'] = base_url() . "Trader/mobileno_category";
        $config["total_rows"] = $count_car;
        $config["per_page"] = 9;
        $config["uri_segment"] = 3;

        for ($i = 1; $i <= 500; $i++) {
            if ($count_car <= ($i * 9)) {
                $choice = 0;
                break;
            }
            if (($count_car > ($i * 9)) && ($count_car < (($i + 1) * 9))) {
                $choice = $i;
                break;
            }
        }
        if ($choice > 3) {
            $choice = 3;
        }
        $config["use_page_numbers"] = FALSE;
        $config["num_links"] = $choice;

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Previous Page';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next Page';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $query = $this->Trader_mdl->mobileno_cat($config["per_page"], $page);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links);
        $data['qry'] = $query['qry'];
        $cnt = $query['qry'];

        //echo '<pre>';print_r($data);exit();

        $data['count'] = $count_car;
        $data['recentqry'] = $this->Trader_mdl->recently_viewed();
        $data['cat_qry'] = $this->Trader_mdl->get_categories();
        $this->load->view('trader/trader_header');
        $this->load->view('trader/mobile_no_cat_vw', $data);
        $this->load->view('trader/trader_footer');
    }*/

    /*function show_mobileno_details($product_id, $cat_id) {
        $this->Trader_mdl->update_view_cnt($product_id, $cat_id);
        $this->load->view('trader/trader_header');
        $data['qry'] = $this->Trader_mdl->mdl_mobileno_details($product_id, $cat_id);
        $data['recentqry'] = $this->Trader_mdl->recently_viewed();
        $data['cat_qry'] = $this->Trader_mdl->get_categories();
        //$data['q'] = $this->Trader_mdl->prd_viewcnt($product_id, $prod_view_cnt);
        //echo '<pre>';print_r($data);exit();
        $this->load->view('trader/mobileno_cat_details_vw', $data);
        $this->load->view('trader/trader_footer');
    }*/

    /*public function view_boat_category($offset = NULL) {
        $config = array();
        $car_cnt_qry = $this->Trader_mdl->record_count_boat();
        $count_car = $car_cnt_qry[0]->cnt;

        $config['base_url'] = base_url() . "Trader/view_boat_category";
        $config["total_rows"] = $count_car;
        $config["per_page"] = 9;
        $config["uri_segment"] = 3;

        for ($i = 1; $i <= 500; $i++) {
            if ($count_car <= ($i * 9)) {
                $choice = 0;
                break;
            }
            if (($count_car > ($i * 9)) && ($count_car < (($i + 1) * 9))) {
                $choice = $i;
                break;
            }
        }
        if ($choice > 3) {
            $choice = 3;
        }
        //$config["use_page_numbers"] =   TRUE;
        $config["num_links"] = $choice;

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Prevoius Page';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next Page';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $query = $this->Trader_mdl->get_boat($config["per_page"], $page);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links);
        $data['qry'] = $query['qry'];
        $data['count'] = $count_car;
        $data['recentqry'] = $this->Trader_mdl->recently_viewed();
        $data['cat_qry'] = $this->Trader_mdl->get_categories();
        $this->load->view('trader/trader_header');
        $this->load->view('trader/boat_category_vw', $data);
        $this->load->view('trader/trader_footer');
    }*/

    /* public function boat_category_details() {
      $cat_id = $this->uri->segment(4);
      $product_id = $this->uri->segment(3);
      $data['image'] = $this->Trader_mdl->getImage($product_id, $cat_id);
      $this->Trader_mdl->update_view_cnt($product_id, $cat_id);
      $data['product_id'] = $product_id;
      $data['query'] = $this->Trader_mdl->getproductboat($product_id, $cat_id);
      //echo '<pre>';print_r($data);exit();
      $data['recentqry'] = $this->Trader_mdl->recently_viewed();
      $data['cat_qry'] = $this->Trader_mdl->get_categories();
      $data['boat_img_qry'] = $this->Trader_mdl->fetch_boat_imgs($product_id, $cat_id);
      //echo '<pre>';print_r($data);exit();
      $this->load->view('trader/trader_header');
      $this->load->view('trader/boat_category_details_vw', $data);
      $this->load->view('trader/trader_footer');
      } */

    /*public function iphone_category($offset = NULL) {

        $config = array();

        $ph_cnt_qry = $this->Trader_mdl->record_count_phone();
        $count_ph = $ph_cnt_qry[0]->cnt;
        $config['base_url'] = base_url() . "Trader/iphone_category";
        $config["total_rows"] = $count_ph;
        $config["per_page"] = 9;
        $config["uri_segment"] = 3;

        if ($count_ph <= 9) {
            $choice = 0;
        }
        if (($count_ph > 9) && ($count_ph < 18)) {
            $choice = 1;
        }
        if (($count_ph >= 18) && ($count_ph < 27)) {
            $choice = 2;
        }
        if ($count_ph >= 27) {
            $choice = 3;
        }
        //$config["use_page_numbers"] =   TRUE;
        $config["num_links"] = $choice;

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Prevoius Page';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next Page';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;


        $query = $this->Trader_mdl->iphone_cat($config["per_page"], $page);

        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links);
        $data['qry'] = $query['qry'];
        $data['count'] = $count_ph;
        $data['recentqry'] = $this->Trader_mdl->recently_viewed();
        $data['cat_qry'] = $this->Trader_mdl->get_categories();
        $this->load->view('trader/trader_header');
        $this->load->view('trader/iphone_cat_vw', $data);
        $this->load->view('trader/trader_footer');
    }*/

    /*public function show_iphone_details($product_id, $cat_id) {
        $this->Trader_mdl->update_view_cnt($product_id, $cat_id);
        $data['image'] = $this->Trader_mdl->getImage($product_id, $cat_id);
        $this->load->view('trader/trader_header');
        $data['qry'] = $this->Trader_mdl->mdl_iphone_details($product_id, $cat_id);
        $data['recentqry'] = $this->Trader_mdl->recently_viewed();
        $data['cat_qry'] = $this->Trader_mdl->get_categories();
        $data['iphone_img_qry'] = $this->Trader_mdl->fetch_iphone_imgs($product_id, $cat_id);
//    $data['q']=$this->Trader_mdl->prd_viewcnt($product_id,$prod_view_cnt);
        //echo '<pre>';print_r($data);exit();
        $this->load->view('trader/iphone_cat_details_vw', $data);
        $this->load->view('trader/trader_footer');
    }*/

    /*public function vertu_category($offset = NULL) {

        $config = array();
        $car_cnt_qry = $this->Trader_mdl->record_count_vertu();
        $count_car = $car_cnt_qry[0]->cnt;

        $config['base_url'] = base_url() . "Trader/vertu_category";
        //$config["total_rows"] = $this->Trader_mdl->record_count_vertu();
        $config["total_rows"] = $count_car;
        $config["per_page"] = 9;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];

        for ($i = 1; $i <= 500; $i++) {
            if ($count_car <= ($i * 9)) {
                $choice = 0;
                break;
            }
            if (($count_car > ($i * 9)) && ($count_car < (($i + 1) * 9))) {
                $choice = $i;
                break;
            }
        }
        if ($choice > 3) {
            $choice = 3;
        }
        //$config["use_page_numbers"] =   TRUE;
        $config["num_links"] = $choice;

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Previous Page';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next Page';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $query = $this->Trader_mdl->vertu_cat($config["per_page"], $page);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links);
        $data['qry'] = $query['qry'];
        $data['count'] = $count_car;
        $data['recentqry'] = $this->Trader_mdl->recently_viewed();
        $data['cat_qry'] = $this->Trader_mdl->get_categories();

        $this->load->view('trader/trader_header');
        $this->load->view('trader/vertu_cat_vw', $data);
        $this->load->view('trader/trader_footer');
    }*/

    /*public function show_vertu_details($product_id, $cat_id) {
        $this->Trader_mdl->update_view_cnt($product_id, $cat_id);
        $data['image'] = $this->Trader_mdl->getImage($product_id, $cat_id);
        $this->load->view('trader/trader_header');
        $data['qry'] = $this->Trader_mdl->mdl_vertu_details($product_id, $cat_id);
        $data['recentqry'] = $this->Trader_mdl->recently_viewed();
        $data['cat_qry'] = $this->Trader_mdl->get_categories();
        $data['vertu_img_qry'] = $this->Trader_mdl->fetch_vertu_imgs($product_id, $cat_id);
        $this->load->view('trader/vertu_cat_details_vw', $data);
        $this->load->view('trader/trader_footer');
    }*/

   /* public function view_property_category($offset = NULL) {
        $config = array();

        $car_cnt_qry = $this->Trader_mdl->record_count_property();

        $count_car = $car_cnt_qry[0]->cnt;
        $config['base_url'] = base_url() . "Trader/view_property_category";
        $config["total_rows"] = $count_car;
        $config["per_page"] = 9;
        $config["uri_segment"] = 3;

        for ($i = 1; $i <= 500; $i++) {
            if ($count_car <= ($i * 9)) {
                $choice = 0;
                break;
            }
            if (($count_car > ($i * 9)) && ($count_car < (($i + 1) * 9))) {
                $choice = $i;
                break;
            }
        }
        if ($choice > 3) {
            $choice = 3;
        }
        // $config["use_page_numbers"] =   TRUE;
        $config["num_links"] = $choice;

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Previous Page';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next Page';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $query = $this->Trader_mdl->get_property($config["per_page"], $page);

        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links);
        $data['qry'] = $query['qry'];
        $data['count'] = $count_car;
        //$data['count'] = $query['count'];
        $data['recentqry'] = $this->Trader_mdl->recently_viewed();
        $data['cat_qry'] = $this->Trader_mdl->get_categories();
        $this->load->view('trader/trader_header');
        $this->load->view('trader/property_category_vw', $data);
        $this->load->view('trader/trader_footer');
    }*/

    /* public function property_category_details() {
      $cat_id = $this->uri->segment(4);
      $product_id = $this->uri->segment(3);
      $data['image'] = $this->Trader_mdl->getImage($product_id, $cat_id);
      $this->Trader_mdl->update_view_cnt($product_id, $cat_id);
      $data['product_id'] = $product_id;
      $data['query'] = $this->Trader_mdl->getproductproperty($product_id, $cat_id);

      $data['recentqry'] = $this->Trader_mdl->recently_viewed();
      $data['cat_qry'] = $this->Trader_mdl->get_categories();
      $data['prop_img_qry'] = $this->Trader_mdl->fetch_prop_imgs($product_id, $cat_id);
      $this->load->view('trader/trader_header');
      $this->load->view('trader/property_category_details_vw', $data);
      $this->load->view('trader/trader_footer');
      } */

    public function autocomplete() {
        // load model


        $srchfor = $this->input->post('srchfor');

        $result = $this->Trader_mdl->get_autocomplete($srchfor);

        if (!empty($result)) {
            foreach ($result as $row):
                echo "<li>" . $row->category_name . "</li>";
            endforeach;
        }
        else {
            echo "<li>Not found ...  </li>";
        }
    }

    function select_category() {
        $x = $_POST['category'];

        if ($x == 'Car') {
            redirect('Trader/scrh_car_category');
        } else if ($x == 'Bike') {
            redirect('Trader/scrh_bike_category');
        } else if ($x == 'Number Plate') {
            redirect('Trader/scrh_noplate_category');
        } else if ($x == 'Vertu') {
            redirect('Trader/scrh_vertu_category');
        } else if ($x == 'Watch') {
            redirect('Trader/scrh_watch_category');
        } else if ($x == 'Mobile Number') {
            redirect('Trader/scrh_mobileno_category');
        } else if ($x == 'Boat') {
            redirect('Trader/scrh_boat_category');
        } else if ($x == 'Iphone') {
            redirect('Trader/scrh_iphone_category');
        } else if ($x == 'Properties') {
            redirect('Trader/scrh_property_category');
        }
    }

    public function scrh_car_category($offset = NULL) {

        $config = array();
        $config['base_url'] = base_url() . "Trader/scrh_car_category";
        $config["total_rows"] = $this->Trader_mdl->record_count_car();
        $config["per_page"] = 2;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $query = $this->Trader_mdl->get_car($config["per_page"], $page);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links);
        $data['qry'] = $query['qry'];
        $data['count'] = $query['count'];
        $data['recentqry'] = $this->Trader_mdl->recently_viewed();

        $this->load->view('trader/car_category_vw', $data);
    }

    public function scrh_bike_category($offset = NULL) {
        $config = array();
        $config['base_url'] = base_url() . "Trader/scrh_bike_category";
        $config["total_rows"] = $this->Trader_mdl->record_count_bike();
        $config["per_page"] = 1;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $query = $this->Trader_mdl->get_bike($config["per_page"], $page);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links);
        $data['recentqry'] = $this->Trader_mdl->recently_viewed();
        $data['qry'] = $query['qry'];
        $data['count'] = $query['count'];

        $this->load->view('trader/bike_category_vw', $data);
    }

    public function scrh_noplate_category($offset = NULL) {

        $config = array();


        $config['base_url'] = base_url() . "Trader/scrh_noplate_category";
        $config["total_rows"] = $this->Trader_mdl->record_count_noplate();
        $config["per_page"] = 1;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $query = $this->Trader_mdl->noplate_cat($config["per_page"], $page);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links);
        $data['qry'] = $query['qry'];
        $data['count'] = $query['count'];
        $data['recentqry'] = $this->Trader_mdl->recently_viewed();
        $this->load->view('trader/noplate_cat_vw', $data);
    }

    public function scrh_vertu_category($offset = NULL) {

        $config = array();


        $config['base_url'] = base_url() . "Trader/scrh_vertu_category";
        $config["total_rows"] = $this->Trader_mdl->record_count_vertu();
        $config["per_page"] = 1;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;


        $query = $this->Trader_mdl->vertu_cat($config["per_page"], $page);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links);
        $data['qry'] = $query['qry'];
        $data['count'] = $query['count'];
        $data['recentqry'] = $this->Trader_mdl->recently_viewed();

        $this->load->view('trader/vertu_cat_vw', $data);
    }

    public function scrh_watch_category($offset = NULL) {

        $config = array();


        $config['base_url'] = base_url() . "Trader/scrh_watch_category";
        $config["total_rows"] = $this->Trader_mdl->record_count_watch();
        $config["per_page"] = 1;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $query = $this->Trader_mdl->watch_cat($config["per_page"], $page);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links);
        $data['qry'] = $query['qry'];
        $data['count'] = $query['count'];
        $data['recentqry'] = $this->Trader_mdl->recently_viewed();

        $this->load->view('trader/watch_cat_vw', $data);
    }

    public function scrh_mobileno_category($offset = NULL) {

        $config = array();
        $config['base_url'] = base_url() . "Trader/scrh_mobileno_category";
        $config["total_rows"] = $this->Trader_mdl->record_count_mobileno();
        $config["per_page"] = 1;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $query = $this->Trader_mdl->mobileno_cat($config["per_page"], $page);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links);
        $data['qry'] = $query['qry'];
        $data['count'] = $query['count'];
        $data['recentqry'] = $this->Trader_mdl->recently_viewed();

        $this->load->view('trader/mobile_no_cat_vw', $data);
    }

    public function scrh_boat_category($offset = NULL) {
        $config = array();


        $config['base_url'] = base_url() . "Trader/scrh_boat_category";
        $config["total_rows"] = $this->Trader_mdl->record_count_boat();
        $config["per_page"] = 1;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $query = $this->Trader_mdl->get_boat($config["per_page"], $page);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links);
        $data['qry'] = $query['qry'];
        $data['count'] = $query['count'];
        $data['recentqry'] = $this->Trader_mdl->recently_viewed();
        $this->load->view('trader/boat_category_vw', $data);
    }

    public function scrh_iphone_category($offset = NULL) {
        $config = array();
        $config['base_url'] = base_url() . "Trader/scrh_iphone_category";
        $config["total_rows"] = $this->Trader_mdl->record_count_phone();
        $config["per_page"] = 1;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $query = $this->Trader_mdl->iphone_cat($config["per_page"], $page);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links);
        $data['qry'] = $query['qry'];
        $data['count'] = $query['count'];
        $data['recentqry'] = $this->Trader_mdl->recently_viewed();
        $this->load->view('trader/iphone_cat_vw', $data);
    }

    public function scrh_property_category($offset = NULL) {
        $config = array();
        $config['base_url'] = base_url() . "Trader/scrh_property_category";
        $config["total_rows"] = $this->Trader_mdl->record_count_property();
        $config["per_page"] = 1;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $query = $this->Trader_mdl->get_property($config["per_page"], $page);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links);
        $data['qry'] = $query['qry'];
        $data['count'] = $query['count'];
        $data['recentqry'] = $this->Trader_mdl->recently_viewed();
        $this->load->view('trader/property_category_vw', $data);
    }

    function fetch_model() {
        $brand = $_POST['brand'];

        echo(json_encode($this->Trader_mdl->fetch_model($brand)));
    }

    public function tr_edit_post($product_id, $category_id) {
        if (isset($_SESSION['logged_in'])) {
            $user_data=$this->Trader_mdl->get_user_details($_SESSION['logged_in']['trader_id'])[0];
           
            $_SESSION['logged_in']['plantype']=($user_data->tplanID==3||$user_data->tplanID==4)?1:0 ;
            if ($category_id == 1) {
                $data['qry'] = $this->Trader_mdl->fetch_edit_car($product_id, $category_id);
                $carbrand = $this->Trader_mdl->get_brandname_car($product_id);
                $data['car_brand'] = $this->Trader_mdl->fetch_car_brands($category_id);
//           $data['car_model'] = $this->Trader_mdl->fetch_car_models($category_id);
                $data['car_model'] = $this->Trader_mdl->fetch_car_models($carbrand);
                $this->load->view('trader/trader_header');
                $this->load->view('trader/edit_car_post_vw', $data);
                $this->load->view('trader/trader_footer');
            }
            if ($category_id == 2) {
                $data['qry'] = $this->Trader_mdl->fetch_edit_bike($product_id, $category_id);
                $bikebrand = $this->Trader_mdl->get_brandname_bike($product_id);
                $data['bike_brand'] = $this->Trader_mdl->fetch_bike_brands($category_id);
                $data['bike_model'] = $this->Trader_mdl->fetch_bike_models($bikebrand);
                $this->load->view('trader/trader_header');
                $this->load->view('trader/edit_bike_post_vw', $data);
                $this->load->view('trader/trader_footer');
            }
            if ($category_id == 3) {
                $data['noplate'] =$this->Trader_mdl->get_templates();;
                $data['qry']  = $this->Trader_mdl->fetch_edit_noplate($product_id, $category_id);
               $npemirates =  $data['qry'][0]->productNPEmrites; 
               $em_codes = $this->Trader_mdl->fetch_emi_code($npemirates);
               $emstr = $em_codes[0]->code;
               $emarr = explode(',',$emstr);
               
               $data['em_codes'] = $emarr;
                //$data['qry'] = $this->Trader_mdl->fetch_edit_noplate($product_id, $category_id);
                $this->load->view('trader/trader_header');
               $this->load->view('trader/edit_noplate_post_vw', $data);
               
                $this->load->view('trader/trader_footer');
            }
            if ($category_id == 4) {
                $data['qry'] = $this->Trader_mdl->fetch_edit_vertu($product_id, $category_id);
                $vertubrand = $this->Trader_mdl->get_brandname_vertu($product_id);
                $data['vertu_brand'] = $this->Trader_mdl->fetch_vertu_brands($category_id);
                $data['vertu_model'] = $this->Trader_mdl->fetch_vertu_models($vertubrand);
                $this->load->view('trader/trader_header');
                $this->load->view('trader/edit_vertu_addpost_vw', $data);
                $this->load->view('trader/trader_footer');
            }
            if ($category_id == 5) {
                $data['qry'] = $this->Trader_mdl->fetch_edit_watch($product_id, $category_id);
                $watchbrand = $this->Trader_mdl->get_brandname_watch($product_id);
                $data['watch_brand'] = $this->Trader_mdl->fetch_watch_brands($category_id);
                $data['watch_model'] = $this->Trader_mdl->fetch_watch_models($watchbrand);
                $this->load->view('trader/trader_header');
                $this->load->view('trader/edit_watch_addpost_vw', $data);
                $this->load->view('trader/trader_footer');
            }
            if ($category_id == 7) {
                $data['qry'] = $this->Trader_mdl->fetch_edit_boat($product_id, $category_id);
                $boatbrand = $this->Trader_mdl->get_brandname_boat($product_id);
                $data['boat_brand'] = $this->Trader_mdl->fetch_boat_brands($category_id);
                $data['boat_model'] = $this->Trader_mdl->fetch_boat_models($boatbrand);
                $this->load->view('trader/trader_header');
                $this->load->view('trader/edit_boat_addpost_vw', $data);
                $this->load->view('trader/trader_footer');
            }
            if ($category_id == 8) {
                $data['qry'] = $this->Trader_mdl->fetch_edit_phone($product_id, $category_id);
                $phonebrand = $this->Trader_mdl->get_brandname_phone($product_id);
                $data['phone_brand'] = $this->Trader_mdl->fetch_phone_brands($category_id);
                $data['phone_model'] = $this->Trader_mdl->fetch_phone_models($phonebrand);
                $this->load->view('trader/trader_header');
                $this->load->view('trader/edit_phone_addpost_vw', $data);
                $this->load->view('trader/trader_footer');
            }
            if ($category_id == 9) {
                $data['prop_qry'] = $this->Trader_mdl->get_subproperties($category_id);
                $sub_prop = $this->Trader_mdl->get_brandname_prop($product_id);
                $data['prop_types'] = $this->Trader_mdl->fetch_car_models($sub_prop);

                $data['qry'] = $this->Trader_mdl->fetch_edit_property($product_id, $category_id);
                //echo '<pre>';print_r($data);exit();
                //$data['property_category'] = $this->Trader_mdl->fetch_property_category($category_id);
                //$data['property_subcategory'] = $this->Trader_mdl->fetch_property_subcategory($category_id);
                $this->load->view('trader/trader_header');
                $this->load->view('trader/edit_property_addpost_vw', $data);
                $this->load->view('trader/trader_footer');
            }

            if ($category_id == 6) {
                $data['qry'] = $this->Trader_mdl->fetch_edit_mobilenumber($product_id, $category_id);
                $mob_oper = $this->Trader_mdl->get_opername_mob($product_id);
                $data['mob_pref'] = $this->Trader_mdl->fetch_car_models($mob_oper);

                $this->load->view('trader/trader_header');
                $this->load->view('trader/edit_mobile_addpost_vw', $data);
                $this->load->view('trader/trader_footer');
            }
        } else {
            redirect('Trader/login_view');
        }
    }

    public function edit_bikepost() {
        $product_id = $_POST['txthid_pid'];
        $cat_id = $_POST['txthid_cid'];
        $cat = $_POST['txtcat'];
        $img = $_FILES['txtimage']['name'];

        $main_video_img = 'drop_zone1';
        $main_audio_img = 'car_img';

        $post_date = date('Y-m-d h:i:sa');

        $txtmodel = $_POST['txtmodel'];
        $txtbrand = $_POST['txtbrand'];
        $txtyear = $_POST['txtyear'];
        $txtdetails = $_POST['txtdetails'];

        if (isset($_POST['call_for_price'])) {
            $call_for_price = 1;
            $txtprice = '';
        } else {
            $call_for_price = 0;
            $txtprice = $_POST['txtprice'];
        }


        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $tr_user_type = $_SESSION['logged_in']['trader_id'];
        if ($tr_user_type == 1) {
            $prdt_ctype = 1;
        } else {
            $prdt_ctype = 0;
        }
        $data = array();

        $data['productCategoryID'] = '2';
        $data['traderID'] = $trader_id;
        $data['productLocation'] = '';

        $data['productCategoryName'] = 'bike';
        $data['productBBrand'] = $txtbrandname;
        $data['productBModel'] = $txtmodelname;
        $data['productBReleaseYear'] = $txtyear;
        $data['productBPrice'] = $txtprice;
        $data['productBCallPrice'] = $call_for_price;

        $data['productBDesc'] = $txtdetails;
        $data['productBSubmitDate'] = $post_date;
        $data['productBStatus'] = 0;
        $data['cartBType'] = $prdt_ctype;
        $data['productBLive'] = 0;
        $data['post_date'] = '';
        $rand_val = rand(10, 100);
        $data['Bpost_main_img'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $img;

        $config['upload_path'] = 'uploads/product_images/';
        $config['allowed_types'] = 'jpg|png';
        $config['file_name'] = $rand_val . '_' . $img;
        //$config['max_size'] = '1000000000000000';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('txtimage')) {

            $uploadData = $this->upload->data();

            $productImg = $uploadData['file_name'];
        } else {
            $msg = $this->upload->display_errors('', '');

            $productImg = '';
        }

        $this->db->where('productID', $product_id);
        $this->db->where('productCategoryID', $cat_id);
        $this->db->update('productbike', $data);
        $last_prd_id = $this->db->insert_id();

        $postdata['traderID'] = $trader_id;
        $postdata['productID'] = $last_prd_id;
        $postdata['productCategoryID'] = '2';
        $postdata['postDesc'] = $txtdetails;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '0';
        $this->db->where('productID', $product_id);
        $this->db->where('productCategoryID', $cat_id);
        $this->db->update('post', $postdata);
        $last_post_id = $this->db->insert_id();





        $images_array = array();
        $config = array();
        $config['upload_path'] = 'uploads/product_images/';
        $config['allowed_types'] = 'gif|jpg|png';

        $config['overwrite'] = FALSE;
        if (isset($_FILES['productVideo']['name'])) {
            $txtvideo = $_FILES['productVideo']['name'];
            $folder = "uploads/videos/";
            if (move_uploaded_file($_FILES["productVideo"]["tmp_name"], "$folder" . $rand_val . '_' . $_FILES["productVideo"]["name"])) {
                echo 'video uploaded';
            }
        } else {
            $txtvideo = '';
        }
        $this->load->library('upload');
        if (isset($_FILES['txtfiles']['name'])) {

            foreach ($_FILES['txtfiles']['name'] as $key => $val) {

                echo $uploadfile = $_FILES["txtfiles"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder . $_FILES['txtfiles']['name'][$key];
                $rand_val = rand(10, 100);
                $folder . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
                if (move_uploaded_file($_FILES["txtfiles"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key])) {
                    $images_array[] = $target_file;

                    $updimg_data['productID'] = $last_prd_id;
                    $updimg_data['postID'] = $last_post_id;
                    $updimg_data['productCategoryID'] = '2';
                    $updimg_data['traderID'] = $trader_id;

                    $updimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
                    $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
                    $updimg_data['cartType'] = $prdt_ctype;
                    $updimg_data['productLive'] = '0';
                    $updimg_data['productSubmitDate'] = $post_date;
                    $this->db->insert('productiv', $updimg_data);
                } else {
                    echo "error in uploading";
                }
            }
        } else {
            $updimg_data['productID'] = $last_prd_id;
            $updimg_data['postID'] = $last_post_id;
            $updimg_data['productCategoryID'] = '2';
            $updimg_data['traderID'] = $trader_id;

            $updimg_data['productImage'] = '';
            $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
            $updimg_data['cartType'] = $prdt_ctype;
            $updimg_data['productLive'] = '0';
            $updimg_data['productSubmitDate'] = $post_date;
            $this->db->where('productID', $product_id);
            $this->db->where('productCategoryID', $cat_id);
            $this->db->update('productiv', $updimg_data);
        }




        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Your Product is updated successfully</div>');
//         $path 
    }

    public function edit_carpost() {
        $product_id = $_POST['txthid_pid'];
        $cat_id = $_POST['txthid_cid'];

        if (isset($_POST['call_for_price'])) {
            $call_for_price = 1;
            $txtprice = '';
        } else {
            $call_for_price = 0;
            $txtprice = $_POST['txtprice'];
        }

        $cat = $_POST['txtcat'];
        $img = $_FILES['txtimage']['name'];
        if (isset($_FILES['productVideo']['name'])) {
            $txtvideo = $_FILES['productVideo']['name'];
        } else {
            $txtvideo = '';
        }
        $main_video_img = 'drop_zone1';
        $main_audio_img = 'car_img';


        $post_date = date('Y-m-d h:i:sa');

        $txtmodel = $_POST['txtmodel'];
        $txtbrand = $_POST['txtbrand'];


        $txtyear = $_POST['txtyear'];

        $txtdetails = $_POST['txtdetails'];

        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $tr_user_type = $_SESSION['logged_in']['trader_id'];
        if ($tr_user_type == 1) {
            $prdt_ctype = 1;
        } else {
            $prdt_ctype = 0;
        }
        $data = array();
        $data['productID'] = $product_id;
        $data['productCategoryID'] = '1';
        $data['traderID'] = $trader_id;
        $data['productLocation'] = '';

        $data['productCategoryName'] = 'Car';
        $data['productCBrand'] = $txtbrand;
        $data['productCModel'] = $txtmodel;
        $data['productCReleaseYear'] = $txtyear;
        $data['productCPrice'] = $txtprice;
        $data['productCCallPrice'] = $call_for_price;

        $data['productBCDesc'] = $txtdetails;
        $data['productCSubmitDate'] = $post_date;
        $data['productCStatus'] = 0;
        $data['cartCType'] = $prdt_ctype;
        $data['productCLive'] = 0;
        $data['post_date'] = '';
        $rand_val1 = rand(400, 600);
        $data['Cpost_main_img'] = base_url() . 'uploads/product_images/' . $rand_val1 . '_' . $img;

        $config['upload_path'] = 'uploads/product_images/';
        $config['allowed_types'] = 'jpg|png';
        $config['file_name'] = $rand_val1 . '_' . $img;
        //$config['max_size'] = '1000000000000000';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('txtimage')) {

            $uploadData = $this->upload->data();

            $productImg = $uploadData['file_name'];
        } else {
            $msg = $this->upload->display_errors('', '');

            $productImg = '';
        }
        $this->db->where('productID', $product_id);
        $this->db->where('productCategoryID', $cat_id);
        $this->db->update('productcar', $data);

        $last_prd_id = $this->db->insert_id();

        $postdata['traderID'] = $trader_id;
        $postdata['productID'] = $last_prd_id;
        $postdata['productCategoryID'] = '1';
        $postdata['postDesc'] = $txtdetails;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '0';
        $this->db->where('productID', $product_id);
        $this->db->where('productCategoryID', $cat_id);
        $this->db->update('post', $postdata);
        $last_post_id = $this->db->insert_id();





        $images_array = array();
        $config = array();
        $config['upload_path'] = 'uploads/product_images/';
        $config['allowed_types'] = 'gif|jpg|png';

        $config['overwrite'] = FALSE;

        $this->load->library('upload');
        if (isset($_FILES['txtfiles']['name'])) {
            foreach ($_FILES['txtfiles']['name'] as $key => $val) {


                $uploadfile = $_FILES["txtfiles"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder . $_FILES['txtfiles']['name'][$key];
                $rand_val2 = rand(200, 400);
                if (move_uploaded_file($_FILES["txtfiles"]["tmp_name"][$key], "$folder" . $rand_val2 . '_' . $_FILES["txtfiles"]["name"][$key])) {
                    $images_array[] = $target_file;

                    $updimg_data['productID'] = $last_prd_id;
                    $updimg_data['postID'] = $last_post_id;
                    $updimg_data['productCategoryID'] = '1';
                    $updimg_data['traderID'] = $trader_id;

                    $updimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val2 . '_' . $_FILES["txtfiles"]["name"][$key];
                    $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $rand_val2 . '_' . $txtvideo;
                    $updimg_data['cartType'] = $prdt_ctype;
                    $updimg_data['productLive'] = '0';
                    $updimg_data['productSubmitDate'] = $post_date;
                    $this->db->where('productID', $product_id);
                    $this->db->where('productCategoryID', $cat_id);
                    $this->db->update('productiv', $updimg_data);
                } else {
                    echo $_FILES["txtfiles"]["error"];
                }
            }
        }

        echo "success";
    }

    public function search() {
        $cat = '';
        $keyword = '';
        if (isset($_POST['category'])) {
            $cat = $_POST['category'];
        }
        if (isset($_POST['keyword'])) {
            $keyword = $_POST['keyword'];
        }


        $data['cat'] = $cat;
        $data['keyword'] = $keyword;

        $data['recentqry'] = $this->Trader_mdl->recently_viewed();

        $this->load->view('trader/trader_header');
        $this->load->view('trader/search_vw', $data);
        $this->load->view('trader/trader_footer');
    }
    function listAll(){
        //total rows count
            $category = $_REQUEST['category'];
        $keyword  = isset($_REQUEST['keyword'])?$_REQUEST['keyword']:'';
   
         
          //get the posts data
          $data['all_products'] = $this->Trader_mdl->getRowsProducts($category,$keyword);
          $data['recentqry'] = $this->Trader_mdl->recently_viewed();
            //$data['all_products']       = $this->Admin_mdl->listAllProducts($category,$keword);
          $data['category'] = $category;
          $this->load->view('trader/trader_header');
          $this->load->view('trader/search_vw', $data);
          $this->load->view('trader/trader_footer');
        
    }
    //Costomer signup

    function signupview() {
        if (isset($_SESSION['logged_in'])) {
            redirect('Trader');
        } else {
        $this->load->view('trader/trader_header');
        $this->load->view('trader/signup_vw');
        $this->load->view('trader/trader_footer');
        }
    }

    function signup() {
    

            $txtusertype = $_POST['txtusertype'];
            $Name = $_POST['Name'];
            $txtemail = $_POST['txtemail'];
            $txtpassword = $_POST['txtpassword'];
            $data = array(
                'traderFullName' => $Name,
                'traderUserName' => $txtemail,
                'traderEmailID' => $txtemail,
                'traderPasswd' => md5($txtpassword),
                'usertype' => $txtusertype,
            );

            if ($this->db->insert('trader', $data)) {
                $trader = $this->db->insert_id();

                if ($trader) {
                    $sess_array = array(
                        'trader_id' => $trader,
                        'txtemail' => $txtemail,
                        'txtusertype' => 0,
                    );

                    $this->session->set_userdata('logged_in', $sess_array);

                    $data['product'] = $this->Trader_mdl->get_product_list();
                    $data['trader'] = $this->Trader_mdl->get_traders_list();
                    $data['product'] = $this->Trader_mdl->get_product_list();
                    $data['qry'] = $this->Trader_mdl->latest_post();
                    $data['recentqry'] = $this->Trader_mdl->most_view();
                    $this->load->view('trader/trader_header');
                    $this->load->view('trader/trader_home_vw', $data);
                    $this->load->view('trader/trader_footer');
                } else {
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Please try again ...</div>');
                    $this->load->view('trader/trader_header');
                    $this->load->view('trader/signup_vw');
                    $this->load->view('trader/trader_footer');
                }
            }
        
    }

    function emailcheck() {
        $email = $_POST['txtemail'];
        $data = $this->Trader_mdl->emailchecking($email);
        if (($data > 0) && ($email != "")) {
            echo 'Email already exist';
        } else {
            echo '';
        }
    }

    function fetch_editbikemodel() {
        $brand = $_POST['brand'];
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->Trader_mdl->get_model_bikebrand($brand)));
    }

    function fetch_alshmail_loc() {

        $qry = $this->Trader_mdl->get_alshamil_loc();
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $this->Trader_mdl->up_paystatus($trader_id);
        ?>
        <p>You can pay at Alshamil Office<br><?php echo $qry[0]->locationAddress . "<br> " . $qry[0]->locationName ?><br><?php echo $qry[0]->locationContactNo ?></p>
         <p><a href="#" target="_blank">Get Directions on Google Maps</a></p>
            <?php
    }

    function checkoutfetch_alshmail_loc() {
        $qry = $this->Trader_mdl->get_alshamil_loc();
        ?>
        <p>You can pay at Alshamil Office<br><?php echo $qry[0]->locationAddress . "<br> " . $qry[0]->locationName ?><br><?php echo $qry[0]->locationContactNo ?></p>
        <p><a href="#" target="_blank">Get Directions on Google Maps</a></p>
            <?php
    }

    function up_bankpaystatus() {

        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $this->db->query('update tradersubscriptionplan set paymentTypeChosen = 2 where traderID=' . $trader_id);
    }


    function save_mnaddpost() {
       
        if (isset($_SESSION['logged_in'])) {
            $session_data = $this->session->userdata('logged_in');
            $trader_id = $session_data['trader_id'];
            $plan_cnt = $this->Trader_mdl->trader_plancnt($trader_id);
            $trader_plancnt = $plan_cnt[0]->planPostCount;
            if ($trader_plancnt > 0) {
                $this->update_plancnt($trader_id, $trader_plancnt);
            }

            $base_url = base_url();
            $cat = $_POST['txtcat'];
            $temp = $_POST['temp'];
            

            $operator = $_POST['operator'];
            $mobno = $_POST['txtmob'];
            $operator = $_POST['operator'];
            $prefix = $_POST['txtmainprefix'];
  

            $post_date = date('Y-m-d h:i:sa');
           
            $txtdetails = $_POST['txtdetails'];

            if (isset($_POST['call_for_price'])) {
                $call_for_price = 1;
                $txtprice = '';
            } else {
                $call_for_price = 0;
                $txtprice = $_POST['txtprice'];
            }

            $tr_user_type = $_SESSION['logged_in']['trader_id'];
            if ($tr_user_type == 1) {
                $prdt_ctype = 1;
            } else {
                $prdt_ctype = 0;
            }

            $data = array();




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
            $postdata['postStatus'] = '0';
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
            $this->db->update('trader', $tdata);
            $this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-success text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Your Product is added successfully</div></div></div>');
        } else {
            redirect('Trader/login_view');
        }
    }

    public function update_carpost() {

        $new_arr = array();
        $d = (isset($_POST['edit_imgs']))? $_POST['edit_imgs']:0;
         

        $product_id = $_POST['txthid_pid'];
        $cat_id = $_POST['txthid_cid'];
        $post_id = $_POST['txthid_postid'];
   
        $img = $_FILES['txtimage']['name'];

        $main_video_img = 'drop_zone1';
        $main_audio_img = 'car_img';

        $post_date = date('Y-m-d h:i:sa');

        $txtmodel = $_POST['txtmodel'];
        $txtbrand = $_POST['txtbrand'];

        $txtyear = $_POST['txtyear'];
        $txtdetails = $_POST['txtdetails'];

        if (isset($_POST['call_for_price'])) {
            $call_for_price = 1;
            $txtprice = '';
        } else {
            $call_for_price = 0;
            $txtprice = $_POST['txtprice'];
        }

        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $tr_user_type = $_SESSION['logged_in']['trader_id'];
        if ($tr_user_type == 1) {
            $prdt_ctype = 1;
        } else {
            $prdt_ctype = 0;
        }
        $rand_val = rand(10, 10000);
        $config['upload_path'] = 'uploads/product_images/';
        $config['allowed_types'] = 'jpg|png';
        $config['file_name'] = $rand_val . '_' . $img;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);



        $config['overwrite'] = FALSE;
        if (isset($_FILES['txtimage']['name'])) {
            $productImg = $_FILES['txtimage']['name'];
            $folder = "uploads/product_images/";
            if (move_uploaded_file($_FILES["txtimage"]["tmp_name"], "$folder" . $rand_val . '_' . $_FILES["txtimage"]["name"])) {
                $data = array();
                $data['Cpost_main_img'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $img;
                $this->db->where('productID', $product_id);
                $this->db->where('productCategoryID', $cat_id);
                $this->db->update('productcar', $data);
            }
        } else {
            
        }
        $data = array();

        $data['productCategoryID'] = '1';
        $data['traderID'] = $trader_id;
        $data['productLocation'] = '';

        $data['productCategoryName'] = 'car';
        $data['productCBrand'] = $txtbrand;
        $data['productCModel'] = $txtmodel;
        $data['productCReleaseYear'] = $txtyear;
        $data['productCPrice'] = $txtprice;
        $data['productCCallPrice'] = $call_for_price;

        $data['productCDesc'] = $txtdetails;
        $data['productCSubmitDate'] = $post_date;
        $data['productCStatus'] = 0;
        $data['cartCType'] = $prdt_ctype;
        $data['productCLive'] = 0;
        $data['post_date'] = '';
        $rand_val = rand(10, 10000);

        $this->db->where('productID', $product_id);
        $this->db->where('productCategoryID', $cat_id);

        $this->db->update('productcar', $data);


        $postdata['traderID'] = $trader_id;
        $postdata['productID'] = $product_id;
        $postdata['productCategoryID'] = $cat_id;
        $postdata['postDesc'] = $txtdetails;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '0';
        $this->db->where('productID', $product_id);
        $this->db->where('productCategoryID', $cat_id);
        $this->db->update('post', $postdata);
        $last_post_id = $this->db->insert_id();

        $config['upload_path'] = 'uploads/videos/';
        $config['allowed_types'] = 'mp4';

        if ($_FILES['productVideo']['size'] != 0) {

            $txtvideo = $_FILES['productVideo']['name'];
            $folder = "uploads/videos/";
            if (move_uploaded_file($_FILES["productVideo"]["tmp_name"], "$folder" . $rand_val . '_' . $_FILES["productVideo"]["name"])) {
                $msg = 'video uploaded';
                $video = array();
                $video['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
                $this->db->where('productID', $product_id);
                $this->db->where('productCategoryID', $cat_id);
                $this->db->update('productiv', $video);
            } else {
                
            }
        } else {
//                 if ($_FILES['productVideo']['size']==0) {
//                 $txtvideo = $_FILES['productVideo']['name'];
//                $config['upload_path'] = 'uploads/videos/';
//                $config['allowed_types'] = 'mp4';
//                 $folder = "uploads/videos/";
//                 if (move_uploaded_file($_FILES["productVideo"]["tmp_name"], "$folder" . $rand_val . '_' . $_FILES["productVideo"]["name"])) {
//               echo 'video uploaded'; 
//                 }
//               } else {
//               $txtvideo = '';
//        }
//                   $video = array();
//                   $video['productID']           = $product_id;
//                   $video['postID']              = $post_id;
//                   $video['traderID']            = $trader_id;;
//                   $video['productCategoryID']   = '1';
//                   $video['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
//                   $this->db->insert('productiv', $video);
        }


        $images_array = array();
        $config = array();
        $config['upload_path'] = 'uploads/product_images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = FALSE;

        $cnt = count($d);
        $i = 0;
        foreach ($_FILES['txtfiles']['name'] as $key => $tmp_name) {

            if ($i < $cnt) {
                 // echo $cnt . "kk" . $i . "-" . $d[$i] . "<br>";
                if ($d[$i] == '') {
                    if (($_FILES['txtfiles']['name'][$key]) != '') {
                        //insert
                      //  echo "new img ins";

                        $modnew_arr[] = $_FILES['txtfiles']['name'][$key];
                        $uploadfile = $_FILES["txtfiles"]["name"][$key];
                        $folder = "uploads/product_images/";
                        $target_file = $folder . $_FILES['txtfiles']['name'][$key];
                        $rand_val = rand(1000, 10000);
                        $folder . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
                        move_uploaded_file($_FILES["txtfiles"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key]);


                        $newupdimg_data['productID'] = $product_id;
                        $newupdimg_data['postID'] = $post_id;
                        $newupdimg_data['productCategoryID'] = $cat_id;
                        $newupdimg_data['traderID'] = $trader_id;

                        $newupdimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES['txtfiles']['name'][$key];
//                      $newupdimg_data['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
                        $newupdimg_data['cartType'] = $prdt_ctype;
                        $newupdimg_data['productLive'] = '0';
                        $newupdimg_data['productSubmitDate'] = $post_date;

                        $this->db->insert('productiv', $newupdimg_data);
                    }
                } else {
                    if (($_FILES['txtfiles']['name'][$key]) != '') {
                        //update
                      
                        $images = $_POST['imgs'];
                        foreach ($images as $key => $value) {
                            $modnew_arr[] = $_FILES['txtfiles']['name'][$key];
                            $uploadfile = $_FILES["txtfiles"]["name"][$key];
                            $folder = "uploads/product_images/";
                            $target_file = $folder . $_FILES['txtfiles']['name'][$key];

                            $rand_val = rand(1000, 10000);
                            $folder . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
                            if (move_uploaded_file($_FILES["txtfiles"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key])) {
                                $newupdimg_data['productID'] = $product_id;
                                $newupdimg_data['postID'] = $post_id;
                                $newupdimg_data['productCategoryID'] = $cat_id;
                                $newupdimg_data['traderID'] = $trader_id;

                                $newupdimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES['txtfiles']['name'][$key];
//                      $newupdimg_data['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
                                $newupdimg_data['cartType'] = $prdt_ctype;
                                $newupdimg_data['productLive'] = '0';
                                $newupdimg_data['productSubmitDate'] = $post_date;
                                $this->db->where('productID', $product_id);
                                $this->db->where('productCategoryID', $cat_id);
                                $this->db->where('productImage', $value);
                                $this->db->update('productiv', $newupdimg_data);
                            } else {
                                
                            }
                        }
                    }
                }
                $i++;
            } else {

                if (($_FILES['txtfiles']['name'][$key]) != '') {
                    echo " ins";
                    $modnew_arr[] = $_FILES['txtfiles']['name'][$key];
                    $uploadfile = $_FILES["txtfiles"]["name"][$key];
                    $folder = "uploads/product_images/";
                    $target_file = $folder . $_FILES['txtfiles']['name'][$key];
                    $rand_val = rand(1000, 10000);
                    $folder . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
                    move_uploaded_file($_FILES["txtfiles"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key]);
                    $newupdimg_data['productID'] = $product_id;
                    $newupdimg_data['postID'] = $post_id;
                    $newupdimg_data['productCategoryID'] = $cat_id;
                    $newupdimg_data['traderID'] = $trader_id;

                    $newupdimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES['txtfiles']['name'][$key];
//                  $newupdimg_data['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
                    $newupdimg_data['cartType'] = $prdt_ctype;
                    $newupdimg_data['productLive'] = '0';
                    $newupdimg_data['productSubmitDate'] = $post_date;
                    $this->db->insert('productiv', $newupdimg_data);
                }
            }
        }
       $this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-success text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Your Product is Updated Successfully</div></div></div>');


        redirect('Trader/tr_edit_post/' . $product_id . '/' . $cat_id);
    }

    public function update_bikepost() {


        $new_arr = array();
        $d = (isset($_POST['edit_imgs']))? $_POST['edit_imgs']:0;


        $product_id = $_POST['txthid_pid'];
        $cat_id = $_POST['txthid_cid'];
        $post_id = $_POST['txthid_postid'];
       // $cat = $_POST['txtcat'];

        $img = $_FILES['txtimage']['name'];

        $main_video_img = 'drop_zone1';
        $main_audio_img = 'car_img';

        $post_date = date('Y-m-d h:i:sa');

        $txtmodel = $_POST['txtmodel'];
        $txtbrand = $_POST['txtbrand'];

        $txtyear = $_POST['txtyear'];
        $txtdetails = $_POST['txtdetails'];

        if (isset($_POST['call_for_price'])) {
            $call_for_price = 1;
            $txtprice = '';
        } else {
            $call_for_price = 0;
            $txtprice = $_POST['txtprice'];
        }

        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $tr_user_type = $_SESSION['logged_in']['trader_id'];
        if ($tr_user_type == 1) {
            $prdt_ctype = 1;
        } else {
            $prdt_ctype = 0;
        }
        $rand_val = rand(10, 10000);
        $config['upload_path'] = 'uploads/product_images/';
        $config['allowed_types'] = 'jpg|png';
        $config['file_name'] = $rand_val . '_' . $img;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);



        $config['overwrite'] = FALSE;
        if (isset($_FILES['txtimage']['name'])) {
            $productImg = $_FILES['txtimage']['name'];
            $folder = "uploads/product_images/";
            if (move_uploaded_file($_FILES["txtimage"]["tmp_name"], "$folder" . $rand_val . '_' . $_FILES["txtimage"]["name"])) {
                $data = array();
                $data['Bpost_main_img'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $img;
                $this->db->where('productID', $product_id);
                $this->db->where('productCategoryID', $cat_id);
                $this->db->update('productbike', $data);
            }
        } else {
            
        }
        $data = array();

        $data['productCategoryID'] = '2';
        $data['traderID'] = $trader_id;
        $data['productLocation'] = '';

        $data['productCategoryName'] = 'Bike';
        $data['productBBrand'] = $txtbrand;
        $data['productBModel'] = $txtmodel;
        $data['productBReleaseYear'] = $txtyear;
        $data['productBPrice'] = $txtprice;
        $data['productBCallPrice'] = $call_for_price;

        $data['productBDesc'] = $txtdetails;
        $data['productBSubmitDate'] = $post_date;
        $data['productBStatus'] = 0;
        $data['cartBType'] = $prdt_ctype;
        $data['productBLive'] = 0;
        $data['post_date'] = '';
        $rand_val = rand(10, 100);

        $this->db->where('productID', $product_id);
        $this->db->where('productCategoryID', $cat_id);

        $this->db->update('productbike', $data);


        $postdata['traderID'] = $trader_id;
        $postdata['productID'] = $product_id;
        $postdata['productCategoryID'] = $cat_id;
        $postdata['postDesc'] = $txtdetails;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '0';
        $this->db->where('productID', $product_id);
        $this->db->where('productCategoryID', $cat_id);
        $this->db->update('post', $postdata);
        $last_post_id = $this->db->insert_id();

        $config['upload_path'] = 'uploads/videos/';
        $config['allowed_types'] = 'mp4';

        if ($_FILES['productVideo']['size'] != 0) {

            $txtvideo = $_FILES['productVideo']['name'];
            $folder = "uploads/videos/";
            if (move_uploaded_file($_FILES["productVideo"]["tmp_name"], "$folder" . $rand_val . '_' . $_FILES["productVideo"]["name"])) {
                $msg = 'video uploaded';
                $video = array();
                $video['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
                $this->db->where('productID', $product_id);
                $this->db->where('productCategoryID', $cat_id);
                $this->db->update('productiv', $video);
            } else {
                
            }
        } else {
//                 if ($_FILES['productVideo']['size']==0) {
//                 $txtvideo = $_FILES['productVideo']['name'];
//                $config['upload_path'] = 'uploads/videos/';
//                $config['allowed_types'] = 'mp4';
//                 $folder = "uploads/videos/";
//                 if (move_uploaded_file($_FILES["productVideo"]["tmp_name"], "$folder" . $rand_val . '_' . $_FILES["productVideo"]["name"])) {
//               echo 'video uploaded'; 
//                 }
//               } else {
//               $txtvideo = '';
//        }
//                   $video = array();
//                   $video['productID']           = $product_id;
//                   $video['postID']              = $post_id;
//                   $video['traderID']            = $trader_id;;
//                   $video['productCategoryID']   = '1';
//                   $video['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
//                   $this->db->insert('productiv', $video);
        }


        $images_array = array();
        $config = array();
        $config['upload_path'] = 'uploads/product_images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = FALSE;

        $cnt = count($d);
        $i = 0;
        foreach ($_FILES['txtfiles']['name'] as $key => $tmp_name) {

            if ($i < $cnt) {
                 // echo $cnt . "kk" . $i . "-" . $d[$i] . "<br>";
                if ($d[$i] == '') {
                    if (($_FILES['txtfiles']['name'][$key]) != '') {
                        //insert
                       // echo "new img ins";

                        $modnew_arr[] = $_FILES['txtfiles']['name'][$key];
                        $uploadfile = $_FILES["txtfiles"]["name"][$key];
                        $folder = "uploads/product_images/";
                        $target_file = $folder . $_FILES['txtfiles']['name'][$key];
                        $rand_val = rand(1000, 10000);
                        $folder . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
                        move_uploaded_file($_FILES["txtfiles"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key]);


                        $newupdimg_data['productID'] = $product_id;
                        $newupdimg_data['postID'] = $post_id;
                        $newupdimg_data['productCategoryID'] = $cat_id;
                        $newupdimg_data['traderID'] = $trader_id;

                        $newupdimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES['txtfiles']['name'][$key];
//                      $newupdimg_data['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
                        $newupdimg_data['cartType'] = $prdt_ctype;
                        $newupdimg_data['productLive'] = '0';
                        $newupdimg_data['productSubmitDate'] = $post_date;

                        $this->db->insert('productiv', $newupdimg_data);
                    }
                } else {
                    if (($_FILES['txtfiles']['name'][$key]) != '') {
                        //update
                        echo "new img up";
                        $images = $_POST['imgs'];
                        foreach ($images as $key => $value) {
                            $modnew_arr[] = $_FILES['txtfiles']['name'][$key];
                            $uploadfile = $_FILES["txtfiles"]["name"][$key];
                            $folder = "uploads/product_images/";
                            $target_file = $folder . $_FILES['txtfiles']['name'][$key];

                            $rand_val = rand(1000, 10000);
                            $folder . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
                            if (move_uploaded_file($_FILES["txtfiles"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key])) {
                                $newupdimg_data['productID'] = $product_id;
                                $newupdimg_data['postID'] = $post_id;
                                $newupdimg_data['productCategoryID'] = $cat_id;
                                $newupdimg_data['traderID'] = $trader_id;

                                $newupdimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES['txtfiles']['name'][$key];
//                      $newupdimg_data['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
                                $newupdimg_data['cartType'] = $prdt_ctype;
                                $newupdimg_data['productLive'] = '0';
                                $newupdimg_data['productSubmitDate'] = $post_date;
                                $this->db->where('productID', $product_id);
                                $this->db->where('productCategoryID', $cat_id);
                                $this->db->where('productImage', $value);
                                $this->db->update('productiv', $newupdimg_data);
                            } else {
                                
                            }
                        }
                    }
                }
                $i++;
            } else {

                if (($_FILES['txtfiles']['name'][$key]) != '') {
                    echo " ins";
                    $modnew_arr[] = $_FILES['txtfiles']['name'][$key];
                    $uploadfile = $_FILES["txtfiles"]["name"][$key];
                    $folder = "uploads/product_images/";
                    $target_file = $folder . $_FILES['txtfiles']['name'][$key];
                    $rand_val = rand(1000, 10000);
                    $folder . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
                    move_uploaded_file($_FILES["txtfiles"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key]);
                    $newupdimg_data['productID'] = $product_id;
                    $newupdimg_data['postID'] = $post_id;
                    $newupdimg_data['productCategoryID'] = $cat_id;
                    $newupdimg_data['traderID'] = $trader_id;

                    $newupdimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES['txtfiles']['name'][$key];
//                  $newupdimg_data['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
                    $newupdimg_data['cartType'] = $prdt_ctype;
                    $newupdimg_data['productLive'] = '0';
                    $newupdimg_data['productSubmitDate'] = $post_date;
                    $this->db->insert('productiv', $newupdimg_data);
                }
            }
        }

       $this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-success text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Your Product is Updated Successfully</div></div></div>');

        redirect('Trader/tr_edit_post/' . $product_id . '/' . $cat_id);
    }

    public function update_vertupost() {


        $new_arr = array();
        $d = (isset($_POST['edit_imgs']))? $_POST['edit_imgs']:0;

        $product_id = $_POST['txthid_pid'];
        $cat_id = $_POST['txthid_cid'];
        $post_id = $_POST['txthid_postid'];
       // $cat = $_POST['txtcat'];

        $img = $_FILES['txtimage']['name'];

        $main_video_img = 'drop_zone1';
        $main_audio_img = 'car_img';

        $post_date = date('Y-m-d h:i:sa');

        $txtmodel = $_POST['txtmodel'];
        $txtbrand = $_POST['txtbrand'];


        $txtdetails = $_POST['txtdetails'];

        if (isset($_POST['call_for_price'])) {
            $call_for_price = 1;
            $txtprice = '';
        } else {
            $call_for_price = 0;
            $txtprice = $_POST['txtprice'];
        }

        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $tr_user_type = $_SESSION['logged_in']['trader_id'];
        if ($tr_user_type == 1) {
            $prdt_ctype = 1;
        } else {
            $prdt_ctype = 0;
        }
        $rand_val = rand(10, 10000);
        $config['upload_path'] = 'uploads/product_images/';
        $config['allowed_types'] = 'jpg|png';
        $config['file_name'] = $rand_val . '_' . $img;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);



        $config['overwrite'] = FALSE;
        if (isset($_FILES['txtimage']['name'])) {
            $productImg = $_FILES['txtimage']['name'];
            $folder = "uploads/product_images/";
            if (move_uploaded_file($_FILES["txtimage"]["tmp_name"], "$folder" . $rand_val . '_' . $_FILES["txtimage"]["name"])) {
                $data = array();
                $data['Vpost_main_img'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $img;
                $this->db->where('productID', $product_id);
                $this->db->where('productCategoryID', $cat_id);
                $this->db->update('productvertu', $data);
            }
        } else {
            
        }
        $data = array();

        $data['productCategoryID'] = '4';
        $data['traderID'] = $trader_id;
        $data['productLocation'] = '';

        $data['productCategoryName'] = 'Vertu';
        $data['productVBrand'] = $txtbrand;
        $data['productVModel'] = $txtmodel;
        $data['productVPrice'] = $txtprice;
        $data['productVCallPrice'] = $call_for_price;

        $data['productVDesc'] = $txtdetails;
        $data['productVSubmitDate'] = $post_date;
        $data['productVStatus'] = 0;
        $data['cartVType'] = $prdt_ctype;
        $data['productVLive'] = 0;
        $data['post_date'] = '';
        $rand_val = rand(10, 100);

        $this->db->where('productID', $product_id);
        $this->db->where('productCategoryID', $cat_id);

        $this->db->update('productvertu', $data);


        $postdata['traderID'] = $trader_id;
        $postdata['productID'] = $product_id;
        $postdata['productCategoryID'] = $cat_id;
        $postdata['postDesc'] = $txtdetails;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '0';
        $this->db->where('productID', $product_id);
        $this->db->where('productCategoryID', $cat_id);
        $this->db->update('post', $postdata);
        $last_post_id = $this->db->insert_id();

        $config['upload_path'] = 'uploads/videos/';
        $config['allowed_types'] = 'mp4';

        if ($_FILES['productVideo']['size'] != 0) {

            $txtvideo = $_FILES['productVideo']['name'];
            $folder = "uploads/videos/";
            if (move_uploaded_file($_FILES["productVideo"]["tmp_name"], "$folder" . $rand_val . '_' . $_FILES["productVideo"]["name"])) {
                $msg = 'video uploaded';
                $video = array();
                $video['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
                $this->db->where('productID', $product_id);
                $this->db->where('productCategoryID', $cat_id);
                $this->db->update('productiv', $video);
            } else {
                
            }
        } else {
            
        }


        $images_array = array();
        $config = array();
        $config['upload_path'] = 'uploads/product_images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = FALSE;

        $cnt = count($d);
        $i = 0;
        foreach ($_FILES['txtfiles']['name'] as $key => $tmp_name) {

            if ($i < $cnt) {
                 // echo $cnt . "kk" . $i . "-" . $d[$i] . "<br>";
                if ($d[$i] == '') {
                    if (($_FILES['txtfiles']['name'][$key]) != '') {
                        //insert
                        //echo "new img ins";

                        $modnew_arr[] = $_FILES['txtfiles']['name'][$key];
                        $uploadfile = $_FILES["txtfiles"]["name"][$key];
                        $folder = "uploads/product_images/";
                        $target_file = $folder . $_FILES['txtfiles']['name'][$key];
                        $rand_val = rand(1000, 10000);
                        $folder . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
                        move_uploaded_file($_FILES["txtfiles"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key]);


                        $newupdimg_data['productID'] = $product_id;
                        $newupdimg_data['postID'] = $post_id;
                        $newupdimg_data['productCategoryID'] = $cat_id;
                        $newupdimg_data['traderID'] = $trader_id;

                        $newupdimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES['txtfiles']['name'][$key];
//                      $newupdimg_data['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
                        $newupdimg_data['cartType'] = $prdt_ctype;
                        $newupdimg_data['productLive'] = '0';
                        $newupdimg_data['productSubmitDate'] = $post_date;

                        $this->db->insert('productiv', $newupdimg_data);
                    }
                } else {
                    if (($_FILES['txtfiles']['name'][$key]) != '') {
                        //update
                        echo "new img up";
                        $images = $_POST['imgs'];
                        foreach ($images as $key => $value) {
                            $modnew_arr[] = $_FILES['txtfiles']['name'][$key];
                            $uploadfile = $_FILES["txtfiles"]["name"][$key];
                            $folder = "uploads/product_images/";
                            $target_file = $folder . $_FILES['txtfiles']['name'][$key];

                            $rand_val = rand(1000, 10000);
                            $folder . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
                            if (move_uploaded_file($_FILES["txtfiles"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key])) {
                                $newupdimg_data['productID'] = $product_id;
                                $newupdimg_data['postID'] = $post_id;
                                $newupdimg_data['productCategoryID'] = $cat_id;
                                $newupdimg_data['traderID'] = $trader_id;

                                $newupdimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES['txtfiles']['name'][$key];
//                      $newupdimg_data['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
                                $newupdimg_data['cartType'] = $prdt_ctype;
                                $newupdimg_data['productLive'] = '0';
                                $newupdimg_data['productSubmitDate'] = $post_date;
                                $this->db->where('productID', $product_id);
                                $this->db->where('productCategoryID', $cat_id);
                                $this->db->where('productImage', $value);
                                $this->db->update('productiv', $newupdimg_data);
                            } else {
                                
                            }
                        }
                    }
                }
                $i++;
            } else {

                if (($_FILES['txtfiles']['name'][$key]) != '') {
                    echo " ins";
                    $modnew_arr[] = $_FILES['txtfiles']['name'][$key];
                    $uploadfile = $_FILES["txtfiles"]["name"][$key];
                    $folder = "uploads/product_images/";
                    $target_file = $folder . $_FILES['txtfiles']['name'][$key];
                    $rand_val = rand(1000, 10000);
                    $folder . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
                    move_uploaded_file($_FILES["txtfiles"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key]);
                    $newupdimg_data['productID'] = $product_id;
                    $newupdimg_data['postID'] = $post_id;
                    $newupdimg_data['productCategoryID'] = $cat_id;
                    $newupdimg_data['traderID'] = $trader_id;

                    $newupdimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES['txtfiles']['name'][$key];
//                  $newupdimg_data['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
                    $newupdimg_data['cartType'] = $prdt_ctype;
                    $newupdimg_data['productLive'] = '0';
                    $newupdimg_data['productSubmitDate'] = $post_date;
                    $this->db->insert('productiv', $newupdimg_data);
                }
            }
        }

       $this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-success text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Your Product is Updated Successfully</div></div></div>');

        redirect('Trader/tr_edit_post/' . $product_id . '/' . $cat_id);
    }

    public function update_watchpost() {

        $new_arr = array();
        $d = (isset($_POST['edit_imgs']))? $_POST['edit_imgs']:0;


        $product_id = $_POST['txthid_pid'];
        $cat_id = $_POST['txthid_cid'];
        $post_id = $_POST['txthid_postid'];
       // $cat = $_POST['txtcat'];

        $img = $_FILES['txtimage']['name'];

        $main_video_img = 'drop_zone1';
        $main_audio_img = 'car_img';

        $post_date = date('Y-m-d h:i:sa');

        $txtmodel = $_POST['txtmodel'];
        $txtbrand = $_POST['txtbrand'];


        $txtdetails = $_POST['txtdetails'];

        if (isset($_POST['call_for_price'])) {
            $call_for_price = 1;
            $txtprice = '';
        } else {
            $call_for_price = 0;
            $txtprice = $_POST['txtprice'];
        }

        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $tr_user_type = $_SESSION['logged_in']['trader_id'];
        if ($tr_user_type == 1) {
            $prdt_ctype = 1;
        } else {
            $prdt_ctype = 0;
        }
        $rand_val = rand(10, 10000);
        $config['upload_path'] = 'uploads/product_images/';
        $config['allowed_types'] = 'jpg|png';
        $config['file_name'] = $rand_val . '_' . $img;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);



        $config['overwrite'] = FALSE;
        if (isset($_FILES['txtimage']['name'])) {
            $productImg = $_FILES['txtimage']['name'];
            $folder = "uploads/product_images/";
            if (move_uploaded_file($_FILES["txtimage"]["tmp_name"], "$folder" . $rand_val . '_' . $_FILES["txtimage"]["name"])) {
                $data = array();
                $data['Wpost_main_img'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $img;
                $this->db->where('productID', $product_id);
                $this->db->where('productCategoryID', $cat_id);
                $this->db->update('productwatch', $data);
            }
        } else {
            
        }
        $data = array();

        $data['productCategoryID'] = '5';
        $data['traderID'] = $trader_id;
        $data['productLocation'] = '';

        $data['productCategoryName'] = 'Watch';
        $data['productWBrand'] = $txtbrand;
        $data['productWModel'] = $txtmodel;
        $data['productWPrice'] = $txtprice;
        $data['productWCallPrice'] = $call_for_price;

        $data['productWDesc'] = $txtdetails;
        $data['productWSubmitDate'] = $post_date;
        $data['productWStatus'] = 0;
        $data['cartWType'] = $prdt_ctype;
        $data['productWLive'] = 0;
        $data['post_date'] = '';
        $rand_val = rand(10, 100);

        $this->db->where('productID', $product_id);
        $this->db->where('productCategoryID', $cat_id);

        $this->db->update('productwatch', $data);


        $postdata['traderID'] = $trader_id;
        $postdata['productID'] = $product_id;
        $postdata['productCategoryID'] = $cat_id;
        $postdata['postDesc'] = $txtdetails;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '0';
        $this->db->where('productID', $product_id);
        $this->db->where('productCategoryID', $cat_id);
        $this->db->update('post', $postdata);
        $last_post_id = $this->db->insert_id();

        $config['upload_path'] = 'uploads/videos/';
        $config['allowed_types'] = 'mp4';

        if ($_FILES['productVideo']['size'] != 0) {

            $txtvideo = $_FILES['productVideo']['name'];
            $folder = "uploads/videos/";
            if (move_uploaded_file($_FILES["productVideo"]["tmp_name"], "$folder" . $rand_val . '_' . $_FILES["productVideo"]["name"])) {
                $msg = 'video uploaded';
                $video = array();
                $video['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
                $this->db->where('productID', $product_id);
                $this->db->where('productCategoryID', $cat_id);
                $this->db->update('productiv', $video);
            } else {
                
            }
        } else {
            
        }


        $images_array = array();
        $config = array();
        $config['upload_path'] = 'uploads/product_images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = FALSE;

        $cnt = count($d);
        $i = 0;
        foreach ($_FILES['txtfiles']['name'] as $key => $tmp_name) {

            if ($i < $cnt) {
                 // echo $cnt . "kk" . $i . "-" . $d[$i] . "<br>";
                if ($d[$i] == '') {
                    if (($_FILES['txtfiles']['name'][$key]) != '') {
                        //insert
                       // echo "new img ins";

                        $modnew_arr[] = $_FILES['txtfiles']['name'][$key];
                        $uploadfile = $_FILES["txtfiles"]["name"][$key];
                        $folder = "uploads/product_images/";
                        $target_file = $folder . $_FILES['txtfiles']['name'][$key];
                        $rand_val = rand(1000, 10000);
                        $folder . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
                        move_uploaded_file($_FILES["txtfiles"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key]);


                        $newupdimg_data['productID'] = $product_id;
                        $newupdimg_data['postID'] = $post_id;
                        $newupdimg_data['productCategoryID'] = $cat_id;
                        $newupdimg_data['traderID'] = $trader_id;

                        $newupdimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES['txtfiles']['name'][$key];
//                      $newupdimg_data['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
                        $newupdimg_data['cartType'] = $prdt_ctype;
                        $newupdimg_data['productLive'] = '0';
                        $newupdimg_data['productSubmitDate'] = $post_date;

                        $this->db->insert('productiv', $newupdimg_data);
                    }
                } else {
                    if (($_FILES['txtfiles']['name'][$key]) != '') {
                        //update
                        echo "new img up";
                        $images = $_POST['imgs'];
                        foreach ($images as $key => $value) {
                            $modnew_arr[] = $_FILES['txtfiles']['name'][$key];
                            $uploadfile = $_FILES["txtfiles"]["name"][$key];
                            $folder = "uploads/product_images/";
                            $target_file = $folder . $_FILES['txtfiles']['name'][$key];

                            $rand_val = rand(1000, 10000);
                            $folder . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
                            if (move_uploaded_file($_FILES["txtfiles"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key])) {
                                $newupdimg_data['productID'] = $product_id;
                                $newupdimg_data['postID'] = $post_id;
                                $newupdimg_data['productCategoryID'] = $cat_id;
                                $newupdimg_data['traderID'] = $trader_id;

                                $newupdimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES['txtfiles']['name'][$key];
//                      $newupdimg_data['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
                                $newupdimg_data['cartType'] = $prdt_ctype;
                                $newupdimg_data['productLive'] = '0';
                                $newupdimg_data['productSubmitDate'] = $post_date;
                                $this->db->where('productID', $product_id);
                                $this->db->where('productCategoryID', $cat_id);
                                $this->db->where('productImage', $value);
                                $this->db->update('productiv', $newupdimg_data);
                            } else {
                                
                            }
                        }
                    }
                }
                $i++;
            } else {

                if (($_FILES['txtfiles']['name'][$key]) != '') {
                    echo " ins";
                    $modnew_arr[] = $_FILES['txtfiles']['name'][$key];
                    $uploadfile = $_FILES["txtfiles"]["name"][$key];
                    $folder = "uploads/product_images/";
                    $target_file = $folder . $_FILES['txtfiles']['name'][$key];
                    $rand_val = rand(1000, 10000);
                    $folder . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
                    move_uploaded_file($_FILES["txtfiles"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key]);
                    $newupdimg_data['productID'] = $product_id;
                    $newupdimg_data['postID'] = $post_id;
                    $newupdimg_data['productCategoryID'] = $cat_id;
                    $newupdimg_data['traderID'] = $trader_id;

                    $newupdimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES['txtfiles']['name'][$key];
//                  $newupdimg_data['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
                    $newupdimg_data['cartType'] = $prdt_ctype;
                    $newupdimg_data['productLive'] = '0';
                    $newupdimg_data['productSubmitDate'] = $post_date;
                    $this->db->insert('productiv', $newupdimg_data);
                }
            }
        }

       $this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-success text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Your Product is Updated Successfully</div></div></div>');

        redirect('Trader/tr_edit_post/' . $product_id . '/' . $cat_id);
    }

    public function update_boatpost() {

        $new_arr = array();
        $d = (isset($_POST['edit_imgs']))? $_POST['edit_imgs']:0;


        $product_id = $_POST['txthid_pid'];
        $cat_id = $_POST['txthid_cid'];
        $post_id = $_POST['txthid_postid'];
      //  $cat = $_POST['txtcat'];

        $img = $_FILES['txtimage']['name'];

        $main_video_img = 'drop_zone1';
        $main_audio_img = 'car_img';

        $post_date = date('Y-m-d h:i:sa');

        $txtmodel = $_POST['txtmodel'];
        $txtbrand = $_POST['txtbrand'];


        $txtdetails = $_POST['txtdetails'];

        if (isset($_POST['call_for_price'])) {
            $call_for_price = 1;
            $txtprice = '';
        } else {
            $call_for_price = 0;
            $txtprice = $_POST['txtprice'];
        }

        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $tr_user_type = $_SESSION['logged_in']['trader_id'];
        if ($tr_user_type == 1) {
            $prdt_ctype = 1;
        } else {
            $prdt_ctype = 0;
        }
        $rand_val = rand(10, 10000);
        $config['upload_path'] = 'uploads/product_images/';
        $config['allowed_types'] = 'jpg|png';
        $config['file_name'] = $rand_val . '_' . $img;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);



        $config['overwrite'] = FALSE;
        if (isset($_FILES['txtimage']['name'])) {
            $productImg = $_FILES['txtimage']['name'];
            $folder = "uploads/product_images/";
            if (move_uploaded_file($_FILES["txtimage"]["tmp_name"], "$folder" . $rand_val . '_' . $_FILES["txtimage"]["name"])) {
                $data = array();
                $data['BTpost_main_img'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $img;
                $this->db->where('productID', $product_id);
                $this->db->where('productCategoryID', $cat_id);
                $this->db->update('productboat', $data);
            }
        } else {
            
        }
        $data = array();

        $data['productCategoryID'] = '7';
        $data['traderID'] = $trader_id;
        $data['productLocation'] = '';

        $data['productCategoryName'] = 'Boat';
        $data['productBtBrand'] = $txtbrand;
        $data['productBtModel'] = $txtmodel;
        $data['productBTPrice'] = $txtprice;
        $data['productBtCallPrice'] = $call_for_price;

        $data['productBDesc'] = $txtdetails;
        $data['productBTSubmitDate'] = $post_date;
        $data['productBTStatus'] = 0;
        $data['cartBTType'] = $prdt_ctype;
        $data['productBtLive'] = 0;
        $data['post_date'] = '';
        $rand_val = rand(10, 100);

        $this->db->where('productID', $product_id);
        $this->db->where('productCategoryID', $cat_id);

        $this->db->update('productboat', $data);


        $postdata['traderID'] = $trader_id;
        $postdata['productID'] = $product_id;
        $postdata['productCategoryID'] = $cat_id;
        $postdata['postDesc'] = $txtdetails;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '0';
        $this->db->where('productID', $product_id);
        $this->db->where('productCategoryID', $cat_id);
        $this->db->update('post', $postdata);
        $last_post_id = $this->db->insert_id();

        $config['upload_path'] = 'uploads/videos/';
        $config['allowed_types'] = 'mp4';

        if ($_FILES['productVideo']['size'] != 0) {

            $txtvideo = $_FILES['productVideo']['name'];
            $folder = "uploads/videos/";
            if (move_uploaded_file($_FILES["productVideo"]["tmp_name"], "$folder" . $rand_val . '_' . $_FILES["productVideo"]["name"])) {
                $msg = 'video uploaded';
                $video = array();
                $video['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
                $this->db->where('productID', $product_id);
                $this->db->where('productCategoryID', $cat_id);
                $this->db->update('productiv', $video);
            } else {
                
            }
        } else {
            
        }


        $images_array = array();
        $config = array();
        $config['upload_path'] = 'uploads/product_images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = FALSE;

        $cnt = count($d);
        $i = 0;
        foreach ($_FILES['txtfiles']['name'] as $key => $tmp_name) {

            if ($i < $cnt) {
                 // echo $cnt . "kk" . $i . "-" . $d[$i] . "<br>";
                if ($d[$i] == '') {
                    if (($_FILES['txtfiles']['name'][$key]) != '') {
                        //insert
                        //echo "new img ins";

                        $modnew_arr[] = $_FILES['txtfiles']['name'][$key];
                        $uploadfile = $_FILES["txtfiles"]["name"][$key];
                        $folder = "uploads/product_images/";
                        $target_file = $folder . $_FILES['txtfiles']['name'][$key];
                        $rand_val = rand(1000, 10000);
                        $folder . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
                        move_uploaded_file($_FILES["txtfiles"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key]);


                        $newupdimg_data['productID'] = $product_id;
                        $newupdimg_data['postID'] = $post_id;
                        $newupdimg_data['productCategoryID'] = $cat_id;
                        $newupdimg_data['traderID'] = $trader_id;

                        $newupdimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES['txtfiles']['name'][$key];
//                      $newupdimg_data['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
                        $newupdimg_data['cartType'] = $prdt_ctype;
                        $newupdimg_data['productLive'] = '0';
                        $newupdimg_data['productSubmitDate'] = $post_date;

                        $this->db->insert('productiv', $newupdimg_data);
                    }
                } else {
                    if (($_FILES['txtfiles']['name'][$key]) != '') {
                        //update
                        echo "new img up";
                        $images = $_POST['imgs'];
                        foreach ($images as $key => $value) {
                            $modnew_arr[] = $_FILES['txtfiles']['name'][$key];
                            $uploadfile = $_FILES["txtfiles"]["name"][$key];
                            $folder = "uploads/product_images/";
                            $target_file = $folder . $_FILES['txtfiles']['name'][$key];

                            $rand_val = rand(1000, 10000);
                            $folder . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
                            if (move_uploaded_file($_FILES["txtfiles"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key])) {
                                $newupdimg_data['productID'] = $product_id;
                                $newupdimg_data['postID'] = $post_id;
                                $newupdimg_data['productCategoryID'] = $cat_id;
                                $newupdimg_data['traderID'] = $trader_id;

                                $newupdimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES['txtfiles']['name'][$key];
//                      $newupdimg_data['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
                                $newupdimg_data['cartType'] = $prdt_ctype;
                                $newupdimg_data['productLive'] = '0';
                                $newupdimg_data['productSubmitDate'] = $post_date;
                                $this->db->where('productID', $product_id);
                                $this->db->where('productCategoryID', $cat_id);
                                $this->db->where('productImage', $value);
                                $this->db->update('productiv', $newupdimg_data);
                            } else {
                                
                            }
                        }
                    }
                }
                $i++;
            } else {

                if (($_FILES['txtfiles']['name'][$key]) != '') {
                    echo " ins";
                    $modnew_arr[] = $_FILES['txtfiles']['name'][$key];
                    $uploadfile = $_FILES["txtfiles"]["name"][$key];
                    $folder = "uploads/product_images/";
                    $target_file = $folder . $_FILES['txtfiles']['name'][$key];
                    $rand_val = rand(1000, 10000);
                    $folder . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
                    move_uploaded_file($_FILES["txtfiles"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key]);
                    $newupdimg_data['productID'] = $product_id;
                    $newupdimg_data['postID'] = $post_id;
                    $newupdimg_data['productCategoryID'] = $cat_id;
                    $newupdimg_data['traderID'] = $trader_id;

                    $newupdimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES['txtfiles']['name'][$key];
//                  $newupdimg_data['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
                    $newupdimg_data['cartType'] = $prdt_ctype;
                    $newupdimg_data['productLive'] = '0';
                    $newupdimg_data['productSubmitDate'] = $post_date;
                    $this->db->insert('productiv', $newupdimg_data);
                }
            }
        }

       $this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-success text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Your Product is Updated Successfully</div></div></div>');

        redirect('Trader/tr_edit_post/' . $product_id . '/' . $cat_id);
    }

    public function update_phonepost() {

        $new_arr = array();
        $d = (isset($_POST['edit_imgs']))? $_POST['edit_imgs']:0;

        $product_id = $_POST['txthid_pid'];
        $cat_id = $_POST['txthid_cid'];
        $post_id = $_POST['txthid_postid'];
       // $cat = $_POST['txtcat'];

        $img = $_FILES['txtimage']['name'];

        $main_video_img = 'drop_zone1';
        $main_audio_img = 'car_img';

        $post_date = date('Y-m-d h:i:sa');

        $txtmodel = $_POST['txtmodel'];
        $txtbrand = $_POST['txtbrand'];


        $txtdetails = $_POST['txtdetails'];

        if (isset($_POST['call_for_price'])) {
            $call_for_price = 1;
            $txtprice = '';
        } else {
            $call_for_price = 0;
            $txtprice = $_POST['txtprice'];
        }

        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $tr_user_type = $_SESSION['logged_in']['trader_id'];
        if ($tr_user_type == 1) {
            $prdt_ctype = 1;
        } else {
            $prdt_ctype = 0;
        }
        $rand_val = rand(10, 10000);
        $config['upload_path'] = 'uploads/product_images/';
        $config['allowed_types'] = 'jpg|png';
        $config['file_name'] = $rand_val . '_' . $img;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);



        $config['overwrite'] = FALSE;
        if (isset($_FILES['txtimage']['name'])) {
            $productImg = $_FILES['txtimage']['name'];
            $folder = "uploads/product_images/";
            if (move_uploaded_file($_FILES["txtimage"]["tmp_name"], "$folder" . $rand_val . '_' . $_FILES["txtimage"]["name"])) {
                $data = array();
                $data['PHpost_main_img'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $img;
                $this->db->where('productID', $product_id);
                $this->db->where('productCategoryID', $cat_id);
                $this->db->update('productphone', $data);
            }
        } else {
            
        }
        $data = array();

        $data['productCategoryID'] = '8';
        $data['traderID'] = $trader_id;
        $data['productLocation'] = '';

        $data['productCategoryName'] = 'Phone';
        $data['productPBrand'] = $txtbrand;
        $data['productPModel'] = $txtmodel;
        $data['productPHPrice'] = $txtprice;
        $data['productPhCallPrice'] = $call_for_price;

        $data['productPDesc'] = $txtdetails;
        $data['productPSubmitDate'] = $post_date;
        $data['productPHStatus'] = 0;
        $data['cartPHType'] = $prdt_ctype;
        $data['productPhLive'] = 0;
        $data['post_date'] = '';
        $rand_val = rand(10, 10000);

        $this->db->where('productID', $product_id);
        $this->db->where('productCategoryID', $cat_id);

        $this->db->update('productphone', $data);


        $postdata['traderID'] = $trader_id;
        $postdata['productID'] = $product_id;
        $postdata['productCategoryID'] = $cat_id;
        $postdata['postDesc'] = $txtdetails;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '0';
        $this->db->where('productID', $product_id);
        $this->db->where('productCategoryID', $cat_id);
        $this->db->update('post', $postdata);
        $last_post_id = $this->db->insert_id();

        $config['upload_path'] = 'uploads/videos/';
        $config['allowed_types'] = 'mp4';

        if ($_FILES['productVideo']['size'] != 0) {

            $txtvideo = $_FILES['productVideo']['name'];
            $folder = "uploads/videos/";
            if (move_uploaded_file($_FILES["productVideo"]["tmp_name"], "$folder" . $rand_val . '_' . $_FILES["productVideo"]["name"])) {
                $msg = 'video uploaded';
                $video = array();
                $video['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
                $this->db->where('productID', $product_id);
                $this->db->where('productCategoryID', $cat_id);
                $this->db->update('productiv', $video);
            } else {
                
            }
        } else {
            
        }


        $images_array = array();
        $config = array();
        $config['upload_path'] = 'uploads/product_images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = FALSE;

        $cnt = count($d);
        $i = 0;
        foreach ($_FILES['txtfiles']['name'] as $key => $tmp_name) {

            if ($i < $cnt) {
                 // echo $cnt . "kk" . $i . "-" . $d[$i] . "<br>";
                if ($d[$i] == '') {
                    if (($_FILES['txtfiles']['name'][$key]) != '') {
                        //insert
                        //echo "new img ins";

                        $modnew_arr[] = $_FILES['txtfiles']['name'][$key];
                        $uploadfile = $_FILES["txtfiles"]["name"][$key];
                        $folder = "uploads/product_images/";
                        $target_file = $folder . $_FILES['txtfiles']['name'][$key];
                        $rand_val = rand(1000, 10000);
                        $folder . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
                        move_uploaded_file($_FILES["txtfiles"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key]);


                        $newupdimg_data['productID'] = $product_id;
                        $newupdimg_data['postID'] = $post_id;
                        $newupdimg_data['productCategoryID'] = $cat_id;
                        $newupdimg_data['traderID'] = $trader_id;

                        $newupdimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES['txtfiles']['name'][$key];
//                      $newupdimg_data['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
                        $newupdimg_data['cartType'] = $prdt_ctype;
                        $newupdimg_data['productLive'] = '0';
                        $newupdimg_data['productSubmitDate'] = $post_date;

                        $this->db->insert('productiv', $newupdimg_data);
                    }
                } else {
                    if (($_FILES['txtfiles']['name'][$key]) != '') {
                        //update
                        echo "new img up";
                        $images = $_POST['imgs'];
                        foreach ($images as $key => $value) {
                            $modnew_arr[] = $_FILES['txtfiles']['name'][$key];
                            $uploadfile = $_FILES["txtfiles"]["name"][$key];
                            $folder = "uploads/product_images/";
                            $target_file = $folder . $_FILES['txtfiles']['name'][$key];

                            $rand_val = rand(1000, 10000);
                            $folder . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
                            if (move_uploaded_file($_FILES["txtfiles"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key])) {
                                $newupdimg_data['productID'] = $product_id;
                                $newupdimg_data['postID'] = $post_id;
                                $newupdimg_data['productCategoryID'] = $cat_id;
                                $newupdimg_data['traderID'] = $trader_id;

                                $newupdimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES['txtfiles']['name'][$key];
//                      $newupdimg_data['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
                                $newupdimg_data['cartType'] = $prdt_ctype;
                                $newupdimg_data['productLive'] = '0';
                                $newupdimg_data['productSubmitDate'] = $post_date;
                                $this->db->where('productID', $product_id);
                                $this->db->where('productCategoryID', $cat_id);
                                $this->db->where('productImage', $value);
                                $this->db->update('productiv', $newupdimg_data);
                            } else {
                                
                            }
                        }
                    }
                }
                $i++;
            } else {

                if (($_FILES['txtfiles']['name'][$key]) != '') {
                    echo " ins";
                    $modnew_arr[] = $_FILES['txtfiles']['name'][$key];
                    $uploadfile = $_FILES["txtfiles"]["name"][$key];
                    $folder = "uploads/product_images/";
                    $target_file = $folder . $_FILES['txtfiles']['name'][$key];
                    $rand_val = rand(1000, 10000);
                    $folder . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
                    move_uploaded_file($_FILES["txtfiles"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key]);
                    $newupdimg_data['productID'] = $product_id;
                    $newupdimg_data['postID'] = $post_id;
                    $newupdimg_data['productCategoryID'] = $cat_id;
                    $newupdimg_data['traderID'] = $trader_id;

                    $newupdimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES['txtfiles']['name'][$key];
//                  $newupdimg_data['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
                    $newupdimg_data['cartType'] = $prdt_ctype;
                    $newupdimg_data['productLive'] = '0';
                    $newupdimg_data['productSubmitDate'] = $post_date;
                    $this->db->insert('productiv', $newupdimg_data);
                }
            }
        }

       $this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-success text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Your Product is Updated Successfully</div></div></div>');

        redirect('Trader/tr_edit_post/' . $product_id . '/' . $cat_id);
    }

    public function update_propertypost() {

        $new_arr = array();
        $d = (isset($_POST['edit_imgs']))? $_POST['edit_imgs']:0;


        $product_id = $_POST['txthid_pid'];
        $cat_id = $_POST['txthid_cid'];
        $post_id = $_POST['txthid_postid'];
       // $cat = $_POST['txtcat'];
        $img = $_FILES['txtimage']['name'];

        $main_video_img = 'drop_zone1';
        $main_audio_img = 'car_img';

        $post_date = date('Y-m-d h:i:sa');

        $txtsubcat = $_POST['txtbrand'];
        $txtprop = $_POST['txtmodel'];


        $txtdetails = $_POST['txtdetails'];

        if (isset($_POST['call_for_price'])) {
            $call_for_price = 1;
            $txtprice = '';
        } else {
            $call_for_price = 0;
            $txtprice = $_POST['txtprice'];
        }

        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $tr_user_type = $_SESSION['logged_in']['trader_id'];
        if ($tr_user_type == 1) {
            $prdt_ctype = 1;
        } else {
            $prdt_ctype = 0;
        }
        $rand_val = rand(10, 10000);
        $config['upload_path'] = 'uploads/product_images/';
        $config['allowed_types'] = 'jpg|png';
        $config['file_name'] = $rand_val . '_' . $img;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);



        $config['overwrite'] = FALSE;
        if (isset($_FILES['txtimage']['name'])) {
            $productImg = $_FILES['txtimage']['name'];
            $folder = "uploads/product_images/";
            if (move_uploaded_file($_FILES["txtimage"]["tmp_name"], "$folder" . $rand_val . '_' . $_FILES["txtimage"]["name"])) {
                $data = array();
                $data['PRpost_main_img'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $img;
                $this->db->where('productID', $product_id);
                $this->db->where('productCategoryID', $cat_id);
                $this->db->update('productproperty', $data);
            }
        } else {
            
        }
        $data = array();

        $data['productCategoryID'] = '9';
        $data['traderID'] = $trader_id;
        $data['productLocation'] = '';

        $data['productCategoryName'] = 'Property';
        $data['productPropSC'] = $txtsubcat;
        $data['productPropType'] = $txtprop;

        $data['productPRPrice'] = $txtprice;
        $data['productPropCallPrice'] = $call_for_price;

        $data['productDesc'] = $txtdetails;
        $data['productPRSubmitDate'] = $post_date;
        $data['productPRStatus'] = 0;
        $data['cartPRType'] = $prdt_ctype;
        $data['productPrLive'] = 0;
        $data['post_date'] = '';
        $rand_val = rand(10, 100);

        $this->db->where('productID', $product_id);
        $this->db->where('productCategoryID', $cat_id);
        $this->db->update('productproperty', $data);


        $postdata['traderID'] = $trader_id;
        $postdata['productID'] = $product_id;
        $postdata['productCategoryID'] = $cat_id;
        $postdata['postDesc'] = $txtdetails;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '0';
        $this->db->where('productID', $product_id);
        $this->db->where('productCategoryID', $cat_id);
        $this->db->update('post', $postdata);
        $last_post_id = $this->db->insert_id();





        $config['upload_path'] = 'uploads/videos/';
        $config['allowed_types'] = 'mp4';

        if ($_FILES['productVideo']['size'] != 0) {

            $txtvideo = $_FILES['productVideo']['name'];
            $folder = "uploads/videos/";
            if (move_uploaded_file($_FILES["productVideo"]["tmp_name"], "$folder" . $rand_val . '_' . $_FILES["productVideo"]["name"])) {
                $msg = 'video uploaded';
                $video = array();
                $video['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
                $this->db->where('productID', $product_id);
                $this->db->where('productCategoryID', $cat_id);
                $this->db->update('productiv', $video);
            } else {
                
            }
        } else {
            
        }


        $images_array = array();
        $config = array();
        $config['upload_path'] = 'uploads/product_images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = FALSE;

        $cnt = count($d);
        $i = 0;
        foreach ($_FILES['txtfiles']['name'] as $key => $tmp_name) {

            if ($i < $cnt) {
               //  // echo $cnt . "kk" . $i . "-" . $d[$i] . "<br>";
                if ($d[$i] == '') {
                    if (($_FILES['txtfiles']['name'][$key]) != '') {
                        //insert
                       // echo "new img ins";

                        $modnew_arr[] = $_FILES['txtfiles']['name'][$key];
                        $uploadfile = $_FILES["txtfiles"]["name"][$key];
                        $folder = "uploads/product_images/";
                        $target_file = $folder . $_FILES['txtfiles']['name'][$key];
                        $rand_val = rand(1000, 10000);
                        $folder . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
                        move_uploaded_file($_FILES["txtfiles"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key]);


                        $newupdimg_data['productID'] = $product_id;
                        $newupdimg_data['postID'] = $post_id;
                        $newupdimg_data['productCategoryID'] = $cat_id;
                        $newupdimg_data['traderID'] = $trader_id;

                        $newupdimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES['txtfiles']['name'][$key];
//                      $newupdimg_data['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
                        $newupdimg_data['cartType'] = $prdt_ctype;
                        $newupdimg_data['productLive'] = '0';
                        $newupdimg_data['productSubmitDate'] = $post_date;

                        $this->db->insert('productiv', $newupdimg_data);
                    }
                } else {
                    if (($_FILES['txtfiles']['name'][$key]) != '') {
                        //update
                        echo "new img up";
                        $images = $_POST['imgs'];
                        foreach ($images as $key => $value) {
                            $modnew_arr[] = $_FILES['txtfiles']['name'][$key];
                            $uploadfile = $_FILES["txtfiles"]["name"][$key];
                            $folder = "uploads/product_images/";
                            $target_file = $folder . $_FILES['txtfiles']['name'][$key];

                            $rand_val = rand(1000, 10000);
                            $folder . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
                            if (move_uploaded_file($_FILES["txtfiles"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key])) {
                                $newupdimg_data['productID'] = $product_id;
                                $newupdimg_data['postID'] = $post_id;
                                $newupdimg_data['productCategoryID'] = $cat_id;
                                $newupdimg_data['traderID'] = $trader_id;

                                $newupdimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES['txtfiles']['name'][$key];
//                      $newupdimg_data['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
                                $newupdimg_data['cartType'] = $prdt_ctype;
                                $newupdimg_data['productLive'] = '0';
                                $newupdimg_data['productSubmitDate'] = $post_date;
                                $this->db->where('productID', $product_id);
                                $this->db->where('productCategoryID', $cat_id);
                                $this->db->where('productImage', $value);
                                $this->db->update('productiv', $newupdimg_data);
                            } else {
                                
                            }
                        }
                    }
                }
                $i++;
            } else {

                if (($_FILES['txtfiles']['name'][$key]) != '') {
                    echo " ins";
                    $modnew_arr[] = $_FILES['txtfiles']['name'][$key];
                    $uploadfile = $_FILES["txtfiles"]["name"][$key];
                    $folder = "uploads/product_images/";
                    $target_file = $folder . $_FILES['txtfiles']['name'][$key];
                    $rand_val = rand(1000, 10000);
                    $folder . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key];
                    move_uploaded_file($_FILES["txtfiles"]["tmp_name"][$key], "$folder" . $rand_val . '_' . $_FILES["txtfiles"]["name"][$key]);
                    $newupdimg_data['productID'] = $product_id;
                    $newupdimg_data['postID'] = $post_id;
                    $newupdimg_data['productCategoryID'] = $cat_id;
                    $newupdimg_data['traderID'] = $trader_id;

                    $newupdimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES['txtfiles']['name'][$key];
//                  $newupdimg_data['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
                    $newupdimg_data['cartType'] = $prdt_ctype;
                    $newupdimg_data['productLive'] = '0';
                    $newupdimg_data['productSubmitDate'] = $post_date;
                    $this->db->insert('productiv', $newupdimg_data);
                }
            }
        }

       $this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-success text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Your Product is Updated Successfully</div></div></div>');

        redirect('Trader/tr_edit_post/' . $product_id . '/' . $cat_id);
    }

    public function update_noplatepost() {
        $product_id = $_POST['txthid_pid'];
        $cat_id = $_POST['txthid_cid'];
        $post_id = $_POST['txthid_postid'];

        $post_date = date('Y-m-d h:i:sa');

        $txtemirates = $_POST['txtemirates'];
        $temp = $_POST['temp'];
        $nplates = str_replace("img/noplate/temp/", "uploads/product_images/nplates/", $temp);
        $temp_long = $_POST['long_tempImg'];
        $nplates_long = str_replace("img/noplate/temp/", "uploads/product_images/nplates/", $temp_long);
        $link_array1 = explode('/',$nplates);
        $link_array2 = explode('/',$nplates_long);
        
            copy($temp,  $_SERVER['DOCUMENT_ROOT'] . "/uploads/product_images/nplates/".end($link_array1));
            copy($temp_long,  $_SERVER['DOCUMENT_ROOT'] . "/uploads/product_images/nplates/".end($link_array2));
        
            unlink($_SERVER['DOCUMENT_ROOT']."img/noplate/temp/".end($link_array1) );
            unlink($_SERVER['DOCUMENT_ROOT']."img/noplate/temp/".end($link_array2) );
      
        $txtcode = $_POST['txtcode'];

        $txtnpdigs = $_POST['txtno_digs'];
        $txtno = $_POST['txtnumber'];

        $txtdetails = $_POST['txtdetails'];
        if (isset($_POST['call_for_price'])) {
            $call_for_price = 1;
            $txtprice = '';
        } else {
            $call_for_price = 0;
            $txtprice = $_POST['txtprice'];
        }
        if (isset($_POST['txtType'])) {
            $txtType = 1;
        } else {
            $txtType = 0;
        }
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $tr_user_type = $_SESSION['logged_in']['trader_id'];
        if ($tr_user_type == 1) {
            $prdt_ctype = 1;
        } else {
            $prdt_ctype = 0;
        }
        $data = array();

        $data['productCategoryID'] = $cat_id;
        $data['traderID'] = $trader_id;
        $data['productLocation'] = '';

        $data['productCategoryName'] = 'number plate';
        $data['productNPEmrites'] = $txtemirates;
        $data['productNPTemplate'] = 1;
        $data['productNPCode'] = $txtcode;
        $data['productNPDigits'] = $txtnpdigs;
        $data['productNPNmbr'] = $txtno;
        $data['productNPPrice'] = $txtprice;
        $data['productNPCallPrice'] = $call_for_price;
        $data['productNPDesc'] = $txtdetails;
        $data['productNPSubmitDate'] = $post_date;
        $data['productNPStatus'] = 0;
        $data['cartNPType'] = $prdt_ctype;
        $data['productNPLive'] = 0;
        $data['post_date'] = '';
        $data['type'] = $txtType;
        $rand_val = rand(1000, 10000);
        $data['NPpost_main_img'] = $nplates;


        $this->db->where('productID', $product_id);
        $this->db->where('productCategoryID', $cat_id);
        $this->db->update('productnp', $data);

        $newupdimg_data['productImage'] = $nplates_long;
        //                      $newupdimg_data['productVideo'] = base_url() . 'uploads/videos/' . $rand_val . '_' . $txtvideo;
                                      
        $newupdimg_data['productSubmitDate'] = $post_date;
        $this->db->where('productID', $product_id);
        $this->db->where('productCategoryID', $cat_id);
                                        
        $this->db->update('productiv', $newupdimg_data);
        $postdata['traderID'] = $trader_id;
        $postdata['productID'] = $product_id;
        $postdata['productCategoryID'] = $cat_id;
        $postdata['postDesc'] = $txtdetails;
        $postdata['postSubmissionOn'] = $post_date;
        $postdata['postValidTill'] = '';
        $postdata['postStatus'] = '0';
        $this->db->where('productID', $product_id);
        $this->db->where('productCategoryID', $cat_id);
        $this->db->update('post', $postdata);
       $this->session->set_flashdata('msg', '<div class="row"><div class="col-md-12"><div class="alert alert-success text-center alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Your Product is Updated Successfully</div></div></div>');

        redirect('Trader/tr_edit_post/' . $product_id . '/' . $cat_id);
    }

    /* function product_category_details($product_id, $cat_id) {
      if ($cat_id == 1) {
      redirect('Trader/car_category_details/' . $product_id . '/' . $cat_id);
      }
      if ($cat_id == 2) {
      redirect('Trader/bike_category_details/' . $product_id . '/' . $cat_id);
      }
      if ($cat_id == 3) {
      redirect('Trader/show_noplate_details/' . $product_id . '/' . $cat_id);
      }
      if ($cat_id == 4) {
      redirect('Trader/show_vertu_details/' . $product_id . '/' . $cat_id);
      }
      if ($cat_id == 5) {
      redirect('Trader/show_watch_details/' . $product_id . '/' . $cat_id);
      }
      if ($cat_id == 6) {
      redirect('Trader/show_mobileno_details/' . $product_id . '/' . $cat_id);
      }
      if ($cat_id == 7) {
      redirect('Trader/boat_category_details/' . $product_id . '/' . $cat_id);
      }
      if ($cat_id == 8) {
      redirect('Trader/show_iphone_details/' . $product_id . '/' . $cat_id);
      }
      if ($cat_id == 9) {
      redirect('Trader/property_category_details/' . $product_id . '/' . $cat_id);
      }
      } */

    function view_my_profile($trader_id) {


        $config['base_url'] = base_url() . "Trader/view_my_profile/" . $trader_id;
        $cnt_appr = $this->Trader_mdl->count_mdl_fetch_appr_posts($trader_id);
        $total_row = count($cnt_appr);
        if ($count_car <= 18) {
            $choice = 0;
        }
        if (($count_car > 18) && ($count_car < 36)) {
            $choice = 1;
        }
        if (($count_car >= 36) && ($count_car < 54)) {
            $choice = 2;
        }
        if ($count_car >= 54) {
            $choice = 3;
        }
        $config["use_page_numbers"] = TRUE;
        $config["total_rows"] = $total_row;
        $config["per_page"] = 18;
        $config["uri_segment"] = 3;

        $config["num_links"] = $choice;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Previous Page';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next Page';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        //$query = $this->Trader_mdl->mdl_all_traders($config["per_page"], $page);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links);
        $data['app_qry'] = $this->Trader_mdl->mdl_fetch_appr_posts($trader_id, $config["per_page"], $page);



        $data['pend_qry'] = $this->Trader_mdl->mdl_fetch_pend_posts($trader_id);
        //$data['app_qry'] = $this->Trader_mdl->mdl_fetch_appr_posts($trader_id);
        $data['rej_qry'] = $this->Trader_mdl->mdl_fetch_rej_posts($trader_id);
        $cnt_rej = $this->Trader_mdl->mdl_fetch_rej_posts($trader_id);
        $cnt_appr = $this->Trader_mdl->mdl_fetch_appr_posts($trader_id, $config["per_page"], $page);
        $cnt_pend = $this->Trader_mdl->mdl_fetch_pend_posts($trader_id);
        $data['appr_post_cnt'] = $total_row;
        $data['rej_post_cnt'] = count($cnt_rej);
        $data['pend_post_cnt'] = count($cnt_pend);
        $data['notification'] = $this->Trader_mdl->notification_cnt();
        $tr_sold_cnt = $this->Trader_mdl->cnt_fetch_tr_solditems($trader_id);
        $tr_booked_cnt = $this->Trader_mdl->cnt_fetch_tr_bookeditems($trader_id);
        $tr_total_post = $this->Trader_mdl->cnt_fetch_tr_totalpost($trader_id);
        $cnt = count($tr_total_post);
        $data['traderSoldCount'] = count($tr_sold_cnt);
        $data['booked_cnt'] = count($tr_booked_cnt);
        $data['total_post'] = count($tr_total_post);
        //$data['pend_qry'] = $this->Trader_mdl->fetch_pend_posts();
        $data['cat_qry'] = $this->Trader_mdl->get_categories();
        $data['recentqry'] = $this->Trader_mdl->recently_viewed();
        $data["results"] = $this->Trader_mdl->fetch_post_data($config["per_page"], $page);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links);

        $data['query'] = $this->Trader_mdl->get_name($trader_id);
        //echo '<pre>';print_r($data);exit();
        $data['cart_qry'] = $this->Trader_mdl->cart_cnt();
        $data['watch_qry'] = $this->Trader_mdl->watch_cnt();
        $this->load->view('trader/trader_header');
        $this->load->view('trader/trader_profile_vw', $data);
        $this->load->view('trader/trader_footer');
    }

    function trader_update_pass() {
        
        $current_password = md5($_POST['current_password']);
        $password = $_POST['password'];
        $mod_pass = md5($password);
        $trader_id = $_POST['trader_id'];
        $data['traderPasswd'] = $mod_pass;
        $this->db->where(array('traderID'=>$trader_id,'traderPasswd'=>$current_password));
        $this->db->update('trader', $data);
        if($this->db->affected_rows()){
            echo "success"; 
        }else  echo "0";
    }

    function preview() {
        $data['product_id'] = $this->uri->segment(3);
        $data['cat_id'] = $this->uri->segment(4);
        $data['img'] = $this->uri->segment(5);

        $this->load->view('trader/preview', $data);
    }

    function updateVideoCount() {
        $url = $_POST['url'];
        $count = $_POST['count'];
        echo $this->Trader_mdl->updateVideoCount($url, $count + 1);
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
            $font = dirname(__FILE__) .'/../../fonts/Lato-Bold.ttf';
            imagettftext($image, $fontSize, 0, $x, $y, -$color, $font, $text);
            $name = microtime();
			$newname = str_replace(' ','',$name);
			$newname = str_replace('.','',$newname);
			$newname = $newname.'.png';
            $loc = $_SERVER['DOCUMENT_ROOT'] . '/img/mobno/mobile/'.  $newname;
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
            $font = dirname(__FILE__) .'/../../fonts/Lato-Bold.ttf';
            imagettftext($image, $dufontSize, 0, $x, $y, -$ducolor, $font, $text);
            $name = microtime();
			$newname = str_replace(' ','',$name);
			$newname = str_replace('.','',$newname);
			$newname = $newname.'.png';
                       
            $loc = $_SERVER['DOCUMENT_ROOT'] . '/img/mobno/mobile/'.  $newname;
            
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
            $font = dirname(__FILE__) .'/../../fonts/Lato-Bold.ttf';
            imagettftext($image, $fontSize, 0, $x, $y, -$color, $font, $text);
            $name = microtime();
			$newname = str_replace(' ','',$name);
			$newname = str_replace('.','',$newname);
			$newname = $newname.'.png';
            $loc = $_SERVER['DOCUMENT_ROOT'] . '/img/mobno/mobile/'.  $newname;
            imagepng($image, $loc);
            imagedestroy($image);
            $loc = $base_url.'img/mobno/mobile/'. $newname;
        }
        echo $loc;
    }
    function OnlinePay(){
        $this->user1iD = $_GET['user_id'];
        $this->amount = $_GET['amount'];
       if(isset($_GET['order_id'])){
        $this->order1iD = $_GET['order_id'];   
        $order=$this->db->get_where('order_items',array('orderID' => $_GET['order_id']),1)->result();
        $this->amount=$order[0]->orderAmount;
    }else{
        $this->order1iD=NULL;
        $order=$this->db->get_where('tradersubscriptionplan',array('traderID' => $_GET['user_id']),1)->result();
        $this->amount=$order[0]->planAmount;
        
    }

        //Network International Payment Gateway Details
        $this->networkOnlineArray[]= array('Network_Online_setting' => array(
                                            'merchantKey'    => $this->mKey,            // Your key provided by network international
                                            'merchantId'     => $this->mId, //  Your merchant ID ex: 201408191000001
                                            'collaboratorId' => 'NI',                // Constant used by Network Online international
                                            'iv'             => $this->iv, // Used for initializing CBC encryption mode
                                            'url'            => false              // Set to false if you are using testing environment , set to true if you are using live environment
                                ),
                                'Block_Existence_Indicator' => array(
                                            'transactionDataBlock' => true,
                                            'billingDataBlock'     => true,
                                            'shippingDataBlock'    => false,
                                            'paymentDataBlock'     => false,
                                            'merchantDataBlock'    => true,
                                            'otherDataBlock'       => true,
                                            'DCCDataBlock'         => false
                                ),
                                'Field_Existence_Indicator_Transaction' => array(
                                            'merchantOrderNumber'  =>time(), //
                                            'amount'               => $this->amount,
                                            'successUrl'           => base_url()."Trader/SaveTransactionData",//"http://alshamil.bluecast.ae/Trader/SaveTransactionData"
                                            'failureUrl'           => base_url()."Trader/transactionfailure",//http://alshamil.bluecast.ae/alshamil.bluecast.ae/Trader/transactionfailure
                                            'payModeType'          => '',
                                            'transactionMode'       => 'INTERNET',
                                            'transactionType'      => '01',
                                            'currency'             => 'AED'
                                ),
                                'Field_Existence_Indicator_Billing' => array(
                                            'billToFirstName'       => 'Soloman', 
                                            'billToLastName'        => 'Vandy',
                                            'billToStreet1'         => '123,ParkStreet',
                                            'billToStreet2'         => 'Park Street',
                                            'billToCity'            => 'Mumbai',
                                            'billToState'           => 'Maharashtra',
                                            'billtoPostalCode'      => '400081',
                                            'billToCountry'         => 'IN',
                                            'billToEmail'           => 'solomanv@test.com',
                                            'billToMobileNumber'    => '9820998209',
                                            'billToPhoneNumber1'    => '',
                                            'billToPhoneNumber2'    => '',
                                            'billToPhoneNumber3'    => ''
                                ),
                                'Field_Existence_Indicator_Shipping' => array(
                                            'shipToFirstName'    => 'Soloman', 
                                            'shipToLastName'     => 'Vandy', 
                                            'shipToStreet1'      => '123ParkStreet', 
                                            'shipToStreet2'      => 'parkstreet', 
                                            'shipToCity'         => 'Mumbai',
                                            'shipToState'        => 'Maharashtra',
                                            'shipToPostalCode'   => '400081',
                                            'shipToCountry'      => 'IN',
                                            'shipToPhoneNumber1' => '',
                                            'shipToPhoneNumber2' => '',
                                            'shipToPhoneNumber3' => '',
                                            'shipToMobileNumber' => '9820998209'
                                ),
                                'Field_Existence_Indicator_Payment' => array(
                                            'cardNumber'      => '4111111111111111', // 1. Card Number  
                                            'expMonth'        => '08',               // 2. Expiry Month 
                                            'expYear'         => '2020',             // 3. Expiry Year
                                            'CVV'             => '123',              // 4. CVV  
                                            'cardHolderName'  => 'Soloman',          // 5. Card Holder Name 
                                            'cardType'        => 'Visa',             // 6. Card Type
                                            'custMobileNumber'=> '9820998209',       // 7. Customer Mobile Number
                                            'paymentID'       => '123456',           // 8. Payment ID 
                                            'OTP'             => '123456',           // 9. OTP field 
                                            'gatewayID'       => '1026',             // 10.Gateway ID 
                                            'cardToken'       => '1202'              // 11.Card Token 
                                ),
                                'Field_Existence_Indicator_Merchant'  => array(
                                                    'UDF1'   => '115.121.181.112', // This is a ‘user-defined field’ that can be used to send additional information about the transaction.
                                                    'UDF2'   => $this->user1iD,             // This is a ‘user-defined field’ that can be used to send additional information about the transaction.
                                                    'UDF3'   => $this->order1iD,             // This is a ‘user-defined field’ that can be used to send additional information about the transaction.
                                                    'UDF4'   => 'abc',             // This is a ‘user-defined field’ that can be used to send additional information about the transaction.
                                                    'UDF5'   => 'abc',             // This is a ‘user-defined field’ that can be used to send additional information about the transaction.
                                                    'UDF6'   => 'abc',             // This is a ‘user-defined field’ that can be used to send additional information about the transaction.
                                                    'UDF7'   => 'abc',             // This is a ‘user-defined field’ that can be used to send additional information about the transaction.
                                                    'UDF8'   => 'abc',             // This is a ‘user-defined field’ that can be used to send additional information about the transaction.
                                                    'UDF9'   => 'abc',             // This is a ‘user-defined field’ that can be used to send additional information about the transaction.
                                                    'UDF10'  => 'abc'              // This is a ‘user-defined field’ that can be used to send additional information about the transaction.                             
                                ),
                                'Field_Existence_Indicator_OtherData'  => array(
                                        'custID'                 => $this->user1iD,  
                                        'transactionSource'      => 'IVR',                      
                                        'productInfo'            => $this->user1iD,                         
                                        'isUserLoggedIn'         => 'Y',                            
                                        'itemTotal'              => '500.00, 1000.00', 
                                        'itemCategory'           => 'CD, Book',                         
                                        'ignoreValidationResult' => 'FALSE'
                                ),
                                'Field_Existence_Indicator_DCC'   => array(
                                        'DCCReferenceNumber' => '09898787', // DCC Reference Number
                                        'foreignAmount'      => '240.00', // Foreign Amount
                                        'ForeignCurrency'    => 'USD'  // Foreign Currency
                                )
                            );


        $networkOnlineObject = new NetworkonlieBitmapPaymentIntegration($this->networkOnlineArray);
        $requestParameter = $networkOnlineObject->NeoPostData;

        if($networkOnlineObject->url)
            $requestUrl = 'https://NeO.network.ae/direcpay/secure/PaymentTxnServlet';
        else
            $requestUrl = 'https://uat.timesofmoney.com/direcpay/secure/PaymentTxnServlet';
            
            $data = array('url'=>$requestUrl,'req_param'=>$requestParameter);
            
        $this->load->view('trader/trader_onlinepay_vw',$data);
    } 
     
    function saveTransactionData(){
        //$user_id = $this->user_id;
        //$order_id = $this->order_id;
     
        $data = array('order_id' => '', 'ref_num'=>'');
        if(isset($_REQUEST['responseParameter']) && $_REQUEST['responseParameter'] != ''){
           $networkOnlineObject = new NetworkonlieBitmapPaymentIntegration($this->networkOnlineArray);
           $response = $networkOnlineObject->decryptData($_REQUEST['responseParameter'],$this->mKey,$this->iv);
           $transactionResponse = explode('|',$response['Transaction_Response']);
           $transactionRelatedInformation = explode('|',$response['Transaction_related_information']); 
           $traderRelated = explode('|',$response['Merchant_Information']); 
           $data =  array('order_id'=>$transactionRelatedInformation[1],'ref_num'=>$transactionResponse[1]);
           $order_id=(!empty($traderRelated[3])&&$traderRelated[3]!="abc")?$traderRelated[3]:NULL;
          $this->load->Model('Admin_mdl');
           $this->Admin_mdl->save_transaction_details($transactionResponse[1],$traderRelated[2],$order_id);
        }
     
      $this->load->view('trader/success',$data);
    }


    function transactionfailure(){
        $networkOnlineObject = new NetworkonlieBitmapPaymentIntegration($this->networkOnlineArray);
           $response = $networkOnlineObject->decryptData($_REQUEST['responseParameter'],$this->mKey,$this->iv);
           $transactionResponse = explode('|',$response['Transaction_Response']);
         
        $this->load->view('trader/failed');
    }
    function testcallback(){
    //test
        $this->load->view('trader/appcallback');
    }

}
