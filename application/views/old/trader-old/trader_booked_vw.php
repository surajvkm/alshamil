<!-- start section -->
<section class="section white-backgorund" id="sec_prof">
   <div class="container">
      <div class="row">
         <!-- start sidebar -->
         <div class="col-sm-3" id="profile_div">
            <div class="widget">
                    <img src="<?php echo base_url();?>img/profile-add-post.png" id="plus_square" >

               <button type="button" onclick="location.href='add_post'" class="btn btn-default" id="btnadpost">Add Post</button>
            </div>
            <!-- end widget -->
            <div class="widget" id="widget_myprof">
               <p id="prof_imgp">
<!--                  <i id="usericon"  class="fa fa-user"></i>
                  <i  id="pencilicon" class="fa fa-pencil"></i>-->
               <div style="width:100%;">
                   <img src="<?php echo base_url();?>img/profile-notification.png" id="bell_img_icon" >
                    <sup>
                            <span class="fa-stack fa-1x" id="notif_circle">
                            <i class="fa fa-circle fa-stack-2x icon-background_notif"></i>
                            <span  class="fa fa-stack-1x tct"><a href="<?php echo base_url()?>Trader/trader_notifications">2</a></span>
                            </span>
<!--                                        <span  class="fa fa-stack-1x tct">03</span>
                            </span>-->
                    </sup>
                    <div style="float:right;">
                    <span><img src="<?php echo base_url();?>img/profile-edit-profile.png" id="edit_img_icon" ></span>
                    <span><a href="<?php echo base_url()?>Trader/edit_prof" id="prof_editanc">Edit</a></span> 
                    </div>
               </div>
               </p>
               <?php
                    if($query[0]->traderImage != '')
                    {
                        ?>
                         <img src="<?php echo $query[0]->traderImage?>" id="user_prof">
                     <?php
                    }
                    else
                    {
                        ?>
                        <img src="<?php echo base_url()?>img/userProfileIcon_gray.png" id="user_prof">
                    <?php    
                    }
                    ?>
               <center>
                  <p id="tr_name"><?php echo $query[0]->traderFullName;?></p>
                  <p id="tr_place"><?php echo $query[0]->traderLocation;?></p>
               </center>
               <hr>
               <p id="days_bal">You have <b>300</b> days left</p>
              
