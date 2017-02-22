<?php
date_default_timezone_set('America/Chicago');
include('dconnection.php');
session_start();
include('head.php');
if ($_SESSION['id_type'] == '1' || $_SESSION['id_type'] == '2') {
    include('navbar.php');
} else {
    include('navbar_faculty.php');
}
include('bootstrap.php');
include('footer.php');

$user_id = $_SESSION['id_user'];
$user_name = $_SESSION['user_name'];

$user_data = "SELECT * FROM faculty WHERE FacNo = '$user_id'";
$result_user_data = $mysqli->query($user_data);
$user_row = $result_user_data->fetch_assoc();
$semester = "6172";
?>
<!DOCTYPE html>
<html lang="en">
    <body>
        <div class="container">
            <h1 class="well">HCC Online Testing Information Form</h1>
            <div class="col-lg-12 well">
                <form role="form" id="form" method="post" action="submit.php" onsubmit="return confirm('Submit this form?')">
                    <div class="row center-block">
                        <div class="col-sm-12">
                            <div class="row center-block">
                                <div class="col-sm-6 form-group">
                                    <label>First Name</label><i class="text-danger">*</i>
                                    <input name='FirstName' type="text" class="form-control" value = "<?php echo $user_row['FirstName']; ?>" readonly>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Last Name</label><i class="fa fa-asterisk text-danger">*</i>
                                    <input name='LastName' type="text" class="form-control" value = "<?php echo $user_row['LastName']; ?>" readonly>
                                </div>
                            </div>
                            <div class="row center-block">
                                <div class="col-sm-6 form-group">
                                    <label>Email Address</label><i class="fa fa-asterisk text-danger">*</i>
                                    <input pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" title="Invalid email format" name='EmailAddress' type="text" class="form-control" value = "<?php echo $user_name; ?>" readonly>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Home Campus</label><i class="fa fa-asterisk text-danger">*</i>
                                    <select name='HomeCampus' class="form-control" required>
                                        <option selected="true" value="">[select an item]</option>
                                        <option value='Alief'>Alief</option>
                                        <option value='Central'>Central</option>
                                        <option value='East side'>East side</option>
                                        <option value='Northline'>Northline</option>
                                        <option value='Katy'>Katy</option>
                                        <option value='Spring Branch'>Spring Branch</option>
                                        <option value='Stafford'>Stafford</option>
                                        <option value='West Loop'>West Loop</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row center-block">
                                <div class="col-sm-3 form-group">
                                    <label>HCC Phone</label>
                                    <input name='HCCPhone' type="text" placeholder="Enter HCC Phone Number Here.." class="form-control">
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>Other Phone</label>
                                    <input name='OtherPhone' type="text" placeholder="Enter Other Phone Number Here.." class="form-control">
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>Type of Phone</label><i class="fa fa-asterisk text-danger">*</i>
                                    <select name="type_of_phone" class="form-control" required>
                                        <option selected="true" value="">[select an item]</option>
                                        <option value="Home">Home</option>
                                        <option value="Cell">Cell</option>
                                        <option value="Work">Work</option>
                                    </select>
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>Give to students?</label><i class="fa fa-asterisk text-danger">*</i>
                                    <select name="give_to_students" class="form-control" required>
                                        <option selected="true" value="">[select an item]</option>
                                        <option value="Do not">Do not</option>
                                        <option value="Ok">Ok</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row center-block">
                                <div class="col-sm-4 form-group">
                                    <label>Course</label><i class="fa fa-asterisk text-danger">*</i>
                                    <select name="offered_courses" class="form-control" required>
                                        <option selected="true" value="">[select an item]</option>
                                        <?php
                                        $sql = "SELECT * FROM offered_courses WHERE Term = '$semester'";
                                        $result = $mysqli->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($offered_courses = $result->fetch_assoc()) {
                                                echo "<option value='" . $offered_courses['descr'] . "'>" . $offered_courses['subject'] . " - " . $offered_courses['catalog'] . " - " . $offered_courses['descr'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label>Term</label><i class="fa fa-asterisk text-danger">*</i>
                                    <select name="term" class="form-control" required>
                                        <option selected="true" value="">[select an item]</option>
                                        <?php
                                        $sql = "SELECT * FROM sessions WHERE Term = '$semester'";
                                        $result = $mysqli->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($sessions = $result->fetch_assoc()) {
                                                echo "<option value='" . $sessions['Session'] . "'>" . $sessions['Session'] . "</option>";
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>
                                <div class="col-sm-4 form-group" id="crnAjax" style="display:none">
                                    <label>CRN</label><i class="fa fa-asterisk text-danger">*</i>
                                    <select name="crn" class="form-control" required >
                                        <option value="">Please Select</option>
                                    </select>
                                </div>


                            </div>
                            <div class="row center-block">
                                <div class="col-sm-6 form-group">
                                    <label>Will your exams be online?</label><i class="fa fa-asterisk text-danger">*</i>
                                    <select id="test-online" name="test-online" class="form-control" required>
                                        <option value='Yes'>Yes</option>
                                        <option value='No' >No</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>If yes, please provide a password</label>
                                    <input id="online-option" name='password' type="text" placeholder="Enter Password Here.." class="form-control">
                                </div>
                            </div>
                            <div class="row center-block">
                                <div class="col-sm-5 form-group">
                                    <label>Will you be using HCC Online Testing Centers?</label><i class="fa fa-asterisk text-danger">*</i>
                                    <select name='testingCenter' class="form-control" required>
                                        <option value='Yes'>Yes</option>
                                        <option value='No' selected="true">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-5 form-group">
                                    <label>Do you want your on-site exams delivered to a campus?</label><i class="fa fa-asterisk text-danger">*</i>
                                    <select name='onsiteTest' class="form-control" required>
                                        <option value='Yes'>Yes</option>
                                        <option value='No' selected="true">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 form-group">
                                    <label>Campus Location</label>
                                    <select name='campusLocation' class="form-control">
                                        <option value='Alief'>Alief</option>
                                        <option value='Central'>Central</option>
                                        <option value='East side'>East side</option>
                                        <option value='Northline'>Northline</option>
                                        <option value='Katy'>Katy</option>
                                        <option value='Spring Branch'>Spring Branch</option>
                                        <option value='Stafford'>Stafford</option>
                                        <option value='West Loop'>West Loop</option>
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
                                    if ($result->num_rows > 0) {
                                        for ($i = 0; $i < 5; $i++) {
                                            $result = $mysqli->query($sql);
                                            echo "<select name='paper_proctor_date" . $i . "' class='form-control'><option selected='true'>None</option>";

                                            while ($paper_exam_dates = $result->fetch_assoc()) {


                                                echo "<option value=" . "'" . $paper_exam_dates['label'] . "'" . ">" . $paper_exam_dates['label'] . "</option>";
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
                                            if ($result->num_rows > 0) {
                                                for ($i = 0; $i < 5; $i++) {
                                                    $result = $mysqli->query($sql);
                                                    echo "<select name='paper_proctor_date_P" . $i . "' class='form-control'><option selected='true'>None</option>";

                                                    while ($paper_exam_dates = $result->fetch_assoc()) {
                                                        $begin = new DateTime($paper_exam_dates['start_date']);
                                                        $end = new DateTime($paper_exam_dates['end_date']);
                                                        $end = $end->modify('+1 day');
                                                        $daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);
                                                        foreach ($daterange as $date) {
                                                            echo "<option value=" . $date->format('m-d-Y') . ">" . $date->format('m-d-Y') . "</option>";
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
                                        if ($result->num_rows > 0) {
                                            for ($i = 0; $i < 5; $i++) {
                                                $result = $mysqli->query($sql);
                                                echo "<select name='paper-time-slot-" . $i . "' class='form-control'><option selected='true'>None</option>";
                                                echo "<option value='Friday 4:00 pm - 9:00 pm'>Friday 4:00 pm - 9:00 pm</option>";
                                                echo "<option value='Saturday 10:00 am - 3:00 pm'>Saturday 10:00 am - 3:00 pm</option>";
                                                echo "<option value='Sunday 10:00 am - 3:00 pm'>Sunday 10:00 am - 3:00 pm</option>";


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
                                    if ($result->num_rows > 0) {
                                        for ($i = 0; $i < 5; $i++) {
                                            $result = $mysqli->query($sql);
                                            echo "<input value='' type='hidden' name='online_proctor_date" . $i . "'>";
                                            echo "<select name='online_proctor_date" . $i . "' class='form-control'><option selected='true'>None</option>";

                                            while ($online_exam_dates = $result->fetch_assoc()) {


                                                echo "<option value=" . "'" . $online_exam_dates['label'] . "'" . ">" . $online_exam_dates['label'] . "</option>";
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
                                            if ($result->num_rows > 0) {
                                                for ($i = 0; $i < 5; $i++) {
                                                    $result = $mysqli->query($sql);
                                                    // echo "<select name='online_proctor_date_O" . $i . " class='form-control'><option selected='true'>None</option>";
                                                    echo "<input type='hidden' name='online_proctor_date_O" . $i . "'>";
                                                    echo "<select name='online_proctor_date_O" . $i . "' class='form-control'><option selected='true'>None</option>";

                                                    while ($online_exam_dates = $result->fetch_assoc()) {
                                                        $begin = new DateTime($online_exam_dates['start_date']);
                                                        $end = new DateTime($online_exam_dates['end_date']);
                                                        $end = $end->modify('+1 day');
                                                        $daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);
                                                        foreach ($daterange as $date) {
                                                            echo "<option value=" . "'" . $date->format('m-d-Y') . "'" . ">" . $date->format('m-d-Y') . "</option>";
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
                                        if ($result->num_rows > 0) {
                                            for ($i = 0; $i < 5; $i++) {
                                                $result = $mysqli->query($sql);
                                                echo "<input type='hidden' name='online-time-slot-" . $i . "'>";
                                                echo "<select name='online-time-slot-" . $i . "' class='form-control'><option selected='true'>None</option>";
                                                echo "<option value='Thursday 10:00 am - 2:00 pm'>Thursday 10:00 am - 2:00 pm</option>";
                                                echo "<option value='Thursday 2:00 pm - 6:00 pm'>Thursday 2:00 pm - 6:00 pm</option>";
                                                echo "<option value='Thursday 4:00 pm - 9:00 pm'>Thursday 4:00 pm - 9:00 pm</option>";
                                                echo "<option value='Friday 10:00 am - 2:00 pm'>Friday 10:00 am - 2:00 pm</option>";
                                                echo "<option value='Friday 2:00 pm - 6:00 pm'>Friday 2:00 pm - 6:00 pm</option>";
                                                echo "<option value='Friday 4:00 pm - 9:00 pm'>Friday 4:00 pm - 9:00 pm</option>";
                                                echo "<option value='Sunday 10:00 am - 2:00 pm'>Sunday 10:00 am - 3:00 pm</option>";
                                                echo "</select>";
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <!--TESTING INSTRUCTIONS-->
                            <div class="row center-block">
                                <label>Testing Instructions</label>
                                <!--TESTING INSTRUCTIONS ROW1-->
                                <div class="row center-block">
                                    <div class="col-sm-4 form-group">

                                        <label>Open/Closed Book</label><i class="fa fa-asterisk text-danger">*</i>
                                        <select name='open-closed-book' class="form-control" required>
                                            <option value='Open Book'>Open Book</option>
                                            <option value='Close Book'>Close Book</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label>Scantron/Write On</label><i class="fa fa-asterisk text-danger">*</i>
                                        <select name='scantron-writeon' class="form-control" required>
                                            <option value='Scantron Only'>Scantron Only</option>
                                            <option value='Write On Only'>Write On Only</option>
                                            <option value='Scantron and Write On'>Scantron and Write On</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label>Time Limit</label><i class="fa fa-asterisk text-danger">*</i>
                                        <select name='time-limit' class="form-control" required>
                                            <option value='Two hour limit'>Two hour limit</option>
                                        </select>
                                    </div>
                                </div>
                                <!--TESTING INSTRUCTIONS ROW2-->
                                <div class="row center-block">
                                    <div class="col-sm-6 form-group">
                                        <label>Testing Software</label><i class="fa fa-asterisk text-danger">*</i>
                                        <select name='testing-software' class="form-control" required>
                                            <option value='None'>None</option>
                                            <option value='Canvas'>Canvas</option>
                                            <option value='My Math Lab'>My Math Lab</option>
                                            <option value='Web Assign'>Web Assign</option>
                                            <option value='Connect Math'>Connect Math</option>
                                            <option value='My ITLAB'>My ITLAB</option>
                                            <option value='Other'>Other</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>If other Testing Software, please specify: </label>
                                        <input name='other-testing-software' type="text" placeholder="Enter Software Name Here.." class="form-control">
                                    </div>
                                </div>
                                <!--TESTING INSTRUCTIONS ROW3-->
                                <div class="row center-block">
                                    <div class="col-sm-4 form-group">
                                        <label>Calculators</label><i class="fa fa-asterisk text-danger">*</i>
                                        <select name='calculators' class="form-control" required>
                                            <option value='Allowed'>Allowed</option>
                                            <option value='Not Applicable'>Not Applicable</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label>Type of Calculator</label><i class="fa fa-asterisk text-danger">*</i>
                                        <select name='type-calculator' class="form-control" required>
                                            <option value='Graphic'>Graphic</option>
                                            <option value='Non-graphing'>Non-graphing</option>
                                            <option value='Scientific'>Scientific</option>
                                            <option value='Four Function'>Four Function</option>
                                            <option value='Not Applicable'>Not Applicable</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label>Material allowed during testing</label><i class="fa fa-asterisk text-danger">*</i>
                                        <select name='material-allowed' class="form-control" required>
                                            <option value='No Electronic Device Allowed'>No Electronic Device Allowed</option>
                                            <option value='Note Cards - 3x5, 5x7'>Note Cards - 3x5, 5x7</option>
                                            <option value='Handwritten Notes - 1 pg front/back, Letter Size'>Handwritten Notes - 1 pg front/back, Letter Size</option>
                                            <option value='No resources allowed'>No resources allowed</option>
                                            <option value='Not Applicable'>Not Applicable</option>
                                        </select>
                                    </div>
                                </div>
                                <!--TESTING INSTRUCTIONS ROW4-->
                                <div class="row center-block">
                                    <div class="form-group col-sm-12">
                                        <label>Special Instructions</label>
                                        <textarea name='special-instructions' class="form-control" placeholder="Put your special instructions here..."></textarea>
                                    </div>
                                </div>  



                                <!--CONFIRM SUBMISSION-->
                                <div class="row center-block form-group">
                                    <input id="submit" type="submit"  class="btn btn-primary">
                                    <button type="reset" class="btn btn-primary">Reset</button>	
                                    <p><i class="fa fa-asterisk text-danger">(*) Required Fields</i></p>
                                </div>


                            </div>
                        </div>
                    </div>



                </form> 


            </div> <!-- /container -->
    </body>
</html>
