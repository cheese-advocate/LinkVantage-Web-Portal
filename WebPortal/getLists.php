<?php

require_once 'Contact.php';
require_once 'Site.php';

/*
 * This file contains functions for taking arrays of fields associated with 
 * contacts or sites and returning an array of contacts or sites
 */

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

function getSites($streetNums, $streetNames, $suburbCitys, $postalCodes, $addInfos){
    $sites = array();
    
    for($i=0; $i < count($streetNums); $i++){
        $streetNum = $streetNums[$i];
        $streetName = $streetNums[$i];
        $suburbCity = $suburbCitys[$i];
        $postalCode = $postalCodes[$i];
        $addInfo = $addInfos[$i];
        $newSite = new Site($streetNum, $streetName, $suburbCity, $postalCode, 
                $addInfo);
        $sites[$i] = $newSite;
    }    
}