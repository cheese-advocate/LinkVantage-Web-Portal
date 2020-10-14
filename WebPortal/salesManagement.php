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
        include './nav.php';
        ?>
                
        <div id="existingClientsTitle">Existing Clients</div>
        <div class="wrapper">
            <div id="existingClientsContainer">
                <div class="titleBar">
                    <span>Name</span>
                    <span>Company</span>
                    <span>Upcoming Warranty</span>
                    <span>Location</span>
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
                                        . "<span><a href='https://maps.google.com/maps?q=". $row["location"] ."' target='_blank'>". $row["location"] ."</a></span>"
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
                                        . "<span><a href='https://maps.google.com/maps?q=". $row["location"] ."' target='_blank'>". $row["location"] ."</a></span>"
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
                    </div>
                    <!--PHP TO ADD CONTENT HERE
                    THIS INFORMATION IS NOT AVAILABLE IN THE DATABASE YET-->
                    <?php
                        global $link;
                        $result = $link->query("SELECT CONCAT(firstName, ' ', lastName) AS FullName, interest FROM potentialClients;");
                        
                        if($result->num_rows > 0)
                        {
                            while($row = $result->fetch_assoc())
                            {
                                echo "<div id=potentialClient>"
                                        . "<span>". $row["FullName"] ."</span>"
                                        . "<span>". $row["interest"] ."</span>"
                                    . "</div>";
                            }
                        }
                    ?>
                    
                    
                    <!--
                    TEMPLATE FOR POTENTIAL CLIENT
                    <div id="potentialClient">
                        <span>Name</span>
                        <span>Status</span>
                        <span>Select</span>
                    </div>-->
                </div>
            </div>
            
            <div id="feedbackContainer">
                <div id="feedbackTitle">Recent Job Feedback and Ratings</div>
                <div id="feedback">
                    <div id="feedbackTitleBar">
                        <span>Client</span>
                        <span>Job Description</span>
                        <span>Feedback</span>
                    </div>
                    
                    <?php
                        global $link;
                        
                        $result = $link->query("SELECT CONCAT(contactName,' ',contactSurname) AS clientName, jobDescription, content FROM Job, Feedback, Contact
                                                WHERE Job.jobID = Feedback.jobID AND Feedback.contactID = Contact.contactID;");
                        
                        if($result->num_rows > 0)
                        {
                            while($row = $result->fetch_assoc())
                            {
                                if($row["jobDescription"] == null)
                                {
                                    $row["jobDescription"] = "No Description";
                                }
                                
                                echo "<div id='clientFeedback'>"
                                        . "<span>". $row["clientName"] ."</span>"
                                        . "<span>". $row["jobDescription"] ."</span>"
                                        . "<span>". $row["content"] ."</span>"
                                    . "</div>";
                            }
                        }
                    ?>
                    
                    <!--FEEDBACK TEMPLATE-->
                    <!--<div id="clientFeedback">
                        <span>Client</span>
                        <span>Feedback</span>
                        <span>Rating</span>
                    </div>-->
                </div>
            </div>
        </div>

        <div id="salesStatTitle">Sales Statistics</div>
        <div id="otherInfoWrap">
            <div id="salesStatContainer">
                <?php
                    $client_count = getClientCount();
                    
                    echo "<div class='data'>"
                            . "<span>Total Clients</span>"
                            . "<div>". $client_count ."</div>"
                        . "</div>";
                    
                    $job_count = getJobCount();
                    
                    echo "<div class='data'>"
                            . "<span>Total Jobs</span>"
                            . "<div>". $job_count ."</div>"
                        . "</div>";
                    
                    $company_count = getCompanyCount();
                    
                    echo "<div class='data'>"
                            . "<span>Registered Companies</span>"
                            . "<div>". $company_count ."</div>"
                        . "</div>";
                ?>
                
                <!--TEMPLATE FOR STATISTICS-->
                <!--<div class="data">
                    <span>Sales Data 1</span>
                    <div>30%</div>
                </div>-->
            </div>
            
            <div id="reportDiv">
                <input type="submit" value="GENERATE REPORT" id="reportGenButton" onclick="generatePDF();"/>
            </div>
        </div>
    </body>
</html>
