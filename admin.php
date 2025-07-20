<?php
session_start();
if (!isset($_SESSION['s_id'])) {
    header('Location: login.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <title>Admin Dashboard</title>
    <style>
        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-image: url(images/adminbackground.jpg);
            background-position: center;
            background-size: cover;
            margin: 0;
            padding: 0;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo img {
            width: 90px;
            height: auto;
            border-radius: 50%;
        }
        ul {
            list-style-type: none;
        }
        nav li a {
        margin-right:70px;
        text-decoration:none;
        color:#000000;
        font-weight: bold;
        display: inline-block;
        position: relative;
        transform-style: preserve-3d;
        transition: 0.3s ease;
        font-size:xx-large;
        }
        nav li a:hover{
            background-color: #000000;
            color: #ffffff;
        }   
        a:hover, a:focus {
            transform: rotateY(360deg);
            font-weight: bold;
        }
          .dashboard-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center; /* Center the content horizontally */
            align-items: center; /* Center the content vertically */
            padding: 20px;
            gap: 20px; /* Add gap between items */
        }

        .dashboard-card {
            background-color: #000000;
            border: 1px solid #000000;
            color: aliceblue;
            border-radius: 8px;
            padding: 20px;
            margin: 15px;
            width: 300px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(255, 255, 255, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .dashboard-card:hover {
            transform: scale(1.05);
        }
        .dashboard-card button {
            background-color: #000000;
            color: white;
            font-size: 18px;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none; 
            transition: font-weight 0.3s ease-in-out, transform 0.3s ease-in-out;
        }

        .dashboard-card button:hover {
            background-color: #333333;
            font-weight: bold;
            transform: scale(1.2);
        }
        .page-title{
            padding: 11px; /* Adjust the padding as needed for spacing */
            margin: 4px 0; /* Adjust the margin as needed */
            font-weight: 600;
            font-size: 40px;
        } 
        button:hover{
            font-weight: bold;
            transform: scale(1.2);
        } 
        .logout-button {
            background-color: #000000;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none; /* Add this line to remove underlines */
        }

        .logout-button:hover {
            background-color: #333333;
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo">
            <img src="images/logo3.png" alt="Logo">
        </div>
        <ul>
            <li><a href="adminProf.php"><i class='bx bx-user' type="solid"></i></a></li>
        </ul>
    </nav>
    <div><h1 class="page-title" style="Color:black;text-align:center;">Admin Dashboard</h1></div>
    <div class="dashboard-container">
        <div class="dashboard-card">
            <h2><button onclick="window.location='artworks_adm.php'">View Artworks</button></h2>
        </div>

        <div class="dashboard-card">
            <h2><button onclick="window.location='artUpdateAdmin.php'">Update Art Price</button></h2>
        </div>

        <div class="dashboard-card">
            <h2><button onclick="window.location='viewOrders.php'">View Orders</button></h2>
        </div>
    </div>
</body>
</html>
