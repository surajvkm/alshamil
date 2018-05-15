<!-- start section -->

<section class="section white-backgorund">
    <div class="container">
        <div class="row">
            <!-- start sidebar -->
            <div class="col-md-12">
                <div class="col-md-3 col-sm-3 px-0">
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
                        <div id="show_notif_parent">
                            <a style="cursor:pointer" onclick="fetch_all_notifs('<?php echo $trader_id ?>')" id="show_notif">  
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
                            <span class="spanamts">Total amount received:</span><span class="trader_prof_amts"><?php
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
                <?php //
                $this->load->view('trader/advancedSearch_vw'); ?>
                    <!-- end widget -->
                </div>


                <!-- end col -->
                <!-- end sidebar -->
                <div class="col-sm-9 col-md-9 trimgpost_div temp-hide">
                    <div class="row">
                        <center>
                            <button class="status_btns" id="appbtn">Approved<span id="apprcnt"><?php echo $appr_post_cnt ?></span></button>
                            <button class="status_btns" id="pendbtn">Pending<span id="pendrcnt"><?php echo $pend_post_cnt ?></span></button>
                            <button class="status_btns" id="rejbtn">Rejected<span id="rejcnt"><?php echo $rej_post_cnt ?></span></button>
                        </center>
                    </div>
                    <!-- end row -->
                </div>
                <div class="col-sm-9 trimgpost_div temp-hide" id="notif_div">
                    <div class="row">
                        <div id="category_title_div">
                            <h4 id="notif_div_title">NOTIFICATIONS</h4>
                        </div>
                        <hr class="sep_hr">        
                    </div>
                    <div id="testp"></div>
                </div>

                <div class="col-md-9 col-sm-9 trapppost_div temp-hide pr-0" id="postappr_div">
                    <div class="row">
                        <?php
                        if (count($app_qry) > 0) {
                            foreach ($app_qry as $r) {
                            
                                
                          //   if(isset($session_data))
                              

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
                                    $product_name = $r->product_name7;
                                } else if ($r->product_name8 != '') {
                                    $product_name = $r->product_name8;
                                } else if ($r->product_name9 != '') {
                                    $product_name = $r->product_name9;
                                } else {

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
                                if ($r->productCStatus != '') {
                                    $product_status = $r->productCStatus;
                                } else if ($r->productBStatus != '') {
                                    $product_status = $r->productBStatus;
                                } else if ($r->productBTStatus != '') {
                                    $product_status = $r->productBTStatus;
                                } else if ($r->productWStatus != '') {
                                    $product_status = $r->productWStatus;
                                } else if ($r->productVStatus != '') {
                                    $product_status = $r->productVStatus;
                                } else if ($r->productNPStatus != '') {
                                    $product_status = $r->productNPStatus;
                                } else if ($r->productPHStatus != '') {
                                    $product_status = $r->productPHStatus;
                                } else if ($r->productMNStatus != '') {
                                    $product_status = $r->productMNStatus;
                                } else if ($r->productPRStatus != '') {
                                    $product_status = $r->productPRStatus;
                                } else {

                                    $product_status = '';
                                }
                                if ($r->productCategoryID == 1) {
                                    $r->CallPrice = $r->productCCallPrice;
                                  
                                } else if ($r->productCategoryID == 2) {
                                    $r->CallPrice = $r->productBCallPrice;
                                 
                                } else if ($r->productCategoryID == 3) {
                                    $r->CallPrice= $r->productNPCallPrice;
                                
                                } else if ($r->productCategoryID == 4) {
                                    $r->CallPrice = $r->productVCallPrice;
                              
                                } else if ($r->productCategoryID == 5) {
                                    $r->CallPrice= $r->productWCallPrice;
                             
                                } else if ($r->productCategoryID  == 6) {
                                    $r->CallPrice= $r->productMNCallPrice;
                                 
                                } else if ($r->productCategoryID == 7) {
                                    $r->CallPrice = $r->productBtCallPrice;
                                
                                } else if ($r->productCategoryID  == 8) {
                                    $r->CallPrice = $r->productPhCallPrice;
                             
                                } else if ($r->productCategoryID  == 9) {
                                    $r->CallPrice = $r->productPropCallPrice;
                               
                                } else {
                                    $r->CallPrice= "";
                               
                                }
                            //   var_dump($r); exit; 
                                ?>
                                <a class="details_anc" href="<?php echo base_url() ?>Trader/category_details/<?php echo $r->productID; ?>/<?php echo $r->productCategoryID; ?>">

                                    <div class="col-md-4 col-sm-4 catpostimgs">
                                                <?php
                                                if ($product_status == 2) {
                                                    ?>
                                                    <button class="book_btn">BOOKED</button>
                                                <?php }
                                                ?>
                                                <img src="<?php echo $img ?>" class="post_imgs">
                                                <div class="proftradet_details">
                                                    <div class="col-md-12 mainprdspan">

                                                        <div class="col-xs-4 col-sm-4 mainprdspan">
                                                            <span>Product</span><br>
                                                            <span>Price</span>

                                                        </div>
                                                        <div class="col-xs-8 col-sm-8 mainprdspan">
                                                            <span><?php echo $product_name ?></span><br>
                                                            <span><?php $this->Trader_mdl->formataed($product_price,$r->CallPrice); ?></span>
                                                        </div>    

                                                    </div>  
                                                    <div class="col-md-12 mainprdspan">
                                                        <hr class="cat_hr">
                                                    </div>
                                                    </a>
                                                    <div class="col-sm-12 category-dateview">
                                                        <?php
                                                        $d = $r->postSubmissionOn;
                                                        $d1 = strtotime($d);
                                                        ?>
                                                        <span class="other_date"><?php echo date('d M Y', $d1) ?></span>
                                                        <span class="other_view"><?php echo $r->productViewCount ?> View</span>
                                                      <br>
                                                         <span style="float:left">
                                                         <?php
                                                    if($session_data['plantype']!=1){
                                                        ?>
                                                         <button id="btneditpost" style='left:0px;' onclick="edit_post('<?php echo $r->productID ?>', '<?php echo $r->productCategoryID ?>')">Edit Post</button>
                                                         <?php
                                                         }
                                                      ?>
                                                        </span>
                                                    </div>
                                                </div>

                                            </div>
                            
                                <?php
                            }
                        } else {
                            ?>
                            <div class="trader-profile-no"><?php echo 'No approved posts'; ?></div>
                            <?php
                        }
                        ?>



                    </div>
                    <!-- end row -->
                </div>
                <div class="col-sm-9 trapppost_div pr-0 temp-hide" id="postpend_div">
                    <div class="row">
                        <?php
                        if (count($pend_qry) > 0) {
                            foreach ($pend_qry as $r) {

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
                                } else {

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
                                if ($r->productCategoryID == 1) {
                                    $r->CallPrice = $r->productCCallPrice;
                                  
                                } else if ($r->productCategoryID == 2) {
                                    $r->CallPrice = $r->productBCallPrice;
                                 
                                } else if ($r->productCategoryID == 3) {
                                    $r->CallPrice= $r->productNPCallPrice;
                                
                                } else if ($r->productCategoryID == 4) {
                                    $r->CallPrice = $r->productVCallPrice;
                              
                                } else if ($r->productCategoryID == 5) {
                                    $r->CallPrice= $r->productWCallPrice;
                             
                                } else if ($r->productCategoryID  == 6) {
                                    $r->CallPrice= $r->productMNCallPrice;
                                 
                                } else if ($r->productCategoryID == 7) {
                                    $r->CallPrice = $r->productBtCallPrice;
                                
                                } else if ($r->productCategoryID  == 8) {
                                    $r->CallPrice = $r->productPhCallPrice;
                             
                                } else if ($r->productCategoryID  == 9) {
                                    $r->CallPrice = $r->productPropCallPrice;
                               
                                } else {
                                    $r->CallPrice= "";
                               
                                }
                                ?>

                                    <div class="col-sm-4 col-md-4 catpostimgs">
                                        <a class="details_anc" href="<?php echo base_url() ?>Trader/category_details/<?php echo $r->productID; ?>/<?php echo $r->productCategoryID; ?>">

                                                    <img src="<?php echo $img ?>" class="post_imgs">
                                                </a>
                                        <div class="proftradet_details">
                                            <div class="col-md-12 mainprdspan">

                                                <div class="col-sm-4 mainprdspan">
                                                    <span>Product</span><br>
                                                    <span>Price</span>

                                                </div>
                                                <div class="col-sm-8 mainprdspan">
                                                    <span><?php echo $product_name ?></span><br>
                                                    <span><?php $this->Trader_mdl->formataed($product_price,$r->CallPrice); ?></span>
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
                                                <button id="btneditpost" onclick="edit_post('<?php echo $r->productID ?>', '<?php echo $r->productCategoryID ?>')">Edit Post</button>

                                            </div>
                                        </div>
                                    </div>
                               
                                <?php
                            }
                        } else {
                            ?>
                            <div class="trader-profile-no"><?php echo 'No pending posts'; ?></div>
                            <?php
                        }
                        ?>



                    </div>
                    <!-- end row -->
                </div>
                <div class="col-sm-9 trapppost_div temp-hide pr-0" id="postrej_div">
                    <div class="row">

                        <?php
                        if (count($rej_qry) > 0) {
                            foreach ($rej_qry as $r) {
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
                                    $product_name = $r->product_name7;
                                } else if ($r->product_name8 != '') {
                                    $product_name = $r->product_name8;
                                } else if ($r->product_name9 != '') {
                                    $product_name = $r->product_name9;
                                } else {

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
                                if ($r->productCategoryID == 1) {
                                    $r->CallPrice = $r->productCCallPrice;
                                  
                                } else if ($r->productCategoryID == 2) {
                                    $r->CallPrice = $r->productBCallPrice;
                                 
                                } else if ($r->productCategoryID == 3) {
                                    $r->CallPrice= $r->productNPCallPrice;
                                
                                } else if ($r->productCategoryID == 4) {
                                    $r->CallPrice = $r->productVCallPrice;
                              
                                } else if ($r->productCategoryID == 5) {
                                    $r->CallPrice= $r->productWCallPrice;
                             
                                } else if ($r->productCategoryID  == 6) {
                                    $r->CallPrice= $r->productMNCallPrice;
                                 
                                } else if ($r->productCategoryID == 7) {
                                    $r->CallPrice = $r->productBtCallPrice;
                                
                                } else if ($r->productCategoryID  == 8) {
                                    $r->CallPrice = $r->productPhCallPrice;
                             
                                } else if ($r->productCategoryID  == 9) {
                                    $r->CallPrice = $r->productPropCallPrice;
                               
                                } else {
                                    $r->CallPrice= "";
                               
                                }
                                ?>
                                <div class="col-sm-4 catpostimgs">


                                    <a class="details_anc" href="<?php echo base_url() ?>Trader/category_details/<?php echo $r->productID; ?>/<?php echo $r->productCategoryID; ?>">

                                        <img src="<?php echo $img ?>" class="post_imgs">
                                    </a>    
                                    <div class="proftradet_details">
                                        <div class="col-md-12 mainprdspan">

                                            <div class="col-sm-4 mainprdspan">
                                                <span>Product</span><br>
                                                <span>Price</span>

                                            </div>
                                            <div class="col-sm-8 mainprdspan">
                                                <span><?php echo $product_name ?></span><br>
                                                <span><?php $this->Trader_mdl->formataed($product_price,$r->CallPrice); ?></span>
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
                                            <img src="<?php echo base_url(); ?>img/reject-post-info.png" id="user_postr_img" onclick="show_reject('<?php echo $r->postID ?>')">
                                            
                                        </div>
                                        <div class="reject"  id="reject_<?php echo $r->postID ?>">
                                            <textarea rows='1' class="rej_post_textarea" id="post_rej_textarea"><?php echo $r->rejectMsg ?></textarea><br>
                                                <button style='display:none' class="edit_repost_btn" onclick="edit_post('<?php echo $r->productID ?>', '<?php echo $r->productCategoryID ?>')">Edit and Repost</button>
                                            </div>
                                    </div>
                                </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="trader-profile-no"><?php echo 'No rejected posts'; ?></div>
                                <?php
                            }
                            ?>



                        </div>
                        <!-- end row -->

                    </div>
                    <div class="col-sm-9" id="imgpost_div"></div> 
                    <!-- Binds search results-->

                </div>
        </div>
        <!-- end row --> 
        <div class="col-md-12">
            <div class="row">
                <div class="temp-hide" id="pagination_prof">
                    <ul class="tsc_pagination">


                        <?php
                        foreach ($links as $link) {
                            echo "<li>" . $link . "</li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>




    </div>
    <!-- end container -->
</section>

<!-- end section -->
<?php $this->load->view('trader/recently_viewed_vw'); ?>

<script>
    function check_add_post()
    {
        $.ajax({
            url: "<?php echo base_url('Trader/trader_check_addpost'); ?>",

            type: "POST",
            success: function (data) {
                if (data == 0)
                {
                    location.href = '<?php echo base_url() ?>Trader/add_post';
                } else if (data == 1)
                {
                    location.href = '<?php echo base_url() ?>Trader/plans';
                } else if (data == 2)
                {
                    location.href = '<?php echo base_url() ?>Trader/fetch_payment_options';
                } else
                {
                    swal('Please Contact Admin Team');
                    setTimeout(function ()
                    {

                        location.href = '<?php echo base_url() ?>Trader';
                    }, 2000);

                }
            }

        });
    }
    function show_reject(x)
    {
        $('#reject_' + x).slideToggle();
        $('#reject_img_details_' + x).css('border-bottom-left-radius', '0px');
        $('#reject_img_details_' + x).css('border-bottom-right-radius', '0px');
    }
    function edit_post(product_id, category_id)
    {
        location.href = '<?php echo base_url() ?>Trader/tr_edit_post/' + product_id + '/' + category_id;

    }
    function fetch_all_notifs(trader_id)
    {
        var data = 'userId=' + trader_id + '&page=0&perPageCount=10';

        $.ajax({
            type: "GET",
            dataType: 'json',
            url: "<?php echo base_url()?>"+"TraderController/GetNotificationsBy",
         

            data: data,

            success: function (data) {



                $('#status_divs').css('display', 'none');
                $('#postappr_div').css('display', 'none');

                $('#notif_div').css('display', 'block');

                var output = "";

                $.each(data.data.Post, function (i, item) {
                    console.log(item);
                    if (item.isTypeFlagged == 1)
                    {
                        output += ' <div class="col-md-12 col-sm-12" id="trnotif_main_div notifi-main" class="height-maindiv"><div class="row"><div class="col-xs-5 col-md-3 col-sm-3 pl-0 pr-0">' +
                                ' <img src="' + item.traderImage + '" class="notif_trimg">' +
                                '<p class="notif_trname">' + item.traderFullName + '</p>' +
                                '<p class="notif_flagpost">Flagged your product</p>' +
                                '</div>' +
                                '<div class="col-xs-3 col-sm-3"><img src="<?php echo base_url(); ?>img/profile-notification-flag.png" class="notif_flag_img"></div>' +
                                '<div class="col-xs-3 col-sm-4 col-md-3 notif_date_col pl-0 pr-0">' + item.date + '</div></div>' +
                                '<div class="row notif_prddetails"><div class="col-xs-6 col-sm-3 col-md-2"><img src="' + item.image + '" class="notif_prd_img"/>' +
                                '</div><div class="col-xs-6 col-sm-3 col-md-2 prddet_col pr-0"><p class="notif_prname">' + item.brand + " " + item.model + '</p>' +
                                '<p class="notif_prprice">AED ' + item.price + '</p></div><div class="col-xs-12 col-sm-8 col-md-8"><p>' + item.description + '.</p></div><hr class="sep_hr margin-line"></div></div></div>';

                    } else
                    {
                        output += ' <div class="col-xs-12 col-md-12 col-sm-12 pr-0 pl-0" id="trnotif_main_div notifi-main"><div class="row"><div class="col-xs-5 col-md-2 col-sm-3 col-md-9 pr-xs-0">' +
                                ' <img src="' + item.traderImage + '" class="notif_trimg">' +
                                '<p class="notif_trname">' + item.traderFullName + '</p>' +
                                '</div>' +
                                '<div class="col-xs-5 col-sm-4 col-md-3 notif_date_col">' + item.date + '</div></div>' +
                                '<div class="col-xs-12 col-sm-12"><p>' + item.description + '.</p></div><hr class="sep_hr margin-line2"></div></div>';
                    }
                });


                $('#testp').html(output);


            }

        });


    }
    $(document).click(function(e) {
    var target = e.target;

    if (!$(target).is('#show_notif') && !$(target).parents().is('#show_notif_parent')) {
        $('#notif_div').css('display', 'none');
    }
});
    $(document).ready(function () {
       


        $('#appbtn').click(function () {
            $('#postappr_div').css('display', 'block');
            $('#postrej_div').css('display', 'none');
            $('#postpend_div').css('display', 'none');
            $('#appbtn').css('background-color', 'green');
            $('#appbtn').css('color', 'white');
            $('#pendbtn').css('background-color', 'white');
            $('#pendbtn').css('color', 'red');
            $('#rejbtn').css('background-color', 'white');
            $('#rejbtn').css('color', 'red');
            $('#pendbtn').css('color', 'red');

        });
        $('#pendbtn').click(function () {
            $('#postpend_div').css('display', 'block');
            $('#postrej_div').css('display', 'none');
            $('#postappr_div').css('display', 'none');
            $('#pendbtn').css('background-color', '#f5821f');
            $('#pendbtn').css('color', 'white');
            $('#appbtn').css('background-color', 'white');
            $('#appbtn').css('color', 'red');
            $('#rejbtn').css('background-color', 'white');
            $('#rejbtn').css('color', 'red');

        });
        $('#rejbtn').click(function () {
            $('#postrej_div').css('display', 'block');
            $('#postappr_div').css('display', 'none');
            $('#postpend_div').css('display', 'none');
            $('#rejbtn').css('background-color', 'red');
            $('#rejbtn').css('color', 'white');
            $('#pendbtn').css('background-color', 'white');
            $('#pendbtn').css('color', 'red');
            $('#appbtn').css('background-color', 'white');
            $('#appbtn').css('color', 'red');

        });

    });
</script>