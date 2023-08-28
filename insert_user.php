<?php
include 'connection.php';
$db = new DatabaseConnection();

$conenect = $db->connect();

$table = "users";

$username = $_POST['username'];
$name = $_POST['name'];
$email = $_POST['email'];
$phonenumber = $_POST['phone']; 
$address = $_POST['address'].", ".$_POST['city'].", ".$_POST['state'].", ".$_POST['country'].", ".$_POST['pincode'];
$password = $_POST['password'];
$role = $_POST['role'];

if ($db->checkUserExists($username, $email, $phonenumber)) {
    // User already exists, display an error message to the user
    echo "no";
} else {

$data = array(
    "username" => $username,
    "name" => $name,
    "email" => $email,
    "phonenumber" => $phonenumber, 
    "address" => $address,
    "password" => $password,
    "role" => $role
);

$inserted = $db->insertData($table, $data);


if ($inserted) {
    echo "yes";
} else {
    echo "Failed to insert data.";
}
}
?>
