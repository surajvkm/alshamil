
        <?php
        $this->view('admin/admin_header'); 
         ?>
          
  
            <div class="container">
                <div class="row">
                    <?php
                    $this->view('admin/admin_sidebar'); 
                     ?>
                    <h6 id="db_yrlytitle">MONTHLY PLAN</h6>
                    <div class="col-sm-12" id="main_yrly_plan_div">
                        <div id="yrly_msg">
                            <input type="text" id="txtmsg" placeholder="Type Message">
                            <button id="yrly_btn">Send Message</button>
                        </div> 
                    </div>
                      <?php 
                    foreach($qry as $r)
                    {
                         ?>
                      <div class="col-sm-12 col-md-12 yrly_plan_div h-72"> <!---- id= colddiv1--- -->
         <div class=" col-xs-3 col-sm-3 col-md-3 col-lg-3 px-md-0  yrly_plan_details" value="<?php echo $r->traderID ?>">
                 <div class="row">
                     <div class="col-sm-3 col-md-3 pr-0">
                         <img src="<?php echo $r->traderImage?>" class="user-img">
                     </div>
                     <div class="col-md-6 col-sm-6 pt-md-20 px-md-0">
                         <div class="row pl-25">
                             <div class="col-sm-12 col-md-12 px-md-0">
                                 <span>Name</span>
                             </div>
                             <div class="col-sm-12 col-md-12 px-md-0 pointer">
                                 <span class="font-black"><?php echo ucfirst($r->traderFullName)?></span>
                             </div>
                         </div>
                     </div>
                 </div>
             <div class="sideline"></div>
         </div>
           
         <div class="col-sm-7 col-md-7 px-md-0">  <!---- id=coldiv2--- -->
             <div class="row">
                 <div class="col-sm-3 col-md-3 text-right pl-0 pr-0 pt-15">
                 <?php 
                            $now = time(); // or your date as well
                            $till_date = strtotime($r->traderValidTill);
                            $datediff = floor(($till_date -$now)/(60 * 60 * 24));
                            $days_left = ($datediff>0) ? $datediff."Days Left" : "Subscription Expired";
                             ?>
                     <span class="days_left text-right font-size-13 text-bold">( <?php echo $days_left;?> )</span>
                 </div>
                 <div class="col-md-9">
                         <div class="row">
                             <div class="col-sm-5 col-md-5 pt-14">
                                 <button class="boot-btn w-100 h-42"><span class="  font-size-12 color-light">Total Amount Paid</span><br>
                                      <span class="spn_tots  text-bold line-height-1 ">AED <?php echo $r->traderPaymentHistory; ?></span>
                                 </button>
                             </div>
                             <div class="col-sm-3 col-md-3 pt-14 px-md-0">
                                 <button class="boot-btn1 w-100 h-42">
                                         <span class="line-height-1   font-size-12 color-light">Total Post<span><br>
                                        <span class="spn_tots text-bold line-height-1"><?php echo $r->traderPostCount; ?> </span>
                                 </button>
                             </div>
                             <div class="col-sm-4 col-md-4 pt-14">
                                 <button class="boot-btn1 w-100 h-42"><span class="line-height-1   font-size-12 color-light">Sold<span><br>
                                      <span class="spn_tots text-bold line-height-1"><?php echo $r->traderSoldCount; ?></span>
                                 </button>
                             </div>
                         </div>
                 </div>
                     <div class="sideline1"></div>
             </div>
         </div>
         <div class="col-sm-2 col-md-2 pt-10">
             <div class="row">
                 <button class="w-60 boot-btn2 ml-60 mt-6 h-30 btn_freeze"  <?php if($r->isActive==-1)echo "disabled"; ?> ><?php echo ($r->isActive==-1? "Freezed": 'Freeze')?></button>
             </div>               
         </div>   
        </div>
                        
                    <?php
                    }
                    ?> 
         <!-- ------------------------First row--------------------------- -->

        

              
</div><!-- end container -->
            
       <?php
        $this->view('admin/admin_footer'); 
         ?>
        <script>
         $('.btn_freeze').click(function() {
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
                                                swal('Trader Freezed Successfully');
                                                 $this.attr("disabled", "disabled");
                                              // $(this).attr("disabled", "disabled");
                                                                                
                                            }    
                                        
                                            
                                        }

                                    });
        });

        $('.yrly_plan_details').click(function() {
            location.href='<?php echo base_url()?>admin/Dashboard/plan_profile/'+$(this).attr("value");
           
        });
       
        </script>
            
        
       