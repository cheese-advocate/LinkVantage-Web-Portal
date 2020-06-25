<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Site
 *
 * @author Jarred Fourie
 */
class Site {
    private $streetNum;
    private $streetName;
    private $suburbCity;
    private $postalCode;
    private $addInfo;
    
    function __construct($streetNum, $streetName, $suburbCity, $postalCode, $addInfo) {
        $this->streetNum = $streetNum;
        $this->streetName = $streetName;
        $this->suburbCity = $suburbCity;
        $this->postalCode = $postalCode;
        $this->addInfo = $addInfo;
    }
    
    function getStreetNum() {
        return $this->streetNum;
    }

    function getStreetName() {
        return $this->streetName;
    }

    function getSuburbCity() {
        return $this->suburbCity;
    }

    function getPostalCode() {
        return $this->postalCode;
    }

    function getAddInfo() {
        return $this->addInfo;
    }

    function toString(){
        echo $this->streetNum . $this->streetName . $this->suburbCity . 
                $this->postalCode . $this->addInfo;
    }

}
