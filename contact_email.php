<?php
require('PHPMailer/PHPMailerAutoload.php');
include('head.php');
include('navbar.php');
include('bootstrap.php');
include('footer.php');
include('dconnection.php');
if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $human = intval($_POST['human']);
    //$from = 'Demo Contact Form';
    //$to = 'example@bootstrapbay.com';
    //$subject = 'Message from Contact Demo ';

    $body = "From: $name\n E-Mail: $email\n Message:\n $message";

    /*// Check if name has been entered
    if (!$_POST['name']) {
        $errName = 'Please enter your name';
    }

    // Check if email has been entered and is valid
    if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errEmail = 'Please enter a valid email address';
    }

    //Check if message has been entered
    if (!$_POST['message']) {
        $errMessage = 'Please enter your message';
    }
    //Check if simple anti-bot test is correct
    if ($human !== 5) {
        $errHuman = 'Your anti-spam is incorrect';
    }*/

// If there are no errors, send the email
   // if (!$errName && !$errEmail && !$errMessage && !$errHuman) {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->Username = "lisbeth.cedeno.m@gmail.com";
        $mail->Password = "efigeni2608";
        $mail->AddAddress("manuel.aguilar2@hccs.edu");
        $mail->From = $email;
        $mail->FromName = $name;
        $mail->Subject = "Contact Form - HCC Online Testing Form";
        $mail->Body = $body;
        if (!$mail->Send()) {
            $result = "<div class='alert alert-danger'>Sorry there was an error sending your message. Please try again later</div>"
                    ."<div class='row center-block form-group'>"
                    ."<button type='button' class='btn btn-primary'>Back</button></div>";
            echo $result . $mail->ErrorInfo;
        } else {
                       $result = "<div class='alert alert-success'>Thank You! I will be in touch</div>"
                    ."<div class='row center-block form-group'>"
                    ."<button formaction='contact.php' type='button' class='btn btn-primary'>Back</button></div>";
            echo $result;
        }
    }




    /* $result = '<div class="alert alert-success">Thank You! I will be in touch</div>';

      $result = '<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later</div>'; */


