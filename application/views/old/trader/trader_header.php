<?php

$cartCount = 0;
$watchCount = 0;
$dropDown = '';
$whref = base_url() . 'Trader/login_view';
$chref = base_url() . 'Trader/login_view';
$avatar = base_url() . 'img/menu-user.png';
$cat_qry = $this->Trader_mdl->get_categories();
if ($this->session->userdata('logged_in')) {
    $cartCount = count($this->Trader_mdl->cart_details());
    $watchCount = $this->Trader_mdl->watchCount();

    $whref = base_url() . 'Trader/view_watch_list';
    $chref = base_url() . 'Trader/view_cart';

    $user_data = $this->session->userdata('logged_in');
    $user_id = $user_data['trader_id'];
    $user_type = $user_data['txtusertype'];
    $avatar = $this->Trader_mdl->getAvr($user_id);
    if ($user_type == '1') {
        $dropDown = '<div class="dropdown-content">
                        <a href="' . base_url() . 'Trader/trader_profile">My Profile</a><br>
                        <a href="' . base_url() . 'Trader/logout">Logout</a>
                  </div>';
    } else {
        $dropDown = '<div class="dropdown-content">
                      
                        <a href="' . base_url() . 'Trader/logout">Logout</a>
                  </div>';
    }
    $user = $this->Trader_mdl->getUser($user_id);
    $html = '<a onclick="check_add_post2()"><button type="button"  id="tr_prof_btn" class="btn btn-default">'
            . '<img  src="' . base_url() . 'img/profile-add-post.png" id="tr_prof_plus_square"> Add Post</button></a>'
            . '<a id="spsign" href="' . base_url() . 'Trader/logout"></a> <div id="widget" class="localizationTool"></div>';
} else {
    $html = ''
            . '<a id="spsign" href="' . base_url() . 'Trader/login_view">Sign In</a>
            <a id="spreg">Register</a>
            <div id="widget" class="localizationTool"></div>         
            <div class="header-item">
            </div>';
}
?>

<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>

