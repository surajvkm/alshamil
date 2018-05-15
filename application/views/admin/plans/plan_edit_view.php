<!-- start section -->
<?php 
$this->view('admin/admin_header');
echo $this->session->flashdata('msg'); ?>

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div class="row">

				<?php
				$this->view('admin/admin_sidebar'); 
				?>
                <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/custom/add-post.css"> 
				<div class="col-main">
					<div class="col-lg-12 col-12">
						<h4 class="page-title mt-4 mb-4 pb-2 pt-2">EDIT PLAN</h4>

						<div class="">
							<div class="col-lg-12 col-12">


								<div class="row justify-content-md-center">
    
									<div class="col col-lg-12">
										<div class="row justify-content-md-center">
                                                        
											<!-- --- Post --- -->
											<div class="">
												
       								<h4 class=" mt-4 mb-4 pb-2 pt-2"> 
       								<span class="text-center">
       								 <?php echo $plan_data->name ?>
       								 	
       								 </span>	
       								 </h4>
											</div></div></div>
    
								</div>




							</div>
						</div>
                
                
                
						
                
                
                
                <div class="row">
                                <div class="col-lg-12">
                                    
                                        <div class="row">
                                            <div class="col-lg-8 mx-auto mt-2 mb-5 container-fluid">
                                                <!-- --- Category --- -->
                                                
                                                  
                                                    <!-- --- Brand --- -->
                                           
                                               
                                                    <div id="ggg" class="row justify-content-md-center">
                                                      <div class="col-6 pl-0" >
                                                    	<form action="" method="POST" id="edit_sub_plan">
                                                    	<input type="hidden" name="planid" value="<?php echo $plan_data->planId ?>"/>
                                                    	<div class=" mt-3">
													<div class="form-group">
													<label class="text-s12 text-semibold" for="">Duration</label>
														<input class="form-control input-custom" name="duration" id="duration" type="text" value="<?php echo $plan_data->validity ?>"  />
													</div>
</div>
													<div class=" mt-3">
													<div class="form-group pt-lg-2 bb1">
<div class="custom-control custom-checkbox ml-lg-3">

    <input type="checkbox" class="custom-control-input" value='1' <?php if($plan_data->postCount=='-1') echo 'checked' ?>   name="unlimited" id="chkbox_unlimited">
    <label class="custom-control-label" for="chkbox_unlimited">Unlimited</label>
</div>
</div>
</div> 
													<div class=" mt-3 plimit" style="<?php if($plan_data->postCount=='-1') echo 'display:none' ?>" >
<div class="form-group">
													<label class="text-s12 text-semibold" for="">Post Limit</label>
														<input class="form-control input-custom" name="limit" id="limit" type="text" value="<?php echo $plan_data->postCount ?>" <?php if($plan_data->postCount=='-1') echo 'disabled' ?>  />
													</div>
									</div>			<div class=" mt-3">	
													<div class="form-group">
													<label class="text-s12 text-semibold" for="">Amount</label>
														<input class="form-control input-custom" name="amount" id="amount" type="text" value="<?php echo $plan_data->amount ?>"  />
													</div>
</div>
													<div class=" mt-3">
													
													<div class="form-group">
													<label class="text-s12 text-semibold" for="">Information</label>
														<textarea class="form-control input-custom" name="information" id="information"  ><?php echo $plan_data->description ?></textarea>
													</div>

</div>


<div class="row mt-4" id="buttons" >
                                                <div class="col-lg-12 mx-auto">
                                                    <div class="">
                                                       
                                                        <!-- --- Post --- -->
                                                        <div class="">
                                                            <button class="btn btn-orange text-s15 w-100 pt-2 pb-2 btn-block" id="btnsaveplans">
                                                                Save
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                    </form>
												</div> 
                                                    

                                           
                                        </div>
                                        <!-- --- Buttons --- -->
                                          
                                    
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                
                
						
                
                
                
                
                
                
                
                
					</div>

                


				</div>  <!-- ---- B Main Div ends here ---- -->
			</div>
		</div><!-- end row 1-->  
	</div>
</div>
<div class="modal" id="planModal" tabindex="-1" role="dialog" >
	<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
		<div class="modal-content">

			<form action="" method="POST">
				<div class="col-12">
					<div class="row">
						<div class="col-12 mt-lg-3">
							<div class="form-group text-left">
                                                                                          
								<label class="text-s12 text-semibold ml-lg-2 mb-1" style="color: #7F7F7F;" for="">Plan Name</label>
                                        
								<input class="form-control input-custom" name="plan_name" id="plan_name" >
								<span class="text-danger"></span>
							</div>
						</div>
						<div class="col-6 mt-lg-4 pt-lg-2 mb-lg-4">
							<button class="btn btn-orange text-s15 w-100 pt-2 pb-2 text-normal" id="save_plan" >
								add
							</button>
						</div>
                                                                                        
						<div class="col-6 mt-lg-4 pt-lg-2 mb-lg-4">
							<button class="btn btn-orange text-s15 w-100 pt-2 pb-2 text-normal" data-dismiss="modal" >
								Close
							</button>
						</div>
					</div>
				</div>
			</form>
		</div>

	</div>
</div>


<?php
$this->view('admin/admin_footer'); 
?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/app/adminapp.js"></script>