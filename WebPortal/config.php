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
require_once 'Site.php';
require_once 'Contact.php';
require_once 'Job.php';

/* SQL Statements */
define("SQL_ATTEMPT_LOGIN","SELECT validatePassword(?, ?)");
define("SQL_CHECK_EMAIL", "SELECT checkEmail(?)");
define("SQL_CHECK_PHONE", "SELECT checkPhone(?)");
define("SQL_CHECK_USERNAME", "SELECT checkUsername(?)");
define("SQL_STORE_OTP", "CALL storeOTP(?,?)");
define("SQL_VERIFY_OTP", "SELECT verifyOTP(?, ?)");
define("SQL_GET_PASSWORD", "SELECT getPassword(?)");
define("SQL_GET_OTP", "SELECT getOTP(?)");
define("SQL_UPDATE_PASSWORD","CALL updatePassword(?, ?)");
define("SQL_GET_ACCOUNTID_EMAIL","SELECT getAccountID_Email(?)");
define("SQL_GET_ACCOUNTID_PHONE","SELECT getAccountID_Phone(?)");
define("SQL_GET_ACCOUNTID_USERNAME","SELECT getAccountID(?)");
define("SQL_GET_USERNAME_ACCOUNTID","SELECT getUsername(?)");
define("SQL_ADD_CONTACT","SELECT addContact(?, ?, ?, ?, ?, ?, ?, ?)");
define("SQL_ADD_SITE","SELECT addSite(?, ?, ?, ?, ?, ?)");
define("SQL_GET_CLIENT_ID","SELECT getClientID(?,?)");
define("SQL_CHECK_COMPANY_NAME","");
define("SQL_REGISTER_COMPANY","SELECT companyRegister(?, ?, ?, ?, ?, ?, ?)");
define("SQL_REGISTER_PRIVATE_CLIENT","SELECT clientRegister(?, ?, ?, ?, ?, ?)");
define("SQL_IS_MAIN_CONTACT","SELECT isMainContact(?)");
define("SQL_GET_CONTACT_ID","SELECT getContactID_Account(?)");
define("SQL_GET_TECHNICIAN_ID","SELECT getTecIDFromAccountID(?)");
define("SQL_GET_CLIENT_ID_FROM_CONTACT","SELECT getClientIDFromContactID(?)");
define("SQL_GET_JOB_LIST","CALL jobList(?)");
define("SQL_GET_JOB_DESCRTION","SELECT jobDescription(?)");
define("SQL_GET_JOB_TASK", "CALL jobTask(?)");
define("SQL_GET_JOB_MILESTONECOMPLETE", "CALL jobMilestone(?)");
define("SQL_GET_JOB_SOFTWARE", "CALL softwareRegistry(?)");
define("SQL_GET_JOB_HARDWARE", "CALL hardwareRegistry(?)");
define("SQL_GET_JOB_DETAILS","CALL jobDetailsView(?)");
define("SQL_SET_JOB_PRIORITY","CALL updateJobPriority(?, ?)");
define("SQL_SET_JOB_STATUS","CALL updateJobStatus(?, ?)");
define("SQL_SET_JOB_UPDATED","CALL updateJobUpdate(?, ?)");
define("SQL_ADD_HARDWARE","CALL addHardwareReg(?, ?, ?, ?, ?, ?, ?, ?)");
define("SQL_DROP_HARDWARE","CALL dropHardware(?)");
define("SQL_ADD_SOFTWARE","CALL addSoftwareReg(?, ?, ?, ?, ?, ?, ?)");
define("SQL_DROP_SOFTWARE","CALL dropSoftware(?)");
define("SQL_SET_MILESTONE_END","CALL setMilestoneEnd(?, ?)");
define("SQL_SET_TASK_END","CALL setTaskEnd(?, ?)");
define("SQL_ADD_TASK","CALL addTask(?, ?, ?)");
define("SQL_DROP_TASK","CALL dropTask(?)");

/* Database credentials */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_NAME', 'Chai');
define('DB_PASSWORD', 'P@ssword1');

/* Other useful constants */
define('GENERIC_DB_ERROR', 'A database error has occurred');//Generic database error
define('PREP_STMT_FAILED', 'Prepared Statement Failed');
define('NOT_FOUND', '');//When account/email/phone number searched for an empty 
//result set returned
define('LOGIN_FAILED', 'Login has failed');
define('CLIENT_REGISTRATION_FAILED', 'An error occured when registering the '
        . 'client');//private or company client registration failed
define('CONTACT_ADD_FAILURE','One or more secondary contacts failed to be '
        . 'registered. Please check which Contacts were successfully added on '
        . 'your profile and attempt to add the others again.');
define('SITE_ADD_FAILURE','One or more sites failed to be registered. Please '
        . 'check which Sites were successfully added on your profile and '
        . 'attempt to add the others again.');
define('SITE_CONTACT_ADD_FAILURE','One or more sites and contacts failed to be '
        . 'registered. Please check which Sites and Contacts were successfully '
        . 'added on your profile and attempt to add the others again.');
define('REGISTRATION_SUCCESS', 'Client successfully registered');


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
/*function isUsernameRegistered($username) {
    
    $find = getAccountID($username);
    
    if($find === NOT_FOUND){
        return false;
    } elseif ($find === PREP_STMT_FAILED){
        return PREP_STMT_FAILED;
    } else {
        return true;
    }    
    
}*/

/**
 * method to find the username from a given accountID
 * 
 * @global type $link the database connection
 * @param type $userID
 * @return type the username associated with the $userID, NOT_FOUND if none 
 * was found, or PREP_STMT_FAILED if the statement failed to execute.
 */
