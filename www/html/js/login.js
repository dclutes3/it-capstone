$(document).on('click',"#loginBtn",function(){
    var email = $("input[name=email]").val();
    var password = $("input[name=pass]").val();
    if(!email || !password){
        $("#loginError").html("Oops. Please enter a value for all fields.");
    } else {
        $.ajax({
            type: 'POST',
            url: 'ajax/loginUser.php',
            data: {
                email: email,
                password: password
            },
            success: function(data){
                var data = $.parseJSON(data);
                if(data.code == 1){ //on success
                    $("input[name=email]").val("");
                    $("input[name=pass]").val("");
                    window.location="http://3.14.168.225/index.php"
                } else if (data.code == -1){ //invalid login
                    $("#loginError").html("Invalid Email or Password.");
                } else { //other error
                    $("#loginError").html("An unknown error occurred.");
                }
            },
            error: function(xhr, status, error){
                var errorMessage = '<strong>' + xhr.status + ': ' + xhr.statusText + '</strong> /ajax/loginUser.php';
                alert(errorMessage);
            }
        })
    }
});