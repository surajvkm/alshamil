<!-- start section -->
<form action="<?php echo base_url();?>Trader/login_view" method="post">
   <section class="section white-background regsecdiv1">
      <div class="container">
      <div class="row">
         <div class="col-sm-12" >
            <center>
               <h5 class="regtitle">Sign in</h5>
            </center>
            <div class="col-sm-4"></div>
            <div class="col-sm-4 logdiv">
                <div class="col-sm-12" >
                    <div class="form-group">
                        <label for="txtemail">User Type</label>
                        <select class="form-control reginputs2" name="txtusertype">
                            <option value="1">Trader</option>
                            <option value="0">Customer</option>
                        </select>
                        <span class="text-danger"><?php echo form_error('txtemail'); ?></span>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="txtemail">Username</label>
                        <input type="text" name="txtemail" class="form-control reginputs2" placeholder="Username" required="">
                        <span class="text-danger"><?php echo form_error('txtemail'); ?></span>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="txtpassword">Password</label>
                        <input type="password" name="txtpassword" class="form-control reginputs2" placeholder="Password" required="">
                        <span class="text-danger"><?php echo form_error('txtpassword'); ?></span>
                    </div>
                </div>
                <div class="col-sm-12">
                        <button type="submit" class="btn btn-default btnlogs" id="btnlognext">Sign In</button>
                </div>
                <div class="col-sm-12">
                    <span>
                         <a href="#" id="logreg" class="to_register signup">Sign Up</a>
<!--                        <a href="<?php echo base_url(); ?>Trader/signupview" class="to_register signup">Sign Up</a>-->
                    </span>
             <!--        <span class="rating-rtl"><a href="<?php echo base_url(); ?>Trader/signupview" class="to_register sign">Forgot Password?</a></span><br><br><br>
              -->  </div>
            </div>
         </div>
      </div>
      <!-- end container -->
   </section>
   <!-- end section -->
   
</form>
 <!--Popup for Register-->
            <div class="modal fade" id="regModal" role="dialog">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content tradermdl">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h5 class="modal-title">Register</h5>
                        </div>
                        <div class="modal-body">
                            <button class="btnregs" id="btntrader-reg">
                                <span class="spnusers">Trader</span>
                                <span class="spntag">You can sell items</span>
                            </button>
                            <button class="btnregs" id="btncust-reg">
                                <span class="spnusers">Customer</span>
                                 <span class="spntag">You can buy items</span>
                            </button>
                        </div> 
                        
                    </div>
                </div>
            </div>
           <!--Popup for Register-->
<script>
   $(document).ready(function(){
        $('#logreg').click(function(){
                     $('#regModal').modal("show");
                });
   });
</script>