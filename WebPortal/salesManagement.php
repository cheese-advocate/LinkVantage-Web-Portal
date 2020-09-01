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
    <body id="main">
        <div class="topNav">
            <div id="menu" onclick="changeHam()">
                <div class="bar" id="bar1"></div>
                <div class="bar" id="bar2"></div>
                <div class="bar" id="bar3"></div>
            </div>
              
            <div class="userInfo">
                <span class="userName" onclick="accountNav()"><?php echo $displayUsername?></span><!--TO BE REPLACED WITH USERNAME FROM PHP SIDE-->
                <img src="images/account.png" alt="" class="account" onclick="accountNav()"/>
            </div>
        </div>
            
        <div id="side" class="sideNav">
            <div onclick="navigate('home')"><img src="images/home_gray.png" alt="" id="home"/><span>Home</span></div>
            <div><img src="images/suitcase.png" alt=""/><span>Jobs</span></div>
            <div onclick="navigate('sales')"><img src="images/write.png" alt=""/><span>Sales</span></div>
            <div><img src="images/account.png" alt=""/><span>Clients</span></div>
            <div onclick="info()"><img src="images/information.png" alt=""/><span>Info</span></div>
            <div><img src="images/gear.png" alt=""/><span>Settings</span></div>
        </div>
            
        <div id="account" class="accountNav">
            <div>Manage Account</div>
            <div>Preferences</div>
            <div onclick="logOut()">Log out</div>
        </div>
        
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
                <!--PHP TO DYNAMICALLY ADD CONTENT HERE-->
                <div class="client">
                    <span>Test Name</span>
                    <span>Test Company</span>
                    <span>Test Upcoming Warranty</span>
                    <span>Test Location</span>
                    <span>Test Select</span>
                </div>
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

        <!--REST OF PAGE CONTENT TO FOLLOW HERE-->
    </body>
</html>
