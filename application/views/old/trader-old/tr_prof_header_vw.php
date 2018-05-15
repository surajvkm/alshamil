<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from diamondcreative.net/plus-v1.3.0/home-v4.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 07 Nov 2017 08:42:48 GMT -->
<head>
    <title>Alshamil</title>
    <meta charset="utf-8">
    <meta name="description" content="Plus E-Commerce Template">
    <meta name="author" content="Diamant Gjota" />
    <meta name="keywords" content="plus, html5, css3, template, ecommerce, e-commerce, bootstrap, responsive, creative" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	
    <!--Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    
    <!-- css files -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/owl.carousel.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/owl.theme.default.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/animate.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/swiper.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/sweetalert.css" />
      <!--script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script-->
    
    <!-- this is default skin you can replace that with: dark.css, yellow.css, red.css ect -->
    <link id="pagestyle" rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/default.css" />
    
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800&amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/font-awesome.css" />

</head>
    <body>
        
        
        
        <div class="middleBar" >
            <div class="container">
                <div class="row display-table">
                    <div class="col-sm-3 vertical-align text-left hidden-xs">
                        <a href="javascript:void(0);">
                            <img width="160" id="als_logo" src="<?php echo base_url();?>img/Logo.png" alt="" />
                        </a>
                    </div><!-- end col -->
                    <div class="col-sm-7 vertical-align text-center">
                        <form>
                            <div class="row grid-space-1">
                                
                                <div class="col-sm-3">
<!--                                    <select class="form-control input-lg" name="category" id="category_txt">-->
                                     <select class="form-control input-lg" name="category" id="txtcategory">
                                  <option value="all">All Categories</option>
                                            <option value="car">Car</option>
                                            <option value="bike">Bike</option>
                                            <option value="numberplate">Number Plate</option>
                                            <option value="vertu">Vertu</option>
                                            <option value="watch">Watch</option>
                                            <option value="mobilenumber">Mobile Number</option>
                                            <option value="boat">Boat</option>
                                            <option value="phone">phone</option>
                                            <option value="properties">Properties</option>
                                    </select>
                                </div><!-- end col -->
								<div class="col-sm-6">
                                    <input type="text" name="keyword" class="form-control input-lg" id="srchfor" placeholder="Search  for..">
                                    
                                </div><!-- end col -->
                                <div class="col-sm-3">
                                    <button class="srchbtn"><img src="<?php echo base_url();?>img/Search.png"  ></button>
                                </div>
                                <!--div >
								
								
				
								
                                  
                                </div--><!-- end col -->
                                
                            </div><!-- end row -->
                        </form>
                    </div><!-- end col -->
                    <div class="col-sm-2 vertical-align header-items hidden-xs" id="ancdiv">
                        <img src="<?php echo base_url();?>img/profile-add-post.png" id="tr_prof_plus_square" >
<!--                            <button type="button" onClick="location.href='add_post'" id="tr_prof_btn" class="btn btn-default">Add Post</button>-->
                        <input type="hidden" id="hid_txtutype" value="<?php echo $_SESSION['logged_in']['txtusertype'] ?>">
                        <input type="hidden" id="hid_txtuimg" value="<?php echo $_SESSION['logged_in']['txtprofimg'] ?>">
                                          <button type="button"  id="tr_prof_btn" class="btn btn-default">Add Post</button>
                                                                                   
                                          <label class="tr_switch" id="lang_switch"><input type="checkbox" id="togBtn"><div class="slider round"></div></label>


                                        <div class="header-item">
                                           
                                            
                                        </div>
                                        
                                </div><!-- end col -->
