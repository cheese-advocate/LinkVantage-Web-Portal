<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

$recEmail = "customer@gmail.com";

$mail = new PHPMailer;
$mail->isSMTP(); 
$mail->SMTPDebug = 0; //shows debugging information. 0 shows nothing.
$mail->Host = "smtp.gmail.com"; 
$mail->Port = "587"; // typically 587 
$mail->SMTPSecure = 'tls'; 
$mail->SMTPAuth = true;
$mail->Username = "drchai101@gmail.com"; //your email address
$mail->Password = "thisischai"; //password for email acocunt
$mail->setFrom("drchai101@gmail.com", "Dr Chai");
$mail->addAddress($recEmail, "Chai Consortium");
$mail->Subject = 'CHAI';
$mail->msgHTML("CHAI");

$mail->send();

