<?php 
session_start();
include("connection.php");

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $query = "UPDATE users SET is_verified=TRUE, verification_token=NULL WHERE verification_token='$token'";
    mysqli_query($con, $query);

    $_SESSION['message'] = "Your account has been verified. You can now log in.";
    header("Location: adminlogin.php");
    die;
}
?>