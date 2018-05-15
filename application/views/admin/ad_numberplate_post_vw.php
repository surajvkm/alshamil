<div id="resl_div">

<?php

  $this->view('admin/admin_header'); 

 ?> 

 <!-- start section -->

    <section class="section white-background regsecdiv1">

            <div class="container">

                <div class="row">

                    <div class="col-sm-12" >

                        

                            <center>

                             <h5 id="addpost_title" >Add Post</h5>

                         </center>

                        <div class="container-fluid contdiv1" >

  

                            <div class="row">

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

                                <div class="col-sm-6" >

                                    <div class="form-group">

                                        <label for="usr" class="addpost_lbl">Category</label>

                                         <select class="form-control reginputs" name="txtcat" onchange="fetch_post(this.value)">

                                            <option value="">--Select--</option>

                                            <option value="Car">Car</option>

                                            <option value="Bike">Bike</option>

                                            <option value="Number Plate">Number Plate</option>

                                            <option value="Vertu">Vertu</option>

                                            <option value="Watch">Watch</option>

                                            <option value="Mobile Number">Mobile Number</option>

                                            <option value="Boat">Boat</option>

                                            <option value="Iphone">Iphone</option>

                                            <option value="Properties">Properties</option>

                                        </select>

                                   </div>

                                </div>



                            </div>

                            <div class="row">

                                <div class="col-sm-6" >

                                    <div class="form-group">

                                        <label for="usr" class="addpost_lbl">Emirates</label>

                                       

                                        <select class="form-control reginputs" id="txtemirates" name="txtemirates">

                                            <option value="">--Select--</option>

                                           

                                        </select>

                                        

                                    </div>

                                </div>

                                



                            </div>

                            <div class="row"  >

                                <div class="col-sm-6" >

                                    <div class="form-group">

                                        <label for="usr" class="addpost_lbl">Choose Template</label>

                                        <div class="col-sm-3">

                                            <button   id="btn_eng">R 1515</button>

                                        </div>

                                        <div class="col-sm-3">

                                            <button   id="btn_ar">R 1515</button>

                                        </div>

                                        

                                        

                                    </div>

                                </div>

                                



                            </div>

                            <div class="row" id="cost_row">

                                <div class="col-sm-6" >

                                    <div class="form-group">

                                        <label for="usr" class="addpost_lbl">Code</label>

                                         <select class="form-control reginputs" name="txtcode">

                                            <option value="">--Select--</option>

                                           

                                        </select>

                                    </div>

                                </div>

                                <div class="col-sm-6" >

                                    <label for="usr" class="addpost_lbl">Number of Digit</label>

                                    <select class="form-control reginputs" name="txtno_of_digits">

                                            <option value="">--Select--</option>

                                           

                                        </select>

                                </div>



                            </div>

                            

                          <div class="row">

                                <div class="col-sm-6" >

                                    <div class="form-group">

                                        <label for="usr" class="addpost_lbl">Number</label>

                                         <select class="form-control reginputs" name="txtnumber">

                                            <option value="">--Select--</option>

                                           

                                        </select>

                                    </div>

                                </div>

                                <div class="col-sm-6" >

                                    <label for="usr" class="addpost_lbl">Price</label>

                                    <input type="text" name="txt_price"  class="form-control reginputs">

                                </div>



                            </div>

                            

                           <div class="row">

                                <div class="col-sm-6" >

                                    <label for="usr" class="addpost_lbl">Details</label>

                                    <textarea id="txtdetails" name="txtdetails"  class="form-control reginputs"></textarea>

                                </div>

                                

                            </div>

                                

                            </div>

                        </div>

                        

                         

                        

                            

                    </div>

                </div>

         

            

    </section>

        <!-- end section -->

            <section class="section white-background regsecdiv1">

                <div class="container">

                <div class="row">

                    <div class="col-sm-12" >

                        

                            

                        <div class="container-fluid contdiv1" >

                           

                       

                            <div class="row" id="postbtn">

                                <div class="col-sm-3" >

                                     

                                    <div >

                                        

                                        <button type="button" class="btn btn-default btnplantypes" id="btnpostclr">CLEAR</button>

                                       

                                    </div>

                                </div>

                                <div class="col-sm-3" >

                                    <div class="form-group">

                                        <button type="button" class="btn btn-default btnplantypes" id="btnsavepost">POST</button>

                                         

                                   </div>

                                </div>

                                



                            </div>

                            

                            

                           

                            

                        </div>

                        

                         

                        

                            

                    </div>

                </div>

            </div><!-- end container -->

                

                

            </section>

        <script>

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

               var selected = localStorage.getItem('selected');

                if (selected) {

                  $(".catsel").val(selected);

                }

            });

         function fetch_post(x)

            {

                if((x=='Car')||(x=='Bike'))

                {

                    $('#resl_div').css('display','none');

                    $('#carbike_div').css('display','block');

                    location.href="ad_car_post";

                     $('.catsel').setItem('selected', $(this).val());

                }

               if((x=='Mobile Number')||(x=='Iphone'))

                {

                    

                   $('#resl_div').css('display','none');

                  $('#carbike_div').css('display','block');

                  $('#mob_div').css('display','block');

                    location.href="ad_mobile_post"; 

                     $('.catsel').setItem('selected', $(this).val());

                }

                if((x=='Vertu')||(x=='Watch') ||(x=='Boat'))

                {

                    $('#resl_div').css('display','none');

                    $('#carbike_div').css('display','block');

                   $('#mob_div').css('display','none');

                    $('#verwb_div').css('display','block');

                    location.href="ad_verwatch_post";

                     $('.catsel').setItem('selected', $(this).val());

                    

                }

                if(x=='Number Plate')

                {

                   $('#resl_div').css('display','none');

                    $('#carbike_div').css('display','block');

                   $('#mob_div').css('display','none');

                    $('#verwb_div').css('display','none');

                    $('#noplate_div').css('display','block');

                    location.href="ad_numberplate_post"; 

                     $('.catsel').setItem('selected', $(this).val());

                }

                if(x=='Properties')

                {

                   $('#resl_div').css('display','none');

                    $('#carbike_div').css('display','block');

                    $('#mob_div').css('display','none');

                    $('#verwb_div').css('display','none');

                    $('#noplate_div').css('display','none');

                    location.href="ad_property_post"; 

                     $('.catsel').setItem('selected', $(this).val());

                }

            }

        </script>

<?php     $this->view('admin/admin_footer');  ?>

</div>

<div id="carbike_div"></div>

<div id="mob_div"></div>

<div id="verwb_div"></div>

<div id="noplate_div"></div>

<div id="prop_div"></div>