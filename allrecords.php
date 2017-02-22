<?php
date_default_timezone_set('America/Chicago');
include('dconnection.php');
session_start();
//print_r($_SESSION);
include('head.php');
if ($_SESSION['id_type'] == '1' || $_SESSION['id_type'] == '2') {
    include('navbar.php');
} else {
    include('navbar_faculty.php');
}
include('bootstrap.php');
include('footer.php');
//require_once('delete_confirm.php');

$user = $_SESSION['user_name'];
$semester = "6172";
?>
<html lang="en">
    <body>
        <div class="container-fluid">
            <h1 class="well">All Test Records</h1>
            <div class="row">
                <div class="col-md-12">
                    <form action="#" method="get">
                        <div class="input-group">
                            <!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH -->
                            <input class="form-control" id="system-search" name="q" placeholder="Search for" required> 
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                            </span>
                        </div>
                    </form>
                </div>

                <div class="col-md-12 table-responsive">
                    <div id="content">
                        <table id="mytable" style='font-size:11px' class="table table-list-search table-striped table-bordered">
                            <thead>
                                <tr>

                                    <th style="width:5%;font-size:13px">Action</th>
                                    <th style="width:5%;font-size:13px">Date Submitted</th>
                                    <th style="width:5%;font-size:13px">F.Name</th>
                                    <th style="width:5%;font-size:13px">L.Name</th>
                                    <th style="width:3%;font-size:13px">HCC Phone</th>
                                    <th style="width:3%;font-size:13px">Other phone</th>
                                    <th style="width:1%;font-size:13px">Delivery</th>
                                    <th style="width:3%;font-size:13px">Campus</th>
                                    <th style="width:10%;font-size:13px">Course</th>
                                    <th style="width:3%;font-size:13px">CRN</th>
                                    <th style="width:1%;font-size:13px">Term</th>
                                    <th style="width:9%;font-size:13px">Paper Pencil Test Weekend</th>
                                    <th style="width:5%;font-size:13px">PP Proctor Date</th>
                                    <th style="width:6%;font-size:13px">PP Time Slot</th>
                                    <th style="width:9%;font-size:13px">Online Test Weekend</th>
                                    <th style="width:4%;font-size:13px">OL Proctor Date</th>
                                    <th style="width:6%;font-size:13px">OL Time Slot</th>
                                    <th style="width:12%;font-size:13px">Exam Instructions</th>
                                    <th style="width:10%;font-size:13px">Special Instructions</th>


                            </thead>
                            <tbody>
                                <?php
                                if ($_SESSION['id_type'] != '1' && $_SESSION['id_type'] != '2') {
                                    $sql = "SELECT * FROM scheduled_test where email = '$user' AND state = 'Active' AND semester = '$semester'";
                                } else {
                                    $sql = "SELECT * FROM scheduled_test WHERE state = 'Active' AND semester = '$semester'";
                                }
                                $result = $mysqli->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {

                                        $id = $row['id'];
                                        $sqlpp = "SELECT * FROM paper_testing WHERE scheduled_id = '$id' AND state = 'Active'";
                                        $sqlol = "SELECT * FROM online_testing WHERE scheduled_id = '$id' AND state = 'Active'";

                                        $ppresult = $mysqli->query($sqlpp);
                                        $olresult = $mysqli->query($sqlol);

                                        $pptw = "";
                                        $pppdate = "";
                                        $pptimeslot = "";
                                        $oltw = "";
                                        $olpdate = "";
                                        $oltimeslot = "";


                                        while ($pprow = $ppresult->fetch_assoc()) {
                                            $pptw .= $pprow['test_date'] . "<br/>";
                                            $pppdate .= $pprow['proctor_date'] . "<br/>";
                                            $pptimeslot .= $pprow['time_slot'] . "<br/>";
                                        }
                                        while ($olrow = $olresult->fetch_assoc()) {
                                            $oltw .= $olrow['test_date'] . "<br/>";
                                            $olpdate .= $olrow['proctor_date'] . "<br/>";
                                            $oltimeslot .= $olrow['time_slot'] . "<br/>";
                                        }

                                        //changing records format depending on user

                                        $edit_link1 = "<td id='row_val" . $row['id'] . "'>";
                                        $edit_link1 .= "<form action='edit.php' method='POST'>";
                                        $edit_link1 .= "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                                        $edit_link1 .= "<button data-target='confirm' type='submit' class='btn btn-primary btn-xs'>Edit</button>";
                                        $edit_link1 .= "</form>";

                                        //delete button
                                        $delete_link1 = "<br/>";
                                        //$delete_link1 .= "<button class='btn btnDelete' href=''>delete</button>";
                                        $delete_link1 .= "<button type='button' class='btn btn-danger btn-xs' data-toggle='modal' data-target='#myModal" . $row['id'] . "'>Delete</button>";

                                        $delete_link1 .= "</td>";

                                        //
                                        echo "<tr>"
                                        . $edit_link1 . $delete_link1 .
                                        "<td id='date_submitted_val" . $row['id'] . "'>" . $row['date_submitted'] . "</td>
                                    <td id='fname_val" . $row['id'] . "'>" . $row['fname'] . "</td>
                                    <td id='lname_val" . $row['id'] . "'>" . $row['lname'] . "</td>
                                    <td id='HCC_phone_val" . $row['id'] . "'>" . $row['HCC_phone'] . "</td>
                                    <td id='other_phone_val" . $row['id'] . "'>" . $row['other_phone'] . "</td>
                                    <td id='delivered_campus_val" . $row['id'] . "'>" . $row['delivered_campus'] . "</td>
                                    <td id='home_campus_val" . $row['id'] . "'>" . $row['home_campus'] . "</td>
                                    <td id='course_val" . $row['id'] . "' style='font-size:13px'>" . $row['course'] . "</td>
                                    <td id='crn_val" . $row['id'] . "'>" . $row['crn'] . "</td>
                                    <td id='term_val" . $row['id'] . "'>" . $row['term'] . "</td>                                  
                                    <td id='pptw_val" . $row['id'] . "'>";
                                        echo $pptw;
                                        echo "</td> 
                                    <td id='pppd_val" . $row['id'] . "'>";
                                        echo $pppdate;
                                        echo "</td>
                                    <td id='ppts_val" . $row['id'] . "'>";
                                        echo $pptimeslot;
                                        echo "</td>
                                    <td id='oltw_val" . $row['id'] . "'>";
                                        echo $oltw;
                                        echo "</td>
                                    <td id='olpd_val" . $row['id'] . "'>";
                                        echo $olpdate;
                                        echo "</td>
                                    <td id='olts_val" . $row['id'] . "'>";
                                        echo $oltimeslot;
                                        echo "</td>
                                    <td id='exam_instructions_val" . $row['id'] . "' style='font-size:9px'>" . str_replace(',', PHP_EOL, $row['exam_instructions']) . "</td>
                                    <td id='special_instructions_val" . $row['id'] . "'>" . $row['special_instructions'] . "</td></tr>";
                                        ?> 
                                    <div class="modal fade" id="myModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h3 class="modal-title" id="myModalLabel">Warning!</h3>

                                                </div>
                                                <div class="modal-body">
                                                    <h4>Are you sure you want to DELETE?</h4>

                                                </div>
                                                <!--/modal-body-collapse -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" onclick="deleter(<?php echo $row['id']; ?>)">Yes</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                </div>
                                                <!--/modal-footer-collapse -->
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>    
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="alert alert-danger" role="alert">
                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                    <span class="sr-only">Error:</span>
                                    No records for <?php echo $_SESSION['user_name']; ?>
                                </div>
                                <?php
                            }
                            ?>

                            </tbody>
                        </table> 
                    </div>

                    <script>
                        function deleter(id)
                        {
                            $.ajax
                                    ({
                                        type: 'post',
                                        url: 'delete.php',
                                        data: {

                                            id: id
                                        },
                                        success: function (data)
                                        {
                                            window.location.href = 'allrecords.php';
                                        }
                                    });
                        }
                    </script>


                </div>
            </div>
        </div>


    </body>


</html>