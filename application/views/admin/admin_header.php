<?php defined('BASEPATH') OR exit('No direct script access allowed');?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- -------- Icon -------- -->
    <link rel="icon" type="image/x-icon" href="<?php echo base_url();?>/assets/favicon.ico">

    <!-- -------- Title -------- -->
    <title>Al-Shamil</title>

    <!-- -------- Bootstrap CSS -------- -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap-4.min.css" />

      <!--  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/sb-admin.css" rel="stylesheet"> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/sweetalert.css" />
    <!-- -------- Custom CSS -------- -->
    <!-- For global styles -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/styles.css">
    <!-- For Sidebar and Navbar -->
  
    <!--
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/owl.carousel.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/owl.theme.default.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/animate.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/swiper.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/datepicker.css" /> 


    <link id="pagestyle" rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/default.css" />
-->

    <!--script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script-->

    <!-- this is default skin you can replace that with: dark.css, yellow.css, red.css ect -->

    <!-- ---------- Google fonts ---------- -->
  <!--  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800&amp;subset=latin-ext" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/sweetalert.css" /> -->
    <script>
var Settings={baseurl:"<?php echo base_url() ?>"};
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap-4.min.js"></script>

</head>

<body>
    
<?php
        $avatar= base_url().'img/menu-user.png';
if ($this->session->userdata('admin_logged_in')) {
    
    $whref = base_url().'Trader/view_watch_list';
    $chref = base_url().'Trader/view_cart';
    
    $user_data  = $this->session->userdata('admin_logged_in');
    $user_id    = $user_data['trader_id'];
    $avatar     = $this->view->getAvr($user_id);
   // $dropDown   = '<div class="dropdown-content">
                  //       <a href="'.base_url().'Trader/trader_profile">My Profile</a><br>
                  //       <a href="'.base_url().'Trader/logout">Logout</a>
                  // </div>';
    
    $user       = $this->view->getUser($user_id);
    $html = '<a href="'.base_url().'admin/logout">      <button class="btn btn-logout pl-lg-2 pr-lg-2">
    <img src="'.base_url().'/assets/navbar/Logout.png" alt=""> Logout
</button></a>';

}
else{
  header('Location: '.base_url().'admin');
}

