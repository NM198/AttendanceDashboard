<?php
session_start();
$username="";
$email="";

$errors=array();

//connect to db 
$db=mysqli_connect('localhost','attendanceadmin','attendance2020','attendancesystem') or die ("could not connect to the database");
//Login user
if(isset($_POST['user_login'])){
	
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$password = mysqli_real_escape_string($db, $_POST['password']);	
	
	if(empty($username)){	
	 array_push($errors, "username is required"); 
	}
	 if(empty($password)){
	 array_push($errors, "password is required");
	}
	if(count($errors) === 0 ){		
	 $password = md5($password); //encrypt
	 
	 $query = "SELECT * FROM userlogin WHERE username ='$username' AND password='$password'";
	 
	 $results = mysqli_query($db, $query);
	 
	if(mysqli_num_rows($results) ){
	 
	  $_SESSION['username'] = $username;
	  $_SESSION['success'] = "logged in successfully";
	  header('location: index.php'); 
	  
	}else{	
	  array_push($errors, "Wrong Username/Password combination. Please try again");	
	}	
  }
}


?>
