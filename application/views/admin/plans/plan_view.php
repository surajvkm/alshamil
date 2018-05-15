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
					<div class="col-lg-9 col-9">
						<h4 class="page-title mt-4 mb-4 pb-2 pt-2">ADD PLAN</h4>

						<div class="">
							<div class="col-lg-12 col-12">


								<div class="row justify-content-md-center">
    
									<div class="col col-lg-12">
										<div class="row justify-content-md-center">
                                                        
											<!-- --- Post --- -->
											<div class="col-4">
												<button  data-toggle="modal" data-target="#planModal" class="btn btn-orange text-s15 w-100 pt-2 pb-2" ><i class="fa fa-plus"></i>Add</button>
        
											</div></div></div>
    
								</div>




							</div>
						</div>
                
                
                
						<br/>  <br/>
                
                
                
                
						<div class="">
							<div class="col-lg-6 mx-auto mt-2 mb-5 container-fluid">


								<div class="row justify-content-md-center">
    
									<div class="col col-lg-12">
										<div class="row justify-content-md-center">
                                                        
											<!-- --- Post --- -->
											<?php if($plan->num_rows()>0) :
											
											
											foreach($plan->result() as $row):
											
											
											?>
                                                    	
											<div class="row mt-3">
                                                    	
												<div class="col-7" >
                                                    	
													<div class="form-group">
														<input class="form-control input-custom" name="<?php echo $row->PlanId ?>" id="<?php echo $row->PlanId ?>" type="text" value="<?php echo $row->name ?>" readonly="" />
													</div>
                                                    
												</div> 
                                                    
												<div class="col-5" >
                                                    
                                                    
													<div class="row" id="mainactions_<?php echo $row->PlanId ?>">
                                                    
														
                                                    
														<div class="mx-2" >
                                                    	
															<button data-id="<?php echo $row->PlanId ?>" class="btn btn-orange w-100 pt-1 pb-1 text-s14 planedit" >Edit</button>
														</div>    
                                                    
														<div class="" >
                                                    	
															<button data-id="<?php echo $row->PlanId ?>" class="btn btn-danger text-s15 w-100 pt-1 pb-1 text-s14 plandelete" >
																Delete 
															</button>
														</div>       
                                                    
													</div>	
                                                    
													
                                                    
                                                    
                                                    
												</div>
                                                    	
											</div>
                                                    	
											<?php 
											endforeach;
											endif; ?>
        
        
        
										</div></div>
    
								</div>




							</div>
						</div>
                
                
                
                
                
                
                
                
                
                
                
					</div>

                


				</div>  <!-- ---- B Main Div ends here ---- -->
			</div>
		</div><!-- end row 1-->  
	</div>
</div>
<div class="modal" id="planModal" tabindex="-1" role="dialog"     >
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