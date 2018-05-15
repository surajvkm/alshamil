<!-- start section -->
<section class="section white-backgorund">
    <div class="container">
        <?php echo $this->session->flashdata('msg'); ?>
        <div class="row">
            <div class="col-sm-12">
                <!-- start sidebar -->
                <div class="col-sm-3">
                    <?php $this->load->view('trader/advancedSearch_vw'); ?> 
                </div>
                <!-- end sidebar -->
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
                    if (count($qry) > 0) {
                        foreach ($qry as $row) {
                            ?>
                            <a class="details_anc" href="<?php echo base_url() ?>Trader/category_details/<?php echo $row->productID; ?>/<?php echo $row->productCategoryID; ?>">
                                <div class="col-sm-4 catpostimgs">
                                    <?php
                                    if ($row->Cpost_main_img != '' && (@getimagesize($row->Cpost_main_img))) {
                                        $img = $row->Cpost_main_img;
                                    } else if ($row->Bpost_main_img != '' && (@getimagesize($row->Bpost_main_img))) {
                                        $img = $row->Bpost_main_img;
                                    } else if ($row->BTpost_main_img != '' && (@getimagesize($row->BTpost_main_img))) {
                                        $img = $row->BTpost_main_img;
                                    } else if ($row->Wpost_main_img != '' && (@getimagesize($row->Wpost_main_img))) {
                                        $img = $row->Wpost_main_img;
                                    } else if ($row->Vpost_main_img != '' && (@getimagesize($row->Vpost_main_img))) {
                                        $img = $row->Vpost_main_img;
                                    } else if ($row->PRpost_main_img != '' && (@getimagesize($row->PRpost_main_img))) {
                                        $img = $row->PRpost_main_img;
                                    } else if ($row->PHpost_main_img != '' && (@getimagesize($row->PHpost_main_img))) {
                                        $img = $row->PHpost_main_img;
                                    } else if ($row->NPpost_main_img != '' && (@getimagesize($row->NPpost_main_img))) {
                                        $img = $row->NPpost_main_img;
                                    } else if ($row->MNpost_main_img != '' && (@getimagesize($row->MNpost_main_img))) {
                                        $img = $row->MNpost_main_img;
                                    } else {

                                        $img = base_url() . 'img/no_preview.png';
                                    }
                                    if ($row->product_name1 != '') {
                                        $product_name = $row->product_name1;
                                    } else if ($row->product_name2 != '') {
                                        $product_name = $row->product_name2;
                                    } else if ($row->product_name3 != '') {
                                        $product_name = $row->product_name3;
                                    } else if ($row->product_name4 != '') {
                                        $product_name = $row->product_name4;
                                    } else if ($row->product_name5 != '') {
                                        $product_name = $row->product_name5;
                                    } else if ($row->product_name6 != '') {
                                        $product_name = $row->product_name6;
                                    } else if ($row->product_name7 != '') {
                                        $product_name = $row->product_name7;
                                    } else if ($row->product_name8 != '') {
                                        $product_name = $row->product_name8;
                                    } else if ($row->product_name9 != '') {
                                        $product_name = $row->product_name9;
                                    } else {

                                        $product_name = '';
                                    }
                                    if ($row->productCPrice != '') {
                                        $product_price = $row->productCPrice;
                                    } else if ($row->productBPrice != '') {
                                        $product_price = $row->productBPrice;
                                    } else if ($row->productBTPrice != '') {
                                        $product_price = $row->productBTPrice;
                                    } else if ($row->productWPrice != '') {
                                        $product_price = $row->productWPrice;
                                    } else if ($row->productVPrice != '') {
                                        $product_price = $row->productVPrice;
                                    } else if ($row->productPRPrice != '') {
                                        $product_price = $row->productPRPrice;
                                    } else if ($row->productPHPrice != '') {
                                        $product_price = $row->productPHPrice;
                                    } else if ($row->productNPPrice != '') {
                                        $product_price = $row->productNPPrice;
                                    } else if ($row->productMNPrice != '') {
                                        $product_price = $row->productMNPrice;
                                    } else {

                                        $product_price = '';
                                    }
                                    if ($row->productCStatus != '') {
                                        $product_status = $row->productCStatus;
                                    } else if ($row->productBStatus != '') {
                                        $product_status = $row->productBStatus;
                                    } else if ($row->productNPStatus != '') {
                                        $product_status = $row->productNPStatus;
                                    } else if ($row->productVStatus != '') {
                                        $product_status = $row->productVStatus;
                                    } else if ($row->productWStatus != '') {
                                        $product_status = $row->productWStatus;
                                    } else if ($row->productBTStatus != '') {
                                        $product_status = $row->productBTStatus;
                                    } else if ($row->productPHStatus != '') {
                                        $product_status = $row->productPHStatus;
                                    } else if ($row->productMNStatus != '') {
                                        $product_status = $row->productMNStatus;
                                    } else if ($row->productPRStatus != '') {
                                        $product_status = $row->productPRStatus;
                                    } else {

                                        $product_status = '';
                                    }
                                    if ($row->cartCType != '') {
                                        $cart_type = $row->cartCType;
                                    }else if ($row->cartBType != '') {
                                        $cart_type = $row->cartBType;
                                    }else if ($row->cartNPType != '') {
                                        $cart_type = $row->cartNPType;
                                    } else if ($row->cartVType != '') {
                                        $cart_type = $row->cartVType;
                                    }else if ($row->cartBTType != '') {
                                        $cart_type = $row->cartBTType;
                                    }else if ($row->cartWType != '') {
                                        $cart_type = $row->cartWType;
                                    } else if ($row->cartMNType != '') {
                                        $cart_type = $row->cartMNType;
                                    } else if ($row->cartPHType != '') {
                                        $cart_type = $row->cartPHType;
                                    } else if ($row->cartPRType != '') {
                                        $cart_type = $row->cartPRType;
                                    } else {
                                        $cart_type = '';
                                    }

                                    if ($product_status == 2) {
                                        ?>
                                        <button class="book_btn">BOOKED</button>
                                        <?php
                                    }
                                       if ($product_status == 1) {
                                            ?>
                                            <button class="book_btn">SOLD</button>
                                        <?php }
                                        
                                        ?>

                                    <img src="<?php echo $img; ?>" class="post_imgs">
                                    <div class="tradet_details">
                                        <div class="col-md-12 mainprdspan">

                                            <div class="col-sm-4 mainprdspan">
                                                <span>Product</span><br>
                                                <span>Price</span>

                                            </div>
                                            <div class="col-sm-8 mainprdspan">
                                                <span><?php echo $product_name ?></span><br>
                                                <span><?php $this->Trader_mdl->formataed($product_price); ?></span>
                                            </div>    

                                        </div>  
                                        <div class="col-md-12 mainprdspan">
                                            <hr class="cat_hr">
                                        </div>
                                        </a>  
                                        <div class="col-sm-3 category-trader">
                                        <?php
                                        if ($row->traderImage != '' && (@getimagesize($row->traderImage))) {
                                            ?>
                                                <img src="<?php echo $row->traderImage ?>" class="cat_user_prof">
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
                                            $d = $row->postSubmissionOn;
                                            $d1 = strtotime($d);
                                            ?>
                                            <span class="cat_uname"><?php echo $row->traderFullName; ?></span>
                                            <span class="cat_udate"><?php echo date('d M Y', $d1) ?></span>
                                            <span class="cat_udate btn btn-danger btn-sm remove" data-watchid='<?php echo $row->watchlistID ?>' >Remove</span>
                                                       
                                            <span class="cat_uplace"><?php echo $row->traderLocation; ?></span>
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
                <!-- Binds search results-->
            </div>
        </div>
    </div>
    <!-- end container -->
</section>

<!-- end section -->
<?php $this->load->view('trader/recently_viewed_vw'); ?>
<script>
   $('.remove').click(function () {
    watchID=jQuery(this).data('watchid');
    elem=jQuery(this).closest('.catpostimgs');

    $.ajax({
        url: "<?php echo base_url('Trader/remove_watch_list/'); ?>"+watchID,

        type: "POST",
        success: function (data) {
            count=jQuery('.catcount-div').find('b').html();
           
            newcount=parseInt(count)-1;
            jQuery('.catcount-div').find('b').html(newcount);
       
            elem.remove();
} 
});
});
function remove_watch(watchID){
  
    $.ajax({
        url: "<?php echo base_url('Trader/remove_watch_list/'); ?>"+watchID,

        type: "POST",
        success: function (data) {

} 
});
}
    $(document).ready(function () {



    });
</script>