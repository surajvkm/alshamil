<?php
$this->view('admin/admin_header'); 

$brandName = 'Brand';
$modelName ='Model';
$brandValue = '';
$modelValue = '';
$yearName = 'Year';
$yearValue = '';
$categoryArray = array('1'=>'Car','2'=>'Bike','3'=>'Number Plate','4'=>'Vertu','5'=>'Watch','6'=>'Mobile Number','7'=>'Boat','8'=>'Phone','9'=>'Properties');
$categoryArray2 = array('Carbrands'=>'Car','Bikebrands'=>'Bike','Numberbrands'=>'Number Plate','Vertubrands'=>'Vertu','Watchbrands'=>'Watch','Mobilebrands'=>'Mobile Number','Boatbrands'=>'Boat','Phonebrands'=>'Phone','Propertybrands'=>'Properties');

if($r->CategoryID==1||$r->CategoryID==2||$r->CategoryID==7||$r->CategoryID==8||$r->CategoryID==4||$r->CategoryID==5){
    $brandValue = ucfirst($r->Brand);
    $modelValue = $r->Model;
    $yearValue = $r->ReleaseYear;
}
if($r->CategoryID==6){
    $brandName = 'Operator';
    $modelName ='Prefix';
    $brandValue = ucfirst($r->Brand);
    $modelValue = $r->Model;
    $yearName = 'Number';
    $yearValue =  $r->Number;
}
if($r->CategoryID==3){
    $brandName = 'Emirates';
    $modelName ='NP Code';
    $brandValue = ucfirst($r->Brand);
    $modelValue = $r->Model;
    $yearName = 'Number';
    $yearValue =  $r->Number;
}
if($r->CategoryID==9){
    $brandName = 'SC';
    $modelName ='Type';
    $brandValue = ucfirst($r->Brand);
    $modelValue = $r->Model;
    $yearName = 'Location';
    $yearValue =  $r->Location;
}
?>
<!--script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="code/highstock.js"></script>
<script src="code/modules/exporting.js"></script-->
<style>
#msgbox{
    display:none;
}
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">

                <?php
                $this->view('admin/admin_sidebar'); 
                ?>
                <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/custom/new-post.css">      
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="col-12">
                    <h4 class="page-title mt-4 mb-2 pb-2 pt-2">POST DETAILS</h4>
                    <div class="row">
                                <div class="col-12">
                                <form action='<?php echo base_url("TraderController/addpost")?>' method='POST' enctype="multipart/form-data" name='updateform' id='updateform'>
                              
                                    <input type="hidden" value="<?php echo $r->traderID;?>" name="traderID" id="traderId">
                                    <input type="hidden" value="<?php echo $r->usertype;?>" name="traderType" id="traderId">
                                    <input type="hidden" value="<?php echo $r->postID;?>" name="postId">
                                    <input type="hidden" value="<?php echo $r->ProductID;?>" name="productId">
                                    <input type="hidden" value="<?php echo $r->CategoryID;?>" name="categoryID">
                                    <input type="hidden"  name="videoThumbnail" value='' id='videoThumbnail' >
                                    <input type="hidden"  name="request_type" value=1 id='from' >
                                    <input type="hidden"  name="from" value=1 id='from' >
                                        <div class="row">
                                            <div class="col-lg-8 mx-auto mt-2 mb-5">

                                                <!-- -------------- User Data -------------- -->
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="row">
                                                            <!-- User Image -->
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-2">
                                                                <img class="userImage" src="<?php echo $r->traderImage?>" alt="">
                                                            </div>
                                                            <!-- User Details -->
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-9 pr-0 pr-md-3 pr-sm-3 pl-lg-2 pl-md-4 pl-sm-4 pl-5 pt-lg-2 pt-3">
                                                                <p class="mb-0 text-s13 textresize text-orange text-semibold pt-lg-1 paddingleft-10"><?php echo $r->traderFullName ?></p>
                                                                <p class="mb-0 text-s12 text-semibold paddingleft-10" style="color: #5C5C5C;"><?php echo $r->traderLocation ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 text-right pt-4 pr-2 pr-sm-3 pr-md-3">
                                                        <p class="mb-0 text-s13 text-semibold textresize" style="color: #797979;">Posted on   <?php $date = date("dS F Y", strtotime($r->SubmitDate));
                                               echo $date ; /*6th October 2017*/ ?></p>
                                                    </div>
                                                </div>

                                                <hr>

                                                <!-- -------------- Form Fields -------------- -->
                                                <div class="row">
                                                    <!-- --- Category --- -->
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="text-s12 text-semibold" for="">Category</label>
                                                            <select class="form-control input-custom" name="categoryID" id='1' disabled>
                                                            <?php
                                                                    $i=1;

                                                                        foreach ($categoryArray2 as $key=>$value) {
                                                                            
                                                                            ?>
                                                                            <option value="<?php echo $r->CategoryID; ?>" data-cat="<? echo $key; ?>"<? echo ($r->CategoryID==$i)?'selected':''; ?> ><?php echo $value ?></option>
                                                                            <?php
                                                                            $i++;
                                                                        }
                                                                        ?>
                                    
                                                       
                                                            </select>
                                                            <span class="errmsg"><?php echo form_error('txtemail')?></span>
                                                        </div>
                                                    </div>
                                                    <!-- --- Brand --- -->
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="text-s12 text-semibold" for="brandname" id="brandname"><?= $brandName; ?></label>
                                                            <select class="form-control input-custom" name="brand" id='2' >
                                                                <?php
                                                                $i=0;
                            
                                                                    foreach ($brandmodels as $key=>$value) {
                                                                        
                                                                        ?>
                                                                        <option value="<?php echo $key; ?>" data-info="<? echo $i;//echo array_search($key, array_keys($brandmodels)); ?>"<? echo ($key==$brandValue)?'selected':''; ?> ><?php echo $key ?></option>
                                                                        <?php
                                                                        $i++;
                                                                    }
                                                                    ?>
                                                            </select>
                                                            <span class="errmsg"><?php echo form_error('brand')?></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <!-- --- Model --- -->
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="text-s12 text-semibold" for="model" id="model"><?= $modelName;?></label>
                                                            <select class="form-control input-custom" name="model" id='3' >
                                                            <?php 
                                    
                                    
                                                            foreach ($brandmodels[$brandValue]['models'] as $key=>$value) {
                                                                    
                                                                ?>
                                                                <option value="<?php echo $value; ?>" data-info="<? echo $key; ?>"<? echo ($value==$modelValue)?'selected':''; ?> ><?php echo $value ?></option>
                                                                <?php
                                                                $i++;
                                                            }
                                               
                                                                ?>
                                                            </select>
                                                            <span class="errmsg"><?php echo form_error('model')?></span>
                                                        </div>
                                                    </div>
                                                    <!-- --- Year --- -->
                                                    <div class="col-6">
                                                   <?php  if($r->CategoryID==1||$r->CategoryID==2||$r->CategoryID==3||$r->CategoryID==6){?>
                                                        <div class="form-group">
                                                            <label class="text-s12 text-semibold" for="txtuname" id="year" ><?= $yearName;?></label>
                                                            <input type="text"  id="txtyear" name="year" class="form-control input-custom"  value="<?php if(isset($yearValue))echo $yearValue;?>" >
                                  
                                                             <!--   <select class="form-control input-custom" id="txtyear" name="txtyear" >
                                                                <option value="0" selected="selected">
                                                                <?php if(isset($yearValue))echo $yearValue; ?>
                                                                </option>
                                                            </select>-->
                                                            <span class="errmsg"><?php echo form_error('txtyear')?></span>
                                                        </div>
                                                   <?php  }?>
                                                    </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <!-- --- Price --- -->
                                                    <div class="col-6">
                                                        <div class="form-group pb-lg-2 bb1">
                                                            <label class="text-s12 text-semibold" for="">Price</label>
                                                            <div class="custom-control custom-checkbox ml-lg-3">
                                                                <input type="checkbox" value='1' <?php if($r->CallPrice ==1 ) { ?> checked="checked" <?php } ?> name="callforprice" class="custom-control-input" id="chk_price" >
                                                                <label class="custom-control-label" for="chk_price">Call for Price</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- --- Add price --- -->
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="text-s12 text-semibold" for="">Add price</label>
                                                            <input type="text"  name="price"  <?php echo ($r->CallPrice ==1 )?'disabled':''?> id="txt_cprice" class="form-control input-custom"  value="<?php echo $r->Price;?>" >
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- --- Details --- -->
                                                <div class="row mt-3">
                                                    <div class="col-12">
                                                        <label class="text-s12 text-semibold" for="">Details</label>
                                                        <textarea class="form-control input-custom" name="details" id="newpost_det" cols="30" rows="4"> <?php echo ucfirst($r->Description);?></textarea>
                                         
                                                          <span class="errmsg"><?php echo form_error('details')?></span>
                                                    </div>
                                                </div>

           
                                                <style>
                                                    .uploader{
                                                        height:100%;
                                                    }
                                                canvas{
                                                    visibility:hidden;
                                                }
                                                video{
                                                    width: 100%;
                                                    height: 100px;
                                                    background: #000;
                                                }
                                                    </style>


                                                <!-- --- Add Video/Photos --- -->
                                                <div class="row mt-3">
                                                    <div class="col-12">
                                                        <label class="text-s12 text-semibold" for="">Add Photo & Video</label>
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <?php 
                                                            $disabled=($r->CategoryID=='6'||$r->CategoryID=='3')?"disabled":'';
                                                                echo '
                                                                
                                                                <div class="card add-card" >
                                                                 
                                                                    <div class="h-100">
                                                                    <div class="uploader">
                                                                        <input type="file" '.$disabled.' class="custom-file-input h-100 filePhoto" name="image" >
                                                                        <img class="postImage" src="'.$r->Image.'" alt="" id="new_post_img1">
                                                                    </div>
                                                                    </div> 
                                                                </div>';
                                                    
                                                                    if($r->CategoryID!='6'){
                                                                        if($r->CategoryID!='3'){ 
                                                                    if(!$set_video){
                                                                      
                                                                echo '  <div class="card add-card">
                                                                    
                                                                            <!-- The below "addIcon" div shows before uploading a file
                                                                            after uploading file, "addIcon" div is replaced with the "img" tags -->

                                                                            <!-- "addIcon-V" for Videos and "addIcon-P" for photos -->
                                                                            
                                                                            <div class="addIcon-V h-100">
                                                                            <div class="uploader">
                                                                                    <video id="myVideo" class="postImage h-100" controls="controls" >
                                                                                        
                                                                                        <source src="" type="video/mp4" class="postImage">
                                                                                    
                                                                                    </video>                        
                                                                                    <input type="file" name="productVideo" class="custom-file-input h-100 filePhoto" style="position:absolute;top:0;left:0;" />
                                                                                    <p class="text-s12 text-semibold">Add Video</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>';
                                                            
                                                                }else{
                                                                  
                                                                    echo '  <div class="card add-card">
                                                                    <div class="uploader">
                                                                        <video id="myVideo" class="postDet_Video " controls="controls">
                                                                            <source src="'.$Video->productVideo.'" type="video/mp4" class="postImage">
                                                                            Your browser does not support HTML5 video.
                                                                        </video>                        
                                                                        <input type="file" name="productVideo"   class="custom-file-input h-100 filePhoto" style="position:absolute;top:0;left:0;"/>
                                                                        <input type="hidden" name="productiv_ID[0]" value="'.$Video->productIV_ID.'">
                                                                    </div>
                                                            
                                                                </div>';
                                                                }
                                                            }
                                                            
                                                                if(isset($nxtimages )){
                                                                    foreach($nxtimages as $IMGkey=>$img) { 
                                                                    $iv_id=$IMGkey+1;
                                                                        echo '  
                                                                        <div class="card add-card">
                                                                        <div class="addicon-post h-100">
                                                                        <div class="h-100">
                                                                            <div class="uploader">
                                                                            <input type="file" name="images['.$iv_id.']"  class="custom-file-input h-100 filePhoto" />
                                                                            <input type="hidden" name="productiv_ID['.$iv_id.']" value="'.$img->productIV_ID.'">
                                                                            <img class="postImage" src="' .$img->productImage.'" alt="" id="new_post_img1">
                                                                            </div>
                                                                        </div>
                                                                        </div>
                                                                        </div> ';
                                                                       
                                                                        
                                                                            }   
                                                                }
                                                               $more=count($nxtimages)+1;
                                                       
                                                              if($r->CategoryID==6||$r->CategoryID==3) {
                                                              }else{
                                                                
                                                                for ($x = $more; $x <=3; $x++) {
                                                                    //   $more=($r->CategoryID=='3')?3:count($nxtimages)+1;
                                                                    echo ' <div class="card add-card">
                                                                    <div class="addicon-post h-100">
                                                                        <div class="h-100">
                                                                        <div class="uploader">
                                                                        <input type="file" name="images['.$x.']" class="custom-file-input h-100 filePhoto" />    
                                                                        <img class="postImage" src="" alt="" id="new_post_img1">
                                                                        </div>
                                                                        </div>
                                                                        </div>
                                                                    </div>';
                                                                    } 
                                                              }
                                                           

                                                                } 
                                                                
                                                                ?>   


