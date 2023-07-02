$(document).ready(function(){
  

$(".addSubImages").on('click', function() {
    console.log("clicked");
    $("#imageSub").click();
});
var ajaxup = {
    // (A) ADD TO UPLOAD QUEUE
    queue: [], // upload queue
    add: function(a) {
        var element = "imageSub";        
        for (let f of document.getElementById(element).files) {
            ajaxup.queue.push(f);
        }
        $("#" + element).val("");
        if (!ajaxup.uploading) { ajaxup.go(a); }
        return false;
    },
    // (B) AJAX UPLOAD
    uploading: false, // upload in progress
    go: function(a) {
        // (B1) UPLOAD ALREADY IN PROGRESS
        ajaxup.uploading = true;
        // (B2) FILE TO UPLOAD
        var data = new FormData();               
        data.append("imageSub", ajaxup.queue[0]);
        // APPEND MORE VARIABLES IF YOU WANT
        // data.append("KEY", "VALUE");
        // (B3) AJAX REQUEST
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "image_upload.php");
        xhr.onload = function() {
            var path = JSON.parse(this.response);
            if (path.code == 200) {                 
                    document.getElementById("upstat").innerHTML += '<div id="imageIdentifier' + path.name + '" class="col-lg-3 col-md-4 col-sm-6 mb-2 uploaded-images">' +
                        '<img src = "' + path.imagePath + '" alt = "uploaded product image"><div class="deleteImage"><input type="hidden" value="' + path.imagename + '">' +
                        '<i id="SameimageIdentifier' + path.name + '" class="fa fa-minus-circle fa-2x"></i></div></div>';                
            } else if (path.code == 201) {                
            document.getElementById("upstat").innerHTML += '<div class="col-lg-3 mb-2 uploaded-images"><span>' + path.error + '</span></div>';             
            }
            // (B5) NEXT FILE
            ajaxup.queue.shift();
            if (ajaxup.queue.length != 0) { ajaxup.go(a); } else { ajaxup.uploading = false; }
        };

        // (B6) GO!
        xhr.send(data);
    }
}
$("#imageSub").change(function() {
    ajaxup.add("sub");
});

$(document).on("click", ".deleteImage i", function(e) {
    let getID = $(this).attr("id");
    let imageHolderID = getID.split("SameimageIdentifier")[1];
    let imagePath = $("#imageIdentifier" + imageHolderID + " img").attr("src");
    let resultHolder = $("#hold-image-result");
    $.ajax({
        url: "deletefile.php",
        method: "POST",
        data: { filepath: imagePath },
        cache: false,
        success: function(result) {
            var resultcode = JSON.parse(result);
            var resultcolor;
            $(resultHolder).css("display", "block");
            if (resultcode.code == 200) {
                $("#imageIdentifier" + imageHolderID).remove();
                $(resultHolder).text("Image deleted successfully.");
                resultcolor = "alert-success";
            } else if (resultcode.code == 201) {
                $(resultHolder).text("Failed to delete image. Please try again");
                resultcolor = "alert-danger";
            }
            $(resultHolder).addClass(resultcolor);
            $(resultHolder)
                .delay(3000)
                .queue(function(next) {
                    $(resultHolder).removeClass(resultcolor);
                    $(this).css('display', 'none');
                    next();
                });
        }
    });
});
});