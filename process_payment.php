<?php
session_start();

if (!isset($_SESSION['s_id'])) {
    header('Location: login.html');
    exit;
}

if (!isset($_POST['card_owner'], $_POST['card_number'], $_POST['expiry'], $_POST['cvv'], $_POST['order_id'])) {
    // Redirect if payment information is missing
    header('Location: payment_page.php');
    exit;
}   ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <title>Payment Confirmation</title>
    <style>
        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #47065c, rgb(3, 70, 153));
            background-position: center;
            background-size: cover;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #fff;
        }

        nav {
            background-color: rgba(0, 0, 0, 0.8);
            width: 100%;
            padding: 10px 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: fixed; /* Fix the navigation bar to the top */
            top: 0; /* Stick to the top */
            z-index: 1000;
        }

        .logo img {
            width: 100px;
            height: auto;
            border-radius: 50%;
            margin-left: 5px;
            float: left;
        }

        h2 {
            margin-right: 75px;
            margin-top: 25px;
        }

        .container {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
            margin-top: 30px;
        }

        p {
            margin-bottom: 15px;
        }

        button {
            background-color: #6a2652;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #000000;
        }
    </style>
</head>
<body>
<nav>
    <div class="logo">
        <img src="images/logo3.png" alt="Logo">
    </div>
    <h2>Payment Confirmation</h2>
</nav>
<div class="container">
    <?php
    $conn = new mysqli('localhost', 'root', '', 'artg');
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $card_owner = $_POST['card_owner'];
    $card_number = $_POST['card_number'];
    $expiry = $_POST['expiry'];
    $cvv = $_POST['cvv'];
    $order_id = $_POST['order_id'];
    
    // Check if payment details are present in the database
    $sql = "SELECT * FROM payment WHERE card_no = '$card_number' AND expiry = '$expiry' AND cvv = '$cvv'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // Payment details are valid, show the confirmation page
        ?>
        <p>Your payment was successful!</p>
        <p>Order ID: <?php echo $order_id; ?></p>
        <form action='orderItems.php' method='post' onsubmit="return confirmOrder()">
        <button type='submit' name="place_order" class='orderB'>Proceed</button>
        </form>
        <?php
    } else {
        // Payment details are not valid, handle it accordingly
        $orderId = $_SESSION['order_id'];
        $deleteSql = "DELETE FROM orders WHERE orderid = $orderId";
        $conn->query($deleteSql);
        echo "<script>alert('Invalid payment details. Please check your card information.'); window.location='payment.php';</script>";
    }
    ?>
</div>
</body>
</html>
