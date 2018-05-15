$(function() {
$('#btntrader-reg').click(function(){
    location.href = Settings.baseurl+'trader_signup';
});

$('#btncust-reg').click(function(){
    location.href = Settings.baseurl+'customer_signup';
});	
	
});


function watchList() {
    window.location.href =whref;
}
function cartList() {
    window.location.href =chref;
}
function check_add_post(){
if(isTrader){
$.ajax({
url: Settings.baseurl+'trader/trader_check_addpost',
type: "POST",
success: function (data) {
if (data == 0)
            {
                location.href = Settings.baseurl+'trader/add_post';
                
            } else if (data == 1)
            {
               location.href = Settings.baseurl+'plans';
               
            }
             else if (data == 2)
            {
                location.href = Settings.baseurl+'plans/payment_options';
            } 
            else if (data == 4)
            {
              swal('Your account is rejected by Admin.',' Please Contact Admin Team',"error");
               setTimeout(function ()
                {

                   location.href = Settings.baseurl+'trader/profile';
                }, 4000);
            } else if (data == 5)
            {
                swal('Please register as Trader');
                
            } else if (data == 6)
            {
                swal('Your plan has been expired',' Please Contact Admin Team',"error");
                setTimeout(function ()
                {

                    location.href = Settings.baseurl+'plans';
                }, 2000);
               
            } 
             else
            {
                if(isActive==-1){
                    swal('Your account is Freeazed by Admin.',' Please Contact Admin Team',"error");
                
                }else{
                	
                    swal('Please Contact Admin Team','Your account is waiting for aproval','info');
                 
                    
                    }
            setTimeout(function ()
                    {

                     location.href = Settings.baseurl+'trader/profile';
                    }, 4000);
             }

               
        }

          });

   
}else{
    swal('Error','Please register as Trader',"error");
}

}

function video_toggle(x, y){

        var vid = document.getElementById("vd_" + x + '_' + y);

        return vid.paused ? vid.play() : vid.pause();

}

function check_als_cart(category_id, product_id, userid, price){
	
	
	
	
        cart_type=1; 
		
        if (price <= 0)
        {
          
            $.ajax({
                url: Settings.baseurl+"cart/fetch_contact_trader",
                data: {'category_id': category_id, 'product_id': product_id,'userid': userid},
                type: "POST",
                success: function (data) {
                    $('#trader_detail').html(data);
                    $('#cartModal').modal("show");


                }

            });
            
        } else
        {
            $.ajax({
                url: Settings.baseurl+"cart/check_prd_cartexist",
                data: {'post_id': product_id},
                type: "POST",

                success: function (data) {
					
					
                    if (data == 'exist')
                    {
                        swal("Product Has Been Already Added to Cart");
                    } 
					else if(data=='continue')
                    {
                      location.href = Settings.baseurl+'cart/add_cart/'+category_id+'/'+ product_id  + '/' + userid +'/'+price;

                    }else{
						
						 $('#trader_detail').html(data);
                    $('#cartModal').modal("show");
					}



                }

            });


        }
    }
	
	
	function add_to_watch(product_id, category_id, userid) {
        $.ajax({
            url: Settings.baseurl+"cart/check_prd_watchexist",
            data: {'post_id': product_id},
            type: "POST",

            success: function (data) {
                if (data == 'exist')
                {
                    swal("Product Has Been Already Added to Watchlist");
                } else
                {
                    location.href = Settings.baseurl+'cart/add_watch_list/' + product_id +  '/' + category_id + '/' + userid;

                }



            }

        });
    }
	
	
	 function show_prd_details(pid, cid)
    {
		
		

        $.ajax({
            url: Settings.baseurl+"actionutils/fetch_product_sharing",
            data: {'product_id': pid, 'cat_id': cid},
            type: "POST",

            success: function (data) {
                $('#employee_detail').html(data);
                $('#dataModal').modal("show");


            }

        });
		
		
    }
	
	function show_flag_modal(category_id, product_id, trader_id)
    {

        $('#pcatid').val(category_id);
        $('#prodid').val(product_id);
        $('#traderid').val(trader_id);
        $('#flagModal').modal("show");
    }
	
	    $('#btn_flag_modal').click(function () {
        var category_id = $('#pcatid').val();
        var product_id = $('#prodid').val();
        var trader_id = $('#traderid').val();
        var flag_desc = $('#flag_md_cmt').val();
        $.ajax({
            url: Settings.baseurl+"trader/save_flagpost",
            data: {'category_id': category_id, 'product_id': product_id,'trader_id': trader_id, 'flag_desc': flag_desc},
            type: "POST",

            success: function (data) {
                if (data == 'success')
                {
                    swal("Product has been flagged successfully");
                    setTimeout(function ()
                    {

                        location.href = Settings.baseurl;
                    }, 1000);

                } else
                {
                    swal("Failed to report the flag.Try again","","error");
                }
            }
        });
    });

    $(document).ready(function ()
    {
		

        $('.owl-one').owlCarousel({
            loop: true,
            margin: 10,

            navText: ['<button class="owlbtn"><i class="fa fa-chevron-circle-left mostviewslider_left" ></i></button>', '<button class="owlbtn"><i class="fa fa-chevron-circle-right mostviewslider_right"  aria-hidden="true"></i></button>'],
            nav: true,
            autoplay: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 4
                }
            }
        });

       
    
       
		   
        $('#most_viewCarousel .item').each(function () {
            var next = $(this).next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));

            for (var i = 0; i < 3; i++) {
                next = next.next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                }

                next.children(':first-child').clone().appendTo($(this));
            }
        });
	  
        $('.anc_flag').click(function () {

            $('#flagModal').modal("show");

        });

    });	

	
	
