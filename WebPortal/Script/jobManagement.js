/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var modal=null;

function openHardwareModal(){
    var modal = document.getElementById("hardwareRegModal");
    modal.style.display = "block";
    var span = document.getElementById("hardwareClose");
    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    };

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    };
}

function openSoftwareModal(){
    var modal = document.getElementById("softwareRegModal");
    modal.style.display = "block";
    var span = document.getElementById("softwareClose");
    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    };

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    };
}

function addTask(){
    var descr = $('#addTaskInput').val();
    var startDate= new Date().toISOString().slice(0, 19).replace('T', ' ');
    if(descr!==""){
        $.ajax({
            url: 'jobManagementAjax.php',
            method: 'post',
            cache: false,
            data: {callAdd: "Task", taskDescr: descr, taskStart: startDate}
        });
    }
    $( "#tasks" ).load(window.location.href + " #tasks" );
}

function addHardwareReg (ele) {
    event.preventDefault();
    var modal = document.getElementById("hardwareRegModal");
    var hardwareDescr = $('#hardwareDescr').val();
    var hardwareSupplier = $('#hardwareSupplier').val();
    var hardwareValue = $('#hardwareValue').val();
    var hardwareWarrantyInitiation = $('#hardwareWarrantyInitiation').val();
    var hardwareWarrantyExpiration = $('#hardwareWarrantyExpiration').val();
    var hardwareProcurement = $('#hardwareProcurement').val();
    var hardwareDelivery = $('#hardwareDelivery').val();
    if(hardwareDescr!=="" && hardwareSupplier!=="" && hardwareValue!=="" && hardwareProcurement!==""){
        $.ajax({
            url:"jobManagementAjax.php",    //the page containing php script
            method: "post",    //request type,
            cache: false,
            data: {
                jobRegistry: "hardware", 
                eqDescription: hardwareDescr, 
                supplier: hardwareSupplier, 
                eqValue: hardwareValue, 
                warrantyInitation: hardwareWarrantyInitiation,
                warrantyExpiration: hardwareWarrantyExpiration,
                procurementDate: hardwareProcurement,
                deliveryDate: hardwareDelivery
            }
        });
    };
    modal.style.display = "none";
    $( "#hardware-registry" ).load(window.location.href + " #hardware-registry" );
}

function addSoftwareReg (ele) {
    event.preventDefault();
    var modal = document.getElementById("softwareRegModal");
    var softwareDescr = $('#softwareDescr').val();
    var softwareSupplier = $('#softwareSupplier').val();
    var softwareValue = $('#softwareValue').val();
    var softwareSubEnd = $('#softwareSubEnd').val();
    var softwareProcurement = $('#softwareProcurement').val();
    var softwareDelivery = $('#softwareDelivery').val();
    if(softwareDescr!=="" && softwareSupplier!=="" && softwareValue!=="" && softwareProcurement!==""){
        $.ajax({
            url:"jobManagementAjax.php",    //the page containing php script
            method: "post",    //request type,
            cache: false,
            data: {
                jobRegistry: "software", 
                eqDescription: softwareDescr, 
                supplier: softwareSupplier, 
                eqValue: softwareValue, 
                subscriptionEnd: softwareSubEnd,
                procurementDate: softwareProcurement,
                deliveryDate: softwareDelivery
            }
        });
    };
    modal.style.display = "none";
    $( "#software-registry" ).load(window.location.href + " #software-registry" );
}



function setTaskCheck(ele){
    var ID=ele.id;
    var x = document.getElementById(ID).checked;
    var date;
    if (x==false){
        date="NULL";
    } else {
        date= new Date().toISOString().slice(0, 19).replace('T', ' ');
    }
    
    $.ajax({
        url: 'jobManagementAjax.php',
        cache: false,
        method: 'post',
        data: {callCheck: "Task", taskID:ID, taskDate:date}
    });
}



function setMilestoneCheck(ele){
    var ID=ele.id;
    var x = document.getElementById(ID).checked;
    var date;
    if (x==false){
        date="NULL";
    } else {
        date= new Date().toISOString().slice(0, 19).replace('T', ' ');
    }
    $.ajax({
        cache: false,
        url: 'jobManagementAjax.php',
        method: 'post',
        data: { callCheck: "Milestone", mcID: ID, mcDate: date},
        error: function(){alert("Error");}
    });
}

function dropTask(ele){
    event.preventDefault();
    var ID=ele.id;
    $.ajax({
        cache: false,
        url: 'jobManagementAjax.php',
        method: 'post',
        data: { callDrop: "Task", taskID:ID},
        error: function(){alert("Error");}
    });
    $( "#tasks" ).load(window.location.href + " #tasks" );
}

function dropSoftwareReg(ele){
    event.preventDefault();
    var ID=ele.id;
    $.ajax({
        cache: false,
        url: 'jobManagementAjax.php',
        method: 'post',
        data: { callDrop: "Software", equipmentID: ID},
        error: function(){alert("Error");}
    });
    $( "#software-registry" ).load(window.location.href + " #software-registry" );
}

function dropHardwareReg(ele){
    event.preventDefault();
    var ID=ele.id;
    $.ajax({
        cache: false,
        url: 'jobManagementAjax.php',
        method: 'post',
        data: { callDrop: "Hardware", equipmentID: ID},
        error: function(){alert("Error");}
    });
    $( "#hardware-registry" ).load(window.location.href + " #hardware-registry" );
}
        


$('#jobStatus').change(function () {
    var status=this.options[this.selectedIndex].text;
    $.ajax({
        url:"jobManagementAjax.php",
        method: "post",
        cache: false,
        data: {
            jobStatus: status
        }
    });
    $( "#jobList" ).load(window.location.href + " #jobList>*" );
});

$('#jobPriority').change(function () {
    var priority=this.options[this.selectedIndex].text;
    $.ajax({
        url:"jobManagementAjax.php",
        method: "post",
        cache: false,
        data: {
            jobPriority: priority
        }
    });
    $( "#jobList" ).load(window.location.href + " #jobList>*" );
});

$(document).ready(function(){
$("#jobList").on('click','tr',function() {
        var ID= $(this).find("td:first-child").text();
        var date= new Date().toISOString().slice(0, 19).replace('T', ' ');
        
        $.ajax({
        url:"jobManagementAjax.php",
        method: "post",
        data: {
            selectedJobID: ID,
            jobUpdateDate: date
        }
        });
        /*$( "#bodyReload" ).load(window.location.href + " #bodyReload" );
        alert(ID);
        document.cookie = "selectedJobID="+ID;*/
        location.href = "jobManagement.php";
});
});