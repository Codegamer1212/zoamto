<?php
include 'connection.php';
$databaseConnection = new DatabaseConnection();
$databaseConnection->connect();



    $email = $_POST['email'];
    $password = $_POST['password'];
    $msg = $databaseConnection->login($email, $password);
   
 echo $msg;
 



?>