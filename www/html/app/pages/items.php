<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Title and Meta tags -->
        <title>PricePal - Items</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- JS -->
        <script src="../js/plugins/bootstrap-5.3.2.bundle.min.js"></script>
        <script src="../js/plugins/jquery-3.7.1.min.js"></script>
        <script src="../js/plugins/fontawesome-6.4.2.js"></script>
        <script src="../js/plugins/datatables-1.13.6.min.js"></script>
        <script src="../js/plugins/select2-4.1.0-rc.0.min.js"></script>
        <script src="../js/plugins/jquery-ui-1.13.2.min.js"></script>
        <script src="../js/item.js"></script> 

        <!-- CSS -->
        <link href="../../css/select2-4.1.0-rc.0.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="../css/jquery-ui-1.13.2.min.css">
        <link rel="stylesheet" href="../css/bootstrap-5.3.2.min.css">
        <link rel="stylesheet" href="../css/fontawesome-6.4.2.css">
        <link rel="stylesheet" href="../css/datatables-1.13.6.min.css">
        <link rel="stylesheet" href="../css/grocery.scss">
    </head>
    <body>
        <!-- Begin Navbar Include -->
        <?php include 'navbar.php' ?>
        <!-- End Navbar Include -->
        <!-- Begin Content Area -->
        <div id="itemsContainer" class="container-fluid shadow py-3 bg-white rounded-2 mt-3">
            <input type="hidden" id="userId" value="<?php echo $_SESSION['user'] ?>">
            <div id="banner-page" class="d-flex mb-4">
                <div class="my-auto text-center w-100">
                    <div class="col-md-12">
                        <h1 class="title-gray-bg">All Items</h1>
                    </div>
                </div>
            </div>
            <div id="filterDiv">
                <?php include_once 'filter.php' ?>
            </div>
            <div class='py-2'>
                <button id="addItem" type="button" class="btn btn-success">Add Item</button>
                <button id="addToCart" type="button" class="btn btn-warning" disabled>Add to Cart</button>
            </div>
            <table id="tableItems" class="display w-100">
                <thead>
                    <tr>
                        <th style="max-width:25px;"></th>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Type</th>
                        <th>Store</th>
                        <th>Date</th>
                        <th style="max-width: 50px">Votes</th><?php //id for votes and such  ?>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="modal" id="addItemModal1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Item</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="itemSelection">
                        <div>
                            <label class='form-label'>Find the name of the item you would like to add a price for in the dropdown below</label>
                            <select class="add-item-select2 form-control-lg mb-2" id="itemDropdown"></select>
                        </div>
                        <div class='my-2'>
                            <label class='form-label'>If the item doesn't exist, add the name and type of the item in the fields below</label>
                            <input class="form-control" id="itemTextBox" type="text" placeholder="Enter item name">

                            <label class="form-label mt-2" for="itemType">Item Type:</label>
                            <select class="add-type-select2 form-control-lg" id="itemType" name="itemType"></select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <p id="addItemModal1Error"></p>
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
                        <input class="form-control form-control-sm" id="priceTextBox" type="number" min="0" max="100" placeholder="Enter price">

                        <label class="form-label" for="storeName">Store:</label>
                        <select class="add-store-select2 form-control" id="storeName"></select>
                    </div>

                    <div class="modal-footer">
                        <p id="addItemModal2Error"></p>
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
                        <p id="addItemModal3Text"></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- The Modal -->
        <div class="modal" id="errorModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Add Item</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <p>You must be logged in to add items.</p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <a href="login.php" class="btn btn-success">Log In</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- End Content Area -->
    </body>
</html>
