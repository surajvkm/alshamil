<?php
 $this->view('trader/trader_header');  
 ?> 
        <!-- start section -->
        <section class="section white-backgorund" id="sec_prof">
            <div class="container">
                <div class="row">
                    <!-- start sidebar -->
                    <div class="col-sm-3" id="profile_div">
                        <div class="widget">
                            <i id="plus_square" class="fa fa-plus-square" aria-hidden="true"></i>
                            <button type="button" onclick="location.href='add_post'" class="btn btn-default" id="btnadpost">Add Post</button>
                        </div><!-- end widget -->
                        
                        <div class="widget" id="widget_myprof">
                            <p id="prof_imgp">
                                
                                <i id="usericon"  class="fa fa-user"></i>
                                <i  id="pencilicon" class="fa fa-pencil"></i>
                                <a href="#" id="prof_editanc">Edit</a> 
                            </p>
                            
                              <img src="img/userProfileIcon_gray.png" id="user_prof">
                              <center>
                                <p id="tr_name">Test T</p>
                                <p id="tr_place">Dubai UAE</p>
                              </center>
                           <hr>
                           <p id="days_bal">You have 300 days left</p>
                           <hr>
                           <p id="post_bal">You have 140 post balance</p>
                           <div id="payamtdiv">
                               <span class="spanamts">Total amount paid:</span><b>AED 23840</b>
                               <hr>
                               <span class="spanamts">Total post:</span><b>75</b>
                                <hr>
                                <span class="spanamts">Sold:</span><b>50</b>
                           </div>
                          
                           <div class="row" id="postr_social">
                                <div class="col-sm-3" >
                                   
                                        
                                         <img src="img/websiteimg.png" id="web_socialimg">
                                   
                                </div>
                                <div class="col-sm-3" >
                                    
                                        <img src="img/facebook_new.png" id="fb_socialimg">
                                  
                                </div>
                                <div class="col-sm-3" >
                                    
                                        <img id="inst_socialimg" src="img/instagram_new.png">
                                    
                                </div>
                                <div class="col-sm-3" >
                                    
                                        <img id="snap_socialimg" src="img/sanpchat_new.png">
                                  
                                </div>
                            </div>
                           
                        </div>
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
                    <div class="col-sm-9" id="imgpost_div">
                        
                        <div class="row">
                            <div id="reject_status_divs">
                                <button class="reject_status_btns" id="reject_appbtn">Approved</button>
                                <button class="reject_status_btns" id="reject_pendbtn">Pending</button>
                                <button class="reject_status_btns" id="reject_rejbtn">Rejected</button>
                            </div>
                            
                               
                            
                        </div><!-- end row -->
                    </div>
                    <div class="col-sm-9" id="imgpost_div">
                        
                        <div class="row">
                            <div class="col-sm-3" id="clpostimgs1">
                                    <img src="img/no_preview.png" class="post_imgs"> 
                                    <div class="reject_img_details" id="reject_img_details_1">
                                    <span class="prdpr">Product</span>&nbsp;&nbsp;<b><span class="prdt_price_details">Audi S8-2015</span></b><br>
                                     <span class="prdpr">Price</span>&nbsp;&nbsp;<b><span class="price_span">AED 23500</span></b>
                                     <hr class="homehr">
                                     
                                     <p id="rejpost_udate">21 Nov 2017</p>
                                     <i class="fa fa-exclamation-triangle"  onclick="show_reject('1')" aria-hidden="true"></i>
                                     <div class="reject"  id="reject_1">
                                         <span>dgfdgdfhdfhfhdfdfhjdgfggfgsdfsdggfhdgdfdgfhfh</span>
                                     </div>
                                  </div>
                                </div>
                                <div class="col-sm-3" id="clpostimgs2">
                                    <img src="img/no_preview.png" class="post_imgs"> 
                                    <div class="reject_img_details" id="reject_img_details_2">
                                    <span class="prdpr">Product</span>&nbsp;&nbsp;<b><span class="prdt_price_details">Audi S8-2015</span></b><br>
                                     <span class="prdpr">Price</span>&nbsp;&nbsp;<b><span class="price_span">AED 23500</span></b>
                                     <hr class="homehr">
                                     
                                     <p id="rejpost_udate">21 Nov 2017</p>
                                     <i class="fa fa-exclamation-triangle" onclick="show_reject('2')"  aria-hidden="true"></i>
                                     <div class="reject" id="reject_2">
                                         <span>dgfdgdfhdfhfhdfdfhjdgfggfgsdfsdggfhdgdfdgfhfh</span>
                                     </div>
                                  </div>
                                </div>
                                <div class="col-sm-3" id="clpostimgs3">
                                    <img src="img/no_preview.png" class="post_imgs"> 
                                    <div class="reject_img_details" id="reject_img_details_3">
                                    <span class="prdpr">Product</span>&nbsp;&nbsp;<b><span class="prdt_price_details">Audi S8-2015</span></b><br>
                                     <span class="prdpr">Price</span>&nbsp;&nbsp;<b><span class="price_span">AED 23500</span></b>
                                     <hr class="homehr">
                                     
                                     <p id="rejpost_udate">21 Nov 2017</p>
                                     <i class="fa fa-exclamation-triangle" onclick="show_reject('3')"  aria-hidden="true"></i>
                                     <div class="reject" id="reject_3">
                                         <span>dgfdgdfhdfhfhdfdfhjdgfggfgsdfsdggfhdgdfdgfhfh</span>
                                     </div>
                                  </div>
                                </div>
                      
                            
                        </div><!-- end row -->
                    </div><!-- end col -->
                    
                </div><!-- end row -->                
            </div><!-- end container -->
        </section>
       
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
        <script>
            function show_reject(x)
            {
                 $('#reject_'+x).slideToggle();
                 $('#reject_img_details_'+x).css('border-bottom-left-radius','0px');
                 $('#reject_img_details_'+x).css('border-bottom-right-radius','0px');
            }
            $(document).ready(function(){
                
            });
        </script>
       <?php $this->view('trader/trader_footer');  ?> 
       
       
        
    