<?php echo $this->session->flashdata('msg'); ?>

<div id="select_plan_div">


<!-- start section -->

    <section class="section white-background regsecdiv1">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12" >
                        
                            <center>
                             <h5 id="plantitle">Select Plan</h5>
                         </center>
                        <div class="container-fluid contdiv1" >
  
                            <div class="row">
                                <div class="col-sm-6" >
                                    <div class="form-group">
                                        <div class="img__wrap">
                                <img class="img__img" src="<?php echo base_url();?>img/info.png" />
                                <p class="img__description"><?php echo $yearlyplan[0]->planDesc;?> </p>
                                   </div>
<!--                                        <img title="dgdgg" src="<?php echo base_url();?>img/info.png" alt="" class="info" /> -->
                                      <button type="button"  id="btnyrlyplan">Yearly Plan[AED 6000/Month]</button>
                                      
                                   </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-sm-6" >
                                    <div class="form-group">
                                                                             <div class="img__wrap">
           <img class="img__img" src="<?php echo base_url();?>img/info.png" />
           <p class="img__description"><?php echo $yearlyplan[1]->planDesc;?> </p>
  
</div>
                                        <button type="button"  id="btnmnthly">Monthly Plan[AED 1000/Month]</button>

                                   </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-sm-6" >
                                    <div class="form-group">
                                                                         <div class="img__wrap">
  <img class="img__img" src="<?php echo base_url();?>img/info.png" />
     <p class="img__description"><?php echo $yearlyplan[2]->planDesc;?> </p>
</div>
                                        <button type="button"  id="btnyrlylim">Yearly Limited Plan[30 Post]</button>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-sm-6" >
                                    <div class="form-group">
                                                                             <div class="img__wrap">
  <img class="img__img" src="<?php echo base_url();?>img/info.png" />
    <p class="img__description"><?php echo $yearlyplan[3]->planDesc;?> </p>
</div>
  <button type="button"  id="btnsinglepost">Single Post[AED 100/Post]</button>
                                        
                                    </div>
                                </div>
                                

                            </div>
                           
                            
                        </div>
                        
                         
                        
                            
                    </div>
                </div>
            </div><!-- end container -->
                
            
    </section>

    <!-- end section -->
    
    

</div>
<div id="payoptions_div">
        
</div>
<script>
            
            $(document).ready(function()
            {
                $("#btnyrlyplan").click(function ()
                {
                  
                  var myurl = '<?= base_url(); ?>pay_options/';
                  var plan_type = 'Yearly Plan[AED 6000/Month]';
                   
                    $.ajax({
                           type:'POST',
                           url:myurl,
                           data:{'plan_type':plan_type},
                           success:function(data)
                           {
                               
                               $('#select_plan_div').css('display','none');
                               $('#payoptions_div').css('display','block');
                               $('#payoptions_div').html(data);
                           }
                       });   
                      
                });
                $("#btnmnthly").click(function ()
                {
                  
                  var myurl = '<?= base_url(); ?>pay_options/';
                  var plan_type = 'Monthly Plan[AED 1000/Month]';
                   
                    $.ajax({
                           type:'POST',
                           url:myurl,
                           data:{'plan_type':plan_type},
                           success:function(data)
                           {
                               $('#select_plan_div').css('display','none');
                               $('#payoptions_div').css('display','block');
                               $('#payoptions_div').html(data);
                           }
                       });   
                      
                });
                $("#btnyrlylim").click(function ()
                {
                  
                  var myurl = '<?= base_url(); ?>pay_options/';
                  var plan_type = 'Yearly Limited Plan[30 Post]';
                   
                    $.ajax({
                           type:'POST',
                           url:myurl,
                           data:{'plan_type':plan_type},
                           success:function(data)
                           {
                               $('#select_plan_div').css('display','none');
                               $('#payoptions_div').css('display','block');
                               $('#payoptions_div').html(data);
                           }
                       });   
                      
                });
                $("#btnsinglepost").click(function ()
                {
                  
                  var myurl = '<?= base_url(); ?>pay_options/';
                  var plan_type = 'Single Post[AED 100/Post]';
                   
                    $.ajax({
                           type:'POST',
                           url:myurl,
                           data:{'plan_type':plan_type},
                           success:function(data)
                           {
                               $('#select_plan_div').css('display','none');
                               $('#payoptions_div').css('display','block');
                               $('#payoptions_div').html(data);
                           }
                       });   
                      
                });
               
            });
            </script>
