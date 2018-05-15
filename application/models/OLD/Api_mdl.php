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
function get_posts($per_page_cnt=99999, $limit=0, $userId=NULL,$get_type=NULL,$status=NULL) {

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
            $where='order by post.postSubmissionOn DESC  limit ' . $per_page_cnt . ' offset ' . $limit;
         
        }
    }




    $qry = $this->db->query('SELECT DISTINCT `post`.`postID`,`post`.`productCategoryID`,post.productID,post.postStatus productApprovalStatus,
       `productcar`.`productCBrand`, `productcar`.`productCModel`,`productcar`.`productCPrice`,productcar.Cpost_main_img,productcar.productCSubmitDate,productcar.cartCType,productcar.productCStatus,
       `productbike`.`productBBrand`, `productbike`.`productBModel`, `productbike`.`productBPrice`,productbike.Bpost_main_img,productbike.productBSubmitDate,productbike.cartBType,productbike.productBStatus,
       `productboat`.`productBtBrand`, `productboat`.`productBtModel`,`productboat`.`productBTPrice`,productboat.BTpost_main_img,productboat.productBTSubmitDate,productboat.cartBTType,productboat.productBTStatus, 
       `productwatch`.`productWBrand`, `productwatch`.`productWModel`, `productwatch`.`productWPrice`,productwatch.Wpost_main_img,productwatch.productWSubmitDate,productwatch.cartWType,productwatch.productWStatus,
       `productvertu`.`productVBrand`, `productvertu`.`productVModel`,  `productvertu`.`productVPrice`,productvertu.Vpost_main_img,productvertu.productVSubmitDate, productvertu.cartVType,productvertu.productVStatus,
       `productproperty`.`productPropSC`,   `productproperty`.`productPRPrice`,productproperty.PRpost_main_img,productproperty.productPRSubmitDate,productproperty.cartPRType,productproperty.productPRStatus,productproperty.productPropType,  
       `productphone`.`productPBrand`, `productphone`.`productPModel`, `productphone`.`productPHPrice`,productphone.PHpost_main_img,productphone.productPSubmitDate,productphone.productPHStatus,productphone.cartPHType,
       `productnp`.`productNPCode`, `productnp`.`productNPDigits`,  `productnp`.`productNPPrice`,productnp.NPpost_main_img,productnp.productNPSubmitDate,productnp.cartNPType,productnp.productNPStatus,productnp.productNPNmbr,
       `productmn`.`productMNPrefix`, `productmn`.`productMNNmbr`,  `productmn`.`productMNPrice`,productmn.MNpost_main_img,productmn.productMNSubmitDate,productmn.cartMNType,productmn.productMNStatus,productmn.productOperator
       
      
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
    
    //echo $this->db->last_query();
    //var_dump($qry->result() );
    
if(!empty($qry->result())){
    foreach ($qry->result() as $key=>$row) {
        
        $data['postId'] = $row->postID;
        $data['productApprovalStatus'] = $row->productApprovalStatus;
        $data['categoryId'] =$row->productCategoryID;
        $data['ProductId'] = $row->productID;
        $check=Null;
//echo $data['categoryId']."\n";

        if ($data['categoryId'] == 1) {
            


            $data['image'] = $row->Cpost_main_img;
            $data['is_alshamilProduct'] = $row->cartCType;
            $data['publishedOn'] = $row->productCSubmitDate;
            $data['price'] = $row->productCPrice;
            $data['tittleEn'] = $row->productCBrand . " " . $row->productCModel;
            $data['tittleAr'] = " ";
              
            $data['Productstatus'] = $row->productCStatus;
           
            if($get_type==2){
                if($row->productCStatus!=$status)$check=1;
            }
            
        } else if ($data['categoryId'] == 2) {
            $data['is_alshamilProduct'] = $row->cartBType;
            $data['image'] = $row->Bpost_main_img;
            $data['publishedOn'] = $row->productBSubmitDate;
            $data['price'] = $row->productBPrice;
            $data['tittleEn'] = $row->productBBrand . " " . $row->productBModel;
            $data['tittleAr'] = "";

            $data['Productstatus'] = $row->productBStatus;
        } else if ($data['categoryId'] == 3) {
            $data['is_alshamilProduct'] = $row->cartNPType;
            $data['image'] = $row->NPpost_main_img;
            $data['publishedOn'] = $row->productNPSubmitDate;
            $data['price'] = $row->productNPPrice;
            $data['tittleEn'] = $row->productNPCode . "" . $row->productNPNmbr;
            $data['tittleAr'] = "";

            $data['Productstatus'] = $row->productNPStatus;
        } else if ($data['categoryId'] == 4) {
            $data['is_alshamilProduct'] = $row->cartVType;
            $data['image'] = $row->Vpost_main_img;
            $data['publishedOn'] = $row->productVSubmitDate;
            $data['price'] = $row->productVPrice;
            $data['tittleEn'] = $row->productVBrand . "" . $row->productVModel;
            $data['tittleAr'] = "";

            $data['Productstatus'] = $row->productVStatus;
        } else if ($data['categoryId'] == 5) {
            $data['is_alshamilProduct'] = $row->cartWType;
            $data['image'] = $row->Wpost_main_img;
            $data['publishedOn'] = $row->productWSubmitDate;
            $data['price'] = $row->productWPrice;
            $data['tittleEn'] = $row->productWBrand . "" . $row->productWModel;
            $data['tittleAr'] = "";

            $data['Productstatus'] = $row->productWStatus;
        } else if ($data['categoryId'] == 6) {
            $data['is_alshamilProduct'] = $row->cartMNType;
            $data['image'] = $row->MNpost_main_img;
            $data['publishedOn'] = $row->productMNSubmitDate;
            $data['price'] = $row->productMNPrice;
            $data['tittleEn'] = $row->productOperator . "" . $row->productMNNmbr;
            $data['tittleAr'] = "";

            $data['Productstatus'] = $row->productMNStatus;
        } else if ($data['categoryId'] == 7) {
            $data['is_alshamilProduct'] = $row->cartBTType;
            $data['image'] = $row->BTpost_main_img;
            $data['publishedOn'] = $row->productBTSubmitDate;
            $data['price'] = $row->productBTPrice;
            $data['tittleEn'] = $row->productBtBrand . "" . $row->productBtModel;
            $data['tittleAr'] = "";

            $data['Productstatus'] = $row->productBTStatus;
        } else if ($data['categoryId'] == 8) {
            $data['is_alshamilProduct'] = $row->cartPHType;
            $data['image'] = $row->PHpost_main_img;
            $data['publishedOn'] = $row->productPSubmitDate;
            $data['price'] = $row->productPHPrice;
            $data['tittleEn'] = $row->productPBrand . " " . $row->productPModel;
            $data['tittleAr'] = "";

            $data['Productstatus'] = $row->productPHStatus;
        } else if ($data['categoryId'] == 9) {
            $data['is_alshamilProduct'] = $row->cartPRType;
            $data['image'] = $row->PRpost_main_img;
            $data['publishedOn'] = $row->productPRSubmitDate;
            $data['price'] = $row->productPRPrice;
            $data['tittleEn'] = $row->productPropType . "" . $row->productPropSC;
            $data['tittleAr'] = "";

            $data['status'] = $row->productPRStatus;
        } else {
            $data['is_alshamilProduct'] = "";
            $data['image'] = "";
            $data['publishedOn'] = "";
            $data['price'] = "";
            $data['tittleEn'] = "";
            $data['tittleAr'] = "";

            $data['Productstatus'] = "";
        }
        $row_post[] = ($check!=null) ? $data : NULL;
        $data = '';
    }



    
       
    }else{
        $row_post=NULL;
    }
    return $row_post;
}

