<?php
$this->view('admin/admin_header'); 
?>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/datepicker/css/datepicker.css">   
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
                <div class="col-lg-9 col-md-8 col-12 px-1 px-md-3">
                    <div class="col-12 px-md-3 px-sm-3 px-0">
                    <h4 class="page-title mt-4 mb-2 pb-2 pt-2">USER DETAILS</h4>
                    <div class="row">
                                <div class="col-12 px-md-2 px-lg-3">

                                    <!-- ------------------ Profile Card ------------------------ -->
                                    <div class="bg-profile p-2 ml-1 mr-1 mb-2 overflow-hidden">

                                        <!-- --------------- Main Row --------------- -->
                                        <div class="col-12">
                                            <div class="row">

                                                <!-- ------ Profile details ------ -->
                                                <div class="col-sm-3 col-12 px-1 px-md-3">
                                                    <div class="row">

                                                        <!-- Profile image -->
                                                        <div class="col-12 text-center pt-3 pl-md-3 pl-0 pr-md-3 pr-0">
                                                            <img class="profileImage" src="<?php echo $result->traderImage?>" alt="">
                                                        </div>

                                                        <div class="col-12 text-center px-lg-3 pt-2 pl-0 pr-0">
                                                            <!-- Name -->
                                                            <p class="mb-2 text-orange text-s15 text-semibold"><?php echo ucfirst($result-> traderFullName); ?></p>
                                                            <?php 
                                                          
                                                           if($result->tplanID==3||$result->tplanID==4){
                                                              // echo $result->traderPostCount;
                                                              // echo count($posts);
                                                            $result->totalposted=$result->traderPostCount;
                                                            $datediff=$result->planPostCount-$result->totalposted;
                                                            $days_left = ($datediff>0) ? $datediff."posts Left" : "Subscription Expired";
                                                           }else{
                                                            $now = time(); // or your date as well
                                                            $till_date = strtotime($result->planValidity);
                                                            $datediff = floor(($till_date -$now)/(60 * 60 * 24));
                                                            $days_left = ($datediff>0) ? $datediff."Days Left" : "Subscription Expired";
                                                           }
                                                               
                                                            ?>
                                                            <!-- Days Left -->
                                                            <p class="mb-2 text-s15 text-resize"><?php echo $days_left;?>
                                                                <a class="text-orange text-resize text-semibold"  onclick="edit_userplan(<?php echo $result->traderID ?>)" >
                                                                    <!-- Link -->
                                                                    <i> Edit Plan</i>
                                                                </a>

                                                             
                                                            </p>
                                                        </div>

                                                        <!-- Social Icons -->
                                                        <div class="col-12 pt-lg-3 pl-md-2 pl-lg-3 pl-sm-2 ">
                                                            <div class="row">
                                                                <div class="col-lg-2 col-md-1 col-2 text-center ml-lg-2 p-lg-0 pl-md-1 pl-sm-3 pr-md-1 pl-4 pr-md-2 pr-4">
                                                                    <a <?php if($result->socialWeb!='') echo "href='http://".$result->socialWeb."' target='_blank'" ?> >
                                                                    <img class="social-icon" src="<?php echo  base_url();?>/assets/icons/social-web.png" alt="">
                                                                    </a>
                                                                </div>

                                                                <div class="col-lg-2 col-md-1 col-2 text-center ml-lg-1 pl-sm-2 pl-md-3 p-lg-0 pr-md-10 pl-4 pr-md-2 pr-0">
                                                                <a <?php if($result->socialtwitter!='') echo "href='http://".$result->socialtwitter."' target='_blank'" ?> >
                                                                <img class="social-icon" src="<?php echo  base_url();?>assets/icons/social-twitter.png" alt="">
                                                                    </a>    
                                                                </div>
                                                                <div class="col-lg-2 col-md-1 col-2 text-center ml-lg-1 pl-sm-2 pl-md-3 p-lg-0 pr-md-10 pl-4 pr-md-2 pr-0">
                                                                <a <?php if($result->socialFb!='') echo "href='http://".$result->socialFb."' target='_blank'" ?> >
                                                                <img class="social-icon" src="<?php echo  base_url();?>/assets/icons/social-facebook.png" alt="">
                                                                    </a>    
                                                                </div>
                                                                <div class="col-lg-2 col-md-1 col-2 text-center ml-lg-1 pl-sm-2 pl-md-3 p-lg-0 pr-md-10 pl-4 pr-md-2 pr-0">
                                                                <a <?php if($result->socialInsta!='') echo "href='http://".$result->socialInsta."' target='_blank'" ?>>
                                                                <img class="social-icon" src="<?php echo  base_url();?>/assets/icons/social-instagram.png" alt="">
                                                                    </a>   
                                                                </div>
                                                                <div class="col-lg-2 col-md-1 col-2 text-center ml-lg-1 pl-sm-2 pl-md-3 p-lg-0 pr-md-10 pl-4 pr-md-2 pr-0">
                                                                <a <?php if($result->socialSnap!='') echo "href='http://".$result->socialSnap."' target='_blank'" ?>>
                                                                <img class="social-icon" src="<?php echo  base_url();?>assets/icons/social-snapchat.png" alt="">
                                                                    </a>    
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Buttons -->
                                                        <div class="col-12 pt-lg-3 pt-md-2 mb-lg-2 px-lg-3 pl-md-2 mb-3 pr-1 pr-md-2 ml-sm-0 ml-md-0">
                                                            <div class="row">
                                                                <!-- Edit -->
                                                                <div class="col-6 pr-0 pl-md-2 pl-lg-3">

                                                                <a href="<?php echo base_url().'admin/Dashboard/admin_edit_trader/'.$result->traderID ;?>">
                                                                    <button class="btn btn-orange text-resize pt-1 pb-1 w-90 text-s14">
                                                                        Edit
                                                                    </button>
                                                                </a>
                                                                </div>
                                                                <!-- Freeze -->
                                                                <div class="col-6 pl-0 pr-md-2 pr-lg-3">
                                                                <button class="btn btn-red text-resize pt-1 pb-1 pl-md-2 w-90 text-s14 freeze_btn" id="btn_yrly_freeze" <?php if($result->isActive==-1)echo "disabled"; ?> value="<?php echo $result->traderID?>">Freeze</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- ------ Forms ------ -->
                                                <div class="col-sm-6 col-md-6 col-12">
                                                    <div class="row">
                                                        <div class="col-12 bg-profileForm mt-lg-1 pt-md-2 pb-lg-2 pb-md-4 pt-sm-3 pb-sm-4 pt-3 pb-4">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class="row">

                                                                        <!-- Place -->
                                                                        <div class="col-12">
                                                                            <p class="mb-0 text-s13 text-resize text-readjust " style="color: #696969;">Place</p>
                                                                            <p class="mb-0 text-s13 text-resize text-semibold text-readjust " style="color: #282828;"><?php echo $result->traderLocation; ?></p>
                                                                            <hr class="mt-2 mb-1">
                                                                        </div>

                                                                        <!-- Email -->
                                                                        <div class="col-12 pt-lg-2">
                                                                            <p class="mb-0 text-s13 text-resize text-readjust " style="color: #696969;">Email</p>
                                                                            <p class="mb-0 text-s13 text-email text-semibold text-adjust" style="color: #282828;"><?php echo $result->traderEmailID; ?></p>
                                                                            <hr class="mt-2 mb-1">
                                                                        </div>

                                                                        <!-- Mobile -->
                                                                        <div class="col-12 pt-lg-2">
                                                                            <p class="mb-0 text-s13 text-resize text-readjust " style="color: #696969;">Mobile</p>
                                                                            <p class="mb-0 text-s13 text-resize text-semibold text-readjust " style="color: #282828;"><?php echo $result->traderContactNum; ?></p>
                                                                            <hr class="mt-2 mb-1">
                                                                        </div>

                                                                        <!-- About -->
                                                                        <div class="col-12 pt-lg-2 pb-lg-2">
                                                                            <p class="mb-0 text-s13 text-resize" style="color: #696969;">About</p>
                                                                            <p class="mb-0 text-s13 text-about text-semibold text-truncate-4" style="color: #282828;"><?php echo $result->traderInfo; ?>
                                                                        </p>
    
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Attachments -->
                                                                <div class="col-6 vbl border-height mt-lg-3 mb-2 pl-lg-4 pr-lg-4 px-1 px-md-3">
                                                                    <div class="row">
                                                                        <div class="col-12 px-lg-4 pb-lg-1">
                                                                            <p class="mb-1 text-s13 text-readjust text-resize" style="color: #696969;">Attachments</p>
                                                                        </div>

                                                                        <!-- First -->
                                                                        <div class="col-12 px-lg-4 pb-lg-3">
                                                                        <a download="attachment1.jpg" href="<?php if(isset($result->traderIDProof))echo $result->traderIDProof?>" title="ImageName">
                                                                            <img class="profile-attachments1" style="width:100%;" src="<?php if(isset($result->traderIDProof))echo $result->traderIDProof?>" alt=''>
                                                                        </a>
                                                                        </div>

                                                                        <!-- Second -->
                                                                        <div class="col-12 pl-lg-4 pr-lg-4 pt-lg-0 pt-2">
                                                                        <a download="attachment2.jpg" href="<?php if(isset($result->traderIDProofsecond))echo $result->traderIDProofsecond?>" title="ImageName">
                                                                        <img class="profile-attachments" style="width:100%;" src="<?php if(isset($result->traderIDProofsecond))echo $result->traderIDProofsecond?>" alt=''>
                                                                        </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- ------ Buttons ------ -->
                                                <div class="col-md-3 col-sm-3 col-12 pl-lg-4 pr-lg-4 pb-lg-2 px-md-2 pl-sm-2">
                                                    <div class="row">

                                                        <!-- Total Amount Paid -->
                                                        <div class="col-12 mt-3 pr-md-2 pr-lg-3">
                                                            <div class="card-yellowForm">
                                                                <p class="mb-0 text-s13 card-para" style="color: #696969;">Total Amount Paid</p>
                                                                <p class="mb-0 text-s16 text-semibold text-adjust" style="color: #282828;">
                                                                AED <?php if($total_sell_amount>0 && !empty($total_sell_amount) && isset($total_sell_amount))echo $total_sell_amount;else echo 0; ?>

                                                                </p>
                                                            </div>
                                                        </div>

                                                        <!-- Total Post -->
                                                        <div class="col-12 mt-2 pr-md-2 pr-lg-3">
                                                            <div class="card-yellowForm">
                                                                <p class="mb-0 text-s13" style="color: #696969;">Total Post</p>
                                                                <p class="mb-0 text-s16 text-semibold text-adjust" style="color: #282828;"><?php echo $result->traderPostCount; ?></p>
                                                            </div>
                                                        </div>

                                                        <!-- Sold -->
                                                        <div class="col-12 mt-2 pr-md-2 pr-lg-3">
                                                            <div class="card-yellowForm">
                                                                <p class="mb-0 text-s13" style="color: #696969;">Sold</p>
                                                                <p class="mb-0 text-s16 text-semibold text-adjust" style="color: #282828;"><?php echo $total_sold; ?></p>
                                                            </div>
                                                        </div>

                                                        <!-- Wished Items -->
                                                        <div class="col-12 mt-2 pr-md-2 pr-lg-3">
                                                            <div class="card-greenForm">
                                                                <p class="mb-0 text-s13" style="color: #FFF;">Wished Items</p>
                                                                <p class="mb-0 text-s16 text-semibold text-adjust" style="color: #FFF;"><?php echo $totalWatchlist; ?></p>
                                                            </div>
                                                        </div>

                                                        <!-- Cart -->
                                                        <div class="col-12 mt-2 pr-md-2 pr-lg-3">
                                                            <div class="card-orangeForm">
                                                                <p class="mb-0 text-s13" style="color: #FFF;">Cart</p>
                                                                <p class="mb-0 text-s16 text-semibold text-adjust" style="color: #FFF;"><?php echo $total_cart; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <hr class="mt-3 mb-3 ml-3 mr-3">

                                        <!-- --------------- Message Row --------------- -->
                                        <div class="col-lg-12 pb-lg-2 px-md-3 px-0">
                                            <div class="row">
                                                <div class="col-md-7 col-sm-6 col-5 pr-0">
                                                    <div class="form-group w-100">
                                                        <input type="text" id="notification_txt"  class="form-control pt-lg-2 pb-lg-2 text-s15 w-100 text-adjust" placeholder="Type a message">
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-sm-3 col-3 pr-0 pl-lg-3 pl-md-2 pl-1">
        
                                                    <button class="btn btn-orange text-s15 send-text text-adjust w-100 btn-width pt-lg-2 pb-lg-2 py-md-2 px-md-1 py-2 px-0 border-grey send_btn" value="<?php echo $result->traderID; ?>" >
                                                    Send message
                                                    </button>
                                                </div>

                                                <div class="col-sm-3 col-md-3 col-4 pl-lg-5 pr-lg-4 paddingleft-30 pl-sm-2 pl-3 pr-0 py-0">
                                                    <button class="btn btn-notification collapsed send-text text-s13 text-adjust w-100 btn-width px-md-2 px-0 text-normal py-sm-1 py-md-0 py-lg-2 py-0"
                                                        data-toggle="collapse" data-target="#notifications" aria-expanded="false"
                                                        aria-controls="notifications">
                                                        Notification
                                                        <span class="text-s15 text-adjust text-semibold ml-lg-1"><?php echo count($notifications["result"]) ?></span>
                                                        <i class="fa fa-angle-up notification-icon" style="margin-left: 10px; font-size: 19px;"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- --------------- Notification Row --------------- -->
                                        <div class="col-12 pt-lg-3 collapse" id="notifications">
                                            <div class="row">
                                            <?php  foreach($notifications["result"] as $notifics){
                                                                $d =$notifics->date ;
                                                                $d1 = strtotime($d);  
                                                ?>
                                         
                                               
                                                <!-- Single Notification Card -->
                                                <div class="col-12 pr-4 mb-lg-2">
                                                    <div class="card card-notifications pt-lg-3 pb-lg-3">
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <!-- Date -->
                                                                <div class="col-2">
                                                                    <p class="mb-0 text-s14 mt-lg-2" style="line-height: 1.5; color: #757779;"><?=  date('d M Y',$d1)?></p>
                                                                </div>

                                                                <!-- Details -->
                                                                <div class="col-10">
                                                                    <p class="mb-0 text-truncate-2 text-s14" style="line-height: 1.5; color: #757779;">
                                                                    <?= $notifics->description   ?> 
                                                                </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php  }     ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.Profile Card -->

                                    <!-- ------------------ Tabs & Table ------------------------ -->
                                    <div class="col-12 mt-lg-5 px-md-3 px-0">


                                        <!-- ------------------ Tabs ------------------------ -->
                                        <ul class="nav nav-tabs justify-content-center" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link green active" id="approved-tab" data-toggle="tab" href="#approved" role="tab" aria-controls="approved"
                                                    aria-selected="true">Approved  <?= $apprvd;?></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link orange" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="false">Pending <?= $pending;?></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link red" id="rejected-tab" data-toggle="tab" href="#rejected" role="tab" aria-controls="rejected" aria-selected="false">Rejected <?= $reject;?></a>
                                            </li>
                                        </ul>

                                        <div class="tab-content mb-lg-5">

                                            <!-- ------------------ Table : Approved ------------------------ -->
                                            <div class="tab-pane fade show  active" id="approved" role="tabpanel" aria-labelledby="approved-tab">
                                                <!-- Main Table -->
                                                <div class="wrapper">
                                                  <!--  <table class="table table-striped table-bordered dt-responsive nowrap" id="example" > -->
                                                    <table class="table table-custom mb-0 " id="example" >
                                                        <thead>
                                                            <tr>
                                                                <th class="w-t1 text-adjust">Sl.No</th>
                                                                <th class="w-t2 text-adjust">Products</th>
                                                                <th class="w-t3 text-adjust">Price</th>
                                                                <th class="w-t4 w-t21 text-adjust">Date of post</th>
                                                                <th class="w-t5 text-adjust">Status</th>
                                                                <th class="w-t6 w-t31 text-adjust">Wished List</th>
                                                                <th class="w-t7 text-adjust">View</th>
                                                               
                                                            </tr>
                                                        </thead>

                                                    </table>
                                                </div>

                                               
                                            </div>

                                            <!-- ------------------ Table : Pending ------------------------ -->
                                            <div class="tab-pane fade  " id="pending" role="tabpanel" aria-labelledby="pending-tab">
                                                <div class="wrapper mb-3" style="width:100%">
                                               <!--     <table id="pending_table" class="table table-striped table-bordered dt-responsive nowrap ">
                                                    <thead>
                                                    <tr>
                                                        <th class="w-t1">Sl.No</th>
                                                        <th class="w-t2">Products</th>
                                                        <th class="w-t3">Price</th>
                                                        <th class="w-t4 w-t21">Date of post</th>
                                                        <th class="w-t5">Status</th>
                                                        <th class="w-t6 w-t31">Wished List</th>
                                                        <th class="w-t7">View</th>
                                                       
                                                    </tr>
                                                </thead>-->
                                                    <table id="pending_table" class="table fixed-header table-custom mb-0 dt-responsive nowrap" style="width:100%" >
                                                        <thead>
                                                            <tr>
                                                            <th class="w-t1 text-adjust">Sl.No</th>
                                                            <th class="w-t2 text-adjust">Products</th>
                                                            <th class="w-t3 text-adjust">Price</th>
                                                            <th class="w-t4 w-t21 text-adjust">Date of post</th>
                                                            <th class="w-t5 text-adjust">Status</th>
                                                            <th class="w-t6 w-t31 text-adjust">Wished List</th>
                                                            <th class="w-t7 text-adjust">View</th>
                                                            </tr>
                                                        </thead>

                                                    </table>
                                                </div>
                                            </div>

                                            <!-- ------------------ Table : Rejected ------------------------ -->
                                            <div class="tab-pane fade " id="rejected" role="tabpanel" aria-labelledby="rejected-tab">

                                                <!-- Main Table -->
                                                <div class="wrapper" style="width:100%">
                                                    <table id="rejected_table" class="table fixed-header table-custom mb-0 table-bordered dt-responsive nowrap" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                               
                                                            <th class="w-t1 text-adjust">Sl.No</th>
                                                            <th class="w-t2 text-adjust">Products</th>
                                                            <th class="w-t3 text-adjust">Price</th>
                                                            <th class="w-t4 w-t21 text-adjust">Date of post</th>
                                                            <th class="w-t5 text-adjust">Status</th>
                                                            <th class="w-t6 w-t31 text-adjust">Wished List</th>
                                                            <th class="w-t7 text-adjust">View</th>
                                                            </tr>
                                                        </thead>

                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                    </div>
                 </div>
                
   <!-- --------------- Modal : Edit Plan --------------- -->
   <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                                        <div class="modal-content">
                                                                        <form action='' method='POST' >
                                                                                <div class="col-12">
                                                                                    <div class="row">
                                                                                    <div class="col-12 mt-lg-3">
                                                                                            <div class="form-group text-left">
                                                                                          
                                                                                                <label class="text-s12 text-semibold ml-lg-2 mb-1" style="color: #7F7F7F;" for="">Valid Till</label>
                                        
                                                                                                <input class="form-control input-custom"   name="date_validity" id="date_validity" value="<?  echo set_value('date_validity',$result->planValidity) ?>"  >
                                                                
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 mt-lg-3">
                                                                                            <div class="form-group text-left">
                                                                                                <label class="text-s12 text-semibold ml-lg-2 mb-1" style="color: #7F7F7F;" for="">Posts Extended</label>

                                                                                                  <input type="number" min="0" data-type="post_validity" name="post_validity" id="post_validity" value="<? echo ($result->planPostCount<0)?set_value('post_validity','Unlimited'):set_value('post_validity',$result->planPostCount) ?>" class="form-control input-custom">
                           
                                                                                            </div>
                                                                                        </div>
                                                                                  
                                                                                        <div class="col-12 mt-lg-4 pt-lg-2 mb-lg-4">
                                                                                            <button class="btn btn-orange text-s15 w-100 pt-2 pb-2 text-normal" id="plan_save"  value="<?= $result->traderID ?>">
                                                                                                Save
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
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










           
            <!--  ----------------------------------- TABLE ---------------------------------------------- -->
            
            <!-- ---- Table ends here ---- -->
        </div>
    </div>
