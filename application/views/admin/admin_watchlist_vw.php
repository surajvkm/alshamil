<?php
$this->view('admin/admin_header'); 
?>
<!--script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="code/highstock.js"></script>
<script src="code/modules/exporting.js"></script-->
<?php

$slang = 'english';
if($this->session->userdata('site_lang')){
 	
 	$slang =$this->session->userdata('site_lang');
}

?>
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
                    <h4 class="page-title mt-4 mb-2 pb-2 pt-2">WATCH LIST</h4>

                    <div class="col-12">
                                <div class="col-12">
                                    <div class="row">
                                        <?php 
                
                                            foreach($records as $row)
                                            {
                                                // $title = strtolower(str_replace(" ",'-',$row->Name));
                                
                                				if($slang=='arabic'){
																	$title_home=$row->productTitleAr;
												}else{
												$title_home= $row->productTitle;
												}
							
												$main_title = ucwords(str_replace(" ",' ',rtrim($title_home)));
                                        ?>
                                        <!-- -------- Single Card -------- -->
                                        <div class="col-lg-3 col-sm-6 col-12">
                                            <div class="row">
                                                <div class="card card-product">
                                                    <a 
                                                    href="<?php echo base_url().'admin/watchlist_detail/'.$row->traderID.'/'.$row->productId;  ?>">
                                                        <div class="col-12">

                                                            <!-- Card Image -->
                                                            <div class="row">
                                                                <img class="card-image" src="<?php echo $row->productImage?>" alt="">

                                                                <!-- Watch Button -->
                                                                <button class="views">Watch
                                                                    <br>
                                                                    <span class="text-semibold text-s15"><?php echo $row->wcnt?></span>
                                                                </button>
                                                            </div>

                                                            <!-- Card Body -->
                                                            <div class="row bbr-card" style="background-color: #F2F2F2;">
                                                                <div class="col-12">

                                                                    <!-- Product -->
                                                                    <div class="row mt-2">
                                                                        <div class="col-4">
                                                                            <p class="mb-0 text-s13" style="color: #676767;">Product</p>
                                                                        </div>
                                                                        <div class="col-8 pl-0 pr-0">
                                                                            <p class="mb-0 text-s13 text-semibold" style="color: #262626;"><?php echo $main_title; ?></p>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Price -->
                                                                    <div class="row mb-2">
                                                                        <div class="col-4">
                                                                            <p class="mb-0 text-s13" style="color: #676767;">Price</p>
                                                                        </div>
                                                                        <div class="col-8 pl-0">
                                                                            <p class="mb-0 text-s13 text-semibold" style="color: #262626;">AED <?php echo $row->productPrice?></p>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <!-- /.card body -->
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
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
    function watch_detail(trader_id,product_id)
    { 
        // location.href='watchlist_detail/'+trader_id;
        location.href='<?php echo base_url()?>admin/watchlist_detail/'+trader_id+'/'+product_id;
    }
</script>
        
       