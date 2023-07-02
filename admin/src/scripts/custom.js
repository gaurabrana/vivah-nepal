(function ($) {
    "use strict";
	const currentUrl = window.location.href;
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
	if (currentUrl.includes("add-ad")) {
    getAdPosition(1);
	}

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
		formData.append('action','add');
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

	$('#update-advertisement').submit(function (e){
		e.preventDefault(e);		
		var formData = new FormData(this);		        
        formData.append('submit','submit');
		formData.append('action','update');
		formData.forEach((value, key)=>{
			console.log(key, value);
		});
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
					toastr.success('Ad updated successfully.', 'Advertisement Update!');
					$(this).delay(2000).queue(function(next) {						
						next();
					});
				} else if (data.code == 201) {
					toastr.error('Ad update failed. Please try again.', 'Advertisement Update!');					
				}
			}
		});
	});
	
	function resetEventFields(){
		$("#addNewEventForm input").val("");
					$('.hold-images h4').attr('hidden', true);
					$('.hold-videos h4').attr('hidden', true);
					$('.hold-images .image-row').empty();
					$('.hold-videos .video-row').empty();
	}
	$("#addNewEventFormForHomepage").submit(function(e) {
		e.preventDefault(this);
		var formData = new FormData(this);
		formData.append('action', "addNewEventForHomepage");		
		$.ajax({
			url: "db-work/add-event.php",
			type: "POST",
			data: formData,			
			processData: false,
			contentType: false,				
			success: function(response) {
				console.log(response);
				var data = JSON.parse(response);				
				if (data.code == 200) {					
					toastr.success('Popup event added successfully.', 'Events');			
					resetEventFields();
					$(this).delay(2000).queue(function(next) {                                     
						next();
					});
				} else if (data.code == 201) {
					toastr.error('Popup event add failed.', 'Events');					
				}
				else if (data.code == 203) {
					toastr.success('Popup event added but failed to add files.', 'Events');					
					resetEventFields();
				}
			},error:function(e){
				console.log(e);
			}			
		});
	});

	$("#addNewEventForm").submit(function(e) {
		e.preventDefault(this);
		var formData = new FormData(this);
		formData.append('action', "addNewEvent");		
		$.ajax({
			url: "db-work/add-event.php",
			type: "POST",
			data: formData,			
			processData: false,
			contentType: false,				
			success: function(response) {
				console.log(response);
				var data = JSON.parse(response);				
				if (data.code == 200) {					
					toastr.success('Event added successfully.', 'Events');			
					resetEventFields();
					$(this).delay(2000).queue(function(next) {                                     
						next();
					});
				} else if (data.code == 201) {
					toastr.error('Event add failed.', 'Events');					
				}
				else if (data.code == 203) {
					toastr.success('Event added but failed to add files.', 'Events');					
					resetEventFields();
				}
			},error:function(e){
				console.log(e);
			}			
		});
	});

	$(".delete-button").on('click', function(){
		var id = $(this).attr("id");
		var elementId = id.split("deleteFile")[1];
		var deletedFileInput = document.getElementById("deletedFileIds");
		var deletedFileInputName = document.getElementById("deletedFileNames");
		var filepath =  $('#dataFile' + elementId).attr("src");		
        deletedFileInput.value += elementId + ",";
        deletedFileInputName.value += filepath + "{}";
		$("#holdItem" + elementId).remove();
	});


	$(".deleteAdsButton").on('click', function(){
		var id = $(this).attr("id");
		var elementId = id.split("adDeleteButton")[1];		
		var formData = new FormData();
		formData.append('id', elementId);
		formData.append('delete', "true");		
		$.ajax({
			url: "db-work/add-ad.php",
			type: "POST",
			data: formData,			
			processData: false,
			contentType: false,				
			success: function(response) {
				console.log(response);
				var data = JSON.parse(response);				
				if (data.code == 200) {					
					toastr.success('Ad deleted successfully.', 'Ads');								
					$(this).delay(2000).queue(function(next) {                                     
						next();
					});
				} else if (data.code == 201) {
					toastr.error('Failed to delete ad.', 'Ads');					
				}				
			},error:function(e){
				console.log(e);
			}			
		});
	});


	$("#updateEventForm").submit(function(e) {
		e.preventDefault(this);
		var formData = new FormData(this);
		formData.append('action', "updateEventForm");		
		$.ajax({
			url: "db-work/add-event.php",
			type: "POST",
			data: formData,			
			processData: false,
			contentType: false,				
			success: function(response) {				
				var data = JSON.parse(response);				
				if (data.code == 200) {					
					toastr.success('Event updated successfully.', 'Events');			
					// resetEventFields();
					$(this).delay(2000).queue(function(next) {                                     
						next();
						location.reload();
					});
				} else if (data.code == 201) {
					toastr.error('Event update failed.', 'Events');					
				}
				else if (data.code == 203) {
					toastr.success('Event updated but failed to add files.', 'Events');					
					// resetEventFields();
				} else if(data.code == 204) {
					toastr.success('Failed to delete images.', 'Events');					
					// resetEventFields();
				}

			},error:function(e){
				console.log(e);
			}			
		});
	});

		// Initialize the jQuery File Upload plugin
		$("#gallery-video-form").submit(function(e) {
			e.preventDefault();
			var formData = new FormData(this);
			formData.append('newGalleryVideo', true);
			var error = 0;
			formData.forEach((value, key) => {
				if (key === "videoFile[]") {
				  if (value.name === "") {
					error++;
				  }
				}
				if (key === "urlData0") {
				  if (value === "") {
					error++;
				  }
				}
			  });
			if(error > 0){
				toastr.error('No videos selected.', 'Gallery');					
				return;
			}  
			$.ajax({
				url: "db-work/manage-media.php",
				type: "POST",
				data: formData,				
				processData: false,
				contentType: false,				
				success: function(response) {
					var data = JSON.parse(response);					
					if (data.code == 200) {						
						toastr.success('Videos added successfully.', 'Gallery');
						$("#gallery-video-form input").val('');
						$(".video-container").remove();
						$('.video-url-links .row:not(:first)').remove();
						document.querySelector('#selected-videos-container').innerHTML = '';													
						$(this).delay(2000).queue(function(next) {                                     
							next();
						});
					} else if (data.code == 201) {
						toastr.error('Video upload failed.', 'Gallery');					
					}
					else if (data.code == 203) {
						toastr.error('No data to upload.', 'Gallery');					
					}
					else if (data.code == 204) {
						toastr.error('File size is greater than the limit.', 'Gallery');					
					}
					else if (data.code == 205) {
						toastr.error('Failed to save video url.', 'Gallery');					
					}
				}				
			});
		});
	
		function fetchBlogCategory(){
			var formdata = new FormData();
				formdata.append('blogCategory', true);				
				$.ajax({
					url: "../admin/getblogcategory.php",
					type: "POST",
					data:formdata,
					cache: false,
					processData: false,     
					contentType: false,
					success: function(result) {         
						console.log(result);       
						var result = JSON.parse(result);
						$("#blogCategorySelect").html(result.data);
					}
				});
			}

			if (currentUrl.includes("add-blog")) {
				fetchBlogCategory();
			}

	function fetchGalleryItems(type){	
		var formdata = new FormData();
		formdata.append('galleryImageData', true);
		formdata.append('type', type);
		$.ajax({
			url: "../admin/getgalleryitem.php",
			type: "POST",
			data:formdata,
			cache: false,
			processData: false,     
			contentType: false,
			success: function(result) {				 
				var result = JSON.parse(result);
				if(type=="image"){
				$(".existing-gallery-image-holder").html(result.data);
				}
				else{
				$(".existing-gallery-video-holder").html(result.data);	
				}
			}
		});
	}

	function getAdminEmails(){	
		var formdata = new FormData();
		formdata.append('adminEmails', true);		
		$.ajax({
			url: "../admin/getdata.php",
			type: "POST",
			data:formdata,
			cache: false,
			processData: false,     
			contentType: false,
			success: function(result) {				 
				var result = JSON.parse(result);
				$("#emailWithNotification").html('');			
				$("#emailWithNotification").html(result.data);
			}
		});
	}

	function getNotAddedAdminEmails(){	
		var formdata = new FormData();
		formdata.append('notAddedAdminEmails', true);		
		$.ajax({
			url: "../admin/getdata.php",
			type: "POST",
			data:formdata,
			cache: false,
			processData: false,     
			contentType: false,
			success: function(result) {				 
				var result = JSON.parse(result);
				$("#notAddedEmailWithNotification").html('');			
				$("#notAddedEmailWithNotification").html(result.data);
			}
		});
	}

	$(document).on('click', ".gallery-video-delete-button" ,function(e){
		var id = $(this).attr("id");
		var elementId = id.split("deleteVideoGalleryItem")[1];
		var path = $("#videoFile"+elementId).attr("src");
		var formData = new FormData();
		formData.append('action', 'deleteVideo');
		formData.append('id', elementId);
		formData.append('path',path);		
		$.ajax({
			url: "../admin/db-work/manage-media.php",
			type: "POST",
			data: formData,
			cache: false,
			processData: false,     
			contentType: false,
			success: function(result) {
                console.log(result);
				var data = JSON.parse(result);
				if (data.code == 200) {					
					toastr.success('Video deleted successfully.', 'Gallery');					
					$("#videoHolder"+elementId).remove();
					$(this).delay(2000).queue(function(next) {                                     
						next();
					});
				} else if (data.code == 201) {
					toastr.error('Image upload failed.', 'Gallery');					
				}
			}
		});
	});
	
	
		$('#gallery-Form').on('submit', function(event) {
			// Prevent the default form submission
		event.preventDefault();		
		var formData = new FormData(this);		        		
        formData.append('newGalleryImages','true');		
		 // Get the file input element and the file list
		 var fileInput = document.getElementById('image-input');
		 var fileList = fileInput.files;
	   
		 // Loop through the fileList and append the corresponding description to the FormData object
		 for (var i = 0; i < fileList.length; i++) {
			var tempId = i + 1;
		   var descriptionId = 'descriptionId' + tempId;
		   var descriptionElement = document.getElementById(descriptionId);
		   var descriptionValue = descriptionElement.value;
		   formData.append('descriptionValue'+tempId, descriptionValue);
		 }
		$.ajax({
			url: "../admin/db-work/manage-media.php",
			type: "POST",
			data: formData,
			cache: false,
			processData: false,     
			contentType: false,
			success: function(result) {
                console.log(result);
				var data = JSON.parse(result);
				if (data.code == 200) {					
					toastr.success('Images added successfully.', 'Gallery');
					$("#gallery-Form input").val('');
					document.querySelector('.newGallery .gallery-image-holder').innerHTML = '';	
					document.querySelector('.oldGallery .existing-gallery-image-holder').innerHTML = '';	
					fetchGalleryItems("image");
					$(this).delay(2000).queue(function(next) {                                     
						next();
					});
				} else if (data.code == 201) {
					toastr.error('Image upload failed.', 'Gallery');					
				}
			}
		});
	});


