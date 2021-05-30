<?php
session_start();
require '../conn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="css/1.3.0/css/line-awesome.min.css">
    <script src="jquery-3.3.1.min.js"></script>
    <script>
        // Fonction to create the cookie
        function createCookie(name,value,days){
        var expires;
        if(days){
            var date =new Date();
            date.setTime(date.getTime()+(days*24*60*60*1000));
            expires="; expires="+date.toGMTString();

        }
        else{
            expires="";
        }
        document.cookie=escape(name)+"="+escape(value)+expires+";path=/";
        }

        $(document).ready(function(){
            if(window.history.replaceState){
            window.history.replaceState(null,null,window.location.href);
            }


            var temp=1;
            var x=0;
            var variable=[];
            while(x<30)
            {
                variable[x]=(temp).toString();
               
                x++;
            }


         
            $('input[type=submit]').click(function(){
                var id=$(this).attr('class');
                
                    
                    createCookie("id",id,10);
                    
                
                
            });
         
            $(".checkout").click(function(){
                alert(Allprice);
            }); 
        });
    </script>
    <link rel="stylesheet" href="css/stylecart.css">
    <style>
        .div {
            background-color: #b3b3ff ; 
            
            font-size: 15px ;
            text-align: center;
            margin: 10px; 
            height:350px;
            padding: 0px ;
            line-height: 8px ;
            border:1px solid #aaa;
            border-radius: 10px;
        }
        .div img{
            width: 70% ;
            height: 40% ;
            border-radius: 10px;
        }
        #remove{
            background-color: #04aa6d;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            width: 90%;
            margin-bottom: 20px;
            border-radius: 50px;
            opacity: 0.8;
            font-size:1rem;
            font-weight:bold;

            }
        #remove:focus{
            border:none;
        }
        input[type=button]:focus{
            border:none;
        }
        .products{
            color:#993d00;
        }
        @media only screen and (min-width:1200px)
        {
            .div{
                width: 18% ;
            }
            #remove{
                margin-top:-6px;
            }
        }
        @media only screen and (max-width:1200px) and (min-width:992px)
        {
            


            .div {
                width: 22% ;
                
            }
            
            
            
        }

        @media only screen and (max-width:992px ) and (min-width:768px) {
            .div{
                width: 30%;
            }
        }

        @media only screen and (max-width:768px)  and (min-width:576px){
            .div{
                width: 45%;
            }  
        }

        @media only screen and (max-width:576px) {
            
            .div{
                width: 80%;
            }
        }
        .checkout{
            width:90%;
            height: 60px;
            background:yellow;
            color:black;
            font-size:30px;
            font-weight:bold;
            border-radius:25px;
            border:none;
            opacity:0.8;
            cursor: pointer;
            margin-bottom:15px;
            text-align:center;
            text-decoration:none;
            padding-top:20px;
            
            
        }
        .checkout:hover{
            opacity: 1;
        }
    </style>
</head>
<body>
    <header>
          <h2>
            <label for="lback">
                <a href="home.php" target="_self"><span class="las la-angle-left" id="back"></span></a>
            </label>
           
          </h2>
          <h1>Cart</h1>
    </header>
    <main>
        <div class="flex-container">
        <?php
                
                
                
                if(isset($_SESSION['id'])){
                    $sql = "SELECT * FROM cart WHERE id_U ='".$_SESSION['id']."'";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                       
                        
                        $temp=1;
                        $Allprice=0;
                        
                        while($row = $result->fetch_assoc()) {
                            
                            
                            echo '<form method="POST" class="div" action="'.$_SERVER["PHP_SELF"].'">';
                            echo "<h2 class='title".$temp."'>" . $row["title"]."</h2>"."<br><img src='".$row["imgP"]."' class='img".$temp."'/> " .  
                                "<br/><h3>Qt : ".$row["Qt"]."<br/><br/>Price : ".$row["price_C"]."$</h3>
                                <br/><input type='submit' id='remove' class='".$row["id_C"]."' value='Remove' name='remove'/>";
                            echo"</form>";
                            $Allprice+=$row["price_C"];
                            $temp++;

                        

                        }
                        echo '
                        <a href="checkout.php" class="checkout">Checkout</a>';
                        $_SESSION["Allprice"]=$Allprice;
                    } else {
                        echo "<div class='products'><h2>There are not products!!!</h2></div>";
                    }
                    if(isset($_POST['remove']))
                    {
                        $id=$_COOKIE["id"];
                        $sqlDelet="DELETE FROM cart WHERE id_C =$id AND id_U ='".$_SESSION['id']."'";
                        $resultD = mysqli_query($conn, $sqlDelet);
                        echo "<meta http-equiv='refresh' content='0'>";
                    }
                }
                else {
                    echo "<div class='products'><h2>There are not products!!!</h2></div>";
                }

                
                $conn->close();
                
                
                
  
            ?>
        </div>
        
    </main>
</body>
</html>