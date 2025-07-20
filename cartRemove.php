<?php
// remove_from_cart.php

session_start();

// Check if the seller ID is stored in the session
if (!isset($_SESSION['s_id'])) {
    // Seller is not logged in, redirect to the login page
    header('Location: login.html');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Replace with actual database connection details
    $servername = "localhost";
    $un = "root";
    $pw = "";
    $dbname = "artg";

    // Create a database connection
    $conn = new mysqli($servername, $un, $pw, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the cart item ID and stock ID from the form submission
    $cartItemId = $_POST['cartid'];
    $stockId = $_POST['stockid'];

    // Perform the removal from the cart and update stock status
    $deleteCartSql = "DELETE FROM cart WHERE cartid = ?";
    $stmtDeleteCart = $conn->prepare($deleteCartSql);
    $stmtDeleteCart->bind_param("i", $cartItemId);
    $stmtDeleteCart->execute();
    $stmtDeleteCart->close();

    $updateStockSql = "UPDATE stock SET status = 'available' WHERE stockid = ?";
    $stmtUpdateStock = $conn->prepare($updateStockSql);
    $stmtUpdateStock->bind_param("i", $stockId);
    $stmtUpdateStock->execute();
    if ($stmtUpdateStock->execute()) {
        echo "Stock status updated successfully!";
    } else {
        echo "Error updating stock status: " . $stmtUpdateStock->error;
    }
    $stmtUpdateStock->close();

    $conn->close();

    // Redirect back to the shopping cart page
    header('Location:cart.php');
    exit;
} else {
    // Invalid request method, redirect to the shopping cart page
    header('Location: cart.php');
    exit;
}
?>
