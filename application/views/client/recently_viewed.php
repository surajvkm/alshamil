<?php

$slang = 'english';
if($this->session->userdata('site_lang')){
 	
 	$slang =$this->session->userdata('site_lang');
}

?>
<style>
p.Booked{
    display: inline-block;
    position: absolute;
    top: 0;
    right: 15px;
    color: #fff;
    padding: 10px;
    background: #d3851a;
}
p.Sold{
    display: inline-block;
    position: absolute;
    top: 0;
    right: 15px;
    color: #fff;
    padding: 10px;
    background: red;
}
    </style>
<section class="section white-backgorund" id="sec_recviews">
        <p id="recent_title" >RECENTLY VIEWED ITEMS</p>
        <div class="container">
            <!-- Wrapper for slides -->


            <!--div class="col-lg-6 col-md-offset-3"-->
            <div class="owl-one owl-carousel owl-theme">
                <?php
                
                $recentqry = $this->View_Model->recent_view();
                $item_class = ' active';
                $title_home = '';
                if($recentqry):
                foreach ($recentqry as $row) {
                   
                           
                                $title = strtolower(str_replace(" ",'-',$row->Name));
                                
                                if($slang=='arabic'){
						$title_home=$row->productTitleAr;
						}else{
							$title_home= $row->productTitle;
							}
							
							$main_title = ucwords(str_replace(" ",' ',rtrim($title_home)));
                                $AvailabilityStatus = $row->status;
                                

                                if ($AvailabilityStatus==1) {
                                    $Availability = 'Sold';
                                    $AvailabilityClass = 'sold_btn';
                                }else if ( $AvailabilityStatus==2){
                                    $Availability = 'Booked';
                                    $AvailabilityClass = 'book_btn';
                                }else{
                                    $Availability = '';
                                }
                                
                                $title_url = strtolower(str_replace(" ",'-',rtrim($title_home)));
                             	$encoe = alphaID($row->productId,false,5);
                    ?>
                <a class="details_anc" href="<?php echo base_url() ?><?php echo $title ?>/<?php echo $title_url ?>_<?php echo $encoe; ?>">
                     <div class="item<?php echo $item_class; ?>">

                            <div class="col-md-12">
                                <div class="col-md-12 mobile">
                                
                                  <?php
                                                if ($row->mainImage != '' && (@getimagesize($row->mainImage))) {
                                                ?>
                                                    <img src="<?php echo $row->mainImage ?>" class="latest_postimgs lazy"/>
                                                <?php
                                                } else {
                                                ?>
                                                    <img src="<?php echo base_url() ?>img/no_preview.png" class="latest_postimgs lazy" />
                                                <?php
                                                }
                                                ?>
                                 <?php if($Availability!=''){
                                     echo "<button class='$AvailabilityClass'>{$Availability}</button>";
                                     
                                 } ?>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-12 backwhite">
                                <div class="col-sm-4 mainprdspan">
                                    <span>Product</span><br>
                                    <span>Price</span>

                                </div>
                                <div class="col-sm-8 mainprdspan bold">
                                    <span><?php echo $main_title ?></span><br>
                                    <span><?php $this->View_Model->formataed($row->price); ?></span>
                                </div> 
                                </div>
                            </div> 
                            </div>

                     </div>
                </a>    

                    <?php
                    $item_class = '';
                    }
                endif;
                    ?>
               
            </div>
        </div>


</section>

