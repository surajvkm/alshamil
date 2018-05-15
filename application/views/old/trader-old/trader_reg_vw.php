<?php echo $this->session->flashdata('msg'); ?>
<form method="post" id="my_form" action="<?php echo base_url();?>Trader/save_trader_register" enctype="multipart/form-data">
   <!-- start section -->
   <section class="section white-background regsecdiv1">
      <div class="container">
         <div class="row">
            <div class="col-sm-12" >
               <center>
                  <span id="regtitle" >Register</span>
               </center>
                
               <div class="container-fluid contdiv1" >
                    <div class="row" >
                     <div class="col-sm-6" id="empassportdiv">
                        <div class="form-group">
<!--                            <div class="dropZoneContainer" id="profile">
                                <input type="file" id="profimg" name="profimg" class="FileUpload" accept=".jpg,.png,.gif"/>
                                <img id="prof_previmg" src="<?php echo base_url() ?>img/avatar.png">
                            </div>-->

                             <div class="row" id="profile">
                                <input type="file" id="profimg" name="profimg" class="FileUpload" accept=".jpg,.png,.gif" required=""/>
                                <img id="prof_previmg" src="<?php echo base_url() ?>img/avatar.png">
                            </div>

                           <!--input type="file" name="txtemrid" class="reginputs"-->
                         <span class="errmsg"><?php echo form_error('profimg')?></span>
                        </div></div></div>
                  <div class="row" id="reg_main_row">
                     <div class="col-sm-6" >
                        <div class="form-group">
                           <label for="txtname">Full Name</label>
                           <input type="text" name="txtname" class="form-control reginputs" value="<?php echo set_value('txtname')?>" required="">
                           <span class="errmsg"><?php echo form_error('txtname')?></span>
                        </div>
                     </div>
                     <div class="col-sm-6" >
                        <div class="form-group">
                            <label for="txtplace">Place</label>
                           <input type="text" name="txtplace" class="form-control reginputs" value="<?php echo set_value('txtplace')?>" required="">
                           <span class="errmsg"><?php echo form_error('txtplace')?></span>
                           
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-6" >
                        <div class="form-group">
                            <label for="txtmob">Mobile Number</label>
                           <select id="coun_code" name="countrycode">
                              <?php
                                 foreach($qry as $r)
                                 {
                                     ?>
                              <option value="<?php echo $r->country_code?>"><?php echo $r->country_code?></option>
                              <?php } ?> 
                           </select>
                            <input type="text" name="txtmob" id="txtmob" class="form-control reginputs" maxlength="7" value="<?php echo set_value('txtmob')?>" required="">
                           <span class="errmsg"><?php echo form_error('txtmob')?></span>
                          
                        </div>
                     </div>
                     <div class="col-sm-6" >
                        <div class="form-group">
                             <label for="txtemail">Email</label>
                             <input type="email" id="txtemail" name="txtemail" class="form-control reginputs" value="<?php echo set_value('txtemail')?>" required="">
                           <span class="errmsg"><?php echo form_error('txtemail')?></span>
                          
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-6">
                        <div class="form-group">
                             <label for="txtuname">Username</label>
                           <input type="text" id="txtuname" name="txtuname" class="form-control reginputs" value="<?php echo set_value('txtemail')?> " disabled>
                           <span class="errmsg"><?php echo form_error('txtuname')?></span>
                           
                        </div>
                     </div>
                     <div class="col-sm-6" >
                        <div class="form-group">
                            <label for="txtpassword">Password</label>
                           <input type="password" name="txtpassword" id="txtpassword" class="form-control reginputs" value="<?php echo set_value('txtpassword')?>" required="">
                           <span class="errmsg"><?php echo form_error('txtpassword')?></span>
                          
                        </div>
                     </div>
                  </div>
                   <div class="row"><div class="col-sm-6">
                        <div class="form-group">
                            <label for="txtconfpassword">Confirm Password</label>
                           <input type="password" name="txtconfpassword" class="form-control reginputs" value="<?php echo set_value('txtconfpassword')?>" required="">
                           <span class="errmsg"><?php echo form_error('txtconfpassword')?></span>
                        </div>
                     </div></div>
                  <div class="row">
                      <div class="col-sm-6" id="empassportdiv">
                          <div class="form-group">
                              <div id="emlbdiv">
                                  <label id="lbl_attach" for="traderIDProof">Attach any ID</label>
                              </div>
                              <div class="dropZoneContainer" id="drop_emir1">

                                  <input type="file" id="drop_emzone1" name="traderIDProof" class="FileUpload" accept=".jpg,.png,.gif" required/>
    <!--                              <img src="#" id="em1_previmg">-->
                                  <input type="hidden" name="txt_hidem1" id="txt_hidem1" value="<?php echo set_value('txt_hidem1') ?>">
                                  <div class="emdropZoneOverlay">
                                      <img id="em1_previmg" src="<?php echo base_url() ?>img/register-attachment1.png">
    <!--                                 <i class="fa fa-paperclip atticon" aria-hidden="true"></i>-->
                                      <span class="errmsg"><?php echo form_error('txt_hidem1') ?></span>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                   
                  <div class="row">
                     <div class="col-sm-6" >
                        <hr class="reghr" id="register_hr" style="margin-top: 194px;">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end container -->
   </section>
   <!-- end section -->
   <!-- start section -->
   <section class="section white-background regsecdiv4">
      <div class="container">
      <div class="row">
         <div class="col-sm-12" >
            <center>
               <h6 id="adddettitle" >Add Detail</h6>
            </center>
            <div class="container-fluid contdiv1" >
               <div class="row">
                    <div class="col-sm-9" >
                     <div class="form-group">
                        <label for="about">About You</label>
                         <textarea class="form-control" name="txtabout" id="txtregabout" rows="5" required=""><?php echo set_value('txtabout')?></textarea>
                         <span class="errmsg"><?php echo form_error('txtabout')?></span>
                    </div>
                  </div>
                  <div class="col-sm-6" >
                     <div class="form-group">
                        <label for="txtweblink">Website Link</label>
                        <input type="text" name="txtweblink" class="form-control reginputs" value="<?php echo set_value('txtweblink')?>">
                        <span class="errmsg"><?php echo form_error('txtweblink')?></span>
                     </div>
                  </div>
                  <div class="col-sm-6" >
                     <div class="form-group">
                        <label for="txtfblink">Facebook Link</label>
                        <input type="text" name="txtfblink" class="form-control reginputs" value="<?php echo set_value('txtfblink')?>">
                        <!--input type="text" name="txtemexpdate" class="form-control datepicker reginputs" placeholder="dd-mm-yyyy" value=""-->
                        <span class="errmsg"><?php echo form_error('txtfblink')?></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-6" >
                     <div class="form-group">
                        <label for="txtinstlink">Instagram Link</label>
                        <input type="text" name="txtinstlink" class="form-control reginputs" value="<?php echo set_value('txtinstlink')?>">
                        <span class="errmsg"><?php echo form_error('txtinstlink')?></span>
                     </div>
                  </div>
                  <div class="col-sm-6" >
                     <div class="form-group">
                        <label for="txtsnapclink">Snapchat Link</label>
                        <input type="text" name="txtsnapclink" class="form-control reginputs" value="<?php echo set_value('txtsnapclink')?>"/> 
                        <span class="errmsg"><?php echo form_error('txtsnapclink')?></span>
                     </div>
                  </div>
                    <div class="col-sm-6" >
                     <div class="form-group">
                        <label for="txttwitter">Twitter Link</label>
                        <input type="text" name="txttwitter" class="form-control reginputs" value="<?php echo set_value('txttwitter')?>"/> 
                        <span class="errmsg"><?php echo form_error('txttwitter')?></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-6" >
                     <br >
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end container -->
   </section>
   <!-- end section -->
   <!-- start section -->
   <section class="section white-background regsecdiv5">
      <div class="container">
         <div class="row">
            <div class="col-sm-12" >
               <div class="container-fluid contdiv1" >
                  <div class="row" id="utypebtn">
                     <div class="col-sm-6" >
                        <div >
                           <button type="submit" class="btn btn-default" id="btnnext">Next</button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end container -->
   </section>
