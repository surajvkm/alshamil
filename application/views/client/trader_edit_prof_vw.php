<?php echo $this->session->flashdata('msg');?>
<form  method="post" id="my_form" action="<?php echo base_url();?>trader/update_trader_register" enctype="multipart/form-data">
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
                            <input type="hidden" name="txthid_trid" value="<?php echo $qry[0]->traderId ?>">
                            <div class="row profile">
                                <input type="file" id="profimg" name="profimg" class="userProffile"  accept=".jpg,.png,.gif"/>
                                <input type="hidden" id="txthid_tr_primg" name="txthid_tr_primg" value="<?php echo $qry[0]->image ?>">
                                <?php
                                if ($qry[0]->image != '') {
                                    ?>
                                    <img id="prof_previmg" src="<?php echo $qry[0]->image ?>">
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
                                    <input type="text" id="txtname" name="txtname" class="form-control placeholder-font" value="<?php echo $qry[0]->fullName ?>">
                                   <label id="err_txtname" class="txt_errors">Please Select Your full Name</label>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 pr-xs-0">
                                <div class="form-group">
                                    <label for="txtplace">Place</label>
<!--                                    <input type="text" name="txtplace"  id="txtplace"  class="form-control" value="<?php echo $qry[0]->traderLocation ?>">-->
                                    <input  type="hidden" id="txthidotherplace" value="<?php echo $qry[0]->location?>">
                                    <select name="txtplace" id="txtplace" class="form-control placeholder-font">
                                    <option value="">Select</option>
                                    <option value="Dubai" <?php if($qry[0]->location == 'Dubai') echo 'selected'?> >Dubai</option>
                                   <option value="Abudhabi" <?php if($qry[0]->location == 'Abudhabi') echo 'selected'?>>Abudhabi</option>
                                    <option value="Sharjah" <?php if($qry[0]->location == 'Sharjah') echo 'selected'?>>Sharjah</option>
                                    <option value="Ajman" <?php if($qry[0]->location == 'Ajman') echo 'selected'?>>Ajman</option>
                                    <option value="Fujairah" <?php if($qry[0]->location == 'Fujairah') echo 'selected'?>>Fujairah</option>
                                    <option value="RAK" <?php if($qry[0]->location == 'RAK') echo 'selected'?>>RAK</option>
                                    <option value="Umm Alquwain" <?php if($qry[0]->location == 'Umm Alquwain') echo 'selected'?>>Umm Alquwain</option>
                                    <option value="Al Ain" <?php if($qry[0]->location == 'Al Ain') echo 'selected'?>>Al Ain</option>
                                    <option value="Other">Other</option>
                                </select>
                                    <span class="errmsg"><?php echo form_error('txtplace') ?></span>

                                </div>
                            </div> 
                            <div class="col-xs-6 col-sm-6 col-md-6 pl-xs-0" >
                                <div class="form-group">
                                    <label for="txtmob">Mobile Number</label>
                                   

                                    <input type="hidden" id="hid_country_code" name="txt_countrycode">
                                    <input id="phone" type="tel" name="txtmob" class="form-control placeholder-font" maxlength="13" minlength="5" value="<?php echo$qry[0]->contactNumber; ?>">
                                    <span class="errmsg"><?php echo form_error('txtmob') ?></span>

                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 pr-xs-0">
                                <div class="form-group">
                                    <label for="txtemail">Email</label>
                                    <input type="text" id="txtemail" name="txtemail" class="form-control placeholder-font" value="<?php echo $qry[0]->email ?>"readonly>
                                    <span class="errmsg"><?php echo form_error('txtemail') ?></span>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 pl-xs-0">
                                <div class="form-group">
                                    <label for="txtuname">Username</label>
                                    <input type="text" id="txtuname" name="txtuname" class="form-control placeholder-font" value="<?php echo $qry[0]->userName ?>" readonly>
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
                                    <input type="hidden" name="txthid_tr_emimg1" value="<?php echo $qry[0]->idProof ?>">
                                    <div class="dropZoneContainer" readonly id="drop_emir1">
                                        <input type="file" readonly id="drop_emzone1" name="idProof" class="FileUpload" accept=".jpg,.png,.gif"/>
                                        <?php
                                        if ($qry[0]->idProof != '') {
                                        ?>
                                        <img id="em1_previmg" src="<?php echo $qry[0]->idProof ?>">
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
                                <input type="hidden" name="txthid_tr_emimg2" value="<?php echo $qry[0]->idProof2 ?>" >
                                <div class="dropZoneContainer" readonly id="drop_emir2">
                                    <input type="file" readonly id="drop_emzone22" name="idProof2" class="FileUpload" accept=".jpg,.png,.gif"/>
                                    <?php
                                    if ($qry[0]->idProof2 != '') {
                                        ?>
                                        <img id="em2_previmg" src="<?php echo $qry[0]->idProof2 ?>">
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
                                <input type="text"  name="txttwitter" class="form-control" value="<?php echo $qry[0]->socialTwitter ?>"/> 
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
            <div class="modal-content ">  
                <div class="modal-header" id="flagmheader">  
                    <button type="button" class="close" data-dismiss="modal">&times;</button>  
                </div>  
                <div class="modal-body" id="trader_detail"> 
                Current Password<br>
                    <input type="password" id="modal_current_pass"  class="form-control"  ><br><br>
                    New Password<br>
                    <input type="password" id="modal_pass"  class="form-control" ><br><br>
                    Confirm Password<br>
                    <input type="password" id="modal_conf_pass"  class="form-control"><br>
                    <input type="hidden" id="hid_traderid" value="<?php echo $qry[0]->traderId ?>">

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
            <div class="modal-content ">  
                <div class="modal-header" id="flagmheader">  
                    <button type="button" class="close" data-dismiss="modal">&times;</button>  
                </div>  
                <div class="modal-body" id="trader_detail" > 
                    Enter Place<br>
                    <input type="text" id="txtnewplace" class="form-control"><br><br>
                    

                </div>  <br>
                <div class="modal-footer" id="flagmfooter">  
                    <button type="button" class="btn btn-default" id="btnAddPlaceModal" data-dismiss="modal">ADD</button>  
                </div>  
            </div>  
        </div>
    </div> 
<!--loading modal for entering other country name-->

<script type="text/javascript" src="<?php echo base_url(); ?>js/app/profiledit.js"></script>   
<script type="text/javascript" src="<?php echo base_url(); ?>js/intlTelInput.min.js"></script>   
<script type="text/javascript" src="<?php echo base_url(); ?>js/app/utils.js"></script>   