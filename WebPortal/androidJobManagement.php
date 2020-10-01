<?php

require 'config.php';

/* Database credentials */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_NAME', 'Chai');
define('DB_PASSWORD', 'P@ssword1');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

function android_getJobList($accountID)
{
    /*Access the global variable link*/ 
    global $link;
    
    $result = mysqli_query($link,"CALL jobList('".$accountID."');") or die("Query fail: " . mysqli_error($link));
    
    /*Loop through rows and add them to resultSet array*/
    while($row = mysql_fetch_array($result)) {
            $resultSet[] = $row;
    }
    /*Returns array for android use*/
    return $resultSet[];
}

function android_getJobDetails($jobID)
{
    /*Access the global variable link*/ 
    global $link;
    
    $result = mysqli_query($link,"CALL jobDetailsView('". $jobID ."');") or die("Query fail: " . mysqli_error($link));

    /*Loop through rows and add them to resultSet array*/
    while($row = mysql_fetch_array($result)) {
            $resultSet[] = $row;
    }
    /*Returns array for android use*/
    return $resultSet[];
}

function android_getJobTask($jobID)
{
    /*Access the global variable link*/ 
    global $link;
    
    $result = mysqli_query($link,"CALL jobTask('".$jobID."');") or die("Query fail: " . mysqli_error($link));

    /*Loop through rows and add them to resultSet array*/
    while($row = mysql_fetch_array($result)) {
            $resultSet[] = $row;
    }
    /*Returns array for android use*/
    return $resultSet[];
}
    
function android_getJobMilestone($jobID)
{
    /*Access the global variable link*/ 
    global $link;
    
    $result = mysqli_query($link,"CALL jobMilestone('".$jobID."');") or die("Query fail: " . mysqli_error($link));

    /*Loop through rows and add them to resultSet array*/
    while($row = mysql_fetch_array($result)) {
            $resultSet[] = $row;
    }
    /*Returns array for android use*/
    return $resultSet[];
}

function android_getSoftwareReg($jobID)
{
    /*Access the global variable link*/ 
    global $link;
    
    $result = mysqli_query($link,"CALL softwareRegistry('".$jobID."');") or die("Query fail: " . mysqli_error($link));
    
    /*Loop through rows and add them to resultSet array*/
    while($row = mysql_fetch_array($result)) {
            $resultSet[] = $row;
    }
    /*Returns array for android use*/
    return $resultSet[];
}

function android_getHardwareReg($jobID)
{
    /*Access the global variable link*/ 
    global $link;
    
    $result = mysqli_query($link,"CALL hardwareRegistry('".$jobID."');") or die("Query fail: " . mysqli_error($link));
    
    /*Loop through rows and add them to resultSet array*/
    while($row = mysql_fetch_array($result)) {
            $resultSet[] = $row;
    }
    /*Returns array for android use*/
    return $resultSet[];
}

function android_getJobUpdate($jobID)
{
    /*Access the global variable link*/ 
    global $link;
    
    $result = mysqli_query($link,"CALL jobUpdate('".$jobID."');") or die("Query fail: " . mysqli_error($link));
    
    /*Loop through rows and add them to resultSet array*/
    while($row = mysql_fetch_array($result)) {
            $resultSet[] = $row;
    }
    /*Returns array for android use*/
    return $resultSet[];
}

function android_getJobDescription($jobID)
{
    getJobDescription($jobID);
}

function android_setMilestoneEnd($mcID, $mcDate) {
    setMilestoneEnd($mcID, $mcDate);
}

function android_addTask($taskDescription, $taskStart, $taskEnd, $jobID) {
    addTask($taskDescription, $taskStart, $taskEnd, $jobID);
}

function android_setTaskEnd($taskID, $taskEnd) {
    setTaskEnd($taskID, $taskEnd);
}

function android_dropTask($taskID) {
    dropTask($taskID);
}

function android_addHardware($eqDescription, $eqValue, $deliveryDate, $procurementDate, $supplier, $warrantyInitation, $warrantyExpiration, $jobID) {
    addHardware($eqDescription, $eqValue, $deliveryDate, $procurementDate, $supplier, $warrantyInitation, $warrantyExpiration, $jobID);
}

function android_dropHardware($equipmentID) {
    dropHardware($equipmentID);
}

function android_addSoftware($eqDescription, $eqValue, $deliveryDate, $procurementDate, $supplier, $subscriptionEnd, $jobID) {
    addSoftware($eqDescription, $eqValue, $deliveryDate, $procurementDate, $supplier, $subscriptionEnd, $jobID);
}

function android_dropSoftware($equipmentID) {
    dropSoftware($equipmentID);
}

function android_setJobStatus($jobID, $jobStatus) {
    setJobStatus($jobID, $jobStatus);
}

function android_setJobPriority($jobID, $jobPriority) {
    setJobPriority($jobID, $jobPriority);
}