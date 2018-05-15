<?php echo $this->session->flashdata('msg'); ?>
                                <div class="col-sm-6" >
                                    <div class="form-group">
                                        <label for="usr" class="addpost_lbl">Sub Category</label>
                                       
                                        <select class="form-control reginputs" name="txtsubcat" id="txtsubcat" onchange="fetch_model(this.value)">
                                            <option value="">--Select--</option>
                                            <?php
                                            foreach($prop_qry as $r)
                                            {
                                                ?>
                                                     <option value="<?php echo $r->brandID?>"><?php echo $r->brandName?></option>
                                                     <?php
                                            }
                                            ?>
                                           
                                        </select>
                                        <label id="err_txtsubcat" class="txt_errors">Please Select Your Sub Category</label>
                                    </div>
                                </div>
                                <div class="col-sm-6" id="property_col">
                                    <div class="form-group">
                                        <label for="usr" class="addpost_lbl">Property</label>
                                        <select class="form-control reginputs" name="txtprop" id="txtprop">
                                            <option value="">--Select--</option>
                                           
                                        </select>
                                        <label id="err_txtprop" class="txt_errors">Please Select Your Property</label>
                                   </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-6" >
                                    <div class="form-group">
                                        <label for="usr" class="addpost_lbl">Price</label>
                                        
                                        
                                        <input type="checkbox" name="call_for_price" id="chkbox_callpr1"  class="form-control reginputs"><span id="call_for_price9" >Call for Price</span>
<!--                                          <label id="err_txtprice" class="txt_errors">Enter Price</label>-->

                                   

                                    </div>
                                </div>
                                

                            </div>
                            <div class="row">
                                <div class="col-sm-6" id="prop_add_price">
                                    <label for="usr" class="addpost_lbl">Add Price</label>
                                        <input type="text" name="txtprice"  id="txt_cprice" class="form-control reginputs" value="">
                                        <label id="err_txtcprice" class="txt_errors">Enter Price</label>
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
    <div class="col-sm-12" >

        <label for="usr" class="addpost_lbl" id="lblauvid">Add Video & Photos</label>
        <div class="form-group">
            <div class="col-md-4">

                <div class="dropZoneContainer" id="drop_video">
                     <div  id="v"></div>
                    <input type="file" id="drop_zone1" name="productVideo" class="FileUpload" required=""/>
                    <input type="hidden" id="hid_cvideo">
                    <div class="dropZoneOverlay">
                        <img id="vid_icon" src="<?php echo base_url() ?>img/add-post-add-video.png">
                    </div>
