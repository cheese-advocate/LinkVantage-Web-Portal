<?php

/** 
 * This file stores database-related configuration information, and is used by 
 * the rest of the webpages to configure communications with the database.
 * 
 * @author Tristan Ackermann
 * 
 * Todo:
 * • All database interactions
 * • All SQL statements
 */

require_once 'hasher.php';

/* SQL Statements */
define("SQL_ATTEMPT_LOGIN","SELECT validatePassword(?, ?)");
define("SQL_CHECK_USERNAME","SELECT getAccountID(?)");
define("SQL_CHECK_EMAIL", "SELECT checkEmail(?)");
define("SQL_CHECK_PHONED", "SELECT checkPhone(?)");
define("SQL_STORE_OTP", "CALL storeOTP(?)");
define("SQL_VERIFY_OTP", "SELECT verifyOTP(?, ?)");
define("SQL_GET_PASSWORD", "SELECT getPassword(?)");
define("SQL_GET_OTP", "SELECT getOTP(?)");
define("SQL_UPDATE_PASSWORD","CALL updatePassword(?, ?)");
define("SQL_GET_ACCOUNTID_EMAIL","CALL getAccountID_Email(?)");
define("SQL_GET_ACCOUNTID_PHONE","CALL getAccountID_Phone(?)");
define("SQL_CHECK_COMPANY_NAME","");
define("SQL_REGISTER_COMPANY","");
define("SQL_REGISTER_PRIVATE_CLIENT","");

/* Database credentials */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'P@ssword1'/*'P@ssword1'*/);
define('DB_NAME', 'Chai');

/* Other useful constants */
define('PREP_STMT_FAILED', 'Prepared Statement Failed');
define('NOT_FOUND', '');//When account/email/phone number searched for an empty 
//result set returned
define('LOGIN_FAILED', 'Login has failed');

/* Test connectivity to the database */
/**
 * Database Connection Manager. Used to connect to, configure, manipulate, and 
 * disconnect from the database.
 */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

/* Test the connection */
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


/**
 * Checks if the password entered is valid for an account
 * 
 * @global type $link the database connection
 * @param type $username the accountID the login is attempted for
 * @param type $password the password entered  by the user
 * @return string The account number associated with the username and password, 
 * NOT_FOUND if there is none associated with it, or PREP_STMT_FAILED if the 
 * statement failed to execute
 */
function isPasswordValid($accountID, $password) {
    /*Access the global variable link*/ 
    global $link;
    
    /*Get the hashed password for the account from the database*/
    $hashedPassword = findPassword($accountID);

    /*If the password was successfully found*/
    if($hashedPassword != NOT_FOUND && $hashedPassword != PREP_STMT_FAILED)
    {

        /*If the password is correct for the hash*/
        if(isCorrectHash($password, $hashedPassword))
        {
            
            $result = true;
            
        /*If the password is incorrect for the hash*/    
        } else{
            
            $result = false;
            
        }   

    /*If the hashed password could not successfully be retrieved*/    
    } else {

        $result = LOGIN_FAILED;

    }
    
    return $result;
    
}

/**
 * A method to check if the username entered by the user already exists in the 
 * database
 * 
 * @param type $username username entered by the user
 * @return boolean|String true if username is found, false if it is not found, and 
 * PREP_STMT_FAILED if the prepared statement could not execute.
 */
function isUsernameRegistered($username) {
    
    $find = findUsername($username);
    
    if($find === NOT_FOUND){
        return false;
    } elseif ($find === PREP_STMT_FAILED){
        return PREP_STMT_FAILED;
    } else {
        return true;
    }    
    
}

/**
 * method to find the accountID from a given username
 * 
 * @global type $link the database connection
 * @param type $username the username entered by the user
 * @return type the accountID associated with the username, NOT_FOUND if none 
 * was found, or PREP_STMT_FAILED if the statement failed to execute.
 */
function findUsername($username)
{
    /*Access the global variable link*/ 
    global $link;
    
    /*Check that statement worked, prepare statement selecting from getAccountID 
     * function*/
    if($stmt = mysqli_prepare($link, SQL_CHECK_USERNAME)){
        /*insert email variable to select statement*/
        mysqli_stmt_bind_param($stmt, "s", $username);
        /*execute the query*/
        mysqli_stmt_execute($stmt);
        /*bind the result of the query to the $result variable*/
        mysqli_stmt_bind_result($stmt, $result);
        /*fetch the result of the query*/
        mysqli_stmt_fetch($stmt);                                    
        /*close the statement*/
        mysqli_stmt_close($stmt);        
        
        /*If sql returns empty result set, indicating not found*/
        if($result == '')
        {
            $result = NOT_FOUND;
        }
        
        return $result;
        /*If statement failed*/
    } else {
        return PREP_STMT_FAILED;
    }
}

/**
 * method to find the accountID from a given email
 * 
 * @global type $link the database connection
 * @param type $username the username entered by the user
 * @return type the accountID associated with the username, NOT_FOUND if none 
 * was found, or PREP_STMT_FAILED if the statement failed to execute.
 */
