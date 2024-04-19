<?php
// Database connection (same as before)

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_GET["id"])) {
    $destination_id = $_GET["id"];
    // Get user input from POST request (same as before)

    // Prepare and execute SQL statement to update destination data
    $stmt = $conn->prepare("UPDATE destinations SET name=?, description=?, image_url=? WHERE id=?");
    $stmt->bind_param("sssi", $name, $description, $image_url, $destination_id);

    if ($stmt->execute()) {
        // Destination updated successfully, redirect back to admin page
        header("Location: admin.php");
        exit();
    } else {
        // Error updating destination, redirect back to admin page with error message
        header("Location: admin.php?error=destination_update_failed");
        exit();
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
