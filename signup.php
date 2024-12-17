<?php 
session_start();
include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    //something was posted
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
    {
        // Save to database
        $user_id = random_num(20);
        $query = "insert into users (user_id,user_name,password) values ('$user_id','$user_name','$password')";

        if (mysqli_query($con, $query)) {
            // If signup is successful, display popup message
            echo "<script>
                    alert('Account created successfully!');
                    window.location.href = 'adminlogin.php';  // Redirect to login page after alert
                  </script>";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($con);
        }
        die;
    } else {
        echo "Please enter some valid information!";
    }
}

	
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <style type="text/css">
        #text{
            height: 25px;
            border-radius: 5px;
            padding: 4px;
            border: solid thin #aaa;
            width: 100%;
        }

        #button{
            padding: 10px;
            width: 100px;
            color: white;
            background-color: #800000;
            border: none;
        }

        #box{
            background-color: #fff;
            margin: auto;
            width: 300px;
            padding: 20px;
        }

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
            background-color: #6f4c3e;
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
    </style>
</head>
<body>
	
    <div id="box">
        <form method="post">
            <div style="font-size: 20px;margin: 10px;color: black;">Signup</div>
            <input id="text" type="text" name="user_name" placeholder="Username"><br><br>
            <input id="text" type="password" name="password" placeholder="Password"><br><br>
            <input id="button" type="submit" value="Signup"><br><br>
            <a href="adminlogin.php">Back to Login</a><br><br>
        </form>
    </div>
</body>
</html>

