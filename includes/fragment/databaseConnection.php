<?php
$db_host = 'Your AWS RDS instance end point';
$db_user = 'Your user name created in AWS RDS instance';
$db_password = 'Your password created in AWS RDS instance';
$db_db = 'Your database name';
$db_port = "xxx"; // your port name without ""

$mysqli = @new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_db,
    $db_port
);
// If connection failed, echo detail error message
if ($mysqli->connect_error) {
    echo 'Errno: ' . $mysqli->connect_errno;
    echo '<br>';
    echo 'Error: ' . $mysqli->connect_error;
    exit();
}
?>
