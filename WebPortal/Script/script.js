/**
 * This is the main JavaScript document containing all the 
 * main logic for page layouts and transitions
 * 
 * The input validation will be done in the input validation JavaScript file 
 */

/**
 * The following script changes the password input field from text to password
 * when clicked in order to hide the password.
 * @return {undefined}
 */
function changeType()
{
    document.getElementById("passw").type = "password";
}

function changeNewPasswordType()
{
    document.getElementById("newPwInp").type = "password";
    document.getElementById("confirmPwInp").type = "password";
}

function changeTypeRegister()
{
    document.getElementById("ContactPassw").type = "password";
}
/**
 * This function changes the html displayed and hides the main login page 
 * and displays the forgot password page
 * @return {undefined}
 */
function forgotPasswordPage()
{
    var div = document.getElementById("loginPageMain");
    div.style.display = "none";
    
    var destDiv = document.getElementById("forgotPasswordPage");
    destDiv.style.display = "block";
    
}

/**
 * changes from the reset password page to the login page
 * @return {undefined}
 */
function changeToLogin()
{
    var div = document.getElementById("forgotPasswordPage");
    div.style.display = "none";
    
    var destDiv = document.getElementById("loginPageMain");
    destDiv.style.display = "block";
}

/**
 * changes from the forgot passord page to the otp page
 * @return {undefined}
 */
function changeToOTP()
{
    var div = document.getElementById("forgotPasswordPage");
    div.style.display = "none";
    
    var destDiv = document.getElementById("OTPPage");
    destDiv.style.display = "block";
}

/**
 * Swithces to the company registration page
 * @return {undefined}
 */
function changeToRegisterCompany()
{
    document.location.href = "registerCompany.php";
}

/**
 * Switches back to the index.php login screen
 * @return {undefined}
 */
function backToLoginFromReg()
{
    document.location.href = "index.php";
}

/**
 * This method has no return type and manipulates the layout of the html content.
 * It hides one button and displays another
 * @return {undefined}
 */
function hideButton()
{
    document.getElementById("add_Contact_Btn").style.display = "none";
    document.getElementById("add_Contact_Btn2").style.display = "block";
    document.getElementById("add_Contact_Btn2").style.marginLeft = "320px";
    document.getElementById("contactContainerHeader").style.marginRight = "0";
}

/**
 * This method has no return type and manipulates the layout of the html content.
 * It hides one button and displays another
 * @return {undefined}
 */
function hideSiteButton()
{
    document.getElementById("add_site_btn").style.display = "none";
    document.getElementById("add_site_btn2").style.display = "block";
    document.getElementById("add_site_btn2").style.marginLeft = "320px";
    document.getElementById("addressContainerHeader").style.marginRight = "0";
}

/**
 * This method switches to the register private client page
 * @return {undefined}
 */
function changeToClient()
{
    
    document.location.href = "registerPrivateClient.php";
}

/**
 * This method switches to the register company page
 * @return {undefined}
 */
function changeToCompany()
{
    document.location.href = "registerCompany.php";
}

function modifyResetPassword()
{
    if(document.getElementById("reset_options").value === "ANDROID OTP")
    {   
        $("#emailInp").after('<img src="images/account.png" alt="" class="pinImg"/>'+
                        '<input type="text" name="pin" value="" placeholder="USERNAME" class="passwordRecoveryInp" id="pinInp">');
                
        document.getElementById("passwordRecoveryImg").src = "images/envelope.png";
        document.getElementById("emailInp").placeholder = "EMAIL";

        
        
    }
    else if(document.getElementById("reset_options").value === "TEXT OTP")
    {
        document.getElementById("passwordRecoveryImg").src = "images/phone.png";
        document.getElementById("emailInp").placeholder = "PHONE NUMBER";
        
        $("#pinInp").remove();
        $(".pinImg").remove();
    }
    else
    {
        document.getElementById("passwordRecoveryImg").src = "images/envelope.png";
        document.getElementById("emailInp").placeholder = "EMAIL";
        $("#pinInp").remove();
        $(".pinImg").remove();
    }
}

function modifyActiveJob()
{
    
}

