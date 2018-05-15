<link rel="stylesheet" href="<?php echo base_url(); ?>Gallery-master/css/blueimp-gallery.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>Gallery-master/css/blueimp-gallery-indicator.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>Gallery-master/css/blueimp-gallery-video.css">
<script src="<?php echo base_url(); ?>Gallery-master/js/blueimp-helper.js"></script>
<script src="<?php echo base_url(); ?>Gallery-master/js/blueimp-gallery.min.js"></script>
<script src="<?php echo base_url(); ?>Gallery-master/js/blueimp-gallery-fullscreen.js"></script>
<script src="<?php echo base_url(); ?>Gallery-master/js/blueimp-gallery-indicator.js"></script>
<script src="<?php echo base_url(); ?>Gallery-master/js/blueimp-gallery-video.js"></script>

<!--<script src="<?php echo base_url() ?>Gallery-master/js/vendor/jquery.js"></script>-->
<script src="<?php echo base_url(); ?>Gallery-master/js/jquery.blueimp-gallery.min.js"></script>

<!-- start section -->
<div id ="car"></div>
<div id="sub">
    <section class="section white-background regsecdiv1">
        <div class="container">
            <div class="row" id="tr_hm_div">
                <div class="col-sm-12" >

                    <div class="col-sm-8">
                        <input type="hidden" id="base" value="<?php echo base_url(); ?>">
                        <div id="blueimp-video-carousel" class="blueimp-gallery blueimp-gallery-controls blueimp-gallery-carousel">
                            <div class="slides"></div>
                            <h3 class="title"></h3>
                            <label class="views">Views </label><p class="description"></p>
                            <a class="prev">‹</a>
                            <a class="next">›</a>
                            <a class="play-pause"></a>
                        </div>
                        <br>
                    </div>

                    <div class="col-sm-4">
                        <div class="toptraders_div">
                        <div class="top_traderhead"><span id="sptop">All Traders</span> <a id="user_anvietr" href="<?php echo base_url() ?>Trader/view_all_traders" title="Click to view all traders">View All</a></div>
                        <div class="col-md-12 maintraders">
                            <div class="col-sm-3 col-xs-2 userimage">
                                <?php
                                if ($admin[0]->traderImage != '' && (@getimagesize($admin[0]->traderImage))) {
                                    ?>
                                    <a href="<?php echo base_url() ?>Trader/view_other_traders/<?php echo $admin[0]->traderID ?> "><span id="sp_tr_img"><img src="<?php echo $admin[0]->traderImage; ?>" class="top_trimg" /></span></a>
                                    <?php
                                } else {
                                    ?>
                                    <a href="<?php echo base_url() ?>Trader/view_other_traders/<?php echo $admin[0]->traderID ?>"><img src="<?php echo base_url(); ?>img/userProfileIcon_gray.png" class="top_trimg" onclick="<?php echo base_url() ?>Trader"/></a>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="col-sm-9 col-xs-10 toptraders">
                                <div>
                                    <a href="<?php echo base_url() ?>Trader/view_other_traders/<?php echo $admin[0]->traderID ?> ">
                                        <span class="tradername bold"><?php echo $admin[0]->traderFullName; ?></span>
                                    </a>
                                    <span class="traderplace"><?php echo $admin[0]->traderPostCount; ?></span>
                                </div>
                                <div>
                                    <span class="tradername"><?php echo $admin[0]->traderLocation; ?></span>
                                    <span class="traderplace">Post</span>
                                </div>
                                <br><hr class="hr-bottom"> 
                            </div>
                        </div>       
                        
                        <?php
                        foreach ($trader as $result) {
                        ?>
                        <div class="col-md-12 maintraders">
                            <div class="col-sm-3 col-xs-2">
                                <?php
                                if ($result->traderImage != '' && (@getimagesize($result->traderImage))) {
                                    ?>
                                    <a href="<?php echo base_url() ?>Trader/view_other_traders/<?php echo $result->traderID ?> "><span id="sp_tr_img"><img src="<?php echo $result->traderImage; ?>" class="top_trimg" /></span></a>
                                    <?php
                                } else {
                                    ?>
                                    <a href="<?php echo base_url() ?>Trader/view_other_traders/<?php echo $result->traderID ?>"><img src="<?php echo base_url(); ?>img/userProfileIcon_gray.png" class="top_trimg" onclick="<?php echo base_url() ?>Trader"/></a>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="col-sm-9 col-xs-10 toptraders">
                                <div>
                                    <a href="<?php echo base_url() ?>Trader/view_other_traders/<?php echo $result->traderID ?> ">
                                        <span class="tradername bold"><?php echo $result->traderFullName; ?></span>
                                    </a>
                                    <span class="traderplace"><?php echo $result->traderPostCount; ?></span>
                                </div>
                                <div>
                                    <span class="tradername"><?php echo $result->traderLocation; ?></span>
                                    <span class="traderplace">Post</span>
                                </div>
                                <br><hr> 
                            </div>
                        </div>       
                        <?php } ?> 
                    </div>
                    </div>

                </div>
            </div>
        </div><!-- end container -->
    </section>

    <!-- end section -->
    <!-- start section -->
    <section class="section white-background">
        <div class="container">
            <div class="row">
                <div class="col-sm-12" >


                    <h5 id="latposttitle">LATEST POST</h5>
                    
                        <?php
                        foreach ($qry as $row) {
                           
                            ?>

                            <div class="col-sm-4 col-md-3  postcol" onmouseenter="$(this).find('.sidecrtdiv').fadeIn('200');" onmouseleave="$('.sidecrtdiv').css('display','none');$('.cart').show();">
                                <?php
                                if ($row->Cpost_main_img != '' && (@getimagesize($row->Cpost_main_img))) {
                                    $img = $row->Cpost_main_img;
                                } else if ($row->Bpost_main_img != '' && (@getimagesize($row->Bpost_main_img))) {
                                    $img = $row->Bpost_main_img;
                                } else if ($row->BTpost_main_img != '' && (@getimagesize($row->BTpost_main_img))) {
                                    $img = $row->BTpost_main_img;
                                } else if ($row->Wpost_main_img != '' && (@getimagesize($row->Wpost_main_img))) {
                                    $img = $row->Wpost_main_img;
                                } else if ($row->Vpost_main_img != '' && (@getimagesize($row->Vpost_main_img))) {
                                    $img = $row->Vpost_main_img;
                                } else if ($row->PRpost_main_img != '' && (@getimagesize($row->PRpost_main_img))) {
                                    $img = $row->PRpost_main_img;
                                } else if ($row->PHpost_main_img != '' && (@getimagesize($row->PHpost_main_img))) {
                                    $img = $row->PHpost_main_img;
                                } else if ($row->NPpost_main_img != '' && (@getimagesize($row->NPpost_main_img))) {
                                    $img = $row->NPpost_main_img;
                                } else if ($row->MNpost_main_img != '' && (@getimagesize($row->MNpost_main_img))) {
                                    $img = $row->MNpost_main_img;
                                } else {

                                    $img = base_url() . 'img/no_preview.png';
                                }

                                if ($row->product_name1 != '') {
                                    $product_name = $row->product_name1;
                                } else if ($row->product_name2 != '') {
                                    $product_name = $row->product_name2;
                                } else if ($row->product_name3 != '') {
                                    $product_name = $row->product_name3;
                                } else if ($row->product_name4 != '') {
                                    $product_name = $row->product_name4;
                                } else if ($row->product_name5 != '') {
                                    $product_name = $row->product_name5;
                                } else if ($row->product_name6 != '') {
                                    $product_name = $row->product_name6;
                                } else if ($row->product_name7 != '') {
                                    $product_name = $row->product_name7;
                                } else if ($row->product_name8 != '') {
                                    $product_name = $row->product_name8;
                                } else if ($row->product_name9 != '') {
                                    $product_name = $row->product_name9;
                                } else {

                                    $product_name = '';
                                }

                                if ($row->productCPrice != '') {
                                    $product_price = $row->productCPrice;
                                } else if ($row->productBPrice != '') {
                                    $product_price = $row->productBPrice;
                                } else if ($row->productBTPrice != '') {
                                    $product_price = $row->productBTPrice;
                                } else if ($row->productWPrice != '') {
                                    $product_price = $row->productWPrice;
                                } else if ($row->productVPrice != '') {
                                    $product_price = $row->productVPrice;
                                } else if ($row->productPRPrice != '') {
                                    $product_price = $row->productPRPrice;
                                } else if ($row->productPHPrice != '') {
                                    $product_price = $row->productPHPrice;
                                } else if ($row->productNPPrice != '') {
                                    $product_price = $row->productNPPrice;
                                } else if ($row->productMNPrice != '') {
                                    $product_price = $row->productMNPrice;
                                } else {

                                    $product_price = '';
                                }
                                if ($row->cartCType != '') {
                                    $cart_type = $row->cartCType;
                                } else if ($row->cartBType != '') {
                                    $cart_type = $row->cartBType;
                                } else if ($row->cartBTType != '') {
                                    $cart_type = $row->cartBTType;
                                } else if ($row->cartWType != '') {
                                    $cart_type = $row->cartWType;
                                } else if ($row->cartVType != '') {
                                    $cart_type = $row->cartVType;
                                } else if ($row->cartPRType != '') {
                                    $cart_type = $row->cartPRType;
                                } else if ($row->cartPHType != '') {
                                    $cart_type = $row->cartPHType;
                                } else if ($row->cartNPType != '') {
                                    $cart_type = $row->cartNPType;
                                } else if ($row->cartMNType != '') {
                                    $cart_type = $row->cartMNType;
                                } else {

                                    $cart_type = '';
                                }
                                ?>

                                <a href="<?php echo base_url().'Trader/category_details/'.$row->productID.'/'.$row->productCategoryID; ?>">
                                    <img src="<?php echo $img ?>"  class="latest_postimgs" ></a>
                                <input type="hidden" class="hid_sharecatid" value="<?php echo $row->productCategoryID ?>">
                                <div class="img_details">
                                    <div class="col-md-12 mainprdspan">
                                           
                                        <div class="col-sm-4 col-md-4 col-xs-3 mainprdspan">
                                            <span>Product</span><br>
                                            <span>Price</span>
                                            
                                        </div>
                                        <div class="col-sm-8 col-md-8 col-xs-9 mainprdspan bold">
                                            <span><?php echo $product_name; ?></span><br>
                                            <span><?php $this->Trader_mdl->formataed($product_price,$row->CallPrice); ?></span>
                                        </div>    
                                            
                                    </div>  
                                    <div class="col-md-12 mainpghr">
                                        <hr class="cat_hr">
                                    </div>
                                    
                                    <div class="col-md-12 mainlist">
                                        <div id="trader_details_div_<?php echo $row->traderID ?>_<?php echo $row->productID ?>" class="cart"  >
                                            <div class="col-sm-3 col-xs-2 category-trader">
                                                <?php
                                                if ($row->traderImage != '' && (@getimagesize($row->traderImage))) {
                                                    ?>
                                                    <img src="<?php echo $row->traderImage ?>" class="cat_user_prof">
                                                    <?php
                                                } else {
                                                    ?>
                                                    <img src="<?php echo base_url() ?>img/userProfileIcon_gray.png" class="cat_user_prof">
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="col-sm-9 col-xs-10 category-traderName">
                                                <?php
                                                $d = $row->postSubmissionOn;
                                                $d1 = strtotime($d);
                                                ?>
                                                <div>
                                                <span class="cat_uname"><?php echo $row->traderFullName; ?></span>
                                                <span class="cat_udate"><?php echo date('d M Y', $d1) ?></span>
                                                </div>
                                                <div class="cat_uplace"><?php echo $row->traderLocation; ?></div>
                                            </div>
                                        </div>
                                        <div  class="sidecrtdiv socialiconsdiv" id="sidebar_<?php echo $row->traderID ?>_<?php echo $row->productID ?>" >
                                            <div id="tr_home_btn">
                                        
                                                    <a class="anccls newanc"  style="cursor:pointer;" data-id="<?php echo $row->productID; ?>" data-toggle="modal" target="#myModal" onclick="show_prd_details('<?php echo $row->productID ?>', '<?php echo $row->productCategoryID ?>')">
                                                        <img id="img_sharedr" src="<?php echo base_url(); ?>img/post-share.png">
                                                    </a>        
                                                    <?php
                                                    if (isset($_SESSION['logged_in'])) {
                                                        if ($_SESSION['logged_in']['trader_id']!=$row->traderID) {
                                                        ?>
                                                        <a class="anccls newanc" onclick="add_to_watch('<?php echo $row->productID ?>', '<?php echo $row->productCategoryID ?>', '<?php echo $row->postID ?>', '<?php echo $row->traderID ?>')">
                                                            <img id="wishlist_home" src="<?php echo base_url(); ?>img/post-add-watchlist.png">
                                                        </a>
                                                        <a class="anc_flag newanc" onclick="show_flag_modal('<?php echo $row->productCategoryID ?>', '<?php echo $row->productID ?>', '<?php echo $cart_type ?>', '<?php echo $row->postID ?>', '<?php echo $row->traderID ?>')">
                                                            <img id="flag_home" src="<?php echo base_url(); ?>img/post-flag.png">
                                                        </a>
                                                        <?php if($row->usertype==3 && $row->CallPrice==0){ ?>
                                                        <a class="newanc" onclick="check_als_cart('<?php echo $row->productCategoryID ?>', '<?php echo $row->productID ?>','<?php echo $row->postID ?>', '<?php echo $row->traderID ?>', '<?php echo $product_price ?>')">
                                                       
                                                            <img id="shng_home" src="<?php echo base_url(); ?>img/post-add-cart.png">
                                                        </a>
                                                        <?php } }  ?>
                                                        <?php
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
                        ?>

                    
                </div>
            </div>
        </div><!-- end container -->
    </section>

    <!-- end section -->
    <?php $this->load->view('trader/mostView_vw'); ?>
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
</div>
<script>

    function video_toggle(x, y)
    {

        var vid = document.getElementById("vd_" + x + '_' + y);

        return vid.paused ? vid.play() : vid.pause();

    }


    function check_als_cart(category_id, product_id, post_id, userid, price)
    {
        cart_type=1;
        if ((cart_type == 0) && (price <= 0))
        {
            //var data = 'category_id='+category_id+'/'+'product_id='+product_id+'/'+'post_id='+post_id;
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

    $(document).ready(function ()
    {

        $('.owl-one').owlCarousel({
            loop: true,
            margin: 10,

            navText: ['<button class="owlbtn"><i class="fa fa-chevron-circle-left mostviewslider_left" ></i></button>', '<button class="owlbtn"><i class="fa fa-chevron-circle-right mostviewslider_right"  aria-hidden="true"></i></button>'],
            nav: true,
            autoplay: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 4
                }
            }
        });


    

        $('#most_viewCarousel .item').each(function () {
            var next = $(this).next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));

            for (var i = 0; i < 3; i++) {
                next = next.next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                }

                next.children(':first-child').clone().appendTo($(this));
            }
        });

        $('.anc_flag').click(function () {

            $('#flagModal').modal("show");

        });

    });
    $(function () {
        'use strict'

        blueimp.Gallery([
<?php

foreach ($product as $result) {
    $link_array = explode('/',$result->productVideo);
    $file = end($link_array);
    $file_det = pathinfo($file);
   // $title = $this->Trader_mdl->getTitle($result->productID, $result->productCategoryID);
    // if ($result->thumbImage == '') {
    //     $poster = $this->Trader_mdl->getImage($result->productID, $result->productCategoryID);
    // } else {
    //     $poster = $result->thumbImage;
    // }
    if(isset($file_det['extension'])){
    ?>
                {
                    title: '<?php //echo $title; ?>',
                    href: '<?php echo base_url('uploads/videos/').$file; ?>',
                    type: 'video/mp4',
                    poster: '<?php echo $result->thumbImage; ?>',
                    description: '<?php echo $result->productVideoCount; ?>'
                },
<?php }} ?>

        ], {
            container: '#blueimp-video-carousel',
            carousel: true
        })
    })


</script>
