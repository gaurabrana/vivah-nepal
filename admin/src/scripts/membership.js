$(document).ready(function() {

    $("#NewMembershipForm").on("submit", function(e) {
        e.preventDefault();
        var data = new FormData(document.getElementById("NewMembershipForm"));
        data.append("action", "submit");
        $.ajax({
            url: "db-work/addmembership.php",
            data: data,
            method: "POST",
            processData: false,
            contentType: false,
            cache: false,
            success: function(response) {
                var data = JSON.parse(response);                
                if (data.code == 200) {
                    $("#NewMembershipForm textarea").val("");
                    $("#NewMembershipForm input").not(':input[type=submit]').val("");
                    $('#membershipCoupons option[value="Yes"]').prop("selected", "selected");
                    $('#membershipgiveaway option[value="Yes"]').prop("selected", "selected");
                    $('#membershiptype option[value=""]').prop("selected", "selected");
                    $('#membershipduration option[value=""]').prop("selected", "selected");
                    toastr.success('Packaged successfully added.', 'Success!!');
                    $(this).delay(2000).queue(function(next) {                                     
						next();                        
                        location.reload();
					});
                } else if (data.code == 201) {
                    toastr.error('Failed to add package.', 'Failure!!');
                } else if (data.code == 202) {
                    toastr.error('Invalid request.', 'Failure!!');
                } else if (data.code == 203) {
                    toastr.error('Empty fields found.', 'Failure!!');
                }
            }
        });
    });
    $("#UpdateMembershipForm").on("submit", function(e) {
        e.preventDefault();
        var data = new FormData(document.getElementById("UpdateMembershipForm"));
        data.append("action", "update");
        $.ajax({
            url: "db-work/addmembership.php",
            data: data,
            method: "POST",
            processData: false,
            contentType: false,
            cache: false,
            success: function(response) {
                var data = JSON.parse(response);                
                if (data.code == 200) {
                    toastr.success('Packaged successfully updated.', 'Success!!');
                } else if (data.code == 201) {
                    toastr.error('Failed to update package.', 'Failure!!');
                } else if (data.code == 202) {
                    toastr.error('Invalid request.', 'Failure!!');
                } else if (data.code == 203) {
                    toastr.error('Empty fields found.', 'Failure!!');
                }
            }
        });
    });
    $(document).on('click', ".deletePackage" ,function(e){    
        var id = $(this).attr("id");        
        var elementId = id.split("deleteMemebership")[1];
        var data = new FormData();
        data.append('id', elementId);        
        data.append("deleteMembership", true);
        $.ajax({
            url: "db-work/addmembership.php",
            data: data,
            method: "POST",
            processData: false,
            contentType: false,
            cache: false,
            success: function(response) {
                var data = JSON.parse(response);                
                if (data.code == 200) {
                    toastr.success('Packaged successfully deleted.', 'Success!!');
                    $(this).delay(2000).queue(function(next) {                                     
						next();
                        window.location.href = "membership.php";
					});
                } else if (data.code == 201) {
                    toastr.error('Failed to delete package.', 'Failure!!');
                } else if (data.code == 202) {
                    toastr.error('Invalid request.', 'Failure!!');
                } else if (data.code == 203) {
                    toastr.error('Empty fields found.', 'Failure!!');
                }
            }
        });
    });
});