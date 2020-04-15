<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Compulink Technologies</title>
        <!--Title icon link-->
        <link rel="shortcut icon" href="images/logo_block__1__AHI_icon.ico" />
        <!--CSS links-->
        <link href="CSS/style.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/forgotPw.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/registerPage.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/registerPrivClient.css" rel="stylesheet" type="text/css"/>
        <!--JS links-->
        <script src="Script/script.js" type="text/javascript"></script>
        <script src="Script/inputValidation.js" type="text/javascript"></script>
    </head>
    <body>
        <!--LOGIN PAGE-->
        <div class="loginPage" id="loginPageMain">
            <div class="header">
                Compulink Technologies
            </div>
            
            <div class="content">
                <div class="logo">
                    <img src="images/logo_block_cropped.png" alt="" id="compuLogo"/>
                </div>
                
                <div class="loginOptions">
                    <input type="submit" value="LOGIN" name="loginOpt" class="loginOptBtn"/>
                    <input type="submit" value="REGISTER" name="registerOpt" class="registerOptBtn" onclick="changeToRegisterCompany()"/>
                </div>
                
                <div class="loginInp">
                    <img src="images/account.png" alt="" class="accountImg"/>
                    <input type="text" name="username" placeholder="USERNAME" class="input" id="username"/>
                    <img src="images/lock.png" alt="" class="lockImg"/>
                    <input type="text" name="password" placeholder="PASSWORD" class="input" id="passw" onfocus="changeType()"/>
                    <font class="forgotPw" id="forgotPassBigScreen"><a href="#" onclick="forgotPasswordPage()">Forgot password?</a></font>
                </div>
                
                <div class="loginSubmit">
                    <input type="submit" value="LOGIN" name="loginSub" class="loginSubBtn"/>
                    <font class="forgotPw" id="forgotPassSmallScreen"><a href="#" onclick="forgotPasswordPage()">Forgot password?</a></font>
                </div>
            </div>
            
            <div class="footer">
                Linkvantage
            </div>
        </div>
        
        
        <!--FORGOT PASSWORD PAGE-->
        <div class="forgotPasswordPage" id="forgotPasswordPage">
            <div class="header">
                Compulink Technologies
            </div>
            
            <div class="contentFgPw">
                <div class="logo">
                    <img src="images/logo_block_cropped.png" alt="" id="compuLogo"/>
                </div>
                
                <div class="backToLogin">
                    <input type="submit" value="RETURN TO LOGIN" name="returnSub" class="returnToLoginBtn" onclick="changeToLogin()"/>
                </div>
                
                <div class="resetInpContent">
                    <img src="images/refresh.png" alt="" class="resetImg"/>
                    <select name="resetOptions" class="dropDownSelect" id="reset_options" onchange="modifyResetPassword()">
                        <option>RESET PASSWORD</option>
                        <option>TEXT OTP</option>
                        <option>ANDROID OTP</option>
                    </select>
                    
                    <img src="images/envelope.png" alt="" class="emailImg" id="passwordRecoveryImg"/>
                    <input type="text" name="emailInp" value="" placeholder="EMAIL" class="passwordRecoveryInp" id="emailInp"/>
                </div>
                
                <!--
                    <img src="images/lock.png" alt="" class="emailImg" id="androidOTPLockImg"/>
                    <input type="text" name="pin" placeholder="PIN" class="pinInp" id="androidOTPInp"/>
                -->
                
                <div class="resetSubmit" id="reset_submit">
                    <input type="submit" value="SEND RESET REQUEST" name="resetSub" class="resetSubBtn" onclick="verifyForgotPw()"/>
                </div>
            </div>
            
            <div class="footer">
                Linkvantage
            </div>
        </div>
        
        
        
        
    </body>
</html>
