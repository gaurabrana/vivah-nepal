<?php
 
//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';
 
//Make object of Google API Client for call Google API
$google_client = new Google_Client();
 
//Set the OAuth 2.0 Client ID
$google_client->setClientId('1001924388940-o053jmn7hbhnve7hn1pkit9j27va5d8c.apps.googleusercontent.com');
 
//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');
 
//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/vivahnepal/dashboard.php');
 
//
$google_client->addScope('email');
 
$google_client->addScope('profile');
 
?>