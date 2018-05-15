 <!-- start section -->

 <section id="footersec" styel="text-align: center;">
 <div class="container" styel="text-align: center;"> 
     <img src="<?php echo base_url();?>img/footer-img.png" class="imgfooter">
     <img class="imgfooter footer-icon" src="<?php echo base_url(); ?>img/Logo.png" alt="" style="width:20%;display:block;margin:5px auto;"/>
<!--                <a href="#"><img src="<?php echo base_url();?>img/footer-02.png" id="imgfooter1"></a>
     <a href="#"><img src="<?php echo base_url();?>img/footer-01.png" id="imgfooter2"></a>-->
 </div><!-- end container -->
</section>
<!-- end section -->

<!-- start section -->
<section>
 
</section>
<!-- end section -->

<!-- start footer -->
<footer class="footer">
 <div class="container">
     
     <div class="row text-center">
         <div class="col-sm-12 px-0">
             <span id="footertxt">
                 <a href="<?php echo base_url();?>Trader/about_the_company">About the Company </a>&nbsp;&nbsp;  <a href="<?php echo base_url();?>Trader/privacy_policy">Privacy Policy</a> &nbsp;&nbsp;   <a href="<?php echo base_url();?>Trader/terms_conditions">Terms & Conditions </a>&nbsp;&nbsp;  <a href="<?php echo base_url();?>Trader/help_contact">Help & Contact</a>
             </span>
             
             <hr class="spacer-10 no-border">
             
             
         </div><!-- end col -->
         
         
         
     
    
     
     <!--div class="row text-center">
         <div class="col-sm-12">
             <p class="text-sm">&COPY; 2017. Made with <i class="fa fa-heart text-danger"></i> by <a href="javascript:void(0);">DiamondCreative.</a></p>
         </div>
     </div--><!-- end row -->
     </div>
 </div><!-- end container -->
</footer>

<div id="sb_widget"></div>
<!-- end footer -->
<script src="<?php echo base_url()?>js/local/jquery.localizationTool.js"></script>

