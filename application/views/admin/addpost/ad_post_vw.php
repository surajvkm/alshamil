<?php $type = $cat_type->type; ?>

<input  type="hidden" name="cat_type" value="<?php echo $type ?>"/>
<?php 


if($type==3){
	


$datam=array();
foreach($qry as $row){
$data=  array('lab'=>$row->lab);
$datam[] =$data;
} ?>


<script>
	var tot = <?php echo count($qry)  ?>;
</script>

<?php

$count=1;
foreach($datam as $key=>$value) { 

$nextdiv = '';
if (array_key_exists($count,$datam)){
	
	$nextdiv = $datam[$count]['lab'];
	
}else{
	$nextdiv = 'notree_'.$count;
}




?>
<div class="card-inp pl-0"   >
<div class="form-group">
<label class="text-s12 text-semibold" for=""><?php echo $value['lab']; ?></label>
<select class="form-control input-custom validate" onchange="fetch_model(this,'<?php echo $nextdiv; ?>','<?php echo $count; ?>')" name="<?php echo strtolower($value['lab']); ?>" id="<?php echo strtolower($value['lab']); ?>" >
<option value="">--Select--</option>
<?php 
if($key==0){	
$this->db->select('CategoryId as id, Name as name');
$this->db->where('parentCategory',$category_id);
$this->db->order_by('parentCategory','asc');
$record	= $this->db->get_where('category',array('Name'=>$value['lab']));

if($record->num_rows()>0 ){
$this->db->select('CategoryId as id, Name as name');
$this->db->where('parentCategory',$record->row()->id);
$this->db->order_by('parentCategory','asc');
$records	= $this->db->get_where('category');	
	
	
foreach($records->result() as $row):
?>
<option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>
<?php  endforeach; } } ?>
</select>
<label id="err_<?php echo $value['lab']; ?>" class="txt_errors" style="display: none;">Enter <?php echo $value['lab']; ?></label>
</div>
</div>	
<?php    
$count++; 
}
?>
<?php } elseif($type==2) {
	
	$template_qry = $this->adm->get_templatesByType();
	
?>

<div class="row mt-3">
<div class="col-6">
    <div class="form-group"> <label for="usr" class="text-s12 text-semibold">Vehicle</label>
        <select class="form-control input-custom" id="vehicle_typep" name="vehicle_type">
           <option value="">Select Vehicle Type</option>
           <option value="0">Car</option>
           <option value="1">Bike</option>
        </select>
        <label id="err_vehicle_typep" class="txt_errors">Please Vehicle Type</label>
    </div>
</div>
</div>
<div class="row mt-3">
    <div class="col-6" id="txthidbrand">
    <div class="form-group">
        <label for="usr" class="text-s12 text-semibold">Emirates</label>

        <select class="form-control  input-custom fontsize-12" id="txtemirates" style="width: 177px;" name="txtemirates">
            <option value="">Please Select Emirates</option>
            <?php
            foreach ($template_qry as $r) {
                ?>
                <option value="<?php echo $r->noplateTempID ?>"><?php echo $r->emirates ?></option>
                <?php
            }
            ?>


        </select>
        <label id="err_txtemirates" class="txt_errors">Please Select Emirates</label>
    </div>
</div>
 <div id="codeDiv" class="col-6" >
        <div class="form-group">
            <label for="usr" class="text-s12 text-semibold">Code<!-- <p id="testp"></p> --></label>
            <select class="form-control  input-custom" name="txtcode" id="txtcode">
                <option value="">--Select--</option>
               
            </select>
            <label id="err_txtcode" class="txt_errors">Please Select Code</label>
        </div>
    </div>

</div>
<div class="row mt-3" id="em_row">

    <div class="col-lg-5 col-md-5 col-5 ml-lg-3 ml-md-3 ml-3" id="template_coldiv" >
        <div class="form-group">
            <div class="row show-plate">
                <input name="short_tempImg" type="hidden" value="" id="short_tempImg"/>    
                <div id="loading1" style="display: none"><i class="fa fa-cog fa-spin fa-2x fa-fw"></i> Loading..</div>
                <div id="short_tmplt"></div>
                <img style="display: none" src="" id="template_img" style="width:130px;">
                <input type="hidden" id="num_short" name="num_front">
            </div>
        </div>
    </div>

       <div class="col-lg-5 col-md-5 col-5 ml-lg-5 ml-md-5 ml-4 ml-sm-5" id="template_coldiv" >
        <div class="form-group">
            <div class="row show-plate pl-lg-3">
                <input name="long_tempImg" type="hidden" value="" id="long_tempImg"/>    
                <div id="loading1" style="display: none"><i class="fa fa-cog fa-spin fa-2x fa-fw"></i> Loading..</div>
                <div id="long_tmplt"></div>
                <img style="display: none" src="" id="long_template_img" style="width:130px;">
                <input type="hidden" id="num_long" name="num_front">
            </div>
        </div>
    </div>
</div>
<div class="row mt-3">
<!-- --- Price --- -->
<div class="col-6">
<div class="form-group ">

        <label for="usr" class="text-s12 text-semibold">Number of Digit</label>
        <select class="form-control input-custom" name="txtno_digs" id="txtno_digs">
            <option value="">--Select--</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
</div>
</div>
<!-- --- Add price --- -->
<div class="col-6">
  <div class="form-group">
            <label for="usr" class="text-s12 text-semibold">Number</label>
            <input type="text" name="txtnumber" id="txtno" class="form-control input-custom">

            <label id="err_txtno" class="txt_errors">Enter Number</label>
        </div>
</div>
</div>


<?php } else { ?>
<div class="row mt-3">
<div class="col-6"   >
    <div class="form-group">
        <label for="usr" class="text-s12 text-semibold">Operator</label><br>
        <button class="btn btn-default btnmn moboper btn_etisalat_admin ets-btn" id="btn_etisalat_admin" style="background:#5b8316;">Etisalat</button>
        <button class="btn btn-default btnmn moboper img_du_admin ets-btn" id="img_du_admin" style="background:#009fce;">DU</button>
        <button class="btn btn-default btnmn moboper btn_other_admin ets-btn" id="btn_other_admin" style="background:#999;">Other</button>
        <input type="hidden" name="operator" id="operator"/>
        <label id="err_operator" class="txt_errors">Enter Operator</label>
    </div>
</div>
</div>
<div class="row mt-3">
<div class="col-12">
    <center>
        <div class="form-group">
            <div class="show-plate mobile-plate">
                <input name="temp" type="hidden" value="" id="tempImg"/>    
                <div id="loading2" style="display: none"><i class="fa fa-cog fa-spin fa-2x fa-fw"></i> Loading..</div>
                <img style="display: none" src="" id="template_img" style="width:130px;">
                <img src="<?php echo base_url() ?>img/no_preview.png" id="newImg" style="width:130px;">
                <img  id="genImg" style="width:130px;display:none;">

            </div>
        </div>
    </center>
</div>
</div>
<div class="row mt-3">
<!-- --- Model --- -->
<div class="col-6">
<div class="form-group">    
<label for="usr" class="text-s12 text-semibold" >Prefix</label>
        <select class="form-control" id="txtmainprefix" name="txtmainprefix">
           <option value="">--Select--</option>
        </select>
        <label id="err_prefix" class="txt_errors">Enter prefix</label>
    </div>
</div>

<div class="col-6">
   <div class="form-group">
        <label for="usr" class="text-s12 text-semibold" >Mobile Number</label>
        <input type="text" pattern=".{5,13}" required title="Enter 5 to 13 characters" name="txtmob" class="form-control input-custom" id="txtmobb" required >
        <label id="err_txtmob" class="txt_errors">Enter Number</label>
    </div>
</div>
</div>
<?php } ?>


