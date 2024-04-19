<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'travel_planner');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve existing destinations from database
$sql = "SELECT * FROM destinations";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Display each destination with edit and delete options
    while ($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<p>Name: " . $row["name"] . "</p>";
        echo "<p>Description: " . $row["description"] . "</p>";
        echo "<p>Image URL: " . $row["image_url"] . "</p>";
        echo "<a href='edit_destination.php?id=" . $row["id"] . "'>Edit</a>";
        echo "<a href='delete_destination.php?id=" . $row["id"] . "'>Delete</a>";
        echo "</div>";
    }
} else {
    echo "No destinations found.";
}

$conn->close();
?>
