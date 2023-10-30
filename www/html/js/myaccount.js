$.ajax({
    type: 'POST',
    url: '../ajax/getUserInfo.php',
    success: function (data) {
        var data = $.parseJSON(data);
        $("#fname").val(data.fname);
        $("#lname").val(data.lname);
        $("#email").val(data.email);
    },
    error: function (xhr, status, error) {
        var errorMessage = '<strong>' + xhr.status + ': ' + xhr.statusText + '</strong> app/ajax/getUserInfo.php';
        alert(errorMessage);
    }
});

$(document).on('click', "#updateBtn", function () {
    var fname = $("input[name=fname]").val();
    var lname = $("input[name=lname]").val();
    var email = $("input[name=email]").val();
    var password = $("input[name=pass]").val();
    if (!fname || !lname || !email) {
        $("#updateError").html("Oops. Please enter a value for First Name, Last Name, and Email.");
    } else {
        $.ajax({
            type: 'POST',
            url: '../ajax/updateUser.php',
            data: {
                fname: fname,
                lname: lname,
                email: email,
                password: password
            },
            success: function (data) {
                var data = $.parseJSON(data);
                if (data.code == 1) { //on success
                    $("#updateError").html("Account successfully updated.");
                } else { //error
                    $("#updateError").html("An unknown error occurred.");
                }
            },
            error: function (xhr, status, error) {
                var errorMessage = '<strong>' + xhr.status + ': ' + xhr.statusText + '</strong> app/ajax/updateUser.php';
                alert(errorMessage);
            }
        })
    }
});

$(document).on('click', "#deleteBtn", function () {
    if (confirm("Are you sure that you wish to delete your account? This process is permanent, and upon completion you will be logged out."))
    {
        $.ajax({
            type: 'POST',
            url: '../ajax/deleteUser.php',
            success: function (data) {
                var data = $.parseJSON(data);
                if (data.code == 1) { //on success
                    window.location = "http://3.14.168.225/app/scripts/logoutUser.php";
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