$(document).on('click','#globalSearchBtn',function(){
    var itemName = $("#itemName").val();
    var itemType = $("#itemType").val();
    var store = $("#storeName").val();
    if(!itemName || !itemType || !storeName){
        $("#searchError").html("You must select a value for all input fields.");
    } else {
        $.ajax({
            type: 'POST',
            url: 'ajax/globalSearch.php',
            data: {
                item: itemName,
                type: itemType,
                store: storeName,
            },
            success: function(data){
                var data = $.parseJSON(data);
                if(data.code == 1){
                    $("#searchError").html("");
                    $("#itemName").val("");
                    $("#itemType").val("");
                    $("#storeName").val("");
                    $("#searchBody").html(data.msg);
                } else {
                    $("#searchBody").html("");
                    $("#searchError").html("An unknown error occurred.");
                }
            },
            error: function(xhr, status, error){
                var errorMessage = '<strong>' + xhr.status + ': ' + xhr.statusText + '</strong> /ajax/registerUser.php';
                alert(errorMessage);
            }
        })
    }
})