$(document).on('click',"#registerBtn",function(){
    var fname = $("input[name=fname]").val();
    var lname = $("input[name=lname]").val();
    var email = $("input[name=email]").val();
    var password = $("input[name=pass]").val();
    var squestion = $("input[name=squestion]").val();
    var sanswer = $("input[name=sanswer]").val();
    if(!fname || !lname || !email || !password || !squestion || !sanswer){
        $("#registerError").html("Oops. Please enter a value for all fields.");
    } else {
        $.ajax({
            type: 'POST',
            url: '../ajax/registerUser.php',
            data: {
                fname: fname,
                lname: lname,
                email: email,
                password: password,
		squestion: squestion,
		sanswer: sanswer
            },
            success: function(data){
                var data = $.parseJSON(data);
                if(data.code == 1){ //on success
                    $("#registerError").html("");
                    $("input[name=fname]").val("");
                    $("input[name=lname]").val("");
                    $("input[name=email]").val("");
                    $("input[name=pass]").val("");
		    $("input[name=squestion]").val("");
		    $("input[name=sanswer]").val("");
                    window.location="http://3.14.168.225/app/pages/index.php"
                } else if (data.code == -1){ //existing email
                    $("#registerError").html("This email already exists.");
                } else { //other error
                    $("#registerError").html("An unknown error occurred.");
                }
            },
            error: function(xhr, status, error){
                var errorMessage = '<strong>' + xhr.status + ': ' + xhr.statusText + '</strong> app/ajax/registerUser.php';
                alert(errorMessage);
            }
        })
    }
});