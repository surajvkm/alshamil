<?php echo form_open('auth/login_attempt', array('class'=>'form-vertical validate' , 'id'=>'singin')) ?>
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
                        <span class="text-danger"><?php if ($this->session->flashdata('errors')){  echo $this->session->flashdata('errors'); } ?></span>
                    </div>
                </div>
                 
                
                <div class="col-sm-12">
                        <button type="submit" class="btn btn-default btnlogs" id="btnlognext">Sign In</button>
                </div>
                <div class="col-sm-12">
                    <span>
                            <a data-toggle="modal" data-target="#regModal" class="to_register signup">Sign Up</a>
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
<?php echo form_close(); ?>