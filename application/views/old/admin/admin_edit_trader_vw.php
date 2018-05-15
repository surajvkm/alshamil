
<?php
$this->view('admin/admin_header'); 
?>
<!--script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="code/highstock.js"></script>
<script src="code/modules/exporting.js"></script-->

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">

                <?php
                $this->view('admin/admin_sidebar'); 
                ?>
                <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/custom/new-register.css">      
                <div class="col-main">
                    <div class="col-lg-12 col-12">
                    <h4 class="page-title mt-4 mb-2 pb-2 pt-2">Edit Profile</h4>
                    <?php echo $this->session->flashdata('msg'); ?>
                        <div class="row">
                                <div class="col-12">
                                <?php if(isset($result)){?>
                                    <form action="<?php echo base_url();?>admin/Dashboard/update_trader_register" enctype="multipart/form-data" method='POST'>
                                    <input type="hidden" name="txthid_trid" class="form-control input-custom" value="<?php echo set_value('txtname',$result->traderID)?>" placeholder="Ahmed Kabeer">
                                                                                     
                                        <div class="row">
                                            <div class="col-lg-8 mx-auto mt-2 mb-5">

                                                <!-- -------------- User Image -------------- -->
                                                <div class="row mb-lg-4">
                                                    <div class="col-lg-6 mx-auto">
                                                        <div class="col-12 text-center">
                                                            <div class="card pic-card mx-auto">
                                                                <div class="h-100">
                                                              
                                           
                                                                    <input type="file" id="profimg" name="profimg" class="custom-file-input h-100 FileUpload"  accept=".jpg,.png,.gif"/>
                                                                   <img id="admin_prof_previmg" src="<?php echo $result->traderImage; ?>">  
                                                                   <input type="hidden" name="txthid_tr_primg" class="custom-file-input h-100 FileUpload" value="<?php echo $result->traderImage;?>">  
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- -------------- Form Fields -------------- -->
                                                <div class="row">
                                                    <!-- --- Full Name --- -->
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="text-s12 text-semibold" for="">Full Name</label>
                                                            <input type="text" name="txtname" class="form-control input-custom" value="<?php echo set_value('txtname',$result->traderFullName)?>" placeholder="Ahmed Kabeer">
                                                           <span class="errmsg"><?php echo form_error('txtname')?></span>
                                                      
                                                            
                                                        </div>
                                                    </div>
                                                    <!-- --- Place --- -->
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="text-s12 text-semibold" for="">Place</label>
                                                            <input type="text" name="txtplace"  class="form-control input-custom" value="<?php echo set_value('txtplace',$result->traderLocation)?>" placeholder="Dubai,UAE">
                                                               <span class="errmsg"><?php echo form_error('txtplace')?></span>  
                                                           
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <!-- --- Mobile Number --- -->
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="text-s12 text-semibold" for="">Mobile Number</label>
                                                            <?php
                                                            $data = $result->traderContactNum;
                                                            if(strpos($data, ' ') !== false) {
                                                                list($country_code, $ph_no) = explode(" ", $data);
                                                              } else {
                                                                // not explodable
                                                              }
                                                            
                                                             ?>
                                                            <div class="input-group">
                                                        <!--      <div class="input-group-btn">
                                                                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Action
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                <a class="dropdown-item" href="#">Something else here</a>
                                                                <div role="separator" class="dropdown-divider"></div>
                                                                <a class="dropdown-item" href="#">Separated link</a>
                                                                </div>
                                                            </div>-->
                                                            <!-- <span class="input-group-addon" id="basic-addon1" name><?php if(isset($ph_no)) echo $country_code;  ?></span> -->
                                                            <select id="coun_code" name="countrycode">
                                                                <?php
                                                                $codeqry=array();
                                                                $codeqry[0]->country_code='+971';
                                                                    foreach($codeqry as $r)
                                                                    {
                                                                        ?>
                                                                <option value="<?php echo $r->country_code?>"><?php echo $r->country_code?></option>
                                                                <?php } ?> 
                                                            </select>
                                                                <input type="text" aria-describedby="basic-addon1" id="txtmob" name="txtmob" class="form-control input-custom"  value="<?php echo (isset($ph_no))?set_value('txtmob',$ph_no):set_value('txtmob',$data)?>" placeholder="ahmedkabeer@gmail.com">
                                                            </div>
                                                           
                                                          <span class="errmsg"><?php echo form_error('txtmob')?></span>
                                                        
                                                        </div>
                                                    </div>
                                                    <!-- --- Email --- -->
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="text-s12 text-semibold" for="">Email</label>
                                                            <input type="text" id="txtemail" name="txtemail" class="form-control input-custom" value="<?php echo set_value('txtemail',$result->traderEmailID)?>" placeholder="ahmedkabeer@gmail.com">
                                                            <span class="errmsg"><?php echo form_error('txtemail')?></span>
                        
                                             
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <!-- --- User Name --- -->
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="text-s12 text-semibold" for="">User Name</label>
                                                            <input type="text" id="txtuname" name="txtuname" class="form-control input-custom" disabled value="<?php echo set_value('txtuname',$result->traderUserName)?>" placeholder="ahmedkabeer@gmail.com">
                                                              <span class="errmsg"><?php echo form_error('txtuname')?></span> 
                                                    
                                                        </div>
                                                    </div>
                                                    <!-- --- Password --- -->
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="text-s12 text-semibold" for="">Password</label>
                                                           
                                                            <input type="password" name="txtpassword" id="txtpassword" class="form-control input-custom" value="<?php echo set_value('txtpassword')?>" placeholder="**********">
                                                             <span class="errmsg"><?php echo form_error('txtpassword')?></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <!-- --- Confirm Password --- -->
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="text-s12 text-semibold" for="">Confirm Password</label>
                                                   
                                                            <input type="password" name="txtconfpassword" class="form-control input-custom" value="<?php echo set_value('txtconfpassword')?>" placeholder="**********">
                                                            <span class="errmsg"><?php echo form_error('txtconfpassword')?></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Attachments -->
                                                <div class="row mt-4">
                                                    <div class="col-lg-6 col-md-8 col-sm-7 col-12 mx-auto text-center">
                                                        <label class="text-s12 text-semibold mb-2">Attach any ID (Emirates Id or Passport)</label>
                                                        <div class="row">
                                                            <div class="col-6 px-md-1 pr-1 pl-1">
                                                                <!-- Card (Allows to choose files) -->
                                                                <div class="card attach-card mx-auto">
                                                                    <div class="h-100">
                                                                        <div class="dropZoneContainer" id="drop_emir1">
                                                                            <input type="file" id="drop_emzone1" name="traderIDProof" class="custom-file-input h-100 FileUpload" accept=".jpg,.png,.gif"/>
                                                                            <input type="hidden" name="txthid_tr_emimg1" value="<?php echo $result->traderIDProof?>">
                                                                            <div class="emdropZoneOverlay">
                                                                                <?php echo isset($result->traderIDProof)?  '<img id="em1_previmg" src="'.$result->traderIDProof.'">':'<img id="em1_previmg" src="'.base_url().'?>img/register-attachment1.png">';?>
                                                                                <span class="errmsg"><?php echo form_error('traderIDProof')?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6 px-md-1 pr-1 pl-1">
                                                                <!-- Card (Allows to choose files) -->
                                                                <div class="card attach-card mx-auto">
                                                                    <div class="h-100">
                                    
                                                                    <div class="dropZoneContainer" id="drop_emir2">
                                                                        <input type="file" id="drop_emzone22" name="traderIDsecond" class="custom-file-input h-100 FileUpload" accept=".jpg,.png,.gif"/>
                                                                        <input type="hidden" name="txthid_tr_emimg2" value="<?php echo $result->traderIDProofsecond?>">
                                                                        <div class="emdropZoneOverlay">
                                                                            <?php echo isset($result->traderIDProofsecond)?  '<img id="em2_previmg" src="'.$result->traderIDProofsecond.'">':'<img id="em2_previmg" src="'.base_url().'?>img/register-attachment1.png">';?>
                                                                            <span class="errmsg" id="secem_img"><?php echo form_error('traderIDProofsecond')?></span>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr>

                                                <!-- -------- Title -------- -->
                                                <h4 class="text-center text-semibold text-s18 mt-4 mb-2 pb-2 pt-2" style="color: #898989;">Add Detail</h4>

                                                <!-- --- About you --- -->
                                                <div class="row mt-3">
                                                    <div class="col-12">
                                                        <label class="text-s12 text-semibold" for="">About you</label>
                                                       
                                                        <textarea class="form-control input-custom" name="txtabout" id="admintxtregabout" cols="30" rows="3"><?php echo set_value('txtabout',$result->traderInfo)?> </textarea>
                                                        <span class="errmsg"><?php echo form_error('txtabout')?></span>
                                                    </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <!-- --- Website Link --- -->
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="text-s12 text-semibold" for="">Website Link</label>
                                                            <input type="text"  name="txtweblink" class="form-control input-custom" value="<?php echo set_value('txtweblink',$result->socialWeb)?>" placeholder="Web(Eg:http://alshamil.com)">
                                                             <span class="errmsg"><?php echo form_error('txtweblink')?></span>
                                                        </div>
                                                    </div>
                                                    <!-- --- Facebook Link --- -->
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="text-s12 text-semibold" for="">Facebook Link</label>
                                                            <input type="text"  name="txtfblink" class="form-control input-custom" value="<?php echo set_value('txtfblink',$result->socialFb)?>"  placeholder="http://facebook.ahmed_kabeer.com)">
                                                            <!--input type="text" name="txtemexpdate" class="form-control datepicker reginputs" placeholder="dd-mm-yyyy" value=""-->
                                                            <span class="errmsg"><?php echo form_error('txtfblink')?></span>
                                                          
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <!-- --- Twitter Link --- -->
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="text-s12 text-semibold" for="">Twitter Link</label>
                                                             <input type="text" name="txtinstlink" class="form-control input-custom" value="<?php echo set_value('txtinstlink',$result->socialInsta)?>" placeholder="http://twitter.ahmed_kabeer.com)">
                                                           <span class="errmsg"><?php echo form_error('txtinstlink')?></span>
                            
                                                        </div>
                                                    </div>
                                                    <!-- --- Instagram Link --- -->
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="text-s12 text-semibold" for="">Instagram Link</label>
                                                            <input type="text"  name="txtsnapclink" class="form-control input-custom" value="<?php echo set_value('txtsnapclink',$result->socialSnap)?>" placeholder="http://instagrame.ahmed_kabeer.com)"/> 
                                                             <span class="errmsg"><?php echo form_error('txtsnapclink')?></span>
                                                                 </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <!-- --- Snapchat Link --- -->
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="text-s12 text-semibold" for="">Snapchat Link</label>
                                                            <input type="text"  name="txttwitter" class="form-control input-custom" value="<?php echo set_value('txttwitter',$result->socialtwitter)?>" placeholder="http://snapchat.ahmed_kabeer.com)"/> 
                                                              <span class="errmsg"><?php echo form_error('txttwitter')?></span>
  
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- --- Button --- -->
                                                <div class="row mt-4">
                                                    <div class="col-5 mx-auto">
                                                        <button class="btn btn-orange text-s15 w-100 pt-2 pb-2 br-4">
                                                            Save
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </form>
                                     <?                               }else{
                                        echo '<div class="row">
                                        <div class="col-md-12">
                                        <h2>Sorry no data found</h2>
                                        </div></div>';
                                    }

                                    ?>
                                    <!-- /.Form -->
                                </div>
                            </div>
                              
                    </div>
                 </div>

                


            </div>  <!-- ---- B Main Div ends here ---- -->
        </div>
    </div><!-- end row 1-->  
</div>

<?php
$this->view('admin/admin_footer'); 
?>

        
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
                        $('#admin_prof_previmg').attr('src', e.target.result);
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
        $('#admin_prof_previmg').click(function() {
            alert("123");
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
    });
    
</script>