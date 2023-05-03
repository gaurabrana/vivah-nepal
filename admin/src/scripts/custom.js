(function ($) {
    "use strict";

    function getAdPosition(value) {
        $.ajax({
            url: "getdata.php",
            method: "POST",
            data: { "datatype": "getAdPositions", "screenname": value },
            cache: false,
            success: function (response) {
                var data = JSON.parse(response);
                if (data.code == 200) {
                    $("#ad-posi").empty();
                    $("#ad-posi").append(data.result);
                }
            }
        });
    }

    // call for first time page load
    getAdPosition(1);

    $(document).ready(function () {
        if ($("#image-preview").attr("src") == "") {
            $("#image-preview").css('display', 'none');
        }
        if ($(".imageHolderForHero").attr("src") == "") {
            $(".imageHolderForHero").css('display', 'none');
        }
        
    });

    $("#screen-group-name").on("change", function () {
        let value = $(this).val();
        getAdPosition(value);
    });


    $('#add-advertisement').submit(function (e){
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