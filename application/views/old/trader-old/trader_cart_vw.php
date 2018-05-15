
   <section class="section white-backgorund cart_msg">
            <div class="container">
                <div class="row">
                    <?php echo $this->session->flashdata('msg'); ?>
                </div>
            </div>
    </section>
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
                                         <h5 id="cart_title">YOUR CART</h5><hr id="cart_hr"><b><span id="cart_cnt">(<b><?php echo $cart_qry[0]->cartlistCount?></b> items)</span></b>
                                         <?php
                                    }
                                    else
                                    {
                                        ?>
                                         <h5 id="cart_title">YOUR CART</h5><hr id="cart_hr"><b><span id="cart_cnt">(<b>0</b> items)</span></b>
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
                    <div class="col-sm-9 sub_cart_div" id="sub_cart_div_<?php echo $row->productID?>">
                        
                        <div class="row">
                            <div id="prdt_cart_details_div">
                                <div class="col-sm-3">
                                    <a href="<?php echo base_url()?>Trader/category_details/<?php echo $row->productCategoryID;?>/<?php echo $row->productID;?>"><img src="<?php echo $img;?>" id="prdt_crt_img"></a>
                                </div>
                                
                                <div class="col-sm-3" id="product_details_div">
                                    <span id="cartprdpr1">Product&nbsp;&nbsp;<b><span class="prdt_price_details" id="cart_product"><?php echo $product_name;?></span></b></span><br>
                                    <span id="cartprdpr2">Price&nbsp;&nbsp;<b><span class="price_span"  id="cart_price">AED <?php echo $product_price?></span></b></span>
                                    <hr class="hr_cart">
                                    <?php
                                    if($row->traderImage != '')
                                    {
                                        ?>
                                    <a href="<?php echo base_url()?>trader/traderdetails/<?php echo $row->traderID;?>"><img src="<?php echo base_url().$row->traderImage?>" id="cart_user_prof"></a>
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
                                <div class="vl"></div>
                                <div class="col-sm-3" id="del_btn_div">
                                  
                                    <button class="cart_del_btns" onclick="cart_del('<?php echo $row->productID?>')">Delete</button>
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
                                  <img src="<?php echo base_url()?>img/no_preview.png" id="prdt_crt_img">
                                </div>
                                
                                <div class="col-sm-3" id="product_details_div">
                                    <span id="cartprdpr1">Product&nbsp;&nbsp;<b><span class="prdt_price_details" id="cart_product">Audi S8-2015</span></b></span><br>
                                    <span id="cartprdpr2">Price&nbsp;&nbsp;<b><span class="price_span"  id="cart_price">AED 23500</span></b></span>
                                    <hr class="hr_cart">
                                    <img src="<?php echo base_url()?>img/userProfileIcon_gray.png" id="cart_user_prof">
                                    <p id="cart_uname">Abdul Khader</p>
                                    <p id="cart_uplace">Dubai</p>
                                </div>
                                <div class="vl"></div>
                                <div class="col-sm-3" id="del_btn_div">
                                    <button class="cart_del_btns">Delete</button>
                                </div>
                                
                            </div>
                            
                            
                        </div>
                        
                </div-->
                <!--div class="col-sm-9" id="sub_cart_div">
                        
                        <div class="row">
                            <div id="prdt_cart_details_div">
                                <div class="col-sm-3">
                                  <img src="<?php echo base_url()?>img/no_preview.png" id="prdt_crt_img">
                                </div>
                                
                                <div class="col-sm-3" id="product_details_div">
                                    <span id="cartprdpr1">Product&nbsp;&nbsp;<b><span class="prdt_price_details" id="cart_product">Audi S8-2015</span></b></span><br>
                                    <span id="cartprdpr2">Price&nbsp;&nbsp;<b><span class="price_span"  id="cart_price">AED 23500</span></b></span>
                                    <hr class="hr_cart">
                                    <img src="<?php echo base_url()?>img/userProfileIcon_gray.png" id="cart_user_prof">
                                    <p id="cart_uname">Abdul Khader</p>
                                    <p id="cart_uplace">Dubai</p>
                                </div>
                                <div class="vl"></div>
                                <div class="col-sm-3" id="del_btn_div">
                                    <button class="cart_del_btns">Delete</button>
                                </div>
                                
                            </div>
                            
                            
                        </div-->
                        
                </div><!-- end row -->   
                <div class="col-sm-9" id="main_btns_div">
                    <div class="col-sm-3">
                        <button class="cart_btns" id="btnshopmore">Shop More</button>
                    </div>
                    <div class="col-sm-3">
                         <button class="cart_btns" id="btncheckout">Proceed to checkout</button>
                    </div>
                   
                </div>
            </div><!-- end container -->
        </section>
        
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
        
          function cart_del(product_id) 
          {
                swal({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Yes, I am sure!',
        cancelButtonText: "No, cancel it!",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function(isConfirm) {
        if (isConfirm) {
            swal({
                title: 'Shortlisted!',
                text: 'Your Product is deleted from cart!',
                type: 'success'
            }, function() {
                var data = 'product_id='+product_id;
                            $.ajax({
                            url: "<?php echo base_url(); ?>/Trader/del_cart",
                            data : data,
                            type: "POST",

                            success:function(data){
                                
                              if(data == 'success')
                              {
                                //  console.log(data);return false;
                                 setTimeout(function() 
                                {
                                  //location.reload();  //Refresh page
                                  location.href='<?php echo base_url()?>Trader/view_cart';
                                }, 1000); 
                            }
                                   
                            }

                            });
            });

        } else {
            swal("Cancelled", "Your product is safe :)", "error");
        }
    });
            
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
            
            $('#btncheckout').click(function(){
                location.href='<?php echo base_url()?>Trader/view_checkout';
            });
         });
         </script>
        
    