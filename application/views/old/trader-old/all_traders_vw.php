
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
                    <div class="col-sm-9" id="all_tradtit_div">
                        
                        <div class="row">
                            <div id="alltrad_title_div">
                                <h5 id="alltrad_title">TRADERS</h5><hr id="alltrad_hr"><span id="alltrad_cnt">(<b><?php echo $count?></b><span id="sp_all_tr"> Traders</span>)</span>
                            </div>
                            
                               
                            
                        </div><!-- end row -->
                    </div>
                    <div class="col-sm-9 alltr_detail_div" id="alltrad_maindiv">
                        
                       <?php
                       foreach($records as $r)
                       {
                        ?>
                                <div class="col-sm-3 clpostimgs">
                                   
                                    <div class="all_tradet_details">
                                      <a href="<?php echo base_url()?>admin/Dashboard/plan_profile/<?php echo $r->traderID?>/<?php echo $r->planID?>">
                                       <?php
                                    if($r->traderImage != '')
                                    {
                                        ?>
                                       
                                         <img src="<?php echo $r->traderImage?>" class="alltr_user_prof">
                                     <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <img src="<?php echo base_url()?>img/userProfileIcon_gray.png" class="alltr_user_prof">
                                    <?php    
                                    }
                                    ?>
                                        
                                        <p class="alltr_uname"><?php echo $r->traderFullName?></p>
                                        <p class="alltr_uplace"><?php echo $r->traderLocation?></p>
                                        </a>
                                    </div>
                                </div>
                        <?php
                       }
                       ?>
                            <!--div class="col-sm-3" class="clpostimgs">
                                   
                                    <div class="all_tradet_details">
                                       
                                        <img src="img/userProfileIcon_gray.png" class="alltr_user_prof">
                                        <p class="alltr_uname">Abdul Khader</p>
                                        <p class="alltr_uplace">Dubai</p>
                                        
                                    </div>
                                </div>
                                <div class="col-sm-3" class="clpostimgs">
                                    
                                    <div class="all_tradet_details">
                                       
                                        <img src="img/userProfileIcon_gray.png" class="alltr_user_prof">
                                        <p class="alltr_uname">Abdul Khader</p>
                                        <p class="alltr_uplace">Dubai</p>
                                        
                                    </div>
                                </div>
                                <div class="col-sm-3" class="clpostimgs">
                                  
                                    <div class="all_tradet_details">
                                       
                                        <img src="img/userProfileIcon_gray.png" class="alltr_user_prof">
                                        <p class="alltr_uname">Abdul Khader</p>
                                        <p class="alltr_uplace">Dubai</p>
                                        
                                    </div>
                                </div-->
                                
                            
                        
                    </div><!-- end col -->
            
                </div><!-- end row -->                
            </div><!-- end container -->
        </section>
        
        <section class="section white-backgorund" id="watch_sec_reviews">
            <p id="recent_title" >RECENTLY VIEWED ITEMS</p>
            <div class="container">
                    
               <div class="owl-one owl-carousel owl-theme">
                     <?php
                        $item_class = ' active';
                        foreach($recentqry as $r)
                        {
                            ?>
                    
                        <div class="item<?php echo $item_class; ?>">

                                       <img src="<?php echo $r->Image;?>"  class="recent_slimgs" >
                                        <div class="mostv_prddiv" >
                                            <p class="most_prd">Product</p><span class="most_prd_vals"><?php echo $r->Brand." - ".$r->Model?></span>
                                            <p class="most_prd_price">Price</p><span class="most_prd_vals"><?php echo $r->Price?></span>
                                        </div>
                                    

                                       </div>

                                      <?php
                                      $item_class = '';
                                      }
                                      ?>
                    </div>
             </div>

        </section>      
    
       <script>
            
            $(document).ready(function()
            {
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
                
            });
        </script>
       
        
    