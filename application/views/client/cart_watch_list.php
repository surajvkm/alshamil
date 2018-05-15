<?php

$slang = 'english';
if($this->session->userdata('site_lang')){
 	
 	$slang =$this->session->userdata('site_lang');
}

?>

<section class="section white-backgorund">
    <div class="container">
        <?php echo $this->session->flashdata('msg'); ?>
        <div class="row">
            <div class="col-sm-12">
                <!-- start sidebar -->
                <div class="col-sm-3">
                    <?php $this->load->view('client/advancedSearch'); ?> 
                </div>
                
                 <div class="col-sm-9 temp-hide">
                    <div class="mytextdiv">
                        <div class="mytexttitle">
                            WATCH LIST
                        </div>
                        <div class="divider"></div>
                        <?php
                        if (isset($watch_qry)) {
                        	
                        	
                            ?>
                            <div class="catcount-div">(<b><?php echo $watch_qry[0]->watchlistCount ?></b> Product Listed)</div>
                            <?php
                        } else {
                            ?>
                            <div class="catcount-div">(<b>0</b> Product Listed)</div>
                            <?php
                        }
                        ?>
                    </div>

                </div>

                <div class="col-sm-9 main-content-div temp-hide">
                    <?php
                    if (count($qry) > 0) { $title_home='';
                        foreach ($qry as $row) {
                        	
                        	$title = strtolower(str_replace(" ",'-',$row->Name));
						if($slang=='arabic'){
						$title_home=$row->productTitleAr;
						}else{
							$title_home= $row->productTitle;
							}
							$title_url = strtolower(str_replace(" ",'-',rtrim($title_home)));
                             	$encoe = alphaID($row->productId,false,5);
                            ?>
                            <a class="details_anc" href="<?php echo base_url() ?><?php echo $title ?>/<?php echo $title_url ?>_<?php echo $encoe; ?>">
                                <div class="col-sm-4 catpostimgs">
                                    <?php
                                    

                                    if ($row->status == 2) {
                                        ?>
                                        <button class="book_btn">BOOKED</button>
                                        <?php
                                    }
                                       if ($row->status == 1) {
                                            ?>
                                            <button class="book_btn">SOLD</button>
                                        <?php }
                                        
                                        ?>

                                    <img src="<?php echo $row->mainImage; ?>" class="post_imgs">
                                    <div class="tradet_details">
                                        <div class="col-md-12 mainprdspan">

                                            <div class="col-sm-4 mainprdspan">
                                                <span>Product</span><br>
                                                <span>Price</span>

                                            </div>
                                            <div class="col-sm-8 mainprdspan">
                                                <span><?php echo $title_home; ?></span><br>
                                                <span><?php $this->View_Model->formataed($row->price); ?></span>
                                            </div>    

                                        </div>  
                                        <div class="col-md-12 mainprdspan">
                                            <hr class="cat_hr">
                                        </div>
                                        </a>  
                                        <div class="col-sm-3 category-trader">
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
                                        
                                        <div class="col-sm-9 category-traderName">
                                            <?php
                                            $d = $row->submittedOn;
                                            $d1 = strtotime($d);
                                            ?>
                                            <span class="cat_uname"><?php echo $row->fullName; ?></span>
                                            <span class="cat_uplace"><?php echo $row->location; ?></span>
                                            <span class="cat_udate"><?php echo date('d M Y', $d1) ?></span>
                                            <span class="cat_udate btn btn-danger btn-sm removewatch" data-watchid='<?php echo $row->watchlistId ?>' >Remove</span>
                                                       
                                            
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
                </div>
                <div class="col-sm-9" id="imgpost_div"></div> 
                
               </div>  

</section>             