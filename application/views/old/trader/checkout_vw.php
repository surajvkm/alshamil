
<!-- start section -->
<section class="section white-backgorund">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="col-sm-9 sub_cart_div category-dateview">
                    <div class="row">
                        <div class="mytextdiv">
                            <div class="mytexttitle">
                                CHECKOUT
                            </div>
                            <div class="divider"></div>
                            <div class="catcount-div">(<b><span id="cartcnt"><?php echo $total_cnt ?></span></b> Items)</div>
                        </div>
                    </div>

                </div> 
            </div>
            <?php
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
                if ($row->cartCType != '') {
                    $cart_type = $row->cartCType;
                } else if ($row->cartBType != '') {
                    $cart_type = $row->cartBType;
                } else if ($row->cartNPType != '') {
                    $cart_type = $row->cartNPType;
                } else if ($row->cartVType != '') {
                    $cart_type = $row->cartVType;
                } else if ($row->cartBTType != '') {
                    $cart_type = $row->cartBTType;
                } else if ($row->cartWType != '') {
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
                <div class="col-xs-12 col-sm-9 sub_cart_div" id="sub_cart_div_<?php echo $row->productID ?>">
                <a href='<?php echo base_url("Trader/category_details/").$row->productID.'/'.$row->productCategoryID ?>'>
                    <div class="row">
                        <div class="prdt_cart_details_div">
                            <div class="col-xs-3 col-sm-3 cartimgcol">
                                <img src="<?php echo $img; ?>" class="cartpost_imgs" >
                            </div>

                            <div class="col-sm-9 product-details" id="product_details_div">
                                <span id="cartprdpr1">Product&nbsp;&nbsp;<b><span class="prdt_price_details" id="cart_product"><?php echo $product_name; ?></span></b></span><br>
                                <input type="hidden" class="prdt_price" value="<?php echo $product_price ?>">
                                <span id="cartprdpr2">Price&nbsp;&nbsp;<b><span class="price_span"  id="cart_price"><?php $this->Trader_mdl->formataed($product_price); ?></span></b></span>
                                <hr class="hr_checkout">
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


                                <p id="cart_uname" class="username"><?php echo $row->traderFullName ?></p>
                                <p id="cart_uplace" class="place"><?php echo $row->traderLocation ?></p>

                            </div>

                        </div>


                    </div>

                </div>
                <?php
            }
            ?>
            <div class="col-sm-9 sub_cart_div category-dateview">
                <hr>
                <div class=" col-xs-11 col-md-5 category-dateview checkout-mat-calcdiv">
                    <input type="hidden" id="hid_orderid">
                    <p class="total_amt_p">Sub Total<span class="ckhamts" id="span_sub_tot"></span></p>
                    <hr class="chouthr">
                    <p class="total_amt_p">Eco Tax <span class="ckhamts" id="span_eco_tax"></span><span class="ckhamts">AED&nbsp;</span></p>
                    <hr class="chouthr">
                    <p class="total_amt_p">Vat 10%<span class="ckhamts" id="span_vat"></span></p>
                    <hr class="chouthr">
                    <p class="total_amt_p"><b>Total<span class="ckhamts" id="span_totamt"></span></b></p>

                </div>

            </div>
            <div class="col-sm-9 sub_cart_div category-dateview">
                <hr>
            </div>
            <div class="col-md-12">
                <div class="col-sm-9 sub_cart_div category-dateview">
                    <div class="col-sm-2">
                        
                    </div>
                    <div class="col-xs-6 col-sm-4">
                        <button class="cart_btns" id="btncartonline"><i class="fa fa-credit-card als_onfont" aria-hidden="true"></i>&nbsp;&nbsp;Online</button>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                        <button class="cart_btns" id="btncartalshamil" data-toggle="modal" data-target="#alshModal"><img class="als_payicon" src="<?php echo base_url() ?>img/alshamil-icon.png"><span class="als_span_chkout">Al-Shamil</span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>






