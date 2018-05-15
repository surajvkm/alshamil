<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>

<html lang="en">
<head>
<?php $this->load->view('client/includes');


?>

</head>
<body>
<header>
<?php  $this->load->view('client/header'); ?>	
</header>
<div>
<?php  $this->load->view('client/'.$page); ?>	
</div>	
<?php $this->load->view('client/footer');  ?>		
</body>
</html>