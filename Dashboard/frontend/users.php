<?php
    session_start();
    
    $usertype = $_SESSION['usertype'][0];
    // if user is not logged in, must login first:    
    if(!isset($_SESSION['username']))
{
        $_SESSION['msg'] = "You must login to view this page";
        header('location: login.php');
}

    // if user is not an administrator, cannot access page:
    if($usertype == 'employee')
{
    header('Location:  login.php');
}


 

    // Logout User
    if(isset($_GET['logout'])){
        session_destroy();
        header('location: login.php');        
}
?>
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
    
    <body style="background-color:#F5F5F5;color:#606060;font-family:Arial;">
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
    <div class="content_users">
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
                <h1>Welcome <?php echo $_SESSION['username']; ?> to the users page</h1> 
                <button id="logout"class="btn btn-danger btn-sm"><a href="index.php?logout='1'"></a> Logout</button>
        <?php endif ?> 
       <p style ="text-align:center;font-size:5vh;">Welcome to the users page: </p>
        <div class="row">
            <p style="font-size:3vh;"><i>1) Table of all employees currently registered in the system.  ID,Name, Department, Tag id is displayed for each employee respectively.</i></p>
        </div>
        <!--Employee Registered table --->
        <table id="employeeslist" class="table table-responsive table-striped table-sm" cellspacing="0" width="100%" height="100%">
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
     <!--Bootstrap Table paginaton script --->
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

