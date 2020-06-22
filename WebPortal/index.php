<?php
    
    session_start();

    /**
     * Todo:
     * 
     * • Forgot password process (start to finish)
     */
    
    /* Need the database config info to connect, also to test and manage the 
     * connection 
     */
    require_once 'config.php';
    require_once 'inputServerValidation.php';
    require_once 'emailManager.php';
    
    /* Constant Variable Declaration */
    define("PW_RESET_EMAIL","RESET PASSWORD");
    /*define("PW_RESET_PHONE_OTP","TEXT OTP");*/
    define("PW_RESET_OTP","ANDROID OTP");
    define("RESET_STATE_SELECT_MODE", "RESET_STATE_SELECT_MODE");
    define("RESET_STATE_RESET_REQUESTED", "RESET_STATE_RESET_REQUESTED");
    define("RESET_STATE_CODE_CREATED", "RESET_STATE_CODE_CREATED");
    define("RESET_STATE_CODE_ENTERED", "RESET_STATE_CODE_ENTERED");
    define("RESET_STATE_ENTER_PASSWORD", "RESET_STATE_ENTER_PASSWORD");
    define("HANDLE_LOGIN","HANDLE_LOGIN");
    define("HANDLE_FORGOT_PW","HANDLE_FORGOT_PW");
    define("HANDLE_NO_INPUT","HANDLE_NO_INPUT");
    
    
    
    /* User Input Variable Declaration */
    $username = "";
    $usernameErr = "";
    $password = "";
    $passwordErr = "";
    $loginErr = "";
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
    $pwResetModeErr = "";
    $newPassword = "";
    $confirmNewPassword = "";        
    
    /* Check if a form was submitted */
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $handleType = checkReceivedPostVariables();
        
        switch ($handleType) {
            
            case HANDLE_LOGIN:
                
                handleLogin();
                break;
            
            case HANDLE_FORGOT_PW:
                
                handleForgotPW();
                break;
            
            case HANDLE_NO_INPUT:
                
                handleNoInput();
                break;
            
        }
        
    }
    
    
    
    /**
     * Attempts to determine whether the user submitted a POST request from 
     * login or forgot password based on the values received.
     * 
     * At this stage this is the only known way to uniquely identify a POST 
     * request - will need to be corrected should a more reliable method be 
     * found.
     * 
     * @global type $username
     * @global type $password
     * @global type $pwResetMode
     * @global type $email
     * @global type $phone
     * @global type $OTP
     * @global type $newPassword
     * @global type $confirmNewPassword
     * @return type Whether the page should handle a login request, a forgot 
     * password request, or a request with no input.
     */
    function checkReceivedPostVariables() {
        
        global $username, $password, $pwResetMode, $email, $phone, $OTP, 
               $newPassword, $confirmNewPassword;
        
        if (isset($_POST['username'], $_POST['password'])) {
            
            $username = trim($_POST["username"]);
            $password = trim($_POST["password"]);
            
            return HANDLE_LOGIN;
            
        } elseif (isset($_POST['pwResetMode'], $_POST['emailInp'])
               || isset($_POST['OTP'])
               || isset($_POST['newPassword'], $_POST['confirmNewPassword'])) {
            
            if (isset($_POST['pwResetMode'], $_POST['emailInp'])) {
                $email = trim($_POST["emailInp"]);
                $phone = trim($_POST["emailInp"]);
            }
            
            if (isset($_POST['OTP'])) {
                $OTP = trim($_POST["otp"]);
            }
            
            if (isset($_POST['newPassword'], $_POST['confirmNewPassword'])) {
                $newPassword = trim($_POST["newPassword"]);
                $confirmNewPassword = trim($_POST["confirmNewPassword"]);
            }
            
            return HANDLE_FORGOT_PW;
            
        } else {
            
            return HANDLE_NO_INPUT;
            
        }
            
        
//        $username = trim($_POST["username"]);
//        $password = trim($_POST["password"]);
//        $pwResetMode = trim($_POST["pwResetMode"]);
//        $email = trim($_POST["emailInp"]);
//        $phone = trim($_POST["emailInp"]);
//        $OTP = trim($_POST["otp"]);
//        $newPassword = trim($_POST["newPassword"]);
//        $confirmNewPassword = trim($_POST["confirmNewPassword"]);
//        
//        if (!empty($username) || !empty($password)) {
//            
//            return HANDLE_LOGIN;
//            
//        } elseif (!empty($pwResetMode) || !empty($email) || !empty($OTP)
//               || !empty($newPassword) || !empty($confirmNewPassword)) {
//            
//            return HANDLE_FORGOT_PW;
//            
//        } else {
//            
//            return HANDLE_NO_INPUT;
//            
//        }
    }
    
    
    
    /**
     * Handles the login attempt made by the user.
     * 
     * Assumes POST request method used.
     */
    function handleLogin() {
        
        global $username, $password, $loginIsValid, $usernameErr, $passwordErr;
        
        $accountID;
        
        // $username = trim($_POST["username"]);
        // $password = trim($_POST["password"]);
        
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
            
            $accountID = findUsername($username);
            if($accountID === NOT_FOUND || $accountID === PREP_STMT_FAILED)
            {
                $usernameErr = "Username not found.";
                $loginIsValid = false;
            } else{
                
                $loginAttempt = isPasswordValid($accountID, $password);
                
                if($loginAttempt == true){
                    $loginIsValid = $accountID;
                }
                elseif($loginAttempt == false){
                    $passwordErr = "Invalid password.";
                    $$loginIsValid = false;
                } else {
                    $loginErr = "Login failed";
                    $loginIsValid = false;
                }
            }                        
        }
        
        if($loginIsValid){            
            $_SESSION['accountID'] = $accountID;
            header("Location:Dashboard.php");
        }else{
            $_SESSION['loginFailed'] = 'failed';
        }
        
    }
    
    
    
    /**
     * Handles the forgot password request made by the user.
     * 
     * Assumes POST request method used.
     */
    function handleForgotPW() {
        
        global $email, $username,$account,  $emailErr, $phone, $phoneErr, $OTP, $OTPErr, $pwResetMode, 
               $pwResetModeErr, $confirmNewPassword;
        
        /** 
         * This is where things get tricky.
         * 
         * Since all parts of forgetting a password from the user selecting the 
         * option in login all the way to entering the validated new password 
         * into the database.
         * 
         * This means we have to track the user's current status throughout the 
         * process, likely with a session, and render the page accordingly.
         */
        
        $pwResetMode = htmlspecialchars($_POST["resetOptions"]);
        
        session_start();
        
        switch ($pwResetMode) {
            
            case 'RESET PASSWORD':
                
                $_SESSION["userStatus"] = "resetPassword";
                
                if(array_key_exists('resetSubBtn', $_POST)) { 
                resetSubBtn(); 
                }
                
                function resetSubBtn() {
                    
                    if (getUserIDfromEmail($email)==NOT_FOUND){
                        $email=null;
                        $emailErr= "Email not found";
                    } else {
                        $_SESSION["userStatus"] = "getUserID";
                        $account=getUserIDfromEmail($email);
                        $username=getUsernameFromID($account);
                        $OTP=generateOTP();
                        $_SESSION["userStatus"] = "storeOTP";
                        storeOTP($account, $OTP);
                    }
                    $_SESSION["userStatus"] = "sendEmail";
                    forgotPassword($email, $username, $OTP);
                }
                
                if(array_key_exists('subNewPwBtn', $_POST)) { 
                subNewPwBtn($account); 
                $_SESSION["userStatus"] = "updatePassword";
                }
                
                function subNewPwBtn($account) {
                    $password=$_POST['emailInput'];
                    updatePassword($account,$confirmNewPassword);
                }
                break;

/*            case PW_RESET_PHONE_OTP:

                 WIP 
                
                break;*/

            case 'ANDROID OTP':
                
                $_SESSION["userStatus"] = "androidOTP";

                /* WIP */
                /*$OTP=generateOTP();
                
                $account=getUserIDfromPhone($email);
                
                storeOTP($account, $otp);
                
                isOTPCorrect($account, $userOTP);*/
                
                if(array_key_exists('subNewPwBtn', $_POST)) { 
                subNewPwBtn($account); 
                $_SESSION["userStatus"] = "updatePassword";
                }
                
                function subNewPwBtn($account) {
                    $password=$_POST['emailInput'];
                    updatePassword($account,$newPassword);
                }
                
                break;
            
            default:
                
                $pwResetModeErr = "Invalid Password Reset Mode Selected.";

        }

        /*  */
        
    }
    
    
    
    /**
     * Currently does nothing.
     * 
     * What it used to do:
     * 
     * If no input is received in the POST submission, handle both login and 
     * forgot password so that the appropriate error message can be shown.
     * 
     * This method aims to ensure that output is provided even if a completely 
     * empty form is submitted, which at this stage renders the request 
     * indiscernible to the system in terms of whether the request is for login 
     * or for forgot password.
     * 
     * This method also assumes that only the relevant error messages will be 
     * displayed, even though all will be assigned their values, thus made ready 
     * to be shown.
     */
    function handleNoInput() {
        
        /* Hope that the JS hasn't been bypassed for now. Beyond feasibility for 
         * the scope of the project to make this more dynamic. 
         */
        
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
        <link href="CSS/jquery.toast.min.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/forgotPw.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/registerPage.css" rel="stylesheet" type="text/css"/>
        <!--JS links-->
        <script src="Script/jquery-3.5.0.js" type="text/javascript"></script>
        <script src="Script/jquery.toast.min.js" type="text/javascript"></script>
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
                    <button class="loginOptBtn">LOGIN</button>
                    <button class="registerOptBtn" onclick="changeToRegisterCompany()">REGISTER</button>
                </div>
                
                <script>
                    function loginToast()
                    {
                        if(loginVerification())
                        {
                            return true;
                        }
                        else
                        {
                            $.toast({
                                heading: "Login Invalid",
                                text: "Username or password fields are empty",
                                bgColor: "#FF6961",
                                textColor: "F3F3F3",
                                showHideTransition: "slide",
                                allowToastClose: false,
                                position: "bottom-center",
                                icon: "error",
                                loaderBg: "#373741",
                                hideAfter: 3000
                            });
                            return false;
                        }
                    }
                </script>                               
                
                <?php
                    $loginFailed = false;
                    if(isset($_SESSION['loginFailed'])){?>
                        <script>
                            $.toast({
                                heading: "Login Invalid",
                                text: "No account with that username and password",
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
                        session_unset();
                    }
                ?>
                
                <form method="POST" onsubmit="return loginToast()" action="#">
                    <div class="loginInp">
                        <img src="images/account.png" alt="" class="accountImg"/>
                        <input type="text" name="username" placeholder="USERNAME" class="input" id="username" required/>
                        <img src="images/lock.png" alt="" class="lockImg"/>
                        <input type="text" name="password" placeholder="PASSWORD" class="input" id="passw" onfocus="changeType()" required/>
                        <font class="forgotPw" id="forgotPassBigScreen"><a href="#" onclick="forgotPasswordPage()">Forgot password?</a></font>
                    </div>

                    <div class="loginSubmit">
                        <button type="submit" class="loginSubBtn" onclick="">LOGIN</button>
                        <font class="forgotPw" id="forgotPassSmallScreen"><a href="#" onclick="forgotPasswordPage()">Forgot password?</a></font>
                    </div>
                </form>

            </div>
            
            <div class="footer">
                LinkVantage
            </div>
        </div>
        
        
        <!--FORGOT PASSWORD PAGE-->
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
        <div class="forgotPasswordPage" id="forgotPasswordPage">
            <div class="header">
                CompuLink Technologies
            </div>
            
            <div class="contentFgPw">
                <div class="logo">
                    <img src="images/logo_block_cropped.png" alt="" id="compuLogo"/>
                </div>
                
                <div class="backToLogin">
                    <button class="returnToLoginBtn" onclick="changeToLogin()">RETURN TO LOGIN</button>
                </div>

                <form method="POST" onsubmit="return verifyForgotPw()" action="newPassword.php">
                    <div class="resetInpContent">
                        <img src="images/refresh.png" alt="" class="resetImg"/>
                        <select name="resetOptions" class="dropDownSelect" id="reset_options" name="pwResetMode" onchange="modifyResetPassword()">
                            <option>RESET PASSWORD</option>
                            <option>TEXT OTP</option>
                            <option>ANDROID OTP</option>
                        </select>

                        <img src="images/envelope.png" alt="" class="emailImg" id="passwordRecoveryImg"/>
                        <input type="text" name="emailInp" value="" placeholder="EMAIL" class="passwordRecoveryInp" id="emailInp" required/>
                        <!-- These two elements are added using jQuery -->
                        <!--<img src="images/keyword.png" alt="" class="pinImg"/>
                        <input type="text" name="pin" value="" placeholder="PIN" class="passwordRecoveryInp" id="pinInp" required="true">-->
                    </div>

                    <div class="resetSubmit" id="reset_submit">
                        <button type="submit"  class="resetSubBtn">SEND RESET REQUEST</button>
                    </div>
                </form>
            </div>
            
            <div class="footer">
                LinkVantage
            </div>
        </div>
    </body>
</html>
