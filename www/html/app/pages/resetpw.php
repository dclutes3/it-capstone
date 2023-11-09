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
        <script src="../../js/plugins/bootstrap-5.3.2.bundle.min.js"></script>
        <script src="../../js/plugins/jquery-3.7.1.min.js"></script>
        <script src="../../js/plugins/fontawesome-6.4.2.js"></script>
	<script src="../../js/resetpw.js"></script>

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
                            <p class="h5 text-danger text-center" id="resetError"></p>
                            <form>
                                <div class="mb-3 text-center">
                                    <h2>Reset Password</h2>
                                </div>
				<div class="mb-3 text-center">
                                    <p>Please enter your new password below, you will be logged in after.</p>
                                </div>
                                <div class="mb-3">
                                    <p class="form-label">New Password</p>
                                    <input type="password" class="form-control" name="pass"/>
                                </div>
                                <div class="text-center mb-2">
                                    <button type="button" id="submitBtn" class="btn btn-success">Submit</button>
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