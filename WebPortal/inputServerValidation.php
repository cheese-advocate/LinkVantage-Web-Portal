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
require_once 'Contact.php';
require_once 'Site.php';

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

define("REGEX_COMPANY_NAME", "/^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,}$/");
define("REGEX_EMAIL", "/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/");
define("REGEX_PASSWORD", "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/");
define("REGEX_PHONE", "/0((60[3-9]|64[0-5]|66[0-5])\d{6}|(7[1-4689]|6[1-3]|8[1-4])\d{7})/");
define("REGEX_STREET_NUM", "/^[0-9]*$/");
define("REGEX_POSTAL_CODE", "/^[0-9]{4}$/");



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
    
      
    if (preg_match(REGEX_COMPANY_NAME, $companyName))
    {
       return true; 
    }
    else
    {
        return false;
    }
    
}

function isPostalValid($postalCode) {
    
      
    if (preg_match(REGEX_POSTAL_CODE, $postalCode))
    {
       return true; 
    }
    else
    {
        return false;
    }
    
}

function isStreetNumValid($streetNum) {
    
      
    if (preg_match(REGEX_STREET_NUM, $streetNum))
    {
       return true; 
    }
    else
    {
        return false;
    }
    
}

function isPostalCodeValid($username) {
    
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
    
    
    if(preg_match(REGEX_PASSWORD, $password))
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
    
    
    if(preg_match(REGEX_EMAIL, $emailAddress))
    {
        return true;
    }
    else
        {
        return false;
    }
}

function validatePhone($phoneNumber) {
     
    
    if (preg_match(REGEX_PHONE, $phoneNumber)) 
    {
        return true;
    }
    else
    {
        return false;
    }
}


function validateSites(array $sites) {
    
    $errors = array();
    $counter = 0;
    foreach($sites as $value)
    {
        validateSite($value);
    }
               
}

function validateSite($site) {
    
    $errors = array();
    $counter = 0;
    
    $streetNum = $site->getStreetNum();
    $streetName = $site->getStreetName();
    $suburbCity = $site->getSubUrbCity();
    $postalCode = $site->getPostalCode();
    //$addInfo = $site->getAddInfo();
    $mainSite = $site->getMainSite();
    
    if (!isStreetNumValid($streetNum))
    {
        $errors[++$counter] = "Invalid input: Street Number";
    }
    if (!validateCompanyName($streetName))
    {
        $errors[++$counter] = "Invalid input: Company Name";
    }
    if (!validateCompanyName($suburbCity))
    {
        $errors[++$counter] = "Invalid input: Suburb City";
    }
    if (!isPostalValid($postalCode))
    {
        $errors[++$counter] = "Invalid input: Postal Code";
    }
     if (!validateCompanyName($mainSite))
    {
        $errors[++$counter] = "Invalid input: Main Site";
    }
    
    if ($counter == 0)
    {
        return "No errors";
    }
    else
    {
        return $errors; 
    }
      
}

/**
 * Takes in an array of contacts and validates them, returning an array of 
 * errors indicating in which ways the details failed the validation
 * 
 * @param type $contacts the array of contacts
 * @return array the array of errors
 */
function validateContacts(array $contacts) {
    
    $errors = array(); 
    foreach ($contacts as $value)
    {     
        
    }
    /*
     * Add one error messages to the array for each of the following failures:
     * 
     * -already existing username
     * -already existing email
     * -already existing phone
     * -duplicate username
     * -duplicate email
     * -duplicate phone
     * -invalid input/ empty fields(Make this more specific if you want, but it 
     * might cause too many toast messages to display if there are too many 
     * invalid fields)
     * 
     * The error message for each will be taken from the array and displayed in 
     * a toast message. Add any more errors that you want or change the list in 
     * whatever way you want, these just make the most sense to me and should be 
     * a good starting point at least
     */
    
    
    return $errors;
}

function validateContact($contact) {
    
}