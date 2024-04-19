<?php
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the message ID is set in the POST data
    if (isset($_POST["id"])) {
        // Sanitize the message ID
        $messageId = $_POST["id"];

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

        // Prepare and execute SQL query to delete the message
        $sql = "DELETE FROM contact_messages WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $messageId);
        $stmt->execute();

        // Close the prepared statement and database connection
        $stmt->close();
        $conn->close();

        // Send a success response
        http_response_code(200);
        exit();
    }
}

// If the request method is not POST or the message ID is not set, send a failure response
http_response_code(400);
exit();
?>
