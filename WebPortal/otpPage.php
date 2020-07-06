<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    session_start();
    global $tries;
    $tries=0;
    require_once 'config.php';
    //Potential for comments
    if(array_key_exists('subOTPBtn', $_POST)) { 
                $inOTP = $_POST["inOTP"];
                validateOTP($inOTP);
    }
    
    function validateOTP($inOTP){
        global $tries;
        $account = $_SESSION['account'];
        $storedOTP=findOTP($account);
        if ((isCorrectHash($inOTP,$storedOTP)==true) && ($tries<=3)){
            header('Location: newPassword.php');
        } else {
            $_SESSION['OTPFailed'] = 'true';
            ++$tries;
            if ($tries==4){
                $_SESSION['triesFailed'] = 'true';
            }
        }
    }
    ?>


<html>
    <head>
        <meta charset="UTF-8">
        <title>Enter Recovery code</title>
        <link rel="shortcut icon" href="favicon.ico" />
        <link href="CSS/style.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/forgotPw.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/registerPage.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/registerPrivClient.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/newPasswordPage.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/jquery.toast.min.css" rel="stylesheet" type="text/css"/>
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
        </script>
        
        <?php
            if(isset($_SESSION['OTPFailed'])){?>
                <script>
                    $.toast({
                        heading: "OTP Invalid",
                        text: "Recovery code invalid",
                        bgColor: "#FF6961",
                        textColor: "F3F3F3",
                        showHideTransition: "slide",
                        allowToastClose: false,
                        position: "bottom-center",
                        icon: "error",
                        loaderBg: "#373741",
                        hideAfter: 3000
                    });
                </script>

                <?php
                unset($_SESSION['OTPFailed']);
        }?>
                
        <?php
            if(isset($_SESSION['triesFailed'])){?>
                <script>
                    $.toast({
                        heading: "Tries exceeded",
                        text: "Recovery tries exceeded. Resend email",
                        bgColor: "#FF6961",
                        textColor: "F3F3F3",
                        showHideTransition: "slide",
                        allowToastClose: false,
                        position: "bottom-center",
                        icon: "error",
                        loaderBg: "#373741",
                        hideAfter: 3000
                    });
                </script>

                <?php
                unset($_SESSION['triesFailed']);
        }?>
        
        <div class="OTPPage" id="OTPPage">
            <div class="header">
                CompuLink Technologies
            </div>
            
            <div class="contentOTP">
                <div class="logo">
                    <img src="images/logo_block_cropped.png" alt="" id="compuLogo"/>
                </div>

                <form method="POST" >
                    <div class="resetPwInput">
                        <img src="images/lock.png" alt="" class="resetImg" id="lock1"/>
                        <input type="text" name="inOTP" placeholder="OTP" class="input" id="OTPInp">
                    </div>
                    <div class="resetSubmit" id="reset_submit">
                        <button type="submit" class="subNewPwBtn" name="subOTPBtn">SUBMIT OTP</button>
                    </div>
                </form>
            </div>
            

            
            <div class="footer">
                LinkVantage
            </div>
        </div>
    </body>
</html>


