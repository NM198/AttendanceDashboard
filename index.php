<?php include('server.php') ?>
<?php
    session_start();
    if(!empty($_SESSION['username'])){
        $_SESSION['msg'] = "You must login to view this page";
        header("Location: login.php");
        exit();
}
    if(!empty($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username']);
        header("Location: login.php");
        exit();
}
?>

<!DOCTYPE html>

<html lang="en">
    
    <head>
        <title>Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet"  href="css/sidebar.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="js/bootstrap.min.js"></script>
        <script src="js/clock.js"> </script>
        <script src="js/indexpiechart.js"> </script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        
        <link href="https://fonts.googleapis.com/css?family=Roboto:100&display=swap" rel="stylesheet">
    </head>
    
    <body onload="realtimeClock()">
        
        <div class="sidebar">
           
          <a href="index.php"><i class="fa fa-fw fa-home"></i> Dashboard</a>
          <a href="users.php"><i class="fa fa-fw fa-users"></i> Users</a>
          <a href="attendance.php"><i class="fa fa-fw fa-tasks"></i> Attendance</a>
          <a href="utilities.php"><i class = " fa fa-fw fa-calendar-plus-o"></i>Utilities </a>
          <a href="#signout"><i class=" fa fa-fw fa-window-close-o"></i> Log Out</a>
          <div class="row mx-n2">
            
          <div class="col-md px-2">
            
            <a href="https://www.facebook.com/illogistics/" class="fa fa-facebook"></a>
            <a href="https://interfreightlogistics.com/" class="fa fa-globe"></a>
            
        </div>
        
        <div class="col-md px-2">
            
           <a href="https://www.linkedin.com/company/interfreight-logistics-ltd" class="fa fa-linkedin"></a>
           <a href="https://www.youtube.com/channel/UCo4e3BdPieVNs8jJjSxXilA" class="fa fa-youtube"></a>
        </div>
        
        </div>
          
          
          
        </div>
 
        <div class="content">
            
            <p> Dashboard</p>
              
        <div class="row mx-n2">
            
        <div class="col-md px-2">
            
            <a href="users.php" class="btn btn-lg btn-info w-100 mb-3">Users</a>
            
        </div>
        
        <div class="col-md px-2">
            
            <a href="attendance.php" class="btn btn-lg btn-info w-100 mb-3">Attendance</a>
            
        </div>
        
        </div>
    
        <div class ="row mx-n2">
            
        <div class="col-md px-2">
            
        <div id="piechart"></div>
        
        <script type="text/javascript">
        // Load google chart
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        </script>
        
        </div>
        <!--CLOCK--->
        <div class="col-md px-2">
            
        <div class="clock-main-container" >
            
        <div id="clock" style ="position:absolute;font-size:62px;color:#5b5d72;font-family:'Roboto';left:10%;"> </div>
	     
        </div>
        
        </div>
    
        </div>
       
        <?php
        // Welcome, logout user
            if(!empty($_SESSION['success'])) : ?>
                <div>
                    <h3>
                        <?php
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                        ?>
                    </h3>
                </div>
        <?php endif ?>
        <?php if(!empty($_SESSION['username'])) : ?> 
                <h3>Welcome <?php echo $_SESSION['username']; ?></h3> 
                <button><a href="index.php?logout='1'"></a></button>
        <?php endif?>
        
        </div>
</body>
</html>
