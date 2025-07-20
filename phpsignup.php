<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "artg";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$uname = $_POST['uname'];
$email = $_POST['email'];
$pwd = $_POST['pwd'];
$cont = $_POST['cont'];
$userType = $_POST['userType'];

$sql = "INSERT INTO user(name, uname, email,pwd, contact, usertype) VALUES ('$name','$uname','$email','$pwd', '$cont','$userType')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Signup success!'); window.location='login.html';</script>";
} 
else {
    echo "<script>alert('Username already exists!'); window.location='signup.html';</script>";
}

$conn->close();
?>
