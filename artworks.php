<?php
session_start(); // Start the session

if (!isset($_SESSION['s_id'])) {
    header('Location: login.html');
    exit;
}

if (isset($_SESSION['success_message'])) {
    echo "<script>alert('" . $_SESSION['success_message'] . "');</script>";
    unset($_SESSION['success_message']); // Clear the session message
}

// Check for error message
if (isset($_SESSION['error_message'])) {
    echo "<script>alert('" . $_SESSION['error_message'] . "');</script>";
    unset($_SESSION['error_message']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Artworks</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<style>
    /* Reset some default styles */
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
    background-color: rgb(207, 152, 103);
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

.product-card button.addToCart {
    background-color: #000000;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    font-size: 1rem;
    cursor: pointer;
    outline: none;
    margin-top: 10px;
}
.product-card button.addToCart:hover {
    background-color: rgb(75, 37, 11);
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

.page-title{
    padding: 11px; /* Adjust the padding as needed for spacing */
    margin: 4px 0; /* Adjust the margin as needed */
    font-weight: 600;
    font-size: 40px;
}
form#filter{
    margin: 20px;
    padding: 20px;
    background-color: rgba(255, 213, 162, 0.793);
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

form label {
    width: 80px; /* Adjust as needed */
    text-align: right;
    margin-bottom: 8px;
    text-align:center;
}

form input[type="text"] {
    flex: 1;
    padding: 8px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}

form button.apply {
    flex: 1;
    background-color: #000000;
    color: #ffffff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

form button.apply:hover {
    background-color: rgb(87, 43, 14);
}
    </style>
   </head>
<body>
    <nav>
        <div class="logo">
            <img src="images/logo3.png" alt="Logo" width="80px" height="80px" >
        </div>
        <ul class="nav-links">
            <li><a href="home.php">Home</a></li>
            <li><a href="cart.php"><i class='bx bxs-cart-alt' style='color: white;'></i></a></li>
            <li><a href="custprofile.php"><i class='bx bx-user' style='color: white;' type="solid"></i></a></li>
        </ul>
    </nav>
<div>
<div><h1 class="page-title"  style="Color:#ffffff;text-align:center;" >Artwork Collection</h1></div>
<form  id="filter" method="post" action="artworks.php">
    <label for="genre">Genre:</label>
    <input type="text" name="genre" id="genre">

    <label for="medium">Medium:</label>
    <input type="text" name="medium" id="medium">

    <label for="artname">Art Name:</label>
    <input type="text" name="artname" id="artname">

    <label for="artistname">Artist Name:</label>
    <input type="text" name="artistname" id="artistname">

    <button type="submit" class="apply" name="applyFilters">Apply Filters</button>
</form>
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

// Build the default SQL query to fetch artworks
$sql = "SELECT s.stockid, s.artname, s.medium, s.genre, s.price, s.artistid, s.image, s.status, u.name 
        FROM stock s INNER JOIN user u ON s.artistid = u.userid";

// If filters are applied, modify the SQL query
if (isset($_POST['applyFilters'])) {
    // Build the SQL query based on selected filters
    $sql .= " WHERE 1"; // Always true condition to simplify query building

    // Check and append genre filter
    if (!empty($_POST['genre'])) {
        $genre = $conn->real_escape_string($_POST['genre']);
        $sql .= " AND s.genre = '$genre'";
    }

    // Check and append medium filter
    if (!empty($_POST['medium'])) {
        $medium = $conn->real_escape_string($_POST['medium']);
        $sql .= " AND s.medium = '$medium'";
    }

    // Check and append art name filter
    if (!empty($_POST['artname'])) {
        $artname = $conn->real_escape_string($_POST['artname']);
        $sql .= " AND s.artname LIKE '%$artname%'";
    }

    // Check and append artist name filter
    if (!empty($_POST['artistname'])) {
        $artistname = $conn->real_escape_string($_POST['artistname']);
        $sql .= " AND u.name LIKE '%$artistname%'";
    }
}

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $artname = $row['artname'];
    $medium = $row['medium'];
    $genre = $row['genre'];
    $price = $row['price'];
    $itemImageURL = $row['image'];
    $artistName = $row['name'];
    $stockId = $row['stockid'];
    $status = $row['status'];

    $isInCart = $status !== 'available';

    // Display product card
    echo "<div class='product-card'>";
    echo "<img id='Productimages' src='$itemImageURL' alt='$artname' >";
    echo "<h2>$artname</h2>";
    echo "<p><h3>Artist: $artistName</h3></p>";
    echo "<p>Medium: $medium</p>";
    echo "<p>Genre: $genre</p>";
    echo "<p>Price: Rs." . $price . "</p>";
    echo "<p>Status: $status</p>";

    if (!$isInCart) {
        // Display "Add to Cart" button only if the product is not in the cart
        echo "<form action='addToCart.php' method='post'>";
        echo "<input type='hidden' name='stockId' value='$stockId'>";
        echo "<button type='submit' class='addToCart' name='addToCart'>Add to Cart</button>";
        echo "</form>";
    }

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
