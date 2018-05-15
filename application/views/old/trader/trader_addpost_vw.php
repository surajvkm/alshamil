


<!-- start section -->
<?php echo $this->session->flashdata('msg'); ?>
<!-- <form  action="<?php echo base_url(); ?>Trader/add_post" method="post" novalidate="" enctype="multipart/form-data">-->
<form id="postForm"></form>
<form  id="myForm" enctype="multipart/form-data">
    <div id="first">
        <section class="section white-background regsecdiv1">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12" >
                        <center>
                            <h5 id="addpost_title" >Add Post</h5>
                        </center>
                      
                        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                            <div class="col-sm-12" >
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="usr" class="addpost_lbl">Category</label>
                                        <select class="form-control" id="txtcategorya" name="txtcat">

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
                                <div id="ggg">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="usr" class="addpost_lbl">Brand</label>

                                            <select class="form-control" name="txtbrand" id="txtbrand">
                                                <option value="">--Select--</option>

                                            </select>
                                            <label id="err_txtbrand" class="txt_errors">Please Select Your Brand</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="usr" class="addpost_lbl">Model</label>
                                            <select class="form-control" name="txtmodel" id="txtmodel">
                                                <option value="">--Select--</option>
                                            </select>
                                            <label id="err_txtmodel" class="txt_errors">Please Select Your Model</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="usr" class="addpost_lbl">Year</label>
                                            <select class="form-control" name="txtyear" id="txtyear">
                                                <option value="">--Select--</option>
                                                <?php
                                                for ($i = 1970; $i <= date('Y'); $i++) {
                                                    ?>
                                                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                                    <?php
                                                }
                                                ?>

                                            </select>
                                            <label id="err_txtyear" class="txt_errors">Please Select Year</label>

                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="price" class="addpost_lbl">Price</label><br>
                                            <input type="checkbox" name="call_for_price" id="chkbox_callpr1"  class="form-control chkbox_callpr1"><span class="call_for_pricel">Call for Price</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="price" class="addpost_lbl">Add Price</label>
                                            <input type="text" name="txtprice"  id="txt_cprice" class="form-control" >
                                            <label id="err_txtprice" class="txt_errors">Enter Price</label>
                                        </div>
                                    </div>
                                    <div class=" col-sm-12 col-md-12">
                                        <label for="usr" class="addpost_lbl">Details</label>
                                        <textarea id="txtdetails" name="txtdetails"  class="form-control"></textarea>
                                        <label id="err_txtdetails" class="txt_errors">Enter Details</label>
                                    </div>
                                        <div class="col-md-12 margintopdiv">
                                        <div class="row">
                                            <div class="col-md-12">
                                                   <label for="usr" class="addpost_lbl" id="lblauvid">Add Video & Photos</label>
                                            </div>
                                            <div class="col-sm-12" >
                                                <div class="row">
                                                    <div class="col-sm-3 col-md-3">
                                                        <div class="form-group">
                                                            <div class="dropZoneContainer drop_video">
                                                                <input type="file" id="drop_zone1" name="productVideo" class="addFileUpload" required/>
                                                                <input type="hidden" id="txt_hidvideo">
                                                                <center>
                                                                    <img id="vid_icon" class="imgvideo img-icon" src="<?php echo base_url() ?>img/add-post-add-video.png">
                                                                </center>
                                                                    
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3">
                                                        <div class="form-group">
                                                            <div class="dropZoneContainer" id="drop_camera">
                                                                <input type="file" id="drop_zone2" class="addFileUpload" accept=".jpg,.png,.gif"  />
                                                                <input type="hidden" id="txt_hidaudio">
                                                                <center>
                                                                    <img id="audi_icon" class="imgvideo img-icon"  src="<?php echo base_url() ?>img/add-post-add-pic.png">
                                                                </center>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3">
                                                        <div class="form-group">
                                                                    <button id="btn_addmore" class="add_button">Add 3 More Photos</button>  
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label id="err_txtvideo" class="txt_errors">Please Upload a Video</label>
                                            <label id="err_txtaudio" class="txt_errors">Please Upload a Image</label>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12" >
                                                <div class="field_wrapper"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                         <canvas class="canvasdiv" id="canvas"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3" ></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end section -->
        <section class="section white-background ">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12" >
                      
                        <div class="col-md-6 col-md-offset-3 col-sm-9 col-sm-offset-3 pl-0">
                            <div class="col-xs-12 col-sm-8 pull-right">
                                <div  class="form-group">
                                    <div id="loading" class="wait">
                                        <i class="fa fa-cog fa-spin fa-2x fa-fw"></i> Please Wait...
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6" >
                                <div class="form-group">
                                    <button type="button" class="btn btn-default btnplantypes" id="btnpostclr">CLEAR</button>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6" >
                                <div class="form-group">
                                    <button type="button" class="btn btn-default btnplantypes" id="btnsavepost" > POST</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3" ></div>
                    </div>
                </div>
            </div><!-- end container -->
        </section>


    </div>
