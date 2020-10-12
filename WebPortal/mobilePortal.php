<?php

/**
 * This PHP file exists to store all interactions with mobile clients connecting to the web server.
 */
//Requirements - Start
require_once 'config.php';
//require_once 'Site.php';
//require_once 'Contact.php';
require_once 'handleIndex.php';
require_once 'inputServerValidation.php';
global $link;
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
$isValid = "null";
$serverReturn = "null";
$temp = "null";
$userOTP = "null";

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
        /* $contacts = array($username, $password, $firstName ,
          $lastName , $email , $phone , "true"); */



//creating arrays with recieved strings - END
//SERVER SIDE POST DATA VALIDATION - START

        $contacts = array(new Contact($username, $password, $firstName, $lastName, $email, $phone, "true"));
        $sites = array(new Site($number, $name, $city, $postal, $addInfo, "true"));
        $temp = validateCompanyName($companyName);
        $temp = validateContacts($contacts);
        $temp = validateSites($sites);

        print_r($sites);
        print_r($temp);

//SERVER SIDE POST DATA VALIDATION - END
//Company Registration Methods - Start
//Company Registration Methods - End
//REGISTER COMPANY RETURN - BELOW
        // print_r($contacts);
        //above line prints array
        //   echo $companyName;

        break;
    //REGISTER COMPANY - END
    //
    //FORGOT PASSWORD - START
    case "HANDLE_EMAIL_OTP":

        //Variable Assign for Email OTP - Start
        $email = $pieces[1]; //Username
        $temp = explode("=", $email);
        $email = $temp[1];
        //Variable Assign for Email OTP - End

       sendEmail($email);

        break;
    //FORGOT PASSWORD - END
    //CROSS_PLATFORM PASSWORD - START
    case "HANDLE_RETRIEVE_OTP":

        //Variable Assign for OTP retrieval - Start
        $email = $pieces[1]; //Username
        $temp = explode("=", $email);
        $email = $temp[1];
        //Variable Assign for OTP retrieval - End
        
        echo "THE OTP for". $email . " is: " . getOTP($email);

        break;
    //CROSS_PLATFORM PASSWORD - END
    //ACUTAL PASSWORD RESET- - START    
    case "HANDLE_RESET_PASSWORD":

        //Variable Assign for Password reset - Start
        $email = $pieces[1]; //Username
        $temp = explode("=", $email);
        $email = $temp[1];
        $userOTP = $pieces[2]; //Username
        $temp = explode("=", $userOTP);
        $userOTP = $temp[1];
        $password = $pieces[3]; //Username
        $temp = explode("=", $password);
        $password = $temp[1];
        //Variable Assign for Password reset - End
       $account = getUserIDfromEmail($email);
//Reset Password - Start
        if ($userOTP == getOTP($email)) {
            $serverReturn = updatePassword($account, $password);
        } else {
            $serverReturn = "OTP Invalid";
        }
