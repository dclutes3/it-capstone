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

        <!-- CSS -->
        <link rel="stylesheet" href="../../css/bootstrap-5.3.2.min.css">
	    <link rel="stylesheet" href="../../css/fontawesome-6.4.2.css">
        <link rel="stylesheet" href="../../css/grocery.css">
    </head>
    <body>
        <!-- Begin Navbar Include -->
        <?php include 'navbar.php' ?>
        <!-- End Navbar Include -->
        <!-- Begin Banner Area -->
        <div id="banner" class="d-flex mb-4">
            <div class="my-auto">
                <div class="text-center">
                    <h1>Welcome!</h1>
                    <h3>To get started, try one of the stores below, use the top navigation, or just search!</h3>
                    <a class="btn btn-success" href="items.php">Get Started</a>
                </div>
            </div>
        </div>
        <!-- End Banner Area -->
        <!-- Begin Featured Area -->
        <div class="text-center">
            <div class="mb-5">
                <h1>Featured Stores</h1>
            </div>
            <div class="row">
                <div class="col-lg-4 mb-5">
		    <div class="mb-5"></div>
                    <h1 style="font-size: 60px; font-weight: bold; color: crimson;">Hy-Vee</h1>
                    <a class="btn btn-primary" href="items.php?Id=1">View Items</a>
                </div>
                <div class="col-lg-4 mb-5">
		    <div class="mb-5"></div>
                    <h1 style="font-size: 60px; font-weight: bold; color: deepskyblue;">Walmart</h1>
                    <a class="btn btn-primary" href="items.php?Id=2">View Items</a>
                </div>
                <div class="col-lg-4 mb-5">
		    <div class="mb-5"></div>
                    <h1 style="font-size: 60px; font-weight: bold; color: darkblue;">Aldi</h1>
                    <a class="btn btn-primary" href="items.php?Id=3">View Items</a>
                </div>
            </div>
        </div>
        <!-- End Featured Area -->
    </body>
</html>
