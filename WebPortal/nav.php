<html>
    <head>
        <meta charset="UTF-8">
        <title>Compulink Technologies</title>
        <!--Title icon link-->
        <link rel="shortcut icon" href="favicon.ico" />
    </head>
    <body id="nav-body">
        <div class="topNav">
            <div id="menu" onclick="changeHam()">
                <div class="bar" id="bar1"></div>
                <div class="bar" id="bar2"></div>
                <div class="bar" id="bar3"></div>
            </div>

            <div class="userInfo">
                <span class="userName" onclick="accountNav()"><?php echo $displayUsername?></span>
                <img src="images/account.png" alt="" class="account" onclick="accountNav()"/>
            </div>
        </div>

        <div id="side" class="sideNav">
            <?php
                if(isset($_SESSION['contactID'])){
                    include './clientHamburger.html';
                } else {
                    if(isset($_SESSION['technicianID'])){
                        include './technicianHamburger.html';
                    }
                }         
            ?>
        </div>

        <div id="account" class="accountNav">
            <div>Manage Account</div>
            <div>Preferences</div>
            <div onclick="logOut()">Log out</div>
        </div>
    </body>
</html>