//Reset Password - End
        
        echo $serverReturn;
        break;
        
    case "GET_CLIENTS":
        $clientIDs = getAllClientIDs();
        $data = array();            
        //Gets all clients with companies
        foreach($clientIDs as $id)
        {
            $result = $link->query("SELECT CONCAT(contactName, ' ', contactSurname) AS FullName, 
                                    CONCAT(streetNum, ' ', streetName, ' ', suburbCity) AS location, companyName
                                    FROM Contact, Site, Clients, Company
                                    WHERE Clients.clientID = '". implode($id) ."' AND Contact.clientID = '". implode($id) ."'
                                    AND Site.clientID = '". implode($id) ."' AND Company.clientID = '". implode($id) ."';");
                        
            if($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    $data[] = $row;
                }
            }  
        }
                    
        //Gets all clients without companies
        foreach($clientIDs as $id)
        {
            $result = $link->query("SELECT CONCAT(contactName, ' ', contactSurname) AS FullName, 
                                    CONCAT(streetNum, ' ', streetName, ' ', suburbCity) AS location
                                    FROM Contact, Site, Clients
                                    WHERE Clients.clientID = '". implode($id) ."' AND Contact.clientID = '". implode($id) ."'
                                    AND Site.clientID = '". implode($id) ."';");
                       
            if($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    $data[] = $row;
                }
            }
        }                                    
        //Make use of JSON to better format and handle the data on android side
        echo json_encode($data);
        break;
    
    case "GET_STATS":
        $clientCount = getClientCount();
        $jobCount = getJobCount();
        $companyCount = getCompanyCount();
        
        $data = array("clients" =>$clientCount, "jobs" =>$jobCount, "companies" =>$companyCount);
        echo json_encode($data);
        break;
    
    case "GET_FEEDBACK":
        $result = $link->query("SELECT CONCAT(contactName,' ',contactSurname) AS clientName, jobDescription, content FROM Job, Feedback, Contact
                                WHERE Job.jobID = Feedback.jobID AND Feedback.contactID = Contact.contactID;");
        $data = array();
        
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $data[] = $row;
            }
        }
        
        echo json_encode($data);
        break;
        
    case "GET_POTENTIAL_CLIENTS":
        $result = $link->query("SELECT CONCAT(firstName, ' ', lastName) AS FullName, interest FROM potentialClients;");
        $data = array();
        
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $data[] = $row;
            }
        }
        
        echo json_encode($data);
        break;
        
    case "REGISTER_POTENTIAL_CLIENT":
        $data = file_get_contents("php://input");
        $pieces = explode("-", $data);
        $json = json_decode($pieces[1]);
        
        $fName = $json->{"firstName"};
        $lName = $json->{"lastName"};
        $interest = $json->{"jobInterest"};
        $location = $json->{"location"};
        $cell = $json->{"cell"};
        $email = $json->{"email"};

        if($link->query("INSERT INTO potentialClients (firstName, lastName, interest, location, cellNum, email) VALUES
                        ('". $fName ."', '". $lName ."', '". $interest ."', '". $location ."', '". $cell ."', '". $email ."');"))
        {
            echo "TRUE";
        }
        else
        {
            echo "FALSE";
        }
        break;
        
    case "GET_JOBS":
        $result = $link->query("SELECT jobID, jobDescription, CONCAT(contactName, ' ', contactSurname) AS fullName, priority FROM Job, Contact, Clients
                                WHERE Job.clientID = Clients.clientID AND Clients.clientID = Contact.clientID;");
        $data = array();
        
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $data[] = $row;
            }
        }
        
        echo json_encode($data);
        break;
        
    case "GET_JOB_DETAILS":
        $getID = file_get_contents("php://input");
        $pieces = explode("-", $getID);
        $json = json_decode($pieces[1]);
        
        $id = $json->{"id"};
        
        $result = $link->query("SELECT priority, deadline, jobStatus, typeName, CONCAT(contactName, ' ', contactSurname) AS clientName,
                                CONCAT(streetNum, ' ', streetName, ' ', suburbCity) AS location, jobDescription
                                FROM Job, jobType, Clients, Contact, Site
                                WHERE jobType.typeID = Job.typeID AND Job.clientID = Clients.clientID AND Site.clientID = Clients.clientID
                                AND Site.siteID = Contact.siteID AND Job.jobID = '". $id ."';");
        
        $data = array();
        
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $data[] = $row;
            }
        }
        
        echo json_encode($data);
        break;
        
    case "GET_ALL_TASKS":
        $getID = file_get_contents("php://input");
        $pieces = explode("-", $getID);
        $json = json_decode($pieces[1]);
        
        $id = $json->{"id"};
        
        $result = $link->query("SELECT * FROM Task WHERE jobID = '". $id ."';");
        
        $data = array();
        
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $data[] = $row;
            }
        }
        
        echo json_encode($data);
        break;
        
    case "ADD_NEW_TASK":
        $data = file_get_contents("php://input");
        $pieces = explode("=", $data);
        $json = json_decode($pieces[2]);
        
        $task = $json->{"task"};
        $date = $json->{"date"};
        $jobID = $json->{"jobID"};
        
        if($link->query("CALL addTask('". $task ."', '". $date ."', '". $jobID ."');"))
        {
            echo "true";
        }
        else
        {
            echo "false";
        }
        break;
        
    case "DELETE_TASK":
        $data = file_get_contents("php://input");
        $pieces = explode("-", $data);
        $json = json_decode($pieces[1]);
        
        $id = $json->{"id"};
        
        if($link->query("CALL dropTask('". $id ."');"))
        {
            echo 'true';
        }
        else
        {
            echo 'false';
        }
        break;
        
    case "CHANGE_TASK_STATE";
        $data = file_get_contents("php://input");
        $pieces = explode("=", $data);
        $json = json_decode($pieces[2]);
        
        $id = $json->{"taskID"};
        $end = $json->{"endDate"};
        
        if($end == null)
        {
            $end = "NULL";
        }
        
        if($link->query("CALL setTaskEnd('". $id ."', '". $end ."');"))
        {
            echo $end;
        }
        else
        {
            echo 'false';
        }
        break;
        
    case "GET_MILESTONES":
        $data = file_get_contents("php://input");
        $pieces = explode("-", $data);
        $json = json_decode($pieces[1]);
        
        $jobID = $json->{"jobID"};
        
        $result = $link->query("SELECT * FROM milestoneComplete WHERE jobID = '". $jobID ."';");
        $milestones = array();
        
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $milestones[] = $row;
            }
        }
        echo json_encode($milestones);
        break;
        
    case "CHANGE_MILESTONE_STATE":
        $data = file_get_contents("php://input");
        $pieces = explode("=", $data);
        $json = json_decode($pieces[2]);
        
        $milestoneID = $json->{"milestoneID"};
        $milestoneDate = $json->{"milestoneDate"};
        
        if($milestoneDate == null)
        {
            $milestoneDate = "NULL";
        }
        
        if($link->query("CALL setMilestoneEnd('". $milestoneID ."', '". $milestoneDate ."');"))
        {
            echo 'true';
        }
        else
        {
            echo 'false';
        }
        break;
        
    case "GET_ALL_CONTACTS":
        $result = $link->query("SELECT CONCAT(contactName, ' ', contactSurname) AS val, clientID AS id FROM Contact;");
        $data = array();
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $data[] = $row;
            }
        }
        echo json_encode($data);
        break;
        
    case "GET_ALL_TECHNICIANS":
        $result = $link->query("SELECT CONCAT(tecName, ' ', tecSurname) AS val, tecID AS id FROM technician;");
        $data = array();
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $data[] = $row;
            }
        }
        echo json_encode($data);
        break;
        
    case "GET_ALL_JOB_TYPES":
        $result = $link->query("SELECT typeName AS val, typeID AS id FROM jobType;");
        $data = array();
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $data[] = $row;
            }
        }
        echo json_encode($data);
        break;
        
    case "GET_ALL_SITES":
        $result = $link->query("SELECT CONCAT(streetNum, ' ', streetName, ' ', suburbCity) AS val, siteID AS id FROM site;");
        $data = array();
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $data[] = $row;
            }
        }
        echo json_encode($data);
        break;
        
    case "ADD_JOB":
        $data = file_get_contents("php://input");
        $pieces = explode("=", $data);
        $json = json_decode($pieces[2]);
        
        $startDate = $json->{"startDate"};
        $deadline = $json->{"deadline"};
        $description = $json->{"description"};
        $priority = $json->{"priority"};
        $jobStatus = $json->{"jobStatus"};
        $clientID = $json->{"clientID"};
        $tecID = $json->{"tecID"};
        $typeID = $json->{"typeID"};
        $siteID = $json->{"siteID"};
        
        if($link->query("INSERT INTO Job (jobID, startDate, deadline, endDate, jobDescription, priority, jobStatus, updated, clientID, tecID, typeID, siteID) VALUES
                        (createJobID(), '". $startDate ."', '". $deadline ."', null, '". $description ."', '". $priority ."', '". $jobStatus ."', null, '". $clientID
                        ."', '". $tecID ."', '". $typeID ."', '". $siteID ."');"))
        {
            echo 'true';
        }
        else
        {
            echo 'false';
        }
        
        break;
        
    case "NEW_HANDLE_LOGIN":
        $data = file_get_contents("php://input");
        $pieces = explode("-", $data);
        $json = json_decode($pieces[1]);
        
        $username = $json->{"username"};
        $password = $json->{"password"};
        
        $userID = getIDFromUsername($username);
        $result = $link->query("SELECT getAccountType('". $userID ."') AS accountType;");
        
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $accountType = $row["accountType"];
            }
        }
        
        if ($userID == '') { //If the return is empty, this means that the login value could not be found
            $serverReturn = "HANDLE_LOGIN_FAILED";
        } else {
            $loginAttempt = isPasswordValid($userID, $password);
            $serverReturn = $loginAttempt;
            
            $obj->result = $serverReturn;
            $obj->accountType = $accountType;
            
            $json = json_encode($obj);
            
            echo $json;
        }
        break;
        
    case "GET_TECHNICIAN_JOBS":
        $input = file_get_contents("php://input");
        $pieces = explode("-", $input);
        $json = json_decode($pieces[1]);
        
        $username = $json->{"username"};
        
        $id = getIDFromUsername($username);
        
        $res = $link->query("SELECT tecID FROM technician WHERE accountID = '". $id ."';");
        
        if($res->num_rows > 0)
        {
            while($row = $res->fetch_assoc())
            {
                $tecID = $row["tecID"];
            }
        }
        
        $result = $link->query("SELECT jobID, jobDescription, CONCAT(contactName, ' ', contactSurname) AS fullName, priority FROM Job, Contact, Clients
                                WHERE Job.clientID = Clients.clientID AND Clients.clientID = Contact.clientID AND tecID = '". $tecID ."';");
        $data = array();
        
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $data[] = $row;
            }
        }
        echo json_encode($data);
        break;
    //CROSS_PLATFORM PASSWORD - START
    default: //Handle No Input - This should never be the case
        echo "ERROR RESPONSE, NO POST HANDLE FOUND";
}
?>