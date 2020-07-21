<?php

require_once 'Contact.php';
require_once 'Site.php';

/*
 * This file contains functions for taking arrays of fields associated with 
 * contacts or sites and returning an array of contacts or sites
 */

/**
 * A function to take in arrays of variables associated with contacts, such as 
 * those received via post variables, and return an array of Contact objects
 * 
 * @param array $usernames The array of usernames
 * @param array $passwords The array of passwords
 * @param array $firstNames The array of firstNames
 * @param array $lastNames The array of lastNames
 * @param array $emails The array of emails
 * @param array $phoneNumers The array of phoneNumbers
 * @param array $mainContacts The array of booleans indicating main contacts
 * @return array Contact An array of Contact objects
 */
function getContacts(array $usernames, array $passwords, array $firstNames, array $lastNames, array $emails, array $phoneNumers, array $mainContacts){
        
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

/**
 * A function to take in arrays of variables associated with sites, such as 
 * those received via post variables, and return an array of Site objects
 * 
 * @param type $streetNums The array of street numbers
 * @param type $streetNames The array of street names
 * @param type $suburbCitys The array of suburbs/cities
 * @param type $postalCodes The array of postal codes
 * @param type $addInfos The array of additional information
 * @param type $mainSites The array of booleans indicating main sites
 */
function getSites(array $streetNums, array $streetNames, array $suburbCitys, array $postalCodes, array $addInfos, array $mainSites){
    $sites = array();
    
    for($i=0, $j=0; $i < count($mainSites); $i++) {
        if ($mainSites[$i] == "true"){
            $mainSitesCorrected[$j - 1] = true;
        }else{
            $mainSitesCorrected[$j] = false;
            $j++;
        }            
    }
    
    for($i=0; $i < count($streetNums); $i++){
        $streetNum = $streetNums[$i];
        $streetName = $streetNums[$i];
        $suburbCity = $suburbCitys[$i];
        $postalCode = $postalCodes[$i];
        $addInfo = $addInfos[$i];
        $mainSite = $mainSites[$i];
        $newSite = new Site($streetNum, $streetName, $suburbCity, $postalCode, 
                $addInfo, $mainSite);
        $sites[$i] = $newSite;
    }

    return $sites;    
}