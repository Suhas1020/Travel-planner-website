
<?php
// Start the session
session_start();

// Check if the destination ID is provided
if (isset($_POST['destination_id'])) {
    // Retrieve the destination ID from the request
    $destinationId = $_POST['destination_id'];

    // Check if the cart array exists in the session
    if (!isset($_SESSION['cart'])) {
        // If the cart array doesn't exist, create it
        $_SESSION['cart'] = [];
    }

    // Check if the destination ID is already in the cart
    if (in_array($destinationId, $_SESSION['cart'])) {
        // If the destination is already in the cart, return an error response
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Destination already in cart.']);
    } else {
        // Add the destination ID to the cart
        $_SESSION['cart'][] = $destinationId;

        // Return a success response
        echo json_encode(['status' => 'success', 'message' => 'Destination added to cart.']);
    }
} else {
    // If the destination ID is not provided, return an error response
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Destination ID is missing.']);
}
?>
