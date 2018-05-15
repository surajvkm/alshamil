<?php echo $this->session->flashdata('msg');?>
<form  method="post" id="my_form" action="<?php echo base_url();?>Trader/update_trader_register" enctype="multipart/form-data">
   <!-- start section -->
   <section class="section white-background regsecdiv1">
        <div class="container">
            <div class="row">
                <div class="col-sm-12" >
                    <center>
                        <span class="regtitle" >Update Profile</span>
                    </center>
                   
                    <div class="col-sm-11 col-sm-offset-2 col-md-6 col-md-offset-3 px-0">
                        <center>
                            <input type="hidden" name="txthid_trid" value="<?php echo $qry[0]->traderID ?>">
                            <div class="row profile">
                                <input type="file" id="profimg" name="profimg" class="userProffile"  accept=".jpg,.png,.gif"/>
                                <input type="hidden" id="txthid_tr_primg" name="txthid_tr_primg" value="<?php echo $qry[0]->traderImage ?>">
                                <?php
                                if ($qry[0]->traderImage != '') {
                                    ?>
                                    <img id="prof_previmg" src="<?php echo $qry[0]->traderImage ?>">
                                    <?php
                                } else {
                                    ?>
                                    <img id="prof_previmg" src="<?php echo base_url() ?>img/avatar.png">
                                    <?php
                                }
                                ?>
                            </div>
                            <span class="errmsg"><?php echo form_error('profimg') ?></span>    
                            <label id="err_profimg" class="txt_errors">Please Select Your Profile Image</label>
                        </center>
                        <div class="col-sm-12">
                            <div class="col-xs-6 col-sm-6 col-md-6 pl-xs-0">
                                <div class="form-group">
                                    <label for="txtname">Full Name</label>
                                    <input type="text" id="txtname" name="txtname" class="form-control placeholder-font" value="<?php echo $qry[0]->traderFullName ?>">
                                   <label id="err_txtname" class="txt_errors">Please Select Your full Name</label>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 pr-xs-0">
                                <div class="form-group">
                                    <label for="txtplace">Place</label>
