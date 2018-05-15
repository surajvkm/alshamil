
<!-- start section -->
<section class="section white-backgorund">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
               <!-- start sidebar -->
                <div class="col-sm-3">
                    <?php $this->load->view('trader/advancedSearch_vw'); ?>
                </div><!-- end col -->
                <!-- end sidebar -->
                           <div class="col-sm-9 temp-hide">
                    <div class="mytextdiv">
                        <div class="mytexttitle">
                            TRADERS
                        </div>
                        <div class="divider"></div>
                        <div class="catcount-div">(<b><?php echo $count ?></b> Traders)</div>
                    </div>

                </div>
                <div class="col-sm-9 px-0 temp-hide">
                    <?php
                    foreach ($records as $r) {
                        ?>
                        <a href="<?php echo base_url() ?>Trader/view_other_traders/<?php echo $r->traderID ?>">
                            <div class="col-sm-4">

                                <div class="all_tradet_details">
                                    <span class="spantrimg">
                                    <?php
                                    if ($r->traderImage != '' && (@getimagesize($r->traderImage))) {
                                        ?>
                                    
                                        <img src="<?php echo $r->traderImage ?>" class="alltr_user_prof">
                                        <?php
                                    } else {
                                        ?>
                                        <img src="<?php echo base_url() ?>img/userProfileIcon_gray.png" class="alltr_user_prof">
                                        <?php
                                    }
                                    ?>
                                    </span>  
                                    <span class="spantrname">
                                        <div class="alltr_uname"><?php echo $r->traderFullName ?></div>
                                        <div class="alltr_uplace"><?php echo $r->traderLocation ?></div>
                                    </span>
                                    

                                </div>
                            </div>
                        </a>
                        <?php
                    }
                    ?>

                </div>
                 <div class="col-sm-9" id="imgpost_div"></div> 
                <!-- Binds search results-->
                <div class="col-xs-12 col-sm-12 col-md-9 temp-hide vehhisdiv">
                    <div class="row">
                        <div id="pagination">
                            <ul class="tsc_pagination">
                                <?php
                                if ($count > 0) {
                                    if(isset($links)){
                                        foreach ($links as $link) {
                                            echo "<li>" . $link . "</li>";
                                        }
                                    }
                                  
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end row -->                
    </div><!-- end container -->
</section>

<?php $this->load->view('trader/recently_viewed_vw');?>   



