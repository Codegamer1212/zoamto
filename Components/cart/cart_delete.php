<?php 

include '../../connection.php';
$db = new DatabaseConnection();

$connect = $db->connect();

$table = "cart";
$field ="cart_id";
$id=$_POST['cartItemId'];

$data = $db->DeleteRowById($table, $field, $id);
if($data) {
    echo "yes";
}
else {
    echo " no";
}
?>
