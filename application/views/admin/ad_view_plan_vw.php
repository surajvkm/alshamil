

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
                <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/custom/plans.css">      
                <div class="col-main">
                    <div class="col-lg-12 col-12">
                    <h4 class="page-title mt-4 mb-2 pb-2 pt-2"><?php echo $plan_name; ?></h4>
                    <div class="row">
                                <div class="col-12 px-md-1 px-lg-4 px-1">

                                    <!-- ------ Message Input ------- -->
                                    <?php if(count($qry)>0){ ?>
                                    <div class="bg-message p-lg-4 py-4 px-2 ml-1 mr-1 mb-2 overflow-hidden">
                                        <div class="col-12 pt-md-1 pb-md-1">
                                            <div class="row">
                                                <div class="col-lg-10 col-sm-9 col-8 pl-0 pr-0">
                                                    <div class="form-group w-100">
                                                        <input type="text" class="form-control pt-lg-2 pb-lg-2 text-s15 w-100" id="txtmsg" placeholder="Type a message">
                            
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-sm-3 col-4 pr-0 pl-2 pl-md-3 pl-sm-1 pt-1 pt-md-0">
                                                    <button class="btn btn-orange text-s15 w-100 pt-lg-2 pb-lg-2 border-grey text-adjust text-resize btn_send"  id="yrly_btn" value="<?php echo $plan_id; ?>">
                                                        Send message
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
<?php } ?>
                                    <?php 
                                    
                                    
                                    
                                        foreach($qry as $r)
                                        {
                                     
                                        ?>
                                    <!-- ------ One Single Row of Data ------ -->
                                    <div class="h-87 h-md-75 h-120 bg-plans p-2 ml-1 mr-1 overflow-hidden scaleDiv-1 hover-shadow " >
                                        <div class="col-12 p-0">
                                            <div class="row h-77">

                                                <!-- Div with link -->
                                                <div class="col-md-3 col-sm-3 col-4 shadeDiv pr-0 pr-md-3 pr-sm-3 yrly_plan_details" value="<?php echo $r->traderId ?>">
                                                    <a href="<?php echo base_url().'admin/plan_profile/'.$r->traderId.'/'.$r->planId?>" >
                                                        <div class="row">

                                                            <!-- User Image -->
                                                            <div class="col-sm-4 col-2 text-right pt-lg-1 pr-lg-0 pl-2">
                                                                <img class="userImage" src="<?php echo $r->image?>" alt="">
                                                            </div>

                                                            <!-- User Details -->
                                                            <div class="col-8 pl-lg-3 pl-md-4  pr-lg-2 mt-lg-3 mb-lg-3 vbr">
                                                                <p class="mb-0 text-s12 text-resize pl-md-1 pl-sm-2 pl-3 pl-lg-0" style="color: #696969;">Name</p>
                                                                <p class="mb-0 text-s13 text-resize text-readjust text-semibold pl-md-1 pl-sm-2 pl-3 pl-lg-0" style="color: #282828;"><?php echo ucfirst($r->fullName)?></p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>

                                                <!-- Days Left -->
                                                <div class="col-2 pr-lg-5 pt-lg-4 pt-sm-3 pl-md-2 pl-2 pl-sm-3 pr-md-3 pr-1 text-left text-md-right text-lg-right">
                                                <?php 
                                               
               
                    ?>
                                                    <p class="mb-0 text-s13 text-resize text-orange text-semibold mt-lg-1 text-adjust">()</p>
                                                </div>

                                                <!-- Total Amount Paid -->
                                                <div class="col-sm-2 col-3 pl-0 pt-lg-2">
                                                    <div class="card-yellow mt-lg-1">
                                                        <p class="mb-0 text-s13 text-resize" style="color: #696969;">Total Amount Paid</p>
                                                        <p class="mb-0 text-s16 text-adjust text-resize text-semibold" style="color: #282828;">AED <?php echo !empty($r->paymentHistory)?$r->paymentHistory:0; ?></p>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <div class="row">
                                                        <!-- TOtal Post -->
                                                        <div class="col-6 pl-0 pt-lg-2">
                                                            <div class="card-yellow post-yellow mt-lg-1">
                                                                <p class="mb-0 text-s13 text-resize" style="color: #696969;">Total Post</p>
                                                                <p class="mb-0 text-s16 text-resize text-adjust text-semibold pt-md-1 pt-lg-0" style="color: #282828;"><?php echo $r->postCount; ?> </p>
                                                            </div>
                                                        </div>
                                                        <!-- Sold -->
                                                        <div class="col-6 pl-0 pt-lg-2">
                                                            <div class="card-yellow sold-yellow mt-lg-1">
                                                                <p class="mb-0 text-s13" style="color: #696969;">Sold</p>
                                                                <p class="mb-0 text-s16 text-resize text-adjust text-semibold pt-sm-1 pt-md-1 pt-lg-0" style="color: #282828;"><?php echo $r->soldCount; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Freeze Button -->
                                                <div class="col-sm-2 col-12 text-md-center text-right mt-lg-3 mb-lg-3 mt-2 mt-sm-0 mt-md-0 pl-0 vbl pr-md-0 pr-lg-3 pt-md-2 pt-lg-0">
                                                    
                                            
                                                        <!-- "btn-green" instead of "btn-red" for green freeze button (NO NEED TO CHANGE OTHER CLASSES) -->
                                                        <button class="btn btn-red text-s14 w-75 w-sm-100 btn-49 pt-2 pb-2 mt-sm-2 mt-md-0 btn_freeze px-md-1" value="<?php echo $r->traderId;?>"  ><?php echo ($r->isActive==-1? "Freezed": 'Freeze')?></button>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                        }
                                        ?>  
                                    <!-- /row -->
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
<script type="text/javascript" src="<?php echo base_url(); ?>js/app/adminapp.js"></script>  
   


<script>
   $('#yrly_btn').click(function() {
    var message = $("#txtmsg").val();
    if( !message) {
        swal('Please enter message','','warning');
    }else{
        var plan_id = $(this).val();
     $this = $(this);
    //var elem = $(this);
        $.ajax({
        url: "<?php echo base_url(); ?>admin/send_notifications",
        data : {'plan':plan_id,'message':message},
        type: "POST",
            success:function(data){                
                if(data == 'Success')
                {
                    swal('Notification sent Successfully');
                    $("#txtmsg").val('');
                    // $this.attr("disabled", "disabled");
                    // $(this).attr("disabled", "disabled");                                            
                }         
            }
        });
    }

    });

    $('.btn_freeze').click(function() {
    var trader_id = $(this).val();
    $this = $(this);
    //var elem = $(this);
        $.ajax({
        url: "<?php echo base_url(); ?>admin/admin_freeze_trader",
        data : {'trader_id':trader_id},
        type: "POST",
        success:function(data){     
        var obj =JSON.parse(data) ;
                
            if(obj.status == 'success')
            {
                swal("Trader "+ obj.what + " Successfully");
                if(obj.what=='Freezed')
                $('.btn_freeze').text('Freezed')
                else
                $('.btn_freeze').text('Freeze')                       
            }         
        }
        });
    });
    $('.yrly_plan_details').click(function() {
        var planId = $('#yrly_btn').val();
    location.href='<?php echo base_url()?>admin/plan_profile/'+$(this).attr("value")+'/'+planId;    
    });
</script>
            
        
       