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
    <title>Shopping Cart</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap"  rel="stylesheet">
<style>
    /* Reset some default styles */
*{
    font-family: 'Poppins', sans-serif;
}
.container{
    flex: 1;    
    display: flex;
    flex-direction: column;
}
body{
    background: linear-gradient(to right, #536976, #292E49); /* You can replace these colors with your desired gradient */
    background-position: center;
    background-size: cover;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
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
    width:120px; /* Adjust the width as needed */
    height: auto;
    border-radius: 80px;
    margin-top: 30px;
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
    transform: scale(1.2);
}   



.card-container {
    text-align: center;
    flex-grow: 1;
}

.product-card {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 10px;
    margin: 20px;
    max-width: 300px;
    display: inline-block;
    background-color: rgb(128, 179, 208);
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
.page-title{
    padding: 11px;
    margin: 4px 0; 
    font-weight: 600;
    font-size: 40px;
}
.orderB {
        background-color: #000000;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 1rem;
        cursor: pointer;
        margin-top: 10px;
}

.orderB:hover {
    background-color: #413c40;
}
    </style>
    <script>
        function confirmOrder() {
            return confirm("Are you sure to place your order?");
        }
    </script>
   </head>
<body>
    <div class="container">   
    <nav>
        <div class="logo">
            <img src="images/logo3.png" alt="Logo" width="80px" height="80px" >
        </div>
        <ul class="nav-links">
            <li><a href="artworks.php">Back</a></li>
        </ul>
    </nav>
<div><h1 class="page-title"  style="Color:#ffffff;text-align:center;" >Shopping Cart</h1></div>
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

        // Assuming your tables are named 'user', 'stock', and 'cart'
        $userId = $_SESSION['s_id'];
        $sql = "SELECT c.*, s.*, u.name AS artist_name FROM cart c
                JOIN stock s ON c.stid = s.stockid
                JOIN user u ON u.userid = s.artistid
                WHERE c.cid = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                echo "<div class='product-card'>";
                echo "<img src='" . $row['image'] . "' alt='Artwork Image'>"; // Assuming 'image_path' is a column in your 'stock' table
                echo "<h2>" . $row['artname'] . "</h2>"; // Assuming 'artname' is a column in your 'stock' table
                echo "<p>Artist: " . $row['artist_name'] . "</p>"; // Assuming 'artist_name' is a column in your 'user' table
                echo "<p>Price: Rs." . $row['price'] . "</p>";

                //Form for removing the item from the cart
                echo "<form action='cartRemove.php' method='post'>";
                echo "<input type='hidden' name='cartid' value='" . $row['cartid'] . "'>";
                echo "<input type='hidden' name='stockid' value='" . $row['stockid'] . "'>";
                echo "<button type='submit' class='remove-button'>Remove from Cart</button>";
                echo "</form>";

                echo "</div>";
                

            }
            echo "<form action='shipping.php' method='post' onsubmit='return confirmOrder()'>";
            echo "<button type='submit' name='ship' class='orderB'>Checkout</button></form><br>";
        } 
        else {
            echo "<h2>Your cart is empty</h2>";

            
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
</div>
</footer>
</body>
</html>
</body>
</html>