<html lang="en">

    <head>
        <title>Alshamil</title>
        <meta charset="utf-8">
        <meta name="description" content="Alshamil">
        <meta name="author" content="Alshamil Online" />
        <meta name="keywords" content="plus, html5, css3, template, ecommerce, e-commerce, bootstrap, responsive, creative" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!--Favicon-->
        <link rel="shortcut icon" href="<?php echo base_url() ?>img/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo base_url() ?>img/favicon.ico" type="image/x-icon">

        <!-- css files -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/trader/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/trader/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/trader/owl.carousel.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/trader/owl.theme.default.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/trader/animate.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/trader/swiper.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/trader/datepicker.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/trader/sweetalert.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/trader/intlTelInput.css" />

        <!--script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script-->

        <!-- this is default skin you can replace that with: dark.css, yellow.css, red.css ect -->
        <link id="pagestyle" rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/trader/default.css" />

        <!-- Google fonts -->
        <!--link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800&amp;subset=latin-ext" rel="stylesheet"-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/trader/font-awesome.css" />


        <!--        Slider-->
       
     


        <link rel="stylesheet" href="<?php echo base_url(); ?>js/local/jquery.localizationTool.css">
        <!--     End   Slider-->
        <style>
        .localizationTool {
    color: #f58021;
    background: none; 
    position: relative;
    width:110px;
    display: inline-block;
}
        .localizationTool ul {
   
    z-index: 9999;
}
.localizationTool .ltool-dropdown-label .ltool-language-name {
    color: #504d4d;
}
.localizationTool .ltool-dropdown-label-arrow {
    content: '';
    display: block;
    width: 0;
    height: 0;
    /* border-top: 10px solid #deedf7; */
border:none;
    position: absolute;
    right: 8px;
    top: 17px;
}.localizationTool .ltool-is-visible .ltool-dropdown-label-arrow{
    content: '';
    display: block;
    width: 0;
    height: 0;
    /* border-top: 10px solid #deedf7; */
border:none;
    position: absolute;
    right: 8px;
    top: 17px;
}
</style>
       
    </head>
    <body>
   <!--  <div id="selectLanguageDropdown" class="localizationTool">
    
    <ul class="ltool-dropdown-items">
    <li class="ltool-language ar_TN">
    <span class="ltool-language-countryname"> 
    <span class="ltool-has-country ltool-language-name">(Arabic)</span>
    </span></li>
    <li class="ltool-language en_GB">
    <span class="ltool-language-countryname"> 
    <span class="ltool-has-country ltool-language-name">(English)</span>
    </span></li></ul>
    </div> -->
    
        <div class="container-fluid headerBar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 px-0">
                        <div class="col-xs-12 col-sm-2 col-md-3 col-lg-3 px-0 textcenter">
                            <a href="<?php echo base_url() ?>Trader">
                                <img class="als_logo" src="<?php echo base_url(); ?>img/Logo.png" alt="" />
                            </a>
                        </div><!-- end col -->
                    
                        <div class="col-xs-12 col-sm-7 col-md-6 col-lg-6 paddingleft52">
                            <form method='get' action="<?php echo base_url() ?>Trader/listAll">
                                <div class="input-group my-group"> 

                                    <select class="form-control input-lg cat-select" name="category" id="txtcategory">
                                        <option value="all">All Categories</option>
                                        <?php
                                        foreach ($cat_qry as $r) {
                                            ?>
                                            <option value="<?php echo $r->productCategoryID ?>"><?php echo $r->category_name ?></option>
                                            <?php
                                        }
                                        ?></select> 

                                    <input type="text" name="keyword" class="form-control input-lg frmSearch" id="srchfor" onkeyup="ajaxSearch();" placeholder="Search  for..">
                                    <span class="input-group-btn">

                                        <button type="submit" class="srchbtn" id="slctcategory"> <img src="<?php echo base_url(); ?>img/Search.png"  ></button>
                                    </span>
                                </div>
                            </form>
                        </div>
                        <div class="col-xs-12 col-sm-3 col-md-3 rating-rtl textcenter pl-lg-0"> <?php echo $html ?> </div>
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
                                <a href="<?php echo base_url(); ?>Trader" ><img src="<?php echo base_url(); ?>img/menu-home.png"></a>
                            </li>
                            <li>
                                <a href="<?php echo base_url() ?>Trader/main_category/1"  class="cat_anc caranc">CAR</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url() ?>Trader/main_category/2"  class="cat_anc bikeanc">BIKE</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url() ?>Trader/main_category/3"  class="cat_anc npanc">NUMBER PLATE</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url() ?>Trader/main_category/4"  class="cat_anc veranc">VERTU</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url() ?>Trader/main_category/5"  class="cat_anc watchanc">WATCH</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url() ?>Trader/main_category/6"  class="cat_anc mobanc">MOBILE NUMBER</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url() ?>Trader/main_category/7"  class="cat_anc boatanc">BOAT</a>

                            </li>
                            <li>
                                <a href="<?php echo base_url() ?>Trader/main_category/8"  class="cat_anc phoneanc">PHONE</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url() ?>Trader/main_category/9"  class="cat_anc propanc">PROPERTIES</a>
                            </li>
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
            <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.sticky.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/pace.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/star-rating.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/wow.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/swiper.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/main.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.maskedinput.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/sweetalert.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/intlTelInput.min.js"></script>
        


        <!-- JavaScript Files -->
 
           <!--Popup for Register-->
            <div class="modal fade" id="regModal" role="dialog">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content tradermdl">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h5 class="modal-title">Register</h5>
                        </div>
                        <div class="modal-body">
                            <button class="btnregs" id="btntrader-reg">
                                <span class="spnusers">Trader</span>
                                <span class="spntag">You can sell items</span>
                            </button>
                            <button class="btnregs" id="btncust-reg">
                                <span class="spnusers">Customer</span>
                                 <span class="spntag">You can buy items</span>
                            </button>
                        </div> 
                        
                    </div>
                </div>
            </div>
           <!--Popup for Register-->
           <script>

function watchList() {
    window.location.href = '<?php echo $whref ?>';
}
function cartList() {
    window.location.href = '<?php echo $chref ?>';
}
var icheck=0;

