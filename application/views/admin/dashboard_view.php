<?php
$this->view('admin/admin_header'); 
?>
<!--script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="code/highstock.js"></script>
<script src="code/modules/exporting.js"></script-->

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">

                <?php
                $this->view('admin/admin_sidebar'); 
                ?>
                <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/custom/dashboard.css">      
                <div class="col-main">
                    <div class="col-lg-12 col-12">
                                    <h4 class="page-title mt-4 mb-4 pb-2 pt-2">Dashboard</h4>

                                    <div class="row">
                                            <div class="col-lg-12 col-12">

                                                <!-- -------------------- Buttons -------------------- -->
                                                <div class="row">
                                                    <div class="col-lg-12 pr-lg-3 pr-md-0 pr-2 pl-2">
                                                        <!-- Total Post Button -->
                                                        <button class="btn btn-dashGreen btn-large ml-sm-2">
                                                            <div class="col-lg-12">
                                                                <div class="row">
                                                                    <div class="col-lg-7 col-12 pr-0 pl-0 pt-1 pb-0 btn-text text-lg-left text-center text-normal">
                                                                        Total Post
                                                                    </div>
                                                                    <div class="col-lg-5 col-12 p-0 text-lg-right">
                                                                        <span class="text-s25 btn-num">
                                                                            <?php
                                                                            
                                                                           
                                                                                if(isset($total_post)) {
                                                                                    if($total_post!='') {
                                                                                        ?>
                                                                                        <span><?php echo $total_post; ?>
                                                                                    </span> 
                                                                                                    <?php
                                                                                                    }
                                                                                                    else
                                                                                                    {
                                                                                                    ?>
                                                                                                        <span>0</span>
                                                                                                    <?php
                                                                                                    }
                                                                                                }

                                                                                                else {
                                                                                                ?>
                                                                                                    <span>0</span>
                                                                                                    
                                                                                                    <?php
                                                                                                }
                                                                                                ?>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </button>

                                                        <!-- Sold Item Button -->
                                                        <button class="btn btn-dashRed btn-large">
                                                            <div class="col-lg-12 co-12">
                                                                <div class="row">
                                                                    <div class="col-lg-7 col-12 pr-0 pl-0 pt-1 pb-0 btn-text text-lg-left text-center text-normal">
                                                                        Sold Item
                                                                    </div>
                                                                    <div class="col-lg-5 col-12 p-0 text-lg-right">
                                                                        <span class="text-s25 btn-num"> 
                                                                            <?php
                                                                                if(isset($sold_count)) {
                                                                                    if($sold_count!='') {
                                                                                    ?>
                                                                                        <span><?php echo $sold_count; ?></span>
                                                                                    <?php
                                                                                    }
                                                                                    else {
                                                                                    ?>
                                                                                        <span>0</span>
                                                                                    <?php
                                                                                    }
                                                                                }
                                                                                else {
                                                                                    ?>
                                                                                        <span>0</span>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                    </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </button>

                                                        <!-- Watch list Button -->
                                                        <button class="btn btn-dashGrey btn-large">
                                                            <div class="col-lg-12">
                                                                <div class="row">
                                                                    <div class="col-lg-7 col-12 pr-0 pl-0 pt-1 pb-0 btn-text text-lg-left text-center text-normal">
                                                                        Watch list
                                                                    </div>
                                                                    <div class="col-lg-5 col-12 p-0 text-lg-right">
                                                                        <span class="text-s25 btn-num"> 
                                                                            <?php
                                                                                if(isset($watchlist_count)) { 
                                                                                    if($watchlist_count!='') {
                                                                                    ?>
                                                                                        <span><?php echo $watchlist_count; ?></span>
                                                                                    <?php
                                                                                    }
                                                                                    else {
                                                                                    ?>
                                                                                        <span>0</span>
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                                else {
                                                                                ?>
                                                                                    <span>0</span>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </button>

                                                        <!-- Booked Button -->
                                                        <button class="btn btn-dashOrange btn-large">
                                                            <div class="col-lg-12">
                                                                <div class="row">
                                                                    <div class="col-lg-7 col-12 pr-0 pl-0 pt-1 pb-0 btn-text text-lg-left text-center text-normal">
                                                                        Booked
                                                                    </div>
                                                                    <div class="col-lg-5 col-12 p-0 text-lg-right">
                                                                        <span class="text-s25 btn-num"> 
                                                                            <?php
                                                                        if(isset($booked)) {
                                                                            if($booked!='') {
                                                                                ?>
                                                                                    <span><?php echo $booked; ?></span>
                                                                                <?php
                                                                            }
                                                                            else {
                                                                                ?>
                                                                                    <span>0</span>
                                                                                <?php
                                                                            }
                                                                        }
                                                                        else {
                                                                            ?>
                                                                                <span>0</span>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        </span>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </button>

                                                        <!-- In the Cart Button -->
                                                        <button class="btn btn-dashSalmon btn-large pl-0 pl-md-3 pr-0 pr-md-2">
                                                            <div class="col-lg-12 col-12">
                                                                <div class="row">
                                                                    <div class="col-lg-7 col-12 pr-0 pl-0 pt-1 pb-0 btn-text text-lg-left text-center text-normal">
                                                                        In the Cart
                                                                    </div>
                                                                    <div class="col-lg-5 col-12 p-0 text-lg-right">
                                                                        <span class="text-s25 btn-num"> 
                                                                            <?php
                                                                                if(isset($cart)) {
                                                                                    if($cart!='') {
                                                                                    ?>
                                                                                        <span><?php echo $cart; ?></span>
                                                                                    <?php
                                                                                    }
                                                                                    else {
                                                                                    ?>
                                                                                        <span>0</span>
                                                                                    <?php
                                                                                    }
                                                                                }
                                                                                else {
                                                                                    ?>
                                                                                        <span>0</span>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 px-md-3 px-sm-3 px-1">
                                                    <div class="row mt-3">

                                                        <!-- -------------------- Graph -------------------- -->
                                                        <div class="graphDiv">
                                                            <div class="col-lg-12 px-md-0 px-lg-3 px-2">
                                                            <div id="exTab1"> 
                                                                <ul class="ypp_graphTabList pl-md-0 pl-lg-4 text-center">
                                                                    <li class="db_graphTabs active">
                                                                        <a href="#2a" data-toggle="tab">PLAN SUMMARY</a>
                                                                    </li>
                                                                    <li class="db_graphTabs ">
                                                                        <a  href="#1a" data-toggle="tab">PRODUCT SELLING</a>
                                                                    </li>
                                                                    
                                                                </ul>
                                                            
                                                                <div class="tab-content clearfix">
                                                                    <div class="tab-pane " id="1a">
                                                                        <ul class="ypp_graphTabSubList text-md-left text-lg-center">
                                                                            <li class="db_graphSubTabs active">
                                                                                <a class="border-none" href="#allSold" data-toggle="tab">All</a>
                                                                            </li>
                                                                            <li class="db_graphSubTabs">
                                                                                <a  href="#alshamil" data-toggle="tab">Alshamil</a>
                                                                            </li>
                                                                            <li class="db_graphSubTabs">
                                                                                <a href="#traders" data-toggle="tab">Traders</a>
                                                                            </li>
                                                                        </ul>
                                                                        <div class="tab-content clearfix">
                                                                            <div class="tab-pane active" id="allSold">
                                                                                <div id="all_sold"></div>
                                                                            </div>
                                                                    
                                                                            <div class="tab-pane" id="alshamil">
                                                                                <div id="alshamil_sold"></div>
                                                                            </div>
                                                                            <div class="tab-pane" id="traders">
                                                                                <div id="traders_sold"></div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- <div id="payment"></div> -->
                                                                        <div class="db_graph_bottomDiv">
                                                                            <div class="col-md-5 text-left">
                                                                                <p class="font-size-12 mb-0 line-height-1 text-darkGrey">Total Amount</p>
                                                                                <p class="text-bold font-size-17 font-black mb-0">AED <?= $order_amount;  ?></p>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <p class="font-size-12 mb-0 line-height-1 text-darkGrey">Average</p>
                                                                                <p class="text-bold font-size-17 font-black mb-0">AED <?= round($average,3);  ?></p>
                                                                                
                                                                            </div>
                                                                            <div class="col-md-3 text-right">
                                                                                <!-- <p class="font-size-12 mb-0 line-height-1 text-darkGrey">Percentage</p>
                                                                                <p class="text-bold font-size-17 font-black mb-0 pr-28">68%</p>  -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="tab-pane active" id="2a">
                                                                        <ul class="ypp_graphTabSubList text-center">
                                                                            <li class="db_graphSubTabs active">
                                                                                <a class="border-none" href="#all" data-toggle="tab">All</a>
                                                                            </li>
                                                                            <li class="db_graphSubTabs">
                                                                                <a  href="#yearlpln" data-toggle="tab">Yearly</a>
                                                                            </li>
                                                                            <li class="db_graphSubTabs">
                                                                                <a href="#monthpln" data-toggle="tab">Monthly</a>
                                                                            </li>
                                                                            <li class="db_graphSubTabs">
                                                                                <a href="#yearlimt" data-toggle="tab">Yearly Limited</a>
                                                                            </li>
                                                                            <li class="db_graphSubTabs">
                                                                                <a href="#indilimt" data-toggle="tab">Individuals</a>
                                                                            </li>
                                                                        </ul>
                                                                    
                                                                        <div class="tab-content clearfix">
                                                                            <div class="tab-pane active" id="all">
                                                                                <div id="all_plan"></div>
                                                                            </div>
                                                                    
                                                                            <div class="tab-pane" id="yearlpln">
                                                                                <div id="yearly_plan"></div>
                                                                            </div>
                                                                            <div class="tab-pane" id="monthpln">
                                                                                <div id="monthly_plan"></div>
                                                                            </div>
                                                                            <div class="tab-pane" id="yearlimt">
                                                                                <div id="yearly_limit"></div>
                                                                            </div>
                                                                            <div class="tab-pane" id="indilimt">
                                                                                <div id="indi_limit"></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row db_graph_bottomDiv">
                                                                            <div class="col-md-5 col-sm-5 col-4 px-md-3 px-sm-3 px-0 text-left">
                                                                                <p class="font-size-12 mb-0 line-height-1 text-darkGrey">Total Amount</p>
                                                                                <p class="text-bold font-size-17 btn-text font-black mb-0">AED <?= $total_plan_amount;  ?></p>
                                                                            </div>
                                                                            <div class="col-md-4 col-sm-4 col-4 px-lg-3 px-md-0 px-sm-3 px-2">
                                                                                <p class="font-size-12 mb-0 line-height-1 text-darkGrey">Average</p>
                                                                                <p class="text-bold font-size-17 btn-text  font-black mb-0">AED <?= round($avg_plan_amount,3);  ?></p>
                                                                                
                                                                            </div>
                                                                            <div class="col-md-3 col-sm-3 col-4  px-md-3 px-sm-3 px-0 text-right">
                                                                                <!-- <p class="font-size-12 mb-0 line-height-1 text-darkGrey">Percentage</p>
                                                                                <p class="text-bold font-size-17 btn-text font-black mb-0 pr-28">68%</p>  -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>          
                                                                <!-- /.row -->
                                                            </div>
                                                        </div>
                                                        <!-- /.graphDiv -->

                                                        <!-- -------------------- Traders List -------------------- -->
                                                        <div class="traderDiv mt-3 mt-md-0 mt-sm-0">
                                                            <div class="col-lg-12">

                                                                <!-- Headings -->
                                                                <div class="row">
                                                                    <div class="col-lg-6 col-6 pr-0 pt-3 pl-lg-3 pl-1">
                                                                        <h6 class="text-uppercase text-orange text-resize text-trader">Top Traders</h6>
                                                                    </div>

                                                                    <!-- Link -->
                                                                    <div class="col-lg-6 col-6 pl-0 pt-lg-3 pt-2 text-right pr-md-3 pr-sm-2 pr-1">
                                                                        <a class="text-s16 text-orange text-semibold text-resize text-trader" href="<?php echo base_url('admin/all_traders')?>" >View all</a>
                                                                    </div>
                                                                </div>

                                                                <!-- Trader List -->
                                                                <div class="row">

                                                                    <?php
                                                                    
                                                                   
                                                                    foreach ($trader as $result) {
                                                                       
                                                                    ?>
                                                                        <div class="col-lg-12 mt-3 scaleDiv">
                                                                                <a href="<?php echo base_url()?>admin/plan_profile/<?php echo $result->traderID.'/'.$result->planID;?>">
                                                                                    <div class="row">

                                                                                            <!-- User Image -->
                                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-2 pl-lg-2 pl-0 pr-md-3 pr-sm-3 pr-0">
                                                                                                    <?php
                                                                                                    if($result->image != '') {
                                                                                                    ?>
                                                                                                        <!-- top_trimg -->
                                                                                                        <!-- <img src="<?php echo  $result->traderImage; ?>" class="traderImage"/> -->
                                                                                                        <img class="userImageD" src="<?= $result->image;?>" alt="">
                                                                                                        <!-- // TODO : Remove hardcoded Image -->
                                                                                                                            <?php
                                                                                                    }
                                                                                                    else {
                                                                                                    ?>
                                                                                                    <img class="userImageD" src="<?php echo base_url();?>/assets/images/user/user2.jpg" alt="">
                                                                                                        <!-- top_trimg -->
                                                                                                        <?php
                                                                                                    }
                                                                                                    ?>
                                            
                                                                                            </div>

                                                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-10 pl-lg-3 pl-md-2 user-padding">
                                                                                                <div class="row">
                                                                                                    <!-- User Details -->
                                                                                                    <div class="col-lg-8 col-8 pr-0 pl-1 pt-lg-2 pt-md-0 pt-sm-0 pt-2">
                                                                                                        <p class="mb-0 text-s13 textresize text-adjust text-semibold pl-sm-2 pl-md-3 pl-lg-0 pl-1" style="color: #535353;"><?php echo $result->fullName;?></p>
                                                                                                        <p class="mb-0 text-s12 textresize text-adjust text-semibold pl-sm-2 pl-md-3 pl-lg-0 pl-1" style="color: #535353;"><?php echo $result->location;?></p>
                                                                                                    </div>

                                                                                                    <!-- Post Number -->
                                                                                                    <div class="col-lg-4 col-4 pt-lg-2 pl-lg-3 pl-2 postnumber-padding">
                                                                                                        <p class="mb-0 text-s13 textresize text-adjust text-semibold pl-md-0 pl-sm-0 pl-4" style="color: #535353;"><?php echo $result->postCount;?></p>
                                                                                                        <p class="mb-0 text-s13 textresize text-adjust text-semibold pl-md-0 pl-sm-0 pl-4" style="color: #535353;">Post</p>
                                                                                                    </div>
                                                                                                </div>

                                                                                                <!-- hr -->
                                                                                                <div class="row">
                                                                                                    <div class="col-lg-12 pl-0">
                                                                                                        <hr class="mb-0 mt-lg-1 mt-md-2">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                    </div>
                                                                                </a>
                                                                            </div>
                                                                    <?php 
                                                                    }
                                                                    ?> 




                                                                    <!-- Single User -->
                                                            

                                                        
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                        <!-- /.traderDiv -->
                                                    </div>
                                                </div>

                                            </div>
                                    </div>
                </div>
            </div>

                


        </div>  <!-- ---- B Main Div ends here ---- -->
    </div>
</div><!-- end row 1-->  
</div>

<?php
$this->view('admin/admin_footer'); 
?>

<script type="text/javascript" src="<?php echo base_url()?>js/jquery-3.1.1.min.js"></script>
       
       <script type="text/javascript" src="<?php echo base_url()?>js/jquery-ui.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>js/bootstrap.min.js"></script>
       <script type="text/javascript" src="<?php echo base_url()?>js/canvas.min.js"></script>

    <script >
        window.onload = function () {
            var sold_counts = <?php if(isset($sold))echo json_encode($sold); ?>;
            plotchart(sold_counts,'all_sold');
            var alshamil_sold = <?php echo json_encode($alshamil_sold); ?>;
            plotchart(alshamil_sold,'alshamil_sold');
            var trader_sold = <?php echo json_encode($trader_sold); ?>;
            plotchart(trader_sold,'traders_sold');
            var yearly_plan_year = <?php echo json_encode($yearly_plan_year); ?>;
            plotchart(yearly_plan_year,'yearly_plan');
            var monthly_plan = <?php echo json_encode($monthly_plan); ?>;
            plotchart(monthly_plan,'monthly_plan');
            var yearlyLimit_plan = <?php echo json_encode($yearlyLimit_plan); ?>;
            plotchart(yearlyLimit_plan,'yearly_limit');
            var individualLimit_plan = <?php echo json_encode($individualLimit_plan); ?>;
            plotchart(individualLimit_plan,'indi_limit');
            var all_plan = <?php echo json_encode($all_plan); ?>;
            plotchart(all_plan,'all_plan');
            console.log("Dashboard");
            function plotchart(data,id){
                var sold_counts = JSON.stringify(data);
                var tabDatas = JSON.parse(sold_counts);
                var finalsSold = [];
                for(var i = 0; i < tabDatas.length; i++) {
                    var firstdate = tabDatas[i].x; 
                    var res = firstdate.split('-');
                    var month =  res[1]-1;
                    console.log("--Month--"+month);
                    finalsSold.push({ 'x': new Date(res[0],month,res[2]), 'y': tabDatas[i].y });
                    console.log("-finalsSold "+id+"-" );console.log(finalsSold );
                }
                if(tabDatas.length>0) {
                var options = {
                    animationEnabled: true,
                    width:636,
                    height:336,
                    backgroundColor: "#F2F2F2",
                    border: "1px solid #999B9C",

                    axisY: {
                        valueFormatString: "",
                        labelFontWeight: "bold",
                        labelFontSize: 12,
                        suffix: "",
                        gridDashType: "solid",
                        lineColor: "#E2E2E2",
                        gridColor: "#E2E2E2",
                        gridThickness:1,
                        title:"AMOUNT"
                    },
                    axisX: {
                        labelAngle: 0,
                        labelFontWeight: "bold",
                        labelFontSize: 12,
                        lineColor: "#E2E2E2",
                        gridColor: "#E2E2E2",
                        gridThickness:1,
                        title:"DATE",
                        intervalType: "day"
                    },
                    data: [{
                        type: "area",
                        lineColor:"#F58321",
                        color:"#FED43A",
                        markerSize: 5,
                        dataPoints: finalsSold
                    }]
                };
                
                $("#"+id).CanvasJSChart(options);
                }else{
                    $("#"+id).html('<h3 style="text-align:center;">NO DATA AVAILABLE</h3>');
                }

            }

        }
    </script>
    