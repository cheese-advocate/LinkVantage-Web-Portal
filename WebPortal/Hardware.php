<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Hardware
 *
 * @author Tristan Ackermann
 */
class Hardware extends Stock{
    
    private $warrantyStart;
    private $warrantyEnd;
    
    public function __construct($desc, $supplier, $value, $procurementDate, $deliveryDate, $warrantyStart, $warrantyEnd) {
        parent::__construct($desc, $supplier, $value, $procurementDate, $deliveryDate);
        
        $this->warrantyStart = $warrantyStart;
        $this->warrantyEnd = $warrantyEnd;
    }
    
    public function getWarrantyStart() {
        return $this->warrantyStart;
    }

    public function getWarrantyEnd() {
        return $this->warrantyEnd;
    }

    public function setWarrantyStart($warrantyStart) {
        $this->warrantyStart = $warrantyStart;
    }

    public function setWarrantyEnd($warrantyEnd) {
        $this->warrantyEnd = $warrantyEnd;
    }
}
