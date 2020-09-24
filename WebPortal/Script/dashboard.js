var toggled = false;

function changeHam()
{
    document.getElementById("menu").classList.toggle("change");
    
    if(!toggled)
    {
        document.getElementById("side").style.height = "100%";
        document.getElementById("side").style.width = "175px";
        document.getElementById("nav-body").style.marginLeft = "175px";
        toggled = true;
    }
    else
    {
        document.getElementById("side").style.height = "0px";
        document.getElementById("side").style.width = "0px";
        document.getElementById("nav-body").style.marginLeft = "0px";
        toggled = false;
    }
}

var accountToggled = false;

function accountNav()
{
    if(!accountToggled)
    {
        document.getElementById("account").style.height = "125px";
        accountToggled = true;
    }
    else
    {
        document.getElementById("account").style.height = "0px";
        accountToggled = false;
    }
}

function logOut()
{
    window.location.href = "index.php";
}

function navigate(location)
{
    switch(location)
    {
        case "home":
           window.location.href = "Dashboard.php";
           break;
           
        case "jobs":
           window.location.href = "jobManagement.php";
           break;
        
        case "sales":
            window.location.href = "salesManagement.php";
            break;
            
        case "clients":
            break;
            
        case "info":
            break;
            
        case "settings":
            break;      
    }
    
}

function generatePDF()
{
    window.location.href = "PDFGenerator.php";
}