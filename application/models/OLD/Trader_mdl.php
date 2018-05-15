<?php

class Trader_mdl extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->lang = $this->session->userdata("lang");
        $this->load->Model('Data_mdl');
        $lang = "en";
    }

    public function get_countries_code() {
        $qry = $this->db->get('countries');
        return $qry->result();
    }
    public function formataed($input,$CallPrice=NULL) {
        $val = "";
        if ($input > 0) {
            //CUSTOM FUNCTION TO GENERATE ##,##,###.##
            $dec = "";
            $pos = strpos($input, ".");
            if ($pos === false) {
                //no decimals   
            } else {
                //decimals
                $dec = substr(round(substr($input, $pos), 2), 1);
                $input = substr($input, 0, $pos);
            }
            $num = substr($input, -3); //get the last 3 digits
            $input = substr($input, 0, -3); //omit the last 3 digits already stored in $num
            while (strlen($input) > 0) { //loop the process - further get digits 2 by 2
                $num = substr($input, -2) . "," . $num;
                $input = substr($input, 0, -2);
            }
            $val = 'AED ' . $num . $dec;
        } elseif($CallPrice==1) {
            $val = 'Call for Price';
        }else{
            $val = 'AED ' . $input;
        }
        echo ($val);
    }
    public function save_trader_reg() {
        $curr_date = date('Y-m-d');
        $newdob = date("Y-m-d", strtotime($this->input->post('txtdob')));
        $newexpdate = date("Y-m-d", strtotime($this->input->post('txtemexpdate')));
        $newpassexpdate = date("Y-m-d", strtotime($this->input->post('txtpass_exdate')));
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
            'pass_exp_date' => $newpassexpdate
        );
        $this->db->insert('trader_register', $data);
    }

    /*
     * pagination
     */

    public function record_count() {
        return $this->db->count_all("trader");
    }

    public function fetch_post_data($limit, $id) {
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

    function get_prod_trader($product_id) {
        $this->db->select('trader.traderFullName,trader.traderLocation,trader.traderLocation');
        $this->db->from('trader');
        $this->db->join('product', 'product.traderID=trader.traderID');
        $this->db->where('product.productID', $product_id);

        $qry = $this->db->get();
       
        return $qry->result();
    }
    function get_user_details($traderID) {
      
        $this->db->select('*');
        $this->db->from('vwTrader');
        $this->db->where('traderID', $traderID);
    
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    // function get_trader($txtemail, $txtpassword, $txtusertype) {
    //     $md_password = md5($txtpassword);
    //     $this->db->select('*');
    //     $this->db->from('trader');
    //     $this->db->where('traderEmailID', $txtemail);
    //     $this->db->where('traderPasswd', $md_password);
    //     $this->db->where('userType', $txtusertype);
    //     $this->db->limit(1);
    //     $query = $this->db->get();
    //     if ($query->num_rows() == 1) {
    //         return $query->result();
    //     } else {
    //         return false;
    //     }
    // }
    function get_trader($txtemail, $txtpassword, $txtusertype) {
        $md_password = md5($txtpassword);
        $this->db->select('*');
        $this->db->from('vwTrader');
        if($txtusertype==0)$this->db->where('traderEmailID', $txtemail);
        else $this->db->where('traderUserName', $txtemail);
        $this->db->where('traderPasswd', $md_password);
        $this->db->where('userType', $txtusertype);
      //  $this->db->where('isActive', 1);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    function get_post_byid($post_id) {
        $qry = $this->db->query('SELECT DISTINCT `post`.`traderID`,`post`.`postID`,post.productCategoryID,post.productID,productiv.productViewCount ,
        `productcar`.`productCBrand`,`productcar`.`cartCType`  ,DATE_FORMAT(productcar.productCSubmitDate,"%d %b %Y") as publishedCOn ,`productcar`.`productCCallPrice`, `productcar`.`productCModel`,productcar.productCReleaseYear, `productcar`.`productCPrice`,productcar.productCStatus,productcar.productCDesc,productcar.Cpost_main_img,
        `productbike`.`productBBrand`,`productbike`.`cartBType` ,`productbike`.`productBCallPrice`, `productbike`.`productBModel`, DATE_FORMAT(productbike.productBSubmitDate,"%d %b %Y") as publishedBOn,productbike.productBReleaseYear as Bikeyear, `productbike`.`productBPrice`,productbike.productBStatus,productbike.Bpost_main_img,productbike.productBDesc as bike,
        `productboat`.`productBtBrand`,`productboat`.`cartBTType` ,DATE_FORMAT(productboat.productBTSubmitDate,"%d %b %Y") as publishedBtOn,`productboat`.`productBtCallPrice`, `productboat`.`productBtModel`, `productboat`.`productBTSubmitDate`,productboat.productBReleaseYear, `productboat`.`productBTPrice`,productboat.productBTStatus,productboat.productBDesc,productboat.BTpost_main_img, 
        `productwatch`.`productWBrand`,`productwatch`.`cartWType` ,DATE_FORMAT(productwatch.productWSubmitDate,"%d %b %Y") as publishedWOn,`productwatch`.`productWCallPrice`, `productwatch`.`productWModel`, `productwatch`.`productWSubmitDate`, `productwatch`.`productWPrice`,productwatch.productWStatus,productwatch.productWDesc,productwatch.Wpost_main_img,
        `productvertu`.`productVBrand`,`productvertu`.`cartVType` ,DATE_FORMAT(productvertu.productVSubmitDate,"%d %b %Y") as publishedVOn,`productvertu`.`productVCallPrice`, `productvertu`.`productVModel`, `productvertu`.`productVSubmitDate`, `productvertu`.`productVPrice`,productvertu.productVStatus,productvertu.productVDesc,productvertu.Vpost_main_img, 
        `productproperty`.`productPropSC`,`productproperty`.`cartPRType` ,DATE_FORMAT(productproperty.productPRSubmitDate,"%d %b %Y") as publishedPROn ,`productproperty`.`productPropCallPrice`,`productproperty`.`productPropType`,  `productproperty`.`productPRSubmitDate`, `productproperty`.`productPRPrice`,productproperty.productPRStatus,productproperty.productDesc,productproperty.PRpost_main_img, 
        `productphone`.`productPBrand`,`productphone`.`cartPHType` ,DATE_FORMAT(productphone.productPSubmitDate,"%d %b %Y") as publishedPOn,`productphone`.`productPhCallPrice`, `productphone`.`productPModel`, `productphone`.`productPSubmitDate`, `productphone`.`productPHPrice`,productphone.productPHStatus,productphone.productPDesc,productphone.PHpost_main_img,
        `productnp`.`productNPCode`,`productnp`.`type`,`productnp`.`cartNPType` ,DATE_FORMAT(productnp.productNPSubmitDate,"%d %b %Y") as publishedNPOn,`productnp`.`productNPCallPrice`, `productnp`.`productNPDigits`, `productnp`.`productNPSubmitDate`, `productnp`.`productNPPrice`,productnp.productNPStatus,productnp.productNPDesc,productnp.NPpost_main_img,productnp.productNPNmbr,productnp.productNPEmrites,
        `productmn`.`productMNPrefix`,`productmn`.`cartMNType` ,DATE_FORMAT(productmn.productMNSubmitDate,"%d %b %Y") as publishedMNOn,`productmn`.`productMNCallPrice`, `productmn`.`productMNNmbr`, `productmn`.`productMNSubmitDate`, `productmn`.`productMNPrice`,productmn.productMNStatus,productmn.productMNDesc,productmn.MNpost_main_img,productmn.productOperator
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
        
        WHERE `post`.`postID` = ' . $post_id);
       foreach ($qry->result() as $row) {
        $data['postId'] = $row->postID;
        $data['categoryId'] = $row->productCategoryID;
        $data['ProductId'] = $row->productID;
        $data['views'] = $row->productViewCount;

       
        if ($data['categoryId'] == 1) {
            $data['image'] = $row->Cpost_main_img;
            $data['price'] = $row->productCPrice;
            $data['titleEn'] = $row->productCBrand . " " . $row->productCModel;
            $data['titleAr'] = "";
            $data['brandNameEn'] = $row->productCBrand;
            $data['brandNameAr'] = "";
            $data['modelNameEn'] = $row->productCModel;
            $data['modelNameAr'] = "";
            $data['year'] = $row->productCReleaseYear;
            $data['descriptionEn'] = $row->productCDesc;
            $data['descriptionAr'] = "";
            $data['status'] = $row->productCStatus;
            $data['callForPrice'] = $row->productCCallPrice;
            $data['publishedOn'] = $row->publishedCOn;
            $data['IsAlshamilProduct'] = $row->cartCType;
        } else if ($data['categoryId'] == 2) {

            $data['image'] = $row->Bpost_main_img;
            $data['year'] = $row->Bikeyear;
            $data['price'] = $row->productBPrice;
            $data['titleEn'] = $row->productBBrand . " " . $row->productBModel;
            $data['titleAr'] = "";
            $data['brandNameEn'] = $row->productBBrand;
            $data['brandNameAr'] = "";
            $data['modelNameEn'] = $row->productBModel;
            $data['modelNameAr'] = "";
            $data['descriptionEn'] = $row->bike;
            $data['descriptionAr'] = "";
            $data['status'] = $row->productBStatus;
            $data['callForPrice'] = $row->productBCallPrice;
            $data['publishedOn'] = $row->publishedBOn;
            $data['IsAlshamilProduct'] = $row->cartBType;
        } else if ($data['categoryId'] == 3) {
            $data['image'] = $row->NPpost_main_img;
            $data['price'] = $row->productNPPrice;
            $data['titleEn'] = $row->productNPCode . " " . $row->productNPNmbr;
            $data['titleAr'] = "";
            $data['brandNameEn'] = $row->productNPEmrites;
            $data['brandNameAr'] = "";
            $data['modelNameEn'] = $row->productNPCode;
            $data['modelNameAr'] = "";
            $data['number'] = $row->productNPNmbr;
            $data['digits'] = $row->productNPDigits;
            $data['descriptionEn'] = $row->productNPDesc;
            $data['descriptionAr'] = "";
            $data['status'] = $row->productNPStatus;
            $data['callForPrice'] = $row->productNPCallPrice;
            $data['publishedOn'] = $row->publishedNPOn;
            $data['year'] = "";
            $data['type'] = $row->type;
            $data['IsAlshamilProduct'] = $row->cartNPType;
        } else if ($data['categoryId'] == 4) {

            $data['image'] = $row->Vpost_main_img;
            $data['price'] = $row->productVPrice;
            $data['titleEn'] = $row->productVBrand . " " . $row->productVModel;
            $data['titleAr'] = "";
            $data['brandNameEn'] = $row->productVBrand;
            $data['brandNameAr'] = "";
            $data['modelNameEn'] = $row->productVModel;
            $data['modelNameAr'] = "";
            $data['descriptionEn'] = $row->productVDesc;
            $data['descriptionAr'] = "";
            $data['status'] = $row->productVStatus;
            $data['callForPrice'] = $row->productVCallPrice;
            $data['publishedOn'] = $row->publishedVOn;
            $data['year'] = "";
            $data['IsAlshamilProduct'] = $row->cartVType;
         
        } else if ($data['categoryId'] == 5) {

            $data['image'] = $row->Wpost_main_img;
            $data['price'] = $row->productWPrice;
            $data['titleEn'] = $row->productWBrand . " " . $row->productWModel;
            $data['titleAr'] = "";
            $data['brandNameEn'] = $row->productWBrand;
            $data['brandNameAr'] = "";
            $data['modelNameEn'] = $row->productWModel;
            $data['modelNameAr'] = "";
            $data['descriptionEn'] = $row->productWDesc;
            $data['descriptionAr'] = "";
            $data['status'] = $row->productWStatus;
            $data['callForPrice'] = $row->productWCallPrice;
            $data['publishedOn'] = $row->publishedWOn;
            $data['year'] = "";
            $data['IsAlshamilProduct'] = $row->cartWType;
        } else if ($data['categoryId'] == 6) {

            $data['image'] = $row->MNpost_main_img;
            $data['price'] = $row->productMNPrice;
            $data['titleEn'] = $row->productOperator . " " . $row->productMNNmbr;
            $data['titleAr'] = "";
            $data['brandNameEn'] = $row->productOperator;
            $data['brandNameAr'] = "";
            $data['modelNameEn'] = $row->productMNPrefix;
            $data['modelNameAr'] = "";
            $data['number'] = $row->productMNNmbr;
            $data['digits'] = $row->productMNDigits;
            $data['descriptionEn'] = $row->productMNDesc;
            $data['descriptionAr'] = "";
            $data['status'] = $row->productMNStatus;
            $data['callForPrice'] = $row->productMNCallPrice;
            $data['publishedOn'] = $row->publishedMNOn;
            $data['year'] = "";
            $data['IsAlshamilProduct'] = $row->cartMNType;
        
           
        } else if ($data['categoryId'] == 7) {

            $data['image'] = $row->BTpost_main_img;

            $data['price'] = $row->productBTPrice;
            $data['titleEn'] = $row->productBtBrand . " " . $row->productBtModel;
            $data['titleAr'] = "";
            $data['brandNameEn'] = $row->productBtBrand;
            $data['brandNameAr'] = "";
            $data['modelNameEn'] = $row->productBtModel;
            $data['modelNameAr'] = "";
            $data['descriptionEn'] = $row->productBDesc;
            $data['descriptionAr'] = "";
            $data['status'] = $row->productBTStatus;
            $data['callForPrice'] = $row->productBtCallPrice;
            $data['publishedOn'] = $row->publishedBtOn;
            $data['year'] = "";
            $data['IsAlshamilProduct'] = $row->cartBTType;
            
         
        } else if ($data['categoryId'] == 8) {

            $data['image'] = $row->PHpost_main_img;
        //                $data['publishedOn'] = $row->productPSubmitDate;
            $data['price'] = $row->productPHPrice;
            $data['titleEn'] = $row->productPBrand . " " . $row->productPModel;
            $data['titleAr'] = "";
            $data['brandNameEn'] = $row->productPBrand;
            $data['brandNameAr'] = "";
            $data['modelNameEn'] = $row->productPModel;
            $data['modelNameAr'] = "";
            $data['descriptionEn'] = $row->productPDesc;
            $data['descriptionAr'] = "";
            $data['status'] = $row->productPHStatus;
            $data['callForPrice'] = $row->productPhCallPrice;
            $data['publishedOn'] = $row->publishedPOn;
            $data['year'] = "";

            $data['IsAlshamilProduct'] = $row->cartPHType;
        } else if ($data['categoryId'] == 9) {

            $data['image'] = $row->PRpost_main_img;
            $data['price'] = $row->productPRPrice;
            $data['titleEn'] = $row->productPropType . " " . $row->productPropSC;
            $data['titleAr'] = "";
            $data['brandNameEn'] = $row->productPropSC;
            $data['brandNameAr'] = "";
            $data['modelNameEn'] = $row->productPropType;
            $data['modelNameAr'] = "";
            $data['descriptionEn'] = $row->productDesc;
            $data['descriptionAr'] = "";
            $data['status'] = $row->productPRStatus;
            $data['callForPrice'] = $row->productPropCallPrice;
            $data['publishedOn'] = $row->publishedPROn;
            $data['year'] = "";

            $data['IsAlshamilProduct'] = $row->cartPRType;
        } else {

            $data['image'] = "";
            $data['price'] = "";
            $data['titleEn'] = "";
            $data['titleAr'] = "";
            $data['descriptionEn'] = "";
            $data['descriptionAr'] = "";
            $data['status'] = "";
            $data['brandNameEn'] = "";
            $data['brandNameAr'] = "";
            $data['modelNameEn'] = "";
            $data['modelNameAr'] = "";
            $data['year'] = "";
        }



        $row_post[] = $data;
        $data = '';
        }
        return $row_post;
    }

    function get_post_traderinfo($post_id) {
        $qry = $this->db->query('SELECT  DISTINCT `post`.`postStatus`,`vwTrader`.`traderUserName`,
           `vwTrader`.`traderID` as traderId, `vwTrader`.`traderFullName` as traderNameEn, `vwTrader`.`traderImage`, `vwTrader`.`traderLocation` as traderLocationEn, `vwTrader`.`traderContactNum` as mobile,`vwTrader`.`traderEmailID` as email,`vwTrader`.`tplanID` as planid,
           CASE 
            WHEN `vwTrader`.`tplanID`= "1" or `vwTrader`.`tplanID` = "2" 
               THEN 1 
               ELSE 0 
        END as plan_type
        from post
        left JOIN `vwTrader` ON `post`.`traderID`=`vwTrader`.`traderID`
         WHERE `post`.`postID` = ' . $post_id);
       /*         $qry = $this->db->query('SELECT  DISTINCT `post`.`postStatus`,
                `vwTrader`.`traderID` as traderId, `vwTrader`.`traderFullName` as traderNameEn, `vwTrader`.`traderImage`, `vwTrader`.`traderLocation` as traderLocationEn, `vwTrader`.`traderContactNum` as mobile,`vwTrader`.`traderEmailID` as email
             from post
             left JOIN `vwTrader` ON `post`.`traderID`=`vwTrader`.`traderID`
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
             WHERE `post`.`postID` = ' . $post_id);*/
        return $qry->result();
    }
    function get_post_traderinfo2($post_id) {
        $qry = $this->db->query('SELECT  DISTINCT
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
        WHERE `post`.`postID` = ' . $post_id);
        return $qry->result();
    }
    function get_post_medialist($post_id) {
        $qry = $this->db->query('SELECT DISTINCT
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
        WHERE `post`.`postID` = ' . $post_id.' AND `productiv`.`productVideo`!="http://alshamil.bluecast.ae/uploads/videos/" AND `productiv`.`productVideo`!=""' );
        
        
        foreach( $qry->result() as $data){
          
            // if (file_exists($data->productVideo)||pathinfo($data->productVideo, PATHINFO_EXTENSION)) {
            //     $result[] = $dataductVideo;
                
            //     }
                $link_array = explode('/',$data->productVideo);
                $file = end($link_array);
                $file_det = pathinfo($file);
               // $title = $this->Trader_mdl->getTitle($result->productID, $result->productCategoryID);
                // if ($result->thumbImage == '') {
                //     $poster = $this->Trader_mdl->getImage($result->productID, $result->productCategoryID);
                // } else {
                //     $poster = $result->thumbImage;
                // }
                if(isset($file_det['extension'])){
                    $result[] = $data;
                }
          
            
         }
        return isset($result)?$result[0]:NULL;
        
    }

    function all_traders($userId, $per_page_cnt, $limit,$name) {
        $this->db->select('traderID as traderId,traderFullName as nameEn,traderLocation as locationEn,traderImage as image,traderInfo as detailsEn,traderContactNum as mobile,traderEmailID as email,socialWeb as website,socialFb as facebook,socialInsta as instagram,socialSnap as snapchat,socialtwitter as twitter');
        $this->db->from('vwTrader');
         if(!empty($name)){
            $this->db->like('traderFullName', $name, 'none'); 
            }
        
        $this->db->where(array('traderID!= '=>$userId,'usertype !='=> 0,'isActive'=> 1));
        $this->db->order_by('traderFullName ASC');
        $this->db->limit($per_page_cnt, $limit);
        $qry = $this->db->get();
       // echo $this->db->last_query();
        return $qry->result();
    }

    function count_traders($status=NULL,$userId=NULL,$usertype=NULL) {
        $this->db->select('count(*) as total_entries');
        if(isset($status))$this->db->where(array('traderID!= '=>$userId,'usertype !='=> $usertype,'isActive'=>$status));
        
        $this->db->from('vwTrader');
     
        $qry = $this->db->get();
     
        return $qry->result();
    }
    function count_cat($catid,$traderid) {
        $this->db->select('count(*) as total_entries');
        if(isset($catid))
        $this->db->where(array('CategoryID'=>$catid,'PostAdminStatus'=>1));
        elseif((isset($traderid)))
        $this->db->where(array('TraderID'=>$traderid,'PostAdminStatus'=>1));
        else
        $this->db->where(array('PostAdminStatus'=>1));

        $this->db->from('vwProductPost');
    
        $qry = $this->db->get();
     
        return $qry->result()[0];
    }

    function get_trader_bytraderId($traderId) {
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

    function get_catid($cat) {

        $qry = $this->db->query('select productCategoryID from category where category_name=' . $cat);
        return $qry->result();
        /* echo '<pre>';print_r($d);exit(); */
    }

    function get_brandname($txtcat, $txtbrand) {
        $brqry = $this->db->query('SELECT distinct brandName FROM category_subtypes WHERE productCategoryID = ' . $txtcat . ' AND brandID = ' . $txtbrand);

        return $brqry->result();
    }

    function get_modelname($txtcat, $txtbrand, $txtmodel) {
        $mdqry = $this->db->query('SELECT  modelName FROM category_subtypes WHERE productCategoryID = ' . $txtcat . ' AND brandID = ' . $txtbrand . ' AND modelID = ' . $txtmodel);

        return $mdqry->result();
    }

    /* function all_traders($limit,$per_page_cnt)
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
      } */

    function mdl_all_traders2() {
        $this->db->select('*');
        $this->db->from('vwTrader');
        $this->db->where('usertype',1);
        $qry = $this->db->get();
        $records = $qry->result();

        return array(
            'records' => $records,
            'count' => count($records),
        );
    }
    function mdl_all_traders($limit=NULL, $offset=NULL) {
        $this->db->select('*');
        $this->db->from('vwTrader');
        
        if(isset($_SESSION['logged_in']))$this->db->where('traderID!=', $_SESSION['logged_in']['trader_id']);
        $this->db->where('usertype>', '0');
        $this->db->order_by('traderFullName', 'asc');
        if(isset($limit)&&isset($offset))$this->db->limit($limit, $offset);
        
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

    function fetch_trader_editdata($trader_id) {
        $this->db->where('traderID', $trader_id);
        $qry = $this->db->get('trader');
        return $qry->result();
    }

    function get_traders_list($userType='') {
        $this->db->order_by('post.postSubmissionOn', 'DESC');
        $this->db->select('traderFullName ,traderImage,traderLocation,traderPostCount,post.traderID as traderID,post.postStatus,post.postSubmissionOn,tplanID as planID');
        $this->db->from('vwTrader');
        $this->db->join('post','vwTrader.traderID=post.traderID');
        $this->db->group_by("vwTrader.traderID");
        $this->db->limit('5');
        if(!empty($userType)){
            $this->db->where('usertype ='.$userType.' AND post.postStatus>0');
        }
        $query = $this->db->get();
        return $query->result();
    }

    function get_traders_list2() {
       
        $this->db->select('*');
        $this->db->from('trader');
        $this->db->where('usertype', '3');
        $query = $this->db->get();
        $adqry = $query->result();
        
        $this->db->select('*,post.postSubmissionOn');
        $this->db->from('vwTrader');
        $this->db->order_by('post.postSubmissionOn', 'DESC');
        $this->db->join('post','vwTrader.traderID=post.traderID');
        $this->db->where(array('usertype'=>'1','planStatus'=>1));
        $this->db->limit('4');
        $this->db->group_by("vwTrader.traderID");
        $query = $this->db->get();
        $trqry = $query->result();
         return array(
            'adqry' => $adqry,
            'trqry' => $trqry,
        );
         /*
        $this->db->order_by('traderRegistrationDate', 'DESC');
        $this->db->select('*');
        $this->db->from('trader');
        $this->db->where('usertype', '3');
        $this->db->or_where('usertype', '1');
        $this->db->limit('5');
        $query = $this->db->get();
        return $query->result();*/
    }
    function getTotalCount($traderID) {
        $this->db->select('count(*) as count');
        $this->db->from('post');
        $this->db->where('traderID', $traderID);
        $this->db->where('postStatus', '1');
        $query = $this->db->get();
        $result = $query->row();
        return $result->count;

    }
    function fetch_all_trids()
    {
        $tr_qry = $this->db->query("SELECT traderID FROM `trader` WHERE trader.usertype = '1' ORDER BY `traderRegistrationDate` DESC LIMIT 5");
        return $tr_qry->result();
    }
    function trader_tot_post($trader_id)
    {
        
        $cntqry = $this->db->query('select count(*) as totcnt from post  where postStatus = 1 and traderID='.$trader_id);
        return $cntqry->result();
    }
    function gethome_traders_list($total=20) {
        $alshamil =$this->db->query('SELECT traderFullName as nameEn,traderImage as image,trader.traderID as traderId from trader where usertype =3')->result();
        $other_traders= $total - count($alshamil);
     
        $this->db->select('traderFullName as nameEn,traderImage as image,post.traderID as traderId,post.postStatus,post.postSubmissionOn');
        $this->db->from('post');
        $this->db->order_by('post.postSubmissionOn', 'DESC');
        $this->db->join('trader','trader.traderID=post.traderID');
        $this->db->where('usertype =1 AND post.postStatus>0');
        $this->db->group_by("post.traderID");
        $this->db->limit($other_traders);
        
        $query = $this->db->get();
        return array_merge($alshamil,$query->result());
    }

    function gethome_product_list() {

        $q = $this->db->query('SELECT  post.postStatus,post.productID,productiv.postID,
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
             productiv.thumbvideo,productiv.productVideoCount,productiv.productViewCount  FROM `post`
join productiv on (productiv.productID=post.productID)
left join productcar on (productiv.productCategoryID=productcar.productCategoryID and productiv.productID=productcar.productID)

left join productbike on (productiv.productCategoryID=productbike.productCategoryID and productiv.productID=productbike.productID)

left join productboat on (productiv.productCategoryID=productboat.productCategoryID and productiv.productID=productboat.productID)

left join productvertu on (productiv.productCategoryID=productvertu.productCategoryID and productiv.productID=productvertu.productID)

left join productwatch on (productiv.productCategoryID=productwatch.productCategoryID and productiv.productID=productwatch.productID)

left join productproperty on (productiv.productCategoryID=productproperty.productCategoryID and productiv.productID=productproperty.productID)

left join productmn on (productiv.productCategoryID=productmn.productCategoryID and productiv.productID=productmn.productID)

left join productnp on (productiv.productCategoryID=productnp.productCategoryID and productiv.productID=productnp.productID)

left join productphone on (productiv.productCategoryID=productphone.productCategoryID and productiv.productID=productphone.productID)
 


where post.postStatus=1 AND productiv.productVideo!="'.base_url().'/uploads/videos/" AND productiv.productVideo IS NOT NULL AND `productiv`.`productVideo`!=""

order by productiv.productSubmitDate desc ');
//echo $this->db->last_query();
        foreach ($q->result() as $row) {
            $data['postId'] = $row->postID;
            $data['CategoryId'] = $row->productCategoryID;
            $data['ProductId'] = $row->productID;
            $data['video'] = $row->productVideo;
            $data['viewCount'] = $row->productViewCount;
            $data['videoThumbnail'] = $row->thumbvideo;
            $data['postTitleAr'] = "";
            if ($data['CategoryId'] == 1) {

                $data['postTitleEn'] = $row->productCBrand . " " . $row->productCModel;
            } else if ($data['CategoryId'] == 2) {

                $data['postTitleEn'] = $row->productBBrand . " " . $row->productBModel;
            } else if ($data['CategoryId'] == 3) {

                $data['postTitleEn'] = $row->productNPCode . " " . $row->productNPEmrites;
            } else if ($data['CategoryId'] == 4) {

                $data['postTitleEn'] = $row->productVBrand . " " . $row->productVModel;
            } else if ($data['CategoryId'] == 5) {

                $data['postTitleEn'] = $row->productWBrand . " " . $row->productWModel;
            } else if ($data['CategoryId'] == 6) {

                $data['postTitleEn'] = $row->productMNPrefix . " " . $row->productMNNmbr;
            } else if ($data['CategoryId'] == 7) {

                $data['postTitleEn'] = $row->productBtBrand . " " . $row->productBtModel;
            } else if ($data['CategoryId'] == 8) {

                $data['postTitleEn'] = $row->productPBrand . " " . $row->productPModel;
            } else if ($data['CategoryId'] == 9) {


                $data['postTitleEn'] = $row->productPropType . " " . $row->productPropSC;
            } else {

                $data['postTitleEn'] = "";
            }

//           





    $link_array = explode('/',$row->productVideo);
    $file = end($link_array);
    $file_det = pathinfo($file);

    if(isset($file_det['extension'])){
        $row_post[] =  $data;
    }
    


      
            
        }
        return isset($row_post)?$row_post:array();
    }

    function get_recentimage() {
        $car = $this->db->query('select category.productCategoryID,category.category_name,category.categoryProductCount, productcar.Cpost_main_img as image from  category right join productcar on category.productCategoryID=productcar.productCategoryID order by productcar.productCSubmitDate DESC limit 1');
        $c1 = $car->result();
        $bike = $this->db->query('select category.productCategoryID,category.category_name,category.categoryProductCount,  productbike.Bpost_main_img as image from category right join productbike on category.productCategoryID=productbike.productCategoryID order by productbike.productBSubmitDate DESC limit 1 ');
        $b1 = $bike->result();
        $numberplate = $this->db->query('select category.productCategoryID,category.category_name,category.categoryProductCount,  productnp.NPpost_main_img as image from category right join productnp on category.productCategoryID=productnp.productCategoryID order by productnp.productNPSubmitDate DESC limit 1');
        $np1 = $numberplate->result();
        $vertu = $this->db->query('select category.productCategoryID,category.category_name,category.categoryProductCount,  productvertu.Vpost_main_img as image from category right join productvertu on category.productCategoryID=productvertu.productCategoryID order by productvertu.productVSubmitDate DESC limit 1');
        $v1 = $vertu->result();
        $watch = $this->db->query('select category.productCategoryID,category.category_name,category.categoryProductCount,  productwatch.Wpost_main_img as image from category right join productwatch on category.productCategoryID=productwatch.productCategoryID order by productwatch.productWSubmitDate DESC limit 1');
        $w1 = $watch->result();
        $boat = $this->db->query('select category.productCategoryID,category.category_name,category.categoryProductCount,  productboat.BTpost_main_img as image from category right join productboat on category.productCategoryID=productboat.productCategoryID order by productboat.productBTSubmitDate DESC limit 1');
        $bt1 = $boat->result();
        $phone = $this->db->query('select category.productCategoryID,category.category_name,category.categoryProductCount,  productphone.PHpost_main_img as image from category right join productphone on category.productCategoryID=productphone.productCategoryID order by productphone.productPSubmitDate DESC limit 1');
        $p1 = $phone->result();
        $property = $this->db->query('select category.productCategoryID,category.category_name,category.categoryProductCount,  productproperty.PRpost_main_img as image from category right join productproperty on category.productCategoryID=productproperty.productCategoryID order by productproperty.productPRSubmitDate DESC limit 1');
        $propty = $property->result();
        $mn = $this->db->query('select category.productCategoryID,category.category_name,category.categoryProductCount,  productmn.MNpost_main_img as image from  category right join productmn on category.productCategoryID=productmn.productCategoryID order by productmn.productMNSubmitDate DESC limit 1');
        $mobno = $mn->result();
        return array($c1, $b1, $np1, $v1, $w1, $mobno, $bt1, $p1, $propty);
    }

    function Car_postcount() {
        $query = $this->db->query('select categoryProductCount from category where productCategoryID=1');
        return $query->result();
    }

    function Bike_postcount() {
        $query = $this->db->query('select categoryProductCount from category where productCategoryID=2');
        return $query->result();
    }

    function Vertu_postcount() {
        $query = $this->db->query('select categoryProductCount from category where productCategoryID=4');
        return $query->result();
    }

    function Boat_postcount() {
        $query = $this->db->query('select categoryProductCount from category where productCategoryID=7');
        return $query->result();
    }

    function Watch_postcount() {
        $query = $this->db->query('select categoryProductCount from category where productCategoryID=5');
        return $query->result();
    }

    function Phone_postcount() {
        $query = $this->db->query('select categoryProductCount from category where productCategoryID=8');
        return $query->result();
    }

    function Property_postcount() {
        $query = $this->db->query('select categoryProductCount from category where productCategoryID=9');
        return $query->result();
    }

    function NP_postcount() {
        $query = $this->db->query('select categoryProductCount from category where productCategoryID=3');
        return $query->result();
    }

    function MN_postcount() {
        $query = $this->db->query('select categoryProductCount from category where productCategoryID=6');
        return $query->result();
    }

    function get_post_lists($per_page_cnt, $limit) {
       // $where=(!empty($per_page_cnt)&&!empty($limit)) ? 'limit '.$per_page_cnt.' offset '.$limit : "";
        $qry = $this->db->query('SELECT DISTINCT post.postID,post.productCategoryID,post.productID,flaggeditems.flagStatus,post.productViewCount,productcar.cartCType ,productcar.productCSubmitDate ,productcar.productCPrice ,productcar.Cpost_main_img ,productcar.productCBrand ,productcar.productCModel ,productcar.productCDesc,productcar.productCCallPrice ,productcar.productCStatus,
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
        left join productwatch on (post.productCategoryID=productwatch.productCategoryID and post.productID=productwatch.productID)  where post.postStatus="1" order by post.postID DESC  LIMIT '.$limit.','.$per_page_cnt);

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
                $data['titileEn'] = $row->productCBrand . " " . $row->productCModel;
                $data['titleAr'] = "";
                $data['productDesc'] = $row->productCDesc;
                $data['CallPrice'] = $row->productCCallPrice;
                $data['status'] = $row->productCStatus;
            } else if ($data['categoryId'] == 2) {
                $data['is_alshamilProduct'] = $row->cartBType;
                $data['image'] = $row->Bpost_main_img;
                $data['publishedOn'] = $row->productBSubmitDate;
                $data['Price'] = $row->productBPrice;
                $data['titileEn'] = $row->productBBrand . " " . $row->productBModel;
                $data['titleAr'] = "";
                $data['productDesc'] = $row->bikeDesciption;
                $data['CallPrice'] = $row->productBCallPrice;
                $data['status'] = $row->productBStatus;
            } else if ($data['categoryId'] == 3) {
                $data['is_alshamilProduct'] = $row->cartNPType;
                $data['image'] = $row->NPpost_main_img;
                $data['publishedOn'] = $row->productNPSubmitDate;
                $data['Price'] = $row->productNPPrice;
                $data['titileEn'] = $row->productNPCode . " " . $row->productNPNmbr;
                $data['titleAr'] = "";
                $data['productDesc'] = $row->productNPDesc;
                $data['CallPrice'] = $row->productNPCallPrice;
                $data['status'] = $row->productNPStatus;
            } else if ($data['categoryId'] == 4) {
                $data['is_alshamilProduct'] = $row->cartVType;
                $data['image'] = $row->Vpost_main_img;
                $data['publishedOn'] = $row->productVSubmitDate;
                $data['Price'] = $row->productVPrice;
                $data['titileEn'] = $row->productVBrand . " " . $row->productVModel;
                $data['titleAr'] = "";
                $data['productDesc'] = $row->productVDesc;
                $data['CallPrice'] = $row->productVCallPrice;
                $data['status'] = $row->productVStatus;
            } else if ($data['categoryId'] == 5) {
                $data['is_alshamilProduct'] = $row->cartWType;
                $data['image'] = $row->Wpost_main_img;
                $data['publishedOn'] = $row->productWSubmitDate;
                $data['Price'] = $row->productWPrice;
                $data['titileEn'] = $row->productWBrand . " " . $row->productWModel;
                $data['titleAr'] = "";
                $data['productDesc'] = $row->productWDesc;
                $data['CallPrice'] = $row->productWCallPrice;
                $data['status'] = $row->productWStatus;
            } else if ($data['categoryId'] == 6) {
                $data['is_alshamilProduct'] = $row->cartMNType;
                $data['image'] = $row->MNpost_main_img;
                $data['publishedOn'] = $row->productMNSubmitDate;
                $data['Price'] = $row->productMNPrice;
                $data['titileEn'] = $row->productOperator . " " . $row->productMNNmbr;
                $data['titleAr'] = "";
                $data['productDesc'] = $row->productMNDesc;
                $data['CallPrice'] = $row->productMNCallPrice;
                $data['status'] = $row->productMNStatus;
            } else if ($data['categoryId'] == 7) {
                $data['is_alshamilProduct'] = $row->cartBTType;
                $data['image'] = $row->BTpost_main_img;
                $data['publishedOn'] = $row->productBTSubmitDate;
                $data['Price'] = $row->productBTPrice;
                $data['titileEn'] = $row->productBtBrand . " " . $row->productBtModel;
                $data['titleAr'] = "";
                $data['productDesc'] = $row->boatDesc;
                $data['CallPrice'] = $row->productBtCallPrice;
                $data['status'] = $row->productBTStatus;
            } else if ($data['categoryId'] == 8) {
                $data['is_alshamilProduct'] = $row->cartPHType;
                $data['image'] = $row->PHpost_main_img;
                $data['publishedOn'] = $row->productPSubmitDate;
                $data['Price'] = $row->productPHPrice;
                $data['titileEn'] = $row->productPBrand . " " . $row->productPModel;
                $data['titleAr'] = "";
                $data['productDesc'] = $row->productPDesc;
                $data['CallPrice'] = $row->productPhCallPrice;
                $data['status'] = $row->productPHStatus;
            } else if ($data['categoryId'] == 9) {
                $data['is_alshamilProduct'] = $row->cartPRType;
                $data['image'] = $row->PRpost_main_img;
                $data['publishedOn'] = $row->productPRSubmitDate;
                $data['Price'] = $row->productPRPrice;
                $data['titileEn'] = $row->productPropType . " " . $row->productPropSC;
                $data['titleAr'] = "";
                $data['productDesc'] = $row->productDesc;
                $data['CallPrice'] = $row->productPropCallPrice;
                $data['status'] = $row->productPRStatus;
            } else {
                $data['is_alshamilProduct'] = "";
                $data['image'] = "";
                $data['publishedOn'] = "";
                $data['Price'] = "";
                $data['titileEn'] = "";
                $data['titleAr'] = "";
                $data['productDesc'] = "";
                $data['CallPrice'] = "";
                $data['status'] = "";
            }

            $data['ProductViewCount'] = $row->productViewCount;
            $data['TraderID'] = $row->traderID;
            $row_post[] = $data;
            $data = '';
        }
        return $row_post;

//               return $qry->result ();
    }
    function count_filterby_cat($categoryId, $brand=NULL, $model=NULL,$from_date=NULL,$to_date=NULL,$numdigit=NULL){
        $this->db->select("count(*) as total_entries");  
        
        if($categoryId)$this->db->like('CategoryID', $categoryId, 'none'); 
        if($brand)$this->db->like('Brand', $brand, 'none'); 
        if($model)$this->db->like('Model', $model, 'none'); 
        if($numdigit)$this->db->like('Digits', $numdigit, 'none'); 
        if($from_date)$where['ReleaseYear>']=$from_date; 
        if($to_date)$where['ReleaseYear<']=$to_date; 
        if($from_date||$to_date)$this->db->where($where);
       // if($from_date)$this->db->like('CategoryID', $from_date, 'none'); 
        $where['vwProductPostNw.PostAdminStatus>']=0;
     
        $this->db->join('trader','trader.traderID=vwProductPostNw.TraderID','left');
      
        $result=$this->db->get("vwProductPostNw");
      
       // var_dump($where);
       
        if(!empty($result))return $result->result()[0];
      else return 0 ; 
    }
    function filterby_cat($categoryId, $brand, $model,$from_date,$to_date,$numdigit,$per_page_cnt,$offset){
        $this->db->select("vwProductPost.*,date_format(`vwProductPost`.`SubmitDate`,'%d %b %Y') AS `SubmitDate`,trader.traderImage,trader.traderFullName,trader.traderID,trader.traderLocation,trader.isActive,trader.usertype");  
        if($categoryId)$this->db->like('CategoryID', $categoryId, 'none'); 
        if($brand)$this->db->like('Brand', $brand, 'none'); 
        if($model)$this->db->like('Model', $model, 'none'); 
        if($numdigit)$this->db->like('Digits', $numdigit, 'none'); 
        if($from_date)$where['ReleaseYear>=']=$from_date; 
        if($to_date)$where['ReleaseYear<=']=$to_date; 
       // if($from_date||$to_date)$this->db->where($where);
       // if($from_date)$this->db->like('CategoryID', $from_date, 'none'); 
        $where['vwProductPost.PostAdminStatus>']=0;
        $this->db->where($where);  
      //  $this->db->like($like); 
      if($per_page_cnt)$this->db->limit($per_page_cnt,$offset);
     
      $this->db->order_by("vwProductPost.SubmitDate", "desc"); 
      $this->db->join('trader','trader.traderID=vwProductPost.TraderID','left');
      
        $result=$this->db->get("vwProductPost");
      // echo $this->db->last_query();exit;
        if(!empty($result))return $result->result();
      else return 0 ; 
    }

    function filter($categoryId, $carBrand, $carModel, $carStartDate, $carEndDate, $bikeBrand, $bikeModel, $bikeStartDate, $bikeEndDate, $npEmirate, $npCode, $npDigitCount, $vertuBrand, $vertuModel, $watchBrand, $watchModel, $mnPrefix, $mnOperator, $mnDigitCount, $boatBrand, $boatModel, $phoneBrand, $phoneModel, $propertiesCategory, $propertiesSubCategory, $per_page_cnt, $limit) {

        if ($categoryId == 1) {
           $qry = $this->db->query("SELECT `post`.`postStatus`,`post`.`postStatus`,`post`.`postID` as postId,`post`.`productCategoryID` as CategoryId,post.productID,
          concat(`productcar`.`productCBrand`, `productcar`.`productCModel`)as titleEn,`productcar`.`productCPrice` as price,productcar.Cpost_main_img as image, DATE_FORMAT(productcar.productCSubmitDate,'%d %b %Y') as publishedOn ,productcar.cartCType as is_alshamilProduct,productcar.productCStatus as status,trader.`traderID`, `trader`.`traderFullName` as traderName, `trader`.`traderLocation`, `trader`.`traderImage`
          ,DATE_FORMAT(productcar.productCSubmitDate,'%d %b %Y') as publishedOn ,`productcar`.`productCCallPrice` as callprice
            from post
           left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
           left JOIN `productcar` ON (`post`.`productCategoryID`=`productcar`.`productCategoryID` AND `post`.`productID`=`productcar`.`productID`)
           where productcar.productCategoryID=1 and `post`.`postStatus`>0 and (productcar.productCBrand like '%" . $carBrand . "' and productcar.productCmodel like '%" . $carModel . "' and productcar.productCReleaseYear like '%" . $carStartDate . "' and productcar.productCReleaseYear like '%" . $carEndDate . "') limit " . $per_page_cnt . " offset " . $limit . " ");
           return $qry->result();

        } else if ($categoryId == 2) {
            $qry = $this->db->query("SELECT `post`.`postStatus`,`post`.`postID` as postId,`post`.`productCategoryID` as CategoryId,post.productID,
          concat (`productbike`.`productBBrand`,`productbike`.`productBModel`)as titleEn,`productbike`.`productBPrice` as price,productbike.Bpost_main_img as image, DATE_FORMAT(productbike.productBSubmitDate,'%d %b %Y') as publishedOn,productbike.cartBType as is_alshamilProduct,productbike.productBStatus as status,trader.`traderID`, `trader`.`traderFullName` as traderName, `trader`.`traderLocation`, `trader`.`traderImage`
          ,DATE_FORMAT(productbike.productBSubmitDate,'%d %b %Y') as publishedOn,`productbike`.`productBCallPrice` as callprice
            from post
           left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
           left JOIN `productbike` ON (`post`.`productCategoryID`=`productbike`.`productCategoryID` AND `post`.`productID`=`productbike`.`productID`)
           where productbike.productCategoryID=2 and `post`.`postStatus`>0 and (productbike.productBBrand like '%" . $carBrand . "' and productbike.productBmodel like '%" . $carModel . "' and productbike.productBReleaseYear like '%" . $carStartDate . "' and productbike.productBReleaseYear like '%" . $carEndDate . "') limit " . $per_page_cnt . " offset " . $limit . " ");
            return $qry->result();
        } else if ($categoryId == 3) {
            $qry = $this->db->query("SELECT `post`.`postStatus`,`post`.`postID` as postId,`post`.`productCategoryID` as CategoryId,post.productID,
          concat (`productnp`.`productNPCode`, productnp.productNPDigits )as titleEn ,`productnp`.`productNPPrice` as price,productnp.NPpost_main_img as image,DATE_FORMAT(productnp.productNPSubmitDate,'%d %b %Y') as publishedOn,productnp.cartNPType as is_alshamilProduct,productnp.productNPStatus as status,trader.`traderID`, `trader`.`traderFullName` as traderName, `trader`.`traderLocation`, `trader`.`traderImage`
          ,DATE_FORMAT(productnp.productNPSubmitDate,'%d %b %Y') as publishedOn,`productnp`.`productNPCallPrice` as callprice
            from post
           left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
           left JOIN `productnp` ON (`post`.`productCategoryID`=`productnp`.`productCategoryID` AND `post`.`productID`=`productnp`.`productID`)
           where productnp.productCategoryID=3 and `post`.`postStatus`>0 and (productnp.productNPCode like '%" . $npCode . "' and productnp.productNPDigits like '%" . $npDigitCount . "') limit " . $per_page_cnt . " offset " . $limit . " ");
            return $qry->result();
        } else if ($categoryId == 4) {
            $qry = $this->db->query("SELECT `post`.`postStatus`,`post`.`postID` as postId,`post`.`productCategoryID` as CategoryId,post.productID,
           concat(`productvertu`.`productVBrand`, `productvertu`.`productVModel`) as titleEn,`productvertu`.`productVPrice` as price,productvertu.Vpost_main_img as image,DATE_FORMAT(productvertu.productVSubmitDate,'%d %b %Y') as publishedOn,productvertu.cartVType as is_alshamilProduct,productvertu.productVStatus as status,trader.`traderID`, `trader`.`traderFullName` as traderName, `trader`.`traderLocation`, `trader`.`traderImage`
           ,DATE_FORMAT(productvertu.productVSubmitDate,'%d %b %Y') as publishedOn,`productvertu`.`productVCallPrice` as callprice
            from post
           left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
           left JOIN `productvertu` ON (`post`.`productCategoryID`=`productvertu`.`productCategoryID` AND `post`.`productID`=`productvertu`.`productID`)
           where productvertu.productCategoryID=4 and `post`.`postStatus`>0 and (productvertu.productVBrand like '%" . $vertuBrand . "' and productvertu.productVmodel like '%" . $vertuModel . "' ) limit " . $per_page_cnt . " offset " . $limit . " ");
            return $qry->result();
        } else if ($categoryId == 5) {
            $qry = $this->db->query("SELECT `post`.`postStatus`,`post`.`postID` as postId,`post`.`productCategoryID` categoryId,post.productID,
          concat( `productwatch`.`productWBrand`, `productwatch`.`productWModel`) as titleEn,`productwatch`.`productWPrice` as price,productwatch.Wpost_main_img as image,DATE_FORMAT(productwatch.productWSubmitDate,'%d %b %Y') as publishedOn,productwatch.cartWType as is_alshamilProduct,productwatch.productWStatus as status,trader.`traderID`, `trader`.`traderFullName` as traderName, `trader`.`traderLocation`, `trader`.`traderImage`
          ,DATE_FORMAT(productwatch.productWSubmitDate,'%d %b %Y') as publishedOn,`productwatch`.`productWCallPrice` as callprice
         from post
           left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
           left JOIN `productwatch` ON (`post`.`productCategoryID`=`productwatch`.`productCategoryID` AND `post`.`productID`=`productwatch`.`productID`)
           where productwatch.productCategoryID=5 and `post`.`postStatus`>0 and (productwatch.productWBrand like '%" . $watchBrand . "' and productwatch.productWmodel like '%" . $watchModel . "' )limit " . $per_page_cnt . " offset " . $limit . "  ");
            return $qry->result();
        } else if ($categoryId == 6) {
            $qry = $this->db->query("SELECT `post`.`postStatus`,`post`.`postID` as postId,`post`.`productCategoryID` as CategoryId,post.productID,
           concat(`productmn`.`productMNPrefix`, `productmn`.`productMNDigits`)as titleEn,`productmn`.`productMNNmbr` as MobileNumber,productmn.productMNPrice as price,productmn.MNpost_main_img as image,DATE_FORMAT(productmn.productMNSubmitDate,'%d %b %Y') as publishedOn,productmn.cartMNType as is_alshamilProduct,productmn.productMNStatus as status,trader.`traderID`, `trader`.`traderFullName` as traderName, `trader`.`traderLocation`, `trader`.`traderImage`
           ,DATE_FORMAT(productmn.productMNSubmitDate,'%d %b %Y') as publishedOn,`productmn`.`productMNCallPrice` as callprice
            from post
           left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
           left JOIN `productmn` ON (`post`.`productCategoryID`=`productmn`.`productCategoryID` AND `post`.`productID`=`productmn`.`productID`)
           where productmn.productCategoryID=6 and `post`.`postStatus`>0 and (productmn.productMNPrefix like '%" . $mnPrefix . "' and productmn.productOperator like '%" . $mnOperator . "' and productmn.productMNDigits like '%" . $mnDigitCount . "' ) limit " . $per_page_cnt . " offset " . $limit . " ");
            return $qry->result();
        } else if ($categoryId == 7) {
            $qry = $this->db->query("SELECT `post`.`postStatus`,`post`.`postID` as postId,`post`.`productCategoryID` as CategoryId,post.productID,
           concat(`productboat`.`productBtBrand`, `productboat`.`productBtModel`)as titleEn ,`productboat`.`productBTPrice` as price,productboat.BTpost_main_img as image,DATE_FORMAT(productboat.productBTSubmitDate,'%d %b %Y') as publishedOn,productboat.cartBTType as Is_alshamilProduct,productboat.productBTStatus as status,trader.`traderID`, `trader`.`traderFullName` as traderName, `trader`.`traderLocation`, `trader`.`traderImage`
           ,DATE_FORMAT(productboat.productBTSubmitDate,'%d %b %Y') as publishedOn,`productboat`.`productBtCallPrice` as callprice
            from post
           left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
           left JOIN `productboat` ON (`post`.`productCategoryID`=`productboat`.`productCategoryID` AND `post`.`productID`=`productboat`.`productID`)
           where productboat.productCategoryID=7 and `post`.`postStatus`>0 and (productboat.productBtBrand like '%" . $boatBrand . "' and productboat.productBTmodel like '%" . $boatModel . "' ) limit " . $per_page_cnt . " offset " . $limit . " ");
            return $qry->result();
        } else if ($categoryId == 8) {
            $qry = $this->db->query("SELECT `post`.`postStatus`,`post`.`postID` as postId,`post`.`productCategoryID` as CategoryId,post.productID,
           concat(`productphone`.`productPBrand`, `productphone`.`productPModel`) as titleEn,`productphone`.`productPHPrice` as price,productphone.PHpost_main_img as image,DATE_FORMAT(productphone.productPSubmitDate,'%d %b %Y') as publishedOn,productphone.cartPHType as is_alshamilProduct,productphone.productPHStatus as status,trader.`traderID`, `trader`.`traderFullName` as traderName, `trader`.`traderLocation`, `trader`.`traderImage`
           ,DATE_FORMAT(productphone.productPSubmitDate,'%d %b %Y') as publishedOn,`productphone`.`productPhCallPrice` as callprice
            from post
           left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
           left JOIN `productphone` ON (`post`.`productCategoryID`=`productphone`.`productCategoryID` AND `post`.`productID`=`productphone`.`productID`)
           where productphone.productCategoryID=8 and `post`.`postStatus`>0 and (productphone.productPBrand like '%" . $phoneBrand . "' and productphone.productPmodel like '%" . $phoneModel . "' )limit " . $per_page_cnt . " offset " . $limit . "  ");
            return $qry->result();
        } else if ($categoryId == 9) {
            $qry = $this->db->query("SELECT `post`.`postStatus`,`post`.`postID` as postId,`post`.`productCategoryID` CategoryId,post.productID,
           concat(`productproperty`.`productPropSC`, `productproperty`.`productPropType`) as titleEn,`productproperty`.`productPRPrice` as price,productproperty.PRpost_main_img as image,DATE_FORMAT(productproperty.productPRSubmitDate,'%d %b %Y') as publishedOn ,productproperty.cartPRType as is_alshamilProduct,productproperty.productPRStatus as status,trader.`traderID`, `trader`.`traderFullName` as traderName, `trader`.`traderLocation`, `trader`.`traderImage`
           ,DATE_FORMAT(productproperty.productPRSubmitDate,'%d %b %Y') as publishedOn ,`productproperty`.`productPropCallPrice` as callprice
        from post
           left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
           left JOIN `productproperty` ON (`post`.`productCategoryID`=`productproperty`.`productCategoryID` AND `post`.`productID`=`productproperty`.`productID`)
           where productproperty.productCategoryID=9 and `post`.`postStatus`>0 and (productproperty.productPropType like '%" . $propertiesCategory . "' and productproperty.productPropSC like '%" . $propertiesSubCategory . "' )limit " . $per_page_cnt . " offset " . $limit . "  ");
            return $qry->result();
        }
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
    function get_traderlist($txtemail, $txtpassword, $txtusertype, $deviceId=NULL) {
        $md_password = md5($txtpassword);
       $this->db->select('trader.traderID as userId,traderUserName as username,traderFullName as nameEn,traderImage as profileImage,traderLocation as locationEn,traderContactNum as mobile,traderEmailID as email,traderInfo as descriptionEn,socialWeb as website,socialFb as facebook,socialInsta as instagram,socialSnap as snapchat,socialtwitter as twitter,usertype as userTypeId,isActive,trader.planID,tradersubscriptionplan.planStatus');
        $this->db->from('trader');
        $this->db->join('tradersubscriptionplan','tradersubscriptionplan.traderID=trader.traderID','left');
        if($txtusertype==1)
       $where=array('traderUserName'=>$txtemail,'traderPasswd'=>$md_password,'userType'=>$txtusertype);
       elseif($txtusertype==0)
       $where=array('traderEmailID'=>$txtemail,'traderPasswd'=>$md_password,'userType'=>$txtusertype);
        $this->db->where($where);
        $this->db->where('isActive', 1);
      /*  $this->db->select('traderID as userId,traderFullName as nameEn,traderImage as profileImage,traderLocation as locationEn,traderContactNum as mobile,traderEmailID as email,traderInfo as descriptionEn,socialWeb as website,socialFb as facebook,socialInsta as instagram,socialSnap as snapchat,socialtwitter as twitter,usertype as userTypeId,isActive,planID,planStatus');
         $this->db->from('vwTrader');
       $where=array('traderEmailID'=>$txtemail,'traderPasswd'=>$txtpassword,'userType'=>$txtusertype);
        $this->db->where($where);
*/
       // $this->db->where('deviceId', $deviceId);
        $this->db->limit(1);
        $query = $this->db->get();
        //var_dump($query->result());
       // echo $this->db->last_query();
       
       if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function profileimage($userId) {
        $this->db->select('traderImage');
        $this->db->from('trader');
        $this->db->where('traderID', $userId);
        $query = $this->db->get();
        return $query->result();
    }

    function get_product_list() {


        $query = $this->db->query('SELECT  productiv.productCategoryID,productiv.thumbImage,productiv.productImage,productiv.productID,productiv.productVideo,productiv.productVideoCount,productiv.productSubmitDate,productcar.productCBrand,productcar.productCModel,productbike.productBBrand,productbike.productBModel,productboat.productBtBrand,productboat.productBtModel,productvertu.productVBrand,productvertu.productVModel,productwatch.productWBrand,productwatch.productWModel,productproperty.productPropSC,productproperty.productPropType,productmn.productMNNmbr,productnp.productNPEmrites,productnp.productNPCode,productphone.productPBrand,productphone.productPModel FROM `productiv`
left join post on productiv.postID = post.postID
left join productcar on (productiv.productCategoryID=productcar.productCategoryID or productiv.productID=productcar.productID)

left join productbike on (productiv.productCategoryID=productbike.productCategoryID or productiv.productID=productbike.productID)

left join productboat on (productiv.productCategoryID=productboat.productCategoryID or productiv.productID=productboat.productID)

left join productvertu on (productiv.productCategoryID=productvertu.productCategoryID or productiv.productID=productvertu.productID)

left join productwatch on (productiv.productCategoryID=productwatch.productCategoryID or productiv.productID=productwatch.productID)

left join productproperty on (productiv.productCategoryID=productproperty.productCategoryID or productiv.productID=productproperty.productID)

left join productmn on (productiv.productCategoryID=productmn.productCategoryID or productiv.productID=productmn.productID)

left join productnp on (productiv.productCategoryID=productnp.productCategoryID or productiv.productID=productnp.productID)

left join productphone on (productiv.productCategoryID=productphone.productCategoryID or productiv.productID=productphone.productID)

where productiv.productVideo != "" AND productiv.productVideo != " " and post.postStatus = 1 group by productID
order by productiv.productSubmitDate desc limit 6');

        return $query->result();
    }

    function most_view2() {

              $recentqry = $this->db->query('select productCStatus,productBStatus,productBTStatus,productNPStatus,productVStatus,productWStatus,productMNStatus,productPHStatus,productPRStatus,post.productID,post.productCategoryID,post.postID,productcar.productCPrice ,productcar.Cpost_main_img ,concat(productcar.productCBrand, " ",productcar.productCModel) as product_name1,productcar.cartCType, 
              productbike.productBPrice ,productbike.Bpost_main_img ,concat(productbike.productBBrand, " ",productbike.productBModel) as product_name2,productbike.cartBType ,
               productboat.productBTPrice ,productboat.BTpost_main_img ,concat(productboat.productBtBrand," ",productboat.productBtModel) as product_name3,productboat.cartBTType ,
               productwatch.productWPrice ,productwatch.Wpost_main_img ,concat(productwatch.productWBrand," ",productwatch.productWModel) as product_name4,productwatch.cartWType ,
               productvertu.productVPrice ,productvertu.Vpost_main_img ,concat(productvertu.productVBrand," ",productvertu.productVModel) as product_name5,productvertu.cartVType ,
               productproperty.productPRPrice ,productproperty.PRpost_main_img ,concat(productproperty.productPropSC," ",productproperty.productPropType) as product_name6,productproperty.cartPRType ,
               productphone.productPHPrice ,productphone.PHpost_main_img ,concat(productphone.productPBrand," ",productphone.productPModel) as product_name7,productphone.cartPHType ,
             productnp.productNPPrice ,productnp.NPpost_main_img,concat(productnp.productNPCode," ",productnp.productNPNmbr) as product_name8,productnp.productNPDigits,productnp.cartNPType ,
               productmn.productMNPrice ,productmn.MNpost_main_img ,concat(productmn.productMNPrefix," ",productmn.productMNNmbr) as product_name9,productmn.cartMNType 
               from post
               left join productcar on (post.productCategoryID=productcar.productCategoryID and post.productID=productcar.productID)
                 left join productbike on (post.productCategoryID=productbike.productCategoryID and post.productID=productbike.productID)
                 left join productboat on (post.productCategoryID=productboat.productCategoryID and post.productID=productboat.productID)
                 left join productmn on (post.productCategoryID=productmn.productCategoryID and post.productID=productmn.productID)
                 left join productnp on (post.productCategoryID=productnp.productCategoryID and post.productID=productnp.productID)
                 left join productphone on (post.productCategoryID=productphone.productCategoryID and post.productID=productphone.productID)
                 left join productproperty on (post.productCategoryID=productproperty.productCategoryID and post.productID=productproperty.productID)
                 left join productvertu on (post.productCategoryID=productvertu.productCategoryID and  post.productID=productvertu.productID)
                 left join productwatch on (post.productCategoryID=productwatch.productCategoryID and post.productID=productwatch.productID) 
                 where   (post.postStatus=1 and (productcar.productCStatus>-1)) or (post.postStatus=1 and (productbike.productBStatus>-1)) or (post.postStatus=1 and (productboat.productBTStatus>-1)) or (post.postStatus=1 and (productnp.productNPStatus>-1) ) or (post.postStatus=1 and (productvertu.productVStatus>-1) )or (post.postStatus=1 and (productwatch.productWStatus>-1)) or (post.postStatus=1 and (productmn.productMNStatus>-1)) or (post.postStatus=1 and (productphone.productPHStatus>-1)) or (post.postStatus=1 and (productproperty.productPRStatus>-1) )
                order by post.productViewCount desc LIMIT 8');
            return $recentqry->result();
        }
    function latest_post2_admin() {

                $qry = $this->db->query('SELECT post.postID,post.productCategoryID,post.postSubmissionOn,trader.traderID,trader.traderFullName,trader.traderLocation,trader.traderImage,trader.usertype,post.productID,
                productcar.productCPrice ,`productcar`.`productCCallPrice`,productcar.Cpost_main_img ,concat(productcar.productCBrand, " ",productcar.productCModel) as product_name1,productcar.cartCType, 
                     productbike.productBPrice ,`productbike`.`productBCallPrice`,productbike.Bpost_main_img ,concat(productbike.productBBrand, " ",productbike.productBModel) as product_name2,productbike.cartBType ,
                      productboat.productBTPrice ,`productboat`.`productBtCallPrice`,productboat.BTpost_main_img ,concat(productboat.productBtBrand," ",productboat.productBtModel) as product_name7,productboat.cartBTType ,
                      productwatch.productWPrice ,`productwatch`.`productWCallPrice`,productwatch.Wpost_main_img ,concat(productwatch.productWBrand," ",productwatch.productWModel) as product_name5,productwatch.cartWType ,
                      productvertu.productVPrice ,`productvertu`.`productVCallPrice`,productvertu.Vpost_main_img ,concat(productvertu.productVBrand," ",productvertu.productVModel) as product_name4,productvertu.cartVType ,
                      productproperty.productPRPrice ,`productproperty`.`productPropCallPrice`,productproperty.PRpost_main_img ,concat(productproperty.productPropSC," ",productproperty.productPropType) as product_name9,productproperty.cartPRType ,
                      productphone.productPHPrice ,`productphone`.`productPhCallPrice`,productphone.PHpost_main_img ,concat(productphone.productPBrand," ",productphone.productPModel) as product_name8,productphone.cartPHType ,
                    productnp.productNPPrice ,`productnp`.`productNPCallPrice`,productnp.NPpost_main_img,concat(productnp.productNPCode," ",productnp.productNPNmbr) as product_name3,productnp.productNPDigits,productnp.cartNPType ,
                      productmn.productMNPrice ,`productmn`.`productMNCallPrice`,productmn.MNpost_main_img ,productmn.productMNDigits,concat(productmn.productMNPrefix," ",productmn.productMNNmbr) as product_name6,productmn.cartMNType  FROM `post`
                        left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
                       
                        left join productcar on (post.productCategoryID=productcar.productCategoryID and post.productID=productcar.productID)
                        left join productbike on (post.productCategoryID=productbike.productCategoryID and post.productID=productbike.productID)
                        left join productboat on (post.productCategoryID=productboat.productCategoryID and post.productID=productboat.productID)
                        left join productmn on (post.productCategoryID=productmn.productCategoryID and post.productID=productmn.productID)
                        left join productnp on (post.productCategoryID=productnp.productCategoryID and post.productID=productnp.productID)
                        left join productphone on (post.productCategoryID=productphone.productCategoryID and post.productID=productphone.productID)
                        left join productproperty on (post.productCategoryID=productproperty.productCategoryID and post.productID=productproperty.productID)
                        left join productvertu on (post.productCategoryID=productvertu.productCategoryID and  post.productID=productvertu.productID)
                        left join productwatch on (post.productCategoryID=productwatch.productCategoryID and post.productID=productwatch.productID) 
                        where   (post.postStatus=1 and (productcar.productCStatus=0)) or (post.postStatus=1 and (productbike.productBStatus=0)) or (post.postStatus=1 and (productboat.productBTStatus=0)) or (post.postStatus=1 and (productnp.productNPStatus=0) ) or (post.postStatus=1 and (productvertu.productVStatus=0) )or (post.postStatus=1 and (productwatch.productWStatus=0)) or (post.postStatus=1 and (productmn.productMNStatus=0)) or (post.postStatus=1 and (productphone.productPHStatus=0)) or (post.postStatus=1 and (productproperty.productPRStatus=0) ) order by post.postID DESC limit 
                        8');
        
        foreach ($qry->result() as $row) {
           
        
        
            if ($row->productCategoryID == 1) {
                $row->CallPrice = $row->productCCallPrice;
              
            } else if ($row->productCategoryID == 2) {
                $row->CallPrice = $row->productBCallPrice;
             
            } else if ($row->productCategoryID == 3) {
                $row->CallPrice= $row->productNPCallPrice;
            
            } else if ($row->productCategoryID == 4) {
                $row->CallPrice = $row->productVCallPrice;
          
            } else if ($row->productCategoryID == 5) {
                $row->CallPrice= $row->productWCallPrice;
         
            } else if ($row->productCategoryID  == 6) {
                $row->CallPrice= $row->productMNCallPrice;
             
            } else if ($row->productCategoryID == 7) {
                $row->CallPrice = $row->productBtCallPrice;
            
            } else if ($row->productCategoryID  == 8) {
                $row->CallPrice = $row->productPhCallPrice;
         
            } else if ($row->productCategoryID  == 9) {
                $row->CallPrice = $row->productPropCallPrice;
           
            } else {
                $row->CallPrice= "";
           
            }
        
        
        
            $row_post[] = $row;
            $data = '';
        }
        return $row_post;
               
            }
            function latest_post() {
                //         $qry = $this->db->query('SELECT post.postID,post.productCategoryID,post.postSubmissionOn,trader.traderID,trader.traderFullName,trader.traderLocation,trader.traderImage,trader.usertype,post.productID,
                // productcar.productCPrice ,`productcar`.`productCCallPrice`,productcar.Cpost_main_img ,concat(productcar.productCBrand, " ",productcar.productCModel) as product_name1,productcar.cartCType, 
                //      productbike.productBPrice ,`productbike`.`productBCallPrice`,productbike.Bpost_main_img ,concat(productbike.productBBrand, " ",productbike.productBModel) as product_name2,productbike.cartBType ,
                //       productboat.productBTPrice ,`productboat`.`productBtCallPrice`,productboat.BTpost_main_img ,concat(productboat.productBtBrand," ",productboat.productBtModel) as product_name7,productboat.cartBTType ,
                //       productwatch.productWPrice ,`productwatch`.`productWCallPrice`,productwatch.Wpost_main_img ,concat(productwatch.productWBrand," ",productwatch.productWModel) as product_name5,productwatch.cartWType ,
                //       productvertu.productVPrice ,`productvertu`.`productVCallPrice`,productvertu.Vpost_main_img ,concat(productvertu.productVBrand," ",productvertu.productVModel) as product_name4,productvertu.cartVType ,
                //       productproperty.productPRPrice ,`productproperty`.`productPropCallPrice`,productproperty.PRpost_main_img ,concat(productproperty.productPropSC," ",productproperty.productPropType) as product_name9,productproperty.cartPRType ,
                //       productphone.productPHPrice ,`productphone`.`productPhCallPrice`,productphone.PHpost_main_img ,concat(productphone.productPBrand," ",productphone.productPModel) as product_name8,productphone.cartPHType ,
                //     productnp.productNPPrice ,`productnp`.`productNPCallPrice`,productnp.NPpost_main_img,concat(productnp.productNPCode," ",productnp.productNPNmbr) as product_name3,productnp.productNPDigits,productnp.cartNPType ,
                //       productmn.productMNPrice ,`productmn`.`productMNCallPrice`,productmn.MNpost_main_img ,productmn.productMNDigits,concat(productmn.productMNPrefix," ",productmn.productMNNmbr) as product_name6,productmn.cartMNType  FROM `post`
                //         left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
                       
                //         left join productcar on (post.productCategoryID=productcar.productCategoryID and post.productID=productcar.productID)
                //         left join productbike on (post.productCategoryID=productbike.productCategoryID and post.productID=productbike.productID)
                //         left join productboat on (post.productCategoryID=productboat.productCategoryID and post.productID=productboat.productID)
                //         left join productmn on (post.productCategoryID=productmn.productCategoryID and post.productID=productmn.productID)
                //         left join productnp on (post.productCategoryID=productnp.productCategoryID and post.productID=productnp.productID)
                //         left join productphone on (post.productCategoryID=productphone.productCategoryID and post.productID=productphone.productID)
                //         left join productproperty on (post.productCategoryID=productproperty.productCategoryID and post.productID=productproperty.productID)
                //         left join productvertu on (post.productCategoryID=productvertu.productCategoryID and  post.productID=productvertu.productID)
                //         left join productwatch on (post.productCategoryID=productwatch.productCategoryID and post.productID=productwatch.productID) 
                //         where   (post.postStatus=1 and (productcar.productCStatus!=3)) or (post.postStatus=1 and (productbike.productBStatus!=1 and productbike.productBStatus!=3)) or (post.postStatus=1 and (productboat.productBTStatus!=1 and productboat.productBTStatus!=3)) or (post.postStatus=1 and (productnp.productNPStatus!=1 and productnp.productNPStatus!=3) ) or (post.postStatus=1 and (productvertu.productVStatus!=1 and productvertu.productVStatus!=3) )or (post.postStatus=1 and (productwatch.productWStatus!=1 and productwatch.productWStatus!=3)) or (post.postStatus=1 and (productmn.productMNStatus!=1 and productmn.productMNStatus!=3)) or (post.postStatus=1 and (productphone.productPHStatus!=1 and productphone.productPHStatus!=3)) or (post.postStatus=1 and (productproperty.productPRStatus!=1 and productproperty.productPRStatus!=3) ) order by post.postSubmissionOn DESC limit 
                //         8');
                        $qry = $this->db->query('SELECT post.postID,post.productCategoryID,post.postSubmissionOn,trader.traderID,trader.traderFullName,trader.traderLocation,trader.traderImage,trader.usertype,post.productID,
                        productcar.productCPrice ,`productcar`.`productCCallPrice`,productcar.Cpost_main_img ,concat(productcar.productCBrand, " ",productcar.productCModel) as product_name1,productcar.cartCType, 
                             productbike.productBPrice ,`productbike`.`productBCallPrice`,productbike.Bpost_main_img ,concat(productbike.productBBrand, " ",productbike.productBModel) as product_name2,productbike.cartBType ,
                              productboat.productBTPrice ,`productboat`.`productBtCallPrice`,productboat.BTpost_main_img ,concat(productboat.productBtBrand," ",productboat.productBtModel) as product_name7,productboat.cartBTType ,
                              productwatch.productWPrice ,`productwatch`.`productWCallPrice`,productwatch.Wpost_main_img ,concat(productwatch.productWBrand," ",productwatch.productWModel) as product_name5,productwatch.cartWType ,
                              productvertu.productVPrice ,`productvertu`.`productVCallPrice`,productvertu.Vpost_main_img ,concat(productvertu.productVBrand," ",productvertu.productVModel) as product_name4,productvertu.cartVType ,
                              productproperty.productPRPrice ,`productproperty`.`productPropCallPrice`,productproperty.PRpost_main_img ,concat(productproperty.productPropSC," ",productproperty.productPropType) as product_name9,productproperty.cartPRType ,
                              productphone.productPHPrice ,`productphone`.`productPhCallPrice`,productphone.PHpost_main_img ,concat(productphone.productPBrand," ",productphone.productPModel) as product_name8,productphone.cartPHType ,
                            productnp.productNPPrice ,`productnp`.`productNPCallPrice`,productnp.NPpost_main_img,concat(productnp.productNPCode," ",productnp.productNPNmbr) as product_name3,productnp.productNPDigits,productnp.cartNPType ,
                              productmn.productMNPrice ,`productmn`.`productMNCallPrice`,productmn.MNpost_main_img ,productmn.productMNDigits,concat(productmn.productMNPrefix," ",productmn.productMNNmbr) as product_name6,productmn.cartMNType  FROM `post`
                                left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
                               
                                left join productcar on (post.productCategoryID=productcar.productCategoryID and post.productID=productcar.productID)
                                left join productbike on (post.productCategoryID=productbike.productCategoryID and post.productID=productbike.productID)
                                left join productboat on (post.productCategoryID=productboat.productCategoryID and post.productID=productboat.productID)
                                left join productmn on (post.productCategoryID=productmn.productCategoryID and post.productID=productmn.productID)
                                left join productnp on (post.productCategoryID=productnp.productCategoryID and post.productID=productnp.productID)
                                left join productphone on (post.productCategoryID=productphone.productCategoryID and post.productID=productphone.productID)
                                left join productproperty on (post.productCategoryID=productproperty.productCategoryID and post.productID=productproperty.productID)
                                left join productvertu on (post.productCategoryID=productvertu.productCategoryID and  post.productID=productvertu.productID)
                                left join productwatch on (post.productCategoryID=productwatch.productCategoryID and post.productID=productwatch.productID) 
                                where   (post.postStatus=1 and (productcar.productCStatus=0)) or (post.postStatus=1 and (productbike.productBStatus=0)) or (post.postStatus=1 and (productboat.productBTStatus=0)) or (post.postStatus=1 and (productnp.productNPStatus=0) ) or (post.postStatus=1 and (productvertu.productVStatus=0) )or (post.postStatus=1 and (productwatch.productWStatus=0)) or (post.postStatus=1 and (productmn.productMNStatus=0)) or (post.postStatus=1 and (productphone.productPHStatus=0)) or (post.postStatus=1 and (productproperty.productPRStatus=0) ) order by post.postID DESC limit 
                                8');
                
                foreach ($qry->result() as $row) {
                   
                
                
                    if ($row->productCategoryID == 1) {
                        $row->CallPrice = $row->productCCallPrice;
                      
                    } else if ($row->productCategoryID == 2) {
                        $row->CallPrice = $row->productBCallPrice;
                     
                    } else if ($row->productCategoryID == 3) {
                        $row->CallPrice= $row->productNPCallPrice;
                    
                    } else if ($row->productCategoryID == 4) {
                        $row->CallPrice = $row->productVCallPrice;
                  
                    } else if ($row->productCategoryID == 5) {
                        $row->CallPrice= $row->productWCallPrice;
                 
                    } else if ($row->productCategoryID  == 6) {
                        $row->CallPrice= $row->productMNCallPrice;
                     
                    } else if ($row->productCategoryID == 7) {
                        $row->CallPrice = $row->productBtCallPrice;
                    
                    } else if ($row->productCategoryID  == 8) {
                        $row->CallPrice = $row->productPhCallPrice;
                 
                    } else if ($row->productCategoryID  == 9) {
                        $row->CallPrice = $row->productPropCallPrice;
                   
                    } else {
                        $row->CallPrice= "";
                   
                    }
                
                
                
                    $row_post[] = $row;
                    $data = '';
                }
                return $row_post;
                       
                    }
    // function get_template_code($emirates) {

    //     $this->db->select('code');
    //     $this->db->from('noplate_template');
    //     $this->db->where('noplateTempID', $emirates);
    //     //$this->db->where('emirates', $emirates);
    //     $temp_img_qry = $this->db->get();
    //     $code_res = $temp_img_qry->result();
    //     $res = $code_res[0]->code;
    //     $code_arr = explode(',', $res);
    //     foreach ($code_arr as $k) {
    //         $cities[$k] = $k;
    //     }
    //     return $cities;
    //     //return $temp_img_qry->result();
    // }
    function get_template_code($emirates) {

        $this->db->select('code');
        $this->db->from('noplate_template');
        if (!ctype_digit($emirates)) $this->db->where('emirates', $emirates);
        else $this->db->where('noplateTempID', $emirates);
        $this->db->limit(1);
        $query = $this->db->get();
        $result = $query->row();
        $res = $result->code;
       
        $code_arr = explode(',', $res);
        foreach ($code_arr as $k) {
            $cities[$k] = $k;
        }
        return $cities;
    }
    function category_count($cat) {
        $qry = $this->db->query('select categoryProductCount from category where productCategoryID=' . $cat);
        return $qry->result();
    }

    function trader_post_count($trader_id) {
        $traderqry = $this->db->query('select traderPostCount from trader where traderID=' . $trader_id);
        return $traderqry->result();
    }

    function get_templates() {
        $template_qry = $this->db->query('select * from noplate_template');
        return $template_qry->result();
    }
    function get_subproperties($category_id) {
        $sub_prop_qry = $this->db->query('select distinct brandID,brandName from category_subtypes where productCategoryID=' . $category_id);
        return $sub_prop_qry->result();
    }
    function fetch_edit_property($product_id, $category_id) {
        $qry = $this->db->query('SELECT   productiv.productImage,productiv.productVideo,post.postID,post.productCategoryID,post.productID,
          productproperty.productPRPrice,productproperty.PRpost_main_img,productproperty.productPropSC,productproperty.productPropType,productproperty.productDesc,productproperty.productPropCallPrice,productiv.thumbVideo,productproperty.productCategoryName,
           trader.traderID FROM `post`
            left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
         
            left JOIN `productiv` ON (`post`.`postID`=`productiv`.`postID` and post.productCategoryID=productiv.productCategoryID)
          
            left join productproperty on (post.productCategoryID=productproperty.productCategoryID and post.productID=productproperty.productID)
           
            where post.productID=' . $product_id . ' and post.productCategoryID=' . $category_id);
        return $qry->result();
    }
    function get_brandname_prop($product_id) {
        $this->db->select('productPropSC');
        $this->db->from('productproperty');
        $this->db->where('productID', $product_id);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $result = $query->result();
            foreach ($result as $row) {
                return $row->productPropSC;
            }
        } else {
            return false;
        }
    }
    // function get_mobprefix($mob_oper)
    // {
       
    //     $query = $this->db->query("select * from category_subtypes where brandName='".$mob_oper."'");
    //      $cities = array();
 
    //      if ($query->result()) {
    //          foreach ($query->result() as $city) {
    //              $cities[$city->modelName] = $city->modelName;
    //          }
    //          return $cities;
    //      } else {
    //          return FALSE;
    //      }
    // }
    function get_template_imgs2($emirates) {

        $this->db->select('templates');
        $this->db->from('noplate_template');
        $this->db->where('noplateTempID', $emirates);
        $temp_img_qry = $this->db->get();
        //$temp_img_qry=$this->db->query('select templates from noplate_template where emirates='.$emirates);
        return $temp_img_qry->result();
    }
    function get_template_imgs($emirates,$type) {
        if($type==1&&$emirates<8)$emirates=$emirates+7;
        $this->db->select('templates,long_template');
        $this->db->from('noplate_template');
        $this->db->where('noplateTempID', $emirates);
        $this->db->where('type', $type);
        $temp_img_qry = $this->db->get();
        //$temp_img_qry=$this->db->query('select templates from noplate_template where emirates='.$emirates);
        return $temp_img_qry->result();
    }
    function categories() {
        $qry = $this->db->query('SELECT productCategoryID as catid,(select count(*) from post where productCategoryID=catid) as cnt,(select category_name from category where productCategoryID=catid) as cat_name FROM ( (SELECT * FROM productcar) UNION (SELECT * FROM productbike) UNION (SELECT * FROM productboat) UNION (SELECT * FROM productmn) UNION (SELECT * FROM productnp) UNION (SELECT * FROM productphone) UNION (SELECT * FROM productproperty) UNION (SELECT * FROM productvertu) UNION (SELECT * FROM productwatch)) a group by productCategoryID');
        return $qry->result();
    }

    function get_post_catid($category_id) {
        $this->db->select('post.postID,trader.traderFullName,trader.traderImage,trader.traderLocation,productcar.productCSubmitDate,productcar.productPrice,
        productbike.productBSubmitDate,productbike.productPrice,
        productboat.productBSubmitDate,productboat.productPrice,
        productwatch.productWSubmitDate,productwatch.productPrice,
        productvertu.productVSubmitDate,productvertu.productPrice,
        productproperty.productSubmitDate,productproperty.productPrice,
        productphone.productPSubmitDate,productphone.productPrice,
        productnp.productNPSubmitDate,productnp.productNPPrice,
        productmn.productMNSubmitDate,productmn.productMNPrice');
        $this->db->join('trader', 'product.traderID=trader.traderID');
        $this->db->join('productcar', 'post.productCategoryID=productcar.productCategoryID');
        $this->db->join('productbike', 'post.productCategoryID=productbike.productCategoryID');
        $this->db->join('productboat', 'post.productCategoryID=productboat.productCategoryID');
        $this->db->join('productmn', 'post.productCategoryID=productmn.productCategoryID');
        $this->db->join('productnp', 'post.productCategoryID=productnp.productCategoryID');
        $this->db->join('productphone', 'post.productCategoryID=productphone.productCategoryID');
        $this->db->join('productproperty', 'post.productCategoryID=productproperty.productCategoryID');
        $this->db->join('productvertu', 'post.productCategoryID=productvertu.productCategoryID');
        $this->db->join('productwatch', 'post.productCategoryID=productwatch.productCategoryID');
        $this->db->where('post.productCategoryID', $category_id);
        $qry = $this->db->get();
        return $qry->result();
    }


    function get_post_traderid($trader_id, $per_page_cnt, $limit) {
        $qry = $this->db->query('SELECT DISTINCT `post`.`traderID`,`post`.`postID`,post.productCategoryID,post.productID,productiv.productViewCount ,
        `productcar`.`productCBrand`,`productcar`.`cartCType`  ,DATE_FORMAT(productcar.productCSubmitDate,"%d %b %Y") as publishedCOn ,`productcar`.`productCCallPrice`, `productcar`.`productCModel`,productcar.productCReleaseYear, `productcar`.`productCPrice`,productcar.productCStatus,productcar.productCDesc,productcar.Cpost_main_img,
        `productbike`.`productBBrand`,`productbike`.`cartBType` ,`productbike`.`productBCallPrice`, `productbike`.`productBModel`, DATE_FORMAT(productbike.productBSubmitDate,"%d %b %Y") as publishedBOn,productbike.productBReleaseYear as Bikeyear, `productbike`.`productBPrice`,productbike.productBStatus,productbike.Bpost_main_img,productbike.productBDesc as bike,
        `productboat`.`productBtBrand`,`productboat`.`cartBTType` ,DATE_FORMAT(productboat.productBTSubmitDate,"%d %b %Y") as publishedBtOn,`productboat`.`productBtCallPrice`, `productboat`.`productBtModel`, `productboat`.`productBTSubmitDate`,productboat.productBReleaseYear, `productboat`.`productBTPrice`,productboat.productBTStatus,productboat.productBDesc,productboat.BTpost_main_img, 
        `productwatch`.`productWBrand`,`productwatch`.`cartWType` ,DATE_FORMAT(productwatch.productWSubmitDate,"%d %b %Y") as publishedWOn,`productwatch`.`productWCallPrice`, `productwatch`.`productWModel`, `productwatch`.`productWSubmitDate`, `productwatch`.`productWPrice`,productwatch.productWStatus,productwatch.productWDesc,productwatch.Wpost_main_img,
        `productvertu`.`productVBrand`,`productvertu`.`cartVType` ,DATE_FORMAT(productvertu.productVSubmitDate,"%d %b %Y") as publishedVOn,`productvertu`.`productVCallPrice`, `productvertu`.`productVModel`, `productvertu`.`productVSubmitDate`, `productvertu`.`productVPrice`,productvertu.productVStatus,productvertu.productVDesc,productvertu.Vpost_main_img, 
        `productproperty`.`productPropSC`,`productproperty`.`cartPRType` ,DATE_FORMAT(productproperty.productPRSubmitDate,"%d %b %Y") as publishedPROn ,`productproperty`.`productPropCallPrice`,`productproperty`.`productPropType`,  `productproperty`.`productPRSubmitDate`, `productproperty`.`productPRPrice`,productproperty.productPRStatus,productproperty.productDesc,productproperty.PRpost_main_img, 
        `productphone`.`productPBrand`,`productphone`.`cartPHType` ,DATE_FORMAT(productphone.productPSubmitDate,"%d %b %Y") as publishedPOn,`productphone`.`productPhCallPrice`, `productphone`.`productPModel`, `productphone`.`productPSubmitDate`, `productphone`.`productPHPrice`,productphone.productPHStatus,productphone.productPDesc,productphone.PHpost_main_img,
        `productnp`.`productNPCode`,`productnp`.`cartNPType` ,DATE_FORMAT(productnp.productNPSubmitDate,"%d %b %Y") as publishedNPOn,`productnp`.`productNPCallPrice`, `productnp`.`productNPDigits`, `productnp`.`productNPSubmitDate`, `productnp`.`productNPPrice`,productnp.productNPStatus,productnp.productNPDesc,productnp.NPpost_main_img,productnp.productNPNmbr,productnp.productNPEmrites,
        `productmn`.`productMNPrefix`,`productmn`.`cartMNType` ,DATE_FORMAT(productmn.productMNSubmitDate,"%d %b %Y") as publishedMNOn,`productmn`.`productMNCallPrice`, `productmn`.`productMNNmbr`, `productmn`.`productMNSubmitDate`, `productmn`.`productMNPrice`,productmn.productMNStatus,productmn.productMNDesc,productmn.MNpost_main_img,productmn.productOperator
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
        WHERE `post`.`traderID` = ' . $trader_id . ' order by post.postSubmissionOn DESC   limit ' . $per_page_cnt . ' offset ' . $limit);

        foreach ($qry->result() as $row) {
        $data['postId'] = $row->postID;
        $data['categoryId'] = $row->productCategoryID;
        $data['ProductId'] = $row->productID;
        $data['views'] = $row->productViewCount;

       
       
        $data['IsAlshamilProduct'] = $row->cartMNType;
        if ($data['categoryId'] == 1) {
            $data['image'] = $row->Cpost_main_img;
            $data['price'] = $row->productCPrice;
            $data['titleEn'] = $row->productCBrand . " " . $row->productCModel;
            $data['titleAr'] = "";
            $data['brandNameEn'] = $row->productCBrand;
            $data['brandNameAr'] = "";
            $data['modelNameEn'] = $row->productCModel;
            $data['modelNameAr'] = "";
            $data['year'] = $row->productCReleaseYear;
            $data['descriptionEn'] = $row->productCDesc;
            $data['descriptionAr'] = "";
            $data['status'] = $row->productCStatus;
            $data['CallPrice'] = $row->productCCallPrice;
            $data['publishedOn'] = $row->publishedCOn;
            $data['IsAlshamilProduct'] = $row->cartCType;
        } else if ($data['categoryId'] == 2) {

            $data['image'] = $row->Bpost_main_img;
            $data['year'] = $row->Bikeyear;
            $data['price'] = $row->productBPrice;
            $data['titleEn'] = $row->productBBrand . " " . $row->productBModel;
            $data['titleAr'] = "";
            $data['brandNameEn'] = $row->productBBrand;
            $data['brandNameAr'] = "";
            $data['modelNameEn'] = $row->productBModel;
            $data['modelNameAr'] = "";
            $data['descriptionEn'] = $row->bike;
            $data['descriptionAr'] = "";
            $data['status'] = $row->productBStatus;
            $data['CallPrice'] = $row->productBCallPrice;
            $data['publishedOn'] = $row->publishedBOn;
            $data['IsAlshamilProduct'] = $row->cartBType;
        } else if ($data['categoryId'] == 3) {
            $data['image'] = $row->NPpost_main_img;
            $data['price'] = $row->productNPPrice;
            $data['titleEn'] = $row->productNPCode . " " . $row->productNPNmbr;
            $data['titleAr'] = "";
            $data['brandNameEn'] = $row->productNPEmrites;
            $data['brandNameAr'] = "";
            $data['modelNameEn'] = $row->productNPCode;
            $data['modelNameAr'] = "";
            $data['number'] = $row->productNPNmbr;
            $data['digits'] = $row->productNPDigits;
            $data['descriptionEn'] = $row->productNPDesc;
            $data['descriptionAr'] = "";
            $data['status'] = $row->productNPStatus;
            $data['CallPrice'] = $row->productNPCallPrice;
            $data['publishedOn'] = $row->publishedNPOn;
            $data['year'] = "";
            $data['IsAlshamilProduct'] = $row->cartNPType;
        } else if ($data['categoryId'] == 4) {

            $data['image'] = $row->Vpost_main_img;
            $data['price'] = $row->productVPrice;
            $data['titleEn'] = $row->productVBrand . " " . $row->productVModel;
            $data['titleAr'] = "";
            $data['brandNameEn'] = $row->productVBrand;
            $data['brandNameAr'] = "";
            $data['modelNameEn'] = $row->productVModel;
            $data['modelNameAr'] = "";
            $data['descriptionEn'] = $row->productVDesc;
            $data['descriptionAr'] = "";
            $data['status'] = $row->productVStatus;
            $data['CallPrice'] = $row->productVCallPrice;
            $data['publishedOn'] = $row->publishedVOn;
            $data['year'] = "";
            $data['IsAlshamilProduct'] = $row->cartVType;
         
        } else if ($data['categoryId'] == 5) {

            $data['image'] = $row->Wpost_main_img;
            $data['price'] = $row->productWPrice;
            $data['titleEn'] = $row->productWBrand . " " . $row->productWModel;
            $data['titleAr'] = "";
            $data['brandNameEn'] = $row->productWBrand;
            $data['brandNameAr'] = "";
            $data['modelNameEn'] = $row->productWModel;
            $data['modelNameAr'] = "";
            $data['descriptionEn'] = $row->productWDesc;
            $data['descriptionAr'] = "";
            $data['status'] = $row->productWStatus;
            $data['CallPrice'] = $row->productWCallPrice;
            $data['publishedOn'] = $row->publishedWOn;
            $data['year'] = "";
            $data['IsAlshamilProduct'] = $row->cartWType;
        } else if ($data['categoryId'] == 6) {

            $data['image'] = $row->MNpost_main_img;
            $data['price'] = $row->productMNPrice;
            $data['titleEn'] = $row->productOperator . " " . $row->productMNNmbr;
            $data['titleAr'] = "";
            $data['brandNameEn'] = $row->productOperator;
            $data['brandNameAr'] = "";
            $data['modelNameEn'] = $row->productMNPrefix;
            $data['modelNameAr'] = "";
            $data['number'] = $row->productMNNmbr;
            $data['digits'] = $row->productMNDigits;
            $data['descriptionEn'] = $row->productMNDesc;
            $data['descriptionAr'] = "";
            $data['status'] = $row->productMNStatus;
            $data['CallPrice'] = $row->productMNCallPrice;
            $data['publishedOn'] = $row->publishedMNOn;
            $data['year'] = "";
            $data['IsAlshamilProduct'] = $row->cartMNType;
        
           
        } else if ($data['categoryId'] == 7) {

            $data['image'] = $row->BTpost_main_img;

            $data['price'] = $row->productBTPrice;
            $data['titleEn'] = $row->productBtBrand . " " . $row->productBtModel;
            $data['titleAr'] = "";
            $data['brandNameEn'] = $row->productBtBrand;
            $data['brandNameAr'] = "";
            $data['modelNameEn'] = $row->productBtModel;
            $data['modelNameAr'] = "";
            $data['descriptionEn'] = $row->productBDesc;
            $data['descriptionAr'] = "";
            $data['status'] = $row->productBTStatus;
            $data['CallPrice'] = $row->productBtCallPrice;
            $data['publishedOn'] = $row->publishedBtOn;
            $data['year'] = "";
            $data['IsAlshamilProduct'] = $row->cartBTType;
            
         
        } else if ($data['categoryId'] == 8) {

            $data['image'] = $row->PHpost_main_img;
        //                $data['publishedOn'] = $row->productPSubmitDate;
            $data['price'] = $row->productPHPrice;
            $data['titleEn'] = $row->productPBrand . " " . $row->productPModel;
            $data['titleAr'] = "";
            $data['brandNameEn'] = $row->productPBrand;
            $data['brandNameAr'] = "";
            $data['modelNameEn'] = $row->productPModel;
            $data['modelNameAr'] = "";
            $data['descriptionEn'] = $row->productPDesc;
            $data['descriptionAr'] = "";
            $data['status'] = $row->productPHStatus;
            $data['CallPrice'] = $row->productPhCallPrice;
            $data['publishedOn'] = $row->publishedPOn;
            $data['year'] = "";

            $data['IsAlshamilProduct'] = $row->cartPHType;
        } else if ($data['categoryId'] == 9) {

            $data['image'] = $row->PRpost_main_img;
            $data['price'] = $row->productPRPrice;
            $data['titleEn'] = $row->productPropType . " " . $row->productPropSC;
            $data['titleAr'] = "";
            $data['brandNameEn'] = $row->productPropSC;
            $data['brandNameAr'] = "";
            $data['modelNameEn'] = $row->productPropType;
            $data['modelNameAr'] = "";
            $data['descriptionEn'] = $row->productDesc;
            $data['descriptionAr'] = "";
            $data['status'] = $row->productPRStatus;
            $data['CallPrice'] = $row->productPropCallPrice;
            $data['publishedOn'] = $row->publishedPROn;
            $data['year'] = "";

            $data['IsAlshamilProduct'] = $row->cartPRType;
        } else {

            $data['image'] = "";
            $data['price'] = "";
            $data['titleEn'] = "";
            $data['titleAr'] = "";
            $data['descriptionEn'] = "";
            $data['descriptionAr'] = "";
            $data['status'] = "";
            $data['brandNameEn'] = "";
            $data['brandNameAr'] = "";
            $data['modelNameEn'] = "";
            $data['modelNameAr'] = "";
            $data['year'] = "";
        }
  
        $data['Model'] =$data['modelNameEn'];
       


        $row_post[] = $data;
        $data = '';
        }
        return $row_post;
    }

    function addtofavourite($traderId,$postId) {
        $cartcnt = 1;
        $i = 1;

        $prod_avail = 0;
         //$data = array('cartlistID'=>$i++,'customerID'=>$trader_id,'productID'=>$prod_id,'cartlistCount'=>$cartcnt,'productAvailability'=>$prod_avail);
        if(!$this->db->get_where('watchlist',array('userID' => $traderId,'postID' => $postId),1)->result()){
            $data = array('userID' => $traderId,'postID' => $postId);
            $this->db->insert('watchlist', $data);
            return 1;
        }else{
            return 0;
        }
        
    }

    function get_latestpost($limit, $per_page_cnt) {
        $qry = $this->db->query('SELECT *,traderID as tr,productID as pr,(select trader.traderFullName from trader where trader.traderID=tr) as trader_name,(select trader.traderImage from trader where trader.traderID=tr) as trader_img,(select trader.traderLocation from trader where trader.traderID=tr) as trader_loc FROM ( (SELECT * FROM productcar) UNION (SELECT * FROM productbike) UNION (SELECT * FROM productboat) UNION (SELECT * FROM productmn) UNION (SELECT * FROM productnp) UNION (SELECT * FROM productphone) UNION (SELECT * FROM productproperty) UNION (SELECT * FROM productvertu) UNION (SELECT * FROM productwatch)) a ORDER BY a.post_date desc limit ' . $limit . ' offset ' . $per_page_cnt);
        return $qry->result();
    }

    function brandmodel() {
        $c1 = $this->db->query('select  distinct brandName from category_subtypes where productCategoryId=1');
        $c2 = $c1->result();
        $c3 = $this->db->query('select  distinct modelName from category_subtypes where productCategoryId=1');
        $c4 = $c3->result();


        $b1 = $this->db->query('select  distinct brandName from category_subtypes where productCategoryId=2');
        $b2 = $b1->result();
        $b3 = $this->db->query('select  distinct modelName from category_subtypes where productCategoryId=2');
        $b4 = $b3->result();


        $v1 = $this->db->query('select  distinct brandName from category_subtypes where productCategoryId=4');
        $v2 = $v1->result();
        $v3 = $this->db->query('select  distinct modelName from category_subtypes where productCategoryId=4');
        $v4 = $v3->result();


        $w1 = $this->db->query('select  distinct brandName from category_subtypes where productCategoryId=5');
        $w2 = $w1->result();
        $w3 = $this->db->query('select  distinct modelName from category_subtypes where productCategoryId=5');
        $w4 = $w3->result();


        $bt1 = $this->db->query('select  distinct brandName from category_subtypes where productCategoryId=7');
        $bt2 = $bt1->result();
        $bt3 = $this->db->query('select  distinct modelName from category_subtypes where productCategoryId=7');
        $bt4 = $bt3->result();

        $ph1 = $this->db->query('select  distinct brandName from category_subtypes where productCategoryId=8');
        $ph2 = $ph1->result();
        $ph3 = $this->db->query('select  distinct modelName from category_subtypes where productCategoryId=8');
        $ph4 = $ph3->result();


        return array(
            'carbrands' => $c2,
            'carmodels' => $c4,
            'bikebrands' => $b2,
            'bikemodels' => $b4,
            'vertubrands' => $v2,
            'vertumodels' => $v4,
            'watchbrands' => $w2,
            'watchmodels' => $w4,
            'boatbrands' => $bt2,
            'boatmodels' => $bt4,
            'phonebrands' => $ph2,
            'phonemodels' => $ph4,
        );
    }

    function mdl_prod_det2($product_id) {
        $this->db->where('productID', $product_id);
        $qry = $this->db->get('product');
        return $qry->result();
    }
    function mdl_prod_det($product_id, $cat_id) {
        $qry = $this->db->query('SELECT distinct concat(productcar.productCBrand," ",productcar.productCModel) as product_name1,
concat(productbike.productBBrand," ",productbike.productBModel) as product_name2,
concat(productnp.productNPCode," ",productnp.productNPNmbr) as product_name3,
concat(productvertu.productVBrand," ",productvertu.productVModel) as product_name4,
concat(productwatch.productWBrand," ",productwatch.productWModel) as product_name5,
concat(productboat.productBtBrand," ",productboat.productBtModel) as product_name6,
concat(productmn.productMNPrefix," ",productmn.productMNNmbr) as product_name7,
concat(productproperty.productPropSC," ",productproperty.productPropType) as product_name8,
concat(productphone.productPBrand," ",productphone.productPModel) as product_name9,
`productcar`.`productCPrice`,productcar.Cpost_main_img,`productbike`.`productBPrice`,productbike.Bpost_main_img,
productboat.`productBTPrice`,productboat.BTpost_main_img, `productwatch`.`productWPrice`,productwatch.Wpost_main_img,`productvertu`.`productVPrice`,productvertu.Vpost_main_img,
productproperty.productPRPrice,productproperty.PRpost_main_img,
productnp.productNPPrice,productnp.NPpost_main_img,productnp.productNPTemplate,
productmn.productMNPrice,productmn.MNpost_main_img,productphone.productPHPrice,productphone.PHpost_main_img
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
        where post.productID=' . $product_id . ' and post.productCategoryID=' . $cat_id);
        return $qry->result();
    }

    function get_brand_car($category) {
        $query = $this->db->query('select  distinct brandID,brandName from category_subtypes where productCategoryID = ' . $category);
        /* $this->db->select('brand');
          $this->db->from('car_bike');
          $this->db->where('parent_cat_id', '1');
          $query = $this->db->get(); */
        return $query->result();
    }

    function get_brand_bike($category) {
        $query = $this->db->query('select distinct brandName,brandID from category_subtypes where productCategoryID = ' . $category);
        return $query->result();
    }

    function get_brand_watch($category) {
        $query = $this->db->query('select  distinct brandID,brandName from category_subtypes where productCategoryID = ' . $category);

        return $query->result();
    }

    function get_brand_phone($category) {
        $query = $this->db->query('select  distinct brandID,brandName from category_subtypes where productCategoryID = ' . $category);

        return $query->result();
    }

    function get_brand_vertu($category) {
        $query = $this->db->query('select distinct brandName,brandID from category_subtypes where productCategoryID = ' . $category);
        return $query->result();
    }

    function get_brand_boat($category) {
        $query = $this->db->query('select distinct brandName,brandID from category_subtypes where productCategoryID = ' . $category);
        return $query->result();
    }

    function get_model_boat($brand) {
        $this->db->select('modelID,modelName');
        $this->db->from('category_subtypes');
        $this->db->where('brandID', $brand);
        //$this->db->where('brand_id', $brand);
        $query = $this->db->get();
        $cities = array();

        if ($query->result()) {
            foreach ($query->result() as $city) {
                $cities[$city->modelID] = $city->modelName;
            }
            return $cities;
        } else {
            return FALSE;
        }
    }

    function get_model_vertu($brand) {
        $this->db->select('modelID,modelName');
        $this->db->from('category_subtypes');
        $this->db->where('brandID', $brand);
        //$this->db->where('brand_id', $brand);
        $query = $this->db->get();
        $cities = array();

        if ($query->result()) {
            foreach ($query->result() as $city) {
                $cities[$city->modelID] = $city->modelName;
            }
            return $cities;
        } else {
            return FALSE;
        }
    }

    function srch_brand_car($category) {
        /* if($category == '1')
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
          } */
        $query = $this->db->query('select distinct brand,brand_id from car_bike where parent_cat_id = ' . $category);
        $cities = array();

        if ($query->result()) {
            foreach ($query->result() as $city) {
                //$cities[$city->brand_id] = $city->brand;
                $cities[$city->brand] = $city->brand;
            }
            return $cities;
        } else {
            return FALSE;
        }
    }

    function get_categories() {
        $query = $this->db->get('category');
        return $query->result();
    }

    function get_model_car($brand) {
        $this->db->select('modelID,modelName');
        $this->db->from('category_subtypes');
        $this->db->where('brandID', $brand);
        //$this->db->where('brand_id', $brand);
        $query = $this->db->get();
        $cities = array();

        if ($query->result()) {
            foreach ($query->result() as $city) {
                $cities[$city->modelID] = $city->modelName;
            }
            return $cities;
        } else {
            return FALSE;
        }
    }

    function get_model_bike($brand) {
        $this->db->select('modelID,modelName');
        $this->db->from('category_subtypes');
        $this->db->where('brandID', $brand);
        //$this->db->where('brand_id', $brand);
        $query = $this->db->get();
        $cities = array();

        if ($query->result()) {
            foreach ($query->result() as $city) {
                $cities[$city->modelID] = $city->modelName;
            }
            return $cities;
        } else {
            return FALSE;
        }
    }

    function get_model_watch($brand) {
        $this->db->select('modelID,modelName');
        $this->db->from('category_subtypes');
        $this->db->where('brandID', $brand);

        $query = $this->db->get();
        $cities = array();

        if ($query->result()) {
            foreach ($query->result() as $city) {
                $cities[$city->modelID] = $city->modelName;
            }
            return $cities;
        } else {
            return FALSE;
        }
    }

    function get_model_phone($brand) {
        $this->db->select('modelID,modelName');
        $this->db->from('category_subtypes');
        $this->db->where('brandID', $brand);

        $query = $this->db->get();
        $cities = array();

        if ($query->result()) {
            foreach ($query->result() as $city) {
                $cities[$city->modelID] = $city->modelName;
            }
            return $cities;
        } else {
            return FALSE;
        }
    }

    function prod_addto_cart($product_id, $post_id, $category_id) {
        $cartcnt = 1;


        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $prod_avail = 0;

        $data = array('traderID' => $trader_id, 'postID' => $post_id, 'productCategoryID' => $category_id, 'productID' => $product_id, 'cartlistCount' => $cartcnt, 'productAvailability' => $prod_avail);
        $this->db->insert('cartlist', $data);
    }
    function prd_exit_cart($post_id) {
        $session_data = $this->session->userdata('logged_in');
        $add_user_id = $session_data['trader_id'];
        $this->db->where('postID', $post_id);
        $this->db->where('userID', $add_user_id);
        $qry = $this->db->get('cartlist');
        return $qry->result();
    }

    function prd_exit_watch($post_id) {
        $session_data = $this->session->userdata('logged_in');
        $add_user_id = $session_data['trader_id'];
        $this->db->where('postID', $post_id);
        $this->db->where('userID', $add_user_id);
        $qry = $this->db->get('watchlist');
        return $qry->result();
    }
    function cart_cnt() {
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $this->db->where('traderID', $trader_id);
        $this->db->where('productID !=', 0);
        $this->db->select('sum(cartlistCount) as cartlistCount');
        $cart_qry = $this->db->get('cartlist');
        return $cart_qry->result();
    }
    function check_order_exist($chk_uid) {
        $qry = $this->db->query('select * from order_items where orderUserID=' . $chk_uid . ' and status=0');
        return $qry->result();
    }

    function cartCount() {
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $this->db->where('userID', $trader_id);
        $this->db->where('productID !=', 0);
        $this->db->select('count(*) as cartlistCount');
        $cart_qry = $this->db->get('cartlist');
        $result = $cart_qry->row();
        return $result->cartlistCount;
    }
    function watchCount() {
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $this->db->where('userID', $trader_id);
        $this->db->where('productID !=', 0);
        $this->db->select('count(*) as watchlistCount');
        $watch_qry = $this->db->get('watchlist');
        $result = $watch_qry->row();
        return $result->watchlistCount;
    }

    function getAvr($id) {
        $this->db->select('traderImage');
        $this->db->from('trader');
        $this->db->where('traderID', $id);
        $query = $this->db->get();
        $result = $query->row();
        return $result->traderImage;
    }
    function cart_details() {
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
        WHERE `cartlist`.`traderID` = ' . $trader_id .' AND `cartlist`.`productAvailability` = 0 ');

        return $qry->result();
    }

    function showcart_details($customer_id) {

        $this->db->select('*');
        $this->db->from('cartlist');
        $this->db->join('product', 'cartlist.productID=product.productID ');
        $this->db->join('trader', 'product.traderID=trader.traderID');
        $this->db->where('cartlist.traderID', $customer_id);
        $query = $this->db->get();
        return $query->result();
    }

    function showwatch_details($customer_id) {

        $this->db->select('*');
        $this->db->from('watchlist');
        $this->db->join('product', 'watchlist.productID=product.productID ');
        $this->db->join('trader', 'product.traderID=trader.traderID');
        $this->db->where('watchlist.traderID', $customer_id);
        $query = $this->db->get();
        return $query->result();
    }

    function showwatch_cnt($customer_id) {

        $this->db->where('traderID', $customer_id);
        $this->db->where('productID !=', 0);
        $this->db->select('sum(watchlistCount) as watchlistCount');
        $watch_qry = $this->db->get('watchlist');
        return $watch_qry->result();
    }

    function showcart_cnt($customer_id) {

        $this->db->where('traderID', $customer_id);
        $this->db->where('productID !=', 0);
        $this->db->select('sum(cartlistCount) as cartlistCount');
        $cart_qry = $this->db->get('cartlist');
        return $cart_qry->result();
    }

    // function del_prd_cart($prod_id) {
    //     $this->db->where('productID', $prod_id);
    //     $qry = $this->db->delete('cartlist');
    // }

    function del_prd_cart($prod_id, $cat_id, $userid) {
        $qry = $this->db->query('select *  from cartlist where userID=' . $userid);
        $myres = $qry->result();
        $res = count($myres);
        if ($res == 1) {
            $this->db->where('orderUserID', $userid);
            $qry = $this->db->delete('order_items');
        }
        $this->db->where('productID', $prod_id);
        $this->db->where('productCategoryID', $cat_id);
        $qry = $this->db->delete('cartlist');
    }

    function prod_addto_wishlist($product_id, $category_id, $post_id) {
        $qry = $this->db->query('select count(*) as watch_cnt from watchlist');
        return $qry->result();
        /* $cartcnt = 1;
          $i=1;
          $session_data = $this->session->userdata('logged_in');
          $trader_id = $session_data['trader_id'];

          $prod_avail = 0;
          //$data = array('cartlistID'=>$i++,'customerID'=>$trader_id,'productID'=>$prod_id,'cartlistCount'=>$cartcnt,'productAvailability'=>$prod_avail);
          $data = array('traderID'=>$trader_id,'postID'=>$post_id,'productID'=>$product_id,'productAvailability'=>$prod_avail,'productCategoryID'=>$category_id);
          $this->db->insert('watchlist',$data); */
        /* $watchcnt = 1;
          $i=1;

          $session_data = $this->session->userdata('logged_in');
          $trader_id = $session_data['trader_id'];
          $prod_avail = 0;
          $data = array('traderID'=>$trader_id,'productID'=>$prod_id,'watchlistCount'=>$watchcnt,'productAvailability'=>$prod_avail);

          $this->db->insert('watchlist',$data); */
    }

    function prod_addto_watchlist($product_id, $category_id, $post_id) {
        $qry = $this->db->query('select count(*) as watch_cnt from watchlist');
        return $qry->result();
    }
    function remove_watchlist($watchlistID) {
        $qry = $this->db->query('delete from watchlist where watchlistID=1'.$watchlistID);
       
        return $qry;
    }
    function watchlist_add_prdt($product_id, $category_id, $post_id, $qry_cnt) {
        if (count($qry_cnt) > 0) {
            $watch_cnt = 1;
            //$session_data = $this->session->userdata('logged_in');
            //$trader_id = $session_data['trader_id'];
            $trader_id = $session_data['trader_id'];
            $data = array('traderID' => $trader_id, 'productCategoryID' => $category_id, 'postID' => $post_id, 'productID' => $product_id, 'watchlistCount' => $watch_cnt, 'productAvailability' => 0);
            $this->db->insert('watchlist', $data);
            $last_watch_id = $this->db->insert_id();
        } else {
            $query = $this->db->query('select watchlistCount from watchlist where watchlistID=' . $last_watch_id);
            $result = $query[0]->watchlistCount;
            $update_watchcount = $result + 1;
            $session_data = $this->session->userdata('logged_in');
            $trader_id = $session_data['trader_id'];
            $data = array('traderID' => $trader_id, 'productCategoryID' => $category_id, 'postID' => $post_id, 'productID' => $product_id, 'watchlistCount' => $update_watchcount, 'productAvailability' => 0);
            $this->db->insert('watchlist', $data);
        }
    }
    function watchlist_add_prdt2($product_id, $category_id, $post_id, $qry_cnt, $userid) {
        $watch_cnt = 1;
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];

        $data = array('postID' => $post_id, 'traderID' => $userid, 'productCategoryID' => $category_id, 'productID' => $product_id, 'watchlistCount' => $watch_cnt, 'productAvailability' => 0, 'userID' => $trader_id);
        $this->db->insert('watchlist', $data);
    }
    function addto_cart($product_id, $cust_id) {
        $cartcnt = 1;
        $i = 1;


        $trader_id = $cust_id;
        $prod_avail = 0;
        //$data = array('cartlistID'=>$i++,'customerID'=>$trader_id,'productID'=>$prod_id,'cartlistCount'=>$cartcnt,'productAvailability'=>$prod_avail);
        $data = array('customerID' => $trader_id, 'productID' => $product_id, 'cartlistCount' => $cartcnt, 'productAvailability' => $prod_avail);

        $this->db->insert('cartlist', $data);
    }

    function watch_cnt() {
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $this->db->where('traderID', $trader_id);
        $this->db->where('productID !=', 0);
        $this->db->select('sum(watchlistCount) as watchlistCount');
        $watch_qry = $this->db->get('watchlist');
        return $watch_qry->result();
    }

    function watch_details2() {
        $session_data = $this->session->userdata('logged_in');

        $trader_id = $session_data['trader_id'];
        $this->db->select('*');
        $this->db->from('watchlist');
        $this->db->join('product', 'watchlist.productID=product.productID ');
        $this->db->join('trader', 'product.traderID=trader.traderID');
        $this->db->where('watchlist.traderID', $trader_id);
        $query = $this->db->get();
        return $query->result();
    }
    function watch_details() {
        $session_data = $this->session->userdata('logged_in');

        $trader_id = $session_data['trader_id'];

        $query = $this->db->query('SELECT watchlistID,post.postSubmissionOn, watchlist.productCategoryID,  watchlist.productID, trader.traderFullName, trader.traderImage, trader.traderLocation, trader.traderID,
       productcar.productCPrice ,productcar.Cpost_main_img ,concat(productcar.productCBrand," ",productcar.productCModel) as product_name1, productcar.cartCType, productcar.productCStatus, 
       productbike.productBPrice ,productbike.Bpost_main_img ,concat(productbike.productBBrand," ",productbike.productBModel) as product_name2,productbike.cartBType,  productbike.productBStatus, 
       productboat.productBTPrice ,productboat.BTpost_main_img ,concat(productboat.productBtBrand," ",productboat.productBtModel) as product_name3,productboat.cartBTType,  productboat.productBTStatus, 
      productwatch.productWPrice ,productwatch.Wpost_main_img ,concat(productwatch.productWBrand," ",productwatch.productWModel) as product_name4,productwatch.cartWType,  productwatch.productWStatus, 
      productvertu.productVPrice ,productvertu.Vpost_main_img ,concat(productvertu.productVBrand," ",productvertu.productVModel) as product_name5,productvertu.cartVType,  productvertu.productVStatus, 
      productproperty.productPRPrice ,productproperty.PRpost_main_img ,concat(productproperty.productPropSC," ",productproperty.productPropType) as product_name6,productproperty.cartPRType,  productproperty.productPRStatus, 
      productphone.productPHPrice ,productphone.PHpost_main_img ,concat(productphone.productPBrand," ",productphone.productPModel) as product_name7,productphone.cartPHType,  productphone.productPHStatus, 
     productnp.productNPPrice ,productnp.NPpost_main_img,concat(productnp.productNPCode," ",productnp.productNPNmbr) as product_name8,productnp.productNPDigits,productnp.cartNPType,  productnp.productNPStatus, 
     productmn.productMNPrice ,productmn.MNpost_main_img ,productmn.productOperator,productmn.productMNDigits,concat(productmn.productMNPrefix," ",productmn.productMNNmbr) as product_name9,productmn.cartMNType,  productmn.productMNStatus
    
    FROM watchlist
       
        left join trader on watchlist.traderID=trader.traderID
        left join post on (watchlist.productCategoryID=post.productCategoryID and watchlist.productID=post.productID)
        left join productcar on (watchlist.productCategoryID=productcar.productCategoryID and watchlist.productID=productcar.productID)
        left join productbike on (watchlist.productCategoryID=productbike.productCategoryID and watchlist.productID=productbike.productID)
        left join productboat on (watchlist.productCategoryID=productboat.productCategoryID and watchlist.productID=productboat.productID)
        left join productmn on (watchlist.productCategoryID=productmn.productCategoryID and watchlist.productID=productmn.productID)
        left join productnp on (watchlist.productCategoryID=productnp.productCategoryID and watchlist.productID=productnp.productID)
        left join productphone on (watchlist.productCategoryID=productphone.productCategoryID and watchlist.productID=productphone.productID)
        left join productproperty on (watchlist.productCategoryID=productproperty.productCategoryID and watchlist.productID=productproperty.productID)
        left join productvertu on (watchlist.productCategoryID=productvertu.productCategoryID and  watchlist.productID=productvertu.productID)
        left join productwatch on (watchlist.productCategoryID=productwatch.productCategoryID and watchlist.productID=productwatch.productID)  
        WHERE `watchlist`.`userID` = ' . $trader_id);
        return $query->result();
    }
    function fetch_appr_posts($limit, $offset) {
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $app_qry = $this->db->query('SELECT post.productID,post.productCategoryID,post.postSubmissionOn,`productcar`.`productCPrice`,productcar.Cpost_main_img ,
                             `productbike`.`productBPrice`,productbike.Bpost_main_img,
                           `productboat`.`productBTPrice`,productboat.BTpost_main_img,
                            `productwatch`.`productWPrice`,productwatch.Wpost_main_img,
                              `productvertu`.`productVPrice`,productvertu.Vpost_main_img,productproperty.productPropType,
                            `productproperty`.`productPRPrice`,productproperty.PRpost_main_img,
                            `productphone`.`productPHPrice`,productphone.PHpost_main_img,
                          `productnp`.`productNPPrice`,productnp.NPpost_main_img,
                           `productmn`.`productMNPrice`,productmn.MNpost_main_img,post.productViewCount,
                           concat(`productcar`.`productCBrand`," ", `productcar`.`productCModel`)as product_name1,
						   concat(`productbike`.`productBBrand`," ",  `productbike`.`productBModel`) as product_name2,
						   concat(`productboat`.`productBtBrand`," ",  `productboat`.`productBtModel`) as product_name3, 
						   concat(`productwatch`.`productWBrand`," ", `productwatch`.`productWModel`)as product_name4 ,
						   concat( `productvertu`.`productVBrand`," ",  `productvertu`.`productVModel`)as product_name5,
						   concat(`productproperty`.`productPropSC`," ", productproperty.productPropType) as product_name6,
						   concat(`productphone`.`productPBrand`," ",  `productphone`.`productPModel`) as product_name7 , 
						   concat( `productnp`.`productNPCode`," ", productnp.productNPNmbr) as product_name8,
						   concat(`productmn`.`productMNPrefix`," ",  `productmn`.`productMNNmbr`) as product_name9,
                           productcar.productCStatus,productbike.productBStatus,productboat.productBTStatus,productnp.productNPStatus,productvertu.productVStatus,productwatch.productWStatus,productphone.productPHStatus,productmn.productMNStatus,productproperty.productPRStatus,
                           productCCallPrice,productBCallPrice,productBtCallPrice,productWCallPrice,productVCallPrice,productPropCallPrice,productPhCallPrice,productNPCallPrice,productMNCallPrice
       
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
       where post.postStatus=1 and post.traderID=' . $trader_id . '  order by post.postSubmissionOn desc limit ' . $limit . ' offset ' . $offset);


        return $app_qry->result();
    }
    function count_fetch_appr_posts() {
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $app_qry = $this->db->query('SELECT post.productID,post.productCategoryID,post.postSubmissionOn,`productcar`.`productCPrice`,productcar.Cpost_main_img ,
                             `productbike`.`productBPrice`,productbike.Bpost_main_img,
                            `productboat`.`productBTPrice`,productboat.BTpost_main_img,
                             `productwatch`.`productWPrice`,productwatch.Wpost_main_img,
                              `productvertu`.`productVPrice`,productvertu.Vpost_main_img,productproperty.productPropType,
                            `productproperty`.`productPRPrice`,productproperty.PRpost_main_img,
                             `productphone`.`productPHPrice`,productphone.PHpost_main_img,
                           `productnp`.`productNPPrice`,productnp.NPpost_main_img,
                           `productmn`.`productMNPrice`,productmn.MNpost_main_img,post.productViewCount,
                           concat(`productcar`.`productCBrand`," ", `productcar`.`productCModel`)as product_name1,
						   concat(`productbike`.`productBBrand`," ",  `productbike`.`productBModel`) as product_name2,
						   concat(`productboat`.`productBtBrand`," ",  `productboat`.`productBtModel`) as product_name3, 
						   concat(`productwatch`.`productWBrand`," ", `productwatch`.`productWModel`)as product_name4 ,
						   concat( `productvertu`.`productVBrand`," ",  `productvertu`.`productVModel`)as product_name5,
						   concat(`productproperty`.`productPropSC`," ", productproperty.productPropType) as product_name6,
						   concat(`productphone`.`productPBrand`," ",  `productphone`.`productPModel`) as product_name7 , 
						   concat( `productnp`.`productNPCode`," ", productnp.productNPNmbr) as product_name8,
						   concat(`productmn`.`productMNPrefix`," ",  `productmn`.`productMNNmbr`) as product_name9,
                           productcar.productCStatus,productbike.productBStatus,productboat.productBTStatus,productnp.productNPStatus,productvertu.productVStatus,productwatch.productWStatus,productphone.productPHStatus,productmn.productMNStatus,productproperty.productPRStatus 
       
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
       where post.postStatus=1 and post.traderID=' . $trader_id);


        return $app_qry->result();
    }
    function mdl_fetch_appr_posts($trader_id, $limit, $offset) {

        $app_qry = $this->db->query('SELECT post.productID,post.productCategoryID,post.postSubmissionOn,`productcar`.`productCPrice`,productcar.Cpost_main_img ,
                             `productbike`.`productBPrice`,productbike.Bpost_main_img,
                            `productboat`.`productBTPrice`,productboat.BTpost_main_img,
                             `productwatch`.`productWPrice`,productwatch.Wpost_main_img,
                             `productvertu`.`productVPrice`,productvertu.Vpost_main_img,productproperty.productPropType,
                            `productproperty`.`productPRPrice`,productproperty.PRpost_main_img,
                             `productphone`.`productPHPrice`,productphone.PHpost_main_img,
                           `productnp`.`productNPPrice`,productnp.NPpost_main_img,
                           `productmn`.`productMNPrice`,productmn.MNpost_main_img,post.productViewCount,
                           concat(`productcar`.`productCBrand`," ", `productcar`.`productCModel`)as product_name1,
						   concat(`productbike`.`productBBrand`," ",  `productbike`.`productBModel`) as product_name2,
						   concat(`productboat`.`productBtBrand`," ",  `productboat`.`productBtModel`) as product_name3, 
						   concat(`productwatch`.`productWBrand`," ", `productwatch`.`productWModel`)as product_name4 ,
						   concat( `productvertu`.`productVBrand`," ",  `productvertu`.`productVModel`)as product_name5,
						   concat(`productproperty`.`productPropSC`," ", productproperty.productPropType) as product_name6,
						   concat(`productphone`.`productPBrand`," ",  `productphone`.`productPModel`) as product_name7 , 
						   concat( `productnp`.`productNPCode`," ", productnp.productNPNmbr) as product_name8,
						   concat(`productmn`.`productMNPrefix`," ",  `productmn`.`productMNNmbr`) as product_name9,
                           productcar.productCStatus,productbike.productBStatus,productboat.productBTStatus,productnp.productNPStatus,productvertu.productVStatus,productwatch.productWStatus,productphone.productPHStatus,productmn.productMNStatus,productproperty.productPRStatus 
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
       where post.postStatus=1 and post.traderID=' . $trader_id . ' order by post.postSubmissionOn desc limit ' . $limit . ' offset ' . $offset);


        return $app_qry->result();
    }
    function count_mdl_fetch_appr_posts($trader_id) {

        $app_qry = $this->db->query('SELECT post.productID,post.productCategoryID,post.postSubmissionOn,`productcar`.`productCPrice`,productcar.Cpost_main_img ,
                             `productbike`.`productBPrice`,productbike.Bpost_main_img,
                            `productboat`.`productBTPrice`,productboat.BTpost_main_img,
                            `productwatch`.`productWPrice`,productwatch.Wpost_main_img,
                              `productvertu`.`productVPrice`,productvertu.Vpost_main_img,productproperty.productPropType,
                            `productproperty`.`productPRPrice`,productproperty.PRpost_main_img,
                             `productphone`.`productPHPrice`,productphone.PHpost_main_img,
                           `productnp`.`productNPPrice`,productnp.NPpost_main_img,
                           `productmn`.`productMNPrice`,productmn.MNpost_main_img,post.productViewCount,
                           concat(`productcar`.`productCBrand`," ", `productcar`.`productCModel`)as product_name1,
						   concat(`productbike`.`productBBrand`," ",  `productbike`.`productBModel`) as product_name2,
						   concat(`productboat`.`productBtBrand`," ",  `productboat`.`productBtModel`) as product_name3, 
						   concat(`productwatch`.`productWBrand`," ", `productwatch`.`productWModel`)as product_name4 ,
						   concat( `productvertu`.`productVBrand`," ",  `productvertu`.`productVModel`)as product_name5,
						   concat(`productproperty`.`productPropSC`," ", productproperty.productPropType) as product_name6,
						   concat(`productphone`.`productPBrand`," ",  `productphone`.`productPModel`) as product_name7 , 
						   concat( `productnp`.`productNPCode`," ", productnp.productNPNmbr) as product_name8,
						   concat(`productmn`.`productMNPrefix`," ",  `productmn`.`productMNNmbr`) as product_name9,
                           productcar.productCStatus,productbike.productBStatus,productboat.productBTStatus,productnp.productNPStatus,productvertu.productVStatus,productwatch.productWStatus,productphone.productPHStatus,productmn.productMNStatus,productproperty.productPRStatus 
       
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
       where post.postStatus=1 and post.traderID=' . $trader_id);


        return $app_qry->result();
    }
    function fetch_rej_posts2() {
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        /* $this->db->select('product.productName,product.productImage,product.productPrice,product.productSubmitDate,product.productViewCount');
          $this->db->from('product');
          $this->db->join('post','product.productID=post.productID');
          $this->db->where('product.traderID',$trader_id);
          $this->db->where('post.postStatus',0); */
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
       where post.postStatus=0 and post.traderID=' . $trader_id);

        return $rej_qry->result();
    }
    function fetch_rej_posts() {
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];

        $rej_qry = $this->db->query('SELECT post.rejectMsg,post.postID,post.productID,post.productCategoryID,post.postSubmissionOn,`productcar`.`productCPrice`,productcar.Cpost_main_img ,
                             `productbike`.`productBPrice`,productbike.Bpost_main_img,
                            `productboat`.`productBTPrice`,productboat.BTpost_main_img,
                             `productwatch`.`productWPrice`,productwatch.Wpost_main_img,
                             `productvertu`.`productVPrice`,productvertu.Vpost_main_img,productproperty.productPropType,
                            `productproperty`.`productPRPrice`,productproperty.PRpost_main_img,
                             `productphone`.`productPHPrice`,productphone.PHpost_main_img,
                         `productnp`.`productNPPrice`,productnp.NPpost_main_img,
                           `productmn`.`productMNPrice`,productmn.MNpost_main_img,post.productViewCount,
                           concat(`productcar`.`productCBrand`," ", `productcar`.`productCModel`)as product_name1,
						   concat(`productbike`.`productBBrand`," ",  `productbike`.`productBModel`) as product_name2,
						   concat(`productboat`.`productBtBrand`," ",  `productboat`.`productBtModel`) as product_name3, 
						   concat(`productwatch`.`productWBrand`," ", `productwatch`.`productWModel`)as product_name4 ,
						   concat( `productvertu`.`productVBrand`," ",  `productvertu`.`productVModel`)as product_name5,
						   concat(`productproperty`.`productPropSC`," ", productproperty.productPropType) as product_name6,
						   concat(`productphone`.`productPBrand`," ",  `productphone`.`productPModel`) as product_name7 , 
						   concat( `productnp`.`productNPCode`," ", productnp.productNPNmbr) as product_name8,
						   concat(`productmn`.`productMNPrefix`," ",  `productmn`.`productMNNmbr`) as product_name9,
                           productCCallPrice,productBCallPrice,productBtCallPrice,productWCallPrice,productVCallPrice,productPropCallPrice,productPhCallPrice,productNPCallPrice,productMNCallPrice
       
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
       where post.postStatus=-1 and post.traderID=' . $trader_id.' order by post.postSubmissionOn desc');

        return $rej_qry->result();
    }
    function mdl_fetch_rej_posts($trader_id) {


        $rej_qry = $this->db->query('SELECT post.productID,post.productCategoryID,post.postSubmissionOn,`productcar`.`productCPrice`,productcar.Cpost_main_img ,
                             `productbike`.`productBPrice`,productbike.Bpost_main_img,
                            `productboat`.`productBTPrice`,productboat.BTpost_main_img,
                             `productwatch`.`productWPrice`,productwatch.Wpost_main_img,
                             `productvertu`.`productVPrice`,productvertu.Vpost_main_img,productproperty.productPropType,
                           `productproperty`.`productPRPrice`,productproperty.PRpost_main_img,
                             `productphone`.`productPHPrice`,productphone.PHpost_main_img,
                           `productnp`.`productNPPrice`,productnp.NPpost_main_img,
                           `productmn`.`productMNPrice`,productmn.MNpost_main_img,post.productViewCount,
                           concat(`productcar`.`productCBrand`," ", `productcar`.`productCModel`)as product_name1,
						   concat(`productbike`.`productBBrand`," ",  `productbike`.`productBModel`) as product_name2,
						   concat(`productboat`.`productBtBrand`," ",  `productboat`.`productBtModel`) as product_name3, 
						   concat(`productwatch`.`productWBrand`," ", `productwatch`.`productWModel`)as product_name4 ,
						   concat( `productvertu`.`productVBrand`," ",  `productvertu`.`productVModel`)as product_name5,
						   concat(`productproperty`.`productPropSC`," ", productproperty.productPropType) as product_name6,
						   concat(`productphone`.`productPBrand`," ",  `productphone`.`productPModel`) as product_name7 , 
						   concat( `productnp`.`productNPCode`," ", productnp.productNPNmbr) as product_name8,
						   concat(`productmn`.`productMNPrefix`," ",  `productmn`.`productMNNmbr`) as product_name9       
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
       where post.postStatus=-1 and post.traderID=' . $trader_id.' order by post.postSubmissionOn desc');

        return $rej_qry->result();
    }
    function fetch_pend_posts2() {
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        /* $this->db->select('product.productName,product.productImage,product.productPrice,product.productSubmitDate,product.productViewCount');
          $this->db->from('product');
          $this->db->join('post','product.productID=post.productID');
          $this->db->where('product.traderID',$trader_id);
          $this->db->where('post.postStatus',-1); */
        $pend_qry = $this->db->query('SELECT `product`.`productName`, `product`.`productImage`, `product`.`productPrice`, `product`.`productSubmitDate`, `product`.`productViewCount` FROM `product` JOIN `post` ON `product`.`productID`=`post`.`productID` WHERE `product`.`traderID` = ' . $trader_id . ' AND `post`.`postStatus` = -1 GROUP by product.productID');

        return $pend_qry->result();
    }
    function fetch_pend_posts() {
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];

        $pend_qry = $this->db->query('SELECT post.productID,post.productCategoryID,post.postSubmissionOn,`productcar`.`productCPrice`,productcar.Cpost_main_img ,
                            `productbike`.`productBPrice`,productbike.Bpost_main_img,
                           `productboat`.`productBTPrice`,productboat.BTpost_main_img,
                             `productwatch`.`productWPrice`,productwatch.Wpost_main_img,
                              `productvertu`.`productVPrice`,productvertu.Vpost_main_img,productproperty.productPropType,
                            `productproperty`.`productPRPrice`,productproperty.PRpost_main_img,
                            `productphone`.`productPHPrice`,productphone.PHpost_main_img,
                           `productnp`.`productNPPrice`,productnp.NPpost_main_img,
                           `productmn`.`productMNPrice`,productmn.MNpost_main_img,post.productViewCount,
                           concat(`productcar`.`productCBrand`," ", `productcar`.`productCModel`)as product_name1,
						   concat(`productbike`.`productBBrand`," ",  `productbike`.`productBModel`) as product_name2,
						   concat(`productboat`.`productBtBrand`," ",  `productboat`.`productBtModel`) as product_name3, 
						   concat(`productwatch`.`productWBrand`," ", `productwatch`.`productWModel`)as product_name4 ,
						   concat( `productvertu`.`productVBrand`," ",  `productvertu`.`productVModel`)as product_name5,
						   concat(`productproperty`.`productPropSC`," ", productproperty.productPropType) as product_name6,
						   concat(`productphone`.`productPBrand`," ",  `productphone`.`productPModel`) as product_name7 , 
						   concat( `productnp`.`productNPCode`," ", productnp.productNPNmbr) as product_name8,
						   concat(`productmn`.`productMNPrefix`," ",  `productmn`.`productMNNmbr`) as product_name9,
                           productCCallPrice,productBCallPrice,productBtCallPrice,productWCallPrice,productVCallPrice,productPropCallPrice,productPhCallPrice,productNPCallPrice,productMNCallPrice     
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
       where post.postStatus=0 and post.traderID=' . $trader_id.' order by post.postSubmissionOn desc');

        return $pend_qry->result();
    }
    function mdl_fetch_pend_posts($trader_id) {

        $pend_qry = $this->db->query('SELECT post.productID,post.productCategoryID,post.postSubmissionOn, `productcar`.`productCPrice`,productcar.Cpost_main_img ,
                             `productbike`.`productBPrice`,productbike.Bpost_main_img,
                            `productboat`.`productBTPrice`,productboat.BTpost_main_img,
                             `productwatch`.`productWPrice`,productwatch.Wpost_main_img,
                              `productvertu`.`productVPrice`,productvertu.Vpost_main_img,productproperty.productPropType,
                           `productproperty`.`productPRPrice`,productproperty.PRpost_main_img,
                             `productphone`.`productPHPrice`,productphone.PHpost_main_img,
                           `productnp`.`productNPPrice`,productnp.NPpost_main_img,
                           `productmn`.`productMNPrice`,productmn.MNpost_main_img,post.productViewCount,
                           concat(`productcar`.`productCBrand`," ", `productcar`.`productCModel`)as product_name1,
						   concat(`productbike`.`productBBrand`," ",  `productbike`.`productBModel`) as product_name2,
						   concat(`productboat`.`productBtBrand`," ",  `productboat`.`productBtModel`) as product_name3, 
						   concat(`productwatch`.`productWBrand`," ", `productwatch`.`productWModel`)as product_name4 ,
						   concat( `productvertu`.`productVBrand`," ",  `productvertu`.`productVModel`)as product_name5,
						   concat(`productproperty`.`productPropSC`," ", productproperty.productPropType) as product_name6,
						   concat(`productphone`.`productPBrand`," ",  `productphone`.`productPModel`) as product_name7 , 
						   concat( `productnp`.`productNPCode`," ", productnp.productNPNmbr) as product_name8,
						   concat(`productmn`.`productMNPrefix`," ",  `productmn`.`productMNNmbr`) as product_name9       
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
       where post.postStatus=0 and post.traderID=' . $trader_id.' order by post.postSubmissionOn desc');

        return $pend_qry->result();
    }
    function fetch_bookeditems($trader_id) {

        $booked_qry = $this->db->query('SELECT  post.productID,post.productCategoryID,concat(`productcar`.`productCBrand`," ", `productcar`.`productCModel`) as product_name1, `productcar`.`productCPrice`,`productcar`.`Cpost_main_img`,
           concat(productbike.`productBBrand`," ", `productbike`.`productBModel`) as product_name2, `productbike`.`productBPrice`, `productbike`.`Bpost_main_img`,
           concat(productvertu.`productVBrand`," ", `productvertu`.`productVModel`) as product_name3, `productvertu`.`productVPrice`, `productvertu`.`Vpost_main_img`,
             concat(`productboat`.`productBtBrand`," ", `productboat`.`productBtModel`) as product_name4, `productboat`.`productBTPrice`, `productboat`.`BTpost_main_img`,productboat.cartBTType,productboat.productBTStatus, 
             concat(`productwatch`.`productWBrand`," ", `productwatch`.`productWModel`) as product_name5, `productwatch`.`productWPrice`, `productwatch`.`Wpost_main_img`,
             concat(`productphone`.`productPBrand`," ", `productphone`.`productPModel`) as product_name6, `productphone`.`productPHPrice`, `productphone`.`PHpost_main_img`,
             concat(`productproperty`.`productPropSC`," ",productproperty.productPropType) as product_name7, `productproperty`.`productPRPrice`, `productproperty`.`PRpost_main_img`,
             concat(`productnp`.`productNPCode`," ", `productnp`.`productNPDigits`) as product_name8,  `productnp`.`productNPPrice`, `productnp`.`NPpost_main_img`,
             concat(`productmn`.`productMNPrefix`," ", `productmn`.`productMNNmbr`) as product_name9, `productmn`.`productMNPrice`, `productmn`.`MNpost_main_img`,post.postSubmissionOn,post.productViewCount
            
   FROM `post`
   left join productcar on (post.productID=productcar.productID and post.productCategoryID=productcar.productCategoryID)
   left join productbike on (post.productID=productbike.productID and post.productCategoryID=productbike.productCategoryID)
   left join productnp on (post.productID=productnp.productID and post.productCategoryID=productnp.productCategoryID)
   left join productvertu on (post.productID=productvertu.productID and post.productCategoryID=productvertu.productCategoryID)
   left join productwatch on (post.productID=productwatch.productID and post.productCategoryID=productwatch.productCategoryID)
   left join productmn on (post.productID=productmn.productID and post.productCategoryID=productmn.productCategoryID)
   left join productboat on (post.productID=productboat.productID and post.productCategoryID=productboat.productCategoryID)
   left join productphone on (post.productID=productphone.productID and post.productCategoryID=productphone.productCategoryID)
   left join productproperty on (post.productID=productproperty.productID and post.productCategoryID=productproperty.productCategoryID)
   
   where   ((post.postStatus=1 and productcar.productCStatus=2) or (post.postStatus=1 and productbike.productBStatus=2) or (post.postStatus=1 and productboat.productBTStatus=2) or (post.postStatus=1 and productnp.productNPStatus=2 ) or (post.postStatus=1 and productvertu.productVStatus=2 )or (post.postStatus=1 and productwatch.productWStatus=2) or (post.postStatus=1 and productmn.productMNStatus=2) or (post.postStatus=1 and productphone.productPHStatus=2) or (post.postStatus=1 and productproperty.productPRStatus=2 )) and post.traderID=' . $trader_id . ' order by post.postSubmissionOn DESC');
        return $booked_qry->result();
    }

    function fetch_solditems($trader_id) {
        $sold_qry = $this->db->query('SELECT  post.productID,post.productCategoryID,concat(`productcar`.`productCBrand`," ", `productcar`.`productCModel`) as product_name1, `productcar`.`productCPrice`,`productcar`.`Cpost_main_img`,
           concat(productbike.`productBBrand`, " ",`productbike`.`productBModel`) as product_name2, `productbike`.`productBPrice`, `productbike`.`Bpost_main_img`,
           concat(productvertu.`productVBrand`, " ",`productvertu`.`productVModel`) as product_name3, `productvertu`.`productVPrice`, `productvertu`.`Vpost_main_img`,
             concat(`productboat`.`productBtBrand`," ", `productboat`.`productBtModel`) as product_name4, `productboat`.`productBTPrice`, `productboat`.`BTpost_main_img`,productboat.cartBTType,productboat.productBTStatus, 
             concat(`productwatch`.`productWBrand`," ", `productwatch`.`productWModel`) as product_name5, `productwatch`.`productWPrice`, `productwatch`.`Wpost_main_img`,
             concat(`productphone`.`productPBrand`, " ",`productphone`.`productPModel`) as product_name6, `productphone`.`productPHPrice`, `productphone`.`PHpost_main_img`,
             concat(`productproperty`.`productPropSC`," ",productproperty.productPropType) as product_name7, `productproperty`.`productPRPrice`, `productproperty`.`PRpost_main_img`,
             concat(`productnp`.`productNPCode`," ", `productnp`.`productNPDigits`) as product_name8,  `productnp`.`productNPPrice`, `productnp`.`NPpost_main_img`,
             concat(`productmn`.`productMNPrefix`," ", `productmn`.`productMNNmbr`) as product_name9, `productmn`.`productMNPrice`, `productmn`.`MNpost_main_img`,post.postSubmissionOn,post.productViewCount
            
   FROM `post`
   left join productcar on (post.productID=productcar.productID and post.productCategoryID=productcar.productCategoryID)
   left join productbike on (post.productID=productbike.productID and post.productCategoryID=productbike.productCategoryID)
   left join productnp on (post.productID=productnp.productID and post.productCategoryID=productnp.productCategoryID)
   left join productvertu on (post.productID=productvertu.productID and post.productCategoryID=productvertu.productCategoryID)
   left join productwatch on (post.productID=productwatch.productID and post.productCategoryID=productwatch.productCategoryID)
   left join productmn on (post.productID=productmn.productID and post.productCategoryID=productmn.productCategoryID)
   left join productboat on (post.productID=productboat.productID and post.productCategoryID=productboat.productCategoryID)
   left join productphone on (post.productID=productphone.productID and post.productCategoryID=productphone.productCategoryID)
   left join productproperty on (post.productID=productproperty.productID and post.productCategoryID=productproperty.productCategoryID)
   
   where   ((post.postStatus=1 and productcar.productCStatus=1) or (post.postStatus=1 and productbike.productBStatus=1) or (post.postStatus=1 and productboat.productBTStatus=1) or (post.postStatus=1 and productnp.productNPStatus=1 ) or (post.postStatus=1 and productvertu.productVStatus=1 )or (post.postStatus=1 and productwatch.productWStatus=1) or (post.postStatus=1 and productmn.productMNStatus=1) or (post.postStatus=1 and productphone.productPHStatus=1) or (post.postStatus=1 and productproperty.productPRStatus=1 )) and post.traderID=' . $trader_id . ' order by post.postSubmissionOn DESC');

        return $sold_qry->result();
    }

    function calc_rem_postdays() {
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $qry = $this->db->query('select planValidity from tradersubscriptionplan where traderID=' . $trader_id);
        return $qry->result();
    }

    function calc_tot_amt() {
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
    
    //     $qry = $this->db->query("SELECT 
    //     (select SUM( productCPrice) FROM productcar WHERE productCStatus =1 and traderID='$trader_id') 
    //    +(select SUM( productBPrice) FROM productbike WHERE productBStatus =1 and traderID='$trader_id') 
    //    +(select SUM( productNPPrice) FROM productnp WHERE productNPStatus =1 and traderID='$trader_id')
    //    +(select SUM( productVPrice) FROM productvertu WHERE productVStatus =1 and traderID='$trader_id')
    //    +(select SUM( productWPrice) FROM productwatch WHERE productWStatus =1 and traderID='$trader_id')
    //    +(select SUM( productMNPrice) FROM productmn WHERE productMNStatus =1 and traderID='$trader_id')
    //    +(SELECT SUM( productBTPrice) FROM productboat WHERE productBTStatus =1 and traderID='$trader_id')
    //    +(SELECT SUM( productPRPrice) FROM productproperty WHERE productPRStatus = 1 and traderID='$trader_id')
    //    AS result");
    $qry = $this->db->query("SELECT Price from vwProductPost where AvailablitiyStatus=1 and TraderID={$trader_id}");

$total=0;
foreach($qry->result() as $row){
    $total=$total+$row->Price;
}
        return $total;
    }

    function trader_plancnt($trader_id) {
        $qry = $this->db->query('select planPostCount from tradersubscriptionplan where traderID=' . $trader_id);
        return $qry->result();
    }

    function check_trader_addpost() {
        $session_data = $this->session->userdata('logged_in');
        if($session_data['txtusertype']==1){
            $user_id = $session_data['trader_id'];
            $query = $this->Trader_mdl->trader_paymentdetails($user_id);

            if (!empty($query)) {
                $plan_id = $query[0]->planID;
                $payment_chosen = (int) $query[0]->paymentTypeChosen;
                $payment_status = $query[0]->planStatus;
                if($query[0]->isActive==1){
                    if ($payment_chosen > 0) {
                    
                        if ($payment_status == 0) {
                            $status = 3;
                        } elseif ($payment_status == 1) {
                            
                            if($query[0]->planID==4){
                                //echo $query[0]->traderPostCount;
                                // echo count($posts);
                            $query[0]->totalposted=$query[0]->traderPostCount;
                            $datediff=$query[0]->planPostCount-$query[0]->totalposted;
                            $status = ($datediff>0) ? 0: 6;
                            }else if($query[0]->planID==3){
                                $query[0]->totalposted=$query[0]->traderPostCount;
                                $postdiff=$query[0]->planPostCount-$query[0]->totalposted;
                                $now = time(); // or your date as well
                            $till_date = strtotime($query[0]->planValidity);
                            $datediff = floor(($till_date -$now)/(60 * 60 * 24));
                            $status = ($datediff<0||$postdiff<0) ?6 : 0;
                            }else{
                            $now = time(); // or your date as well
                            $till_date = strtotime($query[0]->planValidity);
                            $datediff = floor(($till_date -$now)/(60 * 60 * 24));
                            $status = ($datediff>0) ?0 : 6;
                            }
                            
                        } else {
                            $status = 4;
                        }
                    } else {
                        $status = 2;
                    }
                }
                else{
                    $status = 3;
                } 
    
           



            } else {
    
                $status = 1;
            }
        }else{
            $status = 5;
        }
      
        return $status;
    }
    function others_trader_data($trader_id) {
        $this->db->where('traderID', $trader_id);
        $trqry = $this->db->get('trader');
        $trquery = $trqry->result();


        $this->db->where('traderID', $trader_id);
        $prqry = $this->db->get('product');
        $prquery = $prqry->result();
        return array(
            'tqry' => $trquery,
            'pqry' => $prquery,
        );
    }

    function mdl_fetch_prod_traddet($product_id) {
        $this->db->select('*');
        $this->db->from('trader');
        $this->db->join('product', 'product.traderID=trader.traderID');
        $this->db->where('product.productID', $product_id);
        $qry = $this->db->get();
        return $qry->result();
    }
    function most_view() {
        //     $recentqry = $this->db->query('select post.productID,post.productCategoryID,post.postID,productcar.productCPrice ,productcar.Cpost_main_img ,concat(productcar.productCBrand, " ",productcar.productCModel) as product_name1,productcar.cartCType, 
        //     productbike.productBPrice ,productbike.Bpost_main_img ,concat(productbike.productBBrand, " ",productbike.productBModel) as product_name2,productbike.cartBType ,
        //      productboat.productBTPrice ,productboat.BTpost_main_img ,concat(productboat.productBtBrand," ",productboat.productBtModel) as product_name3,productboat.cartBTType ,
        //      productwatch.productWPrice ,productwatch.Wpost_main_img ,concat(productwatch.productWBrand," ",productwatch.productWModel) as product_name4,productwatch.cartWType ,
        //      productvertu.productVPrice ,productvertu.Vpost_main_img ,concat(productvertu.productVBrand," ",productvertu.productVModel) as product_name5,productvertu.cartVType ,
        //      productproperty.productPRPrice ,productproperty.PRpost_main_img ,concat(productproperty.productPropSC," ",productproperty.productPropType) as product_name6,productproperty.cartPRType ,
        //      productphone.productPHPrice ,productphone.PHpost_main_img ,concat(productphone.productPBrand," ",productphone.productPModel) as product_name7,productphone.cartPHType ,
        //    productnp.productNPPrice ,productnp.NPpost_main_img,concat(productnp.productNPCode," ",productnp.productNPNmbr) as product_name8,productnp.productNPDigits,productnp.cartNPType ,
        //      productmn.productMNPrice ,productmn.MNpost_main_img ,concat(productmn.productMNPrefix," ",productmn.productMNNmbr) as product_name9,productmn.cartMNType 
        //      from post
        //      left join productcar on (post.productCategoryID=productcar.productCategoryID and post.productID=productcar.productID)
        //        left join productbike on (post.productCategoryID=productbike.productCategoryID and post.productID=productbike.productID)
        //        left join productboat on (post.productCategoryID=productboat.productCategoryID and post.productID=productboat.productID)
        //        left join productmn on (post.productCategoryID=productmn.productCategoryID and post.productID=productmn.productID)
        //        left join productnp on (post.productCategoryID=productnp.productCategoryID and post.productID=productnp.productID)
        //        left join productphone on (post.productCategoryID=productphone.productCategoryID and post.productID=productphone.productID)
        //        left join productproperty on (post.productCategoryID=productproperty.productCategoryID and post.productID=productproperty.productID)
        //        left join productvertu on (post.productCategoryID=productvertu.productCategoryID and  post.productID=productvertu.productID)
        //        left join productwatch on (post.productCategoryID=productwatch.productCategoryID and post.productID=productwatch.productID) 
        //        where   (post.postStatus=1 and (productcar.productCStatus!=3)) or (post.postStatus=1 and (productbike.productBStatus!=1 and productbike.productBStatus!=3)) or (post.postStatus=1 and (productboat.productBTStatus!=1 and productboat.productBTStatus!=3)) or (post.postStatus=1 and (productnp.productNPStatus!=1 and productnp.productNPStatus!=3) ) or (post.postStatus=1 and (productvertu.productVStatus!=1 and productvertu.productVStatus!=3) )or (post.postStatus=1 and (productwatch.productWStatus!=1 and productwatch.productWStatus!=3)) or (post.postStatus=1 and (productmn.productMNStatus!=1 and productmn.productMNStatus!=3)) or (post.postStatus=1 and (productphone.productPHStatus!=1 and productphone.productPHStatus!=3)) or (post.postStatus=1 and (productproperty.productPRStatus!=1 and productproperty.productPRStatus!=3) )
        //       order by post.productViewCount,post.postSubmissionOn desc LIMIT 8');
              $recentqry = $this->db->query('select productCStatus,productBStatus,productBTStatus,productNPStatus,productVStatus,productWStatus,productMNStatus,productPHStatus,productPRStatus,post.productID,post.productCategoryID,post.postID,productcar.productCPrice ,productcar.Cpost_main_img ,concat(productcar.productCBrand, " ",productcar.productCModel) as product_name1,productcar.cartCType, 
              productbike.productBPrice ,productbike.Bpost_main_img ,concat(productbike.productBBrand, " ",productbike.productBModel) as product_name2,productbike.cartBType ,
               productboat.productBTPrice ,productboat.BTpost_main_img ,concat(productboat.productBtBrand," ",productboat.productBtModel) as product_name3,productboat.cartBTType ,
               productwatch.productWPrice ,productwatch.Wpost_main_img ,concat(productwatch.productWBrand," ",productwatch.productWModel) as product_name4,productwatch.cartWType ,
               productvertu.productVPrice ,productvertu.Vpost_main_img ,concat(productvertu.productVBrand," ",productvertu.productVModel) as product_name5,productvertu.cartVType ,
               productproperty.productPRPrice ,productproperty.PRpost_main_img ,concat(productproperty.productPropSC," ",productproperty.productPropType) as product_name6,productproperty.cartPRType ,
               productphone.productPHPrice ,productphone.PHpost_main_img ,concat(productphone.productPBrand," ",productphone.productPModel) as product_name7,productphone.cartPHType ,
             productnp.productNPPrice ,productnp.NPpost_main_img,concat(productnp.productNPCode," ",productnp.productNPNmbr) as product_name8,productnp.productNPDigits,productnp.cartNPType ,
               productmn.productMNPrice ,productmn.MNpost_main_img ,concat(productmn.productMNPrefix," ",productmn.productMNNmbr) as product_name9,productmn.cartMNType 
               from post
               left join productcar on (post.productCategoryID=productcar.productCategoryID and post.productID=productcar.productID)
                 left join productbike on (post.productCategoryID=productbike.productCategoryID and post.productID=productbike.productID)
                 left join productboat on (post.productCategoryID=productboat.productCategoryID and post.productID=productboat.productID)
                 left join productmn on (post.productCategoryID=productmn.productCategoryID and post.productID=productmn.productID)
                 left join productnp on (post.productCategoryID=productnp.productCategoryID and post.productID=productnp.productID)
                 left join productphone on (post.productCategoryID=productphone.productCategoryID and post.productID=productphone.productID)
                 left join productproperty on (post.productCategoryID=productproperty.productCategoryID and post.productID=productproperty.productID)
                 left join productvertu on (post.productCategoryID=productvertu.productCategoryID and  post.productID=productvertu.productID)
                 left join productwatch on (post.productCategoryID=productwatch.productCategoryID and post.productID=productwatch.productID) 
                 where   (post.postStatus=1 and (productcar.productCStatus>-1)) or (post.postStatus=1 and (productbike.productBStatus>-1)) or (post.postStatus=1 and (productboat.productBTStatus>-1)) or (post.postStatus=1 and (productnp.productNPStatus>-1) ) or (post.postStatus=1 and (productvertu.productVStatus>-1) )or (post.postStatus=1 and (productwatch.productWStatus>-1)) or (post.postStatus=1 and (productmn.productMNStatus>-1)) or (post.postStatus=1 and (productphone.productPHStatus>-1)) or (post.postStatus=1 and (productproperty.productPRStatus>-1) )
                order by post.productViewCount desc LIMIT 8');
            return $recentqry->result();
        }
        function recently_viewed() {
            $recentqry = $this->db->query('select post.productID,post.productCategoryID,post.postID,productcar.productCPrice ,productcar.Cpost_main_img ,concat(productcar.productCBrand, " ",productcar.productCModel) as product_name1,productcar.cartCType, 
            productbike.productBPrice ,productbike.Bpost_main_img ,concat(productbike.productBBrand, " ",productbike.productBModel) as product_name2,productbike.cartBType ,
             productboat.productBTPrice ,productboat.BTpost_main_img ,concat(productboat.productBtBrand," ",productboat.productBtModel) as product_name3,productboat.cartBTType ,
             productwatch.productWPrice ,productwatch.Wpost_main_img ,concat(productwatch.productWBrand," ",productwatch.productWModel) as product_name4,productwatch.cartWType ,
             productvertu.productVPrice ,productvertu.Vpost_main_img ,concat(productvertu.productVBrand," ",productvertu.productVModel) as product_name5,productvertu.cartVType ,
             productproperty.productPRPrice ,productproperty.PRpost_main_img ,concat(productproperty.productPropSC," ",productproperty.productPropType) as product_name6,productproperty.cartPRType ,
             productphone.productPHPrice ,productphone.PHpost_main_img ,concat(productphone.productPBrand," ",productphone.productPModel) as product_name7,productphone.cartPHType ,
           productnp.productNPPrice ,productnp.NPpost_main_img,concat(productnp.productNPCode," ",productnp.productNPNmbr) as product_name8,productnp.productNPDigits,productnp.cartNPType ,
             productmn.productMNPrice ,productmn.MNpost_main_img ,concat(productmn.productMNPrefix," ",productmn.productMNNmbr) as product_name9,productmn.cartMNType 
             from post
             left join productcar on (post.productCategoryID=productcar.productCategoryID and post.productID=productcar.productID)
               left join productbike on (post.productCategoryID=productbike.productCategoryID and post.productID=productbike.productID)
               left join productboat on (post.productCategoryID=productboat.productCategoryID and post.productID=productboat.productID)
               left join productmn on (post.productCategoryID=productmn.productCategoryID and post.productID=productmn.productID)
               left join productnp on (post.productCategoryID=productnp.productCategoryID and post.productID=productnp.productID)
               left join productphone on (post.productCategoryID=productphone.productCategoryID and post.productID=productphone.productID)
               left join productproperty on (post.productCategoryID=productproperty.productCategoryID and post.productID=productproperty.productID)
               left join productvertu on (post.productCategoryID=productvertu.productCategoryID and  post.productID=productvertu.productID)
               left join productwatch on (post.productCategoryID=productwatch.productCategoryID and post.productID=productwatch.productID) 
               where   (post.postStatus=1 and (productcar.productCStatus!=3)) or (post.postStatus=1 and (productbike.productBStatus!=1 and productbike.productBStatus!=3)) or 
               (post.postStatus=1 and (productboat.productBTStatus!=1 and productboat.productBTStatus!=3)) or (post.postStatus=1 and (productnp.productNPStatus!=1 and productnp.productNPStatus!=3) ) or (post.postStatus=1 and (productvertu.productVStatus!=1 and productvertu.productVStatus!=3) )or (post.postStatus=1 and (productwatch.productWStatus!=1 and productwatch.productWStatus!=3)) or (post.postStatus=1 and (productmn.productMNStatus!=1 and productmn.productMNStatus!=3)) or (post.postStatus=1 and (productphone.productPHStatus!=1 and productphone.productPHStatus!=3)) or (post.postStatus=1 and (productproperty.productPRStatus!=1 and productproperty.productPRStatus!=3) )
                order by post.productLastViewed desc LIMIT 8');
            return $recentqry->result();
        }
    function recent_view() {
        $recentqry = $this->db->query('SELECT piv.*,p.* FROM `productiv` piv,vwProductPost p where piv.postID=p.postID order by piv.productViewCount desc LIMIT 4');
        return $recentqry->result();
    }

//     function getproducttrader($trader_id) {
//         $this->db->select('product.productViewCount,trader.socialWeb,trader.socialtwitter,trader.socialFb,trader.socialInsta,trader.socialSnap,product.productID,product.productImage,product.productName,product.productPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,product.productSubmitDate,trader.traderContactNum,product.productDescr,trader.traderID');
//         $this->db->from('trader');
//         $this->db->join('product', 'product.traderID=trader.traderID');
//         $this->db->where('trader.traderID', $trader_id);
// //        $this->db->limit($limit, $offset);
//         $qry = $this->db->get();
//         return $qry->result();
//     }
function getproducttrader($trader_id, $limit, $offset) {

    $qry = $this->db->query('SELECT trader.usertype,post.traderID,post.productViewCount,post.postID,post.productCategoryID,post.postSubmissionOn,post.productID, productcar.productCPrice ,productcar.Cpost_main_img ,concat(productcar.productCBrand, " ",productcar.productCModel) as product_name1,productcar.productCStatus, productbike.productBPrice ,productbike.Bpost_main_img ,concat(productbike.productBBrand, " ",productbike.productBModel) as product_name2,productbike.productBStatus , productboat.productBTPrice ,productboat.BTpost_main_img ,concat(productboat.productBtBrand," ",productboat.productBtModel) as product_name3,productboat.productBTStatus , productwatch.productWPrice ,productwatch.Wpost_main_img ,concat(productwatch.productWBrand," ",productwatch.productWModel) as product_name4,productwatch.productWStatus , productvertu.productVPrice ,productvertu.Vpost_main_img 
    ,concat(productvertu.productVBrand," ",productvertu.productVModel) as product_name5,
    productvertu.productVStatus , productproperty.productPRPrice ,productproperty.PRpost_main_img ,concat(productproperty.productPropSC," ",productproperty.productPropType) as product_name6,
    productproperty.productPRStatus , productphone.productPHPrice ,productphone.PHpost_main_img ,concat(productphone.productPBrand," ",productphone.productPModel) as product_name7,
    productphone.productPHStatus , productnp.productNPPrice ,productnp.NPpost_main_img,concat(productnp.productNPCode," ",productnp.productNPNmbr) as product_name8,productnp.productNPDigits,productnp.productNPStatus , productmn.productMNPrice ,productmn.MNpost_main_img ,productmn.productOperator,concat(productmn.productMNPrefix," ",productmn.productMNNmbr) as product_name9,
    productmn.productMNStatus,productCCallPrice,productBCallPrice,productBtCallPrice,productWCallPrice,productVCallPrice,productPropCallPrice,productPhCallPrice,productNPCallPrice,productMNCallPrice,
    cartCType,cartBType,cartBTType,cartWType,cartVType,cartPRType,cartPHType,cartNPType,cartMNType FROM `post`
    left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
   
     left join productcar on (post.productCategoryID=productcar.productCategoryID and post.productID=productcar.productID) left join productbike on (post.productCategoryID=productbike.productCategoryID and post.productID=productbike.productID) left join productboat on (post.productCategoryID=productboat.productCategoryID and post.productID=productboat.productID)
      left join productmn on (post.productCategoryID=productmn.productCategoryID and post.productID=productmn.productID) left join productnp on (post.productCategoryID=productnp.productCategoryID and post.productID=productnp.productID)
       left join productphone on (post.productCategoryID=productphone.productCategoryID and post.productID=productphone.productID) left join productproperty on (post.productCategoryID=productproperty.productCategoryID and post.productID=productproperty.productID) 
       left join productvertu on (post.productCategoryID=productvertu.productCategoryID and post.productID=productvertu.productID) left join productwatch on (post.productCategoryID=productwatch.productCategoryID and post.productID=productwatch.productID)
        where( (post.postStatus=1 and (productcar.productCStatus!=3)) or (post.postStatus=1 and (productbike.productBStatus!=1 and productbike.productBStatus!=3)) or (post.postStatus=1 and (productboat.productBTStatus!=1 and productboat.productBTStatus!=3)) or (post.postStatus=1 and (productnp.productNPStatus!=1 and productnp.productNPStatus!=3) ) or (post.postStatus=1 and (productvertu.productVStatus!=1 and productvertu.productVStatus!=3) )or (post.postStatus=1 and (productwatch.productWStatus!=1 and productwatch.productWStatus!=3)) or (post.postStatus=1 and (productmn.productMNStatus!=1 and productmn.productMNStatus!=3)) or (post.postStatus=1 and (productphone.productPHStatus!=1 and productphone.productPHStatus!=3)) or (post.postStatus=1 and (productproperty.productPRStatus!=1 and productproperty.productPRStatus!=3) ))
         and post.traderID='.$trader_id.' order by post.postSubmissionOn DESC limit ' .$limit .' offset '.$offset);
    
          return $qry->result();
   
}
function cnt_getproducttrader($trader_id) {
    $qry = $this->db->query('SELECT post.traderID,post.productViewCount,post.postID,post.productCategoryID,post.postSubmissionOn,post.productID, productcar.productCPrice ,productcar.Cpost_main_img ,concat(productcar.productCBrand, " ",productcar.productCModel) as product_name1,productcar.productCStatus, productbike.productBPrice ,productbike.Bpost_main_img ,concat(productbike.productBBrand, " ",productbike.productBModel) as product_name2,productbike.productBStatus , productboat.productBTPrice ,productboat.BTpost_main_img ,concat(productboat.productBtBrand," ",productboat.productBtModel) as product_name3,productboat.productBTStatus , productwatch.productWPrice ,productwatch.Wpost_main_img ,concat(productwatch.productWBrand," ",productwatch.productWModel) as product_name4,productwatch.productWStatus , productvertu.productVPrice ,productvertu.Vpost_main_img 
    ,concat(productvertu.productVBrand," ",productvertu.productVModel) as product_name5,
    productvertu.productVStatus , productproperty.productPRPrice ,productproperty.PRpost_main_img ,concat(productproperty.productPropSC," ",productproperty.productPropType) as product_name6,
    productproperty.productPRStatus , productphone.productPHPrice ,productphone.PHpost_main_img ,concat(productphone.productPBrand," ",productphone.productPModel) as product_name7,
    productphone.productPHStatus , productnp.productNPPrice ,productnp.NPpost_main_img,concat(productnp.productNPCode," ",productnp.productNPNmbr) as product_name8,productnp.productNPDigits,productnp.productNPStatus , productmn.productMNPrice ,productmn.MNpost_main_img ,productmn.productOperator,concat(productmn.productMNPrefix," ",productmn.productMNNmbr) as product_name9,
    productmn.productMNStatus FROM `post`
     left join productcar on (post.productCategoryID=productcar.productCategoryID and post.productID=productcar.productID) left join productbike on (post.productCategoryID=productbike.productCategoryID and post.productID=productbike.productID) left join productboat on (post.productCategoryID=productboat.productCategoryID and post.productID=productboat.productID)
      left join productmn on (post.productCategoryID=productmn.productCategoryID and post.productID=productmn.productID) left join productnp on (post.productCategoryID=productnp.productCategoryID and post.productID=productnp.productID)
       left join productphone on (post.productCategoryID=productphone.productCategoryID and post.productID=productphone.productID) left join productproperty on (post.productCategoryID=productproperty.productCategoryID and post.productID=productproperty.productID) 
       left join productvertu on (post.productCategoryID=productvertu.productCategoryID and post.productID=productvertu.productID) left join productwatch on (post.productCategoryID=productwatch.productCategoryID and post.productID=productwatch.productID)
        where( (post.postStatus=1 and (productcar.productCStatus!=3)) or (post.postStatus=1 and (productbike.productBStatus!=1 and productbike.productBStatus!=3)) or (post.postStatus=1 and (productboat.productBTStatus!=1 and productboat.productBTStatus!=3)) or (post.postStatus=1 and (productnp.productNPStatus!=1 and productnp.productNPStatus!=3) ) or (post.postStatus=1 and (productvertu.productVStatus!=1 and productvertu.productVStatus!=3) )or (post.postStatus=1 and (productwatch.productWStatus!=1 and productwatch.productWStatus!=3)) or (post.postStatus=1 and (productmn.productMNStatus!=1 and productmn.productMNStatus!=3)) or (post.postStatus=1 and (productphone.productPHStatus!=1 and productphone.productPHStatus!=3)) or (post.postStatus=1 and (productproperty.productPRStatus!=1 and productproperty.productPRStatus!=3) ))
         and post.traderID='.$trader_id.' order by post.postSubmissionOn DESC');
    return $qry->result();
}

function cnt_fetch_tr_solditems($trader_id) {
    $qry = $this->db->query('SELECT count(*) as sold_cnt
         FROM `post`
         left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`

         left join productcar on (post.productCategoryID=productcar.productCategoryID and post.productID=productcar.productID)
         left join productbike on (post.productCategoryID=productbike.productCategoryID and post.productID=productbike.productID)
         left join productboat on (post.productCategoryID=productboat.productCategoryID and post.productID=productboat.productID)
         left join productmn on (post.productCategoryID=productmn.productCategoryID and post.productID=productmn.productID)
         left join productnp on (post.productCategoryID=productnp.productCategoryID and post.productID=productnp.productID)
         left join productphone on (post.productCategoryID=productphone.productCategoryID and post.productID=productphone.productID)
         left join productproperty on (post.productCategoryID=productproperty.productCategoryID and post.productID=productproperty.productID)
         left join productvertu on (post.productCategoryID=productvertu.productCategoryID and  post.productID=productvertu.productID)
         left join productwatch on (post.productCategoryID=productwatch.productCategoryID and post.productID=productwatch.productID) 
         where   ((post.postStatus=1 and productcar.productCStatus=1) or (post.postStatus=1 and productbike.productBStatus=1) or (post.postStatus=1 and productboat.productBTStatus=1) or (post.postStatus=1 and productnp.productNPStatus=1 ) or (post.postStatus=1 and productvertu.productVStatus=1 )or (post.postStatus=1 and productwatch.productWStatus=1) or (post.postStatus=1 and productmn.productMNStatus=1) or (post.postStatus=1 and productphone.productPHStatus=1) or (post.postStatus=1 and productproperty.productPRStatus=1 )) and
           trader.traderID=' . $trader_id);
    return $qry->result();
}

function cnt_fetch_tr_bookeditems($trader_id) {
    $qry = $this->db->query('SELECT count(*) as book_cnt
         FROM `post`
         left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`

         left join productcar on (post.productCategoryID=productcar.productCategoryID and post.productID=productcar.productID)
         left join productbike on (post.productCategoryID=productbike.productCategoryID and post.productID=productbike.productID)
         left join productboat on (post.productCategoryID=productboat.productCategoryID and post.productID=productboat.productID)
         left join productmn on (post.productCategoryID=productmn.productCategoryID and post.productID=productmn.productID)
         left join productnp on (post.productCategoryID=productnp.productCategoryID and post.productID=productnp.productID)
         left join productphone on (post.productCategoryID=productphone.productCategoryID and post.productID=productphone.productID)
         left join productproperty on (post.productCategoryID=productproperty.productCategoryID and post.productID=productproperty.productID)
         left join productvertu on (post.productCategoryID=productvertu.productCategoryID and  post.productID=productvertu.productID)
         left join productwatch on (post.productCategoryID=productwatch.productCategoryID and post.productID=productwatch.productID) 
         where   ((post.postStatus=1 and productcar.productCStatus=2) or (post.postStatus=1 and productbike.productBStatus=2) or (post.postStatus=1 and productboat.productBTStatus=2) or (post.postStatus=1 and productnp.productNPStatus=2 ) or (post.postStatus=1 and productvertu.productVStatus=2 )or (post.postStatus=1 and productwatch.productWStatus=2) or (post.postStatus=1 and productmn.productMNStatus=2) or (post.postStatus=1 and productphone.productPHStatus=2) or (post.postStatus=1 and productproperty.productPRStatus=2 )) and
           trader.traderID=' . $trader_id);
    return $qry->result();
}

function cnt_fetch_tr_totalpost($trader_id) {
    $qry = $this->db->query('SELECT count(*) as totlal_post_cnt FROM post where  traderID=' . $trader_id);
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
    function get_mail($trader_id) {
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

    public function prd_viewcnt($product_id, $prod_view_cnt) {

        $data = array();
        $data['productViewCount'] = $prod_view_cnt;
        $this->db->where('productID', $product_id);
        $this->db->update('product', $data);
        /* $this->db->where('productID',$product_id);
          $q= $this->db->get('product');
          return $q->result(); */
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

    function getemail($product_id) {
        $this->db->select('product.productID,product.productImage,product.productName,product.productPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,product.productSubmitDate,trader.traderContactNum,product.productDesc,trader.traderEmailID');
        $this->db->from('product');
        $this->db->join('trader', 'product.traderID=trader.traderID');
        $this->db->where('product.productID', $product_id);
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

    function getImage($product_id, $cat_id) {

        $tb = $this->getTable($cat_id);
        $this->db->select($tb['item'] . ' as image');
        $this->db->from($tb['table']);
        $this->db->where('productCategoryID', $cat_id);
        $this->db->where('productID', $product_id);
        $this->db->limit(1);
        $query = $this->db->get();
       
		if(count($query->row())){
            return $query->row()->image ;
		 }
    }

    function getTitle($product_id, $cat_id) {

        $tb = $this->getTable($cat_id);

        $tb = $this->getTable($cat_id);
        $this->db->select($tb['brand'] . ' as brand');
        $this->db->select($tb['model'] . ' as model');
        $this->db->from($tb['table']);
        $this->db->where('productCategoryID', $cat_id);
        $this->db->where('productID', $product_id);
        $this->db->limit(1);
        $query = $this->db->get();
		$row_cnt = $query->num_rows;
		if($row_cnt > 0){
		 $result = $query->row();
        return $result->brand . ' ' . $result->model;
		}
       
    }

    function getTable($cat_id) {
        if ($cat_id == 1) {
            $table = 'productcar';
            $item = 'Cpost_main_img';
            $brand = 'productCBrand';
            $model = 'productCModel';
        }
        if ($cat_id == 2) {
            $table = 'productbike';
            $item = 'Bpost_main_img';
            $brand = 'productBBrand';
            $model = 'productBModel';
        }
        if ($cat_id == 3) {
            $table = 'productnp';
            $item = 'NPpost_main_img';
            $brand = 'productNPCode';
            $model = 'productNPNmbr';
        }
        if ($cat_id == 4) {
            $table = 'productvertu';
            $item = 'Vpost_main_img';
            $brand = 'productVBrand';
            $model = 'productVModel';
        }
        if ($cat_id == 5) {
            $table = 'productwatch';
            $item = 'Wpost_main_img';
            $brand = 'productWBrand';
            $model = 'productWModel';
        }
        if ($cat_id == 6) {
            $table = 'productmn';
            $item = 'MNpost_main_img';
            $brand = 'productMNPrefix';
            $model = 'productMNNmbr';
        }
        if ($cat_id == 7) {
            $table = 'productboat';
            $item = 'BTpost_main_img';
            $brand = 'productBtBrand';
            $model = 'productBtModel';
        }
        if ($cat_id == 8) {
            $table = 'productphone';
            $item = 'PHpost_main_img';
            $brand = 'productPBrand';
            $model = 'productPModel';
        }
        if ($cat_id == 9) {
            $table = 'productproperty';
            $item = 'PRpost_main_img';
            $brand = 'productPropSC';
            $model = 'productPropType';
        }
        $tb['table'] = $table;
        $tb['item'] = $item;
        $tb['brand'] = $brand;
        $tb['model'] = $model;
        return $tb;
    }
    function fetch_bike_imgs($product_id, $cat_id) {
        $bike_img_qry = $this->db->query('SELECT productiv.productImage ,productiv.productVideo,productiv.productVideoCount,post.productViewCount FROM `post`
            left join productbike on ((post.productCategoryID =productbike.productCategoryID) and (post.productID=productbike.productID)) 
            left join productiv on (post.postID=productiv.postID)
            where productbike.productCategoryID=' . $cat_id . ' and productbike.productID=' . $product_id);
        return $bike_img_qry->result();
    }

    function fetch_vertu_imgs($product_id, $cat_id) {
        $vertu_img_qry = $this->db->query('SELECT productiv.productImage ,productiv.productVideo,productiv.productVideoCount,post.productViewCount FROM `post`
                            left join productvertu on ((post.productCategoryID =productvertu.productCategoryID) and (post.productID=productvertu.productID))
                            left join productiv on (post.postID=productiv.postID) where productvertu.productCategoryID=' . $cat_id . ' and productvertu.productID=' . $product_id);
        return $vertu_img_qry->result();
    }

    function fetch_watch_imgs($product_id, $cat_id) {
        $watch_img_qry = $this->db->query('SELECT productiv.productImage ,productiv.productVideo,productiv.productVideoCount,post.productViewCount FROM `post`  
            left join productwatch on ((post.productCategoryID =productwatch.productCategoryID) and (post.productID=productwatch.productID)) 
            left join productiv on (post.postID=productiv.postID)
            where productwatch.productCategoryID=' . $cat_id . ' and productwatch.productID=' . $product_id);
        return $watch_img_qry->result();
    }

    function fetch_boat_imgs($product_id, $cat_id) {
        $boat_img_qry = $this->db->query('SELECT productiv.productImage ,productiv.productVideo,productiv.productVideoCount,post.productViewCount FROM `post` 
            left   join productboat on ((post.productCategoryID =productboat.productCategoryID) and (post.productID=productboat.productID))
            left join productiv on (post.postID=productiv.postID)
        where productboat.productCategoryID=' . $cat_id . ' and productboat.productID=' . $product_id);
        return $boat_img_qry->result();
    }

    function fetch_iphone_imgs($product_id, $cat_id) {
        $iphone_img_qry = $this->db->query('SELECT productiv.productImage ,productiv.productVideo,productiv.productVideoCount,post.productViewCount FROM `post`  
            left join productphone on ((post.productCategoryID =productphone.productCategoryID) and (post.productID=productphone.productID)) 
            left join productiv on (post.postID=productiv.postID)
            where productphone.productCategoryID=' . $cat_id . ' and productphone.productID=' . $product_id);
        return $iphone_img_qry->result();
    }

    function fetch_prop_imgs($product_id, $cat_id) {
        $prop_img_qry = $this->db->query('SELECT productiv.productImage ,productiv.productVideo,productiv.productVideoCount,post.productViewCount FROM `post` 
            left join productproperty on ((post.productCategoryID =productproperty.productCategoryID) and (post.productID=productproperty.productID)) 
            left join productiv on (post.postID=productiv.postID)
            where productproperty.productCategoryID=' . $cat_id . ' and productproperty.productID=' . $product_id);
        return $prop_img_qry->result();
    }
   function get_car($limit, $offset) {
        $this->db->select('post.postID, post.postStatus, post.postSubmissionOn, productcar.productCategoryID, productcar.productID, productcar.productCategoryName, productcar.productCPrice as productPrice,productCCallPrice as CallPrice, cartCType as cart_type,trader.traderID,trader.usertype,trader.traderFullName, trader.traderLocation, trader.traderImage, productcar.Cpost_main_img as productImage, concat(productcar.productCModel," ",productcar.productCBrand) as productName, productcar.productCStatus as productStatus');
        $this->db->from('productcar');
        $this->db->join('trader', 'productcar.traderID=trader.traderID');
        $this->db->join('post', 'productcar.productCategoryID=post.productCategoryID AND productcar.productID=post.productID');
        $this->db->where('productcar.productCategoryID', 1);
        $this->db->where('post.postStatus', 1);
        $this->db->where('productcar.productCStatus !=', 3);
        $this->db->order_by('post.postSubmissionOn', 'desc');
        $this->db->limit($limit, $offset);

        $qry = $this->db->get();
     
        $myqry = $qry->result();

        // $this->db->select('post.postID');
        // $this->db->from('productcar');
        // $this->db->join('trader', 'productcar.traderID=trader.traderID');
        // $this->db->join('post', 'productcar.productCategoryID=post.productCategoryID AND productcar.productID=post.productID');
        // $this->db->where('productcar.productCategoryID', 1);
        // $this->db->where('post.postStatus', 1);
        // $this->db->where('productcar.productCStatus !=', 3);
        // $cntqry = $this->db->get();
        // $count_qry = $cntqry->result();

        return array(
            'qry' => $myqry
        );
    }
    // function get_car($limit, $offset) {
    //     $this->db->select('productcar.productCategoryID,productcar.productID,productiv.productImage,productcar.productCategoryName,productcar.productCPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productcar.productCSubmitDate,productcar.Cpost_main_img,productcar.productCModel,productcar.productCBrand');
    //     $this->db->from('productcar');
    //     $this->db->join('trader', 'productcar.traderID=trader.traderID');
    //     $this->db->join('productiv', 'productcar.productCategoryID=productiv.productCategoryID AND productcar.productID=productiv.productID');
    //     $this->db->where('productcar.productCategoryID', 1);
    //     $this->db->limit($limit, $offset);
    //     $qry = $this->db->get();
    //     $myqry = $qry->result();


    //     $this->db->select('productcar.productCategoryID,productcar.productID,productiv.productImage,productcar.productCategoryName,productcar.productCPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productcar.productCSubmitDate,productcar.Cpost_main_img,productcar.productCModel,productcar.productCBrand');
    //     $this->db->from('productcar');
    //     $this->db->join('trader', 'productcar.traderID=trader.traderID');
    //     $this->db->join('productiv', 'productcar.productCategoryID=productiv.productCategoryID AND productcar.productID=productiv.productID');
    //     $this->db->where('productcar.productCategoryID', 1);

    //     $cntqry = $this->db->get();
    //     $count_qry = $cntqry->result();

    //     return array(
    //         'qry' => $myqry,
    //         'count' => count($count_qry),
    //     );
    // }

    // public function getproductcar($product_id, $cat_id) {
    //     $this->db->select('productcar.productID,productcar.productCategoryID,productcar.cartCType,productiv.postID,productiv.productImage,productcar.productCategoryName,productcar.productCPrice,trader.traderFullName,trader.traderLocation,trader.traderID,trader.traderImage,productcar.productCSubmitDate,trader.traderContactNum,productcar.productCDesc');
    //     $this->db->from('productcar');
    //     $this->db->join('trader', 'productcar.traderID=trader.traderID');
    //     $this->db->join('productiv', 'productcar.productCategoryID=productiv.productCategoryID AND productcar.productID=productiv.productID');
    //     $this->db->where('productcar.productID', $product_id);
    //     $query = $this->db->get();
    //     return $query->result();
    // }
    public function getproductcar($product_id, $cat_id) {
        $this->db->select('post.postStatus,trader.traderID, post.postID, post.postSubmissionOn, concat(productcar.productCBrand," ",productcar.productCModel) as productName, productcar.productID, productcar.productCategoryID, productcar.cartCType as cartType, '
                . 'productcar.productCPrice as productPrice,productCCallPrice as CallPrice,trader.usertype, trader.traderFullName, trader.traderLocation, trader.traderID, trader.traderImage, trader.traderContactNum, productcar.productCDesc as productDescr, productcar.productCStatus as productStatus');
        $this->db->from('productcar');
        $this->db->join('post', 'productcar.productCategoryID=post.productCategoryID AND productcar.productID=post.productID');

        $this->db->join('trader', 'productcar.traderID=trader.traderID');
        $this->db->where('productcar.productID', $product_id);

        $query = $this->db->get();
        return $query->result();
    }
    function fetch_car_imgs($product_id, $cat_id) {
        $car_img_qry = $this->db->query('SELECT productcar.Cpost_main_img ,productiv.productImage ,productiv.productVideo,productiv.productVideoCount,productiv.productViewCount FROM `productiv`  join productcar on ((productiv.productCategoryID =productcar.productCategoryID) and (productiv.productID=productcar.productID)) 
            where productiv.productCategoryID=' . $cat_id . ' and productiv.productID=' . $product_id);
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

    // function prod_addto_wishlist_car($prod_id) {
    //     $watchcnt = 1;
    //     $i = 1;

    //     $session_data = $this->session->userdata('logged_in');
    //     $trader_id = $session_data['trader_id'];
    //     $prod_avail = 0;
    //     //$data = array('watchlistID'=>$i++,'customerID'=>$trader_id,'productID'=>$prod_id,'watchlistCount'=>$watchcnt,'productAvailability'=>$prod_avail);
    //     $data = array('traderID' => $trader_id, 'productID' => $prod_id, 'productCWatchCount' => $watchcnt, 'productLive' => $prod_avail);
    //     $this->db->insert('productcar', $data);
    // }

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
    function get_opername_mob($product_id) {
        $this->db->select('productOperator');
        $this->db->from('productmn');
        $this->db->where('productID', $product_id);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $result = $query->result();
            foreach ($result as $row) {
                return $row->productOperator;
            }
        } else {
            return false;
        }
     }
    // function noplate_cat($limit, $offset) {
    //     $this->db->select('productnp.productCategoryID,productnp.productID,productiv.productImage,productnp.productCategoryName,productnp.productNPPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productnp.productNPSubmitDate');
    //     $this->db->from('productnp');
    //     $this->db->join('trader', 'productnp.traderID=trader.traderID');
    //     $this->db->join('productiv', 'productnp.productCategoryID=productiv.productCategoryID AND productnp.productID=productiv.productID');
    //     $this->db->where('productnp.productCategoryID', 3);
    //     $this->db->limit($limit, $offset);
    //     $qry = $this->db->get();
    //     $myqry = $qry->result();


    //     $this->db->select('productnp.productCategoryID,productnp.productID,productiv.productImage,productnp.productCategoryName,productnp.productNPPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productnp.productNPSubmitDate');
    //     $this->db->from('productnp');
    //     $this->db->join('trader', 'productnp.traderID=trader.traderID');
    //     $this->db->join('productiv', 'productnp.productCategoryID=productiv.productCategoryID AND productnp.productID=productiv.productID');
    //     $this->db->where('productnp.productCategoryID', 3);

    //     $cntqry = $this->db->get();
    //     $count_qry = $cntqry->result();
    //     return array(
    //         'qry' => $myqry,
    //         'count' => count($count_qry),
    //     );
    // }

    // function mdl_noplate_details($product_id) {
    //     $this->db->select('productnp.productID,productnp.cartNPType,productiv.productImage,productnp.productCategoryName,productnp.productNPPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productnp.productNPSubmitDate,trader.traderContactNum,productnp.productNPDesc');
    //     $this->db->from('productnp');
    //     $this->db->join('trader', 'productnp.traderID=trader.traderID');
    //     $this->db->join('productiv', 'productnp.productCategoryID=productiv.productCategoryID AND productnp.productID=productiv.productID');
    //     $this->db->where('productnp.productID', $product_id);
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    // public function record_count_noplate() {
    //     return $this->db->count_all('productnp', 'trader', 'productiv');
    // }

    // function sendemail_np($product_id) {
    //     $this->db->select('productnp.productID,productnp.productCategoryName,productnp.productNPPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productnp.productNPSubmitDate,trader.traderContactNum,productnp.productNPDesc,trader.traderEmailID');
    //     $this->db->from('productnp');
    //     $this->db->join('trader', 'productnp.traderID=trader.traderID');
    //     $this->db->where('productnp.productID', $product_id);
    //     $query = $this->db->get();
    //     if ($query->num_rows() == 1) {
    //         $result = $query->result();
    //         foreach ($result as $row) {
    //             return $row->traderEmailID;
    //         }
    //     } else {
    //         return false;
    //     }
    // }

    // function vertu_cat($limit, $offset) {
    //     $this->db->select('trader.traderID,productiv.postID,productvertu.productCategoryID,productvertu.productID,productiv.productImage,productvertu.productCategoryName,productvertu.productVBrand,productvertu.productVModel,productvertu.productVPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productvertu.productVSubmitDate');
    //     $this->db->from('productvertu');
    //     $this->db->join('trader', 'productvertu.traderID=trader.traderID');
    //     $this->db->join('productiv', 'productvertu.productCategoryID=productiv.productCategoryID AND productvertu.productID=productiv.productID');
    //     $this->db->where('productvertu.productCategoryID', 4);
    //     $this->db->limit($limit, $offset);
    //     $qry = $this->db->get();
    //     $myqry = $qry->result();

    //     $this->db->select('trader.traderID,productiv.postID,productvertu.productCategoryID,productvertu.productID,productiv.productImage,productvertu.productCategoryName,productvertu.productVBrand,productvertu.productVModel,productvertu.productVPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productvertu.productVSubmitDate');
    //     $this->db->from('productvertu');
    //     $this->db->join('trader', 'productvertu.traderID=trader.traderID');
    //     $this->db->join('productiv', 'productvertu.productCategoryID=productiv.productCategoryID AND productvertu.productID=productiv.productID');
    //     $this->db->where('productvertu.productCategoryID', 4);

    //     $cntqry = $this->db->get();
    //     $count_qry = $cntqry->result();
    //     return array(
    //         'qry' => $myqry,
    //         'count' => count($count_qry),
    //     );
    // }

    // function mdl_vertu_details($product_id) {
    //     $this->db->select('productvertu.productID,productvertu.cartVType,productiv.productImage,productvertu.productCategoryName,productvertu.productVBrand,productvertu.productVModel,productvertu.productVPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productvertu.productVSubmitDate,trader.traderContactNum,productvertu.productVDesc');
    //     $this->db->from('productvertu');
    //     $this->db->join('trader', 'productvertu.traderID=trader.traderID');

    //     $this->db->join('productiv', 'productvertu.productCategoryID=productiv.productCategoryID AND productvertu.productID=productiv.productID');
    //     $this->db->where('productvertu.productID', $product_id);
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    // public function record_count_vertu() {
    //     return $this->db->count_all('productvertu', 'trader', 'productiv');
    // }

    // function sendemail_vertu($product_id) {
    //     $this->db->select('productvertu.productID,productvertu.productCategoryName,productvertu.productVPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productvertu.productVSubmitDate,trader.traderContactNum,productvertu.productVDesc,trader.traderEmailID');
    //     $this->db->from('productvertu');
    //     $this->db->join('trader', 'productvertu.traderID=trader.traderID');
    //     $this->db->where('productvertu.productID', $product_id);
    //     $query = $this->db->get();
    //     if ($query->num_rows() == 1) {
    //         $result = $query->result();
    //         foreach ($result as $row) {
    //             return $row->traderEmailID;
    //         }
    //     } else {
    //         return false;
    //     }
    // }

    // function watch_cat($limit, $offset) {

    //     $this->db->select('trader.traderID,productiv.postID,productwatch.productCategoryID,productwatch.productID,productiv.productImage,productwatch.productCategoryName,productwatch.productWPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productwatch.productWSubmitDate');
    //     $this->db->from('productwatch');
    //     $this->db->join('trader', 'productwatch.traderID=trader.traderID');
    //     $this->db->join('productiv', 'productwatch.productCategoryID=productiv.productCategoryID AND productwatch.productID=productiv.productID');
    //     $this->db->where('productwatch.productCategoryID', 5);
    //     $this->db->limit($limit, $offset);
    //     $qry = $this->db->get();
    //     $myqry = $qry->result();

    //     $this->db->select('trader.traderID,productiv.postID,productwatch.productCategoryID,productwatch.productID,productiv.productImage,productwatch.productCategoryName,productwatch.productWPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productwatch.productWSubmitDate');
    //     $this->db->from('productwatch');
    //     $this->db->join('trader', 'productwatch.traderID=trader.traderID');
    //     $this->db->join('productiv', 'productwatch.productCategoryID=productiv.productCategoryID AND productwatch.productID=productiv.productID');
    //     $this->db->where('productwatch.productCategoryID', 5);

    //     $cntqry = $this->db->get();
    //     $count_qry = $cntqry->result();
    //     return array(
    //         'qry' => $myqry,
    //         'count' => count($count_qry),
    //     );
    // }

    // function mdl_watch_details($product_id) {
    //     $this->db->select('productwatch.productID,productstatus.cartType,productiv.productImage,productwatch.productCategoryName,productwatch.productWPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productwatch.productWSubmitDate,trader.traderContactNum,productwatch.productWDesc');
    //     $this->db->from('productwatch');
    //     $this->db->join('trader', 'productwatch.traderID=trader.traderID');
    //     $this->db->join('productstatus', 'productwatch.productID=productstatus.productID');
    //     $this->db->join('productiv', 'productwatch.productCategoryID=productiv.productCategoryID AND productwatch.productID=productiv.productID');
    //     $this->db->where('productwatch.productID', $product_id);
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    // public function record_count_watch() {
    //     return $this->db->count_all('productwatch', 'trader', 'productiv');
    // }

    // function sendemail_watch($product_id) {
    //     $this->db->select('productwatch.productID,productwatch.productCategoryName,productwatch.productWPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productwatch.productWSubmitDate,trader.traderContactNum,productwatch.productWDesc,trader.traderEmailID');
    //     $this->db->from('productwatch');
    //     $this->db->join('trader', 'productwatch.traderID=trader.traderID');
    //     $this->db->where('productwatch.productID', $product_id);
    //     $query = $this->db->get();
    //     if ($query->num_rows() == 1) {
    //         $result = $query->result();
    //         foreach ($result as $row) {
    //             return $row->traderEmailID;
    //         }
    //     } else {
    //         return false;
    //     }
    // }

    // function mobileno_cat($limit, $offset) {
    //     $this->db->select('productmn.productID,productiv.productImage,productmn.productCategoryName,productmn.productMNNmbr,productmn.productMNPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productmn.productMNSubmitDate');
    //     $this->db->from('productmn');
    //     $this->db->join('trader', 'productmn.traderID=trader.traderID');
    //     $this->db->join('productiv', 'productmn.productCategoryID=productiv.productCategoryID AND productmn.productID=productiv.productID');
    //     $this->db->where('productmn.productCategoryID', 6);
    //     $this->db->limit($limit, $offset);
    //     $qry = $this->db->get();
    //     $myqry = $qry->result();

    //     $this->db->select('productmn.productID,productiv.productImage,productmn.productCategoryName,productmn.productMNNmbr,productmn.productMNPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productmn.productMNSubmitDate');
    //     $this->db->from('productmn');
    //     $this->db->join('trader', 'productmn.traderID=trader.traderID');
    //     $this->db->join('productiv', 'productmn.productCategoryID=productiv.productCategoryID AND productmn.productID=productiv.productID');
    //     $this->db->where('productmn.productCategoryID', 6);

    //     $cntqry = $this->db->get();
    //     $count_qry = $cntqry->result();
    //     return array(
    //         'qry' => $myqry,
    //         'count' => count($count_qry),
    //     );
    // }

    // function mdl_mobileno_details($product_id) {
    //     $this->db->select('productmn.productID,productstatus.cartMNType,productiv.productImage,productmn.productCategoryName,productmn.productMNNmbr,productmn.productMNPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productmn.productMNSubmitDate,trader.traderContactNum,productmn.productMNDesc');
    //     $this->db->from('productmn');
    //     $this->db->join('trader', 'productmn.traderID=trader.traderID');
    //     $this->db->join('productstatus', 'productmn.productID=productstatus.productID');
    //     $this->db->join('productiv', 'productmn.productCategoryID=productiv.productCategoryID AND productmn.productID=productiv.productID');
    //     $this->db->where('productmn.productID', $product_id);
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    // public function record_count_mobileno() {
    //     return $this->db->count_all('productmn', 'trader', 'productiv');
    // }

    // function sendemail_mn($product_id) {
    //     $this->db->select('productmn.productID,productmn.productCategoryName,productmn.productMNPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productmn.productMNSubmitDate,trader.traderContactNum,productmn.productMNDesc,trader.traderEmailID');
    //     $this->db->from('productmn');
    //     $this->db->join('trader', 'productmn.traderID=trader.traderID');
    //     $this->db->where('productmn.productID', $product_id);
    //     $query = $this->db->get();
    //     if ($query->num_rows() == 1) {
    //         $result = $query->result();
    //         foreach ($result as $row) {
    //             return $row->traderEmailID;
    //         }
    //     } else {
    //         return false;
    //     }
    // }

    // function get_boat($limit, $offset) {
    //     $this->db->select('trader.traderID,productboat.productCategoryID,productboat.productID,productiv.productImage,productboat.productCategoryName,productboat.productBTPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productboat.productBTSubmitDate');
    //     $this->db->from('productboat');
    //     $this->db->join('trader', 'productboat.traderID=trader.traderID');
    //     $this->db->join('productiv', 'productboat.productCategoryID=productiv.productCategoryID AND productboat.productID=productiv.productID');
    //     $this->db->where('productboat.productCategoryID', 7);
    //     $this->db->limit($limit, $offset);
    //     $qry = $this->db->get();
    //     $myqry = $qry->result();

    //     $this->db->select('trader.traderID,productboat.productCategoryID,productboat.productID,productiv.productImage,productboat.productCategoryName,productboat.productBTPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productboat.productBTSubmitDate');
    //     $this->db->from('productboat');
    //     $this->db->join('trader', 'productboat.traderID=trader.traderID');
    //     $this->db->join('productiv', 'productboat.productCategoryID=productiv.productCategoryID AND productboat.productID=productiv.productID');
    //     $this->db->where('productboat.productCategoryID', 7);

    //     $cntqry = $this->db->get();
    //     $count_qry = $cntqry->result();
    //     return array(
    //         'qry' => $myqry,
    //         'count' => count($count_qry),
    //     );
    // }

    // public function getproductboat($product_id) {
    //     $this->db->select('productboat.productID,productboat.cartBTType,productiv.productImage,productboat.productCategoryName,productboat.productBTPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productboat.productBTSubmitDate,trader.traderContactNum,productboat.productBDesc');
    //     $this->db->from('productboat');
    //     $this->db->join('trader', 'productboat.traderID=trader.traderID');

    //     $this->db->join('productiv', 'productboat.productCategoryID=productiv.productCategoryID AND productboat.productID=productiv.productID');
    //     $this->db->where('productboat.productID', $product_id);
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    // public function record_count_boat() {
    //     return $this->db->count_all('productboat', 'trader', 'productiv');
    // }

    // function sendemail_boat($product_id) {
    //     $this->db->select('productboat.productID,productboat.productCategoryName,productboat.productBPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productboat.productBSubmitDate,trader.traderContactNum,productboat.productBDesc,trader.traderEmailID');
    //     $this->db->from('productboat');
    //     $this->db->join('trader', 'productboat.traderID=trader.traderID');
    //     $this->db->where('productboat.productID', $product_id);
    //     $query = $this->db->get();
    //     if ($query->num_rows() == 1) {
    //         $result = $query->result();
    //         foreach ($result as $row) {
    //             return $row->traderEmailID;
    //         }
    //     } else {
    //         return false;
    //     }
    // }

    // function iphone_cat($limit, $offset) {
    //     $this->db->select('trader.traderID,productiv.postID,productphone.productCategoryID,trader.traderID,productiv.postID,productphone.productID,productphone.PHpost_main_img,productphone.productCategoryName,productphone.productPBrand,productphone.productPModel,productphone.productPHPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productphone.productPSubmitDate');
    //     $this->db->from('productphone');
    //     $this->db->join('trader', 'productphone.traderID=trader.traderID');
    //     $this->db->join('productiv', 'productphone.productCategoryID=productiv.productCategoryID AND productphone.productID=productiv.productID');
    //     $this->db->where('productphone.productCategoryID', 8);
    //     $this->db->limit($limit, $offset);
    //     $qry = $this->db->get();
    //     $myqry = $qry->result();

    //     $this->db->select('trader.traderID,productiv.postID,productphone.productCategoryID,trader.traderID,productiv.postID,productphone.productID,productphone.PHpost_main_img,productphone.productCategoryName,productphone.productPBrand,productphone.productPModel,productphone.productPHPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productphone.productPSubmitDate');
    //     $this->db->from('productphone');
    //     $this->db->join('trader', 'productphone.traderID=trader.traderID');
    //     $this->db->join('productiv', 'productphone.productCategoryID=productiv.productCategoryID AND productphone.productID=productiv.productID');
    //     $this->db->where('productphone.productCategoryID', 8);

    //     $cntqry = $this->db->get();
    //     $count_qry = $cntqry->result();
    //     return array(
    //         'qry' => $myqry,
    //         'count' => count($count_qry),
    //     );
    // }

    // function mdl_iphone_details($product_id) {
    //     $this->db->select('productphone.productID,productphone.cartPHType,productiv.productImage,productphone.productCategoryName,productphone.productPBrand,productphone.productPModel,productphone.productPHPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productphone.productPSubmitDate,trader.traderContactNum,productphone.productPDesc');
    //     $this->db->from('productphone');
    //     $this->db->join('trader', 'productphone.traderID=trader.traderID');

    //     $this->db->join('productiv', 'productphone.productCategoryID=productiv.productCategoryID AND productphone.productID=productiv.productID');
    //     $this->db->where('productphone.productID', $product_id);
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    // public function record_count_phone() {
    //     return $this->db->count_all('productphone', 'trader', 'productiv');
    // }

    // function sendemail_phone($product_id) {
    //     $this->db->select('productphone.productID,productphone.productCategoryName,productphone.productPPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productphone.productPSubmitDate,trader.traderContactNum,productphone.productPDesc,trader.traderEmailID');
    //     $this->db->from('productphone');
    //     $this->db->join('trader', 'productphone.traderID=trader.traderID');
    //     $this->db->where('productphone.productID', $product_id);
    //     $query = $this->db->get();
    //     if ($query->num_rows() == 1) {
    //         $result = $query->result();
    //         foreach ($result as $row) {
    //             return $row->traderEmailID;
    //         }
    //     } else {
    //         return false;
    //     }
    // }

    // function get_property($limit, $offset) {
    //     $this->db->select('productproperty.productID,trader.traderID,productiv.postID,productproperty.productCategoryID,productproperty.PRpost_main_img,productproperty.productCategoryName,productproperty.productPRPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productproperty.productPRSubmitDate');
    //     $this->db->from('productproperty');
    //     $this->db->join('trader', 'productproperty.traderID=trader.traderID');
    //     $this->db->join('productiv', 'productproperty.productCategoryID=productiv.productCategoryID AND productproperty.productID=productiv.productID');
    //     $this->db->where('productproperty.productCategoryID', 9);
    //     $this->db->limit($limit, $offset);
    //     $qry = $this->db->get();
    //     $myqry = $qry->result();

    //     $this->db->select('productproperty.productID,trader.traderID,productiv.postID,productproperty.productCategoryID,productproperty.PRpost_main_img,productproperty.productCategoryName,productproperty.productPRPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productproperty.productPRSubmitDate');
    //     $this->db->from('productproperty');
    //     $this->db->join('trader', 'productproperty.traderID=trader.traderID');
    //     $this->db->join('productiv', 'productproperty.productCategoryID=productiv.productCategoryID AND productproperty.productID=productiv.productID');
    //     $this->db->where('productproperty.productCategoryID', 9);

    //     $cntqry = $this->db->get();
    //     $count_qry = $cntqry->result();
    //     return array(
    //         'qry' => $myqry,
    //         'count' => count($count_qry),
    //     );
    // }

    // public function getproductproperty($product_id) {
    //     $this->db->select('productproperty.productID,productproperty.cartPRType,productiv.productImage,productproperty.productCategoryName,productproperty.productPRPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productproperty.productPRSubmitDate,trader.traderContactNum,productproperty.productDesc');
    //     $this->db->from('productproperty');
    //     $this->db->join('trader', 'productproperty.traderID=trader.traderID');
    //     $this->db->join('productiv', 'productproperty.productCategoryID=productiv.productCategoryID AND productproperty.productID=productiv.productID');
    //     $this->db->where('productproperty.productID', $product_id);
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    // public function record_count_property() {
    //     return $this->db->count_all('productproperty', 'trader', 'productiv');
    // }

    // function sendemail_property($product_id) {
    //     $this->db->select('productproperty.productID,productproperty.productCategoryName,productproperty.productPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productproperty.productSubmitDate,trader.traderContactNum,productproperty.productDesc,trader.traderEmailID');
    //     $this->db->from('productproperty');
    //     $this->db->join('trader', 'productproperty.traderID=trader.traderID');
    //     $this->db->where('productproperty.productID', $product_id);
    //     $query = $this->db->get();
    //     if ($query->num_rows() == 1) {
    //         $result = $query->result();
    //         foreach ($result as $row) {
    //             return $row->traderEmailID;
    //         }
    //     } else {
    //         return false;
    //     }
    // }

    
    function noplate_cat($limit, $offset) {
        $this->db->select('post.postID, post.postStatus, productnp.productCategoryID, productnp.productID, productnp.NPpost_main_img as productImage,concat(productnp.productNPCode," ",productnp.productNPNmbr) as productName,productNPcallPrice as CallPrice, productnp.productNPPrice as productPrice,cartNPType as cart_type,trader.traderID,trader.usertype, trader.traderFullName, trader.traderLocation, trader.traderImage, post.postSubmissionOn, productnp.productNPStatus as productStatus');
        $this->db->from('productnp');
        $this->db->join('trader', 'productnp.traderID=trader.traderID');
        $this->db->join('post', 'productnp.productCategoryID=post.productCategoryID AND productnp.productID=post.productID');
        $this->db->where('productnp.productCategoryID', 3);
        $this->db->where('post.postStatus', 1);
        $this->db->where('productnp.productNPStatus !=', 3);
        $this->db->order_by('post.postSubmissionOn', 'desc');
        $this->db->limit($limit, $offset);
        $qry = $this->db->get();
        $myqry = $qry->result();


        $this->db->select('post.postID,post.postStatus,productnp.productCategoryID,productnp.productID,productnp.NPpost_main_img,productnp.productCategoryName,productnp.productNPPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productnp.productNPSubmitDate');
        $this->db->from('productnp');
        $this->db->join('trader', 'productnp.traderID=trader.traderID');
        $this->db->join('post', 'productnp.productCategoryID=post.productCategoryID AND productnp.productID=post.productID');
        $this->db->where('productnp.productCategoryID', 3);
        $this->db->where('post.postStatus', 1);
        $this->db->where('productnp.productNPStatus !=', 3);

        $cntqry = $this->db->get();
        $count_qry = $cntqry->result();
        return array(
            'qry' => $myqry,
            'count' => count($count_qry),
        );
    }

    function mdl_noplate_details($product_id, $cat_id) {
        $this->db->select('post.postStatus,post.postID, post.productViewCount, concat(productnp.productNPCode," ",productnp.productNPDigits) as productName, trader.traderID, productnp.NPpost_main_img as productImage, productnp.productNPStatus as productStatus, productnp.productCategoryID, productnp.productID, productnp.cartNPType as cartType,'
                . 'productnp.productNPPrice as productPrice, productNPCallPrice as CallPrice,trader.usertype,trader.traderFullName, trader.traderLocation, trader.traderImage, post.postSubmissionOn, trader.traderContactNum, productnp.productNPDesc as productDescr');
        $this->db->from('productnp');
        $this->db->join('trader', 'productnp.traderID=trader.traderID');
        $this->db->join('post', 'productnp.productCategoryID=post.productCategoryID AND productnp.productID=post.productID');
        $this->db->where('productnp.productID', $product_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function record_count_noplate() {
        $car_cnt_qry = $this->db->query('SELECT count(*) as cnt FROM `productnp` 
                    join post on (productnp.productCategoryID=post.productCategoryID AND productnp.productID=post.productID)
                 
                    
                    where  post.postStatus = 1 and (productnp.productNPStatus!=3)');
        return $car_cnt_qry->result();

        //return $this->db->count_all('productnp', 'trader', 'productiv');
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
        $this->db->select('post.postID, post.postStatus, post.postSubmissionOn, trader.traderID, productvertu.productCategoryID, productvertu.productID, productvertu.Vpost_main_img as productImage, productvertu.productCategoryName, concat(productvertu.productVBrand," ",productvertu.productVModel) as productName,productVcallPrice as CallPrice,, productvertu.productVPrice as productPrice,cartVType as cart_type,trader.traderID,trader.usertype, trader.traderFullName, trader.traderLocation, trader.traderImage, productvertu.productVStatus as productStatus');
        $this->db->from('productvertu');
        $this->db->join('trader', 'productvertu.traderID=trader.traderID');
        $this->db->join('post', 'productvertu.productCategoryID=post.productCategoryID AND productvertu.productID=post.productID');
        $this->db->where('productvertu.productCategoryID', 4);
        $this->db->where('post.postStatus', 1);
        $this->db->where('productvertu.productVStatus !=', 3);
        $this->db->order_by('post.postSubmissionOn', 'desc');
        $this->db->limit($limit, $offset);
        $qry = $this->db->get();
        $myqry = $qry->result();

        $this->db->select('post.postID,post.postStatus,post.postSubmissionOn,trader.traderID,productvertu.productCategoryID,productvertu.productID,productvertu.Vpost_main_img,productvertu.productCategoryName,productvertu.productVBrand,productvertu.productVModel,productvertu.productVPrice,trader.traderFullName,trader.traderLocation,trader.traderImage');
        $this->db->from('productvertu');
        $this->db->join('trader', 'productvertu.traderID=trader.traderID');
        $this->db->join('post', 'productvertu.productCategoryID=post.productCategoryID AND productvertu.productID=post.productID');
        $this->db->where('productvertu.productCategoryID', 4);
        $this->db->where('post.postStatus', 1);
        $this->db->where('productvertu.productVStatus !=', 3);
        $cntqry = $this->db->get();
        $count_qry = $cntqry->result();
        return array(
            'qry' => $myqry,
            'count' => count($count_qry),
        );
    }

    function mdl_vertu_details($product_id, $cat_id) {
        $this->db->select('post.postStatus,post.postID, productvertu.productVStatus as productStatus, post.productID, post.productCategoryID, post.postSubmissionOn, trader.traderID, productvertu.productCategoryID, productvertu.productID, productvertu.cartVType as cartType,'
                . 'concat(productvertu.productVBrand," ",productvertu.productVModel) as productName, productvertu.productVPrice as productPrice,productVCallPrice as CallPrice,trader.usertype, trader.traderFullName, trader.traderLocation, trader.traderImage, trader.traderContactNum, productvertu.productVDesc as productDescr');
        $this->db->from('productvertu');
        $this->db->join('trader', 'productvertu.traderID=trader.traderID');
        $this->db->join('post', 'productvertu.productCategoryID=post.productCategoryID AND productvertu.productID=post.productID');

        $this->db->where('productvertu.productID', $product_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function record_count_vertu() {
        $car_cnt_qry = $this->db->query('SELECT count(*) as cnt FROM `productvertu` 
                    join post on (productvertu.productCategoryID=post.productCategoryID AND productvertu.productID=post.productID)
                    join trader on productvertu.traderID=trader.traderID
                    where  post.postStatus = 1 and (productvertu.productVStatus!=3)');
        return $car_cnt_qry->result();
    }

    function sendemail_vertu($product_id) {
        $this->db->select('productvertu.productID,productvertu.productCategoryName,productvertu.productVPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,trader.traderContactNum,productvertu.productVDesc,trader.traderEmailID');
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

        $this->db->select('post.postID, post.postStatus, trader.traderID, productwatch.productCategoryID, productwatch.productID, productwatch.Wpost_main_img as productImage,CONCAT(productwatch.productWBrand," ",productwatch.productWModel) AS productName,productWcallPrice as CallPrice, productwatch.productWPrice as productPrice,cartWType as cart_type,trader.traderID,trader.usertype, trader.traderFullName, trader.traderLocation, trader.traderImage,post.postSubmissionOn, productwatch.productWStatus as productStatus');
        $this->db->from('productwatch');
        $this->db->join('trader', 'productwatch.traderID=trader.traderID');
        $this->db->join('post', 'productwatch.productCategoryID=post.productCategoryID AND productwatch.productID=post.productID');
        $this->db->where('productwatch.productCategoryID', 5);
        $this->db->where('post.postStatus', 1);
        $this->db->where('productwatch.productWStatus !=', 3);
        $this->db->order_by('post.postSubmissionOn', 'desc');
        $this->db->limit($limit, $offset);
        $qry = $this->db->get();
        $myqry = $qry->result();

        $this->db->select('post.postID,post.postStatus,trader.traderID,productwatch.productCategoryID,productwatch.productID,productwatch.Wpost_main_img,productwatch.productCategoryName,productwatch.productWPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productwatch.productWSubmitDate');
        $this->db->from('productwatch');
        $this->db->join('trader', 'productwatch.traderID=trader.traderID');
        $this->db->join('post', 'productwatch.productCategoryID=post.productCategoryID AND productwatch.productID=post.productID');
        $this->db->where('productwatch.productCategoryID', 5);
        $this->db->where('post.postStatus', 1);
        $this->db->where('productwatch.productWStatus !=', 3);

        $cntqry = $this->db->get();
        $count_qry = $cntqry->result();
        return array(
            'qry' => $myqry,
            'count' => count($count_qry),
        );
    }

    function mdl_watch_details($product_id, $cat_id) {
        $this->db->select('post.postStatus,post.postID, post.productID, post.productCategoryID, concat(productwatch.productWBrand," ",productwatch.productWModel) as productName, trader.traderID, productwatch.cartWType as cartType, productwatch.productWStatus as productStatus,'
                . 'productwatch.productWPrice as productPrice,productWCallPrice as CallPrice,trader.usertype, trader.traderFullName, trader.traderLocation, trader.traderImage,post.postSubmissionOn, trader.traderContactNum, productwatch.productWDesc as productDescr');
        $this->db->from('productwatch');
        $this->db->join('trader', 'productwatch.traderID=trader.traderID');
        $this->db->join('post', 'productwatch.productCategoryID=post.productCategoryID AND productwatch.productID=post.productID');

        $this->db->where('productwatch.productID', $product_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function record_count_watch() {
        $car_cnt_qry = $this->db->query('SELECT count(*) as cnt FROM `productwatch` 
        join post on (productwatch.productCategoryID=post.productCategoryID AND productwatch.productID=post.productID)
        
        where  post.postStatus = 1 and (productwatch.productWStatus!=3)');
        return $car_cnt_qry->result();
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
        $this->db->select('post.postID, post.postStatus, productmn.productID, productmn.productCategoryID, productmn.productCategoryName, concat(productmn.productMNPrefix," ",productmn.productMNNmbr) as productName, productmn.productMNPrice as productPrice,productMNcallPrice as CallPrice,cartMNType as cart_type,trader.traderID,trader.usertype, trader.traderFullName, trader.traderLocation, trader.traderImage, post.postSubmissionOn, productmn.MNpost_main_img as productImage, productmn.productMNStatus as productStatus');
        $this->db->from('productmn');
        $this->db->join('trader', 'productmn.traderID=trader.traderID');
        $this->db->join('post', 'productmn.productCategoryID=post.productCategoryID AND productmn.productID=post.productID');

        $this->db->where('productmn.productCategoryID', 6);
        $this->db->where('post.postStatus', 1);
        $this->db->where('productmn.productMNStatus !=', 3);
        $this->db->order_by('post.postSubmissionOn', 'desc');
        $this->db->limit($limit, $offset);
        $qry = $this->db->get();
        $myqry = $qry->result();

        $this->db->select('post.postID,post.postStatus,productmn.productID,productmn.productCategoryName,productmn.productMNNmbr,productmn.productMNPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productmn.productMNSubmitDate');
        $this->db->from('productmn');
        $this->db->join('trader', 'productmn.traderID=trader.traderID');
        $this->db->join('post', 'productmn.productCategoryID=post.productCategoryID AND productmn.productID=post.productID');

        $this->db->where('productmn.productCategoryID', 6);
        $this->db->where('post.postStatus', 1);
        $this->db->where('productmn.productMNStatus !=', 3);
        $cntqry = $this->db->get();
        $count_qry = $cntqry->result();
        return array(
            'qry' => $myqry,
            'count' => count($count_qry),
        );
    }

    function mdl_mobileno_details($product_id, $cat_id) {
        $this->db->select('post.postStatus,post.postID, post.productID, post.productCategoryID, concat(productmn.productMNPrefix," ",productmn.productMNNmbr) as productName, productmn.productMNPrice as productPrice,'
                . 'trader.traderFullName,productMNCallPrice as CallPrice,trader.usertype, trader.traderLocation, trader.traderImage, post.postSubmissionOn, trader.traderContactNum, productmn.productMNDesc as productDescr, productmn.cartMNType as cartType, trader.traderID, productmn.productMNStatus as productStatus,productmn.MNpost_main_img as productImage,post.productViewCount');
        $this->db->from('productmn');
        $this->db->join('trader', 'productmn.traderID=trader.traderID');
        $this->db->join('post', 'productmn.productCategoryID=post.productCategoryID AND productmn.productID=post.productID');

        $this->db->where('productmn.productID', $product_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function record_count_mobileno() {

        /* $this->db->select('post.postID,post.postStatus,productmn.productID,productmn.productCategoryName,productmn.productMNNmbr,productmn.productMNPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productmn.productMNSubmitDate');
          $this->db->from('productmn');
          $this->db->join('trader', 'productmn.traderID=trader.traderID');
          $this->db->join('post', 'productmn.productCategoryID=post.productCategoryID AND productmn.productID=post.productID');

          $this->db->where('productmn.productCategoryID', 6);
          $this->db->where('post.postStatus', 1);
          $this->db->where('productmn.productMNStatus !=', 1);
          $cntqry = $this->db->get();
          return $cntqry->result(); */
        $car_cnt_qry = $this->db->query('SELECT count(*) as cnt FROM `productmn` 
        join post on (productmn.productCategoryID=post.productCategoryID AND productmn.productID=post.productID)
       
        where  post.postStatus = 1 and (productmn.productMNStatus!=3)');
        return $car_cnt_qry->result();
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
        $this->db->select('post.postID, post.postStatus, post.postSubmissionOn, trader.traderID, productboat.productCategoryID, productboat.productID, productboat.BTpost_main_img as productImage, concat(productboat.productBtBrand," ",productboat.productBtModel) as productName, productboat.productBTPrice as productPrice,productBtcallPrice as CallPrice,cartBTType as cart_type,trader.traderID,trader.usertype, trader.traderFullName, trader.traderLocation, trader.traderImage, productboat.productBTStatus as productStatus');
        $this->db->from('productboat');
        $this->db->join('trader', 'productboat.traderID=trader.traderID');
        $this->db->join('post', 'productboat.productCategoryID=post.productCategoryID AND productboat.productID=post.productID');
        $this->db->where('productboat.productCategoryID', 7);
        $this->db->where('post.postStatus', 1);
        $this->db->where('productboat.productBTStatus !=', 3);
        $this->db->order_by('post.postSubmissionOn', 'desc');
        $this->db->limit($limit, $offset);
        $qry = $this->db->get();
        $myqry = $qry->result();

        $this->db->select('post.postID,post.postStatus,post.postSubmissionOn,trader.traderID,productboat.productCategoryID,productboat.productID,productboat.BTpost_main_img,productboat.productCategoryName,productboat.productBTPrice,trader.traderFullName,trader.traderLocation,trader.traderImage');
        $this->db->from('productboat');
        $this->db->join('trader', 'productboat.traderID=trader.traderID');
        $this->db->join('post', 'productboat.productCategoryID=post.productCategoryID AND productboat.productID=post.productID');
        $this->db->where('productboat.productCategoryID', 7);
        $this->db->where('post.postStatus', 1);
        $this->db->where('productboat.productBTStatus !=', 3);
        $cntqry = $this->db->get();
        $count_qry = $cntqry->result();
        return array(
            'qry' => $myqry,
            'count' => count($count_qry),
        );
    }

    public function getproductboat($product_id, $cat_id) {
        $this->db->select('post.postStatus,trader.traderID, post.postID, post.productCategoryID, post.productID, post.postSubmissionOn, productboat.cartBTType as cartType, concat(productboat.productBtBrand," ",productboat.productBtModel) as productName, productboat.productBTPrice as productPrice,'
                . 'trader.traderFullName,productBtCallPrice as CallPrice,trader.usertype, trader.traderLocation, trader.traderImage, trader.traderContactNum, productboat.productBDesc as productDescr, productboat.productBTStatus as productStatus');
        $this->db->from('productboat');
        $this->db->join('trader', 'productboat.traderID=trader.traderID');
        $this->db->join('post', 'productboat.productCategoryID=post.productCategoryID AND productboat.productID=post.productID');

        $this->db->where('productboat.productID', $product_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function record_count_boat() {
        $car_cnt_qry = $this->db->query('SELECT count(*) as cnt FROM `productboat` 
        join post on (productboat.productCategoryID=post.productCategoryID AND productboat.productID=post.productID)
        
        where  post.postStatus = 1 and (productboat.productBTStatus!=3)');
        return $car_cnt_qry->result();
    }

    function sendemail_boat($product_id) {
        $this->db->select('productboat.productID,productboat.productCategoryName,productboat.productBTPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,trader.traderContactNum,productboat.productBDesc,trader.traderEmailID');
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
        $this->db->select('post.postID, post.productID, post.productCategoryID, post.postStatus, post.postSubmissionOn, trader.traderID, productphone.PHpost_main_img as productImage, concat(productphone.productPBrand," ",productphone.productPModel)as productName, productphone.productPHPrice as productPrice,productPhCallPrice as CallPrice,cartPHType as cart_type,trader.traderID,trader.usertype, trader.traderFullName, trader.traderLocation, trader.traderImage, productphone.productPHStatus as productStatus');
        $this->db->from('productphone');
        $this->db->join('trader', 'productphone.traderID=trader.traderID');
        $this->db->join('post', 'productphone.productCategoryID=post.productCategoryID AND productphone.productID=post.productID');
        $this->db->where('productphone.productCategoryID', 8);
        $this->db->where('post.postStatus', 1);
        $this->db->where('productphone.productPHStatus !=', 3);
        $this->db->order_by('post.postSubmissionOn', 'desc');
        $this->db->limit($limit, $offset);

        $qry = $this->db->get();
        $myqry = $qry->result();

        $this->db->select('post.postID,post.postStatus,trader.traderID,,productphone.productCategoryID,trader.traderID,productphone.productID,productphone.PHpost_main_img,productphone.productCategoryName,productphone.productPBrand,productphone.productPModel,productphone.productPHPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,post.postSubmissionOn');
        $this->db->from('productphone');
        $this->db->join('trader', 'productphone.traderID=trader.traderID');
        $this->db->join('post', 'productphone.productCategoryID=post.productCategoryID AND productphone.productID=post.productID');
        $this->db->where('productphone.productCategoryID', 8);
        $this->db->where('post.postStatus', 1);
        $this->db->where('productphone.productPHStatus !=', 3);
        $cntqry = $this->db->get();
        $count_qry = $cntqry->result();
        return array(
            'qry' => $myqry,
            'count' => count($count_qry),
        );
    }

    function mdl_iphone_details($product_id, $cat_id) {
        $this->db->select('post.postStatus,trader.traderID, post.postID, post.postSubmissionOn, productphone.productCategoryID, productphone.productID, productphone.cartPHType as cartType, concat(productphone.productPBrand," ",productphone.productPModel) as productName,'
                . 'productphone.productPHPrice as productPrice,productPhCallPrice as CallPrice,trader.usertype, trader.traderFullName, trader.traderLocation, trader.traderImage, trader.traderContactNum, productphone.productPDesc as productDescr, productphone.productPHStatus as productStatus');
        $this->db->from('productphone');
        $this->db->join('trader', 'productphone.traderID=trader.traderID');
        $this->db->join('post', 'productphone.productCategoryID=post.productCategoryID AND productphone.productID=post.productID');

        $this->db->where('productphone.productID', $product_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function record_count_phone() {
        $car_cnt_qry = $this->db->query('SELECT count(*) as cnt FROM `productphone` 
                    join post on (productphone.productCategoryID=post.productCategoryID AND productphone.productID=post.productID)
                    
                    where  post.postStatus = 1 and (productphone.productPHStatus!=3)');
        return $car_cnt_qry->result();
    }

    function sendemail_phone($product_id) {
        $this->db->select('productphone.productID,productphone.productCategoryName,productphone.productPHPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,trader.traderContactNum,productphone.productPDesc,trader.traderEmailID');
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
        $this->db->select('post.postID, post.postStatus, productproperty.productID, trader.traderID, productproperty.productCategoryID, productproperty.PRpost_main_img as productImage, concat(productproperty.productPropSC," ",productproperty.productPropType) as productName, productproperty.productPRPrice as productPrice,productproperty.productPropCallPrice as CallPrice,cartPRType as cart_type,trader.traderID,trader.usertype, trader.traderFullName,trader.traderLocation, trader.traderImage, post.postSubmissionOn, productproperty.productPRStatus as productStatus');
        $this->db->from('productproperty');
        $this->db->join('trader', 'productproperty.traderID=trader.traderID');
        $this->db->join('post', 'productproperty.productCategoryID=post.productCategoryID AND productproperty.productID=post.productID');
        $this->db->where('productproperty.productCategoryID', 9);
        $this->db->where('post.postStatus', 1);
        $this->db->where('productproperty.productPRStatus !=', 3);
        $this->db->order_by('post.postSubmissionOn', 'desc');
        $this->db->limit($limit, $offset);
        $qry = $this->db->get();
        $myqry = $qry->result();

        $this->db->select('post.postID,post.postStatus,productproperty.productID,trader.traderID,productproperty.productCategoryID,productproperty.PRpost_main_img,productproperty.productCategoryName,productproperty.productPRPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productproperty.productPRSubmitDate');
        $this->db->from('productproperty');
        $this->db->join('trader', 'productproperty.traderID=trader.traderID');
        $this->db->join('post', 'productproperty.productCategoryID=post.productCategoryID AND productproperty.productID=post.productID');
        $this->db->where('productproperty.productCategoryID', 9);
        $this->db->where('productproperty.productPRStatus !=', 3);
        $this->db->where('post.postStatus', 1);


        $cntqry = $this->db->get();
        $count_qry = $cntqry->result();
        return array(
            'qry' => $myqry,
            'count' => count($count_qry),
        );
    }

    public function getproductproperty($product_id, $cat_id) {
        $this->db->select('post.postStatus,post.postID, productproperty.productCategoryID, trader.traderID, productproperty.productID, productproperty.cartPRType as cartType, productproperty.productPRPrice as productPrice,productPropCallPrice as CallPrice,trader.usertype, trader.traderFullName, trader.traderLocation, trader.traderImage,post.postSubmissionOn, trader.traderContactNum, productproperty.productDesc as productDescr, '
                . 'productproperty.productPRStatus as productStatus,concat(productproperty.productPropSC," ",productproperty.productPropType) as productName');
        $this->db->from('productproperty');
        $this->db->join('trader', 'productproperty.traderID=trader.traderID');
        $this->db->join('post', 'productproperty.productCategoryID=post.productCategoryID AND productproperty.productID=post.productID');

        $this->db->where('productproperty.productID', $product_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function record_count_property() {
        $car_cnt_qry = $this->db->query('SELECT count(*) as cnt FROM `productproperty` 
                    join post on (productproperty.productCategoryID=post.productCategoryID AND productproperty.productID=post.productID)
                     where  post.postStatus = 1 and (productproperty.productPRStatus!=3)');

        return $car_cnt_qry->result();
    }

    function sendemail_property($product_id) {
        $this->db->select('productproperty.productID,productproperty.productCategoryName,productproperty.productPRPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productproperty.productPRSubmitDate,trader.traderContactNum,productproperty.productDesc,trader.traderEmailID');
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
    function prod_addto_wishlist_car($prod_id) {
        $watchcnt = 1;
        $i = 1;

        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $prod_avail = 0;
        $data = array('traderID' => $trader_id, 'productID' => $prod_id, 'productCWatchCount' => $watchcnt, 'productLive' => $prod_avail);
        $this->db->insert('productcar', $data);
    }

   

    function get_mobprefix($mob_oper) {

        $query = $this->db->query("select * from category_subtypes where brandName='" . $mob_oper . "'");
        $cities = array();

        if ($query->result()) {
            foreach ($query->result() as $city) {
                $cities[$city->modelName] = $city->modelName;
            }
            return $cities;
        } else {
            return FALSE;
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

    function addtocart($userId, $postId, $productcategoryId=NULL, $productId=NULL) {
        $cartcnt = 1;
        $i = 1;

        $prod_avail = 0;
        if(!$this->db->get_where('cartlist',array('userID' => $userId,'postID' => $postId),1)->result()){
            $data = array('userID' => $userId, 'postID' => $postId, 'productID' => $productId, 'cartlistCount' => $cartcnt, 'productAvailability' => $prod_avail, 'productCategoryID' => $productcategoryId);
        $this->db->insert('cartlist', $data);
            return 1;
        }else{
            return 0;
        }
        //$data = array('cartlistID'=>$i++,'customerID'=>$trader_id,'productID'=>$prod_id,'cartlistCount'=>$cartcnt,'productAvailability'=>$prod_avail);
       
    }

    function get_cart_traderid($userId) {
        $qry = $this->db->query('SELECT DISTINCT cartlist.postID,cartlist.productCategoryID,cartlist.productID,productiv.productViewCount,`productcar`.`productCBrand`, `productcar`.`productCModel`, `productcar`.`productCSubmitDate`, `productcar`.`productCPrice`,`productcar`.`Cpost_main_img`,productcar.cartCType,productcar.productCStatus,
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
        left JOIN `post` as p ON `cartlist`.`postID`=`p`.`postID`
        left JOIN `trader` ON `p`.`traderID`=`trader`.`traderID`
        left JOIN `productcar` ON (`cartlist`.`productCategoryID`=`productcar`.`productCategoryID` AND p.`productID`=`productcar`.`productID`)
        left JOIN `productbike` ON (`cartlist`.`productCategoryID`=`productbike`.`productCategoryID` AND p.`productID`=`productbike`.`productID`)
        left JOIN `productboat` ON (`cartlist`.`productCategoryID`=`productboat`.`productCategoryID` AND p.`productID`=`productboat`.`productID`)
        left JOIN `productmn` ON (`cartlist`.`productCategoryID`=`productmn`.`productCategoryID` AND p.`productID`=`productmn`.`productID`) 
        left JOIN `productnp` ON (`cartlist`.`productCategoryID`=`productnp`.`productCategoryID` AND p.`productID`=`productnp`.`productID`)
        left JOIN `productphone` ON (`cartlist`.`productCategoryID`=`productphone`.`productCategoryID` AND p.`productID`=`productphone`.`productID`)
        left JOIN `productproperty` ON (`cartlist`.`productCategoryID`=`productproperty`.`productCategoryID` AND p.`productID`=`productproperty`.`productID`) 
        left JOIN `productvertu` ON (`cartlist`.`productCategoryID`=`productvertu`.`productCategoryID` AND p.`productID`=`productvertu`.`productID`)
        left JOIN `productwatch` ON (`cartlist`.`productCategoryID`=`productwatch`.`productCategoryID` AND p.`productID`=`productwatch`.`productID`)
        WHERE `cartlist`.`userID` = ' . $userId.' AND `cartlist`.`productAvailability` = 0 group by cartlist.postID');
        foreach ($qry->result() as $row) {

            $data['postId'] = $row->postID;
            $data['CategoryId'] = $row->productCategoryID;
            $data['ProductId'] = $row->productID;


            if ($data['CategoryId'] == 1) {
                $data['thumbnailUrl'] = $row->Cpost_main_img;
                $data['is_alshamilProduct'] = $row->cartCType;
                $data['publishedOn'] = $row->productCSubmitDate;
                $data['price'] = $row->productCPrice;
                $data['titleEn'] = $row->productCBrand . " " . $row->productCModel;
                $data['titleAr'] = "";

                $data['status'] = $row->productCStatus;
            } else if ($data['CategoryId'] == 2) {
                $data['is_alshamilProduct'] = $row->cartBType;
                $data['thumbnailUrl'] = $row->Bpost_main_img;
                $data['publishedOn'] = $row->productBSubmitDate;
                $data['price'] = $row->productBPrice;
                $data['titleEn'] = $row->productBBrand . " " . $row->productBModel;
                $data['titleAr'] = "";

                $data['status'] = $row->productBStatus;
            } else if ($data['CategoryId'] == 3) {
                $data['is_alshamilProduct'] = $row->cartNPType;
                $data['thumbnailUrl'] = $row->NPpost_main_img;
                $data['publishedOn'] = $row->productNPSubmitDate;
                $data['price'] = $row->productNPPrice;
                $data['titleEn'] = $row->productNPCode . " " . $row->productNPNmbr;
                $data['titleAr'] = "";

                $data['status'] = $row->productNPStatus;
            } else if ($data['CategoryId'] == 4) {
                $data['is_alshamilProduct'] = $row->cartVType;
                $data['thumbnailUrl'] = $row->Vpost_main_img;
                $data['publishedOn'] = $row->productVSubmitDate;
                $data['price'] = $row->productVPrice;
                $data['titleEn'] = $row->productVBrand . " " . $row->productVModel;
                $data['titleAr'] = "";

                $data['status'] = $row->productVStatus;
            } else if ($data['CategoryId'] == 5) {
                $data['is_alshamilProduct'] = $row->cartWType;
                $data['thumbnailUrl'] = $row->Wpost_main_img;
                $data['publishedOn'] = $row->productWSubmitDate;
                $data['price'] = $row->productWPrice;
                $data['titleEn'] = $row->productWBrand . " " . $row->productWModel;
                $data['titleAr'] = "";

                $data['status'] = $row->productWStatus;
            } else if ($data['CategoryId'] == 6) {
                $data['is_alshamilProduct'] = $row->cartMNType;
                $data['thumbnailUrl'] = $row->MNpost_main_img;
                $data['publishedOn'] = $row->productMNSubmitDate;
                $data['price'] = $row->productMNPrice;
                $data['titleEn'] = $row->productOperator . " " . $row->productMNNmbr;
                $data['titleAr'] = "";

                $data['status'] = $row->productMNStatus;
            } else if ($data['CategoryId'] == 7) {
                $data['is_alshamilProduct'] = $row->cartBTType;
                $data['thumbnailUrl'] = $row->BTpost_main_img;
                $data['publishedOn'] = $row->productBTSubmitDate;
                $data['price'] = $row->productBTPrice;
                $data['titleEn'] = $row->productBtBrand . " " . $row->productBtModel;
                $data['titleAr'] = " ";

                $data['status'] = $row->productBTStatus;
            } else if ($data['CategoryId'] == 8) {
                $data['is_alshamilProduct'] = $row->cartPHType;
                $data['thumbnailUrl'] = $row->PHpost_main_img;
                $data['publishedOn'] = $row->productPSubmitDate;
                $data['price'] = $row->productPHPrice;
                $data['titleEn'] = $row->productPBrand . " " . $row->productPModel;
                $data['titleAr'] = "";

                $data['status'] = $row->productPHStatus;
            } else if ($data['CategoryId'] == 9) {
                $data['is_alshamilProduct'] = $row->cartPRType;
                $data['thumbnailUrl'] = $row->PRpost_main_img;
                $data['publishedOn'] = $row->productPRSubmitDate;
                $data['price'] = $row->productPRPrice;
                $data['titleEn'] = $row->productPropType . " " . $row->productPropSC;
                $data['titleAr'] = "";

                $data['status'] = $row->productPRStatus;
            } else {
                $data['is_alshamilProduct'] = "";
                $data['thumbnailUrl'] = "";
                $data['publishedOn'] = "";
                $data['price'] = "";
                $data['titleEn'] = "";
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
            $data = '';
        }
       
        return (!empty($row_post))?$row_post:array();
    }

    function get_cart_traderinfo($userId) {
        $qry = $this->db->query('Select
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
        WHERE `cartlist`.`traderID` = ' . $userId);

        return $qry->result();
    }

    function deletecart($userId, $cartlistId) {
        $this->db->where('traderID', $userId);
        $this->db->where('cartlistID', $cartlistId);
        $this->db->delete('cartlist');
    }

    function get_notification($userId) {
        $qry = $this->db->query('SELECT tradernotifications.notificationtype, `tradernotifications`.`postID`,tradernotifications.productCategoryID,tradernotifications.productID,
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
        WHERE `tradernotifications`.`traderID` = ' . $userId);


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
                $data['titleEn'] = $row->productCBrand . " " . $row->productCModel;
                $data['titleAr'] = "";

                $data['status'] = $row->productCStatus;
            } else if ($data['categoryId'] == 2) {
                $data['is_alshamilProduct'] = $row->cartBType;
                $data['image'] = $row->Bpost_main_img;
                $data['publishedOn'] = $row->productBSubmitDate;
                $data['price'] = $row->productBPrice;
                $data['titleEn'] = $row->productBBrand . " " . $row->productBModel;
                $data['titleAr'] = "";

                $data['status'] = $row->productBStatus;
            } else if ($data['categoryId'] == 3) {
                $data['is_alshamilProduct'] = $row->cartNPType;
                $data['image'] = $row->NPpost_main_img;
                $data['publishedOn'] = $row->productNPSubmitDate;
                $data['price'] = $row->productNPPrice;
                $data['titleEn'] = $row->productNPCode . " " . $row->productNPNmbr;
                $data['titleAr'] = "";

                $data['status'] = $row->productNPStatus;
            } else if ($data['categoryId'] == 4) {
                $data['is_alshamilProduct'] = $row->cartVType;
                $data['image'] = $row->Vpost_main_img;
                $data['publishedOn'] = $row->productVSubmitDate;
                $data['price'] = $row->productVPrice;
                $data['titleEn'] = $row->productVBrand . " " . $row->productVModel;
                $data['titleAr'] = "";

                $data['status'] = $row->productVStatus;
            } else if ($data['categoryId'] == 5) {
                $data['is_alshamilProduct'] = $row->cartWType;
                $data['image'] = $row->Wpost_main_img;
                $data['publishedOn'] = $row->productWSubmitDate;
                $data['price'] = $row->productWPrice;
                $data['titleEn'] = $row->productWBrand . " " . $row->productWModel;
                $data['titleAr'] = "";

                $data['status'] = $row->productWStatus;
            } else if ($data['categoryId'] == 6) {
                $data['is_alshamilProduct'] = $row->cartMNType;
                $data['image'] = $row->MNpost_main_img;
                $data['publishedOn'] = $row->productMNSubmitDate;
                $data['price'] = $row->productMNPrice;
                $data['titleEn'] = $row->productOperator . " " . $row->productMNNmbr;
                $data['titleAr'] = "";

                $data['status'] = $row->productMNStatus;
            } else if ($data['categoryId'] == 7) {
                $data['is_alshamilProduct'] = $row->cartBTType;
                $data['image'] = $row->BTpost_main_img;
                $data['publishedOn'] = $row->productBTSubmitDate;
                $data['price'] = $row->productBTPrice;
                $data['titleEn'] = $row->productBtBrand . " " . $row->productBtModel;
                $data['titleAr'] = "";

                $data['status'] = $row->productBTStatus;
            } else if ($data['categoryId'] == 8) {
                $data['is_alshamilProduct'] = $row->cartPHType;
                $data['image'] = $row->PHpost_main_img;
                $data['publishedOn'] = $row->productPSubmitDate;
                $data['price'] = $row->productPHPrice;
                $data['titleEn'] = $row->productPBrand . " " . $row->productPModel;
                $data['titleAr'] = "";

                $data['status'] = $row->productPHStatus;
            } else if ($data['categoryId'] == 9) {
                $data['is_alshamilProduct'] = $row->cartPRType;
                $data['image'] = $row->PRpost_main_img;
                $data['publishedOn'] = $row->productPRSubmitDate;
                $data['price'] = $row->productPRPrice;
                $data['titleEn'] = $row->productPropType . " " . $row->productPropSC;
                $data['titleAr'] = "";

                $data['status'] = $row->productPRStatus;
            } else {
                $data['is_alshamilProduct'] = "";
                $data['image'] = "";
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
            $data = '';
        }
        return $row_post;
    }

    function get_traderinfo($userId) {
        $qry = $this->db->query('SELECT  
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
        WHERE `tradernotifications`.`traderID` = ' . $userId);
        return $qry->result();
    }

    function get_trader_profile($userId) {
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
    /***** todo change this function */

    function get_post_by_stat($per_page_cnt, $limit, $userId,$stat) {
        $qry = $this->db->query('SELECT DISTINCT `post`.`productViewCount`,`post`.`postID`,`post`.`rejectMSG`,`post`.`productCategoryID`,post.productID,
           `productcar`.`productCBrand`,`cartCType`,DATE_FORMAT(productcar.productCSubmitDate,"%d %b %Y") as publishedCOn ,`productcar`.`productCCallPrice`, `productcar`.`productCModel`,productcar.productCReleaseYear, `productcar`.`productCPrice`,productcar.productCStatus,productcar.productCDesc,productcar.Cpost_main_img,
           `productbike`.`productBBrand`,`productbike`.`productBCallPrice`, `productbike`.`productBModel`,`cartBType`, DATE_FORMAT(productbike.productBSubmitDate,"%d %b %Y") as publishedBOn,productbike.productBReleaseYear as Bikeyear, `productbike`.`productBPrice`,productbike.productBStatus,productbike.Bpost_main_img,productbike.productBDesc as bike,
           `productboat`.`productBtBrand`,`cartBTType`,DATE_FORMAT(productboat.productBTSubmitDate,"%d %b %Y") as publishedBtOn,`productboat`.`productBtCallPrice`, `productboat`.`productBtModel`, `productboat`.`productBTSubmitDate`,productboat.productBReleaseYear, `productboat`.`productBTPrice`,productboat.productBTStatus,productboat.productBDesc,productboat.BTpost_main_img, 
           `productwatch`.`productWBrand`,`cartWType`,DATE_FORMAT(productwatch.productWSubmitDate,"%d %b %Y") as publishedWOn,`productwatch`.`productWCallPrice`, `productwatch`.`productWModel`, `productwatch`.`productWSubmitDate`, `productwatch`.`productWPrice`,productwatch.productWStatus,productwatch.productWDesc,productwatch.Wpost_main_img,
           `productvertu`.`productVBrand`,`cartVType`,DATE_FORMAT(productvertu.productVSubmitDate,"%d %b %Y") as publishedVOn,`productvertu`.`productVCallPrice`, `productvertu`.`productVModel`, `productvertu`.`productVSubmitDate`, `productvertu`.`productVPrice`,productvertu.productVStatus,productvertu.productVDesc,productvertu.Vpost_main_img, 
           `productproperty`.`productPropSC`,`cartPRType`,DATE_FORMAT(productproperty.productPRSubmitDate,"%d %b %Y") as publishedPROn ,`productproperty`.`productPropCallPrice`,`productproperty`.`productPropType`,  `productproperty`.`productPRSubmitDate`, `productproperty`.`productPRPrice`,productproperty.productPRStatus,productproperty.productDesc,productproperty.PRpost_main_img, 
           `productphone`.`productPBrand`,`cartPHType`,DATE_FORMAT(productphone.productPSubmitDate,"%d %b %Y") as publishedPOn,`productphone`.`productPhCallPrice`, `productphone`.`productPModel`, `productphone`.`productPSubmitDate`, `productphone`.`productPHPrice`,productphone.productPHStatus,productphone.productPDesc,productphone.PHpost_main_img,
           `productnp`.`productNPCode`,`cartNPType`,DATE_FORMAT(productnp.productNPSubmitDate,"%d %b %Y") as publishedNPOn,`productnp`.`productNPCallPrice`, `productnp`.`productNPDigits`, `productnp`.`productNPSubmitDate`, `productnp`.`productNPPrice`,productnp.productNPStatus,productnp.productNPDesc,productnp.NPpost_main_img,productnp.productNPNmbr,productnp.productNPEmrites,
           `productmn`.`productMNPrefix`,`cartMNType`,DATE_FORMAT(productmn.productMNSubmitDate,"%d %b %Y") as publishedMNOn,`productmn`.`productMNCallPrice`, `productmn`.`productMNNmbr`, `productmn`.`productMNSubmitDate`, `productmn`.`productMNPrice`,productmn.productMNStatus,productmn.productMNDesc,productmn.MNpost_main_img,productmn.productOperator       
         
          
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
        WHERE `post`.`postStatus`='.$stat.' and post.traderID=' . $userId . ' order by post.postSubmissionOn DESC  limit ' . $per_page_cnt . ' offset ' . $limit);


        foreach ($qry->result() as $row) { 
            $data['postId'] = $row->postID;
            $data['categoryId'] = $row->productCategoryID;
            $data['ProductId'] = $row->productID;
            $data['productViewCount'] = $row->productViewCount;

            if ($data['categoryId'] == 1) {
                $data['image'] = $row->Cpost_main_img;
                $data['is_alshamilProduct'] = $row->cartCType;
                $data['publishedOn'] = $row->publishedCOn;
                $data['price'] = $row->productCPrice;
                $data['tittleEn'] = $row->productCBrand . " " . $row->productCModel;
                $data['tittleAr'] = " ";

                $data['status'] = $row->productCStatus;
                $data['rejectMSG'] = $row->rejectMSG;
            } else if ($data['categoryId'] == 2) {
                $data['is_alshamilProduct'] = $row->cartBType;
                $data['image'] = $row->Bpost_main_img;
                $data['publishedOn'] = $row->publishedBOn;
                $data['price'] = $row->productBPrice;
                $data['tittleEn'] = $row->productBBrand . " " . $row->productBModel;
                $data['tittleAr'] = "";

                $data['status'] = $row->productBStatus;
                $data['rejectMSG'] = $row->rejectMSG;
            } else if ($data['categoryId'] == 3) {
                $data['is_alshamilProduct'] = $row->cartNPType;
                $data['image'] = $row->NPpost_main_img;
                $data['publishedOn'] = $row->publishedNPOn;
                $data['price'] = $row->productNPPrice;
                $data['tittleEn'] = $row->productNPEmrites . " " .$row->productNPCode . " " . $row->productNPNmbr;
                $data['tittleAr'] = "";

                $data['status'] = $row->productNPStatus;
                $data['rejectMSG'] = $row->rejectMSG;
            } else if ($data['categoryId'] == 4) {
                
                $data['is_alshamilProduct'] = $row->cartVType;
                $data['image'] = $row->Vpost_main_img;
                $data['publishedOn'] = $row->publishedVOn;
                $data['price'] = $row->productVPrice;
                $data['tittleEn'] = $row->productVBrand . " " . $row->productVModel;
                $data['tittleAr'] = "";

                $data['status'] = $row->productVStatus;
                $data['rejectMSG'] = $row->rejectMSG;
            } else if ($data['categoryId'] == 5) {
                $data['is_alshamilProduct'] = $row->cartWType;
                $data['image'] = $row->Wpost_main_img;
                $data['publishedOn'] = $row->publishedWOn;
                $data['price'] = $row->productWPrice;
                $data['tittleEn'] = $row->productWBrand . " " . $row->productWModel;
                $data['tittleAr'] = "";

                $data['status'] = $row->productWStatus;
                $data['rejectMSG'] = $row->rejectMSG;
            } else if ($data['categoryId'] == 6) {
                $data['is_alshamilProduct'] = $row->cartMNType;
                $data['image'] = $row->MNpost_main_img;
                $data['publishedOn'] = $row->publishedMNOn;
                $data['price'] = $row->productMNPrice;
                $data['tittleEn'] = $row->productOperator . " " .$row->productMNPrefix . " " . $row->productMNNmbr;
                $data['tittleAr'] = "";

                $data['status'] = $row->productMNStatus;
                $data['rejectMSG'] = $row->rejectMSG;
            } else if ($data['categoryId'] == 7) {
                $data['is_alshamilProduct'] = $row->cartBTType;
                $data['image'] = $row->BTpost_main_img;
                $data['publishedOn'] = $row->publishedBtOn;
                $data['price'] = $row->productBTPrice;
                $data['tittleEn'] = $row->productBtBrand . " " . $row->productBtModel;
                $data['tittleAr'] = "";

                $data['status'] = $row->productBTStatus;
                $data['rejectMSG'] = $row->rejectMSG;
            } else if ($data['categoryId'] == 8) {
                $data['is_alshamilProduct'] = $row->cartPHType;
                $data['image'] = $row->PHpost_main_img;
                $data['publishedOn'] = $row->publishedPOn;
                $data['price'] = $row->productPHPrice;
                $data['tittleEn'] = $row->productPBrand . " " . $row->productPModel;
                $data['tittleAr'] = "";

                $data['status'] = $row->productPHStatus;
                $data['rejectMSG'] = $row->rejectMSG;
            } else if ($data['categoryId'] == 9) {
                $data['is_alshamilProduct'] = $row->cartPRType;
                $data['image'] = $row->PRpost_main_img;
                $data['publishedOn'] = $row->publishedPROn;
                $data['price'] = $row->productPRPrice;
                $data['tittleEn'] = $row->productPropType . " " . $row->productPropSC;
                $data['tittleAr'] = "";

                $data['status'] = $row->productPRStatus;
                $data['rejectMSG'] = $row->rejectMSG;
            } else {
                $data['is_alshamilProduct'] = "";
                $data['image'] = "";
                $data['publishedOn'] = "";
                $data['price'] = "";
                $data['tittleEn'] = "";
                $data['tittleAr'] = "";

                $data['status'] = "";
            }




            $row_post[] = $data;
            $data = '';
        }
        return $row_post;
    }

    function get_count_by_stat($userId,$stat) {
        $qry = $this->db->query('select count(*) as count from post where traderID=' . $userId . ' and postStatus='.$stat);
        return $qry->result();
    }

    /***** end todo change this function */




    function get_post_approved($per_page_cnt, $limit, $userId) {
        $qry = $this->db->query('SELECT DISTINCT `post`.`postID`,`post`.`productCategoryID`,post.productID,
           `productcar`.`productCBrand`,`cartCType`,DATE_FORMAT(productcar.productCSubmitDate,"%d %b %Y") as publishedCOn ,`productcar`.`productCCallPrice`, `productcar`.`productCModel`,productcar.productCReleaseYear, `productcar`.`productCPrice`,productcar.productCStatus,productcar.productCDesc,productcar.Cpost_main_img,
           `productbike`.`productBBrand`,`productbike`.`productBCallPrice`, `productbike`.`productBModel`,`cartBType`, DATE_FORMAT(productbike.productBSubmitDate,"%d %b %Y") as publishedBOn,productbike.productBReleaseYear as Bikeyear, `productbike`.`productBPrice`,productbike.productBStatus,productbike.Bpost_main_img,productbike.productBDesc as bike,
           `productboat`.`productBtBrand`,`cartBTType`,DATE_FORMAT(productboat.productBTSubmitDate,"%d %b %Y") as publishedBtOn,`productboat`.`productBtCallPrice`, `productboat`.`productBtModel`, `productboat`.`productBTSubmitDate`,productboat.productBReleaseYear, `productboat`.`productBTPrice`,productboat.productBTStatus,productboat.productBDesc,productboat.BTpost_main_img, 
           `productwatch`.`productWBrand`,`cartWType`,DATE_FORMAT(productwatch.productWSubmitDate,"%d %b %Y") as publishedWOn,`productwatch`.`productWCallPrice`, `productwatch`.`productWModel`, `productwatch`.`productWSubmitDate`, `productwatch`.`productWPrice`,productwatch.productWStatus,productwatch.productWDesc,productwatch.Wpost_main_img,
           `productvertu`.`productVBrand`,`cartVType`,DATE_FORMAT(productvertu.productVSubmitDate,"%d %b %Y") as publishedVOn,`productvertu`.`productVCallPrice`, `productvertu`.`productVModel`, `productvertu`.`productVSubmitDate`, `productvertu`.`productVPrice`,productvertu.productVStatus,productvertu.productVDesc,productvertu.Vpost_main_img, 
           `productproperty`.`productPropSC`,`cartPRType`,DATE_FORMAT(productproperty.productPRSubmitDate,"%d %b %Y") as publishedPROn ,`productproperty`.`productPropCallPrice`,`productproperty`.`productPropType`,  `productproperty`.`productPRSubmitDate`, `productproperty`.`productPRPrice`,productproperty.productPRStatus,productproperty.productDesc,productproperty.PRpost_main_img, 
           `productphone`.`productPBrand`,`cartPHType`,DATE_FORMAT(productphone.productPSubmitDate,"%d %b %Y") as publishedPOn,`productphone`.`productPhCallPrice`, `productphone`.`productPModel`, `productphone`.`productPSubmitDate`, `productphone`.`productPHPrice`,productphone.productPHStatus,productphone.productPDesc,productphone.PHpost_main_img,
           `productnp`.`productNPCode`,`cartNPType`,DATE_FORMAT(productnp.productNPSubmitDate,"%d %b %Y") as publishedNPOn,`productnp`.`productNPCallPrice`, `productnp`.`productNPDigits`, `productnp`.`productNPSubmitDate`, `productnp`.`productNPPrice`,productnp.productNPStatus,productnp.productNPDesc,productnp.NPpost_main_img,productnp.productNPNmbr,productnp.productNPEmrites,
           `productmn`.`productMNPrefix`,`cartMNType`,DATE_FORMAT(productmn.productMNSubmitDate,"%d %b %Y") as publishedMNOn,`productmn`.`productMNCallPrice`, `productmn`.`productMNNmbr`, `productmn`.`productMNSubmitDate`, `productmn`.`productMNPrice`,productmn.productMNStatus,productmn.productMNDesc,productmn.MNpost_main_img,productmn.productOperator       
         
          
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
        WHERE `post`.`postStatus`=1 and post.traderID=' . $userId . ' order by post.postSubmissionOn DESC  limit ' . $per_page_cnt . ' offset ' . $limit);


        foreach ($qry->result() as $row) {
            $data['postId'] = $row->postID;
            $data['categoryId'] = $row->productCategoryID;
            $data['ProductId'] = $row->productID;


            if ($data['categoryId'] == 1) {
                $data['image'] = $row->Cpost_main_img;
                $data['is_alshamilProduct'] = $row->cartCType;
                $data['publishedOn'] = $row->publishedCOn;
                $data['price'] = $row->productCPrice;
                $data['tittleEn'] = $row->productCBrand . " " . $row->productCModel;
                $data['tittleAr'] = " ";

                $data['status'] = $row->productCStatus;
            } else if ($data['categoryId'] == 2) {
                $data['is_alshamilProduct'] = $row->cartBType;
                $data['image'] = $row->Bpost_main_img;
                $data['publishedOn'] = $row->publishedBOn;
                $data['price'] = $row->productBPrice;
                $data['tittleEn'] = $row->productBBrand . " " . $row->productBModel;
                $data['tittleAr'] = "";

                $data['status'] = $row->productBStatus;
            } else if ($data['categoryId'] == 3) {
                $data['is_alshamilProduct'] = $row->cartNPType;
                $data['image'] = $row->NPpost_main_img;
                $data['publishedOn'] = $row->publishedNPOn;
                $data['price'] = $row->productNPPrice;
                $data['tittleEn'] = $row->productNPCode . "" . $row->productNPNmbr;
                $data['tittleAr'] = "";

                $data['status'] = $row->productNPStatus;
            } else if ($data['categoryId'] == 4) {
                
                $data['is_alshamilProduct'] = $row->cartVType;
                $data['image'] = $row->Vpost_main_img;
                $data['publishedOn'] = $row->publishedVOn;
                $data['price'] = $row->productVPrice;
                $data['tittleEn'] = $row->productVBrand . "" . $row->productVModel;
                $data['tittleAr'] = "";

                $data['status'] = $row->productVStatus;
            } else if ($data['categoryId'] == 5) {
                $data['is_alshamilProduct'] = $row->cartWType;
                $data['image'] = $row->Wpost_main_img;
                $data['publishedOn'] = $row->publishedWOn;
                $data['price'] = $row->productWPrice;
                $data['tittleEn'] = $row->productWBrand . "" . $row->productWModel;
                $data['tittleAr'] = "";

                $data['status'] = $row->productWStatus;
            } else if ($data['categoryId'] == 6) {
                $data['is_alshamilProduct'] = $row->cartMNType;
                $data['image'] = $row->MNpost_main_img;
                $data['publishedOn'] = $row->publishedMNOn;
                $data['price'] = $row->productMNPrice;
                $data['tittleEn'] = $row->productOperator . "" . $row->productMNNmbr;
                $data['tittleAr'] = "";

                $data['status'] = $row->productMNStatus;
            } else if ($data['categoryId'] == 7) {
                $data['is_alshamilProduct'] = $row->cartBTType;
                $data['image'] = $row->BTpost_main_img;
                $data['publishedOn'] = $row->publishedBtOn;
                $data['price'] = $row->productBTPrice;
                $data['tittleEn'] = $row->productBtBrand . "" . $row->productBtModel;
                $data['tittleAr'] = "";

                $data['status'] = $row->productBTStatus;
            } else if ($data['categoryId'] == 8) {
                $data['is_alshamilProduct'] = $row->cartPHType;
                $data['image'] = $row->PHpost_main_img;
                $data['publishedOn'] = $row->publishedPOn;
                $data['price'] = $row->productPHPrice;
                $data['tittleEn'] = $row->productPBrand . " " . $row->productPModel;
                $data['tittleAr'] = "";

                $data['status'] = $row->productPHStatus;
            } else if ($data['categoryId'] == 9) {
                $data['is_alshamilProduct'] = $row->cartPRType;
                $data['image'] = $row->PRpost_main_img;
                $data['publishedOn'] = $row->publishedPROn;
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

                $data['status'] = "";
            }




            $row_post[] = $data;
            $data = '';
        }
        return $row_post;
    }

    function get_countapproved($userId) {
        $qry = $this->db->query('select count(*) as approved_count from post where traderID=' . $userId . ' and postStatus=1');
        return $qry->result();
    }

    function get_post_pending($per_page_cnt, $limit, $userId) {
        $qry = $this->db->query('SELECT DISTINCT `post`.`postID`,`post`.`productCategoryID`,post.productID,
           `productcar`.`productCBrand`,`cartCType`,DATE_FORMAT(productcar.productCSubmitDate,"%d %b %Y") as publishedCOn ,`productcar`.`productCCallPrice`, `productcar`.`productCModel`,productcar.productCReleaseYear, `productcar`.`productCPrice`,productcar.productCStatus,productcar.productCDesc,productcar.Cpost_main_img,
           `productbike`.`productBBrand`,`productbike`.`productBCallPrice`, `productbike`.`productBModel`,`cartBType`, DATE_FORMAT(productbike.productBSubmitDate,"%d %b %Y") as publishedBOn,productbike.productBReleaseYear as Bikeyear, `productbike`.`productBPrice`,productbike.productBStatus,productbike.Bpost_main_img,productbike.productBDesc as bike,
           `productboat`.`productBtBrand`,`cartBTType`,DATE_FORMAT(productboat.productBTSubmitDate,"%d %b %Y") as publishedBtOn,`productboat`.`productBtCallPrice`, `productboat`.`productBtModel`, `productboat`.`productBTSubmitDate`,productboat.productBReleaseYear, `productboat`.`productBTPrice`,productboat.productBTStatus,productboat.productBDesc,productboat.BTpost_main_img, 
           `productwatch`.`productWBrand`,`cartWType`,DATE_FORMAT(productwatch.productWSubmitDate,"%d %b %Y") as publishedWOn,`productwatch`.`productWCallPrice`, `productwatch`.`productWModel`, `productwatch`.`productWSubmitDate`, `productwatch`.`productWPrice`,productwatch.productWStatus,productwatch.productWDesc,productwatch.Wpost_main_img,
           `productvertu`.`productVBrand`,`cartVType`,DATE_FORMAT(productvertu.productVSubmitDate,"%d %b %Y") as publishedVOn,`productvertu`.`productVCallPrice`, `productvertu`.`productVModel`, `productvertu`.`productVSubmitDate`, `productvertu`.`productVPrice`,productvertu.productVStatus,productvertu.productVDesc,productvertu.Vpost_main_img, 
           `productproperty`.`productPropSC`,`cartPRType`,DATE_FORMAT(productproperty.productPRSubmitDate,"%d %b %Y") as publishedPROn ,`productproperty`.`productPropCallPrice`,`productproperty`.`productPropType`,  `productproperty`.`productPRSubmitDate`, `productproperty`.`productPRPrice`,productproperty.productPRStatus,productproperty.productDesc,productproperty.PRpost_main_img, 
           `productphone`.`productPBrand`,`cartPHType`,DATE_FORMAT(productphone.productPSubmitDate,"%d %b %Y") as publishedPOn,`productphone`.`productPhCallPrice`, `productphone`.`productPModel`, `productphone`.`productPSubmitDate`, `productphone`.`productPHPrice`,productphone.productPHStatus,productphone.productPDesc,productphone.PHpost_main_img,
           `productnp`.`productNPCode`,`cartNPType`,DATE_FORMAT(productnp.productNPSubmitDate,"%d %b %Y") as publishedNPOn,`productnp`.`productNPCallPrice`, `productnp`.`productNPDigits`, `productnp`.`productNPSubmitDate`, `productnp`.`productNPPrice`,productnp.productNPStatus,productnp.productNPDesc,productnp.NPpost_main_img,productnp.productNPNmbr,productnp.productNPEmrites,
           `productmn`.`productMNPrefix`,`cartMNType`,DATE_FORMAT(productmn.productMNSubmitDate,"%d %b %Y") as publishedMNOn,`productmn`.`productMNCallPrice`, `productmn`.`productMNNmbr`, `productmn`.`productMNSubmitDate`, `productmn`.`productMNPrice`,productmn.productMNStatus,productmn.productMNDesc,productmn.MNpost_main_img,productmn.productOperator       
         
          
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
        WHERE `post`.`postStatus`=0 and post.traderID=' . $userId . ' order by post.postSubmissionOn DESC  limit ' . $per_page_cnt . ' offset ' . $limit);


        foreach ($qry->result() as $row) {
            $data['postId'] = $row->postID;
            $data['categoryId'] = $row->productCategoryID;
            $data['ProductId'] = $row->productID;


            if ($data['categoryId'] == 1) {
                $data['image'] = $row->Cpost_main_img;
                $data['is_alshamilProduct'] = $row->cartCType;
                $data['publishedOn'] = $row->publishedCOn;
                $data['price'] = $row->productCPrice;
                $data['tittleEn'] = $row->productCBrand . " " . $row->productCModel;
                $data['tittleAr'] = " ";

                $data['status'] = $row->productCStatus;
            } else if ($data['categoryId'] == 2) {
                $data['is_alshamilProduct'] = $row->cartBType;
                $data['image'] = $row->Bpost_main_img;
                $data['publishedOn'] = $row->publishedBOn;
                $data['price'] = $row->productBPrice;
                $data['tittleEn'] = $row->productBBrand . " " . $row->productBModel;
                $data['tittleAr'] = "";

                $data['status'] = $row->productBStatus;
            } else if ($data['categoryId'] == 3) {
                $data['is_alshamilProduct'] = $row->cartNPType;
                $data['image'] = $row->NPpost_main_img;
                $data['publishedOn'] = $row->publishedNPOn;
                $data['price'] = $row->productNPPrice;
                $data['tittleEn'] = $row->productNPCode . "" . $row->productNPNmbr;
                $data['tittleAr'] = "";

                $data['status'] = $row->productNPStatus;
            } else if ($data['categoryId'] == 4) {
                
                $data['is_alshamilProduct'] = $row->cartVType;
                $data['image'] = $row->Vpost_main_img;
                $data['publishedOn'] = $row->publishedVOn;
                $data['price'] = $row->productVPrice;
                $data['tittleEn'] = $row->productVBrand . "" . $row->productVModel;
                $data['tittleAr'] = "";

                $data['status'] = $row->productVStatus;
            } else if ($data['categoryId'] == 5) {
                $data['is_alshamilProduct'] = $row->cartWType;
                $data['image'] = $row->Wpost_main_img;
                $data['publishedOn'] = $row->publishedWOn;
                $data['price'] = $row->productWPrice;
                $data['tittleEn'] = $row->productWBrand . "" . $row->productWModel;
                $data['tittleAr'] = "";

                $data['status'] = $row->productWStatus;
            } else if ($data['categoryId'] == 6) {
                $data['is_alshamilProduct'] = $row->cartMNType;
                $data['image'] = $row->MNpost_main_img;
                $data['publishedOn'] = $row->publishedMNOn;
                $data['price'] = $row->productMNPrice;
                $data['tittleEn'] = $row->productOperator . "" . $row->productMNNmbr;
                $data['tittleAr'] = "";

                $data['status'] = $row->productMNStatus;
            } else if ($data['categoryId'] == 7) {
                $data['is_alshamilProduct'] = $row->cartBTType;
                $data['image'] = $row->BTpost_main_img;
                $data['publishedOn'] = $row->publishedBtOn;
                $data['price'] = $row->productBTPrice;
                $data['tittleEn'] = $row->productBtBrand . "" . $row->productBtModel;
                $data['tittleAr'] = "";

                $data['status'] = $row->productBTStatus;
            } else if ($data['categoryId'] == 8) {
                $data['is_alshamilProduct'] = $row->cartPHType;
                $data['image'] = $row->PHpost_main_img;
                $data['publishedOn'] = $row->publishedPOn;
                $data['price'] = $row->productPHPrice;
                $data['tittleEn'] = $row->productPBrand . " " . $row->productPModel;
                $data['tittleAr'] = "";

                $data['status'] = $row->productPHStatus;
            } else if ($data['categoryId'] == 9) {
                $data['is_alshamilProduct'] = $row->cartPRType;
                $data['image'] = $row->PRpost_main_img;
                $data['publishedOn'] = $row->publishedPROn;
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

                $data['status'] = "";
            }




            $row_post[] = $data;
            $data = '';
        }
        return $row_post;
    }

    function get_countpending($userId) {
        $qry = $this->db->query('select count(*) as pending_count from post where traderID=' . $userId . ' and postStatus=-1');
        return $qry->result();
    }

    function get_post_rejected($per_page_cnt, $limit, $userId) {
        $qry = $this->db->query('SELECT DISTINCT `post`.`postID`,`post`.`productCategoryID`,post.productID,
           `productcar`.`productCBrand`,`cartCType`,DATE_FORMAT(productcar.productCSubmitDate,"%d %b %Y") as publishedCOn ,`productcar`.`productCCallPrice`, `productcar`.`productCModel`,productcar.productCReleaseYear, `productcar`.`productCPrice`,productcar.productCStatus,productcar.productCDesc,productcar.Cpost_main_img,
           `productbike`.`productBBrand`,`productbike`.`productBCallPrice`, `productbike`.`productBModel`,`cartBType`, DATE_FORMAT(productbike.productBSubmitDate,"%d %b %Y") as publishedBOn,productbike.productBReleaseYear as Bikeyear, `productbike`.`productBPrice`,productbike.productBStatus,productbike.Bpost_main_img,productbike.productBDesc as bike,
           `productboat`.`productBtBrand`,`cartBTType`,DATE_FORMAT(productboat.productBTSubmitDate,"%d %b %Y") as publishedBtOn,`productboat`.`productBtCallPrice`, `productboat`.`productBtModel`, `productboat`.`productBTSubmitDate`,productboat.productBReleaseYear, `productboat`.`productBTPrice`,productboat.productBTStatus,productboat.productBDesc,productboat.BTpost_main_img, 
           `productwatch`.`productWBrand`,`cartWType`,DATE_FORMAT(productwatch.productWSubmitDate,"%d %b %Y") as publishedWOn,`productwatch`.`productWCallPrice`, `productwatch`.`productWModel`, `productwatch`.`productWSubmitDate`, `productwatch`.`productWPrice`,productwatch.productWStatus,productwatch.productWDesc,productwatch.Wpost_main_img,
           `productvertu`.`productVBrand`,`cartVType`,DATE_FORMAT(productvertu.productVSubmitDate,"%d %b %Y") as publishedVOn,`productvertu`.`productVCallPrice`, `productvertu`.`productVModel`, `productvertu`.`productVSubmitDate`, `productvertu`.`productVPrice`,productvertu.productVStatus,productvertu.productVDesc,productvertu.Vpost_main_img, 
           `productproperty`.`productPropSC`,`cartPRType`,DATE_FORMAT(productproperty.productPRSubmitDate,"%d %b %Y") as publishedPROn ,`productproperty`.`productPropCallPrice`,`productproperty`.`productPropType`,  `productproperty`.`productPRSubmitDate`, `productproperty`.`productPRPrice`,productproperty.productPRStatus,productproperty.productDesc,productproperty.PRpost_main_img, 
           `productphone`.`productPBrand`,`cartPHType`,DATE_FORMAT(productphone.productPSubmitDate,"%d %b %Y") as publishedPOn,`productphone`.`productPhCallPrice`, `productphone`.`productPModel`, `productphone`.`productPSubmitDate`, `productphone`.`productPHPrice`,productphone.productPHStatus,productphone.productPDesc,productphone.PHpost_main_img,
           `productnp`.`productNPCode`,`cartNPType`,DATE_FORMAT(productnp.productNPSubmitDate,"%d %b %Y") as publishedNPOn,`productnp`.`productNPCallPrice`, `productnp`.`productNPDigits`, `productnp`.`productNPSubmitDate`, `productnp`.`productNPPrice`,productnp.productNPStatus,productnp.productNPDesc,productnp.NPpost_main_img,productnp.productNPNmbr,productnp.productNPEmrites,
           `productmn`.`productMNPrefix`,`cartMNType`,DATE_FORMAT(productmn.productMNSubmitDate,"%d %b %Y") as publishedMNOn,`productmn`.`productMNCallPrice`, `productmn`.`productMNNmbr`, `productmn`.`productMNSubmitDate`, `productmn`.`productMNPrice`,productmn.productMNStatus,productmn.productMNDesc,productmn.MNpost_main_img,productmn.productOperator       
         
          
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
        WHERE `post`.`postStatus`=-1 and post.traderID=' . $userId . ' order by post.postSubmissionOn DESC  limit ' . $per_page_cnt . ' offset ' . $limit);


        foreach ($qry->result() as $row) {
            $data['postId'] = $row->postID;
            $data['categoryId'] = $row->productCategoryID;
            $data['ProductId'] = $row->productID;


            if ($data['categoryId'] == 1) {
                $data['image'] = $row->Cpost_main_img;
                $data['is_alshamilProduct'] = $row->cartCType;
                $data['publishedOn'] = $row->publishedCOn;
                $data['price'] = $row->productCPrice;
                $data['tittleEn'] = $row->productCBrand . " " . $row->productCModel;
                $data['tittleAr'] = " ";

                $data['status'] = $row->productCStatus;
            } else if ($data['categoryId'] == 2) {
                $data['is_alshamilProduct'] = $row->cartBType;
                $data['image'] = $row->Bpost_main_img;
                $data['publishedOn'] = $row->publishedBOn;
                $data['price'] = $row->productBPrice;
                $data['tittleEn'] = $row->productBBrand . " " . $row->productBModel;
                $data['tittleAr'] = "";

                $data['status'] = $row->productBStatus;
            } else if ($data['categoryId'] == 3) {
                $data['is_alshamilProduct'] = $row->cartNPType;
                $data['image'] = $row->NPpost_main_img;
                $data['publishedOn'] = $row->publishedNPOn;
                $data['price'] = $row->productNPPrice;
                $data['tittleEn'] = $row->productNPCode . "" . $row->productNPNmbr;
                $data['tittleAr'] = "";

                $data['status'] = $row->productNPStatus;
            } else if ($data['categoryId'] == 4) {
                
                $data['is_alshamilProduct'] = $row->cartVType;
                $data['image'] = $row->Vpost_main_img;
                $data['publishedOn'] = $row->publishedVOn;
                $data['price'] = $row->productVPrice;
                $data['tittleEn'] = $row->productVBrand . "" . $row->productVModel;
                $data['tittleAr'] = "";

                $data['status'] = $row->productVStatus;
            } else if ($data['categoryId'] == 5) {
                $data['is_alshamilProduct'] = $row->cartWType;
                $data['image'] = $row->Wpost_main_img;
                $data['publishedOn'] = $row->publishedWOn;
                $data['price'] = $row->productWPrice;
                $data['tittleEn'] = $row->productWBrand . "" . $row->productWModel;
                $data['tittleAr'] = "";

                $data['status'] = $row->productWStatus;
            } else if ($data['categoryId'] == 6) {
                $data['is_alshamilProduct'] = $row->cartMNType;
                $data['image'] = $row->MNpost_main_img;
                $data['publishedOn'] = $row->publishedMNOn;
                $data['price'] = $row->productMNPrice;
                $data['tittleEn'] = $row->productOperator . "" . $row->productMNNmbr;
                $data['tittleAr'] = "";

                $data['status'] = $row->productMNStatus;
            } else if ($data['categoryId'] == 7) {
                $data['is_alshamilProduct'] = $row->cartBTType;
                $data['image'] = $row->BTpost_main_img;
                $data['publishedOn'] = $row->publishedBtOn;
                $data['price'] = $row->productBTPrice;
                $data['tittleEn'] = $row->productBtBrand . "" . $row->productBtModel;
                $data['tittleAr'] = "";

                $data['status'] = $row->productBTStatus;
            } else if ($data['categoryId'] == 8) {
                $data['is_alshamilProduct'] = $row->cartPHType;
                $data['image'] = $row->PHpost_main_img;
                $data['publishedOn'] = $row->publishedPOn;
                $data['price'] = $row->productPHPrice;
                $data['tittleEn'] = $row->productPBrand . " " . $row->productPModel;
                $data['tittleAr'] = "";

                $data['status'] = $row->productPHStatus;
            } else if ($data['categoryId'] == 9) {
                $data['is_alshamilProduct'] = $row->cartPRType;
                $data['image'] = $row->PRpost_main_img;
                $data['publishedOn'] = $row->publishedPROn;
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

                $data['status'] = "";
            }




            $row_post[] = $data;
            $data = '';
        }
        return $row_post;
    }

    function get_countrejected($userId) {
        $qry = $this->db->query('select count(*) as rejected_count from post where traderID=' . $userId . ' and postStatus=-1');
        return $qry->result();
    }
    function get_post_sold($per_page_cnt, $limit, $userId){
        $qry = $this->db->query("SELECT postID as postId,CategoryID as categoryId,ProductID as productId,
        `Image` as `image`,IsAlshamilProduct as is_alshamilProduct,AvailablitiyStatus as status,
        DATE_FORMAT(vwProductPost.SubmitDate,'%d %b %Y') as publishedOn,Price as price,CONCAT( Brand, Model) as titleEn,
    TraderID as traderId from vwProductPost WHERE AvailablitiyStatus=1 AND TraderID= {$userId} LIMIT {$limit},{$per_page_cnt} ");
    return $qry->result();
    }

    function get_post_soldout($per_page_cnt, $limit, $userId) {
        $qry = $this->db->query('SELECT `order_items`.`postID`,`order_items`.`productCategoryID`,order_items.productID,order_items.orderDate,
           `productcar`.`productCBrand`, `productcar`.`productCModel`,`productcar`.`productCPrice`,productcar.Cpost_main_img,productcar.productCSubmitDate,productcar.cartCType,productcar.productCStatus,
           `productbike`.`productBBrand`, `productbike`.`productBModel`, `productbike`.`productBPrice`,productbike.Bpost_main_img,productbike.productBSubmitDate,productbike.cartBType,productbike.productBStatus,
           `productboat`.`productBtBrand`, `productboat`.`productBtModel`,`productboat`.`productBTPrice`,productboat.BTpost_main_img,productboat.productBTSubmitDate,productboat.cartBTType,productboat.productBTStatus, 
           `productwatch`.`productWBrand`, `productwatch`.`productWModel`, `productwatch`.`productWPrice`,productwatch.Wpost_main_img,productwatch.productWSubmitDate,productwatch.cartWType,productwatch.productWStatus,
           `productvertu`.`productVBrand`, `productvertu`.`productVModel`,  `productvertu`.`productVPrice`,productvertu.Vpost_main_img,productvertu.productVSubmitDate,productvertu.cartVType,productvertu.productVStatus,
           `productproperty`.`productPropSC`,   `productproperty`.`productPRPrice`,productproperty.PRpost_main_img,productproperty.productPRSubmitDate,productproperty.cartPRType,productproperty.productPRStatus,productproperty.productPropType, 
           `productphone`.`productPBrand`, `productphone`.`productPModel`, `productphone`.`productPHPrice`,productphone.PHpost_main_img,productphone.productPSubmitDate,productphone.productPHStatus,productphone.cartPHType,
           `productnp`.`productNPCode`,`productnp`.`productNPEmrites`, `productnp`.`productNPDigits`,  `productnp`.`productNPPrice`,productnp.NPpost_main_img,productnp.productNPSubmitDate,productnp.cartNPType,productnp.productNPStatus,productnp.productNPNmbr,
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
      WHERE order_items.productStatus=3 and order_items.traderID=' . $userId . ' limit ' . $per_page_cnt . ' offset ' . $limit);
        foreach ($qry->result() as $row) {
            $data['postId'] = $row->postID;
            $data['categoryId'] = $row->productCategoryID;
            $data['productId'] = $row->productID;


            if ($data['categoryId'] == 1) {
                $data['image'] = $row->Cpost_main_img;

                $data['publishedOn'] = $row->productCSubmitDate;
                $data['price'] = $row->productCPrice;
                $data['titleEn'] = $row->productCBrand . " " . $row->productCModel;
                $data['titleAr'] = "";

                $data['status'] = $row->productCStatus;
            } else if ($data['categoryId'] == 2) {

                $data['image'] = $row->Bpost_main_img;
                $data['publishedOn'] = $row->productBSubmitDate;
                $data['price'] = $row->productBPrice;
                $data['titleEn'] = $row->productBBrand . " " . $row->productBModel;
                $data['titleAr'] = "";

                $data['status'] = $row->productBStatus;
            } else if ($data['categoryId'] == 3) {

                $data['image'] = $row->NPpost_main_img;
                $data['publishedOn'] = $row->productNPSubmitDate;
                $data['price'] = $row->productNPPrice;
                $data['titleEn'] = $row->productNPEmrites . " " .$row->productNPCode . " " . $row->productNPNmbr;
                $data['titleAr'] = "";

                $data['status'] = $row->productNPStatus;
            } else if ($data['categoryId'] == 4) {

                $data['image'] = $row->Vpost_main_img;
                $data['publishedOn'] = $row->productVSubmitDate;
                $data['price'] = $row->productVPrice;
                $data['titleEn'] = $row->productVBrand . " " . $row->productVModel;
                $data['titleAr'] = "";

                $data['status'] = $row->productVStatus;
            } else if ($data['categoryId'] == 5) {

                $data['image'] = $row->Wpost_main_img;
                $data['publishedOn'] = $row->productWSubmitDate;
                $data['price'] = $row->productWPrice;
                $data['titleEn'] = $row->productWBrand . " " . $row->productWModel;
                $data['titleAr'] = " ";

                $data['status'] = $row->productWStatus;
            } else if ($data['categoryId'] == 6) {

                $data['image'] = $row->MNpost_main_img;
                $data['publishedOn'] = $row->productMNSubmitDate;
                $data['price'] = $row->productMNPrice;
                $data['titleEn'] = $row->productOperator . " " . $row->productMNPrefix . " " .  $row->productMNNmbr;
                $data['titleAr'] = "";

                $data['status'] = $row->productMNStatus;
            } else if ($data['categoryId'] == 6) {

                $data['image'] = $row->BTpost_main_img;
                $data['publishedOn'] = $row->productBTSubmitDate;
                $data['price'] = $row->productBTPrice;
                $data['titleEn'] = $row->productBtBrand . " " . $row->productBtModel;
                $data['titleAr'] = "";

                $data['status'] = $row->productBTStatus;
            } else if ($data['categoryId'] == 8) {

                $data['image'] = $row->PHpost_main_img;
                $data['publishedOn'] = $row->productPSubmitDate;
                $data['price'] = $row->productPHPrice;
                $data['titleEn'] = $row->productPBrand . " " . $row->productPModel;
                $data['titleAr'] = "";

                $data['status'] = $row->productPHStatus;
            } else if ($data['categoryId'] == 9) {

                $data['image'] = $row->PRpost_main_img;
                $data['publishedOn'] = $row->productPRSubmitDate;
                $data['price'] = $row->productPRPrice;
                $data['titleEn'] = $row->productPropType . " " . $row->productPropSC;
                $data['titleAr'] = "";

                $data['status'] = $row->productPRStatus;
            } else {

                $data['image'] = "";
                $data['publishedOn'] = "";
                $data['price'] = "";
                $data['titleEn'] = "";
                $data['titleAr'] = "";
                $data['status'] = "";
            }
            $data['SoldOn'] = $row->orderDate;
            $data['traderId'] = $row->orderUserID;
            $data['traderNameEn'] = $row->orderUserName;
            $data['traderNameAr'] = "";
            $data['traderLocationEn'] = $row->orderUserLocation;
            $data['traderLocationAr'] = "";
            $data['traderImage'] = $row->orderUserImage;
            $row_post[] = $data;
            $data = '';
        }
        return $row_post;
    }

    function mnrecent() {
        $mobile = $this->db->query('select category.productCategoryID as categoryId,category.category_name as titleEn, productmn.MNpost_main_img as image,post.postStatus from post left join category  on post.productCategoryID=category.productCategoryID left join productmn on post.productID=productmn.productID where category.productCategoryID=6 AND post.postStatus>0 order by  productmn.productMNSubmitDate DESC limit 1');
      $postCount=$this->db->query('select count(*) as count FROM post where post.postStatus>0 AND productCategoryID=6')->result()[0]->count;
      $result=$mobile->result();
      if(isset($result[0]))
      $result[0]->postCount=$postCount;
    
        return $result;
    }

    function carrecent() {
        $car = $this->db->query('select category.productCategoryID as categoryId,category.category_name as titleEn,productcar.Cpost_main_img as image,post.postStatus from post left join category  on post.productCategoryID=category.productCategoryID left join productcar on post.productID=productcar.productID  where category.productCategoryID=1   AND post.postStatus>0 order by  productcar.productCSubmitDate DESC limit 1');
        $postCount=$this->db->query('select count(*) as count FROM post where post.postStatus>0 AND productCategoryID=1')->result()[0]->count;
        $result=$car->result();
        if(isset($result[0]))
        $result[0]->postCount=$postCount;
      
          return $result;
   
    }

    function bikerecent() {
        $bike = $this->db->query('select category.productCategoryID as categoryId,category.category_name as titleEn,  productbike.Bpost_main_img as image,post.postStatus from post left join category  on post.productCategoryID=category.productCategoryID left join productbike on post.productID=productbike.productID  where category.productCategoryID=2    AND post.postStatus>0 order by  productbike.productBSubmitDate DESC limit 1 ');
        $postCount=$this->db->query('select count(*) as count FROM post where post.postStatus>0 AND productCategoryID=2')->result()[0]->count;
        $result=$bike->result();
        if(isset($result[0]))
        $result[0]->postCount=$postCount;
      
          return $result;
    }

    function nprecent() {
        $numberplate = $this->db->query('select category.productCategoryID as categoryId,category.category_name as titleEn,productnp.NPpost_main_img as image,post.postStatus from post left join category  on post.productCategoryID=category.productCategoryID left join productnp on post.productID=productnp.productID  where category.productCategoryID=3   AND post.postStatus>0 order by  productnp.productNPSubmitDate DESC limit 1');
        $postCount=$this->db->query('select count(*) as count FROM post where post.postStatus>0 AND productCategoryID=3')->result()[0]->count;
        $result=$numberplate->result();
        if(isset($result[0]))
        $result[0]->postCount=$postCount;
      
          return $result;
    }

    function verturecent() {
        $vertu = $this->db->query('select category.productCategoryID as categoryId,category.category_name as titleEn,productvertu.Vpost_main_img as image,post.postStatus from post left join category  on post.productCategoryID=category.productCategoryID left join productvertu on post.productID=productvertu.productID where category.productCategoryID=4   AND post.postStatus>0 order by  productvertu.productVSubmitDate DESC limit 1');
        $postCount=$this->db->query('select count(*) as count FROM post where post.postStatus>0 AND productCategoryID=4')->result()[0]->count;
        $result=$vertu->result();
        if(isset($result[0]))
        $result[0]->postCount=$postCount;
        return $result;
    }

    function watchrecent() {
        $watch = $this->db->query('select category.productCategoryID as categoryId,category.category_name as titleEn,productwatch.Wpost_main_img as image,post.postStatus from post left join category  on post.productCategoryID=category.productCategoryID left join productwatch on post.productID=productwatch.productID  where category.productCategoryID=5   AND post.postStatus>0 order by  productwatch.productWSubmitDate DESC limit 1');
        $postCount=$this->db->query('select count(*) as count FROM post where post.postStatus>0 AND productCategoryID=5')->result()[0]->count;
        $result=$watch->result();
        if(isset($result[0]))
        $result[0]->postCount=$postCount;
        return $result;
    }

    function boatrecent() {
        $boat = $this->db->query('select category.productCategoryID as categoryId,category.category_name as titleEn,productboat.BTpost_main_img as image,post.postStatus from post left join category  on post.productCategoryID=category.productCategoryID left join productboat on post.productID=productboat.productID  where category.productCategoryID=7  AND post.postStatus>0 order by  productboat.productBTSubmitDate DESC limit 1');
        $postCount=$this->db->query('select count(*) as count FROM post where post.postStatus>0 AND productCategoryID=7')->result()[0]->count;
        $result=$boat->result();
        if(isset($result[0]))
        $result[0]->postCount=$postCount;
        return $result;
    }

    function phonerecent() {
        $phone = $this->db->query('select post.postID as postCount,category.productCategoryID as categoryId,category.category_name as titleEn, productphone.PHpost_main_img as image,post.postStatus from post left join category  on post.productCategoryID=category.productCategoryID left join productphone on post.productID=productphone.productID where category.productCategoryID=8  AND post.postStatus>0 order by  productphone.productPSubmitDate DESC limit 1');
        $postCount=$this->db->query('select count(*) as count FROM post where post.postStatus>0 AND productCategoryID=8')->result()[0]->count;
        $result=$phone->result();
        if(isset($result[0]))
        $result[0]->postCount=$postCount;
        return $result;
        
    }

    function propertyrecent() {
        $property = $this->db->query('select post.postID as postCount,category.productCategoryID as categoryId,category.category_name as titleEn,post.postID, productproperty.PRpost_main_img as image,post.postStatus from post left join category  on post.productCategoryID=category.productCategoryID left join productproperty on post.productID=productproperty.productID where category.productCategoryID=9  AND post.postStatus>0 order by  productproperty.productPRSubmitDate DESC limit 1');
        $postCount=$this->db->query('select count(*) as count FROM post where post.postStatus>0 AND productCategoryID=9')->result()[0]->count;
        $result=$property->result();
        if(isset($result[0]))
        $result[0]->postCount=$postCount;
        return $result;
    }

    function get_countsold($userId) {
        $qry = $this->db->query('select count(*) as sold_count from vwProductPost where TraderID=' . $userId . ' and AvailablitiyStatus=1 ');
        return $qry->result();
    }

    function get_buyer($userId) {
        $qry = $this->db->query('SELECT `order_items`.`orderUserID`,`order_items`.`orderUserType`,order_items.orderUserName,order_items.orderUserLocation,order_items.orderUserLocation,order_items.orderUserImage
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
        WHERE order_items.productStatus=3 and order_items.traderID=' . $userId . ' ');
        return $qry->result();
    }
    function get_countbooked($userId) {
        $qry = $this->db->query('select count(*) as count from vwProductPost where traderID=' . $userId . ' AND AvailablitiyStatus=2 ');
        return $qry->result();
    }

    // function get_post_booked($per_page_cnt, $limit, $userId) {
    //     $qry = $this->db->query('SELECT  `bookeditems`.`postID`,`bookeditems`.`productCategoryID`,bookeditems.productID,
    //        `productcar`.`productCBrand`, `productcar`.`productCModel`,`productcar`.`productCPrice`,productcar.Cpost_main_img,productcar.productCSubmitDate,productcar.cartCType,productcar.productCStatus,
    //        `productbike`.`productBBrand`,`productbike`.`productBModel`, `productbike`.`productBPrice`,productbike.Bpost_main_img,productbike.productBSubmitDate,productbike.cartBType,productbike.productBStatus,
    //        `productboat`.`productBtBrand`, `productboat`.`productBtModel`,`productboat`.`productBTPrice`,productboat.BTpost_main_img,productboat.productBTSubmitDate,productboat.cartBTType,productboat.productBTStatus, 
    //        `productwatch`.`productWBrand`, `productwatch`.`productWModel`, `productwatch`.`productWPrice`,productwatch.Wpost_main_img,productwatch.productWSubmitDate,productwatch.cartWType,productwatch.productWStatus,
    //        `productvertu`.`productVBrand`, `productvertu`.`productVModel`,  `productvertu`.`productVPrice`,productvertu.Vpost_main_img,productvertu.productVSubmitDate, productvertu.cartVType,productvertu.productVStatus,
    //        `productproperty`.`productPropSC`,   `productproperty`.`productPRPrice`,productproperty.PRpost_main_img,productproperty.productPRSubmitDate,productproperty.cartPRType,productproperty.productPRStatus,productproperty.productPropType, 
    //        `productphone`.`productPBrand`, `productphone`.`productPModel`, `productphone`.`productPHPrice`,productphone.PHpost_main_img,productphone.productPSubmitDate,productphone.productPHStatus,productphone.cartPHType,
    //        `productnp`.`productNPCode`, `productnp`.`productNPDigits`,  `productnp`.`productNPPrice`,productnp.NPpost_main_img,productnp.productNPSubmitDate,productnp.cartNPType,productnp.productNPStatus,productnp.productNPNmbr,
    //        `productmn`.`productMNPrefix`, `productmn`.`productMNNmbr`,  `productmn`.`productMNPrice`,productmn.MNpost_main_img,productmn.productMNSubmitDate,productmn.cartMNType,productmn.productMNStatus,productmn.productOperator,
    //        `bookeditems`.`bookedUserID`,`bookeditems`.`bookedUserType`,bookeditems.bookedUserName,bookeditems.bookedUserLocation,bookeditems.bookedUserLocation,bookeditems.bookedUserImage
    //     from bookeditems
    //     left JOIN `trader` ON `bookeditems`.`traderID`=`trader`.`traderID`
    //     left JOIN `productiv` ON `bookeditems`.`postID`=`productiv`.`postID`
    //     left JOIN `productcar` ON (`bookeditems`.`productCategoryID`=`productcar`.`productCategoryID` and bookeditems.productID=productcar.productID)
    //     left JOIN `productbike` ON( `bookeditems`.`productCategoryID`=`productbike`.`productCategoryID` and bookeditems.productID=productbike.productID)
    //     left JOIN `productboat` ON (`bookeditems`.`productCategoryID`=`productboat`.`productCategoryID` and  bookeditems.productID=productboat.productID)
    //     left JOIN `productmn` ON (`bookeditems`.`productCategoryID`=`productmn`.`productCategoryID` and bookeditems.productID=productmn.productID)
    //     left JOIN `productnp` ON( `bookeditems`.`productCategoryID`=`productnp`.`productCategoryID` and bookeditems.productID=productnp.productID)
    //     left JOIN `productphone` ON (`bookeditems`.`productCategoryID`=`productphone`.`productCategoryID`and bookeditems.productID=productphone.productID)
    //     left JOIN `productproperty` ON( `bookeditems`.`productCategoryID`=`productproperty`.`productCategoryID`and bookeditems.productID=productproperty.productID)
    //     left JOIN `productvertu` ON (`bookeditems`.`productCategoryID`=`productvertu`.`productCategoryID`and bookeditems.productID=productvertu.productID)
    //     left JOIN `productwatch` ON( `bookeditems`.`productCategoryID`=`productwatch`.`productCategoryID` and bookeditems.productID=productwatch.productID)
    //   WHERE `bookeditems`.`traderID` = ' . $userId . ' limit ' . $per_page_cnt . ' offset ' . $limit);
    //     foreach ($qry->result() as $row) {
    //         $data['postId'] = $row->postID;
    //         $data['categoryId'] = $row->productCategoryID;
    //         $data['productId'] = $row->productID;


    //         if ($data['categoryId'] == 1) {
    //             $data['image'] = $row->Cpost_main_img;
    //             $data['is_alshamilProduct'] = $row->cartCType;
    //             $data['publishedOn'] = $row->productCSubmitDate;
    //             $data['price'] = $row->productCPrice;
    //             $data['titleEn'] = $row->productCBrand . " " . $row->productCModel;
    //             $data['titleAr'] = "";

    //             $data['status'] = $row->productCStatus;
    //         } else if ($data['categoryId'] == 2) {
    //             $data['is_alshamilProduct'] = $row->cartBType;
    //             $data['image'] = $row->Bpost_main_img;
    //             $data['publishedOn'] = $row->productBSubmitDate;
    //             $data['price'] = $row->productBPrice;
    //             $data['titleEn'] = $row->productBBrand . " " . $row->productBModel;
    //             $data['titleAr'] = "";

    //             $data['status'] = $row->productBStatus;
    //         } else if ($data['categoryId'] == 3) {
    //             $data['is_alshamilProduct'] = $row->cartNPType;
    //             $data['image'] = $row->NPpost_main_img;
    //             $data['publishedOn'] = $row->productNPSubmitDate;
    //             $data['price'] = $row->productNPPrice;
    //             $data['titleEn'] = $row->productNPCode . "" . $row->productNPNmbr;
    //             $data['titleAr'] = "";

    //             $data['status'] = $row->productNPStatus;
    //         } else if ($data['categoryId'] == 4) {
    //             $data['is_alshamilProduct'] = $row->cartVType;
    //             $data['image'] = $row->Vpost_main_img;
    //             $data['publishedOn'] = $row->productVSubmitDate;
    //             $data['price'] = $row->productVPrice;
    //             $data['titleEn'] = $row->productVBrand . "" . $row->productVModel;
    //             $data['titleAr'] = "";

    //             $data['status'] = $row->productVStatus;
    //         } else if ($data['categoryId'] == 5) {
    //             $data['is_alshamilProduct'] = $row->cartWType;
    //             $data['image'] = $row->Wpost_main_img;
    //             $data['publishedOn'] = $row->productWSubmitDate;
    //             $data['price'] = $row->productWPrice;
    //             $data['titleEn'] = $row->productWBrand . " " . $row->productWModel;
    //             $data['titleAr'] = " ";

    //             $data['status'] = $row->productWStatus;
    //         } else if ($data['categoryId'] == 6) {
    //             $data['is_alshamilProduct'] = $row->cartMNType;
    //             $data['image'] = $row->MNpost_main_img;
    //             $data['publishedOn'] = $row->productMNSubmitDate;
    //             $data['price'] = $row->productMNPrice;
    //             $data['titleEn'] = $row->productOperator . " " . $row->productMNNmbr;
    //             $data['titleAr'] = "";

    //             $data['status'] = $row->productMNStatus;
    //         } else if ($data['categoryId'] == 7) {
    //             $data['is_alshamilProduct'] = $row->cartBTType;
    //             $data['image'] = $row->BTpost_main_img;
    //             $data['publishedOn'] = $row->productBTSubmitDate;
    //             $data['price'] = $row->productBTPrice;
    //             $data['titleEn'] = $row->productBtBrand . " " . $row->productBtModel;
    //             $data['titleAr'] = "";

    //             $data['status'] = $row->productBTStatus;
    //         } else if ($data['categoryId'] == 8) {
    //             $data['is_alshamilProduct'] = $row->cartPHType;
    //             $data['image'] = $row->PHpost_main_img;
    //             $data['publishedOn'] = $row->productPSubmitDate;
    //             $data['price'] = $row->productPHPrice;
    //             $data['titleEn'] = $row->productPBrand . " " . $row->productPModel;
    //             $data['titleAr'] = "";

    //             $data['status'] = $row->productPHStatus;
    //         } else if ($data['categoryId'] == 9) {
    //             $data['is_alshamilProduct'] = $row->cartPRType;
    //             $data['image'] = $row->PRpost_main_img;
    //             $data['publishedOn'] = $row->productPRSubmitDate;
    //             $data['price'] = $row->productPRPrice;
    //             $data['titleEn'] = $row->productPropType . "" . $row->productPropSC;
    //             $data['titleAr'] = "";

    //             $data['status'] = $row->productPRStatus;
    //         } else {
    //             $data['is_alshamilProduct'] = "";
    //             $data['image'] = "";
    //             $data['publishedOn'] = "";
    //             $data['price'] = "";
    //             $data['titleEn'] = "";
    //             $data['titleAr'] = "";
    //             $data['status'] = "";
    //         }

    //         $data['traderId'] = $row->bookedUserID;
    //         $data['traderNameEn'] = $row->bookedUserName;
    //         $data['traderNameAr'] = "";
    //         $data['traderLocationEn'] = $row->bookedUserLocation;
    //         $data['traderLocationAr'] = "";
    //         $data['traderImage'] = $row->bookedUserImage;
    //         $row_post[] = $data;
    //         $data = '';
    //     }
    //     return $row_post;
    // }
    function get_post_booked($per_page_cnt, $limit, $userId) {


        $qry = $this->db->query('SELECT vwProductPost.TraderID as traderId,vwProductPost.AvailablitiyStatus as status,vwProductPost.postID as postId,
        vwProductPost.CategoryID as categoryId,vwProductPost.ProductID as productId,vwProductPost.IsAlshamilProduct as is_alshamilProduct,
        vwProductPost.Image as image,DATE_FORMAT(vwProductPost.SubmitDate ,"%d %b %Y") as publishedOn,
        vwProductPost.Price as price,concat(Brand," ",Model) as titleEn,concat(Brand," ",Model) as titleAr,traderFullName as traderNameEn,traderFullName as traderNameAr,traderLocation as traderLocationEn,
        traderLocation as traderLocationAr,traderImage
        from vwProductPost
        left JOIN `trader` ON `vwProductPost`.`TraderID`=`trader`.`traderID`
         WHERE vwProductPost.TraderID = ' . $userId . ' AND `AvailablitiyStatus` = 2  limit ' . $per_page_cnt . ' offset ' . $limit);
return !empty($qry->result())?$qry->result():array();

      /*  $qry = $this->db->query('SELECT  
           `productcar`.`productCBrand`, `productcar`.`productCModel`,`productcar`.`productCPrice`,productcar.Cpost_main_img,productcar.productCSubmitDate,productcar.cartCType,productcar.productCStatus,
           `productbike`.`productBBrand`,`productbike`.`productBModel`, `productbike`.`productBPrice`,productbike.Bpost_main_img,productbike.productBSubmitDate,productbike.cartBType,productbike.productBStatus,
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
      WHERE `post`.`traderID` = ' . $userId . ' AND `productcar`.`productCStatus` = 2 AND `productbike`.`productBStatus` = 2 AND `productboat`.`productBTStatus` = 2 AND 
      `productmn`.`productMNStatus` = 2 AND `productnp`.`productNPStatus` = 2 AND `productphone`.`productPHStatus` = 2 AND `productproperty`.`productPRStatus` = 2 
      AND `productvertu`.`productVStatus` = 2 AND `productwatch`.`productWStatus` = 2  limit ' . $per_page_cnt . ' offset ' . $limit);
        foreach ($qry->result() as $row) {
            $data['postId'] = $row->postID;
            $data['categoryId'] = $row->productCategoryID;
            $data['productId'] = $row->productID;


            if ($data['categoryId'] == 1) {
                $data['image'] = $row->Cpost_main_img;
                $data['is_alshamilProduct'] = $row->cartCType;
                $data['publishedOn'] = $row->productCSubmitDate;
                $data['price'] = $row->productCPrice;
                $data['titleEn'] = $row->productCBrand . " " . $row->productCModel;
                $data['titleAr'] = "";

                $data['status'] = $row->productCStatus;
            } else if ($data['categoryId'] == 2) {
                $data['is_alshamilProduct'] = $row->cartBType;
                $data['image'] = $row->Bpost_main_img;
                $data['publishedOn'] = $row->productBSubmitDate;
                $data['price'] = $row->productBPrice;
                $data['titleEn'] = $row->productBBrand . " " . $row->productBModel;
                $data['titleAr'] = "";

                $data['status'] = $row->productBStatus;
            } else if ($data['categoryId'] == 3) {
                $data['is_alshamilProduct'] = $row->cartNPType;
                $data['image'] = $row->NPpost_main_img;
                $data['publishedOn'] = $row->productNPSubmitDate;
                $data['price'] = $row->productNPPrice;
                $data['titleEn'] = $row->productNPCode . "" . $row->productNPNmbr;
                $data['titleAr'] = "";

                $data['status'] = $row->productNPStatus;
            } else if ($data['categoryId'] == 4) {
                $data['is_alshamilProduct'] = $row->cartVType;
                $data['image'] = $row->Vpost_main_img;
                $data['publishedOn'] = $row->productVSubmitDate;
                $data['price'] = $row->productVPrice;
                $data['titleEn'] = $row->productVBrand . "" . $row->productVModel;
                $data['titleAr'] = "";

                $data['status'] = $row->productVStatus;
            } else if ($data['categoryId'] == 5) {
                $data['is_alshamilProduct'] = $row->cartWType;
                $data['image'] = $row->Wpost_main_img;
                $data['publishedOn'] = $row->productWSubmitDate;
                $data['price'] = $row->productWPrice;
                $data['titleEn'] = $row->productWBrand . " " . $row->productWModel;
                $data['titleAr'] = " ";

                $data['status'] = $row->productWStatus;
            } else if ($data['categoryId'] == 6) {
                $data['is_alshamilProduct'] = $row->cartMNType;
                $data['image'] = $row->MNpost_main_img;
                $data['publishedOn'] = $row->productMNSubmitDate;
                $data['price'] = $row->productMNPrice;
                $data['titleEn'] = $row->productOperator . " " . $row->productMNNmbr;
                $data['titleAr'] = "";

                $data['status'] = $row->productMNStatus;
            } else if ($data['categoryId'] == 7) {
                $data['is_alshamilProduct'] = $row->cartBTType;
                $data['image'] = $row->BTpost_main_img;
                $data['publishedOn'] = $row->productBTSubmitDate;
                $data['price'] = $row->productBTPrice;
                $data['titleEn'] = $row->productBtBrand . " " . $row->productBtModel;
                $data['titleAr'] = "";

                $data['status'] = $row->productBTStatus;
            } else if ($data['categoryId'] == 8) {
                $data['is_alshamilProduct'] = $row->cartPHType;
                $data['image'] = $row->PHpost_main_img;
                $data['publishedOn'] = $row->productPSubmitDate;
                $data['price'] = $row->productPHPrice;
                $data['titleEn'] = $row->productPBrand . " " . $row->productPModel;
                $data['titleAr'] = "";

                $data['status'] = $row->productPHStatus;
            } else if ($data['categoryId'] == 9) {
                $data['is_alshamilProduct'] = $row->cartPRType;
                $data['image'] = $row->PRpost_main_img;
                $data['publishedOn'] = $row->productPRSubmitDate;
                $data['price'] = $row->productPRPrice;
                $data['titleEn'] = $row->productPropType . "" . $row->productPropSC;
                $data['titleAr'] = "";

                $data['status'] = $row->productPRStatus;
            } else {
                $data['is_alshamilProduct'] = "";
                $data['image'] = "";
                $data['publishedOn'] = "";
                $data['price'] = "";
                $data['titleEn'] = "";
                $data['titleAr'] = "";
                $data['status'] = "";
            }

            $data['traderId'] = $row->bookedUserID;
            $data['traderNameEn'] = $row->bookedUserName;
            $data['traderNameAr'] = "";
            $data['traderLocationEn'] = $row->bookedUserLocation;
            $data['traderLocationAr'] = "";
            $data['traderImage'] = $row->bookedUserImage;
            $row_post[] = $data;
            $data = '';
        }
        return $row_post;
        */
    }

    function get_bookeduser($userId) {
        $qry = $this->db->query('SELECT `bookeditems`.`bookedUserID`,`bookeditems`.`bookedUserType`,bookeditems.bookedUserName,bookeditems.bookedUserLocation,bookeditems.bookedUserLocation,bookeditems.bookedUserImage
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
        WHERE  bookeditems.traderID=' . $userId . ' ');
        return $qry->result();
    }



    function addtoflag($userId, $postId, $reason) {
       

        $data = array('flagUserID' => $userId, 'postID' => $postId, 'flagDesc' => $reason, 'flagStatus' => '1');
       if($this->db->insert('flaggeditems', $data)){
        $qry = $this->db->query('SELECT trader.deviceId from post LEFT JOIN trader ON `post`.`traderID`=`trader`.`traderID` WHERE  post.postID=' . $postId);
     
        $this->load->Model('Admin_mdl');
        $this->Admin_mdl->sendpush($qry->result_array()[0],$reason);
        return 1;
        
       }else{
           return 0;
       }
      
    }
    function addtoflag2($userId, $postId, $productid, $productcatid, $traderid, $reason) {

        $data = array('traderID' => $traderid, 'flagUserID' => $userId, 'ProductcategoryID' => $productcatid, 'ProductID' => $productid, 'postID' => $postId, 'flagDesc' => $reason, 'flagStatus' => '1');
        $this->db->insert('flaggeditems', $data);
    }
    function getplans() {
        $this->db->select('planID as PlanId,planName as PlanName,planAmount as PlanAmount,planDesc as PlanDescription');
        $this->db->from('subscriptionplan');
        $this->db->order_by("planID", "asc");
        $qry = $this->db->get();
        return $qry->result();
    }

    function getbank() {
        $this->db->select('bankName,bankAccountNo');
        $this->db->from('alshamilbank');
        $qry = $this->db->get();
        return $qry->result();
    }

    function getlocation() {
        //array('lat'=>25.212306,'lng'=>55.247907)
        $this->db->select('locationName as OfficeName,locationAddress as Address,locationContactNo as phoneNumber,coordinates');
        $this->db->from('alshamillocation');
        $qry = $this->db->get();
        return $qry->result();
    }

    function get_favourite_traderid($userId) {
        $qry = $this->db->query('SELECT watchlist.watchlistID,watchlist.postID, p.productCategoryID,watchlist.productID,
           `productcar`.`productCBrand`,`productcar`.`cartCType`  ,DATE_FORMAT(productcar.productCSubmitDate,"%d %b %Y") as publishedCOn ,`productcar`.`productCCallPrice`, `productcar`.`productCModel`,productcar.productCReleaseYear, `productcar`.`productCPrice`,productcar.productCStatus,productcar.productCDesc,productcar.Cpost_main_img,
           `productbike`.`productBBrand`,`productbike`.`cartBType` ,`productbike`.`productBCallPrice`, `productbike`.`productBModel`, DATE_FORMAT(productbike.productBSubmitDate,"%d %b %Y") as publishedBOn,productbike.productBReleaseYear as Bikeyear, `productbike`.`productBPrice`,productbike.productBStatus,productbike.Bpost_main_img,productbike.productBDesc as bike,
           `productboat`.`productBtBrand`,`productboat`.`cartBTType` ,DATE_FORMAT(productboat.productBTSubmitDate,"%d %b %Y") as publishedBtOn,`productboat`.`productBtCallPrice`, `productboat`.`productBtModel`, `productboat`.`productBTSubmitDate`,productboat.productBReleaseYear, `productboat`.`productBTPrice`,productboat.productBTStatus,productboat.productBDesc,productboat.BTpost_main_img, 
           `productwatch`.`productWBrand`,`productwatch`.`cartWType` ,DATE_FORMAT(productwatch.productWSubmitDate,"%d %b %Y") as publishedWOn,`productwatch`.`productWCallPrice`, `productwatch`.`productWModel`, `productwatch`.`productWSubmitDate`, `productwatch`.`productWPrice`,productwatch.productWStatus,productwatch.productWDesc,productwatch.Wpost_main_img,
           `productvertu`.`productVBrand`,`productvertu`.`cartVType` ,DATE_FORMAT(productvertu.productVSubmitDate,"%d %b %Y") as publishedVOn,`productvertu`.`productVCallPrice`, `productvertu`.`productVModel`, `productvertu`.`productVSubmitDate`, `productvertu`.`productVPrice`,productvertu.productVStatus,productvertu.productVDesc,productvertu.Vpost_main_img, 
           `productproperty`.`productPropSC`,`productproperty`.`cartPRType` ,DATE_FORMAT(productproperty.productPRSubmitDate,"%d %b %Y") as publishedPROn ,`productproperty`.`productPropCallPrice`,`productproperty`.`productPropType`,  `productproperty`.`productPRSubmitDate`, `productproperty`.`productPRPrice`,productproperty.productPRStatus,productproperty.productDesc,productproperty.PRpost_main_img, 
           `productphone`.`productPBrand`,`productphone`.`cartPHType` ,DATE_FORMAT(productphone.productPSubmitDate,"%d %b %Y") as publishedPOn,`productphone`.`productPhCallPrice`, `productphone`.`productPModel`, `productphone`.`productPSubmitDate`, `productphone`.`productPHPrice`,productphone.productPHStatus,productphone.productPDesc,productphone.PHpost_main_img,
           `productnp`.`productNPCode`,`productnp`.`cartNPType` ,DATE_FORMAT(productnp.productNPSubmitDate,"%d %b %Y") as publishedNPOn,`productnp`.`productNPCallPrice`, `productnp`.`productNPDigits`, `productnp`.`productNPSubmitDate`, `productnp`.`productNPPrice`,productnp.productNPStatus,productnp.productNPDesc,productnp.NPpost_main_img,productnp.productNPNmbr,productnp.productNPEmrites,
           `productmn`.`productMNPrefix`,`productmn`.`cartMNType` ,DATE_FORMAT(productmn.productMNSubmitDate,"%d %b %Y") as publishedMNOn,`productmn`.`productMNCallPrice`, `productmn`.`productMNNmbr`, `productmn`.`productMNSubmitDate`, `productmn`.`productMNPrice`,productmn.productMNStatus,productmn.productMNDesc,productmn.MNpost_main_img,productmn.productOperator,
            `trader`.`traderID`, `trader`.`traderFullName`, `trader`.`traderLocation`, `trader`.`traderImage`

        from watchlist
        left JOIN `post` as p ON `watchlist`.`postID`=`p`.`postID`
        left JOIN `trader` ON `trader`.`traderID` = `p`.`traderID`
        left JOIN `productcar` ON ( p.`productID`=`productcar`.`productID`)
        left JOIN `productbike` ON ( p.`productID`=`productbike`.`productID`)
        left JOIN `productboat` ON (p.`productID`=`productboat`.`productID`)
        left JOIN `productmn` ON ( p.`productID`=`productmn`.`productID`) 
        left JOIN `productnp` ON ( p.`productID`=`productnp`.`productID`)
        left JOIN `productphone` ON ( p.`productID`=`productphone`.`productID`)
        left JOIN `productproperty` ON (p.`productID`=`productproperty`.`productID`) 
        left JOIN `productvertu` ON (p.`productID`=`productvertu`.`productID`)
        left JOIN `productwatch` ON (p.`productID`=`productwatch`.`productID`)
    
        
        WHERE `watchlist`.`userID` = ' . $userId." order by `watchlist`.`watchlistID` DESC");
        foreach ($qry->result() as $row) {
            $data['postId'] = $row->postID;
            $data['CategoryId'] = $row->productCategoryID;
            $data['ProductId'] = $row->productID;

//            
            if ($data['CategoryId'] == 1) {
                $data['thumbnailUrl'] = $row->Cpost_main_img;
                $data['is_alshamilProduct'] = $row->cartCType;
                
                $data['price'] = $row->productCPrice;
                $data['tittleEn'] = $row->productCBrand . " " . $row->productCModel;
                $data['tittleAr'] = "";

                $data['status'] = $row->productCStatus;
                $data['callForPrice'] = $row->productCCallPrice;
                $data['publishedOn'] = $row->publishedCOn;
                $data['IsAlshamilProduct'] = $row->cartCType;
            } else if ($data['CategoryId'] == 2) {
                $data['is_alshamilProduct'] = $row->cartBType;
                $data['thumbnailUrl'] = $row->Bpost_main_img;
               
                $data['price'] = $row->productBPrice;
                $data['tittleEn'] = $row->productBBrand . " " . $row->productBModel;
                $data['tittleAr'] = "";
                $data['status'] = $row->productBStatus;
                $data['callForPrice'] = $row->productBSSCallPrice;
                $data['publishedOn'] = $row->publishedBOn;
                $data['IsAlshamilProduct'] = $row->cartBType;
            } else if ($data['CategoryId'] == 3) {
                $data['is_alshamilProduct'] = $row->cartNPType;
                $data['thumbnailUrl'] = $row->NPpost_main_img;
             
                $data['price'] = $row->productNPPrice;
                $data['tittleEn'] = $row->productNPCode . " " . $row->productNPNmbr;
                $data['tittleAr'] = "";
                $data['status'] = $row->productNPStatus;
                $data['callForPrice'] = $row->productNPCallPrice;
                $data['publishedOn'] = $row->publishedNPOn;
                $data['IsAlshamilProduct'] = $row->cartNPType;
            } else if ($data['CategoryId'] == 4) {
                $data['is_alshamilProduct'] = $row->cartVType;
                $data['thumbnailUrl'] = $row->Vpost_main_img;
            
                $data['price'] = $row->productVPrice;
                $data['tittleEn'] = $row->productVBrand . " " . $row->productVModel;
                $data['tittleAr'] = "";

                $data['status'] = $row->productVStatus;
                $data['callForPrice'] = $row->productVCallPrice;
                $data['publishedOn'] = $row->publishedVOn;
                $data['IsAlshamilProduct'] = $row->cartVType;
            } else if ($data['CategoryId'] == 5) {
                $data['is_alshamilProduct'] = $row->cartWType;
                $data['thumbnailUrl'] = $row->Wpost_main_img;
               
                $data['price'] = $row->productWPrice;
                $data['tittleEn'] = $row->productWBrand . " " . $row->productWModel;
                $data['tittleAr'] = "";

                $data['status'] = $row->productWStatus;
                $data['callForPrice'] = $row->productWCallPrice;
                $data['publishedOn'] = $row->publishedWOn;
                $data['IsAlshamilProduct'] = $row->cartWType;
            } else if ($data['CategoryId'] == 6) {
                $data['is_alshamilProduct'] = $row->cartMNType;
                $data['thumbnailUrl'] = $row->MNpost_main_img;
             
                $data['price'] = $row->productMNPrice;
                $data['tittleEn'] = $row->productOperator . " " . $row->productMNNmbr;
                $data['tittleAr'] = "";

                $data['status'] = $row->productMNStatus;
                $data['callForPrice'] = $row->productMNCallPrice;
                $data['publishedOn'] = $row->publishedMNOn;
                $data['IsAlshamilProduct'] = $row->cartMNType;
            } else if ($data['CategoryId'] == 7) {
                $data['is_alshamilProduct'] = $row->cartBTType;
                $data['thumbnailUrl'] = $row->BTpost_main_img;
               
                $data['price'] = $row->productBTPrice;
                $data['tittleEn'] = $row->productBtBrand . " " . $row->productBtModel;
                $data['tittleAr'] = "";

                $data['status'] = $row->productBTStatus;
                $data['callForPrice'] = $row->productBtCallPrice;
                $data['publishedOn'] = $row->publishedBtOn;
                $data['IsAlshamilProduct'] = $row->cartBTType;
                
            } else if ($data['CategoryId'] == 8) {
                $data['is_alshamilProduct'] = $row->cartPHType;
                $data['thumbnailUrl'] = $row->PHpost_main_img;
              
                $data['price'] = $row->productPHPrice;
                $data['tittleEn'] = $row->productPBrand . " " . $row->productPModel;
                $data['tittleAr'] = "";
//                
                $data['status'] = $row->productPHStatus;
                $data['callForPrice'] = $row->productPCallPrice;
                $data['publishedOn'] = $row->publishedPOn;
                $data['IsAlshamilProduct'] = $row->cartPHType;
            } else if ($data['CategoryId'] == 9) {
                $data['is_alshamilProduct'] = $row->cartPRType;
                $data['thumbnailUrl'] = $row->PRpost_main_img;
             
                $data['price'] = $row->productPRPrice;
                $data['tittleEn'] = $row->productPropType . " " . $row->productPropSC;
                $data['tittleAr'] = "";
//               
                $data['status'] = $row->productPRStatus;
                $data['callForPrice'] = $row->productPropCallPrice;
                $data['publishedOn'] = $row->publishedPROn;
                $data['IsAlshamilProduct'] = $row->cartPRType;
            } else {
                $data['is_alshamilProduct'] = "";
                $data['thumbnailUrl'] = "";
                $data['publishedOn'] = "";
                $data['price'] = "";
                $data['tittleEn'] = "";

                $data['tittleAr'] = "";
                $data['status'] = "";
                $data['IsAlshamilProduct'] = '';
            }

//           
            $data['traderId'] = $row->traderID;
            $data['traderNameEn'] = $row->traderFullName;
            $data['traderNameAr'] = "";
            $data['traderLocationEn'] = $row->traderLocation;
            $data['traderLocationAr'] = "";
            $data['traderImage'] = $row->traderImage;

            $row_post[] = $data;
            $data = '';
        }
       
        return !empty($row_post)?$row_post:array();
    }

    function getprice($value) {


        $qry = $this->db->query('SELECT  
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
        WHERE `post`.`postID` = ' . $value);
        return $qry->result();
    }

    function mobilebrands() {
        $c1 = $this->db->query('select  distinct brandName from category_subtypes where productCategoryId=6');
        return $c1->result();
    }

    function mobilemodel($brand) {
        $c3 = $this->db->query('select  distinct modelName from category_subtypes where productCategoryId=6 and brandName="' . $brand . '"');
        return $this->Data_mdl->result_val($c3->result_array());
    }
    function carbrand() {
        $c1 = $this->db->query('select  distinct brandName from category_subtypes where productCategoryId=1');
        return $c1->result();
    }

    function carmodel($brand) {
        $c3 = $this->db->query('select  distinct modelName from category_subtypes where productCategoryId=1 and brandName="' . $brand . '"');
        return $this->Data_mdl->result_val($c3->result_array());
    }

    function bikebrand() {
        $c1 = $this->db->query('select  distinct brandName from category_subtypes where productCategoryId=2');
        return $c1->result();
    }

    function bikemodel($brand) {
        $c3 = $this->db->query('select  distinct modelName from category_subtypes where productCategoryId=2 and brandName="' . $brand . '"');
        return $this->Data_mdl->result_val($c3->result_array());
    }

    function boatbrands() {
        $bt1 = $this->db->query('select  distinct brandName from category_subtypes where productCategoryId=7');
        return $bt1->result();
    }

    function boatmodel($brand) {
        $bt1 = $this->db->query('select  distinct modelName from category_subtypes where productCategoryId=7 and brandName="' . $brand . '"');
        return $this->Data_mdl->result_val($bt1->result_array());
        
    }

    function vertubrands() {
        $v1 = $this->db->query('select  distinct brandName from category_subtypes where productCategoryId=4');
        return $v1->result();
    }

    function vertumodel($brand) {
        $v1 = $this->db->query('select  distinct modelName from category_subtypes where productCategoryId=4 and brandName="' . $brand . '"');
        return $this->Data_mdl->result_val($v1->result_array());
    }

    function watchbrands() {
        $w1 = $this->db->query('select  distinct brandName from category_subtypes where productCategoryId=5');
        return $w1->result();
        
    }

    function watchmodel($brand) {
        $w1 = $this->db->query('select  distinct modelName from category_subtypes where productCategoryId=5 and brandName="' . $brand . '"');
       return $this->Data_mdl->result_val($w1->result_array());
    }
    function phonebrands() {
        $ph1 = $this->db->query('select  distinct brandName from category_subtypes where productCategoryId=8');
        return $ph1->result();
    }

    function phonemodel($brand) {
        $ph1 = $this->db->query('select  distinct modelName from category_subtypes where productCategoryId=8 and brandName="' . $brand . '"');
        return $this->Data_mdl->result_val($ph1->result_array());
    }
    function numberplatebrands() {
        $ph1 = $this->db->query('select  distinct brandName from category_subtypes where productCategoryId=3');
        return $ph1->result();
    }

    function numberplatebrandsmodel($brand) {
        $ph1 = $this->db->query('select  distinct modelName from category_subtypes where productCategoryId=3 and brandName="' . $brand . '"');
        return $this->Data_mdl->result_val($ph1->result_array());
    }
    function propertybrands() {
        $pr1 = $this->db->query('select  distinct brandName from category_subtypes where productCategoryId=9');
        return $pr1->result();
    }

    function propertiesmodel($brand) {
        $pr1 = $this->db->query('select  distinct modelName from category_subtypes where productCategoryId=9 and brandName="' . $brand . '"');
        return $this->Data_mdl->result_val($pr1->result_array());
    }
    function get_myprofile($userId) {
        $this->db->select('traderFullName as name,traderUserName as username,traderInfo as companyDescription,traderLocation as place,traderContactNum as mobile,traderEmailID as email,traderImage as profileImage,traderIDProof as idImage1,traderIDProofsecond as idImage2,socialWeb as web,socialFb as facebook,socialInsta as instagram,socialSnap as snapchat,socialtwitter as twitter,deviceId as deviceId,usertype as userTypeId,traderValidTill as planValidity,traderPaymentHistory as TotalAmountGained,traderPostCount as TotalPost,traderBookedCount as Booked,traderSoldCount as Sold,planValidity,planPostCount,tplanID');
        $this->db->from('vwTrader');
      //  $this->db->join('post','post.traderID=vwTrader.traderID');
        $this->db->where('vwTrader.traderID', $userId);
        $this->db->limit(1);
        $query = $this->db->get();
       
        if ($query->num_rows() == 1) {
            $sold=$this->get_countsold($userId);
            $booked=$this->get_countbooked($userId);
          
            $results = $query->result();
            $results[0]->Booked=$booked[0]->count;
            $results[0]->Sold=$sold[0]->sold_count;
            
            return $results;
        } else {
            return false;
        }
    }
    function get_amount_received($userId) {
        $this->db->select('sum(Price) as amountReceived');
        $this->db->where('vwProductPost.AvailablitiyStatus', 1);
        $this->db->where('vwProductPost.traderID', $userId);
        $this->db->from('vwProductPost');
        $query = $this->db->get();
        return $query->result();
    }
    function get_post_images($post_id) {
       /* $qry = $this->db->query('SELECT
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
        WHERE `post`.`postID` = ' . $post_id);*/
        $qry = $this->db->query('SELECT
        `productiv`.`productImage`from productiv
        WHERE `productiv`.`postID` = ' . $post_id);
             foreach( $qry->result() as $result){
                $link_array = explode('/',$result->productImage);
                $file = end($link_array);
                $file_det = pathinfo($file);
               // $title = $this->Trader_mdl->getTitle($result->productID, $result->productCategoryID);
                // if ($result->thumbImage == '') {
                //     $poster = $this->Trader_mdl->getImage($result->productID, $result->productCategoryID);
                // } else {
                //     $poster = $result->thumbImage;
                // }
                if(isset($file_det['extension'])){
                    $results[] = $result->productImage;
                }
                // if (file_exists($videos->productVideo) && pathinfo($videos->productVideo, PATHINFO_EXTENSION)) {
                    
                //     }
      
             }
        // foreach( $qry->result() as $data){
            
        //     if (file_exists($data->productImage)) {
        //         $results[] = $data;
        //         }
          
            
        //  }
        return isset($results)?$results:NULL;
    }

    function traderpostcount($traderID) {
        $traderqry = $this->db->query('select traderPostCount from trader where traderID=' . $traderID);
        return $traderqry->result();
    }

    function emailcheck($username=NULL,$email=NULL) {
    
        if(isset($username)){
            $where = "WHERE traderUserName ='$username' OR traderEmailID  ='$email'";
        }else{
            $where ="WHERE traderEmailID  ='$email'";
        }
        
        $qry = $this->db->query("SELECT * FROM trader ".$where);
        return $qry->result();
    }

    function getnotifications($trader_id) {
        $qry = $this->db->query('SELECT  `flaggeditems`.`postID`,flaggeditems.productCategoryID,flaggeditems.productID,flaggeditems.flagDesc,flaggeditems.flagDate,
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
        WHERE `flaggeditems`.`traderID` = ' . $trader_id);
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

    function flaggeduser($flaguser) {
        if ($flaguser != '') {
            $qry = $this->db->query('Select traderFullName,traderImage from trader where traderID=' . $flaguser . '');
            return $qry->result();
        }
    }
    function update_view_cnt($product_id, $cat_id) {
        $qry = $this->db->query('select productViewCount from post where productID=' . $product_id . ' and productCategoryID=' . $cat_id);
        $myres = $qry->result();
        $up_date = date('Y-m-d h:i:sa');
        $prev_cnt = $myres[0]->productViewCount;
        $updated_cnt = $prev_cnt + 1;
        $data['productViewCount'] = $updated_cnt;
        $data['productLastViewed'] = $up_date;
        $this->db->where('productID', $product_id);
        $this->db->where('productCategoryID', $cat_id);
        $this->db->update('post', $data);
    }

    function descr_view_cnt($product_id, $cat_id) {
        $qry = $this->db->query('select productViewCount from post where productID=' . $product_id . ' and productCategoryID=' . $cat_id);
        $myres = $qry->result();

        $prev_cnt = $myres[0]->productViewCount;
        $updated_cnt = $prev_cnt - 1;
        $data['productViewCount'] = $updated_cnt;
        $this->db->where('productID', $product_id);
        $this->db->where('productCategoryID', $cat_id);
        $this->db->update('post', $data);
    }
    // function notification_cnt() {
    //     $session_data = $this->session->userdata('logged_in');
    //     $trader_id = $session_data['trader_id'];
    //     $this->db->where('traderID', $trader_id);
    //     $this->db->where('readStatus', '0');
    //     $this->db->select('count(*) as total_entries');
    //     $notification = $this->db->get('flaggeditems');
    //     return $notification->result();
    // }
    function notification_cnt() {
        $session_data = $this->session->userdata('logged_in');
        $trader_id = $session_data['trader_id'];
        $this->db->where('traderID', $trader_id);
        $this->db->where('readStatus', '0');
        $this->db->select('count(*) as total_entries');
        $notification1 = $this->db->get('flaggeditems');
        $notif1 = $notification1->result();

        $this->db->where('traderID', $trader_id);
        $this->db->where('readStatus', '0');
        $this->db->select('count(*) as total_entries');
        $notification2 = $this->db->get('tradernotifications');
        $notif2 = $notification2->result();
        return array(
            'flagcnt' => $notif1,
            'notcnt' => $notif2,
        );
    }
    public function trader_plan_amts($trader_id) {

        $this->db->query('update tradersubscriptionplan set paymentTypeChosen = 3 where traderID=' . $trader_id);
        $qry = $this->db->query('SELECT subscriptionplan.planAmount FROM `tradersubscriptionplan` join subscriptionplan on tradersubscriptionplan.planID=subscriptionplan.planID where tradersubscriptionplan.traderID=' . $trader_id);
        return $qry->result();
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
            $query = 'select traderID as tId, productID as id,productCategoryName as category, productCBrand as brand, productCmodel as model, productCPrice as price, Cpost_main_img as image from productcar where productCategoryID = "' . $category . '"';
            if ($brand != "") {
                $query = $query . 'and productCBrand = "' . $brand . '"';
            }
            if ($model != "") {
                $query = $query . 'and productCModel = "' . $model . '"';
            }
            if ($from != "" || $to != "") {
                if ($from == "") {
                    $from = '1990';
                }
                if ($to == "") {
                    $to = date('Y');
                }
                $query = $query . 'and productCReleaseYear BETWEEN ' . $from . ' AND ' . $to . '';
            }

            $qry = $this->db->query($query);
            return $qry->result();
        }
        //Bike
        if ($category == 2) {
            $query = 'select  traderID as tId, productID as id,productCategoryName as category, productBBrand as brand, productBmodel as model, '
                    . 'productBPrice as price, Bpost_main_img as image from productbike where '
                    . 'productCategoryID = "' . $category . '"';
            if ($brand != "") {
                $query = $query . 'and productBBrand = "' . $brand . '"';
            }
            if ($model != "") {
                $query = $query . 'and productBModel = "' . $model . '"';
            }
            if ($from != "" || $to != "") {
                if ($from == "") {
                    $from = '1990';
                }
                if ($to == "") {
                    $to = date('Y');
                }
                $query = $query . 'and productBReleaseYear BETWEEN ' . $from . ' AND ' . $to . '';
            }
//         echo $query;exit();
            $qry = $this->db->query($query);
            return $qry->result();
        }
        //Number Plate
        if ($category == 3) {
            $query = 'select traderID as tId, productID as id, productBBrand as brand, productBmodel as model, '
                    . 'productBPrice as price, Bpost_main_img as image from productbike where '
                    . 'productCategoryID = "' . $category . '"';
            if ($brand != "") {
                $query = $query . 'and productBBrand = "' . $brand . '"';
            }
            if ($model != "") {
                $query = $query . 'and productBModel = "' . $model . '"';
            }
            if ($from != "" || $to != "") {
                if ($from == "") {
                    $from = '1990';
                }
                if ($to == "") {
                    $to = date('Y');
                }
                $query = $query . 'and productBReleaseYear BETWEEN ' . $from . ' AND ' . $to . '';
            }


            $qry = $this->db->query($query);
            return $qry->result();
        }
        //Vertu
        if ($category == 4) {
            $query = 'select traderID as tId, productID as id, productVBrand as brand, productVmodel as model, '
                    . 'productVPrice as price, Vpost_main_img as image from productvertu where '
                    . 'productCategoryID = "' . $category . '"';
            if ($brand != "") {
                $query = $query . 'and productVBrand = "' . $brand . '"';
            }
            if ($model != "") {
                $query = $query . 'and productVModel = "' . $model . '"';
            }



            $qry = $this->db->query($query);
            return $qry->result();
        }
        //Watch
        if ($category == 5) {
            $query = 'select productID as id, productWBrand as brand, productWmodel as model, '
                    . 'productWPrice as price, Wpost_main_img as image from productwatch where '
                    . 'productCategoryID = "' . $category . '"';
            if ($brand != "") {
                $query = $query . 'and productWBrand = "' . $brand . '"';
            }
            if ($model != "") {
                $query = $query . 'and productWModel = "' . $model . '"';
            }
            if ($from != "" || $to != "") {
                if ($from == "") {
                    $from = '1990';
                }
                if ($to == "") {
                    $to = date('Y');
                }
                $query = $query . 'and productBReleaseYear BETWEEN ' . $from . ' AND ' . $to . '';
            }

            $qry = $this->db->query($query);
            return $qry->result();
        }
        //Mobile Number
        if ($category == 6) {
            $query = 'select traderID as tId, productID as id, productMNPrefix as brand, productMNNmbr as model, '
                    . 'productMNPrice as price, MNpost_main_img as image from productmn where '
                    . 'productCategoryID = "' . $category . '"';
            if ($brand != "") {
                $query = $query . 'and productMNPrefix = "' . $brand . '"';
            }
            if ($model != "") {
                $query = $query . 'and productMNNmbr = "' . $model . '"';
            }
            if ($from != "" || $to != "") {
                if ($from == "") {
                    $from = '1990';
                }
                if ($to == "") {
                    $to = date('Y');
                }
                $query = $query . 'and productBReleaseYear BETWEEN ' . $from . ' AND ' . $to . '';
            }

            $qry = $this->db->query($query);
            return $qry->result();
        }
        //Boat
        if ($category == 7) {
            $query = 'select productID as id, productBtBrand as brand, productBtModel as model, '
                    . 'productBTPrice as price, BTpost_main_img as image from productboat where '
                    . 'productCategoryID = "' . $category . '"';
            if ($brand != "") {
                $query = $query . 'and productBtBrand = "' . $brand . '"';
            }
            if ($model != "") {
                $query = $query . 'and productBtModel = "' . $model . '"';
            }
            if ($from != "" || $to != "") {
                if ($from == "") {
                    $from = '1990';
                }
                if ($to == "") {
                    $to = date('Y');
                }
                $query = $query . 'and productBReleaseYear BETWEEN ' . $from . ' AND ' . $to . '';
            }

            $qry = $this->db->query($query);
            return $qry->result();
        }
        //Phone
        if ($category == 8) {
            $query = 'select productID as id, productPBrand as brand, productPModel as model, '
                    . 'productPHPrice as price, PHpost_main_img as image from productphone where '
                    . 'productCategoryID = "' . $category . '"';
            if ($brand != "") {
                $query = $query . 'and productPBrand = "' . $brand . '"';
            }
            if ($model != "") {
                $query = $query . 'and productPModel = "' . $model . '"';
            }
            if ($from != "" || $to != "") {
                if ($from == "") {
                    $from = '1990';
                }
                if ($to == "") {
                    $to = date('Y');
                }
                $query = $query . 'and productBReleaseYear BETWEEN ' . $from . ' AND ' . $to . '';
            }

            $qry = $this->db->query($query);
            return $qry->result();
        }
        //Property
        if ($category == 9) {
            $query = 'select productID as id, productPropSC as brand, productPropType as model, '
                    . 'productPRPrice as price, PRpost_main_img as image from productproperty where '
                    . 'productCategoryID = "' . $category . '"';
            if ($brand != "") {
                $query = $query . 'and productPropSC = "' . $brand . '"';
            }
            if ($model != "") {
                $query = $query . 'and productPropType = "' . $model . '"';
            }
            if ($from != "" || $to != "") {
                if ($from == "") {
                    $from = '1990';
                }
                if ($to == "") {
                    $to = date('Y');
                }
                $query = $query . 'and productBReleaseYear BETWEEN ' . $from . ' AND ' . $to . '';
            }

            $qry = $this->db->query($query);
            return $qry->result();
        }
    }

    function checkpostId($post_id) {
        $qry = $this->db->query("SELECT * FROM post WHERE postID ='$post_id'");
        return $qry->result();
    }

    function checktrader($trader_id) {
        $qry = $this->db->query("SELECT * FROM post WHERE traderID ='$trader_id'");
        return $qry->result();
    }

    function checkfavourite($userId) {
        $qry = $this->db->query("SELECT * FROM watchlist WHERE traderID ='$userId'");
        return $qry->result();
    }

    function checkcart($userId) {
        $qry = $this->db->query("SELECT * FROM cartlist WHERE traderID ='$userId'");
        return $qry->result();
    }

    function checknotification($userId) {
        $qry = $this->db->query("SELECT * FROM tradernotifications WHERE traderID ='$userId'");
        return $qry->result();
    }

    function checkapproved($userId) {
        $qry = $this->db->query("SELECT * FROM post WHERE traderID ='$userId' and postStatus='1'");
        return $qry->result();
    }

    function checkrejected($userId) {
        $qry = $this->db->query("SELECT * FROM post WHERE traderID ='$userId' and postStatus='0'");
        return $qry->result();
    }

    function checkpending($userId) {
        $qry = $this->db->query("SELECT * FROM post WHERE traderID ='$userId' and postStatus='-1'");
        return $qry->result();
    }

    function checksold($userId) {
        $qry = $this->db->query("SELECT * FROM order_items WHERE traderID ='$userId' and productStatus='3'");
        return $qry->result();
    }

    function checkbooked($userId) {
        $qry = $this->db->query("SELECT * FROM bookeditems WHERE traderID ='$userId' ");
        return $qry->result();
    }

    function checkout($value) {
        $qry = $this->db->query("SELECT * FROM post WHERE postID ='$value' ");
        return $qry->result();
    }

    function check_trader($userId) {
        $qry = $this->db->query("SELECT * FROM trader WHERE traderID ='$userId' ");
        return $qry->result();
    }

    function check_traderbyid($traderId) {
        $qry = $this->db->query("SELECT * FROM trader WHERE traderID ='$traderId' ");
        return $qry->result();
    }

    function yearlyplan() {
        $qry = $this->db->query("SELECT * FROM subscriptionplan  ");
        return $qry->result();
    }

    function productid($postId) {
        $this->db->select('productID');
        $this->db->from('post');
        $this->db->where('postID', $postId);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $result = $query->result();
            foreach ($result as $row) {
                return $row->productID;
            }
        } else {
            return false;
        }
    }

    function productcatid($postId) {
        $this->db->select('productCategoryID');
        $this->db->from('post');
        $this->db->where('postID', $postId);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $result = $query->result();
            foreach ($result as $row) {
                return $row->productCategoryID;
            }
        } else {
            return false;
        }
    }

    function traderid($postId) {
        $this->db->select('traderID');
        $this->db->from('post');
        $this->db->where('postID', $postId);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $result = $query->result();
            foreach ($result as $row) {
                return $row->traderID;
            }
        } else {
            return false;
        }
    }

    function fetch_edit_bike($product_id, $category_id) {
        $qry = $this->db->query('SELECT DISTINCT  productiv.productImage,productiv.productVideo,post.postID,post.productCategoryID,post.productID,productiv.productViewCount,
     productbike.cartBType,productbike.productBPrice,productbike.Bpost_main_img,productbike.productBBrand,productbike.productCategoryName,productbike.productBModel,productbike.productBDesc,productbike.productBCallPrice,productbike.productBStatus,productbike.productBReleaseYear,productiv.thumbVideo,
     trader.traderID FROM `post`
     left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
     
     left JOIN `productiv` ON (`post`.`postID`=`productiv`.`postID` and post.productCategoryID=productiv.productCategoryID)
      
        left join productbike on (post.productCategoryID=productbike.productCategoryID and post.productID=productbike.productID)
       
        where post.productID=' . $product_id . ' and post.productCategoryID=' . $category_id);
        return $qry->result();
    }

    public function fetch_bike_brands($cat_id) {
        $bike_brand = $this->db->query('select distinct brandName from category_subtypes where productCategoryID=' . $cat_id);
        return $bike_brand->result();
    }

    public function fetch_bike_models($bikebrand) {
        $bike_model = $this->db->query('SELECT  modelName from category_subtypes where brandName="' . $bikebrand . '"');
        return $bike_model->result();
    }

    function fetch_edit_vertu($product_id, $category_id) {
        $qry = $this->db->query('SELECT   productiv.productImage,productiv.productVideo,post.postID,post.productCategoryID,post.productID,productiv.productViewCount,
      productvertu.cartVType,productvertu.productVPrice,productvertu.Vpost_main_img,productvertu.productVBrand,productvertu.productVModel,productvertu.productVDesc,productvertu.productVCallPrice,productvertu.productVStatus,productiv.thumbVideo,productvertu.productCategoryName,
       trader.traderID FROM `post`
        left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
     
        left JOIN `productiv` ON (`post`.`postID`=`productiv`.`postID` and post.productCategoryID=productiv.productCategoryID)
      
        left join productvertu on (post.productCategoryID=productvertu.productCategoryID and post.productID=productvertu.productID)
       
        where post.productID=' . $product_id . ' and post.productCategoryID=' . $category_id);
        return $qry->result();
    }

    public function fetch_vertu_brands($cat_id) {
        $vertu_brand = $this->db->query('select distinct brandName from category_subtypes where productCategoryID=' . $cat_id);
        return $vertu_brand->result();
    }

    public function fetch_vertu_models($vertubrand) {
        $vertu_model = $this->db->query('SELECT  modelName from category_subtypes where brandName="' . $vertubrand . '"');
        return $vertu_model->result();
    }

    function fetch_edit_car($product_id, $category_id) {
        $qry = $this->db->query('SELECT   productiv.productImage,productiv.productVideo,post.postID,post.productCategoryID,post.productID,productiv.productViewCount,
      productcar.cartCType,productcar.productCPrice,productcar.Cpost_main_img,productcar.productCBrand,productcar.productCModel,productcar.productCDesc,productcar.productCCallPrice,productcar.productCStatus,productiv.thumbVideo,productcar.productCategoryName,productcar.productCReleaseYear,
       trader.traderID FROM `post`
        left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
     
        left JOIN `productiv` ON (`post`.`postID`=`productiv`.`postID` and post.productCategoryID=productiv.productCategoryID)
      
        left join productcar on (post.productCategoryID=productcar.productCategoryID and post.productID=productcar.productID)
       
        where post.productID=' . $product_id . ' and post.productCategoryID=' . $category_id);
        return $qry->result();
    }

    public function fetch_car_brands($cat_id) {
        $car_brand = $this->db->query('SELECT DISTINCT brandName from category_subtypes where productCategoryID=' . $cat_id);
        return $car_brand->result();
    }

    public function fetch_car_models($carbrand) {
        $car_model = $this->db->query('SELECT  modelName from category_subtypes where brandName="' . $carbrand . '"');
        return $car_model->result();
    }

    function fetch_edit_noplate($product_id, $category_id) {
        $qry = $this->db->query('SELECT productiv.productImage,post.postID,post.productCategoryID,post.productID,
      productnp.cartNPType, productnp.type,  productnp.productNPSubmitDate,productnp.productNPPrice,productnp.NPpost_main_img,productnp.productNPDigits,productnp.productNPDesc,productnp.productNPCallPrice,productnp.productCategoryName,productnp.productNPEmrites,productnp.productNPCode,productnp.productNPNmbr,
      trader.traderID FROM `post`
      left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
      left JOIN `productiv` ON (`post`.`postID`=`productiv`.`postID` and post.productCategoryID=productiv.productCategoryID)
      left join productnp on (post.productCategoryID=productnp.productCategoryID and post.productID=productnp.productID)
      where post.productID=' . $product_id . ' and post.productCategoryID=' . $category_id);
        return $qry->result();
    }

    public function fetch_noplate_emirate() {
        $noplate = $this->db->query('select *  from noplate_template');

        return $noplate->result();
    }

    public function fetch_emi_code($em) {
        $em_code = $this->db->query('select code from noplate_template where noplateTempID="' . $em . '"');
        return $em_code->result();
    }

    public function fetch_noplate_code() {
        $no_plate = $this->db->query('select code  from noplate_template');
        return $no_plate->result();
    }

    function fetch_edit_watch($product_id, $category_id) {
        $qry = $this->db->query('SELECT   productiv.productImage,productiv.productVideo,post.postID,post.productCategoryID,post.productID,productiv.productViewCount,
      productwatch.cartWType,  productwatch.productWSubmitDate,productwatch.productWPrice,productwatch.Wpost_main_img,productwatch.productWBrand,productwatch.productWModel,productwatch.productWDesc,productwatch.productWCallPrice,productwatch.productWStatus,productiv.thumbVideo,productwatch.productCategoryName,
       trader.traderID FROM `post`
        left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
     
        left JOIN `productiv` ON (`post`.`postID`=`productiv`.`postID` and post.productCategoryID=productiv.productCategoryID)
      
        left join productwatch on (post.productCategoryID=productwatch.productCategoryID and post.productID=productwatch.productID)
       
        where post.productID=' . $product_id . ' and post.productCategoryID=' . $category_id);
        return $qry->result();
    }

    public function fetch_watch_brands($cat_id) {
        $watch_brand = $this->db->query('select distinct brandName from category_subtypes where productCategoryID=' . $cat_id);
        return $watch_brand->result();
    }

    public function fetch_watch_models($watchbrand) {
        $watch_model = $this->db->query('SELECT  modelName from category_subtypes where brandName="' . $watchbrand . '"');
        return $watch_model->result();
    }

    function fetch_edit_boat($product_id, $category_id) {
        $qry = $this->db->query('SELECT   productiv.productImage,productiv.productVideo,post.postID,post.productCategoryID,post.productID,productiv.productViewCount,
    productboat.productBTPrice,productboat.BTpost_main_img,productboat.productBtBrand,productboat.productBtModel,productboat.productBDesc,productboat.productBtCallPrice,productiv.thumbVideo,productboat.productCategoryName,
    trader.traderID FROM `post`
    left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
     
    left JOIN `productiv` ON (`post`.`postID`=`productiv`.`postID` and post.productCategoryID=productiv.productCategoryID)
      
        left join productboat on (post.productCategoryID=productboat.productCategoryID and post.productID=productboat.productID)
       
        where post.productID=' . $product_id . ' and post.productCategoryID=' . $category_id);
        return $qry->result();
    }

    public function fetch_boat_brands($cat_id) {
        $boat_brand = $this->db->query('select distinct brandName from category_subtypes where productCategoryID=' . $cat_id);
        return $boat_brand->result();
    }

    public function fetch_boat_models($boatbrand) {
        $boat_model = $this->db->query('SELECT  modelName from category_subtypes where brandName="' . $boatbrand . '"');
        return $boat_model->result();
    }

    function fetch_edit_phone($product_id, $category_id) {
        $qry = $this->db->query('SELECT   productiv.productImage,productiv.productVideo,post.postID,post.productCategoryID,post.productID,productiv.productViewCount,
      productphone.productPHPrice,productphone.PHpost_main_img,productphone.productPBrand,productphone.productPModel,productphone.productPDesc,productphone.productPhCallPrice,productiv.thumbVideo,productphone.productCategoryName,
       trader.traderID FROM `post`
        left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
     
        left JOIN `productiv` ON (`post`.`postID`=`productiv`.`postID` and post.productCategoryID=productiv.productCategoryID)
      
        left join productphone on (post.productCategoryID=productphone.productCategoryID and post.productID=productphone.productID)
       
        where post.productID=' . $product_id . ' and post.productCategoryID=' . $category_id);
        return $qry->result();
    }

    public function fetch_phone_brands($cat_id) {
        $phone_brand = $this->db->query('select distinct brandName from category_subtypes where productCategoryID=' . $cat_id);
        return $phone_brand->result();
    }

    public function fetch_phone_models($phonebrand) {
        $phone_model = $this->db->query('SELECT  modelName from category_subtypes where brandName="' . $phonebrand . '"');
        return $phone_model->result();
    }

    function fetch_edit_mobilenumber($product_id, $category_id) {
        $qry = $this->db->query('SELECT   productiv.productImage,productiv.productVideo,post.postID,post.productCategoryID,post.productID,productmn.productOperator,
   productmn.productMNPrice,productmn.MNpost_main_img,productmn.productMNPrefix,productmn.productMNDesc,productmn.productMNCallPrice,productiv.thumbVideo,productmn.productCategoryName,productmn.productMNNmbr,
  trader.traderID FROM `post`
  left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
  left JOIN `productiv` ON (`post`.`postID`=`productiv`.`postID` and post.productCategoryID=productiv.productCategoryID)
  left join productmn on (post.productCategoryID=productmn.productCategoryID and post.productID=productmn.productID)
       
        where post.productID=' . $product_id . ' and post.productCategoryID=' . $category_id);
        return $qry->result();
    }

    function get_brandname_car($product_id) {
        $this->db->select('productCBrand');
        $this->db->from('productcar');
        $this->db->where('productID', $product_id);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $result = $query->result();
            foreach ($result as $row) {
                return $row->productCBrand;
            }
        } else {
            return false;
        }
    }

    function get_brandname_bike($product_id) {
        $this->db->select('productBBrand');
        $this->db->from('productbike');
        $this->db->where('productID', $product_id);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $result = $query->result();
            foreach ($result as $row) {
                return $row->productBBrand;
            }
        } else {
            return false;
        }
    }

    function get_brandname_vertu($product_id) {
        $this->db->select('productVBrand');
        $this->db->from('productvertu');
        $this->db->where('productID', $product_id);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $result = $query->result();
            foreach ($result as $row) {
                return $row->productVBrand;
            }
        } else {
            return false;
        }
    }

    function get_brandname_watch($product_id) {
        $this->db->select('productWBrand');
        $this->db->from('productwatch');
        $this->db->where('productID', $product_id);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $result = $query->result();
            foreach ($result as $row) {
                return $row->productWBrand;
            }
        } else {
            return false;
        }
    }

    function get_brandname_boat($product_id) {
        $this->db->select('productBtBrand');
        $this->db->from('productboat');
        $this->db->where('productID', $product_id);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $result = $query->result();
            foreach ($result as $row) {
                return $row->productBtBrand;
            }
        } else {
            return false;
        }
    }

    function get_brandname_phone($product_id) {
        $this->db->select('productPBrand');
        $this->db->from('productphone');
        $this->db->where('productID', $product_id);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $result = $query->result();
            foreach ($result as $row) {
                return $row->productPBrand;
            }
        } else {
            return false;
        }
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

    function fetch_plan($plan_id) {
        $qry = $this->db->query('select * from subscriptionplan where planID=' . $plan_id);
        return $qry->result();
    }

    function check_subplan_exist($trader_id) {
        $qry = $this->db->query('select * from tradersubscriptionplan where traderID=' . $trader_id);
        return $qry->result();
    }

    function emailchecking($email) {
        $this->db->select('traderEmailID');
        $this->db->from('trader');
        $this->db->where('traderEmailID', $email);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    function get_model_bikebrand($brand) {
        $this->db->select('modelName');
        $this->db->from('category_subtypes');
        $this->db->where('brandName', $brand);
        //$this->db->where('brand_id', $brand);
        $query = $this->db->get();
        $cities = array();

        if ($query->result()) {

            foreach ($query->result() as $city) {

                $cities[$city->modelName] = $city->modelName;
            }
            return $cities;
        } else {
            return FALSE;
        }
    }

    function get_alshamil_loc() {
        $qry = $this->db->get('alshamillocation');
        return $qry->result();
    }
    function checkout_status($order_id) {
        $this->db->where('orderID', $order_id);
        $this->db->delete('cartlist');
        $data['status'] = 1;
        $this->db->where('orderID', $order_id);
        $this->db->update('order_items', $data);
    }
    function getBrands($cat) {
        $q = 'select brandID,brandName from category_subtypes where productCategoryID = ' . $cat . ' group by brandID';
        $query = $this->db->query($q);
        $brands = array();
        if ($query->result()) {
            foreach ($query->result() as $city) {

                $brands[$city->brandID] = $city->brandName;
            }
            return $brands;
        } else {
            return FALSE;
        }
    }
    function fetch_model($brand) {
        $q = 'select modelID,modelName from category_subtypes where brandName = \'' . $brand . '\' group by modelName';
        $query = $this->db->query($q);
        $models = array();
        if ($query->result()) {
            foreach ($query->result() as $city) {

                $models[$city->modelID] = $city->modelName;
            }
            return $models;
        } else {
            return FALSE;
        }
    }

    public function get_categories_list() {
        $this->db->select('category_name');
        $this->db->from('category');

        $query = $this->db->get();
        $cities = array();

        if ($query->result()) {

            foreach ($query->result() as $city) {

                $cities[$city->category_name] = $city->category_name;
            }
            return $cities;
        } else {
            return FALSE;
        }
    }

    public function up_paystatus($trader_id) {

        $this->db->query('update tradersubscriptionplan set paymentTypeChosen = 1 where traderID=' . $trader_id);
    }
    
   function updateVideoCount($url, $count) { 
        $this->db->set('productVideoCount', $count);
        $this->db->where('productVideo', $url);
        $this->db->update('productiv');
        return;
    }
    public function fetch_plan_amts(){
        $this->db->select('planName,planAmount,planPostCount');
        $this->db->from('subscriptionplan');
        $this->db->order_by('planID');
        $qry = $this->db->get();
        return $qry->result();
    }
    function is_url_exist($url){
		$ch = curl_init($url);    
		curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_exec($ch);
		$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		if($code == 200){
		   $status = true;
		}else{
		  $status = false;
		}
		curl_close($ch);
		return $status;
    }
    function getRowsProducts($category,$keyword,$params = array()){
        if (is_numeric($category)) {
          $this->db->where('category.productCategoryID',$category);
      } elseif($category!='all') {
        $this->db->where('category.category_name',$category);
      }
        $start = 0;
        $this->db->select('*');
        $this->db->from('vwProductPost');
        $this->db->join('vwTrader', 'vwProductPost.TraderID = vwTrader.traderID');
        $this->db->join('category', 'vwProductPost.CategoryID = category.productCategoryID');
     //   $this->db->where('AvailablitiyStatus>',-1); // Un comment to hide removed posts
         if (!empty($keyword)){
          $this->db->group_start();
          $this->db->like('category.productCategoryID', $keyword, 'both'); 
          $this->db->or_like('vwProductPost.Brand', $keyword, 'both');
          $this->db->or_like('vwProductPost.Model', $keyword, 'both')->group_end();
        } 
        
         if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
              $this->db->limit($params['limit'],$params['start']);
          }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
              $this->db->limit($params['limit']);
          }
          $this->db->order_by('SubmitDate', 'DESC');
          //echo $this->db->get_compiled_select();
              $query =  $this->db->get();
            
         
          return ($query->num_rows() > 0)?$query->result_array():FALSE;
       }
  function get_post_details($postid){
    /*$this->db->select('productphone.productID,productphone.cartPHType,productiv.productImage,productphone.productCategoryName,productphone.productPBrand,productphone.productPModel,productphone.productPHPrice,trader.traderFullName,trader.traderLocation,trader.traderImage,productphone.productPSubmitDate,trader.traderContactNum,productphone.productPDesc');
    $this->db->from('productphone');
    $this->db->join('trader', 'productphone.traderID=trader.traderID');

    $this->db->join('productiv', 'productphone.productCategoryID=productiv.productCategoryID AND productphone.productID=productiv.productID');
    $this->db->where('productphone.productID', $product_id);
    $query = $this->db->get();*/
    $this->db->select('*');
    $this->db->from('vwProductPost');
    $this->db->join('vwTrader', 'vwProductPost.traderID=vwTrader.traderID');
    $this->db->where('postID', $postid);
    $this->db->limit(1);
    $query = $this->db->get();
    $result = $query->row();
    return $result;
  }  

    function new_registers(){
        $new_reg_count = $this->db->query('select * from vwTrader where planStatus=0 and usertype=1 AND paymentTypeChosen >0');
        return $new_reg_count->num_rows();
    }
    function total_sold_count(){
        $sold_count = $this->db->query('select * from vwProductPost where AvailablitiyStatus=1');
        return $sold_count->num_rows();
    }
    function total_booked_count(){
        $booked_count = $this->db->query('select * from vwProductPost where AvailablitiyStatus=2');
        return $booked_count->num_rows();
    }
    function total_cart_count(){
        $query = $this->db->query('select SUM(cartlistCount) as count from cartlist');
        $query =  $query->row();
        return $query->count;// = $this->db->get('cartlist');
    }
    function total_watchlist(){
      $query = $this->db->query('select SUM(watchlistCount) as count from watchlist where traderId !=0');
      $query =  $query->row();
      return $query->count;
     }
     function product_details($product_id) {
         $query = $this->db->query('select p.*,t.*,c.* from vwProductPost p,vwTrader t,category c where p.TraderID=t.traderID and p.CategoryID=c.productCategoryID and p.productID='.$product_id);
        return $query->result();
    }


     function trader_paymentdetails($trader_id) {
        $this->db->select('vwTrader.*,planStatus,paymentTypeChosen,subscriptionplan.planName,subscriptionplan.planAmount,vwTrader.planPostCount,vwTrader.planValidity,traderPostCount as TotalPost');
        $this->db->from('vwTrader');
        $this->db->where('traderID', $trader_id);
        $this->db->join('subscriptionplan', 'subscriptionplan.planID = vwTrader.tplanID');
        $query = $this->db->get();
         //echo $this->db->last_query();
        return $query->result();
    }
    function totalSoldAmount($trader_id){
        $query = $this->db->query("select SUM(Price) as total_sold_amount from vwProductPost  where traderID=$trader_id and AvailablitiyStatus=1");
   /// print_r($query->result()[0]->total_sold_amount);
        return $query->result()[0]->total_sold_amount;
    }
    function totalSold($trader_id){
        $query = $this->db->query("select COUNT(*) as total_sold from vwProductPost  where traderID=$trader_id and AvailablitiyStatus=1");
   /// print_r($query->result()[0]->total_sold_amount);
        return $query->result()[0]->total_sold;
    }
    function totalCart($trader_id){
        $query = $this->db->query("select COUNT(*) as total_cart from cartlist  where userID=$trader_id AND productAvailability=0 ");
   /// print_r($query->result()[0]->total_sold_amount);
        return $query->result()[0]->total_cart;
    }
    function totalWatchlist($trader_id){
        $query = $this->db->query("select COUNT(*) as total_cart from watchlist  where userID=$trader_id ");
   /// print_r($query->result()[0]->total_sold_amount);
        return $query->result()[0]->total_cart;
    }
    function GetBrandModels(){
        $results = array();
        $categories = $this->db->query('select * from category left join category_subtypes on category.`productCategoryID`=category_subtypes.`productCategoryID`')->result_array();
        foreach($categories as $row){
            if(!isset($results[$row['productCategoryID']])){
                $results[$row['productCategoryID']]=array();
                if(!isset($results[$row['productCategoryID']][$row['brandName']])){
                    
                    $results[$row['productCategoryID']][$row['brandName']]['models'][]= $row['modelName'];
                }else    
                    $results[$row['category_nproductCategoryIDame']][$row['brandName']]['models'][]= $row['modelName'];
            }
            else
                if(!isset($results[$row['productCategoryID']][$row['brandName']])){
                   
                    $results[$row['productCategoryID']][$row['brandName']]['models'][]= $row['modelName'];
                }else    
                    $results[$row['productCategoryID']][$row['brandName']]['models'][]= $row['modelName'];
      //  $results[$row['category_name']]['brand']['models'] = $row['modelName'];
           
        }
       
       return $results;
    }
    function multiple_file_update( $images,$updimg_data,$postdetails){
        if (isset( $images['name'] )) {
            foreach ( $images['name'] as $key => $val) {
                if(!empty( $images["name"][$key])){
                    $ext = pathinfo( $images["name"][$key], PATHINFO_EXTENSION);
                $uploadfile =  $images["tmp_name"][$key];
                $folder = "uploads/product_images/";
                $target_file = $folder .time().$key.".".$ext;
              
                if (move_uploaded_file($images["tmp_name"][$key],$target_file)) {
                    $images_array[] = $target_file;
                    $updimg_data['productImage'] = base_url() .$target_file;
                    $updimg_data['productVideo'] = base_url() ;
                    $updimg_data['thumbVideo'] = base_url();
                    $updimg_data['cartType'] = '';
                    $updimg_data['productLive'] = '';
                    $updimg_data['productVideoCount'] = '';
                    $updimg_data['productViewCount'] = '';
                    $updimg_data['productLastAccess'] = '';
                    $updimg_data['productSubmitDate'] =$postdetails['post_date'];
                    if(isset($_POST['productiv_ID'][$key])){
                        $this->db->where('productID', $postdetails['productId']);
                        $this->db->where('productCategoryID',$postdetails['categoryID']);
                        $this->db->where('productiv_ID', $_POST['productiv_ID'][$key]);
                        $this->db->insert('productiv', $updimg_data);
                    }else{
                       
                        $updimg_data['productID'] =$postdetails['productId'];
                        $updimg_data['postID'] =$postdetails['postId'];
                        $updimg_data['productCategoryID'] =$postdetails['categoryID'] ;
                        $updimg_data['traderID'] =$postdetails['traderID'] ;
                        $this->db->insert('productiv', $updimg_data);
                    }
                  
                } else {
                   // echo "error in uploading";
                }
                    
                }                 

                
            }
           
        }
       
    }
    function getEmirates(){
        $query = $this->db->query('select *  from noplate_template  where type=0');
       return $query->result_array();
    }
    function saveSecondImage($product_id,$image,$post_id,$cat,$trader_id){
        $postdata['productID'] = $product_id;
        $postdata['postID'] = $post_id;
        $postdata['productCategoryID'] = $cat;
        $postdata['traderID'] = $trader_id;
        $postdata['productImage'] = $image;
        $postdata['thumbImage'] = '';
        $postdata['productVideo'] = '';
        $postdata['thumbVideo'] = '';
        $postdata['cartType'] = '';
        $postdata['productLive'] = '';
        $postdata['productVideoCount'] = '';
        $postdata['productViewCount'] = '';
        $postdata['productSubmitDate'] =Date('Y-m-d H:m:s');
        $postdata['productLastAccess'] = Date('Y-m-d H:m:s');
        $this->db->insert('productiv', $postdata);
        $last_post_id = $this->db->insert_id();
        return $last_post_id;
    }
     function trader_plancnt2($trader_id) {
        $qry = $this->db->query('select planPostCount from tradersubscriptionplan where traderID=' . $trader_id);
        return $qry->result();
    }
}
