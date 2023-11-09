$.ajax({
    type: 'POST',
    url: '../ajax/checkStatus.php',
    success: function (data) {
        var data = $.parseJSON(data);
        if (data.code == 1) { //logged in
            $("#dropdown-options").html(`
            <a href="myaccount.php" class="dropdown-item" type="button">My Account<a>
            <a href="../scripts/logoutUser.php" class="dropdown-item" type="button">Logout</a>
            `);
            if(window.location.href.includes("register.php") || window.location.href.includes("login.php") || window.location.href.includes("forgotpw.php") || window.location.href.includes("secquestion.php") || window.location.href.includes("resetpw.php"))
            {
                window.location="http://3.14.168.225/app/pages/index.php";
            }
        } else if (data.code == -1) { //not logged in
            $("#dropdown-options").html(`
            <a href="login.php" class="dropdown-item" type="button">Login<a>
            <a href="register.php" class="dropdown-item" type="button">Register</a>
            `);
            if(window.location.href.includes("myaccount.php"))
            {
                window.location="http://3.14.168.225/app/pages/login.php";
            }
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

