<?php

$slang = 'english';
if($this->session->userdata('site_lang')){
 	
 	$slang =$this->session->userdata('site_lang');
}

?>


<?php 
$cat_qry = $this->View_Model->get_parent_category(); 
?>
<form method="post" action="<?php echo base_url() ?>Trader/search">
    <div class="widget col-md-12">
        <h5 class="adsrchtitle"><br><span><i id="filter-load" style="display: none"  class="fa fa-cog fa-spin fa-x fa-fw"></i></span><span>Advanced Search</span></h5>
        <select class="form-control form-font" name="category" id="srchcat1">
            <option class="hidden" value=''>Select Category</option>
            <?php
            if($cat_qry->num_rows()>0){  $title_home='';
				
			
            foreach ($cat_qry->result() as $r) {
            	
            		if($slang=='arabic'){
									$title_home=$r->NameAr;
								}else{
									$title_home= $r->Name;
						   }
                           $search_title = ucwords(str_replace("-",' ',$title_home));
            	
                ?>
                <option value="<?php echo $r->CategoryId ?>"><?php echo $search_title ?></option>
                <?php
            }
            
            }
            ?>
        </select>
        <br>
        <select class="form-control form-font" name="brand" id="srchcat2">
            <option value="">Select Brand</option>
        </select>
        <br>
        <select class="form-control form-font" name="model" id="srchcat3">
            <option value="">Select Model</option>
        </select>
        <br>
        <select class="form-control form-font" name="from" id="srchcat4">
            <option value="">From Year</option>
           <?php
            for ($i = 1970; $i <= date('Y'); $i++) {
                ?>
                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                <?php
            }
            ?>


        </select>

        <br>
        <select class="form-control form-font" name="to" id="srchcat5">
            <option value="">To Year</option>
            <?php
                for ($i = date('Y'); $i >= 1970; $i--) {
                ?>
                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                <?php
            }
            ?>


        </select>
        <button type="button" class="mainsrchbtn" id="btnsrchpost">SEARCH</button>
    </div><!-- end widget -->
