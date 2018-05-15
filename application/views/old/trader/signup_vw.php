<!-- start section -->
<?php echo $this->session->flashdata('msg'); ?>
<!--<form action="<?php echo base_url();?>Trader/signup" method="post">-->
 <form id="postForm" action="<?php echo base_url();?>Trader/index"></form>
 <form  id="myForm"  enctype="multipart/form-data">
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
                        <button type="button"  class="btn btn-default btnlogs" id="btnlognext">Register</button>
                </div>
                <div class="col-sm-12">
                    <span><a href="<?php echo base_url(); ?>Trader/register" class="to_register signup">Register As Trader </a></span>
                    <span class="rating-rtl"><a href="<?php echo base_url(); ?>Trader/login_view" class="to_register sign">Sign In </a></span>
                    <br><br><br>
                </div>
            </div>
            <div class="col-sm-4"></div>
         </div>
      </div>
      <!-- end container -->
   </section>
   <!-- end section -->
</form>
<script>
   $(document).ready(function(){
   $('#btnlognext').click(function () {

            var Name =$('#Name').val();
            var txtemail = $('#txtemail').val();
            var txtpassword = $('#txtpassword').val();
            var txtconfpassword = $('#txtconfpassword').val();
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var passreg = /(?=.*[A-Z]).{6,}/;
            //var passreg = /^[A-Z]{1}[0-9a-z]{5}$/;
            
           if ((Name== '') ||(txtemail == '') || (txtpassword == '') || (txtconfpassword == ''))
            {
                 if (Name == '')
                {

                    $('#err_Name').css('display', 'block');

                }else{
                   $('#err_Name').css('display', 'none');   
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

                }else{
                   $('#err_txtpassword').css('display', 'none');  
                }
                if (txtconfpassword == '')
                {

                    $('#err_txtconfpassword').css('display', 'block');
                   
                }else{
                  $('#err_txtconfpassword').css('display', 'none');   
                }
               
              
            } else{ 
              
               if((txtpassword!='') &&(txtpassword != txtconfpassword )) {
               $('#err_txtconfpasswordmsg').css('display', 'block');
               } else {
                $('#err_txtconfpasswordmsg').css('display', 'none');
              } 
            
               
            
             if((!(regex.test($("#txtemail").val())))||(!(passreg.test(txtpassword)))||(txtpassword != txtconfpassword)){    
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
                
               
            
                }else{
                $('#btnlognext').prop('disabled',true);
                var form = $('#myForm')[0];
                var formData = new FormData(form);


                $.ajax({
                    url: "<?php echo base_url('Trader/signup'); ?>",
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