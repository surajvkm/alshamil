<div class="col-6" style='float:none;display:inline-block;'  >
    <div class="form-group">
        <label for="usr" class="addpost_lbl">Operator</label><br>
        <button class="btn btn-default btnmn moboper btn_etisalat_admin ets-btn" id="btn_etisalat_admin" style="background:#5b8316;">Etisalat</button>
        <button class="btn btn-default btnmn moboper img_du_admin ets-btn" id="img_du_admin" style="background:#009fce;">DU</button>
        <button class="btn btn-default btnmn moboper btn_other_admin ets-btn" id="btn_other_admin" style="background:#999;">Other</button>
        <input type="hidden" name="operator" id="operator"/>
        <label id="err_operator" class="txt_errors">Enter Operator</label>
    </div>
</div>

<div class="row mt-3">
<div class="col-12">
    <center>
        <div class="form-group">
            <div class="show-plate mobile-plate">
                <input name="temp" type="hidden" value="" id="tempImg"/>    
                <div id="loading2" style="display: none"><i class="fa fa-cog fa-spin fa-2x fa-fw"></i> Loading..</div>
                <img style="display: none" src="" id="template_img" style="width:130px;">
                <img src="" id="newImg" style="width:130px;">
                <img  id="genImg" style="width:130px;display:none;">

            </div>
        </div>
    </center>
</div>
</div>
<div class="row mt-3">
<!-- --- Model --- -->
<div class="col-6">
<div class="form-group">    
<label for="usr" class="addpost_lbl" >Prefix</label>
        <select class="form-control" id="txtmainprefix" name="txtmainprefix">
           <option value="">--Select--</option>
        </select>
        <label id="err_prefix" class="txt_errors">Enter prefix</label>
    </div>
</div>

<div class="col-6">
   <div class="form-group">
        <label for="usr" class="addpost_lbl" >Mobile Number</label>
        <input type="text" pattern=".{5,13}" required title="Enter 5 to 13 characters" name="txtmob" class="form-control input-custom" id="txtmobb" required >
        <label id="err_txtmob" class="txt_errors">Enter Number</label>
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
                $("#txt_cprice").val('');

            } else
            {
                $('#txt_cprice').removeAttr("disabled");

            }
        });
    
       $('.moboper').click(function(e){
           $('#btn_etisalat_admin').css('border','1px solid #d3dcdc'); 
            $('#img_du_admin').css('border','1px solid #d3dcdc'); 
            $('#btn_other_admin').css('border','1px solid #d3dcdc'); 
            $(this).css('border','2px solid #f5821f');
             
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
                    $('#newImg').css('display', 'block');
                        $('#genImg').css('display', 'none');
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
       // $('#txtmobb').keydown(function(e){-1!==$.inArray(e.keyCode,[46,8,9,27,13,110,190])||(/65|67|86|88/.test(e.keyCode)&&(e.ctrlKey===true||e.metaKey===true))&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()});
    
            $("#txtmobb").keydown(function (e) {
                var max_chars =10;
        // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    // Allow: Ctrl+A, Command+A
                    (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
                    // Allow: home, end, left, right, down, up
                    (e.keyCode >= 35 && e.keyCode <= 40)) {
           
                 // let it happen, don't do anything
                 return;
        }else{
            
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
         
            e.preventDefault();
        }else{
            if ($(this).val().length >= max_chars) { 
                        e.preventDefault();
                        swal('5 - 10 charecters  are allowed','','error');
            }
        }
    
              
    });
           $('#txtmobb').blur(function () {
           	
             	var operator = $('#operator').val();
           	    if(operator!=''){
					
				
                var min_chars =5;
                if ($(this).val().length < min_chars) { 
               
                swal('5 - 10 charecters  are allowed','','error');
                }
                
                var mobno = $(this).val();
                var prefix = $('#txtmainprefix').val();
                var srcimg      = $('#template_img').attr('src');
                var res         = prefix + " " + mobno;
                //alert(srcimg+"-"+temp);return false;
                $('#template_img').hide();
                $('#loading2').show('fast');
                $.ajax({
                    url: "<?php echo base_url('admin/Dashboard/generate_mob_temp'); ?>",
                    data: {'res': res, 'srcimg': srcimg,'operator': operator},
                    type: "POST",

                    success: function (data) { 
                        console.log(data);
                       $('#newImg').css('display', 'none');
                        $('#genImg').css('display', 'block');
                        $('#genImg').attr('src', data);
                        $('#loading2').hide();
                        $('#tempImg').val(data);

                    }
                });
			}else{
				swal('Select a Operator','','error');
			}
        });
        $('#btn_etisalat_admin').click(function (e) {
         
             e.preventDefault();
            var imgSrc = '<?php echo base_url()?>img/mobno/base_images/Mobile-etisalath.png';
            $('#template_img').attr('src', imgSrc);
            $('#newImg').attr('src', imgSrc); 
        });
        $('#img_du_admin').click(function (e) {
            e.preventDefault();
            var imgSrc = '<?php echo base_url()?>img/mobno/base_images/Mobile-Du.png';
            $('#template_img').attr('src', imgSrc);
            $('#newImg').attr('src', imgSrc); 
        });
       
        $('#btn_other_admin').click(function (e) {
             e.preventDefault();
             var imgSrc = '<?php echo base_url()?>img/mobno/base_images/Other-Phone.png';
            $('#template_img').attr('src', imgSrc);
            $('#newImg').attr('src', imgSrc); 
           
        });
        $("#drop_zone1").change(function () {
            var v = $(this).val();
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

        $('#txtplace').change(function () {
            $('#err_txtplace').css('display', 'none');
        });
        $('#txtcategorya').change(function () {
            $('#err_txtcat').css('display', 'none');
        });
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

        $('#btnsavepost').click(function (e) {             e.preventDefault();
         
            
            var txtmob = $('#txtmobb').val();
            var txtprice = $('#txt_cprice').val();
            var txtdetails = $('#txtdetails').val();
            var setprice;
           

           if ($('#chkbox_callpr1').is(':checked'))
           {
            
               setprice=1;

           } else if(txtprice!=='')
           {
               setprice=1;
           }
            if ( (txtmob == '')  || (txtdetails == '')||(setprice!=1))
            {
                
                
                if (txtmob == '')
                {

                    $('#err_txtmob').css('display', 'block');

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
              
            } else
            
            {
               
             $('#btnsavepost').prop('disabled',true);
               $('#loading').show();
               $("#myForm").submit();
    //             var form = $('#myForm')[0];
    //             var formData = new FormData(form);
               
    //             $.ajax({
                   
    //                 url: "<?php echo base_url('admin/Dashboard/save_mnaddpost'); ?>",
    //                 data: formData,
    //                 contentType: false,
    //                 cache: false,
    //                 processData: false,
    //                 type: "POST",

    //                  success: function (data) {
    //                     swal("Your Product Added Successfully");
    //                     $('#loading').hide();
                        
    //                    $("#postForm").submit();
                 
                            
    // }


    //             });
            }
        });
        var maxField = 5; //Input fields increment limitation
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

    });
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



</script>
