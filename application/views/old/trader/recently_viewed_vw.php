<script type="text/javascript" src="<?php echo base_url(); ?>js/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/owl.carousel.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.downCount.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/nouislider.min.js"></script>   
<section class="section white-backgorund" id="sec_catrecviews">
    <p id="recent_title" >RECENTLY VIEWED ITEMS</p>
    <div class="container">
        <!-- Wrapper for slides -->


        <!--div class="col-lg-6 col-md-offset-3"-->
        <div class="owl-one owl-carousel owl-theme">
            <?php
            $item_class = ' active';
            foreach ($recentqry as $row) {

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
                ?>
                <a class="details_anc" href="<?php echo base_url() ?>Trader/category_details/<?php echo $row->productID; ?>/<?php echo $row->productCategoryID; ?>">
                    <div class="item<?php echo $item_class; ?>">
                        <div class="col-md-12">
                            <div class="col-md-12 mobile">
                                 <img src="<?php echo $img?>"  class="recent_slimgs" >
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-12 backwhite">
                                    <div class="col-xs-4 col-sm-4 mainprdspan">
                                        <span>Product</span><br>
                                        <span>Price</span>

                                    </div>
                                    <div class="col-xs-8 col-sm-8 mainprdspan bold">
                                        <span><?php echo $product_name; ?></span><br>
                                        <span><?php $this->Trader_mdl->formataed($product_price); ?></span>
                                    </div> 
                                </div>
                            </div> 
                        </div>

<!--                        <img src="<?php echo $img ?>"  class="recent_slimgs" >
                        <div class="mostv_prddiv" >
                            <p class="most_prd">Product</p><span class="most_prd_vals"><?php echo $product_name ?></span>
                            <p class="most_prd_price">Price</p><span class="most_prd_vals"><?php $this->Trader_mdl->formataed($product_price); ?></span>
                        </div>-->


                    </div>
                </a>    
                <?php
                $item_class = '';
            }
            ?>

        </div>

        <!--/div-->
    </div>                 

</section> 
<script>
    $(document).ready(function ()
    {
        $('.owl-carouseldetailpage').owlCarousel({
            loop: true,
            singleItem: true,
            //margin:10,
            navText: ['<button class="owlbtn"><i class="fa fa-chevron-circle-left catdetslider_left" ></i></button>', '<button class="owlbtn"><i class="fa fa-chevron-circle-right catdetslider_right"  aria-hidden="true"></i></button>'],
            nav: true,
            autoplay: true,
            responsive: {
                0: {
                    items: 1
                },

            }
        });
        $('.owl-one').owlCarousel({
            loop: true,
            margin: 10,

            navText: ['<button class="owlbtn"><i class="fa fa-chevron-circle-left mostviewslider_left" ></i></button>', '<button class="owlbtn"><i class="fa fa-chevron-circle-right mostviewslider_right"  aria-hidden="true"></i></button>'],
            nav: true,
            autoplay: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 4
                }
            }
        });
        $('.viewsliderdiv').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 4
                }
            }
        });
    });
</script>    