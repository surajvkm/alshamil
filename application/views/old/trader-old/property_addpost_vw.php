
                                <div class="col-sm-6" >
                                    <div class="form-group">
                                        <label for="usr" class="addpost_lbl">Sub Category</label>
                                       
                                        <select class="form-control reginputs" name="txtsubcat" id="txtsubcat">
                                            <option value="">--Select--</option>
                                            <option value="test1">test1</option>
                                            <option value="test2">test2</option>
                                             <option value="test3">test3</option>
                                           
                                        </select>
                                        <label id="err_txtsubcat" class="txt_errors">Please Select Your Sub Category</label>
                                    </div>
                                </div>
                                <div class="col-sm-6" id="property_col">
                                    <div class="form-group">
                                        <label for="usr" class="addpost_lbl">Property</label>
                                        <select class="form-control reginputs" name="txtprop" id="txtprop">
                                            <option value="">--Select--</option>
                                           <option value="prop1">prop1</option>
                                            <option value="prop2">prop2</option>
                                             <option value="prop3">prop3</option>
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
                                        <input type="text" name="txtprice"  id="txtpropprice" class="form-control reginputs" value="">
                                        <label id="err_txtpropprice" class="txt_errors">Enter Price</label>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-sm-6" >
                                    <label for="usr" class="addpost_lbl">Details</label>
                                    <textarea id="txtdetails" name="txtdetails"  class="form-control reginputs"></textarea>
                                    <label id="err_txtpropdetails" class="txt_errors">Enter Details</label>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-sm-12" >
                                    
                                        <label for="usr" class="addpost_lbl" id="lblauvid">Add Video & Photos</label>
                                   <div class="form-group">
                                    <div class="col-md-4">
                                        <div class="dropZoneContainer" id="drop_video">
                                            <input type="file" id="drop_zone1" name="productVideo" class="FileUpload" required=""/>
                                            <input type="hidden" id="hid_cvideo">
                                            <div class="dropZoneOverlay">
                                                <img id="vid_icon" src="<?php echo base_url() ?>img/add-post-add-video.png">

                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                                <button id="btn_addmore" class="add_button">Add More 5 Photos</button>
                                               
                                            </div>
                                        </div>
                                             </div>
                                        </div>
                                        
                                        
                                    
                                     </div>
                                </div>
                            <div class="row">
                                   
                                <label id="err_txtaudio" class="txt_errors">Please Upload a Image</label>  
                            </div>
                                
                            <div class="row">
                                <div class="col-sm-12" >
                                    
                                         <div class="field_wrapper"></div>
                                        
                                        
                                        
                                        
                                        
                                    
                                     </div>
                                </div>
                                
                      

   
        <script>
            $(document).ready(function(){
                var maxField = 5; //Input fields increment limitation
                var addButton = $('.add_button'); //Add button selector
                var wrapper = $('.field_wrapper'); //Input field wrapper
                 var fieldHTML = '<div class="dropZoneContainer" id="more_drop_camera" style="width: 107px;position: relative;left: 15px;">'
                + '<input type="file" id="car_img" name="productVideo" class="FileUpload" required=""/>'
                + '<div class="dropZoneOverlay" style="width:100px;height:80px;padding-top:17px;padding-left:25px;">'
                + '<img id="audi_icon" src="<?php echo base_url() ?>img/add-post-add-pic.png">'
                + '</div>'
                + '<a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="fa fa-minus-circle rm_icon"  aria-hidden="true"></i></a>'
                + '<input type="file"  name="txtfiles[]"  class="FileUpload1" style="opacity: 0.0; position: absolute; top: 0; left: 0; bottom: 0; right: 0; " />';
                +'<br>';
                var x = 1; //Initial field counter is 1
                $(addButton).click(function(){ //Once add button is clicked
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
                $('#chkbox_callpr1').click(function () 
                {

                    if ($('#chkbox_callpr1').is(':checked'))
                    {
                        $('#txtpropprice').attr("disabled", "disabled");

                    } else
                    {
                        $('#txtpropprice').removeAttr("disabled");

                    }
                });
                $('#btnpostclr').click(function(){
                    $('input').val('');
                    $('textarea').val('');
                    $("select").prop('selectedIndex', 0);
                });
             
               $('#btnpropadpost').click(function () {
                        var res = $('#chkbox_callpr1').is(':checked');
                        var txtprice = $('#txt_propprice').val();

                        if ($('#chkbox_callpr1').is(':checked'))
                        {

                            var call_for_price = 1;

                        } else
                        {

                            var call_for_price = 0;

                        }
                        var txtcat = $('#txtcategorya').val();

                        var txtsubcat = $('#txtsubcat').val();
                        var txtprop = $('#txtprop').val();

                       
                        var txtprice = $('#txtpropprice').val();
                        var txtdetails = $('#txtdetails').val();
                        var txtvideo = $('#hid_cvideo').val();
                        var txtaudio = $('#txt_hidaudio').val();

                        if ((txtcat == '') || (txtsubcat == '') || (txtprop == '') || (txtdetails == '') || (txtaudio == ''))
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

                                $('#err_txtpropprice').css('display', 'none');

                            } else
                            {
                                if (txtprice == '')
                                {
                                    $('#err_txtpropprice').css('display', 'block');
                                }


                            }

                            if (txtdetails == '')
                            {

                                $('#err_txtpropdetails').css('display', 'block');

                            }

                            if (txtaudio == '')
                            {
                                $('#err_txtaudio').css('display', 'block');

                            }

                        } 
                        else
                        {
                            
                             var form = $('#myForm')[0];
                             var formData = new FormData(form);

                            $.ajax({
                                url: "<?php echo base_url('Trader/save_proppost'); ?>",

                                data:formData,
                                contentType: false,
                                cache: false,
                                processData: false,
                                type: "POST",

                                success: function (data) {
                                    console.log(data);return false;
                                    if(data == 'success')
                                    {
                                        swal("Property Post Details added successfully");
                                    }
                                    //console.log(data);
                                    //$('#post_content').html(data);
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


            });
            
        </script>

