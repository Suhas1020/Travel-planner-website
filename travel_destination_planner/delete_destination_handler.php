<?php
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the destination ID is set and not empty
    if (isset($_POST["destination_id"]) && !empty($_POST["destination_id"])) {
        // Sanitize the destination ID to prevent SQL injection
        $destination_id = $_POST["destination_id"];
        
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

        // Prepare and execute SQL query to delete the destination
        $sql = "DELETE FROM destinations WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $destination_id);
        
        // Execute the statement
        if ($stmt->execute()) {
            // Close the prepared statement and database connection
            $stmt->close();
            $conn->close();
            
            // JavaScript code to display confirmation dialog and redirect to admin page
            echo '<script>
                    if (confirm("Destination deleted successfully. Do you want to go back to the admin page?")) {
                        window.location.href = "admin.php";
                    } else {
                        window.location.href = "admin.php";
                    }
                </script>';
        } else {
            echo "Error deleting destination: " . $conn->error;
        }
    } else {
        echo "Destination ID is not provided";
    }
} else {
    echo "Invalid request method";
}
?>
