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
        
        <script src="Script/dashboard.js" type="text/javascript"></script>
        <script src="Script/script.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="CSS/style.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/jobManagement.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/dashboard.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php
        require_once 'config.php';
        session_start();
        $displayUsername = getUsername($_SESSION['accountID']);
        include './nav.html';
        ?>
        
        <div id="job-list">
            <table class="jobList" id="jobList">
                    <tr>
                        <th>Reference no.</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Client</th>
                        <th>Priority</th>
                        <th>Due date</th>
                        <th>Status</th>
                        <th>Last updated</th>
                        <th>Created</th>
                    </tr>
                    <?php
                        $accountID=$_SESSION['accountID'];
                        getJobList($accountID);
                        if (isset($_POST["selectedJobID"])){
                            $jobID=$_POST["selectedJobID"]; 
                        } else {
                        $jobID=$_POST["jobID"];
                        }
                    ?>
            </table>
            
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
        <div class="grid-container">
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
                                    <input type="text" name="taskInput" placeholder="Add a task" id="addTaskInput" class="addInput">
                                    <button name="addTask" id="itemAddBtn" class="addInputBtn" onclick="addTask()">ADD</button>
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
                                    <table style="width:100%;">
                                        <tr>
                                            <th>Description</th>
                                            <th>Supplier</th>
                                            <th>Value</th>
                                            <th>Subscription end</th>
                                            <th>Procurement date</th>
                                            <th>Delivery date</th>
                                        </tr>
                                        <?php 
                                            if (isset($jobID)){
                                            getSoftwareReg($jobID); 
                                            }
                                        ?>
                                    </table>
                                </div>
                                
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
                    <br><br>
                    <label for="softwareSupplier"><b>*Supplier</b></label>
                    <br>
                    <input type="text" placeholder="Enter supplier name" name="softwareSupplier" id="softwareSupplier" required>
                    <br><br>
                    <label for="softwareValue"><b>*Value (Rand)</b></label>
                    <br>
                    <input type="number" step=".01" placeholder="Enter price" name="softwareValue" id="softwareValue" required>
                    <br><br>
                    <label for="softwareSubEnd"><b>Subscription end</b></label>
                    <br>
                    <input type="date" name="softwareSubEnd" id="softwareSubEnd">
                    <br><br>
                    <label for="softwareProcurement"><b>*Procurement date</b></label>
                    <br>
                    <input type="date" name="softwareProcurement" id="softwareProcurement">
                    <br><br>
                    <label for="softwareDelivery"><b>Delivery date</b></label>
                    <br>
                    <input type="date" name="softwareDelivery" id="softwareDelivery">
                    <br><br>
                    <input type="submit" name="softwareAddBtn" onclick="addSoftwareReg()" value="Confirm" id="softwareAddBtn" class="btn">
                    </Form>     
                </div>
            </div>
                
                <div class="job-section" id="hardware-registry">
                    <div class="client-panel panel-normal" id="clientdash-job-details">
                        <h3 class="panel-heading">Hardware registry:</h3>
                        <div class="panel-content">
                            <div class="details-div" id="task">
                                <div class="panel-content" style="width:95%">
                                    <table style="width:100%;">
                                        <tr>
                                            <th>Description</th>
                                            <th>Supplier</th>
                                            <th>Value</th>
                                            <th>Warranty initiation</th>
                                            <th>Warranty expiration</th>
                                            <th>Procurement date</th>
                                            <th>Delivery date</th>
                                        </tr>
                                <?php 
                                    if (isset($jobID)){
                                    getHardwareReg($jobID); 
                                    }
                                ?> 
                                    </table>
                                </div>

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
                        <br><br>
                        <label for="hardwareSupplier"><b>*Supplier</b></label>
                        <br>
                        <input type="text" placeholder="Enter supplier name" name="hardwareSupplier" id="hardwareSupplier" required>
                        <br><br>
                        <label for="hardwareValue"><b>*Value (Rand)</b></label>
                        <br>
                        <input type="number" step=".01" placeholder="Enter price" name="hardwareValue" id="hardwareValue" required>
                        <br><br>
                        <label for="hardwareWarrantyInitiation"><b>Warranty initiation</b></label>
                        <br>
                        <input type="date" name="hardwareWarrantyInitiation" id="hardwareWarrantyInitiation">
                        <br><br>
                        <label for="hardwareWarrantyExpiration"><b>Warranty expiration</b></label>
                        <br>
                        <input type="date" name="hardwareWarrantyExpiration" id="hardwareWarrantyExpiration">
                        <br><br>
                        <label for="hardwareProcurement"><b>*Procurement date</b></label>
                        <br>
                        <input type="date" name="hardwareProcurement" id="hardwareProcurement" required>
                        <br><br>
                        <label for="hardwareDelivery"><b>Delivery date</b></label>
                        <br>
                        <input type="date" name="hardwareDelivery" id="hardwareDelivery">
                        <br><br>
                        <input type="submit" onclick="addHardwareReg()" value="Confirm" id="hardwareAddBtn" class="btn">
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
        
        <script src="Script/jobManagement.js" type="text/javascript"></script>
        
    </body>
</html>
