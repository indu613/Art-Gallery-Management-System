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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Information</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <style>
        *{
            font-family: 'Poppins', sans-serif;

        }
        body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column; /* Adjusted for column layout */
            align-items: center;
            background-image: url("images/bg1.jpg"); /* Added background image */
            background-size: cover;
        }

        nav {
            background-color: rgba(0, 0, 0, 0.8); /* Semi-transparent background */
            width: 100%;
            padding: 10px 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .logo img {
            width: 100px; /* Adjusted logo size */
            height: auto;
            border-radius: 50%; /* Circular border */
            float: left;
        }

        .container {
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 600px;
            text-align: center;
            margin-top: 30px; /* Added margin to separate container from nav */
        }

        h2 {
            color: #ffffff;
            margin-bottom: 20px;
            margin-right: 5px;
        }

        label {
            display: inline-block; /* Adjusted to inline-block */
            margin: 10px 0 5px;
            font-weight: bold;
            color: #ffffff;
            width: 150px; /* Adjusted width for consistency */
        }

        input {
            display: inline-block; /* Adjusted to inline-block */
            width: calc(100% - 160px); /* Adjusted width for consistency */
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        .confShip{
            background-color: #b15f3c;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 10px;
        }
        
        .confShip:hover {
            background-color: #3e1905;
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo">
            <img src="images/logo3.png" alt="Logo">
        </div>
        <h2>Shipping Information</h2> <!-- Moved heading to the navigation bar -->
    </nav>
    <div class="container">
        <form action="payment.php" method="post">
            <label for="fullname">Full Name:</label>
            <input type="text" id="fullname" name="fullname" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>

            <label for="city">City:</label>
            <input type="text" id="city" name="city" required>

            <label for="pincode">PIN Code:</label>
            <input type="number" id="pincode" name="pincode" required pattern="[0-9]{6}" maxlength="6">

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" required pattern="[0-9]{10}" maxlength="10">

            <button type='submit' name='confShip' class='confShip'>Proceed to Payment</button>
        </form>
    </div>
</body>
</html>
