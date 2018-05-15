<?php if ($this->session->flashdata('errors')){ echo $this->session->flashdata('errors'); } ?>
<?php echo form_open_multipart('auth/trader_reg', array('class'=>'form-vertical validate' , 'id'=>'trader_signup')) ?>
   <section class="section white-background regsecdiv1">
      <div class="container">
         <div class="row">
            <div class="col-sm-12" >
               <center>
                  <span class="regtitle new-title" >Register As Trader</span>
               </center>
               
                <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-3">
                    <center>
                        <a href="#" data-toggle="tooltip" data-placement="top" title="Add Profile Picture">
                            <div class="row profile ">
                                <input type="file" id="profimg" name="profimg" class="userProffile FileUpload"  accept=".jpg,.png,.gif" required=""/>
                                <img id="prof_previmg" class="previmg" src="<?php echo base_url() ?>img/avatar.png">
                            </div>
                        </a>    
                        <label id="err_profimg" class="txt_errors">Please Select Your Profile Image</label>
                    </center>
                    <div class="col-sm-12">
                        <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="txtname">Full Name</label>
                                <input type="text" name="txtname" id="txtname" class="form-control" value="<?php echo set_value('txtname') ?>" required="">
                                <label id="err_txtname" class="txt_errors">Please Select Your full Name</label>
                            </div>
                        </div>
                        
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="txtplace">Place</label>
                                <select name="txtplace" id="txtplace" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Dubai">Dubai</option>
                                    <option value="Abudhabi">Abudhabi</option>
                                    <option value="Sharjah">Sharjah</option>
                                    <option value="Ajman">Ajman</option>
                                    <option value="Fujairah">Fujairah</option>
                                    <option value="RAK">RAK</option>
                                    <option value="Umm Alquwain">Umm Alquwain</option>
                                    <option value="Al Ain">Al Ain</option>
                                    <option value="Other">Other</option>
                                </select>
