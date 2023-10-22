$.ajax({
    type: 'POST',
    url: '../ajax/getUserInfo.php',
    success: function (data) {
        var data = $.parseJSON(data);
        $("#name").html(data.fname + " " + data.lname);
        $("#email").html(data.email);
    },
    error: function (xhr, status, error) {
        var errorMessage = '<strong>' + xhr.status + ': ' + xhr.statusText + '</strong> app/ajax/getUserInfo.php';
        alert(errorMessage);
    }
});