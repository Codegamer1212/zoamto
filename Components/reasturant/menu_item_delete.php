<?php 
include '../../connection.php';

$dbConnection = new DatabaseConnection();
$dbConnection->connect();
if (!isset($_SESSION['user_id'])) {
    $dbConnection->redirect('mainpage.php');
  };
$table = "menu_items";
$id = $_POST['menuid'];
$field = "menu_id";

$success = $dbConnection->DeleteRowByIdiamge($table,$field, $id);

if ($success) {
    echo 'success';
} else {
    echo 'error';
}


?>
