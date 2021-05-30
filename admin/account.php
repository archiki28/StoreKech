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
//   Check the click on addadmin 
   if(isset($_POST['addadmin']))
   {
       
        // Store data 
        $name=$_POST['name'];
        $email=$_POST['email'];
        $pass=$_POST['password'];
        $phone=$_POST['phone'];
        $friend=$_POST['friend'];
   
        // Add data to database 
		$req="INSERT INTO admin(Name,Email,Pass,Phone,friend) VALUES ('".$name."','".$email."','".$pass."','".$phone."','".$friend."')";
        $result = mysqli_query($conn,$req);
        
			
		
	
   }

    // Check the click on delete 
   if(isset($_POST['delete']))
   {
    //Get data from table admin 
       $req="SELECT * FROM admin";
       $result =mysqli_query($conn,$req);
            
       if (mysqli_num_rows($result) > 1){
        // Get id from cookie 
       $idDelete=$_COOKIE['idDeleteA'];
        //Delete admin from database 
       $req2="DELETE FROM admin WHERE id=".$idDelete;
       $result2 = mysqli_query($conn,$req2);
       }

   }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
    <title>Account</title>
    <link rel="stylesheet" href="css/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="css/styleproducts.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="icon/admin.png" type="image/icon type">
    <script src="jquery-3.3.1.min.js"></script>
    <script src="script.js"></script>
    <script src="js/script1.js"></script>
    <style>
     main{
            margin-top:75px;
            min-height: calc(100vh - 75px) ;

        }
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
            /* background:#002699; */
            border:1px solid #002699;
            border-radius:20px;
            padding:5px;
        }
        .table:first-child{
            margin-top:10px;
        }
        .table h2,.table h4 {
            width: 100%;
            word-wrap:break-word;
            color:#5c5c3d;
        }
        .table h5{
            width: 100%;
            word-wrap:break-word;
            margin-left:5px;
            color:#60508d;
            /* margin-left:-15px; */
        }
        .crud{
            position: absolute;
            bottom:0;
            width:100%;
            
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
                    <a href="users.php" ><span class="las la-users"></span>
                    <span>Users</span></a>
                </li>
            
                <li>
                    <a href="account.php" class="active"><span class="las la-user-circle"></span>
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
            <!-- Create button add admin  -->
            <div class="addProducts">
                    <button class="AddU">Add Admin</button>
            </div>
            <!-- Create card to display number of admin  -->
            <div class="card-single">
                <div>
                    <h1>
                    <!-- Get number of admin from database  -->
                        <?php 
                            $sql="SELECT * FROM admin";
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
        <!--Create Form to add admin -->
        
        <div  class="modal-login" id="mymodal">
         <div class="form-popup" id="myForm"> 
            <form action="account.php" class="form-container" method="POST"  id="form" enctype="multipart/form-data">
                
                <label for="Name">
                    <b>Name</b>
                </label>
                <input type="text" name="name" placeholder="Enter  Name" id="name" required>

              
        

                <label for="Email">
                    <b>Email</b>
                </label>
                <input type="email" name="email" placeholder="Enter Email" id="email" required>

                <label for="Password">
                    <b>Password</b>
                </label>
                <input type="text" name="password" placeholder="Enter password" id="password" required>

                <label for="Phone">
                    <b>Phone</b>
                </label>
                <input type="text" name="phone" placeholder="Enter Phone" id="phone" required>
                
                <label for="Friend">
                    <b>Friend</b>
                </label>
                <input type="text" name="friend" placeholder="Enter Friend" id="friend" required>
    

                <button type="submit" class="btnadd addadmin" name="addadmin">ADD</button>
                <button type="button" class="btnadd cancel">Close</button>
            </form>
           </div>
        </div>
        



        
            <!-- Creat Form to update  admin -->

        <?php
            // Check the click on update button 
            if(isset($_POST['updateform']))
            {
                // Get id from cookie 
                $idUpdate=$_COOKIE['idUpdate'];
                // Get data from database 
                $req="SELECT * FROM admin WHERE id=".$idUpdate;
                
                $result =mysqli_query($conn,$req);
            
                if (mysqli_num_rows($result) > 0){
                    
                    $row = mysqli_fetch_assoc($result);
               
                // Set data in the form 
                echo '<div  class="modal-update" id="mymodal">
                <div class="form-popup" id="myForm"> 
                   <form action="account.php" class="form-container" method="POST"  id="form" enctype="multipart/form-data">
                       
                       
                        <label for="Name">
                            <b>Name</b>
                        </label>
                        <input type="text" name="name" placeholder="Enter  Name" id="name" value="'.$row["Name"].'" required>

                        
                

                        <label for="Email">
                            <b>Email</b>
                        </label>
                        <input type="email" name="email" placeholder="Enter Email" id="email" value="'.$row["Email"].'" required>

                        <label for="Password">
                            <b>Password</b>
                        </label>
                        <input type="text" name="password" placeholder="Enter password" id="password" value="'.$row["Pass"].'" required>

                        <label for="Phone">
                            <b>Phone</b>
                        </label>
                        <input type="text" name="phone" placeholder="Enter Phone" id="phone" value="'.$row["Phone"].'" required>
                        
                        <label for="Friend">
                            <b>Friend</b>
                        </label>
                        <input type="text" name="friend" placeholder="Enter Friend" id="friend" value="'.$row["friend"].'" required>
        
                       <button type="submit" class="btnadd update" name="update">UPDATE</button>
                       <button type="button" class="btnadd cancel">Close</button>
                   </form>
                  </div>
               </div>';
            }


        
           
        }
        // Check virefy click on update 
        if(isset($_POST['update']))
        {
            // Get data from cookie
            $idUpdate=$_COOKIE['idUpdate'];
           
            // Store data to variables 
            $name=$_POST['name'];
            $email=$_POST['email'];
            $pass=$_POST['password'];
            $phone=$_POST['phone'];
            $friend=$_POST['friend'];
            
            // Update data in database
            $req="UPDATE  admin SET Name='".$name."',Email='".$email."',Pass='".$pass."',Phone='".$phone."',friend='".$friend."' WHERE id=".$idUpdate;
            $result = mysqli_query($conn,$req);
                   
        }
        
        ?>
            <div class='flex-containe'>
            
            <?php
                // Get data from table admin 
                $sql = "SELECT * FROM admin";
                 
                
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    
                    
                    $temp=1;
                    while($row = $result->fetch_assoc()) {
                         
                        // Create content to view admins 
                        echo '<form method="POST" class="div" action="'.$_SERVER["PHP_SELF"].'">';
                        echo '
                        <div class="table"><h5>Name: </h5><h2>'.strtoupper($row["Name"]).'</h2></div>
                        <div class="table"><h5 class="last">Email: </h5><h4>'.$row["Email"].'</h4></div>
                        <div class="table"><h5 class="last">Phone: </h5><h4>'.$row["Phone"].'</h4></div>
                        <div class="table"><h5 class="last">Friend: </h5><h4>'.$row["friend"].'</h4></div>
                        <div class="crud"><input type="submit" class="btn updateform" id="'.$row["id"].'" name="updateform" value="Update" />
                         <input type="submit" class="btn deleteA" id="'.$row["id"].'" name="delete" value="Delete" /></div>
                        
                        '; 
                         echo"</form>";
                     
                         $temp++;

                    

                    }
                    
                } else {
                    echo "
                        <h2 style='color:#e65c00'>There are no products</h2>
                    ";
                }
                // Close connection 
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
        $(".deleteA").click(function(){
        var idD=$(this).attr("id");
        // Send value of id to php by cookie 
        createCookie("idDeleteA",idD,1);
    
    });
    </script>
</body>
</html>