if (currentUrl.includes("manage-gallery")) {
	fetchGalleryItems("image");
	fetchGalleryItems("video");
}

if (currentUrl.includes("manage-admin-emails")) {	
	getAdminEmails();
}	
	$(document).on('click', ".galleryImageUpdate" ,function(e){
		var id = $(this).attr('id');
		var elementId = id.split('saveButton')[1];
		var description = $("#imageDescriptionFor"+elementId).val();
		var formData = new FormData();
		formData.append('action', 'updateImage');
		formData.append('elementId', elementId);
		formData.append('description',description);
		console.log(formData);
		$.ajax({
			url: "../admin/db-work/manage-media.php",
			type: "POST",
			data: formData,
			cache: false,
			processData: false,     
			contentType: false,
			success: function(result) {                
				var data = JSON.parse(result);
				if (data.code == 200) {					
					toastr.success('Image information updated successfully.', 'Gallery');
					fetchGalleryItems("image");
					$(this).delay(2000).queue(function(next) {                                     
						next();
					});
				} else if (data.code == 201) {
					toastr.error('Image information update failed.', 'Gallery');					
				}
			}
		});	
	});

		$(document).on('click', ".galleryImageDelete" ,function(e){		
		var id = $(this).attr('id');
		var elementId = id.split('deleteButton')[1];
		var imageSrc = $("#imageForId" + elementId).val();
		var formData = new FormData();
		formData.append('action', 'deleteImage');
		formData.append('elementId', elementId);
		formData.append('imagePath', imageSrc);
		console.log(imageSrc);
		$.ajax({
			url: "../admin/db-work/manage-media.php",
			type: "POST",
			data: formData,
			cache: false,
			processData: false,     
			contentType: false,
			success: function(result) {                
				var data = JSON.parse(result);
				if (data.code == 200) {					
					$('.existing-container'+ elementId).remove();
					toastr.success('Image with ID ' + elementId + ' deleted successfully.', 'Gallery');
					$(this).delay(2000).queue(function(next) {                                     
						next();
					});
				} else if (data.code == 201) {
					toastr.error('Image delete failed.', 'Gallery');					
				}
			}
		});
	});

	function saveAdminNotificationEmail(formdata){
		$.ajax({
			url: "../admin/db-work/add-admin.php",
			type: "POST",
			data: formdata,
			cache: false,
			processData: false,     
			contentType: false,
			success: function(result) {       
				console.log(result);         
				var data = JSON.parse(result);
				if (data.code == 200) {					
					$('#emailInput').val('');
					getAdminEmails();
					getNotAddedAdminEmails();
					toastr.success('Email added.', 'Email for notification');
					$(this).delay(2000).queue(function(next) {                                     
						next();
					});
				} else if (data.code == 201) {
					toastr.error('Failed to save email', 'Email for notification');					
				}
				else if(data.code == 202){
					toastr.error('Email already exist', 'Email for notification');
				}
			}
		});
	}
	
	$(document).on('click', ".addAdmin" ,function(e){
		var id = $(this).attr('id');
		var elementId = id.split('holdAdminInfo')[1];
		var formData = new FormData();		                
		formData.append('action', 'addAdminEmailForEmail');
		var email = $("#adminAvailable" + elementId).val();
		formData.append('emailAddressForAdminNotification', email);		
		saveAdminNotificationEmail(formData);
	});

	$(document).on('click', ".rmvAdmin" ,function(e){	
		var id = $(this).attr('id');
		var elementId = id.split('removeAdmin')[1];
		var formData = new FormData();		                
		formData.append('action', 'deleteAdminEmail');		
		formData.append('id', elementId);		
		$.ajax({
			url: "../admin/db-work/add-admin.php",
			type: "POST",
			data: formData,
			cache: false,
			processData: false,     
			contentType: false,
			success: function(result) {
                console.log(result);
				var data = JSON.parse(result);
				if (data.code == 200) {					
					toastr.success('Email removed from notification.', 'Email Notification Service');
					$(this).delay(2000).queue(function(next) {                                     
						next();
					});
					getAdminEmails();
					getNotAddedAdminEmails();
				} else if (data.code == 201) {
					toastr.error('Email failed to remove from notification.', 'Email Notification Service');					
				}
			}
		});
	});

	$('#addNewNotifyEmailAddress').submit(function (e){
		e.preventDefault(e);	        
		var formData = new FormData(this);		                
		formData.append('action', 'addAdminEmailForEmail');
		saveAdminNotificationEmail(formData);		
	});

	

	$('#update-about-page').submit(function (e){
		e.preventDefault(e);	        
		var formData = new FormData(this);		        
        formData.append('submit','submit');
		formData.append('type', 'number-detail');
		$.ajax({
			url: "../admin/db-work/update-about.php",
			type: "POST",
			data: formData,
			cache: false,
			processData: false,     
			contentType: false,
			success: function(result) {
                console.log(result);
				var data = JSON.parse(result);
				if (data.code == 200) {					
					toastr.success('Details updated successfully.', 'About Us Page Details!');
					$(this).delay(2000).queue(function(next) {                                     
						next();
					});
				} else if (data.code == 201) {
					toastr.error('Ad placing failed. Please try again.', 'About Us Page Details!');					
				}
			}
		});
	});

	$('#company-detail-page').submit(function (e){
		e.preventDefault(e);        
		var formData = new FormData(this);		        
        formData.append('submit','submit');
		formData.append('type', 'company-detail');
		$.ajax({
			url: "../admin/db-work/update-about.php",
			type: "POST",
			data: formData,
			cache: false,
			processData: false,     
			contentType: false,
			success: function(result) {
                console.log(result);
				var data = JSON.parse(result);
				if (data.code == 200) {					
					toastr.success('Details updated successfully.', 'About Us Page Details!');
					$(this).delay(2000).queue(function(next) {                                     
						next();
					});
				} else if (data.code == 201) {
					toastr.error('Ad placing failed. Please try again.', 'About Us Page Details!');					
				}
			}
		});
	});

	$('#addNewBlogCategoryForm').submit(function (e){
		e.preventDefault(e);        
		var formData = new FormData(this);   
		formData.append('action', 'addNewCategory');
		$.ajax({
			url: "../admin/db-work/manage-blog.php",
			type: "POST",
			data: formData,
			cache: false,
			processData: false,     
			contentType: false,
			success: function(result) {
                console.log(result);
				var data = JSON.parse(result);
				if (data.code == 200) {					
					$("#recentBlogCategory").val("");
					fetchBlogCategory();
					toastr.success('New Blog Category Added', 'Blog Details!');
					$(this).delay(2000).queue(function(next) {                                     
						next();
					});
				} else if (data.code == 201) {
					toastr.error('Failed to add new blog category.', 'Blog Details!');					
				}
			}
		});
	});

	$('#updateNewBlogDetailForm').submit(function (e){
		e.preventDefault(e);        
		var formData = new FormData(this);   
		formData.append('action', 'updateBlog');
		$.ajax({
			url: "../admin/db-work/manage-blog.php",
			type: "POST",
			data: formData,
			cache: false,
			processData: false,     
			contentType: false,
			success: function(result) {
                console.log(result);
				var data = JSON.parse(result);
				if (data.code == 200) {					
					toastr.success('Blog details updated.', 'Blog Details!');
					$(this).delay(2000).queue(function(next) {                                     
						next();
					});
				} else if (data.code == 201) {
					toastr.error('Failed to update blog details.', 'Blog Details!');					
				}
			}
		});
	});


	function clearForm() {
		// Clear text and textarea fields
		$('#addNewBlogDetailForm input[type="text"], #addNewBlogDetailForm textarea').val('');
  
		// Clear file input field
		$('#addNewBlogDetailForm input[type="file"]').val(null);
  
		// Reset select field to the first option
		$('#addNewBlogDetailForm select').prop('selectedIndex', 0);
	  }
	
	$('#addNewBlogDetailForm').submit(function (e){
		e.preventDefault(e);        
		var formData = new FormData(this);   		
		formData.append('action', 'addNewBlog');
		$.ajax({
			url: "../admin/db-work/manage-blog.php",
			type: "POST",
			data: formData,
			cache: false,
			processData: false,     
			contentType: false,
			success: function(result) {                
				var data = JSON.parse(result);
				if (data.code == 200) {					
					clearForm();					
					toastr.success('Added new blog successfully', 'Blog Details!');
					$(this).delay(2000).queue(function(next) {                                     
						next();
					});
				} else if (data.code == 201) {
					toastr.error('Failed to add new blog', 'Blog Details!');					
				}
			}
		});
	});	

	$('#messageDeveloper').submit(function (e){
		e.preventDefault(e);        
		var formData = new FormData(this);   		
		formData.append('action', 'messagedeveloper');
		$.ajax({
			url: ".././database/message-developer.php",
			type: "POST",
			data: formData,
			cache: false,
			processData: false,     
			contentType: false,
			success: function(result) {                
				var data = JSON.parse(result);
				if (data.code == 200) {					
					$("#messageDeveloper textarea").val("");
					toastr.success('Message Delivered Successfully', 'Message Developer');
					$(this).delay(2000).queue(function(next) {                                     
						next();
					});
				} else if (data.code == 201) {
					toastr.error('Message Deliver Failed', 'Message Developer');					
				}
			}
		});
	});	

	

	$('#addNewAdminInSystemForm').submit(function (e){
		e.preventDefault(e);        
		var formData = new FormData(this);   		
		formData.append('action', 'addNewAdminInSystem');
		$.ajax({
			url: "../admin/db-work/add-admin.php",
			type: "POST",
			data: formData,
			cache: false,
			processData: false,     
			contentType: false,
			success: function(result) {                
				var data = JSON.parse(result);
				if (data.code == 200) {													
					$('#addNewAdminInSystemForm input').val('');	
					toastr.success('Added new admin successfully', 'Manage Admins');
					$(this).delay(2000).queue(function(next) { 
						next();						
						location.reload();
					});
				} else if (data.code == 201) {
					toastr.error('Failed to add new admin', 'Manage Admins');					
				}
				else if (data.code == 202) {
					toastr.error('Admin already exists', 'Manage Admins');					
				}
			}
		});
	});	

	$('#updateAdminInSystemForm').submit(function (e){
		e.preventDefault(e);        
		var formData = new FormData(this);   		
		formData.append('action', 'updateAdminInSystem');
		$.ajax({
			url: "../admin/db-work/add-admin.php",
			type: "POST",
			data: formData,
			cache: false,
			processData: false,     
			contentType: false,
			success: function(result) {                
				var data = JSON.parse(result);
				if (data.code == 200) {																		
					toastr.success('Admin updated successfully', 'Manage Admins');
					$(this).delay(2000).queue(function(next) { 
						next();						
						location.reload();
					});
				} else if (data.code == 201) {
					toastr.error('Failed to update admin', 'Manage Admins');					
				}
				else if (data.code == 202) {
					toastr.error('Admin email already exists', 'Manage Admins');					
				}
			}
		});
	});	

	$(document).on('click', ".deleteAdminButton" ,function(e){
		e.preventDefault(e);        
		var id = $(this).attr("id");
		var elementId = id.split("deleteAdmin")[1];
		var formData = new FormData();   		
		formData.append('id', elementId);
		formData.append('action', 'deleteAdminFromSystem');
		$.ajax({
			url: "../admin/db-work/add-admin.php",
			type: "POST",
			data: formData,
			cache: false,
			processData: false,     
			contentType: false,
			success: function(result) {                
				var data = JSON.parse(result);
				if (data.code == 200) {																		
					toastr.success('Deleted admin successfully', 'Manage Admins');
					$(this).delay(2000).queue(function(next) { 
						next();						
						window.location.href="manage-admin.php";
					});
				} else if (data.code == 201) {
					toastr.error('Failed to delete new admin', 'Manage Admins');					
				}				
			}
		});
	});	

	$('#addNewServiceForm').submit(function (e){
		e.preventDefault(this);
		var formData = new FormData(this);
		formData.append('action', "addNewService");		
		$.ajax({
			url: "db-work/manage-service.php",
			type: "POST",
			data: formData,			
			processData: false,
			contentType: false,				
			success: function(response) {				
				var data = JSON.parse(response);				
				if (data.code == 200) {							
					toastr.success('Service added successfully.', 'Services');
					$("#addNewServiceForm input").val("");
					$("#addNewServiceForm textarea").val("");
					$("#holdPreviewImagesFromSelection").innerHTML = "";
					$(this).delay(2000).queue(function(next) {                                     
						next();
						location.reload();
					});
				} else if (data.code == 201) {
					toastr.error('Service update failed.', 'Services');					
				}
				else if (data.code == 203) {
					toastr.success('Service added but failed to add files.', 'Services');										
				} else if(data.code == 204) {
					toastr.success('Failed to delete images.', 'Services');										
				}

			},error:function(e){
				console.log(e);
			}			
		});
	});

	$('#updateSingleServiceForm').submit(function (e){
		e.preventDefault(this);
		var formData = new FormData(this);
		formData.append('action', "updateServiceForm");		
		$.ajax({
			url: "db-work/manage-service.php",
			type: "POST",
			data: formData,			
			processData: false,
			contentType: false,				
			success: function(response) {				
				var data = JSON.parse(response);				
				if (data.code == 200) {							
					toastr.success('Service updated successfully.', 'Services');								
					$(this).delay(2000).queue(function(next) {                                     
						next();
						location.reload();
					});
				} else if (data.code == 201) {
					toastr.error('Service update failed.', 'Services');					
				}
				else if (data.code == 203) {
					toastr.success('Service updated but failed to add files.', 'Services');										
				} else if(data.code == 204) {
					toastr.success('Failed to delete images.', 'Services');										
				}

			},error:function(e){
				console.log(e);
			}			
		});
	});

	$(document).on('click', ".deleteServiceButton" ,function(e){
		e.preventDefault(e);        
		var formData = new FormData(this);   
		formData.append('action', 'addNewCategory');
		$.ajax({
			url: "../admin/db-work/manage-blog.php",
			type: "POST",
			data: formData,
			cache: false,
			processData: false,     
			contentType: false,
			success: function(result) {
                console.log(result);
				var data = JSON.parse(result);
				if (data.code == 200) {					
					$("#recentBlogCategory").val("");
					fetchBlogCategory();
					toastr.success('New Blog Category Added', 'Blog Details!');
					$(this).delay(2000).queue(function(next) {                                     
						next();
					});
				} else if (data.code == 201) {
					toastr.error('Failed to add new blog category.', 'Blog Details!');					
				}
			}
		});
	});
	
	  if (currentUrl.includes("gallery-video")) {	
		Fancybox.bind('[data-fancybox]', {
			animationEffect: "zoom-in-out",
			buttons: [
			  "zoom",
			  "slideShow",
			  "fullScreen",
			  "download",
			  "thumbs",
			  "close"
			],
			clickContent: "next",
			lang: "en",
			loop: true,
			transitionEffect: "slide",
			type: "video",
			video: {
			  autoStart: false,
			  hideControls: false,
			  quality: "default",
			  type: "video/mp4"
			}
		  });
		  
	}

	$(".addBlogImages").on('click', function(e){
		$("#blogImages").click();
	});

	$(document).ready(function() {
		var rowCounter = 1; // Counter to keep track of row IDs
		
		// Function to add a new row
		function addRow() {
			var newRow = $('<div class="row" id="row-' + rowCounter + '">');
			var col1 = $('<div class="col-md-6">');
			var formGroup = $('<div class="form-group holdUrls">');
			var label = $('<label>Online Video Link</label>');
			var input = $('<input type="text" class="form-control video-url" name="urlData' + rowCounter + '" placeholder="https://mywebsite/myvideo">');
			var col2 = $('<div class="col-md-6">');
			var videoContainer = $('<div class="video-container"></div>');
	
			formGroup.append(label);
			formGroup.append(input);
			col1.append(formGroup);
			col2.append(videoContainer);
			newRow.append(col1);
			newRow.append(col2);
			$('.video-url-links').append(newRow);
	
			rowCounter++;
		}
		
		// Function to remove a row
		function removeRow(rowId) {
			$('#row-' + rowId).remove();
		}
	
		// Event handler for input change
		$('.video-url-links').on('input', '.video-url', function() {
			console.log("changing");
			var videoUrl = $(this).val();
			var videoContainer = $(this).closest('.row').find('.video-container');
	
			if (videoUrl) {
				// If video URL is provided, display the video
				var videoId = getYouTubeVideoId(videoUrl);
				if (videoId) {
					var embedUrl = 'https://www.youtube.com/embed/' + videoId;
					var iframeHtml = '<iframe width="560" height="315" src="' + embedUrl + '" frameborder="0" allowfullscreen></iframe>';
					videoContainer.html(iframeHtml);
					addRow(); // Add a new row
					$('.no-of-video-url').val($('.video-url').length);
				}
			} else {
				// If video URL is empty, remove the row if the next row is also empty
				videoContainer.empty();
				var rowId = $(this).closest('.row').attr('id').split('-')[1];
				var nextRowInput = $('#row-' + (parseInt(rowId) + 1)).find('.video-url');
	
				if (!nextRowInput.val()) {
					removeRow(parseInt(rowId) + 1); // Remove the next row
				}
				$('.no-of-video-url').val($('.video-url').length);
			}
			
			// Function to extract the YouTube video ID from the URL
			function getYouTubeVideoId(url) {
				var regExp = /^(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:embed\/|watch\?v=|watch\?.+&v=|v\/|e\/|u\/\w+\/|user\/\w+\/|ytscreeningroom\/?\?v=)|youtu\.be\/)([^&#?\n]+)/;
				var match = url.match(regExp);
				if (match && match[1].length === 11) {
					return match[1];
				} else {
					return null;
				}
			}
			 
		});
	});



})(jQuery);