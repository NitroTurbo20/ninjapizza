<?php 
session_start();
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $password = $_POST['password'];
    $token = $_POST['token'];

    if (!empty($password) && !empty($token)) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $query = "UPDATE users SET password='$hashedPassword', reset_token=NULL WHERE reset_token='$token'";
        mysqli_query($con, $query);

        $_SESSION['message'] = "Password successfully reset.";
        header("Location: adminlogin.php");
        die;
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Reset Password</title></head>
<body>
    <h2>Reset Password</h2>
    <form method="post">
        <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
        <input type="password" name="password" placeholder="Enter new password" required>
        <button type="submit">Reset Password</button>
    </form>
    <?php if (isset($_SESSION['message'])) echo $_SESSION['message']; ?>
</body>
</html>