<?php
 $this->view('trader/trader_header'); 
 ?> 
        <!-- start section -->
        <section class="section white-backgorund" id="sec_prof">
            <div class="container">
                <div class="row">
                    <!-- start sidebar -->
                    <div class="col-sm-3" id="profile_div">
                       
                        
                        <div class="widget" id="widget_otherprof">
                            
                            
                              <img src="img/userProfileIcon_gray.png" id="otheruser_prof">
                              <center>
                                <p id="tr_othname">test ttt</p>
                                <p id="tr_place">Dubai UAE</p>
                                <p id="tr_phone">9876543210</p>
                              </center>
                              <div class="row">
                                
                                <div class="col-sm-6" >
                                    <div class="form-group">
                                        <i id="mail_ic" class="fa fa-envelope" aria-hidden="true"></i>
                                        <button class="btn btn-default btncons" id="mailbtn">Mail</button>
                                   </div>
                                </div>
                                 <div class="col-sm-6" >
                                    <div class="form-group">
                                        <i id="chat_ic" class="fa fa-comments" aria-hidden="true"></i>
                                        <button class="btn btn-default btncons" id="chatbtn">Chat</button>
                                    </div>
                                </div> 

                            </div>
                              
                             
                              
                           
                           <div class="row">
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
                            <div class="col-sm-3" class="clpostimgs">
                                    <img src="img/no_preview.png" class="post_imgs"> 
                                    <div class="other_prddet">
                                        <div class="other_div1">
                                            <span class="other_prd">Product</span><span class="other_val">Audi Q7</span><br>
                                             <span class="other_prd">Price</span><span class="other_val" id="sp_price">AED 277</span>
                                        </div>
                                        
                                        <hr class="other_tr_hr">
                                        <div class="other_div2">
                                             <span class="other_date">11 November 2017</span>
                                             <span class="other_view">120 View</span>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-sm-3" class="clpostimgs">
                                    <img src="img/no_preview.png" class="post_imgs"> 
                                    <div class="other_prddet">
                                        <div class="other_div1">
                                            <span class="other_prd">Product</span><span class="other_val">Audi Q7</span><br>
                                             <span class="other_prd">Price</span><span class="other_val" id="sp_price">AED 277</span>
                                        </div>
                                        
                                        <hr class="other_tr_hr">
                                        <div class="other_div2">
                                             <span class="other_date">11 November 2017</span>
                                             <span class="other_view">120 View</span>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-sm-3" class="clpostimgs">
                                    <img src="img/no_preview.png" class="post_imgs"> 
                                    <div class="other_prddet">
                                        <div class="other_div1">
                                            <span class="other_prd">Product</span><span class="other_val">Audi Q7</span><br>
                                             <span class="other_prd">Price</span><span class="other_val" id="sp_price">AED 277</span>
                                        </div>
                                        
                                        <hr class="other_tr_hr">
                                        <div class="other_div2">
                                             <span class="other_date">11 November 2017</span>
                                             <span class="other_view">120 View</span>
                                        </div>
                                        
                                    </div>
                                </div>
                      
                            
                        </div><!-- end row -->
                    </div><!-- end col -->
                    
                </div><!-- end row -->                
            </div><!-- end container -->
        </section>
        <section class="section white-backgorund" id="pag_secdiv">
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
       <?php $this->view('trader/trader_footer');  ?> 
        
       
        
    