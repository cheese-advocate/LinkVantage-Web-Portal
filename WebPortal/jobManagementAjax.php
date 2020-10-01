<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require 'config.php';
session_start();
/*if (isset($_COOKIE["selectedJobID"])){
    $jobID=$_COOKIE["selectedJobID"];
} else {
    $jobID=$_SESSION["defaultJobID"];
}*/

if (isset($_POST["selectedJobID"])){
    $jobID=$_POST["selectedJobID"];
    $_SESSION["selectedJobID"]=$jobID;
    $jobUpdateDate=$_POST["jobUpdateDate"];
    setJobUpdated($jobID,$jobUpdateDate);
} else  if (isset($_SESSION["selectedJobID"])){
    $jobID=$_SESSION["selectedJobID"];
} else {
    $jobID=$_SESSION["defaultJobID"];
}

if(isset($_POST["jobRegistry"])){
    $reg=$_POST["jobRegistry"];
    unset($_POST['jobRegistry']);
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
}

if(isset($_POST["callDrop"])){
    $callDrop=$_POST["callDrop"];
    unset($_POST['callDrop']);
    if ($callDrop=="Task"){
        $taskID=$_POST["taskID"];
        dropTask($taskID);
    }

    if ($callDrop=="Hardware"){
        $equipmentID=$_POST["equipmentID"];
        dropHardware($equipmentID);
    }

    if ($callDrop=="Software"){
        $equipmentID=$_POST["equipmentID"];
        dropSoftware($equipmentID);
    }
}

if(isset($_POST["callCheck"])){
    $callCheck=$_POST["callCheck"];
    unset($_POST['callCheck']);
    
    if ($callCheck=="Task"){
        $taskID=$_POST["taskID"];
        $taskEnd=$_POST["taskDate"];
        setTaskEnd($taskID, $taskEnd);
    }
    
    if ($callCheck=="Milestone"){
        $mcID=$_POST["mcID"];
        $mcEnd=$_POST["mcDate"];
        setMilestoneEnd($mcID, $mcDate);
    }
}

if(isset($_POST["callAdd"])){
    
    $callAdd=$_POST["callAdd"];
    unset($_POST['callAdd']);
    if ($callAdd=="Task"){
        $taskDescription=$_POST["taskDescr"];
        $taskStart=$_POST["taskStart"];
        addTask($taskDescription, $taskStart, $jobID);
    }
}

if(isset($_POST["jobStatus"])){
    $jobStatus=$_POST["jobStatus"];
    setJobStatus($jobID, $jobStatus);
}

if(isset($_POST["jobPriority"])){
    $jobPriority=$_POST["jobPriority"];
    setJobPriority($jobID, $jobPriority);
}