<?php $this->load->view('trader/recently_viewed_vw'); ?>
<div class="modal fade" id="alshModal" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content tradermdl">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Confirm</h5>
            </div>
            <div class="modal-body" id="alshdiv">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success"  id="change_paymentstatus" data-dismiss="modal">Yes,Proceed</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        var tax_value = parseFloat(2000);
        var new_tax_value = tax_value.toFixed(2);

        $('#span_eco_tax').html(new_tax_value);

        var sub_tot = 0;
        var grand_tot = 0;
         $('.prdt_price').each(function () {
        


            var price = parseInt($(this).val());

            sub_tot += price;


        });

        //$('#span_sub_tot').html("AED "+new_subtot);
        $('#span_sub_tot').html("AED " + parseFloat(sub_tot).toFixed(2));
        var vat_per = 10;
        var sub_tot_vat_per = parseFloat((sub_tot * 10) / 100).toFixed(2);
        //var sub_tot_vat_per = (sub_tot*10)/100;
        $('#span_vat').html("AED " + sub_tot_vat_per);

        var eco_tax = $('#span_eco_tax').html();

        var subtotal = $('#span_sub_tot').html();
        var vatt = $('#span_vat').html();

        var new_subtotal = subtotal.split(" ");
        var final_subtotal = new_subtotal[1];


        var final_tax = eco_tax;
        var new_vat = vatt.split(" ");
        var mod_vat = new_vat[1];

        var final_vat = mod_vat;
        //alert(final_subtotal+"-"+final_tax+"-"+final_vat);return false;
        var grand_tot = parseInt(final_subtotal) + parseInt(final_tax) + parseInt(final_vat);

        $('#span_totamt').html("AED " + grand_tot.toFixed(2));
        var new_tot = $('#span_totamt').html();

        var fin_tot = new_tot.split(" ");
        var mod_tot = fin_tot[1];

        $.ajax({
            url: "<?php echo base_url(); ?>Trader/add_order_items",
            data: {'fin_tot': mod_tot, 'final_tax': final_tax, 'final_vat': final_vat},
            type: "POST",

            success: function (data) {
                //console.log(data);return false;
                var res = data.split("/");
                var orderid = res[0];
                if (orderid > 0)
                {

                    $('#hid_orderid').val(data);

                }

            }

        });
        $("#btncartalshamil").click(function (e)
        {
e.preventDefault();
            var myurl = '<?php echo base_url() ?>Trader/checkoutfetch_alshmail_loc';


            $.ajax({
                type: 'POST',
                url: myurl,

                success: function (data)
                {

                    $('#alshdiv').html(data);
                    //console.log(data);return false;
                }
            });

        });
        $('#btncartonline').click(function ()
        {
            $.ajax({
                url: "<?php echo base_url(); ?>Trader/add_order_items",
                data: {'fin_tot': mod_tot, 'final_tax': final_tax, 'final_vat': final_vat},
                type: "POST",

                success: function (data) {
                    //console.log(data);return false;
                    var res = data.split("/");
                    var orderid = res[0];
                    var totamt = res[1];
                    var userid = res[2];
                    if (orderid > 0)
                    {

                        location.href = 'http://alshamil.bluecast.ae/trader/OnlinePay?amount=' + totamt + '&user_id=' + userid + '&order_id=' + orderid;

                    }

                }

            });

        });
        $('#change_paymentstatus').click(function ()
        {
            var hid_oid = $('#hid_orderid').val();

            var myurl = '<?php echo base_url() ?>Trader/change_paystatus';


            $.ajax({
                type: 'POST',
                url: myurl,
                data: {'order_id': hid_oid},
                success: function (data)
                {

                    if (data == 'success')
                    {
                        swal("Registered for Payment", "Please Contact Alshamil Team to Proceed at the earliest");
                        setTimeout(function ()
                        {

                            location.href = '<?php echo base_url() ?>Trader';
                        }, 5000);
                    }
                }
            });

        });

    });
</script>

