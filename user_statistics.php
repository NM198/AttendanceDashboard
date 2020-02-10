<?php
require 'common.php';

//Grab all the users from our database
$users = $database->select("users", [
    'id',
    'name',
    'rfid_uid'
]);

$attendance = $database ->select("attendance", [
    'id',
    'clock_in',
    'clock_out'
 
]);









































?>



                           

