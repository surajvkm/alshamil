<?php

class Admin_mdl extends CI_Model
{
    function __construct()
  {
    parent::__construct();
    $this->load->database();
    
  }
  function all_posts()
  {
//        $qry=$this->db->query('SELECT post.postID,post.productCategoryID,post.postSubmissionOn,trader.traderID,trader.traderFullName,trader.traderLocation,trader.traderImage,post.productID,
// productcar.productCPrice ,productcar.Cpost_main_img ,concat(productcar.productCBrand,productcar.productCModel) as product_name1,productcar.cartCType, 
//      productbike.productBPrice ,productbike.Bpost_main_img ,concat(productbike.productBBrand,productbike.productBModel) as product_name2,productbike.cartBType ,
//       productboat.productBTPrice ,productboat.BTpost_main_img ,concat(productboat.productBtBrand,productboat.productBtModel) as product_name3,productboat.cartBTType ,
//       productwatch.productWPrice ,productwatch.Wpost_main_img ,concat(productwatch.productWBrand,productwatch.productWModel) as product_name4,productwatch.cartWType ,
//       productvertu.productVPrice ,productvertu.Vpost_main_img ,concat(productvertu.productVBrand,productvertu.productVModel) as product_name5,productvertu.cartVType ,
//       productproperty.productPRPrice ,productproperty.PRpost_main_img ,concat(productproperty.productPropSC,productproperty.productPropType) as product_name6,productproperty.cartPRType ,
//       productphone.productPHPrice ,productphone.PHpost_main_img ,concat(productphone.productPBrand,productphone.productPModel) as product_name7,productphone.cartPHType ,
//     productnp.productNPPrice ,productnp.NPpost_main_img,concat(productnp.productNPCode,productnp.productNPNmbr) as product_name8,productnp.productNPDigits,productnp.cartNPType ,
//       productmn.productMNPrice ,productmn.MNpost_main_img ,productmn.productOperator,productmn.productMNDigits,productmn.productMNNmbr as product_name9,productmn.cartMNType  FROM `post`
//         left JOIN `trader` ON `post`.`traderID`=`trader`.`traderID`
       
//         left join productcar on (post.productCategoryID=productcar.productCategoryID and post.productID=productcar.productID)
//         left join productbike on (post.productCategoryID=productbike.productCategoryID and post.productID=productbike.productID)
//         left join productboat on (post.productCategoryID=productboat.productCategoryID and post.productID=productboat.productID)
//         left join productmn on (post.productCategoryID=productmn.productCategoryID and post.productID=productmn.productID)
//         left join productnp on (post.productCategoryID=productnp.productCategoryID and post.productID=productnp.productID)
//         left join productphone on (post.productCategoryID=productphone.productCategoryID and post.productID=productphone.productID)
//         left join productproperty on (post.productCategoryID=productproperty.productCategoryID and post.productID=productproperty.productID)
//         left join productvertu on (post.productCategoryID=productvertu.productCategoryID and  post.productID=productvertu.productID)
//         left join productwatch on (post.productCategoryID=productwatch.productCategoryID and post.productID=productwatch.productID) order by post.postSubmissionOn DESC limit 
//         8');
    $qry = $this->db->query('select p.*,t.*,c.* from vwProductPost p,vwTrader t,category c where p.TraderID=t.traderID and p.CategoryID=c.productCategoryID');
        return $qry->result(); 
  }
  function fetch_new_post()
  {
        $this->db->select('vwProductPost.postID,vwProductPost.Image,vwProductPost.Price,DATE_FORMAT(vwProductPost.SubmitDate,"%d %b %Y") as publishedOn,trader.traderFullName,trader.traderImage,trader.traderLocation,vwProductPost.Brand,vwProductPost.Model,,vwProductPost.CallPrice');
        $this->db->from('vwProductPost');
        $this->db->join('trader','vwProductPost.traderID=trader.traderID');
        $this->db->where('vwProductPost.postAdminStatus=','0');
        $this->db->order_by("postID", "desc");
        //echo $this->db->get_compiled_select();
        $qry=$this->db->get();
        return $qry->result();
  }
  function mdl_approve_post($post_id)
  {
      $data = array();
      $data['postStatus'] = 1;
      $where = array('postID' => $post_id);
      $this->db->where($where);
     $this->db->update('post',$data);
      
  }
  function mdl_reject_post($post_id,$message='')
  {
      $data = array();
      $data['postStatus'] = -1;
      $data['rejectMsg'] = $message;
      $this->db->where('postID',$post_id);
      $this->db->update('post',$data);
  }
  function yearlywise_regs()
  {
      //  $this->db->select('*,count(*) as total');
        $where = array('tradersubscriptionplan.planID' => 1, 'planStatus' => 0,'trader.usertype'=>1,'tradersubscriptionplan.paymentTypeChosen >'=>0);
        $this->db->where($where);
        $this->db->join('trader',"trader.traderID=tradersubscriptionplan.traderID");
        $yearly_qry = $this->db->get('tradersubscriptionplan');
       // var_dump($yearly_qry->result());
       // exit;
        return $yearly_qry->result();
  }
  function monthlywise_regs()
  {
        //$this->db->select('*,count(*) as total');
        $where = array('tradersubscriptionplan.planID' => 2, 'planStatus' => 0,'trader.usertype'=>1,'tradersubscriptionplan.paymentTypeChosen >'=>0);
        $this->db->where($where);
        $this->db->join('trader',"trader.traderID=tradersubscriptionplan.traderID");
        $monthly_qry = $this->db->get('tradersubscriptionplan');
        return $monthly_qry->result();
  }
  function yearlylim_regs()
  {
        //$this->db->select('*,count(*) as total');
      $where = array('tradersubscriptionplan.planID' => 3, 'planStatus' => 0,'trader.usertype'=>1,'tradersubscriptionplan.paymentTypeChosen >'=>0);
      $this->db->where($where);
      $this->db->join('trader',"trader.traderID=tradersubscriptionplan.traderID");
        $yearlylim_qry = $this->db->get('tradersubscriptionplan');
        return $yearlylim_qry->result();
  }
  function indiv_regs()
  {
       // $this->db->select('*,count(*) as total');
        $where = array('tradersubscriptionplan.planID' => 4, 'planStatus' => 0,'trader.usertype'=>1,'tradersubscriptionplan.paymentTypeChosen >'=>0);
        $this->db->where($where);
        $this->db->join('trader',"trader.traderID=tradersubscriptionplan.traderID");
        $indiv_qry = $this->db->get('tradersubscriptionplan');
        return $indiv_qry->result();
  }

