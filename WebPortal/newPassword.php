<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
   session_start();
    require_once 'config.php';
    
    //Potential for comments
    if(array_key_exists('subNewPwBtn', $_POST)) { 
                $pw1 = $_POST["newPassword"];
                $pw2 = $_POST["confirmPassword"];
                if ($pw1==$pw2){
                addPw($pw1);
                }
    }
    
    function addPw($pw1){
        $account = $_SESSION['account'];
        updatePassword($account, $pw1);
        header("Location: index.php");
    }
    
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>New Password</title>
        <!--Title icon link-->
        <link rel="shortcut icon" href="favicon.ico" />
        <!--CSS links-->
        <link href="CSS/style.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/forgotPw.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/registerPage.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/registerPrivClient.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/newPasswordPage.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/jquery.toast.min.css" rel="stylesheet" type="text/css"/>
        <!--JS links-->
        <script src="Script/jquery-3.5.0.js" type="text/javascript"></script>
        <script src="Script/script.js" type="text/javascript"></script>
        <script src="Script/inputValidation.js" type="text/javascript"></script>
        <script src="Script/jquery.toast.min.js" type="text/javascript"></script>
    </head>
    <body>
        <script>
            function invalidInputToast()
            {
                $.toast({
                    heading: "Invalid Input",
                    text: "Invalid input received",
                    bgColor: "#FFB347",
                    textColor: "F3F3F3",
                    showHideTransition: "slide",
                    allowToastClose: false,
                    position: "bottom-center",
                    icon: "error",
                    loaderBg: "#373741",
                    hideAfter: 3000
                });
            }
            
            function emptyInputToast()
            {
                $.toast({
                    heading: "Empty Input",
                    text: "Some fields are empty and need to be entered",
                    bgColor: "#FF6961",
                    textColor: "F3F3F3",
                    showHideTransition: "slide",
                    allowToastClose: false,
                    position: "bottom-center",
                    icon: "error",
                    loaderBg: "#373741",
                    hideAfter: 3000
                });
            }
            
            function matchingPWToast()
            {
                $.toast({
                    heading: "Information",
                    text: "Both passwords need to match",
                    bgColor: "#03AAFB",
                    textColor: "F3F3F3",
                    showHideTransition: "slide",
                    allowToastClose: false,
                    position: "bottom-center",
                    icon: "info",
                    loaderBg: "#373741",
                    hideAfter: 3000
                });
            }
            
            function pwInfoToast()
            {
                $.toast({
                    heading: "Information",
                    text: "The password should consist of 8 characters with:\n\
                           At least one uppercase\n\n\
                           One lowercase\n\n\
                           One special character\n\n\
                           One number",
                    bgColor: "#03AAFB",
                    textColor: "F3F3F3",
                    showHideTransition: "slide",
                    allowToastClose: false,
                    position:{
                        bottom: 0,
                        left: 90
                    },
                    icon: "info",
                    loaderBg: "#373741",
                    hideAfter: 9000
                });
            }
        </script>
        
        <div class="newPasswordPage" id="newPwPg">
            <div class="header">
                CompuLink Technologies
            </div>
            
            <div class="contentFgPw">
                <div class="logo">
                    <img src="images/logo_block_cropped.png" alt="" id="compuLogo"/>
                </div>

                <form method="POST">
                    <div class="resetPwInput">
                        <img src="images/lock.png" alt="" class="resetImg" id="lock1"/>
                        <input type="text" name="newPassword" placeholder="PASSWORD" class="input" id="newPwInp" onfocus="changeNewPasswordType()">

                        <img src="images/lock.png" alt="" class="resetImg" id="lock2"/>
                        <input type="text" name="confirmPassword" placeholder="PASSWORD" class="input" id="confirmPwInp" onfocus="changeNewPasswordType()">
                    </div>

                    <div class="resetSubmit" id="reset_submit">
                        <button type="submit" onclick="verifyNewPassword()" class="subNewPwBtn" name="subNewPwBtn" value="subNewPwBtn">SUBMIT PASSWORD</button>
                    </div>
                </form>
            </div>
            
            <div class="footer">
                LinkVantage
            </div>
        </div>
    </body>
</html>
