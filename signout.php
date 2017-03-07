<?php

include('dconnection.php');
include('log_process.php');
session_start();
log_entry($_SESSION['user_name']." has signed out.");
session_destroy();
header('location: signin.php');
