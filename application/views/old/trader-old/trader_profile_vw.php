<!-- start section -->
<section class="section white-backgorund" id="sec_prof">
   <div class="container">
      <div class="row">
         <!-- start sidebar -->
         <div class="col-sm-3" id="profile_div">
            <div class="widget">
<!--               <i id="plus_square" class="fa fa-plus-square" aria-hidden="true"></i>-->
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
                                                if(isset($notification))
                                                {
                                                    
                                                   foreach($notification as $r)
                                                       ?>
                                        <?php
                                            $session_data = $this->session->userdata('logged_in');
                                                  $trader_id = $session_data['trader_id'];
                                       ?>
                                        <span  class="fa fa-stack-1x tct"><a href="<?php echo base_url()?>Trader/trader_notifications/<?php echo $trader_id?>"><?php echo $r->total_entries?></a></span>
                                          <?php
                                                }
                                              else
                                              {
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
                    <span><a href="<?php echo base_url()?>Trader/edit_prof/<?php echo $query[0]->traderID?>" id="prof_editanc">Edit</a></span> 
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
         <div class="col-sm-9 trimgpost_div">
            <div class="row">
               <div id="status_divs">
                   <button class="status_btns" id="appbtn">Approved<span id="apprcnt"><?php echo $appr_post_cnt?></span></button>
                  <button class="status_btns" id="pendbtn">Pending<span id="pendrcnt"><?php echo $rej_post_cnt?></span></button>
                  <button class="status_btns" id="rejbtn">Rejected<span id="rejcnt"><?php echo $pend_post_cnt?></span></button>
               </div>
            </div>
            <!-- end row -->
         </div>
         <div class="col-sm-9 trimgpost_div" id="postappr_div">
            <div class="row">
                <?php
                if(count($app_qry)>0)
                {
                foreach($app_qry as $r)
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
                                    if($r->productCSubmitDate != '')
                                    {
                                    $product_date = $r->productCSubmitDate;
                                    }
                                    else if($r->productBSubmitDate != '')
                                    {
                                    $product_date = $r->productBSubmitDate;
                                    }
                                    else if($r->productBTSubmitDate != '')
                                    {
                                    $product_date = $r->productBTSubmitDate;
                                    }
                                    else if($r->productWSubmitDate != '')
                                    {
                                    $product_date = $r->productWSubmitDate;
                                    }
                                    else if($r->productVSubmitDate != '')
                                    {
                                    $product_date = $r->productVSubmitDate;
                                    }
                                    else if($r->productPRSubmitDate != '')
                                    {
                                    $product_date = $r->productPRSubmitDate;
                                    }
                                    else if($r->productPSubmitDate != '')
                                    {
                                    $product_date = $r->productPSubmitDate;
                                    }
                                    else if($r->productNPSubmitDate != '')
                                    {
                                    $product_date = $r->productNPSubmitDate;
                                    }
                                    else if($r->productMNSubmitDate != '')
                                    {
                                    $product_date = $r->productMNSubmitDate;
                                    }
                                    else
                                    {
                                        
                                        $product_date='';
                                    }
                                    /*if($r->productCStatus != '')
                                    {
                                    $product_status = $r->productCStatus;
                                    }
                                    else if($r->productBStatus != '')
                                    {
                                    $product_status = $r->productBStatus;
                                    }
                                    else if($r->productBTStatus != '')
                                    {
                                    $product_status = $r->productBTStatus;
                                    }
                                    else if($r->productWStatus != '')
                                    {
                                    $product_status = $r->productWStatus;
                                    }
                                    else if($r->productVStatus != '')
                                    {
                                    $product_status = $r->productVStatus;
                                    }
                                    else if($r->productPRStatus != '')
                                    {
                                    $product_status = $r->productPRStatus;
                                    }
                                    else if($r->productPHStatus != '')
                                    {
                                    $product_status = $r->productNPStatus;
                                    }
                                    else if($r->productMNStatus != '')
                                    {
                                    $product_status = $r->productMNStatus;
                                    }
                                    else if($r->productPRStatus != '')
                                    {
                                    $product_status = $r->productPRStatus;
                                    }
                                    else
                                    {
                                        
                                        $product_status='';
                                    }*/
                                    ?>
                        <div class="col-sm-3 clpostimgs">
                  <button class="book_btn">BOOKED</button>
                   <img src="<?php echo $img?>" class="post_imgs">
                  <div class="other_prddet">
                     <div class="other_div1">
                        <span class="other_prd">Product</span><span class="other_val"><?php echo $product_name?></span><br>
                        <span class="other_prd">Price</span><span class="other_val" id="sp_price"><?php echo $product_price?></span>
                     </div>
                     <hr class="other_tr_hr">
                     <div class="other_div2">
                                    <?php
                                        $d = $product_date;
                                        $d1 = strtotime($d);
                                        
                                        ?>
                        <span class="other_date"><?php echo date('d M Y',$d1)?></span>
                        <span class="other_view"><?php echo $r->productViewCount?> View</span>
                     </div>
                  </div>
               </div>
                <?php
                    
                }
                }
                else
                {
                
                ?>
                <div style="margin-left:30px"><?php echo 'No approved posts';?></div>
              <?php     
               }
                ?>
           
               
               
            </div>
            <!-- end row -->
         </div>
                <div class="col-sm-9 trimgpost_div" id="postpend_div">
            <div class="row">
               <?php
               if(count($pend_qry)>0)
               {
                     foreach($pend_qry as $r)
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
                                    $product_name = $r->product_name6;
                                    }
                                    else if($r->product_name7 != '')
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
                                    if($r->productCSubmitDate != '')
                                    {
                                    $product_date = $r->productCSubmitDate;
                                    }
                                    else if($r->productBSubmitDate != '')
                                    {
                                    $product_date = $r->productBSubmitDate;
                                    }
                                    else if($r->productBTSubmitDate != '')
                                    {
                                    $product_date = $r->productBTSubmitDate;
                                    }
                                    else if($r->productWSubmitDate != '')
                                    {
                                    $product_date = $r->productWSubmitDate;
                                    }
                                    else if($r->productVSubmitDate != '')
                                    {
                                    $product_date = $r->productVSubmitDate;
                                    }
                                    else if($r->productPRSubmitDate != '')
                                    {
                                    $product_date = $r->productPRSubmitDate;
                                    }
                                    else if($r->productPSubmitDate != '')
                                    {
                                    $product_date = $r->productPSubmitDate;
                                    }
                                    else if($r->productNPSubmitDate != '')
                                    {
                                    $product_date = $r->productNPSubmitDate;
                                    }
                                    else if($r->productMNSubmitDate != '')
                                    {
                                    $product_date = $r->productMNSubmitDate;
                                    }
                                    else
                                    {
                                        
                                        $product_date='';
                                    }
                                    /*if($r->productCStatus != '')
                                    {
                                    $product_status = $r->productCStatus;
                                    }
                                    else if($r->productBStatus != '')
                                    {
                                    $product_status = $r->productBStatus;
                                    }
                                    else if($r->productBTStatus != '')
                                    {
                                    $product_status = $r->productBTStatus;
                                    }
                                    else if($r->productWStatus != '')
                                    {
                                    $product_status = $r->productWStatus;
                                    }
                                    else if($r->productVStatus != '')
                                    {
                                    $product_status = $r->productVStatus;
                                    }
                                    else if($r->productPRStatus != '')
                                    {
                                    $product_status = $r->productPRStatus;
                                    }
                                    else if($r->productPHStatus != '')
                                    {
                                    $product_status = $r->productNPStatus;
                                    }
                                    else if($r->productMNStatus != '')
                                    {
                                    $product_status = $r->productMNStatus;
                                    }
                                    else if($r->productPRStatus != '')
                                    {
                                    $product_status = $r->productPRStatus;
                                    }
                                    else
                                    {
                                        
                                        $product_status='';
                                    }*/
                                    ?>
                        <div class="col-sm-3 clpostimgs">
                  <button class="book_btn">BOOKED</button>
                   <img src="<?php echo $img?>" class="post_imgs">
                  <div class="other_prddet">
                     <div class="other_div1">
                        <span class="other_prd">Product</span><span class="other_val"><?php echo $product_name?></span><br>
                        <span class="other_prd">Price</span><span class="other_val" id="sp_price"><?php echo $product_price?></span>
                     </div>
                     <hr class="other_tr_hr">
                     <div class="other_div2">
                                    <?php
                                        $d = $product_date;
                                        $d1 = strtotime($d);
                                        
                                        ?>
                        <span class="other_date"><?php echo date('d M Y',$d1)?></span>
                        <button id="btneditpost" onclick="edit_post('<?php echo $r->productID?>','<?php echo $r->productCategoryID?>')">Edit Post</button>
                        <!--span class="other_view"><?php echo $r->productViewCount?> View</span-->
                     </div>
                  </div>
               </div>
                <?php
                    
                }
               }
               else
               {
                   ?>
                <div style="margin-left:30px"><?php echo 'No pending posts';?></div>
              <?php     
               }
                ?>
           
               
               
            </div>
            <!-- end row -->
         </div>
               <div class="col-sm-9 trimgpost_div" id="postrej_div">
            <div class="row">
              
                <?php
               if(count($rej_qry)>0)
               {
                     foreach($rej_qry as $r)
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
                                    if($r->productCSubmitDate != '')
                                    {
                                    $product_date = $r->productCSubmitDate;
                                    }
                                    else if($r->productBSubmitDate != '')
                                    {
                                    $product_date = $r->productBSubmitDate;
                                    }
                                    else if($r->productBTSubmitDate != '')
                                    {
                                    $product_date = $r->productBTSubmitDate;
                                    }
                                    else if($r->productWSubmitDate != '')
                                    {
                                    $product_date = $r->productWSubmitDate;
                                    }
                                    else if($r->productVSubmitDate != '')
                                    {
                                    $product_date = $r->productVSubmitDate;
                                    }
                                    else if($r->productPRSubmitDate != '')
                                    {
                                    $product_date = $r->productPRSubmitDate;
                                    }
                                    else if($r->productPSubmitDate != '')
                                    {
                                    $product_date = $r->productPSubmitDate;
                                    }
                                    else if($r->productNPSubmitDate != '')
                                    {
                                    $product_date = $r->productNPSubmitDate;
                                    }
                                    else if($r->productMNSubmitDate != '')
                                    {
                                    $product_date = $r->productMNSubmitDate;
                                    }
                                    else
                                    {
                                        
                                        $product_date='';
                                    }
                                    
                                    if($r->productCStatus != '')
                                    {
                                    $product_status = $r->productCStatus;
                                    }
                                    else if($r->productBStatus != '')
                                    {
                                    $product_status = $r->productBStatus;
                                    }
                                    else if($r->productBTStatus != '')
                                    {
                                    $product_status = $r->productBTStatus;
                                    }
                                    else if($r->productWStatus != '')
                                    {
                                    $product_status = $r->productWStatus;
                                    }
                                    else if($r->productVStatus != '')
                                    {
                                    $product_status = $r->productVStatus;
                                    }
                                    else if($r->productPRStatus != '')
                                    {
                                    $product_status = $r->productPRStatus;
                                    }
                                    else if($r->productPHStatus != '')
                                    {
                                    $product_status = $r->productNPStatus;
                                    }
                                    else if($r->productMNStatus != '')
                                    {
                                    $product_status = $r->productMNStatus;
                                    }
                                    else if($r->productPRStatus != '')
                                    {
                                    $product_status = $r->productPRStatus;
                                    }
                                    else
                                    {
                                        
                                        $product_status='';
                                    }
                                    ?>
                    
                     <div class="col-sm-3 clpostimgs">
                                   
                                    <button class="book_btn">BOOKED</button>
                                    
                                    <img src="<?php echo $img?>" class="post_imgs">
                                    <div class="reject_img_details" id="reject_img_details_1">
                                    <span class="prdpr">Product</span>&nbsp;&nbsp;<b><span class="prdt_price_details"><?php echo $product_name?></span></b><br>
                                     <span class="prdpr">Price</span>&nbsp;&nbsp;<b><span class="price_span"><?php echo $product_price?></span></b>
                                     <hr class="homehr">
                                     <?php
                                        $d = $product_date;
                                        $d1 = strtotime($d);
                                        
                                        ?>
                                     <p id="rejpost_udate"><?php echo date('d M Y',$d1)?></p>
                                     <!--i class="fa fa-exclamation-triangle"  onclick="show_reject('1')" aria-hidden="true"></i-->
                                      <img src="<?php echo base_url();?>img/reject-post-info.png" id="user_postr_img" onclick="show_reject('1')">
                                     <div class="reject"  id="reject_1">
                                         <textarea class="rej_post_textarea" id="post_rej_textarea">dgfdgdfhdfhfhdfdfhjdgfggfgsdfsdggfhdgdfdgfhfh</textarea>
                                         <button class="edit_repost_btn">Edit and Repost</button>
                                     </div>
                                  </div>
                                </div>   
                <?php
                    
                }
               }
               else
               {
                   ?>
                <div style="margin-left:30px"><?php echo 'No rejected posts';?></div>
              <?php     
               }
                ?>
           
               
               
            </div>
            <!-- end row -->
             
         </div>
        
         <!-- end col -->
         
      </div>
      <!-- end row --> 
      <div class="row">
                        <div id="pagination_prof">
                            <ul class="tsc_pagination">

                           
                            <?php foreach ($links as $link) {
                            echo "<li>". $link."</li>";
                            } ?>
                            </ul>
                            </div>
                    </div>
   </div>
   <!-- end container -->