</form>
<div id="second"></div>
<div id="third"></div>
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
        
        $('#chkbox_callpr1').click(function () {
         
            if ($('#chkbox_callpr1').is(':checked'))
            {
                $('#txt_cprice').attr("disabled", "disabled");

            } else
            {
                $('#txt_cprice').removeAttr("disabled");

            }
        
        });

//        $("#drop_zone1").change(function () { 
//        //document.querySelector("#drop_zone1").addEventListener('change', function() {
//            document.querySelector("#video-element source").setAttribute('src', URL.createObjectURL(document.querySelector("#drop_zone1").files[0]));
//            capture();
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
//
//        });
        
        $("#drop_zone2").change(function () {

            var v = $(this).val();
            //alert(v);return false;



            $('#txt_hidaudio').val(v);
            readaudioURL(this);
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
        });

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
        $('#txt_cprice').keyup(function () {
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

                    });
                }


            }

        });
        var maxField = 4; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        //var fieldHTML = '<div><div class="dropZoneContainer1" id="drop_camera"><input type="file" id="drop_zone" class="FileUpload" accept=".jpg,.png,.gif"  /><div class="dropZoneOverlay"><i class="fa fa-camera" aria-hidden="true"></i></div></div></div>';
        //var fieldHTML = '<div><input type="file" id="txt_admorepost" name="txt_admorepost[]" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="fa fa-minus-circle rm_icon"  aria-hidden="true"></i></a></div>'; //New input field html 

        var fieldHTML = '<div class="col-md-12" ><div class="row"><div class="col-md-3 row"><div class="form-group"><div class="dropZoneContainer" id="drop_camera">'
                + '<input type="file" id="drop_zone21" name="file[]" class="addFileUpload" accept=".jpg,.png,.gif"  />'
                + '<center><img class="imgvideo" src="<?php echo base_url() ?>img/add-post-add-pic.png"></center></div></div></div>'
                + '<div class="col-md-3" ><a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="fa fa-minus-circle rm_icon"  aria-hidden="true"></i></a>'
                 +'</div></div></div>';
        var x = 1; //Initial field counter is 1
        $(addButton).click(function () { //Once add button is clicked
        
            if (x < maxField) { //Check maximum number of input fields
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); // Add field html
            }
        });
        $(wrapper).on('click', '.remove_button', function (e) { //Once remove button is clicked
            e.preventDefault();
            $(this).parent('div').parent('div').remove(); //Remove field html

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

            var category = $(this).val();
            if (category == '1')
            {

                $("#ggg").load("<?php echo base_url() . 'Trader/car_addpostview/1'; ?>");
                //$('#btnsavepost').attr('id','btncaradpost');
            }
            if (category == '2')
            {

                $("#ggg").load("<?php echo base_url() . 'Trader/bike_addpostview/2'; ?>");
               // $('#btnsavepost').attr('id', 'btnbikeadpost');

            }
            if (category == '3')
            {

                $("#ggg").load("<?php echo base_url() . 'Trader/noplate_addpostview/3'; ?>");
                //$('#btnsavepost').attr('id', 'btnnoplateadpost');

            }
            if (category == '4')
            {


                $("#ggg").load("<?php echo base_url() . 'Trader/vertu_addpostview/4'; ?>");
                //$('#btnsavepost').attr('id', 'btnvertuadpost');

            }
            if (category == '5')
            {


                $("#ggg").load("<?php echo base_url() . 'Trader/watch_addpostview/5'; ?>");
                //$('#btnsavepost').attr('id', 'btnwatchadpost');

            }
            if (category == '6')
            {


                $("#ggg").load("<?php echo base_url() . 'Trader/mobile_addpostview/6'; ?>");
                //$('#btnsavepost').attr('id', 'btnmobileadpost');

            }
            if (category == '7')
            {



                $("#ggg").load("<?php echo base_url() . 'Trader/boat_addpostview/7'; ?>");
                //$('#btnsavepost').attr('id', 'btnboatadpost');

            }
            if (category == '8')
            {


                $("#ggg").load("<?php echo base_url() . 'Trader/phone_addpostview/8'; ?>");
                //$('#btnsavepost').attr('id', 'btnphoneadpost');

            }
            if (category == '9')
            {


                $("#ggg").load("<?php echo base_url() . 'Trader/property_addpostview/9'; ?>");
                //$('#btnsavepost').attr('id', 'btnpropadpost');

            }
        });
    });
function vPreview(e){
    
   var src = URL.createObjectURL(document.querySelector("#drop_zone1").files[0]);
    var x = '<video class="videoaddpost" id="video1"  src="'+src+'">your browser does not support the video tag</video>';
    
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