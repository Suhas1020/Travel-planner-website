<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Destination - Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }

        main {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin: 0;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button.delete-btn {
            display: block;
            width: 100%;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button.delete-btn:hover {
            background-color: #0056b3;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
        /* CSS for navbar */
nav {
    background-color: #333;
    padding: 10px 0;
}

nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    text-align: center;
}

nav ul li {
    display: inline;
    margin: 0 10px;
}

nav ul li a {
    color: #fff;
    text-decoration: none;
    padding: 10px 20px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

nav ul li a:hover {
    background-color: #555;
}

    </style>
</head>
<body>
    <header>
        <h1>Delete Destination</h1>
        <?php include 'navbar.php'; ?>
    </header>

    <main>
        <form action="delete_destination_handler.php" method="POST">
            <label for="destination_id">Select Destination to Delete:</label>
            <select name="destination_id" required>
                <option value="">Select Destination</option>
                <?php
                // Database connection
                $conn = new mysqli('localhost', 'root', '', 'travel_destination_planner');

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch destinations from database
                $sql = "SELECT id, name FROM destinations";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
                    }
                } else {
                    echo "<option value=''>No destinations found</option>";
                }

                $conn->close();
                ?>
            </select>
            <button type="submit" class="delete-btn">Delete Destination</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 Travel Planner</p>
    </footer>
</body>
</html>
