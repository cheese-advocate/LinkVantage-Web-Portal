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
    require_once 'generator.php';
    require_once 'hasher.php';
    
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
    define("USERNAME_NOT_ENTERED", "Please enter your username.");
    define("PASSWORD_NOT_ENTERED", "Please enter your password.");
    define("USERNAME_NOT_FOUND", "Username not found.");
    define("PASSWORD_NOT_VALID", "Password not valid for this user.");
    define("LOGIN_ERROR", "Login attempt failed.");
    
    
    /* User Input Variable Declaration */
    $username = "";    
    $password = "";    
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
        
        /*If the password and username is set, it is a login attempt*/
        if (isset($_POST['username'], $_POST['password'])) {
            
            $username = trim($_POST["username"]);
            $password = trim($_POST["password"]);
            
            return HANDLE_LOGIN;
        /*if reset mode is set, it is a password reset attempt*/
        } elseif (isset($_POST['reset_options'])){
            
            /*if (isset($_POST['reset_options'], $_POST['emailInp'])) {
                
            }*/
            $pwResetMode=$_POST['reset_options'];
            $email = trim($_POST["emailInp"]);

            return HANDLE_FORGOT_PW;
              
        } else {
            
            return HANDLE_NO_INPUT;
            
        }
    }        
    
    /**
     * Handles the login attempt made by the user.
     * 
     * Assumes POST request method used.
     */
    function handleLogin() {
        
        global $username, $password, $loginIsValid, $loginErr;
              
        
        /* First, some server validation */
        
        /*Initialise variable to true*/
        $loginIsValid = true;
        
        /*Set false if username is empty*/
        if (empty($username)) {
            $loginErr = USERNAME_NOT_ENTERED;
            $loginIsValid = false;
        }
        
        /*Set false if password is empty*/
        if (empty($password)) {
            $passwordErr = PASSWORD_NOT_ENTERED;
            $loginIsValid = false;
        }
        
        /*If validation has not yet failed, validate the login details*/
        if ($loginIsValid) {
            
            /*Attempt to find the username in the database. Returns the 
             * associated account ID if found*/
            $accountID = getIDFromUsername($username);
            
            /*If the account was not found or a database error was encountered, 
             * set login to invalid*/
            if($accountID === NOT_FOUND || $accountID === PREP_STMT_FAILED)
            {
                $loginErr = USERNAME_NOT_FOUND;
                $loginIsValid = false;
            } else{ //if an account ID associated with the username was found
                
                /*Check if the password is valid for that account*/
                $loginAttempt = isPasswordValid($accountID, $password);
                
                /*If the password is valid, then loginIsValid remains true*/
                if($loginAttempt == true){
                    $loginIsValid = true;
                }
                elseif($loginAttempt == false){//If the password was invalid
                    $loginErr = PASSWORD_NOT_VALID;
                    $loginIsValid = false;
                } else {//If some other error occured during login
                    $loginErr = LOGIN_ERROR;
                    $loginIsValid = false;
                }
            }                        
        }
        
        /*If login is still valid after all the validation, then the account ID 
         * identifying the account logged into is stored in a session variable 
         * to track it on other pages. The user is then directed to the 
         * dashboard*/
        if($loginIsValid){
            /*Set the session variable to track which account is logged in 
             * accross different pages*/
            $_SESSION['accountID'] = $accountID;
            /*Set the session variables to track the Contact or Technician 
             * entities associated with the user*/
            setTechnicianContactID($accountID);
            /*If a contact is logged in, set the session variable to track the 
             * client associated with the contact*/
            if(isset($_SESSION['contactID'])){
                setClientID($_SESSION['contactID']);
            }
            /*Direct to the dashboard after login*/
            header("Location:Dashboard.php");
        }/*If login failed, the failure is stored in a session variable used to 
         * indicate that a login failure toast message must be displayed upon 
         * the page being reloaded*/
        else{
            $_SESSION['loginFailed'] = $loginErr;
        }
        
    }
    

    
    function handleForgotPW() {
        
        global $email, $account, $OTP, $pwResetMode, 
               $pwResetModeErr, $androidValidated;
        
        $androidValidated=false;
        
        switch ($pwResetMode) {
            
            case "RESET PASSWORD":
                
                $_SESSION["userStatus"] = "resetPassword";
                
                if(array_key_exists('resetSubBtn', $_POST)) { 
                resetSubBtn($email); 
                }
                
                break;

            case "ANDROID OTP":
                
                debugToConsole("Test");
                $_SESSION["userStatus"] = "androidOTP.html";
                $OTP=generateOTP();
                $account=getUserIDfromEmail($email);
                storeOTP($account, $OTP);
                if ($androidValidated==true){
                    header('Location: newPassword.php');
                }
                
                break;
            
            default:
                $pwResetModeErr = "Invalid Password Reset Mode Selected.";
        }
    }
      
    function resetSubBtn($email) {
        
        global  $account;
        
        if (findEmail($email)==false){
            $_SESSION["emailFailed"] = "true";
        } else {
            $_SESSION["userStatus"] = "getUserID";
            $account=getUserIDfromEmail($email);
            $_SESSION["account"]=$account;
            $username=getUsername($account);
            $OTP=generateOTP();
            $_SESSION["userStatus"] = "storeOTP";
            storeOTP($account, $OTP);
            forgotPassword($email,$username,$OTP);
            header('Location:otpPage.php');
        }
        $_SESSION["userStatus"] = "sendEmail";
        
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
                
                <!--Checks if the loginFailed variable is set, indicating that 
                the last login attempt was invalid and that a toast message 
                needs to be displayed-->
                <?php
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
                        /*Clears the login failed variable so that it does not 
                         * trigger a failed message without another failed 
                         * attempt*/
                        unset($_SESSION['loginFailed']);
                    }
                ?>
                
                <!--Checks if the registrationSuccessful variable is set, indicating that 
                the successfully registered a new client-->
                <?php
                    if(isset($_SESSION['registrationSuccessful'])){?>
                        <script>
                            $.toast({
                                heading: "Registration successful!",
                                text: <?php$_SESSION['registrationSuccessful']?>,
                                bgColor: "#77DD77",
                                textColor: "F3F3F3",
                                showHideTransition: "slide",
                                allowToastClose: false,
                                position: "bottom-center",
                                icon: "success",
                                loaderBg: "#374137",
                                hideAfter: 3000
                            });
                        </script> <?php
                        /*Clears the registrationSuccessful variable so that it does not 
                         * trigger a success message without another successful 
                         * registration attempt*/
                        unset($_SESSION['registrationSuccessful']);
                    }?>                                        
                
                <!--Checks if the preLoginWarning variable is set, indicating 
                that a non critical database error occurred during an otherwise 
                successful registration-->
                <?php
                    if(isset($_SESSION['preLoginWarning'])){?>
                        <script>
                            $.toast({
                                heading: "Registration error occurred",
                                text: <?php$_SESSION['preLoginWarning']?>,
                                bgColor: "#FFB347",
                                textColor: "F3F3F3",
                                showHideTransition: "slide",
                                allowToastClose: false,
                                position: "bottom-center",
                                icon: "warning",
                                loaderBg: "#414137",
                                hideAfter: 3000
                            });
                        </script> <?php
                        /*Clears the preLoginWarning variable so that it does not 
                         * trigger a warning message without another 
                         * registration attempt*/
                        unset($_SESSION['preLoginWarning']);
                    }?>                                        
                
                        <form method="POST" onsubmit="return loginToast()" action="#">
                    <div class="loginInp">
                        <img src="images/account.png" alt="" class="accountImg"/>
                        <input type="text" name="username" placeholder="USERNAME" class="input" id="username" required/>
                        <img src="images/lock.png" alt="" class="lockImg"/>
                        <input type="text" name="password" placeholder="PASSWORD" class="input" id="passw" onfocus="changeType()" required/>
                        <font class="forgotPw" id="forgotPassBigScreen" ><a href="#" name="forgotPw" onclick="forgotPasswordPage()">Forgot password?</a></font>
                    </div>

                    <div class="loginSubmit">
                        <button type="submit" class="loginSubBtn" onclick="">LOGIN</button>
                        <font class="forgotPw" id="forgotPassSmallScreen" ><a href="#" name="forgotPw" onclick="forgotPasswordPage()">Forgot password?</a></font>
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
        
        <?php
                    if(isset($_SESSION['emailFailed'])){?>
                        <script>
                            $.toast({
                                heading: "Email Invalid",
                                text: "No account with that email registered",
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
                        /*Clears the login failed variable so that it does not 
                         * trigger a failed message without another failed 
                         * attempt*/
                        unset($_SESSION['emailFailed']);
                    }
        ?>

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

                <form  method="POST" action="#">
                        
                    <div class="resetInpContent" name="test">
                        <img src="images/refresh.png" alt="" class="resetImg"/>
                        <select name="reset_options" class="dropDownSelect" id="reset_options" onchange="modifyResetPassword()">
                            <option name="RESET PASSWORD">RESET PASSWORD</option>
                            <option name="ANDROID OTP">ANDROID OTP</option>
                        </select>
                        <img src="images/envelope.png" alt="" class="emailImg" id="passwordRecoveryImg"/>
                        <input type="text" name="emailInp" value="" placeholder="EMAIL" class="passwordRecoveryInp" id="emailInp" required/>
                        <!-- These two elements are added using jQuery -->
                        <!--<img src="images/keyword.png" alt="" class="pinImg"/>
                        <input type="text" name="pin" value="" placeholder="PIN" class="passwordRecoveryInp" id="pinInp" required="true">-->
                    </div>

                    <div class="resetSubmit" id="reset_submit">
                        <button type="submit" name="resetSubBtn" onclick="verifyForgotPw()" class="resetSubBtn">SEND RESET REQUEST</button>
                    </div>
                </form>
            </div>
            
            <div class="footer">
                LinkVantage
            </div>
        </div>
        

        
    </body>
</html>
