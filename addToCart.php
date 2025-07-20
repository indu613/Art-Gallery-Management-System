<?php
session_start();

if (!isset($_SESSION['s_id'])) {
    header('Location: login.html');
    exit;
}

if (isset($_POST['addToCart'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "artg";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $stockId = $_POST['stockId'];
    $userId = $_SESSION['s_id'];

    // Check if the product is already in the cart
    $checkSql = "SELECT * FROM cart WHERE cid = ? AND stid = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("ii", $userId, $stockId);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows == 0) {
        // Product is not in the cart, insert it
        $insertSql = "INSERT INTO cart (cid, stid) VALUES (?, ?)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("ii", $userId, $stockId);

        if ($insertStmt->execute()) {
            $updateSql = "UPDATE stock SET status = 'in_cart' WHERE stockid = ?";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bind_param("i", $stockId);
            $updateStmt->execute();
            $updateStmt->close();
            $_SESSION['success_message'] = 'Product added to cart successfully!';
        } else {
            $_SESSION['error_message'] = 'Error adding product to cart';
        }
        $insertStmt->close();
    } else {
        $_SESSION['error_message'] = 'Product is already in the cart';
    }

    $checkStmt->close();
    $conn->close();
    header("Location: artworks.php");
    exit;
}
?>