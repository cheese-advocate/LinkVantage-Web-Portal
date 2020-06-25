<?php

use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require_once 'config.php';

$mail = new PHPMailer;
$mail->isSMTP(); 
$mail->SMTPDebug = 0; //shows debugging information. 0 shows nothing.
$mail->Host = "smtp.gmail.com"; 
$mail->Port = "587"; // typically 587 
$mail->SMTPSecure = 'tls'; 
$mail->SMTPAuth = true;
$mail->Username = "drchai101@gmail.com"; //your email address
$mail->Password = "thisischai"; //password for email acount
$mail->setFrom("linkvantage@compulink.co.za", "Compulink Technologies");
function forgotPassword($toEmail, $fname, $recCode)
{      
    global $mail;
    $accountID = getUserIDfromEmail($toEmail);
    
    $recUrl = "http://localhost:8000/recoverPassword.php?code=$recCode&id=$accountID";
    $mailer = $mail;
    $mailer->addAddress($toEmail, "Client");
    $mailer->Subject = 'Forgot Password';
    $mailer->msgHTML("<html><h3>Hi, $fname. Your password reset request has been received. </h3>"
            . "Click the following <a href='$recUrl'>link</a> to reset your password.<br>"
            . "</html>");

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

