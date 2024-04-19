<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - Travel Planner</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="header-container">
            <h1>Travel Planner</h1>
            <?php include 'usernavbar.php'; ?>
        </div>
    </header>

    <main class="signup-page">
        <section class="signup-section">
            <div class="signup-container">
                <h2>Create Your Account</h2>
                <!-- Signup Form -->
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit" class="btn">Signup</button>
                </form>
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-container">
            <p>&copy; 2024 Travel Planner. All rights reserved.</p>
        </div>
    </footer>

    <?php
    // Function to validate password
    function validatePassword($password) {
        // Check if password length is at least 8 characters
        if (strlen($password) < 8) {
            return false;
        }

        // Check if password contains at least one special character, one number, one uppercase letter, and one lowercase letter
        if (!preg_match("/^(?=.*[!@#$%^&*()])(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z]).{8,}$/", $password)) {
            return false;
        }

        return true;
    }

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "travel_destination_planner";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get user input from POST request
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Validate password
        if (!validatePassword($password)) {
            // Password does not meet requirements, redirect back to signup page with error message
            header("Location: signup.php?error=password_requirements");
            exit();
        }

        // Hash password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute SQL statement
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashedPassword);

        if ($stmt->execute()) {
            // Registration successful, redirect to login page
            header("Location: login.php");
            exit();
        } else {
            // Error registering user, redirect back to signup page with error message
            header("Location: signup.php?error=registration_failed");
            exit();
        }

        $stmt->close();
    }
    $conn->close();
    ?>
</body>
</html>
