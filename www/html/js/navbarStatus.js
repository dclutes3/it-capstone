$.ajax({
    type: 'POST',
    url: 'app/ajax/checkStatus.php',
    success: function (data) {
        var data = $.parseJSON(data);
        if (data.code == 1) { //logged in
            $("#dropdown-options").html(`
            <a href="myaccount.php" class="dropdown-item" type="button">My Account<a>
            <a href="logoutUser.php" class="dropdown-item" type="button">Logout</a>
            `);
            if(window.location.href.includes("register.php") || window.location.href.includes("login.php"))
            {
                window.location="http://3.14.168.225/index.php";
            }
        } else if (data.code == -1) { //not logged in
            $("#dropdown-options").html(`
            <a href="login.php" class="dropdown-item" type="button">Login<a>
            <a href="register.php" class="dropdown-item" type="button">Register</a>
            `);
        } else { //other error
            $("#dropdown-options").html(`
            <a href="login.php" class="dropdown-item" type="button">Login<a>
            <a href="register.php" class="dropdown-item" type="button">Register</a>
            `);
        }
    },
    error: function (xhr, status, error) {
        var errorMessage = '<strong>' + xhr.status + ': ' + xhr.statusText + '</strong> app/ajax/checkStatus.php';
        alert(errorMessage);
    }
});