<!--                                    <input type="text" name="txtplace"  id="txtplace"  class="form-control" value="<?php echo $qry[0]->traderLocation ?>">-->
                                    <input  type="hidden" id="txthidotherplace" value="<?php echo $qry[0]->traderLocation?>">
                                    <select name="txtplace" id="txtplace" class="form-control placeholder-font">
                                    <option value="">Select</option>
                                    <option value="Dubai" <?php if($qry[0]->traderLocation == 'Dubai') echo 'selected'?> >Dubai</option>
                                   <option value="Abudhabi" <?php if($qry[0]->traderLocation == 'Abudhabi') echo 'selected'?>>Abudhabi</option>
                                    <option value="Sharjah" <?php if($qry[0]->traderLocation == 'Sharjah') echo 'selected'?>>Sharjah</option>
                                    <option value="Ajman" <?php if($qry[0]->traderLocation == 'Ajman') echo 'selected'?>>Ajman</option>
                                    <option value="Fujairah" <?php if($qry[0]->traderLocation == 'Fujairah') echo 'selected'?>>Fujairah</option>
                                    <option value="RAK" <?php if($qry[0]->traderLocation == 'RAK') echo 'selected'?>>RAK</option>
                                    <option value="Umm Alquwain" <?php if($qry[0]->traderLocation == 'Umm Alquwain') echo 'selected'?>>Umm Alquwain</option>
                                    <option value="Al Ain" <?php if($qry[0]->traderLocation == 'Al Ain') echo 'selected'?>>Al Ain</option>
                                    <option value="Other">Other</option>
                                </select>
                                    <span class="errmsg"><?php echo form_error('txtplace') ?></span>

                                </div>
                            </div> 
                            <div class="col-xs-6 col-sm-6 col-md-6 pl-xs-0" >
                                <div class="form-group">
                                    <label for="txtmob">Mobile Number</label>
                                    <?php $a = explode('-', $qry[0]->traderContactNum); ?>
                                     <input type="hidden" id="hid_editcountry" value="<?php echo $a[0]; ?>" >
                                    <input type="hidden" id="hid_country_code" name="txt_countrycode">
                                    <input id="phone" type="tel" name="txtmob" class="form-control placeholder-font" maxlength="13" minlength="5" value="<?php echo $a[1]; ?>">
                                    <span class="errmsg"><?php echo form_error('txtmob') ?></span>

                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 pr-xs-0">
                                <div class="form-group">
                                    <label for="txtemail">Email</label>
                                    <input type="text" id="txtemail" name="txtemail" class="form-control placeholder-font" value="<?php echo $qry[0]->traderEmailID ?>"readonly>
                                    <span class="errmsg"><?php echo form_error('txtemail') ?></span>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 pl-xs-0">
                                <div class="form-group">
                                    <label for="txtuname">Username</label>
                                    <input type="text" id="txtuname" name="txtuname" class="form-control placeholder-font" value="<?php echo $qry[0]->traderUserName ?>" readonly>
                                    <span class="errmsg"><?php echo form_error('txtuname') ?></span>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 pr-xs-0">
                                <div class="form-group">
                                    <br><br>
                                    <a  onclick="show_password_modal()" class="pass_up_anc" >Change Password</a>
                                    <?php echo form_error('txtpassword') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 pl-xs-0">
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <input type="hidden" name="txthid_tr_emimg1" value="<?php echo $qry[0]->traderIDProof ?>">
                                    <div class="dropZoneContainer" readonly id="drop_emir1">
                                        <input type="file" readonly id="drop_emzone1" name="traderIDProof" class="FileUpload" accept=".jpg,.png,.gif"/>
                                        <?php
                                        if ($qry[0]->traderIDProof != '') {
                                        ?>
                                        <img id="em1_previmg" src="<?php echo $qry[0]->traderIDProof ?>">
                                        <?php
                                        } else {
                                        ?>
                                        <img id="em1_previmg" src="<?php echo base_url() ?>img/register-attachment1.png">
                                        <?php
                                        }
                                        ?>
                                        <span class="errmsg"><?php echo form_error('traderIDProof') ?></span> 
                                    </div>
                                </div> 
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                <!--Change-->
                                <input type="hidden" name="txthid_tr_emimg2" value="<?php echo $qry[0]->traderIDProofsecond ?>" >
                                <div class="dropZoneContainer" readonly id="drop_emir2">
                                    <input type="file" readonly id="drop_emzone22" name="traderIDProofSecond" class="FileUpload" accept=".jpg,.png,.gif"/>
                                    <?php
                                    if ($qry[0]->traderIDProofsecond != '') {
                                        ?>
                                        <img id="em2_previmg" src="<?php echo $qry[0]->traderIDProofsecond ?>">
                                        <?php
                                    } else {
                                        ?>
                                        <img id="em2_previmg" src="<?php echo base_url() ?>img/register-attachment2.png">
                                        <?php
                                    }
                                    ?>
                                    <span class="errmsg"><?php echo form_error('traderIDProofsecond') ?></span> 
                                </div>
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
                                <textarea class="form-control" id="txtregabout" name="txtabout" rows="5"><?php echo $qry[0]->traderInfo ?></textarea>
                                <span class="errmsg"><?php echo form_error('txtabout') ?></span>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6" >
                            <div class="form-group">
                                <label for="txtweblink">Website Link</label>
                                <input type="text"  name="txtweblink" class="form-control" value="<?php echo $qry[0]->socialWeb ?>">
                                <span class="errmsg"><?php echo form_error('txtweblink') ?></span>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6" >
                            <div class="form-group">
                                <label for="txtfblink">Facebook Link</label>
                                <input type="text"  name="txtfblink" class="form-control" value="<?php echo $qry[0]->socialFb ?>">
                                <!--input type="text" name="txtemexpdate" class="form-control datepicker reginputs" placeholder="dd-mm-yyyy" value=""-->
                                <span class="errmsg"><?php echo form_error('txtfblink') ?></span>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6" >
                            <div class="form-grou">
                                <label for="txtinstlink">Instagram Link</label>
                                <input type="text" name="txtinstlink" class="form-control" value="<?php echo $qry[0]->socialInsta ?>">
                                <span class="errmsg"><?php echo form_error('txtinstlink') ?></span>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6" >
                            <div class="form-group">
                                <label for="txtsnapclink">Snapchat Link</label>
                                <input type="text"  name="txtsnapclink" class="form-control" value="<?php echo $qry[0]->socialSnap ?>"/> 
                                <span class="errmsg"><?php echo form_error('txtsnapclink') ?></span>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6" >
                            <div class="form-group">
                                <label for="txttwitter">Twitter Link</label>
                                <input type="text"  name="txttwitter" class="form-control" value="<?php echo $qry[0]->socialtwitter ?>"/> 
                                <span class="errmsg"><?php echo form_error('txttwitter') ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                    </div>
                    <div class="col-sm-12" >
                        <div class="col-sm-4 col-md-4"></div>
                        <div class="col-sm-4 col-md-4"><br><button type="submit" class="btn btn-default" id="btnnext">UPDATE</button><br><br><br></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end container -->
    </section>
    <!-- end section -->
