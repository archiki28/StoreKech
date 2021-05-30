<?php
// Inialize session 
session_start(); 
//  include 'login.php';
 $message="";
// if(isset($_POST['login'])){
    include_once '../conn.php';

 if(isset($_POST['login']))
 {
     
     
     $mail=mysqli_real_escape_string($conn,$_POST['email']);
     $pass=mysqli_real_escape_string($conn,$_POST['psw']);
    
     $login ="SELECT * FROM users WHERE Email ='".$mail."' and Pass ='".$pass."'";
    
     $resultL = mysqli_query($conn,$login);
     $rows=mysqli_fetch_array($resultL);
     if(is_array($rows))
     {
         $_SESSION["id"]=$rows['id_U'];
         $_SESSION["email"]=$rows['Email'];
         $_SESSION["prenom"]=$rows['Prenom'];
         $_SESSION["nom"]=$rows['Nom'];
     }
     else{
         $message="No";
       
     }
     
 }
 if(isset($_SESSION["id"]))
 {
    $message="Yes";
    $sqlC="SELECT id_C FROM cart WHERE id_U='".$_SESSION['id']."'";
        $resulte = mysqli_query($conn, $sqlC);
        
        
        
        if (mysqli_num_rows($resulte) > 0) {
            $nb_procuit=mysqli_num_rows($resulte);
        } else {
            $nb_procuit="0";
        }
    
     
 }
 mysqli_close($conn);
?>