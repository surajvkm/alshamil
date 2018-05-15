<?php

$slang = 'english';
if($this->session->userdata('site_lang')){
 	
 	$slang =$this->session->userdata('site_lang');
}

?>
<!-- start section -->
<section class="section white-backgorund">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- start sidebar -->
                <div class="col-sm-3">
                    <?php $this->load->view('client/advancedSearch'); ?> 
                </div>
                <!-- end sidebar -->
                <div class="col-sm-9 temp-hide">
                    <div class="mytextdiv">
                        <div class="mytexttitle">
                            <?php
                            
                            $top_title = ucwords(str_replace("-",' ',$title_header));
                            
                            echo $top_title;
                            ?>
                        </div>
                        <div class="divider"></div>
                        <div class="catcount-div">(<b><?php echo $count ?></b> Product Listed)</div>
                    </div>

                </div>
                <div class="col-sm-9 main-content-div temp-hide px-0">
                    <?php
                        if ($qry) { $title_home ='';
                        foreach ($qry as $result) { 
                        
                        if($slang=='arabic'){
									$title_home=$result->productTitleAr;
								}else{
									$title_home= $result->productTitle;
						}
						
                	    $title =      strtolower(str_replace(" ",'-',$title_header));
                	    $title_url =  strtolower(str_replace(" ",'-',rtrim($title_home)));
                	    $main_title = ucwords(str_replace(" ",' ',rtrim($title_home)));
                        $encoe = alphaID($result->productId,false,5);
                        ?>   
                        <div class="col-sm-4 catpostimgs">
                                 <a class="details_anc" href="<?php echo base_url() ?><?php echo $title ?>/<?php echo $title_url ?>_<?php echo $encoe; ?>">
                          
                                    <?php
                             
                                    if ($result->mainImage != '' && (@getimagesize($result->mainImage))) {
                                        $img = $result->mainImage;
                                    } else {
                                        $img = base_url() . 'img/no_preview.png';
                                    }
                                    if($result->status == 2)
                                    {
                                        ?>
                                    <button class="book_btn">BOOKED</button>
                                    <?php
                                    }
                                    if($result->status == 1)
                                    {
                                        ?>
                                    <button class="sold_btn">SOLD</button>
                                    <?php
                                    }
                                       

                                    ?>
                                    
                                    <img data-src="<?php echo $img; ?>" class="post_imgs lazy">
                                    </a>   
                                    <div class="tradet_details">
                                    <a  href="<?php echo $title ?>/<?php echo $title_url ?>_<?php echo $encoe; ?>">
                          
                                        <div class="col-md-12 mainprdspan">
                                           
                                        <div class="col-xs-3 col-sm-4 mainprdspan">
                                            <span>Product</span><br>
                                            <span>Price</span>
                                            
                                        </div>
                                        <div class="col-xs-9 col-sm-8 mainprdspan">
                                            <span><?php echo $main_title ?></span><br>
                                            <span><?php $this->View_Model->formataed($result->price,$result->callForPrice); ?></span>
                                        </div>    
                                            
                                        </div>  
                                        </a>   
                                        <div class="col-md-12 mainprdspan">
                                            <hr class="cat_hr">
                                        </div>
                                        <div class="col-md-12 mainprdspan" onmouseenter="$(this).find('.sidecrtdiv').fadeIn('200');" onmouseleave="$('.sidecrtdiv').css('display','none');$('.cart').show();">
                                            <div class="col-xs-2 col-sm-2 col-md-3 category-trader">
                                                <?php
                                                if ($result->image != '' && (@getimagesize($result->image))) {
                                                ?>
                                                    <img data-src="<?php echo $result->image ?>" class="cat_user_prof lazy">
                                                <?php
                                                } else {
                                                ?>
                                                    <img data-src="<?php echo base_url() ?>img/userProfileIcon_gray.png" class="cat_user_prof lazy">
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="col-xs-10 col-sm-10 col-md-9 category-traderName">
                                                <?php
                                                $d = $result->submittedOn;
                                                $d1 = strtotime($d);
                                                ?>
                                                <div>
                                                <span class="cat_uname"><?php echo $result->fullName; ?></span>
                                                <span class="cat_udate"><?php echo date('d M Y', $d1) ?></span>
                                                </div>
                                                <div class="cat_uplace"><?php echo $result->location; ?></div>
                                            </div>
                                          
                                        <div  class="sidecrtdiv socialiconsdiv" id="sidebar_<?php echo $result->traderId ?>_<?php echo $result->productId ?>" >
                                            <div id="tr_home_btn">
                                        
                                                    <a class="anccls newanc"  style="cursor:pointer;" data-id="<?php echo $result->productId; ?>"  onclick="show_prd_details('<?php echo $result->productId ?>', '<?php echo $result->productCategoryId ?>')">
                                                        <img id="img_sharedr" src="<?php echo base_url(); ?>img/post-share.png">
                                                    </a>        
                                                    <?php
                                                    if (isset($_SESSION['logged_in'])) {
                                                        
                                                        if ($_SESSION['logged_in']['trader_id']!=$result->traderId) {
                                                        ?>
                                                        <a class="anccls newanc" onclick="add_to_watch('<?php echo $result->productId ?>', '<?php echo $result->productCategoryId ?>', '<?php echo $result->traderId ?>')">
                                                            <img id="wishlist_home" src="<?php echo base_url(); ?>img/post-add-watchlist.png">
                                                        </a>
                                                        <a class="anc_flag newanc" onclick="show_flag_modal('<?php echo $result->productCategoryId ?>', '<?php echo $result->productId ?>', '<?php echo $result->traderId ?>')">
                                                            <img id="flag_home" src="<?php echo base_url(); ?>img/post-flag.png">
                                                        </a>
                                                        <?php if($result->userType==3 && $result->callForPrice==0){ ?>
                                                        <a class="newanc" onclick="check_als_cart('<?php echo $result->productCategoryId ?>', '<?php echo $result->productId ?>', '<?php echo $result->traderId ?>', '<?php echo  $result->price ?>')">
                                                       
                                                            <img id="shng_home" src="<?php echo base_url(); ?>img/post-add-cart.png">
                                                        </a>
                                                       
                                                        <?php
                                                        }
                                                    }

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


<?php $this->load->view('client/recently_viewed'); ?>
 
