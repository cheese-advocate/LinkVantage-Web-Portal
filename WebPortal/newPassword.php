<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
        <!--JS links-->
        <script src="Script/jquery-3.5.0.js" type="text/javascript"></script>
        <script src="Script/script.js" type="text/javascript"></script>
        <script src="Script/inputValidation.js" type="text/javascript"></script>
    </head>
    <body>        
        <div class="newPasswordPage" id="newPwPg">
            <div class="header">
                CompuLink Technologies
            </div>
            
            <div class="contentFgPw">
                <div class="logo">
                    <img src="images/logo_block_cropped.png" alt="" id="compuLogo"/>
                </div>

                <form method="POST" onsubmit="return verifyNewPassword()" action="#">
                    <div class="resetPwInput">
                        <img src="images/lock.png" alt="" class="resetImg" id="lock1"/>
                        <input type="text" naem="newPassword" placeholder="PASSWORD" class="input" id="newPwInp" onfocus="changeNewPasswordType()">

                        <img src="images/lock.png" alt="" class="resetImg" id="lock2"/>
                        <input type="text" naem="confirmPassword" placeholder="PASSWORD" class="input" id="confirmPwInp" onfocus="changeNewPasswordType()">
                    </div>

                    <div class="resetSubmit" id="reset_submit">
                        <button type="submit" onclick="" class="subNewPwBtn">SUBMIT PASSWORD</button>
                    </div>
                </form>
            </div>
            
            <div class="footer">
                LinkVantage
            </div>
        </div>
    </body>
</html>
