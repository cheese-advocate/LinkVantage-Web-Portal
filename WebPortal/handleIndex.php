<?php
/*
 * File to handle php functionality of index, allowing it to be more accessible 
 * to mobilePortal.php
 */

/**
 * Description of handleIndex
 *
 * @author Jarred Fourie
 */

require_once 'config.php';
require_once 'inputServerValidation.php';
require_once 'emailManager.php';
require_once 'generator.php';
require_once 'hasher.php';
require_once 'encryptor.php';

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
        
        if (isset($_POST['pin'])){
            $username = trim($_POST['pin']);
        }

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
        $loginErr = PASSWORD_NOT_ENTERED;
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
        /*Set a session variable to keep track of the welcome message to 
         * ensure it is only shown on login
         */
        $_SESSION['welcome'] = false;
        /*If a contact is logged in, set the session variable to track the 
         * client associated with the contact*/
        if(isset($_SESSION['contactID'])){
            setClientID($_SESSION['contactID']);
        }
        /*Direct to the dashboard after login*/
        header("Location:Dashboard.php");
        echo $accountID;
    }/*If login failed, the failure is stored in a session variable used to 
     * indicate that a login failure toast message must be displayed upon 
     * the page being reloaded*/
    else{
        $_SESSION['loginFailed'] = $loginErr;
    }

}



function handleForgotPW() {

    global $email, $username, $account, $OTP, $pwResetMode, 
           $pwResetModeErr, $androidValidated;

    $androidValidated=false;

    switch ($pwResetMode) {

        case "RESET PASSWORD":

            $_SESSION['triesFailed']=0;

            if(array_key_exists('resetSubBtn', $_POST)) { 
                
                if (findEmail($email)==false){
                    $_SESSION["emailFailed"] = "true";
                } else {
                    sendEmail($email);
                }
                
                if(!isset($_SESSION["emailFailed"])){
                    header('Location: otpPage.php');
                }
            }

            break;

        case "ANDROID OTP":
            
            $_SESSION['triesFailed']=0;
            
            if(array_key_exists('resetSubBtn', $_POST)) {
                
                if ((findEmail($email)==true) or (findUsername($username)==true)){
                    header('Location: otpPage.php');
                    if (findUsername($username)==true){
                        $account=getIDFromUsername($username);
                    }
                    if (findEmail($email)==false){
                        $account=getUserIDfromEmail($email);
                    }
                    $_SESSION["account"]=$account;
                    $OTP=generateOTP();
                    $_SESSION[$email]=$OTP;
                    storeOTP($account, $OTP);
                } else {
                    $_SESSION["inputFailed"] = "true";
                }
                    
                    
                    
                   
                    /*$encrytor = new encryptor();
                    $encrpted1 = $encrytor->encrypt($OTP);
                    $_SESSION["encrOTP"]=$encrpted1;
                    echo 'ENCRYPTED 1: '.$encrpted1.PHP_EOL;
                    $decrpted1 = $encrytor->decrypt($encrpted1);
                    echo 'DECRYPTED 1: '.$decrpted1.PHP_EOL;*/
                }
                
                if(!isset($_SESSION["inputFailed"])){
                    header('Location: otpPage.php');
                }
            
            break;

        default:
            $pwResetModeErr = "Invalid Password Reset Mode Selected.";
    }
}

function sendEmail($email) {
    Global $username,$OTP, $account;

    $account=getUserIDfromEmail($email);
    $_SESSION["account"]=$account;
    $username=getUsername($account);
    $OTP=generateOTP();
    $_SESSION[$email]=$OTP;
    storeOTP($account, $OTP);
    forgotPassword($email,$username,$OTP);  
}

function getOTP($email){
    if (isset($_SESSION[$email])){
    $OTP=$_SESSION[$email];
    unset($_SESSION[$email]);
    return $OTP;
    } else {
    $OTP=generateOTP();
    $account=getUserIDfromEmail($email);
    storeOTP($account, $OTP);
    return $OTP;
    }
}


function getOTP1($email){
    if (isset($_SESSION[$email])){
    $OTP=$_SESSION[$email];
    unset($_SESSION[$email]);
    return $OTP;
    } else {
    return "Not declared"; 
    }
}


function getOTP2(){
    Global $OTP;
    return $OTP; 
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
