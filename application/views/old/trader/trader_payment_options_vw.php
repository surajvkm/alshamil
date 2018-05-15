<div id="pay_opt_div">
<?php
 $this->view('trader/trader_header'); 
 ?> 
<!-- start section -->

<div class="modal fade" id="alshModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content tradermdl">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h5 class="modal-title">Confirm</h5>
        </div>
        <div class="modal-body" id="alshdiv">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="yes_office" data-dismiss="modal">Yes,Proceed</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          
        </div>
      </div>
    </div>
  </div>
<div class="modal fade" id="bankModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content tradermdl">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h5 class="modal-title">Confirm</h5>
        </div>
        <div class="modal-body">
          <p>You can pay at your nearest Bank and send the receipt to Al Shamil at Email : xxxx@yyyy.com or  What’s app : 9715xxxxxxxxxx</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="yes_bank" data-dismiss="modal">Yes,Proceed</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          
        </div>
      </div>
    </div>
  </div>
<div class="modal fade" id="onlineModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content tradermdl">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h5 class="modal-title">Confirm</h5>
        </div>
        <div class="modal-body">
          <p>Proceed with Online Payment?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success"  id="btn_proceed_online" data-dismiss="modal">Yes,Proceed</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          
        </div>
      </div>
    </div>
  </div>
    <section class="section white-background regsecdiv1">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12" >
                        
                            <center>
                             <h5 id="plantitle paddingleft0">Payment Option</h5>
                         </center>
                        <div class="container-fluid contdiv1" >
  
                            <div class="row">
                                <div class="col-sm-6" >
                                    <div class="form-group">
                                     <!--img class="img__img" src="<?php echo base_url();?>img/info.png" /-->
                                      <button type="button"  id="btnpaythruals" data-toggle="modal" data-target="#alshModal">Payment Through Alshamil Office</button>

                                   </div>
                                </div>
								
                                
                            </div>
			  <div class="row">
                                <div class="col-sm-6" >
                                    <div class="form-group">
                                      <button type="button"  id="btnbank" data-toggle="modal" data-target="#bankModal">Bank Deposit</button>

                                   </div>
                                </div>
                                
                            </div>
                           
                            <div class="row">
                                <div class="col-sm-6" >
                                    <div class="form-group">
                                      <!--img class="img__img" src="<?php echo base_url();?>img/info.png" /-->
                                      <button type="button"  id="btnonline" data-toggle="modal" data-target="#onlineModal">Online</button>
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
                  
                  
                  
                   
                    $.ajax({
                           type:'POST',
                          
                           url:'<?php echo base_url()?>Trader/fetch_alshmail_loc',
                           
                           success:function(data)
                           {
                               $('#alshdiv').html(data);
                               //console.log(data);return false;
                              
                           }
                       });   
                      
                });
                

                $("#yes_office").click(function ()
                {
                  location.href = '<?php echo base_url();?>';
             
                });
                $("#yes_bank").click(function ()
                {
                   
                   
                  $.ajax({
                           type:'POST',
                           
                             url:'<?php echo base_url()?>Trader/up_bankpaystatus',
                          
                           success:function(data)
                           {
                            location.href = '<?php echo base_url();?>';
                           }
                       });  
                  
                      
                });
                $("#btn_proceed_online").click(function ()
                {
                    
                  $.ajax({
                           type:'POST',
                           
                           url:'<?php echo base_url()?>Trader/fetch_plan_amt',
                          
                           success:function(data)
                           {
                               var res = data.split("-");
                               var user_id = res[1];
                               var amt = res[0];
                             location.href = 'http://alshamil.bluecast.ae/trader/OnlinePay?amount='+amt+'&user_id='+user_id;
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

