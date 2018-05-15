<?php
$this->view('trader/trader_header'); 
 ?> 
        <!-- start section -->
        <section class="section white-backgorund" id="sec_prof">
            <div class="container">
                <div class="row">
                    <!-- start sidebar -->
                    <div class="col-sm-3" id="profile_div">
                        
                        
                        <div class="widget" id="widget_advsrch">
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
                                <button type="button" class="btn btn-default" id="btnsrchpost">SEARCH</button>
                        </div><!-- end widget -->
                        
                 
                    </div><!-- end col -->
                    <!-- end sidebar -->
                    <div class="col-sm-9">
                        
                        <div class="row">
                            <div id="category_det_title_div">
                                <h5 id="category_det_title">AUDI Q7 3.0L-2013</h5><hr id="category_det_hr"><b><span id="category_det_price"><b id="cat_det_amt">AED 155,000</b></span></b>
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
                                       <img src="img/no_preview.png"  id="cat_trader_videos" >
                                    </div>

                                    <div class="item">
                                       <img src="img/no_preview.png"  id="cat_trader_videos" >
                                    </div>

                                    <div class="item">
                                       <img src="img/no_preview.png"  id="cat_trader_videos" >
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
                                    <img src="img/no_preview.png" id="five_post_imgs1">
                                    <img src="img/no_preview.png" id="five_post_imgs2">
                                    <img src="img/no_preview.png" id="five_post_imgs3">
                                    <img src="img/no_preview.png" id="five_post_imgs4"> 
                                     <img src="img/no_preview.png" id="five_post_imgs5"> 
                                </div>
                                
                                
                        </div><!-- end row -->
                        </div>
                        <div class="col-sm-4">
                            <div class="row" id="cat_owner">
                                <img src="img/userProfileIcon_gray.png" id="owner_prof">
                              
                                <p id="owner_name">test ttt</p>
                                <p id="owner_place">Dubai UAE</p>
                                <hr id="cat_detail_hr">
                                <p id="owner_post_date">Posted on 6th October 2017</p>
                                <span id="poster_contact">9876543210</span>
                                <div class="row">
                                
                                <div class="col-sm-6" >
                                    <div class="form-group">
                                        <i id="mail_ic" class="fa fa-envelope" aria-hidden="true"></i>
                                        <button class="btn btn-default btncons" id="catdet_mailbtn">Mail</button>
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
                                <button id="shared_btn"><img id="img_sharedr" src="img/driv_share_font.png">Share</button><br>
                                <button id="wishlist_btn"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;&nbsp;Watch List</button><br>
                                <button id="addcart_btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;&nbsp;Add to Cart</button>
                            </div>
                            
                            
                        </div>
                    </div><!-- end col -->
                    
                </div><!-- end row -->                
            </div><!-- end container -->
        </section>
        <section class="section white-backgorund vehhis" >
            <p id="history_title" >VEHICLE HISTORY</p>
            <div id="history_descr_div">
                <p id="hist_descr">
                    P for Paragraph, BR for Break, and all the other tags for creating, aligning and breaking up ... a block-level element, simply defines a block of content in the page. ... You can set the alignment of any HTML element using the text-align style rule. ..... For example, the following code produces a nonsense poem of one long line:
                </p>
            </div>
            
        </section>
        
        <!-- end section -->
        <section class="section white-backgorund" id="sec_recviews">
            <p id="recent_title" >RECENTLY VIEWED ITEMS</p>
            <div class="container">
                    
                    <div id="myCarousel"  class="carousel slide" data-ride="carousel">
                      <!-- Indicators -->
                      <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                         <li data-target="#myCarousel" data-slide-to="3"></li>
                      </ol>

                      <!-- Wrapper for slides -->
                      <div class="carousel-inner">
                        <div class="item active">
                          <img src="img/no_preview.png"  class="recent_slimgs" >
                        </div>

                        <div class="item">
                          <img src="img/visa.png" class="recent_slimgs" >
                        </div>

                        <div class="item">
                          <img src="img/no_preview.png"  class="recent_slimgs" >
                        </div>
                          <div class="item">
                          <img src="img/no_preview.png"  class="recent_slimgs" >
                        </div>
                          
                      </div>

                      <!-- Left and right controls -->
                      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
             </div>

        </section>      
       <?php $this->view('trader/trader_footer'); ?>
       
       
        
    