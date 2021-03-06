
<!-- start section -->
<?php echo $this->session->flashdata('msg'); ?>
<div class="col-md-6">
    <div class="form-group">
        <label for="price" class="addpost_lbl">Type</label><br>
        <select class="form-control reginputs" id="vehicle_typep" name="vehicle_type">
           <option value="">Select Vehicle Type</option>
           <option value="0">Car</option>
           <option value="1">Bike</option>
        </select>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="usr" class="addpost_lbl">Emirates</label>
        <select class="form-control" id="txtemirates" name="txtemirates">
            <option value="">--Select--</option>
            <?php
            foreach ($template_qry as $r) {
                ?>
                <option value="<?php echo $r->noplateTempID ?>"><?php echo $r->emirates ?></option>
                <?php
            }
            ?>
        </select>
        <input name="emirates_name" type="hidden" value="" id="emirates_name"/>    
        <label id="err_txtemirates" class="txt_errors">Please Select Emirates</label>
    </div>
</div>


<div  class="col-md-6">
    <div  id="codeDiv" class="form-group">
        <label for="usr" class="addpost_lbl">Code</label>
        <select class="form-control" name="txtcode" id="txtcode">
            <option value="">--Select--</option>
        </select>
        <label id="err_txtcode" class="txt_errors">Please Select Code</label>
    </div>
</div>

<div class="col-md-6">
    <center>
        <div class="form-group">
            <div class="show-plate">
                <input name="temp" type="hidden" value="" id="tempImg"/>    
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
                <input name="long_tempImg" type="hidden" value="" id="long_tempImg"/>    
                <div id="loading2" style="display: none"><i class="fa fa-cog fa-spin fa-2x fa-fw"></i> Loading..</div>
                <img style="display: none" src="" id="template_img_long" style="width:130px;">
                <div id="long_tmplt"></div>
                <img style="display: none" src="" id="long_template_img" style="width:130px;">

            </div>
        </div>
    </center>
</div>


<div class="col-md-6">
    <div class="form-group">
        <label for="usr" class="addpost_lbl">Number of Digit</label>
        <select class="form-control" name="txtno_digs" id="txtno_digs">
            <option value="">--Select--</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <label id="err_txtno_digs" class="txt_errors">Please Select No. of Digits</label>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="usr" class="addpost_lbl">Number</label>
        <input type="text" name="txtnumber" id="txtno" class="form-control">
        <label id="err_txtno" class="txt_errors">Enter Number</label>
    </div>
</div>

<div class="col-md-12"></div>
<div class="col-md-6">
    <div class="form-group">
        <label for="price" class="addpost_lbl">Price</label><br>
        <span><input type="checkbox" name="price" id="chkbox_callpr1"  class="form-control chkbox_callpr1"></span><span class="call_for_pricel" >Call for Price</span>

    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="price" class="addpost_lbl">Add Price</label>
        <input type="text"  onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="txtprice"  id="txtprice" class="form-control" >
        <label id="err_txtprice" class="txt_errors">Enter Price</label>
    </div>
</div>
<div class="col-md-12">
    <label for="usr" class="addpost_lbl">Details</label>
    <textarea id="txtdetails" name="txtdetails"  class="form-control"></textarea>
    <label id="err_txtdetails" class="txt_errors">Enter Details</label>
</div>
    

<script>

    $(document).ready(function () {
        $('#chkbox_callpr1').click(function () {
            if ($('#chkbox_callpr1').is(':checked'))
            {
                $('#txtprice').attr("disabled", "disabled");
                $("#txtprice").val('')

            } else
            {
                $('#txtprice').removeAttr("disabled");

            }
        });
        $('#txtemirates').change(function () {
            
            $('#emirates_name').val($("#txtemirates option:selected").text());
            $('#template_img').hide();
            $('#loading2').show('fast');
            var emirates = $(this).val();
             var type = $('#vehicle_typep').val();
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
                   
                }

            });
        });
        $('#txtemirates').change(function () {
            $('#template_img').hide();
            $('#loading2').show('fast');
            var emirates = $(this).val();


            $.ajax({
                url: "<?php echo base_url('Trader/fetch_temp_code'); ?>",
                data: {'emirates': emirates},

                 type: "POST",
                dataType: 'json',
                success: function (data) { $('#loading2').hide();
               
                   
                    $('#txtcode').empty();

                    $.each(data,function(id,city)
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
        $('#txtno').keyup(function () {
                var count       = this.value.length;
                var max         = $('#txtno_digs').val();
                if(count == max){
                    var emrId       = $('#txtemirates').val();
                    $('#err_txtno').css('display', 'none');
                    var code        = $('#txtcode').val();
                    var srcimg      = $('#template_img').attr('src');

                    var srcimg_long = $('#long_template_img').attr('src');
                    var tarr        = srcimg.split('/');
                    var file_name   = tarr[tarr.length - 1];
                    var temp        = $('#tempImg').val();

                    var tarr        = srcimg_long.split('/');
                    var file_name_long   = tarr[tarr.length - 1];

                    var np_no       = $('#txtno').val();
                    var res         = code + " " + np_no;
                    var type = $('#vehicle_typep').val();
                    $('#tem_name').html(res);

                    $('#template_img').hide();
                    $('#loading2').show('fast');

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
        });


        $('#txtemirates').change(function () {
            $('#err_txtemirates').css('display', 'none');
        });
        /*$('#txtcategorya').change(function(){
         $('#err_txtcat').css('display','none'); 
         });*/
        $('#txtcode').change(function () {
            $('#err_txtcode').css('display', 'none');
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
;
        $('#btnsavepost').click(function (e) {
           
             e.preventDefault();
            var txtemirates     = $('#txtemirates').val();
            var txtcode         = $('#txtcode').val();
            var txtno_digs      = $('#txtno_digs').val();
            var txtno           = $('#txtno').val();

            var txtprice        = $('#txtprice').val();
            var txtdetails      = $('#txtdetails').val();


            var isTrader= <?php echo isset($_SESSION['logged_in']['txtusertype'])?$_SESSION['logged_in']['txtusertype']:0; ?>;
    if(isTrader){
 
                    $.ajax({
                    url: "<?php echo base_url('Trader/trader_check_addpost'); ?>",

                    type: "POST",
                    success: function (data) {

                        if(data!=0){
                            add_post_response(data); 
                
                        }else{
            
                      
                        if ((txtemirates == '') || (txtcode == '') || (txtno_digs == '') || (txtno == '') ||  (txtdetails == ''))
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
            
               
                    
            
                          //  $('#btnsavepost').prop('disabled',true);
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
                    }


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
            $('#vehicle_typep').change(function () {
              var type = $(this).val();
              $('#txtno').val('');
              $('#short_tmplt').html('');
              $('#long_tmplt').html(''); 
             var html = '<option value="">Please Select Emirates</option>';
             if(type==0){
                html +=  ' <option value="1">Dubai</option>\
                            <option value="2">Umm Al Quwain</option>\
                            <option value="3">Ajman</option>\
                            <option value="4">Ras al Khaima</option>\
                            <option value="5">Fujairah</option>\
                            <option value="6">Abu Dhabi</option>\
                            <option value="7">Sharjah</option>';
             }else if(type==1){
                 html +=  ' <option value="8">Dubai</option>\
                            <option value="9">Umm Al Quwain</option>\
                            <option value="10">Ajman</option>\
                            <option value="11">Ras al Khaima</option>\
                            <option value="12">Fujairah</option>\
                            <option value="13">Abu Dhabi</option>\
                            <option value="14">Sharjah</option>';
             }
             $('#txtemirates').html(html);

        });

    });



</script>

</div>
