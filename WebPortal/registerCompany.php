<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Register Company</title>
        <link rel="shortcut icon" href="images/logo_block__1__AHI_icon.ico" />
        <script src="Script/script.js" type="text/javascript"></script>
        <link href="CSS/style.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/registerPage.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/forgotPw.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
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
                    <input type="radio" name="registerOption" value="Company" id="companyRadio" checked="true" onclick="changeToCompany()"/>
                    
                    <label for="privClientRadio" id="privClient">Private Client</label>
                    <input type="radio" name="registerOption" value="Private Client" id="privClientRadio" onclick="changeToClient()"/>
                </div>
                
                <div class="companyName" id="company_name">
                    <input type="text" name="companyNameInp" value="" placeholder="COMPANY NAME" class="companyNameInp" id="company_name_inp"/>
                </div>
            </div>  
            
            <div class="contactsHeader">
                <font id="contactContainerHeader">Contacts</font>
                <input type="submit" value="ADD CONTACT" name="addContact" class="addContactBtn" id="add_Contact_Btn2" onclick="generateNewContactInp()"/>
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
                    <input type="text" name="password" placeholder="PASSWORD" class="contactInput" id="ContactPassw" onfocus="changeTypeRegister()"/>
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
                        <input type="checkbox" name="confirmMainContact" id="confirmMainContact"/>    
                </div>
            </div>
            
            <div class="addContact" id="add_contact">
                <input type="submit" value="ADD CONTACT" name="addContact" class="addContactBtn" id="add_Contact_Btn" onclick="generateNewContactInp(), hideButton()"/>
            </div>
            
            <div class="addressHeader">
                <font class="addressContainerHeader" id ="addressContainerHeader">Sites</font>
                <input type="submit" value="ADD SITE" name="addSite" class="addSiteBtn" id="add_site_btn2" onclick="generateNewSiteInp(), hideSiteButton()"/>
            </div>
            
            <div class="addressContent" id="addressContent">
                <div class="addressContentHeader" id="address_content_header">
                    <img src="images/cross.png" alt="" id="contactCrossImg" class="contactCrossImg"/>
                    Address <font id="number"> 1</font><hr class="contactContentHeaderLine">
                    <img src="images/down-arrow.png" alt="" id="contactDownArrow" class="contactDownArrow"/>
                </div>
                         
                <div class="streetNum">
                    <img src="images/location.png" alt="" class="locationImg1"/>
                    <input type="text" name="streetNum" placeholder="NO" class="addressInp" id="streetNumInp"/>
                </div>

                <div class="streetName">
                    <img src="images/location.png" alt="" class="locationImg2"/>
                    <input type="text" name="streetName" placeholder="STREET" class="addressInp" id="streetNameInp"/>
                </div>

                <div class="suburbCity">
                    <img src="images/house.png" alt="" class="homeImg"/>
                    <input type="text" name="suburbCity" placeholder="SUBURB/CITY" class="addressInp" id="suburbInp"/>
                </div>

                <div class="postalCode">
                    <img src="images/envelope.png" alt="" class="postalImg"/>
                    <input type="text" name="postalCode" placeholder="POSTAL CODE" class="addressInp" id="postalInp"/>
                </div>

                <div class="addInfo">
                    <img src="images/information.png" alt="" class="infoImg"/>
                    <input type="text" name="info" placeholder="ADDITIONAL INFORMATION" class="addressInp" id="addInfo"/>
                </div>
                
                <div class="confirmSite" id="confirm_site">
                    <label for="confirmMainSite">Is the main site:</label>
                    <input type="checkbox" name="confirmMainSite" id="confirmMainSite"/>
                </div>
            </div>
            
            <div class="addSite" id="add_site">
                <input type="submit" value="ADD SITE" name="addSite" class="addSiteBtn" id="add_site_btn" onclick="generateNewSiteInp(), hideSiteButton()"/>
            </div>
            
            <div class="registerAccount" id="register_account">
                <input type="submit" value="REGISTER ACCOUNT" name="registerAccount" class="regAcBtn" id="reg_ac_btn" onclick=""/>
            </div>
            
            <div class="registerFooter" id="register_footer">
                Linkvantage
            </div>
        </div>
    </body>
</html>
