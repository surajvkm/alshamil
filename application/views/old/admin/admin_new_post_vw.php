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
                <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/custom/new-post.css">      
                <div class="col-main">
                        <div class="col-12">
                            <!-- -------- Title -------- -->
                            <h4 class="page-title mt-4 mb-4 pb-2 pt-2">New post</h4>

                            <div class="row">
                                <div class="col-12 px-1 px-sm-3 px-md-3">
                                <?php if(isset($result)) {
                foreach($result as $row) {
                ?>
                                    <!-- ------ One Single Row of Data ------ -->
                                    <div class="h-87 bg-newPost p-2 ml-1 mr-1 mb-2 overflow-hidden">
                                        <div class="col-12 p-0">
                                            <div class="row h-77">
                                                <!-- Product Image -->
                                                <div class="col-2 px-lg-3 pr-0">
                                                    <img class="productImage" src="<?php echo $row->Image;?>" alt="">
                                                </div>

                                                <!-- Product Details -->
                                                <div class="col-lg-3 col-md-4 col-sm-4 col-3 mt-lg-3 mb-lg-3 vbr px-lg-3 px-1 px-md-2 pt-md-2 pt-sm-2 pt-lg-0">
                                                    <!-- Name -->
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-4 col-3 pl-lg-3 pl-md-2 pr-md-0 pr-lg-3 text-md-right">
                                                            <span class="newPost-label textresize">Product</span>
                                                        </div>
                                                        <div class="col-lg-9 col-md-8 col-sm-9 col-8 px-md-3 px-sm-3 pl-4 pr-0">
                                                            <span class="newPost-data textresize"><?php  echo ucfirst($row->Brand." ". $row->Model); ?></span>
                                                        </div>
                                                    </div>

                                                    <!-- Price -->
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-4 col-3 pl-lg-3 pl-md-2 text-md-right pr-0 pr-md-3 pl-3">
                                                            <span class="newPost-label textresize">Price</span>
                                                        </div>
                                                        <div class="col-lg-9 col-md-8 col-sm-9 col-8 pr-md-3 pr-sm-3 pr-0 pl-3 pl-md-3 pl-sm-3">
                                                            <span class="newPost-data textresize"><?php echo ($row->CallPrice==1)? 'Call for price':'AED '.$row->Price; ?></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- User Image -->
                                                <div class="col-1 text-right pt-lg-1 ml-lg-3 mr-2 pl-md-1 pl-lg-3 pl-1 pt-2">
                                                   
                                                    <?php if(isset($row->traderImage)) { 
                                    ?>
                     
                                    <img src="<?php echo $row->traderImage;?>" class="userImage" >
                                    <?php 
                                }
                                else {
                                    echo '<img src="'.base_url()."/uploads/images/noimage.png".' class="userImage"  ';
                                } 
                                ?>
                                                </div>

                                                <!-- User Details -->
                                                <div class="col-3 pt-lg-2 pl-lg-1 mr-lg-5 pl-sm-4 ml-3 ml-md-0 pl-3 pr-0 pr-md-3 pt-2">
                                                    <p class="mb-0 text-s13 textresize text-orange text-semibold"><?php echo ucfirst($row->traderFullName); ?></p>
                                                    <p class="mb-0 text-s12 textresize text-semibold" style="color: #5C5C5C;"><?php echo ucfirst($row->traderLocation); ?></p>
                                                    <p class="mb-0 text-s12 textresize text-semibold" style="color: #767676;">Posted on <?php echo ucfirst($row->publishedOn); ?></p>
                 
                                                </div>

                                                <!-- View Button -->
                                                <div class="col-lg-2 col-md-1 col-1 pt-3 px-md-0 px-lg-3 pl-0">
                                                    <a href="<?php echo base_url().'admin/Dashboard/post_details/'.$row->postID?>">
                                                        <button class="btn btn-orange btn-view text-s14">View</button>
                                                    </a>
                                                </div>
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

                


        </div>  <!-- ---- B Main Div ends here ---- -->
    </div>
</div><!-- end row 1-->  
</div>

<?php
$this->view('admin/admin_footer'); 
?>




<script>
    $(document).ready(function() {
        $('.ad_newpost_viewbtn').click(function() {
            location.href='<?php echo base_url()?>admin/Dashboard/post_details';
        });
    });
</script>