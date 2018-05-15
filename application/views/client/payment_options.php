<div id="pay_opt_div">
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
          <p>You can pay at your nearest Bank and send the receipt to Al Shamil at Email : xxxx@yyyy.com or  What's app : 9715xxxxxxxxxx</p>
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
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>js/app/payonreg.js"></script>  