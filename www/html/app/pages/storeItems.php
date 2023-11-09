<?php 
if (session_status() == PHP_SESSION_NONE) {
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
        <script src="../../js/plugins/bootstrap-5.3.2.bundle.min.js"></script>
        <script src="../../js/plugins/jquery-3.7.1.min.js"></script>
	    <script src="../../js/plugins/fontawesome-6.4.2.js"></script>
	    <script src="../../js/plugins/datatables-1.13.6.min.js"></script>
        <script src="../../js/item.js"></script>

        <!-- CSS -->
        <link rel="stylesheet" href="../../css/bootstrap-5.3.2.min.css">
	    <link rel="stylesheet" href="../../css/fontawesome-6.4.2.css">
	    <link rel="stylesheet" href="../../css/datatables-1.13.6.min.css">
        <link rel="stylesheet" href="../../css/grocery.css">
    </head>
    <body class="bg-light">
        <!-- Begin Navbar Include -->
        <?php include 'navbar.php' ?>
        <!-- End Navbar Include -->
        <!-- Begin Content Area -->
        <div class="container shadow py-3 bg-white rounded-2 mt-3">
            <input type="text" id="userId" value="<?php echo $_SESSION['user'] ?>">
            <div class="text-center py-2">
                <h1 class="mb-2" id="title"></h1>
                <h5 class="mb-2" id="address"></h5>
            </div>
            <div class='py-2'>
                <button class='btn btn-success'>Add Item</button>
            </div>
            <table id="tableItems" class="display w-100">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th style="max-width: 50px"></th><?php //id for votes and such ?>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- End Content Area -->
    </body>
</html>
