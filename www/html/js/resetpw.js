$(document).on('click', "#submitBtn", function () {
    var pass = $("input[name=pass]").val();
    if (!pass) {
        $("#resetError").html("Oops. Please enter a value for Password.");
    } else {
        $.ajax({
            type: 'POST',
            url: '../app/ajax/resetpw.php',
            data: {
                pass: pass
            },
            success: function (data) {
                var data = $.parseJSON(data);
		console.log(data.code);
                if (data.code == 1) { //on success
                    window.location = "index";
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
