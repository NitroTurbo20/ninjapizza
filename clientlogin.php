<?php 
session_start();

include("connection.php");
include("functions.php");

// Default page for the login form is 'adminlogin.php'
$loginPage = "adminlogin.php"; 

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Something was posted
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $login_type = $_POST['login_type']; // Get the login type (adminlogin or clientlogin)

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {

        // Read from database based on the login type (admin or client)
        $query = "SELECT * FROM users WHERE user_name = '$user_name' LIMIT 1";
        $result = mysqli_query($con, $query);

        if ($result) {
            if ($result && mysqli_num_rows($result) > 0) {

                $user_data = mysqli_fetch_assoc($result);

                if ($user_data['password'] === $password) {
                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: index.php");
                    die;
                }
            }
        }
        // If username/password is incorrect, set an error and redirect with a pop-up
        $_SESSION['error'] = "Wrong username/password";
        header("Location: $loginPage");  // Redirect to the selected login page
        die;
    } else {
        $_SESSION['error'] = "Please fill in all fields correctly!";
        header("Location: $loginPage");
        die;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style type="text/css">
        /* General reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #f5f5dc, #d1c8b8); /* Soft gradient background */
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
        }

        .form-container {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px 30px;
            width: 360px;
            text-align: center;
        }

        .logo-container {
            margin-bottom: 30px;
        }

        .logo {
            width: 120px; /* Adjust logo size */
            display: block;
            margin: 0 auto;
        }

        .toggle-switch {
            position: relative;
            margin-bottom: 20px;
        }

        #toggle {
            display: none;
        }

        .switch-label {
            display: block;
            width: 70px;
            height: 35px;
            background-color: #ccc;
            border-radius: 35px;
            cursor: pointer;
            position: relative;
            transition: background-color 0.3s ease;
        }

        .switch-label::after {
            content: '';
            position: absolute;
            top: 4px;
            left: 4px;
            width: 27px;
            height: 27px;
            background-color: #6f4c3e;
            border-radius: 50%;
            transition: transform 0.3s ease;
        }

        #toggle:checked + .switch-label::after {
            transform: translateX(35px);
        }

        #toggle:checked + .switch-label {
            background-color: #6f4c3e;
        }

        h2 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: #6f4c3e;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        input:focus {
            border-color: #6f4c3e;
            box-shadow: 0 0 10px rgba(111, 76, 62, 0.2);
        }

        button {
            width: 100%;
            padding: 12px;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #5b3e33;
        }

        a {
            text-decoration: none;
            color: #6f4c3e;
            font-size: 1rem;
        }

        a:hover {
            text-decoration: underline;
        }

        .footer {
            position: absolute;
            bottom: 20px;
            font-size: 0.9rem;
            color: #888;
        }

        footer p {
            margin: 0;
        }

        #register-link {
            color: #6f4c3e;
            text-decoration: none;
            font-size: 1rem;
        }

        #register-link:hover {
            text-decoration: underline;
        }

        .eye-icon {
            position: absolute;
            top: 40%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 18px;
            color: #aaa;
        }

        .password-container {
            position: relative;
        }
        #button {
    padding: 10px;
    width: 100%;
    color: white;
    background-color: #b30000; /* Dark red shade */
    border: none;
}
    </style>
</head>
<body>

<div class="container">
    <div class="form-container">
        <div class="logo-container">
            <img src="/login/images/njpz.png" alt="Logo" class="logo"> <!-- Your logo here -->
        </div>
        <div id="box">
            <form method="post" id="loginForm">
                <div style="font-size: 20px;margin: 10px;color: black;" id="loginTypeLabel">Admin</div>

                <!-- Show error message if exists -->
                <?php
                if (isset($_SESSION['error'])) {
                    echo "<script>alert('" . $_SESSION['error'] . "');</script>";
                    unset($_SESSION['error']);  // Clear the error message after showing the alert
                }
                ?>

                <!-- Hidden field to specify login type -->
                <input type="hidden" name="login_type" id="loginType" value="adminlogin">

                <!-- Toggle switch to change between admin and client login -->
                <div class="toggle-switch">
                    <input type="checkbox" id="toggle" />
                    <label for="toggle" class="switch-label"></label>
                </div>

                <input id="text" type="text" name="user_name" placeholder="Username"><br><br>

                <!-- Password field with Eye Icon -->
                <div class="password-container">
                    <input id="password" type="password" name="password" placeholder="Password"><br><br>
                    <span class="eye-icon" id="togglePassword">&#128065;</span> <!-- Eye Icon -->
                </div>

                <input id="button" type="submit" value="Login"><br><br>
                <a href="signup.php">Sign up New account</a><br><br>
            </form>
        </div>
    </div>
</div>

<script>
    // Toggle password visibility
    const togglePassword = document.querySelector("#togglePassword");
    const passwordField = document.querySelector("#password");

    togglePassword.addEventListener("click", function() {
        const type = passwordField.type === "password" ? "text" : "password";
        passwordField.type = type;

        this.innerHTML = type === "password" ? "&#128065;" : "&#128063;"; // Eye icon change
    });

    // Toggle between admin and client login when switch is toggled
    const toggleSwitch = document.querySelector("#toggle");
    const loginTypeInput = document.querySelector("#loginType");
    const loginTypeLabel = document.querySelector("#loginTypeLabel");
    const loginForm = document.querySelector("#loginForm");

    toggleSwitch.addEventListener("change", function() {
        if (toggleSwitch.checked) {
            loginTypeInput.value = "clientlogin"; // Switch to client login
            loginTypeLabel.textContent = "Client"; // Change label to 'Client'

            // Dynamically change the form action to clientlogin.php
            loginForm.action = "clientlogin.php";
        } else {
            loginTypeInput.value = "adminlogin"; // Switch back to admin login
            loginTypeLabel.textContent = "Admin"; // Change label to 'Admin'

            // Change the form action to adminlogin.php
            loginForm.action = "clientlogin.php";
        }
    });
</script>

</body>
</html>
