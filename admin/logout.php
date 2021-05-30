<?php 
// Inialize session 
session_start(); 
// Deletecertain session 
unset($_SESSION['admin_id']); 
unset($_SESSION['admin_email']); 

//Jump to login page 
header('Location: login.php'); 
?>