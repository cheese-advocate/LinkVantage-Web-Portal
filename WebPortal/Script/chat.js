/*Initialising the variable to track which messages need to be retrieved. 
 * All messages sent later than the lastTime need to be retrieved*/
var lastRetrieval = 0;

var localUserType = "";
var localUserName = "";
var externalUserName = "";

/*When the chat loads, it calls this function, which calls the getNewMessages 
 * function on an interval of 2 seconds. Also stores whether the client or 
 * technician is sending it*/
function startChat(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(xhttp.readyState === 4 && xhttp.status === 200){
            var data = JSON.parse(xhttp.responseText);
            localUserType = data[0];
            localUserName = data[1];
            externalUserName = data[2];
        } 
    };
    setInterval(getNewMessages(), 2000);
}

/*Gets unseen messages*/
function getNewMessages(){    
    /*Start the AJAX request*/
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(xhttp.readyState === 4 && xhttp.status === 200){
            var messages = JSON.parse(xhttp.responseText);
            parseMessages(messages);
            var htmlMessages = convertMessagesToHTML(messages);
            addMessagesToChat(htmlMessages);
        }
    };
    
    xhttp.open("GET", "chat.php?retrieval=" + lastRetrieval, true);
    xhttp.send();
    
    /*Get the current time and record it as the last retreival*/
    var today = new Date();
    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    lastRetrieval = date + ' ' + time;
}

function convertMessagesToHTML(messages){
    var chat = "";
    
    for (var i = 0; i < messages.length; i++) {
        var messageHTML = convertMessageToHTML(messages[i]);
        chat += messageHTML;
    }
    
    return chat;
}

function convertMessageToHTML(message){
    var messageHTML = '';
    var divOpener = '';
    var senderName = '';
    if (message.sender === localUserType){
        divOpener = '<div class="chat-message message-to">';
        senderName = localUserName;
    } else {
        divOpener = '<div class="chat-message message-from">';
        senderName = externalUserName;
    }        
    var senderSpan = '<span class="message-content-sender">' + senderName + '</span>';
    var messageSpan = '<span class="message">'+message.text+'</span>'
    var contentDiv = '<div class="message-content">' + senderSpan + messageSpan + '</div>';
    var messageSpan = '<span class="message-time">' + message.time + '</span>';
    messageHTML = divOpener + contentDiv + messageSpan + '</div>';
    return messageHTML;
}

function addMessagesToChat(messages){
    var chat = document.getElementsByClassName(".chat-messages");
    chat.innerHTML += messages;
}

function parseMessages(messages){    
    for (var i = 0; i < messages.length; i++) {
        messages[i] = JSON.parse(messages[i]);
    }
}

function sendMesssage(){
    var messageText = document.getElementById(messageText).value;
    var today = new Date();
    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var message = {sender:localUserType, text:messageText, time:date + ' ' + time};
    xhttp.open("POST", "chat.php", true);
    xhttp.send("newMessageText=" + message.text);
    var messageHTML = convertMessageToHTML(message);
    addMessagesToChat(messageHTML);
}