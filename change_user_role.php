<?php

date_default_timezone_set('America/Chicago');
include('dconnection.php');
include('log_process.php');
session_start();

$id = $_POST['id'];
$user_name = $_POST['user_name'];
$role = $_POST['role'];

$sql = "UPDATE user_testing_form SET id_type = '$role' WHERE id_user = '$id'";
$mysqli->query($sql);

$user_changed = '';

if($role == '1')
{
    $user_changed = 'sysadmin';
}
if($role == '2')
{
    $user_changed = 'admin';
}
if($role == '3')
{
    $user_changed = 'faculty';
}

log_entry($_SESSION['user_name']." has changed the role of user ".$user_name." to ".$user_changed);
header("Location: manage_users.php?msg=4");
