<?php if($this->session->flashdata('msg')) { echo $this->session->flashdata('msg'); } ?>

<div class="modal fade" id="options-modal" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content tradermdl">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Confirm</h5>
            </div>
            <div class="modal-body">
                <p>You are selected <p class="data-body"></p>. Do You Want to Continue?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success plnm" data-id="" onclick="disp_payment()" data-dismiss="modal">Yes,Proceed</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

            </div>
        </div>
    </div>
</div>

<div id="select_plan_div">


    <!-- start section -->

    <section class="section white-background regsecdiv1">
        <div class="container">
            <div class="row">
                <div class="col-sm-12" >

                    <center>
                        <h5 id="plantitle paddingleft0">Select Plan</h5>
                    </center>
                    <div class="container-fluid contdiv1 paddingleft0" >
                        <!--                        Plan Yearly-->
                        <?php
                        
                        if($plans->num_rows()>0) {
							
						
                        foreach($plans->result() as $row)
                        {
                            ?>
                        <div class="row">
                            <div class="col-sm-7 plananc" >
                                <?php
                                 $yrlyVal = $row->name.' Plan [AED '. $row->amount.'/Post]';
                                ?>
                             <a class="pull-right " href="#" data-toggle="popover" data-placement="top" title="" data-content="<?php echo $yrlyVal?>">
                                    <i class="fa fa-exclamation-circle excl fa-2x" title="Read More"></i>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12" >
                             <button type="button" data-type-id="<?php echo $row->planId  ?>" data-body = "<?php echo $yrlyVal  ?>"   data-toggle="modal" class="btn-plans" data-target="#options-modal"> <?php echo $yrlyVal?> </button>
                           
                            </div>
                        </div>
                        
                        <?php    
                        }}
                        ?>
                   

                    </div>




                </div>
            </div>
        </div><!-- end container -->


    </section>

    <!-- end section -->



</div>
<script type="text/javascript" src="<?php echo base_url(); ?>js/app/payonreg.js"></script>  
