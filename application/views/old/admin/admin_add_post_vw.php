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
                   
                    <form id="myForm" enctype="multipart/form-data" method="post" action="">

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
            
            $('#buttons').css('display', 'block');
            $('#err_txtcat').css('display', 'none');
            var category = $(this).val();
            if (category == '1')
            {
                $("#ggg").empty();
                $("#ggg").load("<?php echo base_url() . 'admin/Dashboard/car_addpostview/1'; ?>");
                $('#myForm').attr('action', '<?php echo base_url('Trader/save_carpost')?>');
                //$('#btnsavepost').attr('id','btncaradpost');
            }
            if (category == '2')
            {
                $("#ggg").empty();
                $("#ggg").load("<?php echo base_url() . 'admin/Dashboard/bike_addpostview/2'; ?>");
                $('#myForm').attr('action', '<?php echo base_url('Trader/save_bikepost')?>');
               // $('#btnsavepost').attr('id', 'btnbikeadpost');

            }
            if (category == '3')
            {
                $("#ggg").empty();
                $("#ggg").load("<?php echo base_url() . 'admin/Dashboard/noplate_addpostview/3'; ?>");
                $('#myForm').attr('action', '<?php echo base_url('admin/Dashboard/save_noplatepost')?>');
                //$('#btnsavepost').attr('id', 'btnnoplateadpost');

            }
            if (category == '4')
            {

                $("#ggg").empty();
                $("#ggg").load("<?php echo base_url() . 'admin/Dashboard/vertu_addpostview/4'; ?>");
                $('#myForm').attr('action', '<?php echo base_url('Trader/save_vertupost')?>');
                //$('#btnsavepost').attr('id', 'btnvertuadpost');

            }
            if (category == '5')
            {

                $("#ggg").empty();
                $("#ggg").load("<?php echo base_url() . 'admin/Dashboard/watch_addpostview/5'; ?>");
                $('#myForm').attr('action', '<?php echo base_url('Trader/save_watchpost')?>');
                //$('#btnsavepost').attr('id', 'btnwatchadpost');

            }
            if (category == '6')
            {
                $("#ggg").empty();

                $("#ggg").load("<?php echo base_url() . 'admin/Dashboard/mobile_addpostview/6'; ?>");
                $('#myForm').attr('action', '<?php echo base_url('admin/Dashboard/save_mnaddpost')?>');
                //$('#btnsavepost').attr('id', 'btnmobileadpost');

            }
            if (category == '7')
            {

                $("#ggg").empty();

                $("#ggg").load("<?php echo base_url() . 'admin/Dashboard/boat_addpostview/7'; ?>");
                $('#myForm').attr('action', '<?php echo base_url('Trader/save_boatpost')?>');
                //$('#btnsavepost').attr('id', 'btnboatadpost');

            }
            if (category == '8')
            {
                $("#ggg").empty();

                $("#ggg").load("<?php echo base_url() . 'admin/Dashboard/phone_addpostview/8'; ?>");
                $('#myForm').attr('action', '<?php echo base_url('Trader/save_phonepost')?>');
                //$('#btnsavepost').attr('id', 'btnphoneadpost');
                
            }
            if (category == '9')
            {

                $("#ggg").empty();
                $("#ggg").load("<?php echo base_url() . 'admin/Dashboard/property_addpostview/9'; ?>");
                $('#myForm').attr('action', '<?php echo base_url('Trader/save_proppost')?>');
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