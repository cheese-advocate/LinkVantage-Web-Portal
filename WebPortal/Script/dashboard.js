var toggled = false;

function changeHam()
{
    document.getElementById("menu").classList.toggle("change");
    
    if(!toggled)
    {
        document.getElementById("side").style.height = "100%";
        document.getElementById("side").style.width = "175px";
        document.getElementById("main").style.marginLeft = "175px";
        toggled = true;
    }
    else
    {
        document.getElementById("side").style.height = "0px";
        document.getElementById("side").style.width = "0px";
        document.getElementById("main").style.marginLeft = "0px";
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