<?php 
$cartCount = 0;
$watchCount = 0;
$dropDown = '';
$avatar = base_url() .'img/menu-user.png';
$whref = base_url() . 'signin';
$chref = base_url() . 'signin';
$existing_languages = $this->lang->find();

$slang = 'english';
if($this->session->userdata('site_lang')){
 	
 	$slang =$this->session->userdata('site_lang');
}

if ($this->session->userdata('logged_in')) {
    $cartCount =  $this->View_Model->cartCount();
    $watchCount = $this->View_Model->watchCount();
    $whref = base_url() . 'cart/watch_list';
    $chref = base_url() . 'cart/view_cart';

    $user_data = $this->session->userdata('logged_in');
    $user_id = $user_data['trader_id'];
    $user_type = $user_data['txtusertype'];
    $dbimg = $this->View_Model->getAvr($user_id);
    if($dbimg!=='')
    $avatar= $dbimg;
    
    if ($user_type == '1') {
        $dropDown = '<div class="dropdown-content">
                        <a href="' . base_url() . 'trader/profile">My Profile</a><br>
                        <a href="' . base_url() . 'trader/logout">Logout</a>
                  </div>';
    } else {
        $dropDown = '<div class="dropdown-content">
                      
                        <a href="' . base_url() . 'trader/logout">Logout</a>
                  </div>';
    }
    $user = $this->View_Model->getUser($user_id);
    $html = '<a onclick="check_add_post()"><button type="button"  id="tr_prof_btn" class="btn btn-default">'
            . '<img  src="' . base_url() . 'img/profile-add-post.png" id="tr_prof_plus_square"> Add Post</button></a>'
            . '<a id="spsign" href="' . base_url() . 'trader/logout"></a> ';
} else {

$html = ''
            . '<a id="spsign" href="' . base_url() . 'signin">Sign In</a>
            <a id="spreg" data-toggle="modal" data-target="#regModal" >Register</a>';
            
}

$first_row = $this->View_Model->get_parent_category(9,0);
$more_row = $this->View_Model->get_parent_category(50,$first_row->num_rows());
$main_cat = $this->View_Model->get_parent_category();
?>
<div class="container-fluid headerBar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 px-0">
                        <div class="col-xs-12 col-sm-2 col-md-3 col-lg-3 px-0 textcenter">
                            <a href="<?php echo base_url() ?>">
                                <img class="als_logo" src="<?php echo base_url(); ?>img/Logo.png" alt="" />
                            </a>
                        </div><!-- end col -->
                    
                        <div class="col-xs-12 col-sm-7 col-md-6 col-lg-6 paddingleft52">
                            <form method='get' action="<?php echo base_url() ?>search">
                                <div class="input-group my-group"> 

                                    <select class="form-control input-lg cat-select" name="category" id="txtcategory">
                                        <option value="all">All Categories</option>
                                        <?php
                                        if($main_cat->num_rows()>0) { $search_cat= '';
                                        foreach ($main_cat->result() as $r) {
                                        	
                                        		if($slang=='arabic'){
									$search_cat=$r->NameAr;
								}else{
									$search_cat= $r->Name;
						   }
                           $top_title = ucwords(str_replace("-",' ',$search_cat));
                                        	
                                        	
                                            ?>
                                            <option value="<?php echo $r->CategoryId ?>"><?php echo $top_title ?></option>
                                            <?php
                                        }
                                        }
                                        ?></select> 

                                    <input type="text" name="keyword" class="form-control input-lg frmSearch" id="srchfor" onkeyup="ajaxSearch();" placeholder="Search  for..">
                                    <span class="input-group-btn">

                                        <button type="submit" class="srchbtn" id="slctcategory"> <img src="<?php echo base_url(); ?>img/Search.png"  ></button>
                                    </span>
                                </div>
                            </form>
                        </div>
                        <div class="col-xs-12 col-sm-3 col-md-3 rating-rtl textcenter pl-lg-0"> <?php echo $html ?> 
                        
  <a class="localizationTool dropdown-toggle" type="button" data-toggle="dropdown" data-hover="dropdown">
  
   <span style="
    padding: 12px 0 12px 12px;
    border: 0;
    position: relative; "> (
   <?php 
   if($this->session->userdata('site_lang')){ echo  $this->lang->line($this->session->userdata('site_lang'));
   }else {
   	echo $this->lang->line('english');
   }
   
    ?> ) <span class="caret"></span> </span> 
  </a>
  <ul class="dropdown-menu pull-right">
  
  <?php
  foreach($existing_languages as $lang){
  
  ?>
  <li class="<?php if($this->session->userdata('site_lang')===$lang) {echo('active');	} ?>"
   ><a    href="<?php echo base_url(); ?>LanguageSwitcher/switchLang/<?php echo ($lang); ?>"><?php echo 
    $this->lang->line($lang);
    ?></a></li>
   <?php  } ?>
  
  
  
   
  </ul>

