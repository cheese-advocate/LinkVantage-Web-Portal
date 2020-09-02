<?php

?>

<!DOCTYPE html>

<html>
    
    <link href="CSS/clientDash.css" rel="stylesheet" type="text/css"/>
    
    <div class="client-content">
    
        <div class="client-row" id="active-job">

            <div class="client-row-header">                
                <h2 class="row-header-text">Active job:</h2>

                <select name="active-job" class="dropDownSelect" id="active-job" onchange="modifyActiveJob()">                    
                    <option name="job1">example1</option>
                    <option name="job2">example2</option>
                </select>
            </div>
            
            <div class="client-row-content">
                
                <div class="panel-normal" id="clientdash-job-details">

                </div>

                <div class="panel-normal" id="clientdash-job-updates">

                </div>

                <div class="panel-normal" id="clientdash-job-chat">

                </div>
                
            </div>

        </div>

        <div class="client-row" id="activities-history">

            <div class="client-row-header">
                <h2 class="row-header-text">Activities History</h2>
            </div>

            <div class="client-row-content">
            
                <div class="panel-double" id="clientdash-history-jobs">

                </div>

                <div class="panel-normal" id="clientdash-history-queries">

                </div>

            </div>
            
        </div>
        
    </div>    
</html>
