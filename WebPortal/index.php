<?php
    
    session_start();
    if(isset($_SESSION['contactID'])){
        unset($_SESSION['contactID']);
    } else {
        if(isset($_SESSION['technicianID'])){
            unset($_SESSION['technicianID']);
        }
    }

    /**
     * Todo:
     * 
     * • Forgot password process (start to finish)
     */
    
    /* Need the database config info to connect, also to test and manage the 
     * connection 
     */
    require_once 'handleIndex.php';            
    
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
                                text: <?php $_SESSION['registrationSuccessful']?>,
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
                                text: <?php $_SESSION['preLoginWarning']?>,
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
                        <div class="tooltip">
                            <input type="text" name="username" placeholder="USERNAME" class="input" class="tooltip" id="username" required/>
                            <span class="tooltip-text">Enter your username</span>
                        </div>
                        <br>
                        <img src="images/lock.png" alt="" class="lockImg"/>
                        <div class="tooltip">
                            <input type="text" name="password" placeholder="PASSWORD" class="input" class="tooltip" id="passw" onfocus="changeType()" required/>
                            <span class="tooltip-text">Enter your password</span>
                        </div>
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
                        
                        
        <?php
                    if(isset($_SESSION["inputFailed"])){?>
                        <script>
                            $.toast({
                                heading: "Email/Username Invalid",
                                text: "No account with that email or username registered",
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
                        unset($_SESSION['inputFailed']);
                    }
        ?>
                        
                        
        <?php
            if(isset($_SESSION['triesLimit'])){?>
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
                unset($_SESSION['triesLimit']);
        }?>

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
                        <input type="text" name="emailInp" value="" placeholder="EMAIL" class="passwordRecoveryInp" id="emailInp"/>
                        <!-- These two elements are added using jQuery -->
                        <!--<img src="images/keyword.png" alt="" class="pinImg"/>
                        <input type="text" name="pin" value="" placeholder="PIN" class="passwordRecoveryInp" id="pinInp" required="true">-->
                    </div>

                    <div class="resetSubmit" id="reset_submit">
                        <button type="submit" name="resetSubBtn" class="resetSubBtn">SEND RESET REQUEST</button>
                    </div>
                </form>
            </div>
            
            <div class="footer">
                LinkVantage
            </div>
        </div>
        

        
    </body>
</html>
