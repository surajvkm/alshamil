<?php

class Api_Model extends CI_Model{
   
  function __construct(){
    parent::__construct();
    $this->load->database();
    
  }
  
  
  function get_category_meta(){
  	
  	$this->db->select('CategoryId,Name,type');
  	$parent = $this->db->get_where('category',array('parentCategory'=>0));
  	$datam=array(); $structure =array(); 
  	if($parent->num_rows()>0){
		
		foreach($parent->result() as $r): $sprice =array(); $sdesc =array(); $simg =array();
		$data = array('name'=>$r->Name,'Id'=>$r->CategoryId ,'type'=>$r->type);
		if($r->type==3){
		$this->db->select('CategoryId,Name');
  	    $child = $this->db->get_where('category',array('parentCategory'=>$r->CategoryId));
  	    if($child->num_rows()>0){
		foreach($child->result() as $rc):
		$structure[] = array('name'=>$rc->Name,'type'=>1 );
		endforeach;
		}else{
			$structure = array();
		}
		$sprice[] =array('name'=>'Price','type'=>3);
		$sdesc[] =array('name'=>'Description','type'=>4);
		$simg[] =array('name'=>'Image','type'=>5);
		}
		if($r->type==2){
			$structure[] = array('name'=>'Vehicle','type'=>1 );
			$structure[] = array('name'=>'Emirates','type'=>1 );
			$structure[] = array('name'=>'Code','type'=>1 );
			$structure[] = array('name'=>'Number Of Digit','type'=>1 );
			$structure[] = array('name'=>'Number','type'=>3 );
			$sprice[] =array('name'=>'Price','type'=>3);
			$sdesc[] =array('name'=>'Description','type'=>4);
		}
		
		if($r->type==1){
			$structure[] = array('name'=>'Operator','type'=>1 );
			$structure[] = array('name'=>'Prefix','type'=>1 );
			$structure[] = array('name'=>'Number','type'=>3 );
			$sprice[] =array('name'=>'Price','type'=>3);
			$sdesc[] =array('name'=>'Description','type'=>4);
		}
		
		
		
		
		$datam[] =array($data,'Structure'=>array_merge($structure,$sprice,$sdesc,$simg));
		endforeach;
		
		
		
	}
  	
  	
  	
  	
  	return array('version'=>"1.0",'data'=>$datam);
  	
  }
  
  
 }