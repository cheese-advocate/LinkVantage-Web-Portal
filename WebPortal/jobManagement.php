<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <link href="CSS/clientDash.css" rel="stylesheet" type="text/css"/>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="Script/jquery-3.5.0.js" type="text/javascript" async defer></script>
        <script src="Script/script.js" type="text/javascript" async defer></script>
        <script src="Script/jobManagement.js" type="text/javascript" async defer></script>
        <link href="CSS/style.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/jobManagement.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php
        require 'config.php';
        ?>
        
        <div class="client-row-header">
                <table class="jobList">
                    <th>Reference no.</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Client</th>
                    <th>Priority</th>
                    <th>Due date</th>
                    <th>Status</th>
                    <th>Last updated</th>
                    <th>Created</th>
                </table>
        </div>
        
        <div id="job-list">
            <?php
                session_start();
                
                $accountID=$_SESSION['accountID'];
                getJobList($accountID);
                $jobID=$_POST["jobID"];
            ?>
        </div>
        <div id="job-info">
            <div id="first-rows">
                <div class="job-header">
                    <div class="client-row-header">
                        <div class="panel-content" style="width:95%">
                            <?php
                            if (isset($jobID)){
                            getJobDetails($jobID);
                            }
                            ?>
                        </div>
                    </div>
                </div>
                
                <div class="description">
                    <div class="client-panel panel-normal" id="clientdash-job-details">
                        <div class="panel-content">
                            <div class="details-div" id="description">
                                <h4 class="details-heading">Description:</h4>
                                <span class="details-info">
                                    <?php 
                                        if (isset($jobID)){
                                        Echo getJobDescription($jobID); 
                                        }
                                    ?>
                                    <br>
                                </span>
                            </div>                      
                        </div>
                    </div>
                </div>
                
            </div>
        </div>    
            <div class="client-row-content" id="remaining-grid">
                
                
                <div class="job-section" id="tasks">
                    <div class="client-panel panel-normal" id="clientdash-job-details">
                        <h3 class="panel-heading">Task:</h3>
                            <div class="details-div" id="task">
                                <?php 
                                    if (isset($jobID)){
                                    getJobTask($jobID); 
                                    }
                                ?>
                                <div id="addTask">
                                    <img src="images/write.png" id="addTaskImg">
                                    <input type="text" name="taskInput" placeholder="Add a task" id="addTaskInput" class="addTaskInput">
                                    <button name="addTask" id="itemAddBtn" class="addTaskInput">ADD</button>
                                </div>
                            </div>
                    </div>
                </div>
                
                <div class="job-section" id="milestones">
                    <div class="client-panel panel-normal" id="clientdash-job-details">
                        <h3 class="panel-heading">Milestones:</h3>
                        <div class="panel-content">
                            <div class="details-div" id="task">
                                <?php 
                                    if (isset($jobID)){
                                    getJobMilestone($jobID); 
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="job-section" id="chat">
                    <div class="client-panel panel-normal" id="clientdash-job-details">
                        <h3 class="panel-heading">Chat:</h3>
                        <div class="panel-content">
                            <div class="details-div" id="task">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="job-section" id="software-registry">
                    <div class="client-panel panel-normal" id="clientdash-job-details">
                        <h3 class="panel-heading">Software registry:</h3>
                        <div class="panel-content">
                            <div class="details-div" id="task">
                                <div class="panel-content" style="width:95%">
                                    <table style="width:100%; table-layout: fixed;">
                                        <th>Description</th>
                                        <th>Supplier</th>
                                        <th>Value</th>
                                        <th>Subscription end</th>
                                        <th>Procurement date</th>
                                        <th>Delivery date</th>
                                    </table>
                                </div>
                                <?php 
                                    if (isset($jobID)){
                                    getSoftwareReg($jobID); 
                                    }
                                ?>
                                <button id="addSoftwareReg" onclick="openSoftwareModal()" class="itemAddBtn">ADD SOFTWARE</button>
                                
                                

                                
                            </div>
                        </div>
                    </div>
                </div>
                
            <div id="softwareRegModal" class="modal">
                <div class="modal-content">
                    <span class="close" id="softwareClose">&times;</span>
                    <Form method="Post">
                    <label for="softwareDescr"><b>*Description</b></label>
                    <br>
                    <input type="text" placeholder="Enter description" name="softwareDescr" id="softwareDescr" required>
                    <br>
                    <label for="softwareSupplier"><b>*Supplier</b></label>
                    <br>
                    <input type="text" placeholder="Enter supplier name" name="softwareSupplier" id="softwareSupplier" required>
                    <br>
                    <label for="softwareValue"><b>*Value (Rand)</b></label>
                    <br>
                    <input type="number" step=".01" placeholder="Enter price" name="softwareValue" id="softwareValue" required>
                    <br>
                    <label for="softwareSubEnd"><b>Subscription end</b></label>
                    <br>
                    <input type="date" name="softwareSubEnd" id="softwareSubEnd">
                    <br>
                    <label for="softwareProcurement"><b>*Procurement date</b></label>
                    <br>
                    <input type="date" name="softwareProcurement" id="softwareProcurement">
                    <br>
                    <label for="softwareDelivery"><b>Delivery date</b></label>
                    <br>
                    <input type="date" name="softwareDelivery" id="softwareDelivery">
                    <br>
                    <input type="button" name="softwareAddBtn" onclick="addSoftwareReg()" value="Confirm" id="softwareAddBtn">
                    </Form>     
                </div>
            </div>
                
                <div class="job-section" id="hardware-registry">
                    <div class="client-panel panel-normal" id="clientdash-job-details">
                        <h3 class="panel-heading">Hardware registry:</h3>
                        <div class="panel-content">
                            <div class="details-div" id="task">
                                <div class="panel-content" style="width:95%">
                                    <table style="width:100%; table-layout: fixed;">
                                        <th>Description</th>
                                        <th>Supplier</th>
                                        <th>Value</th>
                                        <th>Warranty initiation</th>
                                        <th>Warranty expiration</th>
                                        <th>Procurement date</th>
                                        <th>Delivery date</th>
                                    </table>
                                </div>
                                <?php 
                                    if (isset($jobID)){
                                    getHardwareReg($jobID); 
                                    }
                                ?>
                                <button id="addHardwareReg" onclick="openHardwareModal()" class="itemAddBtn">ADD HARDWARE</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id="hardwareRegModal" class="modal">
                    <div class="modal-content">
                        <span class="close" id="hardwareClose">&times;</span>
                        <Form method="Post">
                        <label for="hardwareDescr"><b>*Description</b></label>
                        <br>
                        <input type="text" placeholder="Enter description" name="hardwareDescr" id="hardwareDescr" required>
                        <br>
                        <label for="hardwareSupplier"><b>*Supplier</b></label>
                        <br>
                        <input type="text" placeholder="Enter supplier name" name="hardwareSupplier" id="hardwareSupplier" required>
                        <br>
                        <label for="hardwareValue"><b>*Value (Rand)</b></label>
                        <br>
                        <input type="number" step=".01" placeholder="Enter price" name="hardwareValue" id="hardwareValue" required>
                        <br>
                        <label for="hardwareWarrantyInitiation"><b>Warranty initiation</b></label>
                        <br>
                        <input type="date" name="hardwareWarrantyInitiation" id="hardwareWarrantyInitiation">
                        <br>
                        <label for="hardwareWarrantyExpiration"><b>Warranty expiration</b></label>
                        <br>
                        <input type="date" name="hardwareWarrantyExpiration" id="hardwareWarrantyExpiration">
                        <br>
                        <label for="hardwareProcurement"><b>*Procurement date</b></label>
                        <br>
                        <input type="date" name="hardwareProcurement" id="hardwareProcurement" required>
                        <br>
                        <label for="hardwareDelivery"><b>Delivery date</b></label>
                        <br>
                        <input type="date" name="hardwareDelivery" id="hardwareDelivery">
                        <br>
                        <input type="button" onclick="addHardwareReg()" value="Confirm" id="hardwareAddBtn">
                        </Form>
                    </div>
                </div>
                
                <div class="job-section" id="updates">
                    <div class="job-section-heading">
                        <div class="client-panel panel-normal" id="clientdash-job-details">
                        <h3 class="panel-heading">Updates:</h3>
                        <div class="panel-content">
                            <div class="details-div" id="task">
                                <?php 
                                    if (isset($jobID)){
                                    getJobUpdate($jobID); 
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
