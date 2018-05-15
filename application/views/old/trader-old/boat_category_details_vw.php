 
        <!-- start section -->
        <section class="section white-backgorund" id="sec_prof">
            <div class="container">
                
               <div class="row">
                    <?php echo $this->session->flashdata('msg'); ?>
                </div>
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
                                 <input type="hidden" name="product_id"  value="<?php echo $product_id; ?>"/>
                                <h5 id="category_det_title"><?php echo $query[0]->product_name; ?></h5>
                                <!--hr id="category_det_hr"-->
                                <?php $currency = "AED";?>
                                <span id="cat_det_amt"><?php echo $currency." ".$query[0]->productBTPrice; ?></span>
                            </div>
                            
                        </div><!-- end row -->
                    </div>
                    <div class="col-sm-9">
                        
                        <div class="col-sm-5">
                                                 <div class="owl-carouseldetailpage owl-carousel owl-theme" id="cate_main_video_Carousel">
                                    
                            <?php
                           
                            foreach($boat_img_qry as $r)
                            {
                            ?>
                                    <div class="item">
                                       
                                        
                                            <img src="<?php echo $r->productImage ?>"  id="cat_trader_videos" >
                                            <div class="ow_prdt_slider">
                                                <span class="spownview">Views</span>
                                                <span class="spowncnt"><?php echo $r->productViewCount?></span>

                                            </div>
                                        </div>
                                    <?php
                            }
                            ?>
                            <?php        
                            foreach($boat_img_qry as $r)
                            {
                            ?>
                                    <div class="item">
                                            <img src="<?php echo $r->BTpost_main_img ?>"  id="cat_trader_videos" >
                                            <div class="ow_prdt_slider">
                                                <span class="spownview">Views</span>
                                                <span class="spowncnt"><?php echo $r->productViewCount?></span>
                                            </div>
                                        </div>
                                    <?php break;
                            }
                            ?>
                            <?php
                            foreach($boat_img_qry as $r)
                            {
                            ?>
                                    <div class="item">
                                         <video  class="trader_videos" id="cat_trader_videos">
                                             <source src="<?php echo $r->productVideo; ?>" type="video/mp4">
                                        Your browser does not support the video tag.
                                        </video>
                                            <div class="ow_prdt_slider">
                                                <span class="spownview">Views</span>
                                                <span class="spowncnt"><?php echo $r->productVideoCount?></span>
                                            </div>
                                        </div>
                                    <?php break;
                            }
                            ?>           
       



                              
                                
                                
                                
                        </div><!-- end row -->
                                                       <div id="imgfivediv">
                    <?php
                    foreach($boat_img_qry as $r)
                            {
                        ?>
                                   <img src="<?php echo $r->productImage?>" class="fiveimgs" id="five_post_imgs1">
                          <?php break;
                          }
                            ?>
                                   
                                   <?php
                    foreach($boat_img_qry as $r)
                            {
                        ?>
                                   <img src="<?php echo $r->BTpost_main_img?>" class="fiveimgs" id="five_post_imgs1">
                          <?php break;
                          }
                            ?>
                                    <?php
                    foreach($boat_img_qry as $r)
                            {
                        ?>
                                  <video  class="fiveimgs" id="cat_det_vide">
                                             <source src="<?php echo $r->productVideo; ?>" type="video/mp4">
                                        Your browser does not support the video tag.
                                        </video>
                                   
                          <?php break;
                          }
                            ?>
                                    
                                </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="row" id="cat_owner">
                                 <?php
                                    if($query[0]->traderImage != '')
                                    {
                                        ?>
                                         <img src="<?php echo $query[0]->traderImage?>" id="owner_prof">
                                     <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <img src="<?php echo base_url()?>img/userProfileIcon_gray.png" id="owner_prof">
                                    <?php    
                                    }
                                    ?>
                              
                                <p id="owner_name"><?php echo $query[0]->traderFullName ?></p>
                                <p id="owner_place"><?php echo $query[0]->traderLocation; ?></p>
                                <hr id="cat_detail_hr">
                                 <?php
                                        $d = $query[0]->productBTSubmitDate;
                                        $d1 = strtotime($d);
                                        ?>
                                <p id="owner_post_date">Posted on <?php echo date('d M Y',$d1)?></p>
                                 <button class="btn btn-default btncons" id="catdet_phone"><img id="img_contno" src="<?php echo base_url()?>img/post-detail-phone.png"> <span id="poster_contact"><?php echo $query[0]->traderContactNum?></span></button>

