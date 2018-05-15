
        <!-- start section -->
        <section class="section white-backgorund" id="sec_prof">
            <div class="container">
                <div class="row">
                    <!-- start sidebar -->
                    <div class="col-sm-3" id="profile_div">
                        
                        
                        <div class="widget" id="widget_advsrch">
                                <p id="adsrchtitle">Advanced Search</p>
                                <select class="form-control input-lg" name="category" id="srchcat1">
                                         <?php
                                    foreach($cat_qry as $r)
                                    {
                                       ?>
                                    <option value="<?php echo $r->productCategoryID?>"><?php echo $r->category_name?></option>
                                    <?php
                                    }
                                    ?>
                                         

                                 </select>
                                <br>
                                 <select class="form-control input-lg" name="brand" id="srchcat2">
                                         <option value="">---Select---</option>

                                 </select>
                                <br>
                                <select class="form-control input-lg" name="model" id="srchcat3">
                                          <option value="">---Select---</option>

                                 </select>
                                <br>
                                <select class="form-control input-lg" name="category" id="srchcat4">
                                       <option value="">From Year</option>
                                         <option value="1970">1970</option>
                                          <option value="1987">1987</option>
                                           <option value="1987">1987</option>
                                            <option value="2000">2000</option>

                                 </select>

                                <br>
                                <select class="form-control input-lg" name="category" id="srchcat5">
                                         <option value="">To Year</option>
                                          <option value="2011">2011</option>
                                           <option value="2016">2016</option>
                                            <option value="2017">2017</option>

                                 </select>
                                <button type="button" class="btn btn-default" id="btnsrchpost">SEARCH</button>
                        </div><!-- end widget -->
                        
                 
                    </div><!-- end col -->
                    <!-- end sidebar -->
                    <div class="col-sm-9">
                        
                        <div class="row">
                            <div id="category_title_div">
                                <h5 id="category_title">BIKE</h5><!--hr id="category_hr"--><b><span id="category_cnt">(<b><?php echo $count?></b> Product Listed)</span></b>
                            </div>
                            
                        </div><!-- end row -->
                    </div>
                    <div class="col-sm-9" id="imgpost_div">
                        
                        <div class="row">
                              <?php  
                            foreach ($qry as $result) 
                           {  
                           ?>
                            <div class="col-sm-3 catpostimgs">
                                 
                                <a href="<?php echo base_url()?>Trader/bike_category_details/<?php echo $result->productID;?>/<?php echo $result->productCategoryID;?>"> <img src="<?php echo $result->Bpost_main_img; ?>" class="post_imgs"></a>
                                    <div class="tradet_details">
                                       <span class="wlprdpr">Product</span>&nbsp;&nbsp;<b><span class="prdt_price_details"><?php echo $result->productBBrand." ".$result->productBModel;?></span></b><br>
                                      <?php $currency = "AED"; ?>
                                       <span class="wlprdpr">Price</span>&nbsp;&nbsp;<b><span class="price_span"><?php echo $currency." ".$result->productBPrice;?></span></b>
                                        <hr class="cat_hr">
                                       <?php
                                    if($result->traderImage != '')
                                    {
                                        ?>
                                         <img src="<?php echo $result->traderImage?>" class="cat_user_prof">
                                     <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <img src="<?php echo base_url()?>img/userProfileIcon_gray.png" class="cat_user_prof">
                                    <?php    
                                    }
                                    ?>
                                        <p class="cat_uname"><?php echo $result->traderFullName;?></p>
                                        <p class="cat_uplace"><?php echo $result->traderLocation;?></p>
                                       <?php
                                        $d = $result->productBSubmitDate;
                                        $d1 = strtotime($d);
                                        ?>
                                        <p class="cat_udate"><?php echo date('d M Y',$d1)?></p>
                                    </div>
                                </div>
                               
                               
                       <?php  
                           }  
                           ?>
                            
                        </div><!-- end row -->
                        <div class="row">
                        <div id="pagination">
                            <ul class="tsc_pagination">

                           
                            <?php foreach ($links as $link) {
                            echo "<li>". $link."</li>";
                            } ?>
                            </ul>
                            </div>
                    </div>
                    </div><!-- end col -->
                    
                </div><!-- end row -->                
            </div><!-- end container -->
        </section>
        <section class="section white-backgorund" id="pag_secdiv">
            
        </section>
        <!-- end section -->
        <section class="section white-backgorund" id="sec_recviews">
            <p id="recent_title" >RECENTLY VIEWED ITEMS</p>
        <div class="container">
