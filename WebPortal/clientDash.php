<?php

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">        
    </head>
        
    <body>
        
        <div id="active-job">
            
            <div class="content-header-bar">
                <h2 class="content-header-text">Active job:</h2>
                
                <select name="reset_options" class="dropDownSelect" id="reset_options" onchange="modifyActiveJob()">                    
                    <option name="RESET PASSWORD">RESET PASSWORD</option>
                    <option name="ANDROID OTP">ANDROID OTP</option>
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
            
        </div>
        
    </body>
</html>
