<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Software
 *
 * @author Tristan Ackermann
 */
class Software extends Stock{
    
    private $subscriptionEnd;
    
    public function __construct($desc, $supplier, $value, $procurementDate, $deliveryDate, $subscriptionEnd) {
        parent::__construct($desc, $supplier, $value, $procurementDate, $deliveryDate);
        $this->subscriptionEnd = $subscriptionEnd;
    }
    
    public function getSubscriptionEnd() {
        return $this->subscriptionEnd;
    }

    public function setSubscriptionEnd($subscriptionEnd) {
        $this->subscriptionEnd = $subscriptionEnd;
    }
}
