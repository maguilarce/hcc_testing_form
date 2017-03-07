<?php
include('dconnection.php');
session_start();
include('log_process.php');
//print_r($_SESSION);
include('head.php');
if($_SESSION['id_type']=='1' || $_SESSION['id_type']=='2')
{
   include('navbar.php'); 
}
else
{
    include('navbar_faculty.php'); 
}
include('bootstrap.php');
include('footer.php');
$user = $_SESSION['user_name'];
?>
<!DOCTYPE html>
<html lang="en">


    <body>

        <div class="container">
            <!-- Main component for a primary marketing message or call to action -->
            <section class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <h3>HCC Online Support </h3>
                            <hr>
                            <address>
                                <strong>Address:</strong> 3100 Main St, 3rd. Floor, Houston, TX 77002<br>
                                <strong>Phone:</strong> +1-713-718-5275 / Option 1
                            </address>

                        </div>

                        <div class="col-sm-8 contact-form">
                            <form id="contact" method="post" class="form" role="form" action="contact_email.php">
                                <div class="row">
                                    <div class="col-xs-6 col-md-6 form-group">
                                        <input class="form-control" id="name" name="name" placeholder="Name" type="text" required autofocus />
                                    </div>
                                    <div class="col-xs-6 col-md-6 form-group">
                                        <input class="form-control" id="email" name="email" placeholder="Email" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" title="Invalid email format" required />
                                    </div>

                                </div>
                                <textarea class="form-control" id="message" name="message" placeholder="Message" rows="5"></textarea>
                                <br />
                                <div class="row">
                                    <div class=" col-md-2 form-group">
                                        <label for="human" class="control-label">2 + 3 = ?</label>
                                    </div>
                                    <div class=" col-md-10 form-group">
                                        <input type="text" class="form-control" id="human" name="human" placeholder="Your Answer" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-12 form-group">
                                        <button name="submit" class="btn btn-primary pull-right" type="submit">Submit</button>
                                        </form>
                                    </div>
                                </div>
                                </section>
                        </div>

                    </div> <!-- /container -->


                    </body>
                    </html>
