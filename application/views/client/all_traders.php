<!-- start section -->
<section class="section white-backgorund">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
               <!-- start sidebar -->
                <div class="col-sm-3">
                  <?php $this->load->view('client/advancedSearch');?>   
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
                        <a href="<?php echo base_url() ?>traderinfo/<?php echo $r->traderId ?>">
                            <div class="col-sm-4">

                                <div class="all_tradet_details">
                                    <span class="spantrimg">
                                    <?php
                                    if ($r->image != '' && (@getimagesize($r->image))) {
                                        ?>
                                    
                                        <img src="<?php echo $r->image ?>" class="alltr_user_prof">
                                        <?php
                                    } else {
                                        ?>
                                        <img src="<?php echo base_url() ?>img/userProfileIcon_gray.png" class="alltr_user_prof">
                                        <?php
                                    }
                                    ?>
                                    </span>  
                                    <span class="spantrname">
                                        <div class="alltr_uname"><?php echo $r->fullName ?></div>
                                        <div class="alltr_uplace"><?php echo $r->location ?></div>
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





