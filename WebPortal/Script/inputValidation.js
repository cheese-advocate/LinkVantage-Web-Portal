/**
 * Variable list of all the Regular expressions to be used in validation
 * @type {RegExp}
 */
var emailRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
var phoneNumRegex = /0((60[3-9]|64[0-5]|66[0-5])\d{6}|(7[1-4689]|6[1-3]|8[1-4])\d{7})/;

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