public function uploadfiles(){
        $images_array = array();
        $config = array();
        $config['upload_path'] = 'uploads/product_images/';
        $config['allowed_types'] = 'gif|jpg|png';

        $config['overwrite'] = FALSE;
        foreach ($_FILES['images']['name'] as $key => $val) {                 $ext = pathinfo($_FILES["images"]["name"][$key], PATHINFO_EXTENSION);
            $ext = pathinfo($_FILES["images"]["name"][$key], PATHINFO_EXTENSION);
            
         $uploadfile = $_FILES["images"]["tmp_name"][$key];
            $folder = "uploads/product_images/";
            $target_file = $folder .time().".".$ext;
            $rand_val = rand(10, 100);
            if (move_uploaded_file($_FILES["images"]["tmp_name"][$key],$target_file)) {
                $updimg_data['productID'] = $last_prd_id;
                $updimg_data['postID'] = $last_post_id;
                $updimg_data['productCategoryID'] = $categoryID;
                $updimg_data['traderID'] = $traderID;
                $updimg_data['productImage'] = base_url() .  $target_file;
                $updimg_data['productVideo'] = base_url() . $video;
                $updimg_data['thumbVideo'] = base_url() . $videoThumbnail;
                $updimg_data['cartType'] = '';
                $updimg_data['productLive'] = '';
                $updimg_data['productVideoCount'] = '';
                $updimg_data['productViewCount'] = '';
                $updimg_data['productLastAccess'] = '';
                $updimg_data['productSubmitDate'] = $post_date;
                $this->db->insert('productiv', $updimg_data);
            } else {
                $msg = "error in uploading";
                $this->response($msg, REST_Controller::HTTP_BAD_REQUEST);
            }
        }
        $this->load->library('upload');
        if (isset($_FILES['images']['name'])) {
            foreach ($_FILES['images']['name'] as $key => $val) {                 
                $ext = pathinfo($_FILES["images"]["name"][$key], PATHINFO_EXTENSION);
                $uploadfile = $_FILES["images"]["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder .time().".".$ext;

                if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], "$folder" . $_FILES["images"]["name"][$key])) {
                    $images_array[] = $target_file;
                    $updimg_data['productImage'] = base_url() . 'uploads/product_images/' . $rand_val . '_' . $_FILES["images"]["name"][$key];
                    $updimg_data['productVideo'] = base_url() . 'uploads/videos/' . $video;
                    $updimg_data['thumbVideo'] = base_url() . 'uploads/product_images/' . $videoThumbnail;
                    $updimg_data['cartType'] = '';
                    $updimg_data['productLive'] = '';
                    $updimg_data['productVideoCount'] = '';
                    $updimg_data['productViewCount'] = '';
                    $updimg_data['productLastAccess'] = '';
                    $updimg_data['productSubmitDate'] = $post_date;
                } else {
                    echo "error in uploading";
                }
            }
            return $updimg_data;
            
        }
    }

    function filterby_stat($where,$adminStatus,$availabilityStatus,$per_page_cnt,$offset){

        $this->db->select("CategoryID,ProductID,TraderID,Location,CONCAT(Brand,' ',Model,' ', Number) AS titleEn,Brand,Model,CallPrice,Price,AvailablitiyStatus,IsAlshamilProduct,Description,DATE_FORMAT(SubmitDate,'%d %b %Y') as SubmitDate,Image,ReleaseYear,postID,PostAdminStatus,productViewCount,rejectMsg");  
        //if($categoryId)$this->db->like('CategoryID', $categoryId, 'none'); 
        if(isset($adminStatus))$this->db->like('PostAdminStatus', $adminStatus, 'none'); 
        if(isset($availabilityStatus))$this->db->like('AvailablitiyStatus', $availabilityStatus, 'none'); 
        if(isset($where))$this->db->where($where); 
        if($per_page_cnt)$this->db->limit($per_page_cnt,$offset);
        $this->db->order_by("SubmitDate", "desc"); 
        $result=$this->db->get("vwProductPost");
       // echo $this->db->last_query();
       // exit;
        if(!empty($result))return $result->result();
      else return 0 ; 
      
    }
    function count_filterby_stat($where,$adminStatus,$availabilityStatus){
            $this->db->select('count(*) as total_entries');
            if(isset($adminStatus))$this->db->like('PostAdminStatus', $adminStatus, 'none'); 
            if(isset($availabilityStatus))$this->db->like('AvailablitiyStatus', $availabilityStatus, 'none'); 
            if(isset($where))$this->db->where($where); 
            $result=$this->db->get("vwProductPost");
    
            if(!empty($result))return $result->result();
      else return 0 ; 
    }
    function get_all_notification($where,$per_page_cnt,$offset){
        // $where_=array('vwNotificationsByUserNw.traderID' =>$where['traderID']);
        // $qry=$this->db->query("select count(*) as total from vwNotificationsByUserNw where {$where['traderID']}");
        // $this->db->select('vwNotificationsByUserNw.*,trader.traderImage,trader.traderLocation,trader.traderFullName,trader.traderValidTill');
        // $this->db->join('trader', 'trader.TraderID = vwNotificationsByUserNw.traderID');
        // $result=$this->db->get_where("vwNotificationsByUserNw",$where_,$offset,$per_page_cnt);
        // if(isset($qry->row()->total))$data['total']=$qry->row()->total;
        // $data['result']=$result->result();
        // return $data;
        $where_=array('vwNotificationsByUser.traderID' =>$where['traderID']);
        $qry=$this->db->query("select count(*) as total from vwNotificationsByUser where {$where['traderID']}");
        $this->db->select('vwNotificationsByUser.*,trader.traderImage,trader.traderLocation,trader.traderFullName,trader.traderValidTill');
        $this->db->join('trader', 'trader.TraderID = vwNotificationsByUser.traderID');
        $result=$this->db->get_where("vwNotificationsByUser",$where_,$offset,$per_page_cnt);
        if(isset($qry->row()->total))$data['total']=$qry->row()->total;
        $data['result']=$result->result();
        return $data;

    }
    function get_all_videos($per_page_cnt,$offset){
        $LIMIT= ($per_page_cnt!=NULL)?"LIMIT ".$offset.",".$per_page_cnt:"";
        
       $qry=$this->db->query("SELECT pv.*,vwProductPost.Brand,`vwProductPost`.`AvailablitiyStatus`,vwProductPost.Model,trader.traderFullName,trader.traderContactNum,trader.traderImage,trader.traderLocation from (SELECT DISTINCT  productiv.*, DATE_FORMAT(productiv.productSubmitDate,'%d %b %Y') as publishedOn
        FROM `productiv` where productiv.productVideo is NOT NULL  and `productiv`.`productVideo`!='http://alshamil.bluecast.ae/uploads/videos/' and `productiv`.`productVideo`!=''  group by postID ) as pv 
        LEFT JOIN `vwProductPost` ON `vwProductPost`.`postID`= `pv`.`postID` 
        LEFT JOIN `trader` ON `trader`.`traderID`= `vwProductPost`.`TraderID` where `vwProductPost`.`PostAdminStatus`=1  order by pv.productIV_ID desc ".$LIMIT);
    // var_dump($result);
  /*
       $select="productiv.*, DATE_FORMAT(productiv.productSubmitDate,'%d %b %Y') as publishedOn,vwProductPost.Brand,vwProductPost.Model,trader.traderFullName,trader.traderContactNum,trader.traderImage,trader.traderLocation";
         $join=array('trader'=>'trader.traderID= productiv.traderID',
         'vwProductPost'=>'vwProductPost.traderID=productiv.traderID');
         $result = $this->Data_mdl->get_all_by_fields('productiv',$where=array('productiv.productVideo !='=>''),$like=NULL,$per_page_cnt,$offset,$join,$select);
        
             */ //var_dump($count);

            //  //TODO bottom code temp
            //  foreach( $qry->result() as $videos){
            //     $link_array = explode('/',$videos->productVideo);
            //     $file = end($link_array);
            //     $file_det = pathinfo($file);
            //    // $title = $this->Trader_mdl->getTitle($result->productID, $result->productCategoryID);
            //     // if ($result->thumbImage == '') {
            //     //     $poster = $this->Trader_mdl->getImage($result->productID, $result->productCategoryID);
            //     // } else {
            //     //     $poster = $result->thumbImage;
            //     // }
            //     if(isset($file_det['extension'])){
            //         $result[] = $videos;
            //     }
            //     // if (file_exists($videos->productVideo) && pathinfo($videos->productVideo, PATHINFO_EXTENSION)) {
                    
            //     //     }
      
            //  }
            $result=$qry->result();
     $count=$this->db->query("SELECT count(*) as total FROM `productiv` where  productiv.productVideo is NOT NULL  and `productiv`.`productVideo`!='http://alshamil.bluecast.ae/uploads/videos/' and `productiv`.`productVideo`!='' ");
      
     if(isset($count->row()->total)){
        $data['total']=$count->row()->total;
        $data['result']=$result;
                }else{
                    $data['total']=0;
                    $data['result']=array();
                }
     return $data;
    }
    function getRowsProducts($category="all",$keyword,$params = array()){
        $start = 0;
        $this->db->select('*');
        $this->db->from('vwProductPost');
        $this->db->join('vwTrader', 'vwProductPost.TraderID = vwTrader.traderID');
        $this->db->join('category', 'vwProductPost.CategoryID = category.productCategoryID');
        
         if (!empty($keyword)){
          $this->db->or_group_start();
          $this->db->like('category.category_name', $keyword, 'both'); 
          $this->db->or_like('vwProductPost.Brand', $keyword, 'both');
          $this->db->or_like('vwProductPost.Model', $keyword, 'both')->group_end();
        } 
        if (is_numeric($category)) {
            $this->db->where('category.productCategoryID',$category);
        } elseif($category!='all') {
          $this->db->where('category.category_name',$category);
        }
         if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
              $this->db->limit($params['limit'],$params['start']);
          }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
              $this->db->limit($params['limit']);
          }
          
         //echo $this->db->get_compiled_select();
           $query =  $this->db->get();
           $results=array();
           foreach($query->result_array() as $result){
               unset($result['traderID']);
               $results[]=$result;
           }
          return (!empty($results))?$results:FALSE;
       }
       function start_checkout($userId){
        $pending_order=$this->db->get_where('order_items',array('orderUserID' => $userId,'paymentProof'=>'','status'=>0),1)->result();
        $pending_orderID = isset($pending_order[0]->orderID)?$pending_order[0]->orderID:0;
    // echo $pending_orderID;
        /*  $select="cartlist.*, vwProductPost.SubmitDate,vwProductPost.AvailablitiyStatus,vwProductPost.Price";
        $join=array('vwProductPost'=>'vwProductPost.postID=cartlist.postID');
        $pending_orderID = isset($pending_order[0]->orderID)?$pending_order[0]->orderID:NULL;
        $where=array('cartlist.userID'=>$userId,"(cartlist.orderID={$pending_orderID} OR cartlist.orderID=NULL)");
     */
       //  $result_set =$this->Data_mdl->get_all_by("cartlist",$where,NULL,NULL,NULL,$join,$select);
      $result_set = $this->db->select('cartlist.*, vwProductPost.SubmitDate,vwProductPost.AvailablitiyStatus,vwProductPost.Price')
      ->join('vwProductPost', 'vwProductPost.postID=cartlist.postID',"left outer")
      ->get_where('cartlist', "cartlist.userID = {$userId} AND (cartlist.orderID={$pending_orderID} OR cartlist.orderID=0)", NULL, NULL)
      ->result();
     // echo $this->db->last_query();
    /*$result_set = $this->db->select('cartlist.*, vwProductPost.SubmitDate,vwProductPost.AvailablitiyStatus,vwProductPost.Price')
    ->join('vwProductPost', 'vwProductPost.postID=cartlist.postID',"left outer")
    ->get_where('cartlist', "cartlist.userID = {$userId} AND (cartlist.orderID={$pending_orderID} OR cartlist.orderID=0)", NULL, NULL)
    ->result();*/ //another
          if(!empty($result_set )){
            $tot_amnt=0;
            $vat=$this->config->item('vat');
            $ecotax=$this->config->item('ecotax');
            $subtotal=0;
            $vat_amnt=0;
            foreach($result_set as $result){
                $subtotal=$subtotal+$result->Price;
                $vat_amnt =$vat_amnt+ $vat * $result->Price;
               
            }
         
            $ecotax_amnt = $subtotal*$ecotax ;
           // $total = $subtotal + $ecotax;
            $total = $subtotal + $ecotax + $vat_amnt;
            $data = array(
                'ecoTax' => $ecotax_amnt,
                'vatTax' => $vat_amnt,
                'orderAmount' => $total,
                'orderUserID'=>$userId,
             
            );
         /*   $data = array(
                array(
                   'title' => 'My title' ,
                   'orderID' => 'My Name 2' ,
                   )
             );
             $this->db->update_batch('cartlist', $data, 'where_key'); */
                   if(empty($pending_order)){
                if($this->db->insert('order_items', $data)){
                    $data['orderid']=$this->db->insert_id();
                    $data['subtotal']=$subtotal;
                    $data['vat_percent']=$vat*100;
                    $data['status']=1;
                    $data['status_msg']="New order placed";
                    $this->db->where('userID', $userId);
                    $this->db->update('cartlist',array('orderID'=>  $data['orderid']));
                    return $data;
                    
                }else{
                    return 0;
                }
            }else{
                    $this->db->update('order_items', $data, "orderID = {$pending_orderID}");
                    $this->db->where('userID', $userId);
                    $this->db->update('cartlist',array('orderID'=> $pending_orderID));
                    $data['orderid']=$pending_orderID;
                    $data['status']=2;
                    $data['status_msg']="Pending order updated";
                    $data['subtotal']=$subtotal;
                    $data['vat_percent']=$vat*100;
               
                    return $data;
            }
        }else{
            return 0;
        }
       
        
       }
    function update_user($txtemail, $txtpassword, $textnewpass=null,$token=null,$deviceId,$userType=NULL) {
        $md_password = md5($txtpassword);
        
        if(!empty($textnewpass)){
            $md_nwpassword = md5($textnewpass);
            $set=array('traderPasswd'=> $md_nwpassword);
        }else{
            $set=array('auth_token'=> $token,'deviceId'=> $deviceId);
        }
        if($userType==1 || $userType==3){
            $where=array("traderUserName"=>$txtemail);
        }else{
            $where=array("traderEmailID"=>$txtemail);
        }           
        $this->db->select('*');
        $this->db->from('trader');
        $this->db->where($where);
        $this->db->where('traderPasswd', $md_password);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
       // $this->db->where('traderPasswd', $md_password);
        //$this->db->set('traderPasswd', $md_nwpassword, FALSE);
        $this->db->where($where);
        $this->db->update('trader',$set);
            return $query->result();
        } else {
            return false;
        }
    }
    function change_post_status($postID,$newStatus,$userID){
        $qry=$this->db->query("select ChangePostStatus({$postID},{$newStatus})");
        return $qry->result();

    }
    function change_post_count($postID,$videoID){
        if(isset($videoID)){
            $this->db->where('productIV_ID', $videoID);
            $this->db->set('productViewCount', 'productViewCount + 1', FALSE);
            return  $this->db->update('productiv')?1:0;
        }else{
            $this->db->where('postID', $postID);
            $this->db->set('productViewCount', 'productViewCount + 1', FALSE);
            return  $this->db->update('post')?1:0;
        }
        
        
        //$this->db->affected_rows();
    }
    function get_plan_amount($planID){
        return $this->db->get_where('subscriptionplan',array('planID' => $planID),1)->result_array()[0];
       
    }
    function get_template_imgs($emirates,$type=0) {

        $this->db->select('templates,long_template,noplateTempID');
        $this->db->from('noplate_template');
        $this->db->where('emirates', $emirates);
        $this->db->where('type', $type);
        $temp_img_qry = $this->db->get();
        //$temp_img_qry=$this->db->query('select templates from noplate_template where emirates='.$emirates);
        return $temp_img_qry->result();
    }
    function get_mob_template_imgs($mob_oper) {

        
        //$temp_img_qry=$this->db->query('select templates from noplate_template where emirates='.$emirates);
        return $this->Trader_mdl->get_mobprefix($mob_oper);
    }
    function generate_nopl_temp($text,$emirate,$type) {
        
        $base_url       = base_url();
        $temp_img_qry = $this->get_template_imgs($emirate,$type);
        $img_src = explode("/", $temp_img_qry[0]->templates);
        $source         = $base_url . "img/noplate/base_images/" . $img_src[count($img_src)-1];
        $image          = imagecreatefrompng($source);

        $img_src_long = explode("/", $temp_img_qry[0]->long_template);
        $source_long        = $base_url . "img/noplate/base_images/all/Numberplate-Long/" . $img_src_long[count($img_src_long)-1];
        
       // $source_long        = $base_url . "img/noplate/base_images/all/Numberplate-Long/" . $img_src_long;
        $image_long          = imagecreatefrompng($source_long);
       
        $splitText = explode(" ", $text);
        $code = $splitText[0];
        $number = $splitText[1];
        $emrId =  $temp_img_qry[0]->noplateTempID;
        if($emrId==6||$emrId==4)
            $font = dirname(__FILE__) . '/../../assets/fonts/Kraftfahrzeugkennzeichen.ttf';
        else $font = dirname(__FILE__) . '/../../assets/fonts/alternategothicef-notwo.ttf';

       
      if($emrId == 1){
           $color = imagecolorallocate($image, 1, 1, 1);
           $fontSize = 86;
           $x = 50;
           $y = 130;

            $fontSizeLongCode = $fontSizeLong = 60;
           $xCodeLong = 30;
           $xLttrLong = 245;
           $yCodeLong=  $yLttrLong = 80;
           imagettftext($image, $fontSize, 0, $x, $y, $color, $font, $text);
        }
        if($emrId == 2){
           $color = imagecolorallocate($image, 1, 1, 1); 
           $fontSize = 86;
           $x = 5;
           $y = 130;
            $fontSizeLongCode = $fontSizeLong = 50;
           $xCodeLong = 20;
           $xLttrLong = 245;
           $yCodeLong=  $yLttrLong = 80;
           imagettftext($image, $fontSize, 0, $x, $y, $color, $font, $text);

        }
         if($emrId == 3){
           $color = imagecolorallocate($image, 1, 1, 1); 
           $fontSize = 86;
           $x = 35;
           $y = 130;

            $fontSizeLongCode = $fontSizeLong = 50;
           $xCodeLong = 20;
           $xLttrLong = 100;
           $yCodeLong=  $yLttrLong = 80;
           imagettftext($image, $fontSize, 0, $x, $y, $color, $font, $text);

        }
        if($emrId == 4){
           $color = imagecolorallocate($image, 1, 1, 1); 
           $fontSize = 86;
           $x = 5;
           $y = 240;

            $fontSizeLongCode = $fontSizeLong = 50;
           $xCodeLong = 20;
           $xLttrLong = 245;
           $yCodeLong=  $yLttrLong = 80;

            imagettftext($image, $fontSize, 0, $x, $y, $color, $font, $text);

        }
        if($emrId == 5){
           $color = imagecolorallocate($image, 1, 1, 1); 
           $fontSize = 86;
           $x = 50;
           $y = 140;

            $fontSizeLongCode = $fontSizeLong = 60;
           $xCodeLong = 20;
           $xLttrLong = 220;
           $yCodeLong=  $yLttrLong = 80;
           imagettftext($image, $fontSize, 0, 190, 240, $color, $font, $code);
           imagettftext($image, $fontSize, 0, $x, $y, $color, $font, $number);
        }
        if($emrId == 6){
           $color = imagecolorallocate($image, 1, 1, 1); 
           $fontSize = 86;
           $x = 35;
           $y = 240;

           $fontSizeLong = 70;
           $xCodeLong = 20;
           $xLttrLong = 180;
           $yCodeLong = 55;
           $yLttrLong = 90;
           $fontSizeLongCode = 40;

           imagettftext($image, 60, 0, 35, 95, $color, $font, $code);
           imagettftext($image, $fontSize, 0, $x, $y, $color, $font, $number);
        }
        if($emrId == 7){
           $color = imagecolorallocate($image, 1, 1, 1); 
           $fontSize = 86;
           $x = 10;
           $y = 180;

           $fontSizeLongCode = $fontSizeLong = 60;
           $xCodeLong = 10;
           $xLttrLong = 220;
           $yLttrLong = 80;
           $yCodeLong = 80;
           imagettftext($image, $fontSize, 0, $x, $y, $color, $font, $text);

        }
        imagettftext($image_long, $fontSizeLongCode, 0, $xCodeLong, $yCodeLong, $color, $font, $code);
        imagettftext($image_long, $fontSizeLong, 0, $xLttrLong, $yLttrLong, $color, $font, $number);
        
        $name = time().'.png';
        $name_long =time().'_long.png';
        $loc = $_SERVER['DOCUMENT_ROOT'] . '/uploads/product_images/'. $name;
        $loc_long = $_SERVER['DOCUMENT_ROOT'] . '/uploads/product_images/'. $name_long;
        imagepng($image, $loc);
        
        imagepng($image_long, $loc_long);
        imagedestroy($image);
        imagedestroy($image_long);
        return array('short'=>$name,'long'=>$name_long);
    }
    function generate_nopl_temp_bike($text,$emirate,$type) {
        
        $base_url       = base_url();
        $temp_img_qry = $this->get_template_imgs($emirate,$type);
        $img_src = explode("/", $temp_img_qry[0]->templates);
        $source         = $base_url . "img/noplate/base_images/" . $img_src[count($img_src)-1];
        $image          = imagecreatefrompng($source);
        $splitText = explode(" ", $text);
        $code = $splitText[0];
        $number = $splitText[1];
        $emrId =  $temp_img_qry[0]->noplateTempID;

        if($emrId==11||$emrId==13)
            $font = dirname(__FILE__) . '/../../assets/fonts/Kraftfahrzeugkennzeichen.ttf';
        else $font = dirname(__FILE__) . '/../../assets/fonts/alternategothicef-notwo.ttf';
        
          if($emrId == 8){
           $color = imagecolorallocate($image, 1, 1, 1);
           $fontSize = 75;
           $x = 170;
           $y = 230;

            $fontSizeLongCode = $fontSizeLong = 60;
           $xCodeLong = 30;
           $xLttrLong = 245;
           $yCodeLong=  $yLttrLong = 80;

           imagettftext($image, $fontSize, 0, 50, 130, $color, $font, $code);
           
        }else{
              $color = imagecolorallocate($image, 1, 1, 1); 
           $fontSize = 95;
           $x = 45;
           $y = 240;
        }
        
        imagettftext($image, $fontSize, 0, $x, $y, $color, $font, $number);
      
        $name = time().'.png';
        $name_long =time().'_long.png';
        $loc = $_SERVER['DOCUMENT_ROOT'] . '/uploads/product_images/'. $name;
        imagepng($image, $loc);
        
        imagedestroy($image);
        return array('short'=>$name,'long'=>'');
    }
    
    function generate_mob_temp($operator,$text) {
      
         $base_url = base_url();

        if ($operator == 'Etisalat') {
            $source=$base_url.'img/mobno/base_images/Mobile-etisalath.png';
            $image = imagecreatefrompng($source);
            imagecolortransparent($image, imagecolorallocatealpha($image, 0, 0, 0, 127));
            imagealphablending($image, false);
            imagesavealpha($image, true);
            $color = imagecolorallocate($image, 255, 255, 255);
            $fontSize = 35;
            $x = 50;
            $y = 220;
            $font = dirname(__FILE__) .'/../../fonts/Lato-Bold.ttf';
            $angle=45;
            $image_width = imagesx($image);  
            $image_height = imagesy($image);
            $text_box = imagettfbbox($fontSize,$angle,$font,$text);
            $text_width = $text_box[2]-$text_box[0];
            $text_height = $text_box[7]-$text_box[1];
            $x = ($image_width/2.4) - ($text_width/2);
            // $font = $_SERVER['DOCUMENT_ROOT'] .'/application/controllers/Lato-Bold.ttf';
          
            imagettftext($image, $fontSize, 0, $x, $y, -$color, $font, $text);
            $name = microtime();
			$newname = str_replace(' ','',$name);
			$newname = str_replace('.','',$newname);
			$newname = $newname.'.png';
            $loc = $_SERVER['DOCUMENT_ROOT'] . '/img/mobno/mobile/'.  $newname;
            imagepng($image, $loc);
            imagedestroy($image);
            $loc = $base_url.'img/mobno/mobile/'. $newname;
        } else if ($operator == 'DU') {
            $source=$base_url.'img/mobno/base_images/Mobile-Du.png';
            $image = imagecreatefrompng($source);
            imagecolortransparent($image, imagecolorallocatealpha($image, 0, 0, 0, 127));
            imagealphablending($image, false);
            imagesavealpha($image, true);
            $ducolor = imagecolorallocate($image, 255, 255, 255);
            $dufontSize = 35;
            $x = 50;
            $y = 220;
            $font = dirname(__FILE__) .'/../../fonts/Lato-Bold.ttf';
            $angle=45;
            $image_width = imagesx($image);  
            $image_height = imagesy($image);
            $text_box = imagettfbbox($fontSize,$angle,$font,$text);
            $text_width = $text_box[2]-$text_box[0];
            $text_height = $text_box[7]-$text_box[1];
            $x = ($image_width/2.4) - ($text_width/2);
            // $dufont = $_SERVER['DOCUMENT_ROOT'] .'/application/controllers/Lato-Bold.ttf';
        
            imagettftext($image, $dufontSize, 0, $x, $y, -$ducolor, $font, $text);
            $name = microtime();
			$newname = str_replace(' ','',$name);
			$newname = str_replace('.','',$newname);
			$newname = $newname.'.png';
                       
            $loc = $_SERVER['DOCUMENT_ROOT'] . '/img/mobno/mobile/'.  $newname;
            
            imagepng($image, $loc);
            imagedestroy($image);
            $loc = $base_url.'img/mobno/mobile/'. $newname;
             
        } else {
            $source=$base_url.'img/mobno/base_images/Other-Phone.png';
            $image = imagecreatefrompng($source);
            $color = imagecolorallocate($image,255, 255, 255);
            imagecolortransparent($image, imagecolorallocatealpha($image, 0, 0, 0, 127));
            imagealphablending($image, false);
            imagesavealpha($image, true);
            $fontSize = 35;
            $x = 50;
            $y = 220;
            $font = dirname(__FILE__) .'/../../fonts/Lato-Bold.ttf';
            $angle=45;
            $image_width = imagesx($image);  
            $image_height = imagesy($image);
            $text_box = imagettfbbox($fontSize,$angle,$font,$text);
            $text_width = $text_box[2]-$text_box[0];
            $text_height = $text_box[7]-$text_box[1];
            $x = ($image_width/2.4) - ($text_width/2);
            // $font = $_SERVER['DOCUMENT_ROOT'] .'/application/controllers/Lato-Bold.ttf';
            
            imagettftext($image, $fontSize, 0, $x, $y, -$color, $font, $text);
            $name = microtime();
			$newname = str_replace(' ','',$name);
			$newname = str_replace('.','',$newname);
			$newname = $newname.'.png';
            $loc = $_SERVER['DOCUMENT_ROOT'] . '/img/mobno/mobile/'.  $newname;
            imagepng($image, $loc);
            imagedestroy($image);
            $loc = $base_url.'img/mobno/mobile/'. $newname;
        }
        return $loc;
    }

    function get_product_ivs($postid){
        $this->db->select('productIV_ID');
        $query = $this->db->get_where('productiv', array('postID' => $postid,'productImage!='=>''), NULL, NULL);
        $result = $query->result_array();
        if(isset($result))
        {
            return $result;
        }else{
            return FALSE;
        }
    }
    function get_vid_product_ivs($postid){
        $this->db->select('productIV_ID');
        $query = $this->db->get_where('productiv', array('postID' => $postid,'productVideo!='=>base_url(),'productVideo!='=>''), NULL, NULL);
        $result = $query->result_array();
        if(isset($result))
        {
            return $result;
        }else{
            return FALSE;
        }
    }
}
