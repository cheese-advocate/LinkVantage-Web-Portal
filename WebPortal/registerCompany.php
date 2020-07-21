<?php
    
require_once 'config.php';
require_once 'inputServerValidation.php';
require_once 'Contact.php';
require_once 'Site.php';
require_once 'getLists.php';

session_start();

/* Check if a form was submitted */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    /*Get the company name*/
    $companyName = $_POST["companyNameInp"];    
    
    $usernames = $_POST["username"];
    $passwords = $_POST["password"];
    $firstNames = $_POST["firstName"];
    $lastNames = $_POST["lastName"];
    $emails = $_POST["email"];
    $phoneNumbers = $_POST["phoneNumber"];
    $confirmMainContacts = $_POST["confirmMainContact"];
    
    if(!is_array($usernames)){
        $usernames = array($usernames);
    }
    
    if(!is_array($passwords)){
        $passwords = array($passwords);
    }
    
    if(!is_array($firstNames)){
        $firstNames = array($firstNames);
    }
    
    if(!is_array($lastNames)){
        $lastNames = array($lastNames);
    }
    
    if(!is_array($emails)){
        $emails = array($emails);
    }
    
    if(!is_array($phoneNumbers)){
        $phoneNumbers = array($phoneNumbers);
    }
    
    if(!is_array($confirmMainContacts)){
        $confirmMainContacts = array($confirmMainContacts);
    }
    
    /*Get the arrays of contact details and combine into array of contacts*/
    $contacts = getContacts($usernames, $passwords, $firstNames, $lastNames, 
            $emails, $phoneNumbers, $confirmMainContacts);

    $streetNums = $_POST["streetNum"];
    $streetNames = $_POST["streetName"];
    $suburbCities = $_POST["suburbCity"];
    $postalCodes = $_POST["postalCode"];
    $infos = $_POST["info"];
    $confirmMainSites = $_POST["confirmMainSite"];    
    
    if(!is_array($streetNums)){
        $streetNums = array($streetNums);
    }
    
    if(!is_array($streetNames)){
        $streetNames = array($streetNames);
    }
    
    if(!is_array($suburbCities)){
        $suburbCities = array($suburbCities);
    }
    
    if(!is_array($postalCodes)){
        $postalCodes = array($postalCodes);
    }
    
    if(!is_array($infos)){
        $infos = array($infos);
    }
    
    if(!is_array($confirmMainSites)){
        $confirmMainSites = array($confirmMainSites);
    }
    
    /*Get the arrays of site details and combine into array of sites*/
    $sites = getSites($streetNums, $streetNames, $suburbCities, $postalCodes, 
            $infos,$confirmMainSites);

    /* Validation */
        
    /*Initialise the variable to track whether the registration details are 
     * passing validation*/
    $registrationValid = true;
    
    /*Validate the company name*/
    
    /*Validation should return an empty string if valid, or an error if invalid*/
    $companyValidation = validateCompanyName($companyName);
    
    /*Validaiton passes if string is empty*/
    if($companyValidation!== ERR_NO_ERRORS){
        $registrationValid = false;
    }

    /* Validate the contacts */
    
    /*Validation should return array of errors*/
    $contactsValidation = validateContacts($contacts);
    
    /*Validation passed if array of errors was empty*/
    if(!empty($contactsValidation)){
        $registrationValid = false;
    }
    
    /* Validate the site */
    
    /*Validation should return array of errors*/
    $sitesValidation = validateSites($sites);
    
    /*Validation passed if array of errors was empty*/
    if(!empty($sitesValidation)){
        $registrationValid = false;
    }
    
    /*Register the client if they passed registration, and then direct them back 
     * to the login page*/
    if($registrationValid){
        $databaseResult = registerCompany($companyName, $contacts, $site);
        
        /*Client failed to register*/
        if($databaseResult[0]===CLIENT_REGISTRATION_FAILED){
            handleErrors(CLIENT_REGISTRATION_FAILED);
        } else {
            /*some contacts/sites failed to register*/
            if(!isEmpty($databaseResult[1])){
                
                /*Error to display once directed to the login page*/
                
                /*The session variable to check on loading index page*/
                $_SESSION['preLoginWarning'] = $databaseResult[1] . " This will"
                        . " require you to login to your main account.";
                
                /*Error to display once logged in to the main contact account. 
                 * Contains the error message and the client it is intended for*/
                
                $postLoginWarning = array();                
                /*The clientID*/
                $postLoginWarning[0] = $databaseResult[0];
                /*The error message*/
                $postLoginWarning[1] = $databaseResult[1] . ' Click '
                        . '<a href="#">here</a> to view and manage your contacts'
                        . ' and sites.';
                
                /*The session variable to check after login*/
                $_SESSION['postLoginWarning'] = $postLoginWarning;
            }
            
            /*Message to display once directed to the login page, indicating 
             * successful registration*/
            $_SESSION['registrationSuccessful'] = REGISTRATION_SUCCESS;
            
            /*Direct user to login page after registration*/
            header("Location: index.php");
        }
        
    } else { /*handle the error messages if they failed validation*/
        echo 'error fournd';
        if(!is_array($companyValidation)){
            $companyValidation = array($companyValidation);
        }
        
        if(!is_array($contactsValidation)){
            $contactsValidation = array($contactsValidation);
        }
        
        if(!is_array($sitesValidation)){
            $sitesValidation = array($sitesValidation);
        }
        
        $errors = array_merge($companyValidation, $contactsValidation, $sitesValidation);        
        
        handleErrors($errors);
    }
}

