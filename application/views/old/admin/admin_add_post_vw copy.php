<!-- start section -->

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
                    <form id="myForm" enctype="multipart/form-data">

                    <div class="row">
                                <div class="col-lg-12">
                                    <form action="">
                                        <div class="row">
                                            <div class="col-lg-8 mx-auto mt-2 mb-5 container-fluid">
                                                <!-- --- Category --- -->
                                                
                                                    <div class="col-6 pl-0" style='float:left;display:inline-block;'>
                                                        <div class="form-group" >
                                                            <label class="text-s12 text-semibold" for="">Category</label>
                                                      
                                                            <select class="form-control input-custom" id="txtcategorya" name="txtcat">

                                                                <option value="">--Select--</option>
                                                                <?php
                                                                foreach ($cat_qry as $r) {
                                                                    ?>
                                                                    <option value="<?php echo $r->productCategoryID ?>"><?php echo $r->category_name ?></option>
                                                                    <?php
                                                                }
                                                                ?>

                                                            </select>
                                                            <label id="err_txtcat" class="txt_errors">Please Select Your Category</label>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- --- Brand --- -->
                                           
                                               
                                                    <div id="ggg">
                                                        <div class="col-6 pr-0" style='float:none;display:inline-block;'  >
                                                            <div class="form-group">
                                                                <label class="text-s12 text-semibold " for="">Brand</label>
                                                                <select class="form-control input-custom" name="txtbrand" id="txtbrand" disabled>
                                                                    <option value="">--Select--</option>
                                                                </select>
                                                                <label id="err_txtbrand" class="txt_errors">Please Select Your Brand</label>            
                                                            </div>
                                                    
                                                        </div>
                                                        <div class="row mt-3">
                                                            <!-- --- Model --- -->
                                                            <div class="col-6 pr-0">
                                                                <div class="form-group">
                                                                    <label class="text-s12 text-semibold" for="">Model</label>
                                                                    <select class="form-control input-custom px-0" name="txtmodel" id="txtmodel" disabled>
                                                                        <option value="">--Select--</option>
                                                                    </select>
                                                                    <label id="err_txtmodel" class="txt_errors">Please Select Your Model</label>
                                                                </div>
                                                            </div>
                                                            <!-- --- Year --- -->
                                                            <div class="col-6 pr-0">
                                                                <div class="form-group">
                                                                    <label class="text-s12 text-semibold" for="">Year</label>
                                                                    <select class="form-control input-custom px-0" name="txtyear" id="txtyear" disabled>
                                                                        <option value="">--Select--</option>
                                                                        <?php
                                                                        // Sets the top option to be the current year. (IE. the option that is chosen by default).
                                                                        $currently_selected = date('Y'); 
                                                                        // Year to start available options at
                                                                        $earliest_year = 1970; 
                                                                        // Set your latest year you want in the range, in this case we use PHP to just set it to the current year.
                                                                        $latest_year = date('Y'); 
            
                                                                        foreach ( range( $latest_year, $earliest_year ) as $i ) {
                                                                        // Prints the option with the next year in range.
                                                                        print '<option value="'.$i.'"'.($i === $currently_selected ? ' selected="selected"' : '').'>'.$i.'</option>';
                                                                        }
                                                                        ?>    
                                                                    </select>
                                                                    <label id="err_txtyear" class="txt_errors">Please Select Year</label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row mt-3">
                                                            <!-- --- Price --- -->
                                                            <div class="col-6">
                                                                <div class="form-group pb-lg-2 bb1">
                                                                    <label class="text-s12 text-semibold" for="">Price</label>
                                                                    <div class="custom-control custom-checkbox ml-lg-3">
                                                                        <input disabled type="checkbox"  class="custom-control-input" name="price" id="chkbox_callpr1">
                                                                        <label class="custom-control-label" for="price">Call for Price</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- --- Add price --- -->
                                                            <div class="col-6 pr-3">
                                                                <div class="form-group">
                                                                    <label class="text-s12 text-semibold" for="">Add price</label>
                                                                    <input disabled type="text" name="price"  id="txtprice" class="form-control input-custom" >
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
                                                        <div class="col-12">
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
                                                                        <input disabled type="file" id="drop_zone2" class="custom-file-input FileUpload" accept=".jpg,.png,.gif"  />
                                                                        <p class="text-s12 text-semibold">Add Photos</p>
                                                                        <input type="hidden" id="txt_hidaudio">
                                                                       
                                                                    </div>
                                                                </div>

                                   
                                                                <label id="err_txtaudio" class="txt_errors">Please Upload a Image</label>
                                                            </div>
                                                            <div class="card add-card">
                                                                <!-- The below "addIcon" div shows before uploading a file
                                                                after uploading file, "addIcon" div is replaced with the "img" tags -->

                                                                <!-- "addIcon-V" for Videos -->
                                                                <div class="addIcon-V h-100">
                                                                    <input disabled type="file" class="custom-file-input" id="">
                                                                    <p class="text-s12 text-semibold">Add Video</p>
                                                                </div>
                                                            </div>
                                                            <div class="card add-card">
                                                                <!-- The below "addIcon" div shows before uploading a file
                                                                        after uploading file, "addIcon" div is replaced with the "img" tags -->

                                                                <!-- "addIcon-P" for photos -->
                                                                <div class="addIcon-P h-100">
                                                                    <div class="form-group">
                                                                        <div class="col-md-5">
                                                                            <div >
                                                                                <div>
                                                                                    <button id="btn_add" class="add_button">Add 5 More Photos</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                       
                                                                </div>
                                                            </div>
                                                              
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
                                                        <div class="col-6">
                                                            <button  class="btn btn-red text-s15 w-100 pt-2 pb-2 btn-font" id="btnpostclr">
                                                            CLEAR
                                                            </button>
                                                        </div>
                                                        <!-- --- Post --- -->
                                                        <div class="col-6">
                                                            <button  class="btn btn-success text-s15 w-100 pt-2 pb-2 btn-font" id="btnsavepost">
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
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#video_prev').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    function readaudioURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#audio_prev').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $(document).ready(function () {

        $('#err_txtcat').css('display', 'block');
        $('#chkbox_callpr').click(function () {
            if ($('#chkbox_callpr').is(':checked'))
            {
                $('#txtprice').attr("disabled", "disabled");

            } else
            {
                $('#txtprice').removeAttr("disabled");

            }
        });
            $("#drop_zone1").change(function () {
            var v = $(this).val();
            // alert(v);return false;
            $('#txt_hidvideo').val(v);
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


        // $("#drop_zone2").change(function () {

        //     var v = $(this).val();
        //     //alert(v);return false;



        //     $('#txt_hidaudio').val(v);
        //     readaudioURL(this);
        //     $('#err_txtaudio').css('display', 'none');
        //     var imgExtension = ['jpeg', 'jpg', 'png', 'gif'];
        //     if ($.inArray($(this).val().split('.').pop().toLowerCase(), imgExtension) == -1) {
        //         alert("Only formats are allowed : " + imgExtension.join(', '));
        //     }
        //     var totalBytes = this.files[0].size;
        //     if (totalBytes > 128000000)
        //     {
        //         alert("File Size cannot exceeds 128 MB");
        //     }
        // });

        $('#txtplace').change(function () {
            $('#err_txtplace').css('display', 'none');
        });
//        $('#txtcategorya').change(function () {
//            $('#err_txtcat').css('display', 'none');
//        });
        $('#txtbrand').change(function () {
            $('#err_txtbrand').css('display', 'none');

        });
        $('#txtmodel').change(function () {
            $('#err_txtmodel').css('display', 'none');
        });
        $('#txtyear').change(function () {
            $('#err_txtyear').css('display', 'none');
        });
        $('#txtprice').keyup(function () {
            $('#err_txtprice').css('display', 'none');
        });
        $('#txtdetails').keyup(function () {
            $('#err_txtdetails').css('display', 'none');
        });

        $('#btnsavepost').click(function () {


            var txtcat = $('#txtcategorya').val();

            if (txtcat == '')
            {
                var txtbrand = $('#txtbrand').val();
                var txtmodel = $('#txtmodel').val();
                var txtyear = $('#txtyear').val();
                var txtprice = $('#txtprice').val();
                var txtdetails = $('#txtdetails').val();
                var txtvideo = $('#txt_hidvideo').val();
                var txtaudio = $('#txt_hidaudio').val();
                if ((txtcat == '') || (txtbrand == '') || (txtmodel == '') || (txtyear == '') || (txtprice == '') || (txtdetails == '') || (txtvideo == '') || (txtaudio == ''))
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
                    if (txtprice == '')
                    {

                        $('#err_txtprice').css('display', 'block');

                    }
                    if (txtdetails == '')
                    {

                        $('#err_txtdetails').css('display', 'block');

                    }
                    if (txtvideo == '')
                    {
                        $('#err_txtvideo').css('display', 'block');

                    }
                    if (txtaudio == '')
                    {
                        $('#err_txtaudio').css('display', 'block');

                    }
                    //return false;
                } else
                {


                    $.ajax({
                        url: "<?php echo base_url('Trader/save_carpost'); ?>",
                        data: {'txtcat': txtcat, 'txtbrand': txtbrand, 'txtmodel': txtmodel, 'txtyear': txtyear,
                            'txtprice': txtprice, 'txtdetails': txtdetails, 'txtvideo': txtvideo},
                        type: "POST",

                        success: function (data) {
                            console.log(data);
                            //$('#post_content').html(data);
                        }

                    });
                }
            }
            if (txtcat == '1')
            {

                var txtbrand = $('#txtbrand').val();
                var txtmodel = $('#srchccat3').val();

                var txtyear = $('#txtyear').val();
                var txtprice = $('#txt_cprice').val();
                var txtdetails = $('#txtdetails').val();
                var txtvideo = $('#hid_cvideo').val();
                var txtaudio = $('#txt_hidaudio').val();
                if ((txtcat == '') || (txtbrand == '') || (txtmodel == '') || (txtyear == '') || (txtprice == '') || (txtdetails == ''))
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
                    if (txtprice == '')
                    {

                        $('#err_txtprice').css('display', 'block');

                    }
                    if (txtdetails == '')
                    {

                        $('#err_txtdetails').css('display', 'block');

                    }
                    /*if (txtvideo == '')
                     {
                     $('#err_txtvideo').css('display', 'block');
                     
                     }
                     if (txtaudio == '')
                     {
                     $('#err_txtaudio').css('display', 'block');
                     
                     }*/
                    //return false;
                } else
                {
                
                var form = $('#myForm')[0];
                 var formData = new FormData(form);
            /*        
                    $.ajax({
                        url: "<?php echo base_url('Trader/save_carpost'); ?>",
                         data:formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    type: "POST",
                        success: function (data) {
                            
                            console.log(data);
                            //$('#post_content').html(data);
                        }

                    });*/
                }


            }

        });
        var maxField = 9; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        //var fieldHTML = '<div><div class="dropZoneContainer1" id="drop_camera"><input type="file" id="drop_zone" class="FileUpload" accept=".jpg,.png,.gif"  /><div class="dropZoneOverlay"><i class="fa fa-camera" aria-hidden="true"></i></div></div></div>';
        //var fieldHTML = '<div><input type="file" id="txt_admorepost" name="txt_admorepost[]" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="fa fa-minus-circle rm_icon"  aria-hidden="true"></i></a></div>'; //New input field html 

        var fieldHTML = '<div style="position: relative;margin-top:2%; background-color:#f7f7f7;width:15%;height:72px;border-radius:9px;" ><i class="fa fa-camera moreaudi_icon" aria-hidden="true"></i>\
                 <span class="fa-stack fa-lg spaddvideo" >\
                <i class="fa fa-circle fa-stack-1x icon-background111"></i>\
                 <i class="fa fa-plus fa-stack-1x vdmoreplus"  aria-hidden="true"></i>\
                 </span><a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="fa fa-minus-circle rm_icon"  aria-hidden="true"></i></a>\
                <input type="file" id="drop_zone21" name="file[]" class="FileUpload" style="opacity: 0.0; position: absolute; top: 0; left: 0; bottom: 0; right: 0; " />\
        </div><br>';
        var x = 1; //Initial field counter is 1
        $(addButton).click(function () { //Once add button is clicked
        
            if (x < maxField) { //Check maximum number of input fields
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); // Add field html
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
          $('#txtcategorya').change(function () {

            $('#err_txtcat').css('display', 'none');
            var category = $(this).val();
            if (category == '1')
            {
                
                $("#ggg").load("<?php echo base_url() . 'admin/Dashboard/car_addpostview/1'; ?>");
                //$('#btnsavepost').attr('id','btncaradpost');
            }
            if (category == '2')
            {

                $("#ggg").load("<?php echo base_url() . 'admin/Dashboard/bike_addpostview/2'; ?>");
               // $('#btnsavepost').attr('id', 'btnbikeadpost');

            }
            if (category == '3')
            {

                $("#ggg").load("<?php echo base_url() . 'admin/Dashboard/noplate_addpostview/3'; ?>");
                //$('#btnsavepost').attr('id', 'btnnoplateadpost');

            }
            if (category == '4')
            {


                $("#ggg").load("<?php echo base_url() . 'admin/Dashboard/vertu_addpostview/4'; ?>");
                //$('#btnsavepost').attr('id', 'btnvertuadpost');

            }
            if (category == '5')
            {


                $("#ggg").load("<?php echo base_url() . 'admin/Dashboard/watch_addpostview/5'; ?>");
                //$('#btnsavepost').attr('id', 'btnwatchadpost');

            }
            if (category == '6')
            {


                $("#ggg").load("<?php echo base_url() . 'admin/Dashboard/mobile_addpostview/6'; ?>");
                //$('#btnsavepost').attr('id', 'btnmobileadpost');

            }
            if (category == '7')
            {



                $("#ggg").load("<?php echo base_url() . 'admin/Dashboard/boat_addpostview/7'; ?>");
                //$('#btnsavepost').attr('id', 'btnboatadpost');

            }
            if (category == '8')
            {


                $("#ggg").load("<?php echo base_url() . 'admin/Dashboard/phone_addpostview/8'; ?>");
                //$('#btnsavepost').attr('id', 'btnphoneadpost');

            }
            if (category == '9')
            {


                $("#ggg").load("<?php echo base_url() . 'admin/Dashboard/property_addpostview/9'; ?>");
                //$('#btnsavepost').attr('id', 'btnpropadpost');

            }
        });
    });
