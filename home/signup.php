<?php
    include_once '../conn.php';
    $existe="";
    $sign="";
    if(isset($_POST['signup']))
    {
        $nom=mysqli_real_escape_string($conn,$_POST['nom']);
        $prenom=mysqli_real_escape_string($conn,$_POST['prenom']);
        $email=mysqli_real_escape_string($conn,$_POST['email']);
        $password=mysqli_real_escape_string($conn,$_POST['password']);
        $adresse=mysqli_real_escape_string($conn,$_POST['adresse']);
        $signup="SELECT * FROM users WHERE Email ='".$email."'";
        $result = mysqli_query($conn,$signup);
        $rows=mysqli_fetch_array($result);
        if(is_array($rows))
        {
            $existe="yes";
            echo "
                <script>
                    var existe=".json_encode($existe).";
                    if(existe=='yes')
                    {
                        alert('This Email existe!');
                    }
                </script>
            
            ";
        }
        else{
            $existe="no";
            $signup2="INSERT INTO  users (Nom,Prenom,Email,Pass,Adresse) VALUES ('".$nom."','".$prenom."','".$email."','".$password."','".$adresse."') ";
            $result2 = mysqli_query($conn,$signup2);
            if ($result2) {
                $sign="yes";
            } else {
                echo "Error";
            }

        }
        
    }
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
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
                /* display:none; */
            }
            .success h1{
                color:rgb(107, 55, 36);
                /* text-align:center; */
            }
            .form-container form{
                /* display:none; */
            }
            .success a{
                border-radius: 25px;
                background: rgb(12, 41, 41);
                color:#ddd;
                /* text-align:center; */
                text-decoration:none;
                font-size:17px;
                font-weight:bold;
                
                
            }
            /* a.home{
                width:30%;
            } */

            @media only screen and (min-width:1200px)
            {
                
                .form-container form{
                    width: 60%;
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
                .form-container form{
                    width: 70%;
                }
                
            }

            @media only screen and (max-width:992px ) and (min-width:768px) {
                .success a{
                    padding:7px 30% 7px 30%;
                }
                .form-container form{
                    width: 80%;
                }
                
            }

            @media only screen and (max-width:768px)  and (min-width:576px){
                .success a{
                    padding:7px 40% 7px 40%;
                }
                .form-container form{
                    width: 85%;
                }
            }

            @media only screen and (max-width:576px) {
                
                .success a{
                    padding:7px 40% 7px 40%;
                }
                .form-container form{
                    width: 90%;
                }
                
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
          <h1>Sign Up</h1>
    </header>
    <main>
        <div class="flex-container">
            <?php
                if($sign!="yes"){
                    echo '
                    <div class="form-container">
                    <form action="'.$_SERVER["PHP_SELF"].'" class="form-container" method="POST"  id="form">
                        
                        <label for="Nom">
                            <b>Nom</b>
                        </label><br/>
                        <input type="text" name="nom" placeholder="Entrez votre Nom" id="nom" required><br/>
                        <label for="Prenom">
                            <b>Prenom</b>
                        </label><br/>
                        <input type="text" name="prenom" placeholder="Entrez votre Prenom" id="prenom" required><br/>
                        <label for="email">
                            <b>Email</b>
                        </label><br/>
                        <input type="email" name="email" placeholder="Entrez votre Email" id="email" required><br/>
        
                        <label for="psw">
                            <b>Password</b>
                        </label><br/>
                        <input type="password" name="password" placeholder="Entrez votre Password" id="password" required><br/>
                        
                        <label for="adresse">
                            <b>Adresse</b>
                        </label><br/>
                        <input type="text" name="adresse" placeholder="Entrez votre Adresse" id="adrsse" required><br/>
        
                        <button type="submit" class="btnsignup" name="signup">Sign Up</button>
                        <!-- <button type="button" class="btnlogin cancel">Close</button> -->
                        <p>Avez-vous un Compte?   <b><a href="home.php">Login</a></b></p>
                    </form>
                    </div>
                    ';

                }
                else
                {
                    echo '
                    <div class="success">
                        <h1>Your account has been successfully registered</h1>
                        <br/><br/>
        
                        <span><a href="home.php" class="home">Go To Login</a></span>
    
                    </div>
                    ';
                    
                }
                
                
            ?>


            
        </div>
        
    </main>
</body>
</html>