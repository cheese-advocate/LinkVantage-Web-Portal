<?php

/*
 * Class for storing info about a contact (username, password, firstname, 
 * lastname, email, phone number, whether it is a main contact)
 */

/**
 * Description of contact
 *
 * @author Jarred Fourie
 */
class Contact {
    private $username = "";
    private $password = "";
    private $firstName = "";
    private $lastName = "";
    private $email = "";
    private $phoneNumber = "";
    private $mainContact = false;
    
    public function __construct($username, $password, $firstName, $lastName, $email, $phoneNumber, $mainContact) {
        $this->username = $username;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phoneNumer = $phoneNumber;
        $this->mainContact = $mainContact;
    }
    
    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function getFirstName() {
        return $this->firstName;
    }

    function getLastName() {
        return $this->lastName;
    }

    function getEmail() {
        return $this->email;
    }

    function getPhoneNumber() {
        return $this->phoneNumber;
    }

    function getMainContact() {
        return $this->mainContact;
    }

    function toString()
    {
        echo $this->username . $this->password . $this->firstName . 
                $this->lastName . $this->email . $this->phoneNumber . 
                $this->mainContact;
    }
    
}