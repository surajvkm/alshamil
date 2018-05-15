
<!-- start section -->
<section class="section white-backgorund">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- start sidebar -->
                <div class="col-sm-3">
                    <?php $this->load->view('trader/advancedSearch_vw'); ?> 
                </div>
                <!-- end sidebar -->
                <div class="col-sm-9 temp-hide">
                    <div class="mytextdiv">
                        <div class="mytexttitle">
                            <?php
                            if($cat_id == 1)
                            {
                                echo "CAR";
                            }else if($cat_id == 2)
                            {
                              echo "BIKE";  
                            }else if($cat_id == 3)
                            {
                                echo "NUMBER PLATE";
                            }else if($cat_id == 4)
                            {
                                echo "VERTUE";
                            }else if($cat_id == 5)
                            {
                                echo "WATCH";
                            }else if($cat_id == 6)
                            {
                                echo "MOBILE NUMBER";
                            }else if($cat_id == 7)
                            {
                                echo "BOAT";
                            }else if($cat_id == 8)
                            {
                                echo "PHONE";
                            }else if($cat_id == 9)
                            {
                                echo "PROPERTIES";
                            }
                            
                            ?>
                        </div>
                        <div class="divider"></div>
                        <div class="catcount-div">(<b><?php echo $count ?></b> Product Listed)</div>
                    </div>

                </div>
                <div class="col-sm-9 main-content-div temp-hide px-0">
                    <?php
                    if (count($qry) > 0) {
                        foreach ($qry as $result) { 
                       
                               
                            // if ($result->productCPrice != '') {
                            //     $product_price = $result->productCPrice;
                            // } else if ($row->productBPrice != '') {
                            //     $product_price = $row->productBPrice;
                            // } else if ($row->productBTPrice != '') {
                            //     $product_price = $row->productBTPrice;
                            // } else if ($row->productWPrice != '') {
                            //     $product_price = $row->productWPrice;
                            // } else if ($row->productVPrice != '') {
                            //     $product_price = $row->productVPrice;
                            // } else if ($row->productPRPrice != '') {
                            //     $product_price = $row->productPRPrice;
                            // } else if ($row->productPHPrice != '') {
                            //     $product_price = $row->productPHPrice;
                            // } else if ($row->productNPPrice != '') {
                            //     $product_price = $row->productNPPrice;
                            // } else if ($row->productMNPrice != '') {
                            //     $product_price = $row->productMNPrice;
                            // } else {

                            //     $product_price = '';
                            // }
                            // if ($row->cartCType != '') {
                            //     $cart_type = $row->cartCType;
                            // } else if ($row->cartBType != '') {
                            //     $cart_type = $row->cartBType;
                            // } else if ($row->cartBTType != '') {
                            //     $cart_type = $row->cartBTType;
                            // } else if ($row->cartWType != '') {
                            //     $cart_type = $row->cartWType;
                            // } else if ($row->cartVType != '') {
                            //     $cart_type = $row->cartVType;
                            // } else if ($row->cartPRType != '') {
                            //     $cart_type = $row->cartPRType;
                            // } else if ($row->cartPHType != '') {
                            //     $cart_type = $row->cartPHType;
                            // } else if ($row->cartNPType != '') {
                            //     $cart_type = $row->cartNPType;
                            // } else if ($row->cartMNType != '') {
                            //     $cart_type = $row->cartMNType;
                            // } else {

                            //     $cart_type = '';
                            // }
                             ?>   
                             
                                 <div class="col-sm-4 catpostimgs">
                                 <a class="details_anc" href="<?php echo base_url() ?>Trader/category_details/<?php echo $result->productID; ?>/<?php echo $result->productCategoryID; ?>">
                          
                                    <?php
                             
                                    if ($result->productImage != '' && (@getimagesize($result->productImage))) {
                                        $img = $result->productImage;
                                    } else {
                                        $img = base_url() . 'img/no_preview.png';
                                    }
                                    if($result->productStatus == 2)
                                    {
                                        ?>
                                    <button class="book_btn">BOOKED</button>
                                    <?php
                                    }
                                    if($result->productStatus == 1)
                                    {
                                        ?>
                                    <button class="sold_btn">SOLD</button>
                                    <?php
                                    }
                                       

                                    ?>
                                    
                                    <img src="<?php echo $img; ?>" class="post_imgs">
                                    </a>   
                                    <div class="tradet_details">
                                    <a  href="<?php echo base_url() ?>Trader/category_details/<?php echo $result->productID; ?>/<?php echo $result->productCategoryID; ?>">
                          
                                        <div class="col-md-12 mainprdspan">
                                           
                                        <div class="col-xs-3 col-sm-4 mainprdspan">
                                            <span>Product</span><br>
                                            <span>Price</span>
                                            
                                        </div>
                                        <div class="col-xs-9 col-sm-8 mainprdspan">
                                            <span><?php echo $result->productName ?></span><br>
                                            <span><?php $this->Trader_mdl->formataed($result->productPrice,$result->CallPrice); ?></span>
                                        </div>    
                                            
                                        </div>  
                                        </a>   
                                        <div class="col-md-12 mainprdspan">
                                            <hr class="cat_hr">
                                        </div>
                                        <div class="col-md-12 mainprdspan" onmouseenter="$(this).find('.sidecrtdiv').fadeIn('200');" onmouseleave="$('.sidecrtdiv').css('display','none');$('.cart').show();">
                                            <div class="col-xs-2 col-sm-2 col-md-3 category-trader">
                                                <?php
                                                if ($result->traderImage != '' && (@getimagesize($result->traderImage))) {
                                                ?>
                                                    <img src="<?php echo $result->traderImage ?>" class="cat_user_prof">
                                                <?php
                                                } else {
                                                ?>
                                                    <img src="<?php echo base_url() ?>img/userProfileIcon_gray.png" class="cat_user_prof">
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="col-xs-10 col-sm-10 col-md-9 category-traderName">
                                                <?php
                                                $d = $result->postSubmissionOn;
                                                $d1 = strtotime($d);
                                                ?>
                                                <div>
                                                <span class="cat_uname"><?php echo $result->traderFullName; ?></span>
                                                <span class="cat_udate"><?php echo date('d M Y', $d1) ?></span>
                                                </div>
                                                <div class="cat_uplace"><?php echo $result->traderLocation; ?></div>
                                            </div>
                                          
                                        <div  class="sidecrtdiv socialiconsdiv" id="sidebar_<?php echo $result->traderID ?>_<?php echo $result->productID ?>" >
                                            <div id="tr_home_btn">
                                        
                                                    <a class="anccls newanc"  style="cursor:pointer;" data-id="<?php echo $result->productID; ?>"  onclick="show_prd_details('<?php echo $result->productID ?>', '<?php echo $result->productCategoryID ?>')">
                                                        <img id="img_sharedr" src="<?php echo base_url(); ?>img/post-share.png">
                                                    </a>        
                                                    <?php
                                                    if (isset($_SESSION['logged_in'])) {
                                                        
                                                        if ($_SESSION['logged_in']['trader_id']!=$result->traderID) {
                                                        ?>
                                                        <a class="anccls newanc" onclick="add_to_watch('<?php echo $result->productID ?>', '<?php echo $result->productCategoryID ?>', '<?php echo $result->postID ?>', '<?php echo $result->traderID ?>')">
                                                            <img id="wishlist_home" src="<?php echo base_url(); ?>img/post-add-watchlist.png">
                                                        </a>
                                                        <a class="anc_flag newanc" onclick="show_flag_modal('<?php echo $result->productCategoryID ?>', '<?php echo $result->productID ?>', '<?php echo $result->cart_type ?>', '<?php echo $result->postID ?>', '<?php echo $result->traderID ?>')">
                                                            <img id="flag_home" src="<?php echo base_url(); ?>img/post-flag.png">
                                                        </a>
                                                        <?php if($result->usertype==3 && $result->CallPrice==0){ ?>
                                                        <a class="newanc" onclick="check_als_cart('<?php echo $result->productCategoryID ?>', '<?php echo $result->productID ?>', '<?php echo $result->cart_type ?>', '<?php echo $result->postID ?>', '<?php echo $result->traderID ?>', '<?php echo  $result->productPrice ?>')">
                                                       
                                                            <img id="shng_home" src="<?php echo base_url(); ?>img/post-add-cart.png">
                                                        </a>
                                                       
                                                        <?php
                                                        }
                                                    }

                                                    } else {
                                                        ?>
                                                        <a class="newanc" href="<?php echo base_url(); ?>Trader/login_view">
                                                            <img id="wishlist_home" src="<?php echo base_url(); ?>img/post-add-watchlist.png">
                                                        </a>
                                                        <a class="newanc" href="<?php echo base_url(); ?>Trader/login_view">
                                                            <img id="flag_home" src="<?php echo base_url(); ?>img/post-flag.png">
                                                        </a>
                                                        <a class="newanc" href="<?php echo base_url(); ?>Trader/login_view">
                                                            <img id="shng_home" src="<?php echo base_url(); ?>img/post-add-cart.png">
                                                        </a>
                                                        <?php
                                                    }
                                                    ?>
                                                
                                            </div>
                                        </div>


                                        </div>
                                    </div>
                                </div>
                           
                            <?php
                            }
                        } else {
                        ?>
                        <div class="trader-profile-no"><?php echo 'No Item Found'; ?></div>
                        <?php
                        }
                        ?>

                    
                </div><!-- end col -->
                 <div class="col-sm-9" id="imgpost_div"></div> 
                <!-- Binds search results-->
                <div class="col-xs-12 col-sm-12 col-md-9 temp-hide vehhisdiv">
                <style>
                .pagination li['class'] a {
    background-color: #f5821f;
    color: white;
}
.pagination li a.active {
    background-color: #f5821f;
    color: white;
}
                </style>
                    <div class="row">
                        <div id="pagination">
                            <ul class="tsc_pagination">
                                <?php
                                if ($count > 0) {
                                    if(isset($links)){
                                        foreach ($links as $link) {
                                            echo "<li>" . $link . "</li>";
                                        }
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end row -->                
    </div><!-- end container -->
</section>
<!-- end section -->
<?php $this->load->view('trader/recently_viewed_vw'); ?>


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
                        <img src="<?php echo base_url(); ?>img/profile-notification-flag.png" id="modal_flag_img"><h6 class="modal-title flag_title">Flag for any offensive content</h6>  
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
<script>
    function show_cart_div()
    {

        $('#car_trader').css('display', 'none');
        $('#carsidebar').css('display', 'block');


    }
    function show_profile_div()
    {
        $('#car_trader').css('display', 'block');
        $('#carsidebar').css('display', 'none');

    }
    function check_als_cart(category_id, product_id, post_id, userid, price)
    {
        cart_type=1;
        if (cart_type == 0)
        {
            var data = 'product_id=' + product_id;
            $.ajax({
                url: "<?php echo base_url(); ?>Trader/fetch_prod_traddet",
                data: {'category_id': category_id, 'product_id': product_id, 'post_id': post_id, 'userid': userid},
               
                type: "POST",

                success: function (data) {

                    $('#trader_detail').html(data);
                    $('#cartModal').modal("show");


                }

            });
            //$('#cartModal').modal('show');
        } else
        {
           // location.href = '<?php echo base_url() ?>Trader/add_cart/' + product_id + '/' + post_id + '/' + category_id + '/' + userid;
           $.ajax({
                url: "<?php echo base_url(); ?>Trader/check_prd_cartexist",
                data: {'post_id': post_id},
                type: "POST",

                success: function (data) {
                    if (data == 'exist')
                    {
                        swal("Product Has Been Already Added to Cart");
                    } else
                    {
                        location.href = '<?php echo base_url() ?>Trader/add_cart/' + product_id + '/' + post_id + '/' + category_id + '/' + userid;

                    }



                }

            });

        }
    }
    function add_to_watch(product_id, category_id, post_id, userid)
    {
        $.ajax({
            url: "<?php echo base_url(); ?>Trader/check_prd_watchexist",
            data: {'post_id': post_id},
            type: "POST",

            success: function (data) {
                if (data == 'exist')
                {
                    swal("Product Has Been Already Added to Watchlist");
                } else
                {
                    location.href = '<?php echo base_url() ?>Trader/add_watch_list/' + product_id + '/' + category_id + '/' + post_id + '/' + userid;

                }



            }

        });
    }
    function show_prd_details(pid, cid)
    {

        $.ajax({
            url: "<?php echo base_url(); ?>Trader/fetch_proddet",
            data: {'product_id': pid, 'cat_id': cid},
            type: "POST",

            success: function (data) {
                $('#employee_detail').html(data);
                $('#dataModal').modal("show");


            }

        });
    }
    function show_flag_modal(category_id, product_id, cart_type, post_id, trader_id)
    {

        $('#pcatid').val(category_id);
        $('#prodid').val(product_id);
        $('#postid').val(post_id);
        $('#traderid').val(trader_id);
        $('#flagModal').modal("show");
    }
    $('#btn_flag_modal').click(function () {
        var category_id = $('#pcatid').val();
        var product_id = $('#prodid').val();
        var post_id = $('#postid').val();
        var trader_id = $('#traderid').val();
        var flag_desc = $('#flag_md_cmt').val();
        $.ajax({
            url: "<?php echo base_url(); ?>Trader/save_flagpost",
            data: {'category_id': category_id, 'product_id': product_id, 'post_id': post_id, 'trader_id': trader_id, 'flag_desc': flag_desc},
            type: "POST",

            success: function (data) {
                if (data == 'success')
                {
                    swal("Product has been flagged successfully");
                    setTimeout(function ()
                    {

                        location.href = '<?php echo base_url() ?>Trader';
                    }, 1000);

                } else
                {
                    swal("Failed to report the flag.Try again");
                }
            }
        });
    });






</script>