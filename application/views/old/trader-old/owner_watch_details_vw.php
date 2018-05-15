
        <!-- start section -->
        <section class="section white-backgorund" id="sec_prof">
            <div class="container">
                <div class="row">
                    <!-- start sidebar -->
                    <div class="col-sm-3" id="profile_div">
                        
                        
                        <div class="widget" id="widget_advsrch">
                                <p id="adsrchtitle">Advanced Search</p>
                                <select class="form-control input-lg" name="category" id="srchcat1">
                                         <?php
                                    foreach($cat_qry as $r)
                                    {
                                       ?>
                                    <option value="<?php echo $r->productCategoryID?>"><?php echo $r->category_name?></option>
                                    <?php
                                    }
                                    ?>

                                 </select>
                                <br>
                               <select class="form-control input-lg" name="brand" id="srchcat2">
                                         <option value="">---Select---</option>

                                 </select>
                                <br>
                                <select class="form-control input-lg" name="model" id="srchcat3">
                                          <option value="">---Select---</option>

                                 </select>
                                <br>
                                <select class="form-control input-lg" name="category" id="srchcat4">
                                       <option value="">From Year</option>
                                         <option value="1970">1970</option>
                                          <option value="1987">1987</option>
                                           <option value="1987">1987</option>
                                            <option value="2000">2000</option>

                                 </select>

                                <br>
                                <select class="form-control input-lg" name="category" id="srchcat5">
                                         <option value="">To Year</option>
                                          <option value="2011">2011</option>
                                           <option value="2016">2016</option>
                                            <option value="2017">2017</option>

                                 </select>
                                <button type="button" class="btn btn-default" id="btnsrchpost">SEARCH</button>
                        </div><!-- end widget -->
                        
                 
                    </div><!-- end col -->
                    <!-- end sidebar -->
                    <div class="col-sm-9">
                        
                        <div class="row">
                            <div id="category_det_title_div">
                               
                                <h5 id="category_det_title"> Calvin Klein 89</h5>
                                <!--hr id="mobcategory_det_hr"-->
                                <span id="cat_det_amt">AED 9000</span>
                            </div>
                            
                        </div><!-- end row -->
                    </div>
                    <div class="col-sm-9">
                        
                        <div class="col-sm-5">
                            <div class="row">
                                 <div class="carousel slide" data-ride="carousel">
                                  <!-- Indicators -->
                                  <ol class="carousel-indicators catli">
                                    <li id="li1" data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                    <li id="li2" data-target="#myCarousel" data-slide-to="1"></li>
                                    <li id="li3" data-target="#myCarousel" data-slide-to="2"></li>
                                  </ol>
                                  
                                  <!-- Wrapper for slides -->
                                  <div class="carousel-inner" id="cate_main_video_Carousel">
                                    <div class="item active">
                                       <img src="<?php echo base_url();?>img/no_preview.png"  id="cat_trader_videos" >
                                       <div class="ow_prdt_slider">
                                           <span class="spownview">Views</span>
                                           <span class="spowncnt">120</span>

                                        </div>
                                    </div>

                                    <div class="item">
                                       <img src="<?php echo base_url();?>img/no_preview.png"  id="cat_trader_videos" >
                                       <div class="ow_prdt_slider">
                                           <span class="spownview">Views</span>
                                           <span class="spowncnt">120</span>

                                        </div>
                                    </div>

                                    <div class="item">
                                       <img src="<?php echo base_url();?>img/no_preview.png"  id="cat_trader_videos" >
                                       <div class="ow_prdt_slider">
                                           <span class="spownview">Views</span>
                                           <span class="spowncnt">120</span>

                                        </div>
                                    </div>
                                  </div>

                                  <!-- Left and right controls -->
                                  <a class="left carousel-control" id="cat_video_left_carousel" href="#myCarousel" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                    <span class="sr-only">Previous</span>
                                  </a>
                                  <a class="right carousel-control" id="cat_video_right_carousel"  href="#myCarousel" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                    <span class="sr-only">Next</span>
                                  </a>
                                </div>
                                <div id="imgfivediv">
                                    <img src="<?php echo base_url();?>img/no_preview.png" class="fiveimgs" id="five_post_imgs1">
                                    <img src="<?php echo base_url();?>img/no_preview.png" class="fiveimgs" id="five_post_imgs2">
                                    <img src="<?php echo base_url();?>img/no_preview.png" class="fiveimgs" id="five_post_imgs3">
                                    <img src="<?php echo base_url();?>img/no_preview.png" class="fiveimgs" id="five_post_imgs4"> 
                                     <img src="<?php echo base_url();?>img/no_preview.png" class="fiveimgs" id="five_post_imgs5"> 
                                </div>

                            
                                
                                
                        </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="row" id="cat_owner">
                                
                                <img src="<?php echo base_url()?>img/userProfileIcon_gray.png" id="owner_prof">
                                   
                              
                                <p id="owner_name">Ahmed Khaber</p>
                                <p id="owner_place">UAE</p>
                                <hr id="cat_detail_hr">
                                 
                                <p id="owner_post_date">Posted on 6 October 3008</p>
                                <button id="btn_own_avail">Available</button>  
                                <button id="btn_own_book">Booked</button>
                                <button id="btn_own_sold">Sold</button>
                            </div>
                            <div class="row" id="cart_btns">
                             
                                <button id="shared_btn" class="btn openModal" data-toggle="modal" data-target="#myModal" data-id="1">  <img src="<?php echo base_url();?>img/post-share.png"  id="img_shared" ><span class="btns_txts">Share</span></button><br>

                                
                            </div>
                            
                            
                        </div>
                    </div><!-- end col -->
                    <div class="col-sm-12">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-9" >
                        <p id="history_title" >VEHICLE HISTORY</p>
                        <div id="history_descr_div">
                            <p id="hist_descr">dgdfgfdgfh</p>
                        </div>
                    </div>
                    
                </div>
                </div><!-- end row -->                
            </div><!-- end container -->
        </section>
