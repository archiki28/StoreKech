<?php 
// Inialize session 
session_start(); 
// Deletecertain session 
unset($_SESSION['id']); 
unset($_SESSION['email']); 

//Jump to login page 
header('Location: home.php'); 
?>