function add_post_response(data){
    var isActive= <?php echo isset($_SESSION['logged_in']['isActive'])?$_SESSION['logged_in']['isActive']:0; ?>;
        if (data == 1)
            {
               location.href = '<?php echo base_url() ?>Trader/plans';
            }
             else if (data == 2)
            {
                location.href = '<?php echo base_url() ?>Trader/fetch_payment_options';
            } 
            else if (data == 4)
            {
                swal('Your account is rejected by Admin.',' Please Contact Admin Team',"error");
                  setTimeout(function ()
                {

                   location.href = '<?php echo base_url() ?>Trader';
                }, 4000);
            } else if (data == 5)
            {
                swal('Please register as Trader');
                // setTimeout(function ()
                // {

                //    location.href = '<?php echo base_url() ?>Trader';
                // }, 4000);
            } else if (data == 6)
            {
                swal('Your plan has been expired',' Please Contact Admin Team',"error");
                setTimeout(function ()
                {

                    location.href = '<?php echo base_url() ?>Trader/plans';
                }, 4000);
                // setTimeout(function ()
                // {

                //    location.href = '<?php echo base_url() ?>Trader';
                // }, 4000);
            } 
             else
            {
                if(isActive!=1){
                    swal('Your account is Freeazed by Admin.',' Please Contact Admin Team',"error");
                }else{
                    swal('Please Contact Admin Team','Your account is waiting for aproval','info');
                 
                    }
            setTimeout(function ()
                    {

                     location.href = '<?php echo base_url() ?>Trader';
                    }, 4000);
                }
    
}






function check_add_post()
{
   
    var isActive= <?php echo isset($_SESSION['logged_in']['isActive'])?$_SESSION['logged_in']['isActive']:0; ?>;
    var isTrader= <?php echo isset($_SESSION['logged_in']['txtusertype'])?$_SESSION['logged_in']['txtusertype']:0; ?>;
    if(isTrader){
 
 $.ajax({
 url: "<?php echo base_url('Trader/trader_check_addpost'); ?>",

 type: "POST",
 success: function (data) {

    if(data==0){
        return data;
    }else{
        if (data == 1)
            {
               location.href = '<?php echo base_url() ?>Trader/plans';
            }
             else if (data == 2)
            {
                location.href = '<?php echo base_url() ?>Trader/fetch_payment_options';
            } 
            else if (data == 4)
            {
                swal('Your account is rejected by Admin.',' Please Contact Admin Team',"error");
                  setTimeout(function ()
                {

                   location.href = '<?php echo base_url() ?>Trader';
                }, 4000);
            } else if (data == 5)
            {
                swal('Please register as Trader');
                // setTimeout(function ()
                // {

                //    location.href = '<?php echo base_url() ?>Trader';
                // }, 4000);
            } else if (data == 6)
            {
                swal('Your plan has been expired',' Please Contact Admin Team',"error");
                setTimeout(function ()
                {

                    location.href = '<?php echo base_url() ?>Trader/plans';
                }, 2000);
                // setTimeout(function ()
                // {

                //    location.href = '<?php echo base_url() ?>Trader';
                // }, 4000);
            } 
             else
            {
                if(isActive!=1){
                    swal('Your account is Freeazed by Admin.',' Please Contact Admin Team',"error");
                }else{
                    swal('Please Contact Admin Team','Your account is waiting for aproval','info');
                 
                    }
            setTimeout(function ()
                    {

                     location.href = '<?php echo base_url() ?>Trader';
                    }, 4000);
                }
    }
     
}

});


}else{
swal('Error','Please register as Trader',"error");
}

}

