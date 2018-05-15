<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Alshamil';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

define('EXT', '.php');

require_once( BASEPATH .'database/DB'.EXT );
$db =& DB();
$db->select('Name,CategoryId');
$db->where('parentCategory','');
$query = $db->get( 'category' );

if($query){
	$result = $query->result();

foreach( $result as $row )
{
	  $title = strtolower(str_replace(" ",'-',$row->Name));
      $route[$title]        			 					 	= 'alshamil/viewlisting'; 
      $route[$row->Name.'/'.$row->CategoryId ]        			= 'alshamil/viewlisting'; 
      $route[$title.'/(:num)' ]         						= 'alshamil/viewlisting'; 
      $route[$title.'/(:num)/(:num)' ]      					= 'alshamil/viewinfo/$1/$2'; 
 
}

}
$db->select('category.Name,product.productTitle');
$db->distinct();
$db->join( 'product' ,'product.productCategoryId=category.CategoryId');
$query = $db->get( 'category' );

if($query){
$secondTitle= $query->result();

foreach( $secondTitle as $row )
{
	
	  $title = strtolower(str_replace(" ",'-',rtrim($row->Name)));
	  $product_title 								 = strtolower(str_replace(" ",'-',rtrim($row->productTitle)));
	   $route[$title.'/'.$product_title ]            = 'alshamil/viewlisting'; 
      $route[$title.'/'.$product_title.'_(:any)' ]   = 'alshamil/viewinfo/$1/$2'; 
      
     
 
}
}

$route['traderinfo']                             = 'alltraders'; 
$route['traderinfo'.'/(:num)' ]        			 = 'traderinfo/viewinfo/$1'; 
$route['traderinfo'.'/(:num)/(:num)' ]           = 'traderinfo/viewinfo/$1/$2'; 
$route['search']                                  = 'searchinfo/search'; 





$route['api/example/users/(:num)'] = 'api/example/users/id/$1'; // 
$route['api/example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/example/users/id/$1/format/$3$4'; // 
