
        <!-- start section -->
        <section class="section white-backgorund" id="sec_prof">
            <div class="container">
                <div class="row">
                   
                    <div class="col-sm-9" id="main_cart_div">
                        
                        <div class="row">
                            <div id="cart_title_div">
                                <?php
                               
                                    if(isset($cart_qry))
                                    {
                                        ?>
                                         <h5 id="cart_title">CHECKOUT</h5><hr id="cart_hr"><b><span id="cart_cnt">(<b><?php echo $cart_qry[0]->cartlistCount?></b> items)</span></b>
                                         <?php
                                    }
                                    else
                                    {
                                        ?>
                                         <h5 id="cart_title">CHECKOUT</h5><hr id="cart_hr"><b><span id="cart_cnt">(<b>0</b> items)</span></b>
                                         <?php
                                    }
                               ?>
                                
                            </div>
                            
                        </div><!-- end row -->
                    </div>
                     <?php
                    foreach($qry as $row)
                    {
                     ?>  
                    <div class="col-sm-9 sub_cart_div">
                        
                        <div class="row">
                            <div id="prdt_cart_details_div">
                                <div class="col-sm-3">
                                 
                                   <img src="<?php echo base_url().'uploads/product_images/'.$row->productImage?>" id="prdt_crt_img">
                                </div>
                                
                                
                                <div class="col-sm-6" id="product_details_div">
                                    <span id="cartprdpr1">Product&nbsp;&nbsp;<b><span class="prdt_price_details" id="cart_product"><?php echo $row->productName?></span></b></span><br>
                                    <span id="cartprdpr2">Price&nbsp;&nbsp;<b><span class="price_span"  id="cart_price"><?php echo $row->productPrice?></span></b></span>
                                    <hr class="hr_checkout">
                                    <?php
                                    if($row->traderImage != '')
                                    {
                                        ?>
                                         <img src="<?php echo base_url().'uploads/trader_images/'.$row->traderImage?>" id="cart_user_prof">
                                     <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <img src="<?php echo base_url()?>img/userProfileIcon_gray.png" id="cart_user_prof">
                                    <?php    
                                    }
                                    ?>
                                    
                                   
                                    <p id="cart_uname"><?php echo $row->traderFullName?></p>
                                    <p id="cart_uplace"><?php echo $row->traderLocation?></p>
                                    
                                </div>
                                
                                
                            </div>
                            
                            
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    <!--div class="col-sm-9" id="sub_cart_div">
                        
                        <div class="row">
                            <div id="prdt_cart_details_div">
                                <div class="col-sm-3">
                                  <img src="img/no_preview.png" id="prdt_crt_img">
                                </div>
                                
                                <div class="col-sm-6" id="product_details_div">
                                    <span id="cartprdpr1">Product&nbsp;&nbsp;<b><span class="prdt_price_details" id="cart_product">Audi S8-2015</span></b></span><br>
                                    <span id="cartprdpr2">Price&nbsp;&nbsp;<b><span class="price_span"  id="cart_price">AED 23500</span></b></span>
                                    <hr class="hr_checkout">
                                    <img src="img/userProfileIcon_gray.png" id="cart_user_prof">
                                    <p id="cart_uname">Abdul Khader</p>
                                    <p id="cart_uplace">Dubai</p>
                                </div>
                               
                                
                                
                            </div>
                            
                            
                        </div>
                    </div-->
                    <div class="col-sm-9">
                        <hr class="chkhr">
                    </div>
                    <div class="col-sm-9" id="cart_tot_div">
                        <div class="row">
                            <p class="total_amt_p">Sub Total<span id="span_sub_tot">AED 1000<!--input type="text" id="txt_subtot"--></span></p>
                            <hr class="totals_hr">
                            <p class="total_amt_p">Eco Tax<span id="span_eco_tax">AED 2000<!--input type="text" id="txt_ecotax" value="1000"--></span></p>
                            <hr class="totals_hr">
                            <p class="total_amt_p">Vat 10%<span id="span_vat">AED 3000<!--input type="text" id="txt_vat" value="1000"--></span></p>
                            <hr class="totals_hr">
                            <p class="total_amt_p"><b>Total</b><span id="span_totamt">AED 4000<!--input type="text" id="txt_total"--></span></p>
                        </div>
                        
                    </div>
                    <div class="col-sm-9">
                        <hr class="chkhr">
                    </div>
                    
                <div class="col-sm-9" id="main_btns_div">
                    <div class="col-sm-3">
                        <button class="cart_btns" id="btncartonline"><i class="fa fa-credit-card" aria-hidden="true"></i>&nbsp;&nbsp;Online</button>
                    </div>
                    <div class="col-sm-3">
                        <button class="cart_btns" id="btncartalshamil"><img src="img/cart_alshamil_icon.png">Al-Shamil</button>
                    </div>
                   
                </div>
                </div>
            </div><!-- end container -->
        </section>
        
    <section class="section white-backgorund" id="sec_recviews">
            <p id="recent_title" >MOST VIEW</p>
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
            
                var sub_tot = 0;
                var grand_tot = 0;
              $('.price_span').each(function(){
                  var price = parseInt($(this).html());
                  sub_tot +=price;
                  
              }) ; 
              
              $('#txt_subtot').val(sub_tot);
              var eco_tax = parseInt($('#txt_ecotax').val());
              var vat = parseInt($('#txt_vat').val());
              var grand_tot = parseInt(grand_tot+sub_tot+eco_tax+vat);
              $('#txt_total').val(grand_tot);
            });
            </script>
            
    