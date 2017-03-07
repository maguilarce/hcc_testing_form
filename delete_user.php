<?php


date_default_timezone_set('America/Chicago');
include('dconnection.php');
include('log_process.php');
session_start();

$id = $_POST['id'];
$sql = "DELETE FROM user_testing_form WHERE id_user = '$id'";
$mysqli->query($sql);
log_entry($_SESSION['user_name']." has deleted the user with id = .".$id);