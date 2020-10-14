<?php

?>

<!DOCTYPE html>

<html>
    
    <head>
        <link href="CSS/clientDash.css" rel="stylesheet" type="text/css"/>
        <script src="Script/dotdotdot.js" type="text/javascript"></script>
        <script src="Script/clientportal.js" type="text/javascript"></script>
        <link href="CSS/fontawesome.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/solid.css" rel="stylesheet" type="text/css"/>
    </head>
    
    <body>
        
        <?php include "./nav.php" ?>        
        
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

                    <div class="client-panel panel-normal" id="clientdash-job-details">

                        <h3 class="panel-heading">Details:</h3>

                        <div class="panel-content">

                            <div class="details-div" id="ref-no">
                                <h4 class="details-heading">Reference number:</h4>
                                <span class="details-info">#239067</span>
                            </div>

                            <div class="details-div" id="description">
                                <h4 class="details-heading">Description:</h4>
                                <span class="details-info">Supply new pc's and redo networking</span>
                            </div>

                            <div class="details-div" id="location">
                                <h4 class="details-heading">Location:</h4>
                                <span class="details-info">Kaapzicht Building, 9 Rogers Street, Tyger Valley,  7530</span>
                            </div>

                            <div class="details-div" id="status">
                                <h4 class="details-heading">Status:</h4>
                                <span class="details-info">In progress</span>
                            </div>

                            <div class="details-div" id="due-date">
                                <h4 class="details-heading">Due date:</h4>
                                <span class="details-info">22 July 2020</span>
                            </div>

                            <div class="details-div" id="technician">
                                <h4 class="details-heading">Technician:</h4>
                                <span class="details-info">Jan Nienaber</span>
                            </div>

                        </div>

                    </div>

                    <div class="client-panel panel-normal" id="clientdash-job-updates">
                        <h3 class="panel-heading">Updates:</h3>

                        <div class="panel-content">
                            <h4>Update</h4>
                            <h4 class="updates-heading-feedback">Feedback</h4>

                            <div class="update-milestone">
                                <div class="milestone-completion-time">
                                    July 18 - 10:35
                                </div>

                                <div class="milestone-completion-details">
                                    Completed milestone 
                                    <span class="milestone-name">'Stock ordered'</span>                                
                                </div>
                            </div>

                            <div class="update-feedback">
                                <div class="update-feedback-triangle"> </div>
                                This is an example of  client facing feedback
                            </div>


                            <div class="update-milestone">
                                <div class="milestone-completion-time">
                                    July 18 - 10:35
                                </div>

                                <div class="milestone-completion-details">
                                    Completed milestone 
                                    <span class="milestone-name">'Stock ordered'</span>                                
                                </div>
                            </div>

                            <div class="update-feedback">
                                <div class="update-feedback-triangle"> </div>
                                This is an example of  client facing feedback
                            </div>


                            <div class="update-milestone">
                                <div class="milestone-completion-time">
                                    July 18 - 10:35
                                </div>

                                <div class="milestone-completion-details">
                                    Completed milestone 
                                    <span class="milestone-name">'Stock ordered'</span>                                
                                </div>
                            </div>

                            <div class="update-feedback">
                                <div class="update-feedback-triangle"> </div>
                                This is an example of  client facing feedback
                            </div>


                            <div class="update-milestone">
                                <div class="milestone-completion-time">
                                    July 18 - 10:35
                                </div>

                                <div class="milestone-completion-details">
                                    Completed milestone 
                                    <span class="milestone-name">'Stock ordered'</span>                                
                                </div>
                            </div>

                            <div class="update-feedback">
                                <div class="update-feedback-triangle"> </div>
                                This is an example of  client facing feedback
                            </div>


                            <div class="update-milestone">
                                <div class="milestone-completion-time">
                                    July 18 - 10:35
                                </div>

                                <div class="milestone-completion-details">
                                    Completed milestone 
                                    <span class="milestone-name">'Stock ordered'</span>                                
                                </div>
                            </div>

                            <div class="update-feedback">
                                <div class="update-feedback-triangle"> </div>
                                This is an example of  client facing feedback
                            </div>


                            <div class="update-milestone">
                                <div class="milestone-completion-time">
                                    July 18 - 10:35
                                </div>

                                <div class="milestone-completion-details">
                                    Completed milestone 
                                    <span class="milestone-name">'Stock ordered'</span>                                
                                </div>
                            </div>

                            <div class="update-feedback">
                                <div class="update-feedback-triangle"> </div>
                                This is an example of  client facing feedback
                            </div>


                            <div class="update-milestone">
                                <div class="milestone-completion-time">
                                    July 18 - 10:35
                                </div>

                                <div class="milestone-completion-details">
                                    Completed milestone 
                                    <span class="milestone-name">'Stock ordered'</span>                                
                                </div>
                            </div>

                            <div class="update-feedback">
                                <div class="update-feedback-triangle"> </div>
                                This is an example of  client facing feedback
                            </div>


                            <div class="update-milestone">
                                <div class="milestone-completion-time">
                                    July 18 - 10:35
                                </div>

                                <div class="milestone-completion-details">
                                    Completed milestone 
                                    <span class="milestone-name">'Stock ordered'</span>                                
                                </div>
                            </div>

                            <div class="update-feedback">
                                <div class="update-feedback-triangle"> </div>
                                This is an example of  client facing feedback
                            </div>


                            <div class="update-milestone">
                                <div class="milestone-completion-time">
                                    July 18 - 10:35
                                </div>

                                <div class="milestone-completion-details">
                                    Completed milestone 
                                    <span class="milestone-name">'Stock ordered'</span>                                
                                </div>
                            </div>

                            <div class="update-feedback">
                                <div class="update-feedback-triangle"> </div>
                                This is an example of  client facing feedback
                            </div>

                        </div>
                    </div>

                    <div class="client-panel panel-normal" id="clientdash-job-chat">
                        <h3 class="panel-heading">Chat:</h3>

                        <div class="panel-content">

                            <div class="chat-messages">

                                <div class="chat-message message-to">

                                    <div class="message-content">
                                        <span class="message">
                                            Hi Jan. Any update on the new pc's?
                                        </span>
                                    </div>

                                    <span class="message-time">
                                        July 11 - 14:20
                                    </span>

                                </div>

                                <div class="chat-message message-from">

                                    <div class="message-content">
                                        <span class="message-content-sender">
                                            Jan Nienaber
                                        </span>
                                        <span class="message">
                                            Hi Tristan. Ran into some unexpected 
                                            issues, but got them sorted out. Should 
                                            be finished setting them up soon.
                                        </span>
                                    </div>

                                    <span class="message-time">
                                        July 21 - 14:27
                                    </span>

                                </div>

                                <div class="chat-message message-to">

                                    <div class="message-content">
                                        <span class="message">
                                            Sounds good. Thanks for the update!
                                        </span>
                                    </div>

                                    <span class="message-time">
                                        July 21 - 14:30
                                    </span>

                                </div>

                                <div class="chat-message message-to">

                                    <div class="message-content">
                                        <span class="message">
                                            Sounds good. Thanks for the update!
                                        </span>
                                    </div>

                                    <span class="message-time">
                                        July 21 - 14:30
                                    </span>

                                </div>

                                <div class="chat-message message-to">

                                    <div class="message-content">
                                        <span class="message">
                                            Sounds good. Thanks for the update!
                                        </span>
                                    </div>

                                    <span class="message-time">
                                        July 21 - 14:30
                                    </span>

                                </div>

                            </div>

                            <div class="chat-send-message">
                                <img src="images/envelope.png" alt="" id="message-icon">
                                <input type="text" id="message-text" name="message-text" placeholder="Message Jan...">
                                <input type="button" id="message-send" name="message-send" value="SEND">
                            </div>                        

                        </div>
                    </div>

                </div>

            </div>

            <div class="client-row" id="activities-history">

                <div class="client-row-header">
                    <h2 class="row-header-text">Activities History</h2>

                        <div class="panel-content">

                        </div>
                </div>

                <div class="client-row-content">

                    <div class="client-panel panel-double" id="clientdash-history-jobs">
                        <h3 class="panel-heading">Previous jobs:</h3>

                        <div class="panel-content">

                            <table class="history-job-table">

                               <tr class="history-job-header">
                                    <th class="history-job-cell">Description</td>
                                    <th class="history-job-cell">Location</td>
                                    <th class="history-job-cell">Technician</td>
                                    <th class="history-job-cell">Due date</td>
                                    <th class="history-job-cell">Date completed</td>
                                    <th class="history-job-cell">Appraisal</td>
                                    <th class="history-job-cell">Feedback</td>
                                </tr>

                                <tr class="history-job-row">
                                    <td class="history-job-cell">Description example 1</td>
                                    <td class="history-job-cell">Kaapzicht Building, 9 Rogers Street, Tyger Valley,  7530</td>
                                    <td class="history-job-cell">Jan Nienaber</td>
                                    <td class="history-job-cell">01/06/2020</td>
                                    <td class="history-job-cell">1/06/2020</td>
                                    <td class="history-job-cell">
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-unchecked"></i>
                                        <i class="fas fa-star rating-unchecked"></i>
                                    </td>
                                    <td class="history-job-cell">Feedback example</td>
                                </tr>
                                <tr class="history-job-row">
                                    <td class="history-job-cell">Description example 1</td>
                                    <td class="history-job-cell">Kaapzicht Building, 9 Rogers Street, Tyger Valley,  7530</td>
                                    <td class="history-job-cell">Jan Nienaber</td>
                                    <td class="history-job-cell">01/06/2020</td>
                                    <td class="history-job-cell">1/06/2020</td>
                                    <td class="history-job-cell">
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-unchecked"></i>
                                        <i class="fas fa-star rating-unchecked"></i>
                                    </td>
                                    <td class="history-job-cell">Feedback example</td>
                                </tr>
                                <tr class="history-job-row">
                                    <td class="history-job-cell">Description example 1</td>
                                    <td class="history-job-cell">Kaapzicht Building, 9 Rogers Street, Tyger Valley,  7530</td>
                                    <td class="history-job-cell">Jan Nienaber</td>
                                    <td class="history-job-cell">01/06/2020</td>
                                    <td class="history-job-cell">1/06/2020</td>
                                    <td class="history-job-cell">
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-unchecked"></i>
                                        <i class="fas fa-star rating-unchecked"></i>
                                    </td>
                                    <td class="history-job-cell">Feedback example</td>
                                </tr>
                                <tr class="history-job-row">
                                    <td class="history-job-cell">Description example 1</td>
                                    <td class="history-job-cell">Kaapzicht Building, 9 Rogers Street, Tyger Valley,  7530</td>
                                    <td class="history-job-cell">Jan Nienaber</td>
                                    <td class="history-job-cell">01/06/2020</td>
                                    <td class="history-job-cell">1/06/2020</td>
                                    <td class="history-job-cell">
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-unchecked"></i>
                                        <i class="fas fa-star rating-unchecked"></i>
                                    </td>
                                    <td class="history-job-cell">Feedback example</td>
                                </tr>
                                <tr class="history-job-row">
                                    <td class="history-job-cell">Description example 1</td>
                                    <td class="history-job-cell">Kaapzicht Building, 9 Rogers Street, Tyger Valley,  7530</td>
                                    <td class="history-job-cell">Jan Nienaber</td>
                                    <td class="history-job-cell">01/06/2020</td>
                                    <td class="history-job-cell">1/06/2020</td>
                                    <td class="history-job-cell">
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-unchecked"></i>
                                        <i class="fas fa-star rating-unchecked"></i>
                                    </td>
                                    <td class="history-job-cell">Feedback example</td>
                                </tr>
                                <tr class="history-job-row">
                                    <td class="history-job-cell">Description example 1</td>
                                    <td class="history-job-cell">Kaapzicht Building, 9 Rogers Street, Tyger Valley,  7530</td>
                                    <td class="history-job-cell">Jan Nienaber</td>
                                    <td class="history-job-cell">01/06/2020</td>
                                    <td class="history-job-cell">1/06/2020</td>
                                    <td class="history-job-cell">
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-unchecked"></i>
                                        <i class="fas fa-star rating-unchecked"></i>
                                    </td>
                                    <td class="history-job-cell">Feedback example</td>
                                </tr>
                                <tr class="history-job-row">
                                    <td class="history-job-cell">Description example 1</td>
                                    <td class="history-job-cell">Kaapzicht Building, 9 Rogers Street, Tyger Valley,  7530</td>
                                    <td class="history-job-cell">Jan Nienaber</td>
                                    <td class="history-job-cell">01/06/2020</td>
                                    <td class="history-job-cell">1/06/2020</td>
                                    <td class="history-job-cell">
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-unchecked"></i>
                                        <i class="fas fa-star rating-unchecked"></i>
                                    </td>
                                    <td class="history-job-cell">Feedback example</td>
                                </tr>
                                <tr class="history-job-row">
                                    <td class="history-job-cell">Description example 1</td>
                                    <td class="history-job-cell">Kaapzicht Building, 9 Rogers Street, Tyger Valley,  7530</td>
                                    <td class="history-job-cell">Jan Nienaber</td>
                                    <td class="history-job-cell">01/06/2020</td>
                                    <td class="history-job-cell">1/06/2020</td>
                                    <td class="history-job-cell">
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-unchecked"></i>
                                        <i class="fas fa-star rating-unchecked"></i>
                                    </td>
                                    <td class="history-job-cell">Feedback example</td>
                                </tr>
                                <tr class="history-job-row">
                                    <td class="history-job-cell">Description example 1</td>
                                    <td class="history-job-cell">Kaapzicht Building, 9 Rogers Street, Tyger Valley,  7530</td>
                                    <td class="history-job-cell">Jan Nienaber</td>
                                    <td class="history-job-cell">01/06/2020</td>
                                    <td class="history-job-cell">1/06/2020</td>
                                    <td class="history-job-cell">
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-unchecked"></i>
                                        <i class="fas fa-star rating-unchecked"></i>
                                    </td>
                                    <td class="history-job-cell">Feedback example</td>
                                </tr>
                                <tr class="history-job-row">
                                    <td class="history-job-cell">Description example 1</td>
                                    <td class="history-job-cell">Kaapzicht Building, 9 Rogers Street, Tyger Valley,  7530</td>
                                    <td class="history-job-cell">Jan Nienaber</td>
                                    <td class="history-job-cell">01/06/2020</td>
                                    <td class="history-job-cell">1/06/2020</td>
                                    <td class="history-job-cell">
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-unchecked"></i>
                                        <i class="fas fa-star rating-unchecked"></i>
                                    </td>
                                    <td class="history-job-cell">Feedback example</td>
                                </tr>
                                <tr class="history-job-row">
                                    <td class="history-job-cell">Description example 1</td>
                                    <td class="history-job-cell">Kaapzicht Building, 9 Rogers Street, Tyger Valley,  7530</td>
                                    <td class="history-job-cell">Jan Nienaber</td>
                                    <td class="history-job-cell">01/06/2020</td>
                                    <td class="history-job-cell">1/06/2020</td>
                                    <td class="history-job-cell">
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-unchecked"></i>
                                        <i class="fas fa-star rating-unchecked"></i>
                                    </td>
                                    <td class="history-job-cell">Feedback example</td>
                                </tr>
                                <tr class="history-job-row">
                                    <td class="history-job-cell">Description example 1</td>
                                    <td class="history-job-cell">Kaapzicht Building, 9 Rogers Street, Tyger Valley,  7530</td>
                                    <td class="history-job-cell">Jan Nienaber</td>
                                    <td class="history-job-cell">01/06/2020</td>
                                    <td class="history-job-cell">1/06/2020</td>
                                    <td class="history-job-cell">
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-unchecked"></i>
                                        <i class="fas fa-star rating-unchecked"></i>
                                    </td>
                                    <td class="history-job-cell">Feedback example</td>
                                </tr>
                                <tr class="history-job-row">
                                    <td class="history-job-cell">Description example 1</td>
                                    <td class="history-job-cell">Kaapzicht Building, 9 Rogers Street, Tyger Valley,  7530</td>
                                    <td class="history-job-cell">Jan Nienaber</td>
                                    <td class="history-job-cell">01/06/2020</td>
                                    <td class="history-job-cell">1/06/2020</td>
                                    <td class="history-job-cell">
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-unchecked"></i>
                                        <i class="fas fa-star rating-unchecked"></i>
                                    </td>
                                    <td class="history-job-cell">Feedback example</td>
                                </tr>
                                <tr class="history-job-row">
                                    <td class="history-job-cell">Description example 1</td>
                                    <td class="history-job-cell">Kaapzicht Building, 9 Rogers Street, Tyger Valley,  7530</td>
                                    <td class="history-job-cell">Jan Nienaber</td>
                                    <td class="history-job-cell">01/06/2020</td>
                                    <td class="history-job-cell">1/06/2020</td>
                                    <td class="history-job-cell">
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-unchecked"></i>
                                        <i class="fas fa-star rating-unchecked"></i>
                                    </td>
                                    <td class="history-job-cell">Feedback example</td>
                                </tr>
                                <tr class="history-job-row">
                                    <td class="history-job-cell">Description example 1</td>
                                    <td class="history-job-cell">Kaapzicht Building, 9 Rogers Street, Tyger Valley,  7530</td>
                                    <td class="history-job-cell">Jan Nienaber</td>
                                    <td class="history-job-cell">01/06/2020</td>
                                    <td class="history-job-cell">1/06/2020</td>
                                    <td class="history-job-cell">
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-unchecked"></i>
                                        <i class="fas fa-star rating-unchecked"></i>
                                    </td>
                                    <td class="history-job-cell">Feedback example</td>
                                </tr>
                                <tr class="history-job-row">
                                    <td class="history-job-cell">Description example 1</td>
                                    <td class="history-job-cell">Kaapzicht Building, 9 Rogers Street, Tyger Valley,  7530</td>
                                    <td class="history-job-cell">Jan Nienaber</td>
                                    <td class="history-job-cell">01/06/2020</td>
                                    <td class="history-job-cell">1/06/2020</td>
                                    <td class="history-job-cell">
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-checked"></i>
                                        <i class="fas fa-star rating-unchecked"></i>
                                        <i class="fas fa-star rating-unchecked"></i>
                                    </td>
                                    <td class="history-job-cell">Feedback example</td>
                                </tr>

                            </table>

                            <!--<div class="history-job-header">
                                <span class="history-job-cell">Description</span>
                                <span class="history-job-cell">Location</span>
                                <span class="history-job-cell">Technician</span>
                                <span class="history-job-cell">Due date</span>
                                <span class="history-job-cell">Date completed</span>
                                <span class="history-job-cell">Appraisal</span>
                                <span class="history-job-cell">Feedback</span>
                            </div>

                            <div class="history-job-row">
                                <span class="history-job-cell">Description example 1</span>
                                <span class="history-job-cell">Kaapzicht Building, 9 Rogers Street, Tyger Valley,  7530</span>
                                <span class="history-job-cell">Jan Nienaber</span>
                                <span class="history-job-cell">01/06/2020</span>
                                <span class="history-job-cell">1/06/2020</span>
                                <span class="history-job-cell">Appraisal</span>
                                <span class="history-job-cell">Feedback example</span>
                            </div>-->

                        </div>
                    </div>

                    <div class="client-panel panel-normal" id="clientdash-history-queries">
                        <h3 class="panel-heading">Queries:</h3>
                                                
                        <div class="panel-content">

                            <div class="queries-query-list">
                                
                                <div class="query">
                                    
                                    <div class="query-date-category">
                                        <span class="query-date">11/06/2020</span>
                                        <span class="query-category">Job request</span>
                                    </div>
                                    
                                    <div class="query-description">
                                        <span class="query-text">
                                            Lorem ipsum dolor sit amet, consectetur 
                                            adipiscing elit. Curabitur commodo sem ut 
                                            tellus elementum, at sollicitudin ante interdum. 
                                            Praesent sit amet sodales elit, id fermentum velit. 
                                            Nulla in quam quis leo tincidunt bibendum sit amet 
                                            a arcu. Cras nec nulla nec magna pretium feugiat 
                                            nec ut ipsum. Lorem ipsum dolor sit amet, consectetur 
                                            adipiscing elit. Quisque scelerisque, dolor vel 
                                            volutpat cursus, libero ligula malesuada turpis, 
                                            vitae vehicula diam libero nec nisi. Nullam augue leo, 
                                            rutrum at rutrum sed, molestie sit amet diam. Cras 
                                            neque neque, laoreet congue enim sit amet, interdum 
                                            tristique neque. Sed imperdiet dictum purus, non 
                                            placerat purus efficitur sit amet. Nullam a pulvinar 
                                            neque. Curabitur dictum, sapien non accumsan facilisis, 
                                            nibh mauris scelerisque mauris, ac porttitor arcu nunc 
                                            vel ex. Integer eu sapien nisl.
                                        </span>
                                    </div>
                                    <a id="query-toggle-show" class='toggle-show' href='#' onclick="toggleShow()">Show more</a>
                                    
                                    <div class="query-status-response">
                                        <div class="query-status-div">
                                            <span class="query-prompt">
                                                Status:
                                            </span>
                                            <span class="query-data">
                                                Closed
                                            </span>
                                        </div>
                                        
                                        <div class="query-response-div">
                                            <span class="query-prompt">
                                                Response from:
                                            </span>
                                            <span class="query-data">
                                                Jan Nienaber
                                            </span>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <div class="query">
                                    
                                    <div class="query-date-category">
                                        <span class="query-date">16/06/2020</span>
                                        <span class="query-category">Job request</span>
                                    </div>
                                    
                                    <div class="query-description">
                                        <span class="query-text">
                                            This is a test of a much shorter body
                                            of text to ensure that everything is 
                                            working
                                        </span>
                                    </div>
                                    <a id="query-toggle-show" class='toggle-show' href='#' onclick="toggleShow()">Show more</a>
                                    
                                    <div class="query-status-response">
                                        <div class="query-status-div">
                                            <span class="query-prompt">
                                                Status:
                                            </span>
                                            <span class="query-data">
                                                Closed
                                            </span>
                                        </div>
                                        
                                        <div class="query-response-div">
                                            <span class="query-prompt">
                                                Response from:
                                            </span>
                                            <span class="query-data">
                                                Jan Nienaber
                                            </span>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <div class="query">
                                    
                                    <div class="query-date-category">
                                        <span class="query-date">20/06/2020</span>
                                        <span class="query-category">Job request</span>
                                    </div>
                                    
                                    <div class="query-description">
                                        <span class="query-text">
                                            This is a test of a much shorter body
                                            of text to ensure that everything is 
                                            working
                                        </span>
                                    </div>
                                    <a id="query-toggle-show" class='toggle-show' href='#' onclick="toggleShow()">Show more</a>
                                    
                                    <div class="query-status-response">
                                        <div class="query-status-div">
                                            <span class="query-prompt">
                                                Status:
                                            </span>
                                            <span class="query-data">
                                                In progress
                                            </span>
                                        </div>
                                        
                                        <div class="query-response-div">
                                            <span class="query-prompt">
                                                Response from:
                                            </span>
                                            <span class="query-data">
                                                Jan Nienaber
                                            </span>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                            </div>

                            <div class="queries-new-query">
                                <button class="new-query-button">CREATE NEW QUERY</button>
                            </div>
                            
                        </div>
                    </div>

                </div>

            </div>

        </div>    
    </body>
</html>