<!--                    <span id="err_trader_postadd" >You must become a trader to add post</span>-->
                </div><!-- end  row -->
            </div><!-- end container -->
        </div><!-- end middleBar -->
        
        <!-- start navbar -->
        <div id="navdiv">
             <div class="container condiv" >
                <div class="navbar-header">
                    <button type="button" data-toggle="collapse" data-target="#navbar-collapse-3" class="navbar-toggle">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="javascript:void(0);" class="navbar-brand visible-xs">
                        <img src="<?php echo base_url();?>img/logo.png" alt="logo">
                    </a>
                </div>
                <div id="navbar-collapse-3" class="navbar-collapse collapse" >
                    <ul class="nav navbar-nav " >
                        <!-- Home -->
                        <li class="dropdown active"><a href="<?php echo base_url();?>Trader" id="home_anc"><img id="img_home" src="<?php echo base_url();?>img/menu-home.png"></a></li>
                        <li id="caranch"><a href="<?php echo base_url()?>Trader/view_car_category"  >CAR</a>
                            
                        </li><!-- end li dropdown -->    
                        <!-- Features -->
                     <li id="bikeanch"><a href="<?php echo base_url()?>Trader/view_bike_category"  >BIKE</a>
                     </li>
                         <li id="noplateanc"><a href="<?php echo base_url()?>Trader/noplate_category"  >NUMBER PLATE</a>
                       
                        </li><!-- end li dropdown -->
                       <li id="veran"><a href="<?php echo base_url()?>Trader/vertu_category"  >VERTU</a>
                      
                        </li><!-- end li dropdown -->
                        <li id="watchan"><a href="<?php echo base_url()?>Trader/watch_category"  >WATCH</a>
                    
                        </li><!-- end li dropdown -->
                        <li id="mobanc"><a href="<?php echo base_url()?>Trader/mobileno_category"  >MOBILE NUMBER</a>                     
                        </li><!-- end li dropdown -->
                      <li id="boatanc"><a href="<?php echo base_url()?>Trader/view_boat_category"  >BOAT</a>
                  
                        </li><!-- end li dropdown -->
                        <li id="ipanc"><a href="<?php echo base_url()?>Trader/iphone_category" >PHONE</a>
               
                        </li><!-- end li dropdown -->
                        <li id="otheranc"><a href="<?php echo base_url()?>Trader/view_property_category" >PROPERTIES</a>
               
                        </li><!-- end li dropdown -->
                        <!-- Pages -->
                     
                        <li>
                            <div class="dropdown11">
                              
                               <?php
                               if(isset($_SESSION['logged_in']['txtprofimg']))
                               {
                                   ?>
                               <img id="logged_user" style="width:46px;height:46px;margin-top:-1%;position:relative;left:120px;border-radius: 23px;border: 2px solid #d8d8d8;
" src="<?php echo $_SESSION['logged_in']['txtprofimg']?>">
                                  <?php
                               }
                               else
                                {
                                   ?>
                                 <img id="img_user" src="<?php echo base_url();?>img/menu-user.png">
                                 <?php
 
                                }
                               ?>
                                                    &nbsp;&nbsp;
                                                    <div class="dropdown-content">
                                                        <a href="<?php echo base_url()?>Trader/trader_profile">My Profile</a><br>
                                                        <a href="<?php echo base_url()?>Trader/logout">Logout</a>
                                                  </div>
                            </div>
                            
                        </li>
                        <li>
                            <img id="img_watch" src="<?php echo base_url();?>img/menu-watchlist.png">
                            <sup>
                                        <span class="fa-stack fa-1x" id="watch_circle">
                                        <i class="fa fa-circle fa-stack-2x icon-background2"></i>
                                        <?php
                                                if($watch_qry[0]->watchlistCount)
                                                {
                                                    
                                                   
                                                       ?>
                                                    <span  class="fa fa-stack-1x tct"><?php echo $watch_qry[0]->watchlistCount?></span>
                                                    <?php
                                                }
                                              else
                                              {
                                                  ?>
                                                  <span  class="fa fa-stack-1x tct">0</span>
                                                  <?php
                                              }
                                              ?>
<!--                                        <span  class="fa fa-stack-1x tct">03</span>
                                        </span>-->
                                    </sup>
                        </li>
                         <li>
                             <img id="img_cart" src="<?php echo base_url();?>img/menu-cart.png">
                             <sup>
                                            <span class="fa-stack fa-1x" id="cart_circle">
                                                <i class="fa fa-circle fa-stack-2x icon-background1"></i>
                                                <?php
                                                if($cart_qry[0]->cartlistCount != '')
                                                {
                                                  ?>  
                                                   
                                                    <span  class="fa fa-stack-1x tct"><?php echo $cart_qry[0]->cartlistCount?></span>
                                                    <?php
                                                }
                                              else
                                              {
                                                  ?>
                                                  <span  class="fa fa-stack-1x tct">0</span>
                                                  <?php
                                              }
                                              ?>
                                                
                                            </span>
                                        </sup>	
                         </li>

				
<!--                                <li>
					   
                                    <i class="fa fa-shopping-cart usricon3"></i>
                                    

				</li>-->
                        
                            <!-- end dropdown-menu -->
                        </li><!-- end dropdown -->
                    </ul><!-- end navbar-nav -->
                    
                        </li><!-- end dropdown -->
                    </ul--><!-- end navbar-right -->
                </div><!-- end navbar collapse -->
            </div>
        </div>
        
      

        
        <!-- JavaScript Files -->
        
        
        
     <script type="text/javascript" src="<?php echo base_url();?>js/jquery-3.1.1.min.js"></script>
       <script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/owl.carousel.min.js"></script>
         <script type="text/javascript" src="<?php echo base_url();?>js/owl.carousel.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/jquery.downCount.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/nouislider.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/jquery.sticky.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/pace.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/star-rating.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/wow.min.js"></script>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/gmaps.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/swiper.min.js"></script>
        <script type="text/javascript" src="<?php  echo base_url();?>js/main.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/jquery.maskedinput.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/bootstrap-datepicker.js"></script>
         <script type="text/javascript" src="<?php echo base_url();?>js/sweetalert.min.js"></script>
         
         <script>
             $(document).ready(function(){
                 $('#tr_prof_btn').click(function(){
                     var user_type = $('#hid_txtutype').val();
                     if(user_type == '1')
                     {
                         location.href='add_post';
                     }
                     else
                     {
                         swal("You must become a trader to add post");
                     }
                 });
             });
             
             </script>