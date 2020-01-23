
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="js/bootstrap.min.js"></script>
	<script src="js/clock.js"> </script>
        <link href="https://fonts.googleapis.com/css?family=Roboto:100&display=swap" rel="stylesheet">
    </head>
    <body onload="realtimeClock()">

    <nav class="navbar navbar-dark bg-dark">
        <a href="index.php"  class="fa fa-home" style="font-size:50px;color:white;"> </a>
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a href="attendance.php" class="nav-link">View Attendance</a>
            </li>
            <li class="nav-item">
                <a href="users.php" class="nav-link active">View Users</a>
            </li>
        </ul>
    </nav>
           
    <div class="container-fluid" style="display:inline;">
        <div class="col-md-auto order-md-1 text-center text-sm-left pr-md-5">
            <h1 class="mb-3">Welcome To Your Dashboard</h1>
            <div class="row mx-n2">
                <div class="col-md px-2">
                    <a href="users.php" class="btn btn-lg btn-outline-secondary w-100 mb-3">Users</a>
                </div>
                <div class="col-md px-2">
                    <a href="attendance.php" class="btn btn-lg btn-outline-secondary w-100 mb-3" >Attendance</a>
                </div>
            </div>
        </div> 
    </div>
   <div class="clock-main-container" style =" width:100%; height:1080px;position:relative;">
	     <div id="clock" style ="width:100%;position:absolute;font-size:9vw;color:white;text-align:center;font-family: 'Roboto';margin-top:15%;"> </div>
	     <img src="https://img.techpowerup.org/200123/adventure-alps-amazing-beautiful-552785.jpg" alt ".." class="img-fluid"style="margin-left:10%;width:80%;;bottom:0px;" >
   </div>
</body>
</html>
