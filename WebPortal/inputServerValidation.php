<?php

/* 
 * Dedicated server validation PHP, to be included wherever server-side validation occurs.
 * 
 * @author Tristan Ackermann
 * 
 * Todo:
 * 
 * • Correct invalid variable codes
 * • isParamXValid() methods
 * • Regex
 * 
 * NOTE: • is achieved with ALT + NUM7.
 */

require_once 'config.php';

/* Constant Variable Declaration */
define("ERR_EMPTY_COMPANY_NAME","Please enter your company name.");
define("ERR_EMPTY_OTP","Please enter your OTP.");
define("ERR_EMPTY_PASSWORD","Please enter your password.");
define("ERR_EMPTY_PHONE_NUMBER","Please enter your phone number.");
define("ERR_EMPTY_USERNAME","Please enter your username.");

define("ERR_INCORRECT_OTP","Wrong OTP. Please try again.");

define("ERR_INVALID_COMPANY_NAME","Invalid company name.");
define("ERR_INVALID_PASSWORD","Invalid Password.");
define("ERR_INVALID_PHONE_NUMBER","Please enter 10 digits as your phone number.");
define("ERR_INVALID_USERNAME","Invalid username.");

define("ERR_NO_ERRORS","");

define("ERR_PASSWORD_MISMATCH","Your passwords do not match.");

define("REGEX_COMPANY_NAME", "");
define("REGEX_EMAIL", "");
define("REGEX_FIRST_NAME", "");
define("REGEX_LAST_NAME", "");
define("REGEX_PASSWORD", "");
define("REGEX_PHONE", "");
define("REGEX_USERNAME", "");
define("REGEX_STREET_NUM", "");
define("REGEX_POSTAL_CODE", "");



/**
 * Validates the given company name.
 * 
 * @param String $companyName
 * @return String The validation error message, an empty string if input is valid.
 */
function validateCompanyName($companyName) {
    
    $companyName = trim($companyName);
    
    if (empty($companyName)) {
        
        return ERR_EMPTY_COMPANY_NAME;
        
    } elseif (isCompanyNameValid($companyName)) {
        
        return ERR_INVALID_COMPANY_NAME;
        
    } else {
        
        return ERR_NO_ERRORS;
        
    }
    
}

function isCompanyNameValid($companyName) {
    
    $reggex = "/^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,}$/";  
    if (preg_match($reggex, $companyName))
    {
       return true; 
    }
    else
    {
        return false;
    }
    
}

function validateUserName($username) {
    
    if (empty($username)) {
        
        return ERR_EMPTY_USERNAME;
        
    } elseif (isCompanyNameValid($username)) {
        
        return ERR_INVALID_USERNAME;
        
    } else {
        
        return ERR_NO_ERRORS;
        
    }
    
}

function validatePasswords($password, $confirmPassword) {
    
    return validatePassword($password).validateConfirmedPassword($password, $confirmPassword);
    
}

function validatePassword($password) {
    
    $reggex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/";
    if(preg_match($reggex, $password))
    {
        return true;
    }
    else
    {
        return false;
    }
    
}

function validateConfirmedPassword($password, $confirmPassword) {
    
    if ($password !== $confirmPassword) {
        
        return ERR_PASSWORD_MISMATCH;
        
    } else {
        
        return ERR_NO_ERRORS;
        
    }
}

function validateEmail($emailAddress)
{
    
    $reggex = "/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/";
    
    if(preg_match($reggex, $emailAddress))
    {
        return true;
    }
    else
        {
        return false;
    }
}

function validatePhone($phoneNumber) {
    
    $reggex = "/0((60[3-9]|64[0-5]|66[0-5])\d{6}|(7[1-4689]|6[1-3]|8[1-4])\d{7})/";
    
    if (preg_match($reggex, $phoneNumber)) 
    {
        return true;
    }
    else
    {
        return false;
    }
}

function validateSites($sites) {
    
    
}

function validateSite($no, $street, $suburb_City, $postalCode, $additionalInfo) {
    
}

function validateContacts($contacts) {
    
}

function validateContact($username, $password, $firstName, $lastName, $emails, $phoneNumbers) {
    
}