function check_add_post2()
{
  
    var isActive= <?php echo isset($_SESSION['logged_in']['isActive'])?$_SESSION['logged_in']['isActive']:0; ?>;
    var isTrader= <?php echo isset($_SESSION['logged_in']['txtusertype'])?$_SESSION['logged_in']['txtusertype']:0; ?>;
    if(isTrader){
 
        $.ajax({
        url: "<?php echo base_url('Trader/trader_check_addpost'); ?>",

        type: "POST",
        success: function (data) {
          
            if (data == 0)
            {
              
                location.href = '<?php echo base_url() ?>Trader/add_post';
            } else if (data == 1)
            {
               location.href = '<?php echo base_url() ?>Trader/plans';
            }
             else if (data == 2)
            {
                location.href = '<?php echo base_url() ?>Trader/fetch_payment_options';
            } 
            else if (data == 4)
            {
                swal('Your account is rejected by Admin.',' Please Contact Admin Team',"error");
                  setTimeout(function ()
                {

                   location.href = '<?php echo base_url() ?>Trader';
                }, 4000);
            } else if (data == 5)
            {
                swal('Please register as Trader');
                // setTimeout(function ()
                // {

                //    location.href = '<?php echo base_url() ?>Trader';
                // }, 4000);
            } else if (data == 6)
            {
                swal('Your plan has been expired',' Please Contact Admin Team',"error");
                setTimeout(function ()
                {

                    location.href = '<?php echo base_url() ?>Trader/plans';
                }, 2000);
                // setTimeout(function ()
                // {

                //    location.href = '<?php echo base_url() ?>Trader';
                // }, 4000);
            } 
             else
            {
                if(isActive!=1){
                    swal('Your account is Freeazed by Admin.',' Please Contact Admin Team',"error");
                }else{
                    swal('Please Contact Admin Team','Your account is waiting for aproval','info');
                 
                    }
            setTimeout(function ()
                    {

                     location.href = '<?php echo base_url() ?>Trader';
                    }, 4000);
                }

               
        }

          });

   
}else{
    swal('Error','Please register as Trader',"error");
}

}
$(document).ready(function () {
var currUrl = window.location.pathname;
var params = currUrl.split('/');

var cnt = params.length;
var i=1,catname;
while(i<cnt)
{
    if(params[i-1] == 'main_category'){
        catname = params[i];
        
    }
     i++;
}
if(catname == 1){
    $('.caranc').css('background-color','#f0f0f0');
    $('li').removeClass('active');
}
else if(catname == 2){
    $('.bikeanc').css('background-color','#f0f0f0');
    $('li').removeClass('active');
}
else if(catname == 3){
    $('.npanc').css('background-color','#f0f0f0');
    $('li').removeClass('active');
}
else if(catname == 4){
    $('.veranc').css('background-color','#f0f0f0');
    $('li').removeClass('active');
}else if(catname == 5){
    $('.watchanc').css('background-color','#f0f0f0');
    $('li').removeClass('active');
}else if(catname == 6){
    $('.mobanc').css('background-color','#f0f0f0');
    $('li').removeClass('active');
}else if(catname == 7){
    $('.boatanc').css('background-color','#f0f0f0');
    $('li').removeClass('active');
}
else if(catname == 8){
    $('.phoneanc').css('background-color','#f0f0f0');
    $('li').removeClass('active');
}else if(catname == 9){
    $('.propanc').css('background-color','#f0f0f0');
    $('li').removeClass('active');
}
else {
    
}


$('#spreg').click(function(){
 
     $('#regModal').modal("show");
});

$('#btntrader-reg').click(function(){
    location.href = '<?php echo base_url() ?>Trader/register';
});

$('#btncust-reg').click(function(){
    location.href = '<?php echo base_url() ?>Trader/signupview';
});

    // $('#slctcategory').click(function () {

    //     var category = $('#txtcategory').val();
    //     //alert(category);return false;
    //     var data = 'category=' + category;
    //     $.ajax({
    //         url: "<?php echo base_url('Trader/select_category'); ?>"?,
    //         data: data,
    //         type: "POST",
    //         success: function (data) {

    //             //                        location.href="<?php echo base_url('Trader/view_car_category'); ?>"
    //             //          console.log(data);return false;
    //             $('#sub').css('display', 'none');
    //             $('#car').append(data);
    //         }

    //     });
    // });

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
/*   window.fbAsyncInit = function () {
    FB.init({
        appId: '170708376844898',
        xfbml: true,
        version: 'v2.11'
    });
    FB.AppEvents.logPageView();
};

(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement(s);
    js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
function facebook_share(u) {
    share(u);
}
function share(u) {

    var share = {
        method: 'stream.share',
        u: u
    };

    FB.ui(share, function (response) {

        console.log(response);
    });
}*/
</script> 