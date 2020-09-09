<?php
    require_once 'config.php';

    session_start();
    $displayUsername = getUsername($_SESSION['accountID']);
    
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Sales Management</title>
        <!--Title icon link-->
        <link rel="shortcut icon" href="favicon.ico" />
        <!--CSS links-->
        <link href="CSS/style.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/dashboard.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/jquery.toast.min.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/salesManagement.css" rel="stylesheet" type="text/css"/>
        <!--JS Links-->
        <script src="Script/jquery-3.5.0.js" type="text/javascript"></script>
        <script src="Script/jquery.toast.min.js" type="text/javascript"></script>
        <script src="Script/dashboard.js" type="text/javascript"></script>
    </head>
    <body>
        <?php
        //Adds the nav menus to the screen
        include './nav.html';
        ?>
                
        <div id="existingClientsTitle">Existing Clients</div>
        <div class="wrapper">
            <div id="existingClientsContainer">
                <div class="titleBar">
                    <span>Name</span>
                    <span>Company</span>
                    <span>Upcoming Warranty</span>
                    <span>Location</span>
                    <span>Select</span>
                </div>
                
                <?php
                    global $link;
                    $clientIDs = getAllClientIDs();
                    
                    //Displays all clients with companies
                    foreach($clientIDs as $id)
                    {
                        $result = $link->query("SELECT CONCAT(contactName, ' ', contactSurname) AS FullName, 
                                                CONCAT(streetNum, ' ', streetName, ' ', suburbCity) AS location, companyName
                                                FROM Contact, Site, Clients, Company
                                                WHERE Clients.clientID = '". implode($id) ."' AND Contact.clientID = '". implode($id) ."'
                                                AND Site.clientID = '". implode($id) ."' AND Company.clientID = '". implode($id) ."';");
                        
                        if($result->num_rows > 0)
                        {
                            while($row = $result->fetch_assoc())
                            {
                                echo "<div class='client'>"
                                        . "<span>". $row["FullName"] ."</span>"
                                        . "<span>". $row["companyName"] ."</span>"
                                        . "<span>Upcoming warranty</span>"
                                        . "<span>". $row["location"] ."</span>"
                                        . "<span><input type='checkbox' name='' value='ON' /></span>"
                                    . "</div>";
                            }
                        }  
                    }
                    
                    //Displays all clients without companies
                    foreach($clientIDs as $id)
                    {
                        $result = $link->query("SELECT CONCAT(contactName, ' ', contactSurname) AS FullName, 
                                                CONCAT(streetNum, ' ', streetName, ' ', suburbCity) AS location
                                                FROM Contact, Site, Clients
                                                WHERE Clients.clientID = '". implode($id) ."' AND Contact.clientID = '". implode($id) ."'
                                                AND Site.clientID = '". implode($id) ."';");
                        
                        if($result->num_rows > 0)
                        {
                            while($row = $result->fetch_assoc())
                            {
                                echo "<div class='client'>"
                                        . "<span>". $row["FullName"] ."</span>"
                                        . "<span>N/A</span>"
                                        . "<span>Upcoming warranty</span>"
                                        . "<span>". $row["location"] ."</span>"
                                        . "<span><input type='checkbox' name='' value='ON' /></span>"
                                    . "</div>";
                            }
                        }
                    }
                ?>
                <!--TEMPLATE HTML FOR CLIENT-->
                <!--<div class="client">
                    <span>Test Name</span>
                    <span>Test Company</span>
                    <span>Test Upcoming Warranty</span>
                    <span>Test Location</span>
                    <span>Test Select</span>
                </div>-->
            </div>
        </div>
        
        <div class="wrap">
            <div id="potentialClientsContainer">
                <div id="potentialClientsTitle">Potential Clients</div>
                <div id="potential_clients">
                    <div id="potentialClientsTitleBar">
                        <span>Name</span>
                        <span>Status</span>
                        <span>Select</span>
                    </div>
                    <!--PHP TO ADD CONTENT HERE-->
                    <div id="potentialClient">
                        <span>Name</span>
                        <span>Status</span>
                        <span>Select</span>
                    </div>
                </div>
            </div>
            
            <div id="feedbackContainer">
                <div id="feedbackTitle">Recent Job Feedback and Ratings</div>
                <div id="feedback">
                    <div id="feedbackTitleBar">
                        <span>Client</span>
                        <span>Feedback</span>
                        <span>Rating</span>
                    </div>
                    <!--PHP TO ADD CONTENT HERE-->
                    <div id="clientFeedback">
                        <span>Client</span>
                        <span>Feedback</span>
                        <span>Rating</span>
                    </div>
                    <div id="clientFeedback">
                        <span>Client</span>
                        <span>Feedback</span>
                        <span>Rating</span>
                    </div>
                    <div id="clientFeedback">
                        <span>Client</span>
                        <span>Feedback</span>
                        <span>Rating</span>
                    </div>
                    <div id="clientFeedback">
                        <span>Client</span>
                        <span>Feedback</span>
                        <span>Rating</span>
                    </div>
                    <div id="clientFeedback">
                        <span>Client</span>
                        <span>Feedback</span>
                        <span>Rating</span>
                    </div>
                    <div id="clientFeedback">
                        <span>Client</span>
                        <span>Feedback</span>
                        <span>Rating</span>
                    </div>
                </div>
            </div>
        </div>

        <div id="salesStatTitle">Sales Statistics</div>
        <div id="otherInfoWrap">
            <div id="salesStatContainer">
                <!--PHP TO ADD CONTENT HERE-->
                <div class="data">
                    <span>Sales Data 1</span>
                    <div>30%</div>
                </div>
                <div class="data">
                    <span>Sales Data 2</span>
                    <div>R400</div>
                </div>
                <div class="data">
                    <span>Sales Data 3</span>
                    <div>35</div>
                </div>
                <div class="data">
                    <span>Sales Data 4</span>
                    <div>3.5/5</div>
                </div>
                <div class="data">
                    <span>Sales Data 5</span>
                    <div>45</div>
                </div>
                <div class="data">
                    <span>Sales Data 6</span>
                    <div>R800</div>
                </div>
            </div>
            
            <div id="reportDiv">
                <input type="submit" value="GENERATE REPORT" id="reportGenButton"/>
            </div>
        </div>
    </body>
</html>
