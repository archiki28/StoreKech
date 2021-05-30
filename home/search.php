<?php
    // session_start();
    $_SESSION['existe']="no";
    if(isset($_POST['search']))
    {
        // include 'conn.php';
        $_SESSION['existe']="yes";
        $_SESSION['search']=$_POST['value'];
    }
?>