function getUserIDfromEmail($email)
{
    /*Access the global variable link*/ 
    global $link;
    
    /*Check that statement worked, prepare statement selecting from getAccountID 
     * function*/
    if($stmt = mysqli_prepare($link, SQL_GET_ACCOUNTID_EMAIL)){
        /*insert email variable to select statement*/
        mysqli_stmt_bind_param($stmt, "s", $email);
        /*execute the query*/
        mysqli_stmt_execute($stmt);
        /*bind the result of the query to the $result variable*/
        mysqli_stmt_bind_result($stmt, $result);
        /*fetch the result of the query*/
        mysqli_stmt_fetch($stmt);                                    
        /*close the statement*/
        mysqli_stmt_close($stmt);        
        
        /*If sql returns empty result set, indicating not found*/
        if($result == '')
        {
            $result = NOT_FOUND;
        }
        
        return $result;
        /*If statement failed*/
    } else {
        return PREP_STMT_FAILED;
    }
}

/**
 * method to find the accountID from a given phone number
 * 
 * @global type $link the database connection
 * @param type $username the username entered by the user
 * @return type the accountID associated with the username, NOT_FOUND if none 
 * was found, or PREP_STMT_FAILED if the statement failed to execute.
 */
function getUserIDfromPhone($phone)
{
    /*Access the global variable link*/ 
    global $link;
    
    /*Check that statement worked, prepare statement selecting from getAccountID 
     * function*/
    if($stmt = mysqli_prepare($link, SQL_GET_ACCOUNTID_PHONE)){
        /*insert email variable to select statement*/
        mysqli_stmt_bind_param($stmt, "s", $phone);
        /*execute the query*/
        mysqli_stmt_execute($stmt);
        /*bind the result of the query to the $result variable*/
        mysqli_stmt_bind_result($stmt, $result);
        /*fetch the result of the query*/
        mysqli_stmt_fetch($stmt);                                    
        /*close the statement*/
        mysqli_stmt_close($stmt);        
        
        /*If sql returns empty result set, indicating not found*/
        if($result == '')
        {
            $result = NOT_FOUND;
        }
        
        return $result;
        /*If statement failed*/
    } else {
        return PREP_STMT_FAILED;
    }
}

/**
 * A method to find the accountID and otp for a given email 
 * 
 * @param type $email the given email
 * @return type the OTP and accountID associated with the given email or PREP_STMT_FAILED if 
 * it could not be found
 */
function getUserID_OTP($email)
{
    $ID = getUserIDfromEmail($email);
    $OTP = findOTP($ID);
    return array($ID,$OTP);
}


/**
 * A method to find the hashed password for the given accountID
 * 
 * @global type $link the database connection
 * @param type $accountID the account to find the associated password for
 * @return type the password, if successfully retrieved, NOT_FOUND, if it could 
 * not be retrieved, and PREP_STMT_FAILED, if it failed to execute.
 */
function findPassword($accountID)
{
    /*Access the global variable link*/ 
    global $link;
    
    /*Check that statement worked, prepare statement selecting from getAccountID 
     * function*/
    if($stmt = mysqli_prepare($link, SQL_GET_PASSWORD)){
        /*insert accountID variable to select statement*/
        mysqli_stmt_bind_param($stmt, "s", $accountID);
        /*execute the query*/
        mysqli_stmt_execute($stmt);
        /*bind the result of the query to the $result variable*/
        mysqli_stmt_bind_result($stmt, $result);
        /*fetch the result of the query*/
        mysqli_stmt_fetch($stmt);                                    
        /*close the statement*/
        mysqli_stmt_close($stmt);        
        
        /*If sql returns empty result set, indicating not found*/
        if($result == '')
        {
            $result = NOT_FOUND;
        }
        
        return $result;
        /*If statement failed*/
    } else {
        return PREP_STMT_FAILED;
    }
}

/**
 * A method to find the otp associated with a given account 
 * 
 * @param type $accountID the given AccountID
 * @return type the OTP associated with the given account or PREP_STMT_FAILED if 
 * it could not be found
 */
function findOTP($accountID)
{
    
    /*Check that statement worked, prepare statement selecting from getOTP 
     * function*/
    if($stmt = mysqli_prepare($link, SQL_GET_OTP)){
        
        /*insert accountID variable to select statement*/
        mysqli_stmt_bind_param($stmt, "s", $account);
        /*execute the query*/
        mysqli_stmt_execute($stmt);
        /*bind the result of the query to the $result variable*/
        mysqli_stmt_bind_result($stmt, $accountOTP);
        /*fetch the result of the query*/
        mysqli_stmt_fetch($stmt);        
            
        /*close the statement*/
        mysqli_stmt_close($stmt);
        
        return $accountOTP;
    }
    else{
        return PREP_STMT_FAILED;
    }
        
}

/**
 * A method to check if the email entered by the user already exists in the 
 * database
 * 
 * @param type $email email entered by the user
 * @return boolean|String true if email is found, false if it is not found, and 
 * PREP_STMT_FAILED if the prepared statement could not execute.
 */
