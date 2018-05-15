

    <!-- start section -->
    <div id ="car"></div>
<div id="sub">
    <section class="section white-background regsecdiv1">
         <div class="container">
                <div class="row" id="tr_hm_div">
                    <div class="col-sm-12 homcol12" >
                        
                        <div class="col-sm-8" >
<!--                            <div class="container" style="width: 792px;">-->
                              
                        <div class="owl-carousel owl-theme videosliderdiv">
                             <?php
                           
                           
                            foreach ($product as $result) 
                           {  
                           ?>
                            <div class="item">
                                <video  class="trader_videos" id="vd_<?php echo $result->productID?>_<?php echo $result->productCategoryID?>">
                                             <source src="<?php echo $result->productVideo; ?>" type="video/mp4">
                                        Your browser does not support the video tag.
                                        </video>
                                        <div class="vd_prdt_name">
                                          
                                            <p class="prdname"><i class="fa fa-play-circle fntpause"  onclick="video_toggle('<?php echo $result->productID?>','<?php echo $result->productCategoryID?>')" aria-hidden="true"></i><span id="sp_homename"><?php echo $result->productCBrand." ".$result->productCModel?></span></p>
                                            <input type="hidden" id="txtpid" value="<?php echo $result->productID?>">
                                                  <input type="hidden" id="txtcid" value="<?php echo $result->productCategoryID?>">
                                        </div>
                                        <div class="vd_prd_view"> 
                                            <p class="prdprice">Views<br><?php echo $result->productVideoCount?></p>
                                        </div>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                                
<!--                            </div>-->

                        </div>
                         <div class="col-sm-4" id="toptraders_div">
                             
                             <div id="top_traderhead"><span id="sptop">All Traders</span> <a id="user_anvietr" href="<?php echo base_url()?>Trader/view_all_traders" title="Click to view all traders">View All</a></div>
                                <?php  
                            foreach ($trader as $result) 
                           {  
                           ?>
                             <div class="traderss">
                                 <?php
                                 if($result->traderImage != '')
                                 {
                                 ?>
                                 <a href="<?php echo base_url()?>Trader/view_other_traders/<?php echo $result->traderID?> "><span id="sp_tr_img"><img src="<?php echo $result->traderImage; ?>" class="top_trimg" /></span></a>
                                   <?php
                                 }
                                   else
                                   {
                                       ?>
                                 <a href="<?php echo base_url()?>Trader/view_other_traders/<?php echo $result->traderID?>"><img src="<?php echo base_url();?>img/userProfileIcon_gray.png" class="top_trimg" onclick="<?php echo base_url()?>Trader"/></a>
                                        <?php
                                   }
                                       ?>
                                   
                                      
                                      
                                   
                                 
                                     <p class="top_trname"><?php echo $result->traderFullName;?></p>
                                     <p class="top_trplace"><?php echo $result->traderLocation;?></p>
                                     <p class="post_cnt"><?php echo $result->traderPostCount;?> </p>
                                     <p class="post_txt">Post</p>
                                     <hr class="tr_homhr">
                         
                             </div>
                              <?php }?> 
                         
                         </div>
                        

                        
                            
                    </div>
                </div>
            </div><!-- end container -->
       
                
            
                
            
    </section>

    <!-- end section -->
    <!-- start section -->

    <section class="section white-background regsecdiv2">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12" >
                        
                        
                            <h5 id="latposttitle">LATEST POST</h5>
                        <div class="row" id="latest_row_div">
                            <?php
                            foreach($qry as $row)
                            {
                                ?>
                           
                                <div class="col-sm-3 postcol">
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
                                    $currency = "AED";
                                    ?>
                                 <img src="<?php echo $img?>"  class="latest_postimgs" >
                                   <div class="img_details">
                                    <span class="prdpr">Product</span>&nbsp;&nbsp;<b><span class="prdt_price_details" style="word-wrap: break-word;"><?php echo $product_name?></span></b><br>
                                     <span class="prdpr">Price</span>&nbsp;&nbsp;<b><span class="price_span"><?php  echo $currency." ".$product_price?></span></b>
                                    
                                     <hr class="homehr">
                                     
                                     <div id="trader_details_div_<?php echo $row->traderID?>_<?php echo $row->productID?>" class="cart" onmouseover="show_cart_div('<?php echo $row->traderID?>','<?php echo $row->productID?>')" >
                                              <?php
                                            if($row->traderImage != '')
                                            {
                                                ?>
                                                 <img src="<?php echo $row->traderImage?>" class="post_user_prof">
                                             <?php
                                            }
                                            else
                                            {
                                                ?>
                                                 <img src="<?php echo base_url()?>img/userProfileIcon_gray.png" class="post_user_prof"  >
                                            <?php    
                                            }
                                            ?>

                                             <p class="post_uname"><?php echo $row->traderFullName?></p>
                                             <p class="post_uplace"><?php echo $row->traderLocation?></p>
                                             <?php
                                                $d = $row->postSubmissionOn;
                                                $d1 = strtotime($d);

                                                ?>
                                             <p class="post_udate"><?php echo date('d M Y',$d1)?></p>
                            
                                     </div>
                                        <div  class="sidecrtdiv" id="sidebar_<?php echo $row->traderID?>_<?php echo $row->productID?>" onmouseout="show_profile_div('<?php echo $row->traderID?>','<?php echo $row->productID?>')">
                                            <button id="tr_home_btn">
                                               
                                                <a class="anccls"  data-id="<?php echo $row->productID;?>" data-toggle="modal" target="#myModal">
                                                    <img id="img_sharedr" src="<?php echo base_url();?>img/post-share.png">
                                                </a><input type="hidden" id="hid_catid" value="<?php echo $row->productCategoryID?>">
                                               <?php
                                                if(isset($_SESSION['logged_in']))
                                                {
                                              
                                                ?>
                                                    <a href="<?php echo base_url();?>Trader/add_watch_list/<?php echo $row->productID?>/<?php echo $row->productCategoryID?>/<?php echo $row->postID?>">
                                                        <img id="wishlist_home" src="<?php echo base_url();?>img/post-add-watchlist.png">
                                                    </a>
                                                    <!--a class="anc_flag" data-toggle="modal" target="#flagModal"-->
                                                        <a class="anc_flag" onclick="show_flag_modal('<?php echo $row->productCategoryID?>','<?php echo $row->productID?>','<?php echo $cart_type?>','<?php echo $row->postID?>','<?php echo $row->traderID?>')">
                                                        <img id="flag_home" src="<?php echo base_url();?>img/post-flag.png">
                                                    </a>
                                                    <a onclick="check_als_cart('<?php echo $row->productCategoryID?>','<?php echo $row->productID?>','<?php echo $cart_type?>','<?php echo $row->postID?>')">
                                                       
                                                        <img id="shng_home" src="<?php echo base_url();?>img/post-add-cart.png">
                                                    </a>

                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                <a href="<?php echo base_url();?>Trader/login_view">
                                                    <img id="wishlist_home" src="<?php echo base_url();?>img/post-add-watchlist.png">
                                                </a>
                                                <a href="<?php echo base_url();?>Trader/login_view" class="anc_flag" >
                                                        <img id="flag_home" src="<?php echo base_url();?>img/post-flag.png">
                                                </a>
                                                <a href="<?php echo base_url();?>Trader/login_view">
                                                     <img id="shng_home" src="<?php echo base_url();?>img/post-add-cart.png">
                                                </a>
                                                <?php
                                                }
                                                ?>

                                            </button>
                                     
                                        </div>
<!--                                     <div id="cart_details_div_<?php echo $row->traderID?>" style="display: none;">-->
                      
                                   
                                  
                                </div>
                                </div>
                            <?php
                            }
                            ?>
                            
                
                            
                    </div>
                </div>
            </div><!-- end container -->
                
            
    </section>

    <!-- end section -->
    <section class="section white-backgorund" id="sec_recviews">
            <p id="recent_title" >MOST VIEW</p>
            <div class="container">
             <!-- Wrapper for slides -->
                 

               <!--div class="col-lg-6 col-md-offset-3"-->
                 <div class="owl-one owl-carousel owl-theme">
                     <?php
                        $item_class = ' active';
                        foreach($recentqry as $r)
                        {
                            ?>
                    
                        <div class="item<?php echo $item_class; ?>">

                                       <img src="<?php echo $r->productImage?>"  class="recent_slimgs" >
                                        <!--div class="mostv_prddiv" >
                                            <p class="most_prd">Product</p><span class="most_prd_vals"><?php echo $r->productName?></span>
                                            <p class="most_prd_price">Price</p><span class="most_prd_vals"><?php echo $r->productName?></span>
                                        </div-->
                                    <!--div class="mostv_prddiv" >
                                            <p class="most_prd">Product</p><span class="most_prd_vals"><?php echo $r->productName?></span>
                                            <p class="most_prd_price">Price</p><span class="most_prd_vals"><?php echo $r->productName?></span>
                                        </div-->

                                       </div>

                                      <?php
                                      $item_class = '';
                                      }
                                      ?>
                    </div>
                     
                <!--/div-->
                    </div>
             </div>

        </section> 
    <div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Share Through Social Icons</h4>  
                </div>  
                <div class="modal-body" id="employee_detail">  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>  
         <div id="cartModal" class="modal fade">  
            <div class="modal-dialog">  
                 <div class="modal-content">  
                      <div class="modal-header">  
                           <button type="button" class="close" data-dismiss="modal">&times;</button>  
                           <h4 class="modal-title">Contact Trader</h4>  
                      </div>  
                      <div class="modal-body" id="trader_detail">  
                      </div>  
                      <div class="modal-footer">  
                           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                      </div>  
                 </div>  
            </div>  
        </div>  
        <div id="flagModal" class="modal fade"> 
            
           <form role="form" class="form-horizontal" action="<?php echo base_url(); ?>Trader/save_flagpost" method="post">
            <div class="modal-dialog">  
                 <div class="modal-content">  
                      <div class="modal-header" id="flagmheader">  
                           <button type="button" class="close" data-dismiss="modal">&times;</button>  
                           <img src="<?php echo base_url();?>img/profile-notification-flag.png" id="modal_flag_img"><h6 class="modal-title flag_title">Flag for any offensive content</h6>  
                      </div>  
                      <div class="modal-body" id="trader_detail"> 
                          <input type="hidden" id="pcatid">
                          <input type="hidden" id="prodid">
                          <input type="hidden" id="postid">
                           <input type="hidden" id="traderid">
                          <textarea id="flag_md_cmt"></textarea>
                      </div>  
                      <div class="modal-footer" id="flagmfooter">  
                           <button type="submit" class="btn btn-default" id="btn_flag_modal" data-dismiss="modal">SEND</button>  
                      </div>  
                 </div>  
            </div>
           </form>
        </div>  
  </div>
    <script>
      function facebook_share(d, s, id) 
      {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.11&appId=1747010675350835';
            fjs.parentNode.insertBefore(js, fjs);
        }
         function twitter_share(d, s, id) 
      {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.twitter.net/en_GB/sdk.js#xfbml=1&version=v2.11&appId=1747010675350835';
            fjs.parentNode.insertBefore(js, fjs);
        }
        function snapchat_share(d, s, id) 
      {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.twitter.net/en_GB/sdk.js#xfbml=1&version=v2.11&appId=1747010675350835';
            fjs.parentNode.insertBefore(js, fjs);
        }
            function show_cart_div(trader_id,product_id)
            {
                
                $('#trader_details_div_'+trader_id+'_'+product_id).css('display','none'); 
                //$('#sidebar').css('display','block');
                $('#sidebar_'+trader_id+'_'+product_id).css('display','block'); 
                //$('#cart_details_div_'+trader_id).slideToggle();
            }
            function show_profile_div(trader_id,product_id)
            {
                $('#trader_details_div_'+trader_id+'_'+product_id).css('display','block'); 
                $('#sidebar_'+trader_id+'_'+product_id).css('display','none'); 
                
            }
    function video_toggle(x,y)
    {
        
        var vid = document.getElementById("vd_"+x+'_'+y);
       
        return vid.paused ? vid.play() : vid.pause();
       
    }
    
   
            function check_als_cart(category_id,product_id,cart_type,post_id)
            {
                
               if(cart_type == 0)
               {
                   //var data = 'category_id='+category_id+'/'+'product_id='+product_id+'/'+'post_id='+post_id;
                    $.ajax({
                            url: "<?php echo base_url(); ?>Trader/fetch_prod_traddet",
                            data : {'category_id':category_id,'product_id':product_id,'post_id':post_id},
                            type: "POST",

                            success:function(data){
                                
                                 $('#trader_detail').html(data);  
                                 $('#cartModal').modal("show"); 
                              
                                   
                            }

                        });
                   //$('#cartModal').modal('show');
               }
               else
               {
                location.href='<?php echo base_url()?>Trader/add_cart/'+product_id+'/'+post_id+'/'+category_id;
                   
                   
               }
            }
            function show_flag_modal(category_id,product_id,cart_type,post_id,trader_id)
            {
               
                $('#pcatid').val(category_id);  
                $('#prodid').val(product_id);
                $('#postid').val(post_id);
                $('#traderid').val(trader_id);
                $('#flagModal').modal("show");
               /* var product_id = $('#prodid').val();
                     var cat1_id = '1';
                     //alert(cat_id);return false;
                      var post_id = $('#prodid').val();
                      $.ajax({
                            url: "<?php echo base_url(); ?>Trader/save_flagpost",
                            data :  {'category_id':cat1_id,'product_id':product_id,'post_id':post_id},
                            type: "POST",

                            success:function(data){
                                 console.log(data);return false;
                              
                                   
                            }

                        });*/
                
            }
            $('#btn_flag_modal').click(function(){
                var category_id = $('#pcatid').val();
                var product_id = $('#prodid').val();
                var post_id = $('#postid').val();
                 var trader_id = $('#traderid').val();
                var flag_desc = $('#flag_md_cmt').val();
                $.ajax({
                            url: "<?php echo base_url(); ?>Trader/save_flagpost",
                             data :  {'category_id':category_id,'product_id':product_id,'post_id':post_id,'trader_id':trader_id,'flag_desc':flag_desc},
                            type: "POST",

                            success:function(data){
                                if(data == 'success')
                                {
                                 swal("Product has been flagged successfully");
                              
                                   
                            }
                            else
                            {
                               swal("Failed to report the flag.Try again");   
                            }
                        }
                        });
            });
            $(document).ready(function()
            {
               /* $('.fntpause').click(function () {
                    
                        var x = $('#txtpid').val();
                        var y = $('#txtcid').val();
                    alert(x+"  "+y);
                          if ($("#vd_"+x+"_"+y).get(2).paused) {
                         $("#vd_"+x+"_"+y).get(2).play();
                     } else {
                         $("#vd_"+x+"_"+y).get(0).pause();
                     }
    
   
                });*/
               var myDiv = $('.prdt_price_details');
            myDiv.text(myDiv.text().substring(0,16));
                
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
                    $('.owl-carousel').owlCarousel({
                        loop:true,
                        //margin:10,
                        nav:true,
                        //autoplay: true,
                        responsive:{
                            0:{
                                items:1
                            },

                        }
                    });
            
                        $('.viewsliderdiv').owlCarousel({
                            loop:true,
                margin:10,
                nav:true,
                responsive:{
                    0:{
                        items:4
                    },
                    600:{
                        items:4
                    },
                    1000:{
                        items:4
                    }
                }
                        });
            
            $('#most_viewCarousel .item').each(function(){
              var next = $(this).next();
              if (!next.length) {
                next = $(this).siblings(':first');
              }
              next.children(':first-child').clone().appendTo($(this));

              for (var i=0;i<3;i++) {
                next=next.next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                    }

                next.children(':first-child').clone().appendTo($(this));
              }
            });
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
                            $('.anccls').click(function(){
                                var cat_id = $('#hid_catid').val();
                     var id = $(this).attr('data-id');
                     //alert(id);return false;
                     //var data = 'product_id='+id;
                $.ajax({
                            url: "<?php echo base_url(); ?>Trader/fetch_proddet",
                            data : {'product_id':id,'cat_id':cat_id},
                            type: "POST",

                            success:function(data){
                                 $('#employee_detail').html(data);  
                                 $('#dataModal').modal("show"); 
                              
                                   
                            }

                        });
                 });
                 $('.anc_flag').click(function(){
                     
                     $('#flagModal').modal("show"); 
                
                 });
                 
            });
       
        </script>