
        <!-- start section -->
        <section class="section white-backgorund" id="sec_prof">
            <div class="container">
                <div class="row">
                    <!-- start sidebar -->
                    <div class="col-sm-3" id="profile_div">
                       
                        
                        <div class="widget" id="widget_otherprof">
                            
                             <input type="hidden" name="trader_id"  value="<?php echo $trader_id; ?>"/>
                              <?php
                              if(isset($qry[0]->traderImage))
                              {
                                    if($qry[0]->traderImage != '')
                                    {
                                        ?>
                                         <img src="<?php echo $qry[0]->traderImage?>" id="otheruser_prof">
                                     <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <img src="<?php echo base_url()?>img/userProfileIcon_gray.png" id="otheruser_prof">
                                    <?php    
                                    }
                                    
                              }
                              else
                              {
                                  ?>
                                     <img src="<?php echo base_url()?>img/userProfileIcon_gray.png" id="otheruser_prof">
                              <?php       
                              }
                              ?>      
                              <center>
                                 
                                <p id="tr_othname"><?php echo $qry[0]->traderFullName?></p>
                                <p id="tr_place"><?php echo $qry[0]->traderLocation?></p>
                                <button class="btn btn-default btncons" id="oth_trad_phone"><img id="img_contno" src="<?php echo base_url()?>img/post-detail-phone.png"> <span id="poster_contact"><?php echo $qry[0]->traderContactNum?></span></button>

                                
                              </center>
                              <div class="row">
                                
                                <div class="col-sm-6" >
                                    <div class="form-group">
                                        <i id="mail_ic" class="fa fa-envelope" aria-hidden="true"></i>
                                       <button class="btn btn-default btncons" id="catdet_mailbtn" <?php if(isset($_SESSION['logged_in'])){?> data-target="#myModal" <?php } else {?> disabled <?php } ?>>Mail</button>

                                         <!--button class="btn btn-default btncons"  id="mailbtn" <?php if(isset($_SESSION['logged_in'])){?>  data-target="#myModal" <?php } else {?> disabled <?php } ?>>Mail</button-->
                                   </div>
                                </div>
                                 <div class="col-sm-6" >
                                    <div class="form-group">
                                        <i id="chat_ic" class="fa fa-comments" aria-hidden="true"></i>
                                         <button class="btn btn-default btncons" id="catdet_chatbtn">Chat</button>
<!--                                        <button class="btn btn-default btncons" id="chatbtn">Chat</button>-->
                                    </div>
                                </div> 

                            </div>
                              
                             
                              
                           
                           <div class="row">
                                
                               <div class="col-sm-3" >
                      <?php
                      if($qry[0]->socialWeb != '')
                      {
                          ?>
                     <img src="<?php echo base_url();?>img/social-web.png" id="web_socialimg">
                     <?php
                      }
                      ?>
                  </div>
                  <div class="col-sm-3" >
                      <?php
                      if($qry[0]->socialtwitter != '')
                      {
                          ?>
                     <img src="<?php echo base_url();?>img/social-twitter.png" id="tw_socialimg">
                     <?php
                      }
                      ?>
                     
                  </div>
                  <div class="col-sm-3" >
                      <?php
                      if($qry[0]->socialFb != '')
                      {
                          ?>
                     <img src="<?php echo base_url();?>img/social-facebook.png" id="fb_socialimg">
                     <?php
                      }
                      ?>
                     
                  </div>
                  <div class="col-sm-3" >
                      <?php
                      if($qry[0]->socialInsta != '')
                      {
                          ?>
                     <img src="<?php echo base_url();?>img/social-instagram.png" id="inst_socialimg">
                     <?php
                      }
                      ?>
                    
                  </div>
                   <div class="col-sm-3" >
                      <?php
                      if($qry[0]->socialSnap != '')
                      {
                          ?>
                     <img src="<?php echo base_url();?>img/social-snapchat.png" id="snap_socialimg">
                     <?php
                      }
                      ?>
                    
                  </div> 
                                
                                
                            </div>
                               <div id="othdetp">ghghghgfghfhgffhfjfghjfhgfhgfhfghfgfgfgfgfhgfhghgfjhjhjhgjghkghkg</div> 
                        </div>
                        <div class="widget" id="widget_otheradsrch">
                           <p id="adsrchtitle">Advanced Search</p>
                           
                           <select class="form-control input-lg" name="category" id="srchcat1">
                                         <option value="Car">Car</option>
                                         <option value="Bike">Bike</option>


                                 </select>
                                <br>
                                <select class="form-control input-lg" name="category" id="srchcat2">
                                         <option value="Car">Audi</option>

                                 </select>
                                <br>
                                <select class="form-control input-lg" name="category" id="srchcat3">
                                         <option value="Car">Model</option>

                                 </select>
                                <br>
                                <select class="form-control input-lg" name="category" id="srchcat4">
                                         <option value="Car">From Year</option>

                                 </select>

                                <br>
                                <select class="form-control input-lg" name="category" id="srchcat5">
                                         <option value="Car">To Year</option>


                                 </select>
                                <br>
                           <button type="button" class="btn btn-default" id="btnsrchpost">SEARCH</button>
                        </div><!-- end widget -->
                        
                 
                    </div><!-- end col -->
                    
                    <!-- end sidebar -->
                    
                    <div class="col-sm-9" id="imgpost_div">
                                 <div class="row">
               <?php
                    foreach($qry as $row)
                    {
                        ?>
                    
                            <div class="col-sm-4 othertra_div_imgs">
                                    
                                    <img src="<?php echo base_url().'uploads/product_images/'.$row->productImage?>" class="wpost_imgs">
                                     
                                    <div class="othertradet_details">
                                       <span class="othertrprdpr">Product</span>&nbsp;&nbsp;<b><span class="prdt_price_details"><?php echo $row->productName?></span></b><br>
                                        <span class="othertrdpr">Price</span>&nbsp;&nbsp;<b><span class="price_span"><?php echo $row->productPrice?></span></b>
                                        <hr class="otherhr">
                                       
                                        
                                        <p class="otherprof_pdate">12 dec 2017</p>
                                        <p class="otherprof_cnt">120 view</p>
                                        
                                    </div>
                                </div>
                             <?php
                    }
                    ?> 
                
             
            </div>
            <!-- end row -->  
        
                    </div><!-- end col -->
                    
                </div><!-- end row -->   
                <div class="row">
                        <div id="pagination">
                            <ul class="tsc_pagination">

                            <!-- Show pagination links -->
                            <?php foreach ($links as $link) {
                            echo "<li>". $link."</li>";
                            } ?>
                            </ul>
                            </div>
                    </div>
            </div><!-- end container -->
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
                     
                        
                     <form role="form" class="form-horizontal" action="<?php echo base_url();?>Trader/mail_trader/<?php echo $qry[0]->traderID;?>" method="post">
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
                $('#mailbtn').click(function(){
                 
                    $('#testModal').modal('show');
                    $('#myModal').modal('show');
                 });
            });
             
            </script>
        
       
        
    