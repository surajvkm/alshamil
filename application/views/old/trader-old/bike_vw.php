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
                            <div id="category_title_div">
                                <h5 id="category_title">BIKE</h5><hr id="category_hr"><b><span id="category_cnt">(<b>3</b> Product Listed)</span></b>
                            </div>
                            
                        </div><!-- end row -->
                    </div>
                    <div class="col-sm-9" id="imgpost_div">
                        
                        <div class="row">
                            <div class="col-sm-3" class="catpostimgs">
                                    <img src="img/no_preview.png" class="post_imgs"> 
                                    <div class="tradet_details">
                                       <span class="wlprdpr">Product</span>&nbsp;&nbsp;<b><span class="prdt_price_details">Audi S8-2015</span></b><br>
                                        <span class="wlprdpr">Price</span>&nbsp;&nbsp;<b><span class="price_span">AED 23500</span></b>
                                        <hr class="cat_hr">
                                        <img src="img/userProfileIcon_gray.png" class="cat_user_prof">
                                        <p class="cat_uname">Abdul Khader</p>
                                        <p class="cat_uplace">Dubai</p>
                                        <p class="cat_udate">21 Nov 2017</p>
                                    </div>
                                </div>
                                <div class="col-sm-3" class="catpostimgs">
                                    <img src="img/no_preview.png" class="post_imgs"> 
                                    <div class="tradet_details">
                                       <span class="wlprdpr">Product</span>&nbsp;&nbsp;<b><span class="prdt_price_details">Audi S8-2015</span></b><br>
                                        <span class="wlprdpr">Price</span>&nbsp;&nbsp;<b><span class="price_span">AED 23500</span></b>
                                        <hr class="cat_hr">
                                        <img src="img/userProfileIcon_gray.png" class="cat_user_prof">
                                        <p class="cat_uname">Abdul Khader</p>
                                        <p class="cat_uplace">Dubai</p>
                                        <p class="cat_udate">21 Nov 2017</p>
                                    </div>
                                </div>
                                <div class="col-sm-3" class="catpostimgs">
                                    <img src="img/no_preview.png" class="post_imgs"> 
                                    <div class="tradet_details">
                                       <span class="wlprdpr">Product</span>&nbsp;&nbsp;<b><span class="prdt_price_details">Audi S8-2015</span></b><br>
                                        <span class="wlprdpr">Price</span>&nbsp;&nbsp;<b><span class="price_span">AED 23500</span></b>
                                        <hr class="cat_hr">
                                        <img src="img/userProfileIcon_gray.png" class="cat_user_prof">
                                        <p class="cat_uname">Abdul Khader</p>
                                        <p class="cat_uplace">Dubai</p>
                                        <p class="cat_udate">21 Nov 2017</p>
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
      <?php $this->view('trader/trader_footer'); ?>
       
       
        
    