$(document).on("click",".emailsend",function(e) {
        e.preventDefault();
        trader_id = $(this).data('trader-id');
        subject=$("body").find('#subject').val();
		message=$("body").find('#message').val();
        if( subject=='' || message=='') {
        swal('Fields cant be empty','','error');
        e.stopPropagation();
        }else{
            $.ajax({
            url:   Settings.baseurl+'mail/mail_trader',
            data : {"trader_id":trader_id,"subject":subject,'message':message},
            type: "POST",
            success:function(data) {
            var obj = jQuery.parseJSON (data);	
               if(obj.success){

                    $('emailModal').hide();
                 	swal(obj.msg,'','success');

				}else{
			   	
			   	swal('something went wrong','','error');
			   	
			   	
			   }
               
              
            }
        });
     
        }
       
});


$('.removewatch').click(function () {
    watchID=jQuery(this).data('watchid');
    elem=jQuery(this).closest('.catpostimgs');

    $.ajax({
        url: Settings.baseurl+"cart/remove_watch_list/"+watchID,

        type: "POST",
        success: function (data) {
            count=jQuery('.catcount-div').find('b').html();
            newcount=parseInt(count)-1;
            jQuery('.catcount-div').find('b').html(newcount);
			jQuery('body').find('.tct').html(newcount);
       
            elem.remove();
} 
});
});


function cart_del(product_id, cat_id){
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, I am sure!',
            cancelButtonText: "No, cancel it!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
                function (isConfirm) {
                    if (isConfirm) {
                        swal({
                            title: 'Deleted!',
                            text: 'Your Product is deleted from cart!',
                            type: 'success'
                        }, function () {

                            $.ajax({
                                url: Settings.baseurl+"cart/del_cart",
                                data: {'product_id': product_id, 'cat_id': cat_id},
                                type: "POST",

                                success: function (data) {

                                    if (data == 'success')
                                    {
                                        //  console.log(data);return false;
                                        setTimeout(function ()
                                        {
                                            //location.reload();  //Refresh page
                                            location.href = Settings.baseurl+'cart/view_cart';
                                        }, 1000);
                                    }

                                }

                            });
                        });

                    } else {
                        swal("Cancelled", "Your product is safe :)", "error");
                    }
                });

    }
   $(document).ready(function () {


        $('#btncheckout').click(function () {

            var value = document.getElementById("cartcnt").innerText;

            if (value > 0) {
			var myurl = Settings.baseurl+'cart/check_availablity';
			 $.ajax({
                type: 'POST',
                url: myurl,

                success: function (data)
                {
                      if(data=='success'){
						  location.href = Settings.baseurl+'cart/view_checkout';
					  }
					  else{
						  
						  swal("error", "Your Cart Contains Items wich are already Sold , Remove them to Continue");
						  
					  }
                    
                }
            }); 	
				
				
				
				
				
				
				
				
                
            } else
            {
                swal("Warning", "No items in Cart List");
            }
        });
        $('#btnshopmore').click(function () {
            location.href = Settings.baseurl
        });
		
		$("#btncartalshamil").click(function (e){
e.preventDefault();
            var myurl = Settings.baseurl+'cart/fetch_alshmail_loc';


            $.ajax({
                type: 'POST',
                url: myurl,

                success: function (data)
                {

                    $('#alshdiv').html(data);
                    //console.log(data);return false;
                }
            });

        });
        $('#btncartonline').click(function (){
            $.ajax({
                url: Settings.baseurl+"add_order_items",
                data: {'fin_tot': mod_tot, 'final_tax': final_tax, 'final_vat': final_vat},
                type: "POST",

                success: function (data) {
                    //console.log(data);return false;
                    var res = data.split("/");
                    var orderid = res[0];
                    var totamt = res[1];
                    var userid = res[2];
                    if (orderid > 0)
                    {

                        location.href = Settings.baseurl+'payment/OnlinePay?amount=' + totamt + '&user_id=' + userid + '&order_id=' + orderid;

                    }

                }

            });

        });
        $('#change_paymentstatus').click(function (){
            var hid_oid = $('#hid_orderid').val();

            var myurl = Settings.baseurl+'cart/change_payment_status';


            $.ajax({
                type: 'POST',
                url: myurl,
                data: {'order_id': hid_oid},
                success: function (data)
                {

                    if (data == 'success')
                    {
                        swal("Registered for Payment", "Please Contact Alshamil Team to Proceed at the earliest");
                        setTimeout(function ()
                        {

                            location.href = Settings.baseurl;
                        }, 5000);
                    }
                }
            });

        });
    });
	
	$(function () {
       // SyntaxHighlighter.all();
    });
   
	
	function call_login(){
	window.location.href = 	Settings.baseurl+'signin'
	}
	
$(document).ready(function (){
	    var prdt_status = $('#prdt_btn_status_css').val();
        if (prdt_status == 0)
        {
            $('.own_avail').css('background-color', '#78a22f');
            $('.own_avail').css('color', 'white');
        }
        if (prdt_status == 1)
        {
            $('.own_sold').css('background-color', '#78a22f');
            $('.own_sold').css('color', 'white');
        }
        if (prdt_status == 2)
        {
            $('.own_book').css('background-color', '#78a22f');
            $('.own_book').css('color', 'white');
        }
		
		
		
		
		
});


