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
        <script src="Script/script.js" type="text/javascript"></script>
        <link href="CSS/style.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/jobManagement.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php
        require 'config.php';
        ?>
        <div id="job-management-header">
            <div class="client-row-header">
                <div class="panel-content">
                    <table>
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
            </div>
        </div>
        
        <div id="job-list">
            <?php
                session_start();
                $accountID=$_SESSION['accountID'];
                echo $accountID;
                getJobList($accountID)
            ?>
        </div>
        <div id="job-info">
            <div id="first-rows">
                <div class="job-header">
                    <div class="client-row-header">
                        <div class="panel-content">
                            <?php
                            $jobID=$_SESSION['jobID'];
                            getJobDetails($jobID) 
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
                                        $jobID=$_SESSION['jobID'];
                                        getJobDescription($jobID) 
                                    ?>
                                </span>
                            </div>                      
                        </div>
                    </div>
                </div>
                
            </div>
        </div>    
            <div class="client-row-content" id="remaining-grid"">
                
                
                <div class="job-section" id="tasks">
                    <div class="client-panel panel-normal" id="clientdash-job-details">
                        <h3 class="panel-heading">Task:</h3>
                        <div class="panel-content">
                            <div class="details-div" id="task">
                                <?php 
                                    $jobID=$_SESSION['jobID'];
                                    getJobTask($jobID) 
                                ?>
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
                                    $jobID=$_SESSION['jobID'];
                                    getJobMilestone($jobID) 
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
                                <?php 
                                $jobID=$_SESSION['jobID'];
                                getSoftwareReg($jobID) 
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="job-section" id="hardware-registry">
                    <div class="client-panel panel-normal" id="clientdash-job-details">
                        <h3 class="panel-heading">Hardware registry:</h3>
                        <div class="panel-content">
                            <div class="details-div" id="task">
                                <?php 
                                $jobID=$_SESSION['jobID'];
                                getHardwareReg($jobID) 
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="job-section" id="updates">
                    <div class="job-section-heading">
                        <div class="client-panel panel-normal" id="clientdash-job-details">
                        <h3 class="panel-heading">Updates:</h3>
                        <div class="panel-content">
                            <div class="details-div" id="task">
                                <?php 
                                $jobID=$_SESSION['jobID'];
                                getJobUpdate($jobID) 
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
