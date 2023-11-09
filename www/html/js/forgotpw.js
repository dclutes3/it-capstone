$(document).on('click',"#forgotBtn",function(){
    var email = $("input[name=email]").val();
    if(!email){
        $("#forgotError").html("Oops. Please enter a value for email.");
    } else {
        $.ajax({
            type: 'POST',
            url: '../ajax/forgotpw.php',
            data: {
                email: email
            },
            success: function(data){
                var data = $.parseJSON(data);
                if(data.code == 1){ //on success
                    $("#forgotError").html("");
                    window.location.href = 'secquestion.php';
                } else if (data.code == -1){ //invalid email
                    $("#forgotError").html("Invalid Email.");
                } else { //other error
                    $("#forgotError").html("An unknown error occurred.");
                }
            },
            error: function(xhr, status, error){
                var errorMessage = '<strong>' + xhr.status + ': ' + xhr.statusText + '</strong> app/ajax/forgotpw.php';
                alert(errorMessage);
            }
        })
    }
});