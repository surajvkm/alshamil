<?php
if ($this->session->userdata('logged_in')) {
    $user_data  = $this->session->userdata('logged_in');
    $user_id    = $user_data['trader_id'];
    $user       = $this->Trader_mdl->getUser($user_id);
    $html = '';
}
else{
    $html = '<a id="spsign" href="'.base_url().'Trader/login_view">Sign In</a>
            <a id="spreg" href="'.base_url().'Trader/register">Register</a>
            <label class=""></label>
            <div class="header-item">
            </div>';
}

?>

<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">

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
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/owl.carousel.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/owl.theme.default.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/animate.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/swiper.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/datepicker.css" />
        <!--script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script-->

        <!-- this is default skin you can replace that with: dark.css, yellow.css, red.css ect -->
        <link id="pagestyle" rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/default.css" />

        <!-- Google fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800&amp;subset=latin-ext" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/font-awesome.css" />

    </head>
    <body>


<div class="container-fluid">
        <div class="middleBar">
            
                <div class="row display-table">
                    <div class="row">
                        <div class="col-sm-2 vertical-align text-left hidden-xs">
                            <a href="javascript:void(0);">
                                <img width="160" id="als_logo" src="<?php echo base_url(); ?>img/Logo.png" alt="" />
                            </a>
                        </div><!-- end col -->

                        <div class="col-sm-7 vertical-align text-center">
                            <form>
                                <div class="row grid-space-1">

                                    <div class="col-sm-3">
                                        <select class="form-control input-lg" name="category" id="txtcategory">
                                            <option value="all">All Categories</option>
                                            <option value="Car">Car</option>
                                            <option value="Bike">Bike</option>
                                            <option value="Number Plate">Number Plate</option>
                                            <option value="Vertu">Vertu</option>
                                            <option value="Watch">Watch</option>
                                            <option value="Mobile Number">Mobile Number</option>
                                            <option value="Boat">Boat</option>
                                            <option value="Phone">Phone</option>
                                            <option value="Properties">Properties</option>
                                        </select>
                                    </div><!-- end col -->
                                    <div class="col-sm-6">
                                        <div class="frmSearch">
                                            <input type="text" name="keyword" class="form-control input-lg" id="srchfor" onkeyup="ajaxSearch();" placeholder="Search  for..">

                                        </div>

                                    </div><!-- end col -->
                                    <div class="col-sm-3">
                                        <button type="button" class="srchbtn" id="slctcategory"> <img src="<?php echo base_url(); ?>img/Search.png"  ></button>
    <!--                                    <button class="srchbtn"><i class="fa fa-search srch" aria-hidden="true" ></i></button>-->
                                    </div>
                                </div><!-- end row -->
                            </form>
                        </div><!-- end col -->
                        <div class="col-sm-2 vertical-align header-items hidden-xs">
                            <?php echo $html ?>
