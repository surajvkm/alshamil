
<!-- start section -->
<section class="section white-backgorund">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?php echo $this->session->flashdata('msg'); ?>
            </div>
            <div class="col-sm-12">
                <!-- start sidebar -->
                <div class="col-sm-3">
                    <?php $this->load->view('trader/advancedSearch_vw'); ?> 
                </div>
                <!-- end sidebar -->
                <div id="imgpost_div"></div>
                <div class="col-sm-9 temp-hide"> 
                    <div class="mytextdiv">
                        <input type="hidden" name="product_id"  value="<?php echo $product_id; ?>"/>
                        <input type="hidden" id="categoryId"  value="<?php echo $cat_id; ?>"/>
                        <div class="mytexttitle">
                            <?php echo $query[0]->productName; ?>
                        </div>
                        <div class="divider"></div>
                        <div class="amt-div"><?php $this->Trader_mdl->formataed($query[0]->productPrice,$query[0]->CallPrice); ?></div>
                    </div>
                </div>
                <div class="col-sm-9 col-xs-12 sliderprofdiv temp-hide">
                    <div class="col-sm-8 col-md-8 col-xs-12 slider-img pl-xs-0 pr-xs-0">
                              <!--// -------------Slider--------------//-->
                            <?php
                            if (($cat_id == 3) ||($cat_id == 6)) {
                                if ($query[0]->productImage != '' && (@getimagesize($query[0]->productImage))) {
                                    $img = $query[0]->productImage;
                                } else {
                                    $img = base_url() . 'img/no_preview.png';
                                }
                               
                                ?>
                            <div class="nomobimg">
                                <img class="noplateimg" src="<?php echo $img ?>">
                                <div class="noplate_cnt_div">
                                    <span class="spownview">Views</span><br>
                                    <span class="spowncnt"><?php echo $query[0]->productViewCount ?></span>
                                </div>
                            </div>
                            <?php
                            } else {
                             
                                $this->load->view('trader/subslider_vw');
                            }
                            ?> 
                            
                            <!--// -------------End Slider--------------//-->
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 main-content-div px-0">
                        <div class="col-md-12">
                          
                            <div class="col-xs-2 col-sm-4 col-md-4 ownprofdiv">
                                <?php
                                if ($query[0]->traderImage != '' && (@getimagesize($query[0]->traderImage))) {
                                    ?>
                                    <img src="<?php echo $query[0]->traderImage ?>" class="owner_prof">
                                    <?php
                                } else {
                                    ?>
                                    <img src="<?php echo base_url() ?>img/userProfileIcon_gray.png" class="owner_prof">
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="col-xs-10 col-sm-8 col-md-8 pr-0 margin-bottom-20 ownprofdiv">
                                <div class="ownname"><?php echo $query[0]->traderFullName ?></div>
                                <div class="ownloc"><?php echo $query[0]->traderLocation; ?></div>
                                <hr class="ownprofhr">
                                <?php
                                $d = $query[0]->postSubmissionOn;
                                $d1 = strtotime($d);
                                ?>
                                <div class="ownpostdate">Posted on <?php echo date('d M Y', $d1) ?></div>
                            </div>
                        </div>
                         <?php
                            if (isset($_SESSION['logged_in']['trader_id'])) {
                                $sess_id = $_SESSION['logged_in']['trader_id'];
                            } else {
                                $sess_id = '';
                            }

                            if ($sess_id == $query[0]->traderID) {
                            ?>
                            <div class="col-md-12 ownphonediv">
                                <input type="hidden" id="prdt_btn_status_css" value="<?php echo $query[0]->productStatus ?>">
                                <input type="hidden" id="hid_pid" value="<?php echo $query[0]->productID ?>">
                                <input type="hidden" id="hid_cid" value="<?php echo $query[0]->productCategoryID ?>">
                                <button class="btn btn-default btncons ownbtnss own_avail btn-width" <?php if ($query[0]->productStatus == 1) echo 'disabled'; ?>>Available</button>
                                <button class="btn btn-default btncons ownbtnss own_book btn-width" <?php if ($query[0]->productStatus == 1) echo 'disabled'; ?>>Booked</button>
                                <button class="btn btn-default btncons ownbtnss own_sold btn-width">Sold</button>
                            </div>
                            <?php
                            } else {
                            ?>


                            <div class="col-md-12 ownphonediv">
                                <button class="btncons catdet_phone"><img src="<?php echo base_url() ?>img/post-detail-phone.png"> <span class="poster_contact"><?php echo $query[0]->traderContactNum?></span></button>

                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2 catcol2"></div>
                                <div class="col-sm-12 col-xs-12 col-md-12 mailchatdiv">
                                  
                                    <button class="btncons catdet_mailbtn"   <?php if (isset($_SESSION['logged_in'])) { ?> onclick="show_mail_popup()"  <?php } else { ?> disabled <?php } ?>><i class="fa fa-envelope" aria-hidden="true"></i> Mail</button>
                                    <button class="btncons catdet_chatbtn" <?php if (isset($_SESSION['logged_in'])) echo "data-trader='".$query[0]->traderID."' "."data-traderName='".$query[0]->traderFullName."' " ?>  ><i class="fa fa-comments" aria-hidden="true"></i> Chat</button>
                                </div>
                                <div class="col-md-2 catcol2"></div>
                                
                            </div>
                            <?php
                            }
                            ?>
                        <div class="col-md-12 socialbtns">
                            <?php
                            if ($sess_id == $query[0]->traderID) {
                                ?>
                                <button class="shared_btn ownshare number_btn"  onclick="shared_modal('<?php echo $query[0]->productCategoryID ?>', '<?php echo $query[0]->productID ?>')"  data-target="#dataModal" data-toggle="modal" data-id="<?php echo $query[0]->productID; ?>"><img src="<?php echo base_url(); ?>img/post-share.png" class="img_shared"><span class="sbtns_txts">Share</span></button>
                                <?php
                            } else {
                                ?>
                                <button class="shared_btn"  onclick="shared_modal('<?php echo $query[0]->productCategoryID ?>', '<?php echo $query[0]->productID ?>')"  data-target="#dataModal" data-toggle="modal" data-id="<?php echo $query[0]->productID; ?>"><img src="<?php echo base_url(); ?>img/post-share.png" class="img_shared"><span class="sbtns_txts">Share</span></button>
                                <?php
                                if (!(isset($_SESSION['logged_in']))) {
                                    ?>
                                    <button class="wishlist_btn" onclick="call_login()">  <img src="<?php echo base_url(); ?>img/post-add-watchlist.png" class="img_watch"><span class="wbtns_txts">Watch List</span></button><br>
                                    <button class="flag_btn"  onclick="call_login()"><img src="<?php echo base_url(); ?>img/post-flag.png" class="img_flag"><span class="fbtns_txts">Flag Post</span></button><br>
                                    <button class="addcart_btn" onclick="call_login()"><img src="<?php echo base_url(); ?>img/post-add-cart.png" class="img_cart"><span class="cbtns_txts">Add to Cart</span></button>

                                    <?php
                                } elseif($query[0]->productStatus!=1) {
                                    ?>
                                    <button class="wishlist_btn" onclick="add_to_watch('<?php echo $query[0]->productID ?>', '<?php echo $query[0]->productCategoryID ?>', '<?php echo $query[0]->postID ?>','<?php echo $query[0]->traderID ?>')">  <img src="<?php echo base_url(); ?>img/post-add-watchlist.png"  class="img_watch"><span class="wbtns_txts">Watch List</span></button><br>
                                    <button class="flag_btn" onclick="show_flag_modal('<?php echo $query[0]->productCategoryID ?>', '<?php echo $query[0]->productID ?>', '<?php echo $query[0]->cartType ?>', '<?php echo $query[0]->postID ?>', '<?php echo $query[0]->traderID ?>')">   <img src="<?php echo base_url(); ?>img/post-flag.png"  class="img_flag"><span class="fbtns_txts">Flag Post</span></button><br>

                                    <?php
                                  
                                    if($query[0]->usertype==3 && $query[0]->CallPrice==0){ 
                                        ?>
                                        <button class="addcart_btn" onclick="check_als_cart('<?php echo $query[0]->productCategoryID ?>', '<?php echo $query[0]->productID ?>', '<?php echo $query[0]->cartType ?>', '<?php echo $query[0]->postID ?>', '<?php echo $query[0]->traderID ?>', '<?php echo $query[0]->productPrice ?>')"><img src="<?php echo base_url(); ?>img/post-add-cart.png"  class="img_cart"><span class="cbtns_txts">Add to Cart</span></button>

                                        <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 temp-hide">
                <div class="col-sm-9 vehhisdiv width100">
                    <p class="history_title" class="hist_p">POST DETAILS</p>
                    <p class="hist_descr"><?php echo $query[0]->productDescr ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

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

<div id="flagModal" class="modal fade"> 

    <form role="form" class="form-horizontal"  method="post">
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


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×</button>
                <h4 class="modal-title" id="myModalLabel">
                    Send Mail
                </h4>   
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Nav tabs -->
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="Login">
                            <form role="form" class="form-horizontal" action="<?php echo base_url(); ?>Trader/sendMailCategory/<?php echo $query[0]->productID; ?>/<?php echo $query[0]->productCategoryID ?>" method="post">
                                </br> 
                                <div class="form-group">
                                    <label for="subject" class="col-sm-2 control-label">
                                        Subject</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required="" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">
                                        Message
                                    </label>
                                    <div class="col-sm-8">
                                        <textarea  name="message" class="form-control" rows="9" cols="25" value=""></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2">
                                    </div>
                                    <div class="col-sm-8">
                                        &nbsp;  <button type="submit" class="btn btn-info btn-fill">
                                            Send</button>&nbsp;
                                        <button type="button" data-dismiss="modal" class="btn btn-info btn-fill">
                                            Cancel</button>
                                    </div>
                                    </br>
                                    </br>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


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


<script>
    function call_login()
    {
        location.href = '<?php echo base_url() ?>Trader/login_view';

    }
    $(document).ready(function ()
    {
        var prdt_status = $('#prdt_btn_status_css').val();
        if (prdt_status == 0)
        {
            $('.own_avail').css('background-color', '#78a22f');
            $('.own_avail').css('color', 'white');
        }
        if (prdt_status == 1)
        {
            $('.own_sold').css('background-color', '#78a22f');
            $('.own_sold').css('color', 'white');
        }
        if (prdt_status == 2)
        {
            $('.own_book').css('background-color', '#78a22f');
            $('.own_book').css('color', 'white');
        }
        $('.own_book').click(function (e) {
            e.preventDefault();
            var pid = $('#hid_pid').val();
            var cid = $('#hid_cid').val();
            var postStatus="<?php echo $query[0]->postStatus; ?>";
           if(postStatus!='1'){
            swal("Product is not approved",'','error');
           }else{
            $.ajax({
                url: "<?php echo base_url(); ?>Trader/change_status_book",
                data: {'pid': pid, 'cid': cid},
                type: "POST",

                success: function (data) {
                    if (data == 'success')
                    {

                        swal("Product Status  has been Successfully Updated");
                        setTimeout(function ()
                        {

                            location.reload();
                        }, 1000);
                    }

                }

            });
           }
     
        });
        $('.own_avail').click(function (e) {
            e.preventDefault();
            var pid = $('#hid_pid').val();
            var cid = $('#hid_cid').val();
            var postStatus="<?php echo $query[0]->postStatus; ?>";
           if(postStatus!='1'){
            swal("Product is not approved",'','error');
           }else{
            $.ajax({
                url: "<?php echo base_url(); ?>Trader/change_status_avail",
                data: {'pid': pid, 'cid': cid},
                type: "POST",

                success: function (data) {
                    if (data == 'success')
                    {

                        swal("Product Status  has been Successfully Updated");
                        setTimeout(function ()
                        {

                            location.reload();
                        }, 1000);
                    }

                }

            });
           }
      
        });
        $('.own_sold').click(function (e) {
            e.preventDefault();
            var pid = $('#hid_pid').val();
            var cid = $('#hid_cid').val();
          
            var postStatus="<?php echo $query[0]->postStatus; ?>";
           if(postStatus!='1'){
            swal("Product is not approved",'','error');
           }else{
            $.ajax({
                url: "<?php echo base_url(); ?>Trader/change_status_sold",
                data: {'pid': pid, 'cid': cid},
                type: "POST",

                success: function (data) {
                    if (data == 'success')
                    {

                        swal("Product Status  has been Successfully Updated");
                        setTimeout(function ()
                        {

                            location.reload();
                        }, 1000);
                    }

                }

            });
           }
         
        });

        $('.openModal').click(function () {
            var id = $(this).attr('data-id');
            //alert(id);return false;
            var data = 'product_id=' + id;
            $.ajax({
                url: "<?php echo base_url(); ?>Trader/fetch_proddet",
                data: data,
                type: "POST",

                success: function (data) {
                    $('#employee_detail').html(data);
                    $('#dataModal').modal("show");
                    $('#myModal').modal('hide');
                }

            });
        });
    });
    function check_als_cart(category_id, product_id, cart_type, post_id, userid, price)
    {
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
    function shared_modal(category_id, product_id)
    {
        $.ajax({
            url: "<?php echo base_url(); ?>Trader/fetch_proddet",
            data: {'product_id': product_id, 'cat_id': category_id},
            type: "POST",

            success: function (data) {
                $('#employee_detail').html(data);
                $('#dataModal').modal("show");
            }
        });
    }
    function show_popup()
    {
        $('#myModal').modal('show');
        $('#dataModal').modal("hide");
    }

    function watchlist_pg(product_id, cat_id, post_id, userid)
    {

        location.href = '<?php echo base_url() ?>Trader/check_log_watchlist/' + product_id + '/' + cat_id + '/' + post_id + '/' + userid;
    }
    function cartlist_pg(product_id, cat_id, post_id, userid)
    {

        location.href = '<?php echo base_url() ?>Trader/check_log_cartlist/' + product_id + '/' + cat_id + '/' + post_id + '/' + userid;
    }

    $('#catdet_mailbtn').click(function () {
        $('#myModal').modal('show');

    });
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

                        location.reload();
                    }, 1000);

                } else
                {
                    swal("Failed to report the flag.Try again");
                }
            }
        });
    });
    function show_flag_modal(category_id, product_id, cart_type, post_id, trader_id)
    {
        var cat_id = $('#categoryId').val();
        if((cat_id == 1)||(cat_id == 2)||(cat_id == 4)||(cat_id == 5)||(cat_id == 7)||(cat_id == 8)||(cat_id == 9))
        {
           jQuery.noConflict(); 
        }
        
        $('#pcatid').val(category_id);
        $('#prodid').val(product_id);
        $('#postid').val(post_id);
        $('#traderid').val(trader_id);
        $('#flagModal').modal("show");
        $('#dataModal').modal("hide");
    }
    function show_mail_popup()
    {
        var cat_id = $('#categoryId').val();
        if((cat_id == 1)||(cat_id == 2)||(cat_id == 4)||(cat_id == 5)||(cat_id == 7)||(cat_id == 8)||(cat_id == 9))
        {
           jQuery.noConflict(); 
        }
        $('#flagModal').modal("hide");
        $('#dataModal').modal("hide");
        $('#myModal').modal("show");
    }
</script>

