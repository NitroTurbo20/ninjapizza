<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory - Ninja Pizza</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            color: #fff;
            background: linear-gradient(to bottom right, #b62020, #000);
        }

        header {
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.7);
        }

        .logo img {
            height: 60px;
        }

        .logout {
            background-color: #b62020;
            border: none;
            padding: 10px 20px;
            color: white;
            font-size: 1em;
            font-weight: bold;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .logout:hover {
            background-color: #ef1111;
        }

        .container {
            display: flex;
            flex: auto;
            padding: 20px;
            gap: 20px;
        }

        .sidebar {
            width: 250px;
            height: 450px;
            background-color: rgba(0, 0, 0, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }

        .sidebar nav ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar nav ul li {
            margin: 15px 0;
        }

        .sidebar nav ul li a {
            color: white;
            text-decoration: none;
            padding: 15px;
            display: block;
            font-size: 1.2em;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
            transition: 0.3s;
        }

        .sidebar nav ul li a:hover {
            background-color: #b62020;
        }

        .dashboard-container {
            flex-grow: 1;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
            padding: 20px;
        }

        .dashboard-box {
            width: 250px;
            height: 180px;
            background-color: rgba(255, 255, 255, 0.1);
            border: 2px solid red;
            border-radius: 15px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.4);
            transition: transform 0.3s, background-color 0.3s;
            cursor: pointer;
        }

        .dashboard-box:hover {
            background-color: #b62020;
            transform: scale(1.1);
        }

        .dashboard-box h3 {
            font-size: 1.5em;
        }
    </style>
</head>
<body>

<header>
    <div class="logo">
        <img src="/login/images/njpz1.png" alt="Ninja Pizza Logo"> 
    </div>
    <button class="logout" onclick="logout()">Logout</button>
</header>

<div class="container">
    <aside class="sidebar">
        <h3>Inventory Dashboard</h3>
        <nav>
            <ul>
                <li><a href="items.php">Items</a></li>
                <li><a href="#">Category</a></li>
                <li><a href="try1.php">Warehouse</a></li>
                <li><a href="#">Orders</a></li>
                <li><a href="#">Members</a></li>
            </ul>
        </nav>
    </aside>

    <main class="dashboard-container">
        <div class="dashboard-box" onclick="showDetails('Total Items: 6')">
            <h3>Total Items</h3>
        </div>

        <div class="dashboard-box" onclick="showDetails('Total Categories: 8')">
            <h3>Total Categories</h3>
        </div>

        <div class="dashboard-box" onclick="showDetails('Total Sales: $12,566.28')">
            <h3>Total Sales</h3>
        </div>

        <div class="dashboard-box" onclick="showDetails('Total Products: 10')">
            <h3>Total Products</h3>
        </div>

        <div class="dashboard-box" onclick="showDetails('Paid Orders: 6')">
            <h3>Paid Orders</h3>
        </div>

        <div class="dashboard-box" onclick="showDetails('Unpaid Orders: 5')">
            <h3>Unpaid Orders</h3>
        </div>
    </main>
</div>

<script>
    
    function showDetails(message) {
        alert(message);
    }

    
    function logout() {
        if (confirm('Are you sure you want to log out?')) {
            window.location.href = 'logout.php'; 
        }
    }
</script>

</body>
</html>
