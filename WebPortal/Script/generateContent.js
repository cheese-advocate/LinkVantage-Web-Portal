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
var counterContact = 0;
var number = 1;
/**
 * Adds another div with input fields to add a contact
 * @return {undefined}
 */
function addContact()
{
    counterContact++;
    number++;
    var template = '<div class="contactsContent" id="contacts_content'+counterContact+'">'+
                '<div class="contactContentHeader">'+
                    '<img src="images/cross.png" alt="" id="contactCrossImg" class="contactCrossImg" onclick="removeContact(this.parentNode.parentNode.id, this.nextElementSibling.innerHTML)"/>'+
                    'Contact <font id="number">'+number+'</font><hr class="contactContentHeaderLine">'+
                    '<img src="images/down-arrow.png" alt="" id="contactDownArrow" class="contactDownArrow"/>'+
                '</div>'+
                
                '<div class="usernPassInp">'+
                    '<img src="images/account.png" alt="" class="contactAccountImg"/>'+
                    '<input type="text" name="username[]" placeholder="USERNAME" class="contactInput" id="ContactUsername" required="true"/>'+
                    '<img src="images/lock.png" alt="" class="contactLockImg"/>'+
                    '<input type="text" name="password[]" placeholder="PASSWORD" class="contactInput" id="ContactPassw" onfocus="changeTypeRegister()" required="true"/>'+
                '</div>'+
                
                '<div class="names">'+
                    '<img src="images/id-card.png" alt="" class="idCard" id="id1"/>'+
                    '<input type="text" name="firstName[]" placeholder="FIRST NAME" class="contactInput" id="contactFirstName" required="true"/>'+
                    '<img src="images/id-card.png" alt="" class="idCard"/>'+
                    '<input type="text" name="lastName[]" placeholder="LAST NAME" class="contactInput" id="contactLastName" required="true"/>'+
                '</div>'+
                
                '<div class="otherContactDet">'+
                    '<img src="images/envelope.png" alt="" class="contactEmailImg"/>'+
                    '<input type="text" name="email[]" placeholder="EMAIL" class="contactInput" id="contactEmail" required="true"/>'+
                    '<img src="images/phone.png" alt="" class="phoneContactImg"/>'+
                    '<input type="text" name="phoneNumber[]" placeholder="PHONE NUMBER" class="contactInput" id="contactPhoneNum" required="true"/>'+
                '</div>'+

                '<div class="confirmContact">'+
                        '<label for="confirmMainContact">Is the main contact:</label>'+
                        '<input type="hidden" name="confirmMainContact[]" id="confirmMainContact" value="false"/>'+
                        '<input type="checkbox" name="confirmMainContact[]" id="confirmMainContact" value="true"/>'+
                '</div>'+
            '</div>';
    
    /**
     * Checks if it is the first contact or site being added
     * If not the counters are adjusted to ensure it is placed after
     * the correct contact or site container
     */
    if(counterContact === 1)
    {
        var element = document.getElementById("contacts_content");
        element.insertAdjacentHTML("afterend", template);
    }
    else
    {
        var temp = counterContact - 1;
        var name = "contacts_content" + temp;
        var element = document.getElementById(name);
        element.insertAdjacentHTML("afterend", template);
    }
    
}

function removeContact(id, val)
{
    if(counterContact === 0)
    {
        oneContactToastWarning();
        return;
    }
    /*Used to test id the right arguments were received*/
    console.log(id);
    console.log(val);
    
    document.getElementById(id).remove();
    counterContact--;
    number--;
}

/**
 * Counters for the sites
 * @type {Number}
 */
var counterSite = 0;
var siteNum = 1;

/**
 * Adds a container with input for another site
 * @return {undefined}
 */
function addSite()
{
    counterSite++;
    siteNum++;
    
    var template = '<div class="addressContent" id="addressContent'+counterSite+'">'+
                '<div class="addressContentHeader" id="address_content_header">'+
                    '<img src="images/cross.png" alt="" id="contactCrossImg" class="contactCrossImg" onclick="removeSite(this.parentNode.parentNode.id)"/>'+
                    'Address <font id="number">'+siteNum+'</font><hr class="contactContentHeaderLine">'+
                    '<img src="images/down-arrow.png" alt="" id="contactDownArrow" class="contactDownArrow"/>'+
                '</div>'+
                         
                '<div class="streetNum">'+
                    '<img src="images/location.png" alt="" class="locationImg1"/>'+
                    '<input type="text" name="streetNum[]" placeholder="NO" class="addressInp" id="streetNumInp" required="true"/>'+
                '</div>'+

                '<div class="streetName">'+
                    '<img src="images/location.png" alt="" class="locationImg2"/>'+
                    '<input type="text" name="streetName[]" placeholder="STREET" class="addressInp" id="streetNameInp" required="true"/>'+
                '</div>'+

                '<div class="suburbCity">'+
                    '<img src="images/house.png" alt="" class="homeImg"/>'+
                    '<input type="text" name="suburbCity[]" placeholder="SUBURB/CITY" class="addressInp" id="suburbInp" required="true"/>'+
                '</div>'+

                '<div class="postalCode">'+
                    '<img src="images/envelope.png" alt="" class="postalImg"/>'+
                    '<input type="text" name="postalCode[]" placeholder="POSTAL CODE" class="addressInp" id="postalInp" required="true"/>'+
                '</div>'+

                '<div class="addInfo">'+
                    '<img src="images/information.png" alt="" class="infoImg"/>'+
                    '<input type="text" name="info[]" placeholder="ADDITIONAL INFORMATION" class="addressInp" id="addInfo"/>'+
                '</div>'+
                
                '<div class="confirmSite" id="confirm_site">'+
                    '<label for="confirmMainSite">Is the main site:</label>'+
                    '<input type="hidden" name="confirmMainSite[]" id="confirmMainSite" value="false"/>'+
                    '<input type="checkbox" name="confirmMainSite[]" id="confirmMainSite" value="true"/>'+
                '</div>'+
            '</div>';
    
    /**
     * Checks if it is the first contact or site being added
     * If not the counters are adjusted to ensure it is placed after
     * the correct contact or site container
     */
    if(counterSite === 1)
    {
        var element = document.getElementById("addressContent");
        element.insertAdjacentHTML("afterend", template);
    }
    else
    {
        var temp = counterSite-1;
        var name = "addressContent" + temp;
        var element = document.getElementById(name);
        element.insertAdjacentHTML("afterend", template);
    }
    
}

/**
 * Receives the id of the element to remove
 * That element is then removed and the counters are
 * adjusted accordingly
 * @param {type} id
 * @return {undefined}
 */
function removeSite(id)
{
    if(counterSite === 0)
    {
        oneSiteToastWarning();
        return;
    }
    document.getElementById(id).remove();
    counterSite--;
    siteNum--;
}


/**
 * The JQuery code below will allow the contact and site 
 * containers to collapse when the button to do so is clicked
 */
jQuery(document).ready(function(){
    
    $(document.body).delegate(".contactContentHeader", "click", function(){
        $(this).nextAll().slideToggle("slow");
    });
    
    $(document.body).delegate(".addressContentHeader", "click", function(){
        $(this).nextAll().slideToggle("slow");
    });
});