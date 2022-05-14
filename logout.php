<?php
session_start();
if (!isset($_SESSION["currentUserId"])) { // if user not login can not logout
    echo "<body style='background-color:powderblue;text-align:center;'>";
    echo "<div>";
    echo "<h1>Please login first!</h1>";
    echo "<br>";
    echo "<h1>Redirecting you to the login page in 3 seconds...</h1>";
    echo "</div>";
    echo "<img src='images/lock.jpg' style='background-color:powderblue;' alt='access denied' width='660' height='345'>";
    echo "</body>";
    header("refresh:3; url=login.php");
    exit();
} else {
    if (isset($_SESSION['access_token'])) { // means you login with google
        require_once 'google-api-php-client--PHP7.4/vendor/autoload.php';

        $gClient =  new Google\Client();
        $gClient->setClientId('Your Client ID');
        $gClient->setClientSecret('Your Client Secret');
        $gClient->setApplicationName("Your app name");
        //redirect url must be the same as your google cloud console!
        $gClient->setRedirectUri('http://assignmentmanagerxxxxx.xxxxxxx.xxxxxxx.elasticbeanstalk.com/login.php');
        $gClient->setAccessType('offline');
        $gClient->setApprovalPrompt('force');
        $gClient->addScope('profile');
        $gClient->addScope('email');
        unset($_SESSION['access_token']);
        $gClient->revokeToken();
        unset($_SESSION["currentUserId"]);
        unset($_SESSION["user_name"]);
        unset($_SESSION["currentUserEmail"]);
        session_destroy();
        header("Location:login.php");
        exit();
    } else { // normal login with app
        unset($_COOKIE['idVariableFinal']);
        setcookie('idVariableFinal', '', time() - 3600, '/');
        unset($_COOKIE['user_nameVariableFinal']);
        setcookie('user_nameVariableFinal', '', time() - 3600, '/');
        unset($_COOKIE['emailVariableFinal']);
        setcookie('emailVariableFinal', '', time() - 3600, '/');

        unset($_SESSION["currentUserId"]);
        unset($_SESSION["user_name"]);
        unset($_SESSION["currentUserEmail"]);
        header("Location:login.php");
        exit();
    }
}
?>
