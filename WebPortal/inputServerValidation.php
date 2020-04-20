<?php

/* 
 * Dedicated server validation PHP, to be included wherever server-side validation occurs.
 * 
 * Todo:
 * 
 * • Correct invalid variable codes
 * • isParamXValid() methods
 * 
 * NOTE: • is achieved with ALT + NUM7.
 */

include_once 'config.php';

/* Constant Variable Declaration */
define("ERR_EMPTY_COMPANY_NAME","Please enter your company name.");
define("ERR_EMPTY_PASSWORD","Please enter your password.");
define("ERR_EMPTY_PHONE_NUMBER","Please enter your phone number.");
define("ERR_EMPTY_USERNAME","Please enter your username.");
define("ERR_INVALID_COMPANY_NAME","Invalid company name.");
define("ERR_INVALID_USERNAME","Invalid username.");
define("ERR_INVALID_PASSWORD","Invalid Password.");
define("ERR_INVALID_PHONE_NUMBER","Please enter 10 digits as your phone number.");
define("ERR_NO_ERRORS","");
define("ERR_PASSWORD_MISMATCH","Your passwords do not match.");



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
    
    /* WIP - need validity rules */
    return true;
    
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
    
    
    
}

function validateConfirmedPassword($password, $confirmPassword) {
    
    if ($password !== $confirmPassword) {
        
        return ERR_PASSWORD_MISMATCH;
        
    } else {
        
        return ERR_NO_ERRORS;
        
    }
}

function validateEmail($emailAddress) {
    
}

function validatePhone($phoneNumber) {
    
    if (empty($phoneNumber)) {
        return ;
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