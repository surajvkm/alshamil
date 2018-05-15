<div class="col-6" style='float:none;display:inline-block;'  >
<div class="form-group">
    <label class="text-s12 text-semibold" for="">Brand</label>

<select class="form-control input-custom" name="txtbrand" id="txtbrand" onchange="fetch_model(this.value)">
<option value="">--Select--</option>
<?php
foreach ($query as $brand) {
?>
<option value="<?php echo $brand->brandID ?>"><?php echo $brand->brandName ?></option>
<?php
}
?>

</select>
<label id="err_txtbrand" class="txt_errors">Please Select Your Brand</label>            
</div>
</div>

<div class="row mt-3">
<!-- --- Model --- -->
<div class="col-6">
<div class="form-group">
<label class="text-s12 text-semibold" for="">Model</label>

<select class="form-control input-custom" name="txtmodel" id="srchccat3">
<option value="">--Select--</option>
</select>
<label id="err_txtmodel" class="txt_errors">Please Select Your Model</label>
</div>
</div>
<!-- --- Year --- -->
<div class="col-6">

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

<!-- --- Add Video/Photos --- -->
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
                
                    <img id="audi_prev_icon" src="" alt=''>
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
            <input type="file" id="drop_zone1" name="productVideo" class="custom-file-input h-100 FileUpload" style='position:absolute;top:0; left:0;'/>
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



<!-- start section -->




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

$(document).ready(function () {
var test_array = new Array();
$('#btnsavepost').click(function (e) { e.preventDefault();

var res = $('#chkbox_callpr1').is(':checked');


var txtcat = $('#txtcategorya').val();
//alert("gfg"+txtcat);return false;
var txtbrand = $('#txtbrand').val();
var txtmodel = $('#srchccat3').val();

var txtyear = $('#txtyear').val();
var txtprice = $('#txt_cprice').val();
var txtdetails = $('#txtdetails').val();
var txtvideo = $('#hid_cvideo').val();
var txtaudio = $('#txt_hidaudio').val();
var setprice;
            if ($('#chkbox_callpr1').is(':checked'))
            {setprice=1;}
            else if(txtprice!==''){ setprice=1;}
if ((txtcat == '') || (txtbrand == '') || (txtmodel == '') || (txtyear == '') || (txtdetails == '') || (txtaudio == '')||(setprice!=1))
{

if (txtcat == '')
{

$('#err_txtcat').css('display', 'block');

}
if (txtbrand == '')
{

$('#err_txtbrand').css('display', 'block');

}
if (txtmodel == '')
{

$('#err_txtmodel').css('display', 'block');
}

if (txtyear == '')
{

$('#err_txtyear').css('display', 'block');

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

if (txtaudio == '')
{
$('#err_txtaudio').css('display', 'block');

}

} else
{
$('#btnsavepost').prop('disabled',true);
$('#loading').show();
$("#myForm").submit();
// var form = $('#myForm')[0];
// var formData = new FormData(form);


// $.ajax({
// url: "<?php echo base_url('Trader/save_phonepost'); ?>",


// data: formData,
// contentType: false,
// cache: false,
// processData: false,
// type: "POST",

// success: function (data) {
// swal("Your Product Added Successfully");
// $('#loading').hide();

// $("#postForm").submit();
// }

// });
}


});
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

$("#drop_zone1").change(function (e) {

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


var maxField = 4; 
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
function randomNumberFromRange(min,max)
{
return Math.floor(Math.random()*(max-min+1)+min);
}
function fetch_model(brand)
{

//var brand = $("#txtbrand").val();
$('#err_txtcarbrand').css('display', 'none');
var data = 'brand=' + brand;
if (brand != "") {
$.ajax({
type: "POST",
dataType: 'json',
data: data,

url: "<?php echo base_url('admin/Dashboard/fetch_bikemodel'); ?>",
success: function (data) {

$('#srchccat3').empty();

$.each(data, function (id, city)
{
var opt = $('<option />'); // here we're creating a new select option for each group
opt.val(id);
opt.text(city);
$('#srchccat3').append(opt);
});

}

});
}

}
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


</script>

