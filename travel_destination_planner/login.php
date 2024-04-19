<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Travel Planner</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Additional styles for the eye icon */
        .password-container {
            position: relative;
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .password-input {
            flex: 1;
            height: 100%;
            box-sizing: border-box;
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .password-toggle img {
            width: 20px;
            height: auto;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <h1>Travel Planner</h1>
            <?php include 'usernavbar.php'; ?>
        </div>
    </header>

    <main class="login-page">
        <section class="login-section">
            <div class="login-container">
                <h2>Login to Your Account</h2>
                <!-- Login Form -->
                <form action="login.php" method="POST">
                    <input type="email" name="email" placeholder="Email" required>
                    <div class="password-container">
                        <input type="password" name="password" id="password" class="password-input" placeholder="Password" required>
                        <div class="password-toggle" onclick="togglePasswordVisibility()">
                            <img src="eye.png" alt="Show Password">
                        </div>
                    </div>
                    <button type="submit" class="btn">Login</button>
                    <div id="error-message" style="color: red;"></div> <!-- Error message display area -->
                </form>
                <p>Don't have an account? <a href="signup.php">Signup</a></p>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-container">
            <p>&copy; 2024 Travel Planner. All rights reserved.</p>
        </div>
    </footer>

    <?php
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'travel_destination_planner');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get user input from POST request
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepare and execute SQL statement
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                // Start a session to store user information
                session_start();
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];

                // Generate a unique session token
                $session_token = bin2hex(random_bytes(32)); // Generate a 64-character hexadecimal token

                // Insert login session data into the session table
                $user_id = $row['user_id'];
                $login_time = date('Y-m-d H:i:s');
                $insert_query = "INSERT INTO login_sessions (user_id, login_time, session_token) VALUES ('$user_id', '$login_time', '$session_token')";
                $conn->query($insert_query);

                // Store session token in session data
                $_SESSION['session_token'] = $session_token;

                // Redirect to user home page
                header("Location: userhome.php");
                exit();
            } else {
                echo "<script>document.getElementById('error-message').innerText = 'Invalid email or password';</script>";
            }
        } else {
            echo "<script>document.getElementById('error-message').innerText = 'User not found';</script>";
        }

        $stmt->close();
    }
    $conn->close();
    ?>
</body>
</html>