<script type="text/javascript" src="<?php echo base_url()?>js/SendBird.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/Widget.Sendbird.js"></script>
<script>
$('#widget').localizationTool({
     'defaultLanguage' : 'en_GB', /* (optional) although must be defined if you don't want en_GB */
     'showFlag': false,            /* (optional) show/hide the flag */
     'showCountry': false,         /* (optional) show/hide the country name */
     'showLanguage': true,        /* (optional) show/hide the country language */
     'languages' : {              /* (optional) define **ADDITIONAL** custom languages */
 
     },
     /* 
      * Translate your strings below
      */
     'strings' : {
         /*
          * You can specify the text string to translate directly...
          */
         'CAR' : {
             'en_GB' :'CAR',
             'ar_TN' : 'السيارات'
         },
         'BIKE' : {
             'en_GB' :'BIKE',
             'ar_TN' : 'الداجات'
         },
         'NUMBER PLATE' : {
             'en_GB' :'NUMBER PLATE',
             'ar_TN' : 'أرقام السيارات'
         },
         'VERTU' : {
             'en_GB' :'VERTU',
             'ar_TN' : 'فيرتو'
         },
         'WATCH' : {
             'en_GB' :'WATCH',
             'ar_TN' : 'الساعات'
         },
         'MOBILE NUMBER' : {
             'en_GB' :'MOBILE NUMBER',
             'ar_TN' : 'أرقام الموبايلات'
         },
         'BOAT' : {
             'en_GB' :'BOAT',
             'ar_TN' : 'القوارب'
         },
         'PHONE' : {
             'en_GB' :'PHONE',
             'ar_TN' : 'الهواتف'
         },
         'PROPERTIES' : {
             'en_GB' :'PROPERTIES',
             'ar_TN' : 'العقارات'
         },
          'Car' : {
             'en_GB' :'Car',
             'ar_TN' : 'السيارات'
         },
         'Bike' : {
             'en_GB' :'Bike',
             'ar_TN' : 'الداجات'
         },
  'Sign In' : {
             'en_GB' :'Sign In',
             'ar_TN' : 'تسجيل الدخول'
         },
  'Logout' : {
             'en_GB' :'Logout',
             'ar_TN' : 'الخروج'
         },
  
  'Register' : {
             'en_GB' :'Register',
             'ar_TN' : 'التسجيل'
         },
  'Post' : {
             'en_GB' :'Post',
             'ar_TN' : 'إعلان'
         },
  'Price' : {
             'en_GB' :'Price',
             'ar_TN' : 'السعر'
         },

  'All Categories' : {
             'en_GB' :'All Categories',
             'ar_TN' : 'التصنيفات'
         },
  'LATEST POST' : {
             'en_GB' :'LATEST POST',
             'ar_TN' : 'إعلانات الحديثة'
         },
'Privacy Policy' : {
             'en_GB' :'Privacy Policy',
             'ar_TN' : 'سياسة الخصوصية'
         },
  'Terms & Conditions' : {
             'en_GB' :'Terms & Conditions',
             'ar_TN' : 'الشروط و الاحكام'
         },

  'Username' : {
             'en_GB' :'Username',
             'ar_TN' : 'اسم المستخدم'
         },
  'Password' : {
             'en_GB' :'Password',
             'ar_TN' : 'رمز المرور'
         },

       'Trader' : {
             'en_GB' :'Trader',
             'ar_TN' : 'تاجر'
         },
    'Customer' : {
             'en_GB' :'Customer',
             'ar_TN' : 'عميل'
         },
   'Register As Trader' : {
             'en_GB' :'Register As Trader',
             'ar_TN' : 'تسجيل كتاجر'
         },
   'Full Name' : {
             'en_GB' :'Full Name',
             'ar_TN' : 'الإسم الكامل'
         },
   'Place' : {
             'en_GB' :'Place',
             'ar_TN' : 'المكان'
         },
  'Confirm Password' : {
             'en_GB' :'Confirm Password',
             'ar_TN' : 'تاكيد رمز المرور'
         },
   'Add Detail' : {
             'en_GB' :'Add Detail',
             'ar_TN' : 'إضافة التفاصيل'
         },
  'Next' : {
             'en_GB' :'Next',
             'ar_TN' : 'التالي'
         },
  'Pending' : {
             'en_GB' :'Pending',
             'ar_TN' : 'قيد الانتظار'
         },
  'Rejected' : {
             'en_GB' :'Rejected',
             'ar_TN' : 'تم الرفض'
         },
  'Total post' : {
             'en_GB' :'Total post',
             'ar_TN' : 'مجموع الإعلانات'
         },
  'Sold' : {
             'en_GB' :'Sold',
             'ar_TN' : 'بيع'
         },
  'Booked' : {
             'en_GB' :'Booked',
             'ar_TN' : 'حجز'
         },
  'Available' : {
             'en_GB' :'Available',
             'ar_TN' : 'متوفر'
         },

  'Add Post' : {
             'en_GB' :'Add Post',
             'ar_TN' : 'إضافة إعلان'
         },
  'Details' : {
             'en_GB' :'Details',
             'ar_TN' : 'التفاصيل'
         },

  'Clear' : {
             'en_GB' :'Clear',
             'ar_TN' : 'مسح'
         },

  'Notifications' : {
             'en_GB' :'Notifications',
             'ar_TN' : 'إشعار'
         },
  'Confirm Password' : {
             'en_GB' :'Confirm Password',
             'ar_TN' : 'تاكيد رمز المرور'
         },

  'WATCH LIST' : {
             'en_GB' :'WATCH LIST',
             'ar_TN' : 'متابعة'
         },

  'Select Plan' : {
             'en_GB' :'Select Plan',
             'ar_TN' : 'إختيار الباقة'
         },

  'No.Plate' : {
             'en_GB' :'No.Plate',
             'ar_TN' : 'أرقام السيارات'
         },
         'Vertu' : {
             'en_GB' :'Vertu',
             'ar_TN' : 'فيرتو'
         },
         'Watch' : {
             'en_GB' :'Watch',
             'ar_TN' : 'الساعات'
         },
         'Mob.No.' : {
             'en_GB' :'Mob.No.',
             'ar_TN' : 'أرقام الموبايلات'
         },
         'Boat' : {
             'en_GB' :'Boat',
             'ar_TN' : 'القوارب'
         },
         'Phone' : {
             'en_GB' :'Phone',
             'ar_TN' : 'الهواتف'
         },
         'Properties' : {
             'en_GB' :'Properties',
             'ar_TN' : 'العقارات'
         },
        'Login' : {
             'en_GB' :'Login',
             'ar_TN' : 'تسجيل الدخول'
         },
  'Sign in' : {
             'en_GB' :'Sign in',
             'ar_TN' : 'تسجيل الدخول'
         },

  'Dubai' : {
             'en_GB' :'Dubai',
             'ar_TN' : 'دبي'
         },

       'Sharjah' : {
             'en_GB' :'Sharjah',
             'ar_TN' : 'الشارقة'
         },
  'Abudhabi' : {
             'en_GB' :'Abudhabi',
             'ar_TN' : 'أبوظبي'
         },
  'Ajman' : {
             'en_GB' :'Ajman',
             'ar_TN' : 'عجمان'
         },
  'Fujairah' : {
             'en_GB' :'Fujairah',
             'ar_TN' : 'الفجيرة'
         },
  'Umm Al Quwain' : {
             'en_GB' :'Umm Al Quwain',
             'ar_TN' : 'أم القيوين'
         },
  'Ras al Khaima' : {
             'en_GB' :'Ras al Khaima',
             'ar_TN' : 'راس الخيمة'
         },
  'Umm Alquwain' : {
             'en_GB' :'Umm Alquwain',
             'ar_TN' : 'أم القيوين'
         },
  'RAK' : {
             'en_GB' :'RAK',
             'ar_TN' : 'راس الخيمة'
         },
 'Al Ain' : {
             'en_GB' :'Al Ain',
             'ar_TN' : 'الفجيرة'
         },
  'Email' : {
             'en_GB' :'Email',
             'ar_TN' : 'ايميل'
         },
  'Mobile Number' : {
             'en_GB' :'Mobile Number',
             'ar_TN' : 'أرقام الموبايلات'
         },
  'Write About Yourself' : {
             'en_GB' :'Write About Yourself',
             'ar_TN' : 'إكتب عن نفسك أو شركتك'
         }

     }

 });

</script>




<?php 


if (isset($_SESSION['logged_in'])){
 $userDet=userDetails($_SESSION['logged_in']['traderName']);
  ?>

<script>

var APP_ID = 'CD2DC42F-F7B1-405B-932C-D1250A10FB0A'; //20C84ED5-E6AA-4B6B-93B4-9C41F18CBC05
//    var userId = '<?php echo $_SESSION['logged_in']['traderUserName'] ?>';
//     var nickname = '<?php  echo $_SESSION['logged_in']['traderName'] ?>':

 var userId = '<?php echo $_SESSION['logged_in']['traderUserName'] ?>';
 var nickname = '<?php  echo $userDet['traderFullName'];?>';
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

</body>

</html>