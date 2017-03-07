<?php
date_default_timezone_set('America/Chicago');
include('dconnection.php');
include('log_process.php');
session_start();

$id = $_POST['id'];

$sql1 = "UPDATE scheduled_test SET state = 'Inactive' WHERE id = '$id'";
$sql2 = "UPDATE paper_testing SET state = 'Inactive' WHERE scheduled_id = '$id'";
$sql3 = "UPDATE online_testing SET state = 'Inactive' WHERE scheduled_id = '$id'";

$r1 = $mysqli->query($sql1);
$r2 = $mysqli->query($sql2);
$r3 = $mysqli->query($sql3);

if(!$r1)
{
    echo $mysqli->error;
}
elseif(!$r2)
{
    echo $mysqli->error;
}
elseif(!$r3)
{
    echo $mysqli->error;
}
else  
{
    log_entry($_SESSION['user_name']." has deactivated the test with id = ".$id);
    header("Location: allrecords.php?msg=2");
}

