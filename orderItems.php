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
            background: linear-gradient(to right, #348bdd, rgb(189, 60, 228)); 
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
            margin-top:140px;
        }
        .logo img {
            width: 100px;
            height: auto;
            border-radius: 50%;
            margin-left: 5px;
            float: left;
        }
        h2{
            color:white;
            margin-top:25px;
            margin-right:80px;
        }
        h3 {
            color: black;
            margin-bottom: 10px;
        }
        table {
            width: 70%;
            margin: 15px auto;
            border-collapse: collapse;
            padding:5px;
        }
        th, td {
            border: 1px solid #000000;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #333;
            color: #fff;
        }
        p{
            font-weight: bold;
            color: #000000;
        }
        form {
            margin-top: 20px;
        }
        button[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
        }
        button[type="submit"]:hover {
            background-color: #555;
        }
        .message {
            margin-top: -5px;
            color: rgb(12, 255, 12);
        }
        .error {
            margin-top: 20px;
            color: red;
        }
    </style>
</head>
<body>
<nav>
    <div class="logo">
        <img src="images/logo3.png" alt="Logo">
    </div>
    <h2>Order Details</h2>
</nav>
<div class="container">

<?php
$conn = new mysqli("localhost", "root", "", "artg");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['place_order'])) {
    // Retrieve cart items for the user
    $cartItemsQuery = "SELECT c.cartid, s.stockid, s.price FROM cart c
                       JOIN stock s ON c.stid = s.stockid
                       WHERE c.cid = ?";
    $stmtCartItems = $conn->prepare($cartItemsQuery);
    $stmtCartItems->bind_param("i", $custID);
    $stmtCartItems->execute();
    $resultCartItems = $stmtCartItems->get_result();

    // Calculate the total amount
    $totalAmount = 0;
    while ($cartItem = $resultCartItems->fetch_assoc()) {
        $totalAmount += $cartItem['price'];
    }
    $stmtCartItems->close();
    // Insert order into orders table
    $orderId = $_SESSION['order_id'];
    $updateOrderQuery = "UPDATE orders SET amount = ? WHERE orderid = ?";
    $stmtUpdateOrder = $conn->prepare($updateOrderQuery);
    $stmtUpdateOrder->bind_param("di", $totalAmount, $orderId);
    $stmtUpdateOrder->execute();

    echo "Order placed successfully! Order ID: $orderId";
}
    $retrieveOrdersQuery = "SELECT MAX(o.orderid) as orderid, o.orderdate, SUM(o.amount) as amount, s.artname, s.price as artwork_price
    FROM orders o 
    JOIN cart c ON o.custid = c.cid JOIN stock s 
    ON c.stid = s.stockid
    WHERE o.custid = ?
    GROUP BY s.artname";


    $stmtRetrieveOrders = $conn->prepare($retrieveOrdersQuery);
    $stmtRetrieveOrders->bind_param("i", $custID);
    $stmtRetrieveOrders->execute();
    $resultOrders = $stmtRetrieveOrders->get_result();?>
    <h3>Your Orders:</h3>
    <?php if ($resultOrders->num_rows > 0) : ?>
        <table>
            <tr>
                <th>Artwork Name</th>
                <th>Artwork Price</th>
            </tr>
            <?php
            while ($order = $resultOrders->fetch_assoc()) :
            ?>
                <tr>
                    <td><?php echo $order['artname']; ?></td>
                    <td><?php echo $order['artwork_price']; ?></td>
                </tr>
            <?php
            endwhile;
            ?>
        </table>
        <?php if ($totalAmount > 0) : ?>
            <div class="message">
                Total Price: Rs. <?php echo $totalAmount; ?>
            </div>
        <?php 
        $shippingDetailsQuery = "SELECT s_fullname, s_address, s_city, s_pincode, s_phone
        FROM orders
        WHERE custid = ?
        ORDER BY orderid DESC
        LIMIT 1";  // Select the latest order for the customer

        $stmtShippingDetails = $conn->prepare($shippingDetailsQuery);
        $stmtShippingDetails->bind_param("i", $custID);
        $stmtShippingDetails->execute();
        $resultShippingDetails = $stmtShippingDetails->get_result();

        if ($resultShippingDetails->num_rows > 0) {
        $shippingDetails = $resultShippingDetails->fetch_assoc();
        ?>
        <h3>Shipping Details:</h3>
        <p>Full Name: <?php echo $shippingDetails['s_fullname']; ?></p>
        <p>Address: <?php echo $shippingDetails['s_address']; ?></p>
        <p>City: <?php echo $shippingDetails['s_city']; ?></p>
        <p>Pincode: <?php echo $shippingDetails['s_pincode']; ?></p>
        <p>Phone: <?php echo $shippingDetails['s_phone']; ?></p>
        <?php
        } else {
        echo "<div class='error'>No shipping details found.</div>";
        }

        $stmtShippingDetails->close();
        ?>
     
    <?php endif; ?>

    <?php else : ?>
        <div class="error">
            No orders found.
        </div>
    <?php endif; ?>

    <form action="orderFinal.php" method="post">
        <button type="submit" name="confirmed" value="Place Order">Confirm</button>
    </form>
    </div>
</body>
</html>
