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

$mail->SMTPOptions = array(
                        'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                        )
                    );

//This fuction sends an OTP to the specified email to be used in the password recovery page
function forgotPassword($toEmail, $fname, $recCode)
{      
    global $mail;    
    $mailer = $mail;
    $mailer->addAddress($toEmail, "Client");
    $mailer->Subject = 'Forgot Password';
    $mailer->msgHTML("<html><h3>Hi, $fname. Your password reset request has been received. </h3>"
            . "Here is your recovery code: " .$recCode. "</html>");

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

