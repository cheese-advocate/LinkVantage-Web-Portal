<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Stock
 *
 * @author Tristan Ackermann
 */
class Stock {
    
    private $desc;
    private $supplier;
    private $value;
    private $procurementDate;
    private $deliveryDate;
    
    public function __construct($desc, $supplier, $value, $procurementDate, $deliveryDate) {
        $this->desc = $desc;
        $this->supplier = $supplier;
        $this->value = $value;
        $this->procurementDate = $procurementDate;
        $this->deliveryDate = $deliveryDate;
    }

    public function getDesc() {
        return $this->desc;
    }

    public function getSupplier() {
        return $this->supplier;
    }

    public function getValue() {
        return $this->value;
    }

    public function getProcurementDate() {
        return $this->procurementDate;
    }

    public function getDeliveryDate() {
        return $this->deliveryDate;
    }

    public function setDesc($desc) {
        $this->desc = $desc;
    }

    public function setSupplier($supplier) {
        $this->supplier = $supplier;
    }

    public function setValue($value) {
        $this->value = $value;
    }

    public function setProcurementDate($procurementDate) {
        $this->procurementDate = $procurementDate;
    }

    public function setDeliveryDate($deliveryDate) {
        $this->deliveryDate = $deliveryDate;
    }
    
}
