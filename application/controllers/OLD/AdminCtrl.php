<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

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
class AdminCtrl extends REST_Controller {

    function __construct() {

        // Construct the parent class
        parent::__construct();
        $this->load->library(array(
            'session',
            'form_validation',
            'email',
            'pagination'
        ));
        $this->load->Model('Trader_mdl');
        $this->load->Model('Admin_mdl');
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
    }
    public function index_get()
    {
      $data['trader'] = $this->Trader_mdl->get_traders_list();
        $data['post_qry']= $this->Admin_mdl->post_cnt();
        $data['sold_qry']= $this->Admin_mdl->sold_item_cnt();
        $data['wish_qry']= $this->Admin_mdl->wish_item_cnt();
        $data['cart_qry']= $this->Admin_mdl->cart_cnt();  
         if ($data) {
                    $this->response($data, REST_Controller::HTTP_OK);
                } else {
                    $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
                }
    }
    public function registers_get()
{
      $data['yearly_qry'] = $this->Admin_mdl->yearlywise_regs();
      $data['monthly_qry'] = $this->Admin_mdl->monthlywise_regs();
      $data['yearly_limqry'] = $this->Admin_mdl->yearlylim_regs();
      $data['indiv_qry'] = $this->Admin_mdl->indiv_regs();
       if ($data) {
                $this->response($data, REST_Controller::HTTP_OK);
            } else {
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
            }
}
    public function yearly_plan_get()
    {
        $data['qry'] = $this->Admin_mdl->fetch_yearlywise();
        if ($data) 
        {
                $this->response($data, REST_Controller::HTTP_OK);
            } else {
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
            }
    }
    public function monthly_plan_get()
    {
         $data['qry'] = $this->Admin_mdl->fetch_monthlywise();
        if ($data) 
        {
                $this->response($data, REST_Controller::HTTP_OK);
            } else {
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
            }
    }
    public function yearly_lim_get()
    {
        $data['qry'] = $this->Admin_mdl->fetch_yrlylim();
        if ($data) 
        {
                $this->response($data, REST_Controller::HTTP_OK);
            } else {
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
            }
    }
    public function individual_get()
    {
       $data['qry'] = $this->Admin_mdl->fetch_indivi();
        if ($data) 
        {
                $this->response($data, REST_Controller::HTTP_OK);
            } else {
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
            }
    }
}