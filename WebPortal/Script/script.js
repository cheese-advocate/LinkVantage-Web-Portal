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
    var div = document.getElementById("loginPageMain");
    div.style.display = "none";
    
    var destDiv = document.getElementById("registerCompanyPage");
    destDiv.style.display = "block";
}

function backToLoginFromReg()
{
    var div = document.getElementById("registerCompanyPage");
    div.style.display = "none";
    
    var destDiv = document.getElementById("loginPageMain");
    destDiv.style.display = "block";
}

var count = 1;
/**
 * The code below is still not perfect and needs to be perfected.
 * It is not finctioning as it should
 * It has to do with the registerPage dynamic layout.
 * @return {undefined}
 */
function increaseCounter()
{
    count++;
}

function generateNewContactInp()
{
    var add_contact_btn = document.getElementById("add_contact");
    var contacts_content = document.getElementById("contacts_content");
    var clone = contacts_content.cloneNode(true);
    
    document.getElementById("number").innerHTML = count;
    add_contact_btn.parentNode.insertBefore(clone, add_contact_btn.nextSibling);
}

function generateAddContactButton()
{
    var footer = document.getElementById("register_footer");
    var add_contact_btn = document.getElementById("add_contact");
    var clone2 = add_contact_btn.cloneNode(true);
    
    footer.parentNode.insertBefore(clone2, footer);
}