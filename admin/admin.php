<?php
    // Inialize session 
    session_start(); 

    //call the file the connection
    include '../conn.php';
    
    //Check your login
    if(empty($_SESSION["admin_id"]))
    {
        //Jump to login page 
        header('Location: login.php'); 
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
    <link rel="stylesheet" href="css/1.3.0/css/line-awesome.min.css">
    <link rel="icon" href="icon/download.png" type="image/icon type">
    <title>Dashbord</title>
   
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="jquery-3.3.1.min.js"></script>
    <script src="js/script1.js"></script>
        
        
    
    <style>
        main{
            margin-top:75px;
            min-height: calc(100vh - 75px) ;
            background:#b3b8bd;
        }
     
        .left{
            font-size:20px;
            text-align:center;
            background: blue;
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            padding-top:5px;
            margin-right: 1rem;
            cursor: pointer;
            /* float: left; */
        }
        .user-wrapper{
            display: flex;
            align-items: center;
        }
        .user-wrapper span{
            border-radius: 50%;
            margin-right: 1rem;
            width:40px;
            height:40px;
            background:blue;
            color:#fff;
            font-size:25px;
            text-align:center;
            cursor: pointer;
        }

        .user-wrapper small{
            display: inline-block;
            color: var(--text-grey);
            margin-top: -10px !important;
        }
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
            /* display: none;
            position: fixed; */
            margin-top: 65px;
            margin-right: 15px;
            /* margin: 15% auto; */
            /* border: 3px solid #f1f1f1; */
            /* z-index: 9; */
            /* background-color: red; */
            /* background-color:red !important; */
            /* margin: 15% auto; */
            padding: 20px 0 20px;
            /* border: 1px solid #888; */
            float: right;
        }
        .form-container{
            max-width: 300px;
            padding: 10px;
            background-color: white;
        }
        .modal-logout .form-container{height:200px;}
        
    </style>
