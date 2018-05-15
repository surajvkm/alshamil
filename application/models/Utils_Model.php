<?php

class Utils_Model extends CI_Model {
	
	function emailchecking($email) {
        $this->db->select('email');
        $this->db->from('trader');
        $this->db->where('email', $email);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows()) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    
    function imageUpload($config , $field){
    	
		$this->load->library('upload');
		$this->upload->initialize($config);
		if ($this->upload->do_upload($field)) {  
                $uploadData = $this->upload->data();
                $prof_img = $uploadData['file_name'];
            } else {
            	
                $prof_img = 'noimage.png';
        }
		
		
		return $prof_img;
	}
public function upload_files($files,$config,$last_post_id,$traderid){
$config['overwrite']     = FALSE;
$this->load->library('upload', $config);
$datam=array();
 $datamx=array();
$file_size= count($_FILES['txtfiles']['name']);


for($i=0; $i< $file_size; $i++){   
        
        $_FILES['txtfiles']['name']= $files['txtfiles']['name'][$i];
        $_FILES['txtfiles']['type']= $files['txtfiles']['type'][$i];
        $_FILES['txtfiles']['tmp_name']= $files['txtfiles']['tmp_name'][$i];
        $_FILES['txtfiles']['error']= $files['txtfiles']['error'][$i];
        $_FILES['txtfiles']['size']= $files['txtfiles']['size'][$i];    
        $fileName = $_FILES['txtfiles']['name'];
        
        
        if($fileName!='' && $fileName !=NULL){
			
		
        $config['file_name'] = $fileName;
        $this->upload->initialize($config);
        if($this->upload->do_upload('txtfiles')){
			$datam =array('productImage'=>base_url().$config['upload_path'].$fileName,'productId'=>$last_post_id,'traderId'=>$traderid);
		}else{
			$datam =array('productImage'=>base_url().$config['upload_path'].'noimage.png','productId'=>$last_post_id,'traderId'=>$traderid);
		}
        	
        	
        	$datamx[] = $datam;
        }
        
        
        
  }
  


    return $datamx;
}
	
	
    function fetch_plan($plan_id) {
    	$this->db->where('planId',$plan_id);
        $qry = $this->db->get('subscriptionplan');
        return $qry->row();
    }

    function check_subplan_exist($trader_id) {
        $qry = $this->db->get_where('tradersubscription',array('traderId'=>$trader_id));
        return $qry->num_rows();
    }
	
	function get_office_loc() {
        $qry = $this->db->get('alshamillocation');
        return $qry;
    }
    public function up_paystatus($trader_id , $chosen) {

        $this->db->query('update tradersubscription set paymentTypeChosen = ' . $chosen .' where traderId=' . $trader_id);
    }
    
     public function trader_plan_amts($trader_id) {

        $this->db->where('ts.traderId',$trader_id);
        $this->db->select('sp.amount as samount');
        $this->db->join('subscriptionplan sp','sp.planId=ts.planId');
        $qry = $this->db->from('tradersubscription ts');
        return $qry->get();
    }
    
    
   public function paginate($url,$total_row,$per_page='18', $segment = '3') {
   	
  
   	
            $config['base_url'] = $url;
            $config["total_rows"] = $total_row;
            $config["per_page"] = $per_page;
            $config["uri_segment"] = $segment;
            $config['use_page_numbers'] = TRUE;
            $config["num_links"] = 3;
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = false;
            $config['last_link'] = false;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous Page';
            $config['prev_tag_open'] = '<li class="prev">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next Page';
            $config['next_tag_open'] = '<li class="next">';
            $config['next_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
   	
   	        return $this->pagination->create_links();
   	        
   	        
   }
   
   
    public function sendmail($data) {
    	
    	
    	
		$config = array(
    	'protocol'  => 'smtp',
    	'smtp_host' => 'ssl://smtp.example.com',
    	'smtp_port' => 465,
    	'smtp_user' => 'email@example.com',
    	'smtp_pass' => 'email_password',
    	'mailtype'  => 'html',
    	'charset'   => 'utf-8'
			);
		$this->email->initialize($config);
		$this->email->set_mailtype("html");
		$this->email->set_newline("\r\n");
    	
    	
    	
    	
    	$htmlContent = '<h1>Sending email via SMTP server</h1>';
		$htmlContent .= '<p>'.$data['message'].'</p>';

		$this->email->to('recipient@example.com');
		$this->email->from($data['frommail'],$data['fromname']);
		$this->email->subject($data['subject']);
		$this->email->message($htmlContent);
		 
		return $this->email->send();
    	
    	
    	
    	
    }
    
    function get_id_forname($name){
		
		$title = strtolower(str_replace("-",' ',$name));
		$string = preg_replace('/\s+/', '', $title); 
		$val = $string.'';
		$this->db->select('CategoryId as catid');
        $this->db->where('LOWER(REPLACE(Name, " ", ""))=',$val);
		$qury = $this->db->get('category');
		

		return $qury->row()->catid;
		
	}
   

}	