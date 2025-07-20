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
    
    // Check if the artwork exists
    $checkStmt = $conn->prepare("SELECT * FROM stock WHERE stockid = ?");
    $checkStmt->bind_param("i", $sid);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        // Artwork exists, proceed with deletion
        $deleteStmt = $conn->prepare("DELETE FROM stock WHERE stockid = ?");
        $deleteStmt->bind_param("i", $sid);

        if ($deleteStmt->execute()) {
            echo "<script>alert('Art Deleted!'); window.location='sam.php';</script>";
        } else {
            echo "Error: " . $deleteStmt->error;
        }

        $deleteStmt->close();
    } else {
        // Artwork does not exist, show an error message
        echo "<script>alert('Artwork not found!'); window.location='sam.php';</script>";
    }

    $checkStmt->close();
    $conn->close();
}
?>
