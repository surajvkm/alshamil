<?php

class Api_mdl extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->lang = $this->session->userdata("lang");
        $lang = "en";
    }

    public function get_countries_code() {
        $qry = $this->db->get('countries');
        return $qry->result();
    }

  function uploadfile($type,$process){
        $config['upload_path'] = 'uploads/product_images/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $_FILES['image']['name'];
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('image')) {
            $uploadData = $this->upload->data();
        } else {
            $uploadData['file_name'] = 'noimage.png';
        }
        return $uploadData['file_name'];
    }

    //Get single user info
    function getUser($user_id) {
        $this->db->select('*');
        $this->db->from('trader');
        $this->db->where('TraderID', $user_id);
        $this->db->limit(1);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }
function isExists($key,$valkey,$table){
    $this->db->from($table);
    $this->db->where($key,$valkey);
    $num = $this->db->count_all_results();
    if($num == 0)
    {
        return FALSE;
    }else{
        return TRUE;
    }
}
/**** get_posts need to change code later -bbb */
function get_posts($per_page_cnt=0, $limit=9999999, $userId=NULL,$get_type=NULL,$status=NULL) {

    if($get_type){
        switch ($get_type) {
            case 1:
                $where='WHERE `post`.`postStatus`='.$status.' and post.traderID=' . $userId .' order by post.postSubmissionOn DESC  limit ' . $per_page_cnt . ' offset ' . $limit;
                break;
            case 2:
                //$results = $this->Api_mdl->get_posts($per_page_cnt, $limit, $userId,$get_type);
                $where='WHERE `post`.`postStatus`=1 and post.traderID=' . $userId .' order by post.postSubmissionOn DESC  limit ' . $per_page_cnt . ' offset ' . $limit;
                break;
            case 3:
                //$results = $this->Api_mdl->get_posts($per_page_cnt=NULL, $limit=NULL, $userId,$get_type);
                $where='WHERE post.traderID=' . $userId .'   order by post.postSubmissionOn DESC  limit ' . $per_page_cnt . ' offset ' . $limit;
                break;    
            default:
            $where='';
         
        }
    }




    $qry = $this->db->query('SELECT DISTINCT `post`.`postID`,`post`.`productCategoryID`,post.productID,post.postStatus productApprovalStatus ,
       `productcar`.`productCBrand`, `productcar`.`productCModel`,`productcar`.`productCPrice`,productcar.Cpost_main_img,productcar.productCSubmitDate,productcar.cartCType,productcar.productCStatus as productstatus,
       `productbike`.`productBBrand`, `productbike`.`productBModel`, `productbike`.`productBPrice`,productbike.Bpost_main_img,productbike.productBSubmitDate,productbike.cartBType,productbike.productBStatus as productstatus,
       `productboat`.`productBtBrand`, `productboat`.`productBtModel`,`productboat`.`productBTPrice`,productboat.BTpost_main_img,productboat.productBTSubmitDate,productboat.cartBTType,productboat.productBTStatus as productstatus, 
       `productwatch`.`productWBrand`, `productwatch`.`productWModel`, `productwatch`.`productWPrice`,productwatch.Wpost_main_img,productwatch.productWSubmitDate,productwatch.cartWType,productwatch.productWStatus as productstatus,
       `productvertu`.`productVBrand`, `productvertu`.`productVModel`,  `productvertu`.`productVPrice`,productvertu.Vpost_main_img,productvertu.productVSubmitDate, productvertu.cartVType,productvertu.productVStatus as productstatus,
       `productproperty`.`productPropSC`,   `productproperty`.`productPRPrice`,productproperty.PRpost_main_img,productproperty.productPRSubmitDate,productproperty.cartPRType,productproperty.productPRStatus as productstatus,productproperty.productPropType,  
       `productphone`.`productPBrand`, `productphone`.`productPModel`, `productphone`.`productPHPrice`,productphone.PHpost_main_img,productphone.productPSubmitDate,productphone.productPHStatus as productstatus,productphone.cartPHType,
       `productnp`.`productNPCode`, `productnp`.`productNPDigits`,  `productnp`.`productNPPrice`,productnp.NPpost_main_img,productnp.productNPSubmitDate,productnp.cartNPType,productnp.productNPStatus as productstatus,productnp.productNPNmbr,
       `productmn`.`productMNPrefix`, `productmn`.`productMNNmbr`,  `productmn`.`productMNPrice`,productmn.MNpost_main_img,productmn.productMNSubmitDate,productmn.cartMNType,productmn.productMNStatus as productstatus,productmn.productOperator
       
      
    from post
    left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
    left JOIN `productiv` ON `post`.`postID`=`productiv`.`postID`
    left JOIN `productcar` ON (`post`.`productCategoryID`=`productcar`.`productCategoryID` and post.productID=productcar.productID ) 
    left JOIN `productbike` ON( `post`.`productCategoryID`=`productbike`.`productCategoryID` and post.productID=productbike.productID)
    left JOIN `productboat` ON (`post`.`productCategoryID`=`productboat`.`productCategoryID` and  post.productID=productboat.productID)
    left JOIN `productmn` ON (`post`.`productCategoryID`=`productmn`.`productCategoryID` and post.productID=productmn.productID)
    left JOIN `productnp` ON( `post`.`productCategoryID`=`productnp`.`productCategoryID` and post.productID=productnp.productID)
    left JOIN `productphone` ON (`post`.`productCategoryID`=`productphone`.`productCategoryID`and post.productID=productphone.productID)
    left JOIN `productproperty` ON( `post`.`productCategoryID`=`productproperty`.`productCategoryID`and post.productID=productproperty.productID)
    left JOIN `productvertu` ON (`post`.`productCategoryID`=`productvertu`.`productCategoryID`and post.productID=productvertu.productID)
    left JOIN `productwatch` ON( `post`.`productCategoryID`=`productwatch`.`productCategoryID` and post.productID=productwatch.productID)
     '.$where);
   var_dump($qry->result());
   exit;
    
if(!empty($qry->result())){
    foreach ($qry->result() as $row) {
        $data['postId'] = $row->postID;
        $data['productApprovalStatus'] = $row->productApprovalStatus;
        $data['categoryId'] = $row->productCategoryID;
        $data['ProductId'] = $row->productID;


        if ($data['categoryId'] == 1) {

            $data['image'] = $row->Cpost_main_img;
            $data['is_alshamilProduct'] = $row->cartCType;
            $data['publishedOn'] = $row->productCSubmitDate;
            $data['price'] = $row->productCPrice;
            $data['tittleEn'] = $row->productCBrand . " " . $row->productCModel;
            $data['tittleAr'] = " ";

            $data['Productstatus'] = $row->productstatus;
        } else if ($data['categoryId'] == 2) {
            $data['is_alshamilProduct'] = $row->cartBType;
            $data['image'] = $row->Bpost_main_img;
            $data['publishedOn'] = $row->productBSubmitDate;
            $data['price'] = $row->productBPrice;
            $data['tittleEn'] = $row->productBBrand . " " . $row->productBModel;
            $data['tittleAr'] = "";

            $data['Productstatus'] = $row->productstatus;
        } else if ($data['categoryId'] == 3) {
            $data['is_alshamilProduct'] = $row->cartNPType;
            $data['image'] = $row->NPpost_main_img;
            $data['publishedOn'] = $row->productNPSubmitDate;
            $data['price'] = $row->productNPPrice;
            $data['tittleEn'] = $row->productNPCode . "" . $row->productNPNmbr;
            $data['tittleAr'] = "";

            $data['Productstatus'] = $row->productstatus;
        } else if ($data['categoryId'] == 4) {
            $data['is_alshamilProduct'] = $row->cartVType;
            $data['image'] = $row->Vpost_main_img;
            $data['publishedOn'] = $row->productVSubmitDate;
            $data['price'] = $row->productVPrice;
            $data['tittleEn'] = $row->productVBrand . "" . $row->productVModel;
            $data['tittleAr'] = "";

            $data['Productstatus'] = $row->productstatus;
        } else if ($data['categoryId'] == 5) {
            $data['is_alshamilProduct'] = $row->cartWType;
            $data['image'] = $row->Wpost_main_img;
            $data['publishedOn'] = $row->productWSubmitDate;
            $data['price'] = $row->productWPrice;
            $data['tittleEn'] = $row->productWBrand . "" . $row->productWModel;
            $data['tittleAr'] = "";

            $data['Productstatus'] = $row->productstatus;
        } else if ($data['categoryId'] == 6) {
            $data['is_alshamilProduct'] = $row->cartMNType;
            $data['image'] = $row->MNpost_main_img;
            $data['publishedOn'] = $row->productMNSubmitDate;
            $data['price'] = $row->productMNPrice;
            $data['tittleEn'] = $row->productOperator . "" . $row->productMNNmbr;
            $data['tittleAr'] = "";

            $data['Productstatus'] = $row->productstatus;
        } else if ($data['categoryId'] == 7) {
            $data['is_alshamilProduct'] = $row->cartBTType;
            $data['image'] = $row->BTpost_main_img;
            $data['publishedOn'] = $row->productBTSubmitDate;
            $data['price'] = $row->productBTPrice;
            $data['tittleEn'] = $row->productBtBrand . "" . $row->productBtModel;
            $data['tittleAr'] = "";

            $data['Productstatus'] = $row->productstatus;
        } else if ($data['categoryId'] == 8) {
            $data['is_alshamilProduct'] = $row->cartPHType;
            $data['image'] = $row->PHpost_main_img;
            $data['publishedOn'] = $row->productPSubmitDate;
            $data['price'] = $row->productPHPrice;
            $data['tittleEn'] = $row->productPBrand . " " . $row->productPModel;
            $data['tittleAr'] = "";

            $data['Productstatus'] = $row->productstatus;
        } else if ($data['categoryId'] == 9) {
            $data['is_alshamilProduct'] = $row->cartPRType;
            $data['image'] = $row->PRpost_main_img;
            $data['publishedOn'] = $row->productPRSubmitDate;
            $data['price'] = $row->productPRPrice;
            $data['tittleEn'] = $row->productPropType . "" . $row->productPropSC;
            $data['tittleAr'] = "";

            $data['status'] = $row->productstatus;
        } else {
            $data['is_alshamilProduct'] = "";
            $data['image'] = "";
            $data['publishedOn'] = "";
            $data['price'] = "";
            $data['tittleEn'] = "";
            $data['tittleAr'] = "";

            $data['Productstatus'] = "";
        }
        
    }



    $row_post[] = $data;
        $data = '';
    }else{
        $row_post=NULL;
    }
    return $row_post;
}


}
