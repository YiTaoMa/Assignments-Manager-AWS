<?php
//part of login!!!!!
session_start();
require_once 'google-api-php-client--PHP7.4/vendor/autoload.php';
$loginButton = '';
$gClient =  new Google\Client();
//clientId and secret must be same as your google cloud console
$gClient->setClientId('Your Client ID');
$gClient->setClientSecret('Your Client Secret');
$gClient->setApplicationName("Your app name");// from google console
//redirect url must be the same as your google cloud console!
$gClient->setRedirectUri('http://assignmentmanagerxxxxx.xxxxxxx.xxxxxx.elasticbeanstalk.com/login.php');
$gClient->setAccessType('offline');
$gClient->setApprovalPrompt('force');
$gClient->addScope('profile');
$gClient->addScope('email');

if (isset($_GET['code'])) { //receive user information, means the user is login with google
	$token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
	$_SESSION["access_token"] = $token;
	$gClient->setAccessToken($token); //this may give http 500 error because the client id and secret key is not match with your google cloud console!
	$oAuth = new Google\Service\Oauth2($gClient);
	$userData = $oAuth->userinfo->get();
	$_SESSION["currentUserId"] = $userData->id;
	$_SESSION["currentUserEmail"] = $userData->email;
	$_SESSION["user_name"] = $userData->givenName;

	if (isset($_SESSION["currentUserId"])) {
		header('Location:manager.php');
		exit();
	}
} else {
	$loginButton = '<a class="googleLogin" href="' . $gClient->createAuthUrl() . '">Login with Google</a>';
}
?>
