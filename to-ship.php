<?php 
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

// Fetch orders that are "to-ship" from the database
$query = "SELECT * FROM orders WHERE status = 'to-ship'";
$result = mysqli_query($con, $query);
$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Function to update the status of an order
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    // Update the order status in the database
    $update_query = "UPDATE orders SET status = ? WHERE order_id = ?";
    $stmt = mysqli_prepare($con, $update_query);
    mysqli_stmt_bind_param($stmt, 'si', $status, $order_id);
    mysqli_stmt_execute($stmt);

    // Redirect back to the to-ship page
    header('Location: to-ship.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Ship Orders - Ninja Pizza</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .header {
            background-color: #dc1e1ee6;
            color: white;
        }
        .header-container {
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.7);
        }
        .logo {
            font-size: 2rem;
        }
        .nav-links {
            list-style-type: none;
            display: flex;
            align-items: center;
        }
        .nav-links li {
            margin-left: 20px;
        }
        .order-list {
            margin: 20px;
        }
        .order-item {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .order-item h3 {
            margin: 0;
        }
        .order-item .order-details {
            margin-top: 10px;
        }
        .order-item .order-status {
            margin-top: 15px;
            font-weight: bold;
        }
        .action-buttons {
            margin-top: 10px;
        }
        .action-buttons button {
            padding: 10px 15px;
            margin-right: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .action-buttons button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<header class="header">
    <div class="header-container">
        <h1 class="logo">Ninja Pizza</h1>
        <nav>
            <ul class="nav-links">
                <li><a href="index.php" class="nav-link"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="to-ship.php" class="nav-link"><i class="fa fa-truck"></i> To Ship</a></li>
                <li><a href="index.php" class="nav-link"><i class="fa fa-shopping-cart"></i> Orders</a></li>
            </ul>
        </nav>
    </div>
</header>

<main class="order-list">
    <h2>Orders To Ship</h2>

    <?php if (empty($orders)): ?>
        <p>No orders are ready to be shipped.</p>
    <?php else: ?>
        <?php foreach ($orders as $order): ?>
            <div class="order-item">
                <h3>Order #<?php echo $order['order_id']; ?></h3>
                <div class="order-details">
                    <p><strong>Customer:</strong> <?php echo $order['customer_name']; ?></p>
                    <p><strong>Items:</strong> <?php echo $order['items']; ?></p>
                    <p><strong>Total Price:</strong> ₱<?php echo number_format($order['total_price'], 2); ?></p>
                </div>
                <div class="order-status">
                    <p><strong>Status:</strong> <?php echo ucfirst($order['status']); ?></p>
                </div>

                <form method="POST" class="action-buttons">
                    <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                    <button type="submit" name="status" value="shipped">Mark as Shipped</button>
                    <button type="submit" name="status" value="delivered">Mark as Delivered</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

</main>

<footer>
   <p>&copy;2024 Ninja Pizza. All rights reserved.</p> 
</footer>

</body>
</html>
