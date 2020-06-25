<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<!--
This page is navigated to from the password recovery link, where this page 
processes the verification of the link and the account. Upon successful 
verification, the user will be redirected to enter a new password.

The link needs to include a correct hashed recovery code, and the code needs to 
not be too old.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
            require_once 'config.php';
            //Get OTP and accountID from URL
            $code = $_GET['code'];
            $ID = $_GET['id'];
            
           
            //Retrieve OTP from database
            $vaildateCode = findOTP($ID);
            
            //Check if OTP from database matches OTP from URL
            if ($validateCode == $code)
            {
                echo"Password Reset";
            }
            else
            {
                echo"Error: OTP Mismatch!";
            }
            
        ?>
    </body>
</html>
