<?php
    // session_start();
    if(isset($_SESSION["id"])){
        
        include '../conn.php';
        
        
        if(isset($_POST['addcart']))
        {
            $imgP=$_COOKIE["imgP"];
            $titleP=$_COOKIE["titleP"];
            $quantiteP=$_COOKIE["quantiteP"];
            $priceP=$_COOKIE["priceP"];
            
           if($quantiteP!=0)
           {
            $cart="INSERT INTO cart (Qt,title,price_C,imgP,id_U) VALUES ('".$quantiteP."','".$titleP."','".$priceP."','".$imgP."','".$_SESSION['id']."')";
            $res = mysqli_query($conn,$cart);
            echo "<meta http-equiv='refresh' content='0'>";
            
           }
            
        }
        mysqli_close($conn);
    }
    else{
        $nb_procuit="0";
    }
    
 
    
    

?>