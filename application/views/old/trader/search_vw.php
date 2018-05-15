
<!-- start section -->
<section class="section white-backgorund" id="sec_prof">
    <div class="container">
        <div class="row">
            <!-- start sidebar -->
            <div class="col-sm-3" id="profile_div">

                <?php $this->load->view('trader/advancedSearch_vw'); ?>   


            </div><!-- end col -->
            <!-- end sidebar -->
            <div id="category_title_div">
                   
                   <h5 id="category_title">Search results</h5><!--hr id="category_hr"--><b><span id="category_cnt"></span></b>
                   </div>
                <div class="col-sm-9 main-content-div temp-hide">
                    <?php
                    if ($all_products) {
                    if (count($all_products) > 0 ) {
                      
                        foreach ($all_products as $row) {
					
                            ?>
                            <a class="details_anc" href="<?php echo base_url().'Trader/category_details/'.$row['ProductID'].'/'.$row['CategoryID']  ?>">
                                <div class="col-sm-4 catpostimgs">
                                    <?php
                                    if ($row['Image'] != '' && (@getimagesize($row['Image']))) {
                                        $img =$row['Image'];
                                    } else {
                                        $img = base_url() . 'img/no_preview.png';
                                    }
                                    if($row['AvailablitiyStatus'] == 2)
                                    {
                                        ?>
                                    <button class="book_btn">BOOKED</button>
                                    <?php
                                    }
                                    if($row['AvailablitiyStatus'] == 1)
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
                                            <span><?php echo $row['Brand'].' '.$row['Model'] ?></span><br>
                                            <span><?php $this->Trader_mdl->formataed($row['Price'] ); ?></span>
                                        </div>    
                                            
                                        </div>  
                                        <div class="col-md-12 mainprdspan">
                                            <hr class="cat_hr">
                                        </div>
                                        <div class="col-md-12 mainprdspan">
                                            <div class="col-sm-3 category-trader">
                                                <?php
                                                if ($row['traderImage']!= '' && (@getimagesize($row['traderImage']))) {
                                                ?>
                                                    <img src="<?php echo $row['traderImage'] ?>" class="cat_user_prof">
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
                                                $d = $row['SubmitDate'];
                                                $d1 = strtotime($d);
                                                ?>
                                                <div>
                                                <span class="cat_uname"><?php echo $row['traderFullName'] ; ?></span>
                                                <span class="cat_udate"><?php echo date('d M Y', $d1) ?></span>
                                                </div>
                                                <div class="cat_uplace"><?php echo $row['traderLocation']; ?></div>
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
<section class="section white-backgorund" id="sec_catrecviews">
    <p id="recent_title" >RECENTLY VIEWED ITEMS</p>
    <div class="container">
            <!-- Wrapper for slides -->


            <!--div class="col-lg-6 col-md-offset-3"-->
            <div class="owl-one owl-carousel owl-theme">
                <?php
                $item_class = ' active';
                foreach ($recentqry as $row) {
                   
                                if ($row->Cpost_main_img != '') {
                                    $img = $row->Cpost_main_img;
                                } else if ($row->Bpost_main_img != '') {
                                    $img = $row->Bpost_main_img;
                                } else if ($row->BTpost_main_img != '') {
                                    $img = $row->BTpost_main_img;
                                } else if ($row->Wpost_main_img != '') {
                                    $img = $row->Wpost_main_img;
                                } else if ($row->Vpost_main_img != '') {
                                    $img = $row->Vpost_main_img;
                                } else if ($row->PRpost_main_img != '') {
                                    $img = $row->PRpost_main_img;
                                } else if ($row->PHpost_main_img != '') {
                                    $img = $row->PHpost_main_img;
                                } else if ($row->NPpost_main_img != '') {
                                    $img = $row->NPpost_main_img;
                                } else {

                                    $img = base_url() . 'img/no_preview.png';
                                }
                                //echo $row->product_name4;
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
                                    $product_name = $row->product_name7;
                                } else if ($row->product_name8 != '') {
                                    $product_name = $row->product_name8;
                                } else if ($row->product_name9 != '') {
                                    $product_name = $row->product_name9;
                                } else {

                                    $product_name = 'dfgfd';
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
                                $currency='AED';
                    ?>
                     <div class="item<?php echo $item_class; ?>">

                     <img src="<?php echo $img?>"  class="recent_slimgs" >
                      <div class="mostv_prddiv" >
                          <p class="most_prd">Product</p><span class="most_prd_vals"><?php echo  $product_name?></span>
                          <p class="most_prd_price">Price</p><span class="most_prd_vals"><?php echo  $currency." ".$product_price?></span>
                      </div>
                  

                     </div>

                    <?php
                    $item_class = '';
                    }
                    ?>
               
            </div>

            <!--/div-->
        </div>                 
</section> 

<div id="dataModal" class="modal fade">  
    <div class="modal-dialog">  
        <div class="modal-content">  
            <div class="modal-header">  
                <button type="button" class="close" data-dismiss="modal">&times;</button>  
                <h4 class="modal-title">Share Through Social Icons</h4>  
            </div>  
            <div class="modal-body" id="employee_detail">  
            </div>  
            <div class="modal-footer">  
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
            </div>  
        </div>  
    </div>  
</div>  
<div id="cartModal" class="modal fade">  
    <div class="modal-dialog">  
        <div class="modal-content">  
            <div class="modal-header">  
                <button type="button" class="close" data-dismiss="modal">&times;</button>  
                <h4 class="modal-title">Contact Trader</h4>  
            </div>  
            <div class="modal-body" id="trader_detail">  
            </div>  
            <div class="modal-footer">  
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
            </div>  
        </div>  
    </div>  
</div>  


<script>
    function show_cart_div()
    {

        $('#car_trader').css('display', 'none');
        $('#carsidebar').css('display', 'block');


    }
    function show_profile_div()
    {
        $('#car_trader').css('display', 'block');
        $('#carsidebar').css('display', 'none');

    }
    function check_als_cart(product_id, cart_type)
    {
        if (cart_type == 0)
        {
            var data = 'product_id=' + product_id;
            $.ajax({
                url: "<?php echo base_url(); ?>Trader/fetch_prod_traddet",
                data: data,
                type: "POST",

                success: function (data) {

                    $('#trader_detail').html(data);
                    $('#cartModal').modal("show");


                }

            });
            //$('#cartModal').modal('show');
        } else
        {
            location.href = '<?php echo base_url() ?>Trader/add_cart/' + product_id;

        }
    }
    $(document).ready(function ()
    {
        // var html = '<div class="row">'+
        //             '<div class="col-sm-8" style="text-align: -webkit-center"><i class="fa fa-cog fa-spin fa-2x fa-fw"></i> Please Wait..'+
        //             '</div></div>';
        
      
//         $(document).on( 'click',"#slctcategory",(function(e) {
          
// e.preventDefault();
//             $('#imgpost_div').html(html);
//         var cat     = $('#catid').val();
//         var keyword = $('#keyword').val();
//         var data    = 'category=' + cat + '&keyword=' + keyword; 
   
//         $.ajax({
//             type: "GET",
//             dataType: 'json',
//             data: data,
//             url: 'http://alshamil.bluecast.ae/TraderController/listAll?',
//             success: function (data) {
//                 if(data.posts){
//                     var count = data.posts.length;
//                 }
//                 else{
//                     var count = 0;
//                 }
//                 var html = '<div class="row"><div class="col-sm-12" style="padding:20px">About " ' + count + ' " results found.</div><br>';
//                 $.each(data.posts, function (i, item) {
//                     if (item.CategoryID == 1) {
//                         var page = 'car_category_details';
//                     }
//                     if (item.CategoryID == 2) {
//                         var page = 'bike_category_details';
//                     }
//                     if (item.CategoryID == 3) {
//                         var page = 'show_noplate_details';
//                     }
//                     if (item.CategoryID == 4) {
//                         var page = 'show_vertu_details';
//                     }
//                     if (item.CategoryID == 5) {
//                         var page = 'show_watch_details';
//                     }
//                     if (item.CategoryID == 6) {
//                         var page = 'show_mobileno_details';
//                     }
//                     if (item.CategoryID == 7) {
//                         var page = 'boat_category_details';
//                     }
//                     if (item.CategoryID == 8) {
//                         var page = 'show_iphone_details';
//                     }
//                     if (item.CategoryID == 9) {
//                         var page = 'property_category_details';
//                     }
//                     var sub = '<div class="col-sm-3 catpostimgs">' +
//                             '<a href="<?php echo base_url() ?>Trader/' + page + '/' + item.ProductID + '/' + item.CategoryID + '"> <img src="' + item.Image + '" class="post_imgs"></a>' +
//                             '<div class="tradet_details res-search">' +
//                             '<span class="wlprdpr">Product</span>&nbsp;&nbsp;<b><span class="prdt_price_details">' + item.Brand + ' ' + item.Model + '</span></b><br>' +
//                             '<span class="wlprdpr">Price</span>&nbsp;&nbsp;<b><span class="price_span">AED ' + item.Price + '</span></b>' +
//                             '</div></div>';
//                     html = html + sub;
//                 });
//                 html = html + '</div>';

//                 $('#imgpost_div').html(html);
//             }
// });
       
//         });



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
                    items: 1
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
                    items: 4
                },
                600: {
                    items: 4
                },
                1000: {
                    items: 4
                }
            }
        });
        $('.anccls').click(function () {
            var id = $(this).attr('data-id');
            //alert(id);return false;
            var data = 'product_id=' + id;
            $.ajax({
                url: "<?php echo base_url(); ?>Trader/fetch_proddet",
                data: data,
                type: "POST",

                success: function (data) {
                    $('#employee_detail').html(data);
                    $('#dataModal').modal("show");


                }

            });
        });

    });


</script>