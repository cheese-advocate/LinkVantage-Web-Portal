<?php

/**
 * This PHP file exists to store all interactions with mobile clients connecting to the web server.
 */
//Requirements - Start
require_once 'config.php';
require_once 'inputServerValidation.php';
//Requirements - End
//Variables for recieved post - Start
$handleType = "null";
$username = "null";
$password = "null";
$firstName = "null";
$lastName = "null";
$email = "null";
$phone = "null";

$number = "null";
$name = "null";
$city = "null";
$postal = "null";
$addInfo = "null";

$userID = "null";
$loginAttempt = "null";
$loginIsValid = "null";
$serverReturn = "null";
$temp = "null";

$postIn = "HANDLE_NULL-username=noValue-password=noValue-firstName=noValue-lastName=noValue-email=nickuun@gmail.com-phone=0813814274-number=11-name=Nicholas Kuun-city=0813814274-postal=7550-addInfo=addInfo";
$postIn = htmlspecialchars($_POST["post"]);
//Variables for recieved post - End
//Breaking and assigning recieved input - Start
$pieces = explode("-", $postIn);

$handleType = $pieces[0]; //Determine Method Type

switch ($handleType) {

    case "HANDLE_LOGIN":

        //Variable Assign for Login to Server - Start
        $username = $pieces[1]; //Username
        $temp = explode("=", $username);
        $username = $temp[1];

        $password = $pieces[2]; //Password
        $temp = explode("=", $password);
        $password = $temp[1];
        //Variable Assign for Login to Server - End
        //Check Post Credentials against Database - Start

        $userID = getIDFromUsername($username);
        
        if ($userID == '') { //If the return is empty, this means that the login value could not be found
            $serverReturn = "HANDLE_LOGIN_FAILED";
        } else {
            $loginAttempt = isPasswordValid($userID, $password);
            $serverReturn = $loginAttempt;
        }
        echo $serverReturn;
        //Check Post Credentials against Database - Start

        break;


    case "HANDLE_REGISTER_CLIENT":

        //Variable Assign for Client Registration - Start
        $username = $pieces[1]; //Username
        $temp = explode("=", $username);
        $username = $temp[1];

        $password = $pieces[2]; //Password
        $temp = explode("=", $password);
        $password = $temp[1];

        $firstName = $pieces[3]; //FirstName
        $temp = explode("=", $firstName);
        $firstName = $temp[1];

        $lastName = $pieces[4]; //LastName
        $temp = explode("=", $lastName);
        $lastName = $temp[1];

        $email = $pieces[5]; //eMail Address
        $temp = explode("=", $email);
        $email = $temp[1];

        $phone = $pieces[6]; //PhoneNumber
        $temp = explode("=", $phone);
        $phone = $temp[1];

        $number = $pieces[7]; //StreetNumber
        $temp = explode("=", $number);
        $number = $temp[1];

        $name = $pieces[8]; //StreetName
        $temp = explode("=", $name);
        $name = $temp[1];

        $city = $pieces[9]; //City
        $temp = explode("=", $city);
        $city = $temp[1];

        $postal = $pieces[10]; //postal
        $temp = explode("=", $postal);
        $postal = $temp[1];

        $addInfo = $pieces[11]; //Additional Information
        $temp = explode("=", $addInfo);
        $addInfo = $temp[1];
//Variable Assign for Client Registration - End

        break;

    case "HANDLE_FORGOT_PW":
        handleForgotPW();
        break;

    default: //Handle No Input - This should never be the case
}



?>