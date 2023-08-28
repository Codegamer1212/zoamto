<?php
include '../../connection.php';
$db = new DatabaseConnection();

$conenect = $db->connect();
if(isset ($_POST['submit'])){
    
$table = "orders";
$totalamout = $_POST['totalPrice'];
$tax = $_POST['gst'];
$shipping = $_POST['shippingCharge'];
$grandtotalamont = $_POST['grandTotal'];
$payment_id = $_POST['Payment'];
$data = date('Y-m-d H:i:s');


$data = array(
    "user_id" => $_SESSION['user_id'],
    "totalamout" => $totalamout,
    "tax" => $tax,
    "shpping" => $shipping,
    "grandtotalamont" => $grandtotalamont,
    "payment_id" => $payment_id,
    "create_time" => $date,
);

$result = $db->insertData($table, $data);

if ($result) {
    header("Location: sucess.php");
    $order_id = $db->getConnection()->insert_id;
    $userid = $_SESSION['user_id'];
    $data = $db->Selectcart($userid);
    $cartItems = array();

    foreach ($data as $value45) {
        $cartItem = array(
            'menu_id' => $value45['menu_id'],
            'quantity' => $value45['quantity'],
            'price' => $value45['price'],
        );
        $cartItems[] = $cartItem;
    }

    if (count($cartItems) > 0) {
        $success = $db->insertOrderItemsBatch($cartItems, $order_id);

        if ($success) {
            $table789 = "cart";
            $field45 = "user_id";
            $id89 =$_SESSION['user_id'];
            $data = $db->DeleteRowById($table789, $field45, $id89);
        } else {
           
        }
    }
} else {
    echo "Failed to insert data.";
}

}