<!--                    <video  id="video-element" controls>
                      
                    </video>-->
               
                </div>

            </div>
        </div>

        <div class="form-group">
            <div class="col-md-4">
                <div class="dropZoneContainer" id="drop_camera">
                    <input type="file" id="car_img"  name="txtimage" class="FileUpload" accept=".jpg,.png,.gif"  />
                    <input type="hidden" id="txt_hidaudio">
                    <div class="dropZoneOverlay">
                        <img id="audi_icon" src="<?php echo base_url() ?>img/add-post-add-pic.png">
                        <img id="audi_prev_icon" src="<?php echo base_url() ?>img/add-post-add-pic.png">
                    </div>
                </div>

            </div>
        </div>
        <div class="form-group">
            <div class="col-md-4">

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
    <!--    <label id="err_txtvideo" class="txt_errors">Please Upload a Video</label>-->
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


   
        <script>
        function fetch_model(brand)
    {

        $('#err_txtcarbrand').css('display', 'none');
        var data = 'brand=' + brand;
        if (brand != "") {
            $.ajax({
                type: "POST",
                dataType: 'json',
                data: data,

                url: "<?php echo base_url('admin/Dashboard/fetch_bikemodel'); ?>",
                success: function (data) {
                    
                    $('#txtprop').empty();

                    $.each(data, function (id, city)
                    {
                        var opt = $('<option />'); // here we're creating a new select option for each group
                        opt.val(id);
                        opt.text(city);
                        $('#txtprop').append(opt);
                    });

                }

            });
        }

    }
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

            $(document).ready(function(){
                var maxField = 5; 
                var addButton = $('.add_button'); 
                var wrapper = $('.field_wrapper');

                var x = 1; var y = '';
                $(addButton).click(function (e) { 
                    e.preventDefault();
                    var fieldHTML = '<div class="dropZoneContainer" id="more_drop_camera" style="width: 107px;position: relative;left: 15px;">'
                        + '<input type="file" id="car_img" name="" class="FileUpload"/>'
                        + '<div class="dropZoneOverlay" style="width:100px;height:80px;padding-top:17px;padding-left:25px;">'
                        + '<img id="audi_icon" src="<?php echo base_url() ?>img/add-post-add-pic.png">'
                        + '<img id="prev_x" class="audi_prev_icon" src="<?php echo base_url() ?>img/add-post-add-pic.png">'
                        + '</div>'
                        + '<a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="fa fa-minus-circle rm_icon"  aria-hidden="true"></i></a>'
                        + '<input onchange="previewImg(id_x,event)" id="new_x" type="file"  name="txtfiles[]"  class="FileUpload1 " style="opacity: 0.0; position: absolute; top: 0; left: 0; bottom: 0; right: 0; " />';
                +'<br>';
           y = randomNumberFromRange(10, 100);
           fieldHTML = fieldHTML.replace("new_x", "new_"+y);
           fieldHTML = fieldHTML.replace("prev_x", "prev_"+y);
           fieldHTML = fieldHTML.replace("id_x", y);
            if (x < maxField) { 
                x++; 
                $(wrapper).append(fieldHTML);
            } else
            {
                swal("You cannot upload more than 5 photos");
            }
        });
        $(wrapper).on('click', '.remove_button', function (e) { //Once remove button is clicked
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html

            x--; //Decrement field counter
        });
        function randomNumberFromRange(min,max)
        {
            return Math.floor(Math.random()*(max-min+1)+min);
        }
                $('#chkbox_callpr1').click(function () 
                {
                   
                    if ($('#chkbox_callpr1').is(':checked'))
                    {
                        $('#txt_cprice').attr("disabled", "disabled");

                    } else
                    {
                        $('#txt_cprice').removeAttr("disabled");

                    }
                });
                $('#btnpostclr').click(function(){
                    $('input').val('');
                    $('textarea').val('');
                    $("select").prop('selectedIndex', 0);
                });
             $("#car_img").click(function () {
            readaudioURL(this);
            //$("#drop_zone2").click();
        });
               $('#btnsavepost').click(function () {
                        var res = $('#chkbox_callpr1').is(':checked');
                        var txtprice = $('#txt_propprice').val();

            var res = $('#chkbox_callpr1').is(':checked');
            var txtprice = $('#txt_cprice').val();


            var txtcat = $('#txtcategorya').val();
            //alert("gfg"+txtcat);return false;
            var txtsubcat = $('#txtsubcat').val();
            var txtprop = $('#txtprop').val();

            var txtprice = $('#txt_cprice').val();
            var txtdetails = $('#txtdetails').val();
            var txtvideo = $('#hid_cvideo').val();
            var txtaudio = $('#txt_hidaudio').val();

            if ((txtcat == '') || (txtsubcat == '') || (txtprop == '')  || (txtdetails == '') || (txtaudio == ''))
            {

                if (txtcat == '')
                {

                    $('#err_txtcat').css('display', 'block');

                }
                if (txtsubcat == '')
                {

                    $('#err_txtsubcat').css('display', 'block');

                }
                if (txtprop == '')
                {

                    $('#err_txtprop').css('display', 'block');
                }

                

                if ($('#chkbox_callpr1').is(':checked'))
                {

                    $('#err_txtcprice').css('display', 'none');

                } else
                {
                    if (txtprice == '')
                    {
                        $('#err_txtcprice').css('display', 'block');
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
                var form = $('#myForm')[0];
                var formData = new FormData(form);


                $.ajax({
                    url: "<?php echo base_url('Trader/save_proppost'); ?>",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    type: "POST",

                    success: function (data) {
                        swal("Your Product Details Added Successfully");
                         $('#loading').hide();
                         $("#postForm").submit();
                    }

                });
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
        
         $("#car_img").click(function () {
            readaudioURL(this);
            //$("#drop_zone2").click();
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

        $('#chkbox_callpr1').click(function () {

            if ($('#chkbox_callpr1').is(':checked'))
            {
                $('#txtpropprice').attr("disabled", "disabled");

            } else
            {
                $('#txtpropprice').removeAttr("disabled");

            }
        });


            });
        function previewImg(x,event){
        
        var output = document.getElementById('prev_'+x);
        output.src = URL.createObjectURL(event.target.files[0]);
        $('#prev_'+x).show();     
        }
        </script>

