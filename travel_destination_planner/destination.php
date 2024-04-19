<?php
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

// Fetch destinations from the database
$sql = "SELECT id, name, description, image FROM destinations";
$result = $conn->query($sql); // Execute the query and assign the result
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinations</title>
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

        .checkout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
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
            cursor: pointer;
        }

        .destination img {
            max-width: 100%;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }

        .destination:hover img {
            transform: scale(1.1);
        }

        .destination .description {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 10px;
            box-sizing: border-box;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .destination:hover .description {
            opacity: 1;
        }

        .add-to-cart {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #fff;
            font-size: 24px;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .add-to-cart:hover {
            color: green;
            transform: scale(1.2);
        }
    </style>
</head>
<body>
    <header>
        <h1>Explore Our Destinations</h1>
        <a href="checkout.php" class="checkout-btn">Checkout</a>
        <a href="view_cart.php" class="view-cart-btn">View Cart</a>
        <a href="userhome.php" class="userhome-btn">Home</a>
    </header>

    <main>
        <div class="destination-container">
            <?php
            if ($result && $result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    // Display each destination
                    echo "<div class='destination'>";
                    echo "<h2>" . $row["name"] . "</h2>";
                    echo "<img src='" . $row["image"] . "' alt='" . $row["name"] . "'><br>";
                    echo "<p class='description'>" . $row["description"] . "</p>";
                    echo "<div class='add-to-cart' data-id='" . $row["id"] . "'>&#128722;</div>"; // Cart icon for adding to cart
                    echo "</div>";
                }
            } else {
                echo "No destinations found.";
            }
            ?>
        </div>
    </main>

    <footer>
        <!-- Footer content -->
    </footer>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <script>
        // JavaScript for adding destinations to the cart
        const addToCartIcons = document.querySelectorAll('.add-to-cart');

        addToCartIcons.forEach(icon => {
            icon.addEventListener('click', (event) => {
                // Retrieve the destination ID from the data-id attribute of the clicked icon
                const destinationId = event.target.getAttribute('data-id');

                // Send an AJAX request to add the destination to the cart
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'add_to_cart.php'); // Endpoint to add to cart
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        // Handle success response
                        alert('Destination added to cart!');
                    } else {
                        // Handle error response
                        alert('Failed to add destination to cart.');
                    }
                };
                xhr.send('destination_id=' + encodeURIComponent(destinationId));
            });
        });
    </script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
