<!-- start section -->
<section id="footersec" styel="text-align: center;">
<div class="container" styel="text-align: center;"> 
<img src="<?php echo base_url();?>img/footer-img.png" class="imgfooter">
<img class="imgfooter footer-icon" src="<?php echo base_url(); ?>img/Logo.png" alt="" style="width:20%;display:block;margin:5px auto;"/>
</div>
</section>
<footer class="footer">
 <div class="container">
     <div class="row text-center">
         <div class="col-sm-12 px-0">
             <span id="footertxt">
                 <a href="<?php echo base_url();?>Trader/about_the_company">About the Company </a>&nbsp;&nbsp;  <a href="<?php echo base_url();?>Trader/privacy_policy">Privacy Policy</a> &nbsp;&nbsp;   <a href="<?php echo base_url();?>Trader/terms_conditions">Terms & Conditions </a>&nbsp;&nbsp;  <a href="<?php echo base_url();?>Trader/help_contact">Help & Contact</a>
             </span>
             <hr class="spacer-10 no-border">
         </div>
     </div>
 </div><!-- end container -->
</footer>
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

    
    <div id="dataModal" class="modal fade">  
        <div class="modal-dialog">  
            <div class="modal-content">  
                <div class="modal-header">  
                    <button type="button" class="close" data-dismiss="modal">&times;</button>  
                    <h4 class="modal-title">Share Through Social Icons</h4>  
                </div>  
                <div class="modal-body" id="employee_detail">  
                </div>  
                <div class="modal-footer">  
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
            </div>  
        </div>  
    </div>  
    <div id="cartModal" class="modal fade">  
        <div class="modal-dialog">  
            <div class="modal-content">  
                <div class="modal-header">  
                    <button type="button" class="close" data-dismiss="modal">&times;</button>  
                    <h4 class="modal-title">Contact Trader</h4>  
                </div>  
                <div class="modal-body" id="trader_detail">  
                </div>  
                <div class="modal-footer">  
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
            </div>  
        </div>  
    </div>  
    <div id="flagModal" class="modal fade"> 

        <form role="form" class="form-horizontal" action="<?php echo base_url(); ?>Trader/save_flagpost" method="post">
            <div class="modal-dialog">  
                <div class="modal-content">  
                    <div class="modal-header" id="flagmheader">  
                        <button type="button" class="close" data-dismiss="modal">&times;</button>  
                        <img src="<?php echo base_url(); ?>img/profile-notification-flag.png" id="modal_flag_img"><h6 class="modal-title flag_title">Flag for any offensive content</h6>  
                    </div>  
                    <div class="modal-body" id="trader_detail"> 
                        <input type="hidden" id="pcatid">
                        <input type="hidden" id="prodid">
                        <input type="hidden" id="postid">
                        <input type="hidden" id="traderid">
                        <textarea id="flag_md_cmt"></textarea>
                    </div>  
                    <div class="modal-footer" id="flagmfooter">  
                        <button type="submit" class="btn btn-default" id="btn_flag_modal" data-dismiss="modal">SEND</button>  
                    </div>  
                </div>  
            </div>
        </form>
</div>  
<div id="sb_widget"></div>
<?php 


if (isset($_SESSION['logged_in'])){
 $userDet=userDetails($_SESSION['logged_in']['traderName']);
  ?>
<script type="text/javascript" src="<?php echo base_url()?>js/SendBird.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/Widget.Sendbird.js"></script>
<script>

var APP_ID = 'CD2DC42F-F7B1-405B-932C-D1250A10FB0A'; //20C84ED5-E6AA-4B6B-93B4-9C41F18CBC05
//    var userId = '<?php echo $_SESSION['logged_in']['traderUserName'] ?>';
//     var nickname = '<?php  echo $_SESSION['logged_in']['traderName'] ?>':

 var userId = '<?php echo $_SESSION['logged_in']['traderUserName'] ?>';
 var nickname = '<?php  echo $userDet['traderName'];?>';
 var myimg='<?php  echo $userDet['traderImage'];?>';;
 var otherimg;
/*        var sb = new SendBird({
appId: APP_ID
});*/

// sb.connect(userId, function(user, error) {
//     console.log(sb);
// });
// var channelUrl = 'sendbird_group_channel_59525265_b9d764767569a3e710f1460896fa720b197fdf52';
// sb.showChannel(channelUrl);

//  sbWidget.start(APP_ID);


//             sbWidget.startWithConnect(APP_ID, userId, nickname, function() {
//                 var channelUrl = 'sendbird_group_channel_59525265_b9d764767569a3e710f1460896fa720b197fdf52';
// //sbWidget.showChannel(channelUrl);    
//     });
 



sbWidget.startWithConnect(APP_ID, userId, nickname,function() {
     var channelUrl = 'sendbird_group_channel_59525265_b9d764767569a3e710f1460896fa720b197fdf52';

//sbWidget.showChannel(channelUrl);    
// sbWidget.start_single_chat(['5'],'https://static.pexels.com/photos/67843/splashing-splash-aqua-water-67843.jpeg', function() {

// });
},myimg);


$(document).on('click', '.catdet_chatbtn', function(){
id = $(this).data("trader");
name= $(this).data("trader");
console.log([id]);
sbWidget.startWithConnect(APP_ID, userId, nickname,function() {
     var channelUrl = 'sendbird_group_channel_59525265_b9d764767569a3e710f1460896fa720b197fdf52';
     sbWidget.start_single_chat([id],'https://static.pexels.com/photos/67843/splashing-splash-aqua-water-67843.jpeg', function() {

     });
},myimg);

});

 
//             var sb = new SendBird({
//     appId: appId
// });
// sb.connect(userId, function(user, error) {});
//            console.log(sb);

//            sb.GroupChannel.createChannelWithUserIds('Mila', true, '', '', '', function(createdChannel, error) {
//     if (error) {
//         console.error(error);
//         return;
//     }
//     console.log(createdChannel);
// });
//            sb.connect('Mila', function(user, error) {});

 // sbWidget.startWithConnect(appId, userId, nickname, function(sb) {
 //     console.log(this);
 //   // do something...
 // });
 
 </script>
<?php  } ?>
        
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.sticky.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/pace.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/star-rating.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/wow.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/swiper.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/main.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/sweetalert.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>/js/owl.carousel.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>js/app/app.js"></script>