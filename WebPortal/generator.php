<?php

/* 
 * This file contains methods used to generate different values such as those 
 * used in OTPs
 * 
 * @author: Jarred Fourie
 * 
 * 
 */

/*Constant variables*/

define('OTP_NUM_DIGITS', 6);

/**
 * method to return a random, 6 digit hex OTP
 * 
 * @return type a 6 character long OTP
 */
function generateOTP()
{
    $otp_bytes = random_bytes(OTP_NUM_DIGITS/2);
    $otp = bin2hex($otp_bytes);
    return $otp;
}