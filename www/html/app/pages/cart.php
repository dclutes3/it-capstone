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
        <title>PricePal - Cart</title>
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
            <?php if ($_SESSION['user']) { ?>
                <div id="banner-page" class="mb-4">
                    <div class="my-auto">
                        <div class="col-md-6">
                            <h2 class="title-gray-bg m-4">Your Cart</h2>
                        </div>
                    </div>
                </div>
                <div class="mb-2">
                    <button type='button' id="removeFromCart" class='btn btn-danger btn-sm' disabled>Remove</button>
                </div>
                <div id="tableCartBody" class="px-3">

                </div>
            <?php } else { ?>
                <div class="text-center mb-5">
                    <p class='h3 text-warning'>You must be logged in to view this page.</p>
                </div>
            <?php } ?>
        </div>
    </body>
</html>