<div class="col-1">
                                    
                                    <canvas id="canvas"></canvas> 
                                    </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                

                                                <!-- --- Buttons --- -->
                                                <div class="row mt-4">
                                                    <div class="col-lg-9 mx-auto">
                                                        <div class="row">
                                                            <!-- --- Clear --- -->
                                                            <?php
                                                        
                                                            
                                                            if($r->AvailablitiyStatus!=1){?>
                                                            <?php if($r->usertype!=3){?>
                                                            <div class="col-4">
                                                                <button class="btn btn-success text-s15 textresize w-100 pt-2 pb-2 btn_approve" <?php if($r->PostAdminStatus==1)echo "disabled"; ?> value="<?php echo $r->postID?>" id='btn_newpost_appr'>
                                                                    APPROVE
                                                                </button>
                                                        
                                                            </div>
                                                            <?php }?>
                                                            <div class="col-4">
                               
                                                              <button type='submit' id="btn_newpost_update" class="btn btn-orange text-s15 textresize w-100 pt-2 pb-2 btn-update" <?php //if($r->PostAdminStatus==1)echo "disabled"; ?> value="<?php echo $r->postID?>">UPDATE</button>
                               
                                                            </div>
                                                            <!-- --- Post --- -->
                                                           
                                                            <?php if($r->usertype!=3){?>
                                                            <div class="col-4">
                                                            <button id="btn_newpost_rej" class="btn btn-red text-s15 textresize w-100 pt-2 pb-2 btn-reject" <?php if($r->PostAdminStatus=='-1')echo "disabled"; ?> value="<?php echo $r->postID?>">REJECT</button>
                               
                                                            </div>
                                                            <?php }?>
                                                            <?php }?>
                                                        </div>
                                                    </div>
                                                </div>
                               <!-- --- Buttons --- -->
                                                <div class="row mt-4" id='msgbox' <?php if($r->PostAdminStatus!='-1'){?> style=" /* display: none;*/" <?php } ?>
                                                    <div class="col-12">
                                                    <textarea id="msg" cols="30" rows="3" name="txtemail" id="postDet_Message"  class="form-control input-custom "><?php if(!empty($r->rejectMsg)) echo $r->rejectMsg;?></textarea>
                                                    <div class="col-lg-3 col-md-4 col-sm-4 col-6 ml-auto mt-2">
                                                        <button id="postDet_BtnSend" value="<?php echo $r->postID?>"  class="btn btn-orange text-s14 w-100 pt-2 pb-2 text-normal">
                                                            Send Message
                                                        </button>
                                                    </div>
                                                    </div>
                                                  
                                                </div>

                                            </div>
                                        </div>
                                    </form>
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


            <style>
            .loader {
  display: block;
  width: 5em;
  margin: 10% auto;
}

