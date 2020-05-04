<?php include('server.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
        <title>Register</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/sidebar.css">
        <link rel="stylesheet" href="css/login.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="js/bootstrap.min.js"></script>
        <script src="js/clock.js"> </script>
        <link href="https://fonts.googleapis.com/css?family=Roboto:100&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
    <div class="header">
    <!--Registration Form --->
    <form id="registerform" action="register.php" method ="post">
    <h2 style="text-align:center;color:grey;"> Register Here</h2>
    <br>
    <br>
    <?php include('errors.php'); ?>
    <div>
    <label for ="username" style="color:grey;" >Username: </label>
    <input type="text" name="username" value="<?php echo $username; ?>" required>
    </div>
    <br>
    <div>
    <label for="email" style="color:grey;" >Email: </label>
    <input type="email" name="email" value="<?php echo $email; ?>" required>
    </div>
    <br>
    <div>
    <label for="password" style="color:grey;" >Password: </label>
    <input type="new-password" name="password_1" required>
    </div>
    <br>
    <div>
    <label for="password" style="color:grey;" >Validate Password: </label>
    <input type="new-password" name="password_2" required>
    </div>
    <br>
    <div>
    <label for="usertype" style="color:grey;" >admin or employee: </label>
    <input type="text" name="usertype" >
    </div>
    <br>
    <br>
    <button class="btn btn-primary btn-lg" type="submit" name="user_login">Submit </button>
    <br>
    <br>
    <p>Already a user? <a href="login.php"> Log in</a></p>
    </form>
    </div>
    </div>
</body>
</html>