<!--               <p id="post_bal">You have 140 post balance</p>-->
               <div id="payamtdiv">
                  <span class="spanamts">Total amount paid:</span><span class="trader_prof_amts">AED 23840</span>
                  <hr>
                  <span class="spanamts">Total post:</span><span class="trader_prof_amts"><?php echo $query[0]->traderPostCount?></span>
                  <hr>
                  <span ><a href="<?php echo base_url()?>Trader/trader_sold" class="spanamts">Sold:</a></span><span class="trader_prof_amts"><?php echo $query[0]->traderSoldCount?></span>
                  <hr>
                  <span ><a href="<?php echo base_url()?>Trader/trader_booked" class="spanamts">Booked:</a></span><span class="trader_prof_amts"><?php echo $query[0]->booked_cnt?></span>
               </div>
               <div class="row" id="tr_social">
                  <div class="col-sm-3" >
                      <?php
                      if($query[0]->socialWeb != '')
                      {
                          ?>
                     <img src="<?php echo base_url();?>img/social-web.png" id="web_socialimg">
                     <?php
                      }
                      ?>
                  </div>
                  <div class="col-sm-3" >
                      <?php
                      if($query[0]->socialtwitter != '')
                      {
                          ?>
                     <img src="<?php echo base_url();?>img/social-twitter.png" id="tw_socialimg">
                     <?php
                      }
                      ?>
                     
                  </div>
                  <div class="col-sm-3" >
                      <?php
                      if($query[0]->socialFb != '')
                      {
                          ?>
                     <img src="<?php echo base_url();?>img/social-facebook.png" id="fb_socialimg">
                     <?php
                      }
                      ?>
                     
                  </div>
                  <div class="col-sm-3" >
                      <?php
                      if($query[0]->socialInsta != '')
                      {
                          ?>
                     <img src="<?php echo base_url();?>img/social-instagram.png" id="inst_socialimg">
                     <?php
                      }
                      ?>
                    
                  </div>
                   <div class="col-sm-3" >
                      <?php
                      if($query[0]->socialSnap != '')
                      {
                          ?>
                     <img src="<?php echo base_url();?>img/social-snapchat.png" id="snap_socialimg">
                     <?php
                      }
                      ?>
                    
                  </div>
            </div>
        </div>
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
           <select class="form-control input-lg" name="category" id="srchcat2">
              <option value="">---Select Brand---</option>
           </select>
           <br>
           <select class="form-control input-lg" name="category" id="srchcat3">
               <option value="">---Select Model---</option>
           </select>
           <br>
           <select class="form-control input-lg" name="category" id="srchcat4">
              <option value="Car">From Year</option>
           </select>
           <br>
           <select class="form-control input-lg" name="category" id="srchcat5">
              <option value="Car">To Year</option>
           </select>
           <button type="button" class="btn btn-default" id="btnsrchpost">SEARCH</button>
        </div>
        <!-- end widget -->
    </div>
         
         <!-- end col -->
         <!-- end sidebar -->
         
        <div class="col-sm-9">
            <div class="row">
                            <div id="category_title_div">
                                <h5 id="booked_div_title">BOOKED</h5>
                            </div>
                            
                        </div>
            
         </div>
         <div class="col-sm-9 trimgpost_div" id="booked_div">
            <div class="row">
                <?php
                foreach($booked_qry as $r)
                {
                                if($r->Cpost_main_img != '')
                                    {
                                    $img = $r->Cpost_main_img;
                                    }
                                    else if($r->Bpost_main_img != '')
                                    {
                                    $img = $r->Bpost_main_img;
                                    }
                                    else if($r->BTpost_main_img != '')
                                    {
                                    $img = $r->BTpost_main_img;
                                    }
                                    else if($r->Wpost_main_img != '')
                                    {
                                    $img = $r->Wpost_main_img;
                                    }
                                    else if($r->Vpost_main_img != '')
                                    {
                                    $img = $r->Vpost_main_img;
                                    }
                                    else if($r->PRpost_main_img != '')
                                    {
                                    $img = $r->PRpost_main_img;
                                    }
                                    else if($r->PHpost_main_img != '')
                                    {
                                    $img = $r->PHpost_main_img;
                                    }
                                    else if($r->NPpost_main_img != '')
                                    {
                                    $img = $r->NPpost_main_img;
                                    }
                                    else
                                    {
                                        
                                        $img=base_url().'img/no_preview.png';
                                    }
                                    if($r->product_name1 != '')
                                    {
                                    $product_name = $r->product_name1;
                                    }
                                    else if($r->product_name2 != '')
                                    {
                                    $product_name = $r->product_name2;
                                    }
                                    else if($r->product_name3 != '')
                                    {
                                    $product_name = $r->product_name3;
                                    }
                                    else if($r->product_name4 != '')
                                    {
                                    $product_name = $r->product_name4;
                                    }
                                    else if($r->product_name5 != '')
                                    {
                                    $product_name = $r->product_name5;
                                    }
                                    else if($r->product_name6 != '')
                                    {
                                    $product_name = $r->product_name7;
                                    }
                                    else if($r->product_name8 != '')
                                    {
                                    $product_name = $r->product_name8;
                                    }
                                    else if($r->product_name9 != '')
                                    {
                                    $product_name = $r->product_name9;
                                    
                                    }
                                    else
                                    {
                                        
                                        $product_name='dfgfd';
                                    }
                                    if($r->productCPrice != '')
                                    {
                                    $product_price = $r->productCPrice;
                                    }
                                    else if($r->productBPrice != '')
                                    {
                                    $product_price = $r->productBPrice;
                                    }
                                    else if($r->productBTPrice != '')
                                    {
                                    $product_price = $r->productBTPrice;
                                    }
                                    else if($r->productWPrice != '')
                                    {
                                    $product_price = $r->productWPrice;
                                    }
                                    else if($r->productVPrice != '')
                                    {
                                    $product_price = $r->productVPrice;
                                    }
                                    else if($r->productPRPrice != '')
                                    {
                                    $product_price = $r->productPRPrice;
                                    }
                                    else if($r->productPHPrice != '')
                                    {
                                    $product_price = $r->productPHPrice;
                                    }
                                    else if($r->productNPPrice != '')
                                    {
                                    $product_price = $r->productNPPrice;
                                    }
                                    else if($r->productMNPrice != '')
                                    {
                                    $product_price = $r->productMNPrice;
                                    }
                                    else
                                    {
                                        
                                        $product_price='';
                                    }
                                    if($r->postSubmissionOn != '')
                                    {
                                    $product_date = $r->postSubmissionOn;
                                    }
                                    else if($r->postSubmissionOn != '')
                                    {
                                    $product_date = $r->postSubmissionOn;
                                    }
                                    else if($r->postSubmissionOn != '')
                                    {
                                    $product_date = $r->postSubmissionOn;
                                    }
                                    else if($r->postSubmissionOn != '')
                                    {
                                    $product_date = $r->postSubmissionOn;
                                    }
                                    else if($r->postSubmissionOn != '')
                                    {
                                    $product_date = $r->postSubmissionOn;
                                    }
                                    else if($r->postSubmissionOn != '')
                                    {
                                    $product_date = $r->postSubmissionOn;
                                    }
                                    else if($r->postSubmissionOn != '')
                                    {
                                    $product_date = $r->postSubmissionOn;
                                    }
                                    else if($r->postSubmissionOn != '')
                                    {
                                    $product_date = $r->postSubmissionOn;
                                    }
                                    else if($r->postSubmissionOn != '')
                                    {
                                    $product_date = $r->postSubmissionOn;
                                    }
                                    else
                                    {
                                        
                                        $product_date='';
                                    }
                                    $currency = "AED";
                ?>
                <div class="col-sm-3 clbookedimgs">
                     <button class="book_btn">BOOKED</button>
                   <img src="<?php echo $img?>"  class="post_imgs">
                   <div class="bother_prddet">
                     <div class="bother_div1">
                        <span class="bother_prd">Product</span><span class="bother_val"><?php echo $product_name?></span><br>
                        <span class="bother_prd">Price</span><span class="bother_val" id="sp_price"><?php echo $currency." ".$product_price?></span>
                     </div>
                     <hr class="bother_tr_hr">
                     <div class="bother_div2">
                         <?php
                                        $d = $product_date;
                                        $d1 = strtotime($d);
                                        
                                        ?>
                        <span class="bother_date"><?php echo date('d M Y',$d1)?></span>
                       <span class="booked_view_cnt"><?php echo $r->productViewCount?> View</span>
                     </div>
                  </div>
               </div>
                <?php
                }
                ?>
             <!--div class="col-sm-3 clbookedimgs">
                 <button class="book_btn">BOOKED</button>
                   <img src="<?php echo base_url();?>img/no_preview.png"  class="post_imgs">
                   <div class="bother_prddet">
                     <div class="bother_div1">
                        <span class="bother_prd">Product</span><span class="bother_val">Audi 777</span><br>
                        <span class="bother_prd">Price</span><span class="bother_val" id="sp_price">AED 1000</span>
                     </div>
                     <hr class="bother_tr_hr">
                     <div class="bother_div2">
                        <span class="bother_date">12 Jan 2017</span>
                       <span class="booked_view_cnt">120 View</span>
                     </div>
                  </div>
               </div-->
                
                
            </div>
            <!-- end row -->
        </div>
      
  
        
         <!-- end col -->
         
      </div>
      <!-- end row --> 
      
   </div>
   <!-- end container -->
</section>

<!-- end section -->
    <section class="section white-backgorund" id="sec_recviews">
            <p id="recent_title" >RECENTLY VIEWED ITEMS</p>
            <div class="container">
                    


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
<script>
    
   $(document).ready(function(){
       
       
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
            
       
       
   });
</script>