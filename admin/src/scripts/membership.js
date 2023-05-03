$(document).ready(function() {

    $("#NewMembershipForm").on("submit", function(e) {
        e.preventDefault();
        var data = new FormData(document.getElementById("NewMembershipForm"));
        data.append("action", "submit");
        $.ajax({
            url: "database/addmembership.php",
            data: data,
            method: "POST",
            processData: false,
            contentType: false,
            cache: false,
            success: function(response) {
                var data = JSON.parse(response);
                console.log(data);
                if (data.statusCode == 200) {
                    $("#NewMembershipForm input").not(':input[type=submit]').val("");
                    $('#membershipCoupons option[value="Yes"]').prop("selected", "selected");
                    $('#membershipgiveaway option[value="Yes"]').prop("selected", "selected");
                    $('#membershiptype option[value=""]').prop("selected", "selected");
                    $('#membershipduration option[value=""]').prop("selected", "selected");
                    toastr.success('Packaged successfully added.', 'Success!!');
                } else if (data.statusCode == 201) {
                    toastr.error('Failed to add package.', 'Failure!!');
                } else if (data.statusCode == 202) {
                    toastr.error('Invalid request.', 'Failure!!');
                } else if (data.statusCode == 203) {
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
            url: "database/addmembership.php",
            data: data,
            method: "POST",
            processData: false,
            contentType: false,
            cache: false,
            success: function(response) {
                var data = JSON.parse(response);
                console.log(data);
                if (data.statusCode == 200) {
                    toastr.success('Packaged successfully updated.', 'Success!!');
                } else if (data.statusCode == 201) {
                    toastr.error('Failed to update package.', 'Failure!!');
                } else if (data.statusCode == 202) {
                    toastr.error('Invalid request.', 'Failure!!');
                } else if (data.statusCode == 203) {
                    toastr.error('Empty fields found.', 'Failure!!');
                }
            }
        });
    });
});