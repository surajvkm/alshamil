<!-- start section -->
<section class="section white-backgorund">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 px-0">
                <!-- start sidebar -->
                <div class="col-sm-3">


                    <div class="widget widget_myprof">

                        <input type="hidden" name="trader_id"  value="<?php echo $trader_id; ?>"/>
                        <center>
                            <?php
                            if (isset($qry[0]->traderImage)) {
                                if ($qry[0]->traderImage != '' && (@getimagesize($qry[0]->traderImage))) {
                                    ?>
                                    <img src="<?php echo $qry[0]->traderImage ?>" class="user_prof">
                                    <?php
                                } else {
                                    ?>
                                    <img src="<?php echo base_url() ?>img/userProfileIcon_gray.png" class="user_prof">
                                    <?php
                                }
                            } else {
                                ?>
                                <img src="<?php echo base_url() ?>img/userProfileIcon_gray.png" class="user_prof">
                                <?php
                            }
                            ?>      


                            <p class="tr_name"><?php echo $qry[0]->traderFullName ?></p>
                            <p class="tr_place"><?php echo $qry[0]->traderLocation ?></p>
                            <button class="btncons catdet_phone"><img src="<?php echo base_url() ?>img/post-detail-phone.png"> <span class="poster_contact"><?php echo $qry[0]->traderContactNum ?></span></button>


                        </center>
                        <div class=" col-xs-12 col-sm-12 col-md-12 pr-0">
                            <div class="col-xs-6 col-sm-6 col-md-6 mailchatdiv">
                                <button class="btncons catdet_mailbtn"  <?php if (isset($_SESSION['logged_in'])) { ?> onclick="show_mail_popup()" <?php } else { ?> disabled <?php } ?> ><i class="fa fa-envelope" aria-hidden="true"></i> Mail</button>
                            </div>
                            <div class="col-sm-6 col-xs-6 col-md-6 mailchatdiv">
                                <button class="btncons catdet_chatbtn" <?php if (isset($_SESSION['logged_in'])) echo "data-trader='".$qry[0]->traderID."' "."data-traderName='".$qry[0]->traderFullName."' " ?>  ><i class="fa fa-comments" aria-hidden="true"></i> Chat</button>
                            </div>
                        </div>



                        <div class="other_tr_social">
                            <center>
                                <span>
                                    <?php
                                    if ($qry[0]->socialWeb != '') {
                                        ?>
                                        <a href="http://<?php echo $qry[0]->socialWeb; ?>" target="_blank">
                                            <img src="<?php echo base_url(); ?>img/social-web.png" class="social">
                                        </a>
                                        <?php
                                    }
                                    ?>
                                </span>
                                <span>
                                    <?php
                                    if ($qry[0]->socialtwitter != '') {
                                        ?>
                                        <a href="http://<?php echo $qry[0]->socialtwitter ?>" target="_blank">

                                            <img src="<?php echo base_url(); ?>img/social-twitter.png" class="social">
                                        </a>
                                        <?php
                                    }
                                    ?>

                                </span>
                                <span>
                                    <?php
                                    if ($qry[0]->socialFb != '') {
                                        ?>
                                        <a href="http://<?php echo $qry[0]->socialFb; ?>" target="_blank">
                                            <img src="<?php echo base_url(); ?>img/social-facebook.png" class="social">
                                        </a>         
                                        <?php
                                    }
                                    ?>

                                </span>
                                <span>
                                    <?php
                                    if ($qry[0]->socialInsta != '') {
                                        ?>
                                        <a href="http://<?php echo $qry[0]->socialInsta; ?>" target="_blank">
                                            <img src="<?php echo base_url(); ?>img/social-instagram.png" class="social">
                                        </a>        
                                        <?php
                                    }
                                    ?>

                                </span>
                                <span>
                                    <?php
                                    if ($qry[0]->socialSnap != '') {
                                        ?>
                                        <a href="http://<?php echo $qry[0]->socialSnap; ?>" target="_blank">
                                            <img src="<?php echo base_url(); ?>img/social-snapchat.png" class="social">
                                        </a>                 
                                        <?php
                                    }
                                    ?>

                                </span>
                            </center>
                        </div>


                        <div class="othdetp"><?php echo $qry[0]->traderInfo ?></div> 
                    </div>
                    <?php $this->load->view('trader/advancedSearch_vw'); ?>

                </div><!-- end col -->

                <!-- end sidebar -->
                <div class="col-xs-12 col-sm-9 col-md-9 pl-0 trapppost_div temp-hide" id="postappr_div">
                    <div class="row">
                        <?php
                        if (count($product_qry) > 0) {
                            foreach ($product_qry as $row) {
                        
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
                                if ($row->productCStatus != '') {
                                    $product_status = $row->productCStatus;
                                } else if ($row->productBStatus != '') {
                                    $product_status = $row->productBStatus;
                                } else if ($row->productVStatus != '') {
                                    $product_status = $row->productVStatus;
                                } else if ($row->productWStatus != '') {
                                    $product_status = $row->productWStatus;
                                } else if ($row->productCStatus != '') {
                                    $product_status = $row->productCStatus;
                                } else if ($row->productBTStatus != '') {
                                    $product_status = $row->productBTStatus;
                                } else if ($row->productPHStatus != '') {
                                    $product_status = $row->productPHStatus;
                                } else if ($row->productMNStatus != '') {
                                    $product_status = $row->productMNStatus;
                                } else if ($row->productNPStatus != '') {
                                    $product_status = $row->productNPStatus;
                                } else {

                                    $product_status = '';
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
                                if ($row->productCategoryID == 1) {
                                    $row->CallPrice = $row->productCCallPrice;
                                  
                                } else if ($row->productCategoryID == 2) {
                                    $row->CallPrice = $row->productBCallPrice;
                                 
                                } else if ($row->productCategoryID == 3) {
                                    $row->CallPrice= $row->productNPCallPrice;
                                
                                } else if ($row->productCategoryID == 4) {
                                    $row->CallPrice = $row->productVCallPrice;
                              
                                } else if ($row->productCategoryID == 5) {
                                    $row->CallPrice= $row->productWCallPrice;
                             
                                } else if ($row->productCategoryID  == 6) {
                                    $row->CallPrice= $row->productMNCallPrice;
                                 
                                } else if ($row->productCategoryID == 7) {
                                    $row->CallPrice = $row->productBtCallPrice;
                                
                                } else if ($row->productCategoryID  == 8) {
                                    $row->CallPrice = $row->productPhCallPrice;
                             
                                } else if ($row->productCategoryID  == 9) {
                                    $row->CallPrice = $row->productPropCallPrice;
                               
                                } else {
                                    $row->CallPrice= "";
                               
                                }
                                ?>
                                <a class="details_anc"  href="<?php echo base_url() ?>Trader/category_details/<?php echo $row->productID; ?>/<?php echo $row->productCategoryID; ?>">

                                    <div class=" col-xs-11 col-sm-4 col-md-4 paddingright-0 catpostimgs" onmouseenter="$(this).find('.sidecrtdiv').fadeIn('200');" onmouseleave="$('.sidecrtdiv').css('display','none');">
                                        <?php
                                        if ($product_status == 2) {
                                            ?>
                                            <button class="book_btn">BOOKED</button>
                                        <?php }
                                         
                                        if ($product_status == 1) {
                                            ?>
                                            <button class="book_btn">SOLD</button>
                                        <?php }
                                        
                                        ?>
                                        <img src="<?php echo $img ?>" class="post_imgs">
                                        <div class="proftradet_details">
                                            <div class="col-md-12 mainprdspan">

                                                <div class="col-xs-3 col-sm-4 col-md-4 mainprdspan">
                                                    <span>Product</span><br>
                                                    <span>Price</span>

                                                </div>
                                                <div class="col-xs-9 col-sm-8 col-md-8 mainprdspan">
                                                    <span><?php echo $product_name ?></span><br>
                                                    <span><?php $this->Trader_mdl->formataed($product_price,$row->CallPrice); ?></span>
                                                </div>    

                                            </div>  
                                            <div class="col-md-12 mainprdspan">
                                                <hr class="cat_hr">
                                            </div>

                                            <div class="col-sm-12 category-dateview active">
                                                <?php
                                                $d = $row->postSubmissionOn;
                                                $d1 = strtotime($d);
                                                ?>
                                                <span class="other_date"><?php echo date('d M Y', $d1) ?></span>
                                                <span class="other_view"><?php echo $row->productViewCount ?> View</span>
                                                
                                            </div>
                                            <div class="col-sm-12 category-dateview">
                                            <div  class="sidecrtdiv socialiconsdiv" style="margin-left: -9px;
                                                    position: absolute;
                                                    width: 115%;
                                                    top: -32px;" id="sidebar_<?php echo $row->traderID ?>_<?php echo $row->productID ?>" >
                                        
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
                                                    <a class="newanc" onclick="check_als_cart('<?php echo $row->productCategoryID ?>', '<?php echo $row->productID ?>', '<?php echo $cart_type ?>', '<?php echo $row->postID ?>', '<?php echo $row->traderID ?>', '<?php echo $product_price ?>')">
                                           
                                                        <img id="shng_home" src="<?php echo base_url(); ?>img/post-add-cart.png">
                                                    </a>
                                                    <?php } } ?>
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
                                        </div> </div>

                                        </div>

                                    </div>
                                </a>  
                                <?php
                            }
                        } else {
                            echo "<center>No Item Posted</center>";
                        }
                        ?> 


                    </div>
                </div>
                <div class="col-sm-9" id="imgpost_div"></div>
            </div>

        </div><!-- end row --> 

        <div class="row temp-hide">
            <div id="pagination">
                <ul class="tsc_pagination">

                    <!-- Show pagination links -->
                    <?php
                    foreach ($links as $link) {
                        echo "<li>" . $link . "</li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div><!-- end container -->
</section>

<!-- end section -->

<?php $this->load->view('trader/recently_viewed_vw'); ?>   
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×</button>
                <h4 class="modal-title" id="myModalLabel">
                    Send Mail
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Nav tabs -->
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="Login">


                            <form role="form" class="form-horizontal" action="<?php echo base_url(); ?>Trader/mail_trader/<?php echo $qry[0]->traderID; ?>" method="post">
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
                            <form role="form" class="form-horizontal"  method="post">
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

    $(document).ready(function ()
    {


    });
    function show_mail_popup()
    {


        $('#myModal').modal("show");
    }




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

</script>