</form>

    <div id="passwordModal" class="modal fade"> 
        <div class="modal-dialog edit_passmod">  
            <div class="modal-content edit_passmodcon">  
                <div class="modal-header" id="flagmheader">  
                    <button type="button" class="close" data-dismiss="modal">&times;</button>  
                </div>  
                <div class="modal-body" id="trader_detail"> 
                Current Password<br>
                    <input type="password" id="modal_current_pass"><br><br>
                    New Password<br>
                    <input type="password" id="modal_pass"><br><br>
                    Confirm Password<br>
                    <input type="password" id="modal_conf_pass"><br>
                    <input type="hidden" id="hid_traderid" value="<?php echo $qry[0]->traderID ?>">

                </div>  <br>
                <div class="modal-footer" id="flagmfooter">  
                    <button type="submit" class="btn btn-default" id="btn_update_pass_modal" data-dismiss="modal">UPDATE</button>  
                </div>  
            </div>  
        </div>
    </div> 
<!--loading modal for entering other country name-->
<div id="otherplaceModal" class="modal fade"> 
        <div class="modal-dialog edit_passmod">  
            <div class="modal-content edit_passmodcon">  
                <div class="modal-header" id="flagmheader">  
                    <button type="button" class="close" data-dismiss="modal">&times;</button>  
                </div>  
                <div class="modal-body" id="trader_detail"> 
                    Enter Place<br>
                    <input type="text" id="txtnewplace"><br><br>
                    

                </div>  <br>
                <div class="modal-footer" id="flagmfooter">  
                    <button type="button" class="btn btn-default" id="btnAddPlaceModal" data-dismiss="modal">ADD</button>  
                </div>  
            </div>  
        </div>
    </div> 
