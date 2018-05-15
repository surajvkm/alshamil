<!-- start section -->
<style>
	
	.card-inp{
		float: none;
    display: inline-block;
     width: 49.6%;;
	}
	

	
	.text-semibold , .input-custom{
		text-transform: capitalize;
	}
	

	
</style>
<?php 

$this->view('admin/admin_header');
echo $this->session->flashdata('msg'); ?>

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
                <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/custom/add-post.css">      
                <div class="col-main">
                    <div class="col-12">
                    <h4 class="page-title mt-4 mb-2 pb-2 pt-2">ADD POST</h4>
                    <form id="postForm"></form>
                   
                    <form id="myForm" enctype="multipart/form-data" method="post" action="">

                    <div class="row">
                                <div class="col-lg-12">
                                    <form action="">
                                        <div class="row">
                                            <div class="col-lg-8 mx-auto mt-2 mb-5 container-fluid">
                                                <!-- --- Category --- -->
                                                
                                                    <div class="card-inp pl-0" >
                                                        <div class="form-group" >
                                                            <label class="text-s12 text-semibold" for="">Category</label>
                                                      
                                                            <select class="form-control input-custom" id="txtcategorya" name="txtcat">

                                                                <option value="">--Select--</option>
                                                                <?php
                                                                foreach ($cat_qry->result() as $r) {
                                                                    ?>
                                                                    <option value="<?php echo $r->CategoryId ?>"><?php echo $r->Name ?></option>
                                                                    <?php
                                                                }
                                                                ?>

                                                            </select>
                                                            <label id="err_txtcat" class="txt_errors">Please Select Your Category</label>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- --- Brand --- -->
                                           
                                               
                                                    <div id="ggg">
                                                      
                                                    

                                           
                                        </div>
                                        <!-- --- Buttons --- -->
                                            <div class="row mt-4" id="buttons" style="display:none">
                                                <div class="col-lg-9 mx-auto">
                                                    <div class="row">
                                                        <!-- --- Clear --- -->
                                                        <div class="col-6">
                                                            <button  class="btn btn-red text-s15 w-100 pt-2 pb-2" id="btnpostclr">
                                                            CLEAR
                                                            </button>
                                                        </div>
                                                        <!-- --- Post --- -->
                                                        <div class="col-6">
                                                            <button  class="btn btn-success text-s15 w-100 pt-2 pb-2" id="btnsavepost">
                                                                POST
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </form>
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
   
    
    $(document).ready(function () {
    	
    	   $('#txtcategorya').change(function () {
            
            $('#buttons').css('display', 'block');
            $('#err_txtcat').css('display', 'none');
            var category = $(this).val();
            
            if (category!== '')
            {
            	localStorage.clear();
            	$url =Settings.baseurl+'admin/addpostview/'+category;
                $("#ggg").empty();
                $("#ggg").load($url);
                $('#myForm').attr('action', Settings.baseurl+'admin/savepost/'+category);
              // $('#btnsavepost').attr('id','btncaradpost');
            }
            
        });

    });   
      
</script>


<div id="carbike_div"></div>
<div id="mob_div"></div>
<div id="verwb_div"></div>
<div id="noplate_div"></div>
<div id="prop_div"></div>

