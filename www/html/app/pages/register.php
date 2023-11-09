<!-- Begin PHP Functions -->
<?php
session_start();
?>
<!-- End PHP Functions -->
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
        <script src="../../js/register.js"></script>

        <!-- CSS -->
        <link rel="stylesheet" href="../../css/bootstrap-5.3.2.min.css">
        <link rel="stylesheet" href="../../css/fontawesome-6.4.2.css">
        <link rel="stylesheet" href="../../css/grocery.css">
    </head>
    <body class='bg-light'>
        <!-- Begin Navbar Include -->
        <?php include 'navbar.php' ?>
        <!-- End Navbar Include -->
        <!-- Begin Content Area -->
        <div class="d-flex align-items-center vh-100">
            <div class="container mt-3">
                <div class="row justify-content-center">
                    <div class='col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4'>
                        <div class="shadow p-3 mb-5 bg-white rounded-2">
                            <p class="h5 text-danger text-center" id="registerError"></p>
                            <form>
                                <div class="mb-3 text-center">
                                    <h1>Register</h1>
                                </div>
                                <div class="mb-3">
                                    <p class="form-label">First Name</p>
                                    <input name="fname" type="text" class="form-control"/>
                                </div>
                                <div class="mb-3">
                                    <p class="form-label">Last Name</p>
                                    <input name="lname" type="text" class="form-control"/>
                                </div>
                                <div class="mb-3">
                                    <p class="form-label">Email</p>
                                    <input name="email" type="email" class="form-control"/>
                                </div>
                                <div class="mb-3">
                                    <p class="form-label">Password</p>
                                    <input name="pass" type="password" class="form-control"/>
                                </div>
                                <div class="mb-3 text-center">
                                    <p>Enter a Security Question and Answer that will allow you to recover your account - <strong>This cannot be changed</strong></p>
                                </div>
                                <div class="mb-3">
                                    <p class="form-label">Security Question</p>
                                    <input name="squestion" type="text" class="form-control"/>
                                </div>
                                <div class="mb-3">
                                    <p class="form-label">Security Answer</p>
                                    <input name="sanswer" type="text" class="form-control"/>
                                </div>
                                <div class="text-center">
                                    <button type="button" id="registerBtn" class="btn btn-success">Submit</button>
                                </div>
                            </form>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
        <!-- End Content Area -->
    </body>
</html>