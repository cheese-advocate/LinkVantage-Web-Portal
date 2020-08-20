<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="Script/script.js" type="text/javascript"></script>
        <link href="CSS/style.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/jobManagement.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php
        require_once 'config.php';
        
        ?>
        <div id="job-management-header">
            
        </div>
        <div id="job-list">
            
        </div>
        <div id="job-info">
            <div id="first-rows">
                <div class="job-header">
                    <select></select>
                    
                    <?php
                    echo $selectedJob.toJobHeaderHTML();
                    ?>
                </div>
                <div class="description">
                    
                </div>
            </div>
            <div id="remaining-grid">
                <div class="job-section" id="tasks">
                    
                </div>
                <div class="job-section" id="milestones">
                    
                </div>
                <div class="job-section" id="chat">
                    
                </div>
                <div class="job-section" id="software-registry">
                    
                </div>
                <div class="job-section" id="hardware-registry">
                    
                </div>
                <div class="job-section" id="updates">
                    <div class="job-section-heading">
                        
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
