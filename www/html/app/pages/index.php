<!DOCTYPE html>
<html>
    <head>
        <!-- Title and Meta tags -->
        <title>PricePal</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- JS -->
        <script src="../js/plugins/jquery-3.7.1.min.js"></script>
        <script src="../js/plugins/bootstrap-5.3.2.bundle.min.js"></script>
        <script src="../js/plugins/fontawesome-6.4.2.js"></script>

        <!-- CSS -->
        <link rel="stylesheet" href="../css/bootstrap-5.3.2.min.css">
        <link rel="stylesheet" href="../css/fontawesome-6.4.2.css">
        <link rel="stylesheet" href="../css/grocery.scss">
    </head>
    <body>
        <!-- Begin Navbar Include -->
        <?php include 'navbar.php' ?>
        <!-- End Navbar Include -->
        <!-- Begin Banner Area -->
        <div id="banner" class="d-flex mb-4" title="Banner with decorative image, and title text" aria-label="Banner with decorative image, and title text">
            <div class="my-auto">
                <div class="col-md-7">
                    <h1 class="title-gray-bg">Looking to save money on groceries?</h1>
                    <h3 class="title-gray-bg">PricePal lets you view the prices of groceries at stores around Columbia to help you find the best deals!</h3>
                    <a class="btn btn-success" href="items" title="Get Started Button" aria-label="Get Started Button">Get Started</a>
                </div>
            </div>
        </div>
        <!-- End Banner Area -->
        <!-- Begin Featured Area -->
        <div class="text-center">
            <div class="mb-5">
                <h1 class="title-gray-bg">Featured Stores</h1>
            </div>
        </div>

        <div class="custom-shadow bg-white border border-2 border-dark border-start-0 border-end-0">
            <!-- Carousel -->
            <div id="featuredStores" class="carousel slide mx-auto" data-bs-ride="carousel">

                <!-- Indicators/dots -->
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#featuredStores" data-bs-slide-to="0" class="active" title="Next Slide Button" aria-label="Next Slide Button"></button>
                    <button type="button" data-bs-target="#featuredStores" data-bs-slide-to="1" title="Next Slide Button" aria-label="Next Slide Button"></button>
                    <button type="button" data-bs-target="#featuredStores" data-bs-slide-to="2" title="Next Slide Button" aria-label="Next Slide Button"></button>
                </div>

                <!-- The slideshow/carousel -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../assets/photos/Hy-Vee.JPG" title="Hy-Vee Store Image" alt="Hy-Vee Store Image" class="d-block w-100">
                        <div class="carousel-caption">
                            <h3>Hy-Vee</h3>
                            <a class="btn btn-primary" href="items?Id=1" title="View Items Button" aria-label="View Items Button">View Items</a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="../assets/photos/Walmart.JPG" title="Walmart Store Image" alt="Hy-Vee Store Image" class="d-block w-100">
                        <div class="carousel-caption">
                            <h3>Walmart</h3>
                            <a class="btn btn-primary" href="items?Id=2" title="View Items Button" aria-label="View Items Button">View Items</a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="../assets/photos/Target.png" title="Target Store Image" alt="Hy-Vee Store Image" class="d-block w-100">
                        <div class="carousel-caption">
                            <h3>Target</h3>
                            <a class="btn btn-primary" href="items?Id=4" title="View Items Button" aria-label="View Items Button">View Items</a>
                        </div>
                    </div>
                </div>

                <!-- Left and right controls/icons -->
                <button class="carousel-control-prev" type="button" data-bs-target="#featuredStores" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#featuredStores" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>

        <!-- Original Featured Area -->
        <!-- <div class="text-center">
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
        </div> -->

        <!-- End Featured Area -->
    </body>
    <!-- Begin Footer Include -->
    <?php include 'footer.php' ?>
    <!-- End Footer Include -->
</html>
