<?php echo $this->session->flashdata('msg'); ?>
<form  method="post" id="my_form" action="<?php echo base_url();?>Trader/update_trader_register" enctype="multipart/form-data">
   <!-- start section -->
   <section class="section white-background regsecdiv1">
      <div class="container">
         <div class="row">
            <div class="col-sm-12" >
               <center>
                  <span id="regtitle" >Update</span>
               </center>
                
               <div class="container-fluid contdiv1" >
                    <div class="row"  >
                     <div class="col-sm-6" id="empassportdiv">
                        <div class="form-group">
                            <input type="hidden" name="txthid_trid" value="<?php echo $qry[0]->traderID?>">
                         <div class="dropZoneContainer" id="profile">
                         <input type="file" id="profimg" name="profimg" class="FileUpload"  accept=".jpg,.png,.gif"/>
                         <input type="hidden" name="txthid_tr_primg" value="<?php echo $qry[0]->traderImage?>">
                         <?php
                                  if($qry[0]->traderImage != '')
                                  {
                                  ?>
                          <img id="prof_previmg" src="<?php echo $qry[0]->traderImage?>">
                          <?php
                                  }
                                  else
                                  {
                                      ?>
                          <img id="prof_previmg" src="<?php echo base_url()?>img/avatar.png">
                          <?php
                                  }
                                  ?>
<!--                         <i class="fa fa-camera cam" aria-hidden="true"></i>-->
                             
                           </div>
                           <!--input type="file" name="txtemrid"  class="reginputs"-->
                         <span class="errmsg"><?php echo form_error('profimg')?></span>
                        </div></div></div>
                  <div class="row" id="reg_main_row">
                     <div class="col-sm-6" >
                        <div class="form-group">
                           <label for="txtname">Full Name</label>
                           <input type="text" name="txtname" class="form-control reginputs" value="<?php echo $qry[0]->traderFullName?>">
                           <span class="errmsg"><?php echo form_error('txtname')?></span>
                        </div>
                     </div>
                     <div class="col-sm-6" >
                        <div class="form-group">
                            <label for="txtplace">Place</label>
                           <input type="text" name="txtplace"  class="form-control reginputs" value="<?php echo $qry[0]->traderLocation?>">
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
                                 foreach($codeqry as $r)
                                 {
                                     ?>
                              <option value="<?php echo $r->country_code?>"><?php echo $r->country_code?></option>
                              <?php } ?> 
                           </select>
                            <input type="text" name="txtmob" id="txtmob" class="form-control reginputs" maxlength="7" value="<?php echo $qry[0]->traderContactNum?>">
                           <span class="errmsg"><?php echo form_error('txtmob')?></span>
                          
                        </div>
                     </div>
                     <div class="col-sm-6" >
                        <div class="form-group">
                             <label for="txtemail">Email</label>
                           <input type="text" id="txtemail" name="txtemail" class="form-control reginputs" value="<?php echo $qry[0]->traderEmailID?>">
                           <span class="errmsg"><?php echo form_error('txtemail')?></span>
                          
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-6">
                        <div class="form-group">
                             <label for="txtuname">User Name</label>
                           <input type="text" id="txtuname" name="txtuname" class="form-control reginputs" value="<?php echo $qry[0]->traderUserName?>">
                           <span class="errmsg"><?php echo form_error('txtuname')?></span>
                           
                        </div>
                     </div>
                     <div class="col-sm-6" >
                        <div class="form-group">
                            <label for="txtpassword">Password</label>
                           <input type="text" name="txtpassword" id="txtpassword" class="form-control reginputs" value="<?php echo $qry[0]->traderPasswd?>">
                           <span class="errmsg"><?php echo form_error('txtpassword')?></span>
                          
                        </div>
                     </div>
                  </div>
                   <div class="row"><div class="col-sm-6">
                        <div class="form-group">
                            <label for="txtconfpassword">Confirm Password</label>
                           <input type="text" name="txtconfpassword"  class="form-control reginputs" value="<?php echo $qry[0]->traderPasswd?>">
                           <span class="errmsg"><?php echo form_error('txtconfpassword')?></span>
                        </div>
                     </div></div>
                  <div class="row"  >
                     <div class="col-sm-6" id="empassportdiv">
                        <div class="form-group">
                           <div id="emlbdiv">
                              <label id="lbl_attach" for="traderIDProof">Attach any ID(Emirates id or Passport)</label>
                           </div>
                           <div class="dropZoneContainer" id="drop_emir1">
                               
                              <input type="file" id="drop_emzone1" name="traderIDProof" class="FileUpload" accept=".jpg,.png,.gif"/>
                              <input type="hidden" name="txthid_tr_emimg1" value="<?php echo $qry[0]->traderIDProof?>">
                              <div class="emdropZoneOverlay">
                                  <?php
                                  if($qry[0]->traderIDProof != '')
                                  {
                                  ?>
                                  <img id="em1_previmg" src="<?php echo $qry[0]->traderIDProof?>">
                                  <?php
                                  }
                                  else
                                  {
                                  ?>
                                    <img id="em1_previmg" src="<?php echo base_url()?>img/register-attachment1.png">
                                    <?php
                                  }
                                  ?>
