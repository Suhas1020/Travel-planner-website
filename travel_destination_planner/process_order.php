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

// Process the order
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve order details from the form
    $name = $_POST["name"];
    $address = $_POST["address"];

    // Insert the order into the database
    $sql = "INSERT INTO orders (name, address) VALUES ('$name', '$address')";
    if ($conn->query($sql) === TRUE) {
        // Order successfully inserted, redirect to index page
        header("Location: index.php");
        exit(); // Stop executing the rest of the code
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
