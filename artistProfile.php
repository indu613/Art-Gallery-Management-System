<?php
session_start();
if (!isset($_SESSION['s_id'])) {
    header('Location: login.html');
    exit;
}
// Logout action
if (isset($_POST['logout'])) {
    // Unset all session variables
    session_unset();
    // Destroy the session
    session_destroy();
    // Redirect to the login page after logout
    echo "<script>window.location='login.html';alert('You are Logged Out!'); </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Artist Profile</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="path/to/your/stylesheet.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-image: url("images/artistpr.jpg");
            background-position: center;
            background-size: cover;
            color: white;
        }

        .header {
            padding: 5px;
            text-align: center;
            cursor: pointer;
            font-weight: bold;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .header h3 {
            font-size: 25px;
            color: #fff;
        }

        .details {
            display: flex;
            flex-direction: column; 
            align-items: center;
            padding: 10px;
        }

        .user-detail-box {
            background-color: rgba(137, 169, 237, 0.7);
            padding: 0px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            margin: 7px;
            text-align: center;
            transition: transform 0.3s, background-color 0.3s;
            cursor: pointer;
            width: 100%; /* Set width to 100% to take the full width */
            max-width: 400px;
        }

        .user-detail-box:hover {
            background-color: rgba(70, 91, 165, 0.9);
            transform: scale(1.05);
        }

        .user-detail-box h3 {
            font-weight: 500;
            color: #26474e;
        }

        .user-detail-box p {
            color: black;
        }

        #button-container {
            text-align: center;
            margin-top: 20px;
        }

        .button {
            font-family: 'Poppins', sans-serif;
            width: 100px;
            height: 20%;
            margin: 5px;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .logout-button {
            background-color: rgba(214, 99, 151, 0.8);
            color: black;
        }

        .logout-button:hover {
            background-color: rgba(196, 8, 124, 0.8);
        }

        .back-button {
            background-color: rgba(137, 169, 237, 0.8);
            color: black;
        }

        .back-button:hover {
            background-color: rgba(70, 91, 165, 0.8);
        }
    </style>
</head>
<body>
    <div class="header">
        <h3>Artist Profile</h3>
    </div>
    <div class="details">
        <?php
// Assuming you have a database connection
$servername = "localhost";
$un = "root";
$pw = "";
$dbname = "artg";

$conn = new mysqli($servername, $un, $pw, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user details from the 'seller' table using the stored seller ID
$seller_id = $_SESSION['s_id'];
$sql = "SELECT * FROM user WHERE userid = $seller_id";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    // Display user details on the page
    $name=$row['name'];
    $username = $row['uname'];
    $email = $row['email'];
    $contact = $row['contact'];

  
        echo '<div class="user-detail-box name-box">';
        echo '<h3>Name</h3>';
        echo "<p>$name</p>";
        echo '</div>';

        echo '<div class="user-detail-box email-box">';
        echo '<h3>Username</h3>';
        echo "<p>$username</p>";
        echo '</div>';

        echo '<div class="user-detail-box storename-box">';
        echo '<h3>Email</h3>';
        echo "<p>$email</p>";
        echo '</div>';

        echo '<div class="user-detail-box phone-box">';
        echo '<h3>Contact</h3>';
        echo "<p>$contact</p>";
        echo '</div>';
    }
    ?>        
    </div>
    <div id="button-container">
        <form method="post">
            <button class="button logout-button" name="logout"><a>Logout</a></button>
            <button class="button back-button"><a href="sam.php">Back</a></button>
        </form>
    </div>
</body>
</html>
