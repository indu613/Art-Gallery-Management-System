<?php
session_start();
if (!isset($_SESSION['s_id'])) {
    header('Location: login.html');
    exit;
}
$custID = $_SESSION['s_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <title>Orders</title>
    <style>
        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            background: linear-gradient(to right, #c5add4, rgb(197, 140, 214)); 
            color: #333;
            padding: 0px;
            text-align: center;
        }
        nav {
            background-color: rgba(0, 0, 0, 0.9);
            width: 100%;
            padding: 10px 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: fixed; /* Fix the navigation bar to the top */
            top: 0; /* Stick to the top */
            z-index: 1000;
        }
        .container {
            margin-top:200px;
        }
        .logo img {
            width: 100px;
            height: auto;
            border-radius: 50%;
            margin-left: 5px;
            float: left;
        }
        h2 {
            color: #000000;
            margin-bottom: 20px;
        }
        form {
            margin-top: 20px;
        }
        input[type="button"] {
            background-color: #000000;
            color: #fff;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
        }
        input[type="button"]:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
<nav>
    <div class="logo">
        <img src="images/logo3.png" alt="Logo">
    </div>
</nav>
<div class="container">
    <h2>Order Placed!</h2>
    <form action='orderFinal.php' method='post'>
    <input type="button" onclick="window.location.href='home.php';" value="Go To Homepage" />
    </form>
    <?php
    $conn = new mysqli("localhost", "root", "", "artg");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if (isset($_POST['confirmed'])) {

        // Update status in stock table to 'out_of_stock'
        $updateStockStatusQuery = "UPDATE stock JOIN cart ON stock.stockid = cart.stid SET stock.status = 'out_of_stock' WHERE cart.cid = ?";
        $stmtUpdateStockStatus = $conn->prepare($updateStockStatusQuery);
        $stmtUpdateStockStatus->bind_param("i", $custID);
        $stmtUpdateStockStatus->execute();

        // Clear the cart for the user
        $clearCartQuery = "DELETE FROM cart WHERE cid = ?";
        $stmtClearCart = $conn->prepare($clearCartQuery);
        $stmtClearCart->bind_param("i", $custID);
        $stmtClearCart->execute();
    }
    ?>
</div>
</body>
</html>
