<?php

$slang = 'english';
if($this->session->userdata('site_lang')){
 	
 	$slang =$this->session->userdata('site_lang');
}

?>
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
                        <div class="top_traderhead"><span id="sptop"> <?php echo  $this->lang->line('all_trader'); ?></span> <a id="user_anvietr" href="<?php echo base_url() ?>alltraders" title="Click to view all traders">View All</a></div>
                        <div class="col-md-12 maintraders">
                            <div class="col-sm-3 col-xs-2 userimage">
                                <?php
                                if ($admin[0]->image != '' && (@getimagesize($admin[0]->image))) {
                                    ?>
                                    <a href="<?php echo base_url() ?>traderinfo/<?php echo $admin[0]->traderId ?> "><span id="sp_tr_img"><img data-src="<?php echo $admin[0]->image; ?>" class="top_trimg lazy" /></span></a>
                                    <?php
                                } else {
                                    ?>
                                    <a href="<?php echo base_url() ?>traderinfo/<?php echo $admin[0]->traderId ?>"><img data-src="<?php echo base_url(); ?>img/userProfileIcon_gray.png" class="top_trimg lazy" onclick="<?php echo base_url() ?>Trader"/></a>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="col-sm-9 col-xs-10 toptraders">
                                <div>
                                    <a href="<?php echo base_url() ?>traderinfo/<?php echo $admin[0]->traderId ?> ">
                                        <span class="tradername bold"><?php echo $admin[0]->fullName; ?></span>
                                    </a>
                                    <span class="traderplace"><?php echo $admin[0]->postCount; ?></span>
                                </div>
                                <div>
                                    <span class="tradername"><?php echo $admin[0]->location; ?></span>
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
                                if ($result->image != '' && (@getimagesize($result->image))) {
                                    ?>
                                    <a href="<?php echo base_url() ?>traderinfo/<?php echo $result->traderId ?> "><span id="sp_tr_img"><img data-src="<?php echo $result->image; ?>" class="top_trimg lazy" /></span></a>
                                    <?php
                                } else {
                                    ?>
                                    <a href="<?php echo base_url() ?>traderinfo/<?php echo $result->traderId ?>"><img data-src="<?php echo base_url(); ?>img/userProfileIcon_gray.png" class="top_trimg lazy" onclick="<?php echo base_url() ?>trader/profile"/></a>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="col-sm-9 col-xs-10 toptraders">
                                <div>
                                    <a href="<?php echo base_url() ?>traderinfo/<?php echo $result->traderId ?> ">
                                        <span class="tradername bold"><?php echo $result->fullName; ?></span>
                                    </a>
                                    <span class="traderplace"><?php echo $result->postCount; ?></span>
                                </div>
                                <div>
                                    <span class="tradername"><?php echo $result->location; ?></span>
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
                        
                        
                           if($latest){
							
							$title_home='';
						
                            foreach ($latest->result() as $row) {
                            	
                            	
                            	if($slang=='arabic'){
									$title_home=$row->productTitleAr;
								}else{
									$title_home= $row->productTitle;
								}
                	            
                             	$title = strtolower(str_replace(" ",'-',$row->Name));
                             	$title_url = strtolower(str_replace(" ",'-',rtrim($title_home)));
                             	$main_title = ucwords(str_replace(" ",' ',rtrim($title_home)));
                             	$encoe = alphaID($row->productId,false,5);
                            ?>
                            

                            <div class="col-sm-4 col-md-3  postcol" onmouseenter="$(this).find('.sidecrtdiv').fadeIn('200');" onmouseleave="$('.sidecrtdiv').css('display','none');$('.cart').show();">
                               
                                <a href="<?php echo base_url().$title.'/'.$title_url.'_'.$encoe; ?>">
                                          <?php
                                                if ($row->mainImage != '' && (@getimagesize($row->mainImage))) {
                                                ?>
                                                    <img data-src="<?php echo $row->mainImage ?>" class="latest_postimgs lazy"/>
                                                <?php
                                                } else {
                                                ?>
                                                    <img data-src="<?php echo base_url() ?>img/no_preview.png" class="latest_postimgs lazy" />
                                                <?php
                                                }
                                                ?>
                                   
                                <input type="hidden" class="hid_sharecatid" value="<?php echo $row->productCategoryId ?>" />
                                <div class="img_details">
                                    <div class="col-md-12 mainprdspan">
                                           
                                        <div class="col-sm-4 col-md-4 col-xs-3 mainprdspan">
                                            <span>Product</span><br>
                                            <span>Price</span>
                                            
                                        </div>
                                        <div class="col-sm-8 col-md-8 col-xs-9 mainprdspan bold">
                                            <span><?php echo $main_title;  ?>
                                            	
                                            </span><br>
                                            <span><?php $this->View_Model->formataed($row->price,$row->callForPrice); ?></span>
                                        </div>    
                                            
                                    </div>  
                                    <div class="col-md-12 mainpghr">
                                        <hr class="cat_hr">
                                    </div>
                                    
                                    <div class="col-md-12 mainlist">
                                        <div id="trader_details_div_<?php echo $row->traderId ?>_<?php echo $row->productId ?>" class="cart"  >
                                            <div class="col-sm-3 col-xs-2 category-trader">
                                                <?php
                                                if ($row->image != '' && (@getimagesize($row->image))) {
                                                    ?>
                                                    <img src="<?php echo $row->image ?>" class="cat_user_prof">
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
                                                $d = $row->submittedOn;
                                                $d1 = strtotime($d);
                                                ?>
                                                <div>
                                                <span class="cat_uname"><?php echo $row->fullName; ?></span>
                                                <span class="cat_udate"><?php echo date('d M Y', $d1) ?></span>
                                                </div>
                                                <div class="cat_uplace"><?php echo $row->location; ?></div>
                                            </div>
                                        </div>
                                        <div  class="sidecrtdiv socialiconsdiv" id="sidebar_<?php echo $row->traderId ?>_<?php echo $row->productId ?>" >
                                            <div id="tr_home_btn">
                                        
                                                    <a class="anccls newanc"  style="cursor:pointer;" data-id="<?php echo $row->productId; ?>" data-toggle="modal" target="#dataModal" onclick="show_prd_details('<?php echo $row->productId ?>', '<?php echo $row->productCategoryId ?>')">
                                                        <img id="img_sharedr" src="<?php echo base_url(); ?>img/post-share.png">
                                                    </a>        
                                                    <?php
                                                    if (isset($_SESSION['logged_in'])) {
                                                        if ($_SESSION['logged_in']['trader_id']!=$row->traderId) {
                                                        ?>
                                                        <a class="anccls newanc" onclick="add_to_watch('<?php echo $row->productId ?>', '<?php echo $row->productCategoryId ?>', '<?php echo $row->traderId ?>')">
                                                            <img id="wishlist_home" src="<?php echo base_url(); ?>img/post-add-watchlist.png">
                                                        </a>
                                                        <a class="anc_flag newanc" onclick="show_flag_modal('<?php echo $row->productCategoryId ?>', '<?php echo $row->productId ?>', '<?php echo $row->traderId ?>')">
                                                            <img id="flag_home" src="<?php echo base_url(); ?>img/post-flag.png">
                                                        </a>
                                                        <?php if($row->userType==3 && $row->callForPrice==0){ ?>
                                                        <a class="newanc" onclick="check_als_cart('<?php echo $row->productCategoryId ?>', '<?php echo $row->productId ?>' ,'<?php echo $row->traderId ?>', '<?php echo $row->price ?>')">
                                                       
                                                            <img id="shng_home" src="<?php echo base_url(); ?>img/post-add-cart.png">
                                                        </a>
                                                        <?php } }  ?>
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
                                        </div>
                                    </div>
                                    
                                </div>
</a>
                            </div>
                            <?php
                        }


}
                        ?>

                    
                </div>
            </div>
        </div><!-- end container -->
    </section>


</div>

<?php $this->load->view('client/most_viewed'); ?>



<link rel="stylesheet" href="<?php echo base_url(); ?>Gallery-master/css/blueimp-gallery.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>Gallery-master/css/blueimp-gallery-indicator.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>Gallery-master/css/blueimp-gallery-video.css" />
<script src="<?php echo base_url(); ?>Gallery-master/js/blueimp-helper.js"></script>
<script src="<?php echo base_url(); ?>Gallery-master/js/blueimp-gallery.min.js"></script>
<script src="<?php echo base_url(); ?>Gallery-master/js/blueimp-gallery-fullscreen.js"></script>
<script src="<?php echo base_url(); ?>Gallery-master/js/blueimp-gallery-indicator.js"></script>
<script src="<?php echo base_url(); ?>Gallery-master/js/blueimp-gallery-video.js"></script>
<!--<script src="<?php echo base_url() ?>Gallery-master/js/vendor/jquery.js"></script>-->
<script src="<?php echo base_url(); ?>Gallery-master/js/jquery.blueimp-gallery.min.js"></script>
<script>
	$(function () {
        'use strict'
if (typeof blueimp !== "undefined") {
        blueimp.Gallery(
        
        [
<?php
if($media->num_rows()>0){
foreach ($media->result() as $result) {
    $file = $result->productVideo;
    $file_det = pathinfo($file);
    $title = $this->View_Model->getTitle($result->productId)->productTitle;
    // if ($result->thumbImage == '') {
    //     $poster = $this->Trader_mdl->getImage($result->productID, $result->productCategoryID);
    // } else {
    //     $poster = $result->thumbImage;
    // }
    if(isset($file_det['extension'])){
    ?>
                {
                    title: '<?php echo $title; ?>',
                    href: ' <?php echo $file; ?>',
                    type: 'video/mp4',
                     poster: '<?php echo $result->thumbVideo; ?>',
                    description: '<?php echo $result->videoViewCount; ?>'
                },
<?php }} } else{   

    
    
      ?> 
               {
                    title: 'Default',
                    href: '<?php echo base_url('uploads/video/default.mp4'); ?>',
                    type: 'video/mp4',
                    
                    description: ''
                },
    
    <?php } ?>

        ],
         {
            container: '#blueimp-video-carousel',
            carousel: true
        },{
			  onopen: function () {
            // Callback function executed when the Gallery is initialized.
            
           
        }
		}
        
        
        );
		
}
    })
	
		
</script>

