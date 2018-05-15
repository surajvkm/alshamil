<!-- start section -->
<?php

$slang = 'english';
if($this->session->userdata('site_lang')){
 	
 	$slang =$this->session->userdata('site_lang');
}

?>
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
                                <a href="<?php echo base_url() ?>Trader/edit_profile/<?php echo $query[0]->traderId ?>" id="prof_editanc">
                                    <span><img src="<?php echo base_url(); ?>img/profile-edit-profile.png" id="edit_img_icon" ></span>
                                    <span>Edit</span> 
                                </a>
                            </div>
                        </div>
                        <center>
                            <?php
                            if ($query[0]->image != '' && (@getimagesize($query[0]->image))) {
                                ?>
                                <img src="<?php echo $query[0]->image ?>" class="user_prof">
                                <?php
                            } else {
                                ?>
                                <img src="<?php echo base_url() ?>img/userProfileIcon_gray.png" class="user_prof">
                                <?php
                            }
                            ?>

                            <p class="tr_name"><?php echo $query[0]->fullName; ?></p>
                            <p class="tr_place"><?php echo $query[0]->location; ?></p>
                        </center>
                        <hr class="cat_hr">
                        <p id="days_bal"><?php echo $msg ?></p>
                        <div id="payamtdiv">
                            <span class="spanamts">Total amount paid:</span><span class="trader_prof_amts"><?php
                                if ($trader_tot_amt == '')
                                    echo 'AED 0';
                                else
                                    echo $this->View_Model->formataed($trader_tot_amt);
                                ?></span>
                            <hr class="cat_hr">
                            <span class="spanamts">Total post:</span><span class="trader_prof_amts"><?php echo $total_post ?></span>
                            <hr class="cat_hr">
                            <span ><a href="<?php echo base_url() ?>trader/trader_sold" class="spanamts">Sold:</a></span><span class="trader_prof_amts"><?php echo $total_sold_cnt ?></span>
                            <hr class="cat_hr">
                            <span ><a href="<?php echo base_url() ?>trader/trader_booked" class="spanamts">Booked:</a></span><span class="trader_prof_amts"><?php echo $total_book_cnt ?></span>
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
                                    if ($query[0]->socialTwitter != '') {
                                        ?>
                                        <a href="http://<?php echo $query[0]->socialTwitter ?>" target="_blank">

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
                    <?php $this->load->view('client/advancedSearch'); ?>
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
                                
                                        if($slang=='arabic'){
								$title_home=$r->productTitleAr;
								}else{
									$title_home= $r->productTitle;
								}
           					$main_title = ucwords(str_replace(" ",' ',rtrim($title_home)));
           					
           					$title = strtolower(str_replace(" ",'-',$r->Name));
           					$title_url = strtolower(str_replace(" ",'-',rtrim($title_home)));
                            $encoe = alphaID($r->productId,false,5);
                                
                                
                                ?>

                        <div class="col-sm-4 catpostimgs">
                                    <a class="details_anc" href="<?php echo base_url() ?><?php echo $title ?>/<?php echo $title_url ?>_<?php echo $encoe; ?>">

                                        <img src="<?php echo $r->mainImage ?>"  class="post_imgs">
                                    </a>
                                    <div class="proftradet_details">
                                        <div class="col-md-12 mainprdspan">

                                            <div class="col-sm-4 mainprdspan">
                                                <span>Product</span><br>
                                                <span>Price</span>

                                            </div>
                                            <div class="col-sm-8 mainprdspan">
                                               <span><?php echo $main_title ?></span><br>
                                                            <span><?php $this->View_Model->formataed($r->price,$r->callForPrice); ?></span>
                                            </div>    

                                        </div>  
                                        <div class="col-md-12 mainprdspan">
                                            <hr class="cat_hr">
                                        </div>
                                        <div class="col-sm-12 category-dateview">
                                            <?php
                                            $d = $r->submittedOn;
                                            $d1 = strtotime($d);
                                            ?>
                                            <span class="other_date"><?php echo date('d M Y', $d1) ?></span>
                                            <button class="btn_soldrm" id="btneditpost" onclick="remove_solditems('<?php echo $r->productId ?>', '<?php echo $r->productCategoryId ?>')">Remove</button>
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
        </div>
</section>

<!-- end section -->
<?php $this->load->view('client/recently_viewed'); ?>
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