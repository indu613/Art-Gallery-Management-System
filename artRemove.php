<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Remove Artwork</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap">
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
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
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
        function confirmDelete() {
            return confirm("Are you sure you want to delete the artwork?");
        }
    </script>
</head>
<body>
    <div class="wrapper">
        <form id="myForm" method="post" action="artRemoveSubmit.php" enctype="multipart/form-data" onsubmit="return confirmDelete()">
            <h1>Delete Artwork</h1>
            <div class="inputbox">
                <label for="sid">Artwork ID:</label>
                <input type="text" id="sid" name="sid" placeholder="ID of art to be updated" required>
            </div>
            <div class="submit-button">
                <button type="submit" name='sub' class="Button2">Delete</button>
            </div>
            <div class="gotohome">
                <p><a href="sam.php">Artist | Home</a></p>
            </div>
        </form>
    </div>
</body>
</html>
