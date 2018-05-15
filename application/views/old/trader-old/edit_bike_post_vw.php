


<!-- start section -->
<?php echo $this->session->flashdata('msg'); ?>

<form  id="editmyForm" method="post" novalidate="" enctype="multipart/form-data">
<div id="first">
    <section class="section white-background regsecdiv1">
        <div class="container">
            <div class="row">
                <div class="col-sm-12" >

                    <center>
                        <h5 id="addpost_title" >Update Post</h5>
                        <input type="hidden" name="txthid_pid" value="<?php echo $qry[0]->productCategoryID?>">
                         <input type="hidden" name="txthid_cid" value="<?php echo $qry[0]->productID?>">
                    </center>
                    <div class="container-fluid contdiv1" id="subcategory">

                           <div class="col-sm-6" >
                                <div class="form-group">
                                    <label for="usr" class="addpost_lbl">Category</label>
                                    <select class="form-control reginputs" name="txtcat" id="txtcategorya" >

                                       
                                            <option value="<?php echo $qry[0]->productCategoryID?>"><?php echo $qry[0]->productCategoryName ?></option>
                                            

                                    </select>
                                    <label id="err_txtcat" class="txt_errors">Please Select Your Category</label>
                                </div>
                            </div>
                        <div id="ggg">
                            <div class="col-sm-6" id="txthidbrand">
                                <div class="form-group">
                                    <label for="usr" class="addpost_lbl">Brand</label>

                                    <select class="form-control reginputs" name="txtbrand" id="txtbrand">
                                        <?php
                                        foreach($bike_brand as $r)
                                        {
                                            ?>
                                            <option value="<?php echo $r->brandName?>" <?php if($r->brandName == $qry[0]->productBBrand) echo 'selected'?>><?php echo $r->brandName ?></option>
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
                                        <select class="form-control reginputs" name="txtmodel" id="txtmodel">
                                            <?php
                                        foreach($bike_brand as $r)
                                        {
                                            ?>
                                            <option value="<?php echo $r->modelName?>" <?php if($r->modelName == $qry[0]->productBModel) echo 'selected'?>><?php echo $r->modelName ?></option>
                                       <?php
                                            }
                                        ?>
                                        
                                        </select>
                                        <label id="err_txtmodel" class="txt_errors">Please Select Your Model</label>
                                    </div>
                                </div>
                                <div class="col-sm-6" >
                                    <div class="form-group">
                                        <label for="usr" class="addpost_lbl">Year</label>
                                        <select class="form-control reginputs" name="txtyear" id="txtyear">
                                            <option value="">--Select--</option>
                                            <?php
                                            for($i=1970;$i<=date('Y');$i++)
                                            {
                                              ?>
                                            <option value="<?php echo $i?>" <?php if($i == $qry[0]->productBReleaseYear) echo 'selected'?>><?php echo $i?></option>
                                            <?php
                                            }
                                            ?>
                                           

                                        </select>
                                        <label id="err_txtyear" class="txt_errors">Please Select Year</label>

                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-6" >
                                    <div class="form-group">
                                        <label for="price" class="addpost_lbl">Price</label>
                                        <?php
                                        if($qry[0]->productBCallPrice == 1)
                                            $res = 'checked';
                                        else 
                                            $res = '';
                                        
                                        ?>
                                        <input type="checkbox" name="call_for_price" id="chkbox_callpr1"  <?php echo $res?> class="form-control reginputs"><span id="call_for_price" style="margin-left: 47px;position: relative;top: -32px;">Call for Price</span>
                                        <!--                                          <label id="err_txtprice" class="txt_errors">Enter Price</label>-->

                                    </div>
                                </div>
                                <div class="col-sm-6" >
                                    <div class="form-group">
                                        <label for="price" class="addpost_lbl">Add Price</label>
                                        <input type="text" name="txtprice"  id="txtprice" class="form-control reginputs" value="<?php echo $qry[0]->productBPrice?>">
                                        <label id="err_txtprice" class="txt_errors">Enter Price</label>

                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-6" >
                                    <label for="usr" class="addpost_lbl">Details</label>
                                    <textarea id="txtdetails" name="txtdetails"  class="form-control reginputs"><?php echo $qry[0]->productBDesc?></textarea>
                                    <label id="err_txtdetails" class="txt_errors">Enter Details</label>

                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-12" >
                                    <label for="usr" class="addpost_lbl" id="lblauvid">Add Video & Photos</label>
                                    <div class="form-group" style="margin-bottom: 50px">
                                        <?php
                                            if($qry[0]->productVideo != '')
                                            {
                                        ?>
                                            <div class="col-md-2">   
                                                <div class="dropZoneContainer" id="editdrop_video">
                                                    <input type="file" id="drop_zone1" name="productVideo" class="FileUpload" required=""/>
                                                    <div class="dropZoneOverlay">
                                                        <?php
                                                        if($qry[0]->thumbVideo !='')
                                                        {
                                                        ?>
                                                        <img src="<?php echo $qry[0]->thumbVideo;?>">   
                                                        <?php
                                                        }
                                                        else {
                                                        ?>
                                                        <img src="<?php echo base_url()?>img/add-post-add-video.png">  
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <div class="col-md-2"> 
                                                <div class="dropZoneContainer" id="editdrop_video">
                                                    <input type="file" id="drop_zone1" name="productVideo" class="FileUpload" required=""/>
                                                    <div class="dropZoneOverlay">
                                                        <img id="vid_icon" src="<?php echo base_url()?>img/add-post-add-video.png">
<!--                                                        <i class="fa fa-video-camera" id="vid_icon" aria-hidden="true"></i>-->
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        
                                            <?php
                                            }
                                            ?>
                                            <div class="col-md-2"> 
                                                <div class="dropZoneContainer" id="editdrop_video">
                                                    <input type="file" id="drop_zone1" name="txtimage" class="FileUpload" required=""/>
                                                    <div class="dropZoneOverlay">
                                                        <img id="" class="edit_imgs" width="85x" src="<?php echo $qry[0]->Bpost_main_img?>">
<!--                                                        <i class="fa fa-video-camera" id="vid_icon" aria-hidden="true"></i>-->
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            for($j=0;$j<3;$j++){
                                                $img="";
                                                if($j<count($qry)){
                                                    $img=$qry[$j]->productImage;
                                                }
                                                if($img != '')
                                                {
                                            ?>
                                            <div class="col-md-2">
                                                 <div class="dropZoneContainer" id="editdrop_video">
                                                    <input type="file" id="car_img" name="txtimage" class="FileUpload" accept=".jpg,.png,.gif"  />
                                                    <input type="hidden" id="txt_hidaudio">
                                                    <div class="dropZoneOverlay">
                                                        <img src="<?php echo $img?>" class="edit_imgs" width="85x" id="five_post_imgs2">
                                                    </div>
                                                </div>
                                            
                                            </div>
                                           
                                            <?php
                                            }
                                            else 
                                            {
                                              ?>
                                            <div class="col-md-2">
                                                 <div class="dropZoneContainer" id="editdrop_video">
                                                    <input type="file" id="car_img" name="txtimage" class="FileUpload" accept=".jpg,.png,.gif"  />
                                                    <input type="hidden" id="txt_hidaudio">
                                                    <div class="dropZoneOverlay">
                                                        <img id="" class="edit_imgs" width="85x"  src="<?php echo base_url() ?>img/add-post-add-pic.png">

                                                    </div>
                                                </div>
                                            
                                            </div>
                                        
                                              <?php  
                                            }
                                            }
                                   
                                            ?>
                                   
                                   
                                   

                                        
                                    </div>
                                    
                                    



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
                                        <button type="button" class="btn btn-default btnplantypes" id="btneditpost" >UPDATE</button>

                                    </div>
                                </div>


                            </div>




                        </div>




                    </div>
                </div>
            </div><!-- end container -->


        </section>
    </div>


</div>
 </form>   
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

        $('#btneditpost').click(function () {
            var form = $('#editmyForm')[0];
                 var formData = new FormData(form);
        $.ajax({
                    url: "<?php echo base_url('Trader/edit_bikepost'); ?>",
                    data:formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    type: "POST",

                    
                    success: function (data) {
                        console.log(data);return false;
                        if(data == 'success')
                        {
                            swal("Bike Post Details added successfully");
                        }
                        //console.log(data);
                        //$('#post_content').html(data);
                    }
                });
                });        
            /*var res = $('#chkbox_callpr1').is(':checked');
            var txtprice = $('#txtprice').val();
           
            if ($('#chkbox_callpr1').is(':checked'))
            {

                var call_for_price = 1;

            } else
            {

                var call_for_price = 0;

            }
            var txtcat = $('#txtcategorya').val();
            //alert("gfg"+txtcat);return false;
            var txtbrand = $('#txtbrand').val();
            var txtmodel = $('#srchcat3').val();
            
            var txtyear = $('#txtyear').val();
            var txtprice = $('#txtprice').val();
            var txtdetails = $('#txtdetails').val();
            var txtvideo = $('#hid_cvideo').val();
            var txtaudio = $('#txt_hidaudio').val();

            if ((txtcat == '') || (txtbrand == '') || (txtmodel == '') || (txtyear == '') || (txtdetails == '') || (txtaudio == ''))
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

                if (txtyear == '')
                {

                    $('#err_txtyear').css('display', 'block');

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

                if (txtaudio == '')
                {
                    $('#err_txtaudio').css('display', 'block');

                }

            } else
            {
                alert("fbb");return false;
                 var form = $('#myForm')[0];
                 var formData = new FormData(form);

                $.ajax({
                    url: "<?php echo base_url('Trader/save_bikepost'); ?>",
                    data:formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    type: "POST",

                    
                    success: function (data) {
                        console.log(data);return false;
                        if(data == 'success')
                        {
                            swal("Bike Post Details added successfully");
                        }
                        //console.log(data);
                        //$('#post_content').html(data);
                    }

                });
            }*/


        
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

