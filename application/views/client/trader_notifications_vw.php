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
                                <?php
                                if (isset($notification)) {

                                    foreach ($notification as $r)
                                        
                                        ?>
                                    <?php
                                    $session_data = $this->session->userdata('logged_in');
                                    $trader_id = $session_data['trader_id'];
                                    ?>
                                    <!--span  class="fa fa-stack-1x tct"><a href="<?php echo base_url() ?>Trader/trader_notifications/<?php echo $trader_id ?>"><?php echo $count ?></a></span-->
                                    <span  class="fa fa-stack-1x tct"><a onclick="fetch_all_notifs('<?php echo $trader_id?>')"><?php echo $count ?></a></span>

                                <?php
                                } else {
                                    ?>
                                    <span  class="fa fa-stack-1x tct">0</span>
                                    <?php
                                }
                                ?>
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
                         <img src="<?php echo base_url().'uploads/trader_images/'.$query[0]->traderImage?>" id="user_prof">
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
               <p id="days_bal"><?php echo $msg ?></p>
              
<!--               <p id="post_bal">You have 140 post balance</p>-->
               <div id="payamtdiv">
                  <span class="spanamts">Total amount paid:</span><span class="trader_prof_amts">AED <?php if($trader_tot_amt== '') echo '0';else echo $trader_tot_amt;?></span>
                  <hr>
                  <span class="spanamts">Total post:</span><span class="trader_prof_amts"><?php echo $total_post?></span>
                  <hr>
                  <span ><a href="<?php echo base_url()?>Trader/trader_sold" class="spanamts">Sold:</a></span><span class="trader_prof_amts"><?php echo $total_sold_cnt?></span>
                  <hr>
                  <span ><a href="<?php echo base_url()?>Trader/trader_booked" class="spanamts">Booked:</a></span><span class="trader_prof_amts"><?php echo $total_book_cnt?></span>
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
           <select class="form-control input-lg " name="category" id="srchcat1">

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
                                <h4 id="notif_div_title">NOTIFICATIONS</h4>
                            </div>
                            
            </div>
            
        </div>
         <div class="col-sm-9">
            <div class="row">
                <hr class="sep_hr">
                            
            </div>
            
        </div>
        <div class="col-sm-9" id="trnotif_main_div">
             <?php
                if(count($notifications)>0)
                {
                            foreach($notifications as $row)
                            {
                                ?>
                            <div class="row">
                                <?php
                                    if($row->Cpost_main_img != '')
                                    {
                                    $img = $row->Cpost_main_img;
                                    }
                                    else if($row->Bpost_main_img != '')
                                    {
                                    $img = $row->Bpost_main_img;
                                    }
                                    else if($row->BTpost_main_img != '')
                                    {
                                    $img = $row->BTpost_main_img;
                                    }
                                    else if($row->Wpost_main_img != '')
                                    {
                                    $img = $row->Wpost_main_img;
                                    }
                                    else if($row->Vpost_main_img != '')
                                    {
                                    $img = $row->Vpost_main_img;
                                    }
                                    else if($row->PRpost_main_img != '')
                                    {
                                    $img = $row->PRpost_main_img;
                                    }
                                    else if($row->PHpost_main_img != '')
                                    {
                                    $img = $row->PHpost_main_img;
                                    }
                                    else if($row->NPpost_main_img != '')
                                    {
                                    $img = $row->NPpost_main_img;
                                    }
                                    else
                                    {
                                        
                                        $img=base_url().'img/no_preview.png';
                                    }
                                    if($row->product_name1 != '')
                                    {
                                    $product_name = $row->product_name1;
                                    }
                                    else if($row->product_name2 != '')
                                    {
                                    $product_name = $row->product_name2;
                                    }
                                    else if($row->product_name3 != '')
                                    {
                                    $product_name = $row->product_name3;
                                    }
                                    else if($row->product_name4 != '')
                                    {
                                    $product_name = $row->product_name4;
                                    }
                                    else if($row->product_name5 != '')
                                    {
                                    $product_name = $row->product_name5;
                                    }
                                    else if($row->product_name6 != '')
                                    {
                                    $product_name = $row->product_name7;
                                    }
                                    else if($row->product_name8 != '')
                                    {
                                    $product_name = $row->product_name8;
                                    }
                                    else if($row->product_name9 != '')
                                    {
                                    $product_name = $row->product_name9;
                                    
                                    }
                                    else
                                    {
                                        
                                        $product_name='';
                                    }
                                    if($row->productCPrice != '')
                                    {
                                    $product_price = $row->productCPrice;
                                    }
                                    else if($row->productBPrice != '')
                                    {
                                    $product_price = $row->productBPrice;
                                    }
                                    else if($row->productBTPrice != '')
                                    {
                                    $product_price = $row->productBTPrice;
                                    }
                                    else if($row->productWPrice != '')
                                    {
                                    $product_price = $row->productWPrice;
                                    }
                                    else if($row->productVPrice != '')
                                    {
                                    $product_price = $row->productVPrice;
                                    }
                                    else if($row->productPRPrice != '')
                                    {
                                    $product_price = $row->productPRPrice;
                                    }
                                    else if($row->productPHPrice != '')
                                    {
                                    $product_price = $row->productPHPrice;
                                    }
                                    else if($row->productNPPrice != '')
                                    {
                                    $product_price = $row->productNPPrice;
                                    }
                                    else if($row->productMNPrice != '')
                                    {
                                    $product_price = $row->productMNPrice;
                                    }
                                    else
                                    {
                                        
                                        $product_price='';
                                    }?>
                <div class="col-sm-3">
                     <?php
                    if($flagdetails[0]->traderImage != '')
                    {
                        ?>
                         <img src="<?php echo $flagdetails[0]->traderImage?>" class="notif_trimg">
                     <?php
                    }
                    else
                    {
                        ?>
                        <img src="<?php echo base_url()?>img/userProfileIcon_gray.png" class="notif_trimg">
                    <?php    
                    }
                    ?>
<!--                     <img src="<?php echo $flagdetails[0]->traderImage?>" class="notif_trimg"/>-->
                     <p class="notif_trname"><?php echo $flagdetails[0]->traderFullName?></p> 
                     <p class="notif_flagpost">Flagged your post</p> 
                </div>
                <div class="col-sm-3">
                    <img src="<?php echo base_url();?>img/profile-notification-flag.png" class="notif_flag_img">
                </div>
                <div class="col-sm-3 notif_date_col">
                    <p class="notif_post_date"><?php echo $row->flagDate;?></p> 
                </div>
             
            </div>
            <div class="row notif_prddetails">
                <div class="col-sm-2">
                     <img src="<?php echo $img?>" class="notif_prd_img"/>
                </div>
                <div class="col-sm-2 prddet_col">
                    <p class="notif_prname"><?php echo $product_name;?></p> 
                     <p class="notif_prprice">AED<?php echo $product_price;?></p> 
                </div>
                <div class="col-sm-7"><?php echo $row->flagDesc;?>.</p>
                </div>
               
                    <hr class="sep_hr">
                
                
            </div>
            <?php
                            }
                }
                else{
                    echo '<center>No Notifications Found</center>';
                }
                            ?>
        </div>
     
         <!-- end col -->
         
      </div>
      <!-- end row --> 
      
   </div>
   <!-- end container -->
</section>

<!-- end section -->
          <?php $this->load->view('trader/recently_viewed_vw');?>
<script>
    
   $(document).ready(function(){
       
      
   
            
       
       
   });
</script>