  function fetch_planusers($planid)
  {    
    $query = $this->db->query("select 
    v.*,v.traderPostCount as TotalPost, count(p.postID) as traderPostCount, count(vpp.postID) as traderSoldCount from (select * from vwTrader  where usertype=1 and tplanID =".$planid." and planStatus=1) v
    left JOIN post p
    on v.traderID=p.traderID 
    left JOIN vwProductPost vpp
    on vpp.postID = p.postID and vpp.AvailablitiyStatus=1 
    group by traderID");
   /*  $query = $this->db->query("select 
v.*, count(p.postID) as traderPostCount, count(vpp.postID) as traderSoldCount
 from
(select * from vwTrader  where usertype=1) v
left JOIN post p
on v.traderID=p.traderID and v.usertype=1
left JOIN vwProductPost vpp
on vpp.postID = p.postID and vpp.AvailablitiyStatus=1 and tplanID =".$planid."
group by traderID");*/
      return $query->result();
     
  }




/****todo remove down*/

  function fetch_yearlywise()
  {
    
    
       $this->db->where(array('usertype'=>1,'tplanID'=>1));
        $qry = $this->db->get('vwTrader');
        return $qry->result();
  }
  function fetch_monthlywise()
  {
      // $this->db->where('tplanID',2);
      $this->db->where(array('usertype'=>1,'tplanID'=>2));
        $qry = $this->db->get('vwTrader');
        return $qry->result();
  }
  function fetch_yrlylim()
  {
        //$this->db->where('tplanID',3);
        $this->db->where(array('usertype'=>1,'tplanID'=>3));
        $qry = $this->db->get('vwTrader');
        return $qry->result(); 
  }
  function fetch_indivi()
  {
        //$this->db->where('tplanID',4);
        $this->db->where(array('usertype'=>1,'tplanID'=>4));
        $qry = $this->db->get('vwTrader');
        return $qry->result();
  }
  
  function fetch_watchlist()
  {
     /* $this->db->select('productId,count(*) as wcnt');
        $this->db->from('watchlist');
        $this->db->group_by('productID');
        $qry1 = $this->db->get();
        $records = $qry1->result();
      */  
      $this->db->distinct();
       $this->db->select('count(watchlistCount) as wcnt,watchlistID,vwProductPost.postID,vwProductPost.traderID as traderID,`vwProductPost`.`productID` as productId,vwProductPost.Image as productImage,concat(vwProductPost.Brand," ",vwProductPost.Model) as productName,vwProductPost.Price as productPrice,vwProductPost.productViewCount');
        $this->db->from('watchlist');
        $this->db->group_by('watchlist.postID'); 
        $this->db->order_by('watchlist.postID', 'desc'); 
        $this->db->join('vwProductPost','watchlist.postID=vwProductPost.postID');
        $qry=$this->db->get();

        $myqry = $qry->result();
          return array(
            'qry' => $myqry,
             );
             
        
  }
  function fetch_trader_det($trader_id,$postID)
  {
      $this->db->select('(SELECT count("watchlist.watchlistID") from watchlist where watchlist.postID = '.$postID.'  ) as wcnt,,concat(vwProductPost.Brand,,vwProductPost.Model)  as productName,vwProductPost.Price as productPrice,vwProductPost.Image as productImage,trader.traderFullName,trader.traderLocation,trader.traderImage');
        $this->db->from('trader');
        $this->db->join('vwProductPost','trader.traderID=vwProductPost.TraderID');
        $this->db->where('vwProductPost.postID',$postID);
      
        $qry=$this->db->get();
   
        return $qry->result();
  }
  function watchlist_trader($postID)
  {
      $this->db->select('watchlist.userID,trader.traderImage,trader.traderFullName,trader.traderLocation,vwProductPost.SubmitDate as productSubmitDate');
        $this->db->from('watchlist');
        $this->db->join('trader','trader.traderID=watchlist.userID');
        $this->db->join('vwProductPost','vwProductPost.postID=watchlist.postID');
        $this->db->where('watchlist.postID',$postID);
        $tr_qry=$this->db->get();
        return $tr_qry->result();
  }
  function fetch_flagedlist()
  {
    $this->db->select('trader.traderFullName as FlaggedUser,trader.traderImage as falgUserImage,flaggeditems.productId,flaggeditems.postID,flaggeditems.flagUserID,flaggeditems.flagDate,vwProductPost.*,flaggeditems.flagDesc,vwTrader.*,flaggedID,vwProductPost.SubmitDate');
    $this->db->from('flaggeditems');
    $this->db->join('vwProductPost','flaggeditems.postID=vwProductPost.postID');
    $this->db->join('vwTrader','vwProductPost.traderID=vwTrader.traderID');
    $this->db->join('trader','flaggeditems.flagUserID=trader.traderID');
    $this->db->group_by("flaggeditems.flaggedID");
    //$this->db->join('trader','flaggeditems.flagUserID=trader.traderID');
    //echo $this->db->get_compiled_select();
        /*$this->db->select('vwTrader.traderFullName as FlaggedUser,vwTrader.traderImage as falgUserImage,trader.traderLocation,trader.traderImage,trader.traderFullName as traderFullName,vwTrader.traderImage as falgUserImage,flaggeditems.productId,flaggeditems.postID,flaggeditems.flagUserID,flaggeditems.flagDate,vwProductPost.*,flaggeditems.flagDesc,flaggedID,vwProductPost.SubmitDate');
    $this->db->from('flaggeditems');
    $this->db->join('vwProductPost','flaggeditems.postID=vwProductPost.postID');
    $this->db->join('vwTrader','vwProductPost.traderID=flaggeditems.flagUserID');
    $this->db->join('trader','vwProductPost.traderID=trader.traderID');
    $this->db->group_by("flaggeditems.flaggedID");*/
    $qry=$this->db->get();

    $data = [];
    foreach ($qry->result() as $key => $value) {
      # code...
    // $this->db->select('flaggeditems.flagUserID,trader.traderFullName as FlaggedUser,flaggeditems.flagDate,trader.traderImage as falgUserImage');
    // $this->db->from('flaggeditems');
    // $this->db->join('trader','flaggeditems.flagUserID=trader.traderID');
    // $this->db->where('flaggeditems.flagUserID',$value->flagUserID);
    // $query=$this->db->get();
    // $result = $query->result()[0];
        //  echo "<pre>";
        // print_r($value);
        // echo "</pre>";
        //      echo "---------------------<pre>";
        // print_r($result);
        // echo "</pre>";die();
     $data[] = array('product'=>$value->Brand.' - '.$value->Model,'price'=>$value->Price,'callPrice'=>$value->CallPrice,'traderName'=>$value->traderFullName,'traderLocation'=>$value->traderLocation,'flagUserName'=>$value->FlaggedUser,'falgedDate'=>date("d-m-Y", strtotime($value->flagDate)),'desc'=>$value->flagDesc,'flagID'=>$value->flaggedID,'postDate'=>date("d-m-Y", strtotime($value->SubmitDate)),'traderImage'=>$value->traderImage,'falgUserImage'=>$value->falgUserImage,'productImage'=>$value->Image);

    

    }
 
    return $data;
  }
  function post_cnt()
    {
       
         $this->db->select('count(*) as totalPostCount');
        // $this->db->where('postStatus=0');
        $tot_post_cnt = $this->db->get('post');
       return $tot_post_cnt->result();
        /*$this->db->select('sum(traderPostCount) as traderPostCount');
        $post_qry = $this->db->get('trader');
       return $post_qry->result();*/
    }
    function sold_item_cnt()
    {
       
        $this->db->select('sum(traderSoldCount) as traderSoldCount');
        $sold_qry = $this->db->get('trader');
       return $sold_qry->result();
    }
    function wish_item_cnt()
    {
       
        $this->db->select('sum(traderWatchCount) as traderWatchCount');
        $wish_qry = $this->db->get('trader');
       return $wish_qry->result();
    }
    function cart_cnt()
    {
     $this->db->select('sum(cartlistCount) as cartlistCount');
        $cart_qry = $this->db->get('cartlist');
       return $cart_qry->result();
    }
     public function update_status($traderID) {
        $this->db->set('traderStatus', '2');
        $this->db->where('traderID', $traderID);
        if ($this->db->update('trader')) {
            return true;
        } else {
            return false;
        }
    }
    function mdl_trader_details($trader_id)
    {
        /* $this->db->where('traderID',$trader_id);
        $trader_qry = $this->db->get('trader');
       return $trader_qry->result();
       */
      //$this->db->select('*');
      //$this->db->from('trader');
     // $this->db->join('tradersubscriptionplan','trader.traderID=tradersubscriptionplan.traderID','left');
      $this->db->where('vwTrader.traderID',$trader_id);
      $tr_qry=$this->db->get('vwTrader');
      return $tr_qry->row();
     
    }
     function mdl_freeze_trader($trader_id)
    {
        $data['isActive'] = -1;
        $this->db->where('traderID',$trader_id);
        $this->db->update('trader',$data);
        
    }
    function mdl_approve_trader($trader_id,$plan_id)
    {
      
      switch ($plan_id) {
        case 1:
        $data["planPostCount"]=-1;
        $data["planValidity"]=date('Y-m-d', strtotime("+365 days"));
            break;
        case 2:
        $data["planPostCount"]=-1;
        $data["planValidity"]=date('Y-m-d', strtotime("+30 days"));
            break;
        case 3:
        $this->db->set('planPostCount', 'planPostCount+30', FALSE);
        $data["planValidity"]=date('Y-m-d', strtotime("+365 days"));
            break;
        default:
        $this->db->set('planPostCount', 'planPostCount+1', FALSE);
       // $data["planPostCount"]="planPostCount+1";
              
    }
        $data['planStatus'] = 1;
        $this->db->where('traderID',$trader_id);
        return $this->db->update('tradersubscriptionplan',$data)?1:0;
        
    }
    function mdl_reject_trader($trader_id)
    {
        $data['planStatus'] = -1;
        $this->db->where('traderID',$trader_id);
        $this->db->update('tradersubscriptionplan',$data);
    }
     function all_plan(){
      $query = $this->db->query("select SUM(planAmount) as plan,Count(*) as count, 
                  DATE(traderRegistrationDate) AS date from vwTrader where tplanID in(1,2,3,4) GROUP  BY DAY(traderRegistrationDate) order by traderRegistrationDate  asc");
      $result = $query->result();
      return $result;
     }
     function yearly_plan_year(){
        $query = $this->db->query("select SUM(planAmount) as plan, 
                  DATE(traderRegistrationDate) AS date from vwTrader where  usertype=1 and tplanID=1 GROUP  BY DAY(traderRegistrationDate) order by traderRegistrationDate  asc");
         $result = $query->result();
         return $result;
     }
     function monthly_plan_year(){
        $query = $this->db->query("select SUM(planAmount) as plan, 
                  DATE(traderRegistrationDate) as date from vwTrader where usertype=1 and tplanID=2 GROUP  BY DAY(traderRegistrationDate) order by traderRegistrationDate  asc");
         $result = $query->result();
         return $result;
     }
     function yearly_limit_year(){
        $query = $this->db->query("select SUM(planAmount) as plan, 
                  DATE(traderRegistrationDate) as date from vwTrader where usertype=1 and tplanID=3 GROUP  BY DAY(traderRegistrationDate) order by traderRegistrationDate  asc");
         $result = $query->result();
         return $result;
     }
     function inidiv_limit_year(){
        $query = $this->db->query("select SUM(planAmount) as plan, 
                  DATE(traderRegistrationDate) as date from vwTrader where usertype=1 and tplanID=4 GROUP  BY DAY(traderRegistrationDate) order by traderRegistrationDate  asc");
         $result = $query->result();
         return $result;
     }
    function trader_all_posts($traderid)
    {
         $qry=$this->db->query('SELECT post.postID,post.productCategoryID,post.postSubmissionOn,trader.traderID,trader.traderFullName,trader.traderLocation,trader.traderImage,post.productID,
  productcar.productCPrice ,productcar.Cpost_main_img ,concat(productcar.productCBrand,productcar.productCModel) as product_name1,productcar.cartCType, 
       productbike.productBPrice ,productbike.Bpost_main_img ,concat(productbike.productBBrand,productbike.productBModel) as product_name2,productbike.cartBType ,
        productboat.productBTPrice ,productboat.BTpost_main_img ,concat(productboat.productBtBrand,productboat.productBtModel) as product_name3,productboat.cartBTType ,
        productwatch.productWPrice ,productwatch.Wpost_main_img ,concat(productwatch.productWBrand,productwatch.productWModel) as product_name4,productwatch.cartWType ,
        productvertu.productVPrice ,productvertu.Vpost_main_img ,concat(productvertu.productVBrand,productvertu.productVModel) as product_name5,productvertu.cartVType ,
        productproperty.productPRPrice ,productproperty.PRpost_main_img ,concat(productproperty.productPropSC,productproperty.productPropType) as product_name6,productproperty.cartPRType ,
        productphone.productPHPrice ,productphone.PHpost_main_img ,concat(productphone.productPBrand,productphone.productPModel) as product_name7,productphone.cartPHType ,
      productnp.productNPPrice ,productnp.NPpost_main_img,concat(productnp.productNPCode,productnp.productNPNmbr) as product_name8,productnp.productNPDigits,productnp.cartNPType ,
        productmn.productMNPrice ,productmn.MNpost_main_img ,productmn.productOperator,productmn.productMNDigits,productmn.productMNNmbr as product_name9,productmn.cartMNType  FROM `post`
          left JOIN `trader` ON `post`.`traderID`='.$traderid.'
         
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
    function mdl_trader_alldetails($trader_id)
    {
        $this->db->where('traderID',$trader_id);
        $trader_qry = $this->db->get('vwTrader');
       return $trader_qry->row();
    }
    function new_posts(){
      $newPost = $this->db->query('select * from vwProductPost JOIN `trader` ON `vwProductPost`.`traderID`=`trader`.`traderID` where PostAdminStatus=0 ');
      return $newPost->num_rows();
     }
     function save_transaction_details($transaction_ref,$user_id,$orderid=NULL){
      // echo '<br>'.$orderid;
       if(!$orderid){
       
        $this->db->where('traderID', $user_id);
        $data  = array('paymentProof' => $transaction_ref,'paymentTypeChosen' => 1);
        $this->db->update('tradersubscriptionplan', $data);
       }else{
        
        $this->db->where('orderID', $orderid);
        $data  = array('paymentProof' => $transaction_ref,'status' => 1);
        if($this->db->update('order_items', $data)){
        
           $result_set = $this->db->select('cartlist.postID,productAvailability')->get_where('cartlist', array('cartlist.orderID' => $orderid), NULL, NULL)->result_array();
           $post_arr = [];
          foreach($result_set as $key=>$row){
              $post_arr[$key]['postID']=$row['postID'];
                $post_arr[$key]['productAvailability']='2';
          }

  $this->db->update_batch('cartlist',$post_arr, 'postID'); 
       
           foreach($result_set as $result){
              // array_push($post_arr,$result->postID);
               $this->db->query("select ChangePostStatus({$result['postID']},2)");
           }          
         
      
         // $this->db->query("select ChangePostStatus(76,2)");
        }
       }
       return 1;
     }
     function listAllProducts($category,$keyword){
      if($category=='all' && $keyword==''){
        $allCategory = $this->db->query('select p.*,t.*,c.* from vwProductPost p,vwTrader t,category c where p.TraderID=t.traderID and p.CategoryID=c.productCategoryID limit 0,16');
      }else if(!empty($keyword) && $category=='all'){
        $allCategory = $this->db->query('select p.*,t.*,c.* from vwProductPost p,vwTrader t,category c where p.TraderID=t.traderID and p.CategoryID=c.productCategoryID and c.category_name LIKE %"'.$keyword.'"% or p.Brand LIKE %"'.$keyword.'"% or p.Model LIKE%"'.$keyword.'"%  limit 0,16');
      }else if(!empty($keyword) && $category!='all'){
        $allCategory = $this->db->query("select p.*,t.*,c.* from vwProductPost p,vwTrader t,category c where p.TraderID=t.traderID and p.CategoryID=c.productCategoryID and c.category_name LIKE '%".$keyword."%' or p.Brand LIKE '%".$keyword."%' or p.Model LIKE '%".$keyword."%' and c.category_name='".$category."' limit 0,16");
      }else{
        $allCategory = $this->db->query('select p.*,t.*,c.* from vwProductPost p,vwTrader t,category c where p.TraderID=t.traderID and p.CategoryID=c.productCategoryID and c.category_name="'.$category.'" limit 0,16');
      }
      
      return $allCategory->num_rows();
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
           // echo $this->db->get_compiled_select();
       
        return ($query->num_rows() > 0)?$query->result_array():FALSE;
     }
     
     function totalSoldCount($type){
      

      // $this->db->select(' Count(*) as soldCount,order_items.orderID,order_items.orderAmount,
      //             DATE(orderDate) AS date');
      // $this->db->from('vwProductPost');
      // $this->db->join('cartlist', 'vwProductPost.postID = cartlist.postID');
      // $this->db->join('order_items', 'order_items.orderID = cartlist.orderID');
      // $this->db->where('order_items.status',1);
      // $this->db->group_by("Month(orderDate)"); 

       if($type=='alshamil'){
        //$this->db->where('vwProductPost',1);
        $query = $this->db->query("select Count(*) as soldCount, o.orderID,o.orderAmount,
                   DATE(orderDate) AS date from vwProductPost p, order_items o,cartlist c where p.postID=c.postID and c.orderID=o.orderID and o.status=1 and p.IsAlshamilProduct=1 GROUP BY Day(orderDate) order by orderDate");
      }else if($type=='trader'){
        //$this->db->where('vwProductPost.IsAlshamilProduct',0);
        $query = $this->db->query("select Count(*) as soldCount, o.orderID,o.orderAmount,
                   DATE(orderDate) AS date from vwProductPost p, order_items o,cartlist c where p.postID=c.postID and c.orderID=o.orderID and o.status=1 and p.IsAlshamilProduct=0 GROUP BY Day(orderDate) order by orderDate");
      }else{
        $query = $this->db->query("select Count(*) as soldCount, o.orderID,o.orderAmount,
                   DATE(orderDate) AS date from vwProductPost p, order_items o,cartlist c where p.postID=c.postID and c.orderID=o.orderID and o.status=1 GROUP BY Day(orderDate) order by orderDate");
      }
       
         $result = $query->result();
       
         return $result;
     }
      function getAvr($id){
        $this->db->select('traderImage');
        $this->db->from('trader');
        $this->db->where('traderID', $id);
        $query = $this->db->get();
        $result = $query->row();
        return $result->traderImage; 
    }
     function get_brand_car($category) {
        $query = $this->db->query('select  distinct brandID,brandName from category_subtypes where productCategoryID = ' . $category);
        
        return $query->result();
    }
    function discardFlagged($flagId){
      $this->db->delete('flaggeditems', array('flaggedID' => $flagId));
      return "success";
    }
    function save_notifications($user_id=NULL,$message,$planid=NULL) {
        $devids=[];
     
      if(isset($planid)){
   
        //get all user on that plan
        $this->db->select("traderID,deviceId");
        $this->db->where('tplanID',$planid);
         $users=$this->db->get('vwTrader')->result_array();
     
      }else{
    
        $this->db->select("traderID,deviceId");
        $this->db->where('traderID',$user_id['traderID']);
         $users=$this->db->get('vwTrader')->result_array();
      }
  
      foreach( $users as $user){
        
             $data[] = array('traderID'=>$user['traderID'],'notificationMessage' => $message, 'readStatus' => 0, 'notificationBy' => $_SESSION['logged_in']['trader_id']);
             if ($user['deviceId']!='')$devids[] = $user['deviceId'];
            }
      
            return $this->db->insert_batch('tradernotifications', $data)?$devids:0;
    }

    public function sendpush($registrationIds=array(),$msg ){
   
        $deviceIds = implode (",", $registrationIds);
      
        #API access key from Google API's Console
        define( 'API_ACCESS_KEY', 'AAAAt1-_IHo:APA91bEN-Moq4Y-SFNRGW3CTgjXl8c8ZbDCbkd5XWpPhwh3TmbIWqTyV583wIXEc-m9ZB-tY3ow28QZfMZ8Oc-fRTjftcL9_zXJzA_oTNlG7KhYzDDNzpkNrgTaYtCIaPSwcs34jTTh9' );
        //$registrationIds = $_GET['id'];
        $registrationIds = 'fKOLhxS9coQ:APA91bE13tHl61mVUwoMxT4Obt6L5N4bMCw2VvfPIOWE7JzZH1JAQ0TAWIO9R-lonBm17AVlA7X8GhyxaWyS3qhEkDeUczZE-fP_h2x8TKLvB4c0T5xyNdqpSlIiDaR86DpOn4YWq00V';
    
        $msg = array
            (
            'body' 	=> $msg,
            'title'	=> 'Alshamil Online',
                    'icon'	=> 'myicon',/*Default Icon*/
                    'sound' => 'mySound'/*Default sound*/
            );
        $fields = array
                (
                    'to'		=> $deviceIds,
                    'notification'	=> $msg
                );
        
        
        $headers = array
                (
                    'Authorization: key=' . API_ACCESS_KEY,
                    'Content-Type: application/json'
                );
    #Send Reponse To FireBase Server	
            $ch = curl_init();
            curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
            curl_setopt( $ch,CURLOPT_POST, true );
            curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
            curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
            curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
            $result = curl_exec($ch );
            curl_close( $ch );
    #Echo Result Of FireBase Server
    //echo $result;
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
  function get_subproperties($category_id)
  {
      $sub_prop_qry = $this->db->query('select distinct brandID,brandName from category_subtypes where productCategoryID='.$category_id);
      return $sub_prop_qry->result();
  }
  function getPostByStatus($plan,$status,$trader,$type){
     $where = array('vwTrader.tplanID' => $plan, 'vwProductPost.PostAdminStatus' => $status,'vwProductPost.TraderID'=>$trader);
        
         $this->db->select('*');
      $this->db->from('vwProductPost');
      $this->db->join('vwTrader', 'vwProductPost.TraderID = vwTrader.traderID');
      $this->db->where($where);
      //$this->db->join('category', 'vwProductPost.CategoryID = category.productCategoryID');
      //$this->db->join('watchlist', 'watchlist.postID = vwProductPost.postID');
      //  $yearly_qry =$this->db->get('tradersubscriptionplan');
        $query =  $this->db->get();
        if($type=='all'){
          return ($query->num_rows() > 0)?$query->result_array():FALSE;
        }else{
          return ($query->num_rows() > 0)?$query->num_rows():0;
        }
        

        //return $yearly_qry->result();
  }
  function get_trader_details($traderid){
    return $this->db->get_where('vwTrader',array('vwTrader.traderID' => $traderid),1)->result()[0];
       
  }
  function total_sold_prodcut(){
        $sold_count = $this->db->query('select * from vwProductPost where AvailablitiyStatus=1 order by SubmitDate DESC');
        return $sold_count->result_array();
    }
    function total_booked_prodcut(){
        $booked_count = $this->db->query('select * from vwProductPost where AvailablitiyStatus=2 order by SubmitDate DESC');
        return $booked_count->result_array();
    }
    function removeSoldItem($postId){
       $return = $this->db->query("select ChangePostStatus({$postId},-1)");
        if ( $return) {
            return true;
        } else {
            return false;
        }
    }

        function get_traderlist($txtemail, $txtpassword, $txtusertype, $deviceId=NULL) {
        $md_password = md5($txtpassword);
       $this->db->select('*');
        $this->db->from('trader');
       $where=array('traderEmailID'=>$txtemail,'traderPasswd'=>$md_password,'userType'=>$txtusertype);
        $this->db->where($where);
      
        $this->db->limit(1);
        //echo $this->db->get_compiled_select();
        $query = $this->db->get();
       if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    function flaggedCount(){
      $this->db->select('Count(*) as count');
      $query = $this->db->get('flaggeditems');
      $result = $query->result();
      //print_r($result[0]->count);
      return $result[0]->count;

    }
    function checkPostCount($postId,$traderId){
    


      $this->db->select('planPostCount');
      $this->db->where('traderID',$traderId);
      $query = $this->db->get('tradersubscriptionplan');

      $count = $query->result();
      if( $count!=-1){
        $count = $count+1;
      }
      $data = array();
      $data['planPostCount'] =  $count;
      $this->db->where('traderID',$traderId);
      $this->db->update('tradersubscriptionplan',$data);

    }
     function get_templatesByType($type=0) {
        $template_qry = $this->db->query('select * from noplate_template where type='.$type);
        return $template_qry->result();
    }
    function get_template_imgs($emirates,$type) {

        $this->db->select('templates,long_template');
        $this->db->from('noplate_template');
        $this->db->where('noplateTempID', $emirates);
        $this->db->where('type', $type);
        $temp_img_qry = $this->db->get();
        return $temp_img_qry->result();
    }

    function saveSecondImage($product_id,$image,$post_id,$cat){
        $trader_id = $_SESSION['logged_in']['trader_id'];
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



}
?>