<div class="">
<?php 

if($query_properties->num_rows()>0){
	
foreach($query_properties->result() as $rs):


?>

<div class="card-inp pl-0"   >
<div class="form-group">
<label class="text-s12 text-semibold" for=""><?php echo $rs->name; ?></label>

<input type="text" name="txtp_<?php echo $rs->name ?>"  id="txtp_<?php echo $rs->name ?>" class="form-control input-custom validate" >
<label id="err_<?php echo $rs->name; ?>" class="txt_errors" style="display: none;">Enter <?php echo $rs->name; ?></label>
</div>
</div>


<?php endforeach; } ?>

</div>

<div class="row mt-3">
<!-- --- Price --- -->
<div class="col-12">
<div class="form-group">
<label class="text-s12 text-semibold" for="">Product Title</label>
<input type="text" name="txt_prtitle"  id="txt_prtitle" class="form-control input-custom" >
<label id="err_txtitle" class="txt_errors">Enter Product Title</label>
</div>
</div>
<!-- --- Add price --- -->
<div class="col-12">
<div class="form-group">
<label class="text-s12 text-semibold" for="">Product Title Arabic</label>
<input type="text" name="txt_prtitle_ar"  id="txt_prtitle_ar" class="form-control input-custom" >
<label id="err_prtitle_ar" class="txt_errors">Enter Product Title Arabic</label>
</div>
</div>
</div>

<div class="row mt-3">
<!-- --- Price --- -->
<div class="col-6">
<div class="form-group pb-lg-2 bb1">
<label class="text-s12 text-semibold" for="">Price</label>
<div class="custom-control custom-checkbox ml-lg-3">

    <input type="checkbox"  class="custom-control-input" name="call_for_price" id="chkbox_callpr1">
    <label class="custom-control-label" for="chkbox_callpr1">Call for Price</label>
</div>
</div>
</div>
<!-- --- Add price --- -->
<div class="col-6">
<div class="form-group">
<label class="text-s12 text-semibold" for="">Add price</label>
<input type="text" name="txtprice"  id="txt_cprice" class="form-control input-custom" >
<label id="err_txtprice" class="txt_errors">Enter Price</label>
</div>
</div>
</div>

<!-- --- Details --- -->
<div class="row mt-3">
<div class="col-12">
<label class="text-s12 text-semibold" for="">Details</label>        
<textarea id="txtdetails" name="txtdetails" class="form-control input-custom" id="" cols="30" rows="5"></textarea>
<label id="err_txtdetails" class="txt_errors">Enter Details</label>
</div>
</div>

<div class="row mt-3">
<div class="col-12">
<label class="text-s12 text-semibold" for="">Details in Arabic</label>        
<textarea id="txtdetails_ar" name="txtdetails_ar" class="form-control input-custom" id="" cols="30" rows="5"></textarea>
<label id="err_txtdetails_ar" class="txt_errors">Enter Details</label>
</div>
</div>

