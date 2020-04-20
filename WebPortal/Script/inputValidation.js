/*
 * REGULAR EXPRESSION EXPLANATIONS
 * 
 * email - checks for a valid email and is the most complex one of all
 * phoneNumber - checks that a number starts with 0 and has only 10 digits
 * username - checks that the username is at least 8 characters but does not allow any other characters than normal text
 * password - checks that the password is at least 8 characters with:
 *              *at least one uppercase
 *              *at least one lowercase
 *              *at least one number
 *              *at least one special character
 * streetNumber - checks that only numbers are entered can be any length
 * postal code - checks that only numbers are entered and limits the users to 4 digits
 * name, surname, company name, street name - all check that only accepted text characters are used
 */

/**
 * Variable list of all the Regular expressions to be used in validation
 * @type {RegExp}
 */
var emailRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
var phoneNumRegex = /0((60[3-9]|64[0-5]|66[0-5])\d{6}|(7[1-4689]|6[1-3]|8[1-4])\d{7})/;
var usernameRegex = /^(?=.{8,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/;
var pwRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/;
var streetNumRegex = /^[0-9]*$/;
var postalRegex = /^[0-9]{4}$/;
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
        if(!$.trim($(this).val()))
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
    else if(!empty)
    {
        window.onbeforeunload = null;
    }
}

/**
 * Validates all the input received in the input forms
 * Returns a boolean which will prevent the form from submitting
 * If false no submission will take place
 * If true input will be submitted
 * @return {Boolean}
 */
function formValidation()
{
    var valid = true;
    $("input:not(:submit):not(:hidden)").each(function(){
        var id = $(this).attr('id');
        
        switch(id)
        {
            case "company_name_inp":
                if(!nameSurnameCompanyRegex.test($(this).val()))
                {
                    $(this).css("border-bottom-color", "orange");
                    valid = false;
                }
                else
                {
                    $(this).removeAttr("style");
                }
                break;
            case "ContactUsername":
                if(!usernameRegex.test($(this).val()))
                {
                    alert("Username should be at least 8 characters");
                    $(this).css("border-bottom-color", "orange");
                    valid = false;
                }
                else
                {
                    $(this).removeAttr("style");
                }
                break;
            case "ContactPassw":
                if(!pwRegex.test($(this).val()))
                {
                    alert("The password should consist of 8 characters with:\nAt least one uppercase\nOne lowercase\nOne special character\nOne number");
                    $(this).css("border-bottom-color", "orange");
                    valid = false;
                }
                else
                {
                    $(this).removeAttr("style");
                }
                break;
            case "contactFirstName":
                if(!nameSurnameCompanyRegex.test($(this).val()))
                {
                    $(this).css("border-bottom-color", "orange");
                    valid = false;
                }
                else
                {
                    $(this).removeAttr("style");
                }
                break;
            case "contactLastName":
                if(!nameSurnameCompanyRegex.test($(this).val()))
                {
                    $(this).css("border-bottom-color", "orange");
                    valid = false;
                }
                else
                {
                    $(this).removeAttr("style");
                }
                break;
            case "contactEmail":
                if(!emailRegex.test($(this).val()))
                {
                    alert("The email should look like the following:\nexample@example.com");
                    $(this).css("border-bottom-color", "orange");
                    valid = false;
                }
                else
                {
                    $(this).removeAttr("style");
                }
                break;
            case "contactPhoneNum":
                if(!phoneNumRegex.test($(this).val()))
                {
                    $(this).css("border-bottom-color", "orange");
                    valid = false;
                }
                else
                {
                    $(this).removeAttr("style");
                }
                break;
            case "streetNumInp":
                if(!streetNumRegex.test($(this).val()))
                {
                    $(this).css("border-bottom-color", "orange");
                    valid = false;
                }
                else
                {
                    $(this).removeAttr("style");
                }
                break;
            case "streetNameInp":
                if(!nameSurnameCompanyRegex.test($(this).val()))
                {
                    $(this).css("border-bottom-color", "orange");
                    valid = false;
                }
                else
                {
                    $(this).removeAttr("style");
                }
                break;
            case "suburbInp":
                if(!nameSurnameCompanyRegex.test($(this).val()))
                {
                    $(this).css("border-bottom-color", "orange");
                    valid = false;
                }
                else
                {
                    $(this).removeAttr("style");
                }
                break;
            case "postalInp":
                if(!postalRegex.test($(this).val()))
                {
                    $(this).css("border-bottom-color", "orange");
                    valid = false;
                }
                else
                {
                    $(this).removeAttr("style");
                }
                break;
            case "addInfo":
                if(!nameSurnameCompanyRegex.test($(this).val()))
                {
                    $(this).css("border-bottom-color", "orange");
                    valid = false;
                }
                else
                {
                    $(this).removeAttr("style");
                }
                break;
        }
    });
    
    if(!valid)
    {
        alert("Invalid input received");
        return false;
    }
    else
    {
        alert("Submitted successfully");
        return true;
    }
}    