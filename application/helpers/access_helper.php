<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function is_allowed() {

$CI = get_instance();
$user =  $CI->session->userdata('logged_in');
$isActive = isset($user['isActive'])?$user['isActive']:0;
$isTrader = isset($user['txtusertype'])?$user['txtusertype']:0;

if ( $isTrader ) { 

   
    return true;
    
} 
 else { 
 
    $url=base_url();
    echo "<script>window.location = '$url'</script>";
    die();
   
 }
} 




?>