<?php if($type==3){ ?>
<div class="row mt-3">
<div class="col-12">
<label class="text-s12 text-semibold" for="">Add Photo & Video</label>
<div class="col-12 pr-0">
<div class="row">

    <!-- Below : Example template after uploading picture -->
    <!-- <div class="card add-card">
        <div class="h-100">
            <input type="file" class="custom-file-input h-100" id="">
            <img class="postImage" src="../../assets/images/car/car3.jpg" alt="">
        </div>
    </div> -->

    <div class="card add-card">
        <!-- The below "addIcon" div shows before uploading a file
            after uploading file, "addIcon" div is replaced with the "img" tags -->

        <!-- "addIcon-P" for photos -->
        <div class="addIcon-P h-100">
        
            <div class="dropZoneContainer" id="drop_camera">
            <input type="file" id="car_img" name='txtimage' class="custom-file-input h-100 FileUpload" accept=".jpg,.png,.gif"  />
            <p class="text-s12 text-semibold">Add Photos</p>
            <input type="hidden" id="txt_hidaudio">
            <div class="dropZoneOverlay">
                
                    <img id="audi_prev_icon"  alt=''>
                </div>
                    </div>
        </div>


     <label id="err_txtaudio" class="txt_errors">Please Upload a Image</label>
    </div>

  
    <div class="card add-card">
        <!-- The below "addIcon" div shows before uploading a file
            after uploading file, "addIcon" div is replaced with the "img" tags -->

        <!-- "addIcon-V" for Videos -->
        <div class="addIcon-V h-100">

        <div class="dropZoneContainer" id="drop_video">
            <input type="file" id="drop_zone_vedio" name="productVideo" class="custom-file-input h-100 FileUpload" style='position:absolute;top:0; left:0;'/>
            <input type="hidden" name="poster" id="pre" value="">
            
            </input>
            <input type="hidden" id="hid_cvideo">
            <video id="myVideo"  controls="controls" style='height: 100%;background: #000; width: 100%;'>                                                            
                                <source src="" type="video/mp4">
                            
                            </video> 
            <p class="text-s12 text-semibold">Add Video</p>
            <div class="dropZoneOverlay">
            
            </div>
        </div>
      </div>
    </div>


    <div class="card add-card">
        <!-- The below "addIcon" div shows before uploading a file
            after uploading file, "addIcon" div is replaced with the "img" tags -->

        <!-- "addIcon-P" for photos -->
        <div class="addIcon-P h-100">
                <div class="form-group">
                    <div class="col-md-3 pl-0 paddingright11">
                                <button id="btn_addmore" class="add_button">Add More Photos</button>
                    </div>
                </div>
           
        </div>
        </div>
  
        <div class="row">
            <div class="col-sm-12" >

                <div class="field_wrapper" style='display: inline-flex;'></div>

            </div>
        </div>


</div>
</div>
</div>
</div>

<?php } ?>





