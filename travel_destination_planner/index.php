<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Planner</title>
    <link rel="stylesheet" href="styles.css">
    <style>
    .adminpage-btn{
        position: absolute;
        bottom: 20px;
        right: 20px;
        padding: 10px 20px;
        background-color: #051321;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
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
    <a href="adminlogin.php"class="adminpage-btn">Adminlogin</a>
    <main>
        <section class="hero">
            <div class="hero-content">
                <h2>Explore Your Next Adventure</h2>
                <p>Discover amazing destinations around the world and plan your perfect trip.</p>
                <a href="login.php" class="btn">Get Started</a>

            </div>
        </section>
    </main>

    <footer>
        <div class="footer-container">
            <p>&copy; 2024 Travel Planner. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
