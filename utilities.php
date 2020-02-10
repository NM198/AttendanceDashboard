<?php
require 'common.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Attendance System</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet"  href="css/sidebar.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="js/bootstrap.min.js"></script>
        
	<script src="js/clock.js"> </script>
        <link href="https://fonts.googleapis.com/css?family=Roboto:100&display=swap" rel="stylesheet">
    </head>
    <body>
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
   <div class="content_utilities">
    <h1> Utilities Page</h1>
    <br>
    <h6>Here you have access to external resources for your work </h6>
    
    <h6>1) Google Calendar api</h6>
    <br>
    <br>
    <h6>2) Google Docs api</h6>
    <br>
    <br>
    <h6>2) Google sheets api</h6>
   </div>
   
</body>
</html>
