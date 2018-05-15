<?php
$this->view('admin/admin_header'); 
?>
<!--script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="code/highstock.js"></script>
<script src="code/modules/exporting.js"></script-->

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">

                <?php
                $this->view('admin/admin_sidebar'); 
                ?>
                <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/custom/watchlist.css">      
                <div class="col-main">
                    <div class="col-12">
                    <h4 class="page-title mt-4 mb-2 pb-2 pt-2">WATCH LIST DETAILS</h4>
                    <div class="row">
<?php $r=$qry[0]; ?>
<!-- ----------------- Product Row ------------------- -->
<div class="col-12 px-md-3 px-sm-3 px-0">
    <div class="h-87 bg-watchList ml-1 mr-1 mb-2 overflow-hidden">
        <div class="col-12 p-0">
            <div class="row">
                <!-- Product Image -->
                <div class="col-2 pr-0 pr-lg-3">
                    <img class="productImageW" src="<?php echo $r->productImage?>" alt="">
                </div>

                <!-- Product Details -->
                <div class="col-sm-3 col-4 mt-3 mb-lg-3 vbr pt-lg-0 px-lg-3 px-2">

                    <!-- Name -->
                    <div class="row">
                        <div class="col-sm-3 col-4 pr-lg-3 pr-md-4 text-left">
                            <span class="text-s13 textadjust" style="color: #757575;">Product</span>
                        </div>
                        <div class="col-lg-9 col-8 pl-md-4 pl-sm-4 pr-0">
                            <span class="text-s13 text-semibold textadjust pl-md-1 pl-sm-2" style="color: #404040;"><?php echo ucfirst($r->productName)?></span>
                        </div>
                    </div>

                    <!-- Price -->
                    <div class="row">
                        <div class="col-3 pr-lg-3 text-left">
                            <span class="text-s13 textadjust" style="color: #757575;">Price</span>
                        </div>
                        <div class="col-lg-9 col-8 pl-sm-4 pl-md-4 pr-0 text-lg-left ">
                            <span class="text-s13 text-semibold pl-1 textadjust" style="color: #404040;">AED <?php echo $r->productPrice?></span>
                        </div>
                    </div>
                </div>

                <!-- User Image -->
                <div class="col-1 pt-3 pr-lg-2 text-lg-right pl-1 pl-lg-3">
                    <?php
                    if($r->traderImage != '')
                    {
                        ?>
                        <img src="<?php echo base_url().$r->traderImage?>" class="userImageW" >
                        <?php
                    }
                    else {
                        ?>
                        <img src="<?php echo base_url()?>img/userProfileIcon_gray.png" class="userImageW" >
                        <?php    
                    }
                    ?>
               
                </div>

                <!-- User Details -->
                <div class="col-3 mt-4 mb-lg-3 vbr pl-4 pl-sm-3 pr-0 pr-md-3 pr-sm-3 pl-md-3">
                    <p class="mb-0 text-s13 text-orange text-semibold textadjust pl-2 pl-md-0 pl-sm-0"><?php echo ucfirst($r->traderFullName)?></p>
                    <p class="mb-0 text-s12 text-semibold textadjust" style="color: #747474;"><?php echo ucfirst($r->traderLocation)?></p>
                </div>

                <!-- Watchlist added number -->
                <div class="col-sm-3 col-2 mt-lg-4 mt-4 mb-lg-3 pl-lg-3 pl-md-2 pl-1 pr-lg-3 pr-md-1">
                    <p class="mb-0 text-s15 text-semibold textadjust" style="color: #262626;"><?php echo $r->wcnt?></p>
                    <p class="mb-0 text-s13 textresize text-semibold text-watchlist textadjust" style="color: #262626;">Users added to Watchlist</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ----------------- Users List ----------------- -->
<div class="col-12">
    <div class="col-12">
        <div class="row mt-lg-3 mt-md-2">
        <?php
                $i = 1;
                foreach($tr_qry as $r) {
                    $i++;
                    if($i%2==0)
                    $class="style='background-color:white;'";
                    else
                    $class="style='background-color:#eee;'";
                ?>
            <!-- Single User Data -->
            <div class="col-lg-4 col-sm-6 col-12 bg-watchListUsers h-67 mb-2" <?php echo $class; ?>>
                <div class="row overflow-hidden pr-lg-3">
            
                    <!-- User Image -->
                    <div class="col-3 pr-lg-2 pt-2 pb-lg-2 pl-lg-3 pl-md-2">
                        <?php
                        if($r->traderImage != '') {
                        ?>
                            <img src="<?php echo $r->traderImage?>" class="userImageW" alt="">
                        <?php
                        }
                        else {
                        ?>
                            <img src="<?php echo base_url()?>img/userProfileIcon_gray.png" class="userImageW" alt="">
                        <?php  
                        }
                        ?>
                        <?php
                        $d = $r->productSubmitDate;
                        $d1 = strtotime($d);
                        ?>
                    </div>

                    <!-- User Details -->
                    <div class="col-9 pt-3 pl-lg-0 pl-md-2 pb-lg-3 pr-lg-3 pr-md-0 px-sm-1 px-0">
                        <p class="watchDate textresize"><?php echo date('d M Y',$d1)?></p>
                        <p class="mb-0 text-s12 textresize text-orange text-semibold"><?php echo ucfirst($r->traderFullName)?></p>
                        <p class="mb-0 text-s11 textresize text-semibold" style="color: #747474;"><?php echo ucfirst($r->traderLocation)?></p>
                    </div>
                </div>
            </div>
                <?php }?>
        </div>
    </div>
</div>
<!-- /.Users list -->
</div>
                 





                    </div>
                 </div>
                


            </div>  <!-- ---- B Main Div ends here ---- -->
        </div>
    </div><!-- end row 1-->  
</div>

<?php
$this->view('admin/admin_footer'); 
?>


