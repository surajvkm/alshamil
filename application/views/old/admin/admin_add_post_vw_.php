<!-- start section -->
<?php echo $this->session->flashdata('msg'); ?>
<!-- <form  action="<?php echo base_url(); ?>Trader/add_post" method="post" novalidate="" enctype="multipart/form-data">-->
<form id="postForm"></form>
<form  id="myForm" enctype="multipart/form-data">
    <div id="first">
        
            <div class="container">
                <div class="row">
                     <?php
                    $this->view('admin/admin_sidebar2'); 
                     ?>
                    <div class="col-sm-9 add_post" >

                        <center>
                            <h5 id="addpost_title" >Add Post</h5>
                        </center>
                        <div class="container-fluid contdiv1" id="subcategory">

                            <div class="col-sm-6" >
                                <div class="form-group">
                                    <label for="usr" class="addpost_lbl">Category</label>
                                    <select class="form-control reginputs" id="txtcategorya" name="txtcat">

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
                                <div class="col-sm-6" id="txthidbrand">
                                    <div class="form-group">
                                        <label for="usr" class="addpost_lbl">Brand</label>

                                        <select class="form-control reginputs" name="txtbrand" id="txtbrand">
                                            <option value="">--Select--</option>

                                        </select>
                                        <label id="err_txtbrand" class="txt_errors">Please Select Your Brand</label>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm-6" >
                                        <div class="form-group">
                                            <label for="usr" class="addpost_lbl">Model</label>
                                            <select class="form-control reginputs" name="txtmodel" id="txtmodel">
                                                <option value="">--Select--</option>
                                            </select>
                                            <label id="err_txtmodel" class="txt_errors">Please Select Your Model</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6" >
                                        <div class="form-group">

                                        <label for="usr" class="addpost_lbl">Year</label>
  
                                            <select class="form-control reginputs" name="txtyear" id="txtyear">
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
                                <div class="row">
                                    <div class="col-sm-6" >
                                        <div class="form-group">
                          
                                            <label for="price" class="addpost_lbl">Price</label>
                        <!--                         <div class="checkbox">
  <label ><input type="checkbox" name="price" id="chkbox_callpr1"  class=" reginputs">Call for Price</label>

  </div>-->
                                            <input type="checkbox" name="price" id="chkbox_callpr1"  class="form-control reginputs"><span id="call_for_price" style="margin-left: 47px;position: relative;top: -32px;">Call for Price</span>
                                            <!--                                          <label id="err_txtprice" class="txt_errors">Enter Price</label>-->

                                        </div>
                                    </div>
                                    <div class="col-sm-6" >
                                        <div class="form-group">
                                            <label for="price" class="addpost_lbl">Add Price</label>
                                            <input type="text" name="price"  id="txtprice" class="form-control reginputs" >
                                            <label id="err_txtprice" class="txt_errors">Enter Price</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-6" >
                                        <label for="usr" class="addpost_lbl">Details</label>
                                        <textarea id="txtdetails" name="txtdetails"  class="form-control reginputs"></textarea>
                                        <label id="err_txtdetails" class="txt_errors">Enter Details</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-9" >

                                        <label for="usr" class="addpost_lbl" id="lblauvid">Add Video & Photos</label>
                                        <div class="form-group">
                                            <div class="col-md-5">
                                                <div class="dropZoneContainer" id="drop_video">
                                                    <input type="file" id="drop_zone1" name="productVideo" class="FileUpload" required/>
                                                    <input type="hidden" id="txt_hidvideo">
                                                    <div class="dropZoneOverlay">
                                                        <img id="vid_icon" src="<?php echo base_url() ?>img/add-post-add-video.png">
                                                       
                                                    </div>
                                                     
                                                </div>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <div class="col-md-5">
                                                <div class="dropZoneContainer" id="drop_camera">
                                                    <input type="file" id="drop_zone2" class="FileUpload" accept=".jpg,.png,.gif"  />
                                                    <input type="hidden" id="txt_hidaudio">
                                                    <div class="dropZoneOverlay">
                                                        <img id="audi_icon" src="<?php echo base_url() ?>img/add-post-add-pic.png">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       <div class="form-group">
                                            <div class="col-md-5">
                                                <div >
                                                    <div>
                                                        <button id="btn_addmore" class="add_button">Add 5 More Photos</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       




                                    </div>
                                </div>
                                <div class="row">
                                   
                                    <label id="err_txtaudio" class="txt_errors">Please Upload a Image</label>
                                </div>
                                <!--                                <div class="row">
                                                                    <img src="<?php echo base_url(); ?>img/no_preview.png" id="audio_prev">
                                                                </div>-->
                                <div class="row">
                                    <div class="col-sm-12" >
                                        <div class="field_wrapper"></div>
                                    </div>
                                </div>
                               <!--  <div class="row">
                        <div class="col-sm-12" >


                                <div class="row" id="postbtngrp">
                                    <div class="col-sm-3" >
                                        <div >
                                            <button type="button" class="btn btn-default btnplantypes" id="btnpostclr">CLEAR</button>
                                        </div>
                                    </div>
                                    <div class="col-sm-3" >
                                        <div class="form-group">
                                            <button type="button" class="btn btn-default btnplantypes" id="btnsavepost" > POST</button>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 pull-right">
                                        <div  class="form-group">
                                            <div id="loading" class="wait">
                                                <i class="fa fa-cog fa-spin fa-2x fa-fw"></i> Please Wait...
                                            </div>
                                        </div>
                                    </div>

                                </div>
                      



                        </div>
                    </div> -->

                            </div> 

                        </div>
                    </div>

                </div>

            </div>

      
        <!-- end section -->
              <!-- end section -->
        <div id="admin_addbutton_div">
            
                <div class="">
                    <div class="row">
                        <div class="col-sm-12" >


                            <div class="container-fluid contdiv1" >


                                <div class="row" id="postbtn">
                                    <div class="col-sm-3" >
                                        <div >
                                            <button type="button" class="btn btn-default btnplantypes" id="btnpostclr">CLEAR</button>
                                        </div>
                                    </div>
                                    <div class="col-sm-3" >
                                        <div class="form-group">
                                            <button type="button" class="btn btn-default btnplantypes" id="btnsavepost" > POST</button>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 pull-right">
                                        <div  class="form-group">
                                           <!-- <div id="loading" class="wait">
                                                <i class="fa fa-cog fa-spin fa-2x fa-fw"></i> Please Wait...
                                            </div> -->
                                        </div>
                                    </div>

                                </div>
                                



                            </div>




                        </div>
                    </div>
                </div><!-- end container -->


          
        </div>


    </div>
</form>
<?php
        $this->view('admin/admin_footer2'); 
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