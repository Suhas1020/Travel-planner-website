<?php
// Start the session
session_start();

// Check if the destination ID is provided in the POST request
if (isset($_POST['destination_id'])) {
    // Retrieve the destination ID from the POST data
    $destinationId = $_POST['destination_id'];

    // Check if the cart array exists in session
    if (isset($_SESSION['cart'])) {
        // Find the index of the destination ID in the cart array
        $index = array_search($destinationId, $_SESSION['cart']);

        // If the destination ID is found, remove it from the cart array
        if ($index !== false) {
            unset($_SESSION['cart'][$index]);
            echo "Item removed from cart successfully.";
        } else {
            // If the destination ID is not found, return an error message
            echo "Item not found in cart.";
        }
    } else {
        // If the cart array does not exist in session, return an error message
        echo "Cart is empty.";
    }
} else {
    // If the destination ID is not provided in the POST request, return an error message
    echo "Destination ID not provided.";
}
?>
