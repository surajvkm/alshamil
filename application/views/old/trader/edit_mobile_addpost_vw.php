
<!-- start section -->
<?php echo $this->session->flashdata('msg'); ?>
<form  id="myForm" action="<?php echo base_url() ?>Trader/update_mnpost" enctype="multipart/form-data" method="post">

    <section class="section white-background regsecdiv1">
        <div class="container">
            <div class="row">
                <div class="col-sm-12" >
                    <center>
                        <h5 id="addpost_title" >Edit Post</h5>
                    </center>
                    <input type="hidden" name="txthid_cid" value="<?php echo $qry[0]->productCategoryID ?>">
                    <input type="hidden" name="txthid_pid" value="<?php echo $qry[0]->productID ?>">
                    <input type="hidden" name="txthid_postid" value="<?php echo $qry[0]->postID ?>">
                    <div class="col-md-3" ></div>
                    <div class="col-md-6" >
                        <div class="col-sm-12" >
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="usr" class="addpost_lbl">Category</label>
                                    <select class="form-control" id="txtcategorya" readonly>

                                        <option value="<?php echo $qry[0]->productCategoryID ?>"><?php echo $qry[0]->productCategoryName ?></option>

                                    </select>
                                    <label id="err_txtcat" class="txt_errors">Please Select Your Category</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="usr" class="addpost_lbl">Operator</label><br>
                                    <button <?php echo ($_SESSION['logged_in']['plantype']==1)? 'readonly':''; ?> class="btn btn-default btnmn moboper" id="btn_etisalat">Etisalat</button>
                                    <button <?php echo ($_SESSION['logged_in']['plantype']==1)? 'readonly':''; ?> class="btn btn-default btnmn moboper" id="img_du">DU</button>
                                    <button <?php echo ($_SESSION['logged_in']['plantype']==1)? 'readonly':''; ?> class="btn btn-default btnmn moboper" id="btn_other">Other</button>
                                    <input type="hidden" name="operator" id="operator" value="<?php echo $qry[0]->productOperator ?>"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <center>
                                    <div class="form-group">
                                        <div class="show-plate">
                                           <input <?php echo ($_SESSION['logged_in']['plantype']==1)? 'readonly':''; ?> name="temp" type="hidden" value="<?php echo $qry[0]->MNpost_main_img?>" id="tempImg"/>    
                                            <div id="loading2" style="display: none"><i class="fa fa-cog fa-spin fa-2x fa-fw"></i> Loading..</div>
                                            <?php
                                            if($qry[0]->productOperator == 'Etisalat')
                                            {
                                                ?>
                                                 <img style="display: none" src="<?php echo base_url() ?>img/mobno/base_images/Mobile-etisalath.png" id="template_img" style="width:130px;">

                                            <?php
                                                
                                            }
                                            if($qry[0]->productOperator == 'DU'){
                                                ?>
                                                 <img style="display: none" src="<?php echo base_url() ?>img/mobno/base_images/Mobile-DU.png" id="template_img" style="width:130px;">

                                            <?php
                                                
                                            }
                                            if($qry[0]->productOperator == 'Other'){
                                                ?>
                                                 <img style="display: none" src="<?php echo base_url() ?>img/mobno/base_images/Other-Phone.png" id="template_img" style="width:130px;">

                                            <?php
                                                
                                            }
                                            ?>
                                           
                                            <img src="<?php echo $qry[0]->MNpost_main_img?>" id="newImg" style="width:130px;">
                                        </div>
                                    </div>
                                </center>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="usr" class="addpost_lbl" >Prefix</label>
                                        <select class="form-control" id="txtmainprefix" name="txtprefix" <?php echo ($_SESSION['logged_in']['plantype']==1)? 'readonly':''; ?> >
                                            <?php
                                            foreach ($mob_pref as $r) {
                                                ?>
                                                <option value="<?php echo $r->modelName ?>" <?php if ($r->modelName == $qry[0]->productMNPrefix) echo 'selected' ?>><?php echo $r->modelName ?></option>
                                                <?php
                                            }
                                            ?>


                                        </select>
                                        <label id="err_prefix" class="txt_errors">Enter prefix</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="usr" class="addpost_lbl" >Mobile Number</label>
                                    <input <?php echo ($_SESSION['logged_in']['plantype']==1)? 'readonly':''; ?> type="text" name="txtmob" id="txtmobb" class="form-control" value="<?php echo $qry[0]->productMNNmbr ?>">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price" class="addpost_lbl">Price</label><br>
                                        <?php
                                        if ($qry[0]->productMNCallPrice == 1) {
                                            $res = 'checked';
                                            $readonly = 'readonly';
                                        } else {
                                            $res = '';
                                            $readonly = '';
                                        }
                                        ?>
					<span><input type="checkbox" name="call_for_price" id="chkbox_callpr1" class="form-control chkbox_callpr1" <?php echo $res ?>></span><span class="call_for_pricel" >Call for Price</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                 <div class="form-group">
                                        <label for="price" class="addpost_lbl">Add Price</label>
                                        <input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="txtprice"  id="txtprice" class="form-control" value="<?php echo $qry[0]->productMNPrice ?>" <?php echo $readonly; ?>>
                                        <label id="err_txtprice" class="txt_errors">Enter Price</label>

                                    </div>
                            </div>
                           <div class="col-md-12">
                                    <label for="usr" class="addpost_lbl">Details</label>
                                    <textarea  <?php echo ($_SESSION['logged_in']['plantype']==1)? 'readonly':''; ?> id="txtdetails" name="txtdetails"  class="form-control"><?php echo $qry[0]->productMNDesc ?></textarea>
                                    <label id="err_txtdetails" class="txt_errors">Enter Details</label>

                                </div>

                        </div>
                    </div>
                </div>

            </div>
    </section>
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
                                        <button type="submit" class="btn btn-default btnplantypes" id="btneditsavepost" >UPDATE</button>

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
    $(document).ready(function () {
        var oper = $('#operator').val();
        if (oper == 'Etisalat')
        {
            $('#btn_etisalat').css('border', '2px solid #f5821f');
        } else if (oper == 'DU')
        {
            $('#img_du').css('border', '2px solid #f5821f');
        } else
        {
            $('#btn_other').css('border', '2px solid #f5821f');
        }

        $('.moboper').click(function (e) {


            $('#btn_etisalat').css('border', '1px solid #d3dcdc');
            $('#img_du').css('border', '1px solid #d3dcdc');
            $('#btn_other').css('border', '1px solid #d3dcdc');
            $(this).css('border', '2px solid #f5821f');

            e.preventDefault();
            var mob_oper = $(this).html();
            $('#operator').val(mob_oper);
            $.ajax({
                url: "<?php echo base_url('Trader/fetch_mob_pref'); ?>",

                data: {'mob_oper': mob_oper},
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#txtmainprefix').empty();

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
        $('#btn_etisalat').click(function (e) {
         
             e.preventDefault();
            var imgSrc = '<?php echo base_url()?>img/mobno/base_images/Mobile-etisalath.png';
            $('#template_img').attr('src', imgSrc);
            $('#newImg').attr('src', imgSrc); 
        });
        $('#img_du').click(function (e) {
            e.preventDefault();
            var imgSrc = '<?php echo base_url()?>img/mobno/base_images/Mobile-Du.png';
            $('#template_img').attr('src', imgSrc);
            $('#newImg').attr('src', imgSrc); 
        });
       
        $('#btn_other').click(function (e) {
             e.preventDefault();
             var imgSrc = '<?php echo base_url()?>img/mobno/base_images/Other-Phone.png';
            $('#template_img').attr('src', imgSrc);
            $('#newImg').attr('src', imgSrc); 
           
        });
        $('#txtmobb').blur(function () {
                var operator = $('#operator').val();
               
                var mobno = $(this).val();
                var prefix = $('#txtmainprefix').val();
                var srcimg      = $('#template_img').attr('src');
                var res         = prefix + " " + mobno;
               
                $('#template_img').hide();
                $('#loading2').show('fast');
                $.ajax({
                    url: "<?php echo base_url('Trader/generate_mob_temp'); ?>",
                    data: {'res': res, 'srcimg': srcimg,'operator': operator},
                    type: "POST",

                    success: function (data) { 
                      
                        $('#newImg').attr('src', data);
                        $('#loading2').hide();
                        $('#tempImg').val(data);

                    }
                });

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



</script>

</div>
