<?php
session_start();
if (isset($_SESSION['s_id'])) {
    $loggedIn=true;
} else {
    $loggedIn=false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <title>Artists Page</title>
    <style>
        *{
    font-family: 'Poppins', sans-serif;
}
body {
    background: linear-gradient(to right, #6e2d05, rgb(43, 20, 8)); /* You can replace these colors with your desired gradient */
    background-position: center;
    background-size: cover;
    height: 100vh; /* Ensure full height of the viewport */
    margin: 0; /* Remove default margin */
    font-family: 'Poppins', sans-serif;
}

body, ul {
    margin: 0;
    padding: 0;
}

/* Style the navigation bar */
nav {
    display: flex;
    justify-content: space-between; /* Align logo to the left, rest to the right */
    align-items: center;
    padding:10px;
    width: 100%;
    height:80px;
}

/* Style the logo */
.logo img {
    width:100px; /* Adjust the width as needed */
    height: auto;
    border-radius: 80px;
    margin-top: 20px;
}

/* Style the navigation links */
.nav-links {
    list-style: none;
    display: flex;
    font-size:21px;
}

.nav-links li {
    margin: 0 20px;
    padding:10px;
    
}

.nav-links li a {
    text-decoration:none;
    color:#ffffff;
    display: inline-block;
    position: relative;
    transform-style: preserve-3d;
    transition: 0.3s ease;
}
.nav-links li a:hover{
    background-color: #000000;
}   
a:hover, a:focus {
    font-weight: bold;
    transform: scale(1.2);
} 

h2 {
    color: #333;
    text-align: center;
}

.artist-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

.artist-card {
    background-color:khaki;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    text-align: center;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out;
    width: 300px;
    margin: 10px;
}

.artist-card:hover {
    transform: scale(1.05);
}

.artist-card img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin-top: 10px;
}

.no-image {
    max-width: 100%;
    height: auto;
    max-height: 150px; /* Adjust as needed */
    object-fit: cover;
    border-radius: 8px;
    margin-top: 10px;
}
    </style>
    <script>
    function redirectToHome() {
        var isLoggedIn = <?php echo $loggedIn ? 'true' : 'false'; ?>;
        if (isLoggedIn) {
            window.location.href = "home.php"; 
        } else {
            window.location.href = "home.html"; 
        }
    }
    </script>
</head>
<body>
    <nav>
        <div class="logo">
            <img src="images/logo3.png" alt="Logo" width="80px" height="80px" >
        </div>
        <ul class="nav-links">
            <li><a href="#" onclick="redirectToHome();">Home</a></li>
        </ul>
    </nav>
    <h1 style="color:white"; "align:center">Artists</h1>
<div class="artist-container">
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "artg";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql ="SELECT u.userid, u.name AS artist_name, s.image, s.artname AS img_name FROM user u LEFT JOIN stock s ON u.userid = s.artistid
    WHERE u.usertype = 'a' GROUP BY u.userid";
    

    $result = $conn->query($sql);
    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        while ($row=$result->fetch_assoc()) {
            $userId=$row['userid'];
            $artistName=$row['artist_name'];
            $artImage=$row['image'];
            $artName=$row['img_name'];

            echo "<div class='artist-card'>";
            echo "<h2>$artistName</h2>";
            if ($artImage) {
                echo "<img src='$artImage' alt='Artwork'>";
                echo "<h5>Art : $artName</h5>";
            } else {
                echo "<img class='no-image' src='images/ptng.jpg' alt='Artwork'>";
            }
            echo "</div>";
        }
    } else {
        echo "<p>No artists found</p>";
    }
    $conn->close();
    ?>
</div>

</body>
</html>
