$(document).on("click","#save_category",function(e) {
        e.preventDefault();
        category_name=$("body").find("#category_name").val();
		category_ar=$("body").find("#category_ar").val();
		ctype=$("body").find("#optradio").val();
        if( category_name=='') {
        swal('Fields cant be empty','','error');
        e.stopPropagation();
        }else{
            $.ajax({
            url: Settings.baseurl+'admin/saveparent_category',
            data : {"category":category_name,'category_ar':category_ar,'type':ctype},
            type: "POST",
            success:function(data) {
            var obj = jQuery.parseJSON (data);	
               if(obj.success){
				   swal('Category Saved Successfully','','success');
				   window.location.reload()
/* 			swal({
 			 	title: "Want to add Some Sub categories ?",
  				text: "Ok To continue , Otherwise You can add Category By clicking edit Button!",
  				type: "warning",
  				showCancelButton: true,
  				cancelButtonText: "No, cancel!",
  				confirmButtonColor: "#DD6B55",
  				confirmButtonText: "Yes!",
  				closeOnConfirm: false,
  				html: false
		}, function(isConfirm){
  
  if (isConfirm) {
     window.location.href = Settings.baseurl+'admin/subcategory/'+obj.id
  } else {
   
   $('#categoryModal').hide()
   window.location.reload()
  }
  
  
 
  
}); */


}else{
			   	
			   	$("body").find(".text-danger").html('something went wrong');
			   	
			   	
			   }
               
              
            }
        });
     
        }
       
});


$(document).on("click",".catedit",function(e) {
	
e.preventDefault();
catid = $(this).data('id');
$('#'+catid).prop('readonly',false)       
$('#mainactions_'+catid).hide();         
$('#subactions_'+catid).show();   
$('#'+catid).focus();
   
});

$(document).on("click",".cateditcancel",function(e) {
	
e.preventDefault();
catid = $(this).data('id');
$('#'+catid).prop('readonly',true)   
$('#subactions_'+catid).hide();       
$('#mainactions_'+catid).show();         


});

$(document).on("click",".cateditsave",function(e) {
        e.preventDefault();
        catid = $(this).data('id');
        from =  $(this).data('from');
        cat = $(this).data('cat');
        
        category_name=$("body").find('#'+catid).val();
        if( category_name=='') {
        swal('Fields cant be empty','','error');
        e.stopPropagation();
        }else{
            $.ajax({
            url: Settings.baseurl+'admin/updateparent_category',
            data : {"category":category_name,"categoryid":catid},
            type: "POST",
            success:function(data) {
            var obj = jQuery.parseJSON (data);	
               if(obj.success){
			swal({
 			 	title: "Want to add Some Sub categories ?",
  				text: "Ok To continue , Otherwise You can add Category By clicking edit Button!",
  				type: "warning",
  				showCancelButton: true,
  				cancelButtonText: "No, cancel!",
  				confirmButtonColor: "#DD6B55",
  				confirmButtonText: "Yes!",
  				closeOnConfirm: false,
  				html: false
		}, function(isConfirm){
  
  if (isConfirm) {
  	
  	 
  	if(from==='sub')
     window.location.href = Settings.baseurl+'admin/subcategory/'+cat+'/'+obj.id
    else
     window.location.href = Settings.baseurl+'admin/subcategory/'+obj.id 
     
  } else {
   
   $('#categoryModal').hide()
   
   
      window.location.reload()
  }
  
  
 
  
});
			   




}else{
			   	
			   	swal('something went wrong','','error');
			   	
			   	
			   }
               
              
            }
        });
     
        }
       
});

