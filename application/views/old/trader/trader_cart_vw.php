

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
                if (count($qry) > 0) {

                    foreach ($qry as $row) {
                        ?>   

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
                        }else if ($row->product_name7 != '') {
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
                        ?>
                        <div class="col-sm-9 sub_cart_div" id="sub_cart_div_<?php echo $row->productID ?>">
                            <div class="row">
                            <a  href="<?php echo base_url() ?>Trader/category_details/<?php echo $row->productID; ?>/<?php echo $row->productCategoryID; ?>">
                          
                                <div class="prdt_cart_details_div">
                                    <div class="col-sm-3 col-xs-3 cartimgcol">
                                        <img src="<?php echo $img; ?>" class="cartpost_imgs" >
                                    </div>

                                    <div class="col-sm-3 col-xs-12 pr-0" id="product_details_div">
                                        <span id="cartprdpr1">Product&nbsp;&nbsp;<b><span class="prdt_price_details" id="cart_product"><?php echo $product_name; ?></span></b></span><br>
                                        <span id="cartprdpr2">Price&nbsp;&nbsp;<b><span class="price_span"  id="cart_price"><?php $this->Trader_mdl->formataed($product_price); ?></span></b></span>
                                        <hr class="hr_cart">
                                        <?php
                                        if ($row->traderImage != '' && (@getimagesize($row->traderImage))) {
                                            ?>
                                            <img src="<?php echo $row->traderImage ?>" id="cart_user_prof">
                                            <?php
                                        } else {
                                            ?>
                                            <img src="<?php echo base_url() ?>img/userProfileIcon_gray.png" id="cart_user_prof">
                                            <?php
                                        }
                                        ?>


                                        <p id="cart_uname"><?php echo $row->traderFullName ?></p>
                                        <p id="cart_uplace"><?php echo $row->traderLocation ?></p>

                                    </div>
                                    </a>
                                    <div class="vl"></div>
                                    <div class="col-xs-6 col-sm-3" id="del_btn_div">

                                        <button class="cart_del_btns" onclick="cart_del('<?php echo $row->productID ?>', '<?php echo $row->productCategoryID ?>')">Delete</button>
                                    </div>

                                </div>


                            </div>

                        </div>
                        <?php
                    }
                } else {
                    echo "<div class='col-xs-12 col-sm-12 col-md-12 nomsgdiv line-item'><center>No Item(s) In Your Cart </center></div>";
                }
                ?>
            </div>
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
        </div><!-- end row -->  
    </div><!-- end container -->
</section>

<?php $this->load->view('trader/recently_viewed_vw'); ?>
<script>

    function cart_del(product_id, cat_id)
    {
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, I am sure!',
            cancelButtonText: "No, cancel it!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
                function (isConfirm) {
                    if (isConfirm) {
                        swal({
                            title: 'Deleted!',
                            text: 'Your Product is deleted from cart!',
                            type: 'success'
                        }, function () {

                            $.ajax({
                                url: "<?php echo base_url(); ?>/Trader/del_cart",
                                data: {'product_id': product_id, 'cat_id': cat_id},
                                type: "POST",

                                success: function (data) {

                                    if (data == 'success')
                                    {
                                        //  console.log(data);return false;
                                        setTimeout(function ()
                                        {
                                            //location.reload();  //Refresh page
                                            location.href = '<?php echo base_url() ?>Trader/view_cart';
                                        }, 1000);
                                    }

                                }

                            });
                        });

                    } else {
                        swal("Cancelled", "Your product is safe :)", "error");
                    }
                });

    }

    $(document).ready(function () {


        $('#btncheckout').click(function () {

            var value = document.getElementById("cartcnt").innerText;

            if (value > 0) {
                location.href = '<?php echo base_url() ?>Trader/view_checkout';
            } else
            {
                swal("Warning", "No items in Cart List");
            }
        });
        $('#btnshopmore').click(function () {
            location.href = '<?php echo base_url() ?>Trader';
        });
    });
</script>

