<?php
include '../../connection.php';
$database = new DatabaseConnection();
$database->connect();
if (!isset($_SESSION['user_id'])) {
    $database->redirect('login.php');
  };
$id =$_POST['restaurantId']." AND owner_id =".$_SESSION['user_id'];
$table="resturant  ";
$field="resturant_id";
$restaurantData = $database->selectDatareatunrant($table, $field, $id);
if($restaurantData){
    foreach($restaurantData as $restaurantfield){
        
    }
    echo json_encode($restaurantfield);
}
else{
    return " no data";
}

?>
