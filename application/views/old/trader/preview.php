<html lang="en">

    <head>
        <title>Alshamil</title>
        <meta charset="utf-8">
        <meta name="description" content="Alshamil">
        <meta name="author" content="silveroaktechnovations" />
        <meta name="keywords" content="plus, html5, css3, template, ecommerce, e-commerce, bootstrap, responsive, creative" />
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">

        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!--Favicon-->
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
        <link rel="icon" href="img/favicon.ico" type="image/x-icon">

        <!-- css files -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/owl.carousel.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/owl.theme.default.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/animate.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/swiper.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/datepicker.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/sweetalert.css" />

        <!--script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script-->

        <!-- this is default skin you can replace that with: dark.css, yellow.css, red.css ect -->
        <link id="pagestyle" rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/default.css" />

        <!-- Google fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800&amp;subset=latin-ext" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/font-awesome.css" />
        
<!--        <meta property="og:image" content="http://alshamil.silveroaktechnovations.com/uploads/product_images/property-default.jpg" />-->

    </head>
    <body>
<?php 
 if($cat_id == 1){ $c = 'car_category_details';}
if($cat_id == 2){ $c = 'bike_category_details';}
if($cat_id == 3){ $c = 'show_noplate_details';}
if($cat_id == 4){ $c = 'show_vertu_details';}
if($cat_id == 5){ $c = 'show_watch_details';}
if($cat_id == 6){ $c = 'show_mobileno_details';}
if($cat_id == 7){ $c = 'boat_category_details';}
if($cat_id == 8){ $c = 'show_iphone_details';}
if($cat_id == 9){ $c = 'property_category_details';}
?>
<div>
    <img src="<?php echo 'http://alshamil.silveroaktechnovations.com/uploads/product_images/'.$img ?>">
</div>
<script type="text/javascript">
    window.onload = function() {
        setTimeout(function() {
            window.location = "http://alshamil.silveroaktechnovations.com/Trader/<?php echo $c ?>/<?php echo $product_id ?>/<?php echo $cat_id ?>";
        }, 100);
    };
</script>
    </body>
</html>
  