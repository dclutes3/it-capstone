<!-- Begin PHP Functions -->
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
        <script src="../js/plugins/bootstrap-5.3.2.bundle.min.js"></script>
        <script src="../js/plugins/jquery-3.7.1.min.js"></script>
	    <script src="../js/plugins/fontawesome-6.4.2.js"></script>
        <script src="../js/plugins/datatables-1.13.6.min.js"></script>
       <script src="../js/cart.js"></script>

        <!-- CSS -->
        <link rel="stylesheet" href="../css/bootstrap-5.3.2.min.css">
	    <link rel="stylesheet" href="../css/fontawesome-6.4.2.css">
        <link rel="stylesheet" href="../css/grocery.scss">
        <link rel="stylesheet" href="../css/datatables-1.13.6.min.css">
    </head>
    <body>
        <?php include 'navbar.php' ?>
        <div id="cartContainer" class="container shadow py-5 bg-white rounded-2 mt-3 h-100">
            <?php if($_SESSION['user']){ ?>
            <div id="banner-page" class="d-flex mb-4">
                    <div class="my-auto">
                        <div class="col-md-6">
                            <h1>Your Cart</h1>
                        </div>
                    </div>
                </div>
            <div class="mb-2">
                <button type='button' id="removeFromCart" class='btn btn-danger btn-sm' disabled>Remove</button>
            </div>
            <table id="tableCart" class="display w-100">
                <thead>
                    <tr>
                        <th style="max-width:25px;"></th>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Type</th>
                        <th>Store</th>
                    </tr>
                </thead>
            </table>
            <?php } else { ?>
            <div class="text-center mb-5">
                <p class='h3 text-warning'>You must be logged in to view this page.</p>
            </div>
            <?php } ?>
        </div>
    </body>
</html>
