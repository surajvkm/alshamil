<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function is_logged_in() {

$CI = get_instance();
$user =  $CI->session->userdata('logged_in');
if (!isset($user) || $user===NULL ) { 
    $url=base_url().'signin';
    echo "<script>window.location = '$url'</script>";
    die();
} 
 else { 
 
   return true;
 }
} 


function is_admin_logged_in() {

$CI = get_instance();
$user =  $CI->session->userdata('admin_logged_in');
if (!isset($user) || $user===NULL ) { 
    $url=base_url().'signin';
    echo "<script>window.location = '$url'</script>";
    die();
} 
 else { 
 
   return true;
 }
} 


?>