<!-- start section -->
<section class="section white-backgorund" id="sec_prof">
   <div class="container">
      <div class="row">
         <!-- start sidebar -->
         <div class="col-sm-3" id="profile_div">
       
        <div class="widget" id="watchl_widget_advsrch">
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
                            <div id="watch_title_div1">
                                <?php
                                                if(isset($watch_qry))
                                                {
                                                    
                                                  
                                                       ?>
                                                    <h5 id="watch_list_title">WATCH LIST</h5><hr id="watch_list_hr"><b><span id="watch_prdt_cnt">(<?php echo $watch_qry[0]->watchlistCount?> Products Listed)</span></b>
                                                    <?php
                                                }
                                              else
                                              {
                                                  ?>
                                                 <h5 id="watch_list_title">WATCH LIST</h5><hr id="watch_list_hr"><b><span id="watch_prdt_cnt">(0 Products Listed)</span></b>
                                                  <?php
                                              }
                                              ?>
                            </div>
                            
                               
                            
                        </div><!-- end row -->

            
         </div>
         <div class="col-sm-9 trimgpost_div" id="watch_main_div">
            <div class="row">
               <?php
                    foreach($qry as $row)
                    {
                        ?>
                     
                          
                            <div class="col-sm-4 watchlist_div_imgs">
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
                                        
                                        $product_name='dfgfd';
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
                                    }
                                    
                                    
                                    
                                    if($row->productCSubmitDate != '')
                                    {
                                    $product_submitdate = $row->productCSubmitDate;
                                    }
                                    else if($row->productBSubmitDate != '')
                                    {
                                    $product_submitdate = $row->productBSubmitDate;
                                    }
                                    else if($row->productBTSubmitDate != '')
                                    {
                                    $product_submitdate = $row->productBTSubmitDate;
                                    }
                                    else if($row->productWSubmitDate != '')
                                    {
                                    $product_submitdate = $row->productWSubmitDate;
                                    }
                                    else if($row->productVSubmitDate != '')
                                    {
                                    $product_submitdate = $row->productVSubmitDate;
                                    }
                                    else if($row->productPRSubmitDate != '')
                                    {
                                    $product_submitdate = $row->productPRSubmitDate;
                                    }
                                    else if($row->productPSubmitDate != '')
                                    {
                                    $product_submitdate = $row->productPSubmitDate;
                                    }
                                    else if($row->productNPSubmitDate != '')
                                    {
                                    $product_submitdate = $row->productNPSubmitDate;
                                    }
                                    else if($row->productMNSubmitDate != '')
                                    {
                                    $product_submitdate = $row->productMNSubmitDate;
                                    }
                                    else
                                    {
                                        
                                        $product_submitdate='';
                                    }
                                    
                                    
                                    if($row->cartCType != '')
                                    {
                                    $cart_type = $row->cartCType;
                                    }
                                    else if($row->cartBType != '')
                                    {
                                    $cart_type = $row->cartBType;
                                    }
                                    else if($row->cartBTType != '')
                                    {
                                    $cart_type = $row->cartBTType;
                                    }
                                    else if($row->cartWType != '')
                                    {
                                    $cart_type = $row->cartWType;
                                    }
                                    else if($row->cartVType != '')
                                    {
                                    $cart_type = $row->cartVType;
                                    }
                                    else if($row->cartPRType != '')
                                    {
                                    $cart_type = $row->cartPRType;
                                    }
                                    else if($row->cartPHType != '')
                                    {
                                    $cart_type = $row->cartPHType;
                                    }
                                    else if($row->cartNPType != '')
                                    {
                                    $cart_type = $row->cartNPType;
                                    }
                                    else
                                    {
                                        
                                        $cart_type='';
                                    }
                                    ?>
 
                                <a href="<?php echo base_url()?>Trader/category_details/<?php echo $row->productCategoryID;?>/<?php echo $row->productID;?>"><img src="<?php echo $img;?>" class="wpost_imgs"></a>
                                     
                                    <div class="watchtradet_details">
                                       <span class="wlprdpr">Product</span>&nbsp;&nbsp;<b><span class="prdt_price_details"><?php echo $product_name;?></span></b><br>
                                        <span class="wlprdpr">Price</span>&nbsp;&nbsp;<b><span class="price_span"><?php echo $product_price;?></span></b>
                                        <hr class="homehr">
                                        <?php
                                    if($row->traderImage != '')
                                    {
                                        ?>
                                        <a href="<?php echo base_url()?>trader/traderdetails/<?php echo $row->traderID;?>"><img src="<?php echo $row->traderImage?>" class="wl_user_prof"></a>
                                     <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <img src="<?php echo base_url()?>img/userProfileIcon_gray.png" class="wl_user_prof">
                                    <?php    
                                    }
                                    ?>
                                  
                                        <p class="wl_uname"><?php echo $row->traderFullName?></p>
                                        <p class="wl_uplace"><?php echo $row->traderLocation?></p>
                                        <?php
                                        $d = $product_submitdate;
                                        $d1 = strtotime($d);
                                        
                                        ?>
                                        <p class="wl_udate"><?php echo date('d M Y',$d1)?></p>
                                    </div>
                                </div>
                             <?php
                    }
                    ?> 
                
             
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
                          foreach($recentqry as $row)
                          {
                              ?>
                           
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
                                        
                                        $product_name='dfgfd';
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
                                    }
                                    if($row->cartCType != '')
                                    {
                                    $cart_type = $row->cartCType;
                                    }
                                    else if($row->cartBType != '')
                                    {
                                    $cart_type = $row->cartBType;
                                    }
                                    else if($row->cartBTType != '')
                                    {
                                    $cart_type = $row->cartBTType;
                                    }
                                    else if($row->cartWType != '')
                                    {
                                    $cart_type = $row->cartWType;
                                    }
                                    else if($row->cartVType != '')
                                    {
                                    $cart_type = $row->cartVType;
                                    }
                                    else if($row->cartPRType != '')
                                    {
                                    $cart_type = $row->cartPRType;
                                    }
                                    else if($row->cartPHType != '')
                                    {
                                    $cart_type = $row->cartPHType;
                                    }
                                    else if($row->cartNPType != '')
                                    {
                                    $cart_type = $row->cartNPType;
                                    }
                                    else
                                    {
                                        
                                        $cart_type='';
                                    }
                                    ?>

                        <div class="item<?php echo $item_class; ?>">
                           
                           <div class="col-lg-2 rccol"><img src="<?php echo $img;?>"  class="recent_slimgs" >
                            <div class="mostv_prddiv" >
                                <p class="most_prd">Product</p><span class="most_prd_vals"><?php echo $product_name;?></span>
                                <p class="most_prd_price">Price</p><span class="most_prd_vals"><?php echo $product_price;?></span>
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