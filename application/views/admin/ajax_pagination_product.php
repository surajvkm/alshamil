

                    <div class="col-12">
                                <div class="col-12">
                                    <div class="row">
                                        <?php 
                                            if(count($records)>0 && !empty($records))
                                            {
                                            foreach($records as $row)
                                            {
                                            //     echo '<pre>';
                                            // var_dump($row);
                                            // exit;
                                        ?>
                                     <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                     <div class="row">
                                         <div class="card card-product">
                                             <a href="<?php echo base_url()?>admin/post_details/<?php echo $row['productId']; ?>">
                                                 <div class="col-12">

                                                     <!-- Card Image -->
                                                     <div class="row">
                                                         <img class="card-image" src="<?php echo $row['mainImage']?>" alt="">
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
                                                                     <p class="mb-0 text-s13 text-semibold" style="color: #262626;"></p>
                                                                 </div>
                                                             </div>

                                                             <!-- Price -->
                                                             <div class="row">
                                                                 <div class="col-4 product-padding ">
                                                                     <p class="mb-0 text-s13" style="color: #676767;">Price</p>
                                                                 </div>
                                                                 <div class="col-8 pl-0 pr-0">
                                                                     <p class="mb-0 text-s13 text-semibold" style="color: #262626;"><?php echo ($row['callForPrice']==1)? 'Call for price':'AED '.$row['price']; ?></p>
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
                                                                     <img class="userImageA" src="<?php echo $row['image'];?>" alt="">
                                                                 </div>
                              
                                                                 <!-- User Details -->
                                                                 <div class="col-10 pr-lg-1 pl-lg-3 pl-3">
                                                                     <p class="postDate"> <?php $t = strtotime($row['submittedOn']); echo date(" j M Y",$t ) ;?></p>
                                                                     <p class="mb-0 text-s11 textresize text-orange text-semibold"><?php echo $row['fullName'];?></p>
                                                                     <p class="mb-0 text-s11 textresize text-semibold" style="color: #747474;"><?php echo $row['location'];?></p>
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
 <div class="text-center">
                <style>
                .pagination {
					    display: inline-block;
    padding-left: 0;
    margin: 20px 0;
    border-radius: 4px;
				}
                .pagination li['class'] a {
    background-color: #f5821f;
    color: white;
}
.pagination li a.active {
    background-color: #f5821f;
    color: white;
}
.page_test{
	    display: inline-block;
    list-style: none;
}
.page_test li{
	    display: inline-block;
	   
    float: left;
    margin: 0px;
    padding: 0px;
    margin-left: 5px;
}

.page_test li.active{
	     border: 1px solid orange;
    background-color: orange;
    color: white;
    border-radius: 6px;
}
.pagination>li:first-child>a, .pagination>li:first-child>span {
    margin-left: 0;
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
}
.page_test li a {
    font-size: 17px;
    color: #000;
    /* border-color: #8DC5E6; */
    /* background: #F8FCFF; */
}
.page_test li a {
    color: black;
    display: inline;
    text-decoration: none;
    padding: 2px 10px 2px 10px;
}
                </style>
                    <div class="">
                        <div id="pagination">
                           
                                <?php echo $this->ajax_pagination->create_links(); ?>
                           
                        </div>
                    </div>
                </div>

                            </div>




      
          
            <script>
                function product_detail(trader_id,product_id)
                {
                   
                   // location.href='watchlist_detail/'+trader_id;
                   
                    location.href='<?php echo base_url()?>admin/watchlist_detail/'+trader_id+'/'+product_id;
                }
            </script>
        
       