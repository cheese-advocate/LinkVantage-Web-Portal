<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

<<<<<<< HEAD
$recEmail = "albertynkuyper@gmail.com";

=======
>>>>>>> 64f5bce385ebf7a6e6e7aa1974febb307774a413
$mail = new PHPMailer;
$mail->isSMTP(); 
$mail->SMTPDebug = 0; //shows debugging information. 0 shows nothing.
$mail->Host = "smtp.gmail.com"; 
$mail->Port = "587"; // typically 587 
$mail->SMTPSecure = 'tls'; 
$mail->SMTPAuth = true;
$mail->Username = "drchai101@gmail.com"; //your email address
$mail->Password = "thisischai"; //password for email acocunt
$mail->setFrom("linkvantage@compulink.co.za", "Compulink Technologies");

forgotPassword("frikkieuys2@gmail.com", "Frikkie", "www.whatismyip.com");
function forgotPassword($toEmail, $fname, $link)
{      
    global $mail;
    $mailer = $mail;
    $mailer->addAddress($toEmail, "Client");
    $mailer->Subject = 'Forgot Password';
    $mailer->msgHTML("<html><h3>Hi, $fname. Your password reset request has been received.</h3>"
            . "Click the following link to reset your password.<br>"
            . "$link </html>");

    if(!$mail->send()) 
    {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } 
    else 
    {
        echo "Message has been sent successfully";
    }
}

function updateMsg($toEmail, $msg)
{
    $mail->addAddress($toEmail, "Chai Consortium");
    $mail->Subject = 'Update on progress';
    $mail->msgHTML("");
    
    if(!$mail->send()) 
    {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } 
    else 
    {
        echo "Message has been sent successfully";
    }
}

function reminder($toEmail, $msg)
{
    $mail->addAddress($toEmail, "Chai Consortium");
    $mail->Subject = 'Kind reminder';
    $mail->msgHTML("");
    
    if(!$mail->send()) 
    {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } 
    else 
    {
        echo "Message has been sent successfully";
    }
}

