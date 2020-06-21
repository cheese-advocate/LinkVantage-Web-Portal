<?php
    
    require_once 'config.php';
    require_once 'inputServerValidation.php';
    require_once 'Contact.php';
    
    /* Constant Variable Declaration */
        
    
    /* Input Variable Declaration */
    $adrsNo;
    $adrsNoErr;
    $adrsStreet;
    $adrsStreetErr;
    $adrsSuburb;
    $adrsSuburbErr;
    $adrsPostalCode;
    $adrsPostalCodeErr;
    $adrsAdditional;
    $adrsAdditionalErr;
    $contacts;
    $contactsErrs;
    
    /* Check if a form was submitted */
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        /* Handle the form */
        
        //print_r($_POST);
        
        $contact_usernames = $_POST["username"];
        $contact_passwords = $_POST["password"];
        $contact_firstNames = $_POST["firstName"];
        $contact_lastNames = $_POST["lastName"];
        $contact_emails = $_POST["email"];
        $contact_phoneNumbers = $_POST["phoneNumber"];
        $contact_mainContacts = $_POST["confirmMainContact"];
        
        /*foreach ($contact_usernames as $username) {
            echo $username . " - ";
        }
        
        echo "<br>";
        
        foreach ($contact_passwords as $password) {
            echo $password . " - ";
        }
        
        echo "<br>";
        
        foreach ($contact_firstNames as $firstName) {
            echo $firstName . " - ";
        }
        
        echo "<br>";
        
        foreach ($contact_lastNames as $lastName) {
            echo $lastName . " - ";
        }
        
        echo "<br>";
        
        foreach ($contact_emails as $email) {
            echo $email . " - ";
        }
        
        echo "<br>";
        
        foreach ($contact_phoneNumbers as $phoneNumber) {
            echo $phoneNumber . " - ";
        }
        
        echo "<br>";
        
        foreach ($contact_mainContacts as $mainContact) {
            echo $mainContact . " - ";
        }*/
        
        $contacts = getContacts($contact_usernames, $contact_passwords, 
                $contact_firstNames, $contact_lastNames, $contact_emails,  
                $contact_phoneNumbers, $contact_mainContacts);
        
        foreach ($contacts as $contact) {
            $contact->toString();
        }
        
        /* Validation */
        /*$siteErrs = array(validateSite($adrsNo, $adrsStreet, $adrsSuburb, $adrsPostalCode, $adrsAdditional));
        $adrsNoErr = $siteErrs[0];
        $adrsStreetErr = $siteErrs[1];
        $adrsSuburbErr = $siteErrs[2];
        $adrsPostalCodeErr = $siteErrs[3];
        $adrsAdditionalErr = $siteErrs[4];*/
        
        /* Split the site errors into individual errors we can format the 
         * displaying of.
         */
        
        
        /* Validate all input fields */
        
        /* Validate the site */
        
        
        /* No duplicate main contacts */
        
        
        /* No duplicate usernames, emails, phones, in input nor should they exist in the database. */
        
        
        /* If all is valid, register the private client, register the site to the client, and register each contact to the client. */
        
        
    }
    
    function handleLogin(){
        
    }
    
    function getContacts($usernames, $passwords, $firstNames, $lastNames, $emails, $phoneNumers, $mainContacts){
        
        $contacts = array();
        $mainContactsCorrected = array();
        
        for($i=0, $j=0; $i < count($mainContacts); $i++) {
            if ($mainContacts[$i] == "true"){
                $mainContactsCorrected[$j - 1] = true;
            }else{
                $mainContactsCorrected[$j] = false;
                $j++;
            }            
        }
        
        for($i=0; $i < count($usernames); $i++){
            $username = $usernames[$i];
            $password = $passwords[$i];
            $firstName = $firstNames[$i];
            $lastName = $lastNames[$i];
            $email = $emails[$i];
            $phoneNumber = $phoneNumers[$i];
            $mainContact = $mainContactsCorrected[$i];
            $newContact = new Contact($username, $password, $firstName, 
                    $lastName, $email, $phoneNumber, $mainContact);
            $contacts[$i] = $newContact;
        }
        
        return $contacts;              
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
        <title>Register Client</title>
        <!--Title icon link-->
        <link rel="shortcut icon" href="favicon.ico" />
        <!--CSS links-->
        <link href="CSS/style.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/registerPage.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/registerPrivClient.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/jquery.toast.min.css" rel="stylesheet" type="text/css"/>
        <!--JS links-->
        <script src="Script/jquery-3.5.0.js" type="text/javascript"></script>
        <script src="Script/script.js" type="text/javascript"></script>
        <script src="Script/inputValidation.js" type="text/javascript"></script>
        <script src="Script/generateContent.js" type="text/javascript"></script>
        <script src="Script/jquery.toast.min.js" type="text/javascript"></script>
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
            
            
        </script>
        <div class="registerCompanyPage" id="registerPrivClient">
            <div class="header">
                Compulink Technologies
            </div>
            <form method="POST" action="#" onsubmit="return formValidation()" id="registerPrivClientForm">
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
                        <input type="radio" name="registerOption" value="Company" id="companyRadio" onclick="changeToCompany()"/>

                        <label for="privClientRadio" id="privClient">Private Client</label>
                        <input type="radio" name="registerOption" value="Private Client" id="privClientRadio" checked="true" onclick="changeToClient()"/>
                    </div>

                </div>  

                <div class="contactsHeader">
                    <font id="contactContainerHeader">Contacts</font>
                </div>

                <div class="contactsContent" id="contacts_content">
                    <div class="contactContentHeader">
                        <img src="images/cross.png" alt="" id="contactCrossImg" class="contactCrossImg" onclick="removeContact(this.parentNode.parentNode.id)"/>
                        Contact <font id="number"> 1</font><hr class="contactContentHeaderLine">
                        <img src="images/down-arrow.png" alt="" id="contactDownArrow" class="contactDownArrow"/>
                    </div>

                    <div class="usernPassInp">
                        <img src="images/account.png" alt="" class="contactAccountImg"/>
                        <input type="text" name="username[]" placeholder="USERNAME" class="contactInput" id="ContactUsername" required="true"/>
                        <img src="images/lock.png" alt="" class="contactLockImg"/>
                        <input type="text" name="password[]" placeholder="PASSWORD" class="contactInput" id="ContactPassw" onfocus="changeTypeRegister()" required="true"/>
                    </div>

                    <div class="names">
                        <img src="images/id-card.png" alt="" class="idCard" id="id1"/>
                        <input type="text" name="firstName[]" placeholder="FIRST NAME" class="contactInput" id="contactFirstName" required="true"/>
                        <img src="images/id-card.png" alt="" class="idCard"/>
                        <input type="text" name="lastName[]" placeholder="LAST NAME" class="contactInput" id="contactLastName" required="true"/>
                    </div>

                    <div class="otherContactDet">
                        <img src="images/envelope.png" alt="" class="contactEmailImg"/>
                        <input type="text" name="email[]" placeholder="EMAIL" class="contactInput" id="contactEmail" required="true"/>
                        <img src="images/phone.png" alt="" class='phoneContactImg'/>
                        <input type="text" name="phoneNumber[]" placeholder="PHONE NUMBER" class="contactInput" id="contactPhoneNum" required="true"/>
                    </div>

                    <div class="confirmContact">
                            <label for="confirmMainContact">Is the main contact:</label>
                            <input type="hidden" name="confirmMainContact[]" id="confirmMainContact" value="false"/>    
                            <input type="checkbox" name="confirmMainContact[]" id="confirmMainContact" value="true"/>    
                    </div>
                </div>

                <div class="addContact" id="add_contact">
                    <button type="button" class="addContactBtn" id="add_Contact_Btn" onclick="addContact()">ADD CONTACT</button>
                </div>

                <div class="addressHeader">
                    <font class="addressContainerHeader" id ="addressContainerHeader">Site</font>
                </div>

                <div class="addressContent" id="addressContent">
                    <div class="addressContentHeader1" id="address_content_header">
                        <font>Address</font>
                    </div>

                    <div class="streetNum">
                        <img src="images/location.png" alt="" class="locationImg1"/>
                        <input type="text" name="streetNum" placeholder="NO" class="addressInp" id="streetNumInp" required="true"/>
                    </div>

                    <div class="streetName">
                        <img src="images/location.png" alt="" class="locationImg2"/>
                        <input type="text" name="streetName" placeholder="STREET" class="addressInp" id="streetNameInp" required="true"/>
                    </div>

                    <div class="suburbCity">
                        <img src="images/house.png" alt="" class="homeImg"/>
                        <input type="text" name="suburbCity" placeholder="SUBURB/CITY" class="addressInp" id="suburbInp" required="true"/>
                    </div>

                    <div class="postalCode">
                        <img src="images/envelope.png" alt="" class="postalImg"/>
                        <input type="text" name="postalCode" placeholder="POSTAL CODE" class="addressInp" id="postalInp" required="true"/>
                    </div>

                    <div class="addInfo">
                        <img src="images/information.png" alt="" class="infoImg"/>
                        <input type="text" name="info" placeholder="ADDITIONAL INFORMATION" class="addressInp" id="addInfo"/>
                    </div>
                    
                    <!-- 
                    A main site selector was not needed in the private client registration form 
                    For now it is only commented out for if it is required later on
                    -->
                    
                    <!--<div class="confirmSite" id="confirm_site">
                        <label for="confirmMainSite">Is the main site:</label>
                        <input type="checkbox" name="confirmMainSite" id="confirmMainSite"/>
                    </div>-->
                </div>

                <div class="registerAccount" id="register_account">
                    <button type="submit" class="regAcBtn" id="reg_ac_btn" onclick="checkRequiredFields()">REGISTER ACCOUNT</button>
                </div>
            </form>
            <div class="registerFooter" id="register_footer">
                LINKVANTAGE
            </div>
        </div>
    </body>
</html>