<!--        <section class="section white-backgorund vehhis" >
            <p id="history_title" >POST DETAILS</p>
            <div id="history_descr_div">
                <p id="hist_descr">
                    <?php echo $qry[0]->productVDesc?>
                </p>
            </div>
            
        </section>-->
        
        <!-- end section -->
       <section class="section white-backgorund" id="sec_recviews">
            <p id="recent_title" >RECENTLY VIEWED ITEMS</p>
            <div class="container">
                    
<!--                    <div id="myCarousel"  class="carousel slide" data-ride="carousel">
                       Indicators 
                      <ol class="carousel-indicators">
                        <li  data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li  data-target="#myCarousel" data-slide-to="2"></li>
                         <li data-target="#myCarousel" data-slide-to="3"></li>
                      </ol>-->

                      <!-- Wrapper for slides -->
                 

               <div class="col-lg-6 col-md-offset-3">
                    <div class="carousel slide" id="myCarousel">
                      <div class="carousel-inner">
                          <?php
                          $item_class = ' active';
                          foreach($recentqry as $r)
                          {
                              ?>
                        <div class="item<?php echo $item_class; ?>">
                           
                           <div class="col-lg-2 rccol"><img src="<?php echo base_url().'uploads/product_images/'.$r->productImage?>"  class="recent_slimgs" >
                            <div class="mostv_prddiv" >
                                <p class="most_prd">Product</p><span class="most_prd_vals"><?php echo $r->productName?></span>
                                <p class="most_prd_price">Price</p><span class="most_prd_vals"><?php echo $r->productName?></span>
                            </div>
                           </div>
                            
                           </div>
                            
                          <?php
                          $item_class = '';
                          }
                          ?>
   
    
  </div>
  <a class="left carousel-control" href="#myCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left" id="most_left_caro"></i></a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right" id="most_right_caro"></i></a>
