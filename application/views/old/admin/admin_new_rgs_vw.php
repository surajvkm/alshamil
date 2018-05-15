<?php
$this->view('admin/admin_header'); 
?>
 
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">

                <?php
                $this->view('admin/admin_sidebar'); 
                ?>
                <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/custom/new-register.css">      
   
                <div class="col-main">
                        <div class="col-12">
                            <!-- -------- Title -------- -->
                            <h4 class="page-title mt-4 mb-2 pb-2 pt-2">New Registers</h4>

                            <div class="row">
                                <div class="col-12 px-md-3 px-sm-3 px-1">

                                    <!-- ------------------ Tabs & Body ------------------------ -->
                                    <div class="col-12 px-lg-3 px-0">


                                        <!-- ------------------ Tabs ------------------------ -->
                                        <ul class="nav nav-tabs justify-content-center" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link newRegTabs active" id="yearly-tab" data-toggle="tab" href="#yearly" role="tab" aria-controls="yearly"
                                                    aria-selected="true">Yearly
                                                    <span class="text-semibold"><?php echo $yrl_cnt=count($yearly_qry); ?></span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link newRegTabs" id="monthly-tab" data-toggle="tab" href="#monthly" role="tab" aria-controls="monthly" aria-selected="false">Monthly
                                                    <span class="text-semibold"><?php echo $mnth_cnt=count($monthly_qry); ?></span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link newRegTabs" id="yearlyLimited-tab" data-toggle="tab" href="#yearlyLimited" role="tab" aria-controls="yearlyLimited"
                                                    aria-selected="false">Yearly Limited
                                                    <span class="text-semibold"><?php echo $yrllim_cnt=count($yearly_limqry); ?></span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link newRegTabs" id="individuals1-tab" data-toggle="tab" href="#individuals1" role="tab" aria-controls="individuals1"
                                                    aria-selected="false">Individuals
                                                    <span class="text-semibold"><?php echo $ind_cnt=count($indiv_qry); ?></span>
                                                </a>
                                            </li>
   
                                        </ul>
                                       
                                        <!-- ------------------ Body ------------------ -->
                                        <div class="tab-content mb-lg-5">

                                            <!-- ------------------ Table : Yearly ------------------------ -->
                                            <div class="tab-pane fade show active" id="yearly" role="tabpanel" aria-labelledby="yearly-tab">
                                               <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-12 pr-0 pl-0">
                                                        <?php
                                                            if($yrl_cnt>0) {
                                                            foreach($yearly_qry as $row) {
                                                                
                                                            ?>

                  
                                                            <!-- ------ One Single Row of Data ------ -->
                                                            <div class="h-87 h-md-63 h-sm-106 bg-newReg p-2 overflow-hidden">
                                                                <div class="col-12 p-0">
                                                                    <div class="row h-77">

                                                                        <div class="col-sm-3 col-4 pr-0 pr-md-3 pl-sm-3 pl-md-3">
                                                                            <a href="<?php echo base_url().'admin/Dashboard/admin_edit_trader/'.$row->traderID ;?>">
                                                                                <div class="row">
                                                                                    <!-- User Image -->
                                                                                    <div class="col-4 text-right pt-lg-1 pr-lg-0 pl-md-2 pl-lg-3 pl-2">
                                                                                            <?php
                                                                                                if($row->traderImage != '')
                                                                                                {
                                                                                                    ?>
                                                                                                    <!-- <img src="<?php echo $row->traderImage?>" class="newUserImage"> -->

                                                                                                    <img src="<?php echo $row->traderImage?>" class="userImage">
                                                                                                    <?php
                                                                                                }
                                                                                                else
                                                                                                {
                                                                                                    ?>
                                                                                                    <img src="<?php echo base_url()?>img/userProfileIcon_gray.png" class="userImage">
                                                                                                    <?php    
                                                                                                }
                                                                                                ?>    
                                                                                    </div>

                                                                                    <!-- User Details -->
                                                                                    <div class="col-8 pl-lg-3 pl-sm-4 pr-lg-2 mt-lg-3 mb-lg-3 vbr pl-md-3 pr-md-0 pr-lg-3">
                                                                                        <p class="mb-0 text-s12 pl-2 pl-md-0 pl-sm-0" style="color: #696969;">Name</p>
                                                                                        <p class="mb-0 text-s13 text-semibold text-resize pl-2 text-resize pl-md-0 pl-sm-0 text-user" style="color: #282828;"><?php echo $row->traderFullName?></p>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                        </div>

                                                                        <!-- Place -->
                                                                        <div class="col-sm-2 col-3 pl-lg-3 pr-lg-2 pl-sm-1 px-md-2 mt-lg-3 mb-lg-4 vbr">
                                                                            <p class="mb-0 text-s12 pl-md-0 pl-sm-3 pl-2" style="color: #696969;">Place</p>
                                                                            <p class="mb-0 text-s13 pl-md-0 pl-sm-3 pl-2 text-semibold text-resize" style="color: #282828;"<?php echo $row->traderLocation?></p>
                                                                        </div>

                                                                        <!-- Email -->
                                                                        <div class="col-sm-3 col-5 pl-lg-3 pr-lg-2 mt-lg-3 mb-lg-4 vbr pl-md-1 px-sm-1 pl-2">
                                                                            <p class="mb-0 text-s12" style="color: #696969;">Email</p>
                                                                            <p class="mb-0 text-s13 text-semibold text-email text-resize" style="color: #282828;"><?php echo $row->traderEmailID?></p>
                                                                        </div>

                                                                        <!-- Mobile -->
                                                                        <div class="col-sm-2 col-7 pl-lg-3 pr-lg-2 mt-lg-3 mb-lg-4 vbr pr-md-0 pl-md-2 pl-lg-3 pl-sm-1 pt-2 pt-sm-0 pt-md-0">
                                                                            <p class="mb-0 text-s12 pl-5 pl-sm-0 pl-md-0" style="color: #696969;">Mobile</p>
                                                                            <p class="mb-0 text-s13 pl-5 pl-sm-0 pl-md-0 text-semibold text-resize" style="color: #282828;"><?php echo $row->traderContactNum?></p>
                                                                        </div>

                                                                        <!-- View Button -->
                                                                        <div class="col-sm-2 col-5 text-center mt-lg-3 mt-2 mb-lg-3 pl-0">
                                                                            <button class="btn btn-orange text-s14 w-75 pt-1 pb-1" onclick="show_newuser_modal('<?php echo $row->traderID?>')">View</button>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                </div>
                                                                <?php    
                                                                        }
                                                                        }
                                                                        else
                                                                        {
                                                                            ?>
                                                                            <div class="alert">No Data Found</div> 
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                                                                    <!-- -------------------- Modal starts here --------------------- -->
                                                            
                                                                <!-- -------------------- Modal ends here --------------------- -->

                                                         

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- ------------------ Table : Monthly ------------------------ -->
                                            <div class="tab-pane fade" id="monthly" role="tabpanel" aria-labelledby="monthly-tab">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-12 pr-0 pl-0">
                                                        <?php
                                                         
                                                       
                                                            if($mnth_cnt>0) {
                                                            foreach($monthly_qry as $row) {
                                                             
                                                            ?>

                  
                                                            <!-- ------ One Single Row of Data ------ -->
                                                            <div class="h-87 h-md-63 h-sm-106 bg-newReg p-2 overflow-hidden">
                                                                <div class="col-12 p-0">
                                                                    <div class="row h-77">

                                                                        <div class="col-sm-3 col-4 pr-0 pr-md-3 pl-sm-3 pl-md-3">
                                                                            <a href="<?php echo base_url().'admin/Dashboard/admin_edit_trader/'.$row->traderID ;?>">
                                                                                <div class="row">
                                                                                    <!-- User Image -->
                                                                                    <div class="col-4 text-right pt-lg-1 pr-lg-0 pl-md-2 pl-lg-3 pl-2">
                                                                                            <?php
                                                                                                if($row->traderImage != '')
                                                                                                {
                                                                                                    ?>
                                                                                                    <!-- <img src="<?php echo $row->traderImage?>" class="newUserImage"> -->

                                                                                                    <img src="<?php echo $row->traderImage?>" class="userImage">
                                                                                                    <?php
                                                                                                }
                                                                                                else
                                                                                                {
                                                                                                    ?>
                                                                                                    <img src="<?php echo base_url()?>img/userProfileIcon_gray.png" class="userImage">
                                                                                                    <?php    
                                                                                                }
                                                                                                ?>    
                                                                                    </div>

                                                                                    <!-- User Details -->
                                                                                    <div class="col-8 pl-lg-3 pl-sm-4 pr-lg-2 mt-lg-3 mb-lg-3 vbr pl-md-3 pr-md-0 pr-lg-3">
                                                                                        <p class="mb-0 text-s12 pl-2 pl-md-0 pl-sm-0" style="color: #696969;">Name</p>
                                                                                        <p class="mb-0 text-s13 text-semibold text-resize pl-2 text-resize pl-md-0 pl-sm-0 text-user" style="color: #282828;"><?php echo $row->traderFullName?></p>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                        </div>

                                                                        <!-- Place -->
                                                                        <div class="col-sm-2 col-3 pl-lg-3 pr-lg-2 pl-sm-1 px-md-2 mt-lg-3 mb-lg-4 vbr">
                                                                            <p class="mb-0 text-s12 pl-md-0 pl-sm-3 pl-2" style="color: #696969;">Place</p>
                                                                            <p class="mb-0 text-s13 pl-md-0 pl-sm-3 pl-2 text-semibold text-resize" style="color: #282828;"<?php echo $row->traderLocation?></p>
                                                                        </div>

                                                                        <!-- Email -->
                                                                        <div class="col-sm-3 col-5 pl-lg-3 pr-lg-2 mt-lg-3 mb-lg-4 vbr pl-md-1 px-sm-1 pl-2">
                                                                            <p class="mb-0 text-s12" style="color: #696969;">Email</p>
                                                                            <p class="mb-0 text-s13 text-semibold text-email text-resize" style="color: #282828;"><?php echo $row->traderEmailID?></p>
                                                                        </div>

                                                                        <!-- Mobile -->
                                                                        <div class="col-sm-2 col-7 pl-lg-3 pr-lg-2 mt-lg-3 mb-lg-4 vbr pr-md-0 pl-md-2 pl-lg-3 pl-sm-1 pt-2 pt-sm-0 pt-md-0">
                                                                            <p class="mb-0 text-s12 pl-5 pl-sm-0 pl-md-0" style="color: #696969;">Mobile</p>
                                                                            <p class="mb-0 text-s13 pl-5 pl-sm-0 pl-md-0 text-semibold text-resize" style="color: #282828;"><?php echo $row->traderContactNum?></p>
                                                                        </div>

                                                                        <!-- View Button -->
                                                                        <div class="col-sm-2 col-5 text-center mt-lg-3 mt-2 mb-lg-3 pl-0">
                                                                            <button class="btn btn-orange text-s14 w-75 pt-1 pb-1" onclick="show_newuser_modal('<?php echo $row->traderID?>')">View</button>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                </div>
                                                                <?php    
                                                                        }
                                                                        }
                                                                        else
                                                                        {
                                                                            ?>
                                                                            <div class="alert">No Data Found</div> 
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                                                                    <!-- -------------------- Modal starts here --------------------- -->
                                                            
                                                                <!-- -------------------- Modal ends here --------------------- -->

                                                          

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- ------------------ Table : Yearly Limited ------------------------ -->
                                            <div class="tab-pane fade" id="yearlyLimited" role="tabpanel" aria-labelledby="yearlyLimited-tab">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-lg-12 pr-0 pl-0">

                                                        <?php
                                                          
                                                        
                                                            if($yrllim_cnt>0) {
                                                            foreach($yearly_limqry as $row) {
                                                            ?>

                  
                                                            <!-- ------ One Single Row of Data ------ -->
                                                            <div class="h-87 h-md-63 h-sm-106 bg-newReg p-2 overflow-hidden">
                                                                <div class="col-12 p-0">
                                                                    <div class="row h-77">

                                                                        <div class="col-sm-3 col-4 pr-0 pr-md-3 pl-sm-3 pl-md-3">
                                                                            <a href="<?php echo base_url().'admin/Dashboard/admin_edit_trader/'.$row->traderID ;?>">
                                                                                <div class="row">
                                                                                    <!-- User Image -->
                                                                                    <div class="col-4 text-right pt-lg-1 pr-lg-0 pl-md-2 pl-lg-3 pl-2">
                                                                                            <?php
                                                                                                if($row->traderImage != '')
                                                                                                {
                                                                                                    ?>
                                                                                                    <!-- <img src="<?php echo $row->traderImage?>" class="newUserImage"> -->

                                                                                                    <img src="<?php echo $row->traderImage?>" class="userImage">
                                                                                                    <?php
                                                                                                }
                                                                                                else
                                                                                                {
                                                                                                    ?>
                                                                                                    <img src="<?php echo base_url()?>img/userProfileIcon_gray.png" class="userImage">
                                                                                                    <?php    
                                                                                                }
                                                                                                ?>    
                                                                                    </div>

                                                                                    <!-- User Details -->
                                                                                    <div class="col-8 pl-lg-3 pl-sm-4 pr-lg-2 mt-lg-3 mb-lg-3 vbr pl-md-3 pr-md-0 pr-lg-3">
                                                                                        <p class="mb-0 text-s12 pl-2 pl-md-0 pl-sm-0" style="color: #696969;">Name</p>
                                                                                        <p class="mb-0 text-s13 text-semibold text-resize pl-2 text-resize pl-md-0 pl-sm-0 text-user" style="color: #282828;"><?php echo $row->traderFullName?></p>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                        </div>

                                                                        <!-- Place -->
                                                                        <div class="col-sm-2 col-3 pl-lg-3 pr-lg-2 pl-sm-1 px-md-2 mt-lg-3 mb-lg-4 vbr">
                                                                            <p class="mb-0 text-s12 pl-md-0 pl-sm-3 pl-2" style="color: #696969;">Place</p>
                                                                            <p class="mb-0 text-s13 pl-md-0 pl-sm-3 pl-2 text-semibold text-resize" style="color: #282828;"<?php echo $row->traderLocation?></p>
                                                                        </div>

                                                                        <!-- Email -->
                                                                        <div class="col-sm-3 col-5 pl-lg-3 pr-lg-2 mt-lg-3 mb-lg-4 vbr pl-md-1 px-sm-1 pl-2">
                                                                            <p class="mb-0 text-s12" style="color: #696969;">Email</p>
                                                                            <p class="mb-0 text-s13 text-semibold text-email text-resize" style="color: #282828;"><?php echo $row->traderEmailID?></p>
                                                                        </div>

                                                                        <!-- Mobile -->
                                                                        <div class="col-sm-2 col-7 pl-lg-3 pr-lg-2 mt-lg-3 mb-lg-4 vbr pr-md-0 pl-md-2 pl-lg-3 pl-sm-1 pt-2 pt-sm-0 pt-md-0">
                                                                            <p class="mb-0 text-s12 pl-5 pl-sm-0 pl-md-0" style="color: #696969;">Mobile</p>
                                                                            <p class="mb-0 text-s13 pl-5 pl-sm-0 pl-md-0 text-semibold text-resize" style="color: #282828;"><?php echo $row->traderContactNum?></p>
                                                                        </div>

                                                                        <!-- View Button -->
                                                                        <div class="col-sm-2 col-5 text-center mt-lg-3 mt-2 mb-lg-3 pl-0">
                                                                            <button class="btn btn-orange text-s14 w-75 pt-1 pb-1" onclick="show_newuser_modal('<?php echo $row->traderID?>')" >View</button>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                        </div>
                                                                <?php    
                                                                    }
                                                                    }
                                                                    else
                                                                    {
                                                                        ?>
                                                                        <div class="alert">No Data Found</div> 
                                                                        <?php
                                                                    }
                                                                    ?>

                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <!-- ------------------ Table : Individuals ------------------------ -->
                                            <div class="tab-pane fade" id="individuals1" role="tabpanel" aria-labelledby="individuals1-tab">
                                           
                                                <div class="col-lg-12">
                                                <div class="row">
                                                        <div class="col-lg-12 pr-0 pl-0">

                                                        <?php
                                                            if(  $ind_cnt>0) {
                                                            foreach($indiv_qry as $row) {
                                                            ?>

                  
                                                            <!-- ------ One Single Row of Data ------ -->
                                                            <div class="h-87 h-md-63 h-sm-106 bg-newReg p-2 overflow-hidden">
                                                                <div class="col-12 p-0">
                                                                    <div class="row h-77">

                                                                        <div class="col-sm-3 col-4 pr-0 pr-md-3 pl-sm-3 pl-md-3">
                                                                            <a href="<?php echo base_url().'admin/Dashboard/admin_edit_trader/'.$row->traderID ;?>">
                                                                                <div class="row">
                                                                                    <!-- User Image -->
                                                                                    <div class="col-4 text-right pt-lg-1 pr-lg-0 pl-md-2 pl-lg-3 pl-2">
                                                                                            <?php
                                                                                                if($row->traderImage != '')
                                                                                                {
                                                                                                    ?>
                                                                                                    <!-- <img src="<?php echo $row->traderImage?>" class="newUserImage"> -->

                                                                                                    <img src="<?php echo $row->traderImage?>" class="userImage">
                                                                                                    <?php
                                                                                                }
                                                                                                else
                                                                                                {
                                                                                                    ?>
                                                                                                    <img src="<?php echo base_url()?>img/userProfileIcon_gray.png" class="userImage">
                                                                                                    <?php    
                                                                                                }
                                                                                                ?>    
                                                                                    </div>

                                                                                    <!-- User Details -->
                                                                                    <div class="col-8 pl-lg-3 pl-sm-4 pr-lg-2 mt-lg-3 mb-lg-3 vbr pl-md-3 pr-md-0 pr-lg-3">
                                                                                        <p class="mb-0 text-s12 pl-2 pl-md-0 pl-sm-0" style="color: #696969;">Name</p>
                                                                                        <p class="mb-0 text-s13 text-semibold text-resize pl-2 text-resize pl-md-0 pl-sm-0 text-user" style="color: #282828;"><?php echo $row->traderFullName?></p>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                        </div>

                                                                        <!-- Place -->
                                                                        <div class="col-sm-2 col-3 pl-lg-3 pr-lg-2 pl-sm-1 px-md-2 mt-lg-3 mb-lg-4 vbr">
                                                                            <p class="mb-0 text-s12 pl-md-0 pl-sm-3 pl-2" style="color: #696969;">Place</p>
                                                                            <p class="mb-0 text-s13 pl-md-0 pl-sm-3 pl-2 text-semibold text-resize" style="color: #282828;"<?php echo $row->traderLocation?></p>
                                                                        </div>

                                                                        <!-- Email -->
                                                                        <div class="col-sm-3 col-5 pl-lg-3 pr-lg-2 mt-lg-3 mb-lg-4 vbr pl-md-1 px-sm-1 pl-2">
                                                                            <p class="mb-0 text-s12" style="color: #696969;">Email</p>
                                                                            <p class="mb-0 text-s13 text-semibold text-email text-resize" style="color: #282828;"><?php echo $row->traderEmailID?></p>
                                                                        </div>

                                                                        <!-- Mobile -->
                                                                        <div class="col-sm-2 col-7 pl-lg-3 pr-lg-2 mt-lg-3 mb-lg-4 vbr pr-md-0 pl-md-2 pl-lg-3 pl-sm-1 pt-2 pt-sm-0 pt-md-0">
                                                                            <p class="mb-0 text-s12 pl-5 pl-sm-0 pl-md-0" style="color: #696969;">Mobile</p>
                                                                            <p class="mb-0 text-s13 pl-5 pl-sm-0 pl-md-0 text-semibold text-resize" style="color: #282828;"><?php echo $row->traderContactNum?></p>
                                                                        </div>

                                                                        <!-- View Button -->
                                                                        <div class="col-sm-2 col-5 text-center mt-lg-3 mt-2 mb-lg-3 pl-0">
                                                                            <button class="btn btn-orange text-s14 w-75 pt-1 pb-1" onclick="show_newuser_modal('<?php echo $row->traderID?>')" >View</button>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                </div>
                                                                <?php    
                                                                    }
                                                                    }
                                                                    else
                                                                    {
                                                                        ?>
                                                                        <div class="alert">No Data Found</div> 
                                                                        <?php
                                                                    }
                                                                    ?>

                                                    
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                    
                                </div>
                            </div>
                            <!-- /row -->
                        </div>
                    </div>


        </div>  <!-- ---- B Main Div ends here ---- -->
    </div>
</div><!-- end row 1-->  
</div><!-- end row 1-->  
</div><!-- end row 1-->  



<div class="modal fade" id="newRegModal" tabindex="-1" role="dialog" aria-hidden="true">
                                                                    <div class="modal-dialog newRegModal" role="document">
                                                                        <div class="modal-content p-3" id='newreg_det_div'>
                                                                   
                                                                        </div>
                                                                    </div>
                                                                </div>





            
            
<?php
$this->view('admin/admin_footer'); 
?>


<script>
    function show_newuser_modal(trader_id) {    
        $("#loader").show();     
        $.ajax({
            url: "<?php echo base_url(); ?>admin/Dashboard/fetch_trader_details",
            data : {'trader_id':trader_id},
            type: "POST",

            success:function(data) {
                $("#loader").hide();
                //console.log(data);return false;
                $('#newreg_det_div').html(data);  
                $('#newRegModal').modal("show"); 
            }
        });            
    }
    
    $( "body" ).on( "click", ".approveButton", function() {
        trader_id = $(this).val();
        plan_id=$(this).data("plan");
       $this = $(this);
                
        $.ajax({
            url: "<?php echo base_url(); ?>admin/Dashboard/admin_approve_trader",
            data : {'trader_id':trader_id,'plan_id':plan_id},
            type: "POST",

            success:function(data) {
                if(data == 'success') {
                    swal('Trader Approved Successfully',"", "success"); 
                    $this.attr("disabled", "disabled");
                    // window.opener.location.reload();
                }
            }
        });
    });
   
    $( "body" ).on( "click", ".rejectButton", function() {
        trader_id = $(this).val();
        $this = $(this);

        $.ajax({
            url: "<?php echo base_url(); ?>admin/Dashboard/admin_reject_trader",
            data : {'trader_id':trader_id},
            type: "POST",

            success:function(data) {
                if(data == 'success') {
                    swal('Trader Rejected Successfully'); 
                    $this.attr("disabled", "disabled");
                   
                }
            }
        });
    });
    $( "body" ).on( "click", ".confirm", function() {
        location.href='<?php echo base_url()?>admin/Dashboard/new_registers';
    });

    function edit_trader(trader_id) {
        location.href='<?php echo base_url()?>admin/Dashboard/admin_edit_trader/'+trader_id;  
               /*  $.ajax({
                            url: "<?php echo base_url(); ?>admin/Dashboard/admin_edit_trader",
                            data : {'trader_id':trader_id},
                            type: "POST",

                            success:function(data){
                                
                                 if(data == 'success')
                                 {
                                    swal('Trader Rejected Successfully'); 
                                 }    
                              
                                   
                            }

                        });*/
    }
    
    function readprofURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#adnewreg_modal_img1').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


             
    $(document).ready(function() {
       
        
        $('#btn_newregedit').click(function(){
            location.href='<?php echo base_url()?>admin/Dashboard/admin_edit_trader';
        })
    });
    $('#newuserModal').on('show.bs.modal', function () {
       $(this).find('.modal-body').css({
              width:'auto', //probably not needed
              height:'auto', //probably not needed 
              'max-height':'100%'
       });
});
</script>