$(function(){
    if($("#accountBody").length){
        getAccountBody();
    }
    $("#accountBody").on("click","#updateFname",function(){
        $("#fnameInput").show();
        $("#fnameValue").hide();
        $("#fnameButton").html('<button id="saveFname" class="btn"><i class="fa-solid fa-floppy-disk"></i></button>');
    })
    $("#accountBody").on("click","#saveFname",function(){
        $.ajax({
            type: 'POST',
            url: '../app/ajax/user_ajax.php',
            data:{
                action: "updateFname",
                fname: $("#fnameInput").val(),
            },
            success: function (data) {
                var data = $.parseJSON(data);
                if (data.code == 1) { //on success
                    $("#fnameInput").hide();
                    $("#fnameValue").show();
                    $("#fnameButton").html('<button id="updateFname" class="btn"><i class="fa-solid fa-pencil"></i></button>');
                    getFnameBody();
                } else { //error
                    $("#updateError").html(data.msg);
                }
            },
            error: function (xhr, status, error) {
                var errorMessage = '<strong>' + xhr.status + ': ' + xhr.statusText + '</strong> app/ajax/deleteUser.php';
                alert(errorMessage);
            }
        })
    })
    $("#accountBody").on("click","#updateLname",function(){
        $("#lnameInput").show();
        $("#lnameValue").hide();
        $("#lnameButton").html('<button id="saveLname" class="btn"><i class="fa-solid fa-floppy-disk"></i></button>');
    })
    $("#accountBody").on("click","#saveLname",function(){
        $.ajax({
            type: 'POST',
            url: '../app/ajax/user_ajax.php',
            data:{
                action: "updateLname",
                lname: $("#lnameInput").val(),
            },
            success: function (data) {
                var data = $.parseJSON(data);
                if (data.code == 1) { //on success
                    console.log(data.msg);
                    $("#lnameInput").hide();
                    $("#lnameValue").show();
                    $("#lnameButton").html('<button id="updateLname" class="btn"><i class="fa-solid fa-pencil"></i></button>');
                    getLnameBody();
                } else { //error
                    $("#updateError").html(data.msg);
                }
            },
            error: function (xhr, status, error) {
                var errorMessage = '<strong>' + xhr.status + ': ' + xhr.statusText + '</strong> app/ajax/deleteUser.php';
                alert(errorMessage);
            }
        })
        
    })
    $("#accountBody").on("click","#updateEmail",function(){
        $("#emailInput").show();
        $("#emailValue").hide();
        $("#emailButton").html('<button id="saveEmail" class="btn"><i class="fa-solid fa-floppy-disk"></i></button>');
    })
    $("#accountBody").on("click","#saveEmail",function(){
        $.ajax({
            type: 'POST',
            url: '../app/ajax/user_ajax.php',
            data:{
                action: "updateEmail",
                email: $("#emailInput").val(),
            },
            success: function (data) {
                var data = $.parseJSON(data);
                if (data.code == 1) { //on success
                    $("#emailInput").hide();
                    $("#emailValue").show();
                    $("#emailButton").html('<button id="updateEmail" class="btn"><i class="fa-solid fa-pencil"></i></button>');
                    getEmailBody();
                } else { //error
                    $("#updateError").html(data.msg);
                }
            },
            error: function (xhr, status, error) {
                var errorMessage = '<strong>' + xhr.status + ': ' + xhr.statusText + '</strong> app/ajax/deleteUser.php';
                alert(errorMessage);
            }
        })
    })
    $("#accountBody").on("click","#updatePassword",function(){
        $("#passwordInput").show();
        $("#passwordValue").hide();
        $("#passwordButton").html('<button id="savePassword" class="btn"><i class="fa-solid fa-floppy-disk"></i></button>');
    })
    $("#accountBody").on("click","#savePassword",function(){
        $.ajax({
            type: 'POST',
            url: '../app/ajax/user_ajax.php',
            data:{
                action: "updatePassword",
                password: $("#passwordInput").val(),
            },
            success: function (data) {
                var data = $.parseJSON(data);
                if (data.code == 1) { //on success
                    console.log(data.msg);
                    $("#passwordInput").hide();
                    $("#passwordValue").show();
                    $("#passwordButton").html('<button id="updatePassword" class="btn"><i class="fa-solid fa-pencil"></i></button>');
                    getPasswordBody();
                } else { //error
                    $("#updateError").html(data.msg);
                }
            },
            error: function (xhr, status, error) {
                var errorMessage = '<strong>' + xhr.status + ': ' + xhr.statusText + '</strong> app/ajax/deleteUser.php';
                alert(errorMessage);
            }
        })
        
    })
})

$(document).on('click', "#deleteBtn", function () {
    if (confirm("Are you sure that you wish to delete your account? This process is permanent, and upon completion you will be logged out."))
    {
        $.ajax({
            type: 'POST',
            url: '../app/ajax/user_ajax.php',
            data:{
                action: "delete",
            },
            success: function (data) {
                console.log(data);
                var data = $.parseJSON(data);
                if (data.code == 1) { //on success
                    window.location = "../app/scripts/logoutUser.php";
                } else { //error
                    $("#updateError").html("An error occurred while deleting your account.");
                }
            },
            error: function (xhr, status, error) {
                var errorMessage = '<strong>' + xhr.status + ': ' + xhr.statusText + '</strong> app/ajax/deleteUser.php';
                alert(errorMessage);
            }
        })
    }
});

function getAccountBody(){
    getFnameBody();
    getLnameBody();
    getEmailBody();
    getPasswordBody();
}

function getFnameBody(){
    $.ajax({
        url: '/app/ajax/account-fname.php',
        method: 'GET',
        dataType: 'html',
        success: function (data) {
            $('#fnameBody').html(data);     //overwrite the html of #fnameBody
            $('#name').html("Welcome, " + $("#fnameValue").text() + " " + $("#lnameValue").text() + "&nbsp;");
            $("#fnameInput").hide();
        },
        error: function () {
            alert('Error fetching data.');
        }
    });
}

function getLnameBody(){
    $.ajax({
        url: '/app/ajax/account-lname.php',
        method: 'GET',
        dataType: 'html',
        success: function (data) {
            $('#lnameBody').html(data);     //overwrite the html of #lnameBody
            $('#name').html("Welcome, " + $("#fnameValue").text() + " " + $("#lnameValue").text() + "&nbsp;");
            $("#lnameInput").hide();
        },
        error: function () {
            alert('Error fetching data.');
        }
    });
}

function getEmailBody(){
    $.ajax({
        url: '/app/ajax/account-email.php',
        method: 'GET',
        dataType: 'html',
        success: function (data) {
            $('#emailBody').html(data);     //overwrite the html of #emailBody
            $("#emailInput").hide();
        },
        error: function () {
            alert('Error fetching data.');
        }
    });
}

function getPasswordBody(){
    $.ajax({
        url: '/app/ajax/account-password.php',
        method: 'GET',
        dataType: 'html',
        success: function (data) {
            $('#passwordBody').html(data);     //overwrite the html of #passwordBody
            $("#passwordInput").hide();
        },
        error: function () {
            alert('Error fetching data.');
        }
    });
}