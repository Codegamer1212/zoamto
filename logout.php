<?php
 session_start();
 require_once 'connection.php';
 $database = new DatabaseConnection();
unset( $_SESSION['user_id']);
$database->redirect('mainpage.php');
?>