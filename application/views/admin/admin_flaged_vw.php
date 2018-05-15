<?php
$this->view('admin/admin_header'); 
?>
<?php

$slang = 'english';
if($this->session->userdata('site_lang')){
 	
 	$slang =$this->session->userdata('site_lang');
}




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
                <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/custom/flagged.css">      
                <div class="col-main">
                    <div class="col-12">
                    <h4 class="page-title mt-4 mb-2 pb-2 pt-2">FLAGGED</h4>

                    <div class="col-12">
                                <div class="col-12">
                                    <div class="row">
                                    <?php 

foreach($records as $r)
//         echo "<pre>";
// print_r($r);
// echo "</pre>";
{
	
	if($slang=='arabic'){
																	$title_home=$r->productTitleAr;
												}else{
												$title_home= $r->productTitle;
												}
							
												$main_title = ucwords(str_replace(" ",' ',rtrim($title_home)));
?>
                               <div class="col-lg-6 col-12">
                                            <hr class="mt-0">
                                            <div class="col-12">
                                                <div class="row">
                                                    <!-- ------------------------ Product Details Card ------------------------ -->
                                                    <div class="col-6 pl-0">
                                                        <div class="card card-product">
                                                            <div class="col-12">
                                                                <!-- Card Image -->
                                                                <div class="row">
                                                                    <img class="card-image" src="<?= $r->productImage;?>" alt="">
                                                                </div>

                                                                <!-- Card Body -->
                                                                <div class="row bbr-card" style="background-color: #F2F2F2;">
                                                                    <div class="col-12">

                                                                        <!-- Product -->
                                                                        <div class="row mt-2">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-5 pr-lg-1 pr-md-0 pr-sm-2 pr-0 pl-md-3 pl-sm-3 pl-1">
                                                                                <p class="mb-0 text-s13 textresize" style="color: #676767;">Product</p>
                                                                            </div>
                                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-7 pl-0">
                                                                                <p class="mb-0 text-s13 text-semibold textresize" style="color: #262626;"><?php echo $main_title ?></p>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Price -->
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-5 pr-lg-1 pl-lg-3 px-md-3 px-sm-3 px-1">
                                                                                <p class="mb-0 text-s13 textresize" style="color: #676767;">Price</p>
                                                                            </div>
                                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-7 pl-0 pr-sm-3 pr-md-3 pr-0">
                                                                                <p class="mb-0 text-s13 text-semibold textresize" style="color: #262626;"><?php echo ($r->callForPrice==1)? 'Call for price':'AED '.$r->price; ?></p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-12 pr-1 pl-1">
                                                                                <hr class="m-1">
                                                                            </div>
                                                                        </div>

                                                                        <div class="row mb-md-2 mt-md-1">
                                                                            <!-- User Image -->
                                                                            <div class="col-2 pr-lg-1 pl-lg-2 pl-0 pl-md-2">
                                                                                <img class="userImageF" src="<?= $r->traderImage ?>" alt="">
                                                                            </div>

                                                                            <!-- User Details -->
                                                                            <div class="col-10 pr-lg-1 pr-0 pl-lg-3 pl-md-4 pt-sm-0 pt-2">
                                                                                <p class="postDate"><?= $r->submittedOn ?></p>
                                                                                <p class="mb-0 text-s11 textresize text-orange text-semibold textadjust"><?= $r->traderName ?></p>
                                                                                <p class="mb-0 text-s11 textresize text-semibold textadjust" style="color: #747474;"><?= $r->traderLocation ?></p>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <!-- /.card body -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.Product details Card -->

                                                    <!-- ------------------------ Flagged User Details ------------------------ -->
                                                    <div class="col-6">
                                                        <div class="row mt-lg-1">
                                                            <div class="col-12 px-md-3 px-sm-3 px-2">
                                                                <div class="row mb-2 mt-1">
                                                                    <!-- Flagged User Image -->
                                                                    <div class="col-2 pr-lg-1 pl-lg-2 pl-0">
                                                                        <img class="flaggedUser" src="<?= $r->falgUserImage ?>" alt="">
                                                                    </div>

                                                                    <!-- Flagged User Details -->
                                                                    <div class="col-10 pr-lg-1 pl-lg-3">
                                                                        <p class="flaggedDate"><?= $r->date?></p>
                                                                        <p class="mb-0 text-s12 textresize text-orange text-semibold"><?= $r->flaggedname?></p>
                                                                        <p class="mb-0 text-s13 textresize text-semibold" style="color: #424242;">Flagged this post</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Paragraph -->
                                                        <div class="row mt-lg-2">
                                                            <p class="mb-0 text-s14 text-truncate-5 para-height" style="color: #262626;">
                                                            <?= $r->description?>
                                                            </p>
                                                        </div>

                                                        <!-- Buttons -->
                                                        <div class="row mt-4">
                                                            <div class="col-6 pl-0 pr-md-2 pr-sm-2 pr-0">
                                                                <button onclick="discard(<?= $r->flaggedId ?>)" class="btn btn-orange w-100 pt-1 pb-1 text-s14 br-4">
                                                                    Discard
                                                                </button>
                                                            </div>
                                                             <div class="col-6 pr-0 pl-2">
                                                           <!--      <button class="btn btn-red w-100 pt-1 pb-1 text-s14 br-4">
                                                                    Delete
                                                                </button>-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /. Flagged User Details -->
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                        <!-- ./End of a single card -->
                                        <?php }?>
                      
                                    </div>
                                </div>
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


        
            
            <script>
                function flag_detail(trader_id,product_id)
                {
                   
                   // location.href='watchlist_detail/'+trader_id;
                   
                    location.href='<?php echo base_url()?>admin/watchlist_detail/'+trader_id+'/'+product_id;
                }
                function discard(flagId){
                    var txt;
                    var r = confirm("Do you want to discard this item?");
                    if (r == true) {
                         location.href='<?php echo base_url()?>admin/discardFlagged/'+flagId;
                    } 
                    
                }
            </script>
        
       