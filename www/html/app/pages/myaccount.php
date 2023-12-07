<!DOCTYPE html>
<html>
    <head>
        <!-- Title and Meta tags -->
        <title>PricePal - My Account</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- JS -->
        <script src="../js/plugins/bootstrap-5.3.2.bundle.min.js"></script>
        <script src="../js/plugins/jquery-3.7.1.min.js"></script>
        <script src="../js/plugins/fontawesome-6.4.2.js"></script>
        <script src="../js/myaccount.js"></script>


        <!-- CSS -->
        <link rel="stylesheet" href="../css/bootstrap-5.3.2.min.css">
        <link rel="stylesheet" href="../css/fontawesome-6.4.2.css">
        <link rel="stylesheet" href="../css/grocery.scss">
    </head>
    <body>
        <!-- Begin Navbar Include -->
        <?php include 'navbar.php' ?>
        <!-- End Navbar Include -->
        <!-- Begin Content Area -->
        <div class="d-flex align-items-center vh-100">
            <div class="container mt-3">
                <div class="row justify-content-center">
                    <div class='col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4'>
                        <div class="shadow p-3 mb-5 bg-white rounded-2">
                            <p class="h5 text-danger text-center" id="updateError"></p>
                            <div id="accountBody">
                                <div class="mb-3 text-center">
                                        <h1 class="title-gray-bg">My Account</h1>
                                </div>
                                <div class="mb-3">
                                    <b><p class="form-label">First Name:</p></b>
                                    <div class="row">
                                        <div class="col-10 d-flex align-items-center">
                                            <div id=fnameBody class="w-100"></div>
                                        </div>
                                        <div class='col-2' id="fnameButton">
                                            <button id="updateFname" class="btn"><i class="fa-solid fa-pencil"></i></button>
                                        </div>
                                    </div>
                                    <hr class="hr">
                                </div>
                                <div class="mb-3">
                                    <b><p class="form-label">Last Name:</p></b>
                                    <div class="row">
                                        <div class="col-10 d-flex align-items-center">
                                            <div id=lnameBody class="w-100"></div>
                                        </div>
                                        <div class='col-2' id="lnameButton">
                                            <button id="updateLname" class="btn"><i class="fa-solid fa-pencil"></i></button>
                                        </div>
                                    </div>
                                    <hr class="hr">
                                </div>
                                <div class="mb-3">
                                    <b><p class="form-label">Email:</p></b>
                                    <div class="row">
                                        <div class="col-10 d-flex align-items-center">
                                            <div id="emailBody" class="w-100"></div>
                                        </div>
                                        <div class='col-2' id="emailButton">
                                            <button id="updateEmail" class="btn"><i class="fa-solid fa-pencil"></i></button>
                                        </div>
                                    </div>
                                    <hr class="hr">
                                </div>
                                <div class="mb-3">
                                    <b><p class="form-label">Password:</p></b>
                                    <div class="row">
                                        <div class="col-10 d-flex align-items-center">
                                            <div id="passwordBody" class="w-100"></div>
                                        </div>
                                        <div class='col-2' id="passwordButton">
                                            <button id="updatePassword" class="btn"><i class="fa-solid fa-pencil"></i></button>
                                        </div>
                                    </div>
                                    <hr class="hr">
                                </div>
                                <div class="text-center">
                                    <a id="deleteBtn" href="#" style="color: red;" title="Delete Account Button" aria-label="Delete Account Button">Delete Account</a>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
        <!-- End Content Area -->
    </body>
    <!-- Begin Footer Include -->
    <?php include 'footer.php' ?>
    <!-- End Footer Include -->
</html>
