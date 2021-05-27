<?php 
//require_once 'db.php'; 
$dbHost     = "den1.mysql6.gear.host";  
 $dbUsername = "mymapstore";  
 $dbPassword = "Om78!Bi!M209";  
 $dbName     = "mymapstore";  
   
 // Create database connection  
 $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

 if(!$db){
     echo "error connection to db";
 }
 
if (isset($_POST["upload"])){
    
    if(!empty($_FILES["image"]["name"])) { 
        // Get file info 
        $fileName = basename($_FILES["image"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
          
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['image']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image)); 
            $name = $_POST['name'];
            $price = $_POST['price'];
            $genre =$_POST['genre'];
            
            echo $name, $price, $genre, $imgContent;
            // Insert image content into database 
            $insert = $db->query("INSERT into mymapstore.games (name,image,price,genre) VALUES ('$name','$imgContent','$price','$genre')"); 
             
            if($insert){ 
                $status = 'success'; 
                $statusMsg = "File uploaded successfully."; 
            }else{ 
                $statusMsg = "File upload failed, please try again."; 
            }  
        }else{ 
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
        } 
    }else{ 
        $statusMsg = 'Please select an image file to upload.'; 
    } 
} 
echo $name, $price, $genre, $imgContent;


if (isset($_POST['browse'])) {
    header("location: Maps.php");}
    echo $name, $price, $genre, $imgContent;


?>




<!DOCTYPE html>
<html>

<head>
<title>Image Upload</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/f5f92436ce.js" crossorigin="anonymous"> </script>
  <style>
  
  body{
      background-color:#171a21;;
  }
  #header{
     height: 85px;
     background-color:  #1c3969;
   }
  #header img{
    width: 150px;
    position: absolute;
    left: 14px;
    top: 10px;
  }
  label{
      color:white;  
  }
   </style>
</head>
<body>
<div id="header">
        <img id="logo" src="maps.jpg" >
  
     </div>
    <div class="container">
    <table class="table tble-borderless">
    <form method="POST" action="images.php" enctype="multipart/form-data">
   <tr><td><label for=""> Upload image here </label></td>
   <td>
   <div>
   <input type="hidden" name="size" value="1000000">
    <input type="file"  name="image">
    </div>
   </td>
   </tr>
   <tr>
   <td><label for="">Enter the name of the game here</label></td>
    <td><textarea name="name" cols="40" rows="4" placeholder="Enter a name for this game"></textarea></td>

   </tr>
    
    <tr>
    <td><label for="">Enter the Price here</label></td>
    <td> <textarea name="price" cols="40" rows="4" placeholder="Enter a Price for this game"></textarea></td>
    </tr>
    <tr>
    <td><label for="">Choose the genere </label></td>
    <td>
    
 <input type="text" name="genre" placeholder="enter genre from 1 to 5"/>
 
    
    </tr>
     <tr>
     <td><input type="submit" class="btn btn-outline-info" name="upload" value="upload"></td>
     <td><input type="submit" class="btn btn-outline-info" name="browse" value="continue browsing " id=""></td>
     </tr>
    
    </div>
        </table>

    </div>
    </form>
    
    
  
  

</td>
    
    </div>
</body>



</html>