function isEmailRegistered($email) {
    
    $find = findEmail($email);
    
    if($find === NOT_FOUND){
        return false;
    } elseif ($find === PREP_STMT_FAILED){
        return PREP_STMT_FAILED;
    } else {
        return true;
    }    
    
}

/**
 * A method to search for accounts associated with an email address entered by
 * the user
 * 
 * @global type $link the database connection
 * @param type $email the email address entered by the user
 * @return type The result of the statement execution (the account number the 
 * email is associated with or an empty result set) or a message indicating the 
 * failure of execution (PREP_STMT_FAILED)
 */
function findEmail($email)
{
    /*Access the global variable link*/ 
    global $link;
    
    /*Check that statement worked, prepare statement selecting from checkEmail 
     *function*/
    if($stmt = mysqli_prepare($link, SQL_CHECK_EMAIL)){
        /*insert email variable to select statement*/
        mysqli_stmt_bind_param($stmt, "s", $email);
        /*execute the query*/
        mysqli_stmt_execute($stmt);
        /*bind the result of the query to the $result variable*/
        mysqli_stmt_bind_result($stmt, $result);
        /*fetch the result of the query*/
        mysqli_stmt_fetch($stmt);                                    
        /*close the statement*/
        mysqli_stmt_close($stmt);        
        
        /*If sql returns empty result set, indicating not found*/
        if($result == '')
        {
            $result = NOT_FOUND;
        }
        
        return $result;
        /*If statement failed*/
    } else {
        return PREP_STMT_FAILED;
    }
}

/**
 * A method to check if the phone number entered by the user already exists in the 
 * database
 * 
 * @param type $phoneNumber phone number entered by the user
 * @return boolean|String true if phone number is found, false if it is not 
 * found, and PREP_STMT_FAILED if the prepared statement could not execute.
 */
function isPhoneNumberRegistered($phoneNumber) {
    
    $find = findPhoneNumber($phoneNumber);
    
    if($find === NOT_FOUND){
        return false;
    } elseif ($find === PREP_STMT_FAILED){
        return PREP_STMT_FAILED;
    } else {
        return true;
    }    
    
}

/**
 * A method to search for accounts associated with a phone number entered by
 * the user
 * 
 * @global type $link the database connection
 * @param type $phoneNumber the phone number enteredby the user
 * @return type The result of the statement execution (the account number the 
 * phone number is associated with or an empty result set) or a message 
 * indicating the failure of execution (PREP_STMT_FAILED)
 */
function findPhoneNumber($phoneNumber)
{
    /*Access the global variable link*/ 
    global $link;
    
    /*Check that statement worked, prepare statement selecting from checkPhone
     *function*/
    if($stmt = mysqli_prepare($link, SQL_CHECK_PHONE)){
        /*insert email variable to select statement*/
        mysqli_stmt_bind_param($stmt, "s", $phoneNumber);
        /*execute the query*/
        mysqli_stmt_execute($stmt);
        /*bind the result of the query to the $result variable*/
        mysqli_stmt_bind_result($stmt, $result);
        /*fetch the result of the query*/
        mysqli_stmt_fetch($stmt);                                    
        /*close the statement*/
        mysqli_stmt_close($stmt);        
        
        /*If sql returns empty result set, indicating not found*/
        if($result == '')
        {
            $result = NOT_FOUND;
        }
        
        return $result;
        /*If statement failed*/
    } else {
        return PREP_STMT_FAILED;
    }
}


/**
 * method to hash and store the otp in the db
 * 
 * @global type $link the database connection
 * @param type $account the account which the otp is to be associated with
 * @param type $otp the otp in plaintext to be associated with the account
 * @return type returns PREP_STMT_FAILED if the statement failed to execute
 */
function storeOTP($account, $otp) {
 
    /*Access the global variable link*/ 
    global $link;
    
    /*Check that statement worked, prepare statement inserting using storeOTP 
     * function*/
    if($stmt = mysqli_prepare($link, SQL_STORE_OTP)){
        
        /*hash the OTP for storage in database*/
        $hashedOTP = hashOTP($otp);
        
        /*insert account and otp variables to function*/
        mysqli_stmt_bind_param($stmt, "ss", $account, $hashedOTP);
        /*execute the insert*/
        mysqli_stmt_execute($stmt);
        
        /*close the statement*/
        mysqli_stmt_close($stmt);        
        
        /*If statement failed*/
    } else {
        return PREP_STMT_FAILED;
    }
    
}


/**
 * A method to verify if the otp entered by a user is valid for the associated 
 * account
 * @global type $link the database connection
 * @param type $account the accountID of the account that the OTP should be 
 * associated with
 * @param type $userOTP the otp entered by the user
 * @return boolean true if they match, false if it does not, and 
 * PREP_STMT_FAILED if the statement failed to execute.
 */
function isOTPCorrect($account, $userOTP) {
    
    /*Access the global variable link*/ 
    global $link;
    
    $accountOTP = findOTP($accountID);
    
        
        /*Return false for incorrect OTP, true for correct OTP*/
        if(isCorrectHash($userOTP, $accountOTP)){
           return true;
        } else {
            return false;
        }
}

