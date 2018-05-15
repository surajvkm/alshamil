<div id="sb_widget"></div>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/sweetalert.min.js"></script>
            
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    
         <script type="text/javascript" src="<?php echo base_url()?>js/SendBird.min.js"></script>
         <script type="text/javascript" src="<?php echo base_url()?>js/Widget.Sendbird.js"></script>
         

      <!--  <script type="text/javascript" src="<?php echo base_url()?>js/jquery-3.1.1.min.js"></script>
       
       <script type="text/javascript" src="<?php echo base_url()?>js/jquery-ui.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>js/owl.carousel.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>js/jquery.downCount.js"></script>
    
        <script type="text/javascript" src="<?php echo base_url()?>js/jquery.sticky.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>js/pace.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>js/star-rating.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>js/wow.min.js"></script>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>js/gmaps.js"></script>
      
        <script type="text/javascript" src="<?php echo base_url()?>js/jquery.maskedinput.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>js/bootstrap-datepicker.js"></script>


          <script type="text/javascript" src="<?php echo base_url()?>js/remoteTime.js"></script>
         

        <script type="text/javascript"  src="<?php echo base_url()?>code/highstock.js"></script> -->

        <!--script type="text/javascript"  src="js/exporting.js"></script-->
        <?php if (isset($_SESSION['logged_in'])){?>
<script>
           var APP_ID = 'CD2DC42F-F7B1-405B-932C-D1250A10FB0A'; //20C84ED5-E6AA-4B6B-93B4-9C41F18CBC05
           var userId = '1';
            var nickname = 'ALSHAMIL ADMIN';
   /*        var sb = new SendBird({
    appId: APP_ID
});*/

// sb.connect(userId, function(user, error) {
//     console.log(sb);
// });
// var channelUrl = 'sendbird_group_channel_59525265_b9d764767569a3e710f1460896fa720b197fdf52';
// sb.showChannel(channelUrl);
         
        //  sbWidget.start(APP_ID);

      
            sbWidget.startWithConnect(APP_ID, userId, nickname, function() {
                var channelUrl = 'sendbird_group_channel_59525265_b9d764767569a3e710f1460896fa720b197fdf52';
//sbWidget.showChannel(channelUrl);    
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
       <?php } ?>
        <script>
 
            $(document).ready(function() {
     

     
                  $('.parent').click(function() {
                         $('.sub-nav').toggleClass('visible');
                  });
                 $('#searchButton').click(function() {
                        var category = $('#category').val();
                        var keyword  = $('#srchfor').val();
                        var url = "<?php echo base_url()?>admin/SearchController/listAll/"+category+"/"+keyword;
                        window.location.href = url;
                   });
            });
            var html = '';

                        </script>
    


    
   <script>
 

 var MONTH_NAME = ['January', 'Febuary', 'March', 'April', 'May', 'June',
                  'July', 'August', 'September', 'October', 'November', 'December'];
function showTime() {
    function twoDigit(n) {
        return ('0' + n).slice(-2);
    }
    function iso8601(date) {
        return date.getFullYear() +
               '-' + twoDigit(1 + date.getMonth()) +
               '-' + twoDigit(date.getDate()) +
               'T' + twoDigit(date.getHours()) +
               ':' + twoDigit(date.getMinutes());
    }
    function en_US(date) {
        var h = date.getHours() % 12;
        // return   (h == 0 ? 12 : h) +
        //        ':'  + twoDigit(date.getMinutes()) +
        //        ' ' + (date.getHours() < 12 ? 'am' : 'pm')+twoDigit(date.getSeconds());
               return   (h == 0 ? 12 : h) +
               ':'  + twoDigit(date.getMinutes()) +
               ':' +twoDigit(date.getSeconds());
    }
    
    var timeEl = document.getElementById('time');
    if (timeEl !== null) {
        var now = new Date();
        timeEl.innerHTML = en_US(now);
     //   timeDiv.setAttribute('datetime', iso8601(now));
    }
};
setInterval(showTime, 1000);
    //   $("#LATime").remoteTime({
    //       key: "AIzaSyBNqBl2R6u8pONv3CWyXev-otesQf-1Ypo",
    //       location: "Asia,Kolkata",
    //       format: "g:i:s A"
    //   });

    //   $("#DCTime").remoteTime({
    //       key: "AIzaSyBNqBl2R6u8pONv3CWyXev-otesQf-1Ypo",
    //       location: "washington dc",
    //       format: "l, F jS, g:i A"
    //   });

    $(document).on('keydown', '#txt_cprice', function(e){
  
                var max_chars =10;
        // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    // Allow: Ctrl+A, Command+A
                    (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
                    // Allow: home, end, left, right, down, up
                    (e.keyCode >= 35 && e.keyCode <= 40)) {
           
                 // let it happen, don't do anything
                 return;
        }else{
            
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
         
            e.preventDefault();
        }
    




    });
 
      </script>
