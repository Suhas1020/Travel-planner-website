<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Travel Planner</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('adminpanel.png');
            background-size: 100%;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: rgba(0, 0, 0, 0.8);
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin: 2;
        }

        main {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        section {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        button {
            padding: 15px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            text-align: center;
        }

        button:hover {
            background-color: #45a049;
        }

        footer {
            background-color: rgba(0, 0, 0, 0.8);
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }

        .adlogout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: rgba(255, 255, 255, 0.8);
            color: #333;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .adlogout-btn:hover {
            background-color: rgba(255, 255, 255, 0.9);
        }
    </style>
</head>
<body>
    <header>
        <h1>Admin Panel</h1>
        <a href="adminlogout.php" class="adlogout-btn">Logout</a>
    </header>

    <main>
        <!-- Add Destination button -->
        <section>
            <button onclick="window.location.href='add_destination.php'">Add Destination</button>
            <button onclick="window.location.href='delete_destination.php'">Delete Destination</button>
            <button onclick="window.location.href='view_login_sessions.php'">View Login Sessions</button>
            <button onclick="window.location.href='viewallorders.php'">View All Orders</button> <!-- Added button -->
        </section>
        <section>
            <button onclick="window.location.href='admincontact.php'">Contact Responses</button>
            <button onclick="window.location.href='userdetails.php'">User Details</button>
            <button onclick="window.location.href='destination.php'">View destination</button>
        </section>
    </main>

    <footer>
        &copy; 2024 Travel Planner
    </footer>
</body>
</html>
