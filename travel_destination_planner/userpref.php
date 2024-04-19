<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Preferences</title>
    <style>
        /* Add your CSS styles here */
        /* For demonstration, let's assume basic styling */
        body {
            font-family: Arial, sans-serif;
            background-image: url('choice.jpg'); /* Set the background image */
            background-size: cover; /* Cover the entire viewport */
            background-repeat: no-repeat; /* Do not repeat the background image */
            margin: 0;
            padding: 0;
            color: #fff; /* Set text color to white for better visibility on the background */
            opacity: 1;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            background-color: rgba(40, 40, 40, 0.8); /* Darker grey background */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            background-color: #fff; /* White background for input fields */
            color: #333; /* Set text color to dark grey */
        }

        input[type="checkbox"] {
            margin-right: 5px;
            transform: scale(1.5);
        }

        input[type="checkbox"]:checked {
            background-color: #007bff;
            color: #fff;
        }

        input[type="checkbox"]:focus {
            outline: none;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <form id="userPreferencesForm" action="process_user_preferences.php" method="post">
        <label for="destination_type">Destination Type:</label>
        <select name="destination_type" id="destination_type" onchange="populateActivities()">
            <option value="Beach">Beach</option>
            <option value="Mountain">Mountain</option>
            <option value="City">City</option>
            <option value="Countryside">Countryside</option>
        </select>

        <label>Interested Activities:</label>
        <div id="activities_checkbox">
            <!-- Activities will be dynamically populated based on the selected destination type -->
        </div>

        <label for="budget">Budget Range:</label>
        <select name="budget" id="budget">
            <!-- Budget options will be dynamically populated -->
        </select>

        <label for="num_travelers">Number of Travelers:</label>
        <input type="number" name="num_travelers" id="num_travelers" min="1">

        <input type="submit" value="Submit Preferences">
    </form>

    <script>
        // Function to populate activities based on the selected destination type
        function populateActivities() {
            var destinationType = document.getElementById("destination_type").value;
            var activitiesCheckbox = document.getElementById("activities_checkbox");

            // Clear existing options
            activitiesCheckbox.innerHTML = "";

            // Add activities based on destination type
            switch (destinationType) {
                case "Beach":
                    addCheckbox(activitiesCheckbox, "Swimming");
                    addCheckbox(activitiesCheckbox, "Sunbathing");
                    addCheckbox(activitiesCheckbox, "Snorkeling");
                    break;
                case "Mountain":
                    addCheckbox(activitiesCheckbox, "Hiking");
                    addCheckbox(activitiesCheckbox, "Climbing");
                    addCheckbox(activitiesCheckbox, "Skiing");
                    break;
                case "City":
                    addCheckbox(activitiesCheckbox, "Sightseeing");
                    addCheckbox(activitiesCheckbox, "Shopping");
                    addCheckbox(activitiesCheckbox, "Dining");
                    break;
                case "Countryside":
                    addCheckbox(activitiesCheckbox, "Cycling");
                    addCheckbox(activitiesCheckbox, "Fishing");
                    addCheckbox(activitiesCheckbox, "Nature walks");
                    break;
                default:
                    break;
            }
        }

        // Function to add a checkbox
        function addCheckbox(container, label) {
            var checkbox = document.createElement("input");
            checkbox.type = "checkbox";
            checkbox.name = "interested_activities[]";
            checkbox.value = label;
            container.appendChild(checkbox);

            var text = document.createTextNode(label);
            container.appendChild(text);

            container.appendChild(document.createElement("br"));
        }

        // Function to populate budget options with a 500 buffer until 10,000
        function populateBudget() {
            var selectBudget = document.getElementById("budget");
            selectBudget.innerHTML = ""; // Clear existing options

            // Add budget options
            var minBudget = 0;
            var maxBudget = 10000;
            var buffer = 1000;

            for (var i = minBudget; i <= maxBudget; i += buffer) {
                var option = document.createElement("option");
                option.value = i;
                option.text = "₹" + i + " - ₹" + (i + buffer);
                selectBudget.appendChild(option);
            }
        }

        // Call populateActivities and populateBudget functions on page load
        window.onload = function() {
            populateActivities();
            populateBudget();
        };
    </script>
</body>
</html>