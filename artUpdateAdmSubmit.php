<?php
session_start();

if (!isset($_SESSION['s_id'])) {
    header('Location: login.html');
    exit;
}

if (isset($_POST['sub'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "artg";

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sid = $_POST['sid'];
    $amount = $_POST['price'];

    // Check if the specified stock ID exists
    $checkStmt = $conn->prepare("SELECT * FROM stock WHERE stockid = ?");
    $checkStmt->bind_param("i", $sid);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    $checkStmt->close();

    if ($checkResult->num_rows === 0) {
        // Stock ID doesn't exist, show an error message or redirect
        echo "<script>alert('Artwork with ID $sid not found!'); window.location='sam.php';</script>";
        exit();
    }

    // Use a prepared statement to prevent SQL injection
    $updateStmt = $conn->prepare("UPDATE stock SET price = ? WHERE stockid = ?");
    $updateStmt->bind_param("di", $amount, $sid);

    if ($updateStmt->execute()) {
        echo "<script>alert('Price modified!'); window.location='admin.php';</script>";
    } else {
        echo "Error: " . $updateStmt->error;
    }

    $updateStmt->close();
    $conn->close();
}
?>
