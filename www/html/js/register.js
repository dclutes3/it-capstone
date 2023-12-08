$(document).ready(function () {
    if ($('.question-select2').length) {
        $.ajax({
            type: 'GET',
            url: '/app/ajax/select2-questions.php',
            dataType: 'json',
            success: function (data) {
                $(".question-select2").select2({
                    placeholder: "Select a question",
                    dropdownAutoWidth: true,
                    allowClear: true,
                    width: "100%",
                    data: data
                });
                $(".question-select2").val(null).trigger("change");
            },
            error: function (xhr, status, error) {
                var errorMessage = '<strong>' + xhr.status + ': ' + xhr.statusText + '</strong> /app/ajax/select2-questions.php';
            }
        })
    }
});

$(document).on('click', "#registerBtn", function () {
    var fname = $("input[name=fname]").val();
    var lname = $("input[name=lname]").val();
    var email = $("input[name=email]").val();
    var password = $("input[name=pass]").val();
    var squestion = $(".question-select2").val();
    var sanswer = $("input[name=sanswer]").val();
    if (!fname || !lname || !email || !password || !squestion || !sanswer) {
        $("#registerError").html("Oops. Please enter a value for all fields.");
    } else {
        $.ajax({
            type: 'POST',
            url: '../app/ajax/registerUser.php',
            data: {
                fname: fname,
                lname: lname,
                email: email,
                password: password,
                squestion: squestion,
                sanswer: sanswer
            },
            success: function (data) {
                var data = $.parseJSON(data);
                if (data.code == 1) { //on success
                    $("#registerError").html("");
                    $("input[name=fname]").val("");
                    $("input[name=lname]").val("");
                    $("input[name=email]").val("");
                    $("input[name=pass]").val("");
                    $("input[name=squestion]").val("");
                    $("input[name=sanswer]").val("");
                    window.location = "index"
                } else if (data.code == -1) { //existing email
                    $("#registerError").html("This email already exists.");
                } else { //other error
                    $("#registerError").html("An unknown error occurred.");
                }
            },
            error: function (xhr, status, error) {
                var errorMessage = '<strong>' + xhr.status + ': ' + xhr.statusText + '</strong> app/ajax/registerUser.php';
                alert(errorMessage);
            }
        })
    }
});