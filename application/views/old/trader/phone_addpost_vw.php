
<!-- start section -->
<?php echo $this->session->flashdata('msg'); ?>

<div class="col-md-6">
    <div class="form-group">
        <label for="usr" class="addpost_lbl">Brand</label>
        <select class="form-control" name="txtbrand" id="txtbrand" onchange="fetch_model(this.value)">
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
<div class="col-md-6">
    <div class="form-group">
        <label for="usr" class="addpost_lbl">Model</label>
        <select class="form-control" name="txtmodel" id="srchcat3">
            <option value="">--Select--</option>
        </select>
        <label id="err_txtmodel" class="txt_errors">Please Select Your Model</label>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="price" class="addpost_lbl">Price</label><br>
        <span><input type="checkbox" name="call_for_price" id="chkbox_callpr1" class="form-control chkbox_callpr1"></span><span class="call_for_pricel" >Call for Price</span>
    </div>
</div>
<div class="col-md-12"></div>
<div class="col-md-6">
    <div class="form-group">
        <label for="price" class="addpost_lbl">Add Price</label>
        <input type="text"  onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="txtprice"  id="txt_vprice" class="form-control" >
        <label id="err_txtvprice" class="txt_errors">Enter Price</label>
    </div>
</div>
<div class="col-md-12">
    <label for="usr" class="addpost_lbl">Details</label>
    <textarea id="txtdetails" name="txtdetails"  class="form-control"></textarea>
    <label id="err_txtdetails" class="txt_errors">Enter Details</label>
</div>
<div class="col-md-12 margintopdiv">
    <div class="row">
        <div class="col-md-12">
            <label for="usr" class="addpost_lbl" id="lblauvid">Add Video & Photos</label></div>

        <div class="col-sm-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="dropZoneContainer drop_video">
                            <div  id="v"></div>
                            <input onchange="vPreview(event)" type="file" id="drop_zone1" name="productVideo" class="addFileUpload" required=""/>
                            <input type="hidden" id="hid_cvideo">
                            <center>
                                <img id="vid_icon" class="imgvideo" src="<?php echo base_url() ?>img/add-post-add-video.png">
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="dropZoneContainer" id="drop_camera">
                            <input type="file" id="car_img"  name="txtimage" class="addFileUpload" accept=".jpg,.png,.gif"  />
                            <input type="hidden" id="txt_hidaudio">
                            <center>
                                <img id="audi_icon" class="imgvideo" src="<?php echo base_url() ?>img/add-post-add-pic.png">
                                <img id="audi_prev_icon"  class="imgvideo" src="<?php echo base_url() ?>img/add-post-add-pic.png">
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <button id="btn_addmore" class="add_button">Add 3 More Photos</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" >
            <label id="err_txtaudio" class="txt_errors">Please Upload a Image</label>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" >
            <div class="field_wrapper">

            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <canvas class="canvasdiv" id="canvas"></canvas>
