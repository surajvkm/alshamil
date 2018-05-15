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


            </div><!-- end col -->
            <!-- end sidebar -->
            <div class="col-sm-9 temp-hide">
                    <div class="mytextdiv">
                        <div class="mytexttitle">
           
                   
                   <h5 id="category_title">Search results</h5><!--hr id="category_hr"--><b>
                   <span id="category_cnt"></span></b>
                   
                 </div>
                        <div class="divider"></div>
                        <div class="catcount-div">(<b><?php echo count($search) ?></b> Products Available)</div>
                    </div>

                </div>
                <div class="col-sm-9 main-content-div temp-hide px-0">
                    <?php
                    if ($search) {
                    if (count($search) > 0 ) {
                      
                        foreach ($search as $row) {
                        if($slang=='arabic'){
									$title_home=$row['productTitleAr'];
								}else{
									$title_home= $row['productTitle'];
						}
						$title = strtolower(str_replace(" ",'-',$row['Name']));
                	    //$title =      strtolower(str_replace(" ",'-',$title_header));
                	    $title_url =  strtolower(str_replace(" ",'-',rtrim($title_home)));
                	    $main_title = ucwords(str_replace(" ",' ',rtrim($title_home)));
                        $encoe = alphaID($row['productId'],false,5);
					
                            ?>
                            <a class="details_anc" href="<?php echo base_url() ?><?php echo $title ?>/<?php echo $title_url ?>_<?php echo $encoe; ?>">
                                <div class="col-sm-4 catpostimgs">
                                    <?php
                                    if ($row['mainImage'] != '' && (@getimagesize($row['mainImage']))) {
                                        $img =$row['mainImage'];
                                    } else {
                                        $img = base_url() . 'img/no_preview.png';
                                    }
                                    if($row['status'] == 2)
                                    {
                                        ?>
                                    <button class="book_btn">BOOKED</button>
                                    <?php
                                    }
                                    if($row['status'] == 1)
                                    {
                                        ?>
                                    <button class="sold_btn">SOLD</button>
                                    <?php
                                    }
                                       

                                    ?>
                                    
                                    <img src="<?php echo $img; ?>" class="post_imgs">
                                    <div class="tradet_details">
                                        <div class="col-md-12 mainprdspan">
                                           
                                        <div class="col-sm-4 mainprdspan">
                                            <span>Product</span><br>
                                            <span>Price</span>
                                            
                                        </div>
                                        <div class="col-sm-8 mainprdspan">
                                             <span><?php echo $main_title ?></span><br>
                                            <span><?php $this->View_Model->formataed($row['price'],$row['callForPrice']); ?></span>
                                        </div>    
                                            
                                        </div>  
                                        <div class="col-md-12 mainprdspan">
                                            <hr class="cat_hr">
                                        </div>
                                        <div class="col-md-12 mainprdspan">
                                            <div class="col-sm-3 category-trader">
                                                <?php
                                                if ($row['image']!= '' && (@getimagesize($row['image']))) {
                                                ?>
                                                    <img src="<?php echo $row['image'] ?>" class="cat_user_prof">
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
                                                $d = $row['submittedOn'];
                                                $d1 = strtotime($d);
                                                ?>
                                                <div>
                                                <span class="cat_uname"><?php echo $row['fullName'] ; ?></span>
                                                <span class="cat_udate"><?php echo date('d M Y', $d1) ?></span>
                                                </div>
                                                <div class="cat_uplace"><?php echo $row['location']; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>   
                            <?php
                            }
                        }
                        } else {
                        ?>
                        <div class="trader-profile-no"><h3><?php echo 'No Item Found'; ?></h3></div>
                        <?php
                        }
                        ?>

                    
                </div><!-- end col -->


            <div id="result">
                <div class="col-sm-9" id="imgpost_div">

                </div>    

                <div class="row">
                    <div id="pagination">
                        <ul class="tsc_pagination">
                        </ul>
                    </div>
                </div>
            </div><!-- end col -->

        </div><!-- end row -->                
    </div><!-- end container -->
</section>
<section class="section white-backgorund" id="pag_secdiv">

</section>
<!-- end section -->
<?php $this->load->view('client/recently_viewed'); ?>