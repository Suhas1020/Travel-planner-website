<?php
// Start the session
session_start();

// Check if the cart array exists in session, if not, initialize it as an empty array
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

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

// Fetch destinations from the database based on the IDs in the cart
$cartDestinations = [];
if (!empty($cart)) {
    $cartIds = implode(',', $cart);
    $sql = "SELECT id, name, description, image FROM destinations WHERE id IN ($cartIds)";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cartDestinations[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cart</title>
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

        .destination-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .destination {
            position: relative;
            flex: 0 0 calc(33.33% - 20px); /* Adjust the width as needed */
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
        }

        .destination img {
            max-width: 100%;
            border-radius: 8px;
        }

        .description {
            padding: 10px;
        }

        .remove-from-cart {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }

        .remove-from-cart:hover {
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
        .checkout-btn {
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

        .checkout-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<header>
    <h1>View Cart</h1>
</header>
<a href="checkout.php" class="checkout-btn">Checkout</a>
<a href="userhome.php" class="userhome-btn">Home</a>
<main>
    <div class="destination-container">
        <?php
        if (!empty($cartDestinations)) {
            foreach ($cartDestinations as $destination) {
                echo "<div class='destination' data-id='" . $destination["id"] . "'>";
                echo "<h2>" . $destination["name"] . "</h2>";
                echo "<img src='" . $destination["image"] . "' alt='" . $destination["name"] . "'><br>";
                echo "<p class='description'>" . $destination["description"] . "</p>";
                echo "<button class='remove-from-cart' data-id='" . $destination["id"] . "'>Remove from Cart</button>";
                echo "</div>";
            }
        } else {
            echo "<p>No items in the cart.</p>";
        }
        ?>
    </div>
</main>

<footer>
    <!-- Footer content -->
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const removeFromCartButtons = document.querySelectorAll('.remove-from-cart');

        removeFromCartButtons.forEach(button => {
            button.addEventListener('click', function () {
                const destinationId = this.getAttribute('data-id');
                removeFromCart(destinationId);
            });
        });

        function removeFromCart(destinationId) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'remove_from_cart.php'); // Endpoint to remove from cart
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    // Handle success response (e.g., remove the item from the UI)
                    const destinationElement = document.querySelector('.destination[data-id="' + destinationId + '"]');
                    if (destinationElement) {
                        destinationElement.remove();
                    }
                    alert('Item removed from cart!');
                } else {
                    // Handle error response
                    alert('Failed to remove item from cart.');
                }
            };
            xhr.send('destination_id=' + encodeURIComponent(destinationId));
        }
    });
</script>

<?php
// Close the database connection
$conn->close();
?>
</body>
</html>