</div>
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
                //$('#car_img').attr('src', e.target.result);
                $('#audi_prev_icon').css('display', 'block');

                $('#audi_prev_icon').attr('src', e.target.result);

            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ready(function () {
        var test_array = new Array();
        $('#btnsavepost').click(function (e) {
            e.preventDefault();
            var res = $('#chkbox_callpr1').is(':checked');
            var txtprice = $('#txt_vprice').val();


            var txtcat = $('#txtcategorya').val();
            //alert("gfg"+txtcat);return false;
            var txtbrand = $('#txtbrand').val();
            var txtmodel = $('#srchcat3').val();

            var txtyear = $('#txtyear').val();
            var txtprice = $('#txt_vprice').val();
            var txtdetails = $('#txtdetails').val();
            var txtvideo = $('#hid_vvideo').val();
            var txtaudio = $('#txt_hidaudio').val();
            var isTrader= <?php echo isset($_SESSION['logged_in']['txtusertype'])?$_SESSION['logged_in']['txtusertype']:0; ?>;
    if(isTrader){
 
                    $.ajax({
                    url: "<?php echo base_url('Trader/trader_check_addpost'); ?>",

                    type: "POST",
                    success: function (data) {
                        if(data!=0){
                            add_post_response(data); 
                
                        }else{
                        if ((txtcat == '') || (txtbrand == '') || (txtmodel == '') || (txtyear == '') || (txtdetails == '') || (txtaudio == ''))
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
            
                                $('#err_txtvprice').css('display', 'none');
            
                            } else
                            {
                                if (txtprice == '')
                                {
                                    $('#err_txtvprice').css('display', 'block');
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
                            $('#btnsavepost').prop('disabled', true);
                            $('#loading').show();
                            var form = $('#myForm')[0];
                            var formData = new FormData(form);
            
            
                            $.ajax({
                                url: "<?php echo base_url('Trader/save_phonepost'); ?>",
                                /*data: {'txtcat': txtcat, 'txtbrand': txtbrand, 'txtmodel': txtmodel, 'txtyear': txtyear, 'call_for_price': call_for_price,
                                 'txtprice': txtprice, 'txtdetails': txtdetails, 'txtvideo': txtvideo, 'txtimage': txtaudio},*/
            
                                data: formData,
                                contentType: false,
                                cache: false,
                                processData: false,
                                type: "POST",
            
                                success: function (data) {
                                    $('#loading').hide();
                                    $("#postForm").submit();
                                }
            
                            });
                        }
                    }


                    }
                    });
    
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
                $('#txt_vprice').attr("disabled", "disabled");
                $("#txt_vprice").val('')

            } else
            {
                $('#txt_vprice').removeAttr("disabled");

            }
        });

        $("#drop_zone1").change(function (e) {

            var v = $(this).val();
            var res_video = v.split('\\').pop();

            $('#hid_cvideo').val(res_video);
            readURL(this);
            $('#err_txtvideo').css('display', 'none');
            var fileExtension = ['mp4'];

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
        $('#txtprice').keyup(function () {
            $('#err_txtprice').css('display', 'none');
        });
        $('#txtdetails').keyup(function () {
            $('#err_txtdetails').css('display', 'none');
        });


        var maxField = 4;
        var addButton = $('.add_button');
        var wrapper = $('.field_wrapper');

        var x = 1, y = '';

        $(addButton).click(function (e) { //Once add button is clicked
            e.preventDefault();
            var fieldHTML = '<div class="col-md-12" ><div class="row"><div class="col-md-3 row"><div class="form-group"><div class="dropZoneContainer" id="drop_camera">'
                    + '<input onchange="previewImg(id_x,event)" id="new_x" type="file"  name="txtfiles[]"  class="addFileUpload"/>'
                    + '<center><img class="imgvideo" src="<?php echo base_url() ?>img/add-post-add-pic.png"><img id="prev_x" class="audi_prev_icon" src="<?php echo base_url() ?>img/add-post-add-pic.png">'

                    + '</center></div></div></div>'
                    + '<div class="col-md-3"><a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="fa fa-minus-circle rm_icon"  aria-hidden="true"></i></a>'
                    + '</div></div></div>';

            y = randomNumberFromRange(10, 100);
            fieldHTML = fieldHTML.replace("new_x", "new_" + y);
            fieldHTML = fieldHTML.replace("prev_x", "prev_" + y);
            fieldHTML = fieldHTML.replace("id_x", y);
            if (x < maxField) { //Check maximum number of input fields
                x++; //Increment field counter
                //alert(x);
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


    });
    function randomNumberFromRange(min, max)
    {
        return Math.floor(Math.random() * (max - min + 1) + min);
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

                url: "<?php echo base_url('Trader/fetch_bikemodel'); ?>",
                success: function (data) {
                    //console.log(data);return false;
                    $('#srchcat3').empty();

                    $.each(data, function (id, city)
                    {
                        var opt = $('<option />'); // here we're creating a new select option for each group
                        opt.val(id);
                        opt.text(city);
                        $('#srchcat3').append(opt);
                    });

                }

            });
        }

    }
    function previewImg(x, event) {
        //alert(event);
        var output = document.getElementById('prev_' + x);
        output.src = URL.createObjectURL(event.target.files[0]);
        $('#prev_' + x).show();



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



</div>
<div id="carbike_div"></div>
<div id="mob_div"></div>
<div id="verwb_div"></div>
<div id="noplate_div"></div>
<div id="prop_div"></div>