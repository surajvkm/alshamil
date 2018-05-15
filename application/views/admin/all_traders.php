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
                <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/custom/plans.css">      
             <div class="col-main">
                        <div class="col-lg-12 col-12">
                            <div class="col-12 px-0">
                                <div class="col-lg-10 col-12 mx-lg-auto pt-4 px-md-3 px-0">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-4 col-sm-3 col-3 pt-sm-0 pt-md-0 pt-2">
                                            <p class="text-bold text-orange text-s20 mb-0 tradertext">TRADERS</p>
                                        </div>
                                        <div class="col-lg-8 col-md-5 col-sm-6 col-6 px-0">
                                            <hr>
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-3 pl-0 text-md-center text-sm-left pr-0 pr-sm-0 pr-md-3">
                                            <p class="text-black text-s14 text-bold mb-0 mt-2">(<?php echo $count?> Traders)</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-12 mx-lg-auto">
                                    <div class="row">
                                       <?php 
                
                                            foreach($records as $r)
                                            {
                                            	
                                            	
                                        ?>
                                        
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-12 pt-3 mb-4">
                                        <a href='<?php echo ($r->planStatus==1)? base_url('admin/plan_profile/').$r->traderId.'/'.$r->planId:base_url('admin/newregisters'); ?>'>
                                            <div class="row">
                                                <div class="col-lg-9 col-md-9 col-9 mx-auto px-0 bg-gray">
                                                    <div class="row">
                                                        <div class="card card-border bg-gray p-2">
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-4 col-3 pr-0">
                                                                 <?php 
                                                                 if($r->image != '')
                                                                    {
                                                                        ?>
                                                                        <img class="userImageT" src="<?php echo $r->image ?>" alt="image not found">
                                                                    <?php
                                                                    }
                                                                    else
                                                                    {
                                                                        ?>
                                                                        <img src="<?php echo base_url()?>img/userProfileIcon_gray.png" class="userImageT" alt='image not found'>
                                                                    <?php    
                                                                    }
                                                                    ?>
                                                                
                                                                </div>
                                                                <div class="col-lg-9 col-md-8 col-9 pt-2 pr-0 ">
                                                                    <p class="mb-0 text-s14 text-orange text-semibold text-resize"><?php echo $r->fullName?></p>
                                                                    <p class="mb-0 text-s14 text-black text-semibold text-resize"><?php echo $r->location?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        </div>
                                       
                            <?php }?>

                                    </div>
                                </div>
                            </div>
                            <!-- ------------------------- BODY ends ------------------------- -->
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
        location.href='<?php echo base_url()?>admin/Dashboard/watchlist_detail/'+trader_id+'/'+product_id;
    }
</script>
        
       