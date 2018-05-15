<div class="col-6" style='float:none;display:inline-block;'  >
    <div class="form-group"> <label for="usr" class="addpost_lbl">Vehicle</label>
        <select class="form-control input-custom" id="vehicle_typep" name="vehicle_type">
           <option value="">Select Vehicle Type</option>
           <option value="0">Car</option>
           <option value="1">Bike</option>
        </select>
    </div>
</div>
<div class="row mt-3">
    <div class="col-6" id="txthidbrand">
    <div class="form-group">
        <label for="usr" class="addpost_lbl">Emirates</label>

        <select class="form-control  input-custom fontsize-12" id="txtemirates" style="width: 177px;" name="txtemirates">
            <option value="">Please Select Emirates</option>
            <?php
            foreach ($template_qry as $r) {
                ?>
                <option value="<?php echo $r->noplateTempID ?>"><?php echo $r->emirates ?></option>
                <?php
            }
            ?>


        </select>
        <label id="err_txtemirates" class="txt_errors">Please Select Emirates</label>
    </div>
</div>
 <div id="codeDiv" class="col-6" >
        <div class="form-group">
            <label for="usr" class="addpost_lbl">Code<!-- <p id="testp"></p> --></label>
            <select class="form-control  input-custom" name="txtcode" id="txtcode">
                <option value="">--Select--</option>
               
            </select>
            <label id="err_txtcode" class="txt_errors">Please Select Code</label>
        </div>
    </div>

</div>
<div class="row mt-3" id="em_row">

    <div class="col-lg-5 col-md-5 col-5 ml-lg-3 ml-md-3 ml-3" id="template_coldiv" >
        <div class="form-group">
            <div class="row show-plate">
                <input name="short_tempImg" type="hidden" value="" id="short_tempImg"/>    
                <div id="loading1" style="display: none"><i class="fa fa-cog fa-spin fa-2x fa-fw"></i> Loading..</div>
                <div id="short_tmplt"></div>
                <img style="display: none" src="" id="template_img" style="width:130px;">
                <input type="hidden" id="num_short" name="num_front">
            </div>
        </div>
    </div>

       <div class="col-lg-5 col-md-5 col-5 ml-lg-5 ml-md-5 ml-4 ml-sm-5" id="template_coldiv" >
        <div class="form-group">
            <div class="row show-plate pl-lg-3">
                <input name="long_tempImg" type="hidden" value="" id="long_tempImg"/>    
                <div id="loading1" style="display: none"><i class="fa fa-cog fa-spin fa-2x fa-fw"></i> Loading..</div>
                <div id="long_tmplt"></div>
                <img style="display: none" src="" id="long_template_img" style="width:130px;">
                <input type="hidden" id="num_long" name="num_front">
            </div>
        </div>
    </div>
</div>
<div class="row mt-3">
<!-- --- Price --- -->
<div class="col-6">
<div class="form-group ">

        <label for="usr" class="addpost_lbl">Number of Digit</label>
        <select class="form-control input-custom" name="txtno_digs" id="txtno_digs">
            <option value="">--Select--</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
</div>
</div>
<!-- --- Add price --- -->
<div class="col-6">
  <div class="form-group">
            <label for="usr" class="addpost_lbl">Number</label>
            <input type="text" name="txtnumber" id="txtno" class="form-control input-custom">

            <label id="err_txtno" class="txt_errors">Enter Number</label>
        </div>
</div>
</div>

<div class="row mt-3">
<!-- --- Price --- -->
<div class="col-6">
<div class="form-group pb-lg-2 bb1">
<label class="text-s12 text-semibold" for="">Price</label>
<div class="custom-control custom-checkbox ml-lg-3">

    <input type="checkbox"  class="custom-control-input" name="call_for_price" id="chkbox_callpr1">
    <label class="custom-control-label" for="chkbox_callpr1">Call for Price</label>
