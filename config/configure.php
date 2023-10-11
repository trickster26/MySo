<?php

// Database configuration
define('DB_HOST', 'MySQL_Database_Host');
define('DB_USERNAME', 'MySQL_Database_Username');
define('DB_PASSWORD', 'MySQL_Database_Password');
define('DB_NAME', 'MySQL_Database_Name');
define('DB_USER_TBL', 'users');

// Google API configuration
define('GOOGLE_CLIENT_ID', '485293457723-c3g3ofv6po6js0pubmrtattg9kh27mnu.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', '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');
define('GOOGLE_REDIRECT_URL', 'http://localhost:8000/ ');

// Start session
if(!session_id()){
    session_start();
}

// Include Google API client library
require_once '../vendor/google/apiclient/src/Client.php';
require_once 'google-api-php-client/contrib/Google_Oauth2Service.php';

// Call Google API
$gClient = new Client();
$gClient->setApplicationName('Login to CodexWorld.com');
$gClient->setClientId(GOOGLE_CLIENT_ID);
$gClient->setClientSecret(GOOGLE_CLIENT_SECRET);
$gClient->setRedirectUri(GOOGLE_REDIRECT_URL);

$google_oauthV2 = new Google_Oauth2Service($gClient);