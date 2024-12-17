<?php 
session_start();
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];

    if (!empty($email)) {
        $token = bin2hex(random_bytes(16));
        $query = "UPDATE users SET reset_token='$token' WHERE email='$email'";
        mysqli_query($con, $query);

        // Send reset link to email
        $resetLink = "http://yourwebsite.com/reset_password.php?token=$token";
        mail($email, "Password Reset", "Click this link to reset your password: $resetLink");

        $_SESSION['message'] = "Password reset link sent to your email.";
        header("Location: forgot_password.php");
        die;
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Forgot Password</title></head>
<body>
    <h2>Forgot Password</h2>
    <form method="post">
        <input type="email" name="email" placeholder="Enter your email" required>
        <button type="submit">Send Reset Link</button>
    </form>
    <?php if (isset($_SESSION['message'])) echo $_SESSION['message']; ?>
</body>
</html>