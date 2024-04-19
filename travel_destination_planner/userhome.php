<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        /* Add your CSS styles here */
        /* For demonstration, let's assume basic styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
            position: relative;
            min-height: 100vh; /* Ensure the body covers at least the full viewport height */
        }

        h1 {
            margin-top: 50px;
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        .button-container button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            margin: 0 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button-container button:hover {
            background-color: #0056b3;
        }
        .logout-btn {
            position: absolute;
            top: 20px;
            right: 150px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .logout-btn:hover {
            background-color: #0056b3;
        }

        .bottom-image {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: -1;
        }
    </style>
</head>
<body>
    <h1>User Dashboard</h1>
    <a href="logout.php" class="logout-btn">Logout</a>
    <div class="button-container">
        <!-- Button to view cart -->
        <a href="view_cart.php"><button>My Cart</button></a>
        
        <!-- Button to view orders -->
        <a href="view_orders.php"><button>Orders</button></a>
        
        <!-- Button to book an order -->
        <a href="userpref.php"><button>Book an Order</button></a>
        <a href="destination.php"><button>View all destinations</button></a>
    </div>
    <img src="travel.png" alt="Travel Image" class="bottom-image">
</body>
</html>