<!--                                <span id="poster_contact"><?php echo $query[0]->traderContactNum?></span>-->
                                <div class="row">
                                
                                <div class="col-sm-6" id="car_mail_div">
                                    <div class="form-group">
                                        <i id="mail_ic" class="fa fa-envelope" aria-hidden="true"></i>
                                         <button class="btn btn-default btncons" id="catdet_mailbtn" <?php if(isset($_SESSION['logged_in'])){?> data-target="#myModal" <?php } else {?> disabled <?php } ?>>Mail</button>
<!--                                        <button class="btn btn-default btncons" data-toggle="modal" data-target="#myModal" id="catdet_mailbtn">Mail</button>-->
                                   </div>
                                </div>
                                 <div class="col-sm-6" >
                                    <div class="form-group">
                                        <i id="chat_ic" class="fa fa-comments" aria-hidden="true"></i>
                                        <button class="btn btn-default btncons" id="catdet_chatbtn">Chat</button>
                                    </div>
                                </div> 

                            </div>
                            </div>
                            <div class="row" id="cart_btns">
                                <!--img id="img_sharedr" src="<?php echo base_url()?>img/driv_share_font.png"-->
                              
                                <button id="shared_btn" class="btn" onclick="shared_modal('<?php echo $query[0]->productCategoryID?>','<?php echo $query[0]->productID?>')"  data-target="#dataModal" data-toggle="modal" data-id="<?php echo $query[0]->productID;?>">  <img src="<?php echo base_url();?>img/post-share.png"  id="img_shared" ><span class="btns_txts">Share</span></button><br>
                             <button id="wishlist_btn" onclick="watchlist_pg('<?php echo $query[0]->productID?>')">  <img src="<?php echo base_url();?>img/post-add-watchlist.png"  id="img_watch_list" >Watch List</button><br>
                             <button id="flag_btn" class="btn" onclick="show_flag_modal('<?php echo $query[0]->productCategoryID?>','<?php echo $query[0]->productID?>','<?php echo $query[0]->cartBTType?>','<?php echo $query[0]->postID?>','<?php echo $query[0]->traderID?>')">   <img src="<?php echo base_url();?>img/post-flag.png"  id="img_flag" >Flag Post</button><br>

                                <?php
                                if($query[0]->cartBTType == 1)
                                {
                                    ?>
                                    <button id="addcart_btn" onclick="cartlist_pg('<?php echo $query[0]->productID?>')"><img src="<?php echo base_url();?>img/post-add-cart.png"  id="img_cartt" >Add to Cart</button>

                                <?php    
                                }
                                ?>
<!--                                <button id="addcart_btn" onclick="cartlist_pg('<?php echo $query[0]->productID?>')"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;&nbsp;Add to Cart</button>-->
                            </div>
                            
                            
                        </div>
                    </div><!-- end col -->
                     <div class="col-sm-12">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-9" >
                        <p id="history_title" >VEHICLE HISTORY</p>
                        <div id="history_descr_div">
                            <p id="hist_descr"><?php echo $query[0]->productBDesc?></p>
                        </div>
                    </div>
                    
                </div>
                </div><!-- end row -->                
            </div><!-- end container -->
        </section>
        <section class="section white-backgorund vehhis" >
            
        </section>
        
        <!-- end section -->
         <section class="section white-backgorund" id="sec_catrecviews">
            <p id="recent_title" >RECENTLY VIEWED ITEMS</p>
            <div class="container">
