<?php
class Public_Controller extends MY_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->library('pagination');
    echo 'This is from public controller';
  }
}