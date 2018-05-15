<?php

$slang = 'english';
if($this->session->userdata('site_lang')){
 	
 	$slang =$this->session->userdata('site_lang');
}

?>

<!-- start section -->
<section class="section white-backgorund">
    <div class="container">
         <?php echo $this->session->flashdata('msg'); ?>
        <div class="row  cart-minheight">
            <div class="col-md-12">
                <div class="col-sm-9 sub_cart_div category-dateview">
                    <div class="row">
                        <div class="mytextdiv">
                            <div class="mytexttitle">
                                YOUR CART
                            </div>
                            <div class="divider"></div>
                            <?php
                            if (isset($cart_qry)) {
                                ?>
                            <div class="catcount-div">(<b><span id="cartcnt"><?php echo $cart_qry?></span></b> Items)</div>
                                <?php
                            } else {
                                ?>
                                <div class="catcount-div">(<b><span id="cartcnt">0</span></b> Items)</div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>

                </div>
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

                        <?php
                        
                        
                        
                        ?>
                        <div class="col-sm-9 sub_cart_div" id="sub_cart_div_<?php echo $row->productId ?>">
                            <div class="row">
                            <a  href="<?php echo base_url() ?><?php echo $title ?>/<?php echo $title_url ?>_<?php echo $encoe; ?>">
                          
                                <div class="prdt_cart_details_div">
                                    <div class="col-sm-3 col-xs-3 cartimgcol">
                                        <img src="<?php echo $row->mainImage; ?>" class="cartpost_imgs" >
                                    </div>

                                    <div class="col-sm-3 col-xs-12 pr-0" id="product_details_div">
                                        <span id="cartprdpr1">Product&nbsp;&nbsp;<b><span class="prdt_price_details" id="cart_product"><?php echo $title_home ?></span></b></span><br>
                                        <span id="cartprdpr2">Price&nbsp;&nbsp;<b><span class="price_span"  id="cart_price"><?php $this->View_Model->formataed($row->price); ?></span></b></span>
                                        <hr class="hr_cart">
                                        <?php
                                        if ($row->image != '' && (@getimagesize($row->image))) {
                                            ?>
                                            <img src="<?php echo $row->image ?>" id="cart_user_prof">
                                            <?php
                                        } else {
                                            ?>
                                            <img src="<?php echo base_url() ?>img/userProfileIcon_gray.png" id="cart_user_prof">
                                            <?php
                                        }
                                        ?>


                                        <p id="cart_uname"><?php echo $row->fullName ?></p>
                                        <p id="cart_uplace"><?php echo $row->location ?></p>

                                    </div>

								</div>
                                    </a>
                                    <div class="vl"></div>
                                    <div class="col-xs-6 col-sm-3" id="del_btn_div">

                                        <button class="cart_del_btns" onclick="cart_del('<?php echo $row->productId ?>', '<?php echo $row->productCategoryId ?>')">Delete</button>
                                    </div>

                                </div>


                            </div>

                        

                       
                        <?php
                    }
                } else {
                    echo "<div class='col-xs-12 col-sm-12 col-md-12 nomsgdiv line-item'><center>No Item(s) In Your Cart </center></div>";
                }
                ?>
                 <div class="col-md-12">
                <?php
                if (count($qry) > 0) {
                    ?>

                    <div class="col-sm-9 sub_cart_div category-dateview">
                          <div class="col-sm-2">
                        
                            </div>
                        <div class="col-xs-6 col-sm-4 pl-0">
                            <button class="cart_btns" id="btnshopmore">Shop More</button>
                        </div>
                        <div class="col-xs-6 col-sm-4 pr-0                          ">
                            <button class="cart_btns"  id="btncheckout">Proceed to Checkout</button>
                        </div>

                    </div>
                    <?php
                }
                ?>
            </div>
            </div>
           
        </div><!-- end row -->  
    <!-- end container -->
</section>

<?php $this->load->view('client/recently_viewed'); ?>


