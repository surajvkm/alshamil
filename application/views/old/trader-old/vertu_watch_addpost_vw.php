<div id="ver_success_msgdiv">
                        Your Product Added Successfully
                    </div>
       <div id="vert_content">

 
                        <div class="container-fluid" >
  
<!--                            <div class="row">
                                <div class="col-sm-6" >
                                    <div class="form-group">
                                        <label for="usr" class="addpost_lbl">City</label>
                                        <select class="form-control reginputs" name="txtplace">
                                            <option value="">--Select--</option>
                                            <?php
                                            foreach($qry as $k)
                                            {
                                                 echo "<option value='$k->country_name' " . set_select('txtplace', $k->country_name) . " >". $k->country_name."</option>";
                                               
                                            
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                               

                            </div>-->
                            <div class="row">
                                <div class="col-sm-6" >
                                    <div class="form-group">
                                        <label for="usr" class="addpost_lbl">Brand</label>
                                       
                                        <select class="form-control reginputs" name="txtbrand" id="txtverbrand" onchange="fetch_model(this.value)">
                                            <option value="">--Select--</option>
                                           <?php
                                    foreach ($query as $brand) {
                                        ?>
                                        <option value="<?php echo $brand->brand ?>"><?php echo $brand->brand ?></option>
                                        <?php
                                    }
                                    ?>

                                        </select>
                                        <label id="err_txtverbrand" class="txt_errors">Please Select Your Brand</label>
                                    </div>
                                </div>
                                <div class="col-sm-6" >
                                    <div class="form-group">
                                        <label for="usr" class="addpost_lbl">Model</label>
                                         <select class="form-control reginputs" name="txtmodel" id="srchcat3">
                                         <option value="">Select</option>

                                 </select>
                                       
                                    <label id="err_txtvermodel" class="txt_errors">Please Select Your Model</label>
                                   </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-6" >
                                    <div class="form-group">
                                        <label for="usr" class="addpost_lbl">Price</label>
                                        <input type="text" name="txtprice"  id="txtverprice" class="form-control reginputs" value="">
                                    <label id="err_txtverprice" class="txt_errors">Enter Price</label>
                                    </div>
                                </div>
                                

                            </div>
                            <div class="row">
                                <div class="col-sm-6" >
                                    <label for="usr" class="addpost_lbl">Details</label>
                                    <textarea id="txtverdetails" name="txtdetails"  class="form-control reginputs"></textarea>
                                    <label id="err_txtverdetails" class="txt_errors">Enter Details</label>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-sm-12" >
                                    
                                        <label for="usr" class="addpost_lbl" id="lblauvid">Add Video & Photos</label>
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <div class="dropZoneContainer" id="drop_video">
                                                    <input type="file" id="drop_zone11" class="FileUpload" accept=".jpg,.png,.gif"  />
                                                     <input type="hidden" id="txt_hidvideo1">
                                                    <div class="dropZoneOverlay"><i class="fa fa-video-camera" id="vid_icon" aria-hidden="true"></i>
                                                        <span class="fa-stack fa-lg" id="spvideo">
                                                        <i class="fa fa-circle fa-stack-1x icon-background11"></i>
                                                       <i class="fa fa-plus fa-stack-1x" id="vdplus" aria-hidden="true"></i>
                                                      </span>
                                                    </div>
                                                </div>
                                                  <!--input type="file" id="video_file"-->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                             <div class="col-md-4">
                                                 <div class="dropZoneContainer" id="drop_camera">
                                                    <input type="file" id="drop_zone21" class="FileUpload" accept=".jpg,.png,.gif"  />
                                                     <input type="hidden" id="txt_hidaudio2">
                                                    <div class="dropZoneOverlay"><i class="fa fa-camera" id="audi_icon" aria-hidden="true"></i>
                                                        <span class="fa-stack fa-lg" id="spaudio">
                                                        <i class="fa fa-circle fa-stack-1x icon-background11"></i>
                                                       <i class="fa fa-plus fa-stack-1x" id="adplus" aria-hidden="true"></i>
                                                      </span>
                                                    </div>
                                                </div>
                                            <!--input type="file" id="photo_file"-->
                                            
                                            </div>
                                        </div>
                                        <div class="form-group">
                                             <div class="col-md-4">
                                            
                                            <div >
                                            <div>
                                                <button id="btn_addmore" class="add_button">Add More 8 Photos</button>
                                                <!--input type="text" name="field_name[]" value=""/-->
                                                <!--a href="javascript:void(0);" class="add_button" title="Add field">add</a-->
                                            </div>
                                        </div>
                                             </div>
                                        </div>
                                        
                                        
                                    
                                     </div>
                                </div>
                                <div class="row">
                                    <label id="err_txtcarvideo" class="txt_errors">Please Upload a Video</label>
                                    <label id="err_txtcaraudio" class="txt_errors">Please Upload a Image</label>
                                </div>
                                <div class="row">
<!--                                   <img src="<?php echo base_url();?>img/no_preview.png" id="video_prev">-->
                                    <img src="<?php echo base_url();?>img/no_preview.png" id="caraudio_prev">
                                </div>
                            <div class="row">
                                <div class="col-sm-12" >
                                    
                                         <div class="field_wrapper"></div>
                                        
                                        
                                        
                                        
                                        
                                    
                                     </div>
                                </div>
                                
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
                        $('#caraudio_prev').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
    }
            $(document).ready(function(){
                var maxField = 9; //Input fields increment limitation
                var addButton = $('.add_button'); //Add button selector
                var wrapper = $('.field_wrapper'); //Input field wrapper
                //var fieldHTML = '<div><div class="dropZoneContainer1" id="drop_camera"><input type="file" id="drop_zone" class="FileUpload" accept=".jpg,.png,.gif"  /><div class="dropZoneOverlay"><i class="fa fa-camera" aria-hidden="true"></i></div></div></div>';
                //var fieldHTML = '<div><input type="file" id="txt_admorepost" name="txt_admorepost[]" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="fa fa-minus-circle rm_icon"  aria-hidden="true"></i></a></div>'; //New input field html 
                
                var fieldHTML = '<div style="position: relative;margin-top:2%; background-color:#f7f7f7;width:15%;height:72px;border-radius:9px;" ><i class="fa fa-camera moreaudi_icon" aria-hidden="true"></i>' 
                                +'<span class="fa-stack fa-lg spaddvideo" >'
                                +'<i class="fa fa-circle fa-stack-1x icon-background111"></i>'
                                +'<i class="fa fa-plus fa-stack-1x vdmoreplus"  aria-hidden="true"></i>'
                                +'</span><a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="fa fa-minus-circle rm_icon"  aria-hidden="true"></i></a>'
                                +'<input type="file" style="opacity: 0.0; position: absolute; top: 0; left: 0; bottom: 0; right: 0; " />';
                                +'</div><br>';
                var x = 1; //Initial field counter is 1
                $(addButton).click(function(){ //Once add button is clicked
                    if(x < maxField){ //Check maximum number of input fields
                        x++; //Increment field counter
                        $(wrapper).append(fieldHTML); // Add field html
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
                    $('#txtcategory').change(function(){
                     var category=$(this).val();
                     var data = 'category='+category;
                     
                      $.ajax({
                   url: "<?php echo base_url('Trader/fetch_category');?>",
                   data : data,
                   type: "POST",
                   
                   success:function(data){
                       
                      

                       
                //$('#post_content').css('display','none');
                  if(category == '1')
                       {
                           $('#vert_content').remove();//$('#post_content').html(data);
                           
                            /*$('#car_content').css('display','block');
                           $('#vert_content').css('display','none');
                           $('#nopl_content').css('display','none');
                            $('#mob_content').css('display','none');
                            $('#prop_content').css('display','none');*/
                       }
                       if(category == '2')
                       {
                           $('#vert_content').remove();
                           /*$('#car_content').css('display','block');
                            $('#vert_content').css('display','none');
                           $('#nopl_content').css('display','none');
                            $('#mob_content').css('display','none');
                            $('#prop_content').css('display','none');*/
                       }
                       if(category == '3')
                       {
                           $('#vert_content').remove();
//                           $('#car_content').css('display','none');
//                            $('#vert_content').css('display','none');
//                           $('#nopl_content').css('display','block');
//                            $('#mob_content').css('display','none');
//                            $('#prop_content').css('display','none');
                       }
                      if(category == '4')
                       {
                           //$('#nopl_content').remove();
                           $('#car_content').css('display','none');
                            $('#vert_content').css('display','block');
                           $('#nopl_content').css('display','none');
                            $('#mob_content').css('display','none');
                            $('#prop_content').css('display','none');
                       }
                       if(category == '5')
                       {
                           $('#vert_content').remove();
//                           $('#car_content').css('display','none');
//                            $('#vert_content').css('display','block');
//                           $('#nopl_content').css('display','none');
//                            $('#mob_content').css('display','none');
//                            $('#prop_content').css('display','none');
                       }
                       if(category == '6')
                       {
                           $('#vert_content').remove();
//                            $('#car_content').css('display','none');
//                            $('#vert_content').css('display','none');
//                           $('#nopl_content').css('display','none');
//                            $('#mob_content').css('display','block');
//                            $('#prop_content').css('display','none');
                            
                       }
                       if(category == '7')
                       {
                           $('#vert_content').remove();
//                           $('#car_content').css('display','none');
//                            $('#vert_content').css('display','block');
//                           $('#nopl_content').css('display','none');
//                            $('#mob_content').css('display','none');
//                            $('#prop_content').css('display','none');
                       }
                       if(category == '8')
                       {
                           $('#vert_content').remove();
//                            $('#car_content').css('display','none');
//                            $('#vert_content').css('display','none');
//                           $('#nopl_content').css('display','none');
//                            $('#mob_content').css('display','block');
//                            $('#prop_content').css('display','none');
                       }
                       if(category == '9')
                       {
                             $('#vert_content').remove();
                           
                       }         
                       
                   }
                  
                   });
                 });
                 $("#drop_zone11").change(function(){
                      
                    var v =  $(this).val();
                 
                    $('#txt_hidvideo1').val(v);
                    readURL(this);
                    $('#err_txtcarvideo').css('display','none');
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
                $("#drop_zone21").change(function(){
                    
                    var v =  $(this).val();
                    //alert(v);return false;
                    
                    
  
                    $('#txt_hidaudio2').val(v);
                    readaudioURL(this);
                    $('#err_txtcaraudio').css('display','none');
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
                $('#txtcategory').change(function(){
                    $('#err_txtcat').css('display','none'); 
                });
                $('#txtverbrand').change(function(){
                    
                    $('#err_txtverbrand').css('display','none'); 
                });
                $('#srchcat3').change(function(){
                    $('#err_txtvermodel').css('display','none'); 
                });
                
                $('#txtverprice').keyup(function(){
                    $('#err_txtverprice').css('display','none'); 
                });
                
                $('#txtverdetails').keyup(function(){
                    $('#err_txtverdetails').css('display','none'); 
                });
                   $('#btnsavepost').click(function() {
                                    
                   
                     
                    var txtplace = $('#txtplace').val();
                    var txtcat = $('#txtcategory').val();
                    var txtverbrand = $('#txtverbrand').val();
                     var txtvermodel = $('#srchcat3').val();
                    
                    var txtverprice = $('#txtverprice').val();
                    var txtverdetails = $('#txtverdetails').val();
                    var txtvideo = $('#txt_hidvideo1').val();
                     var txtaudio = $('#txt_hidaudio2').val();
                      var txtimg = $('#txt_hidaudio2').val(); 
                     var txtvid = $('#txt_hidvideo1').val(); 
                    var imgfilename = txtimg.split(/[\\\/]/).pop();
                     var videfilename = txtvid.split(/[\\\/]/).pop(); 
                    if((txtplace == '')||(txtcat == '')||(txtverbrand == '')||(txtvermodel == '')||(txtverprice == '')||(txtverdetails == '')||(txtvideo == '')||(txtaudio == ''))
                    {
                        if(txtplace == '')
                        {
                            $('#err_txtplace').css('display','block'); 
                        }
                        if(txtcat == '')
                        {
                           
                           $('#err_txtcat').css('display','block');
                           
                        }
                        if(txtverbrand == '')
                        {
                            
                           //alert("Please select brand");
                           $('#err_txtverbrand').css('display','block');
                           
                        }
                        if(txtvermodel == '')
                        {
                           
                           $('#err_txtvermodel').css('display','block');
                       }  
                        
                        
                        if(txtverprice == '')
                        {
                           
                           $('#err_txtverprice').css('display','block');
                           
                        }
                        if(txtverdetails == '')
                        {
                           
                           $('#err_txtverdetails').css('display','block');
                           
                        }
                        if(txtvideo == '')
                        {
                          $('#err_txtcarvideo').css('display','block');
                           
                        }
                        if(txtaudio == '')
                        {
                          $('#err_txtcaraudio').css('display','block');
                           
                        }
                        //return false;
                    }
                    
                    else
                    {
                         $('.txt_errors').css('display','none');
                       
                       
                        
                        $.ajax({
                          url: "<?php echo base_url('Trader/save_verwatchpost');?>",
                          data : {'txtplace':txtplace,'txtcat':txtcat,'txtverbrand':txtverbrand,'txtvermodel':txtvermodel,'txtverprice':txtverprice,'txtverdetails':txtverdetails,'txtimg':txtimg,'imgfilename':imgfilename,'videfilename':videfilename},
                          type: "POST",

                          success:function(data){
                              //console.log(data);
                              if(data == 'success')
                              {
                                  //console.log(data);return false;
                                  $('#ver_success_msgdiv').slideDown();
                                  location.href="<?php echo base_url('Trader/add_post')?>";
                              }
                              }
                          });
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
                            
                            url: "<?php echo base_url('Trader/fetch_carmodel'); ?>" ,
                            success: function (data) {
                                
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

        

