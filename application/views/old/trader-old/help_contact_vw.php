<p class="msg_div"><?php echo $this->session->flashdata('msg'); ?></p>
<form  method="post" id="my_form" action="<?php echo base_url();?>Trader/contact_help" enctype="multipart/form-data">
   <!-- start section -->
   <section class="section white-background regsecdiv1">
      <div class="container">
         <div class="row">
            <div class="col-sm-12" >
               <center>
                  <h5 id="regtitle" >Help & Contact</h5>
               </center>
               <div class="container-fluid contdiv1" >
                 
                   <p id="help_compname">Alshamil Auction L.L.c</p>
                  <div class="row">
                     <div class="col-sm-6" >
                        
                         Jumeriah-1,</br>
                         Oposite to mercato Center,</br>
                         Dubai,</br>
                         United Arab Emirates,</br>
                         Tel:+97143442000
                           
                    
                     </div>
                     <div class="col-sm-6" >
                         Fax:+97143446000,</br>
                         PO Box:333336,</br>
                         Mobile:+971505050506,</br>
                         Email:binsaif@alshamilauction.com,</br>
                         B.B PIN:26D1DDA4,</br>
                     </div>
                  </div>
               
                  <div class="row">
                     <div class="col-sm-6" >
                        <hr class="reghr" id="emhr">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end container -->
   </section>
   <!-- end section -->
   <!-- start section -->
   <section class="section white-background regsecdiv4">
      <div class="container">
      <div class="row">
         <div class="col-sm-12" >
            
            <div class="container-fluid contdiv1" >
                <p id="txthelppara">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia quisquam omnis quia incidunt Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia quisquam omnis quia incidunt</p>
                 <div class="row">
                  <div class="col-sm-6" >
                     <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text"  name="helpname" class="form-control reginputs" value="<?php echo set_value('helpname')?>">
                         <span class="errmsg"><?php echo form_error('helpname')?></span>

                     </div>
                  </div>
                  <div class="col-sm-6" >
                     <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text"  name="helpemail" class="form-control reginputs" value="<?php echo set_value('helpemail')?>">
                        <span class="errmsg"><?php echo form_error('helpemail')?></span>
                        <!--input type="text" name="txtemexpdate" class="form-control datepicker reginputs" placeholder="dd-mm-yyyy" value=""-->
                      
                     </div>
                  </div>
               </div>
              
                <div class="row">
            
                  <div class="col-md-9" >
                     <div class="form-group">
                        <textarea class="form-control input" name="helpmsg" rows="3" data-form-field="Message" placeholder="Message" style="resize:none" id="message-form4-2y"><?php echo set_value('helpmsg')?></textarea>
                        <span class="errmsg"><?php echo form_error('helpmsg')?></span>
                        <p id="helpparag" >Please enter the details of your request.A memeber of our support staff will respond as soon as possible</p>
                     </div>
                  </div></div>
                 <div class="row">
            
                  <div class="col-md-9" >
                     <div class="form-group">
                      <button type="submit" class="btn btn-default" id="btnhelpnext">Submit</button>
                     </div>
                  </div></div>
                 
                   
         </div> 
               </div>
            </div>
         </div>
      </div>
      <!-- end container -->
   </section>
   <!-- end section -->
   <!-- start section -->
   
</form>
 <script>
           
            $(document).ready(function(){
setTimeout(function(){
                   $('.msg_div').css('display','none');
                }, 3000);
            });
            </script>