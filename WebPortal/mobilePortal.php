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

$companyName = "null";

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
        //Register Account Return - Start
        echo "email is" . $email . "city is " . $city;
        //change above line, duuhh

        break;
//REGISTER CLIENT - END
//REGISTER COMPANY - START
    case "HANDLE_REGISTER_COMPANY":

        //Variable Assign for Company Registration - Start
        $companyName = $pieces[1]; //Username
        $temp = explode("=", $companyName);
        $companyName = $temp[1];

        $username = $pieces[2]; //Username
        $temp = explode("=", $username);
        $username = $temp[1];

        $password = $pieces[3]; //Password
        $temp = explode("=", $password);
        $password = $temp[1];

        $firstName = $pieces[4]; //FirstName
        $temp = explode("=", $firstName);
        $firstName = $temp[1];

        $lastName = $pieces[5]; //LastName
        $temp = explode("=", $lastName);
        $lastName = $temp[1];

        $email = $pieces[6]; //eMail Address
        $temp = explode("=", $email);
        $email = $temp[1];

        $phone = $pieces[7]; //PhoneNumber
        $temp = explode("=", $phone);
        $phone = $temp[1];

        $number = $pieces[8]; //StreetNumber
        $temp = explode("=", $number);
        $number = $temp[1];

        $name = $pieces[9]; //StreetName
        $temp = explode("=", $name);
        $name = $temp[1];

        $city = $pieces[10]; //City
        $temp = explode("=", $city);
        $city = $temp[1];

        $postal = $pieces[11]; //postal
        $temp = explode("=", $postal);
        $postal = $temp[1];
        
        $addInfo = $pieces[12]; //postal
        $temp = explode("=", $addInfo);
        $addInfo = $temp[1];
//Variable Assign for Company Registration - End

    //creating arrays with recieved strings - START
        $contacts = array($username, $password, $firstName ,
            $lastName , $email , $phone , "true");

        print_r($contacts);
        
        $sites = array($number, $name, $city , $postal , $addInfo , "true");
            //creating arrays with recieved strings - END
            
        //SERVER SIDE POST DATA VALIDATION - START
     //  $temp = validateContacts($contacts);
      
      
          //   $temp = validateCompanyName($companyName);
        //SERVER SIDE POST DATA VALIDATION - END
        
      //Company Registration Methods - Start
            //if valid
            
      //Company Registration Methods - End
        
        //REGISTER COMPANY RETURN - BELOW
        
       // print_r($contacts);
       //above line prints array
       //   echo $companyName;
        
        break;
    //REGISTER COMPANY - END
    //
    //FORGOT PASSWORD - START
    case "HANDLE_FORGOT_PW":
        
        //Variable Assign for Client Registration - Start
        $email = $pieces[1]; //Username
        $temp = explode("=", $email);
        $email = $temp[1];
        //Variable Assign for Client Registration - End
        
        resetSubBtn($email);
        echo "We tried";
        
        
        break;
    //FORGOT PASSWORD - END
    
    default: //Handle No Input - This should never be the case
        echo "ERROR RESPONSE, NO POST HANDLE FOUND";
}
// VAR "HANDLE" SWITCH - END
?>