@-webkit-keyframes rotate {
  0% {
    -webkit-transform: translateY(0%);
  }
  30% {
    -webkit-transform: translateY(-0.25em);
  }
  50% {
    -webkit-transform: translateY(0%);
  }
  70% {
    -webkit-transform: translateY(0.25em);
  }
}
.loader {
  display: block;
}
.loader .inner1, .loader .inner2, .loader .inner3 {
  display: inline-block;
  margin: 0.125em;
  width: 0.5em;
  height: 0.5em;
  border: 1px solid lightgray;
  border-radius: 1em;
  background-color: lightgray;
  -webkit-transform-origin: 50%;
  -webkit-animation-duration: 0.75s;
  -webkit-animation-name: rotate;
  -webkit-animation-iteration-count: infinite;
  -webkit-animation-timing-function: linear;
}
.loader .inner2 {
  -webkit-animation-delay: 0.1875s;
}
.loader .inner3 {
  -webkit-animation-delay: 0.375s;
}

            </style>
            <div id="loader">
  <span class="inner1"></span>
  <span class="inner2"></span>
  <span class="inner3"></span>
</div>
              <script>
                $('#loading-image').bind('ajaxStart', function(){
                    $(this).show();
                }).bind('ajaxStop', function(){
                    $(this).hide();
                });




              var brandmodel;
              var model;
              var cat;
              var lookup = function(obj, key) {
                var type = typeof key;
                if (type == 'string' || type == "number") key = ("" + key).replace(/\[(.*?)\]/, function(m, key){//handle case where [1] may occur
                    return '.' + key;
                }).split('.');
                for (var i = 0, l = key.length, currentkey; i < l; i++) {
                   // console.log(key[i]);
                  
                    if (obj.hasOwnProperty(key[i])) obj = obj[key[i]];
                    else return undefined;
                }
               
                return obj;
            }

            var change_content = function(brandmodel,itm,$dropdown){
                
                
               // console.log(itm);
              //  console.log($dropdown);
                
                                $dropdown.empty();
                                check = itm.find(':selected').data('cat');
                                model=lookup(brandmodel.data, check.trim());
                               
                                cat = itm.val();
                                cat2=parseInt(cat)
                                //console.log(itm.find(':selected').data('cat'));
                                switch(cat2) {
                                            case 3:
                                            
                                            $("#brandname").text("Emirates");
                                            $("#year").text("Number");
                                            $("#model").text("NP Code");
                                            $("#model").parent().find('select').remove();
                                            $("#model").parent().find('input').remove();
                                            $("#model").parent().append('<select class="form-control reginputs postDet_inputs" id="3" name="model" > </select>')   
                                                break;
                                            case 6:
                                                $("#brandname").text("Operator");
                                                $("#model").text("Prefix");
                                                $("#year").text("Number");
                                                $("#model").parent().find('select').remove();
                                                $("#model").parent().find('input').remove();
                                                $("#model").parent().append('<select class="form-control reginputs postDet_inputs" id="3" name="model" > </select>')
                                                
                                                break;
                                            case 9:
                                                $("#brandname").text("SC");
                                                $("#model").text("Type");
                                                $("#year").text("Location");
                                                $("#model").parent().find('select').remove();
                                            $("#model").parent().find('input').remove();
                                            $("#model").parent().append('<select class="form-control reginputs postDet_inputs" id="3" name="model" > </select>')
                                                
                                                break;
                                           default:
                                           $("#brandname").text("Brand");
                                                $("#model").text("Model");
                                                $("#year").text("Year");
                                                $("#model").parent().find('select').remove();
                                                $("#model").parent().append('<select class="form-control reginputs postDet_inputs" id="3" name="model" > </select>')
                                                $("#model").parent().find('input').remove();
                                       
                                                break;
                                     
                                             }
                                        $.each(model, function(i, itm) {
                                
                                            $dropdown.append($("<option />").val(itm.brandName).text(itm.brandName).attr('data-info', i));
                                        });
                                        
                               // brand=lookup(model.itm.brandName, 0);
                               
                               var $dropdown = $("#3");
                                $dropdown.empty();
                                console.log(model[0].brandModels);
                                $.each(model[0].brandModels, function(i, item) {
                        
                                    $dropdown.append($("<option />").val(item).text(item).attr('data-info', i));
                                });
                              
            }
         
                $(document).ready(function() {
                    $.get( "<?php echo base_url(); ?>/TraderController/getbrandmodels", function( result ) {
                brandmodel =result ;
                //elem=$('#1');
                                
               // var $dropdown = $("#2");
                //change_content(brandmodel,elem,$dropdown);
                  });

               /*   $.each(brandmodel, function(i, item) {
                  //  console.log(i);
                  // console.log(item);
                });*/
                    $(document).on('change', 'select', function(e) {
                      elem=$(this);
                        id_data = $(this).attr('id');
                        switch(id_data) {
                            case '3':
                                break;
                            case '2':
                            
                                var $dropdown = $("#3");
                                $dropdown.empty();
                                check = $(this).find(':selected').data('info');
                                models=brandmodel.data[$('#1').find(':selected').data('cat')][check].brandModels;
                                
                                //brand=lookup(model, check);
                                
                                $.each(models, function(i, item) {
                        
                                    $dropdown.append($("<option />").val(item).text(item).attr('data-info', i));
                                });
                                /* console.log(lookup(brandmodel.data, $(this).val()));
                                $.each(lookup(brandmodel.data, $(this).val()), function(i, item) {
                                
                                    $dropdown.append($("<option />").val(i).text(item.brandName));
                                });*/
                                break;
                           
                            case '1':
                           
                                var $dropdown = $("#2");
                                change_content(brandmodel,elem,$dropdown);

                                break;
                            default:
                            break;
                                                         //=> "List"
                        //lookup(data, "data.location.items[1].address.street") //=> ""1323 South St"
                        }
                    });
                    $('#chk_price').click(function () {
                        if ($('#chk_price').is(':checked')) {
                            $('#txt_cprice').prop("disabled", true);    
                            $('#txt_cprice').val("");   
                        } 
                        else {
                      
                            $('#txt_cprice').prop("disabled", false);   
                            $('#txt_cprice').val("");   
                        }
                    }); 

//               TODO DOWNLOAD AND UPLOAD
//                     $(document).on('click', 'input:file.filePhoto', function(e) {
//                         e.stopImmediatePropagation();
//                         swal({
//   title: "Please chose an action'",
//   type: "warning",
//   showCancelButton: true,
//   confirmButtonClass: "btn-success download_btn",
//   confirmButtonText: "Download",
//   cancelButtonClass: "btn-primary",
//   cancelButtonText: "Upload",
//   closeOnConfirm: false,
//   closeOnCancel: false
// },
// function(isConfirm) {
//   if (isConfirm) {
//     swal("Downloaded", "Your file has been downloaded", "success");
//     e.stopImmediatePropagation();
//   } 
// });

// $( "body" ).on( "click", "button.download_btn", function() {
//                     alert('hi');
                       
//                 });
                        
//                     });
                    



                    $(document).on('change', 'input:file.filePhoto', function(e) {
  // Does some stuff and logs the event to the console'
                    var parent=$(this).parent()
                    var img=parent.find('.postImage');
                 
                    var reader = new FileReader();
                    reader.onload = function (event) {
                        img.attr('src',event.target.result);
                        $("#myVideo")[0].load();
                    }
                    
                    reader.readAsDataURL(e.target.files[0]);
                    var canvas = document.getElementById('canvas');
                     var video = document.getElementById('myVideo');
    //canvas.getContext('2d').drawImage(video, 0, 0, video.videoWidth, video.videoHeight);
   
  //var video = $("#myVideo");
  //screenshot(video);

                    var i = 0, len = this.files.length, img, reader, file;
    
                    video.addEventListener('loadeddata', function() {
      canvas.getContext("2d").drawImage(video, 0, 0, 300, 150);
      var canvasData = canvas.toDataURL("image/png");
      
      var output=canvasData.replace(/^data:image\/(png|jpg);base64,/, "");
     
      document.getElementById('videoThumbnail').value = output;

}, false);
   
//     for ( ; i < len; i++ ) {
//       file = this.files[i];
  
    
//     }
//     if (formdata) {
//   formdata.append("images[]", file);
// }
                    });


                  

                });
                function screenshot(video) {
				var canvas = document.createElement("canvas");
				canvas.height = 100;
				canvas.width = 200;
				var ctx = canvas.getContext("2d");
				ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
				canvas.style.width = 'inherit';
				canvas.style.height = 'inherit';
				return canvas;
			}
            </script>
            <script>
               $( "body" ).on( "click", "#btn_newpost_update", function() {
        
                document.updateform.submit();
                });
                $( document).on( "click", "#btn_newpost_appr", function(e) {
                    e.preventDefault();
                    post_id = $(this).val();
                    $this = $(this);
                    $.ajax({
                        url: "<?php echo base_url(); ?>admin/Dashboard/admin_approve_post",
                        data : {'post_id':post_id},
                        type: "POST",
                        
                        success:function(data) {
                            if(data == 'success') {
                                swal('Post is approved successfully',"", "success"); 
                                $this.attr("disabled", "disabled");
                                    }
                        }
                    });
                
                });
                $( "body" ).on( "click", "button.confirm", function() {
                    location.href='<?php echo base_url()?>admin/Dashboard/admin_new_post';
                       
                });
                
                 $( document).on( "click", "#btn_newpost_rej", function(e) {
                 
                    e.preventDefault();
                    $(this).attr("disabled", "disabled");
                     $('#msgbox').show();
                     $('#postDet_BtnSend').focus();
                     $('#msg').focus();
                     
                     //$('#msgbox').animate({ height: "4em" }, 500);
                
             });

                 $(document).on( "click", "#postDet_BtnSend", function(e) {
                    e.preventDefault();
                    post_id = $(this).val();
                    var trader = $('#traderId').val();
                    $this = $(this);
                    var message = $('#msg').val();
                    $.ajax({
                        url: "<?php echo base_url(); ?>admin/Dashboard/admin_reject_post",
                        data : {'post_id':post_id,'message':message,'trader_id':trader},
                        type: "POST",
                        
                        success:function(data) {
                            if(data == 'success') {
                                swal('Post is rejected successfully','','success'); 
                                $this.attr("disabled", "disabled");
                              //   location.href='<?php echo base_url()?>admin/Dashboard/admin_new_post';
                              
                              $('#btn_newpost_rej').attr("disabled", "disabled").html('Rejected');
                            }
                        }
                    });
                });
            
                                                var vid = document.getElementById("myVideo");
                                                vid.autoplay = true;
                                                vid.load();
                                                $( ".postDet_Checkbox" ).on( "change", function() {
                                                    var thisCheck = $(this);
                                                if ($(this). prop("checked") == true)
                                                {
                                                    $( "#price_input").attr('disabled',true);
                                                }else{
                                                    $( "#price_input").attr('disabled',false);
                                                
                                                }
                                                });
                                            
            </script>