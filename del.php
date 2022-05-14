<?php
if (!isset($_SERVER['HTTP_REFERER'])) { //prevent user access the page through url
	echo "<h1>Access Denied!</h1>";
	echo "<br>";
	echo "<h1>Redirecting you to the main page in 3 seconds...</h1>";
	header("refresh:3; url=index.php");
	exit;
}
session_start();
?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Delete Assignment Record</title>
</head>

<body>
	<?php
	$currentUserId = $_SESSION["currentUserId"];
	include_once('includes/fragment/databaseConnection.php');
	$delSID = $_SESSION['delSID']; //get $_SESSION['del'] set in manager.php  this means we get $row[0]，which student id
	mysqli_query($mysqli, "delete from assignment where id = $delSID and user_id = $currentUserId ");
	unset($_SESSION['delSID']);
	$_SESSION['deleteSuccess'] = 'Deleted successfully!';
	$mysqli->close();
	header('location:manager.php');
	exit();
	?>
</body>

</html>