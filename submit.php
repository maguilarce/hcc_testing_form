<?php
include('dconnection.php');
/*
Receiving all data from the testing form (validate through HTML atributes
 *  */
$fname = $_POST['FirstName'];
$lname = $_POST['LastName'];
$email = $_POST['EmailAddress'];
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

$exam_instructions = 
"Book: ".$_POST['open-closed-book'].",".
"Scantron/Write only: ".$_POST['scantron-writeon'].",".
"Time Limit: ".$_POST['time-limit'].",".
"Testing Software: ".$_POST['testing-software'].",".
"Other Testing Software: ".$_POST['other-testing-software'].",".
"Calculators: ".$_POST['calculators']."<br/>".
"Type of Calculator: ".$_POST['type-calculator'].",".
"Allowed material: ".$_POST['material-allowed'];


$special_instructions = $_POST['special-instructions'];
$date = date('Y-m-d H:i:s');

//paper-pencil exams (10 exams)
$paper_proctor_dates = array();
$paper_proctor_dates_P = array();
$paper_proctor_time_slot = array();

//online exams (10 exams)
$online_proctor_dates = array();
$online_proctor_dates_O = array();
$online_time_slot = array();


$sql = "INSERT INTO scheduled_test VALUES ('','$date','6172',"
        . "'$fname',"
        . "'$lname',"
        . "'$email',"
        . "'$home_campus',"
        . "'$HCC_phone',"
        . "'$other_phone',"
        . "'$phone_type',"
        . "'$give_stud',"
        . "'$course',"
        . "'$crn',"
        . "'$term',"
        . "'$online_test',"
        . "'$password',"
        . "'$testing_center',"
        . "'$delivered_campus',"
        . "'$campus_location',"
        . "'$exam_instructions',"
        . "'$special_instructions')";

$result = $mysqli->query($sql);
echo $crn;
if (!$result) {
    die('Invalid query: ' . $mysqli->error);
}

$last_id = $mysqli->insert_id;



for($i=0;$i<5;$i++)
{
    $paper_proctor_dates[$i] = $_POST['paper_proctor_date'.$i];
    $paper_proctor_dates_P[$i] = $_POST['paper_proctor_date_P'.$i];
    $paper_proctor_time_slot[$i] = $_POST['paper-time-slot-'.$i];
    
    $online_proctor_dates[$i] = $_POST['online_proctor_date'.$i];
    $online_proctor_dates_O[$i] = $_POST['online_proctor_date_O'.$i];
    $online_time_slot[$i] = $_POST['oline-time-slot-'.$i];
    
    if($paper_proctor_dates[$i]!="None")
    {
        $sql = "INSERT INTO paper_testing VALUES ('','$last_id','$paper_proctor_dates[$i]','$paper_proctor_dates_P[$i]','$paper_proctor_time_slot[$i]')";
        $mysqli->query($sql);
    }
    
    if($online_proctor_dates[$i]!="None")
    {
        $sql = "INSERT INTO online_testing VALUES ('','$last_id','$online_proctor_dates[$i]','$online_proctor_dates_O[$i]','$online_time_slot[$i]')";
        $mysqli->query($sql);
    }
    
}



echo $last_id;
echo '<pre>';  
print_r($_POST);
echo '</pre>';

//header("Location: index.php");