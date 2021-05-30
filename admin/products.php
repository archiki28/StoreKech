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

    // Check the pressure on add product 
   if(isset($_POST['addproduct']))
   {
    // Verify the file in not empty    
    if(!empty($_FILES))
	{
        $title=$_POST['title'];
        $desc=$_POST['description'];
        $price=$_POST['price'];
        $qt=$_POST['quantity'];
        $type=$_POST['type'];
		$file_name=$_FILES['image']['name'];
		$file_tmp_name=$_FILES['image']['tmp_name'];
		$file_dest='../img/'.$file_name;
        $file='img/'.$file_name;
		$file_extension=strrchr($file_name, ".");
		$extensions_autorisees=array('.png','.PNG','.jpg','.JPG');
        // Check the image formula 
		if (in_array($file_extension, $extensions_autorisees)) {
			if (move_uploaded_file($file_tmp_name,$file_dest)) {
                // Add image and other information to database 
				$req="INSERT INTO products(Title,Description,Image,Price,Qt,Type) VALUES ('".$title."','".$desc."','".$file."','".$price."','".$qt."','".$type."')";
                $result = mysqli_query($conn,$req);
			}
			else {
				echo "Un error";
			}
		}
		else{
			echo "Seuls les images est autoriser";
		}

	}
   }
   // Check the pressure on delete product 
   if(isset($_POST['delete']))
   {
       //Get id from cookie 
       $idDelete=$_COOKIE['idDelete'];
       //Delete product from database 
       $req="DELETE FROM products WHERE id=".$idDelete;
       $result = mysqli_query($conn,$req);

   }

   
  
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
    <link rel="icon" href="icon/linecon+products+round+icon-1320165923260225670.png" type="image/icon type">
    <title>Products</title>
    <link rel="stylesheet" href="css/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="css/styleproducts.css">
    
    <link rel="stylesheet" href="css/style.css">
    
    <style>
        .div{
            height:300px;
        }
        .form-container img{
            display: block;
        width: 40%;
        height:100px;
        margin-left:auto;
        margin-right:auto;
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
                    <a href="products.php" class="active" ><span class="las la-shopping-bag"></span>
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
        <div class="addProducts">
                <button class="AddB">Add Products</button>
        </div>

        <!-- Create Form to add products -->
        
        <div  class="modal-login" id="mymodal">
         <div class="form-popup" id="myForm"> 
            <form action="products.php" class="form-container" method="POST"  id="form" enctype="multipart/form-data">
                
                <label for="Title">
                    <b>Title</b>
                </label>
                <input type="text" name="title" placeholder="Enter Title" id="title" required>

                <label for="Description">
                    <b>Description</b>


                </label>
                <input type="text" name="description" placeholder="Enter Description" id="description" required>
        
                <label for="Image">
                    <b>Image</b>
                </label>
                <input type="file" name="image" placeholder="Upload Image" id="image" required>

                <label for="Price">
                    <b>Price</b>
                </label>
                <input type="text" name="price" placeholder="Enter Price" id="price" required>

                <label for="Quantity">
                    <b>Quantity</b>
                </label>
                <input type="text" name="quantity" placeholder="Enter Quantity" id="quantity" required>
                
                <label for="Type">
                    <b>Type</b>
                </label>
                <select name="type" class="select">
                    <option ></option>
                    <option value="electronic">Electronic</option>
                    <option value="clothing">Clothing</option>
                    <option value="sport">Sport</option>
                    <option value="house">House</option>
                </select>
                

                <button type="submit" class="btnadd addproduct" name="addproduct">ADD</button>
                <button type="button" class="btnadd cancel">Close</button>
            </form>
           </div>
        </div>
        



     
        <!--Create  Form to update  products -->

        <?php
            // check the click on update 
            if(isset($_POST['updateform']))
            {
                // Get id from cookie 
                $idUpdate=$_COOKIE['idUpdate'];
                // Get data from database  
                $req="SELECT * FROM products WHERE id=".$idUpdate;
                
                $result =mysqli_query($conn,$req);
            
                if (mysqli_num_rows($result) > 0){
                 
                    $row = mysqli_fetch_assoc($result);
               
                // Set the data in the  form update 
                echo '<div  class="modal-update" id="mymodal">
                <div class="form-popup" id="myForm"> 
                   <form action="products.php" class="form-container" method="POST"  id="form" enctype="multipart/form-data">
                       
                       <label for="Title">
                           <b>Title</b>
                       </label>
                       <input type="text" name="title" placeholder="Enter Title" id="title"  value="'.$row['Title'].'" required>
        
                       <label for="Description">
                           <b>Description</b>
        
        
                       </label>
                       <input type="text" name="description" placeholder="Enter Description" id="description" value="'.$row['Description'].'" required>
                        
                       
                       <label for="Image">
                           <b>Image</b>
                       </label>
                       <img src="../'.$row["Image"].'"/>
                       <input type="file" name="image" placeholder="Upload Image" id="image"  >
        
                       <label for="Price">
                           <b>Price</b>
                       </label>
                       <input type="text" name="price" placeholder="Enter Price" id="price" value="'.$row['Price'].'" required>
        
                       <label for="Quantity">
                           <b>Quantity</b>
                       </label>
                       <input type="text" name="quantity" placeholder="Enter Quantity" id="quantity" value="'.$row['Qt'].'" required>
                       
                       <label for="Type">
                            <b>Type</b>
                        </label>
                        
                       <select name="type" class="select" selected="'.$row["Type"].'">';
                        //   Fill the combobox 
                          if($row['Type']=="") {echo '<option selected></option>';}
                          else {echo '<option ></option>';}
                          if($row['Type']=="electronic") {echo '<option value="electronic" selected>Electronic</option>';}
                          else { echo '<option value="electronic" >Electronic</option>';}
                          if($row['Type']=="clothing") {echo '<option value="clothing" selected>Clothing</option>';}
                          else {echo '<option value="clothing" >Clothing</option>';}
                          if($row['Type']=="sport") {echo '<option value="sport" selected>Sport</option>';}
                          else {echo '<option value="sport" >Sport</option>';}
                          if($row['Type']=="house"){ echo '<option value="house" selected>House</option>';}
                          else {echo '<option value="house" >House</option>';}
                        echo '</select>
        
                       <button type="submit" class="btnadd update" name="update">UPDATE</button>
                       <button type="button" class="btnadd cancel">Close</button>
                   </form>
                  </div>
               </div>';
            }


        
           
        }
        // Check the click on update 
        if(isset($_POST['update']))
        {   
            // Get id from cookie 
            $idUpdate=$_COOKIE['idUpdate'];
            // Get data from database 
            $req="SELECT * FROM products WHERE id=".$idUpdate;
            $result =mysqli_query($conn,$req);
            $row = mysqli_fetch_assoc($result);
            $file=$row['Image'];
            // Chech the uploaded image 
            if(is_uploaded_file($_FILES['image']['tmp_name']))
            {
                // Strore input data in the variables 
                $title=$_POST['title'];
                $desc=$_POST['description'];
                $price=$_POST['price'];
                $qt=$_POST['quantity'];
                $type=$_POST['type'];
                $file_name=$_FILES['image']['name'];
                $file_tmp_name=$_FILES['image']['tmp_name'];
                $file_dest='../img/'.$file_name;
                $file='img/'.$file_name;
                $file_extension=strrchr($file_name, ".");
                $extensions_autorisees=array('.png','.PNG','.jpg','.JPG');
                if (in_array($file_extension, $extensions_autorisees)) {
                    if (move_uploaded_file($file_tmp_name,$file_dest)) {
                        // Update data in database 
                        $req="UPDATE  products SET Title='".$title."',Description='".$desc."',Image='".$file."',Price='".$price."',Qt='".$qt."',Type='".$type."' WHERE id=".$idUpdate;
                        $result = mysqli_query($conn,$req);
                    }
                    else {
                        echo "Un error";
                    }
                }
                else{
                    echo "Seuls les images est autoriser";
                }
            }
            // if not input a image 
            else
            {
                // Strore input data in the variables 
                $title=$_POST['title'];
                $desc=$_POST['description'];
                $price=$_POST['price'];
                $qt=$_POST['quantity'];
                $type=$_POST['type'];
                // Update data in database 
                $req="UPDATE  products SET Title='".$title."',Description='".$desc."',
                Image='".$file."',Price='".$price."',Qt='".$qt."',Type='".$type."'  WHERE id=".$idUpdate;
                $result = mysqli_query($conn,$req);
                    
            }
        }
        ?>
         
            <!-- Create cards to display types products  -->
            <div class="cards">
            
                <form action="" method="post">
                <button type="submit" name="electronic">
                <div class="card-single">
                    <div>
                        <h1>
                        <!-- Number of electronic device products  -->
                        <?php 
                                $sql="SELECT * FROM products WHERE Type='electronic'";
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
                        <span>Electronic</span>
                    </div>
                    <div>
                        <span class="las la-laptop-code"></span>
                    </div>
                </div>
                </button>
                </form>
                <form action="" method="post">
                <button type="submit" name="clothing">
                <div class="card-single">
                    <div>
                        <h1>
                        <!-- Number of clothing products  -->
                            <?php 
                                $sql="SELECT * FROM products WHERE Type='clothing'";
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
                        <span>Clothes</span>
                    </div>
                    <div>
                        <span class="las la-tshirt"></span>
                    </div>
                </div>
                </button>
                </form>
                <form action="" method="post">
                <button type="submit" name="sport">
                <div class="card-single">
                    <div>
                        <h1>
                        <!-- Number of sport products  -->
                        <?php 
                                $sql="SELECT * FROM products WHERE Type='sport'";
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
                        <span>Sport</span>
                    </div>
                    <div>
                        <span class="las la-dumbbell"></span>
                    </div>
                </div>
                </button>
                </form>
                <form action="" method="post">
                <button type="submit" name="house">
                <div class="card-single">
                    <div>
                        <h1>
                        <!-- Number of house products  -->
                            <?php 
                                $sql="SELECT * FROM products WHERE Type='house'";
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
                        <span>House</span>
                    </div>
                    <div>
                        <span class="las la-couch"></span>
                    </div>
                </div>
                </button>
                </form>
            </div>
           

            <div class='flex-containe'>
            
            <?php
                
                
                    // View products that have a type electronic 
                    if(isset($_POST['electronic']))
                    {
                        $sql = "SELECT * FROM products WHERE Type='electronic'";
                    }
                    // View products that have a type clothing 
                    elseif (isset($_POST['clothing'])) {
                        $sql = "SELECT * FROM products WHERE Type='clothing'";
                    }
                    // View products that have a type sport 
                    elseif (isset($_POST['sport'])) {
                        $sql = "SELECT * FROM products WHERE Type='sport'";
                    }
                    // View products that have a type house 
                    elseif (isset($_POST['house'])) {
                        $sql = "SELECT * FROM products WHERE Type='house'";
                    }
                    // View products that do not have a type  
                    else{
                        $sql = "SELECT * FROM products";
                    }
                    
               
                
                
                $result = $conn->query($sql);
               
                if ($result->num_rows > 0) {
                   
                    $temp=1;
                    while($row = $result->fetch_assoc()) {
                        //Short description 
                        $desc=substr($row["Description"],0,20);
                        // Create content to display products 
                        echo '<form method="POST" class="div" action="'.$_SERVER["PHP_SELF"].'">';
                        echo "<img src='../".$row["Image"]."' class='img".$temp."'/> " .  "<br><h2 class='title".$temp."'>" . $row["Title"]."</h2>".
                         "<br><p >".$desc ."... <button>more</button></p>"."<br><div class='add'><h3  class='price".$temp."'>"
                         .$row["Price"]."$<br></h3></div>"."<div class='crud'><input type='submit' class='btn updateform' id='".$row['id']."' name='updateform' value='Update' />
                         <input type='submit' class='btn delete' id='".$row['id']."' name='delete' value='Delete' /></div>";
                         echo"</form>";
                        
                         $temp++;
                    }
                    
                } else {
                    echo "
                        <h2 style='color:#e65c00'>There are no products</h2>
                    ";
                }
            
                $conn->close();
                
                // Send value of num_rows by json to javascript 
                echo '<script>';
                echo 'var name = '.json_encode($result->num_rows).';';
                echo '</script>';

                
                
            ?>
            </div>
            
        </main>
    </div>
    <script src="jquery-3.3.1.min.js"></script>
    <script src="script.js"></script>
    <script src="js/script1.js"></script>
</body>
</html>