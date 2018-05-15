<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- -------- Icon -------- -->
<link rel="icon" type="image/x-icon" href="<?php echo base_url();?>/assets/favicon.ico">

<!-- -------- Title -------- -->
<title>Al-Shamil</title>

<!-- -------- Bootstrap CSS -------- -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
    crossorigin="anonymous">
  <!--  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/sb-admin.css" rel="stylesheet"> -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/sweetalert.css" />
<!-- -------- Custom CSS -------- -->
<!-- For global styles -->

    <link id="pagestyle" rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/default.css" />

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/styles.css">
    <style type="text/css">
    	body{
    		background-color: #3b3333;
    	}
    </style>
</head>

<body>

	</body>
</html>
      <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
<!--                 <button type="button" class="close" data-dismiss="modal">&times;</button>
 -->                <center>
                    <h5 id="adm_regtitle">Login</h5>
                </center>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url();?>admin/login" method="post">
                    <!--<form action="<?php echo base_url();?>LoginController/login_get" method="post">-->
                    <div class="">
                        <div class="row">
                            <div class="col-sm-12">

                                <div class="container-fluid contdiv1" id="">
                                	<?php
                                	if(isset($message)){
                                	?>
                                <p style="color: Red;"><?= $message;?></p>
                                <?php } ?>
                                    <!-- <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label for="txtemail">User Type</label>
                                                <select class="form-control reginputs2" name="txtusertype">
                                                    <option value="1">Trader</option>
                                                    <option value="0">Customer</option>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('txtemail'); ?></span>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label for="txtemail">UserName</label>
                                                <input type="email" name="txtemail" class="form-control reginputs2" placeholder="UserName" required="">
                                                <span class="text-danger"><?php echo form_error('txtemail'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label for="txtpassword">Password</label>
                                                <input type="password" name="txtpassword" class="form-control reginputs2" placeholder="Password" required="">
                                                <span class="text-danger"><?php echo form_error('txtpassword'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div>
                                                <button type="submit" class="btn btn-default btnlogs" id="btnlognext">Login</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="row">
                                        <div class="col-sm-8">
                                            <div>
                                                <p class="change_link" style="text-align:center">

                                                    <a onclick="forgetpassword()" class="to_register sign">Forgot Password?</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                      </div>  
                        <!-- end container -->
                        <!-- end section -->

                </form>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div> -->
            </div>

        </div>
    </div>


   <div id="forgotpasswrd" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
<!--                 <button type="button" class="close" data-dismiss="modal">&times;</button>
 -->                <center>
                    <h5 id="adm_regtitle">Forgot Password</h5>
                </center>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url();?>admin/forgotpassword" method="post">
                    <!--<form action="<?php echo base_url();?>LoginController/login_get" method="post">-->
                    <div class="">
                        <div class="row">
                            <div class="col-sm-12">

                                <div class="container-fluid contdiv1" id="">
                                	<?php
                                	if(isset($message)){
                                	?>
                                <p style="color: Red;"><?= $message;?></p>
                                <?php } ?>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label for="txtemail">UserName</label>
                                                <input type="email" name="txtemail" class="form-control reginputs2" placeholder="UserName" required="">
                                                <span class="text-danger"><?php echo form_error('txtemail'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div>
                                                <button type="submit" class="btn btn-default btnlogs" id="btnlognext">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div>
                                                <p class="change_link" style="text-align:center">

                                                    <!-- <a href="<?php echo base_url();?>Trader/signup" class="to_register signup">Sign Up</a> -->
                                                    <a onclick="login()" class="to_register sign">Login?</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                      </div>  
                        <!-- end container -->
                        <!-- end section -->

                </form>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div> -->
            </div>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/sweetalert.min.js"></script>
            
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    


 <script type="text/javascript">
 	
$(function() {
	login();
	});

 	function forgetpassword(){
 		$("#myModal").css('display','none');
 	$(".fade").css('opacity','1');
 	$(".modal-dialog").css('margin-top','200px');
 	$("#forgotpasswrd").css('display','inline');
 	}
 	function login(){
 		$("#forgotpasswrd").css('display','none');
 		$( "#spsign" ).trigger( "click" );
	 	$("#myModal").css('display','block');
	 	$(".fade").css('opacity','1');
	 	$(".modal-dialog").css('margin-top','200px');
 	}
 </script>