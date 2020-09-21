<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require 'config.php';
$reg=$_POST["jobRegistry"];


if ($reg=="hardware"){
    $jobID=$_POST["jobID"];
    $eqDescription=$_POST["eqDescription"];
    $eqValue=$_POST["eqValue"];
    $deliveryDate=$_POST["deliveryDate"];
    $procurementDate=$_POST["procurementDate"];
    $supplier=$_POST["supplier"];
    $warrantyInitation=$_POST["warrantyInitation"];
    $warrantyExpiration=$_POST["warrantyExpiration"];
    addHardware($eqDescription, $eqValue, $deliveryDate, $procurementDate, $supplier, $warrantyInitation, $warrantyExpiration, $jobID);
}

if ($reg=="software"){
    $jobID=$_POST["jobID"];
    $eqDescription=$_POST["eqDescription"];
    $eqValue=$_POST["eqValue"];
    $deliveryDate=$_POST["deliveryDate"];
    $procurementDate=$_POST["procurementDate"];
    $supplier=$_POST["supplier"];
    $subscriptionEnd=$_POST["subscriptionEnd"];
    addSoftware($eqDescription, $eqValue, $deliveryDate, $procurementDate, $supplier, $subscriptionEnd, $jobID);
}