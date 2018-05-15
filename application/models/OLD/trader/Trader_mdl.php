<?php

class Trader_mdl extends CI_Model
{
    function __construct()
  {
    parent::__construct();
    $this->load->database();
    
  }
  public function get_countries_code()
  {
      $qry = $this->db->get('countries');
      return $qry->result();
  }
  
  public function save_trader_reg()
  {
      $curr_date = date('Y-m-d');
      $newdob = date("Y-m-d",strtotime($this->input->post('txtdob')));
      $newexpdate = date("Y-m-d",strtotime($this->input->post('txtemexpdate')));
      $newpassexpdate = date("Y-m-d",strtotime($this->input->post('txtpass_exdate')));
      $data = array(
                'fname' => $this->input->post('txtfname'),
                'lname' => $this->input->post('txtlname'),
                'place' => $this->input->post('txtplace'),
                'email' => $this->input->post('txtemail'),
                'mobileno' => $this->input->post('txtmob'),
                'password' => password_hash($this->input->post('txtpassword'), PASSWORD_DEFAULT),
                'plan_type' => $this->input->post('txtplantype'),
                'plan_subscribe_time' => $curr_date,
                'dob' => $newdob,
                'emirate_no' => $this->input->post('txtemridno'),
                'em_exp_date' => $newexpdate,
                'passport_no' => $this->input->post('txtpassportno'),
                'pass_exp_date' =>  $newpassexpdate
                );
     $this->db->insert('trader_register',$data); 
  }
  /*
   * pagination
   */
    public function record_count()
    {
        return $this->db->count_all("contact_info");
    }
  public function fetch_post_data($limit, $id)
  {
        $this->db->limit($limit);
        $this->db->where('id', $id);
        $query = $this->db->get("contact_info");
        if ($query->num_rows() > 0) {
        foreach ($query->result() as $row) {
        $data[] = $row;
        }

        return $data;
        }
        return false;
   }
}

