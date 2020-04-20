<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'config.php';

function validateCompanyName($companyName) {
    
}

function validateUserName($username) {
    
}

function validatePasswords($password, $confirmPassword) {
    
    return validatePassword($password).validateConfirmedPassword($password, $confirmPassword);
    
}

function validatePassword($password) {
    
}

function validateConfirmedPassword($password, $confirmPassword) {
    
}

function validateEmail($emailAddress) {
    
}

function validatePhone($phoneNumber) {
    
}

function validateSites($sites) {
    
}

function validateSite($no, $street, $suburb_City, $postalCode, $additionalInfo) {
    
}

function validateContacts($contacts) {
    
}

function validateContact($username, $password, $firstName, $lastName, $emails, $phoneNumbers) {
    
}