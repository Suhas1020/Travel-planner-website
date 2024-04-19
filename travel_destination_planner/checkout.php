<?php
// Start the session
session_start();

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "travel_destination_planner";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve shipping information from the form
    $name = $_POST['name'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $paymentMethod = $_POST['payment']; // Added to retrieve payment method from the form

    // Validate the data (you can add more validation as needed)
    if (empty($name) || empty($address) || empty($username) || empty($paymentMethod)) {
        // Redirect back to the checkout page with an error message if any field is empty
        header("Location: checkout.php?error=empty_fields");
        exit();
    }

    // Check if the username exists in the users table
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 0) {
        // Redirect back to the checkout page with an error message if the username does not exist
        header("Location: checkout.php?error=username_not_found");
        exit();
    }

    // Retrieve destinations from the session
    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
    $destinations = implode(',', $cart);

    // Insert the order information into the database
    $sql = "INSERT INTO orders (name, address, username, destinations, payment_method) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $address, $username, $destinations, $paymentMethod); // Added payment method to bind params
    if ($stmt->execute()) {
        // Process the order (you can add your own logic here)
        // For demonstration, let's just unset the cart items and display a success message
        unset($_SESSION['cart']);

        // Redirect to the checkout page with a success message
        header("Location: checkout.php?success=order_placed");
        exit();
    } else {
        // Redirect back to the checkout page with an error message if the insertion fails
        header("Location: checkout.php?error=insert_failed");
        exit();
    }
}

// Fetch destinations from the database based on the IDs in the cart
$cartDestinations = [];
if (!empty($_SESSION['cart'])) {
    $cartIds = implode(',', $_SESSION['cart']);
    $sql = "SELECT id, name, description, image FROM destinations WHERE id IN ($cartIds)";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cartDestinations[] = $row;
        }
    }
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        /* Add your CSS styles here */
        /* For demonstration, let's assume basic styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
            position: relative;
        }

        main {
            padding: 20px;
        }

        h1 {
            margin: 0;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        input[type="text"], input[type="radio"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
        }

        .success {
            color: green;
        }

        .view-cart-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .view-cart-btn:hover {
            background-color: #0056b3;
        }

        .userhome-btn {
            position: absolute;
            top: 20px;
            right: 150px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .userhome-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<header>
    <h1>Checkout</h1>
</header>
<a href="view_cart.php" class="view-cart-btn">View Cart</a>
<a href="userhome.php" class="userhome-btn">Home</a>
<main>
    <?php if (empty($cartDestinations)) : ?>
        <p class="error">No items in the cart.</p>
    <?php else : ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="name">Name:</label><br>
            <input type="text" name="name" id="name"><br>
            <label for="address">Address:</label><br>
            <input type="text" name="address" id="address"><br>
            <label for="username">Username:</label><br>
            <input type="text" name="username" id="username"><br>
            <label for="payment">Payment Method:</label><br>
            <input type="radio" name="payment" id="payment-cash" value="Cash" checked>
            <label for="payment-cash">Cash on Delivery</label><br>
            <input type="radio" name="payment" id="payment-card" value="Card">
            <label for="payment-card">Credit/Debit Card</label><br>
            <input type="submit" value="Place Order">
        </form>
    <?php endif; ?>

    <?php
    // Display error or success messages if redirected from the form submission
    if (isset($_GET['error'])) {
        echo "<p class='error'>Error: ";
        switch ($_GET['error']) {
            case "empty_fields":
                echo "Please fill in all fields.";
                break;
            case "insert_failed":
                echo "Failed to place order. Please try again later.";
                break;
            case "username_not_found":
                echo "Username not found. Please enter a valid username.";
                break;
            default:
                echo "An unknown error occurred.";
        }
        echo "</p>";
    } elseif (isset($_GET['success'])) {
        echo "<p class='success'>Order placed successfully!</p>";
        // Redirect after a delay
        echo "<script>
                    setTimeout(function() {
                        window.location.href = 'userhome.php';
                    }, 3000); // 3000 milliseconds = 3 seconds
              </script>";
    }
    ?>
</main>
</body>
</html>
