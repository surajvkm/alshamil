function readURL(input) {
 if (input.files && input.files[0]) {
    var reader = new FileReader();
		reader.onload = function (e) {
                      $(input).next('.previmg').attr('src', e.target.result);
                       
                    }

                    reader.readAsDataURL(input.files[0]);
                }
}



$('.file-imglabel').click(function() {
          
$(this).prev('.FileUpload').click();

});


 $('.FileUpload').change(function(){
         var img_name = $(this).val();
       
         var imgExtension = ['jpeg','jpg','png','gif'];
         if ($.inArray($(this).val().split('.').pop().toLowerCase(), imgExtension) == -1) {
         alert("Only formats are allowed : "+imgExtension.join(', '));
         $(this).val(null);
         return
         }
         var totalBytes = this.files[0].size;
         if(totalBytes > 128000000)
         {
         alert("File Size cannot exceeds 128 MB");
         $(this).val(null);
         return
         }
         
         readURL(this);
});

$('#txtplace').change(function(){
	var placeVal = $(this).val();
	if(placeVal == 'Other'){
                $('#otherplaceModal').modal("show");
                }
});
$('.btnAddPlaceModal').click(function(){
var newPlace = $('#txtnewplace').val();
 $('#txtplace').append($('<option>', {
                value: newPlace,
                text: newPlace,
                selected:true
}));
            
            
});

$("#phone").intlTelInput({ });
$("#phone").on("countrychange", function(e, countryData) {
  // do something with countryData
  $('#phone').val('+'+countryData.dialCode)
 
});