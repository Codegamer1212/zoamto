<?php
include '../../connection.php';
$db = new DatabaseConnection();
$conenect = $db->connect();

$userid = $_SESSION['user_id'];
$data = $db->Selectcart($userid);
$total = 0;
$Shipping = 0;
$cartItems = array(); 

foreach ($data as $value45) {
    $cartItem = array(
        'cart_id' => $value45['cart_id'],
        'product_image' => $value45['product_image'],
        'item_name' => $value45['item_name'],
        'quantity' => $value45['quantity'],
        'price' => $value45['price'],
        'shipping' => $value45['shipping'],
    );

    // Calculate and add the total of each item to the overall total
    $total += $value45['price'] * $value45['quantity'];
    $Shipping += $value45['shipping'];

    // Add the cart item to the array
    $cartItems[] = $cartItem;
}

// Create an array to hold the cart summary
$cartSummary = array(
    'total' => $total,
    'shipping' => $Shipping,
);

// Combine cart items and summary into a single response array
$response = array(
    'cartItems' => $cartItems,
    'cartSummary' => $cartSummary,
);

// Convert the response array to JSON and output it
header('Content-Type: application/json');
echo json_encode($response);
?>

 
