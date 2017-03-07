<?php

date_default_timezone_set('America/Chicago');
include('dconnection.php');
include('log_process.php');
session_start();
/*
  Receiving all data from the testing form (validate through HTML atributes
 *  */

$id = $_POST['id'];
$home_campus = mysqli_real_escape_string($mysqli,$_POST['HomeCampus']);
$HCC_phone = $_POST['HCCPhone'];
$other_phone = $_POST['OtherPhone'];
$phone_type = $_POST['type_of_phone'];
$give_stud = $_POST['give_to_students'];
$course = $_POST['offered_courses'];
$crn = implode(" ", $_POST['crn']);
$term = $_POST['term'];
$online_test = $_POST['test-online'];
$password = $_POST['password'];
$testing_center = $_POST['testingCenter'];
$delivered_campus = $_POST['onsiteTest'];
$campus_location = $_POST['campusLocation'];
$exam_instructions = $_POST['test-instructions'];
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

$sql1 = "UPDATE scheduled_test SET "
        . "date_submitted = '$date',"
        . "semester = '$semester',"
        . "home_campus = '$home_campus',"
        . "HCC_phone = '$HCC_phone',"
        . "other_phone = '$other_phone',"
        . "phone_type = '$phone_type',"
        . "give_stud = '$give_stud',"
        . "course = '$course',"
        . "crn = '$crn',"
        . "term = '$term',"
        . "online_test = '$online_test',"
        . "password = '$password',"
        . "testing_center = '$testing_center',"
        . "delivered_campus = '$delivered_campus',"
        . "campus_location = '$campus_location',"
        . "exam_instructions = '$exam_instructions',"
        . "special_instructions = '$special_instructions' "
        . "WHERE id = '$id' AND state = 'Active'";



$result1 = $mysqli->query($sql1);

$last_id = $mysqli->insert_id;

for ($i = 0; $i < 5; $i++) {
    //colocar los isset

    if (isset($_POST['paper_proctor_date' . $i])) {
        $paper_proctor_dates[$i] = $_POST['paper_proctor_date' . $i];
    }

    if (isset($_POST['paper_proctor_date_P' . $i])) {
        $paper_proctor_dates_P[$i] = $_POST['paper_proctor_date_P' . $i];
    }

    if (isset($_POST['paper-time-slot-' . $i])) {
        $paper_proctor_time_slot[$i] = $_POST['paper-time-slot-' . $i];
    }

    if (isset($_POST['online_proctor_date' . $i])) {
        $online_proctor_dates[$i] = $_POST['online_proctor_date' . $i];
    }


    if (isset($_POST['online_proctor_date_O' . $i])) {
        $online_proctor_dates_O[$i] = $_POST['online_proctor_date_O' . $i];
    }

    if (isset($_POST['online-time-slot-' . $i])) {
        $online_time_slot[$i] = $_POST['online-time-slot-' . $i];
    }


    if (!empty($_POST['paper_proctor_date' . $i]) && !empty($_POST['paper_proctor_date_P' . $i]) && !empty($_POST['paper-time-slot-' . $i])) {
        if (($paper_proctor_dates[$i] != "None") and ( !empty($_POST["_paper_proctor_date" . $i . "_id"]))) {
            $hidden1 = $_POST["_paper_proctor_date" . $i . "_id"];
            $paper_proctor_dates[$i] = $_POST['paper_proctor_date' . $i];
            $paper_proctor_dates_P[$i] = $_POST['paper_proctor_date_P' . $i];
            $paper_time_slot[$i] = $_POST['paper-time-slot-' . $i];
            $sql = "UPDATE paper_testing SET scheduled_id = '$id', test_date = '$paper_proctor_dates[$i]', proctor_date = '$paper_proctor_dates_P[$i]', time_slot = '$paper_time_slot[$i]' WHERE id = '$hidden1' AND scheduled_id = '$id' AND state = 'Active'";
            $re = $mysqli->query($sql);
        } elseif ($paper_proctor_dates[$i] != "None") {
            $sql = "INSERT INTO paper_testing VALUES ('','$id','$paper_proctor_dates[$i]','$paper_proctor_dates_P[$i]','$paper_proctor_time_slot[$i]','Active')";
            $mysqli->query($sql);
        }
    }


    if (!empty($_POST['online_proctor_date' . $i]) && !empty($_POST['online_proctor_date_O' . $i]) && !empty($_POST['online-time-slot-' . $i])) {
        if (($online_proctor_dates[$i] != "None") and ( !empty($_POST["_online_proctor_date" . $i . "_id"]))) {
            $hidden2 = $_POST["_online_proctor_date" . $i . "_id"];
            $online_proctor_dates[$i] = $_POST['online_proctor_date' . $i];
            $online_proctor_dates_O[$i] = $_POST['online_proctor_date_O' . $i];
            $online_time_slot[$i] = $_POST['online-time-slot-' . $i];
            $sql = "UPDATE online_testing SET scheduled_id = '$id', test_date = '$online_proctor_dates[$i]', proctor_date = '$online_proctor_dates_O[$i]', time_slot = '$online_time_slot[$i]' WHERE id = '$hidden2' AND scheduled_id = '$id' AND state = 'Active'";
            $re = $mysqli->query($sql);
        } elseif ($online_proctor_dates[$i] != "None") {
            $sql = "INSERT INTO online_testing VALUES ('','$id','$online_proctor_dates[$i]','$online_proctor_dates_O[$i]','$online_time_slot[$i]','Active')";
            $mysqli->query($sql);
        }
    }
}
log_entry($_SESSION['user_name']." has changed the test with id = ".$id );
header("Location: allrecords.php?msg=1");



