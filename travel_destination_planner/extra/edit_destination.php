<?php
// Check if destination ID is provided in the URL
if(isset($_GET['id'])) {
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'travel_destination_planner');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the destination ID from the URL
    $destination_id = $_GET['id'];

    // Prepare SQL statement to fetch destination details
    $stmt = $conn->prepare("SELECT name, description FROM destinations WHERE id = ?");
    $stmt->bind_param("i", $destination_id);
    $stmt->execute();
    $stmt->bind_result($name, $description);

    // Fetch destination details
    $stmt->fetch();

    // Close the prepared statement
    $stmt->close();

    // Close the database connection
    $conn->close();
} else {
    echo "Error: Destination ID not provided.";
    // Assuming $conn is your database connection
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Destination - Admin Panel</title>
    <link rel="stylesheet" href="admin_styles.css">
</head>
<body>
    <header>
        <h1>Edit Destination</h1>
    </header>

    <div class="container">
        <section>
            <form action="update_destination.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $destination_id; ?>">
                <label for="name">Destination Name:</label>
                <input type="text" name="name" value="<?php echo $destination; ?>" required><br>
                <label for="description">Description:</label>
                <textarea name="description" required><?php echo $description; ?></textarea><br>
                <button type="submit" class="button">Update Destination</button>
            </form>
        </section>
    </div>

    <footer>
        <p>&copy; 2024 Travel Planner</p>
    </footer>
</body>
</html>