$main_cat = $this->View_Model->get_parent_category();
?>

    <!-- ------------------------- NAVBAR starts ------------------------- -->
    <nav class="navbar navbar-expand-md trader-navbar navbar-light p-md-3 p-1">

        <!-- ------- Logo ------- -->
        <a class="navbar-brand" href="#">
        <img class="logo" src="<?php echo base_url();?>img/alshamil_logo.png" alt="">
        </a>

        <!-- ------- Toggle Button (sm) ------- -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapseContent" aria-haspopup="true"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- ------- The Content inside Navbar(for all screens except sm) / toggle button (sm) ------- -->
        <div class="collapse navbar-collapse" id="navbarCollapseContent">

            <div class="col-lg-12 col-md-12 col-12 pt-sm-3 pt-md-2 pt-lg-0">
                <!-- Navbar List -->
                <ul class="list-unstyled m-0">
                    <div class="row">

                        <!-- Forms -->
                        <div class="col-lg-6 col-md-6 col-sm-6 pl-md-2 pl-lg-3">
                            <li>
                                <!-- Search form starts here -->
                                <form  action="<?php echo base_url();?>admin/listAll" method='get'>
                                    <div class="form-group form_large pt-4 pb-2 pt-lg-2 pt-sm-0">
                                        <div class="row">
                                            <div class="col-lg-11 col-md-10 col-sm-10 col-10 pl-sm-0 pl-md-0 pl-lg-3 pr-0">
                                                <div class="input-group">

                                                    <!-- Dropdown -->
                                                    <div class="input-group-prepend">
                                                        <select class="form-control navbar-dropdown" name='category'>
                                                            <option value="all" data-default>All Categories</option>
                                                             <?php
                                       					 if($main_cat->num_rows()>0) {
                                        foreach ($main_cat->result() as $r) {
                                        	
                                        	$main_title = ucwords(str_replace(" ",' ',rtrim($r->Name)));
                                        	
                                        	
                                            ?>
                                            <option value="<?php echo $r->CategoryId ?>"><?php echo $main_title ?></option>
                                            <?php
                                        }
                                        }
                                        ?>    
                                                            
                                                            
                                                            
                                                            
                                                                    </select>
                                                    </div>

                                                    <!-- SearchBar -->
                                                    <input type="text"name="keyword"   class="form-control searchBar" placeholder="Search for...">
                                                </div>
                                            </div>

                                            <!-- Search Button -->
                                            <div class="col-lg-1 col-md-2 col-sm-2 col-2 pl-0 pr-0">
                                                <button class="btn btn-search">
                                                    <img class="searchIcon" src="<?php echo base_url();?>/assets/navbar/Search.png" alt="">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- /.search ends here -->
                            </li>
                        </div>
                        <!-- /.forms -->

                        <!-- Date -->
                        <div class="col-lg-2 col-md-2 col-sm-2 col-4 datetime_large px-0 pl-sm-3 pr-sm-0 pr-md-0 pr-lg-3 pl-lg-4 pl-md-2 lineheight-2">
                            <li class="pl-lg-2">
                                <p class="mb-0 text-label d-none d-sm-block">Date</p>
                                <p class="mb-0 text-data"><?=date(" j M Y");  ?></p>
                            </li>
                        </div>

                        <!-- Time -->
                        <div class="col-lg-2 col-md-2 col-sm-2 col-4 datetime_large pr-md-0 pr-lg-3 pl-md-2 pl-lg-3 pr-0 pl-0 text-right text-sm-left text-md-left lineheight-2">
                            <li>
                                <p class="mb-0 text-label d-none d-sm-block">Time</p>

                        <p class="mb-0 text-data" id="time"></p>
                            </li>
                        </div>

                        <!-- Logout -->
                        <div class="col-lg-2 col-md-2 col-sm-2 col-4 btn_large text-center pr-0 pl-0 px-sm-0 px-md-1 px-lg-3 mb-2">
                            <li>
                            <?php echo $html ?>
                               
                            </li>
                        </div>
                    </div>
                </ul>
                <!-- /.navbar list -->
            </div>
 <div class="col-sideNav d-block d-md-none">
                <div class="col-lg-12 bg-darkgray h-auto">
                    <div class="row bg-darkgray">

                        <!-- ---------- AddPost Button ---------- -->
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-10 mx-auto py-4 px-lg-0">
                                    <a href="<?php echo base_url()?>admin/Dashboard/admin_add_post">
                                        <button type="button" class="btn btn-addpost">Add Post</button>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- ---------- Lists starts here ---------- -->
                        <div class="col-lg-12 pt-lg-2 px-lg-0">
                            <ul class="sidebar-menu list-unstyled">

                                <!-------- Home ------ -->
                                <li class="sideListItem">
                                    <div class="col-lg-10 mx-auto p-0">

                                        <a class="text-white text-s15 d-block" href="<?php echo base_url()?>admin/Dashboard/admin_home">Home</a>
                                        <hr class="mt-2 sidebar-hr">
                                    </div>
                                </li>

                                <!-- ------ Dashboard ------ -->
                                <li class="sideListItem">
                                    <div class="col-lg-10 mx-auto p-0">
                                        <a class="text-white text-s15 d-block" href="<?php echo base_url()?>admin/Dashboard">Dashboard</a>
                                        <hr class="mt-2 sidebar-hr">
                                    </div>
                                </li>

                                <!-- ------ New post ------ -->
                                <li class="sideListItem">
                                    <div class="col-lg-10 mx-auto p-0">
                                        <a class="text-white text-s15 d-block" href="<?php echo base_url()?>admin/Dashboard/admin_new_post">New post
                                            <span class="text-s15 text-semibold text-yellow float-right">   <?php
            if(isset($sidebar_count['new_post'])) {
              echo $sidebar_count['new_post'];
            }?></span>
                                        </a>
                                        <hr class="mt-2 sidebar-hr">
                                    </div>
                                </li>

                                <!-- ------ New Registers ------ -->
                                <li class="sideListItem">
                                    <div class="col-lg-10 mx-auto p-0">
                                        <a class="text-white text-s15 d-block"  href="<?php echo base_url()?>admin/Dashboard/new_registers"> New Registers
                                            <span class="text-s15 text-yellow text-semibold float-right">  <?php
            if(isset($sidebar_count['new_reg'])) {
              echo $sidebar_count['new_reg'];
            }?></span>
                                        </a>
                                        <hr class="mt-2 sidebar-hr">
                                    </div>
                                </li>

                                <!-- ------Yearly Plan ------ -->
                                <li class="sideListItem">
                                    <div class="col-lg-10 mx-auto p-0">
                                        <a class="text-white text-s15 d-block" href="<?php echo base_url()?>admin/Dashboard/view_plan/1">Yearly Plan
                                            <span class="text-s15 text-yellow text-semibold float-right">   <?php
            if(isset($sidebar_count['yearly_plan_count'])) {
              echo $sidebar_count['yearly_plan_count'];
            }?></span>
                                        </a>
                                        <hr class="mt-2 sidebar-hr">
                                    </div>
                                </li>

                                <!-- ------ Monthly Plan ------ -->
                                <li class="sideListItem">
                                    <div class="col-lg-10 mx-auto p-0">
                                        <a class="text-white text-s15 d-block" href="<?php echo base_url()?>admin/Dashboard/view_plan/2">Monthly Plan
                                            <span class="text-s15 text-yellow text-semibold float-right">   <?php
            if(isset($sidebar_count['monthly_plan_count'])) {
              echo $sidebar_count['monthly_plan_count'];
            }?></span>
                                        </a>
                                        <hr class="mt-2 sidebar-hr">
                                    </div>
                                </li>

                                <!-- ------ Yearly Limited Plan ------ -->
                                <li class="sideListItem">
                                    <div class="col-lg-10 mx-auto p-0">
                                        <a class="text-white text-s15 d-block" href="<?php echo base_url()?>admin/Dashboard/view_plan/3">Yearly Limited Plan
                                            <span class="text-s15 text-yellow text-semibold float-right">    <?php
            if(isset($sidebar_count['yearly_limit_count'])) {
              echo $sidebar_count['yearly_limit_count'];
            }?></span>
                                        </a>
                                        <hr class="mt-2 sidebar-hr">
                                    </div>
                                </li>

                                <!-- ------Individuals------ -->
                                <li class="sideListItem">
                                    <div class="col-lg-10 mx-auto p-0">
                                        <a class="text-white text-s15 d-block" href="<?php echo base_url()?>admin/Dashboard/view_plan/4">Individuals
                                            <span class="text-s15 text-yellow text-semibold float-right">     <?php
            if(isset($sidebar_count['iniv_limit_count'])) {
              echo $sidebar_count['iniv_limit_count'];
            }?></span>
                                        </a>
                                        <hr class="mt-2 sidebar-hr">
                                    </div>
                                </li>

                                <!-- ------ Watch List------ -->
                                <li class="sideListItem">
                                    <div class="col-lg-10 mx-auto p-0">
                                        <a class="text-white text-s15 d-block" href="<?php echo base_url()?>admin/Dashboard/admin_watch_list">Watch List
                                            <span class="text-s15 text-yellow text-semibold float-right">    <?php
            if(isset($sidebar_count['watchlist'])) {
              echo $sidebar_count['watchlist'];
            }?></span>
                                        </a>
                                        <hr class="mt-2 sidebar-hr">
                                    </div>
                                </li>

                                <!-- ------ Flagged ------ -->
                                <li class="sideListItem">
                                    <div class="col-lg-10 mx-auto p-0">
                                        <a class="text-white text-s15 d-block" href="<?php echo base_url()?>admin/Dashboard/admin_flaged_list">Flagged
                                            <span class="text-s15 text-yellow text-semibold float-right"><?php
            if(isset($sidebar_count['flaged'])) {
              echo $sidebar_count['flaged'];
            }?></span>
                                        </a>
                                        <hr class="mt-2 sidebar-hr">
                                    </div>
                                </li>

                                <!-- ------ All Categories ------ -->
                                <li class="sideListItem">
                                    <div class="col-lg-10 mx-auto p-0">
                                        <a class="text-white text-s15 d-block collapsed" data-toggle="collapse" href="#collapse-example2">All Categories
                                            <img class="float-right sidebar-icon" src="<?php echo base_url()?>assets/sidebar/up-arrow (1).png">
                                        </a>
                                    </div>
                                </li>

                                <!-- ------ Sublist : All Categories ------ -->
                                <ul class="collapse list-unstyled" id="collapse-example2">
                                    <div class="col-lg-10 mx-auto p-0">
                                        <hr class="mt-2 sidebar-hr">
                                    </div>

                                    <!-- ------ Car ------ -->
                                    <li class="sideListItem">
                                        <div class="col-lg-10 mx-auto p-0">
                                            <a class="text-white text-s15" href="<?php echo base_url()?>admin/SearchController/listAll?category=car" >Car</a>
                                            <hr class="mt-2 sidebar-hr">
                                        </div>
                                    </li>

                                    <!-- ------ Bike ------ -->
                                    <li class="sideListItem">
                                        <div class="col-lg-10 mx-auto p-0">
                                            <a class="text-white text-s15" href="<?php echo base_url()?>admin/SearchController/listAll?category=bike">Bike</a>
                                            <hr class="mt-2 sidebar-hr">
                                        </div>
                                    </li>

                                    <!-- ------ Number Plate------ -->
                                    <li class="sideListItem">
                                        <div class="col-lg-10 mx-auto p-0">
                                            <a class="text-white text-s15" href="<?php echo base_url()?>admin/SearchController/listAll?category=No. Plate"  >Number Plate</a>
                                            <hr class="mt-2 sidebar-hr">
                                        </div>
                                    </li>

                                    <!-- ------ Vertu------ -->
                                    <li class="sideListItem">
                                        <div class="col-lg-10 mx-auto p-0">
                                            <a class="text-white text-s15" href="<?php echo base_url()?>admin/SearchController/listAll?category=vertu">Vertu</a>
                                            <hr class="mt-2 sidebar-hr">
                                        </div>
                                    </li>

                                    <!-- ------ Watch -- ------>
                                    <li class="sideListItem">
                                        <div class="col-lg-10 mx-auto p-0">
                                            <a class="text-white text-s15" href="<?php echo base_url()?>admin/SearchController/listAll?category=watch">Watch</a>
                                            <hr class="mt-2 sidebar-hr">
                                        </div>
                                    </li>

                                    <!-- ------ Mobile Number -- ------>
                                    <li class="sideListItem">
                                        <div class="col-lg-10 mx-auto p-0">
                                            <a class="text-white text-s15" href="<?php echo base_url()?>admin/SearchController/listAll?category=Mob. No." >Mobile Number</a>
                                            <hr class="mt-2 sidebar-hr">
                                        </div>
                                    </li>

                                    <!-- ------ Boat ------ -->
                                    <li class="sideListItem">
                                        <div class="col-lg-10 mx-auto p-0">
                                            <a class="text-white text-s15" href="<?php echo base_url()?>admin/SearchController/listAll?category=boat">Boat</a>
                                            <hr class="mt-2 sidebar-hr">
                                        </div>
                                    </li>

                                    <!-- ------ Phone ------ -->
                                    <li class="sideListItem">
                                        <div class="col-lg-10 mx-auto p-0">
                                            <a class="text-white text-s15" href="<?php echo base_url()?>admin/SearchController/listAll?category=phone">Phone</a>
                                            <hr class="mt-2 sidebar-hr">
                                        </div>
                                    </li>

                                    <!-- ------ Properties ------ -->
                                    <li class="sideListItem">
                                        <div class="col-lg-10 mx-auto p-0">
                                            <a class="text-white text-s15" href="<?php echo base_url()?>admin/SearchController/listAll?category=properties" >Properties</a>
                                            <hr class="mt-2 sidebar-hr">
                                        </div>
                                    </li>
                                </ul>
                                <!-- /.Sublist -->
                            </ul>
                        </div>
                        <!-- ---------- Lists ends here ---------- -->
                    </div>
                </div>
            </div>
          
        </div>
        <!-- /.contents -->
    </nav>
    <!-- ------------------------- NAVBAR ends ------------------------- -->

 
    <!-- admin_navbar ends here -->
  
