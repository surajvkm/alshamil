





<!-- start section -->

<?php echo $this->session->flashdata('msg'); ?>

<!-- <form  action="<?php echo base_url(); ?>Trader/add_post" method="post" novalidate="" enctype="multipart/form-data">-->

<!--form  onsubmit="return false;" id="myForm" method="post" novalidate="" enctype="multipart/form-data"-->

<div id="first">

    <section class="section white-background regsecdiv1">

        <div class="container">

            <div class="row">

                <div class="col-sm-12" >



                    <center>

                        <h5 id="addpost_title" >Add Post</h5>

                    </center>

                    <div class="container-fluid contdiv1" id="subcategory">



                           <div class="col-sm-6" >

                                <div class="form-group">

                                    <label for="usr" class="addpost_lbl">Category</label>

                                    <select class="form-control reginputs" id="txtcategorya" >



                                        <option value="">--Select--</option>

                                        <?php

                                        foreach ($cat_qry as $r) {

                                            ? 

                                            <option value="<?php echo $r->productCategoryID ?>"><?php echo $r->category_name ?></option>

                                            <?php

                                        }

                                        ?>



                                    </select>

                                    <label id="err_txtcat" class="txt_errors">Please Select Your Category</label>

                                </div>

                            </div>

                        <div id="ggg">

                            <div class="col-sm-6" id="txthidbrand">

                                <div class="form-group">

                                    <label for="usr" class="addpost_lbl">Emirates</label>

                                       

                                        <select class="form-control reginputs" id="txtemirates" name="txtemirates">

                                            <option value="Baharin">Baharin</option>

                                            <option value="UAE">UAE</option>

                                             <option value="Oman">Oman</option>

                                              

                                        </select>

                                         <label id="err_txtemirates" class="txt_errors">Please Select Emirates</label>

                                </div>

                            </div>

                     

                        

                            <div class="row" id="em_row">

                                <div class="col-sm-6" id="template_coldiv" style="margin-left: 212px;margin-top: 39px;">

                                    <div class="form-group">

<!--                                        <label for="usr" class="addpost_lbl">Choose Template</label>-->

                                        <p id="tem_name"></p>

                                        <img src="<?php echo base_url()?>img/no_preview.png" id="template_img" style="width:130px;">



                                        

                                    </div>

                                </div>

                                



                            </div>

                            

                            <div class="row" id="cost_row">

                                <div class="col-sm-6" >

                                    <div class="form-group">

                                        <label for="usr" class="addpost_lbl">Code</label>

                                         <select class="form-control reginputs" name="txtcode" id="txtcode">

                                            <option value="">--Select--</option>

                                           <option value="R">R</option>

                                            <option value="A">A</option>

                                             <option value="D">D</option>

                                        </select>

                                        <label id="err_txtcode" class="txt_errors">Please Select Code</label>

                                    </div>

                                </div>

                                <div class="col-sm-6" >

                                    <label for="usr" class="addpost_lbl">Number of Digit</label>

                                    <select class="form-control reginputs" name="txtno_of_digits" id="txtno_digs">

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

                                        <input type="text" name="price"  id="txtprice" class="form-control reginputs" >

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

              

                            

                           



                            



                       

                    </div> 



                </div>

            </div>



        </div>



 </div>



    </section>

    <!-- end section -->

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

                                        <button type="button" class="btn btn-default btnplantypes" id="btneditsavepost" >SAVE</button>



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

</div>

<div id="second"></div>

<div id="third"></div>

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

                $('#txtprice').attr("disabled", "disabled");



            } else

            {

                $('#txtprice').removeAttr("disabled");



            }

        });



        $("#drop_zone1").change(function () {

            var v = $(this).val();

            // alert(v);return false;

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

//        $('#txtcategorya').change(function () {

//            $('#err_txtcat').css('display', 'none');

//        });

        $('#txtbrand').change(function () {

            $('#err_txtbrand').css('display', 'none');

        });

        $('#txtmodel').change(function () {

            $('#err_txtmodel').css('display', 'none');

        });

        $('#txtyear').change(function () {

            $('#err_txtyear').css('display', 'none');

        });

        $('#txtprice').keyup(function () {

            $('#err_txtprice').css('display', 'none');

        });

        $('#txtdetails').keyup(function () {

            $('#err_txtdetails').css('display', 'none');

        });



        $('#btnsavepost').click(function () {



            var txtplace = $('#txtplace').val();

            var txtcat = $('#txtcategorya').val();

            var txtbrand = $('#txtbrand').val();

            var txtmodel = $('#txtmodel').val();

            var txtyear = $('#txtyear').val();

            var txtprice = $('#txtprice').val();

            var txtdetails = $('#txtdetails').val();

            var txtvideo = $('#txt_hidvideo').val();

            var txtaudio = $('#txt_hidaudio').val();

            if ((txtplace == '') || (txtcat == '') || (txtbrand == '') || (txtmodel == '') || (txtyear == '') || (txtprice == '') || (txtdetails == '') || (txtvideo == '') || (txtaudio == ''))

            {

                if (txtplace == '')

                {

                    $('#err_txtplace').css('display', 'block');

                }

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



                if (txtyear == '')

                {



                    $('#err_txtyear').css('display', 'block');



                }

                if (txtprice == '')

                {



                    $('#err_txtprice').css('display', 'block');



                }

                if (txtdetails == '')

                {



                    $('#err_txtdetails').css('display', 'block');



                }

                if (txtvideo == '')

                {

                    $('#err_txtvideo').css('display', 'block');



                }

                if (txtaudio == '')

                {

                    $('#err_txtaudio').css('display', 'block');



                }

                //return false;

            } else

            {



                alert("success");

                return false;

                $.ajax({

                    url: "<?php echo base_url('Trader/save_post'); ?>",

                    data: {'txtplace': txtplace},

                    type: "POST",



                    success: function (data) {

                        console.log(data);

                        //$('#post_content').html(data);

                    }



                });

            }

        });

        var maxField = 9; //Input fields increment limitation

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

        $('#txtcategorya').change(function () {



            var category = $(this).val();



            if (category == '1')

            {

               

                $("#ggg").load("<?php echo base_url() . 'Trader/car_addpostview/1'; ?>");

                //$("#ggg").html("123");



            }

            if (category == '2')

            {

                

                $("#ggg").load("<?php echo base_url() . 'Trader/bike_addpostview/2'; ?>");



            }

            if (category == '3')

            {

                

                $("#ggg").load("<?php echo base_url() . 'Trader/noplate_addpostview/3'; ?>");



            }

            if (category == '4')

            {



                

                $("#ggg").load("<?php echo base_url() . 'Trader/vertu_addpostview/4'; ?>");



            }

            if (category == '5')

            {



                

                $("#ggg").load("<?php echo base_url() . 'Trader/watch_addpostview/5'; ?>");



            }

            if (category == '6')

            {



               

                $("#ggg").load("<?php echo base_url() . 'Trader/mobile_addpostview/6'; ?>");



            }

            if (category == '7')

            {



                

                

                $("#ggg").load("<?php echo base_url() . 'Trader/boat_addpostview/7'; ?>");



            }

            if (category == '8')

            {



                

                $("#ggg").load("<?php echo base_url() . 'Trader/phone_addpostview/8'; ?>");



            }

            if (category == '9')

            {



                

                $("#ggg").load("<?php echo base_url() . 'Trader/property_addpostview/9'; ?>");



            }

        });

    });







</script>



