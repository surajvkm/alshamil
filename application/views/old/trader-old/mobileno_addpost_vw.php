

    
 <!-- start section -->
 <?php echo $this->session->flashdata('msg'); ?>
<!-- <form  action="<?php echo base_url();?>Trader/add_post" method="post" novalidate="" enctype="multipart/form-data">-->
      <!--form  onsubmit="return false;" id="myForm" method="post" novalidate="" enctype="multipart/form-data"-->

   
                                
                                <div class="col-sm-6" id="txthidbrand">
                                    <div class="form-group">
                                        <label for="usr" class="addpost_lbl">Operator</label>
                                       
                                       <!--img src="<?php echo base_url()?>img/Mobile-etisalath.png"  style="width:130px;"-->
                                       <a id="btn_etisalat">etisalat</a>
                                       <img src="<?php echo base_url()?>img/Mobile-Du.png" id="img_du">
                                         <a id="btn_other">Other</a> 
                                         
                                     <!--button id="btn_etisalat">etisalat</button-->
                                      <!--button id="btn_du"><img src="<?php echo base_url()?>img/Mobile-Du.png" id="img_du"></button-->
                                     <!--<button id="btn_other">Other</button--> 

                                 
                                      


                                    </div>
                                </div>

                           
                           
                               <div class="row">
                                <div class="col-sm-6" id="em_pref_div">
                                    <div class="form-group">
                                        <label for="usr" class="addpost_lbl">Prefix</label>
                                        <select class="form-control reginputs" name="txtprefix">
                                            <option value="">--Select--</option>
                                            <option value="052">052</option>
                                            <option value="055">055</option>
                                            <option value="058">058</option>
                                        </select>
                                       
                                        
                                   </div>
                                </div>
                                   
                                  
                                <div class="col-sm-6" id="cntry_div">
                                    <div class="form-group">
                                        <label for="usr" class="addpost_lbl">Country Code</label>
                                        <select class="form-control reginputs" name="txtcntrycode">
                                            <option value="">--Select--</option>
                                            <option value="+971">+971</option>
                                            <option value="+1">+1</option>
                                              <option value="+91">+91</option>
                                        </select>
                                        
                                        
                                   </div>
                                </div>
                                   <div class="col-sm-6" id="du_pref_div" style="display:none;">
                                    <div class="form-group">
                                        <label for="usr" class="addpost_lbl">Prefix</label>
                                        <select class="form-control reginputs" name="txtcntrycode">
                                            <option value="">--Select--</option>
                                            <option value="050">050</option>
                                            <option value="054">054</option>
                                            <option value="056">056</option>
                                        </select>
                                        
                                        
                                   </div>
                                </div>
                                </div>
                                <div class="col-sm-6" id="mob_div">
                                    <div class="form-group">
                                        <label for="usr" class="addpost_lbl">Mobile Number</label>
                                     <input type="text" name="txtmob" class="form-control reginputs" value="">
                                        
                                        
                                   </div>
                                </div>

                            </div>
                            <div class="row" id="mob_price_div">
                                <div class="col-sm-6" id="mobile_price">
                                    <div class="form-group">
                                        <label for="price" class="addpost_lbl">Price</label>
                                        <input type="checkbox" name="price" id="chkbox_callpr1" class="form-control reginputs"><span id="call_for_price6" >Call for Price</span>
