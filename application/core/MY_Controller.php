<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class MY_Controller extends CI_Controller
{
  protected $data = array();
  function __construct()
  {
    parent::__construct();
    $this->data['pagetitle'] = 'Alshamil';
  }
 
  protected function render()
  {
    $this->load->view('templates/master_view', $this->data);
  }
}
 
class Admin_Controller extends MY_Controller
{
  function __construct()
  {
    parent::__construct();
  }
}
 
class Public_Controller extends MY_Controller
{
  function __construct()
  {
    parent::__construct();
  }
}