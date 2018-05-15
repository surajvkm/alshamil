$('#options-modal').on('show.bs.modal', function(e) {
    //get data-id attribute of the clicked element
	$(".data-body").empty()
	$(".plnm").attr('data-id','');
    var bodydata = $(e.relatedTarget).data('body');
	var id = $(e.relatedTarget).data('type-id');
	console.log(id);
    $(".plnm").attr('data-id',id);
    $(".data-body").html(bodydata);
});
$('#options-modal').on('hide.bs.modal', function(e) {
	$(".data-body").empty()
	$(".plnm").attr('data-id','');
});

function disp_payment(){
	
	    var plans_id = $(".plnm").attr('data-id');
		
        $.ajax({
            type: 'POST',
            url: Settings.baseurl+'plans/plan_options',
            data: {'plan_id': plans_id},
            success: function (data)
            {


                if (data == 'success')
                    location.href = Settings.baseurl+'plans/payment_options';
                //console.log(data);return false;

            }
        });
      
}
 
$(document).ready(function () {
        $('[data-toggle="popover"]').popover({placement : 'top',
        trigger : 'hover'});
});
$(document).ready(function(){
$("#btnpaythruals").click(function (){
$.ajax({
                           type:'POST',
                          
                           url:Settings.baseurl+'plans/office_loc',
                           
                           success:function(data)
                           {
                               $('#alshdiv').html(data);
                               //console.log(data);return false;
                              
                           }
                       });   
                      
                });
                

                $("#yes_office").click(function ()
                {
                  location.href = Settings.baseurl;
             
                });
                $("#yes_bank").click(function ()
                {
                   
                   
                  $.ajax({
                           type:'POST',
                           
                           url:Settings.baseurl+'plans/updatebankPay',
                          
                           success:function(data)
                           {
                            location.href = Settings.baseurl+'plans/paymentslip'
                           }
                       });  
                  
                      
                });
                $("#btn_proceed_online").click(function ()
                {
                    
                  $.ajax({
                           type:'POST',
                           
                           url:Settings.baseurl+'plans/getplanAmount',
                          
                           success:function(data)
                           {
                               var res = data.split("-");
                               var user_id = res[1];
                               var amt = res[0];
                               location.href = Settings.baseurl+'payment/onlinepay?amount='+amt+'&user_id='+user_id;
                           }
                       });   
                
                      
                });
                $("#btnsinglepost").click(function ()
                {
                  
                  var myurl = Settings.baseurl+'payment/make_pay';
                 
                   var plans_type = $('#hid_planstype').val();
                    $.ajax({
                           type:'POST',
                           url:myurl,
                           data:{'plans_type':plans_type},
                           success:function(data)
                           {
                               $('#planstype').css('display','none');
                               $('#header_div').css('display','none');
                               $('#footer_div').css('display','none');
                               $('#payoptions_div').html(data);
                           }
                       });   
                      
                });
               
            });