<?php if($type==2){ ?>
<script>

$(document).ready(function () {
       
        $('#vehicle_typep').change(function () {
              var type = $(this).val();
              $('#txtno').val('');
              $('#short_tmplt').html('');
              $('#long_tmplt').html(''); 
             var html = '<option value="">Please Select Emirates</option>';
             if(type==0){
                html +=  ' <option value="1">Dubai</option>\
                            <option value="2">Umm Al Quwain</option>\
                            <option value="3">Ajman</option>\
                            <option value="4">Ras al Khaima</option>\
                            <option value="5">Fujairah</option>\
                            <option value="6">Abu Dhabi</option>\
                            <option value="7">Sharjah</option>';
             }else if(type==1){
                 html +=  ' <option value="8">Dubai</option>\
                            <option value="9">Umm Al Quwain</option>\
                            <option value="10">Ajman</option>\
                            <option value="11">Ras al Khaima</option>\
                            <option value="12">Fujairah</option>\
                            <option value="13">Abu Dhabi</option>\
                            <option value="14">Sharjah</option>';
             }
             $('#txtemirates').html(html);

        });
        $('#txtemirates').change(function () {
            $('#template_img').hide();
            $('#loading2').show('fast');
            var emirates = $(this).val();

             var type = $('#vehicle_typep').val();
            if(type==1 && emirates!=8){
                $('#codeDiv').hide();
            }else{
                 $('#codeDiv').show();
            }
            $('#txtno').val('');
            $.ajax({
                url: "<?php echo base_url('admin/fetch_temp_img'); ?>",
                data: {'emirates': emirates,'type':type},

                type: "POST",
                dataType: 'json',
                success: function (data) {
                
                    
                    $('#short_tmplt').html('<img id="newImg" src="'+data.templates+'" id="" style="width:130px;">');
                    $('#template_img').attr('src', data.templates);

                    // $('#newImg').append('<img style="display: none" src="'+data.templates+'" id="template_img" style="width:130px;">');

                    $('#long_tmplt').html('<img id="long_newImg" src="'+data.long_template+'" id="" style="width:130px;">');
                     $('#long_template_img').attr('src', data.long_template);
                     $('#loading2').hide();
                   
                }

            });
        });
        $('#txtemirates').change(function () {
            $('#template_img').hide();
            $('#loading2').show('fast');
            var emirates = $(this).val();


            $.ajax({
                url: "<?php echo base_url('admin/fetch_temp_code'); ?>",
                data: {'emirates': emirates},

                 type: "POST",
                dataType: 'json',
                success: function (data) { $('#loading2').hide();
               
                   
                   // $('#txtcode').empty();

                    $.each(data,function(id,city)
                    {
                        var opt = $('<option />'); // here we're creating a new select option for each group
                        opt.val(id);
                        opt.text(city);
                        $('#txtcode').append(opt);
                    });

                }

            });
        });
        $('#txtcode').change(function () {
        
            $('#template_img').hide();
            $('#loading2').show('fast');
            var emirates = $('#txtemirates').val();
            var type = $('#vehicle_typep').val();
            var max         = $('#txtno_digs').val();
                generate_no_plate(max,max);
            // $.ajax({
            //     url: "<?php echo base_url('admin/Dashboard/fetch_temp_img'); ?>",
            //     data: {'emirates': emirates,'type':type},

            //     type: "POST",
            //     dataType: 'json',
            //     success: function (data) {
      
                    
            //         $('#short_tmplt').html('<img id="newImg" src="'+data.templates+'" id="" style="width:130px;">');
            //         $('#template_img').attr('src', data.templates);

            //         // $('#newImg').append('<img style="display: none" src="'+data.templates+'" id="template_img" style="width:130px;">');

            //         $('#long_tmplt').html('<img id="long_newImg" src="'+data.long_template+'" id="" style="width:130px;">');
            //          $('#long_template_img').attr('src', data.long_template);
            //          $('#loading2').hide();
                   
            //     }

            // });
        });
   
        $('#txtno_digs').change(function () {
            var limit = $(this).val();
            $('input#txtno').val('');
            $('input#txtno').attr('maxlength', limit); 
        });
          var generateNumberPlate =  $('#txtno').keyup(function () {
                var count       = this.value.length;
                var max         = $('#txtno_digs').val();
                generate_no_plate(count,max);
        });

function generate_no_plate(count,max){
    if(count == max){
                    var emrId       = $('#txtemirates').val();
                    $('#err_txtno').css('display', 'none');
                    var type = $('#vehicle_typep').val();
                    if(type==1 && emrId!=8){
                       var code        = '';
                    }else{
                        var code       = $('#txtcode').val();
                    }
                    
                    var srcimg      = $('#template_img').attr('src');
                    var srcimg_long = $('#long_template_img').attr('src');
                    var tarr        = srcimg.split('/');
                    var file_name   = tarr[tarr.length - 1];

                    var tarr        = srcimg_long.split('/');
                    var file_name_long   = tarr[tarr.length - 1];
                    var temp        = $('#short_tempImg').val();

                    var np_no       = $('#txtno').val();
                    var res         = code + " " + np_no;
                    $('#tem_name').html(res);

                    //$('#template_img').hide();
                    $('#loading1').show('fast');
                    var type = $('#vehicle_typep').val();
                    if(type==0){
                            $.ajax({
                            url: "<?php echo base_url('admin/generate_nopl_temp'); ?>",
                            data: {'res': res, 'srcimg': file_name, 'emrId': emrId, 'short_tempImg': temp,'srcimg_long':file_name_long},
                            type: "POST",
                            dataType: 'json',
                            success: function (data) { 
                                 $('#short_tmplt').html('<img id="newImg" src="'+data.short+'" id="" style="width:130px;">');
                                 $('#num_short').val( data.short);
                                 $('#short_tempImg').val( data.short);
                           
                            $('#long_tmplt').html('<img id="long_newImg" src="'+data.long+'" id="" style="width:130px;">');
                            $('#num_long').val( data.long);
                            $('#long_tempImg').val( data.long);
                                //$('#newImg').attr('src', data);
                                $('#loading1').hide();
                                //$('#tempImg').val(data);
                               
                            }
                        });
                    }else{
                            $.ajax({
                            url: "<?php echo base_url('admin/generate_nopl_temp_bike'); ?>",
                            data: {'res': res, 'srcimg': file_name, 'emrId': emrId, 'short_tempImg': temp,'srcimg_long':file_name_long},
                            type: "POST",
                            dataType: 'json',
                            success: function (data) { 

                                $('#short_tmplt').html('<img id="newImg" src="'+data.short+'" id="" style="width:130px;">');
                                $('#num_short').val( data.short);
                                $('#short_tempImg').val( data.short);


                                $('#long_tmplt').html('<img id="long_newImg" src="'+data.long+'" id="" style="width:130px;">');
                                $('#num_long').val( data.long);
                                $('#long_tempImg').val( data.long);
                                //$('#newImg').attr('src', data);
                                $('#loading1').hide();
                                //$('#tempImg').val(data);
                               
                            }
                        });
                    }
                    
                }
}

		$('#txtemirates').change(function () {
            $('#err_txtemirates').css('display', 'none');
        });
        /*$('#txtcategorya').change(function(){
         $('#err_txtcat').css('display','none'); 
         });*/
        $('#txtcode').change(function () {
            $('#err_txtcode').css('display', 'none');
        });
        $('#txtno_digs').change(function () {
            $('#err_txtno_digs').css('display', 'none');
            
        });

        $('#txt_cprice').keyup(function () {
            $('#err_txtprice').css('display', 'none');
        });
        $('#txtdetails').keyup(function () {
            $('#err_txtdetails').css('display', 'none');
        });
        
        $('#vehicle_typep').change(function () {
            $('#err_vehicle_typep').css('display', 'none');
        });
        
        $('#txtno').keyup(function (){
			
			var txtemirates     = $('#txtemirates option:selected').text();
            var txtcode         = $('#txtcode').val();
            var txtno_digs      = $('#txtno_digs').val();
            var txtno           = $('#txtno').val();
            var vehicle_typep   = $('#vehicle_typep option:selected').text();
           
            var val = vehicle_typep +' '+ txtemirates + ' ' + txtcode + ' '+txtno
            $('#txt_prtitle').val(val)
		});
        

        $('#btnsavepost').click(function (e) {
        	
        	
            e.preventDefault();
            var txtemirates     = $('#txtemirates').val();
            var txtcode         = $('#txtcode').val();
            var txtno_digs      = $('#txtno_digs').val();
            var txtno           = $('#txtno').val();
            var vehicle_typep   = $('#vehicle_typep').val();
            var txtprice        = $('#txt_cprice').val();
            var txtdetails      = $('#txtdetails').val();
            var txt_prtitle = $('#txt_prtitle').val();
            var setprice;
              if ($('#chkbox_callpr1').is(':checked'))
           {
               setprice=1;

           } else if(txtprice!=='')
           {
               setprice=1;
           }
            if ( (txt_prtitle =='') || (vehicle_typep=='')   || (txtemirates == '') || (txtcode == '') || (txtno_digs == '') || (txtno == '') ||  (txtdetails == '')||(setprice!=1))
            {
                if (txtemirates == '')
                {
                    $('#err_txtemirates').css('display', 'block');
                }
                if (txtcode == '')
                {

                    $('#err_txtcode').css('display', 'block');

                }
                if (txtno_digs == '')
                {

                    $('#err_txtno_digs').css('display', 'block');

                }
                if (txtno == '')
                {

                    $('#err_txtno').css('display', 'block');
                }
                if ($('#chkbox_callpr1').is(':checked'))
                {

                    $('#err_txtprice').css('display', 'none');

                } else
                {
                    if (txtprice == '')
                    {
                        $('#err_txtprice').css('display', 'block');
                    }

                }


                if (txtdetails == '')
                {

                    $('#err_txtdetails').css('display', 'block');

                }
                
                if((vehicle_typep=='')){
					
					
					
					 $('#err_vehicle_typep').css('display', 'block');
					
				}
				
				if((txt_prtitle=='')){
					
					
					
					 $('#err_txtitle').css('display', 'block');
					
				}

                //return false;
            } else
            {
                $('#btnsavepost').prop('disabled',true);
                $('#loading').show();
                $("#myForm").submit();
                // var form = $('#myForm')[0];
                // var formData = new FormData(form);


                // $.ajax({
                //     url: "<?php echo base_url('admin/Dashboard/save_noplatepost'); ?>",

                //     data: formData,
                //     contentType: false,
                //     cache: false,
                //     processData: false,
                //     type: "POST",

                //     success: function (data) {
                //         swal("Your Product Added Successfully");
                //          $('#loading').hide();
                         
                //         $("#postForm").submit();     
                //         }

                // });
            }


        });
});
</script>




<?php } ?>
<?php if($type==1){ ?>
<script>
	
$(document).ready(function () {	
	  $('.moboper').click(function(e){
           $('#btn_etisalat_admin').css('border','1px solid #d3dcdc'); 
            $('#img_du_admin').css('border','1px solid #d3dcdc'); 
            $('#btn_other_admin').css('border','1px solid #d3dcdc'); 
            $(this).css('border','2px solid #f5821f');
             
             e.preventDefault();
            var mob_oper = $(this).html();
           $('#operator').val(mob_oper);
            $.ajax({
                url: "<?php echo base_url('admin/fetch_mob_pref'); ?>",
                
                data: {'mob_oper': mob_oper},
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#txtmainprefix').empty();
                    $('#newImg').css('display', 'block');
                        $('#genImg').css('display', 'none');
                    $.each(data, function (id, city)
                    {
                        var opt = $('<option />'); // here we're creating a new select option for each group
                        opt.val(id);
                        opt.text(city);
                        $('#txtmainprefix').append(opt);
                    });
                    
                }

            });
        });
       // $('#txtmobb').keydown(function(e){-1!==$.inArray(e.keyCode,[46,8,9,27,13,110,190])||(/65|67|86|88/.test(e.keyCode)&&(e.ctrlKey===true||e.metaKey===true))&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()});
    
            $("#txtmobb").keydown(function (e) {
                var max_chars =10;
        // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    // Allow: Ctrl+A, Command+A
                    (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
                    // Allow: home, end, left, right, down, up
                    (e.keyCode >= 35 && e.keyCode <= 40)) {
           
                 // let it happen, don't do anything
                 return;
        }else{
            
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
         
            e.preventDefault();
        }else{
            if ($(this).val().length >= max_chars) { 
                        e.preventDefault();
                        swal('5 - 10 charecters  are allowed','','error');
            }
        }
    
              
    });
           $('#txtmobb').blur(function () {
           	
           	var operator = $('#operator').val();
           	    if(operator!=''){
            var min_chars =5;
            if ($(this).val().length < min_chars) { 
               $('#err_txtmob').css('display', 'block');
                swal('5 - 10 charecters  are allowed','','error');
                
              }else{
			  	$('#err_txtmob').css('display', 'none');
			  }
                var operator = $('#operator').val();
                var mobno = $(this).val();
                var prefix = $('#txtmainprefix').val();
                var srcimg      = $('#template_img').attr('src');
                var res         = prefix + " " + mobno;
                //alert(srcimg+"-"+temp);return false;
                $('#template_img').hide();
                $('#loading2').show('fast');
                $.ajax({
                    url: "<?php echo base_url('admin/generate_mob_temp'); ?>",
                    data: {'res': res, 'srcimg': srcimg,'operator': operator},
                    type: "POST",

                    success: function (data) { 
                        console.log(data);
                       $('#newImg').css('display', 'none');
                        $('#genImg').css('display', 'block');
                        $('#genImg').attr('src', data);
                        $('#loading2').hide();
                        $('#tempImg').val(data);

                    }
                });
}else{
				swal('Select a Operator','','error');
			}
        });
        $('#btn_etisalat_admin').click(function (e) {
         
             e.preventDefault();
            var imgSrc = '<?php echo base_url()?>img/mobno/base_images/Mobile-etisalath.png';
            $('#template_img').attr('src', imgSrc);
            $('#newImg').attr('src', imgSrc); 
        });
        $('#img_du_admin').click(function (e) {
            e.preventDefault();
            var imgSrc = '<?php echo base_url()?>img/mobno/base_images/Mobile-Du.png';
            $('#template_img').attr('src', imgSrc);
            $('#newImg').attr('src', imgSrc); 
        });
       
        $('#btn_other_admin').click(function (e) {
             e.preventDefault();
             var imgSrc = '<?php echo base_url()?>img/mobno/base_images/Other-Phone.png';
            $('#template_img').attr('src', imgSrc);
            $('#newImg').attr('src', imgSrc); 
           
        });
        
        $('#txtmobb').keyup(function () {
        
         var operator = $('#operator').val();
         var mobno =$('#txtmobb').val();
         var val = operator +' '+ mobno + ' ' 
            $('#txt_prtitle').val(val)
		});
        
        
 $('#btnsavepost').click(function (e) {             e.preventDefault();
         
            
            var txtmob = $('#txtmobb').val();
            var txtprice = $('#txt_cprice').val();
            var txtdetails = $('#txtdetails').val();
            var txt_prtitle = $('#txt_prtitle').val();
            var setprice;
           

           if ($('#chkbox_callpr1').is(':checked'))
           {
            
               setprice=1;

           } else if(txtprice!=='')
           {
               setprice=1;
           }
            if ( (txt_prtitle == '') ||   (txtmob == '')  || (txtdetails == '')||(setprice!=1))
            {
                
                
                if (txtmob == '')
                {

                    $('#err_txtmob').css('display', 'block');

                }
                if ($('#chkbox_callpr1').is(':checked'))
                {

                    $('#err_txtprice').css('display', 'none');

                } else
                {
                    if (txtprice == '')
                    {
                        $('#err_txtprice').css('display', 'block');
                    }


                }
               
               
                if (txtdetails == '')
                {

                    $('#err_txtdetails').css('display', 'block');

                }
                
                if(txt_prtitle ==''){
                	
                	$('#err_txtitle').css('display', 'block');
					
				}
              
            } else
            
            {
               
             $('#btnsavepost').prop('disabled',true);
               $('#loading').show();
               $("#myForm").submit();
    //             var form = $('#myForm')[0];
    //             var formData = new FormData(form);
               
    //             $.ajax({
                   
    //                 url: "<?php echo base_url('admin/Dashboard/save_mnaddpost'); ?>",
    //                 data: formData,
    //                 contentType: false,
    //                 cache: false,
    //                 processData: false,
    //                 type: "POST",

    //                  success: function (data) {
    //                     swal("Your Product Added Successfully");
    //                     $('#loading').hide();
                        
    //                    $("#postForm").submit();
                 
                            
    // }


    //             });
            }
        });


});
</script>
<?php } ?>
<?php if($type==3){ ?>
<script>
$(document).ready(function () {
var test_array = new Array();
$('#btnsavepost').click(function (e) {             e.preventDefault();


$dynamic = $('.validate');



var res = $('#chkbox_callpr1').is(':checked');
var txtprice = $('#txt_cprice').val();

var txtcat = $('#txtcategorya').val();
//alert("gfg"+txtcat);return false;
var txtbrand = $('#txtbrand').val();
var txtmodel = $('#srchccat3').val();

var txtyear = $('#txtyear').val();
var txtprice = $('#txt_cprice').val();
var txtdetails = $('#txtdetails').val();
var txtvideo = $('#hid_cvideo').val();
var txtaudio = $('#txt_hidaudio').val();

var txt_prtitle = $('#txt_prtitle').val();
var setprice;
           

           if ($('#chkbox_callpr1').is(':checked'))
           {
            
               setprice=1;

           } else if(txtprice!=='')
           {
               setprice=1;
           }
           
           
$dynamic.each(function(entry, index, array) {
    // ...
    

    
if($('#'+index.id).val()==''){
	

	
	$('#'+index.id).next('.txt_errors').css('display', 'table');
}else{
	$('#'+index.id).next('.txt_errors').css('display', 'none');
}
    
});          
           
           
           
if ( (txt_prtitle == '') || (txtdetails == '') || (txtaudio == '')||(setprice!=1))
{


if ($('#chkbox_callpr1').is(':checked'))
{

$('#err_txtprice').css('display', 'none');

} else
{
if (txtprice == '')
{
$('#err_txtprice').css('display', 'block');
}


}

if (txtdetails == '')
{

$('#err_txtdetails').css('display', 'block');

}

if (txtaudio == '')
{
$('#err_txtaudio').css('display', 'block');

}

if(txt_prtitle == ''){
	$('#txt_prtitle').css('display', 'block');
}


} else
{
$('#btnsavepost').prop('disabled',true);
$('#loading').show();
$("#myForm").submit();
// var form = $('#myForm')[0];
// var formData = new FormData(form);


// $.ajax({
// url: "<?php echo base_url('Trader/save_boatpost'); ?>",


// data: formData,
// contentType: false,
// cache: false,
// processData: false,
// type: "POST",

// success: function (data) {
// swal("Your Product Added Successfully");
// $('#loading').hide();

//  $("#postForm").submit();
// }

// });
}


});





$('#txtplace').change(function () {
$('#err_txtplace').css('display', 'none');
});
$('#txtcategorya').change(function () {
$('#err_txtcat').css('display', 'none');
});
$('#txtbrand').change(function () {
$('#err_txtbrand').css('display', 'none');
$('#err_txtmodel').css('display', 'none');
});
$('#txtmodel').change(function () {
$('#err_txtmodel').css('display', 'none');
});
$('#txtyear').change(function () {
$('#err_txtyear').css('display', 'none');
});
$('#txt_cprice').keyup(function () {
$('#err_txtprice').css('display', 'none');
});
$('#txtdetails').keyup(function () {
$('#err_txtdetails').css('display', 'none');
});


var maxField = 10; 
var addButton = $('.add_button'); 
var wrapper = $('.field_wrapper');

var x = 1; var y = '';
$(addButton).click(function (e) { 
e.preventDefault();
var fieldHTML = '<div class="card add-card"><div class="addIcon-P h-100"><div class="dropZoneContainer" id="more_drop_camera" style="width: 107px;position: relative;">'
+ '<input onchange="previewImg(id_x,event)" id="new_x" type="file"  name="txtfiles[]" type="file" id="car_img" name="" class="custom-file-input h-100 FileUpload"  /> '
+ ' <p class="text-s12 text-semibold">Add Photos</p><input type="hidden" id="txt_hidaudio">'
+ '<div class="dropZoneOverlay" >'
+ '<img id="prev_x" class="audi_prev_icon" src="" alt="">'
+ '</div></div></div>'
+ '<a href="javascript:void(0);" style="background:#ed1d24;padding:3px 8px;width:100%;z-index:999; position: relative;" class="remove_button" title="Remove field"><i class="fa fa-minus-circle rm_icon"  aria-hidden="true"></i>Delete</a>'
+ '<input onchange="previewImg(id_x,event)" id="new_x" type="file"  name="txtfiles[]"  class="FileUpload1 " style="opacity: 0.0; position: absolute; top: 0; left: 0; bottom: 0; right: 0; " />'
+'</br>';

y = randomNumberFromRange(10, 100);
fieldHTML = fieldHTML.replace("new_x", "new_"+y);
fieldHTML = fieldHTML.replace("prev_x", "prev_"+y);
fieldHTML = fieldHTML.replace("id_x", y);


if (x < maxField) { 
x++; 
$(wrapper).append(fieldHTML);
} else
{
swal("You cannot upload more than 4 photos");
}
});
$(wrapper).on('click', '.remove_button', function (e) { //Once remove button is clicked
e.preventDefault();
$(this).parent('div').remove(); //Remove field html

x--; //Decrement field counter
});
$('#btnpostclr').click(function () {
$('input').val('');
$('textarea').val('');
$("select").prop('selectedIndex', 0);
});
var selected = localStorage.getItem('selected');
if (selected) {
$(".catsel").val(selected);
}


});
function fetch_model(select,div,count){

var brand = select.value

//var brand = $("#txtbrand").val();
$('#'+div).next('.txt_errors').css('display', 'none');


$('#'+div).val(brand);
var data = 'brand=' + brand;
if (brand != "") {
	
	localStorage.setItem(div, select.options[select.selectedIndex].text);
	
$.ajax({
type: "POST",
dataType: 'json',
async: false,
data: {'brand':brand,'div':div},

url: Settings.baseurl+"admin/fetch_data",
success: function (data) {
$('#txt_prtitle').val('');	
var val =$('#txt_prtitle').val();


if(data)	{
	
localStorage.setItem(div, select.options[select.selectedIndex].text);
$('#'+data['labelName']).empty();
var opt = $('<option />');
opt.val('');
opt.text('Select an option');
$('#'+data['labelName']).append(opt);
$.each(data['record'], function (key,value)
{



var opt = $('<option />'); // here we're creating a new select option for each group
opt.val(value['id']);
opt.text(value['name']);
$('#'+data['labelName']).append(opt);



});
}else{
	
var opt = $('<option />'); // here we're creating a new select option for each group
opt.val('');
opt.text('Select an option');



$nextselect = $(select).parent().parent().nextAll().find('select');
$nextselect.empty();
$nextselect.append(opt);


for (count+1; i <=tot; i++) { 


var val = localStorage.setItem(i,'');

}


}








}

});
}else{
	
	localStorage.setItem(div, ' ');
}

var myarray = [];
localStorage.setItem(count,div);

var outputval =[];
var i;
for (i = 1; i <=tot; i++) { 

var val = localStorage.getItem(i);
if(val!='' && val!=null){
	 outputval.push(localStorage.getItem(val));
}
}
var j; var newval='';

for (i = 0; i <outputval.length; i++) { 

      newval+=outputval[i]+ ' ';
}



$('#txt_prtitle').val(newval);




}
</script>

<?php } ?>
<script>

