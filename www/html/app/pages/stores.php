<!DOCTYPE html>
<html>
    <head>
        <!-- Title and Meta tags -->
        <title>Grocery Price Comparer</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- JS -->
        <script src="../../js/plugins/bootstrap-5.3.2.bundle.min.js"></script>
        <script src="../../js/plugins/jquery-3.7.1.min.js"></script>
	<script src="../../js/plugins/fontawesome-6.4.2.js"></script>
        <script src="../../js/plugins/datatables-1.13.6.min.js"></script>
        <script src="../../js/stores.js"></script>

        <!-- CSS -->
        <link rel="stylesheet" href="../../css/bootstrap-5.3.2.min.css">
	<link rel="stylesheet" href="../../css/fontawesome-6.4.2.css">
        <link rel="stylesheet" href="../../css/grocery.css">
        <link rel="stylesheet" href="../../css/datatables-1.13.6.min.css">
    </head>
    <body>
        <!-- Begin Navbar Include -->
        <?php include 'navbar.php' ?>
        <!-- End Navbar Include -->
        <!-- Begin Content Area -->
        <div class="text-center pt-5 mb-5">
            <h1>All Stores</h1>
        </div>
        <p class="h5 text-danger text-center mb-5" id="storesError"></p>
        <table id="stores"></div>
        <!-- End Content Area -->
    </body>
</html>
