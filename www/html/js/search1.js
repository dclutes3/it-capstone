$(function(){

    //Get the item types from the database
    $.ajax({
        url: '../ajax/itemType.php',
        method: "GET",
        dataType: "json",
        success: function(data) {
            var itemType = $("#itemType");

            itemType.empty();

            data.forEach(function(item) {
                itemType.append($('<option>', {
                    value: item.name,
                    text: item.name
                }));
            });
        },
        error: function() {
            console.error("Failed to retrieve data from the server.");
        }
    });



    //Get the store names from the database
    $.ajax({
        url: '../ajax/storeName.php',
        method: "GET",
        dataType: "json",
        success: function(data) {
            var storeName = $("#storeName");

            storeName.empty();

            data.forEach(function(item) {
                storeName.append($('<option>', {
                    value: item.name,
                    text: item.name
                }));
            });
        },
        error: function() {
            console.error("Failed to retrieve data from the server.");
        }
    });
    

    
    //Get the results from the database after the search button is clicked
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
                url: '../ajax/globalSearch.php',
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
});