function readURL(input) {

if (input.files && input.files[0]) {
var reader = new FileReader();

reader.onload = function (e) {
$('#myVideo source').attr('src', e.target.result);



$("#myVideo")[0].load();
}

reader.readAsDataURL(input.files[0]);
}
}
function readaudioURL(input) {

if (input.files && input.files[0]) {
var reader = new FileReader();

reader.onloadend = function (e) {
// //$('#car_img').attr('src', e.target.result);
// console.log(input.closest( ".addIcon-P" ));
// elem= input.closest(".addIcon-P");

// elem.css( "background-image", 'url("' + e.target.result + '")');
$('#audi_prev_icon').css('display', 'block');

$('#audi_prev_icon').attr('src', e.target.result);

}

reader.readAsDataURL(input.files[0]);
}
}


function randomNumberFromRange(min,max)
{
return Math.floor(Math.random()*(max-min+1)+min);
}

$("#car_img").click(function () {
readaudioURL(this);
//$("#drop_zone2").click();
});
//        $('#drop_zone2').change(function () {
//           alert("aaa");
//            readaudioURL(this);
//        });
$('#chkbox_callpr1').click(function () {

if ($('#chkbox_callpr1').is(':checked'))
{
$('#txt_cprice').attr("disabled", "disabled");
$('#txt_cprice').val('');

} else
{
$('#txt_cprice').removeAttr("disabled");

}
});

