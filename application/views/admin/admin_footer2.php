

        
        
        <script type="text/javascript" src="<?php echo base_url()?>js/jquery-3.1.1.min.js"></script>
       
       <script type="text/javascript" src="<?php echo base_url()?>js/jquery-ui.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>js/owl.carousel.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>js/jquery.downCount.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>js/nouislider.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>js/jquery.sticky.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>js/pace.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>js/star-rating.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>js/wow.min.js"></script>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>js/gmaps.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>js/swiper.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>js/main.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>js/jquery.maskedinput.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>js/bootstrap-datepicker.js"></script>
         <script type="text/javascript" src="<?php echo base_url();?>js/sweetalert.min.js"></script>
        
        <script type="text/javascript"  src="<?php echo base_url()?>code/highstock.js"></script>
               <script type="text/javascript" src="<?php echo base_url()?>js/remoteTime.js"></script>

        <!--script type="text/javascript"  src="js/exporting.js"></script-->
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
      $("#LATime").remoteTime({
          key: "AIzaSyBNqBl2R6u8pONv3CWyXev-otesQf-1Ypo",
          location: "Asia,Kolkata",
          format: "g:i:s A"
      });

      $("#DCTime").remoteTime({
          key: "AIzaSyBNqBl2R6u8pONv3CWyXev-otesQf-1Ypo",
          location: "washington dc",
          format: "l, F jS, g:i A"
      });
      </script>
