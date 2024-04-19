<?php
session_start();

// Check if username and password are set
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if username and password match
    if ($username === "admin" && $password === "password123") {
        // Authentication successful, redirect to admin 
        $_SESSION['username'] = $username; // Store username in session
        header("Location: admin.php");
        exit();
    } else {
        // Authentication failed, set error message
        $error = "Invalid username or password";
    }
} else {
    // Initialize username to empty string if not set
    $username = "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin Panel</title>
    <style>
        body {
            background-image: url('adlogin.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
            font-size: 2.5rem;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #555;
            font-weight: bold;
            text-align: left;
            font-size: 1.2rem;
        }

        input[type="text"],
        input[type="password"] {
            width: calc(100% - 24px);
            padding: 12px;
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
            background-color: #f4f4f4;
            color: #333;
            box-sizing: border-box;
            transition: background-color 0.3s ease;
            font-size: 1.2rem;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            background-color: #e0e0e0;
        }

        .password-toggle {
            margin-left: -30px;
            cursor: pointer;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            right: 10px;
            background: none;
            border: none;
        }

        .password-toggle img {
            width: 20px;
            height: auto;
            cursor: pointer;
        }

        button[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 1.2rem;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error {
            color: #ff0000;
            margin-bottom: 20px;
        }

        .index-btn {
            display: block;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            transition: color 0.3s ease;
            font-size: 1.2rem;
        }

        .index-btn:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <?php if(isset($error)) { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>
        <form id="loginForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required>
            <label for="password">Password</label>
            <div style="position: relative;">
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
                <button type="button" class="password-toggle" onclick="togglePasswordVisibility()">
                    <img src="eye.png" alt="Show Password">
                </button>
            </div>
            <button type="submit">Login</button>
        </form>
        <a href="index.php" class="index-btn">Back to Home</a>
    </div>

    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("password");
            var button = document.querySelector(".password-toggle");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                button.innerHTML = '<img src="eye-off.png" alt="Hide Password">';
            } else {
                passwordField.type = "password";
                button.innerHTML = '<img src="eye.png" alt="Show Password">';
            }
        }
    </script>
</body>
</html>
