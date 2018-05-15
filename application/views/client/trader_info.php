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
                            if (isset($qry[0]->image)) {
                                if ($qry[0]->image != '' && (@getimagesize($qry[0]->image))) {
                                    ?>
                                    <img src="<?php echo $qry[0]->image ?>" class="user_prof">
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


                            <p class="tr_name"><?php echo $qry[0]->fullName ?></p>
                            <p class="tr_place"><?php echo $qry[0]->location ?></p>
                            <button class="btncons catdet_phone"><img src="<?php echo base_url() ?>img/post-detail-phone.png"> <span class="poster_contact"><?php echo $qry[0]->contactNumber ?></span></button>


                        </center>
                        <div class=" col-xs-12 col-sm-12 col-md-12 pr-0">
                            <div class="col-xs-6 col-sm-6 col-md-6 mailchatdiv">
                                <button class="btncons catdet_mailbtn"  <?php 
                                if ($this->session->userdata('logged_in')) {
                                  ?> data-toggle="modal" data-target="#emailModal"  <?php } else { ?> disabled=""  <?php } ?> ><i class="fa fa-envelope" aria-hidden="true"></i> Mail</button>
                            </div>
                            <div class="col-sm-6 col-xs-6 col-md-6 mailchatdiv">
                                <button class="btncons catdet_chatbtn" <?php  if ($this->session->userdata('logged_in'))  echo "data-trader='".$qry[0]->traderId."' "."data-traderName='".$qry[0]->fullName."' " ?>  ><i class="fa fa-comments" aria-hidden="true"></i> Chat</button>
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
                                    if ($qry[0]->socialTwitter != '') {
                                        ?>
                                        <a href="http://<?php echo $qry[0]->socialTwitter ?>" target="_blank">

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
                    <?php $this->load->view('client/advancedSearch'); ?>

                </div><!-- end col -->

                <!-- end sidebar -->
                <div class="col-xs-12 col-sm-9 col-md-9 pl-0 trapppost_div temp-hide" id="postappr_div">
                    <div class="row">
                        <?php
                        if (count($records) > 0) {
                            foreach ($records as $row) {
                            	$this->db->select('Name');
                	            $Brand = $this->db->get_where('category',array('CategoryId'=>$row->subCategory1Id))->row();
                	            
                	            
                	            $this->db->select('Name');
                	            $Model= $this->db->get_where('category',array('CategoryId'=>$row->subCategory2Id))->row();
                        
                               
                                ?>
                                <a class="details_anc"  href="<?php echo base_url() ?>product_details/<?php echo $row->productId; ?>/<?php echo $row->productCategoryId; ?>">

                                    <div class=" col-xs-11 col-sm-4 col-md-4 paddingright-0 catpostimgs" onmouseenter="$(this).find('.sidecrtdiv').fadeIn('200');" onmouseleave="$('.sidecrtdiv').css('display','none');">
                                        <?php
                                        if ($row->status == 2) {
                                            ?>
                                            <button class="book_btn">BOOKED</button>
                                        <?php }
                                         
                                        if ($row->status == 1) {
                                            ?>
                                            <button class="book_btn">SOLD</button>
                                        <?php }
                                        
                                        ?>
                                        <img src="<?php echo $row->mainImage ?>" class="post_imgs">
                                        <div class="proftradet_details">
                                            <div class="col-md-12 mainprdspan">

                                                <div class="col-xs-3 col-sm-4 col-md-4 mainprdspan">
                                                    <span>Product</span><br>
                                                    <span>Price</span>

                                                </div>
                                                <div class="col-xs-9 col-sm-8 col-md-8 mainprdspan">
                                                    <span><?php echo $Brand->Name?$Brand->Name:'';  ?>
                                            	<?php 
                                            	
                                            	echo $Model->Name?$Model->Name:'';  
                                            	
                                            	if($Brand->Name=='' || $Model->Name='' )
                                            	echo $row->Name
                                            	?></span><br>
                                                    <span><?php $this->View_Model->formataed($row->price,$row->callForPrice); ?></span>
                                                </div>    

                                            </div>  
                                            <div class="col-md-12 mainprdspan">
                                                <hr class="cat_hr">
                                            </div>

                                            <div class="col-sm-12 category-dateview active">
                                                <?php
                                                $d = $row->submittedOn;
                                                $d1 = strtotime($d);
                                                ?>
                                                <span class="other_date"><?php echo date('d M Y', $d1) ?></span>
                                                <span class="other_view"><?php echo $row->viewCount ?> View</span>
                                                
                                            </div>
                                            <div class="col-sm-12 category-dateview">
                                            <div  class="sidecrtdiv socialiconsdiv" style="margin-left: -9px;
                                                    position: absolute;
                                                    width: 115%;
                                                    top: -32px;" id="sidebar_<?php echo $row->traderId ?>_<?php echo $row->productId ?>" >
                                        
                                             <div id="tr_home_btn">
                                    
                                                <a class="anccls newanc"  style="cursor:pointer;" data-id="<?php echo $row->productId; ?>" data-toggle="modal" target="#dataModal" onclick="show_prd_details('<?php echo $row->productId ?>', '<?php echo $row->productCategoryId ?>')">
                                                    <img id="img_sharedr" src="<?php echo base_url(); ?>img/post-share.png">
                                                </a>        
                                              
                                                        
                                                <?php
                                                 if ($this->session->userdata('logged_in')) {
                                                 	
                                                    if ($this->session->userdata('logged_in')['trader_id']!=$row->traderId) {
                                                    ?>
                                                    <a class="anccls newanc" onclick="add_to_watch('<?php echo $row->productId ?>', '<?php echo $row->productCategoryId ?>', '<?php echo $row->productId ?>', '<?php echo $row->traderId ?>')">
                                                        <img id="wishlist_home" src="<?php echo base_url(); ?>img/post-add-watchlist.png">
                                                    </a>
                                                    <a class="anc_flag newanc" onclick="show_flag_modal('<?php echo $row->productCategoryId ?>', '<?php echo $row->productId ?>', '<?php echo $row->productId ?>', '<?php echo $row->traderId ?>')">
                                                        <img id="flag_home" src="<?php echo base_url(); ?>img/post-flag.png">
                                                    </a>
                                                    <?php if($row->userType==3 && $row->callForPrice==0){ ?>
                                                    <a class="newanc" onclick="check_als_cart('<?php echo $row->productCategoryId ?>', '<?php echo $row->productId ?>', '<?php echo $row->traderId ?>', '<?php echo$row->price ?>')">
                                           
                                                        <img id="shng_home" src="<?php echo base_url(); ?>img/post-add-cart.png">
                                                    </a>
                                                    <?php } } ?>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <a class="newanc" href="<?php echo base_url(); ?>signin">
                                                        <img id="wishlist_home" src="<?php echo base_url(); ?>img/post-add-watchlist.png">
                                                    </a>
                                                    <a class="newanc" href="<?php echo base_url(); ?>signin">
                                                        <img id="flag_home" src="<?php echo base_url(); ?>img/post-flag.png">
                                                    </a>
                                                    <a class="newanc" href="<?php echo base_url(); ?>signin">
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

<div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×</button>
                <h4 class="modal-title" id="myModalLabel">
                    Send Mail </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Nav tabs -->
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="Login">


                            <form role="form" class="form-horizontal "  data-trader-id='<?php echo $qry[0]->traderId; ?>' >
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
                                        &nbsp;  <button type="button" class="btn btn-info btn-fill emailsend">
                                            Send</button>&nbsp;
                                        <button type="button" data-dismiss="modal" class="btn btn-info btn-fill">
                                            Cancel</button>
                                    </div>
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
