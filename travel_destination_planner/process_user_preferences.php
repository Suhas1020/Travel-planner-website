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

// Initialize $result variable
$result = null;

// Check if the form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user preferences
    $destination_type = $_POST['destination_type'];
    $interested_activities = $_POST['interested_activities'];

    // Convert interested activities to a comma-separated string
    $activities_str = implode("', '", $interested_activities);

    // Fetch destinations from the database matching user preferences
    $sql = "SELECT * FROM destinations WHERE type = '$destination_type' AND (";
    foreach ($interested_activities as $activity) {
        $sql .= "FIND_IN_SET('$activity', activities) > 0 OR ";
    }
    // Remove the trailing "OR" and close the parentheses
    $sql = rtrim($sql, "OR ") . ") ORDER BY activities, type";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sorted Destinations</title>
    <style>
        /* Add your CSS styles here */
        /* For demonstration, let's assume basic styling */

        /* Container for destinations */
        .destinations {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
        }

        /* Individual destination item */
        .destination {
            width: calc(33.33% - 20px); /* Adjust width as needed */
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
        }

        /* Destination image */
        .destination img {
            width: 100%;
            height: auto;
            border-radius: 8px 8px 0 0;
        }

        /* Destination info */
        .destination-info {
            padding: 10px;
            background-color: #f4f4f4;
        }

        .destination-info h2 {
            margin-top: 0;
        }

        /* Add to Cart button */
        .add-to-cart-btn {
            position: absolute;
            bottom: 10px;
            right: 10px;
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .add-to-cart-btn:hover {
            background-color: #0056b3;
        }
        .view-cart-btn {
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
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #f4f4f4;
        }

        .nav-buttons {
            display: flex;
            gap: 10px;
        }

        .nav-button {
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .nav-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Travel Destination Planner</h1>
        <div class="nav-buttons">
            <button class="nav-button" onclick="window.location.href='userhome.php'">Home</button>
            <button class="nav-button" onclick="window.location.href='view_cart.php'">Cart</button>
            <button class="nav-button" onclick="window.location.href='logout.php'">Logout</button>
        </div>
    </div>

    <!-- Rest of your content goes here -->
    <div class="destinations">
        <!-- Destination cards -->
    </div>
</body>
</html>

<body>
    <div class="destinations">
        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='destination'>";
                echo "<img src='" . $row["image"] . "' alt='" . $row["name"] . "'>";
                echo "<div class='destination-info'>";
                echo "<h2>" . $row["name"] . "</h2>";
                echo "<p>Type: " . $row["type"] . "</p>";
                echo "<p>Activities: " . $row["activities"] . "</p>";
                echo "<p>Description: " . $row["description"] . "</p>";
                echo "</div>";
                // Add to Cart button
                echo "<button class='add-to-cart-btn' onclick='addToCart(" . $row["id"] . ")'>Add to Cart</button>";
                echo "</div>";
            }
        } else {
            echo "No destinations found.";
        }
        ?>
    </div>
    <a href="view_cart.php" class="view-cart-btn">View Cart</a>

    <script>
        // JavaScript for adding destinations to the cart
        function addToCart(destinationId) {
            // Send an AJAX request to add the destination to the cart
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'add_to_cart.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Handle success response
                    alert('Destination added to cart!');
                } else {
                    // Handle error response
                    alert('Failed to add destination to cart.');
                }
            };
            xhr.send('destination_id=' + encodeURIComponent(destinationId));
        }
    </script>
</body>
</html>

<?php
// Close the database connection
$conn->close(); 
?>
