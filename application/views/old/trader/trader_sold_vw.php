<!-- start section -->
<section class="section white-backgorund">
    <div class="container">
        <div class="row">
            <!-- start sidebar -->

            <div class="col-md-12">
                <div class="col-sm-3">
                    <div class="widget">
                        <img src="<?php echo base_url(); ?>img/profile-add-post.png" id="plus_square" >

                        <button type="button" onclick="check_add_post()" class="btnadpost">Add Post</button>
                    </div>
                    <!-- end widget -->
                    <div class="widget widget_myprof">
                        <?php
                        $session_data = $this->session->userdata('logged_in');
                        $trader_id = $session_data['trader_id'];
                        ?>
                        <div>
                            <a style="cursor:pointer" onclick="fetch_all_notifs('<?php echo $trader_id ?>')">  
                                <img src="<?php echo base_url(); ?>img/profile-notification.png" id="bell_img_icon" >
                                <sup>
                                    <span class="fa-stack fa-1x" id="notif_circle">
                                        <i class="fa fa-circle fa-stack-2x icon-background_notif"></i>
                                        <?php
                                        if (isset($notification)) {

                                            foreach ($notification as $r)
                                                
                                                ?>

                                        <!--span  class="fa fa-stack-1x tct"><a href="<?php echo base_url() ?>Trader/trader_notifications/<?php echo $trader_id ?>"><?php echo $count ?></a></span-->
                                            <span  class="fa fa-stack-1x tct"><?php echo $count ?></span>

                                            <?php
                                        } else {
                                            ?>
                                            <span  class="fa fa-stack-1x tct">0</span>
                                            <?php
                                        }
                                        ?>
                                    </span>

                                </sup>
                            </a>
                            <div style="float:right;">
                                <a href="<?php echo base_url() ?>Trader/edit_prof/<?php echo $query[0]->traderID ?>" id="prof_editanc">
                                    <span><img src="<?php echo base_url(); ?>img/profile-edit-profile.png" id="edit_img_icon" ></span>
                                    <span>Edit</span> 
                                </a>
                            </div>
                        </div>
                        <center>
                            <?php
                            if ($query[0]->traderImage != '' && (@getimagesize($query[0]->traderImage))) {
                                ?>
                                <img src="<?php echo $query[0]->traderImage ?>" class="user_prof">
                                <?php
                            } else {
                                ?>
                                <img src="<?php echo base_url() ?>img/userProfileIcon_gray.png" class="user_prof">
                                <?php
                            }
                            ?>

                            <p class="tr_name"><?php echo $query[0]->traderFullName; ?></p>
                            <p class="tr_place"><?php echo $query[0]->traderLocation; ?></p>
                        </center>
                        <hr class="cat_hr">
                        <p id="days_bal"><?php echo $msg ?></p>
                        <div id="payamtdiv">
                            <span class="spanamts">Total amount paid:</span><span class="trader_prof_amts"><?php
                                if ($trader_tot_amt == '')
                                    echo 'AED 0';
                                else
                                    echo $this->Trader_mdl->formataed($trader_tot_amt);
                                ?></span>
                            <hr class="cat_hr">
                            <span class="spanamts">Total post:</span><span class="trader_prof_amts"><?php echo $total_post ?></span>
                            <hr class="cat_hr">
                            <span ><a href="<?php echo base_url() ?>Trader/trader_sold" class="spanamts">Sold:</a></span><span class="trader_prof_amts"><?php echo $total_sold_cnt ?></span>
                            <hr class="cat_hr">
                            <span ><a href="<?php echo base_url() ?>Trader/trader_booked" class="spanamts">Booked:</a></span><span class="trader_prof_amts"><?php echo $total_book_cnt ?></span>
                        </div>
                        <div class="tr_social">
                            <center>
                                <span>
                                    <?php
                                    if ($query[0]->socialWeb != '') {
                                        ?>
                                        <a href="http://<?php echo $query[0]->socialWeb; ?>" target="_blank">
                                            <img src="<?php echo base_url(); ?>img/social-web.png" class="social">
                                        </a>
                                        <?php
                                    }
                                    ?>
                                </span>
                                <span>
                                    <?php
                                    if ($query[0]->socialtwitter != '') {
                                        ?>
                                        <a href="http://<?php echo $query[0]->socialtwitter ?>" target="_blank">

                                            <img src="<?php echo base_url(); ?>img/social-twitter.png" class="social">
                                        </a>
                                        <?php
                                    }
                                    ?>

                                </span>
                                <span>
                                    <?php
                                    if ($query[0]->socialFb != '') {
                                        ?>
                                        <a href="http://<?php echo $query[0]->socialFb; ?>" target="_blank">
                                            <img src="<?php echo base_url(); ?>img/social-facebook.png" class="social">
                                        </a>         
                                        <?php
                                    }
                                    ?>

                                </span>
                                <span>
                                    <?php
                                    if ($query[0]->socialInsta != '') {
                                        ?>
                                        <a href="http://<?php echo $query[0]->socialInsta; ?>" target="_blank">
                                            <img src="<?php echo base_url(); ?>img/social-instagram.png" class="social">
                                        </a>        
                                        <?php
                                    }
                                    ?>

                                </span>
                                <span>
                                    <?php
                                    if ($query[0]->socialSnap != '') {
                                        ?>
                                        <a href="http://<?php echo $query[0]->socialSnap; ?>" target="_blank">
                                            <img src="<?php echo base_url(); ?>img/social-snapchat.png" class="social">
                                        </a>                 
                                        <?php
                                    }
                                    ?>

                                </span>
                            </center>
                        </div>
                    </div>
                    <?php $this->load->view('trader/advancedSearch_vw'); ?>
                    <!-- end widget -->
                </div>

                <!-- end col -->
                <!-- end sidebar -->

                <div class="col-sm-9 trimgpost_div temp-hide">
                    <div class="row">
                        <h5 class="sold_div_title">SOLD</h5>
                    </div>
                </div>
                <div class="col-sm-9 trapppost_div temp-hide">
                    <div class="row">
                        <?php
                        if (count($sold_qry) > 0) {
                            foreach ($sold_qry as $r) {
                                if ($r->Cpost_main_img != '' && (@getimagesize($r->Cpost_main_img))) {
                                    $img = $r->Cpost_main_img;
                                } else if ($r->Bpost_main_img != '' && (@getimagesize($r->Bpost_main_img))) {
                                    $img = $r->Bpost_main_img;
                                } else if ($r->BTpost_main_img != '' && (@getimagesize($r->BTpost_main_img))) {
                                    $img = $r->BTpost_main_img;
                                } else if ($r->Wpost_main_img != '' && (@getimagesize($r->Wpost_main_img))) {
                                    $img = $r->Wpost_main_img;
                                } else if ($r->Vpost_main_img != '' && (@getimagesize($r->Vpost_main_img))) {
                                    $img = $r->Vpost_main_img;
                                } else if ($r->PRpost_main_img != '' && (@getimagesize($r->PRpost_main_img))) {
                                    $img = $r->PRpost_main_img;
                                } else if ($r->PHpost_main_img != '' && (@getimagesize($r->PHpost_main_img))) {
                                    $img = $r->PHpost_main_img;
                                } else if ($r->NPpost_main_img != '' && (@getimagesize($r->NPpost_main_img))) {
                                    $img = $r->NPpost_main_img;
                                } else if ($r->MNpost_main_img != '' && (@getimagesize($r->MNpost_main_img))) {
                                    $img = $r->MNpost_main_img;
                                } else {

                                    $img = base_url() . 'img/no_preview.png';
                                }
                                if ($r->product_name1 != '') {
                                    $product_name = $r->product_name1;
                                } else if ($r->product_name2 != '') {
                                    $product_name = $r->product_name2;
                                } else if ($r->product_name3 != '') {
                                    $product_name = $r->product_name3;
                                } else if ($r->product_name4 != '') {
                                    $product_name = $r->product_name4;
                                } else if ($r->product_name5 != '') {
                                    $product_name = $r->product_name5;
                                } else if ($r->product_name6 != '') {
                                    $product_name = $r->product_name6;
                                } else if ($r->product_name7 != '') {
                                    $product_name = $r->product_name7;
                                } else if ($r->product_name8 != '') {
                                    $product_name = $r->product_name8;
                                } else if ($r->product_name9 != '') {
                                    $product_name = $r->product_name9;
                                }else {

                                    $product_name = '';
                                }
                                if ($r->productCPrice != '') {
                                    $product_price = $r->productCPrice;
                                } else if ($r->productBPrice != '') {
                                    $product_price = $r->productBPrice;
                                } else if ($r->productBTPrice != '') {
                                    $product_price = $r->productBTPrice;
                                } else if ($r->productWPrice != '') {
                                    $product_price = $r->productWPrice;
                                } else if ($r->productVPrice != '') {
                                    $product_price = $r->productVPrice;
                                } else if ($r->productPRPrice != '') {
                                    $product_price = $r->productPRPrice;
                                } else if ($r->productPHPrice != '') {
                                    $product_price = $r->productPHPrice;
                                } else if ($r->productNPPrice != '') {
                                    $product_price = $r->productNPPrice;
                                } else if ($r->productMNPrice != '') {
                                    $product_price = $r->productMNPrice;
                                } else {

                                    $product_price = '';
                                }
                                ?>

                        <div class="col-sm-4 catpostimgs">
                                    <a class="details_anc" href="<?php echo base_url() ?>Trader/category_details/<?php echo $r->productID; ?>/<?php echo $r->productCategoryID; ?>">

                                        <img src="<?php echo $img ?>"  class="post_imgs">
                                    </a>
                                    <div class="proftradet_details">
                                        <div class="col-md-12 mainprdspan">

                                            <div class="col-sm-4 mainprdspan">
                                                <span>Product</span><br>
                                                <span>Price</span>

                                            </div>
                                            <div class="col-sm-8 mainprdspan">
                                                <span><?php echo $product_name ?></span><br>
                                                <span><?php $this->Trader_mdl->formataed($product_price); ?></span>
                                            </div>    

                                        </div>  
                                        <div class="col-md-12 mainprdspan">
                                            <hr class="cat_hr">
                                        </div>
                                        <div class="col-sm-12 category-dateview">
                                            <?php
                                            $d = $r->postSubmissionOn;
                                            $d1 = strtotime($d);
                                            ?>
                                            <span class="other_date"><?php echo date('d M Y', $d1) ?></span>
                                            <button class="btn_soldrm" id="btneditpost" onclick="remove_solditems('<?php echo $r->productID ?>', '<?php echo $r->productCategoryID ?>')">Remove</button>
                                        </div>

                                    </div>
                                </div>
                               
                                <?php
                            }
                        } else {
                            echo '<center class="nomsgdiv">No Sold Items</center>';
                        }
                        ?>
                    </div>
                    <!-- end row -->
                </div>
                <!-- end col -->
                <div class="col-sm-9" id="imgpost_div"></div>  
            </div>
            <!-- end row --> 

        </div>
        <!-- end container -->
</section>

<!-- end section -->
<?php $this->load->view('trader/recently_viewed_vw'); ?>
<script>
    function remove_solditems(pid, cid)
    {

        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this post item!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, I am sure!',
            cancelButtonText: "No, cancel it!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
                function (isConfirm) {
                    if (isConfirm) {
                        swal({
                            title: 'Removed!',
                            text: 'Your Product is removed!',
                            type: 'success'
                        }, function () {

                            $.ajax({
                                url: "<?php echo base_url(); ?>/Trader/remove_solditems",
                                data: {'pid': pid, 'cid': cid},
                                type: "POST",

                                success: function (data) {

                                    if (data == 'success')
                                    {

                                        setTimeout(function ()
                                        {
                                            location.reload();  //Refresh page

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
    
</script>