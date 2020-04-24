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
define("SQL_CHECK_EMAIL", "SELECT checkEmail(?)");
define("SQL_CHECK_PHONED", "SELECT checkPhone(?)");
define("SQL_STORE_OTP", "CALL storeOTP(?)");
define("SQL_VERIFY_OTP", "SELECT verifyOTP(?, ?)");
define("SQL_UPDATE_PASSWORD","CALL updatePassword(?, ?)");
define("SQL_CHECK_COMPANY_NAME","");
define("SQL_CHECK_USERNAME","");
define("SQL_REGISTER_COMPANY","");
define("SQL_REGISTER_PRIVATE_CLIENT","");

/* Database credentials */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', ''/*'P@ssword1'*/);
define('DB_NAME', 'Chai');

/* Other useful constants */
define('PREP_STMT_FAILED', 'Prepared Statement Failed');
define('NOT_FOUND', '');//When account/email/phone number searched for an empty 
//result set returned

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
 * Checks if the login details supplied are valid for an account
 * 
 * @global type $link the database connection
 * @param type $username the username entered by the user
 * @param type $password the password entered  by the user
 * @return string The account number associated with the username and password 
 *  or 'Login failed' if there is none
 */
function attemptLogin($username, $password) {
    /*Access the global variable link*/ 
    global $link;
    
    /*Check that statement worked, prepare statement selecting from validate 
     * password function*/
    if($stmt = mysqli_prepare($link, SQL_ATTEMPT_LOGIN)){
        /*insert username password variables to select statement*/
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        /*execute the query*/
        mysqli_stmt_execute($stmt);
        /*bind the result of the query to the $result variable*/
        mysqli_stmt_bind_result($stmt, $result);
        /*fetch the result of the query*/
        mysqli_stmt_fetch($stmt);
                
        /*Return login failed when no matching acccount is found*/
        if($result == ''){
            $result = NOT_FOUND;
        }
            
        /*close the statement*/
        mysqli_stmt_close($stmt);        
        return $result;
        /*If statement failed*/
    } else {
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
 * 
 * @global type $link
 * @param type $account
 * @param type $otp
 * @return boolean
 */
function isOTPCorrect($account, $otp) {
    
    /*Access the global variable link*/ 
    global $link;
    
    /*Check that statement worked, prepare statement selecting from verify OTP 
     * function*/
    if($stmt = mysqli_prepare($link, SQL_VERIFY_OTP)){
        /*insert username password variables to select statement*/
        mysqli_stmt_bind_param($stmt, "ss", $account, $otp);
        /*execute the query*/
        mysqli_stmt_execute($stmt);
        /*bind the result of the query to the $result variable*/
        mysqli_stmt_bind_result($stmt, $result);
        /*fetch the result of the query*/
        mysqli_stmt_fetch($stmt);
                
        /*Return false for incorrect OTP, true for correct OTP*/
        if($result == 0){
            $result = false;
        } else {
            $result = true;
        }
            
        /*close the statement*/
        mysqli_stmt_close($stmt);        
        return $result;
        /*If statement failed*/
    } else {
        return PREP_STMT_FAILED;
    }
    
}