<!--                                          <label id="err_txtprice" class="txt_errors">Enter Price</label>-->

                                    </div>
                                </div>
                                <div class="col-sm-6" id="mobile_add_price">
                                    <div class="form-group">
                                       <label for="price" class="addpost_lbl">Add Price</label>
                                        <input type="text" name="price"  id="txtprice1" class="form-control reginputs" >
                                          <label id="err_txtprice" class="txt_errors">Enter Price</label>
  
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
                        $('#txtprice1').attr("disabled","disabled");
                        
                    }
                    else
                    {
                        $('#txtprice1').removeAttr("disabled");
                        
                    }
                });
                  $('#btn_etisalat').click(function(){
                      
                      $('#em_pref_div').css('display','block');
                      $('#du_pref_div').css('display','none');
                       $('#cntry_div').css('display','none');
                  }); 
                  $('#img_du').click(function(){
                      $('#em_pref_div').css('display','none');
                      //$('#du_prefix_div').css('display','block');
                      $('#du_prefix_div').css({'display':'block','position':'relative','left':'-303px','top':'31px'});
                     
                       $('#cntry_div').css('display','none');
                  });  
                  /*$('#btn_du').click(function(){
                      $('#pref_div').css('display','block');
                       $('#cntry_div').css('display','none');
                  });*/  
                  $('#btn_other').click(function(){
                      $('#em_pref_div').css('display','none');
                      $('#du_prefix_div').css('display','none');
                       $('#cntry_div').css('display','block');
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
                
                $('#btnsavepost').click(function() {
                    
                    var txtplace = $('#txtplace').val();
                    var txtcat = $('#txtcategorya').val();
                    var txtbrand = $('#txtbrand').val();
                     var txtmodel = $('#txtmodel').val();
                    var txtyear = $('#txtyear').val();
                    var txtprice = $('#txtprice').val();
                    var txtdetails = $('#txtdetails').val();
                    var txtvideo = $('#txt_hidvideo').val();
                     var txtaudio = $('#txt_hidaudio').val();
                    if((txtplace == '')||(txtcat == '')||(txtbrand == '')||(txtmodel == '')||(txtyear == '')||(txtprice == '')||(txtdetails == '')||(txtvideo == '')||(txtaudio == ''))
                    {
                        if(txtplace == '')
                        {
                            $('#err_txtplace').css('display','block'); 
                        }
                        if(txtcat == '')
                        {
                           
                           $('#err_txtcat').css('display','block');
                           
                        }
                        if(txtbrand == '')
                        {
                           
                           $('#err_txtbrand').css('display','block');
                           
                        }
                        if(txtmodel == '')
                        {
                           
                           $('#err_txtmodel').css('display','block');
                       }  
                        
                        if(txtyear == '')
                        {
                           
                           $('#err_txtyear').css('display','block');
                           
                        }
                        if(txtprice == '')
                        {
                           
                           $('#err_txtprice').css('display','block');
                           
                        }
                        if(txtdetails == '')
                        {
                           
                           $('#err_txtdetails').css('display','block');
                           
                        }
                        if(txtvideo == '')
                        {
                          $('#err_txtvideo').css('display','block');
                           
                        }
                        if(txtaudio == '')
                        {
                          $('#err_txtaudio').css('display','block');
                           
                        }
                        //return false;
                    }

                    else
                    {
                        
                        alert("success");return false;
                        $.ajax({
                          url: "<?php echo base_url('Trader/save_post');?>",
                          data : {'txtplace':txtplace},
                          type: "POST",

                          success:function(data){
                              console.log(data);
                              //$('#post_content').html(data);
                          }

                          });
                   }
                });
                var maxField = 5; //Input fields increment limitation
                var addButton = $('.add_button'); //Add button selector
                var wrapper = $('.field_wrapper'); //Input field wrapper
                //var fieldHTML = '<div><div class="dropZoneContainer1" id="drop_camera"><input type="file" id="drop_zone" class="FileUpload" accept=".jpg,.png,.gif"  /><div class="dropZoneOverlay"><i class="fa fa-camera" aria-hidden="true"></i></div></div></div>';
                //var fieldHTML = '<div><input type="file" id="txt_admorepost" name="txt_admorepost[]" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="fa fa-minus-circle rm_icon"  aria-hidden="true"></i></a></div>'; //New input field html 
                
                var fieldHTML = '<div style="position: relative;margin-top:2%; background-color:#f7f7f7;width:15%;height:72px;border-radius:9px;" ><i class="fa fa-camera moreaudi_icon" aria-hidden="true"></i>' 
                                +'<span class="fa-stack fa-lg spaddvideo" >'
                                +'<i class="fa fa-circle fa-stack-1x icon-background111"></i>'
                                +'<i class="fa fa-plus fa-stack-1x vdmoreplus"  aria-hidden="true"></i>'
                                +'</span><a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="fa fa-minus-circle rm_icon"  aria-hidden="true"></i></a>'
                                +'<input type="file" id="drop_zone21" name="file[]" class="FileUpload" style="opacity: 0.0; position: absolute; top: 0; left: 0; bottom: 0; right: 0; " />';
                                +'</div><br>';
                var x = 1; //Initial field counter is 1
                $(addButton).click(function(){ //Once add button is clicked
                   // alert("123");return false;
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
               var selected = localStorage.getItem('selected');
                if (selected) {
                  $(".catsel").val(selected);
                }
                 
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

 