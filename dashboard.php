<?php
if (!isset($_SESSION)) {
  session_start();
}
//Include Google Configuration File
include('admin/base/db.php');
include('google/config.php');
if (isset($_SESSION['user_id'])) {
  header("Location: index.php");
}

//This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received
if (isset($_GET["code"])) {
  //It will Attempt to exchange a code for an valid authentication token.
  $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

  //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
  if (!isset($token['error'])) {
    //Set the access token used for requests
    $google_client->setAccessToken($token['access_token']);

    //Store "access_token" value in $_SESSION variable for future use.
    $_SESSION['access_token'] = $token['access_token'];

    //Create Object of Google Service OAuth 2 class
    $google_service = new Google_Service_Oauth2($google_client);

    //Get user profile data from google
    $data = $google_service->userinfo->get();

    //Below you can find Get profile data and store into $_SESSION variable
    // print_r($data);
    if (!empty($data['given_name'])) {
      $user_first_name = $data['given_name'];
    }

    if (!empty($data['family_name'])) {
      $user_last_name = $data['family_name'];
    }

    if (!empty($data['email'])) {
      $user_email_address = $data['email'];
    }

    if (!empty($data['picture'])) {
      $user_image = $data['picture'];
    }

    if (!empty($data['id'])) {      
      $auth_id = $data['id'];      
      $_SESSION['oauth_provider'] = "google";
    }
    $name = $user_first_name . ' ' . $user_last_name;
    $oauth_provider = 'google';    
    $sqlForExisting = "SELECT id FROM users WHERE oauth_provider = '$oauth_provider' AND oauth_uid = '$auth_id'";
    $query = $conn->prepare($sqlForExisting);    
    $query->execute(); 
    $results = $query->fetch(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
      echo "fetching data";
      $_SESSION['user_id'] = $results->id;
      //Update user data if already exists
      echo "update data";      
      $crudquery = "UPDATE users SET name = '$name', email = '$user_email_address', picture = '$user_image' WHERE oauth_provider = '$oauth_provider' AND oauth_uid = '$auth_id'";
    } else {
      //Insert user data
      echo "insert data";
      $crudquery = "INSERT INTO users (oauth_provider , oauth_uid , name , email,picture) values ('$oauth_provider', '$auth_id',$name','$user_email_address', '$user_image')";      
    }
    $sqlPrepared = $conn->prepare($crudquery);
    $sqlPrepared->execute();
    
    if ($sqlPrepared) {      
	    // Get the ID of the inserted or updated row
    $user_id = $conn->lastInsertId(); // use lastInsertId() if INSERT statement is executed, or use $query->rowCount() if UPDATE statement is executed
    $_SESSION['user_id'] = $user_id;
      header('Location: index.php');
    }
  }
}
?>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>PHP Login using Google Account</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport' />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link href="css/custom.css" rel="stylesheet" type="text/css">
  <style>
    #modalButton{
      display: none;
    }
  </style>
</head>

<body>
<!-- Button trigger modal -->
<button id="modalButton" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Launch static backdrop modal
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Registering with Google Account</h1>        
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-8">
          Please wait until we create your profile. <br> You will be automatically redirected<span id="dot">.</span>
          </div>
          <div class="col-md-4">
            <img src="images/logo/large_black.png" class="logo-image">
          </div>
        </div>        
      </div>      
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script>
  const dot = document.getElementById("dot");
let count = 1;

setInterval(() => {
  if (count > 5) {
    count = 1;
  } else {
    dot.textContent = ".".repeat(count);
    count++;
  }
}, 200);

$(document).ready(function(){
  // $("#modalButton").click();
});
</script>
</body>
</html>