$("#drop_zone_vedio").change(function (e) {

console.log('im in');
var v = $(this).val();
var res_video = v.split('\\').pop();

$('#hid_cvideo').val(res_video);

readURL(this);
$('#err_txtvideo').css('display', 'none');
var fileExtension = ['mp4', 'mp3'];

if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
alert("Only formats are allowed : " + fileExtension.join(', '));
}

var totalBytes = this.files[0].size;
if (totalBytes > 64000000)
{
alert("File Size cannot exceeds 64 MB");
}

});

$("#car_img").change(function () {
//alert("123");return false;
var v = $(this).val();
var res_img = v.split('\\').pop();
$('#txt_hidaudio').val(res_img);

$('#err_txtaudio').css('display', 'none');
var imgExtension = ['jpeg', 'jpg', 'png', 'gif'];
if ($.inArray($(this).val().split('.').pop().toLowerCase(), imgExtension) == -1) {
alert("Only formats are allowed : " + imgExtension.join(', '));
}
var totalBytes = this.files[0].size;
if (totalBytes > 128000000)
{
alert("File Size cannot exceeds 128 MB");
}
readaudioURL(this);
});


function previewImg(x,event){
//alert(event);
var output = document.getElementById('prev_'+x);
output.src = URL.createObjectURL(event.target.files[0]);
$('#prev_'+x).show();     



//            var reader = new FileReader();

//            reader.onload = function (e) {
//                //$('#car_img').attr('src', e.target.result);
//                $('#prev_'+x).css('display', 'block');
//
//                $('#prev_'+x).attr('src', e.target.result);
//
//            }
//
//            reader.readAsDataURL('#new_'+x.files[0]);

}
function onlyUnique(value, index, self) { 
    return self.indexOf(value) === index;
}

