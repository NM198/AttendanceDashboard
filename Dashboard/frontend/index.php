<?php
    session_start();
// if user is not logged in, must login first: 
    if(!isset($_SESSION['username'])){
        $_SESSION['msg'] = "You must login to view this page";
        header('location: login.php');
       
}

// Logout User:
    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username']);
        header('location: login.php');
        
}
?>

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
    
    <body style="background-color:#F5F5F5;color:#606060;"onload="realtimeClock()">

 <!--Side navigation pages: --->   
       <div class="sidebar" style="font-family:Arial;">
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
        
 
        <div class="content">
            
           <?php
        // Welcome, logout user
            if(isset($_SESSION['success'])) : ?>
                <div>
                    <h3>
                    <?php
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                    </h3>
                </div>
        <?php endif ?>
        
        <?php if(isset($_SESSION["username"])) : ?> 
                <h1>Welcome <?php echo $_SESSION['username']; ?> to your Dashboard</h1> 
                <button id="logout" class="btn btn-danger btn-sm"><a href="index.php?logout='1'"></a> Logout</button>
                
        <?php endif ?>
        
        <!--CLOCK--->
        <div class="clock-main-container" >
            
        <div id="clock" style ="position:absolute;font-size:6vh;color:#388cff;font-family:'Arial';right:5vh;top:0vh;"> </div>
	     
        </div>
        <!--USERS, ATTENDANCE BUTTONS--->     
        <div class="row mx-n2">
            
        <div class="col-md px-2">
            
            <a href="users.php" class="btn btn-lg btn-dark w-100 mb-3"><b>Users</b></a>
            
        </div>
        
        <div class="col-md px-2">
            
            <a href="attendance.php" class="btn btn-lg btn-dark w-100 mb-3"><b>Attendance</b></a>
            
        </div>
        
        </div>
    
        <div class ="row mx-n2">
            
        <div class="col-md px-2">
        <p style="font-size:3vh;"> <b>Today's Attendance:</b> </p>  
          
        <!--employee daily attendance widget  --->
       <table id="hoursworkedtable"  class="table table-responsive table-striped table-bordered table-sm" cellspacing="0" width:100%; height="60%" style="font-size:3vh;" >
            
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Clock In</th>
                    <th scope="col">Clock out</th>
                </tr>
            </thead>
            
            <tbody>
            <?php
                    //Loop through all our available users
                    foreach($users as $user) {
                        echo '<tr>';
                        echo '<td scope="row" >' . $user['name'] . '</td>';
                        
                            //For each pass grab any attendance that this particular user might of had for that day
                            $attendance = $database->select("attendance", [
                                'clock_in'
                            ], [
                                'user_id' => $user['id']
                            ]);
                            //Check if our database call actually found anything
                            if(!empty($attendance) ) {
                                //If we have found some data we loop through that adding it to the tables cell
                                echo '<td class="table-success" style="color:blue;">';
                                foreach($attendance as $attendance_data) {
                                    echo   $attendance_data['clock_in'] . '</br>';
                                     
                                }
                                //Get last clock in for each employee as clock_out
                                echo ' <td class="table-primary" style="color:red;" scope="column">' . $attendance_data['clock_in'] .' </td>';
                                echo '</td>';
                                
                            } else if(empty($attendance)) {
                                //If there was nothing in the database notify the user of this.
                                echo '<td class="table-secondary" style="color:black;">No Data Available</td>';
                            }
                        
                        echo '</tr>';
                    }
                ?>
                
            </tbody>
           
        </table>
         <!--Table paginaton script --->
        <script>
            $(document).ready(function(){
               $('#hoursworkedtable').DataTable({
                "pagingType":"simple"
            });
               $('.dataTables_length').addClass('bs-select'); 
                
            });
        </script> 
        
        </div>
        
        <!--Application Panel--->
        <div class="col-md px-2">
        <div class="panel panel-primary"style="font-size:3vh;margin-left:10vh;">
            <div class="panel panel-headting"> <b>Applications:</b></div>
            <div class="panel-body"><a href="https://drive.google.com/drive/u/0/my-drive"><img src="https://img.icons8.com/color/50/000000/google-drive.png"<p></a><b>Google Drive</b></p><br><a href="https://docs.google.com/document/u/0/"><img src="https://img.icons8.com/color/48/000000/google-docs.png"<p></a><b>Google Docs</b></p><br><a href="https://docs.google.com/spreadsheets/u/0/"><img src="https://img.icons8.com/color/48/000000/google-sheets.png"<p></a><b>Google Sheets</b></p><br><a href="https://www.office.com/?ref=login"><img src="https://img.icons8.com/color/48/000000/office-365.png"<p></a><b>Office 365</b></p><br><a href="https://www.dropbox.com/business"><img src="https://img.icons8.com/color/48/000000/dropbox.png"<p></a><b>DropBox</b></p></div>
        </div>   
       
        
        </div>
    
        </div>
        </div>
</body>
</html>
