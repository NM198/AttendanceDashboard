<?php

session_start();
$username="";
$email="";
$errors=array();
$errorslogin=array();

//connect to db 
$db=mysqli_connect('localhost','attendanceadmin','attendance2020','attendancesystem') or die ("could not connect to the database");

//register users
if (isset($_POST['user_login'])){
$username =mysqli_real_escape_string($db, $_POST['username']);

$email=mysqli_real_escape_string($db, $_POST['email']);

$password_1 =mysqli_real_escape_string($db, $_POST['password_1']);

$password_2=mysqli_real_escape_string($db, $_POST['password_2']);

//form validation
if(empty($username)){
	array_push($errors,"** Username is required");
	}
if(empty($email)){
	array_push($errors,"** Email is required");
	}
if(empty($password_1)){
	array_push($errors,"** Password is required");
	}
if($password_1 != $password_2){
	array_push($errors, "** Passwords do not match");
	}

// check database for existing user
$user_check_query = "SELECT * FROM userlogin WHERE username ='$username' or email = '$email' LIMIT 1";

$result = mysqli_query($db, $user_check_query);

$userlogin = mysqli_fetch_assoc($result);

if($userlogin){
	if($userlogin['username'] === $username){
		array_push($errors, "username already exists");
		}
	if($userlogin['email'] === $email){
		array_push($errors, "email is already registed to a username");
		}
}

//if no errors , register user
if(count($errors) ===0){
	$password= md5($password_1); //encrypt
	$query = "INSERT INTO userlogin(username,email,password) VALUES ('$username', '$email', '$password')";
	mysqli_query($db,$query);
	$_SESSION['username'] =$username;
	$_SESSION['success'] = "you are now logged in";
	header('location: index.php');
	}
}

//Login user
if(isset($_POST['user_login'])){
	
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$password = mysqli_real_escape_string($db, $_POST['password']);	
	
	if(empty($username)){	
	 array_push($errorslogin, "username is required"); 
	}
	 if(empty($password)){
	 array_push($errorslogin, "password is required");
	}
	if(count($errorslogin) === 0 ){		
	 $password = md5($password); //encrypt
	 
	 $query = "SELECT * FROM userlogin WHERE username ='$username' AND password='$password'";
	 
	 $results = mysqli_query($db, $query);
	 
	if(mysqli_num_rows($results) ){
	 
	  $_SESSION['username'] = $username;
	  $_SESSION['success'] = "logged in successfully";
	  header('location: index.php'); 
	  
	}else{	
	  array_push($errorslogin, "Wrong Username/Password combination. Please try again");	
	}	
  }
}

?>
