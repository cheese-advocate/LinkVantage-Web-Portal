<?php

/* 
 * This file contains methods used for hashing
 * 
 * @author Nicholas Kuun
 * 
 * 
 */

/*Constant variables*/
define('OTP_HASH_COST', 4);
define('PASSWORD_HASH_COST', 12);


/**
 * method to make it easier to choose what bcrypt cost to use
 * @param type $cost the cost for bcrypt to use
 * @return type the array of options, with cost set to the specified amount
 */
/*function options($cost)
{
    $options = [
        'cost' => $cost,
    ];
    return options;
}*/

/**
 * A method to take an OTP and return a hash of it 
 * 
 * @param type $otp the OTP to be hashed
 * @return type the hashed OTP, or false if the execution failed
 */
function hashOTP($otp)
{
    $hashedOTP = password_hash($otp, PASSWORD_BCRYPT, array(OTP_HASH_COST));
    return $hashedOTP;
}


/**
 * A method to take a password and return a hash of it 
 * 
 * @param type $password the password to be hashed
 * @return type the hashed password, or false if the execution failed
 */
function hashPassword($password)
{
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT, array(PASSWORD_HASH_COST));
    return $hashedPassword;
}

/**
 * A method to check if the entered password or otp produces the required hash
 * 
 * @param type $input the entered OTP or password
 * @param type $hashedPassword the hash of the required OTP or password
 * @return boolean true if the password/otp produces the hash and false if not
 */
function isCorrectHash($input, $hashedPassword)
{
    if(password_verify($input, $hashedPassword)){
        return true;
    } else{
        return false;
    }
}


