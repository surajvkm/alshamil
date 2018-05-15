<?php

class Data_mdl extends CI_Model
{
    
    function __construct()
  {
    parent::__construct();
    $this->load->database();
    
  }
  
  function get_all($table)
  {     
        $this->db->select("*");  
        $result=$this->db->get($table);
      if(!empty($result))return $result->result();
      else return 0 ; 
   }
   function get_by($table,$where)
  {     
      
        $this->db->select("*");  
        $this->db->where($where);  
        $result=$this->db->get($table);
        if(!empty($result))return $result->result();
      else return 0 ; 
   }
 
   function get_by_page($table,$where=array(),$offset,$per_page_cnt)
   {     
        //$where=(!empty($per_page_cnt)&&!empty($offset)) ? 'limit '.$per_page_cnt.' offset '.$limit : "";
         $this->db->select("*");  
         //$this->db->where($where);  
         $result=$this->db->get($table,$offset,$per_page_cnt);
         if(!empty($result))return $result->result();
       else return 0 ; 
    }
    function update($data=array(),$where,$table)
    {
        $this->db->where($where);  
        if($this->db->update($table, $data))return 1;
        else return 0 ; 
     }
     function result_val($result)
    {
        foreach($result as $row)
            {
                $array[] = $row['modelName']; // add each user id to the array
            }
        return $array;  
     }
     function get_all_by($table,$where=array(),$like=array(),$offset,$per_page_cnt,$join=array(),$select=NULL,$order_by=NULL)
     {     
         if(!empty($join)){
            foreach($join as $key=>$value){
                $this->db->join($key, $value,"left outer");
              }
         }
          //$where=(!empty($per_page_cnt)&&!empty($offset)) ? 'limit '.$per_page_cnt.' offset '.$limit : "";
          !empty($select)?$this->db->select($select):$this->db->select("*");  
           if(!empty($like)){
           foreach($like as $key=>$value){
              $this->db->like($key, $value, 'none'); 
             }
            }
            if(!empty($where)){
                foreach($where as $key=>$value){
                   $this->db->where($key, $value); 
                  }
            }
            if(!empty($order_by)){
                
                $this->db->order_by($order_by['key'], $order_by['order']); 
            }
           //$this->db->where($where);  
           $result=$this->db->get($table,$offset,$per_page_cnt);
           if(!empty($result))return $result->result();
         else return 0 ; 
      }
      function get_all_by_fields($table,$where=array(),$like=array(),$offset,$per_page_cnt,$join=array(),$select)
      {     
        $this->db->distinct();
                 if(!empty($select)){
        $this->db->select($select);
        }
          if(!empty($join)){
             foreach($join as $key=>$value){
                 $this->db->join($key, $value,"left outer");
               }
          }
           //$where=(!empty($per_page_cnt)&&!empty($offset)) ? 'limit '.$per_page_cnt.' offset '.$limit : "";
            //$this->db->select("*");  
            if(!empty($like)){
            foreach($like as $key=>$value){
               $this->db->like($key, $value, 'none'); 
              }
             }
             if(!empty($where)){
                foreach($where as $key=>$value){
                   $this->db->where($key, $value); 
                  }
                 }
            //$this->db->where($where);  
            $result=$this->db->get($table,$offset,$per_page_cnt);
            if(!empty($result))return $result->result();
          else return 0 ; 
       }
       function get_all_by_fields_subqry($table,$where=array(),$like=array(),$offset,$limit,$join=array(),$select,$sbqry)
      { 
        $this->db->distinct();
        if(!empty($select)){
        $this->db->select($select);
        }
        if(!empty($join)){
            foreach($join as $key=>$value){
                $this->db->join($key, $value,"left outer");
            }
        }
        //$where=(!empty($per_page_cnt)&&!empty($offset)) ? 'limit '.$per_page_cnt.' offset '.$limit : "";
        //$this->db->select("*");  
        if(!empty($like)){
        foreach($like as $key=>$value){
            $this->db->like($key, $value, 'none'); 
            }
            }
            if(!empty($where)){
            foreach($where as $key=>$value){
                $this->db->where($key, $value); 
                }
                }
                    //$this->db->where($where);  
            $result=$this->db->get($table,$offset,$limit);
            if(!empty($result))return $result->result();
            else return 0 ; 



        $this->db->select('id')->from('employees_backup');
        $subQuery =  $this->db->get_compiled_select();
 
// Main Query
        $this->db->select('*')
                ->from('employees')
                ->where("id IN ($subQuery)", NULL, FALSE)
                ->get()
                ->result();
            }

    function get_count_by($table,$where=array(),$like=array(),$join=array(),$select=NULL)
            {     
                if(!empty($join)){
                   foreach($join as $key=>$value){
                       $this->db->join($key, $value,"left outer");
                     }
                }
                 //$where=(!empty($per_page_cnt)&&!empty($offset)) ? 'limit '.$per_page_cnt.' offset '.$limit : "";
                 !empty($select)?$this->db->select($select):$this->db->select("count(*) as total");  
                  if(!empty($like)){
                  foreach($like as $key=>$value){
                     $this->db->like($key, $value, 'none'); 
                    }
                   }
                   if(!empty($where)){
                       foreach($where as $key=>$value){
                          $this->db->where($key, $value); 
                         }
                   }
                  //$this->db->where($where);  
                  $result=$this->db->get($table);
                  if(!empty($result))return $result->result();
                else return 0 ; 
             }
        
}
?>