<?php echo $this->session->flashdata('msg'); ?>
<form  method="post" id="my_form" action="<?php echo base_url();?>Trader/register" enctype="multipart/form-data">
   <!-- start section -->
   <section class="section white-background regsecdiv1">
      <div class="container">
         <div class="row">
            <div class="col-sm-12" >
               <center>
                  <h5 id="regtitle" >Register</h5>
               </center>
               <div class="container-fluid contdiv1" >
                  <div class="row">
                     <div class="col-sm-6" >
                        <div class="form-group">
                           <label for="txtname">Full Name</label>
                           <input type="text" name="txtname" class="form-control reginputs" required="">
                           <span class="errmsg"><?php echo form_error('txtname')?></span>
                        </div>
                     </div>
                     <div class="col-sm-6" >
                        <div class="form-group">
                           <label for="txtmob">Mobile Number</label>
                           <select id="coun_code">
                              <?php
                                 foreach($qry as $r)
                                 {
                                     ?>
                              <option value="<?php echo $r->country_code?>"><?php echo $r->country_code?></option>
                              <?php } ?> 
                           </select>
                           <input type="text" name="txtmob" id="txtmob" class="form-control reginputs" required="">
                           <span class="errmsg"><?php echo form_error('txtmob')?></span>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-6" >
                        <div class="form-group">
                           <label for="txtemail">Email</label>
                           <input type="text" id="txtemail" name="txtemail" class="form-control reginputs" required="">
                           <span class="errmsg"><?php echo form_error('txtemail')?></span>
                        </div>
                     </div>
                     <div class="col-sm-6" >
                        <div class="form-group">
                           <label for="txtuname">User Name</label>
                           <input type="text" id="txtuname" name="txtuname" class="form-control reginputs" required="">
                           <span class="errmsg"><?php echo form_error('txtuname')?></span>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-6" >
                        <div class="form-group">
                           <label for="txtpassword">Password</label>
                           <input type="password" name="txtpassword" id="txtmob" class="form-control reginputs" required="">
                           <span class="errmsg"><?php echo form_error('txtpassword')?></span>
                        </div>
                     </div>
                     <div class="col-sm-6" >
                        <div class="form-group">
                           <label for="txtconfpassword">Confirm Password</label>
                           <input type="password" name="txtconfpassword"  class="form-control reginputs" required="">
                           <span class="errmsg"><?php echo form_error('txtconfpassword')?></span>
                        </div>
                     </div>
                  </div>
                  <div class="row"  >
                     <div class="col-sm-6" id="empassportdiv">
                        <div class="form-group">
                           <div id="emlbdiv">
                              <label for="traderIDProof">Attach any ID(Emirates id or Passport)</label>
                           </div>
                           <div class="dropZoneContainer" id="drop_emir">
                              <input type="file" id="drop_emzone" name="traderIDProof" class="FileUpload" accept=".jpg,.png,.gif" required="" />
                              <div class="emdropZoneOverlay">
                                 <i class="fa fa-paperclip atticon" aria-hidden="true"></i>
                              </div>
                           </div>
                           <!--input type="file" name="txtemrid"  class="reginputs"-->
                         <span class="errmsg"><?php echo form_error('traderIDProof')?></span>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-6" >
                        <hr class="reghr" id="emhr">
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
                  <div class="col-sm-6" >
                     <div class="form-group">
                        <label for="txtweblink">Website Link</label>
                        <input type="text"  name="txtweblink" class="form-control reginputs" required="">
                        <span class="errmsg"><?php echo form_error('txtweblink')?></span>
                     </div>
                  </div>
                  <div class="col-sm-6" >
                     <div class="form-group">
                        <label for="txtfblink">Facebook Link</label>
                        <input type="text"  name="txtfblink" class="form-control reginputs" required="">
                        <!--input type="text" name="txtemexpdate" class="form-control datepicker reginputs" placeholder="dd-mm-yyyy" value=""-->
                        <span class="errmsg"><?php echo form_error('txtfblink')?></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-6" >
                     <div class="form-group">
                        <label for="txtinstlink">Instagram Link</label>
                        <input type="text" name="txtinstlink" class="form-control reginputs" required="">
                        <span class="errmsg"><?php echo form_error('txtinstlink')?></span>
                     </div>
                  </div>
                  <div class="col-sm-6" >
                     <div class="form-group">
                        <label for="txtsnapclink">Snapchat Link</label>
                        <input type="text"  name="txtsnapclink" class="form-control  reginputs" required=""/> 
                        <span class="errmsg"><?php echo form_error('txtsnapclink')?></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-6" >
                     <hr class="reghr">
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
   $(document).ready(function(){
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