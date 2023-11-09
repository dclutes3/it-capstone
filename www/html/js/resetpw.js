$.ajax({
    type: 'POST',
    url: '../ajax/checkIfVerified.php',
    success: function (data) {
        var data = $.parseJSON(data);
        if (data.code == 1) { //user is verified
            $("#question").text(data.question);
        } 
        else if (data.code == 2) { //user is selected but not verified
            window.location = "http://3.14.168.225/app/pages/secquestion.php";
        }
        else if (data.code == -1) { //user not verified
            window.location = "http://3.14.168.225/app/pages/forgotpw.php";
        }
    },
    error: function (xhr, status, error) {
        var errorMessage = '<strong>' + xhr.status + ': ' + xhr.statusText + '</strong> app/ajax/checkIfVerified.php';
        alert(errorMessage);
    }
});

$(document).on('click', "#submitBtn", function () {
    var pass = $("input[name=pass]").val();
    if (!pass) {
        $("#resetError").html("Oops. Please enter a value for Password.");
    } else {
        $.ajax({
            type: 'POST',
            url: '../ajax/resetpw.php',
            data: {
                pass: pass
            },
            success: function (data) {
                var data = $.parseJSON(data);
		console.log(data.code);
                if (data.code == 1) { //on success
                    window.location = "http://3.14.168.225/index.php";
                }
                else { //error
                    $("#resetError").html("An unknown error occurred.");
                }
            },
            error: function (xhr, status, error) {
                var errorMessage = '<strong>' + xhr.status + ': ' + xhr.statusText + '</strong> app/ajax/resetpw.php';
                alert(errorMessage);
            }
        })
    }
});
