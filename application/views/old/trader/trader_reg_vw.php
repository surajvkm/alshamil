<?php echo $this->session->flashdata('msg'); ?>
<!--<form  method="post" id="my_form" action="<?php echo base_url();?>Trader/save_trader_register" enctype="multipart/form-data">-->
   <!-- start section -->
   <form id="postForm" action="<?php echo base_url();?>Trader/plans"></form>
   <form  id="myForm"  enctype="multipart/form-data">
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
                                <img id="prof_previmg" src="<?php echo base_url() ?>img/avatar.png">
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
                                <input type="hidden" id="hid_country_code" name="txt_countrycode">
                                <input id="phone" type="text"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'  name="txtmob"  class="form-control" maxlength="13" minlength="5">
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
                                    <img id="em1_previmg" src="<?php echo base_url() ?>img/register-attachment-1.png">
                                    <label id="err_drop_emzone1" class="txt_errors">Please upload your ID proof1</label>

                                </div>

                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="dropZoneContainer" id="drop_emir2" >
                                    <input type="file" id="drop_emzone22" name="traderIDsecond" class="FileUpload" accept=".jpg,.png,.gif" />
                                    <input type="hidden" name="txt_hidem2" id="txt_hidem2" value="<?php echo set_value('txt_hidem2') ?>">

                                    <img id="em2_previmg" src="<?php echo base_url() ?>img/register-attachment-2.png">
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
</form>
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
<!--loading modal for entering other country name-->
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
      //utilsScript: "js/utils.js"
    });
       $("#em2_previmg").click(function() {
             
                $("#drop_emzone22").click();
            });
       $("#em1_previmg").click(function() {
           
            
            $("#drop_emzone1").click();
        });
        /* $("#em_row").click(function() {
           
            
            $("#drop_emzone1").click();
        });*/
        $('#txtplace').change(function(){
            var placeVal = $(this).val();
            if(placeVal == 'Other')
            {
                $('#otherplaceModal').modal("show");
            }
            
        });
        $('.btnAddPlaceModal').click(function(){
			
            var newPlace = $('#txtnewplace').val();
            $('#txtplace').append($('<option>', {
                value: newPlace,
                text: newPlace,
                selected:true
            }));
            
            
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
       $("#phone").keypress(function (e)
       {
   
               if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    $('#err_txtmob').css('display', 'block');
//                         return false;
              }
       });
    //    $('#txtemail').keyup(function(){
    //        var email = $(this).val();
    //        $('#txtuname').val(email);
    //    })
        $('.datepicker').datepicker({
   
           format: 'dd/mm/yyyy' ,
           autoclose: true
       });
       
        $('#btnnext').click(function (e) {
            var profimg = $('#profimg').val();
            var txtuname = $('#txtuname').val();
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
		
          console.log(txtuname);
            var pat_url = /^(http|https|ftp):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i;
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var passreg = /(?=.*[A-Z]).{6,}/;
               
            if ((profimg == '')||(txtuname == '')  ||(txtname == '') || (txtplace == '') || (phone == '') || (txtemail == '') || (txtpassword == '') || (txtconfpassword == '')||(txtregabout=='')||(drop_emzone1=='')||(drop_emzone2==''))
            {
                 if (profimg == ''){
                    $('#err_profimg').css('display', 'block');
                }else{
                   $('#err_profimg').css('display', 'none');   
                }
                if (txtname == ''){
                    $('#err_txtname').css('display', 'block');
                }else{
                     $('#err_txtname').css('display', 'none');
                }
                if (txtplace == ''){
                    $('#err_txtplace').css('display', 'block');
                }else{
                   $('#err_txtplace').css('display', 'none');  
                }
                if (phone == ''){
                    $('#err_txtmob').css('display', 'block');
                }else{
                  $('#err_txtmob').css('display', 'none');   
                }
                if (txtemail == ''){
                  
                    $('#err_txtemail').css('display', 'block');
                }else{
                    $('#err_txtemail').css('display', 'none'); 
                }
                if (txtuname == ''){
  
                    $('#err_txtuname').css('display', 'block');
                }else{
                    $('#err_txtuname').css('display', 'none'); 
                }
                if (txtpassword == ''){
                    $('#err_txtpassword').css('display', 'block');
                }else{
                    $('#err_txtpassword').css('display', 'none'); 
                }
				if (drop_emzone1 == ''){
                    $('#err_drop_emzone1').css('display', 'block');
                }else{
                    $('#err_drop_emzone1').css('display', 'none'); 
                }
                if (drop_emzone2 == ''){
                    $('#err_drop_emzone2').css('display', 'block');
                }
                else{
                    $('#err_drop_emzone2').css('display', 'none'); 
                }
				if (txtconfpassword == ''){
                    $('#err_txtconfpassword').css('display', 'block');
                }else{
                  $('#err_txtconfpassword').css('display', 'none');  
                }
				if (txtregabout == ''){
                    $('#err_txtregabout').css('display', 'block');
                }else{
                   $('#err_txtregabout').css('display', 'none');  
                }
          
            } else{ 
                if((!regex.test($("#txtemail").val()))||(!passreg.test(txtpassword))||(txtpassword != txtconfpassword)||((txtweblink!='')&&!pat_url.test($("#txtweblink").val()))||((txtsnapclink!='')&&!pat_url.test($("#txtsnapclink").val()))||((txtinstlink!='')&&!pat_url.test($("#txtinstlink").val()))||((txttwitter!='')&&!pat_url.test($("#txttwitter").val()))||((txtfblink!='')&&!pat_url.test($("#txtfblink").val()))){
               
                
                        if(!(regex.test($("#txtemail").val()))){	
                            $('#err_txtemailinavlid').css('display', 'block');return false;
                	}else{
                   	$('#err_txtemailinavlid').css('display', 'none');   
                	}
                	if(!(passreg.test(txtpassword))){
                  	$('#err_txtpasswordstrength').css('display', 'block'); return false;
                	}else{
                    	$('#err_txtpasswordstrength').css('display', 'none');
                	}
                	if(txtpassword != txtconfpassword){
                     	$('#err_txtconfpasswordmsg').css('display', 'block');return false;
                	}else{
                    	$('#err_txtconfpasswordmsg').css('display', 'none');
                	}
                	if((txtweblink!='')&&(!pat_url.test($("#txtweblink").val()))){
                    	$('#err_txtweblink').css('display', 'block');return false;
                	} else{
                    	$('#err_txtweblink').css('display', 'none'); 
                	}
                	if((txtsnapclink!='')&&(!(pat_url.test($("#txtsnapclink").val())))){
                    	$('#err_txtsnapclink').css('display', 'block');return false;
                	} else{  
                    	$('#err_txtsnapclink').css('display', 'none');
                	}
                	if((txtinstlink!='')&&(!(pat_url.test($("#txtinstlink").val())))){
                    	$('#err_txtinstlink').css('display', 'block');return false;
                	} else{
                    	$('#err_txtinstlink').css('display', 'none');  
                	}
                	if((txttwitter!='')&&(!(pat_url.test($("#txttwitter").val())))){
                    	$('#err_txttwitter').css('display', 'block');return false;
                	} else{
                    	$('#err_txttwitter').css('display', 'none');     
                	}
                	if((txtfblink!='')&&(!(pat_url.test($("#txtfblink").val())))){
                    	$('#err_txtfblink').css('display', 'block');return false;
                	} else{
                    	$('#err_txtfblink').css('display', 'none');   
                	}
                    } else{
                            
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
        });
       
       
       
       
       
    
      
   });
    function emailcheck()
     {
         $('#checkemail').html('');

         var email = $('#txtemail').val();
         var data = 'txtemail='+email;
         $.ajax({
                    url: "<?php echo base_url('Trader/emailcheck'); ?>",
                    data: data,
                    type: "POST",
                    success: function (data) {
//                    console.log(data);
//                    alert (data);
                    $('#checkemail').html(data);
                      }

                });
     }
    
</script>