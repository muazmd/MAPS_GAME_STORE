<?php
	session_start();
    $error=''; 
    if (isset($_POST['submit'])) {
        if (empty($_POST['username']) || empty($_POST['password'])) {
            $error = "Username or Password is invalid";
        }else{
            $username=$_POST['username'];
    
            $password=$_POST['password'];		
            $pass = md5($password);
            $user = md5($username);
            $con= mysqli_connect("den1.mysql6.gear.host", "mymapstore","Om78!Bi!M209", "mymapstore");
            $sql="select * from user where password='".$pass."' and username='".$user."'";
            $result=mysqli_query($con,$sql);
            $rows=mysqli_num_rows($result);//count the rows
            if ($rows == 1) { //username is matching with the password
                $_SESSION['login_user']=$username; 
                $res = mysqli_fetch_array($result);			
                if ($res['role'] ==1){		
                    $_SESSION['role']= "admin";
                    header("location: images.php"); 
                }else if ($res['role'] ==2){
                    $_SESSION['role']= "user";
                    header("location: Maps.php"); 
                }else
                    print_r($res);
                    //header("location: error.php");
            } else {
                $error = "Username or Password is invalid";
                echo $user, $pass, $username,$password;
            }
            mysqli_close($con); 
        }
    }
?>

<html>
	
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/f5f92436ce.js" crossorigin="anonymous"> </script>
<head>
<title>Login for Maps</title>
<style>
	.dev{
	border-radius: 5px;
	}
	#header{
     height: 85px;
     background-color:  #1c3969;
	 margin-bottom: 10px;
   }
  #header img{
    width: 150px;
    position: absolute;
    left: 14px;
    top: 10px;
  }
  body{
	  background: #171A21
  }
  label{
	  color:lightblue;
  }
</style>
</head>
<body>
<div id="main">
<div id="header">
        <img id="logo" src="maps.jpg" >
     </div>
<div id="login">
	<div class="container dev form-group">
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
<table class="table table-borderless">
	<tr>
<td> <label>UserName :<i class="fas fa-user-circle"></i> </label></td>
<td><input id="name" name="username" class="form-control" placeholder="username" type="text"> </td></tr>
<tr>
<td><label>Password : <i class="fas fa-lock"></i></label>
</td><td><input id="password" name="password" class="form-control" placeholder="**********" type="password"></td></tr>
<tr><td><input name="submit" type="submit" class="btn btn-outline-info" value="Login "></td>
<td><A Href="registerForm.php">don`t have an account?? Sign up </A></td>
</tr>
</table>
<span><?php echo $error; ?></span>
</form>
</div>
</div>
</div>

</body>
</html>