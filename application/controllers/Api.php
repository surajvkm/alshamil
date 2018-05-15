<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@project 				: Alshamil
@project Module 		: API 
@developrt				: Arun Vasanth Samraj 
@lastmodification date	: 15-05-2018
@controller 			: API

*/
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';
require_once APPPATH . '/libraries/JWT.php';
use \Firebase\JWT\JWT;
/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Api extends REST_Controller {

    function __construct() {

        // Construct the parent class
        parent::__construct();
        
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        // if($this->router->method=='register'||$this->router->method=='login'){
            
        // }else{
        //     $this->user_ID=$this->setID()->id;
        // }
        
         $this->load->Model('Api_Model','apim');
          if($this->router->method=='GetFavourites'||$this->router->method=='updateUser'||$this->router->method=='checkout'){
            $this->user_ID=$this->setID()->id;
            $_POST['userId']=$this->setID()->id;
        }
    }
    
    function setID() {
        $token=$this->input->get_request_header('token');
        $decoded = JWT::decode($token, $this->config->item('key'), array('HS256'));
        if(isset($decoded)){
            return $decoded;
        }else{
            $this->response(array('result'=>100,'message'=>'Invalid Token'), REST_Controller::HTTP_OK);
        }
        
    }
    
    function GetCategoriesMetaData_get(){
	
	
	
	
	$data = $this->apim->get_category_meta();
		
	if ($data) {
          $this->response($data, REST_Controller::HTTP_OK); 
      } else {
          $this->response([], REST_Controller::HTTP_BAD_REQUEST); 
      }	
		
		
	}
    
    
    
    
}