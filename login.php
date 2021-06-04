<?php
   // Inialize session 
   session_start(); 

   //call the file the connection
   include '../conn.php';
// check the click on login 
 if(isset($_POST['login']))
 {
     
    //  convert the input data to string 
     $mail=mysqli_real_escape_string($conn,$_POST['email']);
     $pass=mysqli_real_escape_string($conn,$_POST['password']);
    // Get data from table admin 
     $login ="SELECT * FROM admin WHERE Email ='".$mail."' and Pass ='".$pass."'";
    
     $resultL = mysqli_query($conn,$login);
     $rows=mysqli_fetch_array($resultL);
     if(is_array($rows))
     {
        //  Create variable session 
         $_SESSION["admin_id"]=$rows['id'];
         $_SESSION["admin_email"]=$rows['Email'];
         $_SESSION["admin_name"]=$rows['Name'];
         
     }
     
     
 }
//  Check the admin_id is not empty 
 if(isset($_SESSION["admin_id"]))
 {
    
     header("Location:admin.php");
     
 }
 mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="css/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="css/stylelogin.css">
  
</head>
<body>
<!-- Design the form login  -->
<div  class="modal-login" id="mymodal">
         <div class="form-popup" id="myForm"> 
            <form action="" class="form-container" method="POST"  id="form" enctype="multipart/form-data">
                
                <label for="Email">
                    <b>Email</b>
                </label>
                <input type="Email" name="email" placeholder="Enter Email" id="email" required>

                <label for="Password">
                    <b>Password</b>
                </label>
                <input type="password" name="password" placeholder="1111111111111" id="password" required>

                <button type="submit" class="btnadd login" name="login">Login</button>
                <button type="button" class="btnadd cancel">Password inccorect</button>
            </form>
           </div>
        </div>
</body>
</html>