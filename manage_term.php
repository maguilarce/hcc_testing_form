<?php
date_default_timezone_set('America/Chicago');
include('dconnection.php');
include('log_process.php');
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

$sql = "SELECT * FROM terms WHERE 1";
$result = $mysqli->query($sql);

$sql2 = "SELECT semester FROM current_semester WHERE 1";
$result2 = $mysqli->query($sql2);
$row2 = $result2->fetch_assoc();

$msg = 0;

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
}
?>

<!DOCTYPE html>
<html lang="en">
    <body>
        <div class="container">
            <?php
            if ($msg != 0) {
                if ($msg == 1) {
                    echo "<div class='alert alert-success' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                <strong>Success!</strong> You have changed the semester
                            </div>";
                }
                if ($msg == 2) {
                    
                }
                if ($msg == 3) {
                    
                }
                if ($msg == 4) {
                    
                }
            }
            ?>
            <h1 class="well">Manage Term Info</h1>
            <div class="col-lg-12 well">
                <form action="process_term.php" method="post">
                    <div class="row center-block">
                        <label>The current semester is: <p style="color:red"><?php echo $row2['semester']; ?></p></label><br>
                        <label>Select the term you want to apply for new forms</label>
                        <select name='semester' class="form-control" required>
                            <?php
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value = '" . $row['Term'] . "'>" . $row['Term'] . " - " . $row['Label'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <br>

                    <div class="row center-block form-group">
                        <input id="submit" type="submit" value="Apply"  class="btn btn-primary">

                    </div>
                </form>
            </div>
        </div> <!-- /container -->
        <script>
            $(document).ready(function () {
                window.setTimeout(function () {
                    $(".alert").fadeTo(500, 0).slideUp(500, function () {
                        $(this).remove();
                    });
                }, 4000);
            });
        </script>
    </body>
</html>