</form>
<script>
    $(document).ready(function ()
    {

        $('#srchcat1').change(function () {
            $('#filter-load').fadeIn();
            var category = $("#srchcat1").val();
            if ((category != 1) & (category != 2))
            {
                $('#srchcat4').css('display', 'none');
                $('#srchcat5').css('display', 'none');
            } else
            {
                $('#srchcat2').css('display', 'block');
                $('#srchcat3').css('display', 'block');
                $('#srchcat4').css('display', 'block');
                $('#srchcat5').css('display', 'block');
            }   
                var data = 'cat=' + category;

                if (category == 3) {
                    var url = '<?php echo base_url('Trader/getEmirates'); ?>';
                    $('#srchcat2').empty();
                    var opt = $('<option />');
                    opt.val('');
                    opt.text('Select an Emirate');
                    $('#srchcat2').append(opt);
                    
                    $('#srchcat3').empty();
                    var opt = $('<option />');
                    opt.val('');
                    opt.text('Select a Code');
                    $('#srchcat3').append(opt);
                    }
                else if(category == 6) {
                    $('#srchcat2').empty();
                    var url = '<?php echo base_url('Trader/getBrands'); ?>';
                    var opt = $('<option />');
                    opt.val('');
                    opt.text('Select an Operator');
                    $('#srchcat2').append(opt);
                    
                    $('#srchcat3').empty();
                    var opt = $('<option />');
                    opt.val('');
                    opt.text('Select Prefix');
                    $('#srchcat3').append(opt);
                } 
                 else if(category == 9) {
                    $('#srchcat2').empty();
                    var url = '<?php echo base_url('Trader/getBrands'); ?>';
                    var opt = $('<option />');
                    opt.val('');
                    opt.text('Select an Item');
                    $('#srchcat2').append(opt);
                    
                    $('#srchcat3').empty();
                    var opt = $('<option />');
                    opt.val('');
                    opt.text('Select Subcategory');
                    $('#srchcat3').append(opt);
                }else {
                    $('#srchcat2').empty();
                    $('#srchcat3').empty();
                    var url = '<?php echo base_url('Trader/getBrands'); ?>';
                    var opt = $('<option />');
                    opt.val('');
                    opt.text('Select a Brand');
                    $('#srchcat2').append(opt);
                    
                    var opt = $('<option />');
                    opt.val('');
                    opt.text('Select a Model');
                    $('#srchcat3').append(opt);
                }

                if (category != "") {
                    $.ajax({
                        type: "POST",
                        dataType: 'json',
                        data: data,
                        url: url,
                        success: function (data) {
                            $('#filter-load').fadeOut();
                         
                            $.each(data, function (id, city)
                            {
                                var opt = $('<option />'); // here we're creating a new select option for each group
                                opt.val(city);
                                opt.text(city);
                                $('#srchcat2').append(opt);
                            });

                        }

                    });
                }
        });
        $('#srchcat2').change(function () {
            $('#filter-load').fadeIn();
            var category = $("#srchcat1").val();
            var brand = $("#srchcat2").val();
            var data = 'brand=' + brand;

            if (category == 3) {
                $('#srchcat3').empty();
                var opt = $('<option />');
                opt.val('');
                opt.text('Select a Code');
                $('#srchcat3').append(opt);
                var url = '<?php echo base_url('Trader/getEmirateCode'); ?>';
            }
            else if(category == 6) {
                $('#srchcat3').empty();
                var opt = $('<option />');
                opt.val('');
                opt.text('Select Prefix');
                $('#srchcat3').append(opt);
                var url = "<?php echo base_url('Trader/fetch_model'); ?>";
            }
            else {
                $('#srchcat3').empty();
                var opt = $('<option />');
                opt.val('');
                opt.text('Select a Model');
                $('#srchcat3').append(opt);
                var url = "<?php echo base_url('Trader/fetch_model'); ?>";
            }

            if (brand != "") {
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    data: data,
                    url: url,
                   
                    success: function (data) { 
                        $('#filter-load').fadeOut();
                        $.each(data, function (id, city)
                        {
                            var opt = $('<option />'); 
                            opt.val(city);
                            opt.text(city);
                            $('#srchcat3').append(opt);
                        });
                    }
                   
                });
            }
        });
        $('#btnsrchpost').click(function () {
         $('.temp-hide').hide();
        $('#category_title_div').hide();
        var html = '<div class="row">'+
                    '<div class="col-sm-8" style="text-align: -webkit-center"><i class="fa fa-cog fa-spin fa-2x fa-fw"></i> Please Wait..'+
                    '</div></div>';
        $('#imgpost_div').html(html);
           var category     = $("#srchcat1").val();
           var brand        = $("#srchcat2").val();
           var model        = $("#srchcat3").val();
           var from_date    = $("#srchcat4").val();
           var to_date      = $("#srchcat5").val();
           
           var data         = 'categoryId='+category+'&brand='+brand+'&model='+model+'&from_date='+from_date+'&to_date='+to_date;
        
            $.ajax({
                    type: "GET",
                    dataType: 'json',
                    data: data,
                    async: true,
                    url: "<?php echo base_url()?>"+"TraderController/getbycat",
                    success: function (data) {
                        var count = data.data.posts.length;
                        var html = '<div class=""><div class="col-sm-12" style="padding:20px"><h3>" Total '+count+' " results found.</h3></div><br>';
                       $.each(data.data.posts, function (i, item) {
                          if(item.CategoryID == 1) {var page = 'car_category_details';}
                          if(item.CategoryID == 2) {var page = 'bike_category_details';}
                          if(item.CategoryID == 3) {var page = 'show_noplate_details';}
                          if(item.CategoryID == 4) {var page = 'show_vertu_details';}
                          if(item.CategoryID == 5) {var page = 'show_watch_details';}
                          if(item.CategoryID == 6) {var page = 'show_mobileno_details';}
                          if(item.CategoryID == 7) {var page = 'boat_category_details';}
                          if(item.CategoryID == 8) {var page = 'show_iphone_details';}
                          if(item.CategoryID == 9) {var page = 'property_category_details';}
                          var sub = '<div class="col-sm-4 catpostimgs">'+
                                    '<a href="<?php echo base_url()?>Trader/'+page+'/'+item.ProductID+'/'+item.CategoryID+'"> <img src="'+item.Image+'" class="post_imgs"></a>'+
                                    '<div class="tradet_details res-search">'+
                                    '<span class="wlprdpr">Product</span>&nbsp;&nbsp;<b><span class="prdt_price_details">'+item.Brand+' '+item.Model+'</span></b><br>'+
                                    '<span class="wlprdpr">Price</span>&nbsp;&nbsp;<b><span class="price_span">AED '+item.Price+'</span></b>'+
                                    '</div></div>';
                          html = html+sub;
                        });
                        html = html+'</div>';
                       
                        $('#imgpost_div').html(html);
                    },
                    error:function (data) {
                        setTimeout(function ()
                                    {
                                        $('#imgpost_div').html(' <h2>No Item Found</h2>');
                                        $('#filter-load').fadeOut();
                                    }, 1000);
                    },
                  
                });
              
               
        });
       
    });
</script>