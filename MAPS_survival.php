<?php   
 session_start();  
 $dbHost     = "den1.mysql6.gear.host";  
 $dbUsername = "mymapstore";  
 $dbPassword = "Om78!Bi!M209";  
 $dbName     = "mymapstore";  
   
 // Create database connection  
 $connect = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);   
 if(isset($_POST["add_to_cart"]))  
 {  
      if(isset($_SESSION["shopping_cart"]))  
      {  
           $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");  
           if(!in_array($_GET["id"], $item_array_id))  
           {  
                $count = count($_SESSION["shopping_cart"]);  
                $item_array = array(  
                     'item_id'               =>     $_GET["id"],  
                     'item_name'               =>     $_POST["hidden_name"],  
                     'item_price'          =>     $_POST["hidden_price"],  
                      
                );  
                echo '<script>alert("Item added successfully")</script>';  
                echo '<script>window.location="MAPS_survival.php"</script>'; 
                $_SESSION["shopping_cart"][$count] = $item_array;  
           }  
           else  
           {  
                echo '<script>alert("Item Already Added")</script>';  
                echo '<script>window.location="MAPS_survival.php"</script>';  
           }  
      }  
      else  
      {  
           $item_array = array(  
                'item_id'               =>     $_GET["id"],  
                'item_name'               =>     $_POST["hidden_name"],  
                'item_price'          =>     $_POST["hidden_price"],  
                 
           );  
           $_SESSION["shopping_cart"][0] = $item_array;  
      }  
 }  
 if(isset($_GET["action"]))  
 {  
      if($_GET["action"] == "delete")  
      {  
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {  
                if($values["item_id"] == $_GET["id"])  
                {  
                     unset($_SESSION["shopping_cart"][$keys]);  
                     echo '<script>alert("Item Removed")</script>';  
                     echo '<script>window.location="MAPS_survival.php"</script>';  
                }  
           }  
      } 

 } 
 if(isset($_POST['checkout'])){
      header("location:checkout.php");
 } 
 ?>  
<!DOCTYPE html>
<html>
<head>

    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" class="btn btn-outline-info" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 
 <style>  
    
        body{
            background: #171a21;;
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
  #header a{
    position: absolute;
    right: 15px;
    top: 35px;
    color: lightgrey;
    text-decoration: none;
    font-size: 25px;}
  

    
       h5{
          color: lightgray;
          size: 15px !important;
      }
    

      
      .categories{
    display: inline;
    
  }
  #menu{
   width: 800px;
   margin: auto;
   font:16pt  Arial, sans-serif;
   left: 25px;
   margin-top: 50px;
  }
  .categories a{
    text-decoration: none;
    color: lightgray;
  
  }
  #menu a:hover {
  color: #b05f02;
}
footer{
  text-align: center;
  background-color: #171A21;
  font-size: 12pt;
  color: lightgray;

  border-top: 5px solid #0977aa;
}
footer a{
  text-decoration: none;
  color: lightgray;
}
footer a:hover {
  color: #b05f02;}
  #img1{
    width: 300px;
    height: 250px;
  }
ul li{
     list-style-type: none;
}

       

 #price{
     color: lightgrey;
 }
 .chbtn{
      padding: 15px;
      /* align: center; */
      /* margin-left: 550px */
 }
       </style>
    
</head>
<body>
    <div id="header">
        <img id="logo" src="maps.jpg" >
   
     </div>
     <div id="menu">
        <ul>
            <li class="categories"><a href="MAPS.php">Home</a></li> &nbsp; &nbsp; &nbsp; &nbsp;
            <li class="categories"><a href="MAPS_fps.php">Fps</a></li> &nbsp; &nbsp; &nbsp; &nbsp;
            <li class="categories"><a href="MAPS_survival.php">Survival</a></li> &nbsp; &nbsp; &nbsp; &nbsp;
            <li class="categories"><a href="MAPS_Strategy.php">Strategy</a></li>&nbsp; &nbsp; &nbsp; &nbsp;
            <li class="categories"><a href="Maps_openworld.php">Open World</a></li> &nbsp; &nbsp; &nbsp; &nbsp;
            <li class="categories"><a href="Special Deals.php">Special Deals</a></li>
      
        </ul>
      </div>
      <br />  
           <div class="container-fluid " >  
           
                <?php  
                $query = "SELECT * FROM games WHERE genre=1 ORDER BY id ASC ";  
                $result = mysqli_query($connect, $query);  
                if(mysqli_num_rows($result) > 0)  
                {  
                     while($row = mysqli_fetch_array($result))  
                     {  
                ?>  
                
           
                <div class="col-sm-4">  
                     <form method="post" action="MAPS_survival.php?action=add&id=<?php echo $row["id"]; ?>" >  
                          <div style=" background-color:#171A21;  ; padding:16px;" align="center ">  
                               <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" />   
                               <h4 class="text-info"><?php echo $row["name"]; ?></h4>  
                               <h4 class="text-danger">$ <?php echo $row["price"]; ?></h4>  
                               <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />  
                               <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />  
                               <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />  
                          </div>  
                     </form>  
                </div>
               
                
                      
                <?php  
                     }  
                }  
                ?>  
                <div style="clear:both"></div>  
                <br />  
               
                       
           <br />  
 <center>
 <form method="post">
         <div class="chbtn"><button name="checkout" class="btn btn-outline-success" >Proceed to Checkout 
         <i class="fas fa-shopping-cart"></i> <?php echo $_SESSION['counter'];  ?></button></div>   
         </form> </center> 

     



        
    <footer>
        <div>
        
        <ul>
          <li><a href="Maps.php">Maps.com</a></li>
          <li>Lebanon</li>
          <li>78/821499</li>
          <li>Contact Us At:  MAPS@gmail.com
          </li></ul>
          </div>
      
      </footer> 

    
</body>

</html>