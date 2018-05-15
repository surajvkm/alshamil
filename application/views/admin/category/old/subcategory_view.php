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
					<div class="col-12">
						<h4 class="page-title mt-4 mb-2 pb-2 pt-2">ADD CATEGORY</h4>
                 
                 
						<?php if($cat!='' and $id !=='' ): 
                  
                  
                  
						?>
                  
                  
						<div class="modal" id="subcategoryModal" tabindex="-1" role="dialog" >
							<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
								<div class="modal-content">

									<form action="" method="POST">


										<input type="hidden" value="<?php echo $id; ?>" name="category_id" id="category_id"/>
										<div class="col-12">
											<div class="row">
												<div class="col-12 mt-lg-3">
													<div class="form-group text-left">
                                                                                          
														<label class="text-s12 text-semibold ml-lg-2 mb-1" style="color: #7F7F7F;" for="">Category Name</label>
                                        
														<input class="form-control input-custom" name="sub_category_name" id="sub_category_name" >
                                                                 
													</div>
													
													
													<div class="form-group text-left">
                                                                                          
														<label class="text-s12 text-semibold ml-lg-2 mb-1" style="color: #7F7F7F;" for="">Category Name Arabic</label>
                                        
														<input class="form-control input-custom" name="sub_category_ar" id="sub_category_ar" >
														<span class="text-danger"></span>
													</div>
                                                                                            
													<div class="form-group text-left">
                                                                                          
														<label class="text-s12 text-semibold ml-lg-2 mb-1" style="color: #7F7F7F;" for="">Category Label</label>
                                        
														<input class="form-control input-custom" name="sub_category_label" id="sub_category_label" >
														<span class="text-danger"></span>
													</div>
												</div>
												<div class="col-6 mt-lg-4 pt-lg-2 mb-lg-4">
													<button class="btn btn-orange text-s15 w-100 pt-2 pb-2 text-normal" id="save_sub_category" >
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
                  
						<div class="row">
							<div class="col-lg-12">
                                    
								<div class="row">
									<div class="col-lg-8 mx-auto mt-2 mb-5 container-fluid">
                                               
										<!-- --- Buttons --- -->
                                        
										<div class="row mt-4"  >
											<div class="col-lg-9 mx-auto">
												<div class="row">
                                                        
													<!-- --- Post --- -->
													<div class="col-12">
                                                        
                                                        
                                                        
														<ul class="list-unstyled list-inline">
                                        
                                        
                                        
															<?php 
                                        
															$url =''; 
															$mainc = $this->View_Model->get_single_category_by_id($cat);
															$subc =  $this->View_Model->get_single_category_by_id($id);
                                       
															if($mainc->parentCategory==0)
															$url = base_url().'admin/subcategory/'.$mainc->CategoryId;
															else
															$url = base_url().'admin/subcategory/'.$mainc->parentCategory.'/'.$mainc->CategoryId;
                                      
                                       
															?>
                                       
                                      
															<li class="list-inline-item"> <a class="text-orange text-s18" href="<?php echo $url ?>">  <?php echo $mainc->Name ?>    |</a></li> 
															<li class="list-inline-item"> <a class="text-orange text-s18" href="<?php echo base_url() ?>admin/subcategory/<?php echo $cat ?>/<?php echo $subc->CategoryId ?>">  <?php echo $subc->Name ?> |</a></li> 
                                       
															<?php
                                        
                                        
															if($pcat->num_rows()>0) : 
															$addslash=1;
															foreach($pcat->result() as $row):  ?>
                                                        
															<li class="list-inline-item"> <a class="text-orange text-s18" href="<?php echo base_url() ?>admin/subcategory/<?php echo $id ?>/<?php echo $row->CategoryId ?>">  <?php echo $row->Name ?> <?php if($addslash<$pcat->num_rows()-1) echo '|'; ?></a></li> 
                   
															<?php 
															$addslash++;
															endforeach; endif; ?>
														</ul>
													</div></div></div></div>
                                        
                                        
										<div class="row mt-4" id="buttons" >
											<div class="col-lg-9 mx-auto">
												<div class="row">
                                                        
													<!-- --- Post --- -->
													<div class="col-6">
														<button  data-toggle="modal" data-target="#subcategoryModal" class="btn btn-orange text-s15 w-100 pt-2 pb-2" ><i class="fa fa-plus"></i>Add</button>
													</div>
                                                       
												</div>
											</div>
                                                
                                                   
                                                    
                                                    
                                                    
										</div>
									</div>
                                    
								</div>
                                        
                                        
								<div class="row">
									<div class="col-lg-6 mx-auto mt-2 mb-5 container-fluid">
                                                    	
										<?php if($pcat->num_rows()>0) :
										foreach($pcat->result() as $row):
										?>
                                                    	
										<div class="row mt-3">
                                                    	
											<div class="col-6" >
                                                    	
												<div class="form-group">
													<input class="form-control input-custom" name="<?php echo $row->CategoryId ?>" id="<?php echo $row->CategoryId ?>" type="text" value="<?php echo $row->Name ?>" readonly="" />
												</div>
                                                    
											</div> 
                                                    
											<div class="col-6" >
                                                    
                                                    
												<div class="row" id="mainactions_<?php echo $row->CategoryId ?>">
													<div class="" >
                                                    	
														<button data-from='sub'  data-id="<?php echo $row->CategoryId ?>" class="btn btn-orange w-100 pt-1 pb-1 text-s14 catedit" >Edit</button>
													</div>    
                                                    
													<div class="mx-2" >
                                                    	
														<button data-from='sub' data-id="<?php echo $row->CategoryId ?>" class="btn btn-danger text-s15 w-100 pt-1 pb-1 text-s14 catdele" >
															Delete 
														</button>
													</div>       
                                                    
												</div>	
                                                    
												<div class="row" style="display: none" id="subactions_<?php echo $row->CategoryId ?>">
													<div class="" >
                                                    	
														<button data-from='sub'  data-cat='<?php echo $cat ?>'  data-id="<?php echo $row->CategoryId ?>" class="btn btn-orange w-100 pt-1 pb-1 text-s14 cateditsave" >Save</button>
													</div>    
                                                    
													<div class="mx-2" >
                                                    	
														<button data-from='sub' data-id="<?php echo $row->CategoryId ?>" class="btn btn-danger w-100 pt-1 pb-1 text-s14 cateditcancel" >
															Cancel 
														</button>
													</div>       
                                                    
												</div>	
                                                    
                                                    
                                                    
											</div>
                                                    	
										</div>
                                                    	
										<?php 
										endforeach;
										endif; ?>
                                                    	
									</div>
                                                    	
                                                    	
                                                    	
								</div>
							</div>
                                
						</div>                
                  
						<?php else: ?>
                   
                   
						<div class="modal" id="subcategoryModal" tabindex="-1" role="dialog" >
							<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
								<div class="modal-content">

									<form action="" method="POST">


										<input type="hidden" value="<?php echo $cat; ?>" name="category_id" id="category_id"/>
										<div class="col-12">
											<div class="row">
												<div class="col-12 mt-lg-3">
													<div class="form-group text-left">
                                                                                          
														<label class="text-s12 text-semibold ml-lg-2 mb-1" style="color: #7F7F7F;" for="">Category Name</label>
                                        
														<input class="form-control input-custom" name="sub_category_name" id="sub_category_name" >
                                                                 
													</div>
													
													
													<div class="form-group text-left">
                                                                                          
														<label class="text-s12 text-semibold ml-lg-2 mb-1" style="color: #7F7F7F;" for="">Category Name Arabic</label>
                                        
														<input class="form-control input-custom" name="sub_category_ar" id="sub_category_ar" >
														<span class="text-danger"></span>
													</div>
                                                                                            
                                                                                            
													<div class="form-group text-left">
                                                                                          
														<label class="text-s12 text-semibold ml-lg-2 mb-1" style="color: #7F7F7F;" for="">Category Label</label>
                                        
														<input class="form-control input-custom" name="sub_category_label" id="sub_category_label" >
														<span class="text-danger"></span>
													</div>
												</div>
												<div class="col-6 mt-lg-4 pt-lg-2 mb-lg-4">
													<button class="btn btn-orange text-s15 w-100 pt-2 pb-2 text-normal" id="save_sub_category" >
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
                 
						<div class="row">
							<div class="col-lg-12">
                                    
								<div class="row">
									<div class="col-lg-8 mx-auto mt-2 mb-5 container-fluid">
                                               
										<!-- --- Buttons --- -->
                                        
										<div class="row mt-4"  >
											<div class="col-lg-9 mx-auto">
												<div class="row">
                                                        
													<!-- --- Post --- -->
													<div class="col-12">
                                                        
                                                        
                                                        
														<ul class="list-unstyled list-inline">
															<?php
															$mainc = $this->View_Model->get_single_category_by_id($cat); 
															?>
                                         
															<li class="list-inline-item"> <?php echo $mainc->Name ; ?> |</li>
                                         
															<?php 
                                        
                                        
															if($pcat->num_rows()>0) : 
															$addslash=1;
															foreach($pcat->result() as $row):  ?>
                                                        
															<li class="list-inline-item"> <a class="text-orange text-s18" href="<?php echo base_url() ?>admin/subcategory/<?php echo $cat ?>/<?php echo $row->CategoryId ?>">  <?php echo $row->Name ?> <?php if($addslash<=$pcat->num_rows()-1) echo '|'; ?></a></li> 
                   
															<?php 
															$addslash++;
															endforeach; endif; ?>
														</ul>
													</div></div></div></div>
                                        
                                        
										<div class="row mt-4" id="buttons" >
											<div class="col-lg-9 mx-auto">
												<div class="row">
                                                        
													<!-- --- Post --- -->
													<div class="col-6">
														<button  data-toggle="modal" data-target="#subcategoryModal" class="btn btn-orange text-s15 w-100 pt-2 pb-2" ><i class="fa fa-plus"></i>Add</button>
													</div>
                                                       
												</div>
											</div>
                                                
                                                   
                                                    
                                                    
                                                    
										</div>
									</div>
                                    
								</div>
                                        
                                        
								<div class="row">
									<div class="col-lg-6 mx-auto mt-2 mb-5 container-fluid">
                                                    	
										<?php if($pcat->num_rows()>0) :
										foreach($pcat->result() as $row):
										?>
                                                    	
										<div class="row mt-3">
                                                    	
											<div class="col-6" >
                                                    	
												<div class="form-group">
													<input class="form-control input-custom" name="<?php echo $row->CategoryId ?>" id="<?php echo $row->CategoryId ?>" type="text" value="<?php echo $row->Name ?>" readonly="" />
												</div>
                                                    
											</div> 
                                                    
											<div class="col-6" >
                                                    
                                                    
												<div class="row" id="mainactions_<?php echo $row->CategoryId ?>">
													<div class="" >
                                                    	
														<button data-from='sub'  data-id="<?php echo $row->CategoryId ?>" class="btn btn-orange w-100 pt-1 pb-1 text-s14 catedit" >Edit</button>
													</div>    
                                                    
													<div class="mx-2" >
                                                    	
														<button data-from='sub' data-id="<?php echo $row->CategoryId ?>" class="btn btn-danger text-s15 w-100 pt-1 pb-1 text-s14 catdele" >
															Delete 
														</button>
													</div>       
                                                    
												</div>	
                                                    
												<div class="row" style="display: none" id="subactions_<?php echo $row->CategoryId ?>">
													<div class="" >
                                                    	
														<button data-from='sub'  data-cat='<?php echo $cat ?>'  data-id="<?php echo $row->CategoryId ?>" class="btn btn-orange w-100 pt-1 pb-1 text-s14 cateditsave" >Save</button>
													</div>    
                                                    
													<div class="mx-2" >
                                                    	
														<button data-from='sub' data-id="<?php echo $row->CategoryId ?>" class="btn btn-danger w-100 pt-1 pb-1 text-s14 cateditcancel" >
															Cancel 
														</button>
													</div>       
                                                    
												</div>	
                                                    
                                                    
                                                    
											</div>
                                                    	
										</div>
                                                    	
										<?php 
										endforeach;
										endif; ?>
                                                    	
									</div>
                                                    	
                                                    	
                                                    	
								</div>
							</div>
                                
						</div>


						<?php endif; ?>
					</div>
                   
				</div>
			</div>

		</div>  <!-- ---- B Main Div ends here ---- -->
	</div>
</div>





<?php
$this->view('admin/admin_footer'); 
?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/app/adminapp.js"></script>