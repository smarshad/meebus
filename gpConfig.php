<?php
session_start();

//Include Google client library 
include_once 'src/Google_Client.php';
include_once 'src/contrib/Google_Oauth2Service.php';

/*
 * Configuration and setup Google API
 */
$clientId = '893428947864-l1qca7fk42bfb7a0hnlgo7lbsiqv9v2e.apps.googleusercontent.com'; //Google client ID
$clientSecret = 'nT6YNO50MveWts9HtbQOnKHj'; //Google client secret
$redirectURL = 'https://localhost/google_login/index.php'; //Callback URL

//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('localhost');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>