<?php
    global $localUserName;
    global $externalUserName;
    global $localUserType;
    global $jobID;
    
    function setLocalUserType($type){
        global $localUserType;
        $localUserType = $type;
    }
    
    function setLocalUserName($name){
        global $localUserName;
        $localUserName = $name;
    }
    
    function setExternalUserName($name){
        global $externalUserName;
        $externalUserName = $name;
    }
    
    function setJobID($id){
        global $jobID;
        $jobID = $id;
    }
    
    //$retrieval = $_GET["retrieval"];
    //$messages = getAllMessages($jobID);
    
    
    //$newMessage = $_POST["newMessageText"];
 ?>

<html onload="/*startChat()*/">            
    <link href="CSS/chat.css" rel="stylesheet" type="text/css"/>
    <script src="Script/chat.js" type="text/javascript"></script>
    <div class="client-panel panel-normal" id="clientdash-job-chat"">
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
                <input type="text" id="message-text" name="message-text" placeholder="Send a message...">
                <button type="button" id="message-send" name="message-send" onclick="sendMessage()">SEND</button>
            </div>                        

        </div>
    </div>

</html>