<div class="owl-one owl-carousel owl-theme">
                     <?php
                        $item_class = ' active';
                        foreach($recentqry as $r)
                        {
                            ?>
                    
                        <div class="item<?php echo $item_class; ?>">

                                       <img src="<?php echo $r->productImage?>"  class="recent_slimgs" >
                                        <div class="mostv_prddiv" >
                                            <p class="most_prd">Product</p><span class="most_prd_vals"><?php echo $r->productName?></span>
                                            <p class="most_prd_price">Price</p><span class="most_prd_vals"><?php echo $r->productName?></span>
                                        </div>
                                    

                                       </div>

                                      <?php
                                      $item_class = '';
                                      }
                                      ?>
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
        
       <div id="flagModal" class="modal fade"> 
            
           <form role="form" class="form-horizontal"  method="post">
            <div class="modal-dialog">  
                 <div class="modal-content">  
                      <div class="modal-header" id="flagmheader">  
                           <button type="button" class="close" data-dismiss="modal">&times;</button>  
                           <img src="<?php echo base_url();?>img/profile-notification-flag.png" id="modal_flag_img"><h6 class="modal-title flag_title">Flag for any offensive content</h6>  
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
                     <form role="form" class="form-horizontal" action="<?php echo base_url();?>Trader/sendmail_car/<?php echo $query[0]->productID;?>" method="post">
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
        
             <script>
            $(document).ready(function()
            
            {
                $('.owl-carouseldetailpage').owlCarousel({
                        loop:true,
                        singleItem: true,
                        //margin:10,
                        navText: [ '<button class="owlbtn"><i class="fa fa-chevron-circle-left catdetslider_left" ></i></button>', '<button class="owlbtn"><i class="fa fa-chevron-circle-right catdetslider_right"  aria-hidden="true"></i></button>' ],
                        nav:true,
                        autoplay: true,
                        responsive:{
                            0:{
                                items:1
                            },

                        }
                    });
                    $('.owl-one').owlCarousel({
                        loop:true,
                        margin:10,
                        
                     	navText: [ '<button class="owlbtn"><i class="fa fa-chevron-circle-left mostviewslider_left" ></i></button>', '<button class="owlbtn"><i class="fa fa-chevron-circle-right mostviewslider_right"  aria-hidden="true"></i></button>' ],
                        nav:true,
                        autoplay: true,
                        responsive:{
                            0:{
                                items:1
                            },
                            600:{
                                items:1
                            },
                            1000:{
                                items:4
                            }
                        }
                    });
                $('.viewsliderdiv').owlCarousel({
                            loop:true,
                margin:10,
                nav:true,
                responsive:{
                    0:{
                        items:4
                    },
                    600:{
                        items:4
                    },
                    1000:{
                        items:4
                    }
                }
                        });
                        $('#btn_flag_modal').click(function(){
                var category_id = $('#pcatid').val();
                var product_id = $('#prodid').val();
                var post_id = $('#postid').val();
                 var trader_id = $('#traderid').val();
                var flag_desc = $('#flag_md_cmt').val();
                $.ajax({
                            url: "<?php echo base_url(); ?>Trader/save_flagpost",
                             data :  {'category_id':category_id,'product_id':product_id,'post_id':post_id,'trader_id':trader_id,'flag_desc':flag_desc},
                            type: "POST",

                            success:function(data){
                                
                                if(data == 'success')
                                {
                                 swal("Product has been flagged successfully");
                              
                                   
                            }
                            else
                            {
                               swal("Failed to report the flag.Try again");   
                            }
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
                            $('.anccls').click(function(){
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
                              
                                   
                            }

                        });
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
            function shared_modal(category_id,product_id)
            {
                
                     
                $.ajax({
                            url: "<?php echo base_url(); ?>Trader/fetch_proddet",
                            data : {'product_id':product_id,'cat_id':category_id},
                            type: "POST",

                            success:function(data){
                                 $('#employee_detail').html(data);  
                                 $('#dataModal').modal("show"); 
                              
                                   
                            }

                        });
                 
            }
            function show_flag_modal(category_id,product_id,cart_type,post_id,trader_id)
            {
               
                $('#pcatid').val(category_id);  
                $('#prodid').val(product_id);
                $('#postid').val(post_id);
                $('#traderid').val(trader_id);
                $('#flagModal').modal("show");
                $('#dataModal').modal("hide");
              
                
            }
            function show_popup()
   {
       $('#myModal').modal('show');
        $('#dataModal').modal("hide");
   }
            function watchlist_pg(product_id)
            {
               
               location.href='<?php echo base_url()?>Trader/check_log_watchlist/'+product_id ;
            }
             function cartlist_pg(product_id)
            {
               
               location.href='<?php echo base_url()?>Trader/check_log_cartlist/'+product_id ;
            }
            
            $('#catdet_mailbtn').click(function(){
                 
                    $('#myModal').modal('show');
                 });
            </script>
       
        
    