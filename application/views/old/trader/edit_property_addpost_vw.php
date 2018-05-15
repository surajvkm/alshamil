<!-- start section -->
<?php echo $this->session->flashdata('msg'); ?>
<form  id="myForm" action="<?php echo base_url() ?>Trader/update_propertypost" enctype="multipart/form-data" method="post">


    <section class="section white-background regsecdiv1">
        <div class="container">
            <div class="row">
                <div class="col-sm-12" >

                    <center>
                        <h5 id="addpost_title" >Edit Post</h5>
                        <input type="hidden" name="txthid_cid" value="<?php echo $qry[0]->productCategoryID ?>">
                        <input type="hidden" name="txthid_pid" value="<?php echo $qry[0]->productID ?>">
                        <input type="hidden" name="txthid_postid" value="<?php echo $qry[0]->postID ?>">
                    </center>
                    <div class="col-md-3" ></div>

                    <div class="col-md-6" > 
                        <div class="col-sm-12" >
                            <div class="col-md-6" >
                                <div class="form-group">
                                    <label for="usr" class="addpost_lbl">Category</label>
                                    <select class="form-control" id="txtcategorya" readonly >

                                        <option value="9">Property</option> 

                                    </select>
                                    <label id="err_txtcat" class="txt_errors">Please Select Your Category</label>
                                </div>
                            </div>
                            <div class="col-md-6" id="txthidbrand">
                                <div class="form-group">
                                    <label for="usr" class="addpost_lbl">Sub Category</label>
                                    <select class="form-control" name="txtbrand" id="txtbrand" onchange="fetch_model(this.value)" <?php echo ($_SESSION['logged_in']['plantype']==1)? 'readonly':''; ?> >
                                        <?php
                                        foreach ($prop_qry as $r) {
                                            ?>
                                            <option value="<?php echo $r->brandName ?>" <?php if ($r->brandName == $qry[0]->productPropSC) echo 'selected' ?>><?php echo $r->brandName ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <label id="err_txtbrand" class="txt_errors">Please Select Your Subcategory</label>
                                </div>
                            </div>

                            <div class="col-md-6" >
                                <div class="form-group">
                                    <label for="usr" class="addpost_lbl">Property</label>
                                    <select class="form-control" name="txtmodel" id="txtmodel" <?php echo ($_SESSION['logged_in']['plantype']==1)? 'readonly':''; ?> >


                                        <?php
                                        foreach ($prop_types as $r) {
                                            ?>
                                            <option value="<?php echo $r->modelName ?>" <?php if ($r->modelName == $qry[0]->productPropType) echo 'selected' ?>><?php echo $r->modelName ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <label id="err_txtmodel" class="txt_errors">Please Select Your Property</label>
                                </div>
                            </div>
                            <div class="col-md-6" >
                                <div class="form-group">
                                    <label for="price" class="addpost_lbl">Price</label><br>
                                    <?php
                                    if ($qry[0]->productPropCallPrice == 1) {
                                        $res = 'checked';
                                        $readonly = 'readonly';
                                    } else {
                                        $res = '';
                                        $readonly = '';
                                    }
                                    ?>
                                    <span><input type="checkbox" name="call_for_price" id="chkbox_callpr1"   <?php echo $res ?> class="form-control chkbox_callpr1"></span><span class="call_for_pricel" >Call for Price</span>

                                </div>
                            </div>
                            <div class="col-md-12"></div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price" class="addpost_lbl">Add Price</label>

                                    <input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="txtprice"  id="txtprice" class="form-control" value="<?php echo $qry[0]->productPRPrice ?>" <?php echo $readonly; ?>>
                                    <label id="err_txtprice" class="txt_errors">Enter Price</label>

                                </div>
                            </div>
                                   
                                    
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label for="usr" class="addpost_lbl">Details</label>
                                    <textarea id="txtdetails" <?php echo ($_SESSION['logged_in']['plantype']==1)? 'readonly':''; ?> name="txtdetails"  class="form-control"><?php echo $qry[0]->productDesc ?></textarea>
                                    <label id="err_txtdetails" class="txt_errors">Enter Details</label>

                                </div>
                            </div>

                              
 <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12" >
                                                <label for="usr" class="addpost_lbl" id="lblauvid">Add Video & Photos</label>
                                            </div>
                                            <div class="col-md-12" >
                                                <div class="col-md-2 editthumb category-dateview"> 
                                                    <div class="form-group">
                                                        <div class="dropZoneContainer">
                                                            <div  id="v"></div>
                                                            <input <?php echo ($_SESSION['logged_in']['plantype']==1)? 'readonly':''; ?> onchange="vPreview(event)" type="file" id="drop_zone1" name="productVideo" class="addFileUpload" value="" accept=".mp4" />
                                                            <input type="hidden" name="vd" value="<?php echo $qry[0]->productVideo; ?>" />
                                                            <?php
                                                            if ($qry[0]->productVideo != '') {
                                                                ?>
                                                                    <video class="vid">
                                                                        <source src="<?php echo $qry[0]->productVideo; ?>" type="video/mp4">
                                                                    </video>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <img src="<?php echo base_url() ?>img/add-post-add-video.png" class="mainVideoImg">  
                                                                    <?php
                                                                }
                                                                ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-2 editthumb category-dateview"> 
                                                    <div class="form-group">
                                                        <div class="dropZoneContainer">
                                                            <input <?php echo ($_SESSION['logged_in']['plantype']==1)? 'readonly':''; ?> type="file" id="drop_zoneimg" name="txtimage" class="addFileUpload" accept=".jpg,.png,.gif" />
                                                            <img id="edit_main_imgprev"  class="edit_imgs" width="85x" src="<?php echo $qry[0]->PRpost_main_img ?>">
                                                            <input type="hidden" id="hid_main_img" name="edit_main_img" value="<?php echo $qry[0]->PRpost_main_img ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            <?php
                                            for ($j = 0; $j < 3; $j++) {
                                                $img = "";
                                                if ($j < count($qry)) {
                                                    $img = $qry[$j]->productImage;
                                                }
                                                if ($img != '') {
                                                    ?>
                                                    <input type="hidden" name="imgs[]" value="<?php echo $img ?>">
                                                    <div class="col-md-2 editthumb category-dateview">
                                                        <div class="form-group">
                                                                <div class="dropZoneContainer">
                                                                    <input <?php echo ($_SESSION['logged_in']['plantype']==1)? 'readonly':''; ?> type="file" id="car_img_<?php echo $j ?>" name="txtfiles[]" class="addFileUpload" accept=".jpg,.png,.gif"  />
                                                                    <input type="hidden" id="txt_hidaudio">
                                                                    <img src="<?php echo $img ?>" class="edit_imgs" width="85x" id="multi_prev_<?php echo $j ?>">
                                                                    <?php
                                                                    $path_parts = pathinfo($img);
                                                                    $f = $path_parts['basename'];
                                                                    ?>
                                                                    <input type="hidden" name="edit_imgs[]" value="<?php echo $f ?>">
                                                            </div>
                                                        </div>
                                                    </div>

                                                        <?php
                                                    } else {
                                                        ?>
                                                    <div class="col-md-2 editthumb category-dateview">
                                                        <div class="form-group"> 
                                                            <div class="dropZoneContainer">
                                                                <input <?php echo ($_SESSION['logged_in']['plantype']==1)? 'readonly':''; ?> type="file" id="car_img_<?php echo $j ?>" name="txtfiles[]" class="addFileUpload" accept=".jpg,.png,.gif"  />
                                                                <input type="hidden" id="txt_hidaudio">
                                                                <img id="multi_prev_<?php echo $j ?>" class="edit_imgs" width="85x"  src="<?php echo base_url() ?>img/add-post-add-pic.png">
                                                                <img id="audi_prev_icon" src="<?php echo base_url() ?>img/add-post-add-pic.png">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <?php
                                                }
                                            }
                                            ?>




                                                </div>

                                            </div>



                                        </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </section>
    <!-- end section -->
    <div id="button_div">
        <section class="section white-background regsecdiv1">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12" >


                        <div class="container-fluid contdiv1" >


                            <div class="row" id="postbtn">
                                <div class="col-sm-3" >

                                    <div >

                                        <button type="button" class="btn btn-default btnplantypes" id="btneditpostclr">CLEAR</button>

                                    </div>
                                </div>
                                <div class="col-sm-3" >
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-default btnplantypes" id="btneditsavepost" >SAVE</button>

                                    </div>
                                </div>


                            </div>




                        </div>




                    </div>
                </div>
            </div><!-- end container -->


        </section>
    </div>


</form>

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
    function readmainpev(input)
    {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#edit_main_imgprev').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function fetch_model(brand)
    {
//               alert(brand);return false;
        //var brand = $("#txtbrand").val();
//               $('#err_txtbrand').css('display','none'); 
        var data = 'brand=' + brand;
        if (brand != "") {
            $.ajax({
                type: "POST",
                dataType: 'json',
                data: data,

                url: "<?php echo base_url('Trader/fetch_editbikemodel'); ?>",
                success: function (data) {

                    $('#txtmodel').empty();

                    $.each(data, function (id, city)
                    {
                        var opt = $('<option />'); // here we're creating a new select option for each group
                        opt.val(id);
                        opt.text(city);
                        $('#txtmodel').append(opt);
                    });

                }

            });
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

       $('#drop_zoneimg').change(function () {
            var v = $(this).val();
            var res_img = v.split('\\').pop();
            $('#hid_main_img').val(res_img);

            $('#err_txtaudio').css('display', 'none');
            var imgExtension = ['jpeg', 'jpg', 'png', 'gif'];
            if ($.inArray($(this).val().split('.').pop().toLowerCase(), imgExtension) == -1) {
                alert("Only formats are allowed : " + imgExtension.join(', '));
            }
            else{
                   readmainpev(this);
            }
            
            var totalBytes = this.files[0].size;
            if (totalBytes > 128000000)
            {
                alert("File Size cannot exceeds 128 MB");
            }
         
            //$("#drop_zone2").click();
        });
        $("#car_img_0").change(function () {

            readaudioURL0(this);
            //$("#drop_zone2").click();
        });
        $("#car_img_1").change(function () {

            readaudioURL1(this);
            //$("#drop_zone2").click();
        });
        $("#car_img_2").change(function () {

            readaudioURL2(this);
            //$("#drop_zone2").click();
        });
        $('#chkbox_callpr1').click(function () {
            if ($('#chkbox_callpr1').is(':checked'))
            {
                $('#txtprice').attr("readonly", "readonly");
                $("#txtprice").val('')

            } else
            {
                $('#txtprice').removeAttr("readonly");

            }
        });

        $("#drop_zone1").change(function () {
            var v = $(this).val();
            // alert(v);return false;
            $('#txt_hidvideo').val(v);
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
        $('#txtprice').keyup(function () {
            $('#err_txtprice').css('display', 'none');
        });
        $('#txtdetails').keyup(function () {
            $('#err_txtdetails').css('display', 'none');
        });

        /*$('#btneditsavepost').click(function () {
         
         var txtplace = $('#txtplace').val();
         var txtcat = $('#txtcategorya').val();
         var txtbrand = $('#txtbrand').val();
         var txtmodel = $('#txtmodel').val();
         var txtyear = $('#txtyear').val();
         var txtprice = $('#txtprice').val();
         var txtdetails = $('#txtdetails').val();
         var txtvideo = $('#txt_hidvideo').val();
         var txtaudio = $('#txt_hidaudio').val();
         if ((txtplace == '') || (txtcat == '') || (txtbrand == '') || (txtmodel == '') || (txtyear == '') || (txtprice == '') || (txtdetails == '') || (txtvideo == '') || (txtaudio == ''))
         {
         if (txtplace == '')
         {
         $('#err_txtplace').css('display', 'block');
         }
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
         
         alert("success");
         return false;
         $.ajax({
         url: "<?php echo base_url('Trader/save_post'); ?>",
         data: {'txtplace': txtplace},
         type: "POST",
         
         success: function (data) {
         console.log(data);
         //$('#post_content').html(data);
         }
         
         });
         }
         */
        var maxField = 9; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        //var fieldHTML = '<div><div class="dropZoneContainer1" id="drop_camera"><input type="file" id="drop_zone" class="FileUpload" accept=".jpg,.png,.gif"  /><div class="dropZoneOverlay"><i class="fa fa-camera" aria-hidden="true"></i></div></div></div>';
        //var fieldHTML = '<div><input type="file" id="txt_admorepost" name="txt_admorepost[]" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="fa fa-minus-circle rm_icon"  aria-hidden="true"></i></a></div>'; //New input field html 

        var fieldHTML = '<div style="position: relative;margin-top:2%; background-color:#f7f7f7;width:15%;height:72px;border-radius:9px;" ><i class="fa fa-camera moreaudi_icon" aria-hidden="true"></i>'
                + '<span class="fa-stack fa-lg spaddvideo" >'
                + '<i class="fa fa-circle fa-stack-1x icon-background111"></i>'
                + '<i class="fa fa-plus fa-stack-1x vdmoreplus"  aria-hidden="true"></i>'
                + '</span><a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="fa fa-minus-circle rm_icon"  aria-hidden="true"></i></a>'
                + '<input type="file" id="drop_zone21" name="file[]" class="FileUpload" style="opacity: 0.0; position: absolute; top: 0; left: 0; bottom: 0; right: 0; " />';
        +'</div><br>';
        var x = 1; //Initial field counter is 1
        $(addButton).click(function () { //Once add button is clicked
            // alert("123");return false;
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

                $("#ggg").load("<?php echo base_url() . 'Trader/car_addpostview/1'; ?>");
                //$("#ggg").html("123");

            }
            if (category == '2')
            {

                $("#ggg").load("<?php echo base_url() . 'Trader/bike_addpostview/2'; ?>");

            }
            if (category == '3')
            {

                $("#ggg").load("<?php echo base_url() . 'Trader/noplate_addpostview/3'; ?>");

            }
            if (category == '4')
            {


                $("#ggg").load("<?php echo base_url() . 'Trader/vertu_addpostview/4'; ?>");

            }
            if (category == '5')
            {


                $("#ggg").load("<?php echo base_url() . 'Trader/watch_addpostview/5'; ?>");

            }
            if (category == '6')
            {


                $("#ggg").load("<?php echo base_url() . 'Trader/mobile_addpostview/6'; ?>");

            }
            if (category == '7')
            {



                $("#ggg").load("<?php echo base_url() . 'Trader/boat_addpostview/7'; ?>");

            }
            if (category == '8')
            {


                $("#ggg").load("<?php echo base_url() . 'Trader/phone_addpostview/8'; ?>");

            }
            if (category == '9')
            {


                $("#ggg").load("<?php echo base_url() . 'Trader/property_addpostview/9'; ?>");

            }
        });
    });
    function readaudioURL0(input)
    {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                //$('#car_img').attr('src', e.target.result);


                $('#multi_prev_0').attr('src', e.target.result);

            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    function readaudioURL1(input)
    {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                //$('#car_img').attr('src', e.target.result);


                $('#multi_prev_1').attr('src', e.target.result);

            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    function readaudioURL2(input)
    {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                //$('#car_img').attr('src', e.target.result);


                $('#multi_prev_2').attr('src', e.target.result);

            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    function previewImg(x, event) {

        var output = document.getElementById('prev_' + x);
        output.src = URL.createObjectURL(event.target.files[0]);
        $('#prev_' + x).show();
    }
    function vPreview(e) {

        var src = URL.createObjectURL(document.querySelector("#drop_zone1").files[0]);
        var x = '<video class="videoeditpost" id="video1"  src="' + src + '">your browser does not support the video tag</video>';

        //<canvas id="canvas" width=300 height=300/><canvas id="myCanvas" width="270" height="135" style="border:1px solid #d3d3d3;"> Your browser does not support the HTML5 canvas tag.</canvas>    

        $('#v').html(x);
        var v = document.getElementById("video1");
        var c = document.getElementById("myCanvas");
        var ctx = c.getContext("2d");
        var i;

        v.addEventListener("play", function () {
            ctx.drawImage(v, 5, 5, 260, 125)
        }, false);
    }
</script>

