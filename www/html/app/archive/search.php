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
        <script src="../js/plugins/jquery-3.7.1.min.js"></script>
        <script src="../js/plugins/bootstrap-5.3.2.bundle.min.js"></script>
	    <script src="../js/plugins/fontawesome-6.4.2.js"></script>
        <script src="../js/plugins/select2-4.1.0-rc.0.min.js"></script>
        <?php //<script src="../js/search.js"></script> ?>


        <!-- CSS -->
        <link rel="stylesheet" href="../css/bootstrap-5.3.2.min.css">
	<link rel="stylesheet" href="../css/fontawesome-6.4.2.css">
        <link rel="stylesheet" href="../css/grocery.scss">
        <link rel="stylesheet" href="../css/select2-4.1.0-rc.0.min.css">
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

            <div class="modal" id="addItemModal1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Item</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <label class='form-label'>Find the name of the item you would like to add a price for in the dropdown below</label>
                                <select class="form-control mb-2" id="itemDropdown"></select>
                            </div>
                            <div class='my-2'>
                                <label class='form-label'>If the item doesn't exist, add the name and type of the item in the fields below</label>
                                <input class="form-control" id="itemTextBox" type="text" placeholder="Enter item name">
                                
                                <label class='form-label mt-2'>Item Type:</label>
                                <select class="type-select2 form-control" id="itemType" name="itemType"></select>
                            </div>
                        </div>
                        <div class="modal-footer">
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
                            <button type="button" class="btn btn-danger" id="addItemBackButton">Back</button>
                            <button type="button" class="btn btn-success" id="addItemButton2">Add Item</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- The Modal -->
            <div class="modal" id="addItemModal3">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Add Item</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <p>Price added successfully</p>
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
    </body>
</html>