$(document).on("click",".catdele",function(e) {
        e.preventDefault();
        catid = $(this).data('id');
        
        if( catid!='') {
        	
        swal({
 			 	title: "Are you sure ?",
  				text: "You will not be able to recover this category and its linked properties!",
  				type: "warning",
  				showCancelButton: true,
  				cancelButtonText: "No, cancel!",
  				confirmButtonColor: "#DD6B55",
  				confirmButtonText: "Yes!",
  				closeOnConfirm: false,
  				html: false
		}, function(isConfirm){
  
  		if (isConfirm) {
     		
     		$.ajax({
            url: Settings.baseurl+'admin/delete_pcategory',
            data : {"categoryid":catid},
            type: "POST",
            success:function(data) {
            var obj = jQuery.parseJSON (data);	
               if(obj.success){
			 
			       swal('Deleted Successfully !','','success');
			       window.location.reload()
			   
			   }else{
			   	
			   	swal('something went wrong','','error');
			   
			   	
			   	
			   }
               
              
            }
        });
     		
  		} else {
   
   
   			
  		}
  
  
 
  
	});	
        	
        	
        	
        	
        	
        	
        	
        	
        	
        	
        	
        	          
     
        }
        	
       
       

});
$(document).on("click","#save_sub_category",function(e) {
        e.preventDefault();
        category_id =$("body").find("#category_id").val();
        sub_category_name=$("body").find("#sub_category_name").val();
        sub_category_level=$("body").find("#sub_category_level").val(); 
		sub_category_ar  =$("body").find("#sub_category_ar").val();
        if( sub_category_name==''  || (sub_category_level=='' || sub_category_level =='0')) {
        swal('Fields cant be empty','','error');
        e.stopPropagation();
        }else{
            $.ajax({
            url: Settings.baseurl+'admin/save_sub_category',
            data : {"category_id":category_id,"sub_category":sub_category_name,'sub_category_ar':sub_category_ar,'level':sub_category_level},
            type: "POST",
            success:function(data) {
            var obj = jQuery.parseJSON (data);	
               if(obj.success){
		   
                   swal('SubCategory Saved Successfully','','success');
				   window.location.reload()



				}else if(obj.limit){
					
					  swal('Only 3 SubCategories Allowed','','error');
					  
				}else{
			   	
			   	$("body").find(".text-danger").html('something went wrong');
			   	
			   	
			   }
               
              
            }
        });
     
        }
       
});


$(document).on("click","#save_sub_value",function(e) {
        e.preventDefault(); var link_id ='';
        
        sub_category_name=$("body").find("#sub_category_name").val();
		if( $("body").find("#link").is('input') ) {
					category_id=$("body").find("#link").val(); 
		}else{
			 link_id=$("body").find("#link-val option:selected").val()
			 category_id =$("body").find("#category_id").val();
			 console.log(link_id);
			
		}
		sub_category_ar  =$("body").find("#sub_category_ar").val();
        if( sub_category_name==''  || (category_id=='' || category_id =='0')) {
        swal('Fields cant be empty','','error');
        e.stopPropagation();
        }else{
            $.ajax({
            url: Settings.baseurl+'admin/save_sub_values',
            data : {"category_id":category_id,"sub_category":sub_category_name,'sub_category_ar':sub_category_ar,'link':link_id},
            type: "POST",
            success:function(data) {
            var obj = jQuery.parseJSON (data);	
               if(obj.success){
		   
                   swal('Value Saved Successfully','','success');
				   window.location.reload()



				}else{
			   	
			   	$("body").find(".text-danger").html('something went wrong');
			   	
			   	
			   }
               
              
            }
        });
     
        }
       
});

	function getSubVal(a){
		
		if(a.value!=''){
		 $.ajax({
            url: Settings.baseurl+'admin/get_sub_values',
            data : {"category_id":a.value},
            type: "POST",
            success:function(data) {
            
               if(data){
		        $('#link-val').empty()
		        $.each(data['record'], function (key,value)
{



var opt = $('<option />'); // here we're creating a new select option for each group
opt.val(value['id']);
opt.text(value['name']);
$('#link-val').append(opt);



})
		        
				}else{
			   	$('#link-val').empty()
			   var opt = $('<option />'); // here we're creating a new select option for each group
opt.val('');
opt.text('Select an option');
$('#link-val').append(opt);			   	
			   	
			   }
               
              
            }
        });
		
		}
		
		
	}
	
	

$(document).on("click",".catview",function(e) {
	
	catid = $(this).data('id');
        
        if( catid!='') {
        	 window.location.href=Settings.baseurl+'admin/subcategory/'+catid
        	
        }
        
       
});

$(document).on("click","#save_plan",function(e) {
	e.preventDefault();
        
        plan_name=$("body").find("#plan_name").val();
       
        if( plan_name=='') {
        swal('Fields cant be empty','','error');
        e.stopPropagation();
        }else{
        	
        	$.ajax({
            url: Settings.baseurl+'admin/save_plan',
            data : {"plan_name":plan_name},
            type: "POST",
            success:function(data) {
            var obj = jQuery.parseJSON (data);
            
            if(obj.success){
            	 $('#planModal').hide();
				 swal('Saved Successfully !','','success');
				 window.location.reload()
				
			}else{
				
				swal('Something Went Wrong !','','error');
			}
            
            }
            
            })
        	
        }
	
});



