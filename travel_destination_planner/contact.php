<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Travel Planner</title>
    <link rel="stylesheet" href="styles.css">
<style>.content-section {
    display: flex;
}

.contact-form-container {
    flex: 1;
    background-color: #f2f2f2;
    padding: 30px;
    border-radius: 12px;
    text-align: center;
    margin: 20px;
}

.contact-form {
    text-align: left;
}

.contact-form label {
    display: block;
    margin-bottom: 15px;
}

.contact-form input,
.contact-form textarea {
    width: 100%;
    padding: 15px;
    margin-bottom: 20px;
    box-sizing: border-box;
}

.contact-form button {
    background-color: #373825;
    color: white;
    padding: 15px 30px;
    border: none;
    cursor: pointer;
    font-size: 20px;
    border-radius: 6px;
}

.contact-form button:hover {
    background-color: darkblue;
}

.image-container {
    flex: 1;
    text-align: center;
    margin: 20px;
}

.trip-image {
    max-width: 100%;
    border-radius: 10px;
}

footer {
    background-color: black;
    color: white;
    text-align: center;
    padding: 10px;
}</style>
</head>
<body>
    <header>
        <div class="header-container">
            <h1>Travel Planner</h1>
            <?php include 'usernavbar.php'; ?>
        </div>
    </header>

    <main>
        <section class="content-section">
            <div class="contact-form-container">
                <h2>Contact Us</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="contact-form">
                    <label for="name">Your Name:</label>
                    <input type="text" id="name" name="name" required>

                    <label for="email">Your Email:</label>
                    <input type="email" id="email" name="email" required>

                    <label for="message">Your Message:</label>
                    <textarea id="message" name="message" rows="4" required></textarea>
                    <button type="submit">Send Message</button>
                </form>
            </div>

            <div class="image-container">
                <img src="trip2.jpg" alt="Trip Image" class="trip-image">
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-container">
            <p>&copy; 2024 Travel Planner. All rights reserved.</p>
        </div>
    </footer>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $name = $_POST["name"];
        $email = $_POST["email"];
        $message = $_POST["message"];

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

        // Prepare and execute SQL query to insert data
        $sql = "INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $message);
        $stmt->execute();

        // Close the prepared statement and database connection
        $stmt->close();
        $conn->close();

        // Redirect back to the contact page or another page
        header("Location: contact.php");
        exit();
    }
    ?>
</body>
</html>
