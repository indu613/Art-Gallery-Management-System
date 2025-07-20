<?php
session_start(); // Start the session

if (!isset($_SESSION['s_id'])) {
    header('Location: login.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Artworks</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap"  rel="stylesheet">
<style>
    /* Reset some default styles */
*{
    font-family: 'Poppins', sans-serif;
}
body {
    background: linear-gradient(to right, #cd2650, #530e15); /* You can replace these colors with your desired gradient */
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
    margin: 0 10px;
    padding:15px;
    
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
    transform: scale(1.05);
}   

.card-container {
    text-align: center;
}

.product-card {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 10px;
    margin: 20px;
    max-width: 300px;
    display: inline-block;
    background-color: rgb(208, 128, 152);
    transition: transform 0.3s ease-in-out;
}
.product-card:hover {
    transform: scale(1.05);
}

.product-card img {
    max-width: 100%;
    height: auto;
    transition: transform 0.3s;
}
.product-card:hover img {
    transform: scale(1.15); /* Increase the size of the image on hover */
}
.product-card h2 {
    font-size: 1.5rem;
    margin: 10px 0;
    color: #000000;
}

.product-card p {
    font-size: 1rem;
    margin: 10px 0;
    color:#000000;
}

.product-card .price {
    font-size: 1.25rem;
    color: #000000;
}

.product-card button {
    background-color: #000000;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    font-size: 1rem;
    cursor: pointer;
    margin-top: 10px;
}

.product-card button:hover {
    background-color: #413c40;
}
.footer-container {
    max-width: 1000px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    padding: 0 20px;
}
#arthvn{
    width:120px;
    height:120px;
    padding:10px;
    margin:10px;
    border-radius: 80px;
    float:left;
}
footer {
    background-color: #333;
    color: #fbfbfb;
    text-align: center;
    padding: 20px 0;
}
.footer-contact {
    flex: 1;
    margin: 10px;
    text-align: left;
}
.social-icons {
    display: flex;
    align-items: center;
}
.social-icons a {
    margin-right: 10px;
}
.social-icons img {
    width: 40px;
    height: 40px;
}
#a1,#a2,#a3,#a4
{
    color:#ffffff;
    size: 20px;
}
.page-title{
    padding: 11px; /* Adjust the padding as needed for spacing */
    margin: 4px 0; /* Adjust the margin as needed */
    font-weight: 600;
    font-size: 40px;
}
    </style>
   </head>
<body>
    <nav>
        <div class="logo">
            <img src="images/logo3.png" alt="Logo" width="80px" height="80px" >
        </div>
        <ul class="nav-links">
            <li><a href="admin.php">Home</a></li>
        </ul>
    </nav>
<div>
<div><h1 class="page-title"  style="Color:#ffffff;text-align:center;" >Artwork Collection</h1></div>
    <div class="card-container">
        <?php           
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
            // Query to fetch art dtls of artist
            $sql = "SELECT s.stockid, s.artname, s.medium, s.status, s.price, s.artistid, s.image, u.name 
            FROM stock s  INNER JOIN user u ON s.artistid = u.userid";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                $sname = $row['name'];
                $medium = $row['medium'];
                $price = $row['price'];
                $itemImageURL = $row['image'];
                $artistName = $row['name'];
                $sid = $row['stockid'];
                $stat = $row['status'];


                // Display product card
                echo "<div class='product-card'>";
                echo "<img id='Productimages' src='$itemImageURL' alt='$sname' >";
                echo "<h5>Stock Id: $sid</h5>";
                echo "<h2>$sname</h2>";
                echo "<p><h3>Artist: $artistName</h3></p>";
                echo "<p>Medium: $medium</p>";
                echo "<p>Price: $price</p>";
                echo "<p>Status: $stat</p>";
                echo "</div>";
            }
            $stmt->close();
            $conn->close();           
        ?>
    </div>
</div>
<footer>
    <div class="footer-container">
        <img id="arthvn" src="images/logo3.png" alt="Logo">

        <div class="footer-contact">
            <p>B123 Gallery Lane</p>
            <p>Kochi, Kerala 683111</p>
            <p>Email: info@artgallery.com</p>
            <p>Phone: +91 9876543210</p>
        </div>
        <div class="social-icons">
            <a href="https://x.com/amritakochi?s=20" target="_blank"><img src="images/twt_icon.png" alt="Twitter"></a>
            <a href="https://in.pinterest.com/" target="_blank"><img src="images/pin_icon.png" alt="Facebook"></a>
            <a href="https://www.facebook.com/kochicampus/" target="_blank"><img src="images/fb_icon.png" alt="Facebook"></a>
            <a href="https://www.instagram.com/amritakochicampus/" target="_blank"><img src="images/ig_icon.png" alt="Instagram"></a>
        </div>
    </div>
</footer>
</body>
</html>
</body>
</html>
