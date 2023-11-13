$(function(){
    
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

$(function(){
    var addItem;
    var item_id;
    $.ajax({
        url: '../ajax/itemDropdown.php',
        method: "GET",
        dataType: "json",
        success: function(data) {
            var checkItems = $("#itemDropdown");

            checkItems.empty();

            data.forEach(function(item) {
                checkItems.append($('<option>', {
                    value: item.id,
                    text: item.name
                }));
            });
        },
        error: function() {
            console.error("Failed to retrieve data from the server.");
        }
    });
    $('#itemDropdown').select2({
        dropdownParent: $('#addItemModal1'),
        width: "100%"
    });

    $("#itemDropdown").on("change",function(){
        item_id = document.getElementById("itemDropdown").value;
        addItem = false;
        $('#addItemModal1').modal('hide');
        $('#addItemModal2').modal('show');
    });

    $("#addItemBackButton").on("click",function(){
        $('#addItemModal2').modal('hide');
        $('#addItemModal3').modal('hide');

        $('#addItemModal1').modal('show');
    })

    $("#addItemButton1").on("click",function(){
        var name = $("#itemTextBox").val();
        var type_id = $("#itemType").val();
        if (name !== ""){
            addItem = true;
            $('#addItemModal1').modal('hide');
            $('#addItemModal2').modal('show');

        }
    });

    

    $('#addItemButton2').on('click', function () {
        var name = $("#itemTextBox").val();
        var type_id = $("#itemType").val();
        var price = $("#priceTextBox").val();
        var store_id = $("#storeName").val();
        if (addItem){
            $.ajax({
                type: 'POST',
                url: '../ajax/addItem.php',
                data: {
                    name: name,
                    type_id: type_id,
                },
                success: function(data){
                    item_id = JSON.parse(data).id;
                    $.ajax({
                        type: 'POST',
                        url: '../ajax/addPrice.php',
                        data: {
                            price: price,
                            store_id: store_id,
                            item_id: item_id
                        }
                    });
                }
            });
            
        }
        else{
            $.ajax({
                type: 'POST',
                url: '../ajax/addPrice.php',
                data: {
                    price: price,
                    store_id: store_id,
                    item_id: item_id
                }
            });
        }
        $('#addItemModal2').modal('hide');
        $('#addItemModal3').modal('show');
    });

    if($(".type-select2").length){
    //Get the item types from the database
        $.ajax({
            url: '../ajax/select2-itemType.php',
            method: "GET",
            dataType: "json",
            success: function(data) {
                $(".type-select2").select2({
                    placeholder: "Select an item type",
                    dropdownParent: $('#addItemModal1'),
                    dropdownAutoWidth: true,
                    allowClear: true,
                    width: "100%",
                    data: data
                });
            },
            error: function() {
                console.error("Failed to retrieve data from the server.");
            }
        });
    }

    if($(".add-store-select2").length){
        $.ajax({
            url: '../ajax/select2-storeName.php',
            method: "GET",
            dataType: "json",
            success: function(data) {
                $(".add-store-select2").select2({
                    placeholder: "Select an store",
                    dropdownParent: $('#addItemModal2'),
                    dropdownAutoWidth: true,
                    allowClear: true,
                    width: "100%",
                    data: data
                });
            },
            error: function() {
                console.error("Failed to retrieve data from the server.");
            }
        });
    }
    



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