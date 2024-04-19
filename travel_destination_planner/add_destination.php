<?php
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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $type = $_POST['type'];
    $budget = $_POST['budget'];
    $activities = implode(", ", $_POST['activities']); // Convert array to string
    $image = $_FILES['image']['name']; // Assuming image upload is handled correctly

    // Insert data into the database
    $sql = "INSERT INTO destinations (name, description, type, budget, activities, image) VALUES (?, ?, ?, ?, ?, ?)";
    
    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);

    // Bind parameters and execute the statement
    $stmt->bind_param("ssssss", $name, $description, $type, $budget, $activities, $image);

    if ($stmt->execute()) {
        // Display a success message
        echo "<script>alert('Destination added successfully!');</script>";
    } else {
        // Display an error message
        echo "<script>alert('Error adding destination: " . $conn->error . "');</script>";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Destination - Admin Panel</title>
    <style>
        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }

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


        /* Rest of the CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
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
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        select[multiple] {
            height: 100px;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Add Destination</h1>
        <?php include 'navbar.php'; ?>
    </header>

    <div class="container">
        <section>
            <form id="destinationForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                <label for="name">Destination Name:</label>
                <input type="text" name="name" required>
                <label for="description">Description:</label>
                <textarea name="description" required></textarea>
                <label for="type">Type:</label>
                <select id="typeSelect" name="type" required>
                    <option value="">Select Type</option>
                    <option value="Beach">Beach</option>
                    <option value="Mountain">Mountain</option>
                    <option value="City">City</option>
                    <option value="Countryside">Countryside</option>
                    <option value="Temple">Temple</option>
                </select>
                <label for="budget">Budget:</label>
                <select name="budget" required>
                    <option value="">Select Budget</option>
                    <option value="0-500">0 - 500</option>
                    <option value="500-1000">500 - 1000</option>
                    <option value="1000-5000">1000 - 5000</option>
                    <option value="5000-10000">5000 - 10000</option>
                    <option value="10000+">10000+</option>
                </select>
                <label for="activities">Activities:</label>
                <select name="activities[]" id="activitiesSelect" multiple required>
                    <!-- Activities options will be dynamically added here -->
                </select>
                <label for="image">Upload Image:</label>
                <input type="file" name="image" accept="image/*" required>
                <button type="submit">Add Destination</button>
            </form>
        </section>
    </div>

    <footer>
        <p>&copy; 2024 Travel Planner</p>
    </footer>

    <script>
        // Define activities options based on type
        const activitiesOptions = {
            Beach: ["Swimming", "Surfing", "Sunbathing"],
            Mountain: ["Hiking", "Camping", "Skiing"],
            City: ["Sightseeing", "Shopping", "Dining"],
            Countryside: ["Nature Walks", "Fishing", "Picnicking"],
            Temple: ["Spiritual Practices", "Meditation", "Cultural Exploration"]
        };

        // Function to update activities dropdown based on selected type
        function updateActivities() {
            const typeSelect = document.getElementById("typeSelect");
            const activitiesSelect = document.getElementById("activitiesSelect");
            const selectedType = typeSelect.value;

            // Clear previous options
            activitiesSelect.innerHTML = "";

            // Add options based on selected type
            if (selectedType && activitiesOptions[selectedType]) {
                activitiesOptions[selectedType].forEach(activity => {
                    const option = document.createElement("option");
                    option.value = activity;
                    option.text = activity;
                    activitiesSelect.appendChild(option);
                });
            }
        }

        // Add event listener to type select to update activities options
        document.getElementById("typeSelect").addEventListener("change", updateActivities);

        // Call the function initially to populate activities based on default selected type
        updateActivities();
    </script>
</body>
</html>