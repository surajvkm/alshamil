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
                    url: "<?php echo base_url(); ?>trader/update_pass",
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