/*
 * This script file will be used only to generate new content
 * The reason for it being a separate file is to save loading times
 * If it were included in the other script files that need to be loaded on 
 * every page it could increase loading times as it creates a 
 * variable containing html code
 */

/**
 * Counts the number of contacts already added
 * @type {Number}
 */
var contactCounter = 0;
var number = 1;
function addContact()
{
    contactCounter++;
    number++;
    var template = '<div class="contactsContent" id="contacts_content'+contactCounter+'">'+
                '<div class="contactContentHeader">'+
                    '<img src="images/cross.png" alt="" id="contactCrossImg" class="contactCrossImg"/>'+
                    'Contact <font id="number">'+number+'</font><hr class="contactContentHeaderLine">'+
                    '<img src="images/down-arrow.png" alt="" id="contactDownArrow" class="contactDownArrow"/>'+
                '</div>'+
                
                '<div class="usernPassInp">'+
                    '<img src="images/account.png" alt="" class="contactAccountImg"/>'+
                    '<input type="text" name="username" placeholder="USERNAME" class="contactInput" id="ContactUsername"/>'+
                    '<img src="images/lock.png" alt="" class="contactLockImg"/>'+
                    '<input type="text" name="password" placeholder="PASSWORD" class="contactInput" id="ContactPassw" onfocus="changeTypeRegister()"/>'+
                '</div>'+
                
                '<div class="names">'+
                    '<img src="images/id-card.png" alt="" class="idCard" id="id1"/>'+
                    '<input type="text" name="firstName" placeholder="FIRST NAME" class="contactInput" id="contactFirstName"/>'+
                    '<img src="images/id-card.png" alt="" class="idCard"/>'+
                    '<input type="text" name="lastName" placeholder="LAST NAME" class="contactInput" id="contactLastName"/>'+
                '</div>'+
                
                '<div class="otherContactDet">'+
                    '<img src="images/envelope.png" alt="" class="contactEmailImg"/>'+
                    '<input type="text" name="email" placeholder="EMAIL" class="contactInput" id="contactEmail"/>'+
                    '<img src="images/phone.png" alt="" class="phoneContactImg"/>'+
                    '<input type="text" name="phoneNumber" placeholder="PHONE NUMBER" class="contactInput" id="contactPhoneNum"/>'+
                '</div>'+

                '<div class="confirmContact">'+
                        '<label for="confirmMainContact">Is the main contact:</label>'+
                        '<input type="checkbox" name="confirmMainContact" id="confirmMainContact"/>'+
                '</div>'+
            '</div>';
    
    if(contactCounter === 1)
    {
        var element = document.getElementById("contacts_content");
        element.insertAdjacentHTML("afterend", template);
    }
    else
    {
        var temp = contactCounter - 1;
        var name = "contacts_content" + temp;
        console.log(name);
        var element = document.getElementById(name);
        element.insertAdjacentHTML("afterend", template);
    }
    
}