</form>

<script>
     
    function readem1URL(input) {
        
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#em1_previmg').attr('src', e.target.result);
                       
                    }

                    reader.readAsDataURL(input.files[0]);
                }
    }
    function readem2URL(input) {
        
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#em2_previmg').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
    }
    function readprofURL(input) {
        
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#prof_previmg').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
    }
   $(document).ready(function(){
       $("#em2_previmg").click(function() {
             
                $("#drop_emzone22").click();
            });
       $("#em1_previmg").click(function() {
           
            
            $("#drop_emzone1").click();
        });
        $('#prof_previmg').click(function() {
            $("#profimg").click();
        });
       $('#drop_emzone1').change(function(){
           var img_name = $(this).val();
           $('#txt_hidem1').val(img_name);
           readem1URL(this);
       });
       $('#drop_emzone22').change(function(){
           var img_name = $(this).val();
           $('#txt_hidem2').val(img_name);
           readem2URL(this);
       });
       $('#profimg').change(function(){
            var imgExtension = ['jpeg','jpg','png','gif'];
         if ($.inArray($(this).val().split('.').pop().toLowerCase(), imgExtension) == -1) {
         alert("Only formats are allowed : "+imgExtension.join(', '));
         }
         var totalBytes = this.files[0].size;
         if(totalBytes > 128000000)
         {
         alert("File Size cannot exceeds 128 MB");
         }
           readprofURL(this);
       });
       $("#txtmob").keypress(function (e)
       {
   
               if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                  
                         return false;
              }
       });
       $('#txtemail').keyup(function(){
           var email = $(this).val();
           $('#txtuname').val(email);
       })
        $('.datepicker').datepicker({
   
           format: 'dd/mm/yyyy' ,
           autoclose: true
       });
       
      
      
   });
</script>