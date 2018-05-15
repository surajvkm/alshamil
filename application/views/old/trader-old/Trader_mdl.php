<?php

class Trader_mdl extends CI_Model
{
    function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->lang = $this->session->userdata("lang");
    $lang = "en";
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
        return $this->db->count_all("trader");
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
   function get_prod_trader($product_id)
   {
        $this->db->select('trader.traderFullName,trader.traderLocation,trader.traderLocation');
        $this->db->from('trader');
         $this->db->join('product','product.traderID=trader.traderID');
        $this->db->where('product.productID', $product_id);
       
        $qry = $this->db->get();
        return $qry->result();
   }
    function get_trader($txtemail, $txtpassword,$txtusertype) {
        $md_password = md5($txtpassword);
        $this->db->select('*');
        $this->db->from('trader');
        $this->db->where('traderEmailID', $txtemail);
        $this->db->where('traderPasswd', $md_password);
        $this->db->where('userType', $txtusertype);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
     
    function get_post_byid($post_id)
   {
       $qry=$this->db->query('SELECT DISTINCT `post`.`postID`,post.productCategoryID,post.productID,productiv.productViewCount ,
           `productcar`.`productCBrand`, `productcar`.`productCModel`,productcar.productCReleaseYear, `productcar`.`productCPrice`,productcar.productCStatus,productcar.productCDesc,productcar.Cpost_main_img,
           `productbike`.`productBBrand`, `productbike`.`productBModel`, `productbike`.`productBSubmitDate`,productbike.productBReleaseYear, `productbike`.`productBPrice`,productbike.productBStatus,productbike.Bpost_main_img,productbike.productBDesc as bike,
           `productboat`.`productBtBrand`, `productboat`.`productBtModel`, `productboat`.`productBTSubmitDate`,productboat.productBReleaseYear, `productboat`.`productBTPrice`,productboat.productBTStatus,productboat.productBDesc,productboat.BTpost_main_img, 
           `productwatch`.`productWBrand`, `productwatch`.`productWModel`, `productwatch`.`productWSubmitDate`, `productwatch`.`productWPrice`,productwatch.productWStatus,productwatch.productWDesc,productwatch.Wpost_main_img,
           `productvertu`.`productVBrand`, `productvertu`.`productVModel`, `productvertu`.`productVSubmitDate`, `productvertu`.`productVPrice`,productvertu.productVStatus,productvertu.productVDesc,productvertu.Vpost_main_img, 
           `productproperty`.`productPropSC`,  `productproperty`.`productPRSubmitDate`, `productproperty`.`productPRPrice`,productproperty.productPRStatus,productproperty.productDesc,productproperty.PRpost_main_img, 
           `productphone`.`productPBrand`, `productphone`.`productPModel`, `productphone`.`productPSubmitDate`, `productphone`.`productPHPrice`,productphone.productPHStatus,productphone.productPDesc,productphone.PHpost_main_img,
           `productnp`.`productNPCode`, `productnp`.`productNPDigits`, `productnp`.`productNPSubmitDate`, `productnp`.`productNPPrice`,productnp.productNPStatus,productnp.productNPDesc,productnp.NPpost_main_img,productnp.productNPNmbr,
           `productmn`.`productMNPrefix`, `productmn`.`productMNNmbr`, `productmn`.`productMNSubmitDate`, `productmn`.`productMNPrice`,productmn.productMNStatus,productmn.productMNDesc,productmn.MNpost_main_img,productmn.productOperator
         
          
        from post
        left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
        left JOIN `productiv` ON `post`.`postID`=`productiv`.`postID`
        left JOIN `productcar` ON (`post`.`productCategoryID`=`productcar`.`productCategoryID` and post.productID=productcar.productID)
        left JOIN `productbike` ON( `post`.`productCategoryID`=`productbike`.`productCategoryID` and post.productID=productbike.productID)
        left JOIN `productboat` ON (`post`.`productCategoryID`=`productboat`.`productCategoryID` and  post.productID=productboat.productID)
        left JOIN `productmn` ON (`post`.`productCategoryID`=`productmn`.`productCategoryID` and post.productID=productmn.productID)
        left JOIN `productnp` ON( `post`.`productCategoryID`=`productnp`.`productCategoryID` and post.productID=productnp.productID)
        left JOIN `productphone` ON (`post`.`productCategoryID`=`productphone`.`productCategoryID`and post.productID=productphone.productID)
        left JOIN `productproperty` ON( `post`.`productCategoryID`=`productproperty`.`productCategoryID`and post.productID=productproperty.productID)
        left JOIN `productvertu` ON (`post`.`productCategoryID`=`productvertu`.`productCategoryID`and post.productID=productvertu.productID)
        left JOIN `productwatch` ON( `post`.`productCategoryID`=`productwatch`.`productCategoryID` and post.productID=productwatch.productID)
        WHERE `post`.`postID` = '.$post_id);
     foreach ($qry->result() as $row) {
            $data['postId'] = $row->postID;
            $data['categoryId'] = $row->productCategoryID;
            $data['ProductId'] = $row->productID;
            $data['views'] = $row->productViewCount;
            if ($data['categoryId'] == 1) {
                $data['image'] = $row->Cpost_main_img;
                $data['price'] = $row->productCPrice;
                $data['titleEn'] = $row->productCBrand." ".$row->productCModel;
                $data['titleAr'] ="" ;
                $data['brandNameEn'] = $row->productCBrand;
                $data['brandNameAr'] ="" ;
                $data['modelNameEn'] = $row->productCModel;
                $data['modelNameAr'] ="" ;
                $data['year']= $row->productCReleaseYear;
                $data['descriptionEn'] = $row->productCDesc;
                $data['descriptionAr'] = "";
                $data['status'] = $row->productCStatus;
                   
            } else if ($data['categoryId'] == 2) {
             
                $data['image'] = $row->Bpost_main_img;
                $data['year'] = $row->productBReleaseYear;
                $data['price']  = $row->productBPrice;
                $data['titleEn'] = $row->productBBrand." ".$row->productBModel;
               $data['titleAr'] = "";
                $data['brandNameEn'] = $row->productBBrand;
                $data['brandNameAr'] ="" ;
                $data['modelNameEn'] = $row->productBModel;
                $data['modelNameAr'] ="" ;
               $data['descriptionEn'] = $row->bike;
               $data['descriptionAr'] = "";
               $data['status'] = $row->productBStatus;
               
            } else if ($data['categoryId']== 3) {
              
                $data['image']= $row->NPpost_main_img;
                $data['price'] = $row->productNPPrice;
                $data['titleEn'] = $row->productNPCode." ".$row->productNPNmbr;
               $data['titleAr'] ="" ;
               $data['brandNameEn'] =  $row->productNPCode;
                $data['brandNameAr'] ="" ;
                $data['modelNameEn'] = $row->productNPNmbr;
               $data['modelNameAr'] ="" ;
                  $data['descriptionEn'] = $row->productNPDesc;
                  $data['descriptionAr'] = "";
                $data['status']  = $row->productNPStatus;
                 $data['year']  ="" ;
            } else if ($data['categoryId'] == 4) {
               
               $data['image'] = $row->Vpost_main_img;
              $data['price'] = $row->productVPrice;
                $data['titleEn'] = $row->productVBrand." ". $row->productVModel;
                $data['titleAr'] ="";
                $data['brandNameEn'] = $row->productVBrand;
                $data['brandNameAr'] ="" ;
               $data['modelNameEn'] = $row->productVModel;
               $data['modelNameAr'] ="" ;
                $data['descriptionEn'] = $row->productVDesc;
                  $data['descriptionAr'] = "";
                $data['status'] = $row->productVStatus;
                    $data['year'] ="" ;
            } else if ($data['categoryId'] == 5) {
              
                $data['image'] = $row->Wpost_main_img;
               $data['price']= $row->productWPrice;
                $data['titleEn'] = $row->productWBrand." ".$row->productWModel;
                $data['titleAr'] ="" ;
                $data['brandNameEn'] = $row->productWBrand;
               $data['brandNameAr'] ="" ;
                $data['modelNameEn'] = $row->productWModel;
                $data['modelNameAr'] ="" ;
               $data['descriptionEn'] = $row->productWDesc;
                 $data['descriptionAr'] = "";
               $data['status'] = $row->productWStatus;
                  $data['year'] ="" ;
            } else if ($data['categoryId']== 6) {
              
               $data['image']  = $row->MNpost_main_img;
                $data['price']= $row->productMNPrice;
               $data['titleEn'] = $row->productOperator." ". $row->productMNNmbr;
                $data['titleAr']="";
                 $data['brandNameEn'] = $row->productOperator;
                $data['brandNameAr'] ="" ;
                $data['modelNameEn'] = $row->productMNNmbr;
                $data['modelNameAr']="" ;
                $data['descriptionEn'] = $row->productMNDesc;
                $data['descriptionAr'] = "";
                 $data['status'] = $row->productMNStatus;
                    $data['year'] ="" ;
            } else if ($data['categoryId'] == 7) {
              
                $data['image'] = $row->BTpost_main_img;
               
                 $data['price'] = $row->productBTPrice;
             $data['titleEn'] = $row->productBtBrand." ". $row->productBtModel;
                 $data['titleAr'] ="";
               $data['brandNameEn'] = $row->productBtBrand;
                $data['brandNameAr'] ="" ;
                $data['modelNameEn']  = $row->productBtModel;
                $data['modelNameAr'] ="" ;
                $data['descriptionEn'] = $row->productBTDesc;
                $data['descriptionAr'] = "";
               $data['status'] = $row->productBTStatus;
                    $data['year'] ="" ;
            } else if ($data['categoryId'] == 8) {
               
                $data['image']  = $row->PHpost_main_img;
//                $data['publishedOn'] = $row->productPSubmitDate;
               $data['price']= $row->productPHPrice;
                $data['titleEn'] = $row->productPBrand." ".$row->productPModel;
                $data['titleAr'] = "";
                 $data['brandNameEn'] = $row->productPBrand;
             $data['brandNameAr'] ="" ;
                $data['modelNameEn'] = $row->productPModel;
               $data['modelNameAr']  ="" ;
                $data['descriptionEn'] = $row->productPDesc;
               $data['descriptionAr'] = "";
                $data['status'] = $row->productPHStatus;
                $data['year'] ="" ;
            } else if ($data['categoryId'] == 9) {
              
               $data['image']= $row->PRpost_main_img;
                $data['price'] = $row->productPRPrice;
                $data['titleEn']= $row->productPropType." ".$row->productPropSC;
               $data['titleAr'] = "";
               $data['brandNameEn']=  $row->productPropType;
                $data['brandNameAr'] ="" ;
                 $data['modelNameEn']= $row->productPropSC;
               $data['modelNameAr'] ="" ;
              $data['descriptionEn'] = $row->productDesc;
                $data['descriptionAr'] = "";
              $data['status'] = $row->productPRStatus;
                   $data['year'] ="" ;
            } else {
               
                $data['image'] = "";
                $data['price'] = "";
                $data['titleEn'] = "";
                $data['titleAr'] = "";
                $data['descriptionEn'] = "";
                $data['descriptionAr'] = "";
                $data['status'] = "";
                 $data['brandNameEn'] =  "";
                $data['brandNameAr'] ="" ;
                $data['modelNameEn'] = "";
                $data['modelNameAr'] ="" ;
                  $data['year'] ="" ;
            }
            
           
           
            $row_post[] = $data;
            $data='';
            
        }
         return $row_post;
      
      
   }
     function get_post_traderinfo($post_id)
   {
      $qry=$this->db->query('SELECT  DISTINCT
           `trader`.`traderID` as traderId, `trader`.`traderFullName` as traderNameEn, `trader`.`traderImage`, `trader`.`traderLocation` as traderLocationEn, `trader`.`traderContactNum` as mobile,`trader`.`traderEmailID` as email
        from post
        left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
        left JOIN `productiv` ON `post`.`postID`=`productiv`.`postID`
        left JOIN `productcar` ON (`post`.`productCategoryID`=`productcar`.`productCategoryID` and post.productID=productcar.productID)
        left JOIN `productbike` ON( `post`.`productCategoryID`=`productbike`.`productCategoryID` and post.productID=productbike.productID)
        left JOIN `productboat` ON (`post`.`productCategoryID`=`productboat`.`productCategoryID` and  post.productID=productboat.productID)
        left JOIN `productmn` ON (`post`.`productCategoryID`=`productmn`.`productCategoryID` and post.productID=productmn.productID)
        left JOIN `productnp` ON( `post`.`productCategoryID`=`productnp`.`productCategoryID` and post.productID=productnp.productID)
        left JOIN `productphone` ON (`post`.`productCategoryID`=`productphone`.`productCategoryID`and post.productID=productphone.productID)
        left JOIN `productproperty` ON( `post`.`productCategoryID`=`productproperty`.`productCategoryID`and post.productID=productproperty.productID)
        left JOIN `productvertu` ON (`post`.`productCategoryID`=`productvertu`.`productCategoryID`and post.productID=productvertu.productID)
        left JOIN `productwatch` ON( `post`.`productCategoryID`=`productwatch`.`productCategoryID` and post.productID=productwatch.productID)
        WHERE `post`.`postID` = '.$post_id);
       return $qry->result();  
   }
    function get_post_medialist($post_id)
   {
       $qry=$this->db->query('SELECT DISTINCT
           `productiv`.`productVideo`,productiv.productVideoCount as viewCount,productiv.thumbVideo as thumbnailUrl
          
        from post
        left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
        left JOIN `productiv` ON `post`.`postID`=`productiv`.`postID`
        left JOIN `productcar` ON (`post`.`productCategoryID`=`productcar`.`productCategoryID` and post.productID=productcar.productID)
        left JOIN `productbike` ON( `post`.`productCategoryID`=`productbike`.`productCategoryID` and post.productID=productbike.productID)
        left JOIN `productboat` ON (`post`.`productCategoryID`=`productboat`.`productCategoryID` and  post.productID=productboat.productID)
        left JOIN `productmn` ON (`post`.`productCategoryID`=`productmn`.`productCategoryID` and post.productID=productmn.productID)
        left JOIN `productnp` ON( `post`.`productCategoryID`=`productnp`.`productCategoryID` and post.productID=productnp.productID)
        left JOIN `productphone` ON (`post`.`productCategoryID`=`productphone`.`productCategoryID`and post.productID=productphone.productID)
        left JOIN `productproperty` ON( `post`.`productCategoryID`=`productproperty`.`productCategoryID`and post.productID=productproperty.productID)
        left JOIN `productvertu` ON (`post`.`productCategoryID`=`productvertu`.`productCategoryID`and post.productID=productvertu.productID)
        left JOIN `productwatch` ON( `post`.`productCategoryID`=`productwatch`.`productCategoryID` and post.productID=productwatch.productID)
        WHERE `post`.`postID` = '.$post_id);
       return $qry->result(); 
      
   }
   function all_traders($userId,$per_page_cnt,$limit)
    {
        $this->db->select('traderID as traderId,traderFullName as nameEn,traderLocation as locationEn,traderImage as image,traderInfo as detailsEn,traderContactNum as mobile,traderEmailID as email,socialWeb as website,socialFb as facebook,socialInsta as instagram,socialSnap as snapchat,socialtwitter as twitter');
        $this->db->from('trader');
        $this->db->where('traderID!= ',$userId);
        $this->db->limit($per_page_cnt,$limit);
        $qry = $this->db->get();
       return $qry->result();
    }
    function count_traders()
   {
        $this->db->select('count(*) as total_entries');
        $this->db->from('trader');
         $qry = $this->db->get();
        return $qry->result();
   }
   function get_trader_bytraderId($traderId)
   {
       $this->db->select('traderID as userId,traderFullName as name,traderInfo as description,traderLocation as place,traderUserName as username,traderContactNum as mobile,traderEmailID as email,traderImage as profileImage,socialWeb as website,socialFb as facebook,socialInsta as instagram,socialSnap as snapchat,socialtwitter as twitter');
        $this->db->from('trader');
        $this->db->where('traderID', $traderId);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
   }
    function get_catid($cat)
    {
        
        $qry = $this->db->query('select productCategoryID from category where category_name='.$cat);
        return $qry->result(); 
       /* echo '<pre>';print_r($d);exit();*/
        
    }
    function get_brandname($txtcat,$txtbrand)
    {
         $brqry = $this->db->query('SELECT distinct brandName FROM category_subtypes WHERE productCategoryID = '.$txtcat. ' AND brandID = '.$txtbrand);

        return $brqry->result(); 
    }
    function get_modelname($txtcat,$txtbrand,$txtmodel)
    {
        $mdqry = $this->db->query('SELECT  modelName FROM category_subtypes WHERE productCategoryID = '.$txtcat. ' AND brandID = '.$txtbrand.' AND modelID = '.$txtmodel);

        return $mdqry->result(); 
    }
    /*function all_traders($limit,$per_page_cnt)
    {
        $this->db->select('*');
        $this->db->from('trader');
        $this->db->limit($limit,$per_page_cnt);
        $qry = $this->db->get();
        $records = $qry->result();
       
        return array(
            'records' => $records,
            'count' => count($records),
        );
    }*/
    function mdl_all_traders()
    {
        $this->db->select('*');
        $this->db->from('trader');
        //$this->db->limit($limit,$per_page_cnt);
        $qry = $this->db->get();
        $records = $qry->result();
       
        return array(
            'records' => $records,
            'count' => count($records),
        );
    }
    function get_name($trader_id) {
        $this->db->select('traderID,traderFullName,traderImage,traderLocation,socialWeb,socialtwitter,socialFb,socialInsta,socialSnap');
        $this->db->from('trader');
        $this->db->where('traderID', $trader_id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
        
    }
    function fetch_trader_editdata($trader_id)
    {
       $this->db->where('traderID',$trader_id); 
       $qry = $this->db->get('trader');
        return $qry->result();
    }
    function get_traders_list() {
        $this->db->order_by('traderRegistrationDate', 'DESC');
        $this->db->select('*');
        $this->db->from('trader');
        $this->db->limit('5');
        $query = $this->db->get();
        return $query->result();
    }
    function gethome_traders_list() {
        $this->db->order_by('traderRegistrationDate', 'DESC');
        $this->db->select('traderID as traderId,traderFullName as nameEn,traderImage as image');
        $this->db->from('trader');
        $this->db->limit('5');
        $query = $this->db->get();
        return $query->result();
    }
   function gethome_product_list() {

         $q = $this->db->query('SELECT  productiv.postID,
             productiv.productCategoryID, 
             productiv.productID,productiv.productVideo,
             productcar.productCBrand,
             productcar.productCModel,
             productbike.productBBrand,
             productbike.productBModel,
             productboat.productBtBrand,
             productboat.productBtModel,
             productvertu.productVBrand,
             productvertu.productVModel
             ,productwatch.productWBrand,
             productwatch.productWModel,
             productproperty.productPropSC,productproperty.productPropType
             ,productmn.productMNNmbr,
             productmn.productMNPrefix,productnp.productNPNmbr,
             productnp.productNPEmrites,productnp.productNPCode
             ,productphone.productPBrand,productphone.productPModel,
             productiv.thumbvideo,productiv.productVideoCount FROM `productiv`
 
left join productcar on (productiv.productCategoryID=productcar.productCategoryID and productiv.productID=productcar.productID)

left join productbike on (productiv.productCategoryID=productbike.productCategoryID and productiv.productID=productbike.productID)

left join productboat on (productiv.productCategoryID=productboat.productCategoryID and productiv.productID=productboat.productID)

left join productvertu on (productiv.productCategoryID=productvertu.productCategoryID and productiv.productID=productvertu.productID)

left join productwatch on (productiv.productCategoryID=productwatch.productCategoryID and productiv.productID=productwatch.productID)

left join productproperty on (productiv.productCategoryID=productproperty.productCategoryID and productiv.productID=productproperty.productID)

left join productmn on (productiv.productCategoryID=productmn.productCategoryID and productiv.productID=productmn.productID)

left join productnp on (productiv.productCategoryID=productnp.productCategoryID and productiv.productID=productnp.productID)

left join productphone on (productiv.productCategoryID=productphone.productCategoryID and productiv.productID=productphone.productID)


order by productiv.productSubmitDate desc limit 1 offset 0');
        
       foreach ($q->result() as $row) { 
           $data['postId'] = $row->postID;
           $data['CategoryId']=$row->productCategoryID;
           $data['ProductId']=$row->productID;
           $data['video']=$row->productVideo;
           $data['viewCount']=$row->productVideoCount;
           $data['videoThumbnail']=$row->thumbvideo;
            $data['postTitleAr']="";
            if ($data['CategoryId'] == 1) {

                $data['postTitleEn'] = $row->productCBrand . "" . $row->productCModel;
            } else if ($data['CategoryId'] == 2) {

                $data['postTitleEn'] = $row->productBBrand . "" . $row->productBModel;
            } else if ($data['CategoryId'] == 3) {

                $data['postTitleEn'] = $row->productNPCode . "" . $row->productNPEmrites;
            } else if ($data['CategoryId'] == 4) {

                $data['postTitleEn'] = $row->productVBrand . "" . $row->productVModel;
            } else if ($data['CategoryId'] == 5) {

                $data['postTitleEn'] = $row->productWBrand . "" . $row->productWModel;
            } else if ($data['CategoryId'] == 6) {

                $data['postTitleEn'] = $row->productMNPrefix . "" . $row->productMNNmbr;
            } else if ($data['CategoryId'] == 7) {

                $data['postTitleEn'] = $row->productBtBrand . "" . $row->productBtModel;
            } else if ($data['CategoryId'] == 8) {

                $data['postTitleEn'] = $row->productPBrand . "" . $row->productPModel;
            } else if ($data['CategoryId'] == 9) {


                $data['postTitleEn'] = $row->productPropType . "" . $row->productPropSC;
            } else {

                $data['postTitleEn'] = "";
            }

//           
            $row_post[] = $data;
            $data = '';
        }
         return $row_post;
    }
        function get_recentimage()
   {
        $car=$this->db->query('select category.productCategoryID,category.category_name,category.categoryProductCount, productcar.Cpost_main_img as image from  category right join productcar on category.productCategoryID=productcar.productCategoryID order by productcar.productCSubmitDate DESC limit 1');
        $c1=$car->result();
        $bike=$this->db->query('select category.productCategoryID,category.category_name,category.categoryProductCount,  productbike.Bpost_main_img as image from category right join productbike on category.productCategoryID=productbike.productCategoryID order by productbike.productBSubmitDate DESC limit 1 ');
        $b1=$bike->result();
        $numberplate=$this->db->query('select category.productCategoryID,category.category_name,category.categoryProductCount,  productnp.NPpost_main_img as image from category right join productnp on category.productCategoryID=productnp.productCategoryID order by productnp.productNPSubmitDate DESC limit 1');
        $np1=$numberplate->result();
        $vertu=$this->db->query('select category.productCategoryID,category.category_name,category.categoryProductCount,  productvertu.Vpost_main_img as image from category right join productvertu on category.productCategoryID=productvertu.productCategoryID order by productvertu.productVSubmitDate DESC limit 1');
        $v1=$vertu->result();
        $watch=$this->db->query('select category.productCategoryID,category.category_name,category.categoryProductCount,  productwatch.Wpost_main_img as image from category right join productwatch on category.productCategoryID=productwatch.productCategoryID order by productwatch.productWSubmitDate DESC limit 1');
        $w1=$watch->result();
        $boat=$this->db->query('select category.productCategoryID,category.category_name,category.categoryProductCount,  productboat.BTpost_main_img as image from category right join productboat on category.productCategoryID=productboat.productCategoryID order by productboat.productBTSubmitDate DESC limit 1');
        $bt1=$boat->result();
        $phone=$this->db->query('select category.productCategoryID,category.category_name,category.categoryProductCount,  productphone.PHpost_main_img as image from category right join productphone on category.productCategoryID=productphone.productCategoryID order by productphone.productPSubmitDate DESC limit 1');
        $p1=$phone->result();
        $property=$this->db->query('select category.productCategoryID,category.category_name,category.categoryProductCount,  productproperty.PRpost_main_img as image from category right join productproperty on category.productCategoryID=productproperty.productCategoryID order by productproperty.productPRSubmitDate DESC limit 1');
        $propty=$property->result();
        $mn=$this->db->query('select category.productCategoryID,category.category_name,category.categoryProductCount,  productmn.MNpost_main_img as image from  category right join productmn on category.productCategoryID=productmn.productCategoryID order by productmn.productMNSubmitDate DESC limit 1');
       $mobno=$mn->result();
        return array($c1,$b1,$np1,$v1,$w1,$mobno,$bt1, $p1,$propty);
   }    
    function Car_postcount()
   {
         $query=$this->db->query('select categoryProductCount from category where productCategoryID=1');
          return $query->result();
   }
   function Bike_postcount()
   {
         $query=$this->db->query('select categoryProductCount from category where productCategoryID=2');
          return $query->result();
   }
   function Vertu_postcount()
   {
         $query=$this->db->query('select categoryProductCount from category where productCategoryID=4');
          return $query->result();
   }
     function Boat_postcount()
   {
         $query=$this->db->query('select categoryProductCount from category where productCategoryID=7');
          return $query->result();
   }
    function Watch_postcount()
   {
         $query=$this->db->query('select categoryProductCount from category where productCategoryID=5');
          return $query->result();
   }
    function Phone_postcount()
   {
         $query=$this->db->query('select categoryProductCount from category where productCategoryID=8');
          return $query->result();
   }
   function Property_postcount()
   {
         $query=$this->db->query('select categoryProductCount from category where productCategoryID=9');
          return $query->result();
   }
   function NP_postcount()
   {
         $query=$this->db->query('select categoryProductCount from category where productCategoryID=3');
          return $query->result();
   }
    function MN_postcount()
   {
         $query=$this->db->query('select categoryProductCount from category where productCategoryID=6');
         return $query->result();
   }
  function get_post_lists($per_page_cnt,$limit)
   {
      $qry=$this->db->query('SELECT DISTINCT post.postID,post.productCategoryID,post.productID,flaggeditems.flagStatus,productiv.productViewCount,productcar.cartCType ,productcar.productCSubmitDate ,productcar.productCPrice ,productcar.Cpost_main_img ,productcar.productCBrand ,productcar.productCModel ,productcar.productCDesc,productcar.productCCallPrice ,productcar.productCStatus,
      productbike.cartBType,  productbike.productBSubmitDate,productbike.productBPrice,productbike.Bpost_main_img,productbike.productBBrand,productbike.productBModel,productbike.productBDesc as bikeDesciption,productbike.productBCallPrice,productbike.productBStatus,
       productboat.cartBTType, productboat.productBTSubmitDate,productboat.productBTPrice,productboat.BTpost_main_img,productboat.productBtBrand,productboat.productBtModel,productboat.productBDesc as boatDesc,productboat.productBtCallPrice,productboat.productBTStatus,
       productwatch.cartWType, productwatch.productWSubmitDate,productwatch.productWPrice,productwatch.Wpost_main_img,productwatch.productWBrand,productwatch.productWModel,productwatch.productWDesc,productwatch.productWCallPrice,productwatch.productWStatus,
       productvertu.cartVType, productvertu.productVSubmitDate,productvertu.productVPrice,productvertu.Vpost_main_img,productvertu.productVBrand,productvertu.productVModel,productvertu.productVDesc,productvertu.productVCallPrice,productvertu.productVStatus,
       productproperty.cartPRType, productproperty.productPRSubmitDate,productproperty.productPRPrice,productproperty.PRpost_main_img,productproperty.productPropSC,productproperty.productPropType,productproperty.productDesc,productproperty.productPropCallPrice,productproperty.productPRStatus,productproperty.productPropType,
       productphone.cartPHType, productphone.productPSubmitDate,productphone.productPHPrice,productphone.PHpost_main_img,productphone.productPBrand,productphone.productPModel,productphone.productPDesc,productphone.productPhCallPrice,productphone.productPHStatus,
      productnp.cartNPType,  productnp.productNPSubmitDate,productnp.productNPPrice,productnp.NPpost_main_img,productnp.productNPCode,productnp.productNPNmbr,productnp.productNPDesc,productnp.productNPCallPrice,productnp.productNPStatus,
      productmn.cartMNType, productmn.productMNSubmitDate,productmn.productMNPrice,productmn.MNpost_main_img,productmn.productOperator,productmn.productMNNmbr,productmn.productMNDesc,productmn.productMNCallPrice,productmn.productMNStatus,productmn.productOperator,trader.traderID FROM `post`
        left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
        left JOIN `flaggeditems` ON (`post`.`productCategoryID`=`flaggeditems`.`productCategoryID` and post.productID=flaggeditems.productID)
        left JOIN `productiv` ON (`post`.`postID`=`productiv`.`postID` and post.productCategoryID=productiv.productCategoryID)
        left join productcar on (post.productCategoryID=productcar.productCategoryID and post.productID=productcar.productID)
        left join productbike on (post.productCategoryID=productbike.productCategoryID and post.productID=productbike.productID)
        left join productboat on (post.productCategoryID=productboat.productCategoryID and post.productID=productboat.productID)
        left join productmn on (post.productCategoryID=productmn.productCategoryID and post.productID=productmn.productID)
        left join productnp on (post.productCategoryID=productnp.productCategoryID and post.productID=productnp.productID)
        left join productphone on (post.productCategoryID=productphone.productCategoryID and post.productID=productphone.productID)
        left join productproperty on (post.productCategoryID=productproperty.productCategoryID and post.productID=productproperty.productID)
        left join productvertu on (post.productCategoryID=productvertu.productCategoryID and  post.productID=productvertu.productID)
        left join productwatch on (post.productCategoryID=productwatch.productCategoryID and post.productID=productwatch.productID) order by post.postSubmissionOn DESC limit '. $per_page_cnt .' offset '.$limit ); 
      
      foreach ($qry->result() as $row) {
            $data['postId'] = $row->postID;
            $data['categoryId'] = $row->productCategoryID;
            $data['ProductId'] = $row->productID;
            $data['Flagstatus'] = $row->flagStatus;
            
            if ($data['categoryId'] == 1) {
                $data['image'] = $row->Cpost_main_img;
                $data['is_alshamilProduct'] = $row->cartCType;
                $data['publishedOn'] = $row->productCSubmitDate;
                $data['Price'] = $row->productCPrice;
                $data['titileEn'] = $row->productCBrand." ".$row->productCModel;
                $data['titleAr'] = "";
                $data['productDesc'] = $row->productCDesc;
                $data['CallPrice'] = $row->productCCallPrice;
                $data['status'] = $row->productCStatus;
            } else if ($data['categoryId']  == 2) {
              $data['is_alshamilProduct'] = $row->cartBType;
               $data['image'] = $row->Bpost_main_img;
               $data['publishedOn'] = $row->productBSubmitDate;
               $data['Price']= $row->productBPrice;
                $data['titileEn']= $row->productBBrand." ".$row->productBModel;
                 $data['titleAr']= "";
               $data['productDesc'] = $row->bikeDesciption;
                $data['CallPrice']= $row->productBCallPrice;
                  $data['status'] = $row->productBStatus;
            } else if ($data['categoryId']  == 3) {
                $data['is_alshamilProduct'] = $row->cartNPType;
               $data['image'] = $row->NPpost_main_img;
              $data['publishedOn'] = $row->productNPSubmitDate;
               $data['Price'] = $row->productNPPrice;
               $data['titileEn']= $row->productNPCode." ". $row->productNPNmbr;
                 $data['titleAr']= "";
             $data['productDesc'] = $row->productNPDesc;
              $data['CallPrice'] = $row->productNPCallPrice;
                 $data['status'] = $row->productNPStatus;
            } else if ($data['categoryId']  == 4) {
                 $data['is_alshamilProduct']= $row->cartVType;
                $data['image'] = $row->Vpost_main_img;
               $data['publishedOn']= $row->productVSubmitDate;
              $data['Price'] = $row->productVPrice;
               $data['titileEn'] = $row->productVBrand." ".$row->productVModel;
             $data['titleAr'] = "";
              $data['productDesc']= $row->productVDesc;
               $data['CallPrice'] = $row->productVCallPrice;
                $data['status']= $row->productVStatus;
            } else if ($data['categoryId']  == 5) {
                 $data['is_alshamilProduct'] = $row->cartWType;
               $data['image'] = $row->Wpost_main_img;
              $data['publishedOn'] = $row->productWSubmitDate;
              $data['Price']= $row->productWPrice;
             $data['titileEn'] = $row->productWBrand." ".$row->productWModel;
            $data['titleAr'] = "";
               $data['productDesc']= $row->productWDesc;
               $data['CallPrice'] = $row->productWCallPrice;
                 $data['status']= $row->productWStatus;
            } else if ($data['categoryId']  == 6) {
                $data['is_alshamilProduct']= $row->cartMNType;
                $data['image'] = $row->MNpost_main_img;
               $data['publishedOn']= $row->productMNSubmitDate;
             $data['Price'] = $row->productMNPrice;
               $data['titileEn'] = $row->productOperator." ".$row->productMNNmbr;
              $data['titleAr'] ="";
              $data['productDesc'] = $row->productMNDesc;
                $data['CallPrice']= $row->productMNCallPrice;
                  $data['status'] = $row->productMNStatus;
            } else if ($data['categoryId']  == 7) {
                   $data['is_alshamilProduct'] = $row->cartBTType;
                $data['image'] = $row->BTpost_main_img;
               $data['publishedOn']= $row->productBTSubmitDate;
             $data['Price'] = $row->productBTPrice;
                $data['titileEn'] = $row->productBtBrand." ".$row->productBtModel;
               $data['titleAr']= "";
               $data['productDesc'] = $row->boatDesc;
               $data['CallPrice']= $row->productBtCallPrice;
                 $data['status'] = $row->productBTStatus;
            } else if ($data['categoryId'] == 8) {
                 $data['is_alshamilProduct'] = $row->cartPHType;
              $data['image']= $row->PHpost_main_img;
             $data['publishedOn'] = $row->productPSubmitDate;
              $data['Price'] = $row->productPHPrice;
              $data['titileEn'] = $row->productPBrand." ".$row->productPModel;
               $data['titleAr']="";
              $data['productDesc'] = $row->productPDesc;
               $data['CallPrice'] = $row->productPhCallPrice;
                  $data['status'] = $row->productPHStatus;
            } else if ($data['categoryId']  == 9) {
                 $data['is_alshamilProduct'] = $row->cartPRType;
              $data['image'] = $row->PRpost_main_img;
              $data['publishedOn'] = $row->productPRSubmitDate;
             $data['Price'] = $row->productPRPrice;
               $data['titileEn'] = $row->productPropType." ". $row->productPropSC;
             $data['titleAr'] = "";
               $data['productDesc']= $row->productDesc;
              $data['CallPrice'] = $row->productPropCallPrice;
                  $data['status'] = $row->productPRStatus;
            } else {
                  $data['is_alshamilProduct']= "";
                $data['image'] = "";
              $data['publishedOn'] = "";
              $data['Price'] = "";
              $data['titileEn'] = "";
                  $data['titleAr'] = "";
               $data['productDesc'] = "";
             $data['CallPrice'] = "";
                  $data['status']= "";
            }
            
            $data['ProductViewCount'] = $row->productViewCount;
            $data['TraderID'] = $row->traderID;
            $row_post[] = $data;
            $data='';
            
        }
         return $row_post;
      
//               return $qry->result ();
   }
   
   
   
   
   
  function filter($categoryId,$carBrand,$carModel,$carStartDate,$carEndDate,$bikeBrand,$bikeModel,$bikeStartDate,$bikeEndDate,$npEmirate, $npCode,$npDigitCount,$vertuBrand,$vertuModel,$watchBrand,$watchModel,$mnPrefix,$mnOperator,$mnDigitCount,$boatBrand,$boatModel,$phoneBrand,$phoneModel,$propertiesCategory,$propertiesSubCategory,$per_page_cnt,$limit)
 {
    
    if  ($categoryId==1)
    {
      $qry=$this->db->query("SELECT `post`.`postID` as postId,`post`.`productCategoryID` as CategoryId,post.productID,
          concat(`productcar`.`productCBrand`, `productcar`.`productCModel`)as titleEn,`productcar`.`productCPrice` as price,productcar.Cpost_main_img as image,productcar.productCSubmitDate as publishedOn,productcar.cartCType as is_alshamilProduct,productcar.productCStatus as status,trader.`traderID`, `trader`.`traderFullName` as traderName, `trader`.`traderLocation`, `trader`.`traderImage`
            from post
           left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
           left JOIN `productcar` ON (`post`.`productCategoryID`=`productcar`.`productCategoryID` AND `post`.`productID`=`productcar`.`productID`)
           where productcar.productCategoryID=1 and (productcar.productCBrand like '%".$carBrand."' and productcar.productCmodel like '%".$carModel."' and productcar.productCReleaseYear like '%".$carStartDate."' and productcar.productCReleaseYear like '%".$carEndDate."') limit ".$per_page_cnt." offset ".$limit." "); 
           return $qry->result(); 
    }
    else if($categoryId==2)
    {
        $qry=$this->db->query("SELECT `post`.`postID` as postId,`post`.`productCategoryID` as CategoryId,post.productID,
          concat (`productbike`.`productBBrand`,`productbike`.`productBModel`)as titleEn,`productbike`.`productBPrice` as price,productbike.Bpost_main_img as image,productbike.productBSubmitDate as publishedOn,productbike.cartBType as is_alshamilProduct,productbike.productBStatus as status,trader.`traderID`, `trader`.`traderFullName` as traderName, `trader`.`traderLocation`, `trader`.`traderImage`
            from post
           left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
           left JOIN `productbike` ON (`post`.`productCategoryID`=`productbike`.`productCategoryID` AND `post`.`productID`=`productbike`.`productID`)
           where productbike.productCategoryID=1 and (productbike.productBBrand like '%".$carBrand."' and productbike.productBmodel like '%".$carModel."' and productbike.productBReleaseYear like '%".$carStartDate."' and productbike.productBReleaseYear like '%".$carEndDate."') limit ".$per_page_cnt." offset ".$limit." "); 
           return $qry->result(); 
        
        
    }
        
     else if($categoryId==3)
    {
        $qry=$this->db->query("SELECT `post`.`postID` as postId,`post`.`productCategoryID` as CategoryId,post.productID,
          concat (`productnp`.`productNPCode`, productnp.productNPDigits )as titleEn ,`productnp`.`productNPPrice` as price,productnp.NPpost_main_img as image,productnp.productNPSubmitDate as publishedOn,productnp.cartNPType as is_alshamilProduct,productnp.productNPStatus as status,trader.`traderID`, `trader`.`traderFullName` as traderName, `trader`.`traderLocation`, `trader`.`traderImage`
            from post
           left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
           left JOIN `productnp` ON (`post`.`productCategoryID`=`productnp`.`productCategoryID` AND `post`.`productID`=`productnp`.`productID`)
           where productnp.productCategoryID=3 and (productnp.productNPCode like '%".$npCode."' and productnp.productNPDigits like '%".$npDigitCount."') limit ".$per_page_cnt." offset ".$limit." "); 
           return $qry->result(); 
    }    
        
      else if($categoryId==4)
    {
        $qry=$this->db->query("SELECT `post`.`postID` as postId,`post`.`productCategoryID` as CategoryId,post.productID,
           concat(`productvertu`.`productVBrand`, `productvertu`.`productVModel`) as titleEn,`productvertu`.`productVPrice` as price,productvertu.Vpost_main_img as image,productvertu.productVSubmitDate as publishedOn,productvertu.cartVType as is_alshamilProduct,productvertu.productVStatus as status,trader.`traderID`, `trader`.`traderFullName` as traderName, `trader`.`traderLocation`, `trader`.`traderImage`
            from post
           left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
           left JOIN `productvertu` ON (`post`.`productCategoryID`=`productvertu`.`productCategoryID` AND `post`.`productID`=`productvertu`.`productID`)
           where productvertu.productCategoryID=4 and (productvertu.productVBrand like '%".$vertuBrand."' and productvertu.productVmodel like '%".$vertuModel."' ) limit ".$per_page_cnt." offset ".$limit." "); 
           return $qry->result(); 
        
        
    }
          
     else if($categoryId==5)
    {
        $qry=$this->db->query("SELECT `post`.`postID` as postId,`post`.`productCategoryID` categoryId,post.productID,
          concat( `productwatch`.`productWBrand`, `productwatch`.`productWModel`) as titleEn,`productwatch`.`productWPrice` as price,productwatch.Wpost_main_img as image,productwatch.productWSubmitDate as publishedOn,productwatch.cartWType as is_alshamilProduct,productwatch.productWStatus as status,trader.`traderID`, `trader`.`traderFullName` as traderName, `trader`.`traderLocation`, `trader`.`traderImage`
            from post
           left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
           left JOIN `productwatch` ON (`post`.`productCategoryID`=`productwatch`.`productCategoryID` AND `post`.`productID`=`productwatch`.`productID`)
           where productwatch.productCategoryID=5 and (productwatch.productWBrand like '%".$watchBrand."' and productwatch.productWmodel like '%".$watchModel."' )limit ".$per_page_cnt." offset ".$limit."  "); 
           return $qry->result(); 
        
        
    }
    
    
     else if($categoryId==6)
    {
        $qry=$this->db->query("SELECT `post`.`postID` as postId,`post`.`productCategoryID` as CategoryId,post.productID,
           concat(`productmn`.`productMNPrefix`, `productmn`.`productMNDigits`)as titleEn,`productmn`.`productMNNmbr` as MobileNumber,productmn.productMNPrice as price,productmn.MNpost_main_img as image,productmn.productMNSubmitDate as publishedOn,productmn.cartMNType as is_alshamilProduct,productmn.productMNStatus as status,trader.`traderID`, `trader`.`traderFullName` as traderName, `trader`.`traderLocation`, `trader`.`traderImage`
            from post
           left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
           left JOIN `productmn` ON (`post`.`productCategoryID`=`productmn`.`productCategoryID` AND `post`.`productID`=`productmn`.`productID`)
           where productmn.productCategoryID=6 and (productmn.productMNPrefix like '%".$mnPrefix."' and productmn.productOperator like '%".$mnOperator."' and productmn.productMNDigits like '%".$mnDigitCount."' ) limit ".$per_page_cnt." offset ".$limit." "); 
           return $qry->result(); 
        
        
    }
    
     else if($categoryId==7)
    {
        $qry=$this->db->query("SELECT `post`.`postID` as postId,`post`.`productCategoryID` as CategoryId,post.productID,
           concat(`productboat`.`productBtBrand`, `productboat`.`productBtModel`)as titleEn ,`productboat`.`productBTPrice` as price,productboat.BTpost_main_img as image,productboat.productBTSubmitDate as publishedOn,productboat.cartBTType as Is_alshamilProduct,productboat.productBTStatus as status,trader.`traderID`, `trader`.`traderFullName` as traderName, `trader`.`traderLocation`, `trader`.`traderImage`
            from post
           left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
           left JOIN `productboat` ON (`post`.`productCategoryID`=`productboat`.`productCategoryID` AND `post`.`productID`=`productboat`.`productID`)
           where productboat.productCategoryID=7 and (productboat.productBtBrand like '%".$boatBrand."' and productboat.productBTmodel like '%".$boatModel."' ) limit ".$per_page_cnt." offset ".$limit." "); 
           return $qry->result(); 
        
        
    }
     else if($categoryId==8)
    {
        $qry=$this->db->query("SELECT `post`.`postID` as postId,`post`.`productCategoryID` as CategoryId,post.productID,
           concat(`productphone`.`productPBrand`, `productphone`.`productPModel`) as titleEn,`productphone`.`productPHPrice` as price,productphone.PHpost_main_img as image,productphone.productPSubmitDate as publishedOn,productphone.cartPHType as is_alshamilProduct,productphone.productPHStatus as status,trader.`traderID`, `trader`.`traderFullName` as traderName, `trader`.`traderLocation`, `trader`.`traderImage`
            from post
           left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
           left JOIN `productphone` ON (`post`.`productCategoryID`=`productphone`.`productCategoryID` AND `post`.`productID`=`productphone`.`productID`)
           where productphone.productCategoryID=8 and (productphone.productPBrand like '%".$phoneBrand."' and productphone.productPmodel like '%".$phoneModel."' )limit ".$per_page_cnt." offset ".$limit."  "); 
           return $qry->result(); 
        
        
    }
     else if($categoryId==9)
    {
        $qry=$this->db->query("SELECT `post`.`postID` as postId,`post`.`productCategoryID` CategoryId,post.productID,
           concat(`productproperty`.`productPropSC`, `productproperty`.`productPropType`) as titleEn,`productproperty`.`productPRPrice` as price,productproperty.PRpost_main_img as image,productproperty.productPRSubmitDate as publishedOn,productproperty.cartPRType as is_alshamilProduct,productproperty.productPRStatus as status,trader.`traderID`, `trader`.`traderFullName` as traderName, `trader`.`traderLocation`, `trader`.`traderImage`
            from post
           left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
           left JOIN `productproperty` ON (`post`.`productCategoryID`=`productproperty`.`productCategoryID` AND `post`.`productID`=`productproperty`.`productID`)
           where productproperty.productCategoryID=9 and (productproperty.productPropType like '%".$propertiesCategory."' and productproperty.productPropSC like '%".$propertiesSubCategory."' )limit ".$per_page_cnt." offset ".$limit."  "); 
           return $qry->result(); 
        
        
    }
  
 }
   function get_traderlist($txtemail, $txtpassword,$txtusertype) {

        $this->db->select('traderID as userId,traderFullName as nameEn,traderImage as profileImage,traderLocation as locationEn,traderContactNum as mobile,traderEmailID as email,traderInfo as descriptionEn,socialWeb as website,socialFb as facebook,socialInsta as instagram,socialSnap as snapchat,socialtwitter as twitter,usertype as userTypeId');
        $this->db->from('trader');
        $this->db->where('traderEmailID', $txtemail);
        $this->db->where('traderPasswd', $txtpassword);
        $this->db->where('userType', $txtusertype);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    function profileimage($userId)
   {
        $this->db->select('traderImage');
        $this->db->from('trader');
        $this->db->where('traderID', $userId);
       $query = $this->db->get();
      return $query->result();
       
   }
     function get_product_list() {

        
        $query = $this->db->query('SELECT productiv.productID,productiv.productVideo,productiv.productVideoCount,productiv.productSubmitDate,productcar.productCBrand,productcar.productCModel,productbike.productBBrand,productbike.productBModel,productboat.productBtBrand,productboat.productBtModel,productvertu.productVBrand,productvertu.productVModel,productwatch.productWBrand,productwatch.productWModel,productproperty.productPropSC,productproperty.productPropType,productmn.productMNNmbr,productnp.productNPEmrites,productnp.productNPCode,productphone.productPBrand,productphone.productPModel FROM `productiv`

left join productcar on (productiv.productCategoryID=productcar.productCategoryID or productiv.productID=productcar.productID)

left join productbike on (productiv.productCategoryID=productbike.productCategoryID or productiv.productID=productbike.productID)

left join productboat on (productiv.productCategoryID=productboat.productCategoryID or productiv.productID=productboat.productID)

left join productvertu on (productiv.productCategoryID=productvertu.productCategoryID or productiv.productID=productvertu.productID)

left join productwatch on (productiv.productCategoryID=productwatch.productCategoryID or productiv.productID=productwatch.productID)

left join productproperty on (productiv.productCategoryID=productproperty.productCategoryID or productiv.productID=productproperty.productID)

left join productmn on (productiv.productCategoryID=productmn.productCategoryID or productiv.productID=productmn.productID)

left join productnp on (productiv.productCategoryID=productnp.productCategoryID or productiv.productID=productnp.productID)

left join productphone on (productiv.productCategoryID=productphone.productCategoryID or productiv.productID=productphone.productID)

where productiv.productVideo != " "
order by productiv.productSubmitDate desc limit 3');

        return $query->result();
    }
    
    function latest_post()
   {
        //$qry = $this->db->query('SELECT *,traderID as tr,productID as pr,(select trader.traderFullName from trader where trader.traderID=tr) as trader_name,(select trader.traderImage from trader where trader.traderID=tr) as trader_img,(select trader.traderLocation from trader where trader.traderID=tr) as trader_loc FROM ( (SELECT * FROM productcar) UNION (SELECT * FROM productbike) UNION (SELECT * FROM productboat) UNION (SELECT * FROM productmn) UNION (SELECT * FROM productnp) UNION (SELECT * FROM productphone) UNION (SELECT * FROM productproperty) UNION (SELECT * FROM productvertu) UNION (SELECT * FROM productwatch)) a ORDER BY a.post_date desc limit 8');
       $qry = $this->db->query('SELECT post.postID,post.productCategoryID,post.postSubmissionOn,trader.traderID,trader.traderFullName,trader.traderLocation,trader.traderImage,post.productID,
productcar.productCPrice ,productcar.Cpost_main_img ,concat(productcar.productCBrand,productcar.productCModel) as product_name1,productcar.cartCType, 
     productbike.productBPrice ,productbike.Bpost_main_img ,concat(productbike.productBBrand,productbike.productBModel) as product_name2,productbike.cartBType ,
      productboat.productBTPrice ,productboat.BTpost_main_img ,concat(productboat.productBtBrand,productboat.productBtModel) as product_name3,productboat.cartBTType ,
      productwatch.productWPrice ,productwatch.Wpost_main_img ,concat(productwatch.productWBrand,productwatch.productWModel) as product_name4,productwatch.cartWType ,
      productvertu.productVPrice ,productvertu.Vpost_main_img ,concat(productvertu.productVBrand,productvertu.productVModel) as product_name5,productvertu.cartVType ,
      productproperty.productPRPrice ,productproperty.PRpost_main_img ,concat(productproperty.productPropSC,productproperty.productPropType) as product_name6,productproperty.cartPRType ,
      productphone.productPHPrice ,productphone.PHpost_main_img ,concat(productphone.productPBrand,productphone.productPModel) as product_name7,productphone.cartPHType ,
    productnp.productNPPrice ,productnp.NPpost_main_img,concat(productnp.productNPCode,productnp.productNPNmbr) as product_name8,productnp.productNPDigits,productnp.cartNPType ,
      productmn.productMNPrice ,productmn.MNpost_main_img ,productmn.productOperator,productmn.productMNDigits,productmn.productMNNmbr as product_name9,productmn.cartMNType  FROM `post`
        left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
       
        left join productcar on (post.productCategoryID=productcar.productCategoryID and post.productID=productcar.productID)
        left join productbike on (post.productCategoryID=productbike.productCategoryID and post.productID=productbike.productID)
        left join productboat on (post.productCategoryID=productboat.productCategoryID and post.productID=productboat.productID)
        left join productmn on (post.productCategoryID=productmn.productCategoryID and post.productID=productmn.productID)
        left join productnp on (post.productCategoryID=productnp.productCategoryID and post.productID=productnp.productID)
        left join productphone on (post.productCategoryID=productphone.productCategoryID and post.productID=productphone.productID)
        left join productproperty on (post.productCategoryID=productproperty.productCategoryID and post.productID=productproperty.productID)
        left join productvertu on (post.productCategoryID=productvertu.productCategoryID and  post.productID=productvertu.productID)
        left join productwatch on (post.productCategoryID=productwatch.productCategoryID and post.productID=productwatch.productID) order by post.postSubmissionOn DESC limit 
        8');
        return $qry->result();
        
   }
   function category_count($cat)
   {
       $qry=$this->db->query('select categoryProductCount from category where productCategoryID='.$cat);
       return $qry->result();
   }
   function trader_post_count($trader_id)
   {
       $traderqry=$this->db->query('select traderPostCount from trader where traderID='.$trader_id);
       return $traderqry->result();
       
   }
   function get_templates()
   {
       $template_qry=$this->db->query('select * from noplate_template');
       return $template_qry->result();
   }
   function get_template_imgs($emirates)
   {
       
       $this->db->select('templates');
        $this->db->from('noplate_template');
        $this->db->where('emirates',$emirates);
       $temp_img_qry = $this->db->get();
     //$temp_img_qry=$this->db->query('select templates from noplate_template where emirates='.$emirates);
       return $temp_img_qry->result();  
   }
   function categories()
   {
       $qry = $this->db->query('SELECT productCategoryID as catid,(select count(*) from post where productCategoryID=catid) as cnt,(select category_name from category where productCategoryID=catid) as cat_name FROM ( (SELECT * FROM productcar) UNION (SELECT * FROM productbike) UNION (SELECT * FROM productboat) UNION (SELECT * FROM productmn) UNION (SELECT * FROM productnp) UNION (SELECT * FROM productphone) UNION (SELECT * FROM productproperty) UNION (SELECT * FROM productvertu) UNION (SELECT * FROM productwatch)) a group by productCategoryID');
       return $qry->result();
   }
   
   function get_post_catid($category_id)
   {
      $this->db->select('post.postID,trader.traderFullName,trader.traderImage,trader.traderLocation,productcar.productCSubmitDate,productcar.productPrice,
        productbike.productBSubmitDate,productbike.productPrice,
        productboat.productBSubmitDate,productboat.productPrice,
        productwatch.productWSubmitDate,productwatch.productPrice,
        productvertu.productVSubmitDate,productvertu.productPrice,
        productproperty.productSubmitDate,productproperty.productPrice,
        productphone.productPSubmitDate,productphone.productPrice,
        productnp.productNPSubmitDate,productnp.productNPPrice,
        productmn.productMNSubmitDate,productmn.productMNPrice'); 
        $this->db->join('trader','product.traderID=trader.traderID');
        $this->db->join('productcar','post.productCategoryID=productcar.productCategoryID');
        $this->db->join('productbike','post.productCategoryID=productbike.productCategoryID');
        $this->db->join('productboat','post.productCategoryID=productboat.productCategoryID');
        $this->db->join('productmn','post.productCategoryID=productmn.productCategoryID');
        $this->db->join('productnp','post.productCategoryID=productnp.productCategoryID');
        $this->db->join('productphone','post.productCategoryID=productphone.productCategoryID');
        $this->db->join('productproperty','post.productCategoryID=productproperty.productCategoryID');
        $this->db->join('productvertu','post.productCategoryID=productvertu.productCategoryID');
        $this->db->join('productwatch','post.productCategoryID=productwatch.productCategoryID');
        $this->db->where('post.productCategoryID', $category_id);
         $qry = $this->db->get();
       return $qry->result();
   }
      function get_post_traderid($trader_id,$per_page_cnt,$limit)
   {
      $qry=$this->db->query('SELECT `post`.`postID`,productiv.productViewCount,post.productCategoryID,post.productID,productcar.productCBrand,productcar.productCModel,`productcar`.`productCSubmitDate`, `productcar`.`productCPrice`,productcar.productCStatus,productcar.cartCType,productcar.Cpost_main_img,productbike.productBBrand,productbike.productBModel,`productbike`.`productBSubmitDate`, `productbike`.`productBPrice`,productbike.productBStatus,productbike.cartBType,productbike.Bpost_main_img,productboat.productBtBrand,productboat.productBtModel,`productboat`.`productBTSubmitDate`, `productboat`.`productBTPrice`,productboat.productBTStatus,productboat.cartBTTYpe,productboat.BTpost_main_img,productwatch.productWBrand,productwatch.productWModel,`productwatch`.`productWSubmitDate`, `productwatch`.`productWPrice`,productwatch.productWStatus,productvertu.productVBrand,productvertu.productVModel, `productvertu`.`productVSubmitDate`,productwatch.cartWType,productwatch.Wpost_main_img, `productvertu`.`productVPrice`,productvertu.productVStatus,productvertu.cartVType ,productvertu.vpost_main_img,productproperty.productPropType,productproperty.productPropSC,`productproperty`.`productPRSubmitDate`, `productproperty`.`productPRPrice`,productproperty.productPRStatus,productproperty.cartPRType,productproperty.PRpost_main_img,productphone.productPBrand,productphone.productPModel,`productphone`.`productPSubmitDate`, `productphone`.`productPHPrice`,productphone.productPHStatus ,productphone.cartPHType,productphone.PHpost_main_img,productnp.productNPCode,productnp.productNPDigits,productnp.productNPNmbr,`productnp`.`productNPSubmitDate`, `productnp`.`productNPPrice`,productnp.productNPStatus ,productnp.cartNPType,productnp.NPpost_main_img,productmn.productMNNmbr,productmn.productMNDigits,`productmn`.`productMNPrice`,productmn.productMNStatus,productmn.productMNSubmitDate,productmn.cartMNType,productmn.MNpost_main_img,productmn.productOperator
        from post
        left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
         left JOIN `productiv` ON (`post`.`postID`=`productiv`.`postID` and post.productID=productiv.productID)
        left JOIN `productcar` ON (`post`.`productCategoryID`=`productcar`.`productCategoryID` and `post`.`productID`=`productcar`.`productID`)
        left JOIN `productbike` ON (`post`.`productCategoryID`=`productbike`.`productCategoryID` and `post`.`productID`=`productbike`.`productID`) 
        left JOIN `productboat` ON (`post`.`productCategoryID`=`productboat`.`productCategoryID` and `post`.`productID`=`productboat`.`productID`)
        left JOIN `productmn` ON (`post`.`productCategoryID`=`productmn`.`productCategoryID` and `post`.`productID`=`productmn`.`productID`)
        left JOIN `productnp` ON (`post`.`productCategoryID`=`productnp`.`productCategoryID` and `post`.`productID`=`productnp`.`productID`)
        left JOIN `productphone` ON (`post`.`productCategoryID`=`productphone`.`productCategoryID` and `post`.`productID`=`productphone`.`productID`)
        left JOIN `productproperty` ON (`post`.`productCategoryID`=`productproperty`.`productCategoryID` and `post`.`productID`=`productproperty`.`productID`)
        left JOIN `productvertu` ON (`post`.`productCategoryID`=`productvertu`.`productCategoryID` and `post`.`productID`=`productvertu`.`productID`) 
        left JOIN `productwatch` ON (`post`.`productCategoryID`=`productwatch`.`productCategoryID` and `post`.`productID`=`productwatch`.`productID`)
        WHERE `post`.`traderID` = '.$trader_id .' order by post.postSubmissionOn DESC   limit '.$per_page_cnt.' offset '.$limit); 
         
      foreach ($qry->result() as $row) {
            $data['postId'] = $row->postID;
            $data['categoryId'] = $row->productCategoryID;
            $data['ProductId'] = $row->productID;
           $data['views'] = $row->productViewCount;
            
            if ($data['categoryId'] == 1) {
                $data['image'] = $row->Cpost_main_img;
                $data['is_alshamilProduct'] = $row->cartCType;
                $data['publishedOn'] = $row->productCSubmitDate;
                $data['price'] = $row->productCPrice;
                $data['titleEn'] = $row->productBBrand." ".$row->productBModel;
                $data['titleAr'] ="" ;
                $data['Model'] = $row->productCModel;
                $data['status'] = $row->productCStatus;
            } else if ($data['categoryId' ]== 2) {
               $data['is_alshamilProduct'] = $row->cartBType;
                $data['image']  = $row->Bpost_main_img;
                 $data['publishedOn'] = $row->productBSubmitDate;
                $data['price']= $row->productBPrice;
                 $data['titleEn']  = $row->productBBrand." ".$row->productBModel;
                  $data['titleAr'] = "";
               $data['status'] = $row->productBStatus;
            } else if ($data['categoryId'] == 3) {
                $data['is_alshamilProduct'] = $row->cartNPType;
              $data['image']  = $row->NPpost_main_img;
                 $data['publishedOn']= $row->productNPSubmitDate;
               $data['price'] = $row->productNPPrice;
                 $data['titleEn'] = $row->productNPCode." ".$row->productNPNmbr;
                  $data['titleAr']= "";
                 $data['status'] = $row->productNPStatus;
            } else if ($data['categoryId'] == 4) {
                $data['is_alshamilProduct'] = $row->cartVType;
              $data['image'] = $row->Vpost_main_img;
                $data['publishedOn'] = $row->productVSubmitDate;
                 $data['price'] = $row->productVPrice;
                  $data['titleEn'] = $row->productVBrand." ". $row->productVModel;
                   $data['titleAr'] ="";
               
               $data['status'] = $row->productVStatus;
            } else if ($data['categoryId'] == 5) {
                $data['is_alshamilProduct']= $row->cartWType;
                $data['image']  = $row->Wpost_main_img;
                $data['publishedOn'] = $row->productWSubmitDate;
                $data['price'] = $row->productWPrice;
                $data['titleEn'] = $row->productWBrand." ".$row->productWModel;
                 $data['titleAr']= "";
               
                $data['status']= $row->productWStatus;
            } else if ($data['categoryId'] == 6) {
                 $data['is_alshamilProduct'] = $row->cartMNType;
              $data['image']  = $row->MNpost_main_img;
              $data['publishedOn'] = $row->productMNSubmitDate;
                 $data['price'] = $row->productMNPrice;
                $data['titleEn']=$row->productOperator." ".$row->productMNNmbr;
                  $data['titleAr'] = "";
                
               $data['status'] = $row->productMNStatus;
            } else if ($data['categoryId'] == 7) {
               $data['is_alshamilProduct'] = $row->cartBTType;
                $data['image']  = $row->BTpost_main_img;
               $data['publishedOn'] = $row->productBTSubmitDate;
               $data['price'] = $row->productBTPrice;
                $data['titleEn'] = $row->productBtBrand." ".$row->productBtModel;
                   $data['titleAr'] = "";
               
               $data['status']= $row->productBTStatus;
            } else if ($data['categoryId'] == 8) {
               $data['is_alshamilProduct']= $row->cartPHType;
               $data['image']  = $row->PHpost_main_img;
                $data['publishedOn']= $row->productPSubmitDate;
                $data['price'] = $row->productPHPrice;
                $data['titleEn']= $row->productPBrand." ".$row->productPModel;
                   $data['titleAr'] = "";
                
               $data['status'] = $row->productPHStatus;
            } else if ($data['categoryId'] == 9) {
                 $data['is_alshamilProduct']= $row->cartPRType;
              $data['image']  = $row->PRpost_main_img;
                $data['publishedOn'] = $row->productPRSubmitDate;
                $data['price'] = $row->productPRPrice;
              $data['titleEn'] = $row->productPropType." ". $row->productPropSC;
                   $data['titleAr'] ="";
                
                $data['status']= $row->productPRStatus;
            } else {
                $data['is_alshamilProduct'] = "";
               $data['image']  = "";
                $data['publishedOn'] = "";
              $data['price'] = "";
                
                 $data['titleEn']= "";
                   $data['titleAr']="";
               $data['status']= "";
            }
            
           
           
            $row_post[] = $data;
            $data='';
            
        }
         return $row_post;
   }
    function addtofavourite($userId,$postId,$productcategoryId,$productId)
    {
        $cartcnt = 1;
        $i=1;
        
        $prod_avail = 0;
        //$data = array('cartlistID'=>$i++,'customerID'=>$trader_id,'productID'=>$prod_id,'cartlistCount'=>$cartcnt,'productAvailability'=>$prod_avail);
        $data = array('traderID'=>$userId,'postID'=>$postId,'productID'=>$productId,'productAvailability'=>$prod_avail,'productCategoryID'=>$productcategoryId);
        $this->db->insert('watchlist',$data);
    }
    
    
    function get_latestpost($limit,$per_page_cnt)
    {
       $qry = $this->db->query('SELECT *,traderID as tr,productID as pr,(select trader.traderFullName from trader where trader.traderID=tr) as trader_name,(select trader.traderImage from trader where trader.traderID=tr) as trader_img,(select trader.traderLocation from trader where trader.traderID=tr) as trader_loc FROM ( (SELECT * FROM productcar) UNION (SELECT * FROM productbike) UNION (SELECT * FROM productboat) UNION (SELECT * FROM productmn) UNION (SELECT * FROM productnp) UNION (SELECT * FROM productphone) UNION (SELECT * FROM productproperty) UNION (SELECT * FROM productvertu) UNION (SELECT * FROM productwatch)) a ORDER BY a.post_date desc limit '.$limit.' offset '.$per_page_cnt);
       return $qry->result(); 
    }
    function brandmodel()
   {
        $c1=$this->db->query('select  distinct brandName from category_subtypes where productCategoryId=1');
        $c2=$c1->result();
        $c3=$this->db->query('select  distinct modelName from category_subtypes where productCategoryId=1');
        $c4=$c3->result();
        
        
        $b1=$this->db->query('select  distinct brandName from category_subtypes where productCategoryId=2');
        $b2=$b1->result();
        $b3=$this->db->query('select  distinct modelName from category_subtypes where productCategoryId=2');
        $b4=$b3->result();
        
        
        $v1=$this->db->query('select  distinct brandName from category_subtypes where productCategoryId=4');
        $v2=$v1->result();
        $v3=$this->db->query('select  distinct modelName from category_subtypes where productCategoryId=4');
        $v4=$v3->result();
        
         
        $w1=$this->db->query('select  distinct brandName from category_subtypes where productCategoryId=5');
        $w2=$w1->result();
        $w3=$this->db->query('select  distinct modelName from category_subtypes where productCategoryId=5');
        $w4=$w3->result();
                
                
        $bt1=$this->db->query('select  distinct brandName from category_subtypes where productCategoryId=7');
        $bt2=$bt1->result();
        $bt3=$this->db->query('select  distinct modelName from category_subtypes where productCategoryId=7');
        $bt4=$bt3->result();
        
        $ph1=$this->db->query('select  distinct brandName from category_subtypes where productCategoryId=8');
        $ph2=$ph1->result();
        $ph3=$this->db->query('select  distinct modelName from category_subtypes where productCategoryId=8');
        $ph4=$ph3->result();
        
        
     return array(
         
         'carbrands'=>$c2,
         'carmodels'=>$c4,
         
          'bikebrands'=>$b2,
         'bikemodels'=>$b4,
         
          'vertubrands'=>$v2,
         'vertumodels'=>$v4,
         
          'watchbrands'=>$w2,
         'watchmodels'=>$w4,
         
          'boatbrands'=>$bt2,
         'boatmodels'=>$bt4,
         
          'phonebrands'=>$ph2,
         'phonemodels'=>$ph4,
         
         
         );
   }
   function mdl_prod_det($product_id)
   {
        $this->db->where('productID',$product_id);
        $qry = $this->db->get('product');
        return $qry->result();
   }
   
    function get_brand_car($category) {
        $query = $this->db->query('select  distinct brandID,brandName from category_subtypes where productCategoryID = '.$category);
        /*$this->db->select('brand');
        $this->db->from('car_bike');
        $this->db->where('parent_cat_id', '1');
        $query = $this->db->get();*/
        return $query->result();
    }
    function get_brand_bike($category) {
        $query = $this->db->query('select distinct brandName,brandID from category_subtypes where productCategoryID = '.$category);
        return $query->result();
    }
    function get_brand_watch($category)
    {
        $query = $this->db->query('select  distinct brandID,brandName from category_subtypes where productCategoryID = '.$category);
        
        return $query->result();
    }
    function get_brand_phone($category)
    {
       $query = $this->db->query('select  distinct brandID,brandName from category_subtypes where productCategoryID = '.$category);
        
        return $query->result(); 
    }
      function get_brand_vertu($category) {
        $query = $this->db->query('select distinct brandName,brandID from category_subtypes where productCategoryID = '.$category);
        return $query->result();
    }
     function get_brand_boat($category) {
        $query = $this->db->query('select distinct brandName,brandID from category_subtypes where productCategoryID = '.$category);
        return $query->result();
    }
     function get_model_boat ($brand){
        $this->db->select('modelID,modelName');
        $this->db->from('category_subtypes');
        $this->db->where('brandID', $brand);
        //$this->db->where('brand_id', $brand);
        $query = $this->db->get();
        $cities = array();

        if($query->result()){
            foreach ($query->result() as $city) {
                $cities[$city->modelID] = $city->modelName;
            }
            return $cities;
        } else {
            return FALSE;
        }
    }
    function get_model_vertu ($brand){
        $this->db->select('modelID,modelName');
        $this->db->from('category_subtypes');
        $this->db->where('brandID', $brand);
        //$this->db->where('brand_id', $brand);
        $query = $this->db->get();
        $cities = array();

        if($query->result()){
            foreach ($query->result() as $city) {
                $cities[$city->modelID] = $city->modelName;
            }
            return $cities;
        } else {
            return FALSE;
        }
    }
  
    function srch_brand_car($category)
    {
       /*if($category == '1')
       {
            $query = $this->db->query('select productCBrand from productcar where productCategoryID = '.$category);
            $cities = array();

            if($query->result()){
                foreach ($query->result() as $city) {
                    //$cities[$city->brand_id] = $city->brand;
                    $cities[$city->productCBrand] = $city->productCBrand;
                }
                return $cities;
            } else {
                return FALSE;
            }
       }*/
        $query = $this->db->query('select distinct brand,brand_id from car_bike where parent_cat_id = '.$category);
        $cities = array();

        if($query->result()){
            foreach ($query->result() as $city) {
                //$cities[$city->brand_id] = $city->brand;
                $cities[$city->brand] = $city->brand;
            }
            return $cities;
        } else {
            return FALSE;
        }
    }
    function get_categories()
    {
        $query = $this->db->get('category');
        return $query->result();
    }
  function get_model_car ($brand){
        $this->db->select('modelID,modelName');
        $this->db->from('category_subtypes');
        $this->db->where('brandID', $brand);
        //$this->db->where('brand_id', $brand);
        $query = $this->db->get();
        $cities = array();

        if($query->result()){
            foreach ($query->result() as $city) {
                $cities[$city->modelID] = $city->modelName;
            }
            return $cities;
        } else {
            return FALSE;
        }
    }
    
     function get_model_bike ($brand){
        $this->db->select('modelID,modelName');
        $this->db->from('category_subtypes');
        $this->db->where('brandID', $brand);
        //$this->db->where('brand_id', $brand);
        $query = $this->db->get();
        $cities = array();

        if($query->result()){
            foreach ($query->result() as $city) {
                $cities[$city->modelID] = $city->modelName;
            }
            return $cities;
        } else {
            return FALSE;
        }
    }
    
    function get_model_watch($brand)
    {
        $this->db->select('modelID,modelName');
        $this->db->from('category_subtypes');
        $this->db->where('brandID', $brand);
       
        $query = $this->db->get();
        $cities = array();

        if($query->result()){
            foreach ($query->result() as $city) {
                $cities[$city->modelID] = $city->modelName;
            }
            return $cities;
        } else {
            return FALSE;
        }
    }
    function get_model_phone($brand)
    {
         $this->db->select('modelID,modelName');
        $this->db->from('category_subtypes');
        $this->db->where('brandID', $brand);
       
        $query = $this->db->get();
        $cities = array();

        if($query->result()){
            foreach ($query->result() as $city) {
                $cities[$city->modelID] = $city->modelName;
            }
            return $cities;
        } else {
            return FALSE;
        }
    }
    
    function prod_addto_cart($product_id,$post_id,$category_id)
    {
        $cartcnt = 1;
      
        
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $prod_avail = 0;
       
        $data = array('traderID'=>$trader_id,'postID'=>$post_id,'productCategoryID'=>$category_id,'productID'=>$product_id,'cartlistCount'=>$cartcnt,'productAvailability'=>$prod_avail);
        $this->db->insert('cartlist',$data);
         
    }
    function cart_cnt()
    {
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $this->db->where('traderID',$trader_id);
        $this->db->where('productID !=',0);
        $this->db->select('sum(cartlistCount) as cartlistCount');
        $cart_qry = $this->db->get('cartlist');
       return $cart_qry->result();
    }
     function cart_details()
    {
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
       
       $qry = $this->db->query('SELECT  cartlist.postID,cartlist.productCategoryID,  cartlist.productID,trader.traderFullName,trader.traderImage,trader.traderLocation,trader.traderID,
       productcar.productCPrice ,productcar.Cpost_main_img ,concat(productcar.productCBrand,productcar.productCModel) as product_name1,productcar.cartCType, 
       productbike.productBPrice ,productbike.Bpost_main_img ,concat(productbike.productBBrand,productbike.productBModel) as product_name2,productbike.cartBType ,
       productboat.productBTPrice ,productboat.BTpost_main_img ,concat(productboat.productBtBrand,productboat.productBtModel) as product_name3,productboat.cartBTType ,
      productwatch.productWPrice ,productwatch.Wpost_main_img ,concat(productwatch.productWBrand,productwatch.productWModel) as product_name4,productwatch.cartWType ,
      productvertu.productVPrice ,productvertu.Vpost_main_img ,concat(productvertu.productVBrand,productvertu.productVModel) as product_name5,productvertu.cartVType ,
      productproperty.productPRPrice ,productproperty.PRpost_main_img ,concat(productproperty.productPropSC,productproperty.productPropType) as product_name6,productproperty.cartPRType ,
      productphone.productPHPrice ,productphone.PHpost_main_img ,concat(productphone.productPBrand,productphone.productPModel) as product_name7,productphone.cartPHType ,
    productnp.productNPPrice ,productnp.NPpost_main_img,concat(productnp.productNPCode,productnp.productNPNmbr) as product_name8,productnp.productNPDigits,productnp.cartNPType ,
      productmn.productMNPrice ,productmn.MNpost_main_img ,productmn.productOperator,productmn.productMNDigits,productmn.productMNNmbr as product_name9,productmn.cartMNType  FROM cartlist
       
         left join trader on cartlist.traderID=trader.traderID
        left join productcar on (cartlist.productCategoryID=productcar.productCategoryID and cartlist.productID=productcar.productID)
        left join productbike on (cartlist.productCategoryID=productbike.productCategoryID and cartlist.productID=productbike.productID)
        left join productboat on (cartlist.productCategoryID=productboat.productCategoryID and cartlist.productID=productboat.productID)
        left join productmn on (cartlist.productCategoryID=productmn.productCategoryID and cartlist.productID=productmn.productID)
        left join productnp on (cartlist.productCategoryID=productnp.productCategoryID and cartlist.productID=productnp.productID)
        left join productphone on (cartlist.productCategoryID=productphone.productCategoryID and cartlist.productID=productphone.productID)
        left join productproperty on (cartlist.productCategoryID=productproperty.productCategoryID and cartlist.productID=productproperty.productID)
        left join productvertu on (cartlist.productCategoryID=productvertu.productCategoryID and  cartlist.productID=productvertu.productID)
        left join productwatch on (cartlist.productCategoryID=productwatch.productCategoryID and cartlist.productID=productwatch.productID)  
        WHERE `cartlist`.`traderID` = '.$trader_id.' ');
         
       return $qry->result(); 
        
    }
    function showcart_details($customer_id)
    {
        
        $this->db->select('*');
        $this->db->from('cartlist');
        $this->db->join('product','cartlist.productID=product.productID ');
        $this->db->join('trader','product.traderID=trader.traderID');
        $this->db->where('cartlist.traderID',$customer_id);
        $query=$this->db->get();
        return $query->result();
    }
    function showwatch_details($customer_id)
    {
        
        $this->db->select('*');
        $this->db->from('watchlist');
        $this->db->join('product','watchlist.productID=product.productID ');
        $this->db->join('trader','product.traderID=trader.traderID');
        $this->db->where('watchlist.traderID',$customer_id);
        $query=$this->db->get();
        return $query->result();
    }
    function showwatch_cnt($customer_id)
    {
        
        $this->db->where('traderID',$customer_id);
        $this->db->where('productID !=',0);
         $this->db->select('sum(watchlistCount) as watchlistCount');
        $watch_qry = $this->db->get('watchlist');
        return $watch_qry->result(); 
    }
    function showcart_cnt($customer_id)
    {
        
        $this->db->where('traderID',$customer_id);
        $this->db->where('productID !=',0);
        $this->db->select('sum(cartlistCount) as cartlistCount');
        $cart_qry = $this->db->get('cartlist');
       return $cart_qry->result();
    }
    function del_prd_cart($prod_id)
    {
        $this->db->where('productID',$prod_id);
        $qry = $this->db->delete('cartlist');
    }
    function prod_addto_wishlist($product_id,$category_id,$post_id)
    {
        $qry = $this->db->query('select count(*) as watch_cnt from watchlist');
        return $qry->result();
        /*$cartcnt = 1;
        $i=1;
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];

        $prod_avail = 0;
        //$data = array('cartlistID'=>$i++,'customerID'=>$trader_id,'productID'=>$prod_id,'cartlistCount'=>$cartcnt,'productAvailability'=>$prod_avail);
        $data = array('traderID'=>$trader_id,'postID'=>$post_id,'productID'=>$product_id,'productAvailability'=>$prod_avail,'productCategoryID'=>$category_id);
        $this->db->insert('watchlist',$data);*/
        /*$watchcnt = 1;
        $i=1;
        
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $prod_avail = 0;
        $data = array('traderID'=>$trader_id,'productID'=>$prod_id,'watchlistCount'=>$watchcnt,'productAvailability'=>$prod_avail);

        $this->db->insert('watchlist',$data);*/
    }
    function prod_addto_watchlist($product_id,$category_id,$post_id)
    {
        $qry = $this->db->query('select count(*) as watch_cnt from watchlist');
        return $qry->result();
    }
    function watchlist_add_prdt($product_id,$category_id,$post_id,$qry_cnt)
    {
        if(count($qry_cnt)>0)
        {
            $watch_cnt = 1;
            //$session_data = $this->session->userdata('logged_in');
            //$trader_id = $session_data['trader_id'];
            $trader_id = 14;
            $data = array('traderID'=>$trader_id,'productCategoryID'=>$category_id,'postID'=>$post_id,'productID'=>$product_id,'watchlistCount'=>$watch_cnt,'productAvailability'=>0);
            $this->db->insert('watchlist',$data);
            $last_watch_id = $this->db->insert_id();
        }
        else 
        {
            $query = $this->db->query('select watchlistCount from watchlist where watchlistID='.$last_watch_id);
             $result=$query[0]->watchlistCount;
             $update_watchcount=$result+1; 
            $session_data = $this->session->userdata('logged_in');
            $trader_id = $session_data['trader_id'];
            $data = array('traderID'=>$trader_id,'productCategoryID'=>$category_id,'postID'=>$post_id,'productID'=>$product_id,'watchlistCount'=>$update_watchcount,'productAvailability'=>0);
            $this->db->insert('watchlist',$data);
        }
        
    }
    function addto_cart($product_id,$cust_id)
    {
        $cartcnt = 1;
        $i=1;
        
        
        $trader_id = $cust_id;
        $prod_avail = 0;
        //$data = array('cartlistID'=>$i++,'customerID'=>$trader_id,'productID'=>$prod_id,'cartlistCount'=>$cartcnt,'productAvailability'=>$prod_avail);
        $data = array('customerID'=>$trader_id,'productID'=>$product_id,'cartlistCount'=>$cartcnt,'productAvailability'=>$prod_avail);

         $this->db->insert('cartlist',$data);
    }
    function watch_cnt()
    {
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $this->db->where('traderID',$trader_id);
        $this->db->where('productID !=',0);
         $this->db->select('sum(watchlistCount) as watchlistCount');
        $watch_qry = $this->db->get('watchlist');
        return $watch_qry->result(); 
    }
    function watch_details()
    {
        $session_data = $this->session->userdata('logged_in');
        
        $trader_id = $session_data['trader_id'];
        $this->db->select('*');
        $this->db->from('watchlist');
        $this->db->join('product','watchlist.productID=product.productID ');
        $this->db->join('trader','product.traderID=trader.traderID');
        $this->db->where('watchlist.traderID',$trader_id);
        $query=$this->db->get();
        return $query->result();
    }
    function fetch_appr_posts()
    {
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $app_qry = $this->db->query('SELECT productcar.productCBrand,productcar.productCModel,`productcar`.`productCSubmitDate`, `productcar`.`productCPrice`,productcar.Cpost_main_img as main_img,
                            productbike.productBBrand,productbike.productBModel,`productbike`.`productBSubmitDate`, `productbike`.`productBPrice`,productbike.Bpost_main_img as main_img,
                            productboat.productBtBrand,productboat.productBtModel,`productboat`.`productBTSubmitDate`, `productboat`.`productBTPrice`,productboat.BTpost_main_img as main_img,
                            productwatch.productWBrand,productwatch.productWModel,`productwatch`.`productWSubmitDate`, `productwatch`.`productWPrice`,productwatch.Wpost_main_img as main_img,
                            productvertu.productVBrand,productvertu.productVModel, `productvertu`.`productVSubmitDate`, `productvertu`.`productVPrice`,productvertu.vpost_main_img as main_img,productproperty.productPropType,
                            productproperty.productPropSC,`productproperty`.`productPRSubmitDate`, `productproperty`.`productPRPrice`,productproperty.PRpost_main_img as main_img,
                            productphone.productPBrand,productphone.productPModel,`productphone`.`productPSubmitDate`, `productphone`.`productPHPrice`,productphone.PHpost_main_img as main_img,
                            productnp.productNPCode,productnp.productNPDigits,productnp.productNPNmbr,`productnp`.`productNPSubmitDate`, `productnp`.`productNPPrice`,productnp.NPpost_main_img as main_img,
                            productmn.productMNNmbr,productmn.productMNDigits,`productmn`.`productMNPrice`,productmn.productMNSubmitDate,productmn.MNpost_main_img
       
        from post
        left join trader on post.traderID=trader.traderID
        left  JOIN `productcar` ON (`post`.`productCategoryID`=`productcar`.`productCategoryID` and `post`.`productID`=`productcar`.`productID`)
       left  JOIN `productbike` ON (`post`.`productCategoryID`=`productbike`.`productCategoryID` and `post`.`productID`=`productbike`.`productID`) 
        left JOIN `productboat` ON (`post`.`productCategoryID`=`productboat`.`productCategoryID` and `post`.`productID`=`productboat`.`productID`)
       left  JOIN `productmn` ON (`post`.`productCategoryID`=`productmn`.`productCategoryID` and `post`.`productID`=`productmn`.`productID`)
       left  JOIN `productnp` ON (`post`.`productCategoryID`=`productnp`.`productCategoryID` and `post`.`productID`=`productnp`.`productID`)
       left  JOIN `productphone` ON (`post`.`productCategoryID`=`productphone`.`productCategoryID` and `post`.`productID`=`productphone`.`productID`)
      left   JOIN `productproperty` ON (`post`.`productCategoryID`=`productproperty`.`productCategoryID` and `post`.`productID`=`productproperty`.`productID`)
      left   JOIN `productvertu` ON (`post`.`productCategoryID`=`productvertu`.`productCategoryID` and `post`.`productID`=`productvertu`.`productID`) 
       left  JOIN `productwatch` ON (`post`.`productCategoryID`=`productwatch`.`productCategoryID` and `post`.`productID`=`productwatch`.`productID`)
       where post.postStatus=1 and post.traderID='.$trader_id);
        /*$this->db->select('product.productName,product.productImage,product.productPrice,product.productSubmitDate,product.productViewCount');
        $this->db->from('product');
        $this->db->join('post','product.productID=post.productID');
        $this->db->where('product.traderID',$trader_id);
        $this->db->where('post.postStatus',1);
        $app_qry=$this->db->get();*/
        return $app_qry->result();
        
    }
    function  fetch_rej_posts()
    {
       $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        /*$this->db->select('product.productName,product.productImage,product.productPrice,product.productSubmitDate,product.productViewCount');
        $this->db->from('product');
        $this->db->join('post','product.productID=post.productID');
        $this->db->where('product.traderID',$trader_id);
        $this->db->where('post.postStatus',0);*/
        $rej_qry = $this->db->query('SELECT productcar.productCBrand,productcar.productCModel,`productcar`.`productCSubmitDate`, `productcar`.`productCPrice`,productcar.Cpost_main_img as main_img,
                            productbike.productBBrand,productbike.productBModel,`productbike`.`productBSubmitDate`, `productbike`.`productBPrice`,productbike.Bpost_main_img as main_img,
                            productboat.productBtBrand,productboat.productBtModel,`productboat`.`productBTSubmitDate`, `productboat`.`productBTPrice`,productboat.BTpost_main_img as main_img,
                            productwatch.productWBrand,productwatch.productWModel,`productwatch`.`productWSubmitDate`, `productwatch`.`productWPrice`,productwatch.Wpost_main_img as main_img,
                            productvertu.productVBrand,productvertu.productVModel, `productvertu`.`productVSubmitDate`, `productvertu`.`productVPrice`,productvertu.vpost_main_img as main_img,productproperty.productPropType,
                            productproperty.productPropSC,`productproperty`.`productPRSubmitDate`, `productproperty`.`productPRPrice`,productproperty.PRpost_main_img as main_img,
                            productphone.productPBrand,productphone.productPModel,`productphone`.`productPSubmitDate`, `productphone`.`productPHPrice`,productphone.PHpost_main_img as main_img,
                            productnp.productNPCode,productnp.productNPDigits,productnp.productNPNmbr,`productnp`.`productNPSubmitDate`, `productnp`.`productNPPrice`,productnp.NPpost_main_img as main_img,
                            productmn.productMNNmbr,productmn.productMNDigits,`productmn`.`productMNPrice`,productmn.productMNSubmitDate,productmn.MNpost_main_img
       
        from post
        left join trader on post.traderID=trader.traderID
        left  JOIN `productcar` ON (`post`.`productCategoryID`=`productcar`.`productCategoryID` and `post`.`productID`=`productcar`.`productID`)
       left  JOIN `productbike` ON (`post`.`productCategoryID`=`productbike`.`productCategoryID` and `post`.`productID`=`productbike`.`productID`) 
        left JOIN `productboat` ON (`post`.`productCategoryID`=`productboat`.`productCategoryID` and `post`.`productID`=`productboat`.`productID`)
       left  JOIN `productmn` ON (`post`.`productCategoryID`=`productmn`.`productCategoryID` and `post`.`productID`=`productmn`.`productID`)
       left  JOIN `productnp` ON (`post`.`productCategoryID`=`productnp`.`productCategoryID` and `post`.`productID`=`productnp`.`productID`)
       left  JOIN `productphone` ON (`post`.`productCategoryID`=`productphone`.`productCategoryID` and `post`.`productID`=`productphone`.`productID`)
      left   JOIN `productproperty` ON (`post`.`productCategoryID`=`productproperty`.`productCategoryID` and `post`.`productID`=`productproperty`.`productID`)
      left   JOIN `productvertu` ON (`post`.`productCategoryID`=`productvertu`.`productCategoryID` and `post`.`productID`=`productvertu`.`productID`) 
       left  JOIN `productwatch` ON (`post`.`productCategoryID`=`productwatch`.`productCategoryID` and `post`.`productID`=`productwatch`.`productID`)
       where post.postStatus=0 and post.traderID='.$trader_id);
       
        return $rej_qry->result(); 
    }
    function fetch_pend_posts()
    {
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        /*$this->db->select('product.productName,product.productImage,product.productPrice,product.productSubmitDate,product.productViewCount');
        $this->db->from('product');
        $this->db->join('post','product.productID=post.productID');
        $this->db->where('product.traderID',$trader_id);
        $this->db->where('post.postStatus',-1);*/
        $pend_qry=$this->db->query('SELECT `product`.`productName`, `product`.`productImage`, `product`.`productPrice`, `product`.`productSubmitDate`, `product`.`productViewCount` FROM `product` JOIN `post` ON `product`.`productID`=`post`.`productID` WHERE `product`.`traderID` = '.$trader_id.' AND `post`.`postStatus` = -1 GROUP by product.productID');
        
        return $pend_qry->result(); 
    }
    
    
    
    
    function others_trader_data($trader_id)
    {
        $this->db->where('traderID',$trader_id);
        $trqry=$this->db->get('trader');
        $trquery = $trqry->result(); 
        
        
        $this->db->where('traderID',$trader_id);
        $prqry=$this->db->get('product');
        $prquery =$prqry->result(); 
        return array(
            'tqry' => $trquery,
            'pqry' => $prquery,
        );
        
    }
    function mdl_fetch_prod_traddet($product_id)
    {
        $this->db->select('*');
        $this->db->from('trader');
        $this->db->join('product','product.traderID=trader.traderID');
       $this->db->where('product.productID',$product_id);
        $qry = $this->db->get();
        return $qry->result();
        
    }
    function recent_view()
    {
         $recentqry = $this->db->query('SELECT * FROM `product` order by productViewCount desc LIMIT 4');
        return $recentqry->result();
    }
    
     function getproducttrader($trader_id)
  {
      $this->db->select('product.productViewCount,trader.socialWeb,trader.socialtwitter,trader.socialFb,trader.socialInsta,trader.socialSnap,product.productID,product.productImage,product.productName,product.productPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,product.productSubmitDate,trader.traderContactNum,product.productDescr,trader.traderID');
        $this->db->from('trader');
        $this->db->join('product','product.traderID=trader.traderID');
        $this->db->where('trader.traderID',$trader_id);
//        $this->db->limit($limit, $offset);
        $qry = $this->db->get();
        return $qry->result();
         
  }
  function getMail($trader) {
        $this->db->select('traderEmailID');
        $this->db->from('trader');
        $this->db->where('traderID', $trader);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $result = $query->result();
            foreach ($result as $row) {
            return $row->traderEmailID;
            }
        } else {
            return false;
        }
    }
    
    function get_Namee($trader) {
        $this->db->select('traderFullName');
        $this->db->from('trader');
        $this->db->where('traderID', $trader);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $result = $query->result();
            foreach ($result as $row) {
            return $row->traderFullName;
            }
        } else {
            return false;
        }
    }
      
     
         
        public function prd_viewcnt($product_id,$prod_view_cnt)
        {
          
          $data= array();
          $data['productViewCount'] = $prod_view_cnt;
          $this->db->where('productID',$product_id);
          $this->db->update('product',$data);
          /*$this->db->where('productID',$product_id);
          $q= $this->db->get('product');
          return $q->result();*/
        }
        function get_email($trader_id) {
        $this->db->select('traderEmailID');
        $this->db->from('trader');
        $this->db->where('traderID', $trader_id);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $result = $query->result();
            foreach ($result as $row) {
            return $row->traderEmailID;
            }
        } else {
            return false;
        }
    }
    
    function getname($trader_id) {
        $this->db->select('traderFullName');
        $this->db->from('trader');
        $this->db->where('traderID', $trader_id);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $result = $query->result();
            foreach ($result as $row) {
            return $row->traderFullName;
            }
        } else {
            return false;
        }
    }
   function getemail($product_id)
   {
    $this->db->select('product.productID,product.productImage,product.productName,product.productPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,product.productSubmitDate,trader.traderContactNum,product.productDesc,trader.traderEmailID');
    $this->db->from('product');
    $this->db->join('trader','product.traderID=trader.traderID');
    $this->db->where('product.productID',$product_id);
    $query = $this->db->get();
        if ($query->num_rows() == 1) {
            $result = $query->result();
            foreach ($result as $row) {
            return $row->traderEmailID;
            }
        } else {
            return false;
        }
   }
function get_car($limit, $offset) {
        $this->db->select('productcar.productCategoryID,productcar.productID,productiv.productImage,productcar.productCategoryName,productcar.productCPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productcar.productCSubmitDate,productcar.Cpost_main_img,productcar.productCModel,productcar.productCBrand');
        $this->db->from('productcar');
        $this->db->join('trader', 'productcar.traderID=trader.traderID');
        $this->db->join('productiv', 'productcar.productCategoryID=productiv.productCategoryID AND productcar.productID=productiv.productID');
        $this->db->where('productcar.productCategoryID', 1);
        $this->db->limit($limit, $offset);
        $qry = $this->db->get();
        $myqry = $qry->result();
        
        
        $this->db->select('productcar.productCategoryID,productcar.productID,productiv.productImage,productcar.productCategoryName,productcar.productCPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productcar.productCSubmitDate,productcar.Cpost_main_img,productcar.productCModel,productcar.productCBrand');
        $this->db->from('productcar');
        $this->db->join('trader', 'productcar.traderID=trader.traderID');
        $this->db->join('productiv', 'productcar.productCategoryID=productiv.productCategoryID AND productcar.productID=productiv.productID');
        $this->db->where('productcar.productCategoryID', 1);
        
        $cntqry = $this->db->get();
        $count_qry = $cntqry->result();
         
        return array(
            'qry' => $myqry,
            'count' => count($count_qry),
        );
    }


    public function getproductcar($product_id,$cat_id) {
        $this->db->select('productcar.productID,productcar.productCategoryID,productcar.cartCType,productiv.postID,productiv.productImage,productcar.productCategoryName,productcar.productCPrice,trader.traderFullName,trader.traderLocation,trader.traderID,trader.traderImage,productcar.productCSubmitDate,trader.traderContactNum,productcar.productCDesc');
        $this->db->from('productcar');
        $this->db->join('trader', 'productcar.traderID=trader.traderID');
        $this->db->join('productiv', 'productcar.productCategoryID=productiv.productCategoryID AND productcar.productID=productiv.productID');
        $this->db->where('productcar.productID', $product_id);
        $query = $this->db->get();
        return $query->result();
    }
    function fetch_car_imgs($product_id,$cat_id)
    {
        $car_img_qry = $this->db->query('SELECT productcar.Cpost_main_img ,productiv.productImage ,productiv.productVideo,productiv.productVideoCount,productiv.productViewCount FROM `productiv`  join productcar on ((productiv.productCategoryID =productcar.productCategoryID) and (productiv.productID=productcar.productID)) 
            where productiv.productCategoryID='.$cat_id.' and productiv.productID='.$product_id);
        return $car_img_qry->result();
    }
    public function record_count_car() {
        return $this->db->count_all('productcar', 'trader', 'productiv');
    }

    function sendemail_car($product_id) {
        $this->db->select('productcar.productID,productcar.productCategoryName,productcar.productCPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productcar.productCSubmitDate,trader.traderContactNum,productcar.productCDesc,trader.traderEmailID');
        $this->db->from('productcar');
        $this->db->join('trader', 'productcar.traderID=trader.traderID');
        $this->db->where('productcar.productID', $product_id);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            $result = $query->result();
            foreach ($result as $row) {
                return $row->traderEmailID;
            }
        } else {
            return false;
        }
    }

    function prod_addto_wishlist_car($prod_id) {
        $watchcnt = 1;
        $i = 1;

        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $prod_avail = 0;
        //$data = array('watchlistID'=>$i++,'customerID'=>$trader_id,'productID'=>$prod_id,'watchlistCount'=>$watchcnt,'productAvailability'=>$prod_avail);
        $data = array('traderID' => $trader_id, 'productID' => $prod_id, 'productCWatchCount' => $watchcnt, 'productLive' => $prod_avail);
        $this->db->insert('productcar', $data);
    }

function get_bike($limit, $offset) {
        $this->db->select('productbike.productCategoryID,productbike.productID,productiv.productImage,productbike.productCategoryName,productbike.productBBrand,productbike.productBModel,productbike.productBPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productbike.productBSubmitDate,productbike.Bpost_main_img');
        $this->db->from('productbike');
        $this->db->join('trader', 'productbike.traderID=trader.traderID');
        $this->db->join('productiv', 'productbike.productCategoryID=productiv.productCategoryID AND productbike.productID=productiv.productID');
        $this->db->where('productbike.productCategoryID', 2);
        $this->db->limit($limit, $offset);
        $qry = $this->db->get();
        $myqry = $qry->result();
        
        $this->db->select('productbike.productCategoryID,productbike.productID,productiv.productImage,productbike.productCategoryName,productbike.productBBrand,productbike.productBModel,productbike.productBPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productbike.productBSubmitDate,productbike.Bpost_main_img');
        $this->db->from('productbike');
        $this->db->join('trader', 'productbike.traderID=trader.traderID');
        $this->db->join('productiv', 'productbike.productCategoryID=productiv.productCategoryID AND productbike.productID=productiv.productID');
        $this->db->where('productbike.productCategoryID', 2);
        
        $cntqry = $this->db->get();
        $count_qry = $cntqry->result();
        return array(
            'qry' => $myqry,
            'count' => count($count_qry),
        );
    }


    public function getproductbike($product_id) {
        $this->db->select('productbike.productID,productbike.cartBType,productiv.productImage,productbike.productCategoryName,productbike.productBBrand,productbike.productBModel,productbike.productBPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productbike.productBSubmitDate,trader.traderContactNum,productbike.productBDesc');
        $this->db->from('productbike');
        $this->db->join('trader', 'productbike.traderID=trader.traderID');
        $this->db->join('productiv', 'productbike.productCategoryID=productiv.productCategoryID AND productbike.productID=productiv.productID');
        $this->db->where('productbike.productID', $product_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function record_count_bike() {
        return $this->db->count_all('productbike', 'trader', 'productiv');
    }

    function sendemail_bike($product_id) {
        $this->db->select('productbike.productID,productbike.productCategoryName,productbike.productBPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productbike.productBSubmitDate,trader.traderContactNum,productbike.productBDesc,trader.traderEmailID');
        $this->db->from('productbike');
        $this->db->join('trader', 'productbike.traderID=trader.traderID');
        $this->db->where('productbike.productID', $product_id);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            $result = $query->result();
            foreach ($result as $row) {
                return $row->traderEmailID;
            }
        } else {
            return false;
        }
    }

function noplate_cat($limit, $offset) {
        $this->db->select('productnp.productCategoryID,productnp.productID,productiv.productImage,productnp.productCategoryName,productnp.productNPPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productnp.productNPSubmitDate');
        $this->db->from('productnp');
        $this->db->join('trader', 'productnp.traderID=trader.traderID');
        $this->db->join('productiv', 'productnp.productCategoryID=productiv.productCategoryID AND productnp.productID=productiv.productID');
        $this->db->where('productnp.productCategoryID', 3);
        $this->db->limit($limit, $offset);
        $qry = $this->db->get();
        $myqry = $qry->result();
        
        
        $this->db->select('productnp.productCategoryID,productnp.productID,productiv.productImage,productnp.productCategoryName,productnp.productNPPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productnp.productNPSubmitDate');
        $this->db->from('productnp');
        $this->db->join('trader', 'productnp.traderID=trader.traderID');
        $this->db->join('productiv', 'productnp.productCategoryID=productiv.productCategoryID AND productnp.productID=productiv.productID');
        $this->db->where('productnp.productCategoryID', 3);
       
        $cntqry = $this->db->get();
        $count_qry = $cntqry->result();
        return array(
            'qry' => $myqry,
            'count' => count($count_qry),
        );
    }

    function mdl_noplate_details($product_id) {
        $this->db->select('productnp.productID,productnp.cartNPType,productiv.productImage,productnp.productCategoryName,productnp.productNPPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productnp.productNPSubmitDate,trader.traderContactNum,productnp.productNPDesc');
        $this->db->from('productnp');
        $this->db->join('trader', 'productnp.traderID=trader.traderID');
        $this->db->join('productiv', 'productnp.productCategoryID=productiv.productCategoryID AND productnp.productID=productiv.productID');
        $this->db->where('productnp.productID', $product_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function record_count_noplate() {
        return $this->db->count_all('productnp', 'trader', 'productiv');
    }

    function sendemail_np($product_id) {
        $this->db->select('productnp.productID,productnp.productCategoryName,productnp.productNPPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productnp.productNPSubmitDate,trader.traderContactNum,productnp.productNPDesc,trader.traderEmailID');
        $this->db->from('productnp');
        $this->db->join('trader', 'productnp.traderID=trader.traderID');
        $this->db->where('productnp.productID', $product_id);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            $result = $query->result();
            foreach ($result as $row) {
                return $row->traderEmailID;
            }
        } else {
            return false;
        }
    }

function vertu_cat($limit, $offset) {
        $this->db->select('trader.traderID,productiv.postID,productvertu.productCategoryID,productvertu.productID,productiv.productImage,productvertu.productCategoryName,productvertu.productVBrand,productvertu.productVModel,productvertu.productVPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productvertu.productVSubmitDate');
        $this->db->from('productvertu');
        $this->db->join('trader', 'productvertu.traderID=trader.traderID');
        $this->db->join('productiv', 'productvertu.productCategoryID=productiv.productCategoryID AND productvertu.productID=productiv.productID');
        $this->db->where('productvertu.productCategoryID', 4);
        $this->db->limit($limit, $offset);
        $qry = $this->db->get();
        $myqry = $qry->result();
        
        $this->db->select('trader.traderID,productiv.postID,productvertu.productCategoryID,productvertu.productID,productiv.productImage,productvertu.productCategoryName,productvertu.productVBrand,productvertu.productVModel,productvertu.productVPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productvertu.productVSubmitDate');
        $this->db->from('productvertu');
        $this->db->join('trader', 'productvertu.traderID=trader.traderID');
        $this->db->join('productiv', 'productvertu.productCategoryID=productiv.productCategoryID AND productvertu.productID=productiv.productID');
        $this->db->where('productvertu.productCategoryID', 4);
        
        $cntqry = $this->db->get();
        $count_qry = $cntqry->result();
        return array(
            'qry' => $myqry,
            'count' => count($count_qry),
        );
    }


    function mdl_vertu_details($product_id) {
        $this->db->select('productvertu.productID,productvertu.cartVType,productiv.productImage,productvertu.productCategoryName,productvertu.productVBrand,productvertu.productVModel,productvertu.productVPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productvertu.productVSubmitDate,trader.traderContactNum,productvertu.productVDesc');
        $this->db->from('productvertu');
        $this->db->join('trader', 'productvertu.traderID=trader.traderID');

        $this->db->join('productiv', 'productvertu.productCategoryID=productiv.productCategoryID AND productvertu.productID=productiv.productID');
        $this->db->where('productvertu.productID', $product_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function record_count_vertu() {
        return $this->db->count_all('productvertu', 'trader', 'productiv');
    }

    function sendemail_vertu($product_id) {
        $this->db->select('productvertu.productID,productvertu.productCategoryName,productvertu.productVPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productvertu.productVSubmitDate,trader.traderContactNum,productvertu.productVDesc,trader.traderEmailID');
        $this->db->from('productvertu');
        $this->db->join('trader', 'productvertu.traderID=trader.traderID');
        $this->db->where('productvertu.productID', $product_id);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            $result = $query->result();
            foreach ($result as $row) {
                return $row->traderEmailID;
            }
        } else {
            return false;
        }
    }

function watch_cat($limit, $offset) {

        $this->db->select('trader.traderID,productiv.postID,productwatch.productCategoryID,productwatch.productID,productiv.productImage,productwatch.productCategoryName,productwatch.productWPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productwatch.productWSubmitDate');
        $this->db->from('productwatch');
        $this->db->join('trader', 'productwatch.traderID=trader.traderID');
        $this->db->join('productiv', 'productwatch.productCategoryID=productiv.productCategoryID AND productwatch.productID=productiv.productID');
        $this->db->where('productwatch.productCategoryID', 5);
        $this->db->limit($limit, $offset);
        $qry = $this->db->get();
        $myqry = $qry->result();
        
        $this->db->select('trader.traderID,productiv.postID,productwatch.productCategoryID,productwatch.productID,productiv.productImage,productwatch.productCategoryName,productwatch.productWPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productwatch.productWSubmitDate');
        $this->db->from('productwatch');
        $this->db->join('trader', 'productwatch.traderID=trader.traderID');
        $this->db->join('productiv', 'productwatch.productCategoryID=productiv.productCategoryID AND productwatch.productID=productiv.productID');
        $this->db->where('productwatch.productCategoryID', 5);
        
        $cntqry = $this->db->get();
        $count_qry = $cntqry->result();
        return array(
            'qry' => $myqry,
            'count' => count($count_qry),
        );
    }


    function mdl_watch_details($product_id) {
        $this->db->select('productwatch.productID,productstatus.cartType,productiv.productImage,productwatch.productCategoryName,productwatch.productWPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productwatch.productWSubmitDate,trader.traderContactNum,productwatch.productWDesc');
        $this->db->from('productwatch');
        $this->db->join('trader', 'productwatch.traderID=trader.traderID');
        $this->db->join('productstatus', 'productwatch.productID=productstatus.productID');
        $this->db->join('productiv', 'productwatch.productCategoryID=productiv.productCategoryID AND productwatch.productID=productiv.productID');
        $this->db->where('productwatch.productID', $product_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function record_count_watch() {
        return $this->db->count_all('productwatch', 'trader', 'productiv');
    }

    function sendemail_watch($product_id) {
        $this->db->select('productwatch.productID,productwatch.productCategoryName,productwatch.productWPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productwatch.productWSubmitDate,trader.traderContactNum,productwatch.productWDesc,trader.traderEmailID');
        $this->db->from('productwatch');
        $this->db->join('trader', 'productwatch.traderID=trader.traderID');
        $this->db->where('productwatch.productID', $product_id);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            $result = $query->result();
            foreach ($result as $row) {
                return $row->traderEmailID;
            }
        } else {
            return false;
        }
    }

function mobileno_cat($limit, $offset) {
        $this->db->select('productmn.productID,productiv.productImage,productmn.productCategoryName,productmn.productMNNmbr,productmn.productMNPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productmn.productMNSubmitDate');
        $this->db->from('productmn');
        $this->db->join('trader', 'productmn.traderID=trader.traderID');
        $this->db->join('productiv', 'productmn.productCategoryID=productiv.productCategoryID AND productmn.productID=productiv.productID');
        $this->db->where('productmn.productCategoryID', 6);
        $this->db->limit($limit, $offset);
        $qry = $this->db->get();
        $myqry = $qry->result();
        
        $this->db->select('productmn.productID,productiv.productImage,productmn.productCategoryName,productmn.productMNNmbr,productmn.productMNPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productmn.productMNSubmitDate');
        $this->db->from('productmn');
        $this->db->join('trader', 'productmn.traderID=trader.traderID');
        $this->db->join('productiv', 'productmn.productCategoryID=productiv.productCategoryID AND productmn.productID=productiv.productID');
        $this->db->where('productmn.productCategoryID', 6);
        
        $cntqry = $this->db->get();
        $count_qry = $cntqry->result();
        return array(
            'qry' => $myqry,
            'count' => count($count_qry),
        );
    }


    function mdl_mobileno_details($product_id) {
        $this->db->select('productmn.productID,productstatus.cartMNType,productiv.productImage,productmn.productCategoryName,productmn.productMNNmbr,productmn.productMNPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productmn.productMNSubmitDate,trader.traderContactNum,productmn.productMNDesc');
        $this->db->from('productmn');
        $this->db->join('trader', 'productmn.traderID=trader.traderID');
        $this->db->join('productstatus', 'productmn.productID=productstatus.productID');
        $this->db->join('productiv', 'productmn.productCategoryID=productiv.productCategoryID AND productmn.productID=productiv.productID');
        $this->db->where('productmn.productID', $product_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function record_count_mobileno() {
        return $this->db->count_all('productmn', 'trader', 'productiv');
    }

    function sendemail_mn($product_id) {
        $this->db->select('productmn.productID,productmn.productCategoryName,productmn.productMNPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productmn.productMNSubmitDate,trader.traderContactNum,productmn.productMNDesc,trader.traderEmailID');
        $this->db->from('productmn');
        $this->db->join('trader', 'productmn.traderID=trader.traderID');
        $this->db->where('productmn.productID', $product_id);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            $result = $query->result();
            foreach ($result as $row) {
                return $row->traderEmailID;
            }
        } else {
            return false;
        }
    }

function get_boat($limit, $offset) {
        $this->db->select('trader.traderID,productboat.productCategoryID,productboat.productID,productiv.productImage,productboat.productCategoryName,productboat.productBTPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productboat.productBTSubmitDate');
        $this->db->from('productboat');
        $this->db->join('trader', 'productboat.traderID=trader.traderID');
        $this->db->join('productiv', 'productboat.productCategoryID=productiv.productCategoryID AND productboat.productID=productiv.productID');
        $this->db->where('productboat.productCategoryID', 7);
        $this->db->limit($limit, $offset);
        $qry = $this->db->get();
        $myqry = $qry->result();
        
        $this->db->select('trader.traderID,productboat.productCategoryID,productboat.productID,productiv.productImage,productboat.productCategoryName,productboat.productBTPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productboat.productBTSubmitDate');
        $this->db->from('productboat');
        $this->db->join('trader', 'productboat.traderID=trader.traderID');
        $this->db->join('productiv', 'productboat.productCategoryID=productiv.productCategoryID AND productboat.productID=productiv.productID');
        $this->db->where('productboat.productCategoryID', 7);
       
        $cntqry = $this->db->get();
        $count_qry = $cntqry->result();
        return array(
            'qry' => $myqry,
            'count' => count($count_qry),
        );
    }

    public function getproductboat($product_id) {
        $this->db->select('productboat.productID,productboat.cartBTType,productiv.productImage,productboat.productCategoryName,productboat.productBTPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productboat.productBTSubmitDate,trader.traderContactNum,productboat.productBDesc');
        $this->db->from('productboat');
        $this->db->join('trader', 'productboat.traderID=trader.traderID');

        $this->db->join('productiv', 'productboat.productCategoryID=productiv.productCategoryID AND productboat.productID=productiv.productID');
        $this->db->where('productboat.productID', $product_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function record_count_boat() {
        return $this->db->count_all('productboat', 'trader', 'productiv');
    }

    function sendemail_boat($product_id) {
        $this->db->select('productboat.productID,productboat.productCategoryName,productboat.productBPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productboat.productBSubmitDate,trader.traderContactNum,productboat.productBDesc,trader.traderEmailID');
        $this->db->from('productboat');
        $this->db->join('trader', 'productboat.traderID=trader.traderID');
        $this->db->where('productboat.productID', $product_id);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            $result = $query->result();
            foreach ($result as $row) {
                return $row->traderEmailID;
            }
        } else {
            return false;
        }
    }

	function iphone_cat($limit, $offset) {
        $this->db->select('trader.traderID,productiv.postID,productphone.productCategoryID,trader.traderID,productiv.postID,productphone.productID,productphone.PHpost_main_img,productphone.productCategoryName,productphone.productPBrand,productphone.productPModel,productphone.productPHPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productphone.productPSubmitDate');
        $this->db->from('productphone');
        $this->db->join('trader', 'productphone.traderID=trader.traderID');
        $this->db->join('productiv', 'productphone.productCategoryID=productiv.productCategoryID AND productphone.productID=productiv.productID');
        $this->db->where('productphone.productCategoryID', 8);
        $this->db->limit($limit, $offset);
        $qry = $this->db->get();
        $myqry = $qry->result();
        
        $this->db->select('trader.traderID,productiv.postID,productphone.productCategoryID,trader.traderID,productiv.postID,productphone.productID,productphone.PHpost_main_img,productphone.productCategoryName,productphone.productPBrand,productphone.productPModel,productphone.productPHPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productphone.productPSubmitDate');
        $this->db->from('productphone');
        $this->db->join('trader', 'productphone.traderID=trader.traderID');
        $this->db->join('productiv', 'productphone.productCategoryID=productiv.productCategoryID AND productphone.productID=productiv.productID');
        $this->db->where('productphone.productCategoryID', 8);
       
        $cntqry = $this->db->get();
        $count_qry = $cntqry->result();
        return array(
            'qry' => $myqry,
            'count' => count($count_qry),
        );
    }



    function mdl_iphone_details($product_id) {
        $this->db->select('productphone.productID,productphone.cartPHType,productiv.productImage,productphone.productCategoryName,productphone.productPBrand,productphone.productPModel,productphone.productPHPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productphone.productPSubmitDate,trader.traderContactNum,productphone.productPDesc');
        $this->db->from('productphone');
        $this->db->join('trader', 'productphone.traderID=trader.traderID');

        $this->db->join('productiv', 'productphone.productCategoryID=productiv.productCategoryID AND productphone.productID=productiv.productID');
        $this->db->where('productphone.productID', $product_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function record_count_phone() {
        return $this->db->count_all('productphone', 'trader', 'productiv');
    }

    function sendemail_phone($product_id) {
        $this->db->select('productphone.productID,productphone.productCategoryName,productphone.productPPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productphone.productPSubmitDate,trader.traderContactNum,productphone.productPDesc,trader.traderEmailID');
        $this->db->from('productphone');
        $this->db->join('trader', 'productphone.traderID=trader.traderID');
        $this->db->where('productphone.productID', $product_id);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            $result = $query->result();
            foreach ($result as $row) {
                return $row->traderEmailID;
            }
        } else {
            return false;
        }
    }

function get_property($limit, $offset) {
        $this->db->select('productproperty.productID,trader.traderID,productiv.postID,productproperty.productCategoryID,productproperty.PRpost_main_img,productproperty.productCategoryName,productproperty.productPRPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productproperty.productPRSubmitDate');
        $this->db->from('productproperty');
        $this->db->join('trader', 'productproperty.traderID=trader.traderID');
        $this->db->join('productiv', 'productproperty.productCategoryID=productiv.productCategoryID AND productproperty.productID=productiv.productID');
        $this->db->where('productproperty.productCategoryID', 9);
        $this->db->limit($limit, $offset);
        $qry = $this->db->get();
        $myqry = $qry->result();
        
        $this->db->select('productproperty.productID,trader.traderID,productiv.postID,productproperty.productCategoryID,productproperty.PRpost_main_img,productproperty.productCategoryName,productproperty.productPRPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productproperty.productPRSubmitDate');
        $this->db->from('productproperty');
        $this->db->join('trader', 'productproperty.traderID=trader.traderID');
        $this->db->join('productiv', 'productproperty.productCategoryID=productiv.productCategoryID AND productproperty.productID=productiv.productID');
        $this->db->where('productproperty.productCategoryID', 9);
        
        $cntqry = $this->db->get();
        $count_qry = $cntqry->result();
        return array(
            'qry' => $myqry,
            'count' => count($count_qry),
        );
    }


    public function getproductproperty($product_id) {
        $this->db->select('productproperty.productID,productproperty.cartPRType,productiv.productImage,productproperty.productCategoryName,productproperty.productPRPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productproperty.productPRSubmitDate,trader.traderContactNum,productproperty.productDesc');
        $this->db->from('productproperty');
        $this->db->join('trader', 'productproperty.traderID=trader.traderID');
        $this->db->join('productiv', 'productproperty.productCategoryID=productiv.productCategoryID AND productproperty.productID=productiv.productID');
        $this->db->where('productproperty.productID', $product_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function record_count_property() {
        return $this->db->count_all('productproperty', 'trader', 'productiv');
    }

    function sendemail_property($product_id) {
        $this->db->select('productproperty.productID,productproperty.productCategoryName,productproperty.productPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productproperty.productSubmitDate,trader.traderContactNum,productproperty.productDesc,trader.traderEmailID');
        $this->db->from('productproperty');
        $this->db->join('trader', 'productproperty.traderID=trader.traderID');
        $this->db->where('productproperty.productID', $product_id);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            $result = $query->result();
            foreach ($result as $row) {
                return $row->traderEmailID;
            }
        } else {
            return false;
        }
    }
    function get_producttrader($trader_id) {
        $this->db->select('product.productViewCount,trader.socialWeb,trader.socialFb,trader.socialInsta,trader.socialSnap,product.productID,product.productImage,product.productName,product.productPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,product.productSubmitDate,trader.traderContactNum,product.productDescr,trader.traderID');
        $this->db->from('trader');
        $this->db->join('product', 'product.traderID=trader.traderID');
        $this->db->where('trader.traderID', $trader_id);
        $qry = $this->db->get();
        return $qry->result();
        }
    
      public function get_autocomplete($srchfor) {
        $this->db->select('category_name, productCategoryID');
        $this->db->like('category_name', $srchfor);
        return $this->db->get('category', 10)->result();
      }

    public function search($keyword) {
        $this->db->select('category_name, productCategoryID');
        $this->db->like('category_name', $keyword);
        return $this->db->get('category', 10)->result();
    }
    function gettraders($txtemail, $txtpassword) {

        $this->db->select('*');
        $this->db->from('trader');
        $this->db->where('traderEmailID', $txtemail);
        $this->db->where('traderPasswd', $txtpassword);
      
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
      function addtocart($userId,$postId,$productcategoryId,$productId)
    {
        $cartcnt = 1;
        $i=1;
        
        $prod_avail = 0;
        //$data = array('cartlistID'=>$i++,'customerID'=>$trader_id,'productID'=>$prod_id,'cartlistCount'=>$cartcnt,'productAvailability'=>$prod_avail);
        $data = array('traderID'=>$userId,'postID'=>$postId,'productID'=>$productId,'cartlistCount'=>$cartcnt,'productAvailability'=>$prod_avail,'productCategoryID'=>$productcategoryId);
        $this->db->insert('cartlist',$data);
    }
    
    
    
    
      function get_cart_traderid($userId)
   {
      $qry=$this->db->query('SELECT DISTINCT cartlist.postID,cartlist.productCategoryID,cartlist.productID,productiv.productViewCount,`productcar`.`productCBrand`, `productcar`.`productCModel`, `productcar`.`productCSubmitDate`, `productcar`.`productCPrice`,`productcar`.`Cpost_main_img`,productcar.cartCType,productcar.productCStatus,
          `productbike`.`productBBrand`, `productbike`.`productBModel`, `productbike`.`productBSubmitDate`, `productbike`.`productBPrice`, `productbike`.`Bpost_main_img`,productbike.cartBType,productbike.productBStatus,
          `productvertu`.`productVBrand`, `productvertu`.`productVModel`, `productvertu`.`productVSubmitDate`, `productvertu`.`productVPrice`, `productvertu`.`Vpost_main_img`,productvertu.cartVType,productvertu.productVStatus,
          `productboat`.`productBtBrand`, `productboat`.`productBtModel`, `productboat`.`productBTSubmitDate`, `productboat`.`productBTPrice`, `productboat`.`BTpost_main_img`,productboat.cartBTType,productboat.productBTStatus, 
          `productwatch`.`productWBrand`, `productwatch`.`productWModel`, `productwatch`.`productWSubmitDate`, `productwatch`.`productWPrice`, `productwatch`.`Wpost_main_img`,productwatch.cartWType,productwatch.productWStatus,
          `productphone`.`productPBrand`, `productphone`.`productPModel`, `productphone`.`productPSubmitDate`, `productphone`.`productPHPrice`, `productphone`.`PHpost_main_img`,productphone.productPHStatus,productphone.cartPHType,
          `productproperty`.`productPropSC`,  `productproperty`.`productPRSubmitDate`, `productproperty`.`productPRPrice`, `productproperty`.`PRpost_main_img`,productproperty.cartPRType,productproperty.productPRStatus,productproperty.productPropType,
          `productnp`.`productNPCode`, `productnp`.`productNPDigits`, `productnp`.`productNPSubmitDate`, `productnp`.`productNPPrice`, `productnp`.`NPpost_main_img`,productnp.cartNPType,productnp.productNPStatus,productnp.productNPNmbr,
          `productmn`.`productMNPrefix`, `productmn`.`productMNNmbr`, `productmn`.`productMNSubmitDate`, `productmn`.`productMNPrice`, `productmn`.`MNpost_main_img`,productmn.cartMNType,productmn.productMNStatus,productmn.productOperator,
           `trader`.`traderID`, `trader`.`traderFullName`, `trader`.`traderLocation`, `trader`.`traderImage`
       
           from cartlist
        left JOIN `productiv` ON `cartlist`.`postID`=`cartlist`.`postID`
        left JOIN `trader` ON `cartlist`.`traderID`=`trader`.`traderID`
        left JOIN `productcar` ON (`cartlist`.`productCategoryID`=`productcar`.`productCategoryID` AND `cartlist`.`productID`=`productcar`.`productID`)
        left JOIN `productbike` ON (`cartlist`.`productCategoryID`=`productbike`.`productCategoryID` AND `cartlist`.`productID`=`productbike`.`productID`)
        left JOIN `productboat` ON (`cartlist`.`productCategoryID`=`productboat`.`productCategoryID` AND `cartlist`.`productID`=`productboat`.`productID`)
        left JOIN `productmn` ON (`cartlist`.`productCategoryID`=`productmn`.`productCategoryID` AND `cartlist`.`productID`=`productmn`.`productID`) 
        left JOIN `productnp` ON (`cartlist`.`productCategoryID`=`productnp`.`productCategoryID` AND `cartlist`.`productID`=`productnp`.`productID`)
        left JOIN `productphone` ON (`cartlist`.`productCategoryID`=`productphone`.`productCategoryID` AND `cartlist`.`productID`=`productphone`.`productID`)
        left JOIN `productproperty` ON (`cartlist`.`productCategoryID`=`productproperty`.`productCategoryID` AND `cartlist`.`productID`=`productproperty`.`productID`) 
        left JOIN `productvertu` ON (`cartlist`.`productCategoryID`=`productvertu`.`productCategoryID` AND `cartlist`.`productID`=`productvertu`.`productID`)
        left JOIN `productwatch` ON (`cartlist`.`productCategoryID`=`productwatch`.`productCategoryID` AND `cartlist`.`productID`=`productwatch`.`productID`)
        WHERE `cartlist`.`traderID` = '.$userId); 
         foreach ($qry->result() as $row) {
          
            $data['postId'] = $row->postID;
            $data['CategoryId'] = $row->productCategoryID;
            $data['ProductId'] = $row->productID;
           
            
            if ($data['CategoryId'] == 1) {
                $data['thumbnailUrl'] = $row->Cpost_main_img;
                $data['is_alshamilProduct'] = $row->cartCType;
                $data['publishedOn'] = $row->productCSubmitDate;
                $data['price'] = $row->productCPrice;
                $data['titleEn'] = $row->productCBrand." ".$row->productCModel;
                $data['titleAr'] = "";
               
                $data['status'] = $row->productCStatus;
            } else if ($data['CategoryId'] == 2) {
               $data['is_alshamilProduct'] = $row->cartBType;
               $data['thumbnailUrl']= $row->Bpost_main_img;
               $data['publishedOn']= $row->productBSubmitDate;
                $data['price']  = $row->productBPrice;
                $data['titleEn'] = $row->productBBrand." ".$row->productBModel;
               $data['titleAr'] = "";
                
               $data['status']  = $row->productBStatus;
            } else if ($data['CategoryId'] == 3) {
                 $data['is_alshamilProduct'] = $row->cartNPType;
               $data['thumbnailUrl'] = $row->NPpost_main_img;
             $data['publishedOn'] = $row->productNPSubmitDate;
                $data['price']  = $row->productNPPrice;
                $data['titleEn'] = $row->productNPCode." ".$row->productNPNmbr;
                $data['titleAr'] = "";
                
               $data['status'] = $row->productNPStatus;
            } else if ($data['CategoryId']== 4) {
               $data['is_alshamilProduct']= $row->cartVType;
                 $data['thumbnailUrl'] = $row->Vpost_main_img;
                $data['publishedOn'] = $row->productVSubmitDate;
              $data['price']= $row->productVPrice;
               $data['titleEn'] = $row->productVBrand." ". $row->productVModel;
               $data['titleAr']  ="";
               
              $data['status'] = $row->productVStatus;
            } else if ($data['CategoryId']== 5) {
                 $data['is_alshamilProduct'] = $row->cartWType;
               $data['thumbnailUrl'] = $row->Wpost_main_img;
                 $data['publishedOn'] = $row->productWSubmitDate;
               $data['price'] = $row->productWPrice;
                $data['titleEn']= $row->productWBrand." ".$row->productWModel;
              $data['titleAr'] = "";
               
                $data['status']= $row->productWStatus;
            } else if ($data['CategoryId'] == 6) {
               $data['is_alshamilProduct']= $row->cartMNType;
              $data['thumbnailUrl'] = $row->MNpost_main_img;
                $data['publishedOn']= $row->productMNSubmitDate;
               $data['price'] = $row->productMNPrice;
                $data['titleEn'] = $row->productOperator." ".$row->productMNNmbr;
                $data['titleAr'] = "";
                
               $data['status'] = $row->productMNStatus;
            } else if ($data['CategoryId'] == 7) {
              $data['is_alshamilProduct']= $row->cartBTType;
                 $data['thumbnailUrl'] = $row->BTpost_main_img;
                $data['publishedOn'] = $row->productBTSubmitDate;
                $data['price'] = $row->productBTPrice;
               $data['titleEn'] = $row->productBtBrand." ". $row->productBtModel;
                $data['titleAr']  =" ";
                
               $data['status'] = $row->productBTStatus;
            } else if ($data['CategoryId'] == 8) {
               $data['is_alshamilProduct'] = $row->cartPHType;
                   $data['thumbnailUrl'] = $row->PHpost_main_img;
               $data['publishedOn'] = $row->productPSubmitDate;
                $data['price'] = $row->productPHPrice;
              $data['titleEn']= $row->productPBrand." ".$row->productPModel;
                 $data['titleAr'] = "";
                
              $data['status']= $row->productPHStatus;
            } else if ($data['CategoryId'] == 9) {
              $data['is_alshamilProduct'] = $row->cartPRType;
                $data['thumbnailUrl']= $row->PRpost_main_img;
                $data['publishedOn'] = $row->productPRSubmitDate;
               $data['price']  = $row->productPRPrice;
              $data['titleEn'] = $row->productPropType." ". $row->productPropSC;
                 $data['titleAr'] ="";
               
               $data['status']= $row->productPRStatus;
            } else {
               $data['is_alshamilProduct'] = "";
                $data['thumbnailUrl'] = "";
               $data['publishedOn'] = "";
                 $data['price'] = "";
               $data['titleEn']= "";
                $data['titleAr'] = "";
               
              $data['status'] = "";
            }
            
          
            $data['traderId'] = $row->traderID;
            $data['traderNameEn'] = $row->traderFullName;
            $data['traderNameAr'] = "";
            $data['traderLocationEn'] = $row->traderLocation;
            $data['traderLocationAr'] = "";
            $data['traderImage'] = $row->traderImage;

            $row_post[] = $data;
            $data='';
            
        }
         return $row_post; 
      
   }
   function get_cart_traderinfo($userId)
   {
      $qry=$this->db->query('Select
          `trader`.`traderID`, `trader`.`traderFullName`, `trader`.`traderLocation`, `trader`.`traderImage`
           from cartlist
        left JOIN `trader` ON `cartlist`.`traderID`=`trader`.`traderID`
        left JOIN `productcar` ON (`cartlist`.`productCategoryID`=`productcar`.`productCategoryID` AND `cartlist`.`productID`=`productcar`.`productID`)
        left JOIN `productbike` ON (`cartlist`.`productCategoryID`=`productbike`.`productCategoryID` AND `cartlist`.`productID`=`productbike`.`productID`)
        left JOIN `productboat` ON (`cartlist`.`productCategoryID`=`productboat`.`productCategoryID` AND `cartlist`.`productID`=`productboat`.`productID`)
        left JOIN `productmn` ON (`cartlist`.`productCategoryID`=`productmn`.`productCategoryID` AND `cartlist`.`productID`=`productmn`.`productID`) 
        left JOIN `productnp` ON (`cartlist`.`productCategoryID`=`productnp`.`productCategoryID` AND `cartlist`.`productID`=`productnp`.`productID`)
        left JOIN `productphone` ON (`cartlist`.`productCategoryID`=`productphone`.`productCategoryID` AND `cartlist`.`productID`=`productphone`.`productID`)
        left JOIN `productproperty` ON (`cartlist`.`productCategoryID`=`productproperty`.`productCategoryID` AND `cartlist`.`productID`=`productproperty`.`productID`) 
        left JOIN `productvertu` ON (`cartlist`.`productCategoryID`=`productvertu`.`productCategoryID` AND `cartlist`.`productID`=`productvertu`.`productID`)
        left JOIN `productwatch` ON (`cartlist`.`productCategoryID`=`productwatch`.`productCategoryID` AND `cartlist`.`productID`=`productwatch`.`productID`)
        WHERE `cartlist`.`traderID` = '.$userId); 
         
       return $qry->result(); 
   }
     function deletecart($userId,$cartlistId)
    {
      $this->db->where('traderID', $userId);
      $this->db->where('cartlistID', $cartlistId);
      $this->db->delete('cartlist'); 
    }
    function get_notification($userId)
        {
         $qry=$this->db->query('SELECT tradernotifications.notificationtype, `tradernotifications`.`postID`,tradernotifications.productCategoryID,tradernotifications.productID,
           `productcar`.`productCBrand`, `productcar`.`productCModel` ,`productcar`.`productCPrice`,productcar.productCStatus,productcar.Cpost_main_img,productcar.cartCType,productcar.productCSubmitDate,
           `productbike`.`productBBrand`, `productbike`.`productBModel`, `productbike`.`productBSubmitDate`, `productbike`.`productBPrice`,productbike.productBStatus,productbike.Bpost_main_img,productbike.cartBType,
           `productboat`.`productBtBrand`, `productboat`.`productBtModel`, `productboat`.`productBTSubmitDate`,`productboat`.`productBTPrice`,productboat.productBTStatus,productboat.BTpost_main_img, productboat.cartBTType,
           `productwatch`.`productWBrand`, `productwatch`.`productWModel`, `productwatch`.`productWSubmitDate`, `productwatch`.`productWPrice`,productwatch.productWStatus,productwatch.Wpost_main_img,productwatch.cartWType,
           `productvertu`.`productVBrand`, `productvertu`.`productVModel`, `productvertu`.`productVSubmitDate`, `productvertu`.`productVPrice`,productvertu.productVStatus,productvertu.Vpost_main_img, productvertu.cartVType,
           `productproperty`.`productPropSC`,  `productproperty`.`productPRSubmitDate`, `productproperty`.`productPRPrice`,productproperty.productPRStatus,productproperty.PRpost_main_img,productproperty.cartPRType,productproperty.productPropType, 
           `productphone`.`productPBrand`, `productphone`.`productPModel`, `productphone`.`productPSubmitDate`, `productphone`.`productPHPrice`,productphone.productPHStatus,productphone.PHpost_main_img,productphone.cartPHType,
           `productnp`.`productNPCode`, `productnp`.`productNPDigits`, `productnp`.`productNPSubmitDate`, `productnp`.`productNPPrice`,productnp.productNPStatus,productnp.NPpost_main_img,productnp.cartNPType,productnp.productNPNmbr,
           `productmn`.`productMNPrefix`, `productmn`.`productMNNmbr`, `productmn`.`productMNSubmitDate`, `productmn`.`productMNPrice`,productmn.productMNStatus,productmn.MNpost_main_img,productmn.cartMNType,productmn.productOperator,
            trader.traderID,trader.traderFullName,trader.traderLocation,trader.traderImage
        from tradernotifications
        left JOIN `trader` ON `tradernotifications`.`traderID`=`trader`.`traderID`
      
        left JOIN `productcar` ON (`tradernotifications`.`productCategoryID`=`productcar`.`productCategoryID` and tradernotifications.productID=productcar.productID)
        left JOIN `productbike` ON( `tradernotifications`.`productCategoryID`=`productbike`.`productCategoryID` and tradernotifications.productID=productbike.productID)
        left JOIN `productboat` ON (`tradernotifications`.`productCategoryID`=`productboat`.`productCategoryID` and  tradernotifications.productID=productboat.productID)
        left JOIN `productmn` ON (`tradernotifications`.`productCategoryID`=`productmn`.`productCategoryID` and tradernotifications.productID=productmn.productID)
        left JOIN `productnp` ON( `tradernotifications`.`productCategoryID`=`productnp`.`productCategoryID` and tradernotifications.productID=productnp.productID)
        left JOIN `productphone` ON (`tradernotifications`.`productCategoryID`=`productphone`.`productCategoryID`and tradernotifications.productID=productphone.productID)
        left JOIN `productproperty` ON( `tradernotifications`.`productCategoryID`=`productproperty`.`productCategoryID`and tradernotifications.productID=productproperty.productID)
        left JOIN `productvertu` ON (`tradernotifications`.`productCategoryID`=`productvertu`.`productCategoryID`and tradernotifications.productID=productvertu.productID)
        left JOIN `productwatch` ON( `tradernotifications`.`productCategoryID`=`productwatch`.`productCategoryID` and tradernotifications.productID=productwatch.productID)
        WHERE `tradernotifications`.`traderID` = '.$userId);
      
         
           foreach ($qry->result() as $row) {
            $data['notificationType'] = $row->notificationtype;
            $data['postId'] = $row->postID;
            $data['categoryId'] = $row->productCategoryID;
            $data['ProductId'] = $row->productID;
            
            
            if ($data['categoryId'] == 1) {
                $data['image'] = $row->Cpost_main_img;
                $data['is_alshamilProduct'] = $row->cartCType;
                $data['publishedOn'] = $row->productCSubmitDate;
                $data['price'] = $row->productCPrice;
                $data['titleEn'] = $row->productCBrand." ".$row->productCModel;
                $data['titleAr'] = "";
               
                $data['status'] = $row->productCStatus;
            } else if ($data['categoryId'] == 2) {
                 $data['is_alshamilProduct']= $row->cartBType;
               $data['image'] = $row->Bpost_main_img;
              $data['publishedOn'] = $row->productBSubmitDate;
                 $data['price']= $row->productBPrice;
                $data['titleEn'] = $row->productBBrand." ".$row->productBModel;
                $data['titleAr'] = "";
               
                $data['status'] = $row->productBStatus;
            } else if ($data['categoryId'] == 3) {
                $data['is_alshamilProduct'] = $row->cartNPType;
                 $data['image'] = $row->NPpost_main_img;
                $data['publishedOn'] = $row->productNPSubmitDate;
                 $data['price'] = $row->productNPPrice;
               $data['titleEn'] = $row->productNPCode." ". $row->productNPNmbr;
               $data['titleAr'] ="";
               
                $data['status'] = $row->productNPStatus;
            } else if ($data['categoryId'] == 4) {
                 $data['is_alshamilProduct'] = $row->cartVType;
                $data['image'] = $row->Vpost_main_img;
               $data['publishedOn']= $row->productVSubmitDate;
                $data['price'] = $row->productVPrice;
                $data['titleEn'] = $row->productVBrand." ". $row->productVModel;
                $data['titleAr'] ="";
               
              $data['status']= $row->productVStatus;
            } else if ($data['categoryId']== 5) {
                $data['is_alshamilProduct'] = $row->cartWType;
                 $data['image']  = $row->Wpost_main_img;
                $data['publishedOn'] = $row->productWSubmitDate;
               $data['price'] = $row->productWPrice;
                $data['titleEn'] = $row->productWBrand." ". $row->productWModel;
               $data['titleAr'] ="";
               
                 $data['status'] = $row->productWStatus;
            } else if ($data['categoryId'] == 6) {
                $data['is_alshamilProduct'] = $row->cartMNType;
                 $data['image'] = $row->MNpost_main_img;
              $data['publishedOn'] = $row->productMNSubmitDate;
                 $data['price'] = $row->productMNPrice;
             $data['titleEn']= $row->productOperator." ".$row->productMNNmbr;
                 $data['titleAr'] = "";
               
                $data['status'] = $row->productMNStatus;
            } else if ($data['categoryId'] == 7) {
              $data['is_alshamilProduct'] = $row->cartBTType;
               $data['image'] = $row->BTpost_main_img;
                $data['publishedOn']= $row->productBTSubmitDate;
                 $data['price']= $row->productBTPrice;
               $data['titleEn'] = $row->productBtBrand." ". $row->productBtModel;
               $data['titleAr'] ="";
               
                $data['status'] = $row->productBTStatus;
            } else if ($data['categoryId'] == 8) {
               $data['is_alshamilProduct'] = $row->cartPHType;
                 $data['image'] = $row->PHpost_main_img;
               $data['publishedOn'] = $row->productPSubmitDate;
                $data['price'] = $row->productPHPrice;
                  $data['titleEn'] = $row->productPBrand." ". $row->productPModel;
                 $data['titleAr']="";
               
                 $data['status'] = $row->productPHStatus;
            } else if ($data['categoryId'] == 9) {
                $data['is_alshamilProduct'] = $row->cartPRType;
               $data['image'] = $row->PRpost_main_img;
                $data['publishedOn']= $row->productPRSubmitDate;
              $data['price'] = $row->productPRPrice;
                $data['titleEn'] = $row->productPropType." ". $row->productPropSC;
               $data['titleAr'] ="";
                
                 $data['status'] = $row->productPRStatus;
            } else {
                 $data['is_alshamilProduct'] = "";
                 $data['image']  = "";
               $data['publishedOn'] = "";
                 $data['price'] = "";
                 $data['titleEn'] = "";
                $data['titleAr'] = "";
               
                $data['status'] = "";
            }
            
         
            $data['traderId'] = $row->traderID;
            $data['traderNameEn'] = $row->traderFullName;
               $data['traderNameEn'] = $row->traderFullName;
            $data['traderLocationEn'] = "";
               $data['traderLocationAr'] = "";
            $data['traderImage'] = $row->traderImage;
            $row_post[] = $data;
            $data='';
            
        }
         return $row_post;
         
         
         
        }
         function get_traderinfo($userId)
        {
         $qry=$this->db->query('SELECT  
            trader.traderID,trader.traderFullName,trader.traderLocation,trader.traderImage
          
        from tradernotifications
        left JOIN `trader` ON `tradernotifications`.`traderID`=`trader`.`traderID`
        left JOIN `productiv` ON `tradernotifications`.`postID`=`productiv`.`postID`
        left JOIN `productcar` ON (`tradernotifications`.`productCategoryID`=`productcar`.`productCategoryID` and tradernotifications.productID=productcar.productID)
        left JOIN `productbike` ON( `tradernotifications`.`productCategoryID`=`productbike`.`productCategoryID` and tradernotifications.productID=productbike.productID)
        left JOIN `productboat` ON (`tradernotifications`.`productCategoryID`=`productboat`.`productCategoryID` and  tradernotifications.productID=productboat.productID)
        left JOIN `productmn` ON (`tradernotifications`.`productCategoryID`=`productmn`.`productCategoryID` and tradernotifications.productID=productmn.productID)
        left JOIN `productnp` ON( `tradernotifications`.`productCategoryID`=`productnp`.`productCategoryID` and tradernotifications.productID=productnp.productID)
        left JOIN `productphone` ON (`tradernotifications`.`productCategoryID`=`productphone`.`productCategoryID`and tradernotifications.productID=productphone.productID)
        left JOIN `productproperty` ON( `tradernotifications`.`productCategoryID`=`productproperty`.`productCategoryID`and tradernotifications.productID=productproperty.productID)
        left JOIN `productvertu` ON (`tradernotifications`.`productCategoryID`=`productvertu`.`productCategoryID`and tradernotifications.productID=productvertu.productID)
        left JOIN `productwatch` ON( `tradernotifications`.`productCategoryID`=`productwatch`.`productCategoryID` and tradernotifications.productID=productwatch.productID)
        WHERE `tradernotifications`.`traderID` = '.$userId);
       return $qry->result(); 
        }
         function get_trader_profile($userId)
   {
       $this->db->select('traderID,traderFullName,traderInfo,traderLocation,traderUserName,traderPasswd,traderContactNum,traderEmailID,traderImage,traderIDProof,traderIDProofsecond,usertype,deviceId,socialWeb,socialFb,socialInsta,socialSnap,socialtwitter,traderPaymentHistory,traderPostCount,traderBookedCount,traderSoldCount,traderValidTill');
        $this->db->from('trader');
        $this->db->where('traderID', $userId);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
   }
      function get_post_approved($per_page_cnt,$limit,$userId)
   {
      $qry=$this->db->query('SELECT DISTINCT `post`.`postID`,`post`.`productCategoryID`,post.productID,
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
        left JOIN `productcar` ON (`post`.`productCategoryID`=`productcar`.`productCategoryID` and post.productID=productcar.productID)
        left JOIN `productbike` ON( `post`.`productCategoryID`=`productbike`.`productCategoryID` and post.productID=productbike.productID)
        left JOIN `productboat` ON (`post`.`productCategoryID`=`productboat`.`productCategoryID` and  post.productID=productboat.productID)
        left JOIN `productmn` ON (`post`.`productCategoryID`=`productmn`.`productCategoryID` and post.productID=productmn.productID)
        left JOIN `productnp` ON( `post`.`productCategoryID`=`productnp`.`productCategoryID` and post.productID=productnp.productID)
        left JOIN `productphone` ON (`post`.`productCategoryID`=`productphone`.`productCategoryID`and post.productID=productphone.productID)
        left JOIN `productproperty` ON( `post`.`productCategoryID`=`productproperty`.`productCategoryID`and post.productID=productproperty.productID)
        left JOIN `productvertu` ON (`post`.`productCategoryID`=`productvertu`.`productCategoryID`and post.productID=productvertu.productID)
        left JOIN `productwatch` ON( `post`.`productCategoryID`=`productwatch`.`productCategoryID` and post.productID=productwatch.productID)
        WHERE `post`.`postStatus`=1 and post.traderID='.$userId .' order by post.postSubmissionOn DESC  limit '.$per_page_cnt.' offset '.$limit); 
     
      
       foreach ($qry->result() as $row) {
            $data['postId'] = $row->postID;
            $data['categoryId'] = $row->productCategoryID;
            $data['ProductId'] = $row->productID;
           
            
            if ($data['categoryId'] == 1) {
                $data['image'] = $row->Cpost_main_img;
                $data['is_alshamilProduct'] = $row->cartCType;
                $data['publishedOn'] = $row->productCSubmitDate;
                $data['price'] = $row->productCPrice;
                $data['tittleEn'] = $row->productCBrand." ".$row->productCModel;
                $data['tittleAr'] =" " ;
               
                $data['status'] = $row->productCStatus;
            } else if ($data['categoryId'] == 2) {
                 $data['is_alshamilProduct'] = $row->cartBType;
              $data['image'] = $row->Bpost_main_img;
               $data['publishedOn']  = $row->productBSubmitDate;
                $data['price'] = $row->productBPrice;
               $data['tittleEn']= $row->productBBrand." ". $row->productBModel;
                $data['tittleAr'] ="";
                
                $data['status'] = $row->productBStatus;
            } else if ($data['categoryId'] == 3) {
               $data['is_alshamilProduct'] = $row->cartNPType;
               $data['image']  = $row->NPpost_main_img;
               $data['publishedOn'] = $row->productNPSubmitDate;
                 $data['price']= $row->productNPPrice;
               $data['tittleEn']= $row->productNPCode."".$row->productNPNmbr;
                $data['tittleAr'] = "";
                
               $data['status']= $row->productNPStatus;
            } else if ($data['categoryId'] == 4) {
                  $data['is_alshamilProduct']= $row->cartVType;
               $data['image'] = $row->Vpost_main_img;
                $data['publishedOn']= $row->productVSubmitDate;
                $data['price'] = $row->productVPrice;
                $data['tittleEn'] = $row->productVBrand."".$row->productVModel;
                $data['tittleAr'] = "";
               
                 $data['status'] = $row->productVStatus;
            } else if ($data['categoryId'] == 5) {
               $data['is_alshamilProduct'] = $row->cartWType;
                $data['image'] = $row->Wpost_main_img;
               $data['publishedOn'] = $row->productWSubmitDate;
                 $data['price']= $row->productWPrice;
                $data['tittleEn'] = $row->productWBrand."". $row->productWModel;
                  $data['tittleAr'] ="";
               
               $data['status'] = $row->productWStatus;
            } else if ($data['categoryId'] == 6) {
                $data['is_alshamilProduct'] = $row->cartMNType;
                $data['image'] = $row->MNpost_main_img;
              $data['publishedOn']= $row->productMNSubmitDate;
               $data['price'] = $row->productMNPrice;
                 $data['tittleEn']  = $row->productOperator."".$row->productMNNmbr;
               $data['tittleAr']= "";
                
                $data['status'] = $row->productMNStatus;
            } else if ($data['categoryId'] == 7) {
                $data['is_alshamilProduct']= $row->cartBTType;
               $data['image'] = $row->BTpost_main_img;
               $data['publishedOn'] = $row->productBTSubmitDate;
               $data['price'] = $row->productBTPrice;
                 $data['tittleEn'] = $row->productBtBrand."".$row->productBtModel;
              $data['tittleAr']= "";
                
                 $data['status'] = $row->productBTStatus;
            } else if ($data['categoryId'] == 8) {
                  $data['is_alshamilProduct'] = $row->cartPHType;
              $data['image'] = $row->PHpost_main_img;
                $data['publishedOn'] = $row->productPSubmitDate;
                $data['price'] = $row->productPHPrice;
              $data['tittleEn'] = $row->productPBrand." ".$row->productPModel;
                 $data['tittleAr'] = "";
                
                 $data['status'] = $row->productPHStatus;
            } else if ($data['categoryId'] == 9) {
                 $data['is_alshamilProduct'] = $row->cartPRType;
                 $data['image'] = $row->PRpost_main_img;
                $data['publishedOn'] = $row->productPRSubmitDate;
                $data['price']  = $row->productPRPrice;
            $data['tittleEn'] = $row->productPropType."". $row->productPropSC;
               $data['tittleAr'] ="";
               
                $data['status'] = $row->productPRStatus;
            } else {
                $data['is_alshamilProduct']= "";
              $data['image'] = "";
              $data['publishedOn'] = "";
               $data['price'] = "";
               $data['tittleEn']= "";
                  $data['tittleAr'] = "";
               
                 $data['status'] = "";
            }
            
         
          

            $row_post[] = $data;
            $data='';
            
        }
         return $row_post; 
      
      
      
      
      
   }
     function get_countapproved($userId)
    {
        $qry=$this->db->query('select count(*) as approved_count from post where traderID='.$userId.' and postStatus=1') ;
         return $qry->result();
    }

      function get_post_pending($per_page_cnt,$limit,$userId)
   {
      $qry=$this->db->query('SELECT DISTINCT `post`.`postID`,`post`.`productCategoryID`,post.productID,
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
        left JOIN `productcar` ON (`post`.`productCategoryID`=`productcar`.`productCategoryID` and post.productID=productcar.productID)
        left JOIN `productbike` ON( `post`.`productCategoryID`=`productbike`.`productCategoryID` and post.productID=productbike.productID)
        left JOIN `productboat` ON (`post`.`productCategoryID`=`productboat`.`productCategoryID` and  post.productID=productboat.productID)
        left JOIN `productmn` ON (`post`.`productCategoryID`=`productmn`.`productCategoryID` and post.productID=productmn.productID)
        left JOIN `productnp` ON( `post`.`productCategoryID`=`productnp`.`productCategoryID` and post.productID=productnp.productID)
        left JOIN `productphone` ON (`post`.`productCategoryID`=`productphone`.`productCategoryID`and post.productID=productphone.productID)
        left JOIN `productproperty` ON( `post`.`productCategoryID`=`productproperty`.`productCategoryID`and post.productID=productproperty.productID)
        left JOIN `productvertu` ON (`post`.`productCategoryID`=`productvertu`.`productCategoryID`and post.productID=productvertu.productID)
        left JOIN `productwatch` ON( `post`.`productCategoryID`=`productwatch`.`productCategoryID` and post.productID=productwatch.productID)
        WHERE `post`.`postStatus`=-1 and post.traderID='.$userId .' order by post.postSubmissionOn DESC  limit '.$per_page_cnt.' offset '.$limit); 
     
      
       
       foreach ($qry->result() as $row) {
            $data['postId'] = $row->postID;
            $data['categoryId'] = $row->productCategoryID;
            $data['ProductId'] = $row->productID;
           
            
            if ($data['categoryId'] == 1) {
                $data['image'] = $row->Cpost_main_img;
                $data['is_alshamilProduct'] = $row->cartCType;
                $data['publishedOn'] = $row->productCSubmitDate;
                $data['price'] = $row->productCPrice;
                $data['tittleEn'] = $row->productCBrand." ".$row->productCModel;
                $data['tittleAr'] =" " ;
               
                $data['status'] = $row->productCStatus;
            } else if ($data['categoryId'] == 2) {
                 $data['is_alshamilProduct'] = $row->cartBType;
              $data['image'] = $row->Bpost_main_img;
               $data['publishedOn']  = $row->productBSubmitDate;
                $data['price'] = $row->productBPrice;
               $data['tittleEn']= $row->productBBrand." ". $row->productBModel;
                $data['tittleAr'] ="";
                
                $data['status'] = $row->productBStatus;
            } else if ($data['categoryId'] == 3) {
               $data['is_alshamilProduct'] = $row->cartNPType;
               $data['image']  = $row->NPpost_main_img;
               $data['publishedOn'] = $row->productNPSubmitDate;
                 $data['price']= $row->productNPPrice;
               $data['tittleEn']= $row->productNPCode."".$row->productNPNmbr;
                $data['tittleAr'] = "";
                
               $data['status']= $row->productNPStatus;
            } else if ($data['categoryId'] == 4) {
                  $data['is_alshamilProduct']= $row->cartVType;
               $data['image'] = $row->Vpost_main_img;
                $data['publishedOn']= $row->productVSubmitDate;
                $data['price'] = $row->productVPrice;
                $data['tittleEn'] = $row->productVBrand."".$row->productVModel;
                $data['tittleAr'] = "";
               
                 $data['status'] = $row->productVStatus;
            } else if ($data['categoryId'] == 5) {
               $data['is_alshamilProduct'] = $row->cartWType;
                $data['image'] = $row->Wpost_main_img;
               $data['publishedOn'] = $row->productWSubmitDate;
                 $data['price']= $row->productWPrice;
                $data['tittleEn'] = $row->productWBrand."". $row->productWModel;
                  $data['tittleAr'] ="";
               
               $data['status'] = $row->productWStatus;
            } else if ($data['categoryId'] == 6) {
                $data['is_alshamilProduct'] = $row->cartMNType;
                $data['image'] = $row->MNpost_main_img;
              $data['publishedOn']= $row->productMNSubmitDate;
               $data['price'] = $row->productMNPrice;
                 $data['tittleEn']  = $row->productOperator."".$row->productMNNmbr;
               $data['tittleAr']= "";
                
                $data['status'] = $row->productMNStatus;
            } else if ($data['categoryId'] == 7) {
                $data['is_alshamilProduct']= $row->cartBTType;
               $data['image'] = $row->BTpost_main_img;
               $data['publishedOn'] = $row->productBTSubmitDate;
               $data['price'] = $row->productBTPrice;
                 $data['tittleEn'] = $row->productBtBrand."".$row->productBtModel;
              $data['tittleAr']= "";
                
                 $data['status'] = $row->productBTStatus;
            } else if ($data['categoryId'] == 8) {
                  $data['is_alshamilProduct'] = $row->cartPHType;
              $data['image'] = $row->PHpost_main_img;
                $data['publishedOn'] = $row->productPSubmitDate;
                $data['price'] = $row->productPHPrice;
              $data['tittleEn'] = $row->productPBrand." ".$row->productPModel;
                 $data['tittleAr'] = "";
                
                 $data['status'] = $row->productPHStatus;
            } else if ($data['categoryId'] == 9) {
                 $data['is_alshamilProduct'] = $row->cartPRType;
                 $data['image'] = $row->PRpost_main_img;
                $data['publishedOn'] = $row->productPRSubmitDate;
                $data['price']  = $row->productPRPrice;
            $data['tittleEn'] = $row->productPropType."". $row->productPropSC;
               $data['tittleAr'] ="";
               
                $data['status'] = $row->productPRStatus;
            } else {
                $data['is_alshamilProduct']= "";
              $data['image'] = "";
              $data['publishedOn'] = "";
               $data['price'] = "";
               $data['tittleEn']= "";
                  $data['tittleAr'] = "";
               
                 $data['status'] = "";
            }
            
         
          

            $row_post[] = $data;
            $data='';
            
        }
         return $row_post; 
      
      
      
   }
     function get_countpending($userId)
    {
        $qry=$this->db->query('select count(*) as pending_count from post where traderID='.$userId.' and postStatus=-1') ;
          return $qry->result();
    } 
     function get_post_rejected($per_page_cnt,$limit,$userId)
   {
      $qry=$this->db->query('SELECT DISTINCT `post`.`postID`,`post`.`productCategoryID`,post.productID,post.postStatusDetail,
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
        left JOIN `productcar` ON (`post`.`productCategoryID`=`productcar`.`productCategoryID` and post.productID=productcar.productID)
        left JOIN `productbike` ON( `post`.`productCategoryID`=`productbike`.`productCategoryID` and post.productID=productbike.productID)
        left JOIN `productboat` ON (`post`.`productCategoryID`=`productboat`.`productCategoryID` and  post.productID=productboat.productID)
        left JOIN `productmn` ON (`post`.`productCategoryID`=`productmn`.`productCategoryID` and post.productID=productmn.productID)
        left JOIN `productnp` ON( `post`.`productCategoryID`=`productnp`.`productCategoryID` and post.productID=productnp.productID)
        left JOIN `productphone` ON (`post`.`productCategoryID`=`productphone`.`productCategoryID`and post.productID=productphone.productID)
        left JOIN `productproperty` ON( `post`.`productCategoryID`=`productproperty`.`productCategoryID`and post.productID=productproperty.productID)
        left JOIN `productvertu` ON (`post`.`productCategoryID`=`productvertu`.`productCategoryID`and post.productID=productvertu.productID)
        left JOIN `productwatch` ON( `post`.`productCategoryID`=`productwatch`.`productCategoryID` and post.productID=productwatch.productID)
        WHERE `post`.`postStatus`=0 and post.traderID='.$userId .' order by post.postSubmissionOn DESC  limit '.$per_page_cnt.' offset '.$limit); 
     
      
        
       foreach ($qry->result() as $row) {
            $data['postId'] = $row->postID;
            $data['categoryId'] = $row->productCategoryID;
            $data['ProductId'] = $row->productID;
           
            
            if ($data['categoryId'] == 1) {
                $data['image'] = $row->Cpost_main_img;
                $data['is_alshamilProduct'] = $row->cartCType;
                $data['publishedOn'] = $row->productCSubmitDate;
                $data['price'] = $row->productCPrice;
                $data['tittleEn'] = $row->productCBrand." ".$row->productCModel;
                $data['tittleAr'] =" " ;
               
                $data['status'] = $row->productCStatus;
            } else if ($data['categoryId'] == 2) {
                 $data['is_alshamilProduct'] = $row->cartBType;
              $data['image'] = $row->Bpost_main_img;
               $data['publishedOn']  = $row->productBSubmitDate;
                $data['price'] = $row->productBPrice;
               $data['tittleEn']= $row->productBBrand." ". $row->productBModel;
                $data['tittleAr'] ="";
                
                $data['status'] = $row->productBStatus;
            } else if ($data['categoryId'] == 3) {
               $data['is_alshamilProduct'] = $row->cartNPType;
               $data['image']  = $row->NPpost_main_img;
               $data['publishedOn'] = $row->productNPSubmitDate;
                 $data['price']= $row->productNPPrice;
               $data['tittleEn']= $row->productNPCode."".$row->productNPNmbr;
                $data['tittleAr'] = "";
                
               $data['status']= $row->productNPStatus;
            } else if ($data['categoryId'] == 4) {
                  $data['is_alshamilProduct']= $row->cartVType;
               $data['image'] = $row->Vpost_main_img;
                $data['publishedOn']= $row->productVSubmitDate;
                $data['price'] = $row->productVPrice;
                $data['tittleEn'] = $row->productVBrand."".$row->productVModel;
                $data['tittleAr'] = "";
               
                 $data['status'] = $row->productVStatus;
            } else if ($data['categoryId'] == 5) {
               $data['is_alshamilProduct'] = $row->cartWType;
                $data['image'] = $row->Wpost_main_img;
               $data['publishedOn'] = $row->productWSubmitDate;
                 $data['price']= $row->productWPrice;
                $data['tittleEn'] = $row->productWBrand."". $row->productWModel;
                  $data['tittleAr'] ="";
               
               $data['status'] = $row->productWStatus;
            } else if ($data['categoryId'] == 6) {
                $data['is_alshamilProduct'] = $row->cartMNType;
                $data['image'] = $row->MNpost_main_img;
              $data['publishedOn']= $row->productMNSubmitDate;
               $data['price'] = $row->productMNPrice;
                 $data['tittleEn']  = $row->productOperator."".$row->productMNNmbr;
               $data['tittleAr']= "";
                
                $data['status'] = $row->productMNStatus;
            } else if ($data['categoryId'] == 7) {
                $data['is_alshamilProduct']= $row->cartBTType;
               $data['image'] = $row->BTpost_main_img;
               $data['publishedOn'] = $row->productBTSubmitDate;
               $data['price'] = $row->productBTPrice;
                 $data['tittleEn'] = $row->productBtBrand."".$row->productBtModel;
              $data['tittleAr']= "";
                
                 $data['status'] = $row->productBTStatus;
            } else if ($data['categoryId'] == 8) {
                  $data['is_alshamilProduct'] = $row->cartPHType;
              $data['image'] = $row->PHpost_main_img;
                $data['publishedOn'] = $row->productPSubmitDate;
                $data['price'] = $row->productPHPrice;
              $data['tittleEn'] = $row->productPBrand." ".$row->productPModel;
                 $data['tittleAr'] = "";
                
                 $data['status'] = $row->productPHStatus;
            } else if ($data['categoryId'] == 9) {
                 $data['is_alshamilProduct'] = $row->cartPRType;
                 $data['image'] = $row->PRpost_main_img;
                $data['publishedOn'] = $row->productPRSubmitDate;
                $data['price']  = $row->productPRPrice;
            $data['tittleEn'] = $row->productPropType."". $row->productPropSC;
               $data['tittleAr'] ="";
               
                $data['status'] = $row->productPRStatus;
            } else {
                $data['is_alshamilProduct']= "";
              $data['image'] = "";
              $data['publishedOn'] = "";
               $data['price'] = "";
               $data['tittleEn']= "";
                  $data['tittleAr'] = "";
               
                 $data['status'] = "";
            }
            
         
          

            $row_post[] = $data;
            $data='';
            
        }
         return $row_post; 
      
       
      
   }
function get_countrejected($userId)
    {
        $qry=$this->db->query('select count(*) as rejected_count from post where traderID='.$userId.' and postStatus=0') ;
          return $qry->result();
    }
   
         
        function get_post_soldout($per_page_cnt,$limit,$userId)
   {
      $qry=$this->db->query('SELECT `order_items`.`postID`,`order_items`.`productCategoryID`,order_items.productID,order_items.orderDate,
           `productcar`.`productCBrand`, `productcar`.`productCModel`,`productcar`.`productCPrice`,productcar.Cpost_main_img,productcar.productCSubmitDate,productcar.cartCType,productcar.productCStatus,
           `productbike`.`productBBrand`, `productbike`.`productBModel`, `productbike`.`productBPrice`,productbike.Bpost_main_img,productbike.productBSubmitDate,productbike.cartBType,productbike.productBStatus,
           `productboat`.`productBtBrand`, `productboat`.`productBtModel`,`productboat`.`productBTPrice`,productboat.BTpost_main_img,productboat.productBTSubmitDate,productboat.cartBTType,productboat.productBTStatus, 
           `productwatch`.`productWBrand`, `productwatch`.`productWModel`, `productwatch`.`productWPrice`,productwatch.Wpost_main_img,productwatch.productWSubmitDate,productwatch.cartWType,productwatch.productWStatus,
           `productvertu`.`productVBrand`, `productvertu`.`productVModel`,  `productvertu`.`productVPrice`,productvertu.Vpost_main_img,productvertu.productVSubmitDate,productvertu.cartVType,productvertu.productVStatus,
           `productproperty`.`productPropSC`,   `productproperty`.`productPRPrice`,productproperty.PRpost_main_img,productproperty.productPRSubmitDate,productproperty.cartPRType,productproperty.productPRStatus,productproperty.productPropType, 
           `productphone`.`productPBrand`, `productphone`.`productPModel`, `productphone`.`productPHPrice`,productphone.PHpost_main_img,productphone.productPSubmitDate,productphone.productPHStatus,productphone.cartPHType,
           `productnp`.`productNPCode`, `productnp`.`productNPDigits`,  `productnp`.`productNPPrice`,productnp.NPpost_main_img,productnp.productNPSubmitDate,productnp.cartNPType,productnp.productNPStatus,productnp.productNPNmbr,
           `productmn`.`productMNPrefix`, `productmn`.`productMNNmbr`,  `productmn`.`productMNPrice`,productmn.MNpost_main_img,productmn.productMNSubmitDate,productmn.cartMNType,productmn.productMNStatus,productmn.productOperator,
           `order_items`.`orderUserID`,`order_items`.`orderUserType`,order_items.orderUserName,order_items.orderUserLocation,order_items.orderUserLocation,order_items.orderUserImage
        from order_items
        left JOIN `trader` ON order_items.traderID=trader.traderID
        left JOIN `productiv` ON `order_items`.`postID`=`productiv`.`postID`
        left JOIN `productcar` ON (`order_items`.`productCategoryID`=`productcar`.`productCategoryID` and order_items.productID=productcar.productID)
        left JOIN `productbike` ON( `order_items`.`productCategoryID`=`productbike`.`productCategoryID` and order_items.productID=productbike.productID)
        left JOIN `productboat` ON (`order_items`.`productCategoryID`=`productboat`.`productCategoryID` and  order_items.productID=productboat.productID)
        left JOIN `productmn` ON (`order_items`.`productCategoryID`=`productmn`.`productCategoryID` and order_items.productID=productmn.productID)
        left JOIN `productnp` ON( `order_items`.`productCategoryID`=`productnp`.`productCategoryID` and order_items.productID=productnp.productID)
        left JOIN `productphone` ON (`order_items`.`productCategoryID`=`productphone`.`productCategoryID`and order_items.productID=productphone.productID)
        left JOIN `productproperty` ON( `order_items`.`productCategoryID`=`productproperty`.`productCategoryID`and order_items.productID=productproperty.productID)
        left JOIN `productvertu` ON (`order_items`.`productCategoryID`=`productvertu`.`productCategoryID`and order_items.productID=productvertu.productID)
        left JOIN `productwatch` ON( `order_items`.`productCategoryID`=`productwatch`.`productCategoryID` and order_items.productID=productwatch.productID)
      WHERE order_items.productStatus=3 and order_items.traderID='.$userId. ' limit '.$per_page_cnt.' offset '.$limit);
          foreach ($qry->result() as $row) {
            $data['postId'] = $row->postID;
            $data['categoryId'] = $row->productCategoryID;
            $data['productId'] = $row->productID;
           
            
            if ($data['categoryId'] == 1) {
                $data['image'] = $row->Cpost_main_img;
               
                $data['publishedOn'] = $row->productCSubmitDate;
                $data['price'] = $row->productCPrice;
                $data['titleEn'] = $row->productCBrand." ".$row->productCModel;
                $data['titleAr'] ="" ;
               
                $data['status'] = $row->productCStatus;
            } else if ($data['categoryId'] == 2) {
              
                $data['image'] = $row->Bpost_main_img;
               $data['publishedOn'] = $row->productBSubmitDate;
                $data['price'] = $row->productBPrice;
                $data['titleEn'] = $row->productBBrand." ".$row->productBModel;
                $data['titleAr'] = "";
                
                $data['status'] = $row->productBStatus;
            } else if ($data['categoryId'] == 3) {
              
               $data['image'] = $row->NPpost_main_img;
               $data['publishedOn'] = $row->productNPSubmitDate;
                $data['price'] = $row->productNPPrice;
              $data['titleEn'] = $row->productNPCode."".$row->productNPNmbr;
               $data['titleAr'] = "";
                
                $data['status'] = $row->productNPStatus;
            } else if ($data['categoryId'] == 4) {
              
                 $data['image'] = $row->Vpost_main_img;
               $data['publishedOn'] = $row->productVSubmitDate;
                $data['price'] = $row->productVPrice;
                $data['titleEn'] = $row->productVBrand."".$row->productVModel;
               $data['titleAr'] = "";
               
                $data['status'] = $row->productVStatus;
            } else if ($data['categoryId'] == 5) {
               
                 $data['image'] = $row->Wpost_main_img;
              $data['publishedOn']  = $row->productWSubmitDate;
                 $data['price']= $row->productWPrice;
                 $data['titleEn'] = $row->productWBrand." ". $row->productWModel;
               $data['titleAr'] =" ";
               
                  $data['status'] = $row->productWStatus;
            } else if ($data['categoryId'] == 6) {
              
               $data['image'] = $row->MNpost_main_img;
               $data['publishedOn'] = $row->productMNSubmitDate;
               $data['price'] = $row->productMNPrice;
               $data['titleEn']= $row->productOperator." ".$row->productMNNmbr;
             $data['titleAr'] = "";
                
               $data['status']  = $row->productMNStatus;
            } else if ($data['categoryId'] == 6) {
               
                $data['image']  = $row->BTpost_main_img;
             $data['publishedOn'] = $row->productBTSubmitDate;
                 $data['price'] = $row->productBTPrice;
               $data['titleEn'] = $row->productBtBrand." ".$row->productBtModel;
              $data['titleAr'] ="" ;
                
               $data['status']  = $row->productBTStatus;
            } else if ($data['categoryId']  == 8) {
              
               $data['image'] = $row->PHpost_main_img;
                 $data['publishedOn'] = $row->productPSubmitDate;
                $data['price'] = $row->productPHPrice;
                $data['titleEn'] = $row->productPBrand." ".$row->productPModel;
                $data['titleAr']= "";
                
                $data['status'] = $row->productPHStatus;
            } else if ($data['categoryId'] == 9) {
              
               $data['image'] = $row->PRpost_main_img;
                 $data['publishedOn'] = $row->productPRSubmitDate;
             $data['price'] = $row->productPRPrice;
                 $data['titleEn'] = $row->productPropType."".$row->productPropSC;
               $data['titleAr'] = "";
               
                $data['status'] = $row->productPRStatus;
            } else {
               
            $data['image']  = "";
            $data['publishedOn'] = "";
            $data['price']= "";
            $data['titleEn']  = "";
            $data['titleAr']= "";
            $data['status']  = "";
            }
            $data['SoldOn']=$row->orderDate;
           $data['traderId'] = $row->orderUserID;
           $data['traderNameEn'] = $row->orderUserName;
           $data['traderNameAr'] ="";
           $data['traderLocationEn'] = $row->orderUserLocation;
           $data['traderLocationAr'] = "";
           $data['traderImage'] = $row->orderUserImage;
            $row_post[] = $data;
            $data='';
            
        }
         return $row_post; 
       
   }  
         function mnrecent()
     {
        $mobile=$this->db->query('select category.productCategoryID as categoryId,category.category_name as titleEn,category.categoryProductCount as postCount,  productmn.MNpost_main_img as image from category right join productmn on category.productCategoryID=productmn.productCategoryID order by productmn.productMNSubmitDate DESC limit 1');
        return $mobile->result();  
     }
       function carrecent()
        {
           $car=$this->db->query('select category.productCategoryID as categoryId,category.category_name as titleEn,category.categoryProductCount as postCount, productcar.Cpost_main_img as image from  category right join productcar on category.productCategoryID=productcar.productCategoryID order by productcar.productCSubmitDate DESC limit 1');
        return $car->result();
        }
         function bikerecent()
        {
           $bike=$this->db->query('select category.productCategoryID as categoryId,category.category_name as titleEn,category.categoryProductCount as postCount,  productbike.Bpost_main_img as image from category right join productbike on category.productCategoryID=productbike.productCategoryID order by productbike.productBSubmitDate DESC limit 1 ');
         return $bike->result();
        }
        function nprecent()
        {
           $numberplate=$this->db->query('select category.productCategoryID as categoryId,category.category_name as titleEn,category.categoryProductCount as postCount,  productnp.NPpost_main_img as image from category right join productnp on category.productCategoryID=productnp.productCategoryID order by productnp.productNPSubmitDate DESC limit 1');
        return $numberplate->result();
        }
        
         function verturecent()
        {
           $vertu=$this->db->query('select category.productCategoryID as categoryId,category.category_name as titleEn,category.categoryProductCount as postCount,  productvertu.Vpost_main_img as image from category right join productvertu on category.productCategoryID=productvertu.productCategoryID order by productvertu.productVSubmitDate DESC limit 1');
        return $vertu->result();
        }
        function watchrecent()
        {
          $watch=$this->db->query('select category.productCategoryID as categoryId,category.category_name as titleEn,category.categoryProductCount as postCount,  productwatch.Wpost_main_img as image from category right join productwatch on category.productCategoryID=productwatch.productCategoryID order by productwatch.productWSubmitDate DESC limit 1');
        return $watch->result();   
        }
     function boatrecent()
     {
        $boat=$this->db->query('select category.productCategoryID as categoryId,category.category_name as titleEn,category.categoryProductCount as postCount,  productboat.BTpost_main_img as image from category right join productboat on category.productCategoryID=productboat.productCategoryID order by productboat.productBTSubmitDate DESC limit 1');
        return $boat->result();
     }
     function phonerecent()
     {
         $phone=$this->db->query('select category.productCategoryID as categoryId,category.category_name as titleEn,category.categoryProductCount as postCount,  productphone.PHpost_main_img as image from category right join productphone on category.productCategoryID=productphone.productCategoryID order by productphone.productPSubmitDate DESC limit 1');
        return $phone->result(); 
     }
     function propertyrecent()
     {
       $property=$this->db->query('select category.productCategoryID as categoryId,category.category_name as titleEn,category.categoryProductCount as postCount,  productproperty.PRpost_main_img as image from category right join productproperty on category.productCategoryID=productproperty.productCategoryID order by productproperty.productPRSubmitDate DESC limit 1');
        return $property->result();  
     }
    
  function get_countsold($userId)
    {
        $qry=$this->db->query('select count(*) as sold_count from order_items where traderID='.$userId.' and productStatus=3 ') ;
        return $qry->result();
    }  
    function get_buyer($userId)
 {
   $qry=$this->db->query('SELECT `order_items`.`orderUserID`,`order_items`.`orderUserType`,order_items.orderUserName,order_items.orderUserLocation,order_items.orderUserLocation,order_items.orderUserImage
        from order_items
        left JOIN `trader` ON `order_items`.`traderID`=`trader`.`traderID`
        left JOIN `productiv` ON `order_items`.`postID`=`productiv`.`postID`
        left JOIN `productcar` ON (`order_items`.`productCategoryID`=`productcar`.`productCategoryID` and order_items.productID=productcar.productID)
        left JOIN `productbike` ON( `order_items`.`productCategoryID`=`productbike`.`productCategoryID` and order_items.productID=productbike.productID)
        left JOIN `productboat` ON (`order_items`.`productCategoryID`=`productboat`.`productCategoryID` and  order_items.productID=productboat.productID)
        left JOIN `productmn` ON (`order_items`.`productCategoryID`=`productmn`.`productCategoryID` and order_items.productID=productmn.productID)
        left JOIN `productnp` ON( `order_items`.`productCategoryID`=`productnp`.`productCategoryID` and order_items.productID=productnp.productID)
        left JOIN `productphone` ON (`order_items`.`productCategoryID`=`productphone`.`productCategoryID`and order_items.productID=productphone.productID)
        left JOIN `productproperty` ON( `order_items`.`productCategoryID`=`productproperty`.`productCategoryID`and order_items.productID=productproperty.productID)
        left JOIN `productvertu` ON (`order_items`.`productCategoryID`=`productvertu`.`productCategoryID`and order_items.productID=productvertu.productID)
        left JOIN `productwatch` ON( `order_items`.`productCategoryID`=`productwatch`.`productCategoryID` and order_items.productID=productwatch.productID)
        WHERE order_items.productStatus=3 and order_items.traderID='.$userId.' ');
        return $qry->result();    
 }
       function get_post_booked($per_page_cnt,$limit,$userId)
   {
      $qry=$this->db->query('SELECT  `bookeditems`.`postID`,`bookeditems`.`productCategoryID`,bookeditems.productID,
           `productcar`.`productCBrand`, `productcar`.`productCModel`,`productcar`.`productCPrice`,productcar.Cpost_main_img,productcar.productCSubmitDate,productcar.cartCType,productcar.productCStatus,
           `productbike`.`productBBrand`,`productbike`.`productBModel`, `productbike`.`productBPrice`,productbike.Bpost_main_img,productbike.productBSubmitDate,productbike.cartBType,productbike.productBStatus,
           `productboat`.`productBtBrand`, `productboat`.`productBtModel`,`productboat`.`productBTPrice`,productboat.BTpost_main_img,productboat.productBTSubmitDate,productboat.cartBTType,productboat.productBTStatus, 
           `productwatch`.`productWBrand`, `productwatch`.`productWModel`, `productwatch`.`productWPrice`,productwatch.Wpost_main_img,productwatch.productWSubmitDate,productwatch.cartWType,productwatch.productWStatus,
           `productvertu`.`productVBrand`, `productvertu`.`productVModel`,  `productvertu`.`productVPrice`,productvertu.Vpost_main_img,productvertu.productVSubmitDate, productvertu.cartVType,productvertu.productVStatus,
           `productproperty`.`productPropSC`,   `productproperty`.`productPRPrice`,productproperty.PRpost_main_img,productproperty.productPRSubmitDate,productproperty.cartPRType,productproperty.productPRStatus,productproperty.productPropType, 
           `productphone`.`productPBrand`, `productphone`.`productPModel`, `productphone`.`productPHPrice`,productphone.PHpost_main_img,productphone.productPSubmitDate,productphone.productPHStatus,productphone.cartPHType,
           `productnp`.`productNPCode`, `productnp`.`productNPDigits`,  `productnp`.`productNPPrice`,productnp.NPpost_main_img,productnp.productNPSubmitDate,productnp.cartNPType,productnp.productNPStatus,productnp.productNPNmbr,
           `productmn`.`productMNPrefix`, `productmn`.`productMNNmbr`,  `productmn`.`productMNPrice`,productmn.MNpost_main_img,productmn.productMNSubmitDate,productmn.cartMNType,productmn.productMNStatus,productmn.productOperator,
           `bookeditems`.`bookedUserID`,`bookeditems`.`bookedUserType`,bookeditems.bookedUserName,bookeditems.bookedUserLocation,bookeditems.bookedUserLocation,bookeditems.bookedUserImage
        from bookeditems
        left JOIN `trader` ON `bookeditems`.`traderID`=`trader`.`traderID`
        left JOIN `productiv` ON `bookeditems`.`postID`=`productiv`.`postID`
        left JOIN `productcar` ON (`bookeditems`.`productCategoryID`=`productcar`.`productCategoryID` and bookeditems.productID=productcar.productID)
        left JOIN `productbike` ON( `bookeditems`.`productCategoryID`=`productbike`.`productCategoryID` and bookeditems.productID=productbike.productID)
        left JOIN `productboat` ON (`bookeditems`.`productCategoryID`=`productboat`.`productCategoryID` and  bookeditems.productID=productboat.productID)
        left JOIN `productmn` ON (`bookeditems`.`productCategoryID`=`productmn`.`productCategoryID` and bookeditems.productID=productmn.productID)
        left JOIN `productnp` ON( `bookeditems`.`productCategoryID`=`productnp`.`productCategoryID` and bookeditems.productID=productnp.productID)
        left JOIN `productphone` ON (`bookeditems`.`productCategoryID`=`productphone`.`productCategoryID`and bookeditems.productID=productphone.productID)
        left JOIN `productproperty` ON( `bookeditems`.`productCategoryID`=`productproperty`.`productCategoryID`and bookeditems.productID=productproperty.productID)
        left JOIN `productvertu` ON (`bookeditems`.`productCategoryID`=`productvertu`.`productCategoryID`and bookeditems.productID=productvertu.productID)
        left JOIN `productwatch` ON( `bookeditems`.`productCategoryID`=`productwatch`.`productCategoryID` and bookeditems.productID=productwatch.productID)
      WHERE `bookeditems`.`traderID` = '.$userId .' limit '.$per_page_cnt.' offset '.$limit);
         foreach ($qry->result() as $row) {
            $data['postId'] = $row->postID;
            $data['categoryId'] = $row->productCategoryID;
            $data['productId'] = $row->productID;
           
            
            if (  $data['categoryId'] == 1) {
                $data['image'] = $row->Cpost_main_img;
                $data['is_alshamilProduct'] = $row->cartCType;
                $data['publishedOn'] = $row->productCSubmitDate;
                $data['price'] = $row->productCPrice;
                $data['titleEn'] = $row->productCBrand." ".$row->productCModel;
                $data['titleAr'] ="" ;
               
                $data['status'] = $row->productCStatus;
            } else if ($data['categoryId'] == 2) {
               $data['is_alshamilProduct'] = $row->cartBType;
                $data['image'] = $row->Bpost_main_img;
              $data['publishedOn']  = $row->productBSubmitDate;
                $data['price']= $row->productBPrice;
               $data['titleEn']= $row->productBBrand." ".$row->productBModel;
               $data['titleAr'] = "";
                
               $data['status']= $row->productBStatus;
            } else if ($data['categoryId'] == 3) {
              $data['is_alshamilProduct'] = $row->cartNPType;
             $data['image'] = $row->NPpost_main_img;
             $data['publishedOn'] = $row->productNPSubmitDate;
                $data['price']= $row->productNPPrice;
               $data['titleEn'] = $row->productNPCode."".$row->productNPNmbr;
                 $data['titleAr']= "";
                
              $data['status'] = $row->productNPStatus;
            } else if ($data['categoryId'] == 4) {
               $data['is_alshamilProduct'] = $row->cartVType;
                $data['image']= $row->Vpost_main_img;
                $data['publishedOn']= $row->productVSubmitDate;
                 $data['price'] = $row->productVPrice;
              $data['titleEn'] = $row->productVBrand."".$row->productVModel;
               $data['titleAr'] = "";
               
                $data['status'] = $row->productVStatus;
            } else if ($data['categoryId'] == 5) {
                $data['is_alshamilProduct'] = $row->cartWType;
                $data['image'] = $row->Wpost_main_img;
                  $data['publishedOn'] = $row->productWSubmitDate;
                $data['price'] = $row->productWPrice;
                $data['titleEn'] = $row->productWBrand." ". $row->productWModel;
                $data['titleAr'] =" ";
               
              $data['status']= $row->productWStatus;
            } else if ($data['categoryId'] == 6) {
                $data['is_alshamilProduct'] = $row->cartMNType;
               $data['image']  = $row->MNpost_main_img;
                 $data['publishedOn']= $row->productMNSubmitDate;
              $data['price'] = $row->productMNPrice;
                $data['titleEn'] = $row->productOperator." ".$row->productMNNmbr;
                $data['titleAr']  = "";
                
                 $data['status'] = $row->productMNStatus;
            } else if ($data['categoryId'] == 7) {
                $data['is_alshamilProduct'] = $row->cartBTType;
                $data['image']  = $row->BTpost_main_img;
                $data['publishedOn'] = $row->productBTSubmitDate;
               $data['price'] = $row->productBTPrice;
                 $data['titleEn'] = $row->productBtBrand." ".$row->productBtModel;
               $data['titleAr'] ="" ;
                
               $data['status'] = $row->productBTStatus;
            } else if ($data['categoryId']== 8) {
                 $data['is_alshamilProduct'] = $row->cartPHType;
                $data['image'] = $row->PHpost_main_img;
               $data['publishedOn'] = $row->productPSubmitDate;
               $data['price']= $row->productPHPrice;
                $data['titleEn']= $row->productPBrand." ".$row->productPModel;
                $data['titleAr'] = "";
                
              $data['status']= $row->productPHStatus;
            } else if ($data['categoryId'] == 9) {
                 $data['is_alshamilProduct'] = $row->cartPRType;
               $data['image'] = $row->PRpost_main_img;
               $data['publishedOn'] = $row->productPRSubmitDate;
                $data['price'] = $row->productPRPrice;
               $data['titleEn'] = $row->productPropType."".$row->productPropSC;
               $data['titleAr'] = "";
               
              $data['status'] = $row->productPRStatus;
            } else {
               $data['is_alshamilProduct'] = "";
                $data['image'] = "";
               $data['publishedOn'] = "";
                $data['price'] = "";
                 $data['titleEn']= "";
               $data['titleAr'] = "";
                 $data['status'] = "";
            }
            
           $data['traderId'] = $row->bookedUserID;
           $data['traderNameEn'] = $row->bookedUserName;
           $data['traderNameAr'] = "";
           $data['traderLocationEn'] = $row->bookedUserLocation;
           $data['traderLocationAr'] ="";
           $data['traderImage'] = $row->bookedUserImage;
            $row_post[] = $data;
            $data='';
            
        }
         return $row_post; 
      
   }
   function get_bookeduser($userId)
 {
   $qry=$this->db->query('SELECT `bookeditems`.`bookedUserID`,`bookeditems`.`bookedUserType`,bookeditems.bookedUserName,bookeditems.bookedUserLocation,bookeditems.bookedUserLocation,bookeditems.bookedUserImage
        from bookeditems
        left JOIN `trader` ON `bookeditems`.`traderID`=`trader`.`traderID`
        left JOIN `productiv` ON `bookeditems`.`postID`=`productiv`.`postID`
        left JOIN `productcar` ON (`bookeditems`.`productCategoryID`=`productcar`.`productCategoryID` and bookeditems.productID=productcar.productID)
        left JOIN `productbike` ON( `bookeditems`.`productCategoryID`=`productbike`.`productCategoryID` and bookeditems.productID=productbike.productID)
        left JOIN `productboat` ON (`bookeditems`.`productCategoryID`=`productboat`.`productCategoryID` and  bookeditems.productID=productboat.productID)
        left JOIN `productmn` ON (`bookeditems`.`productCategoryID`=`productmn`.`productCategoryID` and bookeditems.productID=productmn.productID)
        left JOIN `productnp` ON( `bookeditems`.`productCategoryID`=`productnp`.`productCategoryID` and bookeditems.productID=productnp.productID)
        left JOIN `productphone` ON (`bookeditems`.`productCategoryID`=`productphone`.`productCategoryID`and bookeditems.productID=productphone.productID)
        left JOIN `productproperty` ON( `bookeditems`.`productCategoryID`=`productproperty`.`productCategoryID`and bookeditems.productID=productproperty.productID)
        left JOIN `productvertu` ON (`bookeditems`.`productCategoryID`=`productvertu`.`productCategoryID`and bookeditems.productID=productvertu.productID)
        left JOIN `productwatch` ON( `bookeditems`.`productCategoryID`=`productwatch`.`productCategoryID` and bookeditems.productID=productwatch.productID)
        WHERE  bookeditems.traderID='.$userId.' ');
        return $qry->result();    
 }
      function get_countbooked($userId)
    {
        $qry=$this->db->query('select count(*) as booked_count from bookeditems where traderID='.$userId.' ') ;
        return $qry->result();
    }
      function addtoflag($userId,$postId,$reason)
    {
        
        $data = array('traderID'=>$userId,'postID'=>$postId,'flagDesc'=>$reason,'flagStatus'=>'1');
        $this->db->insert('flaggeditems',$data);
    }
     function getplans()
   {
        $this->db->select('planID as PlanId,planName as PlanName,planAmount as PlanAmount,planDesc as PlanDescription');
        $this->db->from('subscriptionplan');
        $qry = $this->db->get();
        return $qry->result();
   }
   function getbank()
   {
        $this->db->select('bankName,bankAccountNo');
        $this->db->from('alshamilbank');
        $qry = $this->db->get();
        return $qry->result();
   }
   function getlocation()
   {
        $this->db->select('locationName as Office Name,locationAddress as Address,locationContactNo as phoneNumber');
        $this->db->from('alshamillocation');
        $qry = $this->db->get();
        return $qry->result();
   }
      
    function get_favourite_traderid($userId)
   {
      $qry=$this->db->query('SELECT  watchlist.postID, watchlist.productCategoryID,watchlist.productID,`productcar`.`productCBrand`, `productcar`.`productCModel`, `productcar`.`productCSubmitDate`, `productcar`.`productCPrice`,`productcar`.`Cpost_main_img`,productcar.cartCType,productcar.productCStatus,
          `productbike`.`productBBrand`, `productbike`.`productBModel`, `productbike`.`productBSubmitDate`, `productbike`.`productBPrice`, `productbike`.`Bpost_main_img`,productbike.cartBType,productbike.productBStatus,
          `productvertu`.`productVBrand`, `productvertu`.`productVModel`, `productvertu`.`productVSubmitDate`, `productvertu`.`productVPrice`, `productvertu`.`Vpost_main_img`,productvertu.cartVType,productvertu.productVStatus,
          `productboat`.`productBtBrand`, `productboat`.`productBtModel`, `productboat`.`productBTSubmitDate`, `productboat`.`productBTPrice`, `productboat`.`BTpost_main_img`,productboat.cartBTType,productboat.productBTStatus,
          `productwatch`.`productWBrand`, `productwatch`.`productWModel`, `productwatch`.`productWSubmitDate`, `productwatch`.`productWPrice`, `productwatch`.`Wpost_main_img`,productwatch.cartWType,productwatch.productWStatus,
          `productphone`.`productPBrand`, `productphone`.`productPModel`, `productphone`.`productPSubmitDate`, `productphone`.`productPHPrice`, `productphone`.`PHpost_main_img`,productphone.cartPHType,productphone.productPHStatus,
          `productproperty`.`productPropSC`,  `productproperty`.`productPRSubmitDate`, `productproperty`.`productPRPrice`, `productproperty`.`PRpost_main_img`,productproperty.cartPRType,productproperty.productPRstatus,productproperty.productPropType,
          `productnp`.`productNPCode`, `productnp`.`productNPDigits`, `productnp`.`productNPSubmitDate`, `productnp`.`productNPPrice`, `productnp`.`NPpost_main_img`,productnp.cartNPType,productnp.productNPStatus,productnp.productNPNmbr,
          `productmn`.`productMNPrefix`, `productmn`.`productMNNmbr`, `productmn`.`productMNSubmitDate`, `productmn`.`productMNPrice`, `productmn`.`MNpost_main_img`,productmn.cartMNType,productmn.productMNStatus,productmn.productOperator,
          `trader`.`traderID`, `trader`.`traderFullName`, `trader`.`traderLocation`, `trader`.`traderImage`

         from watchlist
         left JOIN `trader` ON `watchlist`.`traderID`=`trader`.`traderID`
       
        left JOIN `productcar` ON (`watchlist`.`productCategoryID`=`productcar`.`productCategoryID` AND `watchlist`.`productID`=`productcar`.`productID`)
        left JOIN `productbike` ON (`watchlist`.`productCategoryID`=`productbike`.`productCategoryID` AND `watchlist`.`productID`=`productbike`.`productID`)
        left JOIN `productboat` ON (`watchlist`.`productCategoryID`=`productboat`.`productCategoryID` AND `watchlist`.`productID`=`productboat`.`productID`)
        left JOIN `productmn` ON (`watchlist`.`productCategoryID`=`productmn`.`productCategoryID` AND `watchlist`.`productID`=`productmn`.`productID`) 
        left JOIN `productnp` ON (`watchlist`.`productCategoryID`=`productnp`.`productCategoryID` AND `watchlist`.`productID`=`productnp`.`productID`)
        left JOIN `productphone` ON (`watchlist`.`productCategoryID`=`productphone`.`productCategoryID` AND `watchlist`.`productID`=`productphone`.`productID`)
        left JOIN `productproperty` ON (`watchlist`.`productCategoryID`=`productproperty`.`productCategoryID` AND `watchlist`.`productID`=`productproperty`.`productID`) 
        left JOIN `productvertu` ON (`watchlist`.`productCategoryID`=`productvertu`.`productCategoryID` AND `watchlist`.`productID`=`productvertu`.`productID`)
        left JOIN `productwatch` ON (`watchlist`.`productCategoryID`=`productwatch`.`productCategoryID` AND `watchlist`.`productID`=`productwatch`.`productID`)
        WHERE `watchlist`.`traderID` = '.$userId);
     
      foreach ($qry->result() as $row) {
            $data['postId'] = $row->postID;
            $data['CategoryId'] = $row->productCategoryID;
            $data['ProductId'] = $row->productID;
           
//            
            if ($data['CategoryId'] == 1) {
                $data['thumbnailUrl'] = $row->Cpost_main_img;
                $data['is_alshamilProduct'] = $row->cartCType;
                $data['publishedOn'] = $row->productCSubmitDate;
                $data['price'] = $row->productCPrice;
                $data['tittleEn'] = $row->productCBrand." ".$row->productCModel;
                $data['tittleAr'] ="" ;
               
                $data['status'] = $row->productCStatus;
            } else if ($data['CategoryId'] == 2) {
                $data['is_alshamilProduct'] = $row->cartBType;
                  $data['thumbnailUrl'] = $row->Bpost_main_img;
                 $data['publishedOn'] = $row->productBSubmitDate;
               $data['price'] = $row->productBPrice;
               $data['tittleEn'] = $row->productBBrand." ". $row->productBModel;
                $data['tittleAr']="";
                $data['status'] = $row->productBStatus;
            } else if ($data['CategoryId'] == 3) {
                 $data['is_alshamilProduct']= $row->cartNPType;
               $data['thumbnailUrl'] = $row->NPpost_main_img;
                $data['publishedOn'] = $row->productNPSubmitDate;
                  $data['price'] = $row->productNPPrice;
                $data['tittleEn']= $row->productNPCode." ". $row->productNPNmbr;
                $data['tittleAr'] ="";
               $data['status'] = $row->productNPStatus;
            } else if ($data['CategoryId'] == 4) {
                $data['is_alshamilProduct']= $row->cartVType;
                $data['thumbnailUrl'] = $row->Vpost_main_img;
                $data['publishedOn'] = $row->productVSubmitDate;
                $data['price'] = $row->productVPrice;
                $data['tittleEn'] = $row->productVBrand." ". $row->productVModel;
                $data['tittleAr']="";
               
               $data['status'] = $row->productVStatus;
            } else if ($data['CategoryId'] == 5) {
               $data['is_alshamilProduct'] = $row->cartWType;
                  $data['thumbnailUrl'] = $row->Wpost_main_img;
               $data['publishedOn'] = $row->productWSubmitDate;
              $data['price']  = $row->productWPrice;
                $data['tittleEn'] = $row->productWBrand." ".$row->productWModel;
                $data['tittleAr']= "";
               
                 $data['status'] = $row->productWStatus;
            } else if ($data['CategoryId']== 6) {
              $data['is_alshamilProduct'] = $row->cartMNType;
               $data['thumbnailUrl'] = $row->MNpost_main_img;
                 $data['publishedOn'] = $row->productMNSubmitDate;
               $data['price']  = $row->productMNPrice;
               $data['tittleEn']= $row->productOperator." ".$row->productMNNmbr;
                $data['tittleAr'] = "";
                
                $data['status'] = $row->productMNStatus;
            } else if ($data['CategoryId'] == 7) {
               $data['is_alshamilProduct'] = $row->cartBTType;
             $data['thumbnailUrl']  = $row->BTpost_main_img;
                $data['publishedOn']  = $row->productBTSubmitDate;
                 $data['price']  = $row->productBTPrice;
                $data['tittleEn']= $row->productBtBrand." ".$row->productBtModel;
                 $data['tittleAr']  = "";
                
                $data['status'] = $row->productBTStatus;
            } else if ($data['CategoryId'] == 8) {
               $data['is_alshamilProduct'] = $row->cartPHType;
                $data['thumbnailUrl']  = $row->PHpost_main_img;
              $data['publishedOn'] = $row->productPSubmitDate;
                 $data['price']  = $row->productPHPrice;
               $data['tittleEn'] = $row->productPBrand." ". $row->productPModel;
               $data['tittleAr'] ="";
//                
                 $data['status']= $row->productPHStatus;
            } else if ($data['CategoryId'] == 9) {
               $data['is_alshamilProduct']  = $row->cartPRType;
               $data['thumbnailUrl']= $row->PRpost_main_img;
                $data['publishedOn'] = $row->productPRSubmitDate;
                $data['price'] = $row->productPRPrice;
              $data['tittleEn']= $row->productPropType." ". $row->productPropSC;
               $data['tittleAr'] ="";
//               
               $data['status'] = $row->productPRStatus;
            } else {
              $data['is_alshamilProduct'] = "";
                $data['thumbnailUrl'] = "";
                $data['publishedOn']  = "";
                $data['price'] = "";
               $data['tittleEn'] = "";
              
                   $data['tittleAr'] = "";
                     $data['status']="";
            }
            
//           
            $data['traderId'] = $row->traderID;
            $data['traderNameEn'] = $row->traderFullName;
            $data['traderNameAr'] = "";
            $data['traderLocationEn'] = $row->traderLocation;
            $data['traderLocationAr'] = "";
            $data['traderImage'] = $row->traderImage;

            $row_post[] = $data;
            $data='';
            
        }
         return $row_post;
      
   }
    function getprice($value)
 {
     
     
    $qry=$this->db->query('SELECT  
          `productcar`.`productCPrice` , `productbike`.`productBPrice` ,`productwatch`.`productWPrice`,`productvertu`.`productVPrice`, `productproperty`.`productPRPrice`, `productnp`.`productNPPrice`,
            `productmn`.`productMNPrice`,productboat.productBTPrice,productphone.productPHPrice
          
        from post
        left JOIN `productcar` ON (`post`.`productCategoryID`=`productcar`.`productCategoryID` and post.productID=productcar.productID)
        left JOIN `productbike` ON( `post`.`productCategoryID`=`productbike`.`productCategoryID` and post.productID=productbike.productID)
        left JOIN `productboat` ON (`post`.`productCategoryID`=`productboat`.`productCategoryID` and  post.productID=productboat.productID)
        left JOIN `productmn` ON (`post`.`productCategoryID`=`productmn`.`productCategoryID` and post.productID=productmn.productID)
        left JOIN `productnp` ON( `post`.`productCategoryID`=`productnp`.`productCategoryID` and post.productID=productnp.productID)
        left JOIN `productphone` ON (`post`.`productCategoryID`=`productphone`.`productCategoryID`and post.productID=productphone.productID)
        left JOIN `productproperty` ON( `post`.`productCategoryID`=`productproperty`.`productCategoryID`and post.productID=productproperty.productID)
        left JOIN `productvertu` ON (`post`.`productCategoryID`=`productvertu`.`productCategoryID`and post.productID=productvertu.productID)
        left JOIN `productwatch` ON( `post`.`productCategoryID`=`productwatch`.`productCategoryID` and post.productID=productwatch.productID)
        WHERE `post`.`postID` = '.$value);
     return $qry->result();   
 }
     function carbrand()
   {
      $c1=$this->db->query('select  distinct brandName from category_subtypes where productCategoryId=1');
      return $c1->result();
   }
   
   
   function carmodel($brand)
   {
     $c3=$this->db->query('select  distinct modelName from category_subtypes where productCategoryId=1 and brandName="'.$brand.'"');
      return $c3->result();
          
   }
   
   
   function bikebrand()
   
     {
      $c1=$this->db->query('select  distinct brandName from category_subtypes where productCategoryId=2');
      return $c1->result();
   }  
   
   
   function bikemodel($brand)
   {
    $c3=$this->db->query('select  distinct modelName from category_subtypes where productCategoryId=2 and brandName="'.$brand.'"');
    return $c3->result();
             
   }
  
  
    function boatbrands()
   {
     $bt1=$this->db->query('select  distinct brandName from category_subtypes where productCategoryId=7');  
     return $bt1->result();
   }
    function boatmodel($brand)
   {
     $bt1=$this->db->query('select  distinct modelName from category_subtypes where productCategoryId=7 and brandName="'.$brand.'"'); 
     return $bt1->result();
   }
    
   function vertubrands()
   {
      $v1=$this->db->query('select  distinct brandName from category_subtypes where productCategoryId=4');
      return $v1->result();
   }
    function vertumodel($brand)
   {
      $v1=$this->db->query('select  distinct modelName from category_subtypes where productCategoryId=4 and brandName="'.$brand.'"'); 
      return $v1->result();
   }
    
   
   function watchbrands()
   {
       $w1=$this->db->query('select  distinct brandName from category_subtypes where productCategoryId=5'); 
       return $w1->result();
   }
   
   function watchmodel($brand)
   {
       $w1=$this->db->query('select  distinct modelName from category_subtypes where productCategoryId=5 and brandName="'.$brand.'"'); 
       return $w1->result();
   }
   
   function phonebrands()
   {
         $ph1=$this->db->query('select  distinct brandName from category_subtypes where productCategoryId=8');
         return $ph1->result();
   }
   function phonemodel($brand)
   {
         $ph1=$this->db->query('select  distinct modelName from category_subtypes where productCategoryId=8 and brandName="'.$brand.'"'); 
         return $ph1->result();
   }
   
    function get_myprofile($userId)
 {
     $this->db->select('traderFullName as name,traderInfo as companyDescription,traderLocation as place,traderPasswd as password,traderContactNum as mobile,traderEmailID as email,traderImage as profileImage,traderIDProof as idImage1,traderIDProofsecond as idImage2,socialWeb as web,socialFb as facebook,socialInsta as instagram,socialSnap as snapchat,socialtwitter as twitter,deviceId as deviceId,usertype as userTypeId,traderValidTill as planValidity,traderPaymentHistory as TotalAmountGained,traderPostCount as TotalPost,traderBookedCount as Booked,traderSoldCount as Sold');
        $this->db->from('trader');
        $this->db->where('traderID', $userId);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        } 
 }
    function get_post_images($post_id)
   {
       $qry=$this->db->query('SELECT
           `productiv`.`productImage`from post
        left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
        left JOIN `productiv` ON `post`.`postID`=`productiv`.`postID`
        left JOIN `productcar` ON (`post`.`productCategoryID`=`productcar`.`productCategoryID` and post.productID=productcar.productID)
        left JOIN `productbike` ON( `post`.`productCategoryID`=`productbike`.`productCategoryID` and post.productID=productbike.productID)
        left JOIN `productboat` ON (`post`.`productCategoryID`=`productboat`.`productCategoryID` and  post.productID=productboat.productID)
        left JOIN `productmn` ON (`post`.`productCategoryID`=`productmn`.`productCategoryID` and post.productID=productmn.productID)
        left JOIN `productnp` ON( `post`.`productCategoryID`=`productnp`.`productCategoryID` and post.productID=productnp.productID)
        left JOIN `productphone` ON (`post`.`productCategoryID`=`productphone`.`productCategoryID`and post.productID=productphone.productID)
        left JOIN `productproperty` ON( `post`.`productCategoryID`=`productproperty`.`productCategoryID`and post.productID=productproperty.productID)
        left JOIN `productvertu` ON (`post`.`productCategoryID`=`productvertu`.`productCategoryID`and post.productID=productvertu.productID)
        left JOIN `productwatch` ON( `post`.`productCategoryID`=`productwatch`.`productCategoryID` and post.productID=productwatch.productID)
        WHERE `post`.`postID` = '.$post_id);
       return $qry->result(); 
      
   }
function traderpostcount($traderID)
   {
       $traderqry=$this->db->query('select traderPostCount from trader where traderID='.$traderID);
       return $traderqry->result();
       
   }
   function emailcheck($email)
 {
  $qry=$this->db->query("SELECT * FROM trader WHERE traderEmailID ='$email'");
  return $qry->result(); 
 } 
 function getnotifications($trader_id)
        {
         $qry=$this->db->query('SELECT  `flaggeditems`.`postID`,flaggeditems.productCategoryID,flaggeditems.productID,flaggeditems.flagDesc,flaggeditems.flagDate,
          concat(`productcar`.`productCBrand`, `productcar`.`productCModel`)as product_name1 ,`productcar`.`productCPrice`,productcar.productCStatus,productcar.Cpost_main_img,productcar.cartCType,productcar.productCSubmitDate,
          concat(`productbike`.`productBBrand`, `productbike`.`productBModel`) as product_name2, `productbike`.`productBSubmitDate`, `productbike`.`productBPrice`,productbike.productBStatus,productbike.Bpost_main_img,productbike.cartBType,
          concat(`productboat`.`productBtBrand`, `productboat`.`productBtModel`) as product_name3, `productboat`.`productBTSubmitDate`,`productboat`.`productBTPrice`,productboat.productBTStatus,productboat.BTpost_main_img, productboat.cartBTType,
          concat(`productwatch`.`productWBrand`, `productwatch`.`productWModel`)as product_name4 ,`productwatch`.`productWSubmitDate`, `productwatch`.`productWPrice`,productwatch.productWStatus,productwatch.Wpost_main_img,productwatch.cartWType,
          concat( `productvertu`.`productVBrand`, `productvertu`.`productVModel`)as product_name5, `productvertu`.`productVSubmitDate`, `productvertu`.`productVPrice`,productvertu.productVStatus,productvertu.Vpost_main_img, productvertu.cartVType,
          concat(`productproperty`.`productPropSC`,productproperty.productPropType) as product_name6,  `productproperty`.`productPRSubmitDate`, `productproperty`.`productPRPrice`,productproperty.productPRStatus,productproperty.PRpost_main_img,productproperty.cartPRType, 
          concat(`productphone`.`productPBrand`, `productphone`.`productPModel`) as product_name7 , `productphone`.`productPSubmitDate`, `productphone`.`productPHPrice`,productphone.productPHStatus,productphone.PHpost_main_img,productphone.cartPHType,
          concat( `productnp`.`productNPCode`,productnp.productNPNmbr) as product_name8, `productnp`.`productNPDigits`, `productnp`.`productNPSubmitDate`, `productnp`.`productNPPrice`,productnp.productNPStatus,productnp.NPpost_main_img,productnp.cartNPType,
          concat(`productmn`.`productMNPrefix`, `productmn`.`productMNNmbr`) as product_name9, `productmn`.`productMNSubmitDate`, `productmn`.`productMNPrice`,productmn.productMNStatus,productmn.MNpost_main_img,productmn.cartMNType,productmn.productOperator,
          trader.traderID,trader.traderFullName,trader.traderLocation,trader.traderImage
          from flaggeditems
          left JOIN `trader` ON `flaggeditems`.`traderID`=`trader`.`traderID`
      
         left JOIN `productcar` ON (`flaggeditems`.`productCategoryID`=`productcar`.`productCategoryID` and flaggeditems.productID=productcar.productID)
        left JOIN `productbike` ON( `flaggeditems`.`productCategoryID`=`productbike`.`productCategoryID` and flaggeditems.productID=productbike.productID)
        left JOIN `productboat` ON (`flaggeditems`.`productCategoryID`=`productboat`.`productCategoryID` and  flaggeditems.productID=productboat.productID)
        left JOIN `productmn` ON (`flaggeditems`.`productCategoryID`=`productmn`.`productCategoryID` and flaggeditems.productID=productmn.productID)
        left JOIN `productnp` ON( `flaggeditems`.`productCategoryID`=`productnp`.`productCategoryID` and flaggeditems.productID=productnp.productID)
        left JOIN `productphone` ON (`flaggeditems`.`productCategoryID`=`productphone`.`productCategoryID`and flaggeditems.productID=productphone.productID)
        left JOIN `productproperty` ON( `flaggeditems`.`productCategoryID`=`productproperty`.`productCategoryID`and flaggeditems.productID=productproperty.productID)
        left JOIN `productvertu` ON (`flaggeditems`.`productCategoryID`=`productvertu`.`productCategoryID`and flaggeditems.productID=productvertu.productID)
        left JOIN `productwatch` ON( `flaggeditems`.`productCategoryID`=`productwatch`.`productCategoryID` and flaggeditems.productID=productwatch.productID)
        WHERE `flaggeditems`.`traderID` = '.$trader_id);    
        return $qry->result();
}


function flaguser($trader_id) {
        $this->db->select('flagUserID');
        $this->db->from('flaggeditems');
        $this->db->where('traderID', $trader_id);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $result = $query->result();
            foreach ($result as $row) {
            return $row->flagUserID;
            }
        } else {
            return false;
        }
    }

function flaggeduser($flaguser)
{
    $qry=$this->db->query('Select traderFullName,traderImage from trader where traderID='.$flaguser.'');
    return $qry->result();
}

 function notification_cnt()
    {
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $this->db->where('traderID',$trader_id);
        $this->db->where('readStatus','0');
        $this->db->select('count(*) as total_entries');
        $notification = $this->db->get('flaggeditems');
        return $notification->result();
    }


    public function read_status($trader_id) {
        $this->db->set('readStatus', '1');
        $this->db->where('traderID', $trader_id);
        if ($this->db->update('flaggeditems')) {
            return true;
        } else {
            return false;
        }
    }  
function getResult($category, $brand, $model, $from, $to) {
        //car
        if ($category == 1) {
            $query = 'select traderID as tId, productID as id,productCategoryName as category, productCBrand as brand, productCmodel as model, productCPrice as price, Cpost_main_img as image from productcar where productCategoryID = "'.$category.'"';
            if($brand!=""){
               $query =$query. 'and productCBrand = "'.$brand.'"'; 
            }
            if($model!=""){
               $query =$query. 'and productCModel = "'.$model.'"'; 
            }
            if($from!="" || $to!=""){
                 if($from==""){
                     $from = '1990';
                 }
                  if($to==""){
                     $to = date('Y');
                 }
               $query = $query. 'and productCReleaseYear BETWEEN '.$from.' AND '.$to.''; 
            }
         
            $qry = $this->db->query($query);
            return $qry->result();
        }
        //Bike
        if ($category == 2) {
            $query = 'select  traderID as tId, productID as id,productCategoryName as category, productBBrand as brand, productBmodel as model, '
                    . 'productBPrice as price, Bpost_main_img as image from productbike where '
                    . 'productCategoryID = "'.$category.'"';
            if($brand!=""){
               $query =$query. 'and productBBrand = "'.$brand.'"'; 
            }
            if($model!=""){
               $query =$query. 'and productBModel = "'.$model.'"'; 
            }
            if($from!="" || $to!=""){
                 if($from==""){
                     $from = '1990';
                 }
                  if($to==""){
                     $to = date('Y');
                 }
               $query = $query. 'and productBReleaseYear BETWEEN '.$from.' AND '.$to.''; 
            }
//         echo $query;exit();
            $qry = $this->db->query($query);
            return $qry->result();
        }
        //Number Plate
        if ($category == 3) {
            $query = 'select traderID as tId, productID as id, productBBrand as brand, productBmodel as model, '
                    . 'productBPrice as price, Bpost_main_img as image from productbike where '
                    . 'productCategoryID = "'.$category.'"';
            if($brand!=""){
               $query =$query. 'and productBBrand = "'.$brand.'"'; 
            }
            if($model!=""){
               $query =$query. 'and productBModel = "'.$model.'"'; 
            }
            if($from!="" || $to!=""){
                 if($from==""){
                     $from = '1990';
                 }
                  if($to==""){
                     $to = date('Y');
                 }
               $query = $query. 'and productBReleaseYear BETWEEN '.$from.' AND '.$to.''; 
            }
         
            
            $qry = $this->db->query($query);
            return $qry->result();
        }
        //Vertu
         if ($category == 4) {
            $query = 'select traderID as tId, productID as id, productVBrand as brand, productVmodel as model, '
                    . 'productVPrice as price, Vpost_main_img as image from productvertu where '
                    . 'productCategoryID = "'.$category.'"';
            if($brand!=""){
               $query =$query. 'and productVBrand = "'.$brand.'"'; 
            }
            if($model!=""){
               $query =$query. 'and productVModel = "'.$model.'"'; 
            }
            
         
            
            $qry = $this->db->query($query);
            return $qry->result();
        }
            //Watch
         if ($category == 5) {
            $query = 'select productID as id, productWBrand as brand, productWmodel as model, '
                    . 'productWPrice as price, Wpost_main_img as image from productwatch where '
                    . 'productCategoryID = "'.$category.'"';
            if($brand!=""){
               $query =$query. 'and productWBrand = "'.$brand.'"'; 
            }
            if($model!=""){
               $query =$query. 'and productWModel = "'.$model.'"'; 
            }
            if($from!="" || $to!=""){
                 if($from==""){
                     $from = '1990';
                 }
                  if($to==""){
                     $to = date('Y');
                 }
               $query = $query. 'and productBReleaseYear BETWEEN '.$from.' AND '.$to.''; 
            }
      
            $qry = $this->db->query($query);
            return $qry->result();
        }
         //Mobile Number
         if ($category == 6) {
            $query = 'select traderID as tId, productID as id, productMNPrefix as brand, productMNNmbr as model, '
                    . 'productMNPrice as price, MNpost_main_img as image from productmn where '
                    . 'productCategoryID = "'.$category.'"';
            if($brand!=""){
               $query =$query. 'and productMNPrefix = "'.$brand.'"'; 
            }
            if($model!=""){
               $query =$query. 'and productMNNmbr = "'.$model.'"'; 
            }
            if($from!="" || $to!=""){
                 if($from==""){
                     $from = '1990';
                 }
                  if($to==""){
                     $to = date('Y');
                 }
               $query = $query. 'and productBReleaseYear BETWEEN '.$from.' AND '.$to.''; 
            }
      
            $qry = $this->db->query($query);
            return $qry->result();
        }
         //Boat
         if ($category == 7) {
             $query = 'select productID as id, productBtBrand as brand, productBtModel as model, '
                    . 'productBTPrice as price, BTpost_main_img as image from productboat where '
                    . 'productCategoryID = "'.$category.'"';
            if($brand!=""){
               $query =$query. 'and productBtBrand = "'.$brand.'"'; 
            }
            if($model!=""){
               $query =$query. 'and productBtModel = "'.$model.'"'; 
            }
            if($from!="" || $to!=""){
                 if($from==""){
                     $from = '1990';
                 }
                  if($to==""){
                     $to = date('Y');
                 }
               $query = $query. 'and productBReleaseYear BETWEEN '.$from.' AND '.$to.''; 
            }
      
            $qry = $this->db->query($query);
            return $qry->result();
        }
        //Phone
         if ($category == 8) {
             $query = 'select productID as id, productPBrand as brand, productPModel as model, '
                    . 'productPHPrice as price, PHpost_main_img as image from productphone where '
                    . 'productCategoryID = "'.$category.'"';
            if($brand!=""){
               $query =$query. 'and productPBrand = "'.$brand.'"'; 
            }
            if($model!=""){
               $query =$query. 'and productPModel = "'.$model.'"'; 
            }
            if($from!="" || $to!=""){
                 if($from==""){
                     $from = '1990';
                 }
                  if($to==""){
                     $to = date('Y');
                 }
               $query = $query. 'and productBReleaseYear BETWEEN '.$from.' AND '.$to.''; 
            }
      
            $qry = $this->db->query($query);
            return $qry->result();
        }
        //Property
         if ($category == 9) {
             $query = 'select productID as id, productPropSC as brand, productPropType as model, '
                    . 'productPRPrice as price, PRpost_main_img as image from productproperty where '
                    . 'productCategoryID = "'.$category.'"';
            if($brand!=""){
               $query =$query. 'and productPropSC = "'.$brand.'"'; 
            }
            if($model!=""){
               $query =$query. 'and productPropType = "'.$model.'"'; 
            }
            if($from!="" || $to!=""){
                 if($from==""){
                     $from = '1990';
                 }
                  if($to==""){
                     $to = date('Y');
                 }
               $query = $query. 'and productBReleaseYear BETWEEN '.$from.' AND '.$to.''; 
            }
      
            $qry = $this->db->query($query);
            return $qry->result();
        }
    }
function checkpostId($post_id)
 {
  $qry=$this->db->query("SELECT * FROM post WHERE postID ='$post_id'");
  return $qry->result(); 
 }
function checktrader($trader_id)
   {
     $qry=$this->db->query("SELECT * FROM post WHERE traderID ='$trader_id'");
    return $qry->result();  
   }
 function checkfavourite($userId)
   {
     $qry=$this->db->query("SELECT * FROM watchlist WHERE traderID ='$userId'");
    return $qry->result();  
   }
 function checkcart($userId)
   {
     $qry=$this->db->query("SELECT * FROM cartlist WHERE traderID ='$userId'");
    return $qry->result();  
   }
 function checknotification($userId)
   {
     $qry=$this->db->query("SELECT * FROM tradernotifications WHERE traderID ='$userId'");
    return $qry->result();   
   }
   function checkapproved($userId)
 {
  $qry=$this->db->query("SELECT * FROM post WHERE traderID ='$userId' and postStatus='1'" );
  return $qry->result(); 
 }
 function checkrejected($userId)
 {
  $qry=$this->db->query("SELECT * FROM post WHERE traderID ='$userId' and postStatus='0'" );
  return $qry->result(); 
 }
   function checkpending($userId)
 {
  $qry=$this->db->query("SELECT * FROM post WHERE traderID ='$userId' and postStatus='-1'" );
  return $qry->result(); 
 }
  function checksold($userId)
 {
  $qry=$this->db->query("SELECT * FROM order_items WHERE traderID ='$userId' and productStatus='3'" );
  return $qry->result(); 
 }
   function checkbooked($userId)
 {
  $qry=$this->db->query("SELECT * FROM bookeditems WHERE traderID ='$userId' " );
  return $qry->result(); 
 }
 function checkout($value)
 {
  $qry=$this->db->query("SELECT * FROM post WHERE postID ='$value' " );
  return $qry->result();   
 }
 function check_trader($userId)
 {
  $qry=$this->db->query("SELECT * FROM trader WHERE traderID ='$userId' " );
  return $qry->result();   
 }
function check_traderbyid($traderId)
 {
      $qry=$this->db->query("SELECT * FROM trader WHERE traderID ='$traderId' " );
  return $qry->result();
 }
}

