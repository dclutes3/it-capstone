$.ajax({
    type: 'POST',
    url: '../app/ajax/secquestion.php',
    success: function (data) {
        var data = $.parseJSON(data);
        if (data.code == 1) { //user is selected
            $("#question").text(data.question);
        } else if (data.code == -1) { //user not selected
            window.location = "forgotpw";
        }
    },
    error: function (xhr, status, error) {
        var errorMessage = '<strong>' + xhr.status + ': ' + xhr.statusText + '</strong> app/ajax/secquestion.php';
        alert(errorMessage);
    }
});

$(document).on('click', "#submitBtn", function () {
    var answer = $("input[name=answer]").val();
    if (!answer) {
        $("#forgotError").html("Oops. Please enter a value for Answer.");
    } else {
        $.ajax({
            type: 'POST',
            url: '../app/ajax/verifyAnswer.php',
            data: {
                answer: answer
            },
            success: function (data) {
                var data = $.parseJSON(data);
                if (data.code == 1) { //on success
                    window.location = "resetpw";
                }
                if (data.code == -1) { //on success
                    $("#forgotError").html("Incorrect answer.");
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
