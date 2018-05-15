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
                <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/custom/all-categories.css">      
                <div class="col-main">
                    <div class="col-12">
                    <h4 class="page-title mt-4 mb-2 pb-2 pt-2"><?php echo strtoupper($category);?> LIST</h4>

                    <div class="col-12">
                                <div class="col-12">
                                    <div class="row">
                                        <?php 
                                            if(count($all_products)>0 && !empty($all_products))
                                            {
                                            foreach($all_products as $row)
                                            {
                                            //     echo '<pre>';
                                            // var_dump($row);
                                            // exit;
                                        ?>
                                     <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                     <div class="row">
                                         <div class="card card-product">
                                             <a href="<?php echo base_url()?>admin/Dashboard/post_details/<?php echo $row['postID']; ?>">
                                                 <div class="col-12">

                                                     <!-- Card Image -->
                                                     <div class="row">
                                                         <img class="card-image" src="<?php echo $row['Image']?>" alt="">
                                                     </div>

                                                     <!-- Card Body -->
                                                     <div class="row bbr-card" style="background-color: #F2F2F2;">
                                                         <div class="col-12">

                                                             <!-- Product -->
                                                             <div class="row mt-2">
                                                                 <div class="col-4 product-padding ">
                                                                     <p class="mb-0 text-s13" style="color: #676767;">Product</p>
                                                                 </div>
                                                                 <div class="col-8 pl-0 pr-0">
                                                                     <p class="mb-0 text-s13 text-semibold" style="color: #262626;"><?php 
                                                                       echo  $name = $row['Brand']." ".$row['Model'];
                                                                       // echo substr($name, 0, 10);
                                                                        ?></p>
                                                                 </div>
                                                             </div>

                                                             <!-- Price -->
                                                             <div class="row">
                                                                 <div class="col-4 product-padding ">
                                                                     <p class="mb-0 text-s13" style="color: #676767;">Price</p>
                                                                 </div>
                                                                 <div class="col-8 pl-0 pr-0">
                                                                     <p class="mb-0 text-s13 text-semibold" style="color: #262626;"><?php echo ($row['CallPrice']==1)? 'Call for price':'AED '.$row['Price']; ?></p>
                                                                 </div>
                                                             </div>

                                                             <div class="row">
                                                                 <div class="col-12 pr-1 pl-1">
                                                                     <hr class="mb-2 ml-2 mr-2 mt-1">
                                                                 </div>
                                                             </div>

                                                             <!-- Footer -->
                                                             <div class="row mb-2 mt-1">
                                                                 <!-- User Image -->
                                                                 <div class="col-2 pr-lg-1 pl-2 userImage-padding">
                                                                     <img class="userImageA" src="<?php echo $row['traderImage'];?>" alt="">
                                                                 </div>
                              
                                                                 <!-- User Details -->
                                                                 <div class="col-10 pr-lg-1 pl-lg-3 pl-3">
                                                                     <p class="postDate"> <?php $t = strtotime($row['SubmitDate']); echo date(" j M Y",$t ) ;?></p>
                                                                     <p class="mb-0 text-s11 textresize text-orange text-semibold"><?php echo $row['traderFullName'];?></p>
                                                                     <p class="mb-0 text-s11 textresize text-semibold" style="color: #747474;"><?php echo $row['traderLocation'];?></p>
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
                    
                                            <?php
                                        }else{
                                            ?>
                                            <div class="col-md-12"><h4 class="no_prod text-center">NO PRODUCTS AVAILABLE</h4></div>
                                            <?php
                                            
                                        }?>
                      
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
                function product_detail(trader_id,product_id)
                {
                   
                   // location.href='watchlist_detail/'+trader_id;
                   
                    location.href='<?php echo base_url()?>admin/Dashboard/watchlist_detail/'+trader_id+'/'+product_id;
                }
            </script>
        
       