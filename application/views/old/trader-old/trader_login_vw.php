<!-- start section -->
<?php echo $this->session->flashdata('msg'); ?>
<form action="<?php echo base_url();?>Trader/login_view" method="post">
<!--<form action="<?php echo base_url();?>LoginController/login_get" method="post">-->
   <section class="section white-background regsecdiv1">
      <div class="container">
      <div class="row">
         <div class="col-sm-12" >
            <center>
               <h5 id="regtitle" >Login</h5>
            </center>
            <div class="container-fluid contdiv1" id="logdiv">
                 <div class="row">
                  <div class="col-sm-6" >
                     <div class="form-group">
                        <label for="txtemail">UserType</label>
                        <select class="form-control reginputs2" name="txtusertype">
                            <option value="1">Trader</option>
                            <option value="0">Customer</option>
                        </select>
                        <span class="text-danger"><?php echo form_error('txtemail'); ?></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-6" >
                     <div class="form-group">
                        <label for="txtemail">UserName</label>
                        <input type="email" name="txtemail" class="form-control reginputs2" placeholder="UserName" required="">
                        <span class="text-danger"><?php echo form_error('txtemail'); ?></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-6">
                     <div class="form-group">
                        <label for="txtpassword">Password</label>
                        <input type="password" name="txtpassword" class="form-control reginputs2" placeholder="Password" required="">
                        <span class="text-danger"><?php echo form_error('txtpassword'); ?></span>
                     </div>
                  </div>
               </div>
                <div class="row">
                    <div class="col-sm-6" >
                        <div>
                           <button type="submit" class="btn btn-default" id="btnlognext">Login</button>
                        </div>
                     </div>
                </div>
                 <div class="row">
                    <div class="col-sm-6" >
                        <div>
                         <p class="change_link" style="text-align:center">  
		
	            <a href="<?php echo base_url();?>Trader/signup" class="to_register signup">Sign Up</a>
                    <a href="<?php echo base_url();?>Trader/signup" class="to_register sign">Forgot Password?</a>
				</p>  
                        </div>
                     </div>
                </div>
            </div>
         </div>
      </div>
      <!-- end container -->
   </section>
   <!-- end section -->
   
   
</form>
<script>
   $(document).ready(function(){
        
   });
</script>