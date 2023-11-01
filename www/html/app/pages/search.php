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
        <!--<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>-->

        <!-- CSS -->
        <link rel="stylesheet" href="../../css/bootstrap-5.3.2.min.css">
	    <link rel="stylesheet" href="../../css/fontawesome-6.4.2.css">
        <link rel="stylesheet" href="../../css/grocery.css">
        <!--<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />-->
    </head>
    <body id="body" class="bg-light">
        <!-- Begin Navbar Include -->
        <?php include 'navbar.php' ?>
        <!-- End Navbar Include -->
        <!-- Begin Content Area -->
        <div id="searchContainer" class="container shadow py-5 bg-white rounded-2 mt-3">
            <div class="row mt-2">
                <div class="col-12">
                    <p class='h1'>Search: </p>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-7">
                    <label for="item">Item: </label>
                    <input class="form-control form-control-sm" id="itemName" type="text" name="item" required>
                </div>
                <div class="col-2">
                    <label for="itemType">Item type: </label>
                    <select class="form-control form-control-sm" id="itemType" name="itemType"></select>
                </div>
                <div class="col-2">
                    <label for="store">Store: </label>
                    <select class="form-control form-control-sm" id="storeName" name="store"></select>
                </div>
                <div class="col-1 d-flex flex-column">
                    <button id="globalSearchBtn" class="btn btn-success mt-auto mx-1" type="button">Search</button>
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
