

    
 <!-- start section -->
 <?php echo $this->session->flashdata('msg'); ?>
<!-- <form  action="<?php echo base_url();?>Trader/add_post" method="post" novalidate="" enctype="multipart/form-data">-->
      <!--form  onsubmit="return false;" id="myForm" method="post" novalidate="" enctype="multipart/form-data"-->


                                
                                <div class="col-sm-6" id="txthidbrand">
                                    <div class="form-group">
                                        <label for="usr" class="addpost_lbl">Brand</label>
                                       
                                        <select class="form-control reginputs" name="txtbrand" id="txtbrand" onchange="fetch_model(this.value)">
                                            <option value="">--Select--</option>
                                             <?php
                                            foreach ($query as $brand)
                                                {
                                                ?>
                                                    <option value="<?php echo $brand->brandID ?>"><?php echo $brand->brandName ?></option>
                                                    <?php
                                                }
                                                ?>

                                        </select>
                                        <label id="err_txtbrand" class="txt_errors">Please Select Your Brand</label>
                                   </div>
                                </div>

                           
                           
                                                <div class="row">
                                <div class="col-sm-6" >
                                    <div class="form-group">
                                        <label for="usr" class="addpost_lbl">Model</label>
                                       <select class="form-control reginputs" name="txtmodel" id="srchcat3">
                                             <option value="">--Select--</option>
                                        </select>
                                        <label id="err_txtmodel" class="txt_errors">Please Select Your Model</label>
                                    </div>
                                </div>
                                <div class="col-sm-6" >
                                    <div class="form-group">
                                         <label for="price" class="addpost_lbl">Price</label>
                                        <input type="checkbox" name="call_for_price" id="chkbox_callpr1"  class="form-control reginputs"><span id="call_for_price7" >Call for Price</span>
<!--                                          <label id="err_txtprice" class="txt_errors">Enter Price</label>-->
                                   </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-6" >
                                    <div class="form-group">
                                        <label for="price" class="addpost_lbl">Add Price</label>
                                        <input type="text" name="txtprice"  id="txt_vprice" class="form-control reginputs" >
                                          <label id="err_txtvprice" class="txt_errors">Enter Price</label>

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
                                <div class="col-sm-12" >
                                    
                                        <label for="usr" class="addpost_lbl" id="lblauvid">Add Video & Photos</label>
                                        <div class="form-group">
                                            <div class="col-md-4">
                                               
                                                <div class="dropZoneContainer" id="drop_video">
                                                    <input type="file" id="drop_zone1" name="productVideo" class="FileUpload" required=""/>
                                                    <input type="hidden" id="txt_hidvideo">
                                                    <div class="dropZoneOverlay">
                                                        <img id="vid_icon" src="<?php echo base_url()?>img/add-post-add-video.png">
<!--                                                        <i class="fa fa-video-camera" id="vid_icon" aria-hidden="true"></i>-->
                                                        
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
<!--                                             <label id="video_err">Please Upload a Video</label> -->
                                        <div class="form-group">
                                             <div class="col-md-4">
                                            <div class="dropZoneContainer" id="drop_camera">
                                                <input type="file" id="car_img" name="txtimage" class="FileUpload" accept=".jpg,.png,.gif"  />
                                                <input type="hidden" id="txt_hidaudio">
                                                <div class="dropZoneOverlay">
                                                    <img id="audi_icon" src="<?php echo base_url() ?>img/add-post-add-pic.png">

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
                                  
                                    <label id="err_txtaudio" class="txt_errors">Please Upload a Image</label>
                                </div>