/**
 * Receives the array of error messages and adds them to a session variable 
 * which is an array of error messages to be displayed as toast messages
 * 
 * @param type $errors The array of error messages
 */
function handleErrors($errors){
    $toastMessages = array_unique($errors);
    
    $_SESSION['toastMessages'] = $toastMessages;
}
    
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Register Company</title>
        <!--Title icon link-->
        <link rel="shortcut icon" href="favicon.ico" />
        <!--JS links-->
        <script src="Script/jquery-3.5.0.js" type="text/javascript"></script>
        <script src="Script/script.js" type="text/javascript"></script>
        <script src="Script/inputValidation.js" type="text/javascript"></script>
        <script src="Script/generateContent.js" type="text/javascript"></script>
        <script src="Script/jquery.toast.min.js" type="text/javascript"></script>
        <!--CSS links-->
        <link href="CSS/style.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/registerPage.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/forgotPw.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/jquery.toast.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <script>
            function emptyInputToast()
            {
                $.toast({
                    heading: "Empty Input",
                    text: "Some fields are empty and need to be entered",
                    bgColor: "#FF6961",
                    textColor: "F3F3F3",
                    showHideTransition: "slide",
                    allowToastClose: false,
                    position: "bottom-center",
                    icon: "error",
                    loaderBg: "#373741",
                    hideAfter: 3000
                });
            }
            
            function invalidInputToast()
            {
                $.toast({
                    heading: "Invalid Input",
                    text: "Invalid input received",
                    bgColor: "#FFB347",
                    textColor: "F3F3F3",
                    showHideTransition: "slide",
                    allowToastClose: false,
                    position: "bottom-center",
                    icon: "error",
                    loaderBg: "#373741",
                    hideAfter: 3000
                });
            }
            
            function successfulSumbitToast()
            {
                $.toast({
                    heading: "Successfull Submission",
                    text: "Account registered",
                    bgColor: "#7EC850",
                    textColor: "F3F3F3",
                    showHideTransition: "slide",
                    allowToastClose: false,
                    position: "bottom-center",
                    icon: "success",
                    loaderBg: "#373741",
                    hideAfter: 3000
                });
            }
            
            function emailToast()
            {
                $.toast({
                    heading: "Invalid Email",
                    text: "Email should look like the following: example@example.com",
                    bgColor: "#FFB347",
                    textColor: "F3F3F3",
                    showHideTransition: "slide",
                    allowToastClose: false,
                    position: "bottom-center",
                    icon: "error",
                    loaderBg: "#373741",
                    hideAfter: 10000
                });
            }
            
            function pwInfoToast()
            {
                $.toast({
                    heading: "Invalid Password",
                    text: "The password should consist of 8 characters with:\nAt least one uppercase\nOne lowercase\nOne special character\nOne number",
                    bgColor: "#FFB347",
                    textColor: "F3F3F3",
                    showHideTransition: "slide",
                    allowToastClose: false,
                    position: "bottom-center",
                    icon: "error",
                    loaderBg: "#373741",
                    hideAfter: 10000
                });                
            }
            
            function usernameInfoToast()
            {
               $.toast({
                    heading: "Invalid Username",
                    text: "Username should consist of at least 8 characters",
                    bgColor: "#FFB347",
                    textColor: "F3F3F3",
                    showHideTransition: "slide",
                    allowToastClose: false,
                    position: "bottom-center",
                    icon: "error",
                    loaderBg: "#373741",
                    hideAfter: 10000
                }); 
            }
            
            function oneContactToastWarning()
            {
                $.toast({
                    heading: "Warning",
                    text: "At least one contact is required",
                    bgColor: "#FFB347",
                    textColor: "F3F3F3",
                    showHideTransition: "slide",
                    allowToastClose: false,
                    position: "bottom-center",
                    icon: "error",
                    loaderBg: "#373741",
                    hideAfter: 4000
                });
            }
            
            function oneSiteToastWarning()
            {
                $.toast({
                    heading: "Warning",
                    text: "At least one site is required",
                    bgColor: "#FFB347",
                    textColor: "F3F3F3",
                    showHideTransition: "slide",
                    allowToastClose: false,
                    position: "bottom-center",
                    icon: "error",
                    loaderBg: "#373741",
                    hideAfter: 4000
                });
            }
        </script>
        
         <!--Checks if there are toast messages that need to be displayed from a 
        failed registration-->
        <?php
            if(isset($_SESSION['toastMessages'])){
                echo '<script>';
                echo 'var errors = '.json_encode($_SESSION['toastMessages']);
                echo '</script>';?>
                <script>    
                    for(i=0; i<errors.length; i++){
                        $.toast({
                            heading: "Registration failed",
                            text: errors[i],
                            bgColor: "#FF6961",
                            textColor: "F3F3F3",
                            showHideTransition: "slide",
                            allowToastClose: false,
                            position: "bottom-center",
                            icon: "error",
                            loaderBg: "#373741",
                            hideAfter: 3000
                        });
                    }                    
                </script><?php                                    
            }
        ?>
        
        <!--REGISTER COMPANY PAGE-->
        <div class="registerCompanyPage" id="registerCompanyPage">
            <div class="header">
                Compulink Technologies
            </div>
            <form method="POST" action="" onsubmit="return formValidation()" id="registerCompanyForm">
                <div class="registerTitleContent">
                    <div class="logo">
                        <img src="images/logo_block_cropped.png" alt="" id="compuLogo"/>
                    </div>

                    <div class="registerOptionBtns">
                        <button type="button" class="backToLoginFromReg" onclick="backToLoginFromReg()">LOGIN</button>
                        <button class="registerBtnRegPage">REGISTER</button>
                    </div>

                    <div class="registerOptions">
                        <font class="radioFont">I am a:</font>
                        <label for="companyRadio" id="companyOption">Company</label>
                        <input type="radio" name="registerOption" value="Company" id="companyRadio" checked="true" onclick="changeToCompany()"/>

                        <label for="privClientRadio" id="privClient">Private Client</label>
                        <input type="radio" name="registerOption" value="Private Client" id="privClientRadio" onclick="changeToClient()"/>
                    </div>

                    <div class="companyName" id="company_name">
                        <input type="text" name="companyNameInp" value="" placeholder="COMPANY NAME" class="companyNameInp" id="company_name_inp" required="true"/>
                    </div>
                </div>  

                <div class="contactsHeader">
                    <font id="contactContainerHeader">Contacts</font>
                </div>

                <div class="contactsContent" id="contacts_content">
                    <div class="contactContentHeader">
                        <img src="images/cross.png" alt="" id="contactCrossImg" class="contactCrossImg" onclick="removeContact(this.parentNode.parentNode.id, this.nextElementSibling.innerHTML)"/>
                        Contact <font id="number"> 1</font><hr class="contactContentHeaderLine">
                        <img src="images/down-arrow.png" alt="" id="contactDownArrow" class="contactDownArrow"/>
                    </div>

                    <div class="usernPassInp">
                        <img src="images/account.png" alt="" class="contactAccountImg"/>
                        <input type="text" name="username" placeholder="USERNAME" class="contactInput" id="ContactUsername" required="true"/>
                        <img src="images/lock.png" alt="" class="contactLockImg"/>
                        <input type="text" name="password" placeholder="PASSWORD" class="contactInput" id="ContactPassw" onfocus="changeTypeRegister()" required="true"/>
                    </div>

                    <div class="names">
                        <img src="images/id-card.png" alt="" class="idCard" id="id1"/>
                        <input type="text" name="firstName" placeholder="FIRST NAME" class="contactInput" id="contactFirstName" required="true"/>
                        <img src="images/id-card.png" alt="" class="idCard"/>
                        <input type="text" name="lastName" placeholder="LAST NAME" class="contactInput" id="contactLastName" required="true"/>
                    </div>

                    <div class="otherContactDet">
                        <img src="images/envelope.png" alt="" class="contactEmailImg"/>
                        <input type="text" name="email" placeholder="EMAIL" class="contactInput" id="contactEmail" required="true"/>
                        <img src="images/phone.png" alt="" class='phoneContactImg'/>
                        <input type="text" name="phoneNumber" placeholder="PHONE NUMBER" class="contactInput" id="contactPhoneNum" required="true"/>
                    </div>

                    <div class="confirmContact">
                        <label for="confirmMainContact">Is the main contact:</label>
                        <input type="checkbox" name="confirmMainContact" id="confirmMainContact"/>    
                    </div>  
                </div>

                <div class="addContact" id="add_contact">
                    <button type="button" class="addContactBtn" id="add_Contact_Btn" onclick="addContact()">ADD CONTACT</button>
                </div>

                <div class="addressHeader">
                    <font class="addressContainerHeader" id ="addressContainerHeader">Sites</font>
                </div>

                <div class="addressContent" id="addressContent">
                    <div class="addressContentHeader" id="address_content_header">
                        <img src="images/cross.png" alt="" id="contactCrossImg" class="contactCrossImg" onclick="removeSite(this.parentNode.parentNode.id)"/>
                        Address <font id="number"> 1</font><hr class="contactContentHeaderLine">
                        <img src="images/down-arrow.png" alt="" id="contactDownArrow" class="contactDownArrow"/>
                    </div>

                    <div class="streetNum">
                        <img src="images/location.png" alt="" class="locationImg1"/>
                        <input type="text" name="streetNum[]" placeholder="NO" class="addressInp" id="streetNumInp" required="true"/>
                    </div>

                    <div class="streetName">
                        <img src="images/location.png" alt="" class="locationImg2"/>
                        <input type="text" name="streetName[]" placeholder="STREET" class="addressInp" id="streetNameInp" required="true"/>
                    </div>

                    <div class="suburbCity">
                        <img src="images/house.png" alt="" class="homeImg"/>
                        <input type="text" name="suburbCity[]" placeholder="SUBURB/CITY" class="addressInp" id="suburbInp" required="true"/>
                    </div>

                    <div class="postalCode">
                        <img src="images/envelope.png" alt="" class="postalImg"/>
                        <input type="text" name="postalCode[]" placeholder="POSTAL CODE" class="addressInp" id="postalInp" required="true"/>
                    </div>

                    <div class="addInfo">
                        <img src="images/information.png" alt="" class="infoImg"/>
                        <input type="text" name="info[]" placeholder="ADDITIONAL INFORMATION" class="addressInp" id="addInfo"/>
                    </div>

                    <div class="confirmSite" id="confirm_site">
                        <label for="confirmMainSite">Is the main site:</label>
                        <input type="hidden" name="confirmMainSite[]" id="confirmMainSite" value="false"/>
                        <input type="checkbox" name="confirmMainSite[]" id="confirmMainSite" value="true"/>
                    </div>
                </div>

                <div class="addSite" id="add_site">
                    <button type="button" class="addSiteBtn" id="add_site_btn" onclick="addSite()">ADD SITE</button>
                </div>

                <div class="registerAccount" id="register_account">
                    <button type=submit class="regAcBtn" id="reg_ac_btn" onclick="checkRequiredFields()">REGISTER ACCOUNT</button>
                </div>
            </form>
            <div class="registerFooter" id="register_footer">
                LINKVANTAGE
            </div>
        </div>
    </body>
</html>
