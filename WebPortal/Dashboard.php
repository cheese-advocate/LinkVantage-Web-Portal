<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Compulink Technologies</title>
        <!--Title icon link-->
        <link rel="shortcut icon" href="favicon.ico" />
        <!--CSS links-->
        <link href="CSS/style.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/dashboard.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/jquery.toast.min.css" rel="stylesheet" type="text/css"/>
        <!--JS Links-->
        <script src="Script/jquery-3.5.0.js" type="text/javascript"></script>
        <script src="Script/jquery.toast.min.js" type="text/javascript"></script>
        <script src="Script/dashboard.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="main" class="mainPage">
            <div class="topNav">
                <div id="menu" onclick="changeHam()">
                    <div class="bar" id="bar1"></div>
                    <div class="bar" id="bar2"></div>
                    <div class="bar" id="bar3"></div>
                </div>
                
                <div class="userInfo">
                    <span class="userName"></span>
                    <img src="images/account.png" alt="" class="account" onclick="accountNav()"/>
                </div>
            </div>
            
            <div id="side" class="sideNav">
                <div><img src="images/homeLink.png" alt="" id="home"/><span>Home</span></div>
                <div><img src="images/envelope.png" alt=""/><span>Jobs</span></div>
                <div><img src="images/envelope.png" alt=""/><span>Invoices</span></div>
                <div><img src="images/account.png" alt=""/><span>Clients</span></div>
                <div><img src="images/information.png" alt=""/><span>Info</span></div>
            </div>
            
            <div id="account" class="accountNav">
                <div>Manage Account</div>
                <div>Preferences</div>
                <div onclick="logOut()">Log out</div>
            </div>
        </div>
    </body>
</html>
