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



function attemptLogin($username, $password) {
    
    $result = "";
    try{
        
        global $link;
        $stmt = mysqli_prepare($link, SQL_ATTEMPT_LOGIN);
        $stmt->mysqli_bind_param($stmt, "sss", $username, $password);
        $stmt->execute();
        $stmt->storeResult();        
        $stmt->bind_result($result);
        $stmt->fetch();
        $stmt->close;
        
    } catch (Exception $ex) {
        
        error_log("Login failed");
        $result = "Login failed";
    }
    
    return $result;
}



function isEmailRegistered($email) {
    
    
    
}



function isPhoneRegistered($phoneNumber) {
    
    
    
}



function storeOTP($otp) {
 
    
    
}



function isOTPCorrect($otp) {
    
    
    
}