<?php
session_start(); // Start the session
if (!isset($_SESSION['s_id'])) {
    header('Location: login.html');
    exit;
}?>
<?php
if (isset($_POST['sub'])) { // Check if the form is submitted
    $servername = "localhost";
    $un = "root";
    $pw = "";
    $dbname = "artg";
    $conn = new mysqli($servername, $un, $pw, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $artname = $_POST['name'];
    $medium= $_POST['medium'];
    $genre=$_POST['genre'];
    $amount = $_POST['price'];
    $s_id = $_SESSION['s_id'];
    
    $image = $_FILES['image']['tmp_name'];
    $filename = $_FILES['image']['name'];
    $uploadDirectory = "./pics/"; // Specify the general upload directory

    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true); // Create the directory if it doesn't exist
    }
    $folder = $uploadDirectory . $filename; // Concatenate the directory and unique filename
    if (move_uploaded_file($image, $folder)) {
    $sql = "INSERT INTO stock (artistid,artname, medium, genre,price, image) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssds", $s_id, $artname, $medium, $genre, $amount, $folder);
    if ($stmt->execute()) {
        echo "<script>alert('Artwork added!'); window.location='sam.php';</script>";

    } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt->close();
}
else{
    echo"Failed to upload image";
}
    $conn->close();
}
?>
