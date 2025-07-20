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
    <meta charset="UTF-8">
    <title>Upload Artwork</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <script src="AddProductScript.js"></script>
    <style>
        /* Reset some default styles */
        body, h1, h2, h3, p, input, button {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-image: url(images/newart.jpg);
            background-position: center;
            background-size: cover;
        }

        .wrapper {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: linear-gradient(to right, rgb(45, 12, 59), rgb(34, 11, 99));
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: #ffffff;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
            color: #ffffff;
        }

        .inputbox,
        .medium,
        .genre,
        .price,
        .image {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #ffffff;
        }

        input {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .submit-button {
            text-align: center;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            background-color: rgb(13, 2, 43);
            color: #fff;
        }
        button:hover {
            background-color: #7d71ab; /* Change the color to your desired hover color */
        }

        

        .gotohome {
            text-align: center;
            margin-top: 20px;
        }

        a {
            text-decoration: none;
            color: #ffffff;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
    <script>
        function confirmAddArtwork() {
            return confirm("Are you sure you want to add this artwork?");
        }
    </script>
</head>
<body>
    <div class="wrapper">
        <form id="myForm" method="post" action="addArtSubmit.php" enctype="multipart/form-data" onsubmit="return confirmAddArtwork()">
            <h1>Upload Art</h1>
            <div class="inputbox">
                <label for="name">Artwork Name:</label>
                <input type="text" id="name" name="name" placeholder="Art name" required pattern="[A-Za-z ]{1,30}" title="Product name must contain only letters and be less than 30 characters" required>
            </div>

            <div class="medium">
                <label for="medium">Artwork Medium:</label>
                <input type="text" id="medium" name="medium" placeholder="Art medium" required pattern="[A-Za-z ]{1,50}" title="Product name must contain only letters" required>
            </div>

            <div class="genre">
                <label for="genre">Art Genre:</label>
                <input type="text" id="genre" name="genre" placeholder="Art genre" required pattern="[A-Za-z ]{1,50}" title="Product name must contain only letters" required>
            </div>

            <div class="price">
                <label for="price">Price:</label>
                <input type="number" step="0.01" id="price" name="price" placeholder="price" required>
            </div>
            <div class="image">
                <label for="image">Upload Image:</label>
                <input type="file" id="image" name="image" placeholder="image" accept="image/*" required>
            </div>
            <div class="submit-button">
                <button type="submit" name="sub" class="Button2" style="margin-bottom: 10px;">Submit</button>
                <button type="button" onclick="clearForm()">Clear Form</button>
            </div>
            <div class="gotohome">
                <p><a href="sam.php">Home | Artist</a></p>
            </div>
        </form>
    </div>

    <script>
        function clearForm() {
            document.getElementById("myForm").reset();
        }
    </script>
</body>
</html>
