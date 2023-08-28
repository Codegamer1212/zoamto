<?php

include '../../connection.php';
$database = new DatabaseConnection();
$database->connect();
if (!isset($_SESSION['user_id'])) {
    $database->redirect('mainpage.php');
  };

$id =$_POST['menuid'];
$restaurantData = $database->MenuItemShowById($id);
if($restaurantData){
    foreach($restaurantData as $restaurantfield){
    }
    echo json_encode($restaurantfield);
}
else{
    return " no data";
}

?>