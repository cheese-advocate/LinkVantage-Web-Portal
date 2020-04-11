/**
 * The necessary logic and if statements will be added to the 
 * javascript at a later stage.
 * @return {undefined}
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

function backToLoginFromReg()
{
    document.location.href = "index.php";
}

/**
 * The code below is still not perfect and needs to be perfected.
 * It is not finctioning as it should
 * It has to do with the registerPage dynamic layout.
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

function hideButton()
{
    document.getElementById("add_Contact_Btn").style.display = "none";
    document.getElementById("add_Contact_Btn2").style.display = "block";
    document.getElementById("add_Contact_Btn2").style.marginLeft = "320px";
    document.getElementById("contactContainerHeader").style.marginRight = "0";
}

function generateNewSiteInp()
{
    var registerAccount = document.getElementById("register_account");
    var site_content = document.getElementById("addressContent");
    var clone = site_content.cloneNode(true);
    clone.style.marginTop = "20px";
    registerAccount.style.marginTop = "20px";
    
    registerAccount.parentNode.insertBefore(clone, registerAccount);
}

function hideSiteButton()
{
    document.getElementById("add_site_btn").style.display = "none";
    document.getElementById("add_site_btn2").style.display = "block";
    document.getElementById("add_site_btn2").style.marginLeft = "320px";
    document.getElementById("addressContainerHeader").style.marginRight = "0";
}

function changeToClient()
{
    document.location.href = "registerPrivateClient.php";
}

function changeToCompany()
{
    document.location.href = "registerCompany.php";
}