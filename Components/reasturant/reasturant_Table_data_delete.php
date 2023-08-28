<?php 
include '../../connection.php';

$dbConnection = new DatabaseConnection();
$dbConnection->connect();

$table = "resturant";
$id = $_POST['restaurantId'];
$field = "resturant_id";

$success = $dbConnection->deleteRowById($table,$field, $id);

if ($success) {
    echo 'success';
} else {
    echo 'error';
}


?>
