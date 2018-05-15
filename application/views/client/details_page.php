<?php

$slang = 'english';
if($this->session->userdata('site_lang')){
 	
 	$slang =$this->session->userdata('site_lang');
}

$title_home='';
if($slang=='arabic'){
$title_home=$query->productTitleAr;
}else{
$title_home= $query->productTitle;
}
                	            
$main_title = ucwords(str_replace(" ",' ',rtrim($title_home)));

?>
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
                    <?php $this->load->view('client/advancedSearch'); ?> 
                </div>
                <!-- end sidebar -->
                <div id="imgpost_div"></div>
                <div class="col-sm-9 temp-hide"> 
                    <div class="mytextdiv">
                        <input type="hidden" name="product_id"  value="<?php echo $product_id; ?>"/>
                        <input type="hidden" id="categoryId"  value="<?php echo $cat_id; ?>"/>
                        <div class="mytexttitle">
                            <?php echo $main_title; ?>
                        </div>
                        <div class="divider"></div>
                        <div class="amt-div"><?php $this->View_Model->formataed($query->price,$query->callForPrice); ?></div>
                    </div>
                </div>
                <div class="col-sm-9 col-xs-12 sliderprofdiv temp-hide">
                    <div class="col-sm-8 col-md-8 col-xs-12 slider-img pl-xs-0 pr-xs-0">
                              <!--// -------------Slider--------------//-->
                            <?php
                            /*if (($cat_id == 3) ||($cat_id == 6)) {
                                if ($query->productImage != '' && (@getimagesize($query->productImage))) {
                                    $img = $query->productImage;
                                } else {
                                    $img = base_url() . 'img/no_preview.png';
                                }
                               */
                                ?>
                        <!-- <div class="nomobimg">
                                <img class="noplateimg" src="<?php echo $query->mainImage  ?>">
                                <div class="noplate_cnt_div">
                                    <span class="spownview">Views</span><br>
                                    <span class="spowncnt"><?php echo $query->viewCount ?></span>
                                </div>
                            </div>-->
                            
                            <?php  $this->load->view('client/subslider');  ?>
                            <!--// -------------End Slider--------------//-->
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 main-content-div px-0">
                        <div class="col-md-12">
                          
                            <div class="col-xs-2 col-sm-4 col-md-4 ownprofdiv">
                                <?php
                                if ($query->image != '' && (@getimagesize($query->image))) {
                                    ?>
                                    <img src="<?php echo $query->image ?>" class="owner_prof">
                                    <?php
                                } else {
                                    ?>
                                    <img src="<?php echo base_url() ?>img/userProfileIcon_gray.png" class="owner_prof">
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="col-xs-10 col-sm-8 col-md-8 pr-0 margin-bottom-20 ownprofdiv">
                                <div class="ownname"><?php echo $query->fullName ?></div>
                                <div class="ownloc"><?php echo $query->location; ?></div>
                                <hr class="ownprofhr">
                                <?php
                                $d = $query->submittedOn;
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

                            if ($sess_id == $query->traderId) {
                            ?>
                            <div class="col-md-12 ownphonediv">
                                <input type="hidden" id="prdt_btn_status_css" value="<?php echo $query->status ?>">
                                <input type="hidden" id="hid_pid" value="<?php echo $query->productId ?>">
                                <input type="hidden" id="hid_cid" value="<?php echo $query->productCategoryId ?>">
                                <button class="btn btn-default btncons ownbtnss own_avail btn-width" <?php if ($query->status == 1) echo 'disabled'; ?>>Available</button>
                                <button class="btn btn-default btncons ownbtnss own_book btn-width" <?php if ($query->status == 1) echo 'disabled'; ?>>Booked</button>
                                <button class="btn btn-default btncons ownbtnss own_sold btn-width">Sold</button>
                            </div>
                            <?php
                            } else {
                            ?>


                            <div class="col-md-12 ownphonediv">
                                <button class="btncons catdet_phone"><img src="<?php echo base_url() ?>img/post-detail-phone.png"> <span class="poster_contact"><?php echo $query->contactNumber?></span></button>

                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2 catcol2"></div>
                                <div class="col-sm-12 col-xs-12 col-md-12 mailchatdiv">
                                  
                                  <button class="btncons catdet_mailbtn"  <?php 
                                if ($this->session->userdata('logged_in')) {
                                  ?> data-toggle="modal" data-target="#emailModal"  <?php } else { ?> disabled=""  <?php } ?> ><i class="fa fa-envelope" aria-hidden="true"></i> Mail</button>
                                    <button class="btncons catdet_chatbtn" <?php if (isset($_SESSION['logged_in'])) echo "data-trader='".$query->traderId."' "."data-traderName='".$query->fullName."' " ?>  ><i class="fa fa-comments" aria-hidden="true"></i> Chat</button>
                                </div>
                                <div class="col-md-2 catcol2"></div>
                                
                            </div>
                            <?php
                            }
                            ?>
                        <div class="col-md-12 socialbtns">
                            <?php
                            if ($sess_id == $query->traderId) {
                                ?>
                                <button class="shared_btn ownshare number_btn"  onclick="shared_modal('<?php echo $query->productCategoryId ?>', '<?php echo $query->productId ?>')"  data-target="#dataModal" data-toggle="modal" data-id="<?php echo $query->productId; ?>"><img src="<?php echo base_url(); ?>img/post-share.png" class="img_shared"><span class="sbtns_txts">Share</span></button>
                                <?php
                            } else {
                                ?>
                                <button class="shared_btn"  onclick="show_prd_details('<?php echo $query->productId ?>', '<?php echo $query->productCategoryId ?>')"  data-target="#dataModal" data-toggle="modal" data-id="<?php echo $query->productId; ?>"><img src="<?php echo base_url(); ?>img/post-share.png" class="img_shared"><span class="sbtns_txts">Share</span></button>
                                <?php
                                if (!(isset($_SESSION['logged_in']))) {
                                    ?>
                                    <button class="wishlist_btn" onclick="call_login()">  <img src="<?php echo base_url(); ?>img/post-add-watchlist.png" class="img_watch"><span class="wbtns_txts">Watch List</span></button><br>
                                    <button class="flag_btn"  onclick="call_login()"><img src="<?php echo base_url(); ?>img/post-flag.png" class="img_flag"><span class="fbtns_txts">Flag Post</span></button><br>
                                    <button class="addcart_btn" onclick="call_login()"><img src="<?php echo base_url(); ?>img/post-add-cart.png" class="img_cart"><span class="cbtns_txts">Add to Cart</span></button>

                                    <?php
                                } elseif($query->status!=1) {
                                    ?>
                                    <button class="wishlist_btn" onclick="add_to_watch('<?php echo $query->productId ?>', '<?php echo $query->productCategoryId ?>','<?php echo $query->traderId ?>')">  <img src="<?php echo base_url(); ?>img/post-add-watchlist.png"  class="img_watch"><span class="wbtns_txts">Watch List</span></button><br>
                                    <button class="flag_btn" onclick="show_flag_modal('<?php echo $query->productCategoryId ?>', '<?php echo $query->productId ?>', '<?php echo $query->traderId ?>')">   <img src="<?php echo base_url(); ?>img/post-flag.png"  class="img_flag"><span class="fbtns_txts">Flag Post</span></button><br>

                                    <?php
                                  
                                    if($query->userType==3 && $query->callForPrice==0){ 
                                        ?>
                                        <button class="addcart_btn" onclick="check_als_cart('<?php echo $query->productCategoryId ?>', '<?php echo $query->productId ?>', '<?php echo $query->traderId ?>', '<?php echo $query->price ?>')"><img src="<?php echo base_url(); ?>img/post-add-cart.png"  class="img_cart"><span class="cbtns_txts">Add to Cart</span></button>

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
                    <p class="hist_descr"><?php echo $query->description ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
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

<script>
	
$('.own_book').click(function (e) {
            e.preventDefault();
            var pid = $('#hid_pid').val();
            var cid = $('#hid_cid').val();
            var postStatus="<?php echo $query->postStatusDetail; ?>";
           if(postStatus!='1'){
            swal("Product is not approved",'','error');
           }else{
            $.ajax({
                url: "<?php echo base_url(); ?>trader/change_status_book",
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
            var postStatus="<?php echo $query->postStatusDetail; ?>";
           if(postStatus!='1'){
            swal("Product is not approved",'','error');
           }else{
            $.ajax({
                url: "<?php echo base_url(); ?>trader/change_status_avail",
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
          
            var postStatus="<?php echo $query->postStatusDetail; ?>";
           if(postStatus!='1'){
            swal("Product is not approved",'','error');
           }else{
            $.ajax({
                url: "<?php echo base_url(); ?>trader/change_status_sold",
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
	
</script>

<?php $this->load->view('client/recently_viewed'); ?>
