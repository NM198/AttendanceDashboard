<?php include('server.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
        <title>Login</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet"  href="css/sidebar.css">
        <link rel="stylesheet"  href="css/login.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto:100&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="js/bootstrap.min.js"></script>
        <script src="js/clock.js"> </script>
</head>
<body>
    <div class="container">
      
    <div class="header">
  
    </div>
    
    <!-- Log In form --->
    <form id ="loginform" autocomplete="off" action="login.php" method ="POST">
       <?php include('errorslogin.php'); ?>
      <h2 style="text-align:center;color:grey;"> Log In Here </h2>
      <br>
      <br>
      <div>
        
        <label for ="username" style="text-align:center;color:grey;">Username: </label>
        <input type="text" name="username" required>
        
      </div>
      
      <div>
        
        <label for="password"style="color:grey;">Password:</label>
        <input type="current-password" name="password" required>
        
      </div>
        <br>
        <br>
        <button class="btn btn-primary btn-lg "type="submit" name="user_login">Sign In</button>
        <br>
        <br>
        <p>Not a user? <a href="register.php"> Register Here </a></p>
        <br>
      </form>
      </div>
      
</body>
</html>

