<?php 
include '../../connection.php';
$db = new DatabaseConnection();

$conenect = $db->connect();


$table = "resturant";


$restaurant_name = $_POST['restaurant_name'];
$location = $_POST['location'];
$contact_Number = $_POST['contact_number'];
$availability = $_POST['availability']; 

$data = array(
    "restaurant_name" => $restaurant_name,
    "location" => $location,
    "contact_number" => $contact_Number,
    "availabilty" => $availability,
    "owner_id " =>$_SESSION['user_id'],
    
);

$id = $_POST['restaurant_id'];
$field = 'resturant_id '; 

if (!empty($id)) {
    $result = $db->updateMenuData($table, $data, $id, $field);
    if ($result) {
        echo "Data updated successfully!";
       
    } else {
        echo "Failed to update data.";
    }
} else {
    $result = $db->insertData($table, $data);
    if ($result) {
        echo "Data inserted successfully!";
       
    } else {
        echo "Failed to insert data.";
    }
}
?>
