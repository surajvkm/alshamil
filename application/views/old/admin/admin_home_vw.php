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
                <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/custom/home.css">      
                <div class="col-main">
                <div class="col-12">
                    <!-- -------- Title -------- -->
                    <h4 class="page-title mt-4 mb-2 pb-2 pt-2">Home</h4>
                    <?php 
                            if(count($all_product)>0 && isset($all_product) && !empty($all_product)){
                        ?>
                    <div class="row">
                        <div class="col-12">

                            <!-- ------------------ Tabs & Body ------------------------ -->
                            <div class="col-12">

                                <!-- ------------------ Tabs ------------------------ -->
                                <ul class="nav nav-tabs justify-content-center" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link allPost active" id="allPost-tab" data-toggle="tab" href="#allPost" role="tab" aria-controls="allPost"
                                            aria-selected="true">All Post &nbsp; <?php echo $total_post;?>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link booked" id="booked-tab" data-toggle="tab" href="#booked" role="tab" aria-controls="booked" aria-selected="false">Booked &nbsp;&nbsp; <?php echo $booked;?>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link sold" id="sold-tab" data-toggle="tab" href="#sold" role="tab" aria-controls="sold" aria-selected="false">Sold &nbsp;&nbsp; <?php echo $sold_count;?>
                                        </a>
                                    </li>
                                 
                                </ul>

                                <!-- ------------------ Body ------------------ -->
                                <div class="tab-content mb-lg-5">

                                    <!-- ------------------ Table : AllPost ------------------------ -->
                                    <div class="tab-pane fade show active" id="allPost" role="tabpanel" aria-labelledby="allPost-tab">
                                        <div class="col-12">
                                            <div class="col-12 mt-4">
                                                <div class="row">
                                                <?php 
        
                                                    foreach($all_product as $key => $value) {
                                                    
                                                    ?>

                                                
                                                
                                                    <!-- -------- Single Card -------- -->
                                                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">

                                                    <a href="<?php echo base_url()?>admin/Dashboard/post_details/<?php echo $value['postID']; ?>">
                                            
                                                                                                    <div class="row">
                                                                                                        <div class="card card-product">
                                                                                                            <div class="col-12">

                                                                                                                <!-- Card Image -->
                                                                                                                <div class="row">
                                                                                                                    <img class="card-image"  src="<?php echo $value['Image']?>" onerror="this.src='<?php echo base_url()?>img/no_preview.png'" alt="">
                                                                                                                    <?php if($value['AvailablitiyStatus']==2){?>    <button class="bookedBtn">Booked</button><?php }?>
                                                            <?php if($value['AvailablitiyStatus']==1){?><span class="admin_view_cnt">    <button class="soldBtn">SOLD</button></span><?php }?>
                                                                                                                </div>

                                                                                                                <!-- Card Body -->
                                                                                                                <div class="row bbr-card" style="background-color: #F2F2F2;">
                                                                                                                    <div class="col-12">

                                                                                                                        <!-- Product -->
                                                                                                                        <div class="row mt-2">
                                                                                                                            <div class="col-4 pr-lg-3 pr-0 product-padding">
                                                                                                                                <p class="mb-0 text-s13" style="color: #676767;">Product</p>
                                                                                                                            </div>
                                                                                                                            <div class="col-8 pl-0">
                                                                                                                                <p class="mb-0 text-s13 text-semibold" style="color: #262626;"><?= $value['Brand'].' - '.$value['Model'];?></p>
                                                                                                                            </div>
                                                                                                                        </div>

                                                                                                                        <!-- Price -->
                                                                                                                        <div class="row">
                                                                                                                            <div class="col-4 product-padding">
                                                                                                                                <p class="mb-0 text-s13" style="color: #676767;">Price</p>
                                                                                                                            </div>
                                                                                                                            <div class="col-8 pl-0">
                                                                                                                                <p class="mb-0 text-s13 text-semibold" style="color: #262626;"><?php echo ($value['CallPrice']==1)? 'Call for price':'AED '.$value['Price']; ?></p>
                                                                                                                            </div>
                                                                                                                        </div>

                                                                                                                        <div class="row">
                                                                                                                            <div class="col-12 p-1">
                                                                                                                                <hr class="m-2">
                                                                                                                            </div>
                                                                                                                        </div>

                                                                                                                        <!-- Footer -->
                                                                                                                        <div class="row mb-2">
                                                                                                                            <div class="col-6 text-left">
                                                                                                                                <p class="mb-0 text-s13 date-font" style="color: #676767;"><?=date("d M-Y", strtotime($value['SubmitDate'])); ?></p>
                                                                                                                            </div>
                                                                                                                            <div class="col-6 text-right">
                                                                                                                                <p class="mb-0 text-s13 text-semibold date-font" style="color: #262626;"><?= $value['productViewCount'];?> Views</p>
                                                                                                                            </div>
                                                                                                                        </div>

                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <!-- /.card body -->
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    </a>
                                                                                                </div>


                                                    <?php
                                                }
                                                ?>                                 </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ------------------ Table : Booked ------------------------ -->
                                    <div class="tab-pane fade " id="booked" role="tabpanel" aria-labelledby="booked-tab">
                                        <div class="col-lg-12">
                                        <div class="col-12 mt-4">
                                                <div class="row">
                                                    <?php 
                                                
                                                        foreach($bkd_product as $key => $value) {
                                                        
                                                        ?>

                                                    
                                                    
                                                        <!-- -------- Single Card -------- -->
                                                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">

                                                        <a href="<?php echo base_url()?>admin/Dashboard/post_details/<?php echo $value['postID']; ?>">
                                            
                                                                                                        <div class="row">
                                                                                                            <div class="card card-product">
                                                                                                                <div class="col-12">

                                                                                                                    <!-- Card Image -->
                                                                                                                    <div class="row">
                                                                                                                        <img class="card-image"  src="<?php echo $value['Image']?>" onerror="this.src='<?php echo base_url()?>img/no_preview.png'" alt="">
                                                                                                                        <?php if($value['AvailablitiyStatus']==2){?>    <button class="bookedBtn">Booked</button><?php }?>
                                                                                                                        <?php if($value['AvailablitiyStatus']==1){?><span class="admin_view_cnt">    <button class="soldBtn">SOLD</button></span><?php }?>
                                                                                                                    </div>

                                                                                                                    <!-- Card Body -->
                                                                                                                    <div class="row bbr-card" style="background-color: #F2F2F2;">
                                                                                                                        <div class="col-12">

                                                                                                                            <!-- Product -->
                                                                                                                            <div class="row mt-2">
                                                                                                                                <div class="col-4 pr-lg-3 pr-0">
                                                                                                                                    <p class="mb-0 text-s13" style="color: #676767;">Product</p>
                                                                                                                                </div>
                                                                                                                                <div class="col-8 pl-0">
                                                                                                                                    <p class="mb-0 text-s13 text-semibold" style="color: #262626;"><?= $value['Brand'].' - '.$value['Model'];?></p>
                                                                                                                                </div>
                                                                                                                            </div>

                                                                                                                            <!-- Price -->
                                                                                                                            <div class="row">
                                                                                                                                <div class="col-4">
                                                                                                                                    <p class="mb-0 text-s13" style="color: #676767;">Price</p>
                                                                                                                                </div>
                                                                                                                                <div class="col-8 pl-0">
                                                                                                                                    <p class="mb-0 text-s13 text-semibold" style="color: #262626;"><?php echo ($value['CallPrice']==1)? 'Call for price':'AED '.$value['Price']; ?></p>
                                                                                                                                </div>
                                                                                                                            </div>

                                                                                                                            <div class="row">
                                                                                                                                <div class="col-12 p-1">
                                                                                                                                    <hr class="m-2">
                                                                                                                                </div>
                                                                                                                            </div>

                                                                                                                            <!-- Footer -->
                                                                                                                            <div class="row mb-2">
                                                                                                                                <div class="col-6 text-left">
                                                                                                                                    <p class="mb-0 text-s13" style="color: #676767;"><?=date("d M-Y", strtotime($value['SubmitDate'])); ?></p>
                                                                                                                                </div>
                                                                                                                                <div class="col-6 text-right">
                                                                                                                                    <p class="mb-0 text-s13 text-semibold" style="color: #262626;"><?= $value['productViewCount'];?> Views</p>
                                                                                                                                </div>
                                                                                                                            </div>

                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <!-- /.card body -->
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        </a>
                                                                                                    </div>


                                                        <?php
                                                    }
                                                    ?>                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ------------------ Table : Sold ------------------------ -->
                                    <div class="tab-pane fade" id="sold" role="tabpanel" aria-labelledby="sold-tab">
                                        <div class="col-lg-12 col-12">
                                        <div class="col-12 mt-4">
                                                <div class="row">
                                                    <?php 
                                                
                                                        foreach($sld_product as $key => $value) {
                                                        
                                                        ?>

                                                    
                                                        <!-- -------- Single Card -------- -->
                                                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">

                                                        <a href="<?php echo base_url()?>admin/Dashboard/post_details/<?php echo $value['postID']; ?>">
                                            
                                                                                                        <div class="row">
                                                                                                            <div class="card card-product">
                                                                                                                <div class="col-12">

                                                                                                                    <!-- Card Image -->
                                                                                                                    <div class="row">
                                                                                                                        <img class="card-image"  src="<?php echo $value['Image']?>" onerror="this.src='<?php echo base_url()?>img/no_preview.png'" alt="">
                                                                                                                        <?php if($value['AvailablitiyStatus']==2){?>    <button class="bookedBtn">Booked</button><?php }?>
                                                                                                                        <?php if($value['AvailablitiyStatus']==1){?><span class="admin_view_cnt">    <button class="soldBtn">SOLD</button></span><?php }?>
                                                                                                                    </div>

                                                                                                                    <!-- Card Body -->
                                                                                                                    <div class="row bbr-card" style="background-color: #F2F2F2;">
                                                                                                                        <div class="col-12">

                                                                                                                            <!-- Product -->
                                                                                                                            <div class="row mt-2">
                                                                                                                                <div class="col-4 pr-lg-3 pr-0">
                                                                                                                                    <p class="mb-0 text-s13" style="color: #676767;">Product</p>
                                                                                                                                </div>
                                                                                                                                <div class="col-8 pl-0">
                                                                                                                                    <p class="mb-0 text-s13 text-semibold textsize-10" style="color: #262626;"><?= $value['Brand'].' - '.$value['Model']; ?></p>
                                                                                                                                </div>
                                                                                                                            </div>

                                                                                                                            <!-- Price -->
                                                                                                                            <div class="row">
                                                                                                                                <div class="col-4">
                                                                                                                                    <p class="mb-0 text-s13" style="color: #676767;">Price</p>
                                                                                                                                </div>
                                                                                                                                <div class="col-8 pl-0">
                                                                                                                                    <p class="mb-0 text-s13 text-semibold textsize-10" style="color: #262626;"><?php echo ($value['CallPrice']==1)? 'Call for price':'AED '.$value['Price']; ?></p>
                                                                                                                                </div>
                                                                                                                            </div>

                                                                                                                            <div class="row">
                                                                                                                                <div class="col-12 p-1">
                                                                                                                                    <hr class="m-2">
                                                                                                                                </div>
                                                                                                                            </div>

                                                                                                                            <!-- Footer -->
                                                                                                                            <div class="row mb-2">
                                                                                                                                <div class="col-6 text-left">
                                                                                                                                    <p class="mb-0 text-s13" style="color: #676767;"><?=date("d M-Y", strtotime($value['SubmitDate'])); ?></p>
                                                                                                                                </div>
                                                                                                                                <div class="col-6 text-right">
                                                                                                                                    <p class="mb-0 text-s13 text-semibold" style="color: #262626;"><?= $value['productViewCount'];?> Views</p>
                                                                                                                                </div>
                                                                                                                            </div>

                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <!-- /.card body -->
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        </a>
                                                                                                    </div>

                                                             
                                                        <?php
                                                    }
                                                    ?>                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                

                                </div>
                            </div>
                            <!-- /.Tabs and body -->

                        </div>
                    </div>
                    <!-- /row -->
                    <?php }else{?>
                    <h4 class="page-title mt-4 mb-2 pb-2 pt-2">No Items found</h4>
                    <?php }?>
                </div>
            </div>

                


        </div>  <!-- ---- B Main Div ends here ---- -->
    </div>
</div><!-- end row 1-->  


<?php
$this->view('admin/admin_footer'); 
?>


