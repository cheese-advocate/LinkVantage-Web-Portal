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
define("ERR_NO_ERRORS","No error found");
define("ERR_PASSWORD_MISMATCH","Your passwords do not match.");
define("REGEX_COMPANY_NAME", "/^((?![\^!@#$*~ <>?]).)((?![\^!@#$*~<>?]).){0,73}((?![\^!@#$*~ <>?]).)$/");
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
    
    $company = trim($companyName);
    
    if (empty($company)) {
        
        return ERR_EMPTY_COMPANY_NAME;
        
    } elseif (isCompanyNameValid($companyName)) {
        
        return ERR_INVALID_COMPANY_NAME;
        
    } else {
        
        return ERR_NO_ERRORS;
        
    }
    
}

function isCompanyNameValid($companyName) {
     
    
    if (preg_match(REGEX_COMPANY_NAME, $companyName) && strlen($companyName)<=40)
    {
       return true; 
    }
    else
    {
        return false;
    }
    
}

function isPostalValid($postalCode) {
    
     
    $code = trim($postalCode);
    if(empty($code))
    {
        return false;
    }
    
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
    
     $street = trim($streetNum);
     if(empty($street))
     {
         return false;
     }
    
    if (preg_match(REGEX_STREET_NUM, $streetNum))
    {
       return true; 
    }
    else
    {
        return false;
    }
    
}
  

function validatePasswords($password, $confirmPassword) {
    
    return validatePassword($password).validateConfirmedPassword($password, $confirmPassword);
    
}

function validatePassword($password) {
    
    
    if(preg_match(REGEX_PASSWORD, $password) && strlen($password) <= 60)
    {
        return true;
    }
    else
    {
        return ERR_INAVLID_PASSWORD;
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
    
    $email = trim($emailAddress);
    if(empty($email))
    {
        return "Please enter your email";
    }
    
    if(preg_match(REGEX_EMAIL, $emailAddress) && strlen($emailAddress)<=255)
    {
        return true;
    }
    else
    {
        return "Invalid email";
    }
}

function validatePhone($phoneNumber) {
     
    $number = trim($phoneNumber);
    if(empty($number))
    {
        return "Please enter your phone number";
    }
   
    if (preg_match(REGEX_PHONE, $phoneNumber)) 
    {
        return true;
    }
    else
    {
        return ERR_INVALID_PHONE_NUMBER;
    }
}

//This function accepts an array of site objects
//The function then calls its partner function to vaildate each object individually
function validateSites(array $sites) {
    
    $errors = array();  
    foreach($sites as $value)
    {
        $siteValidation = validateSite($value);
        $errors = array_merge($errors, $siteValidation);       
    }
    return $errors;
               
}

//This function validates each site object individually
function validateSite($site) {
    
    $errors = array();
    $counter = 0;
    
    $streetNum = $site->getStreetNum();
    $streetName = $site->getStreetName();
    $suburbCity = $site->getSubUrbCity();
    $postalCode = $site->getPostalCode();
    $mainSite = $site->getMainSite();
    
    if (!isStreetNumValid($streetNum))
    {
        $errors[$counter++] = "Invalid input: Street Number";
    }
    if (!validateCompanyName($streetName))
    {
        $errors[$counter++] = "Invalid input: Company Name";
    }
    if (!validateCompanyName($suburbCity))
    {
        $errors[$counter++] = "Invalid input: Suburb City";
    }
    if (!isPostalValid($postalCode))
    {
        $errors[$counter++] = "Invalid input: Postal Code";
    }
    if (!validateCompanyName($mainSite))
    {
        $errors[$counter++] = "Invalid input: Main Site";
    }
    
    return $errors;
      
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
        $contactValidation = validateContact($value);
        $errors = array_merge($errors, $contactValidation);
    }
    
    $counter=count($errors);
    
    //declaring arrays for each field to be validated
    $usernames = array();
    $emails = array();
    $phoneNumbers = array();
    
    
    //populating arrays
    for ($i=0; $i<count($contacts); $i++)
    {
        $usernames[$i] = $contacts[$i]->getUsername();
    }
    for ($i=0; $i<count($contacts); $i++)
    {
        $emails[$i] = $contacts[$i]->getEmail();
    }
    for ($i=0; $i<count($contacts); $i++)
    {
        $phoneNumbers[$i] = $contacts[$i]->getPhoneNumber();
    }
    
    //checking if duplicate usernames exist in the array
    if(count($usernames) !== count(array_unique($usernames)))
    {
        for ($i=0; $i<count($contacts); $i++)
        {
            for ($j=$i+1; $j<count($contacts); $j++)
            {
                if ($usernames[$i] == $usernames[$j])
                {
                    $errors[$counter++] = "Error: Duplicate username ".$usernames[$i];
                }
            }
        }
    }
    
    //checking if duplicate emails exist in the array
    if(count($emails) !== count(array_unique($emails)))
    {
        for ($i=0; $i<count($contacts); $i++)
        {
            for ($j=$i+1; $j<count($contacts); $j++)
            {
                if ($emails[$i] == $emails[$j])
                {
                    $errors[$counter++] = "Error: Duplicate email ".$emails[$i];
                }
            }
        }
    }
    
    //checking if duplicate phone numbers exist in the array
    if(count($phoneNumbers) !== count(array_unique($phoneNumbers)))
    {
        
        for ($i=0; $i<count($contacts); $i++)
        {
            for ($j=$i+1; $j<count($contacts); $j++)
            {
                if ($phoneNumbers[$i] == $phoneNumbers[$j])
                {
                    $errors[$counter++] = "Error: Duplicate phone number ".$phoneNumbers[$i];
                }
            }
        }
        
    }
      
    return $errors;
}

function validateContact($contact) 
{
    $errors = array();
    $counter=0;
    $username = $contact->getUsername();
    $email = $contact->getEmail();
    $phoneNumber = $contact->getPhoneNumber();
    
    //Checking for already existing information in the database
    if(findUsername($username))
    {
        $errors[$counter++] = "Error: Username ".$username." already taken.";
    }
    if(findEmail($email))
    {
        $errors[$counter++] = "Error: Email ".$email." already taken.";
    }
    if(findPhoneNumber($phoneNumber))
    {
        $errors[$counter++] = "Error: Phone number ".$phoneNumber." already taken.";
    }
    
    return $errors;
        
}