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
				} else if (data.code == 201) {
					toastr.error('Ad placing failed. Please try again.', 'Advertisement Placement!');					
				}
			}
		});
	});
	$('.pageForms').submit(function (e){
		e.preventDefault(e);
		console.log("printed");
		var formId = $(this).attr('id');
		var pageId = formId.split('formFor')[1];
		var pageName = $('#pageNameFor'+pageId).val();
		var formData = new FormData(this);
		formData.append("updateHeroImage", true);
		formData.append("pageId", pageId);
		formData.append("pageName", pageName);
		$.ajax({
			url: "../admin/db-work/manage-pages.php",
			type: "POST",
			data: formData,
			cache: false,
			processData: false,     
			contentType: false,
			success: function(result) {
                console.log(result);
				var data = JSON.parse(result);
				if (data.code == 200) {					
					toastr.success('Image Update Success.', 'Hero Image Update!');
					$(this).delay(2000).queue(function(next) {                                     
						next();
					});
				} else if (data.code == 201 || data.code == 202) {
					toastr.error(data.message, 'Hero Image Update!');					
				}
			}
		});
	});
})(jQuery);