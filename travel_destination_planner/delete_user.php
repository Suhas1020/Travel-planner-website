<?php
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if userid is set and not empty
    if (isset($_POST["userid"]) && !empty($_POST["userid"])) {
        // Get the user ID from the POST data
        $userId = $_POST["userid"];

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

        // Prepare and execute SQL query to delete user
        $sql = "DELETE FROM users WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        // Check if deletion was successful
        if ($stmt->affected_rows > 0) {
            echo "User deleted successfully";
        } else {
            echo "Error deleting user";
        }

        // Close the prepared statement and database connection
        $stmt->close();
        $conn->close();
    } else {
        echo "User ID not provided";
    }
} else {
    // If the request method is not POST, return an error message
    echo "Invalid request method";
}
?>