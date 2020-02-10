<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
        <title>Login</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet"  href="css/sidebar.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto:100&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="js/bootstrap.min.js"></script>
        <script src="js/clock.js"> </script>
</head>
<body>
    <div class="container">
      
    <div class="header">
      
      <h2> Log In Here </h2>
      
    </div>
    
    <!-- Log In form --->
    <form action="login.php" method ="POST">
      <div>
        
        <label for ="username">Username: </label>
        <input type="text" name="username" required>
        
      </div>
      
      <div>
        
        <label for="password">Password:</label>
        <input type="current-password" name="password_1" required>
        
      </div>
      
        <button type="submit">Submit</button>
        <p>Not a user? <a href="register.php"> Register Here</a></p>
        
      </form>
      </div>
      
</body>
</html>

