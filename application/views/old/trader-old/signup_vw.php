<!-- start section -->
<?php echo $this->session->flashdata('msg'); ?>
<form action="<?php echo base_url();?>Trader/signup" method="post">

   <section class="section white-background regsecdiv1">
      <div class="container">
      <div class="row">
         <div class="col-sm-12" >
            <center>
               <h5 id="signuptitle" >Sign Up</h5>
            </center>
            <div class="container-fluid contdiv1" id="logdiv">
                 <div class="row">
                  <div class="col-sm-6" >
                     <div class="form-group">
                        <label for="txtusertype">UserType</label>
                        <select class="form-control reginputs2" name="txtusertype">
                        <option value="0">Customer</option>
                        </select>
                        <span class="text-danger"><?php echo form_error('txtusertype'); ?></span>
                     </div>
                  </div>
               </div>
                  <div class="row">
                  <div class="col-sm-6" >
                     <div class="form-group">
                        <label for="Name">Full Name</label>
                        <input type="text" name="Name" class="form-control reginputs2" placeholder="Name">
                        <span class="text-danger"><?php echo form_error('Name'); ?></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-6" >
                     <div class="form-group">
                        <label for="txtemail">Email Address</label>
                        <input type="email" name="txtemail" class="form-control reginputs2" placeholder="Email Address">
                        <span class="text-danger"><?php echo form_error('txtemail'); ?></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-6">
                     <div class="form-group">
                        <label for="txtpassword">Password</label>
                        <input type="password" name="txtpassword" class="form-control reginputs2" placeholder="Password">
                        <span class="text-danger"><?php echo form_error('txtpassword'); ?></span>
                     </div>
                  </div>
               </div>
                 <div class="row"><div class="col-sm-6">
                        <div class="form-group">
                            <label for="txtconfpassword">Confirm Password</label>
                           <input type="password" name="txtconfpassword"  class="form-control reginputs2" placeholder="Password">
                           <span class="errmsg"><?php echo form_error('txtconfpassword')?></span>
                        </div>
                     </div></div>
                <div class="row">
                    <div class="col-sm-6" >
                        <div>
                           <button type="submit" class="btn btn-default" id="btnlognext">Sign Up</button>
                        </div>
                     </div>
                </div>
                  <div class="row">
                    <div class="col-sm-6" >
                        <div>
                           <p class="change_link" style="text-align:center">  
		
                               <a href="<?php echo base_url();?>Trader/register" class="to_register signup">Register As Trader </a>
                               <a href="<?php echo base_url();?>Trader/login_view" class="to_register sign">Sign In </a>
				
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