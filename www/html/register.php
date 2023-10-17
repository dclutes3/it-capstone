<!-- Begin PHP Functions -->
<?php
session_start();
include("/var/plugins/database/database.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["fname"]) && !empty($_POST["lname"]) && !empty($_POST["email"]) && !empty($_POST["pass"])) {
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $randId = rand(10000, 90000);
        $db = new Database();
        $stmt = $db->stmtprepare("SELECT * FROM capstone.user WHERE EMAIL = ?");
        $stmt->bind_param("s", $email);
        $db->stmt($stmt);
        $duplicate = $db->singleprepared();
        if (!str_contains($duplicate, $email)) {
            $stmt = $db->stmtprepare("INSERT INTO user(id, fname, lname, email, password) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("issss", $randId, $fname, $lname, $email, password_hash($_POST["pass"], PASSWORD_ARGON2ID));
            $db->stmt($stmt);
            $check = $db->executeprepared();
            if (strcmp($check, "EXECUTED ")) {
                header("Location: index.php");
            } else {
                $error = "An error occurred while registering.";
            }
            $db->close();
        } else {
            $error = "This email is already registered.";
            $db->close();
        }
    } else {
        $error = "Oops. Please enter a value for all fields.";
    }
}
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
	<script src="js/jquery-3.7.1.min.js"></script>
        <script src="js/bootstrap-5.3.2.bundle.min.js"></script>
	<script src="js/fontawesome-6.4.2.js"></script>

        <!-- CSS -->
        <link rel="stylesheet" href="css/bootstrap-5.3.2.min.css">
	<link rel="stylesheet" href="css/fontawesome-6.4.2.css">
        <link rel="stylesheet" href="css/grocery.css">
    </head>
    <body>
        <!-- Begin Navbar Include -->
        <?php include 'navbar.php' ?>
        <!-- End Navbar Include -->
        <!-- Begin Content Area -->
        <div class="d-flex align-items-center justify-content-center vh-100">
            <div class="border rounded">
                <?php
                if (!empty($error)) {
                    echo "<h5>${error}</h5>";
                }
                ?>

                <form action="register.php" method="post">
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
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Content Area -->
    </body>
</html>