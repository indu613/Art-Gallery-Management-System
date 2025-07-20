<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['uname'];
    $password = $_POST['pwd'];
    

    $servername = "localhost";
    $usr = "root";
    $pss = "";
    $dbname = "artg";

    $conn = new mysqli($servername, $usr, $pss, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM user WHERE uname='$username' AND pwd='$password' ";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $plaintextPassword = $row["pwd"];
        $userRole = $row["usertype"];
        $s_id= $row["userid"];

        if ($password === $plaintextPassword) {
            $_SESSION["uname"] = $username;
            $_SESSION["role"] = $userRole;
            $_SESSION["s_id"] = $s_id;

            $conn->close();

            if ($userRole === "adm") {
                header("Location: admin.php");
            } 
            elseif($userRole === "a") {
                echo "<script>alert('Artist Login Success!'); window.location='sam.php';</script>";
            }
            else{
                echo "<script>alert('Customer Login Success!'); window.location='home.php';</script>";
            }
            exit();
        } else {
            $error_message = "Invalid password. Please try again.";
        }
    } 
    else {
        // User login failed, show an error message or redirect back to the login page
        echo "<script>alert('Sorry,Username or password is incorrect'); window.location='login.html';</script>";
    }

    $conn->close();
}

if (isset($error_message)) {
    echo "<script>alert('Sorry,Username or password is incorrect'); window.location='login.html';</script>";
}
?>