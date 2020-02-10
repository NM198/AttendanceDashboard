<?php
require 'common.php';

//Grab all users from our database
$users = $database->select("users", [
    'id',
    'name',
    'rfid_uid',
    'department'
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
    
    <div class="content_attendance">
        
        <h1 style="text-align:center;">Welcome to your attendance page: </h1>
        
        <br>
        
        <div class="row" style ="margin-top:50px;">
            <h3>1) Here we can view the list of all employees and their monthly attendance</h3>
        </div>
        
     <br>
     
     <!-- Full employee attendance table  --->
        <table id="fullAttendance" class="table table-responsive table-striped table-bordered table-sm" cellspacing="0" width="100%">
            
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
                    foreach($users as $user) {
                        echo '<tr>';
                        echo '<td scope="row" >' . $user['name'] . '</td>';

                        //Iterate through all available days for this month
                        for ( $iter = 1; $iter <= $num_days; $iter++) {
                            //For each pass grab any attendance that this particular user might of had for that day
                            $attendance = $database->select("attendance", [
                                'clock_in',
                                'clock_out'
                            ], [
                                'user_id' => $user['id'],
                                'clock_in[<>]' => [
                                    date('Y-m-d', mktime(0, 0, 0, $current_month, $iter, $current_year)),
                                    date('Y-m-d', mktime(24, 60, 60, $current_month, $iter, $current_year))
                                ],
                                'clock_out[<>]' => [
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
                                    echo   $attendance_data['clock_out'] . '</br>';
                                }
                                echo '</td>';
                            } else if(empty($attendance)) {
                                //If there was nothing in the database notify the user of this.
                                echo '<td class="table-secondary" style="color:black;">No Data Available</td>';
                            }
                        }
                        echo '</tr>';
                    }
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
        
        <button onclick="generatepdf();" class="btn btn-primary " type="button" style="margin:auto;display:block;" > Download Report PDF </button>
        
    </div>
    
     <!--Produce Pdf script --->
    <script>
     function generatepdf(){
         var printMe = document.getElementById('fullAttendance').outerHTML;
         var wme = window.open("","","width:800,height:900");
         wme.document.write(printMe);
         wme.document.close();
         wme.focus();
         wme.print();
         wme.close();
         }
    </script>
    
    <br> 
    
    <!--Statistics section --->
    <div class="content_attendance">
        
    <h1 style="text-align:center;"> Employee Statistics: </h1>
    
    <br>
     
    <!--employee table 1  --->
    <h3> 2) Table showing employees by their name, the time they first swiped into the office and the last time they swiped to leave.</h3>
    
       <table id="hoursworkedtable" class="table table-responsive table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Clock In</th>
                    <th scope="col">Clock out</th>
                    <th scope="col">Hours worked</th>
                </tr>
            </thead>
            
            <tbody>
                
                <?php
                    //Loop through all users and show their clock_in, clock_out times
                    foreach($users as $user){
                        echo '<tr>';
                        echo '<td scope="row" >' . $user['name'] . '</td>';
                        echo '<td scope="row" >' .$attendance_data['clock_in'] . '</td>';
                        echo ' <td scope="row">' . $attendance_data['clock_out'] .' </td>';
                        echo '</tr>';
                    }
                ?>
                
            </tbody>
            
        </table>
        <button onclick="generatepdf1();" class="btn btn-primary " type="button" style="margin:auto;display:block;"> Download Report PDF </button>
     <br>
      <!--Produce Pdf script --->
    <script>
     function generatepdf1(){
         var printMe = document.getElementById('hoursworkedtable').outerHTML;
         var wme = window.open("","","width:800,height:900");
         wme.document.write(printMe);
         wme.document.close();
         wme.focus();
         wme.print();
         wme.close();
         }
    </script>
    <!--Employee table 2 --->
     <h3>3)Table showing attendance by department. The table should display all departments and the number of employees present each month. </h3>  
        
     <table id="departmenttable"class="table table-responsive table-striped">
         
            <thead class="thead-dark">
                
                <tr>
                    
                    <th scope="col">Department</th>
                    <th scope="col">Employees present</th>
                    
                </tr>
                
            </thead>
            
            <tbody>
                
               <?php
                //Loop through departments and show number of users available
                foreach($users as $user) {
                    echo '<tr>';
                    echo ' <td>'  . $user['department'] .' </td>';
                    echo ' </tr>';
                }
                
               ?>  
            </tbody>
            
     </table>
     <button onclick="generatepdf2();" class="btn btn-primary " type="button" style="margin:auto;display:block;" > Download Report PDF </button>
     <br>
     <br>
      <!--Produce Pdf script --->
    <script>
     function generatepdf2(){
         var printMe = document.getElementById('departmenttable').outerHTML;
         var wme = window.open("","","width:800,height:900");
         wme.document.write(printMe);
         wme.document.close();
         wme.focus();
         wme.print();
         wme.close();
         }
    </script>
     <!--Employee table 3 --->
     <h3>4)Table showing Individual Ontime/late attendance. The table will display all employees names , attendance and also whether they were on time or late. </h3>
     
      <table id="ontime/latetable"class="table table-responsive table-striped">
          
            <thead class="thead-dark">
                
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Ontime</th>
                    <th scope="col">Late</th>
                    <th scope="col">No Data</th>
                </tr>
                
            </thead>
            
      <tbody>
                
                <?php
                //loop through users, show how many times ontime, late or no data
                foreach($users as $user) {
                        echo '<tr>';
                        echo '<td scope="row" >' . $user['name'] . '</td>';
                        echo '</tr>';
                    }
                ?>
                
     </tbody>
            
     </table>
     <button onclick="generatepdf3();" class="btn btn-primary " type="button" style="margin:auto;display:block;"> Download Report PDF </button>
   </div>
   <!--Produce Pdf script --->
    <script>
     function generatepdf3(){
         var printMe = document.getElementById('ontime/latetable').outerHTML;
         var wme = window.open("","","width:800,height:900");
         wme.document.write(printMe);
         wme.document.close();
         wme.focus();
         wme.print();
         wme.close();
         }
    </script>
    </body>
    
</html>
