<?php
date_default_timezone_set('America/Chicago');
include('dconnection.php');
include('log_process.php');
session_start();


$user_id = $_GET['user_id'];
$state = $_GET['state'];
$user_name = $_GET['user_name'];
$sql = '';
//echo $user_id."<br/>".$state;

if($state == "Active")
{
    $sql = "UPDATE user_testing_form SET state = 'Inactive' WHERE id_user = '$user_id'";
    $mysqli->query($sql);
    log_entry($_SESSION['user_name']." has changed the state of user ".$user_name." to Inactive");
    header("Location: manage_users.php?msg=1");
}
elseif ($state == "Inactive") 
{
    $sql = "UPDATE user_testing_form SET state = 'Active' WHERE id_user = '$user_id'";
    $mysqli->query($sql);
    log_entry($_SESSION['user_name']." has changed the state of user ".$user_name." to Active");
    header("Location: manage_users.php?msg=2");
}

