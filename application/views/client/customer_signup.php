<?php if ($this->session->flashdata('errors')){ echo $this->session->flashdata('errors'); } ?>
<?php echo form_open('auth/customer_reg', array('class'=>'form-vertical validate' , 'id'=>'customer_signup')) ?>
   <section class="section white-background regsecdiv1">
      <div class="container">
      <div class="row">
         <div class="col-sm-12" >
            <center>
               <h5 class="regtitle">Register As Customer</h5>
            </center>
            <div class="col-sm-4"></div>
            <div class="col-sm-4 logdiv">
                <div class="col-sm-12" >
                    <div class="form-group">
                        <label for="txtusertype">User Type</label>
                        <select class="form-control reginputs2" name="txtusertype">
                            <option value="0">Customer</option>
                        </select>
                        <span class="error"><?php echo form_error('txtusertype'); ?></span>
                    </div>
                </div>
                <div class="col-sm-12" >
                    <div class="form-group">
                        <label for="Name">Full Name</label>
                        <input type="text" name="Name" id="Name" class="form-control reginputs2" placeholder="Name">
                        <label id="err_Name" class="txt_errors">Enter Your full Name</label>
                    </div>
                </div>
                <div class="col-sm-12" >
                    <div class="form-group">
                        <label for="txtemail">Email Address</label>
                        <input type="email"  onfocusout="emailcheck()" name="txtemail" id="txtemail" class="form-control reginputs2" placeholder="Email Address">
                        <span id="checkemail" class="emailchecking"></span>
                        <label id="err_txtemail" class="txt_errors">Enter Your Email Address</label>
                        <label id="err_txtemailinavlid" class="txt_errors">Invalid Email Address</label>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="txtpassword">Password</label>
                        <input type="password" name="txtpassword" id="txtpassword" class="form-control reginputs2" placeholder="Password">
                        <label id="err_txtpassword" class="txt_errors">Enter Password</label>
                        <label id="err_txtpasswordstrength" class="txt_errors">Requires: Min. 6 Characters, 1 Uppercase Character</label>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="txtconfpassword">Confirm Password</label>
                        <input type="password" name="txtconfpassword" id="txtconfpassword" class="form-control reginputs2" placeholder="Password">
                        <label id="err_txtconfpassword" class="txt_errors">Confirm Password Is Required</label>
                        <label id="err_txtconfpasswordmsg" class="txt_errors">Confirm password Field Does Not Match The password Field</label>
                    </div>
                </div>
                <div class="col-sm-12">
                        <button type="submit"  class="btn btn-default btnlogs" id="btnlognext">Register</button>
                </div>
                <div class="col-sm-12">
                    <span><a href="<?php echo base_url(); ?>trader_signup" class="to_register signup">Register As Trader </a></span>
                    <span class="rating-rtl"><a href="<?php echo base_url(); ?>signin" class="to_register sign">Sign In </a></span>
                    <br><br><br>
                </div>
            </div>
            <div class="col-sm-4"></div>
         </div>
      </div>
      <!-- end container -->
   </section>
   <!-- end section -->
<?php echo form_close(); ?>