<?php
if (!isset($_SERVER['HTTP_REFERER'])) { //prevent user access the page through url
    echo "<h1>Access Denied!</h1>";
    echo "<br>";
    echo "<h1>Redirecting you to the main page in 3 seconds...</h1>";
    header("refresh:3; url=index.php");
    exit;
}
session_start();
include_once('includes/fragment/databaseConnection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$currentUserId = $_SESSION["currentUserId"];
$currentUserEmail = $_SESSION["currentUserEmail"];
$currentUser_name = $_SESSION["user_name"];

$res = mysqli_query($mysqli, "select name,category,due_date from assignment
where user_id=$currentUserId and status=0 and due_date <= DATE_ADD(CURDATE(),INTERVAL 1 WEEK) and due_date >= CURDATE()");
// only select those not completed assignment which is status is 0
$messageToSend = "";
$messageSubject = "";
$nothing = false;
if (mysqli_num_rows($res) == 0) { // means no assignment need to submit in 1 week
    $nothing = true;
    $messageToSend = "Good job, looks like you don't have any assignments to submit in the coming week!";
    $messageSubject = "🎉Congratulations🎉";
} else {
    $messageToSend = "Please see below for a list of assignments that need to be submitted in the coming week. Check your Manager for details!";
    $messageSubject = "📖Assignments you need to submit for the coming week📖";
}
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
$body = "<p>$messageToSend</p>";
if (!$nothing) { // if have un coming assignments
    $body .= "<br>";
    $body .= "<table align='center' border='1px' cellspacing='0px'>
<tr>
<th>Assignment Name</th>
<th>Assignment Category</th>
<th>Assignment Due date</th>
</tr>";

    while ($row = mysqli_fetch_array($res)) { // you can't just do $row separately must be in the
        //while()
        $body .= "<tr align='center'>";
        $body .= "<td>$row[0]</td>";
        $body .= "<td>$row[1]</td>";
        $body .= "<td style='color:red;'>$row[2]</td>";
        $body .= "</tr>";
    }

    $body .= "</table>";
}

//Server settings
$mail->SMTPDebug = SMTP::DEBUG_SERVER;
$mail->isSMTP();
$mail->CharSet = 'UTF-8';
$mail->Host       = 'smtp.gmail.com';
$mail->SMTPAuth   = true;
$mail->Username   = 'send from your custom email';
$mail->Password   = 'password of your gmail account';
$mail->SMTPSecure = 'ssl';
$mail->Port       = 465;
$mail->SetFrom('donotreply@donotreply.com', 'Assignments Manager');
$mail->addAddress("$currentUserEmail", "$currentUser_name");
$mail->addReplyTo('donotreply@donotreply.com', 'DO-NOT-REPLY');

//Content
$mail->isHTML(true);
$mail->Subject = "$messageSubject";
$mail->Body    = $body;
$status = $mail->send();
if ($status) {
    $currentSentDate = date('Y-m-d');
    $_SESSION["emailSentStatus"] = "Email sent successfully! $currentSentDate | If you don't see it, Please make sure your registered email address is correct or check your spam thank you.";
} else {
    $mailSentFailMessage = $mail->ErrorInfo;
    $_SESSION["emailSentStatus"] = "Mail delivery failed! Error message: $mailSentFailMessage";
}
$mysqli->close();
header('location:manager.php');
exit();
?>
