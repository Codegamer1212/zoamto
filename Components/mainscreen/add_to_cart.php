<?php 

include '../../connection.php';
$db = new DatabaseConnection();

$conenect = $db->connect();
$table = "cart";
$id = $_POST['id'];
$quantity = $_POST['quantity'];
$user_id =$_SESSION['user_id'];
$shipping = rand(30, 60);
$date= date('Y-m-d H:i:s');


$data = array(
    "user_id" =>$user_id,
    "menu_id" => $id,
    "quantity" => $quantity,
    "shipping" => $shipping,
    "added_on" => $date
);

$inserted = $db->insertData($table, $data);

if ($inserted) {

    echo "Data inserted successfully.";
} else {
    echo "Failed to insert data.";
}
?>
