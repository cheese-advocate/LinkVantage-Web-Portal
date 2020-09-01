<?php

?>

<!DOCTYPE html>

<html>
    <div id="active-job">
            
        <div class="content-header-bar">
            <h2 class="content-header-text">Active job:</h2>

            <select name="active-job" class="dropDownSelect" id="active-job" onchange="modifyActiveJob()">                    
                <option name="job1">example1</option>
                <option name="job2">example2</option>
            </select>

        </div>

        <div class="panel-normal" id="clientdash-job-details">

        </div>

        <div class="panel-normal" id="clientdash-job-updates">

        </div>

        <div class="panel-normal" id="clientdash-job-chat">

        </div>
            
        </div>
        
    <div id="activities-history">

        <div class="content-header-bar">
            <h2 class="content-header-text">Activities History</h2>
        </div>

        <div class="panel-double" id="clientdash-history-jobs">

        </div>

        <div class="panel-normal" id="clientdash-history-queries">

        </div>

    </div>
</html>
