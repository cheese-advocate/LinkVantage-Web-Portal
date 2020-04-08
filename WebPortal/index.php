<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Compulink Technologies</title>
        <!-- Displays Compulink logo in title bar of web pages -->
        <link rel="shortcut icon" href="images/logo_block__1__AHI_icon.ico" />
        <!-- Link external CSS to the main Index page -->
        <link href="CSS/style.css" rel="stylesheet" type="text/css"/>
        <script src="Script/script.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="mainPage">
            <div class="header">
                Compulink Technologies
            </div>
            
            <div class="content">
                <div class="logo">
                    <img src="images/logo_block_cropped.png" alt="" id="compuLogo"/>
                </div>
                
                <div class="loginOptions">
                    <input type="submit" value="LOGIN" name="loginOpt" class="loginOptBtn"/>
                    <input type="submit" value="REGISTER" name="registerOpt" class="registerOptBtn"/>
                </div>
                
                <div class="loginInp">
                    <img src="images/account.png" alt="" class="accountImg"/>
                    <input type="text" name="username" placeholder="USERNAME" class="input" id="username"/>
                    <img src="images/lock.png" alt="" class="lockImg"/>
                    <input type="text" name="password" placeholder="PASSWORD" class="input" id="passw" onfocus="changeType()"/>
                    <font class="forgotPw"><a href="#">Forgot password?</a></font>
                </div>
                
                <div class="loginSubmit">
                    <input type="submit" value="LOGIN" name="loginSub" class="loginSubBtn"/>
                </div>
            </div>
            
            <div class="footer">
                Linkvantage
            </div>
        </div>
    </body>
</html>