</div>
                    </div>
             </div>

        </section> 
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
            
       <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×</button>
            <h4 class="modal-title" id="myModalLabel">
            Send Mail
         </div>
         <div class="modal-body">
            <div class="row">
               <!-- Nav tabs -->
               <!-- Tab panes -->
               <div class="tab-content">
                  <div class="tab-pane active" id="Login">
                     <form role="form" class="form-horizontal" action="<?php echo base_url();?>Trader/sendmail_vertu/<?php echo $qry[0]->productID;?>" method="post">
                        </br> 
                        <div class="form-group">
                           <label for="subject" class="col-sm-2 control-label">
                           Subject</label>
                           <div class="col-sm-8">
                               <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required="" />
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-sm-2 control-label">
                           Message
                           </label>
                           <div class="col-sm-8">
                              <textarea  name="message" class="form-control" rows="9" cols="25" value=""></textarea>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-2">
                           </div>
                           <div class="col-sm-8">
                              &nbsp;  <button type="submit" class="btn btn-info btn-fill">
                              Send</button>&nbsp;
                              <button type="button" class="btn btn-info btn-fill">
                              Cancel</button>
                           </div>
                           </br>
                           </br>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
  <script>
          function watchlist_pg(product_id)
            {
               
               location.href='<?php echo base_url()?>Trader/check_log_watchlist/'+product_id ;
            }
            function cartlist_pg(product_id)
            {
               
               location.href='<?php echo base_url()?>Trader/check_log_cartlist/'+product_id ;
            }
       $(document).ready(function()
            {
                $('#btn_own_book').click(function(){
                    $(this).css('background-color','#78a22f');
                    $(this).css('color','white');
                    $('#btn_own_avail').css('background-color','white');
                    $('#btn_own_avail').css('border','1px solid #f5821f');
                    $('#btn_own_avail').css('color','grey');
                });
                $('#btn_own_sold').click(function(){
                    $(this).css('background-color','#78a22f');
                    $(this).css('color','white');
                    $('#btn_own_avail').css('background-color','white');
                    $('#btn_own_avail').css('border','1px solid #ed1d24');
                    $('#btn_own_avail').css('color','grey');
                    $('#btn_own_book').css('background-color','white');
                    $('#btn_own_book').css('border','1px solid #f5821f');
                    $('#btn_own_book').css('color','grey');
                });
                $('#btn_own_avail').click(function(){
                    $(this).css('background-color','#78a22f');
                    $(this).css('color','white');
                    $('#btn_own_sold').css('background-color','white');
                    $('#btn_own_sold').css('border','1px solid #ed1d24');
                    $('#btn_own_sold').css('color','grey');
                    $('#btn_own_book').css('background-color','white');
                    $('#btn_own_book').css('border','1px solid #f5821f');
                    $('#btn_own_book').css('color','grey');
                });
                         $('.openModal').click(function(){
                     var id = $(this).attr('data-id');
                     //alert(id);return false;
                     var data = 'product_id='+id;
                $.ajax({
                            url: "<?php echo base_url(); ?>Trader/fetch_proddet",
                            data : data,
                            type: "POST",

                            success:function(data){
                                 $('#employee_detail').html(data);  
                                  $('#dataModal').modal("show"); 
                                  $('#myModal').modal('hide');
                              
                              
                                   
                            }

                        });
                 });
                   $('#myCarousel').carousel({
              interval: 4000
            });

            $('#myCarousel .item').each(function(){
              var next = $(this).next();
              if (!next.length) {
                next = $(this).siblings(':first');
              }
              next.children(':first-child').clone().appendTo($(this));

              for (var i=0;i<2;i++) {
                next=next.next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                    }

                next.children(':first-child').clone().appendTo($(this));
              }
            });
                  $('#srchcat1').change(function(){
                        var category = $("#srchcat1").val();
                        
                        if((category == '3')||(category == '6')||(category == '9'))
                        {
                            $('#srchcat2').css('display','none');
                            $('#srchcat3').css('display','none');
                            $('#srchcat4').css('display','none');
                            $('#srchcat5').css('display','none');
                        }
                        else
                        {
                            $('#srchcat2').css('display','block');
                            $('#srchcat3').css('display','block');
                            $('#srchcat4').css('display','block');
                            $('#srchcat5').css('display','block');

                     var data = 'category='+category;
                    if (category != "") { 
                         $.ajax({
                            type: "POST",
                            dataType: 'json',
                            data:data,
                            url: "<?php echo base_url('Trader/fetch_brand'); ?>" ,
                            success: function (data) {
                                //console.log(data);return false;
                                 $('#srchcat2').empty();

                    $.each(data,function(id,city)
                    {
                        var opt = $('<option />'); // here we're creating a new select option for each group
                        opt.val(id);
                        opt.text(city);
                        $('#srchcat2').append(opt);
                    });

                        }

                        });
                        }
                        }
                 });
                        $('#srchcat2').change(function(){
                        var brand = $("#srchcat2").val();

                     var data = 'brand='+brand;
                    if (brand != "") { 
                         $.ajax({
                            type: "POST",
                            dataType: 'json',
                            data:data,
                            
                            url: "<?php echo base_url('Trader/fetch_carmodel'); ?>" ,
                            success: function (data) {
                                
                                 $('#srchcat3').empty();

                    $.each(data,function(id,city)
                    {
                        var opt = $('<option />'); // here we're creating a new select option for each group
                        opt.val(id);
                        opt.text(city);
                        $('#srchcat3').append(opt);
                    });

                        }

                        });
                        }
                 });
       
       
            });
             function show_popup()
   {
       $('#myModal').modal('show');
        $('#dataModal').modal("hide");
   }
        $('#catdet_mailbtn').click(function(){
                 
                    $('#myModal').modal('show');
                 });
        </script>
          
    