<!--loading modal for entering other country name-->
<script>
     function show_password_modal()
     {
        $('#passwordModal').modal("show");
     }
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
       var editCountryCode = $('#hid_editcountry').val();
      
       $('.selected-flag').attr('title',editCountryCode);
      var hidOtherPlace = $('#txthidotherplace').val();
      if((hidOtherPlace!= 'Dubai')||(hidOtherPlace!= 'UAE')||(hidOtherPlace!= 'Oman')){
         $('#txtplace').append($('<option>', {
                value: hidOtherPlace,
                text: hidOtherPlace,
                selected:true
            }));
      }
       $('#txtplace').change(function(){
            var placeVal = $(this).val();
            if(placeVal == 'Other')
            {
                $('#otherplaceModal').modal("show");
            }
            
        });
        $('#btnAddPlaceModal').click(function(){
            var newPlace = $('#txtnewplace').val();
            $('#txtplace').append($('<option>', {
                value: newPlace,
                text: newPlace,
                selected:true
            }));
            
            
        });
       $('[data-toggle="tooltip"]').tooltip(); 
       $("#phone").blur(function(){
           var t = $('.selected-flag').attr('title');
           var res = t.split(":");
          //alert(res[1]); 
          $('#hid_country_code').val(res[1]);
          //alert($('.selected-flag').attr('title')); 
       });
       $("#phone").intlTelInput({
      // allowDropdown: false,
      // autoHideDialCode: false,
      // autoPlaceholder: "off",
      // dropdownContainer: "body",
      // excludeCountries: ["us"],
      // formatOnDisplay: false,
      // geoIpLookup: function(callback) {
      //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      //     var countryCode = (resp && resp.country) ? resp.country : "";
      //     callback(countryCode);
      //   });
      // },
      // hiddenInput: "full_number",
      // initialCountry: "auto",
      // nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
      // placeholderNumberType: "MOBILE",
      // preferredCountries: ['cn', 'jp'],
      // separateDialCode: true,
      utilsScript: "js/utils.js"
    });
      /* $('#btnnext').click(function () {

            var profimg =$('#txthid_tr_primg').val();
            var txtname = $('#txtname').val();
            var txtplace = $('#txtplace').val();
            var phone = $('#phone').val();
            var txtemail = $('#txtemail').val();
            var txtpassword = $('#txtpassword').val();
            var txtconfpassword = $('#txtconfpassword').val();
            var txtregabout =$('#txtregabout').val();
            var txtweblink=$('#txtweblink').val();
            var txtsnapclink=$('#txtsnapclink').val();
            var txtinstlink=$('#txtinstlink').val();
            var txttwitter=$('#txttwitter').val();
            var txtfblink=$('#txtfblink').val();
            var drop_emzone1=$('#drop_emzone1').val();
            var drop_emzone2=$('#drop_emzone22').val();
            var pat_url = /^(http|https|ftp):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i;
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
           var passreg = /^[A-Z]{1}[0-9a-z]{5}$/;
               
           if ((profimg == '') ||(txtname == '') || (txtplace == '') || (phone == '') || (txtemail == '') || (txtpassword == '') || (txtconfpassword == '')||(txtregabout=='')||(drop_emzone1=='')||(drop_emzone2==''))
            {
                 if (profimg == '')
                {

                    $('#err_profimg').css('display', 'block');

                }else{
                   $('#err_profimg').css('display', 'none');   
                }
                if (txtname == '')
                {

                    $('#err_txtname').css('display', 'block');

                }else{
                     $('#err_txtname').css('display', 'none');
                }
                if (txtplace == '')
                {

                    $('#err_txtplace').css('display', 'block');

                }else{
                   $('#err_txtplace').css('display', 'none');  
                }
                if (phone == '')
                {

                    $('#err_txtmob').css('display', 'block');
                   
                }else{
                  $('#err_txtmob').css('display', 'none');   
                }
                 
                 
                if (txtemail == '')
                {

                    $('#err_txtemail').css('display', 'block');

                }else{
                    $('#err_txtemail').css('display', 'none'); 
                  
                }

                

                if (txtpassword == '')
                {

                    $('#err_txtpassword').css('display', 'block');

                }
                else{
                    $('#err_txtpassword').css('display', 'none'); 
                  
                 
                }
                  if (drop_emzone1 == '')
                {

                    $('#err_drop_emzone1').css('display', 'block');

                }
                else{
                    $('#err_drop_emzone1').css('display', 'none'); 
                  
                 
                }
                if (drop_emzone2 == '')
                {

                    $('#err_drop_emzone2').css('display', 'block');

                }
                else{
                    $('#err_drop_emzone2').css('display', 'none'); 
                  
                 
                }
               if (txtconfpassword == '')
                {

                    $('#err_txtconfpassword').css('display', 'block');

                }else{
                  $('#err_txtconfpassword').css('display', 'none');  
                }
                 if (txtregabout == '')
                {

                    $('#err_txtregabout').css('display', 'block');

                }else{
                   $('#err_txtregabout').css('display', 'none');  
                }
          
            } else{ 
              
           
               
            if((!(regex.test($("#txtemail").val())))||(!(passreg.test(txtpassword)))||(txtpassword != txtconfpassword)||((txtweblink!='')&&!(pat_url.test($("#txtweblink").val())))||((txtsnapclink!='')&&!(pat_url.test($("#txtsnapclink").val())))||((txtinstlink!='')&&!(pat_url.test($("#txtinstlink").val())))||((txttwitter!='')&&!(pat_url.test($("#txttwitter").val())))||((txtfblink!='')&&!(pat_url.test($("#txtfblink").val())))){
               
             var counter=0;
                if(!(regex.test($("#txtemail").val()))){
                    $('#err_txtemailinavlid').css('display', 'block');
                }else{
                   $('#err_txtemailinavlid').css('display', 'none');   
                }
            
               
                
                if(!(passreg.test(txtpassword))){
                    counter += 1;
                }
                if(counter>0){
                    $('#err_txtpasswordstrength').css('display', 'block');
                    
                }else{
                    $('#err_txtpasswordstrength').css('display', 'none');
                   
                }
                if(txtpassword != txtconfpassword)
                {
                     $('#err_txtconfpasswordmsg').css('display', 'block');
                }
                else{
                    $('#err_txtconfpasswordmsg').css('display', 'none');
                }
                if((txtweblink!='')&&(!(pat_url.test($("#txtweblink").val())))){
                    $('#err_txtweblink').css('display', 'block');
                } else{
                    $('#err_txtweblink').css('display', 'none'); 
                }
                if((txtsnapclink!='')&&(!(pat_url.test($("#txtsnapclink").val())))){
                    $('#err_txtsnapclink').css('display', 'block');
                } else{  
                    $('#err_txtsnapclink').css('display', 'none');
                }
                if((txtinstlink!='')&&(!(pat_url.test($("#txtinstlink").val())))){
                    $('#err_txtinstlink').css('display', 'block');
                } else{
                    $('#err_txtinstlink').css('display', 'none');  
                }
                if((txttwitter!='')&&(!(pat_url.test($("#txttwitter").val())))){
                    $('#err_txttwitter').css('display', 'block');
                } else{
                    $('#err_txttwitter').css('display', 'none');     
                }
                if((txtfblink!='')&&(!(pat_url.test($("#txtfblink").val())))){
                    $('#err_txtfblink').css('display', 'block');
                } else{
                    $('#err_txtfblink').css('display', 'none');   
                }
                  
             
            }else{
               alert("success");return false;
                $('#btnnext').prop('disabled',true);
                var form = $('#myForm')[0];
                var formData = new FormData(form);


                $.ajax({
                    url: "<?php echo base_url('Trader/save_trader_register'); ?>",
                     data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    type: "POST",

                    success: function (data) {
                     $("#postForm").submit();
                    }

                });
            }
            }

        });*/
       $('#modal_pass').blur(function(){
      var res = $(this).val();
      var p = /(?=.*[A-Z]).{6,}/;
      
      if(!(p.test(res)))
      {
       
        swal("Error !","Password must be at least 6 characters and must contain one uppercase character ");
      }
      

       });
       $('#btn_update_pass_modal').click(function(){
           var current_password = $('#modal_current_pass').val();
           var password = $('#modal_pass').val();
           var trader_id = $('#hid_traderid').val();
           var conf_pass = $('#modal_conf_pass').val();
           var res = $(this).val();
      var p = /(?=.*[A-Z]).{6,}/;
      
      if(!(p.test(password)))
      {
       
        swal("Error !","Password must be at least 6 characters and must contain one uppercase character ",'error');
      }
           if(password =='')
           {
             
               swal("Error !","Password must be at least 6 characters and must contain one uppercase character ",'error');
           }
           else if(password != conf_pass)
           {
             
               swal("Error !","Password field does not matches",'error');
           }
           else
           {
               
                $.ajax({
                    url: "<?php echo base_url(); ?>Trader/trader_update_pass",
                    data: {'password': password, 'trader_id': trader_id,'current_password': current_password},
                    type: "POST",

                    success: function (data) {
                       
                        if (data == 'success')
                        {
                          $('#modal_current_pass').val('');
                          $('#modal_pass').val('');
                          $('#modal_conf_pass').val('');
                            swal("Your Password has been Updated Successfully");
                            

                        } else
                        {
                            swal("Failed to update password, check current password");
                        }
                    }
                });
           }   
       });


       $("#em2_previmg").click(function() {
             
           //     $("#drop_emzone22").click();
            });
       $("#em1_previmg").click(function() {
          
         //   $("#drop_emzone1").click();
        });
        $('#prof_previmg').click(function() {
            $("#profimg").click();
        });
       $('#drop_emzone1').change(function(){
       //    readem1URL(this);
       });
       $('#drop_emzone22').change(function(){
        //   readem2URL(this);
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
       $("#phone").keydown(function (e) {
                var max_chars =10;
        // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    // Allow: Ctrl+A, Command+A
                    (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
                    // Allow: home, end, left, right, down, up
                    (e.keyCode >= 35 && e.keyCode <= 40)) {
           
                 // let it happen, don't do anything
                 return;
        }else{
            
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
         
            e.preventDefault();
        }else{
            if ($(this).val().length >= max_chars) { 
                        e.preventDefault();
                        swal('5 - 13 charecters  are allowed','','error');
            }
        }
    
              
    });
    $('#phone').focusout(function () {
    
        var mobno = $(this).val();
                var p = /(?=.{5,})/;
                
                if(!(p.test(mobno)))
                {
                 
                  swal("Error !","Mobile Number must be  5 - 13 characters ",'error');
                }
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