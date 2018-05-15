<script type="text/javascript" src="<?php echo base_url(); ?>js/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/owl.carousel.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.downCount.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/nouislider.min.js"></script> 
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
        <p id="recent_title" >MOST VIEW</p>
        <div class="container">
            <!-- Wrapper for slides -->


            <!--div class="col-lg-6 col-md-offset-3"-->
            <div class="owl-one owl-carousel owl-theme">
                <?php
                $item_class = ' active';
                foreach ($recentqry as $row) {
                   
                            if ($row->Cpost_main_img != ''&& (@getimagesize($row->Cpost_main_img))) {
                                $img = $row->Cpost_main_img;
                            } else if ($row->Bpost_main_img != ''&& (@getimagesize($row->Bpost_main_img))) {
                                $img = $row->Bpost_main_img;
                            } else if ($row->BTpost_main_img != ''&& (@getimagesize($row->BTpost_main_img))) {
                                $img = $row->BTpost_main_img;
                            } else if ($row->Wpost_main_img != ''&& (@getimagesize($row->Wpost_main_img))) {
                                $img = $row->Wpost_main_img;
                            } else if ($row->Vpost_main_img != ''&& (@getimagesize($row->Vpost_main_img))) {
                                $img = $row->Vpost_main_img;
                            } else if ($row->PRpost_main_img != ''&& (@getimagesize($row->PRpost_main_img))) {
                                $img = $row->PRpost_main_img;
                            } else if ($row->PHpost_main_img != ''&& (@getimagesize($row->PHpost_main_img))) {
                                $img = $row->PHpost_main_img;
                            } else if ($row->NPpost_main_img != ''&& (@getimagesize($row->NPpost_main_img))) {
                                $img = $row->NPpost_main_img;
                            } else if ($row->MNpost_main_img != ''&& (@getimagesize($row->MNpost_main_img))) {
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
                                    $AvailabilityStatus = $row->productCStatus;
                                } else if ($row->productBStatus != '') {
                                    $AvailabilityStatus = $row->productBStatus;
                                } else if ($row->productBTStatus != '') {
                                    $AvailabilityStatus = $row->productBTStatus;
                                } else if ($row->productNPStatus != '') {
                                    $AvailabilityStatus = $row->productNPStatus;
                                } else if ($row->productVStatus != '') {
                                    $AvailabilityStatus = $row->productVStatus;
                                } else if ($row->productWStatus != '') {
                                    $AvailabilityStatus = $row->productWStatus;
                                } else if ($row->productMNStatus != '') {
                                    $AvailabilityStatus = $row->productMNStatus;
                                } else if ($row->productPHStatus != '') {
                                    $AvailabilityStatus = $row->productPHStatus;
                                } else if ($row->productPRStatus != '') {
                                    $AvailabilityStatus = $row->productPRStatus;
                                } else {

                                    $AvailabilityStatus = '';
                                    $AvailabilityClass = '';
                                }
                                





                                if ($AvailabilityStatus==1) {
                                    $Availability = 'Sold';
                                    $AvailabilityClass = 'sold_btn';
                                }else if ( $AvailabilityStatus==2){
                                    $Availability = 'Booked';
                                    $AvailabilityClass = 'book_btn';
                                }else{
                                    $Availability = '';
                                }
                    ?>
                <a class="details_anc" href="<?php echo base_url()?>Trader/category_details/<?php echo $row->productID;?>/<?php echo $row->productCategoryID;?>">
                     <div class="item<?php echo $item_class; ?>">

                            <div class="col-md-12">
                                <div class="col-md-12 mobile">
                                
                                 <img src="<?php echo $img?>"  class="recent_slimgs" >
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
                                    <span><?php echo $product_name; ?></span><br>
                                    <span><?php $this->Trader_mdl->formataed($product_price); ?></span>
                                </div> 
                                </div>
                            </div> 
                            </div>

                     </div>
                </a>    

                    <?php
                    $item_class = '';
                    }
                    ?>
               
            </div>
        </div>
</div>

</section> 
<script>
     $(document).ready(function ()
    {
     $('.owl-one').owlCarousel({
                        loop:true,
                        margin:10,
                        
                     	navText: [ '<button class="owlbtn"><i class="fa fa-chevron-circle-left mostviewslider_left" ></i></button>', '<button class="owlbtn"><i class="fa fa-chevron-circle-right mostviewslider_right"  aria-hidden="true"></i></button>' ],
                        nav:true,
                        autoplay: true,
                        responsive:{
                            0:{
                                items:1
                            },
                            600:{
                                items:2
                            },
                            1000:{
                                items:4
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