</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- start navbar -->
     
            <nav class="navbar navbar-default" role="navigation">
                <div class="container" >
                    <div class="navbar-header">

                        <button type="button" data-toggle="collapse" data-target="#navbar-collapse-3" class="navbar-toggle">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                    </div>
                    <div id="navbar-collapse-3" class="navbar-collapse collapse px-lg-0">
                        <ul class="nav navbar-nav  home_anc">
                            <li class="dropdown active">
                                <a href="<?php echo base_url(); ?>" ><img src="<?php echo base_url(); ?>img/menu-home.png"></a>
                            </li>
                            
                            
                            <?php
                            
                           
                           if($first_row->num_rows()>0) { $title_home ='';
                         
                           foreach ($first_row->result() as $r) {
                           
                          
                           	
                           	if($slang=='arabic'){
									$title_home=$r->NameAr;
								}else{
									$title_home= $r->Name;
						   }
                           $top_title = ucwords(str_replace("-",' ',$title_home));
						   $title = strtolower(str_replace(" ",'-',$r->Name));
						  
                           ?>
                                            
                            <li>
                                <a href="<?php echo base_url().$title ?>"  class="cat_anc caranc <?php if(strtolower($this->uri->segment(1))==strtolower($r->Name) ) echo 'active' ?>"><?php echo $top_title ?></a>
                            </li>
                                            
                                            
                                            
                            <?php }  }  ?>
                            <?php  if($more_row->num_rows()>0) {  ?> 
                            
                                  <li class="dropdown">
              <a href="#" class="dropdown-toggle cat_anc" data-toggle="dropdown">More <b class="caret"></b></a>
              <ul class="dropdown-menu">
                            <?php
                            
                            
                           $title_home ='';
                           $count =1;
                         
                           foreach ($more_row->result() as $r) {
                           
                           
                           	
                           	if($slang=='arabic'){
									$title_home=$r->NameAr;
								}else{
									$title_home= $r->Name;
						   }
                           $top_title = ucwords(str_replace("-",' ',$title_home));
						   $title = strtolower(str_replace(" ",'-',$r->Name)); ?>
                            
                            
                            
                <li>
                                <a href="<?php echo base_url().$title ?>"  class="cat_anc caranc"><?php echo $top_title ?></a>
                            </li>
             
                            
                             <?php }  ?> </ul>
            </li> <?php }  ?>
                            
                        </ul>
                        
                        
                        
                        
                        
                        
                        
                        
                        <ul class="nav navbar-nav">
                            <li class="lipadding">
                                <div class="dropdown11">
                                    <span><img class="avr" id="logged_user"  src="<?php echo $avatar ?>"></span>
                                    <?php echo $dropDown ?>
                                </div>
                            </li>
                            <li class="lipadding">
                                <img onclick="watchList()" id="img_watch" src="<?php echo base_url(); ?>img/menu-watchlist.png">
                                <sup>
                                    <a href="<?php echo $whref ?>">
                                        <span class="fa-stack fa-1x" id="watch_circle">
                                            <?php if (($this->session->userdata('logged_in')) && ($watchCount > 0)) { ?><i class="fa fa-circle fa-stack-2x icon-background2"></i>
                                                <span  class="fa fa-stack-1x tct"><?php echo $watchCount ?></span><?php } ?>
                                        </span>
                                    </a>
                                </sup>

                            </li>
                            <li class="lipadding">
                                <img onclick="cartList()" id="img_cart" src="<?php echo base_url(); ?>img/menu-cart.png">
                                <sup>
                                    <a href="<?php echo $chref ?>">
                                        <span class="fa-stack fa-1x" id="cart_circle">
                                            <?php if (($this->session->userdata('logged_in')) && ($cartCount > 0)) { ?><i class="fa fa-circle fa-stack-2x icon-background1"></i>
                                                <span  class="fa fa-stack-1x tct"><?php echo $cartCount ?></span><?php } ?>
                                        </span>
                                    </a>    
                                </sup>
                            </li>
                        </ul><!-- end navbar-nav -->
                    </div><!-- end navbar collapse -->
                </div>
            </nav>
            
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.8/jquery.lazy.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.8/jquery.lazy.plugins.min.js"></script>
              
<script type="text/javascript">

var isActive= <?php echo isset($_SESSION['logged_in']['isActive'])?$_SESSION['logged_in']['isActive']:0; ?>;
var isTrader= <?php echo isset($_SESSION['logged_in']['txtusertype'])?$_SESSION['logged_in']['txtusertype']:0; ?>;
var  whref = '<?php echo $whref ?>';
var chref = '<?php echo $chref ?>';
 $(function() {
        $('.lazy').Lazy();
		
		
		
    });	
	
</script>