<!--                                <div class="row">
                                    <img src="<?php echo base_url();?>img/no_preview.png" id="audio_prev">
                                </div>-->
                                

                            <div class="row">
                                <div class="col-sm-12" >
                                    
                                         <div class="field_wrapper"></div>
                                        
                                        
                                        
                                        
                                        
                                    
                                     </div>
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
                        $('#audio_prev').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
    }
            $(document).ready(function(){
                $('#chkbox_callpr1').click(function(){
                    
                    if($('#chkbox_callpr1').is(':checked'))
                    {
                        $('#txt_vprice').attr("disabled","disabled");
                        
                    }
                    else
                    {
                        $('#txt_vprice').removeAttr("disabled");
                        
                    }
                });
                    
                    
                $("#drop_zone1").change(function(){
                    var v =  $(this).val();
                   // alert(v);return false;
                    $('#txt_hidvideo').val(v);
                    readURL(this);
                    $('#err_txtvideo').css('display','none');
                    var fileExtension = ['mp4', 'mp3'];
                    
                    if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                        alert("Only formats are allowed : "+fileExtension.join(', '));
                    }
                    
                    var totalBytes = this.files[0].size;
                    if(totalBytes > 64000000)
                    {
                      alert("File Size cannot exceeds 64 MB");
                    }
                    
                });
                $("#drop_zone2").change(function(){
                    
                    var v =  $(this).val();
                    //alert(v);return false;
                    
                    
  
                    $('#txt_hidaudio').val(v);
                    readaudioURL(this);
                    $('#err_txtaudio').css('display','none');
                    var imgExtension = ['jpeg','jpg','png','gif'];
                    if ($.inArray($(this).val().split('.').pop().toLowerCase(), imgExtension) == -1) {
                        alert("Only formats are allowed : "+imgExtension.join(', '));
                    }
                    var totalBytes = this.files[0].size;
                    if(totalBytes > 128000000)
                    {
                      alert("File Size cannot exceeds 128 MB");
                    }
                });
                
                $('#txtplace').change(function(){
                    $('#err_txtplace').css('display','none'); 
                });
                $('#txtcategorya').change(function(){
                    $('#err_txtcat').css('display','none'); 
                });
                $('#txtbrand').change(function(){
                    $('#err_txtbrand').css('display','none'); 
                });
                $('#txtmodel').change(function(){
                    $('#err_txtmodel').css('display','none'); 
                });
                $('#txtyear').change(function(){
                    $('#err_txtyear').css('display','none'); 
                });
                $('#txtprice').keyup(function(){
                    $('#err_txtprice').css('display','none'); 
                });
                $('#txtdetails').keyup(function(){
                    $('#err_txtdetails').css('display','none'); 
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
                $('#btnphoneadpost').click(function () {
                   
            var res = $('#chkbox_callpr1').is(':checked');
            var txtprice = $('#txt_vprice').val();

            if ($('#chkbox_callpr1').is(':checked'))
            {

                var call_for_price = 1;

            } else
            {

                var call_for_price = 0;

            }
            var txtcat = $('#txtcategorya').val();
            
            var txtbrand = $('#txtbrand').val();
            var txtmodel = $('#srchcat3').val();
            
           
            var txtprice = $('#txt_vprice').val();
            var txtdetails = $('#txtdetails').val();
            var txtvideo = $('#hid_cvideo').val();
            var txtaudio = $('#txt_hidaudio').val();

            if ((txtcat == '') || (txtbrand == '') || (txtmodel == '') || (txtdetails == '') || (txtaudio == ''))
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
                 var form = $('#myForm')[0];
                 var formData = new FormData(form);
                    
                $.ajax({
                    url: "<?php echo base_url('Trader/save_phonepost'); ?>",
                    
                    data:formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    type: "POST",
                    
                    success: function (data) {
                        if(data == 'success')
                        {
                            swal("Phone Post Details added successfully");
                        }
                       
                    }

                });
            }


        });
                var maxField = 5; //Input fields increment limitation
                var addButton = $('.add_button'); //Add button selector
                var wrapper = $('.field_wrapper'); //Input field wrapper
                var fieldHTML = '<div class="dropZoneContainer" id="more_drop_camera" style="width: 107px;position: relative;left: 15px;">'
                  +'<input type="file" id="car_img" name="productVideo" class="FileUpload" required=""/>'
                   +'<div class="dropZoneOverlay" style="width:100px;height:80px;padding-top:17px;padding-left:25px;">'
                   +'<img id="audi_icon" src="<?php echo base_url() ?>img/add-post-add-pic.png">'
		  +'</div>'
                  +'<a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="fa fa-minus-circle rm_icon"  aria-hidden="true"></i></a>'
                + '<input type="file"  name="txtfiles[]" class="FileUpload" style="opacity: 0.0; position: absolute; top: 0; left: 0; bottom: 0; right: 0; " />';
                  +'<br>';
                var x = 1; //Initial field counter is 1
                $(addButton).click(function(){ //Once add button is clicked
                   // alert("123");return false;
                    if(x < maxField){ //Check maximum number of input fields
                        x++; //Increment field counter
                        $(wrapper).append(fieldHTML); // Add field html
                    }
                    else
                    {
                        swal("You cannot upload more than 5 photos");
                    }
                });
                $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
                    e.preventDefault();
                    $(this).parent('div').remove(); //Remove field html
                    
                    x--; //Decrement field counter
                });
                $('#btnpostclr').click(function(){
                    $('input').val('');
                    $('textarea').val('');
                    $("select").prop('selectedIndex', 0);
                });
               var selected = localStorage.getItem('selected');
                if (selected) {
                  $(".catsel").val(selected);
                }
                 $('#txtcategorya').change(function(){
                     //$('#txthidbrand').css('display','none');
                     var category=$(this).val();
                    if(category == '1')
                    {
                        $("#first").css('display','none');
                        $("#second").load("<?php echo base_url().'Trader/car_view/1'; ?>");
                        
                    }
                    if(category == '2')
                    {
                        //alert("123");return false;
                        $("#first").css('display','none');
                        $("#second").load("<?php echo base_url().'Trader/bike_view/2'; ?>");
                        
                    } 
                 });
            });
            function fetch_model(brand)
           {
               //var brand = $("#txtbrand").val();
               $('#err_txtcarbrand').css('display','none'); 
                 var data = 'brand='+brand;
               if (brand != "") { 
                         $.ajax({
                            type: "POST",
                            dataType: 'json',
                            data:data,
                            
                            url: "<?php echo base_url('Trader/fetch_bikemodel'); ?>" ,
                            success: function (data) {
                                //console.log(data);return false;
                                 $('#srchcat3').empty();

                    $.each(data,function(id,city)
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

 </div>
<div id="carbike_div"></div>
<div id="mob_div"></div>
<div id="verwb_div"></div>
<div id="noplate_div"></div>
<div id="prop_div"></div>