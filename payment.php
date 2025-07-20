<?php
session_start();
if (!isset($_SESSION['s_id'])) {
    header('Location: login.html');
    exit;
}
if (!isset($_POST['fullname'], $_POST['address'], $_POST['city'], $_POST['pincode'], $_POST['phone'])) {
    // Redirect if shipping information is missing
    header('Location: shipping.php');
    exit;
}
$conn = new mysqli('localhost', 'root','', 'artg');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$user_id = $_SESSION['s_id'];

// Get shipping information from the form
$fullname = $_POST['fullname'];
$address = $_POST['address'];
$city = $_POST['city'];
$pincode = $_POST['pincode'];
$phone = $_POST['phone'];

$sql = "INSERT INTO orders (custid, s_fullname, s_address, s_city, s_pincode, s_phone) 
        VALUES ('$user_id', '$fullname', '$address', '$city', '$pincode', '$phone')";

if ($conn->query($sql) === TRUE) {        
    $orderId = $conn->insert_id;  
    $_SESSION['order_id'] = $orderId;
    ?>
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
        <title>Payment Page</title>
        <style>
        *{
            font-family: 'Poppins', sans-serif;

        }
        body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-image: url("images/money.jpg");
            background-size: cover;
            color: white;
	        font-family: 'Poppins', sans-serif;
        }
        h2{
            margin-right:5px;
        }

        nav {
            background-color: rgba(0, 0, 0, 0.8); /* Semi-transparent background */
            width: 100%;
            padding: 10px 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .logo img {
            width: 100px;
            height: auto;
            border-radius: 50%;
            margin-left: 5px;
            float: left;
        }

        .container {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 600px;
            text-align: center;
            margin-top: 30px;
        }
        .card-images {
            margin-top: 10px;
            margin-bottom:10px;
        }

        .card-image {
            width: 80px;
            margin-right: 10px;
        }

        /* Style for the Accepted Cards label */
        #accepted_cards {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #ffffff;
        }

        /* Style for the Accepted Cards container */
        .card-images-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom:15px; 
        }

        label {
            display: inline-block; /* Adjusted to inline-block */
            margin: 10px 0 5px;
            font-weight: bold;
            color: #ffffff;
            width: 180px; /* Adjusted width for consistency */
        }

        input {
            display: inline-block; /* Adjusted to inline-block */
            width: calc(100% - 190px); /* Adjusted width for consistency */
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        button {
            background-color: #b15f3c;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #3e1905;
        }
        </style>
        <script>
        function confirmPay() {
            return confirm("Are you sure to proceed with the payment?");
        }
    </script>
    </head>
    <body>
    <nav>
        <div class="logo">
            <img src="images/logo3.png" alt="Logo">
        </div>
        <h2>Payment Information</h2> 
    </nav>
    <div class="container">
        <form action="process_payment.php" method="post" onsubmit='return confirmPay()'>
            <label for="card_owner">Card Owner Name:</label>
            <input type="text" id="card_owner" name="card_owner" required>

            <label for="card_number">Card Number:</label>
            <input type="text" id="card_number" name="card_number" placeholder="XXXX-XXXX-XXXX" required>

            <label for="expiry">Expiry Year-Month:</label>
            <input type="text" id="expiry" name="expiry" placeholder="YYYY-MM" required>

            <label for="cvv">CVV Number:</label>
            <input type="text" id="cvv" name="cvv" placeholder="XXX" required>

            <label for="accepted_cards">Accepted Cards:</label>
            <div class="card-images">
                <img src="images/visa.png" alt="Visa" class="card-image">
                <img src="images/mastercard.png" alt="MasterCard" class="card-image">
                <img src="images/rupay.png" alt="Rupay" class="card-image">
            </div>

            <input type="hidden" name="order_id" value="<?php echo $orderId; ?>">
            <button type="submit" name="paid" >Confirm Payment</button>
        </form>
    </div>
    </body>
    </html>

    <?php
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
