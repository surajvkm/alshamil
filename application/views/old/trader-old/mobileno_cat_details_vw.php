
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
                                <h5 id="category_det_title"><?php echo $qry[0]->productMNPrefix." ".$qry[0]->productMNNmbr?></h5>
                                <!--hr id="mobcategory_det_hr"-->
                                <?php $currency = "AED";?>
                                <span id="cat_det_amt"><?php echo $currency." ".$qry[0]->productMNPrice?></span>
                            </div>
                            
                        </div><!-- end row -->
                    </div>
                    <div class="col-sm-9">
                        
                        <div class="col-sm-5">
                            <div class="row">
                                <div>
                                    <img id="mobimg" src="<?php echo base_url().'uploads/product_images/'.$qry[0]->productImage?>">
                                   <div id="noplate_cnt_div">
                                           <span class="spownview">Views</span>
                                           <span class="spowncnt">120</span>

                                  </div>
                                </div>

                            
                                
                                
                        </div><!-- end row -->
                        </div>
                        <div class="col-sm-4">
                            <div class="row" id="cat_owner">
                                
                               <?php
                                    if($qry[0]->traderImage != '')
                                    {
                                        ?>
                                         <img src="<?php echo base_url().'uploads/trader_images/'.$qry[0]->traderImage?>" id="owner_prof">
                                     <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <img src="<?php echo base_url()?>img/userProfileIcon_gray.png" id="owner_prof">
                                    <?php    
                                    }
                                    ?>
                                <p id="owner_name"><?php echo $qry[0]->traderFullName?></p>
                                <p id="owner_place"><?php echo $qry[0]->traderLocation?></p>
                                <hr id="cat_detail_hr">
                                <p id="owner_post_date">Posted on 
                                    <?php
                                        $d = $qry[0]->productMNSubmitDate;
                                        $d1 = strtotime($d);
                                        
                                        ?>
                                    <?php echo date('d M Y',$d1)?>
                                </p>
                                  <button class="btn btn-default btncons" id="catdet_phone"><img id="img_contno" src="<?php echo base_url()?>img/post-detail-phone.png"> <span id="poster_contact"><?php echo $qry[0]->traderContactNum?></span></button>

<!--                                <span id="poster_contact"><?php echo $qry[0]->traderContactNum?></span>-->
                                <div class="row">
                                
                                <div class="col-sm-6" id="car_mail_div">
                                    <div class="form-group">
                                        <i id="mail_ic" class="fa fa-envelope" aria-hidden="true"></i>
                                 <button class="btn btn-default btncons" id="catdet_mailbtn" <?php if(isset($_SESSION['logged_in'])){?> data-target="#myModal" <?php } else {?> disabled <?php } ?>>Mail</button>

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
                              
                                <button id="shared_btn" class="btn openModal" data-toggle="modal" data-target="#myModal" data-id="<?php echo $qry[0]->productID;?>">  <img src="<?php echo base_url();?>img/post-share.png"  id="img_shared" ><span class="btns_txts">Share</span></button><br>
                             <button id="wishlist_btn" onclick="watchlist_pg('<?php echo $qry[0]->productID?>')">  <img src="<?php echo base_url();?>img/post-add-watchlist.png"  id="img_watch_list" >Watch List</button><br>
                             <button id="flag_btn" class="btn openModal">   <img src="<?php echo base_url();?>img/post-flag.png"  id="img_flag" >Flag Post</button><br>

                                <?php
                                if($qry[0]->cartMNType == 1)
                                {
                                    ?>
                                    <button id="addcart_btn" onclick="cartlist_pg('<?php echo $qry[0]->productID?>')"><img src="<?php echo base_url();?>img/post-add-cart.png"  id="img_cartt" >Add to Cart</button>

                                <?php    
                                }
                                ?>
<!--                                <button id="addcart_btn" onclick="cartlist_pg('<?php echo $qry[0]->productID?>')"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;&nbsp;Add to Cart</button>-->
                            </div>
                            
                            
                        </div>
                    </div><!-- end col -->
                    <div class="col-sm-12">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-9" >
                        <p id="history_title" >VEHICLE HISTORY</p>
                        <div id="history_descr_div">
                            <p id="hist_descr"><?php echo $qry[0]->productMNDesc?></p>
                        </div>
                    </div>
                    
                </div>
                </div><!-- end row -->                
            </div><!-- end container -->
        </section>
        <section class="section white-backgorund vehhis" >
            
            
        </section>
        
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
        
        <div id="testModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">gfhgj</h4>  
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
                     <form role="form" class="form-horizontal" action="<?php echo base_url();?>Trader/sendmail_mobno/<?php echo $qry[0]->productID;?>" method="post">
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
                 $('#catdet_mailbtn').click(function(){
                 
//                    $('#testModal').modal('show');
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
          
    
       
       
        
    