</section>
<section class="section white-backgorund" id="pag_secdiv">
   <!--div class="row">
                        <div id="pagination">
                            <ul class="tsc_pagination">

                           
                            <?php foreach ($links as $link) {
                            echo "<li>". $link."</li>";
                            } ?>
                            </ul>
                            </div>
                    </div-->
</section>
<!-- end section -->
    <section class="section white-backgorund" id="sec_recviews">
            <p id="recent_title" >RECENTLY VIEWED ITEMS</p>
            <div class="container">
                    

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
<script>
    function show_reject(x)
            {
                 $('#reject_'+x).slideToggle();
                 $('#reject_img_details_'+x).css('border-bottom-left-radius','0px');
                 $('#reject_img_details_'+x).css('border-bottom-right-radius','0px');
            }
            function edit_post(product_id,category_id)
            {
                location.href='<?php echo base_url()?>Trader/tr_edit_post/'+product_id+'/'+category_id;
                
            }
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
            
       $('#appbtn').click(function(){
           $('#postappr_div').css('display','block');
           $('#postrej_div').css('display','none');
           $('#postpend_div').css('display','none');
           $('#appbtn').css('background-color','green');
           $('#appbtn').css('color','white');
           $('#pendbtn').css('background-color','white');
           $('#pendbtn').css('color','red');
           $('#rejbtn').css('background-color','white');
            $('#rejbtn').css('color','red');
           $('#pendbtn').css('color','red');
           
       });
       $('#pendbtn').click(function(){
           $('#postpend_div').css('display','block');
           $('#postrej_div').css('display','none');
           $('#postappr_div').css('display','none');
           $('#pendbtn').css('background-color','#f5821f');
           $('#pendbtn').css('color','white');
           $('#appbtn').css('background-color','white');
           $('#appbtn').css('color','red');
           $('#rejbtn').css('background-color','white');
           $('#rejbtn').css('color','red');
          
       });
       $('#rejbtn').click(function(){
           $('#postrej_div').css('display','block');
           $('#postappr_div').css('display','none');
           $('#postpend_div').css('display','none');
           $('#rejbtn').css('background-color','red');
           $('#rejbtn').css('color','white');
           $('#pendbtn').css('background-color','white');
           $('#pendbtn').css('color','red');
           $('#appbtn').css('background-color','white');
           $('#appbtn').css('color','red');
           
       });
       $('#srchcat1').change(function(){
                     var category=$(this).val();
                     var data = 'category='+category;
                     
                      $.ajax({
                   url: "<?php echo base_url('Trader/fetch_brand');?>",
                   data : data,
                   type: "POST",
                   
                   success:function(data){
                      
                       $('#srchcat2').empty();
                
                        $.each(data,function(id,city)
                        {
                            var opt = $('<option />'); 
                            opt.val(id);
                            opt.text(city);
                            $('#srchcat2').append(opt);
                        });
                       
                       
                   }
                  
                   });
                 });
                   $('#srchcat2').change(function(){
                     var brand=$(this).val();
                     var data = 'brand='+brand;
                     
                      $.ajax({
                   url: "<?php echo base_url('Trader/fetch_carmodel');?>",
                   data : data,
                   type: "POST",
                   
                   success:function(data){
                      
                      //console.log(data);return false;
                       $('#srchcat3').empty();
                       
                        $.each(data,function(id,city)
                        {
                            var opt = $('<option />'); 
                            opt.val(id);
                            opt.text(city);
                            $('#srchcat3').append(opt);
                        });
                       
                       
                   }
                  
                   });
                 });
   });
</script>