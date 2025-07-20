<?php
// Check if the user is an admin (replace this with your authentication logic)
session_start();
if (!isset($_SESSION['s_id'])) {
    header('Location: login.html');
    exit;
}
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <title>Admin Profile</title>
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
            height: 100vh;
        }

        nav {
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: rgb(71, 70, 70);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .logo img {
            width: 85px;
            height: auto;
            border-radius: 50%;
        }
        .back-button{
            margin-right: 0px;
        }
        .logout-button{
            margin-left: -760px;
        }
        .back-button, .logout-button {
            background-color: #000000;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            /* Add this line to remove underlines */
            
        }

        .back-button:hover,
        .logout-button:hover {
            background-color: #ad9aac;
            color: #000000;
        }

        .profile-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .profile-card {
            background-color: #000000;
            border: 1px solid #000000;
            color: aliceblue;
            border-radius: 8px;
            padding: 20px;
            margin: 15px;
            width: 300px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(255, 255, 255, 0.1);
        }

        .page-title {
            padding: 11px;
            /* Adjust the padding as needed for spacing */
            margin: 4px 0;
            /* Adjust the margin as needed */
            font-weight: 600;
            font-size: 40px;
            color: white;
        }
    </style>
</head>

<body>
    <nav>
        <div class="logo">
            <img src="images/logo3.png" alt="Logo">
        </div>
        <form method="post" action="admin.php">
            <button type="submit" name="back" class="back-button">Back</button>
        </form>
        <form method="post" >
            <button type="submit" name="logout" class="logout-button">Logout</button>
        </form>
    </nav>

    <div class="profile-container">
        <div class="profile-card">
            <h1 class="page-title">User</h1>
            <h3>ADMIN</h3>
        </div>
    </div>
</body>

</html>