</div>
<style>
.newregmodal {
   width:200px;
}
#.newreg_det_div {
   height: auto;
}
.reginputs {
   width: 100%;
}
</style>

<script type="text/javascript" charset="utf8" src="<?php echo base_url();?>js/datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script>
$('.datepicker').datepicker();
     $('#btn_yrly_freeze').click(function() {
        var trader_id = $(this).val();
        $this = $(this);
       
        //var elem = $(this);
        $.ajax({
            url: "<?php echo base_url(); ?>admin/Dashboard/admin_freeze_trader",
            data : {'trader_id':trader_id},
            type: "POST",
            success:function(data){
                
                if(data == 'success')
                {
                    swal('Trader Freezed Successfully',"", "success");
                     $this.attr("disabled", "disabled");
                  // $(this).attr("disabled", "disabled");
                                                    
                }    
            
                
            }
        });
    });

    $('.send_btn').click(function() {
   
    var message = $("#notification_txt").val();
    if( !message) {
        swal('Please enter message','','warning');
    }else{
    var user_id = $(this).val();
     $this = $(this);
    //var elem = $(this);
        $.ajax({
        url: "<?php echo base_url(); ?>admin/Dashboard/send_notifications",
        data : {'user_id':user_id,'message':message},
        type: "POST",
            success:function(data){
                               
                if(data == 'Success')
                {
                    swal('Notification sent Successfully',"", "success");
                    
                    cnt = parseInt($(".ypp_notificButtonNumber").html());
                    $(".ypp_notificButtonNumber").html(cnt++);
                    var dt = new Date();
                    var time = dt.getFullYear() + "-" + dt.getMonth()+1 + "-" + dt.getDate() +" "+dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
                    $(".notifications_div").prepend('<div class="row"><div class="col-md-2">'+time +'</div><div class="col-md-8">'+message+'</div></div>');
                    
                    $("#notification_txt").val('');
                    // $this.attr("disabled", "disabled");
                    // $(this).attr("disabled", "disabled");                                            
                }else{
                    location.reload();
                }        
            }
        });
        }
    });

    $('.bg_approve').click(function() {
        $('#apprtbl').css('display','inline-table');
        $('#pendtbl').css('display','none');
        $('#rejtbl').css('display','none');
      /*$('#appr_btn').closest('.ypp_tabs').css("{'background-color':'#78A22F;','color':'#fff;'}");
      $('#pend_btn').closest('.ypp_tabs').css("{'background-color':'#fff;','color':'#F4882F;'}");
      $('#rej_btn').closest('.ypp_tabs').css("{'background-color':'#fff;','color':'#FD2626;'}");*/
    });

    $('.bg_pending').click(function() {
        $('#pendtbl').css('display','inline-table');
        $('#apprtbl').css('display','none');
        $('#rejtbl').css('display','none');
      /*  $('#appr_btn').closest('.ypp_tabs').css("{'background-color':'#fff;','color':' #78A22F;'}");
        $('#pend_btn').closest('.ypp_tabs').css("{'background-color':' #F4882F;','color':' #fff;'}");
        $('#rej_btn').closest('.ypp_tabs').css("{'background-color':' #fff;','color':' #FD2626;'}");*/
    });

    $('.bg_reject').click(function() {
        $('#rejtbl').css('display','inline-table');
        $('#apprtbl').css('display','none');
        $('#pendtbl').css('display','none');
       /* $('#appr_btn').closest('.ypp_tabs').css({'background-color':'#fff;','color':' #78A22F;'});
        $('#pend_btn').closest('.ypp_tabs').css({'background-color':' #fff;','color':' #F4882F;'});
        $('#rej_btn').closest('.ypp_tabs').css({'background-color':' #FD2626;','color':' #fff;'});*/
    });

    $('#yrlnot_btn').click(function() {
        var lim = $('#yrlnot_btn span').html();
        $('#yrly_prof_div').css('border-bottom-left-radius','0px');
        $('#yrly_prof_div').css('border-bottom-right-radius','0px');
        $('#hid_notif_div').css('height','+=300px');
        var vis= $('#hid_notif_div').is(":visible");

        if(vis) {
            $('#hid_notif_div').hide();
            var v =$("#pp .notif_divs").length;
            if(v==lim) {
                for(var i=1;i<=lim;i++) {
                    $("#pp").html($("#pp").html().replace('<div class="notif_divs"><div class="col-sm-2"><span class="notif_date">11 oct 2017</span></div><div class="col-sm-2"><span class="notif_con">fgfhdfhgfjgfjfgkfhkhgkghk fhgfgf</span></div></div>', " "));
                }
            }
        }
        else {
            for(var i=1;i<=lim;i++) {
                $('#pp').append('<div class="notif_divs"><div class="col-sm-2"><span class="notif_date">11 oct 2017</span></div><div class="col-sm-2"><span class="notif_con">fgfhdfhgfjgfjfgkfhkhgkghk fhgfgf</span></div></div>'); 
            }
            $('#hid_notif_div').show(); 
        }
    });

    $('.btn_freeze').click(function() {
        var trader_id = $(this).val();
        $this = $(this);
        $.ajax({
            url: "<?php echo base_url(); ?>admin/Dashboard/admin_freeze_trader",
            data : {'trader_id':trader_id},
            type: "POST",

            success:function(data) {
                if(data == 'success') {
                    swal('Trader Freezed Successfully',"", "success");
                    $this.attr("disabled", "disabled");
                }
            }
        });
    });

    function submit(val1,val2) {

    }
    $("body").find("#post_validity").keypress(function() {
      var value = $(this).val(); 
    // alert(value);
    });
    
    $(document).on("keyup change","#post_validity",function() {
        var number_value =  $('#post_validity').val();
   // alert(number_value);
    });   
    var dateToday = new Date(); 
    $('#date_validity').datepicker({
        
        autoclose:true,
        minDate: 0,
        format: 'yyyy-mm-dd'
        
       
});

    $(document).on("click","#plan_save",function(e) {
        e.preventDefault();
        trader_id=$(this).val();
        post_validity=$("body").find("#post_validity").val();
        date_validity=$("body").find("#date_validity").val();

       
  
        if( post_validity==''||date_validity=='') {
        swal('Fields cant be empty','','error');
        e.stopPropagation();
        }else{
            $.ajax({
            url: "<?php echo base_url(); ?>admin/Dashboard/save_userplan",
            data : {"post_validity":post_validity,"date_validity":date_validity,"trader_id":trader_id},
            type: "POST",
            
            success:function(data) {
               
                swal("Plan updated Successfully","", "success");
               $("#myModal").modal("hide");
               location.reload();
            }
        });
     
        }
       
    });

    function edit_userplan(trader_id) {
    
        $('#myModal').modal("show"); 
    }

    $(document).ready(function() {
        var plan ="<?php echo $planId;?>";
        var trader ="<?php echo $traderId;?>";
        getApproved(plan,1,trader,'example');
        getApproved(plan,0,trader,'pending_table');
        getApproved(plan,'-1',trader,'rejected_table');
  
        
    });
    
    function getApproved(plan,status,trader,id){
       // console.log(plan+','+status+','+trader+','+id);
          $('#'+id).DataTable( {
            "bFilter": true,
            "responsive": true,
            "processing": true,
            "language": {
                  "zeroRecords": "No records to display"
                },
            "ajax": {
                
                "url": "<?php echo base_url(); ?>admin/Dashboard/getPostByStatus/"+plan+'/'+status+'/'+trader,
                "type": "POST",
                "dataType": "json",

            },
            "ordering"    : true,
            "paging"      : true,
            "pageLength": 10,
            "searching"   : false,
            "columns": [
                { "data": "sl_no" , "visible": true, "searchable": true},
                { "data": "product", "visible": true, "searchable": true },
                { "data": "price" , "visible": true, "searchable": true},
                { "data": "date_of_post" , "visible": true, "searchable": true},
                { "data": "status", "visible": true, "searchable": true },
                { "data": "wished_list" , "visible": true, "searchable": true},
                { "data": "view", "visible": true, "searchable": true }
            ],drawCallback: function(settings) {
    var pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
    pagination.toggle(this.api().page.info().pages > 1);
  }

        });
    }
    $( ".ypp_notificButton" ).click(function() {
        $( ".notifications_div" ).slideToggle( "slow", function() {
    // Animation complete.
    });
});
</script>