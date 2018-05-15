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
                                    <h4 class="page-title mt-4 mb-4 pb-2 pt-2">ADD CATEGORY</h4>

                                    <div class="">
                                   <div class="col-lg-12 col-12">


<div class="row justify-content-md-center">
    
    <div class="col col-lg-12">
    <div class="row justify-content-md-center">
                                                        
                                                        <!-- --- Post --- -->
                                                        <div class="col-4">
        <button  data-toggle="modal" data-target="#categoryModal" class="btn btn-orange text-s15 w-100 pt-2 pb-2" ><i class="fa fa-plus"></i>Add</button>
        
        </div></div>    </div>
    
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
                                                    	
                                                    	 <button data-id="<?php echo $row->CategoryId ?>" class="btn btn-success w-100 pt-1 pb-1 text-s14 catview" >View</button>
                                                    </div>  
                                                    
                                                    
                                                    <div class="mx-2" >
                                                    	
                                                    	 <button data-id="<?php echo $row->CategoryId ?>" class="btn btn-orange w-100 pt-1 pb-1 text-s14 catedit" >Edit</button>
                                                    </div>    
                                                    
                                                    <div class="" >
                                                    	
                                                    	 <button data-id="<?php echo $row->CategoryId ?>" class="btn btn-danger text-s15 w-100 pt-1 pb-1 text-s14 catdele" >
                                                                Delete 
                                                            </button>
                                                    </div>       
                                                    
                                                    </div>	
                                                    
                                                    <div class="row" style="display: none" id="subactions_<?php echo $row->CategoryId ?>">
                                                    <div class="" >
                                                    	
                                                    	 <button data-id="<?php echo $row->CategoryId ?>" class="btn btn-orange w-100 pt-1 pb-1 text-s14 cateditsave" >Save </button>
                                                    </div>    
                                                    
                                                    <div class="mx-2" >
                                                    	
                                                    	 <button data-id="<?php echo $row->CategoryId ?>" class="btn btn-danger w-100 pt-1 pb-1 text-s14 cateditcancel" >
                                                                Cancel 
                                                            </button>
                                                    </div>       
                                                    
                                                    </div>	
                                                    
                                                    
                                                    
                                                    </div>
                                                    	
                                                   </div>
                                                    	
                                                    	<?php 
                                                    	endforeach;
                                                    	endif; ?>
        
        
        
        </div>    </div>
    
  </div>




                                  </div>
                </div>
                
                
                
                
                
                
                
                
                
                
                
            </div>

                


        </div>  <!-- ---- B Main Div ends here ---- -->
    </div>
</div><!-- end row 1-->  
</div>
</div>
<div class="modal" id="categoryModal" tabindex="-1" role="dialog" >
<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
<div class="modal-content">

<form action="" method="POST">
                                                                                <div class="col-12">
                                                                                    <div class="row">
                                                                                    <div class="col-12 mt-lg-3">
                                                                                            <div class="form-group text-left">
                                                                                          
                                                                                                <label class="text-s12 text-semibold ml-lg-2 mb-1" style="color: #7F7F7F;" for="">Category Name</label>
                                        
                                                                                                <input class="form-control input-custom" name="category_name" id="category_name" >
                                                                  <span class="text-danger"> </span>
                                                                                            </div>
                                                                                            
                                                                                            
                                                                                            <div class="form-group text-left">
                                                                                          
                                                                                                <label class="text-s12 text-semibold ml-lg-2 mb-1" style="color: #7F7F7F;" for="">Category Name Arabic</label>
                                        
                                                                                                <input class="form-control input-custom" name="category_ar" id="category_ar" >
                                                                  <span class="text-danger"> </span>
                                                                                            </div>
                                                                                            
                                                                                        </div>
                                                                                        <div class="col-6 mt-lg-4 pt-lg-2 mb-lg-4">
                                                                                            <button class="btn btn-orange text-s15 w-100 pt-2 pb-2 text-normal" id="save_category" >
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