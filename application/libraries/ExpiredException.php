<?php
namespace Firebase\JWT;

class ExpiredException extends \UnexpectedValueException
{
    function __construct() {
        try {
          
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        } finally {
            
            header("HTTP/1.1 300 OK");
            header("Content-type:application/json");
            echo json_encode(array('result'=>300,'message'=>'Token expired'));
            exit;
        }
    }
}
