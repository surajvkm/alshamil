

    
 <!-- start section -->
 <?php echo $this->session->flashdata('msg'); ?>
<!-- <form  action="<?php echo base_url();?>Trader/add_post" method="post" novalidate="" enctype="multipart/form-data">-->
      <!--form  onsubmit="return false;" id="myForm" method="post" novalidate="" enctype="multipart/form-data"-->

                           
                               
                                <div class="col-sm-6" id="txthidbrand" style="position: relative;top:1px;">
                                    <div class="form-group">
                                        <label for="usr" class="addpost_lbl">Emirates</label>
                                       
                                        <select class="form-control reginputs" id="txtemirates" name="txtemirates">
                                            <?php 
                                            foreach($template_qry as $r)
                                            {
                                                ?>
                                                 <option value="<?php echo $r->emirates?>"><?php echo $r->emirates?></option>
                                                 <?php
                                            }
                                                ?>
                                            
                                              
                                        </select>
                                         <label id="err_txtemirates" class="txt_errors">Please Select Emirates</label>
                                    </div>
                                </div>

                          
                           <div class="row"  >
                                <div class="col-sm-6" id="template_coldiv" style="margin-left: 212px;margin-top: 39px;">
                                    <div class="form-group">
<!--                                        <label for="usr" class="addpost_lbl">Choose Template</label>-->
                                        <p id="tem_name">fgf</p>
                                        <img src="<?php echo base_url()?>img/Dubai-new-temp.png" id="template_img" style="width:130px;">

                                        
                                    </div>
                                </div>
                                

                            </div>
                             <div class="row" id="cost_row">
                                <div class="col-sm-6" >
                                    <div class="form-group">
                                        <label for="usr" class="addpost_lbl">Code<p id="testp"></p></label>
                                         <select class="form-control reginputs" name="txtcode" id="txtcode">
                                            <option value="">--Select--</option>
                                           <option value="R">R</option>
                                            <option value="A">A</option>
                                             <option value="D">D</option>
                                        </select>
                                        <label id="err_txtcode" class="txt_errors">Please Select Code</label>
                                    </div>
                                </div>
                                <div class="col-sm-6" style="position: relative;top: 13px;">
                                    <label for="usr" class="addpost_lbl">Number of Digit</label>
                                    <select class="form-control reginputs" name="txtno_digs" id="txtno_digs">
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
                            <div class="row">
                                <div class="col-sm-6" >
                                    <div class="form-group">
                                        <label for="usr" class="addpost_lbl">Number</label>
                                        <input type="text" name="txtnumber" id="txtno" class="form-control reginputs">
                                         
                                        <label id="err_txtno" class="txt_errors">Enter Number</label>
                                    </div>
                                </div>
                                <div class="col-sm-6" >
                                    <div class="form-group">
                                        <label for="price" class="addpost_lbl">Price</label>
                                        <input type="checkbox" name="price" id="chkbox_callpr1"  class="form-control reginputs"><span id="call_for_price3" >Call for Price</span>
<!--                                          <label id="err_txtprice" class="txt_errors">Enter Price</label>-->

                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                
                                <div class="col-sm-6" >
                                    <div class="form-group">
                                       <label for="price" class="addpost_lbl">Add Price</label>
                                        <input type="text" name="txtprice"  id="txtprice" class="form-control reginputs" >
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
           
            $(document).ready(function(){
                $('#chkbox_callpr1').click(function(){
                    if($('#chkbox_callpr1').is(':checked'))
                    {
                        $('#txtprice').attr("disabled","disabled");
                        
                    }
                    else
                    {
                        $('#txtprice').removeAttr("disabled");
                        
                    }
                });
                 $('#txtemirates').change(function(){
                     var emirates = $(this).val();
                    
                    
                     $.ajax({
                            url: "<?php echo base_url('Trader/fetch_temp_img'); ?>",
                            data: {'emirates': emirates},
                            
                            type: "POST",

                            success: function (data) {
                              $('#template_img').attr('src',data);
                            //$('#testp').html(data);
                              
                            }

                   });
                 });   
                $('#txtno_digs').change(function(){
                    var limit = $(this).val();
                    $('#txtno').attr('maxlength',limit);
                });
                $('#txtno').keyup(function(){
                    $('#err_txtno').css('display','none'); 
                    var code = $('#txtcode').val();
                     var srcimg = $('#template_img').attr('src');
                     var tarr = srcimg.split('/');
                     var file_name=tarr[tarr.length-1];
                     //alert(file);return false;
                    var np_no = $('#txtno').val();
                    var res = code+" "+np_no;
                    $('#tem_name').html(res);
                    $.ajax({
                            url: "<?php echo base_url('Trader/generate_nopl_temp'); ?>",
                            data: {'res': res,'srcimg':file_name},
                            type: "POST",

                            success: function (data) {
                                //console.log(data);return false;
                                $('#template_img').attr('src',data);
                                //console.log(data);
                                //$('#post_content').html(data);
                            }

                   });
                    });
               
                
                $('#txtemirates').change(function(){
                    $('#err_txtemirates').css('display','none'); 
                });
                /*$('#txtcategorya').change(function(){
                    $('#err_txtcat').css('display','none'); 
                });*/
                $('#txtcode').change(function(){
                    $('#err_txtcode').css('display','none'); 
                });
                $('#txtno_digs').change(function(){
                    $('#err_txtno_digs').css('display','none'); 
                });
                
                $('#txtprice').keyup(function(){
                    $('#err_txtprice').css('display','none'); 
                });
                $('#txtdetails').keyup(function(){
                    $('#err_txtdetails').css('display','none'); 
                });
                
                $('#btnnoplateadpost').click(function() {
                    
                    var txtemirates = $('#txtemirates').val();
                    var txtcode = $('#txtcode').val();
                    var txtno_digs = $('#txtno_digs').val();
                     var txtno = $('#txtno').val();
                    
                    var txtprice = $('#txtprice').val();
                    var txtdetails = $('#txtdetails').val();
                    
                    if((txtemirates == '')||(txtcode == '')||(txtno_digs == '')||(txtno == '')||(txtprice == '')||(txtdetails == ''))
                    {
                        if(txtemirates == '')
                        {
                            $('#err_txtemirates').css('display','block'); 
                        }
                        if(txtcode == '')
                        {
                           
                           $('#err_txtcode').css('display','block');
                           
                        }
                        if(txtno_digs == '')
                        {
                           
                           $('#err_txtno_digs').css('display','block');
                           
                        }
                        if(txtno == '')
                        {
                           
                           $('#err_txtno').css('display','block');
                       }  
                        if ($('#chkbox_callpr1').is(':checked'))
                        {

                            $('#err_txtcprice').css('display', 'none');

                        } else
                        {
                            if (txtprice == '')
                            {
                                $('#err_txtprice').css('display','block');
                            }


                        }
                        
                        
                        if(txtdetails == '')
                        {
                           
                           $('#err_txtdetails').css('display','block');
                           
                        }
                        
                        //return false;
                    }

                    else
                    {
                        
                        var form = $('#myForm')[0];
                 var formData = new FormData(form);
                      

                $.ajax({
                    url: "<?php echo base_url('Trader/save_noplatepost'); ?>",
                    

                    data:formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    type: "POST",

                    success: function (data) { 
                        
                        if(data == 'success')
                        {
                            swal("Car Post Details added successfully");
                        }
                       
                    }

                });
            }
                        
                  
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
            
            
            
        </script>

 </div>
