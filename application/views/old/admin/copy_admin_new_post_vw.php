
<?php
    $this->view('admin/admin_header'); 
?>
    <div class="container">
        <div class="row">
            <?php
                $this->view('admin/admin_sidebar'); 
            ?>
                <h6 id="db_post_title">NEW POST</h6>
            <?php
            foreach($qry as $row)
            {
            ?>
                <div class="col-sm-12 adaddpostdiv" id="adaddpost_btndiv_<?php echo $row->postID?>">
                    <div class="col-sm-3">
                        <img src="<?php echo base_url().'uploads/product_images/'.$row->productImage?>" class="ad_post_img"> 
                              
                              
                            </div>
                            <div class="col-sm-3 ad_prdt">

                                <div>
                                   <span class="ad_prdpr">Product</span>&nbsp;&nbsp;<b><span class="ad_prdt_price_details"><?php echo $row->productName?></span></b><br>
                                   <span class="ad_prdpr">Price</span>&nbsp;&nbsp;<b><span class="ad_price_span"><?php echo $row->productPrice?></span></b>
                                   <div class="hori_divpost1"></div>
                                </div>

                            </div>
                            <div class="col-sm-3 ad_name">

                                <div>
                                    <!--img src="img/userProfileIcon_gray.png" id="ad_post_user_prof"-->
                                    <?php
                                    if($row->traderImage != '')
                                    {
                                        ?>
                                         <img src="<?php echo base_url().$row->traderImage?>" id="ad_post_user_prof">
                                     <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <img src="<?php echo base_url()?>img/userProfileIcon_gray.png" id="ad_post_user_prof">
                                    <?php    
                                    }
                                    ?>
                                         <p id="ad_post_uname"><?php echo $row->traderFullName?></p>
                                         <p id="ad_post_uplace"><?php echo $row->traderLocation?></p>
                                </div>
                                    <div class="hori_divpost2"></div>
                            <div class="col-sm-3 ad_btns">

                                <button class="ad_post_reject"  onclick="show_reason('<?php echo $row->postID?>')">Reject</button>

                                <button class="ad_post_approve" onclick="approve_post('<?php echo $row->postID?>')">Approve</button> 
                                <div id="rj_div_<?php echo $row->postID?>" class="rj_div">
                                    <input type="text" id="txt_rejmsg_<?php echo $row->postID?>" class="reject_txt">
                                    <button class="reject_btn" onclick="send_msg('<?php echo $row->postID?>')">Send Message</button>
                                </div>
                            </div>                     


                           </div>

          
                    </div>
                   <?php
                    }
                    ?>
                   
                    <!--div class="col-sm-12 adaddpostdiv" id="adaddpost_btndiv_1">
                          <div class="col-sm-3">
                            
                              <img src="img/no_preview.png" class="ad_post_img">

                        </div>
                        <div class="col-sm-3 ad_prdt">
                            
                            <div>
                               <span class="ad_prdpr">Product</span>&nbsp;&nbsp;<b><span class="ad_prdt_price_details">Audi S8-2015</span></b><br>
                               <span class="ad_prdpr">Price</span>&nbsp;&nbsp;<b><span class="ad_price_span">AED 23500</span></b>
                               <div class="hori_divpost1"></div>
                            </div>

                        </div>
                        <div class="col-sm-3 ad_name">
                            
                            <div>
                                <img src="img/userProfileIcon_gray.png" id="ad_post_user_prof">
                                     <p id="ad_post_uname">Abdul Khader</p>
                                     <p id="ad_post_uplace">Deira,Dubai</p>
                            </div>
                                <div class="hori_divpost2"></div>
                        <div class="col-sm-3 ad_btns">
                            
                            <button class="ad_post_reject"  onclick="show_reason(1)">Reject</button>
                           
                            <button class="ad_post_approve">Approve</button> 
                            <div id="rj_div_1">
                                <input type="text" class="reject_txt">
                                <button class="reject_btn">Send Message</button>
                            </div>
                        </div>                     
                       
                      
                    </div>
                    
          
                    </div-->
                            <!--div class="col-sm-12 adaddpostdiv" id="adaddpost_btndiv_2">
                          <div class="col-sm-3">
                            
                              <img src="img/no_preview.png" class="ad_post_img">

                        </div>
                        <div class="col-sm-3 ad_prdt">
                            
                            <div>
                               <span class="ad_prdpr">Product</span>&nbsp;&nbsp;<b><span class="ad_prdt_price_details">Audi S8-2015</span></b><br>
                               <span class="ad_prdpr">Price</span>&nbsp;&nbsp;<b><span class="ad_price_span">AED 23500</span></b>
                               <div class="hori_divpost1"></div>
                            </div>

                        </div>
                        <div class="col-sm-3 ad_name">
                            
                            <div>
                                <img src="img/userProfileIcon_gray.png" id="ad_post_user_prof">
                                     <p id="ad_post_uname">Abdul Khader</p>
                                     <p id="ad_post_uplace">Deira,Dubai</p>
                            </div>
                                <div class="hori_divpost2"></div>
                        <div class="col-sm-3 ad_btns">
                            
                            <button class="ad_post_reject" onclick="show_reason(2)">Reject</button>
                            <button class="ad_post_approve">Approve</button>  
                            <div id="rj_div_2">
                                <input type="text" class="reject_txt">
                                <button class="reject_btn">Send Message</button>
                            </div>
                        </div>                     
                       
                      
                    </div>
                    
          
                    </div-->
                </div><!-- end row -->                
            </div><!-- end container -->
            
       <?php
        $this->view('admin/admin_footer'); 
         ?>
        <script>
            
                function show_reason(post_id)
                {
                    $('#adaddpost_btndiv_'+post_id).css('margin-bottom','7%');
                    $('#rj_div_'+post_id).slideToggle('3000');
                    $('#rj_div_'+post_id).css('margin-top','-1px');
                   
                    
                 
                }
                function approve_post(post_id)
                {
                    
                    var data = 'post_id='+post_id;
                    $.ajax({
                            url: "<?php echo base_url(); ?>admin/Dashboard/approve_post",
                            data : data,
                            type: "POST",

                            success:function(data){
                              if(data == 'success')
                              {
                                 
                                 swal('Posts have been approved');
                                  setTimeout(function() 
                                {
                                  location.reload();  //Refresh page
                                }, 1000); 
                            }
                                   
                            }

                            });
                }
               
                $(document).ready(function(){
                   $('.ad_post_reject').css("opacity",'0.4');
                });
                 $('.ad_post_reject').mouseover(function(){
                     $('.ad_post_reject').css("opacity",'1');
                     $('.ad_post_approve').css("opacity",'0.4');
                });
                $('.ad_post_reject').mouseout(function(){
                    $('.ad_post_reject').css("opacity",'0.4');
                     $('.ad_post_approve').css("opacity",'1');
                });
                
        </script>    
            
        
       