$(function(){
    $('#globalSearchBtn').on('click', function () {
        var itemName = $("#itemName").val();
        var itemType = $("#itemType").val();
        var storeName = $("#storeName").val();
        if (!itemName || !itemType || !storeName) {
            console.log($("#globalSearchBody"));
            $("#globalSearchBody").html("");
            $("#globalSearchError").html("<p class='text-danger'>You must select a value for all input fields.</p>");
        } else {
            $.ajax({
                type: 'POST',
                url: 'app/ajax/globalSearch.php',
                data: {
                    item: itemName,
                    type: itemType,
                    store: storeName,
                },
                success: function (data) {
                    var data = $.parseJSON(data);
                    if (data.code === 1) {
                        $("#itemName").val("");
                        $("#itemType").val("All");
                        $("#storeName").val("All");
                        $("#globalSearchError").html("");
                        $("#globalSearchBody").html(data.msg);
                    } else {
                        $("#globalSearchBody").html("");
                        $("#globalSearchError").html("An unknown error occurred.");
                    }
                },
                error: function (xhr, status, error) {
                    var errorMessage = '<strong>' + xhr.status + ': ' + xhr.statusText + '</strong> app/ajax/globalSearch.php';
                    alert(errorMessage);
                }
            });
        }
    }); 
})

