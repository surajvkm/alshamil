<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from diamondcreative.net/plus-v1.3.0/home-v4.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 07 Nov 2017 08:42:48 GMT -->
<head>
    <title>Alshamil</title>
    <meta charset="utf-8">
    <meta name="description" content="Plus E-Commerce Template">
    <meta http-equiv="refresh" content="300">
    <meta name="author" content="" />
    <meta name="keywords" content="plus, html5, css3, template, ecommerce, e-commerce, bootstrap, responsive, creative" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- ---------- Favicon ---------- -->
    <link rel="shortcut icon" href="<?php echo base_url();?>img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?php echo base_url();?>img/favicon.ico" type="image/x-icon">

    <!-- ---------- CSS files ---------- -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/owl.carousel.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/owl.theme.default.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/animate.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/swiper.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/datepicker.css" />

    <!--script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script-->

    <!-- this is default skin you can replace that with: dark.css, yellow.css, red.css ect -->
    <link id="pagestyle" rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/default.css" />

    <!-- ---------- Google fonts ---------- -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800&amp;subset=latin-ext" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/sweetalert.css" />
</head>

<body>
<?php
        $avatar= base_url().'img/menu-user.png';
if ($this->session->userdata('logged_in')) {
    
    $whref = base_url().'Trader/view_watch_list';
    $chref = base_url().'Trader/view_cart';
    
    $user_data  = $this->session->userdata('logged_in');
    $user_id    = $user_data['trader_id'];
    $avatar     = $this->Admin_mdl->getAvr($user_id);
   // $dropDown   = '<div class="dropdown-content">
                  //       <a href="'.base_url().'Trader/trader_profile">My Profile</a><br>
                  //       <a href="'.base_url().'Trader/logout">Logout</a>
                  // </div>';
    
    $user       = $this->Trader_mdl->getUser($user_id);
    $html = '<a href="'.base_url().'admin/logout"><button class="logOutButton">
                        <img src="http://alshamil.bluecast.ae/img/navbar/logout.png" alt="Logout">
                        <span class="font-lato">Logout</span>
                    </button></a>';

}
else{
  header('Location: '.base_url().'admin');
}
?>

    <div class="admin_navbar">
        <div class="col-sm-12">
            <div class="row">

                <!-- ------ Logo ------ -->
                <div class="col-sm-2">
                    <a href="javascript:void(0);">
                        <img width="160" class="admin_navbar-logo" src="<?php echo base_url();?>img/alshamil_logo.png" alt="Al-Shamil Logo" />
                    </a>
                </div>

                <!-- ------ Dropdown and Search Bar ------ -->
                <div class="col-sm-7">
                    <form class="w-100 pt-23" action="<?php echo base_url();?>admin/SearchController/listAll" method="get">
                        <div class="col-sm-3 pr-0">
                            <select class="form-control categoryBar font-lato" name="category" id="category">
                                <option value="all">All Categories</option>
                                <option value="1">Car</option>
                                <option value="2">Bike</option>
                                <option value="3">Number Plate</option>
                                <option value="4">Vertu</option>
                                <option value="5">Watch</option>
                                <option value="6">Mobile Number</option>
                                <option value="7">Boat</option>
                                <option value="8">Phone</option>
                                <option value="9">Properties</option>
                            </select>
                        </div>
                        <div class="col-sm-6 pl-0 pr-0 vbl">
                            <input type="text" name="keyword" class="form-control searchBar" id="srchfor" placeholder="Search  for..">
                        </div>
                        <div class="col-sm-1 col-sm-offset-1 p-0">
                            <button id="searchButton" class="searchButton" >
                                <img src="<?php echo base_url();?>img/navbar/search-icon.png" alt="">
                            </button>
                        </div>
                    </form>
                </div>

                <!-- ------ Date ------ -->
                <div class="col-sm-1 p-0 dateDiv mt-3">
                    <label class="font-size-13 text-bold font-lato">Date</label>
                    <p class="mb-0 text-bold text-lightBlack"><?=date(" j M Y");  ?></p>
                </div>

                <!-- ------ Time ------ -->
                <div class="col-sm-1 timeDiv mt-3">
                    <label class="font-size-13 text-bold font-lato">Time</label>
                    <p class="mb-0 text-bold text-lightBlack" id="LATime"></p>   
                </div>

                <!-- ------ Logout Button ------ -->
                <div class="col-sm-1 text-center p-0">
                    <?php echo $html ?>
                   <!--  <button class="logOutButton">
                        <img src="<?php echo base_url();?>img/navbar/logout.png" alt="Logout">
                        <span class="font-lato">Logout</span>
                    </button> -->
                </div>
            </div>
        </div>
    </div>
    <!-- admin_navbar ends here -->
</body>
</html>