<!--                                 <i class="fa fa-paperclip atticon" aria-hidden="true"></i>-->
                                  <span class="errmsg"><?php echo form_error('traderIDProof')?></span>
                              </div>
                           </div>
                           <!--input type="file" name="txtemrid"  class="reginputs"-->
                         
                         
                        </div>
                         
                     </div>
                            <div class="col-sm-6" id="empassportdiv">
                        <div class="form-group" >
                          
                           <div class="dropZoneContainer" id="drop_emir2" >
                              <input type="file" id="drop_emzone22" name="traderIDsecond" class="FileUpload" accept=".jpg,.png,.gif" />
                              <input type="hidden" name="txthid_tr_emimg2" value="<?php echo $qry[0]->traderIDProofsecond?>">
                              <div class="emdropZoneOverlay">
                                  <?php
                                  if($qry[0]->traderIDProofsecond != '')
                                  {
                                  ?>
                                   <img id="em2_previmg" src="<?php echo $qry[0]->traderIDProofsecond?>">
                                   <?php
                                  }
                                  else
                                  {
                                  ?>
                                    <img id="em2_previmg" src="<?php echo base_url()?>img/register-attachment2.png">
                                    <?php
                                  }
                                  ?>
<!--                                 <i class="fa fa-paperclip atticon" aria-hidden="true"></i>-->
                                     <span class="errmsg" id="secem_img"><?php echo form_error('traderIDsecond')?></span>
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
                         <textarea class="form-control" name="txtabout" rows="5"><?php echo $qry[0]->traderInfo?></textarea>
                         <span class="errmsg"><?php echo form_error('txtabout')?></span>
                    </div>
                  </div>
                  <div class="col-sm-6" >
                     <div class="form-group">
                        <label for="txtweblink">Website Link</label>
                        <input type="text"  name="txtweblink" class="form-control reginputs" value="<?php echo $qry[0]->socialWeb?>">
                        <span class="errmsg"><?php echo form_error('txtweblink')?></span>
                     </div>
                  </div>
                  <div class="col-sm-6" >
                     <div class="form-group">
                        <label for="txtfblink">Facebook Link</label>
                        <input type="text"  name="txtfblink" class="form-control reginputs" value="<?php echo $qry[0]->socialFb?>">
                        <!--input type="text" name="txtemexpdate" class="form-control datepicker reginputs" placeholder="dd-mm-yyyy" value=""-->
                        <span class="errmsg"><?php echo form_error('txtfblink')?></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-6" >
                     <div class="form-group">
                        <label for="txtinstlink">Instagram Link</label>
                        <input type="text" name="txtinstlink" class="form-control reginputs" value="<?php echo $qry[0]->socialInsta?>">
                        <span class="errmsg"><?php echo form_error('txtinstlink')?></span>
                     </div>
                  </div>
                  <div class="col-sm-6" >
                     <div class="form-group">
                        <label for="txtsnapclink">Snapchat Link</label>
                        <input type="text"  name="txtsnapclink" class="form-control  reginputs" value="<?php echo $qry[0]->socialSnap?>"/> 
                        <span class="errmsg"><?php echo form_error('txtsnapclink')?></span>
                     </div>
                  </div>
                    <div class="col-sm-6" >
                     <div class="form-group">
                        <label for="txttwitter">Twitter Link</label>
                        <input type="text"  name="txttwitter" class="form-control  reginputs" value="<?php echo $qry[0]->socialtwitter?>"/> 
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
           readem1URL(this);
       });
       $('#drop_emzone22').change(function(){
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