<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class LanguageSwitcher extends CI_Controller
{
    public function __construct() { 
        parent::__construct();     
    }
 
    function switchLang($language = "") {
        
        $language = ($language != "") ? $language : "english";
        $this->session->set_userdata('site_lang', $language);
        
        
        $this->load->library('user_agent');
		$refere = $this->agent->referrer();
        
        redirect($refere,'location',301);
       
      
    }
}