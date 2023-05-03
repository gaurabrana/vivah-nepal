(function ($) {
    "use strict";

    $('#addNewFormPage').submit(function (e){
		e.preventDefault(e);		
		var formData = new FormData(this);		        
        formData.append('submit','submit');
		$.ajax({
			url: "../admin/db-work/add-ad.php",
			type: "POST",
			data: formData,
			cache: false,
			processData: false,     
			contentType: false,
			success: function(result) {
                console.log(result);
				var data = JSON.parse(result);
				if (data.code == 200) {
					//order placed succesfully
					toastr.success('Ad placed successfully.', 'Advertisement Placement!');
					$(this).delay(2000).queue(function(next) {                        
						$("#screen-group-name").val($("#screen-group-name").val()).trigger("change");
                        $("#redirectUrlId").val("");
                        $("#image-input").val(null);
                        $("#image-preview").css('display', 'none');
						next();
					});
				} else if (data.statusCode == 201) {
					toastr.error('Ad placing failed. Please try again.', 'Advertisement Placement!');					
				}
			}
		});
	});
})(jQuery);