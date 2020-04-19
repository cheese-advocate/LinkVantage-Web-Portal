/**
 * Variable list of all the Regular expressions to be used in validation
 * @type {RegExp}
 */
var emailRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
var phoneNumRegex = /0((60[3-9]|64[0-5]|66[0-5])\d{6}|(7[1-4689]|6[1-3]|8[1-4])\d{7})/;
var usernameRegex = /^(?=.{8,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/;
var pwRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/;
/**
 * Regex below can be used both for first name, last name and company name
 * @type {RegExp}
 */
var nameSurnameCompanyRegex = /^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,}$/;

/**
 * This method will be written to have a return type of boolean.
 * This will be used in other methods to prevent page transitions to take place
 * if the user chooses cancel.
 * @return {undefined}
 */
function warningDataLoss()
{
    confirm("WARNING!\nAll entered data will be lost when leaving this page!\nAre you sure you want to leave this page?");
}

/**
 * Verifies the input for the forgot password screen
 * Both the email and the phone number
 * @return {undefined}
 */
/*Pin verification still needs to be added and done*/
function verifyForgotPw()
{
    if(document.getElementById("emailInp").placeholder === "EMAIL")
    {
        if(document.getElementById("emailInp").value.match(emailRegex))
        {
            return;
        }
        else
        {
            alert("Invalid email entered");
            document.getElementById("emailInp").style.borderBottomColor = "red";
        }
    }
    else if(document.getElementById("emailInp").placeholder === "PHONE NUMBER")
    {
        if(document.getElementById("emailInp").value.match(phoneNumRegex))
        {
            return;
        }
        else
        {
            alert("Invalid phone number entered");
            document.getElementById("emailInp").style.borderBottomColor = "red";
        }
    }
}

/**
 * Verifies that valid usernames and passwords are entered
 * The entered username and passwords still need to be matched 
 * with those in the database
 * @return {undefined}
 */
function loginVerification()
{
    var username = document.getElementById("username").value;
    var password = document.getElementById("passw").value;
    var valid = true;
    
    if(username.match(usernameRegex))
    {
        document.getElementById("username").style = "none";
    }
    else
    {
        valid = false;
        document.getElementById("username").style.borderBottomColor = "red";
    }
    
    if(password.match(pwRegex))
    {
        document.getElementById("passw").style = "none";
    }
    else
    {
        valid = false;
        document.getElementById("passw").style.borderBottomColor = "red";
    }
    
    if(!valid)
    {
        alert("The username or password you entered is invalid");
    }
}

/**
 * Uses jQuery to check all the input fields of type text
 * Excludes buttons, radio and textbox inputs
 * Checks each input
 * If empty inputs are found the register button is
 * disabled
 * @return {undefined}
 */
function checkRequiredFields()
{    
    var empty = false;
    $("input:not(:submit):not(:hidden)").each(function(){
        if(!$(this).val())
        {
            empty = true;
            $(this).css("border-bottom-color", "red");
        }
        else
        {
            $(this).removeAttr("style");
        }
    });
    
    if(empty)
    {
        alert("Some fields are empty and need to be entered");
        window.onbeforeunload = function() 
        {
            return "Are you sure you want to navigate away?";
        };
    }
}

/**
 * Function called on all registration inputs
 * All inputs will be checked with the corresponding RegEx
 * The appropriate error messages will be shown according to the given input
 * @return {undefined}
 */
function checkAllInputFields()
{
    
}