<!--                            <a id="spsign" href="<?php echo base_url(); ?>Trader/login_view">Sign In</a>
                            <a id="spreg" href="<?php echo base_url(); ?>Trader/register">Register</a>
                            <label class=""></label>
                            <div class="header-item">
                            </div>-->
                        </div><!-- end col -->
                    </div>
                </div><!-- end  row -->
          
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
                        <img src="<?php echo base_url(); ?>img/Logo.png" alt="logo">
                    </a>
                </div>
                <div id="navbar-collapse-3" class="navbar-collapse collapse" >
                    <ul class="nav navbar-nav " >
                        <!-- Home -->
                        <li class="dropdown active"><a href="<?php echo base_url(); ?>Trader" id="home_anc"><img id="img_home" src="<?php echo base_url(); ?>img/menu-home.png"></a></li>
                        <li id="caranch"><a href="<?php echo base_url() ?>Trader/view_car_category"  >CAR</a>

                        </li><!-- end li dropdown -->    
                        <!-- Features -->
                        <li id="bikeanch"><a href="<?php echo base_url() ?>Trader/view_bike_category"  >BIKE</a>
                        </li>
                        <li id="noplateanc"><a href="<?php echo base_url() ?>Trader/noplate_category"  >NUMBER PLATE</a>

                        </li><!-- end li dropdown -->
                        <li id="veran"><a href="<?php echo base_url() ?>Trader/vertu_category"  >VERTU</a>

                        </li><!-- end li dropdown -->
                        <li id="watchan"><a href="<?php echo base_url() ?>Trader/watch_category"  >WATCH</a>

                        </li><!-- end li dropdown -->
                        <li id="mobanc"><a href="<?php echo base_url() ?>Trader/mobileno_category"  >MOBILE NUMBER</a>                     
                        </li><!-- end li dropdown -->
                        <li id="boatanc"><a href="<?php echo base_url() ?>Trader/view_boat_category"  >BOAT</a>

                        </li><!-- end li dropdown -->
                        <li id="ipanc"><a href="<?php echo base_url() ?>Trader/iphone_category" >PHONE</a>

                        </li><!-- end li dropdown -->
                        <li id="otheranc"><a href="<?php echo base_url() ?>Trader/view_property_category" >PROPERTIES</a>

                        </li><!-- end li dropdown -->
                        <!-- Pages -->

                        <li>
                            <img id="img_user" src="<?php echo base_url(); ?>img/menu-user.png">
                        </li>
                        <li>
                            <img id="img_watch" src="<?php echo base_url(); ?>img/menu-watchlist.png">
                            <sup>
                                <span class="fa-stack fa-1x" id="watch_circle">
                                    <i class="fa fa-circle fa-stack-2x icon-background2"></i>
                                    <?php
                                    if (isset($qry)) {
                                        foreach ($qry as $r)
                                            
                                            ?>
                                        <span  class="fa fa-stack-1x tct"><?php echo $r->watchlistCount ?></span>
                                        <?php
                                    } else {
                                        ?>
                                        <span  class="fa fa-stack-1x tct">0</span>
                                        <?php
                                    }
                                    ?>
                                </span>
                            </sup>
                        </li>
                        <li>
                            <img id="img_cart" src="<?php echo base_url(); ?>img/menu-cart.png">
                            <sup>
                                <span class="fa-stack fa-1x" id="cart_circle">
                                    <i class="fa fa-circle fa-stack-2x icon-background1"></i>
                                    <?php
                                    if (isset($qry)) {

                                        foreach ($qry as $r)
                                            
                                            ?>
                                        <span  class="fa fa-stack-1x tct"><?php echo $r->cartlistCount ?></span>
                                        <?php
                                    } else {
                                        ?>
                                        <span  class="fa fa-stack-1x tct">0</span>
                                        <?php
                                    }
                                    ?>

                                </span>
                            </sup>	
                        </li>
                    </ul><!-- end navbar-nav -->
                </div><!-- end navbar collapse -->
            </div>
        </div>

        <?php //$this->view('admin/footer');   ?>


        <!-- JavaScript Files -->



        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/owl.carousel.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/owl.carousel.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.downCount.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/nouislider.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.sticky.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/pace.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/star-rating.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/wow.min.js"></script>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/gmaps.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/swiper.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/main.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.maskedinput.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap-datepicker.js"></script>

        <script>
                                                $(document).ready(function () {


                                                    $('#slctcategory').click(function () {

                                                        var category = $('#txtcategory').val();
                                                        //alert(category);return false;
                                                        var data = 'category=' + category;
                                                        $.ajax({
                                                            url: "<?php echo base_url('Trader/select_category'); ?>",
                                                            data: data,
                                                            type: "POST",
                                                            success: function (data) {

//                        location.href="<?php echo base_url('Trader/view_car_category'); ?>"
//          console.log(data);return false;
                                                                $('#sub').css('display', 'none');
                                                                $('#car').append(data);
                                                            }

                                                        });
                                                    });

                                                });
                                                function ajaxSearch()
                                                {
                                                    var input_data = $('#srchfor').val();

                                                    if (input_data.length === 0)
                                                    {
                                                        $('#suggestions').hide();
                                                    } else
                                                    {
                                                        var post_data = {
                                                            'srchfor': input_data,
                                                        };
                                                        $.ajax({
                                                            type: "POST",
                                                            url: "<?php echo base_url(); ?>Trader/autocomplete/",
                                                            data: post_data,
                                                            success: function (data) {
                                                                // return success
                                                                if (data.length > 0) {
                                                                    $('#suggestions').show();
                                                                    $('#autoSuggestionsList').addClass('auto_list');
                                                                    $('#autoSuggestionsList').html(data);

                                                                }
                                                            }
                                                        });

                                                    }
                                                }

        </script> 
    </body>

</html>
