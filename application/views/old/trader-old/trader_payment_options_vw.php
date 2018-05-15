<div id="pay_opt_div">
<?php
 $this->view('trader/trader_header'); 
 ?> 
<!-- start section -->
    <section class="section white-background regsecdiv1">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12" >
                        
                            <center>
                             <h5 id="plantitle">Payment Option</h5>
                         </center>
                        <div class="container-fluid contdiv1" >
  
                            <div class="row">
                                <div class="col-sm-6" >
                                    <div class="form-group">
                                     <img class="img__img" src="<?php echo base_url();?>img/info.png" />
                                      <button type="button"  id="btnpaythruals">Payment Through Alshamil Office</button>

                                   </div>
                                </div>
								
                                
                            </div>
<!--							  <div class="row">
                                <div class="col-sm-6" >
                                    <div class="form-group">
                                      <button type="button"  id="btnbank">Bank Deposit</button>

                                   </div>
                                </div>
                                
                            </div>-->
                           
                            <div class="row">
                                <div class="col-sm-6" >
                                    <div class="form-group">
                                      <img class="img__img" src="<?php echo base_url();?>img/info.png" />
                                      <button type="button"  id="btnonline">Online</button>
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-6" >
                                    
                                </div>
                                
                            </div>
                            
                        </div>
                        
                         
                        
                            
                    </div>
                </div>
            </div><!-- end container -->
                
            
    </section>
    <!-- end section -->
<?php $this->view('trader/trader_footer');  ?>
</div>

<script>
            
            $(document).ready(function()
            {
                $("#btnpaythruals").click(function ()
                {
                  
                  var myurl = '<?= base_url(); ?>make_pay/';
                  var plan_type = $('#hid_plantype').val();
                   
                    $.ajax({
                           type:'POST',
                           url:myurl,
                           data:{'plan_type':plan_type},
                           success:function(data)
                           {
                               
                               $('#pay_opt_div').css('display','none');
                               $('#regpay_div').css('display','block');
                               $('#pplantype').html(plan_type);
                               $('#regpay_div').html(data);
                           }
                       });   
                      
                });
                $("#btnbank").click(function ()
                {
                  
                  var myurl = '<?= base_url(); ?>make_pay/';
                 
                   var plan_type = $('#hid_plantype').val();
                    $.ajax({
                           type:'POST',
                           url:myurl,
                           data:{'plan_type':plan_type},
                           success:function(data)
                           {
                               $('#plantype').css('display','none');
                               $('#header_div').css('display','none');
                               $('#footer_div').css('display','none');
                               $('#payoptions_div').html(data);
                           }
                       });   
                      
                });
                $("#btnonline").click(function ()
                {
                  
                  var myurl = '<?= base_url(); ?>make_pay/';
                 
                   var plan_type = $('#hid_plantype').val();
                    $.ajax({
                           type:'POST',
                           url:myurl,
                           data:{'plan_type':plan_type},
                           success:function(data)
                           {
                               $('#plantype').css('display','none');
                               $('#header_div').css('display','none');
                               $('#footer_div').css('display','none');
                               $('#payoptions_div').html(data);
                           }
                       });   
                      
                });
                $("#btnsinglepost").click(function ()
                {
                  
                  var myurl = '<?= base_url(); ?>make_pay/';
                 
                   var plan_type = $('#hid_plantype').val();
                    $.ajax({
                           type:'POST',
                           url:myurl,
                           data:{'plan_type':plan_type},
                           success:function(data)
                           {
                               $('#plantype').css('display','none');
                               $('#header_div').css('display','none');
                               $('#footer_div').css('display','none');
                               $('#payoptions_div').html(data);
                           }
                       });   
                      
                });
               
            });
            </script>

