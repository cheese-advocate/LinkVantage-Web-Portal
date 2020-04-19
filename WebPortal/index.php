<?php
    
    /* Need the database config info to connect, also to test the connection */
    require_once 'config.php';
    
    /* Constant Variable Declaration */
    define("PW_RESET_EMAIL","PW_RESET_EMAIL");
    define("PW_RESET_PHONE_OTP","PW_RESET_PHONE_OTP");
    define("PW_RESET_OTP","PW_RESET_OTP");
    define("RESET_STATE_SELECT_MODE", "RESET_STATE_SELECT_MODE");
    define("RESET_STATE_RESET_REQUESTED", "RESET_STATE_RESET_REQUESTED");
    define("RESET_STATE_CODE_CREATED", "RESET_STATE_CODE_CREATED");
    define("RESET_STATE_CODE_ENTERED", "RESET_STATE_CODE_ENTERED");
    define("RESET_STATE_ENTER_PASSWORD", "RESET_STATE_ENTER_PASSWORD");
    
    /* SQL Statements */
    define("SQL_ATTEMPT_LOGIN","SELECT checkPassword(?, ?)");
    define("SQL_IS_EMAIL_REGISTERED", "SELECT checkEmail(?)");
    define("SQL_IS_PHONE_REGISTERED", "SELECT checkPhone(?)");
    define("SQL_CREATE_OTP", "SELECT createOTP(?)");
    define("SQL_VERIFY_OTP", "SELECT verifyOTP(?)");
    
    /* User Input Variable Declaration */
    $username = "";
    $usernameErr = "";
    $password = "";
    $passwordErr = "";
    $loginResult;
    $email = "";
    $emailErr = "";
    $phone = "";
    $phoneErr = "";
    $OTP = "";
    $OTPErr = "";
    // <editor-fold defaultstate="collapsed" desc="$resetState">
    /**
     * The state of the password reset process.
     * 
     * Can be:
     * 
     * SELECT MODE
     * 
     * Starting phase of reset password, where the user confirms which reset 
     * mode to use. Once the user has selected a mode and clicked "send reset 
     * request", the user progresses to the next phase.
     * 
     * RESET REQUESTED
     * 
     * The mode is identified and the user's entered email/phone number is 
     * validated. If the respective contact point is invalid, the user is 
     * prompted to reenter their contact point for revalidation. If the same is 
     * valid, an OTP is generated and, if applicable, the reset link is emailed.
     * 
     * CODE CREATED
     * 
     * This mode prompts and allows the user to enter the OTP they have received.
     * 
     * CODE ENTERED
     * 
     * This mode verifies correctness and timing of the OTP entered. If the OTP 
     * is correct, the user is prompted to enter their new password. If the OTP 
     * is incorrect, the user is prompted to re-enter the OTP. The user can also 
     * request a new OTP, taking the process back to CODE CREATED.
     * 
     * If the user enters an incorrect OTP three times, or if the OTP is too old, t
     * he system defaults back to RESET REQUESTED, revalidating the contact 
     * method and requesting a new OTP. The user is prompted by this.
     * 
     * VALIDATE PASSWORD
     * 
     * WIP. Only applicable if Enter New Password is in this page.
     */
    $resetState = "";
    // </editor-fold>
    $pwResetMode = "";
    
    /* Prepare the database interactions */
    $checkLoginCredentials = "SELECT checkPassword($username, $password)";
    $isEmailRegistered = "SELECT checkEmail($email)";
    $isPhoneRegistered = "SELECT checkPhone($phone)";
    $createOTP = "CALL createOTP()";
    $verifyOTP = "SELECT verifyOTP($OTP)";
    
    if (true) {
        $username = "nop";
        echo $username;
    }
    
    /* Check if a form was submitted */
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        handleLogin();
        handleForgotPW();
        
        // <editor-fold defaultstate="collapsed" desc="Handle Forgot PW">
        
        /* 
         * Handle Forgot PW 
         */

        /* What is the user's chosen password recovery method? */
        $pwResetMode = htmlspecialchars($_POST["name"]);

        /* If the user has forgotten their password, is their input email/phone part 
         * of a registered account? 
         */
        switch ($pwResetMode) {
            case PW_RESET_EMAIL:

                break;

            case PW_RESET_PHONE_OTP:

                break;

            case PW_RESET_OTP:



        }

        /*  */
        
        // </editor-fold>
        
    }
    
        /**
         * 
         * @param type $username
         * @param type $pw
         */
    function attemptLogin($username, $pw) {
        
    }
    
    /**
     * Handles the login attempt made by the user.
     * 
     * Assumes POST request method used.
     */
    function handleLogin() {
        
        global $username, $password, $loginIsValid, $usernameErr, $passwordErr, 
               $loginResult;
        
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);
        
        /* First, some server validation */
        $loginIsValid = true;
        if (empty($username)) {
            $usernameErr = "Please enter your username.";
            $loginIsValid = false;
        }
        
        if (empty($password)) {
            $passwordErr = "Please enter your password.";
            $loginIsValid = false;
        }
        
        if ($loginIsValid) {
            $loginResult = attemptLogin($username, $password);
        }
        
    }
    
    /**
     * Handles the forgot password request made by the user.
     * 
     * Assumes POST request method used.
     */
    function handleForgotPW() {
        
        global $email, $emailErr, $phone, $phoneErr, $OTP, $OTPErr, $pwResetMode;
        
        /**/
        
    }
    
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>CompuLink Technologies</title>
        <!--Title icon link-->
        <link rel="shortcut icon" href="favicon.ico" />
        <!--CSS links-->
        <link href="CSS/style.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/forgotPw.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/registerPage.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/registerPrivClient.css" rel="stylesheet" type="text/css"/>
        <!--JS links-->
        <script src="Script/jquery-3.5.0.js" type="text/javascript"></script>
        <script src="Script/script.js" type="text/javascript"></script>
        <script src="Script/inputValidation.js" type="text/javascript"></script>
    </head>
    <body>
        <!--LOGIN PAGE-->
        <div class="loginPage" id="loginPageMain">
            <div class="header">
                CompuLink Technologies
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
                    <input type="submit" value="LOGIN" name="loginSub" class="loginSubBtn" onclick="loginVerification()"/>
                    <font class="forgotPw" id="forgotPassSmallScreen"><a href="#" onclick="forgotPasswordPage()">Forgot password?</a></font>
                </div>
            </div>
            
            <div class="footer">
                LinkVantage
            </div>
        </div>
        
        
        <!--FORGOT PASSWORD PAGE-->
        <div class="forgotPasswordPage" id="forgotPasswordPage">
            <div class="header">
                CompuLink Technologies
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
                LinkVantage
            </div>
        </div>
        
        
        
        
    </body>
</html>
