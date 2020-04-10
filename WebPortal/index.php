<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Compulink Technologies</title>
        <!-- Displays Compulink logo in title bar of web pages -->
        <link rel="shortcut icon" href="images/logo_block__1__AHI_icon.ico" />
        <!-- Link external CSS to the main Index page -->
        <link href="CSS/style.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/forgotPw.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/registerPage.css" rel="stylesheet" type="text/css"/>
        <!--All javascript-->
        <script src="Script/script.js" type="text/javascript"></script>
    </head>
    <body>
        <!--LOGIN PAGE-->
        <div class="loginPage" id="loginPageMain">
            <div class="header">
                Compulink Technologies
            </div>
            
            <div class="content">
                <div class="logo">
                    <img src="images/logo_block_cropped.png" alt="" id="compuLogo"/>
                </div>
                
                <div class="loginOptions">
                    <input type="submit" value="LOGIN" name="loginOpt" class="loginOptBtn"/>
                    <input type="submit" value="REGISTER" name="registerOpt" class="registerOptBtn" onclick="changeToRegisterCompany()"/>
                </div>
                
                <div class="loginInp">
                    <img src="images/account.png" alt="" class="accountImg"/>
                    <input type="text" name="username" placeholder="USERNAME" class="input" id="username"/>
                    <img src="images/lock.png" alt="" class="lockImg"/>
                    <input type="text" name="password" placeholder="PASSWORD" class="input" id="passw" onfocus="changeType()"/>
                    <font class="forgotPw" id="forgotPassBigScreen"><a href="#" onclick="forgotPasswordPage()">Forgot password?</a></font>
                </div>
                
                <div class="loginSubmit">
                    <input type="submit" value="LOGIN" name="loginSub" class="loginSubBtn"/>
                    <font class="forgotPw" id="forgotPassSmallScreen"><a href="#" onclick="forgotPasswordPage()">Forgot password?</a></font>
                </div>
            </div>
            
            <div class="footer">
                Linkvantage
            </div>
        </div>
        
        
        <!--FORGOT PASSWORD PAGE-->
        <div class="forgotPasswordPage" id="forgotPasswordPage">
            <div class="header">
                Compulink Technologies
            </div>
            
            <div class="contentFgPw">
                <div class="logo">
                    <img src="images/logo_block_cropped.png" alt="" id="compuLogo"/>
                </div>
                
                <div class="backToLogin">
                    <input type="submit" value="RETURN TO LOGIN" name="returnSub" class="returnToLoginBtn" onclick="changeToLogin()"/>
                </div>
                
                <div class="resetInpContent">
                    <img src="images/refresh.png" alt="" class="resetImg"/>
                    <select name="resetOptions" class="dropDownSelect">
                        <option>TEXT OTP</option>
                        <option>ANDROID OTP</option>
                        <option>RESET PASSWORD</option>
                    </select>
                    
                    <img src="images/envelope.png" alt="" class="emailImg"/>
                    <input type="text" name="emailInp" value="" placeholder="EMAIL" class="emailInp"/>
                </div>
                
                <div class="resetSubmit">
                    <input type="submit" value="SEND RESET REQUEST" name="resetSub" class="resetSubBtn"/>
                </div>
            </div>
            
            <div class="footer">
                Linkvantage
            </div>
        </div>
        
        
        <!--REGISTER COMPANY PAGE-->
        <div class="registerCompanyPage" id="registerCompanyPage">
            <div class="header">
                Compulink Technologies
            </div>
            
            <div class="registerTitleContent">
                <div class="logo">
                    <img src="images/logo_block_cropped.png" alt="" id="compuLogo"/>
                </div>
                
                <div class="registerOptionBtns">
                    <input type="submit" value="LOGIN" name="loginOpt" class="backToLoginFromReg" onclick="backToLoginFromReg()"/>
                    <input type="submit" value="REGISTER" name="registerOpt" class="registerBtnRegPage"/>
                </div>
                
                <div class="registerOptions">
                    <font class="radioFont">I am a:</font>
                    <label for="companyRadio" id="companyOption">Company</label>
                    <input type="radio" name="registerOption" value="Company" id="companyRadio"/>
                    
                    <label for="privClientRadio" id="privClient">Private Client</label>
                    <input type="radio" name="registerOption" value="Private Client" id="privClientRadio"/>
                </div>
                
                <div class="companyName">
                    <input type="text" name="companyNameInp" value="" placeholder="COMPANY NAME" class="companyNameInp"/>
                </div>
            </div>  
            
            <div class="contactsHeader">
                <font>Contacts</font>
            </div>
            
            <div class="contactsContent" id="contacts_content">
                <div class="contactContentHeader">
                    <img src="images/cross.png" alt="" id="contactCrossImg" class="contactCrossImg"/>
                    Contact <font id="number"> 1</font><hr class="contactContentHeaderLine">
                    <img src="images/down-arrow.png" alt="" id="contactDownArrow" class="contactDownArrow"/>
                </div>
                
                <div class="usernPassInp">
                    <img src="images/account.png" alt="" class="contactAccountImg"/>
                    <input type="text" name="username" placeholder="USERNAME" class="contactInput" id="ContactUsername"/>
                    <img src="images/lock.png" alt="" class="contactLockImg"/>
                    <input type="text" name="password" placeholder="PASSWORD" class="contactInput" id="ContactPassw" onfocus="changeType()"/>
                </div>
                
                <div class="names">
                    <img src="images/id-card.png" alt="" class="idCard" id="id1"/>
                    <input type="text" name="firstName" placeholder="FIRST NAME" class="contactInput" id="contactFirstName"/>
                    <img src="images/id-card.png" alt="" class="idCard"/>
                    <input type="text" name="lastName" placeholder="LAST NAME" class="contactInput" id="contactLastName"/>
                </div>
                
                <div class="otherContactDet">
                    <img src="images/envelope.png" alt="" class="contactEmailImg"/>
                    <input type="text" name="email" placeholder="EMAIL" class="contactInput" id="contactEmail"/>
                    <img src="images/phone.png" alt="" class='phoneContactImg'/>
                    <input type="text" name="phoneNumber" placeholder="PHONE NUMBER" class="contactInput" id="contactPhoneNum"/>
                </div>

                <div class="confirmContact">
                    <label for="confirmMainContact">Is the main contact:</label>
                    <input type="checkbox" name="confirmMainContact" value="ON" checked="checked" id="confirmMainContact"/>
                </div>
            </div>
            
            <div class="addContact" id="add_contact">
                <input type="submit" value="ADD CONTACT" name="addContact" class="addContactBtn" id="add_Contact_Btn" onclick="generateNewContactInp(), generateAddContactButton(), increaseCounter()"/>
            </div>
            
            <div class="registerFooter" id="register_footer">
                Linkvantage
            </div>
        </div>
    </body>
</html>
