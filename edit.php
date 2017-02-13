<?php
include('head.php');
include('navbar.php');
include('bootstrap.php');
include('footer.php');
include('dconnection.php');

$id = $_GET['id'];
$sql1 = "SELECT * FROM scheduled_test WHERE id='$id'";
$result1 = $mysqli->query($sql1);
$row1 = $result1->fetch_assoc();

$sql2 = "SELECT * FROM paper_testing WHERE scheduled_id='$id'";
$result2 = $mysqli->query($sql2);
?>
<!DOCTYPE html>
<html lang="en">
    <body>
        <div class="container">
            <h1 class="well">Edit Form</h1>
            <div class="col-lg-12 well">
                <form method="post" action="process_edit.php">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="row center-block">
                        <div class="col-sm-12">
                            <div class="row center-block">
                                <div class="col-sm-6 form-group">
                                    <label>First Name</label><i class="text-danger">*</i>
                                    <input name='FirstName' type="text" placeholder="Enter First Name Here.." class="form-control " value="<?php echo $row1['fname']; ?>" required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Last Name</label><i class="fa fa-asterisk text-danger">*</i>
                                    <input name='LastName' type="text" placeholder="Enter Last Name Here.." class="form-control" value="<?php echo $row1['lname']; ?>" required>
                                </div>
                            </div>
                            <div class="row center-block">
                                <div class="col-sm-6 form-group">
                                    <label>Email Address</label><i class="fa fa-asterisk text-danger">*</i>
                                    <input  pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" title="Invalid email format" name='EmailAddress' type="text" placeholder="Enter Email Address Here.." class="form-control" value="<?php echo $row1['email']; ?>" disabled>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Home Campus</label><i class="fa fa-asterisk text-danger">*</i>
                                    <select name='HomeCampus' class="form-control" required>
                                        <option selected="true" value="<?php echo $row1['home_campus']; ?>"><?php echo $row1['home_campus']; ?></option>
                                        <?php
                                        if ($row1['home_campus'] != 'Alief') {
                                            echo "<option value='Alief'>Alief</option>";
                                        }
                                        if ($row1['home_campus'] != 'Central') {
                                            echo "<option value='Central'>Central</option>";
                                        }
                                        if ($row1['home_campus'] != 'East side') {
                                            echo "<option value='East side'>East side</option>";
                                        }
                                        if ($row1['home_campus'] != 'Northline') {
                                            echo "<option value='Northline'>Northline</option>";
                                        }
                                        if ($row1['home_campus'] != 'Katy') {
                                            echo "<option value='Katy'>Katy</option>";
                                        }
                                        if ($row1['home_campus'] != 'Spring Branch') {
                                            echo "<option value='Spring Branch'>Spring Branch</option>";
                                        }
                                        if ($row1['home_campus'] != 'Stafford') {
                                            echo "<option value='Stafford'>Stafford</option>";
                                        }
                                        if ($row1['home_campus'] != 'West Loop')
                                            echo "<option value='West Loop'>West Loop</option>";
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row center-block">
                                <div class="col-sm-3 form-group">
                                    <label>HCC Phone</label>
                                    <input name='HCCPhone' type="text" placeholder="Enter HCC Phone Number Here.." class="form-control" value="<?php echo $row1['HCC_phone']; ?>">
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>Other Phone</label>
                                    <input name='OtherPhone' type="text" placeholder="Enter Other Phone Number Here.." class="form-control" value="<?php echo $row1['other_phone']; ?>">
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>Type of Phone</label><i class="fa fa-asterisk text-danger">*</i>
                                    <select name="type_of_phone" class="form-control" required>
                                        <option selected="true" value="<?php echo $row1['phone_type']; ?>"><?php echo $row1['phone_type']; ?></option>
                                        <?php
                                        if ($row1['phone_type'] != 'Home') {
                                            echo "<option value='Home'>Home</option>";
                                        }
                                        if ($row1['phone_type'] != 'Cell') {
                                            echo "<option value='Cell'>Cell</option>";
                                        }
                                        if ($row1['phone_type'] != 'Work') {
                                            echo "<option value='Work'>Work</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>Give to students?</label><i class="fa fa-asterisk text-danger">*</i>
                                    <select name="give_to_students" class="form-control" value="<?php echo $row1['give_stud']; ?>" required>
                                        <option selected="true" value="<?php echo $row1['give_stud']; ?>"><?php echo $row1['give_stud']; ?></option>
                                        <?php
                                        if ($row1['give_stud'] != 'Yes') {
                                            echo "<option value='Yes'>Yes</option>";
                                        }
                                        if ($row1['give_stud'] != 'Do not') {
                                            echo "<option value='Do not'>Do not</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row center-block">
                                <div class="col-sm-4 form-group">
                                    <label>Course</label><i class="fa fa-asterisk text-danger">*</i>
                                    <select name="offered_courses" class="form-control" required>

                                        <?php
                                        $sql = "SELECT * FROM offered_courses";
                                        $result = $mysqli->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($offered_courses = $result->fetch_assoc()) {
                                                if ($row1['course'] == $offered_courses['descr']) {
                                                    echo "<option value='" . $offered_courses['descr'] . "' selected='true'>" . $offered_courses['subject'] . " - " . $offered_courses['catalog'] . " - " . $offered_courses['descr'] . "</option>";
                                                } else {
                                                    echo "<option value='" . $offered_courses['descr'] . "'>" . $offered_courses['subject'] . " - " . $offered_courses['catalog'] . " - " . $offered_courses['descr'] . "</option>";
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-4 form-group" id="crnAjax">
                                    <label>CRN</label><i class="fa fa-asterisk text-danger">*</i>
                                    <select multiple name="crn" class="form-control" required >
                                        <?php
                                        $course = $row1['course'];
                                        $sql = "SELECT CRN FROM courses WHERE Title = '$course' and Term = 6172";
                                        $result = $mysqli->query($sql);

                                        $crn = array();
                                        $crn = preg_split('/\s+/', $row1['crn']);
                                        //$i = 0;
                                        while ($crn1 = $result->fetch_assoc()) {
                                            foreach ($crn1 as $c1) {
                                                if (in_array($c1, $crn)) {
                                                    echo "<option selected='true' value='$c1'>" . $c1 . "</option>";
                                                } else {
                                                    echo "<option value='$c1'>" . $c1 . "</option>";
                                                }
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label>Term</label><i class="fa fa-asterisk text-danger">*</i>
                                    <select name="term" class="form-control" required>
                                        <option selected="true" value="<?php echo $row1['term']; ?>"><?php echo $row1['term']; ?></option>
                                        <?php
                                        if ($row1['term'] != 'RT') {
                                            echo "<option value='RT'>RT</option>";
                                        }
                                        if ($row1['term'] != 'SS') {
                                            echo "<option value='SS'>SS</option>";
                                        }
                                        if ($row1['term'] != '1st 8 weeks') {
                                            echo "<option value='1st 8 weeks'>1st 8 weeks</option>";
                                        }
                                        if ($row1['term'] != '2nd 8 weeks') {
                                            echo "<option value='2nd 8 weeks'>2nd 8 weeks</option>";
                                        }
                                        ?>

                                    </select>
                                </div>

                            </div>
                            <div class="row center-block">
                                <div class="col-sm-6 form-group">
                                    <label>Will your exams be online?</label><i class="fa fa-asterisk text-danger">*</i>
                                    <select id="test-online" name="test-online" class="form-control" required>
                                        <option selected="true" value="<?php echo $row1['online_test']; ?>"><?php echo $row1['online_test']; ?></option>
                                        <?php
                                        if ($row1['online_test'] != 'Yes')
                                            echo "<option value='Yes'>Yes</option>";
                                        if ($row1['online_test'] != 'No')
                                            echo "<option value='No'>No</option>";
                                        ?>

                                    </select>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>If yes, please provide a password</label>
                                    <input id="online-option" name='password' type="text" placeholder="Enter Password Here.." class="form-control" value="<?php echo $row1['password']; ?>">
                                </div>
                            </div>
                            <div class="row center-block">
                                <div class="col-sm-5 form-group">
                                    <label>Will you be using HCC Online Testing Centers?</label><i class="fa fa-asterisk text-danger">*</i>
                                    <select name='testingCenter' class="form-control" required>
                                        <option selected="true" value="<?php echo $row1['testing_center']; ?>"><?php echo $row1['testing_center']; ?></option>
                                        <?php
                                        if ($row1['testing_center'] != 'Yes')
                                            echo "<option value='Yes'>Yes</option>";
                                        if ($row1['testing_center'] != 'No')
                                            echo "<option value='No'>No</option>";
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-5 form-group">
                                    <label>Do you want your on-site exams delivered to a campus?</label><i class="fa fa-asterisk text-danger">*</i>
                                    <select name='onsiteTest' class="form-control" required>
                                        <option selected="true" value="<?php echo $row1['delivered_campus']; ?>"><?php echo $row1['delivered_campus']; ?></option>
                                        <?php
                                        if ($row1['delivered_campus'] != 'Yes')
                                            echo "<option value='Yes'>Yes</option>";
                                        if ($row1['delivered_campus'] != 'No')
                                            echo "<option value='No'>No</option>";
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-2 form-group">
                                    <label>Campus Location</label>
                                    <select name='campusLocation' class="form-control">
                                        <option selected="true" value="<?php echo $row1['campus_location']; ?>"><?php echo $row1['campus_location']; ?></option>
                                        <?php
                                        if ($row1['campus_location'] != 'Alief') {
                                            echo "<option value='Alief'>Alief</option>";
                                        }
                                        if ($row1['campus_location'] != 'Central') {
                                            echo "<option value='Central'>Central</option>";
                                        }
                                        if ($row1['campus_location'] != 'East side') {
                                            echo "<option value='East side'>East side</option>";
                                        }
                                        if ($row1['campus_location'] != 'Northline') {
                                            echo "<option value='Northline'>Northline</option>";
                                        }
                                        if ($row1['campus_location'] != 'Katy') {
                                            echo "<option value='Katy'>Katy</option>";
                                        }
                                        if ($row1['campus_location'] != 'Spring Branch') {
                                            echo "<option value='Spring Branch'>Spring Branch</option>";
                                        }
                                        if ($row1['campus_location'] != 'Stafford') {
                                            echo "<option value='Stafford'>Stafford</option>";
                                        }
                                        if ($row1['campus_location'] != 'West Loop') {
                                            echo "<option value='West Loop'>West Loop</option>";
                                        }
                                        ?>
                                    </select> 
                                </div>
                            </div>
                            <!--PAPER PENCIL EXAMS-->
                            <div class="row center-block">
                                <div class=" form-group col-sm-5">
                                    <label>If your examns are paper/pencil, please enter dates below</label>
                                    <?php
                                    $sql = "SELECT label FROM paper_exam_dates";
                                    $result = $mysqli->query($sql);



                                    $j = 0;
                                    if ($result->num_rows > 0) {
                                        for ($i = 0; $i < 5; $i++) {
                                            $result = $mysqli->query($sql);
                                            $row2 = $result2->fetch_assoc();
                                            echo "<select name='paper_proctor_date" . $i . "' class='form-control'><option selected='true'>None</option>";


                                            while ($paper_exam_dates = $result->fetch_assoc()) {

                                                if ($row2['test_date'] != $paper_exam_dates['label']) {
                                                    echo "<option value=" . "'" . $paper_exam_dates['label'] . "'" . ">" . $paper_exam_dates['label'] . "</option>";
                                                } else {
                                                    echo "<option selected='true' value=" . "'" . $paper_exam_dates['label'] . "'" . ">" . $paper_exam_dates['label'] . "</option>";
                                                }
                                            }
                                            echo "</select>";
                                        }
                                    }
                                    ?>
                                </div>
                                <div class=" form-group col-sm-4">
                                    <div class="form-group">
                                        <label>Proctor Date</label>
                                        <div class="row form-group">
                                            <?php
                                            $sql = "SELECT start_date,end_date FROM paper_exam_dates";
                                            $result = $mysqli->query($sql);
                                            $sql2 = "SELECT * FROM paper_testing WHERE scheduled_id='$id'";
                                            $result2 = $mysqli->query($sql2);

                                            if ($result->num_rows > 0) {
                                                for ($i = 0; $i < 5; $i++) {
                                                    $result = $mysqli->query($sql);
                                                    $row2 = $result2->fetch_assoc();

                                                    echo "<select name='paper_proctor_date_P" . $i . "' class='form-control'><option selected='true'>None</option>";

                                                    while ($paper_exam_dates = $result->fetch_assoc()) {
                                                        $begin = new DateTime($paper_exam_dates['start_date']);
                                                        $end = new DateTime($paper_exam_dates['end_date']);
                                                        $end = $end->modify('+1 day');
                                                        $daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);
                                                        foreach ($daterange as $date) {
                                                            if ($row2['proctor_date'] != $date->format('m-d-Y')) {
                                                                echo "<option value=" . $date->format('m-d-Y') . ">" . $date->format('m-d-Y') . "</option>";
                                                            } else {
                                                                echo "<option selected='true' value=" . $date->format('m-d-Y') . ">" . $date->format('m-d-Y') . "</option>";
                                                            }
                                                        }
                                                    }
                                                    echo "</select>";
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class=" form-group col-sm-3">
                                    <div class="form-group">
                                        <label>Time Slot</label>
                                        <?php
                                        $sql = "SELECT start_date,end_date FROM paper_exam_dates";
                                        $result = $mysqli->query($sql);
                                        $sql2 = "SELECT * FROM paper_testing WHERE scheduled_id='$id'";
                                        $result2 = $mysqli->query($sql2);
                                        if ($result->num_rows > 0) {
                                            for ($i = 0; $i < 5; $i++) {
                                                $result = $mysqli->query($sql);
                                                $row2 = $result2->fetch_assoc();


                                                echo "<select name='paper-time-slot-" . $i . "' class='form-control'><option selected='true'>None</option>";

                                                if ($row2['time_slot'] != 'Friday 4:00 pm - 9:00 pm') {
                                                    echo "<option value='Friday 4:00 pm - 9:00 pm'>Friday 4:00 pm - 9:00 pm</option>";
                                                } else {
                                                    echo "<option selected='true' value='Friday 4:00 pm - 9:00 pm'>Friday 4:00 pm - 9:00 pm</option>";
                                                }
                                                if ($row2['time_slot'] != 'Saturday 10:00 am - 3:00 pm') {
                                                    echo "<option value='Saturday 10:00 am - 3:00 pm'>Saturday 10:00 am - 3:00 pm</option>";
                                                } else {
                                                    echo "<option selected='true' value='Saturday 10:00 am - 3:00 pm'>Saturday 10:00 am - 3:00 pm</option>";
                                                }
                                                if ($row2['time_slot'] != 'Sunday 10:00 am - 3:00 pm') {
                                                    echo "<option value='Sunday 10:00 am - 3:00 pm'>Sunday 10:00 am - 3:00 pm</option>";
                                                } else {
                                                    echo "<option selected='true' value='Sunday 10:00 am - 3:00 pm'>Sunday 10:00 am - 3:00 pm</option>";
                                                }

                                                echo "</select>";
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <!--ONLINE EXAMS-->
                            <div class="row center-block">
                                <div class=" form-group col-sm-5">
                                    <label>If your examns are online, please enter dates below</label>
                                    <?php
                                    $sql = "SELECT label FROM online_exam_dates";
                                    $result = $mysqli->query($sql);
                                    $sql2 = "SELECT * FROM online_testing WHERE scheduled_id='$id'";
                                    $result2 = $mysqli->query($sql2);
                                    if ($result->num_rows > 0) {
                                        for ($i = 0; $i < 5; $i++) {
                                            $result = $mysqli->query($sql);
                                            $row2 = $result2->fetch_assoc();
                                            echo "<select name='online_proctor_date" . $i . "' class='form-control'><option selected='true'>None</option>";

                                            while ($online_exam_dates = $result->fetch_assoc()) {
                                                if ($row2['test_date'] != $online_exam_dates['label']) {
                                                    echo "<option value=" . "'" . $online_exam_dates['label'] . "'" . ">" . $online_exam_dates['label'] . "</option>";
                                                } else {
                                                    echo "<option selected='true' value=" . "'" . $online_exam_dates['label'] . "'" . ">" . $online_exam_dates['label'] . "</option>";
                                                }

                                                // echo "<option value=" . "'" . $online_exam_dates['label'] . "'" . ">" . $online_exam_dates['label'] . "</option>";
                                            }
                                            echo "</select>";
                                        }
                                    }
                                    ?>
                                </div>
                                <div class=" form-group col-sm-4">
                                    <div class="form-group">
                                        <label>Proctor Date</label>
                                        <div class="form-group">
                                            <?php
                                            $sql = "SELECT start_date,end_date FROM online_exam_dates";
                                            $result = $mysqli->query($sql);
                                            $sql2 = "SELECT * FROM online_testing WHERE scheduled_id='$id'";
                                            $result2 = $mysqli->query($sql2);
                                            if ($result->num_rows > 0) {
                                                for ($i = 0; $i < 5; $i++) {
                                                    $result = $mysqli->query($sql);
                                                    $row2 = $result2->fetch_assoc();
                                                    // echo "<select name='online_proctor_date_O" . $i . " class='form-control'><option selected='true'>None</option>";
                                                    echo "<select name='online_proctor_date_O" . $i . "' class='form-control'><option selected='true'>None</option>";
                                                    while ($online_exam_dates = $result->fetch_assoc()) {
                                                        $begin = new DateTime($online_exam_dates['start_date']);
                                                        $end = new DateTime($online_exam_dates['end_date']);
                                                        $end = $end->modify('+1 day');
                                                        $daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);
                                                        foreach ($daterange as $date) {
                                                            if ($row2['proctor_date'] != $date->format('m-d-Y')) {
                                                                echo "<option value=" . $date->format('m-d-Y') . ">" . $date->format('m-d-Y') . "</option>";
                                                            } else {
                                                                echo "<option selected='true' value=" . $date->format('m-d-Y') . ">" . $date->format('m-d-Y') . "</option>";
                                                            }
                                                        }
                                                    }
                                                    echo "</select>";
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class=" form-group col-sm-3">
                                    <div class="form-group">
                                        <label>Time Slot</label>
                                        <?php
                                        $sql = "SELECT start_date,end_date FROM paper_exam_dates";
                                        $sql2 = "SELECT * FROM online_testing WHERE scheduled_id='$id'";
                                        $result2 = $mysqli->query($sql2);
                                        $result = $mysqli->query($sql);
                                        if ($result->num_rows > 0) {
                                            for ($i = 0; $i < 5; $i++) {
                                                $result = $mysqli->query($sql);
                                                $row2 = $result2->fetch_assoc();

                                                echo "<select name='oline-time-slot-" . $i . "' class='form-control'><option selected='true'>None</option>";

                                                if ($row2['time_slot'] != 'Thursday 10:00 am - 2:00 pm') {
                                                    echo "<option value='Thursday 10:00 am - 2:00 pm'>Thursday 10:00 am - 2:00 pm</option>";
                                                } else {
                                                    echo "<option selected='true' value='Thursday 10:00 am - 2:00 pm'>Thursday 10:00 am - 2:00 pm</option>";
                                                }


                                                if ($row2['time_slot'] != 'Thursday 2:00 pm - 6:00 pm') {
                                                    echo "<option value='Thursday 2:00 pm - 6:00 pm'>Thursday 2:00 pm - 6:00 pm</option>";
                                                } else {
                                                    echo "<option selected='true' value='Thursday 2:00 pm - 6:00 pm'>Thursday 2:00 pm - 6:00 pm</option>";
                                                }


                                                if ($row2['time_slot'] != 'Thursday 4:00 pm - 9:00 pm') {
                                                    echo "<option value='Thursday 4:00 pm - 9:00 pm'>Thursday 4:00 pm - 9:00 pm</option>";
                                                } else {
                                                    echo "<option selected='true' value='Thursday 4:00 pm - 9:00 pm'>Thursday 4:00 pm - 9:00 pm</option>";
                                                }


                                                if ($row2['time_slot'] != 'Friday 10:00 am - 2:00 pm') {
                                                    echo "<option value='Friday 10:00 am - 2:00 pm'>Friday 10:00 am - 2:00 pm</option>";
                                                } else {
                                                    echo "<option selected='true' value='Friday 10:00 am - 2:00 pm'>Friday 10:00 am - 2:00 pm</option>";
                                                }


                                                if ($row2['time_slot'] != 'Friday 2:00 pm - 6:00 pm') {
                                                    echo "<option value='Friday 2:00 pm - 6:00 pm'>Friday 2:00 pm - 6:00 pm</option>";
                                                } else {
                                                    echo "<option selected='true' value='Friday 2:00 pm - 6:00 pm'>Friday 2:00 pm - 6:00 pm</option>";
                                                }


                                                if ($row2['time_slot'] != 'Friday 4:00 pm - 9:00 pm') {
                                                    echo "<option value='Friday 4:00 pm - 9:00 pm'>Friday 4:00 pm - 9:00 pm</option>";
                                                } else {
                                                    echo "<option selected='true' value='Friday 4:00 pm - 9:00 pm'>Friday 4:00 pm - 9:00 pm</option>";
                                                }



                                                if ($row2['time_slot'] != 'Sunday 10:00 am - 2:00 pm') {
                                                    echo "<option value='Sunday 10:00 am - 2:00 pm'>Sunday 10:00 am - 2:00 pm</option>";
                                                } else {
                                                    echo "<option selected='true' value='Sunday 10:00 am - 2:00 pm'>Sunday 10:00 am - 2:00 pm</option>";
                                                }
                                                echo "</select>";
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <!--TESTING INSTRUCTIONS-->
                            <div class="row center-block">
                               
                                <!--TESTING INSTRUCTIONS ROW1-->
                                <div class="row center-block">
                                    <div class="col-sm-12 form-group">
                                         <label>Testing Instructions</label>
                                        <?php $exam_instructions = $row1['exam_instructions']; ?>
                                        <textarea name='test-instructions' class="form-control" rows="8"><?php
                                        echo str_replace(',',PHP_EOL,$exam_instructions); ?></textarea>
                                    </div>
                                    
                                </div>

                                <div class="row center-block">
                                    <div class="form-group col-sm-12">
                                        <label>Special Instructions</label>
                                        <textarea name='special-instructions' class="form-control" placeholder="Put your special instructions here..."></textarea>
                                    </div>
                                </div>        
                                <div class="row center-block form-group">
                                    <!--                                    <a href="#modal-dialog" class="modal-toggle btn btn-lg btn-info" data-toggle="modal" data-href="submit.php" data-modal-type="confirm">Submit</a>-->
                                    <input type="submit" class="modal-toggle btn  btn-primary" data-href="submit.php" data-modal-type="confirm"></button>
                                    <button type="button" class="btn btn-primary">Reset</button>	
                                    <p><i class="fa fa-asterisk text-danger">(*) Required Fields</i></p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--Modal Submit Confirmation-->
                    <div id="modal-dialog" class="modal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
                                    <h3>Confirm Submission</h3>
                                </div>
                                <div class="modal-body">
                                    <p>Do you want to submit the testing information?</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="#" id="btnYes" class="btn confirm">Yes</a>
                                    <a href="#" data-dismiss="modal" aria-hidden="true" class="btn secondary">No</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form> 
            </div> <!-- /container -->
    </body>
</html>
