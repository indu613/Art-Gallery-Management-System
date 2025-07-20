<?php
// Connection to the database
$conn = new mysqli("localhost", "root", "", "artg");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch orders data
$fetchOrdersQuery = "SELECT orderid, custid, s_fullname, orderdate, amount FROM orders";
$result = $conn->query($fetchOrdersQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <title>View Orders</title>
    <style>
        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(to right, #eb6464, #7a0c0c); /* You can replace these colors with your desired gradient */
            background-position: center;
            background-size: cover;
            height: 100vh; 
            margin: 0; 
        }

        nav {
            padding: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #4a0a0a;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .logo img {
            width: 125px;
            height: auto;
            border-radius: 50%;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #dddddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
        .back-button {
            background-color: #000000;
            color: white;
            padding: 10px 15px;
            margin-right: 20px;
            border: none;
            cursor: pointer;
        }
        .back-button:hover{
            transform: scale(1.2);
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo">
            <img src="images/logo3.png" alt="Logo">
        </div>
        <h2 style="text-align: center; color:white; margin-bottom: 20px; margin-right: 100px;">Orders<h2>
        <form method="post" action="admin.php">
            <button type="submit" name="back" class="back-button">Back</button>
        </form>
    </nav>
    <?php if ($result->num_rows > 0) : ?>
        <table>
            <tr>
                <th>Order ID</th>
                <th>User ID</th>
                <th>Name</th>
                <th>Date & Time</th>
                <th>Amount</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row['orderid']; ?></td>
                    <td><?php echo $row['custid']; ?></td>
                    <td><?php echo $row['s_fullname']; ?></td>
                    <td><?php echo $row['orderdate']; ?></td>
                    <td><?php echo $row['amount']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else : ?>
        <p>No orders found.</p>
    <?php endif; ?>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
