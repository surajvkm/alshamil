<?php 
$slang = 'english';
if($this->session->userdata('site_lang')){
 	
 	$slang =$this->session->userdata('site_lang');
}  
$title_home='';
if($slang=='arabic'){
$title_home=$qry->productTitleAr;
}else{
$title_home= $qry->productTitle;
}
   
$title = strtolower(str_replace(" ",'-',$qry->Name)); ?>
  
<div style="padding-left: 63px;">
                <img src="<?php echo $qry->mainImage ?>" style="width: 172px;height: 118px;">
                <div class="mdl_proddet"><span>Product</span>&nbsp;&nbsp;<b><span><?php echo $title_home ?></span></b></div>
                <div class="mdl_pricedet"><span>Price</span>&nbsp;&nbsp;<b><span><?php $this->View_Model->formataed($qry->price); ?></span></b></div>
                <a target="blank" href="http://twitter.com/share?text=&url=<?php echo base_url()?><?php echo $title ?>/<?php echo $product_id ?>/<?php echo $cat_id ?>"><img src="<?php echo base_url(); ?>img/social-twitter.png" id="mdl_tw" onclick=""></a>
                <a target="blank" href="http://www.facebook.com/sharer.php?u=<?php echo base_url()?>/preview/<?php echo $product_id; ?>/<?php echo $cat_id; ?>/<?php echo $qry->mainImage; ?>"><img src="<?php echo base_url(); ?>img/social-facebook.png" id="mdl_fb" ></a>
                <img id="mdl_snap" src="<?php echo base_url(); ?>img/social-snapchat.png" onclick="snapchat_share()">
                 <!--img id="mdl_inst" src="<?php echo base_url(); ?>img/social-instagram.png"-->

</div>