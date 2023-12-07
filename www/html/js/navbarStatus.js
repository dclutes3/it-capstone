$.ajax({
    type: 'POST',
    url: '../app/ajax/checkStatus.php',
    success: function (data) {
        var data = $.parseJSON(data);
        if (data.code == 1) { //logged in
            $("#dropdown-options").html(`
            <a href="myaccount" class="dropdown-item" type="button" title="My Account Button" aria-label="My Account Button">My Account<a>
            <a href="../app/scripts/logoutUser.php" class="dropdown-item" type="button" title="Logout Button" aria-label="Logout Button">Logout</a>
            `);
            if(window.location.href.includes("register") || window.location.href.includes("login") || window.location.href.includes("forgotpw") || window.location.href.includes("secquestion") || window.location.href.includes("resetpw"))
            {
                window.location="index";
            }
        } else if (data.code == -1) { //not logged in
            $("#dropdown-options").html(`
            <a href="login" class="dropdown-item" type="button" title="Login Button" aria-label="Login Button">Login<a>
            <a href="register" class="dropdown-item" type="button" title="Register Button" aria-label="Register Button">Register</a>
            `);
            if(window.location.href.includes("myaccount"))
            {
                window.location="login";
            }
        } else { //other error
            $("#dropdown-options").html(`
            <a href="login" class="dropdown-item" type="button" title="Login Button" aria-label="Login Button">Login<a>
            <a href="register" class="dropdown-item" type="button" title="Register Button" aria-label="Register Button">Register</a>
            `);
        }
    },
    error: function (xhr, status, error) {
        var errorMessage = '<b>' + xhr.status + ': ' + xhr.statusText + '</b> app/ajax/checkStatus.php';
        alert(errorMessage);
    }
});