</div>
</div>
</div>
<!-- --- Add price --- -->
<div class="col-6">
<div class="form-group">
<label class="text-s12 text-semibold" for="">Add price</label>
<input type="text" name="txtprice"  id="txt_cprice" class="form-control input-custom" >
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




<!-- start section -->




<script>

    $(document).ready(function () {
        $('#chkbox_callpr1').click(function () {
            if ($('#chkbox_callpr1').is(':checked'))
            {
                $('#txt_cprice').attr("disabled", "disabled");
                $("#txt_cprice").val('');

            } else
            {
                $('#txt_cprice').removeAttr("disabled");

            }
        });
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
        $('#txtemirates').change(function () {
            $('#template_img').hide();
            $('#loading2').show('fast');
            var emirates = $(this).val();

             var type = $('#vehicle_typep').val();
            if(type==1 && emirates!=8){
                $('#codeDiv').hide();
            }else{
                 $('#codeDiv').show();
            }
            $('#txtno').val('');
            $.ajax({
                url: "<?php echo base_url('admin/Dashboard/fetch_temp_img'); ?>",
                data: {'emirates': emirates,'type':type},

                type: "POST",
                dataType: 'json',
                success: function (data) {
                
                    
                    $('#short_tmplt').html('<img id="newImg" src="'+data.templates+'" id="" style="width:130px;">');
                    $('#template_img').attr('src', data.templates);

                    // $('#newImg').append('<img style="display: none" src="'+data.templates+'" id="template_img" style="width:130px;">');

                    $('#long_tmplt').html('<img id="long_newImg" src="'+data.long_template+'" id="" style="width:130px;">');
                     $('#long_template_img').attr('src', data.long_template);
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
               
                   
                   // $('#txtcode').empty();

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
        $('#txtcode').change(function () {
        
            $('#template_img').hide();
            $('#loading2').show('fast');
            var emirates = $('#txtemirates').val();
            var type = $('#vehicle_typep').val();
            var max         = $('#txtno_digs').val();
                generate_no_plate(max,max);
            // $.ajax({
            //     url: "<?php echo base_url('admin/Dashboard/fetch_temp_img'); ?>",
            //     data: {'emirates': emirates,'type':type},

            //     type: "POST",
            //     dataType: 'json',
            //     success: function (data) {
      
                    
            //         $('#short_tmplt').html('<img id="newImg" src="'+data.templates+'" id="" style="width:130px;">');
            //         $('#template_img').attr('src', data.templates);

            //         // $('#newImg').append('<img style="display: none" src="'+data.templates+'" id="template_img" style="width:130px;">');

            //         $('#long_tmplt').html('<img id="long_newImg" src="'+data.long_template+'" id="" style="width:130px;">');
            //          $('#long_template_img').attr('src', data.long_template);
            //          $('#loading2').hide();
                   
            //     }

            // });
        });
   
        $('#txtno_digs').change(function () {
            var limit = $(this).val();
            $('input#txtno').val('');
            $('input#txtno').attr('maxlength', limit); 
        });
          var generateNumberPlate =  $('#txtno').keyup(function () {
                var count       = this.value.length;
                var max         = $('#txtno_digs').val();
                generate_no_plate(count,max);
        });

function generate_no_plate(count,max){
    if(count == max){
                    var emrId       = $('#txtemirates').val();
                    $('#err_txtno').css('display', 'none');
                    var type = $('#vehicle_typep').val();
                    if(type==1 && emrId!=8){
                       var code        = '';
                    }else{
                        var code       = $('#txtcode').val();
                    }
                    
                    var srcimg      = $('#template_img').attr('src');
                    var srcimg_long = $('#long_template_img').attr('src');
                    var tarr        = srcimg.split('/');
                    var file_name   = tarr[tarr.length - 1];

                    var tarr        = srcimg_long.split('/');
                    var file_name_long   = tarr[tarr.length - 1];
                    var temp        = $('#short_tempImg').val();

                    var np_no       = $('#txtno').val();
                    var res         = code + " " + np_no;
                    $('#tem_name').html(res);

                    //$('#template_img').hide();
                    $('#loading1').show('fast');
                    var type = $('#vehicle_typep').val();
                    if(type==0){
                            $.ajax({
                            url: "<?php echo base_url('admin/Dashboard/generate_nopl_temp'); ?>",
                            data: {'res': res, 'srcimg': file_name, 'emrId': emrId, 'short_tempImg': temp,'srcimg_long':file_name_long},
                            type: "POST",
                            dataType: 'json',
                            success: function (data) { 
                                 $('#short_tmplt').html('<img id="newImg" src="'+data.short+'" id="" style="width:130px;">');
                                 $('#num_short').val( data.short);
                                 $('#short_tempImg').val( data.short);
                           
                            $('#long_tmplt').html('<img id="long_newImg" src="'+data.long+'" id="" style="width:130px;">');
                            $('#num_long').val( data.long);
                            $('#long_tempImg').val( data.long);
                                //$('#newImg').attr('src', data);
                                $('#loading1').hide();
                                //$('#tempImg').val(data);
                               
                            }
                        });
                    }else{
                            $.ajax({
                            url: "<?php echo base_url('admin/Dashboard/generate_nopl_temp_bike'); ?>",
                            data: {'res': res, 'srcimg': file_name, 'emrId': emrId, 'short_tempImg': temp,'srcimg_long':file_name_long},
                            type: "POST",
                            dataType: 'json',
                            success: function (data) { 

                                $('#short_tmplt').html('<img id="newImg" src="'+data.short+'" id="" style="width:130px;">');
                                $('#num_short').val( data.short);
                                $('#short_tempImg').val( data.short);


                                $('#long_tmplt').html('<img id="long_newImg" src="'+data.long+'" id="" style="width:130px;">');
                                $('#num_long').val( data.long);
                                $('#long_tempImg').val( data.long);
                                //$('#newImg').attr('src', data);
                                $('#loading1').hide();
                                //$('#tempImg').val(data);
                               
                            }
                        });
                    }
                    
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
        });
        $('#txtno_digs').change(function () {
            $('#err_txtno_digs').css('display', 'none');
        });

        $('#txt_cprice').keyup(function () {
            $('#err_txtprice').css('display', 'none');
        });
        $('#txtdetails').keyup(function () {
            $('#err_txtdetails').css('display', 'none');
        });

        $('#btnsavepost').click(function (e) {
            e.preventDefault();
            var txtemirates     = $('#txtemirates').val();
            var txtcode         = $('#txtcode').val();
            var txtno_digs      = $('#txtno_digs').val();
            var txtno           = $('#txtno').val();

            var txtprice        = $('#txt_cprice').val();
            var txtdetails      = $('#txtdetails').val();
            var setprice;
              if ($('#chkbox_callpr1').is(':checked'))
           {
               setprice=1;

           } else if(txtprice!=='')
           {
               setprice=1;
           }
            if ((txtemirates == '') || (txtcode == '') || (txtno_digs == '') || (txtno == '') ||  (txtdetails == '')||(setprice!=1))
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
                    if (txtprice == '')
                    {
                        $('#err_txtprice').css('display', 'block');
                    }

                }


                if (txtdetails == '')
                {

                    $('#err_txtdetails').css('display', 'block');

                }

                //return false;
            } else
            {
                $('#btnsavepost').prop('disabled',true);
                $('#loading').show();
                $("#myForm").submit();
                // var form = $('#myForm')[0];
                // var formData = new FormData(form);


                // $.ajax({
                //     url: "<?php echo base_url('admin/Dashboard/save_noplatepost'); ?>",

                //     data: formData,
                //     contentType: false,
                //     cache: false,
                //     processData: false,
                //     type: "POST",

                //     success: function (data) {
                //         swal("Your Product Added Successfully");
                //          $('#loading').hide();
                         
                //         $("#postForm").submit();     
                //         }

                // });
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