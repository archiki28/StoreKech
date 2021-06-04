<?php
require 'login.php';
require 'addCart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
    <title>Clothes</title>
    <link rel="icon" href="icon/clothes.png" type="image/icon type">
    <link rel="stylesheet" href="css/style3.css">
    <link rel="stylesheet" href="css/style4.css">
    <link rel="stylesheet" href="css/1.3.0/css/line-awesome.min.css">
    <script src="jquery-3.3.1.min.js"></script>
   <style>
       .sidebar-menu a:hover {
            color: var(--main-color);
            background: #fff;
            padding-top: 1rem;
            padding-bottom: 1rem;
            
            border-radius: 30px 0px 0px 30px;
            
        }       
       /* Button login */
       .modal-login{
        display: none;
        position: fixed;
        z-index: 1;
        right: 0px;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
       }
      
        .form-popup{
           
            margin-top: 65px;
            margin-right: 15px;
           
            padding: 20px 0 20px;
            float: right;
        }
        .form-container{
            max-width: 300px;
            padding: 10px;
            background-color: white;
        }
        .form-container input[type=text],.form-container input[type=password]
        {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            border: none;
            background:#f1f1f1;
        }

        .form-container input[type=text]:focus,.form-container input[type=password]:focus{
            background-color: #ddd;
            outline: none;
        }
        .form-container .btnlogin{
            background-color: #04aa6d;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            margin-bottom: 10px;
            opacity: 0.8;
        }

        .form-container .cancel{
            background-color: red;
        }

        .form-container .btnlogin:hover{
            opacity: 1;
        }
        p.log{
            margin-top:100px;
            align-items: baseline;
            text-align:center;
            border:1px solid #000;
            border-radius:25px;
            padding:10px;
            background:red;
            font-weight:bold;
            
            
        }
        .log a{
            color:white;
        }
        .form-popup h1{
            text-align:center;
            color:#ff944d;
            
            border:2px solid #ff944d;
            margin-bottom:15px;
        }
        .form-popup h4{
            margin-top:-20px;
            margin-bottom:20px;
        }
        .form-popup .right{
            float:right;
        }
        .form-popup .left{
            font-size:20px;
            text-align:center;
            background: blue;
            color: white;
            width: 40px;
            height: 35px;
            border-radius: 50%;
            padding-top:5px;
            margin-right: 1rem;
            cursor: pointer;
            float: left;
        }
        .close2{
            color: #fff;
            float: right;
            font-size: 28px;
            font-weight: bold;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background:grey;
            
            padding-bottom:7px;
            text-align:center;
        }
        .close2:hover,
        .close2:focus{
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .modal-signin .form-container{height:200px;}
        h1.user{
            text-align:center;
           
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 1rem;
            cursor: pointer;
        }
        .user span{
            background: grey;
            color: white;
            text-align:center;
            
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 1rem;
            cursor: pointer;
        }
        .search-wrapper button{
            border: none;
            display: inline-block;
            
            font-size: 1.5rem;
            background: transparent;
            cursor: pointer;
        }
        .footer h4{
            padding:20px ;
        }
   </style>
    
    
</head>
<body>
    <input type="checkbox" name="" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
        <h2><span class="lab la-envira"></span><span>StoreKech</span></h2>

        </div>
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="home.php" ><span class="las la-home"></span>
                    <span>Home</span></a>
                </li>
                <li >
                    <a href="electronic.php"><span class="las la-laptop-code"></span>
                    <span>Electronic Devices</span></a>
                    
                    
                </li>
                <li >
                    <a href="clothes.php" class="active"><span class="las la-tshirt"></span>
                    <span>Clothing and Accessories</span></a>
                    
                </li>
                <li >
                    <a href="sport.php"><span class="las la-dumbbell"></span>
                    <span>Sports and Hobbies</span></a>
                    
                </li>
                <li >
                    <a href="house.php"><span class="las la-couch"></span>
                    <span>Houses and Gardens</span></a>
                    
                </li>
            </ul>
        </div>
    </div>
    <div class="main-content">
        <header>
          <h2>
            <label for="nav-toggle">
                <span class="las la-bars"></span>
            </label>
            Dashbord
          </h2>
          <div class="search-wrapper">
              <form action="home.php" method="POST">
              <button type="submit" name="search"><span class="las la-search" ></span></button>
              <input type="search" placeholder="Search here" name="value"/>
              </form>
          </div>
          
          
            <!-- The form login -->
        <div  class="modal-login">
       <div class="form-popup" id="myForm"> 
           <?php 
           if($message=="Yes")
           {
            $nom=$_SESSION["nom"];
            $prenom=$_SESSION["prenom"];
            $username=substr($_SESSION["prenom"],0,1);
            $username=strtoupper($username);
            echo '
            <div class="modal-signin">
            <span class="close2">&times;</span> 
            <div class="form-container">
              
              <h2><span class="left">'.$username.'</span><span class="right">'.$prenom.' '.$nom.'</span></h2>

              <p class="log"><a href="logout.php" >Logout</a></p> 
            </div></div>
            ';
           echo '
                <script>
                    $(document).ready(function(){
                        $(".user").html("'.$username.'")
                                  .css("background","blue");
                    });
                </script>
           ';
           }
           else{
            if(count($_POST)>0)
            {
                
                echo '
                    
                    <form action="home.php" class="form-container" method="POST"  id="form">
                        <h1>Login</h1>
                        
                        <label for="email">
                            <b>Email</b>
                        </label>
                        <input type="text" name="email" placeholder="Enter Email" id="email" required>

                        <label for="psw">
                            <b>Password</b>
                        </label>
                        <input type="password" name="psw" placeholder="Enter Password" id="password" required>
                        <h4 style="color:red">Invalid Email or Password</h4>

                        <button type="submit" class="btnlogin login" name="login">Login</button>
                        <button type="button" class="btnlogin cancel">Close</button>
                        <p>Do Not Have an Account?   <b><a href="signup.php">Sign Up</a></b></p>
                    </form>';

                   
                
            }
            else{
                
            echo '
            <form action="home.php" class="form-container" method="POST" id="form">
                <h1>Login</h1>
                
                <label for="email">
                    <b>Email</b>
                </label>
                <input type="text" name="email" placeholder="Enter Email" id="email" required>

                <label for="psw">
                    <b>Password</b>
                </label>
                <input type="password" name="psw" placeholder="Enter Password" id="password" required>


                <button type="submit" class="btnlogin login" name="login">Login</button>
                <button type="button" class="btnlogin cancel">Close</button>
                <p>Do Not Have an Account?   <b><a href="signup.php">Sign Up</a></b></p>
            </form>';}
           }
          
            ?>
          </div>
          
        </div>

          <div class="user-wrapper">
                <div class="search-icon">
                    
                    <button><span class="las la-search" ></span></button>
                </div>
              
              <div id="mybtn">
              <a href="cart.php" target="_self" class="notification" >
              <span class="las la-shopping-bag"></span>
                <span class="badge"><?php 

               
                   echo $nb_procuit;
                   
                ?></span>
              </a>
              </div>
              
             
              <h1 class="user"><span class="las la-user" ></span></h1>
          </div>
        </header>
        <main>
        <div id="mysearch" class="mysearch">
            <div class="search-box">
            <form  action="home.php">
            <input type="text" placeholder="Search.." name="search">
            <button type="submit"><span class="las la-search" ></span></button>
            </form>
            </div>
        </div>
       




        <div class='flex-containe'>
            
            <?php
                
                include '../conn.php';
                include 'search.php';
                if($_SESSION['existe']=='yes')
                {
                    $sql = "SELECT * FROM products WHERE Title LIKE '%".$_SESSION['search']."%' ";
                }
                else{
                    $sql = "SELECT * FROM products WHERE Type='clothing'";
                }
            
                
                $result = $conn->query($sql);
               
                if ($result->num_rows > 0) {
                    
                    
                    $temp=1;
                    while($row = $result->fetch_assoc()) {
                         
                        $desc=substr($row["Description"],0,20);
                        echo '<form method="POST" class="div" action="'.$_SERVER["PHP_SELF"].'">';
                        echo "<img src='../".$row["Image"]."' class='img".$temp."'/> " .  "<br><h2 class='title".$temp."'>" . $row["Title"]."</h2>".
                         "<br><p >".$desc ."... <button>more</button></p>"."<br><div class='buttons'>
                         <input type='button' class='btn-plus".$temp."' value='+'/>
                         <input type='text' id='quantite".$temp."' value='0' name='quantite".$temp."'/>
                         <input type='button' class='btn-minus".$temp."' value='-'/>
                       </div>"."<br><div class='add'><h3  class='price".$temp."'>"
                         .$row["Price"]."$<br></h3>"."<input type='submit' class='btn' id='addCart".$temp."' name='addcart' value='Add To Cart' /></div>";
                         echo"</form>";
                        
                         $temp++;

                    

                    }
                    
                } else {
                    echo "0 results";
                }
                
                $conn->close();
                
                echo '<script>';
                echo 'var name = '.json_encode($result->num_rows).';';
                echo '</script>';

                
                
            ?>
            </div>
        </main>
        <footer class="footer">
            <h4>Copyright © 2021 Abdelkarim Archiki.</h4>
           
            
        </footer>
    </div>

    
    <script src="script.js"></script>
    
</body>
</html>