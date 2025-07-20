<?php
session_start(); // Start the session

// Check if the seller ID is stored in the session
if (!isset($_SESSION['s_id'])) {
    // Seller is not logged in, redirect to the login page
    header('Location: login.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Artist | Home </title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial scale=1.0">
        <link rel="stylesheet" href="artistloginstyle.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
    <nav>
        <div class="logo" alt="Logo" width="80px" height="30px">
            <img src="images/logo3.png" class="logo" >
        </div>
        <ul class="nav-links">
            <li><a href="artistlogin.php">Home</a></li>
            <li><a href="#Orders">Your Artworks</a></li>
            <li class="dropdown">
                <a href="#">Modify Details</a>
                <div class="dropdown-content">
                    <a href="Page1.html">Update</a>
                    <a href="AddingProduct.php">  &nbsp Add &nbsp </a>
                    <!--<a href="#remove">Remove </a>-->
                </div>
                <li><a href="artistProfile.php"><i class='bx bx-user-pin'></i></a></li>
            </li>
        </ul>
    </nav>
</div>
<div><h1 class="page-title"  style="Color:#A15D98;font-family:'Courier New', Courier, monospace;text-align:left;" >Your Products</h1></div>
<div class="product-card">
    <img src="https://e0.pxfuel.com/wallpapers/183/303/desktop-wallpaper-cupcakes-sweet-dessert-fruit-cupcake-food.jpg
    " alt="Product Image">
    <h2>Blueberry cupcake</h2>
    <p>blue and pink kawai cakes</p>
    <span class="price">150Rs</span>
    <!--<button onclick="showMessageBox('success', 'Success Message', 'Your request was successfully processed.')">Add to Cart</button>-->
    <button>View Details</button>
</div>
<div class="product-card">
    <img src="https://e0.pxfuel.com/wallpapers/730/968/desktop-wallpaper-food-dessert.jpg" alt="pastel cupcake">
    <h2>Pastel cupcake</h2>
    <p>vanilla strawberry mix</p>
    <span class="price">120Rs-150Rs</span>
    <button>View Details</button>
</div>
<div class="product-card">
    <img src="https://e0.pxfuel.com/wallpapers/558/730/desktop-wallpaper-beautiful-sweets-colorful-macaron.jpg" alt="pastel cupcake">
    <h2>Rainbow Macroons</h2>
    <p>Mango|Butterscotch|Strawberry|<br>pistachio|coffee</p>
    <span class="price">200Rs-250Rs</span>
    <!--<button onclick="showMessageBox('success', 'Success Message', 'Your request was successfully processed.')">Add to Cart</button>-->
    <button>View Details</button>
</div>
<div class="product-card">
    <img src="https://media.istockphoto.com/id/1400397956/photo/victoria-sandwich-cake-decorated-with-strawberries-blueberries-and-mint-closeup.jpg?s=612x612&w=0&k=20&c=DOrCPVN5jCcMpD7HHxifjX9EtfkQ8SGtjiL2Ra4uXTs=">
    <h2>Pancakes</h2>
    <p>Mango|Banana|Strawberry|<br>pistachio|grapes</p>
    <span class="price">450Rs</span>
    <button>View Details</button>
</div>
</div>

<footer>
    <div >
        <img id="Lovespoon" src="images/logo3.png" alt="Logo">
        <div>
        <p id="intro">
            <a id="a1" href="https://www.instagram.com/"><i class='bx bxl-instagram'></i></a>&nbsp  &nbsp<a id="a2" href="https://twitter.com/"><i class='bx bxl-twitter'></i></a>&nbsp &nbsp<a id="a3" href="#Support"><i class='bx bx-support'></i></a>&nbsp &nbsp<a id="a4" href="https://www.facebook.com/"><i class='bx bxl-meta'></i></a>
        </div>
    </div>
    <p>&copy; LoveSpoon</p>
</footer>
</body>
</html>
</body>
</html>