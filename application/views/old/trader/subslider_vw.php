
<!--<link rel="stylesheet" href="<?php echo base_url() ?>subslider/demo/css/demo.css" type="text/css" media="screen" />-->
<link rel="stylesheet" href="<?php echo base_url() ?>subslider/flexslider.css" type="text/css" media="screen" />

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<!--<script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.min.js">\x3C/script>')</script>  -->
<script  src="<?php echo base_url() ?>subslider/jquery.flexslider.js"></script>
<script src="<?php echo base_url() ?>subslider/demo/js/modernizr.js"></script>




<div id="slider" class="flexslider">
    <ul class="slides">
        <li>
            <?php
  
            if ($image != '' && (@getimagesize($image))) {
                $imgMain = $image;
            } else {
                $imgMain = base_url() . 'img/no_preview.png';
            }
            ?>
            <img class="car-img" style="border-radius:6px;height: 300px" src="<?php echo $imgMain ?>" />

        </li>



        <?php
//         echo '<pre>';
//         print_r($car_img_qry);exit;
// foreach ($car_img_qry as $r) {
// }


//         $link_array = explode('/',$result->productVideo);
//     $file = end($link_array);
//     $file_det = pathinfo($file);
//    // $title = $this->Trader_mdl->getTitle($result->productID, $result->productCategoryID);
//     // if ($result->thumbImage == '') {
//     //     $poster = $this->Trader_mdl->getImage($result->productID, $result->productCategoryID);
//     // } else {
//     //     $poster = $result->thumbImage;
//     // }
//     if(isset($file_det['extension'])){

?>



<?php

foreach ($car_img_qry as $r) {
    
   
    if ($r->productImage != '' ) { // if ($r->productImage != '' && (@getimagesize($r->productImage))) {
        $img = $r->productImage;
        echo '<li><img style="border-radius:6px;height: 300px" src="'.$img.'" /></li>';
    } else if($r->productVideo != '') {
        $img = $r->productVideo;
        echo '<li><video width="549" class="slider-video" src="'.$img.'" poster="" controls></video></li>';
    }
    $count = $r->productViewCount;
}
    ?>

    </ul>
</div>
<h3 class="subslider-count">Views <br><label style="font-size: 14px; color: #fff" ><?php echo $count ?></label></h3>
<div id="carousel" class="flexslider">
    <ul class="slides">
        <li>
        <?php
        if ($image != '' ) { //if ($image != '' && (@getimagesize($image))) {
            $imgThumb1 = $image;
        } else {
            $imgThumb1 = base_url() . 'img/no_preview.png';
        }
        ?>
            <img style="border-radius:6px;max-height: 75px;" src="<?php echo $imgThumb1 ?>" />
        </li>
            <?php
          
        
        foreach ($car_img_qry as $r) {
    
   
            if ($r->productImage != '') { //  if ($r->productImage != '' && (@getimagesize($r->productImage))) {
                $img = $r->productImage;
                echo '<li><img style="border-radius:6px;max-height: 75px;" src="'.$img.'" /></li>';
            } else if($r->productVideo != '') {
                $img = $r->productVideo;
                echo '<li><video width="110" style="border-radius:6px;height: 75px; background-color: #000;" src="'.$img.'" poster="" controls></video></li>';
            }
            $count = $r->productViewCount;
        }
            ?>


    </ul>
</div>
<script>
    $(function () {
       // SyntaxHighlighter.all();
    });
    $(window).load(function () {
        // The slider being synced must be initialized first
        $('#carousel').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            itemWidth: 110,
            itemMargin: 5,

            asNavFor: '#slider'
        });

        $('#slider').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            sync: "#carousel"
        });
    });
</script>