<div class="owl-one owl-carousel owl-theme">
                     <?php
                        $item_class = ' active';
                        foreach($recentqry as $r)
                        {
                            ?>
                    
                        <div class="item<?php echo $item_class; ?>">

                                       <img src="<?php echo $r->productImage?>"  class="recent_slimgs" >
                                        <!--div class="mostv_prddiv" >
                                            <p class="most_prd">Product</p><span class="most_prd_vals"><?php echo $r->productName?></span>
                                            <p class="most_prd_price">Price</p><span class="most_prd_vals"><?php echo $r->productName?></span>
                                        </div-->
                                    

                                       </div>

                                      <?php
                                      $item_class = '';
                                      }
                                      ?>
                    </div>
             </div>

        </section> 
        <script>
             $(document).ready(function()
             {
                         var myDiv = $('.prdt_price_details');
                        myDiv.text(myDiv.text().substring(0,13));
                        
                    $('.owl-carouseldetailpage').owlCarousel({
                        loop:true,
                        singleItem: true,
                        //margin:10,
                        navText: [ '<button class="owlbtn"><i class="fa fa-chevron-circle-left catdetslider_left" ></i></button>', '<button class="owlbtn"><i class="fa fa-chevron-circle-right catdetslider_right"  aria-hidden="true"></i></button>' ],
                        nav:true,
                        autoplay: true,
                        responsive:{
                            0:{
                                items:1
                            },

                        }
                    });
                    $('.owl-one').owlCarousel({
                        loop:true,
                        margin:10,
                        
                     	navText: [ '<button class="owlbtn"><i class="fa fa-chevron-circle-left mostviewslider_left" ></i></button>', '<button class="owlbtn"><i class="fa fa-chevron-circle-right mostviewslider_right"  aria-hidden="true"></i></button>' ],
                        nav:true,
                        autoplay: true,
                        responsive:{
                            0:{
                                items:1
                            },
                            600:{
                                items:1
                            },
                            1000:{
                                items:4
                            }
                        }
                    });
                $('.viewsliderdiv').owlCarousel({
                            loop:true,
                margin:10,
                nav:true,
                responsive:{
                    0:{
                        items:4
                    },
                    600:{
                        items:4
                    },
                    1000:{
                        items:4
                    }
                }
                        });
                            $('.anccls').click(function(){
                     var id = $(this).attr('data-id');
                     //alert(id);return false;
                     var data = 'product_id='+id;
                $.ajax({
                            url: "<?php echo base_url(); ?>Trader/fetch_proddet",
                            data : data,
                            type: "POST",

                            success:function(data){
                                 $('#employee_detail').html(data);  
                                 $('#dataModal').modal("show"); 
                              
                                   
                            }

                        });
                         });
                         $('#srchcat1').change(function(){
                        var category = $("#srchcat1").val();
                        
                        if((category == '3')||(category == '6')||(category == '9'))
                        {
                            $('#srchcat2').css('display','none');
                            $('#srchcat3').css('display','none');
                            $('#srchcat4').css('display','none');
                            $('#srchcat5').css('display','none');
                        }
                        else
                        {
                            $('#srchcat2').css('display','block');
                            $('#srchcat3').css('display','block');
                            $('#srchcat4').css('display','block');
                            $('#srchcat5').css('display','block');

                     var data = 'category='+category;
                    if (category != "") { 
                         $.ajax({
                            type: "POST",
                            dataType: 'json',
                            data:data,
                            url: "<?php echo base_url('Trader/fetch_brand'); ?>" ,
                            success: function (data) {
                                //console.log(data);return false;
                                 $('#srchcat2').empty();

                    $.each(data,function(id,city)
                    {
                        var opt = $('<option />'); // here we're creating a new select option for each group
                        opt.val(id);
                        opt.text(city);
                        $('#srchcat2').append(opt);
                    });

                        }

                        });
                        }
                        }
                 });
                        $('#srchcat2').change(function(){
                        var brand = $("#srchcat2").val();

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
                 });
                 });
           </script>      
    
       
       
        
    