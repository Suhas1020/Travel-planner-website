<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Travel Planner</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<style>
    /* Additional styles specific to about.html */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        color: #000; /* Set default text color to black */
        display: flex; /* Use flexbox to align header, main, and footer */
        flex-direction: column; /* Stack header, main, and footer vertically */
        min-height: 100vh; /* Ensure the page takes at least the full viewport height */
    }

    header {
        background-color: rgba(0, 0, 0, 0.8);
        color: #fff;
        padding: 20px 0;
        padding: 45px;
        position: fixed; /* Make the header sticky */
        width: 100%; /* Take the full width of the viewport */
        top: 0; /* Stick to the top */
        z-index: 1000; /* Ensure the header is above other elements */
        display: flex; /* Use flexbox to align items */
        justify-content: space-between; /* Align items with space between */
        align-items: center; /* Align items vertically */
    }

    main {
        display: grid;
        grid-template-columns: 1fr 1fr; /* Create two columns with equal width */
        padding: 20px;
        flex: 1; /* Allow the main section to grow and take the available space */
        margin-top: 100px; /* Add margin to the top to prevent content from being hidden behind the header */
    }

    section {
        max-width: 100%;
    }

    .about-image {
        max-width: 100%;
    }

    h1 {
        font-size: 40px;
        margin-bottom: 30px; /* Increase the bottom margin for more spacing */
        color: #007bff; /* You can change the title color if needed */
        font-weight: bold; /* Set font weight to bold */
    }

    p {
        font-size: 24px;
        font-family: "Exo 2", sans-serif;
        font-optical-sizing: auto;
        font-weight: 150;
        font-style: normal;
        line-height: 1.6;
        font-weight: bold; /* Set font weight to bold */
    }

    img {
        max-width: 80%;
        height: auto; /* Ensure the image scales proportionally */
        border-radius: 75px; /* Add rounded corners to the image */
    }

    footer {
        background-color: #333;
        color: #fff;
        text-align: center;
        padding: 20px 0;
    }

    nav ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }

    nav ul li {
        display: inline;
        margin-left: 20px; /* Adjust spacing between navbar items */
    }
</style>

</head>
<body>
    <header>
        <?php include 'usernavbar.php'; ?>
    </header>

    <main>
        <section>
            <h1>About Us</h1>
            <p>Welcome to Travel Planner! <br> We are dedicated to providing you with the best travel planning experience. <br>Our platform allows you to discover amazing destinations,<br> plan your trips, and create unforgettable memories.<br></p>
            <p>Whether you're a solo traveler,<br> a couple on a romantic getaway,<br> or a family looking for adventure,<br> Travel Planner has everything you need to make your travel dreams a reality.</p>
        </section>

        <div class="about-image">
            <img src="about.jpg" alt="About Us Image">
        </div>
    </main>

    <footer>
        <p1>&copy; 2024 Travel Planner</p1>
    </footer>
</body>
</html>
