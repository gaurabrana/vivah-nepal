<?php
session_start();
include('google/config.php');
//Reset OAuth access token
$google_client->revokeToken();
session_destroy();
header("Location: index.php");
?>