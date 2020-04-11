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
 * This method generates a new container with input fields to 
 * create a new contact
 * @return {undefined}
 */
function generateNewContactInp()
{
    var add_contact_btn = document.getElementById("add_contact");
    var contacts_content = document.getElementById("contacts_content");
    var clone = contacts_content.cloneNode(true);
    clone.style.marginTop = "20px";
    
    add_contact_btn.parentNode.insertBefore(clone, add_contact_btn.nextSibling);
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
 * This method generates a new container with input fields to add another site
 * @return {undefined}
 */
function generateNewSiteInp()
{
    var registerAccount = document.getElementById("register_account");
    var site_content = document.getElementById("addressContent");
    var clone = site_content.cloneNode(true);
    clone.style.marginTop = "20px";
    registerAccount.style.marginTop = "20px";
    
    registerAccount.parentNode.insertBefore(clone, registerAccount);
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
        /*var img = document.createElement("img");
        img.src = "images/lock.png";
        img.className = "emailImg";
        
        var ref = document.getElementById("reset_submit");
        ref.parentNode.insertBefore(img, ref)*/;
    }
    else if(document.getElementById("reset_options").value === "TEXT OTP")
    {
        document.getElementById("passwordRecoveryImg").src = "images/phone.png";
        document.getElementById("passwordRecoveryInp").placeholder = "PHONE NUMBER";     
    }
    else
    {
        document.getElementById("passwordRecoveryImg").src = "images/envelope.png";
        document.getElementById("passwordRecoveryInp").placeholder = "EMAIL";;
    }
}


