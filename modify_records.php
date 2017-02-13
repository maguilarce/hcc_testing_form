<?php
include('dconnection.php');

if(isset($_POST['edit_row']))
{
 $id=$_POST['row_id'];
 $date_submitted=$_POST['date_submitted_val'];
 $fname=$_POST['fname_val'];
 $lname=$_POST['lname_val'];
 $HCC_phone=$_POST['HCC_phone_val'];
 $other_phone=$_POST['other_phone_val'];
 $delivered_campus=$_POST['delivered_campus_val'];
 $home_campus=$_POST['home_campus_val'];
 $course=$_POST['course_val'];
 $crn=$_POST['crn_val'];
 $term=$_POST['term_val'];
 $pptw=$_POST['pptw_val'];
 $pppd=$_POST['pppd_val'];
 $ppts=$_POST['ppts_val'];
 $oltw=$_POST['oltw_val'];
 $olpd=$_POST['olpd_val'];
 $olts=$_POST['olts_val'];
 $exam_instructions=$_POST['exam_instructions_val'];
 $special_instructions=$_POST['special_instructions_val'];

 
$sql = "UPDATE scheduled_test SET date_submitted='$date_submitted',fname='$fname',lname='$lname',HCC_phone='$HCC_phone',other_phone='$other_phone',delivered_campus='$delivered_campus',home_campus='$home_campus',course='$course',crn='$crn',term='$term',exam_instructions='$exam_instructions',special_instructions='$special_instructions' WHERE id='$id'";
$result = $mysqli->query($sql);
/*
$sqlpp = "UPDATE paper_testing SET test_date='$pptw', proctor_date='$pppd', time_slot='$ppts' WHERE scheduled_id='$id'";
$result2 = $mysqli->query($sqlpp);

$sqlol = "UPDATE online_testing SET test_date='$oltw', proctor_date='$olpd', time_slot='$olts' WHERE scheduled_id='$id'";
$result3 = $mysqli->query($sqlol);
*/

if (!$result||!$result2||!$result3) {
    die('Invalid query: ' . $mysqli->error);
}
 else {
     echo "success";
     exit();
 }
}

if(isset($_POST['delete_row']))
{
 $row_no=$_POST['row_id'];
 mysql_query("delete from user_detail where id='$row_no'");
 echo "success";
 exit();
}

if(isset($_POST['insert_row']))
{
 $name=$_POST['name_val'];
 $age=$_POST['age_val'];
 mysql_query("insert into user_detail values('','$name','$age')");
 echo mysql_insert_id();
 exit();
}
?>