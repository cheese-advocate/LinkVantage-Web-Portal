<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'config.php';
Echo "CALLED MAFAAEDdhgEARFH";
$reg=$_POST["jobRegistry"];
$callDrop=$_POST["callDrop"];
$callCheck=$_POST["callCheck"];
$callAdd=$_POST["callAdd"];
$jobID=$_POST["jobID"];

if ($reg=="hardware"){
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
    $eqDescription=$_POST["eqDescription"];
    $eqValue=$_POST["eqValue"];
    $deliveryDate=$_POST["deliveryDate"];
    $procurementDate=$_POST["procurementDate"];
    $supplier=$_POST["supplier"];
    $subscriptionEnd=$_POST["subscriptionEnd"];
    addSoftware($eqDescription, $eqValue, $deliveryDate, $procurementDate, $supplier, $subscriptionEnd, $jobID);
}

if ($callDrop=="Task"){
    $taskID=$_POST["taskID"];
    dropTask($taskID);
}

if ($callCheck=="Task"){
    $taskID=$_POST["taskID"];
    $taskEnd=$_POST["taskDate"];
    setTaskEnd($taskID, $taskEnd);
}

if ($callAdd=="Task"){
    echo "Callederaherh";
    $taskDescription=$_POST["taskDescr"];
    $taskStart=$_POST["taskStart"];
    addTask($taskDescription, $taskStart, null, $jobID);
}

if ($callCheck=="Milestone"){
    $mcID=$_POST["mcID"];
    $mcEnd=$_POST["mcDate"];
    setMilestoneEnd($mcID, $mcDate);
}

if ($callDrop=="Hardware"){
    $equipmentID=$_POST["equipmentID"];
    dropHardware($equipmentID);
}

if ($callDrop=="Software"){
    $equipmentID=$_POST["equipmentID"];
    dropSoftware($equipmentID);
}