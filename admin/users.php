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

   // Check the pressure on add user 
   if(isset($_POST['adduser']))
   {
       
        // Store input data in the variables 
        $first=$_POST['first'];
        $last=$_POST['last'];
        $email=$_POST['email'];
        $pass=$_POST['password'];
        $adresse=$_POST['adresse'];
        
        // Add data to database 
		$req="INSERT INTO users(Nom,Prenom,Email,Pass,Adresse) VALUES ('".$first."','".$last."','".$email."','".$pass."','".$adresse."')";
        $result = mysqli_query($conn,$req);
        
			
		
	
   }

    //check the click on button delete 
   if(isset($_POST['delete']))
   {
       //Get id from cookie 
       $idDelete=$_COOKIE['idDeleteU'];

      //Delete the user from database 
       $req="DELETE FROM users WHERE id_U=".$idDelete;
       $result = mysqli_query($conn,$req);

   }
   
    
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
    <title>Users</title>
    <link rel="stylesheet" href="css/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="css/styleproducts.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="icon/32441.png" type="image/icon type">
    <script src="jquery-3.3.1.min.js"></script>
    <script src="script.js"></script>
    <script src="js/script1.js"></script>

    <style>
        .addProducts .AddU{
            width:100%;
            height:100%;
            padding: 2rem;
            /* justify-content: center; */
        }
        .card-singleB{
            /* display: flex; */
            /* justify-content: space-between; */
            background: #fff;
            
        }
        .cards{
             justify-content: center;
        }
        .div{
            height:300px;
            line-height: 12px !important; 
            text-align: center;
            position: relative;
            /* background:#fff !important; */
            
           
        }
        
        .form-container img{
            display: block;
        width: 40%;
        height:100px;
        margin-left:auto;
        margin-right:auto;
        }
        .table{
            margin-left:auto;
            margin-right:auto;
            width:90% ;
            /* display: flex; */
            text-align: center;
            margin-bottom:15px;
            background:#fff;
            border:1px solid #002699;
            border-radius:10px;
            padding:6px;
        }
        .table:first-child{
            margin-top:10px;
        }
        .table h2,.table h4 {
            width: 100%;
            word-wrap:break-word;
            color:#000;
        }
        .table h5{
            width: 100%;
            word-wrap:break-word;
            margin-left:5px;
            color:#8390A2;
            /* margin-left:-15px; */
        }
        .crud{
            position: absolute;
            bottom:0;
            width:100%;
            
        }
        main{
            margin-top:75px;
            min-height: calc(100vh - 75px) ;

        }
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
                    
                    <a href="admin.php"><span class="las la-igloo"></span>
                    <span>Dashbord</span></a>
                </li>
                <li>
                    <a href="products.php" ><span class="las la-shopping-bag"></span>
                    <span>Products</span></a>
                </li>
                <li>
                    <a href="users.php" class="active" ><span class="las la-users"></span>
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
        


        
        <div class="cards">
            <!-- Create button add user  -->
                <div class="addProducts">
                        <button class="AddU">Add User</button>
                </div>
            <!-- Create card to display number of users  -->
            <div class="card-single">
                <div>
                    <h1>
                        <!-- Get number of users from database  -->
                        <?php 
                            $sql="SELECT * FROM users";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                echo mysqli_num_rows($result);
                            }
                            else
                            {
                                echo "0";
                            }
                        ?>
                    </h1>
                    <span>Users</span>
                </div>
                <div>
                    <span class="las la-users"></span>
                </div>
            </div>
            
           
           
        </div>
        <!-- Create Form to add user -->
        
        <div  class="modal-login" id="mymodal">
         <div class="form-popup" id="myForm"> 
            <form action="users.php" class="form-container" method="POST"  id="form" enctype="multipart/form-data">
                
                <label for="First Name">
                    <b>First Name</b>
                </label>
                <input type="text" name="first" placeholder="Enter First Name" id="first" required>

                <label for="Last Name">
                    <b>Last Name</b>
                </label>
                <input type="text" name="last" placeholder="Enter Last Name" id="last" required>
        

                <label for="Email">
                    <b>Email</b>
                </label>
                <input type="email" name="email" placeholder="Enter Email" id="email" required>

                <label for="Password">
                    <b>Password</b>
                </label>
                <input type="text" name="password" placeholder="Enter password" id="password" required>

                <label for="Adresse">
                    <b>Adresse</b>
                </label>
                <input type="text" name="adresse" placeholder="Enter Adresse" id="adresse" required>
                
    

                <button type="submit" class="btnadd adduser" name="adduser">ADD</button>
                <button type="button" class="btnadd cancel">Close</button>
            </form>
           </div>
        </div>
        



        
        <!--Create form to  update users -->

        <?php
            // check the click on update button 
            if(isset($_POST['updateform']))
            {
                // Get id from cookie 
                $idUpdate=$_COOKIE['idUpdate'];
                // Get data from database 
                $req="SELECT * FROM users WHERE id_U=".$idUpdate;
                
                $result =mysqli_query($conn,$req);
            
                if (mysqli_num_rows($result) > 0){
                    
                    $row = mysqli_fetch_assoc($result);
               
                // Set the data in the form 
                echo '<div  class="modal-update" id="mymodal">
                <div class="form-popup" id="myForm"> 
                   <form action="users.php" class="form-container" method="POST"  id="form" enctype="multipart/form-data">
                       
                       
                       
                       <label for="First Name">
                            <b>First Name</b>
                        </label>
                        <input type="text" name="first" placeholder="Enter First Name" id="first" value="'.$row["Nom"].'" required>
        
                        <label for="Last Name">
                            <b>Last Name</b>
                        </label>
                        <input type="text" name="last" placeholder="Enter Last Name" id="last" value="'.$row["Prenom"].'" required>
                
        
                        <label for="Email">
                            <b>Email</b>
                        </label>
                        <input type="email" name="email" placeholder="Enter Email" id="email" value="'.$row["Email"].'" required>

                        <label for="Password">
                            <b>Password</b>
                        </label>
                        <input type="text" name="password" placeholder="Enter password" id="password" value="'.$row["Pass"].'"  required>

                        <label for="Adresse">
                            <b>Adresse</b>
                        </label>
                        <input type="text" name="adresse" placeholder="Enter Adresse" id="adresse" value="'.$row["Adresse"].'" required>
        
                       <button type="submit" class="btnadd update" name="update">UPDATE</button>
                       <button type="button" class="btnadd cancel">Close</button>
                   </form>
                  </div>
               </div>';
            }


        
           
        }
        // Check the virefy click on update button 
        if(isset($_POST['update']))
        {
            // Get id from cookie 
            $idUpdate=$_COOKIE['idUpdate'];
           
            // Store input data to the variables 
            $first=$_POST['first'];
            $last=$_POST['last'];
            $email=$_POST['email'];
            $pass=$_POST['password'];
            $adresse=$_POST['adresse'];
            
            // Update data in database 
            $req="UPDATE  users SET Nom='".$first."',Prenom='".$last."',Email='".$email."',Pass='".$pass."',Adresse='".$adresse."' WHERE id_U=".$idUpdate;
            $result = mysqli_query($conn,$req);
                   
        }
        
        ?>
         
        
           


            <div class='flex-containe'>

            <?php
                $sql = "SELECT * FROM users";
                $result = $conn->query($sql);
                //echo $result->num_rows;
                if ($result->num_rows > 0) {
                    // output data of each row
                    
                    $temp=1;
                    while($row = $result->fetch_assoc()) {
                         
                       
                        echo '<form method="POST" class="div" action="'.$_SERVER["PHP_SELF"].'">';
                        // Create content to view data 
                         echo '
                        <div class="table"><h5>First Name: </h5><h2>'.strtoupper($row["Nom"]).'</h2></div>
                        <div class="table"><h5>Last Name: </h5><h2>'.strtoupper($row["Prenom"]).'</h2></div>
                        <div class="table"><h5 class="last">Email: </h5><h4>'.$row["Email"].'</h4></div>
                        <div class="table"><h5 class="last">Adresse: </h5><h4>'.$row["Adresse"].'</h4></div>

                        <div class="crud"><input type="submit" class="btn updateform" id="'.$row["id_U"].'" name="updateform" value="Update" />
                         <input type="submit" class="btn deleteU" id="'.$row["id_U"].'" name="delete" value="Delete" /></div>
                        
                        ';
            
                         
                         echo"</form>";
                     
                         $temp++;

                    

                    }
                    
                } else {
                    echo "
                        <h2 style='color:#e65c00'>There are no products</h2>
                    ";
                }
                
                $conn->close();
                // Send value of num_rows to javascript by json 
                echo '<script>';
                echo 'var name = '.json_encode($result->num_rows).';';
                echo '</script>';

                
                
            ?>
            </div>
            
        </main>
    </div>
    <script>
        $(".deleteU").click(function(){
        var idD=$(this).attr("id");
        // Send id user to php by cookie 
        createCookie("idDeleteU",idD,1);
    
    });
    </script>
</body>
</html>