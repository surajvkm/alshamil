<?php echo $this->session->flashdata('msg'); ?>
<!-- Modal -->
<div class="modal fade" id="yearlyModal" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content tradermdl">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Confirm</h5>
            </div>
            <div class="modal-body ">
                <p>You are selected Yearly Plan. Do You Want to Continue?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="disp_payment('1')" data-dismiss="modal">Yes,Proceed</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="monthlyModal" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content tradermdl">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Confirm</h5>
            </div>
            <div class="modal-body">
                <p>You are selected Monthly Plan.Do You Want to Continue?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="disp_payment('2')" data-dismiss="modal">Yes,Proceed</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="yrlylimModal" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content tradermdl">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Confirm</h5>
            </div>
            <div class="modal-body">
                <p>You are selected Yearly Limited Plan.Do You Want to Continue?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="disp_payment('3')" data-dismiss="modal">Yes,Proceed</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="singleModal" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content tradermdl">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Confirm</h5>
            </div>
            <div class="modal-body">
                <p>You are selected Single Post Plan. Do You Want to Continue?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="disp_payment('4')" data-dismiss="modal">Yes,Proceed</button>
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
                        foreach($qry as $row)
                        {
                            ?>
                        <div class="row">
                            <div class="col-sm-7 plananc" >
                                <?php
                                if(($row->planName == 'Yearly'))
                                {
                                    $yrlyVal = $row->planName.' Plan [AED '. $row->planAmount.'/Year]';
                                    $planClass = "btn-plans";
                                    $targetModal = "#yearlyModal";
                                }
                                if(($row->planName == 'Monthly'))
                                {
                                    
                                    $yrlyVal = $row->planName.' Plan [AED '. $row->planAmount.'/Month]';
                                    $planClass = "btn-plans p2";
                                    $targetModal = "#monthlyModal";
                                }
                                if(($row->planName == 'Yearly Limited'))
                                {
                                    $yrlyVal = $row->planName.' Plan [AED '.$row->planAmount."/".$row->planPostCount.' Post]';
                                    $planClass = "btn-plans p3";
                                    $targetModal = "#yrlylimModal";
                                }
                                if(($row->planName == 'Single'))
                                {
                                   
                                    $yrlyVal = $row->planName.' Plan [AED '. $row->planAmount.'/Post]';
                                    $planClass = "btn-plans p4";
                                    $targetModal = "#singleModal";
                                }
                                ?>
                                <a class="pull-right " href="#" data-toggle="popover" data-placement="top" title="" data-content="<?php echo $yrlyVal?>">
                                    <i class="fa fa-exclamation-circle excl fa-2x" title="Read More"></i>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12" >
                                <button type="button"  class="<?php echo $planClass?>" data-toggle="modal" data-target="<?php echo $targetModal?>"><?php echo $yrlyVal?></button>
                            </div>
                        </div>
                        
                        <?php    
                        }
                        ?>
                   

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
    function disp_payment(plan_id)
    {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() ?>Trader/payment_options',
            data: {'plan_id': plan_id},
            success: function (data)
            {


                if (data == 'success')
                    location.href = '<?php echo base_url() ?>Trader/fetch_payment_options';
                //console.log(data);return false;

            }
        });
        //location.href='<?php echo base_url() ?>Trader/payment_options';
    }
    $(document).ready(function ()
    {
        $("#btnyrlyplan").click(function ()
        {


            var myurl = '<?= base_url(); ?>pay_options/';
            var plan_type = 'Yearly Plan[AED 6000/Month]';

            $.ajax({
                type: 'POST',
                url: myurl,
                data: {'plan_type': plan_type},
                success: function (data)
                {

                    $('#select_plan_div').css('display', 'none');
                    $('#payoptions_div').css('display', 'block');
                    $('#payoptions_div').html(data);
                }
            });

        });
        $("#btnmnthly").click(function ()
        {

            var myurl = '<?= base_url(); ?>pay_options/';
            var plan_type = 'Monthly Plan[AED 1000/Month]';

            $.ajax({
                type: 'POST',
                url: myurl,
                data: {'plan_type': plan_type},
                success: function (data)
                {
                    $('#select_plan_div').css('display', 'none');
                    $('#payoptions_div').css('display', 'block');
                    $('#payoptions_div').html(data);
                }
            });

        });
        $("#btnyrlylim").click(function ()
        {

            var myurl = '<?= base_url(); ?>pay_options/';
            var plan_type = 'Yearly Limited Plan[30 Post]';

            $.ajax({
                type: 'POST',
                url: myurl,
                data: {'plan_type': plan_type},
                success: function (data)
                {
                    $('#select_plan_div').css('display', 'none');
                    $('#payoptions_div').css('display', 'block');
                    $('#payoptions_div').html(data);
                }
            });

        });
        $("#btnsinglepost").click(function ()
        {

            var myurl = '<?= base_url(); ?>pay_options/';
            var plan_type = 'Single Post[AED 100/Post]';

            $.ajax({
                type: 'POST',
                url: myurl,
                data: {'plan_type': plan_type},
                success: function (data)
                {
                    $('#select_plan_div').css('display', 'none');
                    $('#payoptions_div').css('display', 'block');
                    $('#payoptions_div').html(data);
                }
            });

        });

    });
    $(document).ready(function () {
        $('[data-toggle="popover"]').popover();
    });
</script>
