<?php
    session_start();
    include '../conn.php';
    echo '<script>';
    echo 'var Allprice='.json_encode($_SESSION["Allprice"]).';';
    echo' </script>';

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
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
            
            createCookie("signin","no",10);

        });
    </script>
    <link rel="stylesheet" href="css/stylesignup.css">
    <style>
            
            .success{
                text-align:center;
                
            }
            .success h1{
                color:rgb(107, 55, 36);
                
            }
            .flex-container {
                display:flex ;
                flex-wrap: wrap;
                width: 100%;
            }
            .success a{
                border-radius: 25px;
                background: rgb(12, 41, 41);
                color:#ddd;
                text-decoration:none;
                font-size:17px;
                font-weight:bold;
                
                
            }
            
            .payment{
                   
                    
                    
                    margin:20px 20px 20px 20px;
            }
            .pay{
                background:grey;
                border-radius:10px;
                height: 150px;
            }
            .pay h2{
                color:#fff;
                text-align:center;
                font-size:30px;
                padding-top:60px;
            }
            .paypal{
                margin-top:10px;
            }
            .form-container {
                margin:10px !important;
                padding:0px !important;
            }
            .form-container form{
                width:100%;
            }
            @media only screen and (min-width:1200px)
            {
                
                .form-container {
                    width: 65%;
                }
                .payment{
                    width: 30%;
                }
                .success a{
                    padding:7px 10% 7px 10%;
                }
                
            }

            @media only screen and (max-width:1200px) and (min-width:992px)
            {
               
                .success a{
                    padding:7px 20% 7px 20%;
                }
                .form-container {
                    width: 65%;
                }
                .payment{
                    width: 30%;
                }
            }

            @media only screen and (max-width:992px ) and (min-width:768px) {
                .success a{
                    padding:7px 30% 7px 30%;
                }
                .form-container {
                    width: 80%;
                }
                .payment{
                    width: 80%;
                    margin:10px;
                }
                
            }

            @media only screen and (max-width:768px)  and (min-width:576px){
                .success a{
                    padding:7px 40% 7px 40%;
                }
                .form-container {
                    width: 85%;
                }
                .payment{
                    width: 85%;
                    margin:10px;
                }
            }

            @media only screen and (max-width:576px) {
                
                .success a{
                    padding:7px 40% 7px 40%;
                }
                .form-container {
                    width: 90%;
                }
                .payment{
                    width: 90%;
                    
                }
                .form-container input{
                    width:85% !important;
                }
            }
            .payment a{
                border:none;
                background:none;
                width:100%;
            }
    </style>
</head>
<body>
    <header>
          <h2>
            <label for="lback">
                <a href="cart.php" target="_self"><span class="las la-angle-left" id="back"></span></a>
            </label>
           
          </h2>
          <h1>Checkout</h1>
    </header>
    <main>
        <div class="flex-container">
                    <?php
                         if(isset($_SESSION['id'])){
                            $sql = "SELECT * FROM users WHERE id_U ='".$_SESSION['id']."'";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();

                            }
                        }

                    echo '
                    <div class="form-container">
                    <form action="success.php" class="form-container" method="POST"  id="form">
                        
                        <label for="Nom">
                            <b>Nom</b>
                        </label><br/>
                        <input type="text" name="nom" value="'.strtoupper($row['Nom']).'" id="nom" required><br/>
                        <label for="Prenom">
                            <b>Prenom</b>
                        </label><br/>
                        <input type="text" name="prenom" value="'.strtoupper($row['Prenom']).'" id="prenom" required><br/>
                        <label for="email">
                            <b>Email</b>
                        </label><br/>
                        <input type="email" name="email" value="'.$row['Email'].'" id="email" required><br/>
        
                        <label for="Country">
                            <b>Country</b>
                        </label><br/>
                        <input type="text" name="country" placeholder="Entrez votre Country" id="country" required><br/>
                        
                        <label for="City">
                            <b>City</b>
                        </label><br/>
                        <input type="text" name="city" placeholder="Entrez votre City" id="city" required><br/>

                        <label for="adresse">
                            <b>Adresse</b>
                        </label><br/>
                        <input type="text" name="adresse" value="'.$row['Adresse'].'" id="adrsse" required><br/>
                        
                        <label for="Zip">
                            <b>Zip Code</b>
                        </label><br/>
                        <input type="text" name="zip" placeholder="Entrez votre Zip Code" id="zip" required><br/>

                        
                       
                    </form>
                    </div>';
                    ?>
                    <div class="payment">
                        <div class="pay">
                        <h2>Total  Prices :<?php echo $_SESSION["Allprice"];?></h2>
                        </div>
                       
                        <div class="paypal"></div>
                    </div>
                    
                   
                   
           
               
                <?php
                    mysqli_close($conn);
                ?>

            
        </div>
        
    </main>
    
<script src="https://www.paypal.com/sdk/js?client-id=AXWg12p6O0jfodHbxiddIK49g0kvAubKM7JMbv2YIh30K_eLulAY-buPMc5w0kc0YTNvYtCW7YROLBhk&disable-funding=credit,card"></script>
<script src="paypal.js"></script>
</body>
</html>