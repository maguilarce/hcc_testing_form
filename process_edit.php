<?php
include('dconnection.php');
/*
Receiving all data from the testing form (validate through HTML atributes
 *  */
$id = $_POST['id'];
$fname = $_POST['FirstName'];
$lname = $_POST['LastName'];
$home_campus = $_POST['HomeCampus'];
$HCC_phone = $_POST['HCCPhone'];
$other_phone = $_POST['OtherPhone'];
$phone_type = $_POST['type_of_phone'];
$give_stud = $_POST['give_to_students'];
$course = $_POST['offered_courses'];
$crn = implode("<br/>",$_POST['crn']);
$term = $_POST['term'];
$online_test = $_POST['test-online'];
$password = $_POST['password'];
$testing_center = $_POST['testingCenter'];
$delivered_campus = $_POST['onsiteTest'];
$campus_location = $_POST['campusLocation'];
$exam_instructions = $_POST['test_instructions'];
$special_instructions = $_POST['special-instructions'];
$date = date('Y-m-d H:i:s');
$semester = '6172';
//paper-pencil exams (up to 5 exams)
$paper_proctor_dates = array();
$paper_proctor_dates_P = array();
$paper_proctor_time_slot = array();

//online exams (up to 5 exams)
$online_proctor_dates = array();
$online_proctor_dates_O = array();
$online_time_slot = array();

$sql1 = "UPDATE schedule_test SET "
        . "date_submitted = '$date',"
        . "semester = '$semester',"
        . "fname = '$fname',"
        . "lname = '$lname',"
        . "email = '$email',"
        . "home_campus = '$home_campus',"
        . "HCC_phone = '$HCC_phone',"
        . "ot"
        . ""
        . ""
        . ""
        . ""
        . ""
        . "WHERE id = '$id'";
        