function getUsername($userID)
{
    /*Access the global variable link*/ 
    global $link;
    
    /*Check that statement worked, prepare statement selecting from getUsername
     * function*/
    if($stmt = mysqli_prepare($link, SQL_GET_USERNAME_ACCOUNTID)){
        /*insert email variable to select statement*/
        mysqli_stmt_bind_param($stmt, "s", $userID);
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
 * method to find if given username exists
 * 
 * @global type $link the database connection
 * @param type $username the username entered by the user
 * @return type true if the username already exists, false if it was not, or 
 * PREP_STMT_FAILED if the statement failed to execute.
 */
function findUsername($username)
{
    /*Access the global variable link*/ 
    global $link;
    
    /*Check that statement worked, prepare statement selecting from checkUsername 
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
               
        return $result;
        /*If statement failed*/
    } else {
        return PREP_STMT_FAILED;
    }
}

/**
 * method to find if given email exists
 * 
 * @global type $link the database connection
 * @param type $email the phone number enteredby the user
 * @return type The result of the statement execution (the account number the 
 * phone number is associated with or an empty result set) or a message 
 * indicating the failure of execution (PREP_STMT_FAILED)
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
 * method to find if given phone number exists
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
    global $link;
    /*Check that statement worked, prepare statement selecting from getOTP 
     * function*/
    if($stmt = mysqli_prepare($link, SQL_GET_OTP)){
        
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
        
        return $result;
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
/*function isEmailRegistered($email) {
    
    $find = findEmail($email);
    
    if($find === NOT_FOUND){
        return false;
    } elseif ($find === PREP_STMT_FAILED){
        return PREP_STMT_FAILED;
    } else {
        return true;
    }    
    
}*/


/**
 * A method to return the username associated with a given account ID
 * 
 * @global type $link the database connection
 * @param type $username the username of the user
 * @return type The result of the statement execution (The accountID which the 
 * username is associated with or an empty result set) or a message indicating the 
 * failure of execution (PREP_STMT_FAILED)
 */
function getIDFromUsername($username)
{
    /*Access global variable link*/
    global $link;
    
    /*Check that statement worked, prepare statement selecting from getUsername 
     *function*/
    if($stmt = mysqli_prepare($link, SQL_GET_ACCOUNTID_USERNAME)){
        /*insert accountID variable to select statement*/
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
 * A method to check if the phone number entered by the user already exists in the 
 * database
 * 
 * @param type $phoneNumber phone number entered by the user
 * @return boolean|String true if phone number is found, false if it is not 
 * found, and PREP_STMT_FAILED if the prepared statement could not execute.
 */
/*function isPhoneNumberRegistered($phoneNumber) {
    
    $find = findPhoneNumber($phoneNumber);
    
    if($find === NOT_FOUND){
        return false;
    } elseif ($find === PREP_STMT_FAILED){
        return PREP_STMT_FAILED;
    } else {
        return true;
    }    
    
}*/




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
 * method to hash and update user password in database
 * 
 * @global type $link the database connection
 * @param type $account the account which the password is to be associated with
 * @param type $password the password in plaintext to be associated with the account
 * @return type returns PREP_STMT_FAILED if the statement failed to execute
 */
function updatePassword($account, $password) {
 
    /*Access the global variable link*/ 
    global $link;
    
    /*Check that statement worked, prepare statement inserting using storeOTP 
     * function*/
    if($stmt = mysqli_prepare($link, SQL_UPDATE_PASSWORD)){
        
        /*hash the OTP for storage in database*/
        $hashedPassword = hashPassword($password);
        
        /*insert account and otp variables to function*/
        mysqli_stmt_bind_param($stmt, "ss", $account, $hashedPassword);
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
 * @param type $accountID the accountID of the account that the OTP should be 
 * associated with
 * @param type $userOTP the otp entered by the user
 * @return boolean true if they match, false if it does not, and 
 * PREP_STMT_FAILED if the statement failed to execute.
 */
function isOTPCorrect($accountID, $userOTP) {
    
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

/**
 * A function used to register a new company
 * 
 * @global type $link The database connection
 * 
 * @param type $companyName The company name
 * @param type $contacts An array of contacts to add
 * @param type $sites An array of sites to add
 * @return array If client was registered the first slot contains the clientID, 
 * with the second slot containing non-critical errors that occurred. If the 
 * client could not be registered, the first slot will contain  the 
 * CLIENT_REGISTRATION_FAILED error message
 */
function registerCompany($companyName, $contacts, $sites){
    
    /*Finding the main contact associated with the client*/
    $mainContact = $contacts[0]->getMainContact();
    $k=0;
    while(!$mainContact){
        $k++;
        $mainContact = $contacts[$k]->getMainContact;
    }
    
    /*Extracting and preparing the contact variables*/
    $username = $contacts[$i]->getUsername();
    $password = $contacts[$i]->getPassword();
    $firstName = $contacts[$i]->getFirstName();
    $lastName = $contacts[$i]->getLastName();
    $email = $contacts[$i]->getEmail();
    $phoneNumber = $contacts[$i]->getPhoneNumber();
    
    /*hashing the password before storage*/
    $hashedPassword = hashPassword($password);
    
    /*Access the global variable link*/ 
    global $link;
    
    $result = array();
    
    /*Variable to track any database errors that occur*/
    $databaseErr;
    
    /*Variable to track the client ID for the newly registered company*/
    $clientID;
    
    /*Check that statement worked, prepare statement inserting using 
     * companyRegister function*/
    if($stmt = mysqli_prepare($link, SQL_REGISTER_COMPANY)){
        try{
            /*insert variables to function*/
            mysqli_stmt_bind_param($stmt, "sssssss", $username, $hashedPassword, 
                    $firstName, $lastName, $email, $phoneNumber, $companyName);
            /*execute the insert*/
            mysqli_stmt_execute($stmt);
            /*bind the result of the query to the $client variable to get the newly 
             * created clientID*/
            mysqli_stmt_bind_result($stmt, $clientID);
            /*fetch the result of the query*/
            mysqli_stmt_fetch($stmt);
            /*close the statement*/
            mysqli_stmt_close($stmt); 
        } catch (Exception $ex) {
            $databaseErr = $ex->getMessage();
        }                       
        /*If statement failed*/
    } else {
        $databaseErr = PREP_STMT_FAILED;
    }
    
    /*if client was successfully registered*/
    if(!isset($databaseErr)){
        
        $result[0] = $clientID;
        
        /*Creating an array of contacts that are not the main one*/
        $nonMainContacts = array();

        /*copies over all the contacts that are not main, skipping the ones that are*/
        for($i, $j = 0; $i < count($contacts); $i++, $j++){
            if($i!=$k){
                $nonMainContacts[$j] = $contacts[$i]; 
            } else{
                $j--;
            }
        }

        /*Adding the non main contacts*/
        if(!addContacts($nonMainContacts, $clientID)){
            $databaseErr = CONTACT_ADD_FAILURE;
        }
        
        if(!isset($databaseErr)){//if no error with contacts
            if(!addSites($sites, $clientID)){//just an error adding site
                $databaseErr = SITE_ADD_FAILURE;
            }
        } else{//if contact error was encountered
            if(!addSites($sites, $clientID)){//if contact and site error
                $databaseErr = SITE_CONTACT_ADD_FAILURE;
            }
        }
        
        if(isset($databaseErr)){
            $result[1] = $databaseErr;
        }
        
    } else {
        $result[0] = CLIENT_REGISTRATION_FAILED;
    }
    
    return $result;
    
}

/**
 * A function used to register a new client
 * 
 * @global type $link The database connection
 * @param type $contacts An array of contacts to associate with the client
 * @param type $site The site to associate with the private client
 * @return array If client was registered the first slot contains the clientID, 
 * with the second slot containing non-critical errors that occurred. If the 
 * client could not be registered, the first slot will contain  the 
 * CLIENT_REGISTRATION_FAILED error message
 */
function registerPrivateClient($contacts, $site){
    /*Finding the main contact associated with the client*/
    $mainContact = $contacts[0]->getMainContact();
    $k=0;
    while(!$mainContact){
        $k++;
        $mainContact = $contacts[$k]->getMainContact;
    }
    
    /*Extracting and preparing the contact variables*/
    $username = $contacts[$k]->getUsername();
    $password = $contacts[$k]->getPassword();
    $firstName = $contacts[$k]->getFirstName();
    $lastName = $contacts[$k]->getLastName();
    $email = $contacts[$k]->getEmail();
    $phoneNumber = $contacts[$k]->getPhoneNumber();
    
    /*hashing the password before storage*/
    $hashedPassword = hashPassword($password);
    
    /*Access the global variable link*/ 
    global $link;
    
    $result = array();
    
    /*Variable to track any database errors that occur*/
    $databaseErr;
    
    /*Variable to track the client ID for the newly registered company*/
    $clientID;
    
    /*Check that statement worked, prepare statement inserting using 
     * companyRegister function*/
    if($stmt = mysqli_prepare($link, SQL_REGISTER_PRIVATE_CLIENT)){
        
        try{
            /*insert variables to function*/
            mysqli_stmt_bind_param($stmt, "ssssss", $username, $hashedPassword, 
                    $firstName, $lastName, $email, $phoneNumber);
            /*execute the insert*/
            mysqli_stmt_execute($stmt);
            /*bind the result of the query to the $client variable to get the newly 
             * created clientID*/
            mysqli_stmt_bind_result($stmt, $clientID);
            /*fetch the result of the query*/
            mysqli_stmt_fetch($stmt);
            /*close the statement*/
            mysqli_stmt_close($stmt);
        } catch (Exception $ex) {
            $databaseErr = $ex->getMessage();
        }                
        
        /*If statement failed*/
    } else {
        $databaseErr = PREP_STMT_FAILED;
    }
     
    if(!isset($databaseErr)){
        
        $result[0] = $clientID;
        
        /*Creating an array of contacts that are not the main one*/
        $nonMainContacts = array();

        /*copies over all the contacts that are not main, skipping the ones that are*/
        for($i = 0, $j = 0; $i < count($contacts); $i++, $j++){
            if($i!=$k){
                $nonMainContacts[$j] = $contacts[$i]; 
            } else{
                $j--;
            }
        }

        /*Adding the non main contacts*/
        if(!addContacts($nonMainContacts, $clientID)){
            $databaseErr = CONTACT_ADD_FAILURE;
        }
        
        $sites = array($site);
        
        if(!isset($databaseErr)){//if no error with contacts
            if(!addSites($sites, $clientID)){//just an error adding site
                $databaseErr = SITE_ADD_FAILURE;
            }
        } else{//if contact error was encountered
            if(!addSites($sites, $clientID)){//if contact and site error
                $databaseErr = SITE_CONTACT_ADD_FAILURE;
            }
        }
        
        /*If contacts and/or sites failed to be added*/
        if(isset($databaseErr)){
            $result[1] = $databaseErr;
        }
        
    } else{
        $result[0] = CLIENT_REGISTRATION_FAILED;
    }
    
    return $result;
}

/**
 * A function for getting the clientID using the email and phoneNumber of the 
 * main contact
 * 
 * @global type $link The database connection
 * @param type $email The email address of the main contact for the client
 * @param type $phoneNumber The phone number of the main contact for the client
 * @return type The result of the statement execution (the clientID the 
 * email and phone number is associated with or an empty result set) or a message 
 * indicating the failure of execution (PREP_STMT_FAILED)
 */
function getClientID($email, $phoneNumber){
    /*Access global variable link*/
    global $link;
    
    /*Check that statement worked, prepare statement selecting from getUsername 
     *function*/
    if($stmt = mysqli_prepare($link, SQL_GET_CLIENT_ID)){
        /*insert email and phoneNumber variables to select statement*/
        mysqli_stmt_bind_param($stmt, "ss", $email, $phoneNumber);
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
 * A function to create contacts and associate them with a client
 * 
 * @global type $link The database connection
 * @param type $contacts An array of contacts to add to the database
 * @param type $clientID The client which the contacts are associated with
 * @return boolean True if executed successfully, false if failed
 */
function addContacts($contacts, $clientID){
    /*Access the global variable link*/ 
    global $link;    
    
    /*Variable to track any database errors that occur*/
    $databaseErr;
    
    $result = true;
    
    for($i=0; $i < count($contacts); $i++){
        $username = $contacts[$i]->getUsername();
        $password = $contacts[$i]->getPassword();
        $firstName = $contacts[$i]->getFirstName();
        $lastName = $contacts[$i]->getLastName();
        $email = $contacts[$i]->getEmail();
        $phoneNum = $contacts[$i]->getPhoneNumber();
        
        /*hashing the password before storage*/
        $hashedPassword = hashPassword($password);
        
        /*Check that statement worked, prepare statement inserting using addSite
        * function*/
        if($stmt = mysqli_prepare($link, SQL_ADD_CONTACT)){        

            try{
                /*insert account and otp variables to function*/
                mysqli_stmt_bind_param($stmt, "ssssssss", $username, $hashedPassword, 
                        $firstName, $lastName, $email, $phoneNum, $clientID);

                /*execute the insert*/
                mysqli_stmt_execute($stmt);
                /*bind the result of the query to the $result variable*/
                mysqli_stmt_bind_result($stmt, $result[$i]);
                /*fetch the result of the query*/
                mysqli_stmt_fetch($stmt);                                    
                /*close the statement*/
                mysqli_stmt_close($stmt);                                         
            } catch (Exception $ex) {
                $databaseErr = $ex->getMessage();
            }
                
            /*If statement failed*/
        } else {
            $databaseErr = PREP_STMT_FAILED;
        }
        
        if(isset($databaseErr)){
            $result = false;
        }
        
        return $result;
    }
}

/**
 * A function to create sites and associate them with a client
 * 
 * @global type $link The database connection
 * @param type $sites An array of sites to add to the database
 * @param type $clientID The client which the sites are associated with
 * @return boolean True if executed successfully, false if failed
 */
function addSites($sites, $clientID){
    /*Access the global variable link*/ 
    global $link;
    
    /*Variable to track any database errors that occur*/
    $databaseErr;
    
    $siteIDs = array();
    $result = true;
    
    for($i=0; $i < count($sites); $i++){
        $streetNum = $sites[$i]->getStreetNum();
        $streetName = $sites[$i]->getStreetName();
        $suburbCity = $sites[$i]->getSuburbCity();
        $postalCode = $sites[$i]->getPostalCode();
        $addInfo = $sites[$i]->getAddInfo();
        $mainSite = $sites[$i]->getMainSite();
        
        /*Check that statement worked, prepare statement inserting using addSite
        * function*/
        if($stmt = mysqli_prepare($link, SQL_ADD_SITE)){        
            
            try{
                /*insert account and otp variables to function*/
                mysqli_stmt_bind_param($stmt, "ssssss", $streetNum, $streetName, 
                        $suburbCity, $postalCode, $addInfo, $clientID);

                /*execute the insert*/
                mysqli_stmt_execute($stmt);
                /*bind the result of the query to the $result variable*/
                mysqli_stmt_bind_result($stmt, $siteIDs[$i]);
                /*fetch the result of the query*/
                mysqli_stmt_fetch($stmt);                                    
                /*close the statement*/
                mysqli_stmt_close($stmt);                         
                
            } catch (Exception $ex) {
                $databaseErr = $ex->getMessage();
            }            

            /*If statement failed*/
        } else {
            $databaseErr = PREP_STMT_FAILED;
        }
        
        if(isset($databaseErr)){
            $result = false;
        }
        
        return $result;
        
    }
}    
    
/**
 * A function to check if the contact associated with the given accountID 
 * is a main account
 * 
 * @global type $link The database connection
 * @param type $accountID The accountID to check for being a main contact
 * @return type If sql executed successfully, then a boolean indicating 
 * whether or not it is a main account(true if it is, false if it is not).
 * It will return GENERIC_DB_ERROR if a database error occurred
 */
function isMainContact($accountID){
    /*Access the global variable link*/ 
    global $link;

    /*variable to store result of sql execution*/
    $result;

    /*variable to store information about database errors*/
    $databaseErr;

    /*Check that statement worked, prepare statement selecting from the
     * isMainContact function*/
    if($stmt = mysqli_prepare($link, SQL_IS_MAIN_CONTACT)){
        try{
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
        } catch (Exception $ex) {
            /*Record the error for debuggin purposes*/
            $databaseErr = $ex->getMessage();
        }

        /*If statement failed*/
    } else {
        $databaseErr = PREP_STMT_FAILED;
    }

    /*If an error occurred during the sql execution*/
    if(isset($databaseErr)){
        return GENERIC_DB_ERROR;
    } else{ //if sql executed without error
        return $result;            
    }
}

/**
 * A function to set the contactID session variable or technicianID session
 * with the contactID or tecID associated with given accountID
 * 
 * @param type $accountID The accountID to check
 */
function setTechnicianContactID($accountID){

    $databaseErr;

    $tecIDCheck;
    $contactIDCheck = getContactIDFromAccount($accountID);

    
    
    if($contactIDCheck === NOT_FOUND){
        $tecIDCheck = getTechnicianIDFromAccount($accountID);            
    } else if($contactIDCheck === GENERIC_DB_ERROR){
        $databaseErr = GENERIC_DB_ERROR;
        $tecIDCheck = getTechnicianIDFromAccount($accountID);
    } else{
        $_SESSION['contactID'] = $contactIDCheck;
    }

    if(isset($tecIDCheck)){
        if($tecIDCheck === NOT_FOUND){

        } else if($tecIDCheck === GENERIC_DB_ERROR){
            $databaseErr = GENERIC_DB_ERROR;
        } else{
            $_SESSION['technicianID'] = $tecIDCheck;
        }
    }
}

/**
 * A function to set the clientID session variable to the clientID 
 * associated with the given contactID
 *
 * @global type $link The database connection
 * @param type $contactID The contactID to check
 */
function setClientID($contactID){
    /*Access the global variable link*/ 
    global $link;

    /*variable to store result of sql execution*/
    $result;

    /*variable to store information about database errors*/
    $databaseErr;

    /*Check that statement worked, prepare statement selecting from the
     * getClientIDFromContactID function*/
    if($stmt = mysqli_prepare($link, SQL_GET_CLIENT_ID_FROM_CONTACT)){
        try{
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

        } catch (Exception $ex) {
            /*Record the error for debuggin purposes*/
            $databaseErr = $ex->getMessage();
        }

        /*If statement failed*/
    } else {
        $databaseErr = PREP_STMT_FAILED;
    }

    /*If an error did not occur during the sql execution*/
    if(!isset($databaseErr)){
        if($result !== NOT_FOUND){
            $_SESSION['clientID'] = $result;
        }
    }
}

/**
 * A function to return a contactID associated with the given accountID
 * 
 * @global type $link The database connection
 * @param type $accountID The accountID to check
 * @return type The contactID if one is found, NOT_FOUND if one is not found
 *  or GENERIC_DATABASE_ERROR if an error occurs
 */
function getContactIDFromAccount($accountID){
    /*Access the global variable link*/ 
    global $link;

    /*variable to store result of sql execution*/
    $result;

    /*variable to store information about database errors*/
    $databaseErr;

    /*Check that statement worked, prepare statement selecting from the
     * getContactID function*/
    if($stmt = mysqli_prepare($link, SQL_GET_CONTACT_ID)){
        try{
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

        } catch (Exception $ex) {
            /*Record the error for debuggin purposes*/
            $databaseErr = $ex->getMessage();
        }

        /*If statement failed*/
    } else {
        $databaseErr = PREP_STMT_FAILED;
    }       

    /*If an error occurred during the sql execution*/
    if(isset($databaseErr)){
        return GENERIC_DB_ERROR;
    } else{ //if sql executed without error
        return $result;            
    }
}

/**
 * A function to return a tecID associated with the given accountID
 * 
 * @global type $link The database connection
 * @param type $accountID The accountID to check
 * @return type The tecID if one is found, NOT_FOUND if one is not found or
 * GENERIC_DATABASE_ERROR if an error occurs
 */
function getTechnicianIDFromAccount($accountID){
    /*Access the global variable link*/ 
    global $link;

    /*variable to store result of sql execution*/
    $result;

    /*variable to store information about database errors*/
    $databaseErr;

    /*Check that statement worked, prepare statement selecting from the
     * getTecIDFromAccountID function*/
    if($stmt = mysqli_prepare($link, SQL_GET_TECHNICIAN_ID)){
        try{
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

        } catch (Exception $ex) {
            /*Record the error for debuggin purposes*/
            $databaseErr = $ex->getMessage();
        }

        /*If statement failed*/
    } else {
        $databaseErr = PREP_STMT_FAILED;
    }

    /*If an error occurred during the sql execution*/
    if(isset($databaseErr)){
        return GENERIC_DB_ERROR;
    } else{ //if sql executed without error
        return $result;            
    }
}

function getJobList($accountID)
{
    /*Access the global variable link*/ 
    global $link;
    
    $result = mysqli_query($link,"CALL jobList('".$accountID."');") or die("Query fail: " . mysqli_error($link));

    //loop through the output and echo
    while ($row = mysqli_fetch_array($result)){   
        Echo "<tr><td>" . $row["ID"] . "</td><td>" . $row["jobDescription"] . "</td><td>" . $row["category"] . "</td><td>" . $row["cName"] . "</td><td>" . $row["priority"] . "</td><td>" . $row["dueDate"] . "</td><td>" . $row["jobStatus"] . "</td><td>" . $row["updated"] . "</td><td>" . $row["startDate"] . "</td></tr>";
        $_SESSION["defaultJobID"]=$row["ID"];
    }
    //free resources
    mysqli_free_result($result);
    $link->next_result();
}

function getJobDetails($jobID)
{
    /*Access the global variable link*/ 
    global $link;
    
    $result = mysqli_query($link,"CALL jobDetailsView('". $jobID ."');") or die("Query fail: " . mysqli_error($link));
    
    Echo '<table id="jobDetails">';
    //loop through the output and echo
    while ($row = mysqli_fetch_array($result)){
        //priority
        if ($row["@priorityOut"]=="Urgent"){
            $priority1= '<option value="Urgent" class="red" selected="selected">Urgent</option>';
            $priorityColor=".red";
        } else {
            $priority1= '<option value="Urgent" class="red">Urgent</option>';
        }

        if ($row["@priorityOut"]=="High"){
            $priority2= '<option value="High" class="orange" selected="selected">High</option>';
            $priorityColor=".orange";
        } else {
            $priority2='<option value="High" class="orange">High</option>';
        }

        if ($row["@priorityOut"]=="Medium"){
            $priority3= '<option value="Medium" class="yelow" selected="selected">Medium</option>';
            $priorityColor=".yelow";
        } else {
            $priority3='<option value="Medium" class="yelow">Medium</option>';
        }

        if ($row["@priorityOut"]=="Low"){
            $priority4= '<option value="Low" class="green" selected="selected">Low</option>';
            $priorityColor=".green";
        } else {
            $priority4='<option value="Low" class="green">Low</option>';
        }
        
        //Status
        if ($row["@statusOut"]=="In progress"){
            $status1= '<option value="In progress" class="green" selected="selected">In progress</option>';
            $statusColor=".green";
        } else {
            $status1= '<option value="In progress" class="green">In progress</option>';
        }

        if ($row["@statusOut"]=="Waiting on client"){
            $status2= '<option value="Waiting on client" class="yelow" selected="selected">Waiting on client</option>';
            $statusColor=".yelow";
        } else {
            $status2='<option value="Waiting on client" class="yelow">Waiting on client</option>';
        }
        
        if ($row["@statusOut"]=="Preparing"){
            $status3= '<option value="Preparing" class="orange" selected="selected">Preparing</option>';
            $statusColor=".orange";
        } else {
            $status3='<option value="Preparing" class="orange">Preparing</option>';
        }

        if ($row["@statusOut"]=="Not started"){
            $status4= '<option value="Not started" class="red" selected="selected">Not started</option>';
            $statusColor=".red";
        } else {
            $status4='<option value="Not started" class="red">Not started</option>';
        }
        
        Echo "<tr><td>" . $row["jobID"] . "</td><td>" . '<select id="jobPriority" name="priority" class="'.$priorityColor.'">'. $priority1 . $priority2 . $priority3 . $priority4 . '</select>' . "</td><td>" . '<select id="jobStatus" name="status" class="'.$statusColor.'">'. $status1 . $status2 . $status3 . $status4 . '</select>' . "</td><td>" . $row["@cNameOut"] . "</td><td>" . $row["@cLocationOut"] . "</td><td>" . $row["@categoryOut"] . "</td><td>" . $row["@dueDateOut"] . "</td></tr>";
    }
    Echo"</table>";
    //free resources
    mysqli_free_result($result);
    $link->next_result();
}

function getJobTask($jobID)
{
    /*Access the global variable link*/ 
    global $link;
    
    $result = mysqli_query($link,"CALL jobTask('".$jobID."');") or die("Query fail: " . mysqli_error($link));

    Echo "<table>";
    //loop through the output and echo
    while ($row = mysqli_fetch_array($result)){   
        If ($row["taskEnd"]==""){
            Echo "<tr><td>" . '<input type="checkbox" onchange="setTaskCheck(this)" id="' . $row["taskID"] . '" >' . "</td><td>" . $row["taskDescription"] . "</td><td>" . '<a id="' . $row["taskID"] . '" onclick="dropTask(this)" href=""> <img src="images/cross.png" class="itemRemoveImg" /> </a>' . "</td></tr>";
        } else {
            Echo "<tr><td>" . '<input type="checkbox" onchange="setTaskCheck(this)" id="' . $row["taskID"] . '"  checked="true">' . "</td><td>" . $row["taskDescription"] . "</td><td>" . '<a id="' . $row["taskID"] . '" onclick="dropTask(this)" href=""> <img src="images/cross.png" class="itemRemoveImg" /> </a>' . "</td></tr>";
        }
    }
    Echo"</table>";
    //free resources
    mysqli_free_result($result);
    $link->next_result();
}
    
function getJobMilestone($jobID)
{
    /*Access the global variable link*/ 
    global $link;
    
    $result = mysqli_query($link,"CALL jobMilestone('".$jobID."');") or die("Query fail: " . mysqli_error($link));

    Echo "<table>";
    //loop through the output and echo
    while ($row = mysqli_fetch_array($result)){   
        If ($row["mcDate"]==""){
            Echo "<tr><td>" . $row["msName"] . "</td><td>" . '<input type="checkbox" id="' . $row["mcID"] . '" onchange="setMilestoneCheck(this)">' . "</td></tr>";
        } else {
            Echo "<tr><td>" . $row["msName"] . "</td><td>" . '<input type="checkbox" id="' . $row["mcID"] . '" onchange="setMilestoneCheck(this)" checked="true">' . "</td></tr>";
        }
    }
    Echo"</table>";
    //free resources
    mysqli_free_result($result);
    $link->next_result();
}

function getSoftwareReg($jobID)
{
    /*Access the global variable link*/ 
    global $link;
    
    $result = mysqli_query($link,"CALL softwareRegistry('".$jobID."');") or die("Query fail: " . mysqli_error($link));
    
    //loop through the output and echo
    while ($row = mysqli_fetch_array($result)){   
        Echo "<tr><td>" . $row["eqDescription"] . "</td><td>" . $row["supplier"] . "</td><td>" . $row["eqValue"] . "</td><td>" . $row["subscriptionEnd"] . "</td><td>" . $row["procurementDate"] . "</td><td>" . $row["deliveryDate"] . "</td><td>" . '<a id="'. $row["equipmentID"] .'" href=""  onclick="dropSoftwareReg(this)"> <img src="images/cross.png" class="itemRemoveImg" /> </a>' . "</td></tr>";
    }
    //free resources
    mysqli_free_result($result);
    $link->next_result();
}

function getHardwareReg($jobID)
{
    /*Access the global variable link*/ 
    global $link;
    
    $result = mysqli_query($link,"CALL hardwareRegistry('".$jobID."');") or die("Query fail: " . mysqli_error($link));
    
    //loop through the output and echo
    while ($row = mysqli_fetch_array($result)){   
        Echo "<tr><td>" . $row["eqDescription"] . "</td><td>" . $row["supplier"] . "</td><td>" . $row["eqValue"] . "</td><td>" . $row["warrantyInitation"] . "</td><td>" . $row["warrantyExpiration"] . "</td><td>" . $row["procurementDate"] . "</td><td>" . $row["deliveryDate"] . "</td><td>" . '<a id="'. $row["equipmentID"] .'" href="" onclick="dropHardwareReg(this)"> <img src="images/cross.png" class="itemRemoveImg" /> </a>' . "</td></tr>";
    }
    //free resources
    mysqli_free_result($result);
    $link->next_result();
}

function getJobUpdate($jobID)
{
    /*Access the global variable link*/ 
    global $link;
    
    $result = mysqli_query($link,"CALL jobUpdate('".$jobID."');") or die("Query fail: " . mysqli_error($link));
    
    //loop through the output and echo
    while ($row = mysqli_fetch_array($result)){   
        Echo "<tr><td>" . $row["mcDate"] . "</td><td>" . $row["msName"] . "</td><td>" . $row["clientFeed"] . "</td><td>" . $row["tecFeed"] . "</td></tr>";
    }
    //free resources
    mysqli_free_result($result);
    $link->next_result();
}

function getJobDescription($jobID)
{
    /*Access the global variable link*/ 
    global $link;
    
    /*Check that statement worked, prepare statement selecting from getJobDescription
     * function*/
    if($stmt = mysqli_prepare($link, SQL_GET_JOB_DESCRTION)){
        /*insert email variable to select statement*/
        mysqli_stmt_bind_param($stmt, "s", $jobID);
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

function setMilestoneEnd($mcID, $mcDate) {
 
    /*Access the global variable link*/ 
    global $link;
    
    /*Check that statement worked, prepare statement inserting using storeOTP 
     * function*/
    if($stmt = mysqli_prepare($link, SQL_SET_MILESTONE_END)){
        
        /*insert account and otp variables to function*/
        mysqli_stmt_bind_param($stmt, "ss", $mcID, $mcDate);
        /*execute the insert*/
        mysqli_stmt_execute($stmt);
        
        /*close the statement*/
        mysqli_stmt_close($stmt);        
        
        /*If statement failed*/
    } else {
        return PREP_STMT_FAILED;
    }
    
}

function addTask($taskDescription, $taskStart, $jobID) {
 
    /*Access the global variable link*/ 
    global $link;
    
    /*Check that statement worked, prepare statement inserting using storeOTP 
     * function*/
    if($stmt = mysqli_prepare($link, SQL_ADD_TASK)){
        
        /*insert account and otp variables to function*/
        mysqli_stmt_bind_param($stmt, "sss", $taskDescription, $taskStart, $jobID);
        /*execute the insert*/
        mysqli_stmt_execute($stmt);
        
        /*close the statement*/
        mysqli_stmt_close($stmt);        
        
        /*If statement failed*/
    } else {
        return PREP_STMT_FAILED;
    }
    
}





function setTaskEnd($taskID, $taskEnd) {
 
    /*Access the global variable link*/ 
    global $link;
    
    /*Check that statement worked, prepare statement inserting using storeOTP 
     * function*/
    if($stmt = mysqli_prepare($link, SQL_SET_TASK_END)){
        
        /*insert account and otp variables to function*/
        mysqli_stmt_bind_param($stmt, "ss", $taskID, $taskEnd);
        /*execute the insert*/
        mysqli_stmt_execute($stmt);
        
        /*close the statement*/
        mysqli_stmt_close($stmt);        
        
        /*If statement failed*/
    } else {
        return PREP_STMT_FAILED;
    }
    
}


function dropTask($taskID) {
 
    /*Access the global variable link*/ 
    global $link;
    
    /*Check that statement worked, prepare statement inserting using storeOTP 
     * function*/
    if($stmt = mysqli_prepare($link, SQL_DROP_TASK)){
        
        /*insert account and otp variables to function*/
        mysqli_stmt_bind_param($stmt, "s", $taskID);
        /*execute the insert*/
        mysqli_stmt_execute($stmt);
        
        /*close the statement*/
        mysqli_stmt_close($stmt);        
        
        /*If statement failed*/
    } else {
        return PREP_STMT_FAILED;
    }
    
}

function addHardware($eqDescription, $eqValue, $deliveryDate, $procurementDate, $supplier, $warrantyInitation, $warrantyExpiration, $jobID) {
 
    /*Access the global variable link*/ 
    global $link;
    
    /*Check that statement worked, prepare statement inserting using storeOTP 
     * function*/
    if($stmt = mysqli_prepare($link, SQL_ADD_HARDWARE)){
        
        /*insert account and otp variables to function*/
        mysqli_stmt_bind_param($stmt, "ssssssss", $eqDescription, $eqValue, $deliveryDate, $procurementDate, $supplier, $warrantyInitation, $warrantyExpiration, $jobID);
        /*execute the insert*/
        mysqli_stmt_execute($stmt);
        
        /*close the statement*/
        mysqli_stmt_close($stmt);   
        
    }
    
}

function dropHardware($equipmentID) {
 
    /*Access the global variable link*/ 
    global $link;
    
    /*Check that statement worked, prepare statement inserting using storeOTP 
     * function*/
    if($stmt = mysqli_prepare($link, SQL_DROP_HARDWARE)){
        
        /*insert account and otp variables to function*/
        mysqli_stmt_bind_param($stmt, "s", $equipmentID);
        /*execute the insert*/
        mysqli_stmt_execute($stmt);
        
        /*close the statement*/
        mysqli_stmt_close($stmt);        
        
        /*If statement failed*/
    } else {
        return PREP_STMT_FAILED;
    }
    
}

function addSoftware($eqDescription, $eqValue, $deliveryDate, $procurementDate, $supplier, $subscriptionEnd, $jobID) {
 
    /*Access the global variable link*/ 
    global $link;
    
    /*Check that statement worked, prepare statement inserting using storeOTP 
     * function*/
    if($stmt = mysqli_prepare($link, SQL_ADD_SOFTWARE)){
        
        /*insert account and otp variables to function*/
        mysqli_stmt_bind_param($stmt, "sssssss", $eqDescription, $eqValue, $deliveryDate, $procurementDate, $supplier, $subscriptionEnd, $jobID);
        /*execute the insert*/
        mysqli_stmt_execute($stmt);
        
        /*close the statement*/
        mysqli_stmt_close($stmt);      
        
    }
    
}

function dropSoftware($equipmentID) {
 
    /*Access the global variable link*/ 
    global $link;
    
    /*Check that statement worked, prepare statement inserting using storeOTP 
     * function*/
    if($stmt = mysqli_prepare($link, SQL_DROP_SOFTWARE)){
        
        /*insert account and otp variables to function*/
        mysqli_stmt_bind_param($stmt, "s", $equipmentID);
        /*execute the insert*/
        mysqli_stmt_execute($stmt);
        
        /*close the statement*/
        mysqli_stmt_close($stmt);        
        
        /*If statement failed*/
    } else {
        return PREP_STMT_FAILED;
    }
    
}

function setJobStatus($jobID, $jobStatus) {
 
    /*Access the global variable link*/ 
    global $link;
    
    /*Check that statement worked, prepare statement inserting using storeOTP 
     * function*/
    if($stmt = mysqli_prepare($link, SQL_SET_JOB_STATUS)){
        
        /*insert account and otp variables to function*/
        mysqli_stmt_bind_param($stmt, "ss", $jobID, $jobStatus);
        /*execute the insert*/
        mysqli_stmt_execute($stmt);
        
        /*close the statement*/
        mysqli_stmt_close($stmt);        
        
        /*If statement failed*/
    } else {
        return PREP_STMT_FAILED;
    }
}

function setJobPriority($jobID, $jobPriority) {
 
    /*Access the global variable link*/ 
    global $link;
    
    /*Check that statement worked, prepare statement inserting using storeOTP 
     * function*/
    if($stmt = mysqli_prepare($link, SQL_SET_JOB_PRIORITY)){
        
        /*insert account and otp variables to function*/
        mysqli_stmt_bind_param($stmt, "ss", $jobID, $jobPriority);
        /*execute the insert*/
        mysqli_stmt_execute($stmt);
        
        /*close the statement*/
        mysqli_stmt_close($stmt);        
        
        /*If statement failed*/
    } else {
        return PREP_STMT_FAILED;
    } 
}

function setJobUpdated($jobID, $jobUpdateDate) {
 
    /*Access the global variable link*/ 
    global $link;
    
    /*Check that statement worked, prepare statement inserting using storeOTP 
     * function*/
    if($stmt = mysqli_prepare($link, SQL_SET_JOB_UPDATED)){
        
        /*insert account and otp variables to function*/
        mysqli_stmt_bind_param($stmt, "ss", $jobID, $jobUpdateDate);
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
 * Receives no parameters and gets all Client IDs from the database
 *  and returns them in a 1D array
 * 
 * @global type $link
 * @return type Array of Client IDs
 */
function getAllClientIDs()
{
    global $link;
    
    $result = $link->query("SELECT clientID FROM Clients LEFT JOIN Company USING (clientID);");
    $ids = array();
    
    if($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            $ids[] = $row;
        }
    }
    
    return $ids;
}

function getClientCount()
{
    global $link;
    
    $result = $link->query("SELECT * FROM Clients;");
    $count = 0;
    
    if($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            $count++;
        }
    }
    
    return $count;
}

function getJobCount()
{
    global $link;
    
    $result = $link->query("SELECT * FROM Job;");
    $count = 0;
    
    if($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            $count++;
        }
    }
    
    return $count;
}

function getCompanyCount()
{
    global $link;
    
    $result = $link->query("SELECT * FROM Company;");
    $count = 0;
    
    if($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            $count++;
        }
    }
    
    return $count;
}

function getJobsFromClientID($clientID)
{
    /*Access the global variable link*/ 
    global $link;
    
    $result = mysqli_query($link,"SELECT * FROM Job WHERE clientID = '".$clientID."';") or die("Query fail: " . mysqli_error($link));
    
    $jobs = array();
    $i = 0;
    
    //loop through the output and echo
    while ($row = mysqli_fetch_array($result)){   
        $job = new Job($row);
        $jobs[$i] = $job;
        $i++;
    }
    
    //free resources
    mysqli_free_result($result);
    $link->next_result();
    
    return $jobs;
}

function getTechnicianName($tecID)
{
    /*Access the global variable link*/ 
    global $link;
    
    $result = mysqli_query($link,"SELECT CONCAT(tecName, ' ', tecSurname) FROM Techncian WHERE tecID = '".$tecID."';") or die("Query fail: " . mysqli_error($link));
    
    $technicianName = mysqli_fetch_field($result);
    
    //free resources
    mysqli_free_result($result);
    $link->next_result();
    
    return $technicianName;
}

function getAppraisal($jobID){
     /*Access the global variable link*/ 
    global $link;
    
    $result = mysqli_query($link,"CALL jobAppraisal('".$jobID."');") or die("Query fail: " . mysqli_error($link));
    
    $row = mysqli_fetch_array($result);
            
    $rating = $row['rating'];    
    $feedback = $row['content'];    
    
    $appraisal = new Appraisal($rating, $feedback);
    
    //free resources
    mysqli_free_result($result);
    $link->next_result();
    
    return $appraisal;
}

function getCompletedMilestonesClient($jobID){
    /*Access the global variable link*/ 
    global $link;
    
    $result = mysqli_query($link,"CALL jobUpdate('".$jobID."');") or die("Query fail: " . mysqli_error($link));
    
    $updates = array();
    $i = 0;
    while ($row = mysqli_fetch_array($result)){   
        $update = new Update($row["msName"], $row["mcDate"], $row["clientFeed"], '');
        $updates[$i] = $update;
        $i++;
    }
    //free resources
    mysqli_free_result($result);
    $link->next_result();
    
    return  $updates;
}

?>