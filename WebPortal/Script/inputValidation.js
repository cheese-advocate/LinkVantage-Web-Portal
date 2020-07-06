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
 * otp - the entered pin should only be 5 digits and only numbers
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
var otpRegex = /^[0-9]{5}$/;
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
    var valid = true;
    var empty = false;
    console.log("test");
    $("input:not(:submit):not(:hidden)").each(function(){
        var placeholder = $(this).attr('placeholder');
        
        switch(placeholder)
        {
            case "EMAIL":
                if(!$.trim($(this).val()))
                {
                    empty = true;
                    $(this).css("border-bottom-color", "red");
                }
                else if(!emailRegex.test($(this).val()))
                {
                    valid = false;
                    $(this).css("border-bottom-color", "orange");
                }
                else
                {
                    $(this).removeAttr("style");
                }
                break;
            case "PHONE NUMBER":
                if(!$.trim($(this).val()))
                {
                    empty = true;
                    $(this).css("border-bottom-color", "red");
                }
                else if(!phoneNumRegex.test($(this).val()))
                {
                    valid = false;
                    $(this).css("border-bottom-color", "orange");
                }
                else
                {
                    $(this).removeAttr("style");
                }
                break;
            case "PIN":
                if(!$.trim($(this).val()))
                {
                    empty = true;
                    $(this).css("border-bottom-color", "red");
                }
                else
                {
                    $(this).removeAttr("style");
                }
                break;
        }
    });
    console.log("test");
    if(!valid)
    {
        invalidInputToast();
        return false;
    }
    else if(empty)
    {
        emptyInputToast();
        return false;
    }
    else
    {
        return valid;
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
    var empty = false;
    $("input:not(:submit):not(:hidden)").each(function(){
        var id = $(this).attr('id');
        
        switch(id)
        {
            case "username":
                if(!$.trim($(this).val()))
                {
                    empty = true;
                    $(this).css("border-bottom-color", "red");
                }
                else
                {
                    $(this).removeAttr("style");
                }
                break;
            case "passw":
                if(!$.trim($(this).val()))
                {
                    empty = true;
                    $(this).css("border-bottom-color", "red");
                }
                else
                {
                    $(this).removeAttr("style");
                }
                break;
        }
    });
    
    if(empty)
    {
        return false;
    }
    else
    {
        return true;
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
        emptyInputToast();
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
 * Company and private client registration
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
                    usernameInfoToast();
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
                    pwInfoToast();
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
                    emailToast();
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
                    $(this).val('none');
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
        invalidInputToast();
        return false;
    }
    else
    {
        successfulSumbitToast();
        return true;
    }
}

function verifyNewPassword()
{
    var valid = true;
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
        
        
        if(!pwRegex.test($(this).val()))
        {
            $(this).css("border-bottom-color", "orange");
            valid = false;
        }
        else
        {
            $(this).removeAttr("style");
        }
        
    });
    
    if($("#newPwInp").val() !== $("#confirmPwInp").val())
    {
        matchingPWToast();
        $("#newPwInp, #confirmPwInp").css("border-bottom-color", "#03AAFB");
    }
    
    if(empty)
    {
        emptyInputToast();
        return false;
    }
    else if(!valid)
    {
        invalidInputToast();
        pwInfoToast();
        return false;
    }
    else
    {
        return valid;
    }
}
