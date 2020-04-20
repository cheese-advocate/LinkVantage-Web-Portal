<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Register Client</title>
        <!--Title icon link-->
        <link rel="shortcut icon" href="favicon.ico" />
        <!--CSS links-->
        <link href="CSS/style.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/registerPage.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/registerPrivClient.css" rel="stylesheet" type="text/css"/>
        <!--JS links-->
        <script src="Script/jquery-3.5.0.js" type="text/javascript"></script>
        <script src="Script/script.js" type="text/javascript"></script>
        <script src="Script/inputValidation.js" type="text/javascript"></script>
        <script src="Script/generateContent.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="registerCompanyPage" id="registerPrivClient">
            <div class="header">
                Compulink Technologies
            </div>
            <form method="POST" action="#" onsubmit="">
                <div class="registerTitleContent">
                    <div class="logo">
                        <img src="images/logo_block_cropped.png" alt="" id="compuLogo"/>
                    </div>

                    <div class="registerOptionBtns">
                        <button type="button" class="backToLoginFromReg" onclick="backToLoginFromReg()">LOGIN</button>
                        <button class="registerBtnRegPage">REGISTER</button>
                    </div>

                    <div class="registerOptions">
                        <font class="radioFont">I am a:</font>
                        <label for="companyRadio" id="companyOption">Company</label>
                        <input type="radio" name="registerOption" value="Company" id="companyRadio" onclick="changeToCompany()"/>

                        <label for="privClientRadio" id="privClient">Private Client</label>
                        <input type="radio" name="registerOption" value="Private Client" id="privClientRadio" checked="true" onclick="changeToClient()"/>
                    </div>

                </div>  

                <div class="contactsHeader">
                    <font id="contactContainerHeader">Contacts</font>
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
                    <button type="button" class="addContactBtn" id="add_Contact_Btn" onclick="addContact()">ADD CONTACT</button>
                </div>

                <div class="addressHeader">
                    <font class="addressContainerHeader" id ="addressContainerHeader">Site</font>
                </div>

                <div class="addressContent" id="addressContent">
                    <div class="addressContentHeader1" id="address_content_header">
                        <font>Address</font>
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

                <div class="registerAccount" id="register_account">
                    <button type="submit" class="regAcBtn" id="reg_ac_btn" onclick="checkRequiredFields()">REGISTER ACCOUNT</button>
                </div>
            </form>
            <div class="registerFooter" id="register_footer">
                LINKVANTAGE
            </div>
        </div>
    </body>
</html>
