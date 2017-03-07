<?php

function log_entry($message) {
    date_default_timezone_set('America/Chicago');
    include('dconnection.php');
    session_start();
    $user = $_SESSION['user_name'];
    $user_role = '';

    //sydadmin
    if ($_SESSION['id_type'] == '1') {
        $user_role = "System Admin";
    }
    //admin
    if ($_SESSION['id_type'] == '2') {
        $user_role = "Administrator";
    }
    //faculty
    if ($_SESSION['id_type'] == '3') {
        $user_role = "Faculty";
    }
    $ip_address = gethostbyname($_SERVER['SERVER_NAME']);
    

    $sql = "INSERT INTO log_entry VALUES ('',now(),'$ip_address','$user','$user_role','$message')";
    
    $result = $mysqli->query($sql);

}

