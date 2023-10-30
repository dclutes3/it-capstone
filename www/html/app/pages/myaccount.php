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
        <script src="../../js/myaccount.js"></script>


        <!-- CSS -->
        <link rel="stylesheet" href="../../css/bootstrap-5.3.2.min.css">
        <link rel="stylesheet" href="../../css/fontawesome-6.4.2.css">
        <link rel="stylesheet" href="../../css/grocery.css">
    </head>
    <body>
        <!-- Begin Navbar Include -->
        <?php include 'navbar.php' ?>
        <!-- End Navbar Include -->
        <!-- Begin Content Area -->
        <div class="d-flex align-items-center justify-content-center vh-100">
            <div class="container w-25 shadow py-5 bg-white rounded-2 mt-3">
                <div class="row">
                    <div class='col-12'>
                        <p class="h5 text-danger text-center" id="updateError"></p>
                        <form>
                            <div class="mb-3 text-center">
                                <h1>My Account</h1>
                            </div>
                            <div class="mb-3">
                                <p class="form-label">First Name</p>
                                <input name="fname" id="fname" type="text" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <p class="form-label">Last Name</p>
                                <input name="lname" id="lname" type="text" class="form-control"/>
                            </div>
                            <div class="mb-3">
                                <p class="form-label">Email</p>
                                <input name="email" id="email" type="email" class="form-control"/>
                            </div>
                            <div class="mb-3">
                                <p class="form-label">New Password</p>
                                <input name="pass" type="password" class="form-control" placeholder="Optional"/>
                            </div>
                            <div class="text-center mb-3">
                                <button type="button" id="updateBtn" class="btn btn-success">Update Account</button>
                            </div>
                            <div class="text-center">
                                <a id="deleteBtn" href="#" style="color: red;">Delete Account</a>
                            </div>
                        </form>
                    </div>  
                </div>
            </div>
        </div>
        <!-- End Content Area -->
    </body>
</html>
