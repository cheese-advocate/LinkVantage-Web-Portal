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
            <div class="loginBox">
                <div class="loginBoxTitleContent">
                    <img src="images/logo_block_cropped.png" alt="" class="compuLogo"/><br/><br/>
                    <p class="title">Compulink Technologies</p>
                </div>
                <div class="loginBoxFormContent">
                    <input type="submit" value="Login" name="Login" class="loginBut"/> <input type="submit" value="Register" name="Register" class="regBut"/><br/><br/>
                    <input type="text" name="Username" value="Username" class="userInp" onfocus="this.value=''"/><br/><br/>
                    <input type="text" name="Password" value="Password" class="pwInp" onfocus="this.value=''; changeType()" id="pw"/><br/><br/>
                    <input type="submit" value="Login" name="LoginSubmit" class="loginSubBut"/>
                    <p><a href="#" class="forgotPw">Forgot password?</a></p>
                    <p><a href="#" class="regMsg">Register an account</a></p>
                </div>
            </div>
            <div class="footer">
                Linkvantage &copy; 2020
            </div>
        </div>
    </body>
</html>
