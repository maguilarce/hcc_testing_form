<?php
date_default_timezone_set('America/Chicago');
include('dconnection.php');
include('log_process.php');
session_start();


$sem = $_POST['semester'];

$sql = "UPDATE current_semester SET semester = '$sem' WHERE idcurrent_semester = 1";
$result = $mysqli->query($sql);

log_entry($_SESSION['user_name']." has changed the semester to ".$sem);
header('Location: manage_term.php?msg=1');
