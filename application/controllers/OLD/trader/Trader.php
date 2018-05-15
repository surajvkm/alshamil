<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Trader extends Public_Controller
{ 
  function __construct()
  {
    parent::__construct();
     $this->load->library('pagination');
  }
 
  public function index()
  {
      
    $this->load->Model('trader/Trader_mdl');
    $code_data['qry'] = $this->Trader_mdl->get_countries_code();
    $this->load->view('trader/trader_reg_vw',$code_data);
  }
  
  public function home_page()
  {
      $this->load->view('trader/trader_home_vw');
  }
  public function login_view()
  {
      $this->load->view('trader/trader_login_vw');
  }
  public function save_trader()
  {
      $this->load->view('trader/trader_select_plan_vw');
      /*$this->form_validation->set_rules('txtname', 'Name', 'required');
      $this->form_validation->set_rules('txtmob', 'Mobile No.', 'required|min_length[13]');
      $this->form_validation->set_rules('txtemail', 'Email', 'required|valid_email');
      $this->form_validation->set_rules('txtuname', 'User Name', 'required');
      $this->form_validation->set_rules('txtpassword', 'Password', 'required|callback_chk_password_expression');
      $this->form_validation->set_rules('txtconfpassword', 'Password', 'required|matches[txtpassword]');
      $this->form_validation->set_rules('txtemrid', 'Emirates ID or Passport', 'required');
      $this->form_validation->set_rules('txtweblink', 'Weblink', 'required');
      $this->form_validation->set_rules('txtfblink', 'Facebook Link', 'required');
      $this->form_validation->set_rules('txtinstlink', 'Instagram Link', 'required');
      $this->form_validation->set_rules('txtsnapclink', 'Snapchat Link', 'required');
      
      if ($this->form_validation->run() == FALSE)
      {
         $this->index();
         
      }
      else
      {
          
         
          $this->load->view('trader/trader_select_plan_vw');
      }*/
      
  }
  public function payment_options()
  {
      $data['plantype'] = $_POST['plan_type'];
      $this->load->view('trader/trader_payment_options_vw',$data);
  }
  public function make_reg_pay()
  {
      $plan_type = $_POST['plan_type'];
      if($plan_type == 'Yearly Plan[AED 6000/Month]')
      {
          $pay_amt = '72000';
      }
      else if($plan_type == 'Monthly Plan[AED 1000/Month]')
      {
          $pay_amt = '12000'; 
      }
      else if($plan_type == 'Yearly Limited Plan[30 Post]')
      {
          $pay_amt = '1000'; 
      }
     else
     {
        $pay_amt = '2000';   
      }
      
      $data['plantype'] = $plan_type;
      $data['pay_amt'] = $pay_amt;
       $this->load->view('trader/trader_login_vw');
      //$this->load->view('trader/trader_regpay_vw',$data); 
  }
  public function view_watch_list()
  {
      $this->load->view('trader/watch_list_vw');
  }
  public function view_cart()
  {
      $this->load->view('trader/trader_cart_vw');
  }
  public function view_category()
  {
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
        if($this->uri->segment(3)){
        $page = ($this->uri->segment(3)) ;
        }
        else{
        $page = 1;
        }
        $this->load->Model('trader/Trader_mdl'); 
        $data["results"] = $this->Trader_mdl->fetch_post_data($config["per_page"], $page);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;',$str_links );

       $this->load->view('trader/category_page_vw',$data);
  }
  
  public function view_category_details()
  {
      
       $this->load->view('trader/category_detail_page_vw');
  }
  public function view_checkout()
  {
       $this->load->view('trader/checkout_vw');
  }
  public function view_post_reject()
  {
     $this->load->view('trader/post_reject_vw'); 
  }
    function chk_password_expression($str)
    {
   
         if (1 !== preg_match("/^.*(?=.{8})(?=.*[0-9])(?=.*[a-z])(?=.*[!@#$%^&*()\-_=+{};:,<.>§~]).*$/", $str)){
       $this->form_validation->set_message('chk_password_expression', '%s must be at least 8 characters and must contain alphanumeric characters and one special character ');
       return FALSE;
       }
       else{
       return TRUE;
       }
       
   } 
  
  /*
   * loading view page for payment
   */
  public function regpay()
  {
       $this->load->view('trader/trader_regpay_vw');
  }
  public function save_regpay()
  {
       $this->load->view('trader/trader_login_vw');
  }
   
   public function login_check()
   {
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
        if($this->uri->segment(3)){
        $page = ($this->uri->segment(3)) ;
        }
        else{
        $page = 1;
        }
        $this->load->Model('trader/Trader_mdl'); 
        $data["results"] = $this->Trader_mdl->fetch_post_data($config["per_page"], $page);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;',$str_links );

        // View data according to array.
        
      $this->load->view('trader/trader_profile_vw',$data);
   }
   public  function add_post()
   {
      $this->load->Model('trader/Trader_mdl');
      $country_data['qry'] = $this->Trader_mdl->get_countries_code();
      $this->load->view('trader/trader_addpost_vw',$country_data);  
   }
   public function car_add_post()
   {
       
      $this->load->Model('trader/Trader_mdl');
      $country_data['qry'] = $this->Trader_mdl->get_countries_code();
      $this->load->view('trader/car_addpost_vw',$country_data); 
   }
   public function mobile_add_post()
   {
       
      $this->load->Model('trader/Trader_mdl');
      $country_data['qry'] = $this->Trader_mdl->get_countries_code();
      $this->load->view('trader/mobileno_addpost_vw',$country_data); 
   }
   public function verwatch_add_post()
   {
       
      $this->load->Model('trader/Trader_mdl');
      $country_data['qry'] = $this->Trader_mdl->get_countries_code();
      $this->load->view('trader/vertu_watch_addpost_vw',$country_data); 
   }
   public function property_add_post()
   {
      $this->load->Model('trader/Trader_mdl');
      $country_data['qry'] = $this->Trader_mdl->get_countries_code();
      $this->load->view('trader/property_addpost_vw',$country_data);  
   }
   public function numberplate_add_post()
   {
        $this->load->Model('trader/Trader_mdl');
      $country_data['qry'] = $this->Trader_mdl->get_countries_code();
      $this->load->view('trader/numberplate_addpost_vw',$country_data); 
   }
   public  function view_other_profile()
   {
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
        if($this->uri->segment(3)){
        $page = ($this->uri->segment(3)) ;
        }
        else{
        $page = 1;
        }
        $this->load->Model('trader/Trader_mdl'); 
        $data["results"] = $this->Trader_mdl->fetch_post_data($config["per_page"], $page);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;',$str_links );

      $this->load->view('trader/other_trader_profile_vw',$data); 
   }

}