$('#drop_zone_vedio').on('change', function(event) {
	console.log('in');
  var file = event.target.files[0];
  var fileReader = new FileReader();
  if (file.type.match('image')) {
    fileReader.onload = function() {
      var img = document.createElement('img');
      img.src = fileReader.result;
      document.getElementById('pre').appendChild(img);
    };
    fileReader.readAsDataURL(file);
  } else {
    fileReader.onload = function() {
      var blob = new Blob([fileReader.result], {type: file.type});
      var url = URL.createObjectURL(blob);
      var video = document.createElement('video');
      var timeupdate = function() {
        if (snapImage()) {
          video.removeEventListener('timeupdate', timeupdate);
          video.pause();
        }
      };
      video.addEventListener('loadeddata', function() {
        if (snapImage()) {
          video.removeEventListener('timeupdate', timeupdate);
        }
      });
      var snapImage = function() {
        var canvas = document.createElement('canvas');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
        var image = canvas.toDataURL();
        var success = image.length > 100000;
        if (success) {
          var img = document.createElement('img');
          img.src = image;
          document.getElementById('pre').value =image;
          URL.revokeObjectURL(url);
        }
        return success;
      };
      video.addEventListener('timeupdate', timeupdate);
      video.preload = 'metadata';
      video.src = url;
      // Load video in Safari / IE11
      video.muted = true;
      video.playsInline = true;
      video.play();
    };
    fileReader.readAsArrayBuffer(file);
  }
});

</script>

