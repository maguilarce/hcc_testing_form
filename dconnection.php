<?php

$mysqli = new mysqli("127.0.0.1", "root", "", "merope");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$sql_semester = "SELECT semester FROM current_semester WHERE 1";
$result_semester = $mysqli->query($sql_semester);
$row_semester = $result_semester->fetch_assoc();
$current_semester = $row_semester['semester'];



