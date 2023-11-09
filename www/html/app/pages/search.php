<!-- Begin PHP Functions -->
<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Title and Meta tags -->
        <title>Grocery Price Comparer</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- JS -->
        <script src="../../js/plugins/jquery-3.7.1.min.js"></script>
        <script src="../../js/plugins/bootstrap-5.3.2.bundle.min.js"></script>
	<script src="../../js/plugins/fontawesome-6.4.2.js"></script>
        <script src="../../js/search.js"></script>
        <script src="../../js/plugins/select2-4.1.0-rc.0.min.js"></script>

        <!-- CSS -->
        <link rel="stylesheet" href="../../css/bootstrap-5.3.2.min.css">
	<link rel="stylesheet" href="../../css/fontawesome-6.4.2.css">
        <link rel="stylesheet" href="../../css/grocery.css">
        <link rel="stylesheet" href="../../css/select2-4.1.0-rc.0.min.css">
    </head>
    <body id="body" class="bg-light">
        <!-- Begin Navbar Include -->
        <?php include 'navbar.php' ?>
        <!-- End Navbar Include -->
        <!-- Begin Content Area -->
        <div id="searchContainer" class="container shadow py-5 bg-white rounded-2 mt-3">
            
            <!-- Button to Open the Modal -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addItemModal1">
                Add Item
            </button>

            <!-- The Modal -->
            <div class="modal" id="addItemModal1">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Add Item</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <p>Find the name of the item you would like to add a price for in the dropdown below</p>
                            <select class="form-control form-control-sm" id="itemDropdown"></select>
                            <button type="button" class="btn btn-success" id="useItemButton">Use Item</button>
                            <p>If the item doesn't exist, add the name and type of the item in the fields below</p>
                            <input class="form-control form-control-sm" id="itemTextBox" type="text" placeholder="Enter item name">
                            <select class="form-control form-control-sm" id="itemType" name="itemType"></select>
                            <button type="button" class="btn btn-success" id="addItemButton1">Add Item</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- The Modal -->
            <div class="modal" id="addItemModal2">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Add Item</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <p>Enter the price and store name for the item</p>
                            <label for="priceTextBox">Price:</label>
                            <input class="form-control form-control-sm" id="priceTextBox" type="text" placeholder="Enter price">
                            <label for="storeName">Store:</label>
                            <select class="form-control form-control-sm" id="storeName"></select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" id="addItemButton2">Add Item</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-12">
                    <p class='h1'>Search: </p>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-md-7 col-12">
                    <label for="item">Item: </label>
                    <input class="form-control form-control-sm" id="itemName" type="text" name="item" required>
                </div>
                <div class="col-md-2 col-6">
                    <label for="itemType">Item type: </label>
                    <select class="form-control form-control-sm" id="itemType" name="itemType"></select>
                </div>
                <div class="col-md-2 col-6">
                    <label for="store">Store: </label>
                    <select class="form-control form-control-sm" id="storeName" name="store"></select>
                </div>
                <div class="col-xl-1">
                    <button id="globalSearchBtn" class="btn btn-success mt-3 w-100" type="button">Search</button>
                </div>
            </div>
            <div id="globalSearchError" class="">
                <?php //search error here ?>
            </div>
            <div id="globalSearchBody" class="">
                <?php //AJAX BODY WILL BE POPULATED HERE ?>
            </div>
            <!-- End Content Area -->
        </div>
        <script>
            $.ajax({
                url: '../ajax/itemDropdown.php',
                method: "GET",
                dataType: "json",
                success: function(data) {
                    var checkItems = $("#itemDropdown");

                    checkItems.empty();

                    data.forEach(function(object) {
                        checkItems.append($('<option>', {
                            value: object.name,
                            text: object.name
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

            
            
            $(function(){
                document.getElementById("useItemButton").addEventListener("click", function () {
                    var item = document.getElementById("itemDropdown").value;
                    $('#addItemModal1').modal('hide');
                    $('#addItemModal2').modal('show');
                });

                document.getElementById("addItemButton1").addEventListener("click", function () {
                    var name = $("#itemTextBox").val();
                    var type_id = $("#itemType").val();
                    if (item !== ""){
                        $('#addItemModal1').modal('hide');
                        $('#addItemModal2').modal('show');
                        $.ajax({
                            type: 'POST',
                            url: '../ajax/addItem.php',
                            data: {
                                name: name,
                                type_id: type_id,
                            }
                        });
                    }
                });

                

                $('#addItemButton2').on('click', function () {
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
            /*document.getElementById("itemTextBox").addEventListener("input", function () {
                var item = this.value;
                document.getElementById("displayText").textContent = item;
            });*/
            
        </script>
    </body>
</html>