$(document).on("click",".plandelete",function(e) {
        e.preventDefault();
        planid = $(this).data('id');
        
        if( planid!='') {
        	
        swal({
 			 	title: "Are you sure ?",
  				text: "You will not be able to recover this Plan and its linked properties!",
  				type: "warning",
  				showCancelButton: true,
  				cancelButtonText: "No, cancel!",
  				confirmButtonColor: "#DD6B55",
  				confirmButtonText: "Yes!",
  				closeOnConfirm: false,
  				html: false
		}, function(isConfirm){
  
  		if (isConfirm) {
     		
     		$.ajax({
            url: Settings.baseurl+'admin/delete_plan',
            data : {"planid":planid},
            type: "POST",
            success:function(data) {
            var obj = jQuery.parseJSON (data);	
               if(obj.success){
			 
			       swal('Deleted Successfully !','','success');
			       window.location.reload()
			   
			   }else{
			   	
			   	swal('something went wrong','','error');
			   
			   	
			   	
			   }
               
              
            }
        });
     		
  		} else {
   
   
   			
  		}
  
  
 
  
	});	
        	
        	
        	
        	
        	
        	
        	
        	
        	
        	
        	
        	          
     
        }
        	
       
       

});

$(document).on("click",".planedit",function(e) {
        e.preventDefault();
        planid = $(this).data('id');
        
        if( planid!='') {
        	
        	window.location.href=Settings.baseurl+"admin/edit_subcriptionplans/"+planid
       }  	
        	
 });     
 
 
 $(document).on("click","#btnsaveplans",function(e) {
	e.preventDefault();
        
        form=$("#edit_sub_plan");
        
        
       
        if( form=='') {
        swal('Fields cant be empty','','error');
        e.stopPropagation();
        }else{
        	
        	$.ajax({
            url: Settings.baseurl+'admin/update_plan',
            data : form.serializeArray(),
            type: "POST",
            success:function(data) {
            var obj = jQuery.parseJSON (data);
            
            if(obj.success){
            	 $('#planModal').hide();
				 swal('Saved Successfully !','','success');
				 window.location.reload()
				
			}else{
				
				swal('Something Went Wrong !','','error');
			}
            
            }
            
            })
        	
        }
	
});

 
$("#chkbox_unlimited").change(function() {
    if(this.checked) {
    	$('#limit').prop('disabled',true);
    	$('.plimit').hide() 
        //Do stuff
    }else{
		$('#limit').prop('disabled',false);
    	$('.plimit').show() 
	}
});  





function show_trader_view_modal(trader_id) {    
        $("#loader").show();     
        $.ajax({
            url: Settings.baseurl+"admin/fetch_trader_details",
            data : {'trader_id':trader_id},
            type: "POST",

            success:function(data) {
                $("#loader").hide();
                //console.log(data);return false;
                $('#newreg_det_div').html(data);  
                $('#newTraderview').modal("show"); 
            }
        });            
    }
    
    $( "body" ).on( "click", ".approveButton", function() {
        trader_id = $(this).val();
        plan_id=$(this).data("plan");
       $this = $(this);
                
        $.ajax({
            url: Settings.baseurl+"admin/admin_approve_trader",
            data : {'trader_id':trader_id,'plan_id':plan_id},
            type: "POST",

            success:function(data) {
                if(data == 'success') {
                    swal('Trader Approved Successfully',"", "success"); 
                    $this.attr("disabled", "disabled");
                    // window.opener.location.reload();
                }
            }
        });
    });
   
    $( "body" ).on( "click", ".rejectButton", function() {
        trader_id = $(this).val();
        $this = $(this);

        $.ajax({
            url: Settings.baseurl+"admin/admin_reject_trader",
            data : {'trader_id':trader_id},
            type: "POST",

            success:function(data) {
                if(data == 'success') {
                    swal('Trader Rejected Successfully'); 
                    $this.attr("disabled", "disabled");
                   
                }
            }
        });
    });
    $( "body" ).on( "click", ".confirm", function() {
      //  location.href=Settings.baseurl+'admin/new_registers';
    });

    function edit_trader(trader_id) {
        location.href='<?php echo base_url()?>admin/edit_trader/'+trader_id;  
               /*  $.ajax({
                            url: "<?php echo base_url(); ?>admin/Dashboard/admin_edit_trader",
                            data : {'trader_id':trader_id},
                            type: "POST",

                            success:function(data){
                                
                                 if(data == 'success')
                                 {
                                    swal('Trader Rejected Successfully'); 
                                 }    
                              
                                   
                            }

                        });*/
    }
    
    function readprofURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#adnewreg_modal_img1').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


             

$('#newuserModal').on('show.bs.modal', function () {
 $(this).find('.modal-body').css({
              width:'auto', //probably not needed
              height:'auto', //probably not needed 
              'max-height':'100%'});
});	