<?php
$this->view('trader/trader_header'); 

 ?>
<form action="save_pay" method="post">
    <section class="section white-background regsecdiv1">
        <div class="container">
                <div class="row">
                    <div class="col-sm-12" >
                        
                            <center>
                             <h5 id="regtitle" >Payment</h5>
                         </center>
                        <div class="container-fluid paydiv1" >
  
                            <div class="row">
                                <div class="col-sm-2" >
                                    <div class="form-group">
                                        <img src="img/visa.png" id="imgvisa">
                                        
                                    </div>
                                </div>
                                <div class="col-sm-2" >
                                    <div class="form-group">
                                    
                                           <img src="img/mastercard.jpg" id="imgmaster">
                                          
                                       
                                   </div>
                                </div>
                                <div class="col-sm-2" >
                                    <div class="form-group">
                                    
                                        <!--button id="btnpayother">Other</button--> 
                                        <div id="otherpaydivs">
                                             <a href="#" id="otherapay">Other</a> 
                                        </div>
                                        
                                       
                                   </div>
                                </div>    
                            </div>
                            
                         
                            
                        </div>
                        
                         
                        
                            
                    </div>
                </div>
            </div><!-- end container -->
                
    </section>
     <section class="section white-background regsecdiv2">
        <div class="container">
                <div class="row">
                    <div class="col-sm-12" >
                        
                           
                        <div class="container-fluid" id="paydetdiv">
  
                            <center>
                                <p id="pplantype"><?php echo $plantype?></p>
                                
                                
                            <br>
                            <p id="pplanamt1">Payment Amount</p>
                            
                            <p id="pplanamt2"><?php echo $pay_amt?></p>
                            </center>
                            
                        </div>
                        
                         
                        
                            
                    </div>
                </div>
            <section class="section white-background mainpaydiv1">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12" >
                        
                           
                        <div class="container-fluid contdiv1" >
  
                            <div class="row">
                                <div class="col-sm-6" >
                                    <div class="form-group">
                                        <label for="usr">Name on Card</label>
                                        <input type="text" name="txtcardname" class="form-control reginputs" >
                                       
                                    </div>
                                </div>
                                <div class="col-sm-6" >
                                    <div class="form-group">
                                        <label for="usr">Card Number</label>
                                        <input type="text" name="txtcardno" class="form-control reginputs" >
                                        
                                   </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-6" >
                                     <label for="usr">Expiry Date</label><span style="float: right;">Security Code</span>
                                    <div class="form-group">
                                        
                                        <div class="col-md-3">
                                            
                                            <input type="text" class="form-control datepicker reginputs" placeholder="dd-mm-yyyy" id="crdexpdate">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control reginputs" id="crdno">
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                                <div class="col-sm-6" >
                                    <div class="form-group">
                                        <label for="usr">ZIP/Postal Code </label>
                                        <input type="text" name="txtpostalcode" class="form-control reginputs" >
                                       
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
    <section class="section white-background mainpaydiv2">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12" >
                        
                            
                        <div class="container-fluid contdiv1" >
                           
                       
                            <div class="row" id="utypebtn">
                                <div class="col-sm-6" >
                                    <div >
                                        
                                        <button type="submit" class="btn btn-default" id="btnnext">Pay</button>
                                    </div>
                                </div>
                                

                            </div>
                            
                            
                           
                            
                        </div>
                        
                         
                        
                            
                    </div>
                </div>
            </div><!-- end container -->
                
            
    </section>                        
            </div><!-- end container -->
                
    </section>
</form>
<?php $this->view('trader/trader_footer');  ?>

<script>
   $(document).ready(function(){
       $('#crdexpdate').datepicker({
        
        format: 'dd/mm/yyyy' ,
        autoclose: true
        }); 
        
        
   });    
</script>