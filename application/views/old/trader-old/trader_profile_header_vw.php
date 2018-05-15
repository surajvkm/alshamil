<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from diamondcreative.net/plus-v1.3.0/home-v4.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 07 Nov 2017 08:42:48 GMT -->
<head>
    <title>Test</title>
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
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css" />
    <link rel="stylesheet" type="text/css" href="css/owl.theme.default.min.css" />
    <link rel="stylesheet" type="text/css" href="css/animate.css" />
    <link rel="stylesheet" type="text/css" href="css/swiper.css" />
    <link rel="stylesheet" type="text/css" href="css/datepicker.css" />
      <!--script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script-->
    
    <!-- this is default skin you can replace that with: dark.css, yellow.css, red.css ect -->
    <link id="pagestyle" rel="stylesheet" type="text/css" href="css/default.css" />
    
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800&amp;subset=latin-ext" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

</head>
    <body>
        
        
        
        <div class="middleBar" >
            <div class="container">
                <div class="row display-table">
                    <div class="col-sm-3 vertical-align text-left hidden-xs">
                        <a href="javascript:void(0);">
                            <img width="160" id="als_logo" src="img/alshamil_logo.png" alt="" />
                        </a>
                    </div><!-- end col -->
                    <div class="col-sm-7 vertical-align text-center">
                        <form>
                            <div class="row grid-space-1">
                                
                                <div class="col-sm-3">
                                    <select class="form-control input-lg" name="category">
                                        <option value="all">All Categories</option>
                                        <optgroup label="Mens">
                                            <option value="shirts">Shirts</option>
                                            <option value="coats-jackets">Coats & Jackets</option>
                                            <option value="underwear">Underwear</option>
                                            <option value="sunglasses">Sunglasses</option>
                                            <option value="socks">Socks</option>
                                            <option value="belts">Belts</option>
                                        </optgroup>
                                        <optgroup label="Womens">
                                            <option value="bresses">Bresses</option>
                                            <option value="t-shirts">T-shirts</option>
                                            <option value="skirts">Skirts</option>
                                            <option value="jeans">Jeans</option>
                                            <option value="pullover">Pullover</option>
                                        </optgroup>
                                        <option value="kids">Kids</option>
                                        <option value="fashion">Fashion</option>
                                        <optgroup label="Sportwear">
                                            <option value="shoes">Shoes</option>
                                            <option value="bags">Bags</option>
                                            <option value="pants">Pants</option>
                                            <option value="swimwear">Swimwear</option>
                                            <option value="bicycles">Bicycles</option>
                                        </optgroup>
                                        <option value="bags">Bags</option>
                                        <option value="shoes">Shoes</option>
                                        <option value="hoseholds">HoseHolds</option>
                                        <optgroup label="Technology">
                                            <option value="tv">TV</option>
                                            <option value="camera">Camera</option>
                                            <option value="speakers">Speakers</option>
                                            <option value="mobile">Mobile</option>
                                            <option value="pc">PC</option>
                                        </optgroup>
                                    </select>
                                </div><!-- end col -->
								<div class="col-sm-6">
                                    <input type="text" name="keyword" class="form-control input-lg" id="srchfor" placeholder="Search  for..">
                                    
                                </div><!-- end col -->
                                <div class="col-sm-3">
                                    <button class="srchbtn"><i class="fa fa-search srch" aria-hidden="true" ></i></button>
                                </div>
                                <!--div >
								
								
				<button class="srchbtn"><i class="fa fa-search srch" aria-hidden="true" ></i></button>
								
                                  
                                </div--><!-- end col -->
                                
                            </div><!-- end row -->
                        </form>
                    </div><!-- end col -->
                    <div class="col-sm-2 vertical-align header-items hidden-xs" id="ancdiv">
                                             <a id="spsign" href="login">Sign In</a>
                                             <a id="spreg" href="register">Register</a>
                                              
                                              <label class="switch"><input type="checkbox" id="togBtn"><div class="slider round"></div></label>


                                        <div class="header-item">
                                           
                                            
                                        </div>
                                        
                                </div><!-- end col -->
                   
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
                        <img src="img/logo.png" alt="logo">
                    </a>
                </div>
                <div id="navbar-collapse-3" class="navbar-collapse collapse" >
                    <ul class="nav navbar-nav " >
                        <!-- Home -->
						 <li class="dropdown active"><i class="fa fa-home  hmicon" aria-hidden="true"></i></li>
                        <li><a href="#" id="caranch" data-toggle="dropdown" class="dropdown-toggle">CAR<i class="fa fa-angle-down ml-5"></i></a>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="home-v1.html">Home - Version 1</a></li>
                                <li><a href="home-v2.html">Home - Version 2</a></li>
                                <li><a href="home-v3.html">Home - Version 3</a></li>
                                <li class="active"><a href="home-v4.html">Home - Version 4 <span class="label primary-background">1.1</span></a></li>
                                <li><a href="home-v5.html">Home - Version 5 <span class="label primary-background">1.1</span></a></li>
                                <li><a href="home-v6.html">Home - Version 6 <span class="label primary-background">1.2</span></a></li>
                                <li><a href="home-v7.html">Home - Version 7 <span class="label primary-background">1.3</span></a></li>
                            </ul><!-- end ul dropdown-menu -->
                        </li><!-- end li dropdown -->    
                        <!-- Features -->
                        <li class="dropdown left"><a href="#" data-toggle="dropdown" class="dropdown-toggle">BIKE<i class="fa fa-angle-down ml-5"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="headers.html">Headers</a></li>
                                <li><a href="footers.html">Footers</a></li>
                                <li><a href="sliders.html">Sliders</a></li>
                                <li><a href="typography.html">Typography</a></li>
                                <li><a href="grid.html">Grid</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-submenu"><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">Dropdown Level 1</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Dropdown Level</a></li>
                                        <li class="dropdown-submenu"><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">Dropdown Level 2</a>
                                            <ul class="dropdown-menu">
                                                <li><a href="javascript:void(0);">Dropdown Level</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul><!-- end ul dropdown-menu -->
                        </li><!-- end li dropdown -->
                        <li class="dropdown left"><a href="#" data-toggle="dropdown" class="dropdown-toggle">NUMBER PLATE<i class="fa fa-angle-down ml-5"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="headers.html">Headers</a></li>
                                <li><a href="footers.html">Footers</a></li>
                                <li><a href="sliders.html">Sliders</a></li>
                                <li><a href="typography.html">Typography</a></li>
                                <li><a href="grid.html">Grid</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-submenu"><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">Dropdown Level 1</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Dropdown Level</a></li>
                                        <li class="dropdown-submenu"><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">Dropdown Level 2</a>
                                            <ul class="dropdown-menu">
                                                <li><a href="javascript:void(0);">Dropdown Level</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul><!-- end ul dropdown-menu -->
                        </li><!-- end li dropdown -->
                        <li class="dropdown left"><a href="#" data-toggle="dropdown" class="dropdown-toggle">VERTU<i class="fa fa-angle-down ml-5"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="headers.html">Headers</a></li>
                                <li><a href="footers.html">Footers</a></li>
                                <li><a href="sliders.html">Sliders</a></li>
                                <li><a href="typography.html">Typography</a></li>
                                <li><a href="grid.html">Grid</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-submenu"><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">Dropdown Level 1</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Dropdown Level</a></li>
                                        <li class="dropdown-submenu"><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">Dropdown Level 2</a>
                                            <ul class="dropdown-menu">
                                                <li><a href="javascript:void(0);">Dropdown Level</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul><!-- end ul dropdown-menu -->
                        </li><!-- end li dropdown -->
                        <li class="dropdown left"><a href="#" data-toggle="dropdown" class="dropdown-toggle">WATCH<i class="fa fa-angle-down ml-5"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="headers.html">Headers</a></li>
                                <li><a href="footers.html">Footers</a></li>
                                <li><a href="sliders.html">Sliders</a></li>
                                <li><a href="typography.html">Typography</a></li>
                                <li><a href="grid.html">Grid</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-submenu"><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">Dropdown Level 1</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Dropdown Level</a></li>
                                        <li class="dropdown-submenu"><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">Dropdown Level 2</a>
                                            <ul class="dropdown-menu">
                                                <li><a href="javascript:void(0);">Dropdown Level</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul><!-- end ul dropdown-menu -->
                        </li><!-- end li dropdown -->
                        <li class="dropdown left"><a href="#" data-toggle="dropdown" class="dropdown-toggle">MOBILE NUMBER<i class="fa fa-angle-down ml-5"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="headers.html">Headers</a></li>
                                <li><a href="footers.html">Footers</a></li>
                                <li><a href="sliders.html">Sliders</a></li>
                                <li><a href="typography.html">Typography</a></li>
                                <li><a href="grid.html">Grid</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-submenu"><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">Dropdown Level 1</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Dropdown Level</a></li>
                                        <li class="dropdown-submenu"><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">Dropdown Level 2</a>
                                            <ul class="dropdown-menu">
                                                <li><a href="javascript:void(0);">Dropdown Level</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul><!-- end ul dropdown-menu -->
                        </li><!-- end li dropdown -->
                        <li class="dropdown left"><a href="#" data-toggle="dropdown" class="dropdown-toggle">BOAT<i class="fa fa-angle-down ml-5"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="headers.html">Headers</a></li>
                                <li><a href="footers.html">Footers</a></li>
                                <li><a href="sliders.html">Sliders</a></li>
                                <li><a href="typography.html">Typography</a></li>
                                <li><a href="grid.html">Grid</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-submenu"><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">Dropdown Level 1</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Dropdown Level</a></li>
                                        <li class="dropdown-submenu"><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">Dropdown Level 2</a>
                                            <ul class="dropdown-menu">
                                                <li><a href="javascript:void(0);">Dropdown Level</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul><!-- end ul dropdown-menu -->
                        </li><!-- end li dropdown -->
                        <li class="dropdown left"><a href="#" data-toggle="dropdown" class="dropdown-toggle">IPHONE<i class="fa fa-angle-down ml-5"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="headers.html">Headers</a></li>
                                <li><a href="footers.html">Footers</a></li>
                                <li><a href="sliders.html">Sliders</a></li>
                                <li><a href="typography.html">Typography</a></li>
                                <li><a href="grid.html">Grid</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-submenu"><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">Dropdown Level 1</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Dropdown Level</a></li>
                                        <li class="dropdown-submenu"><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">Dropdown Level 2</a>
                                            <ul class="dropdown-menu">
                                                <li><a href="javascript:void(0);">Dropdown Level</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul><!-- end ul dropdown-menu -->
                        </li><!-- end li dropdown -->
                        <li class="dropdown left"><a href="#" data-toggle="dropdown" class="dropdown-toggle">OTHER<i class="fa fa-angle-down ml-5"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="headers.html">Headers</a></li>
                                <li><a href="footers.html">Footers</a></li>
                                <li><a href="sliders.html">Sliders</a></li>
                                <li><a href="typography.html">Typography</a></li>
                                <li><a href="grid.html">Grid</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-submenu"><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">Dropdown Level 1</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Dropdown Level</a></li>
                                        <li class="dropdown-submenu"><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">Dropdown Level 2</a>
                                            <ul class="dropdown-menu">
                                                <li><a href="javascript:void(0);">Dropdown Level</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul><!-- end ul dropdown-menu -->
                        </li><!-- end li dropdown -->
                        <!-- Pages -->
                     
                        
						<li>
                                                   
                                                      <img src="img/userProfileIcon_gray.png" style="width:10%;height:1%;">
                                                </li>
                                <li>
                                    <i class="fa fa-heart usricon2" aria-hidden="true"></i>
					<sup>
                                            <span class="fa-stack fa-1x">
                                                <i class="fa fa-circle fa-stack-2x icon-background1"></i>
                                                <span  class="fa fa-stack-1x tct">05</span>
                                            </span>
                                        </sup>	
                                </li>
                    
				
                                <li>
					   
                                    <i class="fa fa-shopping-cart usricon3"></i>
                                    <sup>
                                        <span class="fa-stack fa-1x">
                                        <i class="fa fa-circle fa-stack-2x icon-background2"></i>
                                        <span  class="fa fa-stack-1x tct">03</span>
                                        </span>
                                    </sup>

				</li>
                        
                            <!-- end dropdown-menu -->
                        </li><!-- end dropdown -->
                    </ul><!-- end navbar-nav -->
                    
                        </li><!-- end dropdown -->
                    </ul--><!-- end navbar-right -->
                </div><!-- end navbar collapse -->
            </div>
        </div>
        
       <?php //$this->view('admin/footer'); ?>

        
        <!-- JavaScript Files -->
        
        
        
        <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
       <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/owl.carousel.min.js"></script>
        <script type="text/javascript" src="js/jquery.downCount.js"></script>
        <script type="text/javascript" src="js/nouislider.min.js"></script>
        <script type="text/javascript" src="js/jquery.sticky.js"></script>
        <script type="text/javascript" src="js/pace.min.js"></script>
        <script type="text/javascript" src="js/star-rating.min.js"></script>
        <script type="text/javascript" src="js/wow.min.js"></script>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
        <script type="text/javascript" src="js/gmaps.js"></script>
        <script type="text/javascript" src="js/swiper.min.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
        <script type="text/javascript" src="js/jquery.maskedinput.min.js"></script>
                <script type="text/javascript" src="js/bootstrap-datepicker.js"></script>

        
    </body>

<!-- Mirrored from diamondcreative.net/plus-v1.3.0/home-v4.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 07 Nov 2017 08:42:48 GMT -->
</html>
<!--html lang="en">
<head>
<meta charset="utf-8">
<title>Alshamil Admin Portal</title>
</head>
<body>
 
<div id="container">
  <h1>Alshamil</h1>
  <p class="footer">All rights reserved.</p>
</div>
 
</body>
</html-->