<?php
require 'common.php';

//Grab all the users from our database:
$users = $database->select("users", [
    'id',
    'name',
    'rfid_uid',
    'department'
]);
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> 
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
    
    <div class="content_users">
        
       <h1 style ="text-align:center;">Welcome to the users page: </h1>
       
       <br>
       
        <div class="row">
            
            <h4>1)  Table below shows all employees registered in the system at the moment</h4>
            
        </div>
        
        <!--Employee Registered table --->
        
        <table id="employeeslist" class="table table-responsive table-striped table-sm" cellspacing="0" width="100%">
            
            <thead class="thead-dark">
                
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Department</th>
                    <th scope="col">RFID UID</th>
                </tr>
                
            </thead>
            
            <tbody>
                
                <?php
                //Loop through and list all the information of each user including their RFID UID and their department:
                foreach($users as $user) {
                    echo '<tr>';
                    echo ' <td  scope="row">' . $user['id'] .' </td>';
                    echo ' <td  scope="row">' . $user['name'] .' </td>';
                    echo ' <td>'  . $user['department'] .' </td>';
                    echo ' <td>'  . $user['rfid_uid'].' </td>'; 
                    echo ' </tr>';
                }
               ?> 
               
            </tbody>
            
        </table>
        
    </div>
    
     <!--Table paginaton script --->
        <script>
            $(document).ready(function(){
               $('#employeeslist').DataTable({
                "pagingType":"simple"
            });
               $('.dataTables_length').addClass('bs-select'); 
                
            });
        </script>
    
    </body>
    
</html>
