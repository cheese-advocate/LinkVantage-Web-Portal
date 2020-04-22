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

/* SQL Statements */
define("SQL_ATTEMPT_LOGIN","SELECT validatePassword(?, ?)");
define("SQL_IS_EMAIL_REGISTERED", "SELECT checkEmail(?)");
define("SQL_IS_PHONE_REGISTERED", "SELECT checkPhone(?)");
define("SQL_STORE_OTP", "CALL storeOTP(?)");
define("SQL_VERIFY_OTP", "SELECT verifyOTP(?, ?)");
define("SQL_UPDATE_PASSWORD","CALL updatePassword(?, ?)");
define("SQL_CHECK_COMPANY_NAME","");
define("SQL_CHECK_USERNAME","");
define("SQL_CHECK_EMAIL","");
define("SQL_CHECK_PHONE","");
define("SQL_REGISTER_COMPANY","");
define("SQL_REGISTER_PRIVATE_CLIENT","");

/* Database credentials */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', ''/*'P@ssword1'*/);
define('DB_NAME', 'Chai');

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
    
    /*Check that statement worked, prepare statement selecting from validate password function*/
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
            $result = "Login failed";
        }
            
        /*close the statement*/
        mysqli_stmt_close($stmt);        
        return $result;
        /*If statement failed*/
    } else {
        return "Login Failed";
    }
}


/**
 * Checks if the email entered by the user is in the database
 * 
 * @global type $link the database connection
 * @param type $email the email address entered by the user
 * @return boolean|string true if the email address was found in the database, 
 * false if it was not found, and "Check failed" if the statement failed to execute
 */
function isEmailRegistered($email) {
    
    /*Access the global variable link*/ 
    global $link;
    
    /*Check that statement worked, prepare statement selecting from checkEmail function*/
    if($stmt = mysqli_prepare($link, SQL_CHECK_EMAIL)){
        /*insert email variable to select statement*/
        mysqli_stmt_bind_param($stmt, "s", $email);
        /*execute the query*/
        mysqli_stmt_execute($stmt);
        /*bind the result of the query to the $result variable*/
        mysqli_stmt_bind_result($stmt, $result);
        /*fetch the result of the query*/
        mysqli_stmt_fetch($stmt);
                
        /*Return false when no matching email is found and true when it is*/
        if($result == ''){
            
            $result = false;
            
        } else{
            
            $result = true;
            
        }
            
        /*close the statement*/
        mysqli_stmt_close($stmt);        
        return $result;
        /*If statement failed*/
    } else {
        return "Check Failed";
    }
    
}



function isPhoneRegistered($phoneNumber) {
    
    /*Access the global variable link*/ 
    global $link;
    
    /*Check that statement worked, prepare statement selecting from checkPhone function*/
    if($stmt = mysqli_prepare($link, SQL_CHECK_PHONE)){
        /*insert phoneNumber variable to select statement*/
        mysqli_stmt_bind_param($stmt, "s", $phoneNumber);
        /*execute the query*/
        mysqli_stmt_execute($stmt);
        /*bind the result of the query to the $result variable*/
        mysqli_stmt_bind_result($stmt, $result);
        /*fetch the result of the query*/
        mysqli_stmt_fetch($stmt);
                
        /*Return false when no matching phone is found and true when it is*/
        if($result == ''){
            
            $result = false;
            
        } else{
            
            $result = true;
            
        }
            
        /*close the statement*/
        mysqli_stmt_close($stmt);        
        return $result;
        /*If statement failed*/
    } else {
        return "Check Failed";
    }
    
}



function storeOTP($otp) {
 
    
    
}



function isOTPCorrect($otp) {
    
    
    
}