function vPreview(e){
    
   var src = URL.createObjectURL(document.querySelector("#drop_zone1").files[0]);
    var x = '<video style="margin-left: -50%; position: absolute; z-index: 1;height: 100px;border-radius: 6px;" id="video1" src="'+src+'"   controls>your browser does not support the video tag</video>';
    
    //<canvas id="canvas" width=300 height=300/><canvas id="myCanvas" width="270" height="135" style="border:1px solid #d3d3d3;"> Your browser does not support the HTML5 canvas tag.</canvas>    
    
    $('#v').html(x);
    var v = document.getElementById("video1");
    var c = document.getElementById("myCanvas");
    var ctx = c.getContext("2d");
    var i;

    v.addEventListener("play", function() {ctx.drawImage(v,5,5,260,125)}, false);
    //v.addEventListener("pause", function() {window;.clearInterval(i);}, false);
    //v.addEventListener("ended", function() {clearInterval(i);}, false); 
 
          
   
            //capture();
//            var v = $(this).val();
//            // alert(v);return false;
//            $('#txt_hidvideo').val(v);
//            readURL(this);
//            $('#err_txtvideo').css('display', 'none');
//            var fileExtension = ['mp4', 'mp3'];
//
//            if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
//                alert("Only formats are allowed : " + fileExtension.join(', '));
//            }
//
//            var totalBytes = this.files[0].size;
//            if (totalBytes > 64000000)
//            {
//                alert("File Size cannot exceeds 64 MB");
//            }
}
function capture(){ 
            var canvas = document.getElementById('canvas'); 
            var video = document.getElementById('video-element');
            canvas.getContext('2d').drawImage(video, 0, 0, video.videoWidth, video.videoHeight);
        }
      
</script>

</div>
<div id="carbike_div"></div>
<div id="mob_div"></div>
<div id="verwb_div"></div>
<div id="noplate_div"></div>
<div id="prop_div"></div>