</head>
<body>
    <!-- Create sidebar -->
    <input type="checkbox" name="" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
        <h2><span class="lab la-envira"></span><span>StoreKech</span></h2>

        </div>
        <div class="sidebar-menu">
            <form action="" method="POST">
            <ul>
                <li>
                    
                    <a href="admin.php" class="active" name="click"><span class="las la-igloo"></span>
                    <span>Dashbord</span></a>
                </li>
                <li>
                    <a href="products.php"><span class="las la-shopping-bag"></span>
                    <span>Products</span></a>
                </li>
                <li>
                    <a href="users.php"><span class="las la-users"></span>
                    <span>Users</span></a>
                </li>
            
                <li>
                    <a href="account.php"><span class="las la-user-circle"></span>
                    <span>Accounts</span></a>
                </li>
                
            </ul>
            </form>
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
          
          
            
              <?php 
                
                if(isset($_SESSION["admin_id"]))
                {
                    $name=$_SESSION["admin_name"];
                    $email=$_SESSION["admin_email"];
                    $username=substr($_SESSION["admin_name"],0,1);
                    $username=strtoupper($username);

                    // Create a icon and information admin 
                    echo '
                    <div class="user-wrapper">
                    <span class="icon">'.$username.'</span>
                    <div>
                        <h4>'.strtoupper($name).'</h4>
                        <small>'.$email.'</small>
                    </div>
                    </div>
                    ';
                    // Create a interface confirm login
                    echo '
                            <div class="mod" id="myMod">
                                <div class="mod-content">
                                    <span class="close las la-times"></span>
                                    <div class="admin-info">
                                        <span class="icon">'.$username.'</span>
                                        
                                        <h4>'.strtoupper($name).'</h4>
                                        <small>'.$email.'</small>
                                    </div>
                                    <p class="log"><a href="logout.php">Logout</a><p>
                                </div>
                            </div>
                    ';
           
                }
            ?>
           
          
        </header>
        <!-- Design of the main interface  -->
        <main>
            
            <!-- create cards to display information  -->
            <div class="cards">
                <div class="card-single">
                    <div>
                        <h1>
                            <!-- Get the number of products  -->
                            <?php 
                                $sql="SELECT * FROM products";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    echo mysqli_num_rows($result);
                                }
                            ?>
                        </h1>
                        <span>Products</span>
                    </div>
                    <div>
                        <span class="las la-shopping-bag"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1>
                            <!-- Get the number of users  -->
                            <?php 
                                $sql="SELECT * FROM users";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    echo mysqli_num_rows($result);
                                }
                            ?>
                        </h1>
                        <span>Users</span>
                    </div>
                    <div>
                        <span class="las la-users"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1>
                        <!-- Get the number of admins  -->
                        <?php 
                                $sql="SELECT * FROM admin";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    echo mysqli_num_rows($result);
                                }
                            ?>
                        </h1>
                        <span>Admins</span>
                    </div>
                    <div>
                        <span class="las la-user-circle"></span>
                    </div>
                </div>
            
            </div>
            
            <!-- Create an interface to view the last add products  -->
            <div class="recent-grid">
                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h3>New Products</h3>

                            <a href="products.php"><button>See all <span class="las la-arrow-right">

                            </span></button></a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                            <table width="100%">
                                <thead>
                                    <tr>
                                        <td>Products Title</td>
                                        <td>Price</td>
                                        <td>Type</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        // Get data from database 
                                        $sql = "SELECT * FROM products ORDER BY id DESC";
                                        $result = $conn->query($sql);
                                       
                                        if ($result->num_rows > 0) {
                                            
                                            
                                            $temp=1;
                                            while($row = $result->fetch_assoc()) {
                                                // Verify the product is classified 
                                                if($row["Type"]=="")
                                                {
                                                    $type="Unclassified";
                                                    $color="red";
                                                }
                                                else{
                                                    $type=$row["Type"];
                                                    $color="#000";
                                                }
                                                echo '
                                                    <tr>
                                                        <td><h5>'.ucfirst($row["Title"]).'</h5></td>
                                                        <td>'.$row["Price"].'$</td>
                                                        <td style="color:'.$color.';">'.ucfirst($type).'</td>
                                                    </tr>
                                                ';

                                                // Get the last 10 products 
                                                if($temp==10)
                                                {
                                                    break;
                                                }
                                                $temp++;
                                                
                
                                            }
                                        }

                                    ?>  
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Create an interface to view the last add users  -->
                <div class="customers">
                    <div class="card">
                            <div class="card-header">
                                <h3>New Users</h3>

                                <a href="users.php"><button>See all <span class="las la-arrow-right">

                                </span></button></a>
                            </div>
                            <div class="card-body">
                                <?php
                                // Get data from database 
                                $sql = "SELECT * FROM users ORDER BY id_U DESC";
                                $result = $conn->query($sql);
                               
                                if ($result->num_rows > 0) {
                                    
                                    
                                    $temp=1;
                                    while($row = $result->fetch_assoc()) {
                                         
                                        // Create icon and information users 
                                        $username=substr($row["Prenom"],0,1);
                                        $username=strtoupper($username);
                                    
                                        echo '<div class="customer">
                                                <div class="info">
                                                    <span class="left">'.$username.'</span>
                                                    <div>
                                                        <h4>'.strtoupper($row["Prenom"]).' '.strtoupper($row["Nom"]).'</h4>
                                                        <small>'.$row["Email"].'</small>
                                                    </div>
                                                </div>
                                                
                                            </div>';
                                         $temp++;
                                    }
                                    
                                } else {
                                    echo "
                                        <h2 style='color:#e65c00'>There are no products</h2>
                                    ";
                                }
                            //    Close the connection 
                                $conn->close();
                                ?>
                    </div>

                </div>
            </div>
        </main>
    </div>
</body>
</html>