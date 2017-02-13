<?php

require('PHPMailer/PHPMailerAutoload.php');
$mail = new PHPMailer;
//$mail->isSMTP();
$mail->Host = 'smtp.mandrillapp.com';
$mail->SMTPAuth = true;
$mail->Username = 'maguilarce@gmail.com';
$mail->Password = 'grF3xKSBRAA7ka9OxqK34A';
$mail->SMTPSecure = 'tls';
$mail->Port = 25;
$mail->From = $email;
$mail->FromName = $full_name;
//$mail->addAddress('robert@edimaging.solutions');
$mail->addAddress('maguilar@aglozsoftware.com');
//$mail->addCC('info@edimaging.solutions');
//$mail->addAddress('rhewitt01@yahoo.com');
$mail->addCC('maguilar@aglozsoftware.com');


$mail->Subject = "LJA ENGINEERING INC - Ticket #".$num;
$mail->Body = 'Hola, soy el cuerpo del mensaje :)';
$mail->Send();

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}