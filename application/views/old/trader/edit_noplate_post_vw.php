
<!-- start section -->
<?php echo $this->session->flashdata('msg'); ?>
<form  id="myForm" action="<?php echo base_url()?>Trader/update_noplatepost" enctype="multipart/form-data" method="post">

<section class="section white-background regsecdiv1">
    <div class="container">
        <div class="row">
            <div class="col-sm-12" >
                <center>
                    <h5 id="addpost_title" >Edit Post</h5>
                </center>
                <input type="hidden" name="txthid_cid" value="<?php echo $qry[0]->productCategoryID?>">
                         <input type="hidden" name="txthid_pid" value="<?php echo $qry[0]->productID?>">
                          <input type="hidden" name="txthid_postid" value="<?php echo $qry[0]->postID?>">
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
                                <label for="usr" class="addpost_lbl">Emirates</label>
                                <select class="form-control" id="txtemirates" name="txtemirates" <?php echo ($_SESSION['logged_in']['plantype']==1)? 'readonly':''; ?> >
                                    <?php
                                    foreach ($noplate as $r) {
                                        ?>
                                        <option value="<?php echo $r->noplateTempID ?>" <?php if ($r->noplateTempID == $qry[0]->productNPEmrites) echo 'selected' ?>><?php echo $r->emirates ?></option>
                                        <?php
                                    }
                                    ?>

                                </select>
                                <label id="err_txtemirates" class="txt_errors">Please Select Emirates</label>
                            </div>
                        </div>
                        <div class="col-md-6">
    <center>
        <div class="form-group">
            <div class="show-plate">
               
                <input <?php echo ($_SESSION['logged_in']['plantype']==1)? 'readonly':''; ?> name="temp" type="hidden" value="<?php echo $qry[0]->NPpost_main_img ?>" id="tempImg"/>    
                <img src="<?php echo $qry[0]->NPpost_main_img ?>" id="newImg" style="width:130px;">
                                                         
                <div id="loading2" style="display: none"><i class="fa fa-cog fa-spin fa-2x fa-fw"></i> Loading..</div>
                <img style="display: none" src="" id="template_img" style="width:130px;">
                <div id="short_tmplt"></div>
            </div>
        </div>
    </center>
</div>
<div class="col-md-6">
    <center>
        <div class="form-group">
            <div class="show-plate">
                <input name="long_tempImg" <?php echo ($_SESSION['logged_in']['plantype']==1)? 'readonly':''; ?> type="hidden" value="<?php echo $qry[0]->productImage ?>" id="long_tempImg"/>    
                
                <img  src="<?php echo $qry[0]->productImage ?>"  id="newImg2" style="width:130px;">
                <div id="loading2" style="display: none"><i class="fa fa-cog fa-spin fa-2x fa-fw"></i> Loading..</div>
                <img style="display: none" src="" id="template_img_long" style="width:130px;">
                <div id="long_tmplt"></div>
                
                <img style="display: none" src="" id="long_template_img" style="width:130px;">
            </div>
        </div>
    </center>
