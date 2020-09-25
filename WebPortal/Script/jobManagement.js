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

function addHardwareReg () {
    alert("Called");
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
            type: "post",    //request type,

            data: {
                jobRegistry: "hardware", 
                eqDescription: hardwareDescr, 
                supplier: hardwareSupplier, 
                eqValue: hardwareValue, 
                warrantyInitation: hardwareWarrantyInitiation,
                warrantyExpiration: hardwareWarrantyExpiration,
                procurementDate: hardwareProcurement,
                deliveryDate: hardwareDelivery
            },
            success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    alert("Data added successfully");						
                }
                else if(dataResult.statusCode==201){
                   alert("Error occured");
                }		
            }
        });
    };
    modal.style.display = "none";
}

function addSoftwareReg () {
    var softwareDescr = $('#softwareDescr').val();
    var softwareSupplier = $('#softwareSupplier').val();
    var softwareValue = $('#softwareValue').val();
    var softwareSubEnd = $('#softwareSubEnd').val();
    var softwareProcurement = $('#softwareProcurement').val();
    var softwareDelivery = $('#softwareDelivery').val();
    if(softwareDescr!=="" && softwareSupplier!=="" && softwareValue!=="" && softwareProcurement!==""){
        $.ajax({
            url:"jobManagementAjax.php",    //the page containing php script
            type: "post",    //request type,

            data: {
                jobRegistry: "software", 
                eqDescription: softwareDescr, 
                supplier: softwareSupplier, 
                eqValue: softwareValue, 
                subscriptionEnd: softwareSubEnd,
                procurementDate: softwareProcurement,
                deliveryDate: softwareDelivery
            },
            success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    alert("Data added successfully");						
                }
                else if(dataResult.statusCode==201){
                   alert("Error occured");
                }		
            }
        });
    };
    modal.style.display = "none";
}



function setTaskCheck(ele){
    var ID=ele.id;
    var x = document.getElementById(ID).checked;
    var date;
    if (x==true){
        date= date.toISOString().split('T')[0] + ' ' + date.toTimeString().split(' ')[0];
    } else {
        date=null
    }
    $.ajax({
        url: 'jobManagementAjax.php',
        type: 'post',
        data: { callCheck: "Task", taskID:ID, taskDate:date},
        error: function(){alert("Error");}
    });
}

function addTask(){
    var descr=document.getElementById("addTaskInput");
    var startDate= date.toISOString().split('T')[0] + ' ' + date.toTimeString().split(' ')[0];
    $.ajax({
        url: 'jobManagementAjax.php',
        type: 'post',
        data: {callAdd: "Task", taskDescr:descr, taskStart:startDate},
        error: function(){alert("Error");}
    });
}

function setMilestoneCheck(ele){
    var ID=ele.id;
    var x = document.getElementById(ID).checked;
    var date;
    if (x==true){
        date= date.toISOString().split('T')[0] + ' ' + date.toTimeString().split(' ')[0];
    } else {
        date=null
    }
    $.ajax({
        url: 'jobManagementAjax.php',
        type: 'post',
        data: { callCheck: "Milestone", mcID:ID, mcDate:date},
        error: function(){alert("Error");}
    });
}

function dropTask(ele){
    var ID=ele.id;
    $.ajax({
        url: 'jobManagementAjax.php',
        type: 'post',
        data: { callDrop: "Task", taskID:ID},
        error: function(){alert("Error");}
    });
}

function dropSoftwareReg(ele){
    var ID=ele.id;
    $.ajax({
        url: 'jobManagementAjax.php',
        type: 'post',
        data: { callDrop: "Software", equipmentID:ID},
        error: function(){alert("Error");}
    });
}

function dropHardwareReg(ele){
    var ID=ele.id;
    $.ajax({
        url: 'jobManagementAjax.php',
        type: 'post',
        data: { callDrop: "Hardware", equipmentID:ID},
        error: function(){alert("Error");}
    });
}

$(document).ready(function() {

    $('#jobList tr').click(function() {
        var id = $(this);
        $.ajax({
        url: 'jobManagementAjax.php',
        type: 'post',
        data: { selectedJobID: id},
        error: function(){alert("Error");}
    });
    });

});