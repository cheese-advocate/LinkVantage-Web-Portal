<?php

$to = "bernard01geldenhuys@gmail.com";
$subject = "chai";
$message = "<h1>CHAI</h1>";

$headers = "From: Mr Chai <drchai101>\r\n";
$headers .= "Reply-to: drchai101\r\n";
$headers .= "Content-type: text/html\r\n";

mail($to, $subject, $message, $headers);
