<?php 
include('dconnection.php');
$sql1 = "SELECT * FROM scheduled_test WHERE id='4'";
$result1 = $mysqli->query($sql1);
$row1 = $result1->fetch_assoc();

$crn = preg_split('/\s+/', $row1['crn']);

//$crn = explode(" ", $row1['crn']);
 print_r($row1['crn']);
echo '<br/>'; 
print_r($crn[0]);echo ' ';
print_r($crn[1]);echo ' ';
print_r($crn[2]);echo ' ';

