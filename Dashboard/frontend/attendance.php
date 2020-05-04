<?php
require 'common.php';

//Grab all users from our database
$users = $database->select("users", [
    'id',
    'rfid_uid',
    'name',
    'department',
    'username'
]);

//Check if we have a year passed in through a get variable, otherwise use the current year
if (isset($_GET['year'])) {
    $current_year = int($_GET['year']);
} else {
    $current_year = date('Y');
}

//Check if we have a month passed in through a get variable, otherwise use the current year
if (isset($_GET['month'])) {
    $current_month = $_GET['month'];
} else {
    $current_month = date('n');
}
//Calculate the amount of days in the selected month
$num_days = cal_days_in_month(CAL_GREGORIAN, $current_month, $current_year);
?>

<!DOCTYPE html>

<html lang="en">
    
    <head>
        <title>Attendance</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet"  href="css/sidebar.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>    
    </head>
    
    <body style="background-color:#F5F5F5;color:#606060;">
        
    <div class="sidebar">
     <a href="index.php"><i class="fa fa-fw fa-home"></i> <b>Home</b></a>
      <a href="attendance.php"><i class="fa fa-fw fa-tasks"></i> <b>Attendance </b></a>
      <a href="users.php"><i class="fa fa-fw fa-users"></i> <b>Users(Admin)</b></a>
      <a href="attendanceAdmin.php"><i class="fa fa-fw fa-tasks"></i> <b>Attendance (Admin)</b></a>
      <a href="utilities.php"><i class = " fa fa-fw fa-calendar-plus-o"></i> <b>Utilities </b></a>
      <a href="login.php"><i class = " fa fa-sign-out"></i> <b>Log out</b></a>
      
      
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
    
    <div class="content_attendance">
        
        <p style="text-align:center;font-size:5vh;">Welcome to your Attendance page: </p>
        
        <div class="row" style ="margin-top:50px;">
            <p style="font-size:3vh;"><i>1) Table of all employees and their monthly attendance. Table will show "No data Available" if the employee did not swipe that day or will display date and time for each swipe.</i></p>
        </div>
        
     <br>
     
     <!-- Full employee attendance table  --->
        <table id="fullAttendance" class="table table-responsive table-striped table-bordered table-sm" cellspacing="0" width="100%" height="100%">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Name</th>
                    <?php
                        //Generate headers for all the available days in this month
                        //Generate headers for current month & year
                        for ( $iter = 1; $iter <= $num_days; $iter++) {
                            echo '<th scope="col" style="min-width:150px;max-width:300px;">' . $iter . '/' . $current_month . '/' . $current_year . '</th>';
                        }
                    ?>
                    
                </tr>
                
            </thead>
            
            <tbody>
                
                <?php
                    //Loop through all our available users
                   
                        echo '<tr>';
                        echo '<td scope="row" >' . $users['name']  . '</td>';

                        //Iterate through all available days for this month
                        for ( $iter = 1; $iter <= $num_days; $iter++) {
                            //For each pass grab any attendance that this particular user might of had for that day
                            $attendance = $database->select("attendance", [
                                'clock_in'
                            ], [
                                'user_id' => $users['id'],
                                'clock_in[<>]' => [
                                    date('Y-m-d', mktime(0, 0, 0, $current_month, $iter, $current_year)),
                                    date('Y-m-d', mktime(24, 60, 60, $current_month, $iter, $current_year))
                                ]
                            ]);
                            //Check if our database call actually found anything
                            if(!empty($attendance) ) {
                                //If we have found some data we loop through that adding it to the tables cell
                                echo '<td class="table-success" style="color:blue;">';
                                foreach($attendance as $attendance_data) {
                                    echo   $attendance_data['clock_in'] . '</br>';
                                }
                                echo '</td>';
                            } else if(empty($attendance)) {
                                //If there was nothing in the database notify the user of this.
                                echo '<td class="table-secondary" style="color:black;">No Data Available</td>';
                            }
                        }
                        echo '</tr>';
                    
                ?>
            </tbody>
            
        </table>

        <!--Table paginaton script --->
        <script>
            $(document).ready(function(){
               $('#fullAttendance').DataTable({
                "pagingType":"simple"
                 
            });
               $('.dataTables_length').addClass('bs-select'); 
                
            });
        </script>
        
        
    </div>
    
    
    </body>
    
</html>
