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
$id = $_SESSION['id_user'];
$semester = "6172";

$msg = 0;

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
}
?>

<html lang="en">
    <body>
        <div class="container-fluid">
            <?php
            if ($msg != 0) {
                //modifying a registry
                if ($msg == 1) {
                    echo "<div class='alert alert-success' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                <strong>Success!</strong> You have deactivated the user
                            </div>";
                }
                //deleting a registry
                if ($msg == 2) {
                    echo "<div class='alert alert-success' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                <strong>Success!</strong> You have activated the user
                            </div>";
                }
                //adding a new registry
                if ($msg == 3) {
                    echo "<div class='alert alert-success' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                <strong>Success!</strong> You have deleted the user completely
                            </div>";
                }
                if ($msg == 4) {
                    echo "<div class='alert alert-success' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                <strong>Success!</strong> You have changed the role of the user
                            </div>";
                    
                }
            }
            ?>
            <h1 class="well">Manage Users</h1>
            <div class="row">
                <div class="col-md-12 table-responsive">
                    <div id="content">
                        <table id="mytable" class="table table-striped table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>User Type</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM user_testing_form";
                                $result1 = $mysqli->query($sql);
                                while ($row = $result1->fetch_assoc()) {
                                    $id_user = $row['id_user'];
                                    $sql2 = "SELECT FirstName,LastName FROM faculty WHERE FacNo = '$id_user'";
                                    $result2 = $mysqli->query($sql2);
                                    $row2 = $result2->fetch_assoc();

                                    echo "<tr>";
                                    echo "<td>";
                                    echo $row['id_user'];
                                    echo "</td>";
                                    echo "<td>";
                                    if ($row['id_type'] == 1) {
                                        echo "System Administrator";
                                    }
                                    if ($row['id_type'] == 2) {
                                        echo "Administrator";
                                    }
                                    if ($row['id_type'] == 3) {
                                        echo "Faculty";
                                    }
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row2['FirstName'];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row2['LastName'];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row['user_name'];
                                    echo "</td>";
                                    echo "<td>";
                                    if ($row['state'] == 'Active') {
                                        echo "<span style='color:green' class='glyphicon glyphicon-ok'></span>  Active";
                                    } else {
                                        echo "<span style='color:red' class='glyphicon glyphicon-remove'></span>  Inactive";
                                    }
                                    echo "</td>";

                                    echo "<td>";
                                    if ($_SESSION['id_type'] != '1') {
                                        if ($row['state'] == 'Active' && $row['id_type'] != '1') {
                                            echo "<a href='change_state.php?user_id=" . $row['id_user'] . "&state=Active&user_name=" . $row['user_name'] . "' title='Deactivate User'><span style='color:red' class='glyphicon glyphicon-remove-circle'></span></a>    ";
                                            echo "<a href='#' title='Change User Role' data-toggle='modal' data-target='#change_role" . $row['id_user'] . "'><span class='glyphicon glyphicon-wrench'></span></a>    ";
                                            echo "<a href='#' title='Delete User' data-toggle='modal' data-target='#myModal" . $row['id_user'] . "'><span class='glyphicon glyphicon-trash'></span></a>    ";
                                            echo "<a href='mailto:" . $row['user_name'] . "' title='Email User'><span class='glyphicon glyphicon-envelope'></span></a>";
                                        } elseif ($row['id_type'] != '1') {
                                            echo "<a href='change_state.php?user_id=" . $row['id_user'] . "&state=Inactive&user_name=" . $row['user_name'] . "' title='Activate User'><span style='color:green' class='glyphicon glyphicon-ok-circle'></span></a>   ";
                                            echo "<a href='#' title='Change User Role' data-toggle='modal' data-target='#change_role" . $row['id_user'] . "'><span class='glyphicon glyphicon-wrench'></span></a>    ";
                                            echo "<a href='#' title='Delete User' data-toggle='modal' data-target='#myModal" . $row['id_user'] . "'><span class='glyphicon glyphicon-trash'></span></a>    ";
                                            echo "<a href='mailto:" . $row['user_name'] . "' title='Email User'><span class='glyphicon glyphicon-envelope'></span></a>";
                                        } else {
                                            echo "<p style='color:gray; font-size:12px'>Special permission required to modify this user</p>";
                                        }
                                    } else {
                                        if ($row['state'] == 'Active') {
                                            echo "<a href='change_state.php?user_id=" . $row['id_user'] . "&state=Active&user_name=" . $row['user_name'] . "' title='Deactivate User'><span style='color:red' class='glyphicon glyphicon-remove-circle'></span></a>    ";
                                            echo "<a href='#' title='Change User Role' data-toggle='modal' data-target='#change_role" . $row['id_user'] . "'><span class='glyphicon glyphicon-wrench'></span></a>    ";
                                            echo "<a href='#' title='Delete User' data-toggle='modal' data-target='#myModal" . $row['id_user'] . "'><span class='glyphicon glyphicon-trash'></span></a>    ";
                                            echo "<a href='mailto:" . $row['user_name'] . "' title='Email User'><span class='glyphicon glyphicon-envelope'></span></a>";
                                        } else {
                                            echo "<a href='change_state.php?user_id=" . $row['id_user'] . "&state=Inactive&user_name=" . $row['user_name'] . "' title='Activate User'><span style='color:green' class='glyphicon glyphicon-ok-circle'></span></a>   ";
                                            echo "<a href='#' title='Change User Role' data-toggle='modal' data-target='#change_role" . $row['id_user'] . "'><span class='glyphicon glyphicon-wrench'></span></a>    ";
                                            echo "<a href='#' title='Delete User' data-toggle='modal' data-target='#myModal" . $row['id_user'] . "'><span class='glyphicon glyphicon-trash'></span></a>    ";
                                            echo "<a href='mailto:" . $row['user_name'] . "' title='Email User'><span class='glyphicon glyphicon-envelope'></span></a>";
                                        }
                                    }
                                    echo "</td>";
                                    echo "</tr>";
                                    ?>
                                    <!--                                DELETE USER MODAL-->
                                <div class="modal fade" id="myModal<?php echo $row['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h3 class="modal-title" id="myModalLabel">Warning!</h3>
                                            </div>
                                            <div class="modal-body">
                                                <h4>Are you sure you want to DELETE THIS USER?</h4>
                                            </div>
                                            <!--/modal-body-collapse -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" onclick="deleter(<?php echo $row['id_user']; ?>)">Yes</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                            </div>
                                            <!--/modal-footer-collapse -->
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!--                                        CHANGE USER ROLE MODAL-->
                                <div class="modal fade" id="change_role<?php echo $row['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h3 class="modal-title" id="myModalLabel">Change User Role</h3>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-horizontal" role="form" action="change_user_role.php" method="POST">
                                                    <h5 class="modal-title" id="myModalLabel"><?php echo "Change user rol for: <br/>" . $row['user_name']; ?></h5>
                                                    <div class="form-group">
                                                        <input type="hidden" name="id" value="<?php echo $row['id_user']; ?>">
                                                        <input type="hidden" name="user_name" value="<?php echo $row['user_name']; ?>">
                                                        <select name="role" class="form-control">
                                                            <?php
                                                            if ($row['id_type'] == 1) {
                                                                echo "<option selected = 'true' value = '1'>System Administrator</option>";
                                                                echo "<option value = '2'>Administrator</option>";
                                                                echo "<option value = '3'>Faculty</option>";
                                                            }
                                                            if ($row['id_type'] == 2) {
                                                                //echo "<option  value = '1'>System Administrator</option>";
                                                                echo "<option selected = 'true' value = '2'>Administrator</option>";
                                                                echo "<option value = '3'>Faculty</option>";
                                                            }
                                                            if ($row['id_type'] == 3) {
                                                                //echo "<option  value = '1'>System Administrator</option>";
                                                                echo "<option value = '2'>Administrator</option>";
                                                                echo "<option selected = 'true' value = '3'>Faculty</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                            </div>
                                            <!--/modal-body-collapse -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Change</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            </div>
                                            </form>
                                            <!--/modal-footer-collapse -->
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
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
                                        url: 'delete_user.php',
                                        data: {

                                            id: id
                                        },
                                        success: function (data)
                                        {
                                            window.location.href = 'manage_users.php?msg=3';
                                        }
                                    });
                        }
                    </script>
                    <script>
                        $(document).ready(function () {
                            $('#mytable').DataTable(
                                    {
                                        "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]]
                                    }
                            );
                        });
                    </script>
                    <script>
                        $(document).ready(function () {
                            $('[data-toggle="tooltip"]').tooltip();
                        });
                    </script>
                     <script>
                    $(document).ready(function () {
                        window.setTimeout(function () {
                            $(".alert").fadeTo(500, 0).slideUp(500, function () {
                                $(this).remove();
                            });
                        }, 4000);
                    });
                </script>


                </div>
            </div>
        </div>


    </body>


</html>