<!--                                <input type="text" name="txtplace" id="txtplace"  class="form-control" value="<?php echo set_value('txtplace') ?>" required="">-->
                                <label id="err_txtplace" class="txt_errors">Please Select Your Location</label>
                            </div>
                        </div>
                        <div class="col-md-12"></div>
                        <div class="col-sm-6 col-md-6" >
                            <div class="form-group">
                                <label for="txtmob">Mobile Number</label>
                                <input type="hidden" id="hid_country_code" name="txt_countrycode" value="+1">
                                <input id="phone" type="text"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'  name="txtmob" value="+1" class="form-control" maxlength="13" minlength="5">
                                <label id="err_txtmob" class="txt_errors">Please Select Your Contact Number</label>
                                <label id="err_txtmobval" class="txt_errors">Please</label>

                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6" >
                            <div class="form-group">
                                <label for="txtemail">Email</label>
                                <input onfocusout="emailcheck()" type="email" id="txtemail" name="txtemail" class="form-control" value="<?php echo set_value('txtemail') ?>" required="">
                                <span id="checkemail" class="emailchecking"></span>
                                <span id="err_txtemail" class="txt_errors">Please Select Your  Email Address</span>
                                <span id="err_txtemailinavlid" class="txt_errors">Invalid Email Address</span>

                            </div>
                        </div>
                        <div class="col-md-12"></div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="txtuname">Username</label>
                                <input type="text" id="txtuname" name="txtuname" class="form-control" value=""  required>
                                <span class="error"><?php echo form_error('txtuname') ?></span>
                                <label id="err_txtuname" class="txt_errors">Please Enter Your User Name</label>
                          
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="txtpassword">Password</label>
                                <input type="password" name="txtpassword" id="txtpassword" class="form-control" value="<?php echo set_value('txtpassword') ?>" required="">
                                <label id="err_txtpassword" class="txt_errors">Please Select Your Password</label>
                                <label id="err_txtpasswordstrength" class="txt_errors">Requires: 6 Characters,and atleast 1 Uppercase Character</label>
                            </div>
                        </div>
                        <div class="col-md-12"></div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="txtconfpassword">Confirm Password</label>
                                <input type="password" name="txtconfpassword" id="txtconfpassword"  class="form-control" value="<?php echo set_value('txtconfpassword') ?>" required="">
                                <label id="err_txtconfpassword" class="txt_errors">Confirm password field is required</label>
                                <label id="err_txtconfpasswordmsg" class="txt_errors">Confirm password Field Does Not Match The password Field</label>

                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="col-xs-6 col-sm-6 col-md-6">

                                <input type="hidden" name="txt_hidem1" id="txt_hidem1" value="<?php echo set_value('txt_hidem1') ?>">
                                <div class="dropZoneContainer dropvideo" id="drop_emir1">

                                    <input type="file" id="drop_emzone1" name="traderIDProof" class="FileUpload" accept=".jpg,.png,.gif" required/>
                                    <img id="em1_previmg" class="file-imglabel previmg" src="<?php echo base_url() ?>img/register-attachment1.png">
                                    <label id="err_drop_emzone1" class="txt_errors">Please upload your ID proof1</label>

                                </div>

                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="dropZoneContainer" id="drop_emir2" >
                                   
                                    <input type="hidden" name="txt_hidem2" id="txt_hidem2" value="<?php echo set_value('txt_hidem2') ?>">
									 <input type="file" id="drop_emzone22" name="traderIDsecond" class="FileUpload" accept=".jpg,.png,.gif" />	
                                    <img id="em2_previmg"  class="file-imglabel previmg"  src="<?php echo base_url() ?>img/register-attachment2.png">
                                    <label id="err_drop_emzone2" class="txt_errors">Please upload your ID proof2</label>
                                    

                                </div>

                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-9 col-md-12">
                            <hr class="adddethr">
                            <h6 class="adddettitle" >Add Detail</h6>
                        </div>
                        <div class="col-xs-12 col-sm-9 col-md-12">
                            <div class="form-group">
                                <label for="about">Write About Yourself</label>
                                <textarea class="form-control" name="txtabout" id="txtregabout" rows="5" required=""><?php echo set_value('txtabout') ?></textarea>
                                <label id="err_txtregabout" class="txt_errors">Please provide your details</label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="txtweblink">Website Link</label>
                                <input type="text" id="txtweblink"  name="txtweblink" class="form-control" value="<?php echo set_value('txtweblink') ?>">
                                <label id="err_txtweblink" class="txt_errors">Not a Valid URL</label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6" >
                            <div class="form-group">
                                <label for="txtfblink">Facebook Link</label>
                                <input type="text"  name="txtfblink" id="txtfblink" class="form-control" value="<?php echo set_value('txtfblink') ?>">
                                <!--input type="text" name="txtemexpdate" class="form-control datepicker reginputs" placeholder="dd-mm-yyyy" value=""-->
                                <label id="err_txtfblink" class="txt_errors">Not a Valid URL</label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6" >
                            <div class="form-group">
                                <label for="txtinstlink">Instagram Link</label>
                                <input type="text" name="txtinstlink" id="txtinstlink" class="form-control" value="<?php echo set_value('txtinstlink') ?>">
                                <label id="err_txtinstlink" class="txt_errors">Not a Valid URL</label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6" >
                            <div class="form-group">
                                <label for="txtsnapclink">Snapchat Link</label>
                                <input type="text"  name="txtsnapclink" id="txtsnapclink" class="form-control" value="<?php echo set_value('txtsnapclink') ?>"/> 
                                <label id="err_txtsnapclink" class="txt_errors">Not a Valid URL</label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6" >
                            <div class="form-group">
                                <label for="txttwitter">Twitter Link</label>
                                <input type="text"  name="txttwitter" id="txttwitter" class="form-control" value="<?php echo set_value('txttwitter') ?>"/> 
                                <label id="err_txttwitter" class="txt_errors">Not a Valid URL</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                 <div class="col-sm-8 col-md-12">
                    
                     <div class="col-md-4 col-md-offset-4"><br><button type="submit" class="btn btn-default" id="btnnext">Next</button><br><br><br></div>
                 </div>
                 </div>
            </div>
         </div>
      </div>
      <!-- end container -->
   </section>
   <!-- end section -->

<!--loading modal for entering other country name-->
<div id="otherplaceModal" class="modal fade"> 
        <div class="modal-dialog edit_passmod">  
            <div class="modal-content">  
                <div class="modal-header" id="flagmheader">  
                    <button type="button" class="close" data-dismiss="modal">&times;</button>  
                </div>  
                <div class="modal-body"> 
                    <label>Enter Place</label>
                    <input type="text" class="form-control" id="txtnewplace">
                </div>  
                <div class="modal-footer" id="flagmfooter">  
                    <button type="button" class="btn btn-default btnAddPlaceModal" data-dismiss="modal">ADD</button>  
                </div>  
            </div>  
        </div>
    </div> 
 <script type="text/javascript" src="<?php echo base_url(); ?>js/intlTelInput.min.js"></script>   
<script type="text/javascript" src="<?php echo base_url(); ?>js/app/utils.js"></script>    