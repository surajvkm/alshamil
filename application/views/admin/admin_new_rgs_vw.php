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
                                        
                                        <?php if($plans->num_rows()>0) : 
                                        $first=1;
                                        foreach($plans->result() as $row): ?>
                                        
                                            <li class="nav-item">
                                                <a class="nav-link newRegTabs <?php if($first==1) echo 'active' ?>" id="<?php echo $row->planId ?>-tab" data-toggle="tab" href="#<?php echo $row->planId ?>" role="tab" aria-controls="<?php echo $row->planId ?>"
                                                    aria-selected="true"><?php echo $row->name ?>
                                                    <span class="text-semibold"></span>
                                                </a>
                                            </li>
                                         
                                        <?php $first++; endforeach; endif; ?>
                                        </ul>
                                       
                                        <!-- ------------------ Body ------------------ -->
                                        <div class="tab-content mb-lg-5">

                                          <?php 
                                          
                                          if($plans->num_rows()>0) : 
                                          
                                            $hfirst =1;
                                            foreach($plans->result() as $row2):
                                            $p_registers =      $this->adm->all_regs($row2->planId);
                                           
											   	
                                                 
                                           ?>
                                          
                                            <!-- ------------------ Table : Plans ------------------------ -->
                                            <div class="tab-pane   <?php if($hfirst==1) echo ' active show' ?> " id="<?php echo $row2->planId ?>" role="tabpanel" aria-labelledby="<?php echo $row2->planId ?>-tab">
                                               <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-12 pr-0 pl-0">
                                                        <?php
                                                            if($p_registers->num_rows()>0){
											   	                 
										                          foreach($p_registers->result() as $rs){
										                          	
										                          
                                                                
                                                            ?>

                  
                                                            <!-- ------ One Single Row of Data ------ -->
                                                            <div class="h-87 h-md-63 h-sm-106 bg-newReg p-2 overflow-hidden">
                                                                <div class="col-12 p-0">
                                                                    <div class="row h-77">

                                                                        <div class="col-sm-3 col-4 pr-0 pr-md-3 pl-sm-3 pl-md-3">
                                                                            <a href="<?php echo base_url().'admin/Dashboard/admin_edit_trader/'.$rs->traderId ;?>">
                                                                                <div class="row">
                                                                                    <!-- User Image -->
                                                                                    <div class="col-4 text-right pt-lg-1 pr-lg-0 pl-md-2 pl-lg-3 pl-2">
                                                                                            <?php
                                                                                                if($rs->image != '')
                                                                                                {
                                                                                                    ?>
                                                                                                

                                                                                                    <img src="<?php echo $rs->image?>" class="userImage">
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
                                                                                        <p class="mb-0 text-s13 text-semibold text-resize pl-2 text-resize pl-md-0 pl-sm-0 text-user" style="color: #282828;"><?php echo $rs->fullName?></p>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                        </div>

                                                                        <!-- Place -->
                                                                        <div class="col-sm-2 col-3 pl-lg-3 pr-lg-2 pl-sm-1 px-md-2 mt-lg-3 mb-lg-4 vbr">
                                                                            <p class="mb-0 text-s12 pl-md-0 pl-sm-3 pl-2" style="color: #696969;">Place</p>
<p class="mb-0 text-s13 pl-md-0 pl-sm-3 pl-2 text-semibold text-resize" style="color: #282828;"><?php echo $rs->location ?></p>
                                                                        </div>

                                                                        <!-- Email -->
                                                                        <div class="col-sm-3 col-5 pl-lg-3 pr-lg-2 mt-lg-3 mb-lg-4 vbr pl-md-1 px-sm-1 pl-2">
                                                                            <p class="mb-0 text-s12" style="color: #696969;">Email</p>
                                                                            <p class="mb-0 text-s13 text-semibold text-email text-resize" style="color: #282828;"><?php echo $rs->email ?></p>
                                                                        </div>

                                                                        <!-- Mobile -->
                                                                        <div class="col-sm-2 col-7 pl-lg-3 pr-lg-2 mt-lg-3 mb-lg-4 vbr pr-md-0 pl-md-2 pl-lg-3 pl-sm-1 pt-2 pt-sm-0 pt-md-0">
                                                                            <p class="mb-0 text-s12 pl-5 pl-sm-0 pl-md-0" style="color: #696969;">Mobile</p>
                                                                            <p class="mb-0 text-s13 pl-5 pl-sm-0 pl-md-0 text-semibold text-resize" style="color: #282828;"><?php echo $rs->contactNumber?></p>
                                                                        </div>

                                                                        <!-- View Button -->
                                                                        <div class="col-sm-2 col-5 text-center mt-lg-3 mt-2 mb-lg-3 pl-0">
                                                                            <button class="btn btn-orange text-s14 w-75 pt-1 pb-1" onclick="show_trader_view_modal('<?php echo $rs->traderId?>')">View</button>
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

                                           <?php  $hfirst++;  endforeach; endif; ?>
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



<div class="modal fade" id="newTraderview" tabindex="-1" role="dialog" aria-hidden="true">
                                                                    <div class="modal-dialog newRegModal" role="document">
                                                                        <div class="modal-content p-3" id='newreg_det_div'>
                                                                   
                                                                        </div>
                                                                    </div>
                                                                </div>





            
            
<?php
$this->view('admin/admin_footer'); 
?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/app/adminapp.js"></script>  