</div>
                        <div class="col-md-6" id="codeDiv">
                            <div class="form-group">
                                <label for="usr" class="addpost_lbl">Code</label>
                                <select class="form-control" name="txtcode" id="txtcode" <?php echo ($_SESSION['logged_in']['plantype']==1)? 'readonly':''; ?> >
                                    <?php
                                    foreach ($em_codes as $k) {
                                        ?>
                                        <option value="<?php echo $k ?>" <?php if ($k == $qry[0]->productNPCode) echo 'selected' ?>><?php echo $k ?></option>
                                        <?php
                                    }
                                    ?>

                                </select>
                                <label id="err_txtcode" class="txt_errors">Please Select Code</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="usr" class="addpost_lbl">Number of Digit</label>
                                <select class="form-control" name="txtno_digs" id="txtno_digs" <?php echo ($_SESSION['logged_in']['plantype']==1)? 'readonly':''; ?> >
                                    <option value="">--Select--</option>
                                    <option value="1" <?php if ($qry[0]->productNPDigits == 1) echo 'selected' ?>>1</option>
                                    <option value="2" <?php if ($qry[0]->productNPDigits == 2) echo 'selected' ?>>2</option>
                                    <option value="3" <?php if ($qry[0]->productNPDigits == 3) echo 'selected' ?>>3</option>
                                    <option value="4" <?php if ($qry[0]->productNPDigits == 4) echo 'selected' ?>>4</option>
                                    <option value="5" <?php if ($qry[0]->productNPDigits == 5) echo 'selected' ?>>5</option>
                                </select>
                                <label id="err_txtno_digs" class="txt_errors">Please Select No. of Digits</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="usr" class="addpost_lbl">Number</label>
                                <input <?php echo ($_SESSION['logged_in']['plantype']==1)? 'readonly':''; ?> type="text" name="txtnumber" id="txtno" class="form-control" value="<?php echo $qry[0]->productNPNmbr ?>">

                                <label id="err_txtno" class="txt_errors">Enter Number</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group" style='display:none;'>
                                <label for="price" class="addpost_lbl">Type</label><br>
                                <?php
                                if ($qry[0]->type == 1) {
                                    $res = 'checked';
                                    $readonly = 'readonly';
                                } else {
                                    $res = '';
                                    $readonly = '';
                                }
                                ?>
                                <span><input type="checkbox" name="txtType"  id="vehicle_typep" <?php echo $res ?> class="form-control chkbox_callpr1"></span><span class="call_for_pricel" >Bike</span>


                            </div>
                        </div>
                    <div class="col-md-12"></div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price" class="addpost_lbl">Price</label><br>
                                <?php
                                if ($qry[0]->productNPCallPrice == 1) {
                                    $res = 'checked';
                                    $readonly = 'readonly';
                                } else {
                                    $res = '';
                                    $readonly = '';
                                }
                                ?>
                                
                                <span><input <?php echo $res; ?> type="checkbox" name="call_for_price" id="chkbox_callpr1"  <?php echo $res ?> class="form-control chkbox_callpr1"></span><span class="call_for_pricel" >Call for Price</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price" class="addpost_lbl">Add Price</label>
                                <input <?php echo $readonly; ?> type="text"  onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="txtprice"  id="txtprice" class="form-control" value="<?php echo $qry[0]->productNPPrice?>">
                                <label id="err_txtprice" class="txt_errors">Enter Price</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="usr" class="addpost_lbl">Details</label>
                            <textarea <?php echo ($_SESSION['logged_in']['plantype']==1)? 'readonly':''; ?> id="txtdetails" name="txtdetails"  class="form-control"><?php echo $qry[0]->productNPDesc?></textarea>
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
 var type;
    $(document).ready(function () {
        
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
        $('#vehicle_typep').click(function () {
            fetch_numplate();
        });
        $('#txtemirates').change(function () {
            // $('#template_img').hide();
            // $('#loading2').show('fast');
            // var emirates = $(this).val();


            // $.ajax({
            //     url: "<?php echo base_url('Trader/fetch_temp_img'); ?>",
            //     data: {'emirates': emirates},

            //     type: "POST",

            //     success: function (data) {
            //         $('#template_img').attr('src', data);
            //         $('#newImg').attr('src', data);
            //         $('#loading2').hide();

            //     }

            // });
            $('#template_img').hide();
            $('#loading2').show('fast');
            var emirates = $(this).val();
           
         
            if ($('#vehicle_typep').is(':checked'))
            {
                type=1;

            } else
            {
                type=0;

            }
      
            if(type==1 && emirates!=8){
                $('#codeDiv').hide();
            }else{
                 $('#codeDiv').show();
            }

            $.ajax({
                url: "<?php echo base_url('Trader/fetch_temp_img'); ?>",
                data: {'emirates': emirates,'type':type},

                type: "POST",
                dataType: 'json',
                success: function (data) {
                     $('#short_tmplt').html('<img id="newImg" src="'+data.templates+'" id="" style="width:130px;">');
                    $('#template_img').attr('src', data.templates);

                    // $('#newImg').append('<img style="display: none" src="'+data.templates+'" id="template_img" style="width:130px;">');

                    $('#long_tmplt').html('<img id="long_newImg" src="'+data.long_template+'" id="" style="width:130px;">');
                     $('#long_template_img').attr('src', data.long_template);


                    // $('#template_img').attr('src', data);
                    $('#tempImg').val( data.templates);
                     $('#loading2').hide();
                     $('#newImg').hide();
                     $('#newImg2').hide();
                }

            });
            $.ajax({
                url: "<?php echo base_url('Trader/fetch_temp_code'); ?>",
                data: {'emirates': emirates},

                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#loading2').hide();


                    $('#txtcode').empty();

                    $.each(data, function (id, city)
                    {
                        var opt = $('<option />'); // here we're creating a new select option for each group
                        opt.val(id);
                        opt.text(city);
                        $('#txtcode').append(opt);
                    });

                }

            });
        });


        $('#txtno_digs').change(function () {
            var limit = $(this).val();
            $('#txtno').attr('maxlength', limit);
        });
        $('#txtno').keyup(function (e) {
            e.preventDefault();
            var count = this.value.length;
            var max = $('#txtno_digs').val();
            
            if (count == max) {
                fetch_numplate();
                
            }else{
     
                e.stopPropagation();
            }
        });
function fetch_numplate(){
    $('#template_img').hide();
            $('#loading2').show('fast');
            var emirates = $('#txtemirates').val();
     
            if ($('#vehicle_typep').is(':checked'))
            {
                type=1;

            } else
            {
                type=0;

            }
   
            if(type==1 && emirates!=8){
                $('#codeDiv').hide();
            }else{
                 $('#codeDiv').show();
            }

            $.ajax({
                url: "<?php echo base_url('Trader/fetch_temp_img'); ?>",
                data: {'emirates': emirates,'type':type},

                type: "POST",
                dataType: 'json',
                success: function (data) {
                     $('#short_tmplt').html('<img id="newImg" src="'+data.templates+'" id="" style="width:130px;">');
                    $('#template_img').attr('src', data.templates);

                    // $('#newImg').append('<img style="display: none" src="'+data.templates+'" id="template_img" style="width:130px;">');

                    $('#long_tmplt').html('<img id="long_newImg" src="'+data.long_template+'" id="" style="width:130px;">');
                     $('#long_template_img').attr('src', data.long_template);


                    // $('#template_img').attr('src', data);
                    $('#tempImg').val( data.templates);
                     $('#loading2').hide();
                     $('#newImg').hide();
                     $('#newImg2').hide();
                     generate_noplate();
                }

            });
}     
function generate_noplate(){
    
    var emrId = $('#txtemirates').val();
                $('#err_txtno').css('display', 'none');
                var code = $('#txtcode').val();
                var srcimg      = $('#template_img').attr('src');

                var srcimg_long = $('#long_template_img').attr('src');
                var tarr        = srcimg.split('/');
                var file_name   = tarr[tarr.length - 1];
                var temp        = $('#tempImg').val();

                var tarr        = srcimg_long.split('/');
                var file_name_long   = tarr[tarr.length - 1];

                var np_no = $('#txtno').val();
                var res = code + " " + np_no;
                $('#tem_name').html(res);

                $('#template_img').hide();
                $('#loading2').show('fast');
                if ($('#vehicle_typep').is(':checked'))
            {
                type=1;

            } else
            {
                type=0;

            }
                    if(type==0){
                        $.ajax({
                            url: "<?php echo base_url('Trader/generate_nopl_temp'); ?>",
                            data: {'res': res, 'srcimg': file_name, 'emrId': emrId, 'temp': temp,'srcimg_long':file_name_long},
                            type: "POST",
                            dataType: 'json',
                            success: function (data) { 
                            $('#short_tmplt').html('<img id="genImg" src="'+data.short+'"  style="width:130px;">');
                            $('#tempImg').val(data.short);
                            $('#long_tmplt').html('<img id="long_newImg" src="'+data.long+'" style="width:130px;">');
                            //$('#num_long').val( data.long);
                            $('#long_tempImg').val( data.long);
                                
                            $('#loading2').hide();
                            
                               
                            }
                        });
                    }
                    else{
                        $.ajax({
                            url: "<?php echo base_url('Trader/generate_nopl_temp_bike'); ?>",
                            data: {'res': res, 'srcimg': file_name, 'emrId': emrId, 'temp': temp,'srcimg_long':file_name_long},
                            type: "POST",
                            dataType: 'json',
                            success: function (data) { 
                            $('#short_tmplt').html('<img id="genImg" src="'+data.short+'"  style="width:130px;">');
                            $('#tempImg').val(data.short);
                            $('#long_tmplt').html('<img id="long_newImg" src="'+data.long+'" style="width:130px;">');
                            //$('#num_long').val( data.long);
                            $('#long_tempImg').val( data.long);
                                
                            $('#loading2').hide();
                            
                               
                            }
                        });
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
            fetch_numplate();
        });
        $('#txtno_digs').change(function () {
            $('#err_txtno_digs').css('display', 'none');
        });

        $('#txtprice').keyup(function () {
            $('#err_txtprice').css('display', 'none');
        });
        $('#txtdetails').keyup(function () {
            $('#err_txtdetails').css('display', 'none');
        });

        $('#btnsavepost').click(function () {

            var txtemirates = $('#txtemirates').val();
            var txtcode = $('#txtcode').val();
            var txtno_digs = $('#txtno_digs').val();
            var txtno = $('#txtno').val();

            var txtprice = $('#txtprice').val();
            var txtdetails = $('#txtdetails').val();

            if ((txtemirates == '') || (txtcode == '') || (txtno_digs == '') || (txtno == '') || (txtdetails == ''))
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

                }


                if (txtdetails == '')
                {

                    $('#err_txtdetails').css('display', 'block');

                }

                //return false;
            } else
            {

                $('#btnsavepost').prop('readonly', true);
                $('#loading').show();
                var form = $('#myForm')[0];
                var formData = new FormData(form);


                $.ajax({
                    url: "<?php echo base_url('Trader/save_noplatepost'); ?>",

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



</script>

</div>
