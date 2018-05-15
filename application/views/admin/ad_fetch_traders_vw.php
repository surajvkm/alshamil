<div class="col-lg-12">

<div class="row">

    <!-- ------ Profile details ------ -->
    <div class="col-4 pl-2 pl-sm-3 pl-md-3">
        <div class="row">

            <!-- Profile image -->
            <div class="col-12 text-center pt-lg-5 pl-0 pl-md-3 pl-sm-3">
                <img class="profileImage" src="<?php echo $row->image?>" alt="">
            </div>

            <div class="col-12 text-center pt-3 px-md-3 px-sm-3 px-0">
                <!-- Name -->
                <p class="mb-2 text-orange text-s15 text-semibold text-resize"><?php if(isset($row->fullName))echo $row->fullName?></p>
            </div>

            <!-- Social Icons -->
            <div class="col-12 pt-4 mt-lg-2">
                <div class="row">

                <a href="<?php echo $row->socialWeb!=''? $row->socialWeb:'#'; ?>" target='_blank' >
                           
                            <div class="col-2 text-center ml-md-2 ml-sm-2 p-0">
                        <img class="social-icon" src="<?php if(isset($row->fullName))echo base_url();?>img/social-web.png" alt="">
                    </div>
                        </a>
                        
                        <a href="<?php echo $row->socialTwitter!=''? $row->socialTwitter:'#'; ?>"  >
                        <div class="col-2 text-center ml-1 p-0">
                        <img class="social-icon" src="<?php if(isset($row->fullName))echo base_url();?>img/social-twitter.png"  alt="">
                    </div>
                           
                        </a>
                        <a href="<?php echo $row->socialFb!=''? $row->socialFb:'#'; ?>"  >
                       
                            <div class="col-2 text-center ml-1 p-0">
                        <img class="social-icon"  src="<?php if(isset($row->fullName))echo base_url();?>img/social-facebook.png" alt="">
                    </div>
                        </a>
                        <a href="<?php echo $row->socialInsta!=''? $row->socialInsta:'#'; ?>"  >
                        <div class="col-2 text-center ml-1 p-0">
                        <img class="social-icon" src="<?php if(isset($row->fullName))echo base_url();?>img/social-instagram.png" alt="">
                    </div>
                  
                        </a>
                        <a href="<?php echo $row->socialSnap!=''? $row->socialSnap:'#'; ?>"  >
                        <div class="col-2 text-center ml-1 p-0">
                        <img class="social-icon" src="<?php if(isset($row->fullName))echo base_url();?>img/social-snapchat.png"  alt="">
                    </div>
               
                        </a>
                        
                      


                   

                   
                 
                  
               
                </div>
            </div>
        </div>
    </div>

    <!-- ------ Forms ------ -->
    <div class="col-8">
        <div class="row">
            <div class="col-12 bg-profileForm mt-lg-1 pt-lg-2 pb-lg-2">
                <div class="row">
                    <div class="col-6">
                        <div class="row">

                            <!-- Place -->
                            <div class="col-12 px-md-3 px-sm-3 px-2">
                                <p class="mb-0 text-s13" style="color: #696969;">Place</p>
                                <p class="mb-0 text-s13 text-semibold text-resize" style="color: #282828;"><?php if(isset($row->location))echo $row->location?></p>
                                <hr class="mt-2 mb-1">
                            </div>

                            <!-- Email -->
                            <div class="col-12 pt-2 px-md-3 px-sm-3 px-2">
                                <p class="mb-0 text-s13" style="color: #696969;">Email</p>
                                <p class="mb-0 text-s13 text-semibold text-adjust" style="color: #282828;"><?php if(isset($row->email))echo $row->email?></p>
                                <hr class="mt-2 mb-1">
                            </div>

                            <!-- Mobile -->
                            <div class="col-12 pt-lg-2">
                                <p class="mb-0 text-s13" style="color: #696969;">Mobile</p>
                                <p class="mb-0 text-s13 text-semibold text-resize" style="color: #282828;"><?php if(isset($row->contactNumber))echo $row->contactNumber?></p>
                                <hr class="mt-2 mb-1">
                            </div>

                            <!-- About -->
                            <div class="col-12 pt-lg-2 pb-lg-2 px-md-3 px-sm-3 px-2">
                                <p class="mb-0 text-s13" style="color: #696969;">About</p>
                                <p class="mb-0 text-s13 text-semibold text-truncate-4 text-resize" style="color: #282828;"><?php if(isset($row->traderInfo))echo $row->traderInfo?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Attachments -->
                    <div class="col-6 vbl mt-lg-3 mb-lg-2 pl-lg-4 pr-lg-4">
                        <div class="row">
                            <div class="col-12 pl-lg-4 pr-lg-4 pb-1">
                                <p class="mb-1 text-s13" style="color: #696969;">Attachments</p>
                            </div>
               
                            <!-- First -->
                            <div class="col-12 pl-lg-4 pr-lg-4 pb-3">
                            <a download="attachment1.jpg" href="<?php if(isset($row->idProof))echo $row->idProof?>" title="ImageName">
                            <img class="profile-attachments" src="<?php if(isset($row->idProof)) echo $row->idProof ?>" alt="">
                        </a>
                              
                            </div>

                            <!-- Second -->
                            <div class="col-12 pl-lg-4 pr-lg-4">
                            <a download="attachment1.jpg" href="<?php if(isset($row->idProof2))echo $row->idProof2?>" title="ImageName">
                            <img class="profile-attachments" src="<?php if(isset($row->idProof2))echo $row->idProof2?>" alt="">
                        </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Buttons -->
<div class="row pt-4 pb-lg-2">
    <div class="col-12">
        <div class="row">
            <div class="col-sm-6 col-12 mx-auto">
                <div class="row">
                 <!-- Edit -->
           
                   <div class="col-4 pl-1 pr-1">
                 <a href='<?php echo base_url('admin/edit_trader/').$row->traderId; ?>' >
                        <button class="btn btn-orange w-100 pt-1 pb-1 text-s14" >
                            Edit
                        </button>
        </a>
                    </div> 

                    <!-- Approve -->
                    <div class="col-4 pl-1 pr-1">
                        <button class="btn btn-green w-100 pt-1 pb-1 text-s14 approveButton" <?php if($row->planStatus!=0)echo "disabled"; ?> value="<?php echo $row->traderId?>" data-plan="<?php echo $row->planId?>">
                            Approve
                        </button>
                    </div>

                    <!-- Reject -->
                    <div class="col-4 pl-1 pr-1">
                        <button class="btn btn-red w-100 pt-1 pb-1 text-s14 rejectButton" <?php if($row->planStatus!=0)echo "disabled"; ?> value="<?php echo $row->traderId?>">
                            Reject
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.Buttons -->

</div>